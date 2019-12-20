<?php
include "../../../config/config.php";

$sql_nilai = mysqli_query($link,"SELECT * from rekap_nilai where nis='".$_POST['nis']."'");
$j = mysqli_fetch_array($sql_nilai);

?>
<!DOCTYPE html>
<html>
<head>
   <title></title>
   
   
   
   
   <link rel="stylesheet" href="http://localhost/e-raport/admin/css/datepicker/datepicker3.css">
   <style>
    .datepicker{z-index:1151;}
</style>
<script>
    $(function(){
        $("#tgl").datepicker({
            dateFormat : "dd/mm/yy",
            
            changeMonth : true,
            changeYear : true
        });
    });
    

</script>
</head>
<body>
   <form class="form-horizontal" method="POST" action="?admin=ubah_guru" >
       <fieldset>
                                                 <div class="form-group">
                                                   <label class="col-lg-3 control-label">Siswa</label>
                                                   <div class="col-lg-8">
                                                       <input class="form-control" type="text" name="nis" value="<?php echo $j['nis']?>" readonly />
                                                  </div>
                                              </div>
                                             <div class="form-group">
                                           <label class="col-lg-3 control-label">Kelas</label>
                                           <div class="col-lg-8">
                                               
                                              <select name="kelas" id="SK" class="form-control">
                                                  
                                              </select>
                                              
                                          </div>
                                      </div>
                                                <div class="form-group">
                                                   <label class="col-lg-3 control-label">Mata Pelajaran</label>
                                                   <div class="col-lg-8">
                                                      <select name="kd_mapel" id="nis2" style="width: 370px" class="form-control">
                                                          <?php
                                                          //include "../../../config/config.php";
                                                          $q = mysqli_query($link,"SELECT tbl_guru.nip,tbl_mapel.kd_mapel,tbl_mapel.nip,tbl_mapel.nama_mapel 
                                                              from tbl_guru INNER JOIN tbl_mapel ON tbl_guru.nip=tbl_mapel.nip where tbl_mapel.nip");
                                                          while($r = mysqli_fetch_array($q)) {
                                                              ?>
                                                              <option value="<?php echo $r['kd_mapel'] ?>">
                                                                  <?php echo $r['kd_mapel']." ".$r['nama_mapel'] ?>
                                                              </option>
                                                              <?php
                                                          }
                                                          ?>
                                                      </select>
                                                  </div>
                                              </div>
                                                 <div class="form-group">
                                                   <label class="col-lg-3 control-label">Guru</label>
                                                   <div class="col-lg-8">
                                                       
                                                      <select name="guru" id="SK2" class="form-control">
                                                          
                                                      </select>
                                                      
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                <label class="col-lg-3 control-label">Semester</label>
                                                <div class="col-lg-8">
                                                  <select required="" name="semester" class="form-control">
                                                  <option value="">Pilih Semester</option>
                                                  <option value="Genap" >Genap</option>
                                                  <option value="Ganjil" >Ganjil</option>
                                                  </select>
                                                </div>
                                                </div>
                                                <div class="form-group">
                                                <label class="col-lg-3 control-label">KKM</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control"  id="tgl" type="text" name="kkm" value="<?php echo $j['kkm']?>" />
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Nilai Pelajaran</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control"  id="tgl" type="text" name="nilai" value="<?php echo $j['nilai_akhir']?>" />
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Nilai (Huruf)</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control"  id="tgl" type="text" name="ket" value="<?php echo $j['keterangan']?>"/>
                                                    
                                                </div>
                                            </div>



                                        </fieldset>
<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i>Keluar</button>
<button type="submit" class="btn btn-primary btn-flat" name="ubah_guru"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
</form>




<script type="text/javascript">
    $("#nis2").change(function(){
        
        var id_md1 = $("#nis2").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "modules/nilai/ambil-guru.php",
            data: "md1="+id_md1,
            success: function(msg){     
                if(msg == ''){
                    alert('Tidak ada data Siswa');
                }
                else{
                    $("#SK2").html(msg);
                    
                    
                }
            }
        }); 
    });  
    </script>

</body>
</html>