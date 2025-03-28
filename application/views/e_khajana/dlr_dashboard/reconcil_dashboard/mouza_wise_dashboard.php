
<style>
    .rank-cell {
        background-color: black;
        color: white;
        font-weight: bold;
    }

    table {
        border-radius: 8px;
        overflow: hidden;
    }

    .section-box {
        background: #ffffff;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        margin-bottom: 20px;
        border-left: 5px solid #007bff;
    }

    .section-title {
        background: linear-gradient(268deg, rgb(42 1 249) 0%, rgb(0, 0, 0) 50%, rgb(255 0 0) 100%);
        color: white;
        padding: 15px;
        text-align: center;
        border-radius: 5px;
        font-size: 1.2rem;
        font-weight: bold;
    }
</style>

<div class="container mb-5 mt-5 section-box" style="width: 95%; margin: 0 auto;">
    <div class="section-title shadow-lg mb-3">
        <?php 
            $dist_name = $this->utilclass->getDistrictName($reconcil_details->mouza_wise_details[0]->dist_code);
        ?>
        <h5 style="text-align:center">Mouza Wise Reconciliation Dashboard For Distrct <?=$dist_name?></h5>
    </div>

    <table class="table table-bordered" style="border-color:black; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);" id="mouz_dist_wise_table">
        <thead>
            <tr class="text-white" style="background: linear-gradient(to right, rgb(0 255 45), #ff0000);">
                <th scope="col" class="text-center">Rank</th> <!-- Rank Column -->
                <th scope="col" class="text-center">Mouza</th>
                <th scope="col" class="text-center">Books Issued</th>
                <th scope="col" class="text-center">Pages Issued</th>
                <th scope="col" class="text-center">Pages Settled</th>
                <th scope="col" class="text-center">Amount Received</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Create an array to hold pages settled and their respective mouza names
            $mouza_data = [];
            foreach ($reconcil_details->mouza_wise_details as $row) {
                $mouza_data[] = [
                    'mouza_name' => $row->mouza_name,
                    'total_no_of_cfr_books_issued' => $row->total_no_of_cfr_books_issued,
                    'total_no_of_cfr_pages_issued' => $row->total_no_of_cfr_pages_issued,
                    'total_no_of_offline_cfr_pages_settled' => $row->total_no_of_offline_cfr_pages_settled,
                    'total_amount_received_from_offline_cfr_payments' => $row->total_amount_received_from_offline_cfr_payments,
                ];
            }

            // Sort mouzas based on Pages Settled (descending)
            usort($mouza_data, function($a, $b) {
                return $b['total_no_of_offline_cfr_pages_settled'] <=> $a['total_no_of_offline_cfr_pages_settled'];
            });

            // Initialize rank and handle ties (same rank for 0 pages settled)
            $rank = 1;
            $previous_pages = -1; // For tie handling (especially for 0 pages settled)
            ?>
            
            <?php foreach ($mouza_data as $row): 
                $row_class = ($row['total_no_of_offline_cfr_pages_settled'] == 0) ? 'table-danger text-danger fw-bold' : ''; 

                // Determine rank
                if ($row['total_no_of_offline_cfr_pages_settled'] !== $previous_pages) {
                    // If current pages settled is different from previous, increment rank
                    $mouza_rank = $rank;
                    $previous_pages = $row['total_no_of_offline_cfr_pages_settled'];
                    $rank++; // Increment rank for the next mouza
                } else {
                    // Same rank for mouzas with the same pages settled
                    $mouza_rank = $rank - 1; // Same rank as previous mouza
                }
            ?>
                <tr class="text-center <?=$row_class?>">
                    <td class="rank-cell" style="background-color:black!important;border:1px solid white;"><?=$mouza_rank?></td> <!-- Rank with Style -->
                    <td class="<?=$row_class?>"><?=$row['mouza_name']?></td>
                    <td><?=$row['total_no_of_cfr_books_issued']?></td>
                    <td><?=$row['total_no_of_cfr_pages_issued']?></td>
                    
                    <?php if($row['total_no_of_offline_cfr_pages_settled'] == 0): ?>
                        <td class="text-black" style="background-color:#f57880">
                            <?=$row['total_no_of_offline_cfr_pages_settled']?>
                        </td>
                    <?php else: ?>
                        <td class="text-black">
                            <?=$row['total_no_of_offline_cfr_pages_settled']?>
                        </td>
                    <?php endif; ?>
                    
                    <td class="text-black">
                        <?=$row['total_amount_received_from_offline_cfr_payments']?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<link href="<?=base_url();?>assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet">
<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/buttons.html5.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/datatables/dataTableButtonJsZIP.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/datatableButtons.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/datatableButtonHtml.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#mouz_dist_wise_table').dataTable({
            "scrollX": true,
            "lengthMenu": [[2, 4, 8, -1], [2, 4, 8, "All"]],
            "pageLength": 10,
            "paging": true,
            "searching": true,
            "autoWidth": true,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-download"></i> Download As Excel',
                    titleAttr: 'Excel',
                    title: "Mouza Wise Reconciliation Report For <?=$dist_name?>- " + new Date().toISOString().split('T')[0],
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the 'View Details' column from export
                    }
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


