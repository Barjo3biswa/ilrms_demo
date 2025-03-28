
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

    .table thead tr:first-child {
        background: #4B70F5;
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
</style>

<div class="row" style='padding: 40px 50px 40px 20px'>
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="reza-card">
            <div class="reza-title">
                <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <span class="text-primary">List of Cases Under Proposal-<?php echo $proposal_no; ?>
                          </span>
                      </div>
                </div>
                <hr style="margin-bottom: -5px">
            </div>

            <div class="reza-body" id="showBody">
                <input type="hidden" class="" id="proposal_id"  value="<?php echo $proposal_no; ?>">
                <!-- DataTable -->
                    <table class='table table-striped table-bordered' id='dataTableCasesListUnderProposal' width="100%">
                        <thead>
                            <tr>
                                <th class="center">All <input type="checkbox" class="checkBoxD " value="all" id="checkedAll"> </th>
                                <th class="center"><label class="control-label">Case No</label></th>

                                <th class="center"><label class="control-label">Date</label></th>
                                <th class="center">
                                    <label class="control-label">District</label>
                                        <select class="form-select input_search" aria-label="Default select example" name="select_district" id="select_district">
                                            <option value="">--Select District--</option>
                                                <?php foreach ($dist_list as $dist) :  ?>
                                                    <option value="<?= $dist->dist_code; ?>"><?=$this->utilclass->getDistrictNameOnLanding($dist->dist_code); ?>
                                            </option>
                                                <?php endforeach; ?>
                                        </select>
                                </th>
                                <th class="center"><label class="control-label">Action</label></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                <!-- DataTable -->
                <div class="row mt-3">
                    <div class="col-lg-12" align="left">
                        <button class="rezaButt buttInfo" id="">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Verify & Approve
                        </button>

                        <button class="rezaButt buttdanger" id="revertCasesProposal">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                            Revert from Proposal
                        </button>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


<!-- Modal for Revert Cases from Proposal -->
<div class="modal" role="dialog" id="proposalRevertModal" data-keyboard="false" data-backdrop="static">
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
                <button type="button" class="btn btn-primary btn-sm" id="confirmRevertCasesFromProposal">Yes Revert</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Revert Cases from Proposal -->



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


    $(document).on('click', '#bulkRemoveCasesFromCabMemo', function() {
        $('#bulkRemoveCasesModal').modal('show');
    });

    $(document).on('click', '#removeCasesModalClose', function () {
        $('#bulkRemoveCasesModal').modal('hide');
    });


    $(document).ready(function() {

        var baseurl = "<?php echo base_url(); ?>";

        var selectedList = [];
        $('select_district').change(function(){
            var select_district = $('#select_district').val();
            $('#dataTableCasesListUnderProposal').DataTable().destroy();

            load_data_cab_proposal_case_list(select_district);
        });

        load_data_cab_proposal_case_list();

        //Load Datatable Pending Cases List by 
        function load_data_cab_proposal_case_list(select_district) {
            $('#dataTableCasesListUnderProposal thead th:nth-of-type(2)').each(function() {
                var title = $(this).text();
                $(this).html(title + ' <input type="text" class="form-control input_search form-control-sm" placeholder="----------  search ' + title + '------------" />');
            });

            var base_url = "<?php echo base_url(); ?>";
            var proposal_id = $("#proposal_id").val();
            var select_district = $("#select_district").val();
            var table = $('#dataTableCasesListUnderProposal').DataTable({
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
                    url: base_url+'index.php/DeptConversion/getAllCasesUnderProposalId',
                    type: 'POST',
                    data: {
                        proposalId: proposal_id,
                        selectDistrict: select_district,
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
            $('#dataTableCasesListUnderProposal').DataTable().destroy();
            load_data_cab_proposal_case_list();
        });


        var selectedCheckBoxArray = [];
        $('#dataTableCasesListUnderProposal tbody').on('click', 'input[type="checkbox"]', function(e) {
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

        $("#dataTableCasesListUnderProposal").on('draw.dt', function() {
            for (var i = 0; i < selectedCheckBoxArray.length; i++) {
                checkboxId = selectedCheckBoxArray[i];
                const myArray = checkboxId.split("/");
                var arr = myArray[3];
                $('#' + arr).attr('checked', true);
            }
        });


        //////Revert Cases From Proposal List///
        $(document).on('click', '#revertCasesProposal', function() {
            selectedList = [];
            $('.selectMark:checked').each(function(i) {
                selectedList[i] = $(this).val();
            });
                // console.log(selectedList);return;
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

            $('#proposalRevertModal .modal-title').text('Revert from Proposal (Total Selected Cases: ' + selectedList.length + ')');
            $('#proposalRevertModal').modal('show');
            } else {
                showWarningMessage("Please Select Case Before Add to Proposal List");
            }
        });

        $(document).on('click', '#modalClose', function () {
            $('#proposalRevertModal').modal('hide');
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

    // Revert Cases From Proposal
    $(document).on('click', '#confirmRevertCasesFromProposal', function() {

        if (selectedList.length > 0) {
            const applicant = {
                selectedList: selectedList,
            };
            console.log(applicant);

            $.ajax({
                url: baseurl + "DeptConversion/revertConversionCasesFromProposal",
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
                                // $('#datatableConversionCaseList').DataTable().ajax.reload(null, false);
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


    });



</script>
