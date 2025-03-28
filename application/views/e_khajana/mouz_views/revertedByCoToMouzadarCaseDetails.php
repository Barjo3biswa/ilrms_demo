<style>
    .card {
        margin-bottom: 0px;
    }
</style>
<link href="<?php echo base_url(); ?>css/select2.css" rel="stylesheet"/>
<script src="<?php echo base_url(); ?>application/views/js/select2/select2.js"></script>
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
        <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/index'?>">E-Khajana</a></li>
        <li class="breadcrumb-item font-weight-bold">
            <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/pendingList'?>">
                E-Khajana-(Reverted List)
            </a>
        </li>
         <li class="breadcrumb-item font-weight-bold active" aria-current="page">E-Khajana-(Reverted By Circle Officer To Mouzadar)</li>
    </ol>
</nav>
<form id="mouzadar_form">          
    <!-- Application Details -->
    <input type="hidden" name="application_no" id="application_no" value="<?=$revertedCasesDetails->application_no?>">
    <input type="hidden" name="ld_application_no" id="ld_application_no" value="<?=$revertedCasesDetails->ld_application_no?>">
    <input type="hidden" name="case_no" id="case_no" value="<?=$revertedCasesDetails->case_no?>">
    <!-- location details -->
    <input type="hidden" name="dist_code" id="dist_code" value="<?=$revertedCasesDetails->dist_code?>">
    <input type="hidden" name="subdiv_code" id="subdiv_code" value="<?=$revertedCasesDetails->subdiv_code?>">
    <input type="hidden" name="cir_code" id="cir_code" value="<?=$revertedCasesDetails->cir_code?>">
    <input type="hidden" name="mouza_pargona_code" id="mouza_pargona_code" value="<?=$revertedCasesDetails->mouza_pargona_code?>">
    <input type="hidden" name="lot_no" id="lot_no" value="<?=$revertedCasesDetails->lot_no?>">
    <input type="hidden" name="vill_townprt_code" id="vill_townprt_code" value="<?=$revertedCasesDetails->vill_townprt_code?>">
    <input type="hidden" name="is_urban" id="is_urban" value="<?=$revertedCasesDetails->is_urban?>">
    <!-- patta details -->
    <input type="hidden" name="patta_type" id="patta_type" value="<?=$revertedCasesDetails->patta_type?>">
    <input type="hidden" name="patta_type_code" id="patta_type_code" value="<?=$revertedCasesDetails->patta_type_code?>">
    <input type="hidden" name="pdar_id" id="pdar_id" value="<?=$revertedCasesDetails->pdar_id?>">
    <input type="hidden" name="pdar_name" id="pdar_name" value="<?=$revertedCasesDetails->pdar_name?>">
    <input type="hidden" name="pdar_father_name" id="pdar_father_name" value="<?=$revertedCasesDetails->pdar_father_name?>">
    <input type="hidden" name="patta_no" id="patta_no" value="<?=$revertedCasesDetails->patta_no?>">
    <!-- applicant details -->
    <input type="hidden" name="applicant_name_eng" id="applicant_name_eng" value="<?=$revertedCasesDetails->applicant_name_eng?>">
    <input type="hidden" name="applicant_name_asm" id="applicant_name_asm" value="<?=$revertedCasesDetails->applicant_name_asm?>">
    <input type="hidden" name="guardian_name_eng" id="guardian_name_eng" value="<?=$revertedCasesDetails->guardian_name_eng?>">
    <input type="hidden" name="guardian_name_asm" id="guardian_name_asm" value="<?=$revertedCasesDetails->guardian_name_asm?>">
    <input type="hidden" name="guardian_relation" id="guardian_relation" value="<?=$revertedCasesDetails->guardian_relation?>">
    <input type="hidden" name="date_of_birth" id="date_of_birth" value="<?=$revertedCasesDetails->date_of_birth?>">
    <input type="hidden" name="gender" id="gender" value="<?=$revertedCasesDetails->gender?>">
    <input type="hidden" name="address" id="address" value="<?=$revertedCasesDetails->address?>">
    <input type="hidden" name="mobile_no" id="mobile_no" value="<?=$revertedCasesDetails->mobile_no?>">
    <input type="hidden" name="aadhaar_pan_ref_no" id="aadhaar_pan_ref_no" value="<?=$revertedCasesDetails->aadhaar_pan_ref_no?>">
    <input type="hidden" name="aadhaar_pan_type" id="aadhaar_pan_type" value="<?=$revertedCasesDetails->aadhaar_pan_type?>">
    <?php
    $authType =$revertedCasesDetails->aadhaar_pan_type;
    ?>
    <!-- working -->
    <div class="row" style='margin-top:20px'>               
        <div class="col-lg-1"></div>
        <div class="panel col-lg-10" style='padding-right:0px;padding-left:0px;'>
            <div class="card-header h5 bg-info text-white text-center">
                <span>E-Khajana Reverted By CO Case Details</span>
            </div>  
            <div class="card-header h6 bg-warning text-white text-center">
                <span><kbd> (Application-No : <?=$revertedCasesDetails->ld_application_no?>) </kbd></span>
            </div>
            <div class="card card-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>District Name: <?=$this->utilclass->getDistrictName($revertedCasesDetails->dist_code)?></td>
                        <td>Subdivision Name: <?=$this->utilclass->getSubDivName($revertedCasesDetails->dist_code,$revertedCasesDetails->subdiv_code)?></td>
                        <td>Circle Name: <?=$this->utilclass->getCircleName($revertedCasesDetails->dist_code,$revertedCasesDetails->subdiv_code,$revertedCasesDetails->cir_code)?></td>
                    </tr>
                    <tr>
                        <td>Mouza Name: <?=$this->utilclass->getMouzaName($revertedCasesDetails->dist_code,$revertedCasesDetails->subdiv_code,$revertedCasesDetails->cir_code,$revertedCasesDetails->mouza_pargona_code)?></td>
                        <td>Lot Name: <?=$this->utilclass->getLotName($revertedCasesDetails->dist_code,$revertedCasesDetails->subdiv_code,$revertedCasesDetails->cir_code,$revertedCasesDetails->mouza_pargona_code,$revertedCasesDetails->lot_no)?></td>
                        <td>Village Name: <?=$this->utilclass->getVillageName($revertedCasesDetails->dist_code,$revertedCasesDetails->subdiv_code,$revertedCasesDetails->cir_code,$revertedCasesDetails->mouza_pargona_code,$revertedCasesDetails->lot_no,$revertedCasesDetails->vill_townprt_code)?></td>
                    </tr>
                </table>
            </div>
            <div class="card-header h6 bg-secondary text-white text-center">
                Pattadar Information
            </div>
            <div class="card card-body">
                <table class="table">                    
                    <tr class="bg-success text-white">
                        <td>Name</td>
                        <td>Gurdian</td>
                        <td>Phone Number</td>
                        <td>Patta Type</td>
                        <td>Patta No</td>
                    </tr>
                    <tr class="">
                        <td><?=$revertedCasesDetails->pdar_name?></td>
                        <td><?=$revertedCasesDetails->pdar_father_name?></td>
                        <td><?=$revertedCasesDetails->mobile_no?></td>
                        <td><?=$revertedCasesDetails->patta_type?></td>
                        <td><?=$revertedCasesDetails->patta_no?></td>
                    </tr>
                </table>
            </div>
            <div class="card-header h6 bg-secondary text-white text-center">
                Applicant Details From  <?=$authType?> Card
            </div>
            <div class="card card-body">
                <table class="table table-bordered">                
                    <tr>
                    <?php if($authType =="PAN"):?>
                            <td class="text-danger font-weight-bold"><b>Name(English)</b></td>
                            <td><?=$revertedCasesDetails->applicant_name_eng?></td>
                            <td class="text-danger font-weight-bold">Name(Assamese)</td>
                            <td><?=$revertedCasesDetails->applicant_name_asm?></td>
                    <?php elseif ($authType =="AADHAAR"):?> 
                            <td rowspan="3"><?=$aadhaar_b64_decoded?></td>
                            <td class="text-danger font-weight-bold"><b>Name(English)</b></td>
                            <td><?=$revertedCasesDetails->applicant_name_eng?></td>
                            <td class="text-danger font-weight-bold">Name(Assamese)</td>
                            <td><?=$revertedCasesDetails->applicant_name_asm?></td>
                    <?php endif ?> 
                    </tr>
                    <tr>
                        <td class="text-danger font-weight-bold">Guardian Relation</td>
                        <td><?=$this->utilclass->getRelationFromDb($revertedCasesDetails->guardian_relation,$revertedCasesDetails->dist_code)?></td>
                        <td class="text-danger font-weight-bold">Guardian Name(Assamese)</td>
                        <td><?=$revertedCasesDetails->guardian_name_asm?></td>
                    </tr>
                    <tr>
                        <td class="text-danger font-weight-bold">Date Of Birth</td>
                        <td><?=$revertedCasesDetails->date_of_birth?></td>
                        <td class="text-danger font-weight-bold">Address</td>
                        <td><?=$revertedCasesDetails->address?></td>
                    </tr>
                </table>	
            </div>
            <table class="table table-striped table-bordered text-bold" style="margin-bottom:0px;">
                <thead>
                    <tr>                     
                        <th colspan="6" class="text-center bg-secondary text-white">
                            <?='Khajana Receipt'?> :
                            <button class="btn btn-success btn-sm">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <a href="<?=base_url().'index.php/EkhajanaMouzadarController/document?appl_no='.$revertedCasesDetails->ld_application_no?>"
                                target="_blank" style="text-decoration:none;color:white;">
                                    Download
                                </a>
                            </button>
                        </th>
                    </tr>
                </thead>
            </table> 
            <h5 style="background-color: #9da832; color:white;padding:2px">Circle Officer Revert Remarks</h5>
            <textarea class="form-control mb-2"><?=$revertedCasesDetails->co_remark?></textarea>
            <h5 style="background-color: #9da832; color:white;padding:2px">Mouzadar's Previous Remarks</h5>
            <textarea class="form-control mb-2"><?=$revertedCasesDetails->mou_remark?></textarea>
            <div class="card-header h6 bg-secondary text-center text-white">
                MOUZADAR NEW REPORT
            </div>
            <div class="card card-body mb-2">
                <div class="row mt-1">
                <div class="row mt-1">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-5 text-right">
                                <label class="text-right">
                                    MOUZADAR REPORT <span class="text-danger h4">*</span>
                                </label>            
                            </div>
                            <div class="col-lg-6 text-left">
                                <textarea class="form-control" placeholder='MOUZADAR-REPORT' rows=3 name="mou_report" required></textarea>
                            </div>
                        </div>                    
                    </div>
                </div>  
            </div>
            <h5 style="text-align:center;background-color: #136a6f; color:white;padding:2px">DUE PAYMENTS CALCULATED BY MOUZADAR</h5>
            <div class="card-body" style="border:1px solid grey">            
                <div class="row mt-1">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-5 text-right">
                                <label class="text-right">
                                    OPENING BALANCE/ ARREAR(RS)  <span class="text-danger h4">*</span>
                                </label>            
                            </div>
                            <div class="col-lg-6 text-left">
                                <input type="text" class="form-control" name="openinig_balance" id="openinig_balance"
                                placeholder="-OPENING-BALANCE-" value="<?=$total_arrear?>" readonly>
                            </div>
                        </div>                    
                    </div>
                </div>  
                <div class="row mt-3">
                    <div class="col-lg-1"></div>                                        
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-5 text-right">
                                <label class="text-right">
                                    CURRENT REVENUE(RS) <span class="text-danger h4">*</span><br>
                                    <span class="text-primary h6">(REVENUE IS FETCHED FROM DOUL)</span>
                                </label>            
                            </div>
                            <div class="col-lg-6 text-left">
                                <input type="text" class="form-control text-danger" id="current_revenue" name="current_revenue" 
                                placeholder="-CURRENT-REVENUE-" readonly value="<?=$current_revenue?>">
                            </div>
                        </div>                    
                    </div>
                </div>     
                <div class="row mt-3">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-5 text-right">
                                <label class="text-right">
                                    CURRENT LOCAL TAX(RS)<span class="text-danger h4">*</span><br>
                                    <span class="text-primary h6">(LOCAL TAX IS FETCHED FROM DOUL)</span>
                                </label>            
                            </div>
                            <div class="col-lg-6 text-left">
                                <input type="text" class="form-control text-danger" id="current_local_tax" name="current_local_tax"
                                    placeholder="-CURRENT-LOCAL-TAX-" readonly value="<?=$current_local_tax?>">
                            </div>
                        </div>                    
                    </div>
                </div>     
            </div>
        </div>
        <div class="row">               
            <div class="col-lg-1"></div>
            <div class="panel col-lg-10" style='padding-right:0px;padding-left:0px;'>
                <div class="card-body">
                    <!-- validation-errors-div -->
                    <div class="col-lg-12" id="mouArr_error_div" style="display:none;">
                        <div class="card-header h5 bg-danger text-white text-center">
                            VALIDATION ERRORS
                        </div>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <strong class="text-center" style="color:red !important"
                                id="mouArr_validation_error_msg">
                            </strong>
                        </div> 
                    </div>
                    <!-- validation-error-div-end -->
                    <div class="row">
                        <div class="col-lg-12 mt-3 text-center">
                            <button class="btn btn-success btn-sm" onclick="mouzdarRevertedCaseForward()"
                            style="padding: 5px!important;font-size: 14px;font-weight: bold;">
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    FORWARD
                            </button>
                            <button class="btn btn-warning btn-sm" onclick="objectionCase('<?=$revertedCasesDetails->ld_application_no?>')"
                            style="padding: 5px!important;font-size: 14px;font-weight: bold;">
                                <i class="fa fa-gavel" aria-hidden="true"></i>
                                    RAISE QUERY
                            </button>
                            <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/index'?>"
                                class="btn btn-danger btn-sm text-white" role="button" 
                                style="padding: 7px !important;font-size: 14px;font-weight: bold;">
                                <i class="glyphicon glyphicon-remove-sign"></i>
                                    CANCEL
                            </a>                      
                        </div>                
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!--  objection model  -->
        <div class="modal align-middle" id="Ek_objection_modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered" style="max-width:50%">
                <div class="modal-content">
                    <div class="modal-header text-white text-bold text-center bg-danger">
                        <h5 class="modal-title w-100">
                            <u>
                                RAISE A QUERY<br>
                                DISTRICT: <?=$this->utilclass->getDistrictName($revertedCasesDetails->dist_code)?>,
                                SUBDIVISION: <?=$this->utilclass->getSubDivName($revertedCasesDetails->dist_code, 
                                                $revertedCasesDetails->subdiv_code)?>,
                                CIRCLE: <?=$this->utilclass->getCircleName($revertedCasesDetails->dist_code, 
                                                $revertedCasesDetails->subdiv_code,$revertedCasesDetails->cir_code)?>,
                                MOUZA: <?=$this->utilclass->getMouzaName($revertedCasesDetails->dist_code, 
                                                $revertedCasesDetails->subdiv_code,$revertedCasesDetails->cir_code, 
                                                $revertedCasesDetails->mouza_pargona_code)?>,
                                LOT: <?=$this->utilclass->getLotName($revertedCasesDetails->dist_code, 
                                                $revertedCasesDetails->subdiv_code,$revertedCasesDetails->cir_code, 
                                                $revertedCasesDetails->mouza_pargona_code, $revertedCasesDetails->lot_no)?>,
                                VILLAGE: <?=$this->utilclass->getVillageName($revertedCasesDetails->dist_code, 
                                                $revertedCasesDetails->subdiv_code,$revertedCasesDetails->cir_code, 
                                                $revertedCasesDetails->mouza_pargona_code, $revertedCasesDetails->lot_no,
                                                $revertedCasesDetails->vill_townprt_code)?>
                            </u>
                        </h5>
                    </div>
                        <div class="modal-body">
                            <form id="Ek_objection_rmk_form">
                                <div class="form-group mb-5">
                                    <label class="col-sm-3 uni_text control-label text-right">
                                        Remark :
                                        <span style="color:red;font-weight:bold; font-size: 25px;">*</span>
                                    </label>
                                    <div class="col-sm-12 mb-3">
                                        <td>
                                            <textarea class="form-control" placeholder="--Query-Remark--" rows="3" name="Ek_objection_rmk" id="Ek_objection_rmk"></textarea>
                                        </td>
                                    </div>
                                </div>
                                    <input type="hidden" name="arrear_status" id="arrear_status" value="<?=$arrear_status['flag']?>">
                                    <input type="hidden" name="land_details_id" id="land_details_id" value="<?=$revertedCasesDetails->id?>">
                                    <input type="hidden" name="application_no" id="application_no" value="<?=$revertedCasesDetails->application_no?>">
                                    <input type="hidden" name="ld_application_no" id="ld_application_no" value="<?=$revertedCasesDetails->ld_application_no?>">
                                    <!-- <input type="hidden" name="case_no" id="case_no" value="<?=$revertedCasesDetails->case_no?>"> -->
                                    <input type="hidden" name="patta_no" id="patta_no" value="<?=$revertedCasesDetails->patta_no?>">
                            </form>
                        </div>
                        <!-- validation-errors-div -->
                        <div class="col-lg-12" id="Ek_objection_rmk_form_validation_error_div" style="display:none;">
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <strong class="text-center" style="color:red !important"
                                    id="Ek_objection_rmk_form_validation_error_msg">
                                </strong>
                            </div>
                        </div>
                        <!-- validation-error-div-end -->
                        <hr>
                        <div class="row" align="center" style="padding:10px;">
                            <div class="col-lg-12" align="center">
                                <button type="button" class="btn btn-sm btn-success" onclick="EkObjectionFormSubmit()">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                        Submit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="EkObjectionModalClose()">
                                    <i class="glyphicon glyphicon-remove-sign"></i>
                                        Close
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<script src="<?php echo base_url('js/ekhajana/ekhajana_mouzadar.js'); ?>"></script>

