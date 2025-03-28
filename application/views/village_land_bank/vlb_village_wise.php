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
                <li class="breadcrumb-item font-weight-bold"><a href="<?= base_url().'dashboard'?>">Dashboard</a></li>
				<li class="breadcrumb-item font-weight-bold"><a href="<?= base_url().'village-land-bank-district-wise'?>">Land Bank Info District Wise</a></li>
				<li class="breadcrumb-item font-weight-bold"><a href="<?= base_url().'village-land-bank-circle-wise'.'/'.$villageWiseVlbCounts[0]->district_code?>">Circle Wise Village Land Bank Info</a></li>
				<li class="breadcrumb-item font-weight-bold active" aria-current="page">
					Village Land Bank Village Wise Info</li>
			</ol>
		</nav>
	</div>
	<div class="col-lg-2 pull-right">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb p-3 text-white">
				<li class="breadcrumb-item font-weight-bold">
					<a href="<?= base_url().'village-land-bank-circle-wise'.'/'.$villageWiseVlbCounts[0]->district_code?>">
						<button class="btn btn-sm btn-warning">
							<i class="fa fa-backward"></i>&nbsp;Back</button>
					</a>
				</li>
			</ol>
		</nav>

	</div>
</div>
<div class="p-2 bg-primary text-center text-white h5 shadow-sm border border-white rounded"><b>Village Land Bank Info Village Wise</b>
</div>

<div class="panel panel-info panel-form">
	<div class="tab-content">
		<div class="card-body">
			<table class="table table-hover text-center tab1">
				<thead>
				<tr style="background-color: #136a6f; color: #fff;">
					<td width="10%">Sl No.</td>
					<td width="15%">Circle Name</td>
					<td width="15%">Village Name</td>
					<td width="15%">Total Govt Dags(s)</td>
                    <td width="15%">Approved By CO Dags(s)</td>
					<td width="15%">Updated By LM Dags(s)</td>
				</tr>
				</thead>
				<tbody>
				<?php
				$i =1;
				foreach($villageWiseVlbCounts as $key=>$row) :
					?>
					<tr>
						<td><?= $i++ ?></td>
						<td><?= $this->utilityclass->cir_name($row->district_code,$row->subdiv_code,$row->cir_code) ?></td>
						<td><?= $this->utilityclass->village_name($row->district_code,$row->subdiv_code,$row->cir_code,
								$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code) ?></td>
						<td><?= $row->chitha_dags ?></td>
						<td><?= $row->approved_by_co_count ?></td>
						<td><?= $row->updated_by_lm_count ?></td>
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
