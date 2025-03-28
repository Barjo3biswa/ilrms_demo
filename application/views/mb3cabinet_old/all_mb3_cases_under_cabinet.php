
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
</style>

<div class="row" style='padding: 40px 50px 40px 20px'>
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="reza-card">
            <div class="reza-title">
                <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <span class="text-primary">List of Cases Under Cab ID : <?php echo $memo_name; ?>&nbsp;(<?php echo $cab_id; ?>)
                          </span>
                      </div>
                </div>
                <hr style="margin-bottom: -5px">
            </div>

            <div class="reza-body" id="showBody">
                <input type="hidden" class=" " id="cab_id"  value="<?php echo $cab_id; ?>">
                <!-- DataTable -->
                    <table class='table table-striped table-bordered' id='dataTableDeptByCabId' width="100%">
                        <thead>
                            <tr>
                                <th class="center">All <input type="checkbox" class="checkBoxD " value="all" id="checkedAll"> </th>
                                <th class="center"><label class="control-label">Case No</label></th>

                                <th class="center"><label class="control-label">Date</label></th>
                                <th class="center">
                                    <label class="control-label">District</label>
                                    <select class="form-select input_search" aria-label="Default select example" name="select_district" id="select_district">
                                        <option value="">--Select District--</option>
                                            <?php foreach ($meetingList as $meeting) :  ?>
                                                <option value="<?= $meeting->dist_code; ?>"><?=$this->utilclass->getDistrictNameOnLanding($meeting->dist_code); ?>
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

                    <!-- <div class="row">
                        <div class="col-lg-4" align="center">
                            <button class="btn btn-danger" id="bulkRemoveCasesFromCabMemo">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                Remove from Cabinet Memo
                            </button>
                        </div>
                    </div> -->

            </div>
        </div>
    </div>
</div>



<!-- Modal for Remove Cases from CAB Memo -->
<!-- <div class="modal" role="dialog" id="bulkRemoveCasesModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-danger">
                <h6 class="modal-title text-center" id="exampleModalLongTitle">
                    Remove Cases from CAB Memo
                </h6>
            </div>

            <div class="modal-body">
                <div class="row">
                <div class="col-lg-12">
                </div>
                    <h4>Are You sure .?</h4> -->
                    <!-- <h6>Do You Really want to Remove these Cases From Cabinet Memo</h6>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="removeCasesModalClose">NO</button>
                <button type="button" class="btn btn-primary btn-sm" id="bulkRemoveCasesYes">Yes Remove</button>
            </div>
        </div>
    </div>
</div> -->
<!-- Modal for Removing Cases from Memo End -->


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
        $('select_district').change(function(){
            var select_district = $('#select_district').val();
            $('#dataTableDeptByCabId').DataTable().destroy();

            load_data_cab_case_list(select_district);
        });

        load_data_cab_case_list();

        //Load Datatable Pending Cases List by 
        function load_data_cab_case_list(select_district) {
            $('#dataTableDeptByCabId thead th:nth-of-type(2)').each(function() {
                var title = $(this).text();
                $(this).html(title + ' <input type="text" class="form-control input_search form-control-sm" placeholder="----------  search ' + title + '------------" />');
            });

            var base_url = "<?php echo base_url(); ?>";
            var cab_id = $("#cab_id").val();
            var table = $('#dataTableDeptByCabId').DataTable({
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
                    url: base_url+'index.php/DeptMb3Cabinet/getAllCasesUnderCabId',
                    type: 'POST',
                    data: {
                        CabId: cab_id,
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
            $('#dataTableDeptByCabId').DataTable().destroy();
            load_data_cab_case_list();
        });


        var selectedCheckBoxArray = [];
        $('#dataTableDeptByCabId tbody').on('click', 'input[type="checkbox"]', function(e) {
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

        $("#dataTableDeptByCabId").on('draw.dt', function() {
            for (var i = 0; i < selectedCheckBoxArray.length; i++) {
                checkboxId = selectedCheckBoxArray[i];
                const myArray = checkboxId.split("/");
                var arr = myArray[3];
                $('#' + arr).attr('checked', true);
            }
        });


    });




        $(document).on('click', '#bulkRemoveCasesYes', function() {

        var cabinet_id = $("#cab_id").val();
        var selectedList = [];


        $('.selectMark:checked').each(function(i) {
            selectedList[i] = $(this).val();
            });
            // return;
            if (selectedList.length > 0) {

            const applicant = {
                selectedList: selectedList,
                cabId: cabinet_id,
            };
            console.log(applicant);
            // return;
            $.ajax({
                url: BASE_URL + "/CabController/removeCasesFromCabMemo",
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

        } else {
            showWarningMessage("Please Select Case Before Removing from Cabinet Memo");
        }

    });
</script>
