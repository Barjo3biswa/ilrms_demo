<style>
    #all_patta_table {
        overflow-x: auto;
        max-height: 400px; /* Adjust as needed */
        overflow-y: auto;
    }

    #land_details_table th,
    #land_details_table td {
        min-width: 150px;
        word-wrap: break-word;
        white-space: normal; /* Allow text to wrap inside input fields */
    }

    #land_details_table input[readonly] {
        background-color: #f9f9f9; /* Optional: subtle background for readonly fields */
        border: none; /* Optional: remove border if desired */
    }

    #land_details_table td div {
        font-size: 14px;
        color: #333;
        word-wrap: break-word;
        white-space: normal;
    }
    
    .heading_first_color{
        background: linear-gradient(180deg, rgb(50 211 0 / 80%) 0%, rgb(131 255 0 / 84%) 88%, rgb(0 0 0 / 68%) 100%);
    }
    .heading_second_color{
        background: linear-gradient(180deg, rgba(7,78,163,0.7959558823529411) 0%, rgba(33,166,149,0.8239670868347339) 88%, rgba(3,101,96,0.6783088235294117) 100%);;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url('css/select2.min.css'); ?>">
<script src="<?php echo base_url('js/select2.min.js'); ?>"></script>
<input type="hidden" value="<?=base_url()?>" id="base_url" name="base_url">
<div class="container-fluid form-top login mt-5">
    <div class="col-lg-10 offset-1">
        <div class="panel mt-5 shadow-lg">
            <div class="panel-body">
                <h5 class="heading_first_color p-2 text-dark shadow mt-2 text-center" style="margin-bottom:0px!important;">
                    e-Khazna Patta Online Registration/Payment Status
                </h5>
                <h6 class="heading_second_color p-2 text-white shadow text-center">
                    <?php echo $this->lang->line('district')?>: <?= $district_name?>,
                    <?php echo $this->lang->line('subdivision')?>: <?= $subdiv_name?>,
                    <?php echo $this->lang->line('circle')?>: <?= $circle_name?>,
                    Mouza: <?= $mouza_name?>
                </h6>
                <div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 150px;"></div>
                <input type="hidden" value="<?=$dist_code?>" id="dist_code" name="dist_code">
                <input type="hidden" value="<?=$subdiv_code?>" id="subdiv_code" name="subdiv_code">
                <input type="hidden" value="<?=$cir_code?>" id="cir_code" name="cir_code">
                <input type="hidden" value="<?=$mouza_pargona_code?>" id="mouza_pargona_code" name="mouza_pargona_code">
                <input type="hidden" value="<?=$mouza_name?>" id="mouza_name" name="mouza_name">
                <div class="p-3">
                    <div class="row">
                        <div class="col-3">
                            <label style="font-weight:bold;">SELECT LOT NO<span class="text-danger">*</span></label>
                            <select class="js-single js-states form-control" id="lot_no" required name="lot_no" onchange="lotOnChange()">
                                <option disabled selected>--LOT-NAME--</option>
                                <?php foreach ($lot_list as $lot):?>
                                    <option value="<?=$lot->lot_no?>"><?=$lot->loc_name?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-3">
                            <label style="font-weight:bold;">SELECT VILLAGE<span class="text-danger">*</span></label>
                            <select class="js-single js-states form-control" id="village" required name="village" onchange="VillageOnChange()">
                                <option value="00" selected>--VILLAGE--</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label style="font-weight:bold;">SELECT PATTA TYPE<span class="text-danger">*</span></label>
                            <select class="js-single js-states form-control" id="patta_type_code" required name="patta_type_code" onchange="PattaTypeOnChange()">
                                <option value="00" selected>--PATTA-TYPE--</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label style="font-weight:bold;">SELECT PATTA NUMBER<span class="text-danger">*</span></label>
                            <select class="js-single js-states form-control" id="patta_no" required name="patta_no">
                                <option value="00" selected>--PATTA-NUMBER--</option>
                            </select>
                        </div>  
                    </div>
                </div>
                <center>
                    <div class="mt-3" id="add_more_buuton">
                        <button type="button" class="btn btn-success btn-sm" onclick="submitPattaDetails()"><i class="fa fa-check"></i> SUBMIT</button>
                    </div>                        
                </center>
            </div>
            <hr>
        </div>
        <div id="patta_details_view_div">
            <!-- results will be viewed here  -->
        </div>
    </div>
</div>
<script>
    var baseurl = $('#base_url').val();

    $(document).ready(function() {
        $('.js-single').select2();
    });

    function lotOnChange() {
        $('#patta_details_view_div').empty().hide(); // Clear and hide the div

        $.blockUI({
            message: $('#displayBoxEK'),
            css: {
                border: 'none',
                backgroundColor: 'transparent'
            }
        });

        $('#village').empty();
        $('#village').append('<option value="00" selected>-VILLAGE-</option>');

        var dist_code = $('#dist_code').val();
        var subdiv_code = $('#subdiv_code').val();
        var cir_code = $('#cir_code').val();
        var mouza_pargona_code = $('#mouza_pargona_code').val();
        var lot_no = $('#lot_no').val();

        if (!validateSelection(dist_code, 'District')) return;
        if (!validateSelection(subdiv_code, 'Subdivision')) return;
        if (!validateSelection(cir_code, 'Circle')) return;
        if (!validateSelection(mouza_pargona_code, 'Mouza')) return;
        if (!validateSelection(lot_no, 'Lot')) return;

        const application = {
            dist_code: dist_code,
            subdiv_code: subdiv_code,
            cir_code: cir_code,
            mouza_pargona_code: mouza_pargona_code,
            lot_no: lot_no,
        };

        $.ajax({
            url: baseurl + "/EkhajanaMouzadarCfr/getVillageList",
            type: 'POST',
            data: JSON.stringify(application),
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                $.unblockUI();
                console.log(data);
                for (var i = 0; i < data.length; i++) {
                    $('#village').append('<option value="' + data[i].vill_townprt_code + '">' + data[i].loc_name + '</option>');
                }
            },
            error: function (jqXHR, exception) {
                $.unblockUI();
                alert('Could not complete your request. Please try again later.');
            }
        });
    }

    function VillageOnChange() {
        $('#patta_details_view_div').empty().hide(); // Clear and hide the div

        $.blockUI({
            message: $('#displayBoxEK'),
            css: {
                border: 'none',
                backgroundColor: 'transparent'
            }
        });

        $('#patta_type_code').empty();
        $('#patta_type_code').append('<option value="00" selected>-PATTA-TYPE-</option>');

        var village = $('#village').val();
        if (!validateSelection(village, 'Village')) return;

        const application = {};

        $.ajax({
            url: baseurl + "/EkhajanaMouzadarCfr/getPattaTypes",
            type: 'POST',
            data: JSON.stringify(application),
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                $.unblockUI();
                console.log(data);
                for (var i = 0; i < data.length; i++) {
                    $('#patta_type_code').append('<option value="' + data[i].type_code + '">' + data[i].patta_type + '</option>');
                }
            },
            error: function (jqXHR, exception) {
                $.unblockUI();
                alert('Could not complete your request. Please try again later.');
            }
        });
    }

    function PattaTypeOnChange() {
        $('#patta_details_view_div').empty().hide(); // Clear and hide the div

        $.blockUI({
            message: $('#displayBoxEK'),
            css: {
                border: 'none',
                backgroundColor: 'transparent'
            }
        });

        $('#patta_no').empty();
        $('#patta_no').append('<option value="00" selected>-PATTA-NUMBER-</option>');

        var dist_code = $('#dist_code').val();
        var subdiv_code = $('#subdiv_code').val();
        var cir_code = $('#cir_code').val();
        var mouza_pargona_code = $('#mouza_pargona_code').val();
        var lot_no = $('#lot_no').val();
        var vill_townprt_code = $('#village').val();

        if (!validateSelection(dist_code, 'District') || 
            !validateSelection(subdiv_code, 'Subdivision') || 
            !validateSelection(cir_code, 'Circle') || 
            !validateSelection(mouza_pargona_code, 'Mouza') || 
            !validateSelection(lot_no, 'Lot') || 
            !validateSelection(vill_townprt_code, 'Village')) return;

        const application = {
            dist_code: dist_code,
            subdiv_code: subdiv_code,
            cir_code: cir_code,
            mouza_pargona_code: mouza_pargona_code,
            lot_no: lot_no,
            vill_townprt_code: vill_townprt_code
        };

        $.ajax({
            url: baseurl + "/EkhajanaMouzadarCfr/allPattaNumbers",
            type: 'POST',
            data: JSON.stringify(application),
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                $.unblockUI();
                console.log(data);
                for (var i = 0; i < data.length; i++) {
                    $('#patta_no').append('<option value="' + data[i].patta_no + '">' + data[i].patta_no + '</option>');
                }
            },
            error: function (jqXHR, exception) {
                $.unblockUI();
                alert('Could not complete your request. Please try again later.');
            }
        });
    }


    function submitPattaDetails() {
        $.blockUI({
            message: $('#displayBoxEK'),
            css: {
                border: 'none',
                backgroundColor: 'transparent'
            }
        });
        var dist_code = $('#dist_code').val();
        var subdiv_code = $('#subdiv_code').val();
        var cir_code = $('#cir_code').val();
        var mouza_pargona_code = $('#mouza_pargona_code').val();
        var lot_no = $('#lot_no').val();
        var vill_townprt_code = $('#village').val();
        var patta_type_code = $('#patta_type_code').val();
        var patta_no = $('#patta_no').val();

        if (!validateSelection(dist_code, 'District') ||
            !validateSelection(subdiv_code, 'Subdivision') ||
            !validateSelection(cir_code, 'Circle') ||
            !validateSelection(mouza_pargona_code, 'Mouza') ||
            !validateSelection(lot_no, 'Lot') ||
            !validateSelection(vill_townprt_code, 'Village') ||
            !validateSelection(patta_type_code, 'Patta Type') ||
            !validateSelection(patta_no, 'Patta Number')) return;

        const application = {
            dist_code: dist_code,
            subdiv_code: subdiv_code,
            cir_code: cir_code,
            mouza_pargona_code: mouza_pargona_code,
            lot_no: lot_no,
            vill_townprt_code: vill_townprt_code,
            patta_type_code: patta_type_code,
            patta_no: patta_no
        };

        //alert('Form Submitted Successfully:\n' + JSON.stringify(application, null, 4));
        //console.log(application);
        $.ajax({
            url: baseurl + "/EkhajanaPatta/getPattaApplyDetails",
            type: 'POST',
            data: JSON.stringify(application),
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                $.unblockUI();
                console.log("Received data:", data);

                // Check if data is non-empty
                if (data.trim() === "") {
                    alert("No content received from the server.");
                    return;
                }

                // Append the received HTML to the target div
                $('#patta_details_view_div').html(data);
                $('#patta_details_view_div').show(200);
            },
            error: function (jqXHR, exception) {
                $.unblockUI();
                alert('Could not complete your request. Please try again later.');
            }
        });
    }

    function validateSelection(value, fieldName) {
        if (value === '00' || value === '') {
            $.unblockUI();
            alert(`Please select a valid ${fieldName}.`);
            return false;
        }
        return true;
    }

</script>