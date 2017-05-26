<?php
namespace Setting\Controller\Admin;

use App\Controller\Admin\AppController;
/* use Cake\Event\Event; */
class SettingsController extends AppController
{

    public $components = ['Paginator'];
	
	public $paginate = [
        'limit' => 10,
        'order' => [
            'Settings.id' => 'desc'
        ]
    ];
	
/* 	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
		$this->set('model',$this->modelClass);
    } */
/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	
	function index($search = null){
		$this->set('model',$this->modelClass);
		$query = $this->Settings->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page')
					continue;
				$query->where([$name.' LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		$result = $this->paginate($query);
        $this->set(compact('result'));
    } 
	
	 /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('model',$this->modelClass);
        $setting = $this->Settings->newEntity();
        if ($this->request->is('post')) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
			
            if ($this->Settings->save($setting)) {
                $this->Flash->success(__('The setting has been saved.'));
				$this->file_();
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The setting could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('setting'));
        $this->set('_serialize', ['setting']);
		
    }

    /**
     * Edit method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('model',$this->modelClass);
        $setting = $this->Settings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $setting = $this->Settings->patchEntity($setting, $this->request->data);
            if ($this->Settings->save($setting)) {
                $this->Flash->success(__('The setting has been saved.'));
				$this->file_();
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The setting could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('setting'));
        $this->set('_serialize', ['setting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$this->set('model',$this->modelClass);
        // $this->request->allowMethod(['post', 'delete']);
        $setting = $this->Settings->get($id);
        if ($this->Settings->delete($setting)) {
            $this->Flash->success(__('The setting has been deleted.'));
        } else {
            $this->Flash->error(__('The setting could not be deleted. Please, try again.'));
        }
		$this->file_();
        return $this->redirect(['action' => 'index']);
    }
	
	public function view($key='') {
		$this->set('model',$this->modelClass);
		if($key == ''){
			$this->redirect(array('plugin' => '','controller' => 'users','action' => 'dashboard'));
		}
		if(!empty($this->request->data)){
			$data	=	$this->request->data;
			foreach($data as $key1 => $value){
				if(isset($value['name']) && !empty($value['name'])){
					$file_name         				=     $value['name'];
					
					$ext = pathinfo($file_name, PATHINFO_EXTENSION);
					if(in_array($ext,Configure::read('allowed_image.extensions'))){
						$tmp_name          				=     $value['tmp_name'];
						$return_file_name   			=     $this->change_file_name($file_name);
						
						if($this->moveUploadedFile($tmp_name, SETTING_IMG_ROOT_PATH.$return_file_name)){
							$this->{$this->modelClass}->id	=	$key1;
							$this->{$this->modelClass}->saveField('value',SETTING_IMG_URL.$return_file_name);
						}
					}
				}else{
					$res 		= $this->Settings->find('all')->where(['id' => $key1])->first();
					
					$res->value = $value;
					$this->Settings->save($res);
				}
			}
			$this->file_();
			$this->Flash->success(__('Setting updated successfully.'));
		}
		
		/* $this->Flash->success(__('Setting updated successfully.')); */
		$res	=	$this->Settings->find('all')
							->where(['key_name LIKE' => $key.'%'])
							->order(['order_by' => 'ASC']);
							
		$this->set('key',$key);
		$this->set('res',$res);
		$this->set('model',$this->modelClass);
	}
	
	function file_(){
		$res	=	$this->Settings->find('all');
		
		$files2	=	'<?php use Cake\Core\Configure; '."\n";
		foreach($res as $val){
			$key	=	$val->key_name;
			$value	=	trim($val->value,'"');
			
			$value	=	str_replace('"',"'",$value);
			
			$files2	.=	'$config["'.$key.'"] = "'.$value.'";'."\n";
		}		
		$files2	.=	'?>';
		$file2	=	fopen(ROOT.'/settings.php','w');		
		fwrite($file2,$files2);
		fclose($file2);
	}
	
	
	
	public function active($id ='',$status,$slug = '') {
		$this->set('model',$this->modelClass);
		if($id == ''){
			$this->redirect(array('action' => 'index'));
		}
		$this->{$this->modelClass}->id	=	$id;
		$status	=	($status == 1) ? 0 : 1;
		$this->{$this->modelClass}->saveField('is_active',$status);
		$this->Session->setFlash('Status changed successfully','success');
		$this->redirect(array('action' => 'index',$slug));
		
	}
}
