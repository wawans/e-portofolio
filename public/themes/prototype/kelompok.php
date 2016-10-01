<div class="width-80" role="main">
    <div class="row">
        <div class="width-100">
                    <h2><i class="fa fa-users"></i> Kelompok</h2>

        </div>
        </div>
        <div class="row">

                <!-- /modals -->
                <div class="row modal fade klm-baru-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title" id="myModalLabel2">Kelompok Baru</h4>
                            </div>
                            <div class="modal-body">
                                <form name="fkelas_baru" class="form-horizontal form-label-left" method="post" action="<?php echo site_url('group/kelompok/create/');?>" novalidate>
                                    <input type="hidden" hidden="hidden" class="hidden hide" name="kelas" value="<?= $kelas_uuid; ?>">
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


                        </div>
                    </div>
                </div>
                <!-- /modals -->
                <!-- /modals -->
                <div class="row modal fade klm-ikut-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">

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

                        </div>
                    </div>
                </div>
                <!-- /modals -->

            </div>
    <div class="clear"></div>
    <div class="row">
        <div class="width-100">
            <table>
                <caption>Kelompok Siswa</caption>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Kuota</th>
                    <th>UUID</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($all)):
                    foreach ($all as $idx): ?>
                        <tr>
                            <td><a href="<?php echo site_url('group/kelompok/detail/'.$idx->kl_uuid);?>" class="btn btn-success" style="width: 100%">PILIH</a></td>
                            <td><?= $idx->nm_kelompok; ?></td>
                            <td><?= $idx->cnt.' / '.$idx->maks; ?></td>
                            <td><?= $idx->kl_uuid; ?></td>
                        </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>

            </div>
        </div>
    </div>


