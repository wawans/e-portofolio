<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi &mdash; Prototype</title>
    <link href="<?= theme_url(); ?>/css/style.css" rel="stylesheet">
    <link href="<?= theme_url(); ?>/css/custom.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?= theme_url(); ?>/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?= theme_url(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= theme_url(); ?>/js/app.js"></script>
    <script type="text/javascript">
        // Global
        var _site_url  = '<?php echo site_url(); ?>/';
        var _base_url  = '<?php echo base_url(); ?>';
        var _theme_url = '<?php echo theme_url(); ?>/';
    </script>
</head>
<body>
<?php foreach ($user as $user): ?>
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="width-100">
                <form name="fnilai_baru" method="post" action="<?php echo site_url('portofolio/nilai/simpan/'.$user->kd_tugas.'/'.$user->kd_user); ?>" validate>
                <table>
                    <tr class="black">
                        <th colspan="2" class="text-centered"><h3 class="white-text">Form Penilaian</h3></th>
                    </tr>
                    <tr>
                        <th class="width-33">Nama</th>
                        <th class="lead"><?= $user->nm_awal.' '.$user->nm_akhir; ?></th>
                    </tr>
                    <tr>
                        <th>Lampiran</th>
                        <td><a href="<?php echo base_url('public/uploads/'.$user->file);?>" target="_blank"><i class="fa fa-paperclip"></i> <?=$user->name; ?></a></td>
                    </tr>
                    <tr>
                        <th>Sikap</th>
                        <td><input autofocus="yes" required type="text" name="n1" class="text-right"></td>
                    </tr>
                    <tr>
                        <th>Pengetahuan</th>
                        <td><input required type="text" name="n2" class="text-right"></td>
                    </tr>
                    <tr>
                        <th>Ketrampilan</th>
                        <td><input required type="text" name="n3" class="text-right"></td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td><input type="text" name="n4" class="text-right" readonly value="-"></td>
                    </tr>
                    <tr>
                        <th>Presentasi</th>
                        <td><input required type="text" name="n5" class="text-right"></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><input class="black white-text" type="submit" value="Simpan"> &nbsp; <span class="loader"></span></td>
                    </tr>
                </table>
                    </form>
            </div>
        </div>
        <div class="clear"></div>
        <br />
        <div class="row inline">
            <div class="width-33 text-centered"><?php if ($a>1): ?><a href="<?= site_url('portofolio/nilai/menilai/'.$tugas.'/'.($a-1).'/'.$z); ?>" class="width-100"><< Sebelumnya </a><?php endif; ?>&nbsp;</div>
            <div class="width-33 text-centered centered"><button type="button" class="text-centered white-text black" onclick="window.close();">Tutup</button></div>
            <div class="width-33 text-centered">&nbsp;<?php if ($a<$z): ?><a href="<?= site_url('portofolio/nilai/menilai/'.$tugas.'/'.($a+1).'/'.$z); ?>" class="width-100"> Selanjutnya >></a><?php endif; ?></div>
        </div>
    </div>
</div>
<?php endforeach; ?>