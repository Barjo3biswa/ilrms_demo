<div class="timeline mb-4">
    <?php foreach ($proceedings as $pro) : ?>

        <?php if ($pro->status == MB_FINAL) : ?>
            <div class="timeline__content" style="background-color: #4CAF50">
                <span class="content_tag" style="margin-top: 15px; background-color: white; color: #4CAF50">
                    Application Approved
                </span>
                <span class="content_date" style="color: white; margin-top: 7px">
                    <?= date("F j, Y", strtotime($pro->date_entry)) ?>
                    <br>
                    by <?= $pro->office_from; ?>
                    </span>
                </span>
            </div>

        <?php elseif ($pro->status == MB_DISMISS) : ?>
            <div class="timeline__content" style="background-color: #EF5350">
                <span class="content_tag" style="margin-top: 15px; background-color: white; color: #EF5350">
                    Application Rejected
                </span>
                <span class="content_date" style="color: white; margin-top: 7px">
                    <?= date("F j, Y", strtotime($pro->date_entry)) ?>
                    <br>
                    by <?= $pro->office_from; ?>
                </span>
            </div>
        <?php else : ?>

            <div class="timeline__content">
                <span class="content_tag" style="background-color: #2ecc71; color: white"><i class="fa fa-check-circle" aria-hidden="true"></i>
                    <?php if ($pro->task != '') : ?>
                        <?= $pro->task; ?>
                    <?php else : ?>
                        Not Defined
                    <?php endif ?>
                </span>
                <span style="margin-top: 30px"></span>
                <span class="content_date">
                    <i class="fa fa-calendar" aria-hidden="true"></i> On <?= date("F j, Y", strtotime($pro->date_entry)) ?>
                </span>
                <span class="content_Name">
                    by&nbsp;
                    
                    <?php if ($pro->office_from != '') : ?>
                        <?= $pro->office_from; ?>
                    <?php else : ?>
                        Not Defined
                    <?php endif ?>
                </span>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>