<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
         <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <?php //$this->Html->css('css/bootstrap.min.css') ?>

    <?= $this->fetch('css') ?>
    <?= $this->Html->css('main.css') ?>

</head>
<body>

    <div id="contents">
        <div id="sidebar">
            <div class="brand"><a href="#">board4</a></div>
            <ul class="side-nav">
                <li class="<?= $this->name=='Users' ? 'active' : '' ?>">
                    <?= $this->Html->link(
                        '<i class="glyphicon glyphicon-user"></i>' . __('Users'),
                        ['controller'=>'users', 'action' => 'index'],
                        ['escapeTitle'=>false]
                    ) ?>
                    </li>
                <li class="<?= $this->name=='Todos' ? 'active' : '' ?>">
                    <?= $this->Html->link(
                        '<span class="glyphicon glyphicon-list"></span>' . __('Todos'),
                        '/todos/index',
                        ['escapeTitle'=>false]
                    ) ?>
                    </li>
                <?php if ($this->request->session()->read('Auth.User')): ?>
                <li><span><?= $this->Html->link(__('Logout'), '/users/logout') ?>
                    </span></li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="main-content">
            <a id="menu-toggle" href="#" class="btn btn-default">
                <span class="glyphicon glyphicon-th"></span>
            </a>

            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </div>


    <footer>
        &copy; <?= date('Y') ?> &nbsp; trump27
    </footer>

    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <?php // $this->Html->script('jquery/jquery.min.js',['block'=>true]); ?>
    <?php // $this->Html->script('bootstrap/bootstrap.min.js',['block'=>true]); ?>

    <?= $this->fetch('script') ?>
<script>
$(document).ready(function () {
    $('#menu-toggle').click(function (e) {
        e.preventDefault();
        $('#contents').toggleClass('active');
    });
});
</script>
</body>
</html>
