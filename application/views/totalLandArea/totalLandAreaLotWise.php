<style>
	.dt-button {
		background-color: #00e676 !important;
		padding: 5px 20px !important;
		border-radius: 5px;
	}
</style>
<link href="<?=base_url();?>assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet">

<div id="displayBox" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif"></div>
<script src="<?php echo base_url(); ?>application/views/js/blockUI.js"></script>
<script>
	document.onreadystatechange = function(e)
	{
		$.blockUI({
			message: $('#displayBox'),
			css: {
				border:'none',
				backgroundColor:'transparent'
			}
		});
	};
	window.onload = function(){
		$.unblockUI();
	}
</script>

<div class="row">
	<div class="col-lg-10">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb p-3 text-white">
				<li class="breadcrumb-item font-weight-bold"><a href="<?= base_url().'dashboard'?>">Number of Dags</a></li>
				<li class="breadcrumb-item font-weight-bold active" aria-current="page">Lot Wise</li>
			</ol>
		</nav>
	</div>
	<div class="col-lg-2 pull-right">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb p-3 text-white">
				<li class="breadcrumb-item font-weight-bold">
					<a href="<?= base_url().'total-land-area-circle-wise/'.$lotDagArea[0]->dist_code ?>">
						<button class="btn btn-sm btn-warning">
							<i class="fa fa-backward"></i>&nbsp;Back</button>
					</a>
				</li>
			</ol>
		</nav>

	</div>
</div>

<div class="p-2 bg-primary text-center text-white h5 shadow-sm border border-white rounded"><b>Dag Area Details Lot Wise ( <?= $this->utilityclass->dist_name($lotDagArea[0]->dist_code) ?> জিলা )</b>
</div>
<div class="panel panel-info panel-form">
	<div class="tab-content">
		<div class="card-body">
			<table class="table table-hover text-center tab1">
				<thead>
				<tr style="background-color: #136a6f; color: #fff;">
					<td width="10%">Sl No.</td>
					<td width="15%">Circle Name</td>
					<td width="15%">Mouza Name</td>
					<td width="15%">Lot Name</td>
					<?php if(in_array($lotDagArea[0]->dist_code, BARAK_VALLEY)): ?>
						<td width="25%">Bigha-Katha-Chatak-Ganda-Kranti</td>
					<?php else: ?>
						<td width="25%">Bigha-Katha-Lessa</td>
					<?php endif; ?>
					<td style="text-align: center; width: 15%">Action</td>
				</tr>
				</thead>
				<tbody>
				<?php $i =1;
				foreach($lotDagArea as $key=>$row) : ?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $this->utilityclass->cir_name($row->dist_code,$row->subdiv_code,$row->cir_code) ?></td>
						<td><?= $this->utilityclass->mouza_name($row->dist_code,$row->subdiv_code,$row->cir_code,$row->mouza_pargona_code) ?></td>
						<td><?= $this->utilityclass->lot_name($row->dist_code,
									$row->subdiv_code,$row->cir_code,$row->mouza_pargona_code,$row->lot_no) ?></td>
						<?php if(in_array($row->dist_code, BARAK_VALLEY)): ?>
							<td>B: <?= round($row->bigha,2) ?> -
								K: <?= round($row->katha,2) ?> -
								C: <?= round($row->lessa,2) ?> -
								G: <?= round($row->ganda,2) ?> -
								Kr: <?= round($row->kranti,2) ?>
							</td>
						<?php else: ?>
							<td>B: <?= round($row->bigha,2) ?> -
								K: <?= round($row->katha,2) ?> -
								L: <?= round($row->lessa,2) ?>
							</td>
						<?php endif; ?>

						<td align="center">
							<a href="<?php echo base_url().'total-land-area-village-wise?dist_code='.$row->dist_code.'&subdiv='.$row->subdiv_code.'&cir_code='.$row->cir_code.'&mouza='.$row->mouza_pargona_code.'&lot_no='.$row->lot_no?>">
								<button type="button" class="btn btn-info btn-sm">
									<i class="fa fa-eye"></i>&nbsp;View
								</button>
							</a>
						</td>
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
