<?php
class DeptMb3CabinetModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function getAllMb3CabList($dist_code,$user_code,$service_code)
    {
        $sql = "select * from mb3_cabinet_list where dist_code =? and user_code =? and service_code=? and status in (?, ?)";
        $data  = $this->db->query($sql, array($dist_code,$user_code,$service_code, GENERATED_CAB_ID, ADD_CASES_UNDER_CAB_ID))->result();
        return $data;
    }

    public function getMb3CabinetList($start, $length, $order, $status,$user_code)
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
        $this->db->select('cab_id,remarks, created_at,notification_generated,notification_digital_sign_status,notification_digital_signed_date,approved_at,dept_order_no,ins_cat');
        $this->db->from('mb3_cabinet_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        $this->db->limit($length, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $this->db->distinct();
        $this->db->select('cab_id,remarks, created_at,notification_generated,notification_digital_sign_status,notification_digital_signed_date,approved_at,dept_order_no,ins_cat');
        $this->db->from('mb3_cabinet_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        $data['total_records'] = $this->db->count_all_results();
            return $data;
        }
    }

    public function getMemoNameByCabId($dbb,$cab_id)
    {
        $sql = "select cab_memo_name from mb3_cabinet_list where cab_id = ?";
        $data  = $dbb->query($sql, array($cab_id))->row()->cab_memo_name;
        return $data;
    }

    public function updateMb3CabStatus($dbb,$where, $updateData)
    {
        $dbb->set($updateData)->where($where)->update('mb3_cabinet_list');
        return $dbb->affected_rows();
    }

    public function getserviceFromCaseNo($case_no)
    {
        $string = $case_no;
        $parts = explode('/', $string);

        // Check if there are at least 5 parts (4 slashes means 5 segments)
        if (count($parts) > 4) {
            // Get the part after the 4th slash
            $afterFourthSlash = $parts[4];
            
            // Get the first 4 characters of this part
            $result = substr($afterFourthSlash, 0, 4);
            
            return $result; // Output: OMUT
        } else {
            return "not_found";
        }
    }

    public function updateSettlementBasicForCab($dbb,$caseNo, $dist_code, $updateData)
    {
        $dbb->where('case_no', $caseNo);
        $dbb->where('dist_code', $dist_code);
        $dbb->update('settlement_basic', $updateData);
        return $dbb->affected_rows();
    }

    public function updatePetitionBasicForCab($dbb,$caseNo, $dist_code, $updateData)
    {
        $dbb->where('case_no', $caseNo);
        $dbb->where('dist_code', $dist_code);
        $dbb->update('petition_basic', $updateData);
        return $dbb->affected_rows();
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
        $dbb->from('mb3_case_list');
        $dbb->where('cab_id', $cab_id);
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0){
            $data['data_results'] = $query->result();
            $dbb->select('*');
            $dbb->from('mb3_case_list');
            $dbb->where('cab_id', $cab_id);
            $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }

    public function getPendingMb3CabinetList($start, $length, $order,$user_code)
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
        $this->db->from('mb3_cabinet_list');
        // $this->db->where('user_code', $user_code);
        $this->db->where_in('status', [2,3]);
        $this->db->limit($length, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $this->db->distinct();
        $this->db->select('cab_id,status, created_at,notification_generated,notification_digital_sign_status,notification_digital_signed_date,approved_at,dept_order_no');
        $this->db->from('mb3_cabinet_list');
        // $this->db->where('user_code', $user_code);
        $this->db->where_in('status', [2,3]);
        $data['total_records'] = $this->db->count_all_results();
            return $data;
        }
    }

    public function getCabIdListFromMaster($start, $length, $order, $status)
    {
        // $user_code = $this->user_code;
        $user_code = $this->session->userdata('user_code');
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
        $this->db->select('cab_id, reference_no,remarks, created_at,notification_generated,notification_digital_sign_status,approved_at,dept_order_no');
        // $this->db->select('*');
        $this->db->from('mb3_cabinet_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        // $this->db->where('vgr_cab', 0);
        $this->db->limit($length, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $this->db->distinct();
        $this->db->select('cab_id, reference_no,remarks, created_at,notification_generated,notification_digital_sign_status,approved_at,dept_order_no');
        // $this->db->select('*');
        $this->db->from('mb3_cabinet_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        // $this->db->where('vgr_cab', 0);

        $data['total_records'] = $this->db->count_all_results();
            return $data;
        }
    }

    public function getCasesUnderCabMemo($dbb,$cab_memo_id)
    {

        $sql = "select case_no from mb3_case_list where cab_id = ? and final_status != ? and final_submit_status =?";
        $data  = $dbb->query($sql, array($cab_memo_id,TEMP_REVERT_BY_DEPT,0));
        return $data;
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

    public function getAllApplicantBuyersName($case)
    {

        // $sql = "select string_agg(pdar_name,',') as pdar_name from settlement_applicant where case_no =? and pdar_type =?";
        $sql = "select * from settlement_applicant where case_no =? and pdar_type =?";
        $data  = $this->db2->query($sql, array($case, 'B'));
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

    function getSettlementEncroacher($case_no)
    {

        $query = "SELECT * FROM settlement_applicant WHERE pdar_type='EN' and case_no = '$case_no'";
        $data = $this->db2->query($query)->row();
        return $data;
    }

    function getLandLessVerify($case)
    {
        $sql = "SELECT is_landless FROM settlement_ap_lmnote WHERE case_no = ?";
        $data  = $this->db2->query($sql, array($case));
        return $data;
    }

    function getGeoTag($case_no)
    {
        $query = "SELECT * FROM supportive_document WHERE case_no = '$case_no' and file_name ='Geo Tag Photo'";
        $data = $this->db2->query($query)->result();
        return $data;
    }

    public function getAllCasesFromMemoForFinalApproval($dbb,$cab_id,$user_code)
    {
        $status = CAB_MEMO_DOC_GENERATED;
        $final_submit_status = FINAL_SUBMISSION_PENDING;
        $final_status = TEMP_APPROVE_BY_DEPT;
        $sql = "select * from mb3_case_list where cab_id =? and user_code =? and status =? and final_status = ? and final_submit_status = ? order by id";
        $data  = $dbb->query($sql, array($cab_id,$user_code,$status,$final_status,$final_submit_status));
        return $data;
    }

    public function digitalSignedStatusOfCabId($dbb,$cab_id)
    {
        $sql = "select notification_digital_sign_status from mb3_cabinet_list where cab_id =?";
        $data  = $dbb->query($sql, array($cab_id))->row();
        return $data;
    }

    public function getDistrictUnderCabMemo($dbb,$cab_memo_id)
    {

        $sql = "select distinct dist_code from mb3_case_list where cab_id = ?";
        $data  = $dbb->query($sql, array($cab_memo_id));
        return $data;
    }

    public function getDistrictCasesUnderCabMemo($dbb,$cab_memo_id)
    {

        $sql = "select distinct dist_code,case_no from mb3_case_list where cab_id = ? group by dist_code,case_no";
        $data  = $dbb->query($sql, array($cab_memo_id));
        return $data;
    }

    public function updateCabMemoList($updateData,$where)
    {
        $this->db->set($updateData)->where($where)->update('mb3_case_list');
        return $this->db->affected_rows();
    }

    public function updateCabStatus($dbb,$where, $updateData)
    {
        $dbb->set($updateData)->where($where)->update('mb3_cabinet_list');
        return $dbb->affected_rows();
    }

    public function applicationStatusUpdateBulk($application_no,$case,$rmk,$status,$task,$pen){
        // var_dump($_SERVER['SERVER_ADDR']);
        // die;
        $apilink=API_LINK_MB3.'applicationStatusUpdateBulk';
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $apilink);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'application'   => $application_no,
            'dharitree'     => $case,
            'rmk'           => $rmk,
            'status'        => $status,
            'task'          => $task,
            'pen'           => $pen,
            'ip'            => $_SERVER['SERVER_ADDR'],
        )));
        $result = curl_exec($curl_handle);
        $httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        curl_close($curl_handle);
        if($httpcode != 200){
            return false;
        }
        return json_decode($result);
    }

    public function getCaseListDetailsForFinalSubmit($dbb,$cab_id,$user_code,$dist)
    {

        $sql = "select * from mb3_case_list where cab_id = ? and user_code = ? and dist_code =?";
        $data  = $dbb->query($sql, array($cab_id, $user_code,$dist));
        return $data;
    }

    public function getServiceCodeFromcaseNo($dhar_db,$case_no)
    {
        $service_code = $dhar_db->query("select service_code from settlement_basic where case_no=?",array($case_no))->row();
        return $service_code->service_code;
    }

    public function getMeeting_id_from_case_no($case_no)
    {
        $sql = "select meeting_id from mb3_case_list where case_no = ?";
        $data  = $this->db->query($sql, array($case_no));
        return $data->row()->meeting_id;
    }

    public function updateReclassSuiteBasicForCab($dbb,$caseNo, $dist_code, $updateData)
    {
        $dbb->where('case_no', $caseNo);
        $dbb->where('dist_code', $dist_code);
        $dbb->update('reclass_suite_basic', $updateData);
        return $dbb->affected_rows();
    }




}?>