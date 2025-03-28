<div class="col-10 offset-3" >
    <div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 180px;"></div>
    <div class="col-6 mt-3" style="border:1px solid orange;padding:1rem">
        <div class="text-center text-warning bg-dark p-3 h-5 font-weight-bold" id="nyks_heading_div">
            NOTE: Kindly Enter And Verify The Mobile No Of The Citizen/Pattadar Before Proceeding To Registartion
        </div>
        <center>
            <img src="<?=base_url('assets/customer.png')?>" style="height:80px" id="customer_logo"alt="Logo"><br>
            <img src="<?=base_url('assets/correct.png')?>" style="height:80px;display:none" class="verified_logo" alt="Logo"><br>
            <label style="display:none" class="verified_logo">OTP VERIFICATION SUCCESSFULL</label>
        </center>
        <br>
        <div class="form-check" id="pattadar_consent_div">
            <input type="checkbox" class="form-check-input" id="pattadar_consent" name="pattadar_consent" value="something">
            <label class="form-check-label" for="check1">I, hereby, declare that I will not use any personal details of the pattadars registered or otherwise for any other purpose than to register in e-Khazna.</label>
        </div>
        <br>
        <form action="<?=base_url('Nyks/RegistrationSubmit')?>" id="nyks_form_submit" method="POST">
            <div style="display:none;" id="mobile_no_div">
                <label class="mobile_no_div">Mobile No Of The Citizen/Pattadar</label>
                <input type="text" class="form-control mobile_no_div" value="" autocomplete="off" placeholder="MOBILE-NO" maxlength="10" id="mobile_no" name='mobile'><br>
            </div>
            <div style="display:none" id="otp_div">
                <label>ENTER OTP</label>
                <input type="text" class="form-control" value="" autocomplete="off" placeholder="ENTER OTP" maxlength="10" id="sent_otp" name='sent_otp'><br>
            </div>
            <center>
                <button type="button" class="btn btn-primary btn-sm" id="sent_otp_btn" onclick="sent_otp_to_phone_no()" style="display:none;">
                    <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp; Verify Mobile No 
                </button>
                <div class="show_verify_otp_btn" id="show_verify_otp_btn" style="display:none;">
                    <button type="button" class="btn btn-success btn-sm" id="verify_otp_btn" onclick="verify_otp()">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp; Verify OTP 
                    </button>
                </div>
                <button type="button" class="btn btn-success w-100 py-2 px-5 mt-3" id="start_reg_btn" onclick="Start_Reg()" style="display:none;"><i class="fa fa-location-arrow" aria-hidden="true"></i> Click Here For Registration Process</button>
            </center>
        </form>        
    </div>
</div>


<script>

    $(document).ready(function() {
        $("#pattadar_consent").change(function() {
            if ($(this).is(":checked")) {
                $('#mobile_no_div').show(400);
                $('#sent_otp_btn').show(400);
            } else {
                $('#mobile_no_div').hide(400);
                $('#sent_otp_btn').hide(400);
            }
        });
    });

    function sent_otp_to_phone_no()
    {
        event.preventDefault();
        var mobile_no = $('#mobile_no').val();
        $.ajax({
            url: "<?=base_url()?>" + "/Nyks/SentOtp",
            type: 'POST',
            data:  {'mobile_no' : mobile_no},
        
            dataType: 'json',
            beforeSend: function () {
                alert("Sending Otp Please Wait....");
                $.blockUI({
                    message: $('#displayBoxEK'),
                    css: {
                        border:'none',
                        backgroundColor:'transparent'
                    }
                });
            },
            success: function (data) {
                if(data.status){
                    alert(data.msg);
                    $.unblockUI();
                    $('#otp_div').show(400);
                    $('#sent_otp_btn').hide(400);
                    $('#show_verify_otp_btn').show(400);
                    $('#pattadar_consent_div').hide(400);
                }else{
                    alert(data.msg);
                    $.unblockUI();
                }
            },
            error: function (jqXHR, exception) {
                $.unblockUI();
                alert('Could not Complete your Request ..!, Please Try Again later..!');
            }
        });

    }
</script>

<script>
    function verify_otp()
    {
        event.preventDefault();
        var otp_value = $('#sent_otp').val();
        $.ajax({
            url: "<?=base_url()?>" + "/Nyks/verify_otp",
            type: 'POST',
            data:  {'entered_otp' : otp_value},
        
            dataType: 'json',
            beforeSend: function () {
                // alert("before send");
                $.blockUI({
                    message: $('#displayBoxEK'),
                    css: {
                        border:'none',
                        backgroundColor:'transparent'
                    }
                });
            },
            success: function (data) {
                if(data.status){
                    alert(data.msg);
                    $.unblockUI();
                    $('#nyks_heading_div').hide(400);
                    $('#otp_div').hide(400);
                    $('#verify_otp_btn').hide(400);
                    $('.mobile_no_div').hide(400);
                    $('#start_reg_btn').show(400);
                    $('.verified_logo').show(400);
                    $('#customer_logo').hide(400);
                }else{
                    alert(data.msg);
                    $.unblockUI();
                }
            },
            error: function (jqXHR, exception) {
                
                alert('Could not Complete your Request ..!, Please Try Again later..!');
                $.unblockUI();
            }
        });
    }
</script>

<script>
    function Start_Reg()
    {
        $('#nyks_form_submit').submit();
        return;
    }
</script>
