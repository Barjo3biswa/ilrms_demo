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
            'base_url': "<?= base_url(); ?>",
            'is_forwarding':false,
            init() {

            },
            forwardToAds(index) {
                var villages = '<?= json_encode($data) ?>';
                villages = JSON.parse(villages);
                var village = villages[index];
                var self = this;
                if (village) {
                    var dist_code = village.dist_code;
                    var application_no = village.application_no;
                    $.confirm({
                        title: 'Joint Director of Surveys Note',
                        content: '<textarea id="note" placeholder="Joint Director of Surveys Note" class="form-control" required ></textarea>',
                        type: 'orange',
                        columnClass: 'custom-confirm-popup',
                        typeAnimated: true,
                        buttons: {
                            Confirm: {
                                text: 'Forward to Assistant Director of Survey',
                                btnClass: 'btn-success',
                                action: function() {
                                    if (!$('#note').val()) {
                                        alert('Please enter the Joint Director of Surveys Note.');
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
                                                        url: '<?= base_url(); ?>index.php/nc_village/NcJdsController/forwardToAdsNameChange',
                                                        method: "POST",
                                                        async: true,
                                                        dataType: 'json',
                                                        data: {
                                                            'note': note,
                                                            'dist_code': dist_code,
                                                            'application_no': application_no,
                                                        },
                                                        success: function(data) {
                                                            if (data.status == '0') {
                                                                $.confirm({
                                                                    title: 'Error Occurred!!',
                                                                    content: 'Something went wrong. Please try again later.',
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
                                                                    content: 'NC Village successfully forwarded to Assistant Director of Survey.',
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
            },
            revertBack(proposal_id, proposal_no, dist_code) {
                var self = this;
                this.is_forwarding = true;
                $.confirm({
                    title: 'Joint Director of Surveys Note',
                    content: '<textarea id="note" placeholder="Joint Director of Surveys Note" class="form-control" required ></textarea>',
                    type: 'orange',
                    columnClass: 'custom-confirm-popup',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Revert to Additional Director Of Land Records',
                            btnClass: 'btn-success',
                            action: function() {
                                if (!$('#note').val()) {
                                    alert('Please enter the Joint Director of Surveys Note.');
                                    self.is_forwarding = false;
                                    return;
                                }
                                var note = $('#note').val();
                                $.confirm({
                                    title: 'Confirm',
                                    content: 'Please confirm to revert ',
                                    type: 'orange',
                                    typeAnimated: true,
                                    buttons: {
                                        Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-success',
                                            action: function() {
                                                $.ajax({
                                                    url: '<?= base_url(); ?>index.php/nc_village/NcJdsController/proposalRevertBack',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'note': note,
                                                        'proposal_id': proposal_id,
                                                        'dist_code': dist_code,
                                                        'proposal_no': proposal_no,
                                                    },
                                                    success: function(data) {
                                                        if (data.status == '0') {
                                                            $.confirm({
                                                                title: 'Error Occurred!!',
                                                                content: 'Something went wrong. Please try again later.',
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
                                                                content: 'Proposal successfully reverted to Additional Director Of Land Records.',
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
    <div class="text-center p-2 mb-2" style="font-size:18px; font-weight: bold; background-color: #4298c9; color: white">NC VILLAGE</div>
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> List of pending Villages for Name Change on Map</h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                            <tr>
                                <th>#</th>
                                <th>District</th>
                                <th>Village Name</th>
								<th>Forwarded By</th>
                                <th>DC Note</th>
                                <th>DLRS Note</th>
                                <th>View</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $index => $d) : ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td><?= $d->dist_name; ?></td>
                                    <td><?= $d->village_name; ?></td>
									<td><?= $d->status == 'M' ? 'DC' : 'DLRS'; ?></td>
                                    <td><?= $d->dc_note; ?></td>
                                    <td><?= $d->dlr_note; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-info text-white" href="<?= base_url() ?>index.php/nc_village/NcCommonController/getVillageDetails?application_no=<?=$d->application_no?>&d=<?=$d->dist_code?>">View <i class=" fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <button type="button" style="white-space: nowrap;" x-on:click="forwardToAds(<?= $index; ?>)" class="btn btn-primary btn-sm text-white">
                                            Forward to ADS <i class=" fa fa-forward"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
							<?php if (!$data) : ?>
                                <tr>
                                    <td colspan="7" class="text-center">No Pending Villages Found!!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>