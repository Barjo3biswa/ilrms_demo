                  <!-- Address Information Begin -->
                  <h5 class="bg-secondary p-2 text-white shadow mt-2 text-center"><i class="fa fa-map" aria-hidden="true"></i>
                      Address Information
                  </h5>
                  <p class="card-text">
                  <table class="table table-bordered">
                      <tr>
                          <th>District :</th>
                          <td class="text-warning">
                              <strong class="alert-warning">
                                  <p><?= $this->utilclass->getDistrictName($settlement_basic['dist_code']) ?></p>
                              </strong>
                          </td>
                          <th>Subdivision :</th>
                          <td class="text-warning">
                              <strong class="alert-warning">
                                  <p><?= $this->utilclass->getSubDivName($settlement_basic['dist_code'], $settlement_basic['subdiv_code']) ?></p>
                              </strong>
                          </td>
                      </tr>
                      <tr>
                          <th>Circle : </th>
                          <td class="text-warning">
                              <strong class="alert-warning">
                                  <p><?= $this->utilclass->getCircleName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code']) ?></p>
                              </strong>
                          </td>
                          <th>Mouza : </th>
                          <td class="text-warning">
                              <strong class="alert-warning">
                                  <p><?= $this->utilclass->getMouzaName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code']) ?></p>
                              </strong>
                          </td>
                      </tr>
                      <tr>
                          <th>Lot : </th>
                          <td class="text-warning">
                              <strong class="alert-warning">
                                  <p><?= $this->utilclass->getLotName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code'], $settlement_basic['lot_no']) ?></p>

                              </strong>
                          </td>
                          <th>Village : </th>
                          <td class="text-warning">
                              <strong class="alert-warning">
                                  <p><?= $this->utilclass->getVillageName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code'], $settlement_basic['lot_no'], $settlement_basic['vill_townprt_code']) ?></p>

                              </strong>
                          </td>
                      </tr>
                  </table>
                  </p>
                  <!--Address Information End  -->