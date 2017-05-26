<?php
namespace App\Controller;

//use App\Controller\AppController;
use Cake\Event\Event;
//use Cake\Network\Session\DatabaseSession;
use Cake\ORM\TableRegistry;
//use Cake\Utility\Inflector;
//use Cake\View\View;
use Cake\Core\Configure;
//use Cake\Cache\Cache;
//use Cake\Network\Exception\NotFoundException;

class UsersController extends AppController
{
	
	// public $components = ['Cache.Cache'];
	
	public function initialize()
    {//sleep(100);
      parent::initialize();
      $this->loadComponent('Captcha');
      $this->loadComponent('Cookie');
	  
	 /*   $this->loadComponent('Cache.Cache', [
        'actions' => ['index', 'view' => DAY, 'index' => HOUR]
		]); */
    }
	
	function captcha()	{
        $this->autoRender = false;
		$this->viewBuilder()->layout('ajax');
        $this->Captcha->create();
	}
	
	public function beforeFilter(Event $event)
    {
		if($this->request->params['action'] == 'validationCheck'){
			$this->eventManager()->off($this->Csrf);
		}
		parent::beforeFilter($event);
        $this->Auth->allow(array('index','login','signup','jobAdd','jobListing','contactUs','validationCheck','blog'));
    }

    public function index(){
		$pageTitle			=	__('title.homepage');
		$metaDescription	=	__('metadescription.homepage');
		
		$this->loadModel('Slider.Sliders');
		$sliders = $this->Sliders->find('translations')->all()->toList();
		$this->set(compact("sliders"));
	}
	
	function login($tab = 'login'){
		if ($this->request->is('post')) {
			if($this->request->data['type'] == 'register'){
				$user = $this->Users->newEntity();
				$this->request->data 	=	$this->sanitizeData($this->request->data);
				$user = $this->{$this->modelClass}->patchEntity(
												$user, 
												$this->request->data, 
												[ 'validate' => 'signUpForm']
											);
				if($user->errors()){
					$this->Flash->error(__('Something going wrong.'));					
				}else{
					$this->loadModel('Users');
					$user->username	=	$this->request->data['email'];
					$user->role		=	FRONT_USER;
					$this->Users->save($user);
					$userId			=	$user->id;
					
					$userProfiles				=	array();
					$userProfiles				=	[
						['fleld_name' => 'comapny','field_value'=>	$this->request->data['comapny'],'user_id' => $userId],
						['fleld_name' => 'title','field_value'	=>	$this->request->data['title'],'user_id' => $userId],
						['fleld_name' => 'office_phone','field_value'	=>	$this->request->data['office_phone'],'user_id' => $userId],
						['fleld_name' => 'mobile_phone','field_value'	=>	$this->request->data['mobile_phone'],'user_id' => $userId],
						['fleld_name' => 'street_address','field_value'	=>	$this->request->data['street_address'],'user_id' => $userId],
						['fleld_name' => 'city','field_value'	=>	$this->request->data['city'],'user_id' => $userId],
						['fleld_name' => 'state','field_value'	=>	$this->request->data['state'],'user_id' => $userId],
						['fleld_name' => 'state','field_value'	=>	$this->request->data['state'],'user_id' => $userId],
						['fleld_name' => 'zip','field_value'	=>	$this->request->data['zip'],'user_id' => $userId],
						['fleld_name' => 'website','field_value'	=>	$this->request->data['website'],'user_id' => $userId]
					];
					
					$articles = TableRegistry::get('UserProfiles');
					$entities = $articles->newEntities($userProfiles);
					$result = $articles->saveMany($entities);
					
					$this->Flash->success(__('Your account will be activated after admin approval.'));
					return $this->redirect(['action' => 'login']);					
				}
				
			}else{
				$user = $this->Auth->identify();
				if ($user) {
					if ($user['is_verified']){					
						$this->Auth->setUser($user);
						$data['success']	=	true;
						if(isset($this->request->data['remember_me']) && $this->request->data['remember_me']){
							$this->Cookie->configKey('login', 'expires', '+3 months');
							$this->Cookie->write('login',json_encode($this->request->data));
						}
						return $this->redirect(['controller' => 'globalusers','action' => 'index']);
					}
					$this->Auth->logout();
					$this->Flash->error(__('Your account is not verified by admin.',true));
				}else{
					$this->Flash->error(__('Your username or password is incorrect.',true));
				}
				$tab	=	'login';
			}
		}
		$this->set("tab",$tab);
	}
	
	
	
