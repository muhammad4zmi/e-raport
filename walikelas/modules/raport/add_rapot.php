<?php

function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
        }     
        return $temp;
    }
 
    function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }           
        return $hasil;
    }
// include "modules/nilai/fungsi-enkripsi.php";
//$kd_mapel=decrypt($_GET['kd_mapel']);
$nis=$_GET['nis'];
include "lap_kelas.php";

$sql_mapel = mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas
            from tbl_siswa,tbl_kelas, rekap_nilai where rekap_nilai.nis=tbl_siswa.nis and 
            rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis='$nis' group by 
            tbl_siswa.nis");
            $j = mysqli_fetch_array($sql_mapel);
            $k = mysqli_fetch_assoc($sql_mapel);


$sikap = mysqli_query($link,"SELECT * from tbl_sikap group by id asc");
$sikap2 = mysqli_query($link,"SELECT * from tbl_sikap group by id asc");
$dt_mhs = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,
          tbl_kelas.kelas,tbl_kelas.kd_kelas,rapot.semester FROM tbl_siswa,tbl_kelas,rapot
          where tbl_siswa.nis=tbl_kelas.nis and tbl_siswa.nis=rapot.nis and tbl_siswa.nis='$nis' 
          group by tbl_siswa.nis");
          $i_m = mysqli_fetch_array($dt_mhs);
          $kelas=$i_m['kd_kelas'];
          $semester=$i_m['semester'];
$cek_angk2 = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
           tbl_walikelas.id_wali,tbl_walikelas.nip,tbl_guru.nip,tbl_guru.nama_guru,tbl_kelas.nis 
           from tbl_kelas,tbl_walikelas,tbl_guru where tbl_kelas.id_kelas=tbl_walikelas.id_kelas 
           and tbl_walikelas.nip=tbl_guru.nip and tbl_kelas.nis='$nis'");
           $a_angk2 = mysqli_fetch_array($cek_angk2);
           $walikelas=$a_angk2['nama_guru'];
           $nip=$a_angk2['nip'];
                                           
//$kelas=$k['id_kelas'];
?>

</style>
<script type="text/javascript">

    
$(document).ready(function() {
    $('#spritual').change(function() { // Jika select box id kurir dipilih
        var spritual = $(this).val(); // Ciptakan variabel kurir
        //var kota = $('#kota').val(); // Ciptakan variabel kota
        $.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
            url: 'modules/raport/spritual.php', // File pemroses data
            data: 'spritual=' + spritual, // Data yang akan dikirim ke file pemroses yaitu ada 2 data
            success: function(response) { // Jika berhasil
                $('#deskripsi').val(response); // Berikan hasilnya ke id biaya
            }
        });
    });

    
    });

</script>
<script >
    $(document).ready(function() {
    $('#sosial').change(function() { // Jika select box id kurir dipilih
        var sosial = $(this).val(); // Ciptakan variabel kurir
        //var kota = $('#kota').val(); // Ciptakan variabel kota
        $.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
            url: 'modules/raport/sosial.php', // File pemroses data
            data: 'sosial=' + sosial, // Data yang akan dikirim ke file pemroses yaitu ada 2 data
            success: function(response) { // Jika berhasil
                $('#desk_sosial').val(response); // Berikan hasilnya ke id biaya
            }
        });
    });
    });
</script>
   
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Raport Online SMPN 1 Mataram | 
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
 <h3 class="page-header"><i class="fa fa-book fa-fw fa-2x"></i> Halaman Tambah Nilai Raport Siswa <b><strong><?php echo $j['nama_lengkap'] ?></strong></b>
           </h3>
