 var baseurl = 'https://basundhara.assam.gov.in/ilrmsdemo'
 
//  var baseurl = 'http://localhost/ilrms_demo'
 
$(document).ready( function () {
    //data table initialisation
    $('#ek_ast_pending_list_1').dataTable({
        "scrollX": true,
        "lengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
        "pageLength": 4,
        //"autoWidth":false,
        responsive: true
    });
    //date field initialisation
    $('#last_pay_date1').datepick({dateFormat: 'yyyy-mm-dd'});
});

//payment self or other handle 
$("#paymentByOtherRadio").click(function(){
    $("#payee_details_div").show('slide', '', 400);
});
$("#paymentBySelfRadio").click(function(){
    $("#payee_details_div").hide('slide', '', 400);
});

//arrear update form submit
function mouzdarCaseRegistration(){
    event.preventDefault();
    var ld_application_no = $('#ld_application_no').val();
    $('#mouArr_error_div').hide();
    $('#mouArr_validation_error_msg').empty();
    var formdata = $('#mouzadar_form').serialize();

    $.ajax({
        url: baseurl + "/EkhajanaMouzadarController/caseRegistration",
        type: 'POST',
        data: formdata,
        dataType: 'json',
        beforeSend: function () {
            console.log("Loader Code Display");
        },
        success: function (data) {      
            if(data.result == 'validation_error'){
                $.unblockUI();
                alert("Validation-Error...!!");
                $('#mouArr_error_div').show();
                for (let i = 0; i < data.msg.length; i++) {
                    $('#mouArr_validation_error_msg').append(data.msg[i]);
                }
                return;
            }else if(data.result == 'SERVER-ERROR'){
                $.unblockUI();
                alert(data.msg);
                return;

            }else if(data.result == 'SUCCESS'){
                $.unblockUI();
                Swal.fire({
                    title: 'Case('+ld_application_no+') Forwarded Sucessfully!!',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Home'
                }).then((result) => {
                if (result.isConfirmed) {
                    location.href = baseurl + "/EkhajanaMouzadarController/index";
                    }
                })
                return;
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }  
    });
    $.unblockUI();
}

//ast case dispose for already registerd case 
function MouzadarJwExistsCaseDispose(){
    event.preventDefault();
    var formdata = $('#jama_Wasil_exits_form_data').serialize();
    $.ajax({
        url: baseurl + "/EkhajanaMouzadarController/jwExistsCaseDispose",
        type: 'POST',
        data: formdata,
        dataType: 'json',
        beforeSend: function () {
            $.blockUI({
                message: $('#displayBoxEK'),
                css: {
                    border:'none',
                    backgroundColor:'transparent'
                }
            });
        },
        success: function (data) {      
            //*******************/
            if(data.result == 'SERVER-ERROR'){
                $.unblockUI();
                alert(data.msg);
                return;

            }else if(data.result == 'SUCCESS'){
                $.unblockUI();
                Swal.fire({
                    title: 'Case Forwarded to Circle Officer Successfully!',
                    //text: "Now Citizen Can Pay The Amount In ARTPS/Basundhara",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Home'
                }).then((result) => {
                if (result.isConfirmed) {
                    location.href = baseurl + "/EkhajanaMouzadarController/index";
                    }
                })
                return;
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }  
    });
    $.unblockUI();
}

//revert remark submit handle
function EkObjectionFormSubmit(){
    event.preventDefault();
    var ld_application_no = $('#ld_application_no').val();
    var formdata = $('#mouzadar_form').serialize();
    $('#Ek_objection_rmk_form_validation_error_msg').empty();
    $('#Ek_objection_rmk_form_validation_error_div').hide();
    $.ajax({
        url: baseurl + "/EkhajanaMouzadarController/submitObjection",
        type: 'POST',
        data: formdata,
       
        dataType: 'json',
        beforeSend: function () {
            $.blockUI({
                message: $('#displayBox'),
                css: {
                    border:'none',
                    backgroundColor:'transparent'
                }
            });
        },
        success: function (data) {
            $.unblockUI();
            //validation_error_handle
            if(data.result == 'validation_error'){
                alert("Validation-Error, Please Submit the form correctly!");
                $('#Ek_objection_rmk_form_validation_error_div').show();
                for (let i = 0; i < data.msg.length; i++) {
                    $('#Ek_objection_rmk_form_validation_error_msg').append(data.msg[i]);
                }
                return;
            }else if(data.result == 'SERVER-ERROR'){
                alert(data.msg);
                return;
            }else if(data.result == "SUCCESS"){
                $.unblockUI();
                Swal.fire({
                    title: 'Case('+ld_application_no+ ') Objection Submitted Sucessfully!',
                    text: "This case will be available with CO",
                    icon: 'success',
                    confirmButtonColor: '#3085D6',
                    confirmButtonText: 'Home'
                }).then((result) => {
                if (result.isConfirmed) {
                    location.href = baseurl + "/EkhajanaMouzadarController/index";
                    }
                })
                return;
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }
    });
}

//revert case modal show
function objectionCase(case_no){
    event.preventDefault();
    showObjectionModalMb2(case_no,'19');
    return;
}

// For modal display reject
function showObjectionModalMb2(case_no,service_code){
    $.blockUI({
        message: $('#displayBoxEK'),
        css: {
            border:'none',
            backgroundColor:'transparent',
        }
    });
    const modal = $('#Ek_objection_modal').modal({
        backdrop: 'static',
        keyboard: false,
    });
    modal.fadeIn('slow').modal('show');
    $.unblockUI();
}

//revert remark close
function EkObjectionModalClose(){
    //alert('close');
    $('#Ek_objection_rmk').text('');
    $('#Ek_objection_modal').fadeOut('slow').modal('hide');

    $('#Ek_objection_rmk_form_validation_error_msg').empty();
    $('#Ek_objection_rmk_form_validation_error_div').hide();
    document.getElementById("Ek_objection_rmk_form").reset();
   
}

//saving bank details
function bankDetailsAdd(){
    event.preventDefault();
    var formdata = $('#bank_details_form').serialize();
    $.ajax({
        url: baseurl + "/EkhajanaMouzadarController/bankAccountEntryFormSubmit",
        type: 'POST',
        data: formdata,
        dataType: 'json',
        beforeSend: function () {
            console.log("Loader Code Display");
        },
        success: function (data) {
            if(data.result == 'validation_error'){
                $.unblockUI();
                alert("Validation-Error...!!");
                $('#bankDetails_error_div').show();
                for (let i = 0; i < data.msg.length; i++) {
                    $('#bankDetails_validation_error_msg').append(data.msg[i]);
                }
                return;
            }else if(data.result == 'SERVER-ERROR'){
                $.unblockUI();
                alert(data.msg);
                return;
            }else if(data.result == 'SUCCESS'){
                $.unblockUI();
                Swal.fire({
                    title: 'Bank Details Added Successfully!',
                    icon: 'success',
                    confirmButtonColor: '#3085D6',
                    confirmButtonText: 'Home'
                }).then((result) => {
                if (result.isConfirmed) {
                    location.href = baseurl + "/Home/dashboard";
                    }
                })
                return;
            }
        },
        error: function (jqXHR, exception) {
            alert("loader complete");
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }
    });
}

function MouzadarFinalSubmit(){
    alert('to-do:opening balance in constant');
    event.preventDefault();
    var opening_balance = 0;
    var current_revenue =$('#current_revenue').val();
    var current_local_tax = $('#current_local_tax').val();
    
    if(current_revenue == ""){
        alert("Some Error Occured..!!, error-code: #EKHASTARR001");
        return;
    }
    if(current_local_tax == ""){
        alert("Some Error Occured..!!, error-code: #EKHASTARR002");
        return;
    }
    var due_payment = parseFloat(opening_balance)+ parseFloat(current_revenue) + parseFloat(current_local_tax);
    let text = "Citizen Due Payment Will Be "+ due_payment+ " rs";

    Swal.fire({
        title: 'Are you sure?',
        text: text,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Update Arrear!',
      }).then(function(result) {
        //alert(result.isConfirmed);
        if(result.isConfirmed){
            $('#mouzadar_Arr_error_div_new').hide();
            $('#mouzadar_Arr_validation_error_msg_new').empty();
            var formdata = $('#mouzadar_arrear_update_form_new').serialize();
            $.ajax({
                url: baseurl + "/EkhajanaMouzadarController/arrearUpdateFormSubmitMouzadar",
                type: 'POST',
                data: formdata,
                dataType: 'json',
                beforeSend: function () {
                    $.blockUI({
                        message: $('#displayBoxEK'),
                        css: {
                            border:'none',
                            backgroundColor:'transparent'
                        }
                    });
                },
                success: function (data) {      

                    if(data.result == 'validation_error'){
                        $.unblockUI();
                        alert("Validation-Error...!!");
                        $('#mouzadar_Arr_error_div_new').show();
                        for (let i = 0; i < data.msg.length; i++) {
                            $('#mouzadar_Arr_validation_error_msg_new').append(data.msg[i]);
                        }
                        return;
                    }else if(data.result == 'SERVER-ERROR'){
                        $.unblockUI();
                        alert(data.msg);
                        return;

                    }else if(data.result == 'SUCCESS'){
                        $.unblockUI();
                        Swal.fire({
                            title: 'Arrear Updated Sucessfully!',
                            text: "Now Citizen Can Pay The Amount In ARTPS/Basundhara",
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Home'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = baseurl + "/EkhajanaMouzadarController/index";
                            }
                        })
                        return;
                    }
                },
                error: function (jqXHR, exception) {
                    $.unblockUI();
                    alert('Could not Complete your Request ..!, Please Try Again later..!');
                }  
            });
        }
        
        $.unblockUI();
    })
}

//revert remark submit handle
function MouzadarObjectionSubmitAfterCOApproval(){
    $('#Ek_objection_rmk_form_validation_error_msg').empty();
    $('#Ek_objection_rmk_form_validation_error_div').hide();
    var formdata = $('#mouzadar_form_after_objection').serialize();
 
    $.ajax({
        url: baseurl + "/EkhajanaMouzadarController/MouzadarObjectionSubmitAfterCOApproval",
        type: 'POST',
        data: formdata,
       
        dataType: 'json',
        
        beforeSend: function () {
            $.blockUI({
                message: $('#displayBox'),
                css: {
                    border:'none',
                    backgroundColor:'transparent'
                }
            });
        },
        
        success: function (data) {
            
            $.unblockUI();
            //validation_error_handle
            if(data.result == 'validation_error'){
                alert("Validation-Error, Please Submit the form correctly!");
                $('#Ek_objection_rmk_form_validation_error_div').show();
                for (let i = 0; i < data.msg.length; i++) {
                    $('#Ek_objection_rmk_form_validation_error_msg').append(data.msg[i]);
                }
                return;
            }else if(data.result == 'SERVER-ERROR'){
                alert(data.msg);
                return;
            }else if(data.result == "SUCCESS"){
                $.unblockUI();
                Swal.fire({
                    title: 'Case Submitted Sucessfully!',
                    text: "This case will be available with LM",
                    icon: 'success',
                    confirmButtonColor: '#3085D6',
                    confirmButtonText: 'Home'
                }).then((result) => {
                if (result.isConfirmed) {
                    location.href = baseurl + "/EkhajanaMouzadarController/index";
                    }
                })
                return;
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }
    });
}

//revert remark submit handle
function EkObjectionFormSubmitProceeding(){
    event.preventDefault();
    var ld_application_no = $('#ld_application_no').val();
    var formdata = $('#mouzadar_form_objection').serialize();
    $('#Ek_objection_rmk_form_validation_error_msg').empty();
    $('#Ek_objection_rmk_form_validation_error_div').hide();
    $.ajax({
        url: baseurl + "/EkhajanaMouzadarController/submitObjectionProceeding",
        type: 'POST',
        data: formdata,
       
        dataType: 'json',
        beforeSend: function () {
            $.blockUI({
                message: $('#displayBox'),
                css: {
                    border:'none',
                    backgroundColor:'transparent'
                }
            });
        },
        success: function (data) {
            $.unblockUI();
            //validation_error_handle
            if(data.result == 'validation_error'){
                alert("Validation-Error, Please Submit the form correctly!");
                $('#Ek_objection_rmk_form_validation_error_div').show();
                for (let i = 0; i < data.msg.length; i++) {
                    $('#Ek_objection_rmk_form_validation_error_msg').append(data.msg[i]);
                }
                return;
            }else if(data.result == 'SERVER-ERROR'){
                alert(data.msg);
                return;
            }else if(data.result == "SUCCESS"){
                $.unblockUI();
                Swal.fire({
                    title: 'Case('+ld_application_no+ ') Objection Submitted Sucessfully!',
                    text: "This case will be available with CO",
                    icon: 'success',
                    confirmButtonColor: '#3085D6',
                    confirmButtonText: 'Home'
                }).then((result) => {
                if (result.isConfirmed) {
                    location.href = baseurl + "/EkhajanaMouzadarController/index";
                    }
                })
                return;
            }
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }
    });
}

