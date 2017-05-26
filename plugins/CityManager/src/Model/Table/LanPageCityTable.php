<?php
namespace CityManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LanPageCity Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Cities
 *
 * @method \CityManager\Model\Entity\LanPageCity get($primaryKey, $options = [])
 * @method \CityManager\Model\Entity\LanPageCity newEntity($data = null, array $options = [])
 * @method \CityManager\Model\Entity\LanPageCity[] newEntities(array $data, array $options = [])
 * @method \CityManager\Model\Entity\LanPageCity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CityManager\Model\Entity\LanPageCity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CityManager\Model\Entity\LanPageCity[] patchEntities($entities, array $data, array $options = [])
 * @method \CityManager\Model\Entity\LanPageCity findOrCreate($search, callable $callback = null)
 */
class LanPageCityTable extends Table
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

        $this->table('lan_page_city');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'className' => 'Casinos'
        ]);
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
            ->requirePresence('image', 'create')
            ->notEmpty('image');
		
		$validator
            ->requirePresence('city_id', 'create','You need to select casino in the list')
            ->notEmpty('city_id','You need to select casino in the list');
/* 
        $validator
            ->requirePresence('is_feat', 'create')
            ->notEmpty('is_feat'); */
		
		$validator
			->add('image',[
            'validExtension' => [
                'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
                'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')               
            ]
        ])->allowEmpty('image', 'update');



        return $validator;
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
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        return $rules;
    }
}
