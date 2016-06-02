<div class="right_col" role="main">
    <div class="row page">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="height:100%;">
                <div class="x_title">
                    <h2><i class="fa fa-graduation-cap"></i> Kelas <i class="fa fa-angle-right"></i> <?=$get_uuid->nm_kelas;?> </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="col">
                         <label class="left"><i class="fa fa-graduation-cap fa-5x"></i></label>
                        </div>
                        <h2 class="title"><?=$get_uuid->nm_kelas;?></h2>
                        <p class="byline"><span>Oleh </span><a><?=$get_uuid->nm_awal;?> <?=$get_uuid->nm_akhir;?></a></p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <h2 class="text-center text-capitalize alert alert-success kelas-uuid-baru"><?=$get_uuid->kd_uuid;?></h2>
                    </div>
                    <div class="clearfix"></div>
                    <div class="divider-dashed"></div>


                </div>
            </div>
            <ul class="nav nav-tabs">
                <li class="col-md-4 col-sm-4 col-xs-12 active"><a href="">Activity</a></li>
                <li class="col-md-4 col-sm-4 col-xs-12"><a href="">Kelompok</a></li>
                <li class="col-md-4 col-sm-4 col-xs-12"><a href="">Siswa</a></li>
            </ul>
            <br />
            <?php if(isset($tugas)):
                foreach($tugas as $item): ?>

            <div class="x_panel" style="height:100%;">
                <div class="x_title">
                    <h2><?=$item->judul; ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <label class="byline"><i class="fa fa-tag"></i>
                        <span>Pada </span><a><?=$item->tgl_awal; ?></a>
                        <span>Oleh </span><a><?=$item->kd_user; ?></a></label>
                    <article>
                        <?=$item->konten; ?>
                    </article>
                    <?php if($item->lampiran > 0): ?>
                    <div class="divider-dashed"></div>
                    <ul>
                        <?php if($item->lampiran == 1): ?>
                            <li><a href="<?php echo base_url('public/uploads/'.$item->filename);?>" target="_blank"><i class="fa fa-paperclip"></i> <?=$item->filename; ?></a></li>
                        <?php elseif($item->lampiran > 1): ?>
                        <?php $emp = explode(',',$item->filename); foreach ($emp as $lamp): ?>
                        <li><a href="<?php echo base_url('public/uploads/'.$lamp);?>" target="_blank"><i class="fa fa-paperclip"></i> <?=$lamp; ?></a></li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                    <?php endif; ?>
                    <div class="divider-dashed"></div>
                    <a class="btn btn-sm btn-primary" href="<?php echo site_url('portofolio/tugas/detail/'.$get_uuid->kd_uuid.'/'.$item->kd_uuid); ?>">Detail</a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php endforeach; endif; ?>
            <!--<div class="x_panel" style="height:100%;">
                <div class="x_title">
                    <h2>Judul Tugas</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <label class="byline"><i class="fa fa-tag"></i> <span>Oleh </span><a>Drs. Kuncoro</a></label>
                    <p>Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and</p>
                    <div class="divider-dashed"></div>
                    <ul>
                        <li><a><i class="fa fa-paperclip"></i> File-name.doc</a></li>
                    </ul>
                    <div class="divider-dashed"></div>
                    <a class="btn btn-sm btn-primary">Detail</a>
                    <div class="clearfix"></div>
                </div>
            </div>-->
        </div>
            <!--kelompok-->
            <div class="col-md-3 col-xs-12 widget widget_tally_box baru">
                <div class="x_panel fixed_height_300">
                    <div class="x_content">
                        <div class="flex">
                            <ul class="list-inline widget_profile_box baru">
                                <li><a class="img-circle profile_img"><i class="fa fa-group"></i></a></li>
                            </ul>
                        </div>

                        <h3 class="name"><i class="fa fa-plus-circle"></i> Baru</h3>
                        <div class="ln_solid"></div>
                        <div class="flex">
                            <ul class="list-inline count2">

                            </ul>
                        </div>
                        <div class="divider-dashed" style="padding-bottom: 12px;"></div>
                        <h3 class="pilih" style="margin: 0 !important;">
                            <a href="#" id="<?=($profile->act==1)?'ikut':'buat';?>-klm-baru" data-toggle="modal" data-target=".klm-<?=($profile->act==1)?'ikut':'baru';?>-modal" class="btn btn-danger" style="width: 100%;"><?=($profile->act==1)?"IKUT":"BUAT";?></a>
                        </h3>
                        <h3 class="pilih" style="margin: 0 !important;">
                            <a href="#" id="ikut-klm-baru" data-toggle="modal" data-target=".klm-ikut-modal" class="btn btn-primary" style="width: 100%;">IKUT</a>
                        </h3>
                    </div>
                </div>
            </div>
        <div class="clearfix"></div>
        <?php for ($i=0;$i<50;$i++): ?>
<!--user card-->
        <div class="col-md-3 col-sm-3 col-xs-12 widget profile_details">
            <div class="well col-md-12 profile_view">
                <div class="col-md-12">
                    <div class="text-center" style="margin-top: 0 !important;">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="text-center">
                        <h2>Nicole Pearson</h2>
                        <p><i class="fa fa-group"></i> <a href="" class="">Mawar</a></p>
                    </div>
                    </div>
                <div class="clearfix"></div>
                <div class="col-xs-12 bottom text-center">
                        <button class="btn btn-primary btn-xs" type="button">
                            <i class="fa fa-user"> </i> View Profile
                        </button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!--end use cars-->
        <?php endfor; ?>
        </div>
    </div>
</div>
</div>

<!-- /modals -->
<div class="modal fade klm-baru-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Kelompok Baru</h4>
            </div>
            <div class="modal-body">
                <form name="fkelas_baru" class="form-horizontal form-label-left" method="post" action="<?php echo site_url('group/kelompok/create/');?>" novalidate>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kelompok<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nama" required="required" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Maks. Kuota
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="maks" value="5"  required="required" type="number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-5 col-md-offset-3">
                            <button id="send" type="submit" class="btn btn-success">Buat</button>
                            <button type="reset" class="btn btn-primary">Batal</button>
                            <span id="loader" class="text-info"></span>
                        </div>
                    </div>
                </form>
                <div class="kelas-baru-kode text-center hidden">
                    <label class="text-info">Kelompok baru saja dibuat, ini kode kelasnya</label>
                    <h1 class="text-center text-capitalize alert alert-success kelas-uuid-baru">GENERATE</h1>
                    <p class="text-success"><span class="label label-info"><i class="fa fa-info"></i></span> Gunakan kode tersebut untuk siswa bergabung dengan kelas ini.</p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>
<!-- /modals -->
<!-- /modals -->
<div class="modal fade klm-ikut-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Kelompok Baru</h4>
            </div>
            <div class="modal-body">
                <form name="fkelas_ikut" class="form-horizontal text-center" method="post" action="<?php echo site_url('group/kelompok/join/');?>" novalidate>
                    <div class="item form-group">
                        <label class="text-center col-md-12 col-sm-12 col-xs-12">Kode Kelompok<span class="required">*</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input class="form-control col-md-7 kelas-uuid-baru text-center col-xs-12" data-validate-length-range="6" data-validate-words="2" name="kode" required="required" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button id="send" type="submit" class="btn btn-success col-md-12">JOIN</button>
                            <span id="" class="text-info loader"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>
<!-- /modals -->
