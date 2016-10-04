<?php

use Cake\Core\Configure;
use Cake\Routing\Router;

$config = [
	'BaseKit' => [
		'NavTop' => [
			'TopLinksElement' => 'KingLoui/BaseKitUkUsers.toplinks'
		],
		'NavSidebar' => [
			'HeaderElement' => 'KingLoui/BaseKitUkUsers.adminbarheader',
        	'HeaderLogo' => 'UK'
		]
	]
];

return $config;
