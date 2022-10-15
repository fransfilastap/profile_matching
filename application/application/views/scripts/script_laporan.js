$(function(){
    $("#heh").hide();
	$("#table_history").dataTable({
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

    $("#truncate").click(function(evt){
        evt.preventDefault();
        var url   = $(this).attr('href');
        $("#truncateModal").modal('show');
        $("#btn-ya").click(function(evtx){
            evtx.preventDefault();
            $("#heh").fadeIn("fast");
            $.get(url,function(data){
            
                if( data.status = 'success' ){
                    $("#truncateModal").modal("hide");
                    setInterval(function(){
                    },400);
                     $("#OkModal").modal("show");
                }

            },'JSON');
        });

        $("#btn_ok").click(function(evt){
            evt.preventDefault();
            $("#OkModal").modal("hide");
            setInterval(function(){
            },100);
            window.location.href = "<?php site_url('laporan') ?>";
        });

    });
});