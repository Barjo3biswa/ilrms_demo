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

    .scroll {
        width: 200px; height: 400px;
        overflow: hidden;
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

    .bg-primary {
        color: #FFF;
        background: linear-gradient(to right, #0575E6, #40739e);
    }

    .bg-success {
        color: #FFF;
        background: linear-gradient(to right, #00F260, #0575E6);
    }

    .bg-danger {
        color: #FFF;
        background: linear-gradient(to right, #F09819, #fc4a1a);
    }

    .text-gradient {
        color: #113f67;
        font-weight: bold;
    }

    .buttInfo {
        color: #FFF;
        background: linear-gradient(to right, #0575E6, #40739e);
    }

    .buttdanger {
        color: #FFF;
        background: linear-gradient(to right, #F09819, #fc4a1a);
    }

    .buttsuccess {
        color: #FFF;
        background: linear-gradient(to right, #00F260, #11998e);
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

    /* new CSS */

    @keyframes shake {
        0% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        50% { transform: translateX(5px); }
        75% { transform: translateX(-5px); }
        100% { transform: translateX(0); }
    }

    .remove-btn-animate {
        animation: shake 0.5s;
    }

</style>

<div class="row" style='padding: 40px 50px 40px 20px'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="reza-card">
            <div class="reza-title">
                <span>Occupancy Tenant Cases For MB 3.0 Services</span>
                <sapn class="text-danger">( N.B: Please Select District Before Proceed )</span>
                <hr style="margin-bottom: -5px">
            </div>
            <!-- <div class="text-center">
                <p class="text-danger">( N.B: Please Select District Before Proceed )</p>
            </div> -->

            <div class="reza-body">
                    <div class="row" id="searchBox">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="selectDistrict">District</label>
                                <!-- <select class="form-select districtselect1" aria-label="Default select example" name="selectDistrict" id="" required>
                                    <option disabled selected>Select District (Total Case)</option>
                                    <?php foreach ($user_dist as $dist) :  ?>
                                        <option value='<?php echo $dist->dist_code; ?>'><?= $this->utilclass->getDistrictNameOnLanding($dist->dist_code) ?> (<?=$dist->case_count;?>)</option>
                                    <?php endforeach; ?>
                                </select> -->
									<select class="form-control districtselect1 reset" name='dist_code' id="selectDistrict" required>
										<option disabled selected>Select District</option>
										<option value='10'>ছিৰাং ( Chirang )</option>
										<option value='06'>নলবাৰী ( Nalbari )</option>
										<option value='08'>দৰং ( Darrang )</option>
										<option value='07'>কামৰূপ ( Kamrup )</option>
										<option value='33'>নগাওঁ ( Nagaon )</option>
										<option value='14'>গোলাঘাট ( Golaghat )</option>
										<option value='01'>কোকৰাঝাৰ (Kokrajhar)</option>
										<option value='02'>ধুবুৰী ( Dhubri )</option>
										<option value='03'>গোৱালপাৰা ( Goalpara )</option>
										<option value='05'>বৰপেটা ( Barpeta )</option>
										<option value='13'>বঙাইগাঁও ( Bongaigaon )</option>
										<option value='15'>যোৰহাট ( Jorhat )</option>
										<option value='17'>ডিব্ৰুগড় ( Dibrugarh )</option>
										<option value='21'>করিমগঞ্জ ( Karimganj )</option>
										<option value='24'>কামৰূপ মহানগৰ ( Kamrup Metro )</option>
										<option value='32'>মৰিগাওঁ ( Morigaon )</option>
										<option value='36'>হোজাই ( Hojai )</option>
										<option value='38'>দক্ষিণ শালমাৰা ( South Salmara )</option>
										<option value='39'>বজালী ( Bajali )</option>
										<option value='22'>Hailakandi</option>
										<option value='23'>Cachar</option>
										<option value='27'>Udalguri</option>
										<option value='12'>লক্ষীমপূৰ ( Lakhimpur )</option>
										<option value='16'>শিৱসাগৰ ( Sibsagar )</option>
										<option value='18'>তিনিচুকীয়া ( Tinsukia )</option>
										<option value='34'>মাজুলী ( Majuli )</option>
										<option value='37'>চৰাইদেউ ( Charaideo )</option>
										<option value='11'>শোণিতপুৰ ( Sonitpur )</option>
										<option value='25'>ধেমাজি ( Dhemaji )</option>
										<option value='35'>বিশ্বনাথ ( Biswanath )</option>
									</select>
                            </div>
                        </div>
                    </div>


                    <div class="row" style="margin-top: 15px" align="right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<button type="submit" id="dist_select_btn_submit" class="rezaButt buttInfo" style="width: 200px"><i class="fa fa-search" aria-hidden="true"></i> View All Cases</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="case_list_div">
    </div>


</div>

<!-- Modal for Adding Cases to CAB Memo -->
<div class="modal" role="dialog" id="markAddCasesToMemoModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-center" id="exampleModalLongTitle"></h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="selectDistrict">Select Cabinet Memo</label>
                    <select class="form-select" aria-label="Default select example" name="selectCabMemo" id="cabinetMemo" required>
                    </select>
                </div>
                <div class="form-group">
                        <label for="selectedCasesTable">Selected Cases</label>
                        <div style="height: 200px; overflow-y: auto;">
                            <table id="selectedCasesTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Case No.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Selected cases will be displayed here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="modalClose">NO</button>
                <button type="button" class="btn btn-primary btn-sm" id="confirmAddCasesToMemo">Yes Add</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Adding CAB Memo End -->


<!-- Modal for sent case for Verification -->
<div class="modal" role="dialog" id="markVerificationModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-center" id="exampleModalLongTitle"></h5>
            </div>
            <div class="form-group">
                <select class="form-control mt-3 text-center" id="asst_id" name="asst_id">
                    <option value="0">-- Select Assistant --</option>
                    <?php foreach($assistant_list as $ast) { ?>
                        <option value="<?=$ast->user_code?>"><?=$ast->name.' ('.$ast->email.')'?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-body">
                <div class="form-group">
                        <label for="selectedCasesTable">Selected Cases</label>
                        <div style="height: 200px; overflow-y: auto;">
                            <table id="selectedCasesTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Case No.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <label for="enter_remarks_label">Enter Remarks</label>
                            <textarea class="form-control" type="text" id="verification_remarks" placeholder="Enter Remarks"name="verification_remarks"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="modalClose">NO</button>
                <!-- <button type="button" class="btn btn-primary btn-sm" id="confirmSentForVerificationSO">Yes Sent for Verification</button> -->
                <button type="button" class="btn btn-primary btn-sm" id="confirmSentForVerificationASO">Yes Sent for Verification</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for sent case for Verification End -->


<!-- Modal for add cases to proposals -->
<div class="modal" role="dialog" id="proposalListModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-center" id="exampleModalLongTitle"></h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                        <label for="selectedCasesTable">Selected Cases</label>
                        <div style="height: 200px; overflow-y: auto;">
                            <table id="selectedCasesTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Case No.</th>
                                        <!-- <th>So Verification.</th>
                                        <th>ASO Verification.</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="modalClose">NO</button>
                <button type="button" class="btn btn-primary btn-sm" id="confirmAddCasesToProposal">Add to Proposal List</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for add cases to proposals End-->



<!-- Modal for Revert Cases to DC -->
<div class="modal" role="dialog" id="revertToDCModal" data-keyboard="false" data-backdrop="static">
    <form method="post" id="case_revert_to_dc_form">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                        <h5 class="modal-title w-100">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                            REVERT CASES TO DC <br>
                            <input type="hidden" value="" id="distict_code_revert" name="distict_code_revert">
                            <input type="hidden" value="" id="no_of_rows_update_form" name="no_of_rows_update_form">
                        </h5>
                </div>
                <div class="modal-body " style="font-size:15px">
                    <div class="form-group">
                        <label for="">Select Cabinet Memo</label>
                        <select class="form-select" aria-label="Default select example" name="cabMemoIdRevert" id="cabMemoIdRevert" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectedCasesTable">Selected Cases</label>
                        <div style="height: 200px; overflow-y: auto;">
                            <table id="reverted_case_details_table" class="table table-striped">
                                <thead>
                                    <tr  class="bg-danger">
                                        <!-- <th></th> -->
                                        <th width="30%">Case No.</th>
                                        <th width="15%">Ast Verification.</th>
                                        <th width="55%">Reverted Remarks </th>
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
                            <i class="fa-fa-close"></i>
                            Close
                        </button>
                    <button type="button" class="btn btn-primary" id="confirmSubmitRevert" onclick="revert_cases_to_dc_submit()">Confirm Revert</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal for Revert Cases to DC -->


<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">




<script>

    var baseurl = "<?php echo base_url(); ?>";
    var verificationType = "<?php echo $verificationType; ?>";

    $('#dist_select_btn_submit').on('click', () => {
            var dist_code = $('.districtselect1').val();
            if (dist_code === null) {
                alert("Please Select District !!!");
                return;
            }
            $.blockUI({
                message: $('#displayBox'),
                css: {
                    border:'none',
                    backgroundColor:'transparent'
                }
            });
            $.ajax({
                url: baseurl + "DeptTenant/viewTenantCases" ,
                type: "POST",
                data : {dist_code : dist_code},
                error: function() {
                    $.unblockUI();
                    Swal.fire({
                        title: "Failed",
                        text: "Error",
                        icon: "warning",
                        timer: 50000
                    });
                },
                
                success: function(data) {
                    $.unblockUI();
                    $("#case_list_div").html(data); 
                }
            });
    });

    $(document).on('click', '#modalClose', function () {
        $('#markAddCasesToMemoModal').modal('hide');
        $('#markVerificationModal').modal('hide');
        $('#proposalListModal').modal('hide');
        $('#revertToDCModal').modal('hide');
    });
// Declare selectedList variable globally
var selectedList = [];

$(document).ready(function() {

    $(document).on('click', '#markAddCasesBtn', function() {
        var district_id = $("#selectDistrict").val();
        var service_code = '42';
        selectedList = [];
        $('.selectMark:checked').each(function(i) {
            selectedList[i] = $(this).val();
        });

        if (selectedList.length > 0) {
            $.ajax({
                // url: baseurl + "DeptConversion/getCabMemos",
                url: baseurl + "DeptMb3Cabinet/getCabMemos",
                type: 'POST',
                data: {
                    district_id: district_id,
                    service_code: service_code
                },
                dataType: 'json',
                success: function(data) {
                    var select = $('#cabinetMemo');
                    select.empty();
                    select.append('<option disabled selected>-------------Select MB 3.0 Cab Memo----------------</option>');
                    if (data.message) {
                        showWarningMessage(data.message);
                    } else {
                        $.each(data, function(index, cab) {
                            var option = $('<option></option>')
                                .attr('value', cab.cab_id)
                                .text(cab.cab_memo_name + ' ( Cab ID: ' + cab.cab_id + ' )' + ' ( Service: ' + cab.service_name + ' )');
                            select.append(option);
                        });

                        // Display the selected cases in the table within the modal
                        var selectedCasesTableBody = $('#selectedCasesTable tbody');
                        selectedCasesTableBody.empty();
                        $.each(selectedList, function(i, caseId) {
                            var row = $('<tr></tr>');
                            row.append($('<td></td>').html( (i + 1))); // Serial number with icon
                            row.append($('<td class="text-gradient"></td>').text(caseId));
                            row.append($('<td></td>').html(`
                                <button class="btn btn-danger btn-sm remove-case-btn">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>`));
                            selectedCasesTableBody.append(row);
                        });

                        // Update the modal header with the total number of selected cases
                        $('#markAddCasesToMemoModal .modal-title').text('Add Cases to Cabinet Memo (Total Selected Cases: ' + selectedList.length + ')');
                        $('#markAddCasesToMemoModal').modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                    showWarningMessage("An error occurred while loading the cabinet memos");
                }
            });
        } else {
            showWarningMessage("Please Select Case Before Add To Memo");
        }
    });


    // Handle remove case button click
    $(document).on('click', '.remove-case-btn', function() {
        var caseId = $(this).closest('tr').find('td:nth-child(2)').text();
        selectedList = selectedList.filter(function(id) {
            return id !== caseId;
        });

        var row = $(this).closest('tr');
        var removeBtn = $(this);

        // Add animation class to the remove button
        removeBtn.addClass('remove-btn-animate');

        // Wait for the animation to complete before sliding up the row
        setTimeout(function() {
            row.slideUp(300, function() {
                row.remove();

                // Update the serial numbers and the modal header
                $('#selectedCasesTable tbody tr').each(function(index) {
                    $(this).find('td:first').html('<i class="fas fa-file-alt"></i> ' + (index + 1));
                });

                // Update the modal header with the new total number of selected cases
                var totalCases = $('#selectedCasesTable tbody tr').length;
                $('#markAddCasesToMemoModal .modal-title').text('Add Cases to Cabinet Memo (Total Selected Cases: ' + totalCases + ')');
            });
        }, 500); // Duration of the shake animation
    });

    // Handle confirm add cases to memo button click
    $(document).on('click', '#confirmAddCasesToMemo', function() {
        var district_id = $("#selectDistrict").val();
        var cabinet_id = $("#cabinetMemo").val();

        if (selectedList.length > 0) {
            const applicant = {
                selectedList: selectedList,
                district_id: district_id,
                cabinet_id: cabinet_id,
            };
            console.log(applicant);

            $.ajax({
                url: baseurl + "DeptMb3Cabinet/addMb3CasesToCabMemo",
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
                        Swal.fire({
                            html: data.message,
                            icon: "warning",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
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



    ////////////////Sent for Verification/////////////
    $(document).on('click', '#sentForVerification', function() {
        var district_id = $("#selectDistrict").val();
        selectedList = [];
        $('.selectMark:checked').each(function(i) {
            selectedList[i] = $(this).val();
        });

        if (selectedList.length > 0) {
        var selectedCasesTableBody = $('#selectedCasesTable tbody');
        selectedCasesTableBody.empty();
        $.each(selectedList, function(i, caseId) {
            var row = $('<tr></tr>');
            row.append($('<td></td>').html((i + 1)));
            row.append($('<td class="text-gradient"></td>').text(caseId));
            row.append($('<td></td>').html(`
                <button class="btn btn-danger btn-sm remove-case-btn">
                    <i class="fas fa-trash-alt"></i> Remove
                </button>`));
            selectedCasesTableBody.append(row);
        });

        $('#markVerificationModal .modal-title').text('Cases for Verification (Total Selected Cases: ' + selectedList.length + ')');
        $('#markVerificationModal').modal('show');
    } else {
        showWarningMessage("Please Select Case Before Sent for Verification");
    }
});


    // Handle confirm Sent for verification to SO
    $(document).on('click', '#confirmSentForVerificationSO', function() {
        var district_id = $("#selectDistrict").val();
        var remarks = $("#verification_remarks").val();

        if (selectedList.length > 0) {
            const applicant = {
                selectedList: selectedList,
                district_id: district_id,
                verificationType: verificationType,
                remarks: remarks
            };
            console.log(applicant);

            $.ajax({
                url: baseurl + "DeptTenant/sentTeaGrantCasesForVerification",
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
                                // location.reload(true);
                                $('#datatableConversionCaseList').DataTable().ajax.reload(null, false);
                                $('#markVerificationModal').modal('hide');

                            }
                        });
                    } else if (data.responseType == 3) {
                        Swal.fire({
                            html: data.message,
                            icon: "warning",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        });
                    } else {
                        showErrorMessage("List Not Generated.");
                    }
                },
                data: JSON.stringify(applicant)
            });
        } else {
            showWarningMessage("Please Select Case Before Sent to Verification");
        }
    });



    ////////////////Add to Proposal list/////////////
    $(document).on('click', '#addToProposal', function() {
        var district_id = $("#selectDistrict").val();
        selectedList = [];
        $('.selectMark:checked').each(function(i) {
            selectedList[i] = $(this).val();
        });

        if (selectedList.length > 0) {
        var selectedCasesTableBody = $('#selectedCasesTable tbody');
        selectedCasesTableBody.empty();
        $.each(selectedList, function(i, caseId) {
            var row = $('<tr></tr>');
            row.append($('<td></td>').html((i + 1)));
            row.append($('<td class="text-gradient"></td>').text(caseId));
            row.append($('<td></td>').html(`
                <button class="btn btn-danger btn-sm remove-case-btn">
                    <i class="fas fa-trash-alt"></i> Remove
                </button>`));
            selectedCasesTableBody.append(row);
        });

        $('#proposalListModal .modal-title').text('Cases for Proposal (Total Selected Cases: ' + selectedList.length + ')');
        $('#proposalListModal').modal('show');
    } else {
        showWarningMessage("Please Select Case Before Add to Proposal List");
    }
});




    // Add Cases to Proposal Confirm
    $(document).on('click', '#confirmAddCasesToProposal', function() {
        var district_id = $("#selectDistrict").val();

        if (selectedList.length > 0) {
            const applicant = {
                selectedList: selectedList,
                district_id: district_id,
            };
            console.log(applicant);

            $.ajax({
                url: baseurl + "DeptTenant/addConversionCasesToProposal",
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
                                // location.reload(true);
                                $('#datatableConversionCaseList').DataTable().ajax.reload(null, false);
                                $('#proposalListModal').modal('hide');

                            }
                        });
                    } else if (data.responseType == 3) {
                        Swal.fire({
                            html: data.message,
                            icon: "warning",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        });
                    } else {
                        showErrorMessage("List Not Generated.");
                    }
                },
                data: JSON.stringify(applicant)
            });
        } else {
            showWarningMessage("Please Select Case Before Sent to Verification");
        }
    });


        ////////////////Revert Cases to DC//////////


        $(document).on('click', '#bulkRevertToDcModalOpen', function() {
    var district_id = $("#selectDistrict").val();
    var selectedList = [];
    $('.selectMark:checked').each(function(i) {
        selectedList[i] = $(this).val();
    });

    if (selectedList.length > 0) {
        const applicant = {
            selectedList: selectedList,
            district_id: district_id,
        };

        $.ajax({
            url: baseurl + "DeptTenant/getAstRemarksDetailsRevertedCases",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(applicant),
            success: function(data) {
                $('#show-Img').hide();
                if (data.responseType == 1) {
                    showErrorMessage(data.message);
                } else if (data.responseType == 2) {
                    $('#distict_code_revert').val(district_id);
                    $('#reverted_case_details_table tbody').empty();
                    for (let i = 0; i < data.reverted_case_list.length; i++) {
                        var div = $("<tr/>");
                        div.html(GetDynamicTextBoxForRevert(i, data.reverted_case_list[i].ast_verification));
                        $("#reverted_case_details_table tbody").append(div);   
                        $('#view_case_no_' + i).val(data.reverted_case_list[i].case_no);      
                        $('#view_case_no1_' + i).text(data.reverted_case_list[i].case_no);      
                        $('#view_remark_' + i).val(data.reverted_case_list[i].ast_remarks);       
                    }

                    // Populate the cabMemoIdRevert select box
                    $('#cabMemoIdRevert').empty();
                    $.each(data.cabMemoList, function(index, memo) {
                        $('#cabMemoIdRevert').append($('<option></option>').attr('value', memo.cab_id).text(memo.cab_memo_name));
                    });

                    const modal = $('#revertToDCModal').modal({
                        backdrop: 'static',
                        keyboard: false,
                    });
                    modal.fadeIn('slow').modal('show');
                } else if (data.responseType == 3) {
                    showWarningMessage(data.message);
                }
            },
            error: function (jqXHR, exception) {
                alert('Could not Complete your Request ..!, Please Try Again later..!');
            }
        });
    } else {
        showWarningMessage("Please Select Case to Revert to DC");
    }
});

function GetDynamicTextBoxForRevert(count, ast_verification) {
    var verificationStatus = '';
    switch (ast_verification) {
        case null:
            verificationStatus = '<span class="">Not Sent to Asst <i class="fa fa-clock-o"></i></span>';
            break;
        case 'S':
            verificationStatus = '<span class="text-danger">Pending <i class="fa fa-clock-o"></i></span>';
            break;
        case 'A':
            verificationStatus = '<span class="text-success">Approved <i class="fa fa-check-circle"></i></span>';
            break;
        case 'R':
            verificationStatus = '<span class="text-danger">Reverted <i class="fa fa-undo"></i></span>';
            break;
        default:
            verificationStatus = '<span class="text-danger">Unknown <i class="fa fa-clock-o"></i></span>';
            break;
    }

    var row = 
        '<td style="padding:0px!important;border-color:white">' +
        '<input id="view_case_no_' + count + '" readonly name="revert_case_no[]" type="hidden" class="form-control-1" />' +
        '</td>' +
        '<td>' +
        '<span class="text-gradient" id="view_case_no1_' + count + '"></span>' +
        '</td>' +
        '<td>' +
        '<span>' + verificationStatus + '</span>' +
        '</td>' +
        '<td style="padding:5px!important">' +
        '<textarea class="form-control" rows="1" id="view_remark_' + count + '" name="revert_remarks[]" class="form-control-1 text-danger" placeholder="Please Enter Remarks for Revert"></textarea>' +
        '</td>';
    return row;
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



});





//sent for aso veriftication fom js newly added himnxu

////////////////Sent for Verification/////////////
$(document).on('click', '#sentForASOVerification', function() {
        var district_id = $("#selectDistrict").val();
        selectedList = [];
        $('.selectMark:checked').each(function(i) {
            selectedList[i] = $(this).val();
        });

        if (selectedList.length > 0) {
        var selectedCasesTableBody = $('#selectedCasesTable tbody');
        selectedCasesTableBody.empty();
        $.each(selectedList, function(i, caseId) {
            var row = $('<tr></tr>');
            row.append($('<td></td>').html((i + 1)));
            row.append($('<td class="text-gradient"></td>').text(caseId));
            row.append($('<td></td>').html(`
                <button class="btn btn-danger btn-sm remove-case-btn">
                    <i class="fas fa-trash-alt"></i> Remove
                </button>`));
            selectedCasesTableBody.append(row);
        });

        $('#markVerificationModal .modal-title').text('Cases for Verification (Total Selected Cases: ' + selectedList.length + ')');
        $('#markVerificationModal').modal('show');
    } else {
        showWarningMessage("Please Select Case Before Sent for Verification");
    }
});

// Handle confirm Sent for verification to SO
$(document).on('click', '#confirmSentForVerificationASO', function() {
    var district_id = $("#selectDistrict").val();
    var remarks = $("#verification_remarks").val();
    var selectAssistant = $('#asst_id').val();

    if (selectedList.length > 0) {
        const applicant = {
            selectedList: selectedList,
            district_id: district_id,
            verificationType: verificationType,
            remarks: remarks,
            selectAssistant: selectAssistant,
        };
        console.log(applicant);

        $.ajax({
            url: baseurl + "DeptTenant/sentTenantCasesForVerification",
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
                            // location.reload(true);
                            $('#datatableTenantCaseList').DataTable().ajax.reload(null, false);
                            $('#markVerificationModal').modal('hide');

                        }
                    });
                } else if (data.responseType == 3) {
                    Swal.fire({
                        html: data.message,
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    });
                } else {
                    showErrorMessage("List Not Generated.");
                }
            },
            data: JSON.stringify(applicant)
        });
    } else {
        showWarningMessage("Please Select Case Before Sent to Verification");
    }
});

</script>