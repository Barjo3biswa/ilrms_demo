<center><mark>Application Received in Basundhara </mark></center>
<div class="reza-body" id="showBody">

	<table class='datatable table table-stripped table-bordered' id='datatable' width="95%">
		<thead>
			<tr>
				<th>Application No</th>
				<th>Application Date</th>
				<th>Request Type</th>
				<th>District</th>
				<th>Action
					<button type="button" class="search_button btn btn-sm btn-success form-control">
						<i class="fa fa-search" aria-hidden="true"></i>
						Search
					</button>
				</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
</div>




<script>
	$(document).ready(function() {

		var base_url = "<?php echo base_url(); ?>";
		var service_code = <?= $service ?>;

		$('#datatable thead th:nth-of-type(1)').each(function() {
			var title = $(this).text();
			$(this).html(title + ' <input type="text" class="input_search form-control form-control-sm" placeholder="Search ' + title + '" data-column-index="0" />');
		});

		$('#datatable thead th:nth-of-type(2)').each(function() {
			var title = $(this).text();
			$(this).html(title + ' <input type="text" class="input_search form-control form-control-sm" placeholder="Search ' + title + '" data-column-index="1" />');
		});

		var table = $('#datatable').DataTable({
			// "scrollX": true,
			'pageLength': 10,
			"processing": true,
			"serverSide": true,
			"ordering": false,
			"lengthMenu": [
				[5, 10, 20, 50, 100],
				[5, 10, 20, 50, 100]
			],
			'language': {
				"processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
			},
			'ajax': {
				url: base_url + 'index.php/Basundhara/paginationAPI',
				type: 'POST',
				data: {
					service: service_code
					// is_category: category,
					// rural: rural
				},
				deferLoading: 57,
			},

		});

		// on keypree search automatically
		// table.columns().every(function () {
		//     var table = this;
		//     $('input', this.header()).on('keyup change', function () {
		//         if (table.search() !== this.value) {
		//                 table.search(this.value).draw();
		//         }
		//     });
		// });


		// button search
		$('.search_button').on('click', function() {
			$('table thead tr th .input_search').each(function() {
				table.column($(this).data('columnIndex')).search(this.value);
			});
			table.draw();
		});

	});
</script>