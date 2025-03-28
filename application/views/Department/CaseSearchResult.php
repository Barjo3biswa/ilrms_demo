<div class="bg-white rounded">
    <div class="text-white bg-danger p-2 rounded bold center" style="font-size: 18px;">
        <?= $service_type ?>
    </div>
</div>

<div class=" my-2 py-2 bg-white rounded">
    <div class="text-white bg-success p-2 mb-2 rounded bold" style="font-size: 18px;">
        Location Details
    </div>
    <table class='table table-bordered unicode'>
        <tr>
            <td width="35%">
                <label class="text-danger">জিলা (District)
                    :&nbsp;&nbsp;&nbsp;<?= $district['loc_name'] ?></label>
            </td>
            <td width="35%">
                <label class="text-danger">মহকুমা (Sub Division)
                    :&nbsp;&nbsp;&nbsp;<?= $subdiv['loc_name'] ? $subdiv['loc_name'] : 'NA' ?></label>
            </td>
            <td width="35%">
                <label class="text-danger">চক্র (Circle)
                    :&nbsp;&nbsp;&nbsp;<?= $circle['loc_name'] ? $circle['loc_name'] : 'NA' ?></label>
            </td>
        </tr>
        <tr>
            <td width="35%">
                <label class="text-danger">মৌজা (Mouza) :&nbsp;&nbsp;&nbsp;<?php if (isset($mouza)) {
                        echo $mouza;
                    } else {
                        echo 'NA';
                    } ?></label>
            </td>
            <td width="35%">
                <label class="text-danger">লাট (Lot) :&nbsp;&nbsp;&nbsp;<?php if (isset($lot)) {
                        echo $lot;
                    } else {
                        echo 'NA';
                    } ?></label>
            </td>
            <td width="35%">
                <label class="text-danger">গাঁও (Village) :&nbsp;&nbsp;&nbsp;<?php if (isset($vill)) {
                        echo $vill;
                    } else {
                        echo 'NA';
                    } ?></label>
            </td>
        </tr>

    </table>
</div>

<!--/////// Field Case /////-->
<?php if ($case_type == 'field') { ?>
    <div class=" my-2 py-2 bg-white rounded">
        <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
            Case Details
        </div>
        <table class='table table-bordered unicode'>
            <tr>
                <td width="35%">
                    <label class="text-danger">Case No.
                        :&nbsp;&nbsp;&nbsp;<?= $fmb->case_no ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Order Status
                        :&nbsp;&nbsp;&nbsp;<?php $remark = "NA";
                        if (($fmb->order_passed == null) and ($fmb->is_dispose == null)) {
                            $status = "<label class='label label-info'>PENDING WITH CO</label>";
                            $remark = "NA";
                        } else if (($fmb->order_passed != null) && ($fmb->is_dispose == null)) {
                            $status = "<label class='label label-success'>ORDER PASSED</label>";
                        } else if ($fmb->is_dispose == 'Y') {
                            $status = "<label class='label label-danger'>REJCTED</label>";
                            $remark = $fmb->dispose_reason;
                        } else if ($fmb->is_dispose == 'L') {
                            $status = "<label class='label label-info'>PENDING WITH LM</label>";
                            $remark = "<label class='label label-info'>Reverted back to LM</label>";
                        } else if ($fmb->is_dispose == 'S') {
                            $status = "<label class='label label-info'>PENDING WITH SK</label>";
                            $remark = "<label class='label label-info'>Reverted back to SK</label>";
                        } else {
                            $remark = "NA";
                        }
                        echo $status;
                        ?>
                    </label>
                </td>
                <td width="35%">
                    <label class="text-danger"> Order Type
                        :&nbsp;&nbsp;&nbsp;<?php if (isset($order_type)) {
                            echo $order_type;
                        } ?></label>
                </td>
            </tr>
            <tr>
                <td width="35%">
                    <label class="text-danger">Transfer Type :&nbsp;&nbsp <?php if (isset($trans_type)) {
                            echo $trans_type;
                        } ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Year :&nbsp;&nbsp;<?= $fmb->year_no ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Remark :&nbsp;&nbsp;<?= $remark; ?></label>
                </td>
            </tr>
        </table>
    </div>

    <div class=" my-2 py-2 bg-white rounded">
        <table class='table table-bordered unicode'>
            <tr>
                <td width="35%">
                    <label>Circle Officer Name
                        :&nbsp;&nbsp <?php if (isset($fmb->add_off_name)) {
                            echo $this->Location_model->getName($fmb->add_off_name,
                                $fmb->dist_code,
                                $fmb->subdiv_code, $fmb->cir_code,
                                $fmb->mouza_pargona_code, $fmb->lot_no);
                        } ?></label>
                </td>
                <td width="35%">
                    <label>CO Order Date :&nbsp;&nbsp;<?php if ($fmb->is_dispose == 'Y' || $fmb->is_dispose == 'y') {
                            echo $fmb->if_dispose_date;
                        } else {
                            echo $fmb->date_of_order;
                        } ?>
                    </label>
                </td>
                <td width="35%">
                    <label>CO Note :&nbsp;&nbsp;&nbsp;<?php
                        if ($fmb->order_passed == 'y' || $fmb->order_passed == 'Y') {
                            if ($fmb->is_dispose == 'Y' || $fmb->is_dispose == 'y') {
                                echo $fmb->dispose_reason;
                            } else {
                                if (isset($co_order_note)) {
                                    echo $co_order_note;
                                }
                            }
                        } ?>

                    </label>
                </td>
            </tr>
            <tr>
                <td width="35%">
                    <label>Lot Mondal Name
                        :&nbsp;&nbsp;<?php if (isset($fmb->user_code)) {
                            echo $this->Location_model->getName($fmb->user_code,
                                $fmb->dist_code,
                                $fmb->subdiv_code, $fmb->cir_code,
                                $fmb->mouza_pargona_code, $fmb->lot_no);
                        } ?></label>
                </td>
                <td width="35%">
                    <label>LM Entry Date :&nbsp;&nbsp;<?php if (isset($fmb->date_entry)) {
                            echo $fmb->date_entry;
                        } ?></label>
                </td>
                <td width="35%">
                    <label>LM Note :&nbsp;&nbsp;&nbsp;<?php if (isset($dags)) {
                            foreach ($dags as $dag) {
                                echo $dag->remark . ', ';
                            }
                        } ?>
                    </label>
                </td>
            </tr>
            <tr>
                <td width="35%">
                    <label>Supervisor Kanungo Name :&nbsp;&nbsp;<?php if (isset($fmb->sk_id)) {
                            echo $this->Location_model->getName($fmb->sk_id, $fmb->dist_code,
                                $fmb->subdiv_code, $fmb->cir_code,
                                $fmb->mouza_pargona_code, $fmb->lot_no);
                        } ?></label>
                </td>
                <td width="35%">
                    <label>SK Entry Date :&nbsp;&nbsp;<?php if (isset($fmb->sk_note_date)) {
                            echo $fmb->sk_note_date;
                        } ?></label>
                </td>
                <td width="35%">
                    <label>SK Note :&nbsp;&nbsp;&nbsp;<?php if (isset($fmb->sk_note_date)) {
                            echo $fmb->sk_note;
                        } ?></label>
                </td>
            </tr>
        </table>
    </div>

    <div class=" my-2 py-2 bg-white rounded">
        <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
            Proceeding Flow
        </div>
        <?php if (isset($procedding)) { ?>
            <table class='table table-bordered unicode'>
                <thead>
                <th width="10%">
                    <label>Proceeding Id</label>
                </th>
                <th width="10%">
                    <label>User Name</label>
                </th>
                <th width="15%">
                    <label>Entry Date</label>
                </th>
                <th width="45%">
                    <label>Order</label>
                </th>
                <th width="30%">
                    <label>Note on order</label>
                </th>

                </thead>
                <?php foreach ($procedding as $pro) { ?>
                    <tr>
                        <td>
                            <label><?= $pro->proceeding_id ?></label>
                        </td>
                        <td>
                            <label><?php if (isset($pro->user_code)) {
                                    echo $this->Location_model->getName($pro->user_code,
                                        $petition_basic->dist_code,
                                        $petition_basic->subdiv_code, $petition_basic->cir_code,
                                        $petition_basic->mouza_pargona_code, $petition_basic->lot_no);
                                } ?>
                            </label>
                        </td>
                        <td>
                            <label><?= $pro->date_entry ?></label>
                        </td>
                        <td>
                            <label><?= $pro->co_order ?></label>
                        </td>
                        <td>
                            <label><?= $pro->note_on_order ?></label>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else {
            echo '<center>No data available</center>';
        } ?>
    </div>

    <?php if (($fmb->order_passed == 'y' || $fmb->order_passed == 'Y') && ($fmb->is_dispose == null)) { ?>
        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
                Dag Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Dag No.</label>
                    </td>
                    <td>
                        <label class="text-black">Patta No</label>
                    </td>
                    <td>
                        <label class="text-black">Patta Type Code</label>
                    </td>

                    <td>
                        <label class="text-black">Land in Chitha (B-K-L-G-Kr)</label>
                    </td>
                    <td>
                        <label class="text-black">Mutated Land (B-K-L-G-Kr)</label>
                    </td>
                    <td>
                        <label class="text-black">Remark</label>
                    </td>

                </tr>
                <?php if (isset($dags)) {
                    foreach ($dags as $dag) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $dag->dag_no ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $dag->patta_no ?> </label>
                            </td>
                            <td>
                                <label class="text-danger"><?php
                                    if(isset($dag->patta_type_code))
                                    {
                                    if($dag->patta_type_code != 0){
                                        echo $this->Location_model->getPattaType($dag->patta_type_code);
                                    } else {
                                        echo $dag->patta_type_code;
                                    }}  ?>
                                </label>
                            </td>

                            <td>
                                <label class="text-danger">
                                    <?= $dag->dag_area_b ? $dag->dag_area_b : 0 ?>B -
                                    <?= $dag->dag_area_k ? $dag->dag_area_k : 0 ?>K -
                                    <?= $dag->dag_area_lc ? $dag->dag_area_lc : 0 ?>L -
                                    <?= $dag->dag_area_g ? $dag->dag_area_g : 0 ?>G -
                                    <?= $dag->dag_area_kr ? $dag->dag_area_kr : 0 ?>Kr
                                </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $dag->m_dag_area_b ? $dag->m_dag_area_b : 0 ?>B -
                                    <?= $dag->m_dag_area_k ? $dag->m_dag_area_k : 0 ?>K -
                                    <?= $dag->m_dag_area_lc ? $dag->m_dag_area_lc : 0 ?>L -
                                    <?= $dag->m_dag_area_g ? $dag->m_dag_area_g : 0 ?>G -
                                    <?= $dag->m_dag_area_kr ? $dag->m_dag_area_kr : 0 ?>Kr
                                </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $dag->remark ?></label>
                            </td>
                        </tr>

                    <?php }
                } ?>

            </table>
        </div>

        <?php if ($col8_order[0]->order_type_code == '01') { ?>
            <div class=" my-2 py-2 bg-white rounded">
                <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                    Petitioner Details
                </div>
                <table class='table table-bordered unicode'>
                    <tr>
                        <td>
                            <label class="text-black">Petitioner Name</label>
                        </td>
                        <td>
                            <label class="text-black">Gender</label>
                        </td>
                        <td>
                            <label class="text-black">Guardian Name</label>
                        </td>
                        <td>
                            <label class="text-black">Guardian Relation</label>
                        </td>

                        <td>
                            <label class="text-black">Address</label>
                        </td>
                        <td>
                            <label class="text-black">Applied Land (B-K-L-Kr)</label>
                        </td>

                    </tr>
                    <?php foreach ($applicants as $applicant) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $applicant->pet_name ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $this->Location_model->gender($applicant->pet_gender) ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $applicant->guard_name ?> </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $this->Location_model->relation($applicant->guard_rel) ?></label>
                            </td>

                            <td>
                                <label class="text-danger"><?= $applicant->add1 ?> <?= $applicant->add2 ?> </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $applicant->applied_b ? $applicant->applied_b : 0 ?>B -
                                    <?= $applicant->applied_k ? $applicant->applied_k : 0 ?>K -
                                    <?= $applicant->applied_lc ? $applicant->applied_lc : 0 ?>L -
                                    <?= $applicant->applied_kr ? $applicant->applied_kr : 0 ?>Kr
                                </label>
                            </td>
                        </tr>

                    <?php } ?>

                </table>
            </div>

        <?php } ?>

        <?php if ($col8_order[0]->order_type_code == '02') { ?>
            <div class=" my-2 py-2 bg-white rounded">
                <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                    Petitioner Details
                </div>
                <table class='table table-bordered unicode'>
                    <tr>
                        <td>
                            <label class="text-black">Petitioner Name</label>
                        </td>
                        <td>
                            <label class="text-black">Gender</label>
                        </td>
                        <td>
                            <label class="text-black">Guardian Name</label>
                        </td>
                        <td>
                            <label class="text-black">Guardian Relation</label>
                        </td>

                        <td>
                            <label class="text-black">Address</label>
                        </td>
                        <td>
                            <label class="text-black">Applied Land (B-K-L-G-Kr)</label>
                        </td>

                    </tr>

                    <?php if (isset($applicants)) {
                        foreach ($applicants as $applicant) { ?>
                            <tr>
                                <td>
                                    <label class="text-danger"><?= $applicant->pdar_name ?></label>
                                </td>
                                <td>
                                    <label class="text-danger">
                                        <?php if (isset($applicant->pdar_gender)) {
                                            echo $this->Location_model->gender($applicant->pdar_gender);
                                        } ?>
                                    </label>
                                </td>
                                <td>
                                    <label class="text-danger"><?= $applicant->pdar_guardian ?> </label>
                                </td>
                                <td>
                                    <label class="text-danger"><?= $this->Location_model->relation($applicant->pdar_rel_guar) ?></label>
                                </td>
                                <td>
                                    <label class="text-danger"><?= $applicant->pdar_add1 ?> <?= $applicant->pdar_add2 ?> </label>
                                </td>
                                <td>
                                    <label class="text-danger">
                                        <?= $applicant->pdar_dag_por_b ? $applicant->pdar_dag_por_b : 0 ?>B -
                                        <?= $applicant->pdar_dag_por_k ? $applicant->pdar_dag_por_k : 0 ?>K -
                                        <?= $applicant->pdar_dag_por_lc ? $applicant->pdar_dag_por_lc : 0 ?>L -
                                        <?= $applicant->pdar_dag_por_g ? $applicant->pdar_dag_por_g : 0 ?>G -
                                        <?= $applicant->pdar_dag_por_kr ? $applicant->pdar_dag_por_kr : 0 ?>Kr
                                    </label>
                                </td>
                            </tr>

                        <?php }
                    } ?>

                </table>
            </div>

        <?php } ?>

        <?php if ($col8_order[0]->order_type_code == '01') { ?>
            <div class=" my-2 py-2 bg-white rounded">
                <div class="text-white bg-info p-2 mb-1 rounded bold" style="font-size: 18px;">
                    Pattadar Details
                </div>
                <table class='table table-bordered unicode'>
                    <tr>
                        <td>
                            <label class="text-black">Pattadar Name</label>
                        </td>
                        <td>
                            <label class="text-black">Guardian Name</label>
                        </td>
                        <td>
                            <label class="text-black">Guardian Relation</label>
                        </td>
                        <td>
                            <label class="text-black">Address</label>
                        </td>
                        <td>
                            <label class="text-black">Inplace / Alongwith</label>
                        </td>
                    </tr>
                    <?php if (isset($pattdars)) {
                        foreach ($pattdars as $pattdar) { ?>
                            <tr>
                                <td>
                                    <label class="text-danger"><?= $pattdar->pdar_name ?></label>
                                </td>
                                <td>
                                    <label class="text-danger"><?= $pattdar->pdar_guardian ?> </label>
                                </td>
                                <td>
                                    <label class="text-danger"><?= $this->Location_model->relation($pattdar->pdar_rel_guar) ?></label>
                                </td>

                                <td>
                                    <label class="text-danger"><?= $pattdar->pdar_add1 ?> <?= $pattdar->pdar_add2 ?> </label>
                                </td>
                                <td>
                                    <label class="text-danger">
                                        <?php if (isset($pattdar->striked_out)) {
                                            if ($pattdar->striked_out == 1) {
                                                echo 'Inplace';
                                            } else {
                                                echo 'Alongwith';
                                            }
                                        } ?>
                                    </label>
                                </td>
                            </tr>

                        <?php }
                    } ?>

                </table>
            </div>
        <?php } ?>

    <?php } ?>

<?php } ?>


