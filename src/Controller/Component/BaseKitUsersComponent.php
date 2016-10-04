<?php

namespace KingLoui\BaseKitUsers\Controller\Component;

use Cake\Controller\Component;


use Cake\Event\Event;
use CakeDC\Users\Controller\Component\UsersAuthComponent;

class BaseKitUsersComponent extends Component
{
    public function initialize(array $config) {
    	$controller = $this->_registry->getController();

    	$controller->loadComponent('CakeDC/Users.UsersAuth');
    }
}