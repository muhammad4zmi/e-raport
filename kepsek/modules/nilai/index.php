<?php
if (!isset($_SESSION['admin-username'])) {
    header("location:../../login-form.php");
}
include "lap_kelas.php";

//$nis=$_POST['inputNis'];
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
 <h3 class="page-header"><i class="fa fa-book fa-fw fa-2x"></i> Halaman Input Nilai Siswa
            </h3>
<div class="row-fluid placeholders">
    <div class="col-md-12 text-left">
    <p>
                            
                            <br/>
                        </p>
                        <?php
                        if (isset($_SESSION['alert'])) {
                            echo $_SESSION['alert'];
                        } unset($_SESSION['alert']);
                        ?>
                        <?php
                            ?>
                        
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading"><i class="fa fa-book fa-fw fa-2x"></i> 
                Data Nilai Siswa Per Mata Pelajaran
            </div>
            <div class="panel-body">
            <ul id="myTab" class="nav nav-tabs">
                <?php
                $cek_angk = mysqli_query($link, "select id_kelas,kelas from tbl_kelas group by id_kelas asc order by id_kelas asc");
                while ($a_angk = mysqli_fetch_assoc($cek_angk)) {
                    ?>
                    <li class=""><a href="#<?php echo $a_angk['kelas']; ?>" data-toggle="tab"><?php echo $a_angk['kelas']; ?></a></li>
                    <?php
                }
                ?>
            </ul>
            <!--bagian isi-->
            <div id="myTabContent" class="tab-content">
                <?php
                $cek_angk2 = mysqli_query($link, "select tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_walikelas.id_wali,
tbl_walikelas.nip,tbl_guru.nip,tbl_guru.nama_guru from tbl_kelas,tbl_walikelas,
tbl_guru where tbl_kelas.id_kelas=tbl_walikelas.id_kelas and tbl_walikelas.nip=tbl_guru.nip group by tbl_guru.nip order by
tbl_kelas.id_kelas asc");
                while ($a_angk2 = mysqli_fetch_assoc($cek_angk2)) {
                    ?>
                    <div class="tab-pane fade" id="<?php echo $a_angk2['kelas']; ?>"><br/>
                    <table class="table table-condensed">
                
                </table>
                        <?php
                        view_angkatan($a_angk2['kelas'], $link);
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
</section>
</aside>




<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

                <!-- <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-question-circle fa-fw fa-lg"></i>Konfirmasi Hapus</h4>
                </div> -->
                
                <div class="modal-body">
                    <h3 align="center"><i class="fa  fa-times-circle-o fa-fw fa-4x"></i></h3>
                    <h4 align="center"><strong><p>Yakin Hapus Data ini.??</p></strong></h4>
                    <!--  <p class="debug-url"></p> -->
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i>Batal</button>
                    <a class="btn btn-danger btn-ok" >Ya, Hapus <i class="fa fa-sign-out fa-fw fa-lg"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Ubah Data Kelas</h4>
                </div>
                <div class="modal-body">

                </div>
                
                
                
            </div>
        </div>
    </div>
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

<script>
    $("#Mapel").change(function(){
        
        var id_md = $("#Mapel").val();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "modules/raport/ambil-kkm.php",
            data: "md="+id_md,
            success: function(msg){     
                if(msg == ''){
                    alert('Tidak ada data Siswa');
                }
                else{
                    $("#SK3").html(msg);
                    
                    
                }
            }
        }); 
    });  
    </script 

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
<script type="text/javascript" src="modules/raport/raport.js"></script>
<script type="text/javascript" src="modules/raport/costum_nilai.js"></script>
<script src="http://127.0.0.1/e-raport/admin/js/select2.js" type="text/javascript"></script>
    <script src="http://127.0.0.1/e-raport/admin/js/select2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#inputMapel").select2({
                placeholder: 'Pilih Pelajaran',
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
            url: "modules/raport/ambil-mapel.php",
            data: "md="+id_md,
            success: function(msg){     
                if(msg == ''){
                    alert('Tidak ada data Siswa');
                }
                else{
                    $("#inputMapel").html(msg);
                    
                    
                }
            }
        }); 
    });  
    </script 

