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
                <span>Proposal Search by Service</span>
                <input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">

                <hr style="margin-bottom: -5px">

            </div>
            <div class="text-center">
                <p class="text-danger">( N.B: Please Select Service Type Before Proceed )</p>
            </div>

            <div class="reza-body">

                <form action="<?php echo base_url(); ?>index.php/Basundhara/getAllProposalListUnderSdlac" method="post">
                    <div class="row" id="searchBox">

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="serviceType">Service Type</label>
                                <select class="form-select" aria-label="Default select example" name="serviceType" id="serviceType" required>
                                    <option value="" selected disabled>----------------Select Service Type--------------</option>

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
                        <span>Proposal List Under SDLAC
                            <?php if ($proposalsCount != 0) : ?>

                                for Service: <span class="text-primary"><?= $this->utilclass->getServiceName($service_code) ?></span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12" align="right">

                    </div>
                </div>

                <hr style="margin-bottom: -5px">
            </div>

            <div class="reza-title">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                    </div>
                    <?php if ($proposalsCount != 0) : ?>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12" align="right">
                            <button class="rezaButt buttInfo" id="searchProId">
                                <i class="fa fa-search"></i> Search Proposal
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="reza-body" id="showBody">

                <?php if ($proposalsCount == 0) : ?>
                    <div style="margin-top: 15px" id="searchText">No Proposals Found !</div>
                <?php else : ?>
                    <table class='table table-striped table-bordered' id='dataTable' width="100%">
                        <thead>
                            <tr>
                                <th class="text-center"><label class="control-label">SL No.</th>
                                <th class="text-center"><label class="control-label">Proposal Name</label></th>
                                <th class="text-center"><label class="control-label">Hearing Date</label></th>
                                <!-- <th class="text-center"><label class="control-label">Time Passed</label></th> -->
                                <th class="text-center"><label class="control-label">SDLAC Action</label></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 0;
                            foreach ($proposals as $proposal) :  $i++ ?>
                            <?php
                            $now     = strtotime(date('Y-m-d H:i:s'));
                            $ExpTime = strtotime($proposal->expiry_hour_start_time);
                            $timeCheck = round(abs($now - $ExpTime) / 60 / 60, 2). " hour"; 
                             if($timeCheck < 48) : ?>
                                <tr>
                                    <td><?php echo $i ?> </td>
                                    <td>
                                        <strong><?php echo $proposal->proposal_name; ?></strong>       
                                    </td>
                                    <td class="center">
                                        <span class="text-danger"><i class='fa fa-calendar'></i> On <?php echo date('d-M-Y', strtotime($proposal->h_date)); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <input type="hidden" name="service_code" id="service_code" value="<?php echo $service_code; ?>">
                                        <button class="btn btn-success btn-sm agreeProposalbySdlac" value="<?php echo $proposal->proposal_no; ?>">
                                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                            Approve & Forward
                                        </button>
                                        <!-- <button class="btn btn-danger btn-sm refuseProposalbySdlac" value="<?php echo $proposal->proposal_no; ?>">
                                            <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                            Observation
                                        </button> -->

                                        <a class="btn btn-sm btn-dark" target="SDLACProposalNotice" href="<?php echo base_url(); ?>index.php/Basundhara/downloadCasesWithProposalId/?proposal=<?php echo $proposal->id; ?>"><i class='fa fa-file'></i> Download</a>

                                        <a class="btn btn-secondary btn-sm" target="_blank" href="<?php echo base_url(); ?>index.php/Basundhara/viewAllApplicationUnderProposalSdlac/?proposal=<?php echo $proposal->proposal_no; ?>&service_code=<?php echo $service_code; ?>">
                                            <i class="fa fa-eye"></i></i> View All Cases
                                        </a>

                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>

                        </tbody>

                    </table>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<!-- Proposal id search -->
<div class="modal" role="dialog" id="searchProIdModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Search Proposal No </h5>
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
<!-- Proposal Search ENd -->



<!-- Agree Proposal By SDLAC Modal-->
<div class="modal" role="dialog" id="agreeSdlacProposalModal">
    <div class="modal-dialog" role="document">
        <form action="" id="sdlac_agree_form">
            <div class="modal-content">
                <input type='hidden' value='' id='target_proposal_id'>
                <h2 class="modal-title text-center mt-2">Are you sure?</h2>
                <div class="modal-body">
                    <!-- <p class="text-center text-primary " style="font-size:150%;"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span id="proposal_no_agree_view"></span></p> -->
                    <p class="text-center text-danger" style="font-size:120%;">Do you really Agree on this Proposal? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" id="agreeSdlacProposalModalNo" onclick="agree_proposal_reset_modal()"><i class="fa fa-close" aria-hidden="true"></i> Close</button>
                    <button type="button" class="btn btn-primary" id="agreeProposalbySdlacYes">Submit <i class="fa fa-submit" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Agree Proposal By SDLAC Modal End-->


<!-- Refuse Proposal By SDLAC Modal-->
<div class="modal" role="dialog" id="refuseSdlacProposalModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" id="sdlac_refuse_form">
                <h2 class="modal-title text-center mt-2">Are you sure?</h2>
                <div class="modal-body">
                    <input type='hidden' value='' id='target_proposal_refused_id'>
                    <p class="text-center text-danger " style="font-size:150%;"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Proposal No : <span id="proposal_no_refuse_view"></span></p>
                    <p class="text-center text-danger" style="font-size:120%;">Do you really Refuse this Proposal? This process cannot be undone.</p>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group mt-2">
                            <label for="w3review" style="font-weight: bold">Enter Refuse Remarks</label>
                            <textarea class="form-control" name="sdlac_remarks" id="sdlac_remarks" rows="3" required minlength="1"> </textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" id="refuseSdlacProposalModalNo" onclick="refuse_proposal_reset_modal()"><i class="fa fa-close" aria-hidden="true"></i> Close</button>
                    <button type="button" class="btn btn-primary" id="refuseProposalbySdlacYes">Submit <i class="fa fa-submit" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Refuse Proposal By SDLAC Modal End-->


<!-- View Minutes Modal -->
<div class="modal fade" id="viewProposalMinutesSdlacModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">SDLAC Minutes</h4>
            </div>

            <div class="modal-body">
                Minutes Against Case
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- Minutes Modal End -->


<!-- Proposal ID Search End -->
<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">

<!-- SDLAC JS -->
<script src="<?php echo base_url('js/sdlac/sdlac.js'); ?>"></script>
