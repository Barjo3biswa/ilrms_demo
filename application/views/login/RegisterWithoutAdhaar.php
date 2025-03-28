<!DOCTYPE html>
<html lang="en">

<head>
	<title>ILRMS | Government of Assam</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/img/favicon.png">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style2.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/css/font-awesome.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.bxslider.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
	<!-- Script -->
	<!-- <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script> -->
	<!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script> -->
	<!-- <script src="<?php echo base_url(); ?>assets/js/jquery.bxslider.min.js"></script> -->
	<script type="text/javascript">
		$(function() {
			$(".font-button").bind("click", function() {
				var size = parseInt($('body').css("font-size"));
				if ($(this).hasClass("plus")) {
					size = size + 2;
				} else {
					size = size - 2;
					if (size <= 10) {
						size = 10;
					}
				}
				$('#content').css("font-size", size);
			});
		});
	</script>
	<!-- End Script -->
</head>
<style type='text/css'>
	#content p {
		font-size: 14px ! imporatant;
	}

	.font-button {
		height: 25px;
		width: 25px;
		display: inline-block;
		color: #fff;
		text-align: center;
		line-height: 22px;
		font-size: 15px;
		cursor: pointer;
		border: 1px solid #ffbd5f;
		border-radius: 1px;
	}

	a {
		text-decoration: none;
	}

	.languege-area .select-languege {
		float: left;
		color: #f79d1d;
		padding: 0px;
		min-width: 100px;
		font-size: 13px;
		height: 23px;
		font-weight: 800;
		letter-spacing: 1.2px;
	}
    .btn-group{
        z-index:9999 !important;
        width:650px !important;
    }
	.red {
		color: red;
		font-size: 17px !important;
		font-family: italic;
	}


	.h4Tag {
		color: #ffffff;
		background: linear-gradient(96deg, #64c11e, transparent);
		padding: 11px;
		border-radius: 7px;
	}
</style>

<!-- New Style -->
<style>
	label {
		font-weight: 400;
		color: #666;
	}

	body {
		background: #f1f1f1;
	}

	.box8 {
		box-shadow: 0px 0px 5px 1px #999;
	}

	.mx-t3 {
		margin-top: -3rem;
	}

	.form-check-label {
		margin-bottom: 7px;
		margin-left: 21px;
	}
</style>

<body>
	<!-- Start Top Nav -->
	<form id='aadhaarForm' method="POST" action="<?= AADHAARREGURL; ?>">
		<input type="hidden" name="enc_data" id="enc_data">
	</form>
	<nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="ilrms_nav_top">
		<div class="container text-light">
			<div class="w-100 d-flex justify-content-between">
				<div>
					<a><img src="<?php echo base_url(); ?>assets/img/flag.png" alt="Flag" style="color:#fff;margin-right: 5px;">GOVERNMENT OF
						ASSAM</a>
					<a><img src="<?php echo base_url(); ?>assets/img/vertical-line.png" alt="verticalline" style="color:#fff;margin-right: 5px;">Revenue
						and Disaster Management Department </a>
				</div>
				<div style="display:none;">
					<a class="font-button plus">A+</a> <a class="font-button minus">A-</a>
					<img src="<?php echo base_url(); ?>assets/img/vertical-line.png" alt="verticalline" style="color:#fff;margin-right: 5px;">
					<label class="screen-reader-text" for="lang_choice_polylang-4">Choose a language</label>
					<select name="lang_choice" id="lang_choice_polylang-4" class="select-languege">
						<option value="en">English</option>
						<option value="hi">Hindi</option>
						<option value="asm" selected="selected">Assamese</option>
						<option value="bn">Bengali</option>
					</select>
				</div>
			</div>
		</div>
	</nav>
	<!-- Close Top Nav -->

	<!-- Header -->
	<nav class="navbar navbar-expand-lg navbar-light shadow">
		<div class="container d-flex justify-content-between align-items-center">
			<div class="col-md-6 ilrms-logo">
				<p><a class="tophead pl-5" title="Government of Assam" href="#">ILRMS</a></p>
				<p title="" class="mainhead pl-5" style="font-family: Roboto,sans-serif;">Integrated Land Records Management
					System</p>
			</div>
			<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#ilrms_main_nav">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
	</nav>

	<!-- Regn Form -->
	<div class="container pt-4" style="width:65%">
			<div class="row jumbotron box8">
				<div class="col-sm-12 mx-t3 mb-4">
					<h3 class="text-center text-info">User Information</h3>
					<hr>
				</div>
					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
					<label for="w3review" style="font-weight: bold">Select District</label>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="row">
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="10" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">
								ছিৰাং ( Chirang )
								</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="06" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">
								নলবাৰী ( Nalbari )
								</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="08" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">দৰং ( Darrang )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="07" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">কামৰূপ ( Kamrup )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="33" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">নগাওঁ ( Nagaon )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="14" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">গোলাঘাট ( Golaghat )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="01" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">কোকৰাঝাৰ ( Kokrajhar )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="02" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">ধুবুৰী ( Dhubri )</label>
							</div>
							
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="03" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">গোৱালপাৰা ( Goalpara )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="05" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">বৰপেটা ( Barpeta )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="13" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">বঙাইগাঁও ( Bongaigaon )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="15" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">যোৰহাট ( Jorhat )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="17" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">ডিব্ৰুগড় ( Dibrugarh )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="21" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">করিমগঞ্জ ( Karimganj )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="24" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">কামৰূপ মহানগৰ ( Kamrup Metro )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="32" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">মৰিগাওঁ ( Morigaon )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="36" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">হোজাই ( Hojai )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="38" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">দক্ষিণ শালমাৰা ( South Salmara )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="39" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">বজালী ( Bajali )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="22" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">Hailakandi</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="23" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">Cachar</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="27" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">Udalguri</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="12" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">লক্ষীমপূৰ ( Lakhimpur )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="16" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">শিৱসাগৰ ( Sibsagar )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="18" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">তিনিচুকীয়া ( Tinsukia )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="34" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">মাজুলী ( Majuli )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="37" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">চৰাইদেউ ( Charaideo )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="11" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">শোণিতপুৰ ( Sonitpur )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="25" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">ধেমাজি ( Dhemaji )</label>
							</div>
							<div class="form-check col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<input class="form-check-input" type="checkbox" value="35" id="defaultCheck1" name="district_list">
								<label class="form-check-label" for="defaultCheck1">বিশ্বনাথ ( Biswanath )</label>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">&nbsp;</div>
						<div class="col-sm-4 form-group">
				                        <label for="w3review" style="font-weight: bold">User Type</label>
                           				 <select class="form-control " aria-label="" name="user_type" id="user_type" required>
                               					 <option disabled selected>Select User Type</option>
				                                <option value='MP'>MP</option>
                               					 <option value='MLA'>MLA</option>
				                                <option value='SDLAC'>SDLAC</option>
                            				</select>
                     					   <span id="user_typeErr" class="red"></span>
                     			        </div>
						<div class="col-sm-4 form-group">
							<label for="w3review" style="font-weight: bold">Full Name</label>
							<!-- <input type="text" class="form-control" name="name_in_aadhaar" readonly id="name_in_aadhaar" value="<?= $response->aadhaarDetail->name_eng ?>" required> -->
							<input type="text" class="form-control" name="name_in_aadhaar"  id="name_in_aadhaar" value="" required>
							<span id="name_in_aadhaarErr" class="red"></span>
						</div>

						<div class="col-sm-4 form-group">
							<label for="w3review" style="font-weight: bold">Guardian Name</label>
							<!-- <input type="text" class="form-control" name="guard_name_in_aadhaar" id="guard_name_in_aadhaar" required readonly value="<?= $response->aadhaarDetail->f_name ?>"> -->
							<input type="text" class="form-control" name="guard_name_in_aadhaar" id="guard_name_in_aadhaar" required  value="">

							<span id="guard_name_in_aadhaarErr" class="red"></span>
						</div>

						<div class="col-sm-4 form-group">
							<label for="w3review" style="font-weight: bold">Address</label>
							<!-- <input type="text" class="form-control" name="address" id="address" required value="<?= $response->aadhaarDetail->address ?>"> -->
							<input type="text" class="form-control" name="address" id="address" required value="">

							<span id="addressErr" class="red"></span>
						</div>
						<div class="col-sm-4 form-group">
							<label for="w3review" style="font-weight: bold">Email Id</label>
							<input type="email" class="form-control" name="email_id" id="email_id" required>
							<span id="email_idErr" class="red"></span>
						</div>
						<div class="col-sm-4 form-group">
							<label for="w3review" style="font-weight: bold">Mobile no.</label>
							<input type="text" class="form-control numeric" name="mobile" id="mobile" maxlength="10" minlength="10" required>
							<span id="mobileErr" class="red"></span>
						</div>

						<div class="col-sm-4 form-group">
							<label for="w3review" style="font-weight: bold">Date of Joining(DD/MM/YYYY)</label>
							<!-- <input type="date" class="form-control" name="doj" id="doj" required value="<?= $response->aadhaarDetail->dob ?>"> -->
							<input type="date" class="form-control" name="doj" id="doj" required value="">
							<span id="dojErr" class="red"></span>
						</div>


						<div class="col-sm-8 form-group">
							<label for="w3review" style="font-weight: bold">Designation</label>
							<select class="form-control" aria-label="" name="role" id="role" required>
								<option value="SDLC">SDLAC (Sub-Divisional Land Advisory Committee)</option>
							</select>
						</div>

						<div class="col-sm-4 form-group">
							<label for="w3review" style="font-weight: bold">Display Name in Minute</label>
							<input type="text" class="form-control" name="display_name" id="display_name" value="" required>
							<span id="dispaly_nameErr" class="red"></span>
						</div>


				<p class="bg-warning" style=" color: black;">Note : Please Re-Type the Password Shown Below and Make sure the User Name is Valid.</p>

				<div class="col-sm-4 form-group">
					<label for="w3review" style="font-weight: bold">User name</label>
					<input type="text" class="form-control" name="user_name" id="user_name" required>
					<span id="user_nameErr" class="red"></span>
					<!-- <input type="hidden" class="form-control" name="aadhaar_no_new" id="aadhaar_no_new" required value="<?= $response->aadhaarDetail->aadhaar_token ?>"> -->
					<input type="hidden" class="form-control" name="aadhaar_no_new" id="aadhaar_no_new" required value="">

				</div>
				<div class="col-sm-4 form-group">
					<label for="w3review" style="font-weight: bold">Password</label>
					<input type="password" onKeyUp="CheckPassword();" class="form-control" name="password" id="password" value='qwe@123' required>
				</div>
				<div class="col-sm-4 form-group">
					<label for="w3review" style="font-weight: bold">Retype Password</label>
					<input type="password" class="form-control" name="re_password" id="re_password" onKeyUp="CheckPassword();" value='qwe@123' required>
				</div>
				<div class="col-sm-4 form-group">
					<label for="w3reviewflag" style="font-weight: bold">API</label>
					<input type="text"  class="form-control" name="api" id="api" value='1' required>
				</div>
				<div style="margin-top: 18px;" id="msg"></div>

				<div class="col-sm-4 form-group mb-0">
				</div>
				<div class="col-sm-4 form-group mb-0">
					<button class="btn btn-primary float-right" id="createAadhaarAuthUser">Create User <i class="fa fa-user-plus"></i></button>
				</div>
				<div class="col-sm-4 form-group mb-0">
				</div>
			</div>
	</div>
	<!-- Regn Form End -->

	<div class="ilrms_hometext">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">

				</div>
			</div>
		</div>
	</div>
	<!---Logo Slider-->
	<div class="ilrms_logo_slider">
		<div class="container">
			<div class="bxslider logosImgs">
				<div><img src="<?php echo base_url(); ?>assets/img/mygovassam.png" alt="ClientName" title="ClientName6">
				</div>
				<div><img src="<?php echo base_url(); ?>assets/img/nic.png" alt="National Informatics Centre" title="National Informatics Centre">
				</div>
				<div><img src="<?php echo base_url(); ?>assets/img/mygovassam.png" alt="ClientName" title="ClientName6">
				</div>
				<div><img src="<?php echo base_url(); ?>assets/img/mygovassam.png" alt="My Gov Assam" title="My Gov Assam">
				</div>
				<div><img src="<?php echo base_url(); ?>assets/img/mygovassam.png" alt="ClientName" title="ClientName6">
				</div>
				<div><img src="<?php echo base_url(); ?>assets/img/nic.png" alt="National Informatics Centre" title="National Informatics Centre">
				</div>
			</div>
		</div>
	</div>
	<!--Logo Slider end-->
	<!-- Start Footer -->
	<footer class="footer-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-widget">
						<h2 class="fw-title">ILRMS</h2>
						<a href="">About ILRMS</a>
						<a href="">FAQs</a>
						<a href="">Contact Us</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="footer-widget">
						<h2 class="fw-title">Website Links</h2>
						<a href="https://landrevenue.assam.gov.in/" target="_blank">Revenue &amp; Disaster Management</a>
						<a href="https://dlrs.assam.gov.in/" target="_blank">Directorate of Land Records</a>
						<a href="https://igr.assam.gov.in/" target="_blank">Inspector General of Registration</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="footer-widget">
						<h2 class="fw-title">Important Links</h2>
						<a href="https://cm.assam.gov.in/" target="_blank">Assam CM Portal</a>
						<a href="https://assam.gov.in/" target="_blank">Assam State Portal</a>
						<a href="https://covid19.assam.gov.in/" target="_blank">Assam Covid-19 Portal</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-7">
					<div class="footer-widget">

						<a class="fw-title"><img src="<?php echo base_url(); ?>assets/img/nic_newlogo.png" alt="NIC Logo">
						</a>
						<p class="text-light">
							Designed, Developed &amp; Hosted by <a style="text-decoration: none;color:#4bcfec" rel="sponsored" href="https://assam.nic.in/" target="_blank"> National Informatics Centre, Assam</a>
						</p>
						<p class="text-light">
							Copyright &copy; <?= date('Y'); ?> Government of Assam
						</p>
					</div>
				</div>
			</div>

		</div>
		<div class="bg-black">
			<div class="container">
				<div class="col-12">
					<div class="row addpad">
						<p class="text-light text-center" style="text-decoration: none; ">
							Content Maintained &amp; Managed by: <a style="text-decoration: none;" rel="sponsored" href="https://landrevenue.assam.gov.in/" target="_blank"> &nbsp;Revenue &amp; Disater
								Management Department</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer -->



	<script src="<?= base_url(); ?>js/login/login.js"></script>
	<script src="<?= base_url(); ?>assets/js/sha512.min.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>css/sweetalert2.min.css">
	<script src="<?php echo base_url(); ?>js/sweetalert2.all.min.js"></script>


	<script>
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

		function showWarningMessage(text) {
			swal.fire({
				title: "Warning!",
				text: text,
				icon: 'warning',
				position: 'top',
				timer: 5000,
				showConfirmButton: true,
			});
		}


		// let salt = "<?= $this->session->userdata('randomKey') ?>";
		// var BASE_URL = "<?= base_url(); ?>";

		// function aadhaarLink() {
		// 	$.ajax({
		// 		url: BASE_URL + "/AadhaarAuth/ilrmsSignUp",
		// 		dataType: "JSON",
		// 		type: "POST",
		// 		success: function(data) {
		// 			$("#enc_data").val(data.data);
		// 			$("#aadhaarForm").submit();
		// 		},
		// 	});

		// }

		function CheckPassword() {
			var paswd = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
			var new_pwd = document.form.password.value;
			var retype_pwd = document.form.re_password.value;
			if (new_pwd === retype_pwd) {
				if (!retype_pwd.match(paswd)) {
					document.getElementById("msg").innerHTML = "<label for=\"inputEmail3\" class=\"col-sm-12 control-label\"><p style=\" color: #ff0000; align:center\">Password should have 8 to 12 characters, at least 1 digit and 1 special character(!@#$%^&*).</p></label>";
				} else {
					document.getElementById("msg").innerHTML = "<button type=\"button\"  id=\"btnhide\" class=\"btn btn-success\"><i class='fa fa-check'></i>&nbsp; Sign Up </button>";
				}
			} else {
				document.getElementById("msg").innerHTML = "<label for=\"inputEmail3\" class=\"col-sm-12 control-label\"><p style=\" color: #ff0000; align:center\">Password Does Not Match.</p></label>";
			}
		}

		// save new notice
		$(document).on('click', '#createAadhaarAuthUser', function() {
			var BASE_URL = "<?= base_url(); ?>";
			var dist_array = [];
			$.each($("input[name='district_list']:checked"), function() {
				dist_array.push($(this).val());
			});
			
			var string = $("#password").val();
		
			const userData = {
				district 			  : dist_array,
				user_type             : $("#user_type").val(),
				name_in_aadhaar 	  : $("#name_in_aadhaar").val(),
				guard_name_in_aadhaar : $("#guard_name_in_aadhaar").val(),
				user_name			  : $("#user_name").val(),
				email_id			  : $("#email_id").val(),
				mobile				  : $("#mobile").val(),
				aadhaar_no		      : $("#aadhaar_no_new").val(),
				cred			  	  : $('#password').val(),
				address 			  : $("#address").val(),
				doj 				  : $('#doj').val(),
				designation 		  : $('#role').val(),
				display_name 		  : $("#display_name").val(),				
				api 		  : $('#api').val(),
			};

			$.ajax({
				url: BASE_URL + "save-auth-data",
				type: "post",
				dataType: "json",
				contentType: "application/json",
				success: function(data) {
					if (data.responseType == 1) {
						data.validation.forEach(function(validation) {
							var errMsg = "#" + validation.field + "Err";
							$(errMsg).text("⚠️ " + validation.message);
						});
					} else if (data.responseType == 2) {
						swal.fire({
							title: "Success",
							text: data.msg,
							type: "success",
							icon: 'success',
							position: 'top',
						}).then(function() {
							window.location = '<?=AADHAAR_REDIRECT_URL?>';
						});
					} else {
						showErrorMessage(data.msg);
					}
				},
				data: JSON.stringify(userData)
			});
		});
	</script>

</body>

</html>
