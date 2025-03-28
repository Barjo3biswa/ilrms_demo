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

  .left-margin {
        margin-left: 200px;
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
        <!-- <div class="wizard-inner mb-1">
          <div class="connecting-line"></div>

          <ul class="nav nav-tabs shadow" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" style="text-transform: uppercase" data-toggle="tab" href="#step1" role="tab">Application &nbsp;&nbsp;<i class="fa fa-file" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" href="#step2" role="tab">LM Report&nbsp;&nbsp;<i class="fa fa-user" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" href="#step3" role="tab">CO Report &nbsp;&nbsp;<i class="fa fa-tasks" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" href="#step4" role="tab">SK Report &nbsp;&nbsp;<i class="fa fa-history" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" href="#step5" role="tab">BO Report &nbsp;&nbsp;<i class="fa fa-building" aria-hidden="true"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="text-transform: uppercase" data-toggle="tab" href="#step6" role="tab">Department &nbsp;&nbsp;<i class="fa fa-building" aria-hidden="true"></i></a>
            </li>
          </ul>
        </div> -->

          <!-- <div class="tab-content"> -->
            <!-- Application Review starts here -->
            <div class="tab-pane active" role="tabpanel" id="step1">
              <h5 class="bg-secondary p-2 text-white shadow">
                Application Description <small>(Case No: <?php echo $lm_details['case_no']; ?>)</small>
              </h5>
              <div class="card anyClass">
                <div class="card-body">
                        <div id="notice1" style='display: block'>
                            <div class="panel-body">
                                <fieldset>
                                    <h4 class="bold" style="color:#3c8198"> General Information </h4>
                                    <table class='table table-bordered unicode'>
                                        <tr>
                                            <td width="35%"><label class="text-danger"> District : &nbsp;&nbsp;&nbsp;  <?php echo $location['dist']; ?></label></td>
                                            <td width="30%"><label class="text-danger"> Subdivision : &nbsp;&nbsp;&nbsp;  <?php echo $location['sub']; ?></label></td>
                                            <td width="35%"><label class="text-danger"> Circle : &nbsp;&nbsp;&nbsp;  <?php echo $location['cir']; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><label class="text-danger"> Lot No  : &nbsp;&nbsp;&nbsp;  <?php echo $location['lot']; ?></label></td>
                                            <td><label class="text-danger"> Mouza  : &nbsp;&nbsp;&nbsp;  <?php echo $location['mouza']; ?></label></td>
                                            <td><label class="text-danger"> Vill/Town : &nbsp;&nbsp;&nbsp;  <?php echo $location['vill']; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><label class="text-danger"> Type : &nbsp;&nbsp;&nbsp;  <?php echo $conv_type; ?></</label></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><label class="text-danger"> Addressing Officer :  <?php echo $location['add_to']; ?></label></td>
                                            <td><label class="text-danger"> Submission Date : &nbsp;&nbsp;&nbsp;  <?php echo date('d-m-Y', strtotime($location['date'])); ?></label></td>
                                        </tr>
                                    </table>
                                </fieldset>
                                <fieldset>
                                    <h4 class="bold" style="color:#3c8198"> Dag Details Information </h4>
                                    <table class="table table-bordered  unicode">
                                        <thead>
                                            <tr>
                                                <th><label class="text-danger"> Dag No </label></th>
                                                <th><label class="text-danger"> Land Area(B-K-L)</label></th>
                                                <th class="center"><label class="text-danger"> Patta No </label></th>
                                                <th class="center"><label class="text-danger"> Patta Type </label></th>
                                                <th class="center"><label class="text-danger"> Show Chitha </label></th>
                                                <th class="center"><label class="text-danger"> Show Jamabandi </label></th>
                                            </tr>
                                        </thead>
                                            <tr>
                                                <td><label class="control-label"><?php echo $land_details['dag']; ?></label></td>
                                                <td><label class="control-label"><?php echo $land_details['m_dag_area_b'] . " বিঘা " . $land_details['m_dag_area_k'] . " কঠা " . $land_details['m_dag_area_lc'] . " লেছা " ?></label></td>
                                                <td class="center"><label class="control-label"><?php echo $land_details['patta_no']; ?></label></td>
                                                <td class="center"><label class="control-label"><?php echo $land_details['patta_type']; ?></label></td>
                                                <td class="center"><a href="<?php // echo base_url() . "index.php/ChithaReport/generateChitha?case_no=4&dist=" . $l_data['dist_code'] ."&sub_div=".$l_data['subdiv_code']."&cir=".$l_data['cir_code']."&m=".$l_data['mouza_pargona_code']."&l=".$l_data['lot_no']."&v=".$l_data['vill_code']."&p=".$land_details['patta_type']."&dag=".$land_details['dag']; ?>" target="_blank"><button type="submit" class="btn btn-xs"><span class="ass-btn">চিঠা চাওক</span></button></a></td>
                                                <td class="center"><a href="<?php // echo base_url() . "index.php/AsistantMutationPartha/saveJamabandiByPattano?case_no=" . $location['case_no']; ?>" target="_blank"><button type="submit" class="btn btn-xs"><span class="ass-btn">জমাবন্দী চাওক</span></button></a></td>
                                            </tr>
                                    </table>
                                </fieldset>
                                <fieldset>
                                    <h4 class="bold" style="color:#3c8198"> Applicant Information </h4>
                                    <table class='table table-bordered  unicode'>
                                        <thead>
                                            <tr>
                                                <th><label class="text-danger"> Sl No </label></th>
                                                <th><label class="text-danger"> Petitioner Name </label></th>
                                                <th><label class="text-danger"> Guardian Name </label></th>
                                                <th><label class="text-danger"> Relation </label></th>
                                                <th><label class="text-danger"> Address1 / Address2 </label></th>
                                            </tr>
                                        </thead>
                                            <?php $count = 1; ?>
                                            <?php
                                            foreach ($pattadar as $p):
                                                $pattadar = $p->pdar_name;
                                                ?>
                                                <tr>
                                                    <td><label class="control-label"><?php echo $count++; ?></label></td>
                                                    <td><label class="control-label"><?php echo $pattadar; ?></label></td>
                                                    <td><label class="control-label"><?php echo $p->pdar_guardian; ?></label></td>
                                                    <td><label class="control-label"><?php  echo $relationship; ?></label></td>
                                                    <td><label class="control-label"><?php echo $p->pdar_add1 . " " . $p->pdar_add2; ?></label></td>
                                                </tr>
                                            <?php endforeach; ?>
                                    </table>
                                </fieldset>
                            </div>
                      </div>
                </div>
              </div>

              <ul class="list-inline pull-right">
              </ul>
            </div>

            <!-- Application Review End here -->

            <!-- LM reporting starts here -->
            <div class="tab-pane cls2" role="tabpanel" id="step2">
              <h5 class="bg-secondary p-2 text-white shadow">
                LM(A) Report <small>(Case No: <?php echo $lm_details['case_no']; ?>)</small>
              </h5>
              <div class="card anyClass">
                <div class="card-body lm-report">
                    <div id="notice2">
                        <?php
                            if (count($lm_details_final) != 0) {
                                foreach ($lm_details_final as $lm):
                                    ?>
                        <div class="container">
                            <div class="panel-title">
                                <p style="color: red;" class="text-center textBold">( Dag No : <?php echo $land_details['dag']; ?>  )</p>
                            </div>
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class='table table-striped unicode'>
                                        <tr>
                                            <td colspan="2"><label class="control-label">
                                                    ১) আবেদন কৰা মাটিৰ পট্টা আবেদনকাৰীৰ নামত &nbsp; - 
                                                        <?php
                                                            if ($lm->applicant_patta_yn == 'Y') {
                                                                echo "আছে";
                                                            } else {
                                                                echo "নাই";
                                                            }
                                                        ?>
                                                    </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><label class="control-label">
                                                    ২) আবেদন কৰা মাটি আবেদনকাৰীৰ দখলত &nbsp; -
                                                        <?php
                                                        if ($lm->occupied_yn == 'Y') {
                                                            echo "আছে";
                                                        } else {
                                                            echo "নাই";
                                                        }
                                                        ?>
                                                    </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><label class="control-label">
                                                    ৩) উক্ত মাটিত মূল্যবান গছ-গছনি &nbsp; -
                                                        <?php
                                                        if ($lm->val_tree_yn == 'Y') {
                                                            echo "আছে";
                                                        } else {
                                                            echo "নাই";
                                                        }
                                                        ?>
                                                    </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><label class="control-label" >৪) উক্ত মাটিৰ শ্রেণী - <?php // echo $lm_details['land_class_code']; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><label class="control-label">
                                                    ৫) উক্ত মাটি অসম ভূমিলেখ্য অধিনিয়মৰ ১০৫ ধাৰা মতে ম্যাদীৰ উপযোগী &nbsp; -
                                                                    <?php
                                                                    if ($lm->issuit_forconv_under105 == 'Y') {
                                                                        echo "হয়";
                                                                    } else {
                                                                        echo "নহয়";
                                                                    }
                                                                    ?>
                                                    </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><label class="control-label">৬) ৰাস্তাৰ কাষৰ সংৰক্ষণ -  <?php echo $lm->roadside_rsv_b; ?> বিঃ, <?php echo $lm->roadside_rsv_k; ?> কঃ, <?php echo $lm->roadside_rsv_lc; ?> লেঃ </label></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><label class="control-label">
                                                    ৭) উক্ত মাটি নদীৰ কাষৰ মাটি &nbsp; -
                                                                    <?php
                                                                    if ($lm->near_river_yn == 'Y') {
                                                                        echo "হয়";
                                                                    } else {
                                                                        echo "নহয়";
                                                                    }
                                                                    ?>
                                                    </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >৮) <span class="red">অনুসুচিত জাতি / জনজাতি / বিধবা যাৰ কোনো উপাৰ্যনকাৰী সন্তান নাই অথবা উপাৰ্যনক্ষম ভূসম্পওি নাই / মুক্তিযোদ্ধা হয় তেন্তে মুঠ ম্যদীকৰন প্ৰিমিয়ামৰ ২৫% ৰেহাই ধায্য কৰি প্ৰিমিয়াম নিৰ্ধাৰণ কৰিব লাগিব |</span></label> 
                                                <ul>
                                                    <?php
                                                        if (($lm_details_final[0]->jati_janajati_yn != 'Y') && ($lm_details_final[0]->freedom_fighter_yn != 'Y') && ($lm_details_final[0]->widow_yn != 'Y'))
                                                        {
                                                            $msg="";
                                                            echo " - এই আবেদনত উপযোগী নহয় |";
                                                        }
                                                        else{
                                                            $msg="আৰু ২৫% ৰেহাই পাচত";
                                                        }
                                                        if ($lm->jati_janajati_yn == 'Y') {
                                                            echo '<li>
                                                                <label class="control-label" >ক. আবেদনকাৰী অনুসুচিত জাতি / জনজাতি হয় &nbsp;</label>
                                                                <div id="jati_janajatie" class="alert alert-info">';

                                                                if(empty($lm->jati_janajati_upload)){
                                                                ?>
                                                                    <span class="blue"> প্ৰয়েজনীয় নথি চাৱ পাৰে - FILE NOT ATTACHED</span> 
                                                                <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                    <span class="blue"> প্ৰয়েজনীয় নথি চাৱ পাৰে - <a href="javascript:void(0);" data-path="<?php // echo search_file_location('ConversionDocs/'. $lm->jati_janajati_upload); ?>" class="preview__file">View</a></span> 
                                                                    <?php
                                                                }
                                                                echo'</div>
                                                            </li>';
                                                        }
                                                                if ($lm->freedom_fighter_yn == 'Y') {
                                                                    echo '<li>
                                                                        <label class="control-label" >খ. আবেদনকাৰী ভূমিহীণ মুক্তিযোদ্ধা হয় &nbsp;</label>
                                                                        <div id="jati_janajatie" class="alert alert-info">';
                                                                        if(empty($lm->freedom_fighter_upload)){
                                                                        ?>
                                                                            <span class="blue"> প্ৰয়েজনীয় নথি চাৱ পাৰে - FILE NOT ATTACHED</span> 
                                                                        <?php
                                                                        }
                                                                        else{
                                                                            ?>
                                                                            <span class="blue"> প্ৰয়েজনীয় নথি চাৱ পাৰে - <a href="javascript:void(0);" data-path="<?php // echo search_file_location('ConversionDocs/'. $lm->freedom_fighter_upload); ?>" class="preview__file">View</a></span> 
                                                                            <?php
                                                                        }
                                                                        echo'</div>
                                                                    </li>';
                                                                }
                                                                if ($lm->widow_yn == 'Y') {
                                                                    echo '<li>
                                                                        <label class="control-label" >গ. আবেদনকাৰী বিধবা হয়নেকি যাৰ কোনো উপাৰ্যনকাৰী সন্তান নাই অথবা উপাৰ্যনক্ষম ভূসম্পওি নাই &nbsp;</label>
                                                                        <div id="jati_janajatie" class="alert alert-info">';
                                                                        if(empty($lm->widow_yn_upload)){
                                                                        ?>
                                                                            <span class="blue"> প্ৰয়েজনীয় নথি চাৱ পাৰে - FILE NOT ATTACHED</span> 
                                                                        <?php
                                                                        }
                                                                        else{
                                                                            ?>
                                                                            <span class="blue"> প্ৰয়েজনীয় নথি চাৱ পাৰে - <a href="javascript:void(0);" data-path="<?php // echo search_file_location('ConversionDocs/'. $lm->widow_yn_upload); ?>" class="preview__file">View</a></span> 
                                                                            <?php
                                                                        }
                                                                        echo'</div>
                                                                    </li>';
                                                                }
                                                    ?>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <?php  include(APPPATH."views/conversion/conversion_premium.php");?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                            <?php 
                                            include(APPPATH."views/conversion/conversion_premium_per_bigha.php"); ?>
                                                <label class="control-label">১০) বিঘাই প্রতি <span style="color: red;"><?=round($bigha_prem, 2); ?></span> টকা হাৰে <span style="color: red;"><?php echo $lm->conv_b; ?></span> বিঃ <span style="color: red;"><?php echo $lm->conv_k; ?></span> কঃ <span style="color: red;"><?php echo round($lm->conv_lc, 2); ?></span> লেঃ মাটিৰ মুঠ প্রিমিয়াম <span style="color: red;"><?php echo $msg." ".round($lm->prim_tot, 2); ?></span> টকা</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><label class="control-label">১১) মন্ডলৰ অন্যান্য তথ্য ও মন্তব্য</label></td>
                                            <td><label class="control-label"></label></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><label class="control-label">
                                                    ১২) লাঃ মঃ ৰ চহী &nbsp; - 
                                                        <?php
                                                        if ($lm->lm_sign_yn == 'Y' || $lm->lm_sign_yn == 'y') {
                                                            echo "আছে";
                                                        } else {
                                                            echo "নাই";
                                                        }
                                                        ?>
                                                    </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label">১৩) লাঃ মঃ ৰ নাম &nbsp; - <?php echo $lm_name; ?></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label">১৪) লাঃ মঃ এ টোকা লিখাৰ তাৰিখ &nbsp; - <?php echo date('d-m-Y', strtotime($lm->date_entry)); ?></label>
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
                                        No Report found
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
            <!-- LM reporting End here -->


            <!-- AST & CO reporting starts here -->
            <div class="tab-pane cls2" role="tabpanel" id="step3">
              <h5 class="bg-secondary p-2 text-white shadow">
                Assistant & CO Report <small>(Case No: <?php echo $lm_details['case_no']; ?>)</small>
              </h5>
              <div class="card">
                <div id="notice3" >
                <div class="container">
                        <br><p align="left" class="uni_text"> অসম অনুসূচী XXXVII(ৰ্পাট I), আবেদন নং ৫৫ </p><br>
                        <p align="right" style="margin-top: 0; margin-bottom: 0">
                            <small>Name:: 
                                <?php  foreach ($p_in_order as $pop):
                                    echo $pop->pdar_name . ", " . $pop->pdar_guardian . "<br>";
                                endforeach;
                                ?>
                            </small>
                        </p>
                    <div class="panel-title">
                        <p class="text-center textBold"><u>ORDER SHEET</u></p>
                        <p class="text-center uni-text">(See Rule 129 of the Record Manual 1911)</p>
                        <br>
                        <p class="text-center font-weight-bold uni-text">
                            <span class="textBold">Order Sheet, dated from 
                                <span class="text-danger"><?php echo date('d-m-Y', strtotime($location['date'])); ?></span> 
                                To 
                                <span class="text-danger"><?php echo date('d-m-Y', strtotime($location['next_date'])); ?></span> 
                                District: <span class="text-danger"><?php echo $location['dist']; ?></span> <br>
                                Case No: <span class="text-danger"><?php echo $location['case_no']; ?></span>
                            </span>
                        </p>
                    </div>

                    <ul class="responsive-table">
                        <li class="table-header">
                        <div class="col col-1">Date of Order</div>
                        <div class="col col-2">Order and Signature of Officer</div>
                        <div class="col col-3">Action Taken Note</div>
                        </li>
                        <?php $i = 1; foreach ($cases as $case): ?>
                            <li class="table-row">
                            <div class="col col-1 textBold text-danger" data-label=""><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d-m-Y', strtotime($case->date_entry)); ?></div>
                            <div class="col col-2" data-label=""><?php echo $case->co_order; ?></div>
                            <div class="col col-3" data-label=""><?php echo $case->note_on_order; ?></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                </div>
              </div>
              <ul class="list-inline pull-right">
              </ul>
            </div>
            <!-- AST & CO reporting End here -->

            <!-- SK Report Start Here-->
            <div class="tab-pane cls2" role="tabpanel" id="step4">
              <h5 class="bg-secondary p-2 text-white shadow">
                SK Report <small>(Case No: <?php echo $lm_details['case_no']; ?>)</small>
              </h5>
              <div class="card anyClass">
                    <div id="notice4">
                        <?php
                        if (count($lm_details_final) != 0) {
                            foreach ($lm_details_final as $lm):
                                ?>
                                <div class="container">
                                    <div class="panel-heading">
                                        <div class="panel-title mt-2">
                                            <p class='textBold text-center'><u><?php echo $this->lang->line('lm_report'); ?> ( <?php echo $this->lang->line('case_no'); ?> : <?php echo $lm_details['case_no']; ?>)</u><br>
                                            <span style="color: red;">(<?php echo $this->lang->line('dag_no'); ?> <?php echo $lm_details['dag_no']; ?>)</span></p>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12">

                                                <table class='table table-striped unicode'>
                                                    <tr>
                                                        <td colspan="2"><label class="control-label">
                                                                ১) আবেদন কৰা মাটিৰ পট্টা আবেদনকাৰীৰ নামত &nbsp; - 
                                                                <?php
                                                                if ($lm->applicant_patta_yn == 'Y') {
                                                                    echo "আছে";
                                                                } else {
                                                                    echo "নাই";
                                                                }
                                                                ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><label class="control-label">
                                                                ২) আবেদন কৰা মাটি আবেদনকাৰীৰ দখলত &nbsp; -
                                                                <?php
                                                                if ($lm->occupied_yn == 'Y') {
                                                                    echo "আছে";
                                                                } else {
                                                                    echo "নাই";
                                                                }
                                                                ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><label class="control-label">
                                                                ৩) উক্ত মাটিত মূল্যবান গছ-গছনি &nbsp; -
                                                                <?php
                                                                if ($lm->val_tree_yn == 'Y') {
                                                                    echo "আছে";
                                                                } else {
                                                                    echo "নাই";
                                                                }
                                                                ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><label class="control-label" >৪) উক্ত মাটিৰ শ্রেণী - <?php echo $lm_details['land_class_code']; ?></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><label class="control-label">
                                                                ৫) উক্ত মাটি অসম ভূমিলেখ্য অধিনিয়মৰ ১০৫ ধাৰা মতে ম্যাদীৰ উপযোগী &nbsp; -
                                                                <?php
                                                                if ($lm->issuit_forconv_under105 == 'Y') {
                                                                    echo "হয়";
                                                                } else {
                                                                    echo "নহয়";
                                                                }
                                                                ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><label class="control-label">৬) ৰাস্তাৰ কাষৰ সংৰক্ষণ - <?php echo $lm->roadside_rsv_b; ?> বিঃ, <?php echo $lm->roadside_rsv_k; ?> কঃ, <?php echo $lm->roadside_rsv_lc; ?> লেঃ </label></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><label class="control-label">
                                                                ৭) উক্ত মাটি নদীৰ কাষৰ মাটি &nbsp; -
                                                                <?php
                                                                if ($lm->near_river_yn == 'Y') {
                                                                    echo "হয়";
                                                                } else {
                                                                    echo "নহয়";
                                                                }
                                                                ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <label class="control-label" >৮) <span class="red">অনুসুচিত জাতি / জনজাতি / বিধবা যাৰ কোনো উপাৰ্যনকাৰী সন্তান নাই অথবা উপাৰ্যনক্ষম ভূসম্পওি নাই / মুক্তিযোদ্ধা হয় তেন্তে মুঠ ম্যদীকৰন প্ৰিমিয়ামৰ ২৫% ৰেহাই ধায্য কৰি প্ৰিমিয়াম নিৰ্ধাৰণ কৰিব লাগিব |</span></label> 
                                                            <ul>
                                                            <?php
                                                            if (($lm->jati_janajati_yn != 'Y') && ($lm->freedom_fighter_yn != 'Y') && ($lm->widow_yn != 'Y'))
                                                            {
                                                                echo " - এই আবেদনত উপযোগী নহয় |";
                                                            }
                                                            if ($lm->jati_janajati_yn == 'Y') {
                                                                echo '<li>
                                                                    <label class="control-label" >ক. আবেদনকাৰী অনুসুচিত জাতি / জনজাতি হয় &nbsp;</label>
                                                                    <div id="jati_janajatie" class="alert alert-info">';

                                                                    if(empty($lm->jati_janajati_upload)){
                                                                    ?>
                                                                        <span class="blue"> প্ৰয়েজনীয় নথি চাৱ পাৰে - FILE NOT ATTACHED</span> 
                                                                    <?php
                                                                    }
                                                                    else{
                                                                        ?>
                                                                        <span class="blue"> প্ৰয়েজনীয় নথি চাৱ পাৰে - <a href="javascript:void(0);" data-path="<?php // echo search_file_location('ConversionDocs/'. $lm->jati_janajati_upload); ?>" class="preview__file">View</a></span> 
                                                                        <?php
                                                                    }
                                                                    echo'</div>
                                                                </li>';
                                                            } 
                                                            if ($lm->freedom_fighter_yn == 'Y') {
                                                                echo '<li>
                                                                    <label class="control-label" >খ. আবেদনকাৰী ভূমিহীণ মুক্তিযোদ্ধা হয় &nbsp;</label>
                                                                    <div id="jati_janajatie" class="alert alert-info">';
                                                                    if(empty($lm->freedom_fighter_upload)){
                                                                    ?>
                                                                        <span class="blue"> প্ৰয়েজনীয় নথি চাৱ পাৰে - FILE NOT ATTACHED</span> 
                                                                    <?php
                                                                    }
                                                                    else{
                                                                        ?>
                                                                        <span class="blue"> প্ৰয়েজনীয় নথি চাৱ পাৰে - <a href="javascript:void(0);" data-path="<?php // echo search_file_location('ConversionDocs/'. $lm->freedom_fighter_upload); ?>" class="preview__file">View</a></span> 
                                                                        <?php
                                                                    }
                                                                    echo'</div>
                                                                </li>';
                                                            }
                                                            if ($lm->widow_yn == 'Y') {
                                                                echo '<li>
                                                                    <label class="control-label" >গ. আবেদনকাৰী বিধবা হয়নেকি যাৰ কোনো উপাৰ্যনকাৰী সন্তান নাই অথবা উপাৰ্যনক্ষম ভূসম্পওি নাই &nbsp;</label>
                                                                    <div id="jati_janajatie" class="alert alert-info">';
                                                                    if(empty($lm->widow_yn_upload)){
                                                                    ?>
                                                                        <span class="blue"> প্ৰয়েজনীয় নথি চাৱ পাৰে - FILE NOT ATTACHED</span> 
                                                                    <?php
                                                                    }
                                                                    else{
                                                                        ?>
                                                                        <span class="blue"> প্ৰয়েজনীয় নথি চাৱ পাৰে - <a href="javascript:void(0);" data-path="<?php // echo search_file_location('ConversionDocs/'. $lm->widow_yn_upload); ?>" class="preview__file">View</a></span> 
                                                                        <?php
                                                                    }
                                                                    echo'</div>
                                                                </li>';
                                                            }
                                                            ?>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <?php 
                                                            include(APPPATH."views/conversion/conversion_premium.php");?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                        <?php 
                                                        include(APPPATH."views/conversion/conversion_premium_per_bigha.php"); ?>
                                                            <label class="control-label">১০) বিঘাই প্রতি <span style="color: red;"><?=round($bigha_prem, 2); ?></span> টকা হাৰে <span style="color: red;"><?php echo $lm->conv_b; ?></span> বিঃ <span style="color: red;"><?php echo $lm->conv_k; ?></span> কঃ <span style="color: red;"><?php echo round($lm->conv_lc, 2); ?></span> লেঃ মাটিৰ মুঠ প্রিমিয়াম <span style="color: red;"><?php echo $msg." ".round($lm->prim_tot, 2); ?></span> টকা</label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="50%"><label class="control-label">১১) মন্ডলৰ অন্যান্য তথ্য ও মন্তব্য</label></td>
                                                        <td><label class="control-label"><?php echo $lm->partition_info; ?></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><label class="control-label">
                                                                ১২) লাঃ মঃ ৰ চহী &nbsp; - 
                                                                <?php
                                                                if ($lm->lm_sign_yn == 'Y' || $lm->lm_sign_yn == 'y') {
                                                                    echo "আছে";
                                                                } else {
                                                                    echo "নাই";
                                                                }
                                                                ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <label class="control-label">১৩) লাঃ মঃ ৰ নাম &nbsp; - <?php echo $lm_name; ?></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <label class="control-label">১৪) লাঃ মঃ এ টোকা লিখাৰ তাৰিখ &nbsp; - <?php echo date('d-m-Y', strtotime($lm->date_entry)); ?></label>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($lm->sk_sign_yn == 'Y' || $lm->sk_sign_yn == 'y') {
                                    ?>
                                    <div class="container">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <p class='text-center textBold'><span style="color: red;"><u><?php echo $this->lang->line('sk_report'); ?> </u></span></p>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <table class='table table-striped unicode'>
                                                        <tr>
                                                            <td><label class="control-label">১) কাননগুহৰ অন্যান্য তথ্য ও মন্তব্য</label></td>
                                                            <td width="50%"><label class="control-label"><?php echo $lm->sk_note; ?></label></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"><label class="control-label">
                                                                    ২) কাননগুহৰ চহী &nbsp; - 
                                                                    <?php
                                                                    if ($lm->sk_sign_yn == 'N' || $lm->sk_sign_yn == 'n' || $lm->sk_sign_yn == '') {
                                                                        echo "নাই";
                                                                    } else {
                                                                        echo "আছে";
                                                                    }
                                                                    ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <label class="control-label">৩) কাননগুহৰ নাম &nbsp; - <?php echo $sk_skname; ?></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <label class="control-label">৪) কাননগুহৰ টোকা লিখাৰ তাৰিখ &nbsp; - <?php echo date('d-m-Y', strtotime($lm->sk_note_date)); ?> &nbsp;</label>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                            endforeach;
                        } else {
                            ?>
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <p class='center bold uni_text'><span style="color: red;"><u><?php echo $this->lang->line('sk_report'); ?> </u></span></p>
                                </div>
                            </div>
                            <div class="panel-body">
                                No Report found
                            </div>
                            <?php
                        }
                        ?>
                    </div>
              </div>
              <ul class="list-inline pull-right">
              </ul>
            </div>
            <!-- SK Report End Here-->


            <!-- BO reporting starts here -->
            <div class="tab-pane cls2" role="tabpanel" id="step5">
              <h5 class="bg-secondary p-2 text-white shadow">
                BO Report <small>(Case No: <?php echo $lm_details['case_no']; ?>)</small>
              </h5>
              <div class="card anyClass">
                    <div id="notice6">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <p class="text-center textBold"><u>BRANCH OFFICER REPORT</u></p>
                                <p class='text-center uni_text'>(See Rule 129 of the Record Manual 1911)</p>
                                <br>
                                <p class="text-center font-weight-bold uni-text">
                                    <span class="textBold">Order Sheet, dated from 
                                        <span style="color: red;"><?php echo date('d-m-Y', strtotime($location['date'])); ?></span> 
                                        To 
                                        <span style="color: red;"><?php echo date('d-m-Y', strtotime($location['next_date'])); ?></span> 
                                        District <?php echo $location['dist']; ?> <br>
                                        Case No <?php echo $location['case_no']; ?>
                                    </span>
                                </p>
                            </div>



                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12" style="margin: 0 auto;float: none;margin-top: 20px;margin-bottom: 20px;">
                                    <table class='table table-striped unicode'>
                                        <?php
                                        if (count($bo_details_final) != 0) {
                                            foreach ($bo_details_final as $bo):
                                                ?>
                                        <?php
                                        if ((($bo_details['dist_frm_town'] == 3) && ($bo_details['inside_outside_town'] == 'i')) || (($lm_details_final[0]->dist_frm_town == 5) && ($lm_details_final[0]->inside_outside_town == 'i')) || (($lm_details_final[0]->dist_frm_town == 5) && ($lm_details_final[0]->inside_outside_town == 'm'))) {
                                            //"This is within 3km from the boundry of town.";
                                            ?>
                                            <tr>
                                                <td colspan="2">
                                                <?php if($bo_details['dist_frm_town'] == 3) { ?>
                                                    <label class="control-label" >A. ১) অবেদিত মাটি চহৰৰ পৰিহিমাৰ পৰা 3 কিঃ মিঃ ব্যাসাৰ্দ্ধৰ ভিতৰৰ মাটি হয়নে ?  &nbsp;</label>
                                                <?php } elseif(($bo_details['dist_frm_town'] == 5) && ($bo_details['inside_outside_town'] == 'i')) { ?>
                                                    <label class="control-label" >A. ১) অবেদিত মাটি জিলা সদৰ চহৰসমূহৰ পুনৰ্গঠিত উন্নয়ন প্ৰাধিকৰণ এলেকাৰ ভিতৰত আৰু উত্তৰ গুৱাহাটী, ৰঙিয়া আৰু পলাশবাৰী চহৰৰ পৰিধিৰ পৰা 5 কিঃমিঃ ব্যাসাৰ্ধৰ ভিতৰৰ মাটি হয়নে ? </label>
                                                <?php } elseif(($bo_details['dist_frm_town'] == 5) && ($bo_details['inside_outside_town'] == 'm')) { ?>
                                                    <label class="control-label" >A. ১) অবেদিত মাটি পৌৰ নগৰসমূহৰ পৰিধিৰ পৰা 5 কিঃমিঃ ব্যাসাৰ্ধৰ ভিতৰৰ মাটি হয়নে ?  &nbsp; <?php echo $notice;?> &nbsp;</label>
                                        
                                                <?php } ?>
                                                    
                                                    <?php
                                                    if ($bo->land_scenario == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label class="control-label" > ২) যদি হয়, তেন্তে প্ৰিমিয়ামৰ পৰিমাণ সঠিককৈ নিৰ্ধাৰণ / গণনা কৰা হ'লনে ? &nbsp;</label>
                                                    <?php
                                                    if ($bo->prim_assesed == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label class="control-label" > ৩) এই প্রতিবেদন চৰকাৰৰ অনুমোদনৰ বাবে পঠাব পাৰিনে ? &nbsp;</label>
                                                    <?php
                                                    if ($bo->approved == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            if(!empty($bo->reason))
                                            {
                                                ?>
                                            <tr>
                                                <td><label class="control-label" > ৪) যদি নোৱাৰি, তেন্তে কি কাৰনে নোৱাৰি ? &nbsp;</label></td>
                                                <td>
                                                    <?php echo $bo->reason; ?>
                                                </td>
                                            </tr>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                        } elseif ((($bo_details['dist_frm_town'] == 10) && ($bo_details['inside_outside_town'] == 'i')) || (($bo_details['dist_frm_town'] == 15) && ($bo_details['inside_outside_town'] == 'i'))) {
                                            //"This is within 10km from the boundry of town.";
                                            ?>
                                            <tr>
                                                <td colspan="2">
                                                <?php
                                                if ($bo_details['dist_frm_town'] == 10) { ?>
                                                    <label class="control-label" >A. ১) অবেদিত মাটি গুৱাহাটী পৌৰনিগোম পৰিহিমাৰ পৰা 10 কিঃ মিঃ ব্যাসাৰ্দ্ধৰ ভিতৰৰ মাটি হয়নে ?  &nbsp;</label>
                                                    <?php } else { ?>
                                                    <label class="control-label" >A. ১) অবেদিত মাটি গুৱাহাটী মহানগৰৰ পৰিধিৰ পৰা 15 কিলোমিটাৰ দূৰত আৰু জিলা হেডকুৱেটাৰ, উত্তৰ গুৱাহাটী, ৰঙিয়া আৰু পালাচবাৰী চহৰৰ পৰা 5 কিলোমিটাৰ ব্যাসাৰ্ধৰ ভিতৰত মাটি হয়নে ?  &nbsp;</label>
                                                    <?php } ?>

                                                    <?php
                                                    if (trim($bo->land_scenario) == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label class="control-label" > ২) যদি হয়, তেন্তে প্ৰিমিয়ামৰ পৰিমাণ সঠিককৈ নিৰ্ধাৰণ / গণনা কৰা হ'লনে ? &nbsp;</label>
                                                    <?php
                                                    if ($bo->prim_assesed == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label class="control-label" > ৩) এই প্রতিবেদন চৰকাৰৰ অনুমোদনৰ বাবে পঠাব পাৰিনে ? &nbsp;</label>
                                                    <?php
                                                    if ($bo->approved == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            if(!empty($bo->reason))
                                            {
                                                ?>
                                            <tr>
                                                <td><label class="control-label" > ৪) যদি নোৱাৰি, তেন্তে কি কাৰনে নোৱাৰি ? &nbsp;</label></td>
                                                <td>
                                                    <?php echo $bo->reason;?>
                                                </td>
                                            </tr> 
                                                <?php
                                            }
                                            ?>
                                            <?php
                                        } elseif (($bo_details['dist_frm_town'] == 0) && ($bo_details['inside_outside_town'] == 'o')) {
                                            ?>
                                            <tr>
                                                <td colspan="2">

                                                    <label class="control-label" >A. ১) অবেদিত মাটি গাওৰ মাটি হয়নে ?  &nbsp;</label>

                                                    <?php
                                                    if ($bo->land_scenario == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label class="control-label" > ২) যদি হয়, তেন্তে প্ৰিমিয়ামৰ পৰিমাণ সঠিককৈ নিৰ্ধাৰণ / গণনা কৰা হ'লনে ? &nbsp;</label>
                                                    <?php
                                                    if ($bo->prim_assesed == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label class="control-label" > ৩) এই প্রতিবেদন চৰকাৰৰ অনুমোদনৰ বাবে পঠাব পাৰিনে ? &nbsp;</label>
                                                    <?php
                                                    if ($bo->approved == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            if(!empty($bo->reason))
                                            {
                                                ?>
                                            <tr>
                                                <td><label class="control-label" > ৪) যদি নোৱাৰি, তেন্তে কি কাৰনে নোৱাৰি ? &nbsp;</label></td>
                                                <td>
                                                    <?php echo $bo->reason;?>
                                                </td>
                                            </tr> 
                                                <?php
                                            }
                                            ?>
                                            <?php
                                        } elseif ((($bo_details['dist_frm_town'] == 0) && ($bo_details['inside_outside_town'] == 'i')) || (($bo_details['dist_frm_town'] == 0) && ($bo_details['inside_outside_town'] == 'd'))) {
                                            //"This is within Town Land.";
                                            ?>
                                            <tr>
                                                <td colspan="2">
                                                    <?php if($bo_details['inside_outside_town'] == 'd') { ?>
                                                    <label class="control-label" >A. ১) উক্ত মাটি জিলা হেড কোৱাৰ্টাৰ, উত্তৰ গুৱাহাটী, ৰঙিয়া আৰু পলাশবাৰী চহৰৰ অন্তৰ্গত এলেকাসমূহ মাটি হয়নে ?  &nbsp; </label>
                                                    <?php } else { ?>
                                                    <label class="control-label" >A. ১) উক্ত মাটি নগৰ/চহৰৰ ভিতৰৰ মাটি হয়নে ?  &nbsp;</label>
                                                    <?php } ?>

                                                    <?php
                                                    echo $bo->land_scenario;
                
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label class="control-label" > ২) একচনা পট্টাখনৰ এটা অংশ বিক্ৰী কৰা হৈছে নেকি আৰু যদি হৈছে, তেন্তে যিখিনি মাটিৰ ওপৰত স্বত্ত উপভোগ কৰি আছে, তাৰেই ম্যদীকৰনৰ বাবে আবেদন কৰা হৈছে নেকি ? &nbsp;</label>
                                                    <?php
                                                    if ($bo->prt_transfer == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label class="control-label" > ৩) যদি (২) নং টো সছা হয়, তেন্তে প্ৰিমিয়ামৰ পৰিমাণ সঠিককৈ নিৰ্ধাৰণ / গণনা কৰা হ'লনে ? &nbsp;</label>
                                                    <?php
                                                    if ($bo->prim_assesed == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label class="control-label" > ৪) এই প্রতিবেদন চৰকাৰৰ অনুমোদনৰ বাবে পঠাব পাৰিনে ? &nbsp;</label>
                                                    <?php
                                                    if ($bo->sent_to_govt == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            if(!empty($bo->reason))
                                            {
                                                ?>
                                            <tr>
                                                <td><label class="control-label" > ৫) যদি নোৱাৰি, তেন্তে কি কাৰনে নোৱাৰি ? &nbsp;</label></td>
                                                <td>
                                                    <?php echo $bo->reason; ?>
                                                </td>
                                            </tr>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >B. নদীৰ / ৰাস্তাৰ কাষৰ সংৰক্ষণৰ হনদৰ্ভত পৰীক্ষা কৰি সঠিক পোৱা গৈছেনে ? &nbsp;</label>
                                                <?php
                                                    if ($bo->road_rvr_rerservation == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >C. প্রতিবেদন পুণৰ পৰীক্ষণৰ প্ৰয়োজন আছে নেকি ? &nbsp;</label>
                                                <?php
                                                    if ($bo->reverify == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><label class="control-label" >D. অন্যান্য তথ্য ও মন্তব্য &nbsp;</label></td>
                                            <td>
                                                <?php echo $bo->bo_note; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" > স্বাক্ষৰ (সাখা কর্মকর্তা) &nbsp;</label>
                                                <?php
                                                    if ($bo->bo_sign_yn == 'Y') {
                                                        echo " - হয়";
                                                    } else {
                                                        echo " - নহয়";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" > সাখা কর্মকর্তাৰ নাম &nbsp; - <?php echo $bo_boname; ?></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <label class="control-label" >তাৰিখ &nbsp; - <?php echo date('d-m-Y', strtotime($bo->bo_sign_date)); ?></label>
                                            </td>
                                        </tr>
                                        <?php
                                        endforeach;
                                    }
                                    ?>
                                    </table>
                                        <ul class="responsive-table">
                                            <li class="table-header">
                                            <div class="col col-1">Date of Order</div>
                                            <div class="col col-2">DC / ADC (s) Recommendation Note</div>
                                            <div class="col col-3">Action Taken Note</div>
                                            </li>
                                            <?php $i = 1; foreach ($dc_adc_order as $d_a_order): ?>
                                                <li class="table-row">
                                                <div class="col col-1 text-danger textBold" data-label=""><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d-m-Y', strtotime($d_a_order->date_of_hearing)); ?></div>
                                                <div class="col col-2" data-label=""><?php echo $d_a_order->co_order; ?></div>
                                                <div class="col col-3" data-label=""><?php echo $d_a_order->note_on_order; ?></div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
              <ul class="list-inline pull-right">
              </ul>
            </div>
            <!-- BO reporting End here -->


            <!-- Department Start Here-->
            <div class="tab-pane cls2" role="tabpanel" id="step6">
              <h5 class="bg-secondary p-2 text-white shadow">
                DC Report <small>(Case No: <?php echo $lm_details['case_no']; ?>)</small>
              </h5>
              <div class="card anyClass">

                            <table class='table table-striped table-bordered rasid-t' style="font-size: 20px;">
                                <tr>
                                    <td colspan="2">
                                    <?php
                                    foreach ($premium as $p) {
                                        $presence = $p->prem_pay_method;
                                    }
                                    foreach ($lm_details_final as $lm):
                                        $p=round($lm->prim_per_bigha, 2);
                                        $pt=round($lm->prim_tot, 2);
                                        if ((($lm->dist_frm_town == '0') && ($lm->inside_outside_town == 'o')) || (($lm->dist_frm_town == '5') && ($lm->inside_outside_town == 'm')) || (($lm->dist_frm_town == '0') && ($lm->inside_outside_town == 'r')) || ($lm->dist_frm_town == '3') || (($lm->dist_frm_town == '5') && ($lm->inside_outside_town == 'm'))) {
                                            if (trim($lm->premium_assesment) == '40' || trim($lm->premium_assesment) == '20') {
                                                $prem_percent="বিঘাই প্রতি ".$lm->premium_assesment." টকা";
                                            }else{
                                                $prem_percent=$lm->premium_assesment." %";
                                            }
                                        }else{
                                          $prem_percent=$lm->premium_assesment." %";
                                        }

                                    endforeach;
                                    if (($lm_details_final[0]->jati_janajati_yn != 'Y') && ($lm_details_final[0]->freedom_fighter_yn != 'Y') && ($lm_details_final[0]->widow_yn != 'Y'))
                                    {
                                        $msg="";
                                        $abedon_kari="";
                                    }
                                    else{
                                        $msg="আৰু ২৫% ৰেহাই পাচত";
                                        $abedon_kari="এই মাটিৰ আবেদনকাৰী";
                                    }
                                    $jati_janajati='';
                                    $freedom_fighter='';
                                    $widow='';
                                    if($lm_details_final[0]->jati_janajati_yn == 'Y'){
                                        $jati_janajati='অনুসুচিত জাতি / জনজাতি জনা যায় |';
                                    }
                                    if($lm_details_final[0]->freedom_fighter_yn == 'Y'){
                                        $freedom_fighter='ভূমিহীণ মুক্তিযোদ্ধা জনা যায় |';
                                    }
                                    if($lm_details_final[0]->widow_yn == 'Y'){
                                        $widow='বিধবা হয় যাৰ কোনো উপাৰ্যনকাৰী সন্তান নাই অথবা উপাৰ্যনক্ষম ভূসম্পওি নাই |';
                                    }
                                    


                                    
                                    
                                    if ($presence == '') {
                                        ?>
                                        লাঃমঃ/চুঃকাঃ/চক্ৰ বিষয়া/শাখা বিষয়াৰ প্ৰতিবেদন চোৱা হ’ল ৷ <?php echo $abedon_kari." ".$jati_janajati." ".$freedom_fighter." ".$widow;?> প্ৰতিবেদন পৰীক্ষণ মৰ্মে ম্যাদীকৰণৰ বাবে আবেদিত জমী অসম ভূমিলেখ্য নিয়মাৱলী, 
                                        ১৯০৬ৰ ১০৫ নং নিয়ম অনুসৰি উপযুক্ত বিবেচিত হোৱাত <?php echo $location['mouza']; ?> মৌজাৰ <?php echo $location['vill']; ?> গাওঁৰ 
                                        <span style='color:red;'><?php echo $land_details['patta_no']; ?> নং <?php echo $land_details['patta_type']; ?> পট্টাৰ  <?php echo $land_details['dag']; ?> 
                                            নং দাগৰ</span> <?php echo $land_details['m_dag_area_b']; ?> বিঘা <?php echo $land_details['m_dag_area_k']; ?> কঠা <?php echo $land_details['m_dag_area_lc']; ?> লেছা জমীৰ ম্যাদীকৰণ প্ৰিমিয়াম মাটিৰ মান্ডলিক মুল্যৰ <span style='color:red;'> <?php echo $prem_percent; ?> হিচাপে <?php echo $msg; ?> মুঠ <?php echo $pt; ?> টকা</span> আদায়ৰ হুকুম দিয়া হ’ল ৷ আবেদনকাৰীক প্ৰিমিয়াম আদায়ৰ বাবে অবগত কৰোৱা হওঁক ৷<br>
                                        <span style='float:right;margin-right:50px; text-align: center'><?php echo $location['add_to']; ?><br><?php echo $location['add_off_designation']; ?>, <?php echo $location['dist']; ?></span>
                                        
                                        
                                        <?php
                                    } else {
                                        If(($lm_details_final[0]->applicant_patta_yn=='Y') && ($lm_details_final[0]->occupied_yn=='Y'))
                                        {
                                            $applicants_patta_occupied="আবেদন কৰা মাটি আবেদনকাৰীৰ পট্টাৰ মাটি বা দখলত থকা মাটি হয় |";
                                        }
                                        else{
                                            $applicants_patta_occupied="আবেদন কৰা মাটি আবেদনকাৰীৰ পট্টাৰ মাটি বা দখলত থকা মাটি নহয় |";
                                        }
                                        If(($lm_details_final[0]->val_tree_yn=='Y'))
                                        {
                                            $val_tree_yn = "এই মাটি ". $lm_details['land_class_code']. "মাটি হ'য় আৰু ইয়াত মূল্যবান গছ-গছনি আছে |";
                                        }
                                        else{
                                            $val_tree_yn = "এই মাটি ". $lm_details['land_class_code']. "মাটি হ'য় আৰু ইয়াত মূল্যবান গছ-গছনি নাই |";
                                        }
                                        
                                        If(($lm_details_final[0]->roadside_rsv_b !='0')||($lm_details_final[0]->roadside_rsv_k !='0')||($lm_details_final[0]->roadside_rsv_lc !='0'))
                                        {
                                            $roadside = "উক্ত মাটিৰ ৰাস্তাৰ কাষৰ সংৰক্ষণ ".$lm_details_final[0]->roadside_rsv_b. " বিঃ, ".$lm_details_final[0]->roadside_rsv_k." কঃ, ".$lm_details_final[0]->roadside_rsv_lc." লেঃ |";
                                        }
                                        else{
                                            $roadside = "উক্ত মাটিৰ ৰাস্তাৰ কাষৰ সংৰক্ষণ নাই |";
                                        }
                                        If(($lm_details_final[0]->near_river_yn=='Y'))
                                        {
                                            $riverside = "এই মাটি নদীৰ কাষৰ মাটি হয় |";
                                        }
                                        else{
                                            $riverside = "এই মাটি নদীৰ কাষৰ মাটি নহয় |";
                                        }
                                        
                                        ?>

                                    <!-- test ----------------------------------------------------------->

                                        চক্ৰ বিষয়া <?php echo $location['cir']; ?> ৰাজহ চক্ৰই দাখিল কৰা <span style='color:red;'><?php echo $location['case_no']; ?></span> 
                                        নং ম্যাদীকৰণৰ প্ৰস্তাৱ আৰু লাঃমঃ/চুঃকাঃ/চক্ৰ বিষয়া/শাখা বিষয়াই এই প্ৰস্তাৱ সন্দৰ্ভত দাখিল কৰা প্ৰতিবেদন চোৱা হ’ল ৷ 
                                        <?php echo $abedon_kari." ".$jati_janajati." ".$freedom_fighter." ".$widow;?> <?php echo $applicants_patta_occupied." ".$val_tree_yn." ".$roadside." ".$riverside; ?>
                                        অসম ভুমিলেখ্য নিয়মাৱলী 
                                        ১৯০৬ৰ ১০৫ নং নিয়ম অনুসৰি ম্যাদীকৰণৰ বাবে উপযুক্ত বিবেচিত হোৱাত তথা অসম চৰকাৰৰ দ্বাৰা নিৰ্দ্ধাৰিত হাৰত প্ৰিমিয়াম আদায় নিশ্চিত 
                                        হোৱাত <?php echo $location['mouza']; ?> মৌজাৰ <?php echo $location['vill']; ?> গাওঁৰ 
                                        <span style='color:red;'><?php echo $land_details['patta_no']; ?> নং <?php echo $land_details['patta_type']; ?> পট্টাৰ  <?php echo $land_details['dag']; ?> 
                                            নং দাগৰ</span> <?php echo $land_details['m_dag_area_b']; ?> বিঘা <?php echo $land_details['m_dag_area_k']; ?> কঠা 
                                                <?php echo $land_details['m_dag_area_lc']; ?> লেছা জমীৰ ম্যাদীকৰণ প্ৰিমিয়াম মাটিৰ মান্ডলিক মুল্যৰ <span style='color:red;'> 
                                                    <?php echo $prem_percent; ?> হিচাপে <?php echo $msg; ?> মুঠ <?php echo $pt; ?> টকা |</span> 
                                                এই জমীৰ ম্যাদীকৰণৰ হুকুম দিয়া হ’ল ৷<br>
                                        <span style='float:right;margin-right:50px; text-align: center'><?php echo $location['add_to']; ?><br><?php echo $location['add_off_designation']; ?>, <?php echo $location['dist']; ?></span>
                                        
                                       
                                    <!-- Test end ----------------------------------------------------->
                                        <?php
                                    }
                                    ?>
                                    </td>
                                </tr>    

                                    <input type="hidden" value="<?php echo $location['case_no']; ?>"   id="case_no" readonly>
                                    <input type="hidden" value="<?php echo $location['petition_no']; ?>"   id="petition_no" readonly>
                                    <input type="hidden" value="<?php echo $dist_code; ?>"   id="dist_code" readonly>
                                    <input type="hidden" value="<?php echo $location['subdiv_code']; ?>"   id="subdiv_code" readonly>
                                    <input type="hidden" value="<?php echo $location['cir_code']; ?>"   id="cir_code" readonly>
                                    <input type="hidden" value="<?php echo $location['mouza_pargona_code']; ?>"   id="mouza_pargona_code" readonly>
                                    <input type="hidden" value="<?php echo $location['lot_no']; ?>"   id="lot_no" readonly>
                                    <input type="hidden" value="<?php echo $location['vill_townprt_code']; ?>"   id="vill_townprt_code" readonly>

                            </table>  

                            <?php if (CONVERSION_OLD_PROCESS_DISABLED == 0): ?>

                            <?php // if ($this->session->userdata('designation') == DPT_PS &&  $location['ps_approve'] != 'Y'): ?>
                                <div class="container">
                                        <!-- <div class="row">
                                            <div class="col-sm-12" style="margin: 0 auto;float: none;margin-top: 20px;margin-bottom: 20px;">
                                                <ul class="responsive-table">
                                                    <li class="table-header">
                                                    <div class="col col-1">Date of Order</div>
                                                    <div class="col col-2">Joint Secretary Report</div>
                                                    </li>
                                                    <?php $i = 1; foreach ($dept_order as $d_order): ?>
                                                        <li class="table-row">
                                                        <div class="col col-1 text-danger textBold" data-label=""><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d-m-Y', strtotime($d_order->date_of_hearing)); ?></div>
                                                        <div class="col col-2" data-label=""><?php echo $d_order->co_order; ?></div>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                        </div> -->
                                    </div>

                                        <!-- <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                <label style="color: #666">Department Order Number</label>
                                                <input type="text" class="form-control" id="dept_order_no" value="" placeholder="Enter Order No">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                <label style="color: #666">Department Order Date</label>
                                                <input type="date" class="form-control" id="dept_order_date" value="">
                                                </div>
                                            </div>
                                        </div> -->

                                        <!-- <div class="row mt-3">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <button type="button" class="rezaButt buttInfo" id="final_approve_ps">Approve Order</button>
                                                </div>
                                            </div>
                                        </div> -->

                                </div>
                            <?php // endif ?>

                            <?php if ($this->session->userdata('unique_user_id') == CONVERSION_USER  &&  $location['js_approve'] != 'Y'): ?>
                                <!-- <div class="row mt-3 p-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <button type="button" class="rezaButt buttInfo" id="approve_send_to_ps">Approve & Send to PS</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <button type="button" class="rezaButt buttDanger" id="revert_conversion_js">Revert to DC</button>
                                        </div>
                                    </div>
                                </div> -->
                            <?php endif ?>

                            <?php endif ?>

                            <hr style="border-bottom: 2px solid #000;">
                            <?php
                                    if($basundharaAttachment){
                                    echo '<div class=\'col-lg-12\'><h2 class="red">Basundhara Attachments</h2>';
                                    foreach ($basundharaAttachment  as $attachment):
                                    ?>
                                    <h6><a href="<?php echo base_url()."index.php/DeptConversionNew/document/".$attachment->name  ?>" class="red" target="_blank"><i class='fa fa-paperclip'></i>&nbsp;&nbsp;<?php echo $attachment->name;?> (Click to see the attachment)</a></h6>
                                    <?php 

                                    endforeach; 
                                    }
                                    echo "</div>";
                            ?>

              </div>
              <ul class="list-inline pull-right">
              </ul>
            </div>
            <!-- Department End Here-->


            <!-- Assistant Remarks  Start Here-->
            <div class="tab-pane cls2" role="tabpanel" id="step6">
              <!-- <h5 class="bg-secondary p-2 text-white shadow">
                ASO Verification Report <small>(Case No: <?php echo $lm_details['case_no']; ?>)</small>
                <?php if (($astVerificationStatus =='S') AND ($this->session->userdata('designation') == ASSISTANT_USERCODE)) { ?>
                    <button class="rezaButt buttInfo" id="astVerification"><i class="fa fa-edit aria-hidden="true"></i>Set the checklist after verification</button>
                <?php } ?>
              </h5> -->
              <div class="card anyClass">
                <div class="card-body lm-report">
                    <!-- <div id="notice2">
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
                                        <span>Verification not Done Yet</span>
                                    </div>
                                    <?php
                                }
                                ?>
                    </div> -->
                    <?php if ($designation = $this->session->userdata('designation') == 'ASSISTANT'): ?>
                    <h5>ASO REMARKS</h5>
                    <textarea id="aso_remarks" name="aso_remarks" class="form-control" placeholder="Enter ASO Remarks here"></textarea>
                    <center class="mt-5">
                    <input type="hidden" id="case_no_get" name="case_no_get" value="<?=$location['case_no']?>" >
                    <input type="hidden" id="dist_code_get" name="dist_code_get" value="<?=$dist_code?>" >
                    <input type="hidden" id="verification_type_get" name="verification_type_get" value="<?=ASO_TO_JDS_FORWARD?>" >
                        <button class="btn btn-sm btn-success"  onclick="forward_to_js_from_aso()"> <i class="fa fa-forward"></i>  Forward To JS</button>
                        <a href="<?=base_url('pending-conversion-cases')?>"
                        <button class="btn btn-sm btn-danger text-white"> <i class="fa fa-angle-double-left"></i> Back</button></a>
                    </center>
                    <?php endif;?>



                </div>

              </div>
              <ul class="list-inline pull-right">
              </ul>
            </div>
            <!-- Assistant End Here-->

            <div class="clearfix"></div>
          <!-- </div> -->


      </div>
    </section>
  </div>
</div>


<!-- Modal for Revert Cases to DC -->
<div class="modal" role="dialog" id="conversionRevertModal" data-keyboard="false" data-backdrop="static">
    <form method="post" id="case_revert_to_dc_form">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header text-white text-bold text-center bg-danger">
                        <h5 class="modal-title w-100">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                            REVERT CASES TO DC <br>
                        </h5>
                </div>
                <div class="modal-body " style="font-size:15px">
                    <div class="form-group">
                        <label for="comment">Revert Remarks:</label>
                        <textarea class="form-control"  rows="3" id="revert_remarks"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="revertToDCModalClose()">
                            <i class="fa-fa-close"></i>
                            Close
                        </button>
                    <button type="button" class="btn btn-primary" id="revert_cases_to_dc_submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal for Revert Cases to DC -->


<!-- Modal for Approve & Send Cases to PS -->
<div class="modal" role="dialog" id="conversionApproveModal" data-keyboard="false" data-backdrop="static">
    <form method="post" id="send_to_ps_form">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header text-white text-bold text-center bg-primary">
                        <h5 class="modal-title w-100">
                            <i class="fa fa-check-circle"></i>
                            Approve & Send to PS <br>
                        </h5>
                </div>
                <div class="modal-body " style="font-size:15px">
                    <div class="form-group">
                        <label for="comment">Approval Remarks:</label>
                        <textarea class="form-control"  rows="3" id="approval_remarks"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="revertToDCModalClose()">
                            <i class="fa-fa-close"></i>
                            Close
                        </button>
                    <button type="button" class="btn btn-primary" id="approve_cases_to_ps_submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal for Approve & Send Cases to PS -->


<!-- Modal for Case Verification jby ASO -->
<div class="modal" role="dialog" id="astVerificationModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Verification by ASO Case No:: <?php echo $location['case_no']; ?></h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div>
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="astverificationForm">
                                    <table class="table table-bordered">
                                        <input type="hidden" name="distCodeAst" value="<?php echo $dist_code; ?>" required>
                                        <input type="hidden" name="subdivCodeAst" value="<?php echo $location['subdiv_code']; ?>" required>
                                        <input type="hidden" name="cirCodeAst" value="<?php echo $location['cir_code']; ?>" required>
                                        <input type="hidden" name="caseNoAst" value="<?php echo $location['case_no']; ?>" required>
                                        <tbody>
                                            <tr>
                                                <td>1) Whether portion of AP Land has been transferred?</td>
                                                <td>
                                                    <label class="radio-inline text-success">
                                                        <input type="radio" name="apLandTransfer" value="Y" required> Yes
                                                    </label>
                                                    <label class="radio-inline text-danger">
                                                        <input type="radio" name="apLandTransfer" value="N" required> No
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2) Whether the land is under the occupation of the applicant?</td>
                                                <td>
                                                    <label class="radio-inline text-success">
                                                        <input type="radio" name="occupationApplicant" value="Y" required> Yes
                                                    </label>
                                                    <label class="radio-inline text-danger">
                                                        <input type="radio" name="occupationApplicant" value="N" required> No
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3) Nature of Occupation?</td>
                                                <td>
                                                    <label class="radio-inline text-success">
                                                        <input type="radio" name="natureOccupation" value="Y" required> Yes
                                                    </label>
                                                    <label class="radio-inline text-danger">
                                                        <input type="radio" name="natureOccupation" value="N" required> No
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4) Whether AP land falls within Tribal Belt / Block?</td>
                                                <td>
                                                    <label class="radio-inline text-success">
                                                        <input type="radio" name="tribalBeltYn" value="Y" required> Yes
                                                    </label>
                                                    <label class="radio-inline text-danger">
                                                        <input type="radio" name="tribalBeltYn" value="N" required> No
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5) Trace Map / Chitha / Jamabandi copy submitted</td>
                                                <td>
                                                    <label class="radio-inline text-success">
                                                        <input type="radio" name="traceMapYn" value="Y" required> Yes
                                                    </label>
                                                    <label class="radio-inline text-danger">
                                                        <input type="radio" name="traceMapYn" value="N" required> No
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6) Whether eligible as per: </td>
                                            </tr>
                                            <tr class="left-margin">
                                                <td><p class="left-margin">(a) Rule 105 of ALRM</p></td>
                                                <td>
                                                    <label class="radio-inline text-success">
                                                        <input type="radio" name="ruleAlrm" value="Y" required> Yes
                                                    </label>
                                                    <label class="radio-inline text-danger">
                                                        <input type="radio" name="ruleAlrm" value="N" required> No
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><p class="left-margin">(b) Rule 23 of ALRR</p></td>
                                                <td>
                                                    <label class="radio-inline text-success">
                                                        <input type="radio" name="ruleAlrr" value="Y" required> Yes
                                                    </label>
                                                    <label class="radio-inline text-danger">
                                                        <input type="radio" name="ruleAlrr" value="N" required> No
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><p class="left-margin">(c) Land Policy, 2019</p></td>
                                                <td>
                                                    <label class="radio-inline text-success">
                                                        <input type="radio" name="landPolicy" value="Y" required> Yes
                                                    </label>
                                                    <label class="radio-inline text-danger">
                                                        <input type="radio" name="landPolicy" value="N" required> No
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7) Rate of Premium (%age of Zonal Value)</td>
                                                <td>
                                                    <input type="number" min="0" max="100" maxlength="3"  class="form-control" name="premiumRate" placeholder="Percentage of Zonal Value" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8) Remarks</td>
                                                <td>
                                                    <textarea class="form-control" rows="3" name="assistantRemarks" required></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="verifyModalClose">NO</button>
                <button type="button" class="btn btn-danger btn-sm" id="revertCaseByAst">Revert</button>
                <button type="button" class="btn btn-success btn-sm" id="approveCasesByAst">Verify & Approve</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Case Verification jby ASO -->

