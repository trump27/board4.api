<?= $this->Form->create('user',['class'=>'form-signin']) ?>
<h1>Login</h1>
<?= $this->Form->input('username',['label'=>false,'placeholder'=>'username']) ?>
<?= $this->Form->input('password',['label'=>false,'placeholder'=>'password']) ?>
<?= $this->Form->button('Login',['class'=>'btn btn-lg btn-primary btn-block']) ?>
<?= $this->Form->end() ?>