<!--//// Office Case //////-->
<?php if ($case_type == 'office') { ?>
    <div class=" my-2 py-2 bg-white rounded">
        <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
            Case Details
        </div>
        <table class='table table-bordered unicode'>
            <tr>
                <td width="35%">
                    <label class="text-danger">Case No.
                        :&nbsp;&nbsp;&nbsp;<?= $petition_basic->case_no ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Order Status
                        :&nbsp;&nbsp;&nbsp;
                        <?php if ($petition_basic->mut_type == '03') {
                            if (($petition_basic->lm_note_yn == null) && ($petition_basic->not_fresh != null) &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH LM</label>";
                            } else if (($petition_basic->notice_generated_yn == null) && ($petition_basic->not_fresh != null) &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH AST for NOTICE GENERATION</label>";
                            } else if (($petition_basic->notice_generated_yn == null) && ($petition_basic->not_fresh != null) &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH AST for NOTICE SERVE</label>";
                            } else if (($petition_basic->sk_comment == null) && ($petition_basic->not_fresh != null) &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH SK for REPORT</label>";
                            } else if (($petition_basic->not_fresh == null) && ($petition_basic->status == null) &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH CO</label>";
                            } else if (($petition_basic->order_passed == null) && ($petition_basic->status != 'F') &&
                                ($petition_basic->proceeding_yn != null) && ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH CO</label>";
                            } else if ($petition_basic->status == 'F') {
                                $status = "<label class='label label-danger'>Final Order Passed</label>";
                            } else if ($petition_basic->status == 'D') {
                                $status = "<label class='label label-danger'>Case Rejected</label>";
                            } else if (($petition_basic->proceeding_yn == null) and ($petition_basic->notice_served_yn != null) &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-danger'>PENDING WITH AST for NOTICE SERVE</label>";
                            } else {
                                $status = "<label class='label label-danger'>UNKOWN</label>";
                            }
                            $remark = "NA";
                        } else if ($petition_basic->mut_type == '04') {
                            if (($petition_basic->lm_note_yn == null) && ($petition_basic->not_fresh != null) &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH LM</label>";
                            } else if (($petition_basic->byayprak_yn == null) && ($petition_basic->not_fresh != null) &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH LM for Byayprak Report</label>";
                            } else if (($petition_basic->notice_generated_yn == null) && ($petition_basic->not_fresh != null) &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH AST for NOTICE GENERATION</label>";
                            } else if (($petition_basic->notice_generated_yn == null) && ($petition_basic->not_fresh != null) &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH AST for NOTICE SERVE</label>";
                            } else if (($petition_basic->sk_comment == null) && ($petition_basic->not_fresh != null) &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH SK for REPORT</label>";
                            } else if (($petition_basic->order_passed == null) && ($petition_basic->not_fresh == null) &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH CO</label>";
                            } else if (($petition_basic->order_passed == null) && ($petition_basic->status != 'F') &&
                                ($petition_basic->proceeding_yn != null)
                                && ($petition_basic->pay_notice_gen_yn != null) && ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH CO</label>";
                            } else if (($petition_basic->not_fresh == 'Y') && ($petition_basic->proceeding_yn == null) &&
                                ($petition_basic->status == 'P') && ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH AST for Action taken report</label>";
                            } else if (($petition_basic->not_fresh == 'Y') && ($petition_basic->proceeding_yn == null) &&
                                ($petition_basic->status == 'P') && ($petition_basic->pay_notice_gen_yn == 'Y') &&
                                ($petition_basic->status != 'D')) {
                                $status = "<label class='label label-info'>PENDING WITH AST for Payment Confirmation</label>";
                            } else if ($petition_basic->status == 'F') {
                                $status = "<label class='label label-danger'>Final Order Passed</label>";
                            } else if ($petition_basic->status == 'D') {
                                $status = "<label class='label label-danger'>Case Rejected</label>";
                            } else {
                                $status = "<label class='label label-danger'>UNKOWN</label>";
                            }
                            $remark = "NA";
                        }
                        echo $status;
                        ?>
                    </label>
                </td>
                <td width="35%">
                    <label class="text-danger"> Order Type
                        :&nbsp;&nbsp;&nbsp;<?= $order_type ?></label>
                </td>
            </tr>
            <tr>
                <td width="35%">
                    <label class="text-danger">Transfer Type :&nbsp;&nbsp <?= $trans_type ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Year :&nbsp;&nbsp;<?= $petition_basic->year_no ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Remark :&nbsp;&nbsp;<?= $remark ?></label>
                </td>
            </tr>
        </table>
    </div>
    <?php if ($petition_basic->status == 'F') { ?>
        <div class=" my-2 py-2 bg-white rounded">
            <table class='table table-bordered unicode'>
                <tr>
                    <td width="35%">
                        <label>Circle Officer Name
                            :&nbsp;&nbsp <?php if (isset($petition_basic->add_off_name)) {
                                echo
                                $this->Location_model->getName($petition_basic->add_off_name,
                                    $petition_basic->dist_code,
                                    $petition_basic->subdiv_code, $petition_basic->cir_code,
                                    $petition_basic->mouza_pargona_code, $petition_basic->lot_no);
                            } ?>
                        </label>
                    </td>
                    <td width="35%">
                        <label>CO Order Date :&nbsp;&nbsp;<?= $petition_basic->date_of_order ?></label>
                    </td>
                    <td width="35%">
                        <!--                        <label>CO Note :&nbsp;</label>-->
                    </td>
                </tr>
                <tr>
                    <td width="35%">
                        <label>Lot Mondal Name
                            :&nbsp;&nbsp;<?php if (isset($ch_ord_b[0]->lm_code)) {
                                echo $this->Location_model->getName($ch_ord_b[0]->lm_code,
                                    $petition_basic->dist_code,
                                    $petition_basic->subdiv_code, $petition_basic->cir_code,
                                    $petition_basic->mouza_pargona_code, $petition_basic->lot_no);
                            } ?>
                        </label>
                    </td>
                    <td width="35%">
                        <label>LM Entry Date :&nbsp;&nbsp;<?= $ch_ord_b[0]->lm_sign_date ?></label>
                    </td>
                    <td width="35%">
                        <label>LM Note :&nbsp;&nbsp;
                            <?php if (isset($lm_note)) {
                                foreach ($lm_note as $note) {
                                    if ($petition_basic->mut_type == '03') {
                                        echo $note->report_on_possession;
                                    } else if ($petition_basic->mut_type == '04') {
                                        echo $note->partition_info;
                                    }
                                }
                            }
                            ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td width="35%">
                        <label>Supervisor Kanungo Name :&nbsp;&nbsp;<?php if (isset($ch_ord_b[0]->sk_code)) {
                                echo $this->Location_model->getName($ch_ord_b[0]->sk_code,
                                    $petition_basic->dist_code,
                                    $petition_basic->subdiv_code, $petition_basic->cir_code,
                                    $petition_basic->mouza_pargona_code, $petition_basic->lot_no);
                            } ?></label>
                    </td>
                    <td width="35%">
                        <label>SK Entry Date :&nbsp;&nbsp;<?= $ch_ord_b[0]->sk_sign_date ?></label>
                    </td>
                    <td width="35%">
                        <label>SK Note :&nbsp;
                            <?php if (isset($lm_note)) {
                                foreach ($lm_note as $note) {
                                    echo $note->sk_note;
                                }
                            }
                            ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td width="35%">
                        <label>Assistant Name :&nbsp;&nbsp;<?php if (isset($petition_basic->user_code)) {
                                echo $this->Location_model->getName($petition_basic->user_code,
                                    $petition_basic->dist_code,
                                    $petition_basic->subdiv_code, $petition_basic->cir_code,
                                    $petition_basic->mouza_pargona_code, $petition_basic->lot_no);
                            } ?></label>
                    </td>
                    <td width="35%">
                        <label>AST Entry Date :&nbsp;&nbsp;<?= $petition_basic->date_entry ?></label>
                    </td>
                    <td width="35%">
                        <!--                        <label>AST Note :&nbsp;</label>-->
                    </td>
                </tr>
            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
                Proceeding Flow
            </div>
            <?php if (isset($procedding)) { ?>
                <table class='table table-bordered unicode'>
                    <thead>
                    <th width="10%">
                        <label>Proceeding Id</label>
                    </th>
                    <th width="10%">
                        <label>User Name</label>
                    </th>
                    <th width="15%">
                        <label>Entry Date</label>
                    </th>
                    <th width="45%">
                        <label>Order</label>
                    </th>
                    <th width="30%">
                        <label>Note on order</label>
                    </th>

                    </thead>
                    <?php foreach ($procedding as $pro) { ?>
                        <tr>
                            <td>
                                <label><?= $pro->proceeding_id ?></label>
                            </td>
                            <td>
                                <label><?= $this->Location_model->getName($pro->user_code,
                                        $petition_basic->dist_code,
                                        $petition_basic->subdiv_code, $petition_basic->cir_code,
                                        $petition_basic->mouza_pargona_code, $petition_basic->lot_no) ?>
                                </label>
                            </td>
                            <td>
                                <label><?= $pro->date_entry ?></label>
                            </td>
                            <td>
                                <label><?= $pro->co_order ?></label>
                            </td>
                            <td>
                                <label><?= $pro->note_on_order ?></label>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else {
                echo 'No data available';
            } ?>
        </div>


        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
                Dag Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Dag No.</label>
                    </td>
                    <td>
                        <label class="text-black">Patta No</label>
                    </td>
                    <td>
                        <label class="text-black">Patta Type Code</label>
                    </td>

                    <td>
                        <label class="text-black">Land in Chitha (B-K-L-G-Kr)</label>
                    </td>
                    <td>
                        <label class="text-black">Mutated Land (B-K-L-G-Kr)</label>
                    </td>
                </tr>
                <?php if (isset($dags)) {
                    foreach ($dags as $dag) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $dag->dag_no ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $dag->patta_no ?> </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?php if(isset($dag->patta_type_code)){
                                        if($dag->patta_type_code != 0){
                                            echo $this->Location_model->getPattaType($dag->patta_type_code);
                                        }
                                        else{
                                            echo $dag->patta_type_code;
                                        }
                                    }  ?>
                                </label>
                            </td>

                            <td>
                                <label class="text-danger">
                                    <?= $dag->dag_area_b ? $dag->dag_area_b : 0 ?>B -
                                    <?= $dag->dag_area_k ? $dag->dag_area_k : 0 ?>K -
                                    <?= $dag->dag_area_lc ? $dag->dag_area_lc : 0 ?>L -
                                    <?= $dag->dag_area_g ? $dag->dag_area_g : 0 ?>G -
                                    <?= $dag->dag_area_kr ? $dag->dag_area_kr : 0 ?> Kr
                                </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $dag->m_dag_area_b ? $dag->m_dag_area_b : 0 ?>B -
                                    <?= $dag->m_dag_area_k ? $dag->m_dag_area_k : 0 ?>K -
                                    <?= $dag->m_dag_area_lc ? $dag->m_dag_area_lc : 0 ?>L -
                                    <?= $dag->m_dag_area_g ? $dag->m_dag_area_g : 0 ?>G -
                                    <?= $dag->m_dag_area_kr ? $dag->m_dag_area_kr : 0 ?>Kr
                                </label>
                            </td>
                        </tr>

                    <?php }
                } ?>

            </table>
        </div>

        <?php if ($petition_basic->mut_type == '03') { ?>
            <div class=" my-2 py-2 bg-white rounded">
                <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                    Petitioner Details
                </div>
                <table class='table table-bordered unicode'>
                    <tr>
                        <td>
                            <label class="text-black">Petitioner Name</label>
                        </td>
                        <td>
                            <label class="text-black">Gender</label>
                        </td>
                        <td>
                            <label class="text-black">Guardian Name</label>
                        </td>
                        <td>
                            <label class="text-black">Guardian Relation</label>
                        </td>

                        <td>
                            <label class="text-black">Address</label>
                        </td>
                        <td>
                            <label class="text-black">Applied Land (B-K-L-Kr)</label>
                        </td>

                    </tr>
                    <?php if (isset($applicants)) {
                        foreach ($applicants as $applicant) { ?>
                            <tr>
                                <td>
                                    <label class="text-danger"><?= $applicant->pet_name ?></label>
                                </td>
                                <td>
                                    <label class="text-danger">
                                        <?= $this->Location_model->gender($applicant->pet_gender) ?>
                                    </label>
                                </td>
                                <td>
                                    <label class="text-danger"><?= $applicant->guard_name ?> </label>
                                </td>
                                <td>
                                    <label class="text-danger">
                                        <?php if (isset($applicant->guard_rel)) {
                                            echo $this->Location_model->relation($applicant->guard_rel);
                                        } ?>
                                    </label>
                                </td>

                                <td>
                                    <label class="text-danger"><?= $applicant->add1 ?> <?= $applicant->add2 ?> </label>
                                </td>
                                <td>
                                    <label class="text-danger">
                                        <?= $applicant->applied_b ? $applicant->applied_b : 0 ?>B -
                                        <?= $applicant->applied_k ? $applicant->applied_k : 0 ?>K -
                                        <?= $applicant->applied_lc ? $applicant->applied_lc : 0 ?>L -
                                        <?= $applicant->applied_kr ? $applicant->applied_kr : 0 ?>Kr
                                    </label>
                                </td>
                            </tr>

                        <?php }
                    } ?>

                </table>
            </div>

        <?php } else if ($petition_basic->mut_type == '04') { ?>
            <div class=" my-2 py-2 bg-white rounded">
                <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                    Petitioner Details
                </div>
                <table class='table table-bordered unicode'>
                    <tr>
                        <td>
                            <label class="text-black">Petitioner Name</label>
                        </td>
                        <td>
                            <label class="text-black">Gender</label>
                        </td>
                        <td>
                            <label class="text-black">Guardian Name</label>
                        </td>
                        <td>
                            <label class="text-black">Guardian Relation</label>
                        </td>

                        <td>
                            <label class="text-black">Address</label>
                        </td>
                    </tr>

                    <?php if (isset($applicants)) {
                        foreach ($applicants as $applicant) { ?>
                            <tr>
                                <td>
                                    <label class="text-danger"><?= $applicant->pdar_name ?></label>
                                </td>
                                <td>
                                    <label class="text-danger">
                                        <?php if (isset($applicant->pdar_gender)) {
                                            echo $this->Location_model->gender($applicant->pdar_gender);
                                        } ?>
                                    </label>
                                </td>
                                <td>
                                    <label class="text-danger"><?= $applicant->pdar_guardian ?> </label>
                                </td>
                                <td>
                                    <label class="text-danger">
                                        <?php if (isset($applicant->pdar_rel_guar)) {
                                            echo $this->Location_model->relation($applicant->pdar_rel_guar);
                                        } ?>
                                    </label>
                                </td>

                                <td>
                                    <label class="text-danger">
                                        <?= $applicant->pdar_add1 ?> <?= $applicant->pdar_add2 ?>
                                    </label>
                                </td>
                            </tr>

                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="100%"> No Data Found</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        <?php } ?>

        <?php if ($petition_basic->mut_type == '03') { ?>
            <div class=" my-2 py-2 bg-white rounded">
                <div class="text-white bg-info p-2 mb-1 rounded bold" style="font-size: 18px;">
                    Pattadar Details
                </div>
                <table class='table table-bordered unicode'>
                    <tr>
                        <td>
                            <label class="text-black">Pattadar Name</label>
                        </td>
                        <td>
                            <label class="text-black">Guardian Name</label>
                        </td>
                        <td>
                            <label class="text-black">Guardian Relation</label>
                        </td>

                        <td>
                            <label class="text-black">Address</label>
                        </td>
                        <td>
                            <label class="text-black">Inplace / Alongwith</label>
                        </td>

                    </tr>
                    <?php if (isset($pattdars)) {
                        foreach ($pattdars as $pattdar) { ?>
                            <tr>
                                <td>
                                    <label class="text-danger"><?= $pattdar->pdar_name ?></label>
                                </td>
                                <td>
                                    <label class="text-danger"><?= $pattdar->pdar_guardian ?> </label>
                                </td>
                                <td>
                                    <label class="text-danger">
                                        <?php if (isset($pattdar->pdar_rel_guar)) {
                                            echo $this->Location_model->relation($pattdar->pdar_rel_guar);
                                        } ?>
                                    </label>
                                </td>

                                <td>
                                    <label class="text-danger">
                                        <?= $pattdar->pdar_add1 ?> <?= $pattdar->pdar_add2 ?>
                                    </label>
                                </td>
                                <td>
                                    <label class="text-danger">
                                        <?php if (isset($pattdar->striked_out)) {
                                            if ($pattdar->striked_out == 1) {
                                                echo 'Inplace';
                                            } else {
                                                echo 'Alongwith';
                                            }
                                        } ?>
                                    </label>
                                </td>
                            </tr>

                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="100%"> No Data Found</td>
                        </tr>

                    <?php } ?>

                </table>
            </div>
        <?php } else if ($petition_basic->mut_type == '04') { ?>
            <div class=" my-2 py-2 bg-white rounded">
                <div class="text-white bg-info p-2 mb-1 rounded bold" style="font-size: 18px;">
                    Chitha Order Details
                </div>
                <table class='table table-bordered unicode'>
                    <tr>
                        <td>
                            <label class="text-black">Dag No.</label>
                        </td>
                        <td>
                            <label class="text-black">New Dag No.</label>
                        </td>
                        <td>
                            <label class="text-black">Type History No.</label>
                        </td>

                        <td>
                            <label class="text-black">Order Cron No.</label>
                        </td>
                        <td>
                            <label class="text-black">Mutated Land (B-K-L-G-Kr)</label>
                        </td>
                        <td>
                            <label class="text-black">Remaining Land (B-K-L-G-Kr)</label>
                        </td>
                        <td>
                            <label class="text-black">Order Date</label>
                        </td>

                    </tr>
                    <?php if (isset($ch_ord_b)) {
                        foreach ($ch_ord_b as $ord) { ?>
                            <tr>
                                <td>
                                    <label class="text-danger"><?= $ord->dag_no ?></label>
                                </td>
                                <td>
                                    <label class="text-danger"><?= $ord->new_dag_no ?> </label>
                                </td>
                                <td>
                                    <label class="text-danger"><?= $ord->rmk_type_hist_no ?></label>
                                </td>

                                <td>
                                    <label class="text-danger"><?= $ord->ord_type_code ?></label>
                                </td>
                                <td>
                                    <label class="text-danger">
                                        <?= $ord->m_dag_area_b ? $ord->m_dag_area_b : 0 ?>B -
                                        <?= $ord->m_dag_area_k ? $ord->m_dag_area_k : 0 ?>K -
                                        <?= $ord->m_dag_area_lc ? $ord->m_dag_area_lc : 0 ?>L -
                                        <?= $ord->m_dag_area_g ? $ord->m_dag_area_g : 0 ?>G -
                                        <?= $ord->m_dag_area_kr ? $ord->m_dag_area_kr : 0 ?>Kr
                                    </label>
                                </td>
                                <td>
                                    <label class="text-danger">
                                        <?= $ord->area_left_b ? $ord->area_left_b : 0 ?>B -
                                        <?= $ord->area_left_k ? $ord->area_left_k : 0 ?>K -
                                        <?= $ord->area_left_lc ? $ord->area_left_lc : 0 ?>L -
                                        <?= $ord->area_left_g ? $ord->area_left_g : 0 ?>G -
                                        <?= $ord->area_left_kr ? $ord->area_left_kr : 0 ?> Kr
                                    </label>
                                </td>

                                <td>
                                    <label class="text-danger"> <?= $ord->ord_date ?></label>
                                </td>
                            </tr>

                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="100%"> No Data Found</td>
                        </tr>

                    <?php } ?>

                </table>
            </div>
        <?php }
    }
} ?>


<!--//// Conversion Case //////-->
<?php if ($case_type == 'conv') { ?>
    <div class=" my-2 py-2 bg-white rounded">
        <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
            Case Details
        </div>
        <table class='table table-bordered unicode'>
            <tr>
                <td width="35%">
                    <label class="text-danger">Case No.
                        :&nbsp;&nbsp;&nbsp;<?= $petition_basic->case_no ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Order Status
                        :&nbsp;&nbsp;
                        <?php if ($petition_basic->status == 'F') {
                            echo 'Passed';
                        } else if ($petition_basic->status == 'R') {
                            echo 'Rejected';
                        } else if ($petition_basic->status == 'D') {
                            echo 'Disposed';
                        } else {
                            echo 'Pending';
                        } ?>
                    </label>
                </td>
                <td width="35%">
                    <label class="text-danger"> Order Type
                        :&nbsp;&nbsp;&nbsp;<?= $order_type ?></label>
                </td>
            </tr>
            <tr>
                <td width="35%">
                    <label class="text-danger">Transfer Type :&nbsp;&nbsp <?php if (isset($trans_type)) {
                            echo $trans_type;
                        } ?>
                    </label>
                </td>
                <td width="35%">
                    <label class="text-danger">Year :&nbsp;&nbsp;<?= $petition_basic->year_no ?></label>
                </td>
                <td width="35%">

                </td>
            </tr>
        </table>
    </div>

    <?php if ($petition_basic->status == 'F') { ?>
        <div class=" my-2 py-2 bg-white rounded">
            <table class='table table-bordered unicode'>
                <tr>
                    <td width="35%">
                        <label>Circle Officer Name
                            :&nbsp;&nbsp <?php if (isset($petition_basic->co_user_code)) {
                                echo
                                $this->Location_model->getName($petition_basic->co_user_code,
                                    $petition_basic->dist_code,
                                    $petition_basic->subdiv_code, $petition_basic->cir_code,
                                    $petition_basic->mouza_pargona_code, $petition_basic->lot_no);
                            } ?></label>
                    </td>
                    <td width="35%">
                        <label>CO Order Date :&nbsp;&nbsp;<?php if (isset($petition_basic->co_order_conv_date)) {
                                echo
                                $petition_basic->co_order_conv_date;
                            } ?>
                        </label>
                    </td>
                    <td width="35%">
                        <!--                        <label>CO Note :&nbsp;&nbsp </label>-->
                    </td>
                </tr>
                <tr>
                    <td width="35%">
                        <label>Lot Mondal Name
                            :&nbsp;&nbsp;<?php if (isset($lm_note[0]->lm_code)) {
                                echo $this->Location_model->getName($lm_note[0]->lm_code,
                                    $petition_basic->dist_code,
                                    $petition_basic->subdiv_code, $petition_basic->cir_code,
                                    $petition_basic->mouza_pargona_code, $petition_basic->lot_no);
                            } ?></label>
                    </td>
                    <td width="35%">
                        <label>LM Entry Date :&nbsp;&nbsp;<?php if (isset($ch_ord_b->lm_sign_date)) {
                                echo $ch_ord_b->lm_sign_date;
                            } ?></label>
                    </td>
                    <td width="35%">
                        <label>LM Note :&nbsp;&nbsp;
                            <?php if (isset($lm_note)) {
                                foreach ($lm_note as $note) {
                                    echo $note->partition_info;
                                }
                            }
                            ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td width="35%">
                        <label>Supervisor Kanungo Name :&nbsp;&nbsp;<?php if (isset($lm_note[0]->user_code)) {
                                echo $this->Location_model->getName($lm_note[0]->user_code, $petition_basic->dist_code,
                                    $petition_basic->subdiv_code, $petition_basic->cir_code,
                                    $petition_basic->mouza_pargona_code, $petition_basic->lot_no);
                            } ?></label>
                    </td>
                    <td width="35%">
                        <label>SK Entry Date :&nbsp;&nbsp;<?php if (isset($ch_ord_b->sk_sign_date)) {
                                echo $ch_ord_b->sk_sign_date;
                            } ?></label>
                    </td>
                    <td width="35%">
                        <label>SK Note :&nbsp;
                            <?php if (isset($lm_note)) {
                                foreach ($lm_note as $note) {
                                    echo $note->sk_note;
                                }
                            }
                            ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td width="35%">
                        <label>Assistant Name :&nbsp;&nbsp;<?php if (isset($petition_basic->user_code)) {
                                echo $this->Location_model->getName($petition_basic->user_code, $petition_basic->dist_code,
                                    $petition_basic->subdiv_code, $petition_basic->cir_code,
                                    $petition_basic->mouza_pargona_code, $petition_basic->lot_no);
                            } ?>
                        </label>
                    </td>
                    <td width="35%">
                        <label>AST Entry Date :&nbsp;&nbsp;<?= $petition_basic->date_entry ?></label>
                    </td>
                    <td width="35%">
                        <!--                        <label>AST Note :&nbsp;</label>-->
                    </td>
                </tr>

            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
                Proceeding Flow
            </div>
            <table class='table table-bordered unicode'>
                <thead>
                <th width="10%">
                    <label>Proceeding Id</label>
                </th>
                <th width="10%">
                    <label>User Name</label>
                </th>
                <th width="15%">
                    <label>Entry Date</label>
                </th>
                <th width="45%">
                    <label>Order</label>
                </th>
                <th width="30%">
                    <label>Note on order</label>
                </th>

                </thead>
                <?php if (isset($procedding)) {
                    foreach ($procedding as $pro) { ?>
                        <tr>
                            <td>
                                <label><?= $pro->proceeding_id ?></label>
                            </td>
                            <td>
                                <label>
                                    <?php if (isset($pro->user_code)) {
                                        echo $this->Location_model->getName($pro->user_code,
                                            $petition_basic->dist_code,
                                            $petition_basic->subdiv_code, $petition_basic->cir_code,
                                            $petition_basic->mouza_pargona_code, $petition_basic->lot_no);
                                    } ?>
                                </label>
                            </td>
                            <td>
                                <label><?= $pro->date_entry ?></label>
                            </td>
                            <td>
                                <label><?= $pro->co_order ?></label>
                            </td>
                            <td>
                                <label><?= $pro->note_on_order ?></label>
                            </td>
                        </tr>
                    <?php }
                }
                if (isset($dc_pros)) { ?>
                    <tr>
                        <td colspan="100%" class="center bg-primary text-white"> DC / ADC Proceeding Flow</td>
                    </tr>
                    <?php foreach ($dc_pros as $dpro) { ?>
                        <tr>
                            <td>
                                <label><?= $dpro->proceeding_id ?></label>
                            </td>
                            <td>
                                <label>
                                    <?php if (isset($dpro->user_code)) {
                                        echo $this->Location_model->getName($dpro->user_code,
                                            $petition_basic->dist_code,
                                            $petition_basic->subdiv_code, $petition_basic->cir_code,
                                            $petition_basic->mouza_pargona_code, $petition_basic->lot_no);
                                    } ?>
                                </label>
                            </td>
                            <td>
                                <label><?= $dpro->date_entry ?></label>
                            </td>
                            <td>
                                <label><?= $dpro->co_order ?></label>
                            </td>
                            <td>
                                <label><?= $dpro->note_on_order ?></label>
                            </td>
                        </tr>
                    <?php }
                } ?>

            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
                Dag Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Dag No.</label>
                    </td>
                    <td>
                        <label class="text-black">Patta No</label>
                    </td>
                    <td>
                        <label class="text-black">Patta Type Code</label>
                    </td>
                    <td>
                        <label class="text-black">Land in Chitha (B-K-L-G-Kr)</label>
                    </td>
                    <td>
                        <label class="text-black">Mutated Land (B-K-L-G-Kr)</label>
                    </td>
                </tr>
                <?php if (isset($dags)) {
                    foreach ($dags as $dag) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $dag->dag_no ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $dag->patta_no ?> </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $this->Location_model->getPattaType($dag->patta_type_code) ?>
                                </label>
                            </td>

                            <td>
                                <label class="text-danger">
                                    <?= $dag->dag_area_b ? $dag->dag_area_b : 0 ?>B -
                                    <?= $dag->dag_area_k ? $dag->dag_area_k : 0 ?>K -
                                    <?= $dag->dag_area_lc ? $dag->dag_area_lc : 0 ?>L -
                                    <?= $dag->dag_area_g ? $dag->dag_area_g : 0 ?>G -
                                    <?= $dag->dag_area_kr ? $dag->dag_area_kr : 0 ?>Kr
                                </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $dag->m_dag_area_b ? $dag->m_dag_area_b : 0 ?>B -
                                    <?= $dag->m_dag_area_k ? $dag->m_dag_area_k : 0 ?>K -
                                    <?= $dag->m_dag_area_lc ? $dag->m_dag_area_lc : 0 ?>L -
                                    <?= $dag->m_dag_area_g ? $dag->m_dag_area_g : 0 ?>G -
                                    <?= $dag->m_dag_area_kr ? $dag->m_dag_area_kr : 0 ?>Kr
                                </label>
                            </td>
                        </tr>

                    <?php }
                } ?>

            </table>
        </div>


        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                Petitioner Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Petitioner Name</label>
                    </td>
                    <td>
                        <label class="text-black">Gender</label>
                    </td>
                    <td>
                        <label class="text-black">Guardian Name</label>
                    </td>
                    <td>
                        <label class="text-black">Guardian Relation</label>
                    </td>

                    <td>
                        <label class="text-black">Address</label>
                    </td>
                </tr>

                <?php if (isset($applicants)) {
                    foreach ($applicants as $applicant) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $applicant->pdar_name ?></label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?php if (isset($applicant->pdar_gender)) {
                                        echo $this->Location_model->gender($applicant->pdar_gender);
                                    } ?>
                                </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $applicant->pdar_guardian ?> </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $this->Location_model->relation($applicant->pdar_rel_guar) ?>
                                </label>
                            </td>

                            <td>
                                <label class="text-danger">
                                    <?= $applicant->pdar_add1 ?> <?= $applicant->pdar_add2 ?>
                                </label>
                            </td>
                        </tr>

                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="100%"> No Data Found</td>
                    </tr>

                <?php } ?>

            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                Conversion Order Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Onbehalf of Name</label>
                    </td>
                    <td>
                        <label class="text-black">Guardian Name</label>
                    </td>
                    <td>
                        <label class="text-black">Premium</label>
                    </td>
                    <td>
                        <label class="text-black">Challan Receipt No</label>
                    </td>
                    <td>
                        <label class="text-black">New Patta Type</label>
                    </td>
                    <td>
                        <label class="text-black">New Patta No.</label>
                    </td>
                    <td>
                        <label class="text-black">New Dag No.</label>
                    </td>
                    <td>
                        <label class="text-black">Land Area (B-K-L-G-Kr)</label>
                    </td>
                </tr>

                <?php if (isset($conv_ord)) {
                    foreach ($conv_ord as $c_ord) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $c_ord->ord_onbehalf_of ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $c_ord->ord_onbehalf_guard ?> </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $c_ord->premium ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $c_ord->premi_chal_recpt_no ?> </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $this->Location_model->getPattaType($c_ord->new_patta_type) ?>
                                </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $c_ord->new_patta_no ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $c_ord->new_dag_no ?> </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $c_ord->land_area_b ? $c_ord->land_area_b : 0 ?>B -
                                    <?= $c_ord->land_area_k ? $c_ord->land_area_k : 0 ?>K -
                                    <?= $c_ord->land_area_lc ? $c_ord->land_area_lc : 0 ?>L -
                                    <?= $c_ord->land_area_g ? $c_ord->land_area_g : 0 ?>G -
                                    <?= $c_ord->land_area_kr ? $c_ord->land_area_kr : 0 ?>Kr
                                </label>
                            </td>
                        </tr>

                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="100%"> No Data Found</td>
                    </tr>

                <?php } ?>

            </table>
        </div>
    <?php }
} ?>


<!--//// Reclass Case //////-->
<?php if ($case_type == 'RC') { ?>
    <div class=" my-2 py-2 bg-white rounded">
        <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
            Case Details
        </div>
        <table class='table table-bordered unicode'>
            <tr>
                <td width="35%">
                    <label class="text-danger">Case No.
                        :&nbsp;&nbsp;&nbsp;<?= $t_reclass[0]->case_no ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Order Status
                        :&nbsp;&nbsp;&nbsp;
                        <?php $status_R = null;
                        $reclassification = $t_reclass[0];
                        if ($reclassification->co_yn == ' ' or $reclassification->co_yn == null) {
                            $status_R = 'Pending with CO';
                        }
                        if ($reclassification->dc_yn == '' or $reclassification->dc_yn == null) {
                            $status_R = 'Pending with DC';
                        }
                        if ($reclassification->status == 'R') {
                            $status_R = 'Case Has Been Rejected';
                        }
                        if ($reclassification->co_yn == null) {
                            $status_R = 'Pending with CO';
                        }
                        if ($reclassification->status == 'M') {
                            $status_R = 'Reverted back to LM';
                        }
                        if ($reclassification->status == 'A') {
                            $status_R = 'pending with ADC';
                        }
                        if ($reclassification->status == 'C') {
                            $status_R = 'Pending with CO';
                        }
                        if ($reclassification->status == 'D') {
                            $status_R = 'Pending with DC';
                        }
                        if (($reclassification->rkg_chitha_updated_yn != null) &&
                            ($reclassification->co_chitha_updated_yn != null)) {
                            $status_R = 'Case has been passed';
                        }
                        echo $status_R; ?>
                    </label>
                </td>
                <td width="35%">
                    <label class="text-danger"> Order Type
                        :&nbsp;&nbsp;&nbsp;<?= $order_type ?></label>
                </td>
            </tr>
            <tr>
                <td width="35%">
                    <label class="text-danger">Transfer Type :&nbsp;&nbsp <?php if (isset($trans_type)) {
                            echo $trans_type;
                        } else {
                            echo 'NA';
                        } ?>
                    </label>
                </td>
                <td width="35%">
                    <label class="text-danger">New Land Use Year
                        :&nbsp;&nbsp;<?= $t_reclass[0]->new_landuse_year ?></label>
                </td>
                <td width="35%">

                </td>
            </tr>
        </table>
    </div>

    <?php if ($t_reclass[0]->co_chitha_updated_yn == 'Y') { ?>
        <div class=" my-2 py-2 bg-white rounded">
            <table class='table table-bordered unicode'>
                <tr>
                    <td width="35%" colspan="2">
                        <label>DC/ADC Note :&nbsp;&nbsp;&nbsp;<?=
                            $reclass[0]->dc_approval ? $reclass[0]->dc_approval : '' ?>
                        </label>
                    </td>
                    <td width="35%">
                        <label>DC/ADC Order Date
                            :&nbsp;&nbsp;<?= $reclass[0]->dc_approval_date ? $reclass[0]->dc_approval_date : '' ?></label>
                    </td>
                </tr>
                <tr>
                    <td width="35%" colspan="2">
                        <label>ADC Note :&nbsp;&nbsp;&nbsp;<?=
                            $t_reclass[0]->dc_approval ? $t_reclass[0]->adc_report : '' ?>
                        </label>
                    </td>
                    <td width="35%">
                        <label>ADC Order Date :&nbsp;&nbsp;</label>
                    </td>
                </tr>
                <tr>
                    <td width="35%" colspan="2">
                        <label>CO Note :&nbsp;&nbsp;&nbsp;<?=
                            $reclass[0]->co_recommendation ? $reclass[0]->co_recommendation : '' ?>
                        </label>
                    </td>
                    <td width="35%">
                        <label>CO Order Date
                            :&nbsp;&nbsp;<?= $reclass[0]->co_date ? $reclass[0]->co_date : '' ?></label>
                    </td>

                </tr>
                <tr>
                    <td width="35%">
                        <label>Lot Mondal Name
                            :&nbsp;&nbsp;<?php if (isset($reclass[0]->lm_code)) {
                                echo $this->Location_model->getName($reclass[0]->lm_code,
                                    $reclass[0]->dist_code,
                                    $reclass[0]->subdiv_code, $reclass[0]->cir_code,
                                    $reclass[0]->mouza_pargona_code, $reclass[0]->lot_no);
                            } ?>
                        </label>
                    </td>
                    <td width="35%">
                        <label>LM Entry Date :&nbsp;&nbsp;<?= $reclass[0]->lm_date ?></label>
                    </td>
                    <td width="35%">
                        <label>LM Note :&nbsp;&nbsp;
                            <?php if (isset($lm_note)) {
                                foreach ($lm_note as $note) {
                                    echo $note->report_on_possession;
                                }
                            }
                            ?>
                        </label>
                    </td>
                </tr>

            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
                Proceeding Flow
            </div>
            <table class='table table-bordered unicode'>
                <thead>
                <th width="10%">
                    <label>Proceeding Id</label>
                </th>
                <th width="10%">
                    <label>User Name</label>
                </th>
                <th width="15%">
                    <label>Entry Date</label>
                </th>
                <th width="45%">
                    <label>Order</label>
                </th>
                <th width="30%">
                    <label>Note on order</label>
                </th>

                </thead>
                <?php if (isset($procedding)) {
                    foreach ($procedding as $pro) { ?>
                        <tr>
                            <td>
                                <label><?= $pro->proceeding_id ?></label>
                            </td>
                            <td>
                                <label>
                                    <?php if (isset($pro->user_code)) {
                                        echo $this->Location_model->getName($pro->user_code, $reclass[0]->dist_code,
                                            $reclass[0]->subdiv_code, $reclass[0]->cir_code,
                                            $reclass[0]->mouza_pargona_code, $reclass[0]->lot_no);
                                    } ?>
                                </label>
                            </td>
                            <td>
                                <label><?= $pro->date_entry ?></label>
                            </td>
                            <td>
                                <label><?= $pro->co_order ?></label>
                            </td>
                            <td>
                                <label><?= $pro->note_on_order ?></label>
                            </td>
                        </tr>
                    <?php }
                }
                if (isset($dc_pros)) { ?>
                    <tr>
                        <td colspan="100%" class="bg-primary text-white center"> DC / ADC Proceeding Flow</td>
                    </tr>
                    <?php foreach ($dc_pros as $dpro) { ?>
                        <tr>
                            <td>
                                <label><?= $dpro->proceeding_id ?></label>
                            </td>
                            <td>
                                <label>
                                    <?php if (isset($dpro->user_code)) {
                                        echo $this->Location_model->getName($dpro->user_code,
                                            $reclass[0]->dist_code,
                                            $reclass[0]->subdiv_code, $reclass[0]->cir_code,
                                            $reclass[0]->mouza_pargona_code, $reclass[0]->lot_no);
                                    } ?>
                                </label>
                            </td>
                            <td>
                                <label><?= $dpro->date_entry ?></label>
                            </td>
                            <td>
                                <label><?= $dpro->co_order ?></label>
                            </td>
                            <td>
                                <label><?= $dpro->note_on_order ?></label>
                            </td>
                        </tr>
                    <?php }
                } ?>

            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-success p-2 mb-2 rounded bold" style="font-size: 18px;">
                Reclassification Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Dag No.</label>
                    </td>
                    <td>
                        <label class="text-black">Patta No</label>
                    </td>
                    <td>
                        <label class="text-black">Patta Type Code</label>
                    </td>
                    <td>
                        <label class="text-black">Present Land Class</label>
                    </td>
                    <td>
                        <label class="text-black">Present Land Revenue</label>
                    </td>
                    <td>
                        <label class="text-black">Local Tax</label>
                    </td>
                    <td>
                        <label class="text-black">Total Revenue</label>
                    </td>
                    <td>
                        <label class="text-black">Dag Area (B-K-L-G-Kr)</label>
                    </td>
                    <td>
                        <label class="text-black">Proposed Land Class</label>
                    </td>
                    <td>
                        <label class="text-black">Proposed Land Revenue</label>
                    </td>
                    <td>
                        <label class="text-black">Proposed Local Tax</label>
                    </td>
                    <td>
                        <label class="text-black">Revenue Difference</label>
                    </td>
                </tr>
                <?php if (isset($reclass)) {
                    foreach ($reclass as $re) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $re->dag_no ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $re->patta_no ?> </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?php if (isset($re->patta_type_code)) {
                                        if ($re->patta_type_code != 0) {
                                        echo $this->Location_model->getPattaType($re->patta_type_code);
                                    } else {
                                        echo $re->patta_type_code;
                                        }
                                    } ?>
                                </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $re->present_land_class ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $re->present_land_revenue ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $re->present_land_localtax ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $re->present_total_revenue ?></label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $re->dag_area_b ? $re->dag_area_b : 0 ?>B -
                                    <?= $re->dag_area_k ? $re->dag_area_k : 0 ?>K -
                                    <?= $re->dag_area_lc ? $re->dag_area_lc : 0 ?>L -
                                    <?= $re->dag_area_g ? $re->dag_area_g : 0 ?>G -
                                    <?= $re->dag_area_kr ? $re->dag_area_kr : 0 ?>Kr
                                </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $re->proposed_land_class ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $re->proposed_land_revenue ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $re->proposed_land_localtax ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $re->revenue_diff ?></label>
                            </td>
                        </tr>

                    <?php }
                } ?>

            </table>
        </div>

    <?php }
} ?>


<!--//// Allotment Case //////-->
<?php if ($case_type == 'AL') { ?>
    <div class=" my-2 py-2 bg-white rounded">
        <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
            Case Details
        </div>
        <table class='table table-bordered unicode'>
            <tr>
                <td width="35%">
                    <label class="text-danger">Case No.
                        :&nbsp;&nbsp;&nbsp;<?= $al->case_no ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Order Status
                        :&nbsp;&nbsp;&nbsp;<?php if ($al->status == 'F') {
                            echo 'PASSED';
                        } else if ($al->status == 'R') {
                            echo 'Rejected';
                        } else {
                            echo 'Pending';
                        } ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger"> Order Type
                        :&nbsp;&nbsp;&nbsp;<?= $order_type ?></label>
                </td>
            </tr>
            <tr>
                <td width="35%">
                    <label class="text-danger">Transfer Type :&nbsp;&nbsp <?php if (isset($trans_type)) {
                            echo $trans_type;
                        } ?>
                    </label>
                </td>
                <td width="35%">
                    <label class="text-danger">Year :&nbsp;&nbsp;<?= $al->year_no ?></label>
                </td>
                <td width="35%">

                </td>
            </tr>
        </table>
    </div>

    <?php if ($al->status == 'F') { ?>
        <div class=" my-2 py-2 bg-white rounded">
            <table class='table table-bordered unicode'>
                <tr>
                    <td width="35%">
                        <label>Circle Officer Name
                            :&nbsp;&nbsp <?php if (isset($al->co_code)) {
                                echo $this->Location_model->getName($al->co_code,
                                    $al->dist_code,
                                    $al->subdiv_code, $al->circle_code,
                                    $al->mouza_pargona_code, $al->lot_no);
                            } ?>
                        </label>
                    </td>
                    <td width="35%">
                        <label>CO Order Date :&nbsp;&nbsp;<?php if (isset($ch_ord_b->co_ord_date)) {
                                echo $ch_ord_b->co_ord_date;
                            } ?></label>
                    </td>
                    <td width="35%">
                        <!--                        <label>CO Note :&nbsp;&nbsp;&nbsp;-->
                        </label>
                    </td>
                </tr>
                <tr>
                    <td width="35%">
                        <label>Lot Mondal Name
                            :&nbsp;&nbsp;<?php if (isset($al->lm_code)) {
                                echo $this->Location_model->getName($al->lm_code,
                                    $al->dist_code,
                                    $al->subdiv_code, $al->circle_code,
                                    $al->mouza_pargona_code, $al->lot_no);
                            } ?></label>
                    </td>
                    <td width="35%">
                        <label>LM Entry Date :&nbsp;&nbsp;<?php if (isset($ch_ord_b->lm_sign_date)) {
                                echo $ch_ord_b->lm_sign_date;
                            } ?></label>
                    </td>
                    <td width="35%">
                        <label>LM Note :&nbsp;&nbsp;
                            <?php if (isset($lm_note)) {
                                foreach ($lm_note as $note) {
                                    echo $note->lm_comment;
                                }
                            }
                            ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td width="35%">
                        <label>Supervisor Kanungo Name :&nbsp;&nbsp;<?php if (isset($al->sk_code)) {
                                echo $this->Location_model->getName($al->sk_code, $al->dist_code,
                                    $al->subdiv_code, $al->circle_code,
                                    $al->mouza_pargona_code, $al->lot_no);
                            } ?></label>
                    </td>
                    <td width="35%">
                        <label>SK Entry Date :&nbsp;&nbsp;<?php if (isset($ch_ord_b->sk_sign_date)) {
                                echo $ch_ord_b->sk_sign_date;
                            } ?></label>
                    </td>
                    <td width="35%">
                        <label>SK Note :&nbsp;
                            <?php if (isset($lm_note)) {
                                foreach ($lm_note as $note) {
                                    echo $note->sk_comment;
                                }
                            }
                            ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td width="35%">
                        <label>Assistant Name :&nbsp;&nbsp;<?php if (isset($al->user_code)) {
                                echo $this->Location_model->getName($al->user_code, $al->dist_code,
                                    $al->subdiv_code, $al->circle_code,
                                    $al->mouza_pargona_code, $al->lot_no);
                            } ?></label>
                    </td>
                    <td width="35%">
                        <label>AST Entry Date :&nbsp;&nbsp;<?php if (isset($ch_ord_b->date_entry)) {
                                echo $ch_ord_b->date_entry;
                            } ?></label>
                    </td>
                    <td width="35%">
                        <!--                        <label>AST Note :&nbsp;</label>-->
                    </td>
                </tr>

            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
                Proceeding Flow
            </div>
            <table class='table table-bordered unicode'>
                <thead>
                <th width="10%">
                    <label>Proceeding Id</label>
                </th>
                <th width="10%">
                    <label>User Name</label>
                </th>
                <th width="15%">
                    <label>Entry Date</label>
                </th>
                <th width="45%">
                    <label>Order</label>
                </th>
                <th width="30%">
                    <label>Note on order</label>
                </th>

                </thead>
                <?php if (isset($procedding)) {
                    foreach ($procedding as $pro) { ?>
                        <tr>
                            <td>
                                <label><?= $pro->proceeding_id ?></label>
                            </td>
                            <td>
                                <label>
                                    <?php if (isset($pro->user_code)) {
                                        echo $this->Location_model->getName($pro->user_code,
                                            $al->dist_code,
                                            $al->subdiv_code, $al->circle_code,
                                            $al->mouza_pargona_code, $al->lot_no);
                                    } ?>
                                </label>
                            </td>
                            <td>
                                <label><?= $pro->date_entry ?></label>
                            </td>
                            <td>
                                <label><?= $pro->co_order ?></label>
                            </td>
                            <td>
                                <label><?= $pro->note_on_order ?></label>
                            </td>
                        </tr>
                    <?php }
                }
                if (isset($dc_pros)) { ?>
                    <tr>
                        <td colspan="100%" class="bg-success text-white center"> DC / ADC Proceeding Flow</td>
                    </tr>
                    <?php foreach ($dc_pros as $dpro) { ?>
                        <tr>
                            <td>
                                <label><?= $dpro->proceeding_id ?></label>
                            </td>
                            <td>
                                <label>
                                    <?php if (isset($dpro->user_code)) {
                                        echo $this->Location_model->getName($dpro->user_code,
                                            $al->dist_code,
                                            $al->subdiv_code, $al->circle_code,
                                            $al->mouza_pargona_code, $al->lot_no);
                                    } ?>
                                </label>
                            </td>
                            <td>
                                <label><?= $dpro->date_entry ?></label>
                            </td>
                            <td>
                                <label><?= $dpro->co_order ?></label>
                            </td>
                            <td>
                                <label><?= $dpro->note_on_order ?></label>
                            </td>
                        </tr>
                    <?php }
                } ?>

            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
                Dag Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Dag No.</label>
                    </td>
                    <td>
                        <label class="text-black">Patta No</label>
                    </td>
                    <td>
                        <label class="text-black">Patta Type Code</label>
                    </td>
                    <td>
                        <label class="text-black">Total Land (B-K-L-G-Kr)</label>
                    </td>
                    <td>
                        <label class="text-black">Alloted Land (B-K-L-G-Kr)</label>
                    </td>
                </tr>
                <?php if (isset($dags)) {
                    foreach ($dags as $dag) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $dag->dag_no ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $dag->patta_no ?> </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?php if (isset($dag->patta_type_code)) {
                                        if($dag->patta_type_code != 0) {
                                        echo $this->Location_model->getPattaType($dag->patta_type_code);
                                     } else {
                                        echo $dag->patta_type_code;
                                    }} ?>
                                </label>
                            </td>

                            <td>
                                <label class="text-danger">
                                    <?= $dag->tot_area_b ? $dag->tot_area_b : 0 ?>B -
                                    <?= $dag->tot_area_k ? $dag->tot_area_k : 0 ?>K -
                                    <?= $dag->tot_area_lc ? $dag->tot_area_lc : 0 ?>L -
                                    <?= $dag->tot_area_g ? $dag->tot_area_g : 0 ?>G -
                                    <?= $dag->tot_area_kr ? $dag->tot_area_kr : 0 ?>Kr
                                </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $dag->alot_area_b ? $dag->alot_area_b : 0 ?>B -
                                    <?= $dag->alot_area_k ? $dag->alot_area_k : 0 ?>K -
                                    <?= $dag->alot_area_lc ? $dag->alot_area_lc : 0 ?>L -
                                    <?= $dag->alot_area_g ? $dag->alot_area_g : 0 ?>G -
                                    <?= $dag->alot_area_kr ? $dag->alot_area_kr : 0 ?>Kr
                                </label>
                            </td>
                        </tr>

                    <?php }
                } ?>

            </table>
        </div>


        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                Petitioner Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Petitioner Name</label>
                    </td>
                    <td>
                        <label class="text-black">Alotee Id</label>
                    </td>
                    <td>
                        <label class="text-black">Guardian Name</label>
                    </td>
                    <td>
                        <label class="text-black">Guardian Relation</label>
                    </td>
                    <td>
                        <label class="text-black">Mobile No.</label>
                    </td>
                </tr>

                <?php if (isset($applicants)) {
                    foreach ($applicants as $applicant) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $applicant->alotee_name ?></label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?php if (isset($applicant->alotee_id)) {
                                        echo $applicant->alotee_id;
                                    } ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $applicant->alotee_gurdian ?> </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $this->Location_model->relation($applicant->alotee_reln) ?>
                                </label>
                            </td>

                            <td>
                                <label class="text-danger"><?= $applicant->alotee_mobile ?> </label>
                            </td>
                        </tr>

                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="100%"> No Data Found</td>
                    </tr>

                <?php } ?>

            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                Chitha Remark Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Allotee Name</label>
                    </td>
                    <td>
                        <label class="text-black">Guardian Name</label>
                    </td>
                    <td>
                        <label class="text-black">Allotee Type</label>
                    </td>
                    <td>
                        <label class="text-black">Allotee Land Code</label>
                    </td>
                    <td>
                        <label class="text-black">Patta No.</label>
                    </td>
                    <td>
                        <label class="text-black">Old Dag No</label>
                    </td>
                    <td>
                        <label class="text-black">Allotee Land Area (B-K-L-G-Kr)</label>
                    </td>
                    <td>
                        <label class="text-black">Land Revenue</label>
                    </td>
                </tr>

                <?php if (isset($ch_ord)) {
                    foreach ($ch_ord as $c_ord) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $c_ord->allottee_name ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $c_ord->allottee_guardian ?> </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $c_ord->allottee_type_code ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $c_ord->allottee_land_code ?> </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $c_ord->patta_no ?> </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $c_ord->old_dag ?></label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $c_ord->allottee_land_b ? $c_ord->allottee_land_b : 0 ?>B -
                                    <?= $c_ord->allottee_land_k ? $c_ord->allottee_land_k : 0 ?>K -
                                    <?= $c_ord->allottee_land_lc ? $c_ord->allottee_land_lc : 0 ?>L -
                                    <?= $c_ord->allottee_land_g ? $c_ord->allottee_land_g : 0 ?>G -
                                    <?= $c_ord->allottee_land_kr ? $c_ord->allottee_land_kr : 0 ?>Kr
                                </label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?= $c_ord->land_revenue ?>
                                </label>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="100%"> No Data Found</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php }
} ?>


<!--//// Misc Case //////-->
<?php if ($case_type == 'MI') { ?>
    <div class=" my-2 py-2 bg-white rounded">
        <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
            Case Details
        </div>
        <table class='table table-bordered unicode'>
            <tr>
                <td width="35%">
                    <label class="text-danger">Case No.
                        :&nbsp;&nbsp;&nbsp;<?= $mi->misc_case_no ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Order Status
                        :&nbsp;&nbsp;&nbsp;
                        <?php $nr = $mi;
                        if (($nr->lm_note_yn == null) and ($nr->status == '18') and ($nr->status != 'F')) {
                            $status = "<label class='label label-info'>PENDING WITH LM</label>";
                        } else if (($nr->sk_note_yn == null) and ($nr->status == '02') and ($nr->status != 'F')) {
                            $status = "<label class='label label-info'>PENDING WITH SK</label>";
                        } else if (($nr->status == '18') and ($nr->notice_generated_yn == null) and ($nr->status != 'F')) {
                            $status = "<label class='label label-success'>Pending with AST for Notice Generation</label>";
                        } else if (($nr->status == '1') and ($nr->status != 'F')) {
                            $status = "<label class='label label-danger'>Pending with CO</label>";
                        } else if (($nr->status == '02') and ($nr->sk_note_yn != null) and ($nr->status != 'F')) {
                            $status = "<label class='label label-danger'>Pending with CO</label>";
                        } else if ($nr->status == 'F') {
                            $status = "<label class='label label-danger'>Case Rejected</label>";
                        } else if (($nr->status == '10') and ($nr->status != 'F')) {
                            $status = "<label class='label label-success'>Case has been Passed</label>";
                        } else if (($nr->status == 'L') && ($nr->status != 'F')) {

                            $status = "<label class='label label-danger'>Case has been Reverted back to LM</label>";
                        }
                        echo $status; ?>
                    </label>
                </td>
                <td width="35%">
                    <label class="text-danger"> Case Type
                        :&nbsp;&nbsp;&nbsp;<?= $order_type ?></label>
                </td>
            </tr>
            <tr>
                <td width="35%">
                    <label class="text-danger">Year :&nbsp;&nbsp;<?= $mi->year_no ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Patta No :&nbsp;&nbsp;<?= $mi->patta_no ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Patta Type
                        :&nbsp;&nbsp;<?= $this->Location_model->getPattaType($mi->patta_type_code) ?></label>
                </td>
            </tr>
            <tr>
                <td width="35%">
                    <label class="text-danger">Dag No :&nbsp;&nbsp;<?= $mi->dag_no ?></label>
                </td>

                <td width="35%">
                    <label class="text-danger">Submission Date :&nbsp;&nbsp;<?= $mi->submission_date ?></label>
                </td>
                <td width="35%">
                </td>
            </tr>
        </table>
    </div>

    <?php if ($mi->status == '10') { ?>
        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                Process Report
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Note No</label>
                    </td>
                    <td>
                        <label class="text-black">User Name</label>
                    </td>
                    <td>
                        <label class="text-black">Process Note</label>
                    </td>
                    <td>
                        <label class="text-black">Note Date</label>
                    </td>
                </tr>

                <?php if (isset($pros)) {
                    foreach ($pros as $mpro) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $mpro->note_no ?></label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?php if (isset($mpro->user_code)) {
                                        echo $this->Location_model->getName($mpro->user_code,
                                            $mi->dist_code,
                                            $mi->subdiv_code, $mi->cir_code,
                                            $mi->mouza_pargona_code, $mi->lot_no);
                                    } ?>
                                </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $mpro->process_note ?> </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $mpro->note_date ?></label>
                            </td>
                        </tr>

                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="100%"> No Data Found</td>
                    </tr>

                <?php } ?>

            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                First Party Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Petition Pattdar Old Name</label>
                    </td>
                    <td>
                        <label class="text-black">Petition Pattdar New Name</label>
                    </td>
                    <td>
                        <label class="text-black">Pattadar Id</label>
                    </td>
                    <td>
                        <label class="text-black">Entry Date</label>
                    </td>
                </tr>

                <?php if (isset($mis_f)) {
                    foreach ($mis_f as $applicant) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $applicant->petition_pdar_name_old ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $applicant->petition_pdar_name_new ?></label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?php if (isset($applicant->petition_pdar_id)) {
                                        echo $applicant->petition_pdar_id;
                                    } ?>
                                </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $applicant->submission_date ?> </label>
                            </td>
                        </tr>

                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="100%"> No Data Found</td>
                    </tr>

                <?php } ?>

            </table>
        </div>

        <?php if ($mi->misc_case_type == '07') { ?>
            <div class=" my-2 py-2 bg-white rounded">
                <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                    Second Party Details
                </div>
                <table class='table table-bordered unicode'>
                    <tr>
                        <td>
                            <label class="text-black">Opp Pdar Id</label>
                        </td>
                        <td>
                            <label class="text-black">Opp Comment</label>
                        </td>
                        <td>
                            <label class="text-black">Entry Date</label>
                        </td>
                    </tr>

                    <?php if (isset($mis_s)) {
                        foreach ($mis_s as $s) { ?>
                            <tr>
                                <td>
                                    <label class="text-danger"><?= $s->opp_pdar_id ?></label>
                                </td>
                                <td>
                                    <label class="text-danger"><?= $s->opp_comment ?></label>
                                </td>
                                <td>
                                    <label class="text-danger"><?= $s->submission_date ?> </label>
                                </td>
                            </tr>

                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="100%"> No Data Found</td>
                        </tr>

                    <?php } ?>

                </table>
            </div>
        <?php }
    }
} ?>


<!--//// NR Case //////-->
<?php if ($case_type == 'NR') { ?>
    <div class=" my-2 py-2 bg-white rounded">
        <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
            Case Details
        </div>
        <table class='table table-bordered unicode'>
            <tr>
                <td width="35%">
                    <label class="text-danger">Case No.
                        :&nbsp;&nbsp;&nbsp;<?= $nr->case_no ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Order Status
                        :&nbsp;&nbsp;&nbsp;
                        <?php $status = null;
                        if (($nr->order_passed == 'Y') && ($nr->status != 'F')){
                            $status = "<label class='label label-success'>Case has been Passed</label>";
                        }
                        else if (($nr->order_passed == 'Y') && ($nr->status == 'F')){
                            $status = "<label class='label label-danger'>Case has been Rejected</label>";
                        }
                        else if (($nr->lm_note_yn == null) && ($nr->order_passed != 'Y')) {
                            $status = "<label class='label label-info'>PENDING WITH LM</label>";
                        } else if (($nr->sk_note_yn == null) && ($nr->order_passed != 'Y')) {
                            $status = "<label class='label label-info'>PENDING WITH SK</label>";
                        } else if (($nr->not_fresh == null) and ( $nr->dc_approval_yn == null) &&
                            ($nr->order_passed != 'Y')) {
                            $status = "<label class='label label-danger'>Pending with CO</label>";
                        }
                        else if (($nr->notice_generated_yn == null) &&
                            ($nr->order_passed != 'Y')) {
                            $status = "<label class='label label-danger'>Pending with AST</label>";
                        }else if (($nr->not_fresh == 'Y') and ( $nr->co_recommendation_yn == null) &&
                            ($nr->order_passed != 'Y')) {
                            $status = "<label class='label label-danger'>Pending with CO</label>";
                        }
                        else if (($nr->dc_approval_yn == null) && ($nr->order_passed != 'Y')) {
                            $status = "<label class='label label-success'>Pending with DC/ADC</label>";
                        }
                        else if (($nr->co_chitha_corrected_yn == null) and ( $nr->dc_approval_yn != null) &&
                            ($nr->order_passed != 'Y')) {
                            $status = "<label class='label label-danger'>Pending with CO</label>";
                        }
                        echo $status;?>
                    </label>
                </td>
                <td width="35%">
                    <label class="text-danger"> Case Type
                        :&nbsp;&nbsp;&nbsp;<?= $order_type ?></label>
                </td>
            </tr>
            <tr>
                <td width="35%">
                    <label class="text-danger">Year :&nbsp;&nbsp;<?= $nr->year_no ?></label>
                </td>
                <td width="35%">
                    <label class="text-danger">Submission Date :&nbsp;&nbsp;<?= $nr->submission_date ?></label>
                </td>
                <td width="35%">
                </td>
            </tr>
        </table>
    </div>

    <?php if (($nr->order_passed == 'Y') && ($nr->status != 'F')) { ?>
        <div class=" my-2 py-2 bg-white rounded">
            <table class='table table-bordered unicode'>
                <tr>
                    <td width="35%">
                        <label>DC Order
                            :&nbsp;&nbsp;<?php if (isset($nr->dc_order)) {
                                echo $nr->dc_order;
                            } ?>
                        </label>
                    </td>
                    <td width="35%">
                        <label>Remark :&nbsp;&nbsp;<?php if (isset($nr->remarks)) {
                                echo $nr->remarks;
                            } ?>
                        </label>
                    </td>
                </tr>
            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                Process Report
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Proceeding No</label>
                    </td>
                    <td>
                        <label class="text-black">Co Order</label>
                    </td>
                    <td>
                        <label class="text-black">Note on Order</label>
                    </td>
                    <td>
                        <label class="text-black">User Name</label>
                    </td>
                    <td>
                        <label class="text-black">Entry Date</label>
                    </td>
                </tr>

                <?php if (isset($nr_proceeding)) {
                    foreach ($nr_proceeding as $mpro) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $mpro->proceeding_id ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $mpro->co_order ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $mpro->note_on_order ?></label>
                            </td>
                            <td>
                                <label class="text-danger">
                                    <?php if (isset($mpro->user_code)) {
                                        echo $this->Location_model->getName($mpro->user_code,
                                            $nr->dist_code,
                                            $nr->subdiv_code, $nr->cir_code,
                                            $nr->mouza_pargona_code, $nr->lot_no);
                                    } ?>
                                </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $mpro->date_entry ?></label>
                            </td>
                        </tr>

                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="100%"> No Data Found</td>
                    </tr>

                <?php } ?>

            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                LM/SK Note
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Sl No</label>
                    </td>
                    <td>
                        <label class="text-black">LM Report</label>
                    </td>
                    <td>
                        <label class="text-black">SK Note</label>
                    </td>
                    <td>
                        <label class="text-black">SK Note Date</label>
                    </td>
                    <td>
                        <label class="text-black">Entry Date</label>
                    </td>
                </tr>

                <?php $i=0; if (isset($nr_lm_note)) {
                    foreach ($nr_lm_note as $mpro) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= ++$i; ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $mpro->lm_report ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $mpro->sk_note ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $mpro->sk_note_date ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $mpro->date_entry ?></label>
                            </td>
                        </tr>

                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="100%"> No Data Found</td>
                    </tr>

                <?php } ?>

            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-primary p-2 mb-2 rounded bold" style="font-size: 18px;">
                Dag Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Dag No.</label>
                    </td>
                    <td>
                        <label class="text-black">Patta No</label>
                    </td>
                    <td>
                        <label class="text-black">Patta Type</label>
                    </td>
                </tr>
                <?php if (isset($nr_dag)) {
                foreach ($nr_dag as $dag) { ?>
                <tr>
                    <td>
                        <label class="text-danger"><?= $dag->dag_no ?></label>
                    </td>
                    <td>
                        <label class="text-danger"><?= $dag->patta_no ?> </label>
                    </td>
                    <td>
                        <label class="text-danger">
                            <?php if (isset($dag->patta_type_code)) {
                                if ($dag->patta_type_code != 0) {
                                    echo $this->Location_model->getPattaType($dag->patta_type_code);
                            } else {
                                echo $dag->patta_type_code;
                            }} ?>
                        </label>
                    </td>
                    <?php }
                    } ?>
            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-success p-2 mb-1 rounded bold" style="font-size: 18px;">
                Petitioner Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Petitioner Name</label>
                    </td>
                    <td>
                        <label class="text-black">Gender</label>
                    </td>
                    <td>
                        <label class="text-black">Guardian Name</label>
                    </td>
                    <td>
                        <label class="text-black">Guardian Relation</label>
                    </td>
                    <td>
                        <label class="text-black">Address</label>
                    </td>
                </tr>
                <?php if (isset($nr_petitioner)) {
                    foreach ($nr_petitioner as $applicant) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $applicant->pet_name ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?php if (isset($applicant->pet_gender)) {
                                        echo $this->Location_model->gender($applicant->pet_gender);
                                    } ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $applicant->guard_name ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $this->Location_model->relation($applicant->guard_rel) ?></label>
                            </td>

                            <td>
                                <label class="text-danger"><?= $applicant->add1 ?> <?= $applicant->add2 ?> </label>
                            </td>
                        </tr>

                    <?php }
                } ?>

            </table>
        </div>

        <div class=" my-2 py-2 bg-white rounded">
            <div class="text-white bg-info p-2 mb-1 rounded bold" style="font-size: 18px;">
                Pattadar Details
            </div>
            <table class='table table-bordered unicode'>
                <tr>
                    <td>
                        <label class="text-black">Pattadar Name</label>
                    </td>
                    <td>
                        <label class="text-black">Guardian Name</label>
                    </td>
                    <td>
                        <label class="text-black">Guardian Relation</label>
                    </td>

                    <td>
                        <label class="text-black">Address</label>
                    </td>
                    <td>
                        <label class="text-black">Dag No</label>
                    </td>
                </tr>
                <?php if (isset($nr_pattadar)) {
                    foreach ($nr_pattadar as $pattdar) { ?>
                        <tr>
                            <td>
                                <label class="text-danger"><?= $pattdar->pdar_name ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $pattdar->pdar_guardian ?> </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $this->Location_model->relation($pattdar->pdar_rel_guar) ?></label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $pattdar->pdar_add1 ?> <?= $pattdar->pdar_add2 ?> </label>
                            </td>
                            <td>
                                <label class="text-danger"><?= $pattdar->dag_no ?></label>
                            </td>
                        </tr>
                    <?php }
                } ?>

            </table>
        </div>

    <?php }
} ?>

<script src="<?php echo base_url(); ?>application/views/js/department.js"></script>