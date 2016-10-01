<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="width-20">
                <ul class="nav side-menu">
                    <li <?php if(uri_string()=='index'): ?> class="active" <?php endif; ?>><a href="<?php echo site_url('home'); ?>"><i class="fa fa-home"></i> Beranda</a></li>
                    <li><a href="<?php echo site_url('user/profil');?>"><i class="fa fa-user"></i> Profil : <?php echo $profile->nm_awal;?></a></li>
                    <li><a href="<?php echo site_url('group/kelas'); ?>"><i class="fa fa-graduation-cap"></i> Kelas</a>
                        <?php if(isset($my_kelas)): ?>
                        <ul>
                            <?php foreach($my_kelas as $idx): ?>
                            <li><a href="<?php echo site_url('group/kelas/detail/'.$idx->kd_uuid); ?>"><?= $idx->nm_kelas; ?></a>
                                <ul>
                                    <li><a href="<?php echo site_url('group/kelompok/index/'.$idx->kd_uuid); ?>"><i class="fa fa-group"></i> Kelompok</a></li>
                                    <li><a href="<?php echo site_url('group/kelas/detail/'.$idx->kd_uuid); ?>#Activity"><i class="fa fa-book"></i> Tugas</a>
                                <?php if($profile->act == 2): ?>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo site_url('portofolio/tugas/index/'.$idx->kd_uuid); ?>"><i class="fa fa-book"></i> Baru</a>
                                        </ul>
                                <?php endif; ?>
                                    </li>
                                    <li><a href="<?php echo site_url('portofolio/nilai/index/'.$idx->kd_uuid); ?>"><i class="fa fa-line-chart"></i> Nilai</a></li>
                                </ul>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <?php if(isset($get_uuids)): ?>
                    <li><a href="<?php echo site_url('group/kelompok'); ?>"><i class="fa fa-group"></i> Kelompok</a></li>
                    <li><a href="javascript:;"><i class="fa fa-book"></i> Tugas</a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('portofolio/tugas/index/'.$get_uuid->kd_uuid); ?>"><i class="fa fa-book"></i> Baru</a>
                            <li><a href="<?php echo site_url('portofolio/tugas/index/'.$get_uuid->kd_uuid); ?>"><i class="fa fa-book"></i> Tugas</a>
                        </ul>
                    </li>
                    <?php endif;?>
                    <li><a href="<?php echo site_url('portofolio/nilai'); ?>"><i class="fa fa-line-chart"></i> Nilai</a></li>
                    <!--<li><a href="<?php /*echo site_url('portofolio/media'); */?>"><i class="fa fa-picture-o"></i> Media</a></li>-->
                    <li><a href="<?php echo site_url('user/profil/pengaturan');?>"><i class="fa fa-cog"></i> Pengaturan</a></li>
                    <li><a href="<?php echo site_url();?>">Logout</a></li>
                </ul>
            </div>

