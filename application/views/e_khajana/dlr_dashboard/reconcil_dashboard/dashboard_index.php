<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="<?=base_url();?>assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet">
<script src="<?=base_url('assets/js/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?=base_url('assets/js/datatables/dataTables.buttons.min.js');?>"></script>
<script src="<?=base_url('assets/js/datatables/jszip.min.js');?>"></script>
<script src="<?=base_url('assets/js/datatables/buttons.html5.min.js');?>"></script>

<style>

    .rank-cell {
        background-color: black;
        color: white;
        font-weight: bold;
    }

    .container {
        max-width: 95%;
        margin: auto;
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
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .box_color {
        background: linear-gradient(0deg, rgb(95 195 34) 0%, rgb(2 36 14) 100%);
        border-radius: 10px;
        height: 40px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        font-weight: bold;
        margin: 10px;
        box-shadow: 0px 4px 10px rgba(17, 114, 88, 0.82);
    }

    .chart-container {
        width: 100%;
        height: 300px;
        margin: auto;
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="container mb-5">
    <!-- e-Khazana Reconciliation Summary -->
    <div class="section-box mt-3">
        <div class="section-title"><i class="fas fa-file-invoice-dollar me-2"></i> e-Khazana Reconciliation Summary</div>
        <div class="row">
            <div class="col-lg-6">
                <div class="box_color">
                    <i class="fas fa-check-circle me-2"></i> Total Offline CFR Pages Settled (Till Now): <kbd><?=$reconcil_details->total_no_of_offline_cfr_pages_settled?></kbd>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box_color">
                    <i class="fas fa-wallet me-2"></i> Total Amount Received: <kbd><?=$reconcil_details->total_amount_received_from_offline_cfr_payments?></kbd>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="box_color">
                    <i class="fas fa-book me-2"></i> Total No Of Manual CFR Books Issued <kbd><?=$reconcil_details->total_no_of_offline_cfr_books?></kbd>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box_color">
                    <i class="fas fa-file-alt me-2"></i> Total No Of Manual CFR Pages <kbd><?=$reconcil_details->total_no_of_offline_cfr_pages?></kbd>
                </div>
            </div>
	</div>
        <?php $total_left_to_settle = $reconcil_details->total_no_of_offline_cfr_pages - $reconcil_details->total_no_of_offline_cfr_pages_settled; ?>
        <div class="col-lg-6 offset-3">
            <div class="box_color text-white">
                <i class="fas fa-exclamation-triangle me-2"></i> Total No Of Manual CFR's left (To Be Settled) <kbd><?=$total_left_to_settle?></kbd>
            </div>
        </div>
    </div>
    <!-- Reconciliation Day To Day Analysis -->
    <div class="section-box">
        <div class="section-title"><i class="fas fa-chart-line me-2"></i> Graphical Analysis Of Last 30 Day's Manual CFR Payments</div>
        <div class="chart-container">
            <canvas id="reconciliationChart"></canvas>
        </div>
    </div>
    <!-- District Wise Reconciliation Dashboard -->
    <div class="section-box">
        <div class="section-title mb-3"><i class="fas fa-map-marker-alt me-2"></i> District Wise Reconciliation Dashboard</div>
        <table class="table table-bordered" id="dist_wise_table">
            <thead>
                <tr style="background-color: black; color: white;" class="text-center">
                    <th>Rank</th> <!-- New Rank Column -->
                    <th>District</th>
                    <th>Books Issued</th>
                    <th>Pages Issued</th>
                    <th>Pages Settled</th>
                    <th>CFR Pages Left to be Settled</th> <!-- New Column -->
                    <th>Amount Received</th>
                    <th>View Details</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Create an array to hold pages settled and their respective district names
                $district_data = [];
                foreach ($reconcil_details->district_wise_details as $row) {
                    $district_data[] = [
                        'district_name' => $row->district_name,
                        'total_no_of_cfr_books_issued' => $row->total_no_of_cfr_books_issued,
                        'total_no_of_cfr_pages_issued' => $row->total_no_of_cfr_pages_issued,
                        'total_no_of_offline_cfr_pages_settled' => $row->total_no_of_offline_cfr_pages_settled,
                        'total_amount_received_from_offline_cfr_payments' => $row->total_amount_received_from_offline_cfr_payments,
                        'dist_code' => $row->dist_code
                    ];
                }

                // Sort districts based on Pages Settled (descending), with ties handled
                usort($district_data, function($a, $b) {
                    return $b['total_no_of_offline_cfr_pages_settled'] <=> $a['total_no_of_offline_cfr_pages_settled'];
                });

                // Initialize the rank and handle ties (districts with 0 pages settled get same rank)
                $rank = 1;
                $previous_pages = -1; // For tie handling (especially for 0 pages settled)
                ?>
                <?php foreach ($district_data as $row): 
                    $row_class = ($row['total_no_of_offline_cfr_pages_settled'] == 0) ? 'table-danger text-danger fw-bold' : ''; 

                    // Determine rank
                    if ($row['total_no_of_offline_cfr_pages_settled'] !== $previous_pages) {
                        // If current pages settled is different from previous, increment rank
                        $district_rank = $rank;
                        $previous_pages = $row['total_no_of_offline_cfr_pages_settled'];
                        $rank++; // Increment rank for the next district
                    } else {
                        // Same rank for districts with the same pages settled
                        $district_rank = $rank - 1; // Same rank as previous district
                    }
                ?>
                    <tr class="text-center <?=$row_class?>">
                        <td class="rank-cell" style="background-color:black!important;border:1px solid white;"><?=$district_rank?></td> <!-- Display Rank with Styling -->
                        <td class="<?=$row_class?>"><?=$row['district_name']?></td>
                        <td><?=$row['total_no_of_cfr_books_issued']?></td>
                        <td><?=$row['total_no_of_cfr_pages_issued']?></td>
                        <td><?=$row['total_no_of_offline_cfr_pages_settled']?></td>
                        <td>
                            <?php 
                            // Calculate CFR Pages Left to be Settled
                            $pages_left = $row['total_no_of_cfr_pages_issued'] - $row['total_no_of_offline_cfr_pages_settled'];
                            echo $pages_left;
                            ?>
                        </td>
                        <td><?=$row['total_amount_received_from_offline_cfr_payments']?></td>
                        <td>
                            <a target="_blank" href="<?=base_url('EkhajanaDlrDashboard/MouzaWiseReconciliationDashborad/'.$row['dist_code'])?>">
                                <button class="btn btn-success btn-sm"><i class="fas fa-eye me-1"></i> View Details</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch("https://basundhara.assam.gov.in/rtpsmb/EkhajanaReconciliationDashboard/getReconciliationGraphDataForState")
            .then(response => response.json())
            .then(responseData => {
                const data = responseData.data;
                const labels = data.map(entry => entry.date);
                const values = data.map(entry => entry.total_amount);
                const ctx = document.getElementById("reconciliationChart").getContext("2d");

                const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                gradient.addColorStop(0, "rgba(75, 192, 192, 1)");
                gradient.addColorStop(1, "rgba(75, 192, 192, 0.3)");

                new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Total Amount (₹)",
                            data: values,
                            backgroundColor: gradient,
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: { grid: { display: false } },
                            y: { beginAtZero: true }
                        },
                        plugins: {
                            legend: { display: false }
                        }
                    }
                });
            })
            .catch(error => console.error("Error fetching graph data:", error));
    });

    $(document).ready(function () {
        $('#dist_wise_table').dataTable({
            "scrollX": true,
            "lengthMenu": [ [5, 10, 15, -1], [5, 10, 15, "All"] ],
            "pageLength": 5,
            "paging": true,
            "searching" : true,
            "autoWidth":true,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-download"></i> Download As Excel',
                    titleAttr: 'Excel',
                    title: "District Wise Reconciliation Report - " + new Date().toISOString().split('T')[0],
                    exportOptions: {
                        columns: ':visible:not(:last-child)' // Hide the last column in the export
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

