<h2>Login</h2>
<hr/>
<?php echo form_open('email/send'); ?>
<?php echo form_label('Nama Pengguna', 'username'); ?>
<?php echo form_input('username'); ?>
<?php echo form_label('Kata Sandi', 'password'); ?>
<?php echo form_password('password'); ?>
<?php echo form_close(); ?>

<form method="post" action="<?php echo site_url('user/masuk/post');?>">
    <label>Username</label>
    <input type="text" name="username" class="width-6" />
    <label>Password</label>
    <input type="password" name="password" class="width-6" />

    <input type="submit" class="btn" value="Submit" />
</form>