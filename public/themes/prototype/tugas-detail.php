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
                    <td><?= $data_tugas->tgl_akhir;?> <em class="red-text"> &mdash; <?= (new DateTime('now')) >= (new DateTime($data_tugas->tgl_akhir))?"Unavailable":"Available";?></em> </td>
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
            <form name="fut" enctype="multipart/form-data" method="post" action="<?php echo site_url('portofolio/media/uploader/'.$data_tugas->kd_uuid); ?>">
            <table>
                <caption class="blue-text">Submission Tugas Anda</caption>
                <tr>
                    <th>Berkas Terunggah</th>
                    <td class="uploaded-file" id="uploaded-file">
                        <?php if ($my_lampiran): ?>
                        <a href="<?php echo base_url('public/uploads/'.$my_lampiran->file);?>" target="_blank"><i class="fa fa-paperclip"></i> <?=$my_lampiran->name; ?></a>
                            &mdash;
                            <em><a class="rm-file" onclick="rm_file('uploaded-file');" data-ul="uploaded-file" href="javascript:;" data-href="<?=site_url('portofolio/media/delete/'.$my_lampiran->kd_media);?>"><i class="fa fa-trash-o"></i> Hapus</a></em>
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
                <thead class="blue-grey white-text lighten-1">
                <tr>
                    <th rowspan="2" class="middle text-centered">#</th>
                    <th rowspan="2" class="middle">Nama</th>
                    <th rowspan="2" class="middle">Tugas</th>
                    <th colspan="6" class="middle text-centered">Nilai</th>
                    <th rowspan="2" class="middle text-centered"># OPSI #</th>
                </tr>
                <tr>
                    <th>S</th>
                    <th>P</th>
                    <th>K</th>
                    <th>W</th>
                    <th>%</th>
                    <th>R</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($list_participants)):
                    $x=1;
                    $m=count($list_participants);
                    foreach ($list_participants as $idx): ?>
                        <tr id="lp_<?= $idx->kd_user; ?>">
                            <td class="text-centered"><?= $x; ?></td>
                            <td><?= $idx->nm_awal.' '.$idx->nm_akhir; ?></td>
                            <td><a href="<?php echo base_url('public/uploads/'.$idx->file);?>" target="_blank"><i class="fa fa-paperclip"></i> <?=$idx->name; ?></a></td>
                            <th><?= $idx->sikap; ?></th>
                            <th><?= $idx->pengetahuan; ?></th>
                            <th><?= $idx->ketrampilan; ?></th>
                            <th><?= $idx->waktu; ?></th>
                            <th><?= $idx->presentasi; ?></th>
                            <th><?= number_format((($idx->sikap+$idx->pengetahuan+$idx->ketrampilan+$idx->waktu+$idx->presentasi)/5),1,',','.') ?></th>
                            <!--td class="text-centered"><button type="button" onclick="window.open('<?= site_url('home'); ?>', '<?= (strpos($this->input->user_agent(),'Chrome') == true) ? "Window" : "_blank" ; ?>','height=400,width=350,menubar=0,status=0,titlebar=0,toolbar=0',true); window.blur(); return false;">Nilai</button></td-->
                            <td class="text-centered"><button type="button" onclick="var x = window.open('<?= site_url('portofolio/nilai/menilai/'.$data_tugas->kd_uuid.'/'.$x.'/'.$m); ?>', 'Form Penilaian','height='+parseInt(document.body.clientHeight*2/3)+',width='+parseInt(document.body.clientWidth/2)+',menubar=0,status=0,titlebar=0,toolbar=0',true); x.focus(); /*x.print();*/ return false;">Nilai</button></td>
                        </tr>
                        <?php $x++; endforeach; endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10" class="small"><span class="req">*</span> ) S: Sikap , P: Pengetahuan , K: Ketrampilan, W: Waktu, %: Presentasi, R: Rata - rata. </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<!-- /page content -->