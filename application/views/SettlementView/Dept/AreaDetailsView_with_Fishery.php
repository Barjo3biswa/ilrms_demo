<!-- Area Details Begin -->
<h5 class="bg-secondary p-2 text-white shadow mt-2">
    Area Details
</h5>
<p class="card-text">
    <?php
    $i = 1;
    $total_home_bigha = 0;
    $total_home_katha = 0;
    $total_home_lessa = 0;
    $total_home_ganda = 0;
    $total_home_kranti = 0;

    $total_agri_bigha = 0;
    $total_agri_katha = 0;
    $total_agri_lessa = 0;
    $total_agri_ganda = 0;
    $total_agri_kranti = 0;

    // $total_fishery_bigha = 0;
    // $total_fishery_katha = 0;
    // $total_fishery_lessa = 0;
    // $total_fishery_ganda = 0;
    // $total_fishery_kranti = 0;

    foreach ($settlement_dag_area as $dag_details) {
        $total_home_bigha = $total_home_bigha + $dag_details->home_b;
        $total_home_katha = $total_home_katha + $dag_details->home_k;
        $total_home_lessa = $total_home_lessa + $dag_details->home_lc;
        $total_home_ganda = $total_home_ganda + $dag_details->home_g;
        $total_home_kranti = $total_home_kranti + $dag_details->home_kr;

        $total_agri_bigha = $total_agri_bigha + $dag_details->agri_b;
        $total_agri_katha = $total_agri_katha + $dag_details->agri_k;
        $total_agri_lessa = $total_agri_lessa + $dag_details->agri_lc;
        $total_agri_ganda = $total_agri_ganda + $dag_details->agri_g;
        $total_agri_kranti = $total_agri_kranti + $dag_details->agri_kr;


        // $total_fishery_bigha = $total_fishery_bigha + $dag_details->fbigha;
        // $total_fishery_katha = $total_fishery_katha + $dag_details->fkatha;
        // $total_fishery_lessa = $total_fishery_lessa + $dag_details->flessa;
        // $total_fishery_ganda = $total_fishery_ganda + $dag_details->fganda;
        // $total_fishery_kranti = $total_fishery_kranti + $dag_details->fkranti;

        $all_total_bigha_area = $total_agri_bigha + $total_home_bigha;
        $all_total_katha_area = $total_agri_katha + $total_home_katha;
        $all_total_lessa_area = $total_agri_lessa + $total_home_lessa;
        $all_total_ganda_area = $total_agri_ganda + $total_home_ganda;
        $all_total_kranti_area = $total_agri_kranti + $total_home_kranti;

    ?>
<table class="table table-bordered">
    <tr>
        <th>Dag Number:</th>
        <td>
            <strong class="alert-warning">
                <strong><?= $dag_details->dag_no ?></strong>
            </strong>
        </td>

        <th>Patta Number:</th>
        <td>
            <strong class="alert-warning">
                <strong><?= $dag_details->patta_no ?></strong>
            </strong>
        </td>
        <th>Patta type:</th>
        <td>
            <strong class="alert-warning">
                <strong><?= $this->utilclass->getPattaType($dag_details->patta_type_code) ?></strong>

            </strong>
        </td>

    </tr>

    <tr>
        <th>Total Land Area in Selected Dag</th>
        <td>
            <strong class="input-group-addon p-2"><?= $dag_details->dag_area_b ?></strong><span class="input-group-addon">Bigha</span>
        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $dag_details->dag_area_k ?></strong><span class="input-group-addon">Katha</span>
        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $dag_details->dag_area_lc ?></strong><span class="input-group-addon">Lessa</span>
        </td>
        <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>

            <td>
                <strong class="input-group-addon p-2"><?= $dag_details->dag_area_g ?></strong><span class="input-group-addon">Ganda</span>
            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $dag_details->dag_area_kr ?></strong><span class="input-group-addon">Kranti</span>
            </td>
        <?php endif; ?>
    </tr>

    <?php if ($dag_details->home_b != '' && $dag_details->home_k != '' && $dag_details->home_k != '') : ?>

        <?php if ($settlement_basic['service_code'] != SETTLEMENT_SPECIAL_CULTIVATORS_ID) : ?>
            <!-- Homested Area -->
            <tr>
                <th class="text-success">Applied Area(Homestead)</th>
                <td>
                    <strong class="input-group-addon p-2"><?= $dag_details->home_b ?></strong><span class="input-group-addon">Bigha</span>

                </td>
                <td>
                    <strong class="input-group-addon p-2"><?= $dag_details->home_k ?></strong><span class="input-group-addon">Katha</span>

                </td>
                <td>
                    <strong class="input-group-addon p-2"><?= $dag_details->home_lc ?></strong><span class="input-group-addon">Lessa</span>

                </td>
                <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>
                    <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->home_g ?></strong><span class="input-group-addon">Ganda</span>
                    </td>
                    <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->home_kr ?></strong><span class="input-group-addon">Kranti</span>
                    </td>
                <?php endif; ?>
            </tr>
            <!-- Homestead Area End -->
        <?php endif; ?>

    <?php endif; ?>

    <?php if ($dag_details->agri_b != '' && $dag_details->agri_k != '' && $dag_details->agri_lc != '') : ?>

        <?php if ($settlement_basic['service_code'] != SETTLEMENT_PGR_VGR_LAND_ID) : ?>
            <!-- Agri Area -->
            <tr>
                <th class="text-success">Applied Area(Agricultural)</th>
                <td>
                    <strong class="input-group-addon p-2"><?= $dag_details->agri_b ?></strong><span class="input-group-addon">Bigha</span>

                </td>
                <td>
                    <strong class="input-group-addon p-2"><?= $dag_details->agri_k ?></strong><span class="input-group-addon">Katha</span>

                </td>
                <td>
                    <strong class="input-group-addon p-2"><?= $dag_details->agri_lc ?></strong><span class="input-group-addon">Lessa</span>

                </td>
                <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>

                    <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->agri_g ?></strong><span class="input-group-addon">Ganda</span>
                    </td>
                    <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->agri_kr ?></strong><span class="input-group-addon">Kranti</span>
                    </td>
                <?php endif; ?>
            </tr>
            <!-- Agri Area End -->
        <?php endif; ?>
    <?php endif; ?>



    <!-- Fishery Area -->
    <?php /*
    <tr>
        <th class="text-success">Applied Area(Fishery) </th>
        <td>
            <strong class="input-group-addon p-2"><?= $dag_details->fbigha ?></strong><span class="input-group-addon">Bigha</span>

        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $dag_details->fkatha ?></strong><span class="input-group-addon">Katha</span>

        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $dag_details->flessa ?></strong><span class="input-group-addon">Lessa</span>

        </td>
        <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>

            <td>
                <strong class="input-group-addon p-2"><?= $dag_details->fganda ?></strong><span class="input-group-addon">Ganda</span>
            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $dag_details->fkranti ?></strong><span class="input-group-addon">Kranti</span>
            </td>
        <?php endif;
        ?>
    </tr>
    */ ?>
    <!-- Fishery Area End -->

</table>
<?php $i++;
    }  ?>

