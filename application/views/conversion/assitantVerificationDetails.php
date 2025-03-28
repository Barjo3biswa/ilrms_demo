<style>
    .case-no-bg {
        background-color: #F2C94C;
        color: black !important;
        border-radius: 25px;
        padding-left: 6px;
        padding-right: 6px;
    }

    .bg-secondary {
        background-color: #40739e !important;
        /* border-style: double; */
    }

    .uni_text {
        font-size: 18px;
        line-height: 150%;
        font-family: Open Sans;
    }

    .textBold{
        font-size: 18px;
        font-weight: bold;

    }

    .responsive-table {
    li {
        /* border-radius: 3px; */
        padding: 15px 15px;
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        margin-left:-30px;
    }
    .table-header {
        background-color: #7AB2B2;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    .table-row {
        background-color: #ffffff;
        box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
    }
    .col-1 {
        flex-basis: 15%;
    }
    .col-2 {
        flex-basis: 60%;

    }
    .col-3 {
        flex-basis: 25%;
        text-align: center;
    }

    
    @media all and (max-width: 767px) {
        .table-header {
        display: none;
        }

        li {
        display: block;
        }
        .col {
        
        flex-basis: 100%;
        
        }

    }
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
            <!-- Assistant Remarks  Start Here-->
            <div class="tab-pane cls2" role="tabpanel" id="step6">
              <h5 class="bg-secondary p-2 text-white shadow">
                ASO Verification Report <small>(Case No: <?php echo $case_no; ?>)</small>
              </h5>
              <div class="card anyClass">
                <div class="card-body lm-report">
                    <div id="notice2">
                        <?php
                            if (count($assistantVerification) != 0) {
                                foreach ($assistantVerification as $verify):
                                    ?>
                        <div class="container">
                            <div class="panel-title">
                            </div>
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class='table table-striped unicode'>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >1) Whether portion of AP Land has been transferred &nbsp;- </label>
                                                <?php
                                                if ($verify->ap_land_transfer == 'Y') {
                                                    echo " <span class ='text-success'>Yes</span>";
                                                } else {
                                                    echo "<span class ='text-danger'>No</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >2) Whether the land is under the occupation of the applicant&nbsp;- </label>
                                                <?php
                                                if ($verify->occupation_applicant == 'Y') {
                                                     echo " <span class ='text-success'>Yes</span>";
                                                } else {
                                                    echo "<span class ='text-danger'>No</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >3) Nature of Occupation of the applicant&nbsp;- </label>
                                                <?php
                                                if ($verify->nature_occupation == 'Y') {
                                                     echo " <span class ='text-success'>Yes</span>";
                                                } else {
                                                    echo "<span class ='text-danger'>No</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >4) Whether AP land falls within Tribal Belt / Block&nbsp;- </label>
                                                <?php
                                                if ($verify->tribal_belt_yn == 'Y') {
                                                     echo " <span class ='text-success'>Yes</span>";
                                                } else {
                                                    echo "<span class ='text-danger'>No</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >5) Trace Map / Chitha / Jamabandi copy submitted&nbsp;- </label>
                                                <?php
                                                if ($verify->trace_map_yn == 'Y') {
                                                     echo " <span class ='text-success'>Yes</span>";
                                                } else {
                                                    echo "<span class ='text-danger'>No</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >6 (a) Whether eligible as per Rule 105 of ALRM&nbsp;- </label>
                                                <?php
                                                if ($verify->rule_alrm_yn == 'Y') {
                                                     echo " <span class ='text-success'>Yes</span>";
                                                } else {
                                                    echo "<span class ='text-danger'>No</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >6 (b) Whether eligible as per Rule 23 of ALRR&nbsp;- </label>
                                                <?php
                                                if ($verify->rule_alrr_yn == 'Y') {
                                                     echo " <span class ='text-success'>Yes</span>";
                                                } else {
                                                    echo "<span class ='text-danger'>No</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >6 (b) Whether eligible as per Land Policy, 2019&nbsp;- </label>
                                                <?php
                                                if ($verify->land_policy == 'Y') {
                                                     echo " <span class ='text-success'>Yes</span>";
                                                } else {
                                                    echo "<span class ='text-danger'>No</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >Remarks&nbsp;- </label>
                                                <span class="text-danger"><?php echo $verify->remarks ?> </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                            <?php
                                    endforeach;
                                } else {
                                    ?>
                                    
                                    <div class="panel-body">
                                        Verification not Done Yet
                                    </div>
                                    <?php
                                }
                                ?>
                    </div>
                </div>
              </div>
              <ul class="list-inline pull-right">
              </ul>
            </div>
            <!-- Assistant End Here-->

            <div class="clearfix"></div>
            </div>
        </section>
    </div>
</div>

