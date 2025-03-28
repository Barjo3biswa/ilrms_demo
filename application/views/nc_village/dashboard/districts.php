
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
        <h4 class="text-center">  <?php if ($type == 'verified_lm') {echo ('District Wise Number of LM Verified NC Villages');} else if ($type == 'certified_co') {echo ('District Wise Number of CO Certified NC Villages');} else if ($type == 'digi_signature_dc') {echo ('District Wise Number of DC Certified NC Villages');}?></h4>

        <div class="d-flex justify-content-between align-items-center" style="overflow-x:auto;">

            <table class="table table-bordered table-sm">

                <thead>
                <tr class="text-left">
                    <th scope="col">District</th>
                    <th class="text-end" scope="col"><?php if ($type == 'verified_lm') {echo ('LM Verified');} else if ($type == 'certified_co') {echo ('CO Certified');} else if ($type == 'digi_signature_dc') {echo ('DC Certified');}?></th>
                </tr>
                </thead>
                <tbody>

                <?php if (isset($districts)): ?>
                    <?php foreach ($districts as $dist_code => $data): ?>
                        <?php if ($type == 'verified_lm') {$count = ($data['verified_lm_count']);} else if ($type == 'certified_co') {$count = ($data['certified_co_count']);} else if ($type == 'digi_signature_dc') {$count = ($data['digi_signature_dc_count']);}?>
                        <tr>
                            <td>
                                <a href="<?=base_url('index.php/nc_village/NcDashboardController/getNcCirclesByStatus/') . $type . '/' . $dist_code?>" class='' title=""><?php echo trim($data['loc_name']['dist']['loc_name']); ?></a>
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