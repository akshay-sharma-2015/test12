<?php
namespace TextSetting\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use TextSetting\Model\Entity\Language;
use Cake\Cache\Cache;

/**
 * Languages Model
 *
 * @property \Cake\ORM\Association\HasMany $TextSettings
 */
class LanguagesTable extends Table
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

        $this->table('languages');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('TextSettings', [
            'foreignKey' => 'language_id',
            'className' => 'TextSetting.TextSettings'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        return $validator;
    }
	
	public function afterSave($entity, $options = [])
	{
		Cache::delete('popularCasinos','longlong');
		Cache::delete('languageListData','longlong');
	} 
	
	public function afterDelete($entity, $options = [])
	{
		Cache::delete('popularCasinos','longlong');
		Cache::delete('languageListData','longlong');
	} 
}
