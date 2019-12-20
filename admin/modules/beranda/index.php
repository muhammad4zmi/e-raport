<?php
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
    //include "../config/config.php";
 
  $ambil_data = mysqli_query($link,"select * from tbl_info where tipe='Sambutan'");  
  while($hasil_data = mysqli_fetch_array($ambil_data)){  

?>
<br>
<br>
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

<div class="row-fluid placeholders">
    <div class="col-md-12 text-left">

        <h3 class="page-header"><i class="fa fa-home fa-fw"></i>Selamat Datang Admin</h3>
        <div class="row placeholders">
            <div class="col-md-8 " align="left">
                <div class="panel panel-primary">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><i class="fa  fa-hand-o-right fa-fw fa-2x"></i> Sambutan Kepala Sekolah</div>
                    <div class="panel-body">
                    <div class="span4">  
                     <img class="img-polaroid" src="style/ico/tutwuri.png" style="width:150px; height: 100px; float:left; margin-right:10px;"/> 
                     </div> 
                       <div class="span8">  
                  <h3 align="left"><b><?=$hasil_data['judul'];?></b><br/> <span class="badge bg-green">Diposkan pada <?=DateToIndo($hasil_data['tgl_post']);?></span></h3>
                
                   <p align="left" style="text-align:justify;"><?=substr($hasil_data['isi'],0,500);?></p>  
                   
               </div>  
               <?php } ?> 
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-justify">
                <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-bullhorn fa-fw  fa-2x"></i> Pengumuman/Info Terbaru</div>
                <?php
                $ambil_data1 = mysqli_query($link,"select * from tbl_info where tipe='Pengumuman' order by tgl_post desc limit 0,2");  
  while($hasil_data1 = mysqli_fetch_array($ambil_data1)){  
    ?>
                    <!-- Default panel contents -->
                    
                    <div class="panel-body">
                        
      <h3 align="left"><b><?=$hasil_data1['judul'];?></b><br/><span class="badge bg-green">Diposkan pada <?=DateToIndo($hasil_data1['tgl_post']);?></span></h3>
    
       <p align="left" style="text-align:justify;"><?=substr($hasil_data1['isi'],0,100);?>  
        
       <!--  <a href="berita_detail.php?link=detail_berita.php&id=<?=$hasil_data1['id_info'];?>">Baca Selengkapnya</a>  -->  
        <a href="#" class="edit-record" data-id="<?php echo $hasil_data1['id_info'];?>" title="" data-original-title="">Baca Selengkapnya</a>   
         
      </p>  
     
               <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </section>
</aside>

<div class="modal fade" id="berita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-fw fa-lg"></i>Detail Informasi</h4>
            </div>
            <div class="modal-body">

            </div>



        </div>
    </div>
</div>
</div>
</div>
</section>
</aside>

<script type="text/javascript">
  $(function(){
    $(document).on('click','.edit-record',function(e){
        e.preventDefault();
        $("#berita").modal('show');
        $.post('modules/beranda/hasil.php',
            {id_info:$(this).attr('data-id')},

            function(html){
                $(".modal-body").html(html);
            }   
            );
    });
});
</script>