<?php
include "../../../config/config.php";

$sql_recaptcha = mysqli_query($link,"SELECT * from recaptcha where id='".$_POST['id']."'");
$j = mysqli_fetch_array($sql_recaptcha);

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
   <form class="form-horizontal" method="POST" action="?admin=edit-captcha" >
                    <fieldset>
                      <div class="form-group">
                             <label class="col-lg-3 control-label">Site Key</label>
                             <div class="col-lg-8">
                              <input class="form-control" id="nama_mhs" type="hidden" name="idkey" value="<?php echo $j['id']?>"/>
                                <input class="form-control" id="nama_mhs" type="text" name="sitekey" value="<?php echo $j['sitekey']?>"/>
                            </div>
                        </div>
                         <div class="form-group">
                         <label class="col-lg-3 control-label">Secret Key</label>
                         <div class="col-lg-8">
                             
                            <input class="form-control" id="nama_mhs" type="text" name="secretkey" value="<?php echo $j['secretkey']?>"/>
                                
                            
                            
                        </div>
                    </div>
                   
                    
                
                

        </fieldset>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i> Keluar</button>
        <button type="submit" class="btn btn-primary btn-flat" name="ubah-captcha"><i class="fa fa-save fa-fw fa-lg"></i> Simpan Data</button>
    </div>
</form>



<script src="http://localhost/e-raport/admin/js/bootstrap-datepicker.js"></script>
<script src="http://localhost/e-raport/admin/js/bootstrap-transition.js"></script>
<script src="http://localhost/e-raport/admin/js/jquery.js"></script>


</body>
</html>