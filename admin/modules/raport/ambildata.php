<?php
                      if (isset($_POST['kps'])) {
                    ?>
                        

                          
                            
                                <?php
                                //$kelas=$_POST['kelas'];
                                $semester=$_POST['semester'];
                                
                                $sql_laporan = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                                tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,
                                rekap_nilai.nilai_akhir from
                                tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai where rekap_nilai.kd_mapel=tbl_mapel.kd_mapel
                                and rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis=tbl_siswa.nis
                                and rekap_nilai.nis='$nis' and rekap_nilai.semester='$semester' and tbl_kelas.kd_kelas='$kelas' group by rekap_nilai.kd_mapel
                                asc");

                                //$i_m = mysqli_fetch_assoc($sql_laporan);
                                
                                //$query1 = mysqli_query($link,$sql_laporan);
                                          //$i_m = mysqli_fetch_assoc($sql_laporan);
                                }else{
                                    $sql_laporan = mysqli_query($link, "select tbl_mapel.kd_mapel,tbl_mapel.nama_mapel,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_kelas.kd_kelas,
                                tbl_siswa.nis,tbl_siswa.nama_lengkap,rekap_nilai.semester,rekap_nilai.kkm,
                                rekap_nilai.nilai_akhir from
                                tbl_mapel,tbl_siswa,tbl_kelas,rekap_nilai where rekap_nilai.kd_mapel=tbl_mapel.kd_mapel
                                and rekap_nilai.id_kelas=tbl_kelas.id_kelas and rekap_nilai.nis=tbl_siswa.nis
                                and rekap_nilai.nis='$nis' and tbl_kelas.kd_kelas='$kelas' group by rekap_nilai.kd_mapel
                                asc"); 
                                }
                                
                                    ?>
                                    <div class="panel panel-primary" id="box">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Isi Raport</div>
                    <div class="panel-body">

<form action="?admin=add_viiigenap" method="POST" id="MyForm">
                                    <table id="example2" class="table table-bordered table-hover" ">
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
                                        $jml_lap = mysqli_num_rows($sql_laporan);
                                        if ($jml_lap > 0) {
                                        $no = 1;
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