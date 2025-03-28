<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>css/flora.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datepick.js"></script>
<nav aria-label="breadcrumb">
  
</nav>
<div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 80px;"></div>
<div class="panel panel-info panel-form ">
   
<div class="container-fluid login form-top">
    <form action="" id="">
        <!-- Application Details -->
        
        <!-- working -->
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-danger panel-form">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="text-align: center; font-weight: bold;">
                                <span>Land Class Change Details</span>                                
                            </h3>
                            <h3 class="panel-title mt-1" style="text-align: center; font-weight: bold;">                                
                                <span><kbd> (Case-No : <?=$caseDetails->petition_no?>) </kbd></span>
                            </h3>
                        </div>
                        <div class="panel-body" style="font-size:18px!important;">
                            <table class="table table-striped table-bordered">
                                
                                <tr>
                                    <td>Mouza Name: <?=$this->utilclass->getMouzaName($caseDetails->dist_code,$caseDetails->subdiv_code,$caseDetails->cir_code,$caseDetails->mouza_pargona_code)?></td>
                                    <td>Lot Name: <?=$this->utilclass->getLotName($caseDetails->dist_code,$caseDetails->subdiv_code,$caseDetails->cir_code,$caseDetails->mouza_pargona_code,$caseDetails->lot_no)?></td>
                                    <td>Village Name: <?=$this->utilclass->getVillageName($caseDetails->dist_code,$caseDetails->subdiv_code,$caseDetails->cir_code,$caseDetails->mouza_pargona_code,$caseDetails->lot_no,$caseDetails->vill_townprt_code)?></td>
                                </tr>
                            </table>

                            <table class="table table-striped table-bordered">
                                <th colspan="6" class="text-center bg-info">
                                    Land Information
                                </th>
                                <tr class="bg-secondary">
                                    <td>Patta No</td>
                                    <td>Patta Type</td>
                                    <td>Dag No</td>
                                </tr>
                                <tr class="">
                                    <td><?=$caseDetails->patta_no?></td>
                                    <td><?=$this->utilclass->getPattaType($caseDetails->patta_type_code)?></td>
                                    <td><?=$caseDetails->dag_no?></td>
                                
                                </tr>
                            </table>  

                            <table class="table table-striped table-bordered">
                                <th colspan="6" class="text-center bg-warning">
                                    Class Change Information
                                </th>
                                <tr class="bg-secondary">
                                    <td>Existing Land Class</td>
                                    <td>Proposed Land Class by Mouzadar</td>
                                    
                                </tr>
                                <tr class="">
                                    <td><?=$this->utilclass->getLandClassCode($caseDetails->dist_code,$caseDetails->existing_land_class)?></td>
                                    <td><?=$this->utilclass->getLandClassCode($caseDetails->dist_code,$caseDetails->proposed_land_class)?></td>
                                </tr>
                            </table>    

                            <table class="table table-striped table-bordered">
                                <th colspan="6" class="text-center bg-success">
                                   Remark By Mouzadar
                                </th>
                                <tr class="bg-secondary">
                                    <td>Mouzadar Name</td>
                                    <td>Remark</td>
                                    <td>Date of Entry</td>
                                </tr>
                                <tr class="">
                                    <td><?=$caseDetails->mouzadar_name?></td>
                                    <td><?=$caseDetails->mouzadar_remark?></td>
                                    <td><?=$caseDetails->date_entry?></td>
                                </tr>
                            </table>                        
                                            
                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script src="<?php echo base_url(); ?>application/views/js/e_khajana/ekhajana_co.js"></script>

