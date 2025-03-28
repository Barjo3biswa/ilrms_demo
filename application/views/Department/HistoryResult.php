<style>
    .dt-button {
        background-color: #00e676 !important;
        padding: 5px 20px !important;
        border-radius: 5px;
    }
</style>
<link href="<?=base_url();?>assets/js/datatables/jquery.dataTables.min.css" rel="stylesheet">
<div class="row">
    <div class="col-lg-12">

        <div class="col-lg-10 offset-1 my-2 py-2 bg-white rounded">
            <div class="text-white bg-success p-2 mt-2 mb-2 rounded text-center" style="font-size: 18px;">
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
                        <label class="text-danger">
                            <?php if ($user_type == 'C') { ?>
                                User Type: Circle Officer
                            <?php } else if ($user_type == 'L') { ?>
                                User Type: Lot Mondal
                            <?php } else if ($user_type == 'D') { ?>
                                User Type: ADC / DC
                            <?php } ?>
                        </label>
                    </td>
                </tr>
                <td colspan="3">
                    <label class="text-danger">User Name :&nbsp;&nbsp;&nbsp;<?= $user_name->username ?></label>
                </td>
                </tr>
            </table>
        </div>

        <div class="col-lg-10 offset-1 my-2 py-2 bg-white rounded">
            <?php if ($user_type == 'C') { ?>
                <div class="text-white bg-primary p-2 mt-2 mb-2 rounded text-center" style="font-size: 18px;">
                    Order Passed Cases Within <?= $fromDate . ' to ' . $upDate ?>
                </div>
            <?php } else if ($user_type == 'L') { ?>

            <?php } else if ($user_type == 'D') { ?>
                <div class="text-white bg-primary p-2 mt-2 mb-2 rounded text-center" style="font-size: 18px;">
                    Allotment Details
                </div>
            <?php } ?>

            <?php if ($user_type != 'L') { ?>
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr class="alert alert-info">
                        <td width="10%">Sl No</td>
                        <td width="50%">Order No</td>
                        <td width="25%">Order Date</td>
                        <?php if ($user_type != 'D') { ?>
                            <td width="10%">Order Status</td>
                        <?php } ?>
                        <td width="5%">Type</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    foreach ($records as $r) { ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <!--                        <td><span class="view_case" style="cursor: pointer; text-decoration: underline; text-decoration-color:#ee7f6d;" data-case_no="-->
                            <? //= $r['ord_no'] ?><!--" data-case_type="--><? //= $r['type'] ?><!--" data-dist_code="-->
                            <? //= $r['dist_code'] ?><!--">--><? //= $r['ord_no'] ?><!--</span></td>-->
                            <td><?= $r['ord_no'] ?></td>

                            <td><?= $r['co_ord_date'] ?></td>
                            <?php if ($user_type != 'D') { ?>
                                <td><?= $r['order_pass'] ? 'Y' : 'y' ?></td>
                            <?php } ?>
                            <td><?php
                                $type = explode('/', $r['ord_no']);
                                if (isset($type[4])) {
                                    echo $type[4];
                                }
                                ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>

        <div class="col-lg-10 offset-1 my-2 py-2 bg-white rounded">
            <div class="text-white bg-danger p-2 mt-2 mb-2 rounded text-center" style="font-size: 18px;">
                User Login Details <?= $fromDate . ' to ' . $upDate ?>
            </div>
            <?php if (!$history) { ?>
                <div class="text-white bg-gradient-gray p-2 mt-2 mb-2 rounded text-center" style="font-size: 18px;">
                    No data available for <?= $fromDate . ' to ' . $upDate ?> period.
                </div>
            <?php } ?>
            <table class="table table-bordered dataTable">
                <thead>
                <tr class="alert alert-info">
                    <td>Sl No</td>
                    <td>Login IP</td>
                    <td>Date</td>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1;
                foreach ($history as $r) { ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $r['client_ip'] ?></td>
                        <td><?= $r['date_of_creation'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="view_case" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="my-1 bg-white rounded">
                        <div class="text-white bg-success p-1 mt-1 mb-1 rounded text-center" style="font-size: 18px;">
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
                                    <label class="text-danger">মৌজা (Mouza)
                                        :&nbsp;&nbsp;&nbsp;<?php if (isset($mouza)) {
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
                                    <label class="text-danger">
                                        <?php if ($user_type == 'C') { ?>
                                            User Type: Circle Officer
                                        <?php } else if ($user_type == 'L') { ?>
                                            User Type: Lot Mondal
                                        <?php } else if ($user_type == 'D') { ?>
                                            User Type: ADC / DC
                                        <?php } ?>
                                    </label>
                                </td>
                            </tr>
                            <td colspan="3">
                                <label class="text-danger">User Name
                                    :&nbsp;&nbsp;&nbsp;<?= $user_name->username ?></label>
                            </td>
                            </tr>
                        </table>
                    </div>
                    <div class="my-1 bg-white rounded">
                        <div class="text-white bg-primary p-1 mt-1 mb-1 rounded text-center" style="font-size: 18px;">
                            Order Details
                        </div>
                        <table class='table table-bordered unicode'>
                            <tr>
                                <td width="35%">
                                    <label class="text-danger">Order No : <span id="order_no"></span></label>
                                </td>
                                <td width="35%">
                                    <label class="text-danger">Village
                                        :&nbsp;&nbsp;&nbsp;<span id="vill_name"></span></label>
                                </td>
                                <td width="35%">
                                    <label class="text-danger">চক্র (Circle)
                                        :&nbsp;&nbsp;&nbsp;<?= $circle['loc_name'] ? $circle['loc_name'] : 'NA' ?></label>
                                </td>
                            </tr>
                            <tr>
                                <td width="35%">
                                    <label class="text-danger">মৌজা (Mouza)
                                        :&nbsp;&nbsp;&nbsp;<?php if (isset($mouza)) {
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
                                    <label class="text-danger">
                                        <?php if ($user_type == 'C') { ?>
                                            User Type: Circle Officer
                                        <?php } else if ($user_type == 'L') { ?>
                                            User Type: Lot Mondal
                                        <?php } else if ($user_type == 'D') { ?>
                                            User Type: ADC / DC
                                        <?php } ?>
                                    </label>
                                </td>
                            </tr>
                            <td colspan="3">
                                <label class="text-danger">User Name
                                    :&nbsp;&nbsp;&nbsp;<?= $user_name->username ?></label>
                            </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal_close" id="modal_close">Close</button>
            </div>
        </div>
    </div>
</div>

<!--<script src="--><?php //echo base_url(); ?><!--assets/js/datatables/pdfmake.min.js"></script>-->
<script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datatables/buttons.html5.min.js"></script>

<!--<script>-->
<!--    $(".modal_close").click(function () {-->
<!--        $('#view_case').modal('hide');-->
<!--    })-->
<!---->
<!--    $(".view_case").click(function(){-->
<!--        var case_no = $(this).attr("data-case_no");-->
<!--        var dist_code = $(this).attr("data-dist_code");-->
<!--        var result = case_no.split('/');-->
<!---->
<!--        var type= null;-->
<!--        if(result[4] == 'OMUT')-->
<!--        {-->
<!--            type= 'OMUT';-->
<!--        }-->
<!--        else if(result[4] == 'OPART')-->
<!--        {-->
<!--            type= 'OPART';-->
<!--        }-->
<!--        else if(result[4] == 'CONV')-->
<!--        {-->
<!--            type= 'CONV';-->
<!--        }-->
<!--        else if(result[4] == 'FMUT')-->
<!--        {-->
<!--            type= 'FMUT';-->
<!--        }-->
<!--        else if(result[4] == 'FPART')-->
<!--        {-->
<!--            type= 'FPART';-->
<!--        }-->
<!--        else if(result[4] == 'NR')-->
<!--        {-->
<!--            type= 'NR';-->
<!--        }-->
<!--        else if(result[4] == 'RECLASS')-->
<!--        {-->
<!--            type= 'RECLASS';-->
<!--        }-->
<!---->
<!--        $.ajax({-->
<!--            url: baseurl + "DepartmentController/getCaseDetails",-->
<!--            method: "POST",-->
<!--            data: { case_no: case_no, case_type:type, dist_code:dist_code },-->
<!--            dataType: "json",-->
<!--            beforeSend: function () {-->
<!--                console.log("beforeSend");-->
<!--            },-->
<!--            success: function (data) {-->
<!--                console.log(data);-->
<!--                $('#view_case').modal('show');-->
<!--            },-->
<!---->
<!--        });-->
<!--    });-->
<!--</script>-->

<script src="<?php echo base_url(); ?>assets/js/department.js"></script>
