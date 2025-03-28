<div class="col-lg-8 m-auto mt-4 pt-5">
    <div class="card">
        <div class="card-header bg-info">
            <div class="card-title text-white">
                NC VILLAGE PROCESS
            </div>
        </div>
        <div class="card-body">

            <table class="table table-striped table-hover table-bordered">

                <tr class="">
                    <td>Forwarded to JDS for Name Change on Map</td>
                    <td class="text-warning">
                        <b>(Pending:  <?= $count2->forwarded_name_change; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcAdlrController/viewNameChangePendings'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Pending Proposal Forwarded by DLRS</td>
                    <td class="text-danger">
                        <b>(Pending: <?= $count->pending_proposal; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcAdlrController/viewPendingProposal'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Proposal Forwarded to JDS</td>
                    <td class="text-success">
                        <b>(Forwarded Proposal: <?= $count->forwarded_proposal; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcAdlrController/forwardedToJdsProposal'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Proposal Reverted by JDS</td>
                    <td class="text-danger">
                        <b>(Pending: <?= $count->revert_back_from_jds; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcAdlrController/revertBackFromJds'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Proposal Forwarded to DLRS</td>
                    <td class="text-success">
                        <b>(Forwarded: <?= $count->revert_back_to_dlr; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcAdlrController/revertedBacktoDlrs'; ?>" style="float:right">View</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
