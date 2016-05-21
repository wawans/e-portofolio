<div class="site-body centered-content">
    <div class="site-center">
        <div class="cell">
            <div class="col content">
                <div class="col panel width-1of2 center mobile-width-fill">
                    <div class="header">
                        Buat kelas
                    </div>
                    <div class="body">
                        <div class="cell">
                            <div class="col">
                                <div class="cell">
                                    <form method="post" target="_blank" action="<?php echo site_url('group/kelas/create/');?>">
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">
                                                    <label>Nama Kelas</label>
                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <input name="nama" type="text" class="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">
                                                    <label>Maks. Kuota</label>
                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <input name="maks" type="number" class="text" value="50">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">

                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <button type="submit" id="submit" class="button">Buat</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="cell">
                    <h2>Semua Kelas</h2>
                </div>
            </div>
            <div class="col">
                <div class="">
                    <table class="outline-header horizontal-border">
                        <thead>
                        <tr>
                            <th class="width-1of6">#UID</th>
                            <th class="width-1of6">Nama</th>
                            <th class="width-1of6">Maks</th>
                            <th class="width-1of6">Anggota</th>
                            <th class="width-1of6">Pembuat</th>
                            <th>#OPSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($all as $idx): ?>
                        <tr>
                            <td><?= strtoupper($idx->kd_uuid);?></td>
                            <td><?= $idx->nm_kelas; ?></td>
                            <td><?= $idx->maks; ?></td>
                            <td><?= $idx->anggota; ?></td>
                            <td><?= $idx->nm_awal.' '.$idx->nm_akhir; ?></td>
                            <td><a target="_blank" href="<?php echo site_url('group/kelas/join/'.$idx->kd_uuid);?>"> Join </a> | Edit | <a target="_blank" href="<?php echo site_url('group/kelas/drop/'.$idx->kd_uuid);?>"> Hapus </a> | <a target="_blank" href="<?php echo site_url('group/kelas/join_out/'.$idx->kd_uuid);?>"> Quit </a> </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col content">
                <div class="col panel width-1of2 center mobile-width-fill">
                    <div class="header">
                        Edit kelas &mdash; <em>Manual</em>
                    </div>
                    <div class="body">
                        <div class="cell">
                            <div class="col">
                                <div class="cell">
                                    <form method="post" target="_blank" action="<?php echo site_url('group/kelas/update/');?>">
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">
                                                    <label>Kode Kelas</label>
                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <input name="kode" type="text" class="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">
                                                    <label>Nama Kelas</label>
                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <input name="nama" type="text" class="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">
                                                    <label>Maks. Kuota</label>
                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <input name="maks" type="number" class="text" value="50">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col width-1of4">
                                                <div class="cell">

                                                </div>
                                            </div>
                                            <div class="col width-fill">
                                                <div class="cell">
                                                    <button type="submit" id="submit" class="button">Buat</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


