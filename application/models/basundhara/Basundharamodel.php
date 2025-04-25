<?php
class Basundharamodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->dbswitch();
        // $this->db2 = $this->load->database('kamrup', TRUE);

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

    // Approve/Revert by Department
    public function departmentChangeStatus($data1, $case_no)
    {
        $this->db2->set($data1)->where('applid', $case_no)->update('settlement_basic');
        return $this->db2->affected_rows();
    }

    // Get Data From Settlemet_basic 
    function getSettlementBasic($case_no)
    {
        //var_dump($this->db2);
        $this->db2->select('*');
        $this->db2->from('settlement_basic');
        $this->db2->where('case_no', $case_no);
        $data = $this->db2->get()->row_array();
        //echo $this->db2->last_query();
        return $data;
    }

    // Get RTPS application_no matching with dharitree case_no 
    function getRtpsNo($case_no)
    {

        $this->db2->select('basundhara');
        $this->db2->from('basundhar_application');
        $this->db2->where('dharitree', $case_no);
        return $this->db2->get()->row_array();
    }
    // Get Data From Settlemet_applicant
    function getSettlementApplicant($case_no)
    {

        $query = "SELECT * FROM settlement_applicant WHERE case_no = '$case_no'";
        $data = $this->db2->query($query)->result();
        return $data;
    }
    function getSettlementEncroacher($case_no)
    {

        $query = "SELECT * FROM settlement_applicant WHERE pdar_type='EN' and case_no = '$case_no'";
        $data = $this->db2->query($query)->row();
        return $data;
    }

    // Get Data From settlement_proceeding 
    function getSettlementProceeding($case_no)
    {

        $query = "SELECT * FROM settlement_proceeding WHERE case_no = '$case_no' ORDER BY date_entry DESC";
        $data = $this->db2->query($query)->result();
        return $data;
    }

    // Get Data From settlement_ap_lmnote 
    function getSettlementLmNote($case_no)
    {

        $query = "SELECT * FROM settlement_ap_lmnote WHERE case_no = '$case_no'";
        $data = $this->db2->query($query)->result();
        return $data;
    }

    // Get Data From settlement_dag_details 
    function getSettlementDagDetails($case_no)
    {

        $this->db2->select('*');
        $this->db2->from('settlement_dag_details');
        $this->db2->where('case_no', $case_no);
        return $this->db2->get()->row_array();
    }


    // Get Data From supportive_document 
    function getSupportiveDocuments($case_no)
    {
        $query = "SELECT * FROM supportive_document WHERE case_no = '$case_no'";
        $data = $this->db2->query($query)->result();
        return $data;
    }


    // Get Data From settlement_dag_details 
    function getSettlementDagArea($case_no)
    {

        $this->db2->select('*');
        $this->db2->from('settlement_dag_details');
        $this->db2->where('case_no', $case_no);
        return $this->db2->get()->result();
    }

    // Get service wise pending cases based on service type 
    public function alldepartmentRequest($service)
    {
        $pendingofficer = MB_DEPARTMENT;
        $status = MB_PENDING;
        $sql = " Select * ,CASE
                WHEN (service_code = '13') THEN 'SETTLEMENT TENANT'
                WHEN (service_code = '14') THEN 'SETTLEMENT AP TRANSFER'
                WHEN (service_code = '15') THEN 'SETTLEMENT TRIBAL COMMUNITY'
                WHEN (service_code = '16') THEN 'SETTLEMENT KHAS LAND'
                WHEN (service_code = '17') THEN 'SETTLEMENT PGR VGR LAND'
                WHEN (service_code = '18') THEN 'SETTLEMENT SPECIAL CULTIVATORS'
                END AS service
                FROM settlement_basic WHERE service_code='$service' AND status='$status' AND pending_officer='$pendingofficer' ORDER BY case_no";
        // WHEN settlement_dag_details.is_urban='N' THEN 'Rural'
        // ELSE 'Urban'
        return  $this->db2->query($sql)->result_array();
    }

    // Get Cases Approved by department
    public function alldepartmentApprovedCases($service)
    {
        $pendingofficer = MB_CIRCLE_OFFICER;
        $fromoffice = MB_DEPARTMENT;
        $dept_approval = DPT_APPROVED;
        $status = MB_PAYMENT_REQUEST;

        $sql = " Select * ,CASE
                WHEN (service_code = '13') THEN 'SETTLEMENT TENANT'
                WHEN (service_code = '14') THEN 'SETTLEMENT AP TRANSFER'
                WHEN (service_code = '15') THEN 'SETTLEMENT TRIBAL COMMUNITY'
                WHEN (service_code = '16') THEN 'SETTLEMENT KHAS LAND'
                WHEN (service_code = '17') THEN 'SETTLEMENT PGR VGR LAND'
                WHEN (service_code = '18') THEN 'SETTLEMENT SPECIAL CULTIVATORS'
                END AS service
               from settlement_basic where service_code='$service' and status ='$status' and pending_officer='$pendingofficer' and from_office='$fromoffice'";
        return  $this->db2->query($sql)->result_array();
    }



    ///////////////////////Post API Basundhara///////////////////

    function postApiBasundhara($rtpsno, $case, $rmk, $status, $task, $pen)
    {
        // $caseRtpsBasu = $this->checkRtpsService($rtpsno);
        // if ($caseRtpsBasu == 'RTPS') {
        //     $apilink = RTPS_API_LINK;
        // } else {
        //     $apilink = API_LINK;
        // }

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, API_LINK . "applicationStatusUpdate");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'application' => $rtpsno,
            'dharitree' => $case,
            'rmk' => $rmk,
            'status' => $status,
            'task' => $task,
            'pen' => $pen,
            'ip' => '10.177.7.141'
        )));
        $result = curl_exec($curl_handle);
        $httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        if ($httpcode != 200) {
            log_message("error", " Curl-Error in api: " . API_LINK . "applicationStatusUpdate with json_data: "
                . json_encode(array(
                    'application' => $rtpsno,
                    'dharitree' => $case,
                    'rmk' => $rmk,
                    'status' => $status,
                    'task' => $task,
                    'pen' => $pen
                )));
            return false;
        }
        curl_close($curl_handle);
        return $result;
    }

    function checkRtpsService($case)
    {
        $sql = "SELECT basundhara FROM basundhar_application WHERE basundhara=? and (basundhara is not null or basundhara='') ";
        $dataFound = $this->db2->query($sql, $case)->row();
        if ($dataFound) {
            $data = $dataFound->basundhara;
            $var = explode('/', $data);
            $service = $var['0'];
        } else {
            $service = null;
        }
        return $service;
    }


    // Newly Added on 08/09/2022
    // get all applicant buyers
    public function getAllApplicantBuyers($case)
    {
        $applicants = $this->db2->select()
            ->where('case_no', $case)
            ->where('pdar_type', PDAR_BUYER)
            ->get('settlement_applicant');
        return $applicants->result();
    }


    // get all applicant owners
    public function getAllApplicantOwners($case)
    {
        $applicants = $this->db2->select()
            ->where('case_no', $case)
            ->where('pdar_type', PDAR_OWNER)
            ->get('settlement_applicant');
        return $applicants->result();
    }

    // get all applicant encroacher
    public function getAllApplicantEncroacher($case)
    {
        $applicants = $this->db2->select()
            ->where('case_no', $case)
            ->where('pdar_type', PDAR_ENC)
            ->get('settlement_applicant');
        return $applicants->result();
    }

    // get all applicant riotee nok
    public function getAllApplicantRioteeNok($case)
    {
        $applicants = $this->db2->select()
            ->where('case_no', $case)
            ->where_in('pdar_type', [PDAR_GP, PDAR_GGP])
            ->get('settlement_applicant');
        return $applicants->result();
    }
    // get all settlement dag
    public function getSettlementDag($case)
    {
        $dags = $this->db2->select()
            ->where('case_no', $case)
            ->get('settlement_dag_details');

        return $dags->row_array();
    }


    // Get Roadsise & Family Reservation 

    public function getSettlementRoadsideReservation($case)
    {
        $applicants = $this->db2->select()
            ->where('case_no', $case)
            ->where('type', RESERVE_ROADSIDE)
            ->get('settlement_reservation');
        return $applicants->result();
    }

    public function getSettlementFamilyReservation($case)
    {
        $applicants = $this->db2->select()
            ->where('case_no', $case)
            ->where('type', RESERVE_FAMILY)
            ->get('settlement_reservation');
        return $applicants->result();
    }

    public function getSettlementVgrReservation($case)
    {
        $applicants = $this->db2->select()
            ->where('case_no', $case)
            // ->where('type', RESERVE_VGR)
            ->get('settlement_vgr_pgr_reservation');
        return $applicants->result();
    }



    // All Department Request

    public function getDepartmentRequest($service, $dist_list)
    {
        $url = API_LINK . "getDepartmentCasesByDistricts/$service/?dist_codes=" . $dist_list;

        // $url = API_LINK . "getDepartmentCases/$service/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array()));

        $output = curl_exec($ch);
        curl_close($ch);
        $district = json_decode($output);
        return $district;
    }


    // Newly Added on 31/10/22

    public function getCasesByCaseNo($caseNo)
    {
        $this->db2->select('*');
        $this->db2->from('settlement_basic');
        $this->db2->where('case_no', $caseNo);
        $this->db2->where('service_code !=', SETTLEMENT_TENANT_ID);
        $data = $this->db2->get();
        return $data;
    }

    public function getCasesByApplicationNo($applicationNo)
    {
        $this->db2->select('*');
        $this->db2->from('settlement_basic');
        $this->db2->where('applid', $applicationNo);
        $this->db2->where('service_code !=', SETTLEMENT_TENANT_ID);
        $data = $this->db2->get();
        return $data;
    }


    // get all data without date range
    public function getCasesByRespectedData($serviceType, $appStatus, $pendingOffice, $fromDate, $toDate, $cir_code)
    {

        $this->db2->select('*');
        $this->db2->from('settlement_basic');
        if ($serviceType != '') {
            $this->db2->where('service_code', $serviceType);
        }
        if ($appStatus != '') {
            $this->db2->where('status', $appStatus);
        }
        if ($pendingOffice != '') {
            $this->db2->where('pending_officer', $pendingOffice);
        }
        if ($fromDate != '') {
            $this->db2->where('DATE(submission_date)', $fromDate);
        }
        if ($toDate != '') {
            $this->db2->where('DATE(submission_date)', $toDate);
        }
        if ($cir_code != '') {
            $this->db2->where('cir_code', $cir_code);
        }
        $data = $this->db2->get();
        return $data;
    }

    // get all data with date range
    public function getCasesByRespectedDataWithDateRage($serviceType, $appStatus, $pendingOffice, $fromDate, $toDate,$cir_code)
    {
        $this->db2->select('*');
        $this->db2->from('settlement_basic');
        if ($serviceType != '') {
            $this->db2->where('service_code', $serviceType);
        }
        if ($appStatus != '') {
            $this->db2->where('status', $appStatus);
        }
        if ($pendingOffice != '') {
            $this->db2->where('pending_officer', $pendingOffice);
        }
        if($cir_code != '')
        {
            $this->db2->where('cir_code', $cir_code);
        }

        $this->db2->where('DATE(submission_date) >=', $fromDate);
        $this->db2->where('DATE(submission_date) <=', $toDate);

        $data = $this->db2->get();
        return $data;
    }


    // Get all Proposal list by SDLAC under Dept
    public function getAllProposalList($service)
    {
        $this->db2->select('*');
        $this->db2->from('settlement_proposal_list');
        $this->db2->where('service_code', $service);
        $this->db2->where('status', 1);
        // $this->db2->where('dist_code', $dist_code);
        $data = $this->db2->get();
        return $data;
    }

    // Premium Data

    public function getSettlementPremium($case_no)
    {
        $premium = $this->db2->query("SELECT sp.*,spa.area,spl.land_type,spr.house_type FROM settlement_premium sp inner join settlement_premium_area spa on spa.paid=sp.area_name inner join settlement_premium_land_type spl on spl.plid=sp.land_type inner join settlement_premium_rate spr on spr.prid=sp.rate_type where case_no='$case_no' and is_final=1");
        return $premium->result();
    }



    // getting the VLB encroacher details -js- 29-aug-22
    public function getEncroacherDetails($dist_code, $subdiv_code, $circle_code, $mouza_code, $lot_no, $vill_townprt_code, $dag_no)
    {
        $vlb = $this->db2->select()
            ->WHERE('dist_code', $dist_code)
            ->WHERE('subdiv_code', $subdiv_code)
            ->WHERE('cir_code', $circle_code)
            ->WHERE('mouza_pargona_code', $mouza_code)
            ->WHERE('lot_no', $lot_no)
            ->WHERE('vill_townprt_code', $vill_townprt_code)
            ->WHERE('dag_no', $dag_no)
            ->GET('c_land_bank_details');
        if ($vlb->num_rows() > 0) {
            return $vlb->row();
        } else {
            return FALSE;
        }
    }
    public function getEncroacherInDag($end_id)
    {
        $enc_details = $this->db2->select()
            ->WHERE('c_land_bank_details_id', $end_id)
            ->GET('c_land_bank_encroacher_details');
        if ($enc_details->num_rows() > 0) {
            return $enc_details->result();
        } else {
            return FALSE;
        }
    }




    // Get Proposal data by dist and service type
    // get all data without date range
    public function getProposalsByRespectedData($serviceType)
    {

        $this->db2->select('*');
        $this->db2->from('settlement_proposal_list');
        if ($serviceType != '') {
            $this->db2->where('service_code', $serviceType);
        }
        // $this->db2->where('status', 1);
        $this->db2->where('dept_status !=', 0);
        $data = $this->db2->get();
        return $data;
    }


    // get all case under selected proposal in Dept
    public function getAllCasesUnderProposalDept($proposal_no)
    {
        $this->db2->select('*');
        $this->db2->from('settlement_proposal_cases');
        $this->db2->where('proposal_id', $proposal_no);
        // $this->db2->where('dept_status', DEPT_PROPOSAL_CASE_PENDING);
        $data = $this->db2->get();
        return $data;
    }

    // get approved case under selected proposal in Dept
    public function getArrovedCasesUnderProposalDept($proposal_no)
    {
        $this->db2->select('*');
        $this->db2->from('settlement_proposal_cases');
        $this->db2->where('proposal_id', $proposal_no);
        $this->db2->where('dept_status', DEPT_PROPOSAL_CASE_APPROVE);
        $data = $this->db2->get();
        return $data;
    }



    // count proposal no with case no
    public function countApplicationDetailsByAppNo($case)
    {
        return $this->db2->select('case_no')
            ->where('applid', $case)
            ->get('settlement_basic')
            ->num_rows();
    }

    // get proposal no with case no
    public function getApplicationDetailsByAppNo($case)
    {
        return $this->db2->select('case_no')
            ->where('applid', $case)
            ->get('settlement_basic')
            ->row();
    }

    // count proposal no with case no
    public function countProposalIdByCaseNo($case)
    {
        return $this->db2->select('proposal_id')
            ->where('case_no', $case)
            ->get('settlement_proposal_cases')
            ->num_rows();
    }

    // get proposal no with case no
    public function getProposalIdByCaseNo($case)
    {

        $sql =    "SELECT spc.proposal_id,spl.proposal_name
                        FROM settlement_proposal_cases as spc
                        JOIN settlement_proposal_list AS spl ON spc.proposal_id = spl.id
                        WHERE spc.case_no='$case'";
        $data  = $this->db2->query($sql, array($case));
        return $data->result();
    }



    // Get Additional Property By Case No
    function getSettlementAdditionalProperty($case_no)
    {

        $query = "SELECT * FROM settlement_additional_property WHERE case_no = '$case_no'";
        $data = $this->db2->query($query)->result();
        return $data;
    }






    // update settlement Basic table
    public function updateSettlementBasicData($caseNo, $data)
    {
        $this->db2->where('case_no', $caseNo);
        $this->db2->set('date_update', 'NOW()', FALSE);
        $this->db2->update('settlement_basic', $data);
        return $this->db2->affected_rows();
    }

    // update settlement Basic table
    public function updateProposalData($caseNo, $data)
    {
        $this->db2->where('case_no', $caseNo);
        $this->db2->update('settlement_proposal_cases', $data);
        return $this->db2->affected_rows();
    }


    // get proposal details by id
    public function getProposalDetailsById($proposal_no, $dist_code)
    {
        $this->db2->select('*');
        $this->db2->from('settlement_proposal_list');
        $this->db2->where('id', $proposal_no);
        $this->db2->where('dist_code', $dist_code);
        $this->db2->where('status', 1);
        $data = $this->db2->get()->row();

        return $data;
    }


    ///for co settlements
    function getApplicationNoByCaseNo($dbb,$case_no)
    {
        $query = "SELECT * FROM settlement_basic WHERE case_no = '$case_no'";
        $data = $dbb->query($query)->row();
        return $data;
    }


    public function getSdlacProposalsByService($serviceType, $sdlac_user_code)
    {
        $member_report_status = SDLAC_MEMBER_REPORT_STATUS_PENDING;
        $meeting_status = SDLAC_MEETING_STATUS_ONLINE;
         $sql =    "SELECT smr.proposal_no,smr.service_code,smr.created_at,
                        smr.username,spl.proposal_name,pml.expiry_hour_start_time,spl.h_date
                        FROM settlement_sdlac_member_report as smr
                        JOIN settlement_proposal_list AS spl ON smr.proposal_no = spl.id
                        JOIN proposal_meeting_list AS pml ON spl.proposal_meeting_id = pml.id
                        WHERE smr.service_code=? AND smr.username =?
                        AND smr.status =? AND smr.meeting_attend_status =?";
        $data  = $this->db2->query($sql, array($serviceType, $sdlac_user_code,$member_report_status,$meeting_status));
        return $data;
    }



    // View all case under selected proposal in SDLAC Login
    public function getAllCasesUnderProposalSdlac($proposal_no)
    {
        $this->db2->select('*');
        $this->db2->from('settlement_proposal_cases');
        $this->db2->where('proposal_id', $proposal_no);
        // $this->db2->where('status', '2');
        $data = $this->db2->get();
        return $data;
    }




    // update settlement SDLAC memeber table
    public function updateSettlementSdlacMemberReport($proposal_no, $dist_code, $service_code, $sdlac_user_code, $data)
    {

        $this->db2->where('proposal_no', $proposal_no);
        $this->db2->where('dist_code', $dist_code);
        $this->db2->where('username', $sdlac_user_code);
        $this->db2->where('service_code', $service_code);
        $this->db2->where('status', SDLAC_MEMBER_REPORT_STATUS_PENDING);
        $this->db2->update('settlement_sdlac_member_report', $data);
        return $this->db2->affected_rows();
    }



    // update settlement Proposal List table
    public function updateSettlementProposalList($proposal_no, $dist_code, $service_code, $data)
    {
        $this->db2->where('id', $proposal_no);
        $this->db2->where('dist_code', $dist_code);
        $this->db2->where('service_code', $service_code);
        $this->db2->update('settlement_proposal_list', $data);
        return $this->db2->affected_rows();
    }

    // newly added
    public function getRemainingCasesUnderProposalDept($proposal_no)
    {
        $this->db2->select('*');
        $this->db2->from('settlement_proposal_cases');
        $this->db2->where('proposal_id', $proposal_no);
        $this->db2->where('dept_status', DEPT_PROPOSAL_CASE_PENDING);
        $data = $this->db2->get();
        return $data;
    }



    // Get ALL SDLAC Proposal Meeting List

    public function getSdlacProposalsMeetingByService($dist_code,$serviceType, $sdlac_user_code)
    {

        $this->db2->select('*');
        $this->db2->from('settlement_proposal_list');
        if ($serviceType != '') {
            $this->db2->where('service_code', $serviceType);
        }
        $this->db2->where('dist_code', $dist_code);
        $this->db2->where('status', 1);
        $this->db2->where_in('sdlac_prceed_status', [0]);
        $this->db2->where('final_verify_status', 0);
        $this->db2->order_by("id", "asc");
        $data = $this->db2->get();
        return $data;
    }


    // Newly Add For Case Search

    public function getCirCodeJSON($dist_code)
    {

        $district = $this->db2->query("select * from location where dist_code =?  and "
            . " subdiv_code!='00' and cir_code!='00' and mouza_pargona_code='00' and "
            . " vill_townprt_code='00000' and lot_no='00'", array($dist_code));
        return $district->result();
    }



    public function getcirclebyDistCode($dist_code)
    {

        $district = $this->db2->query("select * from location where dist_code =?  and "
            . " subdiv_code!='00' and cir_code!='00' and mouza_pargona_code='00' and "
            . " vill_townprt_code='00000' and lot_no='00'", array($dist_code));
        return $district;
    }


    public function getDeletedDags($case_no)
    {

        $this->db2->select('*');
        $this->db2->from('settlement_deleted_data');
        $this->db2->where('table_name', 'settlement_dag_details');
        $this->db2->where('case_no', $case_no);
        return $this->db2->get()->result();
    }

    public function getDeletedEncroacher($case_no)
    {
        
        $this->db2->select('*');
        $this->db2->from('settlement_deleted_data');
        $this->db2->where('table_name', 'settlement_applicant');
        $this->db2->where('case_no', $case_no);
        return $this->db2->get()->result();
    }

    public function viewSdlacSearchData($start,$length,$order,$search_val,$cir_code,$serviceType,$appStatus,$caseNo,$applicationNo,$pendingOffice,$fromDate,$toDate)
    {
        $searchByCol_0 = $search_val;
        $col = 0;
        $dir = "";
        if(!empty($order)){
            foreach($order as $o){
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if($dir != "asc" && $dir != 'desc'){
            $dir = 'desc';
        }
        if($order != null){
            $this->db2->order_by($order, $dir);
        }
        if(!empty($searchByCol_0)){
            $this->db2->like('case_no', $searchByCol_0);
        }


        $this->db2->select('*');
        if(!empty($cir_code)){
        $this->db2->where('cir_code', $cir_code);
        }
         if(!empty($serviceType)){
        $this->db2->where('service_code', $serviceType);
        }
         if(empty($serviceType)){
        $this->db2->where('service_code !=', SETTLEMENT_TENANT_ID);
        }
        if ($appStatus != '') {
            $this->db2->where('status', $appStatus);
        }
        if ($caseNo != '') {
            $this->db2->where('case_no', $caseNo);
        }
        if ($applicationNo != '') {
            $this->db2->where('applid', $applicationNo);
        }
         if ($fromDate != '') {
            $this->db2->where('DATE(submission_date) >=', $fromDate);
        }
        if ($toDate != '') {
            $this->db2->where('DATE(submission_date) <=', $toDate);
        }
        if ($pendingOffice != '') {
            $this->db2->where('pending_officer', $pendingOffice);
        }
        $this->db2->order_by('case_no', 'asc');
        $this->db2->limit($length, $start);
        $query = $this->db2->get('settlement_basic');
        if($query->num_rows()>0){
            $data['data_results'] = $query->result();
            if(!empty($searchByCol_0)){
                $this->db2->like('case_no', $searchByCol_0);
            }
        if(!empty($cir_code)){
            $this->db2->where('cir_code', $cir_code);
        }
        if(!empty($serviceType)){
        $this->db2->where('service_code', $serviceType);
        }
        if(empty($serviceType)){
        $this->db2->where('service_code !=', SETTLEMENT_TENANT_ID);
        }
        if ($caseNo != '') {
            $this->db2->where('case_no', $caseNo);
        }
        if ($applicationNo != '') {
            $this->db2->where('applid', $applicationNo);
        }
        if ($fromDate != '') {
            $this->db2->where('DATE(submission_date) >=', $fromDate);
        }
        if ($toDate != '') {
            $this->db2->where('DATE(submission_date) <=', $toDate);
        }
         if ($pendingOffice != '') {
            $this->db2->where('pending_officer', $pendingOffice);
        }
        if ($appStatus != '') {
            $this->db2->where('status', $appStatus);
        }
            $data['total_records']= $this->db2->count_all_results('settlement_basic');
            return $data;
        }
    }



    public function getJsonDataFromBackup($case_no)
    {
        $sql = $this->db2->query("SELECT data FROM settlement_backup_json WHERE case_no = ? AND status = ?", array($case_no, 'I'));
        if($sql->num_rows() > 0){
            return $sql->row();
        }
        else
        {
            return false;
        }
    }


    //Get All Proposal List Under SDLAC
    public function getSdlacProposalsByServiceOnlineOffline($serviceType, $sdlac_user_code)
    {

        // $sql = "SELECT smr.proposal_no,smr.service_code,smr.created_at,h_date,
        //                 smr.username,spl.proposal_name,pml.expiry_hour_start_time
        //                 FROM settlement_sdlac_member_report as smr
        //                 JOIN settlement_proposal_list AS spl ON smr.proposal_no = spl.id
        //                 JOIN proposal_meeting_list AS pml ON spl.proposal_meeting_id = pml.id
        //                 WHERE smr.service_code=? AND smr.username =?";
        $sql = "select * from settlement_proposal_list where service_code=?";
        $data  = $this->db2->query($sql, array($serviceType));
        return $data;
    }


    //Get All Meeting By District Under Dept
    public function getMeetingsByDistrict()
    {
        $this->db2->select('*');
        $this->db2->from('proposal_meeting_list');
        $this->db2->where('dc_approve_status', 1);
        $this->db2->where('adc_forward_to_dc_status', 1);
        $this->db2->where('digital_sign_status', DIGITAL_SIGN_STATUS);
        $data = $this->db2->get();
        return $data;
    }


    //Get all Proposal List under Meeting no Dept
    public function getProposalsByMeeting($meeting_id)
    {
        $this->db2->select('*');
        $this->db2->from('settlement_proposal_list');
        $this->db2->where('proposal_meeting_id', $meeting_id);
        $data = $this->db2->get();
        return $data;
    }


    //Get all Cases list under Proposal No 

    public function getAllCasesUnderProposal($proposal_no)
    {

        $pending_officer = MB_DEPARTMENT;
        $from_office = MB_DEPUTY_COMM;

        $sql = "SELECT sc.*,sb.dept_approval FROM settlement_proposal_cases as sc INNER JOIN settlement_basic sb on sb.case_no = sc.case_no WHERE sb.pending_officer = ? AND sb.from_office = ? AND sb.dept_approval is NULL AND  sc.proposal_id = ?";
        $data  = $this->db2->query($sql, array($pending_officer, $from_office, $proposal_no));
        return $data;
    }


    
    function downloadExcelReport($filename, $result_array)
    {
        require_once 'application/libraries/Xlsxwriter.class.php';
        ini_set('display_errors', 1);
        ini_set('log_errors', 1);
        // var_dump($result_array[0]);
        //$head_array[] = array_keys($result_array[0]);
        foreach ($result_array[0] as $key => $head) {
            $final_head[$key] = 'string';
        }
        $styles1 = array(
            'font' => 'Arial', 'font-size' => 14, 'font-style' => 'bold', 'fill' => '#FFFF00',
            'halign' => 'center', 'border' => 'left,right,top,bottom'
        );
        $styles7 = array('border' => 'left,right,top,bottom');
        header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        //header("Content-Type: application/vnd.ms-excel");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        ob_clean();
        $writer = new XLSXWriter();
        $writer->setAuthor('Dharitree');
        $writer->writeSheetHeader('Sheet1', $final_head, $styles1);
        foreach ($result_array as $row)
            $writer->writeSheetRow('Sheet1', (array)$row, $styles7);
        ob_end_clean();
        $writer->writeToStdOut();
        exit(0);
    }


    function getTraceMap($case_no)
    {
        $query = "SELECT * FROM supportive_document WHERE case_no = '$case_no' and file_name in ('Trace Map','Trace Map Copy')";
        $data = $this->db2->query($query)->result();
        return $data;
    }
    function getFieldReport($case_no)
    {
        $query = "SELECT * FROM supportive_document WHERE case_no = '$case_no' and file_name in ('Field Report')";
        $data = $this->db2->query($query)->result();
        return $data;
    }


    function getGeoTag($case_no)
    {
        $query = "SELECT * FROM supportive_document WHERE case_no = '$case_no' and file_name ='Geo Tag Photo'";
        $data = $this->db2->query($query)->result();
        return $data;
    }


    //newly added
    public function countSettlementApplicationDetailsByCaseNo($caseNo, $dist_code)
    {

        return $this->db2->select()
            ->where('case_no', $caseNo)
            ->where('dist_code', $dist_code)
            ->where('pending_officer', MB_DEPARTMENT)
            ->get('settlement_basic')
            ->num_rows();
    }




    public function updateSettlementBasicForCab($dbb,$caseNo, $dist_code, $data)
    {
        $dbb->where('case_no', $caseNo);
        $dbb->where('dist_code', $dist_code);
        $dbb->where('pending_officer', MB_DEPARTMENT);
        $dbb->set('date_update', 'NOW()', FALSE);
        $dbb->update('settlement_basic', $data);
        return $dbb->affected_rows();
    }


    public function viewCabinetCaseList($start, $length, $order, $dist_code)
    {
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $this->db->order_by($order, $dir);
        }

        $this->db->select('*');
        if ($dist_code != null) {
            $this->db->where('dist_code', $dist_code);
        }
        $this->db->where('status', 1);

        $this->db->limit($length, $start);
        $query = $this->db->get('cab_recommendation_list');
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

            if ($dist_code != null) {
                $this->db->where('dist_code', $dist_code);
            }
            $this->db->where('status', 1);

            $data['total_records'] = $this->db->count_all_results('cab_recommendation_list');
            return $data;
        }
    }



    public function getAllCasesUnderProposal2($start, $length, $order, $proposal_no)
    {

        $pending_officer = MB_DEPARTMENT;
        $from_office = MB_DEPUTY_COMM;

        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $this->db2->order_by($order, $dir);
        }

        $this->db2->select('sc.*, sb.dept_approval');
        $this->db2->join('settlement_basic sb', 'sb.case_no = sc.case_no');
        $this->db2->from('settlement_proposal_cases as sc');
        $this->db2->where('sb.pending_officer', $pending_officer);
        $this->db2->where('sb.from_office', $from_office);
        $this->db2->where('sb.dept_approval IS NULL');
        $this->db2->where('sc.proposal_id', $proposal_no);


        $this->db2->limit($length, $start);
        $query = $this->db2->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

            $this->db2->from('settlement_proposal_cases as sc'); // Define 'sc' alias in FROM clause
            $this->db2->join('settlement_basic sb', 'sb.case_no = sc.case_no');
            $this->db2->where('sb.pending_officer', $pending_officer);
            $this->db2->where('sb.from_office', $from_office);
            $this->db2->where('sb.dept_approval IS NULL');
            $this->db2->where('sc.proposal_id', $proposal_no);

            $data['total_records'] = $this->db2->count_all_results();
            return $data;
        }
    }




    public function getAllApplicantBuyersName($case)
    {

        // $sql = "select string_agg(pdar_name,',') as pdar_name from settlement_applicant where case_no =? and pdar_type =?";
        $sql = "select * from settlement_applicant where case_no =? and pdar_type =?";
        $data  = $this->db2->query($sql, array($case, 'B'));
        return $data;
    }

    public function getZonalValue($dist_code, $uuid, $dag_no)
    {

        $sql = "SELECT vz.land_rate FROM dagwise_zone_info dz LEFT JOIN villagewise_zone_info vz ON dz.unique_village_code = vz.unique_village_code
                    WHERE dz.flag = '1' AND dz.dist_code = '$dist_code' AND dz.unique_village_code = '$uuid' AND dz.dag_no = '" . trim($dag_no) . "'
                    AND vz.zone_code::int = dz.zone_id::int AND vz.subclass_code::int = dz.subclass_id::int";
        $data = $this->db2->query($sql);
        return $data;
    }


    public function getAllAppliedDags($case)
    {

        // $sql = "select string_agg(dag_no,',') as dag_no from settlement_dag_details where case_no =?";
        $sql = "select * from settlement_dag_details where case_no =?";
        $data  = $this->db2->query($sql, array($case));
        return $data;
    }


    public function sdlacCaseStatus($case)
    {

        $sql = "Select *, CASE WHEN (case_status = '1') THEN 'Yes' WHEN (case_status = '2') THEN 'No' END AS case_status from settlement_proposal_cases where case_no=?";
        $data  = $this->db2->query($sql, array($case));
        return $data;
    }

    function getLandLessVerify($case)
    {
        $sql = "SELECT is_landless FROM settlement_ap_lmnote WHERE case_no = ?";
        $data  = $this->db2->query($sql, array($case));
        return $data;
    }


    public function getDagAreaConcated($case)
    {

        $sql = "SELECT CONCAT_WS(',', dag_area_b, dag_area_k, dag_area_lc) AS dag_area FROM settlement_dag_details
        WHERE case_no =?";
        $data  = $this->db2->query($sql, array($case));
        return $data;
    }


    public function getCabMemoIdByUserCode($user_code, $dist_code,$status)
    {

        $sql = "select cab_id from cab_id_list where user_code =? and dist_code=? and status in (?,?)";
        $data  = $this->db->query($sql, array_merge([$user_code, $dist_code], $status));
        return $data;
    }


    public function updateCabStatus($dbb,$where, $updateData)
    {
        $dbb->set($updateData)->where($where)->update('cab_id_list');
        return $dbb->affected_rows();
    }


    public function checkForCaseExist($case_no)
    {

        $sql = "select case_no from cab_memo_list where case_no = ?";
        $data  = $this->db->query($sql, array($case_no));
        return $data;
    }



    public function getCabinetIdList($dist_code,$user_code)
    {
        $sql = "select * from cab_id_list where dist_code =? and user_code =? and status in (?, ?) and nc is null and offline is null";
        $data  = $this->db->query($sql, array($dist_code,$user_code,GENERATED_CAB_ID,ADD_CASES_UNDER_CAB_ID));
        return $data;
    }


    public function getCasesUnderCabMemo($dbb,$cab_memo_id)
    {

        $sql = "select case_no from cab_memo_list where cab_id = ? and final_status != ? and final_submit_status =?";
        $data  = $dbb->query($sql, array($cab_memo_id,TEMP_REVERT_BY_DEPT,0));
        return $data;
    }


    public function getDistrictUnderCabMemo($dbb,$cab_memo_id)
    {

        $sql = "select distinct dist_code from cab_memo_list where cab_id = ?";
        $data  = $dbb->query($sql, array($cab_memo_id));
        return $data;
    }


    public function clearCabDetails()
    {
        $sql = "truncate table cab_id_list, cab_memo_list";
        $data  = $this->db->query($sql);
        
        $sql = "truncate table mb3_cabinet_list, mb3_case_list";
        $data  = $this->db->query($sql);
        
        return $data;
    }


    public function getCasesUnderDistCabMemo($dist_code)
    {

        $sql = "select case_no from cab_memo_list where dist_code = ?";
        $data  = $this->db->query($sql, array($dist_code));
        return $data;
    }



    public function clearBasicData($where, $updateData)

    {
        $this->db2->set($updateData)->where($where)->update('settlement_basic');
        return $this->db2->affected_rows();
    }



    public function getAllCasesUnderDepartment($start, $length, $order, $service_code,$meeting_no,$verification)
    {

        $pending_officer = MB_DEPARTMENT;
        $from_office = MB_DEPUTY_COMM;

        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $this->db2->order_by($order, $dir);
        }

        $this->db2->select('sc.*,sl.id as proposal_id,sl.proposal_name,sm.meeting_name,sm.id as meeting_id, sb.dept_approval,sb.verified_by_asst,sb.service_code');
        $this->db2->from('settlement_proposal_cases as sc');
        $this->db2->join('settlement_basic sb', 'sb.case_no = sc.case_no');
        $this->db2->join('settlement_proposal_list sl', 'sl.id = sc.proposal_id');
        $this->db2->join('proposal_meeting_list sm', 'sm.id = sl.proposal_meeting_id');
        $this->db2->where('sb.pending_officer', $pending_officer);


        if ($service_code != NULL) {
            $this->db2->where('sb.service_code', $service_code);
        }

         if ($verification != NULL) {
            $this->db2->where('sb.verified_by_asst', $verification);
        }

         if ($meeting_no != NULL) {
            $this->db2->where('sm.id', $meeting_no);
        }

        $this->db2->where('sb.from_office', $from_office);
        $this->db2->where('sb.cab_memo_prepared', ADD_CASES_TO_CAB_MEMO);
        $this->db2->where('sb.dept_approval IS NULL');
        $this->db2->where('sm.digital_sign_status', DIGITAL_SIGN_STATUS);

        $this->db2->limit($length, $start);

        $data = $this->db2->get();
        return $data;
    }


    //New Tested

    public function getAllCasesUnderDepartmentAll($dbb,$start, $length, $order, $service_code,$meeting_no,$verification,$pullRequest)
    {
        $pending_officer = MB_DEPARTMENT;
        $from_office = MB_DEPUTY_COMM;
        $searchByCol_0 = strtoupper($this->input->post('columns')[1]['search']['value']);
        if(!empty($searchByCol_0)){
            $dbb->where('sb.case_no like \'%'.$searchByCol_0.'%\'');

        }
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }

        $dbb->select('sc.*,sl.id as proposal_id,sl.proposal_name,sm.meeting_name,sm.id as meeting_id, sb.dept_approval,sb.verified_by_asst,sb.service_code,sb.pull_request,sb.verified_ast_remarks,sb.dept_revert');
        $dbb->from('settlement_proposal_cases as sc');
        $dbb->join('settlement_basic sb', 'sb.case_no = sc.case_no');
        $dbb->join('settlement_proposal_list sl', 'sl.id = sc.proposal_id');
        $dbb->join('proposal_meeting_list sm', 'sm.id = sl.proposal_meeting_id');
        $dbb->where('sb.pending_officer', $pending_officer);
         if ($service_code != NULL) {
            $dbb->where('sb.service_code', $service_code);
        }

         if ($verification != NULL) {
            $dbb->where('sb.verified_by_asst', $verification);
        }

         if ($meeting_no != NULL) {
            $dbb->where('sm.id', $meeting_no);
        }

         if ($pullRequest != NULL) {
            $dbb->where('sb.pull_request', $pullRequest);
        }

        $dbb->where('sb.from_office', $from_office);
        $dbb->where('sb.cab_memo_prepared', ADD_CASES_TO_CAB_MEMO);
	// $dbb->where('sb.dept_approval IS NULL');
	$dbb->where_in('sb.service_code',array('13','14','15','16','18'));
        $dbb->where('sm.digital_sign_status', DIGITAL_SIGN_STATUS);
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

            $dbb->select('sc.*,sl.id as proposal_id,sl.proposal_name,sm.meeting_name,sm.id as meeting_id, sb.dept_approval,sb.verified_by_asst,sb.service_code,sb.pull_request,sb.verified_ast_remarks,sb.dept_revert');
            $dbb->from('settlement_proposal_cases as sc');
            $dbb->join('settlement_basic sb', 'sb.case_no = sc.case_no');
            $dbb->join('settlement_proposal_list sl', 'sl.id = sc.proposal_id');
            $dbb->join('proposal_meeting_list sm', 'sm.id = sl.proposal_meeting_id');
            $dbb->where('sb.pending_officer', $pending_officer);
         if ($service_code != NULL) {
            $dbb->where('sb.service_code', $service_code);
        }

         if ($verification != NULL) {
            $dbb->where('sb.verified_by_asst', $verification);
        }

         if ($meeting_no != NULL) {
            $dbb->where('sm.id', $meeting_no);
        }
         if ($pullRequest != NULL) {
            $dbb->where('sb.pull_request', $pullRequest);
        }

        $dbb->where('sb.from_office', $from_office);
        $dbb->where('sb.cab_memo_prepared', ADD_CASES_TO_CAB_MEMO);
	// $dbb->where('sb.dept_approval IS NULL');
	$dbb->where_in('sb.service_code',array('13','14','15','16','18'));
        $dbb->where('sm.digital_sign_status', DIGITAL_SIGN_STATUS);
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }

    //New Tested


    public function getMeetingListByDist($dbb,$dist_code)
    {

        $sql = "select distinct ml.id,ml.meeting_name from proposal_meeting_list ml 
                    join settlement_proposal_list pl on pl.proposal_meeting_id = ml.id 
                    join settlement_proposal_cases pc on pc.proposal_id = pl.id
                    join  settlement_basic sb on sb.case_no = pc.case_no where ml.dist_code = ? 
                    and ml.digital_sign_status =? and sb.from_office = ? and sb.cab_memo_prepared =? and sb.service_code not in ('25','35','17')";
        $data  = $dbb->query($sql, array($dist_code, DIGITAL_SIGN_STATUS, MB_DEPUTY_COMM, ADD_CASES_TO_CAB_MEMO));
        return $data;
    }


    public function getAllCasesUnderAssistant($dbb,$start, $length, $order, $service_code,$meeting_no)
    {

        $pending_officer = MB_DEPARTMENT;
        $from_office = MB_DEPUTY_COMM;
        $assign_ast_code = $this->session->userdata('user_code');

        $searchByCol_0 = strtoupper($this->input->post('columns')[0]['search']['value']);
        if(!empty($searchByCol_0)){
            $dbb->where('sb.case_no like \'%'.$searchByCol_0.'%\'');

        }

        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }

        $dbb->select('sc.*,sl.id,sl.proposal_name,sm.meeting_name,sm.id, sb.dept_approval,sb.verified_by_asst,sb.service_code');
        $dbb->from('settlement_proposal_cases as sc');
        $dbb->join('settlement_basic sb', 'sb.case_no = sc.case_no');
        $dbb->join('settlement_proposal_list sl', 'sl.id = sc.proposal_id');
        $dbb->join('proposal_meeting_list sm', 'sm.id = sl.proposal_meeting_id');
        $dbb->where('sb.pending_officer', $pending_officer);

        $dbb->group_start();
        $dbb->where('sb.assign_ast_code', $assign_ast_code);
        $dbb->or_where('sb.assign_ast_code IS NULL');
        $dbb->group_end();

        if ($service_code != NULL) {
            $dbb->where('sb.service_code', $service_code);
        }


         if ($meeting_no != NULL) {
            $dbb->where('sm.id', $meeting_no);
        }

        $dbb->where('sb.from_office', $from_office);
        $dbb->where('sb.cab_memo_prepared', ADD_CASES_TO_CAB_MEMO);
        $dbb->where('sb.verified_by_asst', SENT_FORVERIFICATION);
        // $dbb->where('sb.dept_approval IS NULL');
        $dbb->where('sm.digital_sign_status', DIGITAL_SIGN_STATUS);

        $dbb->limit($length, $start);

        $query = $dbb->get();
        // return $data;

        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

        $dbb->select('sc.*,sl.id,sl.proposal_name,sm.meeting_name,sm.id, sb.dept_approval,sb.verified_by_asst,sb.service_code');
        $dbb->from('settlement_proposal_cases as sc');
        $dbb->join('settlement_basic sb', 'sb.case_no = sc.case_no');
        $dbb->join('settlement_proposal_list sl', 'sl.id = sc.proposal_id');
        $dbb->join('proposal_meeting_list sm', 'sm.id = sl.proposal_meeting_id');
        $dbb->where('sb.pending_officer', $pending_officer);

        $dbb->group_start();
        $dbb->where('sb.assign_ast_code', $assign_ast_code);
        $dbb->or_where('sb.assign_ast_code IS NULL');
        $dbb->group_end();

        if ($service_code != NULL) {
            $dbb->where('sb.service_code', $service_code);
        }


         if ($meeting_no != NULL) {
            $dbb->where('sm.id', $meeting_no);
        }

        $dbb->where('sb.from_office', $from_office);
        $dbb->where('sb.cab_memo_prepared', ADD_CASES_TO_CAB_MEMO);
        $dbb->where('sb.verified_by_asst', SENT_FORVERIFICATION);
        $dbb->where('sm.digital_sign_status', DIGITAL_SIGN_STATUS);
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }


    public function getCasesCountByDistMeeting($dbb,$meeting_id)
    {
        $pendingofficer = MB_DEPARTMENT;
        $digitalSign = DIGITAL_SIGN_STATUS;
        $sql = "select sc.case_no, sb.pull_request,sm.vgr_pgr_revert_status
                        from settlement_proposal_cases as sc 
                        join settlement_basic sb on sb.case_no = sc.case_no
                        join settlement_proposal_list sl on sl.id = sc.proposal_id
                        join proposal_meeting_list sm on sm.id = sl.proposal_meeting_id
                        where sb.pending_officer = ?  and (sb.dept_approval is NULL or sb.dept_approval='R' or sb.dept_approval='') 
                        and sm.digital_sign_status = ? and sm.id = ?";
        $data  = $dbb->query($sql, array($pendingofficer,$digitalSign,$meeting_id));
        return $data;
    }


    public function getCasesCountFromCabMemo($dist_code,$meeting_id)
    {
        $sql = "select case_no from cab_memo_list where dist_code =? and meeting_id =?";
        $data  = $this->db->query($sql, array($dist_code,$meeting_id));
        return $data;
    }




    public function getAllCasesbyCabId($dbb,$start, $length, $order,$cab_id,$user_code,$meeting_no,$dist_code,$service_code)
    {

        $searchByCol_0 = strtoupper($this->input->post('columns')[1]['search']['value']);
        if(!empty($searchByCol_0)){
            $dbb->where('case_no like \'%'.$searchByCol_0.'%\'');

        }
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }

        $dbb->select('*');
        $dbb->from('cab_memo_list');
        $dbb->where('cab_id', $cab_id);
        if ($service_code == 14) {
            $dbb->like('case_no', '/SAPNR', 'both');
        }
        if ($service_code == 15) {
            $dbb->like('case_no', '/STRIB', 'both');
        }
        if ($service_code == 16) {
            $dbb->like('case_no', '/SKHAS', 'both');
        }
        if ($service_code == 18) {
            $dbb->like('case_no', '/SCULT', 'both');
        }
         if ($meeting_no != NULL) {
            $dbb->where('meeting_id', $meeting_no);
        }
         if ($dist_code != NULL) {
            $dbb->where('dist_code', $dist_code);
        }
        $dbb->where('user_code', $user_code);
        $dbb->where('final_status !=', TEMP_REVERT_BY_DEPT);
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0){
            $data['data_results'] = $query->result();
            $dbb->select('*');
            $dbb->from('cab_memo_list');
            $dbb->where('cab_id', $cab_id);
            if ($service_code == 14) {
                $dbb->like('case_no', '/SAPNR', 'both');
            }
            if ($service_code == 15) {
                $dbb->like('case_no', '/STRIB', 'both');
            }
            if ($service_code == 16) {
                $dbb->like('case_no', '/SKHAS', 'both');
            }
            if ($service_code == 18) {
                $dbb->like('case_no', '/SCULT', 'both');
            }
            if ($meeting_no != NULL) {
                $dbb->where('meeting_id', $meeting_no);
            }
            if ($meeting_no != NULL) {
                $dbb->where('meeting_id', $meeting_no);
            }
            if ($dist_code != NULL) {
                $dbb->where('dist_code', $dist_code);
            }
            $dbb->where('user_code', $user_code);
            $dbb->where('final_status !=', TEMP_REVERT_BY_DEPT);
            $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }


    public function deleteCasesFromCabMemo($where)
    {
        return $this->db->where($where)->delete('cab_memo_list');
    }

    public function getAllCasesFromMemoForFinalApproval($dbb,$cab_id,$user_code)
    {
        $status = CAB_MEMO_DOC_GENERATED;
        $final_submit_status = FINAL_SUBMISSION_PENDING;
        $final_status = TEMP_APPROVE_BY_DEPT;
        $sql = "select * from cab_memo_list where cab_id =? and user_code =? and status =? and final_status = ? and final_submit_status = ? order by id";
        $data  = $dbb->query($sql, array($cab_id,$user_code,$status,$final_status,$final_submit_status));
        return $data;
    }

    public function digitalSignedStatusOfCabId($dbb,$cab_id)
    {
        $sql = "select notification_digital_sign_status from cab_id_list where cab_id =?";
        $data  = $dbb->query($sql, array($cab_id))->row();
        return $data;
    }

    public function updateCabMemoList($updateData,$where)
    {
        $this->db->set($updateData)->where($where)->update('cab_memo_list');
        return $this->db->affected_rows();
    }


    public function getCaseListDetailsForFinalSubmit($dbb,$cab_id,$user_code,$dist)
    {

        $sql = "select * from cab_memo_list where cab_id = ? and user_code = ? and dist_code =?";
        $data  = $dbb->query($sql, array($cab_id, $user_code,$dist));
        return $data;
    }

    public function getAllRevertedCaseDetails($cabId)
    {
        $sql = "select * from cab_memo_list  where cab_id = ? and final_status = ? order by id asc";
        $data  = $this->db->query($sql, array($cabId,TEMP_REVERT_BY_DEPT))->result();
        return ['reverted_case_list' => $data];
    }


    public function getMemoNameByCabId($dbb,$cab_id)
    {

        $sql = "select cab_memo_name from cab_id_list where cab_id = ?";
        $data  = $dbb->query($sql, array($cab_id))->row()->cab_memo_name;
        return $data;
    }


    public function getAllPossessionDetails($case)
    {
        $applicants = $this->db2->select()
            ->where('case_no', $case)
            ->get('settlement_dag_details');
        return $applicants->result();
    }


    public function getDeptUserDistListWithCaseCount()
    {
        $unique_user_id = $this->session->userdata('unique_user_id');
        $this->db = $this->load->database('db2', TRUE);
        $dist_list = $this->db->query("SELECT udb.dist_code FROM depart_users du inner join user_dist_byforcation udb on udb.unique_user_id::int=du.id  where du.unique_user_id='$unique_user_id' and du.active_deactive='E'")->result();
        foreach ($dist_list as $key => $value) {
            $caseCount = 0;
            
            if(IS_PRODUCTION == 0 && $value->dist_code !='07') {
                $caseCount = 0;
                $dist_list[$key]->case_count = $caseCount;
                continue;
            }
            $this->db2 = $this->dbswitch2($value->dist_code);
            $sqlForCaseCountAgainstDistrict = $this->db2->query("SELECT count(sc.*) as total FROM 
                settlement_proposal_cases sc 
                inner join settlement_basic sb on sb.case_no = sc.case_no 
                inner join settlement_proposal_list sl on sl.id = sc.proposal_id
                inner join proposal_meeting_list sm on sm.id = sl.proposal_meeting_id
                where  sb.dist_code = ? and sb.from_office =? and sb.pending_officer =? and sb.cab_memo_prepared = ? and sb.service_code not in ('17','25','35') and sm.digital_sign_status = ?
                ",array($value->dist_code,MB_DEPUTY_COMM,MB_DEPARTMENT,ADD_CASES_TO_CAB_MEMO,DIGITAL_SIGN_STATUS))->row();
            if(!empty($sqlForCaseCountAgainstDistrict) && isset($sqlForCaseCountAgainstDistrict) && $sqlForCaseCountAgainstDistrict != null){
                $caseCount = $sqlForCaseCountAgainstDistrict->total;
            }
            $dist_list[$key]->case_count = $caseCount;
        }
        return $dist_list;
    }


    public function getPullRequestStatus($dbb,$casesList)
    {
        $sql = "select pull_request,case_no from settlement_basic where case_no in ($casesList) and pull_request =1";
        $data  = $dbb->query($sql);
        return $data;
    }


    public function getCasesHavingPullRequest($dbb,$cab_memo_id)
    {
        $pendingofficer = MB_DEPARTMENT;
        $digitalSign = DIGITAL_SIGN_STATUS;
        $sql = "select sc.case_no, sb.pull_request
                        from settlement_proposal_cases as sc 
                        join settlement_basic sb on sb.case_no = sc.case_no
                        join settlement_proposal_list sl on sl.id = sc.proposal_id
                        join proposal_meeting_list sm on sm.id = sl.proposal_meeting_id
                        where sb.pending_officer = ?  and sb.dept_approval is NULL 
                        and sm.digital_sign_status = ? and sm.id = ? and sb.pull_request =?";
        $data  = $dbb->query($sql, array($pendingofficer,$digitalSign,$cab_memo_id,1));
        return $data;
    }

    public function checkCaseStatusVerify($case_no, $dist_code)
    {
        $sql = "select assign_ast_code from settlement_basic where case_no= ? and dist_code = ? ";
        $data  = $this->db2->query($sql,array($case_no,$dist_code))->row();
        if(!empty($data) && $data != null){
            return $data->assign_ast_code;
        }else{
            return null;
        }
        
    }


    //Get All Reverted Cases List by Department
    public function getAllRevertedCasesUnderDepartmentAll($dbb,$start, $length, $order, $service_code)
    {
        $pending_officer = MB_DEPARTMENT;
        $from_office = MB_DEPUTY_COMM;
        $searchByCol_0 = strtoupper($this->input->post('columns')[1]['search']['value']);
        if(!empty($searchByCol_0)){
            $dbb->where('case_no like \'%'.$searchByCol_0.'%\'');

        }
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }

        $dbb->select('*');
        $dbb->from('settlement_basic');
        $dbb->where('dept_revert', 1);
         if ($service_code != NULL) {
            $dbb->where('service_code', $service_code);
        }

        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
            $dbb->select('*');
            $dbb->from('settlement_basic');
            $dbb->where('dept_revert', 1);
            if ($service_code != NULL) {
                $dbb->where('service_code', $service_code);
            }
            $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }


    public function getDeptUserDistListWithRevertedCaseCount()
    {
        $unique_user_id = $this->session->userdata('unique_user_id');
        $this->db = $this->load->database('db2', TRUE);
        $dist_list = $this->db->query("SELECT udb.dist_code FROM depart_users du inner join user_dist_byforcation udb on udb.unique_user_id::int=du.id  where du.unique_user_id='$unique_user_id' and du.active_deactive='E'")->result();
        foreach ($dist_list as $key => $value) {
            $caseCount = 0;
            
            if(IS_PRODUCTION == 0 && $value->dist_code !='07') {
                $caseCount = 0;
                $dist_list[$key]->case_count = $caseCount;
                continue;
            }
            $this->db2 = $this->dbswitch2($value->dist_code);
            $sqlForCaseCountAgainstDistrict = $this->db2->query("SELECT count(*) as total FROM settlement_basic WHERE dist_code = ? and dept_revert =?
                ",array($value->dist_code,1))->row();
            if(!empty($sqlForCaseCountAgainstDistrict) && isset($sqlForCaseCountAgainstDistrict) && $sqlForCaseCountAgainstDistrict != null){
                $caseCount = $sqlForCaseCountAgainstDistrict->total;
            }
            $dist_list[$key]->case_count = $caseCount;
        }
        return $dist_list;
    }



    // get chitha dag details
    public function getChithaDagAreaDetails($dbb,$appDistrict,$appSubDiv,$appCircle,$appMouza,$appLot,$appVillage,$appDag,$appPattaType,$appPatta)
    {
        return $dbb->select()
            ->where('dist_code',$appDistrict)
            ->where('subdiv_code',$appSubDiv)
            ->where('cir_code',$appCircle)
            ->where('mouza_pargona_code',$appMouza)
            ->where('lot_no',$appLot)
            ->where('vill_townprt_code',$appVillage)
            ->where('dag_no',$appDag)
            ->get('chitha_basic')
            ->row();
    }


        //  get all application though location details (Not Rejected on)
    public function getAllDagAreaDetailsByLocationNotSubmit($dbb,$appDistrict,$appSubDiv,$appCircle,$appMouza,$appLot,$appVillage,$appDag,$appPattaType,$appPatta,$application_no)
    {

        $applications = $dbb->query("
        SELECT settlement_dag_details.*, settlement_basic.status
	    FROM (select * from settlement_dag_details where dist_code='$appDistrict' and subdiv_code='$appSubDiv' and cir_code='$appCircle'
	    and mouza_pargona_code='$appMouza' and lot_no='$appLot' and vill_townprt_code='$appVillage' 
	    and dag_no='$appDag' and patta_type_code='$appPattaType' and patta_no='$appPatta') settlement_dag_details
	    JOIN (select * from settlement_basic where dist_code='$appDistrict' and subdiv_code='$appSubDiv' and cir_code='$appCircle' and 
	    mouza_pargona_code='$appMouza' and lot_no='$appLot' and vill_townprt_code='$appVillage'
	    and status not in('D','F') and dc_proceeding=0) settlement_basic
	    ON settlement_basic.case_no = settlement_dag_details.case_no
        ");

        return $applications->result();
    }



    //  get all application though location details (Not Rejected on)
    public function getAllDagAreaDetailsByLocation($dbb,$appDistrict,$appSubDiv,$appCircle,$appMouza,$appLot,$appVillage,$appDag,$appPattaType,$appPatta)
    {
        $applications = $dbb->query("
        SELECT settlement_dag_details.*, settlement_basic.status
	    FROM (select * from settlement_dag_details where dist_code='$appDistrict' and subdiv_code='$appSubDiv' and cir_code='$appCircle'
	    and mouza_pargona_code='$appMouza' and lot_no='$appLot' and vill_townprt_code='$appVillage' 
	    and dag_no='$appDag' and patta_type_code='$appPattaType' and patta_no='$appPatta') settlement_dag_details
	    JOIN (select * from settlement_basic where dist_code='$appDistrict' and subdiv_code='$appSubDiv' and cir_code='$appCircle' and 
	    mouza_pargona_code='$appMouza' and lot_no='$appLot' and vill_townprt_code='$appVillage'
	    and status not in('D','F') and dc_proceeding=1) settlement_basic
	    ON settlement_basic.case_no = settlement_dag_details.case_no
        ");

        return $applications->result();
    }
    

     public function getNewChithaDagAreaDetails($dbb,$appDistrict,$appSubDiv,$appCircle,$appMouza,$appLot,$appVillage,$appDag)
    {
        return $dbb->select()
            ->where('dist_code',$appDistrict)
            ->where('subdiv_code',$appSubDiv)
            ->where('cir_code',$appCircle)
            ->where('mouza_pargona_code',$appMouza)
            ->where('lot_no',$appLot)
            ->where('vill_townprt_code',$appVillage)
            ->where('dag_no',$appDag)
            ->get('chitha_basic')
            ->row();
    }

    // get all settlement reservation
    public function getSettlementReservationCommon($dbb,$case)
    {
        $lmnotes = $dbb->select()
            ->where('case_no',$case)
            ->get('settlement_reservation');
        return $lmnotes->result();
    }

    function defaultValue($input, $value)
    {
        if (empty($input)) return $value;

        return $input;
    }


    public function getSettlementBasicData($dbb,$case_no){
        $query = "SELECT * FROM settlement_basic WHERE case_no = '$case_no'";
        $data = $dbb->query($query)->row();
        return $data;
    }


        // Area reservation on chitha check
    public function chithaReserveAreaCheckWithCaseNo($dbb,$case_no)
    {
        $dags                 = $this->getSettlementDagArea($case_no);
        $totalAreaInChitha[]  = 0;
        $appAreaInApplication = 0;
        $areaCheck            = 0;
        $appliedDags          = $this->getSettlementDagArea($case_no);
        $basic                = $this->getSettlementBasicData($dbb,$case_no);
        $newDag = '';
        
        if($basic->service_code == SETTLEMENT_AP_TRANSFER_ID)
        {
            $newDag = $appliedDags[0]->new_dag_no;
            if($newDag != '')
            {
                foreach ($dags as $dag)
                {
                    $totalReservedAreaInApplication = 0;
                    $totalAppliedAreaInApplication = 0;

                    $appDistrict = $dag->dist_code;
                    $appSubDiv = $dag->subdiv_code;
                    $appCircle = $dag->cir_code;
                    $appMouza = $dag->mouza_pargona_code;
                    $appLot = $dag->lot_no;
                    $appVillage = $dag->vill_townprt_code;
                    $appDag = $dag->dag_no;

                    // chitha details for new Dag
                    $chithaDag = $this->getNewChithaDagAreaDetails($dbb,
                        $appDistrict, $appSubDiv, $appCircle, $appMouza, $appLot, $appVillage, $newDag);

                    $reservation = $this->getSettlementReservationCommon($dbb,$case_no);

                    if (in_array($appDistrict, json_decode(BARAK_VALLEY_DIST)))
                    {
                        // chitha
                        $bighaChitha = $this->defaultValue($chithaDag->dag_area_b, 0);
                        $kathaChitha = $this->defaultValue($chithaDag->dag_area_k, 0);
                        $lessaChitha = $this->defaultValue($chithaDag->dag_area_lc, 0);
                        $gandaChitha = $this->defaultValue($chithaDag->dag_area_g, 0);
                        $totalAreaInChitha = ($bighaChitha * 6400) + ($kathaChitha * 320) + ($lessaChitha * 20) + $gandaChitha;

                        // application area
                        foreach ($appliedDags as $singleAppArea)
                        {
                            if ($appDag == $singleAppArea->dag_no)
                            {
                                $bighaAppArea = $this->defaultValue($singleAppArea->s_dag_area_b, 0);
                                $kathaAppArea = $this->defaultValue($singleAppArea->s_dag_area_k, 0);
                                $lessaAppArea = $this->defaultValue($singleAppArea->s_dag_area_lc, 0);
                                $gandaAppArea = $this->defaultValue($singleAppArea->s_dag_area_g, 0);
                                $appAreaInApplication = ($bighaAppArea * 6400) + ($kathaAppArea * 320) + ($lessaAppArea * 20) + $gandaAppArea;

                                $totalAppliedAreaInApplication += $appAreaInApplication;
                            }
                        }

                        // Reservation Area
                        foreach ($reservation as $singleApp)
                        {
                            $bighaReservedApp = $this->defaultValue($singleApp->bigha, 0);
                            $kathaReservedApp = $this->defaultValue($singleApp->katha, 0);
                            $lessaReservedApp = $this->defaultValue($singleApp->lessa, 0);
                            $gandaReservedApp = $this->defaultValue($singleApp->ganda, 0);
                            $areaReservedInApplication = ($bighaReservedApp * 6400) + ($kathaReservedApp * 320) + ($lessaReservedApp * 20) + $gandaReservedApp;

                            $totalReservedAreaInApplication += $areaReservedInApplication;
                        }

                        if($totalAreaInChitha == 0)
                        {
                            $areaCheck = 1;
                        }
                        if(($totalAppliedAreaInApplication - $totalReservedAreaInApplication) == 0)
                        {
                            $areaCheck = 1;
                        }
                        if ($totalAreaInChitha < $totalAppliedAreaInApplication - $totalReservedAreaInApplication)
                        {
                            $areaCheck = 1;
                        }
                    }
                    else
                    {
                        // chitha
                        $bighaChitha = $this->defaultValue($chithaDag->dag_area_b, 0);
                        $kathaChitha = $this->defaultValue($chithaDag->dag_area_k, 0);
                        $lessaChitha = $this->defaultValue($chithaDag->dag_area_lc, 0);
                        $totalAreaInChitha = ($bighaChitha * 100) + ($kathaChitha * 20) + $lessaChitha;

                        // application area
                        foreach ($appliedDags as $singleAppArea)
                        {
                            if ($appDag == $singleAppArea->dag_no)
                            {
                                $bighaAppArea = $this->defaultValue($singleAppArea->s_dag_area_b, 0);
                                $kathaAppArea = $this->defaultValue($singleAppArea->s_dag_area_k, 0);
                                $lessaAppArea = $this->defaultValue($singleAppArea->s_dag_area_lc, 0);
                                $appAreaInApplication = ($bighaAppArea * 100) + ($kathaAppArea * 20) + $lessaAppArea;

                                $totalAppliedAreaInApplication += $appAreaInApplication;
                            }
                        }

                        // Reservation Area
                        foreach ($reservation as $singleApp)
                        {
                            $bighaReservedApp = $this->defaultValue($singleApp->bigha, 0);
                            $kathaReservedApp = $this->defaultValue($singleApp->katha, 0);
                            $lessaReservedApp = $this->defaultValue($singleApp->lessa, 0);
                            $areaReservedInApplication = ($bighaReservedApp * 100) + ($kathaReservedApp * 20) + $lessaReservedApp;

                            $totalReservedAreaInApplication += $areaReservedInApplication;
                        }

                        if($totalAreaInChitha == 0)
                        {
                            $areaCheck = 1;
                        }
                        if(($totalAppliedAreaInApplication - $totalReservedAreaInApplication) == 0)
                        {
                            $areaCheck = 1;
                        }
                        if ($totalAreaInChitha < $totalAppliedAreaInApplication - $totalReservedAreaInApplication)
                        {
                            $areaCheck = 1;
                        }
                    }

                }
            }
        }
        else
        {
            foreach ($dags as $dag)
            {
                $totalAreaInApplication = 0;
                $totalAreaInLMApplication = 0;
                $totalAppliedAreaInApplication = 0;

                $appDistrict  = $dag->dist_code;
                $appSubDiv    = $dag->subdiv_code;
                $appCircle    = $dag->cir_code;
                $appMouza     = $dag->mouza_pargona_code;
                $appLot       = $dag->lot_no;
                $appVillage   = $dag->vill_townprt_code;
                $appDag       = $dag->dag_no;
                $appPattaType = $dag->patta_type_code;
                $appPatta     = $dag->patta_no;

                $chithaDag = $this->getChithaDagAreaDetails($dbb,
                    $appDistrict, $appSubDiv, $appCircle, $appMouza, $appLot, $appVillage, $appDag, $appPattaType, $appPatta);

                $allApplicationDags = $this->getAllDagAreaDetailsByLocation($dbb,
                    $appDistrict,$appSubDiv,$appCircle,$appMouza,$appLot,$appVillage,$appDag,$appPattaType,$appPatta);

                $allLmProcess = $this->getAllDagAreaDetailsByLocationNotSubmit($dbb,
                    $appDistrict,$appSubDiv,$appCircle,$appMouza,$appLot,$appVillage,$appDag,$appPattaType,$appPatta,$case_no);

                if (in_array($appDistrict, json_decode(BARAK_VALLEY_DIST)))
                {
                    // chitha
                    $bighaChitha       = $this->defaultValue($chithaDag->dag_area_b, 0);
                    $kathaChitha       = $this->defaultValue($chithaDag->dag_area_k, 0);
                    $lessaChitha       = $this->defaultValue($chithaDag->dag_area_lc, 0);
                    $gandaChitha       = $this->defaultValue($chithaDag->dag_area_g, 0);
                    $totalAreaInChitha = ($bighaChitha * 6400) + ($kathaChitha * 320) + ($lessaChitha * 20) + $gandaChitha;

                    // SOD/ADC processing application
                    foreach ($allApplicationDags as $singleApp)
                    {
                        $bighaApp          = $this->defaultValue($singleApp->s_dag_area_b, 0);
                        $kathaApp          = $this->defaultValue($singleApp->s_dag_area_k, 0);
                        $lessaApp          = $this->defaultValue($singleApp->s_dag_area_lc, 0);
                        $gandaApp          = $this->defaultValue($singleApp->s_dag_area_g, 0);
                        $areaInApplication = ($bighaApp * 6400) + ($kathaApp * 320) + ($lessaApp * 20) + $gandaApp;

                        $totalAreaInApplication += $areaInApplication;
                    }

                    // LM processing application
                    foreach ($allLmProcess as $singleLMApp)
                    {
                        $bighaLmApp = $this->defaultValue($singleLMApp->s_dag_area_b, 0);
                        $kathaLmApp = $this->defaultValue($singleLMApp->s_dag_area_k, 0);
                        $lessaLmApp = $this->defaultValue($singleLMApp->s_dag_area_lc, 0);
                        $gandaLMApp = $this->defaultValue($singleLMApp->s_dag_area_g, 0);

                        $areaInLMApplication = ($bighaLmApp * 6400) + ($kathaLmApp * 320) + ($lessaLmApp * 20) + $gandaLMApp;
                        $totalAreaInLMApplication += $areaInLMApplication;
                    }


                    if($basic->dc_proceeding == 0)
                    {
                        // application area
                        foreach ($appliedDags as $singleAppArea)
                        {
                            if($chithaDag->dag_no == $singleAppArea->dag_no)
                            {
                                $bighaAppArea = $this->defaultValue($singleAppArea->s_dag_area_b, 0);
                                $kathaAppArea = $this->defaultValue($singleAppArea->s_dag_area_k, 0);
                                $lessaAppArea = $this->defaultValue($singleAppArea->s_dag_area_lc, 0);
                                $gandaAppArea = $this->defaultValue($singleAppArea->s_dag_area_g, 0);
                                $appAreaInApplication = ($bighaAppArea * 6400) + ($kathaAppArea * 320) + ($lessaAppArea * 20) + $gandaAppArea;

                                $totalAppliedAreaInApplication += $appAreaInApplication;
                            }
                        }
                    }

                    if($totalAreaInChitha == 0)
                    {
                        $areaCheck = 1;
                    }
                    if(($totalAreaInApplication + $totalAppliedAreaInApplication) == 0)
                    {
                        $areaCheck = 1;
                    }
                    if($totalAreaInChitha < $totalAreaInApplication + $totalAreaInLMApplication)
                    {
                        $areaCheck = 1;
                    }

                }
                else
                {
                    // chitha
                    $bighaChitha = $this->defaultValue($chithaDag->dag_area_b, 0);
                    $kathaChitha = $this->defaultValue($chithaDag->dag_area_k, 0);
                    $lessaChitha = $this->defaultValue($chithaDag->dag_area_lc, 0);
                    $totalAreaInChitha = ($bighaChitha * 100) + ($kathaChitha * 20) + $lessaChitha;

                    //SOD/ADC processing application
                    foreach ($allApplicationDags as $singleApp)
                    {
                        $bighaApp = $this->defaultValue($singleApp->s_dag_area_b, 0);
                        $kathaApp = $this->defaultValue($singleApp->s_dag_area_k, 0);
                        $lessaApp = $this->defaultValue($singleApp->s_dag_area_lc, 0);
                        $areaInApplication = ($bighaApp * 100) + ($kathaApp * 20) + $lessaApp;

                        $totalAreaInApplication += $areaInApplication;
                    }

                    // LM processing application
                    foreach ($allLmProcess as $singleLMApp)
                    {
                        $bighaLmApp = $this->defaultValue($singleLMApp->s_dag_area_b, 0);
                        $kathaLmApp = $this->defaultValue($singleLMApp->s_dag_area_k, 0);
                        $lessaLmApp = $this->defaultValue($singleLMApp->s_dag_area_lc, 0);
                        $areaInLMApplication = ($bighaLmApp * 100) + ($kathaLmApp * 20) + $lessaLmApp;

                        $totalAreaInLMApplication += $areaInLMApplication;
                    }

                    if($basic->dc_proceeding == 0)
                    {
                        // application area
                        foreach ($appliedDags as $singleAppArea)
                        {
                            if($chithaDag->dag_no == $singleAppArea->dag_no)
                            {
                                $bighaAppArea = $this->defaultValue($singleAppArea->s_dag_area_b, 0);
                                $kathaAppArea = $this->defaultValue($singleAppArea->s_dag_area_k, 0);
                                $lessaAppArea = $this->defaultValue($singleAppArea->s_dag_area_lc, 0);
                                $appAreaInApplication = ($bighaAppArea * 100) + ($kathaAppArea * 20) + $lessaAppArea;

                                $totalAppliedAreaInApplication += $appAreaInApplication;
                            }
                        }
                    }

                    if($totalAreaInChitha == 0)
                    {
                        $areaCheck = 1;
                    }
                    if(($totalAreaInApplication + $totalAppliedAreaInApplication) == 0)
                    {
                        $areaCheck = 1;
                    }
                    if($totalAreaInChitha < $totalAreaInApplication + $totalAreaInLMApplication)
                    {
                        $areaCheck = 1;
                    }
                }
            }
        }

        return $areaCheck;

    }


    public function getRevertedCasesCountByDistMeeting($dbb,$cab_memo_id)
    {
        $sql = "select sc.case_no
                        from settlement_proposal_cases as sc 
                        join settlement_basic sb on sb.case_no = sc.case_no
                        join settlement_proposal_list sl on sl.id = sc.proposal_id
                        join proposal_meeting_list sm on sm.id = sl.proposal_meeting_id
                        where  sb.dept_revert = ? and sm.id = ?";
        $data  = $dbb->query($sql, array(1,$cab_memo_id));
        return $data;
    }


    public function getRevertedCasesByDptBeforeCabApproval($dbb, $cab_finalized_date, $cab_approve_date)
    {
        $sql = "SELECT DISTINCT ON (sp.case_no) sp.*, sb.*
        FROM settlement_proceeding sp
        JOIN settlement_basic sb ON sp.case_no = sb.case_no
        WHERE sp.office_from = ? 
        AND sp.office_to = ? 
        AND date(sp.next_date_of_hearing) >= ?
        AND date(sp.next_date_of_hearing) <= ?
        AND sb.dept_revert = ? 
        AND sb.service_code !=?
        ORDER BY sp.case_no, sp.next_date_of_hearing";
        $data = $dbb->query($sql, array(MB_DEPARTMENT, MB_DEPUTY_COMM, $cab_finalized_date, $cab_approve_date,1,SETTLEMENT_PGR_VGR_LAND_ID));
        return $data;
    }

    
    public function ListOfRevertCasesNotUnderCabMemo($dbb,$dist_code,$currentCabCreationDate,$id) {
        $sql = "select * from cab_id_list where dist_code=? and status !=? and vgr_cab =? and id<? limit 1";
        $data = $this->db->query($sql, array($dist_code,EDITED_CAB_ID,0,$id));
        log_message('error',"MB:NOTUDERCAB-------QUERY------1".$this->db->last_query());
        if($data->num_rows() == 0){
            $previousCabFinalisedDate = '2023-01-01';
        }else{
            $data = $data->row();
            $previousCabFinalisedDate = $data->finalized_at;
            $previousCabFinalisedDate = date('Y-m-d',strtotime($previousCabFinalisedDate));
        }
        
        $currentCabCreatedDate= $currentCabCreationDate;
        $currentCabCreatedDate = date('Y-m-d',strtotime($currentCabCreatedDate));
        log_message('error',"MB:NOTUNDERCAB-------DATES------Pre--".$previousCabFinalisedDate.'--Cur-'.$currentCabCreatedDate);
        $sql1 = "SELECT DISTINCT ON (sp.case_no) sp.*, sb.*
        FROM settlement_proceeding sp
        JOIN settlement_basic sb ON sp.case_no = sb.case_no
        WHERE sp.office_from = ? 
        AND sp.office_to = ? 
        AND date(sp.next_date_of_hearing) >= ?
        AND date(sp.next_date_of_hearing) < ?
        AND sb.dept_revert = ? 
        AND sb.service_code !=?
        ORDER BY sp.case_no, sp.next_date_of_hearing";

        // $revertList = $dbb->query($sql1, array(MB_DEPARTMENT, MB_DEPUTY_COMM, $currentCabCreatedDate,$previousCabFinalisedDate));
        $revertList = $dbb->query($sql1, array(MB_DEPARTMENT, MB_DEPUTY_COMM, $previousCabFinalisedDate,$currentCabCreatedDate,1,SETTLEMENT_PGR_VGR_LAND_ID));
        log_message('error',"MB.NOTUNDERCAB----------SettlementQuery--------".$dbb->last_query());
        return $revertList->result();
    }


    public function getDetailsToBeRevertedCase($dbb,$commaSeparatedCases)
    {
        $sql = "select * from settlement_basic where case_no in ($commaSeparatedCases)";
        $data  = $dbb->query($sql)->result();
        // return ['reverted_case_list' => $data];
        return  $data;

    }



    public function applicationStatusUpdateBulk($application_no,$case,$rmk,$status,$task,$pen){
        $apilink=API_LINK;
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $apilink."applicationStatusUpdateBulk");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'application' => $application_no,
            'dharitree' => $case,
            'rmk'       => $rmk,
            'status' => $status,
            'task' => $task,
            'pen'=>$pen,
            'ip' => '10.177.7.141'
        )));
        $result = curl_exec($curl_handle);
        //var_dump(json_decode($result));
        $httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        curl_close($curl_handle);
        if($httpcode != 200){
            return false;
        }
        return json_decode($result);
    }




    // check case match status in cluster or not // VGR PGR
    public function checkIfCaseRevertedFromCluster($dbb,$case_no)
    {
        // $case_no = trim($case_no);
        $sql = $dbb->query('select * from settlement_circle_cluster_cases where case_no = ?', array($case_no));

        $clusterStatus = 0;
        $clusterError  = '';
        $clusterIdList = 0;
        if($sql->num_rows() <= 0)
        {
            $clusterStatus = 0;
            $clusterError  = 'ERR004663: No cluster found for case no '.$case_no;

            $returnDataArray = [
                'clusterStatus' => $clusterStatus,
                'clusterError'  => $clusterError,
                'clusterIdList' => $clusterIdList,
            ];
            return $returnDataArray;
        }

        $cluster_id = $sql->row()->cluster_id;
        $clusterStatusSql = $dbb->query('select * from settlement_circle_cluster where cluster_id = ?', array($cluster_id));

        if($sql->num_rows() <= 0)
        {
            $clusterStatus = 0;
            $clusterError  = 'ERR004679: No cluster found for case no '.$case_no;

            $returnDataArray = [
                'clusterStatus' => $clusterStatus,
                'clusterError'  => $clusterError,
                'clusterIdList' => $cluster_id,
            ];
            return $returnDataArray;
        }

        $cluster_row        = $clusterStatusSql->row();
        $cluster_status     = trim($cluster_row->status);
        $cluster_pending_at = trim($cluster_row->pending_at);
        $getCaseStatusBasic = $dbb->query('select * from settlement_basic where case_no = ?', array($case_no));

        if($getCaseStatusBasic->num_rows() <= 0)
        {
            $clusterStatus = 0;
            $clusterError  = 'ERR004697: There is some problem for case no '.$case_no;

            $returnDataArray = [
                'clusterStatus' => $clusterStatus,
                'clusterError'  => $clusterError,
                'clusterIdList' => $cluster_id,
            ];
            return $returnDataArray;
        }

        $basicRow = $getCaseStatusBasic->row();

        $caseBasicStatus    = trim($basicRow->status);
        $caseBasicPendingAt = trim($basicRow->pending_officer);

        if($caseBasicStatus != 'D')
        {
            if(($cluster_status != $caseBasicStatus) || ($cluster_pending_at != $caseBasicPendingAt))
            {
                $clusterStatus = 0;
                $clusterError  = 'ERR004717: Some cases of this cluster is reverted and still pending';

                $returnDataArray = [
                    'clusterStatus' => $clusterStatus,
                    'clusterError'  => $clusterError,
                    'clusterIdList' => $cluster_id,
                ];
                return $returnDataArray;
            }
        }

        $returnDataArray = [
            'clusterStatus' => 1,
            'clusterError'  => 'OK',
            'clusterIdList' => $cluster_id,
        ];
        return $returnDataArray;
    }



        ///Get All VGR Cases By Circle Code
    public function getAllVGRCasesCircleByDist($dbb,$start, $length, $order)
    {
        $pending_officer = MB_DEPARTMENT;
        $from_office = MB_DEPUTY_COMM;
        $searchByCol_0 = strtoupper($this->input->post('columns')[1]['search']['value']);
        if(!empty($searchByCol_0)){
            $dbb->where('sb.case_no like \'%'.$searchByCol_0.'%\'');

        }
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }

        $dbb->select('sb.dist_code,sb.subdiv_code,sb.cir_code');
        $dbb->from('settlement_proposal_cases as sc');
        $dbb->join('settlement_basic sb', 'sb.case_no = sc.case_no');
        $dbb->join('settlement_proposal_list sl', 'sl.id = sc.proposal_id');
        $dbb->join('proposal_meeting_list sm', 'sm.id = sl.proposal_meeting_id');
        $dbb->where('sb.pending_officer', $pending_officer);
        $dbb->where('sb.from_office', $from_office);
        $dbb->where('sb.cab_memo_prepared', ADD_CASES_TO_CAB_MEMO);
        // $dbb->where('sb.dept_approval IS NULL');
        $dbb->where('sb.service_code', SETTLEMENT_PGR_VGR_LAND_ID);
        $dbb->where('sm.digital_sign_status', DIGITAL_SIGN_STATUS);
        $dbb->group_by(array('sb.dist_code', 'sb.subdiv_code','sb.cir_code'));
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

            $dbb->select('sb.dist_code,sb.subdiv_code,sb.cir_code');
            $dbb->from('settlement_proposal_cases as sc');
            $dbb->join('settlement_basic sb', 'sb.case_no = sc.case_no');
            $dbb->join('settlement_proposal_list sl', 'sl.id = sc.proposal_id');
            $dbb->join('proposal_meeting_list sm', 'sm.id = sl.proposal_meeting_id');
            $dbb->where('sb.pending_officer', $pending_officer);
            $dbb->where('sb.from_office', $from_office);
            $dbb->where('sb.cab_memo_prepared', ADD_CASES_TO_CAB_MEMO);
            // $dbb->where('sb.dept_approval IS NULL');
            $dbb->where('sb.service_code', SETTLEMENT_PGR_VGR_LAND_ID);
            $dbb->where('sm.digital_sign_status', DIGITAL_SIGN_STATUS);
            $dbb->group_by(array('sb.dist_code', 'sb.subdiv_code','sb.cir_code'));
            $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }

    ///Get All VGR Cases By Circle Code
    public function getAllVGRCasesByCircle($dbb,$start, $length, $order,$subdiv_code,$cir_code,$meeting_no,$verification,$pullRequest)
    {
        $pending_officer = MB_DEPARTMENT;
        $from_office = MB_DEPUTY_COMM;
        $searchByCol_0 = strtoupper($this->input->post('columns')[1]['search']['value']);
        if(!empty($searchByCol_0)){
            $dbb->where('sb.case_no like \'%'.$searchByCol_0.'%\'');

        }
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }

        $dbb->select('sc.*,sl.id as proposal_id,sl.proposal_name,sm.meeting_name,sm.id as meeting_id,sb.dist_code,sb.subdiv_code,sb.cir_code, sb.dept_approval,sb.verified_by_asst,sb.service_code,sb.pull_request,sb.verified_ast_remarks,sb.dept_revert,sb.dept_vgr_revert');
        $dbb->from('settlement_proposal_cases as sc');
        $dbb->join('settlement_basic sb', 'sb.case_no = sc.case_no');
        $dbb->join('settlement_proposal_list sl', 'sl.id = sc.proposal_id');
        $dbb->join('proposal_meeting_list sm', 'sm.id = sl.proposal_meeting_id');
        $dbb->where('sb.pending_officer', $pending_officer);
        $dbb->where('sb.subdiv_code', $subdiv_code);
        $dbb->where('sb.cir_code', $cir_code);
        $dbb->where('sb.service_code', SETTLEMENT_PGR_VGR_LAND_ID);

         if ($verification != NULL) {
            $dbb->where('sb.verified_by_asst', $verification);
        }

         if ($meeting_no != NULL) {
            $dbb->where('sm.id', $meeting_no);
        }

         if ($pullRequest != NULL) {
            $dbb->where('sb.pull_request', $pullRequest);
        }

        $dbb->where('sb.from_office', $from_office);
        $dbb->where('sb.cab_memo_prepared', ADD_CASES_TO_CAB_MEMO);
        // $dbb->where('sb.dept_approval IS NULL');
        $dbb->where('sm.digital_sign_status', DIGITAL_SIGN_STATUS);
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

            $dbb->select('sc.*,sl.id as proposal_id,sl.proposal_name,sm.meeting_name,sm.id as meeting_id,sb.dist_code,sb.subdiv_code,sb.cir_code, sb.dept_approval,sb.verified_by_asst,sb.service_code,sb.pull_request,sb.verified_ast_remarks,sb.dept_revert,sb.dept_vgr_revert');
            $dbb->from('settlement_proposal_cases as sc');
            $dbb->join('settlement_basic sb', 'sb.case_no = sc.case_no');
            $dbb->join('settlement_proposal_list sl', 'sl.id = sc.proposal_id');
            $dbb->join('proposal_meeting_list sm', 'sm.id = sl.proposal_meeting_id');
            $dbb->where('sb.pending_officer', $pending_officer);
            $dbb->where('sb.subdiv_code', $subdiv_code);
            $dbb->where('sb.cir_code', $cir_code);
            $dbb->where('sb.service_code', SETTLEMENT_PGR_VGR_LAND_ID);


         if ($verification != NULL) {
            $dbb->where('sb.verified_by_asst', $verification);
        }

         if ($meeting_no != NULL) {
            $dbb->where('sm.id', $meeting_no);
        }
         if ($pullRequest != NULL) {
            $dbb->where('sb.pull_request', $pullRequest);
        }

        $dbb->where('sb.from_office', $from_office);
        $dbb->where('sb.cab_memo_prepared', ADD_CASES_TO_CAB_MEMO);
        // $dbb->where('sb.dept_approval IS NULL');
        $dbb->where('sm.digital_sign_status', DIGITAL_SIGN_STATUS);
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }

    public function getVGRCabinetIdList($dist_code,$user_code)
    {
        $sql = "select * from cab_id_list where dist_code =? and user_code =? and vgr_cab =? and status in (?, ?)";
        $data  = $this->db->query($sql, array($dist_code,$user_code,1,GENERATED_CAB_ID,ADD_CASES_UNDER_CAB_ID));
        return $data;
    }



    public function getDeptUserDistListWithCaseCountVGR()
    {
        $unique_user_id = $this->session->userdata('unique_user_id');
        $this->db = $this->load->database('db2', TRUE);
        // $dist_list = $this->db->query("SELECT udb.dist_code FROM depart_users du inner join user_dist_byforcation udb on udb.unique_user_id::int=du.id  where du.unique_user_id='$unique_user_id' and du.active_deactive='E'")->result();
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
        foreach ($dist_list as $key => $value) {
            $caseCount = 0;
            
            if(IS_PRODUCTION == 0 && $value->dist_code !='07') {
                $caseCount = 0;
                $dist_list[$key]->case_count = $caseCount;
                continue;
            }
            $this->db2 = $this->dbswitch2($value->dist_code);
            $sqlForCaseCountAgainstDistrict = $this->db2->query("SELECT count(sc.*) as total FROM 
                settlement_proposal_cases sc 
                inner join settlement_basic sb on sb.case_no = sc.case_no 
                inner join settlement_proposal_list sl on sl.id = sc.proposal_id
                inner join proposal_meeting_list sm on sm.id = sl.proposal_meeting_id
                where sb.dist_code = ? and sb.from_office =? and sb.pending_officer =? and sb.cab_memo_prepared = ? and sb.service_code = ? and sm.digital_sign_status = ?
                ",array($value->dist_code,MB_DEPUTY_COMM,MB_DEPARTMENT,ADD_CASES_TO_CAB_MEMO,SETTLEMENT_PGR_VGR_LAND_ID,DIGITAL_SIGN_STATUS))->row();
            if(!empty($sqlForCaseCountAgainstDistrict) && isset($sqlForCaseCountAgainstDistrict) && $sqlForCaseCountAgainstDistrict != null){
                $caseCount = $sqlForCaseCountAgainstDistrict->total;
            }
            $dist_list[$key]->case_count = $caseCount;
        }
        return $dist_list;
    }


    public function getMeetingListByDistVGR($dbb,$dist_code)
    {

        $sql = "select distinct ml.id,ml.meeting_name from proposal_meeting_list ml 
                    join settlement_proposal_list pl on pl.proposal_meeting_id = ml.id 
                    join settlement_proposal_cases pc on pc.proposal_id = pl.id
                    join  settlement_basic sb on sb.case_no = pc.case_no where ml.dist_code = ? 
                    and ml.digital_sign_status =? and sb.from_office = ?  and sb.cab_memo_prepared =? and sb.service_code =?";
        $data  = $dbb->query($sql, array($dist_code, DIGITAL_SIGN_STATUS, MB_DEPUTY_COMM, ADD_CASES_TO_CAB_MEMO,SETTLEMENT_PGR_VGR_LAND_ID));
        return $data;
    }


    public function getVGRRevertedCasesByDptBeforeCabApproval($dbb, $cab_finalized_date, $cab_approve_date)
    {
        $sql = "SELECT DISTINCT ON (sp.case_no) sp.*, sb.*
        FROM settlement_proceeding sp
        JOIN settlement_basic sb ON sp.case_no = sb.case_no
        WHERE sp.office_from = ? 
        AND sp.office_to = ? 
        AND date(sp.next_date_of_hearing) >= ?
        AND date(sp.next_date_of_hearing) <= ?
        AND sb.dept_vgr_revert = ? 
        AND sb.service_code =?
        ORDER BY sp.case_no, sp.next_date_of_hearing";
        $data = $dbb->query($sql, array(MB_DEPARTMENT, MB_DEPUTY_COMM, $cab_finalized_date, $cab_approve_date,1,SETTLEMENT_PGR_VGR_LAND_ID));
        return $data;
    }


    public function ListOfVGRRevertCasesNotUnderCabMemo($dbb,$dist_code,$previousCabApprovedDate,$id) 
    {
        $sql = "select * from cab_id_list where dist_code=? and status !=? and vgr_cab =? and id<? limit 1";
        $data = $this->db->query($sql, array($dist_code,EDITED_CAB_ID,0,$id));
        log_message('error',"MB:NOTUDERCAB-------QUERY------1".$this->db->last_query());
        if($data->num_rows() == 0){
            $previousCabFinalisedDate = '2023-01-01';
        }else{
            $data = $data->row();
            $previousCabFinalisedDate = $data->finalized_at;
            $previousCabFinalisedDate = date('Y-m-d',strtotime($previousCabFinalisedDate));
        }
        
        $currentCabCreatedDate= $previousCabApprovedDate;
        $currentCabCreatedDate = date('Y-m-d',strtotime($currentCabCreatedDate));
        log_message('error',"MB:NOTUNDERCAB-------DATES------Pre--".$previousCabFinalisedDate.'--Cur-'.$currentCabCreatedDate);
        $sql1 = "SELECT DISTINCT ON (sp.case_no) sp.*, sb.*
        FROM settlement_proceeding sp
        JOIN settlement_basic sb ON sp.case_no = sb.case_no
        WHERE sp.office_from = ? 
        AND sp.office_to = ? 
        AND date(sp.next_date_of_hearing) >= ?
        AND date(sp.next_date_of_hearing) <= ?
        AND sb.dept_vgr_revert = ? 
        AND sb.service_code =?
        ORDER BY sp.case_no, sp.next_date_of_hearing";

        $revertList = $dbb->query($sql1, array(MB_DEPARTMENT, MB_DEPUTY_COMM, $previousCabFinalisedDate,$currentCabCreatedDate,1,SETTLEMENT_PGR_VGR_LAND_ID));
        log_message('error',"MB.NOTUNDERCAB----------SettlementQuery--------".$dbb->last_query());
        return $revertList->result();
    }


    public function getAllVGRCasesFromMemoForFinalApproval($dbb,$cab_id,$user_code)
    {
        $status = CAB_MEMO_DOC_GENERATED;
        $final_submit_status = FINAL_SUBMISSION_PENDING;
        $final_status = TEMP_APPROVE_BY_DEPT;
        $sql = "select * from cab_memo_list where cab_id =? and user_code =? and status =? and vgr_cab =? and final_status = ? and final_submit_status = ? order by id";
        $data  = $dbb->query($sql, array($cab_id,$user_code,$status,1,$final_status,$final_submit_status));
        return $data;
    }


    public function getDeptUserDistListWithRevertedCaseCountVGR()
    {
        $unique_user_id = $this->session->userdata('unique_user_id');
        $this->db = $this->load->database('db2', TRUE);
        // $dist_list = $this->db->query("SELECT udb.dist_code FROM depart_users du inner join user_dist_byforcation udb on udb.unique_user_id::int=du.id  where du.unique_user_id='$unique_user_id' and du.active_deactive='E'")->result();
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
        foreach ($dist_list as $key => $value) {
            $caseCount = 0;
            
            if(IS_PRODUCTION == 0 && $value->dist_code !='07') {
                $caseCount = 0;
                $dist_list[$key]->case_count = $caseCount;
                continue;
            }
            $this->db2 = $this->dbswitch2($value->dist_code);
            $sqlForCaseCountAgainstDistrict = $this->db2->query("SELECT count(*) as total FROM settlement_basic WHERE dist_code = ? and dept_vgr_revert =? and service_code =?
                ",array($value->dist_code,1,SETTLEMENT_PGR_VGR_LAND_ID))->row();
            if(!empty($sqlForCaseCountAgainstDistrict) && isset($sqlForCaseCountAgainstDistrict) && $sqlForCaseCountAgainstDistrict != null){
                $caseCount = $sqlForCaseCountAgainstDistrict->total;
            }
            $dist_list[$key]->case_count = $caseCount;
        }
        return $dist_list;
    }


    public function getAllRevertedCasesUnderDepartmentVGR($dbb,$start, $length, $order, $service_code)
    {
        $pending_officer = MB_DEPARTMENT;
        $from_office = MB_DEPUTY_COMM;
        $searchByCol_0 = strtoupper($this->input->post('columns')[1]['search']['value']);
        if(!empty($searchByCol_0)){
            $dbb->where('case_no like \'%'.$searchByCol_0.'%\'');

        }
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }

        $dbb->select('*');
        $dbb->from('settlement_basic');
        $dbb->where('dept_vgr_revert', 1);
        $dbb->where('service_code', SETTLEMENT_PGR_VGR_LAND_ID);
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
            $dbb->select('*');
            $dbb->from('settlement_basic');
            $dbb->where('dept_vgr_revert', 1);
            $dbb->where('service_code', SETTLEMENT_PGR_VGR_LAND_ID);
            $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }


    public function getDistrictCasesUnderCabMemo($dbb,$cab_memo_id)
    {

        $sql = "select distinct dist_code,case_no from cab_memo_list where cab_id = ? group by dist_code,case_no";
        $data  = $dbb->query($sql, array($cab_memo_id));
        return $data;
    }


    public function getClusterIdByCaseNo($dbb,$case_no)
    {

        $sql = "select cluster_id from settlement_circle_cluster_cases where case_no =?";
        $data  = $dbb->query($sql, array($case_no));
        return $data->row()->cluster_id;
    }



    public function getMeetingCasesExistInVgrRevert($dbb,$meeting_id)
    {
        $sql = "select case_no,meeting_id
                        from settlement_vgr_pgr_revert_cases 
                        where meeting_id = ? and status = ?";
        $data  = $dbb->query($sql, array($meeting_id,1));
        return $data;
    }

    public function getBasicCasesDetailsVGR($dbb,$case_no)
    {
        $pendingofficer = MB_DEPARTMENT;
        $digitalSign = DIGITAL_SIGN_STATUS;
        $sql = "select sb.*,sm.id as meeting_id, sl.id as proposal_id, sc.id as pro_case_id
                        from settlement_proposal_cases as sc 
                        join settlement_basic sb on sb.case_no = sc.case_no
                        join settlement_proposal_list sl on sl.id = sc.proposal_id
                        join proposal_meeting_list sm on sm.id = sl.proposal_meeting_id
                        where sb.pending_officer = ?  and sb.dept_approval is NULL 
                        and sm.digital_sign_status = ? and sb.case_no =?";
        $data  = $dbb->query($sql, array($pendingofficer,$digitalSign,$case_no));
        return $data;
    }


    public function getRevertedCasesDetailsVGR($dbb,$casesList)
    {
        $sql = "select case_no,status from settlement_vgr_pgr_revert_cases where case_no in ($casesList) and status =?";
        $data  = $dbb->query($sql, array(1));
        return $data;
    }



    //Premium Re Calculate
    public function premiumReCalculation($dbb,$case_no)
    {
        $dagsCheck = $dbb->query("SELECT * FROM settlement_dag_details WHERE case_no = ?", array($case_no));


        if($dagsCheck->num_rows() > 0)
        {
            $dagCheck = $dagsCheck->result();
        }
        else
        {
            return array('status'=>1,'message'=>'Dag not found..case no'.$case_no);
        }

        // $basic = $this->SettlementKhasModel->getSettlementBasic($case_no);
        $basic                = $this->getSettlementBasicData($dbb,$case_no);

        $sumMbAmount=0;
        $sumMbArea=0;
        $finalamount =0;
        foreach ($dagCheck as $premiumdags) {

            $lastId ='';
            $findLastPremium = $dbb->query("SELECT * FROM settlement_premium WHERE case_no = ? and dag_no= ? and is_final =?", array($case_no, $premiumdags->dag_no, 1));

            if($findLastPremium->num_rows() > 0)
            {
                $premData = $findLastPremium->row();
                $lastId = $premData->pid;
                $prem_zonal = $premData->zonal_valuation;
                $prem_rate =  $premData->rate;
                $concession_rate=25;
                $prem_area = $premData->total_lessa;
                $area_name = $premData->area_name;
                $rate_type = $premData->rate_type;
                $amount_dag = $premData->amount_dag;
                $due_amount = $premData->due_amount;
            }
            else
            {             
                return array('status'=>1,'message'=>'Last premium not available for cases...Case no.'.$case_no);
            }

            $findLastArea = $dbb->query("SELECT mb_land,max_land FROM settlement_premium_rate WHERE prid = ?", array($rate_type));

            if($findLastArea->num_rows() > 0)
            {
                $premArea = $findLastArea->row();
            }
            else
            {
                return array('status'=>1,'message'=>'Max area not available for case no...'.$case_no);
            }

            $mb_land = $premArea->mb_land;
            $max_land = $premArea->max_land!=null? $premArea->max_land:0;

            if (in_array($premiumdags->dist_code, json_decode(BARAK_VALLEY_DIST))){
                $area_in_bigha=6400;
                if($mb_land == 25){
                    $mb_land=1600;
                }else if ($mb_land == 30){
                    $mb_land=1920;
                }else if ($mb_land == 40){
                    $mb_land=2560;
                }
            }else{
                $area_in_bigha=100;
            }

            $oldArea = array(1,2,3,4,5,6);
            $premPercentage = array(1,2,3,4,5,6,11,12,13,14,15,16,17);
            $premRupees = array(7,8,9,10,18,19,20,21,22);

            if(in_array($area_name, $oldArea)){
                return array('status'=>3,'message'=>'Old area flag found for this dag, case no: '.$case_no);
            }

            if(in_array($area_name, $premRupees)){
                return array('status'=>2,'message'=>null);
            }

            if ($premData->concession=="YES"){
                if (in_array($area_name, $premPercentage)){
                    if($prem_area>$mb_land){
                        $premium = $mb_land * $prem_zonal / $area_in_bigha;
                        $discount = $prem_rate-($prem_rate * $concession_rate / 100);
                        $amount1 = ceil($premium * $discount / 100);

                        $access_area = $prem_area - $mb_land;
                        $premium2 = ($access_area * ($prem_zonal*1.5)) / $area_in_bigha;
                        $amount2 = ceil($premium2);

                        $finalamount = ceil($amount1 + $amount2);
                    }else{
                        $premium = $prem_area * $prem_zonal / $area_in_bigha;
                        $discount = $prem_rate-($prem_rate * $concession_rate / 100);
                        $amount = ($premium * $discount / 100);
                        // $finalamount = round($amount,2);
                        $finalamount = ceil($amount);
                    }
                    
                }
                else if(in_array($area_name, $premRupees)){
                    $premium = $prem_area * $prem_rate / $area_in_bigha;
                    $discount = $prem_rate - $concession_rate;
                    $amount = ($premium * $discount / 100);
                    $finalamount = ceil($amount);
                }

            }else if($premData->concession=="NO"){

                if (in_array($area_name, $premPercentage)){
                    if($prem_area>$mb_land){
                        $premium = $mb_land * $prem_zonal / $area_in_bigha;
                        $amount1 = ceil($premium * $prem_rate / 100);

                        $access_area = $prem_area - $mb_land;
                        $premium2 = ($access_area * ($prem_zonal * 1.5)) / $area_in_bigha;
                        $amount2 = ceil($premium2);

                        $finalamount = ceil($amount1 + $amount2);
                        
                    }else{
                        $premium = $prem_area * $prem_zonal / $area_in_bigha;
                        $amount = ($premium * $prem_rate / 100);
                        $finalamount = ceil($amount);
                    }
                }
                else if(in_array($area_name, $premRupees)){
                    $premium = $prem_area * $prem_rate / $area_in_bigha;
                    $amount = ($premium * $prem_rate / 100);
                    $finalamount = ceil($amount);
                }
            }

            $sumMbAmount += $finalamount;
            $sumMbArea += $prem_area;

            if ($amount_dag != $finalamount){

                $premiumdata=array(
                    'case_no'=>$case_no,
                    'user_code'=>$this->session->userdata('user_code'),
                    // 'uuid'=>$premdags->uuid,
                    'dag_no'=>$premData->dag_no,
                    'zonal_valuation'=>$premData->zonal_valuation,
                    'area_name'=>$premData->area_name,
                    'land_type'=>$premData->land_type,
                    'rate_type'=>$premData->rate_type,
                    'rate'=>$premData->rate,
                    'concession'=>$premData->concession,
                    'amount_dag'=>$finalamount,
                    'final_amount'=>null,
                    'due_amount'=>null,
                    'total_lessa'=>$prem_area,
                    'is_full_pay'=>$premData->is_full_pay,
                    'is_final'=>1,
                    'date_entry'=>date('Y-m-d h:i:s'),
                    'approve_by'=>$premData->approve_by,
                    'zone_code'=>$premData->zone_code,
                    'subclass_code'=>$premData->subclass_code,
                    'old_zonal_valuation'=>$premData->old_zonal_valuation
                );
        
                $reInsPremium = $dbb->insert('settlement_premium', $premiumdata);
                if ($reInsPremium != 1) {
                    $dbb->trans_rollback();
                    log_message('error', '#ERRSET000102: Updation failed in settlement_premium Case No '.$case_no);
                    return array('status'=>1,'message'=>'#ERRSET000102: Something went wrong Case No '.$case_no);
                }
                
                $sqlprem = "update settlement_premium set is_final=0  WHERE case_no = '$case_no' and pid='$lastId'";
                $updatePrem = $dbb->query($sqlprem);
    
                if ($dbb->affected_rows() == 0)
                {
                    $dbb->trans_rollback();
                    log_message('error', '#ERRSET900311: Updation failed in settlement_premium RTPS Case No '.$case_no);
                    return array('status'=>1,'message'=>'#ERRSET900311: Something went wrong Case No  '.$case_no);
                }

            }
            
            

        }

        if($max_land!=0 && $sumMbArea>$max_land)
        {
            $dbb->trans_rollback();
            log_message('error', '#ERRSET98703161: Max area exceed RTPS Case No '.$case_no);
            return array('status'=>1,'message'=>'#ERRSET98703161: Max area exceed.. Case No  '.$case_no);
        }

        if ($due_amount != $sumMbAmount){

            $sqlPremUpdate = "update settlement_premium set final_amount='$sumMbAmount',due_amount='$sumMbAmount'  WHERE case_no = '$case_no' and is_final=1";
            $updatePremium = $dbb->query($sqlPremUpdate);

            if ($dbb->affected_rows() == 0)
            {
                $dbb->trans_rollback();
                log_message('error', '#ERRSET900316661: Updation failed in settlement_premium66666 RTPS Case No '.$case_no);
                return array('status'=>1,'message'=>'#ERRSET900316661: Something went wrong Case No..'.$case_no);
            }

        }

    }


    public function premiumReCalculationTea($dbb,$case_no)
    {
        $dagsCheck = $dbb->query("SELECT * FROM settlement_dag_details WHERE case_no = ?", array($case_no));
        if($dagsCheck->num_rows() > 0)
        {
            $dagCheck = $dagsCheck->result();
        }
        else
        {
            return array('status'=>1,'message'=>'Dag not found..case no'.$case_no);
        }

        $sumMbAmount=0;
        $sumMbArea=0;
        $finalamount =0;
        foreach ($dagCheck as $premiumdags) {

            if(trim($premiumdags->is_urban) == 'Y')
            {
                return array('status'=>1,'message'=>'Urban flag found!'.$case_no);
            }

            $lastId ='';
            $findLastPremium = $dbb->query("SELECT * FROM settlement_premium WHERE case_no = ? and dag_no= ? and is_final =?", array($case_no, $premiumdags->dag_no, 1));
            if($findLastPremium->num_rows() > 0)
            {
                $premData = $findLastPremium->row();
                $lastId = $premData->pid;
                $prem_zonal = $premData->zonal_valuation;
                $prem_rate =  $premData->rate;
                $concession_rate=25;
                $prem_area = $premData->total_lessa;
                $area_name = $premData->area_name;
                $rate_type = $premData->rate_type;
                $amount_dag = $premData->amount_dag;
                $due_amount = $premData->due_amount;
            }
            else
            {               
                return array('status'=>1,'message'=>'Last premium not available for cases...Case no.'.$case_no);
            }

            if (in_array($premiumdags->dist_code, json_decode(BARAK_VALLEY_DIST)))
            {
                $area_in_bigha=6400;
            }
            else
            {
                $area_in_bigha=100;
            }

            // $get_settlement_basic = $this->SettlementApModel->getSettlementBasicCo($case_no);
            $get_settlement_basic = $this->getSettlementBasicData($dbb,$case_no);


            if(trim($get_settlement_basic->cult_board) == 'TEA')
            {
                //********Rs. 1000 per bigha till 30 bigha and rest zonalvalue */
                $zonalValuePerLessa = $prem_zonal/$area_in_bigha;
                $amountPerLessa = 1000/$area_in_bigha;

                if($prem_area <= 3000)
                {
                    $finalamount = $prem_area * $amountPerLessa;
                }
                else
                {
                    $excessAmount = ($prem_area - 3000) * $zonalValuePerLessa;
                    $thirtyAmount = 3000 * $amountPerLessa;
                    $finalamount = $excessAmount + $thirtyAmount;
                }
            }
            else
            {
                //********30% of zonal value till 30 bigha and rest zonalvalue */
                $zonalValuePerLessa = $prem_zonal/$area_in_bigha;
                $thirtyPercentOfZonalValue = 30/100 * $zonalValuePerLessa;

                if($prem_area <= 3000)
                {
                    $finalamount = $prem_area * $thirtyPercentOfZonalValue;
                }
                else
                {
                    $excessAmount = ($prem_area - 3000) * $zonalValuePerLessa;
                    $thirtyAmount = 3000 * $thirtyPercentOfZonalValue;
                    $finalamount = $excessAmount + $thirtyAmount;
                }
            }

            $sumMbAmount += $finalamount;
            $sumMbArea += $prem_area;

            if ($amount_dag != $finalamount){

                $premiumdata=array(
                    'case_no'=>$case_no,
                    'user_code'=>$this->session->userdata('user_code'),
                    // 'uuid'=>$premdags->uuid,
                    'dag_no'=>$premData->dag_no,
                    'zonal_valuation'=>$premData->zonal_valuation,
                    'area_name'=>$premData->area_name,
                    'land_type'=>$premData->land_type,
                    'rate_type'=>$premData->rate_type,
                    'rate'=>$premData->rate,
                    'concession'=>$premData->concession,
                    'amount_dag'=>$finalamount,
                    'final_amount'=>null,
                    'due_amount'=>null,
                    'total_lessa'=>$prem_area,
                    'is_full_pay'=>$premData->is_full_pay,
                    'is_final'=>1,
                    'date_entry'=>date('Y-m-d h:i:s'),
                    'approve_by'=>$premData->approve_by,
                );
        
                $reInsPremium = $dbb->insert('settlement_premium', $premiumdata);
                if ($reInsPremium != 1) {
                    $dbb->trans_rollback();
                    log_message('error', '#ERRSET000102: Updation failed in settlement_premium Case No '.$case_no);
                    return array('status'=>1,'message'=>'#ERRSET000102: Something went wrong Case No '.$case_no);
                }
                
                $sqlprem = "update settlement_premium set is_final=0  WHERE case_no = '$case_no' and pid='$lastId'";
                $updatePrem = $dbb->query($sqlprem);
    
                if ($dbb->affected_rows() == 0)
                {
                    $dbb->trans_rollback();
                    log_message('error', '#ERRSET900311: Updation failed in settlement_premium RTPS Case No '.$case_no);
                    return array('status'=>1,'message'=>'#ERRSET900311: Something went wrong Case No  '.$case_no);
                }
            }
        }

        if ($due_amount != $sumMbAmount){

            $sqlPremUpdate = "update settlement_premium set final_amount='$sumMbAmount',due_amount='$sumMbAmount'  WHERE case_no = '$case_no' and is_final=1";
            $updatePremium = $dbb->query($sqlPremUpdate);

            if ($dbb->affected_rows() == 0)
            {
                $dbb->trans_rollback();
                log_message('error', '#ERRSET900316661: Updation failed in settlement_premium66666 RTPS Case No '.$case_no);
                return array('status'=>1,'message'=>'#ERRSET900316661: Something went wrong Case No..'.$case_no);
            }

        }    
    }


    public function getExistingCasesUnderCabMemo($dist_code)
    {
        $sql = "select case_no from cab_memo_list where dist_code = ?";
        $data  = $this->db->query($sql, array($dist_code));
        return $data;
    }


    public function checkCaseExistUnderCabMemo($dist_code,$case_no)
    {
        $sql = "select * from cab_memo_list where dist_code = ? and case_no =?";
        $data  = $this->db->query($sql, array($dist_code,$case_no));
        return $data;
    }


    public function getOldCaseDetailsFromCabMemo($dbb,$caseNoOld,$dist_code)
    {
        $sql = "select * from cab_memo_list where case_no =? and dist_code = ?";
        $data  = $dbb->query($sql, array($caseNoOld,$dist_code));
        return $data;
    }


    public function getSettlementVgrReservationDetails($dbb,$duplicateCases)
    {
        $sql = "select * from settlement_vgr_pgr_reservation where case_no in ($duplicateCases)";
        $data  = $dbb->query($sql);
        return $data;
    }

    public function getTotalVgrReservationInDag($dbb,$dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $lot_no, $vill_townprt_code, $dag_no)
    {
        $message = array();

        $totalChitaLessa = $dbb->query('select SUM(dag_area_b*100 + dag_area_k*20 + dag_area_lc) AS chitha_total_lessa from chitha_basic where dist_code = ? and subdiv_code = ? and cir_code = ? and mouza_pargona_code = ? and lot_no = ? and vill_townprt_code = ? and dag_no = ?', array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $lot_no, $vill_townprt_code, $dag_no))->row()->chitha_total_lessa;
        

        $sqlReservation = $dbb->query("select  string_agg(CONCAT('''', case_no, ''''), ',') as case_nos from settlement_vgr_pgr_reservation where dist_code = ? and subdiv_code = ? and cir_code = ? and mouza_pargona_code = ? and lot_no = ? and vill_townprt_code = ? and dag_no = ?", array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $lot_no, $vill_townprt_code, $dag_no));

        if($sqlReservation->num_rows() > 0)
        {
            $reservCaseNos = $sqlReservation->row()->case_nos;

            if($reservCaseNos != null)
            {
                $getTotalReservArea = $dbb->query("SELECT SUM(b.s_dag_area_b*100 + b.s_dag_area_k*20 + b.s_dag_area_lc) AS reserve_total_lessa FROM settlement_dag_details b join settlement_basic a on b.case_no = a.case_no WHERE a.case_no in ($reservCaseNos) and a.status != ?", array('D'));

                if($getTotalReservArea->num_rows() <= 0)
                {
                    $message = array(
                        'responseType' => 0,
                        'msg' => '<h5 class="text-danger text-center"><b>Reservation dag not found in chitha!</b></h5>'
                    );
                }
                else
                {
                    $getTotalReservArea = $getTotalReservArea->row()->reserve_total_lessa;

                    if($getTotalReservArea > $totalChitaLessa)
                    {
                        $message = array(
                            'responseType' => 0,
                            'msg' => '<h5 class="text-danger text-center"><b>Chitha area exceed for reservation location!</b></h5>'
                        );
        
                    }
                    else
                    {
                        $message = array(
                            'responseType' => 2,
                        );
                    }
                }
            }
            else
            {
                if($totalChitaLessa <= 0)
                {
                    $message = array(
                        'responseType' => 0,
                        'msg' => '<h5 class="text-danger text-center"><b>Chitha area exceed for reservation location!</b></h5>'
                    );
    
                }
                else
                {
                    $message = array(
                        'responseType' => 2,
                    );
                }
            }
           
        }
        else
        {
            if($totalChitaLessa <= 0)
            {
                $message = array(
                    'responseType' => 0,
                    'msg' => '<h5 class="text-danger text-center"><b>Chitha area exceed for reservation location!</b></h5>'
                );

            }
            else
            {
                $message = array(
                    'responseType' => 2,
                );
            }
        }

        return $message;
    }

    public function checkPullRequestFinalStatus($dbb,$duplicateCases)
    {
        $sql = "select distinct case_no,final_status from settlement_pull_request where case_no in ($duplicateCases) and final_status = 1";
        $data  = $dbb->query($sql);
        return $data;
    }


    public function getMeetingProposalByCaseNo($dbb,$case)
    {
        $sql =    "SELECT spl.id as proposal_id,sml.id as meeting_id
                        FROM settlement_proposal_cases as spc
                        JOIN settlement_proposal_list AS spl ON spc.proposal_id = spl.id
                        JOIN proposal_meeting_list AS sml ON sml.id = spl.proposal_meeting_id
                        WHERE spc.case_no='$case'";
        $data  = $dbb->query($sql, array($case));
        return $data;
    }


