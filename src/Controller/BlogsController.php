<?php
namespace App\Controller;

use App\Controller\AppController;
//use Cake\View\View;
//use Cake\Core\Configure;
use Cake\Cache\Cache;
use Cake\Event\Event;
//use Cake\Network\Exception\NotFoundException;

class BlogsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
	}
	
	public function beforeFilter(Event $event)
    {
		parent::beforeFilter($event);
        $this->Auth->allow(array('blog','blogView'));
    }

	function blog($id = null){

		$pageTitle	        =	__('title.news');
		$metaDescription	=	__('metadescription.news');
		
		$this->loadModel('Blog.Blogs');

		$query = $this->Blogs->find();
		if(!empty($this->request->data['search'])){
			$value	=	$this->request->data['search'];
			$query->orWhere(['Blogs.title  LIKE' => '%'.$value.'%']);
			$query->orWhere(['Blogs.description  LIKE' => '%'.$value.'%']);
			$query->orWhere(['Blogs_title_translation.content  LIKE' => '%'.$value.'%']);
			$query->orWhere(['Blogs_description_translation.content  LIKE' => '%'.$value.'%']);

			$this->set('requestedQuery',$value);
			$mainNews	=	'';
		}
		
		$this->paginate = ['sortWhitelist' => ['title','description'],'limit' => 15 /* ,'contain' => ['BlogUser' => ['fields' => ['name']]] */];
		
		if(!empty($id)){
			$query->where(['Blogs.master_id' => $id]);
		}
		$query->order(['Blogs.id' => 'desc']);
		
		$result = $this->paginate($query);
		$this->set(compact('result','mainNews','pageTitle','metaDescription'));
	}
	
	 public function blogView($slug = null)
    {
		if($slug == null){
			$this->redirect(array('action' => 'news'));
		}
		$this->loadModel('Blog.Blogs');
		$result = $this->Blogs->find('translations')->contain(['BlogUser' => ['fields' => ['name']]])->where(['Blogs.slug' => $slug])->first();
		
		$slugName	=	'blog_view';
		if(!empty($result->id)){
			$this->loadModel('CasinoImages');
			$casinoImage			=	$this->CasinoImages->find('all')->where(['object_id' => $result->object_id]);
			
			$relatedNews			=	$this->Blogs->find('translations')->where([
				'Blogs.master_id' => $result->master_id,'Blogs.id !=' => $result->id
			])->limit('3')->order('rand()');	
			
			
			$pageTitle			=	$result->meta_keyword;
			$metaDescription	=	!empty($result->meta_description) ? $result->meta_description : $result->meta_keyword;
			
			$this->set(compact('result','slug','slugName','casinoImage','pageTitle','metaDescription','relatedNews'));
		}		
		if(empty($result->id)){
						
			$this->loadModel('Master.Masters');
			$masters				=	$this->Masters->find('all')->where(['slug' => $slug])->first();
			
			$this->blog($masters->id);
			
			$pageTitle			=	$masters->meta_title;
			$metaDescription	=	$masters->meta_description;
			
			$this->set(compact('slug','slugName','pageTitle','metaDescription','masters'));
			$this->render('blog');
		}
    }
}
