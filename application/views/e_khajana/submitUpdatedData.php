<!-- bank details fetching starts -->
<div class="container">
    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 p-4 mt-2" style="border:1px solid orange">
    <u><h4 class="text-center mt-3 mb-5">***UPDATE DATA***</h4></u>
        <form id="mouzadar_bank_details_form">
            <input type="hidden" name ="dist_code" value="<?=$bank_details->dist_code?>">
            <input type="hidden" name ="subdiv_code" value="<?=$bank_details->subdiv_code?>">
            <input type="hidden" name ="cir_code" value="<?=$bank_details->cir_code?>">
            <input type="hidden" name ="mouza_pargona_code" value="<?=$bank_details->mouza_pargona_code?>">
            <input type="hidden" name ="bank_id" value="<?=$bank_details->id?>">
            <input type="hidden" name ="account_code" value="<?=$bank_details->account_code?>">
	    <!-- 1st row -->
            Verified by Mouzadar = <span style="color:red"><?=$bank_details->mouzadar_declare_yn?></span><br>
            Verified by ADC = <span style="color:red"><?=$bank_details->adc_verified_yn?></span><br>
            <div class="row mt-4">
                <div class="col-md-3">
                <label class="small-font" id="label_style">Enter DEPARTMENT CODE</label>
                <input type="text" class="form-control" value="<?=$bank_details->dept_code?>"placeholder="Department code" name="dept_code">
                </div>
                <div class="col-md-3">
                <label class="small-font" id="label_style">Enter OFFICE CODE</label>
                <input type="text" class="form-control" value="<?=$bank_details->office_code?>" placeholder="Office code" name="office_code">
                </div>
                <div class="col-md-3">
                <label class="small-font" id="label_style">Enter OFFICE NAME</label>
                <input type="text" class="form-control" value="<?=$bank_details->office_name?>" placeholder="Office name" name="office_name">
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
                <input type="text" class="form-control" value="<?=$bank_details->bank_name?>" placeholder="Bank name" name="bank_name">
                </div>
                <div class="col-md-3">
                <label class="small-font" id="label_style">Enter BARNCH NAME</label>
                <input type="text" class="form-control" value="<?=$bank_details->branch_name?>" placeholder="Branch Name" name="branch_name">
                </div>
                <div class="col-md-3">
                <label class="small-font" id="label_style">Enter IFSC CODE</label>
                <input type="text" class="form-control" value="<?=$bank_details->ifsc_code?>" placeholder="IFSC Code" name="ifsc_code">
                </div>
            </div>
            <!-- 3rd row -->
            <div class="row mt-4">
                <div class="col-md-3">
                <label class="small-font" id="label_style">ACCOUNT HOLDER NAME</label>
                <input type="text" class="form-control" value="<?=$bank_details->account_name?>" placeholder="Name of account" name="account_name">
                </div>
                <div class="col-md-3">
                <label class="small-font" id="label_style">ACCOUNT NUMBER</label>
                <input type="text" class="form-control" value="<?=$bank_details->account_number?>" placeholder="Account Number" name="account_number">
                </div>
                <div class="col-md-3">
                <label class="small-font" id="label_style">ACCOUNT CODE</label>
                <input type="text" class="form-control" value="<?=$bank_details->account_code?>" placeholder="Account Code" name="account_code">
                </div>
            </div>
        <center>
        <button type="submit" class="btn btn-success mt-5" onclick="updateBankDetails()"><i class="fa fa-send-o"></i> Submit</button>
        </center>
        </form>
    </div>
    <div class="col-md-2"></div>
    </div>
</div>

<script>
    baseurl ='https://basundhara.assam.gov.in/ilrms/'
    function updateBankDetails()
    {
        event.preventDefault();
        var formdata = $('#mouzadar_bank_details_form').serialize();
        // $('#error_div').empty();
        // $('#error_div').hide();
        var url = baseurl + "/EkhajanaMouzadarBankDetails/updateBankDetails"

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
                        title: 'MOUZADAR BANK DETAILS UPDATED SUCCESSFULLY..!!!',
                        icon: 'success',
                        confirmButtonColor: '#3085D6',
                        confirmButtonText: 'Home'
                    }).then((result) => {
                    if (result.isConfirmed) {
                            window.location = baseurl + "/EkhajanaMouzadarBankDetails/mouzadarBankDetailsDataUpdate";
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
