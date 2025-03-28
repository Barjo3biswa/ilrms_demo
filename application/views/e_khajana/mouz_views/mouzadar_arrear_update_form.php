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
                E-Khajana-(Pending-list)
            </a>
        </li>
         <li class="breadcrumb-item font-weight-bold active" aria-current="page">E-Khajana-(Arrear-Details-Form)</li>
    </ol>
</nav>
<form id="mouzadar_form">          
    <!-- Application Details -->
    <input type="hidden" name="application_no" id="application_no" 
    value="<?=$pendingCaseLandDetails->application_no?>">
    <input type="hidden" name="ld_application_no" id="ld_application_no" 
    value="<?=$pendingCaseLandDetails->ld_application_no?>">
    <!-- location details -->
    <input type="hidden" name="dist_code" id="dist_code" value="<?=$pendingCaseLandDetails->dist_code?>">
    <input type="hidden" name="subdiv_code" id="subdiv_code" value="<?=$pendingCaseLandDetails->subdiv_code?>">
    <input type="hidden" name="cir_code" id="cir_code" value="<?=$pendingCaseLandDetails->cir_code?>">
    <input type="hidden" name="mouza_pargona_code" id="mouza_pargona_code" value="<?=$pendingCaseLandDetails->mouza_pargona_code?>">
    <input type="hidden" name="lot_no" id="lot_no" value="<?=$pendingCaseLandDetails->lot_no?>">
    <input type="hidden" name="vill_townprt_code" id="vill_townprt_code" value="<?=$pendingCaseLandDetails->vill_townprt_code?>">
    <input type="hidden" name="is_urban" id="is_urban" value="<?=$pendingCaseLandDetails->is_urban?>">
    <!-- patta details -->
    <input type="hidden" name="patta_type" id="patta_type" value="<?=$pendingCaseLandDetails->patta_type?>">
    <input type="hidden" name="patta_type_code" id="patta_type_code" value="<?=$pendingCaseLandDetails->patta_type_code?>">
    <input type="hidden" name="pdar_id" id="pdar_id" value="<?=$pendingCaseLandDetails->pdar_id?>">
    <input type="hidden" name="pdar_name" id="pdar_name" value="<?=$pendingCaseLandDetails->pdar_name?>">
    <input type="hidden" name="pdar_father_name" id="pdar_father_name" value="<?=$pendingCaseLandDetails->pdar_father_name?>">
    <input type="hidden" name="patta_no" id="patta_no" value="<?=$pendingCaseLandDetails->patta_no?>">
    <!-- applicant details -->
    <input type="hidden" name="applicant_name_eng" id="applicant_name_eng" value="<?=$pendingCaseApplicantDetails->name_eng?>">
    <input type="hidden" name="applicant_name_asm" id="applicant_name_asm" value="<?=$pendingCaseApplicantDetails->name_asm?>">
    <input type="hidden" name="guardian_name_eng" id="guardian_name_eng" value="<?=$pendingCaseApplicantDetails->guardian_name_eng?>">
    <input type="hidden" name="guardian_name_asm" id="guardian_name_asm" value="<?=$pendingCaseApplicantDetails->guardian_name_asm?>">
    <input type="hidden" name="guardian_relation" id="guardian_relation" value="<?=$pendingCaseApplicantDetails->guardian_relation?>">
    <input type="hidden" name="date_of_birth" id="date_of_birth" value="<?=$pendingCaseApplicantDetails->date_of_birth?>">
    <input type="hidden" name="gender" id="gender" value="<?=$pendingCaseApplicantDetails->gender?>">
    <input type="hidden" name="address" id="address" value="<?=$pendingCaseApplicantDetails->address?>">
    <input type="hidden" name="mobile_no" id="mobile_no" value="<?=$pendingCaseApplicantDetails->mobile_no?>">
    <input type="hidden" name="aadhaar_pan_ref_no" id="aadhaar_pan_ref_no" value="<?=$pendingCaseApplicantDetails->aadhaar_pan_ref_no?>">
    <input type="hidden" name="aadhaar_pan_type" id="aadhaar_pan_type" value="<?=$pendingCaseApplicantDetails->aadhaar_pan_type?>">
    <!-- document details  -->
    <?php if(isset($pendingCaseDocumentDetails->id)):?>
        <input type="hidden" name="rtps_doc_id" id="rtps_doc_id" value="<?=$pendingCaseDocumentDetails->id?>">
    <?php else:?>
        <input type="hidden" name="rtps_doc_id" id="rtps_doc_id" value="">
    <?php endif;?>
    <!-- <input type="hidden" name="rtps_doc_id" id="rtps_doc_id" value="<?=$pendingCaseDocumentDetails->id?>"> -->
    <input type="hidden" name="current_revenue" id="current_revenue" value="<?=$current_revenue?>">
    <input type="hidden" name="current_local_tax" id="current_local_tax" value="<?=$current_local_tax?>">
    <input type="hidden" name="current_doul_year" id="current_doul_year" value="<?=$current_doul_year?>">
    <?php 
    $total_amount =$current_revenue + $current_local_tax;
    ?>
    <?php
    $authType =$pendingCaseApplicantDetails->aadhaar_pan_type;
    ?>
    <!-- working -->
    
    <div class="row" style='margin-top:20px'>               
        <div class="col-lg-1"></div>
        <div class="panel col-lg-10" style='padding-right:0px;padding-left:0px;'>
            <div class="card-header h5 bg-info text-white text-center">
                <span>E-Khajana Pending Case Details</span>
            </div>  
            <div class="card-header h6 bg-warning text-white text-center">
                <span><kbd> (Application-No : <?=$pendingCaseLandDetails->ld_application_no?>) </kbd></span>
            </div>
            <div class="card card-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>District Name: <?=$this->utilclass->getDistrictName($pendingCaseLandDetails->dist_code)?></td>
                        <td>Subdivision Name: <?=$this->utilclass->getSubDivName($pendingCaseLandDetails->dist_code,$pendingCaseLandDetails->subdiv_code)?></td>
                        <td>Circle Name: <?=$this->utilclass->getCircleName($pendingCaseLandDetails->dist_code,$pendingCaseLandDetails->subdiv_code,$pendingCaseLandDetails->cir_code)?></td>
                    </tr>
                    <tr>
                        <td>Mouza Name: <?=$this->utilclass->getMouzaName($pendingCaseLandDetails->dist_code,$pendingCaseLandDetails->subdiv_code,$pendingCaseLandDetails->cir_code,$pendingCaseLandDetails->mouza_pargona_code)?></td>
                        <td>Lot Name: <?=$this->utilclass->getLotName($pendingCaseLandDetails->dist_code,$pendingCaseLandDetails->subdiv_code,$pendingCaseLandDetails->cir_code,$pendingCaseLandDetails->mouza_pargona_code,$pendingCaseLandDetails->lot_no)?></td>
                        <td>Village Name: <?=$this->utilclass->getVillageName($pendingCaseLandDetails->dist_code,$pendingCaseLandDetails->subdiv_code,$pendingCaseLandDetails->cir_code,$pendingCaseLandDetails->mouza_pargona_code,$pendingCaseLandDetails->lot_no,$pendingCaseLandDetails->vill_townprt_code)?></td>
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
                        <td><?=$pendingCaseLandDetails->pdar_name?></td>
                        <td><?=$pendingCaseLandDetails->pdar_father_name?></td>
                        <td><?=$pendingCaseApplicantDetails->mobile_no?></td>
                        <td><?=$pendingCaseLandDetails->patta_type?></td>
                        <td><?=$pendingCaseLandDetails->patta_no?></td>
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
                            <td><?=$pendingCaseApplicantDetails->name_eng?></td>
                            <td class="text-danger font-weight-bold">Name(Assamese)</td>
                            <td><?=$pendingCaseApplicantDetails->name_asm?></td>
                    <?php elseif ($authType =="AADHAAR"):?> 
                            <td rowspan="3"><?=$aadhaar_b64_decoded?></td>
                            <td class="text-danger font-weight-bold"><b>Name(English)</b></td>
                            <td><?=$pendingCaseApplicantDetails->name_eng?></td>
                            <td class="text-danger font-weight-bold">Name(Assamese)</td>
                            <td><?=$pendingCaseApplicantDetails->name_asm?></td>
                    <?php endif ?> 
                    </tr>
                    <tr>
                        <td class="text-danger font-weight-bold">Guardian Relation</td>
                        <td><?=$this->utilclass->getRelationFromDb($pendingCaseApplicantDetails->guardian_relation,$pendingCaseLandDetails->dist_code)?></td>
                        <td class="text-danger font-weight-bold">Guardian Name(Assamese)</td>
                        <td><?=$pendingCaseApplicantDetails->guardian_name_asm?></td>
                    </tr>
                    <tr>
                        <td class="text-danger font-weight-bold">Date Of Birth</td>
                        <td><?=$pendingCaseApplicantDetails->date_of_birth?></td>
                        <td class="text-danger font-weight-bold">Address</td>
                        <td><?=$pendingCaseApplicantDetails->address?></td>
                    </tr>
                </table>	
            </div>
            <?php if(isset($pendingCaseDocumentDetails->id)):?>     
            <table class="table table-striped table-bordered text-bold" style="margin-bottom:0px;">
                <thead>
                    <tr>                     
                        <th colspan="6" class="text-center bg-secondary text-white">
                            <?=$pendingCaseDocumentDetails->file_details?> :
                            <button class="btn btn-success btn-sm">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <a href="<?=base_url().'index.php/EkhajanaMouzadarController/document?appl_no='.$pendingCaseLandDetails->ld_application_no?>"
                                target="_blank" style="text-decoration:none;color:white;">
                                    Download
                                </a>
                            </button>
                        </th>
                    </tr>
                </thead>
            </table> 
            <?php endif;?>
            
            <!-- File Upload code starts here -->
            <div class="card card-body">
                <h5 class="text-center text-white" style="background-color:grey;padding:5px">ADDITIONAL DOCUMENT UPLOAD SECTION</h5>
                <div class="row mb-3" >
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
                        <div class="form-group">
                            <label id="formControlFile"><?="Document Details"?></label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
                        <div class="form-group">
                            <label id="formControlFile"><?="Select File"?></label>
                            <span style="color:blue;text-align:center;font-size:14px"><br>Please upload file less than 2 MB in PDF format only </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sx-10">
                        <div class="form-group">
                            <input type="text" class="form-control-file" id="uploadFile" name="fileText" style="width: 100%" minlength="3" maxlength="99" placeholder="Enter Document Name">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
                        <div class="form-group">
                            <input type="file" class="form-control-file" id="uploadFile1" name="fileUpload" style="width: 100%">
                        </div>
                    </div>
                </div>
                <span style="color:red;text-align:center;font-size:14px">* Upload document is mandatory if rtps doc id is missing for the application </span>
                <span style="color:green;text-align:center;font-size:14px">* In Case Of Raise Query Additional Documnet Will Not Be forwarded To CO </span>
            </div>

            <!-- File Upload code ends here -->         
            <div class="card-header h6 bg-dark text-warning text-center">
               PATTADAR IDENTIFICATION
            </div>            
            <div class="card card-body">
                <div class="row mt-1">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-5 text-right">
                                <label class="text-right">
                                    WHETHER PATTADAR IDENTIFIED: <span class="text-danger h4">*</span>
                                </label>            
                            </div>
                            <div class="col-lg-6 text-left">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pattadar_identified" value="Y" checked>
                                    YES
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pattadar_identified" value="N">
                                    NO
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
            <div class="card-header h6 bg-secondary text-center text-white">
                MOUZADAR REPORT
            </div>
            <div class="card card-body">
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
        </div>        
        <h3 style="text-align:center;background-color: #136a6f; color:white;padding:2px">DUE PAYMENTS</h3>
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
                <div class="row mt-3">
                    <div class="col-lg-1"></div>                                        
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-5 text-right">
                                <label class="text-right">
                                    LAST PAY DATE <span class="text-danger h4">*</span>
                                </label>            
                            </div>
                            <div class="col-lg-6 text-left">
                                <input type="text" class="form-control" placeholder = "-LAST-PAY-DATE-" 
                                id="last_pay_date1" name="last_pay_date1" readonly>
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
                                    LAST REVENUE PAYMENT AMOUNT(RS)<span class="text-danger h4">*</span>
                                </label>            
                            </div>
                            <div class="col-lg-6 text-left">
                                <input type="text" class="form-control" name="last_revenue_payment_amount"
                                id="last_revenue_payment_amount" placeholder="-LAST-REVENUE-PAY-AMOUNT-">
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
                                    LAST LOCAL TAX PAYMENT AMOUNT(RS) <span class="text-danger h4">*</span>
                                </label>            
                            </div>
                            <div class="col-lg-6 text-left">
                                <input type="text" class="form-control" name="last_local_tax_payment_amount"
                                id="last_local_tax_payment_amount" placeholder="LAST-LOCAL-TAX-PAY-AMOUNT">
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="row hide" style="display:none">               
        <div class="col-lg-1"></div>
        <div class="panel col-lg-10" style='padding-right:0px;padding-left:0px;'>
            <div class="card-header h5 bg-info text-white text-center">
                LAST PAYEE DETAILS
            </div>
            <div class="card-body">
                <div class="row mt-1">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-5 text-right">
                                <label class="text-right">
                                    LAST PAYMENT BY <span class="text-danger h4">*</span>
                                </label>            
                            </div>
                            <div class="col-lg-6 text-left">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="paymentBy" id="paymentBySelfRadio" value="self" checked>
                                    SELF
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="paymentBy" id="paymentByOtherRadio" value="other">
                                    OTHER
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>  
                <!-- payment-details-div -->
                <div style="display: none;" id="payee_details_div">
                    <div class="row mt-1">
                        <div class="col-lg-1"></div>                                        
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-5 text-right">
                                    <label class="text-right">
                                        PAYEE NAME <span class="text-danger h4">*</span>
                                    </label>            
                                </div>
                                <div class="col-lg-6 text-left">
                                    <input type="text" class="form-control" name="payee_name" 
                                    placeholder="-PAYEE-NAME-">
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
                                        PAYEE RELATION <span class="text-danger h4">*</span>
                                    </label>            
                                </div>
                                <div class="col-lg-7 text-left">
                                    <select class="js-single js-states form-control" style="width: 85%" id="payee_relation" 
                                    name="payee_relation">
                                        <option value="" selected disabled>-SELECT-PAYEE-RELATION-</option>
                                        <?php foreach ($payee_relations as $payee_relation):?>
                                            <option value="<?=$payee_relation->id?>"><?=$payee_relation->guard_rel_desc_as?>(<?=$payee_relation->guard_rel_desc?>)</option>
                                        <?php endforeach;?>
                                    </select>
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
                                        PAYEE CONTACT NO
                                    </label>            
                                </div>
                                <div class="col-lg-6 text-left">
                                    <input type="text" class="form-control" name = "payee_contact_no"
                                    placeholder="-PAYEE-CONTACT-NO-">
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
                                        PAYEE EMAIL                                
                                    </label>            
                                </div>
                                <div class="col-lg-6 text-left">
                                    <input type="text" class="form-control" name="payee_email" 
                                    placeholder="-PAYEE-EMAIL-">
                                </div>
                            </div>                    
                        </div>
                    </div>
                </div>            
                <!-- payment-details-div-end -->
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
                        <button class="btn btn-success btn-sm" onclick="mouzdarCaseRegistration()"
                        style="padding: 5px!important;font-size: 14px;font-weight: bold;">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                SUBMIT
			            </button>
                        <button class="btn btn-warning btn-sm" onclick="objectionCase('<?=$pendingCaseLandDetails->ld_application_no?>')"
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
                        <div class="card p-2 bg-dark text-warning shadow mb-3 mt-3 h4 font-weight-bold" style="display:none;" >
                            FURTHER PROCESS WILL BE ACTIVATED SOON !!!
                        </div>                       
                    </div>                
                </div>
            </div>
        </div>
    </div>

