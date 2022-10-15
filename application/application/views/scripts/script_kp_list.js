$(document).ready(function(){
	$(".profil").dataTable({
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
});


$(function(){

    var kriteria        = <?php echo json_encode($tables); ?>;
    var pegawai         = [];
    var subkriteria     = [];
    var nilai           = [];
    var postData        = [];
    var success = "<div class='alert alert-success'>"+
                        "<button class='close' data-dismiss='alert'></button>"+
                            "<strong>Success!</strong> <span></span>"+
                        "</div>";
    var failed = "<div class='alert alert-error'>"+
                        "<button class='close' data-dismiss='alert'></button>"+
                            "<strong>Error!</strong> <span></span>"+
                        "</div>";

    $("a.proses").click(function (evt){

        evt.preventDefault();

        $("#ajax_loader").html("<img src='<?php echo base_url('assets/img/ajax-loader.gif'); ?>' />");

        for (var i = 0 ; i < kriteria.length; i++) {
            
            var row = [];

            $("table#kriteria"+kriteria[i]+" > tbody tr").each(function (index1, value1){

                var pegawai = { 'idPegawai' : $(this).data('id'),'subs' : [] };

                $('td', this).each(function (index2, value2) {
                    if( index2 != 0 ){
                        var sub_value = { 'subId' : $(this).data('id'), 'subValue' : $(this).find('select.nilai').val() };
                        pegawai.subs.push( sub_value );
                    }
                 });

                row.push( pegawai );
            });

            postData.push( row );
        };


        $.ajax({
            url      : $(this).attr("href"),
            type     : 'POST',
            dataType : 'JSON',
            data     : {'form_nilai': postData},
            success  : function(response){
                
                if( response.status != 'success' ){
                    $(failed).find('span').html(response.message);
                    $("#ajax_loader").html( $(failed) );
                }else{
                    $(success).find('span').html(response.message);
                    $("#ajax_loader").html( $(success) );                    
                }

            }
        });
        //reset
        postData = [];
    });

});

