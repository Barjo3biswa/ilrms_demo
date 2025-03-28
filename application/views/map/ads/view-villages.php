<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>
<script>
    function alpineData() {
        return {
            'dist_code': '<?= $dist_code ?>',
            'subdiv_code': '<?= $subdiv_code ?>',
            'cir_code': '<?= $cir_code ?>',
            'mouza_pargona_code': '<?= $mouza_pargona_code ?>',
            'lot_no': '<?= $lot_no ?>',
            'subdivs': [],
            'circles': [],
            'mouzas': [],
            'lots': [],
            'villages': [],
            'base_url': "<?= base_url(); ?>",
            'is_loading': false,
            'is_only_nc':'Y',
            init() {
                var self = this;
                self.getVillages();
                this.$watch('is_only_nc', function() {
                    self.getVillages();
                });
            },
            getVillages() {
                var self = this;
                this.is_loading = true;
                this.villages = [];
                $.ajax({
                    url: '<?= base_url(); ?>index.php/map/AdsMapController/getVillages',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dist_code': self.dist_code,
                        'subdiv_code': self.subdiv_code,
                        'cir_code': self.cir_code,
                        'mouza_pargona_code': self.mouza_pargona_code,
                        'lot_no': self.lot_no,
                        'is_only_nc':self.is_only_nc
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
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-3" x-data="alpineData()">
    <div x-data="alpineData()" class="row justify-content-center">
        <div class="col-lg-12">
            <div class="text-center p-2" style="font-size:18px; font-weight: bold; background-color: #ffc000">MAP UPLOAD MODULE</div>
            <div class="row pt-2">
                <div class="col-lg-2">
                    <label for="">District</label>
                    <select x-model="dist_code" id="district" class="form-control form-control-sm">
                        <option value=""><?= $locations['dist']['loc_name'] ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Sub-Division</label>
                    <select x-model="subdiv_code" id="subdiv" class="form-control form-control-sm">
                        <option value=""><?= $locations['subdiv']['loc_name'] ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Circle</label>
                    <select x-model="cir_code" id="circle" class="form-control form-control-sm">
                        <option value=""><?= $locations['circle']['loc_name'] ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Mouza</label>
                    <select x-model="mouza_pargona_code" id="mouza" class="form-control form-control-sm">
                        <option value=""><?= $locations['mouza']['loc_name'] ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Lot</label>
                    <select x-model="lot_no" id="lot" class="form-control form-control-sm">
                        <option value=""><?= $locations['lot']['loc_name'] ?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label for="">Village Type</label>
                    <select x-model="is_only_nc" id="is_only_nc" class="form-control form-control-sm">
                        <option value="N">All Villages</option>
                        <option value="Y">Only NC</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> LIST OF VILLAGES - <span x-text="villages.length"></span></h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered">
                        <thead class="bg-warning">
                        <tr>
                            <th>Village Name</th>
                            <th>IS NC Village</th>
                            <th>ADS Note</th>
                            <th>ADS Note Date</th>
                            <th>Status</th>
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
                                <td x-text="village.loc_name"></td>
                                <td x-bind:class="village.status == '1' ? 'text-success' : 'text-danger'" x-text="village.status == '1' ? 'Yes' : 'No'"></td>
                                <td x-text="village.ads_note"></td>
                                <td x-text="village.ads_verified_at"></td>
                                <td>
                                    <b>
                                        <small class="text-warning" x-show="village.ads_verified != 'Y'">Pending</small>
                                        <small class="text-success" x-show="village.ads_verified == 'Y'">Uploaded</small>
                                    </b>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info text-white" x-bind:href=base_url+"index.php/map/AdsMapController/showVillage?uuid="+village.uuid+"&dis="+village.dist_code>Proceed <i class=" fa fa-chevron-right"></i></a>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="villages.length == 0">
                            <td colspan="6" class="text-center">
                                <span>No villages Found</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
