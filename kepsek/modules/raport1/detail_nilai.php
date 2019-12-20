<?php
// if (!isset($_SESSION['admin-username'])) {
//     header("location:../../login-form.php");
// }
//include "lap_kelas.php";
//include "../../config/config.php";
$nis=$_GET['nis'];

$sql_mapel = mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas
from tbl_siswa,tbl_kelas, rekap_nilai where rekap_nilai.nis=tbl_siswa.nis and 
rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis='$nis'");
$j = mysqli_fetch_array($sql_mapel);
//$id_kelas=$j['id_kelas'];
?>
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
 <h3 class="page-header"><i class="fa fa-book fa-fw fa-2x"></i> Halaman Detail Raport Siswa <strong><b><?php echo $j['nama_lengkap'];?></b></strong>
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

                         <li class="active"><a href="#in" data-toggle="tab" aria-expanded="false">VII Semester I</a></li>
                         <li class=""><a href="#blm" data-toggle="tab" aria-expanded="true">VII Semester II <label class="label label-info"><?php //echo $c ?></label></a></li>
                         <li class=""><a href="#viii" data-toggle="tab" aria-expanded="true">VIII Semester I</a></li>
                         <li class=""><a href="#viiib" data-toggle="tab" aria-expanded="true"> VIII Semester II<label class="label label-info"><?php //echo $c ?></label></a></li>                 
                         <li class=""><a href="#ix" data-toggle="tab" aria-expanded="true">IX Semester I</a></li>
                         <li class=""><a href="#ixb" data-toggle="tab" aria-expanded="true">IX Semester II<label class="label label-info"><?php //echo $c ?></label></a></li>
                     </ul>
                     <div class="tab-content no-padding">

                        <div class="tab-pane active" id="in" >
                            <div class="box-body table-responsive" id="data-mahasiswa">

                                <table id="example2" class="table table-bordered table-striped">
                                    <?php
                                    $no = 1;
                                    $sql_laporan = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_mapel.nama_mapel,rapot.kkm,rapot.nilai,rapot.ket_nilai,
                                        rapot.deskripsi,rapot.semester,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas
                                        where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas and tbl_siswa.nis='$nis'
                                        and rapot.semester='Ganjil' and tbl_kelas.kd_kelas='VII' order by rapot.nilai;");
                                    $jml_lap = mysqli_num_rows($sql_laporan);
                                    if ($jml_lap > 0) {
                                        ?>
                                        <table id="example2" class="table table-bordered table-hover">

                                            <thead>
                                               <tr class="">
                                               <th rowspan="3" width="5%">No</th>
                                               <th rowspan="3" width="20%">Mata Pelajaran</th>
                                               <th rowspan="3" width="5%">KKM*)</th>
                                               <th colspan="2" >Nilai</th>

                                               <th rowspan="3" width="30%">Deskripsi Kemajuan Belajar</th>
                                           </tr>
                                           <tr class="">
                                            <th rowspan="2" align="center">Angka</th>
                                            <th rowspan="2" align="center">Huruf</th>
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
                                                    <td><?php echo $data_mhs['ket_nilai']; ?></td>
                                                    <td><?php echo $data_mhs['deskripsi']; ?></td>


                                                </tr>
                                                <?php
                                                $no++;
                                            }
                                            ?>
                                            <tr>
                                                <?php
                                                $query_total = mysqli_query($link, "SELECT rapot.nis,tbl_kelas.id_kelas,
                                                    tbl_kelas.kelas,Sum(rapot.nilai) as tot_nilai
                                                    FROM rapot,tbl_kelas
                                                    WHERE rapot.id_kelas=tbl_kelas.id_kelas and rapot.nis ='$nis' 
                                                    and rapot.semester='Ganjil' and tbl_kelas.kelas='".$kelas."' GROUP BY rapot.nis");
                                                $total_nilai = mysqli_fetch_array($query_total);
                                                $jml_nilai_mhs = $total_nilai['tot_nilai'];
                                                ?>
                                                <td colspan="5" class="text-right" style="vertical-align: middle; letter-spacing: 3px;font-weight: 900;">Total Nilai : </td>
                                                <td><big style="font-weight: 900;font-size: x-large;"><?php echo $jml_nilai_mhs; ?></big></td>
                                                
                                            </tr>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="alert alert-dismissable alert-info">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <small><strong><i class="fa fa-warning fa-fw fa-2x"></i>Maaf !</strong> Nilai Anda Semester ini belum di masukkan.</small>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table> 
                                <div class="row">
                            <div class="col-sm-6">
                            
                            <table id="example2" class="table table-bordered table-hover">
                            <?php
                                $presensi= mysqli_query($link,"select tbl_siswa.nis,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,presensi.semester,
                                presensi.alfa,presensi.izin,presensi.sakit,presensi.akhlak,presensi.pribadi from
tbl_siswa,tbl_kelas,presensi where presensi.nis=tbl_siswa.nis and presensi.nis=tbl_kelas.nis and presensi.nis='$nis'
and tbl_kelas.kd_kelas='VII' and presensi.semester='Ganjil'");
                                        while ($row1 = mysqli_fetch_array($presensi)) {
                                            //$kelas=$data_mhs['kelas'];
                                            ?>
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Aklak dan Kepribadian</th>
                                               

                                               
                                           </tr>
                                            

                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Akhlak</td>
                                        <td width="15%"><?php echo $row1['akhlak'];?></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Kepribadian</td>
                                            <td width="15%"><?php echo $row1['pribadi'];?></td>
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
                                    <?php }
                                    ?>
                            </table>
                            </div>
                            </div>
                        </div>
                        </div>



                        <div class="tab-pane" id="blm">


                            <table id="example2" class="table table-bordered table-striped">
                                <?php
                                $no = 1;
                                $sql_laporan = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_mapel.nama_mapel,rapot.kkm,rapot.nilai,rapot.ket_nilai,
                                    rapot.deskripsi,rapot.semester,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas
                                    where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas and tbl_siswa.nis='$nis'
                                    and rapot.semester='Genap' and tbl_kelas.kd_kelas='VII' order by rapot.nilai;");
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                if ($jml_lap > 0) {
                                    ?>
                                    <table id="example2" class="table table-bordered table-hover">

                                        <thead>
                                           <tr class="">
                                               <th rowspan="3" width="5%">No</th>
                                               <th rowspan="3" width="20%">Mata Pelajaran</th>
                                               <th rowspan="3" width="5%">KKM*)</th>
                                               <th colspan="2" >Nilai</th>

                                               <th rowspan="3" width="30%">Deskripsi Kemajuan Belajar</th>
                                           </tr>
                                           <tr class="">
                                            <th rowspan="2" align="center">Angka</th>
                                            <th rowspan="2" align="center">Huruf</th>
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
                                                <td><?php echo $data_mhs['ket_nilai']; ?></td>
                                                <td><?php echo $data_mhs['deskripsi']; ?></td>


                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                        <tr>
                                            <?php
                                            $query_total = mysqli_query($link, "SELECT rapot.nis,tbl_kelas.id_kelas,
                                                tbl_kelas.kelas,Sum(rapot.nilai) as tot_nilai
                                                FROM rapot,tbl_kelas
                                                WHERE rapot.id_kelas=tbl_kelas.id_kelas and rapot.nis ='$nis' 
                                                and rapot.semester='Genap' and tbl_kelas.kelas='".$kelas."' GROUP BY rapot.nis");
                                            $total_nilai = mysqli_fetch_array($query_total);
                                            $jml_nilai_mhs = $total_nilai['tot_nilai'];
                                            ?>
                                            <td colspan="5" class="text-right" style="vertical-align: middle; letter-spacing: 3px;font-weight: 900;">Total Nilai : </td>
                                            <td><big style="font-weight: 900;font-size: x-large;"><?php echo $jml_nilai_mhs; ?></big></td>
                                           
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-dismissable alert-info">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <small><strong><i class="fa fa-warning fa-fw fa-2x"></i>Maaf !</strong> Nilai Anda Semester ini belum dimasukkan.</small>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row">
                            <div class="col-sm-6">
                            
                            <table id="example2" class="table table-bordered table-hover">
                            <?php
                                $presensi= mysqli_query($link,"select tbl_siswa.nis,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,presensi.semester,
                                presensi.alfa,presensi.izin,presensi.sakit,presensi.akhlak,presensi.pribadi from
tbl_siswa,tbl_kelas,presensi where presensi.nis=tbl_siswa.nis and presensi.nis=tbl_kelas.nis and presensi.nis='$nis'
and tbl_kelas.kd_kelas='VII' and presensi.semester='Genap'");
                                        while ($row1 = mysqli_fetch_array($presensi)) {
                                            //$kelas=$data_mhs['kelas'];
                                            ?>
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Aklak dan Kepribadian</th>
                                               

                                               
                                           </tr>
                                            

                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Akhlak</td>
                                        <td width="15%"><?php echo $row1['akhlak'];?></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Kepribadian</td>
                                            <td width="15%"><?php echo $row1['pribadi'];?></td>
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
                                    <?php }
                                    ?>
                            </table>
                            </div>
                            </div>
                        </div>
                        

                        <div class="tab-pane" id="viii">


                            <table id="example2" class="table table-bordered table-striped">
                                <?php
                                $no = 1;
                                $sql_laporan = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_mapel.nama_mapel,rapot.kkm,rapot.nilai,rapot.ket_nilai,
                                    rapot.deskripsi,rapot.semester,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas
                                    where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas and tbl_siswa.nis='$nis' 
                                    and rapot.semester='Ganjil' and tbl_kelas.kd_kelas='VIII' order by rapot.nilai;");
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                if ($jml_lap > 0) {
                                    ?>
                                    <table id="example2" class="table table-bordered table-hover">

                                        <thead>
                                           <tr class="">
                                               <th rowspan="3" width="5%">No</th>
                                               <th rowspan="3" width="20%">Mata Pelajaran</th>
                                               <th rowspan="3" width="5%">KKM*)</th>
                                               <th colspan="2" >Nilai</th>

                                               <th rowspan="3" width="30%">Deskripsi Kemajuan Belajar</th>
                                           </tr>
                                           <tr class="">
                                            <th rowspan="2" align="center">Angka</th>
                                            <th rowspan="2" align="center">Huruf</th>
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
                                                <td><?php echo $data_mhs['ket_nilai']; ?></td>
                                                <td><?php echo $data_mhs['deskripsi']; ?></td>


                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                        <tr>
                                            <?php
                                            $query_total = mysqli_query($link, "SELECT rapot.nis,tbl_kelas.id_kelas,
                                                tbl_kelas.kelas,Sum(rapot.nilai) as tot_nilai
                                                FROM rapot,tbl_kelas
                                                WHERE rapot.id_kelas=tbl_kelas.id_kelas and rapot.nis ='$nis' 
                                                and rapot.semester='Ganjil' and tbl_kelas.kelas='".$kelas."' GROUP BY rapot.nis");
                                            $total_nilai = mysqli_fetch_array($query_total);
                                            $jml_nilai_mhs = $total_nilai['tot_nilai'];
                                            ?>
                                            <td colspan="5" class="text-right" style="vertical-align: middle; letter-spacing: 3px;font-weight: 900;">Total Nilai : </td>
                                            <td><big style="font-weight: 900;font-size: x-large;"><?php echo $jml_nilai_mhs; ?></big></td>
                                            
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-dismissable alert-info">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <small><strong><i class="fa fa-warning fa-fw fa-2x"></i>Maaf !</strong> Nilai Anda Semester ini belum di masukkan.</small>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row">
                            <div class="col-sm-6">
                            
                            <table id="example2" class="table table-bordered table-hover">
                            <?php
                                $presensi= mysqli_query($link,"select tbl_siswa.nis,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,presensi.semester,
                                presensi.alfa,presensi.izin,presensi.sakit,presensi.akhlak,presensi.pribadi from
tbl_siswa,tbl_kelas,presensi where presensi.nis=tbl_siswa.nis and presensi.nis=tbl_kelas.nis and presensi.nis='$nis'
and tbl_kelas.kd_kelas='VIII' and presensi.semester='Ganjil'");
                                        while ($row1 = mysqli_fetch_array($presensi)) {
                                            //$kelas=$data_mhs['kelas'];
                                            ?>
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Aklak dan Kepribadian</th>
                                               

                                               
                                           </tr>
                                            

                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Akhlak</td>
                                        <td width="15%"><?php echo $row1['akhlak'];?></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Kepribadian</td>
                                            <td width="15%"><?php echo $row1['pribadi'];?></td>
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
                                    <?php }
                                    ?>
                            </table>
                            </div>
                            </div>
                            </div>
                        
                        

                        <div class="tab-pane" id="viiib">


                            <table id="example2" class="table table-bordered table-striped">
                                <?php
                                $no = 1;
                                $sql_laporan = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_mapel.nama_mapel,rapot.kkm,rapot.nilai,rapot.ket_nilai,
                                    rapot.deskripsi,rapot.semester,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas
                                    where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=rapot.kd_mapel and tbl_kelas.id_kelas=rapot.id_kelas and tbl_siswa.nis='$nis'
                                    and rapot.nis='$nis' and rapot.semester='Genap' and tbl_kelas.kd_kelas='VIII' order by rapot.nilai;");
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                if ($jml_lap > 0) {
                                    ?>
                                    <table id="example2" class="table table-bordered table-hover">

                                        <tr class="">
                                               <th rowspan="3" width="5%">No</th>
                                               <th rowspan="3" width="20%">Mata Pelajaran</th>
                                               <th rowspan="3" width="5%">KKM*)</th>
                                               <th colspan="2" >Nilai</th>

                                               <th rowspan="3" width="30%">Deskripsi Kemajuan Belajar</th>
                                           </tr>
                                           <tr class="">
                                            <th rowspan="2" align="center">Angka</th>
                                            <th rowspan="2" align="center">Huruf</th>
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
                                                <td><?php echo $data_mhs['ket_nilai']; ?></td>
                                                <td><?php echo $data_mhs['deskripsi']; ?></td>


                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                        <tr>
                                            <?php
                                            $query_total = mysqli_query($link, "SELECT rapot.nis,tbl_kelas.id_kelas,
                                                tbl_kelas.kelas,Sum(rapot.nilai) as tot_nilai
                                                FROM rapot,tbl_kelas
                                                WHERE rapot.id_kelas=tbl_kelas.id_kelas and rapot.nis ='$nis' 
                                                and rapot.semester='Genap' and tbl_kelas.kelas='".$kelas."' GROUP BY rapot.nis");
                                            $total_nilai = mysqli_fetch_array($query_total);
                                            $jml_nilai_mhs = $total_nilai['tot_nilai'];
                                            ?>
                                            <td colspan="5" class="text-right" style="vertical-align: middle; letter-spacing: 3px;font-weight: 900;">Total Nilai : </td>
                                            <td><big style="font-weight: 900;font-size: x-large;"><?php echo $jml_nilai_mhs; ?></big></td>
                                            
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-dismissable alert-info">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <small><strong><i class="fa fa-warning fa-fw fa-2x"></i>Maaf !</strong> Nilai Anda Semester ini belum dimasukkan.</small>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row">
                            <div class="col-sm-6">
                            
                            <table id="example2" class="table table-bordered table-hover">
                            <?php
                                $presensi= mysqli_query($link,"select tbl_siswa.nis,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,presensi.semester,
                                presensi.alfa,presensi.izin,presensi.sakit,presensi.akhlak,presensi.pribadi from
tbl_siswa,tbl_kelas,presensi where presensi.nis=tbl_siswa.nis and presensi.nis=tbl_kelas.nis and presensi.nis='$nis'
and tbl_kelas.kd_kelas='VIII' and presensi.semester='Genap'");
                                        while ($row1 = mysqli_fetch_array($presensi)) {
                                            //$kelas=$data_mhs['kelas'];
                                            ?>
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Aklak dan Kepribadian</th>
                                               

                                               
                                           </tr>
                                            

                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Akhlak</td>
                                        <td width="15%"><?php echo $row1['akhlak'];?></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Kepribadian</td>
                                            <td width="15%"><?php echo $row1['pribadi'];?></td>
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
                                    <?php }
                                    ?>
                            </table>
                            </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="ix">


                            <table id="example2" class="table table-bordered table-striped">
                                <?php
                                $no = 1;
                                $sql_laporan = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_mapel.nama_mapel,rapot.kkm,rapot.nilai,rapot.ket_nilai,
                                    rapot.deskripsi,rapot.semester,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas
                                    where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=rapot.kd_mapel and tbl_siswa.nis='$nis' 
                                    and rapot.semester='Ganjil' and tbl_kelas.kd_kelas='IX' order by rapot.nilai;");
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                if ($jml_lap > 0) {
                                    ?>
                                    <table id="example2" class="table table-bordered table-hover">

                                        <thead>
                                           <tr class="">
                                               <th rowspan="3" width="5%">No</th>
                                               <th rowspan="3" width="20%">Mata Pelajaran</th>
                                               <th rowspan="3" width="5%">KKM*)</th>
                                               <th colspan="2" >Nilai</th>

                                               <th rowspan="3" width="30%">Deskripsi Kemajuan Belajar</th>
                                           </tr>
                                           <tr class="">
                                            <th rowspan="2" align="center">Angka</th>
                                            <th rowspan="2" align="center">Huruf</th>
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
                                                <td><?php echo $data_mhs['ket_nilai']; ?></td>
                                                <td><?php echo $data_mhs['deskripsi']; ?></td>


                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                        <tr>
                                            <?php
                                            $query_total = mysqli_query($link, "SELECT rapot.nis,tbl_kelas.id_kelas,
                                                tbl_kelas.kelas,Sum(rapot.nilai) as tot_nilai
                                                FROM rapot,tbl_kelas
                                                WHERE rapot.id_kelas=tbl_kelas.id_kelas and rapot.nis ='$nis' 
                                                and rapot.semester='Ganjil' and tbl_kelas.kelas='".$kelas."' GROUP BY rapot.nis");
                                            $total_nilai = mysqli_fetch_array($query_total);
                                            $jml_nilai_mhs = $total_nilai['tot_nilai'];
                                            ?>
                                            <td colspan="5" class="text-right" style="vertical-align: middle; letter-spacing: 3px;font-weight: 900;">Total Nilai : </td>
                                            <td><big style="font-weight: 900;font-size: x-large;"><?php echo $jml_nilai_mhs; ?></big></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-dismissable alert-info">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <small><strong><i class="fa fa-warning fa-fw fa-2x"></i>Maaf !</strong> Nilai Anda Semester Ini belum dimasukkan.</small>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row">
                            <div class="col-sm-6">
                            
                            <table id="example2" class="table table-bordered table-hover">
                            <?php
                                $presensi= mysqli_query($link,"select tbl_siswa.nis,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,presensi.semester,
                                presensi.alfa,presensi.izin,presensi.sakit,presensi.akhlak,presensi.pribadi from
tbl_siswa,tbl_kelas,presensi where presensi.nis=tbl_siswa.nis and presensi.nis=tbl_kelas.nis and presensi.nis='$nis'
and tbl_kelas.kd_kelas='IX' and presensi.semester='Ganjil'");
                                        while ($row1 = mysqli_fetch_array($presensi)) {
                                            //$kelas=$data_mhs['kelas'];
                                            ?>
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Aklak dan Kepribadian</th>
                                               

                                               
                                           </tr>
                                            

                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Akhlak</td>
                                        <td width="15%"><?php echo $row1['akhlak'];?></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Kepribadian</td>
                                            <td width="15%"><?php echo $row1['pribadi'];?></td>
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
                                    <?php }
                                    ?>
                            </table>
                            </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane" id="ixb">


                            <table id="example2" class="table table-bordered table-striped">
                                <?php
                                $no = 1;
                                $sql_laporan = mysqli_query($link, "SELECT tbl_siswa.nis,tbl_mapel.nama_mapel,rapot.kkm,rapot.nilai,rapot.ket_nilai,
                                    rapot.deskripsi,rapot.semester,tbl_kelas.kd_kelas,tbl_kelas.kelas FROM tbl_siswa,tbl_mapel,rapot,tbl_kelas
                                    where tbl_siswa.nis=rapot.nis and tbl_mapel.kd_mapel=rapot.kd_mapel and tbl_siswa.nis='$nis' 
                                    and rapot.semester='Genap' and tbl_kelas.kd_kelas='IX' order by rapot.nilai;");
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                if ($jml_lap > 0) {
                                    ?>
                                    <table id="example2" class="table table-bordered table-hover">

                                        <thead>
                                           <tr class="">
                                               <th rowspan="3" width="5%">No</th>
                                               <th rowspan="3" width="20%">Mata Pelajaran</th>
                                               <th rowspan="3" width="5%">KKM*)</th>
                                               <th colspan="2" >Nilai</th>

                                               <th rowspan="3" width="30%">Deskripsi Kemajuan Belajar</th>
                                           </tr>
                                           <tr class="">
                                            <th rowspan="2" align="center">Angka</th>
                                            <th rowspan="2" align="center">Huruf</th>
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
                                                <td><?php echo $data_mhs['ket_nilai']; ?></td>
                                                <td><?php echo $data_mhs['deskripsi']; ?></td>


                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                        <tr>
                                            <?php
                                            $query_total = mysqli_query($link, "SELECT rapot.nis,tbl_kelas.id_kelas,
                                                tbl_kelas.kelas,Sum(rapot.nilai) as tot_nilai
                                                FROM rapot,tbl_kelas
                                                WHERE rapot.id_kelas=tbl_kelas.id_kelas and rapot.nis ='$nis' 
                                                and rapot.semester='Genap' and tbl_kelas.kelas='".$kelas."' GROUP BY rapot.nis");
                                            $total_nilai = mysqli_fetch_array($query_total);
                                            $jml_nilai_mhs = $total_nilai['tot_nilai'];
                                            ?>
                                            <td colspan="5" class="text-right" style="vertical-align: middle; letter-spacing: 3px;font-weight: 900;">Total Nilai : </td>
                                            <td><big style="font-weight: 900;font-size: x-large;"><?php echo $jml_nilai_mhs; ?></big></td>
                                            
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-dismissable alert-info">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <small><strong><i class="fa fa-warning fa-fw fa-2x"></i>Maaf !</strong> Nilai Anda Untuk semester Ini Belum di Masukkan</strong></i></small>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row">
                            <div class="col-sm-6">
                            
                            <table id="example2" class="table table-bordered table-hover">
                            <?php
                                $presensi= mysqli_query($link,"select tbl_siswa.nis,tbl_kelas.id_kelas,tbl_kelas.kd_kelas,presensi.semester,
                                presensi.alfa,presensi.izin,presensi.sakit,presensi.akhlak,presensi.pribadi from
tbl_siswa,tbl_kelas,presensi where presensi.nis=tbl_siswa.nis and presensi.nis=tbl_kelas.nis and presensi.nis='$nis'
and tbl_kelas.kd_kelas='IX' and presensi.semester='Genap'");
                                        while ($row1 = mysqli_fetch_array($presensi)) {
                                            //$kelas=$data_mhs['kelas'];
                                            ?>
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Aklak dan Kepribadian</th>
                                               

                                               
                                           </tr>
                                            

                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Akhlak</td>
                                        <td width="15%"><?php echo $row1['akhlak'];?></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Kepribadian</td>
                                            <td width="15%"><?php echo $row1['pribadi'];?></td>
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
                                    <?php }
                                    ?>
                            </table>
                            </div>
                            </div>
                        </div>
                        </div>





                    </div>
                </div>


            </div>
        </div>
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