<!-- Department button script -->
<script src="<?php echo base_url('js/department/department.js'); ?>"></script>


<!-- Btn-submit -->
<script>

var baseurl = "<?php echo base_url(); ?>";

    ////Approve Order By JS
    $('#approve_cases_to_ps_submit').on('click', () => {
        var dist_code = $('#dist_code').val();
        var subdiv_code = $('#subdiv_code').val();
        var cir_code = $('#cir_code').val();
        var mouza_pargona_code = $('#mouza_pargona_code').val();
        var lot_no = $('#lot_no').val();
        var vill_townprt_code = $('#vill_townprt_code').val();
        var case_no = $('#case_no').val();
        var petition_no = $('#petition_no').val();
        var approval_remarks = $('#approval_remarks').val();

        const caseData = {
        dist_code: dist_code,
        subdiv_code: subdiv_code,
        cir_code: cir_code,
        mouza_pargona_code: mouza_pargona_code,
        lot_no: lot_no,
        vill_townprt_code: vill_townprt_code,
        case_no: case_no,
        petition_no: petition_no,
        approval_remarks: approval_remarks,
        };

        console.log(caseData);
        $.ajax({
            url: baseurl + "DeptConversionNew/approveConversionByJs",
        type: "post",
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
            if (data.responseType == 1) {
            showWarningMessage(data.message);
            } else if (data.responseType == 2) {
            showSuccessMessage(data.message);
                location.reload();
            } else if (data.responseType == 3) {
            showErrorMessage("Data not found !");
            } else {
            showErrorMessage("SOMETHING WENT WRONG");
            }
        },
        data: JSON.stringify(caseData)
        });

    });


    ////Approve Order By PS
    $('#final_approve_ps').on('click', () => {
        var dist_code = $('#dist_code').val();
        var subdiv_code = $('#subdiv_code').val();
        var cir_code = $('#cir_code').val();
        var case_no = $('#case_no').val();
        var petition_no = $('#petition_no').val();
        var order_no = $('#dept_order_no').val();
        var order_date = $('#dept_order_date').val();

        const caseData = {
            dist_code: dist_code,
            subdiv_code: subdiv_code,
            cir_code: cir_code,
            case_no: case_no,
            petition_no: petition_no,
            order_no: order_no,
            order_date: order_date,
        };

        // console.log(caseData);return;
        $.ajax({
            url: baseurl + "DeptConversionNew/finalOrderByPs",
        type: "post",
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
            if (data.responseType == 1) {
            showWarningMessage(data.message);
            } else if (data.responseType == 2) {
            showSuccessMessage(data.message);
                location.reload();
            } else if (data.responseType == 3) {
            showErrorMessage("Data not found !");
            } else {
            showErrorMessage("SOMETHING WENT WRONG");
            }
        },
        data: JSON.stringify(caseData)
        });

    });


    ////Revert Order By PS
    $('#revert_cases_to_dc_submit').on('click', () => {
        var dist_code = $('#dist_code').val();
        var subdiv_code = $('#subdiv_code').val();
        var cir_code = $('#cir_code').val();
        var mouza_pargona_code = $('#mouza_pargona_code').val();
        var lot_no = $('#lot_no').val();
        var vill_townprt_code = $('#vill_townprt_code').val();
        var case_no = $('#case_no').val();
        var petition_no = $('#petition_no').val();
        var revert_remarks = $('#revert_remarks').val();

        const caseData = {
            dist_code: dist_code,
            subdiv_code: subdiv_code,
            cir_code: cir_code,
            mouza_pargona_code: mouza_pargona_code,
            lot_no: lot_no,
            vill_townprt_code: vill_townprt_code,
            case_no: case_no,
            petition_no: petition_no,
            revert_remarks: revert_remarks,
        };

        // console.log(caseData);return;
        $.ajax({
        url: baseurl + "DeptConversionNew/revertOrderByJs",
        type: "post",
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
            if (data.responseType == 1) {
            showWarningMessage(data.message);
            } else if (data.responseType == 2) {
            showSuccessMessage(data.message);
                location.reload();
            } else if (data.responseType == 3) {
            showErrorMessage("Data not found !");
            } else {
            showErrorMessage("SOMETHING WENT WRONG");
            }
        },
        data: JSON.stringify(caseData)
        });

    });

    $('#approveCasesByAst').click(function() {
        var formData = $("#astverificationForm").serializeArray();
        formData.push({ name: "verifyStatus", value: "A" });

        $.ajax({
            url: baseurl + "DeptConversionNew/verifyCasesByAssistant",
            type: 'POST',
            data: formData,
            dataType: "json",
            success: function(data) {
                if (data.responseType == 1) {
                showWarningMessage(data.message);
                } else if (data.responseType == 2) {
                showSuccessMessage(data.message);
                    location.reload();
                } else if (data.responseType == 3) {
                showErrorMessage("Data not found !");
                } else if(data.responseType == 4) {
                showValidationErrors(data.errors);
                }
                else {
                showErrorMessage("SOMETHING WENT WRONG");
                }
            },
            error: function(xhr, status, error) {
                alert('Form submission failed!');
            }
        });
    });


    $('#revertCaseByAst').click(function() {
        var formData = $("#astverificationForm").serializeArray();
        formData.push({ name: "verifyStatus", value: "R" });

        $.ajax({
            url: baseurl + "DeptConversionNew/verifyCasesByAssistant",
            type: 'POST',
            data: formData,
            dataType: "json",
            success: function(data) {
                if (data.responseType == 1) {
                showWarningMessage(data.message);
                } else if (data.responseType == 2) {
                showSuccessMessage(data.message);
                    location.reload();
                } else if (data.responseType == 3) {
                showErrorMessage("Data not found !");
                } else if(data.responseType == 4) {
                showValidationErrors(data.errors);
                }
                else {
                showErrorMessage("SOMETHING WENT WRONG");
                }
            },
            error: function(xhr, status, error) {
                alert('Form submission failed!');
            }
        });
    });

    // Success Message
    function showSuccessMessage(text) {
        Swal.fire({
        backdrop:true,
        allowOutsideClick: false,
        text: data.message,
        confirmButtonText: 'OK',
        customClass: {
            actions: 'my-actions',
            confirmButton: 'order-2',
        }
        }).then((result) => {
            if (result.isConfirmed) {
            location.reload(true);
        }
        });
    }

    // Error Message
    function showErrorMessage(text) {
        swal.fire({
            title: "Error!",
            text: text,
            icon: 'error',
            position: 'top',
            showConfirmButton: false,
            timer: 5000,
            showCancelButton: true
        });
    }

    // Warning Message
    function showWarningMessage(text) {
        swal.fire({
            // title: "Error!",
            text: text,
            icon: 'warning',
            position: 'top',
            showConfirmButton: false,
            timer: 5000,
            showCancelButton: true
        });
    }

    function showValidationErrors(errors) {
        let errorMessages = '<ul>';
        errors.forEach(error => {
            errorMessages += `<li><small class="text-danger">${error.message}</small></li>`;
        });
        errorMessages += '</ul>';

        Swal.fire({
            icon: 'warning',
            title: 'Field Required',
            html: errorMessages
        });
    }


    // function showValidationErrors(errors) {
    //     var html = '<ul>';
    //     $.each(errors, function(index, error) {
    //         html += '<li>' + error.message + '</li>';
    //     });
    //     html += '</ul>';
    //     showWarningMessage(html);
    // }




    ///////////Revert Modal///////////
    $(document).on('click', '#revert_conversion_js', function() {
        const modal = $('#conversionRevertModal').modal({
            backdrop: 'static',
            keyboard: false,
        });
        modal.fadeIn('slow').modal('show')   
    });

    ///////////Approve Modal////////////

    $(document).on('click', '#approve_send_to_ps', function() {
        const modal = $('#conversionApproveModal').modal({
            backdrop: 'static',
            keyboard: false,
        });
        modal.fadeIn('slow').modal('show')   
    });


    $(document).on('click', '#astVerification', function() {
        const modal = $('#astVerificationModal').modal({
            backdrop: 'static',
            keyboard: false,
        });
        modal.fadeIn('slow').modal('show')   
    });

    $(document).on('click', '#verifyModalClose', function () {
        $('#astVerificationModal').modal('hide');
    });


