<?php
class BasundharaMb2Perpetual extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->model('basundhara/basundharaMb2Perpetualmodel');
        $this->db2 = NULL;
    }
    public function dbswitch()
    {
        //$CI=&get_instance();
        if ($this->session->userdata('dist_code') == "02") {
            $this->db = $this->load->database('dha3', TRUE);
        } else if ($this->session->userdata('dist_code') == "05") {
            $this->db = $this->load->database('dha1', TRUE);
        } else if ($this->session->userdata('dist_code') == "10") {
            $this->db = $this->load->database('dha24', TRUE);
        } else if ($this->session->userdata('dist_code') == "13") {
            $this->db = $this->load->database('dha2', TRUE);
        } else if ($this->session->userdata('dist_code') == "17") {
            $this->db = $this->load->database('dha4', TRUE);
        } else if ($this->session->userdata('dist_code') == "15") {
            $this->db = $this->load->database('dha5', TRUE);
        } else if ($this->session->userdata('dist_code') == "14") {
            $this->db = $this->load->database('dha6', TRUE);
        } else if ($this->session->userdata('dist_code') == "07") {
            $this->db = $this->load->database('dha7', TRUE);
        } else if ($this->session->userdata('dist_code') == "03") {
            $this->db = $this->load->database('dha8', TRUE);
        } else if ($this->session->userdata('dist_code') == "18") {
            $this->db = $this->load->database('dha9', TRUE);
        } else if ($this->session->userdata('dist_code') == "12") {
            $this->db = $this->load->database('dha13', TRUE);
        } else if ($this->session->userdata('dist_code') == "24") {
            $this->db = $this->load->database('dha10', TRUE);
        } else if ($this->session->userdata('dist_code') == "06") {
            $this->db = $this->load->database('dha11', TRUE);
        } else if ($this->session->userdata('dist_code') == "11") {
            $this->db = $this->load->database('dha12', TRUE);
        } else if ($this->session->userdata('dist_code') == "12") {
            $this->db = $this->load->database('dha13', TRUE);
        } else if ($this->session->userdata('dist_code') == "16") {
            $this->db = $this->load->database('dha14', TRUE);
        } else if ($this->session->userdata('dist_code') == "32") {
            $this->db = $this->load->database('dha15', TRUE);
        } else if ($this->session->userdata('dist_code') == "33") {
            $this->db = $this->load->database('dha16', TRUE);
        } else if ($this->session->userdata('dist_code') == "34") {
            $this->db = $this->load->database('dha17', TRUE);
        } else if ($this->session->userdata('dist_code') == "21") {
            $this->db = $this->load->database('dha18', TRUE);
        } else if ($this->session->userdata('dist_code') == "08") {
            $this->db = $this->load->database('dha19', TRUE);
        } else if ($this->session->userdata('dist_code') == "35") {
            $this->db = $this->load->database('dha20', TRUE);
        } else if ($this->session->userdata('dist_code') == "36") {
            $this->db = $this->load->database('dha21', TRUE);
        } else if ($this->session->userdata('dist_code') == "37") {
            $this->db = $this->load->database('dha22', TRUE);
        } else if ($this->session->userdata('dist_code') == "25") {
            $this->db = $this->load->database('dha23', TRUE);
        }
    }





    public function dbswitch2($dist_code)
    {
        if ($dist_code == "02") {
            $this->db2 = $this->load->database('dhubri_live', TRUE);
        } else if ($dist_code == "05") {
            $this->db2 = $this->load->database('barpeta_live', TRUE);
        } else if ($dist_code == "10") {
            $this->db2 = $this->load->database('chirang_live', TRUE);
        } else if ($dist_code == "13") {
            $this->db2 = $this->load->database('bongaigaon_live', TRUE);
        } else if ($dist_code == "17") {
            $this->db2 = $this->load->database('dibrugarh_live', TRUE);
        } else if ($dist_code == "15") {
            $this->db2 = $this->load->database('jorhat_live', TRUE);
        } else if ($dist_code == "14") {
            $this->db2 = $this->load->database('golaghat_live', TRUE);
        } else if ($dist_code == "07") {
            $this->db2 = $this->load->database('kamrup', TRUE);
        } else if ($dist_code == "03") {
            $this->db2 = $this->load->database('goalpara_live', TRUE);
        } else if ($dist_code == "18") {
            $this->db2 = $this->load->database('tinsukia_live', TRUE);
        } else if ($dist_code == "12") {
            $this->db2 = $this->load->database('lakhimpur_live', TRUE);
        } else if ($dist_code == "24") {
            $this->db2 = $this->load->database('kamrupm_live', TRUE);
        } else if ($dist_code == "06") {
            $this->db2 = $this->load->database('nalbari_live', TRUE);
        } else if ($dist_code == "11") {
            $this->db2 = $this->load->database('sonitpur_live', TRUE);
        } else if ($dist_code == "16") {
            $this->db2 = $this->load->database('sibsagar_live', TRUE);
        } else if ($dist_code == "32") {
            $this->db2 = $this->load->database('morigaon_live', TRUE);
        } else if ($dist_code == "33") {
            $this->db2 = $this->load->database('nagaon_live', TRUE);
        } else if ($dist_code == "34") {
            $this->db2 = $this->load->database('majuli_live', TRUE);
        } else if ($dist_code == "21") {
            $this->db2 = $this->load->database('karimganj_live', TRUE);
        } else if ($dist_code == "35") {
            $this->db2 = $this->load->database('biswanath_live', TRUE);
        } else if ($dist_code == "36") {
            $this->db2 = $this->load->database('hojai_live', TRUE);
        } else if ($dist_code == "37") {
            $this->db2 = $this->load->database('charaideo_live', TRUE);
        } else if ($dist_code == "25") {
            $this->db2 = $this->load->database('dhemaji_live', TRUE);
        } else if ($dist_code == "39") {
            $this->db2 = $this->load->database('bajali_live', TRUE);
        } else if ($dist_code == "38") {
            $this->db2 = $this->load->database('ssalmara_live', TRUE);
        } else if ($dist_code == "08") {
            $this->db2 = $this->load->database('darrang_live', TRUE);
        } else if ($dist_code == "auth") {
            $this->db2 = $this->load->database('auth', TRUE);
        }
        return $this->db2;
    }

    // Show Pending cases based on service
    function request($service)
    {
        $this->db = $this->load->database('db2', TRUE);
        //var_dump($this->session->userdata);
        $dept_user_code = $this->session->userdata('user_code');
        $sql = " SELECT dist_code FROM user_dist_byforcation WHERE user_code = '$dept_user_code'";
        $dept_district = $this->db->query($sql)->result();
        $dist_codes = array_column($dept_district, 'dist_code');
        $dist_list = implode(',', $dist_codes);
        // $dist_list = "07,21";

        $settlement['pending'] = $this->basundharaMb2Perpetualmodel->getDepartmentRequest($service, $dist_list);
        $settlement['service'] = $service;
        $settlement['_view'] = 'basundhara/request';
        $this->load->view('layouts/main', $settlement);
    }


    // All Department request


    // Show Department Approved cases based on service
    function deptApprovedCases($service)
    {
        //var_dump($_SESSION);
        $this->load->model('basundhara/basundharaMb2Perpetualmodel');
        $settlement['pending'] = $this->basundharaMb2Perpetualmodel->alldepartmentApprovedCases($service);
        $settlement['_view'] = 'basundhara/approvedcaseslist';
        $this->load->view('layouts/main', $settlement);
    }

    ////////////////////////// Settlement Start //////////////

    function settlementCases()
    {
        $sql = " Select count(case_no),service_code,CASE
                WHEN (service_code = '13') THEN 'SETTLEMENT TENANT'
                WHEN (service_code = '14') THEN 'SETTLEMENT AP TRANSFER'
                WHEN (service_code = '15') THEN 'SETTLEMENT TRIBAL COMMUNITY'
                WHEN (service_code = '16') THEN 'SETTLEMENT KHAS LAND'
                WHEN (service_code = '17') THEN 'SETTLEMENT PGR VGR LAND'
                WHEN (service_code = '18') THEN 'SETTLEMENT SPECIAL CULTIVATORS'
                END AS service from settlement_basic  where from_office='DC' and 
                 status='W' and pending_officer='DPT'   group by service_code";
        $result = $this->db2->query($sql)->result_array();
        $settlement['result'] = $result;
        // $settlement['output'] = json_decode($output);
        $settlement['_view'] = 'basundhara/byservicelist';
        $this->load->view('layouts/main', $settlement);
    }


    public function imageDecodeBase64($encoded_string){
        $file_data= base64_decode($encoded_string);
        $file = finfo_open();
        $mime_type = finfo_buffer($file, $file_data, FILEINFO_MIME_TYPE);
        $file_type = explode('/', $mime_type)[0];
        $extension = explode('/', $mime_type)[1];
        log_message("error","No error occured".json_encode($mime_type));
        return $mime_type;
    }

    function settlementBasu()
    {
        $settlement['application_no'] = $application_no = $this->input->get('app');

        $dist_code = $this->input->get('dist_code');

        $this->db2 = $this->dbswitch2($dist_code);
        $sql = "Select case_no from settlement_basic where applid='$application_no' ";
        $settlement['case_no'] = $case_no = $this->db2->query($sql)->row()->case_no;
        $settlement['settlement_basic'] = $this->basundharaMb2Perpetualmodel->getSettlementBasic($case_no);
        $settlement['settlement_applicant']  = $this->basundharaMb2Perpetualmodel->getSettlementApplicant($case_no);
        //var_dump($settlement['settlement_applicant']);die();
        $settlement['settlement_dag_details'] = $this->basundharaMb2Perpetualmodel->getSettlementDagDetails($case_no);
        $settlement['settlement_dag_area'] = $this->basundharaMb2Perpetualmodel->getSettlementDagArea($case_no);
        $settlement['settlement_proceeding'] = $this->basundharaMb2Perpetualmodel->getSettlementProceeding($case_no);
        $settlement['settlement_ap_lmnote'] = $this->basundharaMb2Perpetualmodel->getSettlementLmNote($case_no);
        $settlement['supportive_document'] = $this->basundharaMb2Perpetualmodel->getSupportiveDocuments($case_no);
        $settlement['proceedings']   = $this->basundharaMb2Perpetualmodel->getSettlementProceeding($case_no);
        // Newly added on 08/09/2022
        $settlement['applicants_buyers']   = $this->basundharaMb2Perpetualmodel->getAllApplicantBuyers($case_no);
        $settlement['applicants_owners']   = $this->basundharaMb2Perpetualmodel->getAllApplicantOwners($case_no);
        $settlement['applicants_encroacher']   = $this->basundharaMb2Perpetualmodel->getAllApplicantEncroacher($case_no);
        $settlement['applicants_riotee_nok']   = $this->basundharaMb2Perpetualmodel->getAllApplicantRioteeNok($case_no);

        // New Added Settlemet Reservation Details
        $settlement['roadside_reservation']   = $this->basundharaMb2Perpetualmodel->getSettlementRoadsideReservation($case_no);
        $settlement['family_reservation']   = $this->basundharaMb2Perpetualmodel->getSettlementFamilyReservation($case_no);
        $settlement['vgr_reservation']   = $this->basundharaMb2Perpetualmodel->getSettlementVgrReservation($case_no);

        // Premium Calculation Details
        if($settlement['settlement_basic']["service_code"] != SETTLEMENT_SPECIAL_CULTIVATORS_ID)
        {
            $this->db2->trans_begin();
            $settlement_premium_insertion = $this->basundharaMb2Perpetualmodel->premiumReCalculation($this->db2,$case_no);

            if($settlement_premium_insertion != null)
            {   
                $data['old_dag_flag_message'] = false;
                if($settlement_premium_insertion['status'] == 3)
                {
                    log_message('error', '#ERRLOGPREMIUM: Old dag area flag found for this case, please check premium amount and area, if found accurate then proceed. Case No '. $case_no. 'and query is '.$this->db2->last_query());
                    // $settlement['old_dag_flag_message'] = '<h6 class="alert-danger text-danger text-center">Old dag area flag found for this case, please check premium amount and area, if found accurate then proceed. If you want to update the premium, you can use modification request</h6>';
                }
                else
                {
                    if($settlement_premium_insertion!=null && $settlement_premium_insertion['status'] == 1)
                    {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERROR99003: Unable to re calculate premium. Case No '. $case_no. 'and query is '.$this->db2->last_query());
                    }
                }
               
            }
            if($this->db2->trans_status() === FALSE)
            {
                $this->db2->trans_rollback();
            }else{
                $this->db2->trans_commit();
            }

        }
        // Premium Calculation Details End

        // Premium Calculation Details for Cultivator
        if($settlement['settlement_basic']["service_code"] == SETTLEMENT_SPECIAL_CULTIVATORS_ID)
        {
            $this->db2->trans_begin();
            $settlement_premium_insertion = $this->basundharaMb2Perpetualmodel->premiumReCalculationTea($this->db2,$case_no);

            if($settlement_premium_insertion != null)
            {   
                $data['old_dag_flag_message'] = false;
                if($settlement_premium_insertion['status'] == 3)
                {
                    log_message('error', '#ERRLOGPREMIUMTEA: Old dag area flag found for this case, please check premium amount and area, if found accurate then proceed. Case No '. $case_no. 'and query is '.$this->db2->last_query());
                }
                else
                {
                    if($settlement_premium_insertion!=null && $settlement_premium_insertion['status'] == 1)
                    {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRLOGPREMIUMTEA2: Unable to re calculate premium. Case No '. $case_no. 'and query is '.$this->db2->last_query());
                    }
                }
               
            }
            if($this->db2->trans_status() === FALSE)
            {
                $this->db2->trans_rollback();
            }else{
                $this->db2->trans_commit();
            }

        }
        // Premium Calculation Details for Cultivator End

        $settlement['premium_data']  = $this->basundharaMb2Perpetualmodel->getSettlementPremium($case_no);
        $settlement['landmark_data'] = $this->basundharaMb2Perpetualmodel->getSettlementDagArea($case_no);
        $settlement['possession_data']   = $this->basundharaMb2Perpetualmodel->getAllPossessionDetails($case_no);


        //*******getting the deleted settlement_dag_details data from settlement_deleted_data table */
        $deletedEnc=$this->basundharaMb2Perpetualmodel->getDeletedEncroacher($case_no);
        $deletedEncArray = array();
        foreach($deletedEnc as $encroacherDeleted_data)
        {
            $deletedEncArray[] = json_decode($encroacherDeleted_data->table_data);
        }
        $settlement['deleted_encroacher'] = $deletedEncArray;

        //***********getting the settlement_applicant occupiers data from settlement_deleted_data table */
        $deletedDags=$this->basundharaMb2Perpetualmodel->getDeletedDags($case_no);
        $deletedData = array();
        foreach($deletedDags as $deleteDag){
            $deletedData[] = json_decode($deleteDag->table_data);
        }
        $settlement['deleted_dags'] = $deletedData;
        

         //****getting tribe cat and under tribal belt data from backup */
        $getJsonBackup = $this->basundharaMb2Perpetualmodel->getJsonDataFromBackup($case_no);
        if(isset($getJsonBackup))
        {
            if($getJsonBackup)
            {
                $json_settlement =  json_decode($getJsonBackup->data);

                foreach($json_settlement->settlements as $jsonSettle)
                {
                    if($jsonSettle->is_applicant == 1)
                    {
                        $settlement['backup_tribe_category'] = $jsonSettle->tribe_category;
                        $settlement['backup_under_tribe_belts'] = $jsonSettle->under_tribe_belts;
                    }
                }
            }
        }

        //calling API for Aadhaar photo 
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, API_LINK . "getApplicantPhoto");

        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'application_no'             => $application_no,

        )));
        $get_aadhaar_photo = curl_exec($curl_handle);
        curl_close($curl_handle);


        if ($get_aadhaar_photo != 'n') {
            $settlement['aadhaar_b64_decoded'] = "<img src = data:" . $this->imageDecodeBase64($get_aadhaar_photo) . ";base64," . $get_aadhaar_photo . " class='img-thumbnail' alt='Adhar Photo' width='170' height='200'>";
        }

        //calling API for Aadhaar photo end

        //   calling API for self declaration data
        $sql = "Select basundhara from basundhar_application where dharitree='$case_no' ";
        $settlement['rtps_app_no'] = $basundhara = $this->db2->query($sql)->row();

        $url = API_LINK . "serviceResponseBasu?application_no=" . $application_no;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);

        $settlement['documents'] = $output->documents;
        $settlement['query'] = $output->query;
        $settlement['property'] = $output->property;
        $settlement['aadhar'] = $output->aadhar;

        $settlement['nextKin'] = $output->nextKin;
        foreach ($output->selfDeclaration as $selfDec) {
            $settlement['selfDeclarationDetails'] = json_decode($selfDec->dec_details);
        }

        if (isset($case_no)) {

            if ($output->application->service_code == SETTLEMENT_TENANT_ID) {
                $settlement['service_name'] = 'SETTLEMENT TENANT';
                $settlement['_view'] = 'SettlementView/Dept/SettlementTenantView';
            } elseif ($output->application->service_code == SETTLEMENT_AP_TRANSFER_ID) {
                $settlement['service_name'] = 'SETTLEMENT AP TRANSFER LAND';
                $settlement['_view'] = 'SettlementView/Dept/SettlementApTransferredView';
            } elseif ($output->application->service_code == SETTLEMENT_TRIBAL_COMMUNITY_ID) {
                $settlement['service_name'] = 'SETTLEMENT TRIBAL COMMUNITY';
                $settlement['_view'] = 'SettlementView/Dept/SettlementTribalCommunityView';
            } elseif ($output->application->service_code == SETTLEMENT_KHAS_LAND_ID) {
                $settlement['service_name'] = 'SETTLEMENT KHAS LAND';
                $settlement['_view'] = 'SettlementView/Dept/SettlementKhasLandView';
            } elseif ($output->application->service_code == SETTLEMENT_PGR_VGR_LAND_ID) {
                $settlement['service_name'] = 'SETTLEMENT VGR PGR LAND';
                $settlement['_view'] = 'SettlementView/Dept/SettlementPgrVgrView';
            } elseif ($output->application->service_code == SETTLEMENT_SPECIAL_CULTIVATORS_ID) {
                $settlement['service_name'] = 'SETTLEMENT SPECIAL CULTIVATORS';
                $settlement['_view'] = 'SettlementView/Dept/SettlementSpecialCultivatorsView';
            }
        } else {
            $settlement['_view'] = 'SettlementView/Dept/CaseNotFound';
        }
        $this->load->view('layouts/main', $settlement);
    }
    //////////////////////////

    // Document View API From RTPS
    function document($doc)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, API_LINK . "attachment");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'name' => $doc
        )));
        $result = curl_exec($curl_handle);
        $result = json_decode($result);
        $output = $result->raw_data;
        $content_type = $result->mime_type;
        $check = explode("/", $content_type);
        if ($check[1] == 'pdf') {
            $output = base64_decode($output);
            header('Content-type: application/pdf');
            echo $output;
        } else {
            echo '<img src="data:' . $content_type . ';base64,' . $output . '" />';
        }
    }

    ///////////////////////////////////




    //////////////////////////Department Service Wise///////////////////

    public function SettlementLandingDept($serve_code)
    {
        $data['service_code'] = $service_code =  $serve_code; //$this->uri->segment(4);

        $data['pendingcount'] = $this->db2->query("select count(*) as c from  settlement_basic where service_code = '$service_code' and from_office = 'DC' and pending_officer = 'DPT' and status='W'")->row()->c;

        $data['approvedcount'] = $this->db2->query("select count(*) as c from  settlement_basic where service_code = '$service_code' and from_office = 'DPT' and pending_officer = 'CO' and status = 'M' and dept_approval = 'Y'")->row()->c;

        $data['rejectedcount'] = $this->db2->query("select count(*) as c from  settlement_basic where service_code = '$service_code' and from_office = 'DPT' and pending_officer = 'DC' and status=''")->row()->c;

        $data['_view'] = 'SettlementView/Dept/SettlementLandingView';

        $this->load->view('layouts/main', $data);
    }







    // Document view API at LM END

    public function viewDharitreeDocument($dist_code, $doc_id)

    {

        $url = 'http://172.16.3.95/dharrtpsapi/index.php/DharRtpsApi/downloadDocument';
       // $url = 'http://' . $this->getApiIp($dist_code) . '/dharrtpsapi/index.php/DharRtpsApi/downloadDocument';

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'dist_code' => $dist_code,
            'doc_id' => $doc_id,
        )));
        $result = curl_exec($curl_handle);
        curl_close($curl_handle);
        //echo json_encode($result); 
        // log_message("error", "Not Getting API Data :" . json_encode($result));
        if (!$result || $result == null) {
            log_message("error", "Not Getting API Data :" . json_encode($result));
            return null;
        }
        $document_info = $this->decodeBase64($result)['content_type'];
        $decoded = base64_decode($result);
        header('Content-type: ' . $document_info . ';charset=utf-8');
        echo $decoded;
    }
    function getApiIp($dist_code)
    {
        $dist_35 = array('02', '03', '05', '06', '07', '13', '14', '15', '17', '18', '25');
        if (in_array($dist_code, $dist_35))
            return GET_API_IP;
        else
            return '10.177.0.34';
    }
    public function decodeBase64($encoded_string)
    {
        $file_data = base64_decode($encoded_string);
        $file = finfo_open();
        $mime_type = finfo_buffer($file, $file_data, FILEINFO_MIME_TYPE);

        $file_type = explode('/', $mime_type)[0];
        $extension = explode('/', $mime_type)[1];

        $acceptable_mimetypes = [
            'application/pdf',
            'image/jpg',
            'image/jpeg',
            'image/png',
        ];


        if (!in_array($mime_type, $acceptable_mimetypes)) {
            log_message("error", "error occured" . json_encode($mime_type));
            throw new \Exception('File mime type not acceptable');
        }
        log_message("error", "No error occured" . json_encode($mime_type));
        return array('content_type' => $mime_type, 'extension' => $extension);
    }




    // Newly Added on 31/10/2022

    // case search page
    public function departmentCaseSearch()
    {
        $data['cases']      = '';
        $data['casesCount'] = 0;

        $data['_view'] = 'SettlementView/Dept/CaseSearchPageDept';
        $this->load->view('layouts/main', $data);
    }


    public function searchCasesWithData()
    {
        $caseNo        = trim($this->input->post('caseNo'));
        $applicationNo = trim($this->input->post('applicationNo'));
        $serviceType   = trim($this->input->post('serviceType'));
        $appStatus     = trim($this->input->post('appStatus'));
        $pendingOffice = trim($this->input->post('pendingOffice'));
        $fromDate      = trim($this->input->post('fromDate'));
        $toDate        = trim($this->input->post('toDate'));
        $dist_code     = trim($this->input->post('selectDistrict'));
        $cir_code  = trim($this->input->post('selectCircle'));

        $cases = '';
        $casesCount = 0;
        $data['dist_code'] = $dist_code;
        $data['serviceType'] = $serviceType;
        $data['cir_code'] = $cir_code;
        $data['appStatus'] = $appStatus;

        //Get Department User district List
        $data['user_dist']      = $this->getDeptUserDistList();

        $this->form_validation->set_rules('selectDistrict', 'Please Select District Before Proceed', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['cases']      = '';
            $data['casesCount'] = 0;
            $this->session->set_flashdata('message', 'Please Select District Before Proceed.');
            $data['_view'] = 'SettlementView/Dept/CaseSearchPageDept';
            $this->load->view('layouts/main', $data);
        } else {

            if ($dist_code == '' and $caseNo == ''  and $applicationNo == '' and $serviceType == '' and $appStatus == '' and $pendingOffice == '' and $fromDate == '' and $toDate == '' and $cir_code == '') {

                $data['cases']      = '';
                $data['casesCount'] = 0;

                $data['_view'] = 'SettlementView/Dept/CaseSearchPageDept';
                $this->load->view('layouts/main', $data);
            } else {
                // only case number
                if ($caseNo != '') {
                    $this->db2 =  $this->dbswitch2($dist_code);

                    $cases = $this->basundharaMb2Perpetualmodel->getCasesByCaseNo($caseNo);
                    $data['cases']      = $cases->result();
                    $data['casesCount'] = $cases->num_rows();

                    $data['_view'] = 'SettlementView/Dept/CaseSearchPageDept';
                    $this->load->view('layouts/main', $data);
                }
                else if ($applicationNo != ''){
                    $this->db2 =  $this->dbswitch2($dist_code);

                    $cases = $this->basundharaMb2Perpetualmodel->getCasesByApplicationNo($applicationNo);
                    $data['cases']      = $cases->result();
                    $data['casesCount'] = $cases->num_rows();

                    $data['_view'] = 'SettlementView/Dept/CaseSearchPageDept';
                    $this->load->view('layouts/main', $data);
                }

                 else {
                    if ($fromDate != '' and $toDate != '') {
                        $this->db2 =  $this->dbswitch2($dist_code);

                        $cases = $this->basundharaMb2Perpetualmodel->getCasesByRespectedDataWithDateRage($serviceType, $appStatus, $pendingOffice, $fromDate, $toDate, $cir_code);

                        $data['cases']      = $cases->result();
                        $data['casesCount'] = $cases->num_rows();

                        $data['_view'] = 'SettlementView/Dept/CaseSearchPageDept';
                        $this->load->view('layouts/main', $data);
                    } else {
                        $this->db2 =  $this->dbswitch2($dist_code);

                        $cases = $this->basundharaMb2Perpetualmodel->getCasesByRespectedData($serviceType, $appStatus, $pendingOffice, $fromDate, $toDate, $cir_code);

                        $data['cases']      = $cases->result();
                        $data['casesCount'] = $cases->num_rows();

                        $data['_view'] = 'SettlementView/Dept/CaseSearchPageDept';
                        $this->load->view('layouts/main', $data);
                    }
                }
            }
        }
    }





    // Newly Added on 19/11/2022

    //Aadhaar Wise Applications by Applicant
    public function apiAadharWiseApplication()
    {
        $application_no = $this->input->get('app');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => AADHAR_APPLICATION_API_LINK . "?application_no=" . $application_no,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'application_no=' . $application_no,
        ));

        $output = curl_exec($curl);
        curl_close($curl);
        $output = json_decode($output);
        log_message('error', 'AADHAAR_DATA: ' . json_encode($output->applications));
        // if ($output->applications[1] == "" || $output->applications[1] == null) {
        //     $this->session->set_flashdata('message', "Data not found!!");
        //     redirect(base_url() . "index.php");;
        // } else {
        //     $lmdata['applications'] = $output->applications[1];
        // }
        $lmdata['applications'] = $output->applications;
        $lmdata['_view'] = 'SettlementView/Dept/AadhaarWiseApplicationView';
        $this->load->view('layouts/main', $lmdata);
    }




    // Dag wise Applications
    public function apiDagWiseApplication()
    {

        $application_no = $this->input->get('app');
        $dag_no = $this->input->get('dag_no');

        $token = $this->utilclass->createTokenJwt();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, API_LINK_MB2 . "getAppDetails");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'application_no' => $application_no,
            'api_key' => API_KEY,
            'token' => $token,
        )));
        $output = curl_exec($curl_handle);
        if (isset(json_decode($output)->responseType)) {
            if (json_decode($output)->responseType == 3) {
                echo json_decode($output)->data . " - Unauthorized access!!!!!!";
                return false;
            }
        }
        curl_close($curl_handle);

        $output = json_decode($output);
        $district['app'] = $output->application;

        $dist_code = $district['app']->dist_code;
        $subdiv_code = $district['app']->subdiv_code;
        $cir_code = $district['app']->cir_code;
        $mouza_code = $district['app']->mouza_code;
        $lot_no = $district['app']->lot_no;
        $village_code = $district['app']->village_code;
        $dag_no = $dag_no;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => API_LINK_MB2 . 'applicantAppliedForSettlementServicesByDagNo',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'dist_code' => $dist_code,
                'subdiv_code' => $subdiv_code,
                'cir_code' => $cir_code,
                'mouza_code' => $mouza_code,
                'lot_no' => $lot_no,
                'village_code' => $village_code,
                'dag_no' => $dag_no,
            ),
        ));

        $output = curl_exec($curl);
        curl_close($curl);
        $output = json_decode($output);

        if ($output->appiledDetails == "" || $output->appiledDetails == null) {
            $this->session->set_flashdata('message', "Data not found!!");
            redirect(base_url() . "index.php/home");
        } else {
            $lmdata['applications'] = $output->appiledDetails;
            $lmdata['service_code'] = $district['app']->service_code;
        }


        $lmdata['_view'] = 'SettlementView/Dept/DagWiseApplicationView';
        $this->load->view('layouts/main', $lmdata);
    }



    // Newly Added For Pagignation
    // pagination basundhara end with API -js-
    public function paginationAPI()
    {

        $this->db = $this->load->database('db2', TRUE);
        $dept_user_code = $this->session->userdata('user_code');
        $sql = "SELECT dist_code FROM user_dist_byforcation WHERE user_code = '$dept_user_code'";
        $dept_district = $this->db->query($sql)->result();
        $dist_codes = array_column($dept_district, 'dist_code');
        $dist_list = implode(',', $dist_codes);
        $service = $this->input->post('service');

        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        // var_dump($start);

        // $search = $this->input->post('search');
        // $search = $search['value'];

        $searchByCol_0 = trim($this->input->post('columns')[0]['search']['value']);
        $searchByCol_1 = trim($this->input->post('columns')[1]['search']['value']);

        // $is_cat = $this->input->post('is_category');

        // $is_rural = $this->input->post('rural');

        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_URL, API_LINK . "getDepartmentCasesByDistricts/$service/?dist_codes=" . $dist_list);

        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'start'             => $start,
            'length'            => $length,
            'order'             => $order,
            'searchByCol_0'     => $searchByCol_0,
            'searchByCol_1'     => $searchByCol_1,
            // 'is_cat'            => $is_cat,
            // 'is_rural'          => $is_rural,
        )));
        $result = curl_exec($curl_handle);
        $results = json_decode($result);


        if (isset($results)) {

            foreach ($results as $rows) {

                $tenant_link = '<a type="button" href="' . base_url() . 'index.php/Basundhara/settlementBasu?app=' . $rows->application_no . '&dist_code=' . $rows->dist_code . '" class="lmreportmut btn-sm btn btn-success">
                    View Details</a>';
                $tribal_link = '<a type="button" href="' . base_url() . 'index.php/Basundhara/settlementBasu?app=' . $rows->application_no . '&dist_code=' . $rows->dist_code . '" class="lmreportmut btn-sm btn btn-success">
                    View Details</a>';
                $ap_link = '<a type="button" href="' . base_url() . 'index.php/Basundhara/settlementBasu?app=' . $rows->application_no . '&dist_code=' . $rows->dist_code . '" class="lmreportmut btn-sm btn btn-success">
                    View Details</a>';
                $khas_link = '<a type="button" href="' . base_url() . 'index.php/Basundhara/settlementBasu?app=' . $rows->application_no . '&dist_code=' . $rows->dist_code . '" class="lmreportmut btn-sm btn btn-success">
                    View Details</a>';
                $vgr_link = '<a type="button" href="' . base_url() . 'index.php/Basundhara/settlementBasu?app=' . $rows->application_no . '&dist_code=' . $rows->dist_code . '" class="lmreportmut btn-sm btn btn-success">
                    View Details</a>';
                $tea_link = '<a type="button" href="' . base_url() . 'index.php/Basundhara/settlementBasu?app=' . $rows->application_no . '&dist_code=' . $rows->dist_code . '" class="lmreportmut btn-sm btn btn-success">
                    View Details</a>';

                $json[] = array(
                    '<span class="px-3"><strong>' . $rows->application_no . '</strong></span>',
                    date("j F, Y", strtotime($rows->date_submission)),
                    $this->utilclass->getServiceName($rows->service_code),
                    $this->utilclass->getDistrictNameOnLanding($rows->dist_code),
                    (($service == SETTLEMENT_TENANT_ID) ? $tenant_link : (($service == SETTLEMENT_AP_TRANSFER_ID) ? $ap_link : (($service == SETTLEMENT_TRIBAL_COMMUNITY_ID) ? $tribal_link : (($service == SETTLEMENT_KHAS_LAND_ID) ? $khas_link : (($service == SETTLEMENT_PGR_VGR_LAND_ID) ? $vgr_link : (($service == SETTLEMENT_SPECIAL_CULTIVATORS_ID) ? $tea_link : '')))))),
                );
            }

            $total_records = '50';

            $response = array(
                'draw'              => $draw,
                'recordsTotal'      => $total_records,
                'recordsFiltered'   => $total_records,
                'data'              => $json
            );
            echo json_encode($response);
        } else {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }






    // cases by Proposals under Department
    public function deptProposalList()
    {
        $data['proposals']      = '';
        $data['proposalsCount'] = 0;

        $data['_view'] = 'SettlementView/Dept/ProposalSearchPageDept';
        $this->load->view('layouts/main', $data);
    }


    public function searchProposalWIthData()
    {
        if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) {

            $data['user_dist'] =  $this->getDeptUserDistList();

            $serviceType   = trim($this->input->post('serviceType'));
            $dist_code     = trim($this->input->post('selectDistrict'));
            $caseNo        = trim($this->input->post('caseNo'));


            $proposals = '';
            $proposalsCount = 0;
            $data['dist_code'] = $dist_code;
            $data['service_code'] = $serviceType;

            $this->form_validation->set_rules('selectDistrict', 'Please Select District Before Proceed', 'required');
            $this->form_validation->set_rules('serviceType', 'Please Select Service Before Proceed', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['proposals']      = '';
                $data['proposalsCount'] = 0;
                $this->session->set_flashdata('message', 'Please Select District Before Proceed.');
                $data['_view'] = 'SettlementView/Dept/ProposalSearchPageDept';
                $this->load->view('layouts/main', $data);
            } else {

                $this->db2 =  $this->dbswitch2($dist_code);

                $proposals = $this->basundharaMb2Perpetualmodel->getProposalsByRespectedData($serviceType, $caseNo);

                $data['proposals']      = $proposals->result();
                $data['proposalsCount'] = $proposals->num_rows();

                $data['_view'] = 'SettlementView/Dept/ProposalSearchPageDept';
                $this->load->view('layouts/main', $data);
            }
        } else {
            echo "User Not Authorized to View this Page";
        }
    }





    // VLB Encroacher Details

    public function vlbEncroacherDetails()
    {
        if (isset($_GET['dag']) && isset($_GET['m']) && isset($_GET['l']) && isset($_GET['v']) && isset($_GET['dist']) && isset($_GET['cir']) && isset($_GET['sub_div'])) {

            $dist_code = $this->input->get('dist');
            $subdiv_code = $this->input->get('sub_div');
            $circle_code = $this->input->get('cir');
            $mouza_code = $this->input->get('m');
            $lot_no = $this->input->get('l');
            $vill_townprt_code = $this->input->get('v');
            $dag_no = $this->input->get('dag');

            // Switch DB based on dist_code
            $this->db2 = $this->dbswitch2($dist_code);

            $vlb_encroacher = $this->basundharaMb2Perpetualmodel->getEncroacherDetails($dist_code, $subdiv_code, $circle_code, $mouza_code, $lot_no, $vill_townprt_code, $dag_no);
            $vlb_enc['vlb_enc'] = $vlb_encroacher;
            if ($vlb_encroacher == true) {
                // getting the encroacher details
                $vlb_encroacher_in_dag = $this->basundharaMb2Perpetualmodel->getEncroacherInDag($vlb_encroacher->id);
                $vlb_enc['vlb_enc_details'] = $vlb_encroacher_in_dag;
            } else {
                $vlb_enc['empty_err'] = "No Land Bank Details found!!";
            }
            $vlb_enc['_view'] = 'SettlementView/Dept/VlbEncroacherDetails';
            $this->load->view('layouts/main', $vlb_enc);
        }
    }




    // Generate Chitha
    public function generateChitha()
    {
        $co_note = array();
        if (isset($_GET['case_no'])) {
            $case_no = $this->input->get('case_no');
            $district_code = $this->session->userdata('dist_code');
            $subdivision_code = $this->session->userdata('subdiv_code');
            $circlecode = $this->session->userdata('cir_code');
            $db = $this->session->userdata('db');

            if (isset($_GET['dag'])) {
                $dag = $this->input->get('dag');
            }
            if ($case_no == '0') {
                ////var_dump($this->session->all_userdata());
                $district_code = $this->session->userdata('dist_code');
                $subdivision_code = $this->session->userdata('subdiv_code');
                $circlecode = $this->session->userdata('cir_code');
                $mouzacode = $this->session->userdata('mouza_pargona_code');
                $lot_code = $this->session->userdata('lot_no');
                $village_code = $this->session->userdata('vill_code');
                $patta_code = $this->session->userdata('patta_type_code');
                $dag_no_lower = $this->session->userdata('dag_no');
                $dag_no_upper = $this->session->userdata('dag_no');
                $dag_no_lower = $dag_no_lower . '00';
                $dag_no_upper = $dag_no_upper . '00';
            } elseif ($case_no == '2') {
                //var_dump($this->session->all_userdata());
                $district_code = $this->session->userdata('dist_code');
                $subdivision_code = $this->session->userdata('subdiv_code');
                $circlecode = $this->session->userdata('cir_code');
                $mouzacode = $this->session->userdata('mouza_pargona_code');
                $lot_code = $this->session->userdata('lot_no');
                $village_code = $this->session->userdata('vill_townprt_code');
                $patta_code = '0201';
                //$dag_no_lower = $this -> session -> userdata('dag_no');
                //$dag_no_upper = $this -> session -> userdata('dag_no');
                $dag_no_lower = $dag . '00';
                $dag_no_upper = $dag . '00';
            } elseif ($case_no == '3') {
                //var_dump($this->session->all_userdata());
                $district_code = $this->session->userdata('dist_code');
                $subdivision_code = $this->session->userdata('subdiv_code');
                $circlecode = $this->session->userdata('cir_code');
                $mouzacode = $this->input->get('m');
                $lot_code = $this->input->get('l');
                $village_code = $this->input->get('v');
                $patta_code = $this->input->get('p');
                //$dag_no_lower = $this -> session -> userdata('dag_no');
                //$dag_no_upper = $this -> session -> userdata('dag_no');
                $dag_no_lower = $dag . '00';
                $dag_no_upper = $dag . '00';
            } elseif ($case_no == '4') {
                //var_dump($this->session->all_userdata());
                $district_code = $this->input->get('dist');
                $subdivision_code = $this->input->get('sub_div');
                $circlecode = $this->input->get('cir');
                $mouzacode = $this->input->get('m');
                $lot_code = $this->input->get('l');
                $village_code = $this->input->get('v');
                $patta_code = $this->input->get('p');
                //$dag_no_lower = $this -> session -> userdata('dag_no');
                //$dag_no_upper = $this -> session -> userdata('dag_no');
                $dag_no_lower = $dag . '00';
                $dag_no_upper = $dag . '00';
            } elseif ($case_no == '1') {
                //this is for land reclassification
                $case_id = $this->input->get('case_id');
                $proposal_no = $this->input->get('proposal_no');
                $t_reclassification = $this->db->query("Select * from  t_reclassification where proposal_no = '$proposal_no' and case_no = '$case_id'")->row();
                $district_code = $t_reclassification->dist_code;
                $subdivision_code = $t_reclassification->subdiv_code;
                $circlecode = $t_reclassification->cir_code;
                $mouzacode = $t_reclassification->mouza_pargona_code;
                $lot_code = $t_reclassification->lot_no;
                $village_code = $t_reclassification->vill_townprt_code;

                $patta_code = $t_reclassification->patta_type_code;
                $dag_no_lower = $t_reclassification->dag_no;
                $dag_no_upper = $t_reclassification->dag_no;
                $dag_no_lower = $dag_no_lower . '00';
                $dag_no_upper = $dag_no_upper . '00';
            } else {
                $petition_basic = $this->db->query("Select * from   petition_basic where case_no = '$case_no' and dist_code='$district_code' and subdiv_code='$subdivision_code' and cir_code='$circlecode' ")->row();
                $landdetails = $this->db->query("select dag_no,m_dag_area_b,m_dag_area_k,m_dag_area_lc,patta_no,patta_type_code from   petition_dag_details where dist_code='$petition_basic->dist_code' and" . " subdiv_code='$petition_basic->subdiv_code' and cir_code='$petition_basic->cir_code' and " . "lot_no='$petition_basic->lot_no' and vill_townprt_code='$petition_basic->vill_townprt_code' and " . "mouza_pargona_code='$petition_basic->mouza_pargona_code' and petition_no='$petition_basic->petition_no'")->row_array();

                $district_code = $petition_basic->dist_code;
                $subdivision_code = $petition_basic->subdiv_code;
                $circlecode = $petition_basic->cir_code;
                $mouzacode = $petition_basic->mouza_pargona_code;
                $lot_code = $petition_basic->lot_no;
                $village_code = $petition_basic->vill_townprt_code;

                $patta_code = $landdetails['patta_type_code'];
                $dag_no_lower = $landdetails['dag_no'];
                $dag_no_upper = $landdetails['dag_no'];
                $dag_no_lower = $dag_no_lower . '00';
                $dag_no_upper = $dag_no_upper . '00';
            }
        } else {
            $location = $this->utilityclass->getLocationFromSession();
            ////var_dump($location);
            $district_code = $_SESSION['chitha_report']['chitha_dist_code'];
            $subdivision_code = $_SESSION['chitha_report']['chitha_subdiv_code'];
            $circlecode = $_SESSION['chitha_report']['chitha_cir_code'];
            $mouzacode = $_SESSION['chitha_report']['chitha_mouza_pargona_code'];
            $lot_code  = $_SESSION['chitha_report']['chitha_lot_no'];
            $village_code = $_SESSION['chitha_report']['chitha_vill_code'];

            $patta_code = $this->input->post('patta_code');
            $dag_no_lower = $this->input->post('dag_no_lower');
            $dag_no_upper = $this->input->post('dag_no_upper');

            //////// Druno 6/4/22

            $get_dag_no_lower = $this->db->query(
                "select dag_no from chitha_basic WHERE 
        dist_code=? AND subdiv_code=? AND cir_code=? AND mouza_pargona_code=? AND lot_no=? AND vill_townprt_code=? and 
        dag_no_int=?",
                array($district_code, $subdivision_code, $circlecode, $mouzacode, $lot_code, $village_code, $dag_no_lower)
            )->row()->dag_no;

            $get_dag_no_upper = $this->db->query(
                "select dag_no from chitha_basic WHERE 
                dist_code=? AND subdiv_code=? AND cir_code=? AND mouza_pargona_code=? AND lot_no=? AND vill_townprt_code=? and dag_no_int=?",
                array($district_code, $subdivision_code, $circlecode, $mouzacode, $lot_code, $village_code, $dag_no_upper)
            )->row()->dag_no;

            $co_note_data = $this->db->query(
                "select co_note,dag_no from t_legacyupdation WHERE 
                dist_code=? AND subdiv_code=? AND cir_code=? AND mouza_pargona_code=? AND lot_no=? AND vill_townprt_code=? and dag_no between '$get_dag_no_lower' and '$get_dag_no_upper' and status='F' ",
                array($district_code, $subdivision_code, $circlecode, $mouzacode, $lot_code, $village_code, $get_dag_no_lower)
            );
            if ($co_note_data->num_rows() > 0) {
                $co_note['co_note'] = $co_note_data->result();
            } else {
                $co_note['co_note'] = null;
            }
            //// end Druno
        }

        $dist_name = $this->utilityclass->getDistrictName($district_code);
        $subdiv_name = $this->utilityclass->getSubDivName($district_code, $subdivision_code);
        $cir_name = $this->utilityclass->getCircleName($district_code, $subdivision_code, $circlecode);
        $mouza_pargona_code_name = $this->utilityclass->getMouzaName($district_code, $subdivision_code, $circlecode, $mouzacode);
        $lot_no = $this->utilityclass->getLotLocationName($district_code, $subdivision_code, $circlecode, $mouzacode, $lot_code);
        $vill_townprt_code_name = $this->utilityclass->getVillageName($district_code, $subdivision_code, $circlecode, $mouzacode, $lot_code, $village_code);

        $data['location'] = array('dist' => $dist_name, 'sub' => $subdiv_name, 'cir' => $cir_name, 'mouza' => $mouza_pargona_code_name, 'lot' => $lot_no, 'vill' => $vill_townprt_code_name);


        $secondSelection = array('patta_code' => $patta_code, 'dag_no_lower' => $dag_no_lower, 'dag_no_upper' => $dag_no_upper);

        $this->load->model('chitha/ChithaModel');
        $pattatype['chithaPattatypeinfo'] = $this->ChithaModel->getpattatype($patta_code);
        $this->session->set_userdata(array('patta_type' => $pattatype['chithaPattatypeinfo'][0]->patta_type));

        if ($patta_code != '0000') {
            if (in_array($this->session->userdata('dist_code'), json_decode(BARAK_VALLEY))) {
                $chithainfo1['data'] = $this->ChithaModel->getchithaDetails123Barak($district_code, $subdivision_code, $circlecode, $mouzacode, $lot_code, $village_code, $dag_no_lower, $dag_no_upper, $patta_code);
            } else {
                $chithainfo1['data'] = $this->ChithaModel->getchithaDetails123($district_code, $subdivision_code, $circlecode, $mouzacode, $lot_code, $village_code, $dag_no_lower, $dag_no_upper, $patta_code);
            }
            //var_dump($chithainfo1['data']);
        } else {
            if (in_array($this->session->userdata('dist_code'), json_decode(BARAK_VALLEY))) {
                $chithainfo1['data'] = $this->ChithaModel->getchithaDetailsALLBarak($district_code, $subdivision_code, $circlecode, $mouzacode, $lot_code, $village_code, $dag_no_lower, $dag_no_upper);
            } else {
                $chithainfo1['data'] = $this->ChithaModel->getchithaDetailsALL($district_code, $subdivision_code, $circlecode, $mouzacode, $lot_code, $village_code, $dag_no_lower, $dag_no_upper);
            }
            //$chithainfo1['data'] = $this->ChithaModel->getchithaDetails2($district_code, $subdivision_code, $circlecode, $mouzacode, $lot_code, $village_code, $dag_no_lower, $dag_no_upper);
            //var_dump($chithainfo1);
        }

        //$maindataforchitha = array_merge($data, $secondSelection, $chithainfo1, $pattatype);  //// Druno 6/4/22
        $maindataforchitha = array_merge($data, $secondSelection, $chithainfo1, $pattatype, $co_note);

        //#START PLB

        $dist_code = $this->session->userdata('dist_code');
        if (in_array($dist_code, json_decode(BARAK_VALLEY))) {
            $maindataforchitha['_view'] = 'chitha_report/saveChithaReportKar';
        } else {
            $maindataforchitha['_view'] = 'chitha_report/saveChithaReport';
        }

        //#END PLB
        $this->load->view('layouts/main', $maindataforchitha);
    }



    // Get Bhumiputra Certificate Details
    public function bhumiPutra_old()
    {
        $certificate_number = isset($_GET['cer_number']) ? $_GET['cer_number'] : null;

        $ack_number = isset($_GET['ack_number']) ? $_GET['ack_number'] : null;

        if (isset($certificate_number)) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => API_LINK_MB2 . 'getBhumiputraCertificate',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'certificate_no' => $certificate_number,
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            if ($response == true || $response) {
                $base64data = base64_decode($response, true);
                header("Content-type: application/pdf");
                echo $base64data;
            }
            $this->session->set_flashdata('message', "Failed to load file. File not found!");
            redirect('/home');
        } elseif (isset($ack_number)) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => API_LINK . 'getBhumiputraCertificate',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'acknowledgement_no' => $ack_number,
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            if ($response == true || $response) {
                $base64data = base64_decode($response, true);
                header("Content-type: application/pdf");
                echo $base64data;;
            }
            $this->session->set_flashdata('message', "Failed to load file!");
            redirect('/home');
        }
    }









    // get all application under specific Proposal No
    public function getAllApplicationUnderProposalDept()
    {
        $proposal_no = $this->input->get('proposal');
        $dist_code = $this->input->get('dist_code');
        $service_code = $this->input->get('service_code');


        // Switch DB based on dist_code
        $this->db2 = $this->dbswitch2($dist_code);

        $pendingCase = $this->basundharaMb2Perpetualmodel->getAllCasesUnderProposalDept($proposal_no, $dist_code);

        $remainingCase = $this->basundharaMb2Perpetualmodel->getRemainingCasesUnderProposalDept($proposal_no, $dist_code);

        $data['dist_code']        = $dist_code;
        $data['service_code']      = $service_code;
        $data['proposal_no']      = $proposal_no;
        $data['cases']            = $pendingCase->result();
        $data['pendingCaseCount'] = $pendingCase->num_rows();
        $data['remainingCaseCount'] = $remainingCase->num_rows();
        $data['_view'] = 'SettlementView/Dept/AllCasesListUnderProposalsDept';
        $this->load->view('layouts/main', $data);
    }




    // Search proposal ID by Case / Application Number
    public function searchProposalIdByAppCaseNo()
    {



        $_POST = json_decode(file_get_contents("php://input"), true);


        $dist_code = $_POST['districtId'];


        $case_no = '';
        $this->db2 = $this->dbswitch2($dist_code);

        if (trim($this->input->post('caseNo')) != null or trim($this->input->post('caseNo')) != '') {
            $this->form_validation->set_rules('caseNo', 'Case Number', 'trim|required|min_length[10]|max_length[70]');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array(
                    'responseType' => 1,
                ));
                return;
            } else {
                $case_no = trim($this->input->post('caseNo'));
            }
        } else {
            $this->form_validation->set_rules('applicationNo', 'Application Number', 'trim|required|min_length[10]|max_length[70]');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array(
                    'responseType' => 1,
                ));
                return;
            } else {
                $app_no = trim($this->input->post('applicationNo'));


                $countApplicationDetails = $this->basundharaMb2Perpetualmodel->countApplicationDetailsByAppNo($app_no);

                if ($countApplicationDetails == '' or $countApplicationDetails == 0) {
                    echo json_encode(array(
                        'responseType' => 3,

                    ));
                    return;
                }



                $getApplicationDetails = $this->basundharaMb2Perpetualmodel->getApplicationDetailsByAppNo($app_no);
                $case_no = $getApplicationDetails->case_no;
            }
        }

        if (trim($case_no) == null or trim($case_no) == '') {
            echo json_encode(array(
                'responseType' => 3,
            ));
            return;
        }

        $countCaseIdSdlacProposal = $this->basundharaMb2Perpetualmodel->countProposalIdByCaseNo($case_no);

        if ($countCaseIdSdlacProposal == '' or $countCaseIdSdlacProposal == 0) {
            echo json_encode(array(
                'responseType' => 3,
            ));
            return;
        }


        $getSdlacProposalID = $this->basundharaMb2Perpetualmodel->getProposalIdByCaseNo($case_no);

        echo json_encode(array(
            'responseType' => 2,
            'proposalIds' => $getSdlacProposalID,
        ));
        return;
    }






    // Bulk Approve by Department
    public function bulkApproveByDepartment()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);



        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('department_remarks_approve', 'Approval Remarks', 'trim|required|min_length[2]|max_length[3000]');
        $this->form_validation->set_rules('dept_order_date', 'Order Date', 'trim|required');
        $this->form_validation->set_rules('dept_order_no', 'Order Date', 'trim|required');
        $this->form_validation->set_rules('proposal_id_approve', 'Proposal ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('district_id_approve', 'District ID', 'trim|required|is_natural');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Check Form Data',
            ));
        } else {
            $proposal_no     = $this->input->post('proposal_id_approve');
            $dist_code   = $this->input->post('district_id_approve');
            $currentDate = date('Y-m-d');
            $dept_order_date = date("Y-m-d", strtotime($this->input->post('dept_order_date')));
            $dept_order_no = $this->input->post('dept_order_no');
            $department_remarks     = $this->input->post('department_remarks_approve');
            $allSelectedList = $this->input->post('selectedList');

            $this->db2 = $this->dbswitch2($dist_code);

            if ($currentDate > $dept_order_date) {
                echo json_encode(array(
                    'responseType' => 3,
                    'message' => 'Please Enter Order Date Properly. Order Date can not be less than Current Date',
                ));
                return;
            }

            if (!empty($allSelectedList)) {
                $this->db2->trans_begin();

                foreach ($allSelectedList as $row) {
                    // Update in Settlement Basic
                    $case_no = $row;
                    $updateData = array(
                        'status' => MB_PAYMENT_REQUEST,
                        'pending_officer' => MB_CIRCLE_OFFICER,
                        'pending_office' => MB_CIRCLE_OFFICER,
                        'dept_code' => MB_DEPARTMENT,
                        'dept_approval' => DPT_APPROVED,
                        'from_office'     => MB_DEPARTMENT,
                        'dept_order_no' => $dept_order_no,
                        'dept_order_date' => $dept_order_date
                    );

                    if ($this->basundharaMb2Perpetualmodel->updateSettlementBasicData($case_no, $updateData) <= 0) {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRDUPDATE0001: Updation failed in settlement_basic for bulk Approve');
                        log_message('error', $this->db2->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRDUPDATE0001: Updation failed in settlement_basic. Kindly contact System Administrator',

                        ));
                        return false;
                    }
                    // Update in Settlement Basic End

                    //////proceeding start//////
                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                    if ($proceeding_id == null) {
                        $proceeding_id = 1;
                    }

                    $insPetProceed = [
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'next_date_of_hearing' => date('Y-m-d h:i:s'),
                        'note_on_order' => $department_remarks,
                        'user_code' => MB_DEPARTMENT,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'office_from' => MB_DEPARTMENT,
                        'office_to'   => MB_CIRCLE_OFFICER,
                        'task' => 'Forwarded To CO',
                        'status' => MB_PAYMENT_REQUEST,
                        'note_type' => 'Maybe Approve',
                    ];
                    $insertProceeding = $this->db2->insert('settlement_proceeding', $insPetProceed);

                    if ($insertProceeding != 1) {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRORPP: Insertion failed in settlement_proceeding for case no :' . $case_no);
                        log_message('error', $this->db2->last_query());
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRADD0004: Failed to insert . Kindly contact System Administrator',

                        ));
                        return false;
                    }
                    //////proceeding end//////

                    //////////////UPDATE To Settlement_proposal_cases/////////////////////                                
                    $updateProposalData = array(
                        'dept_status' => DEPT_PROPOSAL_CASE_APPROVE,
                    );

                    if ($this->basundharaMb2Perpetualmodel->updateProposalData($case_no, $updateProposalData) <= 0) {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRDUPDATE0001: Updation failed in settlement_proposal_cases for bulk Approve');
                        log_message('error', $this->db2->last_query());
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRDUPDATE0001: Updation failed in settlement_proposal_cases. Kindly contact System Administrator',

                        ));
                        return false;
                    }

                    //////Update to Settlement_proposal_cases End//////

                    //////////////POST To basundhara/////////////////////
                    $application_no = $this->basundharaMb2Perpetualmodel->getApplicationNoByCaseNo($this->db2,$case_no)->applid;

                    $rmk = 'Approved  & Forwarded to CO';
                    $status = MB_PAYMENT_REQUEST;
                    $task = MB_DEPARTMENT;
                    $pen = MB_CIRCLE_OFFICER;
                    $case = $case_no;
                    $rtpsno = $application_no;

                    $rtps_status = $this->basundharaMb2Perpetualmodel->postApiBasundhara($rtpsno, $case, $rmk, $status, $task, $pen);
                    $rtps_status = json_decode($rtps_status);
                    //////////////POST To basundhara End///////////////
                    log_message('error','api_response: rtpsno: '.$rtpsno.'---'.json_encode($rtps_status));
                }
                if (trim($rtps_status) != 'y') {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('message', "Error #ERRAPP0011: Update Failed in API for Application_no # $rtpsno");
                    redirect(base_url() . "index.php/home");
                } else {
                    $this->db2->trans_commit();

                    echo json_encode(array(
                        'responseType' => 2,
                        'message' => 'Applications Approved  & Send to CO Successfully',

                    ));
                }
            }
        }
    }








    // Bulk Approve by Department
    public function bulkRevertByDepartment()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('department_remarks_revert', 'Revert Remarks', 'trim|required|min_length[2]|max_length[3000]');
        $this->form_validation->set_rules('proposal_id_revert', 'Proposal ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('district_id_revert', 'District ID', 'trim|required|is_natural');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !!. Check Form Data',
            ));
        } else {
            $proposal_no     = $this->input->post('proposal_id_revert');
            $dist_code   = $this->input->post('district_id_revert');
            $department_remarks     = $this->input->post('department_remarks_revert');
            $allSelectedList = $this->input->post('selectedList');

        $this->db2 = $this->dbswitch2($dist_code);

            if (!empty($allSelectedList)) {
                $this->db2->trans_begin();

                foreach ($allSelectedList as $row) {
                    // Update in Settlement Basic
                    $case_no = $row;
                    $updateData = array(
                        'status' => MB_REVERT,
                        'pending_officer' => MB_DEPUTY_COMM,
                        'dept_code' => MB_DEPARTMENT,
                        'dept_approval' => DPT_REVERTED,
                        'from_office'     => MB_DEPARTMENT,

                    );

                    if ($this->basundharaMb2Perpetualmodel->updateSettlementBasicData($case_no, $updateData) <= 0) {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRDUPDATE0001: Updation failed in settlement_basic for bulk Revert');
                        log_message('error', $this->db2->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRDUPDATE0001: Updation failed in settlement_basic. Kindly contact System Administrator',

                        ));
                        return false;
                    }
                    // Update in Settlement Basic End

                    //////proceeding start//////
                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                    if ($proceeding_id == null) {
                        $proceeding_id = 1;
                    }

                    $insPetProceed = [
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'next_date_of_hearing' => date('Y-m-d h:i:s'),
                        'note_on_order' => $department_remarks,
                        'user_code' => MB_DEPARTMENT,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'office_from' => MB_DEPARTMENT,
                        'office_to'   => MB_DEPUTY_COMM,
                        'task' => 'Revert to DC',
                        'status' => MB_REVERT,
                        'note_type' => 'Maybe Reject',
                    ];
                    $insertProceeding = $this->db2->insert('settlement_proceeding', $insPetProceed);

                    if ($insertProceeding != 1) {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRORPP: Insertion failed in settlement_proceeding for case no :' . $case_no);
                        log_message('error', $this->db2->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRADD0004: Failed to insert . Kindly contact System Administrator',

                        ));
                        return false;
                    }
                    //////proceeding end//////

                    //////////////UPDATE To Settlement_proposal_cases/////////////////////                                
                    $updateProposalData = array(
                        'dept_status' => DEPT_PROPOSAL_CASE_REVERT,
                    );

                    if ($this->basundharaMb2Perpetualmodel->updateProposalData($case_no, $updateProposalData) <= 0) {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRDUPDATE0001: Updation failed in settlement_proposal_cases for bulk Revert');
                        log_message('error', $this->db2->last_query());
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRDUPDATE0001: Updation failed in settlement_proposal_cases. Kindly contact System Administrator',

                        ));
                        return false;
                    }

                    //////Update to Settlement_proposal_cases End//////

                    //////////////POST To basundhara/////////////////////
                    $application_no = $this->basundharaMb2Perpetualmodel->getApplicationNoByCaseNo($this->db2,$case_no)->applid;

                    $rmk = 'Reverted to DC';
                    $status = MB_REVERT;
                    $task = MB_DEPARTMENT;
                    $pen = MB_DEPUTY_COMM;
                    $case = $case_no;
                    $rtpsno = $application_no;

                    $rtps_status = $this->basundharaMb2Perpetualmodel->postApiBasundhara($rtpsno, $case, $rmk, $status, $task, $pen);
                    $rtps_status = json_decode($rtps_status);

                    //////////////POST To basundhara End///////////////

                }
                if ($rtps_status != 'y') {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('message', "Error #ERRAPP0011: Update Failed in API for Application_no # $rtpsno");
                    redirect(base_url() . "index.php/home");
                } else {
                    $this->db2->trans_commit();

                    echo json_encode(array(
                        'responseType' => 2,
                        'message' => 'Applications Reverted  to DC Successfully',

                    ));
                }
            }
        }
    }




    // SDLAC section
    // cases by Proposals under SDLAC Login
    public function sdlacProposalList()
    {
        if ($this->session->userdata('designation') == SDLAC_USERCODE) {
            $data['proposals']      = '';
            $data['proposalsCount'] = 0;
            $data['_view'] = 'SettlementView/Sdlac/ProposalSearchPageSdlac';
            $this->load->view('layouts/main', $data);
        } else {
            echo "User Not Authorized to View this Page";
        }
    }


    // Get Proposal List From SDO/ADC at SDLAC end
    public function getAllProposalListUnderSdlac()
    {
        if ($this->session->userdata('designation') == SDLAC_USERCODE) {
            $serviceType   = trim($this->input->post('serviceType'));
            $dist_code     = $this->session->userdata('dist_code');
            $sdlac_user_code     = $this->session->userdata('unique_user_id');

            $proposals = '';
            $proposalsCount = 0;
            $data['dist_code'] = $dist_code;
            $data['service_code'] = $serviceType;

            $this->form_validation->set_rules('serviceType', 'Please Select Service Before Proceed', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['proposals']      = '';
                $data['proposalsCount'] = 0;
                $this->session->set_flashdata('message', 'Please Select Service Before Proceed.');
                $data['_view'] = 'SettlementView/Sdlac/ProposalSearchPageSdlac';
                $this->load->view('layouts/main', $data);
            } else {
                $this->db2 =  $this->dbswitch2($dist_code);
                $proposals = $this->basundharaMb2Perpetualmodel->getSdlacProposalsByService($serviceType, $sdlac_user_code);
                $data['proposals']  = $proposals->result();
                $data['proposalsCount'] = $proposals->num_rows();
                $data['_view'] = 'SettlementView/Sdlac/ProposalSearchPageSdlac';
                $this->load->view('layouts/main', $data);
            }
        } else {
            echo "User Not Authorized to View this Page";
        }
    }



    // View all application under specific Proposal No for SDLAC Login
    public function viewAllApplicationUnderProposalSdlac()
    {
        $proposal_no = $this->input->get('proposal');
        $dist_code     = $this->session->userdata('dist_code');
        $service_code = $this->input->get('service_code');

        // Switch DB based on dist_code
        $this->db2 = $this->dbswitch2($dist_code);
        $proposal_name = $this->utilclass->getProposalName($dist_code, $proposal_no);
        $pendingCase = $this->basundharaMb2Perpetualmodel->getAllCasesUnderProposalSdlac($proposal_no, $dist_code);

        $data['dist_code']        = $dist_code;
        $data['service_code']      = $service_code;
        $data['proposal_no']      = $proposal_no;
        $data['proposal_name']      = $proposal_name;
        $data['cases']            = $pendingCase->result();
        $data['pendingCaseCount'] = $pendingCase->num_rows();
        $data['_view'] = 'SettlementView/Sdlac/AllCasesListUnderProposalsSdlac';
        $this->load->view('layouts/main', $data);
    }


    // Agree Proposal by SDLAC
    public function agreeProposalBySdlac()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);


        $this->form_validation->set_rules('proposal_id', 'Proposal ID', 'trim|required|is_natural');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !!. Check Form Data',
            ));
        } else {
            $service_code     = $this->input->post('service_code');
            $proposal_no     = $this->input->post('proposal_id');
            $dist_code   = $this->session->userdata('dist_code');
            $sdlac_user_code   = $this->session->userdata('unique_user_id');

            $ExpireTime = $this->utilclass->getSdlacMeetingTime($dist_code,$service_code, $sdlac_user_code,$proposal_no);
            $now     = strtotime(date('Y-m-d H:i:s'));
            $ExpTime = strtotime($ExpireTime);
            $timeCheck = round(abs($now - $ExpTime) / 60 / 60, 2). " hour"; 

            if ($timeCheck> 48){
                echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'You Can not Agree On this Proposal as the time is over',

                    ));
                    return false;
            }else{
                $this->dbswitch2($dist_code);

            if ($proposal_no != NULL && $dist_code != NULL && $service_code != NULL && $sdlac_user_code != NULL) {
                $this->db2->trans_begin();

                // Update in  settlement_sdlac_member_report Table

                $updateData = array(
                    'status' => SDLAC_MEMBER_REPORT_STATUS_AGREE,
                    'remarks'  => 'Agree On Proposal',
                    'updated_at'      => date('Y-m-d h:i:s'),
                );

                $updateSdlacMemberReportStatus = $this->basundharaMb2Perpetualmodel->updateSettlementSdlacMemberReport($proposal_no, $dist_code, $service_code, $sdlac_user_code, $updateData);
                log_message('error', $this->db2->last_query());
                if ($updateSdlacMemberReportStatus <= 0) {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERRDUPDATESDLAC001: Updation failed in settlement_sdlac_member_report for Agree by SDLAC');
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'Agree on Proposal Failed. Kindly contact System Administrator',

                    ));
                    return false;
                }
                // Update in settlement_sdlac_member_report End

                //////SDLAC Remark proceeding start//////
                $proceeding_id = $this->db2->query("Select max(id)+1 as c from sdlac_proceeding where proposal_no='$proposal_no' ")->row()->c;

                if ($proceeding_id == null) {
                    $proceeding_id = 1;
                }

                $insSdlacProceed = [
                    'proposal_no' => $proposal_no,
                    'dist_id' => $dist_code,
                    'proceeding_status' => SDLAC_PROCEEDING_STATUS_UPDATED,
                    'sdlac_user_code' => $sdlac_user_code,
                    'sdlac_remarks' => 'Agree On Proposal',
                    'office_from' => 'SDLAC',
                    'office_to' => 'SDO',
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'date_entry' => date('Y-m-d h:i:s'),
                    'service_code' => $service_code,
                ];
                $insertProceeding = $this->db2->insert('sdlac_proceeding', $insSdlacProceed);

                if ($insertProceeding != 1) {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERRDUPDATESDLACPRO: Insertion failed in sdlac_proceeding for proposal no :' . $proposal_no);
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'Agree on Proposal Failed . Kindly contact System Administrator',

                    ));
                    return false;
                }

                //////SDLAC Remark proceeding End//////

                //////////////Update Status in settlement_proposal_list/////////////////////
                $updateProposalList = array(
                    'sdlac_prceed_status' => SDLAC_PROPOSAL_LIST_STATUS_UPDATED,
                    'updated_at'      => date('Y-m-d h:i:s'),
                );

                $updateProposalListQuery = $this->basundharaMb2Perpetualmodel->updateSettlementProposalList($proposal_no, $dist_code, $service_code, $updateProposalList);

                if ($updateProposalListQuery != 1) {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERRDUPDATEPROLIST001: Updation failed in settlement_proposal_list for Agree by SDLAC');
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'gree on Proposal Failed . Kindly contact System Administrator',

                    ));
                    return false;
                } else if ($updateProposalListQuery == 1) {
                    $this->db2->trans_commit();
                    echo json_encode(array(
                        'responseType' => 2,
                        'message' => 'Update Successfull.SDLAC Approval Successfull',

                    ));
                } else {
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'Agree on Proposal Failed . Kindly contact System Administrator',

                    ));
                }
                //////////////Update Status in settlement_proposal_list End/////////////////////

            }

            }
            
        }
    }






    // Refuse Proposal by SDLAC
    public function refuseProposalBySdlac()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);


        $this->form_validation->set_rules('proposal_id', 'Proposal ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('sdlac_remarks', 'SDLAC Remarks', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !!. Check Form Data',
            ));
        } else {
            $service_code     = $this->input->post('service_code');
            $proposal_no     = $this->input->post('proposal_id');
            $sdlac_remarks     = $this->input->post('sdlac_remarks');
            $dist_code   = $this->session->userdata('dist_code');
            $sdlac_user_code   = $this->session->userdata('unique_user_id');


            $this->dbswitch2($dist_code);

            if ($proposal_no != NULL && $dist_code != NULL && $service_code != NULL && $sdlac_user_code != NULL) {
                $this->db2->trans_begin();

                // Update in  settlement_sdlac_member_report Table

                $updateData = array(
                    'status' => SDLAC_MEMBER_REPORT_STATUS_DISAGREE,
                    'remarks'  => $sdlac_remarks,
                    'updated_at'      => date('Y-m-d h:i:s'),
                );

                $updateSdlacMemberReportStatus = $this->basundharaMb2Perpetualmodel->updateSettlementSdlacMemberReport($proposal_no, $dist_code, $service_code, $sdlac_user_code, $updateData);

                log_message('error', $this->db2->last_query());

                if ($updateSdlacMemberReportStatus != 1) {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERRDUPDATESDLAC001: Updation failed in settlement_sdlac_member_report for Agree by SDLAC');
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => '#ERRDUPDATESDLAC001: Updation failed in settlement_sdlac_member_report for Agree by SDLAC. Kindly contact System Administrator',

                    ));
                    return false;
                }
                // Update in settlement_sdlac_member_report End

                //////SDLAC Remark proceeding start//////
                $proceeding_id = $this->db2->query("Select max(id)+1 as c from sdlac_proceeding where proposal_no='$proposal_no' ")->row()->c;

                if ($proceeding_id == null) {
                    $proceeding_id = 1;
                }

                $insSdlacProceed = [
                    'proposal_no' => $proposal_no,
                    'dist_id' => $dist_code,
                    'proceeding_status' => SDLAC_PROCEEDING_STATUS_UPDATED,
                    'sdlac_user_code' => $sdlac_user_code,
                    'sdlac_remarks' => $sdlac_remarks,
                    'office_from' => 'SDLAC',
                    'office_to' => 'SDO',
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'date_entry' => date('Y-m-d h:i:s'),
                    'service_code' => $service_code,

                ];
                $insertProceeding = $this->db2->insert('sdlac_proceeding', $insSdlacProceed);

                if ($insertProceeding != 1) {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERRDUPDATESDLACPRO: Insertion failed in sdlac_proceeding for proposal no :' . $proposal_no);
                    // log_message('error', $this->db2->last_query());
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => '#ERRDUPDATESDLACPRO: Failed to insert . Kindly contact System Administrator',

                    ));
                    return false;
                }

                //////SDLAC Remark proceeding End//////


                //////////////Update Status in settlement_proposal_list/////////////////////
                $updateProposalList = array(
                    'sdlac_prceed_status' => SDLAC_PROPOSAL_LIST_STATUS_UPDATED,
                    'updated_at'      => date('Y-m-d h:i:s'),
                );

                $updateProposalListQuery = $this->basundharaMb2Perpetualmodel->updateSettlementProposalList($proposal_no, $dist_code, $service_code, $updateProposalList);


                if ($updateProposalListQuery != 1) {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERRDUPDATEPROLIST001: Updation failed in settlement_proposal_list for Refuse by SDLAC');
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => '#ERRDUPDATEPROLIST001: Updation failed in settlement_proposal_list for Refuse by SDLAC. Kindly contact System Administrator',

                    ));
                    return false;
                } else if ($updateProposalListQuery == 1) {
                    $this->db2->trans_commit();
                    echo json_encode(array(
                        'responseType' => 2,
                        'message' => 'Update Successfull.SDLAC Refused Successfully',

                    ));
                } else {
                    echo json_encode(array(
                        'responseType' => 2,
                        'message' => 'Proposal Refusal Failed',

                    ));
                }
                //////////////Update Status in settlement_proposal_list End/////////////////////

            }
        }
    }

    public function sdlacUserRegistration()
    {
        $this->load->view('login/sdlac_welcome_page');
    }
    
   public function loginSdlacWithoutAdhaar(){
        $this->load->view('login/RegisterWithoutAdhaar');
   }





    //Proposal List for SDLAC meeting
    public function sdlacProposalMeeting()
    {
        if ($this->session->userdata('designation') == SDLAC_USERCODE) {
            $data['proposals']      = '';
            $data['proposalsCount'] = 0;
            $data['_view'] = 'SettlementView/Sdlac/ProposalSearchSdlacMeeting';
            $this->load->view('layouts/main', $data);
        } else {
            echo "User Not Authorized to View this Page";
        }
    }




        // Get Proposal List From SDO/ADC at SDLAC end
    public function getAllSdlacProposalMeeting()
    {
        if ($this->session->userdata('designation') == SDLAC_USERCODE) {
            $serviceType   = trim($this->input->post('serviceType'));
            $dist_code     = $this->session->userdata('dist_code');
            $sdlac_user_code     = $this->session->userdata('unique_user_id');

            $proposals = '';
            $proposalsCount = 0;
            $data['dist_code'] = $dist_code;
            $data['service_code'] = $serviceType;

            $this->form_validation->set_rules('serviceType', 'Please Select Service Before Proceed', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['proposals']      = '';
                $data['proposalsCount'] = 0;
                $this->session->set_flashdata('message', 'Please Select Service Before Proceed.');
                $data['_view'] = 'SettlementView/Sdlac/ProposalMeetingSdlac';
                $this->load->view('layouts/main', $data);
            } else {

                $this->db2 =  $this->dbswitch2($dist_code);

                $proposals = $this->basundharaMb2Perpetualmodel->getSdlacProposalsMeetingByService($dist_code,$serviceType, $sdlac_user_code);

                $data['proposals']      = $proposals->result();
                $data['proposalsCount'] = $proposals->num_rows();

                $data['_view'] = 'SettlementView/Sdlac/ProposalMeetingSdlac';
                $this->load->view('layouts/main', $data);
            }
        } else {
            echo "User Not Authorized to View this Page";
        }
    }

    public function viewInvitationNotice()

    {

        $_POST = json_decode(file_get_contents("php://input"), true);

        $proposal_id   = $this->input->post('proposal_id');
        
        // $proposal_id   = '342';
        $dist_code   = $this->session->userdata('dist_code');

        $url = 'http://' . $this->getApiIp($dist_code) . '/dharrtpsapi/index.php/DharRtpsApi/getInvitationNotice';

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'dist_code' => $dist_code,
            'proposal_id' => $proposal_id,
        )));
        $result = curl_exec($curl_handle);
        curl_close($curl_handle);

        $dataa = json_decode($result);

        if($dataa->responseType == 2)
        {
            // $data['base64encodedfile'] = $dataa->data;
            // $data['_view'] ='SettlementView/Sdlac/loadcssview';
            // $this->load->view('layouts/main', $data);

            echo json_encode(array(
                'responseType' => 2,
                'notice' => base64_decode($dataa->data),
            ));
        }
        else
        {
            echo "File not found !";
        }
    }
    

    // Newly Add For Case Search


    public function searchCasesSdlac()
    {
        $dist_code     = $this->session->userdata('dist_code');

        $this->db2 =  $this->dbswitch2($dist_code);
        $circles = $this->basundharaMb2Perpetualmodel->getcirclebyDistCode($dist_code);
        $data['circles']      = $circles->result();

        $caseNo        = trim($this->input->post('caseNo'));
        $applicationNo = trim($this->input->post('applicationNo'));
        $serviceType   = trim($this->input->post('serviceType'));
        $appStatus     = trim($this->input->post('appStatus'));
        $pendingOffice = trim($this->input->post('pendingOffice'));
        $fromDate      = trim($this->input->post('fromDate'));
        $toDate        = trim($this->input->post('toDate'));
        $cir_code  = trim($this->input->post('selectCircle'));

        $cases = '';
        $casesCount = 0;
        $data['dist_code'] = $dist_code;
        $data['serviceType'] = $serviceType;
        $data['cir_code'] = $cir_code;
        $data['appStatus'] = $appStatus;
        $data['caseNo'] = $caseNo;
        $data['applicationNo'] = $applicationNo;
        $data['pendingOffice'] = $pendingOffice;
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;

            if ($caseNo == ''  and $applicationNo == '' and $serviceType == '' and $appStatus == '' and $pendingOffice == '' and $fromDate == '' and $toDate == '' and $cir_code == '') {

                $data['cases']      = '';
                $data['casesCount'] = 0;

                $data['_view'] = 'SettlementView/Sdlac/CaseSearchPageSdlac';
                $this->load->view('layouts/main', $data);
            } 
            else {
                if ($caseNo != '') {
                    $this->db2 =  $this->dbswitch2($dist_code);

                    $cases = $this->basundharaMb2Perpetualmodel->getCasesByCaseNo($caseNo);
                    $data['cases']      = $cases->result();
                    $data['casesCount'] = $cases->num_rows();

                    $data['_view'] = 'SettlementView/Sdlac/CaseSearchPageSdlac';
                    $this->load->view('layouts/main', $data);
                }
                else if ($applicationNo != ''){
                    $this->db2 =  $this->dbswitch2($dist_code);

                    $cases = $this->basundharaMb2Perpetualmodel->getCasesByApplicationNo($applicationNo);
                    $data['cases']      = $cases->result();
                    $data['casesCount'] = $cases->num_rows();

                    $data['_view'] = 'SettlementView/Sdlac/CaseSearchPageSdlac';
                    $this->load->view('layouts/main', $data);
                }

                 else {
                    if ($fromDate != '' and $toDate != '') {
                        $this->db2 =  $this->dbswitch2($dist_code);

                        $cases = $this->basundharaMb2Perpetualmodel->getCasesByRespectedDataWithDateRage($serviceType, $appStatus, $pendingOffice, $fromDate, $toDate, $cir_code);

                        $data['cases']      = $cases->result();
                        $data['casesCount'] = $cases->num_rows();

                        $data['_view'] = 'SettlementView/Sdlac/CaseSearchPageSdlac';
                        $this->load->view('layouts/main', $data);
                    } else {
                        $this->db2 =  $this->dbswitch2($dist_code);

                        $cases = $this->basundharaMb2Perpetualmodel->getCasesByRespectedData($serviceType, $appStatus, $pendingOffice, $fromDate, $toDate, $cir_code);

                        $data['cases']      = $cases->result();
                        $data['casesCount'] = $cases->num_rows();

                        $data['_view'] = 'SettlementView/Sdlac/CaseSearchPageSdlac';
                        $this->load->view('layouts/main', $data);
                    }
                }
            }
    }




    public function getCirCodeJson($dist_code)
    {
        $this->db2 =  $this->dbswitch2($dist_code);

        $data = $this->basundharaMb2Perpetualmodel->getCirCodeJSON($dist_code);
        $json = array();
        foreach ($data as $object) {
            $json[] = array('loc_name' => $object->loc_name, 'dist_code' => $object->dist_code, 'subdiv_code' => $object->subdiv_code, 'cir_code' => $object->cir_code);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }




    // Datatable Sdlac case list
    
    public function viewSdlacCaseLIst()
    {
        $caseNo = trim($this->input->post('caseNo'));
        $applicationNo = trim($this->input->post('applicationNo'));
        $dist_code = $this->input->post('dist_code');
        $cir_code = $this->input->post('cir_code');
        $serviceType = $this->input->post('serviceType');
        $appStatus = $this->input->post('appStatus');
        $pendingOffice = $this->input->post('pendingOffice');
        $fromDate      = $this->input->post('fromDate');
        $toDate        = $this->input->post('toDate');
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');
        $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
        // $searchByCol_1 = $this->input->post('columns')[1]['search']['value'];

        $this->db2 =  $this->dbswitch2($dist_code);
        $results = $this->basundharaMb2Perpetualmodel->viewSdlacSearchData($start, $length, $order, $searchByCol_0,$cir_code,$serviceType,$appStatus,$caseNo,$applicationNo,$pendingOffice,$fromDate,$toDate);

        if (isset($results)) {
            $data_rows = $results['data_results'];
            foreach ($data_rows as $rows) {

                $caseNoAppNo = '<strong>' .$rows->case_no. '</strong><br><small class="bg-success">(<b>RTPS No :</b> '.$rows->applid. ')</small>';

                $serviceType = '<small  class="text-primary"> ' . $this->utilclass->getServiceName($rows->service_code) .' </small>';

                $distName = $this->utilclass->getDistrictName($rows->dist_code);

                $dateSub = '<span  class="text-danger" ><i class="fa fa-calender"></i>  '  .date("j F, Y", strtotime($rows->submission_date)) . ' </span>';
                                        
                $viewBtn = '<a type="button" target="_blank"  class="btn btn-sm btn-success" href="'. base_url() . 'index.php/Basundhara/settlementBasu/?app='.$rows->applid .'&dist_code='.$rows->dist_code .'"><i class="fa fa-eye"></i>&nbsp;Case Details</a>';

                $json[] = array(
                    $caseNoAppNo,
                    $serviceType,
                    $distName,
                    $dateSub,
                    $viewBtn,              
                );
            }
            $total_records = $results['total_records'];
            $response = array(
                'draw'              => $draw,
                'recordsTotal'      => $total_records,
                'recordsFiltered'   => $total_records,
                'data'              => $json
            );
            echo json_encode($response);
        } else {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }


    // Get All Proposal List  at SDLAC end
    public function getAllProposalListUnderSdlacOnlineOffline()
    {
        if ($this->session->userdata('designation') == SDLAC_USERCODE) {
            $serviceType   = trim($this->input->post('serviceType'));
            $dist_code     = $this->session->userdata('dist_code');
            $sdlac_user_code     = $this->session->userdata('unique_user_id');

            $proposals = '';
            $proposalsCount = 0;
            $data['dist_code'] = $dist_code;
            $data['service_code'] = $serviceType;



            $this->form_validation->set_rules('serviceType', 'Please Select Service Before Proceed', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['proposals']      = '';
                $data['proposalsCount'] = 0;
                $this->session->set_flashdata('message', 'Please Select Service Before Proceed.');
                $data['_view'] = 'SettlementView/Sdlac/AllProposalListOnlineOffline';
                $this->load->view('layouts/main', $data);
            } else {
                $this->db2 =  $this->dbswitch2($dist_code);
                $proposals = $this->basundharaMb2Perpetualmodel->getSdlacProposalsByServiceOnlineOffline($serviceType, $sdlac_user_code);
                $data['proposals']  = $proposals->result();

                $data['proposalsCount'] = $proposals->num_rows();
                // var_dump($data['proposalsCount']);
                // die;
                $data['_view'] = 'SettlementView/Sdlac/AllProposalListOnlineOffline';
                $this->load->view('layouts/main', $data);
            }
        } else {
            echo "User Not Authorized to View this Page";
        }
    }



    // List of Meeting under Department
    public function deptMeetingList()
    {
        $data['meeting']      = '';
        $data['meetingsCount'] = 0;

        $data['_view'] = 'SettlementView/Dept/CasesByMeetingDept';
        $this->load->view('layouts/main', $data);
    }


    //Getting the List of Meeting Under Departrment by District
    public function getMeetingListByDistrict()
    {
        if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) {

            //Get Department User district List
            $data['user_dist']      = $this->getDeptUserDistList();

            $dist_code     = trim($this->input->post('selectDistrict'));

            $meetings = '';
            $meetingsCount = 0;
            $data['dist_code'] = $dist_code;

            $this->form_validation->set_rules('selectDistrict', 'Please Select District Before Proceed', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['meetings']      = '';
                $data['meetingsCount'] = 0;
                $this->session->set_flashdata('message', 'Please Select District Before Proceed.');
                $data['_view'] = 'SettlementView/Dept/CasesByMeetingDept';
                $this->load->view('layouts/main', $data);
            } else {

                $this->db2 =  $this->dbswitch2($dist_code);

                $meetings = $this->basundharaMb2Perpetualmodel->getMeetingsByDistrict();

                $data['meetings']      = $meetings->result();
                $data['meetingsCount'] = $meetings->num_rows();

                $data['_view'] = 'SettlementView/Dept/CasesByMeetingDept';
                $this->load->view('layouts/main', $data);
            }
        } else {
            echo "User Not Authorized to View this Page";
        }
    }



    //Getting the List of Meeting Under Departrment by District
    public function getAllProposalsUnderDept()
    {
        if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) {

            $meeting_id = $this->input->get('meeting');
            $dist_code = $this->input->get('dist_code');


            $proposal = '';
            $proposalsCount = 0;
            $data['dist_code'] = $dist_code;
            $data['meeting_id']      = $meeting_id;
            // $data['meeting_name'] = $this->utilclass->getMeetingNameByMeetingId($dist_code, $meeting_id);

            $this->db2 =  $this->dbswitch2($dist_code);

            $proposal = $this->basundharaMb2Perpetualmodel->getProposalsByMeeting($meeting_id);

            $data['proposals']      = $proposal->result();
            $data['proposalsCount'] = $proposal->num_rows();

            $data['_view'] = 'SettlementView/Dept/AllProposalByMeetingDept';
            $this->load->view('layouts/main', $data);
        } else {
            echo "User Not Authorized to View this Page";
        }
    }


    public function getAllCasesUnderProposalDept()
    {
        $proposal_no = $this->input->get('proposal');
        $dist_code = $this->input->get('dist_code');
        // Switch DB based on dist_code
        $this->db2 = $this->dbswitch2($dist_code);

        $pendingCase = $this->basundharaMb2Perpetualmodel->getAllCasesUnderProposal($proposal_no);

        $data['dist_code']        = $dist_code;
        $data['proposal_no']      = $proposal_no;
        $data['cases']            = $pendingCase->result();
        $data['pendingCaseCount'] = $pendingCase->num_rows();

        // $data['remainingCaseCount'] = $remainingCase->num_rows();
        $data['_view'] = 'SettlementView/Dept/AllCasesListUnderProposalsDept';
        $this->load->view('layouts/main', $data);
    }

    // Get the District List for Department Users
    public function getDeptUserDistList()
    {
        $unique_user_id = $this->session->userdata('unique_user_id');
        $this->db = $this->load->database('db2', TRUE);
        $user_dist = $this->db->query("SELECT udb.dist_code FROM depart_users du inner join user_dist_byforcation udb on udb.unique_user_id::int=du.id  where du.unique_user_id='$unique_user_id' and du.active_deactive='E'")->result();
        return $user_dist;
    }

    //Get District List for Asssistant
    public function getDeptUserDistListAssistant()
    {
        $unique_user_id = $this->session->userdata('unique_user_id');
        $this->db = $this->load->database('db2', TRUE);
        $dist_list = array(
            (object) array('dist_code' => '02'),
            (object) array('dist_code' => '03'),
            (object) array('dist_code' => '05'),
            (object) array('dist_code' => '06'),
            (object) array('dist_code' => '07'),
            (object) array('dist_code' => '08'),
            (object) array('dist_code' => '11'),
            (object) array('dist_code' => '12'),
            (object) array('dist_code' => '13'),
            (object) array('dist_code' => '14'),
            (object) array('dist_code' => '15'),
            (object) array('dist_code' => '16'),
            (object) array('dist_code' => '17'),
            (object) array('dist_code' => '18'),
            (object) array('dist_code' => '21'),
            (object) array('dist_code' => '24'),
            (object) array('dist_code' => '25'),
            (object) array('dist_code' => '32'),
            (object) array('dist_code' => '33'),
            (object) array('dist_code' => '34'),
            (object) array('dist_code' => '35'),
            (object) array('dist_code' => '36'),
            (object) array('dist_code' => '37'),
            (object) array('dist_code' => '38'),
            (object) array('dist_code' => '39'),
        );
        return $dist_list;
    }


    public function downloadCasesWithProposalId()
    {
        $ProposalNo = trim($this->input->get('proposal'));
        $dist_code     = $this->session->userdata('dist_code');
        $proposal_name = $this->utilclass->getProposalName($dist_code, $ProposalNo);
        $file_name  = $proposal_name . "_report.xlsx";

        // Switch DB based on dist_code
        $this->db2 = $this->dbswitch2($dist_code);

        $data = $this->db2->query("select
        (select locname_eng from location where dist_code=t1.dist_code and subdiv_code='00') district,
        (select locname_eng from location where dist_code=t1.dist_code and subdiv_code=t1.subdiv_code and cir_code=t1.cir_code and mouza_pargona_code='00') circle,
        (select locname_eng from location where dist_code=t1.dist_code and subdiv_code=t1.subdiv_code and cir_code=t1.cir_code and mouza_pargona_code=t1.mouza_pargona_code and lot_no='00') mouza,
        (select locname_eng from location where dist_code=t1.dist_code and subdiv_code=t1.subdiv_code and cir_code=t1.cir_code and mouza_pargona_code=t1.mouza_pargona_code and lot_no=t1.lot_no and vill_townprt_code='00000') lot,
        (select locname_eng from location where dist_code=t1.dist_code and subdiv_code=t1.subdiv_code and cir_code=t1.cir_code and mouza_pargona_code=t1.mouza_pargona_code and lot_no=t1.lot_no and vill_townprt_code=t1.vill_townprt_code) village,
        t1.uuid,t1.applid as application_no,t1.case_no, t2.applicant_name, t2.guardian_name, t2.Address, t3.dag_no, t3.applied_area, t3.proposed_area, t5.encroacher_name, t6.joint_applicants
        from (select case_no,proposal_id from settlement_proposal_cases spc where proposal_id=$ProposalNo) t11
        left join (select applid,case_no,dist_code,subdiv_code, cir_code, mouza_pargona_code, lot_no, vill_townprt_code,uuid from settlement_basic a) t1 on t11.case_no=t1.case_no
        left join ( select case_no,sa.pdar_name as applicant_name,sa.pdar_guardian as guardian_name,sa.pdar_add1 as Address from settlement_applicant sa where is_applicant='1') t2 on t11.case_no=t2.case_no
        left join ( select case_no,string_agg(distinct(dag_no),'-') as dag_no,string_agg(distinct(dag_no || '-area( home: ' || home_b || ' B-'||home_k||' K-'||home_lc ||'L, agri: '||agri_b||'B-'||agri_k||'K-'||agri_lc||'L)'),',') as applied_area, string_agg(distinct(dag_no || '-area( Total_Proposed_area: ' || s_dag_area_b || ' B-'||s_dag_area_k||' K-'||s_dag_area_lc ||'L)'),',') as proposed_area from settlement_dag_details sdd group by case_no) t3 on t11.case_no=t3.case_no
        left join ( select case_no,array_agg(distinct(pdar_name)) as encroacher_name from settlement_applicant sap where pdar_type='EN' group by case_no) t5 on t11.case_no=t5.case_no
        left join ( select case_no,string_agg(distinct(pdar_name),'-') as joint_applicants from settlement_applicant sa where is_applicant!='1' and pdar_type='B' group by case_no) t6 on t11.case_no=t6.case_no")->result_array();

        $this->basundharaMb2Perpetualmodel->downloadExcelReport($file_name, $data);
    }

    public function viewChithaCopy()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $dist_code = $this->input->post('dist_code');
        $subdiv_code = $this->input->post('subdiv_code');
        $cir_code = $this->input->post('cir_code');
        $mouza_pargona_code = $this->input->post('mouza_pargona_code');
        $lot_no = $this->input->post('lot_no');
        $vill_townprt_code = $this->input->post('vill_townprt_code');
        $patta_code = $this->input->post('patta_code');
        $dag_no = $this->input->post('dag_no');

        $url = VIEW_CHITHA_API_LINK;
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'dist_code' => $dist_code,
            'subdiv_code' => $subdiv_code,
            'cir_code' => $cir_code,
            'mouza_pargona_code' => $mouza_pargona_code,
            'lot_no' => $lot_no,
            'vill_townprt_code' => $vill_townprt_code,
            'patta_code' => $patta_code,
            'dag_no' => $dag_no,
        )));
        $result = curl_exec($curl_handle);
        curl_close($curl_handle);
        $dataa = json_decode($result);

        if ($dataa != NULL) {
            // $data['base64encodedfile'] = $dataa;
            // $data['_view'] = 'SettlementView/Sdlac/loadcssview';
            // $this->load->view('layouts/main', $data);

            echo json_encode(array(
                'responseType' => 2,
                'notice' => base64_decode($dataa),
            ));
        } else {
            echo "File not found !";
        }
    }





    public function checkListForAllotment()
    {


        if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) {
            $settlement['application_no'] = $application_no = $this->input->get('app');
            $dist_code = $this->input->get('dist_code');

            $this->db2 = $this->dbswitch2($dist_code);

            $sql = "Select case_no from settlement_basic where applid='$application_no' ";
            $settlement['case_no'] = $case_no = $this->db2->query($sql)->row()->case_no;

            $settlement['settlement_basic'] = $this->basundharaMb2Perpetualmodel->getSettlementBasic($case_no);
            $settlement['settlement_enc'] = $this->basundharaMb2Perpetualmodel->getSettlementEncroacher($case_no);
            $settlement['proceedings']   = $this->basundharaMb2Perpetualmodel->getSettlementProceeding($case_no);
            $settlement['roadside_reservation']   = $this->basundharaMb2Perpetualmodel->getSettlementRoadsideReservation($case_no);
            $settlement['family_reservation']   = $this->basundharaMb2Perpetualmodel->getSettlementFamilyReservation($case_no);
            $settlement['settlement_applicant']  = $this->basundharaMb2Perpetualmodel->getSettlementApplicant($case_no);

            $settlement['settlement_dag_area'] = $this->basundharaMb2Perpetualmodel->getSettlementDagArea($case_no);
            $settlement['trace_map'] = $this->basundharaMb2Perpetualmodel->getTraceMap($case_no);
            $settlement['field_report'] = $this->basundharaMb2Perpetualmodel->getFieldReport($case_no);
            $settlement['geo_tag'] = $this->basundharaMb2Perpetualmodel->getGeoTag($case_no);
            $settlement['settlement_ap_lmnote'] = $this->basundharaMb2Perpetualmodel->getSettlementLmNote($case_no);
            $settlement['applicants_buyers']   = $this->basundharaMb2Perpetualmodel->getAllApplicantBuyers($case_no);

            $sql2 = "Select *, CASE
                WHEN (case_status = '1') THEN 'Recommended' WHEN (case_status = '2') THEN 'Not Recommended' END AS case_status from settlement_proposal_cases where case_no='$case_no'";
            $settlement['case_status'] = $this->db2->query($sql2)->row()->case_status;

            $url = API_LINK . "serviceResponseBasu?application_no=" . $application_no;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
            $output = curl_exec($ch);
            curl_close($ch);
            $output = json_decode($output);

            $settlement['documents'] = $output->documents;
            $settlement['query'] = $output->query;
            $settlement['property'] = $output->property;
            $settlement['aadhar'] = $output->aadhar;

            $settlement['nextKin'] = $output->nextKin;
            foreach ($output->selfDeclaration as $selfDec) {
                $settlement['selfDeclarationDetails'] = json_decode($selfDec->dec_details);
            }

            $this->load->view('SettlementView/Dept/check_list_allotment', $settlement);
        } else {
            echo "User Not Authorized to View this Page";
        }
    }


    public function viewMinute($dist_code, $meeting_id)
    {
        $curl = curl_init();
        $url = 'http://' . $this->getApiIp($dist_code) . GET_MINUTE_API_LINK;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('dist_code' => $dist_code, 'meeting_id' => $meeting_id),
            
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        header('Content-type: application/pdf');
        echo $response;
    }



    //Newly Added
    // Cab Recommended 
    public function verifyCaseByAssistant()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        $this->load->library('form_validation');

        $this->form_validation->set_rules('caseNo', 'Case Number', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 1,
            ));
            return;
        } else {
            $case_no   = $this->input->post('caseNo');
            $service_code   = $this->input->post('serviceCode');
            $dist_code = $this->input->post('distCode');
            $verification_remarks = $this->input->post('verification_remarks');
            $user_code = $this->session->userdata('user_code');

            $this->db2 = $this->dbswitch2($dist_code);

            $caseCount = $this->basundharaMb2Perpetualmodel->countSettlementApplicationDetailsByCaseNo($case_no, $dist_code);

            // var_dump($caseCount);
            // die;

            if ($caseCount == 0) {
                echo json_encode(array(
                    'responseType' => 3,
                ));
                return;
            } else {
                $updateData = array(
                    'verified_by_asst'  => 2,
                    'user_code' => $user_code,
                    'verified_ast_remarks' => $verification_remarks
                );
                $this->db2->trans_begin();
                if ($this->basundharaMb2Perpetualmodel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData) == 0) {
                    $this->db2->trans_rollback();
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'Case Not Verified ! Kindly Contact System Admin.',

                    ));
                    return;
                } else {
                    //////proceeding start//////
                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;
                    if ($proceeding_id == null) {
                        $proceeding_id = 1;
                    }
                    $insPetProceed = [
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'next_date_of_hearing' => date('Y-m-d h:i:s'),
                        'status' => MB_MARK_AS_SDLAC,
                        'user_code' => $this->session->userdata('user_code'),
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'note_on_order' => $verification_remarks,
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'office_from' => MB_DEPARTMENT,
                        'office_to' => MB_DEPARTMENT,
                        'task' => 'Verified by Assistant'
                    ];
                    $insertProceeding = $this->db2->insert('settlement_proceeding', $insPetProceed);

                    if ($insertProceeding != 1) {
                        $this->db2->trans_rollback();
                        log_message('error', '#MR00891: Insertion failed in settlement_proceeding for case no :' . $case_no);
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'Case Not Verified ! Kindly Contact System Admin.',

                        ));
                        return;
                    } else {
                            $this->db2->trans_commit();
                            echo json_encode(array(
                                'responseType' => 2,
                                'message' => 'Case Successfully Verified',

                            ));
                            return;

                       
                    }
                    //////proceeding end//////
                }
            }
        }
    }




    //Getting the Cabinet Recoomended List by Dist
    public function cabRecommendedListByDistrict()
    {
        if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) {

            //Get Department User district List
            $data['user_dist']      = $this->getDeptUserDistList();
            $user_code = $this->session->userdata('user_code');

            $dist_code     = trim($this->input->post('selectDistrict'));

            $data['dist_code'] = $dist_code;

            $data['_view'] = 'SettlementView/Dept/CabRecommendedListByDist.php';
            $this->load->view('layouts/main', $data);
        } else {
            echo "User Not Authorized to View this Page";
        }
    }




    public function viewAllCabRecommendedList()
    {
        $user_code = $this->session->userdata('user_code');
        $this->db = $this->load->database('db2', TRUE);

        $getDistrict = $this->db->query("Select distinct dist_code from cab_recommendation_list where user_code = '$user_code'");
        $location        = $getDistrict->result();

        $data['location'] = $location;
        $data['_view']    = 'SettlementView/Dept/CabRecommendedListByDist';
        $this->load->view('layouts/main', $data);
    }


    public function viewAllCabinetCaseList()
    {
        $dist_code = $this->input->post('dist_code');
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $this->db = $this->load->database('db2', TRUE);

        $results = $this->basundharaMb2Perpetualmodel->viewCabinetCaseList($start, $length, $order, $dist_code);

        if (isset($results)) {
            $i = 1;
            $data_rows = $results['data_results'];
            foreach ($data_rows as $rows) {
                $status = '<span class="px-1"><strong class="text-success">Recommended</strong></span>';
                $dist_name = $this->utilclass->getDistrictNameOnLanding($rows->dist_code);
                $appl_id = $this->utilclass->getApplidFromCaseNo($rows->dist_code, $rows->case_no);
                $case_no = '<span class="px-1"><strong class="text-primary">' . $rows->case_no . '</strong></span>';
                $created_at =  date('d-M-Y', strtotime($rows->created_at));
                $viewReport = '<a class="btn btn-success btn-sm" target="download" href=" ' . base_url() . 'index.php/Basundhara/settlementBasu/' . $rows->dist_code . '/' . $rows->case_no . '"><i class="fa fa-eye"></i> Get Report</a>';

                $viewDetails = ' <a class="btn btn-info btn-sm" href="' . base_url() . 'index.php/Basundhara/settlementBasu/?app=' . $appl_id . '&dist_code=' . $rows->dist_code . '">
                                            <i class="fa fa-arrow-right"></i></i> Case Details
                                        </a>';
                $json[] = array(
                    $rows->case_no,
                    '<span class="px-1"><strong>' . $i . '</strong></span>',
                    $dist_name,
                    $case_no,
                    $status,
                    $created_at,
                    $viewDetails,
                );
                $i++;
            }
            $total_records = $results['total_records'];
            $response = array(
                'draw'              => $draw,
                'recordsTotal'      => $total_records,
                'recordsFiltered'   => $total_records,
                'data'              => $json
            );
            echo json_encode($response);
        } else {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }





    public function downloadRecommendedCaseReportByDist()
    {

        // $_POST = json_decode(file_get_contents("php://input"), true);

        // $dist_code     = $this->input->post('district_id');
        $dist_code     = $this->input->post('selectDistrict');
        // $allSelectedList = $this->input->post('selectedList');
        $allSelectedList = $this->input->post('selectMark[]');


        $this->form_validation->set_rules('selectDistrict', 'Please Select District Before Proceed', 'required');
        $this->form_validation->set_rules('selectMark', 'Please Select Cases', 'required');

        // Switch DB based on dist_code
        $this->db2 = $this->dbswitch2($dist_code);

        if (!empty($allSelectedList)) {
            foreach ($allSelectedList as $row) {

                $case_no = $row;

                $settlement_basic = $this->basundharaMb2Perpetualmodel->getSettlementBasic($case_no);

                $applicants   = $this->basundharaMb2Perpetualmodel->getAllApplicantBuyersName($case_no)->result();

                $appNames = array_map(
                    function ($item) {
                        return $item->pdar_name;
                    },
                    $applicants
                );

                $appAddress1 = array_map(
                    function ($item) {
                        return $item->pdar_add1;
                    },
                    $applicants
                );


                $dags = $this->basundharaMb2Perpetualmodel->getAllAppliedDags($case_no)->result();

                $dagNos = array_map(function ($item) {
                    return $item->dag_no;
                }, $dags);


                $commaSeparatedDags = implode(",", $dagNos);

                $commaSeparatedNames = implode(",", $appNames);

                $commaSeparatedAddress1 = implode(",", $appAddress1);

                $dagsArea = $this->utilclass->dagAreabyCaseNo($settlement_basic['dist_code'], $case_no);

                $district_name = $this->utilclass->getDistrictName($settlement_basic['dist_code']);

                $circle_name = $this->utilclass->getCircleName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code']);

                $village_name = $this->utilclass->getVillageName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code'], $settlement_basic['lot_no'], $settlement_basic['vill_townprt_code']);

                $sdlacStatus = $this->basundharaMb2Perpetualmodel->sdlacCaseStatus($case_no)->row();

                $settlement_enc = $this->basundharaMb2Perpetualmodel->getSettlementEncroacher($case_no);

                // $uuid = $this->utilclass->getVillageUUID($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code'], $settlement_basic['lot_no'], $settlement_basic['vill_townprt_code']);

                $landless = $this->basundharaMb2Perpetualmodel->getLandLessVerify($case_no)->row();

                $geo_tag = $this->basundharaMb2Perpetualmodel->getGeoTag($case_no);

                $house_type = $this->utilclass->getHouseTypeByCaseNo($settlement_basic['dist_code'], $case_no);

                $zonal_value = $this->utilclass->getZonalValueByCaseNo($settlement_basic['dist_code'], $case_no);


                if (count($geo_tag) > 0) {

                    $geo_tag_yn = 'Yes';
                } else {

                    $geo_tag_yn = 'No';
                }


                foreach ($applicants as $app) {

                    $appGender = $this->utilclass->getGender($app->pdar_gender);
                }



                $finalArray[] = array(
                    'District' => $district_name,
                    'Case No' => $case_no,
                    'Name of the Applicant with Address' => $commaSeparatedNames . ' (Add: ' . $commaSeparatedAddress1 . ' )',
                    'Dag No' => $commaSeparatedDags,
                    'Area' => $dagsArea,
                    // 'Area' => 'Dag: ' . $dd . '(' . $area_b . '-Bigha ,' . $area_k  . '-Katha ,' . $area_lc . '-Lessa)',
                    'Circle' => $circle_name,
                    'Village' => $village_name,
                    'Type of House' => $house_type,
                    'Checklist Settlement' => 'YES',
                    'SDLAC Approval' => $sdlacStatus->case_status,
                    'Date' => date("j F, Y", strtotime($sdlacStatus->case_status)),
                    'Period & Nature of Possession' => date("j F, Y", strtotime($settlement_enc->period_possession)) . ' (' . ($settlement_basic['occupation_applicant']) . ' )',
                    'Gender' => $appGender,
                    'Zonal Value' => $zonal_value,
                    'Landless Affidavit' => $landless->is_landless,
                    'Type of House with Photo' => $geo_tag_yn,
                    'Assembly Recommendation' => 'RECOMMENDED',
                    'Remarks' => '',
                );
            }
        }


        /////Preview
        echo "<pre>";
        foreach ($finalArray as $index => $entry) {
            echo "Array $index:<br>";
            foreach ($entry as $key => $value) {
                if (is_array($value)) {
                    echo "&emsp;$key: <br>";
                    foreach ($value as $nestedIndex => $nestedValue) {
                        echo "&emsp;&emsp;$nestedIndex: ";
                        foreach ($nestedValue as $subKey => $subValue) {
                            echo "$subValue, ";
                        }
                        echo "<br>";
                    }
                } else {
                    echo "&emsp;$key: $value<br>";
                }
            }
            echo "<br>";
        }
        echo "</pre>";
        //////Preview

        // die;
        $file_name  = "Report_report.xlsx";
        $this->basundharaMb2Perpetualmodel->downloadExcelReport($file_name, $finalArray);
    }






    public function markAndPrepareCabStack()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Check Form Data',
            ));
        } else {
            $dist_code     = $this->input->post('district_id');
            $allSelectedList = $this->input->post('selectedList');

            $this->db = $this->load->database('db2', TRUE);

            if (!empty($allSelectedList)) {
                $this->db->trans_begin();

                foreach ($allSelectedList as $row) {

                    $case_no = $row;

                    $cab_stack_id = "CAB_STACK_" . $dist_code;

                    // Update in Cab_recommended_list
                    $updCabRec = [
                        'cab_stack_prepared' => 1,
                        'updated_at' => date('Y-m-d h:i:s'),
                    ];

                    $where = [
                        'dist_code' => $dist_code,
                        'case_no' => $case_no,
                        'user_code' => $this->session->userdata('user_code'),
                    ];

                    $updateCabStackList = $this->db->update('cab_recommendation_list', $updCabRec);

                    //Insert in CAB Stack List
                    $insCabStack = [
                        'cab_id' => $cab_stack_id,
                        'case_no' => $case_no,
                        'user_code' => $this->session->userdata('user_code'),
                        'dist_code' => $dist_code,
                        'created_at' => date('Y-m-d h:i:s'),
                    ];

                    $insertCabList = $this->db->insert('cab_stack_list', $insCabStack);
                    // var_dump($insertCabList);
                    // die;
                    if ($insertCabList != TRUE) {
                        $this->db->trans_rollback();
                        log_message('error', '#ERRDUPDATECSL001: Updation failed in cab_stack_list');
                        log_message('error', $this->db->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRDUPDATECSL001: Updation failed in cab_stack_list. Kindly contact System Administrator',

                        ));
                        return false;
                    } else {
                        $this->db->trans_commit();

                        echo json_encode(array(
                            'responseType' => 2,
                            'message' => 'Cases Successfully Forwared for CAB Stack List',

                        ));
                    }
                }
            }
        }
    }



    public function viewAllCasesUnderProposalDept()
    {
        $dist_code = $this->input->get('dist_code');
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');


        $this->db2 = $this->dbswitch2($dist_code);


        $results = $this->basundharaMb2Perpetualmodel->getAllCasesUnderProposal2($start, $length, $order, $dist_code);


        if (isset($results)) {
            $i = 1;
            $data_rows = $results['data_results'];
            foreach ($data_rows as $rows) {
                $status = '<span class="px-1"><strong class="text-success">' . $case->dept_approval . '</strong></span>';

                $appl_id = $this->utilclass->getApplidFromCaseNo($rows->dist_code, $rows->case_no);
                $case_no = '<span class="px-1"><strong class="text-primary">' . $rows->case_no . '</strong></span>';
                $created_at =  date('d-M-Y', strtotime($rows->created_at));

                $viewDetails = ' <a class="btn btn-info btn-sm" href="' . base_url() . 'index.php/Basundhara/settlementBasu/?app=' . $appl_id . '&dist_code=' . $rows->dist_code . '">
                                            <i class="fa fa-arrow-right"></i></i> Case Details
                                        </a>';
                $json[] = array(
                    '<span class="px-1"><strong>' . $i . '</strong></span>',
                    $case_no,
                    $status,
                    $created_at,
                    $viewDetails,
                );
                $i++;
            }
            $total_records = $results['total_records'];
            $response = array(
                'draw'              => $draw,
                'recordsTotal'      => $total_records,
                'recordsFiltered'   => $total_records,
                'data'              => $json
            );
            echo json_encode($response);
        } else {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }



    public function recommendWithoutVerify()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Check Form Data',
            ));
        } else {
            $dist_code     = $this->input->post('district_id');
            $allSelectedList = $this->input->post('selectedList');

            if (!empty($allSelectedList)) {
                $this->db->trans_begin();

                foreach ($allSelectedList as $row) {

                    $case_no = $row;

                    $cab_stack_id = "CAB_STACK_" . $dist_code;

                    //Insert in CAB Recommended List
                    $insCabStack = [
                        'cab_id' => $cab_stack_id,
                        'case_no' => $case_no,
                        'user_code' => $this->session->userdata('user_code'),
                        'dist_code' => $dist_code,
                        'created_at' => date('Y-m-d h:i:s'),
                    ];

                    $insertCabList = $this->db->insert('cab_stack_list', $insCabStack);
                    // var_dump($insertCabList);
                    // die;
                    if ($insertCabList != TRUE) {
                        $this->db->trans_rollback();
                        log_message('error', '#ERRDUPDATECSL001: Updation failed in cab_stack_list');
                        log_message('error', $this->db->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRDUPDATECSL001: Updation failed in cab_stack_list. Kindly contact System Administrator',

                        ));
                        return false;
                    } else {
                        $this->db->trans_commit();

                        echo json_encode(array(
                            'responseType' => 2,
                            'message' => 'Cases Successfully Forwared for CAB Stack List',

                        ));
                    }
                }
            }
        }
    }



    public function getAllCasesListByDept()
    {
        if ($this->session->userdata('designation') == DPT_JS) {

            //Get Department User district List
            // $data['user_dist']      = $this->getDeptUserDistList();

            //change by MRIGANKA----------22092023

            $data['user_dist']      = $this->basundharaMb2Perpetualmodel->getDeptUserDistListWithCaseCount();
            // var_dump($data['user_dist']);exit;

            $dist_code     = trim($this->input->post('selectDistrict'));

            $data['dist_code'] = $dist_code;

            $user_code = $this->session->userdata('user_code');

            $this->form_validation->set_rules('selectDistrict', 'Please Select District Before Proceed', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['cases']      = '';
                $data['casesCount'] = 0;
                $this->session->set_flashdata('message', 'Please Select District Before Proceed.');
                $data['_view'] = 'SettlementView/Dept/AllPendingCaseListUnderDptPerpetual';
                $this->load->view('layouts/main', $data);
            } else {

                $this->db2 =  $this->dbswitch2($dist_code);
                $meeting = $this->basundharaMb2Perpetualmodel->getMeetingListByDist($this->db2,$dist_code);
                // var_dump($meeting);exit;
                $data['meetingList']      = $meeting->result();

                $this->db = $this->load->database('db2', TRUE);
                $ast = ASSISTANT_USERCODE;
                $sec = UNDER_SEC_USERCODE;
                $data['ast_list'] = $this->db->query("SELECT name,user_code,email,designation FROM depart_users WHERE designation in ('$ast','$sec')",array())->result();
                log_message('error','--'.$this->db->last_query());
                $cabIdList = $this->basundharaMb2Perpetualmodel->getCabinetIdList($dist_code,$user_code)->result();
                //var_dump($cabIdList);exit;

                $data['cabIdList'] = $cabIdList;

                $data['_view'] = 'SettlementView/Dept/AllPendingCaseListUnderDptPerpetual';
                $this->load->view('layouts/main', $data);
            }
        } else {
            echo "User Not Authorized to View this Page";
        }
    }


    public function addCasesToCabMemo_Old()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('cabinet_id', 'Cabinet ID', 'required');


        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Check Form Data',
            ));
        } else {
            $dist_code     = $this->input->post('district_id');
            $cabmemo_id     = $this->input->post('cabinet_id');
            $allSelectedList = $this->input->post('selectedList');

            $errCheck = 0;

            foreach ($allSelectedList as $item) {

                $splitResult = explode("@", $item);

                $newArray[] = $splitResult[0];
                
                }

                //Check Cases Already exist in cab_memo_list
                $this->db = $this->load->database('db2', TRUE);

                $cabMemoCases = $this->basundharaMb2Perpetualmodel->getExistingCasesUnderCabMemo($dist_code);
                $cabMemoCaseList  = $cabMemoCases->result_array();

                $memoCaseArray = array_column($cabMemoCaseList, 'case_no');

                $duplicates = array_intersect($newArray, $memoCaseArray);
                if (!empty($duplicates)) {
                    $duplicateCases = implode(", ", $duplicates);
                    echo json_encode(array(
                            'responseType' => 3,
                            'message'      => 'Cases Already Present in Cab Memo List  '.$duplicateCases.'',
                        ));
                    return;
                }
                //Check Cases Already exist in cab_memo_list

                $allSelectedCases = implode(", ", $newArray);

                $splitStrings = explode(', ', $allSelectedCases);

                if (!empty($splitStrings)) {
                    $casesList = "'" . implode("', '", $splitStrings) . "'";
                }


                $this->db2 =  $this->dbswitch2($dist_code);

                //Chitha Area Validation Start

                if(CHITHA_AREA_VALIDATION == 1)
                {
                    $errorArray = array();
                    foreach($newArray as $case)
                    {
                        $checkArea = $this->basundharaMb2Perpetualmodel->chithaReserveAreaCheckWithCaseNo($this->db2,$case); 

                        if($checkArea != 0)
                            {
                            $errorArray[] = $case;
                            continue;
                            }      
                    }

                    if(count($errorArray) > 0)
                    {
                        $errCheck = 1;

                        $case_str  = '';           
                        foreach ($errorArray as $err)
                        {
                            $case_str = $case_str.$err.',';
                        }           

                        $errorShow = '';
                        if($case_str != NULL)
                        {
                            $errorShow = ' Total Area Recommended for Settlement can’t exceed available Area in Chitha for
                                            (Case No. -  '.$case_str .')';
                        }                
                    
                        echo json_encode(array(
                            'responseType' => 3,
                            'message'      => '******** Unable to Add Cases to  CAB MEMO ******* .'.$errorShow.' !!!',
                        ));
                        return;
                    }
                }
                //Chitha Area Validation End

                //Check for Modification Request Status


                $pullRequestCase = $this->basundharaMb2Perpetualmodel->getPullRequestStatus($this->db2,$casesList);
                $pullRequestCaseCount = $pullRequestCase->num_rows();

                if($pullRequestCaseCount > 0)
                {

                $errCheck = 1;
                $pullRequestCasesList =$pullRequestCase->result();

                    $pullRequestCaseNos = array_map(function ($item) {
                            return $item->case_no;
                        }, $pullRequestCasesList);

                    $allPullRequestCases = implode(", ", $pullRequestCaseNos);

                     echo json_encode(array(
                        'responseType' => 3,
                        'message' => 'Failed to Add Cases to Cabinet Memo as Cases Trying to Add Have Modification Request for Case No (' . $allPullRequestCases . ') (***Revert These Cases To DC before Generate Memo)',
                    ));

                }

                //Modification Request Check End

                if($errCheck == 0)
                {

                $user_code = $this->session->userdata('user_code');
                $this->db = $this->load->database('db2', TRUE);
                $memo_name = $this->basundharaMb2Perpetualmodel->getMemoNameByCabId($this->db,$cabmemo_id);
        
                if ($cabmemo_id == NULL) {
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'CAB ID Not Found for ' .$this->utilclass->getDistrictNameOnLanding($dist_code). ' District Please Create CAB ID before Adding Cases to Cabinet Memo',

                    ));
                } else {

                if (!empty($allSelectedList)) {

                    foreach ($allSelectedList as $row) {

                        $parts = explode("@", $row);
                        list($case_no, $meeting_id,$proposal_no) = $parts;
    
                        $this->db->trans_begin();

                        //Insert in CAB Memo  List
                        $insCabStack = [
                            'cab_id' => $cabmemo_id,
                            'case_no' => $case_no,
                            'user_code' => $user_code,
                            'dist_code' => $dist_code,
                            'status' => ADD_CASES_TO_CAB_MEMO,
                            'created_at' => date('Y-m-d h:i:s'),
                            'meeting_id' => $meeting_id,
                            'proposal_id' => $proposal_no,
                        ];

                        $insertCabList = $this->db->insert('cab_memo_list', $insCabStack);

                        if ($insertCabList != TRUE) {
                            $this->db->trans_rollback();
                            log_message('error', '#ERRDUPDATECSL001: Updation failed in cab_memo_list');
                            log_message('error', $this->db->last_query());

                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'Failed to Add Cases to Cabinet Memo',

                            ));
                            return false;
                        } else {

                            $updateData = array(
                                'status' => ADD_CASES_UNDER_CAB_ID,
                                'finalized_at' => date('Y-m-d H:i:s'),
                            );

                            $where = array(
                                'cab_id' => $cabmemo_id,
                                'user_code' => $user_code,
                                // 'dist_code' => $dist_code,
                            );

                            $updateCabIdList = $this->basundharaMb2Perpetualmodel->updateCabStatus($this->db,$where, $updateData);
                            if ($updateCabIdList <= 0) {
                                $this->db->trans_rollback();
                                log_message('error', '#ERRDUPDATE0001: Updation failed in cab_id_list for bulk Approve');
                                log_message('error', $this->db->last_query());

                                echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'Failed to Add Cases to Cabinet Memo',

                                ));
                                return false;
                            } else {
                                $this->db->trans_commit();

                                //change status in Settlement basic
                                $this->db2 =  $this->dbswitch2($dist_code);

                                $this->db2->trans_begin();

                                $updateData = array(
                                    'cab_memo_prepared' => SB_ADD_CASES_TOCAB_MEMO,
                                );

                                $updateBasicStatus = $this->basundharaMb2Perpetualmodel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData);


                                if($updateBasicStatus <= 0){
                                $this->db2->trans_rollback();
                                log_message('error', '#ERRDUPDATBASICCAB: Updation failed in settlement_basic for change cabinet status');
                                log_message('error', $this->db2->last_query());

                                echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'Failed to Add Cases to Cabinet Memo',

                                ));
                                return false;

                                }else{

                                $this->db2->trans_commit();

                                }

                                //change sttatus in basic
                            }
                        }
                    }
                    echo json_encode(array(
                        'responseType' => 2,
                        'message' => 'Cases Successfully Added to Cabinet Memo ' .$memo_name .'('. $cabmemo_id . ') for District ' . $this->utilclass->getDistrictNameOnLanding($dist_code),

                    ));
                }
            }

                }
                

        }
    }


    public function downloadReportForCabMemo()
    {
        ini_set("pcre.backtrack_limit", "500000000");
        ini_set('memory_limit', '4096M');
        set_time_limit(0);
        include 'vendor/mpdf/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'dejavusans',
            'orientation' => 'L',
            'format' => 'A4-L'
        ]);

        $cab_memo_id = $this->input->get('cab_id');

        $htmlTag = '';
        $htmlTag .= '<h3 style="text-align: center;">Annexure -I <br>Report of Cases Under CAB Memo : ' . $cab_memo_id . '</u></h3>';

        $table1 = '<table cellpadding="5px" autosize="1" border="1" width="100%" style="overflow: wrap">
            <thead>
            <tr>
                <th >Sl No. </th>
                <th >District </th>
                <th >Case No </th>
                <th >Name of the Applicant with Address. </th>
                <th >Dag No </th>
                <th  >Area </th>
                <th >Circle</th>
                <th >Village</th>
                <th >Type of House</th>
                <th >SDLAC Approval</th>
                <th >Date</th>
                <th >Period & Nature of Possession</th>
                <th >Gender</th>
                <th >Zonal Value</th>
                <th >Landless Affidavit</th>
                <th >Type of House with Photo</th>
                <th >Assembly Recommendation</th>
                <th >Remarks</th>
            </tr>
            </thead>
            <tbody>';

        $this->db = $this->load->database('db2', TRUE);

        $dist_codes = $this->basundharaMb2Perpetualmodel->getDistrictUnderCabMemo($this->db,$cab_memo_id)->result();

        $table2 = ''; // Initialize an empty string to store the table rows
        $count = 1;
        $main_array = array();   

        foreach ($dist_codes as $dist) {
            $allSelectedList = $this->basundharaMb2Perpetualmodel->getCasesUnderCabMemo($this->db,$cab_memo_id, $dist)->result();
            $district = $dist->dist_code;
            // Switch DB based on dist_code
            $this->db2 = $this->dbswitch2($district);

            log_message('error', 'downloadReportForCabMemo: 11111 dist: '.$district);
            if (!empty($allSelectedList)) {
                foreach ($allSelectedList as $row) {
                    $case_no = $row->case_no;
                    
                    if (in_array($case_no, $main_array))
                       continue;

                    $settlement_basic = $this->basundharaMb2Perpetualmodel->getSettlementBasic($case_no);

                    if ($settlement_basic == null)
                       continue;

                    $main_array[] = $case_no;

                    $applicants   = $this->basundharaMb2Perpetualmodel->getAllApplicantBuyersName($case_no)->result();

                    $appNames = array_map(
                        function ($item) {
                            return $item->pdar_name;
                        },
                        $applicants
                    );

                    $appAddress1 = array_map(
                        function ($item) {
                            return $item->pdar_add1;
                        },
                        $applicants
                    );


                    $dags = $this->basundharaMb2Perpetualmodel->getAllAppliedDags($case_no)->result();

                    $dagNos = array_map(function ($item) {
                        return $item->dag_no;
                    }, $dags);


                    $commaSeparatedDags = implode(",", $dagNos);

                    $commaSeparatedNames = implode(",", $appNames);

                    $commaSeparatedAddress1 = implode(",", $appAddress1);

                    $dagsArea = $this->utilclass->dagAreabyCaseNo($settlement_basic['dist_code'], $case_no);

                    $district_name = $this->utilclass->getDistrictName($settlement_basic['dist_code']);

                    $circle_name = $this->utilclass->getCircleName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code']);

                    $village_name = $this->utilclass->getVillageName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code'], $settlement_basic['lot_no'], $settlement_basic['vill_townprt_code']);

                    $sdlacStatus = $this->basundharaMb2Perpetualmodel->sdlacCaseStatus($case_no)->row();

                    $settlement_enc = $this->basundharaMb2Perpetualmodel->getSettlementEncroacher($case_no);


                    $landless = $this->basundharaMb2Perpetualmodel->getLandLessVerify($case_no)->row();

                    $geo_tag = $this->basundharaMb2Perpetualmodel->getGeoTag($case_no);

                    $house_type = $this->utilclass->getHouseTypeByCaseNo($settlement_basic['dist_code'], $case_no);

                    $zonal_value = $this->utilclass->getZonalValueByCaseNo($settlement_basic['dist_code'], $case_no);


                    if (count($geo_tag) > 0) {

                        $geo_tag_yn = 'Yes';
                    } else {

                        $geo_tag_yn = 'No';
                    }


                    foreach ($applicants as $app) {

                        $appGender = $this->utilclass->getGender($app->pdar_gender);
                    }

                    //<td>' . date("j F, Y", strtotime($sdlacStatus->case_status)) . '</td>
                    $table2 .= '<tr>
                        <td>' . $count++ . '</td>
                        <td>' . $district_name . '</td>
                        <td style="color:blue">' . $case_no . '</td>
                        <td>' . $commaSeparatedNames . ' (Add: ' . $commaSeparatedAddress1 . ')</td>
                        <td style="color:blue">' . $commaSeparatedDags . '</td>
                        <td>' . $dagsArea . '</td>
                        <td>' . $circle_name . '</td>
                        <td>' . $village_name . '</td>
                        <td>' . $house_type . '</td>
                        <td>' . $sdlacStatus->case_status . '</td>
                        <td>' . date("j F, Y", strtotime($settlement_basic['sdlac_date'])) . '</td>
                        <td>' . date("j F, Y", strtotime($settlement_enc->period_possession)) . ' (' . ($settlement_basic['occupation_applicant']) .  ')</td>
                        <td>' . $appGender .  '</td>
                        <td style="color:blue">' . $zonal_value .  '</td>
                        <td>' . $landless->is_landless .  '</td>
                        <td>' . $geo_tag_yn .  '</td>
                        <td>' . 'RECOMMENDED' .  '</td>
                        <td>' . '' .  '</td>    
                    </tr>';
                }
                log_message('error', 'downloadReportForCabMemo:  2222 dist: '.$district);
            }
        }
        $table3 = '</tbody></table>';
        $table = $table1 . $table2 . $table3;
        $final = $htmlTag . $table;
        $report_name = 'Case_Report_Cab_memo_' . $cab_memo_id . '.pdf';

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->writeHTML($final);
        header('Content-type: application/pdf');
        $mpdf->Output($report_name, 'd');
    }

    public function clearCaseData(){

        $this->db = $this->load->database('db2', TRUE);

        $sql = "select distinct dist_code from cab_memo_list";
        $district  = $this->db->query($sql)->result();

        if(!empty($district)){

        foreach($district as $dist)
        {
            $district = $dist->dist_code;

            $allSelectedList = $this->basundharaMb2Perpetualmodel->getCasesUnderDistCabMemo($district)->result();
            // Switch DB based on dist_code
            $this->db2 = $this->dbswitch2($district);

            if (!empty($allSelectedList)) {
                foreach ($allSelectedList as $row) {

                    $case_no = $row->case_no;

                    $updateData = array(
                        'verified_by_asst' => 0,
                        'cab_memo_prepared' => 0,
                        'dept_approval' => NULL,
                        'pending_officer' => MB_DEPARTMENT,
                        'from_office' => MB_DEPUTY_COMM,
                        'status' => 'W',
                    );

                    $where = array(
                        'case_no' => $case_no
                    );

                    $update_basic = $this->basundharaMb2Perpetualmodel->clearBasicData($where, $updateData);
                }
            }
        }

    }

    $clearCabDetails = $this->basundharaMb2Perpetualmodel->clearCabDetails();

    if($clearCabDetails === TRUE){
        echo "Data Cleared Successfully..";

        $this->session->set_flashdata('message', "Data Cleared Successfully.");
        redirect('dashboard');

    }

}



  public function getAllCasesUnderDept() {

    $json = null;
    $dist_code = $this->input->post('selectDistrict');
    $service_code = $this->input->post('selectService');
    $meeting_no = $this->input->post('selectMeeting');
    $verification = $this->input->post('selectVerify');
    $pullRequest = $this->input->post('selectPullRequest');

    $draw = intval($this->input->post('draw'));

    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');

     $this->db2 =  $this->dbswitch2($dist_code);

    $cases_list = $this->basundharaMb2Perpetualmodel->getAllCasesUnderDepartmentAll($this->db2,$start, $length, $order,$service_code,$meeting_no,$verification,$pullRequest);

    // $total_records = $cases_list->num_rows();

    if(!empty($cases_list)) {

      if($cases_list['total_records'] > 0){

        $data_rows = $cases_list['data_results'];

        foreach($data_rows as $row) {

            $case_no = "<small class='case-no-bg'><i class='fa fa-archive'></i>" . $row->case_no . "</small>";

            $application_no = $this->utilclass->getApplidFromCaseNo($dist_code, $row->case_no);

            $app_no = "<br><small class='text-danger text-center p-4'>" . $application_no  ."</small>" ;

            $proposal_name = "<small class='text-black bg-success'>" . $row->proposal_name ."</small>";

            $service = "<small class='text-black bg-yellow'>" . $this->utilclass->getServiceName($row->service_code) ."</small>";
 
            $meeting_name = "<br><small class='text-danger text-center p-4'> " . $row->meeting_name  ."</small>";

            $minutelink = base_url() . "index.php/Basundhara/viewMinute/". $dist_code . "/" . $row->meeting_id ;

            $view_minute = "<br><a target='download' href=".$minutelink." ><i class='fa fa-paperclip'></i> &nbsp;View Minute</a>";

            $created_at = date('d-M-Y',strtotime($row->created_at));
            $verification = $row->verified_by_asst;

            $pullRequest = $row->pull_request;

            $deptReverted = $row->dept_revert;

            if($verification == VERIFICATION_PENDING){
            $verify = "<small class='text-warning'><i class='fa fa-clock-o' aria-hidden='true'></i>Pending</small>";
            }else if($verification == SENT_FORVERIFICATION){
            $verify = "<small class='text-primary'>Sent for Verification</small>";
            }else if($verification == VERIFIED_BY_ASSISTANT){
            $verify = "<small class='text-success'><i class='fa fa-check-circle' aria-hidden='true'></i>Verified</small><p>Remarks : ".$row->verified_ast_remarks."</p>";
            }else if($verification == SENT_FOR_REVERIFICATION){
            $verify = "<small class='text-warning'>Sent to Reverify</small>";
            }


             if($pullRequest == 1){
            $pullRequestStatus = "<small class='text-danger'>Modification Required</small>";
            }else{

            $pullRequestStatus = "<small class='text-success'></small>";

            }

            if($deptReverted == 1){
            $deptRevertedStatus = "<small class='bg-danger'>Reverted by DPT</small><small class='text-primary'> <i class='fa fa-forward'></i>(Sent Again by DC) </small>";
            }else{
            $deptRevertedStatus = "<small class='bg-success'></small>";
            }

          $link = base_url() . "index.php/Basundhara/settlementBasu/?app=".$application_no . "&dist_code=" .$dist_code;
          $view_case = "<a href=".$link." class='btn btn-sm btn-primary' target='_blank'><i class='fa fa-eye'></i> &nbsp;Details</a>";

          $button = $view_case;
          
          $json[] = array(
            $row->case_no . '@' . $row->meeting_id . '@' . $row->proposal_id,
            $case_no . $app_no .$deptRevertedStatus,
            '<small>' .$service .'</small>',
            $proposal_name . $meeting_name . $view_minute,
            '<small>'.$created_at .'</small>',
            $verify,
            $pullRequestStatus,
            $button,
          );
        }
      }
      else {
        $json = "";
      }      
    $total_records = $cases_list['total_records'];
      $response = array(
        'draw'              => $draw,
        'recordsTotal'      => $total_records,
        'recordsFiltered'   => $total_records,
        'data'              => $json
      );
      echo json_encode($response);
    }
    else
    {
      $response = array();
      $response['sEcho']=0;
      $response['iTotalRecords']=0;
      $response['iTotalDisplayRecords']=0;
      $response['aaData']=[];
      echo json_encode($response);
    }
  }




    public function getAllCasesUnderAssistant() {

    $json = null;
    $dist_code = $this->input->post('selectDistrict');
    $service_code = $this->input->post('selectService');
    $meeting_no = $this->input->post('selectMeeting');
    $verification = $this->input->post('selectVerify');
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');

    $this->db2 =  $this->dbswitch2($dist_code);

    $cases_list = $this->basundharaMb2Perpetualmodel->getAllCasesUnderAssistant($this->db2,$start, $length, $order,$service_code,$meeting_no);


    // $total_records = $cases_list->num_rows();

    if(!empty($cases_list)) {

      if($cases_list['total_records'] > 0){

        $data_rows = $cases_list['data_results'];

        foreach($data_rows as $row) {

            $case_no = "<small class='case-no-bg'><i class='fa fa-archive'></i>" . $row->case_no . "</small>";

            $application_no = $this->utilclass->getApplidFromCaseNo($dist_code, $row->case_no);

            $app_no = "<br><small class='text-danger text-center p-4'>" . $application_no  ."</small>" ;

            $proposal_name = "<small class='text-black bg-success'>" . $row->proposal_name ."</small>";

            $service = "<small class='text-black bg-yellow'>" . $this->utilclass->getServiceName($row->service_code) ."</small>";
 
            $meeting_name = "<br><small class='text-danger text-center p-4'> " . $row->meeting_name  ."</small>";

            $minutelink = base_url() . "index.php/Basundhara/viewMinute/". $dist_code . "/" . $row->id ;

            $view_minute = "<br><a target='download' href=".$minutelink." ><i class='fa fa-paperclip'></i><small>&nbsp;View Minute</small></a>";

            $created_at = date('d-M-Y',strtotime($row->created_at));
            $verification = $row->verified_by_asst;



            if($verification == VERIFICATION_PENDING){
            $verify = "<small class='text-warning'>Pending</small>";
            }else if($verification == SENT_FORVERIFICATION){
            $verify = "<small class='text-primary'>Sent by DPT for Verification</small>";
            }else if($verification == VERIFIED_BY_ASSISTANT){
            $verify = "<small class='text-success'>Verified</small>";
            }else if($verification == SENT_FOR_REVERIFICATION){
            $verify = "<small class='text-warning'>Sent to Reverify</small>";
            }

          $link = base_url() . "index.php/Basundhara/settlementBasu/?app=".$application_no . "&dist_code=" .$dist_code;
          $view_case = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-eye'></i> &nbsp;Details</a>";

          $button = $view_case;
          
          $json[] = array(
            $case_no . $app_no,
            '<small>'.$service .'</small>',
            $proposal_name . $meeting_name . $view_minute,
            '<small>'.$created_at .'</small>',
            $verify,
            $button,
          );
        }
      }
      else {
        $json = "";
      }      
    $total_records = $cases_list['total_records'];
      $response = array(
        'draw'              => $draw,
        'recordsTotal'      => $total_records,
        'recordsFiltered'   => $total_records,
        'data'              => $json
      );
      echo json_encode($response);
    }
    else
    {
      $response = array();
      $response['sEcho']=0;
      $response['iTotalRecords']=0;
      $response['iTotalDisplayRecords']=0;
      $response['aaData']=[];
      echo json_encode($response);
    }
  }



    public function bulkSentForVerification()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('selectAssistant', 'selectAssistant', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Check Form Data',
            ));
        } else {
            $dist_code       = $this->input->post('district_id');
            $selectAssistant = $this->input->post('selectAssistant');
            $allSelectedList = $this->input->post('selectedList');
            $allSelectedList = explode(',',$allSelectedList);
            $user_code = $this->session->userdata('user_code');


                if (!empty($allSelectedList)) {

                    foreach ($allSelectedList as $row) {


                        $case_no = strtok($row, '@');

                        $this->db2 =  $this->dbswitch2($dist_code);

                        $this->db2->trans_begin();
                        $checkCasesSendStatus = $this->basundharaMb2Perpetualmodel->checkCaseStatusVerify($case_no, $dist_code);
                    
                        log_message('error',"999999999999---------".$checkCasesSendStatus);
                        if($checkCasesSendStatus != null){
                            $this->db2->trans_rollback();
                            log_message('error', '#MBERRSFV01: Already Verified in settlement_basic ');

                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => '#Error-01-Already assigned to Assistant--CASE NO--'.$case_no,

                            ));
                            return false;
                        }
                        $updateData = array(
                            'verified_by_asst' => SENT_FORVERIFICATION,
                            'assign_ast_code'  => $selectAssistant
                        );

                        $updateBasicStatus = $this->basundharaMb2Perpetualmodel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData);

                        if($updateBasicStatus <= 0){
                            $this->db2->trans_rollback();
                            log_message('error', '#ERRSFV: Updation failed in settlement_basic when send for verification');
                            log_message('error', $this->db2->last_query());

                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'Failed to Send Cases for Verification',

                            ));
                            return false;

                        }else{

                            $this->db2->trans_commit();

                        }

                                //change sttatus in basic
                    }
                    echo json_encode(array(
                        'responseType' => 2,
                        'message' => 'Cases Send For Assistant Verification',

                    ));
                }

            }
        
    }



    public function getCasesListByDistrict()
    {
        if (($this->session->userdata('designation') == ASSISTANT_USERCODE) || ($this->session->userdata('designation') == UNDER_SEC_USERCODE)) {

            //Get Department User district List
            $data['user_dist']      = $this->getDeptUserDistListAssistant();

            $dist_code     = trim($this->input->post('selectDistrict'));

            $data['dist_code'] = $dist_code;

            $this->form_validation->set_rules('selectDistrict', 'Please Select District Before Proceed', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['cases']      = '';
                $data['casesCount'] = 0;
                $this->session->set_flashdata('message', 'Please Select District Before Proceed.');
                $data['_view'] = 'SettlementView/Dept/AllPendingCaseListUnderAssistantPerpetual';
                $this->load->view('layouts/main', $data);
            } else {

                $this->db2 =  $this->dbswitch2($dist_code);

                $meeting = $this->basundharaMb2Perpetualmodel->getMeetingListByDist($this->db2,$dist_code);
                $data['meetingList']      = $meeting->result();

                $data['_view'] = 'SettlementView/Dept/AllPendingCaseListUnderAssistantPerpetual';
                $this->load->view('layouts/main', $data);
            }
        } else {
            echo "User Not Authorized to View this Page";
        }
    }


    //Revert Cases by Department to DC
    public function revertCaseByDeptToDC()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        $this->load->library('form_validation');

        $this->form_validation->set_rules('caseNo', 'Case Number', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 1,
            ));
            return;
        } else {
            $case_no   = $this->input->post('caseNo');
            $service_code   = $this->input->post('serviceCode');
            $revert_remarks   = $this->input->post('revertRemarks');
            $dist_code = $this->input->post('distCode');
            $user_code = $this->session->userdata('user_code');

            $this->db2 = $this->dbswitch2($dist_code);

            $caseCount = $this->basundharaMb2Perpetualmodel->countSettlementApplicationDetailsByCaseNo($case_no, $dist_code);

            if ($caseCount == 0) {
                echo json_encode(array(
                    'responseType' => 3,
                ));
                return;
            } else {
                $updateData = array(
                    'status' => MB_REVERT,
                    'pending_officer' => MB_DEPUTY_COMM,
                    'dept_code' => $user_code,
                    'dept_approval' => DPT_REVERTED,
                    'from_office'     => MB_DEPARTMENT,
                    'pending_office' => MB_DEPUTY_COMM,
                    'dept_revert'     => 1,
                );
                $this->db2->trans_begin();
                if ($this->basundharaMb2Perpetualmodel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData) == 0) {
                    $this->db2->trans_rollback();
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'Case Not Reverted ! Kindly Contact System Admin.',

                    ));
                    return;
                } else {
                    //////proceeding start//////
                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;
                    if ($proceeding_id == null) {
                        $proceeding_id = 1;
                    }
                    $insPetProceed = [
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'next_date_of_hearing' => date('Y-m-d h:i:s'),
                        'note_on_order' => $revert_remarks,
                        'user_code' => $user_code,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'office_from' => MB_DEPARTMENT,
                        'office_to'   => MB_DEPUTY_COMM,
                        'task' => 'Revert to DC',
                        'status' => MB_REVERT,
                        'note_type' => 'Maybe Reject',
                    ];
                    $insertProceeding = $this->db2->insert('settlement_proceeding', $insPetProceed);

                    if ($insertProceeding != 1) {
                        $this->db2->trans_rollback();
                        log_message('error', '#MR00891: Insertion failed in settlement_proceeding for case no :' . $case_no);
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'Case Not Reverted ! Kindly Contact System Admin.',

                        ));
                        return;
                    } else {

                    //////////////POST To basundhara/////////////////////
                    $application_no = $this->basundharaMb2Perpetualmodel->getApplicationNoByCaseNo($this->db2,$case_no)->applid;

                    $rmk = 'Reverted to DC';
                    $status = MB_REVERT;
                    $task = MB_DEPARTMENT;
                    $pen = MB_DEPUTY_COMM;
                    $case = $case_no;
                    $rtpsno = $application_no;

                    $rtps_status = $this->basundharaMb2Perpetualmodel->postApiBasundhara($rtpsno, $case, $rmk, $status, $task, $pen);
                    $rtps_status = json_decode($rtps_status);
                    //////////////POST To basundhara End///////////////
                    log_message('error','api_response: rtpsno: '.$rtpsno.'---'.json_encode($rtps_status));
                    if (trim($rtps_status) != 'y') {
                            $this->db->trans_rollback();
                            // $this->session->set_flashdata('message', "Error #ERRAPIREVERT: Update Failed in API for Application_no # $rtpsno");
                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'Application not Reverted',
                            ));
                            // redirect(base_url() . "index.php/home");
                        } else {
                            $this->db2->trans_commit();

                            echo json_encode(array(
                                'responseType' => 2,
                                'message' => 'Application Reverted to DC Successfully',
                            ));
                        }
                    }
                    //////proceeding end//////
                }
            }
        }
    }


    public function casesListForFinalApprovalByDept()
    {
        $cab_id = $this->input->get('cab_id');
        // $dist_code   = $this->session->userdata('dist_code');
        $user_code   = $this->session->userdata('user_code');
        $this->db = $this->load->database('db2', TRUE);
        $cases_list = $this->basundharaMb2Perpetualmodel->getAllCasesFromMemoForFinalApproval($this->db,$cab_id,$user_code);

        $digitalSignedStatus = $this->basundharaMb2Perpetualmodel->digitalSignedStatusOfCabId($this->db,$cab_id);


        $data['cab_id']         = $cab_id;
        $data['finalCases']         = $cases_list->result();
        $data['finalCaseCount'] = $cases_list->num_rows();
        $data['digitalSignedStatus'] = $digitalSignedStatus->notification_digital_sign_status;
        $data['_view'] = 'SettlementView/Dept/caseListForFinalApprovalDptReview';
        $this->load->view('layouts/main', $data);

    }



    public function revertToDcByDeptTemp()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        $this->load->library('form_validation');

        $this->form_validation->set_rules('case_no', 'Case Number', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 1,
            ));
            return;
        } else {
            $case_no   = $this->input->post('case_no');
            $dist_code = $this->input->post('dist_code');
            $revert_remarks = $this->input->post('revert_remarks');
            $user_code = $this->session->userdata('user_code');
            //Change in Dharitree
            $this->db2 = $this->dbswitch2($dist_code);

            $updateBasicData = array(
                'status' => MB_REVERT,
                'pending_officer' => MB_DEPUTY_COMM,
                'dept_code' => $user_code,
                'user_code' => $user_code,
                'dept_approval' => DPT_REVERTED,
                'from_office'     => MB_DEPARTMENT,
                'pending_office' => MB_DEPUTY_COMM,
                'dept_revert'     => 1,
            );
            $updateBasicStatus = $this->basundharaMb2Perpetualmodel->updateSettlementBasicData($case_no, $updateBasicData);

             if ($updateBasicStatus <= 0) {
                $this->db2->trans_rollback();
                log_message('error', '#ERRUPDATERVTDC001: Updation failed in settlement_basic for Revert');
                log_message('error', $this->db2->last_query());

                echo json_encode(array(
                    'responseType' => 1,
                    'message' => '#ERRUPDATERVTDC001: Revert Failed. Kindly contact System Administrator',

                ));
                return false;
            }else{

            //////proceeding start//////
                $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                if ($proceeding_id == null) {
                    $proceeding_id = 1;
                }
                $insPetProceed = [
                    'case_no' => $case_no,
                    'proceeding_id' => $proceeding_id,
                    'date_of_hearing' => date('Y-m-d h:i:s'),
                    'next_date_of_hearing' => date('Y-m-d h:i:s'),
                    'note_on_order' => 'Revert to DC for Recheck',
                    'user_code' => $user_code,
                    'date_entry' => date('Y-m-d h:i:s'),
                    'operation' => 'E',
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'office_from' => MB_DEPARTMENT,
                    'office_to'   => MB_DEPUTY_COMM,
                    'task' => 'Revert to DC',
                    'status' => MB_REVERT,
                    'note_type' => 'Maybe Reject',
                ];

                $insertProceeding = $this->db2->insert('settlement_proceeding', $insPetProceed);

                    if ($insertProceeding != 1) {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRORREVSP001: Insertion failed in settlement_proceeding for case no :' . $case_no);
                        log_message('error', $this->db2->last_query());
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRORREVSP001: Revert Failed . Kindly contact System Administrator',

                        ));
                        return false;
                    }
                    else{
                         $updateProposalData = array(
                                            'dept_status' => DEPT_PROPOSAL_CASE_REVERT,
                                        );

                        $updateProposalRevert = $this->basundharaMb2Perpetualmodel->updateProposalData($case_no, $updateProposalData);

                         if ($updateProposalRevert <= 0) {
                                    $this->db2->trans_rollback();
                                    log_message('error', '#ERRUPDATEREVSPC001: Updation failed in settlement_proposal_cases for final Submission');
                                    log_message('error', $this->db2->last_query());
                                    echo json_encode(array(
                                        'responseType' => 1,
                                        'message' => '#ERRUPDATEREVSPC001: Revert Failed. Kindly contact System Administrator',

                                    ));
                                    return false;
                                }else{
                                    //////////////POST To basundhara/////////////////////
                                    $application_no = $this->basundharaMb2Perpetualmodel->getApplicationNoByCaseNo($this->db2,$case_no)->applid;
                                    $case = $case_no;
                                    $rtpsno = $application_no;
                                    // $rmk = 'Reverted to DC';
                                    $rmk = $revert_remarks;
                                    $status = MB_PAYMENT_REQUEST;
                                    $task = MB_DEPARTMENT;
                                    $pen = MB_DEPUTY_COMM;

                                    $rtps_status = $this->basundharaMb2Perpetualmodel->postApiBasundhara($rtpsno, $case, $rmk, $status, $task, $pen);
                                    $rtps_status = json_decode($rtps_status);
                                    // var_dump($rtps_status);

                                     if (trim($rtps_status) != 'y') {
                                        log_message('error','api_response: rtpsno: '.$rtpsno.'---'.json_encode($rtps_status));
                                        $this->db2->trans_rollback();
                                        echo json_encode(array(
                                            'responseType' => 1,
                                            'message' => '#Revert to DC Failed. Kindly contact System Administrator for the case no.--'.$case,
        
                                        ));
                                        return false;
                                    } else {
                                        $this->db2->trans_commit();

                                        //Update in cab_memo_list in ILRMS
                                        $this->db = $this->load->database('db2', TRUE);

                                            $updateData = [
                                                    'final_status' => 2,
                                                    'remarks' => $revert_remarks,
                                                ];

                                            $where = [
                                                    'case_no' => $case_no,
                                                    'dist_code' => $dist_code,
                                                    'user_code' => $user_code,
                                                ];

                                            $updateCabMemoList = $this->basundharaMb2Perpetualmodel->updateCabMemoList($updateData, $where);

                                            if($updateCabMemoList >0){

                                            echo json_encode(array(
                                                        'responseType' => 2,
                                                        'message' => 'Case No: ' .$case_no.' Reverted to DC',
                                                    ));
                                                }else{

                                                echo json_encode(array(
                                                        'responseType' => 1,
                                                        'message' => 'Case No: ' .$case_no.'  Not Reverted',
                                                    ));
                                            }
                                    }

                                }
                    }
                    //////proceeding end//////
            }
            //Change in Dharitree



        }
    }


    public function approveByDeptTemp()
    {
        // $_POST = json_decode(file_get_contents("php://input"), true);


        $this->load->library('form_validation');

        $this->form_validation->set_rules('case_no', 'Case Number', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 1,
            ));
            return;
        } else {
            $case_no   = $this->input->post('case_no');
            $dist_code = $this->input->post('dist_code');
            $user_code = $this->session->userdata('user_code');

            $this->db = $this->load->database('db2', TRUE);

                    $updateData = [
                            'final_status' => TEMP_APPROVE_BY_DEPT,
                            'remarks' => NULL,
                        ];

                    $where = [
                            'case_no' => $case_no,
                            'dist_code' => $dist_code,
                            'user_code' => $user_code,
                        ];


                    $updateCabMemoList = $this->basundharaMb2Perpetualmodel->updateCabMemoList($updateData, $where);

                    if($updateCabMemoList >0){

                     echo json_encode(array(
                                'responseType' => 2,
                                'message' => 'Case Prepared for Final Approval',
                            ));
                        }else{

                        echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'Case Not Approved',
                            ));
            }
        }
    }

        public function in_array_all($needles, $haystack) {
        return empty(array_diff($needles, $haystack));
        }


    //Final Approval of Cases By Dept (Sent For Payment Generation)
    public function finalSubmissionByDept()
    {
            ini_set("pcre.backtrack_limit", "500000000");
            ini_set('memory_limit', '4096M');
            set_time_limit(0);
            // $_POST = json_decode(file_get_contents("php://input"), true);
            header('content-type:application/json');
            $user_code = $this->session->userdata('user_code');

            $this->form_validation->set_rules('cab_id_selected', 'Cabinet Id', 'trim|required');
            $this->form_validation->set_rules('dept_order_no', 'Order No', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array(
                    'responseType' => 3,
                    'message' => 'Validation Errors !. Enter Order No',
                ));
            } else 
            {
                $cabinet_id = $this->input->post('cab_id_selected');
                $dept_order_no = $this->input->post('dept_order_no');
                if(empty($_FILES) || empty($_FILES['notificationCopy']['name'])){
                    echo json_encode(array(
                        'responseType' => 3,
                        'message' => 'Some files are missing please check once...',
                    ));
                    return;
                }

                //NEWLY INTEGRATED ON 12092023--------------MB001:D
                // $ext = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
                $ext1 = pathinfo($_FILES['notificationCopy']['name'], PATHINFO_EXTENSION);
                $newCabId = str_replace("/","-",$cabinet_id);
                // $newFileName = date('dmyhis')."-".$newCabId."-".$_FILES['fileToUpload']['name'];
                $newFileName1 = date('dmyhis')."-".$newCabId."-".$_FILES['notificationCopy']['name'];
                $FILES_TYPE_VALIDATION_ARR = explode('|', FILE_TYPE);
                $checkFileExt = false;
                if($this->in_array_all([$ext1], $FILES_TYPE_VALIDATION_ARR)){
                        $checkFileExt = true;
                }


                $validation=null;
                if(!$checkFileExt){
                    log_message('error','#ERROR-01-File Uploading Error...'.$newCabId);
                    echo json_encode(array(
                        'responseType' => 3,
                        'message' => '#ERROR-01-File Uploading Error...',
                    ));
                    return;
                }

                $this->db = $this->load->database('db2', TRUE);
                $dist_codes = $this->basundharaMb2Perpetualmodel->getDistrictUnderCabMemo($this->db,$cabinet_id)->result();

                //Modification Request check

                $distMeeting = $this->db->query("select  dist_code,meeting_id from cab_memo_list WHERE cab_id=? AND status=? group by dist_code, meeting_id", array($cabinet_id, CAB_MEMO_DOC_GENERATED))->result();

                $errCheck = 0;

                foreach($distMeeting as $dist)
                {

                    $this->db2 =  $this->dbswitch2($dist->dist_code);

                    $meetingCase = $this->basundharaMb2Perpetualmodel->getCasesCountByDistMeeting($this->db2,$dist->meeting_id);

                    $pullRequestCase = $this->basundharaMb2Perpetualmodel->getCasesHavingPullRequest($this->db2,$dist->meeting_id);

                    $meetingCaseCount = $meetingCase->num_rows();

                    $pullRequestCaseCount = $pullRequestCase->num_rows();


                    if($pullRequestCaseCount > 0)
                    {

                    $errCheck = 1;
                    $pullRequestCasesList =$pullRequestCase->result();

                            

                    $pullRequestCaseNos = array_map(function ($item) {
                                return $item->case_no;
                            }, $pullRequestCasesList);

                        $allPullRequestCases = implode(", ", $pullRequestCaseNos);
            

                        $meetingName = $this->utilclass->getMeetingNameByMeetingId($dist->dist_code, $dist->meeting_id);

                        echo json_encode(array(
                            'responseType' => 3,
                            'message' => "Final Approval of Cases Under :   $cabinet_id  not Submitted as Cases Having Modification Request Under meeting  $meetingName  : ( $allPullRequestCases ) ***(Revert These Cases To DC before Generate Memo)"
                        ));

                    }
                
                }

                //Modification Request check end

                if($errCheck == 0)
                {
                    foreach($dist_codes as $dist)
                    {
                        $this->db = $this->load->database('db2', TRUE);
                        $caseListForFinalSubmitByDist = $this->basundharaMb2Perpetualmodel->getCaseListDetailsForFinalSubmit($this->db,$cabinet_id,$user_code,$dist->dist_code)->result();

                        if (!empty($caseListForFinalSubmitByDist)) {
                        
                            foreach ($caseListForFinalSubmitByDist as $row) {

                                $case_no = $row->case_no;
                                $final_status = $row->final_status;
                                $distict = $row->dist_code;
                                $this->db2 = $this->dbswitch2($distict);

                                $this->db2->trans_begin();

                                    // Update in Settlement Basic
                                        if($final_status == TEMP_APPROVE_BY_DEPT){

                                            $updateData = array(
                                                'status' => MB_PAYMENT_REQUEST,
                                                'pending_officer' => MB_CIRCLE_OFFICER,
                                                'pending_office' => MB_CIRCLE_OFFICER,
                                                'dept_code' => $user_code,
                                                'user_code' => $user_code,
                                                'dept_approval' => DPT_APPROVED,
                                                'from_office'     => MB_DEPARTMENT,
                                            );
                                        }

                                        if ($this->basundharaMb2Perpetualmodel->updateSettlementBasicData($case_no, $updateData) <= 0) {

                                            $this->db2->trans_rollback();
                                            log_message('error', '#ERRUPDATEFINAL001: Updation failed in settlement_basic for final Update');
                                            log_message('error', $this->db2->last_query());

                                            echo json_encode(array(
                                                'responseType' => 1,
                                                'message' => '#ERRUPDATEFINAL001: Updation failed in settlement_basic. Kindly contact System Administrator',

                                            ));
                                            return false;
                                        }
                                        // Update in Settlement Basic End

                                        //////proceeding start//////
                                        $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                                        if ($proceeding_id == null) {
                                            $proceeding_id = 1;
                                        }

                                        if($final_status == TEMP_APPROVE_BY_DEPT){
                                            $insPetProceed = [
                                                'case_no' => $case_no,
                                                'proceeding_id' => $proceeding_id,
                                                'date_of_hearing' => date('Y-m-d h:i:s'),
                                                'next_date_of_hearing' => date('Y-m-d h:i:s'),
                                                'note_on_order' => 'Approved & send for Payment Generation',
                                                'user_code' => $user_code,
                                                'date_entry' => date('Y-m-d h:i:s'),
                                                'operation' => 'E',
                                                'ip' => $_SERVER['REMOTE_ADDR'],
                                                'office_from' => MB_DEPARTMENT,
                                                'office_to'   => MB_CIRCLE_OFFICER,
                                                'task' => 'Forwarded To CO',
                                                'status' => MB_PAYMENT_REQUEST,
                                                'note_type' => 'Maybe Approve',
                                            ];
                                        }

                                        $insertProceeding = $this->db2->insert('settlement_proceeding', $insPetProceed);

                                        if ($insertProceeding != 1) {
                                            $this->db2->trans_rollback();
                                            log_message('error', '#ERRORSP001: Insertion failed in settlement_proceeding for case no :' . $case_no);
                                            log_message('error', $this->db2->last_query());
                                            echo json_encode(array(
                                                'responseType' => 1,
                                                'message' => '#ERRORSP001: Failed to insert . Kindly contact System Administrator',

                                            ));
                                            return false;
                                        }
                                        //////proceeding end//////

                                        //////////////UPDATE To Settlement_proposal_cases/////////////////////             

                                        if($final_status == TEMP_APPROVE_BY_DEPT){
                                            $updateProposalData = array(
                                                    'dept_status' => DEPT_PROPOSAL_CASE_APPROVE,
                                                );
                                            }
            
                                        if ($this->basundharaMb2Perpetualmodel->updateProposalData($case_no, $updateProposalData) <= 0) {
                                            $this->db2->trans_rollback();
                                            log_message('error', '#ERRUPDATESPC001: Updation failed in settlement_proposal_cases for final Submission');
                                            log_message('error', $this->db2->last_query());
                                            echo json_encode(array(
                                                'responseType' => 1,
                                                'message' => '#ERRUPDATESPC001: Updation failed in settlement_proposal_cases. Kindly contact System Administrator',

                                            ));
                                            return false;
                                        }else{

                                            //////////////POST To basundhara/////////////////////
                                            $application_no = $this->basundharaMb2Perpetualmodel->getApplicationNoByCaseNo($this->db2,$case_no)->applid;
                                            $case = $case_no;
                                            $rtpsno = $application_no;

                                            if($final_status == TEMP_APPROVE_BY_DEPT){
                                                $rmk = 'Approved  & Forwarded to CO';
                                                $status = MB_PAYMENT_REQUEST;
                                                $task = MB_DEPARTMENT;
                                                $pen = MB_CIRCLE_OFFICER;
                                            }
                                        
                                            $rtps_status = $this->basundharaMb2Perpetualmodel->postApiBasundhara($rtpsno, $case, $rmk, $status, $task, $pen);
                                            $rtps_status = json_decode($rtps_status);
                                            if (trim($rtps_status) != 'y') {
                                                $this->db2->trans_rollback();
                                                echo json_encode(array(
                                                    'responseType' => 1,
                                                    'message' => '#ERRAPIAPPROVE: Applications Final Submission Failed. Kindly contact System Administrator for the case no.--'.$case,
                
                                                ));
                                                return false;
                                            } else {
                                                $this->db2->trans_commit();
                                            }
                                            // //////////////POST To basundhara End///////////////
                                            log_message('error','api_response: rtpsno: '.$rtpsno.'---'.json_encode($rtps_status));
                                        }  
        
                                    }           
                        }

                    } 
                    $this->db = $this->load->database('db2', TRUE);

                    $this->db->trans_begin();

                    $updateData = [
                        'final_submit_status' => FINAL_SUBMIT_BY_DEPT,
                        'updated_at'       => date('Y-m-d h:i:s'),
                        'approved_at'       => date('Y-m-d h:i:s'),   
                    ];

                    $where = [
                            'cab_id' => $cabinet_id,
                            'user_code' => $user_code,
                        ];


                    $updateCabMemoList = $this->basundharaMb2Perpetualmodel->updateCabMemoList($updateData, $where);
                    if($updateCabMemoList <= 0){
                        log_message('error',"#ERROR-03-Updation error in table cab_memo_list");
                        $this->db->trans_rollback();
                        echo json_encode(array(
                            'responseType' => 3,
                            'message' => '#ERROR-03-Updation error...',
                        ));
                        return false;

                    }
        
                    $updateUpload = array(
                        'upload_notification_doc_path' => NOTIFICATION_UPLOAD_DIR.$newFileName1,
                        'status'    => FINAL_SUBMISSION_CAB_MEMO,
                        'dept_order_no'    => $dept_order_no,
                        'updated_at'       => date('Y-m-d h:i:s'),
                        'approved_at'       => date('Y-m-d h:i:s')                        
                    );

                    $whereUpload = array(
                        'cab_id'    => $cabinet_id,
                    );

                    $affectedRows = $this->basundharaMb2Perpetualmodel->updateCabStatus($this->db,$whereUpload, $updateUpload);
                    if($affectedRows <= 0){
                        log_message('error',"#ERROR-02-File Uploading error in table cab_id_list");
                        $this->db->trans_rollback();
                        echo json_encode(array(
                            'responseType' => 3,
                            'message' => '#ERROR-02-File Uploading Error...',
                        ));

                    }
                    // move_uploaded_file($_FILES['fileToUpload']['tmp_name'], UPLOAD_DIR . $newFileName);
                    move_uploaded_file($_FILES['notificationCopy']['tmp_name'], NOTIFICATION_UPLOAD_DIR . $newFileName1);

                    if($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                        echo json_encode(array(
                            'responseType' => 3,
                            'message' => '#ERROR-05-Something went wrong...',
                        ));
                        return false;
                    }else{
                        $this->db->trans_commit();
                        echo json_encode(array(
                            'responseType' => 2,
                            'message' => 'Final Submission of Cases Under Cabinet Memo'.$cabinet_id. ' Successful',
                        ));
                        return false;
                    }

                }

            }
    }


    public function getRevertedCasesDetails()
    {
        $this->db = $this->load->database('db2', TRUE);
        $cabId =  trim($_POST['caninet_id_selected']);
        $revertedCases = $this->basundharaMb2Perpetualmodel->getAllRevertedCaseDetails($cabId);
        echo json_encode($revertedCases);
    }



    //Get Bhumiputra Details New
    public function bhumiPutra()
    {
        $certificate_number = isset($_GET['cer_number']) ? $_GET['cer_number'] : null;

        $ack_number = isset($_GET['ack_number']) ? $_GET['ack_number'] : null;

        if (isset($certificate_number)) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => API_LINK_MB2 . 'getBhumiputraCertificate',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'certificate_no' => $certificate_number,
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $responsetrue = json_decode($response);

            if ($responsetrue->responseType == 1) {
                $this->session->set_flashdata('message', "Bhumiputra Status: " . $responsetrue->data->status);
                $this->load->view('errorNotFoundPage'); 

                // redirect('/home');
            }

            if ($responsetrue->responseType == 2) {
                $base64data = base64_decode($responsetrue->data, true);
                header("Content-type: application/pdf");
                echo $base64data;
            }

            //if ($response->responseType == true || $response) {
            // if ($response->responseType == 2) {
            //     $base64data = base64_decode($response, true);
            //     header("Content-type: application/pdf");
            //     echo $base64data;
            // }
            $this->session->set_flashdata('message', "Failed to load file. File not found!");
            $this->load->view('errorNotFoundPage'); 
            // redirect('/home');

        } elseif (isset($ack_number)) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => API_LINK_MB2 . 'getBhumiputraCertificate',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'acknowledgement_no' => $ack_number,
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $responsetrue = json_decode($response);

            if ($responsetrue->responseType == 1) {
                $this->session->set_flashdata('message', "Bhumiputra Status: " . $responsetrue->data->status);
                // redirect('/home');
                $this->load->view('errorNotFoundPage'); 

            }

            if ($responsetrue->responseType == 2) {
                $base64data = base64_decode($responsetrue->data, true);
                header("Content-type: application/pdf");
                echo $base64data;
            }

            // if ($response == true || $response) {
            //     $base64data = base64_decode($response, true);
            //     header("Content-type: application/pdf");
            //     echo $base64data;
            // }
            $this->session->set_flashdata('message', "Failed to load file!");
            $this->load->view('errorNotFoundPage'); 
            
            // redirect('/home');

        }
    }




    public function revertToDcByDeptBeforeCab()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        $this->load->library('form_validation');

        $this->form_validation->set_rules('case_no', 'Case Number', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 1,
            ));
            return;
        } else {
            $case_no   = $this->input->post('case_no');
            $dist_code = $this->input->post('dist_code');
            $revert_remarks = $this->input->post('revert_remarks');
            $user_code = $this->session->userdata('user_code');
            //Change in Dharitree
            $this->db2 = $this->dbswitch2($dist_code);

            $updateBasicData = array(
                'status' => MB_REVERT,
                'pending_officer' => MB_DEPUTY_COMM,
                'dept_code' => $user_code,
                'user_code' => $user_code,
                'dept_approval' => DPT_REVERTED,
                'from_office'     => MB_DEPARTMENT,
                'pending_office' => MB_DEPUTY_COMM,
                'dept_revert'     => 1,
            );
            $updateBasicStatus = $this->basundharaMb2Perpetualmodel->updateSettlementBasicData($case_no, $updateBasicData);

             if ($updateBasicStatus <= 0) {
                $this->db2->trans_rollback();
                log_message('error', '#ERRUPDATERVTDC001: Updation failed in settlement_basic for Revert');
                log_message('error', $this->db2->last_query());

                echo json_encode(array(
                    'responseType' => 1,
                    'message' => '#ERRUPDATERVTDC001: Revert Failed. Kindly contact System Administrator',

                ));
                return false;
            }else{

            //////proceeding start//////
                $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                if ($proceeding_id == null) {
                    $proceeding_id = 1;
                }
                $insPetProceed = [
                    'case_no' => $case_no,
                    'proceeding_id' => $proceeding_id,
                    'date_of_hearing' => date('Y-m-d h:i:s'),
                    'next_date_of_hearing' => date('Y-m-d h:i:s'),
                    'note_on_order' =>$revert_remarks,
                    'user_code' => $user_code,
                    'date_entry' => date('Y-m-d h:i:s'),
                    'operation' => 'E',
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'office_from' => MB_DEPARTMENT,
                    'office_to'   => MB_DEPUTY_COMM,
                    'task' => 'Revert to DC',
                    'status' => MB_REVERT,
                    'note_type' => 'Maybe Reject',
                ];

                $insertProceeding = $this->db2->insert('settlement_proceeding', $insPetProceed);

                    if ($insertProceeding != 1) {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRORREVSP001: Insertion failed in settlement_proceeding for case no :' . $case_no);
                        log_message('error', $this->db2->last_query());
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRORREVSP001: Revert Failed . Kindly contact System Administrator',

                        ));
                        return false;
                    }
                    else{
                         $updateProposalData = array(
                                            'dept_status' => DEPT_PROPOSAL_CASE_REVERT,
                                        );

                        $updateProposalRevert = $this->basundharaMb2Perpetualmodel->updateProposalData($case_no, $updateProposalData);

                         if ($updateProposalRevert <= 0) {
                                    $this->db2->trans_rollback();
                                    log_message('error', '#ERRUPDATEREVSPC001: Updation failed in settlement_proposal_cases for final Submission');
                                    log_message('error', $this->db2->last_query());
                                    echo json_encode(array(
                                        'responseType' => 1,
                                        'message' => '#ERRUPDATEREVSPC001: Revert Failed. Kindly contact System Administrator',

                                    ));
                                    return false;
                                }else{
                                    //////////////POST To basundhara/////////////////////
                                    $application_no = $this->basundharaMb2Perpetualmodel->getApplicationNoByCaseNo($this->db2,$case_no)->applid;
                                    $case = $case_no;
                                    $rtpsno = $application_no;
                                    // $rmk = 'Reverted to DC';
                                    $rmk = $revert_remarks;
                                    $status = MB_PAYMENT_REQUEST;
                                    $task = MB_DEPARTMENT;
                                    $pen = MB_DEPUTY_COMM;

                                    $rtps_status = $this->basundharaMb2Perpetualmodel->postApiBasundhara($rtpsno, $case, $rmk, $status, $task, $pen);
                                    $rtps_status = json_decode($rtps_status);
                                    // var_dump($rtps_status);

                                     if (trim($rtps_status) != 'y') {
                                        log_message('error','api_response: rtpsno: '.$rtpsno.'---'.json_encode($rtps_status));
                                        $this->db2->trans_rollback();
                                        echo json_encode(array(
                                            'responseType' => 1,
                                            'message' => '#Revert to DC Failed. Kindly contact System Administrator for the case no.--'.$case,
        
                                        ));
                                        return false;
                                    } else {
                                        $this->db2->trans_commit();
                                            echo json_encode(array(
                                                        'responseType' => 2,
                                                        'message' => 'Case No: ' .$case_no.' Reverted to DC Successfully',
                                                    ));
                                    }

                                }
                    }
                    //////proceeding end//////
            }
            //Change in Dharitree



        }
    }



    public function getAllRevertedCasesListByDept()
    {
        if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) {

            $data['user_dist']      = $this->basundharaMb2Perpetualmodel->getDeptUserDistListWithRevertedCaseCount();

            $dist_code     = trim($this->input->post('selectDistrict'));

            $data['dist_code'] = $dist_code;

            $user_code = $this->session->userdata('user_code');

            $this->form_validation->set_rules('selectDistrict', 'Please Select District Before Proceed', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['cases']      = '';
                $data['casesCount'] = 0;
                $this->session->set_flashdata('message', 'Please Select District Before Proceed.');
                $data['_view'] = 'SettlementView/Dept/AllRevertedCaseListUnderDpt';
                $this->load->view('layouts/main', $data);
            } else {

                $this->db2 =  $this->dbswitch2($dist_code);

                $meeting = $this->basundharaMb2Perpetualmodel->getMeetingListByDist($this->db2,$dist_code);
                $data['meetingList']      = $meeting->result();

                $this->db = $this->load->database('db2', TRUE);

                $cabIdList = $this->basundharaMb2Perpetualmodel->getCabinetIdList($dist_code,$user_code)->result();

                $data['cabIdList'] = $cabIdList;

                $data['_view'] = 'SettlementView/Dept/AllRevertedCaseListUnderDpt';
                $this->load->view('layouts/main', $data);
            }
        } else {
            echo "User Not Authorized to View this Page";
        }
    }


    public function getAllRevertedCasesUnderDept() 
    {

    $json = null;
    $dist_code = $this->input->post('selectDistrict');
    $service_code = $this->input->post('selectService');
    $meeting_no = $this->input->post('selectMeeting');
    $verification = $this->input->post('selectVerify');
    $pullRequest = $this->input->post('selectPullRequest');

    $draw = intval($this->input->post('draw'));

    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');

     $this->db2 =  $this->dbswitch2($dist_code);

    $cases_list = $this->basundharaMb2Perpetualmodel->getAllRevertedCasesUnderDepartmentAll($this->db2,$start, $length, $order,$service_code);

    if(!empty($cases_list)) {

      if($cases_list['total_records'] > 0){

        $data_rows = $cases_list['data_results'];

        foreach($data_rows as $row) {

            $case_no = "<small class='case-no-bg'><i class='fa fa-archive'></i>" . $row->case_no . "</small>";

            $application_no = $this->utilclass->getApplidFromCaseNo($dist_code, $row->case_no);

            $revert_remarks = $this->utilclass->getRevertedRemarksByCaseNo($dist_code, $row->case_no);

            $app_no = "<br><small class='text-danger text-center p-4'>" . $application_no  ."</small>" ;

            // $proposal_name = "<small class='text-black bg-success'>" . $row->proposal_name ."</small>";

            $service = "<small class='text-black bg-yellow'>" . $this->utilclass->getServiceName($row->service_code) ."</small>";
 
            // $meeting_name = "<br><small class='text-danger text-center p-4'> " . $row->meeting_name  ."</small>";

            // $minutelink = base_url() . "index.php/Basundhara/viewMinute/". $dist_code . "/" . $row->meeting_id ;

            // $view_minute = "<br><a target='download' href=".$minutelink." ><i class='fa fa-paperclip'></i> &nbsp;View Minute</a>";

            $submission_date = date('d-M-Y',strtotime($row->submission_date));


            $reverted = "(<span class='text-danger text-center'>Reverted</span>)";
            
          $link = base_url() . "index.php/Basundhara/settlementBasu/?app=".$application_no . "&dist_code=" .$dist_code;
          $view_case = "<a href=".$link." class='btn btn-sm btn-primary' target='_blank'><i class='fa fa-eye'></i> &nbsp;Details</a>";

          $button = $view_case;
          
          $json[] = array(
            $row->case_no,
            $case_no .  $app_no .$reverted,
            '<small>' .$service .'</small>',
            '<small class="text-primary text-center">' .$row->pending_officer .'</small>',
            '<small>'.$revert_remarks .'</small>',
            '<small>'.$submission_date .'</small>',

            $button,
          );
        }
      }
      else {
        $json = "";
      }      
    $total_records = $cases_list['total_records'];
      $response = array(
        'draw'              => $draw,
        'recordsTotal'      => $total_records,
        'recordsFiltered'   => $total_records,
        'data'              => $json
      );
      echo json_encode($response);
    }
    else
    {
      $response = array();
      $response['sEcho']=0;
      $response['iTotalRecords']=0;
      $response['iTotalDisplayRecords']=0;
      $response['aaData']=[];
      echo json_encode($response);
    }
  }


    //Get Reverted Case LIst Report Under Meeting List

    public function downloadRevertedCaseListReport()
    {

        $this->downloadRevertedCaseListReportOnlyRemark();
        exit;
        include 'vendor/mpdf/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'dejavusans',
            'orientation' => 'L',
            'format' => 'A4-L'
        ]);

        $cab_memo_id = $this->input->get('cab_id');

        $htmlTag = '';
        $htmlTag .= '<h3 style="text-align: center; color:red">Annexure -II <br>Report of Reverted Case List : ' . $cab_memo_id . '</u></h3>';

        $table1 = '<table cellpadding="5px" autosize="1" border="1" width="100%" style="overflow: wrap">
            <thead>
            <tr>
                <th >Sl No. </th>
                <th >District </th>
                <th >Case No </th>
                <th >Name of the Applicant with Address. </th>
                <th >Dag No </th>
                <th  >Area </th>
                <th >Circle</th>
                <th >Village</th>
                <th >Type of House</th>
                <th >SDLAC Approval</th>
                <th >Date</th>
                <th >Period & Nature of Possession</th>
                <th >Gender</th>
                <th >Zonal Value</th>
                <th >Landless Affidavit</th>
                <th >Type of House with Photo</th>
                <th >Assembly Recommendation</th>
                <th >Revert Remarks</th>
            </tr>
            </thead>
            <tbody>';

        $this->db = $this->load->database('db2', TRUE);

        $distMeeting = $this->db->query("select  dist_code,meeting_id from cab_memo_list WHERE cab_id=? AND status=? group by dist_code, meeting_id", array($cab_memo_id, CAB_MEMO_DOC_GENERATED))->result();
        

        $table2 = ''; // Initialize an empty string to store the table rows
        $count = 1;
        foreach ($distMeeting as $dist) {

            $this->db2 =  $this->dbswitch2($dist->dist_code);
            log_message('error', 'downloadRevertedReportForCabMemo: 11111 dist: '.$dist->dist_code);

            $meetingCaseReverted = $this->basundharaMb2Perpetualmodel->getRevertedCasesCountByDistMeeting($this->db2,$dist->meeting_id)->result();

            if (!empty($meetingCaseReverted)) {
                foreach ($meetingCaseReverted as $row) {
                    $case_no = $row->case_no;

                    $settlement_basic = $this->basundharaMb2Perpetualmodel->getSettlementBasic($case_no);

                    $applicants   = $this->basundharaMb2Perpetualmodel->getAllApplicantBuyersName($case_no)->result();

                    $appNames = array_map(
                        function ($item) {
                            return $item->pdar_name;
                        },
                        $applicants
                    );

                    $appAddress1 = array_map(
                        function ($item) {
                            return $item->pdar_add1;
                        },
                        $applicants
                    );


                    $dags = $this->basundharaMb2Perpetualmodel->getAllAppliedDags($case_no)->result();

                    $dagNos = array_map(function ($item) {
                        return $item->dag_no;
                    }, $dags);


                    $commaSeparatedDags = implode(",", $dagNos);

                    $commaSeparatedNames = implode(",", $appNames);

                    $commaSeparatedAddress1 = implode(",", $appAddress1);

                    $dagsArea = $this->utilclass->dagAreabyCaseNo($settlement_basic['dist_code'], $case_no);

                    $district_name = $this->utilclass->getDistrictName($settlement_basic['dist_code']);

                    $circle_name = $this->utilclass->getCircleName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code']);

                    $village_name = $this->utilclass->getVillageName($settlement_basic['dist_code'], $settlement_basic['subdiv_code'], $settlement_basic['cir_code'], $settlement_basic['mouza_pargona_code'], $settlement_basic['lot_no'], $settlement_basic['vill_townprt_code']);

                    $sdlacStatus = $this->basundharaMb2Perpetualmodel->sdlacCaseStatus($case_no)->row();

                    $settlement_enc = $this->basundharaMb2Perpetualmodel->getSettlementEncroacher($case_no);


                    $landless = $this->basundharaMb2Perpetualmodel->getLandLessVerify($case_no)->row();

                    $geo_tag = $this->basundharaMb2Perpetualmodel->getGeoTag($case_no);

                    $house_type = $this->utilclass->getHouseTypeByCaseNo($settlement_basic['dist_code'], $case_no);

                    $zonal_value = $this->utilclass->getZonalValueByCaseNo($settlement_basic['dist_code'], $case_no);

                    $reverted_remarks = $this->utilclass->getRevertedRemarksByCaseNo($settlement_basic['dist_code'], $case_no);


                    if (count($geo_tag) > 0) {

                        $geo_tag_yn = 'Yes';
                    } else {

                        $geo_tag_yn = 'No';
                    }


                    foreach ($applicants as $app) {

                        $appGender = $this->utilclass->getGender($app->pdar_gender);
                    }

                    $table2 .= '<tr>
                        <td>' . $count++ . '</td>
                        <td>' . $district_name . '</td>
                        <td style="color:red">' . $case_no . '</td>
                        <td>' . $commaSeparatedNames . ' (Add: ' . $commaSeparatedAddress1 . ')</td>
                        <td style="color:red">' . $commaSeparatedDags . '</td>
                        <td>' . $dagsArea . '</td>
                        <td>' . $circle_name . '</td>
                        <td>' . $village_name . '</td>
                        <td>' . $house_type . '</td>
                        <td>' . $sdlacStatus->case_status . '</td>
                        <td>' . date("j F, Y", strtotime($settlement_basic['sdlac_date'])) . '</td>
                        <td>' . date("j F, Y", strtotime($settlement_enc->period_possession)) . ' (' . ($settlement_basic['occupation_applicant']) .  ')</td>
                        <td>' . $appGender .  '</td>
                        <td style="color:red">' . $zonal_value .  '</td>
                        <td>' . $landless->is_landless .  '</td>
                        <td>' . $geo_tag_yn .  '</td>
                        <td>' . 'RECOMMENDED' .  '</td>
                        <td style="color:red">' . $reverted_remarks .  '</td>    
                    </tr>';
                }
            }
            else
            {
                echo "No Reverted Cases Found Under Cab Memo: " . $cab_memo_id ;
            }
            log_message('error', 'downloadRevertedReportForCabMemo: 22222 dist: '.$dist->dist_code);
        }
        $table3 = '</tbody></table>';
        $table = $table1 . $table2 . $table3;
        $final = $htmlTag . $table;
        $report_name = 'Case_Report_Reverted_List_' . $cab_memo_id . '.pdf';

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->writeHTML($final);
        header('Content-type: application/pdf');
        $mpdf->Output($report_name, 'd');
    }


    public function getTotalNoCasesForFinalApproval()
    {
        $this->db = $this->load->database('db2', TRUE);
        $cabId =  trim($_POST['caninet_id_selected']);
        $cases = $this->db->query("SELECT  case_no FROM cab_memo_list WHERE cab_id =? AND status =? AND final_status =? AND final_submit_status =?", array($cabId, 2,1,0))->num_rows();

        // $cases = $this->db->query("SELECT count(cm.case_no) AS case_count,ci.dept_notification_no AS notification_no FROM cab_memo_list cm JOIN cab_id_list ci ON cm.cab_id = ci.cab_id WHERE cm.cab_id =? AND cm.status =? AND cm.final_status =? AND cm.final_submit_status =?
        // GROUP BY ci.dept_notification_no", array($cabId, 2,1,0))->row();

        echo json_encode($cases);
    }


    


    public function downloadRevertedCaseListReportOnlyRemark()
    {
        ini_set("pcre.backtrack_limit", "500000000");
        ini_set('memory_limit', '4096M');
        set_time_limit(0);
        include 'vendor/mpdf/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'dejavusans',
            'orientation' => 'L',
            'format' => 'A4-L'
        ]);

        $cab_memo_id = $this->input->get('cab_id');

        $htmlTag = '';
        $htmlTag .= '<h3 style="text-align: center; color:red">Annexure -II <br>Report of Reverted Case List : ' . $cab_memo_id . '</u></h3>';

        $table1 = '<table cellpadding="5px" autosize="1" border="1" width="100%" style="overflow: wrap">
            <thead>
            <tr>
                <th >Sl No. </th>
          
                <th >District </th>
                <th >Case No </th>
                <th >Revert Remarks</th>
            </tr>
            </thead>
            <tbody>';

        $this->db = $this->load->database('db2', TRUE);

        $distMeeting = $this->db->query("select DISTINCT dist_code from cab_memo_list WHERE cab_id=? and status =? and vgr_cab =? group by dist_code", array($cab_memo_id,CAB_MEMO_DOC_GENERATED,0))->result();



        $noCasesFound = 1;

        $table2 = ''; 
        $count = 1;
        $main_array = array();
        foreach ($distMeeting as $key => $dist) {
        $cab_id_date = $this->db->query("select  * from cab_id_list WHERE cab_id=? AND status=? and vgr_cab =? and dist_code=?", array($cab_memo_id, CAB_MEMO_DOC_GENERATED, 0,$dist->dist_code))->row();

        $cab_finalized_date = date('Y-m-d',strtotime($cab_id_date->created_at));
        $cab_approve_date = date('Y-m-d',strtotime($cab_id_date->finalized_at));
        $currentCabCreationDate  = $cab_id_date->created_at;

            $this->db2 =  $this->dbswitch2($dist->dist_code);
            
            log_message('error', 'downloadRevertedReportForCabMemoRemark: 11111 dist: '.$dist->dist_code);

            $deptCaseReverted = $this->basundharaMb2Perpetualmodel->getRevertedCasesByDptBeforeCabApproval($this->db2,$cab_finalized_date, $cab_approve_date)->result();

            // $caseListNotUnderCabMemo = $this->basundharaMb2Perpetualmodel->ListOfRevertCasesNotUnderCabMemo($this->db2,$dist->dist_code,$currentCabCreationDate,$cab_id_date->id);

            // $deptCaseReverted = array_merge($deptCaseReverted,$caseListNotUnderCabMemo);
            $deptCaseReverted = array_merge($deptCaseReverted);
            $deptCaseReverted = array_map("unserialize", array_unique(array_map("serialize", $deptCaseReverted)));
            if (!empty($deptCaseReverted)) {

                $noCasesFound = 0; 

                $ct =0;
                log_message('error','----Total case DIST--'.$dist->dist_code.'---- count=='.count($deptCaseReverted));

                foreach ($deptCaseReverted as $row) {

                    $case_no = $row->case_no;
                    if (in_array($case_no, $main_array))
                       continue;
                    
                    if($dist->dist_code == '32'){
                        log_message('error','-----MORIGAON--'.$ct++);
                    }

                    $settlement_basic = $this->basundharaMb2Perpetualmodel->getSettlementBasic($case_no);
                    $district_name = $this->utilclass->getDistrictName($settlement_basic['dist_code']);
                    $main_array[] = $case_no;
                    $reverted_remarks = $this->utilclass->getRevertedRemarksByCaseNo($settlement_basic['dist_code'], $case_no);
                    $table2 .= '<tr>
                        <td width ="5%">' . $count++ . '</td>
                    
                        <td width ="10%">' . $district_name . '</td>
                        <td width ="25%">' . $case_no . '</td>
                        <td width ="50%" style="color:red">' . $reverted_remarks .  '</td>    
                    </tr>';


                }
            }
            else
            {
                $noCasesFound = 1; // Cases were found, so set the flag to false
            }
            log_message('error', 'downloadRevertedReportForCabMemoRemark: 222222 dist: '.$dist->dist_code);
        }

        if ($noCasesFound == 1) {
            echo "No Reverted Cases Found Under Cab Memo: " . $cab_memo_id;
            return;
        }
        $table3 = '</tbody></table>';
        $table = $table1 . $table2 . $table3;
        $final = $htmlTag . $table;

        $report_name = 'Case_Report_Reverted_List_' . $cab_memo_id . '.pdf';

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->writeHTML($final);
        header('Content-type: application/pdf');
        $mpdf->Output($report_name,'d');
    }


    public function getRemarksDetailsRevertedCases()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        
        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');


         if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Check Form Data',
            ));
        }else{

            $dist_code     = $this->input->post('district_id');
            $allSelectedList = $this->input->post('selectedList');

            $caseList = array_map(function($value) {
                return "'" . $value . "'";
            }, $allSelectedList);

            $commaSeparatedCases = implode(',', $caseList);

            $this->db2 =  $this->dbswitch2($dist_code);
            $revertedCases = $this->basundharaMb2Perpetualmodel->getDetailsToBeRevertedCase($this->db2,$commaSeparatedCases);
            echo json_encode($revertedCases);
        }

    }


    ///////////////Bulk Revert Cases from Department To DC////////////////
    public function bulkRevertCasesToDC()
    {
        // var_dump($_POST);exit;
        $this->form_validation->set_rules('service_code_revert[]', 'Service Code', 'trim|required');
        $this->form_validation->set_rules('revert_case_no[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('distict_code_revert', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('reverted_from_js_to_dc', 'JS Remarks', 'trim|required');
        $this->form_validation->set_rules('revert_remarks[]', 'Revert Remarks', 'required');

        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Please Enter Remarks for All Cases',
            ));
        } else 
        {
            $dist_code     = $this->input->post('distict_code_revert');
            $service_code_revert     = $this->input->post('service_code_revert');
            $cases_no_revert = $this->input->post('revert_case_no');
            $input_revert_remarks = $this->input->post('revert_remarks');
            $user_code = $this->session->userdata('user_code');

        
            $casesArray = array_map(function ($a, $b, $c) {
                return $a . '(@)' . $b . '(@)' . $c;
            }, $cases_no_revert, $input_revert_remarks, $service_code_revert);

            //$this->db2 =  $this->dbswitch2($dist_code);

                foreach($casesArray as $row)
                {
                    $case_no = strtok($row, '(@)');
                    $revert_remarks = strtok('(@)');
                    $service_code = strtok('(@)');

                    if($service_code == SETTLEMENT_PGR_VGR_LAND_ID){
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'VGR Cases Can not be Reverted ..Please Unmark All VGR Cases Before Revert !!!.',
                        ));
                        return;
                        exit;
                    }

                    $ilrms_db = $this->load->database('db2', TRUE);
                    $cab_id_from_case_no = $ilrms_db->query("select cab_id,cab_type from deleted_cab_memo_list where case_no=?",array($case_no));
                    if($cab_id_from_case_no->num_rows() > 0){
                        $cab_data = $cab_id_from_case_no->row();

                        $cab_id_generated = $cab_data->cab_id;
                        $cab_type_generated = $cab_data->cab_type;
                    }else{
                        $cab_id_generated = null;
                        $cab_type_generated = null;
                    }
                    

                    $ilrms_db->trans_begin();
                    $insert_revert_cases = [
                        'dist_code'             => $dist_code,
                        'cab_id'                => $cab_id_generated,
                        'case_no'               => $case_no,
                        'status'                => MB_REVERT,
                        'pending_officer'       => MB_DEPUTY_COMM,
                        'pending_office'        => MB_DEPUTY_COMM,
                        'reverted_remarks_js'   => $_POST['reverted_from_js_to_dc'],
                        'remarks'               => $revert_remarks,
                        'cab_type'              => $cab_type_generated,
                        'user_code'             => $user_code,
                        'created_at'            => date('Y-m-d h:i:s'),
                    ];

                    $tstatus3 = $ilrms_db->insert('reverted_cases_from_ilrms', $insert_revert_cases); 
                    if ($tstatus3!= 1)
                    {
                        $ilrms_db->trans_rollback();
                        log_message("error", "#ERRILRMSRI001, Error in insert on reverted_cases_from_ilrms table with query- ". json_encode($ilrms_db->last_query()));
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRILRMSRI001: Cases Not Reverted ! Kindly Contact System Admin.',
                        ));
                    }
                    


                    $this->db2 =  $this->dbswitch2($dist_code);
                    //Update Array for Settlement Basic
                    $updateData[] = [
                        'case_no' => $case_no,
                        'status' => MB_REVERT,
                        'pending_officer' => MB_DEPUTY_COMM,
                        'dept_code' => $user_code,
                        'dept_approval' => DPT_REVERTED,
                        'from_office'     => MB_DEPARTMENT,
                        'pending_office' => MB_DEPUTY_COMM,
                        'dept_revert'     => 1,
                    ];

                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                    if ($proceeding_id == null) {
                        $proceeding_id = 1;
                    }

                    //Insert Array for Settlement Proceedings
                    $insPetProceed[] = [
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'next_date_of_hearing' => date('Y-m-d h:i:s'),
                        'note_on_order' => $revert_remarks,
                        'user_code' => $user_code,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'office_from' => MB_DEPARTMENT,
                        'office_to'   => MB_DEPUTY_COMM,
                        'task' => 'Revert to DC',
                        'status' => MB_REVERT,
                        'note_type' => 'Maybe Reject',
                    ];

                    //Update Array for Settlement Proposal Cases
                    $updateProposalData[] = [
                        'case_no' => $case_no,
                        'dept_status' => DEPT_PROPOSAL_CASE_REVERT,
                         ];

                    $application_no[] = $this->basundharaMb2Perpetualmodel->getApplicationNoByCaseNo($this->db2,$case_no)->applid;
                    $concatenatedAppNo = implode(',', $application_no);
                }

                $this->db2->trans_begin();
                $updateBasicStatus = $this->db2->update_batch('settlement_basic',$updateData,'case_no');

                if($updateBasicStatus<=0 || $this->db2->affected_rows() <= 0)
                {
                $this->db2->trans_rollback();
                $ilrms_db->trans_rollback();
                echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'Error01: Cases Not Reverted ! Kindly Contact System Admin.',
                    ));
                return;
                }else
                {
                        $inserProceding = $this->db2->insert_batch('settlement_proceeding', $insPetProceed);
                        if($inserProceding <= 0 || $this->db2->affected_rows() <= 0)
                        {
                            $this->db2->trans_rollback();
                            $ilrms_db->trans_rollback();
                            echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'Error02: Cases Not Reverted ! Kindly Contact System Admin.',
                                ));
                            return;
                        }else
                        {
                            $updateProposalData = $this->db2->update_batch('settlement_proposal_cases',$updateProposalData,'case_no');

                            if($updateProposalData <= 0 || $this->db2->affected_rows() <= 0)
                            {
                                $this->db2->trans_rollback();
                                $ilrms_db->trans_rollback();
                                echo json_encode(array(
                                        'responseType' => 1,
                                        'message' => 'Error03: Cases Not Reverted ! Kindly Contact System Admin.',
                                    ));
                                return;
                            }else
                            {
                                $rmk    = 'Revert to DC';
                                $status = MB_PAYMENT_REQUEST;
                                $task   = MB_DEPARTMENT;
                                $pen    = MB_DEPUTY_COMM;
                                $rtps_status = $this->basundharaMb2Perpetualmodel->applicationStatusUpdateBulk($concatenatedAppNo,'NA',$rmk,$status,$task,$pen);
                                //$rtps_status ='y';
                                if($rtps_status==null || $rtps_status!="y")
                                    {
                                        $this->db2->trans_rollback();
                                        $ilrms_db->trans_rollback();
                                        log_message('error', '#ERRAPIREVERTDEPT: Issue in API Call for Bulk Revert By Dept' .$this->db2->last_query());
                                        echo json_encode(array(
                                            'responseType' => 3,
                                            'message'      => '#ERRAPIREVERTDEPT: Cases Not Reverted ! Kindly Contact System Admin.  !!!',
                                        ));
                                        return;
                                    }else
                                    {
                                        $ilrms_db->trans_commit();
                                        $this->db2->trans_commit();
                                        echo json_encode(array(
                                            'responseType' => 2,
                                            'message' => 'Cases Reverted  to DC Successfully',

                                        ));
                                    }
                            }
                    }
                }
        }
    }


    ///////Batch Update by Department Approval




    public function bulkApproveCasesByDPT()
    {
        header('content-type:application/json');
        $user_code = $this->session->userdata('user_code');
        $this->form_validation->set_rules('cab_id_selected', 'Cabinet Id', 'trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Enter Order No.',
            ));
        } else
        {
                $cabinet_id = $this->input->post('cab_id_selected');

                $this->db = $this->load->database('db2', TRUE);
                $dist_codes = $this->basundharaMb2Perpetualmodel->getDistrictUnderCabMemo($this->db,$cabinet_id)->result();

                $caseWithDist = $this->basundharaMb2Perpetualmodel->getDistrictCasesUnderCabMemo($this->db,$cabinet_id)->result();

                foreach($caseWithDist as $caseDist)
                {

                $applid[] = $this->utilclass->getApplidFromCaseNo($caseDist->dist_code,$caseDist->case_no);

                }
                $concatenatedAppNo = implode(',', $applid);

                //Modification Request check
                $distMeeting = $this->db->query("select  dist_code,meeting_id from cab_memo_list WHERE cab_id=? AND status=? group by dist_code, meeting_id", array($cabinet_id, CAB_MEMO_DOC_GENERATED))->result();
                $errCheck = 0;
                foreach($distMeeting as $dist)
                {

                    $this->db2 =  $this->dbswitch2($dist->dist_code);

                    $meetingCase = $this->basundharaMb2Perpetualmodel->getCasesCountByDistMeeting($this->db2,$dist->meeting_id);

                    $pullRequestCase = $this->basundharaMb2Perpetualmodel->getCasesHavingPullRequest($this->db2,$dist->meeting_id);

                    $meetingCaseCount = $meetingCase->num_rows();

                    $pullRequestCaseCount = $pullRequestCase->num_rows();


                    if($pullRequestCaseCount > 0)
                    {

                    $errCheck = 1;
                    $pullRequestCasesList =$pullRequestCase->result();

                            

                    $pullRequestCaseNos = array_map(function ($item) {
                                return $item->case_no;
                            }, $pullRequestCasesList);

                        $allPullRequestCases = implode(", ", $pullRequestCaseNos);
            

                        $meetingName = $this->utilclass->getMeetingNameByMeetingId($dist->dist_code, $dist->meeting_id);

                        echo json_encode(array(
                            'responseType' => 3,
                            'message' => "Final Approval of Cases Under :   $cabinet_id  not Submitted as Cases Having Modification Request Under meeting  $meetingName  : ( $allPullRequestCases ) ***(Revert These Cases To DC before Generate Memo)"
                        ));

                    }
                
                }
                //Modification Request check end

                if($errCheck == 0)
                {

                    //update in ILRMS
                    $this->db = $this->load->database('db2', TRUE);

                    $this->db->trans_begin();

                    $updateCabMemoData = [
                        'final_submit_status' => FINAL_SUBMIT_BY_DEPT,
                        'updated_at'       => date('Y-m-d h:i:s'),
                        'approved_at'       => date('Y-m-d h:i:s'),   
                    ];

                    $whereMemo = [
                            'cab_id' => $cabinet_id,
                            'user_code' => $user_code,
                        ];
                    $updateCabMemoStatus = $this->basundharaMb2Perpetualmodel->updateCabMemoList($updateCabMemoData, $whereMemo);

                    if($updateCabMemoStatus<=0 || $this->db->affected_rows() <= 0)
                        {
                        $this->db->trans_rollback();
                            echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'ErrorApp01: Cases Not Approved ! Kindly Contact System Admin.',
                                ));
                            return false;
                        }
        
                    $updateCabIdData = array(
                        'status'    => FINAL_SUBMISSION_CAB_MEMO,
                        'updated_at'       => date('Y-m-d h:i:s'),
                        'approved_at'       => date('Y-m-d h:i:s')                        
                    );

                    $whereCabId = array(
                        'cab_id'    => $cabinet_id,
                        'user_code' => $user_code,

                    );

                    $updateCabIdStatus = $this->basundharaMb2Perpetualmodel->updateCabStatus($this->db,$whereCabId, $updateCabIdData);
                    if($updateCabIdStatus <= 0){
                        $this->db->trans_rollback();
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ErrorApp02: Cases Not Approved ! Kindly Contact System Admin.',
                        ));
                        return false;
                    }
                    else
                    {
                            $rmk    = 'Approved & Forward to CO';
                            $status = MB_PAYMENT_REQUEST;
                            $task   = MB_DEPARTMENT;
                            $pen    = MB_CIRCLE_OFFICER;
                            $rtps_status = $this->basundharaMb2Perpetualmodel->applicationStatusUpdateBulk($concatenatedAppNo,'NA',$rmk,$status,$task,$pen);

                            if($rtps_status==null || $rtps_status!="y")
                            // if($rtps_status=="y")
                            {
                                $this->db->trans_rollback();
                                log_message('error', '#ERRAPIAPPROVEDEPT: Issue in API Call for Bulk Approve By Dept ___ API Status: ' . $rtps_status);
                                echo json_encode(array(
                                    'responseType' => 3,
                                    'message'      => '#ERRAPIAPPROVEDEPT: Cases Not Approved ! Kindly Contact System Admin.  !!!',
                                ));
                                return false;
                            }else   
                            {
                            $this->db->trans_commit();

                                //update in Dharitree
                                foreach($dist_codes as $dist)
                                {
                                    $this->db = $this->load->database('db2', TRUE);
                                    $caseListForFinalSubmitByDist = $this->basundharaMb2Perpetualmodel->getCaseListDetailsForFinalSubmit($this->db,$cabinet_id,$user_code,$dist->dist_code)->result();

                                    if (!empty($caseListForFinalSubmitByDist)) 
                                    {
                                        $this->db2 = $this->dbswitch2($dist->dist_code);

                                        $updateBasicData = array();
                                        $updateProposalData = array();
                                        $insPetProceed = array();
                                        foreach ($caseListForFinalSubmitByDist as $row) 
                                        {
                                            $case_no = $row->case_no;
                                            $final_status = $row->final_status;

                                            // Update in Settlement Basic
                                            if($final_status == TEMP_APPROVE_BY_DEPT)
                                            {
                                                $updateBasicData[] = [
                                                    'case_no' => $case_no,
                                                    'status' => MB_PAYMENT_REQUEST,
                                                    'pending_officer' => MB_CIRCLE_OFFICER,
                                                    'pending_office' => MB_CIRCLE_OFFICER,
                                                    'dept_code' => $user_code,
                                                    'user_code' => $user_code,
                                                    'dept_approval' => DPT_APPROVED,
                                                    'from_office'     => MB_DEPARTMENT,
                                                    'dept_order_no'     => $cabinet_id,
                                                    'dept_order_date'       => date('Y-m-d')                        
                                                    ];

                                                $updateProposalData[] = [
                                                    'case_no' => $case_no,
                                                    'dept_status' =>1
                                                    ];
                                                
                                                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                                                    if ($proceeding_id == null) {
                                                        $proceeding_id = 1;
                                                    }

                                                    //Insert Array for Settlement Proceedings
                                                    $insPetProceed[] = [
                                                            'case_no' => $case_no,
                                                            'proceeding_id' => $proceeding_id,
                                                            'date_of_hearing' => date('Y-m-d h:i:s'),
                                                            'next_date_of_hearing' => date('Y-m-d h:i:s'),
                                                            'note_on_order' => 'Approved by Department & send for Payment Generation',
                                                            'user_code' => $user_code,
                                                            'date_entry' => date('Y-m-d h:i:s'),
                                                            'operation' => 'E',
                                                            'ip' => $_SERVER['REMOTE_ADDR'],
                                                            'office_from' => MB_DEPARTMENT,
                                                            'office_to'   => MB_CIRCLE_OFFICER,
                                                            'task' => 'Forwarded To CO',
                                                            'status' => MB_PAYMENT_REQUEST,
                                                            'note_type' => 'Maybe Approve',
                                                        ];

                                            }

                                                
                                        }   

                                        $this->db2->trans_begin();
                                        $updateBasicStatus = $this->db2->update_batch('settlement_basic',$updateBasicData,'case_no');

                                        if($updateBasicStatus<=0 || $this->db2->affected_rows() <= 0)
                                        {
                                        $this->db2->trans_rollback();
                                            echo json_encode(array(
                                                    'responseType' => 1,
                                                    'message' => 'ErrorAppSB: Cases Not Approved ! Kindly Contact System Admin.',
                                                ));
                                            return;
                                        }else
                                        {
                                            $inserProceding = $this->db2->insert_batch('settlement_proceeding', $insPetProceed);
                                            if($inserProceding <= 0 || $this->db2->affected_rows() <= 0)
                                            {
                                                $this->db2->trans_rollback();
                                                echo json_encode(array(
                                                        'responseType' => 1,
                                                        'message' => 'ErrorAppSP: Cases Not Approved ! Kindly Contact System Admin.',
                                                    ));
                                                return;
                                            }else
                                            {
                                            $updateProposalData = $this->db2->update_batch('settlement_proposal_cases',$updateProposalData,'case_no');

                                                if($updateProposalData <= 0 || $this->db2->affected_rows() <= 0)
                                                {
                                                    $this->db2->trans_rollback();
                                                    echo json_encode(array(
                                                            'responseType' => 1,
                                                            'message' => 'ErrorAppSPC: Cases Not Approved ! Kindly Contact System Admin.',
                                                        ));
                                                    return;
                                                }
                                                else
                                                {
                                                    $this->db2->trans_commit();
                                                    ///Update partial_status in cab_id_list
                                                    $this->db = $this->load->database('db2', TRUE);
                                                    $updateCabPartial = array(
                                                            'is_partial'       => 1,                     
                                                        );

                                                    $whereCabID = array(
                                                        'cab_id'    => $cabinet_id,
                                                        'dist_code'    =>  $dist->dist_code
                                                    );

                                                    $this->db->trans_begin();
                                                    log_message('error',"#ST01--Updating Cab Id List For the district---START--cab-id--".$cabinet_id."---DIST_CODE--".$dist->dist_code);
                                                    $cabIdUpdate = $this->basundharaMb2Perpetualmodel->updateCabStatus($this->db,$whereCabID, $updateCabPartial);
                                                    if($cabIdUpdate <= 0){
                                                        log_message('error',"#update error in table cab_id_list for partial_status---cab-id--".$cabinet_id);
                                                        $this->db->trans_rollback();
                                                        echo json_encode(array(
                                                            'responseType' => 3,
                                                            'message' => '#ERRORCABIDPARTIAL',
                                                        ));
                                                        return false;
                                                    }
                                                    else
                                                    {
                                                        $this->db->trans_commit();
                                                    }
                                                    log_message('error',"#ST01--Updating Cab Id List For the district---END--cab-id--".$cabinet_id."---DIST_CODE--".$dist->dist_code);
                                                    ///Update partial_status in cab_id_list
                                                }
                                            }
                                        }         
                                    }

                                }
                                //update in Dharitree End
                                echo json_encode(array(
                                    'responseType' => 2,
                                    'message' => 'Final Submission of Cases Under Cabinet Memo'.$cabinet_id. ' Successful',
                                ));
                            }
                    }
                }
        }
    }

    ////////////////////////////PGR/VGR////////////////////////

    public function getAllVgrCicleDistWise()
    {
        if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) {

            $data['user_dist']      = $this->basundharaMb2Perpetualmodel->getDeptUserDistListWithCaseCountVGR();

            $dist_code     = trim($this->input->post('selectDistrict'));

            $data['dist_code'] = $dist_code;

            $user_code = $this->session->userdata('user_code');

            $this->form_validation->set_rules('selectDistrict', 'Please Select District Before Proceed', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['cases']      = '';
                $data['casesCount'] = 0;
                $this->session->set_flashdata('message', 'Please Select District Before Proceed.');
                $data['_view'] = 'SettlementView/Dept/AllVGRCasesCircle';
                $this->load->view('layouts/main', $data);
            } else {

                $data['_view'] = 'SettlementView/Dept/AllVGRCasesCircle';
                $this->load->view('layouts/main', $data);
            }
        } else {
            echo "User Not Authorized to View this Page";
        }
    }

    ////Get All VGR Circles By Dist

    //////Get All PGR/VGR Cases By Circle
    public function getAllVGRCirclesByDist() 
    {

        $json = null;
        $dist_code = $this->input->post('selectDistrict');
        $draw = intval($this->input->post('draw'));

        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $this->db2 =  $this->dbswitch2($dist_code);

        $cases_list = $this->basundharaMb2Perpetualmodel->getAllVGRCasesCircleByDist($this->db2,$start, $length, $order);

        if(!empty($cases_list)) {

        if($cases_list['total_records'] > 0){

            $data_rows = $cases_list['data_results'];

            foreach($data_rows as $row) {

            $circle = "<strong class='case-no-bg'>" . $this->utilclass->getCircleName($row->dist_code, $row->subdiv_code, $row->cir_code) . "</strong>";

            $subdivision = "<strong class='case-no-bg'>" . $this->utilclass->getSubDivName($row->dist_code, $row->subdiv_code) . "</strong>";

            $link = base_url() . "index.php/Basundhara/getAllVGRCaseListByCircle/?district=".$dist_code . "&subdiv=" .$row->subdiv_code . "&circle=" .$row->cir_code;
            $view_case = "<a href=".$link." class='btn btn-sm btn-primary' target='_blank'><i class='fa fa-eye'></i> &nbsp;All Cases Under Circle</a>";

            $button = $view_case;
            
            $json[] = array(
                $row->cir_code,
                $circle,
                $subdivision,
                $button,
            );
        }
        }
        else {
            $json = "";
        }      
        $total_records = $cases_list['total_records'];
        $response = array(
            'draw'              => $draw,
            'recordsTotal'      => $total_records,
            'recordsFiltered'   => $total_records,
            'data'              => $json
        );
        echo json_encode($response);
        }
        else
        {
        $response = array();
        $response['sEcho']=0;
        $response['iTotalRecords']=0;
        $response['iTotalDisplayRecords']=0;
        $response['aaData']=[];
        echo json_encode($response);
        }
    }



    public function getAllVGRCaseListByCircle()
    {
        if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) {


            $data['user_dist']      = $this->basundharaMb2Perpetualmodel->getDeptUserDistListWithCaseCount();

            $dist_code = trim($this->input->get('district'));
            $subdiv_code = trim($this->input->get('subdiv'));
            $cir_code = trim($this->input->get('circle'));

            $data['dist_code'] = $dist_code;
            $data['subdiv_code'] = $subdiv_code;
            $data['cir_code'] = $cir_code;

            $user_code = $this->session->userdata('user_code');
            $this->db2 =  $this->dbswitch2($dist_code);
            $meeting = $this->basundharaMb2Perpetualmodel->getMeetingListByDistVGR($this->db2,$dist_code);
            $data['meetingList']      = $meeting->result();

            $this->db = $this->load->database('db2', TRUE);
            $ast = ASSISTANT_USERCODE;
            $sec = UNDER_SEC_USERCODE;
            $data['ast_list'] = $this->db->query("SELECT name,user_code,email,designation FROM depart_users WHERE designation in ('$ast','$sec')",array())->result();
            log_message('error','--'.$this->db->last_query());
            $cabIdListVGR = $this->basundharaMb2Perpetualmodel->getVGRCabinetIdList($dist_code,$user_code)->result();

            $data['cabIdListVGR'] = $cabIdListVGR;

            $data['_view'] = 'SettlementView/Dept/AllVGRCaseListUnderDpt';
            $this->load->view('layouts/main', $data);
        } else {
            echo "User Not Authorized to View this Page";
        }
    }
    //////Get All PGR/VGR Cases By Circle
    public function getAllVGRCasesByCircle() 
    {

        $json = null;
        $dist_code = $this->input->post('selectDistrict');
        $subdiv_code = $this->input->post('selectSubdiv');
        $cir_code = $this->input->post('selectCircle');
        // $service_code = $this->input->post('selectService');
        $meeting_no = $this->input->post('selectMeeting');
        $verification = $this->input->post('selectVerify');
        $pullRequest = $this->input->post('selectPullRequest');

        $draw = intval($this->input->post('draw'));

        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $this->db2 =  $this->dbswitch2($dist_code);

        $cases_list = $this->basundharaMb2Perpetualmodel->getAllVGRCasesByCircle($this->db2,$start, $length, $order,$subdiv_code,$cir_code,$meeting_no,$verification,$pullRequest);

        if(!empty($cases_list)) {

        if($cases_list['total_records'] > 0){

            $data_rows = $cases_list['data_results'];

            foreach($data_rows as $row) {

                $case_no = "<strong class='case-no-bg'><i class='fa fa-archive'></i>" . $row->case_no . "</strong>";

                $application_no = $this->utilclass->getApplidFromCaseNo($dist_code, $row->case_no);

                $app_no = "<br><small class='text-danger text-center p-4'>" . $application_no  ."</small>" ;

                $proposal_name = "<small class='text-black'  style='background-color: #c5d86d;'>" . $row->proposal_name ."</small>";

                // $service = "<small class='text-black bg-yellow'>" . $this->utilclass->getServiceName($row->service_code) ."</small>";
    
                $meeting_name = "<br><small class='text-danger text-center p-4'> " . $row->meeting_name  ."</small>";

                $minutelink = base_url() . "index.php/Basundhara/viewMinute/". $dist_code . "/" . $row->meeting_id ;

                $view_minute = "<br><a target='download' href=".$minutelink." ><i class='fa fa-paperclip'></i> &nbsp;View Minute</a>";

                $created_at = date('d-M-Y',strtotime($row->created_at));
                $verification = $row->verified_by_asst;

                $pullRequest = $row->pull_request;
                $VGRRevert = $row->dept_vgr_revert;




                if($verification == VERIFICATION_PENDING){
                $verify = "<small class='text-warning'><i class='fa fa-clock-o' aria-hidden='true'></i>Pending</small>";
                }else if($verification == SENT_FORVERIFICATION){
                $verify = "<small class='text-primary'>Sent for Verification</small>";
                }else if($verification == VERIFIED_BY_ASSISTANT){
                $verify = "<small class='text-success'><i class='fa fa-check-circle' aria-hidden='true'></i>Verified</small><p>Remarks : ".$row->verified_ast_remarks."</p>";
                }else if($verification == SENT_FOR_REVERIFICATION){
                $verify = "<small class='text-warning'>Sent to Reverify</small>";
                }


                if($pullRequest == 1){
                $pullRequestStatus = "<small class='text-danger'>Modification Required</small>";
                }else{

                $pullRequestStatus = "<small class='text-success'></small>";

                }

                if($VGRRevert == 1){
                $VGRRevertStatus = "<small class='bg-danger'> Reverted by DPT</small>";
                }else{
                $VGRRevertStatus = "<small class=''></small>";
                }

            $link = base_url() . "index.php/Basundhara/settlementBasu/?app=".$application_no . "&dist_code=" .$dist_code;
            $view_case = "<a href=".$link." class='btn btn-sm btn-primary' target='_blank'><i class='fa fa-eye'></i> &nbsp;Details</a>";

            $button = $view_case;
            
            $json[] = array(
                $row->case_no . '@' . $row->meeting_id . '@' . $row->proposal_id,
                $case_no  .$VGRRevertStatus . $app_no ,
                $proposal_name . $meeting_name . $view_minute,
                '<small>'.$created_at .'</small>',
                $verify,
                $pullRequestStatus,
                $button,
            );
        }
        }
        else {
            $json = "";
        }      
        $total_records = $cases_list['total_records'];
        $response = array(
            'draw'              => $draw,
            'recordsTotal'      => $total_records,
            'recordsFiltered'   => $total_records,
            'data'              => $json
        );
        echo json_encode($response);
        }
        else
        {
        $response = array();
        $response['sEcho']=0;
        $response['iTotalRecords']=0;
        $response['iTotalDisplayRecords']=0;
        $response['aaData']=[];
        echo json_encode($response);
        }
    }



    public function addVGRCasesToCabMemo_old()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('cabinet_id', 'Cabinet ID', 'required');


        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Check Form Data',
            ));
        } else {
            $dist_code     = $this->input->post('district_id');
            $cabmemo_id     = $this->input->post('cabinet_id');
            $allSelectedList = $this->input->post('selectedList');

            $errCheck = 0;

            foreach ($allSelectedList as $item) {

                $splitResult = explode("@", $item);

                $newArray[] = $splitResult[0];
                
                }

                $allSelectedCases = implode(", ", $newArray);

                $splitStrings = explode(', ', $allSelectedCases);

                if (!empty($splitStrings)) {
                    $casesList = "'" . implode("', '", $splitStrings) . "'";
                }


                $this->db2 =  $this->dbswitch2($dist_code);

                //Check if Cases Exist in VGR Revert 
                $concatedCasesNo = "'" . implode("', '", $newArray) . "'";
                $vgrRevertedCases = $this->basundharaMb2Perpetualmodel->getRevertedCasesDetailsVGR($this->db2,$concatedCasesNo);
                $vgrRevertedCaseCount = $vgrRevertedCases->num_rows();

                if($vgrRevertedCaseCount > 0)
                {
                    $errCheck = 1;
                    $vgrRevertedCaseList =$vgrRevertedCases->result();

                        $vgrRevertedCaseNos = array_map(function ($item) {
                                return $item->case_no;
                            }, $vgrRevertedCaseList);

                        $allVgrRevertedCases = implode(", ", $vgrRevertedCaseNos);

                            echo json_encode(array(
                            'responseType' => 3,
                            'message' => 'Can not Add Cases to CAB MEMO as Cases : (' . $allVgrRevertedCases . ') are Already Reverted *****',
                        ));
                    return;
                }
                //Check if Cases Exist in VGR Revert 

                //Chitha Area Validation Start

                if(CHITHA_AREA_VALIDATION == 1)
                {
                    $errorArray = array();
                    foreach($newArray as $case)
                    {
                        $checkArea = $this->basundharaMb2Perpetualmodel->chithaReserveAreaCheckWithCaseNo($this->db2,$case); 
                
                        if($checkArea != 0)
                            {
                            $errorArray[] = $case;
                            continue;
                            }      
                    }

                    if(count($errorArray) > 0)
                    {
                        $errCheck = 1;

                        $case_str  = '';           
                        foreach ($errorArray as $err)
                        {
                            $case_str = $case_str.$err.',';
                        }           

                        $errorShow = '';
                        if($case_str != NULL)
                        {
                            $errorShow = ' Total Area Recommended for Settlement can’t exceed available Area in Chitha for
                                            (Case No. -  '.$case_str .')';
                        }                
                    
                        echo json_encode(array(
                            'responseType' => 3,
                            'message'      => '******** Unable to Add Cases to  CAB MEMO ******* .'.$errorShow.' !!!',
                        ));
                        return;
                    }
                }
                //Chitha Area Validation End

                //////////////VGR NEW CHITHA_AREA VALIDATION START////////////////

                    $vgrReservationCases = $this->basundharaMb2Perpetualmodel->getSettlementVgrReservationDetails($this->db2,$concatedCasesNo);
                    $vgrReservationCasesList  = $vgrReservationCases->result_array();

                    $caseHavingReservation = array_column($vgrReservationCasesList, 'case_no');

                    $caseNotHavingReservation = array_diff($newArray, $caseHavingReservation);

                    if(!empty($caseNotHavingReservation))
                    {
                        $errorCases = "'" . implode("', '", $caseNotHavingReservation) . "'";

                        $messageText = "<strong class='text-danger'>VGR Reservation Not Found. !</strong></br>
                                                    <span> *** Reserve Area Not Found for these cases ***</span></br><hr>
                                                    <small class='text-danger'>( $errorCases )</small>";
                        echo json_encode(array(
                            'responseType' => 3,
                            'message' => $messageText,
                        ));
                        return false;
                    }
                    else
                    {
                        $errorArray = array();
                        foreach($vgrReservationCasesList as $vgrReservation)
                        {
                            $reserveCase = $vgrReservation['case_no'];
                            
                            $checkReserv = $this->basundharaMb2Perpetualmodel->getTotalVgrReservationInDag($this->db2,$vgrReservation['dist_code'], $vgrReservation['subdiv_code'], $vgrReservation['cir_code'], $vgrReservation['mouza_pargona_code'], $vgrReservation['lot_no'], $vgrReservation['vill_townprt_code'], $vgrReservation['dag_no']);

                            if($checkReserv['responseType'] != 2)
                            {
                                $errorArray[] = $reserveCase;
                                continue;
                            }
                        }
                        if(count($errorArray) > 0)
                        {
                            $errCheck = 1;

                            $case_str  = '';           
                            foreach ($errorArray as $err)
                            {
                                $case_str = $case_str.$err.',';
                            }           

                            $errorShow = '';
                            if($case_str != NULL)
                            {
                                $errorShow = 'Chitha Area exceed for Reservation
                                                (Case No. -  '.$case_str .')';
                            }                
                        
                            echo json_encode(array(
                                'responseType' => 3,
                                'message'      => '******** Unable to Add Cases to  CAB MEMO ******* .'.$errorShow.' !!!',
                            ));
                            return false;
                        }
                    }

                   


                //////////////VGR NEW CHITHA_AREA VALIDATION END////////////////


                //VGR Cluster Validation
                if(VGR_CLUSTER_VALIDATION == 1)
                    {
                        $CheckClusterStatus = array();
                        foreach($newArray as $case)
                        {
                            $case_no = trim($case);
                            $CheckClusterCount = $this->basundharaMb2Perpetualmodel->checkIfCaseRevertedFromCluster($this->db2,$case_no); 
                        
                            if(trim($CheckClusterCount['clusterStatus']) != 1)
                                {
                                    $CheckClusterStatus[] = $case_no;
                                    continue;
                                }
                        }  
                        if(count($CheckClusterStatus) > 0)
                        {
                            $errCheck = 1;

                            $case_str  = '';           
                            foreach ($CheckClusterStatus as $err)
                            {
                                $case_str = $case_str.$err.',';
                            }           

                            $vgrErrorShow = '';
                            if($case_str != NULL)
                            {
                                $vgrErrorShow = 'VGR Cluster Validation Exist for
                                                (Case No. -  '.$case_str .')';
                            }                
                        
                            echo json_encode(array(
                                'responseType' => 3,
                                'message'      => '******** Unable to Add Cases to  CAB MEMO as Some cases in this cluster are Reverted back and still processing!!!******* .'.$vgrErrorShow.' !!!',
                            ));
                            return;
                        }
                    }
                // VGR Cluster Validation  End

                //Check for Modification Request Status

                $pullRequestCase = $this->basundharaMb2Perpetualmodel->getPullRequestStatus($this->db2,$casesList);
                $pullRequestCaseCount = $pullRequestCase->num_rows();

                if($pullRequestCaseCount > 0)
                {

                $errCheck = 1;
                $pullRequestCasesList =$pullRequestCase->result();

                    $pullRequestCaseNos = array_map(function ($item) {
                            return $item->case_no;
                        }, $pullRequestCasesList);

                    $allPullRequestCases = implode(", ", $pullRequestCaseNos);

                     echo json_encode(array(
                        'responseType' => 3,
                        'message' => 'Failed to Add Cases to Cabinet Memo as Cases Trying to Add Have Modification Request for Case No (' . $allPullRequestCases . ') (***Revert These Cases To DC before Generate Memo)',
                    ));

                }

                //Modification Request Check End

                if($errCheck == 0)
                {

                $user_code = $this->session->userdata('user_code');
                $this->db = $this->load->database('db2', TRUE);
                $memo_name = $this->basundharaMb2Perpetualmodel->getMemoNameByCabId($this->db,$cabmemo_id);
        
                if ($cabmemo_id == NULL) {
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'CAB ID Not Found for ' .$this->utilclass->getDistrictNameOnLanding($dist_code). ' District Please Create CAB ID before Adding Cases to Cabinet Memo',

                    ));
                } else {

                if (!empty($allSelectedList)) {

                    foreach ($allSelectedList as $row) {

                        $parts = explode("@", $row);
                        list($case_no, $meeting_id,$proposal_no) = $parts;
    
                        $this->db->trans_begin();

                        //Insert in CAB Memo  List
                        $insCabStack = [
                            'cab_id' => $cabmemo_id,
                            'case_no' => $case_no,
                            'user_code' => $user_code,
                            'dist_code' => $dist_code,
                            'status' => ADD_CASES_TO_CAB_MEMO,
                            'created_at' => date('Y-m-d h:i:s'),
                            'meeting_id' => $meeting_id,
                            'proposal_id' => $proposal_no,
                            'vgr_cab' => 1,
                        ];

                        $insertCabList = $this->db->insert('cab_memo_list', $insCabStack);

                        if ($insertCabList != TRUE) {
                            $this->db->trans_rollback();
                            log_message('error', '#ERRDUPDATECSL001: Updation failed in cab_memo_list');
                            log_message('error', $this->db->last_query());

                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'Failed to Add Cases to Cabinet Memo',

                            ));
                            return false;
                        } else {

                            $updateData = array(
                                'status' => ADD_CASES_UNDER_CAB_ID,
                                'finalized_at' => date('Y-m-d H:i:s'),
                            );

                            $where = array(
                                'cab_id' => $cabmemo_id,
                                'user_code' => $user_code,
                                // 'dist_code' => $dist_code,
                            );

                            $updateCabIdList = $this->basundharaMb2Perpetualmodel->updateCabStatus($this->db,$where, $updateData);
                            if ($updateCabIdList <= 0) {
                                $this->db->trans_rollback();
                                log_message('error', '#ERRDUPDATE0001: Updation failed in cab_id_list for bulk Approve');
                                log_message('error', $this->db->last_query());

                                echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'Failed to Add Cases to Cabinet Memo',

                                ));
                                return false;
                            } else {
                                $this->db->trans_commit();

                                //change status in Settlement basic
                                $this->db2 =  $this->dbswitch2($dist_code);

                                $this->db2->trans_begin();

                                $updateData = array(
                                    'cab_memo_prepared' => SB_ADD_CASES_TOCAB_MEMO,
                                );

                                $updateBasicStatus = $this->basundharaMb2Perpetualmodel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData);


                                if($updateBasicStatus <= 0){
                                $this->db2->trans_rollback();
                                log_message('error', '#ERRDUPDATBASICCAB: Updation failed in settlement_basic for change cabinet status');
                                log_message('error', $this->db2->last_query());

                                echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'Failed to Add Cases to Cabinet Memo',

                                ));
                                return false;

                                }else{

                                $this->db2->trans_commit();

                                }

                                //change sttatus in basic
                            }
                        }
                    }
                    echo json_encode(array(
                        'responseType' => 2,
                        'message' => 'PGR/VGR Cases Successfully Added to Cabinet Memo ' .$memo_name .'('. $cabmemo_id . ') for District ' . $this->utilclass->getDistrictNameOnLanding($dist_code),

                    ));
                }
            }

                }
                

        }
    }



    public function downloadRevertedCaseListReportVGR()
    {
        ini_set("pcre.backtrack_limit", "500000000");
        ini_set('memory_limit', '4096M');
        set_time_limit(0);
        include 'vendor/mpdf/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            'default_font' => 'dejavusans',
            'orientation' => 'L',
            'format' => 'A4-L'
        ]);

        $cab_memo_id = $this->input->get('cab_id');

        $htmlTag = '';
        $htmlTag .= '<h3 style="text-align: center; color:red">Annexure -II <br>Report of Reverted Case List : ' . $cab_memo_id . '</u></h3>';

        $table1 = '<table cellpadding="5px" autosize="1" border="1" width="100%" style="overflow: wrap">
            <thead>
            <tr>
                <th >Sl No. </th>
                <th >District </th>
                <th >Case No </th>
                <th >Revert Remarks</th>
            </tr>
            </thead>
            <tbody>';

        $this->db = $this->load->database('db2', TRUE);

        $distMeeting = $this->db->query("select DISTINCT dist_code from cab_memo_list WHERE cab_id=? and status =? and vgr_cab =? group by dist_code", array($cab_memo_id,CAB_MEMO_DOC_GENERATED,1))->result();

        $noCasesFound = 1;

        $table2 = ''; 
        $count = 1;
        $main_array = array();
        foreach ($distMeeting as $key => $dist) {
        $cab_id_date = $this->db->query("select  * from cab_id_list WHERE cab_id=? AND status=? and vgr_cab =? and dist_code=?", array($cab_memo_id, CAB_MEMO_DOC_GENERATED,1, $dist->dist_code))->row();

        $cab_finalized_date = date('Y-m-d',strtotime($cab_id_date->created_at));
        $cab_approve_date = date('Y-m-d',strtotime($cab_id_date->finalized_at));
        $previousCabApprovedDate  = $cab_id_date->updated_at;

            $this->db2 =  $this->dbswitch2($dist->dist_code);
            
            log_message('error', 'downloadRevertedReportForCabMemoRemark: 11111 dist: '.$dist->dist_code);

            $deptCaseReverted = $this->basundharaMb2Perpetualmodel->getVGRRevertedCasesByDptBeforeCabApproval($this->db2,$cab_finalized_date, $cab_approve_date)->result();

            // $caseListNotUnderCabMemo = $this->basundharaMb2Perpetualmodel->ListOfVGRRevertCasesNotUnderCabMemo($this->db2,$dist->dist_code,$previousCabApprovedDate,$cab_id_date->id);

            // $deptCaseReverted = array_merge($deptCaseReverted,$caseListNotUnderCabMemo);
            $deptCaseReverted = array_map("unserialize", array_unique(array_map("serialize", $deptCaseReverted)));
            if (!empty($deptCaseReverted)) {

                $noCasesFound = 0; 

                $ct =0;
                log_message('error','----Total case DIST--'.$dist->dist_code.'---- count=='.count($deptCaseReverted));

                foreach ($deptCaseReverted as $row) {

                    $case_no = $row->case_no;
                    if (in_array($case_no, $main_array))
                       continue;

                    $settlement_basic = $this->basundharaMb2Perpetualmodel->getSettlementBasic($case_no);
                    $district_name = $this->utilclass->getDistrictName($settlement_basic['dist_code']);
                    $main_array[] = $case_no;
                    $reverted_remarks = $this->utilclass->getVGRRevertedRemarksByCaseNo($settlement_basic['dist_code'], $case_no);
                    $table2 .= '<tr>
                        <td width ="5%">' . $count++ . '</td>
                        <td width ="10%">' . $district_name . '</td>
                        <td width ="25%">' . $case_no . '</td>
                        <td width ="50%" style="color:red">' . $reverted_remarks .  '</td>    
                    </tr>';


                }
            }
            else
            {
                $noCasesFound = 1; // Cases were found, so set the flag to false
            }
            log_message('error', 'downloadRevertedReportForCabMemoRemark: 222222 dist: '.$dist->dist_code);
        }

        if ($noCasesFound == 1) {
            echo "No Reverted VGR Cases Found Under Cab Memo: " . $cab_memo_id;
            return;
        }
        $table3 = '</tbody></table>';
        $table = $table1 . $table2 . $table3;
        $final = $htmlTag . $table;

        $report_name = 'Case_Report_Reverted_List_' . $cab_memo_id . '.pdf';

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->writeHTML($final);
        header('Content-type: application/pdf');
        $mpdf->Output($report_name,'d');
    }

    public function casesListForFinalApprovalByDeptVGR()
    {
        $cab_id = $this->input->get('cab_id');
        // $dist_code   = $this->session->userdata('dist_code');
        $user_code   = $this->session->userdata('user_code');
        $this->db = $this->load->database('db2', TRUE);
        $cases_list = $this->basundharaMb2Perpetualmodel->getAllVGRCasesFromMemoForFinalApproval($this->db,$cab_id,$user_code);

        $digitalSignedStatus = $this->basundharaMb2Perpetualmodel->digitalSignedStatusOfCabId($this->db,$cab_id);

        $data['cab_id']         = $cab_id;
        $data['finalCases']         = $cases_list->result();
        $data['finalCaseCount'] = $cases_list->num_rows();
        $data['digitalSignedStatus'] = $digitalSignedStatus->notification_digital_sign_status;
        $data['_view'] = 'SettlementView/Dept/VGRCaseListForFinalApproval';
        $this->load->view('layouts/main', $data);

    }


    public function getAllRevertedCasesListByDeptVGR()
    {
        if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) {

            $data['user_dist']      = $this->basundharaMb2Perpetualmodel->getDeptUserDistListWithRevertedCaseCountVGR();

            $dist_code     = trim($this->input->post('selectDistrict'));

            $data['dist_code'] = $dist_code;

            $user_code = $this->session->userdata('user_code');

            $this->form_validation->set_rules('selectDistrict', 'Please Select District Before Proceed', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['cases']      = '';
                $data['casesCount'] = 0;
                $this->session->set_flashdata('message', 'Please Select District Before Proceed.');
                $data['_view'] = 'SettlementView/Dept/AllRevertedCaseListUnderDptVGR';
                $this->load->view('layouts/main', $data);
            } else {

                $this->db2 =  $this->dbswitch2($dist_code);

                $meeting = $this->basundharaMb2Perpetualmodel->getMeetingListByDistVGR($this->db2,$dist_code);
                $data['meetingList']      = $meeting->result();

                $this->db = $this->load->database('db2', TRUE);

                $cabIdList = $this->basundharaMb2Perpetualmodel->getCabinetIdList($dist_code,$user_code)->result();

                $data['cabIdList'] = $cabIdList;

                $data['_view'] = 'SettlementView/Dept/AllRevertedCaseListUnderDptVGR';
                $this->load->view('layouts/main', $data);
            }
        } else {
            echo "User Not Authorized to View this Page";
        }
    }


    public function getAllRevertedCasesUnderDeptVGR() 
    {
        $json = null;
        $dist_code = $this->input->post('selectDistrict');
        $service_code = $this->input->post('selectService');
        $meeting_no = $this->input->post('selectMeeting');
        $verification = $this->input->post('selectVerify');
        $pullRequest = $this->input->post('selectPullRequest');

        $draw = intval($this->input->post('draw'));

        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $this->db2 =  $this->dbswitch2($dist_code);

        $cases_list = $this->basundharaMb2Perpetualmodel->getAllRevertedCasesUnderDepartmentVGR($this->db2,$start, $length, $order,$service_code);

        if(!empty($cases_list)) {

        if($cases_list['total_records'] > 0){

            $data_rows = $cases_list['data_results'];

            foreach($data_rows as $row) {

                $case_no = "<small class='case-no-bg'><i class='fa fa-archive'></i>" . $row->case_no . "</small>";

                $application_no = $this->utilclass->getApplidFromCaseNo($dist_code, $row->case_no);

                $revert_remarks = $this->utilclass->getVGRRevertedRemarksByCaseNo($dist_code, $row->case_no);

                $app_no = "<br><small class='text-danger text-center p-4'>" . $application_no  ."</small>" ;

               
                $submission_date = date('d-M-Y',strtotime($row->submission_date));

                $reverted = "(<span class='text-danger text-center'>Reverted</span>)";
                
            $link = base_url() . "index.php/Basundhara/settlementBasu/?app=".$application_no . "&dist_code=" .$dist_code;
            $view_case = "<a href=".$link." class='btn btn-sm btn-primary' target='_blank'><i class='fa fa-eye'></i> &nbsp;Details</a>";

            $button = $view_case;
            
            $json[] = array(
                $row->case_no,
                $case_no .  $app_no .$reverted,
                // '<small class="text-primary text-center">' .$row->pending_officer .'</small>',
                '<small>'.$revert_remarks .'</small>',
                '<small>'.$submission_date .'</small>',

                $button,
            );
            }
        }
        else {
            $json = "";
        }      
        $total_records = $cases_list['total_records'];
        $response = array(
            'draw'              => $draw,
            'recordsTotal'      => $total_records,
            'recordsFiltered'   => $total_records,
            'data'              => $json
        );
        echo json_encode($response);
        }
        else
        {
        $response = array();
        $response['sEcho']=0;
        $response['iTotalRecords']=0;
        $response['iTotalDisplayRecords']=0;
        $response['aaData']=[];
        echo json_encode($response);
        }
  }



    ///////FInal Approve VGR Cases by Dept
    public function bulkApproveCasesVGR()
    {
        header('content-type:application/json');
        $user_code = $this->session->userdata('user_code');
        $this->form_validation->set_rules('cab_id_selected', 'Cabinet Id', 'trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Not Getting Cab Id .',
            ));
        } else
        {
                $cabinet_id = $this->input->post('cab_id_selected');

                $this->db = $this->load->database('db2', TRUE);
                $dist_codes = $this->basundharaMb2Perpetualmodel->getDistrictUnderCabMemo($this->db,$cabinet_id)->result();

                $caseWithDist = $this->basundharaMb2Perpetualmodel->getDistrictCasesUnderCabMemo($this->db,$cabinet_id)->result();


                //VGR Cluster Check
                if(VGR_CLUSTER_VALIDATION == 1)
                {
                    $CheckClusterStatus = array();
                    foreach($caseWithDist as $caseDist)
                    {
                        $vgr_case_no = trim($caseDist->case_no);
                        $vgr_dist_code = trim($caseDist->dist_code);

                        $this->db2 =  $this->dbswitch2($vgr_dist_code);

                        $CheckClusterCount = $this->basundharaMb2Perpetualmodel->checkIfCaseRevertedFromCluster($this->db2,$vgr_case_no); 

                        if(trim($CheckClusterCount['clusterStatus']) != 1)
                            {
                                $CheckClusterStatus[] = $vgr_case_no;
                                continue;
                            }
                    }
                    if(count($CheckClusterStatus) > 0)
                    {
                        $errCheck = 1;

                        $case_str  = '';           
                        foreach ($CheckClusterStatus as $err)
                        {
                            $case_str = $case_str.$err.',';
                        }           

                        $vgrErrorShow = '';
                        if($case_str != NULL)
                        {
                            $vgrErrorShow = 'VGR Cluster Validation Exist for
                                            (Case No. -  '.$case_str .')';
                        }                
                    
                        echo json_encode(array(
                            'responseType' => 3,
                            'message'      => '******** Unable to Approve VGR Cases as Some cases in this cluster are Reverted back and still processing!!!******* .'.$vgrErrorShow.' !!!',
                        ));
                        return;
                    }
                } 
                //VGR Cluster Check End

                foreach($caseWithDist as $caseDist)
                {
                    $applid[] = $this->utilclass->getApplidFromCaseNo($caseDist->dist_code,$caseDist->case_no);

                }
                $concatenatedAppNo = implode(',', $applid);

                $distMeeting = $this->db->query("select  dist_code,meeting_id from cab_memo_list WHERE cab_id=? AND status=? group by dist_code, meeting_id", array($cabinet_id, CAB_MEMO_DOC_GENERATED))->result();

                //Modification Request & Meeting Pending Case check
                $errCheck = 0;
                foreach($distMeeting as $dist)
                {
                    $this->db2 =  $this->dbswitch2($dist->dist_code);

                    $meetingCase = $this->basundharaMb2Perpetualmodel->getCasesCountByDistMeeting($this->db2,$dist->meeting_id);

                    $vgrMeetingRevertStatus = $meetingCase->row()->vgr_pgr_revert_status;

                    $meetingName = $this->utilclass->getMeetingNameByMeetingId($dist->dist_code, $dist->meeting_id);

                    $pullRequestCase = $this->basundharaMb2Perpetualmodel->getCasesHavingPullRequest($this->db2,$dist->meeting_id);

                    $meetingCaseCount = $meetingCase->num_rows();

                    $pullRequestCaseCount = $pullRequestCase->num_rows();

                    //Check for meeting cases exist in settlement_vgr_pgr_revert_cases with status 1
                    $meetingCaseRevert = $this->basundharaMb2Perpetualmodel->getMeetingCasesExistInVgrRevert($this->db2,$dist->meeting_id);
                    $vgrRevertedCases = $meetingCaseRevert->num_rows();

                    if($pullRequestCaseCount > 0)
                    {
                        $errCheck = 1;
                        $pullRequestCasesList =$pullRequestCase->result();
                        $pullRequestCaseNos = array_map(function ($item) {
                            return $item->case_no;
                        }, $pullRequestCasesList);

                        $allPullRequestCases = implode(", ", $pullRequestCaseNos);

                        echo json_encode(array(
                            'responseType' => 3,
                            'message' => "Final Approval of Cases Under :   $cabinet_id  not Submitted as Cases Having Modification Request Under meeting  $meetingName  : ( $allPullRequestCases ) ***(Revert These Cases To DC before Generate Memo)"
                        ));
                    }
                    else if(intval($vgrMeetingRevertStatus) == 1)
                    {
                        $errCheck = 1;
                        echo json_encode(array(
                            'responseType' => 3,
                            'message' => "Final Approval of Cases Under :   $cabinet_id  not Submitted as Some Cases are Reverted back from Meeting:  $meetingName "
                        )); 
                        return;
                    }
                    else if($vgrRevertedCases > 0)
                    {
                        $errCheck = 1;
                        $meetingRevertedCasesList =$meetingCaseRevert->result();
                        $meetingRevertedCaseNos = array_map(function ($item) {
                            return $item->case_no;
                        }, $meetingRevertedCasesList);

                        $allMeetingRevertedCases = implode(", ", $meetingRevertedCaseNos);

                        echo json_encode(array(
                            'responseType' => 3,
                            'message' => "Final Approval of Cases Under :   $cabinet_id  not Submitted as VGR Reverted Cases Exist Under Meeting: $meetingName : Reverted Cases: $allMeetingRevertedCases"
                        )); 
                        return;
                    }
                    else
                    {
                        $memoCase = $this->basundharaMb2Perpetualmodel->getCasesCountFromCabMemo($dist->dist_code,$dist->meeting_id);
                        $memoCaseCount = $memoCase->num_rows();
                        $meetingCaseCount = $meetingCase->num_rows();

                        if($memoCaseCount != $meetingCaseCount)
                        {
                            $errCheck = 1;
                            $memoCaseList =$memoCase->result();
                            $meetingCasesList =$meetingCase->result();
                            
                            $memoCaseNos = array_map(function ($item) {
                                    return $item->case_no;
                                }, $memoCaseList);

                            $meetingCaseNos = array_map(function ($item) {
                                    return $item->case_no;
                                }, $meetingCasesList);

                            $pendingCaseNos = array_diff($meetingCaseNos, $memoCaseNos);
                            $allPendingCases = implode(", ", $pendingCaseNos);

                            $casesPending = $allPendingCases;  
                            $meetingName = $this->utilclass->getMeetingNameByMeetingId($dist->dist_code, $dist->meeting_id);
                        
                            echo json_encode(array(
                                'responseType' => 3,
                                'message' => "Final Approval of Cases Under :   $cabinet_id  not Submitted as Cases Pending under meeting  $meetingName  : ( $casesPending ) ***(Revert These Cases To DC before Generate Memo)"
                            ));
                        }
                    }            
                }
                //Modification Request & Meeting Pending Case check end

                if($errCheck == 0)
                {

                    //update in ILRMS
                    $this->db = $this->load->database('db2', TRUE);

                    $this->db->trans_begin();

                    $updateCabMemoData = [
                        'final_submit_status' => FINAL_SUBMIT_BY_DEPT,
                        'updated_at'       => date('Y-m-d h:i:s'),
                        'approved_at'       => date('Y-m-d h:i:s'),   
                    ];

                    $whereMemo = [
                            'cab_id' => $cabinet_id,
                            'user_code' => $user_code,
                        ];
                    $updateCabMemoStatus = $this->basundharaMb2Perpetualmodel->updateCabMemoList($updateCabMemoData, $whereMemo);

                    if($updateCabMemoStatus<=0 || $this->db->affected_rows() <= 0)
                        {
                        $this->db->trans_rollback();
                            echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'ErrorAppVGR01: Cases Not Approved ! Kindly Contact System Admin.',
                                ));
                            return false;
                        }
        
                    $updateCabIdData = array(
                        'status'    => FINAL_SUBMISSION_CAB_MEMO,
                        'updated_at'       => date('Y-m-d h:i:s'),
                        'approved_at'       => date('Y-m-d h:i:s')                        
                    );

                    $whereCabId = array(
                        'cab_id'    => $cabinet_id,
                        'user_code' => $user_code,
                    );

                    $updateCabIdStatus = $this->basundharaMb2Perpetualmodel->updateCabStatus($this->db,$whereCabId, $updateCabIdData);
                    if($updateCabIdStatus <= 0){
                        $this->db->trans_rollback();
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ErrorAppVGR02: Cases Not Approved ! Kindly Contact System Admin.',
                        ));
                        return false;
                    }
                    else
                    {
                            $rmk    = 'Approved & Forward to CO';
                            $status = MB_PAYMENT_REQUEST;
                            $task   = MB_DEPARTMENT;
                            $pen    = MB_CIRCLE_OFFICER;
                            $rtps_status = $this->basundharaMb2Perpetualmodel->applicationStatusUpdateBulk($concatenatedAppNo,'NA',$rmk,$status,$task,$pen);

                            if($rtps_status==null || $rtps_status!="y")
                            // if($rtps_status!="n")
                            {
                                $this->db->trans_rollback();
                                log_message('error', '#ERRAPIAPPROVEDEPTVGR: Issue in API Call for Bulk Approve By Dept ___ API Status: ' . $rtps_status);
                                echo json_encode(array(
                                    'responseType' => 3,
                                    'message'      => '#ERRAPIAPPROVEDEPTVGR: Cases Not Approved ! Kindly Contact System Admin.  !!!',
                                ));
                                return false;
                            }else   
                            {
                            $this->db->trans_commit();

                                //update in Dharitree
                                foreach($dist_codes as $dist)
                                {
                                    $this->db = $this->load->database('db2', TRUE);
                                    $caseListForFinalSubmitByDist = $this->basundharaMb2Perpetualmodel->getCaseListDetailsForFinalSubmit($this->db,$cabinet_id,$user_code,$dist->dist_code)->result();

                                    if (!empty($caseListForFinalSubmitByDist)) 
                                    {
                                        $this->db2 = $this->dbswitch2($dist->dist_code);

                                        $updateBasicData = array();
                                        $updateProposalData = array();
                                        $insPetProceed = array();
                                        // $updateVGRClusterData = array();
                                        foreach ($caseListForFinalSubmitByDist as $row) 
                                        {
                                            $case_no = $row->case_no;
                                            $final_status = $row->final_status;

                                            $clusterId = $this->basundharaMb2Perpetualmodel->getClusterIdByCaseNo($this->db2,$case_no);

                                            // Update in Settlement Basic
                                            if($final_status == TEMP_APPROVE_BY_DEPT)
                                            {
                                                $updateBasicData[] = [
                                                    'case_no' => $case_no,
                                                    'status' => MB_PAYMENT_REQUEST,
                                                    'pending_officer' => MB_CIRCLE_OFFICER,
                                                    'pending_office' => MB_CIRCLE_OFFICER,
                                                    'dept_code' => $user_code,
                                                    'user_code' => $user_code,
                                                    'dept_approval' => DPT_APPROVED,
                                                    'from_office'     => MB_DEPARTMENT,
                                                    'dept_order_no'     => $cabinet_id,
                                                    'dept_order_date'       => date('Y-m-d')
                                                    ];

                                                $updateProposalData[] = [
                                                    'case_no' => $case_no,
                                                    'dept_status' =>1
                                                    ];
                                                
                                                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                                                    if ($proceeding_id == null) {
                                                        $proceeding_id = 1;
                                                    }

                                                    //Insert Array for Settlement Proceedings
                                                    $insPetProceed[] = [
                                                            'case_no' => $case_no,
                                                            'proceeding_id' => $proceeding_id,
                                                            'date_of_hearing' => date('Y-m-d h:i:s'),
                                                            'next_date_of_hearing' => date('Y-m-d h:i:s'),
                                                            'note_on_order' => 'Approved by Department & send for Payment Generation',
                                                            'user_code' => $user_code,
                                                            'date_entry' => date('Y-m-d h:i:s'),
                                                            'operation' => 'E',
                                                            'ip' => $_SERVER['REMOTE_ADDR'],
                                                            'office_from' => MB_DEPARTMENT,
                                                            'office_to'   => MB_CIRCLE_OFFICER,
                                                            'task' => 'Forwarded To CO',
                                                            'status' => MB_PAYMENT_REQUEST,
                                                            'note_type' => 'Maybe Approve',
                                                        ];


                                                    // $updateVGRClusterData[] = [
                                                    //     'cluster_id' => $clusterId,
                                                    //     'status' =>MB_PAYMENT_REQUEST,
                                                    //     'pending_at' =>MB_CIRCLE_OFFICER
                                                    //     ];
                                            }     
                                        }   

                                        $this->db2->trans_begin();
                                        $updateBasicStatus = $this->db2->update_batch('settlement_basic',$updateBasicData,'case_no');

                                        if($updateBasicStatus<=0 || $this->db2->affected_rows() <= 0)
                                        {
                                        $this->db2->trans_rollback();
                                            echo json_encode(array(
                                                    'responseType' => 1,
                                                    'message' => 'ErrorAppSBVGR: Cases Not Approved ! Kindly Contact System Admin.',
                                                ));
                                            return;
                                        }else
                                        {
                                            $inserProceding = $this->db2->insert_batch('settlement_proceeding', $insPetProceed);
                                            if($inserProceding <= 0 || $this->db2->affected_rows() <= 0)
                                            {
                                                $this->db2->trans_rollback();
                                                echo json_encode(array(
                                                        'responseType' => 1,
                                                        'message' => 'ErrorAppSPVGR: Cases Not Approved ! Kindly Contact System Admin.',
                                                    ));
                                                return;
                                            }else
                                            {
                                            $updateProposalData = $this->db2->update_batch('settlement_proposal_cases',$updateProposalData,'case_no');

                                                if($updateProposalData <= 0 || $this->db2->affected_rows() <= 0)
                                                {
                                                    $this->db2->trans_rollback();
                                                    echo json_encode(array(
                                                            'responseType' => 1,
                                                            'message' => 'ErrorAppSPCVGR: Cases Not Approved ! Kindly Contact System Admin.',
                                                        ));
                                                    return;
                                                }
                                                else
                                                {

                                                    // $updateClusterData = $this->db2->update_batch('settlement_circle_cluster',$updateVGRClusterData,'cluster_id');

                                                    // if($updateClusterData <= 0 || $this->db2->affected_rows() <= 0)
                                                    // {
                                                    //     $this->db2->trans_rollback();
                                                    //     echo json_encode(array(
                                                    //             'responseType' => 1,
                                                    //             'message' => 'ErrorAppSCC: Cases Not Approved ! Kindly Contact System Admin.',
                                                    //         ));
                                                    //     return;
                                                    // }

                                                    // else
                                                    // {
                                                        $this->db2->trans_commit();

                                                        ///Update partial_status in cab_id_list
                                                        $this->db = $this->load->database('db2', TRUE);
                                                        $updateCabPartial = array(
                                                                'is_partial'       => 1,                     
                                                            );

                                                        $whereCabID = array(
                                                            'cab_id'    => $cabinet_id,
                                                            'dist_code'    =>  $dist->dist_code
                                                        );

                                                        $this->db->trans_begin();
                                                        log_message('error',"#ST01VGR--Updating Cab Id List For the district---START--cab-id--".$cabinet_id."---DIST_CODE--".$dist->dist_code);
                                                        $cabIdUpdate = $this->basundharaMb2Perpetualmodel->updateCabStatus($this->db,$whereCabID, $updateCabPartial);
                                                        if($cabIdUpdate <= 0){
                                                            log_message('error',"#update error in table cab_id_list for partial_status---cab-id--".$cabinet_id);
                                                            $this->db->trans_rollback();
                                                            echo json_encode(array(
                                                                'responseType' => 3,
                                                                'message' => '#ERRORCABIDPARTIALVGR',
                                                            ));
                                                            return false;
                                                        }
                                                        else
                                                        {
                                                            $this->db->trans_commit();
                                                        }
                                                        log_message('error',"#ST01VGR--Updating Cab Id List For the district---END--cab-id--".$cabinet_id."---DIST_CODE--".$dist->dist_code);
                                                        ///Update partial_status in cab_id_list
                                                    // }
                                                }
                                            }
                                        }         
                                    }

                                }
                                //update in Dharitree End
                                echo json_encode(array(
                                    'responseType' => 2,
                                    'message' => 'Final Submission of Cases Under Cabinet Memo'.$cabinet_id. ' Successful',
                                ));
                            }
                    }
                }
        }
    }



    ///////////////Bulk Revert VGR Cases from Department To DC////////////////
    public function bulkRevertVGRCasesToDC()
    {
        $this->form_validation->set_rules('service_code_revert[]', 'Service Code', 'trim|required');
        $this->form_validation->set_rules('revert_case_no[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('distict_code_revert', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('revert_remarks[]', 'Revert Remarks', 'required');

        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Please Enter Remarks for All Cases',
            ));
            return;
        } else 
        {
            $dist_code     = $this->input->post('distict_code_revert');
            $service_code_revert     = $this->input->post('service_code_revert');
            $cases_no_revert = $this->input->post('revert_case_no');
            $input_revert_remarks = $this->input->post('revert_remarks');
            $user_code = $this->session->userdata('user_code');

            $this->db2 =  $this->dbswitch2($dist_code);

            $concatedCasesNo = "'" . implode("', '", $cases_no_revert) . "'";
            $vgrRevertedCases = $this->basundharaMb2Perpetualmodel->getRevertedCasesDetailsVGR($this->db2,$concatedCasesNo);
            $vgrRevertedCaseCount = $vgrRevertedCases->num_rows();

            $errCheck = 0;

            if($vgrRevertedCaseCount > 0)
            {
                $errCheck = 1;
                $vgrRevertedCaseList =$vgrRevertedCases->result();

                    $vgrRevertedCaseNos = array_map(function ($item) {
                            return $item->case_no;
                        }, $vgrRevertedCaseList);

                    $allVgrRevertedCases = implode(", ", $vgrRevertedCaseNos);

                        echo json_encode(array(
                        'responseType' => 1,
                        'message' => '****Cases : (' . $allVgrRevertedCases . ') are Already Reverted *****',
                    ));
                return;
            }

            if($errCheck == 0)
            {
                $casesArray = array_map(function ($a, $b, $c) {
                    return $a . '(@)' . $b . '(@)' . $c;
                }, $cases_no_revert, $input_revert_remarks, $service_code_revert);

                foreach($casesArray as $row)
                {
                    $case_no = strtok($row, '(@)');
                    $revert_remarks = strtok('(@)');
                    $service_code = strtok('(@)');

                    if($service_code != SETTLEMENT_PGR_VGR_LAND_ID){
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'All Cases Should be PGR/VGR !!!.',
                        ));
                        return;
                    }

                  
                    $getBasicData = $this->basundharaMb2Perpetualmodel->getBasicCasesDetailsVGR($this->db2,$case_no)->row();

                    if (!isset($getBasicData))
                    {
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'Not Getting Reverted Cases Details',
                        ));
                        return;
                    }else
                    {
                        $dist_code_basic = trim($getBasicData->dist_code);
                        $subdiv_code_basic = trim($getBasicData->subdiv_code);
                        $cir_code_basic = trim($getBasicData->cir_code);
                        $mouza_code_basic = trim($getBasicData->mouza_pargona_code);
                        $lot_no_basic = trim($getBasicData->lot_no);
                        $vill_code_basic = trim($getBasicData->vill_townprt_code);
                        $pending_office_basic = trim($getBasicData->pending_office);
                        $pending_officer_basic = trim($getBasicData->pending_officer);
                        $from_office_basic = trim($getBasicData->from_office);
                        $status_basic = trim($getBasicData->status);

                        $meeting_id = $getBasicData->meeting_id;
                        $proposal_id = $getBasicData->proposal_id;
                        $proposal_cases_id = $getBasicData->pro_case_id;
                    }

                    //Insert Array for settlement_vgr_pgr_revert_cases
                    $insertVGRRevert[] = [
                        'dist_code' => $dist_code_basic,
                        'subdiv_code' => $subdiv_code_basic,
                        'cir_code' => $cir_code_basic,
                        'mouza_pargona_code' => $mouza_code_basic,
                        'lot_no' => $lot_no_basic,
                        'vill_townprt_code' => $vill_code_basic,
                        'meeting_id' => $meeting_id,
                        'proposal_id' => $proposal_id,
                        'pro_cases_id' => $proposal_cases_id,
                        'case_no' => $case_no,
                        'meeting_pending_at' => MB_DEPARTMENT,
                        'user_code' => $user_code,
                        'revert_date' => date('Y-m-d h:i:s'),
                        'status' => 1,
                        'approve_status'        => MB_PENDING,
                        'from_office'     => MB_DEPARTMENT,
                        'to_office' => MB_DEPUTY_COMM,
                        'remarks' => $revert_remarks,
                        'basic_pending_office' => $pending_office_basic,
                        'basic_pending_officer' =>$pending_officer_basic ,
                        'basic_status' => $status_basic,
                        'basic_from_office' => $from_office_basic,
                        'created_at' => date('Y-m-d h:i:s'),
                    ];

                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                    if ($proceeding_id == null) {
                        $proceeding_id = 1;
                    }

                    //Insert Array for Settlement Proceedings for revert cases
                    $insPetProceed[] = [
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'next_date_of_hearing' => date('Y-m-d h:i:s'),
                        'note_on_order' => $revert_remarks,
                        'user_code' => $user_code,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'office_from' => MB_DEPARTMENT,
                        'office_to'   => MB_DEPUTY_COMM,
                        'task' => 'Meeting Revert back to DC',
                        'status' => 'VR',
                        'note_type' => 'Maybe Reject',
                    ];

                    //Update Array for Proposal Meeting List
                    $updateMeetingData[] = [
                        'id' => $meeting_id,
                        'vgr_pgr_revert_status' => 1,
                         ];

                    //Update Array for Settlement Basic
                    $updateBasicData[] = [
                        'case_no' => $case_no,
                        'dept_vgr_revert' => 1,
                         ];

                    $application_no[] = $this->basundharaMb2Perpetualmodel->getApplicationNoByCaseNo($this->db2,$case_no)->applid;
                    $concatenatedAppNo = implode(',', $application_no);
                }

                $this->db2->trans_begin();
                $insertVGRRevertStatus = $this->db2->insert_batch('settlement_vgr_pgr_revert_cases',$insertVGRRevert);

                if($insertVGRRevertStatus<=0 || $this->db2->affected_rows() <= 0)
                {
                    $this->db2->trans_rollback();
                    echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'Error01: Cases Not Reverted ! Kindly Contact System Admin.',
                        ));
                    return;
                }else
                {
                        $inserProceding = $this->db2->insert_batch('settlement_proceeding', $insPetProceed);
                        if($inserProceding <= 0 || $this->db2->affected_rows() <= 0)
                        {
                            $this->db2->trans_rollback();
                            echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'Error02: VGR Cases Not Reverted ! Kindly Contact System Admin.',
                                ));
                            return;
                        }else
                        {
                            $updateMeetingStatus = $this->db2->update_batch('proposal_meeting_list',$updateMeetingData,'id');

                            if($updateMeetingStatus <= 0 || $this->db2->affected_rows() <= 0)
                            {
                                $this->db2->trans_rollback();
                                echo json_encode(array(
                                        'responseType' => 1,
                                        'message' => 'Error03: VGR Cases Not Reverted ! Kindly Contact System Admin.',
                                    ));
                                return;
                            }else
                            {
                                $updateBasicRevertStatus = $this->db2->update_batch('settlement_basic',$updateBasicData,'case_no');
                                if($updateBasicRevertStatus <= 0 || $this->db2->affected_rows() <= 0)
                                {
                                    $this->db2->trans_rollback();
                                    echo json_encode(array(
                                            'responseType' => 1,
                                            'message' => 'Error04: VGR Cases Not Reverted ! Kindly Contact System Admin.',
                                        ));
                                    return;
                                }else
                                {
                                    $rmk    = 'Revert to DC';
                                    $status = MB_PAYMENT_REQUEST;
                                    $task   = MB_DEPARTMENT;
                                    $pen    = MB_DEPUTY_COMM;
                                    $rtps_status = $this->basundharaMb2Perpetualmodel->applicationStatusUpdateBulk($concatenatedAppNo,'NA',$rmk,$status,$task,$pen);
                                    if($rtps_status==null || $rtps_status!="y")
                                    // if($rtps_status=="y")
                                        {
                                            $this->db2->trans_rollback();
                                            log_message('error', '#ERRAPIREVERTDEPTVGR: Issue in API Call for Bulk Revert By Dept' .$this->db2->last_query());
                                            echo json_encode(array(
                                                'responseType' => 3,
                                                'message'      => '#ERRAPIREVERTDEPTVGR: Cases Not Reverted ! Kindly Contact System Admin.  !!!',
                                            ));
                                            return;
                                        }else
                                        {
                                            $this->db2->trans_commit();
                                            echo json_encode(array(
                                                'responseType' => 2,
                                                'message' => 'Cases Reverted  to DC Successfully',

                                            ));
                                        }
                                }
                            }
                        }
                }

            }
        }
    }


    public function signedAndFinalApproveByDept()
    {

        $_POST = json_decode(file_get_contents("php://input"), true);
        $cab_id = $this->input->post('cab_id');
        $pdfData = $this->input->post('pdfData');
        $notificationName = "NOTIFICATION";
        $memoId = str_replace("/", "_", $cab_id);
        $fileName    = $notificationName . '_DEPT_' . date("Y") . '_' . $memoId;

        
        $base64PDFData = $pdfData;
            $uploadpath   = NOTIFICATION_UPLOAD_DIR;
            file_put_contents($uploadpath.$fileName.".pdf", base64_decode($base64PDFData));
           
            $upload_notification_path = NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf';

            $curr_date = date('Y-m-d h:i:s');
            $user_code = $this->session->userdata('user_code');
            $ip = $_SERVER['REMOTE_ADDR'];

            $this->db = $this->load->database('db2', TRUE);

            $this->db->trans_begin();
            $query2 = $this->db->query(
                "UPDATE cab_id_list SET upload_notification_doc_path = ?, notification_digital_sign_status=?, notification_digital_signed_date=?, digital_sign_ip =?,digital_sign_user_code =?
                                        WHERE user_code=? AND status=? AND cab_id=?",
                array($upload_notification_path,1, $curr_date,$ip, $user_code,$user_code, 2, $cab_id)
            );

            $uploadNotificationStatus = $this->db->affected_rows();

            if ($uploadNotificationStatus <= 0) {
                $this->db->trans_rollback();
                log_message("error", "#ERRORNG12309 : Notification Signed Save Failed...Table cab_id_list" . $this->db->last_query());
                echo json_encode(array(
                'responseType' => 3,
                'message' => "#ERRORNG12309 : Notification Signed Failed."
                ));
                return;
            }
            else
            {
                $this->db->trans_commit();
                echo json_encode(array(
                'responseType' => 2,
                'message' => "Successfully Uploded Signed Notification for the Cab Memo No :" . $memoId
                ));
            }
        }


    public function addCasesToCabMemo()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        
        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('cabinet_id', 'Cabinet ID', 'required');


        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Check Form Data',
            ));
        } else 
        {
            $dist_code     = $this->input->post('district_id');
            $cabmemo_id     = $this->input->post('cabinet_id');
            $allSelectedList = $this->input->post('selectedList');
            $confirmRevival = $this->input->post('confirm_revival');

            $errCheck = 0;
            
                foreach ($allSelectedList as $item) 
                {
                    $splitResult = explode("@", $item);
                    $newArray[] = $splitResult[0];  
                }


                $allSelectedCases = implode(", ", $newArray);
                
                $splitStrings = explode(', ', $allSelectedCases);

                if (!empty($splitStrings)) {
                    $casesList = "'" . implode("', '", $splitStrings) . "'";
                }


                $this->db2 =  $this->dbswitch2($dist_code);
                
                //Chitha Area Validation Start

                if(CHITHA_AREA_VALIDATION == 1)
                {
                    
                    $errorArray = array();
                    foreach($newArray as $case)
                    {
                        $checkArea = $this->basundharaMb2Perpetualmodel->chithaReserveAreaCheckWithCaseNo($this->db2,$case); 
                        
                        if($checkArea != 0)
                        {
                            $errorArray[] = $case;
                            continue;
                        }      
                    }


                    if(count($errorArray) > 0)
                    {
                        $errCheck = 1;

                        $case_str  = '';           
                        foreach ($errorArray as $err)
                        {
                            $case_str = $case_str.$err.',';
                        }           

                        $errorShow = '';
                        if($case_str != NULL)
                        {
                            $errorShow = ' Total Area Recommended for Settlement can’t exceed available Area in Chitha for
                                            (Case No. -  '.$case_str .')';
                        }                
                    
                        echo json_encode(array(
                            'responseType' => 3,
                            'message'      => '******** Unable to Add Cases to  CAB MEMO ******* .'.$errorShow.' !!!',
                        ));
                        return;
                    }
                }
                //Chitha Area Validation End

                //Check for Modification Request Status


                $pullRequestCase = $this->basundharaMb2Perpetualmodel->getPullRequestStatus($this->db2,$casesList);
                $pullRequestCaseCount = $pullRequestCase->num_rows();

                if($pullRequestCaseCount > 0)
                {

                    $errCheck = 1;
                    $pullRequestCasesList =$pullRequestCase->result();

                    $pullRequestCaseNos = array_map(function ($item) {
                            return $item->case_no;
                        }, $pullRequestCasesList);

                    $allPullRequestCases = implode(", ", $pullRequestCaseNos);

                     echo json_encode(array(
                        'responseType' => 3,
                        'message' => 'Failed to Add Cases to Cabinet Memo as Cases Trying to Add Have Modification Request for Case No (' . $allPullRequestCases . ') (***Revert These Cases To DC before Generate Memo)',
                    ));

                }

                //Modification Request Check End

                if($errCheck == 0)
                {

                    $user_code = $this->session->userdata('user_code');
                    $this->db = $this->load->database('db2', TRUE);
                    $memo_name = $this->basundharaMb2Perpetualmodel->getMemoNameByCabId($this->db,$cabmemo_id);
    
                    if ($cabmemo_id == NULL) {
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'CAB ID Not Found for ' .$this->utilclass->getDistrictNameOnLanding($dist_code). ' District Please Create CAB ID before Adding Cases to Cabinet Memo',

                        ));
                    } else 
                    {
                        if (!empty($allSelectedList)) 
                        {
                            //Check if Case Already Exist
                            $this->db = $this->load->database('db2', TRUE);

                            $cabMemoCases = $this->basundharaMb2Perpetualmodel->getExistingCasesUnderCabMemo($dist_code);
                            
                            $cabMemoCaseList  = $cabMemoCases->result_array();
                            
                            $memoCaseArray = array_column($cabMemoCaseList, 'case_no');

                            $duplicates = array_intersect($newArray, $memoCaseArray);

                            $newCases = array_diff($newArray, $memoCaseArray);

                            //For Cases Already Present in Cab Memo
                            if (!empty($duplicates)) 
                            {
                                $duplicateCases = "'" . implode("', '", $duplicates) . "'";

                                $this->db2 =  $this->dbswitch2($dist_code);
                                $checkPullRequestFinalStatus = $this->basundharaMb2Perpetualmodel->checkPullRequestFinalStatus($this->db2,$duplicateCases)->result();
                                if (!empty($checkPullRequestFinalStatus)) 
                                {
                                    $casesExist = array_map(
                                        function ($item) {
                                            return $item->case_no;
                                        },
                                        $checkPullRequestFinalStatus
                                    );
                                    if($confirmRevival == NULL)
                                    {
                                        $messageText = "<strong class='text-danger'>Following cases are already available in another cab memo approved by Department. !</strong></br></br>
                                                                    <small>These cases might have come to you after modification by respective districts. If you add this cases to new Cab Memo, these cases would be removed from earlier cab memo.</small></br><hr>
                                                                    <span class='bg-warning'> *** Cases Present in Memo *** </span></br>
                                                                    <small class='text-primary'>( $duplicateCases )</small></br><hr>
                                                                    <strong class='text-danger'>Do You want to Add these cases to Cab Memo ?</strong>";
                                        echo json_encode(array(
                                            'responseType' => 4,
                                            'message' => $messageText,
                                        ));
                                        return false;
                                    }

                                    foreach($casesExist as $casesE)
                                    {
                                        $caseNoOld = $casesE;

                                        $this->db = $this->load->database('db2', TRUE);
                                        $getOldCaseDetails = $this->basundharaMb2Perpetualmodel->getOldCaseDetailsFromCabMemo($this->db,$caseNoOld,$dist_code)->row();

                                        $oldCaseNo = $getOldCaseDetails->case_no;

                                        $this->db2 =  $this->dbswitch2($dist_code);
                                        $getMeetingProposal = $this->basundharaMb2Perpetualmodel->getMeetingProposalByCaseNo($this->db2,$caseNoOld)->row();

                                        $caseProposalId = $getMeetingProposal->proposal_id;
                                        $caseMeetingId = $getMeetingProposal->meeting_id;

                                        $caseBackupDetails = [
                                            'cab_id'                => $getOldCaseDetails->cab_id,
                                            'case_no'               => $getOldCaseDetails->case_no,
                                            'user_code'             => $getOldCaseDetails->user_code,
                                            'dist_code'             => $getOldCaseDetails->dist_code,
                                            'status'                => $getOldCaseDetails->status,
                                            'created_at'            => $getOldCaseDetails->created_at, 
                                            'updated_at'            => $getOldCaseDetails->updated_at,
                                            'meeting_id'            => $getOldCaseDetails->meeting_id,
                                            'proposal_id'           => $getOldCaseDetails->proposal_id,
                                            'final_submit_status'   => $getOldCaseDetails->final_submit_status,
                                            'memo_placed_date'      => $getOldCaseDetails->memo_placed_date,
                                            'memo_approved_date'    => $getOldCaseDetails->memo_approved_date,
                                            'finalized_at'          => $getOldCaseDetails->finalized_at,
                                            'approved_at'           => $getOldCaseDetails->approved_at,
                                            'backup_at'             => date('Y-m-d')
                                        ];


                                        $newCaseDetails = array(
                                            'cab_id'        => $cabmemo_id,
                                            'user_code'     => $user_code,
                                            'dist_code'     => $dist_code,
                                            'status'        => ADD_CASES_TO_CAB_MEMO,
                                            'created_at'    => date('Y-m-d h:i:s'),
                                            'meeting_id'    => $caseMeetingId,
                                            'proposal_id'   => $caseProposalId,
                                            'is_revival'    => 1,
                                        );

                                        $whereCase = array(
                                            'case_no'   => $getOldCaseDetails->case_no,
                                            'dist_code' => $getOldCaseDetails->dist_code,
                                        );


                                        $this->db->trans_begin();
                                        $insertBackupCaseDetails = $this->db->insert('cab_memo_case_backup', $caseBackupDetails);

                                        if ($insertBackupCaseDetails != TRUE) 
                                        {
                                            $this->db->trans_rollback();
                                            log_message('error', '#ERRBACKUPOLDCASE: Insertion failed in cab_memo_case_backup');
                                            log_message('error', $this->db->last_query());

                                            echo json_encode(array(
                                                'responseType' => 1,
                                                'message' => 'ERRBACKUPOLDCASE: Failed to Add Cases to Cabinet Memo',

                                            ));
                                            return false;
                                        }
                                        else
                                        {
                                            $updateCabMemoList = $this->basundharaMb2Perpetualmodel->updateCabMemoList($newCaseDetails,$whereCase);
                                
                                            if ($updateCabMemoList <= 0) {
                                                $this->db->trans_rollback();
                                                log_message('error', '#ERRDUPDATENEWCASE001: Updation failed in cab_memo_list');
                                                log_message('error', $this->db->last_query());

                                                echo json_encode(array(
                                                    'responseType' => 1,
                                                    'message' => 'ERRDUPDATENEWCASE001:Failed to Add Cases to Cabinet Memo',

                                                ));
                                                return false;
                                            } else {

                                                $updateCabIdData = array(
                                                    'status'        => ADD_CASES_UNDER_CAB_ID,
                                                    'finalized_at'  => date('Y-m-d H:i:s'),
                                                );

                                                $whereCabId = array(
                                                    'cab_id'    => $cabmemo_id,
                                                    'user_code' => $user_code,
                                                );

                                                $updateCabIdListStatus = $this->basundharaMb2Perpetualmodel->updateCabStatus($this->db,$whereCabId, $updateCabIdData);

                                                if($updateCabIdListStatus <= 0){
                                                $this->db->trans_rollback();
                                                log_message('error', '#ERRDUPDATECABLISTSTATUS: Updation failed in cab_id_list');
                                                log_message('error', $this->db->last_query());

                                                echo json_encode(array(
                                                    'responseType' => 1,
                                                    'message' => 'ERRDUPDATECABLISTSTATUS: Failed to Add Cases to Cabinet Memo',
                                                ));
                                                return false;
                                                }else{
                                                    $this->db->trans_commit();

                                                    //change status in Settlement basic
                                                    $this->db2 =  $this->dbswitch2($dist_code);

                                                    $this->db2->trans_begin();

                                                    $updateBasicData = array(
                                                        'cab_memo_prepared' => SB_ADD_CASES_TOCAB_MEMO,
                                                    );

                                                    $updateBasicStatusOld = $this->basundharaMb2Perpetualmodel->updateSettlementBasicForCab($this->db2,$oldCaseNo, $dist_code, $updateBasicData);
                                                    if($updateBasicStatusOld <= 0){
                                                    $this->db2->trans_rollback();
                                                    log_message('error', '#ERRDUPDATBASICCABOLD: Updation failed in settlement_basic for change cabinet status');
                                                    log_message('error', $this->db2->last_query());

                                                    echo json_encode(array(
                                                        'responseType' => 1,
                                                        'message' => 'ERRDUPDATBASICCABOLD: Failed to Add Cases to Cabinet Memo',

                                                    ));
                                                    return false;
                                                    }else{

                                                    $this->db2->trans_commit();

                                                    }
                                                }

                                            }

                                        }

                                    }
                                }
                            }
                            //For Cases Already Present in Cab Memo End

                            //For Cases Not Present in Cab Memo
                            if (!empty($newCases)) 
                            {
                                foreach ($newCases as $caseN) 
                                {
                                    // $parts = explode("@", $row);
                                    // list($case_no, $meeting_id,$proposal_no) = $parts;
                                    $case_no =$caseN;

                                    $this->db2 =  $this->dbswitch2($dist_code);
                                    $getMeetingProposal = $this->basundharaMb2Perpetualmodel->getMeetingProposalByCaseNo($this->db2,$case_no)->row();

                                    $proposal_no = $getMeetingProposal->proposal_id;
                                    $meeting_id = $getMeetingProposal->meeting_id;

                                    $this->db->trans_begin();

                                    //Insert in CAB Memo  List
                                    $insCabStack = [
                                        'cab_id'        => $cabmemo_id,
                                        'case_no'       => $case_no,
                                        'user_code'     => $user_code,
                                        'dist_code'     => $dist_code,
                                        'status'        => ADD_CASES_TO_CAB_MEMO,
                                        'created_at'    => date('Y-m-d h:i:s'),
                                        'meeting_id'    => $meeting_id,
                                        'proposal_id'   => $proposal_no,
                                    ];

                                    $insertCabList = $this->db->insert('cab_memo_list', $insCabStack);

                                    if ($insertCabList != TRUE) {
                                        $this->db->trans_rollback();
                                        log_message('error', '#ERRDUPDATECSL001: Updation failed in cab_memo_list');
                                        log_message('error', $this->db->last_query());

                                        echo json_encode(array(
                                            'responseType' => 1,
                                            'message' => 'Failed to Add Cases to Cabinet Memo',

                                        ));
                                        return false;
                                    } else {

                                        $updateData = array(
                                            'status'        => ADD_CASES_UNDER_CAB_ID,
                                            'finalized_at'  => date('Y-m-d H:i:s'),
                                        );

                                        $where = array(
                                            'cab_id'        => $cabmemo_id,
                                            'user_code'     => $user_code,
                                        );

                                        $updateCabIdList = $this->basundharaMb2Perpetualmodel->updateCabStatus($this->db,$where, $updateData);
                                        if ($updateCabIdList <= 0) {
                                            $this->db->trans_rollback();
                                            log_message('error', '#ERRDUPDATE0001: Updation failed in cab_id_list for bulk Approve');
                                            log_message('error', $this->db->last_query());

                                            echo json_encode(array(
                                                'responseType' => 1,
                                                'message' => 'Failed to Add Cases to Cabinet Memo',

                                            ));
                                            return false;
                                        } else {
                                            $this->db->trans_commit();

                                            //change status in Settlement basic
                                            $this->db2 =  $this->dbswitch2($dist_code);

                                            $this->db2->trans_begin();

                                            $updateData = array(
                                                'cab_memo_prepared' => SB_ADD_CASES_TOCAB_MEMO,
                                            );

                                            $updateBasicStatusNew = $this->basundharaMb2Perpetualmodel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData);


                                            if($updateBasicStatusNew <= 0){
                                            $this->db2->trans_rollback();
                                            log_message('error', '#ERRDUPDATBASICCAB: Updation failed in settlement_basic for change cabinet status');
                                            log_message('error', $this->db2->last_query());

                                            echo json_encode(array(
                                                'responseType' => 1,
                                                'message' => 'ERRDUPDATBASICCAB: Failed to Add Cases to Cabinet Memo',

                                            ));
                                            return false;

                                            }else{

                                            $this->db2->trans_commit();

                                            }

                                            //change sttatus in basic
                                        }
                                    }
                                }
                            }
                            //For Cases Not Present in Cab Memo End

                            echo json_encode(array(
                                'responseType' => 2,
                                'message' => 'Cases Successfully Added to Cabinet Memo ' .$memo_name .'('. $cabmemo_id . ') for District ' . $this->utilclass->getDistrictNameOnLanding($dist_code),

                            ));
                        }
                    }
                }
        }
    }

    public function addVGRCasesToCabMemo()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('cabinet_id', 'Cabinet ID', 'required');


        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Check Form Data',
            ));
        } else {
            $dist_code     = $this->input->post('district_id');
            $cabmemo_id     = $this->input->post('cabinet_id');
            $allSelectedList = $this->input->post('selectedList');
            $confirmRevival = $this->input->post('confirm_revival');

            $errCheck = 0;

            foreach ($allSelectedList as $item) {

                $splitResult = explode("@", $item);

                $newArray[] = $splitResult[0];
                
                }

                $allSelectedCases = implode(", ", $newArray);

                $splitStrings = explode(', ', $allSelectedCases);

                if (!empty($splitStrings)) {
                    $casesList = "'" . implode("', '", $splitStrings) . "'";
                }


                $this->db2 =  $this->dbswitch2($dist_code);

                //Check if Cases Exist in VGR Revert 
                $concatedCasesNo = "'" . implode("', '", $newArray) . "'";
                $vgrRevertedCases = $this->basundharaMb2Perpetualmodel->getRevertedCasesDetailsVGR($this->db2,$concatedCasesNo);
                $vgrRevertedCaseCount = $vgrRevertedCases->num_rows();

                if($vgrRevertedCaseCount > 0)
                {
                    $errCheck = 1;
                    $vgrRevertedCaseList =$vgrRevertedCases->result();

                        $vgrRevertedCaseNos = array_map(function ($item) {
                                return $item->case_no;
                            }, $vgrRevertedCaseList);

                        $allVgrRevertedCases = implode(", ", $vgrRevertedCaseNos);

                            echo json_encode(array(
                            'responseType' => 3,
                            'message' => 'Can not Add Cases to CAB MEMO as Cases : (' . $allVgrRevertedCases . ') are Already Reverted *****',
                        ));
                    return;
                }
                //Check if Cases Exist in VGR Revert 

                //Chitha Area Validation Start

                if(CHITHA_AREA_VALIDATION == 1)
                {
                    $errorArray = array();
                    foreach($newArray as $case)
                    {
                        $checkArea = $this->basundharaMb2Perpetualmodel->chithaReserveAreaCheckWithCaseNo($this->db2,$case); 
                
                        if($checkArea != 0)
                            {
                            $errorArray[] = $case;
                            continue;
                            }      
                    }

                    if(count($errorArray) > 0)
                    {
                        $errCheck = 1;

                        $case_str  = '';           
                        foreach ($errorArray as $err)
                        {
                            $case_str = $case_str.$err.',';
                        }           

                        $errorShow = '';
                        if($case_str != NULL)
                        {
                            $errorShow = ' Total Area Recommended for Settlement can’t exceed available Area in Chitha for
                                            (Case No. -  '.$case_str .')';
                        }                
                    
                        echo json_encode(array(
                            'responseType' => 3,
                            'message'      => '******** Unable to Add Cases to  CAB MEMO ******* .'.$errorShow.' !!!',
                        ));
                        return;
                    }
                }
                //Chitha Area Validation End

                //////////////VGR NEW CHITHA_AREA VALIDATION START////////////////

                    $vgrReservationCases = $this->basundharaMb2Perpetualmodel->getSettlementVgrReservationDetails($this->db2,$concatedCasesNo);
                    $vgrReservationCasesList  = $vgrReservationCases->result_array();

                    $caseHavingReservation = array_column($vgrReservationCasesList, 'case_no');

                    $caseNotHavingReservation = array_diff($newArray, $caseHavingReservation);

                    if(!empty($caseNotHavingReservation))
                    {
                        $errorCases = "'" . implode("', '", $caseNotHavingReservation) . "'";

                        $messageText = "<strong class='text-danger'>VGR Reservation Not Found. !</strong></br>
                                                    <span> *** Reserve Area Not Found for these cases ***</span></br><hr>
                                                    <small class='text-danger'>( $errorCases )</small>";
                        echo json_encode(array(
                            'responseType' => 3,
                            'message' => $messageText,
                        ));
                        return false;
                    }
                    else
                    {
                        $errorArray = array();
                        foreach($vgrReservationCasesList as $vgrReservation)
                        {
                            $reserveCase = $vgrReservation['case_no'];
                            
                            $checkReserv = $this->basundharaMb2Perpetualmodel->getTotalVgrReservationInDag($this->db2,$vgrReservation['dist_code'], $vgrReservation['subdiv_code'], $vgrReservation['cir_code'], $vgrReservation['mouza_pargona_code'], $vgrReservation['lot_no'], $vgrReservation['vill_townprt_code'], $vgrReservation['dag_no']);

                            if($checkReserv['responseType'] != 2)
                            {
                                $errorArray[] = $reserveCase;
                                continue;
                            }
                        }
                        if(count($errorArray) > 0)
                        {
                            $errCheck = 1;

                            $case_str  = '';           
                            foreach ($errorArray as $err)
                            {
                                $case_str = $case_str.$err.',';
                            }           

                            $errorShow = '';
                            if($case_str != NULL)
                            {
                                $errorShow = 'Chitha Area exceed for Reservation
                                                (Case No. -  '.$case_str .')';
                            }                
                        
                            echo json_encode(array(
                                'responseType' => 3,
                                'message'      => '******** Unable to Add Cases to  CAB MEMO ******* .'.$errorShow.' !!!',
                            ));
                            return false;
                        }
                    }

                //////////////VGR NEW CHITHA_AREA VALIDATION END////////////////


                //VGR Cluster Validation
                if(VGR_CLUSTER_VALIDATION == 1)
                    {
                        $CheckClusterStatus = array();
                        foreach($newArray as $case)
                        {
                            $case_no = trim($case);
                            $CheckClusterCount = $this->basundharaMb2Perpetualmodel->checkIfCaseRevertedFromCluster($this->db2,$case_no); 
                        
                            if(trim($CheckClusterCount['clusterStatus']) != 1)
                                {
                                    $CheckClusterStatus[] = $case_no;
                                    continue;
                                }
                        }  
                        if(count($CheckClusterStatus) > 0)
                        {
                            $errCheck = 1;

                            $case_str  = '';           
                            foreach ($CheckClusterStatus as $err)
                            {
                                $case_str = $case_str.$err.',';
                            }           

                            $vgrErrorShow = '';
                            if($case_str != NULL)
                            {
                                $vgrErrorShow = 'VGR Cluster Validation Exist for
                                                (Case No. -  '.$case_str .')';
                            }                
                        
                            echo json_encode(array(
                                'responseType' => 3,
                                'message'      => '******** Unable to Add Cases to  CAB MEMO as Some cases in this cluster are Reverted back and still processing!!!******* .'.$vgrErrorShow.' !!!',
                            ));
                            return;
                        }
                    }
                // VGR Cluster Validation  End

                //Check for Modification Request Status

                $pullRequestCase = $this->basundharaMb2Perpetualmodel->getPullRequestStatus($this->db2,$casesList);
                $pullRequestCaseCount = $pullRequestCase->num_rows();

                if($pullRequestCaseCount > 0)
                {

                $errCheck = 1;
                $pullRequestCasesList =$pullRequestCase->result();

                    $pullRequestCaseNos = array_map(function ($item) {
                            return $item->case_no;
                        }, $pullRequestCasesList);

                    $allPullRequestCases = implode(", ", $pullRequestCaseNos);

                     echo json_encode(array(
                        'responseType' => 3,
                        'message' => 'Failed to Add Cases to Cabinet Memo as Cases Trying to Add Have Modification Request for Case No (' . $allPullRequestCases . ') (***Revert These Cases To DC before Generate Memo)',
                    ));

                }

                //Modification Request Check End

                if($errCheck == 0)
                {

                $user_code = $this->session->userdata('user_code');
                $this->db = $this->load->database('db2', TRUE);
                $memo_name = $this->basundharaMb2Perpetualmodel->getMemoNameByCabId($this->db,$cabmemo_id);
        
                if ($cabmemo_id == NULL) {
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'CAB ID Not Found for ' .$this->utilclass->getDistrictNameOnLanding($dist_code). ' District Please Create CAB ID before Adding Cases to Cabinet Memo',

                    ));
                } else 
                {
                    if (!empty($allSelectedList)) 
                        {
                            //Check if Case Already Exist
                            $this->db = $this->load->database('db2', TRUE);

                            $cabMemoCases = $this->basundharaMb2Perpetualmodel->getExistingCasesUnderCabMemo($dist_code);
                            
                            $cabMemoCaseList  = $cabMemoCases->result_array();
                            
                            $memoCaseArray = array_column($cabMemoCaseList, 'case_no');

                            $duplicates = array_intersect($newArray, $memoCaseArray);

                            $newCases = array_diff($newArray, $memoCaseArray);


                            //For Cases Already Present in Cab Memo
                            if (!empty($duplicates)) 
                            {
                                $duplicateCases = "'" . implode("', '", $duplicates) . "'";

                                $this->db2 =  $this->dbswitch2($dist_code);
                                $checkPullRequestFinalStatus = $this->basundharaMb2Perpetualmodel->checkPullRequestFinalStatus($this->db2,$duplicateCases)->result();

                                if (!empty($checkPullRequestFinalStatus)) 
                                {
                                    $casesExist = array_map(
                                        function ($item) {
                                            return $item->case_no;
                                        },
                                        $checkPullRequestFinalStatus
                                    );


                                    if($confirmRevival == NULL)
                                        {
                                            $messageText = "<strong class='text-danger'>Following cases are already available in another cab memo approved by Department. !</strong></br></br>
                                                                        <small>These cases might have come to you after modification by respective districts. If you add this cases to new Cab Memo, these cases would be removed from earlier cab memo.</small></br><hr>
                                                                        <span class='bg-success'> ***VGR Cases Already Present in Memo *** </span></br>
                                                                        <small class='text-primary'>( $duplicateCases )</small></br><hr>
                                                                        <strong class='text-danger'>Do You want to Add these cases to Cab Memo ?</strong>";
                                            echo json_encode(array(
                                                'responseType' => 4,
                                                'message' => $messageText,
                                            ));
                                            return false;
                                        }

                                    foreach($casesExist as $casesE)
                                        {
                                            $caseNoOld = $casesE;

                                            $this->db = $this->load->database('db2', TRUE);
                                            $getOldCaseDetails = $this->basundharaMb2Perpetualmodel->getOldCaseDetailsFromCabMemo($this->db,$caseNoOld,$dist_code)->row();

                                            $oldCaseNo = $getOldCaseDetails->case_no;

                                            $this->db2 =  $this->dbswitch2($dist_code);
                                            $getMeetingProposal = $this->basundharaMb2Perpetualmodel->getMeetingProposalByCaseNo($this->db2,$caseNoOld)->row();

                                                $caseProposalId = $getMeetingProposal->proposal_id;
                                                $caseMeetingId = $getMeetingProposal->meeting_id;

                                                $caseBackupDetails = [
                                                    'cab_id' => $getOldCaseDetails->cab_id,
                                                    'case_no' => $getOldCaseDetails->case_no,
                                                    'user_code' => $getOldCaseDetails->user_code,
                                                    'dist_code' => $getOldCaseDetails->dist_code,
                                                    'status' => $getOldCaseDetails->status,
                                                    'created_at'       => $getOldCaseDetails->created_at, 
                                                    'updated_at'       => $getOldCaseDetails->updated_at,
                                                    'meeting_id'       => $getOldCaseDetails->meeting_id,
                                                    'proposal_id'       => $getOldCaseDetails->proposal_id,
                                                    'final_submit_status'       => $getOldCaseDetails->final_submit_status,
                                                    'memo_placed_date'       => $getOldCaseDetails->memo_placed_date,
                                                    'memo_approved_date'       => $getOldCaseDetails->memo_approved_date,
                                                    'finalized_at'       => $getOldCaseDetails->finalized_at,
                                                    'approved_at'       => $getOldCaseDetails->approved_at,
                                                    'backup_at'       => date('Y-m-d')
                                                    ];


                                                    $newCaseDetails = array(
                                                        'cab_id' => $cabmemo_id,
                                                        'user_code' => $user_code,
                                                        'dist_code' => $dist_code,
                                                        'status' => ADD_CASES_TO_CAB_MEMO,
                                                        'created_at' => date('Y-m-d h:i:s'),
                                                        'meeting_id' => $caseMeetingId,
                                                        'proposal_id' => $caseProposalId,
                                                        'vgr_cab' => 1,
                                                        'is_revival' => 1,
                                                    );

                                                        $whereCase = array(
                                                            'case_no' => $getOldCaseDetails->case_no,
                                                            'dist_code' => $getOldCaseDetails->dist_code,
                                                        );


                                                    $this->db->trans_begin();
                                                    $insertBackupCaseDetails = $this->db->insert('cab_memo_case_backup', $caseBackupDetails);

                                                    if ($insertBackupCaseDetails != TRUE) 
                                                    {
                                                        $this->db->trans_rollback();
                                                        log_message('error', '#ERRBACKUPOLDCASEVGR: Insertion failed in cab_memo_case_backup');
                                                        log_message('error', $this->db->last_query());

                                                        echo json_encode(array(
                                                            'responseType' => 1,
                                                            'message' => 'ERRBACKUPOLDCASEVGR: Failed to Add Cases to Cabinet Memo',

                                                        ));
                                                        return false;
                                                    }
                                                    else
                                                    {
                                                        $updateCabMemoList = $this->basundharaMb2Perpetualmodel->updateCabMemoList($newCaseDetails,$whereCase);
                                            
                                                        if ($updateCabMemoList <= 0) {
                                                            $this->db->trans_rollback();
                                                            log_message('error', '#ERRDUPDATENEWCASEVGR001: Updation failed in cab_memo_list');
                                                            log_message('error', $this->db->last_query());

                                                            echo json_encode(array(
                                                                'responseType' => 1,
                                                                'message' => 'ERRDUPDATENEWCASEVGR001:Failed to Add Cases to Cabinet Memo',

                                                            ));
                                                            return false;
                                                        } else {

                                                            $updateCabIdData = array(
                                                                'status' => ADD_CASES_UNDER_CAB_ID,
                                                                'finalized_at' => date('Y-m-d H:i:s'),
                                                            );

                                                            $whereCabId = array(
                                                                'cab_id' => $cabmemo_id,
                                                                'user_code' => $user_code,
                                                            );

                                                            $updateCabIdListStatus = $this->basundharaMb2Perpetualmodel->updateCabStatus($this->db,$whereCabId, $updateCabIdData);

                                                            if($updateCabIdListStatus <= 0){
                                                            $this->db->trans_rollback();
                                                            log_message('error', '#ERRDUPDATECABLISTSTATUSVGR: Updation failed in cab_id_list');
                                                            log_message('error', $this->db->last_query());

                                                            echo json_encode(array(
                                                                'responseType' => 1,
                                                                'message' => 'ERRDUPDATECABLISTSTATUSVGR: Failed to Add Cases to Cabinet Memo',
                                                            ));
                                                            return false;
                                                            }else{
                                                                $this->db->trans_commit();

                                                                //change status in Settlement basic
                                                                $this->db2 =  $this->dbswitch2($dist_code);

                                                                $this->db2->trans_begin();

                                                                $updateBasicData = array(
                                                                    'cab_memo_prepared' => SB_ADD_CASES_TOCAB_MEMO,
                                                                );

                                                                $updateBasicStatusOld = $this->basundharaMb2Perpetualmodel->updateSettlementBasicForCab($this->db2,$oldCaseNo, $dist_code, $updateBasicData);
                                                                if($updateBasicStatusOld <= 0){
                                                                $this->db2->trans_rollback();
                                                                log_message('error', '#ERRDUPDATBASICCABOLDVGR: Updation failed in settlement_basic for change cabinet status');
                                                                log_message('error', $this->db2->last_query());

                                                                echo json_encode(array(
                                                                    'responseType' => 1,
                                                                    'message' => 'ERRDUPDATBASICCABOLDVGR: Failed to Add Cases to Cabinet Memo',

                                                                ));
                                                                return false;
                                                                }else{

                                                                $this->db2->trans_commit();

                                                                }
                                                            }

                                                        }

                                                    }

                                        }
                                }
                            }
                            //For Cases Already Present in Cab Memo End

                            //For Cases Not Present in Cab Memo
                            if (!empty($newCases)) 
                            {
                                foreach ($newCases as $caseN) 
                                {
                                    // $parts = explode("@", $row);
                                    // list($case_no, $meeting_id,$proposal_no) = $parts;
                                    $case_no =$caseN;

                                    $this->db2 =  $this->dbswitch2($dist_code);
                                    $getMeetingProposal = $this->basundharaMb2Perpetualmodel->getMeetingProposalByCaseNo($this->db2,$case_no)->row();

                                    $proposal_no = $getMeetingProposal->proposal_id;
                                    $meeting_id = $getMeetingProposal->meeting_id;

                                    $this->db->trans_begin();

                                    //Insert in CAB Memo  List
                                    $insCabStack = [
                                        'cab_id' => $cabmemo_id,
                                        'case_no' => $case_no,
                                        'user_code' => $user_code,
                                        'dist_code' => $dist_code,
                                        'status' => ADD_CASES_TO_CAB_MEMO,
                                        'created_at' => date('Y-m-d h:i:s'),
                                        'meeting_id' => $meeting_id,
                                        'proposal_id' => $proposal_no,
                                    ];

                                    $insertCabList = $this->db->insert('cab_memo_list', $insCabStack);

                                    if ($insertCabList != TRUE) {
                                        $this->db->trans_rollback();
                                        log_message('error', '#ERRDUPDATECSL001: Updation failed in cab_memo_list');
                                        log_message('error', $this->db->last_query());

                                        echo json_encode(array(
                                            'responseType' => 1,
                                            'message' => 'Failed to Add Cases to Cabinet Memo',

                                        ));
                                        return false;
                                    } else {

                                        $updateData = array(
                                            'status' => ADD_CASES_UNDER_CAB_ID,
                                            'finalized_at' => date('Y-m-d H:i:s'),
                                        );

                                        $where = array(
                                            'cab_id' => $cabmemo_id,
                                            'user_code' => $user_code,
                                        );

                                        $updateCabIdList = $this->basundharaMb2Perpetualmodel->updateCabStatus($this->db,$where, $updateData);
                                        if ($updateCabIdList <= 0) {
                                            $this->db->trans_rollback();
                                            log_message('error', '#ERRDUPDATE0001: Updation failed in cab_id_list for bulk Approve');
                                            log_message('error', $this->db->last_query());

                                            echo json_encode(array(
                                                'responseType' => 1,
                                                'message' => 'Failed to Add Cases to Cabinet Memo',

                                            ));
                                            return false;
                                        } else {
                                            $this->db->trans_commit();

                                            //change status in Settlement basic
                                            $this->db2 =  $this->dbswitch2($dist_code);

                                            $this->db2->trans_begin();

                                            $updateData = array(
                                                'cab_memo_prepared' => SB_ADD_CASES_TOCAB_MEMO,
                                            );

                                            $updateBasicStatusNew = $this->basundharaMb2Perpetualmodel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData);


                                            if($updateBasicStatusNew <= 0){
                                            $this->db2->trans_rollback();
                                            log_message('error', '#ERRDUPDATBASICCAB: Updation failed in settlement_basic for change cabinet status');
                                            log_message('error', $this->db2->last_query());

                                            echo json_encode(array(
                                                'responseType' => 1,
                                                'message' => 'ERRDUPDATBASICCAB: Failed to Add Cases to Cabinet Memo',

                                            ));
                                            return false;

                                            }else{

                                            $this->db2->trans_commit();

                                            }

                                            //change sttatus in basic
                                        }
                                    }
                                }
                            }
                            //For Cases Not Present in Cab Memo End

                            echo json_encode(array(
                                'responseType' => 2,
                                'message' => 'Cases Successfully Added to Cabinet Memo ' .$memo_name .'('. $cabmemo_id . ') for District ' . $this->utilclass->getDistrictNameOnLanding($dist_code),

                            ));
                        }
                }

                }
                

        }
    }


    // 18-01-2025 HRP starts

    public function pendingPerpetualCaselanding()
    {
        if ($this->session->userdata('designation') == DPT_JS) {

            //Get Department User district List
            // $data['user_dist']      = $this->getDeptUserDistList();

            //change by MRIGANKA----------22092023

            $data['user_dist']      = $this->basundharaMb2Perpetualmodel->getDeptUserDistListWithCaseCount();

            $dist_code     = trim($this->input->post('selectDistrict'));

            $data['dist_code'] = $dist_code;

            $user_code = $this->session->userdata('user_code');

            $this->form_validation->set_rules('selectDistrict', 'Please Select District Before Proceed', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['cases']      = '';
                $data['casesCount'] = 0;
                $this->session->set_flashdata('message', 'Please Select District Before Proceed.');
                $data['_view'] = 'SettlementView/Dept/AllPendingCaseListUnderDptPerpetual';
                $this->load->view('layouts/main', $data);
            } else {

                $this->db2 =  $this->dbswitch2($dist_code);
                $meeting = $this->basundharaMb2Perpetualmodel->getMeetingListByDist($this->db2,$dist_code);
                $data['meetingList']      = $meeting->result();

                $this->db = $this->load->database('db2', TRUE);
                $ast = ASSISTANT_USERCODE;
                $sec = UNDER_SEC_USERCODE;
                $data['ast_list'] = $this->db->query("SELECT name,user_code,email,designation FROM depart_users WHERE designation in ('$ast','$sec')",array())->result();
                log_message('error','--'.$this->db->last_query());
                $cabIdList = $this->basundharaMb2Perpetualmodel->getCabinetIdList($dist_code,$user_code)->result();

                $data['cabIdList'] = $cabIdList;

                $data['_view'] = 'SettlementView/Dept/AllPendingCaseListUnderDptPerpetual';
                $this->load->view('layouts/main', $data);
            }
        } else {
            echo "User Not Authorized to View this Page";
        }
    }




}
