<?php
class LandValuationController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper(array('form', 'url', 'security'));
        $this->load->model('LandValuationModel');
        $this->load->helper('qrcode');
    }

    public function dbswitch2($dist_code)
    {
        if ($dist_code == "02") {
            $this->db2 = $this->load->database('dhubri', TRUE);
        } else if ($dist_code == "05") {
            $this->db2 = $this->load->database('barpeta', TRUE);
        } else if ($dist_code == "10") {
            $this->db2 = $this->load->database('chirang', TRUE);
        } else if ($dist_code == "13") {
            $this->db2 = $this->load->database('bongaigaon', TRUE);
        } else if ($dist_code == "17") {
            $this->db2 = $this->load->database('dibrugarh', TRUE);
        } else if ($dist_code == "15") {
            $this->db2 = $this->load->database('jorhat', TRUE);
        } else if ($dist_code == "14") {
            $this->db2 = $this->load->database('golaghat', TRUE);
        } else if ($dist_code == "07") {
            $this->db2 = $this->load->database('kamrup', TRUE);
        } else if ($dist_code == "03") {
            $this->db2 = $this->load->database('goalpara', TRUE);
        } else if ($dist_code == "18") {
            $this->db2 = $this->load->database('tinsukia', TRUE);
        } else if ($dist_code == "12") {
            $this->db2 = $this->load->database('lakhimpur', TRUE);
        } else if ($dist_code == "24") {
            $this->db2 = $this->load->database('kamrupm', TRUE);
        } else if ($dist_code == "06") {
            $this->db2 = $this->load->database('nalbari', TRUE);
        } else if ($dist_code == "11") {
            $this->db2 = $this->load->database('sonitpur', TRUE);
        } else if ($dist_code == "16") {
            $this->db2 = $this->load->database('sibsagar', TRUE);
        } else if ($dist_code == "32") {
            $this->db2 = $this->load->database('morigaon', TRUE);
        } else if ($dist_code == "33") {
            $this->db2 = $this->load->database('nagaon', TRUE);
        } else if ($dist_code == "34") {
            $this->db2 = $this->load->database('majuli', TRUE);
        } else if ($dist_code == "21") {
            $this->db2 = $this->load->database('karimganj', TRUE);
        } else if ($dist_code == "35") {
            $this->db2 = $this->load->database('biswanath', TRUE);
        } else if ($dist_code == "36") {
            $this->db2 = $this->load->database('hojai', TRUE);
        } else if ($dist_code == "37") {
            $this->db2 = $this->load->database('charaideo', TRUE);
        } else if ($dist_code == "25") {
            $this->db2 = $this->load->database('dhemaji', TRUE);
        } else if ($dist_code == "39") {
            $this->db2 = $this->load->database('bajali', TRUE);
        } else if ($dist_code == "38") {
            $this->db2 = $this->load->database('ssalmara', TRUE);
        } else if ($dist_code == "08") {
            $this->db2 = $this->load->database('darrang', TRUE);
        } else if ($dist_code == "auth") {
            $this->db2 = $this->load->database('auth', TRUE);
        }
        return $this->db2;
    }


    public function getZonalValueByDagLocation()
    {
        log_message('error', 'Land Valuation Certificate, posted data from RTPS'.json_encode($_POST));

        $config=array(
        array('field'=>'dist_code','label'=>'Dist Code','rules'=>'required'),
        array('field'=>'locations[]','label'=>'Location','rules'=>'required'),
        array('field'=>'applicant_name','label'=>'Applicant_name','rules'=>'required'),
        array('field'=>'father_name','label'=>'Father_name','rules'=>'required'),
        array('field'=>'contact_no','label'=>'Contact_no','rules'=>'required'),
        array('field'=>'address','label'=>'Address','rules'=>'required'),
        array('field'=>'gender','label'=>'Gender','rules'=>'required'),
        array('field'=>'dob','label'=>'Date of Birth','rules'=>'required'),
        array('field'=>'occupation','label'=>'Occupation','rules'=>'required'),
        array('field'=>'application_no','label'=>'Application No','rules'=>'required'),
        );

        $validation= $this->form_validate($config);
        if(!empty($validation)){
            log_message("error","Validation :".json_encode($validation));
            echo json_encode(array(
                'responseType'=>1,
                'data' => json_encode($validation)
            ));        
            return;
        }

        ///////Get Posted Locations and Applicant Details Data
        $locations = $this->input->post('locations');
        $district = $this->input->post('dist_code');
        $applicant_name = $this->input->post('applicant_name');
        $father_name = $this->input->post('father_name');
        $contact_no = $this->input->post('contact_no');
        $address = $this->input->post('address');
        $gender = $this->input->post('gender');
        $dob = $this->input->post('dob');
        $occupation = $this->input->post('occupation');
        $application_no = $this->input->post('application_no');
        $link = $this->input->post('lv_link');

        // Check for Empty or Null Parameters
        $parameters = array(
            'locations' => $locations,
            'dist_code' => $district,
            'applicant_name' => $applicant_name,
            'father_name' => $father_name,
            'contact_no' => $contact_no,
            'address' => $address,
            'gender' => $gender,
            'dob' => $dob,
            'occupation' => $occupation,
            'application_no' => $application_no,
        );

        $emptyParameters = $this->validateParameters($parameters);

        if (!empty($emptyParameters)) {
            $emptyParams = implode(", ", $emptyParameters);

            echo json_encode(array(
                'responseType'=>1,
                'data' => 'The following parameter(s) are null or empty : (' . $emptyParams . ')',
            ));
            return ;
        }
        // Check for Empty or Null Parameters End

        $this->db2 = $this->dbswitch2($district);


        $locParts = explode("_", $locations[0]);

        $distCode = $locParts[0];
        $subdivCode = $locParts[1];
        $cirCode = $locParts[2];

        $getCoUser = $this->LandValuationModel->getCoUsers($this->db2,$distCode,$subdivCode,$cirCode)->row();

            if($getCoUser == NULL)
            {
                echo json_encode(array(
                    'responseType' => 1,
                    'data' => 'CO User Details not found !!! :',
                ));
                return;
            }

        $getCoUserDetails = $this->LandValuationModel->getCurrentCoUserDetails($this->db2,$distCode,$subdivCode,$cirCode,$getCoUser->user_code);

            if (is_null($getCoUserDetails['username']) || is_null($getCoUserDetails['userDist']) || is_null($getCoUserDetails['userSubdiv']) || is_null($getCoUserDetails['userCircle']))  {
                echo json_encode(array(
                    'responseType' => 1,
                    'data' => 'CO User Details or Signature not found !!! :',
                ));
                return;
            }  


        $data['userCircle'] = $getCoUserDetails['userCircle'];
        $getCircleName=$this->LandValuationModel->getCircleName($this->db2,$getCoUserDetails['userDist'],$getCoUserDetails['userSubdiv'],$getCoUserDetails['userCircle'])->row();
        $coCircleName = $getCircleName->circle;


        $coUsername = $getCoUserDetails['username'];

        if (ENVIRONMENT === 'production')
        {
            $coUserSign = $getCoUserDetails['userSign'];
        }
        else
        {
            $signature = base_url().'assets/img/signature_test.png';
            $coUserSign = '<img style="max-height:100px; max-width:200px;" src="'.$signature.'" />';
        }

        // $distName=$this->utilclass->getDistrictNameOnLanding($district);
        $genderName=$this->LandValuationModel->getGender($this->db2,$gender);

        $currentDate = date("d-m-Y");

        $emb = base_url().'assets/govt_of_assam_emb.png';
        $dharitree = base_url().'assets/img/01.png';

        $md5_app_no = md5($application_no);

        $qr_link = printQR($link);

        $style = '<style>
                .table-box{
                                width:100%;margin:0px auto; padding:20px;
                                }
                .mytable, td, td {
                                border: 1px solid black;border-collapse: collapse;box-sizing: border-box;
                                }
                .mytable,td,td{
                                width: 100%;
                                }
                .mytable tr{
                                display: flex;text-align: left;
                                }
                .mytable td,td{
                                padding:7px;
                                }
                .table-heading{
                                text-align: center;
                                font-size:30px;
                                background: antiquewhite;
                                font-weight: bold;
                                }
                .table2 tr.landDescription{
                                text-align: center;
                                }
                .table2 tr.landDescription td{
                            
                word-break: break-all;
                                }

                .table1 tr {
                background-color: #fde9d9;
                }

                .table2 tr td {
                width:100px;
                }
                
                .table2 .table2-second-tr td {
                font-weight:bold;
                }

                .mrigankaCenter{
                    text-align: center!important;
                }                    
                .alignRight{
                    text-align: right!important;
                    margin-top: 40px;
                }

                li {
                margin: 20px 0;
                }

            .logo{
                    height : 25%!important; 
                    width : 30%!important;
                    text-align :center!important;
                }
                .logoEmblem{
                    height:100%!important;
                    width:100%!important;
                }
                .logoBorder{
                    border:0px;
                }
                .td-heading{
                text-align: Left;font-size:24px;color:#c0504d;
                font-weight: bold;
                }
                .td-data{
                text-align: Left;font-size:24px;
                }

            </style>';


            $htmlImageDiv = '<div>
                <table>
                    <tbody>
                        
                        <tr>                            
                            <td class="logo logoBorder" style="text-align:center">
                                <img src="'.$dharitree.'" style="width:150px;height:80px;">
                            </td>
                            <td class="logoBorder" style="text-align:center">
                                <img src="'.$emb.'" style="width:150px;height:160px;"> 
                            </td>
                            <td class="logo logoBorder" style="text-align:center">
                                <img src="'. $qr_link.'"style="width:80px;height:80px;">     
                            </td>
                        </tr>
                    </tbody>
                </table></div>';

            $htmlTopDiv = '<div class="container bg-white " id="html1">
                <div class="row text-center">
                    <div class="col-12 text-center mrigankaCenter" style="font-size: 10px; color:red; margin-bottom:10px">
                    </div>
                    <div class="col-12 text-center mrigankaCenter" style="font-size: 20px; font-weight:bold;">
                            <u>LAND VALUATION e-CERTIFICATE</u>
                    </div>

                </div>
            </div>';


            $htmlBottomDiv = '<div class="container bg-white" id="html4">
                <div class="row">
                    <div class="row justify-content-end alignRight">
                        <div class="col-4 text-center" style="font-size:12px">
                        </div>
                    </div>
                    <div class="col-12 text-center" style="font-size: 11px; color:red;">
                        <p>Note: </p>
                        <p>I) This document is issued on the basis of zonal valuation notified vide. District Commissioners Notification No……………….dated 29-06-2024 and valid upto ..........................
                        </p>
                        <p>
                            II) This document does not entail or is implicative of ownership/possession/encumbrance rights over the land schedule  mentioned above.
                        </p>
                        <p>
                            III) This document is as per the records available in Dharitree.In case of any required modifications,applicant may apply in  appropriate service through SewaSetu portal(https:://sewasetu.assam.gov.in). 
                        </p>
                        <p>
                            IV) This is a system generated signed document and does not require physical signature.
                        </p>
                    </div>
                </div>
        

                <div class="row">
                    <div class="col-12" style="font-size: 16px; margin-top: 20px; text-align: right;">
                        
                        <p style="margin-right: 20px;">'.$coUsername.'<br>চক্ৰ বিষয়া, '.$coCircleName.'</p>
                    </div>
                </div>
            </div>';


            $tableDiv = '<div class="table-box">';
            $table2 ='';
            $tableOpen = '<table style="border-collapse: collapse;"  class="table2"><tbody>';
            $table3 = '</tbody></table>';
            $tableDivClose = '</div>';

	        $appDetailsTable = '<table class="mytable table1">
                <tbody>
                    <tr>
                        <td colspan="8" class="table-heading" style="background-color: #c1c1c1;color:#c0504d" >Applicant Details</td>
                    </tr>
                    <tr>
                        <td class="td-heading" style="background-color: #fde9d9;">Application No</td>
                        <td class="td-data">'.$application_no.' dated '.$currentDate.'</td>
                    </tr>
                    <tr>
                    <td class="td-heading" style="background-color: #fde9d9;">Name</td>
                    <td class="td-data">' .$applicant_name .'</td>
                    </tr>
                    <tr>
                        <td class="td-heading" style="background-color: #fde9d9;">Name of Father/Mother/Spouse</td>
                        <td class="td-data">' .$father_name .'</td>
                    </tr>
                    <tr>
                        <td class="td-heading" style="background-color: #fde9d9;">Contact No.</td>
                        <td class="td-data">' .$contact_no .'</td>
                    </tr>
                    <tr>
                        <td class="td-heading" style="background-color: #fde9d9;">Address</td>
                        <td class="td-data">' .$address .'</td>
                    </tr>
                    <tr>
                        <td class="td-heading" style="background-color: #fde9d9;">Gender</td>
                        <td class="td-data">' .$genderName .'</td>
                    </tr>
                    <tr>
                        <td class="td-heading" style="background-color: #fde9d9;">Date of Birth</td>
                        <td class="td-data">'.$dob .'</td>
                    </tr>
                    <tr>
                        <td class="td-heading" style="background-color: #fde9d9;">Current Occupation</td>
                        <td class="td-data">'.$occupation .'</td>
                    </tr>
                    <tr>
                        <td colspan="8" class="table-heading" style="padding-top:1rem; padding-bottom:1rem; background-color: #c2d69b; color:#c0504d;border-top:0px">LAND DESCRIPTION</td>
                    </tr>
                </tbody>	
            </table>';

        $pattaDagDetailsCount = 0;

        foreach ($locations as $value) 
        {
            $parts = explode("_", $value);

            if (count($parts) != 11) {

                 echo json_encode(array(
                    'responseType' => 1,
                    'data' => 'Invalid Location Details Format expected as DistCode_SubdivCode_CirCode_MouzaCode_LotNo_VillCode_PattaNo_PdarId_PattaTypeCode_EkhRecNo:' . $value,
                ));
                return;
            } 

            $dist_code = $parts[0];
            $subdiv_code = $parts[1];
            $cir_code = $parts[2];
            $mouza_pargona_code = $parts[3];
            $lot_no = $parts[4];
            $vill_townprt_code = $parts[5];
            $patta_no = $parts[6];
            $pdar_id = $parts[7];
            $patta_type = $parts[8];
            // $ekhazana_receipt_no = $parts[9];
            // $dag_no = $parts[10];

            $circle=$this->LandValuationModel->getCircleName($this->db2,$dist_code,$subdiv_code,$cir_code)->row();
            $mouza=$this->LandValuationModel->getMouzaName($this->db2,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)->row();
            $village=$this->LandValuationModel->getVillageName($this->db2,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code)->row();


            if($circle == null || $mouza == null || $village == null)
            {
                echo json_encode(array(
                    'responseType' => 1,
                    'data' => 'Invalid Location Details :' . $value,
                ));
                return;
            }

            $district_name = $this->utilclass->getDistrictNameOnLanding($dist_code);
            $circleName = $circle->circle;
            $mouzaName = $mouza->mouza;
            $villageName = $village->village;

            $getDagDetailsUnderPattaNo = $this->LandValuationModel->getAllDagsByPattaNoPdarIdPattaType($this->db2,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_no,$pdar_id,$patta_type);

            $pattaDagDetailsCount += $getDagDetailsUnderPattaNo->num_rows();

            if($pattaDagDetailsCount <= 0)
            {
                echo json_encode(array(
                    'responseType' => 1,
                    'data' => 'No Dags Found Under Location: ' .$value,
                ));
                return;
            };
            
            // $pattaDagDetails = $getDagDetailsUnderPattaNo->result();

            $table2 = '<tr style="background-color: #daeef3;">
                    <td colspan="4" style="font-weight:bold;color:#c0504d;">District</td>
                    <td colspan="5" style="font-size:20px;">' . $district_name . '</td>
                    </tr>
                    <tr style="background-color: #daeef3;">
                    <td colspan="4" style="font-weight:bold;color:#c0504d;">Circle</td>
                    <td colspan="5" style="font-size:20px;">' . $circleName . '</td>
                    </tr>
                    <tr style="background-color: #daeef3;">
                        <td colspan="4" style="font-weight:bold;color:#c0504d;" >Mouza</td>
                        <td colspan="5" style="font-size:20px;">' . $mouzaName . '</td>
                    </tr>
                    <tr style="background-color: #daeef3;color:#c0504d;">
                        <td colspan="4"  style="font-weight:bold;color:#c0504d;">Village</td>
                        <td colspan="5" style="font-size:20px;">' . $villageName . '</td>
                    </tr>
                    <tr class="table2-second-tr" style="background-color: #daeef3;">
                        <td style="color:#c0504d;">Patta type and No. </td>
                        <td style="color:#c0504d;">Dag No.</td>
                        <td style="color:#c0504d;">No. of CoPattadar(Excluding Applicant)</td>
                        <td style="color:#c0504d;">Area of the Dag</td>
                        <td style="color:#c0504d;">Share Land holding of the Applicant</td>
                        <td style="color:#c0504d;">Zonal Class</td>
                        <td style="color:#c0504d;">Zonal Value per Bigha (Rs.)</td>
                        <td style="color:#c0504d;">e-Khazana Receipt No.</td>
                        <td style="color:#c0504d;">Encumbrance Details(If any)</td>
                    </tr>';

            foreach($locations as $dagDetails)
            {
                $parts = explode("_", $dagDetails);
                $dist_code1 = $parts[0];
                $subdiv_code1 = $parts[1];
                $cir_code1 = $parts[2];
                $mouza_pargona_code1 = $parts[3];
                $lot_no1 = $parts[4];
                $vill_townprt_code1 = $parts[5];
                $patta_no1 = $parts[6];
                $pdar_id1 = $parts[7];
                $patta_type1 = $parts[8];
                $ekhazana_receipt_no1 = $parts[9];
                $dag_no1 = $parts[10];

                $patta_type_name = $this->LandValuationModel->getPattaType($this->db2,$patta_type1);

                $getChithaDetails = $this->LandValuationModel->getChithaDagDetails($this->db2,$dist_code1,$subdiv_code1,$cir_code1,$mouza_pargona_code1,$lot_no1,$vill_townprt_code1,$dag_no1,$patta_no1,$patta_type1);

                $chithaDetailsCount = $getChithaDetails->num_rows();

                if($chithaDetailsCount <= 0)
                    {
                        echo json_encode(array(
                            'responseType' => 1,
                            'data' => 'Dag Details Invalid. Not Found in Under Patta: ',
                        ));
                        return;
                    };

                $chithaDetails = $getChithaDetails->row();
                
                $pattadars = $this->LandValuationModel->getPattadarCount($this->db2,$dist_code1,$subdiv_code1,$cir_code1,$mouza_pargona_code1,$lot_no1,$vill_townprt_code1,$patta_no1,$pdar_id1,$patta_type1,$dag_no1);
                $pattadarCount = $pattadars->row()->count;

                $dagAreaBigha = $chithaDetails->dag_area_b;      
                $dagAreaKatha = $chithaDetails->dag_area_k;      
                $dagAreaLessa = $chithaDetails->dag_area_lc;      
                $dagAreaGanda = $chithaDetails->dag_area_g; 
                $dagAreaKranti = $chithaDetails->dag_area_kr; 

                // $total_lessa = 100 * $dagAreaBigha + 20 * $dagAreaKatha + $dagAreaLessa;
                // $total_bigha = $total_lessa / 100;

                $total_area = $dagAreaBigha .'-Bigha ' . $dagAreaKatha .'-Katha ' . $dagAreaLessa .'-Lessa';
 
                $getZonalValueDetails = $this->LandValuationModel->getZonalValueByDagLocation($this->db2,$dist_code1,$subdiv_code1,$cir_code1,$mouza_pargona_code1,$lot_no1,$vill_townprt_code1,$dag_no1);
               
                $zonalValueCount = $getZonalValueDetails->num_rows();

                if($zonalValueCount <= 0)
                    {
                        echo json_encode(array(
                            'responseType' => 1,
                            'data' => 'Zonal Value Details Not found!!! ',
                        ));
                        return;
                    };

                $zonalValue = $getZonalValueDetails->row();


                if(strlen((string)(int)($zonalValue->land_rate)) >= 9)
                {
                     echo json_encode(array(
                            'responseType' => 1,
                            'data' => 'Zonal Value Details Not found! Contact Circle Office !! ',
                        ));
                        return;
                }

                else
                {
                    $rural_urban = $this->LandValuationModel->getRuralUrban($this->db2,$dist_code1,$subdiv_code1,$cir_code1,$mouza_pargona_code1,$lot_no1,$vill_townprt_code1);
                    $is_urban = $rural_urban->row();
                    $r_urban = $is_urban->rural_urban;

                    if($r_urban=='R')
                    {
                        if(strlen((string)(int)($zonalValue->land_rate)) >= 7)
                        {
                             echo json_encode(array(
                                    'responseType' => 1,
                                    'data' => 'Zonal Value Details Not found! Contact Circle Office !! ',
                                ));
                                return;
                        }
                    }

                }

                if ($zonalValue !== null) {
                    $table2 .= '<tr style="background-color: #daeef3;">
                    <td style="font-size:18px;">'. $patta_type_name.' (' . $patta_no1 . ')</td>
                    <td style="font-size:18px;">'. $dag_no1.'</td>
                    <td style="font-size:18px;">'.$pattadarCount.'</td>
                    <td style="font-size:18px;">'.$total_area.'</td>
                    <td style="font-size:18px;">Not Applicable</td>
                    <td style="font-size:18px;">'. $zonalValue->subclass_name.'</td>
                    <td style="font-size:18px;">'. $zonalValue->land_rate.'</td>
                    <td style="font-size:18px;">'.$ekhazana_receipt_no1.'</td>
                    <td></td>
                    </tr>';
                }
                else
                {
                    $table2 .= '<tr style="background-color: #daeef3;">
                    <td style="font-size:18px;">'. $patta_type_name.' (' . $patta_no1 . ')</td>
                    <td style="font-size:18px;">'. $dag_no1.'</td>
                    <td style="font-size:18px;">'.$pattadarCount.'</td>
                    <td style="font-size:18px;">'.$total_area.'</td>
                    <td style="font-size:18px;">(NA)</td>
                    <td style="font-size:18px;">(NA)</td>
                    <td style="font-size:18px;">'.$ekhazana_receipt_no1.'</td>
                    <td></td>
                    </tr>';
                }

            }

        }

            $landValueFinal = $style .$htmlImageDiv .$htmlTopDiv . $tableDiv . $appDetailsTable . $tableOpen . $table2 . $table3 . $htmlBottomDiv . $tableDivClose;    

            // echo $landValueFinal; die;
            $base64array = $this->getPdfBase64Data(base64_encode($landValueFinal));

            echo json_encode(array(
                'responseType' => 2,
                'data' => $base64array ,
            ));

    }





    public function getPdfBase64Data($htmbase64Encoded)
    {
        include 'vendor/mpdf/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetWatermarkText('LAND VALUATION');
        $mpdf->showWatermarkText = true;
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $html = base64_decode($htmbase64Encoded);
        $pdfGenerated = $mpdf->writeHTML($html);
        $pdfBase64 = base64_encode($mpdf->Output('', 'S'));
        return $pdfBase64;
    }


    public function form_validate($configs){
      $this->form_validation->set_rules($configs);
      $validation =array();
      if(!$this->form_validation->run()){
        foreach($configs as $confuguration){
          log_message("error","configs".json_encode($confuguration));
          if (form_error($confuguration['field'])) {
            $validation[] = array('field' => $confuguration['field'], 'message' => form_error($confuguration['field']));
          }
        }
      }
      return $validation;
    }

    function validateParameters($params) 
    {
        $emptyParameters = array();

        foreach ($params as $paramName => $paramValue) {
            if (empty($paramValue)) {
                $emptyParameters[] = $paramName;
            }
        }

        return $emptyParameters;
    }



}