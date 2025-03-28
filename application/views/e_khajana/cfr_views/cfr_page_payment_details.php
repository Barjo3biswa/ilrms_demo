<style>
    .casedisplay_new {
        min-height: 395px !important;
        background-color:rgb(171, 171, 171);
    }
    .thead_color{
        background-color:#292409!important;
        color:white!important;
    }    
</style>
<style>
    .loader-wrap {
        position: fixed;
        z-index: 9999;
        height: 100%;
        width: 100%;
        margin: auto;
        background-color: black; /* Solid black background */
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .loader-text {
        margin-top: 10px;
        font-size: 16px;
        font-weight: normal;
        color: #ffffff; /* White text for visibility */
    }

    .dots {
        display: inline-block;
        animation: blink 0.5s infinite steps(5, start);
    }

    @keyframes blink {
        to {
            visibility: hidden;
        }
    }

    .loader {
        transform: translateZ(1px);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: inline-block;
        position: relative;
        background: none; /* Ensures no background image is applied */
    }

    .loader:after {
        content: '₹';
        display: inline-block;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        text-align: center;
        line-height: 60px;
        font-size: 50px;
        font-weight: bold;
        background-color: black; /* Matches the loader-wrap background */
        color: #50ff00; /* Green for the text */
        border: 4px double #50ff00; /* Green border */
        box-sizing: border-box;
        animation: coin-flip 10s cubic-bezier(0, 0.2, 0.8, 1) infinite;
    }

    @keyframes coin-flip {
        0%, 100% {
            animation-timing-function: cubic-bezier(0.5, 0, 1, 0.5);
        }
        0% {
            transform: rotateY(0deg);
        }
        50% {
            transform: rotateY(1800deg);
            animation-timing-function: cubic-bezier(0, 0.5, 0.5, 1);
        }
        100% {
            transform: rotateY(3600deg);
        }
    }
</style>
<style>
    .scrollable-table {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-collapse: collapse;
        table-layout: fixed; /* Ensure columns do not break */
        width: 100%;
    }

    .scrollable-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .scrollable-table thead {
        background-color: #343a40;
        color: white;
    }

    .scrollable-table th,
    .scrollable-table td {
        padding: 10px;
        text-align: center;
        border: 1px solid #dee2e6;
        white-space: nowrap; /* Prevent text wrapping */
    }

    .scrollable-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .scrollable-table tbody tr:hover {
        background-color: #f5f5f5;
    }
</style>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarCfr/index'?>">CFR-INDEX</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">CFR PAYMENT SUMMARY</li>
  </ol>
</nav>
<center>
<div class="row" style='margin-top:20px;'>				
    <div class="loader-wrap" style="display:none;" id="loader">
        <div class="loader-container">
            <span class="loader"></span>
            <div class="loader-text text-white font-weight-bolder">Loading<span class="dots text-white font-weight-bolder h4">...</span></div>
        </div>
    </div>
    <!-- form inputs -->
    <form action="<?php echo base_url() . 'index.php/EkhajanaMouzadarCfr/proceedToEgars' ?>" 
        id="proceedToEgrasForm" method="POST">
        <input type="hidden" name="dist_code" id="dist_code" value="<?= $dist_code ?>">
        <input type="hidden" name="subdiv_code" id="subdiv_code" value="<?= $subdiv_code ?>">
        <input type="hidden" name="cir_code" id="cir_code" value="<?= $cir_code ?>">
        <input type="hidden" name="mouza_pargona_code" id="mouza_pargona_code" value="<?= $mouza_pargona_code ?>">
        <!-- Hidden input for Mouzadar Account Holder Name -->
        <input type="hidden" name="mouzadarAccountHolderName" id="mouzadarAccountHolderName" value="<?= $mouzadar_bank_details->account_name ?>">
        <!-- Hidden input for Mouzadar Account Code -->
        <input type="hidden" name="mouzadarAccountCode" id="mouzadarAccountCode" value="<?= $mouzadar_bank_details->account_code ?>">
        <!-- Hidden input for Total Amount -->
        <input type="hidden" name="totalAmount" id="totalAmount" value="<?= $amount_details_all['total_amount'] ?>">
        <!-- Hidden input for Total Treasury Amount -->
        <input type="hidden" name="treasuryAmount" id="treasuryAmount" value="<?= $amount_details_all['revenue_head_total_amount'] ?>">
        <!-- Hidden input for Total Non-Treasury/Commission Amount -->
        <input type="hidden" name="nonTreasuryAmount" id="nonTreasuryAmount" value="<?= $amount_details_all['mouzadar_total_commission'] ?>">
        <input type="hidden" name="cfr_pages_details_from_selection" id="cfr_pages_details_from_selection" value='<?= json_encode($cfr_pages_details_from_selection)?>'>
    </form>
    <div class="col-lg-10 offset-1">
        <div class="panel casedisplay_new shadow-lg p-3 mb-3">                      
            <div class="panel-body">
                <div style="background-color: green; color: #fff;">
                    <div class="text-center text-white p-3 font-weight-bold">
                        <h5><i class="fa fa-money" aria-hidden="true"></i>
                            <u>CFR PAYMENT SUMMARY</u>
                        </h5>
                    </div>
                </div>
                <div style="background-color: blue; color: #fff;">
                    <div class="text-center text-white p-1 font-weight-bold">
                        <h6><i class="fas fa-bell-slash" aria-hidden="true"></i>
                            <u>NOTE: KINDLY VERIFY ALL THE PAYMENT DETAILS BEFORE PROCEEDING TO E-GRAS FOR PAYMENT</u>
                        </h6>
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
            </table>
            <div class="panel-body">
                <div style="background-color: red; color: #fff;">
                    <div class="text-center text-white p-1 font-weight-bold">
                        <h6><i class="fa-solid fa-book"></i>
                            PAYMENT DETAILS
                        </h6>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">           
                <thead class="thead-dark" style="font-weight:bold;">                            
                    <tr class="bg-dark text-warning">
                        <td>Mouzadar Account Holder Name</td>
                        <td><?=$mouzadar_bank_details->account_name?></td>                        
                    </tr>
                    <tr class="bg-dark text-warning">
                        <td>Mouzadar Account Code</td>
                        <td><?=$mouzadar_bank_details->account_code?></td>
                    </tr>
                    <tr class="bg-dark text-warning">
                        <td>TOTAL AMOUNT TO BE PAID</td>
                        <td>Rs. <?=$amount_details_all['total_amount']?></td>
                    </tr>          
                    <tr class="bg-dark text-warning">
                        <td>TOTAL TREASURY AMOUNT</td>
                        <td>Rs. <?=$amount_details_all['revenue_head_total_amount']?></td>
                    </tr>
                    <tr class="bg-dark text-warning">
                        <td>TOTAL NON-TREASURY/COMMISIION AMOUNT</td>
                        <td>Rs. <?=$amount_details_all['mouzadar_total_commission']?></td>
                    </tr>                                                        
                </thead>
            </table>
            <div class="panel-body">
                <div style="background-color: green; color: #fff;">
                    <div class="text-center text-white p-1 font-weight-bold">
                        <h6><i class="fa-solid fa-book"></i>
                            SELECTED CFR PAGES,BOOKS FOR PAYMENT
                        </h6>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover" >           
                <thead class="thead-dark">                            
                    <tr style="background-color: black; color: #fff;">
                        <td>CFR BOOK NO</td>
                        <td>CFR PAGE NO</td>
                        <td>PATTA-TOTAL NO OF PATTA</td>                        
                    </tr>                                                        
                </thead>
                <tbody>
                    <?php foreach ($cfr_pages_details_from_selection as $row):?> 
                        <tr>
                            <td>
                                <span class="font-weight-bolder text-dark">
                                    <?=$row['bookNumber']?>
                                </span>
                            </td>
                            <td>
                                <span class="font-weight-bolder text-dark">
                                    <?=$row['pageNumber']?>
                                <span>
                            </td>
                            <td>
                                <span class="font-weight-bolder text-dark">                                    
                                    <?=$row['totalPatta']?>
                                <span>
                            </td>                          
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>            
            <?php foreach ($cfr_pages_details_from_selection as $row):?> 
                <div class="panel-body">
                    <div style="background-color: green; color: #fff;">
                        <div class="text-center text-white p-1 font-weight-bold">
                            <h6><i class="fa-solid fa-book"></i>
                                PATTA DETAILS FOR - CFR BOOK NO: <?=$row['bookNumber']?>, CFR PAGE NO: <?=$row['pageNumber']?>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="scrollable-table">
                    <table class="table table-striped table-hover">           
                        <thead class="thead-dark">                                                        
                            <tr class="bg-dark text-white">
                                <td>LOT</td>
                                <td>VILLAGE</td>
                                <td>PATTA TYPE</td>
                                <td>PATTA NO</td>  
                                <td>কাৰ পৰা পোৱা হল</td>  
                                <td>কাৰ বাবে পোৱা হল</td>  
                                <td>ARREAR REVENUE</td>                                                    
                                <td>ARREAR LOCAL-TAX</td>  
                                <td>TOTAL ARREAR</td>                        
                                <td>CURRENT REVENUE</td>                                                    
                                <td>CURRENT LOCAL-TAX</td>
                                <td>TOTAL AMOUNT</td>                        
                            </tr>                                                                                
                        </thead>
                        <tbody>
                            <?php 
                                $patta_details = $this->EkhajanaCfrModel->getPattaDetailsFromCFRpageAndBook($row['bookNumber'],$row['pageNumber']);
                                // echo "<pre>";
                                // var_dump($patta_details);
                                // exit;
                            ?>
                            <?php foreach ($patta_details as $row):?>          
                                <?php 
                                    $amount_details = $this->EkhajanaCfrModel->getArrearAndCurrentRevDetails($row);
                                    // echo "<pre>";
                                    // var_dump($amount_details);
                                    //exit;
                                ?>                   
                                <tr>
                                    <td>
                                        <span class="font-weight-bolder text-dark">
                                            <?=$this->utilclass->getLotName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no)?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-dark">
                                            <?=$this->utilclass->getVillageName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code)?>
                                        <span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-dark">                                    
                                            <?=$this->utilclass->getPattaType($row->patta_type_code)?>
                                        <span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-dark">                                    
                                            <?=$row->patta_no?>
                                        <span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-dark">                                    
                                            <?=$row->pdar_id_kpph_name?>
                                        <span>
                                    </td>
                                    <td>
                                        <span class="font-weight-bolder text-dark">                                    
                                            <?=$row->pdar_id_kbph_name?>
                                        <span>
                                    </td>    
                                    <td>
                                        <span class="font-weight-bolder text-dark">                                    
                                            <b>Rs. <?=$amount_details['arrear_revenue']?></b>
                                        <span>
                                    </td>  
                                    <td>
                                        <span class="font-weight-bolder text-dark">                                    
                                            <b>Rs. <?=$amount_details['arrear_local_tax']?></b>
                                        <span>
                                    </td>  
                                    <td>
                                        <span class="font-weight-bolder text-dark">                                    
                                            <b>Rs. <?=$amount_details['total_arrear']?></b>
                                        <span>
                                    </td>  
                                    <td>
                                        <span class="font-weight-bolder text-dark">                                    
                                            <b>Rs. <?=$amount_details['current_revenue']?></b>
                                        <span>
                                    </td>  
                                    <td>
                                        <span class="font-weight-bolder text-dark">                                    
                                            <b>Rs. <?=$amount_details['current_local_tax']?></b>
                                        <span>
                                    </td>      
                                    <td>
                                        <span class="font-weight-bolder text-dark">                                    
                                            <b>Rs. <?=$amount_details['total_amount']?></b>
                                        <span>
                                    </td>                  
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach;?>                
            <div class="row">
                <div class="col-lg-12 mt-3 text-center">                        
                    <a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarCfr/index'?>"
                        class="btn btn-danger btn-sm text-white" role="button" 
                        style="padding: 7px !important;font-size: 14px;font-weight: bold;">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            CLOSE
                    </a>   
                    <button class="btn btn-success btn-sm" onclick="proceedToEgras()"
                        style="padding: 5px!important;font-size: 14px;font-weight: bold;">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            PROCEED TO E-GRAS
                    </button>                    
                </div>                
            </div>
        </div>
    </div>               
</div>
<script>
    
    function proceedToEgras() 
    {
        // Confirm details with SweetAlert
        Swal.fire({
            title: 'Are You Sure To Proceed To e-GRAS For Payment?',
            html: `
                <p class="text-dark">
                    <b>TOTAL AMOUNT TO BE PAID:</b> Rs. <?= $amount_details_all['total_amount'] ?><br>
                    <b>TOTAL TREASURY AMOUNT:</b> Rs. <?= $amount_details_all['revenue_head_total_amount'] ?><br>
                    <b>TOTAL NON-TREASURY/COMMISSION AMOUNT:</b> Rs. <?= $amount_details_all['mouzadar_total_commission'] ?>
                </p>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Proceed',
            cancelButtonText: 'No, Cancel',
            reverseButtons: true,
            focusConfirm: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loader
                document.getElementById('loader').style.display = 'flex';
                document.getElementById('proceedToEgrasForm').submit();
            }
        });
    }
</script>







