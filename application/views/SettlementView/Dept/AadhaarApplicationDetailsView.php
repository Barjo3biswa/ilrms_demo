  <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center"><i class="fa fa-list-alt" aria-hidden="true"></i>
      Application Details
  </h5>

  <div class="row justify-content-center">
        <?php if (isset($aadhaar_b64_decoded) && ($aadhar->type =='AADHAAR')) : ?>
      <div class="col-md-2 mt-3">
          <?= $aadhaar_b64_decoded; ?>
      </div>
      <?php endif ?>
      <div class="col-md-10">
          <p class="card-text">
          <table class="table table-bordered" style='float:right'>


              <!-- new aadhaar -->
              <tr>
                  <th> Name in <?= $aadhar->type ?> </th>
                  <td>
                      <?php
                        if ($aadhar->aadhaar_no || $aadhar->pan_no) {
                            foreach ($applicants_buyers as $doc_name) :
                                if ($doc_name->is_applicant == 1) :
                        ?>
                                  <strong class="alert-warning">
                                      <?= $doc_name->eng_pdar_name ?>
                                  </strong>
                      <?php
                                endif;
                            endforeach;
                        }
                        ?>

                  </td>
              </tr>

              <!-- new aadhaar end -->
              <tr>
                  <th><?= $aadhar->type ?> Verified ?</th>
                  <td>
                      <?php if ($aadhar->is_aadhaar_verify == '1') { ?>
                          <strong class="text-success"><i class="fa fa-check"></i> Yes</strong>
                      <?php } ?>
                  </td>
              </tr>
              <tr>
                  <th>Possession from</th>
                  <td>
                      <strong><?= date("j F, Y", strtotime($settlement_basic['period_possession'])) ?></strong>

                  </td>
              </tr>
              <tr>
                  <th>Occupation or Profession of the applicant</th>
                  <td>
                      <strong><?= $settlement_basic['occupation_applicant']; ?></strong>

                  </td>
              </tr>
              <tr>
                  <th>Caste</th>
                  <td>
                      <strong>
                                <?php foreach (json_decode(CASTE) as $caste) {
                                                        if ($caste->CODE == $settlement_basic["caste"]) {
                                                            echo $caste->NAME;
                                                        }
                                                    }
                                 ?>
                        </strong>
                  </td>
              </tr>

              <?php  if ($settlement_basic['service_code'] != SETTLEMENT_KHAS_LAND_ID) : ?>
                  <tr>
                      <th>Whether land prayed for is within tribal belt/block</th>
                      <td>
                          <?php if (trim($backup_under_tribe_belts == 1)) { ?>
                              <strong class="text-success"><i class="fa fa-check"></i> Yes</strong>
                          <?php } else if (trim($backup_under_tribe_belts == 0)) { ?>
                              <strong class="text-danger"><i class="fa fa-remove"></i> No</strong>
                          <?php } ?>
                      </td>
                  </tr>
              <?php  endif; ?>

              <!-- Aadhaar Wise Application Applicant-->
              <tr>
                  <th class="bg-success">Total Applications applied by this Applicant</th>
                  <td>
                      <a type="button" target="_blank" class="btn btn btn-sm btn-warning" href="<?php echo base_url(); ?>Basundhara/apiAadharWiseApplication?app=<?= $_GET['app'] ?>&dist_code=<?= $_GET['dist_code'] ?>"><i class="fa fa-eye"></i> <small>View Applications</small>
                      </a>
                  </td>
              </tr>
              <!-- Aadhaar Wise Application by Applicant End-->

              <!-- New Added End -->
          </table>
          </p>
      </div>
  </div>