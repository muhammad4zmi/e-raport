<?php
include "../../../config/config.php";

$sql_ekskul = mysqli_query($link,"SELECT * from tbl_ekskul where id_ekskul='".$_POST['id_ekskul']."'");
$j = mysqli_fetch_array($sql_ekskul);

?>
<!DOCTYPE html>
<html>
<head>
   <title></title>




   <link rel="stylesheet" href="http://localhost/e-raport/admin/css/datepicker/datepicker3.css">
   <link href="http://127.0.0.1/e-raport/admin/modules/mapel/select2.css" rel="stylesheet"  type="text/css"/>
   <link href="http://127.0.0.1/e-raport/admin/modules/mapel/select2.min.css" rel="stylesheet" type="text/css"/>
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
   <form class="form-horizontal" method="POST" action="?admin=ubah_ekskul" >
       <fieldset>
                       <div class="form-group">
                        <label class="col-lg-3 control-label">Nama Ekstrakurikuler</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="hidden" name="id_ekskul" value="<?php echo $j['id_ekskul'];?>" required/>
                            <input class="form-control"  type="text" name="ekskul" value="<?php echo $j['nama_ekskul'];?>" required/>

                        </div>
                    </div>
                    
                    
             
                
            

        </fieldset>
<button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i>Keluar</button>
<button type="submit" class="btn btn-primary btn-flat" name="ubah"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
</form>



<script src="http://localhost/e-raport/admin/js/bootstrap-datepicker.js"></script>
<script src="http://localhost/e-raport/admin/js/bootstrap-transition.js"></script>
<script src="http://localhost/e-raport/admin/js/jquery.js"></script>
<script src="http://127.0.0.1/e-raport/admin/modules/mapel/select2.js" type="text/javascript"></script>
<script src="http://127.0.0.1/e-raport/admin/modules/mapel/select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#nip").select2({
            placeholder: 'Pilih Guru',
            allowClear: true
        });
    });
</script>

<script>
    $("#nis").change(function(){

        var id_md = $("#nis").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "modules/prestasi/ambil-kelas.php",
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
</script>
</body>
</html>