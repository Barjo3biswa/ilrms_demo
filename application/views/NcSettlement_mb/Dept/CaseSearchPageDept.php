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
        /*box-shadow: 0 2px 5px 0 rgb(0 0 0 / 23%);*/
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
                <input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">

                <hr style="margin-bottom: -5px">

            </div>
            <div class="text-center">
                <p class="text-danger">( N.B: Please Select District Before Proceed )</p>
            </div>

            <div class="reza-body">

                <form action="<?php echo base_url(); ?>Basundhara/searchCasesWithData" method="post">
                    <div class="row" id="searchBox">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="selectDistrict">District</label>




<select class="form-select districtselect1 reset" aria-label="Default select example" name="selectDistrict" id="selectDistrict" required>
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


                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="selectCircle">Circle</label>
                                <select class="form-control circleselect1 reset" name='selectCircle'>
                                    <option value='0'>Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="caseNo">Case No</label>
                                <input type="text" class="form-control" name="caseNo" id="caseNo" placeholder="Eg: - KAM/PAL/2022-23/0000/SKHAS">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="applicationNo">Application No</label>
                                <input type="text" class="form-control" name="applicationNo" id="applicationNo" placeholder="Eg: - RTPS/SKCSL/2023/00000 ">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="serviceType">Service Type</label>
                                <select class="form-select" aria-label="Default select example" name="serviceType" id="serviceType">
                                    <option selected disabled>Select</option>
                                    <!-- <option value="<?= SETTLEMENT_TENANT_ID ?>">
                                        Settlement of Occupancy Tenant
                                    </option> -->
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

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="appStatus">Application Status</label>
                                <select class="form-select" aria-label="Default select example" name="appStatus" id="appStatus">
                                    <option selected disabled>Select</option>
                                    <option value="<?= MB_PENDING ?>">Pending </option>
                                    <option value="<?= MB_DISMISS ?>">Rejected</option>
                                    <option value="<?= MB_FINAL ?>">Approved</option>
                                    <option value="<?= MB_PAYMENT_REQUEST ?>">Payment Request</option>
                                    <option value="<?= MB_PAYMENT_RECEIVED ?>">Payment Received</option>
                                    <option value="<?= MB_UNDER_PROCESS_AFTER_PAYMENT ?>">Under Process After Payment</option>
                                    <option value="<?= MB_PAYMENT_NOTICE ?>">Payment Notice</option>
                                    <option value="<?= MB_REVERT ?>">Reverted</option>
                                    <option value="<?= MB_APPLICANT_NOTICE ?>">Applicant Notice</option>
                                    <option value="<?= MB_NOTICE_SERVED ?>">Notice Served</option>
                                    <option value="<?= MB_RE_REPORT ?>">Re Report </option>
                                    <option value="<?= MB_MARK_AS_SDLAC ?>">Mark As SDLAC </option>
                                    <option value="<?= MB_SEND_TO_SDLAC ?>">Send to SDLAC </option>
                                    <option value="<?= MB_ORDER_FOR_CHITHA_UPDATE ?>">Chitha Update</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="pendingOffice">Pending Officer</label>
                                <select class="form-select" aria-label="Default select example" name="pendingOffice" id="pendingOffice">
                                    <option selected disabled>Select</option>
                                    <option value="<?= MB_DEPUTY_COMM ?>">DC </option>
                                    <option value="<?= MB_CIRCLE_OFFICER ?>">CO </option>
                                    <option value="<?= MB_LOT_MONDOL ?>">LM </option>
                                    <option value="<?= MB_DEPARTMENT ?>">Department </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="fromDate">From Date</label>
                                <input type="date" class="form-control" name="fromDate" id="fromDate">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="toDate">To Date</label>
                                <input type="date" class="form-control" name="toDate" id="toDate">
                            </div>
                        </div>



                    </div>

                    <div class="row" style="margin-top: 15px" align="right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="rezaButt buttInfo" id="" style="width: 200px">
                                <i class="fa fa-search" aria-hidden="true"></i> Search
                                <?php echo $this->lang->line('caseSearch') ?>
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
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <small>Application List
                            <?php if ($casesCount != 0) : ?>
                                for Dist: <span class="text-primary"><?= $this->utilclass->getDistrictName($dist_code) ?></span>
                            <?php endif; ?>

                            <?php if ($serviceType != '') : ?>
                                , Service: <span class="text-primary"><?= $this->utilclass->getServiceName($serviceType) ?></span>
                            <?php endif; ?>

                        </small>
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
                                <th class="center"><label class="control-label">SL No.</th>
                                <th class="center"><label class="control-label">Case No</label></th>
                                <th class="center"><label class="control-label">Service Type</label></th>
                                <th class="center"><label class="control-label">District</label></th>
                                <th class="center"><label class="control-label">Submission Date</label></th>
                                <th class="center"><label class="control-label">Action</label></th>
                            </tr>
                        </thead>
                        <tbody id="caseTable">

                            <?php $i = 1;
                            foreach ($cases as $case) : ?>

                                <tr>
                                    <td><?= $i ?></td>
                                    <td width="30%"><strong><?= $case->case_no ?></strong><br>
                                        <small class="text-danger">(RTPS No :<?= $case->applid ?>)</small>
                                    </td>
                                    <td class="text-primary"><?= $this->utilclass->getServiceName($case->service_code) ?></td>

                                    <td><?= $this->utilclass->getDistrictNameOnLanding($case->dist_code) ?></td>
                                    <td>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <?= date("j F, Y", strtotime($case->submission_date)) ?>
                                    </td>
                                    <td>
                                        <a class="rezaButt" href="<?php echo base_url(); ?>index.php/Basundhara/settlementBasu/?app=<?php echo $case->applid; ?>&dist_code=<?= $case->dist_code ?>">
                                            <i class="fa fa-eye"></i>&nbsp;view
                                        </a>
                                    </td>
                                </tr>
                                <?php $i = $i + 1; ?>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">


<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    $("#selectDistrict").select2({
        placeholder: "Select a State",
        allowClear: true,
        closeOnSelect: false
    });
</script>


<script>
        var BASE_URL = $("#getBaseURL").val();

        $('.districtselect1').change(function (e) {
        var distCode = $(this).val();

            // alert(BASE_URL);

           $.ajax({

            url: BASE_URL + "Basundhara/getCirCodeJson/" + distCode,
            beforeSend: function () {
                $('.loader').addClass('trans');
                $('.loader').removeClass('hide');
            },
            success: function (data) {
                $('.loader').addClass('hide');
                $('.loader').removeClass('trans');
                var circode = JSON.parse(data);
                var template = "<option selected disabled>Select Circle</option>";
 
                for (var i = 0; i < circode.length; i++) {
                    template += "<option value='" + circode[i].cir_code + "'>" + circode[i].loc_name + "</option>";
                }
                $('.circleselect1').html(template);
               
            },
            error: function (jqXHR, exception) {
                $('.loader').addClass('hide');
                alert('Error : Could not load Circle..!');
            }
        });    
    });
</script>
