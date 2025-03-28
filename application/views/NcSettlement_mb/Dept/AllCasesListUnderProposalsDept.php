<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->

<div class="row" style='padding: 40px 50px 40px 20px'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="reza-card">
            <div class="reza-title">
                <span>List of Cases Under : <span class="text-danger"><?= $this->utilclass->getProposalNameByProposalId($dist_code, $proposal_no) ?></span> || (District: <span class="text-primary"><?= $this->utilclass->getDistrictNameOnLanding($dist_code) ?></span>)
                    <hr>
            </div>

            <div class="reza-body">

                <?php if ($pendingCaseCount == 0) : ?>
                    <div class="rezaText text-center">No Cases Found under Proposal No: <?php echo $proposal_no; ?></div>


                <?php else : ?>

                    <input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">

                    <table class='table table-striped table-bordered' id='dataTable' width="100%">
                        <thead>
                            <tr>
                                <th>All <input type="checkbox" class="checkBoxD " value="all" id="checkedAll"> </th>
                                <th>SL No.</th>
                                <th><label class="control-label">Case No</label></th>
                                <th class="center"><label class="control-label">Submission Date</label></th>
                                <th class="center"><label class="control-label">Dept Approval</label></th>
                                <th class="center"><label class="control-label">Action</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($cases as $case) :  $i++ ?>
                                <tr>
                                    <td class="text-center">
                                        <?php if ($case->dept_approval == '') : ?>
                                            <input type="checkbox" class="checkBoxD selectMark" value="<?php echo $case->case_no; ?>" id="" name="selectMark[]">
                                        <?php endif; ?>
                                    </td>
                                    <td style="width:5%"><?php echo $i ?> </td>
                                    <td>
                                        <strong class="case-no-bg"><i class='fa fa-archive'></i>
                                            <?php echo $case->case_no; ?>
                                        </strong>
                                        <br>
                                        <small class='text-danger text-center p-4'><?= $application_no = $this->utilclass->getApplidFromCaseNo($dist_code, $case->case_no) ?></small>
                                    </td>
                                    <td class="center"><i class='fa fa-calendar'></i> Submitted On <?php echo date('d-m-Y', strtotime($case->created_at)); ?></td>
                                    <td class="center">
                                        <?php if ($case->dept_approval == DEPT_APPROVE_SETTLEMENT_BASIC) : ?>
                                            <span class="text-success"><i class='fa fa-check'></i> Approved</span>
                                        <?php elseif ($case->dept_approval == '') : ?>
                                            <span class="text-warning"><i class='fa fa-clock-o'></i> Pending</span>
                                        <?php elseif ($case->dept_approval == DEPT_REVERT_SETTLEMENT_BASIC) : ?>
                                            <span class="text-danger"><i class='fa fa-undo'></i> Revert to DC</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <!-- <a class="btn btn-info btn-sm" href="<?php echo base_url(); ?>index.php/Basundhara/settlementBasu/?app=<?php echo $application_no; ?>&dist_code=<?php echo $dist_code; ?>">
                                            <i class="fa fa-arrow-right"></i></i> View Details
                                        </a> -->


                                        <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>index.php/Basundhara/checkListForAllotment/?app=<?php echo $application_no; ?>&dist_code=<?php echo $dist_code; ?>">
                                            <i class="fa fa-eye"></i>&nbsp;View Details
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>


                    <!-- Mark Approval/Revert Button -->
                    <?php // if ($remainingCaseCount != 0) : 
                    ?>

                    <br>

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12" align="left">
                            <button class="btn btn-success" id="bulkApproveDepartment">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                Approve & Sent to CO
                            </button>

                            <button class="btn btn-danger" id="bulkRevertDepartment">
                                <i class="fa fa-undo" aria-hidden="true"></i>
                                Revert to DC
                            </button>
                        </div>

                    </div>
                    <?php // endif; 
                    ?>

                    <!-- Mark Approval/Revert Btn End -->

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>



<!-- Modal Mark and Bulk Approve by Department -->
<div class="modal" role="dialog" id="bulkApproveModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-success">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">
                    Applications to Be Approve by Department
                </h5>
            </div>
            <hr>
            <div class="modal-body">
                <form action="" id="dept_approval_form">
                    <div class="row">
                        <input type="hidden" class="form-control" name="proposal_id_approve" id="proposal_id_approve" value="<?php echo $proposal_no; ?>" required>
                        <input type="hidden" class="form-control" name="district_id_approve" id="district_id_approve" value="<?php echo $dist_code; ?>" required>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group mt-2">
                            <label for="w3review" style="font-weight: bold">Department Order No</label>
                            <input type="text" class="form-control" placeholder="Enter Order No..." name="dept_order_no" id="dept_order_no" required>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group mt-2">
                            <label for="w3review" style="font-weight: bold">Order Date</label>
                            <input type="date" class="form-control" name="dept_order_date" id="dept_order_date" required min="<?php echo date("Y-m-d"); ?>"> </input>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group mt-2">
                            <label for="w3review" style="font-weight: bold">Enter Remarks</label>
                            <textarea class="form-control" name="department_remarks_approve" id="department_remarks_approve" rows="4" required minlength="1"> </textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="bulkApproveModalNo" onclick="bulk_approval_reset_modal()">CLOSE</button>
                <button type="button" class="btn btn-primary" id="bulkApproveByDeptYes">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Mark and Bulk Approve by Department End -->






<!-- Modal Mark and Bulk Revert by Department -->
<div class="modal" role="dialog" id="bulkRevertModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-warning">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Applications to Be Revert by Department
                </h5>
            </div>
            <hr>
            <div class="modal-body">
                <form action="" id="dept_revert_form">
                    <div class="row">
                        <input type="hidden" class="form-control" name="proposal_id_revert" id="proposal_id_revert" value="<?php echo $proposal_no; ?>" required>
                        <input type="hidden" class="form-control" name="district_id_revert" id="district_id_revert" value="<?php echo $dist_code; ?>" required>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group mt-2">
                            <label for="w3review" style="font-weight: bold">Enter Remarks</label>
                            <textarea class="form-control" name="department_remarks_revert" id="department_remarks_revert" rows="4" required minlength="1"> </textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="bulkRevertModalNo" onclick="bulk_revert_reset_modal()">CLOSE</button>
                <button type="button" class="btn btn-primary" id="bulkRevertByDeptYes">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Mark and Bulk Revert by Department End -->
<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">

<!-- Department JS -->
<script src="<?php echo base_url('js/department/department.js'); ?>"></script>