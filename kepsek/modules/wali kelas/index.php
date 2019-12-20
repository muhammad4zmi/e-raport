<?php
if (!isset($_SESSION['admin-username']))
    header("location:../../login.php");
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
?>
<br><br>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Raport Online SMPN 1 Mataram | 
            <small>Data Wali Kelas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
            <li class="active">Data Wali Kelas</li>
        </ol>
    </section>
    <section class="content">
        <h3 class="page-header"><i class="fa fa-user fa-fw fa-2x"></i> Halaman Data Wali Kelas
            <form class="navbar-form navbar-right" method="POST" action="?admin=cari_kelas">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" name="cari" class="tultip form-control" placeholder="Cari Kelas..." required="" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Cari Berdasarkan NIP">
                </div>
            </form></h3>
            <div class="row-fluid placeholders">
                <div class="col-md-12 text-left">
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
                        $per_hal = 10;
                        

                        $sql_kelas = mysqli_query($link, "SELECT tbl_walikelas.id_kelas,tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_guru.nip,
tbl_guru.nama_guru from tbl_walikelas INNER JOIN tbl_kelas ON tbl_walikelas.id_kelas=tbl_kelas.id_kelas
INNER JOIN tbl_guru ON tbl_walikelas.nip=tbl_guru.nip group by tbl_walikelas.nip asc ");
                        $j = mysqli_num_rows($sql_kelas);
                        if ($j > 0) {
                            ?>
                            <div class="panel panel-primary">
                                <!-- Default panel contents -->
                                <div class="panel-heading"><i class="fa fa fa-user  fa-fw fa-2x"></i> Data Kelas</div>
                                <div class="panel-body">
                                <table id="example1" class="table table-striped table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            
                                            <th width="20%">Kelas</th>
                                            <th width="60%">Wali Kelas</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($data_kelas = mysqli_fetch_assoc($sql_kelas)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                
                                                <td><?php echo $data_kelas['kelas']; ?></a></td>
                                                
                                                <td><?php echo $data_kelas['nip']."  ".$data_kelas['nama_guru']; ?></td>
                                                
                                            </tr>
                                            <?php
                                            $no++;
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-dismissable alert-info">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            Belum Ada Data Wali Kelas Yang di Inputkan. . .
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </section>
        </aside>

       


   
     <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
                    <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
                    <!-- AdminLTE App -->
                    <script src="js/AdminLTE/app.js" type="text/javascript"></script>
                    
                    <!-- AdminLTE for demo purposes -->

                    <!-- page script -->
                   <script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>

    <script src="http://127.0.0.1/e-raport/admin/js/select2.js" type="text/javascript"></script>
    <script src="http://127.0.0.1/e-raport/admin/js/select2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#id_kelas").select2({
                placeholder: 'Pilih Kelas',
                allowClear: true
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#nip").select2({
                placeholder: 'Pilih Guru',
                allowClear: true
            });
        });
    </script>

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
                $.post('modules/wali kelas/hasil.php',
                    {id_kelas:$(this).attr('data-id')},

                    function(html){
                        $(".modal-body").html(html);
                    }   
                    );
            });
        });
        
    </script>