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

    <div class="modal" role="dialog" id="generatememoModal" data-keyboard="false" data-backdrop="static">
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
                            REVENUE & DISASTER MANAGEMENT (SETTLEMENT) DEPARTMENT <span style="font-weight:bold;" class="districtName"></span>
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
                        (Circulated under Rule 16 of the Assam Rules of Executive Business, 2023)
                    </div>
                </div>


                        <div class="row">
                            <div class="col-12" style="text-align:justify;font-size:12px">
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    1. SUBJECT:
                                </div>
                                <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">
                                    <ul type="i">
                                        Reviewed cases for Settlement of Khas and Ceiling Surplus land to indigenous, landless families under Mission Basundhara 3.0 in <b style="color:red"><?=$dist_name?></b> districts.
                                    </ul>
                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    2. INTRODUCTION :
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <ul type="i">
                                        A total of <b style="color:red"><?=$total_prop;?></b> proposals were received from the District Commissioners, <b style="color:red"><?=$dist_name?></b> districts for 
                                        settlement of Khas and Ceiling Surplus land to indigenous, landless families under Mission Basundhara 3.0 for homestead purposes, out of 
                                        which <b style="color:red"><?=$reverted_cases_count;?></b> (<b style="color:red"><?=$reverted_cases_count_text;?></b>) proposals have been reverted back, while <b style="color:red"><?=$recomended_cases_count;?></b> proposals have been recommended by the department for placing before 
                                        the cabinet after due verification/scrutiny. A list of the recommended proposals including details of the families alongwith the details 
                                        of land, location, dag, zonal value, etc. has been prepared as per proposals received from the District Commissioner concerned and placed 
                                        at Annexure-I. List for reverted cases are placed at Annexure-II.
                                    </ul>
                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    3. BACKGROUND:
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <ul type="i">
                                        A total of <b style="color:red"><?=$total_prop;?></b> proposals for settlement of town land in favour of indigenous people of the State have been received from the District Commissioner, <b style="color:red"><?=$dist_name?></b> 
                                        District under Mission Basundhara 3.0 after recommendation of the concerned CDLAC.
                                    </ul>
                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    4. PROPOSAL:
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <ol type="1">
                                        <li>A total of <b style="color:red"><?=$recomended_cases_count;?></b> (<b style="color:red"><?=$recomended_cases_count_text;?></b>) proposals have been received from <?= $dist_name ?>  </b>Districts have been recommended after due verification / scrutiny for the approval of the cabinet.</li>
                                        <li>The applicants have accordingly submitted the applications in Mission Basundhara Portal alongwith self-declaration, geo-tagged Photographs of their respective plots, age proof, etc</li>
                                        <li>Trace maps, Chita copies. CO's report alongwith other documents have also been furnished by the District administrations.</li>
                                        <li>Proposals for settlement of town land in favor of indigenous people have been recommended by SDLAC and approved by concerned Gurdian Minister.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container bg-white divCard pb-3 " id="html2">
                        <div class="row mt-4 text-center">
                           <div class="row">
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <div class="reza-title" style="margin-bottom: 10px; margin-top: 14px">
                                        <u>DISTRICT WISE BREAK UP OF PROPOSALS :</u>
                                    </div>
                                    <table id="table_1" class="table table-hover text-center" style="width:100%">            
                                        <thead class="thead-dark">                            
                                        <tr>
                                                <td>Sl No</td>
                                                <td>Name of Ditrict</td>
                                                <td>Total Proposal Received</td>
                                                <td>No Of Recomended Proposals</td>
                                                <td>No Of Reverted proposals</td>                             
                                            </tr>                                                        
                                        </thead>
                                        <tbody>
                                        <?php $count = 1;?>
                                        <?php foreach ($cab_memo_list as $row):?> 
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bolder">
                                                        <?=$count++?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bold text-primary">
                                                        <?=$this->utilclass->getDistrictName($row->dist_code)?>
                                                    <span>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bolder">
                                                        <?=$total_prop?>
                                                    <span>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bold">
                                                        <?=$total_prop?>
                                                    <span>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bold">
                                                        <?=$total_prop?>
                                                    <span>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bolder">
                                                        
                                                    </span>
                                                </td>
                                                <td>
                                                    TOTAL:
                                                </td>
                                                <td>
                                                    <span class="font-weight-bolder text-danger">
                                                        <?=$total_prop?>
                                                    <span>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bold text-success">
                                                        <?=$total_prop?>
                                                    <span>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bold text-success">
                                                        <?=$total_prop?>
                                                    <span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="reza-title" style="margin-bottom: 10px; margin-top: 14px">
                                        <u>EXISTING PROVISIONS :</u>
                                    </div>
                                    <div class="col-12" style="text-align:justify;font-size:12px">
                                        <ol type="i">
                                         <li>
                                            The eligibility for concession according to the land policy 2019 i.e persons of SC/ST, person with disabilities who do not have regular source of income, widow having no earning members in the family, there will be a 25% concession in the premium liability. 
                                        </li>
                                        <li>
                                            As per the Govt. Notification No.RDM 12011 (17)/5/2022-LR-REV-R&DM/14 dated 21st August 2023, the quantum of land, premium for excess and level of approval is to be applicable. Copy enclosed at Annexure-III.
                                        </li>
                                        <li>
                                            Premium payment structure in respect of settlement of lands in Guwahati and urban areas including approved applications for settlement in MB 2.0 but pending for payment of premium shall be applicable as per Govt. Notification No. Е- 540451/1/874570/2024.- dated 27/12/2024. Copy enclosed at Annexure-IV.
                                        </li>                                                                                 
                                        </ol>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div><div class="container bg-white divCard pb-3 " id="html3">
                      
                        <div class="row mt-5 text-center">
                           <div class="row">
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                       5. JUSTIFICATION
                                    </div>
                                    <div class="col-12" style="text-align:justify;font-size:12px">
                                        <ol type="i">
                                            <li> These proposals have been processed together under Mission Basundhara 3.0 keeping in mind the greater good and relief to the indigenous, landless families of the State who have long been awaiting settlement of their respective lands. Hence, a large nos. of families of the State will be benefited at one time besides improving the administrative efficiency.
                                            </li>
                                            <li>These proposals also entail associated accrued revenue collection for the State Exchequer.
                                            </li>
                                            <li>The CDLACs concerned have already recommended these proposals and submitted through the District Commissioners for Government consideration.
                                            </li>
                                            <li>Adoption of this alternate strategy (of allowing settlements to indigenous, landless families at one time) is a reflection of implementation of Project Sadbhavana launched by the Hon'ble Chief Minister of Assam, in letter and spirit
                                            </li>
                                        </ol>
                                 <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                   6. INTER-DEPARTMENTAL CONSULTATIONS
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <ul type="i">
                                        Inter Departmental consultations was not felt necessary as the subject matter is fully within the remit of Revenue & D.M. Department.
                                    </ul>
                                </div>
                                 <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                   7. RESPONSE OF PARENT DEPARTMENT:
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <ul type="i">
                                    Revenue & Disaster Management Department, after thorough scrutiny/ verification has recommended the aforementioned <b style="color:red"><?=$total_prop;?></b> proposals for approval of the cabinet.

                                    </ul>
                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    8. FINANCIAL IMPLICATIONS::
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    NA <br>
                                    Amount: 0
                                </div>
                                <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                    9. EMPLOYMENT GENERATION POTENTIAL, IF ANY:
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    NA <br>
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
                                10. APPROVAL OF THE MINISTER-IN-CHARGE:
                            </div>
                            <div class="col-12" style="text-align:justify;font-size:12px">
                                <ul type="i">
                                    Hon'ble Minister, Revenue & D. M. Department has seen and approved the settlement proposals encapsulated in this Cabinet Memorandum.
                                </ul>
                            </div>
                            <div class="reza-title" style="margin-bottom: 10px; margin-top: 15px">
                                11. APPROVAL SOUGHT:
                            </div>
                            <div class="col-12" style="text-align:justify;font-size:12px">
                                <ul type="i">
                                    Approval of the Cabinet is sought for allowing reviewed cases for Settlement of Khas and Ceiling Surplus land in favour of <b style="color:red"><?=$total_prop;?></b> (<b style="color:red"><?=$total_individual_text;?></b>) 
                                    indigenous, landless families under Mission Basundhara 3.0  residing in <b style="color:red"><?=$dist_name;?></b> districts as placed at Annexure-I.
                                </ul>
                            </div>
                        </div>

                        <br>

                        <div class="row mt-5">
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
                                           
                                            <b style="text-align:center;">REVENUE & DISASTER MANAGEMENT (SETTLEMENT) DEPARTMENT <span style="font-weight:bold;" class="districtName"></span></b>
                                            
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
                                           <b style="font-size:12px ;"> 1. SUBJECT:</b>
                                        </div>
                                        <div class="col-12 mrigankaText" style="text-align:justify;font-size:12px">Settlement of land in favour of indigenous, landless families of the State under Mission Basundhara 2.0.
                                        </div>
                                        <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                           <b style="font-size:12px ;"> 2. INTRODUCTION :</b>
                                        </div>
                                        <div class="col-12" style="text-align:justify;font-size:12px">This is regarding settlement of town land in favour of<span style="color:red"><?=$total_prop;?></span>indigenous, landless families of the State residing in various Districts for homestead purposes. A list of these families along with the details  of  land,  location,  dag,  zonal  value,  etc.  has  been prepared as per proposals received from the Deputy Commissioners concerned and placed at Annexure-I
                                        </div>
                                        <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                            <b style="font-size:12px ;">3. BACKGROUND:</b>
                                        </div>
                                        <div class="col-12" style="text-align:justify;font-size:12px">Proposals for settlement of town land in favour of indigenous people of the  State  have  been  received  from  different Districts under Mission Basundhara 2.0 after recommendation of the concerned SDLAC. 
                                        </div>
                                        <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                            <b style="font-size:12px ;"> 4. PROPOSAL:</b>
                                        </div>
                                        <div class="col-12" style="text-align:justify;font-size:12px">
                                            <ol type="i">
                                                <li>A Total of <b style="color:red"><?=$total_prop;?> </b> proposals have been received from <b style="color:red"><?=$dist_count;?>  (<?= $dist_name ?>)  </b>Districts.</li>
                                                <li>The applicants have accordingly submitted the applications in Mission Basundhara Portal along with self-declaration, geo tagged Photographs of their respective  plots,  age proof, etc.</li>
                                                <li>Trace maps, Chita copies. CO's report along with other documents have also been furnished by the District Administrations.</li>
                                                <li>Proposals for settlement of town land in favor of indigenous people have been recommended by SDLAC and approved by concerned Gurdian Minister.</li>
                                            </ol>
                                            
                                            
                                            

                                        </div>
                                    </div>
                            </div>
       <!--              </div>

                    <div class="container bg-white divCard pb-3 " id="html21" style="display:none;"> -->
                      
                        <div class="row mt-5 text-center">
                           <div class="row">
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                       <b style="font-size:12px ;"> Existing Provisions :</b>
                                    </div>
                                    <div class="col-12" style="text-align:justify;font-size:12px">
                                        <ol type="i">
                                            <li>100%, 30% and 10% premium liability similar to Guwahati city  as per the OM No. RSS 532/2011/Pt/152 dated Dispur the 21st February 2014 will be extended to all towns. Copy enclosed at Annexure-II
                                           </li>
                                           <li>As per the Govt notification No.RDM12011(17)/5/2022-LR-REV-R&DM/94(e-File No.234314) dated 11th November 2022, the rate of premium for RCC house will be 100%, for assam type house 30% and Chali house will be 10% of the zonal value. Copy enclosed at Annexure-III
                                            </li>
                                            <li>As per the Govt notification No.RDM12011(17)/5/2022-LR-REV-R&DM/94(e-File No.234314) dated 11th November 2022, the eligibility for concession according to the land policy 2019 i.e persons of SC,ST, person with disabilities who donot have regular source of income, widow having no earning members in the family, there will be a 25% concession in the premium liability.
                                            </li>
                                            <li>As per the Govt notification no No.RDM12011(17)/5/2022-LR-REV-R&DM/14 dated 21st August 2023, the quantum land for settlement, the rate of premium for excess land and level of approval is to  be applicable. Copy enclosed at Annexure-IV
                                        </li></ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="container bg-white divCard pb-3 " id="html31" style="display:none;">
                      
                        <div class="row mt-5 text-center">
                           <div class="row">
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                        <b style="font-size:12px ;">5.Justification</b>
                                    </div>
                                    <div class="col-12" style="text-align:justify;font-size:12px">
                                        <ol type="i">
                                    <li style="text-align:justify">These proposals have been processed together under Mission Basundhara 2.0 keeping in mind the greater good  and  relief  to  the  indigenous, landless families of the State who have long been awaiting settlement of their respective lands. Hence, a large nos. of families of the State will be benefited at one time besides improving the administrative efficiency
                                    </li><li style="text-align:justify">These proposals also entail associated accrued revenue collection for the State Exchequer.
                                    </li><li>The SDLACS concerned have already recommended these proposals and submitted through the Deputy Commissioners for Government consideration
                                    </li><li style="text-align:justify">Adoption of this alternate strategy (of allowing settlements indigenous, landless families at one time) is a reflection of implementation of Project Sadbhavana launched by the Hon'ble Chief Minister of Assam, in letter and spirit. 
                                    </li>
                                </ol>
                                 <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                    <b style="font-size:12px ;">6.INTER-DEPARTMENTAL CONSULTATIONS</b>
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">Inter Departmental consultations was not felt necessary as the subject matter is fully within the remit of Revenue & D.M. Department
                                    
                                    

                                </div>
                                <div style="margin-bottom: 10px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                  <b style="font-size:12px ;">7. FINANCIAL IMPLICATIONS IF ANY: </b>
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">
                                    <ol type="i">
                                        <li style="text-align:justify">As per the Govt notification No.RDM12011(17)/5/2022-LR-REV-R&DM/94(e-File No.234314) dated 11th November 2022, the rate of premium for RCC house will be 100%, for assam type house 30% and Chali house will be 10% of the zonal value</li>
                                    <li style="text-align:justify">II.  100%, 30% and 10% premium liability similar to Guwahati city  as per the OM No. RSS 532/2011/Pt/152 dated Dispur the 21st February 2014 will be extended to all towns
                                    </li>
                                    <li style="text-align:justify">As per provision under Govt. Circular No.RSS.609/98/73 dated 13/09/2006, in cases of proposals involving lands in excess of permissible limit, rate of premium is charged at 200% of the current market value for the land exceeding the specified area.But in no case land settled with individual shall exceed 2K-10L. (Annexure- II)
                                    </li>
                                    <li style="text-align:justify">III. As per the Govt notification No.RDM12011(17)/5/2022-LR-REV-R&DM/94(e-File No.234314) dated 11th November 2022, the eligibility for concession according to the land policy 2019 i.e persons of SC,ST, person with disabilities who donot have regular source of income, widow having no earning members in the family, there will be a 25% concession in the premium liability.
                                    </li>
                                    </ol>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    <!--                 </div>
                    <div class="container bg-white divCard pb-3 " id="html41" style="display:none;"> -->
                    
                        <div class="row mt-5 text-center">
                            
                            <div class="col-12" style="text-align:justify;font-size:12px">
                                   <div style="margin-bottom:20px; margin-top: 15px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                  <b style="font-size:12px ;">  8. APPROVAL OF THE HON'BLE MINISTER OF THE DEPARTMENT:</b>
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px">Hon'ble Minister, Revenue & D. M. Department has seen and encapsulated in this Cabinet Memorandum
                                </div>
                                <div  style="margin-bottom: 50px; margin-top: 55px;font-weight: bold;font-size: 14px;padding: 20px;color: #37474F;">
                                <b style="font-size:12px ;">9. APPROVAL REQUIRED: </b>
                                </div>
                                <div class="col-12" style="text-align:justify;font-size:12px"> Approval of the Cabinet is required for allowing settlement of land in favour of <span style="color: red"><?=$total_prop;?></span> indigenous, landless families of the State residing in various Districts for homestead purposes as placed at Annexure-I.

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
        $('#generatememoModal').hide('modal');
      });

</script>
