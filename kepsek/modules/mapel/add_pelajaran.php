<?php


if (isset($_POST['tambah'])) {
    // function ubahformatTgl($tanggal) {
    //     $pisah = explode('/',$tanggal);
    //     $urutan = array($pisah[2],$pisah[1],$pisah[0]);
    //     $satukan = implode('-',$urutan);
    //     return $satukan;
    // }
    
    
    $kd_mapel = antiinjection($_POST['kd_mapel']);
    $mapel = antiinjection($_POST['mapel']);
    $nip = antiinjection($_POST['nip']);
    
    $cekdata =mysqli_query($link, "select kd_mapel from tbl_mapel where kd_mapel ='$kd_mapel'");
    //$ada = mysqli_query($link, $cekdata)or die(mysqli_error());
    if(mysqli_num_rows($cekdata)>0){
    $alert = "<div class='alert alert-dismissable alert-warning'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Upps..!!</strong>
                Maaf, Data Pelajaran yang Anda Masukkan Sudah ada.!!
               
             </div>";
            $_SESSION['alert'] = $alert;
           
                
            //header("location:index.php?modul=datastaf");
 
}else{
    $s = mysqli_query($link, "INSERT Into tbl_mapel set kd_mapel='" . $kd_mapel . "', 
                    nama_mapel='".$mapel."',nip='".$nip."'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Pelajaran Berhasil Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Pelajaran Gagal Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    }
}
    ?>
    <script type="text/javascript">document.location="index.php?admin=dt_mapel";</script>
    <?php
}
