  <div class="mt-2">
    <a href="<?php echo base_url(); ?>index.php/AdlrReportController/downloadLgdCodeListReport/?type=<?php echo $route_name; ?>&dist_code=<?php echo $dist_code; ?>" type="button" target="_downloadReport" class="btn btn-success mb-2">
        <i class="fa fa-download" aria-hidden="true"></i> Download as Excel
    </a>
<div class="table-responsive">
        <input type="hidden" name="dist_code" id="dist_code" value="<?=$dist_code?>">
		    <input type="hidden" value="<?php echo $route_name; ?>" id="route_name">
        <table class="datatable table table-stripped" id='datatableReportList'>
            <thead >
                <tr>
                    <th>District</th>
                    <th>Circle</th>
                    <th>Village</th>
                    <th>UUID</th>
                    <?php if($route_name == "lgd-code-list-exist"): ?>
                    <th>LGD Code</th>
                    <?php endif;?>
                </tr>
            </thead>
            <tbody>  
            </tbody> 
        </table>
    </div>
  </div>    


<script>

    var baseurl = "<?php echo base_url(); ?>";

    load_data();

    function load_data()
    {

        $('#datatableReportList thead th:nth-of-type(1)').each(function () {
            // var title = 'Village';
            // $(this).html('<input type="text" class="input_search form-control form-control-sm" placeholder="Search ' + title + '" data-column-index="0" />');
        });

        var dist_code = $('#dist_code').val();
        var route_name = $('#route_name').val();

      var table = $('#datatableReportList').DataTable({
        'pageLength': 10,
        "processing": true,
        "serverSide": true,
        "ordering"  : false,
        "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        'language'  : {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                },
        'ajax':{
        url: baseurl + "AdlrReportController/getLgdCodeExistDataTable",
          type:'POST',
            data : {dist_code : dist_code, route_name : route_name},
          deferLoading: 57,
        },
      });
    }

</script>