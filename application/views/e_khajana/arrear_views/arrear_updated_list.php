<?php /*
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
 */?>

<link href="<?php echo base_url(); ?>css/dataTables.jqueryui.css" rel="stylesheet"/>
<script src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>


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
                <b>Pre-Updated-Arrear-List</b><br>
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
                                <td>VILLAGE-NAME</td>
                                <td>PATTA-TYPE</td>
                                <td>PATTA-NO</td>
                                <td>TOTAL-ARREAR</td>
                                <td>YEAR-WISE-ARREAR</td>
                            </tr>                                                        
                        </thead>
                        <tbody>
                            <?php foreach ($arrear_list as $row):?> 
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
                                        <span class="font-weight-bolder text-danger">
                                            <?=$row->arrear?>  
                                        <span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bold text-success arrear_list_ins">
                                            <?php if(EDIT_EKHAJANA_PRE_ARREAR == 1):?>
                                            <button class="btn btn-success btn-sm arrear_list_ins_view" onclick="editYearWiseArrear('<?=$row->id?>')"><i class="fa fa-edit" aria-hidden="true"></i> EDIT</button>
                                            <?php endif ?>
                                            <button class="btn btn-primary btn-sm arrear_list_ins_view" onclick="viewYearWiseArrear('<?=$row->id?>')"><i class="fa fa-eye" aria-hidden="true"></i> VIEW</button>
                                            <!-- Modal for arrear editing pre updation starts  -->
                                            <div class="modal align-middle" id="year-wise-arrear-modal-<?=$row->id?>" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered" style="max-width:50%">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-white text-bold text-center bg-success">
                                                            <h5 class="modal-title w-100">
                                                                <u>
                                                                    Pre Updated Arrear Data Year Wise For (Patta No <?=$row->patta_no?>, Village: <?=$this->utilclass->getVillageName($row->dist_code,$row->subdiv_code, $row->cir_code, $row->mouza_pargona_code,$row->lot_no, $row->vill_townprt_code)?>) 
                                                                </u>
                                                            </h5>
                                                        </div>
                                                        <form id="year-wise-modal-edit-<?=$row->id?>">
                                                            <div class="modal-body">
                                                                <div class="form-group text-center" style="max-height:300px;overflow-y: scroll;">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Financial-Year</th>
                                                                                <th scope="col">Revenue</th>
                                                                                <th scope="col">Local Tax</th>
                                                                                <th scope="col">Total</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
					    $year_wise_arrear = $this->EkhajanaArrearModel->getYearWiseArrearDetailsFromArrearId($row->id);
                                                                                if($year_wise_arrear[0]->financial_year == '0000-2000'){
                                                                                    $prior2000Flag = false;
                                                                                }else{
                                                                                    $prior2000Flag = true;
                                                                                }
                                                                                /*
                                                                                $year_wise_arrear_with_priorF_query = $this->db->query("select * from ekhajana_year_wise_arrear where pre_arrear_id=? and financial_year=?",array($row->id, '0000-2000'));
                                                                                    if($year_wise_arrear_with_priorF_query->num_rows() == 0){
                                                                                        $prior2000Flag = true;
                                                                                    }else{
                                                                                        $prior2000Flag = false;
										    }    
                                                                                  */
                                                                            ?>    

                                                                            <?php if($prior2000Flag):?>
                                                                                <tr class="cal_row">
                                                                                    <td class="col-3 text-center p-1 text-primary">
                                                                                        <span style="font-weight:bolder">Prior to 2000</span>
                                                                                    </td>
                                                                                    <td class="arrear " >
                                                                                        <input onkeyup = "plus_a(this)" type ="number" min='0' required class="form-control sec_a" placeholder="Revenue Amount" rows="3" name="year_revenue[0000-2000]" id="revenue_prior">
                                                                                        </input>
                                                                                    </td>
                                                                                    <td class="arrear " >
                                                                                        <input onkeyup = "plus_a(this)" type ="number" min='0' required class="form-control sec_b" placeholder="Local Tax Amount" rows="3" name="year_tax[0000-2000]" id="tax_prior">
                                                                                        </input>
                                                                                    </td>
                                                                                    <td class="arrear " >
                                                                                        <input readonly type ="number" required class="form-control cal_sum" placeholder="Arrear Amount" rows="3" name="year_arrear[0000-2000]" id="arrear_prior">
                                                                                        </input>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endif ?>

                                                                            <?php foreach ($year_wise_arrear as $yarow):?>
                                                                                <tr class="cal_row">
                                                                                    <input type="hidden" name="pre_arrear_id" value="<?=$yarow->pre_arrear_id?>"></input>
                                                                                    <th scope="row"><?=$yarow->financial_year?></th>
                                                                                    <td>
                                                                                        <input type="number" name="year_revenue[<?=$yarow->financial_year?>]" min='0' class="form-control sec_a" style="width:80%" value="<?=$yarow->year_revenue?>"></input>                                                                                                                                                        
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="number" name="year_tax[<?=$yarow->financial_year?>]" min='0' class="form-control sec_b" style="width:80%" value="<?=$yarow->year_tax?>"></input>                                                           
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="text" name="year_arrear[<?=$yarow->financial_year?>]" min='0' class="form-control cal_sum" style="width:80%" readonly value="<?=$yarow->year_arrear?>"></input>                                                                              
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endforeach;?>
                                                                            <tr style="background-color: #bbbbbb; font-weight:bold;">
                                                                                <th scope="row">Total Arrear:</th>
                                                                                <td>Rs<span class="testss"><?=$yarow->total_revenue?></span></td>
                                                                                <input type="hidden" name="total_revenue" value="<?=$yarow->total_revenue?>" class="testss_inp"></td>
                                                                                <td>Rs<span class="testsb"><?=$yarow->total_tax?></span></td>
                                                                                <input type="hidden" name="total_tax"  value="<?=$yarow->total_tax?>" class="testsb_inp"></td>
                                                                                <td>Rs<span class="testsc"><?=$yarow->total_arrear?></span></td>
                                                                                <input type="hidden" name="total_arrear" value="<?=$yarow->total_arrear?>" class="testsc_inp"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <!-- validation-errors-div -->
                                                            <div class="col-lg-12 ek_arrear_pre_updation_edit_validation_error_div" id="" style="display:none" >
                                                                <div class="alert alert-warning alert-dismissible" role="alert">
                                                                    <strong class="text-center ek_arrear_pre_updation_edit_validation_error_msg" style="color:red !important"
                                                                        >
                                                                    </strong>
                                                                </div>
                                                            </div>
                                                            <!-- validation-error-div-end -->

                                                            <div class="row" align="center" style="padding:10px;">
                                                                <div class="col-lg-12" align="center">
                                                                    <button type="button" class="btn btn-sm btn-danger" onclick="yearWiseArrearModalClose('<?=$row->id?>')">
                                                                        <i class="glyphicon glyphicon-remove-sign"></i>
                                                                            Close
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-success" onclick="submitYearWiseArrearEditData('<?=$row->id?>')">
                                                                        <i class="glyphicon glyphicon-remove-sign"></i>
                                                                            Submit Edited Data
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal for arrear editing pre updation ends -->
                                            <!-- Modal for arrear viewing pre updation starts  -->
                                            <div class="modal align-middle" id="view-year-wise-arrear-modal-<?=$row->id?>" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered" style="max-width:50%">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-white text-bold text-center bg-success">
                                                            <h5 class="modal-title w-100">
                                                                <u>
                                                                    Pre Updated Arrear Data Year Wise For (Patta No <?=$row->patta_no?>, Village: <?=$this->utilclass->getVillageName($row->dist_code,$row->subdiv_code, $row->cir_code, $row->mouza_pargona_code,$row->lot_no, $row->vill_townprt_code)?>) 
                                                                </u>
                                                            </h5>
                                                        </div>
                                                        <form id="year-wise-modal-edit-<?=$row->id?>">
                                                            <div class="modal-body">
                                                                <div class="form-group text-center" style="max-height:300px;overflow-y: scroll;">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Financial-Year</th>
                                                                                <th scope="col">Revenue</th>
                                                                                <th scope="col">Local Tax</th>
                                                                                <th scope="col">Total</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                                //$year_wise_arrear = $this->EkhajanaArrearModel->getYearWiseArrearDetailsFromArrearId($row->id);
                                                                                
                                                                            ?>    
                                                                            
                                                                            <?php foreach ($year_wise_arrear as $yarow):?>
                                                                                <tr class="cal_row">
                                                                                    <input type="hidden" name="pre_arrear_id" value="<?=$yarow->pre_arrear_id?>"></input>
                                                                                    <th scope="row"><?=$yarow->financial_year?></th>
                                                                                    <td>
                                                                                        <?=$yarow->year_revenue?>                                                                                                                                                        
                                                                                    </td>
                                                                                    <td>
                                                                                        <?=$yarow->year_tax?>                                                         
                                                                                    </td>
                                                                                    <td>
                                                                                        <?=$yarow->year_arrear?>                                                                              
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endforeach;?>
                                                                            <tr style="background-color: #bbbbbb; font-weight:bold;">
                                                                                <th scope="row">Total Arrear:</th>
                                                                                <td>Rs<span></span><?=$yarow->total_revenue?></td>
                                                                    
                                                                                <td>Rs<span ></span><?=$yarow->total_tax?></td>
                                                                                
                                                                                <td>Rs<span ></span><?=$yarow->total_arrear?></td>
                                                                                
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row" align="center" style="padding:10px;">
                                                                <div class="col-lg-12" align="center">
                                                                    <button type="button" class="btn btn-sm btn-danger" onclick="yearWiseArrearModalClose('<?=$row->id?>')">
                                                                        <i class="glyphicon glyphicon-remove-sign"></i>
                                                                            Close
                                                                    </button>
                                            
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal for arrear viewing pre updation ends -->
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
<script src="<?php echo base_url('js/ekhajana/ekhajana_arrear.js'); ?>"></script>

