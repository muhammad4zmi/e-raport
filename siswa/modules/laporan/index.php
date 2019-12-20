<?php
if (!isset($_SESSION['admin-siswa'])and ! isset($_SESSION['login-siswa'])) {
    header("location:../");
}
include "fungsi-enkripsi.php";
$sql_mapel = mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,tbl_kelas.kelas from tbl_siswa,tbl_kelas, rekap_nilai where rekap_nilai.nis=tbl_siswa.nis 
    and  rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis='" . $_SESSION['admin-siswa'] . "' group by tbl_siswa.nis");
// $sql_mapel2 = mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,
//     tbl_kelas.kelas from tbl_siswa,tbl_kelas, rekap_nilai where rekap_nilai.nis=tbl_siswa.nis 
//     and  rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis='" . $_SESSION['admin-siswa'] . "' group by tbl_siswa.nis");
$j = mysqli_fetch_array($sql_mapel);
//$kelas=$j['kd_kelas'];
                $dt_mhs = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,
                    tbl_kelas.kelas,tbl_kelas.kd_kelas,rapot.semester,rapot.thn_ajaran FROM tbl_siswa,tbl_kelas,rapot
                    where tbl_siswa.nis=tbl_kelas.nis and tbl_siswa.nis=rapot.nis and tbl_siswa.nis='" . $_SESSION['admin-siswa'] . "' group by tbl_siswa.nis");
                $i_m = mysqli_fetch_array($dt_mhs);
                $kelas=$i_m['kd_kelas'];
                $semester=$i_m['semester'];
                $thn_ajaran=$i_m['thn_ajaran'];
                 $ajaran = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,
                    tbl_kelas.kelas,tbl_kelas.kd_kelas,rapot.semester,rapot.thn_ajaran FROM tbl_siswa,tbl_kelas,rapot
                    where tbl_siswa.nis=tbl_kelas.nis and tbl_siswa.nis=rapot.nis and tbl_siswa.nis='" . $_SESSION['admin-siswa'] . "' group by tbl_siswa.nis");
                //$i_t = mysqli_fetch_array($ajaran);

           
?>

