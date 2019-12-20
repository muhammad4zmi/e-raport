jQuery(function($) {
    "use strict";
	
$('body').on('change', '.inputNis', function(e) {
        e.preventDefault();
		var id = $("#inputNis").val();
        $.ajax({
        	type : "POST",
        	url  : "modules/raport/data.php?page=cari-nis",
        	data :  {id : id},
        	success : function(data){
				$("#kota").html(data);
				
				getKota();
        	}
        });
    });
});