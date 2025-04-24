<?php if ($nextKin == true) : ?>
    <h5 class="bg-secondary p-2 text-white shadow mt-2">
        Nominee Details
    </h5>
    <p class="card-text">
    <table class="table">
        <tr class="bg-success">
            <th>Nominee Name</th>
            <th>Relation with Nominee</th>
            <th>Address of Nominee</th>
            <th>Mobile number</th>
        </tr>
        <?php $i = 1;
        foreach ($nextKin as $kin) : ?>
            <tr>
                <td>
                    <span><?= $kin->next_of_kin_name ?></span>
                </td>
                <td>
                    <span?><?= $this->utilclass->getGuardianRelation($kin->relation_with_kin) ?></span>
                </td>
                <td>
                    <span><?= $kin->address ?></span>
                </td>
                <td>
                    <span><?= $kin->mobile_no ?></span>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </table>
    </p>
<?php endif; ?>