	function logout(){
		if($this->Cookie->check('login')){
			$this->Cookie->delete('login');			
		}
		return $this->redirect($this->Auth->logout());
	}
	
	function signup($tab = 'register'){
		if($this->Auth->user()){
			return $this->redirect(['action' => 'index']);
		}		
		$this->login($tab);
		
		$this->render("login");        
	}
	public function contactUs(){
		$user = $this->{$this->modelClass}->newEntity();
		if ($this->request->is('post')) {
			$this->request->data 	=	$this->sanitizeData($this->request->data);

			// $this->{$this->modelClass}->setCaptcha('securitycode', $this->Captcha->getCode('securitycode'));
			
			$user = $this->{$this->modelClass}->patchEntity(
											$user, 
											$this->request->data, 
											[ 'validate' => 'contactUsForm']
										);
			// pr($user->errors());
			if($user->errors()){				
				$this->Flash->error(__('Something went wrong.'));
			}else{
				$this->loadModel('Contact.Contacts');
				$this->Contacts->save($user);
				
				$this->Flash->success(__('Thanks for contact with us'));
				return $this->redirect(array('action' => 'contactUs'));
			}
        }
		
		
		$pageTitle			=	__('title.contact');
		$metaDescription	=	__('metadescription.contact');
    }
	
	public function changeLang()
    {
		$langId	=	(!empty($this->request->data['val'])) ? $this->request->data['val'] : 'en';
		$this->request->session()->write('Config.language', $langId);
		exit;
    }
	
	public function cmsSlug($slug = null)
    {
		
		$this->loadModel('Cms.CmsPages');
		$result = $this->CmsPages->find('translations')
			->where([
				'CmsPages.slug' => $slug
			])->first();
			
		$slugName	=	'cms_slug';
		if(empty($result)){
			$this->redirect(array('action' => 'index'),301);
		}
		$pageTitle			=	__('title.'.$slug);
		$metaDescription	=	__('metadescription.'.$slug);
		
		$this->set(compact('pageTitle','metaDescription','slugPass','result','slug','slugName'));
    }
	
	function facebook(){
		require_once  ROOT. '/vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
		$fb = new \Facebook\Facebook([
			  'app_id' => '1069561843098094',
			  'app_secret' => 'b308613114a12568fe7ce91bfea98180',
			  'default_graph_version' => 'v2.6',
			  //'default_access_token' => '{access-token}', // optional
			]);
		$helper = $fb->getRedirectLoginHelper();

		try {
		  $accessToken = $helper->getAccessToken();
		  
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}


		$permissions = ['email']; // Optional permissions
		$loginUrl = $helper->getLoginUrl('http://www.casinolineup.com/users/facebook2', $permissions);


		// echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
		header('Location:'.$loginUrl);
		exit;
	}
	
