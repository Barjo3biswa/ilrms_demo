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
        background: linear-gradient(to right, #00F260, #0575E6);
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
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="case_list_div">
    </div>
</div>

<!-- Modal for generate Proposal List -->
<div class="modal" role="dialog" id="generateProposalListModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
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
                <button type="button" class="btn btn-secondary btn-sm" id="proposalListModalClose">NO</button>
                <button type="button" class="btn btn-primary btn-sm" id="confirmGenerateProposalList">Confirm Generate</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for generate Proposal List -->

<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">

<script>

    var baseurl = "<?php echo base_url(); ?>";

    $(document).on('click', '#proposalListModalClose', function () {
        $('#generateProposalListModal').modal('hide');
    });
    // Declare selectedList variable globally
    var selectedList = [];

    $(document).ready(function() {

        // Function to load conversion cases
        const loadConversionProposalCases = () => {
        $.blockUI({
            message: $('#displayBox'),
            css: {
                border: 'none',
                backgroundColor: 'transparent'
            }
        });
        $.ajax({
            url: baseurl + "DeptConversion/viewConversionProposalCases",
            type: "POST",
            error: function() {
                $.unblockUI();
                Swal.fire({
                    title: "Failed",
                    text: "Error",
                    icon: "warning",
                    timer: 5000
                });
            },
            success: function(data) {
                $.unblockUI();
                $("#case_list_div").html(data);
            }
        });
    };
    loadConversionProposalCases();


    $(document).on('click', '#addCasesToGenerateProposal', function() {
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

        $('#generateProposalListModal .modal-title').text('Generate Proposal List (Total Selected Cases: ' + selectedList.length + ')');
        $('#generateProposalListModal').modal('show');
    } else {
        showWarningMessage("Please Select Case Generate Proposal List ");
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
                $('#generateProposalListModal .modal-title').text('Generate Proposal List (Total Selected Cases: ' + totalCases + ')');
            });
        }, 500); // Duration of the shake animation
    });

    // Handle confirm add cases to memo button click
    $(document).on('click', '#confirmGenerateProposalList', function() {

        if (selectedList.length > 0) {
            const applicant = {
                selectedList: selectedList
            };
            console.log(applicant);

            $.ajax({
                url: baseurl + "DeptConversion/generateProposalListFromCases",
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

    });

</script>