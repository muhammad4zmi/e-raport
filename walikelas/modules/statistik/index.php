<?php
if (!isset($_SESSION['admin-username'])) {
    header("location:../../login-form.php");
}
include "fungsi-enkripsi.php";
$dt_kelas = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,
            tbl_kelas.kelas,tbl_kelas.kd_kelas,rapot.semester,rapot.thn_ajaran FROM 
            tbl_siswa,tbl_kelas,rapot where tbl_siswa.nis=tbl_kelas.nis and 
            tbl_siswa.nis=rapot.nis  group by tbl_kelas.kelas");
            // $i_m = mysqli_fetch_array($dt_kelas);
            // $kelas=$i_m['kd_kelas'];
$ajaran = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,
          tbl_kelas.kelas,tbl_kelas.kd_kelas,rapot.semester,rapot.thn_ajaran 
          FROM tbl_siswa,tbl_kelas,rapot where tbl_siswa.nis=tbl_kelas.nis and 
          tbl_siswa.nis=rapot.nis  group by rapot.thn_ajaran");
?>
<br/><br/>
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
 <h3 class="page-header"><i class="fa fa-bar-chart-o fa-fw fa-2x"></i>Statistik Rerata Nilai Mapel</h3>
<div class="row">
    <div class="col-md-12 text-left">
    <div class="alert alert-info">
        <h4>Info!</h4>
        <p>
            1. Silahkan Lakukan Filter data berdasarkan Parameter Kelas, Semester dan Tahun Ajaran Untuk melihat Nilai Rata-Rata per Mapel dan Grafik<br>
            2. Klik Tombol Lihat Rerata Nilai.
        </p>
    </div>
</div>
    <div class="col-md-12 text-left">
        <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Filter Nilai Hasil Belajar Siswa</div>
                    <div class="panel-body">
                    <form method="post" class="form-horizontal">

                       <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kelas</label>

                  <div class="col-sm-10">
                    <?php

                    ?>
                    <select  class="form-control" name="kelas" id="semester" required="">
                                        <option value="">Pilih Kelas</option>
                                        <?php
                                        // $tr=mysql_fetch_assoc($sql_mapel2);
                                        // $kelas=$tr['kd_kelas'];
                                        while($kelas = mysqli_fetch_array($dt_kelas)) {
                                            //$kelas=$r1['kd_kelas'];
                                            ?>

                                            <option value="<?php echo $kelas['kd_kelas'] ?>">
                                                <?php echo $kelas['kd_kelas'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>    
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
                        
                        <button type="submit" class="btn btn-primary btn-flat pull-right" name="proses" id="tombol_show"><i class="fa fa-file-text fa-fw fa-lg"></i> Lihat Rerata Nilai</button><br/>
                  </form>
                  <script type="text/javascript">
                    $(document).ready(function () {
                    $("#rerata").hide();
                   });
                    </script>

            </div>
        </div>
        <?php
                      if (isset($_POST['proses'])) {
                    ?>
                     <script type="text/javascript">
                    $(document).ready(function () {
                        $("#rerata").show();
                       });

                    </script>
                        

                          
                            
                                <?php
                                
                                //$kelas=$_POST['kelas'];
                                $semester=$_POST['semester'];
                                $kelas=$_POST['kelas'];
                                $thn_ajaran=$_POST['thn_ajaran'];
                                $sql_rerata=mysqli_query($link,"select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_mapel.id_kelas,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,
                                tbl_siswa.nis,rapot.kd_mapel,rapot.id_kelas,
                                sum(rapot.nilai)/count(tbl_siswa.nis) as rerata,
                                rapot.semester,rapot.thn_ajaran
                                from tbl_mapel,tbl_kelas,tbl_siswa,rapot
                                where tbl_mapel.kd_mapel=rapot.kd_mapel and 
                                tbl_kelas.id_kelas=tbl_mapel.id_kelas and 
                                tbl_kelas.kd_kelas='$kelas' and 
                                rapot.semester='$semester' and rapot.thn_ajaran='$thn_ajaran' 
                                group by tbl_mapel.kd_mapel");
                            }else{
                                $sql_rerata=mysqli_query($link,"select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_mapel.id_kelas,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,
                                tbl_siswa.nis,rapot.kd_mapel,rapot.id_kelas,
                                sum(rapot.nilai)/count(tbl_siswa.nis) as rerata, rapot.semester
                                from tbl_mapel,tbl_kelas,tbl_siswa,rapot
                                where tbl_mapel.kd_mapel=rapot.kd_mapel and 
                                tbl_kelas.id_kelas=tbl_mapel.id_kelas group by tbl_mapel.kd_mapel");
                                
                            }
    ?>

    
        <div class="panel panel-primary" id="rerata">
            <div class="panel-heading"><i class="fa fa-file-text-o"></i> Data Rata-Rata Nilai Siswa Per Mapel</div>
            <div class="panel-body">
                <table id="example1" class="table table-striped table-hover table-condensed" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Mapel</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            
                            <th>Rerata Nilai</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                       
                        
                        while ($rerata = mysqli_fetch_array($sql_rerata)) {
                            $rata=$rerata['rerata'];
                            $angka_format = number_format($rata,2);
                            ?>
                            <tr <?php echo ($no <= 10) ? "class='success'" : ""; ?>>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $rerata['kd_mapel']; ?></td>
                                <td><?php echo $rerata['nama_mapel']; ?></td>
                                <td><?php echo $rerata['kd_kelas']; ?></td>
                                <td><?php echo $angka_format;?></td>
                               
                                
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
               <a  class="btn btn-success btn-flat pull-right" href="?admin=chart-rerata&kd_kelas=<?php echo $kelas; ?>&semester=<?php echo $semester; ?>&thn_ajaran=<?php echo $thn_ajaran;?>"><i class="fa fa-bar-chart-o fa-lg fa-fw "></i> Lihat Grafik Nilai Rata-Rata</a></button>


              
            </div>
        </div>
 



</div>
</div>


</section>
</aside>

