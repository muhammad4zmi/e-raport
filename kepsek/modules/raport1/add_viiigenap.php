<?php
        if(isset($_POST['nis'])){
          $alfa=$_POST['alfa'];
          $izin=$_POST['izin'];
          $sakit=$_POST['sakit'];
          $akhlak=$_POST['akhlak'];
          $pribadi=$_POST['pribadi'];
           for ($i = 0; $i < count($_POST['nis']); $i++){
            $nis = $_POST['nis'][$i];
            $kd_mapel = $_POST['kd_mapel'][$i];
            $kkm = $_POST['kkm'][$i];
            $NA = $_POST['NA'][$i];
            $ket = $_POST['ket'][$i];
            $semester =$_POST['semester'][$i];
           
             $kelas = $_POST['kelas'][$i];
            $desk = $_POST['desk'][$i];

           
            $sql="INSERT INTO rapot (nis,kd_mapel,nilai,kkm,ket_nilai,deskripsi,semester,id_kelas)
                       values('$nis','$kd_mapel','$NA','$kkm','$ket','$desk','$semester','$kelas')";
           
           
           
                $query = mysqli_query($link, $sql);
           //echo $sql;    
               
         
      }
      $sql1="INSERT INTO presensi (alfa,izin,sakit,pribadi,akhlak,id_kelas,semester,nis)
                       values('$alfa','$izin','$sakit','$pribadi','$akhlak','$kelas','$semester','$nis')";
           
           
           
                $query1 = mysqli_query($link, $sql1);
      
      if ($query) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Raport Berhasil Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    } else {
        $alert = "<div class=\"alert alert-danger alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Gagal!</strong><br/> Data Gagal Di Simpan.
                  </div>";
        $_SESSION['alert'] = $alert;
    }

    ?>
    <script type="text/javascript">document.location="index.php?admin=raport";</script>
    <?php
}
