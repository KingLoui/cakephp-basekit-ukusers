<?php

use Cake\Core\Configure;
use Cake\Routing\Router;

Configure::delete('Auth.authenticate.all');
Configure::delete('Auth.authenticate.0');
Configure::delete('Auth.authenticate.2');

$config = [
    'Users' => [
        //Table used to manage users
        'table' => 'Users',
        'RememberMe' => [
            //configure Remember Me component
            'active' => true
        ]
    ],
    'Auth' => [
        'authenticate' => [
            'Ldap.Ldap' => [
                'fields' => [
                    'username' => 'username',
                    'password' => 'password'
                ],
                'port' => Configure::read('Ldap.port'),
                'host' => Configure::read('Ldap.host'),
                'domain' => Configure::read('Ldap.domain'),
                'baseDN' => Configure::read('Ldap.baseDN'),
                'bindDN' => Configure::read('Ldap.bindDN'),
                'search' => Configure::read('Ldap.search'),
                'errors' => Configure::read('Ldap.errors'),
                'flash' => [
                    'key' => 'ldap',
                    'element' => 'Flash/error',
                ]
            ]
        ],
        'loginAction' => [
            'prefix' => false,
            'plugin' => false,
            'controller' => 'users',
            'action' => 'login'
        ],
        'unauthorizedRedirect' => false,
        'loginRedirect' => [
            'prefix' => 'admin',
            'plugin' => false,
            'controller' => 'pages',
            'action' => 'dashboard'
            
        ],
        'logoutRedirect' => [
            'controller' => 'pages',
            'action' => 'home',
            'prefix' => false
        ],
        'authorize' => [
            'CakeDC/Users.SimpleRbac' => [
                'autoload_config' => 'permissions'
            ]
        ],
        'authError' => 'Sie besitzen nicht die nötigen Rechte um die angeforderte Seite zu sehen!',
    ]
];

return $config;