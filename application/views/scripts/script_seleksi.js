$(document).ready(function(){

    $("#result_yes").hide();

	var jabatan;
	var kandidat = [];
    var analisis_id = 0;


    $("input[name=CF], input[name=SF]").keypress(function(evt){

        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;

    });

        if (!jQuery().bootstrapWizard) {
            return;
        }

        $('#seleksi_mutasi').bootstrapWizard({
            'nextSelector': '.button-next',
            'previousSelector': '.button-previous',
            onTabClick: function (tab, navigation, index) {
                alert('on tab click disabled');
                return false;
            },
            onNext: function (tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#seleksi_mutasi')).text('Tahap ' + (index + 1) + ' dari ' + total);
                // set done steps
                jQuery('li', $('#seleksi_mutasi')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if( current == 2 ){
                    var id_profilx = $("input[name=optionsRadios]:checked").val();
                    var url_x      = "<?php echo site_url('profil_mutasi/kandidat_ajax') ?>"+"/"+id_profilx;
                    $.get(url_x,function(response){
                        $("#qualified_candidate").html( response );
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
                    });

                }

                if (current == 1) {
                    $('#seleksi_mutasi').find('.button-previous').hide();
                } else {
                    $('#seleksi_mutasi').find('.button-previous').show();
                }

                if( current == 3 ){
                    $('#seleksi_mutasi').find('.button-next').click(function(evt){
                        evt.preventDefault();
                        $("#progress").show();
                        $("#progress").html("<img src='<?php echo base_url('assets/img/ajax-loader.gif'); ?>' /> <i>Analyzing...</i>");
                    
                        get_analisis_value();

                    });
                }

                if (current >= total) {
                    $('#seleksi_mutasi').find('.button-next').hide();
                    $('#seleksi_mutasi').find('.button-submit').hide();
                } else {
                    $('#seleksi_mutasi').find('.button-next').show();
                    $('#seleksi_mutasi').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            },
            onPrevious: function (tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#seleksi_mutasi')).text('Tahap ' + (index + 1) + ' dari ' + total);
                // set done steps
                jQuery('li', $('#seleksi_mutasi')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#seleksi_mutasi').find('.button-previous').hide();
                } else {
                    $('#seleksi_mutasi').find('.button-previous').show();
                }


                if (current >= total) {
                    $('#seleksi_mutasi').find('.button-next').hide();
                    $('#seleksi_mutasi').find('.button-submit').show();
                } else {
                    $('#seleksi_mutasi').find('.button-next').show();
                    $('#seleksi_mutasi').find('.button-submit').hide();
                }

                App.scrollTo($('.page-title'));
            },
            onTabShow: function (tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                var $percent = (current / total) * 100;
                $('#seleksi_mutasi').find('.bar').css({
                    width: $percent + '%'
                });
            }
        });

        $('#seleksi_mutasi').find('.button-previous').hide();
        $('#seleksi_mutasi .button-submit').hide();


	$("#analysis_result").hide();

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
    


    var get_analisis_value = function(){

        var CF = 0;
        var SF = 0;
        var candidats        = [];
        var selected_profile = 0;
        var persentase_aspek = {};

        $("#table_pegawai .checkboxes").each(function () {
            if( $(this).is(':checked') ){
                candidats.push( $(this).val() );
            }
        });


        selected_profile = $("input[name=optionsRadios]:checked").val();
        console.log( selected_profile );

        CF = $("input[name=CF]").val();
        SF = $("input[name=SF]").val();

        $("input.aspek").each(function (){
            persentase_aspek[this.name] = this.value;
        });


        $.ajax({
            url     : "<?php echo site_url('penilaian/profile_matching') ?>",
            type    : 'POST',
            dataType : 'JSON',
            data    : {
                "peserta" : candidats,
                "jabatan" : selected_profile,
                "CF"      : CF,
                "SF"      : SF,
                'persentase_aspek' : persentase_aspek
            },
            success : function( response ){

                if( response.status == "success" ){
                    $("#progress").html("<img src='<?php echo base_url('assets/img/ajax-loader.gif'); ?>' /> <i>Preparing for presentation...</i>");
                    
                    $.ajax({
                        url : "<?php echo site_url('penilaian/getResult/') ?>"+"/"+response.id,
                        type : "GET",
                        dataType : "text",
                        success : function( hasil ){
                            analisis_id = response.id;
                            $("#progress").slideUp("slow");
                            $("#result_yes").html( hasil );
                            $("#result_yes").fadeIn("slow");
                            $('#seleksi_mutasi').find('.button-submit').show();

                            $.post("<?php echo site_url('penilaian/datagrafik') ?>",{"id":response.id},function(data){

                                var chart_data = data;

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

                            },"json");

                            $("#seleksi_mutasi .button-submit").click(function(evt){
                                var url_to_save_this = $(this).attr("href");
                                $.post( url_to_save_this,{"id":analisis_id},function ( result ){
                                    
                                },"json" )
                            });
                        }
                    });

                }else{
                    $("#progress").slideUp("fast");
                    $("#progress").html( response.message );
                }

            }
        });

    }

});
