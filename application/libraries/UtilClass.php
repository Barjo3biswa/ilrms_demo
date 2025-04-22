<?php
//BRD004: Improvment in LandBank
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UtilClass
{

	public function __construct()
	{

		// $this->dbswitch();
	}

	public function dbswitch($dist_code)
	{
		$CI = &get_instance();

		if ($dist_code == "02") {
			$CI->db2 = $CI->load->database('dhubri', TRUE);
		} else if ($dist_code == "05") {
			$CI->db2 = $CI->load->database('barpeta', TRUE);
		} else if ($dist_code == "10") {
			$CI->db2 = $CI->load->database('chirang', TRUE);
		} else if ($dist_code == "13") {
			$CI->db2 = $CI->load->database('bongaigaon', TRUE);
		} else if ($dist_code == "17") {
			$CI->db2 = $CI->load->database('dibrugarh', TRUE);
		} else if ($dist_code == "15") {
			$CI->db2 = $CI->load->database('jorhat', TRUE);
		} else if ($dist_code == "14") {
			$CI->db2 = $CI->load->database('golaghat', TRUE);
		} else if ($dist_code == "07") {
			$CI->db2 = $CI->load->database('kamrup', TRUE);
		} else if ($dist_code == "03") {
			$CI->db2 = $CI->load->database('goalpara', TRUE);
		} else if ($dist_code == "18") {
			$CI->db2 = $CI->load->database('tinsukia', TRUE);
		} else if ($dist_code == "12") {
			$CI->db2 = $CI->load->database('lakhimpur', TRUE);
		} else if ($dist_code == "24") {
			$CI->db2 = $CI->load->database('kamrupm', TRUE);
		} else if ($dist_code == "06") {
			$CI->db2 = $CI->load->database('nalbari', TRUE);
		} else if ($dist_code == "11") {
			$CI->db2 = $CI->load->database('sonitpur', TRUE);
		} else if ($dist_code == "16") {
			$CI->db2 = $CI->load->database('sibsagar', TRUE);
		} else if ($dist_code == "32") {
			$CI->db2 = $CI->load->database('morigaon', TRUE);
		} else if ($dist_code == "33") {
			$CI->db2 = $CI->load->database('nagaon', TRUE);
		} else if ($dist_code == "34") {
			$CI->db2 = $CI->load->database('majuli', TRUE);
		} else if ($dist_code == "21") {
			$CI->db2 = $CI->load->database('karimganj', TRUE);
		} else if ($dist_code == "35") {
			$CI->db2 = $CI->load->database('biswanath', TRUE);
		} else if ($dist_code == "36") {
			$CI->db2 = $CI->load->database('hojai', TRUE);
		} else if ($dist_code == "37") {
			$CI->db2 = $CI->load->database('charaideo', TRUE);
		} else if ($dist_code == "25") {
			$CI->db2 = $CI->load->database('dhemaji', TRUE);
		} else if ($dist_code == "39") {
			$CI->db2 = $CI->load->database('bajali', TRUE);
		} else if ($dist_code == "38") {
			$CI->db2 = $CI->load->database('ssalmara', TRUE);
		} else if ($dist_code == "08") {
			$CI->db2 = $CI->load->database('darrang', TRUE);
		} else if ($dist_code == "auth") {
			$CI->db2 = $CI->load->database('auth', TRUE);
		}
		return $CI->db2;
	}

	////////////////////////////////////////
	public function getDistrictName($dist_code)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);

		$district = $CI->db2->query("select loc_name AS district from location where dist_code ='$dist_code'  and "
			. " subdiv_code='00' and cir_code='00' and mouza_pargona_code='00' and "
			. " vill_townprt_code='00000' and lot_no='00'");
		return $district->row()->district;
	}

	public function getSubDivName($dist_code, $subdiv_code)
	{
		$CI = &get_instance();

		$this->dbswitch($dist_code);
		$subdiv = $CI->db2->query("select loc_name AS subdiv from location where dist_code ='$dist_code'  and "
			. " subdiv_code='$subdiv_code' and cir_code='00' and mouza_pargona_code='00' and "
			. " vill_townprt_code='00000' and lot_no='00'");
		return $subdiv->row()->subdiv;
	}

	public function getCircleName($dist_code, $subdiv_code, $circle_code)
	{
		$CI = &get_instance();
		$this->dbswitch($dist_code);
		$circle = $CI->db2->query("select loc_name AS circle from location where dist_code ='$dist_code'  and "
			. " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='00' and "
			. " vill_townprt_code='00000' and lot_no='00'");

		return $circle->row()->circle;
	}

	//function created for displaying the mouza name
	public function getMouzaName($dist_code, $subdiv_code, $circle_code, $mouza_code)
	{
		$CI = &get_instance();
		$this->dbswitch($dist_code);
		//$ds=$CI->session->userdata['db'];
		$mouza = $CI->db2->query("select loc_name AS mouza from location where dist_code ='$dist_code'  and "
			. " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
			. " vill_townprt_code='00000' and lot_no='00'");
		return $mouza->row()->mouza;
	}
	//function created for displaying the village name
	public function getVillageName($dist_code, $subdiv_code, $circle_code, $mouza_code, $lot_no, $vill_code)
	{
		$CI = &get_instance();
		$this->dbswitch($dist_code);
		//$ds=$CI->session->userdata['db'];
		$village = $CI->db2->query("select loc_name AS village from location where dist_code ='$dist_code'  and "
			. " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
			. " vill_townprt_code='$vill_code' and lot_no='$lot_no'");

		return $village->row()->village;
	}

	function getPattaType($patta_type_code)
	{
		$CI = &get_instance();
		$pattatype = $CI->db2->query("select patta_type,pattatype_eng from patta_code where 
				type_code ='$patta_type_code'");

		return $pattatype->row()->patta_type;
	}


	function getGuardianRelation($relation)
	{
		if (!$relation) return 'NA';
		$CI = &get_instance();
		$guardianrel = $CI->db2->query("select guard_rel_desc,guard_rel_desc_as from master_guard_rel where 
				id ='$relation'");

		return $guardianrel->row()->guard_rel_desc;
	}


	function getGender($gender_id)
	{
		if (!$gender_id) return 'NA';
		$CI = &get_instance();
		$gender = $CI->db2->query("select gen_name_eng from master_gender where 
				id ='$gender_id'");

		return $gender->row()->gen_name_eng;
	}


	/*function getCasteName($caste_id)
	{
		if (!$caste_id) return 'NA';
		$CI = &get_instance();
		$caste = $CI->db2->query("select caset_name_eng,caste_name_ass from master_caste where 
				caste_id ='$caste_id'");
		return $caste->row()->caset_name_eng;
	}*/


	function getCaseNO($application_no)
	{

		$CI = &get_instance();
		$application = $CI->db2->query("select dharitree from master_gender where 
				id ='$application_no'");

		return $application->row()->dharitree;
	}

	function  getLandFallsType($class_id)
	{
		if (!$class_id) {
			return 'NA';
		} elseif ($class_id == '1') {
			return  'VGR';
		} elseif ($class_id == '2') {
			return  'PGR';
		} elseif ($class_id == '3') {
			return  'Wet Land';
		} elseif ($class_id == '4') {
			return  'CS LAnd';
		} elseif ($class_id == '5') {
			return  'Khas Govt Land';
		} elseif ($class_id == '6') {
			return  'NR Govt Land';
		} elseif ($class_id == '7') {
			return  'Green Belt Area';
		} elseif ($class_id == '8') {
			return  'Reserved for Govt Departments';
		} elseif ($class_id == '9') {
			return  'Ancient Monuments';
		} elseif ($class_id == '10') {
			return  'Reserved for other Purposes';
		} elseif ($class_id == '11') {
			return  'RF';
		} elseif ($class_id == '12') {
			return  'PRF';
		} elseif ($class_id == '13') {
			return  'Un-classed Forest land';
		} elseif ($class_id == '14') {
			return  'Under Wild Life Sanctuary';
		} elseif ($class_id == '15') {
			return  'Any Land Barred for Allotment';
		} elseif ($class_id == '16') {
			return  'Settlement by a Judicial Pronouncement or any Central or State Legislation';
		}
	}


	function getProtectedClass($class_id)
	{
		if (!$class_id) {
			return 'NA';
		} elseif ($class_id == '1') {
			return  'Plains Tribals';
		} elseif ($class_id == '2') {
			return  'Hills Tribals';
		} elseif ($class_id == '3') {
			return  'Tea Garden Tribals';
		} elseif ($class_id == '4') {
			return  'Santhals';
		} elseif ($class_id == '5') {
			return  'Nepali Cultivator graziers';
		} elseif ($class_id == '6') {
			return  'Scheduled Class';
		} elseif ($class_id == '7') {
			return  'Koch Rajbongshis';
		} elseif ($class_id == '8') {
			return  'Indigenous Nath (yogi)';
		} elseif ($class_id == '9') {
			return  'Tai Ahom';
		} elseif ($class_id == '10') {
			return  'Chutia';
		} elseif ($class_id == '11') {
			return  'Gorkha';
		} elseif ($class_id == '12') {
			return  'Moran';
		} elseif ($class_id == '13') {
			return  'Matak';
		}
	}



	function  getDistrictNameOnLanding($dist_code)
	{
		if (!$dist_code) {
			return 'NA';
		} elseif ($dist_code == '02') {
			return  'DHUBRI';
		} elseif ($dist_code == '03') {
			return  'GOALPARA';
		} elseif ($dist_code == '05') {
			return  'BARPETA';
		} elseif ($dist_code == '06') {
			return  'NALBARI';
		} elseif ($dist_code == '07') {
			return  'KAMRUP';
		} elseif ($dist_code == '08') {
			return  'DARRANG';
		} elseif ($dist_code == '10') {
			return  'CHIRANG';
		}elseif ($dist_code == '11'){
			return  'SONITPUR';
		}
		 elseif ($dist_code == '12') {
			return  'LAKIMPUR';
		} elseif ($dist_code == '13') {
			return  'BONGAIGAON';
		} elseif ($dist_code == '14') {
			return  'GOLAGHAT';
		} elseif ($dist_code == '15') {
			return  'JORHAT';
		} elseif ($dist_code == '16') {
			return  'SIVASAGAR';
		} elseif ($dist_code == '17') {
			return  'DIBRUGARH';
		} elseif ($dist_code == '18') {
			return  'TINSUKIA';
		} elseif ($dist_code == '24') {
			return  'KAMRUP(M)';
		} else if ($dist_code == "32") {
			return 'MORIGAON';
		} else if ($dist_code == "33") {
			return 'NAGAON';
		} else if ($dist_code == "34") {
			return 'MAJULI';
		} else if ($dist_code == "21") {
			return 'KARIMGANJ';
		} else if ($dist_code == "35") {
			return 'BISWANATH';
		} else if ($dist_code == "36") {
			return 'HOJAI';
		} else if ($dist_code == "37") {
			return 'CHARAIDEO';
		} else if ($dist_code == "25") {
			return 'DHEMAJI';
		} else if ($dist_code == "39") {
			return 'BAJALI';
		} else if ($dist_code == "38") {
			return 'S. SALMARA';
		}
	}

	// Get Lot Name added on 31/10/22
	public function getLotName($dist_code, $subdiv_code, $circle_code, $mouza_code, $lot_no)
	{
		$CI = &get_instance();
		$this->dbswitch($dist_code);
		//$ds=$CI->session->userdata['db'];
		$lot = $CI->db2->query("select loc_name AS lot from location where dist_code ='$dist_code'  and "
			. " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and lot_no='$lot_no' and"
			. " vill_townprt_code='00000'");
		return $lot->row()->lot;
	}

	function  getServiceName($service_code)
	{
		if (!$service_code) {
			return 'NA';
		} elseif (
			$service_code == SETTLEMENT_TENANT_ID
		) {
			return  'SETTLEMENT TENANT';
		} elseif ($service_code == SETTLEMENT_AP_TRANSFER_ID) {
			return  'SETTLEMENT AP TRANSFER';
		} elseif ($service_code == SETTLEMENT_TRIBAL_COMMUNITY_ID) {
			return  'SETTLEMENT TRIBAL COMMUNITY';
		} elseif ($service_code == SETTLEMENT_KHAS_LAND_ID) {
			return  'SETTLEMENT KHAS LAND';
		} elseif ($service_code == SETTLEMENT_PGR_VGR_LAND_ID) {
			return  'SETTLEMENT PGR VGR LAND';
		} elseif ($service_code == SETTLEMENT_SPECIAL_CULTIVATORS_ID) {
			return  'SETTLEMENT SPECIAL CULTIVATORS';
		} elseif ($service_code == OFFLINE_SETTLEMENT_ID) {
			return  'OFFLINE SETTLEMENT KHAS LAND';
		} elseif ($service_code == SETTLEMENT_NC_KHAS_LAND_ID) {
			return  'SETTLEMENT NC KHAS LAND';
		}
	}
        function getLmNote($lm_note)
	{
		if (!$lm_note) {
			return 'NA';
		} elseif (
			$lm_note == '1'
		) {
			return  'LM Reverted note submitted';
		} elseif (
			$lm_note == '2'
		) {
			return  'Case forwarded to CO';
		} elseif (
			$lm_note == '3'
		) {
			return  'Maybe Approve';
		} elseif (
			$lm_note == '4'
		) {
			return  'Maybe Reject';
		}
	}

        function getCasteName($caste_id)
	{
		if (!$caste_id) {
			return 'NA';
		} elseif ($caste_id == '1') {
			return  'ST';
		} elseif ($caste_id == '2') {
			return  'SC';
		} elseif ($caste_id == '3') {
			return  'Tea Garden';
		} elseif ($caste_id == '4') {
			return  'Ex Tea Garden';
		} elseif ($caste_id == '5') {
			return  'OBC';
		} elseif ($caste_id == '6') {
			return  'General';
		}
	} 
	
	public function getLocationFromSession() {
        $CI = & get_instance();
        $CI->load->library('session');
		$dist_code=$CI->session->userdata('dist_code');
        $CI = & get_instance();
        $this->dbswitch($dist_code);
        $location = array(
            'dist_code' => $CI->session->userdata('dist_code'),
            'subdiv_code' => $CI->session->userdata('subdiv_code'),
            'cir_code' => $CI->session->userdata('cir_code'),
            'lot_no' => $CI->session->userdata('lot_no'),
            'vill_townprt_code' => $CI->session->userdata('vill_code'),
            'mouza_pargona_code' => $CI->session->userdata('mouza_pargona_code')
        );
        return $location;
    }
	function Total_Lessa($bigha, $katha, $lessa) {
        $total_lessa = $lessa + ($katha * 20) + ($bigha * 100);
        return $total_lessa;
    }

	function Total_Bigha_Katha_Lessa($total_lessa) {
        $bigha = $total_lessa / 100;
        $rem_lessa = fmod($total_lessa, 100);
        $katha = $rem_lessa / 20;
        $r_lessa = fmod($rem_lessa, 20);
        $mesaure = array();
        $mesaure[].=floor($bigha);
        $mesaure[].=floor($katha);
        $mesaure[].=$r_lessa;
        $mesaure[].=0;
        return $mesaure;
    }

	function generateToken($claims, $time, $ttl, $algorithm, $secret)
	{
		$algorithms = array('HS256' => 'sha256', 'HS384' => 'sha384', 'HS512' => 'sha512');
		$header = array();
		$header['typ'] = 'JWT';
		$header['alg'] = $algorithm;
		$token = array();
		$token[0] = rtrim(strtr(base64_encode(json_encode((object) $header)), '+/', '-_'), '=');
		$claims['iat'] = $time;
		$claims['exp'] = $time + $ttl;
		$token[1] = rtrim(strtr(base64_encode(json_encode((object) $claims)), '+/', '-_'), '=');
		if (!isset($algorithms[$algorithm]))
			return false;
		$hmac = $algorithms[$algorithm];
		$signature = hash_hmac($hmac, "$token[0].$token[1]", $secret, true);
		$token[2] = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');
		return implode('.', $token);
	}

	function createTokenJwt()
	{
		$timestamp = date("Y-m-d H:i:s");
		$CI = &get_instance();
		$CI->output->set_header("Access-Control-Allow-Origin:*");
		$jwt = new JWT();
		$key = SECRET_KEY;
		$payload = array(
			"timestamp" => $timestamp
		);
		$token = $jwt->encode($payload, $key, 'HS256');
		return $token;
	}

	public function getApplidFromCaseNo($dist_code, $case_no)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);

		$applid = $CI->db2->query("select applid from settlement_basic where case_no ='$case_no'");
		if ($applid->num_rows() > 0) {
			return $applid->row()->applid;
		} else {
			return "NA";
		}
		
	}

	public function getDeptApprovalStatusFromSettlementBasic($dist_code, $case_no)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);

		$deptStatus = $CI->db2->query("select dept_approval from settlement_basic where case_no ='$case_no'");
		return $deptStatus->row()->dept_approval;
	}  


        public function getRelationFromDb($id,$dist_code){
			$CI = &get_instance();
            $CI->db2 = $this->dbswitch($dist_code);
        	$query = "select guard_rel_desc_as as name from master_guard_rel where id='$id' ";
       	 	$name = $CI->db2->query($query)->row()->name;
        	return $name;
        }


	public function getSdlacMeetingTime($dist_code,$serviceType, $sdlac_user_code,$proposal_no)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);
 		$member_report_status = SDLAC_MEMBER_REPORT_STATUS_PENDING;
        $meeting_status = SDLAC_MEETING_STATUS_ONLINE;
		 $sql = 	"SELECT pml.expiry_hour_start_time
                        FROM settlement_sdlac_member_report as smr
                        JOIN settlement_proposal_list AS spl ON smr.proposal_no = spl.id
                        JOIN proposal_meeting_list AS pml ON spl.proposal_meeting_id = pml.id
                        WHERE smr.service_code=? AND smr.username =?
                        AND smr.status =? AND smr.meeting_attend_status =? AND smr.proposal_no =? ";
        $data  = $CI->db2->query($sql, array($serviceType, $sdlac_user_code,$member_report_status,$meeting_status,$proposal_no));
        return $data->row()->expiry_hour_start_time;
	}


	public function getProposalName($dist_code,$proposal_no){
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);
		$query = "select proposal_name from settlement_proposal_list where id='$proposal_no' ";
		$proposal_name = $CI->db2->query($query)->row()->proposal_name;
		return $proposal_name;
	}


	public function getCoNoteAgainstCase($dist_code,$case_no){
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);
		$query = "select co_note_yn from settlement_basic where case_no='$case_no' ";
		$co_note_yn = $CI->db2->query($query)->row()->co_note_yn;
		if($co_note_yn == '1'){
			$co_note_text = "<span class='text-success'>Can be Recommended</span>";
		}else if($co_note_yn == '2'){
			$co_note_text = "<span class='text-danger'>Can not be Recommended</span>";
		}else{
			$co_note_text = "";
		}
		return $co_note_text;
	}

		public function getLMNoteAgainstCase($dist_code,$case_no){
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);
		$query = "select lm_note from settlement_ap_lmnote where case_no='$case_no' ";
		$lm_note = $CI->db2->query($query)->row()->lm_note;
		if($lm_note == '1'){
			$lm_note_text = "<span class='text-success'>Can be Recommended</span>";
		}else if($lm_note == '2'){
			$lm_note_text = "<span class='text-danger'>Can not be Recommended</span>";
		}else{
			$lm_note_text = "";
		}
		return $lm_note_text;
	}


	public function getMeetingNameByMeetingId($dist_code, $meeting_id)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);
		$query = "select meeting_name from proposal_meeting_list where id='$meeting_id' ";
		$meeting_name = $CI->db2->query($query)->row()->meeting_name;
		return $meeting_name;
	}

	public function getMeetingNameByMeetingIdOffline($dist_code, $meeting_id)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);
		$query = "select meeting_name from offline_meeting_list where id='$meeting_id' ";
		$meeting_name = $CI->db2->query($query)->row()->meeting_name;
		return $meeting_name;
	}

	public function getMeetingNameByMeetingIdNew($dist_code, $case_no)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);
		$query = "select  pml.meeting_name as meeting_name from settlement_proposal_cases spc   join settlement_proposal_list spl on spc.proposal_id = spl.id
                                join proposal_meeting_list pml on spl.proposal_meeting_id = pml.id
                                    where case_no='$case_no'";
		$meeting_name = $CI->db2->query($query)->row()->meeting_name;
		return $meeting_name;
	}

	public function getProposalNameByProposalId($dist_code, $proposal_id)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);
		$query = "select proposal_name from settlement_proposal_list where id='$proposal_id' ";
		$proposal_name = $CI->db2->query($query)->row()->proposal_name;
		return $proposal_name;
	}


	public function getZonalValue($dist_code, $uuid, $dag_no)
	{

		$CI = &get_instance();
		$this->dbswitch($dist_code);
		$q = "select unique_village_code,dag_no,zone_id,subclass_id from dagwise_zone_info where flag='1' and dist_code='$dist_code' and unique_village_code='$uuid' and dag_no='" . trim($dag_no) . "'";
		$zonaldata = $CI->db2->query($q)->num_rows();

		if ($zonaldata > 0) {
			$zonaldata = $CI->db2->query($q)->row();
			$zonalrate = $CI->db2->query("select land_rate from villagewise_zone_info where flag='1' and unique_village_code='$zonaldata->unique_village_code' and
            zone_code='$zonaldata->zone_id' and subclass_code='$zonaldata->subclass_id'");
			return $zonalrate->row()->land_rate;
		} else {
			return null;
		}
	}


	public function getVillageUUID($dist_code, $subdiv_code, $circle_code, $mouza_code, $lot_no, $vill_code)
	{
		$CI = &get_instance();
		$this->dbswitch($dist_code);
		$villageCode = $CI->db2->query("select uuid AS village from location where dist_code ='$dist_code' and "
			. " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
			. " vill_townprt_code='$vill_code' and lot_no='$lot_no'");
		return $villageCode->row()->village;
	}

	public function dagAreabyCaseNo($dist_code, $case)
	{

		$CI = &get_instance();
		$this->dbswitch($dist_code);

		$sql = "SELECT CONCAT_WS(',', s_dag_area_b, s_dag_area_k, s_dag_area_lc) AS dag_area FROM settlement_dag_details
        WHERE case_no =?";
		$dagsArea  = $CI->db2->query($sql, array($case))->result();

		$dagAreas = array_map(
			function ($item) {
				return $item->dag_area;
			},
			$dagsArea
		);

		$outputArray = [];
		foreach ($dagAreas as $input) {
			$values = explode(",", $input);

			$formattedValues = [];
			for ($i = 0; $i < count($values); $i++) {
				$suffix = '';
				if (
					$i === 0
				) {
					$suffix = '-B';
				} elseif ($i === 1) {
					$suffix = '-K';
				} elseif ($i === 2) {
					$suffix = '-L';
				}
				$formattedValues[] = $values[$i] . $suffix;
			}

			$outputArray[] = '(' . implode(",", $formattedValues) . ')';
		}

		$finalOutput = implode(",", $outputArray);

		return $finalOutput;
	}



	public function getZonalValueByCaseNo($dist_code, $case)
	{
		$CI = &get_instance();
		$this->dbswitch($dist_code);

		$sql = "select string_agg(zonal_valuation::character varying, ',')  as zonal_value
		from settlement_premium where case_no = ? group by zonal_valuation;";
		$zonal  = $CI->db2->query($sql, array($case))->result();

		$zonalValues = array_map(
			function ($item) {
				return $item->zonal_value;
			},
			$zonal
		);

		$outputArray = [];
		foreach ($zonalValues as $input) {
			$values = explode(",", $input);

			$formattedValues = [];
			for ($i = 0; $i < count($values); $i++) {
				$suffix = ' Per Bigha';

				$formattedValues[] = $values[$i] . $suffix;
			}

			$outputArray[] = implode(" ,", $formattedValues);
		}

		$finalOutput = implode(",", $outputArray);

		return $finalOutput;
	}


	public function getHouseTypeByCaseNo($dist_code, $case)
	{

		$CI = &get_instance();
		$this->dbswitch($dist_code);
		$sql = "select dag_no,(select house_type from settlement_premium_rate where prid = p.rate_type) from settlement_premium p where case_no = ? ";
		$rate  = $CI->db2->query($sql, array($case))->result();

		$houseTypes = array_map(
			function ($item) {
				return $item->house_type;
			},
			$rate
		);

		$outputArray = [];
		foreach ($houseTypes as $input) {
			$values = explode(",", $input);

			$formattedValues = [];
			for ($i = 0; $i < count($values); $i++) {
				$suffix = '';

				$formattedValues[] = $values[$i] . $suffix;
			}

			$outputArray[] = implode(" ,", $formattedValues);
		}

		$finalOutput = implode(",", $outputArray);

		return $finalOutput;
	}



	public function getMeetingNameByProposalId($dist_code, $proposal_id)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);
		$query = "select sm.meeting_name from settlement_proposal_cases as sc join settlement_proposal_list as sl
		on sc.proposal_id = sl.id join proposal_meeting_list as sm on sl.proposal_meeting_id = sm.id  where sc.proposal_id = '$proposal_id' ";
		$meeting_name = $CI->db2->query($query)->row()->meeting_name;
		return $meeting_name;
	}





	public function numberToWords($number) {
			// Define arrays for numbers and their text representations
			$units = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine');
			$teens = array('ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen');
			$tens = array('', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety');
			$thousands = array('', 'thousand', 'lakh', 'crore');

			// Check if the number is zero
			if ($number == 0) {
				return 'zero';
			}

			$result = '';
			$position = 0;

			// Process the number in groups of two digits (for the lakhs and crores)
			while ($number > 0) {
				$chunk = $number % 100;
				$number = floor($number / 100);

				// Convert the chunk into words
				$chunkWords = '';

				if ($chunk >= 10 && $chunk <= 19) {
					$chunkWords .= $teens[$chunk - 10];
				} else {
					$tensDigit = floor($chunk / 10);
					$unitsDigit = $chunk % 10;

					if ($tensDigit > 0) {
						$chunkWords .= $tens[$tensDigit];
						if ($unitsDigit > 0) {
							$chunkWords .= ' ';
						}
					}

					if ($unitsDigit > 0) {
						$chunkWords .= $units[$unitsDigit];
					}
				}

				// Add the chunk words and thousands descriptor
				if (!empty($chunkWords)) {
					$result = $chunkWords . ' ' . $thousands[$position] . ' ' . $result;
				}

				$position++;
			}

			return trim($result);
		}


		public function getRevertedRemarksByCaseNo($dist_code, $case_no)
		{
			$CI = &get_instance();
			$CI->db2 = $this->dbswitch($dist_code);

			$remarks = $CI->db2->query("select * from settlement_proceeding where case_no= '$case_no' and office_from ='DPT' and office_to ='DC' and status='R' order by id desc");
			// return $remarks->row()->note_on_order;
			if ($remarks->num_rows() > 0) {
				return $remarks->row()->note_on_order;
			} else {
				return "NA";
			}
		}

		public function getVGRRevertedRemarksByCaseNo($dist_code, $case_no)
		{
			$CI = &get_instance();
			$CI->db2 = $this->dbswitch($dist_code);

			$remarks = $CI->db2->query("select * from settlement_proceeding where case_no= '$case_no' and office_from ='DPT' and office_to ='DC' and status='VR' order by id desc");
			return $remarks->row()->note_on_order;
		}


	public function getServiceNameFromCaseNo($dist_code, $case_no)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);

		// $service_name = $CI->db2->query("select service_code from settlement_basic where case_no ='$case_no'");
		$service_name = $CI->db2->query("
			SELECT
				CASE
					WHEN service_code = '14' THEN 'AP TRANSFER'
					WHEN service_code = '15' THEN 'TRIBAL COMMUNITY'
					WHEN service_code = '16' THEN 'KHAS LAND'
					WHEN service_code = '17' THEN 'PGR/VGR'
					WHEN service_code = '18' THEN 'SPECIAL CULTIVATORS'
					ELSE 'N/A'
				END AS service_name
			FROM settlement_basic
			WHERE case_no = '$case_no'");
		return $service_name->row()->service_name;
	}



	function getGuardianRelationAssamese($relation)
	{
		$relation = strtoLower($relation);
		$CI = &get_instance();
		$guardianrel = $CI->db2->query("select guard_rel_desc_as from master_guard_rel where guard_rel = '$relation'");

		return $guardianrel->row()->guard_rel_desc_as;
	}


	public function getRtpsNoFromCaseNo($dist_code,$case_no)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);

		$result = $CI->db2->query("SELECT basundhara FROM basundhar_application WHERE dharitree ='$case_no'");

		if ($result && $result->num_rows() > 0) {
			return $result->row()->basundhara;
		} else {
			return null;
		}
	}


	public function getLocationCaseDetailsFromPetBasic($dist_code,$case_no) {
        $CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);

		$locationCaseDetails = $CI->db2->query("select * from petition_basic where case_no ='$case_no'")->row();

        $location = array(
            'dist_code' => $locationCaseDetails->dist_code,
            'subdiv_code' => $locationCaseDetails->subdiv_code,
            'cir_code' => $locationCaseDetails->cir_code,
            'mouza_pargona_code' => $locationCaseDetails->mouza_pargona_code,
            'lot_no' => $locationCaseDetails->lot_no,
            'vill_townprt_code' => $locationCaseDetails->vill_townprt_code,
            'so_verification' => $locationCaseDetails->so_verification,
            'ast_verification' => $locationCaseDetails->ast_verification,
            'add_cases_to_memo' => $locationCaseDetails->add_cases_to_memo,
            'submission_date' => $locationCaseDetails->submission_date
        );
        return $location;
    }


    public function getDistrictNameEng($dist_code)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);

		$district = $CI->db2->query("select locname_eng AS district from location where dist_code ='$dist_code'  and "
			. " subdiv_code='00' and cir_code='00' and mouza_pargona_code='00' and "
			. " vill_townprt_code='00000' and lot_no='00'");
		return $district->row()->district;
	}

	//function created for displaying the mouza name
	public function getMouzaNameEng($dist_code, $subdiv_code, $circle_code, $mouza_code)
	{
		$CI = &get_instance();
		$this->dbswitch($dist_code);
		//$ds=$CI->session->userdata['db'];
		$mouza = $CI->db2->query("select locname_eng AS mouza from location where dist_code ='$dist_code'  and "
			. " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
			. " vill_townprt_code='00000' and lot_no='00'");
		return $mouza->row()->mouza;
	}
	public function getApplidFromCaseNoBasundharApplications($dist_code, $case_no)
	{
		$CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);

		$applid = $CI->db2->query("select basundhara from basundhar_application  where dharitree ='$case_no'");
		return $applid->row()->basundhara;
	}

	public function appRelationbyIDMB2($dist_code,$relation) {
        $CI = &get_instance();
		$CI->db2 = $this->dbswitch($dist_code);
        $relation = strtoLower($relation);
        $query = "select guard_rel_desc_as from master_guard_rel where guard_rel = '$relation'";

        $relation = $CI->db2->query($query);
        $row = $relation->num_rows;
        if ($row != 0) {
            return $relation->row()->guard_rel_desc_as;
        }

        return "unkown";
    }
	

}
