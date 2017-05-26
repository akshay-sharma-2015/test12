<?php
namespace App\Controller;

//use App\Controller\AppController;
//use Cake\Cache\Cache;
//use Cake\View\View;
//use Cake\Network\Exception\NotFoundException;
//use Cake\Event\Event;


class GlobalusersController extends AppController
{
	
	public function index(){
		
	}
	function updateprofile(){		
		
		$userId			=	$this->Auth->user('id');
		$this->loadModel('Users');		
		$loginData 	=	$this->Users->get($userId);
		if ($this->request->is(['patch', 'post', 'put'])) { 
			$this->request->data 	=	$this->sanitizeData($this->request->data);

			$loginData = $this->Users->patchEntity(
											$loginData, 
											$this->request->data, 
											[ 'validate' => 'updateProfile']
										); 
			if($loginData->errors()){
				$data['errors']		=	$this->json_error($loginData->errors());
				$data['success']	=	false;
				$data['message']	=	__('Profile could not be update. Please try again',true);
				echo json_encode($data);
				exit;
			}
			
			$loginData->username	=	$this->request->data['email'];
			$this->Users->save($loginData);
			
			Cache::delete('reviewList','longlong');
			$this->request->session()->write('Auth.User', $loginData);
				
			$data['success']	=	true;
			$data['message']	=	__('Profile updated successfully',true);
			echo json_encode($data);
			exit;
		}	
		exit;
	}	
	
	
	function updateprofilepic(){
		if(!empty($this->request->data['data'])){
			require_once(ROOT .'/vendor/browser/BrowserDetection.php');		
			$browser = new \BrowserDetection();
			$browser	=	$browser->getName();
			if($browser == 'Safari'){
				$data			  =		$this->request->data['data'];
				
				$allowed =  array('gif','png' ,'jpg');
				$filename = $data['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!in_array($ext,$allowed) ) {
					$data				=	array();
					$data['title']		=	'Error';			
					$data['type']		=	'error';
					$data['success']	=	false;
					$data['message']	=	__('Please upload valid extension image.Valid extension are gif,png,jpg.',true);
					echo json_encode($data);
					exit;
				}
				
				if(!empty($data)){
					$file_name         						=     $data['name'];
					$tmp_name          						=     $data['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);
					
					if($this->moveUploadedFile($tmp_name, PROFILE_ROOT_PATH.$return_file_name)){
						$fileName							=		$return_file_name;
						
			
						$this->loadModel('Users');
						
						$loginData 	=	$this->Users->get($this->Auth->user('id'));
						$loginData->profile_image	=	$fileName;
						$this->Users->save($loginData);
						
						$this->request->session()->write('Auth.User', $loginData);
						
						$data				=	array();
						$data['title']		=	'Success';
						$data['type']		=	'success';
						$data['success']	=	true;
						$data['src']		=	PROFILE_IMG_URL.$fileName;
						$data['message']	=	__('Image updated successfully',true);
						echo json_encode($data);
						exit;
					}
				}
			}else{
				$data			  =		$this->request->data['data'];
				
				list($type, $data) = 	explode(';', $data);			
				$type			   = 	explode('/', $type);			
				list(, $data)      = 	explode(',', $data);			
				$data 			   =	base64_decode($data);			
				$userName		   =	$this->Auth->user('slug').'_'.time();		
				
				$fileName		   =	$userName.'.'.$type[1];
				$file2			   =	fopen(PROFILE_ROOT_PATH.$fileName,'w');
				
				fwrite($file2,$data);
				fclose($file2);
				
			
				$this->loadModel('Users');
				
				$loginData 	=	$this->Users->get($this->Auth->user('id'));
				$loginData->profile_image	=	$fileName;
				$this->Users->save($loginData);
				
				$this->request->session()->write('Auth.User', $loginData);
				
				$data				=	array();
				$data['title']		=	'Success';
				$data['type']		=	'success';
				$data['success']	=	true;
				$data['src']		=	PROFILE_IMG_URL.$fileName;
				$data['message']	=	__('Image updated successfully',true);
				echo json_encode($data);
				exit;
			}
		}else{
			$data				=	array();
			$data['title']		=	'Error';			
			$data['type']		=	'error';
			$data['success']	=	false;
			$data['message']	=	__('Something going wrong',true);
			echo json_encode($data);
			exit;
		}
		exit;
	}
	
	
	function uploadImage(){
		$this->loadModel('Users');
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity(
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
				if($this->moveUploadedFile($tmp_name,PROFILE_ROOT_PATH.$return_file_name)){
					$data['message']	=	__('File Uploaded successfully.',true);
					$data['success']	=	true;
					$data['name']		=	 $return_file_name;
					$data['src']		=	 WEBSITE_URL.'image.php?width=200px&height=200px&cropratio=1:1&image='.PROFILE_IMG_URL.$return_file_name;
					
					
					$loginData 	=	$this->Users->get($this->Auth->user('id'));
					$loginData->profile_image	=	$return_file_name;
					$this->Users->save($loginData);
					
					$this->request->session()->write('Auth.User', $loginData);
					
					
					echo json_encode($data);
					exit;
				}
			}
			
		}
	}
	function uploadImageCover(){
		$this->loadModel('Users');
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity(
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
				if($this->moveUploadedFile($tmp_name,PROFILE_ROOT_PATH.$return_file_name)){
					$data['message']	=	__('File Uploaded successfully.',true);
					$data['success']	=	true;
					$data['name']		=	 $return_file_name;
					$data['src']		=	 WEBSITE_URL.'image.php?width=1263px&height=468px&cropratio=3:1&image='.PROFILE_IMG_URL.$return_file_name;
					
					
					$loginData 	=	$this->Users->get($this->Auth->user('id'));
					$loginData->cover_image	=	$return_file_name;
					$this->Users->save($loginData);
					
					$this->request->session()->write('Auth.User', $loginData);
					
					
					echo json_encode($data);
					exit;
				}
			}
			
		}
	}	
}