	function facebook2(){
		
		require_once  ROOT. '/vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
		$fb = new \Facebook\Facebook([
			  'app_id' => '1069561843098094',
			  'app_secret' => 'b308613114a12568fe7ce91bfea98180',
			  'default_graph_version' => 'v2.6',
			  //'default_access_token' => '{access-token}', // optional
			]);
		$helper = $fb->getRedirectLoginHelper();


			try {
			  $accessToken = $helper->getAccessToken();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  // When validation fails or other local issues
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}

			if (! isset($accessToken)) {
			  if ($helper->getError()) {
				header('HTTP/1.0 401 Unauthorized');
				echo "Error: " . $helper->getError() . "\n";
				echo "Error Code: " . $helper->getErrorCode() . "\n";
				echo "Error Reason: " . $helper->getErrorReason() . "\n";
				echo "Error Description: " . $helper->getErrorDescription() . "\n";
			  } else {
				header('HTTP/1.0 400 Bad Request');
				echo 'Bad request';
			  }
			  exit;
			}

			// The OAuth 2.0 client handler helps us manage access tokens
			$oAuth2Client = $fb->getOAuth2Client();

			// Get the access token metadata from /debug_token
			$tokenMetadata = $oAuth2Client->debugToken($accessToken);
			
			// Validation (these will throw FacebookSDKException's when they fail)
			$tokenMetadata->validateAppId('1069561843098094'); // Replace {app-id} with your app id
			// If you know the user ID this access token belongs to, you can validate it here
			//$tokenMetadata->validateUserId('123');
			$tokenMetadata->validateExpiration();

			if (! $accessToken->isLongLived()) {
			  // Exchanges a short-lived access token for a long-lived one
			  try {
				$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			  } catch (Facebook\Exceptions\FacebookSDKException $e) {
				echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
				exit;
			  }
			}
			
			$fb_access_token = (string) $accessToken;


		$fb->setDefaultAccessToken($fb_access_token);
		$response = $fb->get('/me?locale=en_US&fields=name,email');
		$userNode = $response->getGraphUser();
		
		$name	=	$userNode->getField('name');
		$email	=	$userNode->getField('email');
		$id		=	$userNode->getField('id');
		
		$users	=	$this->Users->find('all')->where(['facebook_id' => $id,'is_deleted' => 0])->first();
		
		if(empty($users->id) && !empty($email))
			$users	=	$this->Users->find('all')->where(['email' => $email,'is_deleted' => 0])->first();
		
		if(empty($users)){
			$user = $this->Users->newEntity();

			$user->username		=	$email;
			$user->email		=	$email;
			$user->full_name	=	$name;
			$user->facebook_id	=	$id;
			$user->role			=	FRONT_USER;
			$this->Users->save($user);
			
			$users	=	$this->Users->find('all')->where(['facebook_id' => $id,'is_deleted' => 0])->first();
			$userId	=	$users->id;
			$this->loadModel('UserPreference');
			$preference		=	Configure::read('preference');
			foreach($preference as $key1){
				foreach($key1 as $key => $val){
					$userPreference 			= 	$this->UserPreference->newEntity();
					$userPreference->type		=	'account';
					$userPreference->user_id	=	$userId;
					$userPreference->key_name	=	$key;
					$this->UserPreference->save($userPreference);
				}
			}
			
			$email_preference		=	Configure::read('email_preference');
			foreach($email_preference as $key1){
				foreach($key1 as $key => $val){
					$userPreference 			= 	$this->UserPreference->newEntity();
					$userPreference->type		=	'email';
					$userPreference->user_id	=	$userId;
					$userPreference->key_name	=	$key;
					$this->UserPreference->save($userPreference);
				}
			}
			
			$this->request->session()->write('Auth.User', $users->toArray());
			
		}else{
			$this->request->session()->write('Auth.User', $users->toArray());
		} 
		
		$this->redirect(array('controller' => 'globalusers','action' => 'index'));
	}
	
	
	public function forgotPassword()
    {
		$user = $this->Users->newEntity();

		if ($this->request->is('post')) {
			$user = $this->{$this->modelClass}->patchEntity(
											$user, 
											$this->request->data, 
											[ 'validate' => 'forgotPasswordForm']
									);
			if($user->errors()){
				$data['errors']		=	$this->json_error($user->errors());
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			$email	 =	$this->request->data['email'];
			$res	 = $this->{$this->modelClass}->find('all')->where(['email' => $email])->first();
			if(empty($res)){
				$data['errors']		=	array('error' => __('This email does not exists',true));
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			
			$res 							= 	$this->{$this->modelClass}->patchEntity($res, $this->request->data);
			$res->forgot_password_string	=	$forgot_password_string	=	md5($res->email.$res->id);	
			
			$this->{$this->modelClass}->save($res);
			
			$url					=	WEBSITE_URL.'users/reset_password/'.$forgot_password_string;			
			$forgot_password_string	=	'<a href="'.$url.'">Click here</a>';
			$full_name				=	$res->full_name;			
			
			$action  	   = 'forgot_password';
			$settingsEmail = Configure::read('Site.email');
			$settingstitle = Configure::read('Site.title');
			
			$this->loadModel('Actions');
			$cons 	= 	$this->Actions->find('all')->where(array('action' => $action))->first()->toArray();
			
			$this->loadModel('EmailTemplates');
			$emailTemplate 	= 	$this->EmailTemplates->find('all')->where(array('action_id' => $cons['id']))->first()->toArray();
			
			
			$cons	   =	explode(",",$cons['constant']);
			$constants =	 array();
			foreach($cons as $key=>$val){
				$constants[] = '{'.$val.'}';
			}
			
			$from_email          = $settingsEmail;
			$from_name           = $settingstitle;
			
			$from                = $from_name . "<" . $from_email . ">";
			$replyTo             = "";
			
			$subject             = $emailTemplate['subject'];
			$rep_Array           = array($full_name,$forgot_password_string,$url); 
			$message             = str_replace($constants, $rep_Array, $emailTemplate['body']);
			
			$to	=	$res->email;
			
			$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
			
			
			$this->Flash->success(__('forgot_password.success_message.',true));
			$data['success']	=	true;
			echo json_encode($data);			
		}
    }
	
	public function resetPassword($forgot_password_string = '') {
		if($forgot_password_string == ''){
			$this->Flash->error(__('This url has been used'));
			return $this->redirect(array('action' => 'index'));
			exit;
		}
		
		$reset	=	$this->{$this->modelClass}->find('all')->where(array('forgot_password_string' => $forgot_password_string))->first();
		if($reset == NULL){
			$this->Flash->error(__('This url has been used'));
			return $this->redirect(array('action' => 'index'));
			exit;
		}
		$full_name	 =	$reset->full_name;
		$to			 =	$reset->email;			
		if ($this->request->is(['patch', 'post', 'put'])) {			
			$reset		 =  $this->{$this->modelClass}->patchEntity(
											$reset, 
											$this->request->data, 
											[ 'validate' => 'signUpForm']
										);
			if($reset->errors()){
				$data['errors']		=	$this->json_error($reset->errors());
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			
			$reset->forgot_password_string	=		'';			
			$this->{$this->modelClass}->save($reset);
			
			$action  	   = 'reset_password';
			$settingsEmail = Configure::read('Site.email');
			$settingstitle = Configure::read('Site.title');
			
			$this->loadModel('Actions');
			$cons 	= 	$this->Actions->find('all')->where(array('action' => $action))->first()->toArray();
			
			$this->loadModel('EmailTemplates');
			$emailTemplate 	= 	$this->EmailTemplates->find('all')->where(array('action_id' => $cons['id']))->first()->toArray();
			
			
			$cons	   =	explode(",",$cons['constant']);
			$constants =	 array();
			foreach($cons as $key=>$val){
				$constants[] = '{'.$val.'}';
			}
			
			$from_email          = $settingsEmail;
			$from_name           = $settingstitle;
			
			$from                = $from_name . "<" . $from_email . ">";
			$replyTo             = "";
			
			$subject             = $emailTemplate['subject'];
			
			$rep_Array           = array($full_name); 
			$message             = str_replace($constants, $rep_Array, $emailTemplate['body']);
			
			$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
			
			$this->Flash->success(__('reset_password.success_message.',true));
		
			$data['success']	=	true;
			echo json_encode($data);
			exit;
			
		}
		$this->set(compact('reset','forgot_password_string'));
	}
	
	function uploadImage(){
		$this->loadModel('UploadImages');
		$user = $this->UploadImages->newEntity();
		if ($this->request->is('post')) {
			if(isset($this->request->data['type'])){
				$user = $this->{$this->modelClass}->patchEntity(
												$user, 
												$this->request->data, 
												[ 'validate' => 'uploadImageForm']
											);
				
				if($user->errors()){
					$data['errors']		=	$this->json_error($user->errors());
					$data['success']	=	false;
					echo json_encode($data);
					exit;
				}
				$user->user_id		=	$this->Auth->user('id');
				$this->UploadImages->save($user);
				$data['message']	=	__('Thanks for uploading the image, We will publish soon',true);
				$data['success']	=	true;
				echo json_encode($data);
				exit;
			}else{ 
				$user = $this->{$this->modelClass}->patchEntity(
												$user, 
												$this->request->data, 
												[ 'validate' => 'uploadImageForm']
											);
				
				if($user->errors()){
					$data['errors']		=	$this->json_error($user->errors());
					$data['success']	=	false;
					echo json_encode($data);
					exit;
				}
				
				$thisData	=	$this->request->data;
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, CASINO_THUMB_IMG_ROOT_PATH.$return_file_name)){
						$this->copyUploadedFile(CASINO_THUMB_IMG_ROOT_PATH.$return_file_name, CASINO_FULL_IMG_ROOT_PATH.$return_file_name);												
					
						$data['success']	=	true;
						$data['name']		=	 $return_file_name;
						$data['src']		=	 WEBSITE_URL.'image.php?width=400px&height=210px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$return_file_name;
						echo json_encode($data);
						exit;
					}
				}
			}
		}
	}
	
