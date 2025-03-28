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
				<li class="breadcrumb-item font-weight-bold"><a href="<?= base_url() . 'patta-type-district-wise' ?>">
						Patta Type Wise</a></li>
				<li class="breadcrumb-item font-weight-bold active text-red"
					aria-current="page">Patta Type Circle Wise / <?= $this->utilityclass->dist_name(basename($_SERVER['REQUEST_URI'])); ?>
				</li>
			</ol>
		</nav>
	</div>
	<div class="col-lg-2 pull-right">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb p-3 text-white">
				<li class="breadcrumb-item font-weight-bold">
					<a href="<?= base_url() . 'patta-type-district-wise' ?>">
						<button class="btn btn-sm btn-warning">
							<i class="fa fa-backward"></i>&nbsp;Back
						</button>
					</a>
				</li>
			</ol>
		</nav>

	</div>
</div>


<div class="panel panel-info panel-form">
	<div class="tab-content">
		<div class="card-body">
			<table class="table table-hover text-center tab1" id="tab">
				<thead>
				<tr style="background-color: #136a6f; color: #fff;">
					<td width="15%">SL No.</td>
					<td width="25%">Circle Name</td>
					<td width="25%">Patta Type Name</td>
					<td width="15%">No of Patta(s)</td>
				</tr>
				</thead>
				<tbody>
				<?php
				$i = 1;
				foreach ($circlePattaCount as $key1 => $row1) :
					?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= $this->utilityclass->cir_name($row1->dist_code,$row1->subdiv_code,$row1->cir_code) ?></td>
						<td><?= $this->utilityclass->getPatta_type($row1->dist_code, $row1->patta_type); ?></td>
						<td><?= $row1->totalpatta ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/datatables/buttons.dataTables.min.css">
<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/buttons.html5.min.js"></script>

<script type="text/javascript">
	$(".tab1").DataTable({
		dom: 'Bfrtp',
		pageLength: 50,
		buttons: [
			'pageLength',
			'excel'
		]
	});
</script>
