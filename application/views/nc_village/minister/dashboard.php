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
                    <td>Pending Draft Notification</td>
                    <td class="text-danger">
                        <b>(Pending Notification:  <?= $pending_notification; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcMinisterController/viewNotification/pending'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Approved Notification</td>
                    <td class="text-success">
                        <b>(Approved Notification:  <?= $forwarded_notification; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcMinisterController/viewNotification/verified'; ?>" style="float:right">View</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
