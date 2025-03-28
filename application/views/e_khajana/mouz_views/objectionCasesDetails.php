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
            <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/objectionApplicationList'?>">
                E-Khajana-(Objection List)
            </a>
        </li>
         <li class="breadcrumb-item font-weight-bold active" aria-current="page">E-Khajana-(Objection Case Details)</li>
    </ol>
</nav>
<?php
    $status = "";
    if($objectionCasesDetails['result']['ek_basic_row']->status == "MOU_F"){
        $status = "PENDING AT CIRCLE-OFFICE";
    }elseif($objectionCasesDetails['result']['ek_basic_row']->status == "MLM_F"){
        $status = "PENDING AT CIRCLE-OFFICE";
    }elseif($objectionCasesDetails['result']['ek_basic_row']->status == "R"){
        $status = "REJECTED";
    }elseif($objectionCasesDetails['result']['ek_basic_row']->status == "F"){
        $status = "APPLICATION DISPOSED";
    }elseif($objectionCasesDetails['result']['ek_basic_row']->status == "L"){
        $status = "REVERTED BACK";
    }elseif($objectionCasesDetails['result']['ek_basic_row']->status == "COM_F"){
        $status = "PENDING WITH CIRCLE-OFFICER";
    }elseif($objectionCasesDetails['result']['ek_basic_row']->status == "M_OBJ"){
        $status = "OBJECTION BY MOUZADAR";
    }else{
        $status ="PENDING";
    }
