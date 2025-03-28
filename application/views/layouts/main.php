<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>ILRMS Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="Government of Assam ILRMS Dashboard. Application for Integrated Land Records Management System">
	<meta name="keywords" content="NOC, Dharitree, Bhunaksha, epanjeeyan, NIC, National Informatics Centre, ILRMS, Integrated Land Records Management System, NIC Assam State Centre, Government of Assam, Revenue and Disaster Management Department Assam, Revenue Department Assam">
	<meta name="author" content="National Informatics Centre Assam">
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="assets/favicon.png" />
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="<?php echo base_url('css/styles.css'); ?>" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url('fonts/css/font-awesome.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/department_style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/dataTables.jqueryui.css">

	<script src="<?php echo base_url('js/jquery-3.4.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('js/block_ui.js'); ?>"></script>
	<script src="<?php echo base_url('js/chart.js'); ?>"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style type="text/css">
	.dropdown-menu-right {
		right: 0;
		left: auto;
	}

	a {
		text-decoration: none !Important;
	}

	.loader {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url('<?php echo base_url(); ?>assets/spin.gif') 50% 50% no-repeat rgb(249, 249, 249);
		opacity: .9;
	}

	.menu_btn {
		background: #3cecec;
		color: #423a3a !important;
		font-weight: 600;
		padding: .375rem 1.5rem;
		font-size: 17px;
	}

	.menu_btn:hover {
		background: #056666;
		color: #eee !important;
	}

	table.dataTable tbody th,
	table.dataTable tbody td {
		font-size: 1.1em !important
	}
</style>

<body>
	<!-- <div class="loader"></div>  -->
	<!-- Start Top Nav -->
	<form id='aadhaarForm' method="POST" action="<?= AADHAARREGURL; ?>">
		<input type="hidden" name="enc_data" id="enc_data">
	</form>
	<nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="ilrms_nav_top">
		<div class="container text-light">
			<div class="w-100 d-flex justify-content-between">
				<div>
					<a><img src="<?php echo base_url('assets/flag.png'); ?>" alt="Flag" style="color:#fff;margin-right: 5px;">GOVERNMENT OF ASSAM</a>
					<a><img src="<?php echo base_url('assets/vertical-line.png'); ?>" alt="verticalline" style="color:#fff;margin-right: 5px;">Revenue &amp; Disaster Management </a>
				</div>
				<div>
					<a href="govindex.html" target="_blank" class="gov_login_switch" style="text-decoration: none;"></a>
				</div>
			</div>
		</div>
	</nav>
	<nav class="navbar navbar-expand-lg navbar-light" id="logo_nav_bar">
		<div class="container d-flex justify-content-between align-items-center">
			<div class="col-md-6 ilrms-logo">
				<p><a class="tophead" title="Government of Assam" href="citizenindex.html">ILRMS</a></p>
				<p title="" class="mainhead">Integrated Land Records Management System</p>
			</div>
			<!-- <button class="navbar-toggler border-0" type="button" data-toggle="collapse"
				data-target="#ilrms_main_nav">
			<span class="navbar-toggler-icon"></span>
		</button> -->
			<div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="ilrms_main_nav">
				<!-- <div class="flex-fill">
				<ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
					<li class="nav-item">
						<a class="nav-link" href="https://basundhara.assam.gov.in/"> Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://basundhara.assam.gov.in/about"> About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://basundhara.assam.gov.in/document"> Documents</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://basundhara.assam.gov.in/contact"> Contact</a>
					</li>
				</ul>
			</div> -->

			</div>

		</div>
	</nav>
	<div class="d-flex" id="wrapper">
		<?php include('menu.php'); ?>

		<div id="page-content-wrapper">
			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<div class="container-fluid">
					<button onclick="myFunction(this)" class="btn ban_button" id="sidebarToggle">
						<div class="bar1"></div>
						<div class="bar2"></div>
						<div class="bar3"></div>
					</button>

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

                   <?php if ($this->session->userdata('designation') == DLR || $this->session->userdata('designation') == 'NIC' || $this->session->userdata('designation') == ADLR || $this->session->userdata('designation') == JDS){ ?>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mt-2 mt-lg-0" style="margin-left: 10px">
							<li class="nav-item dropdown">
								<a class="btn btn-warning menu_btn" href="<?= base_url() . "dashboard" ?>">
									Dharitree
								</a>
							 </li>
                            <li class="nav-item dropdown">
                                <form action="http://164.100.149.226" method="post">
                                  <input type="hidden" name="token" value="<?php // echo $token?>">
                                  <button type="submit" class="btn btn-warning menu_btn" style="margin-left: 10px">NOC</button>
                                </form>
                            </li>
							<li class="nav-item dropdown">
                                <form action="<?=BHUNAKSHA_DASHBOARD?>" method="get">
                                  <input type="hidden" name="token" value="<?php echo $this->TokenModel->getTokenforDashboardForBhunaksha()?>">
                                  <button type="submit" class="btn btn-warning menu_btn" style="margin-left: 10px">Bhunaksha Dashboard</button>
                                </form>
                            </li>
                            <input type="hidden" id="logged_in" value="<?= $this->session->userdata('logged_in') ?>">
						</ul>
					</div>
                    <?php }?>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ms-auto mt-2 mt-lg-0">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account Settings</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="#!">Notifications</a>
									<a class="dropdown-item" href="<?= base_url() ?>user-profile">Account Profile</a>
									<a class="dropdown-item" style="cursor: pointer" onclick="aadhaarLink();">Link Your Aadhaar</a>
									<a class="dropdown-item" style="cursor: pointer" href="<?php echo base_url() ?>index.php/Dsc/dSignDetails"> NICDSign Config Details</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="<?= base_url() ?>logout">Logout</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</nav>

			<!-- **************************************************************** -->
			<div id="displayBox" style="display: none;">
				<img src="<?php echo base_url('assets/loader1.gif'); ?>" style="width: 80px;">
			</div>
			<div class='col-lg-12' style=''>
				<?php
				if (isset($_view) && $_view)
					$this->load->view($_view);
				?>
			</div>
		</div>

	</div>
	<footer class="footer-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<!-- <div class="footer-widget">
					<h2 class="fw-title">ILRMS</h2>
					<a href="">About ILRMS</a>
					<a href="">FAQs</a>
					<a href="">Contact Us</a>
				</div> -->
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

						<a class="fw-title">
							<img src="<?php echo base_url('assets/nic_newlogo.png'); ?>" alt="NIC Logo">
						</a>
						<p class="text-light">
							Designed, Developed &amp; Hosted by <a style="text-decoration: none;color:#4bcfec" rel="sponsored" href="https://assam.nic.in/" target="_blank"> National Informatics Centre, Assam</a>
						</p>
						<p class="text-light" style="font-size: 14px;">
							Copyright &copy; 2021 Government of Assam
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-black">
			<div class="container">
				<div class="col-12">
					<div class="row addpad">
						<p class="text-light" style="text-align: center;">
							Content Maintained &amp; Managed by: <a style="text-decoration: none; text-align: center;" rel="sponsored" href="https://landrevenue.assam.gov.in/" target="_blank"> &nbsp;Revenue &amp; Disaster Management
								Department</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<script src="<?php echo base_url('js/bootstrap.bundle.min.js'); ?>"></script>
	<!-- Core JS-->
	<script src="<?php echo base_url('js/scripts.js'); ?>"></script>
	<!-- Additional JS-->
	<script src="<?php echo base_url('js/ban.js'); ?>"></script>

	<script src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>css/sweetalert2.min.css">
	<script src="<?php echo base_url(); ?>js/sweetalert2.all.min.js"></script>



	<script type="text/javascript">
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
	</script>
	<script>
		let salt = "<?= $this->session->userdata('randomKey') ?>";
		var BASE_URL = "<?= base_url(); ?>";

		function aadhaarLink() {
			$.ajax({
				url: BASE_URL + "link-account-with-aadhaar",
				dataType: "JSON",
				type: "POST",
				success: function(data) {

					if (data.responseType == 2) { // if false
						showSuccessMessage(data.message);
					} else {
						$("#enc_data").val(data.data);
						$("#aadhaarForm").submit();
					}
				},
			});

		}
	</script>
</body>

</html>
