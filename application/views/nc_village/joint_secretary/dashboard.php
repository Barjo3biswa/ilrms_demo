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
                    <td>Pending Proposal</td>
                    <td class="text-danger">
                        <b>(Pending Proposal:  <?= $count->pending_proposal; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcJointSecretaryController/viewProposal/pending'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Forwarded Proposal</td>
                    <td class="text-success">
                        <b>(Forwarded Proposal:  <?= $count->forwarded_proposal; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcJointSecretaryController/viewProposal/verified'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Proposal Reverted By Section Officer</td>
                    <td class="text-danger">
                        <b>(Reverted Proposal:  <?= $count->reverted_proposal; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcJointSecretaryController/viewProposal/reverted'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td> Pending Draft Notification</td>
                    <td class="text-danger">
                        <b>(Pending Notification:  <?= $pending_notification; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcJointSecretaryController/viewNotification/pending'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Forwarded Draft Notification</td>
                    <td class="text-success">
                        <b>(Forwarded Notification:  <?= $forwarded_notification; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcJointSecretaryController/viewNotification/verified'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Reverted Draft Notification</td>
                    <td class="text-danger">
                        <b>(Reverted Notification:  <?= $reverted_notification; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcJointSecretaryController/viewNotification/reverted'; ?>" style="float:right">View</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
