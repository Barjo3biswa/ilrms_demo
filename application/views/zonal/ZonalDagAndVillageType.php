<style>
	.dt-button {
		background-color: #00e676 !important;
		padding: 5px 20px !important;
		border-radius: 5px;
	}
</style>
<link href="<?= base_url(); ?>assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet">
<div id="displayBox" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif"></div>
<script src="<?php echo base_url(); ?>application/views/js/blockUI.js"></script>
<script>
	document.onreadystatechange = function (e) {
		$.blockUI({
			message: $('#displayBox'),
			css: {
				border: 'none',
				backgroundColor: 'transparent'
			}
		});
	};
	window.onload = function () {
		$.unblockUI();
	}
</script>

<div class="row">
	<div class="col-lg-10">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb p-3 text-white">
				<li class="breadcrumb-item font-weight-bold"><a href="<?= base_url() . 'dashboard' ?>">Dashboard</a></li>
				<li class="breadcrumb-item font-weight-bold active text-red"
					aria-current="page">Zonal Dag & Village Wise
				</li>
			</ol>
		</nav>
	</div>
	<div class="col-lg-2 pull-right">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb p-3 text-white">
				<li class="breadcrumb-item font-weight-bold">
					<a href="<?= base_url() . 'dashboard' ?>">
						<button class="btn btn-sm btn-warning">
							<i class="fa fa-backward"></i>&nbsp;Back
						</button>
					</a>
				</li>
			</ol>
		</nav>

	</div>
</div>
<div class="p-2 bg-primary text-center text-white h5 shadow-sm border border-white rounded"><b>Zonal Info</b>
</div>

<div class="panel panel-info panel-form">
	<div class="tab-content">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

					<div class="card bg-danger text-white">
						<a href="<?php echo base_url() . 'zonal-dag-district-wise' ?>">
							<div class="card-body text-white">
								<h5 class="card-title">
									<img src="<?= base_url() . 'assets/img.png' ?>"
										 style="height:30px;width:30px;" alt="Total State Dag"> Dag Wise Zonal Info
								</h5>
							</div>
							<div class="card-footer">
								<small class="text-white"> Cases: <span class="" style="font-size: 20px">
										<?= $districtZonal->total_zonal_dags ?></span>
								</small>
							</div>
							<div class="card-footer"><small class="text-white"></small></div>
						</a>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="card bg-primary text-white">
						<a href="<?php echo base_url() . 'zonal-village-district-wise' ?>">
							<div class="card-body text-white">
								<h5 class="card-title">
									<img src="<?= base_url() . 'assets/img.png' ?>"
										 style="height:30px;width:30px;" alt="Total State Dag"> Village Wise Zonal Info
								</h5>
							</div>
							<div class="card-footer">
								<small class="text-white"> Cases: <span class="" style="font-size: 20px">
										<?= $districtZonal->total_zonal_village ?>
									</span>
								</small>
							</div>
							<div class="card-footer"><small class="text-white"></small></div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

