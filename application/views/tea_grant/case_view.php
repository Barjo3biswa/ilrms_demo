<style>
    .datepick-popup {
        position: fixed;
        left: 0;
        right: 0;
        z-index: 10000;
    }

    .tab-content .card:hover {
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }

    .tab-content .card {
        box-shadow: none !important;
    }

    .wizard {
        margin: 10px auto;
    }

    .wizard .nav-tabs {
        position: relative;
        margin: 0 auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
        padding-top: 10px;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

    .wizard .nav-tabs > li > a,
    .wizard .nav-tabs > li > a:hover,
    .wizard .nav-tabs > li > a:focus {
        color: #fff;
        cursor: default;
        border: 0;
        background-color: #005B96 !important;
        text-decoration: none;
    }

    .wizard li {
        background: #005B96;
        padding: 0;
        box-shadow: 1px 0px 1px 1px;
    }

    .wizard li:after {
        content: " ";
        position: absolute;
        left: 46%;
        margin: 0 auto;
        bottom: 0;
        border: 5px solid transparent;
        transition: 0.1s ease-in-out;
    }

    .wizard li:after {
        content: " ";
        position: absolute;
        left: 45%;
        margin: 0 auto;
        bottom: 0;
        border: 10px solid transparent;
        border-bottom-color: #ffffff;
    }

    .wizard .nav-tabs > li {
        width: 16%;
        border: none;
    }

    .wizard .nav-tabs > li a {
        text-align: center;
        margin-bottom: 10px;
    }

    .wizard .nav-tabs > li a:hover {
        background-color: transparent !important;
    }

    div.lm-report > div:nth-of-type(odd) {
        background: #f2fdff;
    }

    .buttInfo {
        color: #FFF;
        background-color: #03a9f4;
    }

    .buttPrimary {
        color: #FFF;
        background-color: #673AB7;
    }

    .buttDanger {
        color: #FFF;
        background-color: #EF5350;
    }

    .buttCust {
        color: #FFF;
        background-color: #795548;
    }

    .rezaButt:hover {
        color: #0c0c0c;
    }

    .rezaButt {
        display: inline-block;
        position: relative;
        cursor: pointer;
        height: 35px;
        min-width: 150px;
        line-height: 35px;
        padding: 0 1.5rem;
        font-size: 15px;
        font-weight: 600;
        font-family: "Roboto", sans-serif;
        letter-spacing: 0.8px;
        text-align: center;
        text-transform: uppercase;
        border-radius: 2px;
        transition: all 0.3s ease-out;
    }

    .reza-card {
        background: #fff;
        border-radius: 2px;
        display: inline-block;
        position: relative;
        width: 100%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
    }

    .reza-title {
        font-weight: bold;
        font-size: 18px;
        margin: 10px 0;
        background: linear-gradient(to right, #267871, #136a8a);
        color: white;
        text-transform: capitalize;
        text-align: center;
        padding: 8px;
    }

    .reza-body {
        padding: 10px 20px 40px 20px;
    }

    .bgheading {
        background-color: #248cf7 !important;
    }

    .tableCard {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
        padding: 15px;
        margin-bottom: 15px;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 4px;
    }

    .timeline {
        max-width: 830px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        position: relative;
        padding: 15px 0;
    }

    .timeline::after {
        content: "";
        position: absolute;
        width: 3px;
        background-color: #848892;
        height: 100%;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
    }

    .timeline__content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 18px 30px;
        background-color: white;
        border-radius: 5px;
        position: relative;
        width: 386px;
        box-shadow: 0 2px 8px 0 #242e4c59;
    }

    .timeline__content::after {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        background-color: white;
        top: 50%;
        transform: translateY(-50%) rotate(45deg);
    }

    .timeline__content::before {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        transform: translateY(-50%);
    }

    .timeline__content:nth-child(odd) {
        margin-left: auto;
    }

    .timeline__content:nth-child(even) {
        align-items: flex-end;
    }

    .content_tag {
        position: absolute;
        top: 5px;
        padding: 6px 10px;
        background-color: #66BB6A;
        border-radius: 3px;
        font-weight: bold;
        font-size: 14px;
        color: #1f1f1f;
    }

    .content_date {
        margin-bottom: 10px;
        font-weight: bold;
        font-size: 14px;
        color: #848892;
    }

    .tree {
        min-height: 20px;
        padding: 19px;
        margin-bottom: 20px;
        background-color: #fbfbfb;
        border: 1px solid #999;
        border-radius: 4px;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
    }

    .tree li {
        list-style-type: none;
        margin: 0;
        padding: 10px 5px 0 5px;
        position: relative;
    }

    .tree li::before,
    .tree li::after {
        content: "";
        left: -20px;
        position: absolute;
    }

    .tree li::before {
        border-left: 1px solid #999;
        bottom: 50px;
        height: 100%;
        top: 0;
        width: 1px;
    }

    .tree li::after {
        border-top: 1px solid #999;
        height: 20px;
        top: 25px;
        width: 25px;
    }

    .tree li span {
        border: 1px solid #999;
        border-radius: 5px;
        display: inline-block;
        padding: 3px 8px;
    }

    .tree li.parent_li > span:hover,
    .tree li.parent_li > span:hover + ul li span {
        background: #eee;
        border: 1px solid #94a0b4;
        color: #000;
    }

    .badge-reza1 {
        background-color: #F44336;
    }

    .badge-reza2 {
        background-color: #2E7D32;
    }

    .badge-reza3 {
        background-color: #9C27B0;
    }
</style>
<div class="col-lg-10 offset-1 mb-5">
    <?php 
        if((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))){
            $lessa_chatak='Chatak'; }
        else{
            $lessa_chatak='Lessa';
        }
    ?>
    <div class="vertical-view-section" role="tabpanel" id="step1">
        <h5 class="bgheading p-2 mt-5 text-white shadow" style="background: #248cf7 !important; margin-top: 10px">
            Limited Conversion of Tea Grant Land to Periodic Patta (
            <small><span class="bg-warning"><?=$_GET['case_no']?> , <?=$basic['applid']?></span></small> )
        </h5>
        <div class="reza-card mb-3">
            <div class="reza-body">
                <!-- Application Details  -->
                <h5 class="reza-title" style="margin-top: 15px">
                    <i class="fa fa-file-text"></i>  Application Details
                </h5>
                <div class="tableCard">
                    <div class="row justify-content-center">
                        <?php 
                        if(isset($base64_decoded_adhar_file)){
                            ?>
                            <div class="col-md-2">
                                <?=$base64_decoded_adhar_file;?>
                            </div>
                        <?php }?>
                        <div class="col-md-10">
                            <table class="table table-bordered">
                                <?php
                                    foreach ($applicants_buyers as $identity):
                                        if($identity->is_applicant == 1){
                                            ?>
                                            <tr>
                                                <th>
                                                    Name in <?=$identity->identity_type?>
                                                </th>
                                                <td>
                                                <strong class="alert-warning"><?=$identity->eng_pdar_name?></strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><?=$identity->identity_type?> Verified</th>
                                                <td>
                                                <strong class="alert-warning"> <?php if(!empty($identity->identity_ref_no)) {echo 'Yes';}?></strong>
                                                </td>
                                            </tr>
                                        <?php }
                                    endforeach;
                                ?>                                    
                                <tr>
                                    <th>Occupation or Profession of the applicant</th>
                                    <td>
                                        <strong class="alert-warning"><?=$basic["occupation_applicant"]?></strong>
                                    </td>
                                </tr>
                                <?php 
                                    if($basic['protected_class']):
                                ?>
                                <tr>
                                    <th>Select if you fall under protected category?</th>
                                    <td>
                                        <input type="hidden" name="protected_class" value="<?=$basic['protected_class']?>" class="form-control">
                                        <strong class="alert-warning">
                                            <?php
                                            foreach(json_decode(PROTECTED_CLASS) as $class12){


                                                if($class12->CODE == $basic['protected_class']){
                                                    echo $class12->NAME;
                                                }
                                            }
                                            ?>
                                        </strong>
                                    </td>
                                </tr>
                                <?php endif;?>
                                <tr>
                                    <th>Caste</th>
                                    <td>
                                        <input type="hidden" name="caste" value="<?=$basic["caste"]?>" class="form-control">
                                        <strong class="alert-warning"><?php
                                            foreach(json_decode(CASTE) as $caste){
                                                if($caste->CODE == $basic["caste"]){
                                                    echo $caste->NAME;
                                                }
                                            }
                                            ?></strong>
                                    </td>
                                </tr>
                                <?php if (isset($backup_under_tribe_belts)) { ?>
                                <tr>
                                    <th>Whether the proposed land falls under Tribal Belt/ Block?</th>
                                    <td>
                                        <strong class="alert-warning"><?php
                                            if($backup_under_tribe_belts == '1'){
                                                ?>
                                                YES
                                                <?php
                                            }else{
                                                ?>
                                                NO
                                                <?php
                                            }
                                            ?></strong>
                                    </td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Address Information  -->
                <h5 class="reza-title" style="margin-top: 50px">
                    <i class="fa fa-map-marker"></i> Address Information
                </h5>
                <div class="tableCard">
                    <table class="table table-bordered">
                        <tr>
                            <th>District Name:</th>
                            <td class="text-warning">
                                <strong class="alert-warning">
                                    <?=$this->utilclass->getDistrictName($basic["dist_code"])?>
                                </strong>
                            </td>
                            <th>Subdivision Name:</th>
                            <td class="text-warning">
                                <strong class="alert-warning">
                                    <?=$this->utilclass->getSubDivName($basic["dist_code"], $basic["subdiv_code"])?>
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <th>Circle Name: </th>
                            <td class="text-warning">
                                <strong class="alert-warning">
                                    <?=$this->utilclass->getCircleName($basic["dist_code"], $basic["subdiv_code"], $basic["cir_code"])?>
                                </strong>
                            </td>
                            <th>Mouza Name: </th>
                            <td class="text-warning">
                                <strong class="alert-warning">
                                    <?=$this->utilclass->getMouzaName($basic["dist_code"], $basic["subdiv_code"], $basic["cir_code"], $basic["mouza_pargona_code"])?>
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <th>Village Name: </th>
                            <td class="text-warning">
                                <strong class="alert-warning">
                                    <?=$this->utilclass->getVillageName($basic["dist_code"], $basic["subdiv_code"], $basic["cir_code"], $basic["mouza_pargona_code"], $basic["lot_no"], $basic["vill_townprt_code"])?>
                                </strong>
                            </td>
                        </tr>
                    </table>
                </div>

                <h5 class="reza-title" style="margin-top: 50px">
                    <i class="fa fa-pencil-square-o"></i> Self declaration details
                    <button class="btn btn-sm btn-warning btn-api-call" onclick="SelfAndDocument('<?=$basic['dist_code']?>')" type="button"><i class="fa fa-university"></i>&nbsp;View Self declaration</button>
                </h5>
                <div class="tableCard">
                    <table class="table table-bordered" id="selfdeclaration">                        
                    </table>
                </div>
                <h5 class="reza-title" style="margin-top: 50px">
                    <i class="fa fa-user"></i>  Applicant details
                </h5>
                <?php $i = 1;foreach ($applicants_buyers as $settlement): ?>
                    <div class="tableCard">
                        <table class="table table-bordered">
                            <tr >
                                <th rowspan="6" style="vertical-align : middle;text-align:center; min-width: 4%!important; max-width: 4%!important; width: 4%">
                                    <?=$i;?>
                                </th>
                                <th style="max-width: 18%!important; min-width: 18%!important; width: 18%">Applicant Name ( Assamese)</th>
                                <td style="max-width: 30%!important; min-width: 30%!important; width: 30%!important;">
                                    <strong class="alert-warning">
                                        <?=$settlement->pdar_name;?>
                                    </strong>
                                </td>
                                <th style="max-width: 18%!important; min-width: 18%!important; width: 18%">Guardian name (Assamese)</th>
                                <td style="max-width: 30%!important; min-width: 30%!important; width: 30%!important;">
                                    <strong class="alert-warning">
                                        <?=$settlement->pdar_guardian;?>
                                    </strong>
                                </td>
                            </tr>

                            <tr>
                                <th>Applicant Name (English)</th>
                                <td>
                                    <strong class="alert-warning">
                                        <?=$settlement->eng_pdar_name;?>
                                    </strong>
                                </td>
                                <th>Guardian Name (English)</th>
                                <td>
                                    <strong class="alert-warning">
                                        <?=$settlement->eng_pdar_guardian;?>
                                    </strong>
                                </td>
                            </tr>
                            
                            <tr>
                                <th>Relation</th>
                                <td>
                                    <strong class="alert-warning">
                                        <?php
                                        foreach ($guar_rel as $guar_rel_list) {
                                            if ($guar_rel_list->id == $settlement->pdar_rel_guar) { 
                                                echo $guar_rel_list->guard_rel_desc_as;
                                            }
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
                                <?php if($settlement->is_applicant == 1): ?>
                                <th>Marital Status</th>
                                <td>
                                    <strong class="alert-warning">
                                    <?php
                                        foreach(json_decode(MARITAL_STATUS) as $marital_stat){
                                            if($marital_stat->CODE == $settlement->marital_status){
                                            ?>
                                                <?=$marital_stat->NAME?>
                                            <?php
                                        } }
                                    ?>
                                    </strong>
                                </td>
                                <?php endif;?>
                                <th>Mobile</th>
                                <td>
                                    <strong class="alert-warning">
                                        <?=$settlement->pdar_mobile?>
                                    </strong>
                                </td>
                            
                            </tr>
                            
                            <tr>
                                <th>DOB</th>
                                <td>
                                    <strong class="alert-warning">
                                        <?=$settlement->dob?>
                                    </strong>
                                </td>
                                <?php if($settlement->is_applicant == 1) { ?>
                                    <th>Possession Since</th>
                                    <td>
                                        <strong class="alert-warning">
                                            <?=$settlement->period_possession?>
                                        </strong>
                                    </td>
                                <?php } ?>
                            </tr>

                            <?php

                                $pre_addr = json_decode($settlement->pdar_add1);
                                $per_addr = json_decode($settlement->pdar_add2);
                            ?>


                            <tr>
                                <th>Present address</th>
                                <td>
                                    <strong class="alert-warning">
                                        <?=$pre_addr->address?>
                                    </strong>
                                </td>
                                <th>
                                    Permanent address
                                </th>
                                <td>
                                    <strong class="alert-warning">
                                        <?=$per_addr->address?>
                                    </strong>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <?php $i++;?>
                <?php endforeach;?>

                <?php if (!empty($nominee)) {?>
                    <h5 class="reza-title" style="margin-top: 50px">
                        <i class="fa fa-users"></i>  Family Details
                    </h5>
                    <div class="tableCard">
                        <table class="table  table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Relation</th>
                                <th>Address</th>
                                <th>Mobile number</th>
                            </tr>
                            <?php $i = 1;foreach ($nominee as $kin): ?>
                                    <tr id="sp<?=$kin->id?>">
                                        <td>
                                            <input type="text" readonly name="kin_name" value="<?=$kin->nominee_name?>" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" readonly name="kin_relation" value="<?=$this->utilclass->appRelationbyIDMB2($basic['dist_code'],$kin->relation)?>" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" readonly class="form-control" value="<?=$kin->address?>" name="kin_address">
                                        </td>
                                        <td>
                                            <input type="text" readonly name="kin_contact_no" value="<?=$kin->mobile_no?>" class="form-control">
                                        </td>

                                    </tr>
                                <?php $i++;?>
                                <?php endforeach;?>
                        </table>
                    </div>
                <?php }?>
                <h5 class="reza-title" style="margin-top: 50px">
                    <i class="fa fa-map"></i>  Area Details
                </h5>
                <div class="tableCard">
                    <table class="table">
                        <thead class="thead-warning">
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th class="text-center">Bigha</th>
                                <th class="text-center">Katha</th>
                                <th class="text-center"><?=$lessa_chatak?></th>
                                <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))): ?>
                                <th class="text-center">Ganda</th>
                                <th class="text-center">Kranti</th>
                                <?php endif; ?>
                            </tr>

                            <?php foreach ($dags as $all_dags) {?>

                            <tr class="bg-white">
                                <th rowspan="2" style="vertical-align : middle;">
                                    <div class="vertical">
                                        DAG : <span class="text-danger"><?=$all_dags->dag_no?></span> <br> 
                                        PATTA : <span class="text-danger"><?=$all_dags->patta_no?> <br> <?=$this->utilclass->getPattaType($all_dags->patta_type_code)?></span>
                                    </div>
                                </th>
                                <td><strong>Total Land Area in Selected Dag</strong></td>
                                <td style="text-align: center;">
                                    <strong><?=$all_dags->dag_area_b?></strong>
                                    <input type="hidden" readonly style="text-align: center;" name="dag_area_b" class="form-control input-sm" value="<?=$all_dags->dag_area_b?>" >
                                </td>
                                <td style="text-align: center;">
                                    <strong><?=$all_dags->dag_area_k?></strong>
                                    <input type="hidden" readonly style="text-align: center;" name="dag_area_k" value="<?=$all_dags->dag_area_k?>" class="form-control input-sm" >
                                </td>
                                <td style="text-align: center;">
                                    <strong><?=$all_dags->dag_area_lc?></strong>
                                    <input type="hidden" readonly style="text-align: center;" name="dag_area_lc" class="form-control input-sm" value="<?=$all_dags->dag_area_lc?>" >
                                </td>
                                <?php if((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))): ?>
                                    <td style="text-align: center;">
                                        <strong><?=$all_dags->dag_area_g?></strong>
                                        <input type="hidden" readonly style="text-align: center;" value="<?=$all_dags->dag_area_g?>" class="form-control input-sm" name="dag_area_g" >
                                    </td>
                                    <td class="hide" style="text-align: center;">
                                        <strong><?=$all_dags->dag_area_kr?></strong>
                                        <input type="hidden" readonly style="text-align: center;" value="<?=$all_dags->dag_area_kr?>" class="form-control input-sm" name="dag_area_kr" >
                                    </td>
                                <?php endif ; ?>
                            </tr>

                            

                            <!-- area settlement homestead -->
                            <?php $hide = 'area_';
                                if ($all_dags->land_type == 3 || $all_dags->land_type == 1) {
                                    $hide = 'area_';
                                } else {
                                    $hide = 'area_hide';
                                }
                            ?>
                            <tr class='<?=$hide?>' class="bg-white">
                                <td class="settlement-area-color"><strong>Applied Area</strong></td>
                                <td class="settlement-area-color" style="text-align:center">
                                    <strong><?=$all_dags->s_dag_area_b?></strong>
                                    <input type="hidden" style="text-align: center;" name="home_b" class="form-control input-sm home_b" value="<?=$all_dags->s_dag_area_b?>" readonly>
                                </td>
                                <td class="settlement-area-color" style="text-align:center">
                                    <strong><?=$all_dags->s_dag_area_k?></strong>
                                    <input type="hidden" style="text-align: center;" name="home_k" value="<?=$all_dags->s_dag_area_k?>" class="form-control input-sm home_k" readonly>
                                </td>
                                <td class="settlement-area-color" style="text-align:center">
                                    <strong><?=$all_dags->s_dag_area_lc?></strong>
                                    <input type="hidden" style="text-align: center;" name="home_lc" value="<?=$all_dags->s_dag_area_lc?>" class="form-control input-sm home_lc" readonly>
                                </td>
                                <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))): ?>
                                    <td class="settlement-area-color" style="text-align:center">
                                        <strong><?=$all_dags->s_dag_area_g?></strong>
                                        <input type="hidden" style="text-align: center;" value="<?=$all_dags->s_dag_area_g?>" class="form-control input-sm s_dag_area_g" name="home_g" readonly>
                                    </td>
                                    <td class="settlement-area-color" style="text-align:center">
                                        <strong><?=$all_dags->s_dag_area_kr?></strong>
                                        <input type="hidden" style="text-align: center;" value="<?=$all_dags->s_dag_area_kr?>" class="form-control input-sm s_dag_area_g" name="home_kr" readonly>
                                    </td>
                                <?php endif; ?>
                            </tr>

                            <?php } ?>

                            <th rowspan="2">
                            </th>

                            <?php

                                $total_applied_bigha  = 0;
                                $total_applied_katha  = 0;
                                $total_applied_lessa  = 0;
                                $total_applied_ganda  = 0;
                                $total_applied_kranti = 0;

                                foreach ($dags as $all_dags) 
                                {
                                    $total_applied_bigha = $total_applied_bigha + $all_dags->s_dag_area_b;
                                    $total_applied_katha = $total_applied_katha + $all_dags->s_dag_area_k;
                                    $total_applied_lessa = $total_applied_lessa + $all_dags->s_dag_area_lc;
                                    $total_applied_ganda = $total_applied_ganda + $all_dags->s_dag_area_g;
                                    $total_applied_kranti = $total_applied_kranti + $all_dags->s_dag_area_kr;
                                }

                                if((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))) 
                                {
                                    $convert_area = floor(($total_applied_bigha * 6400) + ($total_applied_katha * 320) + 
                                        ($total_applied_lessa * 20) + 
                                        $total_applied_ganda);

                                    $total_applied_bigha = floor($convert_area / 6400);

                                    $total_applied_katha = floor(($convert_area - ($total_applied_bigha * 6400))/320);

                                    $total_applied_lessa = floor(($convert_area - ($total_applied_bigha * 6400 + $total_applied_katha * 320))/20);

                                    $total_applied_ganda = number_format($convert_area - ($total_applied_bigha * 6400 + $total_applied_katha * 320 + $total_applied_lessa * 20), 2);

                                    $total_applied_kranti = 0;
                                }
                                else
                                {
                                    $convert_area = ($total_applied_bigha * 100) + 
                                                ($total_applied_katha * 20) + 
                                                $total_applied_lessa;

                                    $total_applied_bigha = floor($convert_area / 100);

                                    $total_applied_katha = floor(($convert_area - ($total_applied_bigha * 100))/20);

                                    $total_applied_lessa = number_format($convert_area - ($total_applied_bigha * 100 + $total_applied_katha * 20), 2);

                                    $total_applied_ganda  = 0;

                                    $total_applied_kranti = 0;
                                }

                            ?>                                                

                            <tr class='<?=$hide?>' class="bg-white">
                                <td class="settlement-area-color text-danger"><strong>Total Applied Area</strong></td>
                                <td class="settlement-area-color text-danger" style="text-align:center">
                                    <strong><?=$total_applied_bigha?></strong>
                                    <input type="hidden" style="text-align: center;" name="tot_applied_b" class="form-control input-sm tot_applied_b" 
                                    value="<?=$total_applied_bigha?>" id="tot_applied_b" readonly>
                                </td>
                                <td class="settlement-area-color text-danger" style="text-align:center">
                                    <strong><?=$total_applied_katha?></strong>
                                    <input type="hidden" style="text-align: center;" name="tot_applied_k" value="<?=$total_applied_katha?>" class="form-control input-sm tot_applied_k" id="tot_applied_k" readonly>
                                </td>
                                <td class="settlement-area-color text-danger" style="text-align:center">
                                    <strong><?=$total_applied_lessa?></strong>
                                    <input type="hidden" style="text-align: center;" name="tot_applied_lc" value="<?=$total_applied_lessa?>" class="form-control input-sm tot_applied_lc" id="tot_applied_lc" readonly>
                                </td>
                                <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))): ?>
                                    <td class="settlement-area-color text-danger" style="text-align:center">
                                        <strong><?=$total_applied_ganda?></strong>
                                        <input type="hidden" style="text-align: center;" value="<?=$total_applied_ganda?>" class="form-control input-sm tot_applied_g" name="tot_applied_g"
                                        id="tot_applied_g" readonly>
                                    </td>
                                    <td class="settlement-area-color text-danger" style="text-align:center">
                                        <strong><?=$total_applied_kranti?></strong>
                                        <input type="hidden" style="text-align: center;" value="<?=$total_applied_kranti?>" class="form-control input-sm tot_applied_kr" name="tot_applied_kr" id="tot_applied_kr"
                                        readonly>
                                    </td>
                                <?php endif; ?>
                            </tr>

                        </thead>
                    </table>
                    
                </div>


                <!-- additional property -->
                <?php if(isset($additional_property) && !empty($additional_property)) { ?>
                    <h5  class="reza-title" style="margin-top: 50px">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Additional Property Details
                    </h5>
                    <div class="tableCard">
                        <table class="table table-bordered">
                            <?php $i=1; foreach($additional_property as $adp): ?>
                                <tr>
                                    <th>District Name:</th>
                                    <td class="text-warning">
                                        <strong class="alert-warning">
                                            <input type="text" name="a_dist_name" class="form-control input-sm" value='<?=$this->utilclass->getDistrictName($adp->dist_code)?>' readonly>
                                        </strong>
                                    </td>
                                    <th>Subdivision Name:</th>
                                    <td class="text-warning">
                                        <strong class="alert-warning">
                                            <input type="text" name="a_subdiv_name" class="form-control input-sm" value='<?=$this->utilclass->getSubDivName($adp->dist_code,$adp->subdiv_code)?>' readonly>
                                        </strong>
                                    </td>
                                    <th>Circle Name: </th>
                                    <td class="text-warning">
                                        <strong class="alert-warning">
                                            <input type="text" name="a_circle_name" value='<?=$this->utilclass->getCircleName($adp->dist_code,$adp->subdiv_code,$adp->cir_code)?>' class="form-control input-sm" readonly>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mouza Name: </th>
                                    <td class="text-warning">
                                        <strong class="alert-warning">
                                            <input type="text" name="a_mouza_name" class="form-control input-sm" value='<?=$this->utilclass->getMouzaName($adp->dist_code,$adp->subdiv_code,$adp->cir_code,$adp->mouza_pargona_code)?>' readonly>
                                        </strong>
                                    </td>
                                    <th>Village Name: </th>
                                    <td class="text-warning">
                                        <strong class="alert-warning">
                                            <input type="text" name="a_village_name" value='<?=$this->utilclass->getVillageName($adp->dist_code,$adp->subdiv_code,$adp->cir_code,$adp->mouza_pargona_code,$adp->lot_no,$adp->vill_townprt_code)?>' class="form-control input-sm" readonly>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dag Number:</th>
                                    <td>
                                        <strong class="alert-warning">
                                            <input type="text" name="a_dag_no" value='<?=$adp->dag_no?>' class="form-control input-sm" readonly>
                                        </strong>
                                    </td>
                                    <th>Patta Number:</th>
                                    <td>
                                        <strong class="alert-warning">
                                            <input type="text" name="a_patta_no" class="form-control input-sm" value='<?=$adp->patta_no;?>' readonly>
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Total Additional Land Details</th>
                                    <td>
                                        <span class="input-group-addon">Bigha</span>
                                        <strong>
                                            <input type="text" style="text-align: center;" name="a_bigha" class="form-control input-sm" value="<?=$adp->bigha?>" readonly>
                                        </strong>
                                    </td>
                                    <td>
                                        <span class="input-group-addon">Katha</span>
                                        <input type="text" style="text-align: center;" name="a_katha" value="<?=$adp->katha?>" class="form-control input-sm" readonly>
                                    </td>
                                    <td>
                                        <span class="input-group-addon">Lessa</span>
                                        <input type="text" style="text-align: center;" name="a_lessa" class="form-control input-sm" value="<?=$adp->lessa?>" readonly>
                                    </td>
                                    <?php if((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))): ?>
                                        <td>
                                            <span class="input-group-addon">Ganda</span>
                                            <input type="text" style="text-align: center;" value="<?=$adp->ganda?>" class="form-control input-sm" name="a_ganda" readonly>
                                        </td>
                                        <td>
                                            <span class="input-group-addon">Kranti</span>
                                            <input type="text" style="text-align: center;" value="<?=$adp->kranti?>" class="form-control input-sm" name="a_kranti" readonly>
                                        </td>
                                    <?php endif ; ?>
                                </tr>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php } ?>

                <!-- additional property end -->

                <!-- existing pattadar starts here -->
                <h5 class="reza-title" style="margin-top: 50px">
                    <i class="fa fa-users"></i>  Existing Pattadar
                </h5>
                <?php if(!empty($existing_pattadar)) { ?>
                    <div class="tableCard">
                        <table class="table table-bordered" id="existingPattadar">
                            <tr>
                                <th>Name</th>
                                <th>Guardian Name</th>
                                <th>Contact No</th>
                            </tr>
                            <?php $i = 1;foreach ($existing_pattadar as $ep): ?>
                                <tr id="sp<?=$ep->id?>">
                                    <td>
                                        <span><?=$ep->pdar_name?></span>
                                    </td>
                                    <td>
                                        <span><?=$ep->pdar_guardian?></span>
                                    </td>
                                    <td>
                                        <span><?=$ep->pdar_mobile?></span>
                                    </td>
                                </tr>
                                <?php $i++;?>
                            <?php endforeach;?>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="tableCard familyVisibleHide">
                        <table class="table table-bordered" id="existingPattadar">
                            <tr>
                                <th>Name</th>
                                <th>Guardian Name</th>
                                <th>Contact No</th>
                            </tr>
                        </table>
                    </div>
                <?php } ?>
                <!-- existing pattadar ends here -->

                <!-- deed applicant starts here -->
                <h5 class="reza-title" style="margin-top: 50px">
                    <i class="fa fa-users"></i>  Deed Applicant
                </h5>
                <?php if(!empty($deed_applicant)) { ?>
                    <div class="tableCard">
                        <table class="table table-bordered" id="deedApplicant">
                            <tr>
                                <th>Name</th>
                                <th>Guardian Name</th>
                                <th>Gender</th>
                                <th>Contact No</th>
                                <th>DOB</th>
                            </tr>
                            <?php 

                                $i = 1;foreach ($deed_applicant as $da): 
                                if($da->pdar_gender == 1)
                                {
                                    $gender = "Male";
                                }
                                else if($da->pdar_gender == 2)
                                {
                                    $gender = "Female";
                                }
                                else
                                {
                                    $gender = "Others";
                                }

                            ?>
                                <tr id="sp<?=$da->id?>">
                                    <td>
                                        <span><?=$da->eng_pdar_name.'/'.$da->pdar_name?></span>
                                    </td>
                                    <td>
                                        <span><?=$da->eng_pdar_guardian.'/'.$da->pdar_guardian?></span>
                                    </td>
                                    <td>
                                        <span><?=$gender?></span>
                                    </td>
                                    <td>
                                        <span><?=$da->pdar_mobile?></span>
                                    </td>
                                    <td>
                                        <span><?=$da->dob?></span>
                                    </td>
                                </tr>
                                <?php $i++;?>
                            <?php endforeach;?>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="tableCard familyVisibleHide">
                        <table class="table table-bordered" id="deedApplicant">
                            <tr>
                                <th>Name</th>
                                <th>Guardian Name</th>
                                <th>Gender</th>
                                <th>Contact No</th>
                                <th>DOB</th>
                            </tr>
                        </table>
                    </div>
                <?php } ?>
                <!-- deed applicant ends here -->
                <!-- family tree starts here -->
                <h5 class="reza-title" style="margin-top: 50px">
                    <i class="fa fa-users"></i>  Family Tree
                </h5>
                <?php if(!empty($family_tree)) { ?>
                    <div class="tableCard">
                        <table class="table table-bordered" id="familyTree">
                            <tr>
                                <th>Name</th>
                                <th>Guardian Name</th>
                                <th>Relation</th>
                            </tr>
                            <?php 

                                $i = 1;foreach ($family_tree as $ft): 

                                if($ft->pdar_type=='P')
                                {
                                    $relation = 'Parent';
                                }
                                if($ft->pdar_type=='GP')
                                {
                                    $relation = 'Grand Parent';
                                }
                                if($ft->pdar_type=='GPP')
                                {
                                    $relation = 'Great Grand Parent';
                                }

                            ?>
                                <tr id="sp<?=$ft->id?>">
                                    <td>
                                        <span><?=$ft->eng_pdar_name.'/'.$ft->pdar_name?></span>
                                    </td>
                                    <td>
                                        <span><?=$ft->eng_pdar_guardian.'/'.$ft->pdar_guardian?></span>
                                    </td>
                                    <td>
                                        <span><?=$relation?></span>
                                    </td>
                                </tr>
                                <?php $i++;?>
                            <?php endforeach;?>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="tableCard familyVisibleHide">
                        <table class="table table-bordered" id="familyTree">
                            <tr>
                                <th>Name</th>
                                <th>Guardian Name</th>
                                <th>Relation</th>
                            </tr>
                        </table>
                    </div>
                <?php } ?>
                <!-- family tree ends here -->
                <!--- Nominee details starts here --mdz- --->
                <h5 class="reza-title" style="margin-top: 50px">
                    <i class="fa fa-users"></i>  Family Details            
                </h5>
                <?php if(!empty($nominee)) { ?>
                    <div class="tableCard">
                        <table class="table table-bordered" id="listNextOfKin">
                            <tr>
                                <th>Nominee name</th>
                                <th>Relation with Applicant</th>
                                <th>Address of Nominee</th>
                                <th>Mobile number</th>
                            </tr>
                            <?php $i = 1;foreach ($nominee as $kin): ?>
                                <tr id="sp<?=$kin->id?>">
                                    <td>
                                        <input type="text" readonly name="kin_name" value="<?=$kin->nominee_name?>" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" readonly name="kin_relation" value="<?=$this->utilclass->appRelationbyIDMB2($basic['dist_code'],$kin->relation)?>" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" readonly class="form-control" value="<?=$kin->address?>" name="kin_address">
                                    </td>
                                    <td>
                                        <input type="text" readonly name="kin_contact_no" value="<?=$kin->mobile_no?>" class="form-control">
                                    </td>
                                    <td>
                                    
                                    </td>
                                </tr>
                                <?php $i++;?>
                            <?php endforeach;?>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="tableCard familyVisibleHide">
                        <table class="table table-bordered" id="listNextOfKin">
                            <tr>
                                <th>Nominee name</th>
                                <th>Relation with Applicant</th>
                                <th>Address of Nominee</th>
                                <th>Mobile number</th>
                            </tr>
                        </table>
                    </div>
                <?php } ?>
                <!--- Nominee details ends here --mdz- --->

                <h5 class="reza-title" style="margin-top: 50px">
                    <i class="fa fa-file-pdf-o"></i> Supporting Documents
                    <button class="btn btn-sm btn-warning btn-api-call" onclick="SelfAndDocument('<?=$basic['dist_code']?>')" type="button"><i class="fa fa-university"></i>&nbsp;View Supporting Documents</button>
                </h5>
                <div class="tableCard">
                    <table class="table table-bordered" id="apidoc">
                        <?php //foreach ($document as $d): ?>
                            <!-- <tr>
                                <th>
                                    <a target='download' href="<?php echo base_url(); ?>index.php/SettlementCommon/document/<?=$d->name;?>"><i class="fa fa-paperclip"></i> <?=$d->file_details;?></a>
                                    <input type="hidden" name="file_name" value="<?=$d->name;?>">
                                    <input type="hidden" name="file_type" value="<?=$d->content_type;?>">
                                    <input type="hidden" name="file_path" value="<?=$d->path;?>">
                                    <input type="hidden" name="file_details" value="<?=$d->file_details?>">
                                    <input type="hidden" name="mut_type" value="<?=$basic["service_code"]?>">
                                </th>
                            </tr> -->
                        <?php //endforeach;?>
                    </table>
                </div>
                <!-- <a href="#lm_report" onclick="lm()" class="btn btn-primary text-white">Go to LM report</a> -->
                 
            </div>
        </div>
        <!-- End of Tabs Navigation -->
    </div>
    <!-- LM reporting starts here -->
    <div class="vertical-view-section" role="tabpanel" id="step2">
        <div class="reza-card">
            <div class="reza-body ">
                <h5  class="reza-title" style="margin-top: 15px">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> LM Report
                </h5>
                <div class="tableCard">
                    <?php $sl_count =1; $i = 1;foreach ($lmnotes as $lmnote): 
                        if($validation_bypass == 0):
                        
                            ?>
                            <div class="row p-2" >
                                <div class="col-md-6">
                                    <span ><strong><?=$sl_count++?>.</strong> Chitha verified and found the applicant as a pattadar ?</span >
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check form-check-inline">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name="chiitha_verified"
                                                id="chiitha_verified1"
                                                value="YES" disabled <?php if ($lmnote->chitha_verified == YES) {echo "checked";}?>
                                        />
                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name="chiitha_verified"
                                                id="chiitha_verified2"
                                                value="NO" disabled <?php if ($lmnote->chitha_verified == NO) {echo "checked";}?>
                                        />
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                </div>                    
                            </div>                            
                            <div class="row p-2" >
                                <div class="col-md-6">
                                    <span ><strong><?=$sl_count++?>.</strong> Caste Verified: whether applicant belongs to the caste as mentioned in application as per the verification of the caste cerficate uploaded?</span><br>
                                    <?php if($basic['bhumiputra_certificate_no']){?>
                                        <label for="" class="alert-warning">Certificate/Ack number : <b><?=$basic['bhumiputra_certificate_no']?></b></label>
                                    <?php }else{ ?>
                                        <label for="" class="alert-warning">Certificate/Ack Not Available!</b></label>
                                    <?php }?>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check form-check-inline">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name="bhumiputra_confirmation_lm"
                                                id="bhumiputra_confirmation1"
                                                value="YES"
                                                disabled
                                            <?php if($lmnote->bhumiputra_confirmation == YES){echo "checked";} ?>

                                        />
                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name="bhumiputra_confirmation_lm"
                                                id="bhumiputra_confirmation2"
                                                value="NO"
                                                disabled
                                            <?php if($lmnote->bhumiputra_confirmation == NO){echo "checked";} ?>
                                        />
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <?php
                                    if($basic['bhumiputra_certificate_no']){?>
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                    <a href="<?php echo base_url();?>index.php/SettlementCommon/bhumiPutra?<?php
                                    
                                    if($basic['bhumiputra_certificate_no'] && $basic['bhumiputra_certificate_type'] == BHUMI_CERT){
                                        echo "cer_number=".$basic['bhumiputra_certificate_no'];
                                    }elseif($basic['bhumiputra_certificate_no'] && $basic['bhumiputra_certificate_type'] == BHUMI_ACK){
                                        echo "ack_number=".$basic['bhumiputra_certificate_no'];
                                    }?>" target="BhumiPutra">
                                        <u><span class="text-primary" style="font-size:16px;">View certificate</span></u>
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="row p-2" >
                                <div class="col-md-6">
                                    <span><strong><?=$sl_count++?>.</strong> Whether the proposed land falls under Tribal Belt/ Block?</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name="whether_tribal"
                                                id="whether_tribal1"
                                                value="YES"
                                                disabled
                                            <?php if ($lmnote->is_tribal_belt == YES) {echo "checked";}?>
                                        />
                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name="whether_tribal"
                                                id="whether_tribal2"
                                                value="NO"
                                                disabled
                                            <?php if ($lmnote->is_tribal_belt == NO) {echo "checked";}?>
                                        />
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-2">
                                <div class="col-md-6 text-justify">
                                    <span><strong><?=$sl_count++?>.</strong> Does the applicant falls under protected category as mentioned in that particular tribal belt/block and eligible under section 163(2)(a), 163(2)(b) ?</span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" name="" value="<?php
                                    foreach(json_decode(PROTECTED_CLASS) as $class){


                                        if($class->CODE == $lmnote->protected_class_lm){
                                            echo $class->NAME;
                                        }
                                    }
                                    ?>" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="row p-2" >
                                <div class="col-md-6">
                                    <span><strong><?=$sl_count++?>.</strong> Whether the area is vulnerable to landslide prone area ? </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name="landslide"
                                                id="landslide"
                                                value="YES"
                                                disabled
                                            <?php if ($lmnote->landslide == YES) {echo "checked";}?>
                                        />
                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name="landslide"
                                                id="landslide2"
                                                value="NO"
                                                disabled
                                            <?php if ($lmnote->landslide == NO) {echo "checked";}?>
                                        />
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-2" >
                                <div class="col-md-6">
                                    <span><strong><?=$sl_count++?>.</strong> Whether the land falls under erosion prone area ?</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name="erosion"
                                                value="YES" disabled <?php if (trim($lmnote->erosion) == YES){ echo "checked"; } ?>
                                        />
                                        <label class="form-check-label" for="inlineRadio1">YES</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name="erosion"
                                                value="NO" disabled <?php if (trim($lmnote->erosion) == NO){ echo "checked"; } ?>
                                        />
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-2">
                                <div class="col-md-6">
                                    <strong><?=$sl_count++?>.</strong> Schedule of the land and area under possession have been verified and found correct ?
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="possession_verification"
                                            value="YES" disabled <?php if (trim($lmnote->possession_verification) == YES){ echo "checked"; } ?>
                                        />
                                        <label class="form-check-label" for="inlineRadio1">YES</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="possession_verification"
                                            value="NO" disabled <?php if (trim($lmnote->possession_verification) == NO){ echo "checked"; } ?>
                                        />
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                </div>
                            </div>
                            

                            <?php
                            $display_old_nature=0;
                            foreach($dags as $naturedag):
                                if (!is_null($naturedag->nature_possession)){
                                    $display_old_nature=0;
                                    ?>
                                    <div class="row p-2">
                                            <div class="col-md-6">
                                                <strong><?=$sl_count++?>.</strong> Nature of possession <span class="alert-warning"><strong>in the Dag <?=$naturedag->dag_no?></strong></span>
                                            </div>
                                            <div class="col-md-6">
                                                <input name="nature_possession<?=$naturedag->dag_no?>" readonly class="form-control" id="nature_possession<?=$naturedag->dag_no?>" value="<?=$naturedag->nature_possession?>">
                                            </div>
                                    </div>
                            <?php } else { $display_old_nature=1; } endforeach;?>

                            <?php if ($display_old_nature == 1){ ?>
                            <div class="row p-2" >
                                <div class="col-md-6">
                                    <span><strong><?=$sl_count++?>.</strong> Nature of possession –</span>
                                </div>
                                <div class="form-group col-md-6">

                                    <input name="nature_possession" readonly class="form-control" id="nature_possession" value="<?=$lmnote->nature_possession?>">
                                    <!-- <select
                                            name="nature_possession"
                                            id="nature_possession"
                                            class="form-control" disabled
                                    >
                                        <option value="Agricultural" <?php if ($lmnote->nature_possession == "Agricultural") {echo "selected";}?>>Agricultural</option>
                                        <option value="Business" <?php if ($lmnote->nature_possession == "Business") {echo "selected";}?>>Business</option>
                                        <option value="Residential" <?php if ($lmnote->nature_possession == "Residential") {echo "selected";}?>>Residential</option>
                                    </select> -->
                                </div>
                            </div>
                            <?php } ?>

                            <div class="row p-2">
                                <div class="col-md-6">
                                    <span ><strong><?=$sl_count++?>.</strong> Whether applicant and his/her family has patta land and land as tenant in the state ?</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="is_landless"
                                            id="is_landless"
                                            value="YES" disabled <?php if ($lmnote->is_landless == YES) {echo "checked";}?>
                                        />
                                        <label class="form-check-label" for="inlineRadio1">Completely Landless</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="is_landless"
                                            id="is_landless"
                                            value="NO" disabled <?php if ($lmnote->is_landless == NO || $lmnote->is_landless == 'OTHERS') {echo "checked";}?>
                                        />
                                        <label class="form-check-label" for="inlineRadio2">Landless as per policy / Having Land</label>
                                    </div>

                                    <?php if($lmnote->is_landless == NO || $lmnote->is_landless == 'OTHERS') { ?>
                                                                    <button class="btn btn-sm btn-warning viewModal" onclick="viewPropertyModal()" type="button"><i class="fa fa-university"></i>&nbsp;View Property</button>

                                                                    <button class="btn btn-sm btn-danger closeModal" style="display:none" onclick="closePropertyModal()" type="button"><i class="fa fa-close"></i>&nbsp;Close Property</button>

                                                                    <div class="addPropertyDetail" style="display:none" >
                                                                            <div class="tableCard">
                                                                                    <table class="table table-bordered">
                                                                                            <tr>
                                                                                                    <th>District</th>
                                                                                                    <th>Circle</th>
                                                                                                    <th>Area</th>
                                                                                            </tr>

                                                                                            <?php 
                                                                                            
                                                                                                    if($additional_property != null) { 
                                                                                                    
                                                                                                    foreach($additional_property as $area) {
                                                                                            ?>
                                                                                                    <tr>
                                                                                                        <td><?=$area->dist_name?></td>
                                                                                                        <td><?=$area->cir_name?></td>
                                                                                                        <td>
                                                                                                                <b>B:</b> <?=$area->bigha?>;
                                                                                                                <b>K:</b> <?=$area->katha?>;
                                                                                                                <b>L/C:</b> <?=$area->lessa?>;
                                                                                                                <b>G:</b> <?=$area->ganda?>;
                                                                                                                <b>Kr:</b> <?=$area->kranti?> 
                                                                                                        </td>
                                                                                                    </tr>

                                                                                            <?php }} ?>


                                                                                    </table>
                                                                            </div>
                                                                    </div>

                                    <?php } ?>
                                                                    
                                                                <script>
                                                                    function viewPropertyModal(){
                                                                        $('.viewModal').hide('slow');
                                                                        $('.closeModal').('slow');
                                                                        $('.addPropertyDetail').('slow');
                                                                    }

                                                                    function closePropertyModal() {
                                                                        $('.viewModal').('slow');
                                                                        $('.closeModal').hide('slow');
                                                                        $('.addPropertyDetail').hide('slow');
                                                                    }
                                                                </script>

                                </div>
                            </div>

                            <div class="row p-2">
                                <div class="col-md-6 text-justify">
                                    <span><strong><?=$sl_count++?>.</strong> Category of the proposed land?</span>
                                </div>
                                <div class="col-md-6">
                                    <select name="land_falls" id="land_falls" class="form-control" required disabled>
                                        <option value="">Select...</option>
                                        <?php foreach (json_decode(LB_NATURE_OF_RESERVATION) as $landCode): ?>
                                            <option value="<?php echo $landCode->CODE ?>" <?php if ($lmnote->land_falls == $landCode->CODE) {echo "selected";}?>><?php echo $landCode->NAME ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>

                            <div class="row p-2" >
                                <div class="col-md-6">
                                    <strong><?=$sl_count++?>.</strong> Whether the proposed land falls within ghy metropolitian authority area or within master plan area of dist head quarter municipality town, rangia, palashbari town, within 5 km from the boundary of dist HQ municipality town not having notified master plan area
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name="falls_und_gmc"
                                                id="falls_und_gmc"
                                                value="YES" disabled <?php if ($lmnote->falls_und_gmc == YES) {echo "checked";}?>
                                        />
                                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                                class="form-check-input"
                                                type="radio"
                                                name="falls_und_gmc"
                                                id="falls_und_gmc"
                                                value="NO" disabled <?php if ($lmnote->falls_und_gmc == NO) {echo "checked";}?>
                                        />
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                    </div>
                                </div>
                            </div>

                            <?php if ($reservation == true) {?>
                                <div class="row p-2" >
                                    <div class="col-md-6">
                                        <span><strong><?=$sl_count++?>.</strong> Specific comment on roadside
                                                    /riverside reservation (if any, along with provision kept for road/drain
                                                    wherever necessary)</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="road_side_reservation_hide" class="road_side_reservation_hide">
                                            <?php foreach ($reservation as $reserv_road) {
                                                if ($reserv_road->type == "R") {?>
                                                    <span>Dag No: <?=$reserv_road->dag_no?></span>
                                                    <div class="form-group row mt-2">
                                                        <input disabled type="hidden" name="dag_no<?=$reserv_road->dag_no?>" value="<?=$reserv_road->dag_no?>">
                                                        <div class="col-4">
                                                            <span class="input-group-addon">Bigha</span>
                                                            <input disabled type="text" style="text-align: center;" value="<?=$reserv_road->bigha?>" class="form-control input-sm" name="reserved_bigha<?=$reserv_road->dag_no?>" id="reserved_bigha">
                                                        </div>
                                                        <div class="col-4">
                                                            <span class="input-group-addon">Katha</span>
                                                            <input disabled type="text" style="text-align: center;" value="<?=$reserv_road->katha?>" class="form-control input-sm" name="reserved_katha<?=$reserv_road->dag_no?>" id="reserved_katha" >
                                                        </div>
                                                        <div class="col-4">
                                                            <span class="input-group-addon">Lessa</span>
                                                            <input disabled type="text" style="text-align: center;" value="<?=$reserv_road->lessa?>" class="form-control input-sm" name="reserved_lessa<?=$reserv_road->dag_no?>" id="reserved_lessa" >
                                                        </div>
                                                    </div>
                                                    <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))): ?>
                                                        <div class="form-group row mt-2">
                                                            <div class="col-4">
                                                                <span class="input-group-addon">Ganda</span>
                                                                <input disabled type="text" style="text-align: center;" value="<?=$reserv_road->ganda?>" class="form-control input-sm" name="reserved_ganda<?=$reserv_road->dag_no?>" >
                                                            </div>
                                                            <div class="col-4">
                                                                <span class="input-group-addon">Kranti</span>
                                                                <input disabled type="text" style="text-align: center;" value="<?=$reserv_road->kranti?>" class="form-control input-sm" name="reserved_kranti<?=$reserv_road->dag_no?>" >
                                                            </div>
                                                        </div>
                                                    <?php endif;?>
                                                <?php }}?>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <label for="roadside">Comment(if any)</label>
                                                    <textarea
                                                            name="roadside_reservation"
                                                            id="roadside_reservation"
                                                            class="form-control"
                                                            rows="2"
                                                            disabled
                                                    ><?=$lmnote->roadside_reservation?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                            <?php if ($reservation == true) {?>
                                <div class="row p-2" >
                                    <div class="col-md-6">
                                        <span ><strong><?=$sl_count++?>.</strong> Whether applicant family has occupied any land in the lot?</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="road_side_reservation_hide" class="road_side_reservation_hide">
                                            <?php foreach ($reservation as $reserv) {
                                                if ($reserv->type == "F") {?>
                                                    <span>Dag No: <?=$reserv->dag_no?></span>
                                                    <div class="form-group row mt-2">
                                                        <input disabled type="hidden" name="dag_no<?=$reserv->dag_no?>" value="<?=$reserv->dag_no?>">
                                                        <div class="col-4">
                                                            <span class="input-group-addon">Bigha</span>
                                                            <input disabled type="text" style="text-align: center;" value="<?=$reserv->bigha?>" class="form-control input-sm" name="reserved_bigha_family<?=$reserv->dag_no?>" id="reserved_bigha_family">
                                                        </div>
                                                        <div class="col-4">
                                                            <span class="input-group-addon">Katha</span>
                                                            <input disabled type="text" style="text-align: center;" value="<?=$reserv->katha?>" class="form-control input-sm" name="reserved_katha_family<?=$reserv->dag_no?>" id="reserved_katha_family" >
                                                        </div>
                                                        <div class="col-4">
                                                            <span class="input-group-addon">Lessa</span>
                                                            <input disabled type="text" style="text-align: center;" value="<?=$reserv->lessa?>" class="form-control input-sm" name="reserved_lessa_family<?=$reserv->dag_no?>" id="reserved_lessa_family" >
                                                        </div>
                                                    </div>
                                                    <?php if ((in_array($this->session->userdata("dist_code"), BARAK_VALLEY))): ?>
                                                        <div class="form-group row mt-2">
                                                            <div class="col-4">
                                                                <span class="input-group-addon">Ganda</span>
                                                                <input disabled type="text" style="text-align: center;" value="<?=$reserv->ganda?>" class="form-control input-sm" name="reserved_ganda_family<?=$reserv->dag_no?>" >
                                                            </div>
                                                            <div class="col-4">
                                                                <span class="input-group-addon">Kranti</span>
                                                                <input disabled type="text" style="text-align: center;" value="<?=$reserv->kranti?>" class="form-control input-sm" name="reserved_kranti_family<?=$reserv->dag_no?>" >
                                                            </div>
                                                        </div>
                                                    <?php endif;?>
                                                <?php }}?>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>


                            <?php foreach($dags as $landmark):
                                $land_mark = json_decode($landmark->landmark);
                                    ?>
                                    <div class="row p-2">
                                            <div class="col-md-6">
                                                    <strong><?=$sl_count++?>.</strong> Landmark <span class="alert-warning"><strong>for Dag No. <?=$landmark->dag_no?></strong></span>
                                            </div>
                                            <div class="col-md-6">
                                                    <table class="table table-bordered">
                                                            <tr>
                                                                    <th>East side</th>
                                                                    <td><?=$land_mark->east?></td>
                                                                    <th>West side</th>
                                                                    <td><?=$land_mark->west?></td>
                                                            </tr>
                                                            <tr>
                                                                    <th>North side</th>
                                                                    <td><?=$land_mark->north?></td>
                                                                    <th>South side</th>
                                                                    <td><?=$land_mark->south?></td>
                                                            </tr>
                                                    </table>
                                            </div>
                                    </div>
                            <?php endforeach;?>

                        <?php endif;?>

                        <?php if($validation_bypass == 1) {?>
                        <div class="row p-2" >
                            <div class="col-md-6">
                                <span ><strong><?=$sl_count++?>.</strong> Caste Verified: whether applicant belongs to the caste as mentioned in application as per the verification of the caste cerficate uploaded?</span><br>
                                <?php if($basic['bhumiputra_certificate_no']){?>
                                    <label for="" class="alert-warning">Certificate/Ack number : <b><?=$basic['bhumiputra_certificate_no']?></b></label>
                                <?php }else{ ?>
                                    <label for="" class="alert-warning">Certificate/Ack Not Available!</b></label>
                                <?php }?>
                            </div>
                            <div class="col-md-6">
                                <?php
                                if($basic['bhumiputra_certificate_no']){?>
                                <i class="fa fa-link" aria-hidden="true"></i>
                                <a href="<?php echo base_url();?>index.php/SettlementCommon/bhumiPutra?<?php
                                
                                if($basic['bhumiputra_certificate_no'] && $basic['bhumiputra_certificate_type'] == BHUMI_CERT){
                                    echo "cer_number=".$basic['bhumiputra_certificate_no'];
                                }elseif($basic['bhumiputra_certificate_no'] && $basic['bhumiputra_certificate_type'] == BHUMI_ACK){
                                    echo "ack_number=".$basic['bhumiputra_certificate_no'];
                                }?>" target="BhumiPutra">
                                    <u><span class="text-primary" style="font-size:16px;">View certificate</span></u>
                                </a>
                                <?php 
                                }
                                else
                                {
                                    ?>
                                        <span class="text-primary" style="font-size:16px;">Certificate not available</span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php }?>

                        <div class="row p-2">
                            <div class="col-md-6">
                                <strong><?=$sl_count++?>.</strong> LRA remarks</label>
                            </div>
                            
                            <div class="col-md-6">    
                                <?php
                                    foreach(json_decode(LM_NOTE) as $lm_remark_cat)
                                    {
                                        //var_dump($lmnote->lm_note);exit;
                                        if($lm_remark_cat->CODE == $lmnote->lm_note)
                                        {
                                            echo $lm_remark_cat->NAME;
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <?php if($lmnote->lm_note == '2'): ?>                        
                            <div class="row p-5 m-2" style="background:#FFF3CD;">
                                <div class="col-md-12">

                                <?php 
                                    include("./coRejectedRemarks.php");
                                ?>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="row p-2 justify-content-end" style="padding-bottom: 15px!important;">
                            <div class="col-md-12">
                                <textarea name="lm_remark_text" class="form-control p-2" id="lm_remark_text" cols="30" rows="11" disabled><?=$lmnote->lm_remark_text?></textarea>
                            </div>
                        </div>

                
                    <?php endforeach;?>

                </div>

                <h5 class="reza-title" style="margin-top: 50px">
                    <i class="fa fa-file-pdf-o"></i> Uploaded Documents
                </h5>
                <div class="tableCard">
                    <table class="table table-bordered">
                        <?php foreach($dhardocuments as $docs): ?>
                            <tr>
                                <th>
                                    <a target='download'
                                    href="<?php echo base_url()?>index.php/DeptTeaGrant/downloadDocument?doc_id=<?=$docs->id?>&dist_code=<?=$basic['dist_code']?>"><i class="fa fa-paperclip"></i> <?=$docs->file_name;?>
                                        <?php if(isset($docs->dag_no)){ ?>
                                            <span class="alert-danger"><small> for Dag no: <strong><?=$docs->dag_no?></strong></small></span>
                                        <?php }?>
                                    </a>
                                </th>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <script>
        var baseurl = '<?=base_url();?>';
        function SelfAndDocument(dist_code,popupId) {
            var case_no = $.trim($('#caseNo').val());
            var postData = {
                'dist_code' : dist_code, 
                'case_no': case_no,
            };
            $.blockUI({
                message: $('#displayBox'),
                css: {
                    border: 'none',
                    backgroundColor: 'transparent'
                }
            });

            $.ajax({
                url: baseurl + 'DeptTeaGrant/getSelfDocApi',
                type: "POST",
                data: postData,
                success: function(data) {
                    $.unblockUI();
                    arr = JSON.parse(data);
                    if (arr.responseType == 0) {
                        ErrorMessage(arr.msg);
                    } else {
                        const selfContainer = $('#selfdeclaration');
                        for (var i = 0; i < arr.selfDeclarationDetails[0].length; i++) {
                            if (arr.selfDeclarationDetails[0][i].status == '1') {
                                $yesno = 'YES';
                            } else if (arr.selfDeclarationDetails[0][i].status == '0') {
                                $yesno = 'NO';
                            } else {
                                $yesno = '';
                            }

                            const selfd = $(
                                '<tr><th>' + arr.selfDeclarationDetails[0][i].name + 
                                '</th><td class="text-center"><strong>' + $yesno + 
                                '</strong></td></tr>'
                            );

                            selfContainer.append(selfd);
                        }

                        const docContainer = $('#apidoc');
                        for (var x = 0; x < arr.document.length; x++) {
                            const doclink = $('<a>', {
                                href: baseurl + 'DeptTeaGrant/document/' + arr.document[x].name,
                                text: '' + arr.document[x].file_details,
                                target: '_blank'
                            });

                            docContainer.append(doclink).append('<br>');
                        }

                        // $("#aadhartype").();
                        // $("#aadhartype").append("in " + arr.aadhar.type);
                        $(".btn-api-call").hide();
                    }
                }
            });
        }
    </script>
    <div class="vertical-view-section" role="tabpanel" id="step5">
        <div class="reza-card ">
            <div class="reza-body">
                <h5 class="reza-title" style="margin-top: 15px">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Previous Remark
                </h5>
                <?php if($proceedings){ ?>
                    <div class="tableCard">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">Remark Date</th>
                                <th style="width: 200px">Remark Time</th>
                                <th style="width: 200px">Remark from</th>
                                <th>Remark</th>
                            </tr>
                            <?php $i=1; $length=count($proceedings);
                            foreach($proceedings as $pro):if ($i==1){ ?>
                                <tr>
                                    <td>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                        <?= date ("d-M-Y",strtotime($pro->date_entry)) ?>
                                    </td>
                                    <td style="text-transform: uppercase">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                                        <?= date ("h:i a",strtotime($pro->date_entry)) ?>
                                    </td>
                                    <td>
                                        <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                                        <?=$pro->office_from;?>
                                    </td>
                                    <td><?=$pro->note_on_order;?></span></td>
                                </tr>
                            <?php } $i++; endforeach;?>
                        </table>
                    </div>
                    <br>
                <?php } ?>
                <!-- Masud's code-->
                <input type="hidden" id="caseNo" value="<?php echo $caseDetails->case_no ?>">
                <input type="hidden" id="getBaseURL" value="<?php echo base_url(); ?>index.php">
            </div>
        </div>
    </div>
    <div class="vertical-view-section" role="tabpanel" id="proceedings">
        <div class="reza-card ">
            <div class="reza-body">
                <h5 class="reza-title" style="margin-top: 15px">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Remarks Details
                </h5>
                <?php if($proceedings){ ?>
                    <div class="tableCard" style="margin-top: 20px">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">Remark Date</th>
                                <th style="width: 200px">Remark Time</th>
                                <th style="width: 200px">Remark from</th>
                                <th>Remark</th>
                            </tr>
                            <?php foreach($proceedings as $pro):  ?>
                                <tr>
                                    <td>
                                        <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                        <?= date ("d-M-Y",strtotime($pro->date_entry)) ?>
                                    </td>
                                    <td style="text-transform: uppercase">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                                        <?= date ("h:i a",strtotime($pro->date_entry)) ?>
                                    </td>
                                    <td>
                                        <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                                        <?=$pro->office_from;?>
                                    </td>
                                    <td><?=$pro->note_on_order;?></span></td>
                                </tr>
                            <?php endforeach;?>
                        </table>
                    </div>
                    <br><br>

                <?php } ?>


            </div>
        </div>
    </div>
    <div class="vertical-view-section" role="tabpanel" id="history">
        <div class="reza-card ">
            <div class="reza-body">
                <h5 class="reza-title"  style="margin-top: 15px">
                    <i class="fa fa-history" aria-hidden="true"></i> Case History
                </h5>
                <div class="tableCard">

                    <div class="timeline" style="margin-bottom: 15px">

                        <?php foreach($proceedings as $pro): ?>

                            <?php if($pro->status == MB_FINAL): ?>

                                <div class="timeline__content" style="background-color: #4CAF50">
                                    <span class="content_tag" style="margin-top: 15px; background-color: white; color: #4CAF50">
                                        Application Approved
                                    </span>
                                    <span class="content_date" style="color: white; margin-top: 7px">
                                        <?= date ("F j, Y",strtotime($pro->date_entry)) ?>
                                        <br>
                                        By <?=$pro->office_from;?>
                                    </span>
                                </div>

                            <?php elseif($pro->status == MB_DISMISS): ?>

                                <div class="timeline__content" style="background-color: #EF5350">
                                    <span class="content_tag" style="margin-top: 15px; background-color: white; color: #EF5350">
                                        Application Rejected
                                    </span>
                                    <span class="content_date" style="color: white; margin-top: 7px">
                                        <?= date ("F j, Y",strtotime($pro->date_entry)) ?>
                                        <br>
                                            By <?=$pro->office_from;?>
                                    </span>
                                </div>

                            <?php else : ?>

                                <div class="timeline__content" >

                                    <span class="content_tag" style="background-color: #AB47BC; color: white">
                                        <?php if($pro->task != ''): ?>
                                            <?=$pro->task ;?>
                                        <?php else: ?>
                                            Not Defined
                                        <?php endif ?>
                                    </span>
                                    <span style="margin-top: 30px"></span>
                                    <span class="content_date" >
                                        On <?= date ("F j, Y",strtotime($pro->date_entry)) ?>
                                    </span>
                                    <span class="content_Name" >
                                        By&nbsp;
                                        <?php if($pro->office_from != ''): ?>
                                            <?=$pro->office_from;?>
                                        <?php else: ?>
                                            Not Defined
                                        <?php endif ?>
                                    </span>
                                </div>

                            <?php endif; ?>

                        <?php endforeach; ?>


                    </div>

                </div>

            </div>
        </div>
    </div>
    <?php if(!empty($premium_data)) { ?>
        <div class="vertical-view-section" role="tabpanel" id="premium">
            <div class="reza-card ">
                <div class="reza-body">

                    <h5 class="reza-title" style="margin-top: 15px">
                        <i class="fa fa-money" aria-hidden="true"></i> Premium Calculation
                    </h5>

                    <div class="tableCard " style="padding: 25px!important;">
                        <?php foreach ($premium_data as $dagsprem) {?>
                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label>Zonal Value for dag no <strong><span id="dag_prem"><?=$dagsprem->dag_no?></span></strong></label>

                                </div>
                                <div class="form-group col-md-6">

                                    <input type="number" name="zonal_valuation_prem<?=$dagsprem->dag_no?>" id="zonal_valuation_prem<?=$dagsprem->dag_no?>"
                                            class="form-control"
                                            value="<?=$dagsprem->zonal_valuation?>" readonly/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label>Selected Area</label>

                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="prem_area" name='area<?=$dagsprem->dag_no?>' value="<?=$dagsprem->area?>" readonly>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label for="title">Purpose of Land</label>

                                </div>
                                <div class="form-group col-md-6 ">
                                    <input type="text" class="form-control" name='land_type<?=$dagsprem->dag_no?>' value="<?=$dagsprem->land_type?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label for="title">Encroached land type</label>

                                </div>
                                <div class="form-group col-md-6 ">
                                    <input type="text" class="form-control" id="prem_landtype" name='rate_type<?=$dagsprem->dag_no?>' value="<?=$dagsprem->house_type?>" readonly>

                                </div>
                            </div>
                            <div class="row" id="percentage<?=$dagsprem->dag_no?>">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label for="title">Is ST/SC/Widows/Person with disabilities?</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php if($dagsprem->concession =='YES') { ?>
                                        <label for="html">YES</label>
                                    <?php } else if ($dagsprem->concession =='NO') { ?>
                                        <label for="css">NO</label>
                                    <?php } ?>
                                    <br>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label for="title">Total amount for dag no <strong><span id="dag_prem"><?=$dagsprem->dag_no?></span></strong></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input id="finalper<?=$dagsprem->dag_no?>" type="hidden" class="finalper<?=$dagsprem->dag_no?>" value="" name="finalper<?=$dagsprem->dag_no?>" />
                                    <input id="total_lessa<?=$dagsprem->dag_no?>" type="hidden" class="total_lessa<?=$dagsprem->dag_no?>" value="" name="total_lessa<?=$dagsprem->dag_no?>" />
                                    <input type="text" class="totalamount form-control" value="<?=$dagsprem->amount_dag?>" name="amount<?=$dagsprem->dag_no?>" readonly />
                                    <?php if($dagsprem->ratetype=='R') { ?>
                                        <span><b>(Amount: Rs @100/bigha based on above selected area)</b></span>
                                    <?php }?>
                                </div>
                            </div>
                        <?php }?>

                        <div class="tableCard" style="padding: 25px!important;">
                            <div class="row">
                                <div class="form-group col-md-6  text-primary">
                                    <label for="title">Final Amount</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="finalamount" id="finalamount" value="<?=$dagsprem->final_amount?>" readonly>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <label for="title">Payment Mode</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php if($dagsprem->is_full_pay =='YES') { ?>
                                        <label for="html">Full Payment</label>
                                    <?php } else if ($dagsprem->is_full_pay =='NO') { ?>
                                        <label for="css">30% Down Payment</label>
                                    <?php } ?>

                                    <br>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 text-danger">
                                    <label for="title">Total Due</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control " name="totaldue" id="totaldue"  value="<?=$dagsprem->due_amount?>" readonly>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Remarks of aso before forwarding to JS again starts -->
    <?php 
    $designation = $this->session->userdata('designation');
    if($designation == ASSISTANT_USERCODE):?>
        <div class="container mt-3">
            <label><h5>ENTER REMARKS HERE</h5></label>
            <textarea class="form-control" type="text" id="aso_remarks" name="aso_remarks" placeholder="Enter Remarks Here"></textarea>
        </div>
    
    <!-- Remarks of aso before forwarding to JS again ends -->
    <center>                        
        <input type="hidden" id="case_no_get" name="case_no_get" value="<?=$_GET['case_no']?>" >
        <input type="hidden" id="dist_code_get" name="dist_code_get" value="<?=$basic["dist_code"]?>" >
        <input type="hidden" id="verification_type_get" name="verification_type_get" value="<?=ASO_TO_JDS_FORWARD?>" >
        <button class=" mt-3 btn btn-success btn-sm" onclick="forward_to_js_from_aso()"><i class="fa fa-forward"></i>  FORWARD TO JS</button>
        <a href="<?=base_url('pending-tea-grant-cases')?>"
        <button class=" mt-3 btn btn-danger btn-sm"><i class="fa fa-angle-double-left"></i>  BACK</button></a>
    </center>
    <?php endif;?>
</div>
</section>
</div>
</div>
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
            url: baseurl + "DeptTeaGrant/sentTeaGrantCasesFromASOtoJS",
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
                            location.href = "<?=base_url('pending-tea-grant-cases')?>";
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
    



