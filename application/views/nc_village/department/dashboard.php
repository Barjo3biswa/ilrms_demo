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
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcDepartController/viewPsProposal/pending'; ?>" style="float:right">View</a></td>
                </tr>

                <tr class="">
                    <td>Proposal Reverted By Secretary</td>
                    <td class="text-danger">
                        <b>(Reverted Proposal:  <?= $count->reverted_proposal; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcDepartController/viewPsProposal/reverted'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Pending Draft Notification</td>
                    <td class="text-danger">
                        <b>(Pending Draft Notification:  <?= $pending_notification; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcDepartController/viewNotification/pending'; ?>" style="float:right">View</a></td>
                </tr>

                <tr class="">
                    <td>Approved Notification by Minister</td>
                    <td class="text-danger">
                        <b>(Pending Notification:  <?= $approved_notification_by_minister; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcDepartController/viewApprovedNotification/pending'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Notification Reverted by Honourable Minister</td>
                    <td class="text-danger">
                        <b>(Reverted Notification:  <?= $reverted_notification; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcDepartController/viewNotification/reverted'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Notification Digitally Signed by Senior Most Secretary</td>
                    <td class="text-success">
                        <b>(Digitally Signed:  <?= $notification_sign_by_ps; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcDepartController/viewApprovedNotification/verified'; ?>" style="float:right">View</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
