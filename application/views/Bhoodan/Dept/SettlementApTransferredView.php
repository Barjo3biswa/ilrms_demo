<style>
  .case-no-bg {
    background-color: #F2C94C;
    color: black !important;
    border-radius: 25px;
    padding-left: 6px;
    padding-right: 6px;

  }
</style>
<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->
<link href="<?php echo base_url('css/department_style.css'); ?>" rel="stylesheet" />

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
                <small class="case-no-bg"><?= $_GET['app'] ?>, <?= $case_no ?></small> )
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

                  <!--AP Area Details -->
                  <h5 class="bg-secondary p-2 text-white shadow mt-2">
                    Area Details
                  </h5>
                  <p class="card-text">
                    <?php $i = 1;
                    foreach ($settlement_dag_area as $dag_details) {
                      if ($i == 1) { ?>
                  <table class="table table-bordered">
                    <tr>
                      <th>Dag Number:</th>
                      <td>
                        <strong class="alert-warning">
                          <strong><?= $dag_details->dag_no ?></strong>
                        </strong>
                      </td>

                      <th>Patta Number:</th>
                      <td>
                        <strong class="alert-warning">
                          <strong><?= $dag_details->patta_no ?></strong>
                        </strong>
                      </td>
                      <th>Patta type:</th>
                      <td>
                        <strong class="alert-warning">
                          <strong><?= $this->utilclass->getPattaType($dag_details->patta_type_code) ?></strong>

                        </strong>
                      </td>

                    </tr>

                    <tr>
                      <th class="text-success">Total Land Area in Selected Dag</th>
                      <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->dag_area_b ?></strong><span class="input-group-addon">Bigha</span>

                      </td>
                      <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->dag_area_k ?></strong><span class="input-group-addon">Katha</span>

                      </td>
                      <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->dag_area_lc ?></strong><span class="input-group-addon">Lessa</span>

                      </td>
                      <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>

                        <td>
                          <strong class="input-group-addon p-2"><?= $dag_details->dag_area_g ?></strong><span class="input-group-addon">Ganda</span>

                        </td>
                        <td>
                          <strong class="input-group-addon p-2"><?= $dag_details->dag_area_kr ?></strong><span class="input-group-addon">Kranti</span>

                        </td>
                      <?php endif; ?>
                    </tr>

                    <tr>
                      <th class="text-danger">Total applied area</th>
                      <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->s_dag_area_b ?></strong><span class="input-group-addon">Bigha</span>

                      </td>
                      <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->s_dag_area_k ?></strong><span class="input-group-addon">Katha</span>

                      </td>
                      <td>
                        <strong class="input-group-addon p-2"><?= $dag_details->s_dag_area_lc ?></strong><span class="input-group-addon">Lessa</span>

                      </td>
                      <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) : ?>

                        <td>
                          <strong class="input-group-addon p-2"><?= $dag_details->s_dag_area_g ?></strong><span class="input-group-addon">Ganda</span>
                        </td>
                        <td>
                          <strong class="input-group-addon p-2"><?= $dag_details->s_dag_area_kr ?></strong><span class="input-group-addon">Kranti</span>
                        </td>
                      <?php endif; ?>
                    </tr>
                    <?php if ($dag_details->new_dag_no != NULL) { ?>
                      <tr>
                        <th>New Dag Number After NR:</th>
                        <td>
                          <strong class="alert-warning">
                            <strong class="text-danger"><?= $dag_details->new_dag_no ?></strong>
                          </strong>
                        </td>
                      </tr>
                    <?php } ?>
                  </table>
              <?php $i++;
                      }
                    } ?>
              </p>
              <!--AP Area Details End -->
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
                <small class="case-no-bg"><?= $_GET['app'] ?>, <?= $case_no ?></small> )
              </h5>

              <div class="card anyClass">
                <div class="card-body lm-report">
                  <h5 class="bg-secondary p-2 text-white shadow mt-2">
                    LM Reporting Format
                  </h5>
                  <p class="card-text mt-3">
                    <!-- <form action="#"> -->

                    <!-- lm report -->


                    <!-- LM Reports -->
                    <?php $i = 1;
                    foreach ($settlement_ap_lmnote as $lmnote) : ?>


                  <!-- Chitha Verify -->
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



                    <!-- Bhumiputra Verify -->

                    <?php
                      include(APPPATH . "views/SettlementView/Dept/BhumiputraDetailsView.php");
                    ?>

                    <!-- Bhumiputra End -->



                    <!-- possession_verification-->
                    <div class="row p-2 px-5">
                      <div class="col-md-6">
                        <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Possession verified ?</label>
                      </div>
                      <div class="col-md-6">
                        <div class="form-check form-check-inline">
                          <?php if (trim($lmnote->possession_verification == "Yes") || trim($lmnote->possession_verification == "YES")) { ?>
                            <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                          <?php } else if (trim($lmnote->possession_verification == "No") || trim($lmnote->possession_verification == "NO")) { ?>
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
                          <?php if (trim($lmnote->is_tribal_belt == "Yes") || trim($lmnote->is_tribal_belt == "YES")) { ?>
                            <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                          <?php } else if (trim($lmnote->is_tribal_belt == "No") || trim($lmnote->is_tribal_belt == "NO")) { ?>
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

                    <!-- Landslide Prone -->
                    <div class="row p-2 px-5">
                      <div class="col-md-6">
                        <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Is Area Under cover landslide prone</label>
                      </div>
                      <div class="col-md-6">
                        <div class="form-check form-check-inline">
                          <?php if (trim($lmnote->landslide == "Yes") || trim($lmnote->landslide == "YES")) { ?>
                            <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                          <?php } else if (trim($lmnote->landslide == "No") || trim($lmnote->landslide == "NO")) { ?>
                            <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                          <?php } ?>
                        </div>
                      </div>
                    </div>


                    <!-- Erosion effected -->
                    <div class="row p-2 px-5">
                      <div class="col-md-6">
                        <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Whether the land falls under erosion?</label>
                      </div>
                      <div class="col-md-6">
                        <div class="form-check form-check-inline">
                          <?php if (trim($lmnote->erosion == "Yes") || trim($lmnote->erosion == "YES")) { ?>
                            <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                          <?php } else if (trim($lmnote->erosion == "No") || trim($lmnote->erosion == "NO")) { ?>
                            <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                          <?php } ?>
                        </div>
                      </div>
                    </div>



                    <!-- Nature of Possession  -->
                    <div class="row p-2 px-5">
                      <div class="col-md-6">
                        <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Nature of possession –</label>
                      </div>
                      <div class="form-group col-md-6">
                        <div class="form-check form-check-inline">
                          <strong class="text-primary"><?= $lmnote->nature_possession ?></strong>
                        </div>
                      </div>
                    </div>


                    <!-- Landless Verify -->
                    <div class="row p-2 px-5">
                      <div class="col-md-6">
                        <label for="formGroupE
                        xampleInput"><strong><?= $sl_count++ ?>.</strong>Whether applicant family has occupied any land in the lot ?</label>
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


                    <!-- Land Falls Under Type -->

                    <div class="row p-2 px-5">
                      <div class="col-md-6">
                        <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Category of the proposed Land</label>
                      </div>
                      <div class="col-md-6">
                        <div class="form-check form-check-inline">
                          <strong class="text-primary">
                            <?php foreach (json_decode(LB_NATURE_OF_RESERVATION) as $landCode) {
                              if ($landCode->CODE == $lmnote->land_falls) {
                                echo $landCode->NAME;
                              }
                            }
                            ?>
                          </strong>
                        </div>
                      </div>
                    </div>


                    <!-- Eksona Type -->
                    <?php if (!empty($lmnote->eksona_type)) { ?>
                      <div class="row p-2 px-5">
                        <div class="col-md-6">
                          <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Whether applied land falls under Eksona /Gramdan /Bhudan?</label>
                        </div>
                        <div class="col-md-6">
                          <div class="form-check form-check-inline">
                            <strong class="text-primary">
                              <?php foreach (json_decode(GRAMDAN_BHUDAN) as $landGb) {
                                if ($landGb->CODE == $lmnote->eksona_type) {
                                  echo $landGb->NAME;
                                }
                              }
                              ?>
                            </strong>
                          </div>
                        </div>
                      </div>
                    <?php } ?>


                    <!-- Eksona Transfer -->
                    <?php if (!empty($lmnote->eksona_transfered)) { ?>
                      <div class="row p-2 px-5">
                        <div class="col-md-6">
                          <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Is Eksona Land Transferred ?</label>
                        </div>
                        <div class="col-md-6">
                          <div class="form-check form-check-inline">
                            <strong class="text-primary">
                              <?php foreach (json_decode(EKSONA_TRANSFERRED) as $landEt) {
                                if ($landEt->CODE == $lmnote->eksona_transfered) {
                                  echo $landEt->NAME;
                                }
                              }
                              ?>
                            </strong>
                          </div>
                        </div>
                      </div>
                    <?php } ?>


                    <!-- GMC Verify -->
                    <div class="row p-2 px-5">
                      <div class="col-md-6">
                        <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Whether the proposed land falls within
                          15 KM radius from the periphery of GMC or within 5 KM periphery of other
                          town or within 3 KM periphery of Revenue town.</label>
                      </div>
                      <div class="col-md-6">
                        <div class="form-check form-check-inline">
                          <?php if (trim($lmnote->falls_und_gmc == "Yes") || trim($lmnote->falls_und_gmc == "YES")) { ?>
                            <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                          <?php } else if (trim($lmnote->falls_und_gmc == "No") || trim($lmnote->falls_und_gmc == "NO")) { ?>
                            <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                          <?php } ?>
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


                    <!-- Reserve Area Remarks -->
                    <?php if ($lmnote->roadside_reservation != NULL) : ?>
                      <div class="row p-2 px-5">
                        <div class="col-md-6">
                          <strong><?= $sl_count++ ?>.</strong> Specific comment on roadside /riverside reservation</label>
                        </div>
                        <div class="col-md-6">
                          <textarea name="lm_remark" disabled class="form-control" id="lm_remark" cols="30" rows="2"><?= $lmnote->roadside_reservation ?></textarea>
                        </div>
                      </div>
                    <?php endif; ?>


                    <!-- Family Reservation -->
                    <div class="row p-2 px-5">
                      <div class="col-md-6">
                        <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong>Whether applicant family has occupied any land in the lot ?</label>
                      </div>
                      <div class="col-md-6">
                        <div class="form-check form-check-inline">
                          <?php if ($family_reservation == true) { ?>
                            <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                          <?php } else if ($family_reservation == false) { ?>
                            <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                          <?php } ?>
                        </div>
                      </div>
                    </div>


                    <!-- Landmark Details -->
                    <div class="row p-2 px-5">
                      <?php foreach ($landmark_data as $landmark) :
                        $land_mark = json_decode($landmark->landmark);
                      ?>
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
                      <?php endforeach; ?>
                    </div>

                    <!-- Landmark Details end-->


                    <!-- NR Settlement  -->
                    <div class="row p-2 px-5">
                      <div class="col-md-6">
                        <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Whether appliacnt eligible for NR or NR with Settlement ?</label>
                      </div>
                      <div class="form-group col-md-6">
                        <span><?= $lmnote->is_nr_settlement ?></span>
                      </div>
                    </div>

                    <div class="row p-2 px-5">
                    </div>
                  </div>

                  <!-- Reserve Are Remarks -->
                  <?php if ($lmnote->roadside_reservation != NULL) : ?>
                    <div class="row p-2 px-5">
                      <div class="col-md-6">
                        <strong><?= $sl_count++ ?>.</strong> Reserved area remarks</label>
                      </div>
                      <div class="col-md-6">
                        <textarea name="lm_remark" disabled class="form-control" id="lm_remark" cols="30" rows="2"><?= $lmnote->roadside_reservation ?></textarea>
                      </div>
                    </div>
                  <?php endif; ?>


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

                  <!-- LM NR Note -->
                  <div class="row p-2 px-5">
                    <div class="col-md-3">
                      <strong><?= $sl_count++ ?>.</strong> NR Note</label>
                    </div>
                    <div class="col-md-9">
                      <textarea name="lm_remark" disabled class="form-control" id="lm_remark" cols="30" rows="6" style="font-size: 0.9rem; border:dotted 1.5px grey;"><?= $lmnote->lm_remark_additional ?></textarea>
                    </div>
                  </div>

                  <!-- LM Settlement Note -->
                  <div class="row p-2 px-5">
                    <div class="col-md-3">
                      <strong><?= $sl_count++ ?>.</strong> Settlement Note</label>
                    </div>
                  </div>

                  <!-- LM Note Text -->
                  <?php
                      include(APPPATH . "views/SettlementView/Dept/LmNoteText.php");
                  ?>
                  <!-- LM Note Text End -->


                <?php endforeach; ?>

                <!-- lm report ends here -->

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
                  <div class="col-md-12" <h5 class="card-title"><u>Uploaded Documents</u></h5>
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

                    <div class="row p-2 px-5" id="roadsideArea">
                      <?php
                      include(APPPATH . "views/SettlementView/Dept/ReserveAreaView.php");
                      ?>
                    </div>

                  </div>
                </div>

                </div>
              </div>
              <ul class="list-inline pull-right">
              </ul>
            </div>
            <!-- LM reporting End here -->

            <!-- proceeding start -->
            <div class="tab-pane" role="tabpanel" id="step3">
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
            <div class="tab-pane" role="tabpanel" id="step7">
              <h5 class="bg-success p-2 text-white shadow">
                Case History of <?= $service_name ?> (
                <small class="case-no-bg"><?= $_GET['app'] ?>, <?= $case_no ?></small> )
              </h5>
              <div class="card">
                <div class="card-body">
                  <h5 class="bg-secondary p-2 text-white shadow mt-2">
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