<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="height:100%;">
                <div class="x_title">
                    <h2><i class="fa fa-book"></i> Tugas</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form name="ftugas_baru" method="post" action="<?php echo site_url('portofolio/tugas/baru/'.$kelas_uuid); ?>">

                        <label class="col-md-2">Judul / Subject :</label>
                        <div class="clearfix"></div>
                        <input class="form-control" type="text" required="" name="judul">


                <div class="form-group">
                        <label class="col-md-2">Isi :</label>
                    </div>
                        <div class="clearfix"></div>

                        <textarea class="form-control" name="konten"></textarea>
                        <div class="clearfix"></div>
                        <br />
                        <div class="clearfix"></div>
                        <div class="form-inline form-horizontal ">
                            <label class="control-label col-md-2" style="text-align: left !important;">Jangka</label>
                            <div class="col-md-3 xdisplay_inputx form-group has-feedback">
                                <input readonly name="tgl_awal" value="<?=date('Y-m-d');?>" type="date" class="form-control has-feedback-left">
                                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <label class="control-label col-md-1 text-center"> s.d </label>
                            <div class="col-md-3 xdisplay_inputx form-group has-feedback">
                                <input readonly name="tgl_ahir" value="<?=date('Y-m-d');?>" type="date" class="form-control has-feedback-left">
                                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-inline form-horizontal ">
                            <label class="control-label col-md-2" style="text-align: left !important;">Grup</label>
                            <div class="radio radio-inline col-md-2">
                                <label><input name="jns_grup" type="radio" value="1" checked> Individu.</label>
                            </div>
                            <div class="radio radio-inline">
                                <label><input name="jns_grup" type="radio" value="2"> Guru &amp; Kelompok.</label>
                            </div>
                        </div>
                        <div class="form-inline form-horizontal ">
                            <label class="control-label col-md-2" style="text-align: left !important;">Penilai </label>
                            <div class="radio radio-inline col-md-2">
                                <label><input name="jns_nilai" type="radio" value="1" checked> Guru.</label>
                            </div>
                            <div class="radio radio-inline">
                                <label><input name="jns_nilai" type="radio" value="2"> Guru &amp; Siswa.</label>
                            </div>
                        </div>
                        <div class="form-inline form-horizontal ">
                            <label class="control-label col-md-2" style="text-align: left !important;">Publik </label>
                            <div class="radio radio-inline col-md-2">
                                <label><input name="publik" type="radio" value="1" checked> Ya, Segera.</label>
                            </div>
                            <div class="radio radio-inline">
                                <label><input name="publik" type="radio" value="0"> Tidak, Simpan Draf.</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br />
                        <div class="clearfix"></div>
                        <div class="divider-dashed"></div>
                        <p class="text-info"><span class="label label-info"><i class="fa fa-info"></i></span> Anda dapat mengunggah <span class="label label-danger">lampiran</span> setelah tugas disimpan.</p>
                        <!--<p class="text-info"><span class="label label-info"><i class="fa fa-info"></i></span> Jika tidak ada lampiran, Klik <span class="label label-primary">Baru</span> setelah tugas disimpan.</p>-->
                        <!--<p class="text-info"><span class="label label-info"><i class="fa fa-info"></i></span> Klik <span class="label label-primary">Baru</span> setelah selesai mengunggah <span class="label label-danger">lampiran</span>.</p>-->
                        <p class="text-info"><span class="label label-info"><i class="fa fa-info"></i></span> Klik <span class="label label-primary">Baru</span> untuk selesai.</p>
                        <!--<div class="form-inline form-horizontal ">
                            <label class="control-label left" style="text-align: left !important;">
                                <button onclick="$('input[name=filename]').trigger('click');" type="button" class="btn btn-primary">Lampirkan Berkas</button>
                            </label>
                            <div class="col-md-8 list-uploaded">
                                <input class="form-control" readonly name="filelist" value="">
                            </div>
                        </div>-->
                        <div class="clearfix"></div>
                        <div class="divider-dashed"></div>
                        <button type="reset" onclick="window.location=window.location.href;" class="btn btn-primary">Baru</button>
                        <button id="send" type="submit" class="btn btn-success">Simpan</button>
                        <a href="#" id="tugas-after-modal" data-toggle="modal" data-target=".tugas-after-modal" class="btn btn-danger">Lampiran</a>
                        <span class="text-info loader"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden form Upload -->
<form class="hide hidden" name="fupload" action="<?php echo site_url('portofolio/media/put_file/save/'); ?>" method="post" enctype="multipart/form-data">
    <input type="file" id="filename" name="filename" onchange="$('form[name=fupload]').submit();" />
</form>
<!-- Hidden form Upload -->
<!-- /modals -->
<div class="modal fade tugas-after-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Unggah Lampiran</h4>
            </div>
            <div class="modal-body">
                <button onclick="$('input[name=filename]').trigger('click');" type="button" class="btn col-md-12 btn-primary">Lampirkan Berkas</button>
                <br/>
                <div class="col-md-12  list-uploaded">

                </div>
                <span class="loading-upload"></span>
            </div>

                <div class="clearfix"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>
<!-- /modals -->
<!-- bootstrap-daterangepicker -->
<script src="<?=theme_url();?>/js/moment/moment.min.js"></script>
<script src="<?=theme_url();?>/js/datepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script>

    $(document).ready(function() {
        $('input[type=date]').daterangepicker({
            singleDatePicker: true,
            minDate: moment(),
            format: 'YYYY-MM-DD',
            calender_style: "picker_1"
        });
    });

</script>
<!-- /bootstrap-wysiwyg -->

