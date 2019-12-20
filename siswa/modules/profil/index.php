<?php
if (!isset($_SESSION['admin-siswa'])and ! isset($_SESSION['login-siswa'])) {
    header("location:../");

}
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
include "konek.php";
 
        $query = "SELECT * FROM tbl_siswa
        where nis='" . $_SESSION['admin-siswa'] . "'";
        $hasil = mysqli_query($link, $query);
        $siswa = mysqli_fetch_array($hasil);

?>
 <link rel="stylesheet" href="../css/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../css/bootstrap-datepicker.min.css">
   
   <link rel="stylesheet" href="css/datepicker/datepicker3.css">
   <link rel="stylesheet" href="css/select2.min.css">
   <script src="js/bootstrap-datepicker.min.js"></script>
   <script src="js/select2.full.min.js"></script>
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

   <script type="text/javascript">
     $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
     })
   </script>


   <script type="text/javascript">
    $(document).ready(function () {
         $("#seri").hide();
        // $("#ketTotal").hide();
        $("#kps").change(function(){
            // var tgl1 = $("#tgl1").val();
            // var jmlPembayaran = $("#jmlPembayaran").val();
            var kps =$("#kps").val();
            if (kps == "Ya") {
                $("#seri").show(0);
            }else{
                $("#seri").hide(0);
            }
        });
        });
   </script>
  <section class="content-header">
      
    </section><br/>
     
    
       

  
        <div class="col-12">
           <?php
            if (isset($_SESSION['info-login'])) {
                echo $_SESSION['info-login'];
            }
            unset($_SESSION['info-login']);
            ?>
                <div class='alert alert-dismissable alert-danger'><strong>PERHATIAN!</strong> Silahkan isikan data secara lengkap. Data yang diisikan merupakan data yang <strong>SEBENAR - BENARNYA</strong>, data tersebut akan menjadi <strong>TANGGUNG JAWAB</strong> Siswa yang bersangkutan. Data tersebut akan digunakan untuk <strong>Administrasi</strong> ataupun keperluan lain yang berhubungan dengan Akademik dan Kesiswaan.
                </div>
            </div>
