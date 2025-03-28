<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>
<style>
    .custom-confirm-popup {
        width: 700px;
    }
</style>
<script>
    function alpineData() {
        return {
            proposal_id:'',
            proposal_no:'',
            dist_code:'',
            notification_id:'',
            is_forwarding:false,
            generateNotification(notification_id,dist_code) {
                this.notification_id = notification_id;
                this.dist_code = dist_code;
                var self = this;
                this.is_forwarding = true;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcMinisterController/viewVerifiedNotification',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'notification_id': notification_id,
                        'dist_code': dist_code
                    },
                    success: function(data) {
                        if (data.status == '0') {
                            $.confirm({
                                title: 'Error Occurred!!',
                                content:'Something went wrong. Please try again later.',
                                type: 'orange',
                                typeAnimated: true,
                                buttons: {
                                    Ok: {
                                        text: 'OK',
                                        btnClass: 'btn-info',
                                        action: function() {
                                            self.is_forwarding = false;
                                        }
                                    },
                                }
                            });
                        } else if (data.status == '1') {
                            $('#generated_notification').html(data.data)
                            $('#modal_notification').modal('show');
                            self.is_forwarding = false;
                        }
                        self.is_forwarding = false;
                    },
                    error: function(error) {
                        $.confirm({
                            title: 'Error Occurred!!',
                            content: 'Please contact the system admin',
                            type: 'red',
                            typeAnimated: true,
                            buttons: {
                                Ok: {
                                    text: 'OK',
                                    btnClass: 'btn-info',
                                    action: function() {
                                        self.is_forwarding = false;
                                    }
                                },
                            }
                        });
                        self.is_forwarding = false;
                    }
                });
            },
            forwardTo(notification_id,dist_code,proposal_no) {
                var self = this;
                this.is_forwarding = true;
                $.confirm({
                    title: 'Honourable Minister, R&DM Department Note',
                    content:'<textarea id="note" placeholder="Honourable Minister, R&DM Department Note" class="form-control" required ></textarea>',
                    type: 'orange',
                    columnClass: 'custom-confirm-popup',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Approve & Forward to Senior Most Secretary',
                            btnClass: 'btn-success',
                            action: function() {
                                if (!$('#note').val()) {
                                    alert('Please enter the Honourable Minister, R&DM Department Note.');
                                    self.is_forwarding = false;
                                    return;
                                }
                                var note = $('#note').val();
                                $.confirm({
                                    title: 'Confirm',
                                    content: 'Please confirm to approve',
                                    type: 'orange',
                                    typeAnimated: true,
                                    buttons: {
                                        Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-success',
                                            action: function() {
                                                $.ajax({
                                                    url: '<?= base_url(); ?>index.php/nc_village/NcMinisterController/notificationForward',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'note': note,
                                                        'dist_code': dist_code,
                                                        'notification_id': notification_id,
                                                        'proposal_no': proposal_no,
                                                    },
                                                    success: function(data) {
                                                        if (data.status == '0') {
                                                            $.confirm({
                                                                title: 'Error Occurred!!',
                                                                content:'Something went wrong. Please try again later.',
                                                                type: 'orange',
                                                                typeAnimated: true,
                                                                buttons: {
                                                                    Ok: {
                                                                        text: 'OK',
                                                                        btnClass: 'btn-info',
                                                                        action: function() {
                                                                            self.is_forwarding = false;
                                                                        }
                                                                    },
                                                                }
                                                            });
                                                        } else if (data.status == '1') {
                                                            $.confirm({
                                                                title: 'Success',
                                                                content: 'Notification approved successfully.',
                                                                type: 'green',
                                                                typeAnimated: true,
                                                                buttons: {
                                                                    Ok: {
                                                                        text: 'OK',
                                                                        btnClass: 'btn-info',
                                                                        action: function() {
                                                                            location.reload();
                                                                            self.is_forwarding = false;
                                                                        }
                                                                    },
                                                                }
                                                            });
                                                        }
                                                        self.is_forwarding = false;
                                                    },
                                                    error: function(error) {
                                                        $.confirm({
                                                            title: 'Error Occurred!!',
                                                            content: 'Please contact the system admin',
                                                            type: 'red',
                                                            typeAnimated: true,
                                                            buttons: {
                                                                Ok: {
                                                                    text: 'OK',
                                                                    btnClass: 'btn-info',
                                                                    action: function() {
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
                                            action: function() {
                                                self.is_forwarding = false;
                                            }
                                        },
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            btnClass: 'btn-warning',
                            action: function() {
                                self.is_forwarding = false;
                            }
                        },
                    }
                });
            },
            revertedTo(notification_id,dist_code,proposal_no) {
                var self = this;
                this.is_forwarding = true;
                $.confirm({
                    title: 'Honourable Minister, R&DM Department Note',
                    content:'<textarea id="note" placeholder="Honourable Minister, R&DM Department Note" class="form-control" required ></textarea>',
                    type: 'red',
                    columnClass: 'custom-confirm-popup',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Revert to Senior Most Secretary',
                            btnClass: 'btn-danger',
                            action: function() {
                                if (!$('#note').val()) {
                                    alert('Please enter the Honourable Minister, R&DM Department Note.');
                                    self.is_forwarding = false;
                                    return;
                                }
                                var note = $('#note').val();
                                $.confirm({
                                    title: 'Confirm',
                                    content: 'Please confirm to revert',
                                    type: 'red',
                                    typeAnimated: true,
                                    buttons: {
                                        Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-danger',
                                            action: function() {
                                                $.ajax({
                                                    url: '<?= base_url(); ?>index.php/nc_village/NcMinisterController/notificationRevert',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'note': note,
                                                        'dist_code': dist_code,
                                                        'notification_id': notification_id,
                                                        'proposal_no': proposal_no,
                                                    },
                                                    success: function(data) {
                                                        if (data.status == '0') {
                                                            $.confirm({
                                                                title: 'Error Occurred!!',
                                                                content:'Something went wrong. Please try again later.',
                                                                type: 'orange',
                                                                typeAnimated: true,
                                                                buttons: {
                                                                    Ok: {
                                                                        text: 'OK',
                                                                        btnClass: 'btn-info',
                                                                        action: function() {
                                                                            self.is_forwarding = false;
                                                                        }
                                                                    },
                                                                }
                                                            });
                                                        } else if (data.status == '1') {
                                                            $.confirm({
                                                                title: 'Success',
                                                                content: 'Notification reverted successfully.',
                                                                type: 'green',
                                                                typeAnimated: true,
                                                                buttons: {
                                                                    Ok: {
                                                                        text: 'OK',
                                                                        btnClass: 'btn-info',
                                                                        action: function() {
                                                                            location.reload();
                                                                            self.is_forwarding = false;
                                                                        }
                                                                    },
                                                                }
                                                            });
                                                        }
                                                        self.is_forwarding = false;
                                                    },
                                                    error: function(error) {
                                                        $.confirm({
                                                            title: 'Error Occurred!!',
                                                            content: 'Please contact the system admin',
                                                            type: 'red',
                                                            typeAnimated: true,
                                                            buttons: {
                                                                Ok: {
                                                                    text: 'OK',
                                                                    btnClass: 'btn-info',
                                                                    action: function() {
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
                                            action: function() {
                                                self.is_forwarding = false;
                                            }
                                        },
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            btnClass: 'btn-warning',
                            action: function() {
                                self.is_forwarding = false;
                            }
                        },
                    }
                });
            }
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="text-center p-2 mb-2" style="font-size:18px; font-weight: bold; background-color: #4298c9; color: white">NC VILLAGE
        (Draft Notification <?php if($type == 'pending'): ?>Pending at <?php elseif ($type == 'verified'): ?> Approved by <?php endif; ?>
        Honourable Minister R&DM Department )
    </div>
    <div  class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> List of <?php if($type == 'pending'): ?>Pending <?php elseif ($type == 'verified'): ?> Approved <?php endif; ?> Draft Notification</h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                        <tr>
                            <th>#</th>
                            <th>Notification No</th>
                            <th>Proposal No</th>
                            <th>Notification Date</th>
                            <th>Senior Most Secretary Note</th>
                            <?php if($type == 'verified'): ?>
                            <th>Minister Note</th>
                            <?php endif; ?>
                            <th>Proposal</th>
                            <th>Notification</th>
                            <?php if($type == 'pending'): ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($notification as $key=>$p): ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $p->notification_no ?></td>
                                <td><?= $p->proposal_no ?></td>
                                <td><?= date("jS F, Y g:i a", strtotime($p->created_at)); ?></td>
                                <td><?= $p->ps_note ?></td>
                                <?php if($type == 'verified'): ?>
                                <td><?= $p->minister_note ?></td>
                                <?php endif; ?>
                                <td>
                                    <a class="btn btn-sm btn-info text-white" href="<?= base_url() ?>index.php/nc_village/NcCommonMyController/getVillagesProposalWise?proposal_id=<?= $p->proposal_id ?>&proposal_no=<?= $p->proposal_no ?>&dist_code=<?= $p->dist_code ?>"
                                       target="_blank">View <i class=" fa fa-eye"></i></a>
                                </td>
                                <td>
                                    <button type="button" x-on:click="generateNotification(<?php echo $p->id.','.$p->dist_code;?>)" class="btn btn-sm btn-success text-white">View  <i class="fa fa-eye"></i></button>
                                </td>
                                <?php if($type == 'pending'): ?>
                                    <td>
                                        <button type="button" x-on:click="forwardTo('<?= $p->id ?>','<?= $p->dist_code ?>','<?= $p->proposal_no ?>')" class="btn btn-sm btn-primary text-white"><i class="fa fa-forward"></i> Approve and Forward </button><br>
                                        <button type="button" x-on:click="revertedTo('<?= $p->id ?>','<?= $p->dist_code ?>','<?= $p->proposal_no ?>')"
                                                class="mt-2 btn btn-sm btn-danger text-white"><i class="fa fa-backward"></i> Revert to Senior Most Secretary </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(count($notification) == 0): ?>
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

    <div class="modal" id="modal_notification" tabindex="-1" aria-labelledby="modal_notification" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="width: 100% !important;">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title"> <i class="fa fa-file"></i> Draft Notification Generated of NC Village as a Cadastral Village</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3" id="generated_notification">
                    </div>
                </div>
                <hr>
                <div class="p-2" id="modal_footer">
                    <button type="button" class="btn btn-danger" id="closeBtn" data-dismiss="modal">
                        <i class='fa fa-close'></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
