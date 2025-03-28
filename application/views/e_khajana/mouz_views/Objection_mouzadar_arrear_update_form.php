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

<form id="mouzadar_form_objection">          
    <!-- Application Details -->
    <input type="hidden" name="application_no" id="application_no" 
    value="<?=$ekbasicDetails->application_no?>">
    <input type="hidden" name="ld_application_no" id="ld_application_no" 
    value="<?=$ekbasicDetails->ld_application_no?>">
    <input type="hidden" name="case_no" id="case_no" value="<?=$ekbasicDetails->case_no?>">
    <!-- location details -->
    <input type="hidden" name="dist_code" id="dist_code" value="<?=$ekbasicDetails->dist_code?>">
    <input type="hidden" name="subdiv_code" id="subdiv_code" value="<?=$ekbasicDetails->subdiv_code?>">
    <input type="hidden" name="cir_code" id="cir_code" value="<?=$ekbasicDetails->cir_code?>">
    <input type="hidden" name="mouza_pargona_code" id="mouza_pargona_code" value="<?=$ekbasicDetails->mouza_pargona_code?>">
    <input type="hidden" name="lot_no" id="lot_no" value="<?=$ekbasicDetails->lot_no?>">
    <input type="hidden" name="vill_townprt_code" id="vill_townprt_code" value="<?=$ekbasicDetails->vill_townprt_code?>">
    <input type="hidden" name="is_urban" id="is_urban" value="<?=$ekbasicDetails->is_urban?>">
    <!-- patta details -->
    <input type="hidden" name="patta_type" id="patta_type" value="<?=$ekbasicDetails->patta_type?>">
    <input type="hidden" name="patta_type_code" id="patta_type_code" value="<?=$ekbasicDetails->patta_type_code?>">
    <input type="hidden" name="pdar_id" id="pdar_id" value="<?=$ekbasicDetails->pdar_id?>">
    <input type="hidden" name="pdar_name" id="pdar_name" value="<?=$ekbasicDetails->pdar_name?>">
    <input type="hidden" name="pdar_father_name" id="pdar_father_name" value="<?=$ekbasicDetails->pdar_father_name?>">
    <input type="hidden" name="patta_no" id="patta_no" value="<?=$ekbasicDetails->patta_no?>">
    <!-- applicant details -->
    <input type="hidden" name="applicant_name_eng" id="applicant_name_eng" value="<?=$ekbasicDetails->applicant_name_eng?>">
    <input type="hidden" name="applicant_name_asm" id="applicant_name_asm" value="<?=$ekbasicDetails->applicant_name_asm?>">
    <input type="hidden" name="guardian_name_eng" id="guardian_name_eng" value="<?=$ekbasicDetails->guardian_name_eng?>">
    <input type="hidden" name="guardian_name_asm" id="guardian_name_asm" value="<?=$ekbasicDetails->guardian_name_asm?>">
    <input type="hidden" name="guardian_relation" id="guardian_relation" value="<?=$ekbasicDetails->guardian_relation?>">
    <input type="hidden" name="date_of_birth" id="date_of_birth" value="<?=$ekbasicDetails->date_of_birth?>">
    <input type="hidden" name="gender" id="gender" value="<?=$ekbasicDetails->gender?>">
    <input type="hidden" name="address" id="address" value="<?=$ekbasicDetails->address?>">
    <input type="hidden" name="mobile_no" id="mobile_no" value="<?=$ekbasicDetails->mobile_no?>">
    <input type="hidden" name="aadhaar_pan_ref_no" id="aadhaar_pan_ref_no" value="<?=$ekbasicDetails->aadhaar_pan_ref_no?>">
    <input type="hidden" name="aadhaar_pan_type" id="aadhaar_pan_type" value="<?=$ekbasicDetails->aadhaar_pan_type?>">
    <!-- document details  -->
    <input type="hidden" name="rtps_doc_id" id="rtps_doc_id" value="<?=$ekbasicDetails->id?>">
    <!-- <input type="hidden" name="current_revenue" id="current_revenue" value="<?=$current_revenue?>"> -->
    <!-- <input type="hidden" name="current_local_tax" id="current_local_tax" value="<?=$current_local_tax?>"> -->
    <!-- <input type="hidden" name="current_doul_year" id="current_doul_year" value="<?=$current_doul_year?>"> -->
    <!-- <?php 
        $total_amount =$current_revenue + $current_local_tax;
    ?> -->
     <!-- arrear details -->
     <input type="hidden" name="opening_balance" id="opening_balance" value="<?=$arrearDetails->opening_balance?>">
        <input type="hidden" name="last_pay_date" id="last_pay_date" value="<?=$arrearDetails->last_pay_date?>">
        <input type="hidden" name="last_revenue_payment" id="last_revenue_payment" value="<?=$arrearDetails->last_revenue_payment?>">
        <input type="hidden" name="last_local_tax_payment" id="last_local_tax_payment" value="<?=$arrearDetails->last_local_tax_payment?>">
        <input type="hidden" name="current_revenue" id="current_revenue" value="<?=$arrearDetails->current_revenue?>">
        <input type="hidden" name="current_local_tax" id="current_local_tax" value="<?=$arrearDetails->current_local_tax?>">
        <input type="hidden" name="current_doul_year" id="current_doul_year" value="<?=$arrearDetails->current_doul_year?>">
        <input type="hidden" name="payment_by" id="payment_by" value="<?=$arrearDetails->payment_by?>">
    <!-- working -->
    
    <div class="row" style='margin-top:20px'>               
        <div class="col-lg-1"></div>
        <div class="panel col-lg-10" style='padding-right:0px;padding-left:0px;'>
            <div class="card-header h5 bg-info text-white text-center">
                <span>E-Khajana Pending Case Details</span>
            </div>  
            <div class="card-header h6 bg-warning text-white text-center">
                <span><kbd> (Application-No : <?=$ekbasicDetails->ld_application_no?>) </kbd></span>
            </div>
            <div class="card card-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>District Name: <?=$this->utilclass->getDistrictName($ekbasicDetails->dist_code)?></td>
                        <td>Subdivision Name: <?=$this->utilclass->getSubDivName($ekbasicDetails->dist_code,$ekbasicDetails->subdiv_code)?></td>
                        <td>Circle Name: <?=$this->utilclass->getCircleName($ekbasicDetails->dist_code,$ekbasicDetails->subdiv_code,$ekbasicDetails->cir_code)?></td>
                    </tr>
                    <tr>
                        <td>Mouza Name: <?=$this->utilclass->getMouzaName($ekbasicDetails->dist_code,$ekbasicDetails->subdiv_code,$ekbasicDetails->cir_code,$ekbasicDetails->mouza_pargona_code)?></td>
                        <td>Lot Name: <?=$this->utilclass->getLotName($ekbasicDetails->dist_code,$ekbasicDetails->subdiv_code,$ekbasicDetails->cir_code,$ekbasicDetails->mouza_pargona_code,$ekbasicDetails->lot_no)?></td>
                        <td>Village Name: <?=$this->utilclass->getVillageName($ekbasicDetails->dist_code,$ekbasicDetails->subdiv_code,$ekbasicDetails->cir_code,$ekbasicDetails->mouza_pargona_code,$ekbasicDetails->lot_no,$ekbasicDetails->vill_townprt_code)?></td>
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
                        <td><?=$ekbasicDetails->pdar_name?></td>
                        <td><?=$ekbasicDetails->pdar_father_name?></td>
                        <td><?=$ekbasicDetails->mobile_no?></td>
                        <td><?=$ekbasicDetails->patta_type?></td>
                        <td><?=$ekbasicDetails->patta_no?></td>
                    </tr>
                </table>
            </div>
            <div class="card-header h6 bg-secondary text-white text-center">
                Applicant Details From Aadhar Card
            </div>
            <div class="card card-body">
                <table class="table table-bordered">                
                    <tr>
                        <td class="text-danger font-weight-bold"><b>Name(English)</b></td>
                        <td><?=$ekbasicDetails->applicant_name_eng?></td>
                        <td class="text-danger font-weight-bold">Name(Assamese)</td>
                        <td><?=$ekbasicDetails->applicant_name_asm?></td>
                    </tr>
                    <tr>
                        <td class="text-danger font-weight-bold">Guardian Relation</td>
                        <td><?=$ekbasicDetails->guardian_relation?></td>
                        <td class="text-danger font-weight-bold">Guardian Name(Assamese)</td>
                        <td><?=$ekbasicDetails->guardian_name_asm?></td>
                    </tr>
                    <tr>
                        <td class="text-danger font-weight-bold">Date Of Birth</td>
                        <td><?=$ekbasicDetails->date_of_birth?></td>
                        <td class="text-danger font-weight-bold">Address</td>
                        <td><?=$ekbasicDetails->address?></td>
                    </tr>
                </table>	
            </div>
            <table class="table table-striped table-bordered text-bold" style="margin-bottom:0px;">
                <thead>
                    <tr>                     
                        <th colspan="6" class="text-center bg-secondary text-white">
                            <?='LAST KHAJANA RECEIPT'?> :
                            <button class="btn btn-success btn-sm">
                                <i class="fa fa-download" aria-hidden="true"></i>
                                <a href="<?=base_url().'index.php/EkhajanaMouzadarController/document?appl_no='.$ekbasicDetails->ld_application_no?>"
                                target="_blank" style="text-decoration:none;color:white;">
                                    Download
                                </a>
                            </button>
                        </th>
                    </tr>
                </thead>
            </table>            
            <div class="card-header h6 bg-primary text-center text-white">
                            REMARKS HISTORY OF THE CASE 
                            </div>
                            <div class="card card-body">
                            <div class="row">
                            <?php $counter = 1 ?>
                            <?php foreach ($proceedingDetails as $row):?>    
                                <div class="col-lg-6 form-control" >
                                    <div classs="row" style="display:flex">
                                        <div class="col-1 text-center">
                                            <span class="badge bg-success"><?=$counter++.'.'?></span>&nbsp;
                                        </div>
                                        <div class="col-3 text-center">
                                            <span class="text-danger">User Code:</span>&nbsp; 
                                            <?php 
                                                if(substr($row->user_code,0,3) == 'MOU')
                                                    echo "MOUZADAR";
                                                elseif(substr($row->user_code,0,2) == 'CO') 
                                                    echo "CIRCLE OFFICER";
                                                 elseif(substr($row->user_code,0,1) == 'M')
                                                    echo "LOT MANDAL";
                                            ?>; 
                                        </div>
                                        <div class="col-4 text-center">
                                            <span class="text-danger">Remark:</span>&nbsp;<?=$row->remark?>;
                                        </div>
                                        <div class="col-4 text-center">
                                            <span class="text-danger">Dated:</span>&nbsp;<?=$row->created_at?>
                                        </div>
                                    </div>                                                             
                                    </div>
                                 <?php endforeach;?>
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
        <h3 style="text-align:center;background-color: #136a6f; color:white;padding:2px">DUE PAYMENT CALCULATION</h3>
            <div class="card-body" style="border:1px solid grey">
            
                <div class="row mt-1">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-5 text-right">
                                <label class="text-right">
                                    OPENING BALANCE/ ARREAR(RS) <span class="text-danger h4">*</span>
                                </label>            
                            </div>
                            <div class="col-lg-6 text-left">
                                <input type="text" class="form-control" name="openinig_balance" id="openinig_balance"
                                placeholder="-OPENING-BALANCE-" readonly value="<?=$arrearDetails->opening_balance?>">
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
                                placeholder="-CURRENT-REVENUE-" readonly value="<?=$arrearDetails->current_revenue?>">
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
                                    placeholder="-CURRENT-LOCAL-TAX-" readonly value="<?=$arrearDetails->current_local_tax?>">
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
                                <input type="text"  class="form-control" placeholder = "-LAST-PAY-DATE-" 
                                 name="last_pay_date1" readonly value="<?=date('Y-m-d',strtotime($arrearDetails->last_pay_date))?>">
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
                                id="last_revenue_payment_amount" placeholder="-LAST-REVENUE-PAY-AMOUNT-" readonly value="<?=$arrearDetails->last_revenue_payment?>">
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
                                id="last_local_tax_payment_amount" placeholder="LAST-LOCAL-TAX-PAY-AMOUNT" readonly value="<?=$arrearDetails->last_local_tax_payment?>">
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
                <div class="col-lg-12" id="Ek_objection_rmk_form_validation_error_div" style="display:none;">
                    <div class="card-header h5 bg-danger text-white text-center">
                        VALIDATION ERRORS
                    </div>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <strong class="text-center" style="color:red !important"
                            id="Ek_objection_rmk_form_validation_error_msg">
                        </strong>
                    </div>
                </div>
                <!-- validation-error-div-end -->
                <div class="row">
                    <div class="col-lg-12 mt-3 text-center">
                        <button class="btn btn-success btn-sm" onclick="MouzadarObjectionSubmitAfterCOApproval()"
                        style="padding: 5px!important;font-size: 14px;font-weight: bold;">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                SUBMIT
                        </button>
                        <button class="btn btn-warning btn-sm" onclick="objectionCase('<?=$ekbasicDetails->ld_application_no?>')"
                        style="padding: 5px!important;font-size: 14px;font-weight: bold;">
                            <i class="fa fa-exclamation" aria-hidden="true"></i>
                                OBJECTIONS
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
    
