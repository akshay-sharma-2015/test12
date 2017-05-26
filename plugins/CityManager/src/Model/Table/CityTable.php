<?php
namespace CityManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CityManager\Model\Entity\City;
use Cake\ORM\TableRegistry;
use Cake\ElasticSearch\Type;
/**
 * City Model
 *
 * @property \Cake\ORM\Association\BelongsTo $State
 * @property \Cake\ORM\Association\BelongsTo $Country
 */
class CityTable extends Table
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

        $this->table('cities');
        $this->displayField('name');
        $this->primaryKey('id');

		/* $this->addBehavior('Sitemap.Sitemap'); */

        $this->belongsTo('Country', [
            'foreignKey' => 'country_id',
            'joinType' => 'LEFT',
            'className' => 'CityManager.Country'
        ]);
		
		$this->hasMany('CasinoImages', [
            'className' => 'CasinoImages',
            'foreignKey' => 'object_id',
            'bindingKey' => 'object_id',
			'sort' => ['CasinoImages.display_order' =>'asc']
        ]); 
		$this->belongsTo('CCountry', [
            'foreignKey' => 'country_id',
            'joinType' => 'LEFT',
            'className' => 'CityManager.Country'
        ]);
		
		$this->hasMany('Casino', [
            'foreignKey' => 'city_id',
            'joinType' => 'LEFT',
            'className' => 'Casinos',
			'conditions' => function ($e, $query) {
				$query->limit(8);
				return [];
			},
			'sort' => 'Casino.review_count DESC'
        ]);
		
		$this->hasMany('Reviews', [
            'foreignKey' => 'foreign_key',
            'joinType' => 'LEFT',
			'className' =>	'Reviews',
			'sort' => 'Reviews.id DESC',
			'conditions' => array('Reviews.type' => 'city')
        ]); 
		
		
		$this->hasMany('Questions', [
            'foreignKey' => 'foreign_key',
            'joinType' => 'LEFT',
			'className' =>	'Questions',
			'sort' => 'Questions.id DESC',
			'condionts' => ['Questions.type' => 'city']
        ]); 
		
		
		/* $this->hasOne('LastReviews', [
            'foreignKey' => 'foreign_key',
            'joinType' => 'LEFT',
			'className' =>	'Reviews',
			'sort' => 'Reviews.id DESC'
        ]); 
		 */
		$this->addBehavior('Translate', ['fields' => ['name','description']]);
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
            ->allowEmpty('id', 'create');
		
		$validator->add('name', [
	            	'unique' => [
	            		'rule' => ['validateUnique', ['scope' => ['country_id','name']]],
	            		'provider' => 'table',
	            		'message' => 'You already have a city with that name!'
	            	]
	            ])->notEmpty('name');
		
		$validator->add('slug', 'unique', [
			'rule' => 'validateUnique',
			'provider' => 'table',
			'message' => 'Slug is alreay exists.Please enter a unique slug.'
		]);	
		
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');
		
        $validator
            ->integer('country_id')
            ->requirePresence('country_id', 'create')
            ->notEmpty('country_id');
		
		/* $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description'); */
			
		/* $validator->add('object_id',[
				'notEmptyCheck'=>[
					'rule'=>'notEmptyCheck',
					'provider'=>'table',
					'message'=>'Please select atleast one image'
				 ]
			]); */
        return $validator;
    }
	
	public function notEmptyCheck($value,$context){
		$object_id	 	 =	$context['data']['object_id'];
		$CasinoImage	 =  TableRegistry::get('CasinoImages');
		$CasinoImage	 =	$CasinoImage->find('all')->where(array('object_id' => $object_id))->first();
		if(empty($CasinoImage)){
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
    public function buildRules(RulesChecker $rules)
    {
		$rules->add($rules->isUnique(['name','country_id']));
        return $rules;
    }
	
	
	public function getUrl(\Cake\ORM\Entity $entity) {
		return WEBSITE_URL.'city/'.$entity->slug;		
	}
}
