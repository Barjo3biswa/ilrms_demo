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
            'is_loading': false,
            forwardTo(id,dist_code,proposal_no) {
                var self = this;
                this.is_forwarding = true;
                $.confirm({
                    title: 'Senior Most Secretary, R&DM Department Note',
                    content:'<textarea id="ps_note" placeholder="Senior Most Secretary, R&DM Department Note" class="form-control" required ></textarea>',
                    columnClass: 'custom-confirm-popup',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Forward to Secretary (Survey & Settlement)',
                            btnClass: 'btn-success',
                            action: function() {
                                if (!$('#ps_note').val()) {
                                    alert('Please enter the Senior Most Secretary (R&DM Department) Note.');
                                    self.is_forwarding = false;
                                    return;
                                }
                                var ps_note = $('#ps_note').val();
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
                                                    url: '<?= base_url(); ?>index.php/nc_village/NcDepartController/proposalForward',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'note': ps_note,
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
                    title: 'Senior Most Secretary, R&DM Department Note',
                    content:'<textarea id="ps_note" placeholder="Senior Most Secretary, R&DM Department Note" class="form-control" required >In view of Integrating Dharitree and Bhunaksha databases the area of land parcel of the village is imported from Bhunaksha. The updated draft chitha to be resubmitted for real time synchronization of map and land records.</textarea>',
                    columnClass: 'custom-confirm-popup',
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Revert to DLRS',
                            btnClass: 'btn-danger',
                            action: function() {
                                if (!$('#ps_note').val()) {
                                    alert('Please enter the Senior Most Secretary (R&DM Department) Note.');
                                    self.is_forwarding = false;
                                    return;
                                }
                                var ps_note = $('#ps_note').val();
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
                                                    url: '<?= base_url(); ?>index.php/nc_village/NcDepartController/proposalRevert',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'note': ps_note,
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
        (<?php if($type == 'pending'): ?>Pending <?php elseif ($type == 'verified'): ?> Forwarded <?php elseif ($type == 'reverted'): ?> Reverted <?php endif; ?>
        Proposals at Senior Most Secretary (R&DM Department))</div>
    <div  class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> List of <?php if($type == 'pending'): ?>Pending <?php elseif ($type == 'verified'): ?> Forwarded <?php elseif ($type == 'reverted'): ?> Reverted <?php endif; ?> Proposals</h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                        <tr>
                            <th>District</th>
                            <th>Proposal No</th>
                            <th>Date</th>
                            <th>Proposal</th>
                            <?php if($type == 'pending' || $type == 'verified'): ?>
                                <th>DLRS Note</th>
                            <?php endif; ?>
                            <?php if($type == 'reverted'): ?>
                                <th>Senior Most Secretary Note</th>
                                <th>Secretary Note</th>
                            <?php endif; ?>
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
                            <td><?= date("jS F, Y g:i a", strtotime($p->updated_at)); ?></td>
                            <td>
                                <a class="btn btn-sm btn-info text-white" href="<?= base_url() ?>index.php/nc_village/NcCommonMyController/getVillagesProposalWise?proposal_id=<?= $p->id ?>&proposal_no=<?= $p->proposal_no ?>&dist_code=<?= $p->dist_code ?>"
                                   target="_blank">View <i class=" fa fa-eye"></i></a>
                            </td>
                            <?php if($type == 'pending' || $type == 'verified'): ?>
                                <td><?= $p->proposal_note ?></td>
                            <?php endif; ?>
                            <?php if($type == 'reverted'): ?>
                                <td><?= $p->ps_note ?></td>
                                <td><?= $p->secretary_note ?></td>
                            <?php endif; ?>

                            <?php if($type == 'pending' || $type == 'reverted'): ?>
                                <td>
                                    <button type="button" x-on:click="forwardTo('<?= $p->id?>','<?=$p->dist_code ?>','<?= $p->proposal_no ?>')" class="btn btn-sm btn-success text-white">Forward to Secretary, Survey & Settlement <i class="fa fa-forward"></i></button><br>
                                    <button type="button" x-on:click="revertedTo('<?= $p->id ?>','<?= $p->dist_code ?>','<?= $p->proposal_no ?>')" class="btn btn-sm btn-danger text-white mt-1">Revert to DLRS <i class="fa fa-backward"></i></button>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(count($proposal) == 0): ?>
                        <tr>
                            <td colspan="4" class="text-center">
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
