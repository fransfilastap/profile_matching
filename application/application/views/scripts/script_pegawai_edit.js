$(function(){

	var id_hapus 	 		= [];
	var id_hapus2			= [];
	var id_hapus3 			= [];

	var id_ubah		 		= [];
	var id_ubah2 			= [];
	var id_ubah3 			= [];

	var jenjang_lama 		= [];
	var institusi_lama 		= [];
	var jurusan_lama 		= [];
	var tahun_masuk_lama	= [];
	var tahun_keluar_lama 	= [];
	var ipk_lama    	 	= [];	

	var jenjang_baru 		= [];
	var institusi_baru 		= [];
	var jurusan_baru 		= [];
	var tahun_masuk_baru	= [];
	var tahun_keluar_baru 	= [];
	var ipk_baru    	 	= [];

	var nama_kursus_baru  = [];
	var tempat_baru 	  = [];
	var lamanya_baru 	  = [];
	var keterangan_baru   = [];

	var nama_kursus_lama  = [];
	var tempat_lama 	  = [];
	var lamanya_lama 	  = [];
	var keterangan_lama   = [];

	var jabatan_lama 	 = [];
	var wilayah_lama 	 = [];
	var dari_lama 		 = [];
	var sampai_lama 	 = [];
	var keterangan2_lama   = [];


	var jabatan_baru 	 = [];
	var wilayah_baru 	 = [];
	var dari_baru 		 = [];
	var sampai_baru 	 = [];
	var keterangan2_baru   = [];


	var clearData = function(){
		 id_ubah		 	= [];
		 jenjang_lama 		= [];
		 institusi_lama 	= [];
		 jurusan_lama 		= [];
		 tahun_masuk_lama	= [];
		 tahun_keluar_lama 	= [];
		 ipk_lama    	 	= [];	

		 jenjang_baru 		= [];
		 institusi_baru 	= [];
		 jurusan_baru 		= [];
		 tahun_masuk_baru	= [];
		 tahun_keluar_baru 	= [];
		 ipk_baru    	 	= [];

		 nama_kursus_lama	= [];
		 tempat_lama	 	= [];
		 lamanya_lama 		= [];
		 keterangan_lama 	= [];

		 nama_kursus_baru	= [];
		 tempat_baru	 	= [];
		 lamanya_baru 		= [];
		 keterangan_baru 	= [];


		 jabatan_lama 	 = [];
		 wilayah_lama 	 = [];
		 dari_lama 		 = [];
		 sampai_lama 	 = [];
		 keterangan2_lama   = [];


		 jabatan_baru 	 = [];
		 wilayah_baru 	 = [];
		 dari_baru 		 = [];
		 sampai_baru 	 = [];
		 keterangan2_baru   = [];	

		 id_hapus 	 		= [];
		 id_hapus2			= [];
		 id_hapus3 			= [];

		 id_ubah		 	= [];
		 id_ubah2 			= [];
		 id_ubah3 			= [];

	};

	var tambah_row = function (){

		var row = "<tr class='baru' data-id=''>"+
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

		var row = "<tr class='baru' data-id=''>"+
	                "<td><input type='text' name='nama_kursus' class='span12 m-wrap kursus' /></td>"+
	                "<td><input type='text' name='tempat' class='span12 m-wrap tempat' /></td>"+
	                "<td><input type='text' name='lama' class='span12 m-wrap lamanya' onkeypress='return isNumber(event)' /></td>"+	                              				
	                "<td><input type='text' name='ket' class='span12 m-wrap ket' /></td>"+
	                "<td><a href='#' id='hapusRow2' class='btn mini red'><i class='icon-trash'></i></a></td>"+	                              				
	           	"</tr>";

	    return row;
	}

	var tambah_row_riwayat = function(){

		var row = "<tr class='baru' data-id=''>"+
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

	$(document).on("focus",".date-picker",function(){
		$(this).datepicker({
			format : "yyyy-mm-dd"
		});
	});

	$("a#tambah_riwayat").click(function(evt){
		evt.preventDefault();
		$("table#riwayat_jabatan").append( tambah_row_riwayat() );
	});

	$(document).on('click','a#hapusRow2',function(evt){
		evt.preventDefault();
		var ub  = $(this).closest('tr').data('id');
		if( ub != "" ) id_hapus2.push( ub );
		$(this).closest('tr').slideUp('slow');
		$(this).closest('tr').remove();
	});

	$(document).on('click','a#hapusRow3',function(evt){
		evt.preventDefault();
		var ub  = $(this).closest('tr').data('id');
		if( ub != "" ) id_hapus3.push( ub );
		$(this).closest('tr').slideUp('slow');
		$(this).closest('tr').remove();
	});

	$(document).on('click','a#hapusRow',function(evt){
		evt.preventDefault();
		var ub  = $(this).closest('tr').data('id');
		if( ub != "" ) id_hapus.push( ub );
		$(this).closest('tr').slideUp('slow');
		$(this).closest('tr').remove();

	});

	$("form#editPegawai").submit(function(evt){
		
		evt.preventDefault();

		$("table#pendidikan > tbody tr.lama").each(function(){

			var tingkat = $(this).find('td:eq(0)').find('select.jenjang').val();
			var inst 	= $(this).find('td:eq(1)').find('input.institusi').val();
			var jur 	= $(this).find('td:eq(2)').find('input.jurusan').val();
			var tm 		= $(this).find('td:eq(3)').find('input.tahunmasuk').val();
			var tk 		= $(this).find('td:eq(4)').find('input.tahunkeluar').val();
			var nil 	= $(this).find('td:eq(5)').find('input.ipk').val();
			var ub 		= $(this).data('id');

			//id_pendidikan_yang_diubah

			if( tingkat != "" ) jenjang_lama.push( tingkat );
			if( inst != "" ) institusi_lama.push( inst );
			if( jur != "" ) jurusan_lama.push( jur );
			if( tm != "" ) tahun_masuk_lama.push( tm );
			if( tk != "" ) tahun_keluar_lama.push( tk );
			if( nil != "" ) ipk_lama.push( nil );
			if( ub != "" ) id_ubah.push( ub );

		});

		$("table#pendidikan > tbody tr.baru").each(function(){

			var tingkat = $(this).find('td:eq(0)').find('select.jenjang').val();
			var inst 	= $(this).find('td:eq(1)').find('input.institusi').val();
			var jur 	= $(this).find('td:eq(2)').find('input.jurusan').val();
			var tm 		= $(this).find('td:eq(3)').find('input.tahunmasuk').val();
			var tk 		= $(this).find('td:eq(4)').find('input.tahunkeluar').val();
			var nil 	= $(this).find('td:eq(5)').find('input.ipk').val();

			//id_pendidikan_yang_diubah

			if( tingkat != "" ) jenjang_baru.push( tingkat );
			if( inst != "" ) institusi_baru.push( inst );
			if( jur != "" ) jurusan_baru.push( jur );
			if( tm != "" ) tahun_masuk_baru.push( tm );
			if( tk != "" ) tahun_keluar_baru.push( tk );
			if( nil != "" ) ipk_baru.push( nil );

		});

		$("table#pendidikan_nonformal > tbody tr.lama").each(function(){

			var _name 	= $(this).find('td:eq(0)').find('input.kursus').val();
			var _tempat = $(this).find('td:eq(1)').find('input.tempat').val();
			var _lama 	= $(this).find('td:eq(2)').find('input.lamanya').val();
			var _ket 	= $(this).find('td:eq(3)').find('input.ket').val();			
			var ub 		= $(this).data('id');

			if( _name != "" ) nama_kursus_lama.push( _name );
			if( _tempat != "" ) tempat_lama.push( _tempat );
			if( _lama != "") lamanya_lama.push( _lama );
			if( _ket != "") keterangan_lama.push( _ket );
			if( ub != "" ) id_ubah2.push( ub );

		});

		$("table#pendidikan_nonformal > tbody tr.baru").each(function(){

			var _name 	= $(this).find('td:eq(0)').find('input.kursus').val();
			var _tempat = $(this).find('td:eq(1)').find('input.tempat').val();
			var _lama 	= $(this).find('td:eq(2)').find('input.lamanya').val();
			var _ket 	= $(this).find('td:eq(3)').find('input.ket').val();			

			if( _name != "" ) nama_kursus_baru.push( _name );
			if( _tempat != ""  ) tempat_baru.push( _tempat );
			if( _lama != "") lamanya_baru.push( _lama );
			if( _ket != "") keterangan_baru.push( _ket );

		});

		$("table#riwayat_jabatan > tbody tr.lama").each(function(){

			var _jl = $(this).find("td:eq(0)").find("input.jabatan").val();
			var _wl = $(this).find("td:eq(1)").find("input.wilayah").val();
			var _dl = $(this).find("td:eq(2)").find("input.dari").val();
			var _sl = _dl;
			var _kl = $(this).find("td:eq(4)").find("input.ket").val();
			var ub = $(this).data("id");

			if( _jl != "" ) jabatan_lama.push( _jl );
			if( _wl != "" ) wilayah_lama.push( _wl );
			if( _dl != "" ) dari_lama.push( _dl );
			if( _sl != "" ) sampai_lama.push( _sl );
			if( _kl != "" ) keterangan_lama.push( _kl );
			if( ub != "" ) id_ubah3.push(ub);


		});

		$("table#riwayat_jabatan > tbody tr.baru").each(function(){

			var _jb = $(this).find("td:eq(0)").find("input.jabatan").val();
			var _wb = $(this).find("td:eq(1)").find("input.wilayah").val();
			var _db = $(this).find("td:eq(2)").find("input.dari").val();
			var _sb = _db;
			var _kb = $(this).find("td:eq(4)").find("input.ket").val();

			if( _jb != "" ) jabatan_baru.push( _jb );
			if( _wb != "" ) wilayah_baru.push( _wb );
			if( _db != "" ) dari_baru.push( _db );
			if( _sb != "" ) sampai_baru.push( _sb );
			if( _kb != "" ) keterangan_baru.push( _kb );			

		});

		$.ajax({
			url 	: $(this).attr("action"),
			type	: $(this).attr("method"),
			dataType : 'JSON',
			data	: {
				'id_pegawai'		: $("input[name=kode_pegawai_hidden]").val(),
				'kode_pegawai' 		: $("input[name=kode_pegawai]").val(),
				'nama_pegawai'		: $("input[name=nama_pegawai]").val(),
				'alamat'			: $("textarea#alamat").val(),
				'tempat_lahir'		: $("input[name=tempat_lahir]").val(),
				'tanggal_lahir'		: $("input[name=tanggal_lahir]").val(),
				'diangkat_per'  	: $("input[name=diangkat_per]").val(),
				'password'			: $("input[name=passowrd]").val(),
				"jenis_kelamin"		: $("select[name=jenis_kelamin]").val(),
				
				'institusi_lama' 	: institusi_lama,
				'jenjang_lama' 		: jenjang_lama,
				'jurusan_lama'		: jurusan_lama,
				'tahun_masuk_lama'	: tahun_masuk_lama,
				'tahun_keluar_lama' : tahun_keluar_lama,
				'ipk_lama'			: ipk_lama,
				'institusi_baru'	: institusi_baru,
				'jenjang_baru'		: jenjang_baru,
				'jurusan_baru'		: jurusan_baru,
				'tahun_masuk_baru'	: tahun_masuk_baru,
				'tahun_keluar_baru' : tahun_keluar_baru,
				'ipk_baru'			: ipk_baru,
				'nama_kursus_baru'	: nama_kursus_baru,
				'tempat_baru'		: tempat_baru,
				'lamanya_baru'		: lamanya_baru,
				'keterangan_baru'	: keterangan_baru,

				'nama_kursus_lama'	: nama_kursus_lama,
				'tempat_lama'		: tempat_lama,
				'lamanya_lama'		: lamanya_lama,
				'keterangan_lama'	: keterangan_lama,
				'jabatan_lama'		: jabatan_lama,
				'wilayah_lama'		: wilayah_lama,
				'dari_lama'			: dari_lama,
				'sampai_lama'		: sampai_lama,
				'keterangan2_lama'	: keterangan2_lama,
				'jabatan_baru'		: jabatan_baru,
				'wilayah_baru'		: wilayah_baru,
				'dari_baru'			: dari_baru,
				'sampai_baru'		: sampai_baru,
				'keterangan2_baru'	: keterangan2_baru,
				'id_hapus'			: id_hapus,
				'id_hapus2'			: id_hapus2,
				'id_hapus3'			: id_hapus3,
				'id_ubah2'			: id_ubah2,
				'id_ubah'			: id_ubah,
				'id_ubah3'			: id_ubah3
			},
			beforeSend : function(){

			},
			success : function( response ){
				if( response.status != 'success' ){
					alert( response.message );
					return false;
				}else{
					alert( response.message );
					return false;
				}
			}
		});

		clearData();
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