<div class="mt-5 bg-success text-white font-weight-bold p-3 h5 text-center offset-1 col-lg-10">
    <u>This is a Summary Of the e-CFR<br></u>
    <u>Please click on the 'GENERATE e-CFR' Button Below to generate this receipt</u>
</div>
<div  class="mt-0 font-weight-bold p-3 h6 text-center offset-1 col-lg-10 shadow-lg" style="border:1px solid black; margin-top:0px">
    <?php
    $date = strtotime(date('Y-m-d',strtotime($ecfr_data->created_at)));
    $newDate = date('Y-m-d',strtotime('+15 days',$date));
    ?>
    <div class="container " style="margin-bottom:2rem;overflow-x: scroll;">
            <table class="table" width='100%'>
                <tr>
                    <td>
                        LAND-APPLICATION-NO
                    </td>
                    <td>
                        <?=$ecfr_data->ld_application_no?>
                    </td>
                    <td>
                        E-CFR ENTRY TIME
                    </td>
                    <td>
                        <?=date('Y-m-d',strtotime($ecfr_data->created_at))?>
                    </td>
                </tr>
                <tr>
                    <td>
                        TOTAL-AMOUNT
                    </td>
                    <td>
                        <?=$ecfr_data->due_amount?>
                    </td>
                    <td>
                        VILLAGE
                    </td>
                    <td>
                        <?=$this->utilclass->getVillageName($ecfr_data->dist_code,$ecfr_data->subdiv_code,$ecfr_data->cir_code,$ecfr_data->mouza_pargona_code,$ecfr_data->lot_no,$ecfr_data->vill_townprt_code)?>
                    </td>
                </tr>
                <tr>
                    <td>
                        PATTA-TYPE
                    </td>
                    <td>
                        <?=$this->utilclass->getPattaType($ecfr_data->patta_type_code)?>
                    </td>
                    <td>
                        PATTA-NO
                    </td>
                    <td>
                        <?=$ecfr_data->patta_no?>
                    </td>
                </tr>
                <tr>
                    <td>
                        PATTADAR-NAME
                    </td>
                    <td>
                        <?=$ecfr_data->pdar_name?>
                    </td>
                    <td>
                        VALID UPTO
                    </td>
                    <td>
                        <?=$newDate?>
                    </td>
                </tr>
            </table>
    </div>
