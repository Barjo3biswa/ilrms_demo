<style>
    body{
        padding-right: 0 !important;
    }

    .table thead tr:first-child {
    background: #e6e1e1 ;
}
</style>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<div class="col-lg-10 offset-1">
    <hr>
    <div class="container bg-secondary text-white p-1 shadow-lg">
     <h6 style="text-align:center">Mouza Wise Demand Satisfied Info</h6>
    </div>
    <div class="container bg-dark text-white p-1 shadow-lg">
       <h6 style="text-align:center;font-size:11px;">NOTE: RANK IS GIVEN ON THE BASIS OF DEMAND SATISFIED YEAR. SIMILAR RANKS WILL APPEAR IF THE DEMAND SATISFIED YEAR IS SAME.</h6>
    </div>

    <hr>
    <div class="container mb-5">
    <table class="table table-hover table-bordered" style="width:100%!important;background-color:#e6e1e1;font-size:12px;!important" id="mouz_dist_wise_table">
        <thead>
        <tr style="background-color:#b67eff;">
            <th class="text-center">Rank</th>
            <th class="text-center">Mouzadar-Name</th>
            <th class="text-center">District</th>
            <th class="text-center">Circle</th>
            <th class="text-center">Mouza</th>            
            <th class="text-center">Upto Demand<br>Satisfied Year</th>
            <th class="text-center">Upto Demand<br>Satisfied Year(B.S)</th>                         
        </tr>
        </thead>
        <tbody class="text-center">    
            <?php foreach ($demand_satisfied_mouza_wise_arr as $row): ?>
		<tr>
                
                    <?php if($row['Rank'] == 1) :?>
                       <th class="bg-dark text-primary font-weight-bold"><?=$row['Rank']?></th>
                    <?php elseif($row['Rank'] == 2) :?>
                       <th class="bg-dark text-info font-weight-bold"><?=$row['Rank']?></th>
                    <?php elseif($row['Rank'] == 3) :?>
                       <th class="bg-dark text-success font-weight-bold"><?=$row['Rank']?></th>
                    <?php else :?>
                       <th class="bg-dark text-danger font-weight-bold"><?=$row['Rank']?></th>
                    <?php endif; ?>

                    <th><?=$row['mouzadar_name']?></th>
                    <th>
                        <?=$row['dist_name']?>                                    
                    </th>
                    <th><?=$row['circle_name']?></th>
                    <th><?=$row['mouza_name']?></th>                    
                    <th><?=$row['upto_demand_satisfied_year']?></th>
                    <th>ভাস্কৰাব্দ-<?=$row['upto_demand_satisfied_year_bs']?></th>                                                                                        
                </tr>  
            <?php endforeach ?> 
        </tbody>
    </table>
    <hr>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/datatables/dataTableButtonJsZIP.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/datatableButtons.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/datatableButtonHtml.js"></script>    
  
<script type="text/javascript">  
$(document).ready( function () {
    $('#mouz_dist_wise_table').dataTable({
        "scrollX": true,
        "lengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
        "pageLength": 10,
        "paging": true,
        "searching" : true,
        "autoWidth":true,
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-download"></i> Download As Excel',
                titleAttr: 'Excel',
                title: "MOUZA-WISE-DEMAND-SATISFIED-REPORT",
            }, 
        ],
        initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-success btn-sm');
            btns.removeClass('dt-button');
        }
    });
});
</script>
