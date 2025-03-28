<style>
@media only screen and (max-width: 750px) {
    .label3 {
    margin-right:29rem;
  }
}

.content-div {
            display: none;
        }
</style>

<link href="<?php echo base_url(); ?>css/select2.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/sweetalert2.min.css">
<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->
<!--links are added for jquery calendar-->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>css/flora.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datepick.js"></script>
<div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 80px;"></div>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">    
    <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaAstController/index'?>">E-Khajana</a></li>
    <li class="breadcrumb-item font-weight-bold active" aria-current="page">Change Request</li>
  </ol>
</nav>
<div class="container-fluid form-top mb-5">
    <div class="row">
        <div class="col-lg-12 ">
            <form id="amdaniReportForm">
            <div class="col-lg-12 col-lg-offset-1">
                <div class="panel panel-info mt-3">
                    <div style="border:2px solid grey;" class="shadow-lg bg-white">   
                        <div class="panel-heading bg-dark text-center">
                            <h5 class="panel-title text-warning p-2">
                                Change Request Form For Mouza : <?=$mouza_name?>
                            </h5>
                        </div>
                        <div class="panel-heading bg-primary text-center" style="margin-top:-10px;">
                            <h5 class="panel-title text-white p-1">
                                District: <?=$district_name?>,
                                Sub-division: <?=$subdiv_name?>, 
                                Circle: <?=$circle_name?>
                            </h5>
                        </div> 
                        <input type="hidden" id="amdaniReportFormSubmitUrl" 
                            value="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/amdaniReport' ?>">
                        <!-- village-selection  -->
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            VILLAGE
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <select class="js-single js-states form-control" style="width: 85%" id="village_uuid" 
                                        onchange="villageOnChange()" name="village_uuid">
                                            <option value="00" selected>-ALL-VILLAGE-</option>  
                                            <?php foreach ($village_list as $village):?>
                                                <option value="<?=$village->uuid?>"><?=$village->loc_name?>(<?=$village->locname_eng?>)</option>
                                            <?php endforeach;?>     
                                        </select>
                                    </div>
                                </div>                    
                            </div>
                        </div>   
                        <!-- patta-type-selection  -->
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            PATTA TYPE
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <select class="js-single js-states form-control" style="width: 85%" onchange="getPattaNo()" 
                                        id="patta_type_code" name="patta_type_code">
                                            <option value="00" selected>-ALL-PATTA-TYPE-</option>
                                        </select>
                                    </div>
                                </div>                    
                            </div>
                        </div>  
                        <!-- patta-no-selection  -->
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            PATTA NO
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <select class="js-single js-states form-control" style="width: 85%"  onchange="getDagNo()" id="patta_numbers" name="patta_no">
                                            <option value="00" selected>-ALL-PATTA-NO-</option>
                                        </select>
                                    </div>
                                </div>                    
                            </div>
                        </div>

                        <!-- patta-no-selection  -->
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            DAG NO
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <select class="js-single js-states form-control" style="width: 85%" id="dag_nos" name="dag_nos">
                                            <option value="00" selected>-ALL-DAG-NO-</option>
                                        </select>
                                    </div>
                                </div>                    
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                        Choose a change request:
                                        </label>
                                    </div>
                                <div class="col-lg-4 text-left">
                                <select name="dropdown" id="dropdown" class="js-single js-states form-control" onchange="getDivs()">
                                    <option value="">--Select an option--</option>
                                    <option value="option1">Change of Land use</option>
                                    <option value="option2">Each Pattadar land share in ejmali Patta</option>
                                    <option value="option3">Option 3</option>
                                    <option value="option4">Option 4</option>
                                </select>
                                </div>
                        </div>
                        </div>
                        </div>

                        <div class="content-div" id="option1"><br>
                            <div class="col-lg-10 col-lg-offset-2">
                            <div class="panel casedisplay">                        
                            <div class="panel-body">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr class="bg-info" style="background: #17a2b8 !important;text-align:center">
                                        <th colspan="3" style="color:white">Land Class Update</th>
                                    </tr>
                                    </thead>
                                    <thead style="white-space:nowrap; width:100%">
                                    <tr>
                                        <th>Existing Land Class</th>
                                        <th>To be Land Class</th>

                                    </tr>
                                </thead>

                                    <tr>
                                        <td><span class="landclass"></span></td>
                                        <td>
                                            <div class="form-group sugested_land_class">
                                            <div class="col-sm-5">
                                                <select class="form-control" name="suggested_land_class" id="suggested_land_class">
                                                    <option selected disabled value=""><?php echo $this->lang->line('select_land_class'); ?></option>
                                                    <?php
                                                    foreach ($land_class as $lc) {
                                                        echo "<option value='$lc->class_code'>$lc->land_type</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        </div>
                        </div>


                        <div class="content-div" id="option2">
                            <div class="col-lg-10 col-lg-offset-2">
                            <div class="panel casedisplay">                        
                            <div class="panel-body">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr class="bg-info" style="background: #17a2b8 !important;text-align:center">
                                        <th colspan="6" style="color:white">Pattadar Land Share</th>
                                    </tr>
                                    </thead>
                                    <thead style="white-space:nowrap; width:100%">
                                    <tr style="text-align:center">
                                        <th>Click to<br>
                                        Edit</th>
                                        <th>Name of the <br>Pattadars of the Dag</th>
                                        <th>Father's Name</th>
                                        <th colspan="6">Land Share<br>(in B-K-L)</th>
                                    </tr>
                                </thead>

                                    <tbody id='pattadardetails'>
                               
                            </tbody>
                                </table>

                                <!-- <div class="card" id='selectpattadars' style="display:none;">
                        <div class="card-heading">
                        <h3 class="card-title">Select Pattadar for Partition</h3>
                        </div>
                        <br>
                        <div class="list-group" id="deleted_pattadar" style="height:300px;overflow:auto;">

                            
                        </div>
                    </div> -->
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="content-div" id="option3">This is content for Option 3</div>
                        <div class="content-div" id="option4">This is content for Option 4</div>



                
                        <!-- validation-errors-div -->
                        <div class="col-lg-12" id="ekAr_error_div" style="display:none;margin-top:1rem">
                            <div class="card-header h5 bg-danger text-white text-center">
                                VALIDATION ERRORS 
                            </div>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <strong class="text-center" style="color:red !important" id="ekAr_error_div_validation_error_msg">
                                </strong>
                            </div>
                        </div>
                        <!-- validation-error-div-end -->
                        <hr style="border-bottom: 2px solid #000;">
                        <div class="row">
                            <div class="col-lg-12 text-center mb-3">
                                <button type="submit" name="AMDANISubmit" class="btn btn-success" onclick="amdaniReportFormDetailsSubmit()"><i class='fa fa-check'></i>&nbsp;<?php echo $this->lang->line('submit_button'); ?></button>
                                <button type="reset" name="AMDANISu" class="btn btn-primary"><i class='fa fa-refresh'>&nbsp;</i><?php echo $this->lang->line('reset'); ?></button>
                                <a href="<?php echo base_url(); ?>index.php/home/index" class="btn btn-danger">
                                    <i class="fa fa-arrow-left"></i>&nbsp;<?php echo $this->lang->line('back_to_main_menu'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

<script src="<?php echo base_url('js/ekhajana/ekhajana_mouzadar_change_request.js'); ?>"></script>

<!-- <script>
    document.getElementById('dropdown').addEventListener('change', function() {
        // Hide all content divs
        var contentDivs = document.getElementsByClassName('content-div');
        for (var i = 0; i < contentDivs.length; i++) {
            contentDivs[i].style.display = 'none';
        }

        // Get the selected value from the dropdown
        var selectedOption = this.value;

        // Show the corresponding div
        if (selectedOption) {
            var selectedDiv = document.getElementById(selectedOption);
            if (selectedDiv) {
                selectedDiv.style.display = 'block';
            }
        }
    });
</script> -->

<script type="text/javascript">
    
    function toggleEditable(checkbox) {
    var row = checkbox.parentNode.parentNode;
    var inputs = row.querySelectorAll('input[type="text"]');
    inputs.forEach(function(input) {
        if (checkbox.checked) {
            input.removeAttribute('readonly');
        } else {
            input.setAttribute('readonly', true);
        }
    });
}
</script>