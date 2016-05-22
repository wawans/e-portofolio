<script>
    $('body').addClass('bg-login');
</script>
<div class="">
    <div id="wrapper">
        <div id="login" class=" form">
            <section class="login_content">
                <form method="post" action="<?php echo site_url('user/masuk/post');?>">
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
                        <a class="reset_pass" href="<?= site_url('user/daftar');?>"> Pengguna Baru? Daftar Akun</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>