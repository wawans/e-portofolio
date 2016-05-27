/*$(document).ready(function() {*/
$(function () {
    // Global Var
    var _submited = false;
    var _timeout = 30000;
    var _loader = '<i class="fa fa-2x fa-spinner fa-spin"></i> Mohon Tunggu ...';

    // init
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
            $loader = $('form[name=fkelas_ikut] .loader');
        e.preventDefault();
        $('.parsley-error').removeClass('parsley-error');
        if (_submited==false) {
            _submited=true;
            $loader.html(_loader);
            $('.parsley-error-list').remove();
            $.post($url,$form.serialize(), function(data){
                $loader.html('');
                if (data.return == '00') {
                    window.location = window.location.href;
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
});