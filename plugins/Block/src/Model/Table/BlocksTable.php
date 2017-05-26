<?php
namespace Block\Model\Table;

use Block\Model\Entity\Block;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Cache\Cache;

/**
 * Blocks Model
 *
 */
class BlocksTable extends Table
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

        $this->table('blocks');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
		$this->addBehavior('Translate', ['fields' => ['title','description']]);
		
		$this->addBehavior('Muffin/Slug.Slug', [
			'field' => 'slug',
			'displayField' => 'title'
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
            ->requirePresence('title', 'create')
            ->notBlank('title');
		$validator
            ->requirePresence('page_name', 'create')
            ->notBlank('page_name');

        $validator
            ->requirePresence('description', 'create')
            ->notBlank('description');
		
		$validator->notBlank('second_description');
		
		$validator->add('image',[
			'validExtension' => [
				'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
				'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')				
			]
        ])->allowEmpty('image','update');
		
      
        return $validator;
    }
	
	public function afterSave($entity, $options = [])
	{
		Cache::delete('allBlocks','longlong');
	} 
	
	public function afterDelete($entity, $options = [])
	{
		Cache::delete('allBlocks','longlong');
	} 
}
