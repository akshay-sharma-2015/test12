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
namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Session\DatabaseSession;
use Cake\Cache\Cache;
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
		$scope  	=     array('Users.is_deleted' => 0,'Users.role' => ADMIN_USER);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'dashboard'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
			'authenticate' => [
				'Form' => [
					'fields' => ['username' => 'username','password' => 'password'],
					'scope' => $scope
				]
			],
			'storage' => ['className' => 'Session', 'key' => 'Auth.Admin']
        ]);
	}

    public function beforeFilter(Event $event)
    {
		$userRole	=	$this->Auth->user('role');
		if(isset($userRole) && $userRole != 'admin'){
			$this->redirect(WEBSITE_URL);
		}
    }
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {	
		
    }
	public function afterFilter(Event $event)
    {
		// pr('afterFilter');
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
	
	function getLnt($address){
		if(!empty($address)){
			$key 			= 	'';
			$url  			= 	"https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false&key=".$key;
			$result_string  = 	file_get_contents($url);
			$result 		= 	json_decode($result_string, true);
			
			$location		=	isset($result['results']['0']['geometry']['location']) ? $result['results']['0']['geometry']['location'] : '';
			return $location;
		}
	}
	
	public function copyUploadedFile($filename , $destination) {
        if (copy($filename, $destination)) {
            return true;
        }
        return false;
    }//end moveUploadedFile()
	
}