<script>
    var arrearInsClosest = '';
    $(document).on('click', '.arrear_list_ins_view', function(){
        arrearInsClosest = $(this).closest('.arrear_list_ins');
    });

    $('.sec_a, .sec_b').on('keyup', function(){
        const closest = $(this).closest('.cal_row');
        cal_sum(closest);
    });

function cal_sum(closestEl){
    let a = $('.sec_a', closestEl).val(); 
    let b = $('.sec_b', closestEl).val();
    if(a === NaN){
        a = 0;
    }
    if(b === NaN){
        b = 0;
    }
    let total = parseFloat(a) + parseFloat(b);
    $('.cal_sum', closestEl).val(total);
    get_total();
}

function get_total(){
    let totalSecA = 0;
    let totalSecB = 0;
    let totalSecC = 0;
    let total = 0;
    $('.sec_a', arrearInsClosest).each(function() {
        // console.log($(this).val());
        if($(this).val() != '' && $(this).val() !== NaN){
            totalSecA = totalSecA + parseFloat($(this).val());
            console.log(totalSecA);   
        }

    });
    
    $('.sec_b', arrearInsClosest).each(function() {
        if($(this).val() != '' && $(this).val() !== NaN){
            totalSecB = totalSecB + parseFloat($(this).val());
        }
    });  
    $('.cal_sum', arrearInsClosest).each(function() {  
        if($(this).val() != '' && $(this).val() !== NaN){
            totalSecC = totalSecC + parseFloat($(this).val());
        }
    });

    $('.testss', arrearInsClosest).text(totalSecA);
    $('.testsb', arrearInsClosest).text(totalSecB);
    $('.testsc', arrearInsClosest).text(totalSecC);
    $('.testss_inp', arrearInsClosest).val(totalSecA);
    $('.testsb_inp', arrearInsClosest).val(totalSecB);
    $('.testsc_inp', arrearInsClosest).val(totalSecC);
}
</script>
