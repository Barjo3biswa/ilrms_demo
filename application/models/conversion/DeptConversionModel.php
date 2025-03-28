<?php
class DeptConversionModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function getPetitionBasicDetails($dbb,$case_no)
    {
        $sql = "select * from petition_basic where case_no =?";
        $data  = $dbb->query($sql, array($case_no));
        return $data;
    }

    public function getLandDetails($dbb,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$petition_no)
    {
        $sql = "select dag_no,m_dag_area_b,m_dag_area_k,m_dag_area_lc,patta_no,patta_type_code  from petition_dag_details where dist_code=? and subdiv_code=? and cir_code=? and 
                    mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and petition_no=?";
        $data  = $dbb->query($sql, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$petition_no));
        return $data;
    }


    public function getPattadardetails($dbb,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$petition_no,$dag_no,$patta_no,$patta_type_code)
    {
       
        $sql = "select pdar_name,pdar_guardian,pdar_rel_guar,pdar_add1,pdar_add2 from  petitioner_part where dist_code=?
                       and subdiv_code=? and cir_code=?  and
                        mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and
                       petition_no=? and dag_no=? and TRIM(patta_no) = TRIM(?) and patta_type_code= ?";
        $data  = $dbb->query($sql, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$petition_no,$dag_no,$patta_no, $patta_type_code))->result();
        return $data;
    }

    public function getConversionType($dbb)
	{
        $sql = "select order_type from master_office_mut_type where order_type_code=?";
		$data = $dbb->query($sql, array(CONVERSION_CODE));

		return $data->row()->order_type;
	}

    public function getPetitionLMNote($dbb,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$petition_no)
    {
        $sql = "Select * from  petition_lm_note where dist_code=? and subdiv_code=? and cir_code=?and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and petition_no=? order by note_no desc limit 1";

        $data  = $dbb->query($sql, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$petition_no));
        return $data ;
    }


    public function getLmDetails($dbb,$lm_code,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no)
    {
        $sql = "Select * from  lm_code where lm_code=? and dist_code=? and subdiv_code=? and cir_code=?and mouza_pargona_code=? and lot_no=?";

        $data  = $dbb->query($sql, array($lm_code,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no));
        return $data;
    }

    public function getSkUserDetails($dbb,$user_code,$dist_code,$subdiv_code,$cir_code)
    {
        $sql = "Select * from  users where user_code=? and dist_code=? and subdiv_code=? and cir_code=?";

        $data  = $dbb->query($sql, array($user_code,$dist_code,$subdiv_code,$cir_code));
        return $data;
    }


    public function getBoDetails($dbb,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$petition_no)
    {
        $sql = "Select * from  petition_bo_note  where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and  lot_no=? and vill_townprt_code=?  and petition_no=?";

        $data  = $dbb->query($sql, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$petition_no));
        return $data;
    }


    public function getUserDetails($dbb,$user_code,$dist_code)
    {
        $sql = "Select * from  users where user_code=? and dist_code=?";

        $data  = $dbb->query($sql, array($user_code,$dist_code));
        return $data;
    }


    public function getPetitionProceeding($dbb,$case_no)
    {
        $sql = "Select * from  petition_proceeding where case_no=?";

        $data  = $dbb->query($sql, array($case_no));
        return $data;
    }

    public function getPetitionProceedingDcAdc($dbb,$case_no)
    {
        $sql = "Select * from  petition_proceeding_dc_adc where case_no=? order by proceeding_id";

        $data  = $dbb->query($sql, array($case_no));
        return $data;
    }

    public function getPetitionProceedingDeptJs($dbb,$case_no)
    {
        $sql = "Select * from  petition_proceeding_dc_adc where case_no=? and user_code like 'DEPT%' order by proceeding_id desc limit 1";
        $data  = $dbb->query($sql, array($case_no));
        return $data;
    }

    public function getPetitionBoNote($dbb,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$petition_no)
    {
        $sql = "Select * from  petition_bo_note where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and  lot_no=? and vill_townprt_code=?  and petition_no=?";

        $data  = $dbb->query($sql, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$petition_no));
        return $data;
    }



        function searchBasundharaLink($dbb,$case_no){
        $sql="Select basundhara from  basundhar_application where dharitree='$case_no' ";
        $linkAvail=$dbb->query($sql)->row();
        if($linkAvail){
            $linkAvail=$linkAvail->basundhara;
            $caseRtpsBasu=$this->checkRtpsService($dbb,$linkAvail);
            if($caseRtpsBasu=='RTPS'){
                $apilink=RTPS_API_LINK;
            }
            else{
                $apilink=API_LINK;
            }
            $url = $apilink."uploadfileName?case=" . $linkAvail;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output = json_decode($output);

        }else {
            return false;
        }
    }


    function checkRtpsService($dbb,$case){
        $sql="SELECT basundhara FROM basundhar_application WHERE basundhara=? and (basundhara is not null or basundhara='') ";
        $dataFound=$dbb->query($sql, $case)->row();
        if($dataFound){
            $data = $dataFound->basundhara;
            $var = explode('/', $data);
            $service = $var['0'];
        }else{
            $service = null;
        }
        return $service;
    }


    public function updatePetitionBasicForConversion($dbb, $updateArr, $where)
    {
        $dbb->set($updateArr)->where($where)->update('petition_basic');
        return $dbb->affected_rows();
    }

    public function updateConversionIlrmsByDpt($dbb, $updateArr, $where)
    {
        $dbb->set($updateArr)->where($where)->update('conversion_case_list');
        return $dbb->affected_rows();
    }

    public function getconversionCaseList($dbb,$distCode) {
        $cases = $dbb->query("select * from petition_basic fmb where add_off_desig=? and not_fresh =? and status =? and mut_type=? and dist_code=? and bo_note_yn is not null and case_no ='KAM/PAL/2023-24/18449/OMUT' order by petition_no ASC",
            array(MB_DEPARTMENT,'Y','W',CONVERSION_CODE,$distCode));
        return $cases->result();
    }

    

    public function getPendingCaseListDetails($dbb, $start, $length, $order, $dist_code, $searchByCol_0)
    {
        // Determine column and direction for ordering
        $col = 0;
        $dir = "desc";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }

        // Ensure direction is either asc or desc
        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }

        // Apply ordering
        $order_column = "petition_no"; 
        if ($order != null) {
            $dbb->order_by($order_column, $dir);
        }
        // Build the query to fetch data
        $dbb->select('*');
        $dbb->from('petition_basic');
        $dbb->where('dist_code', $dist_code);
        $dbb->where('add_off_desig', MB_DEPARTMENT);
        $dbb->where('not_fresh', 'Y');
        $dbb->where('status', 'W');
        $dbb->where('mut_type', CONVERSION_CODE);
        $dbb->where('bo_note_yn !=', NULL);
        // $dbb->where('dept_js_approve', NULL);
        // $dbb->where('add_cases_to_memo','N');
        // $dbb->or_where('add_cases_to_memo IS NULL', null, false);
        $dbb->group_start()
            ->where('add_cases_to_memo', 'N')
            ->or_where('add_cases_to_memo IS NULL', null, false)
            ->group_end();
        if ($searchByCol_0 != null) {
            $dbb->like('case_no', $searchByCol_0);
        }
        // Apply limit and offset
        $dbb->limit($length, $start);
        $query = $dbb->get();

        // Check if there are results
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

            // Build the query to count total records
            $dbb->select('*');
            $dbb->from('petition_basic');
            $dbb->where('dist_code', $dist_code);
            $dbb->where('add_off_desig', MB_DEPARTMENT);
            $dbb->where('not_fresh', 'Y');
            $dbb->where('status', 'W');
            $dbb->where('mut_type', CONVERSION_CODE);
            $dbb->where('bo_note_yn !=', NULL);
            //$dbb->where('dept_js_approve', NULL);
            //$dbb->where('add_cases_to_memo', 'N');
            //$dbb->or_where('add_cases_to_memo IS NULL', null, false);
            $dbb->group_start()
                ->where('add_cases_to_memo', 'N')
                ->or_where('add_cases_to_memo IS NULL', null, false)
                ->group_end();

            if ($searchByCol_0 != null) {
                $dbb->like('case_no', $searchByCol_0);
            }

            $data['total_records'] = $dbb->count_all_results();

            return $data;
        }

        return null;
    }



    public function getPendingCaseListPs($dbb,$start, $length, $order,$searchByCol_0)
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
            $dbb->order_by($order, $dir);
        }
        $dbb->select('*');
        $dbb->from('conversion_case_list');
        $dbb->where('status', 1);
        if ($searchByCol_0 != null) {
            $dbb->like('case_no', $searchByCol_0);
        }
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $dbb->select('*');
        $dbb->from('conversion_case_list');
        $dbb->where('status', 1);
        if ($searchByCol_0 != null) {
            $dbb->like('case_no', $searchByCol_0);
        }
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }

    public function deleteConversionCases($dbb) {
        $cases = $dbb->query("delete from conversion_case_list");
        return $cases->result();
    }

    public function getConversionCabinetList($start, $length, $order, $status,$user_code)
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

        $this->db->distinct();
        $this->db->select('cab_id,remarks, created_at,notification_generated,notification_digital_sign_status,notification_digital_signed_date,approved_at,dept_order_no');
        $this->db->from('conversion_cabinet_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        $this->db->limit($length, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $this->db->distinct();
        $this->db->select('cab_id,remarks, created_at,notification_generated,notification_digital_sign_status,notification_digital_signed_date,approved_at,dept_order_no');
        $this->db->from('conversion_cabinet_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        $data['total_records'] = $this->db->count_all_results();
            return $data;
        }
    }

    public function getAllConversionCabList($dist_code,$user_code)
    {
        $sql = "select * from conversion_cabinet_list where dist_code =? and user_code =?  and status in (?, ?)";
        $data  = $this->db->query($sql, array($dist_code,$user_code, GENERATED_CAB_ID, ADD_CASES_UNDER_CAB_ID))->result();
        return $data;
    }

    
    public function updateConversionCabStatus($dbb,$where, $updateData)
    {
        $dbb->set($updateData)->where($where)->update('conversion_cabinet_list');
        return $dbb->affected_rows();
    }

    public function updatePetitionBasicForCab($dhar_db,$case_no, $dist_code, $updateData,$insSetProceed)
    {
        // $dbb->where('case_no', $caseNo);
        // $dbb->where('dist_code', $dist_code);
        // $dbb->update('petition_basic', $updateData);
        // return $dbb->affected_rows();
        $dhar_db->where('case_no', $case_no);
        $dhar_db->where('dist_code', $dist_code);
        $dhar_db->update('petition_basic', $updateData);
        if($dhar_db->affected_rows() != 1){ 
            $dhar_db->trans_rollback();
            log_message("error", "#ERR_UP_SETL_BASIC_001, Error in update, table 'settlement_basic' with last_query ".$dhar_db->last_query());
            return 'SERVER-ERROR';
        }
        // insert into settlement proceeding
        $tstatus2 = $dhar_db->insert('petition_proceeding', $insSetProceed);
        if ($tstatus2!= 1)
        {
            $dhar_db->trans_rollback();
            log_message("error", "#ERR_IN_SETL_PRO_002, Error in insert, table 'petition_proceeding' with last_query ".$dhar_db->last_query());
            return 'SERVER-ERROR';
        }
        else{
            return 'success'; 
        }
    }

    public function getMemoNameByCabId($dbb,$cab_id)
    {
        $sql = "select cab_memo_name from conversion_cabinet_list where cab_id = ?";
        $data  = $dbb->query($sql, array($cab_id))->row()->cab_memo_name;
        return $data;
    }

    public function getPendingConversionCabinetList($start, $length, $order,$user_code)
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

        $this->db->distinct();
        $this->db->select('cab_id, status,created_at,notification_generated,notification_digital_sign_status,notification_digital_signed_date,approved_at,dept_order_no');
        $this->db->from('conversion_cabinet_list');
        // $this->db->where('user_code', $user_code);
        $this->db->where_in('status', [2,3]);
        $this->db->limit($length, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $this->db->distinct();
        $this->db->select('cab_id,status, created_at,notification_generated,notification_digital_sign_status,notification_digital_signed_date,approved_at,dept_order_no');
        $this->db->from('conversion_cabinet_list');
        // $this->db->where('user_code', $user_code);
        $this->db->where_in('status', [2,3]);
        $data['total_records'] = $this->db->count_all_results();
            return $data;
        }
    }


    public function checkCabMemoStatus($dbb,$cab_id)
    {
        $sql = "select status from conversion_cabinet_list where cab_id = ?";
        $data  = $dbb->query($sql, array($cab_id))->row();
        return $data;
    }

    public function getAllCasesUnderCabinet($dbb,$cab_id)
    {
        $sql = "select case_no,cab_id,status,final_status from conversion_case_list where cab_id = ?";
        $data  = $dbb->query($sql, array($cab_id))->result();
        return $data;
    }

    public function getDistrictUnderCabMemo($dbb,$cab_id)
    {

        $sql = "select distinct dist_code from conversion_case_list where cab_id = ?";
        $data  = $dbb->query($sql, array($cab_id));
        return $data;
    }

    public function getConversionCasesForFinalSubmit($dbb,$cab_id,$user_code,$dist)
    {

        $sql = "select case_no,cab_id,status,final_status from conversion_case_list where cab_id = ? and user_code = ? and dist_code =? and final_status =?";
        $data  = $dbb->query($sql, array($cab_id, $user_code,$dist,1));
        return $data;
    }

        public function getApprovedConversionCabinetList($start, $length, $order,$user_code)
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

        $this->db->distinct();
        $this->db->select('cab_id, status,created_at,notification_generated,notification_digital_sign_status,notification_digital_signed_date,approved_at,dept_order_no');
        $this->db->from('conversion_cabinet_list');
        $this->db->where_in('status', 5);
        $this->db->limit($length, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $this->db->distinct();
        $this->db->select('cab_id,status, created_at,notification_generated,notification_digital_sign_status,notification_digital_signed_date,approved_at,dept_order_no');
        $this->db->from('conversion_cabinet_list');
        $this->db->where_in('status', 5);
        $data['total_records'] = $this->db->count_all_results();
            return $data;
        }
    }

    public function getAllCasesbyCabId($dbb,$start, $length, $order,$cab_id)
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
        $dbb->from('conversion_case_list');
        $dbb->where('cab_id', $cab_id);
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0){
            $data['data_results'] = $query->result();
            $dbb->select('*');
            $dbb->from('conversion_case_list');
            $dbb->where('cab_id', $cab_id);
            $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }


    public function getPendingCaseListDetailsForVerificationSO($dbb,$start, $length, $order, $dist_code,$searchByCol_0)
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
            $dbb->order_by($order, $dir);
        }
        $dbb->select('*');
        $dbb->from('petition_basic');
        $dbb->where('dist_code', $dist_code);
        $dbb->where('add_off_desig', MB_DEPARTMENT);
        $dbb->where('not_fresh', 'Y');
        $dbb->where('status', 'W');
        $dbb->where('mut_type', CONVERSION_CODE);
        $dbb->where('bo_note_yn !=', NULL);
        $dbb->where('dept_js_approve', NULL);
        $dbb->where('so_verification', 'S');
        $dbb->where('ast_verification', NULL);
        $dbb->where('add_cases_to_memo', 'N');
        $dbb->or_where('add_cases_to_memo IS NULL', null, false);

        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $dbb->select('*');
        $dbb->from('petition_basic');
        $dbb->where('dist_code', $dist_code);
        $dbb->where('add_off_desig', MB_DEPARTMENT);
        $dbb->where('not_fresh', 'Y');
        $dbb->where('status', 'W');
        $dbb->where('mut_type', CONVERSION_CODE);
        $dbb->where('bo_note_yn !=', NULL);
        $dbb->where('dept_js_approve', NULL);
        $dbb->where('so_verification', 'S');
        $dbb->where('ast_verification', NULL);
        $dbb->where('add_cases_to_memo', 'N');
        $dbb->or_where('add_cases_to_memo IS NULL', null, false);

        if ($searchByCol_0 != null) {
            $dbb->like('locname_eng', $searchByCol_0);
        }
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }



    public function getPendingCaseListDetailsForVerificationAsst($dbb,$start, $length, $order, $dist_code,$searchByCol_0)
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
            $dbb->order_by($order, $dir);
        }
        $dbb->select('*');
        $dbb->from('petition_basic');
        $dbb->where('dist_code', $dist_code);
        $dbb->where('add_off_desig', MB_DEPARTMENT);
        $dbb->where('not_fresh', 'Y');
        $dbb->where('status', 'W');
        $dbb->where('mut_type', CONVERSION_CODE);
        $dbb->where('bo_note_yn !=', NULL);
        //$dbb->where('dept_js_approve', NULL);
        $dbb->where('ast_verification', 'S');
        //$dbb->where('add_cases_to_memo', 'N');
        // $dbb->or_where('add_cases_to_memo IS NULL', null, false);
        if ($searchByCol_0 != null) {
            $dbb->like('case_no', $searchByCol_0);
        }
        $dbb->group_start()
            ->where('add_cases_to_memo', 'N')
            ->or_where('add_cases_to_memo IS NULL', null, false)
            ->group_end();
        if ($searchByCol_0 != null) {
            $dbb->like('case_no', $searchByCol_0);
        }
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $dbb->select('*');
        $dbb->from('petition_basic');
        $dbb->where('dist_code', $dist_code);
        $dbb->where('add_off_desig', MB_DEPARTMENT);
        $dbb->where('not_fresh', 'Y');
        $dbb->where('status', 'W');
        $dbb->where('mut_type', CONVERSION_CODE);
        $dbb->where('bo_note_yn !=', NULL);
        //$dbb->where('dept_js_approve', NULL);
        // $dbb->where('so_verification', 'S');
        $dbb->where('ast_verification', 'S');
        // $dbb->where('add_cases_to_memo', 'N');
        // $dbb->or_where('add_cases_to_memo IS NULL', null, false);
        $dbb->group_start()
            ->where('add_cases_to_memo', 'N')
            ->or_where('add_cases_to_memo IS NULL', null, false)
            ->group_end();
        if ($searchByCol_0 != null) {
            $dbb->like('case_no', $searchByCol_0);
        }
        if ($searchByCol_0 != null) {
            $dbb->like('case_no', $searchByCol_0);
        }
        // if ($searchByCol_0 != null) {
        //     $dbb->like('locname_eng', $searchByCol_0);
        // }
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }

    public function getAllUnverifiedPendingCases($dbb,$casesList)
    {
        $sql = "SELECT so_verification, ast_verification, case_no FROM petition_basic WHERE case_no IN ($casesList) 	AND (so_verification NOT IN ('A', 'R') OR so_verification IS NULL)
	    AND (ast_verification NOT IN ('A', 'R') OR ast_verification IS NULL)";
        $data  = $dbb->query($sql);
        return $data;
    }


    public function getPendingProposalCaseListDetails($dbb,$start, $length, $order,$searchByCol_0)
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
            $dbb->order_by($order, $dir);
        }
        $dbb->select('*');
        $dbb->from('conversion_proposal_case_list');
        $dbb->where('status', 'P');
        $dbb->where('proposal_no', NULL);


        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $dbb->select('*');
        $dbb->from('conversion_proposal_case_list');
        $dbb->where('status', 'P');
        $dbb->where('proposal_no', NULL);

        if ($searchByCol_0 != null) {
            $dbb->like('locname_eng', $searchByCol_0);
        }
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }

    public function updateConversionProposal($dbb, $updateArr, $where)
    {
        $dbb->set($updateArr)->where($where)->update('conversion_proposal_case_list');
        return $dbb->affected_rows();
    }

    public function getGeneratedProposalListData($start, $length, $order)
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
        $this->db->from('proposal_list');
        // $this->db->where('user_code', $user_code);
        // $this->db->where('status', $status);
        $this->db->limit($length, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $this->db->select('*');
        $this->db->from('proposal_list');
        // $this->db->where('user_code', $user_code);
        // $this->db->where('status', $status);
        $data['total_records'] = $this->db->count_all_results();
            return $data;
        }
    }
    

    public function getAllCaseListbyProposalId($dbb,$start, $length, $order,$proposal_id)
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
        $dbb->from('conversion_proposal_case_list');
        $dbb->where('proposal_no', $proposal_id);
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0){
            $data['data_results'] = $query->result();
            $dbb->select('*');
            $dbb->from('conversion_proposal_case_list');
            $dbb->where('proposal_no', $proposal_id);
            $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }


    public function getAllCasesByProposalId($dbb,$proposal_no)
    {
        $sql = "SELECT * FROM conversion_proposal_case_list WHERE proposal_no=?";
        $data  = $dbb->query($sql,array($proposal_no));
        return $data;
    }

    public function updateProposalList($dbb, $updateArr, $where)
    {
        $dbb->set($updateArr)->where($where)->update('proposal_list');
        return $dbb->affected_rows();
    }


    public function getAssistantVerificationDetails($dbb,$case_no)
    {
        $sql = "SELECT * FROM assistant_verification_details WHERE case_no=?";
        $data  = $dbb->query($sql,array($case_no));
        return $data;
    }

    public function getAllApplicantBuyersName($dbb,$case)
    {
        $sql = "select * from settlement_applicant where case_no =?";
        $data  = $dbb->query($sql, array($case));
        return $data;
    }

    public function getCaseDetailsToBeReverted($dbb,$commaSeparatedCases)
    {
        $sql = "select case_no,dist_code,ast_verification,ast_remarks from petition_basic where case_no in ($commaSeparatedCases)";
        $data  = $dbb->query($sql);
        return  $data;

    }


    public function checkCaseVerificationByAsst($dbb,$case_no)
    {
        $sql = "SELECT * FROM assistant_verification_details WHERE case_no=?";
        $data  = $dbb->query($sql,array($case_no));
        return $data;
    }

    public function getCaseDetailsFromProposalList($dbb,$case_no)
    {
        $sql = "SELECT * FROM conversion_proposal_case_list WHERE case_no=?";
        $data  = $dbb->query($sql,array($case_no));
        return $data;
    }

    public function getExistingCasesUnderProposal($dbb,$casesList)
    {
        $sql = "SELECT case_no, proposal_no FROM conversion_proposal_case_list WHERE case_no IN ($casesList)";
        $data  = $dbb->query($sql);
        return $data;
    }

}

