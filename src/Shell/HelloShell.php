<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;
use Cake\Cache\Cache;

class HelloShell extends Shell
{
	
     public function initialize()
    {
    	ini_set('memory_limit', '2048M');
		set_time_limit(0);
        parent::initialize();
        $this->loadModel('CityManager.City');
    }

	public function show2()
    {       
      	$city 	= $this->City->find('all')
				->contain('Country')
				->where([
				'City.is_change' => '0'
			])->limit(2500);
		foreach($city as $a){
			$country_name	=	$a->country_name;
			$name			=	$a->name;
			
			$articlesTable 			= 	TableRegistry::get('CityManager.City');
			
			$details				=	$this->getLnt($name.' '.$country_name);					
			if(isset($details['lat']) && isset($details['lng'])){
				$casinoAmenities 				= 	$articlesTable->get($a->id); // Return article with id 12
				$casinoAmenities->latitude		=	$details['lat'];
				$casinoAmenities->longitude		=	$details['lng'];				
				$casinoAmenities->is_change		=	1;				
				$articlesTable->save($casinoAmenities);
			}
		}
		exit;
    }
	
	function getLnt($zip){
		if(!empty($zip)){
			/* sleep(1); */
			$key  = 'AIzaSyDJhVvGqNSxkHD8NiDnD43py5naOvqQGjU';
			$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&sensor=false&key=".$key;
			$result_string = file_get_contents($url);
			$result = json_decode($result_string, true);
			
			$location	=	isset($result['results']['0']['geometry']['location']) ? $result['results']['0']['geometry']['location'] : '';
			return $location;
		}
	}
	
	public function akshay(){
		$this->out(print_r('akshay', true));	
	}
	
	public function email(){
		
        $this->loadModel('RealCasinos');
		$city 	= $this->RealCasinos->find('all')->where(['email' => ''])->limit(1000);
		
		foreach($city as $a){ pr($a->id);
			$html	 = file_get_contents($a->url);
			$matches = array(); //create array
			preg_match_all('/mailto:([^\?="]*)/', $html, $matches,PREG_SET_ORDER); 
			if(isset($matches[0][1]) && !empty($matches[0][1])){		
				$articlesTable 				= 	TableRegistry::get('RealCasinos');			
				$casinoAmenities 			= 	$articlesTable->get($a->id); // Return article with id 12
				$casinoAmenities->email		=	$matches[0][1];
				// pr($casinoAmenities);
				$articlesTable->save($casinoAmenities);
			}/* else{
				$matches = array(); //create array
				$pattern = '~\bhref\s*+=\s*+(["\'])mailto:\K(?<mail>(?<name>[^@]++)@(?<domain>.*?))\1[^>]*+>(?:\s*+</?(?!a\b)[^>]*+>\s*+)*+(?<content>[^<]++)~i';
				preg_match_all($pattern, $html, $matches,PREG_SET_ORDER);
				// pr($matches);
				if(isset($matches[0][2]) && !empty($matches[0][2])){			
					$articlesTable 				= 	TableRegistry::get('RealCasinos');			
					$casinoAmenities 			= 	$articlesTable->get($a->id); // Return article with id 12
					$casinoAmenities->email		=	$matches[0][2];				
					$articlesTable->save($casinoAmenities);
				}
			} */
		}
	
	}
	
	public function emai2(){		
        $this->loadModel('RealCasinos');
		$city 	= $this->RealCasinos->find('all')->where(['email' => ''])->limit(1000);
		
		foreach($city as $a){
			$html	 = file_get_contents($a->url);
			$matches = array(); //create array
			preg_match_all('/mailto:([^\?="]*)/', $html, $matches,PREG_SET_ORDER); 
			if(isset($matches[0][1]) && !empty($matches[0][1])){	
				// $articlesTable 				= 	TableRegistry::get('RealCasinos');			
				// $casinoAmenities 			= 	$articlesTable->get($a->id); // Return article with id 12
				
				$casinoAmenities			=	$this->RealCasinos->get($a->id);
				
				$casinoAmenities->email		=	$matches[0][1];
				$this->RealCasinos->save($casinoAmenities);
				 pr($a->id);
			}
		}
	}
}