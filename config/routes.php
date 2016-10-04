<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'Kingloui/BasekitUsers',
    ['path' => '/basekit-users'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
);

Router::prefix('admin', function ($routes) {
    $routes->connect('/users', 
        ['prefix' => 'admin','plugin' => 'KingLoui/BaseKitUkUsers', 'controller' => 'Users', 'action' => 'index']
    );
    $routes->connect('/users/:action/*', 
        ['prefix' => 'admin','plugin' => 'KingLoui/BaseKitUkUsers', 'controller' => 'Users']
    );
    $routes->fallbacks(DashedRoute::class);
});

Router::connect('/login', 
    ['plugin' => 'KingLoui/BaseKitUkUsers', 'controller' => 'Users', 'action' => 'login']);
Router::connect('/logout', 
    ['plugin' => 'KingLoui/BaseKitUkUsers', 'controller' => 'Users', 'action' => 'logout']);