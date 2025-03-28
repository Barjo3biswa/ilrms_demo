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
                <div class="row mt-5 text-center" style="text-align: center;">
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
                <div class="row mt-3 text-center" style="text-align: center;">
                    <div class="col-12" style="text-align:justify;font-size:12px">
                        <div class="mrigankaCenter">
                            <?=$cab_id_memo;?><br>
                            <?=$rev_cab_ref_no;?>
                        </div>
                    </div>
                    <div class="reza-title" style="text-align: center;">
                        <b>CABINET MEMORANDUM </b><br>
                        (CIRCULATED UNDER RULE 17 OF THE ASSAM RULES OF EXECUTIVE BUSINESS,1968)
                    </div>
                </div>


                        <div class="row">
                            <div class="col-12" style="text-align:justify;font-size:12px">
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    1. SUBJECT:
                                </div>
                                <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                                    Transfer of State Government land in favour of Projects/Infrastructure of Central Government Ministries/Departments/Central Government undertakings such as Boards, Corporations etc under Mission Basundhara 3.0
                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    2. INTRODUCTION :
                                </div>
                                <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                                    This is regarding transfer of State Government land in favour of <b style="color:red"><?= $total_prop; ?></b> Projects/Infrastructure of Central Government Ministries/Departments/Central Government undertakings such as Boards, Corporations etc in various districts across the State of Assam. A list of such projects / infrastructure ministry / department wise along with the details  of land,  location,  dag,  area, purpose etc. has been prepared as per proposals received from the District Commissioners concerned and placed at Annexure-I
                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    3. BACKGROUND:
                                </div>
                                <div class="col-12 mrigankaText">
                                    Proposals for land transfer in favour of varied <b style="color:red"><?= $total_prop; ?></b> Projects / Infrastructure under Central Government Ministries / Departments / Central government undertakings such as Boards, Corporations etc have been received from different districts under Mission Basundhara 3.0 after recommendation of the concerned Land Advisory Committee
                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    4. PROPOSAL:
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <ol type="i">
                                        <li>
                                            i. A Total of <b style="color:red"><?= $total_prop; ?></b> such proposals have been received from 7 (<b>DHUBRI,BARPETA,KAMRUP,KARIMGANJ,KAMRUP(M),MORIGAON,BAJALI</b>) Districts.
                                        </li>
                                        <li>
                                            ii. The applicant entity/institution (relevantCentral Government Ministry/Department/Central government undertaking such as Board, Corporation etc.)have accordingly submitted the applications in Mission Basundhara Portal along with project details,self-declaration,land & area details, etc.
                                        </li>
                                        <li>
                                            iii. Trace maps, Chita copies. CO's report along with other documents have also been furnished by the District Administrations
                                        </li>
                                        <li>
                                            iv. Proposals for land transfer in favour ofthese <b style="color:red"><?= $total_prop; ?></b> Projects/Infrastructure of  Central Government Ministries/Departments/Central government undertakingshave been recommended by Land Advisory Committee and approved by concerned Guardian Minister
                                        </li>
                                        
                                    </ol>
                                </div>
                            </div>
                            <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                5. Existing Provisions:
                            </div>
                            <div class="col-12" style="text-align:justify;font-size:12px">
                                <ol type="i">
                                    <li>
                                        I. As per Govt letter dated RSS.288/81/4 dated 2/4/1982 the District Commissioners to send proposals for land transferin favour of CentralGovernment Departments/Undertakings as per land transfer rules on realization of present market value of land plus 25 years capitalized land revenue thereof. Copy at Annexure II.
                                    </li>
                                    <li>
                                        II. As per Office Memorandum ECF.106184/2019/9 dated 7/7/21,delegated power of  transfer of Government land to Central Government Ministries/Departments related to Health,Education & Skill Development to the District Commissioners as per land transfer rule on realization of present market value of land plus 25 years capitalized land revenue thereof, subject to recommendation of Land Advisory Committee and  only in rural areas. Copy at Annexure III.                               
                                    </li>
                                    <li>
                                        III. As per Office Memorandum ECF No.106184/2019/11 dated 2/6/2022,delegated power to the District Commissioners for land transfer of Government land required by the Central Govt undertakings/statutory bodies/parastatals etc. like Food Corporation of India(FCI),Central Warehousing Corporation (CWHC) etc. responsible for construction of warehouse/godown under paddy Procurement Scheme, as per land transfer rule on realization of present market value of land plus 25 years capitalized land revenue thereof, subject to recommendation of Land Advisory Committee and  only in rural areas. Copy at Annexure IV.                              
                                    </li>
                                    <li>
                                        IV. As per Govt notification eCF No.565802/I/776018/2024 Dated 19-10-2024,in respect of transfer of Government land to the Central Government Ministry / Departments related to Health, Education and Skill Development, the District Commissioners are delegated the power for transfer of said Government land under "Land Transfer Rule" on realization of present market value of the land plus 25 (twenty five) years capitalized land revenue after approval of Land Advisory Committee and only in rural areas.Further, District Commissioners are delegated the power for transfer of Government land under "Land Transfer Rule" to Central Government Undertaking / Statutory Bodies / Parastatals etc. like Food Corporation of Indian (FCI), Central Warehousing Corporation (CWC), which are responsible for construction of warehouse/ godown under Paddy Procurement Scheme on realization of present market value of the land plus 25 (twenty five) years capitalized land revenueafter approval of Land Advisory Committee and only in rural areas.All other proposals of ‘Land Transfer’ of State Government land to the Central Government Ministry / Departments /Undertakings in rural areas and all  proposals of ‘Land Transfer’ of State Government land to the Central Government Ministry / Departments in urban areas to be forwarded to the Government approval, after recommendation of Land Advisory Committee.  Copy at Annexure V.                             
                                    </li>
                                    <li>
                                        V. Reclassification and Reclassification cum transfer premium will be realized as per the Govt. Notification No. eCF No.565802/I/777763/2024 dated 20-10-2024. Copy at Annexure VI.
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
                                    i. These proposals have been processed together under Mission Basundhara 3.0 keeping in mind the greater benefitof the State & welfare of the citizens, as transfer of government land to projects/infrastructure under Central Government Ministries/Departments/Central government undertakingscan promote social welfare ,community development, improve access to quality healthcare and education, industrial development, create employment opportunities etc in various sectors.                                    
                                </li>
                                <li>
                                    ii. Transferring land for central government projects can support the development of public utilities, such as roads, educational institutions, and other social infrastructure.                                    
                                </li>
                                <li>
                                    iii. Transferring land for central government projects can support the development of public utilities, such as roads, educational institutions, and other social infrastructure.
                                </li>
                                <li>
                                    iv. Transferring land for central government projects can foster inter-governmental cooperation and coordination, promoting national development and public interest.
                                </li>
                                <li>
                                    v. These proposals also entail strategic allocation of government land which can attract public/private investments, stimulating economic growth and development.
                                </li>
                                <li>
                                    vi. Allotment of land for such infrastructure projects, can improve the quality of life for citizens and enhance the state's competitiveness bringing governance and development closer to citizens across the State.
                                </li>
                                <li>
                                    vii. Further on later settlement of the such allotted lands to the State Government Undertaking such as Board ,Corporation etc. will also entail associated accrued revenue collection for the State Exchequer.
                                </li>
                                <li>
                                    viii. The SDLACS concerned have already recommended these proposals and submitted through the Deputy Commissioners for Government consideration.
                                </li>
                            </ol>
                        </div> 
                        <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                            7. INTER DEPARTMENTAL CONSULTATIONS:
                        </div>
                        <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                            Inter Departmental consultations was not felt necessary as the subject matter is fully within the remit of Revenue & D.M. Department<br>
                        </div>  
                         
                        <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                            8. FINANCIAL IMPLICATIONS:
                        </div>
                        <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                            The proposals will not incur any charge from the consolidated fund of the State but may enhance the Govt. Exchequer.<br>
                        </div>  
                        <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                            9. APPROVAL OF THE HON'BLE MINISTER OF THE DEPARTMENT:
                        </div>
                        <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                            Hon'ble Minister, Revenue & D. M. Department has seen and encapsulated in this Cabinet Memorandum<br>
                        </div>  
                        <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                            10. APPROVAL REQUIRED:
                        </div>
                        <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                           Approval of the Cabinet is sought for allowing transfer of Government land in favour of <b style="color:red"><?= $total_prop; ?></b> Projects / Infrastructure of Central Government Ministries / Departments / Central Government undertakings in various Districts as placed at Annexure-I, subject to payment of 100% of zonal valuation of the land plus 25 years of capitalized land revenue and reclassification cum transfer premium will be realized as admissible                                                          
                        </div>
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
