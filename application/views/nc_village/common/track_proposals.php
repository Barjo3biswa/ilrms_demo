<script src="<?php echo base_url('assets/plugins/alpinejs/alpinejs3.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.css') ?>">
<script src="<?= base_url('assets/plugins/jquery-confirm-v3.3.4/jquery-confirm.min.js') ?>"></script>

<script>
    function alpineData() {
        return {
            'dist_code': '',
            'proposals': [],
            'base_url': "<?= base_url(); ?>",
            'is_loading': false,
            init() {
                this.getProposals();
            },
            getProposals(){
                this.is_loading = true;
                var self = this;
                $.ajax({
                    url: '<?= base_url(); ?>index.php/nc_village/NcCommonMyController/getProposals',
                    method: "POST",
                    async: true,
                    dataType: 'json',
                    data: {
                        'dist_code':self.dist_code,
                    },
                    success: function(data) {
                        self.proposals = data;
                        self.is_loading = false;
                    }
                });
            }
        }
    }
</script>
<div class="col-lg-12 col-md-12 p-2" x-data="alpineData()">
    <div class="text-center p-2 mb-2" style="font-size:18px; font-weight: bold; background-color: #4298c9; color: white">NC VILLAGE PROPOSALS</div>
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5> NC VILLAGES PROPOSALS STATUS
                            </h5>
                        </div>
                    </div>
                    <table class="table table-hover table-sm table-bordered table-stripe">
                        <thead class="bg-warning">
                        <tr>
                            <th>#</th>
                            <th>District</th>
                            <th>PROPOSAL NO</th>
                            <th>CREATED AT</th>
                            <th>TOTAL VILLAGES</th>
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
                        <template x-for="(proposal,index) in proposals" :key="index">
                            <tr>
                                <td x-text="++index"></td>
                                <td x-text="proposal.dist_name"></td>
                                <td x-text="proposal.proposal.proposal_no"></td>
                                <td x-text="proposal.proposal.created_at"></td>
                                <td x-text="proposal.proposal.total_villages"></td>
                                <td><a x-bind:href=base_url+"index.php/nc_village/NcCommonMyController/trackProposalView/"+proposal.dist_code+'/'+proposal.proposal.proposal_no  class="btn btn-sm btn-info" >View Status</a></td>
                            </tr>
                        </template>
                        <tr x-show="proposals.length == 0">
                            <td colspan="6" class="text-center">
                                <span>No proposals Found</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
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


