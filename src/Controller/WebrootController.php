<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;


class WebrootController extends AppController
{
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(array('admin'));
    }
	public function admin()
    {
		$this->redirect('/admin/');
	}
}
