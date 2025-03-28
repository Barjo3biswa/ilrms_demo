<!-- <?= var_dump($ekBasicDetails)?> -->
<link href="<?php echo base_url(); ?>css/select2.css" rel="stylesheet"/>
<script src="<?php echo base_url(); ?>js/select2/select2.js"></script>
<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/sweetalert2.min.css">
<div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 80px;"></div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb p-3 text-white">
        <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/index'?>">E-Khajana</a></li>
        <li class="breadcrumb-item font-weight-bold">
            <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/pendingList'?>">
                E-Khajana-(Pending-list)
            </a>
        </li>
         <li class="breadcrumb-item font-weight-bold active" aria-current="page">E-Khajana-(Jamawasil-Exists-Form)</li>
    </ol>
</nav>
<div class="container-fluid form-top login">
    <div class="row">               
        <div class="col-lg-1"></div>
            <div class="panel col-lg-10" style='padding-right:0px;padding-left:0px;'>
                <div class="card-body">
                <div class="panel panel-info">
                    <div class="panel-heading text-center bg-success">
                        <h3 class="panel-title text-white">
                            ARREAR ALREADY UPDATED FOR THIS PATTA NO 
                        </h3>
                    </div>
                    <!-- <div class="panel-heading bg-warning text-center">
                        <h6 class="panel-title font-weight-bold" style="font-size:14px;">
                            <b>NOTE :</b> AFTER FORWARDING THE CASE, KHAJANA-RECEIPT FOR THE CASE <b>(<?=$ekBasicDetails->case_no?>)</b><br> CAN BE DOWNLOADED.
                        </h6>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-3 text-center">
                        <!-- <button class="btn btn-info btn-sm" onclick="MouzadarJwExistsCaseDispose('<?=$ekBasicDetails->id?>','<?=$ekBasicDetails->dist_code?>')"
                        style="padding: 5px!important;font-size: 14px;font-weight: bold;">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                DISPOSE
                        </button> -->
                        <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/index'?>"
                            class="btn btn-danger btn-sm text-white" role="button" 
                            style="padding: 7px !important;font-size: 14px;font-weight: bold;">
                            <i class="glyphicon glyphicon-remove-sign"></i>
                                BACK TO HOME PAGE 
                        </a>
                    </div>
                    <div class="card p-2 bg-dark text-warning shadow mb-3 mt-3 h6 font-weight-bold text-center">
                            FURTHER PROCESS WILL BE ACTIVATED SOON !!!
                    </div>                 
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('js/ekhajana/ekhajana_mouzadar.js'); ?>"></script>

