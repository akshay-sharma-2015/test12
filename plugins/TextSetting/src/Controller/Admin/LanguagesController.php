<?php
namespace TextSetting\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Languages Controller
 *
 * @property \TextSetting\Model\Table\LanguagesTable $Languages
 */
class LanguagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $languages = $this->paginate($this->Languages);

        $this->set(compact('languages'));
        $this->set('_serialize', ['languages']);
    }

    /**
     * View method
     *
     * @param string|null $id Language id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $language = $this->Languages->get($id, [
            'contain' => ['TextSettings']
        ]);

        $this->set('language', $language);
        $this->set('_serialize', ['language']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $language = $this->Languages->newEntity();
        if ($this->request->is('post')) {
            $language = $this->Languages->patchEntity($language, $this->request->data);
            if ($this->Languages->save($language)) {
                $this->Flash->success(__('The language has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The language could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('language'));
        $this->set('_serialize', ['language']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Language id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $language = $this->Languages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $language = $this->Languages->patchEntity($language, $this->request->data);
            if ($this->Languages->save($language)) {
                $this->Flash->success(__('The language has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The language could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('language'));
        $this->set('_serialize', ['language']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Language id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $language = $this->Languages->get($id);
        if ($this->Languages->delete($language)) {
            $this->Flash->success(__('The language has been deleted.'));
        } else {
            $this->Flash->error(__('The language could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	
	public function active($id ='',$status) {
		if($id == ''){
			$this->redirect(array('action' => 'index'));
		}
		
		$languages  =	 $this->Languages->find('all')->where(['id' => $id])->first();
		$status		=	 ($status == 1) ? 0 : 1;
		
		$languages->is_active = $status;
		$this->Languages->save($languages);
		
		$this->Flash->success('Status changed successfully');
		$this->redirect(array('action' => 'index'));
	}
	public function defaultLanguage($id ='') {
		if($id == ''){
			$this->redirect(array('action' => 'index'));
		}
		

		$this->Languages->updateAll(['is_default' => 0],['is_default' => 1]);
		
		
		$languages  =	 $this->Languages->find('all')->where(['id' => $id])->first();
		
		$languages->is_active = 1;
		$languages->is_default = 1;
		$this->Languages->save($languages);
		
		$this->Flash->success('Status changed successfully');
		$this->redirect(array('action' => 'index'));

	}
}
