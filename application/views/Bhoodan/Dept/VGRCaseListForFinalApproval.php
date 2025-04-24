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
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }
    .reza-title{
        font-weight: bold;
        font-size: 18px;
        padding: 20px;
        color: #37474F;
    }
    .reza-body{
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 40px;
    }
    .badge{
        padding: 10px;
        font-size: 15px;
    }

    .buttInfo {
        color: #FFF;
        background-color: #03a9f4;
    }
    .buttPrimary {
        color: #FFF;
        background-color: #673AB7;
    }
    .rezaButt:hover {
        color: #0c0c0c;
    }
    .rezaButt{
        display: inline-block;
        position: relative;
        cursor: pointer;
        height: 35px;
        min-width: 150px;
        line-height: 35px;
        padding: 0 .8rem;
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
        margin-bottom: 15px;
        /*box-shadow: 0 2px 5px 0 rgb(0 0 0 / 23%);*/
    }
    .rezaText {
        font-size: 16px;
    }
    .noticePadding{
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 20px
    }
    .reza-title-modal{
        font-weight: bold;
        font-size: 18px;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 20px;
        padding-bottom: 20px;
        color: #37474F;
    }

    .buttPrimary {
        color: #FFF;
        background-color: #673AB7;
    }



</style>
<div class="row" style='padding: 40px 50px 40px 20px'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">

        



        <div class="reza-card">
            <div class="reza-title">
                <span class="text-success">List of PGR/VGR Cases For Final Approval Under Cab Memo: <?php echo $cab_id ?></span>
                <hr>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input type="hidden" id="cabinetIdSelected" value="<?php echo $cab_id ?>">
                    </div>
                </div>
            </div>

            <center id='show-Img' style="display: none;">
                <img id="loading-image" style="" width="80px" src= "<?php echo base_url(); ?>assets/hourglass.gif" alt="Loading..." />
                <h5 class="text-danger" >Please Wait .... ! </h5>
                <span>Don't Refresh the page. Final Approval is in Progress ....</span>
            </center>


            <div class="reza-body">

                <?php

                if ($finalCaseCount == 0) : ?>
                    <div class="rezaText"><?php echo $this->lang->line('zeroCase') ?></div>
                <?php else : ?>
                    <table class='table table-striped table-bordered tablesorter  pageshowpage unicode'   width="100%">
                        <thead>
                        <tr>
                            <th width="5%">SL No.</th>
                            <th width="25%">Case No</th>
                            <th width="15%" class="center"><label class="control-label">Meeting</th>
                            <th width="15%" class="center"><label class="control-label">District</label></th>
                            <th width="15%" class="center"><label class="control-label">Status</label></th>
                            <th width="15%" class="center"><label class="control-label">Action</label></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; foreach ($finalCases as $case):  $i++ ?>
                            <tr>
                                <td><?php echo $i ?> </td>
                                <td>
                                    <?php echo $case->case_no; ?><br>
                                    <small class='text-danger'><?php if ($case->case_no) {
                                            echo "Basundhara:" . $this->utilclass->getApplidFromCaseNo($case->dist_code,$case->case_no);
                                        } ?> 
                                    </small>
                                </td>
                                <td>
                                    <?php echo $this->utilclass->getMeetingNameByMeetingId($case->dist_code, $case->meeting_id); ?><br>
                                    <small class='text-primary'><?php if ($case->case_no) {
                                            echo "Proposal:" . $this->utilclass->getProposalName($case->dist_code, $case->proposal_id);;
                                        } ?> 
                                    </small>
                                </td>
                                <td><small  class="text-primary"><?php echo $this->utilclass->getDistrictNameOnLanding($case->dist_code); ?></small> </td>
                                <td class="center">
                                        <span style="color: #37474F">
                                            <i class="fa fa-spinner fa-pulse " aria-hidden="true"></i> &nbsp;Pending 
                                        </span>
                                </td>
                                <td>
                                    <small>
                                        <input type="hidden" value="<?php echo $case->case_no?>" id="case_no_<?=$case->id?>">
                                                <input type="radio" name="report_status_<?=$case->id?>" id="report_status_yes<?=$case->id?>" onclick="report_yes('<?=$case->dist_code?>','<?=$case->case_no?>')" value="1" checked>&nbsp;Approve
                                    </small>    
                                       
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                


                <br>
                <!-- Digital Sign Form Data -->
                <div class="row">
                <?php if($digitalSignedStatus ==0){ ?>
                    <div class="col-lg-6">
                            <!-- <button  class="btn btn-md btn-success" id="digitalSignNotification" onclick="digitalSignNotification('<?php echo $cab_id ?>')">
                                <i class="fas fa-file-signature" aria-hidden="true"></i>&nbsp;&nbsp;Sign Notification & Proceed
                            </button> -->

                            <button  class="btn btn-md btn-danger" id="digitalSignNotificationViewId" onclick="digitalSignNotificationViewVGR('<?php echo $cab_id ?>')">
                                <i class="fas fa-file-signature" aria-hidden="true"></i>&nbsp;&nbsp;Sign Notification
                            </button>
                    </div>
                    <?php }?>
                    <?php if($digitalSignedStatus ==1){ ?>
                    <div class="col-lg-6">
                            <button  class="btn btn-md btn-primary" id="finalSubmit" onclick="finalSubmit('<?php echo $cab_id ?>')">
                                <i class="fa fa-forward" aria-hidden="true"></i>&nbsp;&nbsp;Final Submit
                            </button>
                    </div>
                    <?php }?>
                </div>
                <br>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<div id="generateSignNotificationViewVGR"></div>






