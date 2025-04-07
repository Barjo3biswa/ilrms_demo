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

    .form-control-1{
            font-size:14px;
        width:100%;

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
               <span>Pending NC Settlement Cases (Forwarded by DC)<span style="color:red;font-size: 14px;"> ( N.B: Please Select District Before Proceed )</span></span>
            </div>
            <div class="text-center">
                
            </div>

            <div class="reza-body">

                <form action="<?php echo base_url(); ?>index.php/NcSettlement/getAllCasesListByDept" method="post">
                    <div class="row" id="searchBox">
                        <div class="col-lg-6">
                            <div class="form-group">
                            
                                <select class="form-select districtselect1" aria-label="Default select example" name="selectDistrict" id="" required>
                                    <option disabled selected>Select District (Total Case)</option>
                                    <?php foreach ($user_dist as $dist) :  ?>
                                        <option value='<?php echo $dist->dist_code; ?>'><?= $this->utilclass->getDistrictNameOnLanding($dist->dist_code) ?> (<?=$dist->case_count;?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
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
                        <span style="color:#ff681d">Pending Case List
                            <?php if ($dist_code != NULL) : ?>
                                for District: <span class="text-primary"><?= $this->utilclass->getDistrictNameOnLanding($dist_code) ?></span>
                            <?php endif; ?>
                            <input type="hidden" value="<?php echo $dist_code ?>" id="selectDistrict">
                        </span>

                        <center id='show-Img' style="display: none;">
                            <img id="loading-image" style="" width="80px" src= "<?php echo base_url(); ?>assets/hourglass.gif" alt="Loading..." />
                            <h5 class="text-danger" >Please Wait .... ! </h5>
                            <span>Don't Refresh the page. ....</span>
                        </center>
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
                <div class="col-lg-12">

                    <table class='table table-striped table-bordered' id='dataTableDeptByDist' width="100%">
                        <thead>
                            <tr>
                                <th class="center">All <input type="checkbox" class="checkBoxD " value="all" id="checkedAll"> </th>
                                <th class="center"><label class="control-label">Case No</label></th>
                                <th class="center">
                                    <label class="control-label">Service</label>
                                <select class="form-control input_search" name="select_service" id="select_service" data-column-index="4">
                                    <option value="">--SELECT--</option>
                                    <option value="<?= NC_SETTLEMENT_KHAS_LAND_ID ?>">
                                        NC SETTLEMENT KHAS LAND
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
                                    <label class="control-label">Verification Status</label>
                                        <select class="form-control input_search" name="select_verify" id="select_verify" data-column-index="4">
                                            <option value="">--SELECT--</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Sent to Verify</option>
                                            <option value="2">Verified</option> 
                                    </select>
                                </th>
                                <th class="center">
                                    <label class="control-label">Modification Request</label>
                                        <select class="form-control input_search" name="select_pull_request" id="select_pull_request" data-column-index="4">
                                            <option value="">--SELECT--</option>
                                            <option value="0">No</option>
                                            <option value="1">Modification Required</option>
                                    </select>
                                </th>
                    
                                <th scope="col" class="center"><label class="control-label">Action</label>
                                    <button type="button" class="search_button btn btn-sm btn-danger form-control">
                                    <i class="fa fa-refresh"></i>
                                    Reset
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>

                    
                <div class="row">
                    <div class="col-lg-12" align="left">
                        <button class="btn btn-success" id="bulkRecommendedByDepartment">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Add Cases to Cabinet Memo
                        </button>

                        <button class="btn btn-primary" id="bulkSentForVerificationModalOpen">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            Sent For Verification
                        </button>

                        <!-- <button class="btn btn-danger" id="bulkRevertToDcModalOpen">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                            Revert Cases To DC
                        </button> -->

                        <button class="rezaButt buttdanger" id="bulkRevertJuridicalToDcModalOpen">
                        <i class="fa fa-undo" aria-hidden="true"></i>
                        Revert To DC
                    </button>
                    </div>
                </div>

                <?php endif; ?>
            </div>
        </div>
    </div>

</div>


<!-- Modal for Adding Cases to CAB Memo -->
<div class="modal" role="dialog" id="bulkRecommendedModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-primary">
                <h6 class="modal-title text-center" id="exampleModalLongTitle">
                    Add Cases To CAB Memo
                </h6>
            </div>

            <div class="modal-body">

                <div class="row">

                <div class="col-lg-12">
                <div class="form-group">

                    <strong class="text-danger">Cases Having Modification Request Can't be Added to CAB Memo</strong></br>

                    <label for="selectDistrict">Select Cabinet Memo</label>
                    <select class="form-select" aria-label="Default select example" name="selectCabMemo" id="cabinetMemo" required>
                        <option disabled selected>-------------Select Cab Memo----------------</option>
                            <?php foreach ($cabIdList as $cab) :  ?>
                                <option value='<?php echo $cab->cab_id; ?>'><?php echo $cab->cab_memo_name; ?>&nbsp;&nbsp;&nbsp;( Cab ID: <?php echo $cab->cab_id; ?> )</option>
                            <?php endforeach; ?>
                    </select>
                </div>
                </div>
                    <h6>Do You Really want to Add these Cases for Cabinet Memo</h6>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="verifyModalClose">NO</button>
                <button type="button" class="btn btn-primary btn-sm" id="markAndRecommendedWithoutVerify">Yes Add</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Adding CAB Memo End -->


<!-- Modal for Revert Cases to DC -->
<!-- <div class="modal" role="dialog" id="revertToDCModal" data-keyboard="false" data-backdrop="static">
    <form method="post" id="case_revert_to_dc_form">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white text-bold text-center bg-danger">
                        <h5 class="modal-title w-100">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                            REVERT CASES TO DC <br>
                            <input type="hidden" value="" id="distict_code_revert" name="distict_code_revert">
                            <input type="hidden" value="" id="no_of_rows_update_form" name="no_of_rows_update_form">
                        </h5>
                    </div>
                <span class="text-danger p-3"> <b>*** N.B:</b> Following Cases will Reverted to DC <b>***</b></span>
                <div class="modal-body " style="font-size:15px">
                    <div class="table table-responsive"  style="padding:0px!important">
                        <table class="table table-striped table-bordered " id="reverted_case_details_table"  >
                            <thead>
                                <tr>
                                    <td></td>
                                    <td width="40%">Case No</td>
                                    <td width="60%">Reverted Remarks (*** Remarks are Fetched from Assistant Remarks for Verified Cases ***)</td>
                                </tr>
                            </thead>
                            <tbody id="TextBoxContainerViewForm"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="revertToDCModalClose()">
                            <i class="fa-fa-close"></i>
                            Close
                        </button>
                    <button type="button" class="btn btn-primary" onclick="revert_cases_to_dc_submit()">Revert</button>
                </div>
            </div>
        </div>
    </form>
</div> -->
<!-- Modal for Revert Cases to DC -->

<!-- Modal for send cases to Assistant for Verification -->
<div class="modal" role="dialog" id="sentForVerificationModalOpen" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-primary">
                <h6 class="modal-title text-center" id="exampleModalLongTitle">
                    Choose assistant for verification of cases---------
                </h6>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="case_list"></div>
                <div class="col-lg-12">
                    <input type="hidden" name="selectedCasesList" id="selectedCasesList">
                    <input type="hidden" name="selectDistrictModal" id="selectDistrictModal">
                <div class="form-group">
                    <strong class="text-danger">List of Assistant / Secretary</strong></br>
                    <select class="form-select" aria-label="Default select example" name="selectAssistant" id="selectAssistant" required>
                        <option disabled selected>-------------Select Assistant/ Secretary----------------</option>
                        <?php if(!empty($ast_list)){ ?>
                            <?php foreach ($ast_list as $ast) :  ?>
                                <option value='<?php echo $ast->user_code; ?>'><?php echo $ast->name; ?>&nbsp;&nbsp;&nbsp;( Email Id: <?php echo $ast->email; ?> )(<?php echo $ast->designation; ?> )</option>
                            <?php endforeach; 
                        }?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="closeModalSentVerification">NO</button>
                <button type="button" class="btn btn-primary btn-sm" id="bulkSentForVerification">Sent for verification</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for send cases to Assistant for Verification -->

<!-- Modal for Revert Cases to DC -->
<div class="modal" role="dialog" id="revertToDCModal" data-keyboard="false" data-backdrop="static">
    <form method="post" id="case_revert_to_dc_form">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                        <h5 class="modal-title w-100">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                            Revert Case(s) to DC <br>
                            <input type="hidden" value="" id="distict_code_revert" name="distict_code_revert">
                            <input type="hidden" value="" id="no_of_rows_update_form" name="no_of_rows_update_form">
                            <input type="hidden" value="25" id="service_code" name="service_code">
                        </h5>
                </div>
                <div class="modal-body " style="font-size:15px">
                    <div class="form-group">
                        <label for="">Select Cabinet Memo</label>
                        <select class="form-select" aria-label="Default select example" name="cabMemoIdRevert" id="cabMemoIdRevert" required></select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="selectedCasesTable">Selected Cases</label>
                        <div style="height: 200px; overflow-y: auto;">
                            <table id="reverted_case_details_table" class="table table-striped">
                                <thead>
                                    <tr  class="bg-danger">
                                        <th width="20%">Case No</th>
                                        <th width="35%">Ast Remarks</th>
                                        <th width="45%">Reverted Remarks </th>
                                    </tr>
                                </thead>
                                <tbody id="TextBoxContainerViewForm">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="modalClose">
                            <i class="fa-fa-close"></i> Close</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmitRevert">Confirm Revert</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal for Revert Cases to DC -->


<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">
<script src="<?php echo base_url('js/department/department.js'); ?>"></script>

<script>
    $(document).on('click', '#bulkRecommendedByDepartment', function() {
        $('#bulkRecommendedModal').modal('show');
    });

    $(document).on('click', '#verifyModalClose', function () {
        $('#bulkRecommendedModal').modal('hide');
    });



    // Success Message
    function showSuccessMessage(text) {
        Swal.fire({
        backdrop:true,
        allowOutsideClick: false,
        text: data.message,
        confirmButtonText: 'OK',
        customClass: {
            actions: 'my-actions',
            confirmButton: 'order-2',
        }
        }).then((result) => {
            if (result.isConfirmed) {
            location.reload(true);
        }
        });
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

    //Recommended without Verify

    $(document).on('click', '#markAndRecommendedWithoutVerify', function() {

        var district_id = $("#selectDistrict").val();
        var cabinet_id = $("#cabinetMemo").val();
        var selectedList = [];

        var confirm_reveival = "1";

        $('.selectMark:checked').each(function(i) {
            selectedList[i] = $(this).val();
            });
            // return;
            if (selectedList.length > 0) {

            const applicant = {
                selectedList: selectedList,
                district_id: district_id,
                cabinet_id: cabinet_id,
            };
            console.log(applicant);
            $.ajax({
                url: BASE_URL + "/NcSettlement/addCasesToCabMemo",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    if (data.responseType == 1) {

                        showErrorMessage(data.message);
                    } else if (data.responseType == 2) {              
                        Swal.fire({
                        backdrop:true,
                        allowOutsideClick: false,
                        text: data.message,
                        confirmButtonText: 'OK',
                        customClass: {
                            actions: 'my-actions',
                            confirmButton: 'order-2',
                        }
                        }).then((result) => {
                            if (result.isConfirmed) {
                            location.reload(true);
                        }
                        });
                    }else if (data.responseType == 3) {
                        showWarningMessage(data.message);
                    }else if (data.responseType == 4) 
                    {
                        Swal.fire({
                        title: "Are you sure?",
                        // text: data.message,
                        html: data.message,
                        // icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Add to Cab Memo"
                        }).then((result) => {
                            if (result.isConfirmed) 
                            {
                                //call ajax on confirm
                                const applicant1 = 
                                {
                                    selectedList: selectedList,
                                    district_id: district_id,
                                    cabinet_id: cabinet_id,
                                    confirm_revival: confirm_reveival,
                                };

                                $.ajax({
                                    url: BASE_URL + "/NcSettlement/addCasesToCabMemo",
                                    type: "POST",
                                    dataType: "json",
                                    contentType: "application/json",
                                    success: function(data) {
                                        if (data.responseType == 1) {
                                            showErrorMessage(data.message);
                                        } else if (data.responseType == 2) {              
                                            Swal.fire({
                                            backdrop:true,
                                            allowOutsideClick: false,
                                            text: data.message,
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                actions: 'my-actions',
                                                confirmButton: 'order-2',
                                            }
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                location.reload(true);
                                            }
                                            });
                                        }else if (data.responseType == 3) {
                                            showWarningMessage(data.message);
                                        } else {
                                            showErrorMessage("List Not Generated.");
                                        }
                                    },

                                    data: JSON.stringify(applicant1)

                                });
                                //call ajax on confirm
                            }
                        });
                    } else {
                        showErrorMessage("List Not Generated.");
                    }
                },

                data: JSON.stringify(applicant)

            });

        } else {
            showWarningMessage("Please Select Case Before Adding to Cabinet Memo");
        }

    });





