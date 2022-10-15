$(function(){

	var jenjang 	 = [];
	var institusi 	 = [];
	var jurusan 	 = [];
	var tahun_masuk  = [];
	var tahun_keluar = [];
	var ipk			 = [];	

	var nama_kursus  = [];
	var tempat 		 = [];
	var lamanya 	 = [];
	var keterangan 	 = [];

	var jabatan 	 = [];
	var wilayah 	 = [];
	var dari 		 = [];
	var sampai 		 = [];
	var keterangan   = [];


	var tambah_row = function (){

		var row = "<tr>"+
	                "<td>"+
	                 "<select name='jenjang' class='span12 m-wrap jenjang'>"+
					        "<option value=''>Pilih...</option>"+
					        "<option value='1'>D3</option>"+
					        "<option value='2'>S1</option>"+
					        "<option value='3'>S2</option>"+
					        "<option value='4'>S3</option>"+
					    "</select>"+
					"</td>"+
	                "<td><input type='text' name='institusi' class='span12 m-wrap institusi' /></td>"+
	                "<td><input type='text' name='nama_jurusan' class='span12 m-wrap jurusan' /></td>"+
	                "<td><input type='text' name='tahun_masuk' class='span12 m-wrap tahunmasuk' onkeypress='return isNumber(event)' /></td>"+
	                "<td><input type='text' name='tahun_keluar' class='span12 m-wrap tahunkeluar' onkeypress='return isNumber(event)' /></td>"+
	                "<td><input type='text' name='ipk' class='span12 m-wrap ipk'onkeypress='return isFloat(event)' /></td>"+	                              				
	                "<td><a href='#' id='hapusRow' class='btn mini red'><i class='icon-trash'></i></a></td>"+	                              				
	           	"</tr>";

	    return row;
	}

	var tambah_row_nonformal = function (){

		var row = "<tr>"+
	                "<td><input type='text' name='nama_kursus' class='span12 m-wrap kursus' /></td>"+
	                "<td><input type='text' name='tempat' class='span12 m-wrap tempat' /></td>"+
	                "<td><input type='text' name='lama' class='span12 m-wrap lamanya' onkeypress='return isNumber(event)' /></td>"+	                              				
	                "<td><input type='text' name='ket' class='span12 m-wrap ket' /></td>"+
	                "<td><a href='#' id='hapusRow2' class='btn mini red'><i class='icon-trash'></i></a></td>"+	                              				
	           	"</tr>";

	    return row;
	}

	var tambah_row_riwayat = function(){

		var row = "<tr>"+
	                "<td><input type='text' class='span12 m-wrap jabatan' /></td>"+
	                "<td><input type='text' class='span12 m-wrap wilayah' /></td>"+
	                "<td><input type='text' class='span12 m-wrap dari date-picker' onkeypress='return isNumber(event)' /></td>"+	                              				
	                "<td><input type='text' class='span12 m-wrap ket' /></td>"+
	                "<td><a href='#' id='hapusRow3' class='btn mini red'><i class='icon-trash'></i></a></td>"+	                              				
	           	"</tr>";

	    return row;

	}

	$("a#tambah").click(function(evt){
		evt.preventDefault();
		$("table#pendidikan > tbody").append( tambah_row() );
	});

	$("a#tambah_nonformal").click(function(evt){
		evt.preventDefault();
		$("table#pendidikan_nonformal > tbody").append( tambah_row_nonformal() );
	});

	$("a#tambah_jabatan").click( function( evt ){
		evt.preventDefault();
		$("table#riwayat_jabatan > tbody").append( tambah_row_riwayat() );
	} );

	$(document).on('click','a#hapusRow,a#hapusRow2',function(evt){
		evt.preventDefault();
		$(this).closest('tr').slideUp('slow');
		$(this).closest('tr').remove();
	});

	// FORM SUBMIT
	$("form#tambahPegawai").bind('submit',function(){
		
		$("table#pendidikan > tbody tr").each(function(){

			var tingkat = $(this).find('td:eq(0)').find('select.jenjang').val();
			var inst 	= $(this).find('td:eq(1)').find('input.institusi').val();
			var jur 	= $(this).find('td:eq(2)').find('input.jurusan').val();
			var tm 		= $(this).find('td:eq(3)').find('input.tahunmasuk').val();
			var tk 		= $(this).find('td:eq(4)').find('input.tahunkeluar').val();
			var nil 	= $(this).find('td:eq(5)').find('input.ipk').val();

			if( tingkat != "" ) jenjang.push( tingkat );
			if( inst != "" ) institusi.push( inst );
			if( jur != "" ) jurusan.push( jur );
			if( tm != "" ) tahun_masuk.push( tm );
			if( tk != "" ) tahun_keluar.push( tk );
			if( nil != "" ) ipk.push( nil );

		});

		$("table#pendidikan_nonformal > tbody tr").each(function(){

			var _name 	= $(this).find('td:eq(0)').find('input.kursus').val();
			var _tempat = $(this).find('td:eq(1)').find('input.tempat').val();
			var _lama 	= $(this).find('td:eq(2)').find('input.lamanya').val();
			var _ket 	= $(this).find('td:eq(3)').find('input.ket').val();			

			if( _name != "" ) 	nama_kursus.push( _name );
			if( _tempat != "" ) tempat.push( _tempat );
			if( _lama != "" ) 	lamanya.push( _lama );
			if( keterangan != "") keterangan.push( _ket );

		});

		$("table#riwayat_jabatan > tbody tr").each(function(){

			var _jabatan 	= $(this).find("td:eq(0)").find("input.jabatan").val();
			var _wilayah 	= $(this).find("td:eq(1)").find("input.wilayah").val();
			var _dari 	 	= $(this).find("td:eq(2)").find("input.dari").val();
			var _sampai  	= _dari;
			var _keterangan = $(this).find("td:eq(4)").find("input.ket").val();

			if( _jabatan != "" ) jabatan.push( _jabatan );
			if( _wilayah != "" ) wilayah.push( _wilayah );
			if( _dari != "" ) dari.push( _dari );
			if( _sampai != "" ) sampai.push( _sampai );
			if( _keterangan != "" ) keterangan.push( _keterangan );

		});

		$.ajax({
			url 	: $(this).attr("action"),
			type	: $(this).attr("method"),
			dataType : 'JSON',
			data	: {
				'kode_pegawai' 	: $("input[name=kode_pegawai]").val(),
				'nama_pegawai'	: $("input[name=nama_pegawai]").val(),
				'alamat'		: $("textarea#alamat").val(),
				'tempat_lahir'	: $("input[name=tempat_lahir]").val(),
				'tanggal_lahir'	: $("input[name=tanggal_lahir]").val(),
				'diangkat_per'  : $("input[name=diangkat_per]").val(),
				'password'		: $("input[name=passowrd]").val(),
				"jenis_kelamin"	: $("select[name=jenis_kelamin]").val(),
				'institusi'		: institusi,
				'jenjang'		: jenjang,
				'jurusan'		: jurusan,
				'tahun_masuk'	: tahun_masuk,
				'tahun_keluar'  : tahun_keluar,
				'ipk'			: ipk,
				'nama_kursus'	: nama_kursus,
				'tempat'		: tempat,
				'lamanya'		: lamanya,
				'keterangan'	: keterangan,
				'jabatan'		: jabatan,
				'wilayah'		: wilayah,
				'dari'			: dari,
				'sampai'		: sampai,
				'keterangan'	: keterangan
			},
			beforeSend : function(){

				if( institusi.length <= 0 || jurusan.length <= 0 || tahun_masuk.length <= 0 || tahun_keluar.length <= 0 || ipk.length <= 0 ){
					alert('mohon lengkapi data pendidikan formal');
					return false;
				}
			},
			success : function( response ){
				if( response.status == 'success' ){
					alert( response.message );
					return false;
				}
			}
		});

		return false;

	});

});

function isNumber(evt) {
	    evt = (evt) ? evt : window.event;
	    var charCode = (evt.which) ? evt.which : evt.keyCode;
	    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	        return false;
	    }
	    return true;
};

function isFloat(evt) {
	    evt = (evt) ? evt : window.event;
	    var charCode = (evt.which) ? evt.which : evt.keyCode;
	    if (charCode > 31 && (charCode < 45 || (charCode == 47 && charCode == 48) || charCode > 57)) {
	        return false;
	    }
	    return true;
};