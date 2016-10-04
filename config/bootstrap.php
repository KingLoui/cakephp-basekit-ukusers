<?php

use Cake\Core\Plugin;
use Cake\Core\Configure;

Configure::write('Users.config', ['KingLoui/BaseKitUkUsers.users']);
Plugin::load('CakeDC/Users', ['routes' => false, 'bootstrap' => true]);

Configure::load('KingLoui/BaseKitUkUsers.basekit');