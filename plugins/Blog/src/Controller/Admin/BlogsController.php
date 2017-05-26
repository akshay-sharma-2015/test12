<?php
namespace Blog\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\I18n\I18n;
use Cake\Filesystem\Folder;
/**
 * Blogs Controller
 *
 * @property \Blogs\Model\Table\BlogsTable $Blogs
 */
class BlogsController extends AppController
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
		$query = $this->Blogs->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
				continue;
				$query->where(['Blogs_title_translation.content  LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = ['sortWhitelist' => ['title','description'],'contain' => ['Masters']];

		// $query->order(['Blogs.id' => 'desc']);
		
        $blogPages = $this->paginate($query);
       
		$this->set(compact('blogPages'));
        $this->set('_serialize', ['blogPages']);
		$this->set('model',$this->modelClass);
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
		
        $blogPage = $this->Blogs->newEntity();
        if ($this->request->is('post')) {
			$validateData				=	$this->request->data['_translations'][$lanagauageList->code];
			### Set those fields here that will be not be multi language ###
			$validateData['slug']		=	isset($this->request->data['slug']) ? $this->request->data['slug'] : '';			
			$validateData['master_id']	=	isset($this->request->data['master_id']) ? $this->request->data['master_id'] : '';	
			$validateData['image']		=	isset($this->request->data['image']) ? $this->request->data['image'] : '';	
			$validateData['blogs_user']	=	isset($this->request->data['blogs_user']) ? $this->request->data['blogs_user'] : '';	
			
			$blogPage = $this->Blogs->patchEntity($blogPage, $validateData);
			if(!$blogPage->errors()){
				
				#### In this code multi language code will be save in i18N table ####
				foreach ($this->request->data['_translations'] as $lang => $data) {					
					$blogPage->translation($lang)->set($data, ['guard' => false]);
				}
				
				$thisData			=	$this->request->data;				
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     $this->change_file_name($file_name);					
					$ROOT_PATH								=	   BLOG_IMG_ROOT_PATH.DS.Date("m").'-'.Date('Y').DS;					
					if(!file_exists($ROOT_PATH)){
						new Folder($ROOT_PATH, true, 0755);						
					}		
					if($this->moveUploadedFile($tmp_name, $ROOT_PATH.$return_file_name)){
						$blogPage->image						=		Date("m").'-'.Date('Y').'/'.$return_file_name;
					}
				}				
				$this->Blogs->save($blogPage);				
				$this->Flash->success(__('The Blogs has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The Blogs could not be saved. Please, try again.'));
        }		
		
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		$master_id		=	$this->Blogs->Masters->find('list')->where(['type' => 'blog_category','is_deleted' => 0]);
		$blogs_user		=	$this->Blogs->Masters->find('list')->where(['type' => 'blog_user','is_deleted' => 0]);
		
		$this->set(compact('blogPage','lanagauageList','master_id','blogs_user'));		
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
		
		$blogPage		=	 $this->Blogs->find('translations')
			->where([
				'id' => $id
			])->first();
		$savedImage		=	$blogPage->image;
		if ($this->request->is(['patch', 'post', 'put'])) {
			### Set those fields here that will be not be multi language ###
			$validateData['slug']		=	isset($this->request->data['slug']) ? $this->request->data['slug'] : '';			
			$validateData['master_id']	=	isset($this->request->data['master_id']) ? $this->request->data['master_id'] : '';	
			$validateData['image']		=	isset($this->request->data['image']) ? $this->request->data['image'] : '';	
			$validateData['blogs_user']	=	isset($this->request->data['blogs_user']) ? $this->request->data['blogs_user'] : '';	
			
			$blogPage = $this->Blogs->patchEntity($blogPage, $validateData);
			
			// pr($blogPage->errors());
			if(!$blogPage->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					$blogPage->translation($lang)->set($data, ['guard' => false]);
				}
				
				$thisData			=	$this->request->data;				
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     $this->change_file_name($file_name);					
					$ROOT_PATH								=	   BLOG_IMG_ROOT_PATH.DS.Date("m").'-'.Date('Y').DS;					
					if(!file_exists($ROOT_PATH)){
						new Folder($ROOT_PATH, true, 0755);						
					}		
					if($this->moveUploadedFile($tmp_name, $ROOT_PATH.$return_file_name)){
						$blogPage->image					=		Date("m").'-'.Date('Y').'/'.$return_file_name;
						@unlink(BLOG_IMG_ROOT_PATH.$savedImage);
					}
				}else{
					$blogPage->image						=		$savedImage;
				}
				$this->Blogs->save($blogPage);
				
				$this->Flash->success(__('The Blogs has been updated.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The Blogs could not be saved. Please, try again.'));
        }
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		$master_id		=	$this->Blogs->Masters->find('list')->where(['type' => 'blog_category','is_deleted' => 0]);
		$blogs_user		=	$this->Blogs->Masters->find('list')->where(['type' => 'blog_user','is_deleted' => 0]);
		$this->set(compact('blogPage','lanagauageList','master_id','blogs_user'));
        $this->set('_serialize', ['blogPage']);
		
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
        $blogPage = $this->Blogs->get($id);
        if ($this->Blogs->delete($blogPage)) {
            $this->Flash->success(__('The Blogs has been deleted.'));
        } else {
            $this->Flash->error(__('The Blogs could not be deleted. Please, try again.'));
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
       $this->Blogs->updateAll(['is_feat' => 0],['is_feat' => 1]);
		
		
		$languages  =	 $this->Blogs->find('all')->where(['id' => $id])->first();
		
		$languages->is_feat = 1;
		$this->Blogs->save($languages);
		
		$this->Flash->success('Status changed successfully');
        return $this->redirect(['action' => 'index']);
    }
}
