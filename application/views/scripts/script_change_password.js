$(document).ready(function(){

	$("form#ubahPassword").bind("submit",function(){

		$.ajax({
			url 	: $(this).attr("action"),
			type	: $(this).attr("method"),
			dataType : 'JSON',
			data : $(this).serialize(),
			beforeSend : function(){
				var allowed = true;
				if( $("input[name=password_lama]").val() == "" ){
					$("input[name=password_lama]").next("span.help-inline").html("Harap Isi");
					allowed = false;
				}
				if( $("input[name=password_baru]").val() == "" ){
					$("input[name=password_baru]").next("span.help-inline").html("Harap Isi");
					allowed = false;
				}	

				return allowed;
			},
			success : function( response ){
				alert( response.message );
				if( response.status == "success" )
					window.location.href = "<?php echo site_url('login'); ?>";
				return false;
			}
		});

		return false;	

	});
})