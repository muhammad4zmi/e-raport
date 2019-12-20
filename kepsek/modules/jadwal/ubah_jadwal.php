<?php
//error_reporting(E_ALL ^(E_NOTICE | E_WARNING));
if (isset($_POST['ubah_jadwal'])&& $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_jadwal = antiinjection($_POST['id_jadwal']);
    $kd_mapel = antiinjection($_POST['kd_mapel']);
    //$mapel = antiinjection($_POST['mapel']);
    $nip = antiinjection($_POST['nip']);
    $kelas= antiinjection($_POST['kelas']);
    //$kkm=antiinjection($_POST['kkm']);

   $sql_ubah=mysqli_query($link,"update jadwal set kd_mapel='".$kd_mapel."',
                        nip ='".$nip."',id_kelas='".$kelas."' where id_jadwal='".$id_jadwal."'");
    
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
    <script type="text/javascript">document.location = "index.php?admin=jadwal";</script>
    <?php
}