<h3 class="page-header"><i class="fa fa-list-ol fa-fw fa-2x"></i> Informasi Penilaian Hasil Belajar Siswa</h3>
<div class="row-fluid placeholders">
    <div class="col-md-12 text-left">
        <!--        <legend>
                    <h4>Laporan Detail Kegiatan Mahasiswa</h4>
                </legend>-->
                <?php
                $dt_mhs = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,
                    tbl_kelas.kelas,rapot.semester FROM tbl_siswa,tbl_kelas,rapot
                    where tbl_siswa.nis=tbl_kelas.nis and tbl_siswa.nis=rapot.nis and tbl_siswa.nis='" . $_SESSION['admin-siswa'] . "'");
                $i_m = mysqli_fetch_array($dt_mhs);
                ?>
                <div class="row">
                   <div class="panel panel-primary">
            <table class="table" style="font-size: smaller">
                            <tr>
                                <td>Nama Sekolah</td>
                                <td width="1%">:</td>
                                <td><strong><big>SMPN 1 Mataram</big></strong></td>
                            </tr>
                            <tr>
                                <td width="20%">Alamat</td>
                                <td width="1%">:</td>
                                <td><strong><big>Jl.Pejanggik No 3 Mataram</big></strong></td>
                            </tr>
                            




                        
                            <tr>
                                <td>Nomor Induk</td>
                                <td>:</td>
                                <td><strong><big><?php echo $i_m['nis']; ?></big></strong></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><strong><big><?php echo $i_m['nama_lengkap']; ?></big></strong></td>
                            </tr>

                            

                        </table>
                    </div>
                
                 <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Filter Nilai Hasil Belajar Siswa</div>
                    <div class="panel-body">
                    <form method="post" class="form-horizontal">
                       <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>

                  <div class="col-sm-10">
                    
                    <select  class="form-control" name="kelas" id="semester" required="">
                                        <option value="">Pilih Kelas</option>
                                        <option value="VII">VII</option>
                                        <option value="VIII">VIII</option>
                                        <option value="IX">IX</option>
                                       <!--  <?php
                                        // $tr=mysql_fetch_assoc($sql_mapel2);
                                        // $kelas=$tr['kd_kelas'];
                                        while($r1 = mysqli_fetch_array($sql_mapel2)) {
                                            //$kelas=$r1['kd_kelas'];
                                            ?>

                                            <option value="<?php echo $r1['kd_kelas'] ?>">
                                                <?php echo $r1['kelas'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>     -->
                                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label" required>Semester</label>

                  <div class="col-sm-10">
                    <select  class="form-control" name="semester" id="semester" required="">
                                        <option value="">Pilih Semester</option>
                                        <option value="Ganjil">Ganjil</option> 
                                        <option value="Genap">Genap</option>    
                                    </select>
                  </div>
              </div>
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tahun Pelajaran</label>

                  <div class="col-sm-10">
                    <?php

                    ?>
                    <select  class="form-control" name="thn_ajaran" id="semester" required="">
                                        <option value="">Pilih Tahun Pelajaran</option>
                                        <?php
                                        // $tr=mysql_fetch_assoc($sql_mapel2);
                                        // $kelas=$tr['kd_kelas'];
                                        while($th = mysqli_fetch_array($ajaran)) {
                                            //$kelas=$r1['kd_kelas'];
                                            ?>

                                            <option value="<?php echo $th['thn_ajaran'] ?>">
                                                <?php echo $th['thn_ajaran'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>    
                                    </select>
                  </div>
                </div>
                        
                        <button type="submit" class="btn btn-primary btn-flat pull-right" name="proses" id="tombol_show"><i class="fa fa-file-text fa-fw fa-lg"></i> Lihat Raport</button><br/>
                  </form>
                  <script type="text/javascript">
                    $(document).ready(function () {
                    $("#cetak").hide();
                   });
                    </script>

            </div>
        </div>
        <?php
                      if (isset($_POST['proses'])) {
                    ?>
                     <script type="text/javascript">
                    $(document).ready(function () {
                        $("#cetak").show();
                       });

                    </script>
                        

                          
                            
                                <?php
                                
                                //$kelas=$_POST['kelas'];
                                $semester=$_POST['semester'];
                                $kelas=$_POST['kelas'];
                                $thn_ajaran=$_POST['thn_ajaran'];
                              //  $nis=$_POST['nis'];
                                $sql_laporan = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_mapel.nama_mapel,tbl_mapel.kkm,rapot.nilai,rapot.predikat,rapot.deskripsi,rapot.semester,rapot.thn_ajaran,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas 
                                    where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=
                                    rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas 
                                    and tbl_siswa.nis='" . $_SESSION['admin-siswa'] . "' and rapot.semester='$semester'
                                    and rapot.thn_ajaran='$thn_ajaran' and
                                    tbl_kelas.kd_kelas='$kelas' 
                                    group by tbl_mapel.kd_mapel"); 
                                $sql_laporan1 = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_mapel.nama_mapel,tbl_mapel.kkm,rapot.nilai_k,rapot.predikat_k,rapot.deskripsi_k,rapot.semester,rapot.thn_ajaran,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas 
                                    where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=
                                    rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas 
                                    and tbl_siswa.nis='" . $_SESSION['admin-siswa'] . "' and rapot.semester='$semester'
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
                                        and presensi.nis='".$_SESSION['admin-siswa']."' and tbl_kelas.kd_kelas='$kelas' and
                                        presensi.semester='$semester'
                                        group by presensi.nis");
                                $eskul= mysqli_query($link,"select tbl_siswa.nis,tbl_ekskul.id_ekskul,
                                        tbl_ekskul.nama_ekskul,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,
                                        tbl_nilaiekskul.nilai,tbl_nilaiekskul.semester
                                        from tbl_siswa,tbl_ekskul,tbl_kelas,tbl_nilaiekskul
                                        where tbl_siswa.nis=tbl_nilaiekskul.nis and tbl_kelas.id_kelas=tbl_nilaiekskul.id_kelas and tbl_ekskul.id_ekskul=tbl_nilaiekskul.id_ekskul
                                        and tbl_siswa.nis='".$_SESSION['admin-siswa']."' and tbl_kelas.kd_kelas='$kelas' and tbl_nilaiekskul.semester='$semester'
                                        group by tbl_ekskul.nama_ekskul asc");
                                
                

                                //$i_m = mysqli_fetch_assoc($sql_laporan);
                                
                                //$query1 = mysqli_query($link,$sql_laporan);
                                          //$i_m = mysqli_fetch_assoc($sql_laporan);
                                }else{
                                    $sql_laporan = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_mapel.nama_mapel,tbl_mapel.kkm,rapot.nilai,rapot.predikat,
                                        rapot.deskripsi,rapot.semester,tbl_kelas.kd_kelas,tbl_kelas.kelas
                                        FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas 
                                        where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=
                                        rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas 
                                        and tbl_siswa.nis='" . $_SESSION['admin-siswa'] . "' and tbl_kelas.kd_kelas='$kelas' 
                                        group by tbl_mapel.kd_mapel");
                                    $sql_laporan1 = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_mapel.nama_mapel,tbl_mapel.kkm,rapot.nilai_k,rapot.predikat_k,
                                        rapot.deskripsi_k,rapot.semester,tbl_kelas.kd_kelas,tbl_kelas.kelas
                                        FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas 
                                        where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=
                                        rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas 
                                        and tbl_siswa.nis='" . $_SESSION['admin-siswa'] . "' and tbl_kelas.kd_kelas='$kelas' 
                                        group by tbl_mapel.kd_mapel");  
                                     // $query_total = mysqli_query($link, "SELECT rapot.nis,rapot.id_kelas,
                                     //    Sum(rapot.nilai) as tot_nilai, count(rapot.kd_mapel) as mapel
                                     //    FROM rapot WHERE rapot.id_kelas and rapot.nis ='$nis' 
                                     //    GROUP BY rapot.nis");

                                     $presensi= mysqli_query($link,"select tbl_siswa.nis,tbl_kelas.
                                        id_kelas,tbl_kelas.kd_kelas,presensi.semester,presensi.alfa,presensi.izin,presensi.sakit,presensi.spritual,presensi.desk_spritual,presensi.sosial,presensi.desk_sosial,presensi.pesan_wali from tbl_siswa,tbl_kelas,presensi where 
                                        tbl_siswa.nis=presensi.nis and 
                                        tbl_kelas.id_kelas=presensi.id_kelas 
                                        and presensi.nis='".$_SESSION['admin-siswa']."' and tbl_kelas.kd_kelas='$kelas' and
                                        presensi.semester='$semester'
                                        group by presensi.nis ");
                                     $eskul= mysqli_query($link,"select tbl_siswa.nis,tbl_ekskul.
                                        id_ekskul,tbl_ekskul.nama_ekskul,tbl_kelas.id_kelas,tbl_kelas.
                                        kd_kelas,
                                        tbl_nilaiekskul.nilai,tbl_nilaiekskul.semester
                                        from tbl_siswa,tbl_ekskul,tbl_kelas,tbl_nilaiekskul
                                        where tbl_siswa.nis=tbl_nilaiekskul.nis and tbl_kelas.id_kelas=tbl_nilaiekskul.id_kelas and tbl_ekskul.id_ekskul=tbl_nilaiekskul.id_ekskul
                                        and tbl_siswa.nis='".$_SESSION['admin-siswa']."' and tbl_kelas.kd_kelas='$kelas' 
                                        group by tbl_ekskul.nama_ekskul asc");

                                }

                                $identitas = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_mapel.nama_mapel,tbl_mapel.kkm,rapot.nilai,rapot.predikat,rapot.deskripsi,rapot.semester,rapot.thn_ajaran,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas 
                                    where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=
                                    rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas 
                                    and tbl_siswa.nis='".$_SESSION['admin-siswa']."' and rapot.semester='$semester' and 
                                    tbl_kelas.kd_kelas='$kelas' 
                                    group by tbl_mapel.kd_mapel");
                                $siswa = mysqli_fetch_array($identitas);
                                 $cek_angk2 = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,tbl_walikelas.id_wali,
                                tbl_walikelas.nip,tbl_guru.nip,tbl_guru.nama_guru,tbl_kelas.nis from tbl_kelas,tbl_walikelas,
                                tbl_guru where tbl_kelas.id_kelas=tbl_walikelas.id_kelas 
                                and tbl_walikelas.nip=tbl_guru.nip and tbl_kelas.nis='".$_SESSION['admin-siswa']."' and tbl_kelas.kd_kelas='$kelas'");
                                $a_angk2 = mysqli_fetch_array($cek_angk2);
                                $walikelas=$a_angk2['nama_guru'];
                                $nip=$a_angk2['nip'];
                                
                                    ?>
                                    
                                    
                    

                 
           

<div class="panel panel-primary" id="cetak">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Nilai Raport</div>
                    <div class="panel-body">

                            <form action=""  id="MyForm">
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
                                                <td><strong><b><?php echo  $siswa['thn_ajaran'];?></b></strong></td>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                                   
                                <?php
                                $no = 1;
                              $jml_lap = mysqli_num_rows($sql_laporan);
                                if ($jml_lap > 0) {
                                    ?>
                                    <table id="example2" class="table table-bordered table-hover">

                                        <thead>
                                            <tr>
                                                <th colspan="6" rowspan="" headers="" scope="">Nilai Pengetahuan</th>
                                            </tr>
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
                                                <td><?php echo $data_mhs['nama_mapel']; ?></td>
                                                <td><?php echo $data_mhs['kkm']; ?></td>
                                                <td><?php echo $data_mhs['nilai']; ?></td>
                                                <td><?php echo $data_mhs['predikat']; ?></td>
                                                <td><?php echo $data_mhs['deskripsi']; ?></td>


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

                            <!--nilai ketrampilan-->
                            <table id="example2" class="table table-bordered table-hover">

                                        <thead>
                                            <tr>
                                                <th colspan="6" rowspan="" headers="" scope="">Nilai Keterampilan</th>
                                            </tr>
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
                                                <td><?php echo $data_k['nama_mapel']; ?></td>
                                                <td><?php echo $data_k['kkm']; ?></td>
                                                <td><?php echo $data_k['nilai_k']; ?></td>
                                                <td><?php echo $data_k['predikat_k']; ?></td>
                                                <td><?php echo $data_k['deskripsi_k']; ?></td>


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
                                               <th colspan="4" width="5%">Nilai Sikap</th>

                                           </tr>
                                    </thead>
                                    <?php
                               
                                        while ($row1 = mysqli_fetch_array($presensi)) {
                                            //$kelas=$data_mhs['kelas'];
                                            ?>
                                    <tbody>
                                    <tr>
                                         
                                        <th colspan="4">1. Sikap Spritual</th>
                                    </tr>
                                    <tr>
                                        <th width="3%" class="text-center">Predikat</th>
                                        <th width="50%" colspan="3" class="text-center">Deskripsi</th>

                                    </tr>
                                    
                                    <tr>
                                         
                                        <th colspan="1" class="text-center">

                                          <?php echo $row1['spritual']?>
                                        </th>
                                        
                                        <td colspan="3" rowspan="" width="30%"><?php echo $row1['desk_spritual']?></td>
                                    </tr>
                                       <tr>
                                       <th colspan="4">2. Sikap Sosial</th>
                                       </tr>
                                    <tr>
                                        <th width="3%" class="text-center">Predikat</th>
                                        <th width="50%" colspan="3" class="text-center">Deskripsi</th>

                                    </tr>
                                    <tr>
                                        <th colspan="1"  class="text-center">
                                           <?php echo $row1['sosial']?>
                                        </th>
                                        <td colspan="3" rowspan="" width="30%"><?php echo $row1['desk_sosial']?></td>
                                    </tr>
                                    </tbody>
                            </table>
                            </div></div>
                            
                            <div class="row">
                            <div class="col-sm-6">
                            
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Ekstrakurikuler*<br/><span><font style="font-size: 10px" color="red">Siswa maksimal mengikuti 2 Ekstrakurikuler</font></span></th>   
                                           </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                               
                                        while ($dt_ekskul = mysqli_fetch_array($eskul)) {
                                            //$kelas=$data_mhs['kelas'];
                                            ?>
                                      <tr>
                                        <td><?php echo $dt_ekskul['nama_ekskul'];?></td>
                                        <td width="15%"><?php echo $dt_ekskul['nilai'];?></td>
                                        
                                    </tr>
                                         
                                    
                                        
                                    </tbody>
                                    <?php }
                                    ?>
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
                                        <td width="15%"><?php echo $row1['sakit'];?> Hari</td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Izin</td>
                                            <td width="15%"><?php echo $row1['izin'];?> Hari</td>
                                        </tr>
                                         <tr>
                                            <td>Alfa</td>
                                            <td  width="15%"><?php echo $row1['alfa'];?> Hari</td>
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
                                        
                                        <td width="100%"><?php echo $row1['pesan_wali']; ?></td>
                                        
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
                            </table>
                            </div>
                        </div>
                         <a  class="btn btn-primary btn-sm pull-right" href="modules/laporan/laporan_readyToPrint.php?nis=<?php echo $_SESSION['admin-siswa']; ?>&semester=<?php echo $siswa['semester']; ?>&thn_ajaran=<?php $siswa['thn_ajaran'];?>&kd_kelas=<?php echo $siswa['kd_kelas'];?>&id_kelas=<?php echo $siswa['id_kelas']?>" target="_blank"><i class="fa fa-print fa-lg fa-fw"></i> Cetak Raport</a></button>
                        
    </div>

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

