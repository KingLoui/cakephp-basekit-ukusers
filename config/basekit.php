<?php

use Cake\Core\Configure;
use Cake\Routing\Router;

$config = [
	'BaseKit' => [
		'NavTop' => [
			'TopLinksElement' => ''
		],
		'NavSidebar' => [
			'HeaderElement' => 'KingLoui/BaseKitUkUsers.adminbarheader',
			'MenuItems' => [
				'Users' => [
						['uri' => '/admin/users', 'extras' => ['icon' => 'fa fa-user']],
						'List Users' => ['uri' => ['plugin' => 'KingLoui/BaseKitUkUsers','controller' => 'Users', 'action' => 'index']],
						'Add User' => ['uri' => ['plugin' => 'KingLoui/BaseKitUkUsers','controller' => 'Users', 'action' => 'add']]
				],
	    ]
		]
	]
];

return $config;
