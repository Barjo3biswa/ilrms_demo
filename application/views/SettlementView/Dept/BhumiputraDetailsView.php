                  <div class="row p-2 px-5">
                      <div class="col-md-6">
                          <label for="formGroupExampleInput"><strong><?= $sl_count++ ?>.</strong> Bhumiputra Verified?</label>
                      </div>
                    <?php $i = 1; foreach ($settlement_ap_lmnote as $bhumi) : ?>
                      <div class="col-md-4">
                          <div class="form-check form-check-inline">
                              <!-- Alt -->
                                    <?php  if(($bhumi->bhumiputra_confirmation == "Yes") || ($bhumi->bhumiputra_confirmation == "YES")){ ?>
                                    <strong class="text-success"><i class="fa fa-check"></i> Yes</strong>     
                                    <?php } else{ ?>
                                    <strong class="text-danger"><i class="fa fa-remove"></i> No</strong> 
                                    <?php } ?>
                                    
                              <!-- Alt End -->
                          </div>
                      </div>

                      <!-- Bhumi Alt -->
                      <div class="col-md-4">
                            <?php if(($bhumi->bhumiputra_confirmation == "Yes") || ($bhumi->bhumiputra_confirmation == "YES")){ ?>
                                    <!-- <i class="fa fa-link" aria-hidden="true"></i>
                                    <a href="<?php echo base_url();?>index.php/Basundhara/bhumiPutra?<?php
                                    if(trim($settlement_basic['bhumiputra_certificate_type']) == 'CERT'){
                                        echo "cer_number=".$settlement_basic['bhumiputra_certificate_no'];
                                    }else{
                                        echo "ack_number=".$settlement_basic['bhumiputra_certificate_no'];
                                    }?>" target="BhumiPutra">
                                        <u><span class="text-primary" style="font-size:16px;">View Certificate</span></u>
                                    </a> -->
                            <?php } else{ ?>
                                        <span for="" class="bg-warning"><b>Certificate Not Available!</b></span>
                            <?php } ?>
                        </div>
                      <!-- Bhumi Alt ENd -->
                            <?php endforeach; ?>
                  </div>