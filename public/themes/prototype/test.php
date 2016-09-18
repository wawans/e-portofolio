<form name="ftugas_baru" method="post" action="<?php echo site_url('tugas/baru/'.$kelas_uuid); ?>" novalidate>
    <input name="kelas" value="<?= $kelas_uuid; ?>">
    <input name="judul">
    <input name="konten">
    <input name="tgl_awal">
    <input name="tgl_akhir">
    <input name="jns_grup">
    <input name="jns_nilai">
    <input name="publik">
    <input type="submit" value="kirim">
</form>
