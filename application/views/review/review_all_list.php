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

    .bg-primary {
        color: #FFF;
        background: linear-gradient(to right, #0575E6, #40739e);
    }

    .bg-success {
        color: #FFF;
        background: linear-gradient(to right, #00F260, #0575E6);
    }

    .bg-danger {
        color: #FFF;
        background: linear-gradient(to right, #F09819, #fc4a1a);
    }

    .text-gradient {
        color: #113f67;
        font-weight: bold;
    }

    .buttInfo {
        color: #FFF;
        background: linear-gradient(to right, #0575E6, #40739e);
    }

    .buttdanger {
        color: #FFF;
        background: linear-gradient(to right, #F09819, #fc4a1a);
    }

    .buttsuccess {
        color: #FFF;
        background: linear-gradient(to right, #00F260, #11998e);
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

    /*.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {*/
    /*display: none;*/
    /*}*/

    /* new CSS */

    @keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
    100% { transform: translateX(0); }
    }

    .remove-btn-animate {
    animation: shake 0.5s;
    }

    

</style>

<div class="row" style='padding: 40px 50px 40px 20px'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="reza-card">
            <div class="reza-title">
                <span>Basundhara MB2 Review List</span> <span style="color: red;">( N.B: Please Select District Before Proceed )</span>
            </div>
            <div class="reza-body">
                    <div class="row" id="searchBox">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="selectDistrict">District</label>
                                <!-- <select class="form-select districtselect1" aria-label="Default select example" name="selectDistrict" id="" required>
                                    <option disabled selected>Select District (Total Case)</option>
                                    <?php foreach ($user_dist as $dist) :  ?>
                                        <option value='<?php echo $dist->dist_code; ?>'><?= $this->utilclass->getDistrictNameOnLanding($dist->dist_code) ?> (<?=$dist->case_count;?>)</option>
                                    <?php endforeach; ?>
                                </select> -->
									<select class="form-control districtselect1 reset" name='dist_code' id="selectDistrict" required>
										<option disabled selected>Select District</option>
										<option value='10'>ছিৰাং ( Chirang )</option>
										<option value='06'>নলবাৰী ( Nalbari )</option>
										<option value='08'>দৰং ( Darrang )</option>
										<option value='07'>কামৰূপ ( Kamrup )</option>
										<option value='33'>নগাওঁ ( Nagaon )</option>
										<option value='14'>গোলাঘাট ( Golaghat )</option>
										<option value='01'>কোকৰাঝাৰ (Kokrajhar)</option>
										<option value='02'>ধুবুৰী ( Dhubri )</option>
										<option value='03'>গোৱালপাৰা ( Goalpara )</option>
										<option value='05'>বৰপেটা ( Barpeta )</option>
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
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="selectDistrict">Action </label>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" id="dist_select_btn_submit" class="rezaButt buttInfo"><i class="fa fa-search" aria-hidden="true"></i> View all applications</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="case_list_div">
    </div>


</div>



<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">
<script>
    var baseurl = "<?php echo base_url(); ?>";
    $('#dist_select_btn_submit').on('click', () => {
        var dist_code = $('.districtselect1').val();
        if (dist_code === null) {
            alert("Please Select District !!!");
            return;
        }
        $.blockUI({
            message: $('#displayBox'),
            css: {
                border:'none',
                backgroundColor:'transparent'
            }
        });
        $.ajax({
            url: baseurl + "BasundharaReview/caseList" ,
            type: "POST",
            data : {dist_code : dist_code},
            error: function() {
                $.unblockUI();
                Swal.fire({
                    title: "Failed",
                    text: "Error",
                    icon: "warning",
                    timer: 50000
                });
            },
            success: function(data) {
                $.unblockUI();
                $("#case_list_div").html(data); 
            }
        });
    });

    $(document).on('click', '#modalClose', function () {
        $('#markAddCasesToMemoModal').modal('hide');
        $('#markVerificationModal').modal('hide');
        $('#proposalListModal').modal('hide');
        $('#revertToDCModal').modal('hide');
    });




</script>