
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
        <h4 class="text-center">  <?php if ($type == 'verified_lm') {echo ('LM Verified NC Villages for ') . $dist_name;} else if ($type == 'certified_co') {echo ('CO Certified NC Villages for ') . $dist_name;} else if ($type == 'digi_signature_dc') {echo ('DC Certified NC Villages for ') . $dist_name;}?></h4>

        <div class="d-flex justify-content-between align-items-center" style="overflow-x:auto;">

            <table class="table table-bordered table-sm">

                <thead>
                <tr class="text-left">
                    <th scope="col">Village</th>
                    <th class="text-end" scope="col"><?php if ($type == 'verified_lm') {echo ('LM Verified');} else if ($type == 'certified_co') {echo ('CO Certified');} else if ($type == 'digi_signature_dc') {echo ('DC Certified');}?></th>
                    <th class="text-end" scope="col"><?php if ($type == 'verified_lm') {echo ('LM Verified At');} else if ($type == 'certified_co') {echo ('CO Certified At');} else if ($type == 'digi_signature_dc') {echo ('DC Certified At');}?></th>
                </tr>
                </thead>
                <tbody>

                <?php if (!empty($villages)): ?>
                    <?php foreach ($villages as $data): ?>
                        <?php if ($data["verified"]): ?>
                            <tr>
                                <td>
                                    <a href="#" class='' title=""><?php echo trim($data['loc_name']); ?></a>
                                </td>
                                <td class="text-sm text-end">
                                    <span class=""><?='Yes'?> </span>
                                </td>
                                <td class="text-sm text-end">
                                    <span class=""><?php if ($type == 'verified_lm') {echo date("jS F, Y g:i a", strtotime($data["verified"][0]["lm_verified_at"]));} else if ($type == 'certified_co') {echo date("jS F, Y g:i a", strtotime($data["verified"][0]["co_verified_at"]));} else if ($type == 'digi_signature_dc') {echo date("jS  F, Y g:i a", strtotime($data["verified"][0]["dc_verified_at"]));}?> </span>
                                </td>
                            </tr>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php else: ?>
                        <tr>
                            <td class="text-sm text-center" colspan="3">
                                <span class=""><?='No Villages'?> </span>
                            </td>
                        </tr>
                <?php endif;?>
                </tbody>
            </table>

        </div>
    </section>

</div>