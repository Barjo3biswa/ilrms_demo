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
            'village_name_assamese': '',
            'village_name_english': '',
            'rural_urban': '',
            'village_status': '',
            'is_mc': '',
            'is_map': '',
            'is_saving': false,
            'nc_btad': 'None',
            'is_periphary': '',
            'is_tribal': '',
            'edit_village': '',
            'edit_village_name': '',
            'edit_village_name_eng': '',
            'is_svamitva':'2',
            init() {
                var self = this;
                this.$watch('dist_code', function() {
                    self.subdiv_code = '';
                    self.cir_code = '';
                    self.mouza_pargona_code = '';
                    self.lot_no = '';
                    self.subdivs = [];
                    self.circles = [];
                    self.mouzas = [];
                    self.lots = [];
                    self.villages = [];
                    self.getSubdivs();
                });
                this.$watch('subdiv_code', function() {
                    self.cir_code = '';
                    self.mouza_pargona_code = '';
                    self.lot_no = '';
                    self.circles = [];
                    self.mouzas = [];
                    self.lots = [];
                    self.villages = [];
                    self.getCircles();
                });
                this.$watch('cir_code', function() {
                    self.mouza_pargona_code = '';
                    self.lot_no = '';
                    self.mouzas = [];
                    self.lots = [];
                    self.villages = [];
                    self.getMouzas();
                });
                this.$watch('mouza_pargona_code', function() {
                    self.lot_no = '';
                    self.lots = [];
                    self.villages = [];
                    self.getLots();
                });
                this.$watch('lot_no', function() {
                    self.getVillages();
                });
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
                    url: '<?= base_url(); ?>index.php/LocationController/getLots',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dist_code': self.dist_code,
                        'subdiv_code': self.subdiv_code,
                        'cir_code': self.cir_code,
                        'mouza_pargona_code': self.mouza_pargona_code
                    },
                    success: function(data) {
                        self.lots = data.data;
                    }
                });
            },
            getVillages() {
                var self = this;
                this.is_loading = true;
                this.villages = [];
                $.ajax({
                    url: '<?= base_url(); ?>index.php/LocationController/getVillages',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dist_code': self.dist_code,
                        'subdiv_code': self.subdiv_code,
                        'cir_code': self.cir_code,
                        'mouza_pargona_code': self.mouza_pargona_code,
                        'lot_no': self.lot_no
                    },
                    success: function(data) {
                        self.villages = data.data;
                        self.is_loading = false;
                    },
                    error: () => {
                        self.is_loading = false;
                    }
                });
            },
            saveVillage() {
                var self = this;
                this.is_saving = true;
                $.confirm({
                    title: 'Confirmation',
                    content: 'Please confirm to save the village',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function() {
                                $.ajax({
                                    url: '<?= base_url(); ?>index.php/LocationController/saveVillage',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: {
                                        'dist_code': self.dist_code,
                                        'subdiv_code': self.subdiv_code,
                                        'cir_code': self.cir_code,
                                        'mouza_pargona_code': self.mouza_pargona_code,
                                        'lot_no': self.lot_no,
                                        'village_name_assamese': self.village_name_assamese,
                                        'village_name_english': self.village_name_english,
                                        'rural_urban': self.rural_urban,
                                        'village_status': self.village_status,
                                        'is_mc': self.is_mc,
                                        'is_map': self.is_map,
                                        'nc_btad': self.nc_btad,
                                        'is_periphary': self.is_periphary,
                                        'is_tribal': self.is_tribal,
                                        'is_svamitva': self.is_svamitva,
                                    },
                                    success: function(data) {
                                        if (data.st == 'failed') {
                                            $.confirm({
                                                title: 'Error Occurred!!',
                                                content: data.msgs,
                                                type: 'red',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.is_saving = false;
                                                        }
                                                    },
                                                }
                                            });
                                        } else if (data.st == 'success') {
                                            $.confirm({
                                                title: 'Success',
                                                content: 'Village Saved Successfully.',
                                                type: 'green',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.getVillages();

                                                            self.is_saving = false;
                                                        }
                                                    },
                                                }
                                            });
                                        }
                                        self.is_saving = false;
                                    },
                                    error: function(error) {
                                        $.confirm({
                                            title: 'Error Occurred!!',
                                            content: 'Unable to save the village',
                                            type: 'red',
                                            typeAnimated: true,
                                            buttons: {
                                                Ok: {
                                                    text: 'OK',
                                                    btnClass: 'btn-info',
                                                    action: function() {
                                                        self.is_saving = false;
                                                    }
                                                },
                                            }
                                        });
                                        self.is_saving = false;
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            btnClass: 'btn-warning',
                            action: function() {
                                self.is_saving = false;
                            }
                        },
                    }
                });
            },
            isReady() {
                var is_ready = true;
                if (!this.village_name_assamese || !this.village_name_english) {
                    is_ready = false;
                }
                if (!this.rural_urban || !this.village_status || !this.is_mc || !this.is_map) {
                    is_ready = false;
                }
                return is_ready;
            },
            editVillage(uuid) {
                var self = this;
                this.is_loading = true;
                this.edit_uuid = '';
                $.ajax({
                    url: '<?= base_url(); ?>index.php/LocationController/getVillageSingle',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'uuid': uuid,
                        'dist_code': self.dist_code,
                    },
                    success: function(data) {
                        var village = data.data;
                        if (village) {
                            self.edit_uuid = uuid;
                            self.edit_village = village;
                            self.edit_village_name = village.loc_name;
                            self.edit_village_name_eng = village.locname_eng;
                            if(!self.edit_village.nc_btad){
                                self.edit_village.nc_btad = 'None';
                            }
                            $("#editVillageModal").modal("show");
                        }
                        self.is_loading = false;
                    },
                    error: () => {
                        self.is_loading = false;
                    }
                });
            },
            updateVillage() {
                var self = this;
                this.is_saving = true;
                $.confirm({
                    title: 'Confirmation',
                    content: 'Please confirm to update the village',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function() {
                                $.ajax({
                                    url: '<?= base_url(); ?>index.php/LocationController/updateVillage',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: {
                                        'dist_code': self.edit_village.dist_code,
                                        'subdiv_code': self.edit_village.subdiv_code,
                                        'cir_code': self.edit_village.cir_code,
                                        'mouza_pargona_code': self.edit_village.mouza_pargona_code,
                                        'lot_no': self.edit_village.lot_no,
                                        'uuid': self.edit_village.uuid,
                                        'village_name_assamese': self.edit_village.loc_name,
                                        'village_name_english': self.edit_village.locname_eng,
                                        'rural_urban': self.edit_village.rural_urban,
                                        'village_status': self.edit_village.village_status,
                                        'is_mc': self.edit_village.is_gmc,
                                        'is_map': self.edit_village.is_map,
                                        'nc_btad': self.edit_village.nc_btad,
                                        'is_periphary': self.edit_village.is_periphary,
                                        'is_tribal': self.edit_village.is_tribal,
                                        'is_svamitva': self.edit_village.status,
                                    },
                                    success: function(data) {
                                        if (data.st == 'failed') {
                                            $.confirm({
                                                title: 'Error Occurred!!',
                                                content: data.msgs,
                                                type: 'red',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.getVillages();
                                                            self.is_saving = false;
                                                        }
                                                    },
                                                }
                                            });
                                        } else if (data.st == 'success') {
                                            $.confirm({
                                                title: 'Success',
                                                content: 'Village updated Successfully.',
                                                type: 'green',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.getVillages();

                                                            self.is_saving = false;
                                                        }
                                                    },
                                                }
                                            });
                                        }
                                        self.is_saving = false;
                                    },
                                    error: function(error) {
                                        $.confirm({
                                            title: 'Error Occurred!!',
                                            content: 'Unable to update the village',
                                            type: 'red',
                                            typeAnimated: true,
                                            buttons: {
                                                Ok: {
                                                    text: 'OK',
                                                    btnClass: 'btn-info',
                                                    action: function() {
                                                        self.is_saving = false;
                                                    }
                                                },
                                            }
                                        });
                                        self.is_saving = false;
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            btnClass: 'btn-warning',
                            action: function() {
                                self.is_saving = false;
                            }
                        },
                    }
                });
            },
            deleteVillage(uuid) {
                var self = this;
                this.is_saving = true;
                $.confirm({
                    title: 'Confirmation',
                    content: 'Please confirm to delete the village',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        Confirm: {
                            text: 'Confirm',
                            btnClass: 'btn-success',
                            action: function() {
                                $.ajax({
                                    url: '<?= base_url(); ?>index.php/LocationController/deleteVillage',
                                    method: "POST",
                                    async: true,
                                    dataType: 'json',
                                    data: {
                                        'dist_code': self.dist_code,
                                        'uuid': uuid
                                    },
                                    success: function(data) {
                                        if (data.st == 'failed') {
                                            $.confirm({
                                                title: 'Error Occurred!!',
                                                content: data.msgs,
                                                type: 'red',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.getVillages();
                                                            self.is_saving = false;
                                                        }
                                                    },
                                                }
                                            });
                                        } else if (data.st == 'success') {
                                            $.confirm({
                                                title: 'Success',
                                                content: 'Village deleted Successfully.',
                                                type: 'green',
                                                typeAnimated: true,
                                                buttons: {
                                                    Ok: {
                                                        text: 'OK',
                                                        btnClass: 'btn-info',
                                                        action: function() {
                                                            self.getVillages();

                                                            self.is_saving = false;
                                                        }
                                                    },
                                                }
                                            });
                                        }
                                        self.is_saving = false;
                                    },
                                    error: function(error) {
                                        $.confirm({
                                            title: 'Error Occurred!!',
                                            content: 'Unable to delete the village',
                                            type: 'red',
                                            typeAnimated: true,
                                            buttons: {
                                                Ok: {
                                                    text: 'OK',
                                                    btnClass: 'btn-info',
                                                    action: function() {
                                                        self.is_saving = false;
                                                    }
                                                },
                                            }
                                        });
                                        self.is_saving = false;
                                    }
                                });
                            }
                        },
                        cancel: {
                            text: 'Cancel',
                            btnClass: 'btn-warning',
                            action: function() {
                                self.is_saving = false;
                            }
                        },
                    }
                });
            },
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="text-center text-white p-2 mb-2" style="font-size:18px; font-weight: bold; background-color: #4298c9">ADD NEW VILLAGE</div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-2">
                    <label for="">District</label>
                    <select x-model="dist_code" id="district" class="form-control form-control-sm">
                        <option value="">Select District</option>
                        <?php foreach ($districts as $dist) : ?>
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
                    <b>Total Villages : <span x-text="villages.length"></span></b>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="row mb-2">
                            <div class="form-group col-md-4">
                                <label for="village_name_assamese">Village Name (Assamese) <span class="text-danger">*</span> </label>
                                <input x-model="village_name_assamese" type="text" placeholder="Village Name in Assamese" class="form-control" id="village_name_assamese">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="village_name_english">Village Name (English)<span class="text-danger">*</span></label>
                                <input x-model="village_name_english" type="text" placeholder="Village Name in English" class="form-control" id="village_name_english">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="rural_urban">Rural/Urban<span class="text-danger">*</span></label>
                                <select x-model="rural_urban" name="rural_urban" id="" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="R">Rural</option>
                                    <option value="U">Urban</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group col-md-4">
                                <label>Village Type<span class="text-danger">*</span></label>
                                <select x-model="village_status" class="form-control" id="village_status" name="village_status" required>
                                    <option value="">--Select Village Type--</option>
                                    <option value="<?= NC_VILLAGE ?>"><?= NC_VILLAGE_TEXT ?></option>
                                    <option value="<?= REVENUE_VILLAGE ?>"><?= REVENUE_VILLAGE_TEXT ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Municipal Corporation<span class="text-danger">*</span></label>
                                <select x-model="is_mc" class="form-control" id="is_mc" name="is_mc" required>
                                    <option value="">--Select Municipal Corporation--</option>
                                    <option value="<?= MUNICIPALITY_BOARD ?>"><?= MUNICIPALITY_BOARD_TEXT ?></option>
                                    <option value="<?= TOWN_COMMITTEE ?>"><?= TOWN_COMMITTEE_TEXT ?></option>
                                    <option value="<?= MUNICIPALITY_CORPORATION ?>"><?= MUNICIPALITY_CORPORATION_TEXT ?></option>
                                    <option value="<?= MUNICIPALITY ?>"><?= MUNICIPALITY_TEXT ?></option>
                                    <option value="<?= NA ?>"><?= NA_TEXT ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label> Is Map Updated<span class="text-danger">*</span></label>
                                <select x-model="is_map" class="form-control" id="is_map" name="is_map" required>
                                    <option value="">--Select Is Map Updated--</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                                <span class="text-danger text-sm">(If map updated then map partition will be compulsory for new partition.)</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group col-md-4">
                                <label>Select Village Status</label>
                                <select class="form-control" x-model="nc_btad" id="nc_btad" required>
                                    <option>None</option>
                                    <?php foreach (json_decode(NC_BTAD_OPTIONS) as $option) :  ?>
                                        <option value="<?php echo ($option->CODE) ?>"><?php echo ($option->NAME) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>IS PERIPHARY</label>
                                <select class="form-control" x-model="is_periphary" id="is_periphary" required>
                                    <option value="">--Select--</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>IS TRIBAL</label>
                                <select class="form-control" x-model="is_tribal" id="is_tribal" required>
                                    <option value="">--Select--</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>IS SVAMITVA</label>
                                <select class="form-control" x-model="is_svamitva" id="is_svamitva" required>
                                    <option value="">--Select--</option>
                                    <option value="1">Yes</option>
                                    <option value="2">NO</option>
                                </select>
                            </div>
                        </div>
                        <button x-on:click="saveVillage" type="button" x-show="isReady && !is_saving" class="btn btn-success">Save New Village</button>
                        <div x-show="is_saving" class="spinner-border text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="border mb-2" style="height: 60vh;overflow-y:auto;">
                        <table class="table table-hover table-sm table-bordered table-stripe">
                            <thead class="bg-warning">
                                <tr>
                                    <th>Sl</th>
                                    <th>Village Name</th>
                                    <th>Village Name in English</th>
                                    <th>Village Code</th>
                                    <th>Village Unique Code</th>
                                    <th>Created Date</th>
                                    <th>Rural/Urban</th>
                                    <th>Is Svamitva</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr x-show="is_loading">
                                    <td colspan="8" class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <template x-for="(village,index) in villages">
                                    <tr>
                                        <td x-text="index + 1"></td>
                                        <td x-text="village.loc_name"></td>
                                        <td x-text="village.locname_eng"></td>
                                        <td x-text="village.vill_townprt_code"></td>
                                        <td x-text="village.uuid"></td>
                                        <td x-text="village.created_date"></td>
                                        <td x-text="village.village_type == 'R' ? 'Rural' : 'Urban'"></td>
                                        <td x-text="village.status == '1' ? 'Yes' : 'No'" x-bind:class="village.status == '1' ? 'text-success' : 'text-danger'"></td>
                                        <td>
                                            <button x-on:click="editVillage(village.uuid)" type="button" class="btn btn-info">Edit</button>
                                            <button x-on:click="deleteVillage(village.uuid)" type="button" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="villages.length == 0 && !is_loading">
                                    <td colspan="8" class="text-center">
                                        <span>No Maps Found.</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editVillageModal" tabindex="-1" aria-labelledby="editVillageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVillageModalLabel">Edit Village <span class="text-info" x-text="edit_village_name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-2">
                            <div class="form-group col-md-4">
                                <label for="village_name_assamese">Village Name (Assamese)<span class="text-danger">*</span></label>
                                <input x-model="edit_village.loc_name" type="text" placeholder="Village Name in Assamese" class="form-control" id="village_name_assamese">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="village_name_english">Village Name (English)<span class="text-danger">*</span></label>
                                <input x-model="edit_village.locname_eng" type="text" placeholder="Village Name in English" class="form-control" id="village_name_english">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="rural_urban">Rural/Urban<span class="text-danger">*</span></label>
                                <select x-model="edit_village.rural_urban" name="rural_urban" id="" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="R">Rural</option>
                                    <option value="U">Urban</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group col-md-4">
                                <label>Village Type<span class="text-danger">*</span></label>
                                <select x-model="edit_village.village_status" class="form-control" id="village_status" name="village_status" required>
                                    <option value="">--Select Village Type--</option>
                                    <option value="<?= NC_VILLAGE ?>"><?= NC_VILLAGE_TEXT ?></option>
                                    <option value="<?= REVENUE_VILLAGE ?>"><?= REVENUE_VILLAGE_TEXT ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Municipal Corporation<span class="text-danger">*</span></label>
                                <select x-model="edit_village.is_gmc" class="form-control" id="is_mc" name="is_mc" required>
                                    <option value="">--Select Municipal Corporation--</option>
                                    <option value="<?= MUNICIPALITY_BOARD ?>"><?= MUNICIPALITY_BOARD_TEXT ?></option>
                                    <option value="<?= TOWN_COMMITTEE ?>"><?= TOWN_COMMITTEE_TEXT ?></option>
                                    <option value="<?= MUNICIPALITY_CORPORATION ?>"><?= MUNICIPALITY_CORPORATION_TEXT ?></option>
                                    <option value="<?= MUNICIPALITY ?>"><?= MUNICIPALITY_TEXT ?></option>
                                    <option value="<?= NA ?>"><?= NA_TEXT ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label> Is Map Updated<span class="text-danger">*</span></label>
                                <select x-model="edit_village.is_map" class="form-control" id="is_map" name="is_map" required>
                                    <option value="">--Select Is Map Updated--</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                                <span class="text-danger text-sm">(If map updated then map partition will be compulsory for new partition.)</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group col-md-4">
                                <label>Select Village Status</label>
                                <select class="form-control" x-model="edit_village.nc_btad" id="nc_btad" required>
                                    <option>None</option>
                                    <?php foreach (json_decode(NC_BTAD_OPTIONS) as $option) :  ?>
                                        <option value="<?php echo ($option->CODE) ?>"><?php echo ($option->NAME) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>IS PERIPHARY</label>
                                <select class="form-control" x-model="edit_village.is_periphary" id="is_periphary" required>
                                    <option value="">--Select--</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>IS TRIBAL</label>
                                <select class="form-control" x-model="edit_village.is_tribal" id="is_tribal" required>
                                    <option value="">--Select--</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>IS SVAMITVA</label>
                                <select class="form-control" x-model="edit_village.status" id="is_svamitva" required>
                                    <option value="">--Select--</option>
                                    <option value="1">Yes</option>
                                    <option value="2">NO</option>
                                </select>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button x-on:click="updateVillage" type="button" x-show="!is_saving" class="btn btn-success">Update Village</button>
                    <div x-show="is_saving" class="spinner-border text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