</div>
<input id="application_no" type="hidden" name="application_no" value="<?=$ecfr_data->application_no?>"/>
<input id="ld_application_no" type="hidden" name="ld_application_no" value="<?=$ecfr_data->ld_application_no?>"/>
<div id="ecfr_receipt" style="padding:5rem">
    <style type="text/css">
        @media print {

            .col-sm-1,
            .col-sm-2,
            .col-sm-3,
            .col-sm-4,
            .col-sm-5,
            .col-sm-6,
            .col-sm-7,
            .col-sm-8,
            .col-sm-9,
            .col-sm-10,
            .col-sm-11,
            .col-sm-12 {
                float: left;
            }

            .col-sm-12 {
                width: 100%;
            }

            .col-sm-11 {
                width: 91.66666667%;
            }

            .col-sm-10 {
                width: 83.33333333%;
            }

            .col-sm-9 {
                width: 75%;
            }

            .col-sm-8 {
                width: 66.66666667%;
            }

            .col-sm-7 {
                width: 58.33333333%;
            }

            .col-sm-6 {
                width: 50%;
            }

            .col-sm-5 {
                width: 41.66666667%;
            }

            .col-sm-4 {
                width: 33.33333333%;
            }

            .col-sm-3 {
                width: 25%;
            }

            .col-sm-2 {
                width: 16.66666667%;
            }

            .col-sm-1 {
                width: 8.33333333%;
            }
        }
        .table{
            border-collapse:collapse;
            font-size: 20px!important;
        }
        .table tr td {
            border:1px solid black;
            font-size: 20px!important;
        }

        .watermark1 {
            position: fixed;
            top: 50%;
            left: 40%;
            transform: translate(-50%, -50%);
            font-size: 90px;
            color: rgba(0, 0, 0, 0.4); /* Adjust opacity as needed */
            pointer-events: none; /* Ensures the watermark doesn't interfere with content */
            -webkit-transform: rotate(-30deg);

            /* Firefox */
            -moz-transform: rotate(-30deg);

            /* IE */
            -ms-transform: rotate(-30deg);

            /* Opera */
            -o-transform: rotate(-30deg);
        }
        .qr-code{
            display:none;
        }
        .show_in_pdf{
            display:none;
        }
    </style>
    <?php
        $second_year = (int)doul_year_no;
        $first_year = (int)doul_year_no -1;
        $rev_year = (string)$first_year.'-'. (string)$second_year ;
    ?>
    <div class="container p-5 show_in_pdf" style="margin-top:1rem; border: 2px solid">
        <u><h3 style="text-align:center">Assam Schedule XXIV(part-I) Form No. 15A</h3></u>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    ক্ৰমিক নম্বৰ:<b> <?=$ecfr_data->id?></b><br>
                    তাৰিখ: <b><?=date('d-m-y', strtotime("today"))?></b><br>
                    কাৰ পৰা পোৱা হ'ল:  <?=$ecfr_data->pdar_name?><br>
                    কাৰ বাবে পোৱা হ'ল:  <?=$ecfr_data->pdar_name?>
                    <br>
                    মৌজা: <?=$this->utilclass->getMouzaName($ecfr_data->dist_code,$ecfr_data->subdiv_code,$ecfr_data->cir_code,$ecfr_data->mouza_pargona_code)?><br>
                    ৰাজহ চক্ৰ :  <?=$this->utilclass->getCircleName($ecfr_data->dist_code,$ecfr_data->subdiv_code,$ecfr_data->cir_code)?><br>
                    জিলা : <?=$this->utilclass->getDistrictName($ecfr_data->dist_code)?><br>
                </div>
                <div class="col-md-6 qr-code" style="text-align:right;margin-top:-8rem">
                    <img src="<?php echo $base_64_qr ?>" height="100px" width="100px">
                </div>
                
            </div>
        </div>
        <div class="container " style="margin-top:8rem;margin-bottom:2rem;overflow-x: scroll;">
                <table class="table" width='100%'>
                <tr>
                    <td colspan="1" rowspan="2" scope="col" style="text-align:center;"><span style="text-align: center;">গাওঁৰ নাম</span></td>
                    <td colspan="2" rowspan="1" scope="col" style="text-align:center;"><span style="text-align: center;">পট্টা নম্বৰ ও প্ৰকাৰ</span></td>
                    <td colspan="1" rowspan="2" scope="col" style="text-align:center;">খাজানা পৰিশোধৰ বৰ্ষ</td>
                    <td colspan="1" rowspan="2" scope="col" style="text-align:center;">ৰাজহ</td>
                    <td colspan="1" rowspan="2" scope="col" style="text-align:center;">স্থানীয় কৰ</td>
                    <td colspan="1" rowspan="2" scope="col" style="text-align:center;">মিৰান</td>
                    <td colspan="1" rowspan="2" scope="col" style="text-align:center;">অতিৰিক্ত মাচুল</td>
                </tr>
                <tr>
                    <td scope="col" style="text-align:center;">পট্টা নম্বৰ</td>
                    <td scope="col" style="text-align:center;">প্ৰকাৰ</td>
                </tr>
                <?php foreach ($ecfr_pre_arrear as $row):?>    
                    <?php if($row->year_revenue != 0 && $row->year_tax != 0):?>
                    <tr style="text-align:center; ">
                        <td width="20%">
                            <span class="font-weight-bolder">
                                <?=$this->utilclass->getVillageName($row->dist_code, $row->subdiv_code,
                                $row->cir_code, $row->mouza_pargona_code, $row->lot_no, $row->vill_townprt_code)?>
                            <span>
                        </td>
                        
                        <td width="20%"><?=$row->patta_no?></td>
                        <?php if($row->patta_type_code =='0201'):?>
                            <td width="20%">ম্যাদী</td>
                        <?php elseif($row->patta_type_code =='0202'):?>
                            <td width="20%">একচনা</td>
                        <?php endif;?>
                        <td width="30%"><?=$row->financial_year?></td>
                        <td width="20%"><?=$row->year_revenue?></td>
                        <td width="20%"><?=$row->year_tax?></td>
                        <td width="15%">0</td>
                        <td width="15%">0</td>
                    </tr>
                    <?php endif ?>
                <?php endforeach;?>
                <!-- currnt revnue year column starts-->
                <tr style="text-align:center;">
                    <td width="20%">
                        <span class="font-weight-bolder">
                            <?=$this->utilclass->getVillageName($ecfr_data->dist_code, $ecfr_data->subdiv_code,
                            $ecfr_data->cir_code, $ecfr_data->mouza_pargona_code, $ecfr_data->lot_no, $ecfr_data->vill_townprt_code)?>
                        <span>
                    </td>
                    <td width="20%"><?=$ecfr_data->patta_no?></td>
                    <?php if($ecfr_data->patta_type_code =='0201'):?>
                        <td width="20%">ম্যাদী</td>
                    <?php elseif($ecfr_data->patta_type_code =='0202'):?>
                        <td width="20%">একচনা</td>
                    <?php endif;?>
                    <td width="30%"><?=$rev_year?></td>
                    <td width="20%"><?=$ecfr_data->current_revenue?></td>
                    <td width="20%"><?=$ecfr_data->current_local_tax?></td>
                    <td width="15%">0</td>
                    <td width="15%">0</td>
                </tr>
                <!-- currnt revnue year column ends-->
            </table>
        </div>
        <div class="watermark1">
            <p>Temporary e-CFR</p>
        </div>
        <div class="container" style="margin-top:2rem;text-align:right">
            মুঠ টকা:<b><?=$ecfr_data->total_arrear + $ecfr_data->current_revenue + $ecfr_data->current_local_tax?> </b>
        <br>
      
        <?="<br><br><br><br><p style='text-align: center;'>( This is a computer generated document. No signature is required.) <br>(This Temporary e-CFR is Valid Upto '$newDate') </p>"?> 
        <br>
            <div class="container" style="margin-top:2rem;text-align:right">
            মৌজাদাৰ নাম :  <?=$ecfr_data->mouzadar_name?>
            </div>
        </div>
    </div>
