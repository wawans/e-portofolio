<div class="site-body centered-content">
    <div class="site-center">
        <div class="cell">
            <div class="col content">

                <div class="col panel width-1of2 center mobile-width-fill">
                    <div class="header">
                        Daftar
                    </div>
                    <div class="body">
                        <div class="cell">
                            <div class="col">
                                <div class="cell">
                                    <form method="post" action="<?php echo site_url('user/daftar/set_user/'.$user);?>">
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">
                                                    <label for="login">Username</label>
                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <input name="username" type="text" id="login" class="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <input name="password" type="password" id="password" class="text width-fit">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">
                                                    <label>Password Conf</label>
                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <input type="password" name="passconf" class="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">
                                                    <label>Nama Awal</label>
                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <input name="nama_awal" type="text" class="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">
                                                    <label>Nama Akhir</label>
                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <input name="nama_akhir" type="text" class="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">
                                                    <label>Email</label>
                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <input type="email" name="email" class="text">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">

                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <button type="submit" id="submit" class="button">Daftar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


