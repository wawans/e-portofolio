<!-- page content -->
<div class="width-80" role="main">
    <div class="row">
        <div class="width-100">
            <h3 class="blue-text">Detail Tugas : <?= $data_tugas->judul;?></h3>
        </div>
    </div>
    <div class="row">
        <div class="width-100">
            <table>
                <tr>
                    <th>Judul</th>
                    <td><?= $data_tugas->judul;?></td>
                </tr>
                <tr>
                    <th>Abstrak</th>
                    <td><?= $data_tugas->konten;?></td>
                </tr>
                <tr>
                    <th>Valid s.d</th>
                    <td><?= $data_tugas->tgl_akhir;?></td>
                </tr>
                <tr>
                    <th>Tipe Tugas</th>
                    <td><?= ($data_tugas->jns_grup==1)?"Individu":"Kelompok";?></td>
                </tr>
                <tr>
                    <th>Penilaian</th>
                    <td><?= ($data_tugas->jns_nilai==1)?"Guru":"Semua";?></td>
                </tr>
                <tr>
                    <th>Lampiran</th>
                    <td><?php if ($data_tugas->lampiran > 0): ?>
                            <ol>
                                <?php foreach ($data_lampiran as $item): ?>
                                    <li><a href="<?php echo base_url('public/uploads/'.$item->filename);?>" target="_blank"><i class="fa fa-paperclip"></i> <?=$item->filename; ?></a></li>
                                <?php endforeach; ?>
                            </ol>
                        <?php endif; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="width-100">
            <form name="fut" enctype="multipart/form-data" method="post" action="<?php echo site_url('portofolio/tugas/join/'.$kelas_uuid.'/'.$data_tugas->kd_uuid); ?>">
            <table>
                <caption class="blue-text">Submission Tugas Anda</caption>
                <tr>
                    <th>Berkas Terunggah</th>
                    <td class="uploaded-file" id="uploaded-file">
                        <?php if ($my_lampiran): ?>
                        <a href="<?php echo base_url('public/uploads/'.$my_lampiran->filename);?>" target="_blank"><i class="fa fa-paperclip"></i> <?=$my_lampiran->filename; ?></a>
                            &mdash;
                            <em><a class="rm-file" onclick="rm_file('uploaded-file');" data-ul="uploaded-file" href="javascript:;" data-href="<?=site_url('portofolio/media/drop/id/'.$my_lampiran->kd_media);?>"><i class="fa fa-trash-o"></i> Hapus</a></em>
                        <?php else: ?>
                            &mdash;
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Unggah Baru</th>
                    <td><label class="btn btn-primary">
                            <input type="file" name="filename" id="filename">
                        </label>
                        <input type="submit" name="submit" class="btn btn-success" value="Kirim">
                        <span class="text-info loading-upload"></span>
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="width-100">
            <table>
                <caption class="blue-text">Hasil</caption>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Tugas</th>
                    <th>Nilai</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /page content -->