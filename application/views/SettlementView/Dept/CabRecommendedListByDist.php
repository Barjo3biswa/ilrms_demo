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
<form action="<?php echo base_url(); ?>Basundhara/downloadRecommendedCaseReportByDist" method="post">

    <div class="row" style='padding: 40px 50px 40px 20px'>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="reza-card">
                <div class="reza-title">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <span class="text-danger">Cabinet Recommended List

                            </span>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12" align="right">
                        </div>
                    </div>
                    <hr style="margin-bottom: -5px">
                </div>
                <div class="row">
                    <table class='table table-striped table-bordered' id='dataTableCab' width="100%">
                        <thead>
                            <tr>
                                <th>All <input type="checkbox" class="checkBoxD " value="all" id="checkedAll"> </th>
                                <th class="center"><label class="control-label">SL No.</th>
                                <th class="center"><label class="control-label">District
                                        <select class="form-control input_search" aria-label="Default select example" name="selectDistrict" id="selectDistrict" required>
                                            <option disabled selected>Select District</option>
                                            <?php foreach ($user_dist as $dist) :  ?>
                                                <option value='<?php echo $dist->dist_code; ?>'><?= $this->utilclass->getDistrictNameOnLanding($dist->dist_code) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                </th>
                                <th class="center"><label class="control-label">Case No.</label></th>
                                <th class="center"><label class="control-label">Status.</label></th>
                                <th class="center"><label class="control-label">Created Date</label></th>
                                <th class="center"><label class="control-label">Action</label></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <center>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                <a class="btn btn-success btn-sm recommBtn" id="generateCabStackByDist">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    Mark and Prepare CAB Stack
                </a>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-file" aria-hidden="true"></i> Generate Report for Recommended Cases
                </button>
            </div>
        </div>
    </center>
</form>




</div>


<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">
<script src="<?php echo base_url('js/department/department.js'); ?>"></script>





<script>
    $(document).ready(function() {

        $('#dataTableCab').DataTable().destroy();
        load_data_cab_case_list();

        function load_data_cab_case_list() {
            // $('#dataTableCab thead th:nth-of-type(1)').each(function() {
            //     var title = $(this).text();
            //     $(this).html(title + ' <input type="text" class="form-control input_search form-control-sm" placeholder="---------------  Search ' + title + '----------------" />');
            // });

            var base_url = "<?php echo base_url(); ?>";
            var dist_code = $('#district_id').val();

            var table = $('#dataTableCab').DataTable({
                'pageLength': 20,
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
                    url: base_url + 'index.php/Basundhara/viewAllCabinetCaseList',
                    type: 'POST',
                    data: {
                        dist_code: dist_code,
                    },
                    deferLoading: 57,
                },
                order: [
                    [2, 'asc']
                ],
                // columnDefs: [{
                //     targets: "_all",
                //     orderable: false,
                //     "className": "dt-center",
                //     "targets": [0, 1, 2, 3, 4],
                // }]
                columnDefs: [{
                    targets: 0,
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

        }


        $('.search_button').on('click', function() {
            $('table thead tr th .input_search').each(function() {
                $(this).val('');
            });
            $('#dataTableCab').DataTable().destroy();
            load_data_cab_case_list();
        });


        var selectedCheckBoxArray = [];
        $('#dataTableCab tbody').on('click', 'input[type="checkbox"]', function(e) {
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

        $("#dataTableCab").on('draw.dt', function() {
            for (var i = 0; i < selectedCheckBoxArray.length; i++) {
                checkboxId = selectedCheckBoxArray[i];
                const myArray = checkboxId.split("/");
                var arr = myArray[3];
                $('#' + arr).attr('checked', true);
            }
        });
    });





    $(document).on('click', '#generateCabStackByDist', function() {

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
            console.log(applicant);

            $.ajax({
                url: BASE_URL + "/Basundhara/markAndPrepareCabStack",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    if (data.responseType == 1) {

                        showErrorMessage(data.message);
                    } else if (data.responseType == 2) {

                        showSuccessMessage(data.message);
                        location.reload();

                    } else if (data.responseType == 3) {

                        showWarningMessage(data.message);
                    } else {

                        showErrorMessage("List Not Generated.");
                    }
                },

                data: JSON.stringify(applicant)

            });

        } else {
            showWarningMessage("Please Select Case Before Generate Report");
        }

    });
</script>