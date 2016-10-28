<?php

use Cake\Core\Plugin;
use Cake\Core\Configure;

$usersconfig = ['KingLoui/BaseKitUkUsers.users'];
if(Configure::check('BaseKit.Users.config')) {
	$usersconfig = Configure::read('BaseKit.Users.config');
}

Configure::write('Users.config', $usersconfig);
Configure::write('Users.auth', false);

Plugin::load('CakeDC/Users', ['routes' => false, 'bootstrap' => true]);
Plugin::load('KingLoui/BaseKitUsers', ['bootstrap' => false, 'routes' => false]);

Configure::load('KingLoui/BaseKitUkUsers.basekit');
