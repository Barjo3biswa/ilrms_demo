<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>ILRMS Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Government of Assam ILRMS Dashboard. Application for Integrated Land Records Management System">
    <meta name="keywords" content="NOC, Dharitree, Bhunaksha, epanjeeyan, NIC, National Informatics Centre, ILRMS, Integrated Land Records Management System, NIC Assam State Centre, Government of Assam, Revenue and Disaster Management Department Assam, Revenue Department Assam">
    <meta name="author" content="National Informatics Centre Assam">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?php echo base_url('css/styles.css'); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/department_style.css">

    <link rel="stylesheet" href="<?php echo base_url('fonts/css/font-awesome.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/dataTables.jqueryui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="<?php echo base_url('js/jquery-3.4.1.min.js'); ?>"></script>
</head>
<style>
    table {
        border-collapse: collapse;
    }

    th,
    td {
        border: 1.5px solid black;
        padding: 10px;
        text-align: left;
    }

    /* tr:hover {
        background-color: coral;
    } */

    body {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
<link href="<?php echo base_url('css/department_style.css'); ?>" rel="stylesheet" />

<body style="padding-right:4rem;padding-left:4rem ;margin-bottom:3rem">
    <div class="row" style='padding: 40px 20px 40px 20px; text-align: center;'>
        <h5 class="text-center">
            <h4 class="case-no-bg text-danger">Details of Case <?= $_GET['app'] ?>, <?= $case_no ?></h4>
        </h5>
    </div>




    <!-- Address Information Begin -->
    <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center"><i class="fa fa-map" aria-hidden="true"></i>
        Location Information
    </h5>
    <p class="card-text">
    <table class="table ">
        <tr>
            <th>District :</th>
            <td class="text-warning">
                <strong class="alert-warning">
                    <p><?= $this->utilclass->getDistrictName($settlement_basic['dist_code']) ?></p>
                </strong>
            </td>
            <th>Subdivision :</th>
            <td class="text-warning">
                <strong class="alert-warning">
                    <p><?= $this->utilclass->getSubDivName($settlement_basic['dist_code'], $settlement_basic['subdiv_code']) ?></p>
                </strong>
            </td>
        </tr>
        <tr>
            <th>Circle : </th>
            <td class="text-warning">
                <strong class="alert-warning">
                    <p><?= $this->utilclass->getCircleName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code']) ?></p>
                </strong>
            </td>
            <th>Mouza : </th>
            <td class="text-warning">
                <strong class="alert-warning">
                    <p><?= $this->utilclass->getMouzaName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code']) ?></p>
                </strong>
            </td>
        </tr>
        <tr>
            <th>Lot : </th>
            <td class="text-warning">
                <strong class="alert-warning">
                    <p><?= $this->utilclass->getLotName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code'], $settlement_basic['lot_no']) ?></p>

                </strong>
            </td>
            <th>Village : </th>
            <td class="text-warning">
                <strong class="alert-warning">
                    <p><?= $this->utilclass->getVillageName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code'], $settlement_basic['lot_no'], $settlement_basic['vill_townprt_code']) ?></p>

                </strong>
            </td>
        </tr>
    </table>
    </p>
    <!--Address Information End  -->


    <!-- Applicant Details -->
    <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center"><i class="fa fa-user" aria-hidden="true"></i>
        Applicant Details
    </h5>
    <p class="card-text">
        <?php $i = 1;
        foreach ($applicants_buyers as $settlement) : ?>
    <table class="table table-bordered">
        <tr>
            <th rowspan="5" style="vertical-align : middle;text-align:center;background-color:#2980b9"><?= $i++; ?></th>
            <th>Name ( Assamese)</th>
            <td colspan="2">
                <strong class="text-primary"><?= $settlement->pdar_name; ?></strong>
            </td>
            <th>Gurdian Name ( Assamese)</th>
            <td colspan="2">
                <strong class="text-primary"><?= $settlement->pdar_guardian; ?></strong>
            </td>
        </tr>

        <tr>
            <th>Name ( English)</th>
            <td colspan="2">
                <strong class="text-primary"><?= $settlement->eng_pdar_name; ?></strong>
            </td>
            <th>Gurdian Name ( English)</th>
            <td colspan="2">
                <strong class="text-primary"><?= $settlement->eng_pdar_guardian; ?></strong>
            </td>
        </tr>

        <tr>
            <th>Relation</th>
            <td colspan="2">
                <span?><?= $this->utilclass->getGuardianRelation($settlement->pdar_rel_guar) ?></strong>
            </td>
            <th>Gender</th>
            <td colspan="2">
                <span><?= $this->utilclass->getGender($settlement->pdar_gender) ?></span>
            </td>
        </tr>
    </table>
<?php endforeach; ?>
</p>
<!-- Applicant Details End -->

<!-- Area Details Begin -->
<h5 class="bg-secondary p-2 text-white shadow mt-2 text-center">
    Dag Area Details
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
    <table class="table ">
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
                    <strong>(<?= $this->utilclass->getPattaType($dag_details->patta_type_code) ?>)</strong>

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



<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table style="width:100%">
            <tr>
                <th style="width:5%">Sl. No</th>
                <th style="width:60%">Check List for Allotment</th>
                <th style="width:35%">Values</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Present and Permanment Address of the petitioner</td>
                <td>
                <?php $i = 1;
                foreach ($applicants_buyers as $settlement) : ?>
                    <span>Permanent Add: <?= $settlement->pdar_add1; ?><br> Present Add: <?= $settlement->pdar_add2; ?>;</span><br>
                <?php break; endforeach; ?>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Occupation of the petitioner</td>
                <td><?= $settlement_basic['occupation_applicant']; ?></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Landed proporty of the petitioner and his family(if any) within the state</td>
                <?php $i = 1;
                foreach ($settlement_ap_lmnote as $lmnote) : ?>
                    <?php if ($lmnote->is_landless == YES) { ?>
                        <td> Completely Landless</td>
                    <?php } else if ($lmnote->is_landless == NO || $lmnote->is_landless == 'OTHERS') { ?>
                        <td> Landless as per policy / Having Land</td>
                    <?php } ?>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>4</td>
                <td style="font-weight:bold">Self Declation of Applicant</td>
                <td></td>
            </tr>

            <?php $i = 4.0;
            foreach ($selfDeclarationDetails[0] as $key => $self) { ?>
                <tr>
                    <td class="text-danger"><i class="fa fa-check-square-o" style="font-size:15px"></i></td>
                    <td><small class="text-danger"><?= $self->name ?></small></td>
                    <?php if ($self->status == "1") { ?>
                        <td class="text-success"> Yes</td>
                    <?php } else if ($self->status == "0") { ?>
                        <td class="text-danger">No</td>
                    <?php } ?>
                </tr>
            <?php } ?>

            <?php $i = 1;
            foreach ($settlement_ap_lmnote as $lmnote) : ?>
                <tr>
                    <td>5</td>
                    <td>Whether Landless, if so how(Specific comment from CO/DC)</td>

                    <?php if (($lmnote->is_landless == "Yes") || ($lmnote->is_landless == "YES")) { ?>
                        <td> Yes</td>
                    <?php } else if (($lmnote->is_landless == "No") || ($lmnote->is_landless == "NO")) { ?>
                        <td> No</td>
                    <?php } ?>
                </tr>

                <tr>
                    <td>6</td>
                    <td>Schedule of the Land and area Under Occupation</td>

                    <?php if ((($lmnote->possession_verification) == "Yes") || (($lmnote->possession_verification) == "YES")) { ?>
                        <td> Yes</td>
                    <?php } else if ((($lmnote->possession_verification) == "No") || (($lmnote->possession_verification) == "NO")) { ?>
                        <td> No</td>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td>10</td>
                <td>Period of possession specifying the natute of possession alongwith the status as per Village Land Bank</td>
                <td><?= date("j F, Y", strtotime($settlement_enc->period_possession)) ?></td>
            </tr>
            <tr>
                <td>12</td>
                <td>Two Copies of the Chitha of the proposed Land</td>
                <td>
                    <?php
                    foreach ($settlement_dag_area as $ddg) {
                    ?>
                        <i class="fa fa-link" aria-hidden="true"></i>
                        <button type="button" class="" onclick="getChithaCopy('<?php echo $settlement_basic['dist_code']; ?>','<?php echo $settlement_basic['subdiv_code']; ?>','<?php echo $settlement_basic['cir_code']; ?>','<?php echo $settlement_basic['mouza_pargona_code']; ?>','<?php echo $settlement_basic['lot_no']; ?>','<?php echo $settlement_basic['vill_townprt_code']; ?>','<?php echo $ddg->dag_no; ?>','<?php echo $ddg->patta_type_code; ?>')"><u><span class="text-primary" style="font-size:16px;">Dag - <?= $ddg->dag_no ?> (Chitha)</span></u></button>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>13</td>
                <td> Copies of the trace map of the proposed Land clesarly highlightling the proposed Land Road/Riverside Reservation etc(if any)</td>
                <?php foreach ($trace_map as $docs) : ?>
                    <td>
                        <input type="hidden" name="district_code" value="<?= $settlement_basic['dist_code']; ?>">
                        <input type="hidden" name="doc_id" value="<?= $docs->id ?>">
                        <a target='download' href="<?php echo base_url(); ?>index.php/Basundhara/viewDharitreeDocument/<?= $settlement_basic['dist_code']; ?>/<?= $docs->id ?>"><i class="fa fa-paperclip"></i> <?= $docs->file_name; ?></a>
                    </td>
                <?php endforeach; ?>
            </tr>


            <tr>
                <td>13</td>
                <td>Provision of Road/Drain whether kept while preparing the proposal</td>
                <?php if ($roadside_reservation == true) { ?>
                    <td> Yes</td>
                <?php } else if ($roadside_reservation == false) { ?>
                    <td> No</td>
                <?php } ?>
            </tr>

            <tr>
                <td>15</td>
                <td>Whether the proposed Land falls under PGR/VGR/Wet Land/CS Land/Khas Govt. Land/NR Govt. Land/Green Belt Area/Reserve for Govt. Departments/Ancient Monuments/Reserve for other purposes. RF/PRF/Un-classed Forest Land/ Wildlife sancuary or any Land barred for Allotment/Settlement by a judicial pronouncement or any central or state Legislation</td>
                <td><?php foreach (json_decode(LB_NATURE_OF_RESERVATION) as $landCode) {
                        if ($landCode->CODE == $lmnote->land_falls) {
                            echo $landCode->NAME;
                        }
                    }
                    ?>
                </td>
            </tr>

            <tr>
                <td>16</td>
                <td>Wheter the proposed Land falls within 10 KM radius from the periphery of GMDA/GMC or within the periphery of 3KM from other TCs/MBs/Revenue town of the state</td>
                <?php $i = 1;
                foreach ($settlement_ap_lmnote as $lmnote) : ?>

                    <?php if (($lmnote->falls_und_gmc == "Yes") || ($lmnote->falls_und_gmc == "YES")) { ?>
                        <td> Yes</td>
                    <?php } else if (($lmnote->falls_und_gmc == "No") || ($lmnote->falls_und_gmc == "NO")) { ?>
                        <td> No</td>
                    <?php } ?>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>17</td>
                <td>Specific comment on Roadside/Riverside reservation(if any, alongwith provision kept for road/drain whereever necessary)</td>
                <?php $i = 1;
                foreach ($settlement_ap_lmnote as $lmnote) : ?>
                   <td><?= $lmnote->roadside_reservation != NULL ? $lmnote->roadside_reservation : 'No' ?></td>
                <?php endforeach; ?>

            </tr>


            <tr>
                <td>19</td>
                <td>Zonal valuation/ current market value of the proposed land and assesment of the settlement premium as per standing Govt. Circular</td>
                <td>
                    <?php
                    foreach ($settlement_dag_area as $ddg) {
                    ?>
                        <input type="hidden" name="district_code" value="<?= $uuid = $this->utilclass->getVillageUUID($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code'], $settlement_basic['lot_no'], $settlement_basic['vill_townprt_code']) ?>">
                        <button type="button" class=""><u><span class="text-primary" style="font-size:16px;">Dag - <?= $ddg->dag_no ?> (Zonal Value : <?= $this->utilclass->getZonalValue($settlement_basic['dist_code'], $uuid, $ddg->dag_no) ?>)</span></u></button>


                    <?php } ?>
                </td>
            </tr>

            <tr>
                <td>20</td>
                <td>Whether the petioner is differntly abled/ SC/ST/OBC/Ex-Servicemen/Widow/Others</td>

                <td><?php $i = 1;
                    foreach ($settlement_applicant as $lmnote) : ?>
                        <?php foreach (json_decode(CASTE) as $caste) {
                            if ($caste->CODE == $lmnote->caste) {
                                echo $landCode->NAME;
                            }
                        }
                        ?>
                    <?php endforeach; ?>

                </td>
            </tr>
            <tr>
                <td>21</td>
                <td>SDLAC Recommendation</td>
                <td><?php echo $case_status ?></td>
            </tr>
            <tr>
                <td>22</td>
                <td>Photograph of the proposed Land along with the house(if any) over it duly signed by the applicant,LM,CO and countersigned by DC/ADC</td>

                <?php foreach ($geo_tag as $docs) : ?>
                    <td>
                        <input type="hidden" name="district_code" value="<?= $settlement_basic['dist_code']; ?>">
                        <input type="hidden" name="doc_id" value="<?= $docs->id ?>">
                        <a target='download' href="<?php echo base_url(); ?>index.php/Basundhara/viewDharitreeDocument/<?= $settlement_basic['dist_code']; ?>/<?= $docs->id ?>"><i class="fa fa-paperclip"></i> <?= $docs->file_name; ?></a>
                    </td>
                <?php endforeach; ?>
            </tr>

            <tr>
                <td>23</td>
                <td>Whether the proposed Land is safe for habitation considering vulnarabilty towards Erosion, Landslide etc</td>
                <?php $i = 1;
                foreach ($settlement_ap_lmnote as $lmnote) : ?>

                    <?php if ((trim($lmnote->erosion) == "Yes") || (trim($lmnote->erosion) == "YES")) { ?>
                        <td> Yes</td>
                    <?php } else if ((trim($lmnote->erosion) == "No") || (trim($lmnote->erosion) == "NO")) { ?>
                        <td> No</td>
                    <?php } ?>
                <?php endforeach; ?>

            </tr>
            <tr>
                <td>24</td>
                <td> LM Field Report</td>
                <?php foreach ($field_report as $docs) : ?>
                    <td>
                        <input type="hidden" name="district_code" value="<?= $settlement_basic['dist_code']; ?>">
                        <input type="hidden" name="doc_id" value="<?= $docs->id ?>">
                        <a target='download' href="<?php echo base_url(); ?>index.php/Basundhara/viewDharitreeDocument/<?= $settlement_basic['dist_code']; ?>/<?= $docs->id ?>"><i class="fa fa-paperclip"></i> <?= $docs->file_name; ?></a>
                    </td>
                <?php endforeach; ?>
            </tr>

            <tr>

            </tr>

        </table>
    </div>
</div>
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
    <table class="table ">

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
<table class="table ">
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


<!-- chitha Details -->
<?php
include(APPPATH . "views/SettlementView/Dept/chithaCopyView.php");
?>
<!-- chitha Details End -->

<div class="row" style='text-align: center;'>
    <h5 class="text-center">
        <h4 class="case-no-bg text-danger">LM/CO/SDO/ADC/DC Remarks</h4>
    </h5>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table style="width:100%">
            <tr class="bg-secondary">
                <th class="text-center" style="width:20%">Date & Time of Remark</th>
                <th class="text-center" style="width:20%">Time of Remark</th>
                <th class="text-center" style="width:20%">Remark from</th>
                <th class="text-center" style="width:30%">Remarks</th>
            </tr>
            <?php $i = 1;
            foreach ($proceedings as $pro) : ?>
                <tr>
                    <td class="text-center">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <?= date("j F, Y", strtotime($pro->date_entry)) ?>
                    </td>
                    <td class="text-center">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <?= date("h:i a", strtotime($pro->date_entry)) ?>
                    </td>
                    <td class="text-center"><?= $pro->office_from; ?></td>
                    <td class="text-center"><span class="case-no-bg"><?= $pro->note_on_order; ?></span></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>">

<script src="<?php echo base_url('js/bootstrap.bundle.min.js'); ?>"></script>
<!-- Core JS-->
<script src="<?php echo base_url('js/scripts.js'); ?>"></script>

<script src="<?php echo base_url('js/department/department.js'); ?>"></script>


</body>

</html>
