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
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarCfr/index'?>">CFR-INDEX</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">ARREAR UPDATION BEFORE MANUAL CFR PAYMENT</li>
  </ol>
</nav>
<div class="col-lg-10 offset-1">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12 col-lg-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading text-center mt-5 bg-danger shadow-lg">
                        <h5 class="panel-title text-white text-center p-3">
                            Arrear For The Follwing Patta Has Not Been Updated, Kindly Update The Arrears For The Following Patta's Before Procceding For Manual CFR Payment. 
                        </h5>
		            </div>
                    <div class="panel-heading text-center bg-info shadow-lg">
                        <h6 class="panel-title text-white text-center p-3">
                            Refresh This Page After Updating The Arrear To Go To The Payment Summary Page.
                        </h6>
		            </div>
                    <?php foreach ($arrear_not_updated_patta_list as $row):?> 
                        <div class="panel-heading text-center bg-dark shadow-lg">
                            <h6 class="panel-title text-white text-center p-2">
                                Kindly Update The Arrear For 
                                Lot: <?=$this->utilclass->getLotName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no)?>
                                Village: <?=$this->utilclass->getVillageName($row->dist_code,$row->subdiv_code,$row->cir_code,$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code)?>,
                                Patta-Type: <?=$this->utilclass->getPattaType($row->patta_type_code)?>,
                                Patta-No: <?=$row->patta_no?>
                            </h6>
                        </div>
                        <div class="panel-heading text-center mt-1 shadow-lg">
                            <h6 class="panel-title text-white text-center p-2">
                                <a target="_arrearUpdate" class="btn btn-success btn-sm" role="button" href="<?php echo base_url() . 'EkhajanaArrearController/preArrearUpdateForm'?>"><i class="fa fa-book fa-fw"></i>&nbsp;CLICK HERE TO UPDATE THE ARREAR</a>    
                            </h6>
                        </div>
                    <?php endforeach;?>     
                </div>
            </div>
        </div>
    </div>
</div>
