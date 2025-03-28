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
                            <div class="col-lg-12" style="text-align:justify;font-size:14px">
                                Sub : <span style="margin-left: 40px;">De-reservation of VGR / PGR land and reservation of equal quantum of Govt. land for settlement to the indigenous landless people for homestead purpose in <b><?=$dist_name ?></b> District, who have administrative mandate prior to January 1, 2011 under Mission Basundhara 2.0.</span>
                            </div>
                        </div>
                    </div>
                    <div class="container bg-white divCard pb3"  id="html6">
                        <div class="row mt-4" style=" margin-right: 50px; margin-left: 50px;font-size:14px">
                            <div class="col-lg-12" style="text-align:justify;font-size:14px">
                                 Sir/Madam,<br><br> <span style="margin-left: 80px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    In inviting a reference to the subject cited above, I am directed to convey that the Governor of Assam is pleased to accord approval for de-reservation of VGR / PGR land and reservation of equal quantum of Govt. land for settlement to <b><?= $total_prop ?></b> Nos. of indigenous landless people for homestead purpose in <b><?=$dist_name ?></b> District, who have administrative mandate prior to January 1, 2011 under Mission Basundhara 2.0.
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
                        <div class="row mt-4 divPadding" style=" margin-right: 50px; margin-left: 50px;font-size:14px"><br>
                            <div class="col-lg-6"  style="text-align:left;font-size:14px">
                                <b>No. <?=$cab_id_memo?></b>
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
                    </div>
                        <?php if($user_code == 'DEPT01'): ?>
                        <div class="row justify-content-end mrigankaRight">
                                <div class="col-4 text-center" style="font-size:14px">
                                    By order etc.,<br>
                                    </br>
                                    Special Secretary to the Govt. of Assam
                                    <br>
                                    Revenue & Disaster Management (S) Department.
                                </div>
                        </div>
                        <?php else: ?>
                        <div class="row justify-content-end mrigankaRight">
                                <div class="col-4 text-center" style="font-size:14px">
                                    By order etc.,<br>
                                    </br>
                                    Joint Secretary to the Govt. of Assam
                                    <br>
                                    Revenue & Disaster Management (S) Department.
                                </div>
                        </div>
                        <?php endif; ?>

                    <div style="display:none">
                        <div class="container bg-white divCard pb3"  id="html12">
                            <div class="row justify-content-end mrigankaRight">
                                <?php if($user_code == 'DEPT01'): ?>
                                    <div class="col-4 text-center" style="font-size:14px">
                                        By order etc.,<br>
                                        <b>e-signed</b></br>
                                        Special Secretary to the Govt. of Assam
                                        <br>
                                        Revenue & Disaster Management (S) Department.
                                    </div>
                                <?php else: ?>
                                    <div class="col-4 text-center" style="font-size:14px">
                                        By order etc.,<br>
                                        <b>e-signed</b></br>
                                        Joint Secretary to the Govt. of Assam
                                        <br>
                                        Revenue & Disaster Management (S) Department.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    

                <!-- Digital Sign Form Data -->
                <form id="pdfForm">
                    <textarea id="pdfData" cols="60" rows="8" style="display: none;"  readonly="readonly"></textarea>
                    <input type="hidden" id="signingReason"
                        name="signingReason" maxlength="20" />
                    <input type="hidden" id="signingLocation" name="signingLocation" maxlength="20" />
                    <input type="hidden" id="stampingX" name="stampingX" maxlength="20" value="200" />
                    <input type="hidden" id="stampingY" name="stampingY" maxlength="20"
                        value="200" />
                    <select name="tsaurls" id="tsaurls" onchange="myFunction()" style="display:none">
                        <option value="http://sha256timestamp.ws.symantec.com/sha256/timestamp">
                            http://sha256timestamp.ws.symantec.com/sha256/timestamp</option>
                        <option value="http://timestamp.comodoca.com/rfc3161">http://timestamp.comodoca.com/rfc3161</option>
                        <option value="http://tsa.startssl.com/rfc3161">http://tsa.startssl.com/rfc3161</option>
                        <option value="http://timestamp.digicert.com">http://timestamp.digicert.com</option>
                        <option value="http://tsa.safecreative.org">http://tsa.safecreative.org</option>
                    </select>
                    <input type="hidden" id="tsaURL" name="tsaURL" value="" maxlength="100" style="width: 400px;" />
                    <input type="hidden" id="timeServerURL" name="timeServerURL"
                        value="https://basundhara.assam.gov.in/dscapi/getServerTime" maxlength="100" style="width: 400px;" />
                    <input id="submitPdf" type="Submit" style="display: none;">
                    <a id="downloadDiv" href='#' type="application/pdf" download="SignedPdf.pdf"></a>
                    <input id="verifyPdfBtn" type="button" value=" Verify Pdf "  class="btn btn-danger">
                    <div id="htmlstring_text" ></div>
                </form>

                <div class="col-sm-4">
                    <div class="well-sm">
                        <textarea id="signedPdfData" cols="60" rows="8" style="display: none;"></textarea>
                        <textarea id="sdfsdPdfData" cols="60" rows="8" style="display: none;"></textarea>
                        <textarea id="lblEncryptedKey" cols="60" rows="4" disabled style="display: none;"></textarea>
                        <textarea id="verificationResponse" cols="60" rows="8" disabled style="display: none;"></textarea>
                    </div>
                </div>
                <!-- Digital Sign Form Data -->
                <div id="panel" style="background-color: #fff;"></div>
                    
                        <div class="container">
                            <button type="submit" id="generatePDFnotificationSign" name="submit" class="btn btn-success"><i class="fas fa fa-sign"></i> Sign and Save</button>
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
    $(document).on("click",'#generatePDFnotificationSign',function(){


            var meeting_id = $("#cabmeetingId").val();
            var htmlHead = $("#htmlHead").html();
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
            var html12 = $("#html12").html();
            $.ajax({
                url: BASE_URL + "CabController/SavePDFNotificationCopySign",
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
                    html12: html12,
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
                            text: 'Would you like to sign the notification document digitally ?',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Apply Digital Signature',
                      }).then((result) => {
                          if (result.isConfirmed) {
                          dscSigner.sign(data.base64EncodeData);
                        }
                      });
                    }
                    else
                    {
                        showErrorMessage("SOMETHING WENT WRONG");
                    }
                },
                

            });
        

    });

