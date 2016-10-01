<div class="width-80" role="main">
    <div class="row">
        <div class="width-100">
            <table>
                <caption>Detail Kelas</caption>
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Author</th>
                    <th>UUID</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?=$get_uuid->nm_kelas;?></td>
                    <td><?=$get_uuid->nm_awal;?> <?=$get_uuid->nm_akhir;?></td>
                    <td><?=$get_uuid->kd_uuid;?></td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
            <ul class="nav nav-tabs">
                <li class="col-md-4 col-sm-4 col-xs-12 active"><a href="#Activity">Activity</a></li>
                <li class="col-md-4 col-sm-4 col-xs-12"><a href="#Kelompok">Kelompok</a></li>
                <li class="col-md-4 col-sm-4 col-xs-12"><a href="#Siswa">Siswa</a></li>
            </ul>
            <br />
    <div class="row" id="Activity">
        <div class="width-100">
            <table>
                <caption>Activity</caption>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Abstrak</th>
                    <th>Lampiran</th>
                    <th>Tanggal</th>
                    <th>Author</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($tugas)):
                foreach($tugas as $item): ?>
                    <tr>
                        <td><a class="btn btn-sm btn-primary" href="<?php echo site_url('portofolio/tugas/detail/'.$get_uuid->kd_uuid.'/'.$item->kd_uuid); ?>">Detail</a></td>
                        <td><?=$item->judul; ?></td>
                        <td><?=$item->konten; ?></td>
                        <td><?php if($item->lampiran > 0): ?>
                                <ul>
                                    <?php if($item->lampiran == 1): ?>
                                        <li><a href="<?php echo base_url('public/uploads/'.$item->filename);?>" target="_blank"><i class="fa fa-paperclip"></i> <?=$item->filename; ?></a></li>
                                    <?php elseif($item->lampiran > 1): ?>
                                        <?php $emp = explode(',',$item->filename); foreach ($emp as $lamp): ?>
                                            <li><a href="<?php echo base_url('public/uploads/'.$lamp);?>" target="_blank"><i class="fa fa-paperclip"></i> <?=$lamp; ?></a></li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?></td>
                        <td><a><?=$item->tgl_awal; ?></a></td>
                        <td><a><?=$item->kd_user; ?></a></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
            </div>
        </div>
    <div class="clear"></div>
    <br />
<h3 id="Kelompok">Kelompok</h3>
    <div class="row">
        <div class="row">
            <!-- /modals -->
            <div class="modal fade klm-baru-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Buat Kelompok Baru</h4>
                        </div>
                        <div class="modal-body">
                            <form name="fkelas_baru" class="form-horizontal form-label-left" method="post" action="<?php echo site_url('group/kelompok/create/');?>">
                                <input type="hidden" hidden="hidden" class="hidden hide" name="kelas" value="<?= $get_uuid->kd_uuid; ?>">
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
                            <div class="kelas-baru-kode text-center hide hidden">
                                <label class="text-info">Kelompok baru saja dibuat, ini kode kelasnya</label>
                                <h1 class="text-center text-capitalize alert alert-success kelas-uuid-baru">GENERATE</h1>
                                <p class="text-success"><span class="label label-info"><i class="fa fa-info"></i></span> Gunakan kode tersebut untuk siswa bergabung dengan kelas ini.</p>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <!-- /modals -->
        </div>
        <div class="row">
            <!-- /modals -->
            <div class="modal fade klm-ikut-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Ikut Kelompok Baru</h4>
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

                    </div>
                </div>
            </div>
            <!-- /modals -->
        </div>
        </div>
    <div class="row">
        <div class="width-100">
            <table>
                <caption>Kelompok Siswa</caption>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Author</th>
                    <th>Kuota</th>
                    <th>UUID</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($get_kelompok_kelas)):
                foreach ($get_kelompok_kelas as $idx): ?>
                    <tr>
                        <td><a href="<?php echo site_url('group/kelompok/detail/'.$idx->kl_uuid);?>" class="btn btn-success" style="width: 100%">PILIH</a></td>
                        <td><?= $idx->nm_kelompok; ?></td>
                        <td><?= $idx->nm_awal.' '.$idx->nm_akhir; ?></td>
                        <td><?= $idx->cnt.' / '.$idx->maks; ?></td>
                        <td><?= $idx->kl_uuid; ?></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="clear"></div>
    <br />
    <h3 id="Siswa">Siswa</h3>
    <div class="row">
        <div class="width-100">
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th># OPSI #</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($get_kelas_siswa)):
                    $x=1;
                    foreach ($get_kelas_siswa as $idx): ?>
                        <tr id="s_<?= $idx->kd_uuid; ?>">
                            <td><?= $x; ?></td>
                            <td><?= $idx->nm_awal.' '.$idx->nm_akhir; ?></td>
                            <td><a href="<?php echo site_url('group/kelas/drop_member/'.$get_uuid->kd_uuid.'/'.$idx->kd_uuid);?>">Hapus</a></td>
                        </tr>
                    <?php $x++; endforeach; endif; ?>
                </tbody>
            </table>
            </div>
        </div>

</div>
</div>



