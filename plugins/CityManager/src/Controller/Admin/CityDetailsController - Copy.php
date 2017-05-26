<?php
namespace CityManager\Controller\Admin;

use App\Controller\Admin\AppController;


/**
 * CityDetails Controller
 *
 * @property \CityManager\Model\Table\CityDetailsTable $CityDetails
 */
class CityDetailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Countries']
        ];
        $cityDetails = $this->paginate($this->CityDetails);
		// pr($cityDetails);
		$model	=	$this->modelClass;
        $this->set(compact('cityDetails','model'));
        $this->set('_serialize', ['cityDetails']);
    }

    /**
     * View method
     *
     * @param string|null $id City Detail id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cityDetail = $this->CityDetails->get($id, [
            'contain' => ['Cities']
        ]);

        $this->set('cityDetail', $cityDetail);
        $this->set('_serialize', ['cityDetail']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cityDetail = $this->CityDetails->newEntity();
        if ($this->request->is('post')) {
			
            $cityDetail = 	$data = $this->CityDetails->patchEntity($cityDetail, $this->request->data);
			if(!$cityDetail->errors()){
				$object_id	=	$cityDetail->object_id;
				$slug		=	$data->name;
				$this->loadModel('CasinoImages');
				$image		=	$this->CasinoImages->find('all')->where(array('object_id' => $object_id))->order(['display_order' => 'ASC'])->first();
				$cityDetail->image	=	$image->file;
				$cityDetail->slug	=	$slug;
				$this->CityDetails->save($cityDetail);
				
				$this->Flash->success(__('The city detail has been saved.'));
				return $this->redirect(['action' => 'index']);
							
			}else {
                $this->Flash->error(__('The city detail could not be saved. Please, try again.'));
            }
        }
       
	    $this->loadModel('Countries');
	    $Countries  = $this->Countries->find('list', ['limit' => 300,'order' => 'name ASC']);
		
		$this->set(compact('cityDetail', 'cities', 'Countries'));
        $this->set('_serialize', ['cityDetail']);
		
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file
    }
	
	function slugable($slug, $controller = 'Casinos', $type = 'add'){		
		$slug		=	Inflector::slug($slug);
		$result		=	$this->{$controller}->find('all')->where(array('slug LIKE ' => $slug."%"))->order(['id' => 'DESC'])->count();
		
		if($result > 0){
			return $slug.'-'.($result);
		}
		return $slug;
	}
    /**
     * Edit method
     *
     * @param string|null $id City Detail id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cityDetail = $this->CityDetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cityDetail = $this->CityDetails->patchEntity($cityDetail, $this->request->data);
            if ($this->CityDetails->save($cityDetail)) {
                $this->Flash->success(__('The city detail has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The city detail could not be saved. Please, try again.'));
            }
        }
       
	    $this->loadModel('Countries');
	    $Countries  = $this->Countries->find('list', ['limit' => 300,'order' => 'name ASC']);
		
		$this->set(compact('cityDetail', 'cities', 'Countries'));
        $this->set('_serialize', ['cityDetail']);
		
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file
    }

    /**
     * Delete method
     *
     * @param string|null $id City Detail id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cityDetail = $this->CityDetails->get($id);
        if ($this->CityDetails->delete($cityDetail)) {
            $this->Flash->success(__('The city detail has been deleted.'));
        } else {
            $this->Flash->error(__('The city detail could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	function cutomerAutocomplete(){
		$this->loadModel('CityManager.Cities');
	
		$query 		= 	$this->request->query['q'];
		$query		=	explode('&',$query);
		$city		=	$query[0];
		$country_id	=	$query[1];
		
		$results = $this->Cities->find('all',array('conditions' => array('name LIKE "'.$city.'%"','country_id' => $country_id),'fields' => array('id','name'),'limit' => 7));
		
		
		echo json_encode($results);
		exit;
	}	
}
