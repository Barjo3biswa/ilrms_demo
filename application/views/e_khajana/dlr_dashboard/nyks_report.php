<div class="col-lg-10 mt-5 mb-3 offset-1" style="border:3px solid #96907e; border-radius:5px;">
    <div class="container bg-dark text-white p-1 shadow-lg ">
        <h5 style="text-align:center">e-Khazana NYKS Report</h5>
    </div>
    <div class="container bg-dark text-warning p-1 shadow-lg ">
        <h5 style="text-align:center">Total No Of e-Khazana Registration By NYKS Volunteers : <?=$total_registartion_count?></h5>
    </div>
    <div class="container mb-5 mt-5">
    <table class="table table-hover table-bordered" style="border-color:black" id="mouz_dist_wise_table">
        <thead>
        <tr style="background-color:#b67eff;">
            <th scope="col" class="text-center">District</th>
            <th scope="col" class="text-center">VOLUNTEER-NAME</th>
            <th scope="col" class="text-center">TOTAL-REGISTRATION-COUNT</th>
            <th scope="col" class="text-center">TOTAL-PENDING-WITH-MOUZADAR-LRA-COUNT</th>
            <th scope="col" class="text-center">TOTAL-PENDING-WITH-MOUZADAR-COUNT</th>     
            <th scope="col" class="text-center">TOTAL-PENDING-WITH-LRA-COUNT</th>     
            <th scope="col" class="text-center">TOTAL-PENDING-WITH-CO-COUNT</th>
            <th scope="col" class="text-center">TOTAL-DELIVERED-COUNT</th>
        </tr>
        </thead>
        <tbody>    
            <?php foreach ($nyks_details as $row):?>
		        <tr class="text-center">
                    <td>
                        <?=$row->district?>                                                
                    </td>
                    <td>
                        <?=$row->volunteer_name?>                                                
                    </td>
                    <td>
                        <?=$row->registration_count?>
                    </td>
                    <td>
                        <?=$row->pending_with_lm_and_mouzadar_count?>                                                
                    </td>
                    <td>
                        <?=$row->pending_with_mouzadar_count?>
                    </td>
                    <td>
                        <?=$row->pending_with_lm_count?>
                    </td>
                    <td>
                        <?=$row->pending_with_co_count?>
                    </td>
                    <td>
                        <?=$row->delivered_count?>
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
    "ordering": false,
    responsive: true
});
</script>
