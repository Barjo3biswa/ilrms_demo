<!-- Sweet Alert Link -->
<link href="<?php echo base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('js/sweetalert2.all.min.js'); ?>"></script>
<!-- Sweetalert Link End -->
<style>
  .wizard {
    margin: 10px auto;
  }


  .wizard .nav-tabs {
    position: relative;
    margin: 0px auto;
    margin-bottom: 0;
    border-bottom-color: #12a268;
  }

  .wizard>div.wizard-inner {
    position: relative;
  }

  .p-2 {
    padding: 0.8rem !important;
  }

  .wizard .nav-tabs>li.active>a,
  .wizard .nav-tabs>li.active>a:hover,
  .wizard .nav-tabs>li.active>a:focus {
    color: #12a268;
    cursor: default;
    border: 0;
    background-color: #005B96 !important;
    text-decoration: none;
  }

  .bg-header {
    color: #30336b;
    background-color: #005B96 !important;

  }

  .wizard li.active {
    background: #005B96;
    padding: 10px;
    box-shadow: 1px 0px 1px 1px;
    align-items: center;
    align-content: center;

  }

  .wizard .nav-tabs>li {
    width: 25%;
    border: none;
    align-items: center;
    align-content: center;
    margin: 0 auto;
    text-align: center;
    padding-top: 10px;

  }

  .wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
  }

  .wizard li.active:after {
    content: " ";
    position: absolute;
    left: 45%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #ffffff;
  }

  .wizard .nav-tabs>li a {
    text-align: center;
    /* width: 90%; */
    margin-bottom: 10px;
    /* padding: 0; */
  }

  .wizard .nav-tabs>li a:hover {
    background-color: #12a268;
  }


  /* div alternate color */
  div.lm-report>div:nth-of-type(odd) {
    background: #f2fdff;
  }

  div.f-party-alternate>div:nth-of-type(odd) {
    background: #f2fdff;
  }

  button,
  input {
    font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
  }



  .nav-tabs {
    border: 0;
    padding: 15px 0.7rem;
  }

  .nav-tabs:not(.nav-tabs-neutral)>.nav-item>.nav-link.active {
    box-shadow: 0px 5px 35px 0px rgba(0, 0, 0, 0.3);
  }

  .card .nav-tabs {
    border-top-right-radius: 0.1875rem;
    border-top-left-radius: 0.1875rem;
  }

  .nav-tabs>.nav-item>.nav-link {
    color: #888888;
    margin: 0;
    margin-right: 5px;
    background-color: transparent;
    border: 1px solid transparent;
    border-radius: 30px;
    font-size: 16px;
    /* font-weight: bold; */
    font-family: Arial, Helvetica, sans-serif;
    padding: 12px 23px;
    line-height: 1.5;
  }

  .nav-tabs>.nav-item>.nav-link:hover {
    background-color: transparent;
  }

  .nav-tabs>.nav-item>.nav-link.active {
    background-color: #12a268;
    border-radius: 30px;
    color: #FFFFFF;
  }

  .nav-tabs>.nav-item>.nav-link i.now-ui-icons {
    font-size: 14px;
    position: relative;
    top: 1px;
    margin-right: 3px;
  }

  .nav-tabs.nav-tabs-neutral>.nav-item>.nav-link {
    color: #FFFFFF;
  }

  .nav-tabs.nav-tabs-neutral>.nav-item>.nav-link.active {
    background-color: rgba(255, 255, 255, 0.2);
    color: #FFFFFF;
  }

  .now-ui-icons {
    display: inline-block;
    font: normal normal normal 14px/1 'Nucleo Outline';
    font-size: inherit;
    speak: none;
    text-transform: none;
    /* Better Font Rendering */
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  /* .anyClass {
    height: 600px;
    overflow-y: scroll;
  } */
</style>
<script>
  $(document).ready(function() {
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
      localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
      $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
  });

  // button navigaion
  $('.btnNext').click(function() {
    $('.nav-tabs > .active').next('li').find('a').trigger('click');
  });

  $('.btnPrevious').click(function() {
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
  });
</script>

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
              <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" href="#step2" role="tab">Lot Mondol Report&nbsp;&nbsp;<i class="fa fa-user" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" href="#step3" role="tab">Proceedings &nbsp;&nbsp;<i class="fa fa-tasks" aria-hidden="true"></i></a>
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
                <small class="bg-warning"><?= $_GET['app'] ?>, <?= $case_no ?></small> )
              </h5>
              <div class="card anyClass">
                <div class="card-body">
                  <h5 class="bg-secondary p-2 text-white shadow mt-2">
                    Address Information
                  </h5>
                  <p class="card-text">
                  <table class="table table-bordered">
                    <tr>
                      <th>District Name:</th>
                      <td class="text-warning">
                        <strong class="alert-warning">
                          <p><?= $this->utilclass->getDistrictName($settlement_basic['dist_code']) ?></p>
                        </strong>
                      </td>
                      <th>Subdivision Name:</th>
                      <td class="text-warning">
                        <strong class="alert-warning">
                          <p><?= $this->utilclass->getSubDivName($settlement_basic['dist_code'], $settlement_basic['subdiv_code']) ?></p>
                        </strong>
                      </td>
                    </tr>
                    <tr>
                      <th>Circle Name: </th>
                      <td class="text-warning">
                        <strong class="alert-warning">
                          <p><?= $this->utilclass->getCircleName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code']) ?></p>
                        </strong>
                      </td>
                      <th>Mouza Name: </th>
                      <td class="text-warning">
                        <strong class="alert-warning">
                          <p><?= $this->utilclass->getMouzaName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code']) ?></p>
                        </strong>
                      </td>
                    </tr>
                    <tr>
                      <th>Village Name: </th>
                      <td class="text-warning">
                        <strong class="alert-warning">
                          <p><?= $this->utilclass->getVillageName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code'], $settlement_basic['lot_no'], $settlement_basic['vill_townprt_code']) ?></p>

                        </strong>
                      </td>
                    </tr>
                  </table>
                  </p>
                  <table class="table table-bordered">
                    <h5 class="bg-secondary p-2 text-white shadow mt-2">
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

                    <!-- Applicant Details -->
                    <h5 class="bg-secondary p-2 text-white shadow mt-2">
                      Applicant details
                    </h5>
                    <p class="card-text" style="margin:0 auto;">
                      <?php $i = 1;
                      foreach ($applicants_buyers as $settlement) : ?>
                    <table class="table">
                      <tr>
                        <th rowspan="5" style="vertical-align : middle;text-align:center;">#<?= $i; ?></th>
                        <th>Name</th>
                        <td>
                          <strong class="alert-warning">
                            <?= $settlement->pdar_name; ?>
                          </strong>
                        </td>
                        <th>Guardian name</th>
                        <td>
                          <strong class="alert-warning">
                            <?= $settlement->pdar_guardian; ?>
                          </strong>
                        </td>
                      </tr>

                      <tr>

                        <th>Relation</th>
                        <td>
                          <strong class="alert-warning">
                            <?php
                            if ($settlement->pdar_rel_guar == "1") {
                              echo "Mother";
                            }
                            if ($settlement->pdar_rel_guar == "2") {
                              echo "Father";
                            }
                            if ($settlement->pdar_rel_guar == "3") {
                              echo "Husband";
                            }
                            if ($settlement->pdar_rel_guar == "4") {
                              echo "Wife";
                            }
                            if ($settlement->pdar_rel_guar == "5") {
                              echo "Guardian";
                            }
                            if ($settlement->pdar_rel_guar == "6") {
                              echo "Supdt.Mother";
                            }
                            ?>
                          </strong>
                        </td>
                        <th>Gender</th>
                        <td>
                          <strong class="alert-warning">
                            <?php
                            if ($settlement->pdar_gender == "1") {
                              echo "Male";
                            }
                            if ($settlement->pdar_gender == "2") {
                              echo "Female";
                            }
                            if ($settlement->pdar_gender == "3") {
                              echo "Others";
                            }
                            ?>
                          </strong>
                        </td>

                      </tr>
                      <tr>
                        <th>Mobile</th>
                        <td>
                          <strong class="alert-warning">
                            <?= $settlement->pdar_mobile ?>
                          </strong>
                        </td>
                        <th>
                          Permanent address
                        </th>
                        <td>
                          <strong class="alert-warning">
                            <?= $settlement->pdar_add1 ?>
                          </strong>
                        </td>
                      </tr>
                      <tr>
                        <th>Present address</th>
                        <td>
                          <strong class="alert-warning">
                            <?= $settlement->pdar_add2 ?>
                          </strong>
                        </td>
                      </tr>
                    </table>
                    <?php $i++; ?>
                  <?php endforeach; ?>
                  </p>
                  <!-- Applicant Details End -->


                  <!-- Owner Details -->
                  <h5 class="bg-secondary p-2 text-white shadow mt-2">
                    Owner details
                  </h5>
                  <p class="card-text" style="margin:0 auto;">
                    <?php $i = 1;
                    foreach ($applicants_buyers as $owners) : ?>
                  <table class="table">
                    <tr>
                      <th rowspan="5">#<?= $i; ?></th>
                      <th>Name</th>
                      <td>
                        <strong class="alert-warning">
                          <?= $settlement->pdar_name; ?>
                        </strong>
                      </td>
                      <th>Guardian name</th>
                      <td>
                        <strong class="alert-warning">
                          <?= $settlement->pdar_guardian; ?>
                        </strong>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        In place/Along with
                      </th>
                      <td>
                        <strong class="alert-warning">
                          <?php
                          if ($owners->inplace_alongwith == 'i') {
                            echo "In Place";
                          }
                          if ($owners->inplace_alongwith == 'a') {
                            echo "Along with";
                          }
                          ?>
                        </strong>
                      </td>
                    </tr>
                  </table>
                  <?php $i++; ?>
                <?php endforeach; ?>
                </p>
                <!-- Owner Details End -->

                <!-- Riotee Details -->
                <h5 class="bg-secondary p-2 text-white shadow mt-2">
                  Riotee details
                </h5>
                <p class="card-text" style="margin:0 auto;">
                  <?php
                  $sl = 1;
                  foreach ($applicants_encroacher as $riotee) {
                  ?>
                <table class="table">
                  <tr>
                    <th rowspan="5">#<?= $sl++; ?></th>
                    <th>Khatian Number</th>
                    <td>
                      <strong class="alert-warning">
                        <?= $riotee->khatian_no; ?>
                      </strong>
                    </td>
                  </tr>
                  <tr>
                    <th>Name</th>
                    <td>
                      <strong class="alert-warning">
                        <?= $riotee->pdar_name; ?>
                      </strong>
                    </td>
                  </tr>
                  <tr>
                    <th>Father's name</th>
                    <td>
                      <strong class="alert-warning">
                        <?= $riotee->pdar_guardian; ?>
                      </strong>
                    </td>
                  </tr>
                </table>
              <?php
                  }
              ?>
              </p>
              <?php
              if ($applicants_riotee_nok == true) {
              ?>
                <h5 class="card-title text-primary mt-5 mb-0"><span class="alert-danger">Riotee's NOK(This would be added to the Riotee khatian)</span></h5>
                <table class="table" style="margin:0 auto;">
                  <?php
                  $sl = 1;
                  foreach ($applicants_riotee_nok as $riotee_nok) {
                  ?>
                    <tr>
                      <th rowspan="4" width="15%" style="vertical-align : middle;text-align:center;">#<?= $sl++; ?></th>
                      <th width="40%">Khatian Number</th>
                      <td>
                        <strong class="alert-warning">
                          <?= $riotee->khatian_no; ?>
                        </strong>
                      </td>
                    </tr>
                    <tr>
                      <th>Name</th>
                      <td>
                        <strong class="alert-warning">
                          <?= $riotee_nok->pdar_name; ?>
                        </strong>
                      </td>
                    </tr>
                    <tr>
                      <th>Father's name</th>
                      <td>
                        <strong class="alert-warning">
                          <?= $riotee_nok->pdar_guardian; ?>
                        </strong>
                      </td>
                    </tr>
                    <tr>
                      <th>Relationship with Riotee</th>
                      <td>
                        <strong class="alert-warning">
                          <?php
                          if ($riotee_nok->pdar_type == 'GP') {
                            echo "Grand Son/ Daughter";
                          } elseif ($riotee_nok->pdar_type == 'GGP') {
                            echo "Great Grand Son";
                          }
                          ?>
                        </strong>
                      </td>
                    </tr>

                  <?php
                  }
                  ?>
                </table>
              <?php
              }
              ?>
              <!-- Riotee Details End -->

              <h5 class="bg-secondary p-2 text-white shadow mt-2">
                Application Details
              </h5>
              <p class="card-text">
              <table class="table table-bordered">
                <tr>
                  <th>Aadhaar Verified</th>
                  <td>
                    <strong><?php if ($aadhar['is_aadhaar_verify'] == '1') {
                              echo 'Yes';
                            } ?></strong>
                  </td>
                </tr>
                <tr>
                  <th>Period of Possession</th>
                  <td>
                    <strong><?= $settlement_basic['period_possession']; ?></strong>

                  </td>
                </tr>
                <tr>
                  <th>Occupation or Profession of the applicant</th>
                  <td>
                    <strong><?= $settlement_basic['occupation_applicant']; ?></strong>

                  </td>
                </tr>
              </table>
              </p>
              <h5 class="bg-secondary p-2 text-white shadow mt-2">
                Area Details
              </h5>
              <p class="card-text">
              <table class="table table-bordered">

                <tr>
                  <th>Dag Number:</th>
                  <td>
                    <strong class="alert-warning">
                      <strong><?= $settlement_dag_details['dag_no'] ?></strong>
                    </strong>
                  </td>

                  <th>Patta Number:</th>
                  <td>
                    <strong class="alert-warning">
                      <strong><?= $settlement_dag_details['patta_no'] ?></strong>
                    </strong>
                  </td>
                  <th>Patta type:</th>
                  <td>
                    <strong class="alert-warning">
                      <strong><?= $this->utilclass->getPattaType($settlement_dag_details['patta_type_code']) ?></strong>

                    </strong>
                  </td>

                </tr>

                <tr>
                  <th>Total Land Area in Selected Dag</th>
                  <td>
                    <strong class="input-group-addon p-2"><?= $settlement_dag_details['dag_area_b'] ?></strong><span class="input-group-addon">Bigha</span>
                  </td>
                  <td>
                    <strong class="input-group-addon p-2"><?= $settlement_dag_details['dag_area_k'] ?></strong><span class="input-group-addon">Katha</span>
                  </td>
                  <td>
                    <strong class="input-group-addon p-2"><?= $settlement_dag_details['dag_area_lc'] ?></strong><span class="input-group-addon">Lessa</span>
                  </td>
                  <?php if ((in_array($this->session->userdata("dist_code"), json_decode(BARAK_VALLEY)))) : ?>
                    <td>
                      <strong class="input-group-addon p-2"><?= $settlement_dag_details['dag_area_g'] ?></strong><span class="input-group-addon">Ganda</span>
                    </td>
                    <td>
                      <strong class="input-group-addon p-2"><?= $settlement_dag_details['dag_area_kr'] ?></strong><span class="input-group-addon">Kranti</span>
                    </td>
                  <?php endif; ?>
                </tr>

                <tr>
                  <th>Total applied area</th>
                  <td>
                    <strong class="input-group-addon p-2"><?= $settlement_dag_details['s_dag_area_b'] ?></strong><span class="input-group-addon">Bigha</span>

                  </td>
                  <td>
                    <strong class="input-group-addon p-2"><?= $settlement_dag_details['s_dag_area_kr'] ?></strong><span class="input-group-addon">Katha</span>

                  </td>
                  <td>
                    <strong class="input-group-addon p-2"><?= $settlement_dag_details['s_dag_area_lc'] ?></strong><span class="input-group-addon">Lessa</span>

                  </td>
                  <?php if ((in_array($this->session->userdata("dist_code"), json_decode(BARAK_VALLEY)))) : ?>
                    <td>
                      <span class="input-group-addon">Ganda</span>
                      <input type="text" style="text-align: center;" value="<?= $settlement_dag_details["s_dag_area_g"] ?>" class="form-control input-sm s_dag_area_g" name="s_dag_area_g">
                    </td>
                    <td>
                      <span class="input-group-addon">Kranti</span>
                      <input type="text" style="text-align: center;" value="<?= $settlement_dag_details["s_dag_area_kr"] ?>" class="form-control input-sm s_dag_area_kr" name="s_dag_area_kr">
                    </td>
                  <?php endif; ?>
                </tr>

              </table>
              </p>
              <h5 class="bg-secondary p-2 text-white shadow mt-2">
                Next Of Kin Details
              </h5>
              <p class="card-text">
              <table class="table">
                <tr class="bg-success">
                  <th>Next of KIN name</th>
                  <th>Relation with KIN</th>
                  <th>Address of KIN</th>
                  <th>Mobile number</th>
                </tr>
                <?php $i = 1;
                foreach ($nextKin as $kin) : ?>
                  <tr>
                    <td>
                      <span><?= $kin->next_of_kin_name ?></span>
                    </td>
                    <td>
                      <span><?= $this->utilclass->getGuardianRelation($kin->relation_with_kin) ?></span>
                    </td>
                    <td>
                      <span><?= $kin->address ?></span>
                    </td>
                    <td>
                      <span><?= $kin->mobile_no ?></span>
                    </td>
                  </tr>
                  <?php $i++; ?>
                <?php endforeach; ?>
              </table>
              </p>
              <h5 class="bg-secondary p-2 text-white shadow mt-2">
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

                </div>
              </div>

              <ul class="list-inline pull-right">
              </ul>
              <!-- <a class="btn btn-warning btn-sm pull-right btnNext">Go to LM Report <i class="fa fa-arrow-right"></i></a> -->
            </div>
            <!-- <a href="#lm_report" onclick="lm()" class="btn btn-primary text-white">Go to LM report</a> -->

            <!-- Application Review End here -->

            <!-- LM reporting starts here -->
            <div class="tab-pane" role="tabpanel" id="step2">
              <h5 class="bg-success p-2 text-white shadow">
                LM(A) Reporting for <?= $service_name ?> (
                <small class="bg-warning"><?= $_GET['app'] ?>, <?= $case_no ?></small> )
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
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Chitha verified?</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->chitha_verified == "Yes") || ($lmnote->chitha_verified == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->chitha_verified == "No") || ($lmnote->chitha_verified == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>

                  <!-- RK Verify -->
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> RK Verified?</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->rk_verified == "Yes") || ($lmnote->rk_verified == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Already Exist</span>
                        <?php } else if (($lmnote->rk_verified == "No") || ($lmnote->rk_verified == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> To Be Added</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>

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
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Possession of the land out of the total area present in that Dag, found during field visit</label>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="row">
                        <div class="col-4">
                          <label for="inputEmail4">Total Bigha</label>
                        </div>
                        <div class="col-8">
                          <input class="form-control" type="text" name="total_bigha" id="total_bigha" value="<?= $lmnote->total_bigha ?>" readonly />
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-4">
                          <label for="inputEmail4">Total Katha</label>
                        </div>
                        <div class="col-8">
                          <input type="text" name="total_Katha" class="form-control" id="total_katha" value="<?= $lmnote->total_Katha ?>" readonly />
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-4">
                          <label for="inputEmail4">Total Lessa</label>
                        </div>
                        <div class="col-8">
                          <input type="text" name="total_lessa" class="form-control" id="total_lessa" value="<?= $lmnote->total_lessa ?>" readonly />
                        </div>
                      </div>
                      <?php if ((in_array($this->session->userdata("dist_code"), json_decode(BARAK_VALLEY)))) : ?>
                        <div class="row mt-2">
                          <div class="col-4">
                            <label for="inputEmail4">Total Ganda</label>
                          </div>
                          <div class="col-8">
                            <input type="text" name="total_ganda" class="form-control" id="total_ganda" value="<?= $lmnote->total_ganda ?>" readonly />
                          </div>
                        </div>

                        <div class="row mt-2">
                          <div class="col-4">
                            <label for="inputEmail4">Total Kranti</label>
                          </div>
                          <div class="col-8">
                            <input type="text" name="total_kranti" class="form-control" id="total_kranti" value="<?= $lmnote->total_kranti ?>" readonly />
                          </div>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Period of possession</label>
                    </div>
                    <div class="form-group col-md-6">
                      <div class="row">
                        <div class="col-4">
                          <label for="inputEmail4">From Date</label>
                        </div>
                        <div class="col-8">
                          <input class="form-control" type="date" name="period_possession" id="period_possession" value="<?= $lmnote->period_possession ?>" readonly />
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Nature of possession –</label>
                    </div>
                    <div class="form-group col-md-6">
                      <input class="form-control" type="text" name="nature_possession" id="nature_possession" value="<?= $lmnote->nature_possession ?>" readonly />
                    </div>
                  </div>

                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Purpose of the land used by the occupants(if any other than pt.5) –</label>
                    </div>
                    <div class="form-group col-md-6">
                      <input type="text" name="land_used_by_occupants" value="<?= $lmnote->land_used_by_occupants ?>" class="form-control" placeholder="Enter purpose of the land used by occupants" disabled>
                    </div>
                  </div>
                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Is Khajana receipt uploaded by applicant ?</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-check form-check-inline">
                        <?php if (($lmnote->e_khajana_receipt_check == "Yes") || ($lmnote->e_khajana_receipt_check == "YES")) { ?>
                          <span class="text-success"><i class="fa fa-check"></i> Yes</span>
                        <?php } else if (($lmnote->e_khajana_receipt_check == "No") || ($lmnote->e_khajana_receipt_check == "NO")) { ?>
                          <span class="text-danger"><i class="fa fa-remove"></i> No</span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>



                  <div class="row p-2 px-5">
                    <div class="col-md-6">
                      <strong><?= $sl_count++ ?>.</strong> LM remarks</label>
                    </div>
                    <div class="col-md-6">
                      <textarea name="lm_remark" disabled class="form-control" id="lm_remark" cols="30" rows="2"><?= $lmnote->lm_note ?></textarea>
                    </div>
                  </div>
                  <!-- lm report ends here -->
                <?php endforeach; ?>
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
                </div>
              </div>
              <!-- <a class="btn btn-warning btn-sm pull-center btnNext">Proceedings <i class="fa fa-arrow-right"></i></a> -->
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
                <small class="bg-warning"><?= $_GET['app'] ?>, <?= $case_no ?></small> )
              </h5>
              <div class="card anyClass">
                <div class="card-body proceedings">
                  <table class="table table-bordered">
                    <tr>
                      <th>Date of remark</th>
                      <th>Remark from</th>
                      <th>Remark</th>
                    </tr>
                    <?php $i = 1;
                    foreach ($proceedings as $pro) : ?>
                      <tr>
                        <td><?= $pro->date_entry; ?></td>
                        <td><?= $pro->office_from; ?></td>
                        <td><span class="bg-warning text-white"><?= $pro->note_on_order; ?></span></td>
                      </tr>
                    <?php endforeach; ?>
                  </table>
                </div>
              </div>
            </div>
            <!-- proceeding end -->

            <!-- Department Tab Start-->
            <div class="tab-pane" role="tabpanel" id="step6">
              <h5 class="bg-success p-2 text-white shadow">
                Department Reporting for <?= $service_name ?> (
                <small class="bg-warning"><?= $_GET['app'] ?>, <?= $case_no ?></small> )
              </h5>
              <div class="card">
                <div class="card-body">
                  <h5 class="bg-secondary p-2 text-white shadow mt-2">
                    Department Report
                  </h5>
                  <div class="card-text mt-2 lm-report">

                  </div>
                </div>
              </div>
            </div>
            <!-- Department Tab End -->
            <div class="clearfix"></div>
          </div>
        </form>
      </div>
    </section>
  </div>
</div>

<!-- Department button script -->

<script>
  // Approve by Department
  $(".department_approve").click(function(e) {
    e.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Approve!',
    }).then((result) => {
      if (result.isConfirmed) {
        var application_no = $(this).val();
        var department_remarks = $('#department_remarks').val()

        $.ajax({
          url: '<?php echo base_url() . "index.php/Basundhara/approveByDepartment/" ?>',
          type: "POST",
          dataType: "json",
          data: {
            'application_no': application_no,
            'department_remarks': department_remarks,
          },

          error: function() {
            Swal.fire({
              title: "Failed",
              text: "Application Not Approved..",
              type: "warning",
              timer: 50000
            });
          },
          success: function(data) {
            console.log(data);
            if (data.statusCode == 200) {
              Swal.fire({
                title: "Submitted",
                text: "Approved by Department  successfully ",
                type: "success",
                timer: 50000
              });
              location.href = '<?php echo base_url() ?>index.php/Basundhara/request/<?= $settlement_basic['service_code']; ?>';
            } else if (data.statusCode == 500) {
              Swal.fire({
                title: "Failed",
                text: "Please Add All Remarks before Approval.",
                type: "error",
                timer: 50000
              });
            } else {
              Swal.fire({
                title: "Failed",
                text: "Application Approve Failed.",
                type: "error",
                timer: 50000
              });
            }
          },

        });
      }
    })
  });

  // Revert by Department
  $(".department_revert").click(function(e) {
    e.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Revert!',
    }).then((result) => {
      if (result.isConfirmed) {
        var application_no = $(this).val();
        var department_remarks = $('#department_remarks').val();

        $.ajax({
          url: '<?php echo base_url() . "index.php/Basundhara/revertByDepartment/" ?>',
          type: "POST",
          dataType: "json",
          data: {
            'application_no': application_no,
            'department_remarks': department_remarks,
          },

          error: function() {
            Swal.fire({
              title: "Failed",
              text: "Application Not Reverted..",
              type: "warning",
              timer: 50000
            });
          },
          success: function(data) {
            console.log(data);
            if (data.statusCode == 200) {
              Swal.fire({
                title: "Submitted",
                text: "Reverted by Department  successfully ",
                type: "success",
                timer: 50000
              });
              location.href = '<?php echo base_url() ?>index.php/Basundhara/request/<?= $settlement_basic['service_code']; ?>';
            } else if (data.statusCode == 500) {
              Swal.fire({
                title: "Failed",
                text: "Please add remarks before Revert.",
                type: "error",
                timer: 50000
              });
            } else {
              Swal.fire({
                title: "Failed",
                text: "Application Revert Failed.",
                type: "error",
                timer: 50000
              });
            }
          },

        });
      }
    })
  });
</script>