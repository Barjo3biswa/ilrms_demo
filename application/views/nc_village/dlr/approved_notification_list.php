<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>
<script>
    function alpineData() {
        return {
            'notification_id': '',
            'dist_code': '',
            'adlr_note': '',
            'jds_note': '',
            'is_loading': false,
            'is_forwarding': false,
            openModal(notification_id, dist_code) {
                this.dist_code = dist_code;
                this.notification_id = notification_id;
                this.adlr_note = 'Land records to be Ported in Dharitree';
                this.jds_note = 'Map to be ported in Bhunaksha';
                $('#modal_notification').modal('show');
            },
            sendMessage() {
                var self = this;
                this.is_forwarding = true;
                $.confirm({
                    title: 'Confirm',
                    content: 'Please confirm to Send Message',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function () {
                                $.ajax({
                                    url: '<?= base_url(); ?>index.php/nc_village/NcDlrController/sendMessage',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: {
                                        'notification_id': self.notification_id,
                                        'dist_code': self.dist_code,
                                        'adlr_note': self.adlr_note,
                                        'jds_note': self.jds_note
                                    },
                                    success: function (data) {
                                        if (data == 'N') {
                                            $.confirm({
                                                title: 'Error Occurred!!',
                                                content: 'Something went wrong. Please try again later.',
                                                type: 'orange',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function () {
                                                            self.is_forwarding = false;
                                                        }
                                                    },
                                                }
                                            });
                                        } else if (data == 'Y') {
                                            $.confirm({
                                                title: 'Success',
                                                content: 'Messages Sent Successfully.',
                                                type: 'green',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function () {
                                                            location.reload();
                                                            self.is_forwarding = false;
                                                        }
                                                    },
                                                }
                                            });
                                            self.is_forwarding = false;
                                        }
                                        self.is_forwarding = false;
                                    },
                                    error: function (error) {
                                        $.confirm({
                                            title: 'Error Occurred!!',
                                            content: 'Please contact the system admin',
                                            type: 'red',
                                            typeAnimated: true,
                                            buttons: {
                                                Ok: {
                                                    text: 'OK',
                                                    btnClass: 'btn-info',
                                                    action: function () {
                                                        self.is_forwarding = false;
                                                    }
                                                },
                                            }
                                        });
                                        self.is_forwarding = false;
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            btnClass: 'btn-warning',
                            action: function () {
                                self.is_forwarding = false;
                            }
                        },
                    }
                });
            },
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="text-center p-2 mb-2"
         style="font-size:18px; font-weight: bold; background-color: #4298c9; color: white">NC VILLAGE
        (Notification <?php if ($type == 'pending'): ?> at <?php elseif ($type == 'verified'): ?> Approved by <?php endif; ?>
        DLRS )
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> List
                                of <?php if ($type == 'pending'): ?> Notification at DLRS<?php elseif ($type == 'verified'): ?> Approved Notification  <?php endif; ?></h5>
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
                            <?php if ($type == 'pending'): ?>
                                <th>Notification</th>
                                <th>Action</th>
                            <?php endif; ?>
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
                                <?php if ($type == 'pending'): ?>
                                    <td>
                                        <a class="btn btn-sm btn-success text-white"
                                           href="<?= base_url('index.php/nc_village/NcCommonController/viewSignNotification/') . $p->notification_no; ?>"
                                           target="_blank">View <i class=" fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <?php if ($p->dlr_to_adlr_msg == null): ?>
                                        <button type="button"
                                                x-on:click="openModal(<?php echo $p->id . ',' . $p->dist_code; ?>)"
                                                class="btn btn-sm btn-primary text-white">Send Message <i
                                                    class="fa fa-mail-forward"></i></button>
                                        <?php else: ?>
                                        <span class="text-success"> Message Sent</span>
                                        <?php endif; ?>
                                    </td>
                            <?php endif; ?>
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

    <div class="modal" id="modal_notification" tabindex="-1" aria-labelledby="modal_notification" data-backdrop="static"
         data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="width: 100% !important;">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title"><i class="fa fa-mail-forward"></i> Send Message of NC Village as a Cadastral
                        Village</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="" class="form-label" style="font-weight: bold;">Message send to ADLR <span
                                style="color:red;">*</span></label>
                    <textarea x-model="adlr_note" placeholder="" rows="2"
                              class="form-control"></textarea>
                    <label for="" class="form-label" style="font-weight: bold;">Message send to JDS <span
                                style="color:red;">*</span></label>
                    <textarea x-model="jds_note" placeholder="" rows="2"
                              class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="closeBtn" data-dismiss="modal">
                        <i class='fa fa-close'></i> Close
                    </button>
                    <?php if ($type == 'pending'): ?>
                        <input type="hidden" id="timeServerURL" name="timeServerURL" style="width: 400px;"/>
                        <button x-on:click="sendMessage" type="button" class="btn btn-primary"><i
                                    class="fa fa-mail-forward"></i>
                            Send Message
                        </button>
                    <?php endif; ?>
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
