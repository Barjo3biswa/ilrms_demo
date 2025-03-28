$(function() {
    $("#change_password").submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Hash the password values before creating FormData
        var pass = $('#old_password').val();
        var npass = $('#new_password').val();
        var cpass = $('#re_password').val();

        var hash = sha512.update(pass).hex(); // Ensure you get the hex representation
        var nhash = sha512.update(npass).hex();
        var chash = sha512.update(cpass).hex();


        $('#old_password').val(hash);
        $('#new_password').val(nhash);
        $('#re_password').val(chash);

        // Create FormData from the raw DOM element
        var formElement = document.getElementById('change_password');
        var formData = new FormData(formElement);

        // Revert the password fields back to their original values
        $('#old_password').val(pass);
        $('#new_password').val(npass);
        $('#re_password').val(cpass);

        if (!confirm("Are you sure you want to change your password!")) {
            return false;
        }

        $.ajax({
            type: "POST",
            url: "change-password",
            data: formData, // Use FormData object to serialize the form's elements
            dataType: "json",
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            beforeSend: function() {
                $("#validate_submit_btn").hide();
                $("#validate_msg").html("Please wait....");
                $('.error_msg').html('');
            },
            success: function(data) {
                console.log("Success:", data);

                if (data.error) {
                    $('.error_msg').html('');
                    $.each(data.error, function(index, value) {
                        $('#' + value['field']).html(value['message']);
						
                    });

                    $("#validate_msg").html('');
                    $("#validate_submit_btn").show();
                    return;
                }
                if (data.success === true && data.update === true) {
                    $("#validate_msg").html('Thank you. Your password changed successfully!' +
                        '<div><button class="btn btn-success mt-2" id="depart_btn_continue">Click here to continue</button></div>');
                    $("#change_password").hide();
                    $("#validate_submit_btn").hide();
                }
            },
            error: function(jqXHR, exception) {
                console.log("Error:", exception, jqXHR);

                $("#validate_msg").html("Something went wrong. Error: " + exception + " " + jqXHR.responseText);
                $("#validate_submit_btn").show();
            }
        });
    });
});



$(function () {
	///////////////////////primary user profile update//////////
	$("#user_update_details").submit(function (e) {
		e.preventDefault(); // avoid to execute the actual submit of the form
		if (!confirm("Are you sure want to update your profile!")) {
			return false;
		}
		$.ajax({
			type: "POST",
			url: "user-profile-update",
			data: $("#user_update_details").serialize(), // serializes the form's elements.
			dataType: "json",
			beforeSend: function () {
				$("#update_user").hide();
				$("#user_validate_msg").html("Please wait....");
				$('.error_u').html('');
			},
			success: function (data) {
				if (data.error) {
					$('.error_u').html('');
					$.each(data.error, function (index, value) {
						$('#' + value['field'])
							.html(
								value['message']);
					});
					$("#user_validate_msg").html('');
					$("#update_user").show();
					return;
				}
				if (data.success === true && data.update === true) {
					$('.error_u').html('');
					$("#user_validate_msg").html('<div class="py-2 text-success">Thank You. Your profile updated successfully!</div>');
					$("#update_user").show();
					$("#p_name").html(data.data.name);
					$("#p_name2").html(data.data.name);
					$("#p_mobile_no").html(data.data.mobile_no);
					$("#p_email").html(data.data.email);
					$("#p_email").html(data.data.email);
				}
			},
			error: function (jqXHR, exception) {
				$("#validate_msg").html("Something went wrong. Error: " +exception+ " " + jqXHR);
				$("#pass_btn").show();
			},
		});
	});
})


$(function () {
	//////////////////password change///////////
	$("#password_change").submit(function (e) {
		e.preventDefault(); // avoid to execute the actual submit of the form
		var pass = $('#old_password').val();
		var npass = $('#new_password').val();
		var cpass = $('#re_password').val();
                var hash = sha512.update(pass);
                var nhash = sha512.update(npass);
                var chash = sha512.update(cpass);
                $('#old_password').val(hash);
                $('#new_password').val(nhash);
                $('#re_password').val(chash);
		if (!confirm("Are you sure want to change your password!")) {
			return false;
		}
		$.ajax({
			type: "POST",
			url: "change-password",
			data: $("#password_change").serialize(), // serializes the form's elements.
			dataType: "json",
			beforeSend: function () {
				$("#pass_btn").hide();
				$("#validate_msg").html("Please wait....");
				$('.error_msg').html('');
			},
			success: function (data) {
                                 $('#old_password').val("");
                                 $('#new_password').val("");
                                 $('#re_password').val("");
				if (data.error) {
					$('.error_msg').html('');
					$.each(data.error, function (index, value) {
						$('#' + value['field']+'Err')
							.html(
								value['message']);
					});
					$("#validate_msg").html('');
					$("#pass_btn").show();
					return;
				}
				if (data.success === true && data.update === true) {
					$('.error_msg').html('');
					$("#password_change").trigger('reset');
					$("#validate_msg").html('<div class="py-2 text-success">Thank You. Your password changed successfully!</div>');
					$("#pass_btn").show();
				}
			},
			error: function (jqXHR, exception) {
				$("#validate_msg").html("Something went wrong. Error: " +exception+ " " + jqXHR);
				$("#pass_btn").show();
			},
		});
	});
	
})


$(document).on('change', '#mouza_val', function(){
	var loc_concat = $('#mouza_val').val();

	var postData = {
		'loc_concat' : loc_concat,
	}

	$.blockUI({
		message: $('#displayBox'),
		css: {
			border:'none',
			backgroundColor:'transparent'
		}
	});

	$.ajax({
		url: "get-lots",
		type: "POST",
		data: postData,
		success: function(data) {
			arr = JSON.parse(data);
			$.unblockUI();
			if(arr.responseType != 2)
			{
				showErrorMessage(arr.msg);
			}
			else
			{
				var options2 = '<option value="">Select Lot</option>';
				// var options3 = '<option value="">Select Village</option>';
				for(i=0; i<arr.data.length; i++){
					options2 += '<option value="'+arr.data[i].dist_code+'_'+arr.data[i].subdiv_code+'_'+arr.data[i].cir_code+'_'+arr.data[i].mouza_pargona_code+'_'+arr.data[i].lot_no+'">'+arr.data[i].loc_name+'</option>';
				}
				$('#lot_val').html(options2);   
				// $('#village_cat').html(options3);
			}
		}
	});
})

$(document).on('change', '#lot_val', function(){
	var loc_concat = $('#lot_val').val();

	var postData = {
		'loc_concat' : loc_concat,
	}

	$.blockUI({
		message: $('#displayBox'),
		css: {
			border:'none',
			backgroundColor:'transparent'
		}
	});

	$.ajax({
		url: "get-villages",
		type: "POST",
		data: postData,
		success: function(data) {
			arr = JSON.parse(data);
			$.unblockUI();
			if(arr.responseType != 2)
			{
				showErrorMessage(arr.msg);
			}
			else
			{
				var options2 = '<option value="">Select Village</option>';
				// var options3 = '<option value="">Select Village</option>';
				for(i=0; i<arr.data.length; i++){
					options2 += '<option value="'+arr.data[i].dist_code+'_'+arr.data[i].subdiv_code+'_'+arr.data[i].cir_code+'_'+arr.data[i].mouza_pargona_code+'_'+arr.data[i].lot_no+'_'+arr.data[i].vill_townprt_code+'">'+arr.data[i].loc_name+'</option>';
				}
				$('#village_val').html(options2);   
			}
		}
	});
})
