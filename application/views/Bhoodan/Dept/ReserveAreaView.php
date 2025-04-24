<!-- RoadSide Area Details Begin -->
<?php if ($roadside_reservation == true) : ?>
    <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center"><i class="fa fa-road"></i>
        Roadside Reserve Area Details
    </h5>

    <p class="card-text">
        <?php $i = 1;

        $total_roadside_bigha = 0;
        $total_roadside_katha = 0;
        $total_roadside_lessa = 0;
        $total_roadside_ganda = 0;
        $total_roadside_kranti = 0;
        foreach ($roadside_reservation as $reservation) {

            $total_roadside_bigha = $total_roadside_bigha + $reservation->bigha;
            $total_roadside_katha = $total_roadside_katha + $reservation->katha;
            $total_roadside_lessa = $total_roadside_lessa + $reservation->lessa;
            $total_roadside_ganda = $total_roadside_ganda + $reservation->ganda;
            $total_roadside_kranti = $total_roadside_kranti + $reservation->kranti;

        ?>
    <table class="table table-bordered">

        <tr>
            <th>District:</th>
            <td>
                <strong class="alert-warning">
                    <?= $this->utilclass->getDistrictName($reservation->dist_code) ?>
                </strong>
            </td>

            <th>Subdiv:</th>
            <td>
                <strong class="alert-warning">
                    <?= $this->utilclass->getSubDivName($reservation->dist_code, $reservation->subdiv_code) ?>
                </strong>
            </td>
            <th>Circle:</th>
            <td>
                <strong class="alert-warning">
                    <?= $this->utilclass->getCircleName($reservation->dist_code, $reservation->subdiv_code, $reservation->cir_code) ?>
                </strong>
            </td>
        </tr>
        <tr>
            <th>Mouza:</th>
            <td>
                <strong class="alert-warning">
                    <?= $this->utilclass->getMouzaName($reservation->dist_code, $reservation->subdiv_code, $reservation->cir_code, $reservation->mouza_pargona_code) ?>
                </strong>
            </td>

            <th>Lot:</th>
            <td>
                <strong class="alert-warning">
                    <?= $this->utilclass->getLotName($reservation->dist_code, $reservation->subdiv_code, $reservation->cir_code, $reservation->mouza_pargona_code, $reservation->lot_no) ?>
                </strong>
            </td>
            <th>Village:</th>
            <td>
                <strong class="alert-warning">
                    <?= $this->utilclass->getVillageName($reservation->dist_code, $reservation->subdiv_code, $reservation->cir_code, $reservation->mouza_pargona_code, $reservation->lot_no, $reservation->vill_townprt_code) ?>
                </strong>
            </td>
        </tr>

        <tr>
            <th>Reserve Dag:</th>
            <td>
                <strong class="alert-warning">
                    <strong><?= $reservation->dag_no ?></strong>
                </strong>
            </td>

            <th>Patta Number:</th>
            <td>
                <strong class="alert-warning">
                    <strong><?= $reservation->patta_no ?></strong>
                </strong>
            </td>

        </tr>

        <tr>
            <th class="text-danger">Roadside Reserve Area</th>
            <td>
                <strong class="input-group-addon p-2"><?= $reservation->bigha ?></strong><span class="input-group-addon">Bigha</span>
            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $reservation->katha ?></strong><span class="input-group-addon">Katha</span>
            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $reservation->lessa ?></strong><span class="input-group-addon">Lessa</span>
            </td>
            <?php if ((in_array($reservation->dist_code, BARAK_VALLEY))) : ?>

                <td>
                    <strong class="input-group-addon p-2"><?= $reservation->ganda ?></strong><span class="input-group-addon">Ganda</span>
                </td>
                <td>
                    <strong class="input-group-addon p-2"><?= $reservation->kranti ?></strong><span class="input-group-addon">Kranti</span>
                </td>
            <?php endif; ?>
        </tr>


    </table>
<?php $i++;
        } ?>
</p>


<!--Total Roadside Reserve Area -->
<table class="table table-bordered">
    <tr>
        <th class="text-danger">Total Roadside Reserve Area </th>
        <td>
            <strong class="input-group-addon p-2"><?= $total_roadside_bigha ?></strong><span class="input-group-addon">Bigha</span>

        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $total_roadside_katha ?></strong><span class="input-group-addon">Katha</span>

        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $total_roadside_lessa ?></strong><span class="input-group-addon">Lessa</span>

        </td>
        <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>

            <td>
                <strong class="input-group-addon p-2"><?= $total_roadside_ganda ?></strong><span class="input-group-addon">Ganda</span>

            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $total_roadside_kranti ?></strong><span class="input-group-addon">Kranti</span>
            </td>
        <?php endif; ?>
    </tr>
</table>
<!-- Total Roadside Reserve Area End -->
<?php endif; ?>

