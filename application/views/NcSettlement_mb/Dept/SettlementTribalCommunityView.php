<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->
<link href="<?php echo base_url('css/department_style.css'); ?>" rel="stylesheet" />
<style>
  .case-no-bg {
    background-color: #F2C94C;
    color: black !important;
    border-radius: 25px;
    padding-left: 6px;
    padding-right: 6px;

  }

  .bg-secondary {
    background-color: #414345 !important;
    /* border-style: double; */
  }
</style>

<!-- Test Section -->
<div class="container">
  <div class="row">
    <section>
      <div class="wizard">
        <div class="wizard-inner mb-1">
          <div class="connecting-line"></div>

          <ul class="nav nav-tabs shadow" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" style="text-transform: uppercase" data-toggle="tab" href="#step1" role="tab">Application &nbsp;&nbsp;<i class="fa fa-file" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" href="#step2" role="tab">LM Report&nbsp;&nbsp;<i class="fa fa-user" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" href="#step3" role="tab">Proceedings &nbsp;&nbsp;<i class="fa fa-tasks" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" href="#step7" role="tab">Case History &nbsp;&nbsp;<i class="fa fa-history" aria-hidden="true"></i></a>
            </li>


            <li class="nav-item">
              <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" href="#step6" role="tab">Department &nbsp;&nbsp;<i class="fa fa-building" aria-hidden="true"></i></a>
            </li>

          </ul>
        </div>

        <form role="form">
          <input type="hidden" name="service_code" value="<?= $settlement_basic['service_code']; ?>">
          <input type="hidden" name="rtps_app_no" value="<?= $rtps_app_no->basundhara; ?>">
          <input type="hidden" name="application_no" value="<?= $_GET['app'] ?>">

          <?php
          $sl_count = 1;
          ?>
          <div class="tab-content">
            <!-- Application Review starts here -->
            <div class="tab-pane active" role="tabpanel" id="step1">
              <h5 class="bg-success p-2 text-white shadow">
                Registration of <?= $service_name ?> (
                <span class="case-no-bg"><?= $_GET['app'] ?>, <?= $case_no ?></span> )
              </h5>
              <div class="card anyClass">
                <div class="card-body">

                  <!-- Application Details Begin -->
                  <?php
                  include(APPPATH . "views/SettlementView/Dept/AadhaarApplicationDetailsView.php");
                  ?>
                  <!-- Application Details End -->

                  <!-- Address Information Begin -->
                  <?php
                  include(APPPATH . "views/SettlementView/Dept/AddressInformationView.php");
                  ?>
                  <!--Address Information End  -->

                  <!-- Self Declaration Begin -->
                  <?php
                  include(APPPATH . "views/SettlementView/Dept/SelfDeclartionDetailsView.php");
                  ?>
                  <!-- Self Declaration  End-->

                  <!-- Applicant Details Include Begin -->
                  <?php
                  include(APPPATH . "views/SettlementView/Dept/ApplicantDetailsView.php");
                  ?>
                  <!-- Applicant Details  End-->

                  <!-- Area Details Include -->
                  <?php
                  include(APPPATH . "views/SettlementView/Dept/AreaDetailsView.php");
                  ?>
                  <!-- Area Details Include End -->

                  <!-- Dleteed Dag Details Include -->
                  <?php
                  include(APPPATH . "views/SettlementView/Dept/dagNotEligibleView.php");
                  ?>
                  <!-- Deleted Dag Details Include End -->
                  

                  <!-- Additional Property Details -->
                  <?php
                  include(APPPATH . "views/SettlementView/Dept/AdditionalPropertyDetailsView.php");
                  ?>
                  <!-- Additional Property Details End -->

                  <!-- Next of Kin Details -->
                  <?php
                  include(APPPATH . "views/SettlementView/Dept/NomineeDetailsView.php");
                  ?>
                  <!-- Next of Kin Details End -->


                  <h5 class="bg-secondary p-2 text-white shadow mt-2"><i class="fa fa-file-text" aria-hidden="true"></i>
                    Supporting Documents
                  </h5>
                  <p class="card-text">
                  <table class="table">
                    <?php foreach ($documents as $d) : ?>
                      <tr>
                        <th>
                          <a target='download' href="<?php echo base_url(); ?>index.php/Basundhara/document/<?= $d->name; ?>"><i class="fa fa-paperclip"></i> <?= $d->file_details; ?></a>

                        </th>
                      </tr>
                    <?php endforeach; ?>
                  </table>
                  </p>

                  <!-- <a href="#lm_report" onclick="lm()" class="btn btn-primary text-white">Go to LM report</a> -->
                </div>
              </div>

              <ul class="list-inline pull-right">
              </ul>
            </div>
            <!-- Application Review End here -->

            <!-- LM reporting starts here -->
            <div class="tab-pane" role="tabpanel" id="step2">
              <h5 class="bg-success p-2 text-white shadow">
                LM(A) reporting for Registration of <?= $service_name ?> (
                <span class="case-no-bg"><?= $_GET['app'] ?></span> )
              </h5>

              <div class="card anyClass">
                <div class="card-body lm-report">

                  <h5 class="bg-secondary p-2 text-white shadow mt-2">
                    LM Reporting Format
                  </h5>
                  <p class="card-text mt-3">
                    <!-- LM Reports -->
                    <?php $i = 1;
                    foreach ($settlement_ap_lmnote as $lmnote) : ?>
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Chitha verified?</label>
                    </div>
                    <div class="col-md-2">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->chitha_verified == "Yes") || ($lmnote->chitha_verified == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->chitha_verified == "No") || ($lmnote->chitha_verified == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>



                    <!-- Chitha Details -->
                    <div class="col-md-4">
                      <?php
                      foreach ($settlement_dag_area as $ddg) {
                      ?>
                        <i class="fa fa-link" aria-hidden="true"></i>
                        <button type="button" class="" onclick="getChithaCopy('<?php echo $settlement_basic['dist_code']; ?>','<?php echo $settlement_basic['subdiv_code']; ?>','<?php echo $settlement_basic['cir_code']; ?>','<?php echo $settlement_basic['mouza_pargona_code']; ?>','<?php echo $settlement_basic['lot_no']; ?>','<?php echo $settlement_basic['vill_townprt_code']; ?>','<?php echo $ddg->dag_no; ?>','<?php echo $ddg->patta_type_code; ?>')"><u><span class="text-primary" style="font-size:16px;">Dag - <?= $ddg->dag_no ?> (Chitha)</span></u></button>
                        <br>
                      <?php } ?>
                    </div>
                    <!-- Chitha Details End -->
                  </div>

                  <!-- VLB Verify -->



                  <!-- Occupation -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Schedule of the land and area under
                        occupation?</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->possession_verification == "Yes") || ($lmnote->possession_verification == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->possession_verification == "No") || ($lmnote->possession_verification == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>


                  <!-- Landed Property -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Landed property of the petitioner and
                        his family (if any) within the State</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->landed_property == "Yes") || ($lmnote->landed_property == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->landed_property == "No") || ($lmnote->landed_property == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>

                  <!-- ST Verify -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Whether the petitioner is ST</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->is_st == "Yes") || ($lmnote->is_st == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->is_st == "No") || ($lmnote->is_st == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>


                  <!-- Tribal Belt Verify -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Whether the proposed land falls under
                        Tribal Belt/ Block.</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->is_tribal_belt == "Yes") || ($lmnote->is_tribal_belt == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->is_tribal_belt == "No") || ($lmnote->is_tribal_belt == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>


                  <!-- Encroachment Free Check -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Whether proposed land is free from Encroachment</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->is_free_encroachment == "Yes") || ($lmnote->is_free_encroachment == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->is_free_encroachment == "No") || ($lmnote->is_free_encroachment == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>


                  <!-- Land Fall Under Type -->



                  <!-- GMC Verify -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Whether the proposed land falls within
                        15 KM radius from the periphery of GMC or within 5 KM periphery of other
                        town or within 3 KM periphery of Revenue town.</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->falls_und_gmc == "Yes") || ($lmnote->falls_und_gmc == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->falls_und_gmc == "No") || ($lmnote->falls_und_gmc == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>


                  <!-- Falls under Protected Class -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Does Applicant falls under Protected Category</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <strong class="text-primary">
                          <?php foreach (json_decode(PROTECTED_CLASS) as $class) {
                            if ($class->CODE == $lmnote->protected_class_lm) {
                              echo $class->NAME;
                            }
                          }
                          ?>
                        </strong>
                      </div>
                    </div>
                  </div>


                  <!-- Roadside Reservation -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong>Roadside Reservation Exist ?</label>
                    </div>
                    <div class="col-md-2">
                      <div class="form-check form-check-inline">
                        <?php if ($roadside_reservation == true) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if ($roadside_reservation == false) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>

                    <!-- Reservation area view Details -->
                    <?php if ($roadside_reservation == true) { ?>
                      <div class="col-md-4">

                        <i class="fa fa-eye" aria-hidden="true"></i>
                        <a href="#roadsideArea"><u><span class="text-primary" style="font-size:16px;">View Reserve area Details</span></u></a>
                      </div>
                    <?php } ?>
                  </div>
                  <!-- Reservation area view Details End -->

                  <!-- Family Reservation -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong>Whether applicant family has occupied any land in the lot ?</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if ($lmnote->is_landless == YES) { ?>
                          <strong class="text-primary"> Completely Landless</strong>
                        <?php } else if ($lmnote->is_landless == NO || $lmnote->is_landless == 'OTHERS') { ?>
                          <strong class="text-primary"> Landless as per policy / Having Land</strong>
                        <?php } ?>
                      </div>
                    </div>
                  </div>

                  <!-- Reserve Area Remarks -->
                  <?php if ($lmnote->roadside_reservation != NULL) : ?>
                    <div class="row p-2 px-5">
                      <div class="col-md-6">
                        <strong><?= $sl_count++ ?>.</strong> Specific comment on roadside /riverside reservation</label>
                      </div>
                      <div class="col-md-6">
                        <textarea name="lm_remark" disabled class="form-control" id="lm_remark" cols="30" rows="2" style="border:dotted 1.5px grey;"><?= $lmnote->roadside_reservation ?></textarea>
                      </div>
                    </div>
                  <?php endif; ?>


                  <!-- Landmark Details -->
                  <?php if ($landmark_data == true) : ?>
                    <div class="row p-2 px-5">
                      <?php foreach ($landmark_data as $landmark) :
                          $land_mark = json_decode($landmark->landmark);
                      ?>
                        <?php if (isset($landmark->dag)) : ?>
                          <div class="col-md-6">
                            <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong>Landmark for Dag No: <strong class="text-primary"><?= $landmark->dag_no ?></strong></label>
                          </div>
                          <div class="col-md-6">
                            <table class="table table-bordered">
                              <tr>
                                <th class="text-success"><i class="fa fa-compass" aria-hidden="true"></i> East side</th>
                                <td><?= $land_mark->east ?></td>
                                <th class="text-success"><i class="fa fa-compass" aria-hidden="true"></i> West side</th>
                                <td><?= $land_mark->west ?></td>
                              </tr>
                              <tr>
                                <th class="text-success"><i class="fa fa-compass" aria-hidden="true"></i> North side</th>
                                <td><?= $land_mark->north ?></td>
                                <th class="text-success"><i class="fa fa-compass" aria-hidden="true"></i> South side</th>
                                <td><?= $land_mark->south ?></td>
                              </tr>
                            </table>
                          </div>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </div>

                  <?php endif; ?>
                  <!-- Landmark Details-->




                  <!-- LM Remarks -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <strong><?= $sl_count++ ?>.</strong> LM Remarks</label>
                    </div>
                    <div class="col-md-6">
                      <strong class="text-primary">
                        <?php foreach (json_decode(LM_NOTE) as $lm_remark_cat) {
                          if ($lm_remark_cat->CODE == $lmnote->lm_note) {
                            echo $lm_remark_cat->NAME;
                          }
                        }
                        ?>
                      </strong>
                    </div>
                  </div>

                  <!-- LM Note Text -->
                  <?php
                      include(APPPATH . "views/SettlementView/Dept/LmNoteText.php");
                  ?>
                  <!-- LM Note Text End -->
                  <!-- lm report ends here -->
                <?php endforeach; ?>

                <!-- Premium Details -->
                <?php
                include(APPPATH . "views/SettlementView/Dept/PremiumDetailsView.php");
                ?>
                <!-- Premium Details End -->


                <!-- chitha Details -->
                <?php
                include(APPPATH . "views/SettlementView/Dept/chithaCopyView.php");
                ?>
                <!-- chitha Details End -->


                <div class="row p-2 px-5">
                  <div class="col-md-12" <h5 class="card-title"><u>LM Uploaded Documents</u></h5>
                    <p class="card-text">
                    <table class="table">
                      <?php foreach ($supportive_document as $docs) : ?>
                        <tr>
                          <th>
                            <input type="hidden" name="district_code" value="<?= $settlement_basic['dist_code']; ?>">
                            <input type="hidden" name="doc_id" value="<?= $docs->id ?>">
                            <a target='download' href="<?php echo base_url(); ?>index.php/Basundhara/viewDharitreeDocument/<?= $settlement_basic['dist_code']; ?>/<?= $docs->id ?>"><i class="fa fa-paperclip"></i> <?= $docs->file_name; ?></a>
                          </th>
                        </tr>
                      <?php endforeach; ?>
                    </table>
                    </p>

                  </div>
                </div>

                <div class="row p-2 px-5" id="roadsideArea">
                  <?php
                  include(APPPATH . "views/SettlementView/Dept/ReserveAreaView.php");
                  ?>
                </div>


                </div>
              </div>
              <ul class="list-inline pull-right">
              </ul>
            </div>
            <!-- LM reporting End here -->

            <!-- proceeding start -->
            <div class="tab-pane cls3" role="tabpanel" id="step3">
              <h5 class="bg-success p-2 text-white shadow">
                All Proceedings of <?= $service_name ?> (
                <small class="case-no-bg"><?= $_GET['app'] ?>, <?= $case_no ?></small> )
              </h5>
              <?php
              include(APPPATH . "views/SettlementView/Dept/ProceedingsDetailsView.php");
              ?>
            </div>
            <!-- proceeding end -->

            <!-- Case History start -->
            <div class="tab-pane cls4" role="tabpanel" id="step7">
              <h5 class="bg-success p-2 text-white shadow">
                Case History of <?= $service_name ?> (
                <small class="case-no-bg"><?= $_GET['app'] ?>, <?= $case_no ?></small> )
              </h5>
              <div class="card">
                <div class="card-body">
                  <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center">
                    Remark Details
                  </h5>
                  <?php
                  include(APPPATH . "views/SettlementView/Dept/CaseHistoryView.php");
                  ?>
                </div>
              </div>
            </div>
            <!-- Case History end -->

            <!-- Department Tab Start-->

            <div class="tab-pane cls3" role="tabpanel" id="step6">
              <h5 class="bg-success p-2 text-white shadow">
                Department Verification <?= $service_name ?> (
                <small class="case-no-bg"><?= $_GET['app'] ?>, <?= $case_no ?></small> )
              </h5>
              <?php
              include(APPPATH . "views/SettlementView/Dept/DepartmentView.php");
              ?>
            </div>
            <!-- Department Tab End -->

            <div class="clearfix"></div>
          </div>
        </form>
      </div>
    </section>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-9"></div>
  <div class="col-md-3">
    <a class="btn btn-secondary " id="btnPrevious"><i class="fa fa-angle-double-left" aria-hidden="true"></i> PREVIOUS</a>
    <a class="btn btn-success " id="btnNext">NEXT <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
  </div>
</div>

<!-- Department button script -->

<script src="<?php echo base_url('js/department/department.js'); ?>"></script>