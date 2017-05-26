<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Cache\Cache;
use Cake\ORM\TableRegistry;
/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */ $exp_domain= explode(".",env("HTTP_HOST"));
 // pr($exp_domain);
Router::defaultRouteClass('DashedRoute');
Router::extensions(['xlsx']);
Router::extensions(['json']);
Router::extensions('rss');
Router::prefix('admin', function ($routes) {
   
    $routes->connect('/', ['controller' => 'users', 'action' => 'login']);	
    $routes->connect('/dashboard', ['controller' => 'users', 'action' => 'dashboard']);	
    $routes->connect('/edit_profile', array('plugin' => '','controller' => 'users', 'action' => 'edit_profile'));	
    $routes->connect('/logout', array('plugin' => '','controller' => 'users', 'action' => 'logout'));
	
	// $routes->connect('/emailtemplate/index', array('plugin' => 'emailtemplate','controller' => 'email_templates','action' => 'index'));
	$routes->connect('/cms/index', array('plugin' => 'cms','controller' => 'cms_pages','action' => 'index'));
	$routes->connect('/add', array('plugin' => '','controller' => 'users','action' => 'add'));
	 
	$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'InflectedRoute']);
    $routes->connect('/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);
    $routes->connect('/:plugin/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);
	
	$routes->connect('/add', array('plugin' => '','controller' => 'users','action' => 'add'));
	
	// Casino controller
	// $routes->connect('/casino/*', array('plugin' => '','controller' => 'users'));
	
	$routes->plugin('Setting', ['path' => '/setting'], function ($routes) {
        $routes->connect('/:controller/:action/*');
    });
	
	$routes->plugin('EmailTemplate', ['path' => '/email_template'], function ($routes) {
        $routes->connect('/:controller/:action/*');
    });
	$routes->plugin('Master', ['path' => '/master'], function ($routes) {
        $routes->connect('/:controller/:action/*');
    });
	$routes->plugin('TextSetting', ['path' => '/textsetting'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	 });
	 
	$routes->plugin('CityManager', ['path' => '/city_manager'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	  
	$routes->plugin('Cms', ['path' => '/cms'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	 
	$routes->plugin('Block', ['path' => '/block'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	$routes->plugin('Contact', ['path' => '/contact'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	$routes->plugin('Slider', ['path' => '/slider'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	$routes->plugin('News', ['path' => '/news'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	$routes->plugin('Blog', ['path' => '/blog'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	 $routes->plugin('Custom', ['path' => '/custom'], function ($routes) {
        $routes->connect('/:controller/:action/*');
	});
	
	
	 
	
	 $routes->fallbacks('DashedRoute');
});

Router::scope('/', function (RouteBuilder $routes) {
	
	/* $routes->connect('', 
		['plugin' => '','controller' => 'users', 'action' => 'index'],
		['language' => 'de|en|es']
	);
	 */
	$routes->connect('webroot/admin/',
		['plugin' => '','controller' => 'webroot', 'action' => 'admin']
	);
	
	
    $routes->connect('/', ['plugin' => '','controller' => 'users', 'action' => 'index']);
	
	
	$routes->connect(
		'/about',
		['plugin' => '','controller' => 'users','action' => 'cms_slug','about-us']
	); 
	
		
	$routes->connect(
		'/privacy-policy',
		['plugin' => '','controller' => 'users','action' => 'cms_slug','privacy-policy']
	);
	$routes->connect(
		'/terms-of-use',
		['plugin' => '','controller' => 'users','action' => 'cms_slug','terms-of-use']
	); 
	
	$routes->connect(
		'/news/:news_view',
		['plugin' => '','controller' => 'news','action' => 'news_view'],
		['pass' => ['news_view','language'],'language' => 'de|en|es']
	);
	
	
	
	$routes->connect('/news', ['plugin' => '','controller' => 'news', 'action' => 'news']);
	$routes->connect('/news', ['plugin' => '','controller' => 'news', 'action' => 'news']);
	
	
	
	$routes->connect(
		'/news/:news_view',
		['plugin' => '','controller' => 'news','action' => 'news_view'],
		['pass' => ['news_view','language'],'language' => 'de|en|es']
	);
	
	
	
	
	
	$routes->connect('/facebook', ['plugin' => '','controller' => 'users', 'action' => 'facebook']);
	$routes->connect('/facebook', ['plugin' => '','controller' => 'users', 'action' => 'facebook']);
	
	$routes->connect('/fbsignup', ['plugin' => '','controller' => 'users', 'action' => 'fbsignup']);
	$routes->connect('/fbsignup', ['plugin' => '','controller' => 'users', 'action' => 'fbsignup']);
	
	$routes->connect('/login', ['plugin' => '','controller' => 'users', 'action' => 'login']);
	$routes->connect('/login', ['plugin' => '','controller' => 'users', 'action' => 'login']);
	
	$routes->connect('/logout', ['plugin' => '','controller' => 'users', 'action' => 'logout']);
	$routes->connect('/logout', ['plugin' => '','controller' => 'users', 'action' => 'logout']);
	
	$routes->connect('/signup', ['plugin' => '','controller' => 'users', 'action' => 'signup']);
	
	$routes->connect('/forgot-password', ['plugin' => '','controller' => 'users', 'action' => 'forgotPassword']);
	$routes->connect('/forgot-password', ['plugin' => '','controller' => 'users', 'action' => 'forgotPassword']);
	
	$routes->connect('/reset_password', ['plugin' => '','controller' => 'users', 'action' => 'resetPassword']);
	$routes->connect('/reset_password', ['plugin' => '','controller' => 'users', 'action' => 'resetPassword']);
	
	$routes->connect('/contact', ['plugin' => '','controller' => 'users', 'action' => 'contactUs']);
	
	
	$routes->connect('/job-add', ['plugin' => '','controller' => 'users', 'action' => 'jobAdd']);
	
	$routes->connect('/my-job', ['plugin' => '','controller' => 'users', 'action' => 'myJobs']);
	
	$routes->connect('/job-listing', ['plugin' => '','controller' => 'users', 'action' => 'jobListing']);
	
	$routes->connect('/validationCheck', ['plugin' => '','controller' => 'users', 'action' => 'validationCheck']);
	$routes->connect('/blog', ['plugin' => '','controller' => 'blogs', 'action' => 'blog']);


    $routes->connect('/profile', ['plugin' => '','controller' => 'globalusers', 'action' => 'index']);


    $routes->connect(
		'/blog/:blog_view',
		['plugin' => '','controller' => 'blogs','action' => 'blog_view'],
		['pass' => ['blog_view'],'language' => 'de|en|es']
	);
	
	
	$routes->connect(
		'/job/:job_view',
		['plugin' => '','controller' => 'users','action' => 'jobView'],
		['pass' => ['job_view'],'language' => 'de|en|es']
	);

    $routes->connect(
        '/job-edit/:job_edit',
        ['plugin' => '','controller' => 'users','action' => 'jobEdit'],
        ['pass' => ['job_edit'],'language' => 'de|en|es']
    );



    $routes->fallbacks('DashedRoute');
});
   // Router::extensions('rss');
/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
