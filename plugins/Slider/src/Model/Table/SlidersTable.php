<?php
namespace Slider\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Slider\Model\Entity\Slider;
use Cake\Cache\Cache;

/**
 * Sliders Model
 *
 */
class SlidersTable extends Table
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

        $this->table('sliders');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
		$this->addBehavior('Translate', ['fields' => ['title']]);

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
		
		$validator->add('image',[
			 'validExtension' => [
                    'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
                    'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')
                ]
        ])->allowEmpty('image', 'update');
        return $validator;
    }
	
	public function afterSave($entity, $options = [])
	{
		Cache::delete('sliders','longlong');
	} 
	
	public function afterDelete($entity, $options = [])
	{
		Cache::delete('sliders','longlong');
	} 
}
