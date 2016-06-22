<!-- page content -->
<div class="right_col" role="main">
    <div class="">
       <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel page">
                    <div class="x_title">
                        <h2><?= $data_tugas->judul;?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <article style="min-height: 150px;"><?= $data_tugas->konten;?></article>
                        <div class="clearfix"></div>
                        <br/>
                        <?php if ($data_tugas->lampiran > 0): ?>
                        <label class="title">Lampiran</label>
                        <div class="divider-dashed"></div>
                        <div>
                            <nav class="nav">
                                <ul class="list-unstyled">
                                    <?php foreach ($data_lampiran as $item): ?>
                                        <li><a href="<?php echo base_url('public/uploads/'.$item->filename);?>" target="_blank"><i class="fa fa-paperclip"></i> <?=$item->filename; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </nav>

                        </div>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="clearfix"></div>
            </div>
           <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                   <div class="x_content">
                       <form name="ftugas_mine" method="post" action="<?php echo site_url('portofolio/tugas/baru/'.$kelas_uuid); ?>">
                           <div>
                               <h2>Unggah Hasil Tugas Anda</h2>
                           </div>
                           <div class="divider-dashed"></div>
                           <div class="form-group">
                               <label class="btn btn-primary">
                                   <input type="file" name="filename">
                               </label>
                               <input type="submit" name="submit" class="btn btn-success" value="Kirim">
                           </div>
                       </form>
                   </div>

               </div>
               <div class="clearfix"></div>
           </div>
        </div>
    </div>
</div>
<!-- /page content -->