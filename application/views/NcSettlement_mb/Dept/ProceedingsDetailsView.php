<div class="card anyClass">
    <div class="card-body proceedings">
        <table class="table table-bordered">
            <tr class="bg-secondary" style="color:white; text-transform:uppercase">
                <th class="text-center">Date of Remark</th>
                <th class="text-center">Time of Remark</th>
                <th class="text-center">Remark from</th>
                <th class="text-center">Remarks</th>
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
                    <td  class="text-center"><span class="case-no-bg"><?= $pro->note_on_order; ?></span></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>