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
            'lots': [],
            'villages': [],
            'proposal': [],
            'base_url': "<?= base_url(); ?>",
            'is_loading': false,
            'note': '',
            init() {
                var self = this;
                var revert_proposal = '<?= json_encode($revert_proposal) ?>';
                this.revert_proposal = JSON.parse(revert_proposal);
            },
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="text-center p-2 mb-2" style="font-size:18px; font-weight: bold; background-color: #4298c9; color: white">NC VILLAGE (Reverted To DLRS)</div>
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> List of reverted proposals </h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                        <tr>
                            <th>#</th>
                            <th>Proposal No</th>
                            <th>Date</th>
                            <th>ADLR Note</th>
                            <th>JDS Note</th>
                            <th>Proposal</th>
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
                        <template x-for="(ap,index) in revert_proposal " :key="index">
                            <tr>
                                <td x-text="++index"></td>
                                <td x-text="ap.proposal_no"></td>
                                <td x-text="ap.created_at"></td>
                                <td x-text="ap.adlr_note"></td>
                                <td x-text="ap.jds_note"></td>
                                <td>
                                    <a class="btn btn-sm btn-info text-white" x-bind:href="'<?= base_url() ?>index.php/nc_village/NcCommonController/viewProposal?id=' + ap.proposal_no" target="_blank">View <i class=" fa fa-eye"></i></a>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="revert_proposal.length == 0">
                            <td colspan="6" class="text-center">
                                <span>No Proposal Found</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
