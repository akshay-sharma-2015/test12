<?php
namespace TextSetting\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
/**
 * TextSettings Controller
 *
 * @property \TextSetting\Model\Table\TextSettingsTable $TextSettings
 */
class TextSettingsController extends AppController
{
	
	public $components = ['Paginator'];
	
	public $paginate = [
        'limit' => 10,
        'order' => [
            'Casinos.id' => 'desc'
        ]
    ];
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->clearcahche();
		$query = $this->TextSettings->find()->join([
			[
				'table'     => 'text_settings',
				'alias'     => 't',
				'type'      => 'LEFT',
				'conditions'=> [
					'TextSettings.msgid = t.msgid',
					't.language_id= 2'
				]
			]
		]);
		
		
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction' || $value == '')
					continue;
				if($name == 'module'){
					$query->where(['TextSettings.msgid LIKE' => $value.'%']);
				}elseif($name == 'msgid'){
					$query->where(['t.msgstr LIKE' => '%'.$value.'%']);
				}else{
					$query->where(['TextSettings.'.$name.' LIKE' => '%'.$value.'%']);					
				}
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		$query->select('t.msgstr');
		$query->autoFields(true);
		$this->paginate = [ 
			'contain' => ['Languages' => ['conditions' => ['is_active' => 1]]], 
			'sortWhitelist' => ['language','msgid','t.msgstr']
		];

		$textSettings = $this->paginate($query);
		
        $this->set(compact('textSettings'));
        $this->set('_serialize', ['textSettings']);
		$this->set('model',$this->modelClass);
    }

    /**
     * View method
     *
     * @param string|null $id Text Setting id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $textSetting = $this->TextSettings->get($id, [
            'contain' => ['Languages']
        ]);

        $this->set('textSetting', $textSetting);
        $this->set('_serialize', ['textSetting']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $textSetting = $this->TextSettings->newEntity();
        if ($this->request->is('post')) {
            $thisData	=	$this->request->data;
			$title		=	$thisData['title'];
			foreach($title as $language_id => $text){
				$textSetting1 = $this->TextSettings->newEntity();
			
				$textSetting1->msgid			=	$thisData['msgid'];
				$textSetting1->language_id		=	$language_id;
				$textSetting1->msgstr			=	$text;
				$this->TextSettings->save($textSetting1);
			}
			
		
			$this->file_();
			$this->Flash->success(__('The text setting has been saved.'));
            return $this->redirect(['action' => 'add']);
        }
        $languages = $this->TextSettings->Languages->find('list', ['conditions' => ['is_active' => 1],'limit' => 200]);
        $this->set(compact('textSetting', 'languages'));
        $this->set('_serialize', ['textSetting']);
	}

    /**
     * Edit method
     *
     * @param string|null $id Text Setting id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $textSetting = $this->TextSettings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $textSetting = $this->TextSettings->patchEntity($textSetting, $this->request->data);
            if ($this->TextSettings->save($textSetting)) {
				$this->file_();
                $this->Flash->success(__('The text setting has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The text setting could not be saved. Please, try again.'));
            }
        }
        $languages = $this->TextSettings->Languages->find('list', ['limit' => 200]);
        $this->set(compact('textSetting', 'languages'));
        $this->set('_serialize', ['textSetting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Text Setting id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $textSetting = $this->TextSettings->get($id);
        if ($this->TextSettings->delete($textSetting)) {
			$this->file_();
            $this->Flash->success(__('The text setting has been deleted.'));
        } else {
            $this->Flash->error(__('The text setting could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	function file_(){
		$languages = $this->TextSettings->Languages->find('list', ['limit' => 200,'keyField' => 'id','valueField' => 'code']);
		foreach($languages as $id => $name){
			$res	=	$this->TextSettings->find('all',['conditions' => ['language_id' => $id]]);
			$files	=	'';
			foreach($res as $val){
				$msgid	=	trim($val->msgid);
				$msgstr	=	trim($val->msgstr,'"');
				$msgstr	=	trim($msgstr);
				
				$files	.=	'msgid "'. $msgid.'"'."\n".'msgstr "'.$msgstr.'"'."\n";
				
			}
			new Folder(ROOT.'/src/Locale/'.$name, true, 0755);
			
			$file	=	fopen(ROOT.'/src/Locale/'.$name.'/default.po','w');
			fwrite($file,$files);
			fclose($file);
		}
		$this->clearcahche();
	}
	
	function clearcahche(){
		$dir = new Folder(CACHE.'persistent');
			
		$dir->delete();
		
		$dir->create(CACHE.'persistent');
	}
}
