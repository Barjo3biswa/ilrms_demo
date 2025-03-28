<div class="container-fluid form-top login">
    <div class="col-lg-12 col-lg-offset-2">
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center" style="margin-bottom:0px!important;">
                    SELECT LOCATION
                </h5>
                <h6 class="bg-info p-2 text-white shadow text-center">
                    <?php echo $this->lang->line('district')?>: <?= $dist_name?>,
                    <?php echo $this->lang->line('subdivision')?>: <?= $subdiv_name?>,
                    <?php echo $this->lang->line('circle')?>: <?= $cir_name?>,
                    Mouza: <?= $mouza_name?>
                </h6>
                <div class="card-text mt-2 lm-report">
                    <form class='form-horizontal' target="_blank"  method="post" action="<?php echo base_url() . 'index.php/EkhajanaDoulController/getDoulDemandPattaWise' ?>">
                        <input type='hidden' name="dist_code" value="<?=$dist_code?>" id="dist_code">
                        <input type='hidden' name="subdiv_code" value="<?=$subdiv_code?>" id="subdiv_code">
                        <input type='hidden' name="cir_code" value="<?=$cir_code?>" id="cir_code">
                        <input type='hidden' name="mouza_code" value="<?=$mouza_pargona_code?>" id="mouza_code">
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                                    <?php echo $this->lang->line('vill_town')?>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-control" id="select" required name="village">
                                        <option disabled selected>--SELECT-VILLAGE-NAME--</option>
                                        <?php foreach ($village_list as $vill):?>
                                            <option value="<?=$vill->lot_no.','.$vill->vill_townprt_code?>"><?=$vill->loc_name?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                                    <?php echo $this->lang->line('patta_type')?>
                                </div>
                                <div class="col-sm-4">
                                <select class="form-control pattatypeselect1" id="select" required name="patta_type">
                                    <option disabled selected>--SELECT-PATTA-TYPE--</option>
                                    <?php                                    
                                    foreach ($patta as $p): 
                                        $type_code=$p->type_code;
                                        $patta_type=$p->patta_type;
                                    ?>                              
                                    <option value="<?php echo $type_code; ?>"><?php echo $patta_type; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4" style="text-align:right; font-weight:bold;">
                                    <?php echo $this->lang->line('patta_no')?>
                                </div>
                                <div class="col-sm-4"> 
                      				<input type="text" class="form-control" name="patta_no" placeholder="--ENTER-PATTA-NO--" required ></div><size=4><b>                             
                                </div>
                            </div>
                            <div class="row mb-3">
                            <hr>
                            <div class="text-center">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4"></div>
                                        <div class="col-4" style="text-align:center">
                                            <div class="col-sm-12 col-lg-offset-6" style="display:flex" >
                                                <button type="submit" class="btn uni_text btn-success"><i class='fa fa-check'></i>&nbsp;<?="GET DOUL DEMAND"?></button>
                                                <button id="MainIndex" class="btn uni_text btn-danger"><i class='fa fa-home'></i>&nbsp;<?="BACK"?></button>
                                            </div>
                                        </div>
                                        <div class="col-4"></div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script src="<?php echo base_url('js/ekhajana/jamawasil.js'); ?>"></script>



                        
               
                            
                        
               
                        

    
