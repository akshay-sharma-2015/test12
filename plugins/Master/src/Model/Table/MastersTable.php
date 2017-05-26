<?php
namespace Master\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Master\Model\Entity\Master;

/**
 * Masters Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentMasters
 * @property \Cake\ORM\Association\HasMany $ChildMasters
 */
class MastersTable extends Table
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

        $this->table('masters');
        $this->displayField('name');
        $this->primaryKey('id');
		
		$this->belongsTo('ParentMasters', [
            'className' => 'Masters',
            'foreignKey' => 'parent_id'
        ]);
		
		$this->hasMany('ChildMasters', [
            'className' => 'Masters',
            'foreignKey' => 'parent_id',
			'conditions' => ['is_deleted' => 0]
        ]);
		
        $this->addBehavior('Timestamp');
		// $this->addBehavior('Sluggable');
		$this->addBehavior('Translate', ['fields' => ['name','meta_title','meta_description']]);
		
		$this->addBehavior('Muffin/Slug.Slug', [
			// 'onUpdate' => true,
			'field' => 'slug',
			'displayField' => 'name'
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
            ->requirePresence('name', 'create')
            ->notBlank('name');     
		
		$validator->add('image',[
			 'validExtension' => [
                    'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
                    'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')
                ]
        ])->allowEmpty('image','update');
        return $validator;
    }

}
