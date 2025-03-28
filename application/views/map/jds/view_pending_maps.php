<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>
<script>
    function alpineData() {
        return {
            'dist_code': '',
            'subdiv_code': '',
            'cir_code': '',
            'mouza_pargona_code': '',
            'lot_no': '',
            'subdivs': [],
            'circles': [],
            'mouzas': [],
            'lots': [],
            'villages': [],
            'base_url': "<?= base_url(); ?>",
            'is_loading': false,
            'filter_status': 'A',
            'view_map_lists_village': '',
            'jds_remark': '',
            'is_forwarding': false,
            init() {
                var self = this;
                this.$watch('dist_code', function() {
                    self.subdiv_code = '';
                    self.cir_code = '';
                    self.mouza_pargona_code = '';
                    self.lot_no = '';
                    self.subdivs=[];
                    self.circles=[];
                    self.mouzas=[];
                    self.lots=[];
                    self.villages=[];
                    self.getSubdivs();
                    self.getVillages();
                });
                this.$watch('subdiv_code', function() {
                    self.cir_code = '';
                    self.mouza_pargona_code = '';
                    self.lot_no = '';
                    self.circles=[];
                    self.mouzas=[];
                    self.lots=[];
                    self.villages=[];
                    self.getCircles();
                    self.getVillages();
                });
                this.$watch('cir_code', function() {
                    self.mouza_pargona_code = '';
                    self.lot_no = '';
                    self.mouzas=[];
                    self.lots=[];
                    self.villages=[];
                    self.getMouzas();
                    self.getVillages();
                });
                this.$watch('mouza_pargona_code', function() {
                    self.lot_no = '';
                    self.lots = [];
                    self.villages = [];
                    self.getLots();
                    self.getVillages();
                });
                this.$watch('lot_no', function() {
                    self.getVillages();
                });
                this.$watch('filter_status', function() {
                    self.getVillages();
                });

                var villages = '<?= json_encode($maps) ?>';
                this.villages = JSON.parse(villages);
            },
            getSubdivs() {
                var self = this;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcCommonController/subDivDetails',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dis': self.dist_code,
                    },
                    success: function(data) {
                        self.subdivs = data;
                    }
                });
            },
            getCircles() {
                var self = this;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcCommonController/circledetails',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dis': self.dist_code,
                        'subdiv': self.subdiv_code,
                    },
                    success: function(data) {
                        self.circles = data;
                    }
                });
            },
            getMouzas() {
                var self = this;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcCommonController/mouzadetails',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dis': self.dist_code,
                        'subdiv': self.subdiv_code,
                        'cir': self.cir_code,
                    },
                    success: function(data) {
                        self.mouzas = data;
                    }
                });
            },
            getLots() {
                var self = this;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcCommonController/lotdetails',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dis': self.dist_code,
                        'subdiv': self.subdiv_code,
                        'cir': self.cir_code,
                        'mza': self.mouza_pargona_code
                    },
                    success: function(data) {
                        self.lots = data;
                    }
                });
            },
            getVillages() {
                var self = this;
                this.is_loading = true;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/map/JdsMapController/getMaps',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dis': self.dist_code,
                        'subdiv': self.subdiv_code,
                        'cir': self.cir_code,
                        'mouza_pargona_code': self.mouza_pargona_code,
                        'lot_no': self.lot_no,
                        'filter_status':self.filter_status
                    },
                    success: function(data) {
                        self.villages = data;
                        self.is_loading = false;
                    },
                    error: () => {
                        self.is_loading = false;
                    }
                });
            },
            closeModal() {
                $('#close_modal').trigger('click');
            },
            openMapListsModel(village) {
                this.view_map_lists_village = village;
                $('#jds_remark').val('');
            },
            forwardToCo(village) {
                var self = this;
                this.is_forwarding = true;
                $.confirm({
                    title: 'JDS Remark',
                    content:'<textarea id="jds_remark" placeholder="JDS Remark" class="form-control" required >Village map checked and forwarded to Circle Officer for verification.</textarea>',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Verify & Forward to CO',
                            btnClass: 'btn-success',
                            action: function() {
                                if (!$('#jds_remark').val()) {
                                    alert('Please enter the JDS Remark.');
                                    self.is_forwarding = false;
                                    return;
                                }
                                var jds_note = $('#jds_remark').val();
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
                                                    url: '<?= base_url(); ?>index.php/map/JdsMapController/forwardToCo',
                                                    method: "POST",
                                                    async: true,
                                                    dataType: 'json',
                                                    data: {
                                                        'jds_remark': jds_note,
                                                        'flag': 'F',
                                                        'map_id': village.id
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
                                                                content: 'Map Forwarded successfully.',
                                                                type: 'green',
                                                                typeAnimated: true,
                                                                buttons: {
                                                                    Ok: {
                                                                        text: 'OK',
                                                                        btnClass: 'btn-info',
                                                                        action: function() {
                                                                            if(self.dist_code)
                                                                            {
                                                                                self.getVillages();
                                                                            }
                                                                            else
                                                                            {
                                                                                location.reload();
                                                                            }

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
    <div class="text-center text-white p-2 mb-2" style="font-size:18px; font-weight: bold; background-color: #4298c9">VILLAGE MAP</div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-2">
                    <label for="">District</label>
                    <select x-model="dist_code" id="district" class="form-control form-control-sm">
                        <option value="">Select District</option>
                        <?php foreach ($dist_list as $dist) : ?>
                            <option value="<?= $dist->dist_code ?>"><?= $dist->loc_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Sub-Division</label>
                    <select x-model="subdiv_code" id="subdiv" class="form-control form-control-sm">
                        <option value="">Select Sub-division</option>
                        <template x-for="(subdiv,index_subdiv) in subdivs" :key="index_subdiv">
                            <option x-bind:value="subdiv.subdiv_code" x-text="subdiv.loc_name"></option>
                        </template>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Circle</label>
                    <select x-model="cir_code" id="circle" class="form-control form-control-sm">
                        <option value="">Select Circle</option>
                        <template x-for="(circle,index_circle) in circles" :key="index_circle">
                            <option x-bind:value="circle.cir_code" x-text="circle.loc_name"></option>
                        </template>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Mouza</label>
                    <select x-model="mouza_pargona_code" id="mouza" class="form-control form-control-sm">
                        <option value="">Select Mouza</option>
                        <template x-for="(mouza,index_mouza) in mouzas" :key="index_mouza">
                            <option x-bind:value="mouza.mouza_pargona_code" x-text="mouza.loc_name"></option>
                        </template>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Lot</label>
                    <select x-model="lot_no" id="lot" class="form-control form-control-sm">
                        <option value="">Select Lot</option>
                        <template x-for="(lot,index_lot) in lots" :key="index_lot">
                            <option x-bind:value="lot.lot_no" x-text="lot.loc_name"></option>
                        </template>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Filter</label>
                    <select x-model="filter_status" id="filter_status" class="form-control form-control-sm">
                        <option value="A">Pending</option>
                        <option value="F">Forwarded</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> MAPS UPLOADED BY ADS
                                <small class="text-dark" x-text="'Total Villages : ' + villages.length"></small>
                            </h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                        <tr>
                            <th>Village Name</th>
                            <th>Mouza</th>
                            <th>JDS Note</th>
                            <th>Maps</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr x-show="is_loading">
                            <td colspan="6" class="text-center">
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <template x-for="(village,index) in villages">
                            <tr>
                                <td x-text="village.village_name"></td>
                                <td x-text="village.mouza_name"></td>
                                <td x-text="village.jds_remark"></td>
                                <td>
                                    <button data-toggle="modal" data-target="#modal_views_map_lists" x-on:click="openMapListsModel(village)" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View Maps</button>
                                </td>
                                <td>
                                    <button x-bind:disabled="is_forwarding" x-show="village.flag == 'A'" type="button" x-on:click="forwardToCo(village)" class="btn btn-sm btn-success text-white">Verify & Forward to CO<i class="fa fa-chevron-right"></i></button>
                                    <span class="text-success" x-show="village.flag != 'A'">Maps Forwarded To CO</span>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="villages.length == 0">
                            <td colspan="5" class="text-center">
                                <span>No Pending Maps Found. Change filter dropdown to see forwarded maps.</span>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal_views_map_lists" tabindex="-1" aria-labelledby="modal_views_map_lists" aria-hidden="true">
        <div class="modal-dialog" style="width: 100% !important;">
            <div class="modal-content">
                <div class="modal-header p-2" x-show="view_map_lists_village">
                    <h5 class="modal-title"> <i class="fa fa-file"></i> Maps List of Village <span x-show="view_map_lists_village" class="text-info" x-text="view_map_lists_village.village_name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" onclick="closeModal()">&times;</span>
                    </button>
                </div>
                <div class="modal-body" x-show="view_map_lists_village">
                    <table class="table table-striped table-hover table-sm table-bordered">
                        <thead style="position: sticky;top:0;" class="bg-warning">
                        <tr>
                            <th>Sl.No.</th>
                            <th>View Map</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-for="(list,index) in view_map_lists_village.map_lists">
                            <tr>
                                <td x-text="index + 1"></td>
                                <td>
                                    <a x-bind:href="'<?= base_url() ?>index.php/nc_village/NcCommonController/viewUploadedMap?id=' + list.id" class="btn btn-info py-2" style="color: white" target="_blank">
                                        View Map
                                    </a>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="view_map_lists_village && view_map_lists_village.map_lists.length == 0">
                            <td colspan="4" class="text-center">
                                <span>No Map Found</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="closeModal()" class="btn btn-danger" data-dismiss="modal"><i class='fa fa-close'></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>