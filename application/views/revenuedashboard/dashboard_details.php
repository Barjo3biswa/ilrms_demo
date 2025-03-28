
  <div class="row" style='padding: 10px 40px 10px 10px'>
    <div class="col-lg-12">
      <div class="reza-card">
          <div class="reza-title">
                <span  class="text-danger">Details of Service:  </span><span id="service_name"><?= $service_name; ?></span>
            </div>
            <div class="reza-body">
                <div class="table-responsive">
                    <table class="table table-bordered" >
                    <thead class="table__head">
                        <tr class="winner__table">
                            <th>Particulars</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="winner__table">
                            <td>Time Limit as per the Public Service Guarantee Act</td>
                            <td><strong class="text-red"><?= $time_limit; ?></strong> days</td>
                        </tr>
                        <tr class="winner__table">
                            <td>Total Number of Applications Received</td>
                            <td><strong class="text-red"><?= $total_received_count; ?></strong></td>
                        </tr>
                        <tr class="winner__table">
                            <td>Total Number of Applications Approved</td>
                            <td><strong class="text-green"><?= $total_approved_count; ?></strong></td>
                        </tr>
                        <tr class="winner__table">
                            <td>Average time taken to obtain registration/renewal</td>
                            <td><strong class="text-red"><?= $average_time; ?></strong> days</td>
                        </tr>
                        <tr class="winner__table">
                            <td>Median time taken to obtain registration/renewal</td>
                            <td><strong class="text-red"><?= $median_time; ?></strong> days</td>
                        </tr>
                        <tr class="winner__table">
                            <td>Minimum time taken to obtain registration/renewal</td>
                            <td><strong class="text-red"><?= $minimum_time; ?></strong> days</td>
                        </tr>
                        <tr class="winner__table">
                            <td>Maximum time taken to obtain registration/renewal</td>
                            <td><strong class="text-red"><?= $maximum_time; ?></strong> days</td>
                        </tr>
                        <tr class="winner__table">
                            <td>Average fee taken by the Department for completion of entire process obtaining approval/certificate</td>
                            <td><strong class="text-green"><i class='fa fa-rupee'></i><?= $average_fees; ?></strong></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
      </div>
    </div>
  </div>

  <div class="row" style='padding: 10px 40px 10px 10px'>
    <div class="col-lg-12">
      <div class="reza-card">
            <div class="reza-title">
                <span  class="text-danger">List of Approved Applications: </span><span id="service_name"><?= $service_name; ?>
            </div>
            <div class="reza-body">
                <div class="table-responsive">
                    <input type="hidden" name="service_code" id="service_code"  value="<?=$service?>">
                    <table class="table table-bordered   table-striped" style="margin-top:50px" id='datatableCaseList'>
                        <thead class="table__head">
                            <tr class="winner__table">
                            <th>Application No</th>
                            <th>Application Date</th>
                            <th>Approval Date</th>
                            <th>Fee Details</th>
                            <th>Total Fee Charged</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
      </div>
    </div>
  </div>




<script>

    var baseurl = "<?php echo base_url(); ?>";

    load_data();

    function load_data()
    {

        $('#datatableCaseList thead th:nth-of-type(1)').each(function () {
            var title = 'Application No';
            $(this).html('<input type="text" class="input_search form-control form-control-sm" placeholder="Search ' + title + '" data-column-index="0" />');
        });

        var table = $('#datatableCaseList').DataTable({
            'pageLength': 10,
            "processing": true,
            "serverSide": true,
            "ordering"  : false,
            "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
            'language'  : {
                        "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                    },
            'ajax':{
            url: baseurl + "index.php/RevenueDashboard/getAllCaseListDetails",
            type:'POST',
            data: {
                        service_code : $("#service_code").val(),
                    },
            deferLoading: 57,
            },
        });

        $('.search_button').on('click', function () {            
        $('table thead tr th .input_search').each(function(){ 
            table.column($(this).data('columnIndex')).search(this.value);
        });
        table.draw();
        });
    }

</script>