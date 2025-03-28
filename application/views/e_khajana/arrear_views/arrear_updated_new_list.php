<!-- <input type="hidden" value="<?php echo $dist_code ?>" id="selectDistrict"> -->

<div class="row" style='padding: 40px 50px 40px 20px'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="reza-card">
            <div class="reza-body" id="showBody">
                <!-- DataTable starts-->
                <form method="POST">
                <table class='table table-striped table-bordered' id='dataTablePreArrear' width="100%">
                    <thead>
                        <tr>
                            <th class="center">
                                <label class="control-label">Village Name</label>
                            </th>
                            <th class="center">
                                <label class="control-label">Patta Type</label>
                            </th>
                            <th class="center">
                                <label class="control-label">Patta No</label>                              
                            </th>
                            <th class="center">
                                <label class="control-label">Total Arrear</label>
                            </th>
                            <th class="center">
                                <label class="control-label">Year Wise Arrear</label>
                            </th> 
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- DataTable ends -->
                <div class="row">
                    
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Datatable
    $(document).ready(function() {
        let count = 1;
        load_data_pre_arrear_view_list();
        //Load Datatable
        function load_data_pre_arrear_view_list() {

            $('#dataTablePreArrear thead th:nth-of-type(1)').each(function() {
                var title = $(this).text();
                $(this).html(title + ' <input type="text" class="form-control input_search form-control-sm" placeholder=" ' + title + '" />');
            });
            $('#dataTablePreArrear thead th:nth-of-type(3)').each(function() {
                var title = $(this).text();
                $(this).html(title + ' <input type="text" class="form-control input_search form-control-sm" placeholder=" ' + title + '" />');
            });

            var base_url = "<?php echo base_url(); ?>"; 
            var table = $('#dataTablePreArrear').DataTable({
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
                    url: base_url+'/EkhajanaArrearController/getUpdatedArrear',
                    type: 'POST',
                    data: {
                    },
                    deferLoading: 57,
                },
                order: [
                    [2, 'asc']
                ],

            });

                table.columns().every(function() {
                var table = this;
                $('input', this.header()).on('keyup change', function() {
                    if (table.search() !== this.value) {
                        table.search(this.value).draw();
                    }
                });
            });

        }

        $('.search_button').on('click', function() {
            $('table thead tr th .input_search').each(function() {
                $(this).val('');
            });
            $('#dataTablePreArrear').DataTable().destroy();
            load_data_pre_arrear_view_list();
        });

    
        

        // $("#dataTablePreArrear").on('draw.dt', function() {
        //     for (var i = 0; i < selectedCheckBoxArray.length; i++) {
        //         checkboxId = selectedCheckBoxArray[i];
        //         const myArray = checkboxId.split("/");
        //         var arr = myArray[3];
        //         $('#' + arr).attr('checked', true);
        //     }
        // });
    });

    
</script>