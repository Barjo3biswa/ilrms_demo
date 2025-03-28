<!-- <center><mark>Application Received in Basundhara </mark></center> -->
<div class="well well-sm mis_report">
	<h4 style="text-align: center; text-transform:uppercase">
		Approved Application List
	</h4>
</div>
<table class="table" id='dataTable'>
	<thead>
		<tr class="bg-success">
			<th>Application No</th>
			<th>Application Date</th>
			<th>Request Type</th>
			<th>Urban/Rural</th>
			<th>Village Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($pending as $pen) : ?>
			<tr>
				<td><?= $pen['case_no'] ?></td>
				<td><?= $pen['submission_date'] ?></td>
				<td><?= $pen['service'] ?></td>
				<td><?= $pen['rurban'] ?></td>
				<td><?= $this->utilclass->getVillageName($pen['dist_code'], $pen['subdiv_code'], $pen['cir_code'], $pen['mouza_pargona_code'], $pen['lot_no'], $pen['vill_townprt_code']) ?></td>
				<td>
					<?php if ($pen['service_code'] == SETTLEMENT_TENANT_ID) { ?>
						<a href='<?php echo base_url() ?>index.php/Basundhara/settlementBasu?app=<?= $pen['case_no'] ?>' class="btn btn-sm  btn-secondary"><i class='fa fa-eye'></i> View Details</a>
				</td>
			<?php } else if ($pen['service_code'] == SETTLEMENT_AP_TRANSFER_ID) { ?>
				<a href='<?php echo base_url() ?>index.php/Basundhara/settlementBasu?app=<?= $pen['case_no'] ?>' class="btn btn-sm  btn-secondary"><i class='fa fa-eye'> View Details</a></td>
			<?php } else if ($pen['service_code'] == SETTLEMENT_TRIBAL_COMMUNITY_ID) { ?>
				<a href='<?php echo base_url() ?>index.php/Basundhara/settlementBasu?app=<?= $pen['case_no'] ?>' class="btn btn-sm  btn-secondary"><i class='fa fa-eye'> View Details</a></td>
			<?php } else if ($pen['service_code'] == SETTLEMENT_KHAS_LAND_ID) { ?>
				<a href='<?php echo base_url() ?>index.php/Basundhara/settlementBasu?app=<?= $pen['case_no'] ?>' class="btn btn-sm  btn-secondary"><i class='fa fa-eye'> View Details</a></td>
			<?php } else if ($pen['service_code'] == SETTLEMENT_PGR_VGR_LAND_ID) { ?>
				<a href='<?php echo base_url() ?>index.php/Basundhara/settlementBasu?app=<?= $pen['case_no'] ?>' class="btn btn-sm  btn-secondary"><i class='fa fa-eye'> View Details</a></td>
			<?php } else if ($pen['service_code'] == SETTLEMENT_SPECIAL_CULTIVATORS_ID) { ?>
				<a href='<?php echo base_url() ?>index.php/Basundhara/settlementBasu?app=<?= $pen['case_no'] ?>' class="btn btn-sm  btn-secondary"><i class='fa fa-eye'> View Details</a></td>
			<?php } ?>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<script>
	$(document).ready(function() {
		$('#dataTable').DataTable({
			"pageLength": 50,
			"order": [1, "asc"],
			"autoWidth": false,
			"deferRender": true,
		});
	});
</script>