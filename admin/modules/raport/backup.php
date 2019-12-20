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
$nis=$_GET['nis'];

$sql_mapel = mysqli_query($link,"SELECT tbl_siswa.nis,tbl_siswa.nama_lengkap,tbl_kelas.id_kelas
from tbl_siswa,tbl_kelas, rekap_nilai where rekap_nilai.nis=tbl_siswa.nis and 
rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis='$nis' group by tbl_siswa.nis");
$j = mysqli_fetch_array($sql_mapel);
$k = mysqli_fetch_assoc($sql_mapel);


$sikap = mysqli_query($link,"SELECT * from tbl_sikap group by id asc");
//$sikap2 = mysqli_query($link,"SELECT * from tbl_sikap group by id asc");
                                           
//$kelas=$k['id_kelas'];
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

                         <li class="active"><a href="#in" data-toggle="tab" aria-expanded="false">VII Semester I</a></li>
                         <li class=""><a href="#blm" data-toggle="tab" aria-expanded="true">VII Semester II <label class="label label-info"><?php //echo $c ?></label></a></li>
                         <li class=""><a href="#viii" data-toggle="tab" aria-expanded="true">VIII Semester I</a></li>
                         <li class=""><a href="#viiib" data-toggle="tab" aria-expanded="true"> VIII Semester II<label class="label label-info"><?php //echo $c ?></label></a></li>                 
                         <li class=""><a href="#ix" data-toggle="tab" aria-expanded="true">IX Semester I</a></li>
                         <li class=""><a href="#ixb" data-toggle="tab" aria-expanded="true">IX Semester II<label class="label label-info"><?php //echo $c ?></label></a></li>
                     </ul>
                     <div class="tab-content no-padding">
                    <br/>
                    <small><p color="Red"><b><strong>*Pastikan Semua Nilai Sudah Terisi Lengkap Sebelum di Validasi ke Nilai Raport</strong></b></p></small>

                        <div class="tab-pane active" id="in" >
                            <div class="box-body table-responsive" id="data-mahasiswa">

                                <form action="?admin=add_viiigenap" method="POST">  
                            
                                <?php
                                $no = 1;
                                $sql_laporan = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                                tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,
                                rekap_nilai.nilai_akhir from
                                tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai where rekap_nilai.kd_mapel=tbl_mapel.kd_mapel
                                and rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis=tbl_siswa.nis
                                and rekap_nilai.nis='$nis' and rekap_nilai.semester='Ganjil' and tbl_kelas.kd_kelas='VII' group by rekap_nilai.kd_mapel
                                asc");
                                //$i_m = mysqli_fetch_assoc($sql_laporan);
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                //$query1 = mysqli_query($link,$sql_laporan);
                                          //$i_m = mysqli_fetch_assoc($sql_laporan);

                                if ($jml_lap > 0) {
                                    ?>
                                    
                                    
                                    <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    
                                        
                                        <tr class="">
                                               <th rowspan="2" width="5%">No</th>
                                               <th rowspan="2" width="10%">Kode Mapel</th>
                                               <th rowspan="2" width="25%">Mata Pelajaran</th>
                                               <th rowspan="2" width="5%">KKM*)</th>
                                               <th colspan="2" >Nilai Akhir</th>
                                               <th rowspan="2" width="30%">Deskripsi Nilai</th>
                                               
                                           </tr>
                                           <tr class="">
                                            <th width="5%" align="center">Angka</th>
                                            <th width="20%" align="center">Huruf</th>
                                            <!-- <th align="center">Registrasi</th> -->
                                        </tr> 

                                    </thead>
                                    <tbody>
                                        <?php
                                        //
                                        
                                        while ($data_mhs = mysqli_fetch_array($sql_laporan)) {

                                            
                                            //$kelas=$data_mhs['id_kelas'];
                                            ?>

                                           <tr>
                                                <td><?php echo $no; ?></td>
                                               <td><input class="form-control" type="hidden" id="nis" name="nis[]" value="<?php echo $data_mhs['nis']?>" >
                                               <?php echo "<input class='form-control' type='text' id='kd_mapel' name='kd_mapel[]' value='".$data_mhs['kd_mapel']."' readonly> "?></td> 
                                                <td><?php echo $data_mhs['nama_mapel']; ?></td>
                                                <td><?php echo "<input class='form-control' type='text' id='kkm' name='kkm[]' value='".$data_mhs['kkm']."' readonly> "?></td> 
                                                <td><?php echo "<input class='form-control' type='text' id='NA' name='NA[]' value='".$data_mhs['nilai_akhir']."' readonly> "?></td> 
                                                <td><input class="form-control" type="text" id="ket" 
                                                    value="<?php echo terbilang($data_mhs['nilai_akhir']);?>" name="ket[]" readonly>
                                                </td> 
                                               

                                                   
                                                <td>
                                                    <input class="form-control" type="hidden" name="semester[]" id="semester" value="<?php echo $data_mhs['semester']?>">
                                                    <input class="form-control" type="hidden"  name="kelas[]" id="kelas" value="<?php echo $data_mhs['id_kelas']?>">
                                                    <?php 
                                                    if($data_mhs['nilai_akhir'] >= $data_mhs['kkm'] ){
                                                        echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Sangat Memuaskan dan Memenuhi KKM" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] = $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Nilai Cukup dan Memenuhi KKM" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] <= $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Nilai Kurang dan dibawah KKM" readonly>';
                                                                            }
                                                    ?>
                                                    
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php
                                            $no++;

                                        }
                                        ?>
                                       
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
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Aklak dan Kepribadian</th>
                                               

                                               
                                           </tr>
                                            

                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Akhlak</td>
                                        <td width="15%"><input type="text" name="akhlak" class="form-control" required></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Kepribadian</td>
                                            <td width="15%"><input type="text" name="pribadi" class="form-control" required></td>
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
                                        <td width="15%"><input type="text" name="sakit" class="form-control" required></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Izin</td>
                                            <td width="15%"><input type="text" name="izin" class="form-control" required></td>
                                        </tr>
                                         <tr>
                                            <td>Alfa</td>
                                            <td  width="15%"><input type="text" name="alfa" class="form-control" required></td>
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
                            </table>
                            </div>
                        </div>

                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
                            </form>
                        </div>
                        </div>




                        <div class="tab-pane" id="blm">


                            <form action="?admin=add_viiigenap" method="POST">  
                            
                                <?php
                                $no = 1;
                                $sql_laporan = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                                tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,
                                rekap_nilai.nilai_akhir from
                                tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai where rekap_nilai.kd_mapel=tbl_mapel.kd_mapel
                                and rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis=tbl_siswa.nis
                                and rekap_nilai.nis='$nis' and rekap_nilai.semester='Genap' and tbl_kelas.kd_kelas='VII' group by rekap_nilai.kd_mapel
                                asc");
                                //$i_m = mysqli_fetch_assoc($sql_laporan);
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                //$query1 = mysqli_query($link,$sql_laporan);
                                          //$i_m = mysqli_fetch_assoc($sql_laporan);

                                if ($jml_lap > 0) {
                                    ?>
                                    
                                    
                                    <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    
                                        
                                        <tr class="">
                                                <th rowspan="2" width="5%">No</th>
                                               <th rowspan="2" width="10%">Kode Mapel</th>
                                               <th rowspan="2" width="25%">Mata Pelajaran</th>
                                               <th rowspan="2" width="5%">KKM*)</th>
                                               <th colspan="2" >Nilai Akhir</th>
                                               <th rowspan="2" width="30%">Deskripsi Nilai</th>
                                               
                                           </tr>
                                           <tr class="">
                                            <th width="5%" align="center">Angka</th>
                                            <th width="20%" align="center">Huruf</th>
                                            <!-- <th align="center">Registrasi</th> -->
                                        </tr> 

                                    </thead>
                                    <tbody>
                                        <?php
                                        //
                                        
                                        while ($data_mhs = mysqli_fetch_array($sql_laporan)) {

                                            
                                            //$kelas=$data_mhs['id_kelas'];
                                            ?>

                                           <tr>
                                                <td><?php echo $no; ?></td>
                                               <td><input class="form-control" type="hidden" id="nis" name="nis[]" value="<?php echo $data_mhs['nis']?>" >
                                               <?php echo "<input class='form-control' type='text' id='kd_mapel' name='kd_mapel[]' value='".$data_mhs['kd_mapel']."' readonly> "?></td> 
                                                <td><?php echo $data_mhs['nama_mapel']; ?></td>
                                                <td><?php echo $data_mhs['kkm']?></td> 
                                                <td><?php echo "<input class='form-control' type='text' id='NA' name='NA[]' value='".$data_mhs['nilai_akhir']."' readonly> "?></td> 
                                                <td><input class="form-control" type="text" id="ket" 
                                                    value="<?php echo terbilang($data_mhs['nilai_akhir']);?>" name="ket[]" readonly>
                                                </td> 

                                                   
                                                <td>
                                                    <input class="form-control" type="hidden" name="semester[]" id="semester" value="<?php echo $data_mhs['semester']?>">
                                                    <input class="form-control" type="hidden"  name="kelas[]" id="kelas" value="<?php echo $data_mhs['id_kelas']?>">
                                                    <?php 
                                                    if($data_mhs['nilai_akhir'] >= $data_mhs['kkm'] ){
                                                        echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Sangat Memuaskan dan Memenuhi KKM" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] = $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Nilai Cukup dan Memenuhi KKM" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] <= $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Nilai Kurang dan dibawah KKM" readonly>';
                                                                            }
                                                    ?>
                                                    
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php
                                            $no++;

                                        }
                                        ?>
                                       
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
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Aklak dan Kepribadian</th>
                                               

                                               
                                           </tr>
                                            

                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Akhlak</td>
                                        <td width="15%"><input type="text" name="akhlak" class="form-control" required></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Kepribadian</td>
                                            <td width="15%"><input type="text" name="pribadi" class="form-control" required></td>
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
                                        <td width="15%"><input type="text" name="sakit" class="form-control" required></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Izin</td>
                                            <td width="15%"><input type="text" name="izin" class="form-control" required></td>
                                        </tr>
                                         <tr>
                                            <td>Alfa</td>
                                            <td  width="15%"><input type="text" name="alfa" class="form-control" required></td>
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
                            </table>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
                            </form>
                            </div>
                        

                        <div class="tab-pane" id="viii">


                            <table id="example2" class="table table-bordered table-striped">
                                <form action="?admin=add_viiigenap" method="POST">  
                            
                                <?php
                                $no = 1;
                                $sql_laporan = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                                tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,
                                rekap_nilai.nilai_akhir from
                                tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai where rekap_nilai.kd_mapel=tbl_mapel.kd_mapel
                                and rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis=tbl_siswa.nis
                                and rekap_nilai.nis='$nis' and rekap_nilai.semester='Ganjil' and tbl_kelas.kd_kelas='VIII' group by rekap_nilai.kd_mapel
                                asc");
                                //$i_m = mysqli_fetch_assoc($sql_laporan);
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                //$query1 = mysqli_query($link,$sql_laporan);
                                          //$i_m = mysqli_fetch_assoc($sql_laporan);

                                if ($jml_lap > 0) {
                                    ?>
                                    
                                    
                                    <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    
                                        
                                        <tr class="">
                                                <th rowspan="2" width="5%">No</th>
                                               <th rowspan="2" width="10%">Kode Mapel</th>
                                               <th rowspan="2" width="25%">Mata Pelajaran</th>
                                               <th rowspan="2" width="5%">KKM*)</th>
                                               <th colspan="2" >Nilai Akhir</th>
                                               <th rowspan="2" width="30%">Deskripsi Nilai</th>
                                               
                                           </tr>
                                           <tr class="">
                                           <th width="5%" align="center">Angka</th>
                                            <th width="20%" align="center">Huruf</th>
                                            <!-- <th align="center">Registrasi</th> -->
                                        </tr> 

                                    </thead>
                                    <tbody>
                                        <?php
                                        //
                                        
                                        while ($data_mhs = mysqli_fetch_array($sql_laporan)) {

                                            
                                            //$kelas=$data_mhs['id_kelas'];
                                            ?>

                                           <tr>
                                                <td><?php echo $no; ?></td>
                                               <td><input class="form-control" type="hidden" id="nis" name="nis[]" value="<?php echo $data_mhs['nis']?>" >
                                               <?php echo "<input class='form-control' type='text' id='kd_mapel' name='kd_mapel[]' value='".$data_mhs['kd_mapel']."' readonly> "?></td> 
                                                <td><?php echo $data_mhs['nama_mapel']; ?></td>
                                                <td><?php echo "<input class='form-control' type='text' id='kkm' name='kkm[]' value='".$data_mhs['kkm']."' readonly> "?></td> 
                                                <td><?php echo "<input class='form-control' type='text' id='NA' name='NA[]' value='".$data_mhs['nilai_akhir']."' readonly> "?></td> 
                                                 <td><input class="form-control" type="text" id="ket" 
                                                    value="<?php echo terbilang($data_mhs['nilai_akhir']);?>" name="ket[]" readonly>
                                                </td> 

                                                <td>
                                                    <input class="form-control" type="hidden" name="semester[]" id="semester" value="<?php echo $data_mhs['semester']?>">
                                                    <input class="form-control" type="hidden"  name="kelas[]" id="kelas" value="<?php echo $data_mhs['id_kelas']?>">

                                                    <?php 
                                                    if($data_mhs['nilai_akhir'] >= $data_mhs['kkm'] ){
                                                        echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Sangat Memuaskan dan Memenuhi KKM" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] = $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Nilai Cukup dan Memenuhi KKM" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] <= $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Nilai Kurang dan dibawah KKM" readonly>';
                                                                            }
                                                    ?>
                                                        <!-- <input class="form-control" type="text" id="desk" name="desk[]" required> -->
                                                    
                                                    
                                                    
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php
                                            $no++;

                                        }
                                        ?>
                                       
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

                                            <select name="spritual" id="kps" class="form-control">
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
                                        <th colspan="3" rowspan="" width="30%"><textarea id="seri" type="text" name="pribadi" class="form-control" required readonly=""></textarea></th>
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
                                            <select name="sosial" id="kps" class="form-control">
                                             <?php
                                            while($sosial = mysqli_fetch_array($sikap)) {
                                            ?>

                                            <option value="<?php echo $sosial['p_sosial'] ?>">
                                                <?php echo $sosial['p_sosial'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                        </th>
                                        <th colspan="3" rowspan="" width="30%"><textarea type="text" name="pribadi" class="form-control" required></textarea></th>
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
                            <div class="col-sm-6">
                            
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Ekstrakurikuler</th>   
                                           </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                             <?php
                                        //include "../../config/config.php";
                                        $sq = mysqli_query($link,"SELECT * from tbl_ekskul group by id_ekskul asc");
                                            $t = mysqli_fetch_assoc($sq);
                                        ?>

                                            <input type="hidden" name="id_ekskul" class="form-control" value="<?php echo $t['id_ekskul'];?>" required>
                                            <select name="ekskul" class="form-control">
                                            <option value="">Pilih Ekskul</option>
                                            <?php
                                        while($r = mysqli_fetch_array($sq)) {
                                            ?>

                                            <option value="<?php echo $r['nama_ekskul'] ?>">
                                                <?php echo $r['nama_ekskul'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                        </td>
                                        <td width="15%"><input type="text" name="akhlak" class="form-control" required></td>
                                        
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
                            </table>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
                            </form>
                        </div>

                        <div class="tab-pane" id="viiib">
                            <table id="example2" class="table table-bordered table-striped">
                          <form action="?admin=add_viiigenap" method="POST">  
                            
                                <?php
                                $no = 1;
                                $sql_laporan = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                                tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,
                                rekap_nilai.nilai_akhir from
                                tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai where rekap_nilai.kd_mapel=tbl_mapel.kd_mapel
                                and rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis=tbl_siswa.nis
                                and rekap_nilai.nis='$nis' and rekap_nilai.semester='Genap' and tbl_kelas.kd_kelas='VIII' group by rekap_nilai.kd_mapel
                                asc");
                                //$i_m = mysqli_fetch_assoc($sql_laporan);
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                //$query1 = mysqli_query($link,$sql_laporan);
                                          //$i_m = mysqli_fetch_assoc($sql_laporan);

                                if ($jml_lap > 0) {
                                    ?>
                                    
                                    
                                    <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    
                                        
                                        <tr class="">
                                                <th rowspan="2" width="5%">No</th>
                                               <th rowspan="2" width="10%">Kode Mapel</th>
                                               <th rowspan="2" width="25%">Mata Pelajaran</th>
                                               <th rowspan="2" width="5%">KKM*)</th>
                                               <th colspan="2" >Nilai Akhir</th>
                                               <th rowspan="2" width="30%">Deskripsi Nilai</th>
                                               
                                           </tr>
                                           <tr class="">
                                            <th width="5%" align="center">Angka</th>
                                            <th width="20%" align="center">Huruf</th>
                                            <!-- <th align="center">Registrasi</th> -->
                                        </tr> 

                                    </thead>
                                    <tbody>
                                        <?php
                                        //
                                        
                                        while ($data_mhs = mysqli_fetch_array($sql_laporan)) {

                                            
                                            //$kelas=$data_mhs['id_kelas'];
                                            ?>

                                           <tr>
                                                <td><?php echo $no; ?></td>
                                               <td><input class="form-control" type="hidden" id="nis" name="nis[]" value="<?php echo $data_mhs['nis']?>" >
                                               <?php echo "<input class='form-control' type='text' id='kd_mapel' name='kd_mapel[]' value='".$data_mhs['kd_mapel']."' readonly> "?></td> 
                                                <td><?php echo $data_mhs['nama_mapel']; ?></td>
                                                <td><?php echo "<input class='form-control' type='text' id='kkm' name='kkm[]' value='".$data_mhs['kkm']."' readonly> "?></td> 
                                                <td><?php echo "<input class='form-control' type='text' id='NA' name='NA[]' value='".$data_mhs['nilai_akhir']."' readonly> "?></td> 
                                               <td><input class="form-control" type="text" id="ket" 
                                                    value="<?php echo terbilang($data_mhs['nilai_akhir']);?>" name="ket[]" readonly>
                                                </td>

                                                    
                                                <td>
                                                    <input class="form-control" type="hidden" name="semester[]" id="semester" value="<?php echo $data_mhs['semester']?>">
                                                    <input class="form-control" type="hidden"  name="kelas[]" id="kelas" value="<?php echo $data_mhs['id_kelas']?>">
                                                    <?php 
                                                    if($data_mhs['nilai_akhir'] >= $data_mhs['kkm'] ){
                                                        echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Sangat Memuaskan dan Memenuhi KKM" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] = $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Nilai Cukup dan Memenuhi KKM" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] <= $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Nilai Kurang dan dibawah KKM" readonly>';
                                                                            }
                                                    ?>
                                                    
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php
                                            $no++;

                                        }
                                        ?>
                                       
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
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Aklak dan Kepribadian</th>
                                               

                                               
                                           </tr>
                                            

                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Akhlak</td>
                                        <td width="15%"><input type="text" name="akhlak" class="form-control" required></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Kepribadian</td>
                                            <td width="15%"><input type="text" name="pribadi" class="form-control" required></td>
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
                                        <td width="15%"><input type="text" name="sakit" class="form-control" required></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Izin</td>
                                            <td width="15%"><input type="text" name="izin" class="form-control" required></td>
                                        </tr>
                                         <tr>
                                            <td>Alfa</td>
                                            <td  width="15%"><input type="text" name="alfa" class="form-control" required></td>
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
                            </table>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
                            </form>
                        </div>

                        <div class="tab-pane" id="ix">


                            <table id="example2" class="table table-bordered table-striped">
                                <form action="?admin=add_viiigenap" method="POST">  
                            
                                <?php
                                $no = 1;
                                $sql_laporan = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                                tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,
                                rekap_nilai.nilai_akhir from
                                tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai where rekap_nilai.kd_mapel=tbl_mapel.kd_mapel
                                and rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis=tbl_siswa.nis
                                and rekap_nilai.nis='$nis' and rekap_nilai.semester='Ganjil' and tbl_kelas.kd_kelas='IX' group by rekap_nilai.kd_mapel
                                asc");
                                //$i_m = mysqli_fetch_assoc($sql_laporan);
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                //$query1 = mysqli_query($link,$sql_laporan);
                                          //$i_m = mysqli_fetch_assoc($sql_laporan);

                                if ($jml_lap > 0) {
                                    ?>
                                    
                                    
                                    <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    
                                        
                                        <tr class="">
                                                <th rowspan="2" width="5%">No</th>
                                               <th rowspan="2" width="10%">Kode Mapel</th>
                                               <th rowspan="2" width="25%">Mata Pelajaran</th>
                                               <th rowspan="2" width="5%">KKM*)</th>
                                               <th colspan="2" >Nilai Akhir</th>
                                               <th rowspan="2" width="30%">Deskripsi Nilai</th>
                                               
                                           </tr>
                                           <tr class="">
                                            <th width="5%" align="center">Angka</th>
                                            <th width="20%" align="center">Huruf</th>
                                            <!-- <th align="center">Registrasi</th> -->
                                        </tr> 

                                    </thead>
                                    <tbody>
                                        <?php
                                        //
                                        
                                        while ($data_mhs = mysqli_fetch_array($sql_laporan)) {

                                            
                                            //$kelas=$data_mhs['id_kelas'];
                                            ?>

                                           <tr>
                                                <td><?php echo $no; ?></td>
                                               <td><input class="form-control" type="hidden" id="nis" name="nis[]" value="<?php echo $data_mhs['nis']?>" >
                                               <?php echo "<input class='form-control' type='text' id='kd_mapel' name='kd_mapel[]' value='".$data_mhs['kd_mapel']."' readonly> "?></td> 
                                                <td><?php echo $data_mhs['nama_mapel']; ?></td>
                                                <td><?php echo "<input class='form-control' type='text' id='kkm' name='kkm[]' value='".$data_mhs['kkm']."' readonly> "?></td> 
                                                <td><?php echo "<input class='form-control' type='text' id='NA' name='NA[]' value='".$data_mhs['nilai_akhir']."' readonly> "?></td> 
                                                <td><input class="form-control" type="text" id="ket" 
                                                    value="<?php echo terbilang($data_mhs['nilai_akhir']);?>" name="ket[]" readonly>
                                                </td> 

                                                <td>
                                                    <input class="form-control" type="hidden" name="semester[]" id="semester" value="<?php echo $data_mhs['semester']?>">
                                                    <input class="form-control" type="hidden"  name="kelas[]" id="kelas" value="<?php echo $data_mhs['id_kelas']?>">
                                                    <?php 
                                                    if($data_mhs['nilai_akhir'] >= $data_mhs['kkm'] ){
                                                        echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Sangat Memuaskan dan Memenuhi KKM" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] = $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Nilai Cukup dan Memenuhi KKM" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] <= $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Nilai Kurang dan dibawah KKM" readonly>';
                                                                            }
                                                    ?>
                                                    
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php
                                            $no++;

                                        }
                                        ?>
                                       
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
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Aklak dan Kepribadian</th>
                                               

                                               
                                           </tr>
                                            

                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Akhlak</td>
                                        <td width="15%"><input type="text" name="akhlak" class="form-control" required></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Kepribadian</td>
                                            <td width="15%"><input type="text" name="pribadi" class="form-control" required></td>
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
                                        <td width="15%"><input type="text" name="sakit" class="form-control" required></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Izin</td>
                                            <td width="15%"><input type="text" name="izin" class="form-control" required></td>
                                        </tr>
                                         <tr>
                                            <td>Alfa</td>
                                            <td  width="15%"><input type="text" name="alfa" class="form-control" required></td>
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
                            </table>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
                            </form>
                        </div>
                        <div class="tab-pane" id="ixb">


                            <table id="example2" class="table table-bordered table-striped">
                                <form action="?admin=add_viiigenap" method="POST">  
                            
                                <?php
                                $no = 1;
                                $sql_laporan = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                                tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,
                                rekap_nilai.nilai_akhir from
                                tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai where rekap_nilai.kd_mapel=tbl_mapel.kd_mapel
                                and rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis=tbl_siswa.nis
                                and rekap_nilai.nis='$nis' and rekap_nilai.semester='Genap' and tbl_kelas.kd_kelas='IX' group by rekap_nilai.kd_mapel
                                asc");
                                //$i_m = mysqli_fetch_assoc($sql_laporan);
                                $jml_lap = mysqli_num_rows($sql_laporan);
                                //$query1 = mysqli_query($link,$sql_laporan);
                                          //$i_m = mysqli_fetch_assoc($sql_laporan);

                                if ($jml_lap > 0) {
                                    ?>
                                    
                                    
                                    <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    
                                        
                                        <tr class="">
                                                <th rowspan="2" width="5%">No</th>
                                               <th rowspan="2" width="10%">Kode Mapel</th>
                                               <th rowspan="2" width="25%">Mata Pelajaran</th>
                                               <th rowspan="2" width="5%">KKM*)</th>
                                               <th colspan="2" >Nilai Akhir</th>
                                               <th rowspan="2" width="30%">Deskripsi Nilai</th>
                                               
                                           </tr>
                                           <tr class="">
                                            <th width="5%" align="center">Angka</th>
                                            <th width="20%" align="center">Huruf</th>
                                            <!-- <th align="center">Registrasi</th> -->
                                        </tr> 

                                    </thead>
                                    <tbody>
                                        <?php
                                        //
                                        
                                        while ($data_mhs = mysqli_fetch_array($sql_laporan)) {

                                            
                                            //$kelas=$data_mhs['id_kelas'];
                                            ?>

                                           <tr>
                                                <td><?php echo $no; ?></td>
                                               <td><input class="form-control" type="hidden" id="nis" name="nis[]" value="<?php echo $data_mhs['nis']?>" >
                                               <?php echo "<input class='form-control' type='text' id='kd_mapel' name='kd_mapel[]' value='".$data_mhs['kd_mapel']."' readonly> "?></td> 
                                                <td><?php echo $data_mhs['nama_mapel']; ?></td>
                                                <td><?php echo "<input class='form-control' type='text' id='kkm' name='kkm[]' value='".$data_mhs['kkm']."' readonly> "?></td> 
                                                <td><?php echo "<input class='form-control' type='text' id='NA' name='NA[]' value='".$data_mhs['nilai_akhir']."' readonly> "?></td> 
                                                <td><input class="form-control" type="text" id="ket" 
                                                    value="<?php echo terbilang($data_mhs['nilai_akhir']);?>" name="ket[]" readonly>
                                                </td>

                                                    
                                                <td>
                                                    <input class="form-control" type="hidden" name="semester[]" id="semester" value="<?php echo $data_mhs['semester']?>">
                                                    <input class="form-control" type="hidden"  name="kelas[]" id="kelas" value="<?php echo $data_mhs['id_kelas']?>">
                                                    <?php 
                                                    if($data_mhs['nilai_akhir'] >= $data_mhs['kkm'] ){
                                                        echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Sangat Memuaskan dan Memenuhi KKM" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] = $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Nilai Cukup dan Memenuhi KKM" readonly>';
                                                        }
                                                        elseif($data_mhs['nilai_akhir'] <= $data_mhs['kkm']){
                                                            echo '<input type="text" id="desk" name="desk[]" class="form-control" value="Nilai Kurang dan dibawah KKM" readonly>';
                                                                            }
                                                    ?>
                                                    
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php
                                            $no++;

                                        }
                                        ?>
                                       
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
                                <thead>
                                        
                                        <tr class="">
                                               <th colspan="2" width="5%">Aklak dan Kepribadian</th>
                                               

                                               
                                           </tr>
                                            

                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Akhlak</td>
                                        <td width="15%"><input type="text" name="akhlak" class="form-control" required></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Kepribadian</td>
                                            <td width="15%"><input type="text" name="pribadi" class="form-control" required></td>
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
                                        <td width="15%"><input type="text" name="sakit" class="form-control" required></td>
                                        
                                    </tr>
                                        <tr>
                                            <td>Izin</td>
                                            <td width="15%"><input type="text" name="izin" class="form-control" required></td>
                                        </tr>
                                         <tr>
                                            <td>Alfa</td>
                                            <td  width="15%"><input type="text" name="alfa" class="form-control" required></td>
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
                            </table>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
                            </form>
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

