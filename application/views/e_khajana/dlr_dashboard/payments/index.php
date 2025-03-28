<style type="text/css">
  .card-body{  background: #7b4397; /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #7b4397, #dc2430); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #7b4397, #dc2430); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */);}
  #circle {
    background: #0f546a;
    border-radius: 30%;
    padding: 7px !important;
    font-weight: bold;
    font-size: 2em;
    }
    .btn-success:hover{
        background-color:#086320;
        border-color:#086320;
    }
</style>

<div class="container-fluid mb-5">
    <!-- total payments calculations -->
    <div class="col-lg-12 mt-3 mb-3" style="border:3px solid #96907e; border-radius:5px">
        <div class="text-warning bg-dark p-1 shadow-lg col-lg-12 text-center" 
        style="border:3px solid #96907e; border-radius:5px;background: linear-gradient(268deg, rgb(119 255 0) 0%, rgb(0 0 0) 50%, rgb(0 102 255) 100%);">
            <h6>e-Khazana Payments Summary</h6>
        </div>
        <div class="row ">
            <div class="col-lg-6">
                <div class="card">
                    <div class=" card-body text-white">
                        <i class="fa fa-inr" aria-hidden="true"></i> Amount Received (Till Now,Including e-CFR) <kbd id=''>Rs <?=$total_amt_rcv+round($total_cash_in_hand,2)?></kbd>   
                    </div>                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-white">
                        <i class="fa fa-inr" aria-hidden="true"></i> Amount Received (Till The Day Before Yesterday) <kbd id=''>Rs <?=$total_amt_rcv_dby?></kbd>   
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-white">                
                        <i class="fa fa-inr" aria-hidden="true"></i> Amount Received (Yesterday) <kbd id=''>Rs <?=$total_amt_rcv_y?></kbd>  
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <?php
                   $percentage_of_demand = round(($total_2024_year_amount/$total_non_dp_demand_2024)*100,4); 
                ?>
                <div class="card">
                    <div class="card-body text-white">
                        <i class="fa fa-inr"></i> Total Cash In Hand With Mouzadars <kbd id=''>Rs <?=round($total_cash_in_hand,2)?></kbd>  
                    </div>
                </div>
            </div>
        </div>
        <hr style="margin-bottom:2px;margin-top:2px;">
        <div class="col-lg-12 mb-3 mt-3">
            <div class="row">
                <div class="col-2" ></div>
                <div class="col-8 text-white p-1 font-weight-bold shadow-lg mb-2" style="text-align:center;background: linear-gradient(268deg, rgb(163 163 163) 0%, rgb(0 0 0) 50%, rgb(0 220 255) 100%);">
                    <i class="fa fa-inr" aria-hidden="true"></i> Total Non Dp Doul Demand Of Current Revenue Year(2024) : Rs <?=$total_non_dp_demand_2024?>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row">
                <div class="col-2" ></div>
                <div class="col-8 text-white p-1 font-weight-bold shadow-lg" style="text-align:center;background: linear-gradient(268deg, rgb(163 163 163) 0%, rgb(0 0 0) 50%, rgb(232 255 0) 100%);">
                    <i class="fa fa-inr" aria-hidden="true"></i> Total Current Revenue Year Amount Received(July,2024 Onwards) : Rs <?=round($total_2024_year_amount,2)?>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
    <!-- mouzadari area report -->
    <div class="col-lg-12 mt-2 mb-3" style="border:3px solid #96907e; border-radius:5px">
        <div class="text-warning bg-dark p-1 shadow-lg col-lg-12 text-center" 
            style="border:3px solid #96907e; border-radius:5px;background: linear-gradient(268deg, rgb(119 255 0) 0%, rgb(0 0 0) 50%, rgb(0 102 255) 100%);">
            <h6>e-Khazana Payments(Mouzadari-Area) Summary</h6>
        </div>
        <div class="row">
            <div class="col-lg-3" style="padding:25px;">
		<div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg">
                    <i class="fa fa-inr" aria-hidden="true"></i>Total Amount Received Including eCFR <br><kbd id=''>Rs <?=$total_amt_rcv_mouz_area+round($total_cash_in_hand,2)?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">

		    <i class="fa fa-inr" aria-hidden="true"></i>Digital Amount Received (Till Now) <br><kbd id=''>Rs <?=$total_amt_rcv_mouz_area?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php /*
		    <i class="fa fa-inr" aria-hidden="true"></i> Amount Received (Till The Day Before Yesterday) <br><kbd id=''>RS <?=$total_amt_rcv_dby_mouz_area?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">
                    */?>
                    <i class="fa fa-inr" aria-hidden="true"></i> Amount Received (Yesterday) <br><kbd id=''>Rs <?=$total_amt_rcv_y_mouz_area?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">                    
                </div>                
            </div>
            <div class="col-lg-5">
                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
            </div>              
            <div class="col-lg-2" style="padding:16px;">
                <div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg bg-success text-white">
                    Top Performing 3 Mouza<br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php foreach ($getBestPerformingMouzaTN as $row):?> 
                        <kbd id=''><?=$row['mouza_name']?>,<?=$row['district_name']?></kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php endforeach;?>
                    <?php if(count($getBestPerformingMouzaTN) == 1):?>
                        <kbd id=''>----</kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                        <kbd id=''>----</kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php endif;?>
                    <?php if(count($getBestPerformingMouzaTN) == 2):?>
                        <kbd id=''>----</kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php endif;?>
                </div>
            </div>  
            <div class="col-lg-2" style="padding:16px;">             
                <div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg bg-danger text-white">
                    Least Performing 3 Mouza<br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php foreach ($getLeastPerformingMouza as $row):?> 
                        <kbd id=''><?=$row['mouza_name']?>,<?=$row['district_name']?></kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php endforeach;?>
                </div>                
            </div>
        </div>
        <hr style="margin-bottom:2px;margin-top:2px;">
        <div class="col-lg-12 mb-3 mt-3">
            <div class="row">
                <div class="col-2" ></div>
                <div class="col-8" style="text-align:center">
                <a href="<?php echo base_url(); ?>index.php/EkhajanaDlrDashboard/viewDistWiseMouzdarAreaPayments" target="_distMou">
                    <button class="btn btn-success shadow-lg btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i> CLICK HERE TO VIEW DISTRICT WISE DATA</button>
                </a>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
    <!-- tehsildari area report -->
    <div class="col-lg-12 mt-2 mb-3" style="border:3px solid #96907e; border-radius:5px">
        <div class="text-warning bg-dark p-1 shadow-lg col-lg-12 text-center" 
        style="border:3px solid #96907e; border-radius:5px;background: linear-gradient(268deg, rgb(119 255 0) 0%, rgb(0 0 0) 50%, rgb(0 102 255) 100%);">
            <h6>e-Khazana Payments(Tehsildari-Area)</h6>
        </div>
        <div class="row">
            <div class="col-lg-3" style="padding:25px;">
                <div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg">
                    <i class="fa fa-inr" aria-hidden="true"></i> Amount Received (Till Now) <br><kbd id=''>Rs <?=$total_amt_rcv_teh_area?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">
                    <i class="fa fa-inr" aria-hidden="true"></i> Amount Received (Till The Day Before Yesterday) <br><kbd id=''>RS <?=$total_amt_rcv_dby_teh_area?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">
                    <i class="fa fa-inr" aria-hidden="true"></i> Amount Received (Yesterday) <br><kbd id=''>Rs <?=$total_amt_rcv_y_teh_area?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">                    
                </div>                
            </div>
            <div class="col-lg-5">
                <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
            </div>              
            <div class="col-lg-2" style="padding:16px;">
                <div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg bg-success text-white">
                    Top Performing 3 Circles<br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php foreach ($getBestPerformingCircleTN as $row):?> 
                        <kbd id=''><?=$row['circle_name']?>,<?=$row['district_name']?></kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php endforeach;?>
                    <?php if(count($getBestPerformingCircleTN) == 0):?>
                        <kbd id=''>----</kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                        <kbd id=''>----</kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                        <kbd id=''>----</kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php endif;?>
                    <?php if(count($getBestPerformingCircleTN) == 1):?>
                        <kbd id=''>----</kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                        <kbd id=''>----</kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php endif;?>
                    <?php if(count($getBestPerformingCircleTN) == 2):?>
                        <kbd id=''>----</kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php endif;?>
                </div>
            </div>  
            <div class="col-lg-2" style="padding:16px;">             
                <div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg bg-danger text-white">
                    Least Performing 3 Circles<br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php foreach ($getLeastPerformingCircle as $row):?> 
                        <kbd id=''><?=$row['circle_name']?>,<?=$row['district_name']?></kbd><br><hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php endforeach;?>
                </div>                
            </div>
        </div>
        <hr style="margin-bottom:2px;margin-top:2px;">
        <div class="col-lg-12 mb-3 mt-3">
            <div class="row">
                <div class="col-2" ></div>
                <div class="col-8" style="text-align:center">
                <a href="<?php echo base_url(); ?>index.php/EkhajanaDlrDashboard/viewDistWiseTehsildariAreaPayments" target="_distTeh">
                    <button class="btn btn-success shadow-lg btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i> CLICK HERE TO VIEW DISTRICT WISE DATA</button>
                </a>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
