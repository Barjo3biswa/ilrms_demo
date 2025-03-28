<?php
if (count($ekhajana_registration_details) === 0) {
    // No payment and no registration
    ?>
    <div class="panel-body shadow border rounded p-3 mt-4">
        <h5 class="bg-danger p-2 text-white text-center">
            No Payment and No Registration Found for the Given Patta Details
        </h5>
    </div>
    <?php
} else {
    // Payment and registration details exist
    ?>
    <style>
        .consolidated-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            background-color: #f9f9f9;
        }

        .consolidated-container h5 {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            max-height: 400px; /* Adjust height as needed */
            overflow-y: auto;
            overflow-x: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: -10px;
            background-color: #ffffff;
        }

        .table th, .table td {
            text-align: center;
        }

        .thead-dark th {
            background-color: #343a40;
            color: #fff;
        }
    </style>

    <link rel="stylesheet" href="<?= base_url('css/select2.min.css'); ?>">
    <script src="<?= base_url('js/select2.min.js'); ?>"></script>
    <input type="hidden" value="<?= base_url() ?>" id="base_url" name="base_url">

    <div class="consolidated-container mb-5">
        <div class="panel-body">
            <h5 class="bg-warning p-2 text-white text-center">
                Online Payment Status - 
                <span class="text-white font-weight-bold"><?= $payment_status ?></span>
            </h5>
        </div>

        <div class="panel-body" style="margin-top:-10px;">
            <h5 class="bg-info p-2 text-white text-center">
                Registered Application Details
            </h5>
        </div>

        <div class="table-container">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>APPLICATION-NO</th>
                        <th>LAND-APPLICATION-NO</th>
                        <th>PATTADAR-NAME</th>
                        <th>STATUS</th>
                        <th>REGISTERED-TIME</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ekhajana_registration_details as $row): ?>
                        <?php
                        if ($row->status == 'P') {
                            $status = "PENDING AT MOUZADAR/LM";
                        } else if ($row->status == 'MLM_F') {
                            $status = "PENDING AT MOUZADAR";
                        } else if ($row->status == 'MOU_F') {
                            $status = "PENDING AT LM";
                        } else if ($row->status == 'COM_F') {
                            $status = "PENDING AT CO";
                        } else if ($row->status == 'R') {
                            $status = "REJECTED";
                        } else if ($row->status == 'F') {
                            $status = "DELIVERED";
                        }
                        $date = new DateTime($row->created_at);
                        $formattedDate = $date->format('l, F j, Y, h:i A');
                        ?>
                        <tr>
                            <td><?= $row->application_no ?></td>
                            <td><?= $row->ld_application_no ?></td>
                            <td><?= $row->pdar_name ?></td>
                            <td><?= $status ?></td>
                            <td><?= $formattedDate ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}
?>

