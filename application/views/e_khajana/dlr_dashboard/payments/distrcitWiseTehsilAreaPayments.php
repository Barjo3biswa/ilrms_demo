<nav aria-label="breadcrumb">
    <ol class="breadcrumb p-3 text-white">
        <li class="breadcrumb-item font-weight-bold">
            <a href="#">
                District-Wise-eKhazana-Payment(Tehsildari-Area)
            </a>
        </li>         
    </ol>
</nav>
<div class="col-lg-10 mt-2 mb-3 offset-1" style="border:3px solid #96907e; border-radius:5px;">
    <div class="container bg-dark text-white p-1 shadow-lg ">
        <h5 style="text-align:center">District-Wise-eKhazana-Payment(Tehsildari-Area)</h5>
    </div>
    <div class="container bg-secondary text-white p-1 shadow-lg">
    <h6 style="text-align:center">Click The District To Get The Circle Level Info</h6>
    </div>
    <div class="container mb-5 mt-5">
    <table class="table table-hover table-bordered" style="border-color:black" id="mouz_dist_wise_table">
        <thead>
        <tr style="background-color:#b67eff;">
            <th scope="col" class="text-center">Rank</th>
            <th scope="col" class="text-center">Distrct</th>
            <th scope="col" class="text-center">Amount-Received(Till-Now)</th>            
        </tr>
        </thead>
        <tbody>    
            <?php foreach ($getDistrcitWiseTotalAmountReceivedTehsildariArea as $row):?>
                <?php
                    if($row['amount_received'] == 0){
                        $rank= '--';
                    }else{
                        $rank=$row['rank'];
                    }
                ?>
                <tr class="text-center">
                    <td class="bg-dark text-white">
                        <?=$rank?>
                    </td>
                    <td>
                        <a href="<?php echo base_url(); ?>index.php/EkhajanaDlrDashboard/viewCircleWiseTehsilAreaPayments/<?=$row['dist_code']?>">
                            <?=$row['district']?>
                        </a>                        
                    </td>
                    <td>
                        Rs <?=$row['amount_received']?>
                    </td>
                </tr>
            <?php endforeach ?> 
        </tbody>
    </table>
    <hr>
    </div>
</div>
<link href="<?=base_url();?>assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet">
<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/buttons.html5.min.js"></script>
<script>

$('#mouz_dist_wise_table').dataTable({
    "scrollX": true,
    "lengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
    "pageLength": 5,
    //"autoWidth":false,
    responsive: true,
    "ordering": false,
});
</script>