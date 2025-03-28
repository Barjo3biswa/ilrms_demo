<?php if (isset($property) && !empty($property)) : ?>

    <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center"><i class="fa fa-home" aria-hidden="true"></i>
        Additonal Property Details
    </h5>
    <p class="card-text">
        <?php $i = 1;
        foreach ($property as $adp) : ?>
    <table class="table table-bordered">

        <tr>
            <th rowspan="4" style="vertical-align : middle;text-align:center;background-color:#27ae60;"><?= $i++; ?></th>

            <th>District:</th>
            <td colspan="2">
                <strong class="alert-primary">
                    <?= $this->utilclass->getDistrictName($adp->dist_code) ?>
                </strong>
            </td>

            <th>Subdiv:</th>
            <td colspan="2">
                <strong class="alert-primary">
                    <?= $this->utilclass->getSubDivName($adp->dist_code, $adp->subdiv_code) ?>
                </strong>
            </td>
            <th>Circle:</th>
            <td colspan="2">
                <strong class="alert-primary">
                    <?= $this->utilclass->getCircleName($adp->dist_code, $adp->subdiv_code, $adp->cir_code) ?>
                </strong>
            </td>
        </tr>

        <tr>
            <th>Mouza:</th>
            <td colspan="2">
                <strong class="alert-primary">
                    <?= $this->utilclass->getMouzaName($adp->dist_code, $adp->subdiv_code, $adp->cir_code, $adp->mouza_pargona_code) ?>
                </strong>
            </td>

            <th>Lot:</th>
            <td colspan="2">
                <strong class="alert-primary">
                    <?= $this->utilclass->getLotName($adp->dist_code, $adp->subdiv_code, $adp->cir_code, $adp->mouza_pargona_code, $adp->lot_no) ?>
                </strong>
            </td>
            <th>Village:</th>
            <td colspan="2">
                <strong class="alert-primary">
                    <?= $this->utilclass->getVillageName($adp->dist_code, $adp->subdiv_code, $adp->cir_code, $adp->mouza_pargona_code, $adp->lot_no, $adp->vill_townprt_code) ?>
                </strong>
            </td>
        </tr>
        <tr>
            <th>Dag Number:</th>
            <td colspan="2">
                <strong class="alert-primary">
                    <?= $adp->dag_no ?>
                </strong>
            </td>

            <th>Patta Number:</th>
            <td colspan="2">
                <strong class="alert-primary">
                    <?= $adp->patta_no ?>
                </strong>
            </td>
        </tr>
        <tr>
            <th>Total Additional Land Details</th>
            <td colspan="2">
                <strong class="input-group-addon p-2"><?= $adp->bigha ?></strong><span class="input-group-addon">Bigha</span>
            </td>
            <td colspan="2">
                <strong class="input-group-addon p-2"><?= $adp->katha ?></strong><span class="input-group-addon">Katha</span>
            </td>
            <td colspan="2">
                <strong class="input-group-addon p-2"><?= $adp->lessa ?></strong><span class="input-group-addon">Lessa</span>
            </td>
            <?php if ((in_array($adp->dist_code, BARAK_VALLEY))) : ?>

                <td colspan="2">
                    <strong class="input-group-addon p-2"><?= $adp->ganda ?></strong><span class="input-group-addon">Ganda</span>
                </td>
                <td colspan="2">
                    <strong class="input-group-addon p-2"><?= $adp->kranti ?></strong><span class="input-group-addon">Kranti</span>
                </td>
            <?php endif; ?>
        </tr>
    </table>
<?php endforeach;
?>
</p>
<?php endif; ?>