<form  method="POST" action="?siswa=ubah_profil">
        <div class="row">
            <div class="col-md-6 ">
                <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Identitas Siswa</div>
                    <div class="panel-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">NIS</label>
                        <input type="text" class="form-control" name="nis" id="nis" placeholder="NIS" value="<?php echo $siswa['nis']?>" readonly>
                    </div>

                     <div class="form-group">
                        <label for="exampleInputEmail1">NISN</label>
                       <input type="text" class="form-control" name="nisn" id="input-text" placeholder="NISN" value="<?php echo $siswa['nisn']?>" readonly>
                    </div>

                     <div class="form-group">
                        <label for="exampleInputEmail1">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="input-text" placeholder="Nama Lengkap" required value="<?php echo $siswa['nama_lengkap']?>">
                    </div>

                     <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Kelamin</label>
                       <select name ="jk" id="jenjang" class="form-control" required>
                              <option>Pilih Kelamin</option>
                              <option value="L" <?php echo ($siswa['jk'] == "L") ? 'selected' : ''; ?>>L</option>
                              <option value="P" <?php echo ($siswa['jk'] == "P") ? 'selected' : ''; ?>>P</option>

                            </select>
                    </div>

                     <div class="form-group">
                        <label for="exampleInputEmail1">Tempat Lahir</label>
                        <input type="text" class="form-control" id="input-text" name="tmpt" placeholder="Tempat Lahir" value="<?php echo $siswa['tempat_lahir'] ?>" required>
                    </div>

                      <div class="form-group">
                        <label>Tanggal Lahir</label>

                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="date" class="form-control pull-right"  name="tgl_lahir" placeholder="Masukkan Tanggal Lahir" required="">
                        </div>
                        <!-- /.input group -->
                      </div>

                       <div class="form-group">
                        <label for="exampleInputEmail1">Agama</label>
                        <select name ="agama" id="jenjang" class="form-control" required>
                              <option>Pilih Agama</option>
                              <option value="Islam">Islam</option>
                              <option value="Kristen">Kristen</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Buddha">Buddha</option>

                            </select>
                    </div>

                     <div class="form-group">
                        <label for="exampleInputEmail1">No Telpon</label>
                        <input type="text" class="form-control" name="no_telpon" id="input-text" placeholder="No Telpon" value="<?php echo $siswa['telpon']?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email" id="input-text" placeholder="Email (example@mail.com)" value="<?php echo $siswa['email']?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">SKHUN SD</label>
                        <input type="text" class="form-control" name="skhun" id="input-text" placeholder="SKHUN" value="<?php echo $siswa['skhun_sd']?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">KPS</label>
                        <select name ="kps" id="kps" class="form-control">
                              <option>Pilih..</option>
                              <option value="Ya">Ya</option>
                              <option value="Tidak">Tidak</option>

                            </select>
                    </div>

                    <div class="form-group" id="seri">
                        <label for="exampleInputEmail1">No. KPS</label>
                       <input type="text" name="seri" class="form-control" id="input-text" placeholder="Seri KPS">
                    </div>

                     <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat" required>
                       
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Provinsi</label>
                        <script type="text/javascript" src="modules/profil/custom.js"></script>
                            <select  name="provinsi" class="form-control provinsi select2" id="provinsi" >
                              <?php
                              $prov = $db->query("SELECT * FROM tbl_provinsi");
                              echo'<option>Pilih Provinsi</option>';
                              while ($dataprov = $prov->fetch(PDO::FETCH_ASSOC)) {
                                echo'<option value="'.$dataprov['id'].'">'.$dataprov['nama'].'</option>';
                              }
                              ?>
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Kabupaten</label>
                        <select  name="kota" class="form-control kota select2" id="kota">
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Kecamatan</label>
                        <select name="kecamatan" class="form-control kecamatan select2" id="kecamatan">
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Desa/Kelurahan</label>
                        <select name="kelurahan" class="form-control kelurahan select2" id="kelurahan">
                            </select>
                    </div>

                     <div class="form-group">
                        <label for="exampleInputEmail1">Alat Transformasi</label>
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
            </div>
          </div>
            
       <div class="col-md-6">
                <div class="panel panel-primary">
                <div class="panel-heading">Data Orang Tua/Wali</div>
               
                  
                    <div class="panel-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama Ayah</label>
                        <input type="text" class="form-control" id="input-text" name="nama_ayah" placeholder="Nama Ayah" value="<?php echo $siswa['nama_ayah']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tahun Lahir</label>
                        <input type="number" class="form-control" name="thn_ayah" id="input-text" placeholder="Tahun Lahir" value="<?php echo $siswa['thn_lahir']?>"required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Pekerjaan Ayah</label>
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

                    <div class="form-group">
                        <label for="exampleInputEmail1">Pendidikan Ayah</label>
                       <select name ="p_ayah" id="jenjang" class="form-control">
                              <option>Pilih Pendidikan Ayah</option>
                              <option value="SD">SD</option>
                              <option value="SMP">SMP</option>
                              <option value="SMA">SMA</option>
                              <option value="Sarjana">Sarjana</option>
                              <option value="Lainnya">Lainnya..</option>

                            </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Penghasilan Ayah</label>
                       <select name ="hasil_ayah" id="jenjang" class="form-control">
                              <option>Pilih Penghasilan Ayah</option>
                              <option value="Lebih 5 Juta">Lebih 5 Juta</option>
                              <option value="Kurang 5 Juta">Kurang 5 Juta</option>
                              <option value="Lebih 1 Juta">Lebih 1 Juta</option>
                              <option value="Kurang 1 Juta">Kurang 1 Juta</option>
                              <option value="Lainnya">Lainnya..</option>

                            </select>
                    </div>

                     <div class="form-group">
                        <label for="exampleInputEmail1">Nama Ibu</label>
                       <input type="text" class="form-control" name="nama_ibu" id="input-text" placeholder="Nama Ibu" value="<?php echo $siswa['nama_ibu']?>" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tahun Lahir Ibu</label>
                      <input type="number" class="form-control" name="thn_ibu" id="input-text" placeholder="Tahun Lahir" value="<?php echo $siswa['thnlahir']?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Pekerjaan Ibu</label>
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

                    <div class="form-group">
                        <label for="exampleInputEmail1">Pendidikan Ibu</label>
                       <select name ="p_ibu" id="jenjang" class="form-control">
                              <option>Pilih Pendidikan Ibu</option>
                              <option value="SD">SD</option>
                              <option value="SMP">SMP</option>
                              <option value="SMA">SMA</option>
                              <option value="Sarjana">Sarjana</option>
                              <option value="Lainnya">Lainnya..</option>

                            </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Penghasilan Ibu</label>
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

             <div class="col-md-6">
                <div class="panel panel-primary">
                <div class="panel-heading">Perhatian</div>
               
                  
                    <div class="panel-body">
                      <div class="form-group">
                <label>
                  <input type="checkbox" class="flat-red" required="">
                  Saya setuju dengan ini, data yang sudah saya isikan diatas adalah data yang BENAR dan bisa DIPERTANGGUNGJAWABKAN.
                </label>
              </div>
                      <div class="modal-footer">
                    <a href="?siswa=beranda"><button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i> Batal</button></a>
                    <button type="submit" class="btn btn-primary btn-flat" name="ubah_profil"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
                  </div>

</form>

    </section>