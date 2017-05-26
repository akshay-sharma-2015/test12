<?php
namespace CityManager\Controller\Admin;
use App\Controller\Admin\AppController;


/**
 * LanPageCity Controller
 *
 * @property \CityManager\Model\Table\LanPageCityTable $LanPageCity
 */
class LanPageCityController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->set('model',$this->modelClass);
		
        $this->paginate = [
            'contain' => ['Cities'/* ,'Cities.Country' */]
        ];
        $city = $this->paginate($this->LanPageCity);

        $this->set(compact('city'));
        $this->set('_serialize', ['city']);
    }

    /**
     * View method
     *
     * @param string|null $id Lan Page City id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lanPageCity = $this->LanPageCity->get($id, [
            'contain' => ['Cities']
        ]);

        $this->set('lanPageCity', $lanPageCity);
        $this->set('_serialize', ['lanPageCity']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lanPageCity = $this->LanPageCity->newEntity();
        if ($this->request->is('post')) {
            $lanPageCity = $this->LanPageCity->patchEntity($lanPageCity, $this->request->data);
			// pr($lanPageCity->errors());
			if(!$lanPageCity->errors()){
				$thisData		=	$this->request->data;				
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$lanPageCity->image						=		$return_file_name;
					}
				}
				
				if ($this->LanPageCity->save($lanPageCity)) {
					
					$this->Flash->success(__('Information has been saved.'));

					return $this->redirect(['action' => 'index']);
				}
			}
			$this->Flash->error(__('Information could not be saved. Please, try again.'));
        }
        $cities = $this->LanPageCity->Cities->find('list', ['limit' => 200]);
        $this->set(compact('lanPageCity', 'cities'));
        $this->set('_serialize', ['lanPageCity']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Lan Page City id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lanPageCity = $this->LanPageCity->get($id, [
            'contain' => ['Cities']
        ]);
		$img = $lanPageCity->image;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lanPageCity = $this->LanPageCity->patchEntity($lanPageCity, $this->request->data);
			if(!$lanPageCity->errors()){
				$thisData		=	$this->request->data;				
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$lanPageCity->image						=		$return_file_name;
					}
				}else{
					$lanPageCity->image 	=	$img;
				}
					
				if ($this->LanPageCity->save($lanPageCity)) {
					$this->Flash->success(__('Information has been saved.'));

					return $this->redirect(['action' => 'index']);
				}
			}
			$this->Flash->error(__('Information could not be saved. Please, try again.'));
        }
		
        $cities = $this->LanPageCity->Cities->find('list', ['limit' => 200]);
        $this->set(compact('lanPageCity', 'cities'));
        $this->set('_serialize', ['lanPageCity']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lan Page City id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lanPageCity = $this->LanPageCity->get($id);
        if ($this->LanPageCity->delete($lanPageCity)) {
            $this->Flash->success(__('Information has been deleted.'));
        } else {
            $this->Flash->error(__('Information could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function cityAutocomplete(){
		$query 		= 	$this->request->query['q'];
		
		$results 	= 	$this->LanPageCity->Cities->find('all')/* ->contain(['Country']) */->where(['title LIKE' => '%'.$query.'%','type' => 'normal'])->limit(7)->toList();
		
		echo json_encode($results);
		exit;
	}	
}
