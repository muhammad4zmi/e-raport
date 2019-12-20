<?php


if (isset($_POST['tambah_guru'])) {
    function ubahformatTgl($tanggal) {
        $pisah = explode('/',$tanggal);
        $urutan = array($pisah[2],$pisah[1],$pisah[0]);
        $satukan = implode('-',$urutan);
        return $satukan;
    }
    
    $nip = antiinjection($_POST['nip']);
    $nama_guru = antiinjection($_POST['nama_guru']);
    $jk = antiinjection($_POST['jk']);
    $lahir = antiinjection($_POST['lahir']);
    $agama = antiinjection($_POST['agama']);
    $alamat = antiinjection($_POST['alamat']);
    $ubahtgl = ubahformatTgl($lahir);
    $cekdata =mysqli_query($link, "select nip from tbl_guru where nip ='$nip'");
    //$ada = mysqli_query($link, $cekdata)or die(mysqli_error());
    if(mysqli_num_rows($cekdata)>0){
    $alert = "<div class='alert alert-dismissable alert-warning'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Upps..!!</strong>
                Maaf, Data Guru yang Anda Masukkan Sudah ada.!!
               
             </div>";
            $_SESSION['alert'] = $alert;
           
                
            //header("location:index.php?modul=datastaf");
 
}else{
    $s = mysqli_query($link, "INSERT Into tbl_guru set nip='" . $nip . "', nama_guru='".$nama_guru."',
                        jk='".$jk."',tgl_lahir='".$ubahtgl."',agama='".$agama."',alamat='".$alamat."'");
    if ($s) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Guru Berhasil Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Guru Gagal Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    }
}
    ?>
    <script type="text/javascript">document.location="index.php?admin=dt_guru";</script>
    <?php
}
