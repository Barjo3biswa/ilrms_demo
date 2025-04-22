<h5 class="bg-secondary p-2 text-white shadow mt-2 text-center">
    Department Verification
</h5>

<input type="hidden" id="caseNo" value="<?= $case_no ?>">
<input type="hidden" id="serviceCode" value="<?= $settlement_basic['service_code']; ?>">
<input type="hidden" id="distCodeCase" value="<?php echo $settlement_basic['dist_code']; ?>">

<div class="card anyClass">
    <div class="card-body proceedings">
        <h5 class="reza-title" style="margin-top: 15px">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Previous Remark
        </h5>
        <table class="table table-bordered">
            <tr class="bg-secondary" style="color:white; text-transform:uppercase">
                <th class="text-center">Date of Remark</th>
                <th class="text-center">Time of Remark</th>
                <th class="text-center">Remark from</th>
                <th class="text-center">Remarks</th>
            </tr>
            <?php $i = 1;
            $length = count($proceedings);
            foreach ($proceedings as $pro) : if ($i == 1) { ?>
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                            <?= date("d-M-Y", strtotime($pro->date_entry)) ?>
                        </td>
                        <td class="text-center">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                            <?= date("h:i a", strtotime($pro->date_entry)) ?>
                        </td>
                        <td class="text-center">
                            <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                            <?= $pro->office_from; ?>
                        </td>
                        <td class="text-center"><?= $pro->note_on_order; ?></span></td>
                    </tr>
            <?php }
                $i++;
            endforeach; ?>
        </table>

        <?php if(strtotime(HOLD_All_MB2_CASES_DATE) > strtotime(date('Y-m-d H:i:s'))) : ?>

        <?php
        if ((($this->session->userdata('designation') == ASSISTANT_USERCODE) || ($this->session->userdata('designation') == UNDER_SEC_USERCODE)) && ($settlement_basic['verified_by_asst'] == SENT_FORVERIFICATION)):
        ?>
            <div class="row mt-2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                    <a class="btn btn-primary  recommBtn" style="text-decoration: none;" id="verifyCaseByAsst">
                        <small><i class="fa fa-paper-plane" aria-hidden="true"></i> Verify & Forward Case</small>
                    </a>
                </div>
            </div>
        <?php endif;
        ?>

        <?php
        if (($this->session->userdata('designation') == DEPARTMENT_USERCODE) && ($settlement_basic['dept_approval'] == NULL) && ($settlement_basic['cab_memo_prepared'] == 0)  && ($settlement_basic['dept_revert'] == 0)  && ($settlement_basic['service_code'] != SETTLEMENT_PGR_VGR_LAND_ID)):
        ?>
            <div class="row mt-2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                    <a class="btn btn-danger  recommBtn" style="text-decoration: none;" id="revertToDC">
                        <small><i class="fa fa-undo" aria-hidden="true"></i> Revert To DC</small>
                    </a>
                </div>
            </div>
        <?php endif;
        ?>
        <?php endif; ?>


    </div>
</div>




<!-- Modal for Verification by Dept Assistant-->
<div class="modal" role="dialog" id="asstVerificationModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLongTitle">Verification remarks</h5>
            </div>
            <div class="modal-body" align="center">


                <div class="form-group">
                    <label>Remarks-----</label>
                    <textarea class="form-control" id="verification_remarks" name="verification_remarks"></textarea>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="asstVerificationModalNo">NO</button>
                <button type="button" class="btn btn-primary btn-sm" id="asstVerificationModalYes">YES</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Verification by Dept Assistant-->

<!-- Modal  Dept Revert to DC-->
<div class="modal" role="dialog" id="revertToDCModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
            </div>
            <div class="modal-body" align="center">
                <h4>Are You Sure !</h4>
                <br>
                <h5>You want to Revert This Case to DC  ?</h5>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group" style="margin-top: 15px" align="left">
                    <label for="w3review" style="font-weight: bold">Enter Your Remarks <span style="color: red; font-weight: bold; font-size: 18px">*</span></label>
                    <textarea class="form-control" name="w3review" id="revertRemarks" rows="4" required minlength="1"> </textarea>
                </div>
                <input type="hidden" id="distCode" value="<?php echo  $settlement_basic['dist_code']; ?>" readonly>
                <input type="hidden" id="caseNo" value="<?php echo $case_no ?>" readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="revertToDCModalNo">NO</button>
                <button type="button" class="btn btn-primary btn-sm" id="revertToDcModalYes">YES</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal  Dept Revert to DC-->

</div>


<script>
    $(document).on('click', '#verifyCaseByAsst', function() {
        $('#asstVerificationModal').modal('show');
    });

    $(document).on('click', '#revertToDC', function() {
        $('#revertToDCModal').modal('show');
    });


    $(document).on('click', '#asstVerificationModalNo', function () {
        $('#asstVerificationModal').modal('hide');
    });

    $(document).on('click', '#revertToDCModalNo', function () {
        $('#revertToDCModal').modal('hide');
    });


    $(document).on('click','#asstVerificationModalYes',function ()
    {
        if(!confirm("Are you sure? "))
        {
            return false;
        }

        if($('#verification_remarks').val() == null || $('#verification_remarks').val() == ''){
             showErrorMessage("Remarks is mandatory...");
             return false;
        }


        const applicant = {
            caseNo: $("#caseNo").val(),
            distCode: $("#distCodeCase").val(),
            serviceCode: $("#serviceCode").val(),
            verification_remarks : $('#verification_remarks').val()
        };
        console.log(applicant);
        // return;
        $.ajax({
            url: BASE_URL + "index.php/NcSettlement/verifyCaseByAssistant",
            type: "post",
            dataType: "json",
            contentType: "application/json",
            success: function (data) {
                $('#asstVerificationModal').modal('hide');
                if (data.responseType == 1)
                {
                    showErrorMessage(data.message);
                }
                else if (data.responseType == 2)
                {
                    $('.recommBtn').hide();
                    showSuccessMessage(data.message);
                }
                else if (data.responseType == 3)
                {
                    showErrorMessage("Data not found !");
                }
                else
                {
                    showErrorMessage("SOMETHING WENT WRONG");
                }
            },
            data: JSON.stringify(applicant)

        });


    });


    //Revert to DC
    $(document).on('click', '#revertToDcModalYes', function() {

        var distCode = $("#distCode").val();
        var caseNo = $("#caseNo").val();
        var revertRemarks = $("#revertRemarks").val();


        const applicant = {
            dist_code: distCode,
            case_no: caseNo,
            revert_remarks: revertRemarks,
            
        };
        console.log(applicant);

            // return;
            $.ajax({
                url: BASE_URL + "/NcSettlement/revertToDcByDeptBeforeCab",
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

    });
</script>