
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
        <h4 class="text-center">Mouza Wise Data Entered Villages for <?=$dist_name?></h4>

        <div class="d-flex justify-content-between align-items-center" style="overflow-x:auto;">

            <table class="table table-bordered table-sm">

                <thead>
                <tr class="text-left">
                    <th scope="col">Mouza</th>
                    <th class="text-end" scope="col">Dag Entered</th>
                </tr>
                </thead>
                <tbody>

                <?php if (!empty($mouzas)): ?>
                    <?php foreach ($mouzas as $mouza_code => $data): ?>
                        <tr>
                            <td>
                                <a href="<?=base_url('index.php/nc_village/NcDashboardController/getDataEnteredLot') . '/' . $dist_code . '/' . $data['loc_name']['subdiv']['subdiv_code'] . '/' . $cir_code . '/' . $mouza_code?>" class='' title=""><?php echo trim($data['loc_name']['mouza']['loc_name']); ?></a>
                            </td>
                            <td class="text-sm text-end">
                                <span class=""><?=$data["total_count"]?> </span>
                            </td>
                        </tr>
                    <?php endforeach;?>
                <?php else: ?>
                    <tr>
                        <td class="text-sm text-center" colspan="2">
                            <span class=""><?='No Data Available'?> </span>
                        </td>
                    </tr>
                <?php endif;?>
                </tbody>
            </table>

        </div>
    </section>

</div>