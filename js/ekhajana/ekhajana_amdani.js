 var baseurl = 'https://basundhara.assam.gov.in/ilrmsdemo/'
$(document).ready( function () {
    $('#amdani_start_date').datepick({dateFormat: 'yyyy-mm-dd'});
    $('#amdani_end_date').datepick({dateFormat: 'yyyy-mm-dd'});
});

//function village on change 
function villageOnChange(){
    //***************select-reset*************/
    $('#patta_type_code').empty();
    $('#patta_numbers').empty();
    $('#patta_type_code').append('<option value="00" selected>-ALL-PATTA-TYPE-</option>');
    $('#patta_numbers').append('<option value="00" selected>-ALL-PATTA-NO-</option>');
    //***************************************/
    var mouza_code = $('#ek_mouza_code').val();
    //alert(mouza_code);
    var village_uuid = $('#village_uuid').val();
    if(village_uuid == '00'){
        return;
    }
    $.ajax({ 
        url: baseurl + "EkhajanaMouzadarController/getPattaTypes",
        type: 'POST',
        data: {'mouza_code':mouza_code, 'village_uuid': village_uuid},
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
    var village_uuid = $('#village_uuid').val();
    var patta_type_code = $('#patta_type_code').val();
    if(patta_type_code == '00'){
        return;
    }
    if(village_uuid == "" || patta_type_code == ""){
        alert("Please Select Village And Patta-Type..!!");
        return;
    }
    $.ajax({
        url: baseurl + "EkhajanaMouzadarController/getPataNumbers",
        type: 'POST',
        data: {'village_uuid' : village_uuid, 'patta_type_code' : patta_type_code},
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


//function village on change 
function amdaniReportFormDetailsSubmit(){
    event.preventDefault();
    var formdata = $('#amdaniReportForm').serialize();    
    $.ajax({
        url: baseurl + "EkhajanaMouzadarController/amdaniReportFormValidation",
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
            $('#ekAr_error_div').hide();
            $('#ekAr_error_div_validation_error_msg').empty();
            if(data.response_type == 2){
                var url = $('#amdaniReportFormSubmitUrl').val();
                $('#amdaniReportForm').attr('action', url);
                $('#amdaniReportForm').attr('method', 'POST');
                $('#amdaniReportForm').submit();
            }else if(data.response_type == 1){
                alert("Validation-Error, Please Submit the form correctly!");
                $('#ekAr_error_div').show();
                var errors_arr = data.validation;
                // console.log(data.validation);
                // alert(data);
                // return;
                for (let i = 0; i < errors_arr.length; i++) {
                    //console.log(errors_arr[i].message);
                    $('#ekAr_error_div_validation_error_msg').append(errors_arr[i].message + "<br>");
                }
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
