    <style>
            .reza-card {
                background: #fff;
                border-radius: 2px;
                display: inline-block;
                margin: 1rem;
                position: relative;
                width: 100%;
            }
            .reza-card {
                box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
                transition: all 0.3s cubic-bezier(.25,.8,.25,1);
            }
            .reza-title{
                font-weight: bold;
                font-size: 18px;
                padding: 20px;
                color: #37474F;
            }
            .reza-body{
                margin-left: 20px;
                margin-right: 20px;
                padding-bottom: 40px;
            }
            .badge{
                padding: 10px;
                font-size: 15px;
            }
            .rezaButt {
                color: #FFF;
            }
            .rezaInfo {
                color: #FFF;
                background-color: #FFC107;
            }

            .rezaPrim {
                color: #FFF;
                background-color: #9C27B0;
            }
            .rezaDag {
                color: #FFF;
                background-color: #4CAF50;
            }
            .rezaButt:hover {
                color: #0c0c0c;
            }
            .rezaButt{
                display: inline-block;
                position: relative;
                cursor: pointer;
                height: 35px;
                /*min-width: 150px;*/
                line-height: 37px;
                padding: 0 .8rem;
                /*font-size: 15px;*/
                font-weight: 600;
                font-family: "Roboto", sans-serif;
                /*letter-spacing: 0.8px;*/
                text-align: center;
                text-decoration: none;
                text-transform: uppercase;
                vertical-align: middle;
                white-space: nowrap;
                outline: none;
                border: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                border-radius: 2px;
                transition: all 0.3s ease-out;
                /*box-shadow: 0 2px 5px 0 rgb(0 0 0 / 23%);*/
                margin-bottom: 5px;
                margin-left: 3px;
            }
            .rezaText {
                font-size: 16px;
            }

            .checkBoxD{

                width: 20px;
                height: 20px;
            }
            .reza-m{
                margin: 5px;
            }

            .reza-title{
                font-weight: bold;
                font-size: 11px;
                padding: 20px;
            }                                
            .rezaText {
                font-size: 14px;
            }
            .divCard {
                background: #fff;
                border-radius: 2px;
                display: inline-block;
                position: relative;
                width: 100%;
            } 
            .mrigankaCenter{
                text-align: center!important;
            }                    
            .mrigankaRight{
                text-align: right!important;
                margin-top: 40px;
            }
            .rezaText2 {
                font-size: 14px!important;
                margin: 20px!important;
                text-align: center;
            }
            .divPadding {
                margin-right: 50px; 
                margin-left: 50px;
                font-size:16px
            }
    </style>

    <div class="modal" role="dialog" id="generateNotificationModal" data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">        
                    <input type="hidden" name="cabmeetingId" id="cabmeetingId" value="<?=$cab_id_memo?>"><br><br>
                    <input type="hidden" name="e_file_no" id="e_file_no" value="<?=$e_file_no?>">
                    <input type="hidden" name="date_of_cabinet" id="date_of_cabinet" value="<?=$date_of_cabinet?>">
                    <div class="container bg-white divCard pb3"  id="html1">
                        <div class="row mt-4 text-center">
                            <div class="col-12 text-center mrigankaCenter" style="font-size: 12px; font-weight:bold;">
                                <span style="font-weight: bold">
                                    GOVERNMENT OF ASSAM
                                    <br>
                                    REVENUE &amp; DISASTER MANAGEMENT DEPARTMENT : SETTLEMENT BRANCH<span style="font-weight:bold;" class="districtName"></span>
                                    <br>
                                    ASSAM SECRETARIAT (CIVIL) : DISPUR : GUWAHATI-6</span>
                                </span>
                            </div>
                        </div>
                    </div><br><br>
                    <div class="container bg-white divCard pb3"  id="html2">
                        <div class="row mt-4" style=" margin-right: 50px; margin-left: 50px;font-size:14px;">
                            <div class="col-lg-6"  style="text-align:left;font-size:14px">
                                <b>No. <?=$cab_id_memo?></b>
                            </div>
                            <div class="col-lg-6" style="text-align: right;font-size:14px">
                                Dated Dispur, the <b><?=$current_date ?></b>
                            </div>
                        </div>
                    </div>
                    <div class="container bg-white divCard pb3"  id="html3">
                        <div class="row mt-4" style=" margin-right: 50px; margin-left: 50px;font-size:14px">
                            <div class="col-lg-6" style="text-align:left;font-size:14px">
                                From : 
                                <?php if($user_code == 'DEPT01'): ?>
                                <span style="margin-left: 80px;">&nbsp;&nbsp;Special Secretary to the Govt. of Assam,</span></br>
                                <?php else : ?>
                                <span style="margin-left: 80px;">&nbsp;&nbsp;Joint Secretary to the Govt. of Assam,</span></br>
                                <?php endif; ?>

                                <span style="margin-left: 80px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Revenue & Disaster Management Department.</span>
                            </div>
                        </div>
                    </div>
                    <div class="container bg-white divCard pb3"  id="html4">
                        <div class="row mt-4" style=" margin-right: 50px; margin-left: 50px;font-size:14px">
                            <div class="col-lg-12" style="text-align:left;font-size:14px">
                                To : <span style="margin-left: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;The District Commissioner, <b><?=$dist_name_slash ?></b></span>
                            </div>
                        </div>
                    </div>
                    <div class="container bg-white divCard pb3"  id="html5">
                        <div class="row mt-4" style=" margin-right: 50px; margin-left: 50px;font-size:14px">
                            <div class="col-lg-12" style="text-align:left;font-size:14px">
                                Sub : <span style="margin-left: 40px;">Settlement of land in favor of indigenous, landless families of <b><?=$dist_name ?></b> District under Mission Basundhara 2.0.</span>
                            </div>
                        </div>
                    </div>
                    <div class="container bg-white divCard pb3"  id="html6">
                        <div class="row mt-4" style=" margin-right: 50px; margin-left: 50px;font-size:14px">
                            <div class="col-lg-12" style="text-align:justify;font-size:14px">
                                 Sir/Madam,<br><br> <span style="margin-left: 80px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    In inviting a reference to the subject cited above, I am directed to convey that the Governor of Assam is pleased to accord approval for <b><?= $total_prop ?></b> No.s of proposals submitted by the District Commissioner, <b><?=$dist_name ?></b> respectively in favour of indigenous, landless families under Mission Basundhara 2.0.
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="container bg-white divCard pb3"  id="html7">
                        <div class="row mt-4" style=" margin-right: 50px; margin-left: 50px;font-size:14px">
                            <div class="col-lg-12" style="text-align:justify;font-size:14px">
                                <span style="margin-left: 80px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    The admissible quantum of land for settlement (Homestead) and the premium for settlement is as per the Notifications issued vide No. 1.) RDM-12011(17)/15/2022-LR-REV-R&DM/14 dated 21-08-2023 and 2.) RDM-12011(17)/5/2022-LR-REV-R&DM/94 (e-file no:
                                    234314) Dated 11th November, 2022.
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="container bg-white divCard pb3"  id="html8">
                        <div class="row mt-4" style=" margin-right: 50px; margin-left: 50px;font-size:14px">
                            <div class="col-lg-12" style="text-align:justify;font-size:14px">
                                <span style="margin-left: 80px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    District wise approved list of settlement proposals have been uploaded in the website
                                    "basundhara.assam.gov.in" of Mission Basundhara 2.0 for further necessary action at your
                                    end.
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="container bg-white divCard pb3"  id="html9">
                        <div class="row mt-4" style=" margin-right: 50px; margin-left: 50px;font-size:14px">
                            <div class="col-lg-12" style="text-align:justify;font-size:14px">
                                <span style="margin-left: 80px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    The land records may be corrected and patta may be issued accordingly after
                                    realization of the premium in full.
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="container bg-white divCard pb3"  id="html10">
                        <div class="row mt-4 mb-4 divPadding" style=" margin-right: 50px; margin-left: 50px;font-size:14px">
                            <div class="col-lg-12" style="text-align:justify;font-size:14px">
                                <span style="margin-left: 80px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    This has the approval of Hon'ble Cabinet in its meeting held on <b><?= $date_of_cabinet ?></b>
                                </span>
                            </div>
                        </div>
                    </div>
                        <br>
                        <br>
                        <br>
                    <div class="container bg-white divCard pb3"  id="html11">
                        <div class="row mt-4 divPadding" style=" margin-right: 50px; margin-left: 50px;font-size:14px">
                            <div class="col-lg-6" style="text-align:left;font-size:14px">
                                Enclo : As stated
                            </div>
                        </div>
                        <div class="row justify-content-end mrigankaRight">
                                <?php if($user_code == 'DEPT01'): ?>
                                <div class="col-4 text-center" style="font-size:14px">
                                    Yours faithfully,<br><br><br><br>
                                    Special Secretary to the Govt. of Assam
                                    <br>
                                    Revenue & Disaster Management (S) Department.
                                </div>
                                <?php else: ?>
                                <div class="col-4 text-center" style="font-size:14px">
                                    Yours faithfully,<br><br><br><br>
                                    Joint Secretary to the Govt. of Assam
                                    <br>
                                    Revenue & Disaster Management (S) Department.
                                </div>
                                <?php endif; ?>
                        </div>
                        <div class="row mt-4 divPadding">
                
                            <div class="col-lg-6"  style="text-align:left;font-size:14px">
                                Memo <b>No. <?=$cab_id_memo?></b>
                            </div>
                            <div class="col-lg-6" style="text-align: right;font-size:14px">
                                Dated Dispur, the <b><?=$current_date ?></b>
                            </div>
                        </div>
                        <div class="row mt-4 divPadding" style=" margin-right: 50px; margin-left: 50px;font-size:14px"><br>
                            <div class="col-lg-12" style="text-align:left;font-size:14px">
                                Copy for information to:
                            </div>
                        </div>
                        <div class="row mt-4 divPadding" style=" margin-right: 50px; margin-left: 50px;font-size:14px">
                            <div class="col-12" style="text-align:justify">
                                    <ol type="1">
                                        <li>The Director of Land Record & Surveys, Assam Rupnagar, Guwahati.
                                        </li>
                                <?php if($user_code == 'DEPT01'): ?>
                                        <li>Special Secretary to the Govt. of Assam, Political (Cabinet Cell) Department.
                                        </li>
                                <?php else: ?>
                                        <li>Joint Secretary to the Govt. of Assam, Political (Cabinet Cell) Department.
                                        </li>
                                <?php endif; ?>

                                        <li>P.S. to the Principal Secretary to the Chief Minister, Assam.
                                        </li>
                                        <li>P.S. to the Hon'ble Minister, Revenue & D.M. Department for kind appraisal of Hon'ble Minister.
                                        </li>
                                        <li>P.S. to the Principal Secretary to the Govt. of Assam, Revenue & D.M. Department for kind appraisal of Principal Secretary.
                                        </li>
                                         <li>P.S. to the Secretary (BP)/(GB)/(AB) to the Govt. of Assam for kind appraisal of the Secretary.
                                        </li>
                                </ol>
                            </div>
                        </div>
                        <div class="row justify-content-end mrigankaRight">
                                <?php if($user_code == 'DEPT01'): ?>
                                <div class="col-4 text-center" style="font-size:14px">
                                    By order etc.,<br><br><br>
                                    Special Secretary to the Govt. of Assam
                                    <br>
                                    Revenue & Disaster Management (S) Department.
                                </div>
                                <?php else: ?>
                                <div class="col-4 text-center" style="font-size:14px">
                                    By order etc.,<br><br><br>
                                    Joint Secretary to the Govt. of Assam
                                    <br>
                                    Revenue & Disaster Management (S) Department.
                                </div>
                                <?php endif; ?>
                        </div>
                    </div>
                    
                        <div class="container">
                            <button type="submit" id="generatePDFnotification" name="submit" class="btn btn-success">Save Notification Copy</button>
                            <button type="button" class="btn btn-secondary" id="closeNotificationModal">Close</button>
                        </div>

                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
      $('#closeNotificationModal').on('click', function(){
        $('#generateNotificationModal').hide('modal');
      });

  // final submit & generate PDF
    $(document).on("click",'#generatePDFnotification',function(){
        if(!confirm("Are you sure to proceed"))
        {
            return true;
        }
        else
        {

            var meeting_id = $("#cabmeetingId").val();
            var htmlHead = $("#htmlHead").html();
            var date_of_cabinet = $('#date_of_cabinet').val();
            var html1 = $("#html1").html();
            var html2 = $("#html2").html();
            var html3 = $("#html3").html();
            var html4 = $("#html4").html();
            var html5 = $("#html5").html();
            var html6 = $("#html6").html();
            var html7 = $("#html7").html();
            var html8 = $("#html8").html();
            var html9 = $("#html9").html();
            var html10 = $("#html10").html();
            var html11 = $("#html11").html();
            $.ajax({
                url: base_url + "CabController/SavePDFNotificationCopy",
                type: "post",
                dataType: "json",
                data: {
                    meeting_id: meeting_id,
                    htmlHead: htmlHead,
                    html1: html1,
                    html2: html2,
                    html3: html3,
                    html4: html4,
                    html5: html5,
                    html6: html6,
                    html7: html7,
                    html8: html8,
                    html9: html9,
                    html10: html10,
                    html11: html11,
                    date_of_cabinet : date_of_cabinet
                },
                // contentType: "application/json",
                success: function (data) {
                    // $.unblockUI();
                    if (data.responseType == 3)
                    {
                        showErrorMessage(data.message);
                    }
                    else if(data.responseType == 2)
                    {
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
                    else
                    {
                        showErrorMessage("SOMETHING WENT WRONG");
                    }
                },
                

            });
        }

    });

</script>

