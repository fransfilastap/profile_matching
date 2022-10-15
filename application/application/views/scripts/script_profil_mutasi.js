$(document).ready(function(){

	var id_subkriteria 	= [];
	var nilai 			= [];
	var CF = 0;
    var SF = 0;
    var persentase_aspek = {};

	// FORM SUBMIT
	$("form#tambahProfil").bind('submit',function(){
		var table = <?php echo $tables ?>;

		CF = $("input[name=CF]").val();
        SF = $("input[name=SF]").val();

        $("input.aspek").each(function (){
            persentase_aspek[this.name] = this.value;
        });

		for (var i = 0; i < table.length; i++) {
			$("table#tabel_"+table[i]).find("tbody tr").each(function(i){
				id_subkriteria.push( $(this).find("td:eq(0)").data('id') );
				nilai.push( parseInt( $(this).find("td:eq(2)").find('select[name=nilai]').val() ) );
			});
		};

		$.ajax({
			url 	: $(this).attr("action"),
			type	: $(this).attr("method"),
			dataType : 'JSON',
			data	: {
				'nama_profil_mutasi' : $("input[name=nama_profil_mutasi]").val(),
				'subkriterias' : id_subkriteria,
				'nilai'	: nilai,
				"CF"      : CF,
                "SF"      : SF,
                "min_ipk"	: $("input[name=ipk_minimal]").val(),
                "min_pendidikan" : $("select[name=pendidikan]").val(),
                'wilayah' : $("input[name=wilayah]").val(),
                'persentase_aspek' : persentase_aspek
			},
			beforeSend : function(){
				if( id_subkriteria.length == 0 || nilai.length == 0 ){
					alert('isi aspek nilai profil mutasi terlebih dahulu');
					return false;
				}
			},
			success : function( response ){
				if( response.status != 'success' ){
					alert( response.message );
					return false;
				}else{
					alert( response.message );
					window.location.href = "<?php echo site_url('profil_mutasi') ?>";
				}
			}
		});

		return false;

	});

});