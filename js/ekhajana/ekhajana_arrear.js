var baseurl = 'https://basundhara.assam.gov.in/ilrmsdemo/'
// var baseurl = 'http://localhost/ilrms_demo/'

$(document).ready( function () {
    //data table initialisation
    $('#ek_ast_pending_list_1').dataTable({
        "scrollX": true,
        "lengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
        "pageLength": 4,
        //"autoWidth":false,
        responsive: true
    });
});

//function village on change 
function villageOnChange(){
    //***************select-reset*************/
    $('#patta_type_code').empty();
    $('#patta_type_code').append('<option value="00" selected>-ALL-PATTA-TYPE-</option>');
    $('#patta_numbers').append('<option value="00" selected>-ALL-PATTA-NO-</option>');
    //***************************************/
    var mouza_code = $('#mouza_code').val();
    var location = $('#location').val();
    //alert(location);
    var explodedString = location.split("|");
    vill_uuid =explodedString[0];
    vill_townprt_code= explodedString[1];
    lot_no =explodedString[2];
    if(vill_uuid == '00'){
        return;
    }
    $.ajax({ 
        url: baseurl + "EkhajanaArrearController/getPattaTypes",
        type: 'POST',
        data: {'mouza_code':mouza_code, 'vill_uuid':vill_uuid, 'lot_no':lot_no, 'vill_townprt_code':vill_townprt_code},
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
            for(var i=0; i<data.length; i++) {
                $('#patta_type_code').append('<option value="'+data[i].type_code+'">'+data[i].patta_type+'('+ data[i].pattatype_eng+')</option>');
            }
            $.unblockUI();
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }  
    });
    $.unblockUI(); 
}

//getting patta no
function getPattaNo(){
    //***************select-reset*************/
    $('#patta_numbers').empty();
    $('#pattadars').empty();
    $('#patta_numbers').append('<option value="00" selected>-ALL-PATTA-NO-</option>');
    //***************************************/
    var location = $('#location').val();
    var dist_code = $('#dist_code').val();
    var subdiv_code = $('#subdiv_code').val();
    var cir_code = $('#cir_code').val();
    var mouza_code = $('#mouza_code').val();
    var explodedString = location.split("|");
    vill_uuid =explodedString[0];
    vill_townprt_code= explodedString[1];
    lot_no =explodedString[2];
    var patta_type_code = $('#patta_type_code').val();
    if(patta_type_code == '00'){
        return;
    }
    if(location == "" || patta_type_code == ""){
        alert("Please Select Village And Patta-Type..!!");
        return;
    }
    $.ajax({
        url: baseurl + "EkhajanaArrearController/getPataNumbers",
        type: 'POST',
        data: {'vill_uuid' : vill_uuid,'dist_code' : dist_code,'subdiv_code' : subdiv_code,'cir_code' : cir_code,'mouza_pargona_code' : mouza_code, 'patta_type_code' : patta_type_code},
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
            if(data.length === 0){
                alert("No Patta Found ..!, Please Select Different Patta Type Or Village!");
                return;
            }else{
                for(var i=0; i<data.length; i++) {
                    $('#patta_numbers').append('<option value="'+data[i].patta_no+'">'+data[i].patta_no+'</option>');
                }
                $.unblockUI();  
            }            
        },
        error: function (jqXHR, exception) {
            $.unblockUI();
            alert('Could not Complete your Request ..!, Please Try Again later..!');
        }  
    });
    $.unblockUI(); 
}


//modal open
function arrearPreUpdate(){
    event.preventDefault();
    showArrearPreUpdateModal();
    return;
}

// For modal display 
function showArrearPreUpdateModal(){
    $.blockUI({
        message: $('#displayBoxEK'),
        css: {
            border:'none',
            backgroundColor:'transparent',
        }
    });
  
    const modal = $('#Ek_Arrear_Pre_Update').modal({
        
        backdrop: 'static',
        keyboard: false,
    });
    let patta_no = $("#patta_numbers").val();
    $('#patta_no_modal_arr').html(patta_no);
    let patta_type = $("#patta_type_code :selected").text();
    $('#patta_type_code_modal_arr').html(patta_type);
    modal.fadeIn('slow').modal('show');
    $.unblockUI();
}

