<?php
namespace CityManager\Controller\Admin;
use App\Controller\Admin\AppController;
// use Cake\Event\Event;
use Cake\I18n\I18n;
// use Cake\Utility\Inflector;

	 
/**
 * Country Controller
 *
 * @property \CityManager\Model\Table\CountryTable $Country
 */
class CountryController extends AppController
{

	public $components = ['Paginator'];
	// public $helpers = ['Cewi/Excel.Excel'];
	public function initialize()
	{
		parent::initialize();
		// $this->loadComponent('RequestHandler');
		// $this->loadComponent('Cewi/Excel.Import');  
		
	}
/* 	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
		$this->set('model',$this->modelClass);
    } */
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		
		$query = $this->Country->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where([$name.' COLLATE UTF8_GENERAL_CI LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = ['sortWhitelist' => ['name','email','created'],'order' => ['name' => 'asc']];
        $country = $this->paginate($query);
		
        $this->set(compact('country'));
        $this->set('_serialize', ['country']);
		
		$this->set('model',$this->modelClass);
    }
	
	function upload(){
		ini_set('memory_limit', '2048M');
		set_time_limit(0);
		$city = $this->Country->newEntity();
		if ($this->request->is('post')) {
			
			$file_name         						=     $this->request->data('file.name');
			$tmp_name          						=     $this->request->data('file.tmp_name');
			$file_name								=	$this->change_file_name($file_name);
			move_uploaded_file($tmp_name, AMENITIES_ROOT_PATH.$file_name);
			
			$data = $this->Import->prepareEntityData(AMENITIES_ROOT_PATH . $file_name);
			$ne	=	'';
			foreach($data as $a){
				$name				=	$a['COUNTRY_NAME'];
				$tld				=	$a['TLD'];
				$cc_iso				=	$a['CC_ISO'];
				$cc_fips			=	$a['CC_FIPS'];
				$ne[]	=	array(
						'name' => $name,
						'cc_fips' => $cc_fips,
						'tld' => $tld,
						'cc_iso' => $cc_iso
						);
			}
			$entities = $this->Country->newEntities($ne);
			
			foreach ($entities as $key => $entitiy) {
				
				$entitiy->translation('en')->set(array('name' => $data[$key]['English']), ['guard' => false]);
				$entitiy->translation('es')->set(array('name' => $data[$key]['Spanish']), ['guard' => false]);
				$entitiy->translation('de')->set(array('name' => $data[$key]['German']), ['guard' => false]);
				
				$this->Country->save($entitiy, ['checkExisting' => false]);
			}
			 /* die;
			foreach ($country as $entitiy){		
				// $country->translation('en')->set($entitiy['English'], ['guard' => false]);
				// $country->translation('es')->set($entitiy['Spanish'], ['guard' => false]);
				// $country->translation('de')->set($entitiy['German'], ['guard' => false]);
				$name				=	$entitiy['COUNTRY_NAME'];
				$country->slug		=	Inflector::slug($name);			
				$country->name		=	$name;
				$country->tld		=	$entitiy['TLD'];
				$country->cc_iso	=	$entitiy['CC_ISO'];
				$country->cc_fips	=	$entitiy['CC_FIPS'];
				$this->Country->save($country);
			} */
		}
		$this->set(compact('city', 'State', 'Country','lanagauageList'));
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
		
        $country = $this->Country->newEntity();
        if ($this->request->is('post')) {
			
			$validateData			=	$this->request->data['_translations'][$lanagauageList->code];
			$validateData['slug']	=	$this->request->data['slug'];
			
			$country = $this->Country->patchEntity($country, $validateData);			
			if(!$country->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					if(empty($data['name'])){
						unset($data['name']);
					}
					if(empty($data['description'])){
						unset($data['description']);
					}
					$city->translation($lang)->set($data, ['guard' => false]);
				}
				// $country->slug		=	$this->request->data['_translations']['en']['name'];
				// $country->image		=	$flag;
				$this->Country->save($country);
				$this->Flash->success(__('The country has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The country could not be saved. Please, try again.'));
		}
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		
        $this->set(compact('country','lanagauageList'));
        $this->set('_serialize', ['country']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Country id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
		
       
        $country =	$flag	= $this->Country->find('translations')
			->where([
				'id' => $id
			])->first();
		$flag	=	$country->flag;
        if ($this->request->is(['patch', 'post', 'put'])) {
			$validateData				=	$this->request->data['_translations'][$lanagauageList->code];
			$validateData['continent_id']	=	$this->request->data['continent_id'];		
			$validateData['slug']	=	$this->request->data['slug'];		
			$country = $this->Country->patchEntity($country, $validateData);
			
			if(!$country->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					if(empty($data['name'])){
						unset($data['name']);
					}
					if(empty($data['description'])){
						unset($data['description']);
					}
					$country->translation($lang)->set($data, ['guard' => false]);
				}
				$thisData	=	$this->request->data;
				// pr($thisData);die;
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, AMENITIES_ROOT_PATH.$return_file_name)){
						$country->flag						=		$return_file_name;
						$country->image							=		$return_file_name;
					}
				}else{
					$country->flag						=		$flag;
					$country->image							=		$flag;
				}
				$country->slug	=	$this->request->data['slug'];
				$this->Country->save($country);
				$this->Flash->success(__('The country has been saved.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The country could not be saved. Please, try again.'));
		}
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);	
		
		$Continents	=	$this->Country->Continents->find('list');		
		
        $this->set(compact('country','lanagauageList','Continents'));
        $this->set('_serialize', ['country']);
    /* 
        $country = $this->Country->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $country = $this->Country->patchEntity($country, $this->request->data);
            if ($this->Country->save($country)) {
                $this->Flash->success(__('The country has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The country could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('country'));
        $this->set('_serialize', ['country']); */
		
		
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file
    }

    /**
     * Delete method
     *
     * @param string|null $id Country id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $country = $this->Country->get($id);
		 $this->Country->City->deleteAll(['City.country_id' => $id]);
		 
        if ($this->Country->delete($country)) {
            $this->Flash->success(__('The country has been deleted.'));
        } else {
            $this->Flash->error(__('The country could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
