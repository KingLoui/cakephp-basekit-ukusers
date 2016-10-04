<?php

use Cake\Core\Plugin;
use Cake\Core\Configure;

Configure::write('Users.config', ['KingLoui/BaseKitUkUsers.users']);
Configure::write('Users.auth', false);

Plugin::load('CakeDC/Users', ['routes' => false, 'bootstrap' => true]);
Plugin::load('KingLoui/BaseKitUsers', ['bootstrap' => false, 'routes' => false]);

Configure::load('KingLoui/BaseKitUkUsers.basekit');
