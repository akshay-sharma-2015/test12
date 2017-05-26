<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\Event;
class UsersController extends AppController
{
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'logout']);
    }
	
	 public function add()
    {
		$this->viewBuilder()->layout('login');
		$user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }
	/**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
		parent::beforeRender($event);
		$this->Set('model',$this->modelClass);
	}
	
	function editProfile(){
		$result	 = $this->Users->get($this->Auth->user('id'));
		if ($this->request->is(['post', 'put'])) {
			$result	=	$this->Users->patchEntity(
											$result, 
											$this->request->data, 
											[ 'validate' => 'adminEditProfile']
										);
			if(!$result->errors()){	
				$result->username	=	$result->email;
				if ($this->{$this->modelClass}->save($result)) {
					$this->Flash->success(__('Information updated successfully.'));
					return $this->redirect(['action' => 'dashboard']);
				}
			}
			$this->Flash->error(__('Unable to update your information.'));
		}
		$this->set('result', $result);
	}
	
	public function login()
	{
		
		$userRole	=	$this->Auth->user('role');
		if(isset($userRole) && $userRole == 'admin'){
			$this->redirect('/admin/users/dashboard');
		}
		$this->viewBuilder()->layout('login');
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				$this->redirect('/admin/users/dashboard');
			}else{
				
				$this->Flash->error1('Your username or password is incorrect.');
			}
		}
		
	}
	 public function dashboard()
    {
		
		$currMonth		=	Date('m');
		$clinicUser		=	array();
		$patientUser	=	array();
		$doctorUser	=	array();
		for ($i=0; $i<=11; $i++) {
			$month	=	 date('Y-m', strtotime("-$i month"));
			$month1	=	 date('M', strtotime("-$i month"));
			$clinicUser[$month1]	=	$this->{$this->modelClass}->find('all',array('conditions' => array('created LIKE "%'.$month.'%"', 'is_deleted' => 0)))->count();
			$patientUser[$month1]	=	$this->{$this->modelClass}->find('all',array('conditions' => array('created LIKE "%'.$month.'%"', 'is_deleted' => 0)))->count();
			$doctorUser[$month1]	=	$this->{$this->modelClass}->find('all',array('conditions' => array('created LIKE "%'.$month.'%"', 'is_deleted' => 0)))->count();
		}  
		
		
		$this->set('clinicUser',array_reverse($clinicUser));
		$this->set('patientUser',array_reverse($patientUser));
		$this->set('doctorUser',array_reverse($doctorUser));
		
    }
	
	public function logout(){
       $this->Auth->logout();
	   $this->redirect(WEBSITE_ADMIN_URL);
    }
	
	 public function index()
    {
		$query = $this->Users->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where([$name.' LIKE' => '%'.$value.'%']);			
		
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = ['sortWhitelist' => ['address', 'title','phone','country_name','state_name'],'contain' => ['UserProfiles']];
		
		$query->where(['role !=' => 'admin']);
		$query->where(['is_deleted !=' => '1']);
		
        $users = $this->paginate($query);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);

    }
	
	  /**
     * Delete method
     *
     * @param string|null $id Master id.
	 * @param string|null $type Master type.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $master = $this->Users->get($id);
		
		$master->is_deleted	=	1;
        if ($this->Users->save($master)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	 public function veryfy($id = null)
    {
		$this->request->allowMethod(['post', 'delete']);
        $master = $this->Users->get($id);
		
		$master->is_verified 	=	1;
        if ($this->Users->save($master)) {
            $this->Flash->success(__('The user has been verified.'));
        } else {
            $this->Flash->error(__('The user could not be verified. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
