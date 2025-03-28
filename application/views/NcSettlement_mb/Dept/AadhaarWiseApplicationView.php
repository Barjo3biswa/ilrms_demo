<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->
<link href="<?php echo base_url('css/department_style.css'); ?>" rel="stylesheet" />

<style>
    .anyClass {
        height: 500px;
        overflow-y: scroll;
    }
</style>
<!-- Test Section -->
<div class="container">
    <div class="row">
        <section>
            <div class="wizard">


                <form role="form">

                    <input type="hidden" name="application_no" value="<?= $_GET['app'] ?>">
                    <div class="tab-content">
                        <!-- Application Review starts here -->
                        <div class="tab-pane active" role="tabpanel" id="step1">
                            <h5 class="bg-success p-2 text-white shadow">
                                Applications applied by this Applicant
                            </h5>
                            <div class="card anyClass">
                                <div class="card-body">

                                    <div class="timeline">
                                        <?php $count = 0;
                                        foreach ($applications as $pro1) :
                                            if ($count % 2 == 0) { ?>
                                                <div class="timeline__content" style="background-color: #6472FF">
                                                    <span class="content_tag" style="margin-top: 15px; background-color: white; color: #4CAF50">
                                                        <a href="<?php echo base_url() ?>Basundhara/settlementBasu?app=<?= $pro1->application_no ?>&dist_code=<?= $_GET['dist_code'] ?>" target="_blank"><i class="fa fa-eye"></i> <small>Applications</small></a>
                                                    </span>
                                                    <span class="content_date" style="color: white; margin-top: 7px">
                                                        <?= $pro1->application_no; ?> <br>
                                                        <small>(<?= $pro1->service_name; ?>)</small>
                                                    </span>
                                                </div>
                                            <?php } else { ?>
                                                <div class="timeline__content" style="background-color: #09AA99">
                                                    <span class="content_tag" style="margin-top: 15px; background-color: white; color: #4CAF50">
                                                        <a href="<?php echo base_url() ?>Basundhara/settlementBasu?app=<?= $pro1->application_no ?>&dist_code=<?= $_GET['dist_code'] ?>" target="_blank"><i class="fa fa-eye"></i> <small>Applications</small></a>
                                                    </span>
                                                    <span class="content_date" style="color: white; margin-top: 7px">
                                                        <?= $pro1->application_no; ?><br>
                                                        <small>(<?= $pro1->service_name; ?>)</small>
                                                    </span>
                                                </div>
                                            <?php } ?>
                                        <?php $count++;
                                        endforeach; ?>
                                    </div>


                                    <h6 class="text-center"><span>Total Applications Received from this Applicant:</span> <span class="text-danger"><?= $count ?></span></h6>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

<!-- Department button script -->
<script src="<?php echo base_url('js/department/department.js'); ?>"></script>