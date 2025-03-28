<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->

<div class="row" style='padding: 40px 50px 40px 20px'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="reza-card">
            <div class="reza-title">
                <span>List of Proposals under </span><span class="text-danger"><?= $this->utilclass->getMeetingNameByMeetingId($dist_code, $meeting_id) ?></span> &nbsp;<span class="text-primary">(District: <span class="text-primary"><?= $this->utilclass->getDistrictNameOnLanding($dist_code) ?></span>)
                    <hr>
            </div>

            <div class="reza-body">
                <?php if ($proposalsCount == 0) : ?>
                    <div style="margin-top: 15px" id="searchText">No Data Found !</div>
                <?php else : ?>
                    <table class='table table-striped table-bordered tablesorter  pageshowpage unicode' id='dataTable' width="100%">
                        <thead>
                            <tr>
                                <th><label class="control-label">Sl No</label></th>
                                <th><label class="control-label">Proposal Name</label></th>
                                <th class="center"><label class="control-label">Proposal Date</label></th>
                                <th class="center"><label class="control-label">Created By</label></th>
                                <th class="center"><label class="control-label">Action</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($proposals as $proposal) :  $i++ ?>
                                <tr>
                                    <td class="text-center"><?php echo $i ?> </td>
                                    <td>
                                        <strong class="text-primary"><?php echo $proposal->proposal_name; ?></strong>
                                    </td>
                                    <td class="text-center text-danger">
                                        <i class='fa fa-calendar'></i>
                                        on <?php echo date('d-M-Y', strtotime($proposal->created_at)); ?>
                                    </td>

                                    <td class="text-center">
                                        <i class='fa fa-user'></i>
                                        <?php echo $proposal->created_by; ?>
                                    </td>
                                    <td class="text-center">

                                        <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>index.php/Basundhara/getAllCasesUnderProposalDept/?proposal=<?php echo $proposal->id; ?>&dist_code=<?php echo $dist_code; ?>">
                                            <i class="fa fa-arrow-right"></i></i> View Cases Under Proposal
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">
<script src="<?php echo base_url('js/department/department.js'); ?>"></script>


<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();

        load_proposal_list_under_meeting();

        function load_proposal_list_under_meeting() {
            // $('#datatableProposalList thead th:nth-of-type(2)').each(function() {
            //     var title = $(this).text();
            //     $(this).html(title + ' <input type="text" class="form-control input_search form-control-sm" placeholder="Search ' + title + '" />');
            // });

            var base_url = "<?php echo base_url(); ?>";
            var dist_code = "<?= $dist_code ?>";
            var table = $('#datatableProposalList').DataTable({
                'pageLength': 10,
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "lengthMenu": [
                    [5, 10, 20, 50, 100],
                    [5, 10, 20, 50, 100]
                ],
                'language': {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                },
                'ajax': {
                    url: base_url + 'index.php/Basundhara/viewProposalListByMeeting',
                    type: 'POST',
                    data: {
                        dist_code: dist_code,
                    },
                    deferLoading: 57,
                },
                order: [
                    [2, 'asc']
                ],
                columnDefs: [{
                    targets: "_all",
                    orderable: false,
                    "className": "dt-center",
                    "targets": [0, 1, 2, 3, 4],
                }]
            });
            table.columns().every(function() {
                var table = this;
                $('input', this.header()).on('keyup change', function() {
                    if (table.search() !== this.value) {
                        table.search(this.value).draw();
                    }
                });
            });
            // button search
            $('.search_button').on('click', function() {
                $('table thead tr th .input_search').each(function() {
                    $(this).val('');
                    // table.column($(this).data('columnIndex')).search('');
                });
                $('#datatableProposalList').DataTable().destroy();
                load_proposal_list_under_meeting();
            });
        }
    });
</script> -->