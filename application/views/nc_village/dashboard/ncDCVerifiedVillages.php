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
    <h4 class="text-center">NC Village Status for <?=$dist_name?></h4>
    <div class="d-flex justify-content-between align-items-center" style="overflow-x:auto;">
        <table class="table table-bordered table-sm">
            <thead>
            <tr class="text-left" style="background-color: #ffc107;">
                <th scope="col">Village</th>
                <th class="text-end" scope="col">LM Verified</th>
                <th class="text-end" scope="col">CO Certified</th>
                <th class="text-end" scope="col">DC Certified</th>
                <th class="text-end" scope="col">DC Forwarded to DLRS</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($villages as $village): ?>
                <tr>
                    <td class="text-sm"><?=$village->village?></td>
                    <td class="text-sm text-end"><?=$village->lm_verified == 'Y' ? 'Yes' : 'No'?></td>
                    <td class="text-sm text-end"><?=$village->co_verified == 'Y' ? 'Yes' : 'No'?></td>
                    <td class="text-sm text-end"><?=$village->dc_verified == 'Y' ? 'Yes' : 'No'?></td>
                    <td class="text-sm text-end"><?=$village->dc_proposal_id == null ? 'NO' : 'Yes'?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

    </div>
</section>