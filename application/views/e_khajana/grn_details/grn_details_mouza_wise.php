<style>
@media only screen and (max-width: 750px) {
    .label3 {
    margin-right:29rem;
  }
}
</style>

<link href="<?php echo base_url(); ?>css/select2.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/sweetalert2.min.css">
<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->
<!--links are added for jquery calendar-->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>css/flora.datepick.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datepick.js"></script>
<div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 80px;"></div>

<div class="container-fluid form-top">
    <div class="row">
        <div class="col-lg-10 mt-5 offset-1">
            <form id="grnReportForm" method="POST" action="_grnDownload">
            <div class="col-lg-12 col-lg-offset-1">
                <div class="panel panel-info mt-3">
                    <div style="border:2px solid grey;" class="shadow-lg bg-white">                           
                        <div class="panel-heading bg-primary text-center" style="margin-top:-10px;">
                            <h5 class="panel-title text-white p-3">
                                District: <?=$district_name?>,
                                Sub-division: <?=$subdiv_name?>, 
                                Circle: <?=$circle_name?>
                            </h5>
                        </div> 
                        <div class="panel-heading bg-dark text-danger text-center" style="margin-top:-10px;">
                            <h5 class="panel-title text-white p-3">                                
                                NOTE: FOR COMMISION RELATED QUERIES KINDLY CONTACT ASSAM e-GRAS<br>
                                <span style="color:red">
                                    MAIL: <b>assamegras@gmail.com OR assam-egras@assam.gov.in</b><br>
                                    CONTACT-NO: <b>1800-102-1686</b>
                                </span>                                
                            </h5>
                        </div> 
                        <div class="panel-heading bg-secondary text-center" style="margin-top:-10px;">
                            <h5 class="panel-title text-white p-2">
                                Download GRN details For Mouza : <?=$mouza_name?>
                            </h5>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right " style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            DATE(FROM-DATE)<span class="text-danger h4">*</span>
                                        </label>            
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <input autocomplete="off" class="form-control stdate" id="grn_start_date" type="text" name="start_date" placeholder="dd-mm-yyyy" style="width: 85%">                                        
                                    </div>
                                </div>                    
                            </div>
                        </div> 
                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-6 text-right" style="text-align: end;font-weight:bold;">
                                        <label class="text-right label3">
                                            DATE(TO-DATE)<span class="text-danger h4">*</span>
                                        </label>
                                    </div>
                                    <div class="col-lg-4 text-left">
                                        <input autocomplete="off" class="form-control stdate" id="grn_end_date" type="text" name="to_date" placeholder="dd-mm-yyyy" style="width: 85%">                                        
                                    </div>
                                </div>                    
                            </div>
                        </div>
                        <!-- validation-errors-div -->
                        <div class="col-lg-12" id="ekAr_error_div" style="display:none;margin-top:1rem">
                            <div class="card-header h5 bg-danger text-white text-center">
                                VALIDATION ERRORS 
                            </div>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <strong class="text-center" style="color:red !important" id="ekAr_error_div_validation_error_msg">
                                </strong>
                            </div>
                        </div>
                        <!-- validation-error-div-end -->
                        <hr style="border-bottom: 2px solid #000;">
                        <div class="row">
                            <div class="col-lg-12 text-center mb-3">
                                <button type="submit" name="GRNSubmit" class="btn btn-success" onclick="downloadExcelReport()"><i class="fa fa-download"></i>&nbsp; DOWNLOAD GRN EXCEL</button>
                                <button type="reset" name="GRNSu" class="btn btn-warning"><i class='fa fa-refresh'>&nbsp;</i><?php echo $this->lang->line('reset'); ?></button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
</div>
</div>

<script>
    var baseurl =  '<?php echo base_url();?>';

    $(document).ready( function () {
        $('#grn_start_date').datepick({dateFormat: 'yyyy-mm-dd'});
        $('#grn_end_date').datepick({dateFormat: 'yyyy-mm-dd'});
    });

    function downloadExcelReport(){
        event.preventDefault();

        // Clear previous error messages
        $("#ekAr_error_div").hide();
        $("#ekAr_error_div_validation_error_msg").html("");

        var startDate = $('#grn_start_date').val();
        var endDate   = $('#grn_end_date').val();

        // Validate that both dates are provided
        if(startDate === "" || endDate === ""){
            $("#ekAr_error_div_validation_error_msg").html("Both dates are required.");
            $("#ekAr_error_div").show();
            return false;
        }

        // Convert dates to Date objects
        var fromDate = new Date(startDate);
        var toDate   = new Date(endDate);

        // Validate that start date is smaller than to date
        if(fromDate > toDate){
            $("#ekAr_error_div_validation_error_msg").html("From Date must be earlier than To Date.");
            $("#ekAr_error_div").show();
            return false;
        }

        // Validate that the date selection is less than or equal to 30 days
        var diffTime = Math.abs(toDate - fromDate);
        var diffDays = diffTime / (1000 * 60 * 60 * 24); // convert milliseconds to days
        if(diffDays > 30){
            $("#ekAr_error_div_validation_error_msg").html("Date range must be less than or equal to 30 days.");
            $("#ekAr_error_div").show();
            return false;
        }

        // Set the form action to the PHP endpoint and submit the form
        $('#grnReportForm').attr('action', baseurl + 'EkhajanaGRNController/downloadGrnDetailsForMouza');
        $('#grnReportForm').submit();
    }
</script>
