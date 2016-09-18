<div class="width-80" role="main">
    <div class="row">
        <div class="width-100">
            <div class="x_panel" style="height:100%;">
                <div class="x_title">
                    <h2><i class="fa fa-graduation-cap"></i> Kelas</h2>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <!-- /modals -->
            <div class="modal fade kelas-baru-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Kelas Baru</h4>
                        </div>
                        <div class="modal-body">
                            <form name="fkelas_baru" class="form-horizontal form-label-left" method="post" action="<?php echo site_url('group/kelas/create/');?>" novalidate>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kelas<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nama" required="required" type="text">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Maks. Kuota
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="maks" value="50"  required="required" type="number">
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
                            <div class="kelas-baru-kode text-center hidden hide">
                                <label class="text-info">Kelas baru saja dibuat, ini kode kelasnya</label>
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
            <div class="modal fade kelas-ikut-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Join Kelas Baru</h4>
                        </div>
                        <div class="modal-body">
                            <form name="fkelas_ikut" class="form-horizontal text-center" method="post" action="<?php echo site_url('group/kelas/join/');?>" novalidate>
                                <div class="item form-group">
                                    <label class="text-center col-md-12 col-sm-12 col-xs-12">Kode Kelas<span class="required">*</span>
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
                <caption>Kelas Yang Saya Ikuti</caption>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Siswa</th>
                    <th>Kelompok</th>
                    <th>Tugas</th>
                    <th>UUID</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($kelas as $idx): ?>
                    <tr>
                        <td><a href="<?php echo site_url('group/kelas/detail/'.$idx->kd_uuid);?>" class="btn btn-success" style="width: 100%">PILIH</a></td>
                        <td><?= $idx->nm_kelas; ?></td>
                        <td><?= $idx->anggota; ?></td>
                        <td><?= $idx->klm; ?></td>
                        <td>&mdash;</td>
                        <td><?= $idx->kd_uuid; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>
</div>
</div>
</div>


