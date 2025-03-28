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
<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->
<link href="<?php echo base_url('css/department_style.css'); ?>" rel="stylesheet" />

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

                  <!-- Board Details -->
                  <h5 class="bg-secondary p-2 text-white shadow mt-2">
                    Cultivation Board Details
                  </h5>

                  <p class="card-text">
                  <table class="table table-bordered">
                    <tr>
                      <th>Board Name</th>
                      <td>
                        <strong><?= $settlement_basic['cult_board']; ?></strong>
                      </td>
                    </tr>

                    <tr>
                      <th>Board Regn. No</th>
                      <td>
                        <strong><?= $settlement_basic['cultboard_reg_no']; ?></strong>
                      </td>
                    </tr>
                  </table>
                  </p>
                  <!-- Board Details End -->

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
                LM(A) Reporting for <?= $service_name ?> (
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

                  <!-- VLB Verify -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> VLB Verified?</label>
                    </div>
                    <div class="col-md-2">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->vlb_verified == "Yes") || ($lmnote->vlb_verified == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->vlb_verified == "No") || ($lmnote->vlb_verified == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>

                    <!-- VLB Details -->
                    <div class="col-md-4">
                      <?php
                      foreach ($settlement_dag_area as $ddg) {
                      ?>
                        <i class="fa fa-link" aria-hidden="true"></i>
                        <a target='VlbReport' href="<?php echo base_url() . 'index.php/Basundhara/vlbEncroacherDetails?dag=' . $ddg->dag_no . '&m=' . $settlement_basic["mouza_pargona_code"] . '&l=' . $settlement_basic["lot_no"] . '&v=' . $settlement_basic["vill_townprt_code"] . '&dist=' . $settlement_basic["dist_code"] . '&cir=' . $settlement_basic["cir_code"] . '&sub_div=' . $settlement_basic["subdiv_code"] ?>" target="VlbReport">
                          <u><span class="text-primary" style="font-size:16px;">Dag - <?= $ddg->dag_no ?> (VLB)</span></u></a>
                        <br>
                      <?php } ?>
                    </div>
                    <!-- VLB Details End -->
                  </div>


                  <!-- Bhumiputra Verify -->

                  <?php
                      include(APPPATH . "views/SettlementView/Dept/BhumiputraDetailsView.php");
                  ?>

                  <!-- Bhumiputra End -->


                  <!-- Enc Exist VLB -->
                  <?php
                            foreach($applicants_encroacher as $enc_exis_vlb)
                            {
                                ?>
                                <div class="row p-2 <?php if($enc_exis_vlb->encroacher_exist_vlb == 4){ echo "alert-danger"; }?>">
                                    <div class="col-md-6">
                                        <span><strong><?=$sl_count++?>.</strong> Is Encroacher Exists in VLB for Dag no <strong class="text-danger"> <?=$enc_exis_vlb->dag_no?></strong></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <select name="encroacher_exist_vlb" id="encroacher_exist_vlb" class="form-control" disabled>
                                            <?php
                                                foreach(json_decode(ENC_VARIFICATION_LIST) as $enc_list)
                                                {
                                                    ?>
                                                    <option value="<?=$enc_list->CODE?>" <?php if($enc_list->CODE == $enc_exis_vlb->encroacher_exist_vlb){echo 'selected';}?>>
                                                        <?=$enc_list->NAME?>
                                                    </option>
                                                      
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php   
                            } 
                        ?>
                  <!-- Enc Exist VLB -->

                  <!-- Tribal Belt -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Wheather the Proposed Land falls under Triibal Belt/Block
                        occupation?</label>
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


                  <!-- Falls under Protected Class -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Does Applicant falls under Protected Category</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <strong class="text-primary"><?php
                                                      foreach (json_decode(PROTECTED_CLASS) as $class) {
                                                        if ($class->CODE == $lmnote->protected_class_lm) {
                                                          echo $class->NAME;
                                                        }
                                                      }
                                                      ?>
                        </strong>
                      </div>
                    </div>
                  </div>

                  <!-- possession_verification-->

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

                  <!-- Landslide Prone -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Is Area Under cover landslide prone ?</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->landslide == "Yes") || ($lmnote->landslide == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->landslide == "No") || ($lmnote->landslide == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>

                  <!-- Land Under Erosion -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Whether the land falls under erosion?</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->erosion  == "Yes") || ($lmnote->erosion  == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->erosion  == "No") || ($lmnote->erosion  == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>


                  <!-- Land Under Litigation -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Whether proposed land is under litigation ?</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->litigation   == "Yes") || ($lmnote->litigation   == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->litigation   == "No") || ($lmnote->litigation   == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>

                  <!-- Nature of Possession -->
                  <?php  foreach($possession_data as $possession) { ?>
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Nature of possession for Dag No <strong class="text-danger"> <?=$possession->dag_no?></strong></label>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="form-check form-check-inline">
                        <strong class="text-primary"><?= $possession->nature_possession ?></strong>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <!-- Nature of Possession  -->



                  <!-- Landless Verify -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Whether application is landless</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->is_landless == "Yes") || ($lmnote->is_landless == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->is_landless == "No") || ($lmnote->is_landless == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>



                  <!-- Landed Property Verify -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Landed property of the petitioner and his family (if any) within the State</label>
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


                  <!-- Special cultivation Livelihood verify -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Is Applicant undertake special cultivation of tea as a means of livelihood</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->livelihood == "Yes") || ($lmnote->livelihood == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->livelihood == "No") || ($lmnote->livelihood == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>


                  <!-- Suitabilty of Land Verify -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Suitability of proposed land for tea cultivation</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->suitability == "Yes") || ($lmnote->suitability == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->suitability == "No") || ($lmnote->suitability == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>



                  <!-- Patta Land Verify -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong>Patta land of applicant’s family. This will be deducted from the total admissible area</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->admissible_area == "Yes") || ($lmnote->admissible_area == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->admissible_area == "No") || ($lmnote->admissible_area == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>



                  <!-- Govt Land Alotee Verification -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong>Weather the applicant has been allotted govt land before</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->govt_allotted == "Yes") || ($lmnote->govt_allotted == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->govt_allotted == "No") || ($lmnote->govt_allotted == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>



                  <!-- Differencialy abled/SC/ST/OBC verify  -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong>Whether the petitioner is differently abled/SC/ST/OBC/Ex-serviceman/Widow/others</label>
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

                  <!-- Is Indigenius Verify  -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong>whether the applicant is indigenous unemployed educated youth</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->is_indigenous == "Yes") || ($lmnote->is_indigenous == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->is_indigenous == "No") || ($lmnote->is_indigenous == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>


                  <!-- Tea Board Verify  -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong>Whether registered with Tea Board of India/Directorate of Tea, Assam</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->is_reg_with_teaboard == "Yes") || ($lmnote->is_reg_with_teaboard == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->is_reg_with_teaboard == "No") || ($lmnote->is_reg_with_teaboard == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
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


                  <!-- GMC Verify -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong>Whether the proposed land falls within
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


                  <!-- Roadside Reservation -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong>Roadside Reservation Exist ?</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if ($roadside_reservation == true) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if ($roadside_reservation == false) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
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
                        <?php foreach($landmark_data as $landmark):
                            $land_mark = json_decode($landmark->landmark);
                                ?>
                                <div class="row p-2">
                                        <div class="col-md-6">
                                                <strong><?=$sl_count++?>.</strong> Landmark <span class="alert-warning"><strong>for Dag No. <?=$landmark->dag_no?></strong></span>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-bordered">
                                              <tr>
                                                <th class="text-danger"><i class="fa fa-compass" aria-hidden="true"></i> East side</th>
                                                <td><?= $land_mark->east ?></td>
                                                <th class="text-danger"><i class="fa fa-compass" aria-hidden="true"></i> West side</th>
                                                <td><?= $land_mark->west ?></td>
                                              </tr>
                                              <tr>
                                                <th class="text-danger"><i class="fa fa-compass" aria-hidden="true"></i> North side</th>
                                                <td><?= $land_mark->north ?></td>
                                                <th class="text-danger"><i class="fa fa-compass" aria-hidden="true"></i> South side</th>
                                                <td><?= $land_mark->south ?></td>
                                              </tr>
                                          </table>
                                        </div>
                                </div>
                        <?php endforeach;?>
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
                  <!-- LM Note -->

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
                    <?php
                    include(APPPATH . "views/SettlementView/Dept/ReserveAreaView.php");
                    ?>
                  </div>
                </div>
                </div>
              </div>


              <ul class="list-inline pull-right">
                <!-- <li>
                  <button type="button" class="btn btn-warning prev-step">
                    Previous
                  </button>
                </li>
                <li>
                  <button type="button" class="btn btn-primary next-step">
                    Next
                  </button>
                </li> -->
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