<!-- Modal for final submission -->
<div class="modal" role="dialog" id="finalSubmissionModal" data-backdrop="static" data-keyboard="false">
    <form method="post" id="final_submit_case_form" e>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Final Submission of Cases Under VGR Cab Memo <span id="cabinet_id_submit" class="text-primary"></span>
                    <input type="hidden" value="" id="caninet_id_selected" name="caninet_id_selected">
                </h5>
            </div>
            <div class="modal-body" align="center">

                <h4 class="text-primary">Total No of Cases For Final Approval: <span id="TotalNoCases" class="text-danger"></span></h4>
        

                <strong style="color: #F44336">This Process Can't be Reverted <br>
                </strong>
                <span class="text-danger">N.B:  After Final approval, these cases would be available for Payment Notice Under CO</span>
                <br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"  id="finalSubmitByDeptYes">Final Approve & Send for Payment Generation</button>
                <button type="button" class="btn btn-secondary"  id="finalSubmitByDeptNo">Close</button>
            </div>
        </div>
    </div>
    </form>
</div>







<!-- Revert to co & remove from proposal list  -->
<div class="modal" role="dialog" id="revertToDcModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Application Revert To DC
                </h5>
            </div>
            <div class="modal-body" align="center">
                <h3>Are You Sure !</h3>
                <br>
                <h5 style="color: #F44336">You want to revert the <br>
                    Case :
                    <span id="showAppId" style="font-weight: bold"></span>
                    <br>
                    to DC
                </h5>
                <hr>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group" style="margin-top: 15px" align="left">
                    <label for="w3review" style="font-weight: bold">Enter Your Remarks <span style="color: red; font-weight: bold; font-size: 18px">*</span></label>
                    <textarea class="form-control" name="w3review" id="revertRemarks" rows="4" required minlength="1"> </textarea>
                </div>
                <input type="hidden" id="distCode" value="" readonly>
                <input type="hidden" id="caseNo" value="" readonly>
            </div>
            <!-- <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 15px">
                <div style="font-size: 14px; font-weight: bold; margin-top: 10px; margin-bottom: 10px">
                    Note: If you Revert this application to CO, this case would not be part of your current proposal. Then you have to generate new proposal for this application.
                </div>
            </div> -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  id="revertToDcModalNo">Close</button>
                <button type="button" class="btn btn-success"  id="revertToDcModalYes">Yes, Revert</button>
            </div>
        </div>
    </div>
</div>




<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">
<script src="<?php echo base_url('js/department/department.js'); ?>"></script>


<script>
    function report_no(dist_code,case_no,id) {

        $('#remarks'+id).show();

        var distCode = dist_code;
        var caseNo = case_no;

        $("#caseNo").val(caseNo);
        $("#distCode").val(distCode);

        $("#showAppId").html(caseNo);

        $('#revertToDcModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#revertToDcModal').modal('show');

    };


    function report_yes(dist_code,case_no,id) {
        $('#remarks'+id).hide();
        $('#remarks'+id).val('');

        if(!confirm('All existing revert Remarks will be Deleted ! Are you sure to proceed with Approve option ?'))
        {
            $('#report_status_no'+id).prop('checked', true);
            return false;
        }
        else
        {
            $.ajax({
                url: BASE_URL + "/Basundhara/approveByDeptTemp",
                dataType: "JSON",
                data: {dist_code: dist_code, case_no : case_no},
                type: "POST",
                success: function (data) {
                    if (data.response == 0) {
                        showWarningMessage(data.message);
                    }
                    if (data.response == 2) {
                        showSuccessMessage(data.message);
                        location.reload();
                        
                    }
                },
            });
        }

    }


    $('#revertToDcModalNo').click(function()
    {
        $('#revertToDcModal').modal('hide');
            location.reload();
        
    });


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
                url: BASE_URL + "/Basundhara/revertToDcByDeptTemp",
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



