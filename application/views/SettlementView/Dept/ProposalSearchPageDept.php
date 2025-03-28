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
                <span>Proposal Search</span>

                <hr style="margin-bottom: -5px">

            </div>
            <div class="text-center">
                <p class="text-danger">( N.B: Please Select District Before Proceed )</p>
            </div>

            <div class="reza-body">

                <form action="<?php echo base_url(); ?>index.php/Basundhara/searchProposalWIthData" method="post">
                    <div class="row" id="searchBox">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="selectDistrict">District</label>
                                <select class="form-select districtselect1" aria-label="Default select example" name="selectDistrict" id="selectDistrict" required>
                                    <option disabled selected>Select District</option>
                                    <?php foreach ($user_dist as $dist) :  ?>
                                        <option value='<?php echo $dist->dist_code; ?>'><?= $this->utilclass->getDistrictNameOnLanding($dist->dist_code) ?></option>
                                    <?php endforeach; ?>
                                </select>
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
                        <span>Proposal List
                            <?php if ($proposalsCount != 0) : ?>

                                for District: <span class="text-primary"><?= $this->utilclass->getDistrictNameOnLanding($dist_code) ?></span> || Service: <span class="text-success"><?= $this->utilclass->getServiceName($service_code) ?></span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12" align="right">

                    </div>
                </div>

                <hr style="margin-bottom: -5px">
            </div>

            <?php if ($proposalsCount != 0) : ?>
                <div class="reza-title">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12" align="right">
                            <button class="rezaButt buttInfo" id="searchProId">
                                <i class="fa fa-search"></i> Search Proposal ID
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


            <div class="reza-body" id="showBody">

                <?php if ($proposalsCount == 0) : ?>
                    <div style="margin-top: 15px" id="searchText">No Data Found !</div>
                <?php else : ?>
                    <table class='table table-striped table-bordered' id='dataTable' width="100%">
                        <thead>
                            <tr>
                                <th class="center"><label class="control-label">SL No.</th>
                                <th class="center"><label class="control-label">Proposal No</label></th>
                                <th class="center"><label class="control-label">Hearing Date</label></th>
                                <th class="center"><label class="control-label">Created By</label></th>
                                <th class="center"><label class="control-label">Action</label></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 0;
                            foreach ($proposals as $proposal) :  $i++ ?>
                                <tr>
                                    <td><?php echo $i ?> </td>
                                    <td>
                                        <strong class="text-primary">Proposal No <?php echo $proposal->id; ?></strong>
                                    </td>
                                    <td class="center text-danger">
                                        <i class='fa fa-calendar'></i>
                                        on <?php echo date('d-m-Y', strtotime($proposal->h_date)); ?>
                                    </td>

                                    <td class="center">
                                        <i class='fa fa-user'></i>
                                        <?php echo $proposal->created_by; ?>
                                    </td>
                                    <td class="text-center">

                                        <a class="btn btn-primary btn-sm" target="_blank" href="<?php echo base_url(); ?>index.php/Basundhara/getAllApplicationUnderProposalDept/?proposal=<?php echo $proposal->id; ?>&dist_code=<?php echo $dist_code; ?>&service_code=<?php echo $service_code; ?>">
                                            <i class="fa fa-arrow-right"></i></i> View Case List
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<!-- Proposal id search -->
<div class="modal" role="dialog" id="searchProIdModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Search Proposal No by Case No. </h5>
            </div>
            <div class="modal-body" align="center">
                <form action="">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group" align="left">
                            <label for="w3review" style="font-weight: bold;color:darkslateblue">Search By Case No.</label>
                            <input class="form-control" type="hidden" name="" value="<?php echo $dist_code; ?>" id="districtId" />

                            <input class="form-control" name="" value="" id="caseId" placeholder=" KAM/PAL/2022-00/000/SKHAS" />
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group" align="center" style="margin-top: 15px">OR</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group" align="left">
                            <label for="w3review" style="font-weight: bold;color:darkslateblue">Search By RTPS Application No.</label>
                            <input class="form-control" name="" value="" id="applicationId" placeholder=" RTPS/SAPH/2022/0000" />
                        </div>
                    </div>
                    <div class="row" id="searchData">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group" align="center">
                            <hr>

                            <table class="" style="font-weight:bold; font-size: 18px">
                                <tbody id="caseTable">

                                </tbody>

                            </table>

                        </div>
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="searchProIdModalNo">Close</button>
                <button type="button" class="btn btn-primary" id="searchProIdModalYes">Search</button>
            </div>
        </div>
    </div>
</div>

<!-- Proposal ID Search End -->
<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">
<script src="<?php echo base_url('js/department/department.js'); ?>"></script>