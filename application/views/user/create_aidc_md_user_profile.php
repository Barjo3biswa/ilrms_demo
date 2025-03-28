<!-- Sweet Alert Link -->
<!-- <link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script> -->
<!-- Sweetalert Link End -->
<link href="<?= base_url() . 'css/bootstrap.min.css' ?>">
<div id="displayBox" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif"></div>
<script src="<?php echo base_url(); ?>application/views/js/blockUI.js"></script>
<script>
    document.onreadystatechange = function(e) {
        $.blockUI({
            message: $('#displayBox'),
            css: {
                border: 'none',
                backgroundColor: 'transparent'
            }
        });
    };
    window.onload = function() {
        $.unblockUI();
    }
</script>

<div class="row">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-3 text-white">
            <li class="breadcrumb-item font-weight-bold"><a href="<?= base_url() . 'dashboard' ?>">Create AIDC MD User Profile</a></li>
            <li class="breadcrumb-item font-weight-bold active text-red"
                aria-current="page">New User</li>
        </ol>
    </nav>
</div>


<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 offset-2">
            <?php echo $this->session->flashdata('alert_msg'); ?>
            <div class="bg-white shadow-lg rounded p-2 card-info">
                <?= form_open('aidc-md-profile-create-save') ?>
                <div class="card-header text-danger text-bold">
                    <h6><i class="fa fa-user"></i> Create User Profile (MD)</h6>
                </div>
                <div class="card-body">
                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Name :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control "
                                value="<?= $this->input->post('name') ?>" placeholder="Enter Name"
                                name="name" id="name" autocomplete="off">
                            <span class="text-danger"><?= form_error('name') ?></span>
                        </div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Email ID :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" value="<?= $this->input->post('email') ?>" placeholder="Enter Email ID"
                                name="email" id="email" autocomplete="off">
                            <span class="text-danger"><?= form_error('email') ?></span>
                        </div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Mobile No :</label>
                        </div>
                        <div class="col-sm-8">
                            <input
                                class="form-control"
                                value="<?= $this->input->post('mobile') ?>"
                                type="tel"
                                id="mobile"
                                name="mobile"
                                placeholder="Enter your mobile number"
                                pattern="[0-9]{10}"
                                max=10
                                required>
                            <span class="text-danger"><?= form_error('mobile') ?></span>
                        </div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Organisation :</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="org" id="org" class="form-control">
                                <option selected value="">Select</option>
                                <option value="AIDC">AIDC</option>
                                <option value="AIIDC">AIIDC</option>
                                <option value="SIDC">SIDC</option>
                                <option value="DICC">DICC</option>
                            </select>
                            <span class="text-danger"><?= form_error('org') ?></span>
                        </div>
                    </div>


                    <!-- <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Username :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="user_name" value=""
                                maxlength=20 placeholder="Enter User Name"
                                name="user_name" autocomplete="off">
                            <span class="text-danger" id="use_name_error"><?= form_error('user_name') ?></span>
                        </div>
                    </div> -->


                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Password :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="new_password" value="Qwe@123"
                                minlength=8 maxlength=12 placeholder="Enter Password"
                                name="new_password" autocomplete="off">
                            <span class="text-danger"><?= form_error('new_password') ?></span>
                            <!-- <input type="text" class="form-control" value="Qwe@123" id='new_password' name="new_password" minlength="8" maxlength="12" 
                                    autocomplete="off"
                                    placeholder="****" readonly>
                            <span id="new_passwordErr" class="error_msg" style="color: red; font-size: 13px;"></span> -->
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" id="profileCreateBtn"
                        class="btn btn-primary"><i class="fa fa-check"></i> Create AIDC MD Profile</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>


        <hr class="mt-3">

    </div>
</div>

<script>
    $(document).ready(function() {

        $('#dataTable').DataTable({

            "pageLength": 50,
            "order": [1, "asc"],
            "autoWidth": false,
            "deferRender": true,
        });


    });


    $('#user_name').change(function() {

        var base_url = "<?php echo base_url(); ?>";
        var district_id = $("#dist_code").val();
        var newusername = $("#user_name").val();;

        const applicant = {
            newusername: newusername,
            district_id: district_id,
        };
        console.log(applicant);
        $.ajax({
            url: base_url + "DcUserCreation/getvalidusernameSadm",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
                if (data.responseType == 1) {
                    alert(data.message);
                } else if (data.responseType == 3) {
                    alert(data.message);
                    $("#profileCreateBtn").hide();
                } else {
                    $("#profileCreateBtn").show();
                }
            },
            data: JSON.stringify(applicant)

        });
    });


    // Success Message
    function showSuccessMessage(text) {
        Swal.fire({
            backdrop: true,
            allowOutsideClick: false,
            text: data.message,
            confirmButtonText: 'OK',
            customClass: {
                actions: 'my-actions',
                confirmButton: 'order-2',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload(true);
            }
        });
    }

    // Error Message
    function showErrorMessage(text) {
        swal.fire({
            title: "Error!",
            text: text,
            icon: 'error',
            position: 'top',
            showConfirmButton: false,
            timer: 5000,
            showCancelButton: true
        });
    }

    // Warning Message
    function showWarningMessage(text) {
        swal.fire({
            // title: "Error!",
            text: text,
            icon: 'warning',
            position: 'top',
            showConfirmButton: false,
            timer: 5000,
            showCancelButton: true
        });
    }
</script>