?>
    <div class="row" style='margin-top:20px'>               
        <div class="col-lg-1"></div>
        <div class="panel col-lg-10" style='padding-right:0px;padding-left:0px;'>
            <div class="card-header h5 bg-danger text-white text-center">
            <i class='fas fa-info-circle'></i>  <span>E-Khajana Objection Cases Detail</span>
            </div>  
            <div class="card-header h6 text-white text-center" style="background-color: #136a6f; ">
                <span><kbd> (Application-No : <?=$objectionCasesDetails['result']['ek_basic_row']->application_no?>) </kbd></span>
            </div>
            <div class="card card-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>District Name: <?=$this->utilclass->getDistrictName($objectionCasesDetails['result']['ek_basic_row']->dist_code)?></td>
                        <td>Subdivision Name: <?=$this->utilclass->getSubDivName($objectionCasesDetails['result']['ek_basic_row']->dist_code,$objectionCasesDetails['result']['ek_basic_row']->subdiv_code)?></td>
                        <td>Circle Name: <?=$this->utilclass->getCircleName($objectionCasesDetails['result']['ek_basic_row']->dist_code,$objectionCasesDetails['result']['ek_basic_row']->subdiv_code,$objectionCasesDetails['result']['ek_basic_row']->cir_code)?></td>
                    </tr>
                    <tr>
                        <td>Mouza Name: <?=$this->utilclass->getMouzaName($objectionCasesDetails['result']['ek_basic_row']->dist_code,$objectionCasesDetails['result']['ek_basic_row']->subdiv_code,$objectionCasesDetails['result']['ek_basic_row']->cir_code,$objectionCasesDetails['result']['ek_basic_row']->mouza_pargona_code)?></td>
                        <td>Lot Name: <?=$this->utilclass->getLotName($objectionCasesDetails['result']['ek_basic_row']->dist_code,$objectionCasesDetails['result']['ek_basic_row']->subdiv_code,$objectionCasesDetails['result']['ek_basic_row']->cir_code,$objectionCasesDetails['result']['ek_basic_row']->mouza_pargona_code,$objectionCasesDetails['result']['ek_basic_row']->lot_no)?></td>
                        <td>Village Name: <?=$this->utilclass->getVillageName($objectionCasesDetails['result']['ek_basic_row']->dist_code,$objectionCasesDetails['result']['ek_basic_row']->subdiv_code,$objectionCasesDetails['result']['ek_basic_row']->cir_code,$objectionCasesDetails['result']['ek_basic_row']->mouza_pargona_code,$objectionCasesDetails['result']['ek_basic_row']->lot_no,$objectionCasesDetails['result']['ek_basic_row']->vill_townprt_code)?></td>
                    </tr>
                </table>
            </div>
            <div class="card-header h6 text-white text-center" style="background-color: #136a6f; ">
            <i class='fas fa-user-alt'></i>  Pattadar Information
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
                        <td><?=$objectionCasesDetails['result']['ek_basic_row']->pdar_name?></td>
                        <td><?=$objectionCasesDetails['result']['ek_basic_row']->pdar_father_name?></td>
                        <td><?=$objectionCasesDetails['result']['ek_basic_row']->mobile_no?></td>
                        <td><?=$objectionCasesDetails['result']['ek_basic_row']->patta_type?></td>
                        <td><?=$objectionCasesDetails['result']['ek_basic_row']->patta_no?></td>
                    </tr>
                </table>
            </div>
            <?php $authType =$objectionCasesDetails['result']['ek_basic_row']->aadhaar_pan_type?>
            <div class="card-header h6 text-white text-center" style="background-color: #136a6f; ">
            <i class='fas fa-file-alt'></i>  Applicant Details From  <?=$authType?> Card
            </div>
            <div class="card card-body">
                <table class="table table-bordered">                
                    <tr>
                    <?php if($authType =="PAN"):?>
                            <td class="text-danger font-weight-bold"><b>Name(English)</b></td>
                            <td><?=$objectionCasesDetails['result']['ek_basic_row']->applicant_name_eng?></td>
                            <td class="text-danger font-weight-bold"><b>Name(Assamese)</b></td>
                            <td><?=$objectionCasesDetails['result']['ek_basic_row']->pdar_name?></td>
                    <?php elseif ($authType =="AADHAAR"):?> 
                            <td class="text-danger font-weight-bold"><b>Name(English)</b></td>
                            <td><?=$objectionCasesDetails['result']['ek_basic_row']->applicant_name_eng?></td>
                            <td class="text-danger font-weight-bold"><b>Name(Assamese)</b></td>
                            <td><?=$objectionCasesDetails['result']['ek_basic_row']->pdar_name?></td>
                    <?php endif ?> 
                    </tr>
                    <tr>
                        <td class="text-danger font-weight-bold"><b>Guardian Relation</b></td>
                        <td><?=$this->utilclass->getRelationFromDb($objectionCasesDetails['result']['ek_basic_row']->guardian_relation,$objectionCasesDetails['result']['ek_basic_row']->dist_code)?></td>
                        <td class="text-danger font-weight-bold"><b>Guardian Name(Assamese)</b></td>
                        <td><?=$objectionCasesDetails['result']['ek_basic_row']->guardian_name_asm?></td>
                    </tr>
                    <tr>
                        <td class="text-danger font-weight-bold"><b>Date Of Birth</b></td>
                        <td><?=$objectionCasesDetails['result']['ek_basic_row']->date_of_birth?></td>
                        <td class="text-danger font-weight-bold"><b>Address</b></td>
                        <td><?=$objectionCasesDetails['result']['ek_basic_row']->address?></td>
                    </tr>
                </table>	
            </div>  
            <h4 style="text-align:center;background-color: #136a6f; color:white;padding:1px"><i class='fas fa-calendar-check'></i>  Current Status</h4> 
            <table class="table table-bordered mb-5">                
                <tr>
                    <td class="text-danger font-weight-bold"><b>Revenue</b></td>
                    <td><?=$objectionCasesDetails['result']['revenue']?></td>
                    <td class="text-danger font-weight-bold"><b>Local Tax</b></td>
                    <td><?=$objectionCasesDetails['result']['local_tax']?></td>
                </tr>
                <tr>
                    <td class="text-danger font-weight-bold"><b>Arrear</b></td>
                    <td><?=$objectionCasesDetails['result']['arrear']?></td>
                    <td class="text-danger font-weight-bold"><b>Total Amount</b></td>
                    <td><?=$objectionCasesDetails['result']['revenue'] + $objectionCasesDetails['result']['local_tax'] + $objectionCasesDetails['result']['arrear']?></td>
                </tr>
                <tr>
                    <td class="text-danger font-weight-bold"><b>Status Of Application </b></td>
                    <?php if($status == 'REJECTED'):?>  
                    <td><b><span style="background-color:#f5372a;color:white"><?=$status?></span></b></td>
                    <?php else: ?>
                    <td><b><span style="background-color:yellow"><?=$status?></span></b></td>
                    <?php endif ;?>
                    <td class="text-danger font-weight-bold"><b>Date of Application received</b></td>
                    <td><?=$objectionCasesDetails['result']['ek_basic_row']->created_at?></td>
                </tr>
                <tr>
                    <td colspan="2">Reasons of Objection</td>
                    <td colspan="2"><?=$objectionCasesDetails['result']['ek_basic_row']->objection_remark?></td>
                </tr>
            </table>
        </div>  
    </div>
    </div>

    <center>
    <a class="btn btn-danger btn-sm text-white mb-5" 
        href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/objectionApplicationList'?>" role="button" style="font-size: 14px;">
        <i class="fa fa-home"></i> BACK &nbsp;&nbsp;
    </a>
    
    </center>
    
                     
                               
<script src="<?php echo base_url('js/ekhajana/ekhajana_mouzadar.js'); ?>"></script>
