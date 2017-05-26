<?php
namespace CityManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CityManager\Model\Entity\CityDetail;
use Cake\ORM\TableRegistry;

/**
 * CityDetails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\BelongsTo $Objects
 */
class CityDetailsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('city_details');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
            'className' => 'CityManager.Countries'
        ]);
        /* $this->belongsTo('Objects', [
            'foreignKey' => 'object_id',
            'joinType' => 'INNER',
            'className' => 'CasinoImages'
        ]); */
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');
		
		$validator->add('object_id',[
				'notEmptyCheck'=>[
					'rule'=>'notEmptyCheck',
					'provider'=>'table',
					'message'=>'Please select atleast one image'
				 ]
			]);
        return $validator;
    }
	
	public function notEmptyCheck($value,$context){
		$object_id	 	 =	$context['data']['object_id'];
		$CasinoImage	 =  TableRegistry::get('CasinoImages');
		$CasinoImage	 =	$CasinoImage->find('all')->where(array('object_id' => $object_id))->first();
		// pr($CasinoImage);
		if(empty($CasinoImage->image)){
			return false;
		}
		return true;
	}

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
 /*    public function buildRules(RulesChecker $rules)
    {
        // $rules->add($rules->existsIn(['city_id'], 'Cities'));
        // $rules->add($rules->existsIn(['object_id'], 'Objects'));
        return $rules;
    } */
}
