
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
        <h5 class="text-center">  <?php if ($type == 'dc_forwarded') {echo ('DC Forwarded NC Villages');} else if ($type == 'dlrs_pending') {echo ('NC Villages Pending at DLRS ');} else if ($type == 'dlr_forwarded') {echo ('DLRS Forwarded NC Villages');}?></h5>

        <div class="d-flex justify-content-between align-items-center" style="overflow-x:auto;">

            <table class="table table-bordered table-sm">

                <thead>
                <tr class="text-left">
                    <th scope="col">District</th>
                    <th scope="col">Circle</th>
                    <th scope="col">Village</th>
                    <th class="text-end" scope="col"><?php if ($type == 'dc_forwarded') {echo ('DC Certified on');} else if ($type == 'dlrs_pending') {echo ('DC Certified on');} else if ($type == 'dlr_forwarded') {echo ('DLRS Certified on');}?></th>
                    <th class="text-end" scope="col"><?php if ($type == 'dc_forwarded') {echo ('DC Forwarded');} else if ($type == 'dlrs_pending') {echo ('Pending at DLRS');} else if ($type == 'dlr_forwarded') {echo ('DLRS Forwarded');}?></th>
                    <?php if ($type == 'dlrs_pending'): ?>
                        <th class="text-end" scope="col">DC Proposal</th>
                        <th scope="col" class="text-end">Action</th>
                    <?php endif; ?>
                    <?php if ($type == 'dlr_forwarded'): ?>
                    <th scope="col" class="text-end">DLRS Proposal</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>

                <?php if (!empty($villages)): ?>
                    <?php foreach ($villages as $data): ?>
                        <?php if ($data["verified"]): ?>
                            <tr>
                                <td>
                                    <a href="#" class='' title=""><?php echo $dist_name; ?></a>
                                </td>
                                <td>
                                    <a href="#" class='' title=""><?php echo $data['circle_name']['loc_name']; ?></a>
                                </td>
                                <td>
                                    <a href="#" class='' title=""><?php echo trim($data['loc_name']); ?></a>
                                </td>
                                <td class="text-sm text-end">
                                    <span class=""><?php if ($type == 'dc_forwarded')
                                    {echo date("jS F, Y g:i a", strtotime($data["verified"][0]["dc_verified_at"]));}
                                    else if ($type == 'dlrs_pending') {echo date("jS F, Y g:i a", strtotime($data["verified"][0]["dc_verified_at"]));}
                                    else if ($type == 'dlr_forwarded') {echo date("jS  F, Y g:i a", strtotime($data["verified"][0]["dlr_verified_at"]));}?>
                                    </span>
                                </td>
                                <td class="text-sm text-end">
                                    <span class=""><?='Yes'?> </span>
                                </td>
                                <?php if ($type == 'dlrs_pending'): ?>
                                    <th class="text-sm text-end" scope="col">
                                        <a class="btn  btn-sm btn-primary" href="<?=base_url('index.php/nc_village/NcDashboardController/viewDcProposal/').$data["verified"][0]["dist_code"].'/'.$data["verified"][0]["dc_proposal_id"];?>" target="_blank">
                                            <i class='fa fa-eye'></i> View
                                        </a>
                                    </th>
                                    <?php if($data["verified"][0]["dlr_verified"] == 'Y') : ?>
                                        <th class="text-sm text-end" scope="col">
                                            <a class="btn  btn-sm btn-success" href="<?=base_url('index.php/nc_village/NcDlrController/showProposalVillages/').$data["verified"][0]["dist_code"];?>">
                                                <i class='fa fa-file'></i> Proposal Sent
                                            </a>
                                        </th>
                                    <?php else: ?>
                                        <th class="text-sm text-end" scope="col">
                                            <a class="btn  btn-sm btn-primary" href="<?=base_url('index.php/nc_village/NcDlrController/getPendingVillage?application_no=').$data["verified"][0]["application_no"].'&d='.$data["verified"][0]["dist_code"];?>">
                                                <i class='fa fa-forward'></i> Proceed
                                            </a>
                                        </th>
                                    <?php endif; ?>
                                <?php elseif ($type == 'dlr_forwarded'): ?>
                                    <th class="text-sm text-end" scope="col">
                                        <a class="btn  btn-sm btn-primary" href="<?=base_url('index.php/nc_village/NcDashboardController/viewDlrProposal/').$data["verified"][0]["dist_code"].'/'.$data["verified"][0]["dlr_proposal_id"];?>" target="_blank">
                                            <i class='fa fa-eye'></i> View
                                        </a>
                                    </th>
                                <?php endif; ?>
                            </tr>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php else: ?>
                    <tr>
                        <td class="text-sm text-center" colspan="5">
                            <span class=""><?='No Villages'?> </span>
                        </td>
                    </tr>
                <?php endif;?>
                </tbody>
            </table>

        </div>
    </section>

</div>