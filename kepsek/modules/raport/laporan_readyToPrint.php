<?php
// if (!isset($_SESSION['admin-username'])){
//     header("location:../../login.php");
// }
include '../../../config/config.php';
function DateToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
     // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
    $BulanIndo = array("Januari", "Februari", "Maret",
     "April", "Mei", "Juni",
     "Juli", "Agustus", "September",
     "Oktober", "November", "Desember");
    $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
    $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
    $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
    return($result);
  }
$nis=$_GET['nis'];
$semester=$_GET['semester'];
$kelas=$_GET['kd_kelas'];
$thn_ajaran=$_GET['thn_ajaran'];
$id_kelas=$_GET['id_kelas'];
$sql_mapel = mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,tbl_kelas.kelas from tbl_siswa,tbl_kelas, rekap_nilai where rekap_nilai.nis=tbl_siswa.nis 
    and  rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis='$nis' and tbl_kelas='$id_kelas' group by tbl_siswa.nis");
$sql_mapel2 = mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,
    tbl_kelas.kelas from tbl_siswa,tbl_kelas, rekap_nilai where rekap_nilai.nis=tbl_siswa.nis 
    and  rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis='$nis' and tbl_kelas.id_kelas='$id_kelas' group by tbl_siswa.nis");
//$j = mysqli_fetch_array($sql_mapel);
$sql_kepala=mysqli_query($link,"select * from tbl_user where jabatan='1'");
$kepala = mysqli_fetch_array($sql_kepala);
//$kelas=$j['kd_kelas'];
                $dt_mhs = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,
                    tbl_kelas.kelas,tbl_kelas.kd_kelas,rapot.semester,rapot.thn_ajaran FROM tbl_siswa,tbl_kelas,rapot
                    where tbl_siswa.nis=tbl_kelas.nis and tbl_siswa.nis=rapot.nis and tbl_kelas.id_kelas=rapot.id_kelas
                          and tbl_siswa.nis='$nis'
                          and tbl_kelas.id_kelas='$id_kelas' group by tbl_siswa.nis");
                $i_m = mysqli_fetch_array($dt_mhs);
                $kelas=$i_m['kd_kelas'];
                $semester1=$i_m['semester'];
                $thn_ajaran=$i_m['thn_ajaran'];
                 $ajaran = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,
                    tbl_kelas.kelas,tbl_kelas.kd_kelas,rapot.semester,rapot.thn_ajaran FROM tbl_siswa,tbl_kelas,rapot
                    where tbl_siswa.nis=tbl_kelas.nis and tbl_siswa.nis=rapot.nis and tbl_siswa.nis='$nis' and tbl_kelas.id_kelas='$id_kelas' group by tbl_siswa.nis");
                //$i_t = mysqli_fetch_array($ajaran);

            $cek_angk2 = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,tbl_walikelas.id_wali,
                tbl_walikelas.nip,tbl_guru.nip,tbl_guru.nama_guru,tbl_kelas.nis from tbl_kelas,tbl_walikelas,
                tbl_guru where tbl_kelas.id_kelas=tbl_walikelas.id_kelas 
                and tbl_walikelas.nip=tbl_guru.nip and tbl_kelas.nis='$nis' and tbl_kelas.id_kelas='$id_kelas'");
                $a_angk2 = mysqli_fetch_array($cek_angk2);
                    $walikelas=$a_angk2['nama_guru'];
                    $nip=$a_angk2['nip'];
                    $bulan=date("d-m-Y");
                    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0055)http://krs.amikom.ac.id/index.php/cetak/khs/1/2016/2017 -->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <title>Laporan Hasil Belajar </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Sebuah situs Aplikasi untuk melihat hasil belajar peserta didik di SMPN 1 Mataram." />
        <meta name="keywords" content="e-raport SMPN 1 Mataram" />
        <meta name="author" content="anonymous" />
        <!--style bootstrap-->
      <link rel="shortcut icon" href="../../style/ico/tutwuri.png">
        
        <style type="text/css">
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
        }
        
        .krs_box {
            border: 1px solid #000;
        }
        
        .krs_box * {
            text-align: center;
            padding: 0 1px;
        }
        
        .krs_box td,
        .krs_box th {
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        
        .krs_box th {
            font-size: 12px;
        }
        
        .tl {
            text-align: left;
            padding-left: 10px
        }
        
        .tc {
            text-align: center;
        }
        
        .tr {
            text-align: right;
        }
        
        .tj {
            text-align: justify;
        }
        
        .fb {
            font-weight: bold;
        }
        
        .line {
            border-bottom: 1px dashed #000;
            clear: both;
        }

    </style>
    </head>
    <body cz-shortcut-listen="true">
      
        <div class="wrapper">
            <div class="panel">
                <div class="panel-body">
                    <?php
                    $sql_laporan = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_mapel.nama_mapel,tbl_mapel.kkm,rapot.nilai,rapot.predikat,rapot.deskripsi,rapot.semester,rapot.thn_ajaran,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas 
                                    where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=
                                    rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas 
                                    and tbl_siswa.nis='$nis' and rapot.semester='$semester'
                                    and rapot.thn_ajaran='$thn_ajaran' and
                                    tbl_kelas.kd_kelas='$kelas' 
                                    group by tbl_mapel.kd_mapel"); 
                                $sql_laporan1 = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_mapel.nama_mapel,tbl_mapel.kkm,rapot.nilai_k,rapot.predikat_k,rapot.deskripsi_k,rapot.semester,rapot.thn_ajaran,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas 
                                    where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=
                                    rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas 
                                    and tbl_siswa.nis='$nis' and rapot.semester='$semester'
                                    and rapot.thn_ajaran='$thn_ajaran' and
                                    tbl_kelas.kd_kelas='$kelas' 
                                    group by tbl_mapel.kd_mapel"); 
                                // $query_total = mysqli_query($link, "SELECT rapot.nis,rapot.id_kelas,
                                //         Sum(rapot.nilai) as tot_nilai, count(rapot.kd_mapel) as mapel
                                //         FROM rapot WHERE rapot.id_kelas and rapot.semester='$semester' 
                                //         and rapot.nis ='$nis' 
                                //         GROUP BY rapot.nis");
                                $presensi= mysqli_query($link,"select tbl_siswa.nis,tbl_kelas.
                                        id_kelas,tbl_kelas.kd_kelas,presensi.semester,presensi.alfa,presensi.izin,presensi.sakit,presensi.spritual,presensi.desk_spritual,presensi.sosial,presensi.desk_sosial,presensi.pesan_wali from tbl_siswa,tbl_kelas,presensi where 
                                        tbl_siswa.nis=presensi.nis and 
                                        tbl_kelas.id_kelas=presensi.id_kelas 
                                        and presensi.nis='$nis' and tbl_kelas.kd_kelas='$kelas' and
                                        presensi.semester='$semester'
                                        group by presensi.nis");
                                $eskul= mysqli_query($link,"select tbl_siswa.nis,tbl_ekskul.id_ekskul,
                                        tbl_ekskul.nama_ekskul,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,
                                        tbl_nilaiekskul.nilai,tbl_nilaiekskul.semester
                                        from tbl_siswa,tbl_ekskul,tbl_kelas,tbl_nilaiekskul
                                        where tbl_siswa.nis=tbl_nilaiekskul.nis and tbl_kelas.id_kelas=tbl_nilaiekskul.id_kelas and tbl_ekskul.id_ekskul=tbl_nilaiekskul.id_ekskul
                                        and tbl_siswa.nis='$nis' and tbl_kelas.kd_kelas='$kelas' and tbl_nilaiekskul.semester='$semester'
                                        group by tbl_ekskul.nama_ekskul asc");
                                $identitas = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_mapel.nama_mapel,tbl_mapel.kkm,rapot.nilai,rapot.predikat,rapot.deskripsi,rapot.semester,rapot.thn_ajaran,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas 
                                    where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=
                                    rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas 
                                    and tbl_siswa.nis='$nis' and rapot.semester='$semester' and 
                                    tbl_kelas.kd_kelas='$kelas' 
                                    group by tbl_mapel.kd_mapel");
                    $siswa = mysqli_fetch_array($identitas);
                    ?>
                   <p style="font-size: 15px; font-weight: bolder; text-align: center">PENCAPAIAN KOMPETENSI PESERTA DIDIK</p>
                        <table border="0" width="800" cellspacing="0" cellpadding="0" align="center">
                                            <tr>
                                                <td width="20%">Nama Sekolah</td>
                                                <td width="1%">:</td>
                                                <td>SMPN 1 Mataram</td>
                                                <td td width="20%">Kelas</td>
                                                <td td width="1%">:</td>
                                                <td><strong><b><?php echo $siswa['kelas'] ;?></b></strong></td>
                                            </tr>
                                            <tr>
                                                <td >NIS</td>
                                                <td >:</td>
                                                <td><strong><b><?php echo $siswa['nis']; ?></b></strong></td>
                                                 <td>Semester</td>
                                                <td>:</td>
                                                <td><strong><b><?php echo $siswa['semester']; ?></b></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Siswa</td>
                                                <td>:</td>
                                                <td><strong><b><?php echo $siswa['nama_lengkap']; ?></b></strong></td>
                                                <td>Tahun Pelajaran</td>
                                                <td>:</td>
                                                <td><strong><b><?php echo  $siswa['thn_ajaran'];?></b></strong></td>

                                            </tr>
                                            
                                            
                                        </table>
                                    <br/>
                    <?php
                                $no = 1;
                              $jml_lap = mysqli_num_rows($sql_laporan);
                                if ($jml_lap > 0) {
                                    ?>
                                    <table border="0" width="800" cellspacing="0" cellpadding="0" align="center">
                                            <tr>
                                                 <td><p style="font-size: 12px; font-weight: bolder; text-align: left">A. Nilai Sikap</p>
                                                 </td>
                                            </tr>
                                        </table>

                                    <table width="800" align="center" border="0" cellpadding="0" cellspacing="0" class="krs_box">
                                <thead>
                                        
                                        
                                    </thead>
                                    <?php
                               
                                        while ($row1 = mysqli_fetch_array($presensi)) {
                                            //$kelas=$data_mhs['kelas'];
                                            ?>
                                    <tbody>
                                    <tr>
                                         
                                        <th colspan="4" class="tl">1. Sikap Spritual</th>
                                    </tr>
                                    <tr>
                                        <th width="3%" class="text-center">Predikat</th>
                                        <th width="50%" colspan="3" class="text-center">Deskripsi</th>

                                    </tr>
                                    
                                    <tr>
                                         
                                        <th colspan="1" class="text-center">

                                          <?php echo $row1['spritual']?>
                                        </th>
                                        
                                        <td colspan="3" class="tl" rowspan="" width="30%"><?php echo $row1['desk_spritual']?></td>
                                    </tr>
                                       <tr>
                                       <th colspan="4" class="tl">2. Sikap Sosial</th>
                                       </tr>
                                    <tr>
                                        <th width="3%" class="text-center">Predikat</th>
                                        <th width="50%" colspan="3" class="text-center">Deskripsi</th>

                                    </tr>
                                    <tr>
                                        <th colspan="1"  class="text-center">
                                           <?php echo $row1['sosial']?>
                                        </th>
                                        <td class="tl" colspan="3" rowspan="" width="30%"><?php echo $row1['desk_sosial']?></td>
                                    </tr>
                                    </tbody>
                            </table><br/>
                            <table border="0" width="800" cellspacing="0" cellpadding="0" align="center">
                                            <tr>
                                                 <td><p style="font-size: 12px; font-weight: bolder; text-align: left">B. Nilai Pengetahuan dan Keterampilan</p>
                                                 </td>
                                            </tr>
                                        </table>
                                    <table width="800" align="center" border="0" cellpadding="0" cellspacing="0" class="krs_box">

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
                                        while ($data_mhs = mysqli_fetch_array($sql_laporan)) {
                                            $kelas=$data_mhs['kelas'];
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td class="tl"><?php echo $data_mhs['nama_mapel']; ?></td>
                                                <td><?php echo $data_mhs['kkm']; ?></td>
                                                <td><?php echo $data_mhs['nilai']; ?></td>
                                                <td><?php echo $data_mhs['predikat']; ?></td>
                                                <td class="tl"><?php echo $data_mhs['deskripsi']; ?></td>


                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                       <!--  <tr>
                                            <?php
                                           
                                            $total_nilai = mysqli_fetch_array($query_total);
                                            $jml_nilai_mhs = $total_nilai['tot_nilai'];
                                            $mapel = $total_nilai['mapel'];
                                            $rerata = $jml_nilai_mhs/$mapel;
                                            $angka_format = number_format($rerata,2);
                                            ?>
                                            <td colspan="3" class="text-right" style="vertical-align: middle; letter-spacing: 3px;font-weight: 900;">Total Nilai : </td>
                                            <td  style="vertical-align: middle; letter-spacing: 3px;font-weight: 900;"><?php echo $jml_nilai_mhs; ?></td>
                                            
                                        </tr>
                                        <tr>
                                            
                                            <td colspan="3" class="text-right" style="vertical-align: middle; letter-spacing: 3px;font-weight: 900;">Nilai Rata-Rata: </td>
                                            <td  style="vertical-align: middle; letter-spacing: 3px;font-weight: 900;"><?php echo $angka_format; ?></td>
                                        </tr> -->

                                       
                                </tbody>
                            </table>
                            <br/><br/>
                            <!--nilai ketrampilan-->
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0" class="krs_box">

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
                                        $no1 = 1;
                                      $jml_lap1 = mysqli_num_rows($sql_laporan1);
                                        if ($jml_lap1 > 0) {
                                            ?>
                                            <?php
                                        while ($data_k = mysqli_fetch_array($sql_laporan1)) {
                                            $kelas1=$data_k['kelas'];
                                            ?>
                                            <tr>
                                                <td><?php echo $no1; ?></td>
                                                <td class="tl"><?php echo $data_k['nama_mapel']; ?></td>
                                                <td><?php echo $data_k['kkm']; ?></td>
                                                <td><?php echo $data_k['nilai_k']; ?></td>
                                                <td><?php echo $data_k['predikat_k']; ?></td>
                                                <td class="tl"><?php echo $data_k['deskripsi_k']; ?></td>


                                            </tr>
                                            <?php
                                            $no1++;
                                        }
                                        ?>
                                    </tbody>
                                </table>

                           
                            <br/>
                           
                            <table border="0" width="800" cellspacing="0" cellpadding="0" align="center">
                                            <tr>
                                                 <td><p style="font-size: 12px; font-weight: bolder; text-align: left">C. Ekstrakurikuler</p>
                                                 </td>
                                            </tr>
                                        </table>
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0" class="krs_box">
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%" class="tl">Kegiatan Ekstrakurikuler</th>   
                                           </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                               
                                        while ($dt_ekskul = mysqli_fetch_array($eskul)) {
                                            //$kelas=$data_mhs['kelas'];
                                            ?>
                                      <tr>
                                        <td class="tl"><?php echo $dt_ekskul['nama_ekskul'];?></td>
                                        <td width="15%" class="tl"><?php echo $dt_ekskul['nilai'];?></td>
                                        
                                    </tr>
                                         
                                    
                                        
                                    </tbody>
                                    <?php }
                                    ?>
                            </table>
                            <br/>

                             <table border="0" width="800" cellspacing="0" cellpadding="0" align="center">
                                            <tr>
                                                 <td><p style="font-size: 12px; font-weight: bolder; text-align: left">D. Ketidak hadiran</p>
                                                 </td>
                                            </tr>
                                        </table>
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0" class="krs_box">
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="3" width="5%" class="tl">Kehadiran</th>
                                               

                                               
                                           </tr>
                                           

                                    </thead>
                                    <tbody>
                                       <tr class="tl">
                                        <td class="tl">Sakit</td>
                                        <td ><?php echo $row1['sakit'];?> Hari</td>
                                        
                                    </tr>
                                        <tr>
                                            <td class="tl">Izin</td>
                                            <td ><?php echo $row1['izin'];?> Hari</td>
                                        </tr>
                                         <tr>
                                            <td class="tl">Alfa</td>
                                            <td  ><?php echo $row1['alfa'];?> Hari</td>
                                        </tr>
                                    </tbody>
                                   
                            </table>
                            <br/>
                             
                            
                              <table width="800" align="center" border="0" cellpadding="0" cellspacing="0" class="krs_box">
                                <thead>
                                        
                                        <tr class="">
                                               <th class="tl" colspan="2" width="5%">Pesan dan Catatan Wali Kelas</th>
                                           </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        
                                        <td width="100%" class="tl"><?php echo $row1['pesan_wali']; ?></td>
                                        
                                    </tr>
                                        
                                    </tbody>
                                    
                                     <?php }
                                    ?>
                                     <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-dismissable alert-info">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <small><strong><i class="fa fa-warning fa-fw fa-2x"></i>Maaf !</strong> Nilai Anda Semester ini belum di masukkan.</small>
                                        </div>
                                        <?php
                                    }
                                    ?>
                            </table><br/>
                            <table border="0" width="800" cellspacing="0" cellpadding="0" align="center">
              
              
                <tr>
                  
                  <td align="left">Mataram, <?php echo(DateToIndo(date('Y m d')));?></td>
                  
                </tr>
              
  </table><br/>
  <table border="0" width="800" cellspacing="0" cellpadding="0" align="center">
             
              <!-- <tr>
         
                    <td width="33%">Mataram, <?php echo(DateToIndo(date('Y m d')));?></td>
                 </tr> -->
                <tr>
                  
                  <td align="center" width="30%">Mengetahui,<br/>Orang Tua/Wali</td>
                  <td align="center" width="30%">Wali Kelas</td>
                <td align="center" width="30%">Kepala,<br/>SMPN 1 Mataram</td>
                
                </tr>
              
             
                <tr>
                 
                 <td align="center" width="30%"><br/><br/><br/>(______________________)</td>
                  <td align="center" width="30%"><br/><br/><br/><b>(<?php echo $walikelas;?>)</b><br/>NIP <?php echo $nip;?></td>

                  <td align="center" width="30%"><br/><br/><br/><b>(<?php echo $kepala['nama_lengkap'];?>)</b><br/>NIP <?php echo $kepala['nip'];?></td>
                  
                </tr>
                
                
                
              
            </table>

                            </div>
                        </div>

        </div>
       <div style="text-align:center;" class="tc">[<a href="javascript:void()" onclick="print()">CETAK</a>]</div>

        <!-- AdminLTE App -->
        <script src="../../assets/js/app.min.js" type="text/javascript"></script>
    </body>
</html>