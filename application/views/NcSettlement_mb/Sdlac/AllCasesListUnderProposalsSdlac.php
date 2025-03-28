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
        padding-bottom: 40px;
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

    .noticePadding {
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 20px
    }

    .reza-title-modal {
        font-weight: bold;
        font-size: 18px;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 20px;
        padding-bottom: 20px;
        color: #37474F;
    }
</style>
<div class="row" style='padding: 40px 50px 40px 20px'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">

        <div class="reza-card">
            <div class="reza-title">
                <span>List of Cases Under Proposal : <span class="text-primary"><?php echo $proposal_name; ?></span> &nbsp; :: &nbsp; Service: <span class="text-primary"><?= $this->utilclass->getServiceName($service_code) ?></span>
                    <hr>
                    <!-- <button class="btn btn-danger btn-sm float-right" onclick="history.back()"> <i class='fa fa-angle-double-left'></i> Back to Proposal List</button> -->

            </div>

            <div class="reza-body">

                <?php if ($pendingCaseCount == 0) : ?>
                    <div class="rezaText text-center">No Cases Found under Proposal : <?php echo $proposal_name; ?></div>
                <?php else : ?>

                    <input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">

                    <table class='table table-striped table-bordered' id='dataTable' width="100%">
                        <thead>
                            <tr>
                                <th>SL No.</th>
                                <th><label class="control-label">Case No</label></th>
                                <th><label class="control-label">Co Remark</label></th>
                                <th><label class="control-label">LM Remark</label></th>
                                <th class="center"><label class="control-label">Submission Date</label></th>
                                <th class="center"><label class="control-label">Status</label></th>
                                <th class="center"><label class="control-label">Action</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($cases as $case) :  $i++ ?>
                                <tr>

                                    <td style="width:5%"><?php echo $i ?> </td>
                                    <td>
                                        <strong class="case-no-bg"><i class='fa fa-archive'></i>
                                            <?php echo $case->case_no; ?>
                                        </strong>
                                        <br>
                                        <small class='text-danger text-center p-4'><?= $application_no = $this->utilclass->getApplidFromCaseNo($dist_code, $case->case_no) ?></small>
                                    </td>
                                    <td><?= $this->utilclass->getCoNoteAgainstCase($dist_code, $case->case_no) ?></td>
                                    <td><?= $this->utilclass->getLMNoteAgainstCase($dist_code, $case->case_no) ?></td>
                                    <td class="center"><i class='fa fa-calendar'></i> On <?php echo date('d-M-Y', strtotime($case->created_at)); ?></td>
                                    <td class="center">
                                        <i class="fa fa-spinner fa-pulse " aria-hidden="true"></i> &nbsp;Pending
                                    </td>

                                    <td>
                                        <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>index.php/Basundhara/settlementBasu/?app=<?php echo $application_no; ?>&dist_code=<?php echo $dist_code; ?>">
                                            <i class="fa fa-eye"></i></i> View Case Details
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>

                    <!-- Mark Approval/Revert Button -->
                    <br>

                    <!-- <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12" align="left">
                            <button class="btn btn-success" id="agreeProposalbySdlac">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                Agree
                            </button>

                            <button class="btn btn-danger" id="refuseProposalbySdlac">
                                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                DisAgree
                            </button>
                        </div>

                    </div> -->

                    <!-- Mark Approval/Revert Btn End -->

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>






<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>