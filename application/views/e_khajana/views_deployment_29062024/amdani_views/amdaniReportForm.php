<style>
@media only screen and (max-width: 750px) {
    .label3 {
    margin-right:29rem;
  }
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
    <li class="breadcrumb-item font-weight-bold active" aria-current="page">Amdani Report</li>
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
                                Amdani Report Form For Mouza : <?=$mouza_name?>
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
                                        <select class="js-single js-states form-control" style="width: 85%" id="patta_numbers" name="patta_no">
                                            <option value="00" selected>-ALL-PATTA-NO-</option>
                                        </select>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right " style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            DATE(FROM-DATE)<span class="text-danger h4">*</span>
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <input autocomplete="off" class="form-control stdate" id="amdani_start_date" type="text" name="start_date" placeholder="dd-mm-yyyy" style="width: 85%">
                                        <span class="help-block">Transaction start from date</span>
                                    </div>
                                </div>                    
                            </div>
                        </div> 
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            DATE(TO-DATE)<span class="text-danger h4">*</span>
                                        </label>
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <input autocomplete="off" class="form-control stdate" id="amdani_end_date" type="text" name="to_date" placeholder="dd-mm-yyyy" style="width: 85%">
                                        <span class="help-block">Transaction upto date</span>
                                    </div>
                                </div>                    
                            </div>
                        </div>
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

<script src="<?php echo base_url('js/ekhajana/ekhajana_amdani.js'); ?>"></script>