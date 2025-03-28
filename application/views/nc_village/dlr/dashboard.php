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
                    <td>View Draft Chitha and Map</td>
                    <td class="text-danger">
                        <b>(Pending Villages:  <?= $count->count; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcDlrController/viewPendingCasesPage'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Proposal for approval and notification</td>
                    <td class="text-danger">
                        <b>(Pending Villages:  <?= $count->pro_count; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcDlrController/showProposalDistWise'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Approved Notification</td>
                    <td class="text-primary">
                        <b>(Approved Notification:  <?= $pending_notification_sign_by_ps; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcDlrController/showNotification/pending'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Reverted From ADLR, Senior Most Secretary</td>
                    <td class="text-danger">
                        <b>(Reverted Proposal:  <?= $revert_notification + $count->revert_proposal; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcDlrController/showRevertedProposal/reverted'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Forwarded to JDS for Name Change on Map</td>
                    <td class="text-warning">
                        <b>(Pending:  <?= $count->forwarded_name_change; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcDlrController/viewNameChangePendings'; ?>" style="float:right">View</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
