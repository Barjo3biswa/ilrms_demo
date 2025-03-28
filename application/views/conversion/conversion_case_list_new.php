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
                <span>Pending Case List for <span class="text-danger"><?php echo $dist_name?></span>
                </span>
            </div>
            <div class="col-lg-12 " align="right">
                <div class="table-responsive">
                    <input type="hidden" name="dist_code" id="dist_code" value="<?=$dist_code?>">
                    <table class="datatable table table-stripped" id='datatableConversionCaseList'>
                        <thead >
                            <tr>
                                <th class="center text-white" width="5%">All <input type="checkbox" class="checkBoxD " value="all" id="checkedAll"> </th>
                                <th class="text-white" width="20%">Case No</th>
                                <th class="text-white" width="20%">Location</th>
                                <!-- <th class="text-white" width="15%">JS Verify</th> -->
                                <!-- <th class="text-white" width="15%">SO Verify</th> -->
                                <th class="text-white" width="15%">ASO Verify</th>
                                <!-- <th class="text-white" width="15%">Sec Verify</th> -->
                                <!-- <th class="text-white" width="15%">PS Verify</th> -->
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
                    <button class="rezaButt buttInfo" id="markAddCasesBtn">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        Add to Cab Memo
                    </button>

                    <!-- <button class="rezaButt buttdanger" id="bulkRevertToDcModalOpen">
                        <i class="fa fa-undo" aria-hidden="true"></i>
                        Revert To DC
                    </button> -->

                    <!-- <button class="rezaButt buttsuccess" id="sentForVerification">
                        <i class="fa fa-forward" aria-hidden="true"></i>
                        Sent for SO verification
                    </button> -->
                    <button class="rezaButt buttsuccess" id="bulkSentForVerification_to_aso">
                        <i class="fa fa-forward" aria-hidden="true"></i>
                        Sent for ASO verification
                    </button>

                    <!-- <button class="rezaButt buttInfo" id="addToProposal">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        Add for Proposal
                    </button> -->
                </div>
            </div>
        <hr style="margin-bottom: -5px">
    </div>
</div>

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
                                <?php if(!empty($assistant_list)){ ?>
                                    <?php foreach ($assistant_list as $ast) :  ?>
                                        <option value='<?php echo $ast->user_code; ?>'><?php echo $ast->name; ?>&nbsp;&nbsp;&nbsp;( Email Id: <?php echo $ast->email; ?> )(<?php echo $ast->designation; ?> )</option>
                                    <?php endforeach; 
                                }?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" id="closeModalSentVerification">NO</button>
                        <button type="button" class="btn btn-primary btn-sm" id="bulkSentForVerification_to_aso">Sent for verification</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for send cases to Assistant for Verification -->



<script>

    var baseurl = "<?php echo base_url(); ?>";

    load_conversion_datatable();

    function load_conversion_datatable()
    {
        $('#datatableConversionCaseList thead th:nth-of-type(2)').each(function () {
            var title = 'Case';
            $(this).html('<input type="text" class="input_search form-control form-control-sm" placeholder="Search ' + title + '" data-column-index="0" />');
        });

      var table = $('#datatableConversionCaseList').DataTable({
        'pageLength': 10,
        "processing": true,
        "serverSide": true,
        "ordering"  : false,
        "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        'language'  : {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                },
        'ajax':{
        url: baseurl + "DeptConversionNew/getPendingConversionCaseList",
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
                // 'render': function(data, type, row) {
                //     let text = row[0];
                //     const myArray = text.split("/");
                //     var arr = myArray[3];
                //     return '<input type="checkbox" class="checkBoxD selectMark" value=' + row[0] + ' id=' + arr + ' name="selectMark[]">';
                // }
                'render': function(data, type, row) {
                    let text = row[0];
                    const myArray = text.split("/");
                    var arr = myArray[3];

                    var disabledStatus = '';
                    if(row[6] == 'S')
                    {
                        disabledStatus = 'disabled';
                    }
                    return '<input type="checkbox" class="checkBoxD selectMark" value=' + row[0] + ' id=' + arr + ' name="selectMark[]" '+disabledStatus+'>';
                }
            }],
      });

     $('.search_button').on('click', function() {
            $('table thead tr th .input_search').each(function() {
                $(this).val('');
            });
            $('#datatableConversionCaseList').DataTable().destroy();
            load_conversion_datatable();
        });


        var selectedCheckBoxArray = [];
        $('#datatableConversionCaseList tbody').on('click', 'input[type="checkbox"]', function(e) {
            var checkBoxId = $(this).val();
            var rowIndex = $.inArray(checkBoxId, selectedCheckBoxArray);
            if (this.checked && rowIndex === -1) {
                selectedCheckBoxArray.push(checkBoxId);
            } else if (!this.checked && rowIndex !== -1) {
                selectedCheckBoxArray.splice(rowIndex, 1); // Remove it from the array.
            }
        });


        $("#datatableConversionCaseList").on('draw.dt', function() {
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


</script>