<!-- Roadside Reserve Area Details End -->

<!-- Family Reserve Area Details Begin -->
<?php if ($family_reservation == true) : ?>
    <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center"><i class="fa fa-child"></i>
        Family Reserve Area Details
    </h5>
    <p class="card-text">
        <?php $i = 1;
        $total_family_bigha = 0;
        $total_family_katha = 0;
        $total_family_lessa = 0;
        $total_family_ganda = 0;
        $total_family_kranti = 0;
        foreach ($family_reservation as $reservation) {

            $total_family_bigha = $total_family_bigha + $reservation->bigha;
            $total_family_katha = $total_family_katha + $reservation->katha;
            $total_family_lessa = $total_family_lessa + $reservation->lessa;
            $total_family_ganda = $total_family_kranti + $reservation->ganda;
            $total_family_kranti = $total_family_kranti + $reservation->kranti;

        ?>
    <table class="table table-bordered">

        <tr>
            <th>District:</th>
            <td>
                <strong class="alert-warning">
                    <?= $this->utilclass->getDistrictName($reservation->dist_code) ?>
                </strong>
            </td>

            <th>Subdiv:</th>
            <td>
                <strong class="alert-warning">
                    <?= $this->utilclass->getSubDivName($reservation->dist_code, $reservation->subdiv_code) ?>
                </strong>
            </td>
            <th>Circle:</th>
            <td>
                <strong class="alert-warning">
                    <?= $this->utilclass->getCircleName($reservation->dist_code, $reservation->subdiv_code, $reservation->cir_code) ?>
                </strong>
            </td>
        </tr>
        <tr>
            <th>Mouza:</th>
            <td>
                <strong class="alert-warning">
                    <?= $this->utilclass->getMouzaName($reservation->dist_code, $reservation->subdiv_code, $reservation->cir_code, $reservation->mouza_pargona_code) ?>
                </strong>
            </td>

            <th>Lot:</th>
            <td>
                <strong class="alert-warning">
                    <?= $this->utilclass->getLotName($reservation->dist_code, $reservation->subdiv_code, $reservation->cir_code, $reservation->mouza_pargona_code, $reservation->lot_no) ?>
                </strong>
            </td>
            <th>Village:</th>
            <td>
                <strong class="alert-warning">
                    <?= $this->utilclass->getVillageName($reservation->dist_code, $reservation->subdiv_code, $reservation->cir_code, $reservation->mouza_pargona_code, $reservation->lot_no, $reservation->vill_townprt_code) ?>
                </strong>
            </td>
        </tr>
        <tr>
            <th>Reserve Dag:</th>
            <td>
                <strong class="alert-warning">
                    <strong><?= $reservation->dag_no ?></strong>
                </strong>
            </td>

            <th>Patta Number:</th>
            <td>
                <strong class="alert-warning">
                    <strong><?= $reservation->patta_no ?></strong>
                </strong>
            </td>

        </tr>

        <tr>
            <th class="text-success">Family Reserve Area</th>
            <td>
                <strong class="input-group-addon p-2"><?= $reservation->bigha ?></strong><span class="input-group-addon">Bigha</span>
            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $reservation->katha ?></strong><span class="input-group-addon">Katha</span>
            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $reservation->lessa ?></strong><span class="input-group-addon">Lessa</span>
            </td>
            <?php if ((in_array($reservation->dist_code, BARAK_VALLEY))) : ?>

                <td>
                    <strong class="input-group-addon p-2"><?= $reservation->ganda ?></strong><span class="input-group-addon">Ganda</span>
                </td>
                <td>
                    <strong class="input-group-addon p-2"><?= $reservation->kranti ?></strong><span class="input-group-addon">Kranti</span>
                </td>
            <?php endif; ?>
        </tr>
    </table>
<?php $i++;
        } ?>
</p>

<!--Total Family Reserve Area -->
<table class="table table-bordered">
    <tr>
        <th class="text-success">Total Family Reserve Area </th>
        <td>
            <strong class="input-group-addon p-2"><?= $total_family_bigha ?></strong><span class="input-group-addon">Bigha</span>

        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $total_family_katha ?></strong><span class="input-group-addon">Katha</span>

        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $total_family_lessa ?></strong><span class="input-group-addon">Lessa</span>

        </td>
        <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>

            <td>
                <strong class="input-group-addon p-2"><?= $total_family_ganda ?></strong><span class="input-group-addon">Ganda</span>

            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $total_family_kranti ?></strong><span class="input-group-addon">Kranti</span>
            </td>
        <?php endif; ?>
    </tr>
</table>
<!-- Total Family Reserve Area End -->
<?php endif; ?>

<!-- Family Reserve Area Details End -->



