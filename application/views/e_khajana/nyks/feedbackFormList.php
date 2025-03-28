<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>css/flora.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datepick.js"></script>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/Nyks/FeedBackList'?>">Nyks FeedBack</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">FeedBack List</li>
  </ol>
</nav>
<?php
$cat_name = null;
?>
<div class="panel panel-info panel-form ">
    <div class="card panel-heading text-white bg-secondary text-center">
        <h4 class="panel-title">
            <u>
                <b>List Of FeedBack Form</b><br>
            </u>                        
        </h4>
    </div>  
    <div class="tab-content">
        <div class="card-body">
            <div class="card-body shadow-lg p-1 mb-5 bg-white rounded">                              
                <div class = "card-body">            
                    <table id="ek_ast_pending_list_1" class="table table-hover text-center" style="width:100%">            
                        <thead class="thead-dark">                            
			            <tr style="background-color: black; color: #fff;">
                                <td>CIRCLE</td>
                                <td>MOUZA</td>
                                <td>VILLAGE</td>
                                <td>CATEGORY</td>
				                <td>REMARKS</td>                                
                            </tr>                                                        
                        </thead>
                        <tbody>
			            <?php foreach ($nyks_feedback_data as $row):?> 
				            <tr>
                                <td>
                                    <span class="font-weight-bold text-primary">
                                        <?=$this->utilclass->getCircleName($row->dist_code,
                                        $row->subdiv_code,$row->cir_code)?>
                                    <span>
                                </td>
                                <td>
                                    <span class="font-weight-bold text-primary">
                                        <?=$this->utilclass->getMouzaName($row->dist_code,
                                        $row->subdiv_code, 
                                        $row->cir_code, $row->mouza_pargona_code)?>
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
                                <?php
                                if($row->category ==1){
                                    $cat_name = 'MUTATION';
                                }elseif($row->category ==2){
                                    $cat_name = 'NAME CORRECTION';
                                }elseif($row->category ==2){
                                    $cat_name = 'e-KHAJNA';
                                }
                                ?>
                                <td>
                                    <span class="font-weight-bolder text-danger">
                                        <?=$cat_name ?>
                                </td>
                                <td>
                                    <span class="font-weight-bolder text-success">
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
<script src="<?php echo base_url('js/ekhajana/ekhajana_mouzadar.js'); ?>"></script>
