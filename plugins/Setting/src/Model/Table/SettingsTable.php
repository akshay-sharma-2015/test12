<?php
namespace Setting\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Setting\Model\Entity\Setting;
// use Search\Manager;

/**
 * Settings Model
 *
 */
class SettingsTable extends Table
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

        $this->table('settings');
        $this->displayField('title');
        $this->primaryKey('id');

        // $this->addBehavior('Timestamp');
		
		// $this->addBehavior('Search.Search');

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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('key_name', 'create')
            ->notEmpty('key_name');

        $validator
            ->requirePresence('value', 'create')
            ->notEmpty('value');

      

        return $validator;
    }
	
/* 	public function searchConfiguration()
    {
        $search = new Manager($this);

        $search->like('title');

        return $search;
    } */
}
