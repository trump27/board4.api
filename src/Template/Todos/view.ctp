<div class="subnav">
    <ul class="subnavitems list-inline">
        <li><?= $this->Html->link(__('Edit Todo'),
            ['action' => 'edit', $todo->id],
            ['class'=>'btn btn-sm btn-primary']) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Todo'),
            ['action' => 'delete', $todo->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $todo->id),'class'=>'btn btn-sm btn-primary']) ?> </li>
        <li><?= $this->Html->link(__('List Todos'),
            ['action' => 'index'],
            ['class'=>'btn btn-sm btn-primary']) ?> </li>
        <li><?= $this->Html->link(__('New Todo'),
            ['action' => 'add'],
            ['class'=>'btn btn-sm btn-primary']) ?> </li>
        <li><?= $this->Html->link(__('List Users'),
            ['controller' => 'Users', 'action' => 'index'],
            ['class'=>'btn btn-sm btn-primary']) ?> </li>
        <li><?= $this->Html->link(__('New User'),
            ['controller' => 'Users', 'action' => 'add'],
            ['class'=>'btn btn-sm btn-primary']) ?> </li>
    </ul>
</div>
<div class="panel panel-default">
  <div class="panel-heading"><?= __('Todo') ?></div>
  <div class="todos view content">
    <h3><?= h($todo->title) ?></h3>
    <table class="table vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $todo->has('user') ? $this->Html->link($todo->user->username, ['controller' => 'Users', 'action' => 'view', $todo->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($todo->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($todo->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Completed') ?></th>
            <td><?= h($todo->completed) ?></tr>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($todo->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($todo->modified) ?></tr>
        </tr>
    </table>
    <div class="rowtext">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($todo->description)); ?>
    </div>
  </div>
</div>

