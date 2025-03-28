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

                <form action="<?php echo base_url(); ?>index.php/Basundhara/getCasesListByDistrict" method="post">
                    <div class="row" id="searchBox">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="selectDistrict">District</label>
                                <select class="form-select districtselect1 reset" aria-label="Default select example" name="selectDistrict" id="selectDistrict" required="">
                                    <option disabled="" selected="">Select District</option>
                                    <option value="10">ছিৰাং ( Chirang )</option>
                                    <option value="06">নলবাৰী ( Nalbari )</option>
                                    <option value="08">দৰং ( Darrang )</option>
                                    <option value="07">কামৰূপ ( Kamrup )</option>
                                    <option value="33">নগাওঁ ( Nagaon )</option>
                                    <option value="14">গোলাঘাট ( Golaghat )</option>
                                    <option value="01">কোকৰাঝাৰ (Kokrajhar)</option>
                                    <option value="02">ধুবুৰী ( Dhubri )</option>
                                    <option value="03">গোৱালপাৰা ( Goalpara )</option>
                                    <option value="05">বৰপেটা ( Barpeta )</option>
                                    <option value="13">বঙাইগাঁও ( Bongaigaon )</option>
                                    <option value="15">যোৰহাট ( Jorhat )</option>
                                    <option value="17">ডিব্ৰুগড় ( Dibrugarh )</option>
                                    <option value="21">করিমগঞ্জ ( Karimganj )</option>
                                    <option value="24">কামৰূপ মহানগৰ ( Kamrup Metro )</option>
                                    <option value="32">মৰিগাওঁ ( Morigaon )</option>
                                    <option value="36">হোজাই ( Hojai )</option>
                                    <option value="38">দক্ষিণ শালমাৰা ( South Salmara )</option>
                                    <option value="39">বজালী ( Bajali )</option>
                                    <option value="22">Hailakandi</option>
                                    <option value="23">Cachar</option>
                                    <option value="27">Udalguri</option>
                                    <option value="12">লক্ষীমপূৰ ( Lakhimpur )</option>
                                    <option value="16">শিৱসাগৰ ( Sibsagar )</option>
                                    <option value="18">তিনিচুকীয়া ( Tinsukia )</option>
                                    <option value="34">মাজুলী ( Majuli )</option>
                                    <option value="37">চৰাইদেউ ( Charaideo )</option>
                                    <option value="11">শোণিতপুৰ ( Sonitpur )</option>
                                    <option value="25">ধেমাজি ( Dhemaji )</option>
                                    <option value="35">বিশ্বনাথ ( Biswanath )</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="selectService">Service</label>
                                <select class="form-select" aria-label="Default select example" name="selectService" id="">
                                    <option selected disabled>Select Service</option>
                                    <option value="<?= SETTLEMENT_AP_TRANSFER_ID ?>">
                                        Settlement AP Transfer
                                    </option>
                                    <option value="<?= SETTLEMENT_TRIBAL_COMMUNITY_ID ?>">
                                        Settlement of Tribal Community
                                    </option>
                                    <option value="<?= SETTLEMENT_KHAS_LAND_ID ?>">
                                        Settlement of Khas Land & Ceiling Surplus Land
                                    </option>
                                    <option value="<?= SETTLEMENT_PGR_VGR_LAND_ID ?>">
                                        Settlement of PGR VGR Land
                                    </option>
                                    <option value="<?= SETTLEMENT_SPECIAL_CULTIVATORS_ID ?>">
                                        Settlement of Special Cultivators
                                    </option>
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
                            <?php if ($casesCount != 0) : ?>
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
                <?php if ($casesCount == 0) : ?>
                    <div style="margin-top: 15px" id="searchText">No Data Found !</div>
                <?php else : ?>
                    <table class='table table-striped table-bordered' id='dataTable' width="100%">
                        <thead>
                            <tr>
                                <!-- <th>All <input type="checkbox" class="checkBoxD " value="all" id="checkedAll"> </th> -->
                                <th class="center"><label class="control-label">SL No.</th>
                                <th class="center"><label class="control-label">Case No</label></th>
                                <th class="center"><label class="control-label">Proposal No</label></th>
                                <th class="center"><label class="control-label">Submission Date</label></th>
                                <!-- <th class="center"><label class="control-label">Dept Approval</label></th> -->
                                <th class="center"><label class="control-label">Action</label></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 0;
                            foreach ($cases as $case) :  $i++ ?>
                                <tr>
                                    <!-- <td class="text-center">
                                        <input type="checkbox" class="checkBoxD selectMark" value="<?php echo $case->case_no; ?>" id="" name="selectMark[]">
                                    </td> -->
                                    <td class="text-center"><?php echo $i ?> </td>
                                    <td>
                                        <span class="case-no-bg"><i class='fa fa-archive'></i>
                                            <?php echo $case->case_no; ?>
                                        </span>
                                        <br>
                                        <small class='text-danger text-center p-4'><?= $application_no = $this->utilclass->getApplidFromCaseNo($dist_code, $case->case_no) ?></small>
                                    </td>
                                    <td>
                                        <span class="text-black bg-success"><?= $this->utilclass->getProposalNameByProposalId($dist_code, $case->proposal_id) ?></span>
                                        <br>
                                        <small class='text-danger text-center p-4'>Meeting: <?= $case->meeting_name ?></small>
                                    </td>
                                    <td class="text-center text-danger">
                                        <small><i class='fa fa-calendar'></i>
                                            <?php echo date('d-M-Y', strtotime($case->created_at)); ?></small>
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>index.php/Basundhara/settlementBasu/?app=<?php echo $application_no; ?>&dist_code=<?php echo $dist_code; ?>">
                                            <i class="fa fa-arrow-right"></i></i> Process
                                        </a>

                                        <!-- <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>index.php/Basundhara/checkListForAllotment/?app=<?php echo $application_no; ?>&dist_code=<?php echo $dist_code; ?>">
                                            <i class="fa fa-eye"></i>&nbsp;View Details
                                        </a> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>


                    <br>

                    <!-- <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12" align="left">
                            <button class="btn btn-success" id="bulkRecommendedByDepartment">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                Verify Selected Cases 
                            </button>
                        </div>
                    </div> -->
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>


<!-- Modal Mark and Bulk Recommended by Department -->
<div class="modal" role="dialog" id="bulkRecommendedModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-primary">
                <h6 class="modal-title text-center" id="exampleModalLongTitle">
                    Recommend for CAB Memo
                </h6>
            </div>

            <div class="modal-body">
                <div class="row">
                    <h4>Are You sure .?</h4>
                    <h6>Do You Really want to Recommend these case without Verify</h6>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="cabRecommendedModalNo" onclick="cabRecommendedResetModal()">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="markAndRecommendedWithoutVerify">Yes Recommend</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Mark and Bulk Recommended by Department End -->


<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">
<script src="<?php echo base_url('js/department/department.js'); ?>"></script>

<script>
    $(document).on('click', '#bulkRecommendedByDepartment', function() {
        $('#bulkRecommendedModal').modal('show');
    });

    function cabRecommendedResetModal() {
        $('#cabRecommendedModal').fadeOut('slow').modal('hide');
    }



    //Recommended without Verify

    $(document).on('click', '#markAndRecommendedWithoutVerify', function() {

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

            return;
            $.ajax({
                url: BASE_URL + "/Basundhara/recommendWithoutVerify",
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