<script>
    function mouzdarRevertedCaseForward()
    {
        event.preventDefault();
        var ld_application_no = $('#ld_application_no').val();
        $('#mouArr_error_div').hide();
        $('#mouArr_validation_error_msg').empty();
        // var formdata = $('#mouzadar_form').serialize();
        var formdata = new FormData(document.getElementById('mouzadar_form'));
        $.ajax({
            url: baseurl + "/EkhajanaMouzadarController/mouzadarForwardRevertedCase",
            type: 'POST',
            data: formdata,
            dataType: 'json',
            enctype: 'multipart/form-data',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function () {
                console.log("Loader Code Display");
            },
            success: function (data) {      
                if(data.result == 'validation_error'){
                    $.unblockUI();
                    alert("Validation-Error...!!");
                    $('#mouArr_error_div').show();
                    for (let i = 0; i < data.msg.length; i++) {
                        $('#mouArr_validation_error_msg').append(data.msg[i]);
                    }
                    return;
                }else if(data.result == 'SERVER-ERROR'){
                    $.unblockUI();
                    alert(data.msg);
                    return;

                }else if(data.result == 'SUCCESS'){
                    $.unblockUI();
                    Swal.fire({
                        title: 'Case('+ld_application_no+') Forwarded To Circle Officer Sucessfully!!',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Home'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = baseurl + "/EkhajanaMouzadarController/index";
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
        $.unblockUI();
    }
</script>
