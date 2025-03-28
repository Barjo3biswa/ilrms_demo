<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>css/flora.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datepick.js"></script>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/index'?>">E-Khajana</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">E-Khajana-(Pending-list)</li>
  </ol>
</nav>
<div class="panel panel-info panel-form ">
    <div class="card panel-heading text-white bg-secondary text-center">
        <h4 class="panel-title">
            <u>
                <b>E-Khajna-(Pending-List)</b><br>
            </u>                        
        </h4>
    </div>
    <div class="card panel-heading text-warning bg-dark text-center" style="margin-top:-18px;">
        <h6 class="panel-title">
            <u>
                <b>1.CASES PENDING MORE THAN 7 DAYS IS SHOWN IN RED ZONE
                <br>2.CASES PENDING MORE THAN 5 DAYS IS SHOWN IN YELLOW ZONE </b>
                <br>3.CASES PENDING LESS THAN 4 DAYS IS SHOWN IN GRREN ZONE </b>
            </u>                        
        </h6>
    </div>  
    <div class="tab-content">
        <div class="card-body">
            <div class="card-body shadow-lg p-1 mb-5 bg-white rounded">                              
                <div class = "card-body">            
                    <table id="ek_ast_pending_list_1" class="table table-hover text-center" style="width:100%">            
                        <thead class="thead-dark">                            
			    <tr style="background-color: black; color: #fff;">
                                <td>ZONE</td>
                                <td>RTPS-APPLICATION-NO</td>
                                <td>LAND-DETAILS-APPLICATION-NO</td>
                                <td>VILLAGE-NAME</td>
                                <td>PATTA-NO</td>
                                <td>PATTADAR-NAME</td>
                                <td>Action</td>
                            </tr>                                                        
                        </thead>
                        <tbody>
			    <?php foreach ($pendingList as $row):?> 
                                <?php
                                    $pending_days = $this->EkhajanaMouzadarModel->getPendingDays($row->created_at);
                                    //var_dump($pending_days);
                                    if((int)$pending_days > 7){                                        
                                        $style="font-size:24px;color:red";
                                    }elseif(((int)$pending_days >= 5) && ((int)$pending_days <= 7)){
                                        $style="font-size:24px;color:yellow";
                                    }elseif((int)$pending_days >= 0 && (int)$pending_days <= 4){
                                        $style="font-size:24px;color:green";
                                    }else{
                                        $class = "";

                                    }
                                ?>  
				<tr>
                                    <td><i class="fa fa-circle" style="<?=$style?>" aria-hidden="true"></i></td>
                                    <td>
                                        <span class="font-weight-bolder text-danger">
                                            <?=$row->application_no?>
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-success">
                                            <?=$row->ld_application_no?>
                                        <span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-primary">
                                            <?=$this->utilclass->getVillageName($row->dist_code,
                                            $row->subdiv_code, 
                                            $row->cir_code, $row->mouza_pargona_code, 
                                            $row->lot_no, $row->vill_townprt_code)?>
                                        <span>
                                        
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-danger">
                                            <?=$row->patta_no?>
                                        <span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-success">
                                            <?=$row->pdar_name?>
                                        <span>
                                    </td>
                                    <td>
                                        <a class="btn btn-secondary btn-sm text-white" 
                                            href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/arrearUpdateForm/'.$row->ld_id?>" role="button" style="font-size: 14px;">
                                            Update Payment
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
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
<script src="<?php echo base_url('js/ekhajana/ekhajana_mouzadar.js'); ?>"></script>
