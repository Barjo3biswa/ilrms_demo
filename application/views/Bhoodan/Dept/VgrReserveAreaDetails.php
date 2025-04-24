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
        $total_vgr_kranti = 0;
        foreach ($vgr_reservation as $reservation) {

            $total_vgr_bigha = $total_vgr_bigha + $reservation->bigha;
            $total_vgr_katha = $total_vgr_katha + $reservation->katha;
            $total_vgr_lessa = $total_vgr_lessa + $reservation->lessa;
            $total_vgr_ganda = $total_vgr_ganda + $reservation->ganda;
            $total_vgr_kranti = $total_vgr_kranti + $reservation->kranti;
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

            <th>Patta Number:</th>
            <td>
                <strong class="alert-warning">
                    <strong><?= $reservation->patta_no ?></strong>
                </strong>
            </td>
        </tr>

        <tr>
            <th class="text-primary">VGR Reserve Area</th>
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
            <td>
                <strong class="input-group-addon p-2"><?= $total_vgr_kranti ?></strong><span class="input-group-addon">Kranti</span>
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