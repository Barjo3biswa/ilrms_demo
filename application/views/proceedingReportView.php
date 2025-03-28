<div class="card anyClass">
    <div class="card-body proceedings">
        <table class="table table-bordered">
            <tr class="bg-secondary" style="color:white; text-transform:uppercase">\
                <th>case no</th>
                <th class="text-center">LM Remark</th>
                <th class="text-center">Time of Remark</th>
                <th class="text-center">SK Remark</th>
                <th class="text-center">Time of Remark</th>
            </tr>
            <?php $i = 1;
            foreach ($sibsagar as $pro) : ?>
                <tr>
                    <td class="text-center"><?php echo $pro->case_no;?>
                    </td>
                    <td class="text-center"><?php echo $pro->lm_note;?>
                    </td>
                    <td class="text-center">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <?= date("j F, Y", strtotime($pro->lm_note_date)) ?>
                    </td>
                    <td class="text-center"><?php echo $pro->sk_note;?>
                    </td>
                    <td class="text-center">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <?= date("h:i a", strtotime($pro->sk_note_date)) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <table class="table table-bordered">
            <tr class="bg-secondary" style="color:white; text-transform:uppercase">\
                <th>case no</th>
                <th class="text-center">CO order</th>
                <th class="text-center">Note on order</th>
                <th class="text-center">Time of Remark</th>
            </tr>
            <?php $i = 1;
            foreach ($charaideo as $pro) : ?>
                <tr>
                    <td class="text-center"><?php echo $pro->case_no;?>
                    </td>
                    <td class="text-center"><?php echo $pro->co_order;?>
                    </td>
                    
                    <td  class="text-center"><span class="case-no-bg"><?= $pro->note_on_order; ?></span></td>
                    <td class="text-center">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <?= date("h:i a", strtotime($pro->date_entry)) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>