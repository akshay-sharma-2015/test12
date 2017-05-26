<?php
namespace CityManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Continents Model
 *
 * @property \Cake\ORM\Association\HasMany $Countries
 *
 * @method \CityManager\Model\Entity\Continent get($primaryKey, $options = [])
 * @method \CityManager\Model\Entity\Continent newEntity($data = null, array $options = [])
 * @method \CityManager\Model\Entity\Continent[] newEntities(array $data, array $options = [])
 * @method \CityManager\Model\Entity\Continent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CityManager\Model\Entity\Continent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CityManager\Model\Entity\Continent[] patchEntities($entities, array $data, array $options = [])
 * @method \CityManager\Model\Entity\Continent findOrCreate($search, callable $callback = null)
 */
class ContinentsTable extends Table
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

        $this->table('continents');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Countries', [
            'foreignKey' => 'continent_id',
            'className' => 'CityManager.Country'
        ]);		
		
		$this->hasMany('Casinos', [
            'foreignKey' => 'continent_id',
            'className' => 'Casinos'
        ]);		
		
		$this->addBehavior('Translate', ['fields' => ['name','description','head_first_block','head_second_block','footer_main_title','niddle_title','icon_title']]);
		
		/*  $this->addBehavior('Muffin/Slug.Slug', ['onUpdate' => true
			// Optionally define your custom options here (see Configuration)
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notBlank('name');
			
		$validator
            ->requirePresence('description', 'create')
            ->notBlank('description');
		
		$validator
            ->requirePresence('head_first_block', 'create')
            ->notBlank('head_first_block');
		
		$validator
            ->requirePresence('head_second_block', 'create')
            ->notBlank('head_second_block');
		$validator
            ->requirePresence('icon_title', 'create')
            ->notBlank('icon_title');
		$validator
            ->requirePresence('niddle_title', 'create')
            ->notBlank('niddle_title');
		$validator
            ->requirePresence('footer_main_title', 'create')
            ->notBlank('footer_main_title');
		$validator
            ->requirePresence('page_title', 'create')
            ->notBlank('page_title');
		$validator
            ->requirePresence('meta_description', 'create')
            ->notBlank('meta_description');
		
		$validator->add('image',[
			'validExtension' => [
				'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
				'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')				
			]
			])->allowEmpty('image','update');
		
		$validator->add('back_image',[
			'validExtension' => [
				'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
				'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')				
			]
			])->allowEmpty('back_image','update');
		
		$validator->add('head_image',[
			'validExtension' => [
				'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
				'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')				
			]
			])->allowEmpty('head_image','update');
			
        return $validator;
    }
}
