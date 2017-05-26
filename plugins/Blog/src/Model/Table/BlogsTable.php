<?php
namespace Blog\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
/**
 * Blog Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Masters
 *
 * @method \Blog\Model\Entity\Blog get($primaryKey, $options = [])
 * @method \Blog\Model\Entity\Blog newEntity($data = null, array $options = [])
 * @method \Blog\Model\Entity\Blog[] newEntities(array $data, array $options = [])
 * @method \Blog\Model\Entity\Blog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Blog\Model\Entity\Blog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Blog\Model\Entity\Blog[] patchEntities($entities, array $data, array $options = [])
 * @method \Blog\Model\Entity\Blog findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BlogsTable extends Table
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

        $this->table('Blog');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
	
        $this->belongsTo('Masters', [
            'foreignKey' => 'master_id',
            'joinType' => 'INNER',
            'className' => 'Master.Masters'
        ]);
		
		$this->belongsTo('BlogUser', [
            'foreignKey' => 'blog_user',
            /* 'joinType' => 'INNER', */
            'className' => 'Master.Masters',
			'propertyName' => 'user'
        ]);
		
		$this->addBehavior('Translate', ['fields' => ['title','description','meta_description','meta_keyword']]);
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
            ->notBlank('title');

        $validator
            ->notBlank('description');

		
		$validator->add('slug',[
			'slugUnique' => [
				'rule' => 'slugUnique',
				'provider' => 'table',
				'message' => 'Slug is alreay exists.Please enter a unique slug.'
			]
		]);
		 $validator->add('object_id',[
			'notBlankCheck'=>[
				'rule'=>'notBlankCheck',
				'provider'=>'table',
				'message'=>'Please select atleast one image'
			 ]
		]); 
			
        return $validator;
    }
	
	public function slugUnique($value,$context){
		$slug	 	 =	$context['data']['slug'];
		$id		 	 =	isset($context['data']['id']) ? $context['data']['id'] : '';
		
		if(!empty($context['data']['id'])){
			$slugData	 =	$this->find('all')->where(array('slug' => $slug,'id !=' => $context['data']['id']))->first();
		}else{
			$slugData	 =	$this->find('all')->where(array('slug' => $slug))->first();			
		}
		
		if(empty($slugData)){
			$Masters	 =  TableRegistry::get('Master.Masters');
			$Masters	 =	$Masters->find('all')->where(array('slug' => $slug,'type' => 'Blog_category'))->first();
			
			if(empty($Masters)){
				return true;
			}			
		}
		return false;
	}
}
