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
            forwardTo(id,dist_code,proposal_no) {
                var self = this;
                this.is_forwarding = true;
                $.confirm({
                    title: 'Joint Secretary (Survey & Settlement) Note',
                    content:'<textarea id="note" placeholder="Joint Secretary (Survey & Settlement) Note" class="form-control" required ></textarea>',
                    type: 'orange',
                    columnClass: 'custom-confirm-popup',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Forward to Section Officer',
                            btnClass: 'btn-success',
                            action: function() {
                                if (!$('#note').val()) {
                                    alert('Please enter the Joint Secretary (Survey & Settlement) R&DM Department Note.');
                                    self.is_forwarding = false;
                                    return;
                                }
                                var note = $('#note').val();
                                $.confirm({
                                    title: 'Confirm',
                                    content: 'Please confirm to forward',
                                    type: 'orange',
                                    typeAnimated: true,
                                    buttons: {
                                        Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-success',
                                            action: function() {
                                                $.ajax({
                                                    url: '<?= base_url(); ?>index.php/nc_village/NcJointSecretaryController/proposalForward',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'note': note,
                                                        'proposal_id': id,
                                                        'dist_code': dist_code,
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
                                                                content: 'Proposal forwarded successfully.',
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
            revertedTo(id,dist_code,proposal_no) {
                var self = this;
                this.is_forwarding = true;
                $.confirm({
                    title: 'Joint Secretary (Survey & Settlement) Note',
                    content:'<textarea id="note" placeholder="Joint Secretary (Survey & Settlement) Note" class="form-control" required ></textarea>',
                    columnClass: 'custom-confirm-popup',
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Revert Back to Secretary',
                            btnClass: 'btn-danger',
                            action: function() {
                                if (!$('#note').val()) {
                                    alert('Please enter the Joint Secretary, (Survey & Settlement) Note');
                                    self.is_forwarding = false;
                                    return;
                                }
                                var note = $('#note').val();
                                $.confirm({
                                    title: 'Confirm',
                                    content: 'Please confirm to Revert',
                                    type: 'red',
                                    typeAnimated: true,
                                    buttons: {
                                        Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-danger',
                                            action: function() {
                                                $.ajax({
                                                    url: '<?= base_url(); ?>index.php/nc_village/NcJointSecretaryController/proposalRevert',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'note': note,
                                                        'proposal_id': id,
                                                        'proposal_no': proposal_no,
                                                        'dist_code': dist_code
                                                    },
                                                    success: function(data) {
                                                        if (data == 'N') {
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
                                                        } else if (data == 'Y') {
                                                            $.confirm({
                                                                title: 'Success',
                                                                content: 'Proposal reverted successfully.',
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
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="text-center p-2 mb-2" style="font-size:18px; font-weight: bold; background-color: #4298c9; color: white">NC VILLAGE
        (<?php if($type == 'pending'): ?>Pending at <?php elseif ($type == 'verified'): ?> Forwarded by
        <?php elseif ($type == 'reverted'): ?> Reverted at <?php endif; ?>
        Joint Secretary (Survey & Settlement) R&DM Department )</div>
    <div  class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> List of <?php if($type == 'pending'): ?>Pending
                                <?php elseif ($type == 'verified'): ?> Forwarded
                                <?php elseif ($type == 'reverted'): ?> Reverted <?php endif; ?> Proposals</h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                        <tr>
                            <th>District</th>
                            <th>Proposal No</th>
                            <th>Proposal Date</th>
                            <?php if($type == 'pending' || $type == 'verified'): ?>
                                <th>Secretary Note</th>
                            <?php endif; ?>
                            <th>Joint Secretary Note</th>
                            <?php if($type == 'reverted'): ?>
                                <th>Section Officer Note</th>
                            <?php endif; ?>
                            <th>Proposal</th>
                            <?php if($type == 'pending' || $type == 'reverted'): ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <tr x-show="is_loading">
                            <td colspan="5" class="text-center">
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php foreach ($proposal as $p): ?>
                            <tr>
                                <td><?= $p->loc_name ?></td>
                                <td><?= $p->proposal_no ?></td>
                                <td><?= date("jS F, Y g:i a", strtotime($p->created_at)); ?></td>
                                <?php if($type == 'pending' || $type == 'verified'): ?>
                                    <td><?= $p->secretary_note ?></td>
                                <?php endif; ?>
                                <td><?= $p->joint_secretary_note ?></td>
                                <?php if($type == 'reverted'): ?>
                                    <td><?= $p->section_officer_note ?></td>
                                <?php endif; ?>
                                <td>
                                    <a class="btn btn-sm btn-info text-white" href="<?= base_url() ?>index.php/nc_village/NcCommonMyController/getVillagesProposalWise?proposal_id=<?= $p->id ?>&proposal_no=<?= $p->proposal_no ?>&dist_code=<?= $p->dist_code ?>"
                                       target="_blank">View <i class=" fa fa-eye"></i></a>
                                </td>
                                <?php if($type == 'pending' || $type == 'reverted'): ?>
                                    <td>
                                        <button type="button" x-on:click="forwardTo('<?= $p->id ?>','<?= $p->dist_code ?>','<?= $p->proposal_no ?>')" class="btn btn-sm btn-success text-white"><i class="fa fa-forward"></i> Forward to Section Officer, Survey & Settlement </button><br>
                                        <button type="button" x-on:click="revertedTo('<?= $p->id ?>','<?= $p->dist_code ?>','<?= $p->proposal_no ?>')" class="btn btn-sm btn-danger text-white mt-1"><i class="fa fa-backward"></i> Revert Back to Secretary </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(count($proposal) == 0): ?>
                            <tr>
                                <td colspan="7" class="text-center">
                                    <span>No Proposal Found</span>
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