//revert remark close
function EkArearPreUpdationClose(){
    // $('#ek_arrear_pre_updatipn_form').text('');
    // $('#Ek_Arrear_Pre_Update').fadeOut('slow').modal('hide');
    // $('#Ek_objection_rmk_form_validation_error_msg').empty();
    // $('#Ek_objection_rmk_form_validation_error_div').hide();
    // document.getElementById("ek_arrear_pre_updatipn_form").reset();
    location.reload();
   
}

//revert remark submit handle
function EkArearPreUpdationSubmit(){
    event.preventDefault();
    var formdata = $('#arrear_pre_updation_form').serialize();
    var location = $('#location').val();
    var patta_type_code = $('#patta_type_code').val();
    $('#ek_arrear_pre_updation_validation_error_msg').empty();
    $('#ek_arrear_pre_updation_validation_error_div').hide();
    $.ajax({
        url: baseurl + "/EkhajanaArrearController/submitArrear",
        type: 'POST',
        data:  formdata ,
       
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
                $('#ek_arrear_pre_updation_validation_error_div').show();
                for (let i = 0; i < data.msg.length; i++) {
                    $('#ek_arrear_pre_updation_validation_error_msg').append(data.msg[i]);
                }
                return;
            }else if(data.result == 'SERVER-ERROR'){
                $.unblockUI();
                alert(data.msg);
                return;
            }else if(data.result == 'INPUT-ERROR'){
                $.unblockUI();
                alert(data.msg);
                return;
            }else if(data.result == "SUCCESS"){
                $.unblockUI();
                Swal.fire({
                    title: 'Arrear for the Patta Updated Successfully..!!!',
                    icon: 'success',
                    confirmButtonColor: '#3085D6',
                    confirmButtonText: 'Home'
                }).then((result) => {
                if (result.isConfirmed) {
                        //alert("In The Confiremed");
                        window.location = baseurl + "/EkhajanaArrearController/index";
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


function editYearWiseArrear(id){
    event.preventDefault();
    showYearWiseArrearModal(id);
    return;
}


function viewYearWiseArrear(id){
    event.preventDefault();
    viewYearWiseArrearModal(id);
    return;
}
// For modal display 
function viewYearWiseArrearModal(id){
    $.blockUI({
        message: $('#displayBoxEK'),
        css: {
            border:'none',
            backgroundColor:'transparent',
        }
    });
    const modal = $('#view-year-wise-arrear-modal-'+id).modal({
        backdrop: 'static',
        keyboard: false,
    });
    modal.fadeIn('slow').modal('show');
    $.unblockUI();
}

// For modal display 
function showYearWiseArrearModal(id){
    $.blockUI({
        message: $('#displayBoxEK'),
        css: {
            border:'none',
            backgroundColor:'transparent',
        }
    });
    const modal = $('#year-wise-arrear-modal-'+id).modal({
        backdrop: 'static',
        keyboard: false,
    });
    modal.fadeIn('slow').modal('show');
    $.unblockUI();
}

//modal close
function yearWiseArrearModalClose(id){
    // $('#year-wise-modal-'+id).fadeOut('slow').modal('hide');
    // $('#year-wise-arrear-modal-'+id).modal('hide');
    // document.getElementById("year-wise-modal-"+id).reset();
    location.reload();
   
}


function submitYearWiseArrearEditData(id)
{
    event.preventDefault();
    var formdata = $(`#year-wise-modal-edit-${id}`).serialize();
    $.ajax({
        url: baseurl + "/EkhajanaArrearController/submitEditedArrear",
        type: 'POST',
        data:  formdata ,
       
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
                $('.ek_arrear_pre_updation_edit_validation_error_div').show();
                // alert("show");
                console.log(data);
                for (let i = 0; i < data.msg.length; i++) {
                    $('.ek_arrear_pre_updation_edit_validation_error_msg').append(data.msg[i]);
                    
                }
                return;
            }else if(data.result == 'SERVER-ERROR'){
                $.unblockUI();
                alert(data.msg);
                return;
            }else if(data.result == "SUCCESS"){
                $.unblockUI();
                Swal.fire({
                    title: 'Arrear for the Patta Updated Successfully..!!!',
                    icon: 'success',
                    confirmButtonColor: '#297013',
                    confirmButtonText: 'Home'
                }).then((result) => {
                if (result.isConfirmed) {
                        //alert("In The Confiremed");
                        window.location = baseurl + "/EkhajanaArrearController/index";
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







