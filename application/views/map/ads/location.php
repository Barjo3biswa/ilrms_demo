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
                });
                this.$watch('cir_code', function() {
                    self.mouza_pargona_code = '';
                    self.lot_no = '';
                    self.mouzas=[];
                    self.lots=[];
                    self.villages=[];
                    self.getMouzas();
                });
                this.$watch('mouza_pargona_code', function() {
                    self.lot_no = '';
                    self.lots=[];
                    self.villages=[];
                    self.getLots();
                });

            },
            getSubdivs() {
                var self = this;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/map/AdsMapController/subDivDetails',
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
                    url: '<?= base_url(); ?>index.php/map/AdsMapController/circledetails',
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
                    url: '<?= base_url(); ?>index.php/map/AdsMapController/mouzadetails',
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
                    url: '<?= base_url(); ?>index.php/map/AdsMapController/lotdetails',
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
        }
    }
</script>
<div class="col-md-10 m-auto mt-2" style="border-style: solid;" x-data="alpineData()">
    <div class="card-body">
        <div class="col-12 px-0 pb-3">
            <div class="bg-info text-white text-center py-2 rounded">
                <h5>Select Village Location for Map Upload</h5>
            </div>
        </div>
        <form method="get" action="<?= base_url()?>index.php/map/AdsMapController/viewVillages">
        <div class="form-group">
            <label for="sel1">District:</label>
            <select x-model="dist_code" id="district" name="dist_code" class="form-control">
                <option selected value="">Select District</option>
                <?php foreach ($dist_list as $value) { ?>
                    <option  value="<?= $value->dist_code?>"><?= $value->loc_name?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group pt-2">
            <label for="sel1">Sub-Division:</label>
            <select x-model="subdiv_code" id="subdiv" name="subdiv_code"  class="form-control">
                <option value="">Select Sub Division </option>
                <template x-for="(subdiv,index_subdiv) in subdivs" :key="index_subdiv">
                    <option x-bind:value="subdiv.subdiv_code" x-text="subdiv.loc_name"></option>
                </template>
            </select>
        </div>
        <div class="form-group pt-2">
            <label for="sel1">Circle:</label>
            <select x-model="cir_code" id="circle" name="cir_code"  class="form-control">
                <option value="">Select Circle </option>
                <template x-for="(circle,index_circle) in circles" :key="index_circle">
                    <option x-bind:value="circle.cir_code" x-text="circle.loc_name"></option>
                </template>
            </select>
        </div>
        <div class="form-group pt-2">
            <label for="sel1">Mouza:</label>
            <select x-model="mouza_pargona_code" id="mouza" name="mouza_pargona_code"  class="form-control" id="m" >
                <option value="">Select Mouza </option>
                <template x-for="(mouza,index_mouza) in mouzas" :key="index_mouza">
                    <option x-bind:value="mouza.mouza_pargona_code" x-text="mouza.loc_name"></option>
                </template>
            </select>
        </div>
        <div class="form-group pt-2">
            <label for="sel1">Lot:</label>
            <select x-model="lot_no" id="lot" name="lot_no"  class="form-control" id="l" >
                <option value="">Select Lot </option>
                <template x-for="(lot,index_lot) in lots" :key="index_lot">
                    <option x-bind:value="lot.lot_no" x-text="lot.loc_name"></option>
                </template>
            </select>
        </div>
        <div class="text-center mt-4">
            <button  type='submit' class="btn btn-primary">
                <i class=" fa fa-check"></i> Submit
            </button>
        </div>
        </form>
    </div>
</div>