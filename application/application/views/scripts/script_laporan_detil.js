$(document).ready(function(){

	$(".hasil").dataTable({
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


        var chart_data = <?php echo $data_chart; ?>;

        $.plot("#chart_hasil", [ chart_data ], {
            series: {
                    bars: {
                            show: true,
                            barWidth: 0.3,
                            align: "center",
                            lineWidth: 0,
                            fill:.75
                        }
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            }
        });
	

});