<div id="displayBox" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 80px;"></div>
<script src="<?php echo base_url(); ?>application/views/js/blockUI.js"></script>
<link href="<?php echo base_url(); ?>application/views/css/dataTableButton.css" rel="stylesheet" />
<script>
document.onreadystatechange = function(e)
{
    $.blockUI({ 
        message: $('#displayBox'),
        css: {
            border:'none',
            backgroundColor:'transparent'
        }
    });    
};
window.onload = function(){   
    $.unblockUI();
}
</script>
<style>
    .buttons-excel {
    left: 15%;
    background-color: orange;
    color: white!important;
    }
    .buttons-csv {
    left: 15%;
    background-color: grey;
    color: white!important;
    }
    .btn-info {
        color: #000;
        background-color: orange;
        border-color: #fff
    }
    /* .custom_width{
        width: 70%!important;
    } */
</style>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
    <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarCommissionController/index'?>">COMMISION-DASHBOARD</a></li>
    <li class="breadcrumb-item font-weight-bold active" aria-current="page">COMMISSION-REPORT</li>
  </ol>
</nav>

<?php if($error):?>
    <div class="text-center bg-dark text-warning h5 p-3">
        <?=$message?>
    </div>
<?php else:?>
    <div class="container mb-5 col-lg-11 offset-.5" style="margin-top:2rem; border: 2px solid;background:white; max-height:500px; overflow-y:scroll">
        <h3 style="text-align:center;margin-top:1rem"><u>COMMISSION-REPORT</u></h3>
        <div class="text-center h5">
            <u>
                District-<?=$this->utilclass->getDistrictName($dist_code)?>,
                Circle-<?=$this->utilclass->getCircleName($dist_code,$subdiv_code,$circle_code)?>,
                Mouza-<?=$this->utilclass->getMouzaName($dist_code,$subdiv_code,$circle_code,$mouza_pargona_code)?>
            </u>
        </div>
        <div  class="text-center h5 mb-5" style="margin-bottom:2rem;">
            Total Commision Received From <span style="color:red"><?=$from_date?></span>  To <span  style="color:red"><?=$to_date?></span> is <span style="color:red">Rs <?=$total_commsion?></span>        
        </div>
        <table class="table table-striped table-bordered" id="commission_report_table">
            <thead>                      
                <tr style="border-top:0px;background-color:#153856!important;color:white" class="text-center;text-white">
                    <th>Application-No</th>
                    <th>Land-Application-No</th>
                    <th>Village</th>
                    <th>Patta-Type</th>
                    <th>Patta-No</th>
                    <th>GRN-NO</th>
                    <th>Total-Amount</th>
                    <th>Total-Commission</th>
                    <th>Date of Transaction</th>
                </tr>                        
            </thead>
                <tbody> 
                    <?php foreach ($commission_details as $commisionData):?>
                        <tr style="text-align:center">
                            <td><?=$commisionData->application_no?></td>     
                            <td><?=$commisionData->ld_application_no?></td>      
                            <td><?=$this->utilclass->getVillageName($commisionData->dist_code,
                                $commisionData->subdiv_code,$commisionData->cir_code,$commisionData->mouza_pargona_code,
                                $commisionData->lot_no,$commisionData->vill_townprt_code)?></td>
                            <td><?=$this->utilclass->getPattaType($commisionData->patta_type_code)?></td>     
                            <td><?=$commisionData->patta_no?></td>   
                            <?php
                                if(isset(json_decode($commisionData->egras_response)->gras_response->data->GRN)){
                                    $grn_no = json_decode($commisionData->egras_response)->gras_response->data->GRN;
                                }elseif(isset(json_decode($commisionData->egras_response)->GRN)){
                                    $grn_no = json_decode($commisionData->egras_response)->GRN;
                                }elseif(isset(json_decode(json_decode($commisionData->egras_response)->gras_response)->data->GRN)){
                                    $grn_no = json_decode(json_decode($commisionData->egras_response)->gras_response)->data->GRN;
                                }else{
                                    $grn_no = "NOT-FOUND";
                                }
                            ?>  
                            <td><?=$grn_no?></td>
                            <td><b>Rs <?=$commisionData->total_khajana?></b></td>     
                            <td><b>Rs <?=$commisionData->total_commission?></b></td>
                            <?php
                                $ts = strtotime($commisionData->created_at);
                                $date = date("D M d Y", $ts);
                            ?>     
                            <td><?=$date?></td>     
                        </tr>
                    <?php endforeach;?> 
                </tbody>
            </table>
        </div>
    </div>
    <!-- <script>
        $(document).ready( function () {
            //data table initialisation
            $('#commission_report_table').dataTable({
                "scrollX": true,
                "lengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
                "pageLength": 4
            });
        });
    </script> -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#commission_report_table').DataTable({
        "scrollX": true,
        "lengthMenu": [[2, 4, 8, -1], [2, 4, 8, "All"]],
        "pageLength": 8,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-download  text-black"></i> <span class="  text-black">Download As Excel</span>',
                titleAttr: 'Excel',
                title: "Commission Report",
                className: 'btn btn-success btn-sm'
            }
        ],
        initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-info btn-sm');
            btns.removeClass('dt-button');
        }
    });
});
</script>
<?php endif ;?>
