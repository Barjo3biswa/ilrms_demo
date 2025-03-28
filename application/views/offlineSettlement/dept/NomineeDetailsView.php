<?php if ($nextKin == true) : ?>
    <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center"><i class="fa fa-users" aria-hidden="true"></i>
        Family Details
    </h5>
    <p class="card-text">
    <table class="table">
        <tr class="bg-success">
            <th>Sl. No.</th>
            <th>Name</th>
            <th>Relation</th>
            <th>Address</th>
            <th>Mobile number</th>
        </tr>
        <?php $i = 1;
        foreach ($nextKin as $kin) : ?>
            <tr>
                <td>
                    <span><?= $i++ ?></span>
                </td>
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