function openFinalSubmitModal(cab_id){
    $('#caninet_id_selected').val(cab_id);
    var formdata = $('#final_submit_case_form').serialize();
    $.ajax({
        url: BASE_URL + "Basundhara/getTotalNoCasesForFinalApproval",
        type: 'POST',
        data: formdata,
        dataType: 'json',
        success: function (data) {
            // $.unblockUI();   
            $('#cabinet_id_submit').text(cab_id);
            $('#TotalNoCases').text(data);
            const modal = $('#finalSubmissionModal').modal({
                backdrop: 'static',
                keyboard: false,
            });
            modal.fadeIn('slow').modal('show')
        },
        error: function (jqXHR, exception) {
            // $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }
    });
}



///Sweetalert confirm

function finalSubmit(cab_id) {
    Swal.fire({
        title: 'Are you Confirm?',
        text: '*** After approval, these cases would be available for Payment Notice Generation. Approval of these cases should be done only after approval of Cabinate Memo. Is your cabinate memo approved? ***',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, proceed!',
        cancelButtonText: 'No, cancel',
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: 'Do you want to Upload the Notification Copy',
                text: '*** Have you generated the Cab Notification for this approval ? ***',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed!',
                cancelButtonText: 'No, cancel',
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'Final Confirmation',
                        text: 'You have got the approved cab memo and approved notification. Are you sure?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, proceed!',
                        cancelButtonText: 'No, cancel',
                    }).then((result) => {
                        if (result.value) {
                            openFinalSubmitModal(cab_id);
                        }
                    });
                }
            });
        }
    });
}


    function GetDynamicTextBoxForView(count) {
    var row =  '<td id ="view_case_no_'+count +'" class="text-danger"></td>'           
        + '<td><small id ="view_remark_' + count + '" class="text-primary"></small></td>'
        return row;

    }


    

    $(document).on('click', '#finalSubmitByDeptNo', function () {
        $('#finalSubmissionModal').modal('hide');
    });




    ///Final Submission of Cases by Dept

    $(document).on('click', '#finalSubmitByDeptYes', function() {
        var uploadedFile = new FormData();
        uploadedFile.append("cab_id_selected", $("#cabinetIdSelected").val());

        $('#finalSubmissionModal').modal('hide'); 
        Swal.fire({
            title: 'Are you sure?',
            text: "All VGR Cases Will be Sent for Final Submission",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit!'
        }).then((result) => {
            if (result.isConfirmed) {
                    $('#show-Img').show();
                    $('#finalSubmit').hide();
                $.ajax({
                    url: BASE_URL + "/Basundhara/bulkApproveCasesVGR",
                    type: "POST",
                    dataType: "json",
                    processData: false, // important
                    contentType: false, // important
                    dataType: "json",
                    // contentType: "application/json",
                    data: uploadedFile,
                    success: function(data) {
                        if (data.responseType == 1) {
                            $('#show-Img').hide();
                            $('#finalSubmit').hide(); 
                            showErrorMessage(data.message);
                        } else if (data.responseType == 2) {
                            // showSuccessMessage(data.message);
                            // location.reload();
                                Swal.fire({
                            backdrop:true,
                            allowOutsideClick: false,
                            text: data.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                actions: 'my-actions',
                                confirmButton: 'order-2',
                            }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                location.reload(true);
                            }
                            });
                        } else if (data.responseType == 3) {
                            $('#show-Img').hide();
                            $('#finalSubmit').show();
                            showWarningMessage(data.message);
                        } else {
                            showErrorMessage("SOMETHING WENT WRONG");
                        }
                    },
                    // data: JSON.stringify(applicant)

                });
            }
        })

    });


 function digitalSignNotificationViewVGR(cab_id){
                $.ajax({
                    type        : 'POST', 
                    url         : BASE_URL +'CabController/GenerateNotificationForSignVgr', 
                    data        : {cab_id:cab_id}, 
                    // dataType    : 'json', 
                    encode      : true,
                    success: function(data){
                    console.log(data);
                    //   $('#notificationModal').hide('modal');
                    $("#generateSignNotificationViewVGR").html(data);
                    $('#generateNotificationModal').show('modal');
                    },
                });
            }

</script>