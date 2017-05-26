<?php
namespace App\Model\Type;

use Cake\ElasticSearch\Type;

class CityType extends Type
{
	
	 public function initialize()
    {
        $this->embedOne('User');
        $this->embedMany('Casino', [
            'entityClass' => 'Casinos'
        ]);
    }
}