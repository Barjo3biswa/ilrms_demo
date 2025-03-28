<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/ckeditor5/ckeditor5.js') ?>"></script>
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
            note:'',
            notification_id: '',
            notification: '',
            type: '',
            is_forwarding:false,
            generateNotification(notification_id,dist_code) {
                this.notification_id = notification_id;
                this.dist_code = dist_code;
                var self = this;
                this.is_forwarding = true;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcAsstSectionOfficerController/viewVerifiedNotification',
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
            revertedNotification(notification_id,dist_code) {
                this.notification_id = notification_id;
                this.dist_code = dist_code;
                var self = this;
                this.is_forwarding = true;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcAsstSectionOfficerController/viewRevertedNotification',
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
            revertedTo(proposal_id,dist_code,proposal_no,notification_id) {
                var self = this;
                this.is_forwarding = true;
                $.confirm({
                    title: 'Assistant Section Officer, Survey & Settlement Note',
                    content:'<textarea id="note" placeholder="Assistant Section Officer, Survey & Settlement Note" class="form-control" required ></textarea>',
                    columnClass: 'custom-confirm-popup',
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Revert Back to Section Officer',
                            btnClass: 'btn-danger',
                            action: function() {
                                if (!$('#note').val()) {
                                    alert('Please enter the Assistant Section Officer, Survey & Settlement Note');
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
                                                    url: '<?= base_url(); ?>index.php/nc_village/NcAsstSectionOfficerController/proposalNotificationRevert',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'note': note,
                                                        'proposal_id': proposal_id,
                                                        'proposal_no': proposal_no,
                                                        'dist_code': dist_code,
                                                        'notification_id': notification_id,
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
            reForwardNotification(notification_id,dist_code,proposal_id,proposal_no,type) {
                this.notification_id = notification_id;
                this.dist_code = dist_code;
                this.proposal_id = proposal_id;
                this.proposal_no = proposal_no;
                this.type = type;
                var self = this;
                this.is_forwarding = true;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcAsstSectionOfficerController/viewRevertedNotification',
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
                            self.notification = data.data;
                            var element = document.getElementById("editor");
                            if (!!element && !!element.editor) {
                                // Editor already exists, replace its content
                                element.editor.setData(data.data);
                            }else {
                                CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
                                    toolbar: {
                                        items: [
                                            'heading', '|',
                                            'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                                            'bulletedList', 'numberedList', 'todoList', '|',
                                            'outdent', 'indent', '|',
                                            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                                            'alignment', '|',
                                            'link', 'blockQuote', 'insertTable', 'codeBlock', '|',
                                            'specialCharacters', 'horizontalLine',
                                        ],
                                        shouldNotGroupWhenFull: true
                                    },
                                    list: {
                                        properties: {
                                            styles: true,
                                            startIndex: true,
                                            reversed: true
                                        }
                                    },
                                    heading: {
                                        options: [
                                            {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                                            {
                                                model: 'heading1',
                                                view: 'h1',
                                                title: 'Heading 1',
                                                class: 'ck-heading_heading1'
                                            },
                                            {
                                                model: 'heading2',
                                                view: 'h2',
                                                title: 'Heading 2',
                                                class: 'ck-heading_heading2'
                                            },
                                            {
                                                model: 'heading3',
                                                view: 'h3',
                                                title: 'Heading 3',
                                                class: 'ck-heading_heading3'
                                            },
                                            {
                                                model: 'heading4',
                                                view: 'h4',
                                                title: 'Heading 4',
                                                class: 'ck-heading_heading4'
                                            },
                                            {
                                                model: 'heading5',
                                                view: 'h5',
                                                title: 'Heading 5',
                                                class: 'ck-heading_heading5'
                                            },
                                            {
                                                model: 'heading6',
                                                view: 'h6',
                                                title: 'Heading 6',
                                                class: 'ck-heading_heading6'
                                            }
                                        ]
                                    },
                                    placeholder: 'Type here',
                                    fontFamily: {
                                        options: [
                                            'default',
                                            'Arial, Helvetica, sans-serif',
                                            'Courier New, Courier, monospace',
                                            'Georgia, serif',
                                            'Lucida Sans Unicode, Lucida Grande, sans-serif',
                                            'Tahoma, Geneva, sans-serif',
                                            'Times New Roman, Times, serif',
                                            'Trebuchet MS, Helvetica, sans-serif',
                                            'Verdana, Geneva, sans-serif'
                                        ],
                                        supportAllValues: true
                                    },
                                    fontSize: {
                                        options: [10, 12, 14, 'default', 18, 20, 22, 48],
                                        supportAllValues: true
                                    },
                                    link: {
                                        decorators: {
                                            addTargetToExternalLinks: true,
                                            defaultProtocol: 'https://',
                                            toggleDownloadable: {
                                                mode: 'manual',
                                                label: 'Downloadable',
                                                attributes: {
                                                    download: 'file'
                                                }
                                            }
                                        }
                                    },
                                    mention: {
                                        feeds: [
                                            {
                                                marker: '@',
                                                feed: [
                                                    '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                                    '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                                    '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                                    '@sugar', '@sweet', '@topping', '@wafer'
                                                ],
                                                minimumCharacters: 1
                                            }
                                        ]
                                    },
                                    removePlugins: [
                                        'CKBox',
                                        'CKFinder',
                                        'EasyImage',
                                        'RealTimeCollaborativeComments',
                                        'RealTimeCollaborativeTrackChanges',
                                        'RealTimeCollaborativeRevisionHistory',
                                        'PresenceList',
                                        'Comments',
                                        'TrackChanges',
                                        'TrackChangesData',
                                        'RevisionHistory',
                                        'Pagination',
                                        'WProofreader',
                                        'MathType'
                                    ]
                                }).then(editor => {
                                    editor.setData(data.data);
                                    editor.model.document.on('change:data', () => {
                                        self.notification = editor.getData();
                                    })
                                    element.editor = editor;
                                })
                            }
                            $('#modal_notification_new').modal('show');
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
            forwardTo() {
                var self = this;
                if (!this.note) {
                    alert('Please enter the Assistant Section Officer Survey & Settlement, R&DM Department Note');
                    return;
                }
                this.is_forwarding = true;
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
                                    url: '<?= base_url(); ?>index.php/nc_village/NcAsstSectionOfficerController/notificationForward',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: {
                                        'note': self.note,
                                        'notification_id': self.notification_id,
                                        'proposal_id': self.proposal_id,
                                        'proposal_no': self.proposal_no,
                                        'dist_code': self.dist_code,
                                        'notification': self.notification,
                                        'type': self.type,
                                    },
                                    success: function(data) {
                                        if (data != 'Y') {
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
                                                content: 'Notification forwarded successfully.',
                                                type: 'green',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.note ='';
                                                            self.proposal_id='';
                                                            self.proposal_no='';
                                                            self.dist_code = '';
                                                            self.notification = '';
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
            },
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="text-center p-2 mb-2" style="font-size:18px; font-weight: bold; background-color: #4298c9; color: white">NC VILLAGE
        (<?php if($type == 'pending'): ?>Draft Notification Pending at <?php elseif ($type == 'verified'): ?>
            Draft Notification Forwarded by
        <?php elseif ($type == 'reverted'): ?> Reverted Draft Notification, <?php endif; ?>
        Assistant Section Officer (Survey & Settlement) R&DM Department )
    </div>
    <div  class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> List of <?php if($type == 'pending'): ?>Pending
                                <?php elseif ($type == 'verified'): ?> Forwarded
                                <?php elseif ($type == 'reverted'): ?> Reverted <?php endif; ?> Draft Notification</h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                        <tr>
                            <th>#</th>
                            <th>Notification No</th>
                            <th>Proposal No</th>
                            <th>Notification Date</th>
                            <th>Assistant Section Officer Note</th>
                            <?php if($type == 'reverted'): ?>
                            <th>Section Officer Note</th>
                            <?php endif; ?>
                            <th>Proposal</th>
                            <th>Notification</th>
                            <?php if($type == 'reverted'): ?>
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
                                <td><?= $p->asst_section_officer_note ?></td>
                                <?php if($type == 'reverted'): ?>
                                    <td><?= $p->section_officer_note ?></td>
                                <?php endif; ?>
                                <td>
                                    <a class="btn btn-sm btn-info text-white" href="<?= base_url() ?>index.php/nc_village/NcCommonMyController/getVillagesProposalWise?proposal_id=<?= $p->id ?>&proposal_no=<?= $p->proposal_no ?>&dist_code=<?= $p->dist_code ?>"
                                       target="_blank">View <i class=" fa fa-eye"></i></a>
                                </td>
                                <?php if($type == 'reverted'): ?>
                                    <td>
                                        <button type="button" x-on:click="revertedNotification(<?php echo $p->id.','.$p->dist_code;?>)" class="btn btn-sm btn-success text-white">View  <i class="fa fa-eye"></i></button>
                                    </td>
                                    <td>
                                        <button type="button" x-on:click="reForwardNotification('<?= $p->id ?>','<?= $p->dist_code ?>','<?= $p->proposal_id ?>','<?= $p->proposal_no ?>','reforward')" class="btn btn-sm btn-primary text-white"><i class="fa fa-forward"></i> Notification Forward to Section Officer</button><br>
                                        <button type="button" x-on:click="revertedTo('<?= $p->proposal_id ?>','<?= $p->dist_code ?>','<?= $p->proposal_no ?>','<?= $p->id ?>')" class="btn btn-sm btn-danger text-white mt-1"> <i class="fa fa-backward"></i> Proposal Revert to Section Officer</button>
                                    </td>
                                <?php else: ?>
                                    <td>
                                        <button type="button" x-on:click="generateNotification(<?php echo $p->id.','.$p->dist_code;?>)" class="btn btn-sm btn-success text-white">View  <i class="fa fa-eye"></i></button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(count($notification) == 0): ?>
                            <tr>
                                <td colspan="6" class="text-center">
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

    <div class="modal" id="modal_notification_new" tabindex="-1" aria-labelledby="modal_notification_new" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="width: 100% !important;">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title"> <i class="fa fa-file"></i> Draft Notification Generated of NC Village as a Cadastral Village</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea name="content" id="editor"></textarea>
                </div>
                <hr>
                <div class="p-2 pt-0" style="justify-content:start;">
                    <div class="form-group">
                        <label for="" class="form-label" style="font-weight: bold;">Assistant Section Officer Survey & Settlement R&DM Department Note <span style="color:red;">*</span></label>
                        <textarea x-model="note" placeholder="Assistant Section Officer Survey & Settlement R&DM Department Note" rows="2"
                                  class="form-control"></textarea>
                        <div class="pt-2" id="modal_footer">
                            <button x-on:click="forwardTo" type="button" class="btn btn-primary"><i class="fa fa-check"></i>
                                Verify & Forward to Section Officer (Survey & Settlement)
                            </button>
                            <button type="button" class="btn btn-info" id="closeBtn" data-dismiss="modal">
                                <i class='fa fa-close'></i> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
