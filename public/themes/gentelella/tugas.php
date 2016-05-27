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
                            <div class="col-md-1 xdisplay_inputx form-group has-feedback">
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
                        <div class="form-inline form-horizontal ">
                            <label class="control-label left" style="text-align: left !important;">
                                <button onclick="$('input[name=filename]').trigger('click');" type="button" class="btn btn-primary">Lampirkan Berkas</button>
                            </label>
                            <div class="col-md-8 list-uploaded">
<!--
                                <ul class="list-unstyled col-md-12 list-inline">
                                    <li><a href="javscript:;"><i class="fa fa-paperclip"></i> File-name.doc</a></li>
                                    <li><a href="javscript:;"><i class="fa fa-trash-o"></i> Hapus</a></li>
                                </ul>
                                <ul class="list-unstyled col-md-12 list-inline">
                                    <li><a href="javscript:;"><i class="fa fa-paperclip"></i> File-name.doc</a></li>
                                    <li><a href="javscript:;"><i class="fa fa-trash-o"></i> Hapus</a></li>
                                </ul>-->
<!--                                <table class="table ">
                                    <tr>
                                        <th colspan="2">lam</th>
                                    </tr>
                                    <tr>
                                        <td class="no-border"><a href="javscript:;"><i class="fa fa-paperclip"></i> File-name.doc</a></td>
                                        <td class="no-border"><a href="javscript:;"><i class="fa fa-trash-o"></i> Hapus</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="javscript:;"><i class="fa fa-paperclip"></i> File-name.doc</a></td>
                                        <td><a href="javscript:;"><i class="fa fa-trash-o"></i> Hapus</a></td>
                                    </tr>
                                </table>
-->                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="ln_solid"></div>
                        <button id="send" type="submit" class="btn btn-success">Simpan</button>
                        <span class="text-info loader"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden form Upload -->
<form class="hide hidden" name="fupload" action="<?php echo site_url('portofolio/media/put_file'); ?>" method="post" enctype="multipart/form-data">
    <input type="file" id="filename" name="filename" onchange="$('form[name=fupload]').submit();" />
</form>
<!-- Hidden form Upload -->
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