<!-- VGR Reserve Area Details Begin -->
<?php if ($vgr_reservation == true) : ?>
    <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center">
        VGR Reservation / De Reservation Area Details
    </h5>
    <p class="card-text">
        <?php $i = 1;

        $total_vgr_bigha = 0;
        $total_vgr_katha = 0;
        $total_vgr_lessa = 0;
        $total_vgr_ganda = 0;
        foreach ($vgr_reservation as $reservation) {

            $total_vgr_bigha = $total_vgr_bigha + $reservation->dag_area_b;
            $total_vgr_katha = $total_vgr_katha + $reservation->dag_area_k;
            $total_vgr_lessa = $total_vgr_lessa + $reservation->dag_area_lc;
            $total_vgr_ganda = $total_vgr_ganda + $reservation->dag_area_g;
        ?>
    <table class="table table-bordered">
        <!-- New Field Begin -->
        <tr>
            <th>District:</th>
            <td>
                <strong class="alert-warning">
                    <strong><?= $this->utilclass->getDistrictName($reservation->dist_code) ?></strong>
                </strong>
            </td>

            <th>Subdiv:</th>
            <td>
                <strong class="alert-warning">
                    <strong><?= $this->utilclass->getSubDivName($reservation->dist_code, $reservation->subdiv_code) ?></strong>
                </strong>
            </td>
            <th>Circle:</th>
            <td>
                <strong class="alert-warning">
                    <strong><?= $this->utilclass->getCircleName($reservation->dist_code, $reservation->subdiv_code, $reservation->cir_code) ?></strong>
                </strong>
            </td>
        </tr>
        <tr>
            <th>Mouza:</th>
            <td>
                <strong class="alert-warning">
                    <strong><?= $this->utilclass->getMouzaName($reservation->dist_code, $reservation->subdiv_code, $reservation->cir_code, $reservation->mouza_pargona_code) ?></strong>
                </strong>
            </td>
            <th>Lot:</th>
            <td>
                <strong class="alert-warning">
                    <strong><?= $this->utilclass->getLotName($reservation->dist_code, $reservation->subdiv_code, $reservation->cir_code, $reservation->mouza_pargona_code, $reservation->lot_no) ?></strong>
                </strong>
            </td>
            <th>Village:</th>
            <td>
                <strong class="alert-warning">
                    <strong><?= $this->utilclass->getVillageName($reservation->dist_code, $reservation->subdiv_code, $reservation->cir_code, $reservation->mouza_pargona_code, $reservation->lot_no, $reservation->vill_townprt_code) ?></strong>
                </strong>
            </td>

        </tr>
        <!-- New Field End -->
        <tr>
            <th>Reserve Dag:</th>
            <td>
                <strong class="alert-warning">
                    <strong><?= $reservation->dag_no ?></strong>
                </strong>
            </td>
        </tr>

        <tr>
            <th class="text-primary">VGR Reserve Area</th>
            <td>
                <strong class="input-group-addon p-2"><?= $reservation->dag_area_b ?></strong><span class="input-group-addon">Bigha</span>
            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $reservation->dag_area_k ?></strong><span class="input-group-addon">Katha</span>
            </td>
            <td>
                <strong class="input-group-addon p-2"><?= $reservation->dag_area_lc ?></strong><span class="input-group-addon">Lessa</span>
            </td>
            <?php if ((in_array($reservation->dist_code, BARAK_VALLEY))) : ?>

                <td>
                    <strong class="input-group-addon p-2"><?= $reservation->dag_area_g ?></strong><span class="input-group-addon">Ganda</span>
                </td>
            <?php endif; ?>
        </tr>
    </table>
<?php $i++;
        } ?>
</p>

<!--Total VGR Reserve Area -->
<table class="table table-bordered">
    <tr>
        <th class="text-primary">Total VGR Reserve Area </th>
        <td>
            <strong class="input-group-addon p-2"><?= $total_vgr_bigha ?></strong><span class="input-group-addon">Bigha</span>

        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $total_vgr_katha ?></strong><span class="input-group-addon">Katha</span>

        </td>
        <td>
            <strong class="input-group-addon p-2"><?= $total_vgr_lessa ?></strong><span class="input-group-addon">Lessa</span>

        </td>
        <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>

            <td>
                <strong class="input-group-addon p-2"><?= $total_vgr_ganda ?></strong><span class="input-group-addon">Ganda</span>

            </td>
        <?php endif; ?>
    </tr>
    <?php foreach ($settlement_ap_lmnote as $lmnote) : ?>
        <tr>
            <th>VGR Dag Availability:</th>
            <td>
                <?php if (($lmnote->vgr_dag_availability == "Y") || ($lmnote->vgr_dag_availability == "y")) { ?>
                    <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                <?php } else if (($lmnote->vgr_dag_availability == "N") || ($lmnote->vgr_dag_availability == "n")) { ?>
                    <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                <?php } ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<!-- Total VGR Reserve Area End -->
<?php endif; ?>
<!-- VGR Reserve Area Details End -->