<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;
//use Cake\Core\Configure;
use Cake\Cache\Cache;
use Cake\Mailer\Email;
use App\Controller\Component\Sanitize;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
	
    /**         
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
	 public function initialize()
    {
		$this->loadComponent('Csrf');
		$scope  	=     array('Users.is_deleted' => 0,/* 'Users.is_verified' => 1, */'Users.role' => FRONT_USER);
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        $this->loadComponent('RequestHandler');
		
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'globalusers',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'index'
            ],
			'authenticate' => [
				'Form' => [
					'fields' => ['username' => 'email','password' => 'password'],
					'scope' => $scope
				]
			],
        ]);
	}


    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
		/* if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        } */
	 }
	
	 public function beforeFilter(Event $event)
    { 
		// $this->clearCache();
		//pr($this->request->params);die;
		$userRole	=	$this->Auth->user('role');
		if(isset($userRole) && $userRole == 'admin'){
			$session = $this->request->session();
			$session->destroy();
		}
		$Defaultlanguage	=	'en';
		I18n::locale($Defaultlanguage);		
		$this->set('Defaultlanguage', $Defaultlanguage);		
		// $this->set('languageList', $languageList);
		// pr($this->request->params);die;
		/* $languageList		=	$this->request->session()->read('Config.languageListData');
		if(isset($this->request->params['language'])){
			$Defaultlanguage	=	$this->request->params['language'];			
			if(!isset($languageList[$Defaultlanguage])){
				$Defaultlanguage	=	'';
			}
		}else{
			$Defaultlanguage	=	'en';		
		}
		
		if(empty($Defaultlanguage) || empty($languageList)){
			$subStr					=	'';
			$browserLang		=	$this->request->acceptLanguage();
			if(isset($browserLang[0])){
				$subStr				=	$browserLang[0];
				if($subStr == 'nl'){
					$subStr	=	'de';
				}
			}
			if (($languageListData = Cache::read('languageListData')) === false) {
				$this->loadModel('Languages');
				$languageListData		=	$this->Languages->find('all',['conditions' => ['is_active' => 1]])->toList();
				Cache::write('languageListData', $languageListData);
			}
			
			foreach($languageListData as $list){
				if($list->is_default == 1){
					$Defaultlanguage		=	$list->code;
				}
				if($list->code == $subStr){
					$Defaultlanguage		=	$list->code;
				}
				$languageList[$list->code]	=	$list->name;	
			}			
			$this->request->session()->write('Config.language',$Defaultlanguage);
			$this->request->session()->write('Config.languageListData',$languageList);
		}else{
				
			$this->request->session()->write('Config.language',$Defaultlanguage);
			$this->request->session()->write('Config.languageListData',$languageList);
		}
		
		I18n::locale($Defaultlanguage);		
		$this->set('Defaultlanguage', $Defaultlanguage);		
		$this->set('languageList', $languageList);
		 */
		
		#### Remeber me ####
		if(!$this->Auth->User('id') && $this->Cookie->read('login')){
			$user	=	$this->Cookie->read('login');
			$this->request->data['email']		=	$user['email'];
			$this->request->data['password']	=	$user['password'];
			
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				$data['success']	=	true;
				$this->Cookie->configKey('login', 'expires', '+3 months');
				$this->Cookie->write('login',json_encode($this->request->data));
			}
		}
		
	}
	
	public function afterFilter(Event $event)
    {
		// pr('afterFilter');
	}
	
	function _sendMail( $to, $from, $replyTo, $subject, $element,
        $parsingParams = array(),$attachments ="", $sendAs = 'html', $bcc = array()) {
			
		$email = new Email('default');	
		if ($attachments!="") {
			$email->attachments([$attachments]);		
		}
		foreach ($parsingParams as $key => $value) {
		   $email->viewVars(['key' => $value]);
		}
		
		$email->from(['no-reply@casinolineup.com' => 'no-reply@casinolineup.com'])
		->to($to)
		->subject($subject)
		->emailFormat('html')
		->send($parsingParams['message']);
	}
	
	function json_error($errors){
		$data	=	array();
		foreach($errors as $key => $err){
			$val 		=	array_values( $err);
			$data[$key]	=	$val[0];
		}
		return $data;
	}
	
	
	
	 public function change_file_name($fileName= null) {
		$exFileName     = strtolower(substr($fileName,strrpos($fileName,".") + 1));
        
		$fileRename = substr( base_convert( time(), 10, 36 ) . md5( microtime() ), 0, 16 ) .'.'. $exFileName;
		
		
        return $fileRename;
    }//end change_file_name()
    
    
	public function moveUploadedFile($filename , $destination) {
        if (move_uploaded_file($filename, $destination)) {
            return true;
        }
        return false;
    }//end moveUploadedFile()
	
	public function copyUploadedFile($filename , $destination) {
        if (copy($filename, $destination)) {
            return true;
        }
        return false;
    }//end moveUploadedFile()
	
	
	/**
     * Check User Token
     */
    public function checkUserToken() 
    {
            $request_token = $this->getRequestToken();
            
            if (!$request_token) {
               return false;
            }
            
            if ($request_token != $this->userToken()) {               
                return false;
            }
        return true;
    }
    
    /**
     * Get Request token
     */
    public function getRequestToken() 
    {
        
        $headers = $this->getHeaders();
		pr($headers);
        if (!isset($headers['Authorization'])) return false;
        $token = explode(" ", $headers['Authorization']);       
        return $token[1];
    }
    
    /**
     * Get Request headers
     */
    private function getHeaders() 
    {
        $headers = getallheaders();        
        return $headers;
    }
	
	public function clearCache(){
		Cache::delete('featured_guide','longlong');
		Cache::delete('allCat','longlong');
		Cache::delete('headBlock','longlong');
		Cache::delete('allCountry','longlong');
		Cache::delete('sliders','longlong');
		Cache::delete('allBlocks','longlong');
		Cache::delete('promotions','longlong');
		Cache::delete('reviewList','longlong');
		Cache::delete('popularCasinos','longlong');
		Cache::delete('onlinecasino','longlong');
		
		$this->loadModel('Languages');
		
		$allLang	=	$this->Languages->find('all');	
		foreach($allLang as $lang){
			Cache::delete('onlinecasino_'.$lang->code,'longlong');
			Cache::delete('promotion_'.$lang->code,'longlong');
			Cache::delete('news_right_side_bar_'.$lang->code,'longlong');
			Cache::delete('news_index_'.$lang->code,'longlong');
		}
	}
	
	public function sanitizeData($data) {
        return Sanitize::clean($data, array('encode' => true, 'escape' => false,'nl2br' =>true));
    }
	
	function reviewList($userId){		
		$this->loadModel('Reviews');
		$reviewsList	=	$this->Reviews->find('all')
							->contain([
								'Casinos' => ['fields' => ['title','type','slug','id','city_id','object_id','image']],
								'Casinos.City' => ['fields' => ['name','slug','id']],
								'Casinos.CasinoImages',
								// 'Casinos.Country' => ['fields' => ['name','slug','id']],
								'City' => ['fields' => ['name','image','slug','id','country_id','object_id']],
								'City.CasinoImages',
								'City.Country' => ['fields' => ['name','slug','id']],
								'Country' =>['fields' => ['name','image','slug','id','object_id']],
								'Country.CasinoImages',
								'Users' => ['fields' => ['full_name','city','profile_image','facebook_id','slug','sex']],
							]);
		if($userId == 'limit'){ 
			$reviewsList->limit(3);
		}elseif($userId == '100'){ 
			$reviewsList->limit(100);
		}else{
			$reviewsList->where(['user_id' => $userId]);
		}
		return $reviewsList->order(['Reviews.id' => 'desc'])->toList();
	}
	
	function questionList($userId){		
		$this->loadModel('Questions');
		$reviewsList	=	$this->Questions->find('all')
							->contain([
								'Casinos' => ['fields' => ['title','image','type','slug']],
								// 'Casinos.City' => ['fields' => ['name','slug','id']],
								// 'Casinos.Country' => ['fields' => ['name','slug','id']],
								'City' /* => ['fields' => ['name','image','slug','id']], */,
								'City.Country' /* => ['fields' => ['name','slug','id']] */,
								'Country' /*  =>['fields' => ['name','image','slug','id']] */,
								'Users' => ['fields' => ['full_name','city','profile_image','facebook_id','slug','sex']],
								'QuestionComments',
								'QuestionComments.Users' => ['fields' => ['full_name','city','profile_image','facebook_id','slug','sex']],
							]);
		if($userId == 'limit'){ 
			$reviewsList->limit(3);
		}else{
			$reviewsList->where(['user_id' => $userId]);
		}
		return $reviewsList->order(['Questions.id' => 'desc'])->toList();
	}
	
	function photoList($userId){
		
		$this->loadModel('CasinoImages');
		$reviewsList	=	$this->CasinoImages->find('all')
							    ->select([
									'CasinoImages.title','CasinoImages.file','CasinoImages.type',
									'casino.slug','casino.title','casino.type',
									'city.name','city.slug','cityparent.slug',
									'country.slug','country.name',
									'user.sex','user.profile_image','user.full_name','user.slug',
								])
								// ->select(['AnnoncesSuivis.id'])
							    ->hydrate(true)
								->join([
									'casino' => [
										'table' => 'casinos',
										'alias' => 'casino',
										'type' => 'LEFT',
										'conditions' => ['CasinoImages.object_id =casino.object_id','CasinoImages.type="casino"'],
									],
									'city' => [
										'table' => 'cities',
										'alias' => 'city',
										'type' => 'LEFT',
										'conditions' => ['CasinoImages.object_id=city.object_id','CasinoImages.type="city"'],
									],
									'cityparent' => [
										'table' => 'countries',
										'alias' => 'cityparent',
										'type' => 'LEFT',
										'conditions' => ['city.country_id=cityparent.id'],
									],
									'country' =>[
										'table' => 'countries',
										'alias' => 'country',
										'type' => 'LEFT',
										'conditions' => ['CasinoImages.object_id=country.object_id','CasinoImages.type="country"'],
									],
									'user' =>[
										'table' => 'users',
										'alias' => 'user',
										'type' => 'LEFT',
										'conditions' => ['CasinoImages.user_id=user.id'],
									]
								]);
		if($userId == 'limit'){ 
			$reviewsList->limit(3);
		}else{
			$reviewsList->where(['user_id' => $userId]);
		}
		return $reviewsList->order(['CasinoImages.id' => 'desc'])->toList();
	}
}
