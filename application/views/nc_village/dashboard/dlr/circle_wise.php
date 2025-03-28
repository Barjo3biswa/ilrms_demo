
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
        <h5 class="text-center">  <?php if ($type == 'dlr_forwarded') {echo ('Circle Wise Number of DLRS Forwarded NC Villages');} else if ($type == 'dlrs_pending') {echo ('Circle Wise Number of NC Villages Pending at DLRS');}
        else if ($type == 'digi_signature_dc') {echo ('Circle Wise Number of DC Certified NC Villages');}
        else if ($type == 'dc_forwarded') {echo ('Circle Wise Number of Villages Forwarded by DC');}?></h5>

        <div class="d-flex justify-content-between align-items-center" style="overflow-x:auto;">

            <table class="table table-bordered table-sm">

                <thead>
                <tr class="text-left">
                    <th scope="col">District</th>
                    <th scope="col">Circle</th>
                    <th class="text-end" scope="col">
                        <?php if ($type == 'dlr_forwarded') {echo ('DLRS Forwarded');} else if ($type == 'dlrs_pending')
                        {echo ('Pending at DLRS');} else if ($type == 'dc_forwarded') {echo ('DC Certified');}?></th>
                </tr>
                </thead>
                <tbody>

                <?php if (!empty(($circles))): ?>
                    <?php foreach ($circles as $data): ?>
                        <?php if ($data["count"] != 0): ?>
                            <tr>
                                <td>
                                    <a href="<?=base_url('index.php/nc_village/NcDashboardController/dashboardDeptMouza/') . $type . '/' . $data['dist_code'] . '/' . $data['subdiv_code'] . '/' . $data['cir_code']?>" class='' title=""><?php echo $dist_name; ?></a>
                                </td>
                                <td>
                                    <a href="<?=base_url('index.php/nc_village/NcDashboardController/dashboardDeptMouza/') . $type . '/' . $data['dist_code'] . '/' . $data['subdiv_code'] . '/' . $data['cir_code']?>" class='' title=""><?php echo trim($data['loc_name']); ?></a>
                                </td>
                                <td class="text-sm text-end">
                                    <span class=""><?=$data['count']?> </span>
                                </td>
                            </tr>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php else: ?>
                    <tr>
                        <td class="text-sm text-center" colspan="3">
                            <span class=""><?='No Data Available'?> </span>
                        </td>
                    </tr>
                <?php endif;?>
                </tbody>
            </table>

        </div>
    </section>

</div>