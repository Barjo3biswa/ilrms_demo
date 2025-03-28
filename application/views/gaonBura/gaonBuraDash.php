<div class="container bg-white">

<?php if ($this->session->userdata('first_login') == 0) { 
        
    ?>
	<script>
		$(document).ready(function () {
			$('#change_pass').modal({
				backdrop: 'static',
				keyboard: false
			})
			$('#change_pass').modal('show');
		});

		$(document).on('click', '#depart_btn_continue', function () {
			$('#change_pass').hide();
			$('.modal-backdrop').hide();
		});
	</script>

    <?php
        if($check_auth == false){
        ?>

            <script>
                $(document).ready(function () {
                    $('#aadhar_mod').modal({
                        backdrop: 'static',
                        keyboard: false
                    })
                    $('#aadhar_mod').modal('show');
                });
            </script>

            <div class="modal" id="aadhar_mod" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-center">
                                <h4>Welcome <?= $this->session->userdata('name') ?></h4>
                            </div>
                            <h5 class="alert-danger text-center p-5"><a style="cursor: pointer;" onclick="aadhaarLink();"><u>Please click here to Link your Aadhaar</u></a></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        else
        {

        ?>
            <div class="modal" id="change_pass" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-center">
                                <h4>Welcome <?= $this->session->userdata('name') ?></h4>
                            </div>
                            <div class="text-center text-sm p-2" style="font-size: 16px; color: red"> Note: Please Change Your
                                Password (Mandatory)
                            </div>
                            <hr>
                            <form method="post" id="change_password" enctype="multipart/form-data">
                                <div class="container py-2 m-0" style="padding-left: 5%;padding-right: 5%">
                                    <div class="row">
                                        <div style="width: 35%; text-align: right">
                                            User name:
                                        </div>
                                        <div style="width: 60%">
                                            <input class="form-control" name="user_name"
                                                value="<?= $this->session->userdata('unique_user_id') ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <div style="width: 35%; text-align: right">
                                            Old Password:
                                        </div>
                                        <div style="width: 60%">
                                            <input type="password" class="form-control" name="old_password" value=""
                                                autocomplete="off" id="old_password">
                                            <sm id="old_password" class="error_msg" style="color: red; font-size: 13px;"></sm>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <div style="width: 35%; text-align: right">
                                            New Password:
                                        </div>
                                        <div style="width: 60%">
                                            <input type="password" class="form-control" name="new_password" id="new_password"
                                                value="" autocomplete="off">
                                            <sm id="new_password" class="error_msg" style="color: red; font-size: 13px;"></sm>
                                        </div>
                                    </div>
                                    <div class="row pt-2">
                                        <div style="width: 35%; text-align: right">
                                            Re-Password:
                                        </div>
                                        <div style="width: 60%">
                                            <input type="password" class="form-control" name="re_password" id="re_password"
                                                value="" autocomplete="off">
                                            <sm id="re_password" class="error_msg" style="color: red; font-size: 13px;"></sm>
                                        </div>
                                    </div>

                                    <?php
                                        if($this->session->userdata('designation') == GBURA){
                                        ?>
                                            <div class="row pt-2">
                                                <div style="width: 35%; text-align: right">
                                                    Mobile:
                                                </div>
                                                <div style="width: 60%">
                                                    <input type="number" name="mobile_no" class="form-control" id="mobile_no_val">
                                                    <span id="mobile_no" class="error_msg" style="color: red; font-size: 13px;"></span>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div style="width: 35%; text-align: right">
                                                    Email:
                                                </div>
                                                <div style="width: 60%">
                                                    <input type="text" name="email" class="form-control" id="email_val">
                                                    <span id="email" class="error_msg" style="color: red; font-size: 13px;"></span>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div style="width: 35%; text-align: right">
                                                    address:
                                                </div>
                                                <div style="width: 60%">
                                                    <input type="text" name="address" class="form-control" id="address_val">
                                                    <span id="address" class="error_msg" style="color: red; font-size: 13px;"></span>
                                                </div>
                                            </div>

                                            <div class="row pt-2">
                                                <div style="width: 35%; text-align: right">
                                                    Select Mouza:
                                                </div>
                                                <div style="width: 60%">
                                                    <select name="mouza" id="mouza_val" class="form-control">
                                                        <option value="">--select--</option>
                                                        <?php
                                                        foreach($mouza_list as $mouzas){
                                                        ?>
                                                            <option value="<?=$mouzas->dist_code.'_'.$mouzas->subdiv_code.'_'.$mouzas->cir_code.'_'.$mouzas->mouza_pargona_code?>"><?=$mouzas->loc_name?></option>

                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span id="mouza" class="error_msg" style="color: red; font-size: 13px;"></span>
                                                </div>
                                            </div>


                                            <div class="row pt-2">
                                                <div style="width: 35%; text-align: right">
                                                    Select Lot:
                                                </div>
                                                <div style="width: 60%">
                                                    <select name="lot" id="lot_val" class="form-control">
                                                        <option value="">--select--</option>
                                                    </select>
                                                    <span id="lot" class="error_msg" style="color: red; font-size: 13px;"></span>
                                                </div>
                                            </div>


                                            <div class="row pt-2">
                                                <div style="width: 35%; text-align: right">
                                                    Select Village:
                                                </div>
                                                <div style="width: 60%">
                                                    <select name="village" id="village_val" class="form-control">
                                                        <option value="">--select--</option>
                                                    </select>
                                                    <span id="village" class="error_msg" style="color: red; font-size: 13px;"></span>
                                                </div>
                                            </div>

                                            <div class="row pt-2">
                                                <div style="width: 35%; text-align: right">
                                                    DOB:
                                                </div>
                                                <div style="width: 60%">
                                                    <input type="date" name="dob" id="dob_val" class="form-control" value="<?=$users_row->dob?>">
                                                    <span id="dob" class="error_msg" style="color: red; font-size: 13px;"></span>
                                                </div>
                                            </div>

                                            <div class="row pt-2">
                                                <div style="width: 35%; text-align: right">
                                                    Date of Engagement:
                                                </div>
                                                <div style="width: 60%">
                                                    <input type="date" name="date_of_eng" id="date_of_end_val" class="form-control">
                                                    <span id="date_of_eng" class="error_msg" style="color: red; font-size: 13px;"></span>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div style="width: 35%; text-align: right">
                                                    Date of Retirement:
                                                </div>
                                                <div style="width: 60%">
                                                    <input type="date" name="date_of_ret" id="date_of_ret_val" class="form-control">
                                                    <span id="date_of_ret" class="error_msg" style="color: red; font-size: 13px;"></span>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div style="width: 35%; text-align: right">
                                                    Education Qualification:
                                                </div>
                                                <div style="width: 60%">
                                                    <input type="text" name="edu_qua" id="edu_qua_val" class="form-control">
                                                    <span id="edu_qua" class="error_msg" style="color: red; font-size: 13px;"></span>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div style="width: 35%; text-align: right">
                                                    Remark:
                                                </div>
                                                <div style="width: 60%">
                                                    <input type="text" name="remark" id="remark_val" class="form-control">
                                                    <span id="remark" class="error_msg" style="color: red; font-size: 13px;"></span>
                                                </div>
                                            </div>

                                            <hr>
                                            <h5 class="reza-title text-center" style="margin-top: 50px">
                                                <i class="fa fa-upload" aria-hidden="true"></i> &nbsp;
                                                Upload documents &nbsp; 
                                                    <button class="rezaButt btn btn-sm btn-warning" type="button" id="addMoreFileFun" >
                                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                        Click to add
                                                    </button>
                                            </h5>
                                            <div id="fieldList" class="mt-3">
                                            </div>


                                            <hr>
                                            <h5 class="reza-title text-center" style="margin-top: 50px">
                                                <i class="fa fa-user" aria-hidden="true"></i> &nbsp;
                                                NOK-Next of Kin(Optional) &nbsp; 
                                                    <button class="rezaButt btn btn-sm btn-warning" type="button" id="addKin" >
                                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                        Click to add
                                                    </button>
                                            </h5>

                                            <div id="nokList" class="mt-3">
                                            </div>
                                        <?php
                                        }
                                    ?>
                                </div>
                                <div class="text-center pt-4">
                                    <button type="submit" id="validate_submit_btn" class="btn btn-primary rounded"> Update
                                    </button>
                                </div>
                            </form>

                            <div id="validate_msg" class="text-center"
                                style="font-weight: bold; font-size: 16px;color:green;"></div>

                            <hr>
                            <div style="padding-top: 10px; padding-bottom: 5px; font-size: 16px;"
                                class="text-gray-dark text-center">
                                Password should have 8 to 12 characters, at least 1 digit and 1 special character(!@#$%^&*).
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    
    ?>


<?php } ?>

</div>

<!-- document -->
<script>
    $(document).ready(function () {

        $("#fieldList").append(
            "<div id=\"deleteMe.(counter++)\" class=\"row\">\n" +
                "<div class=\"col-md-6\">\n" +
                    "<div class=\"form-group\">\n" +
                        "<label id=\"formControlFile\">Document Title</label>\n" +
                        "<input type=\"text\" placeholder=\"Please enter the name of the document\" class=\"form-control\" id=\"fileTextText\" name=\"fileText[]\" required minlength=\"3\" maxlength=\"99\">\n" +
                        "<span id=\"fileText\" class=\"error_msg\" style=\"color: red; font-size: 13px;\"></span>"+
                    "</div>\n" +
                "</div>\n" +
                "<div class=\"col-md-4\">\n" +
                    "<div class=\"form-group\">\n" +
                    "<label id=\"formControlFile\">Select File</label>\n" +
                        "<input type=\"file\" class=\"form-control\" id=\"fileUploadVal\" name=\"fileUpload[]\" required >\n" +
                        "<span id=\"fileUpload\" class=\"error_msg\" style=\"color: red; font-size: 13px;\"></span>"+
                    "</div>\n" +
                "</div>\n" +
                "<div class=\"col-md-2\">\n" +
                "<label id=\"formControlFile\"></label>\n" +
                    "<button disabled class=\"btn btn-danger form-control\" type=\"button\"  class=\"form-control\">\n" +
                        "<i class=\"count fa fa-trash\" id=\"count\"> </i>\n" +
                    "</button>\n" +
                "</div>\n" +
            "</div>"
        );


        $("#addMoreFileFun").click(function (e)
        {
            e.preventDefault();
                $("#fieldList").append(
                    "<div id=\"deleteMe.(counter++)\" class=\"row\">\n" +
                        "<div class=\"col-md-6\">\n" +
                            "<div class=\"form-group\">\n" +
                                "<label id=\"formControlFile\">Document Title</label>\n" +
                                "<input type=\"text\" placeholder=\"Please enter the name of the document\" class=\"form-control\" id=\"uploadFile\" name=\"fileText[]\" required minlength=\"3\" maxlength=\"99\">\n" +
                            "</div>\n" +
                        "</div>\n" +
                        "<div class=\"col-md-4\">\n" +
                            "<div class=\"form-group\">\n" +
                            "<label id=\"formControlFile\">Select File</label>\n" +
                                "<input type=\"file\" class=\"form-control\" id=\"uploadFile\" name=\"fileUpload[]\" required >\n" +
                            "</div>\n" +
                        "</div>\n" +
                        "<div class=\"col-md-2\">\n" +
                        "<label id=\"formControlFile\"></label>\n" +
                            "<button class=\"btn btn-danger form-control deleteAddMore\" type=\"button\" id=\"deleteAddMore\" class=\"form-control\">\n" +
                                "<i class=\"count fa fa-trash\" id=\"count\"> </i>\n" +
                            "</button>\n" +
                        "</div>\n" +
                    "</div>"
                );

        });

        $(document).on('click', '.deleteAddMore', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

    });
</script>

<!-- nok -->
<script>
    $(document).ready(function () {

        $("#addKin").click(function (e)
        {
            e.preventDefault();
                $("#nokList").append(
                    '<div id="deleteNok.(counter++)" class="row">\n' +
                        '<div class="col-md-3">\n' +
                            '<div class="form-group">\n' +
                                '<label id="formControlFile">Name</label>\n' +
                                '<input type="text" placeholder="Nok Name" class="form-control" id="nok_name" name="nok_name[]" required minlength="3" maxlength="99">\n' +
                            '</div>\n' +
                        '</div>\n' +
                        '<div class="col-md-3">\n' +
                            '<div class="form-group">\n' +
                            '<label id="formControlFile">Address</label>\n' +
                                '<input type="text" class="form-control" id="nok_address" name="nok_address[]" required placeholder="Address">\n' +
                            '</div>\n' +
                        '</div>\n' +
                        '<div class="col-md-2">\n' +
                            '<div class="form-group">\n' +
                            '<label id="formControlFile">Relation</label>\n' +

                                '<select class="form-control" name="nok_relation[]">'+
                                    '<option value="1">Mother</option>'+
                                    '<option value="2">Father</option>'+
                                    '<option value="3">Husband</option>'+
                                    '<option value="4">Wife</option>'+
                                    '<option value="7">Guardian</option>'+
                                '</select>'+

                            '</div>\n' +
                        '</div>\n' +
                        '<div class="col-md-3">\n' +
                            '<div class="form-group">\n' +
                            '<label id="formControlFile">Mobile No</label>\n' +
                                '<input type="number" class="form-control" id="nok_mobile" name="nok_mobile[]" required placeholder="Mobile">\n' +
                            '</div>\n' +
                        '</div>\n' +
                        '<div class="col-md-1">\n' +
                        '<label id="formControlFile"></label>\n' +
                            '<button class="btn btn-danger form-control deleteAddMoreNok" type="button" id="deleteAddMoreNok" class="form-control">\n' +
                                '<i class="count fa fa-trash" id="count"> </i>\n' +
                            '</button>\n' +
                        '</div>\n' +
                    '</div>'
                );

        });

        $(document).on('click', '.deleteAddMoreNok', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

    });
</script>

<script src="<?= base_url(); ?>js/home/home.js"></script>
<script src="<?= base_url(); ?>assets/js/sha512.min.js"></script>