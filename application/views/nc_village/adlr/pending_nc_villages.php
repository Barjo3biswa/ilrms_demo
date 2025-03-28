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
            'filter_status': 'I',
            init() {
                var village = '<?= json_encode($village) ?>';
                var village = JSON.parse(village);
                this.villages = village;

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
                    self.lots=[];
                    self.villages=[];
                    self.getLots();
                    self.getVillages();
                });
                this.$watch('lot_no', function() {
                    self.getVillages();
                });
                this.$watch('filter_status', function() {
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
            get getPendingVillages() {
                var total = 0;
                this.villages.forEach(element => {
                    if (element.co_verified != 'Y') {
                        total++;
                    }
                });
                return total;
            },
            getVillages() {
                var self = this;
                this.selected_villages = [];
                this.is_loading = true;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcAdlrController/getVillagesG',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dist_code': self.dist_code,
                        'subdiv_code': self.subdiv_code,
                        'cir_code': self.cir_code,
                        'mouza_pargona_code': self.mouza_pargona_code,
                        'lot_no': self.lot_no,
                        'filter': self.filter_status
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
            <div class="text-center p-2" style="font-size:18px; font-weight: bold; background-color: #ffc000">NC VILLAGE</div>
            <div class="row pt-2">
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
                        <option value="I">Pending</option>
                        <option value="A">Verified</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> VERIFIED VILLAGES BY DC
                                <small class="text-dark" x-text="'Total Villages : ' + villages.length"></small>, <small class="text-warning" x-text="getPendingVillages+' Pending'"></small>
                            </h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered">
                        <thead class="bg-warning">
                        <tr>
                            <th>District</th>
                            <th>Village Name</th>
                            <th>CO Note</th>
                            <th>DC Note</th>
                            <th>DC verified at</th>
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
                                <td x-text="village.dist_name"></td>
                                <td x-text="village.loc_name"></td>
                                <td x-text="village.co_note"></td>
                                <td x-text="village.dc_note"></td>
                                <td x-text="village.dc_verified_at"></td>
                                <td>
                                    <b>
                                        <small class="text-warning" x-show="village.status == 'I'">Pending</small>
                                        <small class="text-success" x-show="village.status == 'A'">Verified</small>
                                    </b>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info text-white" x-bind:href=base_url+"index.php/nc_village/NcAdlrController/getPendingVillage?application_no="+village.application_no+"&d="+village.dist_code>Proceed <i class=" fa fa-chevron-right"></i></a>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="villages.length == 0">
                            <td colspan="7" class="text-center">
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