public function getZoneSubclassDetailsByDagLocation($subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$dag_no)
    {
        $sql = "select zone_id,subclass_id,unique_village_code,flag from  dagwise_zone_info where subdiv_code = ? and cir_code =? and mouza_pargona_code =? and lot_no = ? and vill_code =? and dag_no =?";
        $data  = $this->db2->query($sql, array($subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$dag_no));
        return $data->row();
    }


    public function getZonalValueDetails($village_uuid, $zone_id, $subclass_id)
    {
        $zonalValue = $this->db2->select('*')
            ->where('unique_village_code', $village_uuid)
            ->where('zone_code', $zone_id)
            ->where('subclass_code', $subclass_id)
            ->get('villagewise_zone_info');
        return $zonalValue->result();
    }

    function postApiBasundharaMb3($rtpsno, $case, $rmk, $status, $task, $pen)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, API_LINK_MB3 . "applicationStatusUpdate");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'application' => $rtpsno,
            'dharitree' => $case,
            'rmk' => $rmk,
            'status' => $status,
            'task' => $task,
            'pen' => $pen,
            'ip' => '10.177.7.141'
        )));
        $result = curl_exec($curl_handle);
        $httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        if ($httpcode != 200) {
            log_message("error", " Curl-Error in api: " . API_LINK_MB3 . "applicationStatusUpdate with json_data: "
                . json_encode(array(
                    'application' => $rtpsno,
                    'dharitree' => $case,
                    'rmk' => $rmk,
                    'status' => $status,
                    'task' => $task,
                    'pen' => $pen
                )));
            return false;
        }
        curl_close($curl_handle);
        return $result;
    }
}
