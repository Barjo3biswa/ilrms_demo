
<style>
    td a:hover {
        font-size: 1.2em;
        color: #136a8a;
    };
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

    <section class="content ms-5 me-5">
        <h5 class="text-center">  <?php if ($type == 'dlr_forwarded') {echo ('District Wise Number of Villages Forwarded by DLRS');} else if ($type == 'dlrs_pending') {echo ('District Wise Number of Villages Pending at DLRS');} else if ($type == 'dc_forwarded') {echo ('District Wise Number of Villages Forwarded by DC');}?></h5>

        <div class="d-flex justify-content-between align-items-center" style="overflow-x:auto;">

            <table class="table table-bordered table-sm">

                <thead>
                <tr class="text-left">
                    <th scope="col">District</th>
                    <th class="text-end" scope="col"><?php if ($type == 'dlr_forwarded') {echo ('DLRS Forwarded');} else if ($type == 'dlrs_pending') {echo ('Pending at DLRS');} else if ($type == 'dc_forwarded') {echo ('DC Forwarded');}?></th>
                </tr>
                </thead>
                <tbody>

                <?php if (isset($districts)): ?>
                    <?php foreach ($districts as $dist_code => $data): ?>
                        <?php if ($type == 'dlr_forwarded') {$count = ($data['village']);} else if ($type == 'dlrs_pending') {$count = ($data['village']);} else if ($type == 'dc_forwarded') {$count = ($data['village']);}?>
                        <tr>
                            <td>
                                <a href="<?=base_url('index.php/nc_village/NcDashboardController/dashboardDeptCircle/') . $type . '/' . $dist_code?>" class='' title=""><?php echo trim($data['loc_name']['dist']['loc_name']); ?></a>
                            </td>
                            <td class="text-sm text-end">
                                <span class=""><?=$count?> </span>
                            </td>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
                </tbody>
            </table>

        </div>
    </section>

</div>