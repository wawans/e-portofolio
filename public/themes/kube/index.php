<form method="post" action="<?php echo site_url('user/daftar/set_user');?>">
    <label>Username</label>
    <input type="text" name="username" class="width-6" />
    <label>Password</label>
    <input type="password" name="password" class="width-6" />
    <label>Conf</label>
    <input type="password" name="passconf" class="width-6" />

    <label>Nama Awal</label>
    <input type="text" name="nama_awal" class="width-6" />
    <label>Nama Ahir</label>
    <input type="text" name="nama_akhir" class="width-6" />

    <label>Email</label>
    <input type="email" name="email" class="width-6" />

    <input type="submit" class="btn" value="Submit" />
</form>
<hr />
<form method="post" action="<?php echo site_url('user/masuk/post');?>">
    <label>Username</label>
    <input type="text" name="username" class="width-6" />
    <label>Password</label>
    <input type="password" name="password" class="width-6" />
    
    <input type="submit" class="btn" value="Submit" />
</form>