<div class="row-fluid placeholders">
    <div class="col-md-12 text-left">
    
                        <?php
                        if (isset($_SESSION['alert'])) {
                            echo $_SESSION['alert'];
                        } unset($_SESSION['alert']);
                        ?>
                        <?php
                            ?>
                        
       <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Nilai Hasil Belajar</div>
                    <div class="panel-body">
                    <div class="tabs-x tabs-above tab-align-left tab-bordered">
                     <ul id="w1" class="nav nav-tabs" role="tablist">

                        <?php
                $cek_angk = mysqli_query($link, "select kelas from tbl_kelas where nis='$nis' group by kelas");
                while ($a_angk = mysqli_fetch_assoc($cek_angk)) {
                    ?>
                    <li class=""><a href="#<?php echo $a_angk['kelas']; ?>" data-toggle="tab"><?php echo $a_angk['kelas']; ?></a></li>
                    <?php
                }
                ?>
                     </ul>
                     
                     <div id="myTabContent" class="tab-content no-padding" class="active">
                <?php
                $cek_angk2 = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,
                    tbl_kelas.kd_kelas,tbl_walikelas.id_wali,tbl_walikelas.nip,tbl_guru.nip,tbl_guru.nama_guru,tbl_kelas.nis from tbl_kelas,tbl_walikelas,
                    tbl_guru where tbl_kelas.id_kelas=tbl_walikelas.id_kelas and 
                    tbl_walikelas.nip=tbl_guru.nip and tbl_kelas.nis='$nis'");
                while ($a_angk2 = mysqli_fetch_assoc($cek_angk2)) {
                    $kelas=$a_angk2['kd_kelas'];
                    ?>
                    <div class="tab-pane fade" id="<?php echo $a_angk2['kelas']; ?>"><br/>
                    <table class="table table-condensed">
                <tr>
                    <td width="10%">Wali Kelas</td>
                    <td width="1%">:</td>
                    <td><span class="badge bg-green"><strong><?php echo $a_angk2['nama_guru']; ?></span></strong></td>
                    <td width="10%">Kelas</td>
                    <td width="1%">:</td>
                    <td><span class="badge bg-green"><strong><?php echo $a_angk2['kelas']; ?></span></strong></td>
                </tr>
                </table>
                <form method="post">
                        <div class="form-group">

                            <label class="col-3 control-label" required>Semester</label>
                                <div class="col-8">
                                    <select  class="form-control" name="semester" id="semester" required="">
                                        <option value="">Pilih Semester</option>
                                        <option value="Ganjil">Ganjil</option> 
                                        <option value="Genap">Genap</option>    
                                    </select>
                                              
                                </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat btn-block" name="proses" id="tombol_show"><i class="fa fa-file-text fa-fw fa-lg"></i> Isi Data</button><br/>
                  </form>

                    <?php
                      if (isset($_POST['proses'])) {
                          $semester=$_POST['semester'];
                         $sql_laporan = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.
                          nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                          tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,
                          rekap_nilai.nilai_akhir,rekap_nilai.NAK from tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai 
                          where rekap_nilai.kd_mapel=tbl_mapel.kd_mapel and 
                          rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis=tbl_siswa.nis
                          and rekap_nilai.nis='$nis' and rekap_nilai.semester='$semester' and 
                          tbl_kelas.kd_kelas='$kelas' group by rekap_nilai.kd_mapel asc");
                          $sql_laporan1 = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.
                          nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                          tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,
                          rekap_nilai.nilai_akhir,rekap_nilai.NAK from tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai 
                          where rekap_nilai.kd_mapel=tbl_mapel.kd_mapel and 
                          rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis=tbl_siswa.nis
                          and rekap_nilai.nis='$nis' and rekap_nilai.semester='$semester' and 
                          tbl_kelas.kd_kelas='$kelas' group by rekap_nilai.kd_mapel asc");
                      }else{
                          $sql_laporan = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.
                          nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                          tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,
                          rekap_nilai.nilai_akhir,rekap_nilai.NAK from tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai 
                          where rekap_nilai.kd_mapel=tbl_mapel.kd_mapel and 
                          rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis=tbl_siswa.nis
                          and rekap_nilai.nis='$nis' and tbl_kelas.kd_kelas='$kelas' group by 
                          rekap_nilai.kd_mapel asc"); 
                          $sql_laporan1 = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.
                          nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                          tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,
                          rekap_nilai.nilai_akhir,rekap_nilai.NAK from tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai 
                          where rekap_nilai.kd_mapel=tbl_mapel.kd_mapel and 
                          rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis=tbl_siswa.nis
                          and rekap_nilai.nis='$nis' and tbl_kelas.kd_kelas='$kelas' group by 
                          rekap_nilai.kd_mapel asc");
                      }
                          $identitas = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                          tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,rekap_nilai.nilai_akhir,rekap_nilai.NAK from tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai where 
                          rekap_nilai.kd_mapel=tbl_mapel.kd_mapel 
                          and rekap_nilai.id_kelas=tbl_kelas.id_kelas 
                          and rekap_nilai.nis=tbl_siswa.nis and rekap_nilai.nis='$nis' and 
                          rekap_nilai.semester='$semester' and tbl_kelas.kd_kelas='$kelas' group by 
                          rekap_nilai.kd_mapel asc");

                      //keterampilan
                          
                      
                      
                          
                        $siswa = mysqli_fetch_array($identitas);
                        ?>
                                    
                                    
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>
        </div>
    </div>

<div class="panel panel-primary" id="box">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Isi Raport</div>
                    <div class="panel-body">

<form action="?admin=add_viiigenap" method="POST" id="MyForm">
    <div class="row-fluid placeholders">
                                <div class="col-12 text-left">
                                    <div class="panel panel-primary">
                                <table class="table" style="font-size: smaller">
                                            <tr>
                                                <td width="20%">NIS</td>
                                                <td width="1%">:</td>
                                                <td><strong><b><?php echo $siswa['nis']; ?></b></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Siswa</td>
                                                <td>:</td>
                                                <td><strong><b><?php echo $siswa['nama_lengkap']; ?></b></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Kelas/Semester</td>
                                                <td>:</td>
                                                <td><strong><b><?php echo $siswa['kelas'] . "/" . $siswa['semester']; ?></b></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Wali Kelas</td>
                                                <td>:</td>
                                                <td><strong><b><?php echo  $nip. " " .$walikelas;?></b></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Tahun Pelajaran</td>
                                                <td>:</td>
                                                <td><input type="text" name="tahun" class="form-control" required placeholder="Contoh: 2018/2019"></td>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                                    <table id="example2" class="table table-bordered table-hover" ">
                                    <thead>
                                    
                                        
                                        <tr class="" align="center">
                                                <th rowspan="2" width="5%" class="text-center">No</th>
                                               <!-- <th rowspan="2" width="10%">Kode Mapel</th> -->
                                               <th rowspan="2" width="20%" class="text-center">Mata Pelajaran</th>
                                               <th colspan="4" class="text-center">Pengetahuan</th>
                                               
                                               
                                           </tr>
                                           <tr class="">
                                           <th width="5%" class="text-center">KKM</th>
                                            <th width="5%" class="text-center">Nilai</th>
                                            <th width="5%" class="text-center">Predikat</th>
                                            <th width="30%" class="text-center">Deskripsi</th>
                                            <!-- <th align="center">Registrasi</th> -->
                                        </tr> 

                                    </thead>
                                    <tbody>
                                        <?php
                                        //
                                        $jml_lap = mysqli_num_rows($sql_laporan);
                                        if ($jml_lap > 0) {
                                        $no = 1;
                                        while ($data_mhs = mysqli_fetch_array($sql_laporan)) {

                                            
                                            //$kelas=$data_mhs['id_kelas'];
                                            ?>

                                           <tr>
                                                <td><?php echo $no; ?></td>
                                               <input class="form-control" type="hidden" id="nis" name="nis[]" value="<?php echo $data_mhs['nis']?>" >
                                               <?php echo "<input class='form-control' type='hidden' id='kd_mapel' name='kd_mapel[]' value='".$data_mhs['kd_mapel']."' readonly> "?>
                                                <td><?php echo $data_mhs['nama_mapel']; ?></td>
                                                <td><?php echo "<input class='form-control' type='text' id='kkm' name='kkm[]' value='".$data_mhs['kkm']."' readonly> "?></td> 
                                                <td><?php echo "<input class='form-control' type='text' id='NA' name='NA[]' value='".$data_mhs['nilai_akhir']."' readonly> "?></td> 
                                                 <td>
                                                    <?php
                                                    if($data_mhs['nilai_akhir']>= $data_mhs['kkm']){
                                                        echo '<input type="text" id="predikat" name="predikat[]" class="form-control" value="B" readonly>';
                                                    }elseif($data_mhs['nilai_akhir']<= $data_mhs['kkm']){
                                                        echo '<input type="text" id="desk" name="predikat[]" class="form-control" value="C" readonly>';
                                                    }else{
                                                        echo '<input type="text" id="desk" name="predikat[]" class="form-control" value="A" readonly>';
                                                    }


                                                    ?>
                                                 <!-- <input class="form-control" type="text" id="ket" 
                                                    value="<?php echo terbilang($data_mhs['nilai_akhir']);?>" name="ket[]" readonly> -->
                                                </td> 

                                                <td>
                                                    <input class="form-control" type="hidden" name="semester[]" id="semester" value="<?php echo $data_mhs['semester']?>">
                                                    <input class="form-control" type="hidden"  name="kelas[]" id="kelas" value="<?php echo $data_mhs['id_kelas']?>">

                                                    <?php 
                                                    if($data_mhs['nilai_akhir'] >= $data_mhs['kkm'] ){
                                                        echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Sangat menguasai materi pada semua KD" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] <= $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Memiliki kemampuan sangat baik dalam memahami setiap KD" readonly>';
                                                        }
                                                        else{
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Tidak Mampu memahami KD dengan baik" readonly>';
                                                                            }
                                                    ?>
                                                        <!-- <input class="form-control" type="text" id="desk" name="desk[]" required> -->
                                                    
                                                    
                                                    
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php
                                            $no++;

                                        }
                                        ?>
                                       
                                       
                                </tbody>
                            </table>
                            <!-- keterampilan-->
                            <table id="example2" class="table table-bordered table-hover" ">
                                    <thead>
                                    
                                        
                                        <tr class="" align="center">
                                                <th rowspan="2" width="5%" class="text-center">No</th>
                                               <!-- <th rowspan="2" width="10%">Kode Mapel</th> -->
                                               <th rowspan="2" width="20%" class="text-center">Mata Pelajaran</th>
                                               <th colspan="4" class="text-center">Keterampilan</th>
                                               
                                               
                                           </tr>
                                           <tr class="">
                                           <th width="5%" class="text-center">KKM</th>
                                            <th width="5%" class="text-center">Nilai</th>
                                            <th width="5%" class="text-center">Predikat</th>
                                            <th width="30%" class="text-center">Deskripsi</th>
                                            <!-- <th align="center">Registrasi</th> -->
                                        </tr> 

                                    </thead>
                                    <tbody>
                                       <?php
                                        //
                                        $jml_lap1 = mysqli_num_rows($sql_laporan1);
                                        if ($jml_lap1 > 0) {
                                        $no1 = 1;
                                        while ($data_k = mysqli_fetch_array($sql_laporan1)) {

                                            
                                           
                                            ?>

                                           <tr>
                                                <td><?php echo $no1; ?></td>
                                               
                                               
                                                <td><?php echo $data_k['nama_mapel']; ?></td>
                                                <td><?php echo "<input class='form-control' type='text' id='kkm' name='kkm[]' value='".$data_k['kkm']."' readonly> "?></td> 
                                                <td><?php echo "<input class='form-control' type='text' id='NA' name='NAK[]' value='".$data_k['NAK']."' readonly> "?></td> 
                                                 <td>
                                                    <?php
                                                    if($data_k['NAK']>= $data_k['kkm']){
                                                        echo '<input type="text" id="predikat" name="predikatk[]" class="form-control" value="B" readonly>';
                                                    }elseif($data_k['NAK']<= $data_k['kkm']){
                                                        echo '<input type="text" id="desk" name="predikatk[]" class="form-control" value="C" readonly>';
                                                    }else{
                                                        echo '<input type="text" id="desk" name="predikatk[]" class="form-control" value="A" readonly>';
                                                    }


                                                    ?>
                                                 <!-- <input class="form-control" type="text" id="ket" 
                                                    value="<?php echo terbilang($data_mhs['nilai_akhir']);?>" name="ket[]" readonly> -->
                                                </td> 

                                                <td>
                                                    

                                                    <?php 
                                                    if($data_k['NAK'] >= $data_k['kkm'] ){
                                                        echo '<input type="text" id="desk" name="desk_k[]" class="form-control" value="Sangat Terampil melakukan kegiatan sesuai dengan semua KD" readonly>';
                                                        }
                                                        elseif($data_k['NAK'] <= $data_k['kkm']){
                                                            echo '<input type="text" id="desk" name="desk_k[]" class="form-control" value="Sudah Terampil melakukan kegiatan sesuai dengan setiap KD" readonly>';
                                                        }
                                                        else{
                                                            echo '<input type="text" id="desk" name="desk_k[]" class="form-control" value="Tidak memiliki keterampilan untuk semua KD" readonly>';
                                                                            }
                                                    ?>
                                                        <!-- <input class="form-control" type="text" id="desk" name="desk[]" required> -->
                                                    
                                                    
                                                    
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php
                                            $no1++;

                                        }
                                        ?>
                                    </tbody>
                                  </table>
                            <div class="row">
                            <div class="col-sm-12">
                            
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="4" width="5%">Nilai Sikap*<br/><span><font style="font-size: 10px" color="red">Nilai dengan Huruf A,B,C,D</font></span></th>

                                           </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th colspan="4">1. Sikap Spritual</th>
                                    </tr>
                                    <tr>
                                        <th width="3%">Predikat</th>
                                        <th width="50%" colspan="3">Deskripsi</th>

                                    </tr>
                                    
                                    <tr>
                                         
                                        <th colspan="1">

                                            <select name="spritual" id="spritual" class="form-control">
                                                <?php
                                            while($spritual = mysqli_fetch_array($sikap)) {
                                            ?>

                                            <option value="<?php echo $spritual['p_spritual'] ?>">
                                                <?php echo $spritual['p_spritual'] ?>
                                            </option>
                                            <?php
                                             
                                        }
                                        ?>
                                        </select>
                                        </th>
                                        
                                        <th colspan="3" rowspan="" width="30%"><textarea type="text" id="deskripsi" name="deskripsi" class="form-control" required readonly=""></textarea></th>
                                    </tr>
                                       <tr>
                                       <th colspan="4">2. Sikap Sosial</th>
                                       </tr>
                                    <tr>
                                        <th width="3%">Predikat</th>
                                        <th width="50%" colspan="3">Deskripsi</th>

                                    </tr>
                                    <tr>
                                        <th colspan="1" rowspan="" headers="" scope="">
                                            <select name="sosial" id="sosial" class="form-control">
                                             <?php
                                            while($sosial = mysqli_fetch_array($sikap2)) {
                                            ?>

                                            <option value="<?php echo $sosial['p_sosial'] ?>">
                                                <?php echo $sosial['p_sosial'] ?>
                                            </option>

                                            <?php
                                             
                                        }
                                        ?>
                                    </select>
                                        </th>
                                        <th colspan="3" rowspan="" width="30%"><textarea type="text" name="desk_sosial" id="desk_sosial" class="form-control" required readonly=""></textarea></th>
                                    </tr>
                                    </tbody>
                            </table>
                            </div></div>
                            
                            <div class="row">
                            <div class="col-sm-6">
                            
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Ekstrakurikuler*<br/><span><font style="font-size: 10px" color="red">Nilai dengan Huruf A,B,C,D, Siswa maksimal mengikuti 2 Ekstrakurikuler</font></span></th>   
                                           </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>

                                             <?php
                                        //include "../../config/config.php";
                                        $sq = mysqli_query($link,"SELECT * from tbl_ekskul");
                                          //  $t = mysqli_fetch_assoc($sq);
                                        ?>

                                             <!-- <input type="text" name="id_ekskul[]" class="form-control" value="<?php echo $t['id_ekskul']?>" required> -->
                                            <select name="id_ekskul[]" class="form-control">
                                            <option value="">Pilih Ekskul</option>
                                            <?php
                                        while($r1 = mysqli_fetch_array($sq)) {
                                            ?>

                                            <option value="<?php echo $r1['id_ekskul'] ?>">
                                                <?php echo $r1['nama_ekskul'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                        </td>
                                        <td width="15%"><input type="text" name="nilai[]" class="form-control" required></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>
                                             <?php
                                        //include "../../config/config.php";
                                        $sq1 = mysqli_query($link,"SELECT * from tbl_ekskul");
                                           // $t = mysqli_fetch_assoc($sq1);
                                        ?>

                                            
                                            <select name="id_ekskul[]" class="form-control">
                                            <option value="">Pilih Ekskul</option>
                                            <?php
                                        while($r = mysqli_fetch_array($sq1)) {
                                            ?>

                                            <option value="<?php echo $r['id_ekskul'] ?>">
                                                <?php echo $r['nama_ekskul'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                        </td>
                                        <td width="15%"><input type="text" name="nilai[]" class="form-control" required></td>
                                        
                                    </tr>
                                        
                                    </tbody>
                            </table>
                            </div>
                            <div class="col-sm-6">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="3" width="5%">Kehadiran</th>   
                                           </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                        <td>Sakit</td>
                                        <td width="15%"><input type="number" name="sakit" class="form-control" required></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Izin</td>
                                            <td width="15%"><input type="number" name="izin" class="form-control" required></td>
                                        </tr>
                                         <tr>
                                            <td>Alfa</td>
                                            <td  width="15%"><input type="number" name="alfa" class="form-control" required></td>
                                        </tr>
                                    </tbody>
                            </table>
                            </div>
                            </div> 


                            
                            
                            <div class="row">
                            <div class="col-sm-12">
                            
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Pesan dan Catatan Wali Kelas</th>
                                               

                                               
                                           </tr>
                                            

                                    </thead>
                                    <tbody>
                                    <tr>
                                        
                                        <td width="15%"><textarea name="pesan" class="form-control" rows="3" placeholder="Pesan dan Catatan Wali Kelas" required></textarea></td>
                                        
                                    </tr>
                                        
                                    </tbody>
                                     <?php
                                       }
                                    } else {
                                        ?>
                                        <div class="alert alert-dismissable alert-info">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <small><strong><i class="fa fa-warning fa-fw fa-2x"></i>Maaf !</strong> Nilai Anda Semester ini belum dimasukkan.</small>
                                        </div>
                                        <?php
                                    }
                                    ?>
                            </table>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
                            </form>

</div>
</section>
</aside>

 <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    <script>
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#myEdit").modal('show');
                $.post('modules/kelas/hasil.php',
                    {kode:$(this).attr('data-id')},

                    function(html){
                        $(".modal-body").html(html);
                    }   
                    );
            });
        });
        
    </script>

<script src="http://127.0.0.1/e-raport/admin/js/select2.js" type="text/javascript"></script>
    <script src="http://127.0.0.1/e-raport/admin/js/select2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#nis").select2({
                placeholder: 'Pilih Siswa',
                allowClear: true
            });
        });
    </script>
<script>
    $("#kode").change(function(){
        
        var id_md = $("#kode").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "modules/kelas/ambil-kelas.php",
            data: "md="+id_md,
            success: function(msg){     
                if(msg == ''){
                    alert('Tidak ada data Siswa');
                }
                else{
                    $("#SK").html(msg);
                    
                    
                }
            }
        }); 
    });  
    </script 

