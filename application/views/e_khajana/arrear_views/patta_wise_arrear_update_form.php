<style>
    .small-font{
        font-size:10px;
    }
</style>
<div class="container">
    <div class="row">
    <link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
    <script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
        <div class="col-md-1"></div>
        <div class="col-md-10 p-4 mt-2" style="border:1px solid orange">
        <div id="displayBoxEK" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif" style="width: 80px;"></div>
            <u><h4 class="text-center mt-3 mb-5">**PATTA WISE ARREAR UPDATE DETAILS**</h4></u>
            <form id="mouzadar_bank_details_form" action ="<?= base_url(); ?>/EkhajanaArrearController/fetchPattaWiseArrear" method="POST">
                <!-- location fetching of mouzadar starts-->
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" id="village_location" name="village_location">
                            <option selected>SELECT VILLAGE</option>
                            <?php foreach ($villages as $key => $vill) { ?>
                                <option value="<?php echo $vill->lot_no.'_'.$vill->vill_townprt_code; ?>"><?php echo $vill->loc_name; ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" id="patta_type" name="patta_type">
                            <option value="00" selected>SELECT PATTA TYPE</option>
                            <?php foreach ($patta_types as $key => $patta_type) { ?>
                                <option value="<?php echo $patta_type->type_code; ?>"><?php echo $patta_type->patta_type; ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" aria-label="Default select example" id="patta_no" name="patta_no">
                            <option value="00" selected>SELECT PATTA NO</option>
                            <?php foreach ($patta_numbers as $key => $patta_no) { ?>
                                <option value="<?php echo $patta_no->patta_no; ?>"><?php echo $patta_no->patta_no; ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                </div>
                <!-- location fetching of mouzadar ends -->
                <!-- bank details fetching starts -->
                <center>
                    <button type="submit" class="btn btn-primary mt-5"><i class="fa fa-search"></i>SEARCH</button>
                </center>
            </form>
        </div>
        <!-- validation-errors-div -->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="text-align:center">
                <div class="col-lg-12" id="error_div" style="display:none;">
                    <div class="card-header h5 bg-danger text-white text-center">
                        VALIDATION ERRORS
                    </div>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <strong class="text-center" style="color:red !important"
                            id="error_msg">
                        </strong>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- validation-error-div-end -->
        <div class="col-md-2"></div>
    </div>
</div>
<script>
    baseurl ='http://localhost/ilrms_live/'
    // baseurl ='https://basundhara.assam.gov.in/ilrms/'
    function showSuccessMessage(text) {
        swal.fire({
            title: "Success !",
            text: text,
            icon: 'success',
            position: 'top',
            showConfirmButton: true,
            timer: 5000,
        });
    }

    function showErrorMessage(text) {
        swal.fire({
            title: "Error!",
            text: text,
            icon: 'error',
            position: 'top',
            timer: 5000,
            showCancelButton: true
        });
    }

</script>

