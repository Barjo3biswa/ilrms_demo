<h5 class="bg-secondary p-2 text-white shadow mt-2 text-center"><i class="fa fa-check-square-o" aria-hidden="true"></i>
    Self Declaration Details
</h5>
<p class="card-text">
<table class="table table-bordered">
    <?php
    foreach ($selfDeclarationDetails[0] as $key => $self) {
    ?>
        <tr>
            <th><?= $self->name ?></th>
            <td>
                <?php if ($self->status == "1") { ?>
                    <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                <?php } else if ($self->status == "0") { ?>
                    <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>
</p>