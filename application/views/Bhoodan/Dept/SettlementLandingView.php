<style>
    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        border-radius: 35px;
        font-size: 24px;
        line-height: 1.33;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        padding: 6px 0px;
        border-radius: 15px;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;
    }
</style>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row" style='margin-top:40px; margin-left:80px'>
            <!--Second Row Start-->
            <div class="col-lg-5 col-lg-offset-1">
                <div class="panel casedisplay">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <p class="regular" style="text-transform: uppercase;">
                                <?php if ($service_code == SETTLEMENT_TENANT_ID) { ?>
                                    Settlement Tenant
                            </p>
                        <?php } else if ($service_code == SETTLEMENT_AP_TRANSFER_ID) { ?>
                            Settlement AP Transfer
                        <?php } else if ($service_code == SETTLEMENT_TRIBAL_COMMUNITY_ID) { ?>

                            Settlement Tribal Community
                        <?php } else if ($service_code == SETTLEMENT_KHAS_LAND_ID) { ?>

                            Settlement Khas Land
                        <?php } else if ($service_code == SETTLEMENT_PGR_VGR_LAND_ID) { ?>

                            Settlement VGR PGR Land
                        <?php } else if ($service_code == SETTLEMENT_SPECIAL_CULTIVATORS_ID) { ?>

                            Settlement Special Cultivators
                        <?php } ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-active">
                            <tr class="">
                                
                                <td>Pending Case List</td>
                                <td><?php
                                    if ($pendingcount != '0') {

                                        echo "<button class='btn btn-danger btn-circle btn-sm'> $pendingcount</button>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($pendingcount != '0') { ?>
                                        <a href="<?php echo base_url() ?>index.php/Basundhara/request/<?= $service_code ?>" style="float:right">view</a>
                                    <?php } ?>
                                </td>

                            </tr>
                            <tr style="display:none">
                                <td>Approved Cases List</td>
                                <td><?php
                                    if ($approvedcount != '0') {
                                        echo "<button class='btn btn-success btn-circle btn-sm'> $approvedcount</button>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($approvedcount != '0') { ?>
                                        <a href="<?php echo base_url() ?>index.php/Basundhara/deptApprovedCases/<?= $service_code ?>" style="float:right">view</a>
                                    <?php } ?>
                                </td>

                            </tr>
                        
                            <tr style="display:none">
                                <td>Case Status</td>
                                <td></td>
                                <td><a href="<?php echo base_url() ?>index.php/Basundhara/caseStatus/<?= $service_code ?>" style="float:right">view</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
