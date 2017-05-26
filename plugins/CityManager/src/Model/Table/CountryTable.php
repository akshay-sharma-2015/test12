<?php
namespace CityManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CityManager\Model\Entity\Country;

/**
 * Country Model
 *
 * @property \Cake\ORM\Association\HasMany $City
 * @property \Cake\ORM\Association\HasMany $State
 */
class CountryTable extends Table
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

        $this->table('countries');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('City', [
            'foreignKey' => 'country_id',
            'className' => 'CityManager.City',
			'conditions' => function ($e, $query) {
				$query->limit(8);
				return [];
			},
			'sort' => 'City.review_count DESC'
        ]);
		
		$this->hasMany('CasinoImages', [
            'className' => 'CasinoImages',
            'foreignKey' => 'object_id',
            'bindingKey' => 'object_id',
			'sort' => ['CasinoImages.display_order' =>'asc']
        ]); 
		
		$this->hasMany('Casinos', [
            'foreignKey' => 'country_id',
            'className' => 'Casinos'
        ]);		
		
		$this->hasMany('AllCity', [
            'foreignKey' => 'country_id',
            'className' => 'CityManager.City'
        ]);
		
		$this->hasOne('CasinoSum', [
            'className' => 'CityManager.City',
			'joinType' => false,
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
			'condionts' => ['Questions.type' => 'country']
        ]); 
		
		$this->hasOne('Categories', [			
            // 'foreignKey' => 'foreign_key',
            'joinType' => 'INNER',
			'className' =>	'Categories'
        ]); 
        /*  */
		
		 $this->belongsTo('Continents', [
            /* 'foreignKey' => 'country_id', */
            'joinType' => 'LEFT',
            'className' => 'CityManager.Continents'
        ]);
		
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
        $validator->allowEmpty('id', 'create');
        $validator  ->requirePresence('continent_id', 'create')->notEmpty('continent_id');

		$validator->add('name', [
	            	'unique' => [
	            		'rule' => ['validateUnique', ['scope' => ['name']]],
	            		'provider' => 'table',
	            		'message' => 'You already have a country with that name!'
	            	]
	            ])->notEmpty('name');
				
		$validator->add('slug', 'unique', [
			'rule' => 'validateUnique',
			'provider' => 'table',
			'message' => 'Slug is alreay exists.Please enter a unique slug.'
		]);
   /*      $validator
            ->requirePresence('code', 'create')
            ->notEmpty('code'); */

        return $validator;
    }
}
