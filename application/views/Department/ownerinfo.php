<style>
    :root {
        --loader-size: 50px;
        --dot-size: 6px;
        --loader-bg: #e1e6e2;
        --dot-color: black;
    }

    .loader {
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: rgba(1, 18, 64, 0.2);
        transition: opacity 0.3s ease-out, top 0.3s step-end;
        z-index: 99;
    }

    .loader.trans {
        transition: opacity 0.5s ease-out, top 0.5s step-start;
        opacity: 1;
        top: 0;
    }

    .loader .loaderview {
        position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        width: auto;
        height: auto;
        padding: 10px 40px;
        border-radius: 5px;
        top: 0;
        left: 0;
        z-index: 100;
        flex-flow: column;
        background-color: var(--loader-bg);
    }

    h1 {
        color: var(--dot-color);
        font-size: 1.2em;
        animation: fading 1.5s ease-in-out infinite;
        font-family: "Comfortaa", cursive;
    }

    .Loader-box {
        margin: 20px;
        flex: 0 0 auto;
        height: var(--loader-size);
        width: var(--loader-size);
    }

    .box {
        position: absolute;
        height: var(--loader-size);
        width: var(--loader-size);
        animation: rotating 4s ease-in infinite;
        animation-delay: calc(var(--id) * 0.5s);
    }

    .dot {
        background-color: var(--dot-color);
        height: var(--dot-size);
        width: var(--dot-size);
        border-radius: 100%;
    }

    @keyframes rotating {
        0% {
            opacity: 0;
            transform: rotateZ(0);
        }
        25% {
            opacity: 100%;
            transform: rotateZ(160deg);
        }

        75% {
            opacity: 200%;
            opacity: 100;
        }
        80% {
            transform: rotateZ(300deg);
            opacity: 100;
        }
        100% {
            transform: rotateZ(350deg);
            opacity: 0;
        }
    }

    @keyframes fading {
        0% {
            opacity: 40%;
        }
        50% {
            opacity: 90%;
        }
        100% {
            opacity: 40%;
        }
    }

      .rezaButt {
    color: #FFF;
    /* background-color: #03a9f4; */
        background: linear-gradient(to right, #0575E6, #40739e);

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
    /*box-shadow: 0 2px 5px 0 rgb(0 0 0 / 23%);*/
  }
</style>
<div class="hide loader" id="loader" style="display:none">
    <div class="loaderview">
        <h1>Don't refresh the page until the process is completed...</h1>
        <div class="Loader-box">
            <div class="box" style="--id:1">
                <div class="dot"></div>
            </div>
            <div class="box" style="--id:2">
                <div class="dot"></div>
            </div>
            <div class="box" style="--id:3">
                <div class="dot"></div>
            </div>
            <div class="box" style="--id:4">
                <div class="dot"></div>
            </div>
            <div class="box" style="--id:5">
                <div class="dot"></div>
            </div>
        </div>
    </div>
</div>
<div class='container ' style="margin-top:10px">
    <div class='col-lg-12'>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="bg-white shadow-lg rounded p-2 card-info">
                        <div class="card-header text-danger text-bold">
                            <h5 ><?php //echo $page_title; ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row pt-2">
                                <div class="col-sm-4">
                                    <label class="mb-0 mt-1 font-weight-normal">
                                    <span class="text-danger">*</span> Select District :</label>
                                </div>
                               
                                <div class="col-sm-8">
                                    <select class="form-control districtselect1 reset" name='dist_code' required id='district'>
                                        <option disabled selected>---Select District---</option>
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
                                    <span class="text-danger"></span>
                                </div>


                            </div>
                            
                            <div class="row pt-2">
                                <div class="col-sm-4">
                                    <label class="mb-0 mt-1 font-weight-normal">
                                    <span class="text-danger">*</span> Select Circle :</label>
                                </div>
                               
                                <div class="col-sm-8">
                                    <select class="form-control districtselect1 reset" name='cir_code' required id='circle'>
                                        <option disabled selected>---Select Circle---</option>
                                    </select>
                                    <span class="text-danger"></span>
                                </div>
                                
                            </div>

                            <div class="row pt-2">
                                <div class="col-sm-4">
                                    <label class="mb-0 mt-1 font-weight-normal">
                                    <span class="text-danger">*</span> Select Village :</label>
                                </div>
                               
                                <div class="col-sm-8">
                                    <select class="form-control districtselect1 reset" name='village_code' required id='village'>
                                        <option disabled selected>---Select Village---</option>
                                    </select>
                                    <span class="text-danger"></span>
                                </div>
                                
                            </div>

                            <div class="row pt-2">
                                <div class="col-sm-4">
                                    <label class="mb-0 mt-1 font-weight-normal">
                                    <span class="text-danger">*</span> Select Dags :</label>
                                </div>
                               
                                <div class="col-sm-8">
                                    <select class="form-control districtselect1 reset" name='dags' required id='dags'>
                                        <option disabled selected>---Select Dags---</option>
                                    </select>
                                    <span class="text-danger"></span>
                                </div>
                                
                            </div>

                        </div>
                        <div class="card-footer text-center">
                            <button type="button" id="ownerDetails" class="rezaButt buttInfo" style="width: 320px">
                                <i class="fa fa-eye" aria-hidden="true"></i> Fetch
                            </button>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Land Details Table -->
    <div class="col-md-10 mx-auto mt-4">
        <h4 class="text-center">Land Details:</h4>
        <div id="dagDetails" class="table-responsive" style="display: none;">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Dag No</th>
                        <th>Old Dag No</th>
                        <th>Patta Type</th>
                        <th>Patta No</th>
                        <th>Old Patta No</th>
                        <th>Land Class</th>
                        <th>Dag Area (B-K-L)</th>
                        <th>Revenue</th>
                        <th>Local Tax</th>
                    </tr>
                </thead>
                <tbody id="landTableBody"></tbody>
            </table>
        </div>
    </div>

    <!-- Owner Details Table -->
    <div class="col-md-10 mx-auto mt-4">
        <h4 class="text-center">Owner Information:</h4>
        <div id="landOwnerDetails" class="table-responsive" style="display: none;">
            <table class="table table-bordered table-striped">
                <thead class="table-secondary">
                    <tr>
                        <th>Owner Name</th>
                        <th>Father's Name</th>
                        <th>Guardian Relation</th>
                        <!-- <th>Gender</th> -->
                    </tr>
                </thead>
                <tbody id="ownerTableBody"></tbody>
            </table>
        </div>
    </div>

</div>


<script>
$(document).ready(function() {
    // Fetch Circles when District is selected
    $("#district").change(function() {
        let districtCode = $(this).val();
        $("#circle").html('<option value="">-- Loading Circles... --</option>').prop('disabled', true);
        $("#village").html('<option value="">-- Select Village --</option>').prop('disabled', true);
        $("#dags").html('<option value="">-- Select dags --</option>').prop('disabled', true);
        if (districtCode) {
            $.ajax({
                url: "<?= site_url('DharController/getCircles') ?>",
                type: "GET",
                data: { district_code: districtCode },
                dataType: "json",
                success: function(response) {
                    $("#circle").html('<option value="">-- Select Circle --</option>');
                    $.each(response, function(index, circle) {
                        $("#circle").append(`<option value="${circle.cir_code}">${circle.cir_name}</option>`);
                    });
                    $("#circle").prop('disabled', false);
                }
            });
        }
    });

    // Fetch Villages when Circle is selected
    $("#circle").change(function() {
        let circleCode = $(this).val();
        let district = $("#district").val();
        $("#village").html('<option value="">-- Loading Villages... --</option>').prop('disabled', true);
        $("#dags").html('<option value="">-- Select dags --</option>').prop('disabled', true);
        if (circleCode) {
            $.ajax({
                url: "<?= site_url('DharController/getVillages') ?>",
                type: "GET",
                data: { district_code: district, circle_code: circleCode },
                dataType: "json",
                success: function(response) {
                    $("#village").html('<option value="">-- Select Village --</option>');
                    $.each(response, function(index, village) {
                        $("#village").append(`<option value="${village.village_code}">${village.village_name}</option>`);
                    });
                    $("#village").prop('disabled', false);
                }
            });
        }
    });

    $("#village").change(function() {
        let village_code = $(this).val();
        let district = $("#district").val();
        $("#dags").html('<option value="">-- Loading dags... --</option>').prop('disabled', true);

        if (village_code) {
            $.ajax({
                url: "<?= site_url('DharController/getDags') ?>",
                type: "GET",
                data: { district_code: district, village_code: village_code },
                dataType: "json",
                success: function(response) {
                    $("#dags").html('<option value="">-- Select Dags --</option>');
                    $.each(response, function(index, dags) {
                        $("#dags").append(`<option value="${dags.dag_no}">${dags.dag_no}</option>`);
                    });
                    $("#dags").prop('disabled', false);
                }
            });
        }
    });

    function truncateToTwoDecimal(num) {
       return Math.floor(num * 100) / 100;
    }

    // Fetch Owner Details on Submit
    $("#ownerDetails").click(function() {
        let district = $("#district").val();
        let circle = $("#circle").val();
        let village = $("#village").val();
        let dag_no = $("#dags").val();

        if (!district || !circle || !village || !dag_no) {
            alert("Please fill all fields.");
            return;
        }

        $.ajax({
            url: "<?= site_url('DharController/getOwnerDetails') ?>",
            type: "POST",
            data: {
                district_code: district,
                village_code: village,
                dag_no: dag_no
            },
            dataType: "json",
            success: function(response) {
                if (response.success=='y') {
                    let land = response.dag_details;
                    $("#landTableBody").html(`
                        <tr>
                            <td>${land.dag_no}</td>
                            <td>${land.old_dag_no}</td>
                            <td>${land.patta_type}</td>
                            <td>${land.patta_no}</td>
                            <td>${land.old_patta_no}</td>
                            <td>${land.land_class}</td>
                            <td>${truncateToTwoDecimal(land.dag_area_b)}-${truncateToTwoDecimal(land.dag_area_k)}-${truncateToTwoDecimal(land.dag_area_lc)}</td>
                            <td>${truncateToTwoDecimal(land.dag_revenue)}</td>
                            <td>${truncateToTwoDecimal(land.dag_local_tax)}</td>
                        </tr>
                    `);
                    $("#dagDetails").show();

                    let owners = response.owner_details;
                    let ownerTableHTML = "";
                     // <td>${owner.pdar_gender}</td>
                    owners.forEach(owner => {
                        ownerTableHTML += `
                            <tr>
                                <td>${owner.pdar_name}</td>
                                <td>${owner.pdar_father}</td>
                                <td>${owner.pdar_guard_reln}</td>
                            </tr>
                        `;
                    });
                    $("#ownerTableBody").html(ownerTableHTML);
                    $("#landOwnerDetails").show();
                } else {
                    $("#landTableBody").html('<tr><td colspan="9" class="text-center text-danger">No data found</td></tr>');
                    $("#dagDetails").show();
                }
            }
        });
    });
});
</script>

