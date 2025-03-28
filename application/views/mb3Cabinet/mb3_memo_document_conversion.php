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
                padding-left: 20px;
                padding-right: 20px;
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
    </style>

    <div class="modal" role="dialog" id="generatememoModalVGR" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog-cabinet" role="document">
        <div class="modal-content">
       
          <div class="modal-body">        
            <input type="hidden" name="cabmeetingId" id="cabmeetingId" value="<?=$cab_id_memo?>">
            <div class="container bg-white divCard pb-3 " id="html1">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" align="center" style="margin-top: 25px;">
                        <img src="<?=$emb?>">
                    </div>
                </div>
                <div class="row mt-5 text-center">
                    <div class="col-12 text-center mrigankaCenter" style="font-size: 12px; font-weight:bold;">
                        <span style="font-weight: bold">
                            GOVERNMENT OF ASSAM
                            <br>
                            REVENUE & DISASTER MANAGEMENT DEPARTMENT <span style="font-weight:bold;" class="districtName"></span>
                            <br>
                            <u>DISPUR GUWAHATI-6</u></span>
                        </span>
                    </div>
                </div>
                <div class="row mt-3 text-center">
                    <div class="col-12" style="text-align:justify;font-size:12px">
                        <div class="mrigankaCenter">
                            <?=$cab_id_memo;?><br>
                            <?=$rev_cab_ref_no;?>
                        </div>
                    </div>
                    <div class="reza-title" style="text-align: center;">
                        <b>CABINET MEMORANDUM </b><br>
                        (CIRCULATED UNDER RULE 16 OF THE ASSAM RULES OF EXECUTIVE BUSINESS, 2023)
                    </div>
                </div>


                        <div class="row">
                            <div class="col-12" style="text-align:justify;font-size:12px">
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    1. SUBJECT:
                                </div>
                                <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                                End to end digitalisation of Annual Patta to Periodic Patta with rationalised premium rates in urban area and peripheral area. Under Mission Basundhara 3.0
                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    2. INTRODUCTION :
                                </div>
                                <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">

                                    This is regarding end to end digitalisation of Annual Patta to Periodic Patta with rationalised premium rates in urban area and peripheral 
                                    area in favour of <b style="color:red"><?= $total_prop; ?></b> 
                                    Annual patta holders of the State residing in various <b style="color:red"> <?=$dist_name?> </b> Districts. 
                                    A list of these families along with the details of land, location, dag, zonal value, etc.  has been prepared as per proposals 
                                    received from the District Commissioners concerned and placed at Annexure-A.                                        

                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    3. BACKGROUND:
                                </div>
                                <div class="col-12 mrigankaText">
                                    Proposals for end to end digitalisation of Annual Patta to Periodic Patta with rationalised premium rates in urban area and peripheral area under Mission Basundhara 3.0 have been received from different Districts under Mission Basundhara 3.0.
                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    4. PROPOSAL:
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                        <ol type="i">
                                            <li>
                                                A Total of <b style="color:red"><?= $total_prop; ?></b> ( <b style="color:red"><?=$total_individual_text?></b>) proposals received from <b style="color:red"> <?=$dist_name?> </b> districts.
                                            <li>The applicants have accordingly submitted the applications in Mission Basundhara Portal along with necessary KYC, self-declaration, geo tagged Photographs of their respective plots, age proof, etc.</li>
                                            <li>Proposals for end to end digitalisation of Annual Patta to Periodic Patta with rationalised premium rates in urban area and peripheral area have been received from District Commissioners subsequent to approval by concerned Guardian Minister.</li>
                                        </ol>
                                </div>
                                
                            <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                5. Existing Provisions:
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <ol type="i">
                                        <li>
                                            The applicant shall pay a rationalised premium for conversion of AP to PP in urban area and peripheral area. Govt. Notification eCF No.565802/I/773914/2024 dated 16-10-2024 enclosed herewith in Annexure-B.
                                        </li>
                                        <li>
                                            As per the Govt. Notification No. RDM-12011(17)/5/2022 dated 24-08-2023, regarding declaration of services under Revenue & DM department as per provision of the Assam Right to Public Services Act, 2012,the eligibility criteria, documents required, procedure of disposal and the details of designated public servants are enlisted. Enclosed herewith in Annexure-C.                                   
                                        </li>
                                        <li>
                                            As per Govt. Notification eCF No.565802/I/773914/2024 dated 16-10-2024 the rationalized premium rates for AP to PP conversion in rural areas, town lands and peripheral areas and level of approval for Revenue towns showing urbanisation and industrial growth, Other Revenue Towns, District Headquarter Municipal Towns for which Master Plan area is not notified, District Headquarter Municipal Towns, Rangia and Palashbari, having Master Plan area, Other Municipal Towns, Municipal Corporations is enclosed herewith in Annexure-B.
                                        </li>
                                        <li>
                                            Para 11.3 of the Land Policy, 2019 (as amended vide Govt. Notification eCF No. 565802/I/772770/2024) regarding provisions for conversion of Annual Patta into Periodic Patta are as follows: (a) by Revenue Circle Officers in rural areas i.e. for areas beyond all Revenue Towns and all Municipal Towns without peripheral area (Explanation 1 of para1.7). (b) by the District Commissioner in respect of peripheral areas, wherever applicable (Explanation 1 of para 1.7). (c) by the Government in respect of areas falling within, all Town lands (Explanation 1 of para 1.7).
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                6. JUSTIFICATION:
                            </div>
                            <div class="col-12" style="text-align:justify;font-size:12px">
                                    <ol type="i">
                                        <li>
                                            These proposals have been processed together under Mission Basundhara 3.0 keeping in mind the greater good and relief to the Annual Patta holders in town areas and peripheral areasby giving them the opportunity to convert their Annual Pattas into Periodic Pattas with rationalised premium rates in place. Hence, a large nos. of families of the State will be benefited at one time besides improving the administrative efficiency                                    
                                        </li>
                                        <li>
                                            These proposals also entail associated accrued revenue collection for the State Exchequer.                                    
                                        </li>
                                        <li>
                                            A drive mode of end to end digitalisation of Annual Patta to Periodic Patta with rationalised premium rates in urban area and peripheral area thereby, facilitating public to obtain corrected land records which leads to availing various services like bank loans, mortgage, land sale etc and also leading to land record cleansing.
                                        </li>
                                        
                                    </ol>
                                </div>  
                            <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                7. INTER DEPARTMENTAL CONSULTATIONS:
                            </div>
                            <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                                Inter Departmental consultations was not felt necessary as the subject matter is fully within the remit of Revenue & D.M. Department. <br>
                            </div>  
                             
                            <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                8. FINANCIAL IMPLICATIONS:
                            </div>
                            <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                                The <b style="color:red"><?= $total_prop; ?></b> proposals shall accrue incremental value amounting to Rs <b style="color:red"><?= $amount_rs; ?></b>to the state exchequer through levy of fees as per the rationalized premium rates for AP to PP conversion town areas and peripheral areas and at the level of approval for Revenue towns showing urbanisation and industrial growth, Other Revenue Towns, District Headquarter Municipal Towns for which Master Plan area is not notified, District Headquarter Municipal Towns, Rangia and Palashbari, having Master Plan area, Other Municipal Towns, Municipal Corporationspayable to the Government for AP to PP conversion town lands and peripheral areas as per Govt. Notification eCF No.565802/I/773914/2024
                            </div>  
                            
                            <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                10. APPROVAL OF THE HON'BLE MINISTER OF THE DEPARTMENT:
                            </div>
                            <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                            Hon'ble Minister, Revenue & D. M. Department has seen and encapsulated in this Cabinet Memorandum<br>
                            </div>  
                            <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                10. APPROVAL SOUGHT::
                            </div>
                            <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                                Approval of the Cabinet is sought for conversion of land from Annual Patta to Periodic Patta in favour of <b style="color:red"><?= $total_prop; ?></b> (<b style="color:red"><?= $total_individual_text; ?></b>)  Annual Patta holders in urban areas and peripheral areas of the State residing in various Districts as placed at Annexure-A subject to payment of 1% of the prevailing Zonal Value of the land.                                <br>
                            </div>  

                        <!-- </div> -->
                    <!-- </div> -->


                    <!-- <div class="container bg-white divCard pb-3 " id="html3">
                      
                        <div class="row mt-5 text-center">
                           <div class="row">
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                       4. JUSTIFICATION
                                    </div>
                                    <div class="col-12" style="text-align:justify;font-size:12px">
                                        <ol type="a">
                                    <li style="text-align:justify"></li>
                                    <li style="text-align:justify"></li>
                                    <li></li>
                                </ol>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    5. FINANCIAL IMPLICATIONS IF ANY:
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <ul>
                                            There is no financial involvement in the proposal.
                                    </ul>
                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    6. VIEWS OF OTHER DEPARTMENT :
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <ul> 
                                            N/A
                                    </ul>
                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    7. RESPONSE OF REVENUE & DM DEPARTMENT:
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <ul>

                                    </ul>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container bg-white divCard pb-3 " id="html4">
                    
                        <div class="row mt-5 text-center">
                            
                            <div class="col-12" style="text-align:justify;font-size:12px">
                               <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                8. APPROVAL OF THE HON'BLE MINISTER OF THE DEPARTMENT:
                            </div>
                            <div class="col-12" style="text-align:justify;font-size:12px">
                                <ul>
                                The Hon'ble Minister of Revenue & Disaster Management has seen and
                                approved the proposals encapsulated in this memorandum.
                                </ul>
                            </div>
                            <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                9. APPROVAL REQUIRED:
                            </div>
                            <div class="col-12" style="text-align:justify;font-size:12px">
                                <ul>
                                Approval of Cabinet is sought for
                                </ul>
                                <ol type="a">
                                    <li>
                                    </li>
                                    <li>Settlement of <b style="color:red"><?= $total_prop; ?>
                                        </b> Nos of proposals in AP to PP Conversion.
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <br> -->
 
                        <div class="row mt-5 mrigankaRight" id="htmlSign">
                            <div class="row justify-content-end mrigankaRight mt-5">
                                <div class="col-4 text-center" style="font-size:14px">
                                    (GD Tripathi, IAS)
                                    <br>
                                    Principal Secretary to the Government of Assam,
                                    <br>
                                    Revenue & Disaster Management Department,
                                    Dispur.
                                </div>
                            </div>

                        </div>
                        
                                </div>
                            </div>

                    <div class="rr">


                        <div class="container bg-white divCard pb-3 " id="html11" style="display:none;">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12" align="center" style="margin-top: 25px;">
                                    </div>
                                </div>
                                <div class="row mt-5 text-center">
                                    <div style="font-size: 12px; font-weight:bold;">
                                        
                                            <b style="text-align:center;">GOVERNMENT OF ASSAM</b>
                                           
                                            <b style="text-align:center;">REVENUE & DISASTER MANAGEMENT DEPARTMENT <span style="font-weight:bold;" class="districtName"></span></b>
                                            
                                            <b style="text-align:center;">DISPUR GUWAHATI-6</b>
                                     
                                    </div>
                                    <div class="col-12" style="text-align:justify;font-size:11px">
                                        <div style="text-align:center;">
                                            <b><?=$cab_id_memo;?></b>
                                            <b><?=$rev_cab_ref_no;?></b>
                                        </div>
                                    </div>
                                    <div class="reza-title" style="text-align: center;">
                                         <b style="color: #37474F;font-size: 10px;">CABINET MEMORANDUM </b>
                                        <b style="color: #37474F;font-size: 10px;">(CIRCULATED UNDER RULE 17 OF THE ASSAM RULES OF EXECUTIVE BUSINESS,1968)</b>
                                    </div>
                                </div>
                                <p></p>

                                <div class="row">
                                    <div class="col-12" style="text-align:justify;font-size:12px">
                                        <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                           <b style="font-size:12px ;">  SUBJECT:</b>
                                        </div>
                                        <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                                        <ol type="a">
                                            <li>Proposal for Conversion of Annual Patta to Periodic Patta.</li>
                                            <li>Conversion of <b style="color:red"><?= $total_prop; ?></b> No's of proposals.</li>
                                        </ol>
                                        </div>
                                        <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                           <b style="font-size:12px ;"> 1. INTRODUCTION :</b>
                                        </div>
                                        <div class="col-12" style="text-align:justify;font-size:12px">
                                        <ul></ul>
                                        <ol type="i">
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ol>
                                        </div>
                                        <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                            <b style="font-size:12px ;">2. BACKGROUND:</b>
                                        </div>
                                        <!-- <div class="col-12" style="text-align:justify;font-size:12px">
                                            <ul><b>Village Grazing Reserve (VGR) and Professional Grazing Reserve (PGR) Land for individuals</b></ul>
                                            <ul style="margin-bottom: 10px;">For many decades, indigenous, landless people have been occupying VGR and PGR lands. Although they possess these lands in notified VGRs and PGRs, they do not have legally recognized land rights.</ul>
                                            <ul style="margin-bottom: 10px;">As per Rule 95- A, ALRR, 1886 , if at any time the Deputy Commissioner is of the opinion that a village grazing ground constituted under foregoing rules is wholly or in part not needed for the purpose for which it was allotted, the allotment may be cancelled after publication of notice, hearing objections and forwarding proceedings with recommendation to Government for final orders.</ul>
                                            <ul style="margin-bottom: 10px;">As per Rule 88, ALRR, 1886, when all objections presented within one month of the publication of a notice under Rule 85, or of a revised notice under Rule 87, have been disposed of, and no alteration or no further alternation of the area or boundaries of the proposed grazing ground appears to the Deputy Commissioner to be necessary, he shall report his proceedings to the Commissioner who may confirm them with the approval of Government..</ul>
                                            <ul style="margin-bottom: 10px;">The Supreme Court Order dated January 28, 2011, directs that regularization should only be permitted in exceptional cases e.g. where lease has been granted under some Government notification to landless labourers or members of Scheduled Castes/Scheduled Tribes, or where there is already a school, dispensary or other public utility on the land.</ul>
                                            <ul style="margin-bottom: 10px;">For settlement of VGR and PGR land with eligible occupiers, suitable changes in the Land Policy, 2019 are proposed as a one - time measure in Mission Basundhara 2.0.</ul>
                                            <ul style="margin-bottom: 10px;">As approved, clause 6.5, clauses 6.6, 6.7, 6.8 and 6.9 of the Assam Land Policy 2019 has been amended as follows-.</ul>
                                            <ul style="margin-bottom: 10px;">6.6 Under Mission Basundhara 2.0, land under VGRs and PGRs will be settled with members of eligible categories viz. -</ul>
                                            <ol type="i">
                                            <li>Allotees under Minimum Needs Programme and their legal heirs having undisputed possession.</li>
                                            <li>Families who have become landless laborers due to erosion, ethnic violence and rehabilitated by administrative measure in VGR/PGR.</li>
                                            <li>Families displaced as refugee, holding refugee certificate and rehabilitated in VGR/PGR by an administrative order and</li>
                                            <li>Landless members of Schedule Caste and Scheduled Tribe.</li>
                                            </ol>
                                            <ul style="margin-bottom: 10px;">6.7 The maximum limit of VGR and PGR land for settlement to an individual of the eligible category is 1 bigha for homestead purpose.</ul>
                                            <ul style="margin-bottom: 10px;">6.8 An equal quantum of government land should be reserved subject to availability in the same revenue village failing which in the same mouza failing which in the same revenue circle failing which in the same district while dereserving for said purpose as an open space and be kept free from encroachment/settlement or any form of transfer. The aforesaid quantum of land that will be reserved will be over and above a block of government land ranging from 5 (five) to 15 (fifteen) bighas reserved in each village as per Land Policy, 2019.</ul>
                                            <ul style="margin-bottom: 10px;">6.9 While granting settlement of VGR and PGR land, administrative mandate prior to January 1, 2011 will be mandatory and no new settlement shall be considered.</ul>
                                        </div> -->
                                        <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                            <b style="font-size:12px ;"> 3. PROPOSAL:</b>
                                        </div>
                                        <div class="col-12" style="text-align:justify;font-size:12px">
                                            <ol type="a">
                                            <li>District Commissioners of various district have submitted <b style="color:red"><?= $total_prop; ?></b> Nos of proposal for AP to PP </li>
                                            <li>SDLAC has recommended the proposals and concerned Guardian Minister has approved the said proposals.</li>
                                        </ol>
                                        </div>
                                    </div>
                            </div>
                    </div><div class="container bg-white divCard pb-3 " id="html31" style="display:none;">
                      
                        <div class="row mt-5 text-center">
                           <div class="row">
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                        <b style="font-size:12px ;">4.Justification</b>
                                    </div>
                                    <div class="col-12" style="text-align:justify;font-size:12px">
                                        <ol type="a">
                                    <li style="text-align:justify"></li>
                                    <li style="text-align:justify">
                                    </li><li>
                                    </li>
                                </ol>

                                <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                  <b style="font-size:12px ;">5. FINANCIAL IMPLICATIONS IF ANY: </b>
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">There is no financial involvement in the proposal.
                                </div>
                                <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                  <b style="font-size:12px ;">6. VIEWS OF OTHER DEPARTMENT: </b>
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">N/A
                                </div>
                                <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                  <b style="font-size:12px ;">7. RESPONSE OF REVENUE & DM DEPARTMENT: </b>
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">The Revenue & D. M Department is willing to settle the VGR/PGR land to the individual landless families prior to January 1, 2011 with administrative mandate up to 1 bigha for homestead purpose
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5 text-center">
                            
                            <div class="col-12" style="text-align:justify;font-size:12px">
                                   <div style="margin-bottom:20px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                  <b style="font-size:12px ;">  8. APPROVAL OF THE HON'BLE MINISTER OF THE DEPARTMENT:</b>
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">The Hon'ble Minister of Revenue & Disaster Management has seen and approved the proposals encapsulated in this memorandum.
                                </div>
                                <div  style="margin-bottom: 50px; margin-top: 55px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                <b style="font-size:12px ;">9. APPROVAL REQUIRED: </b>
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">Approval of Cabinet is sought for
                                <ol type="a">
                                    <li style="text-align:justify">De-reservation of VGR/PGR land and reservation of equivalent quantum of land as VGR/PGR.</li>
                                    <li style="text-align:justify">Settlement of <b style="color:red"><?= $total_prop; ?></b> Nos of proposals in VGR/PGR Land to the eligible categories
                                    </li>
                                </ol>
                                </div>
                            </div>

                      

                        <div class="row mt-5">
                            <div class="row justify-content-end mrigankaRight mt-5">
                                <div class="col-3 text-center" style="font-size:13px;text-align: right;">
                                    <p></p>
                                    <p></p>
                                    <b>(GD Tripathi, IAS)</b>
                                   
                                    <b>Principal Secretary to the Government of Assam,</b>
                                  
                                    <b>Revenue & Disaster Management Department, Dispur.</b>
                                </div>
                            </div>

                        </div>
                            </div>
                            
                        </div>
                </div>
                            <div class="container">
                            <button type="submit" id="generatePDFMemo" name="submit" class="btn btn-primary">Save Memo</button>
                            <button type="button" class="btn btn-secondary" id="closeModalMemoView">Close</button>
                        </div>
                        </div>
                </div>
                <div class="modal-footer">
                    
                  </div>
            </div>
        </div>
    <div>
</div>
<script type="text/javascript">
      $('#closeModalMemoView').on('click', function(){
        $('#generatememoModalVGR').hide('modal');
      });

</script>
