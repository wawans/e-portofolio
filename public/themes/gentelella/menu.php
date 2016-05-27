<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><span>e &mdash; Portofolio</span></a>
        </div>
        <div class="clearfix"></div>
        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li <?php if(uri_string()=='index'): ?> class="active" <?php endif; ?>><a href="<?php echo site_url('home'); ?>"><i class="fa fa-home"></i> Beranda</a></li>
                    <li><a href="<?php echo site_url('user/profil');?>"><i class="fa fa-user"></i> Profil</a></li>
                    <li><a href="<?php echo site_url('group/kelas'); ?>"><i class="fa fa-graduation-cap"></i> Kelas</a></li>
                    <?php if(isset($get_uuid)): ?>
                    <li><a href="<?php echo site_url('group/kelompok'); ?>"><i class="fa fa-group"></i> Kelompok</a></li>
                    <li><a href="javascript:;"><i class="fa fa-book"></i> Tugas</a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('portofolio/tugas/index/'.$get_uuid->kd_uuid); ?>"><i class="fa fa-book"></i> Baru</a>
                            <li><a href="<?php echo site_url('portofolio/tugas/index/'.$get_uuid->kd_uuid); ?>"><i class="fa fa-book"></i> Tugas</a>
                        </ul>
                    </li>
                    <?php endif;?>
                    <li><a href="<?php echo site_url('portofolio/nilai'); ?>"><i class="fa fa-line-chart"></i> Nilai</a></li>
                    <li><a href="<?php echo site_url('portofolio/media'); ?>"><i class="fa fa-picture-o"></i> Media</a></li>
                    <li><a href="<?php echo site_url('user/profil/pengaturan');?>"><i class="fa fa-cog"></i> Pengaturan</a></li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <label>&nbsp; &copy; 2016 e &mdash; Portofolio.</label>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>