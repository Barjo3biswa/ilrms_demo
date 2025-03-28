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
                    <td>Pending Name Change on Map</td>
                    <td class="text-warning">
                        <b><?= $name_change_count->count; ?></b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcAdsController/viewPendingNameChangeOnMap'; ?>" style="float:right">View</a></td>
                </tr>
                <tr class="">
                    <td>Approved Notification</td>
                    <td class="text-danger">
                        <b><?= $approved_notification; ?></b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcAdsController/viewApprovedNotification'; ?>" style="float:right">View</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
