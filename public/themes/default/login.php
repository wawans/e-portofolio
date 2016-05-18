<h2>Login</h2>
<hr/>
<?php echo form_open('email/send'); ?>
<?php echo form_label('Nama Pengguna', 'username'); ?>
<?php echo form_input('username'); ?>
<?php echo form_label('Kata Sandi', 'password'); ?>
<?php echo form_password('password'); ?>
<?php echo form_close(); ?>