<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>

<script src="<?php echo base_url('js/dsc/dsc-signer.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/dsc/dscapi-conf.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/pdfjs/pdf.min.js') ?>" type="text/javascript"></script>
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
            'filter_status': 'pending',
            'sign_type': '',
            'base64_data': '',
            'sign_x': 200,
            'sign_y': 200,
            'pdf_h': '',
            'pdf_w': '',
            'village_id': [],
            'forward_to': 'A',
            'dlr_note': '',
            'forward_to_text': 'Send Proposal for approval and notification',
            init() {
                var self = this;
                var locations = '<?= json_encode($locations) ?>';
                var locations = JSON.parse(locations);
                this.dist_code = locations.dist.dist_code;
                var self = this;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcDlrController/getProposalPendingVillages',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dist_code':self.dist_code
                    },
                    success: function(data) {
                        self.villages = data;
                    }
                });
                //var villages = '<?//= json_encode($nc_village) ?>//';
                //this.villages = JSON.parse(villages);

                var approve_proposal = '<?= json_encode($approve_proposal) ?>';
                this.approve_proposal = JSON.parse(approve_proposal);

                $(document).ready(function() {
                    document.getElementById('preview_proposal_for_sign').addEventListener('click', function(event) {
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
                var parentElement = document.getElementById('preview_proposal_for_sign');
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
                $("#proposal_view").hide();
                this.sign_type = 'proposal';
                $('#closeBtn').prop('disabled', true);
                $('#signPdf').prop('disabled', true);
                $('#loader2').removeClass('invisible');
                var self = this;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcDlrController/saveProposalPdf',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dist_code': self.dist_code,
                        'village_id': self.village_id,
                    },
                    success: function(data) {
                        $('#closeBtn').prop('disabled', false);
                        $('#signPdf').prop('disabled', false);
                        $('#loader2').addClass('invisible');
                        if (data != null || data != '') {
                            self.base64_data = data;
                            self.loadPreviewForSign('<?= base_url() ?>index.php/nc_village/NcDlrController/getProposalBase');
                        }
                    }
                });
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
                        document.getElementById('preview_proposal_for_sign').appendChild(canvas);
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
                    url: '<?= base_url(); ?>index.php/nc_village/NcDlrController/storeSignedProposal',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'pdfbase': pdfData,
                        'sign_key': sign_key,
                        'dist_code': self.dist_code,
                        'village_id': self.village_id,
                        'forward_to': self.forward_to,
                        'dlr_note': self.dlr_note,
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
            approveProposal() {
                if(this.village_id.length == 0)
                {
                    alert('Please select village');
                    return;
                }
                if (!this.dlr_note) {
                    alert('Please enter the Director of Land Records and Surveys Note');
                    return;
                }
                var self = this;
                this.is_forwarding = true;
                if(self.forward_to =='A')
                {
                    var confirm = 'Please confirm to Proposal for approval and notification';
                }
                else if(self.forward_to == 'M')
                {
                    var confirm = 'Please confirm before forwarding the proposal.';
                }

                $.confirm({
                    title: 'Confirm',
                    content: confirm,
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function () {
                                $.ajax({
                                    url: '<?= base_url(); ?>index.php/nc_village/NcDlrController/getProposalVillageWise',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: {
                                        'village_id': self.village_id,
                                        'dist_code': self.dist_code,
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
                                            if(self.forward_to == 'A')
                                            {
                                                $('#proposal_div').html(data.data);
                                                $('#modal_proposal').modal('show');
                                            }
                                            else if(self.forward_to == 'M')
                                            {
                                                $('#proposal_div_adlr').html(data.data);
                                                $('#modal_proposal_adlr').modal('show');
                                            }
                                            else {
                                                alert("Please contact the system admin");
                                            }

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
            forward_to_adlr(){
                var self = this;
                this.is_forwarding = true;
                $.confirm({
                    title: 'Confirm',
                    content: 'Please confirm to forward proposal',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function () {
                                $.ajax({
                                    url: '<?= base_url(); ?>index.php/nc_village/NcDlrController/proposalForwardtoAdlr',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: {
                                        'village_id': self.village_id,
                                        'dist_code': self.dist_code,
                                        'dlr_note': self.dlr_note,
                                        'forward_to': self.forward_to,
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
            formatDate(dateString) {
                var date = new Date(dateString);
                return date.toLocaleString('en-IN', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                });
            }
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="text-center p-2 mb-2" style="font-size:18px; font-weight: bold; background-color: #4298c9; color: white">NC VILLAGE (Proposal for approval and notification)</div>
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> PENDING VILLAGES (Proposal for approval and notification)
                                <small class="text-dark" x-text="'Total Villages : ' + villages.length"></small>
                            </h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                            <tr>
                                <th>#</th>
                                <th>District</th>
                                <th>Circle</th>
                                <th>Village Name</th>
                                <th>DC verified on</th>
                                <th>DC Note</th>
                                <th>CO Note</th>
                                <th>Status</th>
                                <th>Action</th>
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
                            <template x-for="(village,index) in villages">
                                <tr>
                                    <td><input type="checkbox" x-model="village_id" x-bind:value="village.id"></td>
                                    <td><?= $locations->dist->loc_name ?></td>
                                    <td x-text="village.circle_name.loc_name"></td>
                                    <td x-text="village.loc_name"></td>
                                    <td x-text="formatDate(village.dc_verified_at)"></td>
                                    <td x-text="village.dc_note"></td>
                                    <td x-text="village.co_note"></td>
                                    <td>
                                        <b>
                                            <small class="text-warning">Pending Proposal</small>
                                        </b>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info text-white" x-bind:href=base_url+"index.php/nc_village/NcDlrController/getPendingVillage?application_no="+village.application_no+"&d="+village.dist_code target=" _blank">View <i class=" fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            </template>
                            <tr x-show="villages.length == 0">
                                <td colspan="6" class="text-center">
                                    <span>No Villages Found</span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="mt-3" x-show="villages.length > 0">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <th style="background-color: #136a6f; color: #fff">
                                DLRS Note <span class="text-danger">*</span>
                            </th>
                            </thead>
                            <tbody>
                            <tr>
                                <td><textarea class="form-control" x-model="dlr_note" placeholder="DLRS Note"></textarea></td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered">
                            <thead>
                            <th style="background-color: #136a6f; color: #fff">
                                Proposal Forward to <span class="text-danger">*</span>
                            </th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <select class="form-select" x-model="forward_to">
                                        <option value="A">Senior Most Secretary, R&DM Department</option>
                                        <option value="M">Additional Director of Land Records</option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div x-show="forward_to =='A'">
                            <button  class="btn btn-md btn-success" x-on:click="approveProposal()">
                                <i class=" fa fa-check"></i> Send Proposal for approval and notification
                            </button>
                        </div>
                        <div x-show="forward_to =='M'">
                            <button  class="btn btn-md btn-primary" x-on:click="approveProposal()">
                                <i class=" fa fa-forward"></i> Forward to Additional Director of Land Records
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> List of verified proposals</h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                            <tr>
                                <th>#</th>
                                <th>District</th>
                                <th>Proposal No</th>
                                <th>Date</th>
                                <th>Note</th>
                                <th>Pending at</th>
                                <th>Proposal</th>
                                <th>Action</th>
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
                            <template x-for="(ap,index) in approve_proposal" :key="index">
                                <tr>
                                    <td x-text="++index"></td>
                                    <td><?= $locations->dist->loc_name ?></td>
                                    <td x-text="ap.proposal_no"></td>
                                    <td x-text="formatDate(ap.updated_at)"></td>
                                    <td x-text="ap.proposal_note"></td>
                                    <td x-show="ap.status =='A'">Senior Most Secretary</td>
                                    <td x-show="ap.status =='B' || ap.status=='D'">ADLR</td>
                                    <td x-show="ap.status =='C'">JDS</td>
                                    <td>
                                        <a class="btn btn-sm btn-info text-white" x-bind:href="'<?= base_url() ?>index.php/nc_village/NcCommonController/viewProposal?id=' + ap.proposal_no" target="_blank">View <i class=" fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                       <a class="btn btn-sm btn-info text-white" x-bind:href="'<?= base_url() ?>index.php/nc_village/NcCommonMyController/getVillagesProposalWise?proposal_id=' + ap.id+'&proposal_no='+ap.proposal_no+'&dist_code='+ap.dist_code" target="_blank">View <i class=" fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            </template>
                            <tr x-show="approve_proposal.length == 0">
                                <td colspan="6" class="text-center">
                                    <span>No Verified Proposal Found</span>
                                </td>
                            </tr>
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
                        <div class="p-3" id="proposal_div">
                        </div>
                    </div>
                    <div class="modal-body bg-secondary" style="cursor:move" x-show="sign_type =='proposal'">
                        <div id="panel" class="bg-white"></div>
                        <div id="preview_proposal_for_sign"></div>
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


        <div class="modal" id="modal_proposal_adlr" tabindex="-1" aria-labelledby="modal_proposal_adlr" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-xl" style="width: 100% !important;">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title" > <i class="fa fa-file"></i> Proposal forward to Additional Director of Land Records</h5>
                    </div>
                    <div class="modal-body " id="proposal_view" >
                        <div class="p-3" id="proposal_div_adlr">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button x-on:click="cancelSign" type="button" class="btn btn-danger" id="closeBtn" data-dismiss="modal"><i class='fa fa-close'></i> Close / Cancel
                        </button>
                        <button type="button" x-on:click="forward_to_adlr" class="btn btn-primary"><i class="fa fa-forward"></i> Proposal Forward to Additional Director of Land Records </button>
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
