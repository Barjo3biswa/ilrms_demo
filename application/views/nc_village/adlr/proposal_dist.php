<div class="col-lg-8 m-auto mt-4 pt-5">
    <div class="card">
        <div class="card-header bg-info">
            <div class="card-title text-white">
                NC VILLAGE PROPOSAL DISTRICT WISE
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover table-bordered">
                <?php foreach ($dist_list as $d): ?>
                <tr class="">
                    <td><?= $d->loc_name; ?> </td>
                    <td class="text-success">
                        <b>(Pending Villages:  <?= $d->count; ?>)</b>
                    </td>
                    <td><a class="btn  btn-sm btn-info" href="<?php echo base_url() . 'index.php/nc_village/NcAdlrController/showProposalVillages/'. $d->dist_code;; ?>" style="float:right">View</a></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>
</div>
