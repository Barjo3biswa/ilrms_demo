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
    <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaMouzadarController/amdaniReportForm'?>">AMDANI-REPORT-FORM</a></li>
    <li class="breadcrumb-item font-weight-bold active" aria-current="page">DOINIK-AMDANI-REPORT</li>
  </ol>
</nav>

<div class="container mb-5 col-lg-11 offset-.5" style="margin-top:2rem; border: 2px solid;background:white; max-height:500px; overflow-y:scroll">
    <h3 style="text-align:center;margin-top:1rem"><u>দৈনিক আমদানী</u></h3>
    <div  style="margin-top:2rem;margin-bottom:2rem;overflow-x: scroll;">
        <h6 style="color:black">দৈনিক আমদানী <span style="color:red"><?=$from_date?></span>  তাৰিখৰ পৰা <span  style="color:red"><?=$to_date?></span> তাৰিখৰ লৈকে</h6>
        <h6 style="color:black">মুঠ সংগ্ৰহ : <span style="color:red">Rs <?=$total_khajana?></h6>       
	<table class="table table-striped table-bordered" id="doinik_amdani_table">
            <thead>                      
                <tr style="border-top:1px" class="text-center">
                    <th colspan="1" style="text-align:center;border-bottom:0px"></th>
                    <th colspan="1" style="text-align:center;border-bottom:0px;"></th>
                    <th colspan="1" style="text-align:center;border-bottom:0px"></th>
                    <th colspan="1" style="text-align:center;border-bottom:0px"></th>
                    <th colspan="1" style="text-align:center;border-bottom:0px"></th>
                    <th colspan="4" style="text-align:center;border-bottom:0px">আদায় টকা</th>
                    <th colspan="1" style="text-align:center;border-bottom:0px"></th>
                    <th colspan="1" style="text-align:center;border-bottom:0px"></th>
                    <th colspan="1" style="text-align:center;border-bottom:0px"></th>
                    <th colspan="1" style="text-align:center;border-bottom:0px"></th>
                </tr>
                <tr style="border-top:0px" class="text-center">
                    <th scope="col" style="border-top:0px">ক্ৰমিক নম্বৰ</th>
                    <th scope="col" style="border-top:0px;" class="custom_width">পাট্টাদাৰ নাম আৰু যি মানুহৰ পৰা লোৱা যায় ত‌‍েওঁৰ নাম</th>
                    <th scope="col" style="border-top:0px">গাওঁৰ নাম</th>
                    <th scope="col">পাট্টাৰ প্ৰকাৰ</th>
                    <th scope="col">পাট্টা নম্বৰ</th>
                    <th scope="col" >খাজানা</th>
                    <th scope="col">স্থানীয় কৰ</th>
                    <th scope="col">বকেয়া ৰাজহ</th>
                    <th scope="col">মুঠ</th>
                    <th scope="col">জি-আৰ-এন</th>
                    <th scope="col">আৰটিপিএছ <br>এপ্লিকেচন নম্বৰ</th>
                    <th scope="col">ৰচিদ নম্বৰ</th>
                    <th scope="col">পৰিশোধৰ তাৰিখ</th>
                </tr>
                <?php /*
                <tr style="border-top:0px">
                    <th scope="col" style="text-align:center">১</th>
                    <th scope="col" style="text-align:center">২</th>
                    <th scope="col" style="text-align:center">৩</th>
                    <th scope="col" style="text-align:center">৪</th>
                    <th scope="col" style="text-align:center">৫</th>
                    <th scope="col" style="text-align:center">৬</th>
                    <th scope="col" style="text-align:center">৭</th>
                    <th scope="col" style="text-align:center">8</th>
                    <th scope="col" style="text-align:center">9</th>
                    <th scope="col" style="text-align:center">10</th>
                </tr>
                */?>            
            </thead>
            <tbody>
                <?php $counter = 1;?>  
                <?php foreach ($reportData as $rptData):?>
                <?php //var_dump($rptData);?>
                    <tr style="text-align:center">
                        <td><?=$counter++?></td>
                        <td style="border-top:0px;width:0px"><?=$rptData['pattadar_name']?></td>
                        <td><?=$this->utilclass->getVillageName($rptData['dist_code'],
                            $rptData['subdiv_code'],$rptData['cir_code'],$rptData['mouza_pargona_code'],
                            $rptData['lot_no'],$rptData['vill_townprt_code'])?></td>
                        <td><?=explode(',',$rptData['patta_type'])[0]?></td> 
                        <td><?=$rptData['patta_no']?></td>                         
                        <td>Rs <?=$rptData['current_revenue']?></td>
                        <td>Rs <?=$rptData['current_local_tax']?></td>
                        <td>Rs <?=$rptData['total_arrear']?></td>
                        <td>Rs <?=$rptData['total_khajana']?></td>
                        <td><?=$rptData['grn_no']?></td>
                        <td><?=$rptData['rtps_app_no']?></td>
                        <td><?=$rptData['receipt_number']?></td>                    
                        <td><?=$rptData['payment_date']?></td>          
                    </tr>
                <?php endforeach;?> 
            </tbody>
        </table>
    </div>
</div>
<?php /*
<script>
    $(document).ready( function () {
        //data table initialisation
        $('#doinik_amdani_table').dataTable({
            "scrollX": true,
            "lengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
            "pageLength": 4,
            //"autoWidth":false,
            //responsive: true
            "columnDefs": [
                {
                    "width": "100%",
                    "targets": 1
                }
            ]
        });
    });
</script>
*/?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
12:25
<script>
$(document).ready(function() {
    var table = $('#doinik_amdani_table').DataTable({
        "scrollX": true,
        "lengthMenu": [[2, 4, 8, -1], [2, 4, 8, "All"]],
        "pageLength": 8,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-download  text-black"></i> <span class="  text-black">Download As Excel</span>',
                titleAttr: 'Excel',
                title: "Amdani Report",
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



