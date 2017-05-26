<?php
namespace Cms\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\I18n\I18n;

/**
 * CmsPages Controller
 *
 * @property \Cms\Model\Table\CmsPagesTable $CmsPages
 */
class CmsPagesController extends AppController
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
            'order' => ['CmsPages.id DESC']
        ];
		I18n::locale($lanagauageList->code);		
		$query = $this->CmsPages->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where(['CmsPages_title_translation.content  LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = ['sortWhitelist' => ['title','description']];

				
        $cmsPages = $this->paginate($query);
       
		$this->set(compact('cmsPages'));
        $this->set('_serialize', ['cmsPages']);
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
		
        $cmsPage = $this->CmsPages->newEntity();
        if ($this->request->is('post')) {
			$cmsPage = $this->CmsPages->patchEntity($cmsPage, $this->request->data['_translations'][$lanagauageList->code]);
			if(!$cmsPage->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					if(empty($data['name'])){
						unset($data['name']);
					}
					if(empty($data['description'])){
						unset($data['description']);
					}
					$cmsPage->translation($lang)->set($data, ['guard' => false]);
				}
				$this->CmsPages->save($cmsPage);
				$this->Flash->success(__('The cms page has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The cms page could not be saved. Please, try again.'));
        }		
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		$this->set(compact('cmsPage','lanagauageList'));
        $this->set('_serialize', ['cmsPage']);
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
		
		$cmsPage = $this->CmsPages->find('translations')
			->where([
				'id' => $id
			])->first();
		if ($this->request->is(['patch', 'post', 'put'])) {		
			$cmsPage = $this->CmsPages->patchEntity($cmsPage, $this->request->data['_translations'][$lanagauageList->code]);
			
			if(!$cmsPage->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					if(empty($data['name'])){
						unset($data['name']);
					}
					if(empty($data['description'])){
						unset($data['description']);
					}
					$cmsPage->translation($lang)->set($data, ['guard' => false]);
				}
				$this->CmsPages->save($cmsPage);
				$this->Flash->success(__('The cms page has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}
			$this->Flash->error(__('The cms page could not be saved. Please, try again.'));
        }
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		$this->set(compact('cmsPage','lanagauageList'));
        $this->set('_serialize', ['cmsPage']);
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
        $cmsPage = $this->CmsPages->get($id);
        if ($this->CmsPages->delete($cmsPage)) {
            $this->Flash->success(__('The cms page has been deleted.'));
        } else {
            $this->Flash->error(__('The cms page could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
