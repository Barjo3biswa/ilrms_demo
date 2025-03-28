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
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/css/font-awesome.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.bxslider.css">
	<!-- Script -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.bxslider.min.js"></script>
	<script type="text/javascript">
		$(function () {
			$(".font-button").bind("click", function () {
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

	.red {
		color: red;
		font-size: 17px !important;
		font-family: italic;
	}
	.p-viewer{
		float: right;
		margin-top: -44px;
		position: relative;
		z-index: 1;
		cursor:pointer;
		margin-right: 10px;
		}

</style>
<body>
<!-- Start Top Nav -->
<nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="ilrms_nav_top">
	<div class="container text-light">
		<div class="w-100 d-flex justify-content-between">
			<div>
				<a><img src="<?php echo base_url(); ?>assets/img/flag.png" alt="Flag"
						style="color:#fff;margin-right: 5px;">GOVERNMENT OF
					ASSAM</a>
				<a><img src="<?php echo base_url(); ?>assets/img/vertical-line.png" alt="verticalline"
						style="color:#fff;margin-right: 5px;">Revenue
					and Disaster Management Department </a>
			</div>
			<div style="display:none;">
				<a class="font-button plus">A+</a> <a class="font-button minus">A-</a>
				<img src="<?php echo base_url(); ?>assets/img/vertical-line.png" alt="verticalline"
					 style="color:#fff;margin-right: 5px;">
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
		<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
				data-bs-target="#ilrms_main_nav">
			<span class="navbar-toggler-icon"></span>
		</button>
	</div>
</nav>
<div class="ilrms_belowbanner">
	<div class="row justify-content-center m-5">
		<div class="col-md-8 col-sm-11 col-lg-6 col-xl-5  col-xxl-4">
			<div class="wrap">
				<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active" data-bs-interval="10000">
							<img src="<?php echo base_url(); ?>assets/img/01.png" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src="<?php echo base_url(); ?>assets/img/02.png" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item" data-bs-interval="2000">
							<img src="<?php echo base_url(); ?>assets/img/03.png" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src="<?php echo base_url(); ?>assets/img/04.png" class="d-block w-100" alt="...">
						</div>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</a>
				</div>
				<div class="login-wrap pt-4 px-md-5">
					<div class="d-flex">
						<div class="w-100">
							<h3 class="mb-2">Log In</h3>
						</div>
					</div>
					<form id='login_form' method="POST" class="signin-form">
						<input id="otp_login" name="otp_login" value="<?=ENABLE_OTP_AUTHENTICATION ?>" type="hidden" readonly>
						<div class="form-group mt-3">
							<input type="text" name="uname" class="form-control" placeholder="User Name" required>
						</div>
						<div class="form-group">
							<input id="password-field" type="password" name="password" placeholder="Password" class="form-control" required><i class="p-viewer toggle-hide-show fa fa-fw fa-eye-slash"></i>
						</div>
						<marquee><span style="text-align:center;color:red">In case of Mouzadar Login, Please Contact Concerned Circle Officer For Password Reset </span></marquee>

						<div class="form-inline">
							<img src="<?php echo base_url();?>index.php/LoginController/getCaptcha" id="capt" width="40%">
							<span class="py-x text-center" style='width:10%;'><i class="fa fa-refresh" id='refreshCaptcha'></i></span>
							<input type="text" class="form-control d-inline" style='width:50%;inline:center' name="captcha"
								   placeholder="Type captcha.." required>
						</div>
						<span id="btnImageloading"></span>
						<span id="error" class="text-sm red"></span>
						<div class="form-group">
							<button type="submit" class="form-control btn btn-primary rounded submit px-3">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

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
			<div><img src="<?php echo base_url(); ?>assets/img/nic.png" alt="National Informatics Centre"
					  title="National Informatics Centre">
			</div>
			<div><img src="<?php echo base_url(); ?>assets/img/mygovassam.png" alt="ClientName" title="ClientName6">
			</div>
			<div><img src="<?php echo base_url(); ?>assets/img/mygovassam.png" alt="My Gov Assam" title="My Gov Assam">
			</div>
			<div><img src="<?php echo base_url(); ?>assets/img/mygovassam.png" alt="ClientName" title="ClientName6">
			</div>
			<div><img src="<?php echo base_url(); ?>assets/img/nic.png" alt="National Informatics Centre"
					  title="National Informatics Centre">
			</div>
		</div>
	</div>
</div>

	<!-- OTP Verify Modal -->
	<?php if(ENABLE_OTP_AUTHENTICATION == 1) { ?>
	<div class="modal fade" id="otpVerifyModal" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title">OTP Verification </h5> 
            </div>
            <form id="quickForm" action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
				<p class="text-danger">Enter the 6-digit OTP that was sent to your phone number <small id="mobileNumber"></small></p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>OTP *</label>
                                <input type="number" id="login_otp" name="login_otp" class="form-control" placeholder="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "6" required autofocus>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="otp_verify_login" class="btn btn-primary">Verify & Login</button>
                </div>
            </form>
          </div>
        </div>
	</div>
	<?php } ?>
	<!-- OTP Verify Modal End-->

	<!-- Mobile No Update Modal -->
	<div class="modal fade" id="mobileNoUpdateModal" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog">
          <div class="modal-content" style="width: 700px;margin-left: -78px;">
            <div class="modal-header bg-success">
              <h5 class="modal-title" style="color: #fff;">Update your Details before login to the portal</h5>
            </div>
			<form id="updateMobileForm" action="" method="POST">
				<p style="font-weight: bold;">Note : Mobile no should be active during the period of login access.</p>
                <div class="modal-body">
					<div class="row">
						<div class="col-md-8" id= "enter_name_user_div">
							<div class="form-group">
								<label>Enter Your Name</label>
								<input type="text" id="name_user" name="name_user" class="form-control" placeholder="" required>
							</div> 
						</div>
						<div class="col-md-8" id= "enter_email_id_div">
							<div class="form-group">
								<label>Enter Email ID</label>
								<input type="text" id="email_id" name="email_id" class="form-control" placeholder="" required>
							</div> 
						</div>
						<div class="col-md-8" id= "enter_address_div">
							<div class="form-group">
								<label>Enter Address</label>
								<input type="text" id="address" name="address" class="form-control" placeholder="" required>
							</div> 
						</div>
						<div class="col-md-8" id= "enter_mobile_no_div">
							<div class="form-group">
								<label>Enter Mobile No</label>
								<input type="number" id="mobile_no" name="mobile_no" class="form-control" placeholder="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" min="0" required autofocus>
							</div> 
						</div>
						<div class="col-md-4" id= "get_otp_div">
							<div class="form-group">
								<label>&nbsp;</label>
								<button type="button" id="btn-get-otp" class="btn btn-warning btn-block">Get OTP</button> 
							</div> 
						</div>
					</div>
					<div class="row">
						<div class="col-md-8" id= "verify_otp_div" style="display: none;">
							<div class="form-group">
								<label>Enter OTP</label>
								<input type="number" id="otp_no" name="otp_no" class="form-control" placeholder="" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="6" min="0" required autofocus>
							</div> 
						</div> 
						<!-- <div class="col-md-4" >
							<div class="form-group">
								<button type="button" id="btn-resend-otp" class="btn btn-danger">Resend</button> 
							</div> 
						</div> -->
					</div>
                </div>
                <div class="modal-footer justify-content-between" id="verify_otp_btn" style="display: none;">
					<button type="button" id="btn-submit-otp" class="btn btn-success">Verify & Update</button> 
                </div>
            </form>
          </div>
        </div>
	</div>
	<!-- Mobile No Update Modal End-->

<script>
	jQuery(".toggle-hide-show").click(function() {
    jQuery(this).toggleClass("fa-eye fa-eye-slash");
    input = jQuery(this).parent().find("input");
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
</script>
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
					<a href="">Contact Us</a></div>
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
						Designed, Developed &amp; Hosted by <a style="text-decoration: none;color:#4bcfec"
															   rel="sponsored" href="https://assam.nic.in/"
															   target="_blank"> National Informatics Centre, Assam</a>
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
						Content Maintained &amp; Managed by: <a style="text-decoration: none;"
																rel="sponsored"
																href="https://landrevenue.assam.gov.in/"
																target="_blank"> &nbsp;Revenue &amp; Disater
							Management Department</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- End Footer -->
<script>
	let salt = "<?= $this->session->userdata('randomKey')?>";
</script>
<script src="<?= base_url();?>js/login/login.js"></script>
<script src="<?= base_url();?>assets/js/sha512.min.js"></script>
</body>
</html>
