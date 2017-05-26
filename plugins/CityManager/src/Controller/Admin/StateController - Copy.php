<?php
namespace CityManager\Controller\Admin;
use App\Controller\Admin\AppController;
use Cake\Event\Event;
/**
 * State Controller
 *
 * @property \CityManager\Model\Table\StateTable $State
 */
class StateController extends AppController
{

	public $components = ['Paginator'];
	
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
		$this->set('model',$this->modelClass);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Country']
        ];
        $state = $this->paginate($this->State);

        $this->set(compact('state'));
        $this->set('_serialize', ['state']);
    }

    /**
     * View method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $state = $this->State->get($id, [
            'contain' => ['Country', 'City']
        ]);

        $this->set('state', $state);
        $this->set('_serialize', ['state']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $state = $this->State->newEntity();
        if ($this->request->is('post')) {
            $state = $this->State->patchEntity($state, $this->request->data);
            if ($this->State->save($state)) {
                $this->Flash->success(__('The state has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The state could not be saved. Please, try again.'));
            }
        }
        $Country = $this->State->Country->find('list', ['limit' => 200]);
        $this->set(compact('state', 'Country'));
        $this->set('_serialize', ['state']);
    }

    /**
     * Edit method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $state = $this->State->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $state = $this->State->patchEntity($state, $this->request->data);
            if ($this->State->save($state)) {
                $this->Flash->success(__('The state has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The state could not be saved. Please, try again.'));
            }
        }
        $Country = $this->State->Country->find('list', ['limit' => 200]);
        $this->set(compact('state', 'Country'));
        $this->set('_serialize', ['state']);
    }

    /**
     * Delete method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $state = $this->State->get($id);
        if ($this->State->delete($state)) {
            $this->Flash->success(__('The state has been deleted.'));
        } else {
            $this->Flash->error(__('The state could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
