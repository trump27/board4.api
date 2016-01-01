<div class="subnav">
    <ul class="subnavitems list-inline">
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class'=>'btn btn-sm btn-primary']) ?></li>
        <li><?= $this->Html->link(
            __('List Todos'),
            ['controller' => 'Todos', 'action' => 'index'],
            ['class'=>'btn btn-sm btn-primary']) ?></li>
        <li><?= $this->Html->link(
            __('New Todo'),
            ['controller' => 'Todos', 'action' => 'add'],
            ['class'=>'btn btn-sm btn-primary']) ?></li>
    </ul>
</div>
<div class="users form content panel panel-default">
    <div class="panel-heading"><?= __('Add User') ?></div>
    <?= $this->Form->create($user,['novalidate' => true]) ?>
    <fieldset>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password');
            echo $this->Form->input('active');
        ?>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn-primary']) ?>
    </fieldset>
    <?= $this->Form->end() ?>
</div>
