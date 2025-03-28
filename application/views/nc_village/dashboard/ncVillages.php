<!--Verified NC Villages -->

<style>
    .dataTables_filter{
        margin-bottom: 20px; /* Table Filter Margin */
    }
</style>

<div class="card" id="dashboard_header_name_div" style="display:block">
    <div class="card-header  text-black h5 text-center">
        <span id="dh_name_text">NC Village Dashboard</span>
    </div>
</div>



<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: #ffffff !important">
            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>index.php/nc_village/NcDashboardController/dashboard">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">NC Village Dashboard</li>
        </ol>
    </nav>
</div> <!---// end of class container-fluid ---->

<section class="content ms-5 me-5">
    <h4 class="text-center">  <?php if ($type == 'verified_lm') {echo ('Number of LM Verified NC Districts');} else if ($type == 'certified_co') {echo ('Number of CO Certified NC Villages');} else if ($type == 'digi_signature_dc') {echo ('Number of DC Certified NC Districts');}?></h4>


    <div class="d-flex justify-content-between align-items-center" style="overflow-x:auto;">

        <table class="table table-bordered table-sm">

            <thead>
            <tr class="text-left" style="background-color: #ffc107;">
                <th scope="col">District</th>
                <th class="text-end" scope="col">Circle</th>
                <th class="text-end" scope="col">Mouza</th>
                <th class="text-end" scope="col">Lot No</th>
                <th class="text-end" scope="col">Village</th>
                <th class="text-end" scope="col">DC Verified</th>
                <th class="text-end" scope="col">DC Note</th>
                <th class="text-end" scope="col">CO Note</th>
                <?php if ($designation == "DLR"): ?>
                    <th class="text-end" scope="col">Action</th>

                <?php else: ?>
                    <th class="text-end" scope="col">DLRS Verified</th>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($villages as $village): ?>
                <tr>
                    <td class="text-sm"><?=$this->utilclass->getDistrictName($dist_code)?></td>
                    <td class="text-sm text-end"><?=$village["circle"]?></td>
                    <td class="text-sm text-end"><?=$village["mouza"]?></td>
                    <td class="text-sm text-end"><?=$village["lot"]?></td>
                    <td class="text-sm text-end"><?=$village["village"]?></td>
                    <td class="text-sm text-end"><?=$village["dc_verified_at"]?></td>
                    <td class="text-sm text-end"><?=$village["dc_note"]?></td>
                    <td class="text-sm text-end"><?=$village["co_note"]?></td>
                    <?php if ($designation == "DLR"): ?>
                        <?php if ($village["dc_verified"] === "Y"): ?>
                            <th style="text-align: center;">
                                <a class="btn btn-sm btn-info text-white" href=<?=base_url('index.php/nc_village/NcDlrController/getPendingVillage?application_no=') . $village["application_no"] . '&d=' . $village["dist_code"]?>> Proceed <i class=" fa fa-chevron-right"></i></a>
                            </th>
                        <?php else: ?>
                            <td class="text-sm text-end">DC Verification Pending</td>

                        <?php endif;?>
                    <?php else: ?>
                        <?php if ($village["dlr_verified"] === "Y"): ?>
                            <td class="text-sm text-end">Yes</td>
                        <?php else: ?>
                            <td class="text-sm text-end">No</td>
                        <?php endif;?>
                    <?php endif;?>

                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

    </div>
</section>