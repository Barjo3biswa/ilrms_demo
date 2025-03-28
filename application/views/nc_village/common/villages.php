<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>

<script src="<?php echo base_url('js/dsc/dsc-signer.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/dsc/dscapi-conf.js') ?>" type="text/javascript"></script>
<!--<link type="text/css" rel="stylesheet" href="--><?php //echo base_url('css/dsc/dsc-signer.css') ?><!--">-->
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
            'proposal_id': '',
            'proposal_no': '',
            init() {
                var locations = '<?= json_encode($locations) ?>';
                var locations = JSON.parse(locations);
                this.dist_code = locations.dist.dist_code;
                this.proposal_id = '<?= $proposal_id ?>';
                this.proposal_no = '<?= $proposal_no ?>';
                var self = this;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcCommonMyController/getProposalPendingVillages',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dist_code':self.dist_code,
                        'proposal_id':self.proposal_id,
                        'proposal_no':self.proposal_no
                    },
                    success: function(data) {
                        self.villages = data;
                    }
                });
                //var villages = '<?//= json_encode($nc_village) ?>//';
                //this.villages = JSON.parse(villages);
            },
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="text-center p-2 mb-2" style="font-size:18px; font-weight: bold; background-color: #4298c9; color: white">NC VILLAGE</div>
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> NC VILLAGES <span class="text-danger">(PROPOSAL NO.: <?= $proposal_no?>)</span>
                                <a class="btn btn-sm btn-primary text-white" href="<?= base_url() ?>index.php/nc_village/NcCommonController/viewProposal?id=<?= $proposal_no?>"
                                   target="_blank">View Proposal <i class=" fa fa-eye"></i></a>
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
                            <th>Chitha Dag</th>
                            <th>Bhunaksha Dag</th>
                            <th>Chitha Area (sq km)</th>
                            <th>Bhunaksha Area (sq km)</th>
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
                        <template x-for="(village,index) in villages" :key="index">
                            <tr>
                                <td x-text="++index"></td>
                                <td><?= $locations->dist->loc_name ?></td>
                                <td x-text="village.circle_name.loc_name"></td>
                                <td x-text="village.loc_name"></td>
                                <td x-text="village.chitha_total_dag"></td>
                                <td x-text="village.bhunaksa_total_dag"></td>
                                <td>
                                     <span x-show="village.chitha_total_area_skm < 2" class="text-danger" style="font-weight: bold" x-text="village.chitha_total_area_skm"></span>
                                     <span x-show="village.chitha_total_area_skm >= 2" x-text="village.chitha_total_area_skm"></span>
                                </td>
                                <td>
                                    <span x-show="village.bhunaksa_total_area_skm < 2" class="text-danger font-weight-bold" style="font-weight: bold" x-text="village.bhunaksa_total_area_skm"></span>
                                    <span x-show="village.bhunaksa_total_area_skm >= 2" x-text="village.bhunaksa_total_area_skm"></span>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info text-white" x-bind:href=base_url+"index.php/nc_village/NcCommonMyController/getVillageDetails?application_no="+village.application_no+"&d="+village.dist_code>View <i class=" fa fa-eye"></i></a>
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
                    <p style="font-weight: bold">
                        (<span class="text-danger">*</span>) Villages having areas less than 2 square kilometers.
                    </p>
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
