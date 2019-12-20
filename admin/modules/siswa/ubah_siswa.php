<?php
//include "../../../config/config.php";
$nis=$_GET['nis'];

$sql_mapel = mysqli_query($link,"SELECT * from tbl_siswa where nis='$nis'");
$j = mysqli_fetch_array($sql_mapel);
include "konek.php";

?>

<link rel="stylesheet" href="../css/datepicker/datepicker3.css">
<style>
    .datepicker{z-index:1151;}
</style>
<script>
    $(function(){
        $("#tanggal").datepicker({
            dateFormat : "dd/mm/yy",
            
            changeMonth : true,
            changeYear : true
        });
    });
    

</script>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <!--  <h1>
            Raport Online SMPN 1 Mataram | 
            <small>Dashboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Dashboard</li>
        </ol> -->
    </section><br/>
    <section class="content">
        <!-- <h3 class="page-header"><i class="fa fa-users fa-fw fa-2x"></i> Halaman Form Data Siswa</h3> -->
        <div class="panel panel-success">
            <!-- Default panel contents -->
            <div class="panel-heading"><h4><strong><i class="fa fa-user-md  fa-fw fa-2x"></i> Form Ubah Identitas Siswa</strong></h4></div>
            <div class="row">
                <div class="col-md-12 portlets">
                    <!-- Your awesome content goes here -->
                    <div class="widget animated fadeInDown">
                        <form id="myWizard" class="form-horizontal" onSubmit="return validasi()" role="form" method="POST" action="?admin=ubah_siswa">
                            <section class="step" data-step-title="Identitas Diri Siswa">
                                <div class="notes">
                                    <div class="row">
                                        
                                        <div class="col-sm-6">
                                            
                                            <div class="form-group">
                                                <label for="input-text" class="col-sm-3 control-label">NIS</label>
                                                <div class="col-sm-8">
                                                  <input type="text" class="form-control" name="nis" id="nis" value="<?php echo $j['nis'];?>" readonly>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="input-text" class="col-sm-3 control-label">NISN</label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control" name="nisn" id="input-text" value="<?php echo $j['nisn'];?>" required>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="input-text" class="col-sm-3 control-label">Nama Lengkap</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="nama_lengkap" id="input-text" value="<?php echo $j['nama_lengkap'];?>" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                   <label class="col-sm-3 control-label">Jenis Kelamin</label>
                                   <div class="col-sm-8">
                                    <select name ="jk" id="jenjang" class="form-control">
                                        <option>Pilih Kelamin</option>
                                        <option value="L" <?php echo ($j['jk'] == "L") ? 'selected' : ''; ?>>L</option>
                                        <option value="P" <?php echo ($j['jk'] == "P") ? 'selected' : ''; ?>>P</option>
                                        
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-text" class="col-sm-3 control-label">Tempat Lahir</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="input-text" name="tmpt" value="<?php echo $j['tempat_lahir'];?>" required>
                              </div>
                          </div>
                          <div class="form-group">
                            <label for="input-text" class="col-sm-3 control-label">Tanggal Lahir</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="tanggal" name="tgl_lahir" value="<?php echo $j['tgl_lahir'];?>" required>
                          </div>
                      </div>
                      <div class="form-group">
                       <label class="col-sm-3 control-label">Agama</label>
                       <div class="col-sm-8">
                        <select name ="agama" id="jenjang" class="form-control">
                            <option>Pilih Agama</option>
                            <option value="Islam" <?php echo ($j['agama'] == "Islam") ? 'selected' : ''; ?>>Islam</option>
                            <option value="Kristen" <?php echo ($j['agama'] == "Kristen") ? 'selected' : ''; ?>>Kristen</option>
                            <option value="Hindu" <?php echo ($j['agama'] == "Hindu") ? 'selected' : ''; ?>>Hindu</option>
                            <option value="Buddha" <?php echo ($j['agama'] == "Buddha") ? 'selected' : ''; ?>>Buddha</option>
                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Alamat</label>
                    <div class="col-sm-8">
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat" required><?php echo $j['alamat']?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                
               <div class="form-group">
                   <label class="col-sm-3 control-label">Provinsi</label>
                   <div class="col-sm-8">
                    <script type="text/javascript" src="modules/siswa/custom.js"></script>
                    <select  name="provinsi" class="form-control provinsi" id="provinsi">
                        <?php
                        $prov = $db->query("SELECT * FROM tbl_provinsi");
                        echo'<option>Pilih Provinsi</option>';
                        while ($dataprov = $prov->fetch(PDO::FETCH_ASSOC)) {
                            echo'<option value="'.$dataprov['id'].'">'.$dataprov['nama'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
               <label class="col-sm-3 control-label">Pilih Kabupaten/Kota</label>
               <div class="col-sm-8">
                <select  name="kota" class="form-control kota" id="kota">
                </select>
            </div>
        </div>

        <div class="form-group">
           <label class="col-sm-3 control-label">Pilih Kecamatan</label>
           <div class="col-sm-8">
            <select name="kecamatan" class="form-control kecamatan" id="kecamatan">
            </select>
        </div>
    </div>

    <div class="form-group">
       <label class="col-sm-3 control-label">Pilih Kelurahan/Desa</label>
       <div class="col-sm-8">
        <select name="kelurahan" class="form-control kelurahan" id="kelurahan">
        </select>
    </div>
</div>
<div class="form-group">
   <label class="col-sm-3 control-label">Alat Transportasi</label>
   <div class="col-sm-8">
    <select name ="trans" id="jenjang" class="form-control">
        <option>Pilih Transportasi</option>
        <option value="Kendaraan Pribadi" <?php echo ($j['alat_transportasi'] == "Kendaraan Pribadi") ? 'selected' : ''; ?>>Kendaraan Pribadi</option>
        <option value="Kendaraan Umum" <?php echo ($j['alat_transportasi'] == "Kendaraan Umum") ? 'selected' : ''; ?>>Kendaraan Umum</option>
        <option value="Becak" <?php echo ($j['alat_transportasi'] == "Becak") ? 'selected' : ''; ?>>Becak</option>
        <option value="Sepeda" <?php echo ($j['alat_transportasi'] == "Sepeda") ? 'selected' : ''; ?>>Sepeda</option>
        <option value="Lainnya.." <?php echo ($j['alat_transportasi'] == "Lainnya..") ? 'selected' : ''; ?>>Lainnya..</option>
        
    </select>
</div>
</div>
<div class="form-group">
    <label for="input-text" class="col-sm-3 control-label">No Telpon</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="no_telpon" id="input-text" value="<?php echo $j['telpon']?>">
  </div>
</div>
<div class="form-group">
    <label for="input-text" class="col-sm-3 control-label">Email</label>
    <div class="col-sm-8">
      <input type="email" class="form-control" name="email" id="input-text" value="<?php echo $j['email']?>">
  </div>
</div>
<div class="form-group">
    <label for="input-text" class="col-sm-3 control-label">SKHUN SD</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="skhun" id="input-text" value="<?php echo $j['skhun_sd']?>">
  </div>
</div>
<div class="form-group">
   <label class="col-sm-3 control-label">KPS</label>
   <div class="col-sm-8">
    <select name ="kps" id="jenjang" class="form-control">
        <option>Pilih..</option>
        <option value="Ya" <?php echo ($j['kps'] == "Ya") ? 'selected' : ''; ?>>Ya</option>
        <option value="Tidak" <?php echo ($j['kps'] == "Tidak") ? 'selected' : ''; ?>>Tidak</option>
        
    </select>
</div>
</div>

</div>
</div>
</div>

</section>
<section class="step" data-step-title="Identitas Orang Tua/Wali">
    <div class="notes">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="input-text" class="col-sm-3 control-label">Nama Ayah</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="input-text" name="nama_ayah" value="<?php echo $j['nama_ayah']?>" required>
                  </div>
              </div>
              <div class="form-group">
                <label for="input-text" class="col-sm-3 control-label">Tahun Lahir</label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" name="thn_ayah" id="input-text" value="<?php echo $j['thn_lahir']?>" required>
              </div>
          </div>
          
          <div class="form-group">
           <label class="col-sm-3 control-label">Pekerjaan Ayah</label>
           <div class="col-sm-8">
            <select name ="kerja_ayah" id="jenjang" class="form-control" required>
                <option>Pilih Pekerjaan..</option>
                <option value="PNS" <?php echo ($j['pekerjaan_ayah'] == "PNS") ? 'selected' : ''; ?>>PNS</option>
                <option value="TNI/Polri" <?php echo ($j['pekerjaan_ayah'] == "TNI/Polri") ? 'selected' : ''; ?>>TNI/Polri</option>
                <option value="Wiraswasta" <?php echo ($j['pekerjaan_ayah'] == "Wiraswasta") ? 'selected' : ''; ?>>Wiraswasta</option>
                <option value="Petani" <?php echo ($j['pekerjaan_ayah'] == "Petani") ? 'selected' : ''; ?>>Petani</option>
                <option value="Nelayan" <?php echo ($j['pekerjaan_ayah'] == "Nelayan") ? 'selected' : ''; ?>>Nelayan</option>
                <option value="Lainnya" <?php echo ($j['pekerjaan_ayah'] == "Lainnya") ? 'selected' : ''; ?>>Lainnya..</option>
                
            </select>
        </div>
    </div>
    <div class="form-group">
       <label class="col-sm-3 control-label">Pendidikan Ayah</label>
       <div class="col-sm-8">
        <select name ="p_ayah" id="jenjang" class="form-control">
            <option>Pilih Pendidikan Ayah</option>
            <option value="SD" <?php echo ($j['pendidikan_ayah'] == "SD") ? 'selected' : ''; ?>>SD</option>
            <option value="SMP" <?php echo ($j['pendidikan_ayah'] == "SMP") ? 'selected' : ''; ?>>SMP</option>
            <option value="SMA" <?php echo ($j['pendidikan_ayah'] == "SMA") ? 'selected' : ''; ?>>SMA</option>
            <option value="Sarjana" <?php echo ($j['pendidikan_ayah'] == "Sarjana") ? 'selected' : ''; ?>>Sarjana</option>
            <option value="Lainnya" <?php echo ($j['pendidikan_ayah'] == "Lainnya") ? 'selected' : ''; ?>>Lainnya..</option>
            
        </select>
    </div>
</div>
<div class="form-group">
   <label class="col-sm-3 control-label">Penghasilan Ayah</label>
   <div class="col-sm-8">
    <select name ="hasil_ayah" id="jenjang" class="form-control">
        <option>Pilih Penghasilan Ayah</option>
        <option value="Lebih 5 Juta" <?php echo ($j['penghasilan'] == ">= 5 Juta") ? 'selected' : ''; ?>>Lebih 5 Juta</option>
        <option value="Kurang 5 Juta" <?php echo ($j['penghasilan'] == "< 5 Juta") ? 'selected' : ''; ?>>Kurang 5 Juta</option>
        <option value="Lebih 1 Juta" <?php echo ($j['penghasilan'] == ">= 1 Juta") ? 'selected' : ''; ?>>Lebih 1 Juta</option>
        <option value="Kurang 1 Juta" <?php echo ($j['penghasilan'] == "1 Juta") ? 'selected' : ''; ?>>Kurang 1 Juta</option>
        <option value="Lainnya" <?php echo ($j['penghasilan'] == "Lainnya") ? 'selected' : ''; ?>>Lainnya..</option>
        
    </select>
</div>
</div>
</div>


<div class="col-sm-6">
    
    <div class="form-group">
        <label for="input-text" class="col-sm-3 control-label">Nama Ibu</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="nama_ibu" id="input-text" value="<?php echo $j['nama_ibu']?>" required>
      </div>
  </div>
  <div class="form-group">
    <label for="input-text" class="col-sm-3 control-label">Tahun Lahir</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name="thn_ibu" id="input-text" value="<?php echo $j['thnlahir']?>">
  </div>
</div>

<div class="form-group">
   <label class="col-sm-3 control-label">Pekerjaan Ibu</label>
   <div class="col-sm-8">
    <select name ="kerja_ibu" id="jenjang" class="form-control">
        <option>Pilih Pekerjaan..</option>
        <option value="PNS" <?php echo ($j['pekerjaan_ibu'] == "PNS") ? 'selected' : ''; ?>>PNS</option>
        <option value="TNI/Polri" <?php echo ($j['pekerjaan_ibu'] == "TNI/Polri") ? 'selected' : ''; ?>>TNI/Polri</option>
        <option value="Wiraswasta" <?php echo ($j['pekerjaan_ibu'] == "Wiraswasta") ? 'selected' : ''; ?>>Wiraswasta</option>
        <option value="Petani" <?php echo ($j['pekerjaan_ibu'] == "Petani") ? 'selected' : ''; ?>>Petani</option>
        <option value="Nelayan" <?php echo ($j['pekerjaan_ibu'] == "Nelayan") ? 'selected' : ''; ?>>Nelayan</option>
        <option value="Lainnya" <?php echo ($j['pekerjaan_ibu'] == "Lainnya") ? 'selected' : ''; ?>>Lainnya..</option>
    </select>
</div>
</div>
<div class="form-group">
   <label class="col-sm-3 control-label">Pendidikan Ibu</label>
   <div class="col-sm-8">
    <select name ="p_ibu" id="jenjang" class="form-control">
        <option>Pilih Pendidikan</option>
        <option value="SD" <?php echo ($j['pendidikan_ibu'] == "SD") ? 'selected' : ''; ?>>SD</option>
        <option value="SMP" <?php echo ($j['pendidikan_ibu'] == "SMP") ? 'selected' : ''; ?>>SMP</option>
        <option value="SMA" <?php echo ($j['pendidikan_ibu'] == "SMA") ? 'selected' : ''; ?>>SMA</option>
        <option value="Sarjana" <?php echo ($j['pendidikan_ibu'] == "Sarjana") ? 'selected' : ''; ?>>Sarjana</option>
        <option value="Lainnya" <?php echo ($j['pendidikan_ibu'] == "Lainnya") ? 'selected' : ''; ?>>Lainnya..</option>
        
    </select>
</div>
</div>
<div class="form-group">
   <label class="col-sm-3 control-label">Penghasilan Ibu</label>
   <div class="col-sm-8">
    <select name ="hasil_ibu" id="jenjang" class="form-control">
        <option>Pilih Penghasilan</option>
        <option value="Lebih 5 Juta" <?php echo ($j['penghasilan_ibu'] == ">= 5 Juta") ? 'selected' : ''; ?>>Lebih 5 Juta</option>
        <option value="Kurang 5 Juta" <?php echo ($j['penghasilan_ibu'] == "< 5 Juta") ? 'selected' : ''; ?>>Kurang 5 Juta</option>
        <option value="Lebih 1 Juta" <?php echo ($j['penghasilan_ibu'] == ">= 1 Juta") ? 'selected' : ''; ?>>Lebih 1 Juta</option>
        <option value="Kurang 1 Juta" <?php echo ($j['penghasilan_ibu'] == "1 Juta") ? 'selected' : ''; ?>>Kurang 1 Juta</option>
        <option value="Lainnya" <?php echo ($j['penghasilan_ibu'] == "Lainnya") ? 'selected' : ''; ?>>Lainnya..</option>
        
        
    </select>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="step" data-step-title="Data Pendukung">
    <div class="notes">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="input-text" class="col-sm-3 control-label">Tinggi Badan (CM)</label>
                    <div class="col-sm-8">
                      <input type="number" name="tinggi" class="form-control" id="input-text" value="<?php echo $j['tinggi_badan']?>" required>
                  </div>
              </div>
              <div class="form-group">
                <label for="input-text" class="col-sm-3 control-label">Berat Badan (Kg)</label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" name="berat" id="input-text" value="<?php echo $j['berat_badan']?>" required>
              </div>
          </div>
          <div class="form-group">
            <label for="input-text" class="col-sm-3 control-label">Jumlah Saudara</label>
            <div class="col-sm-8">
              <input type="number" name="saudara" class="form-control" id="input-text" value="<?php echo $j['jml_saudara']?>" required>
          </div>
      </div>
  </div>
  <div class="col-sm-6">
    <div class="notes">
        <h4><strong>Catatan</strong> Penting</h4>
        <p style="text-align: justify">
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
        </p>
        <ol>
            <li>Duis autem vel eum iriure dolor in hendrerit in vulputate</li>
            <li>Lorem ipsum dolor sit amet</li>
            <li>Sed diam nonummy nibh euismod tincidunt</li>
            <li>Sonsectetuer adipiscing elit</li>
            <li>Tincidunt ut laoreet dolore magna aliquam erat volutpat</li>
        </ol>
        <p style="text-align: justify">
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
        </p>
    </div>
</div>
</div>
</div>
<div class="modal-footer">
    <a href="?admin=dt_siswa"><button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i> Batal</button></a>
    <button type="submit" class="btn btn-primary btn-flat" name="ubah_siswa"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
</div>
</section>

</form>
</div>
</div>
</div>
</div>

<!-- Footer Start -->

<!-- Footer End -->         

</div>

</section>
</aside>
<!-- ============================================================== -->
<!-- End content here -->
<!-- ============================================================== -->


<!-- End of page -->
<!-- the overlay modal element -->
<div class="md-overlay"></div>
<!-- End of eoverlay modal -->
<script>
    var resizefunc = [];
</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->