<!--  objection model  -->
<div class="modal align-middle" id="Ek_objection_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width:50%">
        <div class="modal-content">
            <div class="modal-header text-white text-bold text-center bg-danger">
                <h5 class="modal-title w-100">
                    <u>
                        RAISE A QUERY<br>
                        DISTRICT: <?=$this->utilclass->getDistrictName($pendingCaseLandDetails->dist_code)?>,
                        SUBDIVISION: <?=$this->utilclass->getSubDivName($pendingCaseLandDetails->dist_code, 
                                        $pendingCaseLandDetails->subdiv_code)?>,
                        CIRCLE: <?=$this->utilclass->getCircleName($pendingCaseLandDetails->dist_code, 
                                        $pendingCaseLandDetails->subdiv_code,$pendingCaseLandDetails->cir_code)?>,
                        MOUZA: <?=$this->utilclass->getMouzaName($pendingCaseLandDetails->dist_code, 
                                        $pendingCaseLandDetails->subdiv_code,$pendingCaseLandDetails->cir_code, 
                                        $pendingCaseLandDetails->mouza_pargona_code)?>,
                        LOT: <?=$this->utilclass->getLotName($pendingCaseLandDetails->dist_code, 
                                        $pendingCaseLandDetails->subdiv_code,$pendingCaseLandDetails->cir_code, 
                                        $pendingCaseLandDetails->mouza_pargona_code, $pendingCaseLandDetails->lot_no)?>,
                        VILLAGE: <?=$this->utilclass->getVillageName($pendingCaseLandDetails->dist_code, 
                                        $pendingCaseLandDetails->subdiv_code,$pendingCaseLandDetails->cir_code, 
                                        $pendingCaseLandDetails->mouza_pargona_code, $pendingCaseLandDetails->lot_no,
                                        $pendingCaseLandDetails->vill_townprt_code)?>
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
			    <input type="hidden" name="land_details_id" id="land_details_id" value="<?=$pendingCaseLandDetails->id?>">
                            <input type="hidden" name="arrear_status" id="arrear_status" value="<?=$arrear_status['flag']?>">
                            <input type="hidden" name="application_no" id="application_no" value="<?=$pendingCaseLandDetails->application_no?>">
                            <input type="hidden" name="ld_application_no" id="ld_application_no" value="<?=$pendingCaseLandDetails->ld_application_no?>">
                            <!-- <input type="hidden" name="case_no" id="case_no" value="<?=$pendingCaseLandDetails->case_no?>"> -->
                            <input type="hidden" name="patta_no" id="patta_no" value="<?=$pendingCaseLandDetails->patta_no?>">
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
</form>
<script src="<?php echo base_url('js/ekhajana/ekhajana_mouzadar.js'); ?>"></script>
