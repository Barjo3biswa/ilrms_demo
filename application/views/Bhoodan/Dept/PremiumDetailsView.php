<!-- RoadSide Area Details Begin -->
<h5 class="bg-secondary p-2 text-white shadow mt-2 text-center">
    Premium Details
</h5>
<div class="row">
    <!-- <div class="col-md-6"></div> -->
    <div class="col-md-12" style="display: flex; justify-content: flex-end">
        <table class="table table-bordered">
            <?php foreach ($premium_data as $dagsprem) { ?>
                <tr>
                    <th>Zonal Value for dag no <span class=""><?= $dagsprem->dag_no ?></span></th>
                    <td>
                        <strong class="alert-warning">
                            <?= $dagsprem->zonal_valuation ?>
                        </strong>
                    </td>
                </tr>

                <tr>
                    <th>Selected Area</th>
                    <td>
                        <strong class="alert-warning">
                            <?= $dagsprem->area ?>
                        </strong>
                    </td>
                </tr>

                <tr>
                    <th>Purpose of Land</th>
                    <td>
                        <strong class="alert-warning">
                            <?= $dagsprem->land_type ?>
                        </strong>
                    </td>
                </tr>

                <tr>
                    <th>Encroached Land Type</th>
                    <td>
                        <strong class="alert-warning">
                            <?= $dagsprem->house_type ?>
                        </strong>
                    </td>
                </tr>

                <tr>
                    <th>Is ST/SC/Widows/Person with disabilities?</th>
                    <td>
                        <?php if (($dagsprem->concession == "Yes") || ($dagsprem->concession == "YES")) { ?>
                            <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($dagsprem->concession == "No") || ($dagsprem->concession == "NO")) { ?>
                            <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <th>Total amount for dag no </th>
                    <td>
                        <strong class="alert-warning">
                            <?= $dagsprem->amount_dag ?>
                        </strong>
                    </td>
                </tr>

                <div>
                    <tr>
                        <th class="text-primary">Final Amount</th>
                        <td>
                            <strong class="alert-warning">
                                <?= $dagsprem->final_amount ?>
                            </strong>
                        </td>
                    </tr>

                    <tr>
                        <th>Payment Mode</th>
                        <td>
                            <?php if (($dagsprem->is_full_pay == "Yes") || ($dagsprem->is_full_pay == "YES")) { ?>
                                <span class="text-success"><i class="fa fa-check"></i> Full Payment</span>
                            <?php } else if (($dagsprem->is_full_pay == "No") || ($dagsprem->is_full_pay == "NO")) { ?>
                                <span class="text-danger"><i class="fa fa-remove"></i> 30% Down Payment</span>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="text-danger">Total Due </th>
                        <td>
                            <strong class="alert-warning">
                                <?= $dagsprem->due_amount ?>
                            </strong>
                        </td>
                    </tr>
                </div>
            <?php } ?>
        </table>
    </div>
</div>

<!-- Roadside Reserve Area Details End -->