<table class="table table-bordered">
    <?php if ($settlement_basic['service_code'] != SETTLEMENT_SPECIAL_CULTIVATORS_ID) : ?>
        <!--Total Homestead Area -->
        <tr>
            <th class="text-primary">Total Applied Area(Homestead)</th>
            <td>
                <strong class="input-group-addon p-2"><?= $total_home_bigha ?></strong><span class="input-group-addon">Bigha</span>

            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $total_home_katha ?></strong><span class="input-group-addon">Katha</span>

            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $total_home_lessa ?></strong><span class="input-group-addon">Lessa</span>

            </td>
            <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>

                <td>
                    <strong class="input-group-addon p-2"><?= $total_home_ganda ?></strong><span class="input-group-addon">Ganda</span>

                </td>
                <td>
                    <strong class="input-group-addon p-2"><?= $total_home_kranti ?></strong><span class="input-group-addon">Kranti</span>
                </td>
            <?php endif; ?>
        </tr>
        <!-- TotaL Homestead Area End -->
    <?php endif; ?>

    <?php if ($settlement_basic['service_code'] != SETTLEMENT_PGR_VGR_LAND_ID) : ?>
        <!--Total Agri Area -->
        <tr>
            <th class="text-primary">Total Applied Area(Agricultural)</th>
            <td>
                <strong class="input-group-addon p-2"><?= $total_agri_bigha ?></strong><span class="input-group-addon">Bigha</span>

            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $total_agri_katha ?></strong><span class="input-group-addon">Katha</span>

            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $total_agri_lessa ?></strong><span class="input-group-addon">Lessa</span>

            </td>
            <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>

                <td>
                    <strong class="input-group-addon p-2"><?= $total_agri_ganda ?></strong><span class="input-group-addon">Ganda</span>

                </td>
                <td>
                    <strong class="input-group-addon p-2"><?= $total_agri_kranti ?></strong><span class="input-group-addon">Kranti</span>
                </td>
            <?php endif; ?>
        </tr>
        <!-- TotaL Agri Area End -->
    <?php endif; ?>



    <!--Total Fishery Area -->
    <?php /*
    <tr>
        <th class="text-primary">Total Applied Area(Fishery)</th>
        <td>
            <strong class="input-group-addon p-2"><?= $total_fishery_bigha ?></strong><span class="input-group-addon">Bigha</span>
        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $total_fishery_katha ?></strong><span class="input-group-addon">Katha</span>
        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $total_fishery_lessa ?></strong><span class="input-group-addon">Lessa</span>

        </td>
        <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>

            <td>
                <strong class="input-group-addon p-2"><?= $total_fishery_ganda ?></strong><span class="input-group-addon">Ganda</span>
            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $total_fishery_kranti ?></strong><span class="input-group-addon">Kranti</span>
            </td>
        <?php endif; ?>
    </tr>

    */ ?>
    <!-- Total Fishery Area End -->


    <!--Total Agri + Home Area -->
    <tr>
        <!-- <th class="text-danger">Total Applied Area(Agricultural + Homestead + Fishery)</th> -->
        <th class="text-danger">Total Applied Area(Agricultural + Homestead)</th>
        <td>
            <strong class="input-group-addon p-2"><?= $all_total_bigha_area ?></strong><span class="input-group-addon">Bigha</span>

        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $all_total_katha_area ?></strong><span class="input-group-addon">Katha</span>

        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $all_total_lessa_area ?></strong><span class="input-group-addon">Lessa</span>

        </td>
        <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>

            <td>
                <strong class="input-group-addon p-2"><?= $all_total_ganda_area ?></strong><span class="input-group-addon">Ganda</span>

            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $all_total_kranti_area ?></strong><span class="input-group-addon">Kranti</span>
            </td>
        <?php endif; ?>
    </tr>
    <!-- TotaL Agri + HomeArea End -->

    <!-- Aadhaar Wise Application Applicant-->
    <tr>
        <th class="bg-success">Total Applications Received for this Dag</th>
        <td>
            <a type="button" target="_blank" class="btn btn btn-sm btn-warning" href="<?php echo base_url(); ?>Basundhara/apiDagWiseApplication?app=<?= $_GET['app'] ?>&dist_code=<?= $_GET['dist_code'] ?>&dag_no=<?= $dag_details->dag_no ?>"><i class="fa fa-eye"></i> <small>View Applications</small>
            </a>
        </td>
    </tr>
    <!-- Aadhaar Wise Application by Applicant End-->
</table>
</p>
<!-- Area Details End -->