<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>
<script src="<?php echo base_url('js/dsc/dsc-signer.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/dsc/dscapi-conf.js') ?>" type="text/javascript"></script>
<!--<link type="text/css" rel="stylesheet" href="--><?php //echo base_url('css/dsc/dsc-signer.css') 
                                                    ?><!--">-->
<script src="<?php echo base_url('assets/plugins/pdfjs/pdf.min.js') ?>" type="text/javascript"></script>
<script>
    function alpineData() {
        return {
            'proposal_id': '',
            'proposal_no': '',
            'notification_no': '',
            'notification_id': '',
            'dist_code': '',
            'sign_type': '',
            'note': '',
            'is_loading': false,
            'is_forwarding': false,
            'sign_x': 200,
            'sign_y': 200,
            'pdf_h': '',
            'pdf_w': '',
            'base64_data': '',
            init() {
                var self = this;
                $(document).ready(function() {
                    document.getElementById('preview_notification_for_sign').addEventListener('click', function(event) {
                        const rect = this.getBoundingClientRect();
                        const x = event.clientX - rect.left;
                        const y = event.clientY - rect.top;
                        self.sign_x = Math.floor(self.pdf_w - x);
                        self.sign_y = Math.floor(self.pdf_h - y);
                        $.confirm({
                            title: 'Confirm Sign Position',
                            content: 'Please confirm to sign here',
                            type: 'orange',
                            typeAnimated: true,
                            buttons: {
                                Ok: {
                                    text: 'Confirm',
                                    btnClass: 'btn-success',
                                    action: function() {
                                        self.signNotificationConfirm();
                                        return;
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
            previewNotification(proposal_id, dist_code, notification_id, proposal_no, notification_no) {
                this.proposal_id = proposal_id;
                this.proposal_no = proposal_no;
                this.dist_code = dist_code;
                this.notification_no = notification_no;
                this.notification_id = notification_id;
                var self = this;
                this.is_forwarding = true;
                $('#preview_notification_pdf').modal('show');
                var parentElement = document.getElementById('preview_notification_pdf_body');
                while (parentElement.firstChild) {
                    parentElement.removeChild(parentElement.firstChild);
                }
                self.loadPdfForSignPreview('<?= base_url() ?>index.php/nc_village/NcCommonController/getNotificationPdfJsSignPreview/' + self.notification_no);
            },
            loadPdfForSignPreview(url) {
                var self = this;
                pdfjsLib.getDocument(url).promise.then(function(pdfDoc) {
                    // Get the first page.
                    var i = 1;
                    while (i <= pdfDoc.numPages) {
                        pdfDoc.getPage(i).then(function(page) {
                            var scale = 1.5;
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
                            document.getElementById('preview_notification_pdf_body').appendChild(canvas);
                        });
                        i++;
                    }

                }).catch(function(error) {
                    console.log(error);
                });
            },
            initDSign() {
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
                                    console.log(data);
                                    if (data.status_cd == 1) {
                                        var jsonData = JSON.parse(atob(data.data));
                                        if (jsonData.status === "SUCCESS") {
                                            self.storeSignedNotification(jsonData, sign_key);
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
            clearSignData() {
                this.sign_x = 200;
                this.sign_y = 200;
                this.pdf_h = '';
                this.pdf_w = '';
                this.sign_type = '';
                this.base64_data = '';
                var parentElement = document.getElementById('preview_notification_for_sign');
                if (parentElement.lastChild) {
                    parentElement.removeChild(parentElement.lastChild);
                }
            },
            signNotification() {
                var self = this;
                $('#preview_notification_pdf').modal('hide');
                $('#modal_sign_notification').modal('show');
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcCommonController/getNotificationPdfJsSignBase64',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'notification_no': self.notification_no,
                    },
                    success: function(data) {
                        $('#closeBtn').prop('disabled', false);
                        $('#signPdf').prop('disabled', false);
                        if (data != null || data != '') {
                            self.base64_data = data;
                            self.loadPreviewForSign('<?= base_url() ?>index.php/nc_village/NcCommonController/getNotificationPdfJsSignPreview/' + self.notification_no);
                        }
                    }
                });
            },
            signNotificationConfirm() {
                this.initDSign();
                $('#closeBtn').prop('disabled', true);
                $('#signPdf').prop('disabled', true);
                // $('#loader2').removeClass('invisible');
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
                        document.getElementById('preview_notification_for_sign').appendChild(canvas);
                    });
                }).catch(function(error) {
                    console.log(error);
                });
            },
            storeSignedNotification(jsonData, sign_key) {
                var self = this;
                //get pdf data
                var pdfData = jsonData.sig;

                // $('#loader2').removeClass('invisible');

                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcJointSecretaryController/storeSignedNotification',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'pdfbase': pdfData,
                        'sign_key': sign_key,
                        'dist_code': self.dist_code,
                        'proposal_id': self.proposal_id,
                        'proposal_no': self.proposal_no,
                        'notification_no': self.notification_no,
                        'notification_id': self.notification_id
                    },
                    success: function(data) {
                        // $('#loader2').addClass('invisible');
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
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="text-center p-2 mb-2" style="font-size:18px; font-weight: bold; background-color: #4298c9; color: white">NC VILLAGE
        (Pending Notification Digitally Signed by
        Senior Most Secretary, R&DM Department )
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> List of Pending Notification Signed by Senior Most Secretary, R&DM Department </h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                            <tr>
                                <th>#</th>
                                <th>Notification No</th>
                                <th>Proposal No</th>
                                <th>Notification Date</th>
                                <th>PS Note</th>
                                <th>Proposal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($notification as $key => $p) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $p->notification_no ?></td>
                                    <td><?= $p->proposal_no ?></td>
                                    <td><?= date("jS F, Y g:i a", strtotime($p->created_at)); ?></td>
                                    <td><?= $p->ps_note ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-info text-white" href="<?= base_url() ?>index.php/nc_village/NcCommonMyController/getVillagesProposalWise?proposal_id=<?= $p->proposal_id ?>&proposal_no=<?= $p->proposal_no ?>&dist_code=<?= $p->dist_code ?>"
                                            target="_blank">View <i class=" fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <button type="button" x-on:click="previewNotification(<?php echo $p->proposal_id . ',' . $p->dist_code . ',' . $p->id . ',`' . $p->proposal_no . '`,`' . $p->notification_no . '`'; ?>)" class="btn btn-sm btn-success text-white">Digital Sign <i class="fa fa-pencil"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (count($notification) == 0) : ?>
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

    <div class="modal" id="modal_sign_notification" tabindex="-1" aria-labelledby="modal_sign_notification" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="width: 100% !important;">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title"> <i class="fa fa-file"></i> <span class="text-danger"><b>Click on the Starting Position of the Sign to be placed</b></span></h5>
                    <button x-on:click="clearSignData" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-secondary" style="cursor:move">
                    <div id="panel" class="bg-white"></div>
                    <div id="preview_notification_for_sign"></div>
                </div>
                <div class="modal-footer" style="display: block;">
                    <div>
                        <button type="button" x-on:click="clearSignData" class="btn btn-danger" id="closeBtn" data-dismiss="modal">
                            <i class='fa fa-close'></i> Cancel
                        </button>
                        <input type="hidden" id="signingReason" name="signingReason" maxlength="20" />
                        <input type="hidden" id="signingLocation" name="signingLocation" maxlength="20" />
                        <input type="hidden" id="stampingX" name="stampingX" maxlength="20" x-model="sign_x" />
                        <input type="hidden" id="stampingY" name="stampingY" maxlength="20" x-model="sign_y" />
                        <input type="hidden" id="tsaURL" name="tsaURL" value="" maxlength="100" style="width: 400px;" />
                        <input type="hidden" id="timeServerURL" name="timeServerURL" value="https://basundhara.assam.gov.in/dscapi/getServerTime" maxlength="100" style="width: 400px;" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="preview_notification_pdf" tabindex="-1" aria-labelledby="preview_notification_pdf" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="width: 100% !important;">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title"> <i class="fa fa-file"></i> Preview Notification of NC Village as a Cadastral Village Signed By Senior Most Secretary, R&DM Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-secondary" id="preview_notification_pdf_body">

                </div>
                <div class="modal-footer" style="display: block;">
                    <div>
                        <button type="button" class="btn btn-danger" id="closeBtn" data-dismiss="modal">
                            <i class='fa fa-close'></i> Close
                        </button>
                        <button x-on:click="signNotification" type="button" class="btn btn-primary"><i class="fa fa-pencil"></i>
                            Sign & Approve Notification
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
