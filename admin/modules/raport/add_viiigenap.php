<?php
error_reporting(E_ALL ^(E_NOTICE | E_WARNING));
        if(isset($_POST['nis'])){
          $alfa=$_POST['alfa'];
          $izin=$_POST['izin'];
          $sakit=$_POST['sakit'];
          $spritual=$_POST['spritual'];
          $deskripsi=$_POST['deskripsi'];
          $desk_sosial=$_POST['desk_sosial'];
          $sosial=$_POST['sosial'];
          $pesan = $_POST['pesan'];
          $total=$_POST['total'];
          
         // $nama_ekskul=$_POST['nama_ekskul'];
           
            $tahun=$_POST['tahun'];
           for ($i = 0; $i < count($_POST['nis']); $i++){
            $nis = $_POST['nis'][$i];

            $kd_mapel = $_POST['kd_mapel'][$i];
            //$kkm = $_POST['kkm'][$i];
            $NA = $_POST['NA'][$i];
            $predikat = $_POST['predikat'][$i];
            $semester =$_POST['semester'][$i];
           
             $kelas = $_POST['kelas'][$i];
            $desk = $_POST['desk'][$i];
            $NAK=$_POST['NAK'][$i];
            $predikatk=$_POST['predikatk'][$i];
            $desk_k=$_POST['desk_k'][$i];
             $id_ekskul=$_POST['id_ekskul'][$i];
            $nilai=$_POST['nilai'][$i];
            



           
            $sql="INSERT INTO rapot (nis,kd_mapel,nilai,predikat,deskripsi,nilai_k,predikat_k,deskripsi_k,semester,id_kelas,thn_ajaran)
                       values('$nis','$kd_mapel','$NA','$predikat','$desk','$NAK','$predikatk','$desk_k','$semester','$kelas','$tahun')";
           
           
           
                $query = mysqli_query($link, $sql);
            
              
          $ekskul=mysqli_query($link,"INSERT INTO tbl_nilaiekskul values('','$id_ekskul','$nis','$kelas','$nilai','$semester')");      
         
      }
     
      $sql1="INSERT INTO presensi (alfa,izin,sakit,spritual,desk_spritual,sosial,desk_sosial,id_kelas,semester,nis,pesan_wali)
                       values('$alfa','$izin','$sakit','$sosial','$deskripsi','$sosial','$desk_sosial','$kelas','$semester','$nis','$pesan')";
           
           
           
                $query1 = mysqli_query($link, $sql1);
      $total1=mysqli_query($link,"INSERT INTO tbl_nilai(nis,id_kelas,semester,total_nilai)
                                  values('$nis','$kelas','$semester','$total')");
      
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
