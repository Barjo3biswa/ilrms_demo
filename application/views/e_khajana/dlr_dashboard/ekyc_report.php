<div class="col-lg-10 mt-5 mb-3 offset-1" style="border:3px solid #96907e; border-radius:5px;">
    <div class="container bg-dark text-white p-1 shadow-lg ">
        <h5 style="text-align:center">e-Khazana e-Kyc Report</h5>
    </div>
    <div class="container mb-5 mt-5">
    <table class="table table-hover table-bordered" style="border-color:black" id="mouz_dist_wise_table">
        <thead>
        <tr style="background-color:#b67eff;">
            <th scope="col" class="text-center">District</th>
            <th scope="col" class="text-center">AADHHAR-REGISTRATION-COUNT</th>
            <th scope="col" class="text-center">AADHHAR-SEEDING-COUNT</th>
            <th scope="col" class="text-center">PAN-REGISTRATION-COUNT</th>
            <th scope="col" class="text-center">PAN-SEEDING-COUNT</th>     
            <th scope="col" class="text-center">TOTAL-REGISTRATION-COUNT</th>     
            <th scope="col" class="text-center">TOTAL-SEEDING-COUNT</th>
        </tr>
        </thead>
        <tbody>    
            <?php foreach ($ekyc_details as $row):?>
		<tr class="text-center">
                    <td>
                        <?=$row->district?>                                                
                    </td>
                    <td>
                        <?=$row->aadhaar_registration_count?>                                                
                    </td>
                    <td>
                        <?=$row->aadhaar_seeding_count?>
                    </td>
                    <td>
                        <?=$row->pan_registration_count?>                                                
                    </td>
                    <td>
                        <?=$row->pan_seeding_count?>
                    </td>
                    <td>
                        <?=$row->aadhaar_registration_count+$row->pan_registration_count?>
                    </td>
                    <td>
                        <?=$row->aadhaar_seeding_count+$row->pan_seeding_count?>
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
