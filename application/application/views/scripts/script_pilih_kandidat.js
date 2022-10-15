$(function(){

	var id_kandidat = [];

    $(".loading").hide();

	$("#table_pegawai").dataTable({
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

	jQuery('#table_pegawai .group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                } else {
                    $(this).attr("checked", false);
                }
            });
            jQuery.uniform.update(set);
    }); 

    $("#table_pegawai .group-checkable").trigger("click");

    $("a#simpan").click(function(evt){
    	evt.preventDefault();

        $(".loading").show();

        var _url = $(this).attr("href");
        var id_profil = $(this).data("id");

    	$("#table_pegawai .checkboxes").each(function () {
            if( $(this).is(':checked') ){
                id_kandidat.push( $(this).val() );
            }
        });

    	jQuery.ajax({

    		url : _url,
    		type : "POST",
    		data : {
    			"id_kandidat"   : id_kandidat,
    			"id_profil"		: id_profil
    		},
    		dataType : 'text',
            beforeSend : function(){
               if( id_kandidat.length <= 0 ){
                    alert("Pilih Kandidat coy");
                    return false;
               }
            },
    		success : function( response ){
                window.location.href = "<?php echo site_url('kandidat') ?>"
    		}

    	});

    });

});