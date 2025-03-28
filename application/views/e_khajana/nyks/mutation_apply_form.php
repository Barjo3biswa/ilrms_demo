<style>
    .small-font{
        font-size:10px;
    }
</style>
<?php $categories = json_decode(EKHAJANA_VOLUNTEER_CATEGORIES)?>
<div class="container">
    <div class="row">
    <link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
    <script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
        <div class="col-md-1"></div>
        <div class="col-md-10 p-4 mt-5" style="border:1px solid orange">
        <div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 80px;"></div>
            <u><h4 class="text-center mt-3 mb-5">**FEEDBACK BY NYKS VOLUNTEER**</h4></u>
            <form id="volunteer_mutation_data">
                <!-- location fetching of mouzadar starts-->
                <div class="row">
                    <input type="hidden" value="<?=$dist_code?>" name="dist_code" id="dist_code">
                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example" id="subdiv_code" name="subdiv_code"  onchange="subdiv_on_change()">
                            <option selected>SELECT SUBDIVISION</option>
                            <?php foreach ($subdivisions as $key => $subdiv) { ?>
                                <option value="<?php echo $subdiv->subdiv_code; ?>"><?php echo $subdiv->loc_name; ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example" onchange="circle_on_change()" id="cir_code" name="cir_code">
                            <option value="00" selected>SELECT CIRCLE</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example" onchange="mouza_on_change()" id="mouza_pargona_code" name="mouza_pargona_code">
                            <option value="00" selected>SELECT MOUZA</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example" id="village" name="village">
                            <option value="00" selected>SELECT VILLAGE</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" id="patta_type" name="patta_type" onchange="on_patta_type_change()">
                            <option value="00" selected>SELECT PATTA TYPE</option>
                            <?php foreach ($patta_types as $key => $patta_type) { ?>
                                <option value="<?php echo $patta_type->type_code; ?>"><?php echo $patta_type->patta_type; ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" id="patta_no" name="patta_no" onchange="on_patta_no_change()">
                            <option value="00" selected>SELECT PATTA NO</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" id="pattadar" name="pattadar">
                            <option value="00" selected>SELECT PATTADAR</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label>
                            Select Categories
                        </label>
                        <select class="form-select" aria-label="Default select example" id="category" name="category">
                            <option value="00" selected>SELECT CATEGORY</option>
                            <?php foreach ($categories as $key => $cat) { ?>
                                <option value="<?php echo $cat->E_CODE; ?>"><?php echo $cat->NAME; ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>
                            Enter Reasons/Remarks
                        </label>
                        <textarea class="form-control" id="remark" name="remark" rows="1" placeholder="ENTER REMARKS/REASON" cols="60"></textarea>
                    </div>
                </div>

                <!-- location fetching of mouzadar ends -->
                <!-- bank details fetching starts -->
                <center>
                    <button type="button" class="btn btn-success mt-5" onclick="submit_all_details()"><i class="fa-solid fa-plus"></i> SUBMIT</button>
                </center>
            </form>
        </div>
        <!-- validation-errors-div -->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="text-align:center">
                <div class="col-lg-12" id="error_div" style="display:none;">
                    <div class="card-header h5 bg-danger text-white text-center">
                        VALIDATION ERRORS
                    </div>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <strong class="text-center" style="color:red !important"
                            id="error_msg">
                        </strong>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- validation-error-div-end -->
        <div class="col-md-2"></div>
    </div>
</div>
<script>
    baseurl ='<?=base_url()?>'
    // baseurl ='https://basundhara.assam.gov.in/ilrms/'
    function showSuccessMessage(text) {
        swal.fire({
            title: "Success !",
            text: text,
            icon: 'success',
            position: 'top',
            showConfirmButton: true,
            timer: 5000,
        });
    }

    function showErrorMessage(text) {
        swal.fire({
            title: "Error!",
            text: text,
            icon: 'error',
            position: 'top',
            timer: 5000,
            showCancelButton: true
        });
    }

    function subdiv_on_change()
    {
        $('#cir_code').empty();
        $('#cir_code').append('<option value="00" selected>-SELECT CIRCLE-</option>');
        var dist_code = $('#dist_code').val();
        var subdiv_code = $('#subdiv_code').val();
        if(subdiv_code == '00'){
            alert("Please select a Subdivision...!!");
            return;
        }
        const application = {
                dist_code    : dist_code,            
                subdiv_code  : subdiv_code,            
            };
        $.ajax({ 
            url: baseurl + "/Nyks/getCircleName",
            type: 'POST',
            data: JSON.stringify(application),
            cache : false,
            processData: false,
            dataType: 'json',
            success: function (data) { 
                console.log(data);     
                for(var i=0; i<data.length; i++) {
                    $('#cir_code').append('<option value="'+data[i].cir_code+'">('+ data[i].loc_name+')</option>');
                }
            },
            error: function (jqXHR, exception) {
                alert('Could not Complete your Request ..!, Please Try Again later..!');
            }  
        });
    }

    function circle_on_change()
    {
        $('#mouza_pargona_code').empty();
        $('#mouza_pargona_code').append('<option value="00" selected>-SELECT MOUZA-</option>');
        var dist_code = $('#dist_code').val();
        var subdiv_code = $('#subdiv_code').val();
        var cir_code = $('#cir_code').val();
        if(subdiv_code == '00'){
            alert("Please select a Subdivision...!!");
            return;
        }
        if(cir_code == '00'){
            alert("Please select a Circle...!!");
            return;
        }
        const application = {
                dist_code    : dist_code,            
                subdiv_code  : subdiv_code,            
                cir_code     : cir_code,            
            };
        $.ajax({ 
            url: baseurl + "/Nyks/getAllMouzas",
            type: 'POST',
            data: JSON.stringify(application),
            cache : false,
            processData: false,
            dataType: 'json',
            success: function (data) { 
                console.log(data);     
                for(var i=0; i<data.length; i++) {
                    $('#mouza_pargona_code').append('<option value="'+data[i].mouza_pargona_code+'">('+ data[i].loc_name+')</option>');
                }
            },
            error: function (jqXHR, exception) {
                alert('Could not Complete your Request ..!, Please Try Again later..!');
            }  
        });
    }

    function mouza_on_change()
    {
        $('#village').empty();
        $('#village').append('<option value="00" selected>-SELECT VILLAGE-</option>');
        var dist_code = $('#dist_code').val();
        var subdiv_code = $('#subdiv_code').val();
        var cir_code = $('#cir_code').val();
        var mouza_pargona_code = $('#mouza_pargona_code').val();
        if(subdiv_code == '00'){
            alert("Please select a Subdivision...!!");
            return;
        }
        if(cir_code == '00'){
            alert("Please select a Circle...!!");
            return;
        }
        if(mouza_pargona_code == '00'){
            alert("Please select a Mouza...!!");
            return;
        }
        const application = {
                dist_code    : dist_code,            
                subdiv_code  : subdiv_code,            
                cir_code     : cir_code,            
                mouza_pargona_code     : mouza_pargona_code,            
            };
        $.ajax({ 
            url: baseurl + "/Nyks/getAllVillages",
            type: 'POST',
            data: JSON.stringify(application),
            cache : false,
            processData: false,
            dataType: 'json',
            success: function (data) { 
                console.log(data);     
                for(var i=0; i<data.length; i++) {
                    $('#village').append('<option value="'+data[i].lot_no+'_'+data[i].vill_townprt_code+'">('+ data[i].loc_name+')</option>');
                }
            },
            error: function (jqXHR, exception) {
                alert('Could not Complete your Request ..!, Please Try Again later..!');
            }  
        });
    }

    function on_patta_type_change()
    {
        $('#patta_no').empty();
        $('#patta_no').append('<option value="00" selected>-SELECT PATTA NO-</option>');
        var dist_code = $('#dist_code').val();
        var subdiv_code = $('#subdiv_code').val();
        var cir_code = $('#cir_code').val();
        var mouza_pargona_code = $('#mouza_pargona_code').val();
        var village = $('#village').val();
        var patta_type_code = $('#patta_type').val();
        var explodedString = village.split("_");
        lot_no = explodedString[0];
        vill_townprt_code =explodedString[1];
        const application = {
                dist_code    : dist_code,            
                subdiv_code  : subdiv_code,            
                cir_code     : cir_code,            
                mouza_pargona_code     : mouza_pargona_code,            
                lot_no     : lot_no,            
                vill_townprt_code     : vill_townprt_code,            
                patta_type     : patta_type_code,            
            };
        $.ajax({ 
            url: baseurl + "/Nyks/getAllPattas",
            type: 'POST',
            data: JSON.stringify(application),
            cache : false,
            processData: false,
            dataType: 'json',
            success: function (data) { 
                console.log(data);     
                for(var i=0; i<data.length; i++) {
                    $('#patta_no').append('<option value="'+data[i].patta_no+'">'+ data[i].patta_no+'</option>');
                }
            },
            error: function (jqXHR, exception) {
                alert('Could not Complete your Request ..!, Please Try Again later..!');
            }  
        });
        
    }


    function on_patta_no_change()
    {
        $('#pattadar').empty();
        $('#pattadar').append('<option value="00" selected>-SELECT PATTADAR-</option>');
        var dist_code = $('#dist_code').val();
        var subdiv_code = $('#subdiv_code').val();
        var cir_code = $('#cir_code').val();
        var mouza_pargona_code = $('#mouza_pargona_code').val();
        var village = $('#village').val();
        var patta_type_code = $('#patta_type').val();
        var patta_no = $('#patta_no').val();
        var explodedString = village.split("_");
        lot_no = explodedString[0];
        vill_townprt_code =explodedString[1];
        const application = {
                dist_code    : dist_code,            
                subdiv_code  : subdiv_code,            
                cir_code     : cir_code,            
                mouza_pargona_code     : mouza_pargona_code,            
                lot_no     : lot_no,            
                vill_townprt_code     : vill_townprt_code,            
                patta_type     : patta_type_code,            
                patta_no     : patta_no,            
            };
        $.ajax({ 
            url: baseurl + "/Nyks/getAllPattadars",
            type: 'POST',
            data: JSON.stringify(application),
            cache : false,
            processData: false,
            dataType: 'json',
            success: function (data) { 
                console.log(data);     
                for(var i=0; i<data.length; i++) {
                    $('#pattadar').append('<option value="'+data[i].pdar_id+'_'+data[i].pdar_name+'_'+data[i].pdar_father+'">'+ data[i].pdar_name+'</option>');
                }
            },
            error: function (jqXHR, exception) {
                alert('Could not Complete your Request ..!, Please Try Again later..!');
            }  
        });
        
    }

    function submit_all_details()
    {
        event.preventDefault();
        var formdata = $('#volunteer_mutation_data').serialize();
        $('#error_msg').empty();
        $('#error_div').hide();
        $.ajax({
            url: baseurl + "/Nyks/submitProposedMutation",
            type: 'POST',
            data:  formdata ,
       
        dataType: 'json',
        beforeSend: function () {
            $.blockUI({
                message: $('#displayBox'),
                css: {
                    border:'none',
                    backgroundColor:'transparent'
                }
            });
        },
        success: function (data) {
            $.unblockUI();
            //validation_error_handle
            if(data.result == 'validation_error'){
                alert("Validation-Error, Please Submit the form correctly!");
                $('#ek_arrear_pre_updation_validation_error_div').show();
                for (let i = 0; i < data.msg.length; i++) {
                    $('#ek_arrear_pre_updation_validation_error_msg').append(data.msg[i]);
                }
                return;
            }else if(data.result == 'SERVER-ERROR'){
                $.unblockUI();
                alert(data.msg);
                return;
            }else if(data.result == "SUCCESS"){
                $.unblockUI();
                Swal.fire({
                    title: 'All data Saved Successfully!!!',
                    icon: 'success',
                    confirmButtonColor: '#3085D6',
                    confirmButtonText: 'Home'
                }).then((result) => {
                if (result.isConfirmed) {
                        window.location = baseurl + "/Nyks/MutiApply";
                    }
                })
                return;
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }
    });
    }

</script>

