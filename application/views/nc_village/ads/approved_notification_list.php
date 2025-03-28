<div class="col-lg-12 col-md-12 p-2" >
    <div class="text-center p-2 mb-2"
         style="font-size:18px; font-weight: bold; background-color: #4298c9; color: white">NC VILLAGE
        ( <?php if ($type == 'verified'): ?> Approved Notification <?php endif; ?>)
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> List
                                of <?php if ($type == 'verified'): ?> Approved Notification  <?php endif; ?></h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                        <tr>
                            <th>#</th>
                            <th>Proposal No</th>
                            <th>Notification No</th>
                            <th>Senior Most Secretary Note</th>
                            <th>Proposal</th>
                            <th>Notification</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($notification as $key => $p): ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $p->proposal_no ?></td>

                                <td><?= $p->notification_no ?></td>
                                <td><?= $p->ps_sign_note ?></td>
                                <td>
                                    <a class="btn btn-sm btn-info text-white" href="<?= base_url() ?>index.php/nc_village/NcCommonMyController/getVillagesProposalWise?proposal_id=<?= $p->proposal_id ?>&proposal_no=<?= $p->proposal_no ?>&dist_code=<?= $p->dist_code ?>"
                                       target="_blank">View <i class=" fa fa-eye"></i></a>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-success text-white"
                                       href="<?= base_url('index.php/nc_village/NcCommonController/viewSignNotification/') . $p->notification_no; ?>"
                                       target="_blank">View <i class=" fa fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (count($notification) == 0): ?>
                            <tr>
                                <td colspan="8" class="text-center">
                                    <span>No Notification Found</span>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<button id="loader2" class="btn btn-primary invisible">
    <span class="spinner-border spinner-border-sm"></span>
    Loading..
</button>
<style>
    #loader2 {
        position: fixed;
        z-index: 999999;
        /* High z-index so it is on top of the page */
        top: 50%;
        right: 50%;
        /* or: left: 50%; */
        margin-top: -. . px;
        /* half of the elements height */
        margin-right: -. . px;
        /* half of the elements width */
    }
</style>
