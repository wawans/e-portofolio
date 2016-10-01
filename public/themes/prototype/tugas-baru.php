<div class="width-80" role="main">
    <div class="row">
        <div class="width-100">
                    <h2><i class="fa fa-book"></i> Tugas Baru</h2>
                    </div>
        </div>
    <div class="row">
                <div class="width-100">
                    <form name="ftugas_baru" method="post" action="<?php echo site_url('portofolio/tugas/baru/'.$kelas_uuid); ?>">
                        <table>
                            <tr>
                                <th class="width-25">Judul / Subject :</th>
                                <td><input class="form-control width-100" type="text" required="" name="judul"></td>
                            </tr>
                            <tr>
                                <th>Isi :</th>
                                <td><textarea class="form-control" name="konten"></textarea></td>
                            </tr>
                            <tr>
                                <th>Jangka</th>
                                <td><input name="tgl_awal" value="<?=date('Y-m-d');?>" type="text" class="form-control has-feedback-left">
                                    <label class="text-center"> s.d </label>
                                    <input name="tgl_ahir" value="<?=date('Y-m-d');?>" type="text" class="form-control has-feedback-left">
                                </td>
                            </tr>
                            <tr>
                                <th>Tipe Tugas</th>
                                <td><div class="radio radio-inline col-md-2">
                                        <label><input name="jns_grup" type="radio" value="1" checked> Individu.</label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <label><input name="jns_grup" type="radio" value="2">Kelompok.</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Penilai</th>
                                <td><div class="radio radio-inline col-md-2">
                                        <label><input name="jns_nilai" type="radio" value="1" checked> Guru.</label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <label><input name="jns_nilai" type="radio" value="2"> Guru &amp; Siswa.</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Publik</th>
                                <td><div class="radio radio-inline col-md-2">
                                        <label><input name="publik" type="radio" value="1" checked> Ya, Segera.</label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <label><input name="publik" type="radio" value="0"> Tidak, Simpan Draf.</label>
                                    </div></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td> <p class="text-info"><span class="label label-info"><i class="fa fa-info"></i></span> Anda dapat mengunggah <span class="label label-danger">lampiran</span> setelah tugas disimpan.</p>
                                   <!--<p class="text-info"><span class="label label-info"><i class="fa fa-info"></i></span> Klik <span class="label label-primary">Baru</span> untuk selesai.</p>-->

                                    <div class="clearfix"></div>
                                    <div class="divider-dashed"></div>

                                    <button id="send" type="submit" class="btn btn-success">Simpan</button>
                                    <!--<a href="#" id="tugas-after-modal" data-toggle="modal" data-target=".tugas-after-modal" class="btn btn-danger">Lampiran</a>-->
                                    <span class="text-info loader"></span>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
    <div class="row">
        <div class="width-100">
            <table>
                <tr>
                    <th class="width-25">Unggah Lampiran</th>
                    <td><button onclick="$('input[name=filename]').trigger('click');" type="button" class="btn col-md-12 btn-primary">Lampirkan Berkas</button></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td><div class="col-md-12">
                            <table class="list-uploaded">

                            </table>

                        </div>
                        <span class="loading-upload"></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="width-100">
            <table>
                <tr>
                    <th class="width-25"></th>
                    <td><button type="reset" onclick="window.location=window.location.href;" class="btn btn-primary">Selesai</button></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Hidden form Upload -->
<form class="hide hidden" name="fupload" action="<?php echo site_url('portofolio/media/uploader/'); ?>" method="post" enctype="multipart/form-data">
    <input type="file" id="filename" name="filename" onchange="$('form[name=fupload]').submit();" />
</form>
<!-- Hidden form Upload -->
