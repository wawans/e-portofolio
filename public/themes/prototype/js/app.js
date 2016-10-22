/*$(document).ready(function() {*/
$(window).load(function () {
    FastClick.attach(document.body);
});

$(function () {
    // Global Var
    var _submited = false;
    var _timeout = 30000;
    var _loader = '<i class="fa fa-2x fa-spinner fa-spin"></i> Mohon Tunggu ...';
    var $kd_kelas = '';
    var $kd_tugas = '';
    var $kd_uuid = '';

    // init
    $('.main_container').css('height', $(window).height());
    $('.page').css('min-height','350px');
    $.ajaxSetup({
        timeout: _timeout
    });
    // form login
    $('form[name=flogin]').submit(function(e){
        var $form   = $(this),
            $url    = $form.attr('action'),//_site_url+'masuk/',
            $loader = $('#loader');
        e.preventDefault();
        if (_submited==false) {
            $loader.html(_loader);
            $('.parsley-error-list').remove();
            $.post($url,$form.serialize(), function(data){
                $loader.html('');
                if (data.return == '00') {
                    window.location = _site_url+'home';
                }
                else if (data.return == '10') {
                    $.each(data, function (index, result) {                    
                    $('input[name="' + index + '"]').addClass('parsley-error').after('<span class="text-danger parsley-error-list">' + result + '</span>');
                });
                } else if (data.return == '20') {
                    $loader.html('<span class="text-danger">Gagal! '+data.mesage+'</span>');
                } else {
                    $loader.html('<span class="text-danger">Gagal!</span>');
                }

            },'json').fail(function() {
                $loader.html('<span class="text-danger">Gagal!</span>');
            });
            _submited=false;
        }
    });

    /**
     * Daftar
     */
    $('form[name=fsignup]').submit(function(e){
        var $form   = $(this),
            $url    = $form.attr('action'),//_site_url+'masuk/',
            $loader = $('#loader');
        e.preventDefault();
        $('.parsley-error').removeClass('parsley-error');
        if (_submited==false) {
            $loader.html(_loader);
            $('.parsley-error-list').remove();
            $.post($url,$form.serialize(), function(data){
                $loader.html('');
                if (data.return == '00') {
                    $loader.html('<span class="text-success">Berhasil!. Silahkan klik Masuk!.</span>');
                }
                else if (data.return == '10') {
                    $.each(data, function (index, result) {
                    $('input[name="' + index + '"]').addClass('parsley-error').after('<span class="text-danger parsley-error-list">' + result + '</span>');
                });
                } else if (data.return == '20') {
                    $loader.html('<span class="text-danger">Gagal! '+data.mesage+'</span>');
                } else {
                    $loader.html('<span class="text-danger">Gagal!</span>');
                }

            },'json').fail(function() {
                $loader.html('<span class="text-danger">Gagal!</span>');
            });
            _submited=false;
        }
    });

    // hal kelas
    $('#buat-kelas-baru').click(function(){
        $('form[name=fkelas_baru]').show();
        $('.kelas-baru-kode').addClass('hidden');
        $('.kelas-baru-kode').addClass('hide');
    });
    $('form[name=fkelas_baru]').submit(function(e){
        var $form   = $(this),
            $url    = $form.attr('action'),//_site_url+'masuk/',
            $loader = $('#loader');
        e.preventDefault();
        $('.parsley-error').removeClass('parsley-error');
        if (_submited==false) {
            $loader.html(_loader);
            $('.parsley-error-list').remove();
            $.post($url,$form.serialize(), function(data){
                $loader.html('');
                if (data.return == '00') {
                    $form.hide();
                    $('.kelas-baru-kode').removeClass('hidden');
                    $('.kelas-baru-kode').removeClass('hide');
                    $('.kelas-uuid-baru').html(data.uuid);
                }
                else if (data.return == '10') {
                    $.each(data, function (index, result) {
                    $('input[name="' + index + '"]').addClass('parsley-error').after('<span class="text-danger parsley-error-list">' + result + '</span>');
                });
                } else if (data.return == '20') {
                    $loader.html('<span class="text-danger">Gagal! '+data.mesage+'</span>');
                } else {
                    $loader.html('<span class="text-danger">Gagal!</span>');
                }

            },'json').fail(function() {
                $loader.html('<span class="text-danger">Gagal!</span>');
            });
            _submited=false;
        }
    });
    $('form[name=fkelas_ikut]').submit(function(e){
        var $form   = $(this),
            $url    = $form.attr('action'),
            $loader = $('form[name=fkelas_ikut] .loader');
        e.preventDefault();
        $('.parsley-error').removeClass('parsley-error');
        if (_submited==false) {
            $loader.html(_loader);
            $('.parsley-error-list').remove();
            $.post($url,$form.serialize(), function(data){
                $loader.html('');
                if (data.return == '00') {
                    window.location = window.location.href;
                }
                else if (data.return == '10') {
                    $.each(data, function (index, result) {
                        $('input[name="' + index + '"]').addClass('parsley-error').after('<span class="text-danger parsley-error-list">' + result + '</span>');
                    });
                } else if (data.return == '20') {
                    $loader.html('<span class="text-danger">Gagal! '+data.mesage+'</span>');
                } else {
                    $loader.html('<span class="text-danger">Gagal!</span>');
                }
            },'json').fail(function() {
                $loader.html('<span class="text-danger">Gagal!</span>');
            });
            _submited=false;
        }
    });
    $('form[name=ftugas_baru]').submit(function(e){
        var $form   = $(this),
            $url    = $form.attr('action'),
            $loader = $('form[name=ftugas_baru] .loader');
        e.preventDefault();
        $('.parsley-error').removeClass('parsley-error');
        if (_submited==false) {
            _submited=true;
            $loader.html(_loader);
            $('.parsley-error-list').remove();
            $.post($url,$form.serialize(), function(data){
                $loader.html('');
                if (data.return == '00') {
                    //window.location = window.location.href;
                    $loader.html('<span class="text-success">Tersimpan!</span>');
                    $kd_tugas = data.kode;
                    $kd_uuid = data.uuid;
                    _submited=false;
                }
                else if (data.return == '10') {
                    $.each(data, function (index, result) {
                        $('input[name="' + index + '"]').addClass('parsley-error').after('<span class="text-danger parsley-error-list">' + result + '</span>');
                    });
                    _submited=false;
                } else if (data.return == '20') {
                    $loader.html('<span class="text-danger">Gagal! '+data.mesage+'</span>');
                    _submited=false;
                } else {
                    $loader.html('<span class="text-danger">Gagal!</span>');
                    _submited=false;
                }
            },'json').fail(function() {
                $loader.html('<span class="text-danger">Gagal!</span>');
                _submited=false;
            });
        }
    });

    $('form[name=fnilai_baru]').submit(function(e){
        var $form   = $(this),
            $url    = $form.attr('action'),
            $loader = $('form[name=fnilai_baru] .loader');
        e.preventDefault();
        $('.parsley-error').removeClass('parsley-error');
        if (_submited==false) {
            _submited=true;
            $loader.html(_loader);
            $('.parsley-error-list').remove();
            $.post($url,$form.serialize(), function(data){
                $loader.html('');
                if (data.return == '00') {
                    $loader.html('<span class="text-success">Tersimpan!</span>');
                    _submited=false;
                }
                else if (data.return == '10') {
                    $.each(data, function (index, result) {
                        $('input[name="' + index + '"]').addClass('parsley-error').after('<span class="text-danger parsley-error-list">' + result + '</span>');
                    });
                    _submited=false;
                } else if (data.return == '20') {
                    $loader.html('<span class="text-danger">Gagal! '+data.mesage+'</span>');
                    _submited=false;
                } else {
                    $loader.html('<span class="text-danger">Gagal!</span>');
                    _submited=false;
                }
            },'json').fail(function() {
                $loader.html('<span class="text-danger">Gagal!</span>');
                _submited=false;
            });
        }
    });

    $('form[name=fupload]').submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            processData: false,
            contentType: false
        });
        var $form   = $(this),
            $url    = $form.attr('action'),
            $loader = $('.loading-upload');
        var ofile=document.getElementById('filename').files[0];
        var formdata = new FormData();
        formdata.append("filename",ofile);

            $loader.html('<i class="fa fa-2x fa-spinner fa-spin"></i> Mengunggah ...');
            $('.parsley-error-list').remove();
            $.post($url+'/'+$kd_uuid,formdata, function(data){
                $loader.html('');
                if (data.return == '00') {
                    $('.list-uploaded').append(
                        '<tr class="list-unstyled col-md-12 '+data.idx+' list-inline">'+
                        '<td><a target="_blank" href="'+data.url_file+'"><i class="fa fa-paperclip"></i> '+data.name+'</a></td>'+
                        '<td class="red-text"><a class="rm-file" onclick="rm_file(\''+data.idx+'\');" data-ul="'+data.idx+'" href="javascript:;" data-href="'+data.url_del+'"><i class="fa fa-trash-o"></i> Hapus</a></td>'+
                        '</tr>'
                    );
                } else if (data.return == '20') {
                    $loader.html('<span class="text-danger">Gagal! '+data.mesage+'</span>');
                } else {
                    $loader.html('<span class="text-danger">Gagal!</span>');
                }
            },'json').fail(function() {
                $loader.html('<span class="text-danger">Gagal!</span>');
            });
    });

    $('form[name=fut]').submit(function(e){
        e.preventDefault();

        $.ajaxSetup({
            processData: false,
            contentType: false
        });
        var $form   = $(this),
            $url    = $form.attr('action'),
            $loader = $('.loading-upload');
        var ofile=document.getElementById('filename').files[0];
        var formdata = new FormData();
        formdata.append("filename",ofile);

        $loader.html('<i class="fa fa-2x fa-spinner fa-spin"></i> Mengunggah ...');
        $('.parsley-error-list').remove();
        $.post($url,formdata, function(data){
            $loader.html('');
            if (data.return == '00') {
                $('.uploaded-file').html(
                    '<label class="'+data.idx+'">'+
                        '<a target="_blank" href="'+data.url_file+'"><i class="fa fa-paperclip"></i> '+data.name+'</a> &mdash;'+
                        '<em><a class="rm-file" onclick="rm_file(\''+data.idx+'\');" data-ul="'+data.idx+'" href="javascript:;" data-href="'+data.url_del+'"><i class="fa fa-trash-o"></i> Hapus</a></em>'+
                        '</label>'
                );
            } else if (data.return == '20') {
                $loader.html('<span class="text-danger">Gagal! '+data.mesage+'</span>');
            } else {
                $loader.html('<span class="text-danger">Gagal!</span>');
            }
        },'json').fail(function() {
            $loader.html('<span class="text-danger">Gagal!</span>');
        });
    });

});
var rm_file = function(e){
    var x = $('[data-ul='+e+']');
    $.post(x.attr('data-href'));
    if (e=='uploaded-file') {
        $('#'+e).html('&mdash;');
    } else {
        $('.'+e).remove();
    }
};
