<!-- Sweet Alert Link -->
<!-- <link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script> -->
<!-- Sweetalert Link End -->
<link href="<?= base_url().'css/bootstrap.min.css'?>">
<div id="displayBox" style="display: none;"><img src="<?= base_url(); ?>/assets/process.gif"></div>
<script src="<?php echo base_url(); ?>application/views/js/blockUI.js"></script>
<script>
    document.onreadystatechange = function(e)
    {
        $.blockUI({
            message: $('#displayBox'),
            css: {
                border:'none',
                backgroundColor:'transparent'
            }
        });
    };
    window.onload = function(){
        $.unblockUI();
    }
</script>

<div class="row">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-3 text-white">
            <li class="breadcrumb-item font-weight-bold"><a href="<?= base_url().'dashboard'?>">Create DC User Profile</a></li>
            <li class="breadcrumb-item font-weight-bold active text-red" 
            aria-current="page">New User</li>
        </ol>
    </nav>
</div>


<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 offset-2">
            <?php echo $this->session->flashdata('alert_msg');?>
            <div class="bg-white shadow-lg rounded p-2 card-info">
                <?=form_open('dc-profile-create-save')?>
                <div class="card-header text-danger text-bold">
                    <h6><i class="fa fa-user"></i> Create User Profile (DC)</h6>
                </div>
                <div class="card-body"> 
                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Select District :</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="dist_code"  id="dist_code" autocomplete="off" required>
                                <option disabled selected value="">---Select District---</option>
                                <option value='10'>ছিৰাং ( Chirang )</option>
                                <option value='06'>নলবাৰী ( Nalbari )</option>
                                <option value='08'>দৰং ( Darrang )</option>
                                <option value='07'>কামৰূপ ( Kamrup )</option>
                                <option value='33'>নগাওঁ ( Nagaon )</option>
                                <option value='14'>গোলাঘাট ( Golaghat )</option>
                                <option value='01'>কোকৰাঝাৰ (Kokrajhar)</option>
                                <option value='02'>ধুবুৰী ( Dhubri )</option>
                                <option value='03'>গোৱালপাৰা ( Goalpara )</option>
                                <option value='05'>বৰপেটা  ( Barpeta )</option>
                                <option value='13'>বঙাইগাঁও ( Bongaigaon )</option>
                                <option value='15'>যোৰহাট ( Jorhat )</option>
                                <option value='17'>ডিব্ৰুগড় ( Dibrugarh )</option>
                                <option value='21'>করিমগঞ্জ ( Karimganj )</option>
                                <option value='24'>কামৰূপ মহানগৰ ( Kamrup Metro )</option>
                                <option value='32'>মৰিগাওঁ ( Morigaon )</option>
                                <option value='36'>হোজাই ( Hojai )</option>
                                <option value='38'>দক্ষিণ শালমাৰা ( South Salmara )</option>
                                <option value='39'>বজালী ( Bajali )</option>
                                <option value='22'>Hailakandi</option>
                                <option value='23'>Cachar</option>
                                <option value='27'>Udalguri</option>
                                <option value='12'>লক্ষীমপূৰ ( Lakhimpur )</option>
                                <option value='16'>শিৱসাগৰ ( Sibsagar )</option>
                                <option value='18'>তিনিচুকীয়া ( Tinsukia )</option>
                                <option value='34'>মাজুলী ( Majuli )</option>
                                <option value='37'>চৰাইদেউ ( Charaideo )</option>
                                <option value='11'>শোণিতপুৰ ( Sonitpur )</option>
                                <option value='25'>ধেমাজি ( Dhemaji )</option>
                                <option value='35'>বিশ্বনাথ ( Biswanath )</option>
                            </select>
                            <span class="text-danger"><?=form_error('dist_code')?></span>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Select Type :</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" name="type" id="type" autocomplete="off" required>
                                <option value="O" Selected >স্থায়ী</option>
                                <option value="P" >আনৰ শ্হলত</option>
                                <option value="A">সংলগ্ন</option>
                            </select>
                            <span class="text-danger"><?=form_error('type')?></span>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Name :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control " 
                            value="<?=$this->input->post('name')?>" placeholder="Enter  Name"
                                   name="name" id="name" autocomplete="off">
                            <span class="text-danger"><?=form_error('name')?></span>
                        </div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Contact No :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="<?=$this->input->post('phone_no')?>" placeholder="Enter Contact No"
                                   name="phone_no" id="phone_no" maxlength="10" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            <span class="text-danger"><?=form_error('phone_no')?></span>
                        </div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Date of Joining :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="date" class="form-control " 
                            value="<?=$this->input->post('date_of_joining')?>" placeholder="Enter Joining Date"
                                   name="date_of_joining" id="date_of_joining" autocomplete="off">
                            <span class="text-danger"><?=form_error('date_of_joining')?></span>
                        </div>
                    </div>                

                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Username :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="user_name" value="" 
                             maxlength=20 placeholder="Enter User Name"
                            name="user_name" autocomplete="off">
                            <span class="text-danger" id="use_name_error"><?=form_error('user_name')?></span>
                        </div>
                    </div>


                    <div class="row pt-2">
                        <div class="col-sm-4">
                            <label class="mb-0 mt-1 font-weight-normal">Password :</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="new_password" value="Qwe@123" 
                            minlength=8 maxlength=12 placeholder="Enter Password"
                            name="new_password" autocomplete="off" readonly>
                            <span class="text-danger"><?=form_error('new_password')?></span>
                            <!-- <input type="text" class="form-control" value="Qwe@123" id='new_password' name="new_password" minlength="8" maxlength="12" 
                                    autocomplete="off"
                                    placeholder="****" readonly>
                            <span id="new_passwordErr" class="error_msg" style="color: red; font-size: 13px;"></span> -->
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" id="profileCreateBtn" 
                    class="btn btn-primary"><i class="fa fa-check"></i> Create DC Profile</button>
                </div>
                <?=form_close()?>
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






    $('#user_name').change(function(){

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
                success: function (data) {
                if (data.responseType == 1) 
                    {
                        alert(data.message);
                    }
                else if (data.responseType == 3) 
                    {
                        alert(data.message);
                        $("#profileCreateBtn").hide();
                    }
                else
                    {
                            $("#profileCreateBtn").show();
                    }
                },
                data: JSON.stringify(applicant)

            });
    });


    // Success Message
    function showSuccessMessage(text) {
        Swal.fire({
        backdrop:true,
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