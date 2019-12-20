<?php
        if(isset($_POST['simpan'])){
           // $semester =$_POST['semester'];
           // $kkm = $_POST['kkm'];
          
           for ($i = 0; $i < count($_POST['nis']); $i++){
            $nis = $_POST['nis'][$i];
            $kd_mapel = $_POST['kd_mapel'][$i];
            $nip= $_POST['nip'][$i];
            $harian =$_POST['harian'][$i];
            $mid =$_POST['mid'][$i];
            $uas =$_POST['uas'][$i];
            
            $NA = $_POST['NA'][$i];
            $kkm = $_POST['kkm'][$i];
            $semester = $_POST['semester'][$i];
            $kelas = $_POST['kelas'][$i];
            $nilai=($harian+$mid+$uas)/3;
            $hariank=$_POST['hariank'][$i];
            $midk=$_POST['midk'][$i];
            $uask=$_POST['uask'][$i];
            $nilaik=($hariank+$midk+$uask)/3;
            $sql="INSERT INTO rekap_nilai 
                  (nis,kd_mapel,nip,nilai_harian,nilai_mid,nilai_uas,nilai_akhir,nilai_hk,nilai_midk,
                  nilai_usk,NAK,kkm,semester,id_kelas)
                  values('$nis','$kd_mapel','$nip','$harian','$mid','$uas','$nilai','$hariank','$midk','$uask','$nilaik','$kkm','$semester',
                  '$kelas')";        
                $query = mysqli_query($link, $sql);         
         
      }
     
      
      if ($query) {
        $alert = "<div class=\"alert alert-success alert-dismissable\" id='pesan'>
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                    <strong>Berhasil!</strong> Data Nilai Berhasil Di Simpan.
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
    <script type="text/javascript">document.location="index.php?admin=nilai";</script>
    <?php
}
