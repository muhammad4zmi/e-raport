<?php


if (isset($_POST['tambah'])) {
    function ubahformatTgl($tanggal) {
        $pisah = explode('/',$tanggal);
        $urutan = array($pisah[2],$pisah[1],$pisah[0]);
        $satukan = implode('-',$urutan);
        return $satukan;
    }
    $prestasi = antiinjection($_POST['prestasi']);
    $jenis = antiinjection($_POST['jenis']);
    $tingkat = antiinjection($_POST['tingkat']);
    $waktu = antiinjection($_POST['waktu']);
    $lokasi = antiinjection($_POST['lokasi']);
    $nis = antiinjection($_POST['nis']);
    $kelas = antiinjection($_POST['kelas']);
    $ubahtgl = ubahformatTgl($waktu);
    
    $s = mysqli_query($link, "INSERT Into tbl_prestasi set nama_prestasi='" . $prestasi . "', 
                                                           jenis='".$jenis."',
                                                           tingkat='".$tingkat."',
                                                           waktu='".$ubahtgl."',
                                                           lokasi='".$lokasi."',
                                                           nis = '".$nis."',
                                                           id_kelas = '".$kelas."'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Prestasi Berhasil Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Pelajaran Gagal Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    }

    ?>
    <script type="text/javascript">document.location="index.php?admin=prestasi";</script>
    <?php
}
