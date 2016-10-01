<div class="width-80" role="main">
    <div class="row">
        <div class="width-100">
            <table>
                <caption>Detail Kelompok</caption>
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Author</th>
                    <th>Anggota</th>
                    <th>UUID</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?=$get_detail->nm_kelompok;?></td>
                    <td><?=$get_detail->nm_awal;?> <?=$get_detail->nm_akhir;?></td>
                    <td><?= $get_detail->cnt.' / '.$get_detail->maks; ?></td>
                    <td><?=$get_detail->kd_uuid;?></td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    <div class="row">
        <div class="width-100">
            <h2>Tugas &andand; filter tugas kelompok by ajax</h2>
        </div>
    </div>
    <br/>
    <h3 >Anggota</h3>
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
                <?php if(isset($get_uuid_member)):
                    $x=1;
                    foreach ($get_uuid_member as $idx): ?>
                        <tr id="s_<?= $idx->kd_user; ?>">
                            <td><?= $x; ?></td>
                            <td><?= $idx->nm_awal.' '.$idx->nm_akhir; ?></td>
                            <td><a href="<?php echo site_url('group/kelompok/drop_member/'.$get_detail->kd_uuid.'/'.$idx->kd_user);?>">Hapus</a></td>
                        </tr>
                        <?php $x++; endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <br/>
    <h3 >Keluar</h3>
    <a class="red-text" href="<?php echo site_url('group/kelompok/join_out/'.$get_detail->kd_uuid);?>">Keluar Dari Kelompok</a>
    <br/>
    <h3 >Hapus Kelompok</h3>
    <a class="red-text" href="<?php echo site_url('group/kelompok/drop/'.$get_detail->kd_uuid);?>">Hapus Kelompok</a>
    </div>