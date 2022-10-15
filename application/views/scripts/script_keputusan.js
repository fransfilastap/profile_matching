$(function(){
	$("#heh").hide();
	$("#keputusan").dataTable({
            "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ per page",
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            }
        });

	$("form#simpanKeputusan").bind("submit",function(){


		$("#confirmModal").modal("show");

		var _form = $(this);
		var id_hasil = $("input[name=id_hasil]").val();
		var keputusan 	 = {};

		$("#btn-ya").click(function(evtx){
	        evtx.preventDefault();
	        $("#heh").fadeIn("fast");
			$("table#keputusan > tbody tr").each(function (index1, value1){
				var yes = parseInt( $("td:eq(6)",this).find("select[name=status]").val() );
				var id  = parseInt( $(this).data("id") );
				keputusan[ id ] = yes;
			});

			$.post( _form.attr("action"),{ "id_hasil" : id_hasil, "keputusan":keputusan },function ( response ){
				$("#confirmModal").modal("hide");
			       setInterval(200);
			       $("#OkModal").modal("show");
			       $("#btn_ok").click(function(evt){
				     	evt.preventDefault();
				        $("#OkModal").modal("hide");
				        setInterval(200);
				        window.location.href = "<?php echo site_url('laporan') ?>";
			    	});
			},"JSON" );
        });




		return false;	

	});	
});