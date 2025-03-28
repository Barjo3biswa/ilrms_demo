<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->
<style>
    .reza-card {
        background: #fff;
        border-radius: 2px;
        display: inline-block;
        margin: 1rem;
        position: relative;
        width: 100%;
    }

    .reza-card {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
    }

    .reza-title {
        font-weight: bold;
        font-size: 18px;
        padding: 20px;
        color: #37474F;
    }

    .reza-body {
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 20px;
    }

    .badge {
        padding: 10px;
        font-size: 15px;
    }

    .rezaButt {
        color: #FFF;
        background-color: #03a9f4;
    }

    .rezaButt:hover {
        color: #0c0c0c;
    }

    .rezaButt {
        display: inline-block;
        position: relative;
        cursor: pointer;
        height: 35px;
        min-width: 150px;
        line-height: 35px;
        padding: 0 1.5rem;
        font-size: 15px;
        font-weight: 600;
        font-family: "Roboto", sans-serif;
        letter-spacing: 0.8px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        vertical-align: middle;
        white-space: nowrap;
        outline: none;
        border: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border-radius: 2px;
        transition: all 0.3s ease-out;
    }

    .rezaText {
        font-size: 16px;
    }

    label {
        padding-bottom: 5px;
        font-weight: bold;
    }

    #searchBox {
        padding: 15px;
        border: 1px solid #00BCD4;
        margin: 0px;
    }

    #cases_wrapper {
        margin-top: 0px !important;
    }

    /*.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {*/
    /*display: none;*/
    /*}*/
</style>

<div class="row" style='padding: 40px 50px 40px 20px'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="reza-card">
            <div class="reza-title">
                <span>Case Search</span>

                <hr style="margin-bottom: -5px">

            </div>
            <div class="text-center">
                <p class="text-danger">( N.B: Please Select District Before Proceed )</p>
            </div>

            <div class="reza-body">

                <form action="<?php echo base_url(); ?>index.php/OfflineSettlement/getCasesListByDistrict" method="post">
                    <div class="row" id="searchBox">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="selectDistrict">District</label>
                                <select class="form-select districtselect1" aria-label="Default select example" name="selectDistrict" id="" required>
                                    <option disabled selected>Select District</option>
                                    <?php foreach ($user_dist as $dist) :  ?>
                                        <option value='<?php echo $dist->dist_code; ?>'><?= $this->utilclass->getDistrictNameOnLanding($dist->dist_code) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 15px" align="right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="rezaButt buttInfo" id="" style="width: 200px">
                                <i class="fa fa-search" aria-hidden="true"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="reza-card">
            <div class="reza-title">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <span>Case List
                            <?php if ($dist_code != NULL) : ?>
                                for District: <span class="text-primary"><?= $this->utilclass->getDistrictNameOnLanding($dist_code) ?></span>
                            <?php endif; ?>
                            <input type="hidden" value="<?php echo $dist_code ?>" id="selectDistrict">
                        </span>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12" align="right">
                    </div>
                </div>
                <hr style="margin-bottom: -5px">
            </div>

            <div class="reza-body" id="showBody">
                 <?php if ($dist_code == NULL) : ?>
                    <div style="margin-top: 15px" id="searchText">No Data Found !Please Select District</div>
                <?php else : ?>

                    <!-- DataTable -->
                    <table class='table table-striped table-bordered' id='dataTableDeptByDist' width="100%">
                        <thead>
                            <tr>
                                <!-- <th class="center">All <input type="checkbox" class="checkBoxD " value="all" id="checkedAll"> </th> -->
                                <th class="center"><label class="control-label">Case No</label></th>
                                <th class="center">
                                    <label class="control-label">Service</label>
                                <select class="form-control input_search" name="select_service" id="select_service" data-column-index="4">
                                    <option value="">--SELECT--</option>
                                    <option value="<?= OFFLINE_SETTLEMENT_ID ?>">
                                               Offline Khas Land
                                    </option>
                                    
                            </select>
                                </th>
                                <th class="center">
                                <label class="control-label">Meeting</label>
                                    <select class="form-select input_search" aria-label="Default select example" name="select_meeting" id="select_meeting" required>
                                        <option value="">--Select Meeting--</option>
                                            <?php foreach ($meetingList as $meeting) :  ?>
                                                <option value="<?= $meeting->id; ?>"><?= $meeting->meeting_name; ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </th>
                                <th class="center"><label class="control-label">Date</label></th>
                                <th class="center">
                                    <label class="control-label">Status</label>
                                        <!-- <select class="form-control input_search" name="select_verify" id="select_verify" data-column-index="4">
                                            <option value="">--SELECT--</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Sent to Verify</option>
                                            <option value="2">Verified</option> 
                                        </select> -->
                                </th>
                                <th class="center"><label class="control-label">Action</label></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- DataTable -->
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>




<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">
<script src="<?php echo base_url('js/department/department.js'); ?>"></script>

<script>
   
    // Success Message
    function showSuccessMessage(text) {
        swal.fire({
            title: "Success !",
            text: text,
            icon: 'success',
            position: 'top',
            showConfirmButton: true,
            timer: 5000,
        });
        // location.reload();
    }

    // Error Message
    function showErrorMessage(text) {
        swal.fire({
            title: "Error!",
            text: text,
            icon: 'error',
            position: 'top',
            showConfirmButton: false,
            timer: 5000,
            showCancelButton: true
        });
    }

    // Warning Message
    function showWarningMessage(text) {
        swal.fire({
            // title: "Error!",
            text: text,
            icon: 'warning',
            position: 'top',
            showConfirmButton: false,
            timer: 5000,
            showCancelButton: true
        });
    }







// Datatable


    $(document).ready(function() {


        $('#select_service, #select_meeting, #select_verify').change(function(){
            var select_service = $('#select_service').val();
            var select_meeting = $('#select_meeting').val();
            var select_verify = $('#select_verify').val();
            $('#dataTableDeptByDist').DataTable().destroy();

            load_data_cab_case_list(select_service,select_meeting,select_verify);
    
        });

        load_data_cab_case_list();


        //Load Datatable Pending Cases List by 
        function load_data_cab_case_list(select_service,select_meeting,select_verify) {
            $('#dataTableDeptByDist thead th:nth-of-type(1)').each(function() {
                var title = $(this).text();
                $(this).html(title + ' <input type="text" class="form-control input_search form-control-sm" placeholder="----------  search ' + title + '------------" />');
            });

            // $('#dataTableDeptByDist thead th:nth-of-type(4)').each(function() {
            //     var title = $(this).text();
            //     $(this).html(title + ' <input type="text" class="form-control input_search form-control-sm" placeholder="----------  search ' + title + '------------" />');
            // });

            var base_url = "<?php echo base_url(); ?>";
            var district_id = $("#selectDistrict").val();
            var table = $('#dataTableDeptByDist').DataTable({
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
                    url: BASE_URL+'index.php/OfflineSettlement/getAllCasesUnderAssistant',
                    type: 'POST',
                    data: {
                        selectDistrict: district_id,
                        selectService: select_service,
                        selectMeeting: select_meeting,
                        selectVerify: select_verify,
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

        }


        $('.search_button').on('click', function() {
            $('table thead tr th .input_search').each(function() {
                $(this).val('');
            });
            $('#dataTableDeptByDist').DataTable().destroy();
            load_data_cab_case_list();
        });
    });

</script>
