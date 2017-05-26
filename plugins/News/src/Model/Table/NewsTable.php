<?php
namespace News\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
/**
 * News Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Masters
 *
 * @method \News\Model\Entity\News get($primaryKey, $options = [])
 * @method \News\Model\Entity\News newEntity($data = null, array $options = [])
 * @method \News\Model\Entity\News[] newEntities(array $data, array $options = [])
 * @method \News\Model\Entity\News|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \News\Model\Entity\News patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \News\Model\Entity\News[] patchEntities($entities, array $data, array $options = [])
 * @method \News\Model\Entity\News findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NewsTable extends Table
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

        $this->table('news');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
	
        $this->belongsTo('Masters', [
            'foreignKey' => 'master_id',
            'joinType' => 'INNER',
            'className' => 'Master.Masters'
        ]);
		
		$this->belongsTo('NewsUser', [
            'foreignKey' => 'news_user',
            'joinType' => 'INNER',
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
			$Masters	 =	$Masters->find('all')->where(array('slug' => $slug,'type' => 'news_category'))->first();
			
			if(empty($Masters)){
				return true;
			}			
		}
		return false;
	}
}