// Datatable


    $(document).ready(function() {


        $('#select_service, #select_meeting, #select_verify, #select_pull_request').change(function(){
            var select_service = $('#select_service').val();
            var select_meeting = $('#select_meeting').val();
            var select_verify = $('#select_verify').val();
            var select_pull_request = $('#select_pull_request').val();

            $('#dataTableDeptByDist').DataTable().destroy();

            load_data_cab_case_list(select_service,select_meeting,select_verify,select_pull_request);
    
        });

        load_data_cab_case_list();


        //Load Datatable Pending Cases List by 
        function load_data_cab_case_list(select_service,select_meeting,select_verify,select_pull_request) {
            $('#dataTableDeptByDist thead th:nth-of-type(2)').each(function() {
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
                    url: BASE_URL+'index.php/NcSettlement/getAllCasesUnderDept',
                    type: 'POST',
                    data: {
                        selectDistrict: district_id,
                        selectService: select_service,
                        selectMeeting: select_meeting,
                        selectVerify: select_verify,
                        selectPullRequest: select_pull_request,
                    },
                    deferLoading: 57,
                },
                order: [
                    [2, 'asc']
                ],

                columnDefs: [{
                    targets: 0,
                    orderable: false,
                    "className": "dt-center",
                    "targets": [0],
                    checkboxes: {
                        'selectRow': true
                    },
                    data: "is_visible",
                    'render': function(data, type, row) {
                        let text = row[0];
                        const myArray = text.split("/");
                        var arr = myArray[3];
                        return '<input type="checkbox" class="checkBoxD selectMark" value=' + row[0] + ' id=' + arr + ' name="selectMark[]">';
                    }
                }],
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


        var selectedCheckBoxArray = [];
        $('#dataTableDeptByDist tbody').on('click', 'input[type="checkbox"]', function(e) {
            var checkBoxId = $(this).val();
            var rowIndex = $.inArray(checkBoxId, selectedCheckBoxArray);
            if (this.checked && rowIndex === -1) {
                selectedCheckBoxArray.push(checkBoxId);
            } else if (!this.checked && rowIndex !== -1) {
                selectedCheckBoxArray.splice(rowIndex, 1); // Remove it from the array.
            }
        });


        $("#checkedAll").click(function() {
            if (this.checked) {
                $('.selectMark').each(function() {
                    this.checked = true;
                    var id = $(this).val();
                    if ($.inArray(id, selectedCheckBoxArray) !== -1) {
                        // $('.selectMark').prop('checked', false);
                    } else {
                        selectedCheckBoxArray.push(id);
                        $('.selectMark').prop('checked', true);
                    }
                })
            } else {
                $('.selectMark').each(function() {
                    this.checked = false;
                    var id = $(this).val();
                    var rowIndex = $.inArray(id, selectedCheckBoxArray);
                    if (rowIndex == -1) {

                    } else {
                        selectedCheckBoxArray.splice(rowIndex, 1);
                        $('.selectMark').prop('checked', false);
                    }
                })
            }
        });

        $("#dataTableDeptByDist").on('draw.dt', function() {
            for (var i = 0; i < selectedCheckBoxArray.length; i++) {
                checkboxId = selectedCheckBoxArray[i];
                const myArray = checkboxId.split("/");
                var arr = myArray[3];
                $('#' + arr).attr('checked', true);
            }
        });
    });




    $(document).on('click', '#bulkSentForVerification', function() {

        var district_id = $("#selectDistrictModal").val();
        var selectedList = $('#selectedCasesList').val();
        var selectAssistant = $('#selectAssistant').val();

            const applicant = {
                selectedList: selectedList,
                district_id: district_id,
                selectAssistant: selectAssistant
                
            };
            console.log(applicant);

            // return;
            $.ajax({
                url: BASE_URL + "/NcSettlement/bulkSentForVerification",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    if (data.responseType == 1) {

                        showErrorMessage(data.message);
                    } else if (data.responseType == 2) {

                        Swal.fire({
                        backdrop:true,
                        allowOutsideClick: false,
                        text: data.message,
                        confirmButtonText: 'OK',
                        customClass: {
                            actions: 'my-actions',
                            confirmButton: 'order-2',
                        }
                        }).then((result) => {
                            if (result.isConfirmed) {
                            location.reload(true);
                        }
                        });

                    } else if (data.responseType == 3) {

                        showWarningMessage(data.message);
                    } else {

                        showErrorMessage("List Not Generated.");
                    }
                },

                data: JSON.stringify(applicant)

            });

    });

    $(document).on('click', '#closeModalSentVerification', function () {
        $('#sentForVerificationModalOpen').modal('hide');
    });


    $(document).on('click', '#bulkSentForVerificationModalOpen', function() {

        var district_id = $("#selectDistrict").val();
        var selectedList = [];
        $('.selectMark:checked').each(function(i) {
            selectedList[i] = $(this).val();
        });

        if (selectedList.length > 0) {
            $('#selectedCasesList').val(selectedList);
            $('#selectDistrictModal').val(district_id);
            $('#sentForVerificationModalOpen').modal('show');
          
        } else {
            showWarningMessage("Please Select Case Before Sent for Verification");
        }

    });


    $(document).on('click', '#bulkRevertToDcModalOpen', function() {
        $('#show-Img').show();
        var district_id = $("#selectDistrict").val();
        var selectedList = [];
        $('.selectMark:checked').each(function(i) {
            selectedList[i] = $(this).val().split('@')[0];
        });

        if (selectedList.length > 0) {

             const applicant = {
                selectedList: selectedList,
                district_id: district_id,
            };
            console.log(applicant);

                $.ajax({
                url: BASE_URL + "/NcSettlement/getRemarksDetailsRevertedCases",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                success: function (data) {
                    $('#show-Img').hide();
                    $('#distict_code_revert').val(district_id);
                    $('#reverted_case_details_table tbody').empty();
                    for (let i = 0; i < data.reverted_case_list.length; i++) {
                        var div = $("<tr/>");
                        div.html(GetDynamicTextBoxForRevert(i));
                        $("#TextBoxContainerViewForm").append(div);
                        $('#service_code_revert_' + i).val(data.reverted_case_list[i].service_code);      
                        $('#view_case_no_' + i).val(data.reverted_case_list[i].case_no);      
                        $('#view_case_no1_' + i).text(data.reverted_case_list[i].case_no);      
                        $('#view_remark_'+i).val(data.reverted_case_list[i].verified_ast_remarks);       
                    }
                    const modal = $('#revertToDCModal').modal({
                        backdrop: 'static',
                        keyboard: false,
                    });
                    modal.fadeIn('slow').modal('show')
                },
                error: function (jqXHR, exception) {
                    alert('Could not Complete your Request ..!, Please Try Again later..!');
                },

                data: JSON.stringify(applicant)

            });
        } else {
            showWarningMessage("Please Select Case to Reverto DC");
        }

    });


    function revertToDCModalClose(){
        $('#revertToDCModal').fadeOut('slow').modal('hide');
        document.getElementById("case_revert_to_dc_form").reset();
    }

    function GetDynamicTextBoxForRevert(count) {
  
            var row =
            '<td style="padding:0px!important;border-color:white"><input id ="service_code_revert_' + count + '" readonly name="service_code_revert[]" type="hidden" class="form-control-1" /><input id ="view_case_no_' + count + '" readonly name="revert_case_no[]" type="hidden" class="form-control-1" /></td>'
            +'<td style="padding:0px!important;border-color:white"><strong class="text-danger" id ="view_case_no1_' + count + '" "></strong</td>'
            + '<td style="padding:0px!important"><textarea rows ="1" id ="view_remark_' + count + '" name="revert_remarks[]" type="text"  class="form-control-1 text-danger" placeholder="Please Enter Remarks for Revert"/></td>'
            return row;

    }


    function revert_cases_to_dc_submit() {
    event.preventDefault();
        var district_id = $("#distict_code_revert").val();
        var rowCount = $('#reverted_case_details_table tr').length - 1;
        $('#no_of_rows_update_form').val(rowCount);

        var formdata = $('#case_revert_to_dc_form').serialize();
        Swal.fire({
            title: 'Are you sure?',
            text: "Are you sure to Revert These Cases to DC!",
            icon: 'info',
            html: '<p class="text-danger">*** Once Reverted the Cases will not be available at Department End</p>',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Revert!',
        }).then((result) => {
            if (result.isConfirmed) {
                $('#revertToDCModal').hide();
                $('#show-Img').show();
                $.ajax({
                    url: BASE_URL + "/NcSettlement/bulkRevertCasesToDC",
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    success: function(data) {
                            $('#show-Img').hide();
                        if (data.responseType == 1) {
                            showErrorMessage(data.message);
                            $('#revertToDCModal').show();
                        } else if (data.responseType == 2) {
                            // showSuccessMessage(data.message);
                                Swal.fire({
                                    backdrop:true,
                                    allowOutsideClick: false,
                                    text: data.message,
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        actions: 'my-actions',
                                        confirmButton: 'order-2',
                                    }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                        location.reload(true);
                                    }
                                    });
                        } else if (data.responseType == 3) {
                            showWarningMessage(data.message);
                            $('#revertToDCModal').show();
                        } else {
                            showErrorMessage("SOMETHING WENT WRONG");
                        }
                    },
                    error: function() {
                        Swal.fire('Changes are not saved', '', 'warning')
                            $('#show-Img').hide();
                            $('#revertToDCModal').show();
                    },
                });
            }
        })
    }


    var baseurl = "<?php echo base_url(); ?>";

    $(document).on('click', '#bulkRevertJuridicalToDcModalOpen', function() {
        
        $('#show-Img').show();
        var district_id = $("#dist_code").val();
        var selectedList = [];
        $('.selectMark:checked').each(function(i) {
            selectedList[i] = $(this).val().split('@')[0];
        });

        if (selectedList.length > 0) {

             const applicant = {
                selectedList : selectedList,
                district_id  : district_id,
                service_code : '25',
            };
            // console.log(applicant);

            $.ajax({
              url: baseurl + "DeptRevertController/getRemarksDetailsRevertedCases",
              type: "POST",
              dataType: "json",
              contentType: "application/json",
              success: function (data) {

                $('#distict_code_revert').val(district_id);

                if(data.asstVerify != 0)
                {
                  showWarningMessage("Reverting to DC is not possible because the assistant verification for a few selected case(s) is still pending !!!");
                  return;
                }
                else
                {
                  var option = "<option>-- Select Cabinet Memo --</option>";
                  $.each(data.cabIdList, function (j, val)
                  {
                    option += "<option value='"+val["id"]+"'>"+ val["cab_memo_name"] + " ("+val["cab_id"] +")</option>";
                  });
                  $('#cabMemoIdRevert').html(option);


                  // console.log(data.revertedCases.reverted_case_list);


                  var tableData = '';
                  $.each(data.revertedCases.reverted_case_list, function (i, val)
                  {
                    count = i+1;
                    tableData +=
                      '<tr>'+
                        '<td>' + val["case_no"] + 
                        '<input id="view_case_no_' + count + '" readonly name="revert_case_no[]" type="hidden" class="form-control-1" value="'+ val["case_no"] +'" />'+
                        '</td>' +
                        '<td>' + val["ast_remarks"] + '</td>' +
                        '<td><textarea rows ="1" id ="view_remark_'+ count +'" name="revert_remarks[]" type="text"  class="form-control text-danger" placeholder="Please Enter Remarks for Revert"/></td>' +
                      '</tr>'
                  });
                  $('#TextBoxContainerViewForm').html(tableData);
                  const modal = $('#revertToDCModal').modal({
                    backdrop: 'static',
                    keyboard: false,
                  });
                  modal.fadeIn('slow').modal('show')
                }
              },
              error: function (jqXHR, exception) {
                showWarningMessage('Could not Complete your Request ..!, Please Try Again later..!');
              },
              data: JSON.stringify(applicant)
          });
        } else {
          showWarningMessage("Please Select Case to Reverto DC");
        }
    });

    function revertToDCModalClose(){
        $('#revertToDCModal').fadeOut('slow').modal('hide');
    }


    $(document).on('click', '#confirmSubmitRevert', function(event) {
    event.preventDefault();
    var district_id = $("#distict_code_revert").val();
    var cabIdRevert = $("#cabMemoIdRevert").val();
    var rowCount    = $('#reverted_case_details_table tr').length - 1;
    $('#no_of_rows_update_form').val(rowCount);
    var service_code = $("#service_code").val();

    var formdata    = $('#case_revert_to_dc_form').serialize();

    Swal.fire({
        title : 'Are you sure?',
        text  : "Are you sure to Revert These Cases to DC!",
        icon  : 'info',
        html  : '<p class="text-danger">*** These Cases Will be Reverted Under Cab ID: ' + cabIdRevert + ' </p>',
        showCancelButton   : true,
        confirmButtonColor : '#3085d6',
        cancelButtonColor  : '#d33',
        confirmButtonText  : 'Yes, Revert!',
    }).then((result) => {
        if (result.isConfirmed) {
            $('#revertToDCModal').hide();
            $('#show-Img').show();
            $.ajax({
                url: baseurl + "DeptRevertController/bulkRevertDeptCasesToDC",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function(data) {
                    $('#show-Img').hide();
                    if (data.responseType == 1) {
                        showErrorMessage(data.message);
                        $('#revertToDCModal').show();
                    } else if (data.responseType == 2) {
                        Swal.fire({
                            backdrop: true,
                            allowOutsideClick: false,
                            text: data.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                actions: 'my-actions',
                                confirmButton: 'order-2',
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(true);
                            }
                        });
                    } else if (data.responseType == 3) {
                        showWarningMessage(data.message);
                        $('#revertToDCModal').show();
                    } else {
                        showErrorMessage("SOMETHING WENT WRONG");
                    }
                },
                error: function() {
                    Swal.fire('Changes are not saved', '', 'warning');
                    $('#show-Img').hide();
                    $('#revertToDCModal').show();
                },
            });
        }
    });
});

</script>
