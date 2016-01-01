<div class="subnav">
    <ul class="subnavitems list-inline">
        <li><?= $this->Html->link(__('List Todos'), ['action' => 'index'], ['class'=>'btn btn-sm btn-primary']) ?></li>
        <li><?= $this->Html->link(
            __('List Users'),
            ['controller' => 'Users', 'action' => 'index'],
            ['class'=>'btn btn-sm btn-primary']) ?></li>
        <li><?= $this->Html->link(
            __('New User'),
            ['controller' => 'Users', 'action' => 'add'],
            ['class'=>'btn btn-sm btn-primary']) ?></li>
    </ul>
</div>
<div class="todos form content panel panel-default">
    <div class="panel-heading"><?= __('Add Todo') ?></div>
    <?= $this->Form->create($todo,['novalidate' => true]) ?>
    <fieldset>
        <?php
            echo $this->Form->input('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->input('title');
            echo $this->Form->input('description');
            echo $this->Form->input('completed', ['type' => 'text']);
        ?>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn-primary']) ?>
    </fieldset>
    <?= $this->Form->end() ?>
</div>