</script>


<script>
    var baseurl = "<?php echo base_url(); ?>";
    function forward_to_js_from_aso()
    {
        var case_no = $.trim($('#case_no_get').val());
        var dist_code = $.trim($('#dist_code_get').val());
        var verificationType = $.trim($('#verification_type_get').val());
        var remarks = $.trim($('#aso_remarks').val());
        const applicant = {
            case_no: case_no,
            district_id: dist_code,
            verificationType: verificationType,
            remarks: remarks
        };
        console.log(applicant);
        //alert(case_no);
            $.ajax({
            url: baseurl + "DeptConversionNew/sentConversionCasesFromASOtoJS",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            success: function(data) {
                if (data.responseType == 1) {
                    showErrorMessage(data.message);
                } else if (data.responseType == 2) {              
                    Swal.fire({
                        backdrop:true,
                        allowOutsideClick: false,
                        text: data.message,
                        confirmButtonText: 'OK',
                        customClass: {
                            actions: 'my-actions',
                            confirmButton: 'order-2',
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "<?=base_url('pending-conversion-cases-new')?>";
                            // location.reload(true);
                            // $('#datatableConversionCaseList').DataTable().ajax.reload(null, false);
                            // $('#markVerificationModal').modal('hide');
                        }
                    });
                } else if (data.responseType == 3) {
                    Swal.fire({
                        html: data.message,
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    });
                } else {
                    showErrorMessage("List Not Generated.");
                }
            },
            data: JSON.stringify(applicant)
        });
    }
</script>