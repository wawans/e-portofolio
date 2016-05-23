<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="height:100%;">
                <div class="x_title">
                    <h2><i class="fa fa-user"></i> Profile</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12">
                            <form name="fconf" class="form-horizontal form-label-left" method="post" action="<?php echo site_url();?>" novalidate>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama Awal<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nama_awal" required="required" type="text">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name Akhir
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nama_akhir"  required="no" type="text">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="email" id="email" name="email" required="no" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="divider-dashed"></div>
                                <div class="form-group">
                                    <div class="col-md-5 col-md-offset-3">
                                        <button type="reset" class="btn btn-primary">Batal</button>
                                        <button id="send" type="submit" class="btn btn-success">Ubah</button>
                                        <span id="loader" class="text-info"></span>
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


