<?php 
    $user = $this->request->session()->read('Auth.User');
?>
<ul class="nav navbar-top-links navbar-right">
    <li>
        <span class="m-r-sm text-muted welcome-message"><?= $user['username'] ?></span>
    </li>
    <li>
        <a href="<?= $this->Url->build(['prefix' => false, 'plugin' => false, 'controller' => 'Users', 'action' => 'logout']); ?>">
            <i class="fa fa-sign-out"></i><?= __d('KingLoui/BaseKitUkUsers', 'Log out') ?>
        </a>
    </li>
</ul>