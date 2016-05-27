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
                        <label class="title">Lampiran</label>
                        <div class="divider-dashed"></div>
                        <div>
                            <nav class="nav">
                                <ul class="list-unstyled">
                                    <li><a><i class="fa fa-paperclip"></i> File-name.doc</a></li>
                                    <li><a><i class="fa fa-paperclip"></i> File-name.doc</a></li>
                                </ul>
                            </nav>

                        </div>
                    </div>

                </div>
                <div class="clearfix"></div>
            </div>
           <div class="col-md-12 col-sm-12 col-xs-12">
               <div class="x_panel">
                   <div class="x_content">
                       <form>
                           <div>
                               <textarea class="form-control" name="jawab"></textarea>
                           </div>
                           <div class="divider-dashed"></div>
                           <div class="form-group">
                               <label class="btn btn-primary">
                                   <input type="file" accept="application/pdf" name="lampiran">
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