</script>

<script type="text/javascript">
    function myFunction() {
        var x = document.getElementById("tsaurls").value;
        if (x != 0) {
            document.getElementById("tsaURL").value = x;
        } else {
            document.getElementById("tsaURL").value = "";
        }
    }
    $(document)
        .ready(function(){

            $('#verifyPdfBtn').hide();

            var initConfig = {
                "preSignCallback" : function() {
                    // do something
                    // alert('you are going to a sign a digital minute...');
                    // based on the return sign will be invoked
                    return true;
                },
                "postSignCallback" : function(alias, sign, key) {
                    $('#signedPdfData').val(sign);
                    $('#lblEncryptedKey').val(key);
                    // $.blockUI({
                    //     message: $('#displayBox'),
                    //     css: {
                    //         border:'none',
                    //         backgroundColor:'transparent'
                    //     }
                    // });
                    // Implement signed pdf upload and pdf Download here
                    var requestData = {
                        action : "DECRYPT",
                        en_sig : sign,
                        ek : key
                    };
                    $.ajax(
                        {
                            url : dscapibaseurl+ "/pdfsignature",
                            type : "post",
                            dataType : "json",
                            contentType : 'application/json',
                            data : JSON.stringify(requestData),
                            async : true
                        })
                        .done(
                            function(data) {
                                // $.unblockUI();
                                if (data.status_cd == 1) {

                                    var jsonData = JSON.parse(atob(data.data));
                                    // console.log(jsonData);
                                    if (jsonData.status === "SUCCESS") {
                                        var pdfData = jsonData.sig;
                                        $('#sdfsdPdfData').val(pdfData);
                                        saveDataPDF(pdfData);

                                    }

                                } else {
                                    if (data.error.error_cd == 1002) {
                                        alert(data.error.message);
                                        return false;
                                    } else {
                                        alert("Decryption Failed for Signed PDF File");
                                        return false;
                                    }

                                }
                            }).fail(
                        function(jqXHR, textStatus,
                                 errorThrown) {
                            //$.unblockUI();
                            alert(textStatus);
                        });
                },
                signType : 'pdf',
                mode : 'nostampingv2'
                //"certificateSno" : 13705892,
            };
            dscSigner.configure(initConfig);




            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var data = e.target.result;
                        var base64 = data
                            .replace(/^[^,]*,/, '');
                        $("#pdfData").val(base64);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#pdfFile").change(function() {
                readURL(this);
            });


            function saveDataPDF(signedPdfData)
            {
                Swal.fire({
                    backdrop:true,
                    allowOutsideClick: false,
                    text: 'The Notification is signed Successfull. Now going to upload the notification?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Upload signed notification',
                }).then((result) => {
                    if (result.isConfirmed)
                {
                    saveFinalDataPDF(signedPdfData);
                }
            });
                return;
            }
            function saveFinalDataPDF(signedPdfData)
            {
      

                var cab_id = $('#cabmeetingId').attr('value');
                var requestData = {
                    action : "SAVE",
                    pdfData : signedPdfData,
                    cab_id : cab_id
                };
                $.ajax({
                    url : BASE_URL+ "Basundhara/signedAndFinalApproveByDept",
                    type : "post",
                    dataType : "json",
                    contentType : 'application/json',
                    data : JSON.stringify(requestData),
                    async : true,

                }).done(function(data)
                {
                   
                    if (data.responseType == 1)
                    {
                        showErrorMessage(data.message);
                        reload();
                    }
                    if (data.responseType == 2) {
                        Swal.fire({
                            backdrop: true,
                            allowOutsideClick: false,
                            text: data.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                actions: 'my-actions',
                                confirmButton: 'order-2',
                            }
                        }).then(function(result) {
                            if(result.isConfirmed){
                                location.reload(true);

                            }
                        });
                    }
                    else
                    {
                        showErrorMessage("SOMETHING WENT WRONG");
                        reload();
                    }

                })
                    .fail(function(
                        jqXHR,
                        textStatus,
                        errorThrown) {
                        $.unblockUI();
                        completeProgress();
                        alert(textStatus);
                    });
            }

       

        });


function openModalNotificationForSign(cab_id){
    $('#display_cab_id_memo').html(cab_id);
    $('#cab_id_memo').val(cab_id);
    $('#notificationModal').show('modal');
  }


</script>

<script src="<?php echo base_url('js/dsc/dsc.js?v=1.1'); ?>"></script>
<script src="<?php echo base_url('js/dsc/dsc-signer.js?v=1.1'); ?>"></script>
<script src="<?php echo base_url('js/dsc/dscapi-conf.js?v=1.1'); ?>"></script>

