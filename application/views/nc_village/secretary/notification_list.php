<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/ckeditor5/ckeditor5.js') ?>"></script>
<script>
    function alpineData() {
        return {
            proposal_id:'',
            proposal_no:'',
            dist_code:'',
            notification: '',
            notification_id: '',
            note: '',
            type: '',
            is_forwarding:false,
            generateNotification(notification_id,dist_code,proposal_no,type) {
                this.notification_id = notification_id;
                this.dist_code = dist_code;
                this.proposal_no = proposal_no;
                this.type = type;
                var self = this;
                this.is_forwarding = true;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcSecretaryController/viewJointSecNotification',
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
                            $('#modal_notification').modal('show');
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
                    alert('Please enter the Secretary (Survey & Settlement), R&DM Department Note');
                    return;
                }
                this.is_forwarding = true;
                $.confirm({
                    title: 'Confirm',
                    content: 'Please confirm to Forward',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function() {
                                $.ajax({
                                    url: '<?= base_url(); ?>index.php/nc_village/NcSecretaryController/notificationForward',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: {
                                        'note': self.note,
                                        'notification_id': self.notification_id,
                                        'dist_code': self.dist_code,
                                        'notification': self.notification,
                                        'proposal_no': self.proposal_no,
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
                                                            self.notification_id='';
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
            viewNotification(notification_id,dist_code) {
                this.notification_id = notification_id;
                this.dist_code = dist_code;
                var self = this;
                this.is_forwarding = true;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcSecretaryController/viewVerifiedNotification',
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
                            $('#view_notification').html(data.data)
                            $('#modal_view_notification').modal('show');
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
            revertTo() {
                var self = this;
                if (!this.note) {
                    alert('Please enter the Secretary, Survey & Settlement R&DM Department Note');
                    return;
                }
                this.is_forwarding = true;
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
                                    url: '<?= base_url(); ?>index.php/nc_village/NcSecretaryController/notificationRevert',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: {
                                        'note': self.note,
                                        'notification_id': self.notification_id,
                                        'dist_code': self.dist_code,
                                        'notification': self.notification,
                                        'proposal_no': self.proposal_no,
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
                                                content: 'Notification reverted successfully.',
                                                type: 'green',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.note ='';
                                                            self.notification_id='';
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
        (Draft Notification <?php if($type == 'pending'): ?>Pending at <?php elseif ($type == 'verified'): ?> Forwarded by <?php endif; ?>
        Secretary (Survey & Settlement) R&DM Department )
    </div>
    <div  class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> List of <?php if($type == 'pending'): ?>Pending <?php elseif ($type == 'verified'): ?> Forwarded <?php endif; ?> Draft Notification</h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                        <tr>
                            <th>#</th>
                            <th>Notification No</th>
                            <th>Proposal No</th>
                            <th>Notification Date</th>
                            <th>Joint Secretary Note</th>
                            <th>Secretary Note</th>
                            <th>Proposal</th>
                            <?php if($type == 'verified'): ?>
                                <th>Notification</th>
                            <?php endif; ?>
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
                                <td><?= $p->joint_secretary_note ?></td>
                                <td><?= $p->secretary_note ?></td>
                                <td>
                                    <a class="btn btn-sm btn-info text-white" href="<?= base_url() ?>index.php/nc_village/NcCommonMyController/getVillagesProposalWise?proposal_id=<?= $p->proposal_id ?>&proposal_no=<?= $p->proposal_no ?>&dist_code=<?= $p->dist_code ?>"
                                       target="_blank">View <i class=" fa fa-eye"></i></a>
                                </td>
                                <?php if($type == 'verified'): ?>
                                    <td>
                                        <button type="button" x-on:click="viewNotification(<?php echo $p->id.','.$p->dist_code;?>)" class="btn btn-sm btn-success text-white">View  <i class="fa fa-eye"></i></button>
                                    </td>
                                <?php endif; ?>
                                <?php if($type == 'pending'): ?>
                                    <td>
                                        <button type="button" x-on:click="generateNotification('<?= $p->id ?>','<?= $p->dist_code ?>','<?= $p->proposal_no ?>','forward')" class="btn btn-sm btn-primary text-white"><i class="fa fa-forward"></i> Forward to Senior Most Secretary</button><br>
                                        <button type="button" x-on:click="generateNotification('<?= $p->id ?>','<?= $p->dist_code ?>','<?= $p->proposal_no ?>','revert')" class="btn btn-sm btn-danger text-white mt-1"> <i class="fa fa-backward"></i> Revert to Joint Secretary</button>
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

    <div class="modal" id="modal_view_notification" tabindex="-1" aria-labelledby="modal_view_notification" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="width: 100% !important;">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title"> <i class="fa fa-file"></i> Draft Notification Generated of NC Village as a Cadastral Village</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3" id="view_notification">
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
                    <textarea name="content" id="editor"></textarea>
                </div>
                <hr>
                <div class="p-2 pt-0" style="justify-content:start;">
                    <div class="form-group">
                        <label for="" class="form-label" style="font-weight: bold;">Secretary (Survey & Settlement), R&DM Department Note <span style="color:red;">*</span></label>
                        <textarea x-model="note" placeholder="Secretary (Survey & Settlement) R&DM Department Note" rows="2"
                                  class="form-control"></textarea>
                        <div class="pt-2" id="modal_footer">
                            <button x-show="type == 'forward'" x-on:click="forwardTo" type="button" class="btn btn-primary"><i class="fa fa-check"></i>
                                Verify & Forward to Senior Most Secretary, R&DM Department
                            </button>
                            <button x-show="type == 'revert'" x-on:click="revertTo" type="button" class="btn btn-danger"><i class="fa fa-backward"></i>
                                Revert to Joint Secretary, (Survey & Settlement)
                            </button>
                            <button type="button" class="btn btn-danger" id="closeBtn" data-dismiss="modal">
                                <i class='fa fa-close'></i> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
