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
    <div class="col-lg-12 mt-2 mb-3" style="border:3px solid #96907e; border-radius:5px">
        <div class="text-warning bg-dark p-1 shadow-lg col-lg-12 mt-2 text-center" style="border:3px solid #96907e; border-radius:5px">
            <h6>e-Khazana Payments</h6>
        </div>
        <div class="row ">
            <div class="col-lg-6">
                <div class="card">
                    <div class=" card-body text-white">
                        <i class="fa fa-inr" aria-hidden="true"></i>Amount Received (Till Now,Including e-CFR) <kbd id=''>Rs <?=$total_amt_rcv+round($total_cash_in_hand,2)?></kbd>   
                    </div>                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-white">
                        Amount Received (Till The Day Before Yesterday) <kbd id=''>Rs <?=$total_amt_rcv_dby?></kbd>   
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-white">                
                        Amount Received (Yesterday) <kbd id=''>Rs <?=$total_amt_rcv_y_mouz_area?></kbd>  
                    </div>
                </div>
            </div>
	    <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-white">
                        <i class="fa fa-inr"></i> Total Cash In Hand With Mouzadars <kbd id=''>Rs <?=round($total_cash_in_handi,2)?></kbd>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mouzadari area report -->
    <div class="col-lg-12 mt-2 mb-3" style="border:3px solid #96907e; border-radius:5px">
        <div class="text-warning bg-dark p-1 shadow-lg col-lg-12 mt-2 text-center" style="border:3px solid #96907e; border-radius:5px">
            <h6>e-Khazana Payments(Mouzadari-Area)</h6>
        </div>
        <div class="row">
            <div class="col-lg-3" style="padding:25px;">
		<div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg">
                    <i class="fa fa-inr" aria-hidden="true"></i>Total Amount Received Including eCFR <br><kbd id=''>Rs <?=$total_amt_rcv_mouz_area+round($total_cash_in_hand,2)?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">
                    
                    <i class="fa fa-inr" aria-hidden="true"></i>Digital Amount Received (Till Now) <br><kbd id=''>Rs <?=$total_amt_rcv_mouz_area?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">
                    <?php /* 
		    Amount Received (Till The Day Before Yesterday) <br><kbd id=''>RS <?=$total_amt_rcv_dby_mouz_area?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">
                    */?>
                    Amount Received (Yesterday) <br><kbd id=''>Rs <?=$total_amt_rcv_y_mouz_area?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">
                    Percentage Of Total Demand <br><kbd id=''>--%</kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">                   
                </div>                
            </div>
            <div class="col-lg-6">
                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
            </div>              
            <div class="col-lg-3" style="padding:25px;">
                <div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg bg-success text-white">
                    Top Performing Mouza Till Now<br>
                    <kbd id=''>Rnagamati,Darrang</kbd>
                </div>               
                <div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg mt-3 bg-primary text-white">
                    Top Performing Mouza In Last 7 days<br>
                    <kbd id=''>Rnagamati,Darrang</kbd>
                </div>               
                <div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg mt-3 bg-danger text-white">
                    Least Performing Mouza<br>
                    <kbd id=''>Rnagamati,Darrang</kbd>
                </div>                
            </div>
        </div>
        <hr style="margin-bottom:2px;margin-top:2px;">
        <div class="col-lg-12 mb-3 mt-3">
            <div class="row">
                <div class="col-4" ></div>
                <div class="col-4" style="text-align:center">
                <a href="<?php echo base_url(); ?>index.php/EkhajanaReportController/viewLotWiseCount">
                    <button class="btn btn-success shadow-lg btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i> CLICK HERE TO VIEW DISTRICT WISE DATA</button>
                </a>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
    <!-- tehsildari area report -->
    <div class="col-lg-12 mt-2 mb-3" style="border:3px solid #96907e; border-radius:5px">
        <div class="text-warning bg-dark p-1 shadow-lg col-lg-12 mt-2 text-center" style="border:3px solid #96907e; border-radius:5px">
            <h6>e-Khazana Payments(Tehsildari-Area)</h6>
        </div>
        <div class="row">
            <div class="col-lg-3" style="padding:25px;">
                <div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg">
                    Amount Received (Till Now) <br><kbd id=''>Rs <?=$total_amt_rcv_teh_area?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">
                    Amount Received (Till The Day Before Yesterday) <br><kbd id=''>RS <?=$total_amt_rcv_dby_teh_area?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">
                    Amount Received (Yesterday) <br><kbd id=''>Rs <?=$total_amt_rcv_y_teh_area?></kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">
                    Percentage Of Total Demand <br><kbd id=''>--%</kbd>  <br> <hr style="margin-bottom:2px;margin-top: 5px;">                   
                </div>                
            </div>
            <div class="col-lg-6">
                <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
            </div>              
            <div class="col-lg-3" style="padding:25px;">
                <div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg bg-success text-white">
                    Top Performing Circle Till Now<br>
                    <kbd id=''>Rnagamati,Darrang</kbd>
                </div>               
                <div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg mt-3 bg-primary text-white">
                    Top Performing Circle In Last 7 days<br>
                    <kbd id=''>Rnagamati,Darrang</kbd>
                </div>               
                <div style="border:3px solid #96907e; border-radius:5px; padding:5px;font-size:12px;" class="shadow-lg mt-3 bg-danger text-white">
                    Least Performing Circle<br>
                    <kbd id=''>Rnagamati,Darrang</kbd>
                </div>                
            </div>
        </div>
        <hr style="margin-bottom:2px;margin-top:2px;">
        <div class="col-lg-12 mb-3 mt-3">
            <div class="row">
                <div class="col-4" ></div>
                <div class="col-4" style="text-align:center">
                <a href="<?php echo base_url(); ?>index.php/EkhajanaReportController/viewLotWiseCount">
                    <button class="btn btn-success shadow-lg btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i> CLICK HERE TO VIEW DISTRICT WISE DATA</button>
                </a>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
</div>
<!-- chart mouzadari area  -->
<script>
    var xValues = ["Italy", "France", "Spain", "USA", "Argentina","Italy", "France", "Spain", "USA", "Argentina","Italy", "France", "Spain", "USA", "Argentina"];
    var yValues = [55, 49, 44, 24, 15,55, 49, 44, 24, 15,55, 49, 44, 24, 15];
    var barColors = ["red", "green","blue","orange","brown","red", "green","blue","orange","brown","red", "green","blue","orange","brown"];
    new Chart("myChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "Mouzadari Area Payments In Last 15 Days"
        }
    }
    });
</script>
<!-- chart tehsildari area  -->
<script>
    var xValues = ["Italy", "France", "Spain", "USA", "Argentina","Italy", "France", "Spain", "USA", "Argentina","Italy", "France", "Spain", "USA", "Argentina"];
    var yValues = [55, 49, 44, 24, 15,55, 49, 44, 24, 15,55, 49, 44, 24, 15];
    var barColors = ["red", "green","blue","orange","brown","red", "green","blue","orange","brown","red", "green","blue","orange","brown"];
    new Chart("myChart1", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "Tehsildari Area Payments In Last 15 Days"
        }
    }
    });
</script>
