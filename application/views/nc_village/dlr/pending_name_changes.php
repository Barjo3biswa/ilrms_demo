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
            },
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-3" x-data="alpineData()">
    <div x-data="alpineData()" class="row justify-content-center">
        <div class="col-lg-12">
            <div class="text-center p-2" style="font-size:18px; font-weight: bold; background-color: #ffc000">NC VILLAGE</div>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> VILLAGES FORWARDED TO JDS FOR NAME CHANGE ON MAP
                                <small class="text-dark" x-text="'Total Villages : ' + villages.length"></small>
                            </h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm table-bordered">
                            <thead class="bg-warning">
                                <tr>
                                    <th>Sl</th>
                                    <th>District</th>
                                    <th>Village Name</th>
                                    <th>DC Note</th>
                                    <th>DLRS Note</th>
                                    <th>JDS Note</th>
                                    <th>ADS Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(village,index) in villages">
                                    <tr>
                                        <td x-text="index + 1"></td>
                                        <td x-text="village.dist_name"></td>
                                        <td x-text="village.village_name"></td>
                                        <td x-text="village.dc_note"></td>
                                        <td x-text="village.dlr_note"></td>
                                        <td x-text="village.jds_note"></td>
                                        <td x-text="village.ads_note"></td>
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
</div>