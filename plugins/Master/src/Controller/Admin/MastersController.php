<?php
namespace Master\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Utility\Inflector;
// use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\Core\Configure;
// use Master\Controller\Admin\AppController;

/**
 * Masters Controller
 *
 * @property \Master\Model\Table\MastersTable $Masters
 */
class MastersController extends AppController
{
	
	public $components = ['Paginator'];
	
	public $paginate = [
        'limit' => 10,
        'order' => [
            'Masters.id' => 'desc'
        ]
    ];
	
/* 	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
		$this->set('model',$this->modelClass);
    } */
    /**
     * Index method
     * @param string|null $type Master type.
     * @return \Cake\Network\Response|null
     */
    public function index($type = null)
    {
		$this->clearCache();
		$this->set('model',$this->modelClass);
			
		if(empty($type)){
			die('Error');
		}
		
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();	
		I18n::locale($lanagauageList->code);		
		
		if($type == 'aminities' || $type == 'email_notifications'){
			$parentMasters = $this->Masters->ParentMasters->find('list')->where(['type' => $type,'parent_id' => 0]);
		}
		
		$this->paginate = [
            'order' => ['Masters.id DESC'],
			'sortWhitelist' => ['name']
        ];

		if($type == 'aminities' || $type == 'email_notifications'){
			$this->paginate = [
				'order' 		=> ['Masters.id DESC'],
				'contain' 		=> ['ParentMasters'],
				'sortWhitelist' => ['name']
			];
		}
		
		$heading	=	Inflector::humanize($type);
		
        $query = $this->Masters->find();		
		$query->where(['Masters.type' => $type]);	
		
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where(['Masters.'.$name.' LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$query->where(['Masters.is_deleted' => 0]);
		
		// $this->paginate = [];

        $masters = $this->paginate($query);
       
		
		// pr($masters);
        $this->set(compact('masters','type','heading'));
        $this->set('_serialize', ['masters']);
    }

    

    /**
     * Add method
     * @param string|null $type Master type.
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($type = null)
    {
		if(empty($type)){
			die('Error');
		}
		$this->loadModel('Languages');
			
		$heading	=	Inflector::humanize($type);
        $master 	= 	$this->Masters->newEntity();
        if ($this->request->is('post')) { 
			$this->Masters->type = $type;
			
			$defaultLang	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
		
			$validateData	=	$this->request->data['_translations'][$defaultLang->code];
			if(in_array($type,Configure::read('image_array'))){
				$validateData['image']	=	$this->request->data['image'];
			}
           	if($type == 'aminities' || $type == 'email_notifications'){
				$validateData['parent_id']	=	!empty($this->request->data['parent_id']) ?  $this->request->data['parent_id'] : 0 ;
			}
			if($type == 'amenities_info'){
				$validateData['field_type']	=	!empty($this->request->data['field_type']) ?  $this->request->data['field_type'] : '' ;
			}
            $master 		= 	$this->Masters->patchEntity($master, $validateData);		
			
			if(!$master->errors()){
				// $master->slug	=	Inflector::slug($master->name);			
				if(in_array($type,Configure::read('image_array'))){
					$thisData	=	$this->request->data;
					if(!empty($thisData['image']['name'])){
						$file_name         						=     $thisData['image']['name'];
						$tmp_name          						=     $thisData['image']['tmp_name'];
						$return_file_name   					=     time().$this->change_file_name($file_name);				
						if($this->moveUploadedFile($tmp_name, AMENITIES_ROOT_PATH.$return_file_name)){
							$master->image						=		$return_file_name;
						}
					}
				}
				foreach ($this->request->data['_translations'] as $lang => $data) {
					if(isset($data['name']) && !empty($data['name']) || isset($data['meta_title']) && !empty($data['meta_title']) || isset($data['meta_description']) && !empty($data['meta_description']) )
					$master->translation($lang)->set($data, ['guard' => false]);
				}
				$master->type		=	$type;
				
				$this->Masters->save($master);
				$this->Flash->success($heading.' has been saved.');
				return $this->redirect(['action' => 'index',$type]);
				
			}else {
				$this->Flash->error(__($heading.' could not be saved. Please, try again.')); 
			}
        }
		if($type == 'aminities' || $type == 'email_notifications'){
			$parentMasters = $this->Masters->ParentMasters->find('list')->where(['type' => $type,'parent_id' => 0]);
		}
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);
        $this->set(compact('master','type','heading','parentMasters','lanagauageList'));
        $this->set('_serialize', ['master']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Master id.
     * @param string|null $type Master type.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null,$type = null)
    {
		$master	=	$result = $this->Masters->find('translations')
			->where([
				'id' => $id
			])->first();
		$this->loadModel('Languages');
		$heading	=	Inflector::humanize($type);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$orimage		=	$result->image;
			$defaultLang	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
		
			$validateData				=	$this->request->data['_translations'][$defaultLang->code];
			if(in_array($type,Configure::read('image_array'))){
				$validateData['image']	=	$this->request->data['image'];
			}
			if($type == 'amenities_info'){
				$validateData['field_type']	=	!empty($this->request->data['field_type']) ?  $this->request->data['field_type'] : '' ;
			}
            $master 		= 	$this->Masters->patchEntity($master, $validateData);			
			if(!$master->errors()){
				// $master->slug	=	Inflector::slug($master->name);			
				if(in_array($type,Configure::read('image_array'))){
					$thisData	=	$this->request->data;
					if(!empty($thisData['image']['name'])){
						$file_name         						=     $thisData['image']['name'];
						$tmp_name          						=     $thisData['image']['tmp_name'];
						$return_file_name   					=     time().$this->change_file_name($file_name);				
						if($this->moveUploadedFile($tmp_name, AMENITIES_ROOT_PATH.$return_file_name)){
							$master->image						=		$return_file_name;
						}
					}else{
						$master->image							=		$orimage;
					}
				}
				foreach ($this->request->data['_translations'] as $lang => $data) {
					if(isset($data['name']) && !empty($data['name'])){
						$master->translation($lang)->set($data, ['guard' => false]);
					}
					if(isset($data['meta_title']) && !empty($data['meta_title'])){
						
						$master->translation($lang)->set($data, ['guard' => false]);
					}
					if(isset($data['meta_description']) && !empty($data['meta_description'])){
						
						$master->translation($lang)->set($data, ['guard' => false]);
					}
				}
				
				$master->type	=	$type;
				
				$this->Masters->save($master);
				$this->Flash->success($heading.' has been saved.');
				return $this->redirect(['action' => 'index',$type]);
				
			}else {
				$this->Flash->error(__($heading.' could not be saved. Please, try again.')); 
			}
       }
		
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);
        $this->set(compact('master','type','heading','lanagauageList'));
        $this->set('_serialize', ['master']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Master id.
	 * @param string|null $type Master type.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null,$type = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $master = $this->Masters->get($id);
		if($master->parent_id == 0){
			$this->Masters->query()
				 ->update()
				->set(['is_deleted' => 1])
				->where(['parent_id' => $id])
				->execute();
		}
		$master->is_deleted	=	1;
        if ($this->Masters->save($master)) {
            $this->Flash->success(__('The master has been deleted.'));
        } else {
            $this->Flash->error(__('The master could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index',$type]);
    }
}