	function jobAdd(){
		if ($this->request->is('post')) {
			$this->loadModel('Jobs');
			
			$user = $this->Jobs->newEntity();
			$this->request->data 	=	$this->sanitizeData($this->request->data);
			$user = $this->Jobs->patchEntity(
											$user, 
											$this->request->data, 
											[ 'validate' => 'addForm']
										);
			// pr($user->errors());
			if($user->errors()){
				$this->Flash->error(__('Something going wrong.'));					
			}else{
				$user->user_id	=	$this->Auth->user('id');
				$this->Jobs->save($user);
				
				$this->Flash->success(__('Your job has been added.'));
				return $this->redirect(['action' => 'jobAdd']);		
			}
		}
		
			$this->loadModel('Master.Masters');		
			$this->Masters->find("list")->where([])->toList();
			$shape	 =	 $this->Masters->find('list')->select(['id','name'])->where(['Masters.type' => 'shape'])->toList();
			$color	 =	 $this->Masters->find('list')->select(['id','name'])->where(['Masters.type' => 'color'])->toList();
			$clarity	 =	 $this->Masters->find('list')->select(['id','name'])->where(['Masters.type' => 'clarity'])->toList();
			$cut		 =	 $this->Masters->find('list')->select(['id','name'])->where(['Masters.type' => 'cut'])->toList();
			$pol		 =	 $this->Masters->find('list')->select(['id','name'])->where(['Masters.type' => 'pol'])->toList();
			$sym		 =	 $this->Masters->find('list')->select(['id','name'])->where(['Masters.type' => 'sym'])->toList();
			$flo		 =	 $this->Masters->find('list')->select(['id','name'])->where(['Masters.type' => 'flo'])->toList();
			$lab		 =	 $this->Masters->find('list')->select(['id','name'])->where(['Masters.type' => 'lab'])->toList();
			
			$this->set(compact('shape','weight','color','clarity','cut','pol','sym','flo','lab'));
		
	}
	
