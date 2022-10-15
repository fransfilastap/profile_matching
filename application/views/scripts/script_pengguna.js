$(document).ready(function(){
	$("#table_pengguna").dataTable({
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
                    window.location.href = "<?php echo site_url('pengguna'); ?>";
                },800);
            });
        })
    });    
});