<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>css/flora.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datepick.js"></script>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarCfr/index'?>">CFR-INDEX</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">Settled CFR Pages List</li>
  </ol>
</nav>
<div class="panel panel-info panel-form ">     
    <div class="tab-content">        
        <div class="card-body">
            <div class="card-body shadow-lg p-1 mb-5 bg-white rounded">                              
            <div class="card panel-heading text-white bg-danger text-center">
                <h5 class="panel-title">
                    <u>
                        <b>Aborted CFR Pages List</b><br>
                        DISTRICT-<?=$district_name?>, CIRCLE-<?=$circle_name?>, MOUZA-<?=$mouza_name?>
                    </u>                        
                </h5>
            </div> 
            <div class="card panel-heading text-danger bg-dark text-center" style="margin-top:-20px;">
                <h6 class="panel-title">
                    <u>
                        <b>NOTE:</b> IF PAYMENT WAS DEDUCTED IN SUCH CASES, AMOUNT WILL BE REFUNDED IN 7/10 BUSINESS DAYS
                    </u>                        
                </h6>
            </div> 
            <div class="card panel-heading text-white bg-primary text-center" style="margin-top:-20px;">
                <h6 class="panel-title">
                    <u>
                        <b>NOTE:</b> PAGE WISE DETAILS CAN BE VIEWED UNDER VIEW ALL CFR DETAILS SECTION
                    </u>                        
                </h6>
            </div> 
            <div class = "card-body">            
                <table id="ek_ast_pending_list_1" class="table table-hover text-center" style="width:100%">            
                    <thead class="thead-dark">                            
                    <tr style="background-color: black; color: #fff;">
                            <td>TRANSACTION-ID/DEPARTMENT-ID</td>
                            <td>SETTLED-CFR-BOOK-AND-PAGE-NUMBERS</td>                                
                        </tr>                                                        
                    </thead>
                    <tbody>
                    <?php foreach ($viewData as $row):?> 
                        <tr>
                            <td>
                                <span class="font-weight-bolder text-dark">
                                    <b><?=$row->department_id?></b>
                            </td>
                            <td>
                                <span class="font-weight-bolder text-dark">
                                    <b><?=$row->cfr_book_page?></b>
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
<script src="<?php echo base_url('js/ekhajana/ekhajana_mouzadar.js'); ?>"></script>
