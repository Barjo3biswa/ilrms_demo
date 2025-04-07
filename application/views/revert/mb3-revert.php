<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
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
</style>

<div class="row" style='padding: 40px 50px 40px 20px'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="reza-card">
            <div class="text-center">
                <p class="text-danger">( N.B: Please Select District Before Proceed )</p>
            </div>

            <div class="reza-body">
                <div class="row" id="searchBox">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="selectDistrict">District</label>
                            <select class="form-select districtselect1" aria-label="Default select example" name="selectDistrict" id="dist_code_ip" required>
                                <option disabled selected>Select District (Total Case)</option>
                                <?php foreach ($user_dist as $dist) :  ?>
                                    <option value='<?php echo $dist->dist_code; ?>'><?= $this->utilclass->getDistrictNameOnLanding($dist->dist_code) ?> (<?= $dist->case_count; ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px" align="right">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="rezaButt buttInfo" style="width: 200px" id="loadRevertedList">
                            <i class="fa fa-search" aria-hidden="true"></i> Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="reza-card">
        <div class="reza-title">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-2">
                    <span>Reverted Case List for service: <?=$service_name?><span class="text-danger"></span>
                    </span>
                </div>
                <div class="col-lg-12 " align="right">
                    <div class="table-responsive">
                        <input type="hidden" name="dist_code" id="dist_code" value="">
                        <table class="datatable table table-stripped" id='datatableJuridicalCaseList'>
                            <thead>
                                <tr>
                                    <th class="center">All <input type="checkbox" class="checkBoxD " value="all" id="checkedAll"> </th>
                                    <th class="center"><label class="control-label">Case No</label></th>
                                    <th class="center"><label class="control-label">Pending With</label></th>
                                    <th class="center"><label class="control-label">Remarks</label></th>
                                    <th class="center"><label class="control-label">Date</label></th>
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
                </div>
            </div>
        </div>
    </div>
</div>



<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">
<input type="hidden" name="service_code" id="service_code" value="<?php echo $service_code; ?>">
<script src="<?php echo base_url('js/department/department.js'); ?>"></script>


<script>
    var baseurl = "<?php echo base_url(); ?>";

    $('#loadRevertedList').on('click', () => {
        $('#datatableJuridicalCaseList').DataTable().destroy();
        load_juridical_datatable();
    });

    var baseurl = "<?php echo base_url(); ?>";

    function load_juridical_datatable() {
        var dist_code = $('.districtselect1').val();
        var service_code = $("#service_code").val();
        $('#datatableJuridicalCaseList thead th:nth-of-type(2)').each(function() {
            var title = 'Case';
            $(this).html('<input type="text" class="input_search form-control form-control-sm" placeholder="Search ' + title + '" data-column-index="0" />');
        });

        var table = $('#datatableJuridicalCaseList').DataTable({
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
                url: baseurl + "Mb3RevertController/getAllRevertedCasesUnderDept",
                type: 'POST',
                data: {
                    dist_code: dist_code,
                    service_code: service_code,
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

                    var disabledStatus = '';
                    if (row[6] == 'S') {
                        disabledStatus = 'disabled';
                    }
                    return '<input type="checkbox" class="checkBoxD selectMark" value=' + row[0] + ' id=' + arr + ' name="selectMark[]" ' + disabledStatus + '>';
                }
            }],
        });

        $('.search_button').on('click', function() {
            $('table thead tr th .input_search').each(function() {
                $(this).val('');
            });
            $('#datatableJuridicalCaseList').DataTable().destroy();
            load_juridical_datatable();
        });


        var selectedCheckBoxArray = [];
        $('#datatableJuridicalCaseList tbody').on('click', 'input[type="checkbox"]', function(e) {
            var checkBoxId = $(this).val();
            var rowIndex = $.inArray(checkBoxId, selectedCheckBoxArray);
            if (this.checked && rowIndex === -1) {
                selectedCheckBoxArray.push(checkBoxId);
            } else if (!this.checked && rowIndex !== -1) {
                selectedCheckBoxArray.splice(rowIndex, 1); // Remove it from the array.
            }
        });


        $("#datatableJuridicalCaseList").on('draw.dt', function() {
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