	function jobListing(){
		
	}
	
	function validationCheck(){
		if ($this->request->is('post')) {
			$email	=	$this->request->data['email'];
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo json_encode(array(
						  'valid' => false,
						  'message' => 'Email id is invalid'
						));
				exit;
			}

			$count	=	$this->Users->find("all")->where(['email' => $email,'is_deleted' => 0])->count();
			if($count > 0){
				echo json_encode(array(
						  'valid' => false,
						  'message' => 'Email id already registered'
						));				
			}else{
				echo json_encode(array(
						  'valid' => true
						));
			}
		}
		exit;
	}
	
	function blog(){
		
	}
	
	function myJobs(){
		$this->loadModel('Jobs');
		$query = $this->Jobs->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where(['Blogs_title_translation.content  LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$query->where(['user_id' => $this->Auth->user('id')]);
		$this->paginate = ['sortWhitelist' => ['title','description']/* ,'contain' => ['Masters'] */];

		$query->order(['Jobs.id' => 'desc']);
        $result = $this->paginate($query);
       
		$this->set(compact('result'));
	}
	
	function jobView(){
		if(isset($this->request->params['job_view'])){
		    $slug   =   $this->request->params['job_view'];
		    $this->loadModel('Jobs');
            $jobDetails =   $this->Jobs->find('all')->contain(['Users'])->where(['Jobs.slug' => $slug])->first();

            $this->loadModel('Master.Masters');
            $allMasters =   $this->Masters->find("list")->toList();
            $this->set(compact('jobDetails','slug','allMasters'));

        }
	}
}