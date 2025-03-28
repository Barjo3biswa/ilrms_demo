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
    <h6 style="text-align:center">Dp Flagging Info</h6>
    </div>
    <hr>
    <div class="container mb-5">
    <table class="table table-hover table-bordered" style="width:100%!important;background-color:#e6e1e1;font-size:12px;!important" id="dist_cir_wise_table">
        <thead>
        <tr style="background-color:#b67eff;">
            
            <th class="text-center">Mouza</th>
            <th class="text-center">Patta Type</th>
            <th class="text-center">Flagged</th>
            <th class="text-center">Unflagged</th>
        </tr>
        </thead>
        
        <tbody class="text-center"> 
            <?php foreach ($mouzaWiseDpFlag as $row):?>
            <tr>
                <td>
                    <a href="<?php echo base_url() . 'index.php/EkhajanaDlrDashboard/getLotWisedpFlagging/' .$row['dist_code'].'/'.$row['subdiv_code'].'/'.$row['cir_code'].'/'.$row['mouza_pargona_code']; ?>" title=""><?php echo $row['mouza_name']; ?></a>
                </td>
                <?php
                    $patta_type_arr = [];
                    $flagged = [];
                    $unflagged = [];
                foreach ($row['query_res'] as $row1){
                    array_push($patta_type_arr, $this->EkhajanaDlrDashboardModel->getPattaType($row['dist_code'],$row1->patta_type_code));
                    array_push($flagged,$row1->flagged);
                    array_push($unflagged,$row1->unflagged);
                }
                    
                ?>
                <td><?= implode('<br>', $patta_type_arr); ?></td>                                           
                <td><?= implode('<br>', $flagged); ?></td>                                           
                <td><?= implode('<br>', $unflagged); ?></td>   
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
    $('#dist_cir_wise_table').dataTable({
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
                title: "Dp Flagging Report",
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