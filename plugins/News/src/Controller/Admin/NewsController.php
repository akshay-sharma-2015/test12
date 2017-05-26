<?php
namespace News\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\I18n\I18n;
use Cake\Filesystem\Folder;

/**
 * News Controller
 *
 * @property \News\Model\Table\NewsTable $News
 */
class NewsController extends AppController
{

   public $components = ['Paginator'];
	
	/**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {	
		
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();		
		
		I18n::locale($lanagauageList->code);		
		$query = $this->News->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where(['News_title_translation.content  LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = ['sortWhitelist' => ['title','description'],'contain' => ['Masters']];

		$query->order(['News.id' => 'desc']);
        $newsPages = $this->paginate($query);
       
		$this->set(compact('newsPages'));
    }

    

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
		
        $newsPage = $this->News->newEntity();
        if ($this->request->is('post')) {
			$validateData				=	$this->request->data['_translations'][$lanagauageList->code];

			$validateData['slug']		=	isset($this->request->data['slug']) ? $this->request->data['slug'] : '';			
			$validateData['master_id']	=	isset($this->request->data['master_id']) ? $this->request->data['master_id'] : '';	
			$validateData['news_user']	=	isset($this->request->data['news_user']) ? $this->request->data['news_user'] : '';
			$validateData['image']		=	isset($this->request->data['image']) ? $this->request->data['image'] : '';				
			$newsPage = $this->News->patchEntity($newsPage, $validateData);
			if(!$newsPage->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					$newsPage->translation($lang)->set($data, ['guard' => false]);
				}
				
				$thisData			=	$this->request->data;				
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     $this->change_file_name($file_name);					
					$ROOT_PATH								=	   NEWS_IMG_ROOT_PATH.DS.Date("m").'-'.Date('Y').DS;					
					if(!file_exists($ROOT_PATH)){
						new Folder($ROOT_PATH, true, 0755);						
					}		
					if($this->moveUploadedFile($tmp_name, $ROOT_PATH.$return_file_name)){
						$newsPage->image					=		Date("m").'-'.Date('Y').'/'.$return_file_name;
					}
				}	
				$this->News->save($newsPage);
				
				$this->Flash->success(__('The news has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The news could not be saved. Please, try again.'));
        }		
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		$master_id		=	$this->News->Masters->find('list')->where(['type' => 'news_category','is_deleted' => 0]);
		$news_user		=	$this->News->Masters->find('list')->where(['type' => 'news_user','is_deleted' => 0]);
		$this->set(compact('newsPage','lanagauageList','master_id','news_user'));
		
    }

    /**
     * Edit method
     *
     * @param string|null $id Cms Page id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
		
		$newsPage = $this->News->find('translations')
			->where([
				'id' => $id
			])->first();
		$savedImage 	=	$newsPage->image;
		if ($this->request->is(['patch', 'post', 'put'])) {
			
			$validateData['slug']		=	isset($this->request->data['slug']) ? $this->request->data['slug'] : '';			
			$validateData['master_id']	=	isset($this->request->data['master_id']) ? $this->request->data['master_id'] : '';	
			$validateData['news_user']	=	isset($this->request->data['news_user']) ? $this->request->data['news_user'] : '';
			$validateData['image']		=	isset($this->request->data['image']) ? $this->request->data['image'] : '';	
			$newsPage = $this->News->patchEntity($newsPage, $validateData);
			
			
			if(!$newsPage->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					$newsPage->translation($lang)->set($data, ['guard' => false]);
				}
				
				$thisData			=	$this->request->data;				
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     $this->change_file_name($file_name);					
					$ROOT_PATH								=	   NEWS_IMG_ROOT_PATH.DS.Date("m").'-'.Date('Y').DS;					
					if(!file_exists($ROOT_PATH)){
						new Folder($ROOT_PATH, true, 0755);						
					}		
					if($this->moveUploadedFile($tmp_name, $ROOT_PATH.$return_file_name)){
						$newsPage->image					=		Date("m").'-'.Date('Y').'/'.$return_file_name;
						@unlink(NEWS_IMG_ROOT_PATH.$savedImage);
					}
				}else{
					$newsPage->image						=		$savedImage;
				}
				
				$this->News->save($newsPage);
				$this->Flash->success(__('The news has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The news could not be saved. Please, try again.'));
        }
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		$master_id		=	$this->News->Masters->find('list')->where(['type' => 'news_category','is_deleted' => 0]);
		$news_user		=	$this->News->Masters->find('list')->where(['type' => 'news_user','is_deleted' => 0]);
		$this->set(compact('newsPage','lanagauageList','master_id','news_user'));
		
    }

    /**
     * Delete method
     *
     * @param string|null $id Cms Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $newsPage = $this->News->get($id);
        if ($this->News->delete($newsPage)) {
            $this->Flash->success(__('The news has been deleted.'));
        } else {
            $this->Flash->error(__('The news could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
    /**
     * Delete method
     *
     * @param string|null $id Cms Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function feat($id = null)
    {
       $this->News->updateAll(['is_feat' => 0],['is_feat' => 1]);
		
		
		$languages  =	 $this->News->find('all')->where(['id' => $id])->first();
		
		$languages->is_feat = 1;
		$this->News->save($languages);
		
		$this->Flash->success('Status changed successfully');
        return $this->redirect(['action' => 'index']);
    }
}