</div> 
<center><button style="margin-top:-5rem"class="btn btn-success mb-3" onclick="printCfr()"><i class="fa fa-print"></i>   GENERATE e-CFR</button></center>
<form id='autosubmit' name='autosubmit' action="<?php echo base_url()?>index.php/EkhajanaECFRController/downloadEcfr" method="post" enctype='multipart/form-data' target="_ecfr">
<textarea style="display:none" id="htmlstring_text" name="htmlstring_text" cols="30" rows="10"></textarea>
<input type="hidden" id="idd" name="application_no"/>
<input type="hidden" id="id3" name="ld_application_no"/>
</form>


</center>
<script type="text/javascript">
function printCfr()
{
    var htmlString =$( "#ecfr_receipt" ).html();
    var application_no =$( "#application_no" ).val();
    var ld_application_no =$( "#ld_application_no" ).val();
    var htmlString = b64EncodeUnicode($('#ecfr_receipt').html());
    $("#htmlstring_text").text(htmlString);
    $("#idd").val(application_no);
    $("#id3").val(ld_application_no);
    document.getElementById("autosubmit").submit();
}
    
function b64EncodeUnicode(str) {    
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
        function toSolidBytes(match, p1) {
            return String.fromCharCode('0x' + p1);
    }));
}
</script>  


