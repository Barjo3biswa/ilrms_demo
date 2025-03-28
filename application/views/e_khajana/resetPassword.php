<!-- bank details fetching starts -->
<div class="container">
    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10 p-4 mt-2" style="border:1px solid orange">
    <u><h4 class="text-center mt-3 mb-5">***RESET PASSWORD***</h4></u>
        <form id="mouzadar_bank_details_form">
            <input type="hidden" name ="dist_code" value="<?=$user_details->dist_code?>">
            <input type="hidden" name ="subdiv_code" value="<?=$user_details->subdiv_code?>">
            <input type="hidden" name ="cir_code" value="<?=$user_details->cir_code?>">
            <input type="hidden" name ="mouza_pargona_code" value="<?=$user_details->mouza_pargona_code?>">
            <div class="container row p-1" style="border:1px solid green">
                <div class="col-3">
                <span style="color:red">DISTRICT:</span> <?=$this->utilclass->getDistrictName($user_details->dist_code)?>,<br>
                </div>
                <div class="col-3">
                <span style="color:red">SUBDIVISION:</span> <?=$this->utilclass->getSubDivName($user_details->dist_code, 
                            $user_details->subdiv_code)?>,<br>
                </div>
                <div class="col-3">
                <span style="color:red">CIRCLE:</span> <?=$this->utilclass->getCircleName($user_details->dist_code, 
                            $user_details->subdiv_code,$user_details->cir_code)?>,<br>
                </div>
                <div class="col-3">
                <span style="color:red">MOUZA:</span> <?=$this->utilclass->getMouzaName($user_details->dist_code, 
                            $user_details->subdiv_code,$user_details->cir_code, 
                            $user_details->mouza_pargona_code)?>,
                </div>
            </div>
            <!-- 1st row -->
            <div class="row mt-4">
                <div class="col-md-3">
                <label class="small-font" id="label_style">NAME</label>
                <input type="text" class="form-control" readonly value="<?=$user_details->name?>"name="NAME">
                </div>
                <div class="col-md-3">
                <label class="small-font" id="label_style">DESIGNATION</label>
                <input type="text" class="form-control" readonly value="<?=$user_details->designation?>" name="designation">
                </div>
                <div class="col-md-3">
                <label class="small-font" id="label_style">USERNAME</label>
                <input type="text" class="form-control" readonly value="<?=$user_details->unique_uid?>" name="unique_user_name">
                </div>
                <div class="col-md-3">
                <label class="small-font" id="label_style">UNIQUE USER ID</label>
                <input type="text" class="form-control" readonly value="<?=$user_details->unique_user_id?>" name="id" >
                </div>
            </div>
        <center>
        <button type="submit" class="btn btn-success mt-5" onclick="resetPassword()"><i class="fa fa-refresh fa-spin"></i> RESET PASSWORD</button>
        </center>
        </form>
    </div>
    <div class="col-md-2"></div>
    </div>
</div>

<script>
    // baseurl ='http://localhost/ilrms_live/'
    baseurl ='https://basundhara.assam.gov.in/ilrms/'
    function resetPassword()
    {
        event.preventDefault();
        var formdata = $('#mouzadar_bank_details_form').serialize();
        // $('#error_div').empty();
        // $('#error_div').hide();
        var url = baseurl + "/EkhajanaMouzadarController/updatePassword"

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
            }else if(response.result == 'SERVER-ERROR'){
                alert(response.msg);
                showErrorMessage(response.msg);
                return;
            }else if(response.result == 'SUCCESS'){
                    Swal.fire({
                        title: 'MOUZADAR PASSWORD RESET SUCCESSFULLY..!!!',
                        icon: 'success',
                        confirmButtonColor: '#3085D6',
                        confirmButtonText: 'Home'
                    }).then((result) => {
                    if (result.isConfirmed) {
                            window.location = baseurl + "/EkhajanaMouzadarController/resetPassword";
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
