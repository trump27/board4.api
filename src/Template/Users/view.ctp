<div class="subnav">
    <ul class="subnavitems list-inline">
        <li><?= $this->Html->link(__('Edit User'),
            ['action' => 'edit', $user->id],
            ['class'=>'btn btn-sm btn-primary']) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'),
            ['action' => 'delete', $user->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $user->id),'class'=>'btn btn-sm btn-primary']) ?> </li>
        <li><?= $this->Html->link(__('List Users'),
            ['action' => 'index'],
            ['class'=>'btn btn-sm btn-primary']) ?> </li>
        <li><?= $this->Html->link(__('New User'),
            ['action' => 'add'],
            ['class'=>'btn btn-sm btn-primary']) ?> </li>
        <li><?= $this->Html->link(__('List Todos'),
            ['controller' => 'Todos', 'action' => 'index'],
            ['class'=>'btn btn-sm btn-primary']) ?> </li>
        <li><?= $this->Html->link(__('New Todo'),
            ['controller' => 'Todos', 'action' => 'add'],
            ['class'=>'btn btn-sm btn-primary']) ?> </li>
    </ul>
</div>
<div class="panel panel-default">
  <div class="panel-heading"><?= __('User') ?></div>
  <div class="users view content">
    <h3><?= h($user->username) ?></h3>
    <table class="table vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($user->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></tr>
        </tr>
        <tr>
            <th><?= __('Active') ?></th>
            <td><?= $user->active ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
  </div>
</div>
    <div class="related row">
        <h4><?= __('Related Todos') ?></h4>
        <?php if (!empty($user->todos)): ?>
        <table class="table">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Completed') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->todos as $todos): ?>
            <tr>
                <td><?= h($todos->id) ?></td>
                <td><?= h($todos->title) ?></td>
                <td><?= h($todos->completed) ?></td>
                <td><?= h($todos->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link('', ['controller' => 'Todos', 'action' => 'view', $todos->id], ['title' => __('View'), 'class' => 'btn btn-xs glyphicon glyphicon-eye-open']) ?>

                    <?= $this->Html->link('', ['controller' => 'Todos', 'action' => 'edit', $todos->id], ['title' => __('Edit'), 'class' => 'btn btn-xs glyphicon glyphicon-pencil']) ?>

                    <?= $this->Form->postLink('', ['controller' => 'Todos', 'action' => 'delete', $todos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todos->id), 'title' => __('Delete'), 'class' => 'btn btn-xs glyphicon glyphicon-trash']) ?>

                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    </div>

