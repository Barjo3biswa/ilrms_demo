<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->
<link href="<?php echo base_url('css/department_style.css'); ?>" rel="stylesheet" />

<style>
    .anyClass {
        height: 500px;
        overflow-y: scroll;
    }
</style>

<!-- Test Section -->
<div class="container">
    <div class="row">
        <section>
            <div class="wizard">


                <form role="form">

                    <input type="hidden" name="application_no" value="<?= $_GET['app'] ?>">
                    <div class="tab-content">
                        <!-- Application Review starts here -->
                        <div class="tab-pane active" role="tabpanel" id="step1">
                            <h5 class="bg-success p-2 text-white shadow">
                                Applications Received for this Dag No:
                                <small class="text-warning"><?= $_GET['dag_no'] ?></small>
                            </h5>
                            <div class="card anyClass">
                                <div class="card-body">

                                    <div class="timeline">
                                        <?php $count = 0;
                                        foreach ($applications as $pro) :
                                            if ($count % 2 == 0) { ?>
                                                <div class="timeline__content" style="background-color: #6472ff">
                                                    <span class="content_tag" style="margin-top: 15px; background-color: white; color: #4CAF50">
                                                        <a href="<?php echo base_url() ?>index.php/Basundhara/settlementBasu?app=<?= $pro->application_no; ?>&dist_code=<?= $pro->dist_code; ?>" target="_blank">Application</a>
                                                    </span>
                                                    <span class="content_date" style="color: white; margin-top: 7px">

                                                        <?= $pro->application_no; ?>
                                                        <br>(B-<?= $pro->mbigha; ?>,K-<?= $pro->mkatha; ?>,L-<?= $pro->mlessa; ?>)
                                                        <?php if ($service_code != '13' && $service_code != '14') { ?>
                                                            Agri (B-<?= $pro->agri_bigha; ?>,K-<?= $pro->agri_katha; ?>,L-<?= $pro->agri_lessa; ?>)
                                                        <?php } ?>
                                                    </span>
                                                </div>
                                            <?php } else { ?>
                                                <div class="timeline__content" style="background-color: #09aa99">
                                                    <span class="content_tag" style="margin-top: 15px; background-color: white; color: #4CAF50">
                                                        <a href="<?php echo base_url() ?>index.php/Basundhara/settlementBasu?app=<?= $pro->application_no; ?>&dist_code=<?= $pro->dist_code; ?>" target="_blank">Application</a>
                                                    </span>
                                                    <span class="content_date" style="color: white; margin-top: 7px">

                                                        <?= $pro->application_no; ?>
                                                        <br>(B-<?= $pro->mbigha; ?>,K-<?= $pro->mkatha; ?>,L-<?= $pro->mlessa; ?>)
                                                        <?php if ($service_code != '13' && $service_code != '14') { ?>
                                                            Agri (B-<?= $pro->agri_bigha; ?>,K-<?= $pro->agri_katha; ?>,L-<?= $pro->agri_lessa; ?>)
                                                        <?php } ?>
                                                    </span>
                                                </div>
                                            <?php } ?>

                                        <?php $count++;
                                        endforeach; ?>


                                    </div>

                                    <h5 class="reza-title center"><span>Total <span class="text-danger"><?= $count ?></span> Applications Received in District-<span class="text-danger"><?= $this->utilclass->getDistrictName($pro->dist_code) ?></span>, SubDiv.- <span class="text-danger"><?= $this->utilclass->getSubDivName($pro->dist_code, $pro->subdiv_code) ?></span>, Village- <span class="text-danger"><?= $this->utilclass->getVillageName($pro->dist_code, $pro->subdiv_code, $pro->cir_code, $pro->mouza_code, $pro->lot_no, $pro->vill_code) ?></span>, Dag No- <span class="text-danger"><?= $pro->dag_no ?></span> </span> </h5>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
<!-- Script for roadside side reservation  -->
<!-- #road_side_reservation_hide -->
<script>
    function roadSideReservYes() {
        var x = document.getElementById("road_side_reservation_hide");
        if (x.style.display === "none") {
            x.style.display = "block";
        }
    }
    //  else {
    //   x.style.display = "none";
    // }
    function roadSideReservNo() {
        var x = document.getElementById("road_side_reservation_hide");
        if (x.style.display === "block") {
            x.style.display = "none";
        }
    }

    // zonal value validation
    $("#zonal_valuation").keyup(function() {
        var nodir_kaijo_b = $('#reserved_bigha').val();
        var nodir_kaijo_k = $('#reserved_katha').val();
        var nodir_kaijo_lc = $('#reserved_lessa').val();
        window.nodirkakhorlessa = parseInt(nodir_kaijo_b) * 100 + parseInt(nodir_kaijo_k) * 20 + parseFloat(nodir_kaijo_lc);
        console.log(window.nodirkakhorlessa);
        var mbigha = $('.s_dag_area_b').val();
        var mkatha = $('.s_dag_area_k').val();
        var mlessa = $('.s_dag_area_lc').val();
        //window.originallessa = parseInt(mbigha) * 100 + parseInt(mkatha) * 20 + parseInt(mlessa);
        window.originallessa = parseInt(mbigha) * 100 + parseInt(mkatha) * 20 + parseFloat(mlessa);
        console.log(window.originallessa);
        // alert(originallessa);
        window.occupiedlessa = nodirkakhorlessa;
        window.remaininglessa = originallessa - occupiedlessa;
        if (originallessa <= nodirkakhorlessa) {
            alert("Road/River side reservation can't be greater then original land");
            $('#reserved_bigha').val("0");
            $('#reserved_katha').val("0");
            $('#reserved_lessa').val("0");
            window.nodirkakhorlessa = 0;
            window.occupiedlessa = nodirkakhorlessa;
            window.remaininglessa = originallessa - occupiedlessa;
        }
        if (originallessa <= occupiedlessa) {
            alert("Total Reservation land can't be greater then original land");
            $('#reserved_bigha').val("0");
            $('#reserved_katha').val("0");
            $('#reserved_lessa').val("0");
            window.nodirkakhorlessa = 0;
            window.occupiedlessa = nodirkakhorlessa;
            window.remaininglessa = originallessa - occupiedlessa;
        }
        //alert(remaininglessa);
        var bigha_r = Math.floor(remaininglessa / 100);
        var katha_r = Math.floor((remaininglessa - bigha_r * 100) / 20);
        var lessa_r = (remaininglessa - bigha_r * 100 - katha_r * 20).toFixed(2);
    });
</script>
<!-- Department button script -->
<script src="<?php echo base_url('js/department/department.js'); ?>"></script>