$(document).ready(function() {
    $("#cek_nis").click(function() {
        // fungsi untuk mengecek total nilai mahasiswa
        $("#pesan").html("<img src='style/img/ajax-loader1.gif' />");
//        $("#pesan").hide();
        var nis = $("#inputNis").val();
        $.ajax({
            type: "GET",
            url: "modules/raport/ambil-nis.php",
            data: "inputNis=" + nis,
            success: function(data) {
                if (data === '') {
                    $("#pesan").fadeIn(300);
                    $("#pesan").html("<div class='alert alert-dismissable alert-warning'><button type='button' class='close' data-dismiss='alert'>×</button><i class='fa fa-ban fa-fw'></i> NIM Tidak Ditemukan, Hubungi Bagian PusTIK untuk NIM Anda.</div>");
                    $("#pesan").fadeOut(5000);
                }
                else {
                    $("#pesan").fadeIn(300);
                    $("#pesan").html("<div class='alert alert-dismissable alert-success'><button type='button' class='close' data-dismiss='alert'>×</button><big><strong><i class='fa fa-check-square-o fa-fw'></i>Info !</strong></big> Data Ditemukan.</div>");
                    $("#inputNama").val(data);
                    $("#pesan").fadeOut(2500);
                }
            }
        });
        //fungsi untuk mengecek email mahasiswa
        $.ajax({
            type: "GET",
            url: "ambil-kls.php",
            data: "inputNis=" + nis,
            success: function(data) {
                if (data !== ''){
                    $("#inputKelas").val(data);
                }
            }
        });

        $.ajax({
            type: "GET",
            url: "ambil-kelas.php",
            data: "inputNis=" + nis,
            success: function(data) {
                if (data !== ''){
                    $("#inputKls").val(data);
                }
            }
        });
        
        });
     
});


