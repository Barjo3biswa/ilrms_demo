$(document).ready(function() {
    $('#dataTable').DataTable();
});
    var BASE_URL = $("#getBaseURL").val();

    // Success Message
    function showSuccessMessage(text) {
        swal.fire({
            title: "Success !",
            text: text,
            icon: 'success',
            position: 'top',
            showConfirmButton: true,
            timer: 50000,
        });
        location.reload();
    }

    // Error Message
    function showErrorMessage(text) {
        swal.fire({
            title: "Error!",
            text: text,
            icon: 'error',
            position: 'top',
            showConfirmButton: false,
            timer: 50000,
            showCancelButton: true
        });
    }

    // Warning Message
    function showWarningMessage(text) {
        swal.fire({
            // title: "Error!",
            text: text,
            icon: 'warning',
            position: 'top',
            showConfirmButton: false,
            timer: 50000,
            showCancelButton: true
        });
    }


    // ****************************************************************
    // proposal id search by case no
    $(document).on('click', '#searchProId', function() {
        $('#searchProIdModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('#searchProIdModal').modal('show');
    });

    $(document).on('click', '#searchProIdModalNo', function() {
        $('#searchProIdModal').modal('hide');
    });

    $(document).on('click', '#searchProIdModalYes', function() {
        const applicant = {
            districtId: $("#districtId").val(),
            caseNo: $("#caseId").val(),
            applicationNo: $("#applicationId").val(),

        };


        $.ajax({
            url: BASE_URL + "/Basundhara/searchProposalIdByAppCaseNo",
            type: "post",
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
                if (data.responseType == 1) {
                    showErrorMessage("There is some problem, Please try again");
                } else if (data.responseType == 2) {

                    $('#searchProIdModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });

                    var table = '';
                    var sl = 1;
                    $.each(data.proposalIds, function(i, val) {

                        table +=
                            '<tr>' +
                            // '<td style="font-size: 18px; font-weight: bold; color: red">' + sl + '. &nbsp;' + '</td>' +
                            '<td style="font-size: 18px; font-weight: bold; color: red">' + 'Case Fall Under ' + val.proposal_name + '</td>' +
                            '</tr>';

                        sl = sl + 1;
                    });
                    $('#caseTable').html(table);
                } else if (data.responseType == 3) {
                    $('#searchProIdModal').modal('hide');
                    showErrorMessage("Data not found !");
                } else {
                    showErrorMessage("SOMETHING WENT WRONG");
                }
            },
            data: JSON.stringify(applicant)

        });


    });


    // Agree / DisAgree

    // ****************************************************************
    // Agree Modal
    $(document).on('click', '.agreeProposalbySdlac', function() {
        $('#target_proposal_id').val($(this).val());
        $('#target_proposal_refused_id').val($(this).val());
        $('#agreeSdlacProposalModal').modal('show');
        $("#proposal_no_agree_view").text($(this).val());

    });

   
        function agree_proposal_reset_modal(){
        $('#agreeSdlacProposalModal').fadeOut('slow').modal('hide');
        document.getElementById("sdlac_agree_form").reset();
    }


    // DisAgree Modal
    $(document).on('click', '.refuseProposalbySdlac', function() {
        $('#target_proposal_id').val($(this).val());
        $('#target_proposal_refused_id').val($(this).val());
        $('#refuseSdlacProposalModal').modal('show');
    	$("#proposal_no_refuse_view").text($(this).val());

    });


    function refuse_proposal_reset_modal(){
        $('#refuseSdlacProposalModal').fadeOut('slow').modal('hide');
        document.getElementById("sdlac_refuse_form").reset();
    }


     // View Minutes Modal
     $(document).on('click', '#viewProposalMinutesSdlac', function() {
        $('#viewProposalMinutesSdlacModal').modal('show');

    });

   


    //Proposal Agreed by SDLAC and Sent to SDO/ADC
    $(document).on('click', '#agreeProposalbySdlacYes', function() {
        $('#agreeSdlacProposalModal').modal('hide');

        var proposal_id = $('#target_proposal_id').val();
        var service_code = $("#service_code").attr('value');
            const applicant = {
                proposal_id: proposal_id,
                service_code: service_code,
            };

            $.ajax({
                url: BASE_URL + "/Basundhara/agreeProposalBySdlac",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    // alert(data.responseType);

                    if (data.responseType == 1) {

                        showErrorMessage(data.message);
                    } else if (data.responseType == 2) {

                        showSuccessMessage(data.message);
                        location.reload();
                    } else if (data.responseType == 3) {
                        showWarningMessage(data.message);
                    }
                    else {

                        showErrorMessage(data.message);
                    }
                },
                data: JSON.stringify(applicant)

            });

    });







    //Proposal Refused by SDLAC and Sent to SDO/ADC
    $(document).on('click', '#refuseProposalbySdlacYes', function() {
        $('#refuseSdlacProposalModal').modal('hide');

        //var proposal_id = $("#refuseProposalbySdlac").attr('value');
        var proposal_id = $('#target_proposal_refused_id').val();
        var sdlac_remarks = $("#sdlac_remarks").val();
        var service_code = $("#service_code").val();

            const applicant = {
                proposal_id: proposal_id,
                sdlac_remarks: sdlac_remarks,
                service_code: service_code,
            };

            $.ajax({
                url: BASE_URL + "/Basundhara/refuseProposalBySdlac",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                success: function(data) {
                    if (data.responseType == 1) {
                       
                        showErrorMessage("There is some problem, Please try again");
                    }
                    else if (data.responseType == 3) {

                        showWarningMessage("Please Write Remarks before Refuse. !");
                    } else if (data.responseType == 2) {

                        showSuccessMessage("Proposal successfully Refused by SDLAC");

                    }  else {

                        showErrorMessage("Failed.Kindly Contact System Administrator.");
                    }
                },
                data: JSON.stringify(applicant)

            });

    });

