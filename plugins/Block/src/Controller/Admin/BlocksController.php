<?php
namespace Block\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\I18n\I18n;
use Cake\Filesystem\Folder;


/**
 * Blocks Controller
 *
 * @property \Block\Model\Table\BlocksTable $Blocks
 */
class BlocksController extends AppController
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
		$this->paginate = [
            'order' => ['Blocks.id DESC']
        ];
		I18n::locale($lanagauageList->code);		
		$query = $this->Blocks->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
				continue;
				$query->where(['Blocks_title_translation.content  LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		$this->paginate = ['sortWhitelist' => ['title','description']];

		
        $Blocks = $this->paginate($query);
       
		$this->set(compact('Blocks'));
        $this->set('_serialize', ['Blocks']);
		$this->set('model',$this->modelClass);
    }

    

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($type = 'single')
    {
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
		
        $blockPage = $this->Blocks->newEntity();
        if ($this->request->is('post')) {
			$validateData				=	$this->request->data['_translations'][$lanagauageList->code];
			$validateData['page_name']	=	$this->request->data['page_name'];			
			$blockPage = $this->Blocks->patchEntity($blockPage, $validateData);
			if(!$blockPage->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					$blockPage->translation($lang)->set($data, ['guard' => false]);
				}
				
				$thisData		=	$this->request->data;				
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);	if(!file_exists(GALLERY_ROOT_PATH)){
						new Folder(GALLERY_ROOT_PATH, true, 0755);						
					}	
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$blockPage->image						=		$return_file_name;
					}
				}
				$blockPage->type	=	$type;
				$this->Blocks->save($blockPage);
				$this->Flash->success(__('The block page has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The block page could not be saved. Please, try again.'));
        }		
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		$this->set(compact('blockPage','lanagauageList','type'));
        $this->set('_serialize', ['blockPage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id block Page id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
		
		$blockPage = $this->Blocks->find('translations')
			->where([
				'id' => $id
			])->first();
		$image	=	$blockPage->image;
		if ($this->request->is(['patch', 'post', 'put'])) {
			$validateData				=	$this->request->data['_translations'][$lanagauageList->code];
			$validateData['page_name']	=	$this->request->data['page_name'];			
			$blockPage = $this->Blocks->patchEntity($blockPage, $validateData);

			if(!$blockPage->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					$blockPage->translation($lang)->set($data, ['guard' => false]);
				}
				$thisData		=	$this->request->data;				
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$blockPage->image						=		$return_file_name;
						@unlink(GALLERY_ROOT_PATH.$image);
					}
				}else{
					$blockPage->image						=		$image;
				}
				$this->Blocks->save($blockPage);
				$this->Flash->success(__('The block page has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The block page could not be saved. Please, try again.'));
        }
		$type			=	$blockPage->type;
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		$this->set(compact('blockPage','lanagauageList','type'));
        $this->set('_serialize', ['blockPage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id block Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blockPage = $this->Blocks->get($id);
        if ($this->Blocks->delete($blockPage)) {
            $this->Flash->success(__('The block page has been deleted.'));
        } else {
            $this->Flash->error(__('The block page could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
