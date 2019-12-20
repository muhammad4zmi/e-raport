<?php


if (isset($_POST['tambah'])) {
    // function ubahformatTgl($tanggal) {
    //     $pisah = explode('/',$tanggal);
    //     $urutan = array($pisah[2],$pisah[1],$pisah[0]);
    //     $satukan = implode('-',$urutan);
    //     return $satukan;
    // }
    
    $nis = antiinjection($_POST['nis']);
    $kelas = antiinjection($_POST['kelas']);
    $kd_mapel = antiinjection($_POST['kd_mapel']);
    $guru = antiinjection($_POST['guru']);
    $semester = antiinjection($_POST['semester']);
    $kkm = antiinjection($_POST['kkm']);
    $nilai = antiinjection($_POST['nilai']);
    $ket= antiinjection($_POST['ket']);
    
    $cekdata =mysqli_query($link, "select nis from rekap_nilai where nis ='$nis' and kd_mapel='$kd_mapel' and semester='$semester' and id_kelas='$kelas'");
    //$ada = mysqli_query($link, $cekdata)or die(mysqli_error());
    if(mysqli_num_rows($cekdata)>0){
    $alert = "<div class='alert alert-dismissable alert-warning'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Upps..!!</strong>
                Maaf, Siswa dengan NIS $nis sudah ada nilai $kd_mapel untuk semester $semester!
               
             </div>";
            $_SESSION['alert'] = $alert;
           
                
            //header("location:index.php?modul=datastaf");
 
}else{
    $s = mysqli_query($link, "INSERT Into rekap_nilai set nis='" . $nis . "', kd_mapel='".$kd_mapel."',id_kelas='".$kelas."',
                        nip='".$guru."',semester='".$semester."',kkm='".$kkm."',nilai_akhir='".$nilai."',keterangan='".$ket."'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Nilai Berhasil Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Nilai Gagal Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    }
}
    ?>
    <script type="text/javascript">document.location="index.php?admin=nilai";</script>
    <?php
}
