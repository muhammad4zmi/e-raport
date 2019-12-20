<?php

if (isset($_POST['ubah_guru'])&& $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = antiinjection($_POST['nip']);
    $nama_guru = antiinjection($_POST['nama_guru']);
    $jk = antiinjection($_POST['jk']);
    $lahir = antiinjection($_POST['lahir']);
    $agama = antiinjection($_POST['agama']);
    $alamat = antiinjection($_POST['alamat']);

   $sql_ubah=mysqli_query($link,"update tbl_guru set nama_guru='".$nama_guru."',
                        jk ='".$jk."',tgl_lahir='".$lahir."',agama='".$agama."'
                        ,alamat='".$alamat."' where nip='".$nip."'");
    
        if($sql_ubah){
         $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                   
                    <strong>Info!</strong> Data Berhasil Di Ubah.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class='alert alert-dismissable alert-warning'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                
                <h4>Warning..!!</h4>
                Maaf, Data Tidak bisa di Ubah..!!
               
             </div>";
            $_SESSION['alert'] = $alert;
    }

?>
    <script type="text/javascript">document.location = "index.php?admin=dt_guru";</script>
    <?php
}