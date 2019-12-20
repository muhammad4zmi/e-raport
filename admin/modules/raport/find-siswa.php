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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cari = antiinjection($_POST['cari']);
    $sql_laporan = mysqli_query($link, "SELECT tbl_kelas.id_kelas,tbl_kelas.kelas,tbl_siswa.nis,
 tbl_siswa.nama_lengkap,rekap_nilai.semester from rekap_nilai INNER JOIN 
tbl_kelas ON rekap_nilai.id_kelas=tbl_kelas.id_kelas 
INNER JOIN tbl_siswa ON tbl_kelas.nis=tbl_siswa.nis where tbl_siswa.nis LIKE '%" . $cari . "%' group by tbl_siswa.nis");
    
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
    <h3 class="page-header"><i class="fa fa-trophy fa-fw fa-2x"></i> Halaman Pencarian Data Siswa
        <!-- <form class="navbar-form navbar-right" method="POST" action="?admin=cari_guru">
            <img src="../style/img/search-ico.png" alt="search-ico" width="45px" height="45px"> <input type="text" name="cari" class="form-control" placeholder="Cari Guru..." required="">
        </form> -->
    </h3>
    <div class="row-fluid placeholders">
        <div class="col-md-12 text-left">
            <?php
            $hsl = mysqli_num_rows($sql_laporan);
            if ($hsl > 0) {
                $no = 1;
                ?>
                <div class="alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Berhasil!</h4>
                    <p>Hasil Pencarian : <big><strong><?php echo $hsl; ?></strong></big> Data Ditemukan.</p>
                    <p>
                        <a type="button" class="btn btn-warning" href="?admin=raport"><i class="fa fa-backward"></i> Kembali Ke Menu Raport</a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CariLagi"><i class="fa fa-search-plus"></i> Pencarian Baru</button>
                    </p>
                </div>
                <div class="panel panel-primary">

                <!-- Default panel contents -->
                <div class="panel-heading"><i class="fa fa-users fa-fw fa-2x"></i> Data Siswa</div>
                 <div class="panel-body">
                <table class="table table-striped table-hover table-condensed table-bordered" >
        <thead>
            <tr>
               <th>#</th>
                                            <th>Nama Siswa</th>
                                            <!-- <th>Kelas</th> -->
                                            
                                            <th >Semester</th>
                                            
                                            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
                        <?php
                        $no = 1;
                        while ($data_r = mysqli_fetch_assoc($sql_laporan)) {
                    $nis=$data_r['nis'];
                    $id_kelas=$data_r['id_kelas'];
                    $kelas=$data_r['kelas'];
                    $semester=$data_r['semester'];
                    $query_total = mysqli_query($link, "SELECT rapot.nis,rapot.id_kelas,
                                                Sum(rapot.nilai) as tot_nilai, count(rapot.kd_mapel) as mapel
                                                FROM rapot
                                                WHERE rapot.id_kelas and rapot.id_kelas='$id_kelas' and rapot.nis ='$nis' 
                                                and rapot.semester='Ganjil'  GROUP BY rapot.nis order by tot_nilai desc");
                         $total_nilai = mysqli_fetch_array($query_total);
                         $jml_nilai_ganjil = $total_nilai['tot_nilai'];


                         //genap
                         $query_total2 = mysqli_query($link, "SELECT rapot.nis,rapot.id_kelas,
                                                Sum(rapot.nilai) as tot_nilai, count(rapot.kd_mapel) as mapel
                                                FROM rapot
                                                WHERE rapot.id_kelas and rapot.id_kelas='$id_kelas' and rapot.nis ='$nis' 
                                                and rapot.semester='Genap'  GROUP BY rapot.nis order by tot_nilai desc");
                         $total_nilai1 = mysqli_fetch_array($query_total2);
                         $jml_nilai_genap = $total_nilai1['tot_nilai'];

                ?>
                 <tr>
                                                <td><?php echo $no; ?></td>
                                               <td><?php echo $data_r['nis']."  ".$data_r['nama_lengkap']; ?></td>
                                                <!-- <td><?php echo $data_r['kelas']; ?></td> -->
<!--                                                 <td><?php echo $data_r['thn_ajaran']; ?></td> -->
                                                <td>
                                                <?php
                                                    if($jml_nilai_ganjil==0){
                                                      echo "Nilai Ganjil <span class='badge bg-red'><strong>0</strong></span>";  
                                                    }elseif($jml_nilai_ganjil > 0){
                                                        echo "Nilai Ganjil <span class='badge bg-yellow'><strong> $jml_nilai_ganjil </strong></span>";
                                                    }
                                                
                                                    ?>
                                                    <?php
                                                    if($jml_nilai_genap==0){
                                                      echo "Nilai Ganjil <span class='badge bg-red'><strong>0</strong></span>";  
                                                    }elseif($jml_nilai_genap > 0){
                                                        echo "Nilai Genap <span class='badge bg-green'><strong> $jml_nilai_genap </strong></span>";
                                                    }
                                                
                                                    ?>
                                                    </td>
                                                
                                                <td>
                                                 <a href="?admin=detail_raport&nis=<?php echo $data_r['nis']; ?>&id_kelas=<?php echo $data_r['id_kelas'];?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Lihat Detail Raport Siswa <?php echo $data_r['nama_lengkap']?>">
                                                       <button type="button" class="btn btn-success btn-flat btn-xs"><i class="glyphicon glyphicon-eye-open"></i></button>
                                                   </a>
                                                   <a href="?admin=add_raport&nis=<?php echo $data_r['nis']; ?>&id_kelas=<?php echo $data_r['id_kelas'];?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Isi Raport Siswa <?php echo $data_r['nama_lengkap']?>">
                                                       <button type="button" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-plus-circle"></i></button>
                                                   </a>

                                                   
                                                <a href="#" data-href="index.php?admin=del-raport&nis=<?php echo $data_r['nis']; ?>" data-toggle="modal" data-target="#confirm-delete">
                                                    <button type="button" class="btn btn-danger btn-flat btn-xs"><i class="glyphicon glyphicon-trash"></i></button>

                                                </a>
                                                <a href="?admin=chart-siswa&nis=<?php echo $data_r['nis']; ?>&id_kelas=<?php echo $data_r['id_kelas'];?>" class="ubah"  title="" data-toggle="tooltip" data-original-title="Lihat Grafik Siswa <?php echo $data_r['nama_lengkap']?>">
                                                       <button type="button" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-bar-chart"></i>  Lihat Grafik </button>
                                                   </a> 
                                                
                                            </td>
                                        </tr>
                <?php
                $no++;
            }
        
            ?>
        </tbody>
    </table>
            </div>
            <?php
        } else {
            //jika tidak melaliu POST
            ?>
            <div class="alert alert-danger fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>Mohon Maaf!</h4>
                <p>Anda Belum Menginputkan Data Pencarian.</p>
                <p>
                    <a type="button" class="btn btn-warning" href="?admin=raport"><i class="fa fa-backward"></i> Kembali Ke Menu Raport</a>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CariLagi"><i class="fa fa-search-plus"></i> Ulangi Pencarian</button>
                </p>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</section>
</aside>

<!-- Modal -->
<div class="modal fade" id="CariLagi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Pencarian Data Siswa</h4>
            </div>
            <div class="modal-body">
                Isi Data Pencarian : <form class="navbar-form" method="POST" action="?admin=cari-siswa">
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="tultip form-control" name="cari" placeholder="Cari Siswa..." required="" data-placement="bottom" title="" data-toggle="tooltip" data-original-title="Cari Berdasarkan NIS">
                </div>
                </form>
            </div>
            <div class="modal-footer text-left">
                <i>Cari Data Berdasarkan NIS Siswa . .</i>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="myEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                       <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i> Ubah Data Siswa</h4>
                    </div>
                    <div class="modal-body">
                     
                    </div>
                    
                       
                    
                </div>
            </div>
        </div>




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
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times fa-fw fa-lg"></i>Batal</button>
                    <a class="btn btn-danger btn-ok btn-flat" >Ya, Hapus <i class="fa fa-sign-out fa-fw fa-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
 <script src="../js/bootstrap-transition.js"></script>
 <script src="../js/bootstrap-datepicker.js"></script>
<script>
  $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#myEdit").modal('show');
                $.post('modules/siswa/hasil.php',
                    {nip:$(this).attr('data-id')},

                    function(html){
                        $(".modal-body").html(html);
                    }   
                );
            });
        });
    
    </script>
     <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
           $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    <?php
}