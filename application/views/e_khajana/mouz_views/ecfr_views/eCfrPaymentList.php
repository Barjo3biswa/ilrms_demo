<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>css/flora.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datepick.js"></script>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaECFRController/viewECFRList'?>">E-Khajana</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">E-cfr Payment List</li>
  </ol>
</nav>
<div class="panel panel-info panel-form ">
    <div class="card panel-heading text-white bg-warning text-center">
        <h4 class="panel-title">
            <u>
                <b>E-cfr Payment List</b><br>
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
                                <td>RTPS-APPLICATION-NO</td>
                                <td>LAND-DETAILS-APPLICATION-NO</td>
                                <td>VILLAGE-NAME</td>
                                <td>PATTA-NO</td>
                                <td>PATTADAR-NAME</td>
				                <td>Action</td>                                
                            </tr>                                                        
                        </thead>
                        <tbody>
			            <?php foreach ($ecfr_data as $row):?>    
                            <tr>
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
                                <?php if($row->digital_payment_status !='F'):?>
                                <?php $encrytpted_ld_app_no = $this->EkhajanaECFRModel->encryptData($row->ld_application_no);?> 
                                <input type="hidden" id="<?=$row->id?>" value="<?=$encrytpted_ld_app_no?>">
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" onclick="makePayment('<?=$row->id?>')">MAKE PAYMENT</button>
                                </td>
                                <?php else:?>
                                    <td>
                                    <button type="button" disbaled class="btn btn-sm btn-secondary">DIGITAL PAYMENT COMPLETED</button>
                                </td>
                                <?php endif;?>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                        <form id='encFormSubmit' action="<?=EKHAJANA_ECFR_PAYMENT_API_URL.'EkhajanaEcfr/ecfrPayment'?>" method="POST">
                            <input type="hidden" name="enc_data" value="" id="enc_id">
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function makePayment(id)
{
    event.preventDefault();
    var enc_data = $(`#${id}`).val();
    $('#enc_id').val(enc_data);
    document.getElementById("encFormSubmit").submit();
}
</script>
<script src="<?php echo base_url('js/ekhajana/ekhajana_mouzadar.js'); ?>"></script>
