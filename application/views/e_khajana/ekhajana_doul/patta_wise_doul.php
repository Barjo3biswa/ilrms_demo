<style>
    .casedisplay_new {
        min-height: 395px !important;
        background-color: #B192E6;
    }
    .thead_color{
        background-color:#292409!important;
        color:white!important;
    }

</style>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
    <li class="breadcrumb-item font-weight-bold active"  aria-current="page">Patta Wise Doul</li>
  </ol>
</nav>
<center>
<div class="row" style='margin-top:20px;margin-left:4rem'>				
    <div class="col-lg-10">
        <div class="panel casedisplay_new shadow-lg p-3 mb-5">                        
            <div class="panel-body">
                <div class="row">
                    <div class="" style="background-color:#907E17">
                        <div class="text-center text-white">
                            <h5><i class="fa fa-money" aria-hidden="true"></i>
                               Patta Wise Doul Demand 
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover" >
                <tr>
                    <td>District</td>
                    <td><?=$this->utilclass->getDistrictName($dist_code)?></td>
                    <td>Subdivison:</td>
                    <td><?=$this->utilclass->getSubDivName($dist_code, $subdiv_code)?></td>
                </tr>
               
                <tr>
                    <td>Circle:</td>
                    <td><?=$this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code)?></td>
                    <td>Mouza:</td>
                    <td><?=$this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code,$mouza_pargona_code)?></td>
                </tr>
                
                <tr>
                    <td>Lot No:</td>
                    <td><?=$this->utilclass->getLotName($dist_code, $subdiv_code, $cir_code,$mouza_pargona_code,$lot_no)?></td>
                    <td>Village:</td>
                    <td><?=$this->utilclass->getVillageName($dist_code, $subdiv_code, $cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code)?></td>
                </tr>
              
                <tr>
                    <td>Patta Type:</td>
                    <td><?=$this->utilclass->getPattaType($patta_type_code)?></td>
                    <td>Patta No:</td>
                    <td><?=$patta_no?></td>
                </tr>
                <tr >
                    <td class="text-center" style="color:red" colspan="4">DOUL DEMAND:</td>
                    
                </tr>
                <?php if($current_doul_demand!= "NO-DEMAND-FOUND"):?>
                <tr>
                    <td>Revenue :  <strong>₹ <?=$current_doul_demand->dag_revenue?></strong></td>
                    
                    <td>Local Tax: <strong>₹ <?=$current_doul_demand->dag_local_tax?></strong></td>

                    <td colspan ="2">Total : <strong>₹ <?=$current_doul_demand->dag_local_tax + $current_doul_demand->dag_revenue?></strong></td>
                </tr>
                <?php else:?>
                    <tr>
                    <td>Revenue :  <strong>₹ <?=$current_doul_demand?></strong></td>
                    
                    <td>Local Tax: <strong>₹ <?=$current_doul_demand?></strong></td>

                    <td colspan ="2">Total : <strong>₹ <?=$current_doul_demand?></strong></td>
                </tr>
                <?php endif;?>

               
                
            </table>
        </div>
    </div>               
</div>
</center>

