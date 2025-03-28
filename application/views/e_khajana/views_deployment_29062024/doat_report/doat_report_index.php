<script src="<?php echo base_url('js/jquery-3.4.1.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<div class='container' style="margin-top:20px">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb p-3 text-white">
      <li class="breadcrumb-item font-weight-bold"><a href="<?php echo base_url() . 'index.php/EkhajanaDoatReportController/getEkhajanaDoatReport'?>">Index</a></li>
      <li class="breadcrumb-item font-weight-bold active" aria-current="page">Generate Monthly Mouzadar Report</li>
  </ol>
</nav>
<div class='row'>
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <div class='col-12 card'>
    <div class="row" style='margin-top:10px'>				
        <div class="col-lg-12 col-lg-offset-3">
            <div class="panel casedisplay">                        
                <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <tr class="bg-info" style="background: #17a2b8 !important;text-align:center">
                            <td colspan="3" style="color:white">Generate Mouzadar Commissiion Monthly Report </td>
                        </tr>
                        <form id="doat_report_form" action="<?php echo base_url();?>index.php/EkhajanaDoatReportController/populateReport" method="POST">
                        <tr>
                            <td>
                                <h5>Select year and month</h5>
                                <input type="text" class="form-control year_month" name="year_month" placeholder="Please select year and month" id="datepicker" />
                            </td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4" style="text-align:center">
                            <button  onclick ="generateReport()"class="btn btn-success">Generate</button>
                        </div>
                        </form>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </div>               
    </div>
    </div>
    </div>
    <div class="col-md-3"></div>
    </div>	
</div>
<script>
    $("#datepicker").datepicker( {
        format: "mm-yyyy",
        viewMode: "months", 
        minViewMode: "months"
    });

    function generateReport()
    {
        var select_date = $('.year_month').val();
        if(select_date == "" || select_date == null){
            alert("Please Select A Year And Month");
            return;
        }
        $("#doat_report_form").submit();
    }
</script>


