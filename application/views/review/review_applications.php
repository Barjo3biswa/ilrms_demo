<style>
    .table thead tr:first-child {
    /* background: linear-gradient(to right, #667db6, #0082c8, #0082c8, #667db6); */
    background: linear-gradient(to right, #0575E6, #1e3c72);
    }

    @keyframes highlight-row {
        from {
            background-color: transparent;
            transform: scale(1);
        }
        to {
            background-color: #BBD2C5;
            transform: scale(1.02);
        }
    }

    .highlighted-row {
        animation: highlight-row 0.5s forwards;
        background-color: #BBD2C5; 
        transform: scale(1.02);
    }

    small, .small {
    font-size: 0.75em;
    color: #2f3542; 
    }
</style>
<div class="reza-card">
    <div class="reza-title">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-2">
                <span>Pending application List for <span class="text-danger"><?php echo $dist_name?></span>
                </span>
            </div>
            <div class="col-lg-12 " align="right">
                <div class="table-responsive">
                    <input type="hidden" name="dist_code" id="dist_code" value="<?=$dist_code?>">
                    <table class="datatable table table-stripped" id='datatableReviewAppList'>
                        <thead >
                            <tr>
                                <th class="center text-white" width="5%">All <input type="checkbox" class="checkBoxD " value="all" id="checkedAll"> </th>
                                <th class="text-white" width="20%">Case No</th>
                                <th class="dc_remarks" width="20%">DC Remarks</th>
                                <th class="text-white" width="20%">Location</th>
                                <th class="text-white" width="10%">Sub. Date</th>
                                <th class="text-white" width="10%">Action 
                                </th> 
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12" align="left">
              <!--   <button class="rezaButt buttInfo" id="markAddCasesBtn">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Reject 
                </button> -->
                <button class="btn btn-primary" id="bulkapprovedReview">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    Approved Review Cases
                </button>
            </div>
        </div>
        <hr style="margin-bottom: -5px">
    </div>
</div>


<div class="modal" role="dialog" id="approveReviewCasesModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-primary">
                <h6 class="modal-title text-center" id="exampleModalLongTitle">
                    Approve/Reject Review Cases 
                </h6>
            </div>

            <div class="modal-body">
                
                <div class="row">
                    <div class="col-lg-4">
                       <b style="font-size:18px"><i class="fa fa-info-circle text-red"></i> Selected Applications</b>
                    </div>
                    <div class="col-lg-8">
                       <b style="font-size:18px"> <textarea class="form-control" readonly="" id="app_view" style="height: 180px;"></textarea></b>
                      
                    </div>
                </div>
                <div class="row" style="margin-top: 23px;">
           
                    <div class="col-lg-4">
                        <label for="" class="text-danger"><i class="fa fa-hand text-green"></i> DLR Remark</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="hidden" name="selectedCasesList" id="selectedCasesList">
                        <input type="hidden" name="selectDistrictModal" id="selectDistrictModal">
                        <div class="form-group">
                            <textarea class="form-control" name="dlr_remarks" id="dlr_remarks"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" id="closeapproveReviewCasesModal">NO</button>
                        <button type="button" class="btn btn-primary btn-sm" id="bulkApprovedByDLR">Approve applications</button>
                        <button type="button" class="btn btn-danger btn-sm" id="bulkRejectByDLR">Reject applications</button>
                    </div>
                </div>
      
    </div>
</div>




<script>
    $(document).on('click', '#closeapproveReviewCasesModal', function () {
        $('#approveReviewCasesModal').modal('hide');
    });

    var baseurl = "<?php echo base_url(); ?>";

    load_review_datatable();

    function load_review_datatable()
    {
        $('#datatableReviewAppList thead th:nth-of-type(2)').each(function () {
            var title = 'Case';
            $(this).html('<input type="text" class="input_search form-control form-control-sm" placeholder="Search ' + title + '" data-column-index="0" />');
        });

      var table = $('#datatableReviewAppList').DataTable({
        'pageLength': 10,
        "processing": true,
        "serverSide": true,
        "ordering"  : false,
        "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        'language'  : {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                },
        'ajax':{
        url: baseurl + "BasundharaReview/getPendingList",
          type:'POST',
          data: {
                    dist_code : $("#dist_code").val(),
                },
          deferLoading: 57,
        },
        order: [[2, 'asc']],
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
        $('.search_button').on('click', function() {
            $('table thead tr th .input_search').each(function() {
                $(this).val('');
            });
            $('#datatableReviewAppList').DataTable().destroy();
            load_review_datatable();
        });


        var selectedCheckBoxArray = [];
        $('#datatableReviewAppList tbody').on('click', 'input[type="checkbox"]', function(e) {
            var checkBoxId = $(this).val();
            var rowIndex = $.inArray(checkBoxId, selectedCheckBoxArray);
            if (this.checked && rowIndex === -1) {
                selectedCheckBoxArray.push(checkBoxId);
            } else if (!this.checked && rowIndex !== -1) {
                selectedCheckBoxArray.splice(rowIndex, 1); // Remove it from the array.
            }
        });


        $("#datatableReviewAppList").on('draw.dt', function() {
            for (var i = 0; i < selectedCheckBoxArray.length; i++) {
                checkboxId = selectedCheckBoxArray[i];
                const myArray = checkboxId.split("/");
                var arr = myArray[3];
                $('#' + arr).attr('checked', true);
            }
        });

        
    $("#checkedAll").click(function() {
        if (this.checked) {
            $('.selectMark').each(function() {
                this.checked = true;
                var id = $(this).val();
                if ($.inArray(id, selectedCheckBoxArray) === -1) {
                    selectedCheckBoxArray.push(id);
                }
                $(this).closest('tr').addClass('highlighted-row');
            });
        } else {
            $('.selectMark').each(function() {
                this.checked = false;
                var id = $(this).val();
                var rowIndex = $.inArray(id, selectedCheckBoxArray);
                if (rowIndex !== -1) {
                    selectedCheckBoxArray.splice(rowIndex, 1);
                }
                $(this).closest('tr').removeClass('highlighted-row');
            });
        }
    });

    $(document).on('change', '.selectMark', function() {
        var id = $(this).val();
        if (this.checked) {
            if ($.inArray(id, selectedCheckBoxArray) === -1) {
                selectedCheckBoxArray.push(id);
            }
            $(this).closest('tr').addClass('highlighted-row');
        } else {
            var rowIndex = $.inArray(id, selectedCheckBoxArray);
            if (rowIndex !== -1) {
                selectedCheckBoxArray.splice(rowIndex, 1);
            }
            $(this).closest('tr').removeClass('highlighted-row');
        }
    });
    }

    $(document).on('click', '#bulkapprovedReview', function() {

        var district_id = $("#selectDistrict").val();
        var selectedList = [];
        $('.selectMark:checked').each(function(i){
            selectedList[i] = $(this).val();
        });

        if (selectedList.length > 0)
        {
            $('#selectedCasesList').val(selectedList);
            $("#app_view").html(selectedList.toString());
            $('#selectDistrictModal').val(district_id);
            $('#approveReviewCasesModal').modal('show');
          
        } else {
            showWarningMessage("Please Select application before approval");
        }

    });

    $(document).on('click', '#bulkApprovedByDLR', function() {

        var district_id = $("#selectDistrictModal").val();
        var selectedList = $('#selectedCasesList').val();
        var selectAssistant = $('#selectAssistant').val();
        var dlr_remarks = $('#dlr_remarks').val();

            const applicant = {
                selectedList: selectedList,
                district_id: district_id,
                selectAssistant: selectAssistant,
                dlr_remark : dlr_remarks

                
            };
            console.log(applicant);

            // return;
            $.ajax({
                url: BASE_URL + "/BasundharaReview/bulkApprovedByDLR",
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

                        showErrorMessage("SOMETHING WENT WRONG");
                    }
                },

                data: JSON.stringify(applicant)

            });

    });

    $(document).on('click', '#bulkRejectByDLR', function() {

        var district_id = $("#selectDistrictModal").val();
        var selectedList = $('#selectedCasesList').val();
        var selectAssistant = $('#selectAssistant').val();
        var dlr_remarks = $('#dlr_remarks').val();

            const applicant = {
                selectedList: selectedList,
                district_id: district_id,
                selectAssistant: selectAssistant,
                dlr_remark : dlr_remarks
                
            };
            console.log(applicant);

            // return;
            $.ajax({
                url: BASE_URL + "/BasundharaReview/bulkRejectByDLR",
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

                        showErrorMessage("SOMETHING WENT WRONG");
                    }
                },

                data: JSON.stringify(applicant)

            });

    });


</script>