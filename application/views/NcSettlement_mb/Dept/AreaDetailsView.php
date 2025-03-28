<!-- Area Details Begin -->
<h5 class="bg-secondary p-2 text-white shadow mt-2 text-center">
    Area Details
</h5>

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
            <?php if ((in_array($dag_details->dist_code, BARAK_VALLEY))) : ?>

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
                    <th class="text-success">Area for Settlement(Homestead)</th>
                    <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->home_b ?></strong><span class="input-group-addon">Bigha</span>

                    </td>
                    <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->home_k ?></strong><span class="input-group-addon">Katha</span>

                    </td>
                    <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->home_lc ?></strong><span class="input-group-addon">Lessa</span>

                    </td>
                    <?php if ((in_array($dag_details->dist_code, BARAK_VALLEY))) : ?>
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
                    <th class="text-success">Area for Settlement (Agricultural)</th>
                    <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->agri_b ?></strong><span class="input-group-addon">Bigha</span>

                    </td>
                    <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->agri_k ?></strong><span class="input-group-addon">Katha</span>

                    </td>
                    <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->agri_lc ?></strong><span class="input-group-addon">Lessa</span>

                    </td>
                    <?php if ((in_array($dag_details->dist_code, BARAK_VALLEY))) : ?>

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
    </table>
<?php $i++;
}  ?>

<!-- Area Details End -->

<!-- All Applications in the Dag-->
<div class="row">
    <div  class="col-md-8">
    </div>
    <div  class="col-md-4">
        <a type="button" target="_blank" style="" class="btn btn btn-sm btn-secondary" href="<?php echo base_url(); ?>Basundhara/apiDagWiseApplication?app=<?= $_GET['app'] ?>&dist_code=<?= $_GET['dist_code'] ?>&dag_no=<?= $dag_details->dag_no ?>"><i class="fa fa-eye"></i> <small>View All Applications in this Dag</small></a>
    </div>
</div>
<br>
<!-- All Applications in the Dag End-->
