<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="height:100%;">
                <div class="x_title">
                    <h2>Kelas Saya</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">

                        <div class="col-md-12">
                            <?php foreach ($all as $idx): ?>
                            <div class="col-md-3 col-xs-12 widget widget_tally_box">
                                <div class="x_panel fixed_height_300">
                                    <div class="x_content">
                                        <div class="flex">
                                            <ul class="list-inline widget_profile_box">
                                                <li><a class="img-circle profile_img"><i class="fa fa-graduation-cap"></i></a></li>
                                            </ul>
                                        </div>
                                        <h3 class="name"><?= $idx->nm_kelas; ?></h3>
                                        <div class="flex">
                                            <ul class="list-inline count2">
                                                <li>
                                                    <h3><?= $idx->anggota; ?></h3>
                                                    <span>Siswa</span>
                                                </li>
                                                <li>
                                                    <h3>-</h3>
                                                    <span>Kelompok</span>
                                                </li>
                                                <li>
                                                    <h3>-</h3>
                                                    <span>Tugas</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="pilih">
                                            <a href="<?php echo site_url('group/kelas/detail/'.$idx->kd_uuid);?>" class="btn btn-success" style="width: 100%">PILIH</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

            </div>
        </div>
    </div>
        </div>
    </div>
</div>
</div>


