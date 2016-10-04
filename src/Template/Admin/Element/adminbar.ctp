<?php 
	$user = $this->request->session()->read('Auth.User');
?>
<div class="dropdown profile-element">               
	<a data-toggle="dropdown" class="dropdown-toggle" href="#">
	        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= $user['first_name'] ?> <?= $user['last_name'] ?></strong>
	         </span> <span class="text-muted text-xs block"><?= $user['username'] ?> <b class="caret"></b></span> </span> </a>
	<ul class="dropdown-menu animated fadeInRight m-t-xs">
	    <li><?= $this->Html->link('Logout', ['prefix' => false,'plugin' => false, 'controller' => 'Users', 'action' => 'logout']); ?></li>
	</ul>
</div>