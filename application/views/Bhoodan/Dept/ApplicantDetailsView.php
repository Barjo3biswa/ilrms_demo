<!-- Applicant Details -->
<h5 class="bg-secondary p-2 text-white shadow mt-2 text-center"><i class="fa fa-user" aria-hidden="true"></i>
    Applicant Details
</h5>
<p class="card-text">
    <?php $i = 1;
    foreach ($applicants_buyers as $settlement) : ?>
<table class="table table-bordered">
    <tr>
        <th rowspan="6" style="vertical-align : middle;text-align:center;background-color:#2980b9; width:5% !important"><?= $i++; ?></th>
        <th style="width:25% !important">Name ( Assamese)</th>
        <td style="width:25% !important">
            <strong class="text-primary"><?= $settlement->pdar_name; ?></strong>
        </td>
        <th style="width:25% !important">Gurdian Name ( Assamese)</th>
        <td style="width:25% !important">
            <strong class="text-primary"><?= $settlement->pdar_guardian; ?></strong>
        </td>
    </tr>

    <tr>
        <th style="width:25% !important">Name ( English)</th>
        <td style="width:25% !important">
            <strong class="text-primary"><?= $settlement->eng_pdar_name; ?></strong>
        </td>
        <th style="width:25% !important">Gurdian Name ( English)</th>
        <td style="width:25% !important">
            <strong class="text-primary"><?= $settlement->eng_pdar_guardian; ?></strong>
        </td>
    </tr>

    <tr>
        <th style="width:25% !important">Relation</th>
        <td style="width:25% !important">
            <span?><?= $this->utilclass->getGuardianRelation($settlement->pdar_rel_guar) ?></strong>
        </td>
        <th style="width:25% !important">Gender</th>
        <td style="width:25% !important">
            <span><?= $this->utilclass->getGender($settlement->pdar_gender) ?></span>
        </td>
    </tr>
    <tr>
        <th>Caste</th>
        <td>
            <input type="hidden" name="caste" value="<?= $settlement_basic->caste ?>" class="form-control">
            <?php
            foreach (json_decode(CASTE) as $caste)
            {
                if ($caste->CODE == $settlement_basic['caste'])
                {
                    echo $caste->NAME;
                }
            }
            ?>
        </td>
        <th>Fall Under Protected Category</th>
        <td>
            <?php
            foreach(json_decode(PROTECTED_CLASS) as $p) {
                if ($p->CODE == $settlement->protected_category) {
                    echo $p->NAME;
                }
            }?>
        </td>
    </tr>
    

    <tr>
        <th style="width:25% !important">Mobile</th>
        <td style="width:25% !important">
            <span><?= $settlement->pdar_mobile; ?></span>
        </td>
        <th style="width:25% !important">
            Permanent address
        </th>
        <td style="width:25% !important">
            <span><?= $settlement->pdar_add1; ?></span>
        </td>
    </tr>
    <tr>
        <th style="width:25% !important">Present Address</th>
        <td style="width:25% !important">
            <span><?= $settlement->pdar_add2; ?></span>
        </td>

    </tr>
    
</table>
<?php endforeach; ?>
</p>
<!-- Applicant Details End -->


<!-- Land Owner Details -->
<?php if ($applicants_owners == true) : ?>
    <h5 class="bg-secondary p-2 text-white shadow mt-2">
        Land Owner Details
    </h5>

    <p class="card-text">
        <?php $i = 1;
        foreach ($applicants_owners as $settlement) : ?>
    <table class="table table-bordered">
        <tr>
            <th rowspan="5" style="vertical-align : middle;text-align:center;background-color:#16a085"><?= $i++; ?></th>
            <th>Name</th>
            <td colspan="2">
                <strong><?= $settlement->pdar_name; ?></strong>
            </td>
            <th>Father name</th>
            <td colspan="2">
                <strong><?= $settlement->pdar_guardian; ?></strong>
            </td>
        </tr>
        <tr>
            <th>In Place/Along WIth</th>
            <td colspan="2"><?= $settlement->inplace_alongwith; ?>
                <strong><?php if (($settlement->inplace_alongwith == "i") || ($settlement->inplace_alongwith == "I")) { ?>
                        <span class="text-success">In Place</span>
                    <?php } else if (($settlement->inplace_alongwith == "a") || ($settlement->inplace_alongwith == "A")) { ?>
                        <span class="text-success">Along With</span>
                    <?php } ?></strong>
            </td>
        </tr>
    </table>
<?php endforeach; ?>
</p>
<?php endif; ?>

<!-- Land Owner Details End -->

