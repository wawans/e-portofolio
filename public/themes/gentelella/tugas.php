<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="height:100%;">
                <div class="x_title">
                    <h2><i class="fa fa-book"></i> Tugas</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form name="ftugas_baru" method="post" action="<?php echo site_url();?>" novalidate>
                        <label>Judul / Subject :</label>
                        <input class="form-control" type="text" required="" name="fullname">
                        <label>Isi :</label>
                        <div id="alerts"></div>
                        <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
                            <div class="btn-group">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                </ul>
                            </div>

                            <div class="btn-group">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a data-edit="fontSize 5">
                                            <p style="font-size:17px">Huge</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-edit="fontSize 3">
                                            <p style="font-size:14px">Normal</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-edit="fontSize 1">
                                            <p style="font-size:11px">Small</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                                <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                                <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                                <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                            </div>

                            <div class="btn-group">
                                <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                                <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                                <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                                <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                            </div>

                            <div class="btn-group">
                                <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                                <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                                <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                                <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                            </div>

                            <div class="btn-group">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                                <div class="dropdown-menu input-append">
                                    <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                                    <button class="btn" type="button">Add</button>
                                </div>
                                <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                            </div>

                            <div class="btn-group">
                                <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                                <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                            </div>

                            <div class="btn-group">
                                <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                                <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                            </div>
                        </div>

                        <div id="editor" class="editor-wrapper"></div>

                        <textarea name="descr" id="descr" style="display:none;"></textarea>
                        <div class="clearfix"></div>
                        <br />
                        <div class="clearfix"></div>
                        <div class="form-inline form-horizontal ">
                            <label class="control-label col-md-2" style="text-align: left !important;">Jangka</label>
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                <input type="text" style="width: 200px" name="jangka" id="reservation" class="form-control" value="<?=date('m/d/Y');?> - <?=date('m/d/Y');?>" />
                            </div>
                        </div>
                        <div class="form-inline form-horizontal ">
                            <label class="control-label col-md-2" style="text-align: left !important;">Grup</label>
                            <div class="radio radio-inline col-md-2">
                                <label><input name="grup" type="radio" value="1" checked> Individu.</label>
                            </div>
                            <div class="radio radio-inline">
                                <label><input name="grup" type="radio" value="2"> Guru &amp; Kelompok.</label>
                            </div>
                        </div>
                        <div class="form-inline form-horizontal ">
                            <label class="control-label col-md-2" style="text-align: left !important;">Penilai </label>
                            <div class="radio radio-inline col-md-2">
                                <label><input name="penilai" type="radio" value="1" checked> Guru.</label>
                            </div>
                            <div class="radio radio-inline">
                                <label><input name="penilai" type="radio" value="2"> Guru &amp; Siswa.</label>
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
                        <button id="send" type="submit" class="btn btn-success">Simpan</button>
                        <span id="loader" class="text-info loader"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- bootstrap-wysiwyg -->
<script src="<?=theme_url();?>/js/bootstrap-wysiwyg.min.js"></script>
<script src="<?=theme_url();?>/js/jquery.hotkeys.js"></script>
<script src="<?=theme_url();?>/js/prettify/prettify.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?=theme_url();?>/js/moment/moment.min.js"></script>
<script src="<?=theme_url();?>/js/datepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script>
    $(document).ready(function() {
        function initToolbarBootstrapBindings() {
            var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                    'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                    'Times New Roman', 'Verdana'
                ],
                fontTarget = $('[title=Font]').siblings('.dropdown-menu');
            $.each(fonts, function(idx, fontName) {
                fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
            });
            $('a[title]').tooltip({
                container: 'body'
            });
            $('.dropdown-menu input').click(function() {
                return false;
            })
                .change(function() {
                    $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                })
                .keydown('esc', function() {
                    this.value = '';
                    $(this).change();
                });

            $('[data-role=magic-overlay]').each(function() {
                var overlay = $(this),
                    target = $(overlay.data('target'));
                overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
            });

            if ("onwebkitspeechchange" in document.createElement("input")) {
                var editorOffset = $('#editor').offset();

                $('.voiceBtn').css('position', 'absolute').offset({
                    top: editorOffset.top,
                    left: editorOffset.left + $('#editor').innerWidth() - 35
                });
            } else {
                $('.voiceBtn').hide();
            }
        }

        function showErrorAlert(reason, detail) {
            var msg = '';
            if (reason === 'unsupported-file-type') {
                msg = "Unsupported format " + detail;
            } else {
                console.log("error uploading file", reason, detail);
            }
            $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        }

        initToolbarBootstrapBindings();

        $('#editor').wysiwyg({
            fileUploadError: showErrorAlert
        });

        window.prettyPrint;
        prettyPrint();
    });

    $(document).ready(function() {
        $('#reservation').daterangepicker(null, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    });

</script>
<!-- /bootstrap-wysiwyg -->

