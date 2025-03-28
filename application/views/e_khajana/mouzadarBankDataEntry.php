<style>
    .small-font{
        font-size:10px;
    }
</style>
<div class="container">
    <div class="row">
    <link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
    <script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
        <div class="col-md-2"></div>
        <div class="col-md-8 p-4 mt-2" style="border:1px solid orange">
        <div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 80px;"></div>
            <u><h4 class="text-center mt-3 mb-5">***MOUZADAR BANK DETAILS DATA ENTRY PORTAL***</h4></u>
            <form id="mouzadar_bank_details_form">
                <!-- location fetching of mouzadar starts-->
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" id="district_code" onchange="districtOnChange()">
                            <option selected>SELECT DISTRICT</option>
                            <?php foreach ($district as $key => $dist) { ?>
                                <option value="<?php echo $dist->district_code; ?>"><?php echo $dist->district_name; ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" onchange="circleOnChange()" id="circle_list" name="circle_list">
                            <option value="00" selected>SELECT CIRCLE</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" id="mouza_list" name="mouza_list">
                            <option selected>SELECT MOUZA</option>
                        </select>
                    </div>
                </div>
                <!-- location fetching of mouzadar ends -->
                <!-- bank details fetching starts -->
                <!-- 1st row -->
                <div class="row mt-4">
                    <div class="col-md-3">
                    <label class="small-font" id="label_style">Enter DEPARTMENT CODE</label>
                    <input type="text" class="form-control" placeholder="Department code" name="dept_code">
                    </div>
                    <div class="col-md-3">
                    <label class="small-font" id="label_style">Enter OFFICE CODE</label>
                    <input type="text" class="form-control" placeholder="Office code" name="office_code">
                    </div>
                    <div class="col-md-3">
                    <label class="small-font" id="label_style">Enter OFFICE NAME</label>
                    <input type="text" class="form-control" placeholder="Office name" name="office_name">
                    </div>
                    <div class="col-md-3">
                    <label class="small-font" id="label_style">Enter PAYMENT TYPE</label>
                    <input type="text" class="form-control" placeholder="Non treasury payment type" name="payment_type" value="02" readonly>
                    </div>
                </div>
                <!-- 2nd row -->
                <div class="row mt-4">
                    <div class="col-md-3">
                    <label class="small-font" id="label_style">Enter NAME OF SERVICE</label>
                    <input type="text" class="form-control" placeholder="Name of service" name="service_name" readonly value="E-KHAJANA">
                    </div>
                    <div class="col-md-3">
                    <label class="small-font" id="label_style">Enter BANK NAME</label>
                    <input type="text" class="form-control" placeholder="Bank name" name="bank_name">
                    </div>
                    <div class="col-md-3">
                    <label class="small-font" id="label_style">Enter BARNCH NAME</label>
                    <input type="text" class="form-control" placeholder="Branch Name" name="branch_name">
                    </div>
                    <div class="col-md-3">
                    <label class="small-font" id="label_style">Enter IFSC CODE</label>
                    <input type="text" class="form-control" placeholder="IFSC Code" name="ifsc_code">
                    </div>
                </div>
                <!-- 3rd row -->
                <div class="row mt-4">
                    <div class="col-md-3">
                    <label class="small-font" id="label_style">Enter ACCOUNT HOLDER NAME</label>
                    <input type="text" class="form-control" placeholder="Name of account" name="account_name">
                    </div>
                    <div class="col-md-3">
                    <label class="small-font" id="label_style">Enter ACCOUNT NUMBER</label>
                    <input type="text" class="form-control" placeholder="Account Number" name="account_number">
                    </div>
                    <div class="col-md-3">
                    <label class="small-font" id="label_style">Enter ACCOUNT CODE</label>
                    <input type="text" class="form-control" placeholder="Account Code" name="account_code">
                    </div>
                </div>
            <button type="submit" class="btn btn-primary mt-5" onclick="submitBankDetails()">Submit</button>
            </form>
        </div>
        <!-- validation-errors-div -->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="text-align:center">
                <div class="col-lg-12" id="error_div" style="display:none;">
                    <div class="card-header h5 bg-danger text-white text-center">
                        VALIDATION ERRORS
                    </div>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <strong class="text-center" style="color:red !important"
                            id="error_msg">
                        </strong>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- validation-error-div-end -->
        <div class="col-md-2"></div>
    </div>
</div>
<script>
    //baseurl ='http://localhost/ilrms_live/'
    baseurl ='https://basundhara.assam.gov.in/ilrms/'
    function showSuccessMessage(text) {
        swal.fire({
            title: "Success !",
            text: text,
            icon: 'success',
            position: 'top',
            showConfirmButton: true,
            timer: 5000,
        });
    }

    function showErrorMessage(text) {
        swal.fire({
            title: "Error!",
            text: text,
            icon: 'error',
            position: 'top',
            timer: 5000,
            showCancelButton: true
        });
    }
   
    //function village on change 
    function districtOnChange(){

        //***************select-reset*************/
        $('#circle_list').empty();
        $('#circle_list').append('<option value="00" selected>-SELECT CIRCLE-</option>');
        //***************************************/
        var district = $('#district_code').val();
        if(district == '00'){
            alert("Please select a District...!!");
            return;
        }
        const application = {
                dist_code  : district,            
            };
        $.ajax({ 
            url: baseurl + "/EkhajanaMouzadarBankDetails/getCircleNames",
            type: 'POST',
            data: JSON.stringify(application),
            cache : false,
            processData: false,
            dataType: 'json',
            success: function (data) { 
                console.log(data);     
                for(var i=0; i<data.length; i++) {
                    $('#circle_list').append('<option value="'+data[i].dist_code+','+data[i].subdiv_code+','+data[i].cir_code+'">('+ data[i].locname_eng+')</option>');
                }
            },
            error: function (jqXHR, exception) {
                alert('Could not Complete your Request ..!, Please Try Again later..!');
            }  
        });
        
    }

    function circleOnChange(){
        //***************select-reset*************/
        $('#mouza_list').empty();
        $('#mouza_list').append('<option value="00" selected>-SELECT MOUZA-</option>');
        //***************************************/
        var location = $('#circle_list').val();
        var explodedString = location.split(",");
        dist_code =explodedString[0];
        subdiv_code =explodedString[1];
        cir_code =explodedString[2];
       
        if(subdiv_code == '00'){
            alert("Please select a Circle...!!");
            return;
        }
        const application = {
               dist_code  : dist_code,            
               subdiv_code  : subdiv_code,            
               cir_code  : cir_code,            
            };
        $.ajax({ 
            url: baseurl + "/EkhajanaMouzadarBankDetails/getMouzaNames",
            type: 'POST',
            data: JSON.stringify(application),
            cache : false,
            processData: false,
            dataType: 'json',
            success: function (data) { 
                console.log(data);     
                for(var i=0; i<data.length; i++) {
                    $('#mouza_list').append('<option value="'+data[i].mouza_pargona_code+'">('+ data[i].locname_eng+','+ data[i].loc_name+')</option>');
                }
            },
            error: function (jqXHR, exception) {
                alert('Could not Complete your Request ..!, Please Try Again later..!');
            }  
        });
        
    }
    

    //revert remark submit handle
    function submitBankDetails(){
        event.preventDefault();
        var formdata = $('#mouzadar_bank_details_form').serialize();
        // $('#error_div').empty();
        // $('#error_div').hide();
        var url = baseurl + "/EkhajanaMouzadarBankDetails/submitBankDetails"

        jQuery.ajax({
            url: url,
            data: formdata,
            type: "POST",
            success: function (data) {
            response = JSON.parse(data);
            if(response.result == 'VALIDATION ERROR'){
                alert("Validation-Error...!!");
                    $('#error_div').show();
                    for (let i = 0; i < response.msg.length; i++) {
                        $('#error_msg').append(response.msg[i]);
                    }
                return;
            }else if(response.flag == 'N'){
                alert(response.msg);
                showErrorMessage(response.msg);
                return;
            }else if(response.flag == 'Y'){
                    Swal.fire({
                        title: 'MOUZADAR BANK DETAILS SAVED SUCCESSFULLY..!!!',
                        icon: 'success',
                        confirmButtonColor: '#3085D6',
                        confirmButtonText: 'Home'
                    }).then((result) => {
                    if (result.isConfirmed) {
                            window.location = baseurl + "/EkhajanaMouzadarBankDetails/mouzadarBankDetailsDataEntry";
                        }
                    })
                    return;
                }
            },
            error: function (jqXHR, exception) {
                alert('Could not Complete your Request ..!, Please Try Again later..!');
            } 
        });
    }


</script>

