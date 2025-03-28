<style type="text/css" media="print">
    @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
        size: landscape; /* for page layout */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }
</style>
<div class="container-fluid form-top login">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12 col-lg-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading text-center mt-5 bg-danger shadow-lg">
                        <h5 class="panel-title text-white text-center p-1">
                            Arrear is not updated for this patta..!
                        </h5>
		            </div>
                    <?php if(isset($pendingCaseDocumentDetails->file_details)):?>
                    <table class="table table-striped table-bordered text-bold" style="margin-bottom:0px;">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center bg-secondary text-white">
                                    <?=$pendingCaseDocumentDetails->file_details?> :
                                    <button class="btn btn-success btn-sm">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        <a href="<?=base_url().'index.php/EkhajanaMouzadarController/document?appl_no='.$ek_land_details->ld_application_no?>"
                                        target="_blank" style="text-decoration:none;color:white;">
                                            Download
                                        </a>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <?php else: ?>
                        <table class="table table-striped table-bordered text-bold" style="margin-bottom:0px;">
                            <thead>
                                <tr>
                                    <th colspan="6" class="text-center bg-dark text-danger">
                                        Last Khajana Receipt Is Not Uploaded For This Patta
                                        (Since It is Not Mandatory From 30-10-2024)
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    <?php endif;?>
                    <div class="panel-heading text-center bg-secondary shadow-lg">
                        <h6 class="panel-title text-white text-center p-2">
                            Kindly Update The Arrear For 
                            Village: <?=$this->utilclass->getVillageName($ek_land_details->dist_code,$ek_land_details->subdiv_code,$ek_land_details->cir_code,$ek_land_details->mouza_pargona_code,$ek_land_details->lot_no,$ek_land_details->vill_townprt_code)?>,
                            Patta-Type: <?=$ek_land_details->patta_type?>,
                            Patta-No: <?=$ek_land_details->patta_no?>
                        </h6>
                    </div>
                    <div class="panel-heading text-center mt-1 shadow-lg">
                        <h6 class="panel-title text-white text-center p-2">
                            <a target="_arrearUpdate" class="btn btn-success btn-sm" role="button" href="<?php echo base_url() . 'EkhajanaArrearController/preArrearUpdateForm'?>"><i class="fa fa-book fa-fw"></i>&nbsp;CLICK HERE TO UPDATE THE ARREAR</a>    
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
