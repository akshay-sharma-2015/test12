<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'ContactManager',
    ['path' => '/contact-manager'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
