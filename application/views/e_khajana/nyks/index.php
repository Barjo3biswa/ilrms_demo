<style>
    .green_back_ground {
        background: linear-gradient(180deg, rgb(4 24 2 / 74%) 0%, rgb(9 133 15 / 82%) 88%, rgb(25 110 10 / 58%) 100%);
    }
    .orange_back_ground{
        background: linear-gradient(180deg, rgba(163,109,7,0.7959558823529411) 0%, rgba(166,129,33,0.8239670868347339) 88%, rgba(226,187,9,0.6783088235294117) 100%);
    }
    .red_back_ground{
        background: linear-gradient(180deg, rgba(163,7,36,0.7959558823529411) 0%, rgba(166,33,58,0.8239670868347339) 88%, rgba(226,9,27,0.6783088235294117) 100%);
    }
</style>

<!-- ********************************************************** -->
<?php if ($this->session->userdata('first_login') == 0) { ?>
	<script>
		$(document).ready(function () {
			$('#change_pass').modal({
				backdrop: 'static',
				keyboard: false
			})
			$('#change_pass').modal('show');
		});

		$(document).on('click', '#depart_btn_continue', function () {
			$('#change_pass').hide();
			$('.modal-backdrop').hide();
		});
	</script>

	<div class="modal" id="change_pass" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="text-center"><h4>Welcome <?= $this->session->userdata('name') ?></h4></div>
					<div class="text-center text-sm p-2" style="font-size: 16px; color: red"> Note: Please Change Your
						Password (Mandatory)
					</div>
					<hr>
					<form method="post" id="change_password">
						<div class="container py-2 m-0" style="padding-left: 5%;padding-right: 5%">
							<div class="row">
								<div style="width: 35%; text-align: right">
									User name:
								</div>
								<div style="width: 60%">
									<input class="form-control" name="user_name"
										   value="<?= $this->session->userdata('unique_user_id') ?>" readonly>
								</div>
							</div>
							<div class="row pt-2">
								<div style="width: 35%; text-align: right">
									Old Password:
								</div>
								<div style="width: 60%">
									<input type="password" class="form-control" name="old_password" value=""
										   autocomplete="off" id="old_password">
									<sm id="old_password" class="error_msg" style="color: red; font-size: 13px;"></sm>
								</div>
							</div>
							<div class="row pt-2">
								<div style="width: 35%; text-align: right">
									New Password:
								</div>
								<div style="width: 60%">
									<input type="password" class="form-control" name="new_password" id="new_password"
										   value="" autocomplete="off">
									<sm id="new_password" class="error_msg" style="color: red; font-size: 13px;"></sm>
								</div>
							</div>
							<div class="row pt-2">
								<div style="width: 35%; text-align: right">
									Re-Password:
								</div>
								<div style="width: 60%">
									<input type="password" class="form-control" name="re_password" id="re_password"
										   value="" autocomplete="off">
									<sm id="re_password" class="error_msg" style="color: red; font-size: 13px;"></sm>
								</div>
							</div>
						</div>
						<div class="text-center pt-4">
							<button type="submit" id="validate_submit_btn" class="btn btn-primary rounded"> Change
								Password
							</button>
						</div>
					</form>

					<div id="validate_msg" class="text-center"
						 style="font-weight: bold; font-size: 16px;color:green;"></div>

					<hr>
					<div style="padding-top: 10px; padding-bottom: 5px; font-size: 16px;"
						 class="text-gray-dark text-center">
						Password should have 8 to 12 characters, at least 1 digit and 1 special character(!@#$%^&*).
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!-- ********************************************************** -->





<div class="container-fluid row">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="background-color: #ffffff !important">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
		</ol>
	</nav>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card text-white green_back_ground">
            <a href="<?php echo base_url() . 'patta-type-wise' ?>">
                <div class="card-body text-white">
                    <h5 class="card-title">
                        <img src="<?= base_url() . 'assets/img.png' ?>"style="height:30px;width:30px;" alt="Total State Dag">
                        Total registered Application
                    </h5>
                </div>
                <div class="card-footer">
                    <small class="text-white"> Cases:
                        <span style="font-size: 20px">
                            <?=$nyks_registered_applications?></span>
                    </small>
                </div>
                <div class="card-footer"><small class="text-white"></small></div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card text-white orange_back_ground">
            <a href="<?php echo base_url() . 'patta-type-wise' ?>">
                <div class="card-body text-white">
                    <h5 class="card-title">
                        <img src="<?= base_url() . 'assets/img.png' ?>"style="height:30px;width:30px;" alt="Total State Dag">
                        Total Rejected Application
                    </h5>
                </div>
                <div class="card-footer">
                    <small class="text-white"> Cases:
                        <span style="font-size: 20px">
                            <?=$nyks_rejected_applications?></span>
                    </small>
                </div>
                <div class="card-footer"><small class="text-white"></small></div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card text-white red_back_ground">
            <a href="<?php echo base_url() . 'patta-type-wise' ?>">
                <div class="card-body text-white">
                    <h5 class="card-title">
                        <img src="<?= base_url() . 'assets/img.png' ?>"style="height:30px;width:30px;" alt="Total State Dag">
                        Total Disposed Application
                    </h5>
                </div>
                <div class="card-footer">
                    <small class="text-white"> Cases:
                        <span style="font-size: 20px">
                            <?=$nyks_disposed_applications?></span>
                    </small>
                </div>
                <div class="card-footer"><small class="text-white"></small></div>
            </a>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>js/home/home.js"></script>
<script src="<?= base_url(); ?>assets/js/sha512.min.js"></script>