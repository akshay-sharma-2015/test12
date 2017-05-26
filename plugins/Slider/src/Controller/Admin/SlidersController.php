<?php
namespace Slider\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\I18n\I18n;
use Cake\Filesystem\Folder;

/**
 * Sliders Controller
 *
 * @property \Slider\Model\Table\SlidersTable $Sliders
 */
class SlidersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $sliders = $this->paginate($this->Sliders);

        $this->set(compact('sliders'));
        $this->set('_serialize', ['sliders']);
    }

    /**
     * View method
     *
     * @param string|null $id Slider id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $slider = $this->Sliders->get($id, [
            'contain' => []
        ]);

        $this->set('slider', $slider);
        $this->set('_serialize', ['slider']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $slider = $this->Sliders->newEntity();   
		$this->loadModel('Languages');
		if ($this->request->is('post')) {			
			$defaultLang			=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();		
			$validateData			=	$this->request->data['_translations'][$defaultLang->code];			
			$validateData['image']	=	$this->request->data['image'];			
			$slider 				= 	$this->Sliders->patchEntity($slider, $validateData);
			
			if(!$slider->errors()){
				if(!file_exists(SLIDER_ROOT_PATH)){
					new Folder(SLIDER_ROOT_PATH, true, 0755);						
				}		
				$thisData	=	$this->request->data;
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, SLIDER_ROOT_PATH.$return_file_name)){
						$slider->image						=		$return_file_name;
					}
				}
				
				foreach ($this->request->data['_translations'] as $lang => $data) {
					$slider->translation($lang)->set($data, ['guard' => false]);
				}
				
				$this->Sliders->save($slider);
				$this->Flash->success('Image has been saved.');
				return $this->redirect(['action' => 'index']);
				
			}else {
				$this->Flash->error(__('Image could not be saved. Please, try again.')); 
			}
        }
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);
        $this->set(compact('slider','lanagauageList'));
        $this->set('_serialize', ['slider']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Slider id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
       $slider	=	$result = $this->Sliders->find('translations')
			->where([
				'id' => $id
			])->first();
			
		$this->loadModel('Languages');
        if ($this->request->is(['patch', 'post', 'put'])) {
			$orimage				=	$result->image;
			$defaultLang			=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();		
			$validateData			=	$this->request->data['_translations'][$defaultLang->code];			
			$validateData['image']	=	$this->request->data['image'];			
			$slider 				= 	$this->Sliders->patchEntity($slider, $validateData);
			
			if(!$slider->errors()){			
				$thisData	=	$this->request->data;
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, SLIDER_ROOT_PATH.$return_file_name)){
						$slider->image						=		$return_file_name;
					}
				}else{
					$slider->image							=		$orimage;
				}
				
				foreach ($this->request->data['_translations'] as $lang => $data) {
					$slider->translation($lang)->set($data, ['guard' => false]);
				}
				
				$this->Sliders->save($slider);
				$this->Flash->success('Image has been saved.');
				return $this->redirect(['action' => 'index']);
				
			}else {
				$this->Flash->error(__('Image could not be saved. Please, try again.')); 
			}
        }
		
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);
        $this->set(compact('slider','lanagauageList'));
        $this->set('_serialize', ['slider']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Slider id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $slider = $this->Sliders->get($id);
        if ($this->Sliders->delete($slider)) {
            $this->Flash->success(__('The slider has been deleted.'));
        } else {
            $this->Flash->error(__('The slider could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
