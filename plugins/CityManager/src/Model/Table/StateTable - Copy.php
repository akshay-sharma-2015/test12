<?php
namespace CityManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CityManager\Model\Entity\State;

/**
 * State Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Country
 * @property \Cake\ORM\Association\HasMany $City
 */
class StateTable extends Table
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

        $this->table('state');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Country', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
            'className' => 'CityManager.Country'
        ]);
        $this->hasMany('City', [
            'foreignKey' => 'state_id',
            'className' => 'CityManager.City'
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('code', 'create')
            ->notEmpty('code');

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
        $rules->add($rules->existsIn(['country_id'], 'Country'));
        return $rules;
    }
}
