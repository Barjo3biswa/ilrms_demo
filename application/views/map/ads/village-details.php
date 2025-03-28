<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>
<script>
    function alpineData() {
        return {
            'dags': [],
            'base_url': "<?= base_url(); ?>",
            'dist_code': '',
            'uuid': '',
            'pdf': [],
            'is_loading': false,
            'ads_note': '',
            'map_id': '',
            'ads_verified': '',
            'village': '',
            'note_updated': '',
            'map_list': [],
            'application_no':'',
            init() {
                var village = '<?= json_encode($village) ?>';
                var village = JSON.parse(village);
                this.village = village;
                this.dist_code = village.dist_code;
                this.uuid = village.uuid;
                this.application_no = '<?= $application_no ?>';
                this.ads_note = village.ads_note;
                this.ads_verified = village.ads_verified;
                this.note_updated = village.ads_note;
                this.map_id = village.map_id;
                var map_list = '<?= json_encode($map_list) ?>';
                this.map_list = JSON.parse(map_list);
                this.getDags();
            },
            selectFile(event) {
                this.pdf = event.target.files
            },
            getDags() {
                var self = this;
                this.is_loading = true;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/map/AdsMapController/getDags',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dist_code': self.dist_code,
                        'subdiv_code': self.village.subdiv_code,
                        'cir_code': self.village.cir_code,
                        'mouza_pargona_code': self.village.mouza_pargona_code,
                        'lot_no': self.village.lot_no,
                        'vill_townprt_code': self.village.vill_townprt_code
                    },
                    success: function(data) {
                        if (data.success != 'Y') {
                            $.confirm({
                                title: 'Error Occurred!!',
                                content: 'Data Not Found. Please contact the system admin.',
                                type: 'red',
                                typeAnimated: true,
                                buttons: {
                                    Ok: {
                                        text: 'OK',
                                        btnClass: 'btn-info',
                                        action: function() {
                                            self.is_loading = false;
                                        }
                                    },
                                }
                            });
                            return;
                        }
                        self.dags = data.dags;
                        self.is_loading = false;
                    }
                });
                self.is_loading = false;
            },
            certifyVillage() {
                if (!this.ads_note) {
                    alert('Please enter the Asst Director of Surveys (ADS) Note');
                    return;
                }
                if (this.pdf.length == 0) {
                    alert('Please select Map (pdf).');
                    return;
                }
                var self = this;
                this.is_loading = true;
                $.confirm({
                    title: 'Confirm',
                    content: 'Please confirm to upload Map of this Village',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function() {
                                var maps = self.pdf;
                                var data1 = new FormData()
                                $.each(maps, function(i, map) {
                                    if (maps.length > 0) {
                                        data1.append('pdf[]', map);
                                    }
                                });
                                data1.append('dist_code', self.dist_code)
                                data1.append('subdiv_code', self.village.subdiv_code)
                                data1.append('cir_code', self.village.cir_code)
                                data1.append('mouza_pargona_code', self.village.mouza_pargona_code)
                                data1.append('lot_no', self.village.lot_no)
                                data1.append('vill_townprt_code', self.village.vill_townprt_code)
                                data1.append('uuid', self.uuid)
                                data1.append('remark', self.ads_note)
                                $.ajax({
                                    url: '<?= base_url(); ?>index.php/map/AdsMapController/uploadMap',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: data1,
                                    cache: false,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        if (data.submitted != 'Y') {
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
                                                            self.is_loading = false;
                                                        }
                                                    },
                                                }
                                            });
                                            return;
                                        }
                                        if (data.submitted == 'Y') {
                                            $.confirm({
                                                title: 'Success',
                                                content: 'The Map of this village Successfully Uploaded.',
                                                type: 'green',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.is_loading = false;
                                                            self.village = data.village;
                                                            self.note_updated = data.village.ads_note;
                                                            self.map_list = data.map_list;
                                                            location.reload();
                                                        }
                                                    },
                                                }
                                            });
                                        }
                                        self.is_loading = false;
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
                                                        self.is_loading = false;
                                                    }
                                                },
                                            }
                                        });
                                        self.is_loading = false;
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            btnClass: 'btn-warning',
                            action: function() {
                                self.is_loading = false;
                            }
                        },
                    }
                });
            },
            reCertifyVillage() {
                if (!this.ads_note) {
                    alert('Please enter the Asst Director of Surveys (ADS) Note');
                    return;
                }
                if (this.pdf.length == 0) {
                    alert('Please select Map (pdf).');
                    return;
                }
                var self = this;
                this.is_loading = true;
                $.confirm({
                    title: 'Confirm',
                    content: 'Please confirm the re-upload of the map of this village. Note that previously uploaded Map files will be deleted.',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function() {
                                var maps = self.pdf;
                                var data1 = new FormData()
                                $.each(maps, function(i, map) {
                                    if (maps.length > 0) {
                                        data1.append('pdf[]', map);
                                    }
                                });
                                data1.append('dist_code', self.dist_code)
                                data1.append('subdiv_code', self.village.subdiv_code)
                                data1.append('cir_code', self.village.cir_code)
                                data1.append('mouza_pargona_code', self.village.mouza_pargona_code)
                                data1.append('lot_no', self.village.lot_no)
                                data1.append('vill_townprt_code', self.village.vill_townprt_code)
                                data1.append('uuid', self.uuid)
                                data1.append('remark', self.ads_note)
                                data1.append('map_id', self.map_id)
                                $.ajax({
                                    url: '<?= base_url(); ?>index.php/map/AdsMapController/reUploadMap',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: data1,
                                    cache: false,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        if (data.submitted != 'Y') {
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
                                                            self.is_loading = false;
                                                        }
                                                    },
                                                }
                                            });
                                            return;
                                        }
                                        if (data.submitted == 'Y') {
                                            $.confirm({
                                                title: 'Success',
                                                content: 'The Map of this village Successfully Re Uploaded.',
                                                type: 'green',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.is_loading = false;
                                                            self.village = data.village;
                                                            self.note_updated = data.village.ads_note;
                                                            self.map_list = data.map_list;
                                                            location.reload();
                                                        }
                                                    },
                                                }
                                            });
                                        }
                                        self.is_loading = false;
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
                                                        self.is_loading = false;
                                                    }
                                                },
                                            }
                                        });
                                        self.is_loading = false;
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            btnClass: 'btn-warning',
                            action: function() {
                                self.is_loading = false;
                            }
                        },
                    }
                });
            },
            reCertifyNameChangeVillage() {
                if (!this.ads_note) {
                    alert('Please enter the Asst Director of Surveys (ADS) Note');
                    return;
                }
                if (this.pdf.length == 0) {
                    alert('Please select Map (pdf).');
                    return;
                }
                var self = this;
                this.is_loading = true;
                $.confirm({
                    title: 'Confirm',
                    content: 'Please confirm the re-upload of the map of this village. Note that previously uploaded Map files will be deleted.',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function() {
                                var maps = self.pdf;
                                var data1 = new FormData()
                                $.each(maps, function(i, map) {
                                    if (maps.length > 0) {
                                        data1.append('pdf[]', map);
                                    }
                                });
                                data1.append('dist_code', self.dist_code)
                                data1.append('subdiv_code', self.village.subdiv_code)
                                data1.append('cir_code', self.village.cir_code)
                                data1.append('mouza_pargona_code', self.village.mouza_pargona_code)
                                data1.append('lot_no', self.village.lot_no)
                                data1.append('vill_townprt_code', self.village.vill_townprt_code)
                                data1.append('uuid', self.uuid)
                                data1.append('remark', self.ads_note)
                                data1.append('map_id', self.map_id)
                                data1.append('application_no', self.application_no)
                                $.ajax({
                                    url: '<?= base_url(); ?>index.php/map/AdsMapController/reUploadMapNameChange',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: data1,
                                    cache: false,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        if (data.submitted != 'Y') {
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
                                                            self.is_loading = false;
                                                        }
                                                    },
                                                }
                                            });
                                            return;
                                        }
                                        if (data.submitted == 'Y') {
                                            $.confirm({
                                                title: 'Success',
                                                content: 'The map of this village successfully re-uploaded.',
                                                type: 'green',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.is_loading = false;
                                                            self.village = data.village;
                                                            self.note_updated = data.village.ads_note;
                                                            self.map_list = data.map_list;
                                                            location.reload();
                                                        }
                                                    },
                                                }
                                            });
                                        }
                                        self.is_loading = false;
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
                                                        self.is_loading = false;
                                                    }
                                                },
                                            }
                                        });
                                        self.is_loading = false;
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            btnClass: 'btn-warning',
                            action: function() {
                                self.is_loading = false;
                            }
                        },
                    }
                });
            },
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="text-center p-2" style="font-size:18px; font-weight: bold; background-color: #ffc000">MAP UPLOAD MODULE</div>
            <div class="row pt-2">
                <div class="col-lg-2">
                    <label for="">District</label>
                    <select id="dist_code" class="form-control form-control-sm">
                        <option selected value="<?= $locations['dist']['dist_code'] ?>"><?= $locations['dist']['loc_name'] ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Sub-Division</label>
                    <select id="subdiv_code" class="form-control form-control-sm">
                        <option selected value="<?= $locations['subdiv']['subdiv_code'] ?>"><?= $locations['subdiv']['loc_name'] ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Circle</label>
                    <select id="cir_code" class="form-control form-control-sm">
                        <option selected value="<?= $locations['circle']['cir_code'] ?>"><?= $locations['circle']['loc_name'] ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Mouza</label>
                    <select id="mouza_pargona_code" class="form-control form-control-sm">
                        <option selected value="<?= $locations['mouza']['mouza_pargona_code'] ?>"><?= $locations['mouza']['loc_name'] ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Lot</label>
                    <select id="lot_no" class="form-control form-control-sm">
                        <option selected value="<?= $locations['lot']['lot_no'] ?>"><?= $locations['lot']['loc_name'] ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Village</label>
                    <select id="vill_townprt_code" class="form-control form-control-sm">
                        <option selected value="<?= $locations['village']['vill_townprt_code'] ?>"><?= $locations['village']['loc_name'] ?></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5> VILLAGE DAGS
                        <span class="bg-gradient-danger text-red">
                            (Total Dags : <b x-text="dags.length"></b>)</span>

                        <span x-show="village.ads_verified == 'Y'">
                            <button class="btn btn-info py-2" style="color: white" onclick="viewMaps()">
                                <i class='fa fa-eye'></i> View Map
                            </button>
                        </span>
                    </h5>
                    <div class="border mb-2" style="height: 60vh;overflow-y:auto;">
                        <table class="table table-striped table-hover table-sm table-bordered">
                            <thead style="position: sticky;top:0;" class="bg-warning">
                            <tr>
                                <th>Sl.No.</th>
                                <th>Dag</th>
                                <th>Patta No</th>
                                <th>Area(B-K-L)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template x-for="(dag,index) in dags">
                                <tr>
                                    <td x-text="index + 1"></td>
                                    <td x-text="dag.dag_no"></td>
                                    <td x-text="dag.patta_no"></td>
                                    <td x-text="dag.dag_area_b+'-'+dag.dag_area_k+'-'+dag.dag_area_lc"></td>
                                </tr>
                            </template>
                            <tr x-show="dags.length == 0">
                                <td colspan="4" class="text-center">
                                    <span x-show="!is_loading">No dags Found</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="border-top border-dark py-3" x-show="village.ads_verified != 'Y'">
                        <div class="form-group pb-2">
                            <label for="" class="form-label pt-2" style="font-weight: bold;">Asst Director of Surveys (ADS) Note <span style="color: red">*</span></label>
                            <textarea x-model="ads_note" placeholder="Asst Director of Surveys (ADS) Note" rows="2" class="form-control"></textarea>

                            <label for="" class="form-label pt-2" style="font-weight: bold;">Upload Maps (Pdf Only, Max <?= MAP_PDF_SIZE / 1024; ?>MB) <span style="color: red">*</span></label>
                            <input class="form-control" type="file" multiple="" id="map" x-on:change="selectFile($event)" accept="application/pdf" />
                        </div>
                        <button x-on:click="certifyVillage" class="btn btn-success mt-2" type="button"><i class="fa fa-check"></i> Upload Village Map</button>
                    </div>

                    <?php if ($name_change == 'Y') : ?>
                        <div>
                            <div class="form-group pb-2">
                                <label for="" class="form-label pt-2" style="font-weight: bold;">Asst Director of Surveys (ADS) Note <span style="color: red">*</span></label>
                                <textarea x-model="ads_note" placeholder="Asst Director of Surveys (ADS) Note" rows="2" class="form-control"></textarea>

                                <label for="" class="form-label pt-2" style="font-weight: bold;">Upload Maps (Pdf Only, Max <?= MAP_PDF_SIZE / 1024; ?>MB) <span style="color: red">*</span></label>
                                <input class="form-control" type="file" multiple="" id="map" x-on:change="selectFile($event)" accept="application/pdf" />
                            </div>
                            <button x-on:click="reCertifyNameChangeVillage" class="btn btn-info mt-2" type="button"><i class="fa fa-check"></i> Re-Upload Village Map</button>
                            <p class="text-danger"> (Note : that previously uploaded Map files will be deleted.)</p>
                        </div>
                    <?php endif; ?>
                    <?php if ($name_change != 'Y') : ?>
                        <div x-show="village.ads_verified == 'Y' && village.flag != 'D'">
                            <div class="form-group pb-2">
                                <label for="" class="form-label pt-2" style="font-weight: bold;">Asst Director of Surveys (ADS) Note <span style="color: red">*</span></label>
                                <textarea x-model="ads_note" placeholder="Asst Director of Surveys (ADS) Note" rows="2" class="form-control"></textarea>

                                <label for="" class="form-label pt-2" style="font-weight: bold;">Upload Maps (Pdf Only, Max <?= MAP_PDF_SIZE / 1024; ?>MB) <span style="color: red">*</span></label>
                                <input class="form-control" type="file" multiple="" id="map" x-on:change="selectFile($event)" accept="application/pdf" />
                            </div>
                            <button x-on:click="reCertifyVillage" class="btn btn-danger mt-2" type="button"><i class="fa fa-check"></i> Re-Upload Village Map (Note that previously uploaded Map files will be deleted.)</button>
                        </div>
                        <div x-show="village.ads_verified == 'Y' && village.flag == 'D'">
                            <label for="" class="form-label" style="font-weight: bold;">Asst Director of Surveys (ADS) Note</label>
                            <textarea x-model="note_updated" placeholder="Asst Director of Surveys (ADS) Note" rows="2" class="form-control" readonly></textarea>
                            <h5 class="text-success pt-2">The map of the village has already been uploaded.</h5>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="modal" id="modal_show_map_list" tabindex="-1" aria-labelledby="modal_show_map_list" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-xl" style="width: 100% !important;">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title"> <i class="fa fa-file"></i> View Maps</h5>
                    </div>
                    <div class="modal-body">
                        <div class="border mb-2" style="height: 60vh;overflow-y:auto;">
                            <table class="table table-striped table-hover table-sm table-bordered">
                                <thead style="position: sticky;top:0;" class="bg-warning">
                                <tr>
                                    <th>Sl.No.</th>
                                    <th>View Map</th>
                                </tr>
                                </thead>
                                <tbody>
                                <template x-for="(list,index) in map_list">
                                    <tr>
                                        <td x-text="index + 1"></td>
                                        <td>
                                            <a x-bind:href="'<?= base_url() ?>index.php/map/AdsMapController/viewUploadedMap?id=' + list.id" class="btn btn-info py-2" style="color: white" target="_blank">
                                                View Map
                                            </a>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="map_list.length == 0">
                                    <td colspan="4" class="text-center">
                                        <span x-show="!is_loading">No Map Found</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="closeBtn" data-dismiss="modal">
                            <i class='fa fa-close'></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function viewMaps() {
        $('#modal_show_map_list').modal('show');
    }
</script>