</div>
<!-- chart mouzadari area  -->
<script>
    var xValues = <?=json_encode($x_values_mouz)?>;
    var yValues = <?=json_encode($yvalues_amt_mouz)?>;
    var ctx = $("#myChart");
    let ctxx=ctx[0].getContext('2d');
    var gradient = ctxx.createLinearGradient(0,0,0,130);

    gradient.addColorStop(0, "#000046");
    gradient.addColorStop(0.5, "#1CB5E0");
    gradient.addColorStop(1, "#000046");

    new Chart("myChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: gradient,
            data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "Mouzadari Area Payments In Last 7 Days"
        }
    }
    });
</script>
<!-- chart tehsildari area  -->
<script>
var xValues = <?=json_encode($x_values_cir)?>;
    var yValues = <?=json_encode($yvalues_amt_cir)?>;
    var ctxc = $("#myChart1");
    let ctxxc=ctxc[0].getContext('2d');
    var gradient = ctxxc.createLinearGradient(0,0,0,130);
    gradient.addColorStop(0, "green");
    gradient.addColorStop(0.5, "cyan");
    gradient.addColorStop(1, "green");
    new Chart("myChart1", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: gradient,
            data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "Tehsildari Area Payments In Last 7 Days"
        }
    }
    });
</script>

