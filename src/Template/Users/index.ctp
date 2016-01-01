<div class="subnav">
    <ul class="subnavitems list-inline">
        <li><?= $this->Html->link(__('New User'), ['action' => 'add'], ['class'=>'btn btn-sm btn-primary']) ?></li>
        <li><?= $this->Html->link(__('List Todos'),
            ['controller' => 'Todos', 'action' => 'index'],
            ['class'=>'btn btn-sm btn-primary'] ) ?></li>
        <li><?= $this->Html->link(__('New Todo'),
            ['controller' => 'Todos', 'action' => 'add'],
            ['class'=>'btn btn-sm btn-primary'] ) ?></li>
    </ul>
</div>
<div class="users index content panel panel-default">
    <div class="panel-heading"><?= __('Users') ?></div>
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('username') ?></th>
                <th><?= $this->Paginator->sort('active') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= $user->active ? __('Yes') : ''; ?></td>
                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link('', ['action' => 'view', $user->id], ['title' => __('View'), 'class' => 'btn btn-default btn-xs glyphicon glyphicon-eye-open']) ?>
                    <?= $this->Html->link('', ['action' => 'edit', $user->id], ['title' => __('Edit'), 'class' => 'btn btn-default btn-xs glyphicon glyphicon-pencil']) ?>
                    <?= $this->Form->postLink('', ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'title' => __('Delete'), 'class' => 'btn btn-default btn-xs glyphicon glyphicon-trash']) ?>
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
