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
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcAsstSectionOfficerController/viewProposal/pending'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Generated Draft Notification</td>
                    <td class="text-success">
                        <b>(Generated Draft Notification:  <?= $forwarded; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcAsstSectionOfficerController/viewNotification/verified'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Reverted Draft Notification</td>
                    <td class="text-danger">
                        <b>(Reverted Draft Notification:  <?= $reverted; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcAsstSectionOfficerController/viewNotification/reverted'; ?>" style="float:right">View</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
