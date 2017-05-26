<?php
namespace EmailTemplate\Controller\Admin;
use App\Controller\Admin\AppController;

/**
 * EmailTemplates Controller
 *
 * @property \App\Model\Table\EmailTemplatesTable $EmailTemplates
 */
class EmailTemplatesController extends AppController
{
	
	public $components = ['Paginator'];
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    { 
        $this->paginate = [
            // 'contain' => ['Actions']
        ];
		$query = $this->EmailTemplates->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where([$name.' LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = ['sortWhitelist' => ['subject']];

		$this->set('model',$this->modelClass);
		
        $emailTemplates = $this->paginate($query);
        $this->set(compact('emailTemplates'));
        $this->set('_serialize', ['emailTemplates']);
    }

    /**
     * View method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => ['Actions']
        ]);

        $this->set('emailTemplate', $emailTemplate);
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $emailTemplate = $this->EmailTemplates->newEntity();
        if ($this->request->is('post')) {
            $emailTemplate = $this->EmailTemplates->patchEntity($emailTemplate, $this->request->data);
			
			if ($this->EmailTemplates->save($emailTemplate)) {
                $this->Flash->success(__('The email template has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The email template could not be saved. Please, try again.'));
            }
        }
        $actions = $this->EmailTemplates->Actions->find('list', ['limit' => 200,'keyField' => 'id','valueField' => 'action']);
		
		$this->set(compact('emailTemplate', 'actions'));
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $emailTemplate = $this->EmailTemplates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $emailTemplate = $this->EmailTemplates->patchEntity($emailTemplate, $this->request->data);
            if ($this->EmailTemplates->save($emailTemplate)) {
                $this->Flash->success(__('The email template has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The email template could not be saved. Please, try again.'));
            }
        } 
		$actions = $this->EmailTemplates->Actions->find('list', ['limit' => 200,'keyField' => 'id','valueField' => 'action']);
        $this->set(compact('emailTemplate', 'actions'));
        $this->set('_serialize', ['emailTemplate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Email Template id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $emailTemplate = $this->EmailTemplates->get($id);
        if ($this->EmailTemplates->delete($emailTemplate)) {
            $this->Flash->success(__('The email template has been deleted.'));
        } else {
            $this->Flash->error(__('The email template could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	
	function getConsatant($id=''){
		$this->viewBuilder()->layout('ajax');
		$this->loadModel('Action');
		$res			=	$this->EmailTemplates->Actions->get($id);
		// pr($res->constant);
		$constant		=	explode(',',$res->constant);
		// $this->layout	=	false;
		
		$this->set('constant',$constant);
	}
	
	public function add_action() {
		if(!empty($this->data)){
			$savaData	=	array();
			$saveData['action']		=	$this->data[$this->modelClass]['action'];
			$saveData['constant']	=	implode(',',$this->data[$this->modelClass]['constant']);
			$this->loadModel('Action');
			$this->Action->save($saveData);
			
		}
	}
}
