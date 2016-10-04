<?php $this->assign('title', 'All Users'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id') ?></th>
                            <th><?= $this->Paginator->sort('username', 'Uniaccount') ?></th>
                            <th><?= $this->Paginator->sort('first_name') ?></th>
                            <th><?= $this->Paginator->sort('last_name') ?></th>
                            <th><?= $this->Paginator->sort('email') ?></th>
                            <th><?= $this->Paginator->sort('role') ?></th>
                            <th><?= $this->Paginator->sort('created') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Number->format($user->id) ?></td>
                            <td><?= h($user->username) ?></td>
                            <td><?= h($user->first_name) ?></td>
                            <td><?= h($user->last_name) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td><?= h($user->role) ?></td>
                            <td><?= h($user->created) ?></td>
                            <td class="actions dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-cog"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right animated fadeInRight m-t-xs">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?></li>
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?></li>
                                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?></li>
                                </ul>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="paginator text-center">
                    <ul class="pagination btn-group">
                        <?= $this->Paginator->numbers(['prev' => true, 'next' => true]) ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>