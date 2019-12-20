   <?php
   if (!isset($_SESSION['admin-username']))
   	header("location:../../login.php");
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
   <!--<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>-->
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
    		<div class="panel-heading"><h4><strong><i class="fa fa-user-md  fa-fw fa-2x"></i> Form Identitas Siswa</strong></h4></div>
    		<div class="row">
    			<div class="col-md-12 portlets">
    				<!-- Your awesome content goes here -->
    				<div class="widget animated fadeInDown">
    					<form id="myWizard" class="form-horizontal" onSubmit="return validasi()" role="form" method="POST" action="?admin=add_siswa">
    						<section class="step" data-step-title="Identitas Diri Siswa">
    							<div class="notes">
    								<div class="row">

    									<div class="col-sm-6">

    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">NIS</label>
    											<div class="col-sm-8">
    												<input type="text" class="form-control" name="nis" id="nis" placeholder="NIS" required>
    											</div>
    										</div>
    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">NISN</label>
    											<div class="col-sm-8">
    												<input type="text" class="form-control" name="nisn" id="input-text" placeholder="NISN" required>
    											</div>
    										</div>
    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">Nama Lengkap</label>
    											<div class="col-sm-8">
    												<input type="text" class="form-control" name="nama_lengkap" id="input-text" placeholder="Nama Lengkap" required>
    											</div>
    										</div>
    										<div class="form-group">
    											<label class="col-sm-3 control-label">Jenis Kelamin</label>
    											<div class="col-sm-8">
    												<select name ="jk" id="jenjang" class="form-control" required>
    													<option>Pilih Kelamin</option>
    													<option value="L">L</option>
    													<option value="P">P</option>

    												</select>
    											</div>
    										</div>
    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">Tempat Lahir</label>
    											<div class="col-sm-8">
    												<input type="text" class="form-control" id="input-text" name="tmpt" placeholder="Tempat Lahir" required>
    											</div>
    										</div>
    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">Tanggal Lahir</label>
    											<div class="col-sm-8">
    												<input type="text" class="form-control" id="tanggal" name="tgl_lahir" placeholder="Tanggal Lahir" required>
    											</div>
    										</div>
    										<div class="form-group">
    											<label class="col-sm-3 control-label">Agama</label>
    											<div class="col-sm-8">
    												<select name ="agama" id="jenjang" class="form-control" required>
    													<option>Pilih Agama</option>
    													<option value="Islam">Islam</option>
    													<option value="Kristen">Kristen</option>
    													<option value="Hindu">Hindu</option>
    													<option value="Buddha">Buddha</option>

    												</select>
    											</div>
    										</div>
    										<div class="form-group">
    											<label class="col-sm-3 control-label">Alamat</label>
    											<div class="col-sm-8">
    												<textarea name="alamat" class="form-control" rows="3" placeholder="Alamat" required></textarea>
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
    											<label class="col-sm-3 control-label">Kabupaten/Kota</label>
    											<div class="col-sm-8">
    												<select  name="kota" class="form-control kota" id="kota">
    												</select>
    											</div>
    										</div>

    										<div class="form-group">
    											<label class="col-sm-3 control-label">Kecamatan</label>
    											<div class="col-sm-8">
    												<select name="kecamatan" class="form-control kecamatan" id="kecamatan">
    												</select>
    											</div>
    										</div>

    										<div class="form-group">
    											<label class="col-sm-3 control-label">Kelurahan/Desa</label>
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
    													<option value="Kendaraan Pribadi">Kendaraan Pribadi</option>
    													<option value="Kendaraan Umum">Kendaraan Umum</option>
    													<option value="Becak">Becak</option>
    													<option value="Sepeda">Sepeda</option>
    													<option value="Lainnya..">Lainnya..</option>

    												</select>
    											</div>
    										</div>
    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">No Telpon</label>
    											<div class="col-sm-8">
    												<input type="text" class="form-control" name="no_telpon" id="input-text" placeholder="No Telpon">
    											</div>
    										</div>
    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">Email</label>
    											<div class="col-sm-8">
    												<input type="email" class="form-control" name="email" id="input-text" placeholder="Email (example@mail.com)">
    											</div>
    										</div>
    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">SKHUN SD</label>
    											<div class="col-sm-8">
    												<input type="text" class="form-control" name="skhun" id="input-text" placeholder="SKHUN">
    											</div>
    										</div>
    										<div class="form-group">
    											<label class="col-sm-3 control-label">KPS</label>
    											<div class="col-sm-8">
    												<select name ="kps" id="jenjang" class="form-control">
    													<option>Pilih..</option>
    													<option value="Ya">Ya</option>
    													<option value="Tidak">Tidak</option>

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
    												<input type="text" class="form-control" id="input-text" name="nama_ayah" placeholder="Nama Ayah" required>
    											</div>
    										</div>
    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">Tahun Lahir</label>
    											<div class="col-sm-8">
    												<input type="number" class="form-control" name="thn_ayah" id="input-text" placeholder="Tahun Lahir" required>
    											</div>
    										</div>

    										<div class="form-group">
    											<label class="col-sm-3 control-label">Pekerjaan Ayah</label>
    											<div class="col-sm-8">
    												<select name ="kerja_ayah" id="jenjang" class="form-control" required>
    													<option>Pilih Pekerjaan..</option>
    													<option value="PNS">PNS</option>
    													<option value="TNI/Polri">TNI/Polri</option>
    													<option value="Wiraswasta">Wiraswasta</option>
    													<option value="Petani">Petani</option>
    													<option value="Nelayan">Nelayan</option>
    													<option value="Lainnya">Lainnya..</option>

    												</select>
    											</div>
    										</div>
    										<div class="form-group">
    											<label class="col-sm-3 control-label">Pendidikan Ayah</label>
    											<div class="col-sm-8">
    												<select name ="p_ayah" id="jenjang" class="form-control">
    													<option>Pilih Pendidikan Ayah</option>
    													<option value="SD">SD</option>
    													<option value="SMP">SMP</option>
    													<option value="SMA">SMA</option>
    													<option value="Sarjana">Sarjana</option>
    													<option value="Lainnya">Lainnya..</option>

    												</select>
    											</div>
    										</div>
    										<div class="form-group">
    											<label class="col-sm-3 control-label">Penghasilan Ayah</label>
    											<div class="col-sm-8">
    												<select name ="hasil_ayah" id="jenjang" class="form-control">
    													<option>Pilih Penghasilan Ayah</option>
    													<option value="Lebih 5 Juta">Lebih 5 Juta</option>
    													<option value="Kurang 5 Juta">Kurang 5 Juta</option>
    													<option value="Lebih 1 Juta">Lebih 1 Juta</option>
    													<option value="Kurang 1 Juta">Kurang 1 Juta</option>
    													<option value="Lainnya">Lainnya..</option>

    												</select>
    											</div>
    										</div>
    									</div>


    									<div class="col-sm-6">

    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">Nama Ibu</label>
    											<div class="col-sm-8">
    												<input type="text" class="form-control" name="nama_ibu" id="input-text" placeholder="Nama Ibu" required>
    											</div>
    										</div>
    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">Tahun Lahir</label>
    											<div class="col-sm-8">
    												<input type="number" class="form-control" name="thn_ibu" id="input-text" placeholder="Tahun Lahir">
    											</div>
    										</div>

    										<div class="form-group">
    											<label class="col-sm-3 control-label">Pekerjaan Ibu</label>
    											<div class="col-sm-8">
    												<select name ="kerja_ibu" id="jenjang" class="form-control">
    													<option>Pilih Pekerjaan..</option>
    													<option value="PNS">PNS</option>
    													<option value="TNI/Polri">TNI/Polri</option>
    													<option value="Wiraswasta">Wiraswasta</option>
    													<option value="Petani">Petani</option>
    													<option value="Nelayan">Nelayan</option>
    													<option value="IRT">IRT</option>
    													<option value="Lainnya">Lainnya..</option>

    												</select>
    											</div>
    										</div>
    										<div class="form-group">
    											<label class="col-sm-3 control-label">Pendidikan Ibu</label>
    											<div class="col-sm-8">
    												<select name ="p_ibu" id="jenjang" class="form-control">
    													<option>Pilih Pendidikan Ibu</option>
    													<option value="SD">SD</option>
    													<option value="SMP">SMP</option>
    													<option value="SMA">SMA</option>
    													<option value="Sarjana">Sarjana</option>
    													<option value="Lainnya">Lainnya..</option>

    												</select>
    											</div>
    										</div>
    										<div class="form-group">
    											<label class="col-sm-3 control-label">Penghasilan Ibu</label>
    											<div class="col-sm-8">
    												<select name ="hasil_ibu" id="jenjang" class="form-control">
    													<option>Pilih Penghasilan Ibu</option>
    													<option value="Lebih 5 Juta">Lebih 5 Juta</option>
    													<option value="Kurang 5 Juta">Kurang 5 Juta</option>
    													<option value="Lebih 1 Juta">Lebih 1 Juta</option>
    													<option value="Kurang 1 Juta">Kurang 1 Juta</option>
    													<option value="Lainnya">Lainnya..</option>

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
    												<input type="number" name="tinggi" class="form-control" id="input-text" placeholder="Tinggi Badan" required>
    											</div>
    										</div>
    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">Berat Badan (Kg)</label>
    											<div class="col-sm-8">
    												<input type="number" class="form-control" name="berat" id="input-text" placeholder="Berat Badan" required>
    											</div>
    										</div>
    										<div class="form-group">
    											<label for="input-text" class="col-sm-3 control-label">Jumlah Saudara</label>
    											<div class="col-sm-8">
    												<input type="number" name="saudara" class="form-control" id="input-text" placeholder="Jumlah Saudara" required>
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
    								<button type="submit" class="btn btn-primary btn-flat" name="tambah"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
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
