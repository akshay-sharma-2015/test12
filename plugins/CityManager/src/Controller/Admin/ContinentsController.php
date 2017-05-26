<?php
namespace CityManager\Controller\Admin;
use App\Controller\Admin\AppController;

use Cake\I18n\I18n;
/**
 * Continents Controller
 *
 * @property \CityManager\Model\Table\ContinentsTable $Continents
 */
class ContinentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->set('model',$this->modelClass);
		
        $country = $this->paginate($this->Continents);

        $this->set(compact('country'));
        $this->set('_serialize', ['country']);
    }

    /**
     * View method
     *
     * @param string|null $id Continent id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $continent = $this->Continents->get($id, [
            'contain' => ['Countries']
        ]);

        $this->set('continent', $continent);
        $this->set('_serialize', ['continent']);
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
		
        $country = $this->Continents->newEntity();
		
        if ($this->request->is('post')) {
			
			$validateData				=	$this->request->data['_translations'][$lanagauageList->code];
		
			$validateData['image']		=	isset($this->request->data['image']) ? $this->request->data['image'] : '';			
			$validateData['back_image']	=	isset($this->request->data['back_image']) ? $this->request->data['back_image'] : '';
			$validateData['head_image']	=	isset($this->request->data['head_image']) ? $this->request->data['head_image'] : '';		
			$validateData['page_title']	=	isset($this->request->data['page_title']) ? $this->request->data['page_title'] : '';		
			$validateData['meta_description']	=	isset($this->request->data['meta_description']) ? $this->request->data['meta_description'] : '';
			
			$country = $this->Continents->patchEntity($country, $validateData);
			// pr($country->errors());
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
				$thisData		=	$this->request->data;		
				
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$country->image						=		$return_file_name;
						sleep(1);
					}
				}
				
				if(!empty($thisData['back_image']['name'])){
					$file_name         						=     $thisData['back_image']['name'];
					$tmp_name          						=     $thisData['back_image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$country->back_image						=		$return_file_name;sleep(1);
					}
				}

				if(!empty($thisData['head_image']['name'])){
					$file_name         						=     $thisData['head_image']['name'];
					$tmp_name          						=     $thisData['head_image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$country->head_image						=		$return_file_name;sleep(1);
					}
				}
				// $country->slug		=	$this->request->data['_translations']['en']['name'];
				
				$this->Continents->save($country);
				$this->Flash->success(__('The continents has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The continents could not be saved. Please, try again.'));
		}
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		
        $this->set(compact('country','lanagauageList'));
        $this->set('_serialize', ['country']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Continent id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
		
       
        $country =	$flag	= $this->Continents->find('translations')
			->where([
				'id' => $id
			])->first();
		$image		=	$country->image;
		$back_image	=	$country->back_image;
		$head_image	=	$country->head_image;
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			$validateData				=	$this->request->data['_translations'][$lanagauageList->code];
			$validateData['image']		=	isset($this->request->data['image']) ? $this->request->data['image'] : '';			
			$validateData['back_image']	=	isset($this->request->data['back_image']) ? $this->request->data['back_image'] : '';
			$validateData['head_image']	=	isset($this->request->data['head_image']) ? $this->request->data['head_image'] : '';
			$validateData['page_title']	=	isset($this->request->data['page_title']) ? $this->request->data['page_title'] : '';		
			$validateData['meta_description']	=	isset($this->request->data['meta_description']) ? $this->request->data['meta_description'] : '';
			
			$country = $this->Continents->patchEntity($country, $validateData);
			
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
				
					$thisData		=	$this->request->data;				
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$country->image						=		$return_file_name;
						@unlink(GALLERY_ROOT_PATH.$image);
					}
				}else{
					$country->image						=		$image;
				}
				sleep(1);
				if(!empty($thisData['back_image']['name'])){
					$file_name         						=     $thisData['back_image']['name'];
					$tmp_name          						=     $thisData['back_image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$country->back_image						=		$return_file_name;
						@unlink(GALLERY_ROOT_PATH.$image);
					}
				}else{
					$country->back_image						=		$back_image;
				}
				sleep(1);
				if(!empty($thisData['head_image']['name'])){
					$file_name         						=     $thisData['head_image']['name'];
					$tmp_name          						=     $thisData['head_image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$country->head_image						=		$return_file_name;
					}
				}else{
					$country->head_image						=		$head_image;
				}
				
				$this->Continents->save($country);
				$this->Flash->success(__('The continent has been saved.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('The continent could not be saved. Please, try again.'));
		}
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		
        $this->set(compact('country','lanagauageList'));
        $this->set('_serialize', ['country']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Continent id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $continent = $this->Continents->get($id);
        if ($this->Continents->delete($continent)) {
            $this->Flash->success(__('The continent has been deleted.'));
        } else {
            $this->Flash->error(__('The continent could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
