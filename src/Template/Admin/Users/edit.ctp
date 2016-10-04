<?php $this->assign('title', 'Edit User'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <?= $this->Form->create($user, ['align' => [
                    'sm' => [
                        'left' => 2,
                        'middle' => 10,
                        'right' => 12
                    ],
                    'md' => [
                        'left' => 2,
                        'middle' => 10,
                        'right' => 4
                    ]
                ]]) ?>
                <?php
                    echo $this->Form->input('role', ['options' => ['user' => 'User','admin' => 'Admin']]);
                    echo $this->Form->input('active', ['type' => 'checkbox']);
                    echo $this->Form->input('is_superuser', ['type' => 'checkbox']);

                ?>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= $this->Form->submit('Save', ['class' => 'btn-primary']); ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>