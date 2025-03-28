<?php if($this->session->userdata('first_login') == 0) {?>
	<script>
		$( document ).ready(function() {
			$('#change_pass').modal({
				backdrop: 'static',
				keyboard: false
			})
			$('#change_pass').modal('show');
		});

		$(document).on('click', '#depart_btn_continue', function() {
			$('#change_pass').hide();
			$('.modal-backdrop').hide();
		});
	</script>

	<div class="modal" id="change_pass" tabindex="-1" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="text-center"><h4>Welcome <?= $this->session->userdata('name') ?></h4></div>
					<div class="text-center text-sm p-2" style="font-size: 16px; color: red"> Note: Please Change Your Password (Mandatory)</div>
					<hr>
					<form method="post" id="change_password">
						<div class="container py-2 m-0" style="padding-left: 5%;padding-right: 5%">
							<div class="row">
								<div style="width: 35%; text-align: right">
									User name:
								</div>
								<div style="width: 60%">
									<input class="form-control" name="user_name" value="<?= $this->session->userdata('unique_user_id') ?>" readonly>
								</div>
							</div>
							<div class="row pt-2">
								<div style="width: 35%; text-align: right">
									Old Password:
								</div>
								<div style="width: 60%">
									<input type="password" class="form-control" name="old_password" value="" autocomplete="off">
									<sm id="old_password" class="error_msg" style="color: red; font-size: 13px;"></sm>
								</div>
							</div>
							<div class="row pt-2">
								<div style="width: 35%; text-align: right">
									New Password:
								</div>
								<div style="width: 60%">
									<input type="password" class="form-control" minlength="3" maxlength="12" name="new_password" value="" autocomplete="off">
									<sm id="new_password" class="error_msg" style="color: red; font-size: 13px;"></sm>
								</div>
							</div>
							<div class="row pt-2">
								<div style="width: 35%; text-align: right">
									Re-Password:
								</div>
								<div style="width: 60%">
									<input type="password" class="form-control" minlength="3" maxlength="12" name="re_password" value="" autocomplete="off">
									<sm id="re_password" class="error_msg" style="color: red; font-size: 13px;"></sm>
								</div>
							</div>
						</div>
						<div class="text-center pt-4">
							<button type="submit" id="validate_submit_btn" class="btn btn-primary rounded"> Change Password</button>
						</div>
					</form>

					<div id="validate_msg" class="text-center" style="font-weight: bold; font-size: 16px;color:green;"></div>

					<hr>
					<div style="padding-top: 10px; padding-bottom: 5px; font-size: 16px;" class="text-gray-dark text-center">
						Password should have 3 to 12 characters, at least 1 digit and 1 special character(!@#$%^&*).
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<div>
	gg
</div>


<script src="<?= base_url();?>js/home/home.js"></script>
