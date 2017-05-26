<?php
namespace CityManager\Controller\Admin;
use App\Controller\Admin\AppController;
// use Cake\Event\Event;
use Cake\I18n\I18n;
// use Cake\ElasticSearch\TypeRegistry;
// use Cake\Utility\Inflector;
/**
 * City Controller
 *
 * @property \CityManager\Model\Table\CityTable $City
 */
class CityController extends AppController
{

	public $components = ['Paginator'];
	// public $helpers = ['Cewi/Excel.Excel'];
	 
	/* public function initialize()
	{
		parent::initialize();
		// $this->loadComponent('RequestHandler');
		// $this->loadComponent('Cewi/Excel.Import');  
		
	} */
	/* public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
		$this->set('model',$this->modelClass);
		
		$this->loadModel('Elastic');
			
    }  */
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->set('model',$this->modelClass);
		
        $this->paginate = [
            'contain' => [/* 'State', */ 'Country'],
			'sortWhitelist' => ['name','email','created']
        ];
		
		$query = $this->City->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction' || $value == '')
					continue;
				if($name == 'country_id')
					$query->where(['City.'.$name.'' => $value]);			
				else
					$query->where(['City.'.$name.' COLLATE UTF8_GENERAL_CI LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		// $query->order(['City.id' => 'desc']);
        $city = $this->paginate($query);
		
        $Country = $this->City->Country->find('list',['order' => 'name ASC']);
		
        $this->set(compact('city','Country'));
        $this->set('_serialize', ['city']);
				$this->set('model',$this->modelClass);

		
    } 
	
	public function excell()
    {
        $this->paginate = [
            // 'contain' => [/* 'State', */ 'Country']
        ];
		
		$query = $this->City->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $value == '')
					continue;
				if($name == 'country_id')
					$query->where(['City.'.$name.'' => $value]);			
				else
					$query->where(['City.'.$name.' COLLATE UTF8_GENERAL_CI LIKE' => $value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
        $city = $this->paginate($query);
		
        $Country = $this->City->Country->find('list',['order' => 'name ASC']);
		
        $this->set(compact('city','Country'));
        $this->set('_serialize', ['city']);
		
		
    }
	function upload(){
		ini_set('memory_limit', '2048M');
		set_time_limit(0);
		$city = $this->City->newEntity();
		if ($this->request->is('post')) {
			
			$file_name         						=     $this->request->data('file.name');
			$tmp_name          						=     $this->request->data('file.tmp_name');
			$file_name								=	$this->change_file_name($file_name);
			move_uploaded_file($tmp_name, AMENITIES_ROOT_PATH.$file_name);
			// echo AMENITIES_ROOT_PATH . $file_name;die;
			$data = $this->Import->prepareEntityData(AMENITIES_ROOT_PATH . $file_name);
			
			$entities = $this->City->newEntities($data);
			$this->loadModel('CityManager.Country');
			
			$actions = $this->Country->find('list', ['keyField' => 'cc_iso','valueField' => 'name'])->toArray();
			$actions2 = $this->Country->find('list', ['keyField' => 'cc_iso','valueField' => 'id'])->toArray();
			
			foreach ($entities as $entitiy) {
				if(isset($actions2[$entitiy->country_code])){
					$entitiy->country_id	=	$actions2[$entitiy->country_code];
					$entitiy->country_name	=	$actions[$entitiy->country_code];
					
					$entitiy->slug			=	strtolower(Inflector::slug($entitiy->name.'-'.$actions[$entitiy->country_code]));
					$this->City->save($entitiy, ['checkExisting' => false]);
				}
			}
		}
		$this->set(compact('city', 'State', 'Country','lanagauageList'));
        $this->set('_serialize', ['city']);
		
	}
    /**
     * View method
     *
     * @param string|null $id City id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $city = $this->City->get($id, [
            'contain' => ['State', 'Country']
        ]);

        $this->set('city', $city);
        $this->set('_serialize', ['city']);
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
		
        $city = $this->City->newEntity();
        if ($this->request->is('post')) {
			$validateData				=	$this->request->data['_translations'][$lanagauageList->code];
			$validateData['object_id']	=	$this->request->data['object_id'];			
			$validateData['slug']		=	$this->request->data['slug'];			
			$validateData['country_id']	=	$this->request->data['country_id'];			
			$validateData['altitude']	=	$this->request->data['altitude'];			
			$validateData['population']	=	$this->request->data['population'];			
			$city = $this->City->patchEntity($city, $validateData);
			
			if(!$city->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					if(empty($data['name'])){
						unset($data['name']);
					}
					if(empty($data['description'])){
						unset($data['description']);
					}
					$city->translation($lang)->set($data, ['guard' => false]);
				}
				$city->slug		=	$this->request->data['_translations']['en']['name'];
				
				$this->loadModel('CasinoImages');
				$object_id	=	$city->object_id;
				$image		=	$this->CasinoImages->find('all')->where(array('object_id' => $object_id))->order(['display_order' => 'ASC'])->first();
				if(!empty($image->file)){
					$city->image	=	$image->file;
				}
				
				$this->City->save($city);
				$this->Flash->success(__('The city page has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The city could not be saved. Please, try again.'));
		}
		$Country 		= 	$this->City->Country->find('list',['order' => ['name' => 'ASC']]);
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		
		$this->set(compact('city', 'State', 'Country','lanagauageList'));
        $this->set('_serialize', ['city']);
		
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file
    }

    /**
     * Edit method
     *
     * @param string|null $id City id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
		
        $city = $this->City->find('translations')
			->where([
				'id' => $id
			])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
			$validateData				=	$this->request->data['_translations'][$lanagauageList->code];

			$validateData['slug']	=	$this->request->data['slug'];	
			
			$validateData['altitude']	=	$this->request->data['altitude'];			
			$validateData['population']	=	$this->request->data['population'];			
			$city 					= 	$this->City->patchEntity($city, $validateData);
			
			if(!$city->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					if(empty($data['name'])){
						unset($data['name']);
					}
					if(empty($data['description'])){
						unset($data['description']);
					}
					$city->translation($lang)->set($data, ['guard' => false]);
				}
				
				$this->loadModel('CasinoImages');
				$object_id	=	$city->object_id;
				$image		=	$this->CasinoImages->find('all')->where(array('object_id' => $object_id))->order(['display_order' => 'ASC'])->first();
				$city->image	=	(!empty($image->file)) ? $image->file : '';
			
				$this->City->save($city);
				$this->Flash->success(__('The city page has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The city could not be saved. Please, try again.'));
		}
       
		$Country 		= 	$this->City->Country->find('list',['order' => ['name' => 'ASC']]);
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		
		$this->set(compact('city', 'State', 'Country','lanagauageList'));
        $this->set('_serialize', ['city']);
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file
		
    }

    /**
     * Delete method
     *
     * @param string|null $id City id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $city = $this->City->get($id);
        if ($this->City->delete($city)) {
            $this->Flash->success(__('The city has been deleted.'));
        } else {
            $this->Flash->error(__('The city could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
