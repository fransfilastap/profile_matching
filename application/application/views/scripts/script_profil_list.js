$(function(){
	$(".hapus").click(function(evt){
		evt.preventDefault();

		var kode = $(this).data('kode');
		var url = $(this).attr('href');

		$("#deleteModal").modal("show");

		$("#btn-ya").click(function(evtx){
			evtx.preventDefault();
			$.get(url,function(data){
				$("#deleteModal").modal("hide");
				setInterval(function(){
					
				},800);
				window.location.href = "<?php site_url('kriteria') ?>";
			});
		})
	});
});

$(document).ready(function(){
	$("#profil").dataTable({
            "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ per page",
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }]
        });


	var profile_matching = function( id ){


		jQuery.ajax({
			url : "<?php echo site_url('getpmparam') ?>"+"/"+id,
			method : "GET",
			dataType : "JSON",
			success : function( response ){

				var candidats 	= response.candidates;
				var CF 			= response.cf;
				var SF 			= response.sf;
				var persentase_aspek  = response.pa;

			    jQuery.ajax({
			            url     : "<?php echo site_url('penilaian/profile_matching') ?>",
			            type    : 'POST',
			            dataType : 'JSON',
			            data    : {
			                "peserta" : candidats,
			                "jabatan" : id,
			                "CF"      : CF,
			                "SF"      : SF,
			                'persentase_aspek' : persentase_aspek
			            },
			            success : function( response ){
			            	window.location.href = "<?php echo site_url('keputusan'); ?>";

			            }
			    });

			}

		});

	};

	$("a.ranking").click(function(evt){

		evt.preventDefault();
		var loading = $(this).closest(".loading");
		loading.html("<img src='<?php echo base_url('assets/img/ajax-loader.gif'); ?>' /> <i>Calculating...</i>");
		var jml = parseInt($(this).data("total")); 
		if( jml <= 0 ){
			alert("Kandidat kurang dari 1!");
		}else{
			profile_matching( $(this).data('id') );
		}
		loading.html("Selesai.");

	});	


});