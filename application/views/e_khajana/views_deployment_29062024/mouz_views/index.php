
<div class='container ' style="margin-top:20px">
<div class='row'>
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <div class='col-12 card'>
        <h5 class="text-center" style="color:grey;margin-top:5px">E-Khajana</h5>
    <div class="row" style='margin-top:20px'>				
        <div class="col-lg-12 col-lg-offset-3">
            <div class="panel casedisplay">                        
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <tr class="bg-info" style="background: #17a2b8 !important;text-align:center">
                            <td colspan="3" style="color:white">E-Khajana(Arrear-Update)</td>
                        </tr>
                        <tr>
                            <td>Pending-List</td>
                            <td>
                                <span class="badge bg-warning text-dark"><?=$pendingCount?></span>
                                
                                <!-- <span class="badge bg-warning text-dark"><?=100?></span>                                         -->
                            </td>
                            <td>
                                <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/pendingList' ?>" class="badge bg-success" style="float:right"><?php echo ('GO') ?>&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </td>
                        </tr>
                        <!--<tr>
                            <td>Objection-List</td>
                            <td>
                                <span class="badge bg-info text-dark"><?=$objection_count?></span>
                            </td>
                            <td>
                                <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/objectionList' ?>" class="badge bg-success" style="float:right"><?php echo ('GO') ?>&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </td>
                        </tr>-->
                        <!-- <tr>
                            <td>Re-Updation-List</td>
                            <td>
                                <span class="badge bg-danger text-dark"><?=$re_updation_cases_count?></span>
                            </td>
                            <td>
                                <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/reUpdationList' ?>" class="badge bg-success" style="float:right"><?php echo ('GO') ?>&nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </td>
                        </tr> -->
                    </table>
                </div>
            </div>
        </div>               
    </div>
    </div>
    </div>
    <div class="col-md-3"></div>
    </div>	
</div>