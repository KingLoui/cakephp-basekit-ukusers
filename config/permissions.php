<?php

return [
    'Users.SimpleRbac.permissions' => [
        [
            'role' => 'admin',
            'prefix' => 'admin',
            'plugin' => 'KingLoui/BaseKit',
            'controller' => 'Pages',
            'action' => '*',
        ],
    ]
];