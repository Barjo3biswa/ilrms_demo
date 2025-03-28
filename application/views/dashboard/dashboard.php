<style type="text/css">
	.div_dash {
		border: 1px solid rgba(0, 0, 0, 0.125);
		/*box-shadow: 10px 10px 10px grey;*/
		margin: 10px;
		/*margin-left: 40px;*/
		border-radius: 5px 5px;
		background: linear-gradient(to right, #7b4397, #dc2430);
		/*background-color: #20B2AA;*/
	}

	.div_inner {
		padding: 10px;
	}

	.purecounter {
		font-weight: bold;
		font-size: 25px;
		color: #fff;
		padding-left: 30px;
	}

	.purecounter p {
		margin-bottom: 0px;
	}

	.title {
		font-size: 18px;
		color: #fff;
	}

	.div_dash:hover {
		/*background: yellow;*/
		transform: scale(1.05);
	}
</style>

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

<div class="p-2 bg-success text-center text-white h5 shadow-sm border border-white rounded"><b>Dharitree Dashboard</b>
</div>
<div class="mt-2 p-2 bg-secondary text-center text-white h6 shadow-sm border border-white rounded"><b>Data Last Updated
		At : <?= date("F j, Y  H:i", strtotime($state[0]->created_at)); ?></b></div>
<div class="container-fluid">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb" style="background-color: #ffffff !important">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
		</ol>
	</nav>
	<div class="dash_content_area">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="row">
				<?php
				if ($state != null) {
					$row = json_decode($state[0]->statewise_json);
					?>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="card bg-danger text-white">
							<a href="<?php echo base_url() . 'number-of-dags-district-wise' ?>">
								<div class="card-body text-white">
									<h5 class="card-title">
										<img src="<?= base_url() . 'assets/img.png' ?>"
																style="height:30px;width:30px;" alt="Total State Dag">
										Total State Dag </h5>
								</div>
								<div class="card-footer">
									<small class="text-white"> Cases:
										<span style="font-size: 20px"><?= $row->total_state_dag ?></span>
									</small>
								</div>
								<div class="card-footer"><small class="text-white"></small></div>
							</a>
						</div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="card bg-warning text-white">
							<a href="<?php echo base_url() . 'total-land-area-brahmaputra-valley-district-wise' ?>">
								<div class="card-body text-white">
									<h5 class="card-title">
										<img src="<?= base_url() . 'assets/img.png' ?>"
																style="height:30px;width:30px;" alt="Total State Dag">
										Total Brahmaputra Valley Land Area </h5>
								</div>
								<div class="card-footer">
									<small class="text-white">
										<span class="" style="font-size: 20px">
										B : <?= $row->brahmaputra_valley->total_state_area_bigha ?> , K :
										<?= $row->brahmaputra_valley->total_state_area_katha ?> , L :
										<?= round($row->brahmaputra_valley->total_state_area_lessa, 2) ?>
										</span>
									</small>
								</div>
								<div class="card-footer"><small class="text-white"></small></div>
							</a>
						</div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="card bg-info text-white">
							<a href="<?php echo base_url() . 'total-land-area-barak-valley-district-wise' ?>">
								<div class="card-body text-white">
									<h5 class="card-title">
										<img src="<?= base_url() . 'assets/img.png' ?>"
																style="height:30px;width:30px;" alt="Total State Dag">
										Total Barak Valley Land Area
									</h5>
								</div>
								<div class="card-footer">
									<small class="text-white">
										<span class="" style="font-size: 20px">
											B : <?= $row->barak_valley->total_state_area_bigha ?> , K :
											<?= $row->barak_valley->total_state_area_katha ?> , S :
											<?= round($row->barak_valley->total_state_area_lessa, 2) ?>, G:
											<?= round($row->barak_valley->total_state_area_ganda, 2) ?>
										</span>
									</small>
								</div>
								<div class="card-footer"><small class="text-white"></small></div>
							</a>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="card bg-success text-white">
							<a href="<?php echo base_url() . 'patta-type-wise' ?>">
								<div class="card-body text-white">
									<h5 class="card-title">
										<img src="<?= base_url() . 'assets/img.png' ?>"
																style="height:30px;width:30px;" alt="Total State Dag">
										Total State Patta
									</h5>
								</div>
								<div class="card-footer">
									<small class="text-white"> Cases:
										<span style="font-size: 20px">
											<?= $row->total_state_patta ?></span>
									</small>
								</div>
								<div class="card-footer"><small class="text-white"></small></div>
							</a>
						</div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="card bg-primary text-white">
							<a href="<?php echo base_url() . 'total-pattadar-district-wise' ?>">
								<div class="card-body text-white">
									<h5 class="card-title">
										<img src="<?= base_url() . 'assets/img.png' ?>"
																style="height:30px;width:30px;" alt="Total State Dag">
										Total State Pattadar
									</h5>
								</div>
								<div class="card-footer">
									<small class="text-white"> Cases:
										<span style="font-size: 20px"><?= $row->total_state_pattadar ?></span>
									</small>
								</div>
								<div class="card-footer"><small class="text-white"></small></div>
							</a>
						</div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="card bg-danger text-white">
							<a href="<?php echo base_url() . 'zonal-value-dag-village-wise' ?>">
								<div class="card-body text-white">
									<h5 class="card-title">
										<img src="<?= base_url() . 'assets/img.png' ?>"
											 style="height:30px;width:30px;" alt="Total State Dag">
										State Zonal Value
									</h5>
								</div>
								<div class="card-footer">
									<small class="text-white"> Dags Updated:
										<span style="font-size: 20px"><?= $row->total_zonal_dags ?>,</span>
									</small>
									<small class="text-white"> Village Updated:
										<span style="font-size: 20px"><?= $row->total_zonal_village ?></span>
									</small>
								</div>
								<div class="card-footer"><small class="text-white"></small></div>
							</a>
						</div>
					</div>

					<div class=" col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="card text-white" style="background-color:#8153c4 !important">
							<a href="<?php echo base_url() . 'village-land-bank-district-wise' ?>">
								<div class="card-body text-white">
									<h5 class="card-title">
										<img src="<?= base_url() . 'assets/img.png' ?>"
											 style="height:30px;width:30px;" alt="Total State Dag">
										Village Land Bank
									</h5>
								</div>
								<div class="card-footer bg-black text-white">
									<small class="text-white"> Dags Approved:
										<span style="font-size: 20px"><?= $row->total_vlb_dags ?>,</span>
									</small>
									<small class="text-white"> Village Approved:
										<span style="font-size: 20px"><?= $row->total_vlb_village ?>,</span>
									</small>
									<small class="text-white"> Pending With CO:
										<span style="font-size: 20px"><?= $row->total_vlb_dags_pending_with_co ?></span>
									</small>
								</div>
								
							</a>
						</div>
					</div>

					<div class=" col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="card text-white" style="background-color:#8e8f8f !important">
							<a href="<?php echo base_url() . 'khatian-district-wise' ?>">
								<div class="card-body text-white">
									<h5 class="card-title">
										<img src="<?= base_url() . 'assets/img.png' ?>"
											 style="height:30px;width:30px;" alt="Total State Dag">
										Khatian
									</h5>
								</div>
								<div class="card-footer bg-black text-white">
									<small class="text-white"> Pending With CO:
										<span style="font-size: 20px"><?= $row->total_khatian_pending_with_co ?>,</span>
									</small>
									<small class="text-white"> Approved By CO:
										<span style="font-size: 20px"><?= $row->total_khatian_approved_by_co ?>,</span>
									</small>
									<small class="text-white"> Total Rayati:
										<span style="font-size: 20px"><?= $row->total_khatian_rayati ?></span>
									</small>
								</div>
								
							</a>
						</div>
					</div>


				<?php } ?>

			</div> <!---// end of class row ---->
		</div> <!---// end of class col-lg-12 col-md-12 col-sm-12 col-xs-12 ---->
	</div> <!---// end of class dash_content_area ---->
</div> <!---// end of class container-fluid ---->

<script src="<?= base_url(); ?>js/home/home.js"></script>
<script src="<?= base_url(); ?>assets/js/sha512.min.js"></script>

