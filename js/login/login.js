$(function() {
	$('#login_form').on('submit', function (event) {
      var otpLogin =$('#otp_login').val();
		// var salt = $('#randomKey').val();
        var pass = $('#password-field').val();
        var hash = sha512.update(pass);
        hash = sha512.update(hash + salt);
        $('#password-field').val(hash);

		var formData = $(this).serialize();
		//console.log(formData); return;
		$.ajax({
			type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url: 'loginProcess', // the url where we want to POST
			data: formData, // our data object
			dataType: 'json', // what type of data do we expect back from the server
			encode: true,
			beforeSend: function () {
				$("#btnImageloading").html("Please wait logging in...");
				$("#error").html('');
			},
		}).done(function (data) {
			$('#password-field').val('');
			if (data.validation === true && data.success == true) {
            if(otpLogin == 1)
            {
              $('#mobileNumber').text(data.user_mobile_no);
              $('#otpVerifyModal').modal('show');
				    return;
            }
				    window.location = "dashboard";
			} else if (data.validation === false) {
 			 	$("#capt").attr("src", "re-captcha?r=" + Math.random());
				$("#btnImageloading").html("");
				$("#error").html(data.error);
				return;
			} else if(data.success == false) {
				$("#capt").attr("src", "re-captcha?r=" + Math.random());
				$("#btnImageloading").html("");
				alert("Invalid credential entered. Please Try Again.");
				return;
			} else if(data.pass_success == false) {
				$("#capt").attr("src", "re-captcha?r=" + Math.random());
				$("#btnImageloading").html("");
				alert("Invalid credential entered. Please Try Again.");
				return;
			}
			else if(data.validation === true && data.mobile_no_update == 0) {
				// alert("Mobile No not Updated");
                $('#mobileNoUpdateModal').modal('show');
				return;
			}
		});
		event.preventDefault();
	});
	$(document).ready(function () {
		$('#refreshCaptcha').click(function () {
			$("#capt").attr("src", "re-captcha?r=" + Math.random());
		})
	});
})


///Get OTP by Entering Mobile No/////
$('#btn-get-otp').on('click', () => {
    var mobile_no = $('#mobile_no').val();
    if (mobile_no.length !== 10) {
        alert("Please enter a 10-digit mobile number properly.");
        return;
    }
	const loginData = {
      mobile_no: mobile_no,
    };
    alert("OTP Sent to Phone");

	console.log(loginData);
	// return;
    $.ajax({
		url: "get-otp-on-mobile",
      type: "post",
      dataType: "json",
      contentType: "application/json",
      success: function(data) {
        if (data.responseType == 1) {
          alert(data.msg);
        } else if (data.responseType == 2) {
		document.getElementById('verify_otp_div').style.display = 'block';
		document.getElementById('verify_otp_btn').style.display = 'block';
		document.getElementById('get_otp_div').style.display = 'none';
		document.getElementById('enter_mobile_div').style.display = 'none';
        } else if (data.responseType == 3) {
          showErrorMessage("Data not found !");
        } else {
          showErrorMessage("SOMETHING WENT WRONG");
        }
      },
      data: JSON.stringify(loginData)
    });

});

////Submit OTP & Update Mobile No/////

$('#otp_verify_login').on('click', () => {
    var login_otp = $('#login_otp').val();

	const otpData = {
      login_otp: login_otp,
    };

  console.log(otpData);
  // return;

    $.ajax({
		url: "otp-verify-login",
      type: "post",
      dataType: "json",
      contentType: "application/json",
      success: function(data) {
        if (data.responseType == 1) {
          alert(data.msg);
        } else if (data.responseType == 2) {
				window.location = "dashboard";
          // alert(data.msg);
        } else if (data.responseType == 3) {
          showErrorMessage("Data not found !");
        } else {
          showErrorMessage("SOMETHING WENT WRONG");
        }
      },
      data: JSON.stringify(otpData)
    });

});


////Verify OTP & Login/////

$('#btn-submit-otp').on('click', () => {
    var otp_no = $('#otp_no').val();
    var name_user = $('#name_user').val();
    var email_id = $('#email_id').val();
    var address = $('#address').val();

	const otpData = {
      otp_no: otp_no,
      name_user : name_user,
      email_id : email_id,
      address : address
    };

    $.ajax({
		url: "btn-submit-otp",
      type: "post",
      dataType: "json",
      contentType: "application/json",
      success: function(data) {
        if (data.responseType == 1) {
          alert(data.msg);
        //   showWarningMessage(data.msg);
        } else if (data.responseType == 2) {
        //   showSuccessMessage(data.msg);
          alert(data.msg);
			location.reload();
        } else if (data.responseType == 3) {
          showErrorMessage("Data not found !");
        } else {
          showErrorMessage("SOMETHING WENT WRONG");
        }
      },
      data: JSON.stringify(otpData)
    });

});



    // Success Message
    function showSuccessMessage(text) {
        swal.fire({
            title: "Success !",
            text: text,
            icon: 'success',
            position: 'top',
            showConfirmButton: true,
            timer: 5000,
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
            timer: 5000,
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
            timer: 5000,
            showCancelButton: true
        });
    }
