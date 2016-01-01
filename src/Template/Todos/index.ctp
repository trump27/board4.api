<div class="subnav">
    <ul class="subnavitems list-inline">
        <li><?= $this->Html->link(__('New Todo'), ['action' => 'add'], ['class'=>'btn btn-sm btn-primary']) ?></li>
        <li><?= $this->Html->link(__('List Users'),
            ['controller' => 'Users', 'action' => 'index'],
            ['class'=>'btn btn-sm btn-primary'] ) ?></li>
        <li><?= $this->Html->link(__('New User'),
            ['controller' => 'Users', 'action' => 'add'],
            ['class'=>'btn btn-sm btn-primary'] ) ?></li>
    </ul>
</div>
<div class="todos index content panel panel-default">
    <div class="panel-heading"><?= __('Todos') ?></div>
    <div class="clearfix"></div>
    <div>
        <?php
            echo $this->Form->create('Todos', ['class'=>'form-inline searchbox']);
            echo $this->Form->input('user_id', ['label'=>'Search', 'empty'=>'---']);
            echo $this->Form->input('q', ['label'=>false, 'placeholder'=>'keyword']);
            echo $this->Form->button('Filter', ['type' => 'submit']);
            echo $this->Html->link('Reset', ['action' => 'index']);
            echo $this->Form->end();
        ?>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= $this->Paginator->sort('completed') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos as $todo): ?>
            <tr>
                <td><?= $this->Number->format($todo->id) ?></td>
                <td><?= $todo->has('user') ? $this->Html->link($todo->user->username, ['controller' => 'Users', 'action' => 'view', $todo->user->id]) : '' ?></td>
                <td><?= h($todo->title) ?></td>
                <td><?= h($todo->completed) ?></td>
                <td><?= h($todo->created) ?></td>
                <td><?= h($todo->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link('', ['action' => 'view', $todo->id], ['title' => __('View'), 'class' => 'btn btn-default btn-xs glyphicon glyphicon-eye-open']) ?>
                    <?= $this->Html->link('', ['action' => 'edit', $todo->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-xs glyphicon glyphicon-pencil']) ?>
                    <?= $this->Form->postLink('', ['action' => 'delete', $todo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todo->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-xs glyphicon glyphicon-trash']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