<!-- Occupier Details -->
<?php if ($applicants_encroacher == true) : ?>
    <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center">
        Occupier Details
    </h5>
    <p class="card-text">
        <?php $i = 1;
        foreach ($applicants_encroacher as $encroacher) : ?>
    <table class="table table-bordered">
        <tr>
            <th rowspan="5" style="vertical-align : middle;text-align:center;background-color:#27ae60;"><?= $i++; ?></th>

            <th>Occupier Name</th>
            <td colspan="2">
                <strong><?= $encroacher->pdar_name; ?></strong>
            </td>
            <th>Fathers Name</th>
            <td colspan="2">
                <strong><?= $encroacher->pdar_guardian; ?></strong>
            </td>
        </tr>
        <tr>
            <th>Dag No</th>
            <td colspan="2">
                <strong><?= $encroacher->dag_no; ?></strong>
            </td>
            <th>Possession From</th>
            <td colspan="2">
                <strong><?= $encroacher->period_possession; ?></strong>
            </td>
        </tr>


    </table>
<?php endforeach; ?>
</p>
<?php endif; ?>

<!-- Occupier Details End -->


<!--Deleted Occupier Details -->
<?php if ($deleted_encroacher == true) : ?>
    <!-- <h5 class="bg-danger p-2 text-white shadow mt-2 text-center">
        Deleted Occupier Details
    </h5> -->
    <p class="card-text">
        <?php $i = 1;
        foreach ($deleted_encroacher as $deleted) : ?>
    <table class="table table-bordered">
        <tr>
            <th rowspan="5" style="vertical-align : middle;text-align:center;background-color:#dc3545 ;">Deleted <i class="fa fa-trash" aria-hidden="true"></i></th>

            <th>Occupier Name</th>
            <td colspan="2">
                <strong><?= $deleted->pdar_name; ?></strong>
            </td>
            <th>Fathers Name</th>
            <td colspan="2">
                <strong><?= $deleted->pdar_guardian; ?></strong>
            </td>
        </tr>
        <tr>
            <th>Dag No</th>
            <td colspan="2">
                <strong><?= $deleted->dag_no; ?></strong>
            </td>
            <th>Possession From</th>
            <td colspan="2">
                <strong><?= $deleted->period_possession; ?></strong>
            </td>
        </tr>
    </table>
<?php endforeach; ?>
</p>
<?php endif; ?>

<!--Deleted Occupier Details End -->


<!-- Raiyati Details-->
<?php if ($applicants_riotee_nok == true) : ?>
    <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center">
        Raiyati Details
    </h5>
    <p class="card-text">
        <?php $i = 1;
        foreach ($applicants_riotee_nok as $settlement) : ?>
    <table class="table table-bordered">
        <tr>
            <th rowspan="5" style="vertical-align : middle;text-align:center;"><?= $i++; ?></th>
            <th>Khatian Number</th>
            <td colspan="2">
                <strong><?= $settlement->khatian_no; ?></strong>
            </td>
            <th>Name</th>
            <td colspan="2">
                <strong><?= $settlement->pdar_name; ?></strong>
            </td>
            <th>Father name</th>
            <td colspan="2">
                <strong><?= $settlement->pdar_guardian; ?></strong>
            </td>
        </tr>
        <tr>
            <th>Relationship With Raiyati</th>
            <td colspan="2">
                <?php
                if ($settlement->pdar_type == PDAR_GP) {
                ?>
                    <strong>Grand Son/ Daughter</strong>
                <?php
                } elseif ($settlement->pdar_type == PDAR_GGP) {
                ?>
                    <strong>Great Grand Son/ Daughter</strong>
                <?php
                }
                ?>
            </td>
        </tr>
    </table>
<?php endforeach; ?>
</p>
<?php endif; ?>

<!-- Riotee Details End -->

<?php if (isset($settlement_basic["bhumiputra_certificate_no"])) {
?>
    <!-- Bhumiputra Details Begin -->
    <h5 class="bg-secondary p-2 text-white shadow mt-2"><i class="fa fa-certificate" aria-hidden="true"></i>
        Bhumiputra Certificate/Ack. Details
    </h5>
    <p class="card-text">
    <table class="table table-bordered">
        <tr>
            <th>Bhumiputra Verified ?</th>
            <td>
                <?php if (($settlement_basic['bhumiputra_confirmation'] == 'Yes') || ($settlement_basic['bhumiputra_confirmation'] == 'YES')) { ?>
                    <strong class="text-success"><i class="fa fa-check"></i> </strong>
                <?php } else { ?>
                    <strong class="text-danger"><i class="fa fa-remove"></i> No</strong>
                <?php } ?>
            </td>
        </tr>
        <?php if (($settlement_basic['bhumiputra_confirmation'] == 'Yes') || ($settlement_basic['bhumiputra_confirmation'] == 'YES')) { ?>
        <tr>
            <th>Certificate/ Ack No</th>
            <td>
                    <strong><?= $settlement_basic['bhumiputra_certificate_no']; ?></strong>
                
            </td>
        </tr>
        <?php } ?>
    </table>
    </p>
    <!-- Bhumiputra Details End -->

<?php } ?>