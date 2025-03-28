<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>

<script src="<?php echo base_url('js/dsc/dsc-signer.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/dsc/dscapi-conf.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/pdfjs/pdf.min.js') ?>" type="text/javascript"></script>
<style>
    .custom-confirm-popup {
        width: 700px;
    }
</style>
<script>
    function alpineData() {
        return {
            'dist_code': '',
            'subdiv_code': '',
            'cir_code': '',
            'mouza_pargona_code': '',
            'lot_no': '',
            'lots': [],
            'villages': [],
            'approve_proposal': [],
            'base_url': "<?= base_url(); ?>",
            'is_loading': false,
            'sign_type': '',
            'base64_data': '',
            'sign_x': 200,
            'sign_y': 200,
            'pdf_h': '',
            'pdf_w': '',
            'proposal_id': '',
            'notification_id': '',
            'proposal_no': '',
            'note': '',
            init() {
                var self = this;
                $(document).ready(function() {
                    document.getElementById('preview_reverted_proposal_for_sign').addEventListener('click', function(event) {
                        const rect = this.getBoundingClientRect();
                        const x = event.clientX - rect.left;
                        const y = event.clientY - rect.top;
                        self.sign_x = Math.floor(self.pdf_w - x);
                        self.sign_y = Math.floor(self.pdf_h - y);
                        $.confirm({
                            title: 'Confirm Sign Position',
                            content: 'Please confirm to Sign here',
                            type: 'orange',
                            typeAnimated: true,
                            buttons: {
                                Ok: {
                                    text: 'Confirm',
                                    btnClass: 'btn-success',
                                    action: function() {
                                        self.signProposalConfirm();
                                    }
                                },
                                Cancel: {
                                    text: 'Cancel',
                                    btnClass: 'btn-danger',
                                    action: function() {
                                        return;
                                    }
                                },
                            }
                        });
                    });
                });
            },
            cancelSign() {
                this.sign_x = 200;
                this.sign_y = 200;
                this.pdf_h = '';
                this.pdf_w = '';
                this.sign_type = '';
                this.base64_data = '';
                var parentElement = document.getElementById('preview_reverted_proposal_for_sign');
                if (parentElement.lastChild) {
                    parentElement.removeChild(parentElement.lastChild);
                }
            },
            initDSign(type) {
                var self = this;
                var initConfig = {
                    "preSignCallback": function() {
                        // do something
                        // based on the return sign will be invoked
                        return true;
                    },
                    "postSignCallback": function(alias, sign, key) {
                        // Implement signed pdf upload and pdf Download here
                        var requestData = {
                            action: "DECRYPT",
                            en_sig: sign,
                            ek: key
                        };

                        var sign_key = key;

                        $.ajax({
                            url: dscapibaseurl + "/pdfsignature",
                            type: "post",
                            dataType: "json",
                            contentType: 'application/json',
                            data: JSON.stringify(requestData),
                            async: false
                        })
                            .done(
                                function(data) {
                                    if (data.status_cd == 1) {
                                        var jsonData = JSON.parse(atob(data.data));
                                        if (jsonData.status === "SUCCESS") {
                                            if (type == 'proposal') {
                                                self.storeSignedProposal(jsonData, sign_key);
                                            }
                                        }

                                    } else {
                                        if (data.error.error_cd == 1002) {
                                            alert(data.error.message);
                                            return false;
                                        } else {
                                            alert("Decryption Failed for Signed PDF File");
                                            return false;
                                        }

                                    }
                                }).fail(
                            function(jqXHR, textStatus,
                                     errorThrown) {
                                alert(textStatus);
                            });
                    },
                    signType: 'pdf',
                    mode: 'nostampingv2'
                    //"certificateSno" : 13705892,
                };
                dscSigner.configure(initConfig);
            },
            signProposal() {
                if (!this.note)
                {
                    alert("Please enter the Director of Land Records and Surveys Note");
                    return;
                }
                $("#proposal_view").hide();
                this.sign_type = 'proposal';
                $('#closeBtn').prop('disabled', true);
                $('#signPdf').prop('disabled', true);
                $('#loader2').removeClass('invisible');
                var self = this;
                self.loadPreviewForSign('<?= base_url(); ?>index.php/nc_village/NcAdlrController/getProposalBaseReverted/'+self.proposal_no);
            },
            signProposalConfirm() {
                this.initDSign('proposal');
                $('#closeBtn').prop('disabled', false);
                $('#signPdf').prop('disabled', false);
                $('#loader2').addClass('invisible');
                if (this.base64_data) {
                    dscSigner.sign(this.base64_data);
                }
            },
            loadPreviewForSign(url) {
                var self = this;
                pdfjsLib.getDocument(url).promise.then(function(pdfDoc) {
                    // Get the first page.
                    pdfDoc.getPage(pdfDoc.numPages).then(function(page) {
                        var scale = 1;
                        var viewport = page.getViewport({
                            scale: scale
                        });

                        // Prepare canvas using PDF page dimensions.
                        var canvas = document.createElement('canvas');
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        self.pdf_h = viewport.height;
                        self.pdf_w = viewport.width;
                        // Render PDF page into canvas context.
                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        var renderTask = page.render(renderContext);
                        renderTask.promise.then(function() {
                            console.log("Page rendered");
                        });

                        // Append the canvas to the div container.
                        document.getElementById('preview_reverted_proposal_for_sign').appendChild(canvas);
                        $('#loader2').addClass('invisible');
                    });
                }).catch(function(error) {
                    console.log(error);
                });
            },
            storeSignedProposal(jsonData, sign_key) {
                var self = this;
                //get pdf data
                var pdfData = jsonData.sig;

                $('#loader2').removeClass('invisible');

                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcAdlrController/storeSignedProposalReverted',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'pdfbase': pdfData,
                        'sign_key': sign_key,
                        'proposal_no': self.proposal_no,
                        'dist_code': self.dist_code,
                        'forward_to': self.forward_to,
                        'dlr_note': self.note,
                    },
                    success: function(data) {
                        $('#loader2').addClass('invisible');
                        if (data.status == '1' && data.update == '1') {
                            $.confirm({
                                title: 'Success!!',
                                content: data.msg,
                                type: 'green',
                                typeAnimated: true,
                                buttons: {
                                    Ok: {
                                        text: 'OK',
                                        btnClass: 'btn-info',
                                        action: function() {
                                            window.location.reload();
                                        }
                                    },
                                }
                            });
                            $('#signPdf').hide();

                            self.nc_village = data.nc_village;
                        } else {
                            $.confirm({
                                title: 'Failed!!',
                                content: data.msg,
                                type: 'red',
                                typeAnimated: true,
                                buttons: {
                                    Ok: {
                                        text: 'OK',
                                        btnClass: 'btn-info',
                                        action: function() {

                                        }
                                    },
                                }
                            });
                        }
                    }
                });
            },
            notificationRevertedTo(notification_id,proposal_id,dist_code) {
                var self = this;
                self.notification_id = notification_id;
                self.proposal_id = proposal_id;
                self.dist_code = dist_code;
                this.is_forwarding = true;
                $.confirm({
                    title: 'ADLR Note',
                    content:'<textarea id="note" placeholder="ADLR Note" class="form-control" required ></textarea>',
                    type: 'orange',
                    columnClass: 'custom-confirm-popup',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Revert to DC',
                            btnClass: 'btn-danger',
                            action: function() {
                                if (!$('#note').val()) {
                                    alert('Please enter the ADLR Note.');
                                    self.is_forwarding = false;
                                    return;
                                }
                                var note = $('#note').val();
                                $.confirm({
                                    title: 'Confirm',
                                    content: 'Please confirm to Revert',
                                    type: 'orange',
                                    typeAnimated: true,
                                    buttons: {
                                        Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-success',
                                            action: function() {
                                                $.ajax({
                                                    url: '<?= base_url(); ?>index.php/nc_village/NcAdlrController/revertBackProposal',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'note': note,
                                                        'notification_id': notification_id,
                                                        'proposal_id': proposal_id,
                                                        'dist_code': dist_code
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
                                                                content: 'Proposal Reverted Successfully.',
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
            proposalRevertedTo(proposal_id,dist_code) {
                var self = this;
                self.proposal_id = proposal_id;
                self.dist_code = dist_code;
                this.is_forwarding = true;
                $.confirm({
                    title: 'Additional Director Of Land Records Note',
                    content:'<textarea id="note" placeholder="Additional Director Of Land Records Note" class="form-control" required ></textarea>',
                    type: 'red',
                    columnClass: 'custom-confirm-popup',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Revert to DC',
                            btnClass: 'btn-danger',
                            action: function() {
                                if (!$('#note').val()) {
                                    alert('Please enter the Additional Director Of Land Records Note.');
                                    self.is_forwarding = false;
                                    return;
                                }
                                var note = $('#note').val();
                                $.confirm({
                                    title: 'Confirm',
                                    content: 'Please confirm to Revert',
                                    type: 'orange',
                                    typeAnimated: true,
                                    buttons: {
                                        Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-success',
                                            action: function() {
                                                $.ajax({
                                                    url: '<?= base_url(); ?>index.php/nc_village/NcAdlrController/revertBackDcProposal',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'note': note,
                                                        'proposal_id': proposal_id,
                                                        'dist_code': dist_code
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
                                                                content: 'Proposal Reverted Successfully.',
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
            forwardTo(proposal_no,dist_code) {
                var self = this;
                self.proposal_no = proposal_no;
				self.dist_code = dist_code;
                this.is_forwarding = true;
                $.confirm({
                    title: 'Confirm',
                    content: 'Please confirm to Proposal for approval and notification',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function () {
                                $.ajax({
                                    url: '<?= base_url(); ?>index.php/nc_village/NcAdlrController/getProposalBase64',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: {
                                        'proposal_no': self.proposal_no,
                                    },
                                    success: function (data) {
                                        if (data.status == 'N') {
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
                                        } else if (data.status == 'Y') {
                                            var iframe = document.getElementById('pdfViewer');
                                            iframe.src = 'data:application/pdf;base64,' + data.data;
                                            $('#modal_proposal').modal('show');
                                            self.is_forwarding = false;
											self.base64_data = data.data;
											self.note = '';
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
            justForwardTo(proposal_id,dist_code,proposal_no) {
                var self = this;
                self.proposal_id = proposal_id;
                self.proposal_no = proposal_no;
				self.dist_code = dist_code;
                this.is_forwarding = true;
                $.confirm({
                    title: 'Additional Director Of Land Records Note',
                    content:'<textarea id="note" placeholder="Additional Director Of Land Records Note" class="form-control" required ></textarea>',
                    columnClass: 'custom-confirm-popup',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Forward to Senior Most Secretary',
                            btnClass: 'btn-success',
                            action: function() {
                                if (!$('#note').val()) {
                                    alert('Please enter the Additional Director Of Land Records Note.');
                                    self.is_forwarding = false;
                                    return;
                                }
                                var note = $('#note').val();
                                $.confirm({
                                title: 'Confirm',
                                content: 'Please confirm to Proposal for approval and notification',
                                type: 'orange',
                                typeAnimated: true,
                                buttons: {
                                    Confirm: {
                                        text: 'Confirm',
                                        btnClass: 'btn-success',
                                        action: function () {
                                            $.ajax({
                                                url: '<?= base_url(); ?>index.php/nc_village/NcAdlrController/proposalForward',
                                                method: "POST",
                                                async: true,
                                                dataType: 'json',
                                                data: {
                                                    'proposal_id': self.proposal_id,
                                                    'proposal_no': self.proposal_no,
                                                    'dist_code': self.dist_code,
                                                    'note': note,
                                                },
                                                success: function (data) {
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
                                                                    action: function () {
                                                                        self.is_forwarding = false;
                                                                    }
                                                                },
                                                            }
                                                        });
                                                    } else if (data.status == '1') {
                                                        $.confirm({
                                                            title: 'Success',
                                                            content: 'Proposal Forwarded Successfully.',
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
        (List of Reverted Proposal Senior Most Secretary)
    </div>
    <div  class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> List of Reverted Proposal From Senior Most Secretary</h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                        <tr>
                            <th>#</th>
                            <th>Proposal No</th>
                            <th>Proposal</th>
                            <th>Reverted By</th>
                            <th>Reverted Note</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($ps_proposal as $key=>$ps): ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $ps->proposal_no ?></td>
                                <td>
                                    <a class="btn btn-sm btn-info text-white"
                                       href="<?=base_url('index.php/nc_village/NcCommonController/viewProposal?id=').$ps->proposal_no;?>"
                                       target="_blank">View <i class=" fa fa-eye"></i>
                                    </a>
                                </td>
                                <td>Senior Most Secretary</td>
                                <td><?= $ps->ps_note ?></td>
                                <td>
                                    <button type="button" x-on:click="justForwardTo('<?= $ps->id?>','<?= $ps->dist_code?>','<?= $ps->proposal_no?>')"
                                            class="btn btn-sm btn-success text-white"><i class="fa fa-forward"></i>
                                        Forward to PS, R&DM Department
                                    </button><br>
                                    <button type="button" x-on:click="proposalRevertedTo(<?= $ps->id.','.$ps->dist_code ?>,)"
                                            class="btn btn-sm btn-danger text-white mt-1"><i class="fa fa-backward"></i> Revert To DC
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php foreach ($notification as $key=>$p): ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $p->proposal_no ?></td>
                                <td>
                                    <a class="btn btn-sm btn-info text-white"
                                       href="<?=base_url('index.php/nc_village/ncDashboardController/viewDlrProposal/').$p->dist_code .'/'. $p->proposal_id;?>"
                                       target="_blank">View <i class=" fa fa-eye"></i>
                                    </a>
                                </td>
                                <td>Senior Most Secretary</td>
                                <td><?= $p->ps_note ?></td>
                                <td>
                                    <button type="button" x-on:click="notificationRevertedTo(<?= $p->id.','.$p->proposal_id.','.$p->dist_code ?>,)"
                                            class="btn btn-sm btn-danger text-white"><i class="fa fa-backward"></i> Revert To DC
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(count($notification) + count($ps_proposal) == 0): ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <span>No Proposal Found</span>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal" id="modal_proposal" tabindex="-1" aria-labelledby="modal_proposal" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-xl" style="width: 100% !important;">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title text-danger" x-show="sign_type =='proposal'"> <i class="fa fa-file"></i> Please Click on the Position where the Signature to be Placed.(Mouse Clicked Position would the starting point of the Signature)</h5>
                        <h5 class="modal-title" x-show="sign_type !='proposal'"> <i class="fa fa-file"></i> Proposal for approval and notification</h5>
                    </div>
                    <div class="modal-body " id="proposal_view" x-show="sign_type !='proposal'">
                        <iframe id="pdfViewer" height="500px" width="100%"></iframe>
                    </div>
                    <div class="modal-body bg-secondary" style="cursor:move" x-show="sign_type =='proposal'">
                        <div id="panel" class="bg-white"></div>
                        <div id="preview_reverted_proposal_for_sign"></div>
                    </div>
                    <div class="p-3" x-show="sign_type !='proposal'">
                        <label for="" class="form-label" style="font-weight: bold;">Additional Director Of Land Records Note <span style="color:red;">*</span></label>
                        <textarea x-model="note" placeholder="Additional Director Of Land Records Note" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="signingReason" name="signingReason" maxlength="20" />
                        <input type="hidden" id="signingLocation" name="signingLocation" maxlength="20" />
                        <input type="hidden" id="stampingX" name="stampingX" maxlength="20" x-model="sign_x" />
                        <input type="hidden" id="stampingY" name="stampingY" maxlength="20" x-model="sign_y" />
                        <input type="hidden" id="tsaURL" name="tsaURL" value="" maxlength="100" style="width: 400px;" />
                        <input type="hidden" id="timeServerURL" name="timeServerURL" value="https://basundhara.assam.gov.in/dscapi/getServerTime" maxlength="100" style="width: 400px;" />
                        <button x-on:click="cancelSign" type="button" class="btn btn-danger" id="closeBtn" data-dismiss="modal"><i class='fa fa-close'></i> Close / Cancel
                        </button>
                        <button type="button" x-show="sign_type !='proposal'" x-on:click="signProposal" class="btn btn-primary"><i class="fa fa-pencil"></i> Sign & Approve Proposal</button>
                    </div>
                    <button id="loader2" class="btn btn-primary invisible">
                        <span class="spinner-border spinner-border-sm"></span>
                        Loading..
                    </button>
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
        margin-top: -..px;
        /* half of the elements height */
        margin-right: -..px;
        /* half of the elements width */
    }
</style>
