$(document).ready(function() {
    $("#cek_nis").click(function() {
        // fungsi untuk mengecek total nilai mahasiswa
        $("#pesan").html("<img src='style/img/ajax-loader1.gif' />");
//        $("#pesan").hide();
        var nis = $("#inputNis").val();
        $.ajax({
            type: "GET",
            url: "ambil-nis.php",
            data: "inputNis=" + nis,
            success: function(data) {
                if (data === '') {
                    $("#pesan").fadeIn(300);
                    $("#pesan").html("<div class='alert alert-dismissable alert-danger'><button type='button' class='close' data-dismiss='alert'>×</button><i class='fa fa-ban fa-fw'></i> NIS Tidak Ditemukan, Hubungi Bagian Tata Usaha untuk NIS Anda.</div>");
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
            url: "ambil-email.php",
            data: "inputNis=" + nis,
            success: function(data) {
                if (data !== ''){
                    $("#inputEmail").val(data);
                }
            }
        });

        $.ajax({
            type: "GET",
            url: "ambil-jk.php",
            data: "inputNis=" + nis,
            success: function(data) {
                if (data !== ''){
                    $("#inputGender").val(data);
                }
            }
        });
        
        });
     
});