<!--  objection model  -->
<div class="modal align-middle" id="Ek_objection_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width:50%">
        <div class="modal-content">
            <div class="modal-header text-white text-bold text-center bg-danger">
                <h5 class="modal-title w-100">
                    <u>
                        OBJECTIONS <br>
                        DISTRICT: <?=$this->utilclass->getDistrictName($ekbasicDetails->dist_code)?>,
                        SUBDIVISION: <?=$this->utilclass->getSubDivName($ekbasicDetails->dist_code, 
                                        $ekbasicDetails->subdiv_code)?>,
                        CIRCLE: <?=$this->utilclass->getCircleName($ekbasicDetails->dist_code, 
                                        $ekbasicDetails->subdiv_code,$ekbasicDetails->cir_code)?>,
                        MOUZA: <?=$this->utilclass->getMouzaName($ekbasicDetails->dist_code, 
                                        $ekbasicDetails->subdiv_code,$ekbasicDetails->cir_code, 
                                        $ekbasicDetails->mouza_pargona_code)?>,
                        LOT: <?=$this->utilclass->getLotName($ekbasicDetails->dist_code, 
                                        $ekbasicDetails->subdiv_code,$ekbasicDetails->cir_code, 
                                        $ekbasicDetails->mouza_pargona_code, $ekbasicDetails->lot_no)?>,
                        VILLAGE: <?=$this->utilclass->getVillageName($ekbasicDetails->dist_code, 
                                        $ekbasicDetails->subdiv_code,$ekbasicDetails->cir_code, 
                                        $ekbasicDetails->mouza_pargona_code, $ekbasicDetails->lot_no,
                                        $ekbasicDetails->vill_townprt_code)?>
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
                                    <textarea class="form-control" placeholder="--Objection-Remark--" rows="3" name="Ek_objection_rmk" id="Ek_objection_rmk"></textarea>
                                </td>
                            </div>
                        </div>
                            <input type="hidden" name="ek_basic_id" id="ek_basic_id" value="<?=$ekbasicDetails->id?>">
                            <input type="hidden" name="application_no" id="application_no" value="<?=$ekbasicDetails->application_no?>">
                            <input type="hidden" name="ld_application_no" id="ld_application_no" value="<?=$ekbasicDetails->ld_application_no?>">
                            <!-- <input type="hidden" name="case_no" id="case_no" value="<?=$ekbasicDetails->case_no?>"> -->
                            <input type="hidden" name="patta_no" id="patta_no" value="<?=$ekbasicDetails->patta_no?>">
                    </form>
                </div>
              
                <!-- validation-errors-div -->
                <div class="col-lg-12" id="Ek_objection_rmk_form_validation_error_div" style="display:none;" >
                    <div class="card-header h5 bg-danger text-white text-center">
                        VALIDATION ERRORS
                    </div>
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
                        <button type="button" class="btn btn-sm btn-success" onclick="EkObjectionFormSubmitProceeding()">
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
