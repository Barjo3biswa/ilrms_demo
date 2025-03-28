<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->

<style>
    .reza-card {
        background: #fff;
        border-radius: 2px;
        display: inline-block;
        margin: 1rem;
        position: relative;
        width: 100%;
    }

    .scroll {
        width: 200px; height: 400px;
        overflow: hidden;
    }  

    .form-control-1{
            font-size:14px;
        width:100%;

    }

    .reza-card {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
    }

    .reza-title {
        font-weight: bold;
        font-size: 18px;
        padding: 20px;
        color: #37474F;
    }

    .reza-body {
        padding-left: 20px;
        padding-right: 20px;
        padding-bottom: 20px;
    }

    .badge {
        padding: 10px;
        font-size: 15px;
    }

    .rezaButt {
        color: #FFF;
        background-color: #40739e;
        /* background-color: #41B06E; */
        /* background-color: #8c7ae6; */
    }

    .rezaButt:hover {
        color: #0c0c0c;
    }

    .rezaButt {
        display: inline-block;
        position: relative;
        cursor: pointer;
        height: 35px;
        min-width: 150px;
        line-height: 35px;
        padding: 0 1.5rem;
        font-size: 15px;
        font-weight: 600;
        font-family: "Roboto", sans-serif;
        letter-spacing: 0.8px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        vertical-align: middle;
        white-space: nowrap;
        outline: none;
        border: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border-radius: 2px;
        transition: all 0.3s ease-out;
    }

    .rezaText {
        font-size: 16px;
    }

    label {
        padding-bottom: 5px;
        font-weight: bold;
    }

    #searchBox {
        padding: 15px;
        border: 1px solid #00BCD4;
        margin: 0px;
    }


    #cases_wrapper {
        margin-top: 0px !important;
    }


    .table thead tr:first-child {
    /* background: #41B06E; */
    background: #40739e;
    }


    /*.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {*/
    /*display: none;*/
    /*}*/
</style>

<div class="row" style='padding: 40px 50px 40px 20px'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="case_list_div">
        <div class="reza-card">
            <div class="reza-title">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-2">
                        <span>Pending Case List
                        </span>
                    </div>
                    <div class="col-lg-12 " align="right">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped" id='datatableConversionCaseListPs'>
                                <thead >
                                    <tr>
                                        <th class="text-white">Case No</th>
                                        <th class="text-white">District</th>
                                        <th class="text-white">Location</th>
                                        <th class="text-white">Submission Date</th>
                                        <th class="text-white">Action 
                                    <button type="button" class="search_button btn btn-sm btn-danger form-control">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                        </th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
                <hr style="margin-bottom: -5px">
            </div>
        </div>
    </div>

</div>



<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">

<script>

  $(document).ready( function () {
    var baseurl = "<?php echo base_url(); ?>";

    load_conversion_datatable_ps();

    function load_conversion_datatable_ps()
    {

        $('#datatableConversionCaseListPs thead th:nth-of-type(1)').each(function () {
            var title = 'Case';
            $(this).html('<input type="text" class="input_search form-control form-control-sm" placeholder="Search ' + title + '" data-column-index="0" />');
        });

      var table = $('#datatableConversionCaseListPs').DataTable({
        'pageLength': 10,
        "processing": true,
        "serverSide": true,
        "ordering"  : false,
        "lengthMenu": [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        'language'  : {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'
                },
        'ajax':{
        url: baseurl + "DeptConversion/getAllConversionCasePs ",
          type:'POST',
          data: {
                        dist_code : $("#dist_code").val(),
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

    });
</script>