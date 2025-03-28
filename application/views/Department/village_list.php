    <div class="table-responsive">
        <input type="hidden" name="dist_code" id="dist_code" value="<?=$dist_code?>">
        <input type="hidden" name="subdiv_code"  id="subdiv_code" value="<?=$subdiv_code?>">
        <input type="hidden" name="cir_code" id="cir_code"  value="<?=$cir_code?>">
        <table class="datatable table table-stripped" id='datatableVillageList'>
            <thead >
                <tr>
                    <th>Village</th>
                    <th><button type="button" class="search_button btn btn-sm btn-success form-control">
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

    var baseurl = "<?php echo base_url(); ?>";

    load_data();

    function load_data()
    {

        $('#datatableVillageList thead th:nth-of-type(1)').each(function () {
            var title = 'Village';
            $(this).html('<input type="text" class="input_search form-control form-control-sm" placeholder="Search ' + title + '" data-column-index="0" />');
        });

      var table = $('#datatableVillageList').DataTable({
        'pageLength': 10,
        "processing": true,
        "serverSide": true,
        "ordering"  : false,
        "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        'language'  : {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                },
        'ajax':{
        url: baseurl + "AdlrReportController/getVillageList",
          type:'POST',
          data: {
                        dist_code : $("#dist_code").val(),
                        subdiv_code : $("#subdiv_code").val(),
                        cir_code : $("#cir_code").val(),
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