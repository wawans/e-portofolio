<div class="wrapper">
    <div id="login" class="container">
        <div class="row centered">
            <form name="flogin" class="width-60" method="post" action="<?php echo site_url('user/masuk/post');?>">
                <h1>Masuk</h1>
                <div>
                    <label>Nama Pengguna</label>
                </div>
                <div>
                    <input type="text" class="form-control" name="username" required="" />
                </div>
                <div>
                    <label>Kata Sandi</label>
                </div>
                <div>
                    <input type="password" class="form-control" name="password" required="" />
                </div>
                <div>
                    <input type="submit" class="btn btn-primary submit" value="Masuk" />
                    <span id="loader" class="text-info"></span>
                    <a class="reset_pass" href="<?= site_url('user/daftar');?>"> Pengguna Baru? Daftar Akun</a>
                </div>
                <div class="clearfix"></div>
                <div class="separator">
                </div>
            </form>
        </div>
    </div>
</div>