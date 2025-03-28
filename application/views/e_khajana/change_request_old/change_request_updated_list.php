<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>css/flora.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datepick.js"></script>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaArrearController/index'?>">index</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">Pre-Updated-Arrear-List</li>
  </ol>
</nav>
<div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 80px;"></div>
<div class="panel panel-info panel-form ">
    <div class="card panel-heading text-white bg-secondary text-center">
        <h4 class="panel-title">
            <u>
                <b>Change-Request-List</b><br>
            </u>                        
        </h4>
        <h6 class="p-2 text-white shadow text-center" style="background-color:#176363">
            <?php echo $this->lang->line('district')?>: <?= $dist_name?>,
            <?php echo $this->lang->line('subdivision')?>: <?= $subdiv_name?>,
            <?php echo $this->lang->line('circle')?>: <?= $cir_name?>,
            Mouza: <?= $mouza_name?>
        </h6>
    </div> 
    <div class="tab-content">
        <div class="card-body">
            <div class="card-body shadow-lg p-1 mb-5 bg-white rounded">                              
                <div class = "card-body">            
                    <table id="ek_ast_pending_list_1" class="table table-hover text-center" style="width:100%">            
                        <thead class="thead-dark">                            
                            <tr style="background-color: black; color: #fff;">
                                <td>VILLAGE-NAME</td>
                                <td>PATTA-TYPE</td>
                                <td>PATTA-NO</td>
                                <td>DAG-NO</td>
                                <td>EXISTING-LAND-CLASS</td>
                                <td>LAND-CLASS-USED-AS</td>
                                <td>REMARK</td>
                            </tr>                                                        
                        </thead>
                        <tbody>
                            <?php foreach ($changeReqList as $row):?> 
                                <tr>
                                    <td>
                                        <span class="font-weight-bolder text-danger">
                                            <?=$this->utilclass->getVillageName($row->dist_code,
                                            $row->subdiv_code, 
                                            $row->cir_code, $row->mouza_pargona_code, 
                                            $row->lot_no, $row->vill_townprt_code)?>
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-success">
                                            <?=$this->utilclass->getPattaType($row->patta_type_code)?>
                                        <span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-primary">
                                            <?=$row->patta_no?>
                                        <span>                                        
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-primary">
                                            <?=$row->dag_no?>
                                        <span>                                        
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-primary">
                                            <?=$row->exisiting_land_class_name?>
                                        <span>                                        
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-primary">
                                            <?=$row->proposed_land_class_name?>
                                        <span>                                        
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-primary">
                                            <?=$row->remark?>
                                        <span>                                        
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

