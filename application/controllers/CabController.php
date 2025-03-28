<?php
class CabController extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->helper('file');
    $this->load->helper('download');
    $this->load->model('CabModel');
    $this->load->model('basundhara/basundharamodel');
    $this->load->model('basundhara/NcSettlementModel');
    $this->load->model('OfflineSettlementModel');
    $this->dept_user_code = $this->session->userdata('user_code');
    $this->unique_user_id = $this->session->userdata('unique_user_id');
    $this->designation = $this->session->userdata('designation');
    // $this->db = NULL;
    $this->db = $this->load->database('db2', TRUE);
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

  public function createCabId() {

    $_POST = json_decode(file_get_contents("php://input"), true);

    if (($this->designation == DEPARTMENT_USERCODE || $this->designation == DPT_JS) && $this->input->post('option') == null ){
      $data['user_assigned_dist'] = $this->CabModel->getDeptUserDistList()->result();
      $data['_view'] = 'cab/createCabId';
      $this->load->view('layouts/main', $data);
    }
    else if (($this->designation == DEPARTMENT_USERCODE || $this->designation == DPT_JS) && $this->input->post('option') == 'edit') {      
      
      $cab_id = $this->input->post('cab_id');

      $sql = $this->db->query("SELECT cab_id, cab_memo_name, reference_no, remarks 
                FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name, reference_no, remarks", 
                  array($cab_id))->row();
      $getSelectedDist = $this->db->query("SELECT dist_code FROM cab_id_list WHERE cab_id=?",
                            array($cab_id))->result();
      $user_assigned_districts = $this->CabModel->getDeptUserDistList()->result();
      echo json_encode(array(
        'responseType'  => 2,
        'cab_id'        => $sql->cab_id,
        'memo_name'     => $sql->cab_memo_name,
        'reference_no'  => $sql->reference_no,
        'remarks'       => $sql->remarks,
        'selected_dist' => $getSelectedDist,
        'all_dist'      => $user_assigned_districts,
      ));
      return;
    }
  }

  public function createCabIdOffline() {

    $_POST = json_decode(file_get_contents("php://input"), true);

    if (($this->designation == DEPARTMENT_USERCODE || $this->designation == DPT_JS) && $this->input->post('option') == null ){
      $data['user_assigned_dist'] = $this->CabModel->getDeptUserDistList()->result();
      $data['_view'] = 'cab/createCabIdOffline';
      $this->load->view('layouts/main', $data);
    }
    else if (($this->designation == DEPARTMENT_USERCODE || $this->designation == DPT_JS) && $this->input->post('option') == 'edit') {      
      
      $cab_id = $this->input->post('cab_id');

      $sql = $this->db->query("SELECT cab_id, cab_memo_name, reference_no, remarks 
                FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name, reference_no, remarks", 
                  array($cab_id))->row();
      $getSelectedDist = $this->db->query("SELECT dist_code FROM cab_id_list WHERE cab_id=?",
                            array($cab_id))->result();
      $user_assigned_districts = $this->CabModel->getDeptUserDistList()->result();
      echo json_encode(array(
        'responseType'  => 2,
        'cab_id'        => $sql->cab_id,
        'memo_name'     => $sql->cab_memo_name,
        'reference_no'  => $sql->reference_no,
        'remarks'       => $sql->remarks,
        'selected_dist' => $getSelectedDist,
        'all_dist'      => $user_assigned_districts,
      ));
      return;
    }
  }

  public function getSequence() {
    $sequence = $this->db->query("select nextval('cab_id_list_id_seq') as count")->row();
    return $sequence->count;
  }

  public function generateCabId() {

    $_POST = json_decode(file_get_contents("php://input"), true);
    $this->load->library('form_validation');

    $this->form_validation->set_rules('selectedDistricts[]', 'District Selection', 'trim|required');

    $this->form_validation->set_rules('cab_memo_name', 'Memo Name', 'trim|required');
    if ($this->form_validation->run() == FALSE)
    {
      echo json_encode(array(
        'responseType' => 1,
        'message'      => 'Validation Issue',
      ));
      return;
    }

    $curr_date       = date('Y-m-d h:i:s');
    $allSelectedList = $this->input->post('selectedDistricts');
    $cab_memo_name   = $this->input->post('cab_memo_name');
    $cab_ref_no      = $this->input->post('cab_ref_no');
    $cab_remarks     = $this->input->post('cab_remarks');
    $editCabId       = $this->input->post('editCabId');    
    $user_code       = $this->dept_user_code;
    $generate_cab    = 'CAB/'.date('Y').'/'.date('Y').$this->getSequence();

    if(!empty($allSelectedList)) {
      foreach ($allSelectedList as $cabid)
      {
        $dist_name = $this->utilclass->getDistrictNameOnLanding($cabid);

        if($editCabId != '' || $editCabId != null){
          $updateCab = [
            'cab_id'     => $editCabId.'__1',
            'updated_at' => $curr_date,
            'status'     => EDITED_CAB_ID,
          ];
          $this->db->where('cab_id', $editCabId);
          $this->db->where('dist_code', $cabid);
          $this->db->update('cab_id_list', $updateCab);
          if($this->db->affected_rows() <= 0){
            log_message('error', '#ERR155: Updation failed '.$this->db->last_query());
            echo json_encode(array(
              'responseType' => 1,
              'message'      => '#ERR155: Something went wrong on updating CAB ID. Kindly contact system administrator',
            ));
            return;
          }
        }

        $insCab = [
          'cab_id'        => $editCabId !=null ? $editCabId : $generate_cab,
          'cab_memo_name' => $cab_memo_name,
          'reference_no'  => $cab_ref_no,
          'remarks'       => $cab_remarks,
          'dist_code'     => $cabid,
          'dist_name'     => $dist_name,
          'user_code'     => $user_code,
          'status'        => GENERATED_CAB_ID,
          'created_at'    => $curr_date,
          'updated_at'    => $curr_date,
        ];
        $insertData = $this->db->insert('cab_id_list', $insCab);
        if($insertData != 1 || $insertData != true){
          log_message('error', '#ERR178: Insertion failed '.$this->db->last_query());
          echo json_encode(array(
            'responseType' => 1,
            'message'      => '#ERR178: Something went wrong on creating CAB ID. Kindly contact system administrator',
          ));
          return;
        }        
      }
      echo json_encode(array(
        'responseType' => 2,
        'message'      => 'CAB ID successfully generated',
      ));
      return;
    }
    else {
      echo json_encode(array(
        'responseType' => 1,
        'message'      => '#ERR167: No District selected',
      ));
      return;
    }      
  }

  public function generateCabIdOffline() {

    $_POST = json_decode(file_get_contents("php://input"), true);
    $this->load->library('form_validation');
    $this->form_validation->set_rules('selectedDistricts[]', 'District Selection', 'trim|required');
    $this->form_validation->set_rules('cab_memo_name', 'Memo Name', 'trim|required');
    if ($this->form_validation->run() == FALSE)
    {
      echo json_encode(array(
        'responseType' => 1,
        'message'      => 'Validation Issue',
      ));
      return;
    }

    $curr_date       = date('Y-m-d h:i:s');
    $allSelectedList = $this->input->post('selectedDistricts');
    $cab_memo_name   = $this->input->post('cab_memo_name');
    $cab_ref_no      = $this->input->post('cab_ref_no');
    $cab_remarks     = $this->input->post('cab_remarks');
    $editCabId       = $this->input->post('editCabId');    
    $user_code       = $this->dept_user_code;
    $generate_cab    = 'CAB/'.date('Y').'/'.date('Y').$this->getSequence();

    if(!empty($allSelectedList)) 
    {
      foreach ($allSelectedList as $cabid)
      {
        $dist_name = $this->utilclass->getDistrictNameOnLanding($cabid);
        if($editCabId != '' || $editCabId != null)
        {
          $updateCab = [
            'cab_id'     => $editCabId.'__1',
            'updated_at' => $curr_date,
            'status'     => EDITED_CAB_ID,
          ];
          $this->db->where('cab_id', $editCabId);
          $this->db->where('dist_code', $cabid);
          $this->db->update('cab_id_list', $updateCab);
          if($this->db->affected_rows() <= 0){
            log_message('error', '#OFFLINEERR155: Updation failed '.$this->db->last_query());
            echo json_encode(array(
              'responseType' => 1,
              'message'      => '#OFFLINEERR155: Something went wrong on updating CAB ID',
            ));
            return;
          }
        }

        $insCab = [
          'cab_id'        => $editCabId !=null ? $editCabId : $generate_cab,
          'cab_memo_name' => $cab_memo_name,
          'reference_no'  => $cab_ref_no,
          'remarks'       => $cab_remarks,
          'dist_code'     => $cabid,
          'dist_name'     => $dist_name,
          'user_code'     => $user_code,
          'status'        => GENERATED_CAB_ID,
          'created_at'    => $curr_date,
          'updated_at'    => $curr_date,
          'offline'       => 'Y'
        ];
        $insertData = $this->db->insert('cab_id_list', $insCab);
        if($insertData != 1 || $insertData != true){
          log_message('error', '#OFFLINEERR178: Insertion failed '.$this->db->last_query());
          echo json_encode(array(
            'responseType' => 1,
            'message'      => '#OFFLINEERR178: Something went wrong on creating CAB ID',
          ));
          return;
        }        
      }
      echo json_encode(array(
        'responseType' => 2,
        'message'      => 'CAB ID successfully generated',
      ));
      return;
    }
    else 
    {
      echo json_encode(array(
        'responseType' => 1,
        'message'      => '#OFFLINEERR167: No District selected',
      ));
      return;
    }      
  }

  public function toBeFinalizeCabId() {
    if ($this->session->userdata('designation') == DEPARTMENT_USERCODE || $this->session->userdata('designation') == DPT_JS) {     
      // $data['user_assigned_dist'] = $this->CabModel->getDeptUserDistList()->result(); 
      $data['_view'] = 'cab/toBeFinalizeCab';
      $this->load->view('layouts/main', $data);
    } else {
      echo "User Not Authorized to View this Page";
    }
  }

  public function toBeFinalizeCabIdOffline() {
    if ($this->session->userdata('designation') == DEPARTMENT_USERCODE || $this->session->userdata('designation') == DPT_JS) {     
      // $data['user_assigned_dist'] = $this->CabModel->getDeptUserDistList()->result(); 
      $data['_view'] = 'cab/toBeFinalizeCabOffline';
      $this->load->view('layouts/main', $data);
    } else {
      echo "User Not Authorized to View this Page";
    }
  }

  public function getCasesByCabId() 
  {
    $_POST = json_decode(file_get_contents("php://input"), true);
    $cab_id = $this->input->post('cab_id');
    $status = $this->input->post('status');

    $result = $this->CabModel->getCasesByCabId($cab_id, $status);
    log_message('error', '#187: '.json_encode($result->result()));

    if($result->num_rows() == 0){
      log_message('error', '#191 : No Cases available for CAB ID '.$cab_id);
      echo json_encode(array(
        'responseType' => 1,
        'message'      => 'No detail found for CAB ID '.$cab_id,
      ));
      return;
    }

    $res = array();
    foreach($result->result() as $row){
      $res[] = "<tr>
        <td>".$row->case_no."</td>
        <td>".$this->utilclass->getDistrictNameOnLanding($row->dist_code)."</td>
      </tr>";
    }
    echo json_encode(array(
      'responseType' => 2,
      'result'       => $res,
    ));
    return;
  }

  public function getCasesByCabIdOffline() 
  {
    $_POST = json_decode(file_get_contents("php://input"), true);
    $cab_id = $this->input->post('cab_id');
    $status = $this->input->post('status');

    $result = $this->CabModel->getCasesByCabId($cab_id, $status);
    log_message('error', '#187: '.json_encode($result->result()));

    if($result->num_rows() == 0){
      log_message('error', '#191 : No Cases available for CAB ID '.$cab_id);
      echo json_encode(array(
        'responseType' => 1,
        'message'      => 'No detail found for CAB ID '.$cab_id,
      ));
      return;
    }

    $res = array();
    foreach($result->result() as $row){
      $res[] = "<tr>
        <td>".$row->case_no."</td>
        <td>".$this->utilclass->getDistrictNameOnLanding($row->dist_code)."</td>
      </tr>";
    }
    echo json_encode(array(
      'responseType' => 2,
      'result'       => $res,
    ));
    return;
  }


  public function toBeFinalizeSave() 
  {
    $_POST = json_decode(file_get_contents("php://input"), true);
    $selectedList = $this->input->post('selectedList');
    $user_code = $this->dept_user_code;
    $curr_date = date('Y-m-d h:i:s');
    // log_message('error', '#269: '.json_encode($selectedList));

    $this->db->trans_begin();

    foreach($selectedList as $r){
      $query = $this->db->query("UPDATE cab_memo_list SET status=?, updated_at=? 
                  WHERE user_code=? AND status=? AND cab_id=?", 
                  array(1, $curr_date, $user_code, 0, $r));

      if($this->db->affected_rows() <= 0) {
        $this->db->trans_rollback();
        log_message('error', '#277 : Updation failed in cab_memo_list '.$this->db->last_query());
        echo json_encode(array(
          'responseType' => 1,
          'message'      => '#277 : Something went wrong. Kindly contact system administrator',
        ));
        return;
      }

      //update cab id master table
      $query = $this->db->query("UPDATE cab_id_list SET status=?, updated_at=? 
                  WHERE user_code=? AND status=? AND cab_id=?", 
                  array(1, $curr_date, $user_code, 0, $r));

      if($this->db->affected_rows() <= 0) {
        $this->db->trans_rollback();
        log_message('error', '#295 : Updation failed in cab_id_list '.$this->db->last_query());
        echo json_encode(array(
          'responseType' => 1,
          'message'      => '#295 : Something went wrong. Kindly contact system administrator',
        ));
        return;
      }
    }
    $this->db->trans_commit();
    echo json_encode(array(
      'responseType' => 2,
      'message'      => 'Successfully prepare for final process',
    ));
    return;
  }

  public function finalApproveCabId() {
    if ($this->session->userdata('designation') == DEPARTMENT_USERCODE || $this->session->userdata('designation') == DPT_JS) {     
      // $data['user_assigned_dist'] = $this->CabModel->getDeptUserDistList()->result(); 
      $data['_view'] = 'cab/finalApprovalCabId';
      $this->load->view('layouts/main', $data);
    } else {
      echo "User Not Authorized to View this Page";
    }
  }

  public function finalApproveCabIdOffline() {
    if ($this->session->userdata('designation') == DEPARTMENT_USERCODE || $this->session->userdata('designation') == DPT_JS) {     
      // $data['user_assigned_dist'] = $this->CabModel->getDeptUserDistList()->result(); 
      $data['_view'] = 'cab/finalApprovalCabIdOffline';
      $this->load->view('layouts/main', $data);
    } else {
      echo "User Not Authorized to View this Page";
    }
  }

  public function finalCabApprovalSave() 
  {
    $_POST = json_decode(file_get_contents("php://input"), true);
    $selectedList = $this->input->post('selectedList');
    $user_code = $this->dept_user_code;
    $curr_date = date('Y-m-d h:i:s');
    // log_message('error', '#392: '.json_encode($selectedList));

    $this->db->trans_begin();

    foreach($selectedList as $r){
      $query = $this->db->query("UPDATE cab_memo_list SET status=?, updated_at=? 
                  WHERE user_code=? AND status=? AND cab_id=?", 
                  array(2, $curr_date, $user_code, 1, $r));

      if($this->db->affected_rows() <= 0) {
        $this->db->trans_rollback();
        log_message('error', '#403 : Updation failed in cab_memo_list '.$this->db->last_query());
        echo json_encode(array(
          'responseType' => 1,
          'message'      => '#403 : Something went wrong. Kindly contact system administrator',
        ));
        return;
      }

      //update cab id master table
      $query = $this->db->query("UPDATE cab_id_list SET status=?, updated_at=? 
                  WHERE user_code=? AND status=? AND cab_id=?", 
                  array(2, $curr_date, $user_code, 1, $r));

      if($this->db->affected_rows() <= 0) {
        $this->db->trans_rollback();
        log_message('error', '#418 : Updation failed in cab_id_list '.$this->db->last_query());
        echo json_encode(array(
          'responseType' => 1,
          'message'      => '#418 : Something went wrong. Kindly contact system administrator',
        ));
        return;
      }
    }
    $this->db->trans_commit();
    echo json_encode(array(
      'responseType' => 2,
      'message'      => 'Final CAB successfully approved',
    ));
    return;
  }

  public function getCabIdByUserDistrict() {
    $json = null;
    $user_code = $this->dept_user_code;
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');
    $status = ADD_CASES_UNDER_CAB_ID;

    $memo_list = $this->CabModel->getCabIdListFromMaster($start, $length, $order,$status);
    // log_message('error', '#204: '.json_encode($memo_list));
    // $total_records = $memo_list->num_rows();

    if(!empty($memo_list)) {

      if($memo_list['total_records'] > 0){

        $data_rows = $memo_list['data_results'];

        foreach($data_rows as $row) {

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

          $created_at = date('d-m-Y',strtotime($row->created_at));

          $link = base_url() . "index.php/CabController/getListOfCasesByCabId?cab_id=".$row->cab_id;
          $view_case = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-edit'></i> &nbsp;Manage Cases</a>";

          $generate_memo = '<button type="button" class="btn btn-sm btn-success" onclick="openModalMemo('."'".$row->cab_id."'".')"><i class="fa fa-file"></i> &nbsp;Generate Memo</button>';

          $link2 = base_url() . "index.php/Basundhara/downloadReportForCabMemo?cab_id=".$row->cab_id;
          $generate_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp;Report</a>";

          $button = $view_case.' '.$generate_memo.' '.$generate_report;

            // if(strtotime(HOLD_All_MB2_CASES_DATE) > strtotime(date('Y-m-d H:i:s')))
            // {
              $button = $view_case.' '.$generate_memo.' '.$generate_report;
            // }else
            // {
            //   $button = $view_case;
            // }


          
          $json[] = array(
            // $sql->cab_memo_name,
            '<span class="text-danger"> '. $sql->cab_memo_name .'</span>',
            '<span class="text-primary"> '. $row->cab_id .'</span>',
            '<small class="text-primary"> '. $sql->dist_name .'</small>',
            // $sql->dist_name,
            $created_at,
            $button,
          );
        }
      }
      else {
        $json = "";
      }      

      $total_records = $memo_list['total_records'];
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

  public function getCabIdByUserDistrictOffline() {
    $json = null;
    $user_code = $this->dept_user_code;
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');
    $status = ADD_CASES_UNDER_CAB_ID;

    $memo_list = $this->CabModel->getCabIdListFromMasterOffline($start, $length, $order,$status);
    // log_message('error', '#204: '.json_encode($memo_list));
    // $total_records = $memo_list->num_rows();

    if(!empty($memo_list)) {

      if($memo_list['total_records'] > 0){

        $data_rows = $memo_list['data_results'];

        foreach($data_rows as $row) {

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

          $created_at = date('d-m-Y',strtotime($row->created_at));

          $link = base_url() . "index.php/CabController/getListOfCasesByCabIdOffline?cab_id=".$row->cab_id;
          $view_case = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-edit'></i> &nbsp;Manage Cases</a>";

          $generate_memo = '<button type="button" class="btn btn-sm btn-success" onclick="openModalMemo('."'".$row->cab_id."'".')"><i class="fa fa-file"></i> &nbsp;Generate Memo</button>';

          $link2 = base_url() . "index.php/OfflineSettlement/downloadReportForCabMemo?cab_id=".$row->cab_id;
          $generate_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp;Report</a>";

          $button = $view_case.' '.$generate_memo.' '.$generate_report;

            // if(strtotime(HOLD_All_MB2_CASES_DATE) > strtotime(date('Y-m-d H:i:s')))
            // {
              $button = $view_case.' '.$generate_memo.' '.$generate_report;
            // }else
            // {
            //   $button = $view_case;
            // }


          
          $json[] = array(
            // $sql->cab_memo_name,
            '<span class="text-danger"> '. $sql->cab_memo_name .'</span>',
            '<span class="text-primary"> '. $row->cab_id .'</span>',
            '<small class="text-primary"> '. $sql->dist_name .'</small>',
            // $sql->dist_name,
            $created_at,
            $button,
          );
        }
      }
      else {
        $json = "";
      }      

      $total_records = $memo_list['total_records'];
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

  public function getListOfCasesByCabId()
  {
    $json = null;
    $user_code = $this->dept_user_code;
    $cab_id = $this->input->get('cab_id');

    $this->db = $this->load->database('db2', TRUE);

    $memo_name = $this->basundharamodel->getMemoNameByCabId($this->db,$cab_id);

    $meeting_id = $this->db->query("SELECT DISTINCT dist_code, meeting_id FROM cab_memo_list WHERE cab_id=? AND user_code=? group by dist_code, meeting_id", 
              array($cab_id, $user_code))->result();

    $data['cab_id'] = $cab_id;
    $data['memo_name'] = $memo_name;
    $data['meetingList'] = $meeting_id;
    // $data['cases'] = $query;
    $data['_view'] = 'cab/viewCaseDetailsByCabId';
    $this->load->view('layouts/main', $data);
  }

  public function getListOfCasesByCabIdOffline()
  {
    $json = null;
    $user_code = $this->dept_user_code;
    $cab_id = $this->input->get('cab_id');

    $this->db = $this->load->database('db2', TRUE);

    $memo_name = $this->basundharamodel->getMemoNameByCabId($this->db,$cab_id);

    $meeting_id = $this->db->query("SELECT DISTINCT dist_code, meeting_id FROM cab_memo_list WHERE cab_id=? AND user_code=? group by dist_code, meeting_id", 
              array($cab_id, $user_code))->result();

    $data['cab_id'] = $cab_id;
    $data['memo_name'] = $memo_name;
    $data['meetingList'] = $meeting_id;
    // $data['cases'] = $query;
    $data['_view'] = 'cab/viewCaseDetailsByCabIdOffline';
    $this->load->view('layouts/main', $data);
  }

  public function viewGeneratedMemo()
  {
    $cab_id = $this->input->get('cab_id');

    $path = $this->db->query("SELECT upload_memo_path FROM cab_id_list WHERE cab_id=? AND 
              status=?", array($cab_id, 2))->row()->upload_memo_path;
    $mainfile = file_get_contents($path);
    header("Content-type: application/pdf");
    echo $mainfile;
  }

  public function viewGeneratedMemoDoc()
  {
    $cab_id = $this->input->get('cab_id');

    $path = $this->db->query("SELECT upload_memo_doc_path FROM cab_id_list WHERE cab_id=? AND 
              status=?", array($cab_id, 2))->row()->upload_memo_doc_path;
    $mainfile = file_get_contents($path);
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');  
    header("Content-Disposition: attachment; filename=\"{$cab_id}.docx\"");
    echo $mainfile;
  }

  public function getCabIdByUserDistrictFinalApproval() {
    $json = null;
    $user_code = $this->dept_user_code;
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');
    $status = 2;

    $memo_list = $this->CabModel->getCabIdListFromMaster($start, $length, $order,$status);
    // log_message('error', '#204: '.json_encode($memo_list));
    // $total_records = $memo_list->num_rows();



    if(!empty($memo_list)) {

      if($memo_list['total_records'] >  0){

        $data_rows = $memo_list['data_results'];
      

        foreach($data_rows as $row) {


          $notification_generate_status = $row->notification_generated;
          $digital_sign_status = $row->notification_digital_sign_status;

          if($notification_generate_status == 1 && $digital_sign_status == 0)
            {
            $cab_status = "<small class='text-primary'> Notification Generated</small>";
            }
          else if($notification_generate_status == 1 && $digital_sign_status == 1)
            {
            $cab_status = "<strong class='text-success'> Digitally Signed</strong>";
            }
          else if($notification_generate_status == 0 && $digital_sign_status == 0)
            {
            $cab_status = "<small class='text-danger'> Notification Not Generated</small>";
            }

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name,notification_generated FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name,notification_generated", array($row->cab_id))->row();

          $link = base_url() . "index.php/CabController/viewGeneratedMemo?cab_id=".$row->cab_id;
          $view_memo = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-eye'></i> &nbsp;View Memo</a>";

         $linkDoc = base_url() . "index.php/CabController/viewGeneratedMemoDoc?cab_id=".$row->cab_id;
          $view_memo_doc = "<a href=".$linkDoc." class='btn btn-sm btn-secondary' target='_blank'><i class='fa fa-download'></i> &nbsp;Download Memo [DOC]</a>";


          $generate_notification = '<button type="button" class="btn btn-sm btn-success" onclick="openModalNotification('."'".$row->cab_id."'".')"><i class="fa fa-file"></i> &nbsp;Generate Notification</button>';

          
          $link1 = base_url() . "index.php/Basundhara/casesListForFinalApprovalByDept?cab_id=".$row->cab_id;
          $view_case = "<a href=".$link1." class='btn btn-sm btn-success'><i class='fa fa-eye'></i> &nbsp;Process</a>";


          $link2 = base_url() . "index.php/Basundhara/downloadReportForCabMemo?cab_id=".$row->cab_id;
          $download_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp;Generate Report</a>";

          $link3 = base_url() . "index.php/Basundhara/downloadRevertedCaseListReport?cab_id=".$row->cab_id;
          $reverted_report = "<a href=".$link3." class='btn btn-sm btn-danger' ><i class='fa fa-download'></i> &nbsp;Reverted Report</a>";

          $link4 = base_url() . "index.php/CabController/downloadGeneratedNotification?cab_id=".$row->cab_id;
          $download_notification = "<a href=".$link4." class='btn btn-sm btn-success' ><i class='fa fa-download'></i> &nbsp;Download Notification</a>";


          $created_at = date('d-m-Y',strtotime($row->created_at));

          if(strtotime(HOLD_All_MB2_CASES_DATE) > strtotime(date('Y-m-d H:i:s')))
          {
              if($sql->notification_generated == 1)
                {
                $button = $view_case.' '.$download_notification.' '.$view_memo.' '. $view_memo_doc.' '.$download_report.' '.$reverted_report;
                }
                else 
                {
                $button = $generate_notification.' '.$view_memo.' '. $view_memo_doc.' '.$download_report.' '.$reverted_report;
                }
          }else
          {
                $button = $view_memo;
          }


          
          $json[] = array(
            '<strong class="text-danger"> '. $sql->cab_memo_name .'</strong>',
            '<strong class="text-primary"> '. $row->cab_id .'</strong>',
            $cab_status,
            '<small class="text-primary"> '. $sql->dist_name .'</small>',
            $created_at,
            $button,
          );
        }
      }
      else {
        $json = "";
      }      
      
      $total_records = $memo_list['total_records'];

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


  public function getCabIdByUserDistrictFinalApprovalOffline() {
    $json = null;
    $user_code = $this->dept_user_code;
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');
    $status = 2;

    $memo_list = $this->CabModel->getCabIdListFromMasterOffline($start, $length, $order,$status);

    if(!empty($memo_list)) {

      if($memo_list['total_records'] >  0){

        $data_rows = $memo_list['data_results'];
      

        foreach($data_rows as $row) {


          $notification_generate_status = $row->notification_generated;
          $digital_sign_status = $row->notification_digital_sign_status;

          if($notification_generate_status == 1 && $digital_sign_status == 0)
          {
          $cab_status = "<small class='text-primary'> Notification Generated</small>";
          }
          else if($notification_generate_status == 1 && $digital_sign_status == 1)
          {
          $cab_status = "<strong class='text-success'> Digitally Signed</strong>";
          }
          else if($notification_generate_status == 0 && $digital_sign_status == 0)
          {
          $cab_status = "<small class='text-danger'> Notification Not Generated</small>";
          }

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name,notification_generated FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name,notification_generated", array($row->cab_id))->row();

          $link = base_url() . "index.php/CabController/viewGeneratedMemo?cab_id=".$row->cab_id;
          $view_memo = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-eye'></i> &nbsp;View Memo</a>";

         $linkDoc = base_url() . "index.php/CabController/viewGeneratedMemoDoc?cab_id=".$row->cab_id;
          $view_memo_doc = "<a href=".$linkDoc." class='btn btn-sm btn-secondary' target='_blank'><i class='fa fa-download'></i> &nbsp;Download Memo [DOC]</a>";


          $generate_notification = '<button type="button" class="btn btn-sm btn-success" onclick="openModalNotification('."'".$row->cab_id."'".')"><i class="fa fa-file"></i> &nbsp;Generate Notification</button>';

          
          $link1 = base_url() . "index.php/OfflineSettlement/casesListForFinalApprovalByDeptOffline?cab_id=".$row->cab_id;
          $view_case = "<a href=".$link1." class='btn btn-sm btn-success'><i class='fa fa-eye'></i> &nbsp;Process</a>";


          $link2 = base_url() . "index.php/OfflineSettlement/downloadReportForCabMemo?cab_id=".$row->cab_id;
          $download_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp;Generate Report</a>";

          $link3 = base_url() . "index.php/OfflineSettlement/downloadRevertedCaseListReport?cab_id=".$row->cab_id;
          $reverted_report = "<a href=".$link3." class='btn btn-sm btn-danger' ><i class='fa fa-download'></i> &nbsp;Reverted Report</a>";

          $link4 = base_url() . "index.php/CabController/downloadGeneratedNotification?cab_id=".$row->cab_id;
          $download_notification = "<a href=".$link4." class='btn btn-sm btn-success' ><i class='fa fa-download'></i> &nbsp;Download Notification</a>";


          $created_at = date('d-m-Y',strtotime($row->created_at));

          // if(strtotime(HOLD_All_MB2_CASES_DATE) > strtotime(date('Y-m-d H:i:s')))
          // {
          if($sql->notification_generated == 1)
          {
            $button = $view_case.' '.$download_notification.' '.$view_memo.' '. $view_memo_doc.' '.$download_report.' '.$reverted_report;
          }
          else 
          {
            $button = $generate_notification.' '.$view_memo.' '. $view_memo_doc.' '.$download_report.' '.$reverted_report;
          }
          // }else
          // {
          //       $button = $view_memo;
          // }


          
          $json[] = array(
            '<strong class="text-danger"> '. $sql->cab_memo_name .'</strong>',
            '<strong class="text-primary"> '. $row->cab_id .'</strong>',
            $cab_status,
            '<small class="text-primary"> '. $sql->dist_name .'</small>',
            $created_at,
            $button,
          );
        }
      }
      else {
        $json = "";
      }      
      
      $total_records = $memo_list['total_records'];

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

  public function GenerateCabMemo()
  {
    $data = array();
    $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id_memo');

    $distMeeting = $this->db->query("select  dist_code,meeting_id from cab_memo_list WHERE cab_id=? AND status=? group by dist_code, meeting_id", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->result();

      $data['emb'] = base_url().'assets/emblem-dark.png';

      $data['cab_memo_date'] = $this->input->post('cab_memo_date');
      $data['rev_cab_ref_no'] = $this->input->post('rev_cab_ref_no');
      $data['idc'] = $this->input->post('idc');
      $data['total_prop'] = 0;
      $res = $this->db->query("select count(*) as total from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->row();
      $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->row();

      $dist_name = $this->db->query("select distinct dist_code  from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->result();

      $distNames = array_map(function ($item) {
                    return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                }, $dist_name);

      $commaSeparatedDistName = implode(",", $distNames);

      if (!empty($res) && $res != null && $res != "") {
        $data['total_prop'] = $res->total;
        $data['dist_count'] = $dist_count->total_dist;
        $data['dist_name'] = $commaSeparatedDistName;
        $data['total_individual_text'] = $this->utilclass->numberToWords($res->total);
      }

    $errCheck = 0;

    foreach($distMeeting as $dist)
    {

        $memoCase = $this->basundharamodel->getCasesCountFromCabMemo($dist->dist_code,$dist->meeting_id);

        $memoCaseCount = $memoCase->num_rows();

        
        $this->db2 =  $this->dbswitch2($dist->dist_code);


        $meetingCase = $this->basundharamodel->getCasesCountByDistMeeting($this->db2,$dist->meeting_id);

        $pullRequestCase = $this->basundharamodel->getCasesHavingPullRequest($this->db2,$dist->meeting_id);

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

            $casesWithPullRequest = '<strong class="text-success">'.$allPullRequestCases. '</strong>';  

            $meetingName = '<strong class="text-danger bg-yellow">'.$this->utilclass->getMeetingNameByMeetingId($dist->dist_code, $dist->meeting_id) . '</strong>';

            $this->session->set_flashdata('message', 'Can not Generate Memo for : ' . $cab_id_memo .' as Cases Having Modification Request Under meeting ' . $meetingName . '<br># List of  Cases With Pull Requset Under Meeting : <br>' . $casesWithPullRequest . '<br>(Revert These Cases To DC before Generate Memo)');
            $this->load->view('errorMessage');

        }else{

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

            $casesPending = '<span class="text-primary">'.$allPendingCases. '</span>';  
            $meetingName = '<strong class="text-danger bg-yellow">'.$this->utilclass->getMeetingNameByMeetingId($dist->dist_code, $dist->meeting_id) . '</strong>';
          
            $this->session->set_flashdata('message', 'Can not Generate Memo for : ' . $cab_id_memo .' as Cases Pending for meeting ' . $meetingName . '<br># List of Pending Cases Under Meeting : <br>' . $casesPending);
            $this->load->view('errorMessage');  

        }

        }


    }

      if($errCheck == 0)
      {
              $this->load->view('cabinet', $data);  

      }

  }

  public function GenerateCabMemoOffline()
  {
    $data = array();
    $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id_memo');
    $distMeeting = $this->db->query("select  dist_code,meeting_id from cab_memo_list WHERE cab_id=? AND status=? group by dist_code, meeting_id", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->result();

    $data['emb'] = base_url().'assets/emblem-dark.png';
    $data['cab_memo_date'] = $this->input->post('cab_memo_date');
    $data['rev_cab_ref_no'] = $this->input->post('rev_cab_ref_no');
    $data['idc'] = $this->input->post('idc');
    $data['total_prop'] = 0;
    $res = $this->db->query("select count(*) as total from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->row();
    $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->row();

    $dist_name = $this->db->query("select distinct dist_code  from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->result();

    $distNames = array_map(function ($item) {
                  return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
              }, $dist_name);

    $commaSeparatedDistName = implode(",", $distNames);

    if (!empty($res) && $res != null && $res != "") {
      $data['total_prop'] = $res->total;
      $data['dist_count'] = $dist_count->total_dist;
      $data['dist_name'] = $commaSeparatedDistName;
      $data['total_individual_text'] = $this->utilclass->numberToWords($res->total);
    }
    $errCheck = 0;
    foreach($distMeeting as $dist)
    {

        $memoCase = $this->OfflineSettlementModel->getCasesCountFromCabMemo($dist->dist_code,$dist->meeting_id);
        $memoCaseCount = $memoCase->num_rows();

        
        $this->db2 =  $this->dbswitch2($dist->dist_code);


        $meetingCase = $this->OfflineSettlementModel->getCasesCountByDistMeeting($this->db2,$dist->meeting_id);

        // $pullRequestCase = $this->OfflineSettlementModel->getCasesHavingPullRequest($this->db2,$dist->meeting_id);

        $meetingCaseCount = $meetingCase->num_rows();

        // $pullRequestCaseCount = $pullRequestCase->num_rows();




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

          $casesPending = '<span class="text-primary">'.$allPendingCases. '</span>';  
          $meetingName = '<strong class="text-danger bg-yellow">'.$this->utilclass->getMeetingNameByMeetingId($dist->dist_code, $dist->meeting_id) . '</strong>';
        
          $this->session->set_flashdata('message', 'Can not Generate Memo for : ' . $cab_id_memo .' as Cases Pending for meeting ' . $meetingName . '<br># List of Pending Cases Under Meeting : <br>' . $casesPending);
          $this->load->view('errorMessage');  

        }

    }

    if($errCheck == 0)
    {
        $this->load->view('cabinet', $data);  

    }

  }
  // MB : Cabinet Memo Generation and Show PDF data==========22082023
  public function SavePDFMemo()
  {
    // $_POST = json_decode(file_get_contents("php://input"), true);
    $html1       = $this->input->post('html1');
    $html2       = $this->input->post('html2');
    $html3       = $this->input->post('html3');
    $html4       = $this->input->post('html4');
    $cab_id_memo  = $this->input->post('meeting_id');
    $memoName = "CAB";
    $meetingId = str_replace("/", "_", $cab_id_memo);
    $html = "";
    // $emb = base_url().'application/views/images/emblem-dark.png';
    // $dist_name   = $this->UtilsModel->getEngDistrictNameByDistCode($dist_code);
    // $distEngName = substr($dist_name->locname_eng, 0, 3);

    //generation of canbinetmemo file name============
    $html .= '<style>
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
                      </style>';


    $fileName    = $memoName . '_DEPT_' . date("Y") . '_' . $meetingId;

    include 'vendor/mpdf/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $waterMark = 'Cabinet Memo' . $meetingId;
    $mpdf->SetWatermarkText($waterMark);
    $mpdf->showWatermarkText = true;
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont = true;
    $mpdf->writeHTML($html . $html1 . $html2 . $html3 . $html4);

    $mpdf->Output(CABMEMO_UPLOAD_DIR . $fileName . '.pdf', 'F');
    $b64Doc = chunk_split(base64_encode(file_get_contents(CABMEMO_UPLOAD_DIR . $fileName . '.pdf')));
    $upload_path = CABMEMO_UPLOAD_DIR . $fileName . '.pdf';




    $html11       =  $this->input->post('html11');
    // $html2       = $this->input->post('html21');
    $html31       = $this->input->post('html31');
    // $html4       = $this->input->post('html41');

    require_once 'htmltoword/vendor/autoload.php';
    // Creating the new document...
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $phpWord->setDefaultFontName('Cambria');
    // $phpWord->setDefaultParagraphStyle(
    //   array(
    //   //'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT,
    //   'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0),
    //   'spacing' => 90,
    //   'lineHeight' => 2.5,
    //   'line-spacing' =>2.5
    //   )
    // );
    // use PhpOffice\PhpWord\Shared\Html;
        $section = $phpWord->addSection();
    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html11 ,false, false);
        $section = $phpWord->addSection();
    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html31 ,false, false);
    //     $section = $phpWord->addSection();
    // \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html3 ,false, false);
    //     $section = $phpWord->addSection();
    // \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html4 ,false, false);



    // $section = $phpWord->addSection();

    // $report = view('reports.audit-report', $data)->render();

    // $doc = new DOMDocument();
    // $doc->loadHTML($html1);
    // $doc->saveHTML();
    // \PhpOffice\PhpWord\Shared\Html::addHtml($section, $doc->saveHtml(),true);



    // $section = \PhpOffice\PhpWord\Shared\Html::addHtml($section, $ht);
    \PhpOffice\PhpWord\Settings::setCompatibility(false);
    PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    ob_clean();
    $objWriter->save(CABMEMO_UPLOAD_DOCS_DIR .$fileName.'.docx');
    $upload_path_doc = CABMEMO_UPLOAD_DOCS_DIR . $fileName . '.docx';


    $curr_date = date('Y-m-d h:i:s');
    $user_code = $this->dept_user_code;


    //Modification Request check

    $distMeeting = $this->db->query("select  dist_code,meeting_id from cab_memo_list WHERE cab_id=? AND status=? group by dist_code, meeting_id", array($cab_id_memo, 0))->result();

    $errCheck = 0;

      foreach($distMeeting as $dist)
      {

        $this->db2 =  $this->dbswitch2($dist->dist_code);

        $pullRequestCase = $this->basundharamodel->getCasesHavingPullRequest($this->db2,$dist->meeting_id);

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
                'message' => "Can not Generate Memo for :   $cab_id_memo  as Cases Having Modification Request Under meeting  $meetingName  : ( $allPullRequestCases ) (Revert These Cases To DC before Generating Cab Memo)"
              ));

        }
        

      }

    //Modification Request check end

      if($errCheck == 0)
        {
              $this->db->trans_begin();
              $query2 = $this->db->query(
                "UPDATE cab_id_list SET upload_memo_path = ?,upload_memo_doc_path = ?, status=?, updated_at=?, finalized_at=?
                                        WHERE user_code=? AND status=? AND cab_id=?",
                array($upload_path,$upload_path_doc, CAB_MEMO_DOC_GENERATED, $curr_date,$curr_date, $user_code, ADD_CASES_UNDER_CAB_ID, $cab_id_memo)
              );

              if ($this->db->affected_rows() <= 0) {
                $this->db->trans_rollback();
                log_message("error", "#ERROR1234 : Memo Generation Failed...Table cab_id_list" . $this->db->last_query());
                echo json_encode(array(
                  'responseType' => 3,
                  'message' => "#ERROR1234 : Memo Generation Failed..."
                ));
                return;
              }

              $query = $this->db->query(
                "UPDATE cab_memo_list SET status=?, final_status = ?, updated_at=? 
                                        WHERE user_code=? AND status=? AND cab_id=?",
                array(CAB_MEMO_DOC_GENERATED, PREPARE_FOR_FINAL_APPROVAL, $curr_date, $user_code, ADD_CASES_TO_CAB_MEMO, $cab_id_memo)
              );

              if ($this->db->affected_rows() <= 0) {
                $this->db->trans_rollback();
                log_message("error", "#ERROR123 : Memo Generation Failed...Table cab_id_list" . $this->db->last_query());
                echo json_encode(array(
                  'responseType' => 3,
                  'message' => "#ERROR123 : Memo Generation Failed..."
                ));
                return;
              }
              $this->db->trans_commit();
              echo json_encode(array(
                'responseType' => 2,
                'meetingId'    => $meetingId,
                'message' => "Successfully generated cabinet memo for the Cab Memo No :" . $meetingId
              ));

        }

  }

  public function SavePDFMemoOffline()
  {
    // $_POST = json_decode(file_get_contents("php://input"), true);
    $html1       = $this->input->post('html1');
    $html2       = $this->input->post('html2');
    $html3       = $this->input->post('html3');
    $html4       = $this->input->post('html4');
    $cab_id_memo  = $this->input->post('meeting_id');
    $memoName = "CAB";
    $meetingId = str_replace("/", "_", $cab_id_memo);
    $html = "";
    // $emb = base_url().'application/views/images/emblem-dark.png';
    // $dist_name   = $this->UtilsModel->getEngDistrictNameByDistCode($dist_code);
    // $distEngName = substr($dist_name->locname_eng, 0, 3);

    //generation of canbinetmemo file name============
    $html .= '<style>
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
                      </style>';


    $fileName    = $memoName . '_DEPT_' . date("Y") . '_' . $meetingId;

    include 'vendor/mpdf/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $waterMark = 'Cabinet Memo' . $meetingId;
    $mpdf->SetWatermarkText($waterMark);
    $mpdf->showWatermarkText = true;
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont = true;
    $mpdf->writeHTML($html . $html1 . $html2 . $html3 . $html4);

    $mpdf->Output(CABMEMO_UPLOAD_DIR . $fileName . '.pdf', 'F');
    $b64Doc = chunk_split(base64_encode(file_get_contents(CABMEMO_UPLOAD_DIR . $fileName . '.pdf')));
    $upload_path = CABMEMO_UPLOAD_DIR . $fileName . '.pdf';




    $html11       =  $this->input->post('html11');
    // $html2       = $this->input->post('html21');
    $html31       = $this->input->post('html31');
    // $html4       = $this->input->post('html41');

    require_once 'htmltoword/vendor/autoload.php';
    // Creating the new document...
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $phpWord->setDefaultFontName('Cambria');
    // $phpWord->setDefaultParagraphStyle(
    //   array(
    //   //'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT,
    //   'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0),
    //   'spacing' => 90,
    //   'lineHeight' => 2.5,
    //   'line-spacing' =>2.5
    //   )
    // );
    // use PhpOffice\PhpWord\Shared\Html;
        $section = $phpWord->addSection();
    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html11 ,false, false);
        $section = $phpWord->addSection();
    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html31 ,false, false);
    //     $section = $phpWord->addSection();
    // \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html3 ,false, false);
    //     $section = $phpWord->addSection();
    // \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html4 ,false, false);



    // $section = $phpWord->addSection();

    // $report = view('reports.audit-report', $data)->render();

    // $doc = new DOMDocument();
    // $doc->loadHTML($html1);
    // $doc->saveHTML();
    // \PhpOffice\PhpWord\Shared\Html::addHtml($section, $doc->saveHtml(),true);



    // $section = \PhpOffice\PhpWord\Shared\Html::addHtml($section, $ht);
    \PhpOffice\PhpWord\Settings::setCompatibility(false);
    PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    ob_clean();
    $objWriter->save(CABMEMO_UPLOAD_DOCS_DIR .$fileName.'.docx');
    $upload_path_doc = CABMEMO_UPLOAD_DOCS_DIR . $fileName . '.docx';


    $curr_date = date('Y-m-d h:i:s');
    $user_code = $this->dept_user_code;


    //Modification Request check

    $distMeeting = $this->db->query("select  dist_code,meeting_id from cab_memo_list WHERE cab_id=? AND status=? group by dist_code, meeting_id", array($cab_id_memo, 0))->result();

    $errCheck = 0;

  
    $this->db->trans_begin();
    $query2 = $this->db->query(
      "UPDATE cab_id_list SET upload_memo_path = ?,upload_memo_doc_path = ?, status=?, updated_at=?, finalized_at=?
                              WHERE user_code=? AND status=? AND cab_id=?",
      array($upload_path,$upload_path_doc, CAB_MEMO_DOC_GENERATED, $curr_date,$curr_date, $user_code, ADD_CASES_UNDER_CAB_ID, $cab_id_memo)
    );

    if ($this->db->affected_rows() <= 0) {
      $this->db->trans_rollback();
      log_message("error", "#OFFLINEERROR1234 : Memo Generation Failed...Table cab_id_list" . $this->db->last_query());
      echo json_encode(array(
        'responseType' => 3,
        'message' => "#OFFLINEERROR1234 : Memo Generation Failed..."
      ));
      return;
    }

    $query = $this->db->query(
      "UPDATE cab_memo_list SET status=?, final_status = ?, updated_at=? 
                              WHERE user_code=? AND status=? AND cab_id=?",
      array(CAB_MEMO_DOC_GENERATED, PREPARE_FOR_FINAL_APPROVAL, $curr_date, $user_code, ADD_CASES_TO_CAB_MEMO, $cab_id_memo)
    );

    if ($this->db->affected_rows() <= 0) {
      $this->db->trans_rollback();
      log_message("error", "#OFFLINEERROR123 : Memo Generation Failed...Table cab_id_list" . $this->db->last_query());
      echo json_encode(array(
        'responseType' => 3,
        'message' => "#OFFLINEERROR123 : Memo Generation Failed..."
      ));
      return;
    }
    $this->db->trans_commit();
    echo json_encode(array(
      'responseType' => 2,
      'meetingId'    => $meetingId,
      'message' => "Successfully generated cabinet memo for the Cab Memo No :" . $meetingId
    ));

  }

  public function getAllCasesUnderCabId() {

    $json = null;
    $user_code = $this->dept_user_code;
    $cab_id = $this->input->post('CabId');
    $dist_code = $this->input->post('selectDistrict');
    $service_code = $this->input->post('selectService');
    $meeting_no = $this->input->post('selectMeeting');
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');

    $this->db = $this->load->database('db2', TRUE);


    $cases_list = $this->basundharamodel->getAllCasesbyCabId($this->db,$start, $length, $order,$cab_id,$user_code,$meeting_no,$dist_code,$service_code);

    // $total_records = $cases_list->num_rows();

    if(!empty($cases_list)) {

      if($cases_list['total_records'] > 0){

        $data_rows = $cases_list['data_results'];

        foreach($data_rows as $row) {

            $case_no = "<small class='case-no-bg'><i class='fa fa-archive'></i>" . $row->case_no . "</small>";

            $application_no = $this->utilclass->getApplidFromCaseNo($row->dist_code, $row->case_no);

            $app_no = "<br><small class='text-danger text-center p-4'>" . $application_no  ."</small>" ;

            // $proposal_name = "<small class='text-black bg-success'>" . $row->proposal_name ."</small>";

            $service = "<small class='text-black bg-yellow'>" . $this->utilclass->getServiceNameFromCaseNo($row->dist_code, $row->case_no) ."</small>";

            $district = "<small class='text-black'>" . $this->utilclass->getDistrictNameOnLanding($row->dist_code) ."</small>";

            $meeting_name = "<small class='text-danger text-center p-4'> " . $this->utilclass->getMeetingNameByMeetingId($row->dist_code, $row->meeting_id)  ."</small>";

            $minutelink = base_url() . "index.php/Basundhara/viewMinute/". $row->dist_code . "/" . $row->meeting_id ;

            $view_minute = "<br><a target='download' href=".$minutelink." ><i class='fa fa-paperclip'></i> &nbsp;View Minute</a>";

            $created_at = date('d-M-Y',strtotime($row->created_at));

            // $status = $row->status;


          $link = base_url() . "index.php/Basundhara/settlementBasu/?app=".$application_no . "&dist_code=" .$row->dist_code;
          $view_case = "<a href=".$link." class='btn btn-sm btn-primary' target='_blank'><i class='fa fa-eye'></i> &nbsp;View Details</a>";

          $button = $view_case;
          
          $json[] = array(
            $row->case_no . '@' . $row->dist_code . '@' . $row->meeting_id,
            $case_no . $app_no,
            $service,
            $meeting_name . $view_minute,
            '<small>' . $created_at . '</small>',
            $district,
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

  public function getAllCasesUnderCabIdOffline() {

    $json = null;
    $user_code = $this->dept_user_code;
    $cab_id = $this->input->post('CabId');
    $dist_code = $this->input->post('selectDistrict');
    $service_code = $this->input->post('selectService');
    $meeting_no = $this->input->post('selectMeeting');
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');

    $this->db = $this->load->database('db2', TRUE);


    $cases_list = $this->basundharamodel->getAllCasesbyCabId($this->db,$start, $length, $order,$cab_id,$user_code,$meeting_no,$dist_code,$service_code);

    // $total_records = $cases_list->num_rows();

    if(!empty($cases_list)) {

      if($cases_list['total_records'] > 0){

        $data_rows = $cases_list['data_results'];

        foreach($data_rows as $row) {

            $case_no = "<small class='case-no-bg'><i class='fa fa-archive'></i>" . $row->case_no . "</small>";

            $application_no = $this->utilclass->getApplidFromCaseNo($row->dist_code, $row->case_no);

            $app_no = "<br><small class='text-danger text-center p-4'>" . $application_no  ."</small>" ;

            // $proposal_name = "<small class='text-black bg-success'>" . $row->proposal_name ."</small>";

            $service = "<small class='text-black bg-yellow'>" . $this->utilclass->getServiceNameFromCaseNo($row->dist_code, $row->case_no) ."</small>";

            $district = "<small class='text-black'>" . $this->utilclass->getDistrictNameOnLanding($row->dist_code) ."</small>";

            $meeting_name = "<small class='text-danger text-center p-4'> " . $this->utilclass->getMeetingNameByMeetingIdOffline($row->dist_code, $row->meeting_id)  ."</small>";

            $minutelink = base_url() . "index.php/OfflineSettlement/viewMinute/". $row->dist_code . "/" . $row->meeting_id ;

            $view_minute = "<br><a target='download' href=".$minutelink." ><i class='fa fa-paperclip'></i> &nbsp;View Minute</a>";

            $created_at = date('d-M-Y',strtotime($row->created_at));

            // $status = $row->status;


          $link = base_url() . "index.php/OfflineSettlement/settlementBasu/?app=".$application_no . "&dist_code=" .$row->dist_code;
          $view_case = "<a href=".$link." class='btn btn-sm btn-primary' target='_blank'><i class='fa fa-eye'></i> &nbsp;View Details</a>";

          $button = $view_case;
          
          $json[] = array(
            $row->case_no . '@' . $row->dist_code . '@' . $row->meeting_id,
            $case_no . $app_no,
            $service,
            $meeting_name . $view_minute,
            '<small>' . $created_at . '</small>',
            $district,
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

  public function removeCasesFromCabMemo()
  {
      $_POST = json_decode(file_get_contents("php://input"), true);

      $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');

      if ($this->form_validation->run() == FALSE) {
          echo json_encode(array(
              'responseType' => 3,
              'message' => 'Validation Errors !. Check Form Data',
          ));
      } else {

          $allSelectedList = $this->input->post('selectedList');
          $cabmemo_id = $this->input->post('cabId');

          $user_code = $this->session->userdata('user_code');

          $this->db = $this->load->database('db2', TRUE);

            $memo_name = $this->basundharamodel->getMemoNameByCabId($this->db,$cabmemo_id);


              if (!empty($allSelectedList)) {

                  foreach ($allSelectedList as $row) {
                      $this->db->trans_begin();

                      $parts = explode("@", $row);

                        list($case_no, $dist_code, $meeting_id) = $parts;

                          $cabMemoData = array(
                              'cab_id' => $cabmemo_id,
                              'user_code' => $user_code,
                              'dist_code' => $dist_code,
                              'case_no' => $case_no,
                              'meeting_id' => $meeting_id,
                          );
                            
                          $deleteCases = $this->basundharamodel->deleteCasesFromCabMemo($cabMemoData);
                          if ($deleteCases <= 0) {
                              $this->db->trans_rollback();
                              log_message('error', '#ERRDUPDATE0001: Updation failed in cab_memo_list for bulk Remove');
                              log_message('error', $this->db->last_query());

                              echo json_encode(array(
                                  'responseType' => 1,
                                  'message' => 'Failed to Remove Cases from Cabinet Memo',

                              ));
                              return false;
                          } else {
                              $this->db->trans_commit();

                              //change sttatus in basic
                              $this->db2 =  $this->dbswitch2($dist_code);

                              $this->db2->trans_begin();

                              $updateData = array(
                                  'cab_memo_prepared' => 0,
                              );

                              $updateBasicStatus = $this->basundharamodel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData);


                              if($updateBasicStatus <= 0){
                              $this->db2->trans_rollback();
                              log_message('error', '#ERRDUPDATBASICCAB: Updation failed in settlement_basic for change cab memo status');
                              log_message('error', $this->db2->last_query());

                              echo json_encode(array(
                                  'responseType' => 1,
                                  'message' => 'Failed to Remove Cases from Cabinet Memo',

                              ));
                              return false;

                              }else{

                              $this->db2->trans_commit();

                              }

                              //change sttatus in basic
                          }
                  }
                  echo json_encode(array(
                      'responseType' => 2,
                      'message' => 'Cases Successfully Remove from Cabinet Memo',
                      'message' => 'Cases Successfully Remove from Cabinet Memo ' .$memo_name .'('. $cabmemo_id . ')',


                  ));
              }
      }
  }

  public function getNewlyGeneratedCabList() 
  {    
    $json          = null;
    $user_code     = $this->dept_user_code;
    $draw          = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start         = intval($this->input->post('start'));
    $length        = intval($this->input->post('length'));
    $order         = $this->input->post('order');
    $status        = $this->input->post('status');

    // $list_of_generated_cab_memo = $this->CabModel->getCabIdListFromMaster($status);
    // log_message('error', '#950: '.json_encode($list_of_generated_cab_memo));
    // $total_records = $list_of_generated_cab_memo->num_rows();

    $list_of_generated_cab_memo = $this->CabModel->getCabIdListFromMaster($start, $length, $order,$status);

    if(!empty($list_of_generated_cab_memo)) {

      if($list_of_generated_cab_memo['total_records'] > 0)
      {
        $data_rows = $list_of_generated_cab_memo['data_results'];

        foreach($data_rows as $row) {

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

          $created_at = date('d/m/Y',strtotime($row->created_at));

          $button = '<button type="button" class="btn btn-sm btn-danger" onclick="viewCaseDetail('."'".$row->cab_id."'".')"><i class="fa fa-eye"></i> &nbsp;View to Modify</button>';
          
          $json[] = array(
            '<strong class="text-primary">' .$row->cab_id .'</strong>',
            $sql->cab_memo_name,
            '<small class="text-success">' . $row->remarks .'</small>',
            '<small class="text-danger">' . $sql->dist_name .'</small>',
            $created_at,
            $button,
          );
        }
      }
      else {
        $json = "";
      }
      $total_records = $list_of_generated_cab_memo['total_records'];
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


  public function getNewlyGeneratedCabListOffline() 
  {    
    $json          = null;
    $user_code     = $this->dept_user_code;
    $draw          = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start         = intval($this->input->post('start'));
    $length        = intval($this->input->post('length'));
    $order         = $this->input->post('order');
    $status        = $this->input->post('status');

    // $list_of_generated_cab_memo = $this->CabModel->getCabIdListFromMaster($status);
    // log_message('error', '#950: '.json_encode($list_of_generated_cab_memo));
    // $total_records = $list_of_generated_cab_memo->num_rows();

    $list_of_generated_cab_memo = $this->CabModel->getCabIdListFromMasterOffline($start, $length, $order,$status);

    if(!empty($list_of_generated_cab_memo)) {

      if($list_of_generated_cab_memo['total_records'] > 0)
      {
        $data_rows = $list_of_generated_cab_memo['data_results'];

        foreach($data_rows as $row) {

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

          $created_at = date('d/m/Y',strtotime($row->created_at));

          $button = '<button type="button" class="btn btn-sm btn-danger" onclick="viewCaseDetail('."'".$row->cab_id."'".')"><i class="fa fa-eye"></i> &nbsp;View to Modify</button>';
          
          $json[] = array(
            '<strong class="text-primary">' .$row->cab_id .'</strong>',
            $sql->cab_memo_name,
            '<small class="text-success">' . $row->remarks .'</small>',
            '<small class="text-danger">' . $sql->dist_name .'</small>',
            $created_at,
            $button,
          );
        }
      }
      else {
        $json = "";
      }
      $total_records = $list_of_generated_cab_memo['total_records'];
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




  public function deptApprovedCabIdList() {
    if ($this->session->userdata('designation') == DEPARTMENT_USERCODE || $this->session->userdata('designation') == DPT_JS) {     
      $data['_view'] = 'cab/deptApprovedCabIdList';
      $this->load->view('layouts/main', $data);
    } else {
      echo "User Not Authorized to View this Page";
    }
  }


  public function deptApprovedCabIdListOffline() {
    if ($this->session->userdata('designation') == DEPARTMENT_USERCODE || $this->session->userdata('designation') == DPT_JS) {     
      $data['_view'] = 'cab/deptApprovedCabIdListOffline';
      $this->load->view('layouts/main', $data);
    } else {
      echo "User Not Authorized to View this Page";
    }
  }





  public function getFinalApprovedCabIdList() {
    $json = null;
    $user_code = $this->dept_user_code;
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');
    $status = FINAL_SUBMISSION_CAB_MEMO;

    $memo_list = $this->CabModel->getCabIdListFromMaster($start, $length, $order,$status);
    // log_message('error', '#204: '.json_encode($memo_list));
    // $total_records = $memo_list->num_rows();


    if(!empty($memo_list)) {

      if($memo_list['total_records'] >  0){

        $data_rows = $memo_list['data_results'];

        foreach($data_rows as $row) {

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

          $link = base_url() . "index.php/CabController/viewGeneratedMemo?cab_id=".$row->cab_id;
          $view_memo = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-eye'></i> &nbsp;View Memo</a>";

          
          $link3 = base_url() . "index.php/CabController/getListOfFinalApprovedCasesByCabId?cab_id=".$row->cab_id;
          $view_case = "<a href=".$link3." class='btn btn-sm btn-success'><i class='fa fa-eye'></i> &nbsp; Case List</a>";


          $link2 = base_url() . "index.php/Basundhara/downloadReportForCabMemo?cab_id=".$row->cab_id;
          $download_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp; Case Report</a>";


          $link4 = base_url() . "index.php/CabController/viewGeneratedNotification?cab_id=".$row->cab_id;
          $download_notification = "<a href=".$link4." class='btn btn-sm btn-danger' ><i class='fa fa-download'></i> &nbsp;Download Digitally Signed Notification</a>";

          $approved_at = date('d-m-Y',strtotime($row->approved_at));
          $notification_digital_signed_date = date('d-m-Y',strtotime($row->notification_digital_signed_date));

          $button = $view_case.' '.$download_report.' '.$download_notification;
          
          $json[] = array(
            '<strong class="text-danger"> '. $sql->cab_memo_name .'</strong>',
            '<strong class="text-primary"> '. $row->cab_id .'</strong>',
            '<small class="text-primary"> '. $sql->dist_name .'</small>',
            '<small class="text-primary"> '. $row->cab_id .'</small>',
          $notification_digital_signed_date,
          $approved_at,
            
            $button,
          );
        }
      }
      else {
        $json = "";
      }      
      
      $total_records = $memo_list['total_records'];

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



  public function getListOfFinalApprovedCasesByCabId()
  {
    $json = null;
    $user_code = $this->dept_user_code;
    $cab_id = $this->input->get('cab_id');

    $this->db = $this->load->database('db2', TRUE);

    $memo_name = $this->basundharamodel->getMemoNameByCabId($this->db,$cab_id);

    $meeting_id = $this->db->query("SELECT dist_code, meeting_id FROM cab_memo_list WHERE cab_id=? AND user_code=? group by dist_code, meeting_id", 
              array($cab_id, $user_code))->result();

    $data['cab_id'] = $cab_id;
    $data['memo_name'] = $memo_name;
    $data['meetingList'] = $meeting_id;
    $data['_view'] = 'cab/finalApprovedCaseListByCabId';
    $this->load->view('layouts/main', $data);
  }



/////////VGR/ PGR///////////

  public function createVGRCabId() {

    $_POST = json_decode(file_get_contents("php://input"), true);
    $user_assigned_districts = $data['user_assigned_dist'] = array(
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
    if ($this->designation == DEPARTMENT_USERCODE && $this->input->post('option') == null ){
      // $data['user_assigned_dist'] = $this->CabModel->getDeptUserDistListVGR()->result();



      $data['_view'] = 'cab/createVGRCabId';
      $this->load->view('layouts/main', $data);
    }
    else if ($this->designation == DEPARTMENT_USERCODE && $this->input->post('option') == 'edit') {      
      
      $cab_id = $this->input->post('cab_id');

      $sql = $this->db->query("SELECT cab_id, cab_memo_name, reference_no, remarks 
                FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name, reference_no, remarks", 
                  array($cab_id))->row();
      $getSelectedDist = $this->db->query("SELECT dist_code FROM cab_id_list WHERE cab_id=?",
                            array($cab_id))->result();
      // $user_assigned_districts = $this->CabModel->getDeptUserDistListVGR()->result();
      echo json_encode(array(
        'responseType'  => 2,
        'cab_id'        => $sql->cab_id,
        'memo_name'     => $sql->cab_memo_name,
        'reference_no'  => $sql->reference_no,
        'remarks'       => $sql->remarks,
        'selected_dist' => $getSelectedDist,
        'all_dist'      => $user_assigned_districts,
      ));
      return;
    }
  }

  public function getGeneratedCabListVGR() 
  {    
    $json          = null;
    $user_code     = $this->dept_user_code;
    $draw          = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start         = intval($this->input->post('start'));
    $length        = intval($this->input->post('length'));
    $order         = $this->input->post('order');
    $status        = $this->input->post('status');


    $list_of_generated_cab_memo = $this->CabModel->getCabIdListFromMasterVGR($start, $length, $order,$status);

    if(!empty($list_of_generated_cab_memo)) {

      if($list_of_generated_cab_memo['total_records'] > 0)
      {
        $data_rows = $list_of_generated_cab_memo['data_results'];

        foreach($data_rows as $row) {

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

          $created_at = date('d/m/Y',strtotime($row->created_at));

          $button = '<button type="button" class="btn btn-sm btn-danger" onclick="viewCaseDetail('."'".$row->cab_id."'".')"><i class="fa fa-eye"></i> &nbsp;View to Modify</button>';

          $delete_button = '<button type="button" class="btn btn-sm btn-danger" onclick="deleteCabMemoVGR('."'".$row->cab_id."'".')"><i class="fa fa-trash"></i> &nbsp;Delete</button>';
          
          $json[] = array(
            '<strong class="text-primary">' .$row->cab_id .'</strong>',
            $sql->cab_memo_name,
            '<small class="text-success">' . $row->remarks .'</small>',
            '<small class="text-danger">' . $sql->dist_name .'</small>',
            $created_at,
            $button . ' &nbsp ' .$delete_button
          );
        }
      }
      else {
        $json = "";
      }
      $total_records = $list_of_generated_cab_memo['total_records'];
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


    public function generateVGRCabId() {

    $_POST = json_decode(file_get_contents("php://input"), true);
    $this->load->library('form_validation');

    $this->form_validation->set_rules('selectedDistricts[]', 'District Selection', 'trim|required');

    $this->form_validation->set_rules('cab_memo_name', 'Memo Name', 'trim|required');
    if ($this->form_validation->run() == FALSE)
    {
      echo json_encode(array(
        'responseType' => 1,
        'message'      => 'Please Enter Cab Memo Name & Select Districts',
      ));
      return;
    }

    $curr_date       = date('Y-m-d h:i:s');
    $allSelectedList = $this->input->post('selectedDistricts');
    $cab_memo_name   = $this->input->post('cab_memo_name');
    $cab_ref_no      = $this->input->post('cab_ref_no');
    $cab_remarks     = $this->input->post('cab_remarks');
    $editCabId       = $this->input->post('editCabId');    
    $user_code       = $this->dept_user_code;
    $generate_cab    = 'CAB/'.date('Y').'/'.date('Y').$this->getSequence();

    if(!empty($allSelectedList)) {
      foreach ($allSelectedList as $cabid)
      {
        $dist_name = $this->utilclass->getDistrictNameOnLanding($cabid);

        if($editCabId != '' || $editCabId != null){
          $updateCab = [
            'cab_id'     => $editCabId.'__1',
            'updated_at' => $curr_date,
            'status'     => EDITED_CAB_ID,
            'vgr_cab'     => 1,
          ];
          $this->db->where('cab_id', $editCabId);
          $this->db->where('dist_code', $cabid);
          $this->db->update('cab_id_list', $updateCab);
          if($this->db->affected_rows() <= 0){
            log_message('error', '#ERR155: Updation failed '.$this->db->last_query());
            echo json_encode(array(
              'responseType' => 1,
              'message'      => '#ERR155: Something went wrong on updating CAB ID. Kindly contact system administrator',
            ));
            return;
          }
        }

        $insCab = [
          'cab_id'        => $editCabId !=null ? $editCabId : $generate_cab,
          'cab_memo_name' => $cab_memo_name,
          'reference_no'  => $cab_ref_no,
          'remarks'       => $cab_remarks,
          'dist_code'     => $cabid,
          'dist_name'     => $dist_name,
          'user_code'     => $user_code,
          'status'        => GENERATED_CAB_ID,
          'vgr_cab'        => 1,
          'created_at'    => $curr_date,
          'updated_at'    => $curr_date,
        ];
        $insertData = $this->db->insert('cab_id_list', $insCab);
        if($insertData != 1 || $insertData != true){
          log_message('error', '#ERR178: Insertion failed '.$this->db->last_query());
          echo json_encode(array(
            'responseType' => 1,
            'message'      => '#ERR178: Something went wrong on creating CAB ID. Kindly contact system administrator',
          ));
          return;
        }        
      }
      echo json_encode(array(
        'responseType' => 2,
        'message'      => 'CAB ID successfully generated',
      ));
      return;
    }
    else {
      echo json_encode(array(
        'responseType' => 1,
        'message'      => '#ERR167: No District selected',
      ));
      return;
    }      
  }


  public function toBeFinalizeVGRCabId() {
    if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) {     
      $data['_view'] = 'cab/toBeFinalizeCabVGR';
      $this->load->view('layouts/main', $data);
    } else {
      echo "User Not Authorized to View this Page";
    }
  }



    public function getVGRCabIdByUserDistrict() {
    $json = null;
    $user_code = $this->dept_user_code;
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');
    $status = ADD_CASES_UNDER_CAB_ID;

    $memo_list = $this->CabModel->getCabIdListFromMasterVGR($start, $length, $order,$status);

    if(!empty($memo_list)) {

      if($memo_list['total_records'] > 0){

        $data_rows = $memo_list['data_results'];

        foreach($data_rows as $row) {

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

          $created_at = date('d-m-Y',strtotime($row->created_at));

          $link = base_url() . "index.php/CabController/getListOfCasesByCabId?cab_id=".$row->cab_id;
          $view_case = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-edit'></i> &nbsp;Manage VGR Cases</a>";

          $generate_memo = '<button type="button" class="btn btn-sm btn-success" onclick="openModalMemoVGR('."'".$row->cab_id."'".')"><i class="fa fa-file"></i> &nbsp;Generate Memo (VGR)</button>';

          $link2 = base_url() . "index.php/Basundhara/downloadReportForCabMemo?cab_id=".$row->cab_id;
          $generate_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp;VGR Case Report</a>";


          if(strtotime(HOLD_All_MB2_CASES_DATE) > strtotime(date('Y-m-d H:i:s')))
          {
          $button = $view_case.' '.$generate_memo.' '.$generate_report;

          }else
          {
          $button = $view_case;
          }

          
          $json[] = array(
            // $sql->cab_memo_name,
            '<span class="text-danger"> '. $sql->cab_memo_name .'</span>',
            '<span class="text-primary"> '. $row->cab_id .'</span>',
            '<small class="text-primary"> '. $sql->dist_name .'</small>',
            // $sql->dist_name,
            $created_at,
            $button,
          );
        }
      }
      else {
        $json = "";
      }      

      $total_records = $memo_list['total_records'];
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



  public function GenerateCabMemoVGR()
  {
    $data = array();
    $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id_memo');

    $distMeeting = $this->db->query("select  dist_code,meeting_id from cab_memo_list WHERE cab_id=? AND status=? group by dist_code, meeting_id", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->result();

      $data['emb'] = base_url().'assets/emblem-dark.png';

      $data['cab_memo_date'] = $this->input->post('cab_memo_date');
      $data['rev_cab_ref_no'] = $this->input->post('rev_cab_ref_no');
      $data['idc'] = $this->input->post('idc');
      $data['total_prop'] = 0;
      $res = $this->db->query("select count(*) as total from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->row();
      $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->row();

      $dist_name = $this->db->query("select distinct dist_code  from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->result();

      $distNames = array_map(function ($item) {
                    return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                }, $dist_name);

      $commaSeparatedDistName = implode(",", $distNames);

      if (!empty($res) && $res != null && $res != "") {
        $data['total_prop'] = $res->total;
        $data['dist_count'] = $dist_count->total_dist;
        $data['dist_name'] = $commaSeparatedDistName;
        $data['total_individual_text'] = $this->utilclass->numberToWords($res->total);
      }

    $errCheck = 0;

    foreach($distMeeting as $dist)
    {

        $memoCase = $this->basundharamodel->getCasesCountFromCabMemo($dist->dist_code,$dist->meeting_id);

        $memoCaseCount = $memoCase->num_rows();

        
        $this->db2 =  $this->dbswitch2($dist->dist_code);


        $meetingCase = $this->basundharamodel->getCasesCountByDistMeeting($this->db2,$dist->meeting_id);

        $vgrMeetingRevertStatus = $meetingCase->row()->vgr_pgr_revert_status;

        $meetingName = '<strong class="text-danger bg-yellow">'.$this->utilclass->getMeetingNameByMeetingId($dist->dist_code, $dist->meeting_id) . '</strong>';

        $meetingCaseCount = $meetingCase->num_rows();

        $pullRequestCase = $this->basundharamodel->getCasesHavingPullRequest($this->db2,$dist->meeting_id);

        $pullRequestCaseCount = $pullRequestCase->num_rows();


        if($pullRequestCaseCount > 0)
        {

          $errCheck = 1;
          $pullRequestCasesList =$pullRequestCase->result();

          $pullRequestCaseNos = array_map(function ($item) {
                    return $item->case_no;
                }, $pullRequestCasesList);

            $allPullRequestCases = implode(", ", $pullRequestCaseNos);

            $casesWithPullRequest = '<strong class="text-success">'.$allPullRequestCases. '</strong>';  

            $meetingName = '<strong class="text-danger bg-yellow">'.$this->utilclass->getMeetingNameByMeetingId($dist->dist_code, $dist->meeting_id) . '</strong>';

            $this->session->set_flashdata('message', 'Can not Generate Memo for : ' . $cab_id_memo .' as Cases Having Modification Request Under meeting ' . $meetingName . '<br># List of  Cases With Pull Requset Under Meeting : <br>' . $casesWithPullRequest . '<br>(Revert These Cases To DC before Generate Memo)');
            $this->load->view('errorMessage');
            return;
        }
        else if(intval($vgrMeetingRevertStatus) == 1)
        {
            $errCheck = 1;
            $this->session->set_flashdata('message', 'Can not Generate Memo for : ' . $cab_id_memo .' as Some Cases are Reverted back from Meeting ' . $meetingName.' under Cab Memo');
            $this->load->view('errorMessage');  
            return;
        }
        else
        {
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

              $casesPending = '<span class="text-primary">'.$allPendingCases. '</span>';  
            
              $this->session->set_flashdata('message', 'Can not Generate Memo for : ' . $cab_id_memo .' as Cases Pending for meeting ' . $meetingName . '<br># List of Pending Cases Under Meeting : <br>' . $casesPending);
              $this->load->view('errorMessage');  
              return;
          }

        }


    }

      if($errCheck == 0)
      {
              $this->load->view('cabinet_vgr', $data);  

      }

  }


    public function finalApproveCabIdVGR() {
    if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) {     
      $data['_view'] = 'cab/finalApprovalCabIdVGR';
      $this->load->view('layouts/main', $data);
    } else {
      echo "User Not Authorized to View this Page";
    }
  }

    public function getCabIdByUserDistrictFinalApprovalVGR() {
    $json = null;
    $user_code = $this->dept_user_code;
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');
    $status = 2;

    $memo_list = $this->CabModel->getCabIdListFromMasterVGR($start, $length, $order,$status);
    
    if(!empty($memo_list)) {

      if($memo_list['total_records'] >  0){

        $data_rows = $memo_list['data_results'];

        foreach($data_rows as $row) {

          $notification_generate_status = $row->notification_generated;
          $digital_sign_status = $row->notification_digital_sign_status;

          if($notification_generate_status == 1 && $digital_sign_status == 0)
            {
            $cab_status = "<small class='text-primary'> Notification Generated</small>";
            }
          else if($notification_generate_status == 1 && $digital_sign_status == 1)
            {
            $cab_status = "<strong class='text-success'> Digitally Signed</strong>";
            }
          else if($notification_generate_status == 0 && $digital_sign_status == 0)
            {
            $cab_status = "<small class='text-danger'> Notification Not Generated</small>";
            }

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name,notification_generated FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name,notification_generated", array($row->cab_id))->row();

          $link = base_url() . "index.php/CabController/viewGeneratedMemo?cab_id=".$row->cab_id;
          $view_memo = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-eye'></i> &nbsp;View Memo</a>";

          $linkDoc = base_url() . "index.php/CabController/viewGeneratedMemoDoc?cab_id=".$row->cab_id;
          $view_memo_doc = "<a href=".$linkDoc." class='btn btn-sm btn-secondary' target='_blank'><i class='fa fa-download'></i> &nbsp;Download Memo [DOC]</a>";

          $generate_notification = '<button type="button" class="btn btn-sm btn-success" onclick="openModalNotificationVGR('."'".$row->cab_id."'".')"><i class="fa fa-file"></i> &nbsp;Generate Notification (VGR)</button>';


          $link3 = base_url() . "index.php/Basundhara/casesListForFinalApprovalByDeptVGR?cab_id=".$row->cab_id;
          $view_case = "<a href=".$link3." class='btn btn-sm btn-success'><i class='fa fa-eye'></i> &nbsp;Process(VGR)</a>";


          $link2 = base_url() . "index.php/Basundhara/downloadReportForCabMemo?cab_id=".$row->cab_id;
          $download_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp;Generate Report(VGR)</a>";

          $link3 = base_url() . "index.php/Basundhara/downloadRevertedCaseListReportVGR?cab_id=".$row->cab_id;
          $reverted_report = "<a href=".$link3." class='btn btn-sm btn-danger' ><i class='fa fa-download'></i> &nbsp;Reverted Report(VGR)</a>";

          $link4 = base_url() . "index.php/CabController/downloadGeneratedNotification?cab_id=".$row->cab_id;
          $download_notification = "<a href=".$link4." class='btn btn-sm btn-success' ><i class='fa fa-download'></i> &nbsp;Download Notification</a>";


          $created_at = date('d-m-Y',strtotime($row->created_at));

          if(strtotime(HOLD_All_MB2_CASES_DATE) > strtotime(date('Y-m-d H:i:s')))
          {
              if($sql->notification_generated == 1)
                {
                // $button = $download_notification.' '.$view_memo.' '. $view_memo_doc.' '.$download_report.' '.$reverted_report;
                $button = $view_case.' '.$download_notification.' '.$view_memo.' '. $view_memo_doc.' '.$download_report.' '.$reverted_report;
                }
                else 
                {
                $button = $generate_notification.' '.$view_memo.' '. $view_memo_doc.' '.$download_report.' '.$reverted_report;
                }
          }else
          {
                $button = $view_memo;
          }

         
          $json[] = array(
            '<strong class="text-danger"> '. $sql->cab_memo_name .'</strong>',
            '<strong class="text-primary"> '. $row->cab_id .'</strong>',
            $cab_status,
            '<small class="text-primary"> '. $sql->dist_name .'</small>',
            $created_at,
            $button,
          );
        }
      }
      else {
        $json = "";
      }      
      
      $total_records = $memo_list['total_records'];

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


  public function deptApprovedCabIdListVGR() {
    if ($this->session->userdata('designation') == DEPARTMENT_USERCODE) {     
      $data['_view'] = 'cab/deptApprovedCabIdListVGR';
      $this->load->view('layouts/main', $data);
    } else {
      echo "User Not Authorized to View this Page";
    }
  }



  public function getFinalApprovedCabIdListVGR() 
  {
    $json = null;
    $user_code = $this->dept_user_code;
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');
    $status = FINAL_SUBMISSION_CAB_MEMO;

    $memo_list = $this->CabModel->getCabIdListFromMasterVGR($start, $length, $order,$status);

    if(!empty($memo_list)) {

      if($memo_list['total_records'] >  0){

        $data_rows = $memo_list['data_results'];

        foreach($data_rows as $row) {

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

          $link = base_url() . "index.php/CabController/viewGeneratedMemo?cab_id=".$row->cab_id;
          $view_memo = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-eye'></i> &nbsp;View Memo</a>";

          
          $link3 = base_url() . "index.php/CabController/getListOfFinalApprovedCasesByCabId?cab_id=".$row->cab_id;
          $view_case = "<a href=".$link3." class='btn btn-sm btn-success'><i class='fa fa-eye'></i> &nbsp; Case List</a>";


          $link2 = base_url() . "index.php/Basundhara/downloadReportForCabMemo?cab_id=".$row->cab_id;
          $download_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp;Case Report</a>";

          $link4 = base_url() . "index.php/CabController/viewGeneratedNotification?cab_id=".$row->cab_id;
          $download_notification = "<a href=".$link4." class='btn btn-sm btn-secondary' ><i class='fa fa-eye'></i> &nbsp;Uploaded Notification Copy</a>";


          $approved_at = date('d-m-Y',strtotime($row->approved_at));

          $button = $view_case.' '.$download_report.' '.$download_notification;
          
          $json[] = array(
            '<strong class="text-danger"> '. $sql->cab_memo_name .'</strong>',
            '<strong class="text-primary"> '. $row->cab_id .'</strong>',
            '<small class="text-primary"> '. $sql->dist_name .'</small>',
            '<small class="text-primary"> '. $row->dept_order_no .'</small>',
            $approved_at,
            $button,
          );
        }
      }
      else {
        $json = "";
      }      
      
      $total_records = $memo_list['total_records'];

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


  public function viewGeneratedNotification()
  {
    $cab_id = $this->input->get('cab_id');

    $path = $this->db->query("SELECT upload_notification_doc_path FROM cab_id_list WHERE cab_id=? AND 
              status=?", array($cab_id, 3))->row()->upload_notification_doc_path;
    $mainfile = file_get_contents($path);
    header("Content-type: application/pdf");
    echo $mainfile;
  }


  public function deleteCabIdVGR() 
  {
    $_POST = json_decode(file_get_contents("php://input"), true);
    $cab_id_delete = $this->input->post('cab_id_delete');
    $curr_date       = date('Y-m-d h:i:s');

    if($cab_id_delete == '' || $cab_id_delete == null)
    {
      echo json_encode(array(
            'responseType' => 1,
            'message'      => '#ERRCABDEL1: CAB ID not found. Kindly contact system administrator',
          ));
      return;
    }
    else if($cab_id_delete != '' || $cab_id_delete != null)
    {
        $updateCab = [
          'cab_id'     => $cab_id_delete.'__1',
          'updated_at' => $curr_date,
          'status'     => EDITED_CAB_ID,
        ];
        $this->db->where('cab_id', $cab_id_delete);
        $this->db->where('status', 0);
        $this->db->where('vgr_cab', 1);
        $this->db->where('user_code', $this->dept_user_code);
        $this->db->where('finalized_at', NULL);
        $this->db->where('approved_at', NULL);
        $this->db->where('dept_order_no', NULL);
        $this->db->where('upload_memo_path', NULL);
        $this->db->where('upload_memo_doc_path', NULL);
        $this->db->where('upload_notification_doc_path', NULL);
        $this->db->update('cab_id_list', $updateCab);
        if($this->db->affected_rows() <= 0){
          log_message('error', '#ERR155: Updation failed '.$this->db->last_query());
            echo json_encode(array(
              'responseType' => 1,
              'message'      => '#ERRCABDEL: Something went wrong on Removing CAB ID: ' .$cab_id_delete. ' Kindly contact system administrator',
            ));
          return;
        }
        else 
        {
            echo json_encode(array(
              'responseType' => 2,
              'message'      => 'CAB ID: ' .$cab_id_delete . ' Successfully Deleted',
            ));
        }
    }
    else
    {
      echo json_encode(array(
            'responseType' => 1,
            'message'      => '#ERRCABDEL2: Something Went Wrong. Kindly contact system administrator',
          ));
    }
  }


  public function GenerateNotification()
  {
    $data = array();
    $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id_memo');
      // $data['emb'] = base_url().'assets/emblem-dark.png';
      $data['e_file_no'] = $this->input->post('e_file_no');
      // $data['idc'] = $this->input->post('idc');

      $data['date_of_cabinet'] = $this->input->post('date_of_cabinet');
      $data['current_date'] = date("d-m-Y");
      $data['total_prop'] = 0;
      $data['user_code'] = $this->session->userdata('user_code');

      
      $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, 2))->row();

      $dist_name = $this->db->query("select distinct dist_code  from cab_memo_list WHERE cab_id=? AND status=? ORDER BY dist_code asc", array($cab_id_memo, 2))->result();

      $distNames = array_map(function ($item) {
                    return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                }, $dist_name);

      $caseCount = $this->db->query("select count(*) as total from cab_memo_list WHERE cab_id=?  GROUP BY dist_code ORDER BY dist_code asc", array($cab_id_memo))->result();

      $caseCountByDist = array_map(function ($item) {
                    return $item->total;
                }, $caseCount);

      $commaSeparatedCaseCount = implode(" & ", $caseCountByDist);
      $commaSeparatedDistName = implode(",", $distNames);
      $slashSeparatedDistName = implode("/", $distNames);

      if (!empty($caseCount) && $caseCount != null && $caseCount != "") {
        $data['total_prop'] = $commaSeparatedCaseCount;
        $data['dist_count'] = $dist_count->total_dist;
        $data['dist_name'] = $commaSeparatedDistName;
        $data['dist_name_slash'] = $slashSeparatedDistName;
      }

      $this->load->view('notification', $data);  
  }


  public function GenerateNotificationOffline()
  {
    $data = array();
    $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id_memo');
      // $data['emb'] = base_url().'assets/emblem-dark.png';
      $data['e_file_no'] = $this->input->post('e_file_no');
      // $data['idc'] = $this->input->post('idc');

      $data['date_of_cabinet'] = $this->input->post('date_of_cabinet');
      $data['current_date'] = date("d-m-Y");
      $data['total_prop'] = 0;
      $data['user_code'] = $this->session->userdata('user_code');

      
      $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, 2))->row();

      $dist_name = $this->db->query("select distinct dist_code  from cab_memo_list WHERE cab_id=? AND status=? ORDER BY dist_code asc", array($cab_id_memo, 2))->result();

      $distNames = array_map(function ($item) {
                    return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                }, $dist_name);

      $caseCount = $this->db->query("select count(*) as total from cab_memo_list WHERE cab_id=?  GROUP BY dist_code ORDER BY dist_code asc", array($cab_id_memo))->result();

      $caseCountByDist = array_map(function ($item) {
                    return $item->total;
                }, $caseCount);

      $commaSeparatedCaseCount = implode(" & ", $caseCountByDist);
      $commaSeparatedDistName = implode(",", $distNames);
      $slashSeparatedDistName = implode("/", $distNames);

      if (!empty($caseCount) && $caseCount != null && $caseCount != "") {
        $data['total_prop'] = $commaSeparatedCaseCount;
        $data['dist_count'] = $dist_count->total_dist;
        $data['dist_name'] = $commaSeparatedDistName;
        $data['dist_name_slash'] = $slashSeparatedDistName;
      }

      $this->load->view('notification_offline', $data);  
  }


  public function SavePDFNotificationCopy()
  {
    // $_POST = json_decode(file_get_contents("php://input"), true);
    // $htmlHead       = $this->input->post('htmlHead');
    $html1       = $this->input->post('html1');
    $html2       = $this->input->post('html2');
    $html3       = $this->input->post('html3');
    $html4       = $this->input->post('html4');
    $html5       = $this->input->post('html5');
    $html6       = $this->input->post('html6');
    $html7       = $this->input->post('html7');
    $html8       = $this->input->post('html8');
    $html9       = $this->input->post('html9');
    $html10       = $this->input->post('html10');
    $html11       = $this->input->post('html11');
    $cab_id_memo  = $this->input->post('meeting_id');
    $date_of_cabinet = $this->input->post('date_of_cabinet');

    $notificationName = "NOTIFICATION";
    $memoId = str_replace("/", "_", $cab_id_memo);
    $html = "";
    $htmlbreak ="<br>";
    $html .= '<style>
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
                  
                      </style>';


    $fileName    = $notificationName . '_DEPT_' . date("Y") . '_' . $memoId;

    include 'vendor/mpdf/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $waterMark = 'Notification_' . $memoId;
    $mpdf->SetWatermarkText($waterMark);
    $mpdf->showWatermarkText = true;
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont = true;
    $mpdf->writeHTML($html . $html1 . $htmlbreak . $html2 . $htmlbreak  . $html3 . $htmlbreak . $html4 . $htmlbreak .  $html5 . $htmlbreak .  $html6 .$htmlbreak .  $html7 .$htmlbreak .  $html8 .$htmlbreak .  $html9 .$htmlbreak .  $html10 .$htmlbreak .  $html11 .$htmlbreak . $htmlbreak );

    $mpdf->Output(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf', 'F');
    $b64Doc = chunk_split(base64_encode(file_get_contents(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf')));
    $upload_notification_path = NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf';

    $curr_date = date('Y-m-d h:i:s');
    $user_code = $this->dept_user_code;

      $this->db->trans_begin();
      $query2 = $this->db->query(
        "UPDATE cab_id_list SET date_of_cabinet = ? , upload_notification_doc_path = ?, notification_generated=?, updated_at=?
                                WHERE user_code=? AND status=? AND cab_id=?",
        array($date_of_cabinet,$upload_notification_path,1, $curr_date, $user_code, 2, $cab_id_memo)
      );

      $uploadNotificationStatus = $this->db->affected_rows();

      if ($uploadNotificationStatus <= 0) {
        $this->db->trans_rollback();
        log_message("error", "#ERRORNG123 : Notification Generation Failed...Table cab_id_list" . $this->db->last_query());
        echo json_encode(array(
          'responseType' => 3,
          'message' => "#ERRORNG123 : Notification Generation Failed..."
        ));
        return;
      }
      else
      {
        $this->db->trans_commit();
        echo json_encode(array(
          'responseType' => 2,
          'meetingId'    => $memoId,
          'message' => "Successfully generated Notification Copy for the Cab Memo No :" . $memoId
        ));
      }
  }


  public function SavePDFNotificationCopyOffline()
  {
    // $_POST = json_decode(file_get_contents("php://input"), true);
    // $htmlHead       = $this->input->post('htmlHead');
    $html1       = $this->input->post('html1');
    $html2       = $this->input->post('html2');
    $html3       = $this->input->post('html3');
    $html4       = $this->input->post('html4');
    $html5       = $this->input->post('html5');
    $html6       = $this->input->post('html6');
    $html7       = $this->input->post('html7');
    $html8       = $this->input->post('html8');
    $html9       = $this->input->post('html9');
    $html10       = $this->input->post('html10');
    $html11       = $this->input->post('html11');
    $cab_id_memo  = $this->input->post('meeting_id');
    $date_of_cabinet = $this->input->post('date_of_cabinet');

    $notificationName = "NOTIFICATION";
    $memoId = str_replace("/", "_", $cab_id_memo);
    $html = "";
    $htmlbreak ="<br>";
    $html .= '<style>
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
                  
                      </style>';


    $fileName    = $notificationName . '_DEPT_' . date("Y") . '_' . $memoId;

    include 'vendor/mpdf/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $waterMark = 'Notification_' . $memoId;
    $mpdf->SetWatermarkText($waterMark);
    $mpdf->showWatermarkText = true;
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont = true;
    $mpdf->writeHTML($html . $html1 . $htmlbreak . $html2 . $htmlbreak  . $html3 . $htmlbreak . $html4 . $htmlbreak .  $html5 . $htmlbreak .  $html6 .$htmlbreak .  $html7 .$htmlbreak .  $html8 .$htmlbreak .  $html9 .$htmlbreak .  $html10 .$htmlbreak .  $html11 .$htmlbreak . $htmlbreak );

    $mpdf->Output(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf', 'F');
    $b64Doc = chunk_split(base64_encode(file_get_contents(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf')));
    $upload_notification_path = NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf';

    $curr_date = date('Y-m-d h:i:s');
    $user_code = $this->dept_user_code;

    $this->db->trans_begin();
    $query2 = $this->db->query(
      "UPDATE cab_id_list SET date_of_cabinet = ? , upload_notification_doc_path = ?, notification_generated=?, updated_at=?
                              WHERE user_code=? AND status=? AND cab_id=?",
      array($date_of_cabinet,$upload_notification_path,1, $curr_date, $user_code, 2, $cab_id_memo)
    );

    $uploadNotificationStatus = $this->db->affected_rows();

    if ($uploadNotificationStatus <= 0) {
      $this->db->trans_rollback();
      log_message("error", "#OFFLINEERRORNG123 : Notification Generation Failed...Table cab_id_list" . $this->db->last_query());
      echo json_encode(array(
        'responseType' => 3,
        'message' => "#OFFLINEERRORNG123 : Notification Generation Failed..."
      ));
      return;
    }
    else
    {
      $this->db->trans_commit();
      echo json_encode(array(
        'responseType' => 2,
        'meetingId'    => $memoId,
        'message' => "Successfully generated Notification Copy for the Cab Memo No :" . $memoId
      ));
    }
  }


  public function downloadGeneratedNotification()
  {
    $cab_id = $this->input->get('cab_id');
    $path = $this->db->query("SELECT upload_notification_doc_path FROM cab_id_list WHERE cab_id=? AND 
              status=?", array($cab_id, 2))->row()->upload_notification_doc_path;
    $mainfile = file_get_contents($path);
    header("Content-type: application/pdf"); 
    header("Content-Disposition: attachment; filename=\"Notification_Copy_ {$cab_id}.pdf\"");
    echo $mainfile;
  }

  public function GenerateNotificationForSign()
  {
    $data = array();
    $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id');
      // $data['emb'] = base_url().'assets/emblem-dark.png';
      $data['e_file_no'] = 'EBEG';
      // $data['idc'] = $this->input->post('idc');
      $date_of_cabinet = $this->db->query("select date_of_cabinet from cab_id_list WHERE cab_id=?", array($cab_id_memo))->row()->date_of_cabinet;
      $data['date_of_cabinet'] = $date_of_cabinet;
      $data['current_date'] = date("d-m-Y");
      $data['total_prop'] = 0;
      $data['user_code'] = $this->session->userdata('user_code');
      
      $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, 2))->row();

      $dist_name = $this->db->query("select distinct dist_code  from cab_memo_list WHERE cab_id=? AND status=? ORDER BY dist_code asc", array($cab_id_memo, 2))->result();

      $distNames = array_map(function ($item) {
                    return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                }, $dist_name);

      $caseCount = $this->db->query("select count(*) as total from cab_memo_list WHERE cab_id=? AND status=? and  final_submit_status =? GROUP BY dist_code ORDER BY dist_code asc", array($cab_id_memo, 2,0))->result();

      $caseCountByDist = array_map(function ($item) {
                    return $item->total;
                }, $caseCount);

      $commaSeparatedCaseCount = implode(" & ", $caseCountByDist);
      $commaSeparatedDistName = implode(",", $distNames);
      $slashSeparatedDistName = implode("/", $distNames);

      if (!empty($caseCount) && $caseCount != null && $caseCount != "") {
        $data['total_prop'] = $commaSeparatedCaseCount;
        $data['dist_count'] = $dist_count->total_dist;
        $data['dist_name'] = $commaSeparatedDistName;
        $data['dist_name_slash'] = $slashSeparatedDistName;
      }

      $this->load->view('notification_for_sign', $data);  
  }

  public function GenerateNotificationForSignOffline()
  {
    $data = array();
    $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id');
      // $data['emb'] = base_url().'assets/emblem-dark.png';
      $data['e_file_no'] = 'EBEG';
      // $data['idc'] = $this->input->post('idc');
      $date_of_cabinet = $this->db->query("select date_of_cabinet from cab_id_list WHERE cab_id=?", array($cab_id_memo))->row()->date_of_cabinet;
      $data['date_of_cabinet'] = $date_of_cabinet;
      $data['current_date'] = date("d-m-Y");
      $data['total_prop'] = 0;
      $data['user_code'] = $this->session->userdata('user_code');
      
      $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, 2))->row();

      $dist_name = $this->db->query("select distinct dist_code  from cab_memo_list WHERE cab_id=? AND status=? ORDER BY dist_code asc", array($cab_id_memo, 2))->result();

      $distNames = array_map(function ($item) {
                    return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                }, $dist_name);

      $caseCount = $this->db->query("select count(*) as total from cab_memo_list WHERE cab_id=? GROUP BY dist_code ORDER BY dist_code asc", array($cab_id_memo))->result();

      $caseCountByDist = array_map(function ($item) {
                    return $item->total;
                }, $caseCount);

      $commaSeparatedCaseCount = implode(" & ", $caseCountByDist);
      $commaSeparatedDistName = implode(",", $distNames);
      $slashSeparatedDistName = implode("/", $distNames);

      if (!empty($caseCount) && $caseCount != null && $caseCount != "") {
        $data['total_prop'] = $commaSeparatedCaseCount;
        $data['dist_count'] = $dist_count->total_dist;
        $data['dist_name'] = $commaSeparatedDistName;
        $data['dist_name_slash'] = $slashSeparatedDistName;
      }

      $this->load->view('notification_for_sign_offline', $data);  
  }



  public function SavePDFNotificationCopySign()
  {
    // $_POST = json_decode(file_get_contents("php://input"), true);
    // $htmlHead       = $this->input->post('htmlHead');
    $html1       = $this->input->post('html1');
    $html2       = $this->input->post('html2');
    $html3       = $this->input->post('html3');
    $html4       = $this->input->post('html4');
    $html5       = $this->input->post('html5');
    $html6       = $this->input->post('html6');
    $html7       = $this->input->post('html7');
    $html8       = $this->input->post('html8');
    $html9       = $this->input->post('html9');
    $html10       = $this->input->post('html10');
    $html11       = $this->input->post('html11');
    $html12       = $this->input->post('html12');
    $cab_id_memo  = $this->input->post('meeting_id');

    $notificationName = "NOTIFICATION";
    $memoId = str_replace("/", "_", $cab_id_memo);
    $html = "";
    $htmlbreak ="<br>";
    $html .= '<style>
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
                  
                      </style>';


    $fileName    = $notificationName . '_DEPT_' . date("Y") . '_' . $memoId;

    include 'vendor/mpdf/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $waterMark = 'Notification_' . $memoId;
    $mpdf->SetWatermarkText($waterMark);
    $mpdf->showWatermarkText = true;
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont = true;
    $mpdf->writeHTML($html . $html1 . $htmlbreak . $html2 . $htmlbreak  . $html3 . $htmlbreak . $html4 . $htmlbreak .  $html5 . $htmlbreak .  $html6 .$htmlbreak .  $html7 .$htmlbreak .  $html8 .$htmlbreak .  $html9 .$htmlbreak .  $html10 .$htmlbreak .  $html11 .  $html12 . $htmlbreak . $htmlbreak );

    $mpdf->Output(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf', 'F');

    $b64Doc = chunk_split(base64_encode(file_get_contents(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf')));
    echo json_encode(array(
              'responseType' => 2,
              'base64EncodeData' => $b64Doc
      ));
    return;


    // $upload_notification_path = NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf';

    // $curr_date = date('Y-m-d h:i:s');
    // $user_code = $this->dept_user_code;

    //   $this->db->trans_begin();
    //   $query2 = $this->db->query(
    //     "UPDATE cab_id_list SET upload_notification_doc_path = ?, notification_generated=?, updated_at=?
    //                             WHERE user_code=? AND status=? AND cab_id=?",
    //     array($upload_notification_path,1, $curr_date, $user_code, 2, $cab_id_memo)
    //   );

    //   $uploadNotificationStatus = $this->db->affected_rows();

    //   if ($uploadNotificationStatus <= 0) {
    //     $this->db->trans_rollback();
    //     log_message("error", "#ERRORNG123 : Notification Generation Failed...Table cab_id_list" . $this->db->last_query());
    //     echo json_encode(array(
    //       'responseType' => 3,
    //       'message' => "#ERRORNG123 : Notification Generation Failed..."
    //     ));
    //     return;
    //   }
    //   else
    //   {
    //     $this->db->trans_commit();
    //     echo json_encode(array(
    //       'responseType' => 2,
    //       'meetingId'    => $memoId,
    //       'message' => "Successfully generated Notification Copy for the Cab Memo No :" . $memoId
    //     ));
    //   }
  }


  public function SavePDFNotificationCopySignOffline()
  {
    // $_POST = json_decode(file_get_contents("php://input"), true);
    // $htmlHead       = $this->input->post('htmlHead');
    $html1       = $this->input->post('html1');
    $html2       = $this->input->post('html2');
    $html3       = $this->input->post('html3');
    $html4       = $this->input->post('html4');
    $html5       = $this->input->post('html5');
    $html6       = $this->input->post('html6');
    $html7       = $this->input->post('html7');
    $html8       = $this->input->post('html8');
    $html9       = $this->input->post('html9');
    $html10       = $this->input->post('html10');
    $html11       = $this->input->post('html11');
    $html12       = $this->input->post('html12');
    $cab_id_memo  = $this->input->post('meeting_id');

    $notificationName = "NOTIFICATION";
    $memoId = str_replace("/", "_", $cab_id_memo);
    $html = "";
    $htmlbreak ="<br>";
    $html .= '<style>
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
                  
                      </style>';


    $fileName    = $notificationName . '_DEPT_' . date("Y") . '_' . $memoId;

    include 'vendor/mpdf/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $waterMark = 'Notification_' . $memoId;
    $mpdf->SetWatermarkText($waterMark);
    $mpdf->showWatermarkText = true;
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont = true;
    $mpdf->writeHTML($html . $html1 . $htmlbreak . $html2 . $htmlbreak  . $html3 . $htmlbreak . $html4 . $htmlbreak .  $html5 . $htmlbreak .  $html6 .$htmlbreak .  $html7 .$htmlbreak .  $html8 .$htmlbreak .  $html9 .$htmlbreak .  $html10 .$htmlbreak .  $html11 .  $html12 . $htmlbreak . $htmlbreak );

    $mpdf->Output(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf', 'F');

    $b64Doc = chunk_split(base64_encode(file_get_contents(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf')));
    echo json_encode(array(
              'responseType' => 2,
              'base64EncodeData' => $b64Doc
      ));
    return;


    // $upload_notification_path = NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf';

    // $curr_date = date('Y-m-d h:i:s');
    // $user_code = $this->dept_user_code;

    //   $this->db->trans_begin();
    //   $query2 = $this->db->query(
    //     "UPDATE cab_id_list SET upload_notification_doc_path = ?, notification_generated=?, updated_at=?
    //                             WHERE user_code=? AND status=? AND cab_id=?",
    //     array($upload_notification_path,1, $curr_date, $user_code, 2, $cab_id_memo)
    //   );

    //   $uploadNotificationStatus = $this->db->affected_rows();

    //   if ($uploadNotificationStatus <= 0) {
    //     $this->db->trans_rollback();
    //     log_message("error", "#ERRORNG123 : Notification Generation Failed...Table cab_id_list" . $this->db->last_query());
    //     echo json_encode(array(
    //       'responseType' => 3,
    //       'message' => "#ERRORNG123 : Notification Generation Failed..."
    //     ));
    //     return;
    //   }
    //   else
    //   {
    //     $this->db->trans_commit();
    //     echo json_encode(array(
    //       'responseType' => 2,
    //       'meetingId'    => $memoId,
    //       'message' => "Successfully generated Notification Copy for the Cab Memo No :" . $memoId
    //     ));
    //   }
  }


  public function GenerateNotificationVGR()
  {
      $data = array();
      $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id_memo');
      $data['e_file_no'] = $this->input->post('e_file_no');

      $data['date_of_cabinet'] = $this->input->post('date_of_cabinet');
      $data['current_date'] = date("d-m-Y");
      $data['total_prop'] = 0;
      
      $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, 2))->row();

      $dist_name = $this->db->query("select distinct dist_code  from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, 2))->result();

      $distNames = array_map(function ($item) {
                    return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                }, $dist_name);

      $caseCount = $this->db->query("select count(*) as total from cab_memo_list WHERE cab_id=? AND status=? GROUP BY dist_code", array($cab_id_memo, 2))->result();

      $caseCountByDist = array_map(function ($item) {
                    return $item->total;
                }, $caseCount);

      $commaSeparatedCaseCount = implode(" & ", $caseCountByDist);
      $commaSeparatedDistName = implode(",", $distNames);
      $slashSeparatedDistName = implode("/", $distNames);

      if (!empty($caseCount) && $caseCount != null && $caseCount != "") {
        $data['total_prop'] = $commaSeparatedCaseCount;
        $data['dist_count'] = $dist_count->total_dist;
        $data['dist_name'] = $commaSeparatedDistName;
        $data['dist_name_slash'] = $slashSeparatedDistName;
      }

      $this->load->view('notification-pgr-vgr', $data);  
  }



  public function SavePDFNotificationCopyVgr()
  {
    // $_POST = json_decode(file_get_contents("php://input"), true);
    // $htmlHead       = $this->input->post('htmlHead');
    $html1       = $this->input->post('html1');
    $html2       = $this->input->post('html2');
    $html3       = $this->input->post('html3');
    $html4       = $this->input->post('html4');
    $html5       = $this->input->post('html5');
    $html6       = $this->input->post('html6');
    $html7       = $this->input->post('html7');
    $html8       = $this->input->post('html8');
    $html9       = $this->input->post('html9');
    $html10       = $this->input->post('html10');
    $html11       = $this->input->post('html11');
    $cab_id_memo  = $this->input->post('meeting_id');
    $date_of_cabinet = $this->input->post('date_of_cabinet');

    $notificationName = "NOTIFICATION_VGR";
    $memoId = str_replace("/", "_", $cab_id_memo);
    $html = "";
    $htmlbreak ="<br>";
    $html .= '<style>
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
                  
                    </style>';


    $fileName    = $notificationName . '_DEPT_' . date("Y") . '_' . $memoId;

    include 'vendor/mpdf/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $waterMark = 'Notification_' . $memoId;
    $mpdf->SetWatermarkText($waterMark);
    $mpdf->showWatermarkText = true;
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont = true;
    $mpdf->writeHTML($html . $html1 . $htmlbreak . $html2 . $htmlbreak  . $html3 . $htmlbreak . $html4 . $htmlbreak .  $html5 . $htmlbreak .  $html6 .$htmlbreak .  $html7 .$htmlbreak .  $html8 .$htmlbreak .  $html9 .$htmlbreak .  $html10 .$htmlbreak .  $html11 .$htmlbreak . $htmlbreak );

    $mpdf->Output(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf', 'F');
    $b64Doc = chunk_split(base64_encode(file_get_contents(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf')));
    $upload_notification_path = NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf';

    $curr_date = date('Y-m-d h:i:s');
    $user_code = $this->dept_user_code;

      $this->db->trans_begin();
      $query2 = $this->db->query(
        "UPDATE cab_id_list SET date_of_cabinet = ? , upload_notification_doc_path = ?, notification_generated=?, updated_at=?
                                WHERE user_code=? AND status=? AND cab_id=?",
        array($date_of_cabinet,$upload_notification_path,1, $curr_date, $user_code, 2, $cab_id_memo)
      );

      $uploadNotificationStatus = $this->db->affected_rows();

      if ($uploadNotificationStatus <= 0) {
        $this->db->trans_rollback();
        log_message("error", "#ERRORNGVGR123 :VGR Notification Generation Failed...Table cab_id_list" . $this->db->last_query());
        echo json_encode(array(
          'responseType' => 3,
          'message' => "#ERRORNGVGR123 :VGR Notification Generation Failed..."
        ));
        return;
      }
      else
      {
        $this->db->trans_commit();
        echo json_encode(array(
          'responseType' => 2,
          'meetingId'    => $memoId,
          'message' => "Successfully generated Notification Copy for the VGR Cab Memo No :" . $memoId
        ));
      }
  }


    function downloadRevertedCaseDetailsbyDateByDistrict()
    {   
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $result=array();
        $i=0;
        $date_after = $_GET['date'];
        $dist_codes = ['02','03','05','06','07','08','11','12','13','14','15','16','17','18','21','24','25','32','33','34','35','36','37','38','39'];
        // $dist_codes = ['07'];
        $file_name=$date_after."_reverted_report.xlsx";

        foreach($dist_codes as $d)
        {   

            $this->db2 = $this->dbswitch2($d);

            $sql="SELECT DISTINCT ON (sp.case_no)
                    sp.case_no,
                    sp.note_on_order AS Revert_Remarks,
                    CASE
                        WHEN sp.user_code = 'DEPT01' THEN 'Ashok Kr Barman'
                        WHEN sp.user_code = 'DEPT02' THEN 'Shyamal Khetra Gogoi'
                        WHEN sp.user_code = 'DEPT03' THEN 'Dipankar Das'
                        ELSE sp.user_code
                    END AS Revert_by,
                    DATE(sp.date_entry) AS Revert_Date
                FROM
                    settlement_proceeding sp
                JOIN
                    settlement_basic sb ON sp.case_no = sb.case_no
                WHERE
                    sp.office_from = 'DPT'
                    AND sp.office_to = 'DC'
                    AND date(sp.next_date_of_hearing) >= '$date_after'
                    AND sb.dept_revert =1
                    -- AND sb.service_code != '17'
                ORDER BY
                sp.case_no,
                sp.next_date_of_hearing DESC";
            
            $results=$this->db2->query($sql);
            if($results->num_rows()==0)
                continue;
            else
                $result=$results->result_array();
                foreach($result as $r){

                 $final[]=array(
                     'Ditrict'=>$this->utilclass->getDistrictNameOnLanding($d),
                     'Case_no'=>$r['case_no'],
                     'Revert_remarks'=>$r['revert_remarks'],
                     'Revert_by'=>$r['revert_by'],
                     'Revert_date'=>$r['revert_date'],
                 );
                }
        }

        $this->basundharamodel->downloadExcelReport($file_name, $final);
    }


  public function GenerateNotificationForSignVgr()
  {
    $data = array();
    $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id');
      // $data['emb'] = base_url().'assets/emblem-dark.png';
      $data['e_file_no'] = 'EBEG';
      $date_of_cabinet = $this->db->query("select date_of_cabinet from cab_id_list WHERE cab_id=?", array($cab_id_memo))->row()->date_of_cabinet;
      $data['date_of_cabinet'] = $date_of_cabinet;
      $data['current_date'] = date("d-m-Y");
      $data['total_prop'] = 0;
      $data['user_code'] = $this->session->userdata('user_code');
      
      $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, 2))->row();

      $dist_name = $this->db->query("select distinct dist_code  from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, 2))->result();

      $distNames = array_map(function ($item) {
                    return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                }, $dist_name);

      $caseCount = $this->db->query("select count(*) as total from cab_memo_list WHERE cab_id=? AND status=? GROUP BY dist_code", array($cab_id_memo, 2))->result();

      $caseCountByDist = array_map(function ($item) {
                    return $item->total;
                }, $caseCount);

      $commaSeparatedCaseCount = implode(" & ", $caseCountByDist);
      $commaSeparatedDistName = implode(",", $distNames);
      $slashSeparatedDistName = implode("/", $distNames);

      if (!empty($caseCount) && $caseCount != null && $caseCount != "") {
        $data['total_prop'] = $commaSeparatedCaseCount;
        $data['dist_count'] = $dist_count->total_dist;
        $data['dist_name'] = $commaSeparatedDistName;
        $data['dist_name_slash'] = $slashSeparatedDistName;
      }

      $this->load->view('notification_for_sign_pgr_vgr', $data);  
  }


  ////////////////////NC SETTLEMENT////////////////////////
  public function createCabIdNC()
  {
    $_POST = json_decode(file_get_contents("php://input"), true);
    if (($this->designation == DEPARTMENT_USERCODE || $this->designation == DPT_JS) && $this->input->post('option') == null ){
      $data['user_assigned_dist'] = $this->CabModel->getDeptUserDistList()->result();
      $data['_view'] = 'cab_nc/createCabId';
      $this->load->view('layouts/main', $data);
    }
    else if (($this->designation == DEPARTMENT_USERCODE || $this->designation == DPT_JS) && $this->input->post('option') == 'edit') 
    {      
      
      $cab_id = $this->input->post('cab_id');
      $sql = $this->db->query("SELECT cab_id, cab_memo_name, reference_no, remarks 
                FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name, reference_no, remarks", 
                  array($cab_id))->row();
      $getSelectedDist = $this->db->query("SELECT dist_code FROM cab_id_list WHERE cab_id=?",
                            array($cab_id))->result();
      $user_assigned_districts = $this->CabModel->getDeptUserDistList()->result();
      echo json_encode(array(
        'responseType'  => 2,
        'cab_id'        => $sql->cab_id,
        'memo_name'     => $sql->cab_memo_name,
        'reference_no'  => $sql->reference_no,
        'remarks'       => $sql->remarks,
        'selected_dist' => $getSelectedDist,
        'all_dist'      => $user_assigned_districts,
      ));
      return;
    }
  }

  public function toBeFinalizeCabIdNC() {
    if ($this->session->userdata('designation') == DEPARTMENT_USERCODE || $this->session->userdata('designation') == DPT_JS) {     
      // $data['user_assigned_dist'] = $this->CabModel->getDeptUserDistList()->result(); 
      $data['_view'] = 'cab_nc/toBeFinalizeCab';
      $this->load->view('layouts/main', $data);
    } else {
      echo "User Not Authorized to View this Page";
    }
  }


  public function finalApproveCabIdNC() {
    if ($this->session->userdata('designation') == DEPARTMENT_USERCODE || $this->session->userdata('designation') == DPT_JS) {     
      // $data['user_assigned_dist'] = $this->CabModel->getDeptUserDistList()->result(); 
      $data['_view'] = 'cab_nc/finalApprovalCabId';
      $this->load->view('layouts/main', $data);
    } else {
      echo "User Not Authorized to View this Page";
    }
  }

  public function deptApprovedCabIdListNC() {
    if ($this->session->userdata('designation') == DEPARTMENT_USERCODE || $this->session->userdata('designation') == DPT_JS) {     
      $data['_view'] = 'cab_nc/deptApprovedCabIdList';
      $this->load->view('layouts/main', $data);
    } else {
      echo "User Not Authorized to View this Page";
    }
  }

  public function generateCabIdNC() {

    $_POST = json_decode(file_get_contents("php://input"), true);
    $this->load->library('form_validation');
    $this->form_validation->set_rules('selectedDistricts[]', 'District Selection', 'trim|required');
    $this->form_validation->set_rules('cab_memo_name', 'Memo Name', 'trim|required');
    if ($this->form_validation->run() == FALSE)
    {
      echo json_encode(array(
        'responseType' => 1,
        'message'      => 'Validation Issue',
      ));
      return;
    }

    $curr_date       = date('Y-m-d h:i:s');
    $allSelectedList = $this->input->post('selectedDistricts');
    $cab_memo_name   = $this->input->post('cab_memo_name');
    $cab_ref_no      = $this->input->post('cab_ref_no');
    $cab_remarks     = $this->input->post('cab_remarks');
    $editCabId       = $this->input->post('editCabId');    
    $user_code       = $this->dept_user_code;
    $generate_cab    = 'CAB/'.date('Y').'/'.date('Y').$this->getSequence();

    if(!empty($allSelectedList)) 
    {
      foreach ($allSelectedList as $cabid)
      {
        $dist_name = $this->utilclass->getDistrictNameOnLanding($cabid);
        if($editCabId != '' || $editCabId != null)
        {
          $updateCab = [
            'cab_id'     => $editCabId.'__1',
            'updated_at' => $curr_date,
            'status'     => EDITED_CAB_ID,
          ];
          $this->db->where('cab_id', $editCabId);
          $this->db->where('dist_code', $cabid);
          $this->db->update('cab_id_list', $updateCab);
          if($this->db->affected_rows() <= 0){
            log_message('error', '#NCERR155: Updation failed '.$this->db->last_query());
            echo json_encode(array(
              'responseType' => 1,
              'message'      => '#NCERR155: Something went wrong on updating CAB ID',
            ));
            return;
          }
        }

        $insCab = [
          'cab_id'        => $editCabId !=null ? $editCabId : $generate_cab,
          'cab_memo_name' => $cab_memo_name,
          'reference_no'  => $cab_ref_no,
          'remarks'       => $cab_remarks,
          'dist_code'     => $cabid,
          'dist_name'     => $dist_name,
          'user_code'     => $user_code,
          'status'        => GENERATED_CAB_ID,
          'created_at'    => $curr_date,
          'updated_at'    => $curr_date,
          'offline'       => null,
          'nc'            => 'Y'
        ];
        $insertData = $this->db->insert('cab_id_list', $insCab);
        if($insertData != 1 || $insertData != true){
          log_message('error', '#NCERR178: Insertion failed '.$this->db->last_query());
          echo json_encode(array(
            'responseType' => 1,
            'message'      => '#NCERR178: Something went wrong on creating CAB ID',
          ));
          return;
        }        
      }
      echo json_encode(array(
        'responseType' => 2,
        'message'      => 'CAB ID successfully generated for NC Settlement',
      ));
      return;
    }
    else 
    {
      echo json_encode(array(
        'responseType' => 1,
        'message'      => '#NCEERR167: No District selected',
      ));
      return;
    }      
  }

  public function getNewlyGeneratedCabListNC() 
  {    
    $json          = null;
    $user_code     = $this->dept_user_code;
    $draw          = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start         = intval($this->input->post('start'));
    $length        = intval($this->input->post('length'));
    $order         = $this->input->post('order');
    $status        = $this->input->post('status');

    // $list_of_generated_cab_memo = $this->CabModel->getCabIdListFromMaster($status);
    // log_message('error', '#950: '.json_encode($list_of_generated_cab_memo));
    // $total_records = $list_of_generated_cab_memo->num_rows();

    $list_of_generated_cab_memo = $this->CabModel->getCabIdListFromMasterNC($start, $length, $order,$status);

    if(!empty($list_of_generated_cab_memo)) {

      if($list_of_generated_cab_memo['total_records'] > 0)
      {
        $data_rows = $list_of_generated_cab_memo['data_results'];

        foreach($data_rows as $row) {

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

          $created_at = date('d/m/Y',strtotime($row->created_at));

          $button = '<button type="button" class="btn btn-sm btn-danger" onclick="viewCaseDetail('."'".$row->cab_id."'".')"><i class="fa fa-eye"></i> &nbsp;View to Modify</button>';
          
          $json[] = array(
            '<strong class="text-primary">' .$row->cab_id .'</strong>',
            $sql->cab_memo_name,
            '<small class="text-success">' . $row->remarks .'</small>',
            '<small class="text-danger">' . $sql->dist_name .'</small>',
            $created_at,
            $button,
          );
        }
      }
      else {
        $json = "";
      }
      $total_records = $list_of_generated_cab_memo['total_records'];
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


  public function getCabIdByUserDistrictNC() {
    $json = null;
    $user_code = $this->dept_user_code;
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');
    $status = ADD_CASES_UNDER_CAB_ID;

    $memo_list = $this->CabModel->getCabIdListFromMasterNC($start, $length, $order,$status);
    // log_message('error', '#204: '.json_encode($memo_list));
    // $total_records = $memo_list->num_rows();

    if(!empty($memo_list)) {

      if($memo_list['total_records'] > 0){

        $data_rows = $memo_list['data_results'];

        foreach($data_rows as $row) {

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

          $created_at = date('d-m-Y',strtotime($row->created_at));

          $link = base_url() . "index.php/CabController/getListOfCasesByCabIdOffline?cab_id=".$row->cab_id;
          $view_case = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-edit'></i> &nbsp;Manage Cases</a>";

          $generate_memo = '<button type="button" class="btn btn-sm btn-success" onclick="openModalMemo('."'".$row->cab_id."'".')"><i class="fa fa-file"></i> &nbsp;Generate Memo</button>';

          $link2 = base_url() . "index.php/OfflineSettlement/downloadReportForCabMemo?cab_id=".$row->cab_id;
          $generate_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp;Report</a>";

          $button = $view_case.' '.$generate_memo.' '.$generate_report;

            // if(strtotime(HOLD_All_MB2_CASES_DATE) > strtotime(date('Y-m-d H:i:s')))
            // {
              $button = $view_case.' '.$generate_memo.' '.$generate_report;
            // }else
            // {
            //   $button = $view_case;
            // }


          
          $json[] = array(
            // $sql->cab_memo_name,
            '<span class="text-danger"> '. $sql->cab_memo_name .'</span>',
            '<span class="text-primary"> '. $row->cab_id .'</span>',
            '<small class="text-primary"> '. $sql->dist_name .'</small>',
            // $sql->dist_name,
            $created_at,
            $button,
          );
        }
      }
      else {
        $json = "";
      }      

      $total_records = $memo_list['total_records'];
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

  public function getCasesByCabIdNC() 
  {
    $_POST = json_decode(file_get_contents("php://input"), true);
    $cab_id = $this->input->post('cab_id');
    $status = $this->input->post('status');

    $result = $this->CabModel->getCasesByCabId($cab_id, $status);
    log_message('error', '#187: '.json_encode($result->result()));

    if($result->num_rows() == 0){
      log_message('error', '#191 : No Cases available for CAB ID '.$cab_id);
      echo json_encode(array(
        'responseType' => 1,
        'message'      => 'No detail found for CAB ID '.$cab_id,
      ));
      return;
    }

    $res = array();
    foreach($result->result() as $row){
      $res[] = "<tr>
        <td>".$row->case_no."</td>
        <td>".$this->utilclass->getDistrictNameOnLanding($row->dist_code)."</td>
      </tr>";
    }
    echo json_encode(array(
      'responseType' => 2,
      'result'       => $res,
    ));
    return;
  }


  public function toBeFinalizeSaveNC() 
  {
    $_POST = json_decode(file_get_contents("php://input"), true);
    $selectedList = $this->input->post('selectedList');
    $user_code = $this->dept_user_code;
    $curr_date = date('Y-m-d h:i:s');
    // log_message('error', '#269: '.json_encode($selectedList));

    $this->db->trans_begin();

    foreach($selectedList as $r){
      $query = $this->db->query("UPDATE cab_memo_list SET status=?, updated_at=? 
                  WHERE user_code=? AND status=? AND cab_id=?", 
                  array(1, $curr_date, $user_code, 0, $r));

      if($this->db->affected_rows() <= 0) {
        $this->db->trans_rollback();
        log_message('error', '#277 : Updation failed in cab_memo_list '.$this->db->last_query());
        echo json_encode(array(
          'responseType' => 1,
          'message'      => '#277 : Something went wrong. Kindly contact system administrator',
        ));
        return;
      }

      //update cab id master table
      $query = $this->db->query("UPDATE cab_id_list SET status=?, updated_at=? 
                  WHERE user_code=? AND status=? AND cab_id=?", 
                  array(1, $curr_date, $user_code, 0, $r));

      if($this->db->affected_rows() <= 0) {
        $this->db->trans_rollback();
        log_message('error', '#295 : Updation failed in cab_id_list '.$this->db->last_query());
        echo json_encode(array(
          'responseType' => 1,
          'message'      => '#295 : Something went wrong. Kindly contact system administrator',
        ));
        return;
      }
    }
    $this->db->trans_commit();
    echo json_encode(array(
      'responseType' => 2,
      'message'      => 'Successfully prepare for final process',
    ));
    return;
  }

  public function GenerateCabMemoNC()
  {
    $data = array();
    $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id_memo');

    $distMeeting = $this->db->query("select  dist_code,meeting_id from cab_memo_list WHERE cab_id=? AND status=? group by dist_code, meeting_id", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->result();

    $data['emb'] = base_url().'assets/emblem-dark.png';

    $data['cab_memo_date'] = $this->input->post('cab_memo_date');
    $data['rev_cab_ref_no'] = $this->input->post('rev_cab_ref_no');
    $data['idc'] = $this->input->post('idc');
    $data['total_prop'] = 0;
    $res = $this->db->query("select count(*) as total from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->row();
    $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->row();

    $dist_name = $this->db->query("select distinct dist_code  from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->result();

    $distNames = array_map(function ($item) {
                  return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
              }, $dist_name);

    $commaSeparatedDistName = implode(",", $distNames);

    if (!empty($res) && $res != null && $res != "") {
      $data['total_prop'] = $res->total;
      $data['dist_count'] = $dist_count->total_dist;
      $data['dist_name'] = $commaSeparatedDistName;
      $data['total_individual_text'] = $this->utilclass->numberToWords($res->total);
    }

    $errCheck = 0;

    foreach($distMeeting as $dist)
    {

        $memoCase = $this->NcSettlementModel->getCasesCountFromCabMemo($dist->dist_code,$dist->meeting_id);

        $memoCaseCount = $memoCase->num_rows();

        
        $this->db2 =  $this->dbswitch2($dist->dist_code);


        $meetingCase = $this->NcSettlementModel->getCasesCountByDistMeeting($this->db2,$dist->meeting_id);

        $pullRequestCase = $this->NcSettlementModel->getCasesHavingPullRequest($this->db2,$dist->meeting_id);

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

            $casesWithPullRequest = '<strong class="text-success">'.$allPullRequestCases. '</strong>';  

            $meetingName = '<strong class="text-danger bg-yellow">'.$this->utilclass->getMeetingNameByMeetingId($dist->dist_code, $dist->meeting_id) . '</strong>';

            $this->session->set_flashdata('message', 'Can not Generate Memo for : ' . $cab_id_memo .' as Cases Having Modification Request Under meeting ' . $meetingName . '<br># List of  Cases With Pull Requset Under Meeting : <br>' . $casesWithPullRequest . '<br>(Revert These Cases To DC before Generate Memo)');
            $this->load->view('errorMessage');

        }else{

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

            $casesPending = '<span class="text-primary">'.$allPendingCases. '</span>';  
            $meetingName = '<strong class="text-danger bg-yellow">'.$this->utilclass->getMeetingNameByMeetingId($dist->dist_code, $dist->meeting_id) . '</strong>';
          
            $this->session->set_flashdata('message', 'Can not Generate Memo for : ' . $cab_id_memo .' as Cases Pending for meeting ' . $meetingName . '<br># List of Pending Cases Under Meeting : <br>' . $casesPending);
            $this->load->view('errorMessage');  

        }

        }


    }

      if($errCheck == 0)
      {
              $this->load->view('cabinet', $data);  

      }

  }

  public function SavePDFMemoNC()
  {
    // $_POST = json_decode(file_get_contents("php://input"), true);
    $html1       = $this->input->post('html1');
    $html2       = $this->input->post('html2');
    $html3       = $this->input->post('html3');
    $html4       = $this->input->post('html4');
    $cab_id_memo  = $this->input->post('meeting_id');
    $memoName = "CAB";
    $meetingId = str_replace("/", "_", $cab_id_memo);
    $html = "";
    // $emb = base_url().'application/views/images/emblem-dark.png';
    // $dist_name   = $this->UtilsModel->getEngDistrictNameByDistCode($dist_code);
    // $distEngName = substr($dist_name->locname_eng, 0, 3);

    //generation of canbinetmemo file name============
    $html .= '<style>
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
                      </style>';


    $fileName    = $memoName . '_DEPT_' . date("Y") . '_' . $meetingId;

    include 'vendor/mpdf/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $waterMark = 'Cabinet Memo' . $meetingId;
    $mpdf->SetWatermarkText($waterMark);
    $mpdf->showWatermarkText = true;
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont = true;
    $mpdf->writeHTML($html . $html1 . $html2 . $html3 . $html4);

    $mpdf->Output(CABMEMO_UPLOAD_DIR . $fileName . '.pdf', 'F');
    $b64Doc = chunk_split(base64_encode(file_get_contents(CABMEMO_UPLOAD_DIR . $fileName . '.pdf')));
    $upload_path = CABMEMO_UPLOAD_DIR . $fileName . '.pdf';




    $html11       =  $this->input->post('html11');
    // $html2       = $this->input->post('html21');
    $html31       = $this->input->post('html31');
    // $html4       = $this->input->post('html41');

    require_once 'htmltoword/vendor/autoload.php';
    // Creating the new document...
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $phpWord->setDefaultFontName('Cambria');
    // $phpWord->setDefaultParagraphStyle(
    //   array(
    //   //'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT,
    //   'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0),
    //   'spacing' => 90,
    //   'lineHeight' => 2.5,
    //   'line-spacing' =>2.5
    //   )
    // );
    // use PhpOffice\PhpWord\Shared\Html;
        $section = $phpWord->addSection();
    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html11 ,false, false);
        $section = $phpWord->addSection();
    \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html31 ,false, false);
    //     $section = $phpWord->addSection();
    // \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html3 ,false, false);
    //     $section = $phpWord->addSection();
    // \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html4 ,false, false);



    // $section = $phpWord->addSection();

    // $report = view('reports.audit-report', $data)->render();

    // $doc = new DOMDocument();
    // $doc->loadHTML($html1);
    // $doc->saveHTML();
    // \PhpOffice\PhpWord\Shared\Html::addHtml($section, $doc->saveHtml(),true);



    // $section = \PhpOffice\PhpWord\Shared\Html::addHtml($section, $ht);
    \PhpOffice\PhpWord\Settings::setCompatibility(false);
    PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    ob_clean();
    $objWriter->save(CABMEMO_UPLOAD_DOCS_DIR .$fileName.'.docx');
    $upload_path_doc = CABMEMO_UPLOAD_DOCS_DIR . $fileName . '.docx';


    $curr_date = date('Y-m-d h:i:s');
    $user_code = $this->dept_user_code;


    //Modification Request check

    $distMeeting = $this->db->query("select  dist_code,meeting_id from cab_memo_list WHERE cab_id=? AND status=? group by dist_code, meeting_id", array($cab_id_memo, 0))->result();

    $errCheck = 0;

      foreach($distMeeting as $dist)
      {

        $this->db2 =  $this->dbswitch2($dist->dist_code);

        $pullRequestCase = $this->NcSettlementModel->getCasesHavingPullRequest($this->db2,$dist->meeting_id);

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
                'message' => "Can not Generate Memo for :   $cab_id_memo  as Cases Having Modification Request Under meeting  $meetingName  : ( $allPullRequestCases ) (Revert These Cases To DC before Generating Cab Memo)"
              ));

        }
        

      }

    //Modification Request check end

      if($errCheck == 0)
        {
              $this->db->trans_begin();
              $query2 = $this->db->query(
                "UPDATE cab_id_list SET upload_memo_path = ?,upload_memo_doc_path = ?, status=?, updated_at=?, finalized_at=?
                                        WHERE user_code=? AND status=? AND cab_id=?",
                array($upload_path,$upload_path_doc, CAB_MEMO_DOC_GENERATED, $curr_date,$curr_date, $user_code, ADD_CASES_UNDER_CAB_ID, $cab_id_memo)
              );

              if ($this->db->affected_rows() <= 0) {
                $this->db->trans_rollback();
                log_message("error", "#ERROR1234 : Memo Generation Failed...Table cab_id_list" . $this->db->last_query());
                echo json_encode(array(
                  'responseType' => 3,
                  'message' => "#ERROR1234 : Memo Generation Failed..."
                ));
                return;
              }

              $query = $this->db->query(
                "UPDATE cab_memo_list SET status=?, final_status = ?, updated_at=? 
                                        WHERE user_code=? AND status=? AND cab_id=?",
                array(CAB_MEMO_DOC_GENERATED, PREPARE_FOR_FINAL_APPROVAL, $curr_date, $user_code, ADD_CASES_TO_CAB_MEMO, $cab_id_memo)
              );

              if ($this->db->affected_rows() <= 0) {
                $this->db->trans_rollback();
                log_message("error", "#ERROR123 : Memo Generation Failed...Table cab_id_list" . $this->db->last_query());
                echo json_encode(array(
                  'responseType' => 3,
                  'message' => "#ERROR123 : Memo Generation Failed..."
                ));
                return;
              }
              $this->db->trans_commit();
              echo json_encode(array(
                'responseType' => 2,
                'meetingId'    => $meetingId,
                'message' => "Successfully generated cabinet memo for the Cab Memo No :" . $meetingId
              ));

        }

  }

  public function getCabIdByUserDistrictFinalApprovalNC() {
    $json = null;
    $user_code = $this->dept_user_code;
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');
    $status = 2;

    $memo_list = $this->CabModel->getCabIdListFromMasterNC($start, $length, $order,$status);
    // log_message('error', '#204: '.json_encode($memo_list));
    // $total_records = $memo_list->num_rows();



    if(!empty($memo_list)) {

      if($memo_list['total_records'] >  0){

        $data_rows = $memo_list['data_results'];
      

        foreach($data_rows as $row) {


          $notification_generate_status = $row->notification_generated;
          $digital_sign_status = $row->notification_digital_sign_status;

          if($notification_generate_status == 1 && $digital_sign_status == 0)
            {
            $cab_status = "<small class='text-primary'> Notification Generated</small>";
            }
          else if($notification_generate_status == 1 && $digital_sign_status == 1)
            {
            $cab_status = "<strong class='text-success'> Digitally Signed</strong>";
            }
          else if($notification_generate_status == 0 && $digital_sign_status == 0)
            {
            $cab_status = "<small class='text-danger'> Notification Not Generated</small>";
            }

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name,notification_generated FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name,notification_generated", array($row->cab_id))->row();

          $link = base_url() . "index.php/CabController/viewGeneratedMemo?cab_id=".$row->cab_id;
          $view_memo = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-eye'></i> &nbsp;View Memo</a>";

         $linkDoc = base_url() . "index.php/CabController/viewGeneratedMemoDoc?cab_id=".$row->cab_id;
          $view_memo_doc = "<a href=".$linkDoc." class='btn btn-sm btn-secondary' target='_blank'><i class='fa fa-download'></i> &nbsp;Download Memo [DOC]</a>";


          $generate_notification = '<button type="button" class="btn btn-sm btn-success" onclick="openModalNotification('."'".$row->cab_id."'".')"><i class="fa fa-file"></i> &nbsp;Generate Notification</button>';

          
          $link1 = base_url() . "index.php/NcSettlement/casesListForFinalApprovalByDept?cab_id=".$row->cab_id;
          $view_case = "<a href=".$link1." class='btn btn-sm btn-success'><i class='fa fa-eye'></i> &nbsp;Process</a>";


          $link2 = base_url() . "index.php/NcSettlement/downloadReportForCabMemo?cab_id=".$row->cab_id;
          $download_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp;Generate Report</a>";

          $link3 = base_url() . "index.php/NcSettlement/downloadRevertedCaseListReport?cab_id=".$row->cab_id;
          $reverted_report = "<a href=".$link3." class='btn btn-sm btn-danger' ><i class='fa fa-download'></i> &nbsp;Reverted Report</a>";

          $link4 = base_url() . "index.php/CabController/downloadGeneratedNotification?cab_id=".$row->cab_id;
          $download_notification = "<a href=".$link4." class='btn btn-sm btn-success' ><i class='fa fa-download'></i> &nbsp;Download Notification</a>";


          $created_at = date('d-m-Y',strtotime($row->created_at));
          if($sql->notification_generated == 1)
          {
          $button = $view_case.' '.$download_notification.' '.$view_memo.' '. $view_memo_doc.' '.$download_report.' '.$reverted_report;
          }
          else 
          {
          $button = $generate_notification.' '.$view_memo.' '. $view_memo_doc.' '.$download_report.' '.$reverted_report;
          }
        
          $json[] = array(
            '<strong class="text-danger"> '. $sql->cab_memo_name .'</strong>',
            '<strong class="text-primary"> '. $row->cab_id .'</strong>',
            $cab_status,
            '<small class="text-primary"> '. $sql->dist_name .'</small>',
            $created_at,
            $button,
          );
        }
      }
      else {
        $json = "";
      }      
      
      $total_records = $memo_list['total_records'];

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

  public function finalCabApprovalSaveNC() 
  {
    $_POST = json_decode(file_get_contents("php://input"), true);
    $selectedList = $this->input->post('selectedList');
    $user_code = $this->dept_user_code;
    $curr_date = date('Y-m-d h:i:s');
    // log_message('error', '#392: '.json_encode($selectedList));

    $this->db->trans_begin();

    foreach($selectedList as $r){
      $query = $this->db->query("UPDATE cab_memo_list SET status=?, updated_at=? 
                  WHERE user_code=? AND status=? AND cab_id=?", 
                  array(2, $curr_date, $user_code, 1, $r));

      if($this->db->affected_rows() <= 0) {
        $this->db->trans_rollback();
        log_message('error', '#403 : Updation failed in cab_memo_list '.$this->db->last_query());
        echo json_encode(array(
          'responseType' => 1,
          'message'      => '#403 : Something went wrong. Kindly contact system administrator',
        ));
        return;
      }

      //update cab id master table
      $query = $this->db->query("UPDATE cab_id_list SET status=?, updated_at=? 
                  WHERE user_code=? AND status=? AND cab_id=?", 
                  array(2, $curr_date, $user_code, 1, $r));

      if($this->db->affected_rows() <= 0) {
        $this->db->trans_rollback();
        log_message('error', '#418 : Updation failed in cab_id_list '.$this->db->last_query());
        echo json_encode(array(
          'responseType' => 1,
          'message'      => '#418 : Something went wrong. Kindly contact system administrator',
        ));
        return;
      }
    }
    $this->db->trans_commit();
    echo json_encode(array(
      'responseType' => 2,
      'message'      => 'Final CAB successfully approved',
    ));
    return;
  }

  public function GenerateNotificationNC()
  {
    $data = array();
    $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id_memo');
      // $data['emb'] = base_url().'assets/emblem-dark.png';
      $data['e_file_no'] = $this->input->post('e_file_no');
      // $data['idc'] = $this->input->post('idc');

      $data['date_of_cabinet'] = $this->input->post('date_of_cabinet');
      $data['current_date'] = date("d-m-Y");
      $data['total_prop'] = 0;
      $data['user_code'] = $this->session->userdata('user_code');

      
      $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, 2))->row();

      $dist_name = $this->db->query("select distinct dist_code  from cab_memo_list WHERE cab_id=? AND status=? ORDER BY dist_code asc", array($cab_id_memo, 2))->result();

      $distNames = array_map(function ($item) {
                    return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                }, $dist_name);

      $caseCount = $this->db->query("select count(*) as total from cab_memo_list WHERE cab_id=?  GROUP BY dist_code ORDER BY dist_code asc", array($cab_id_memo))->result();

      $caseCountByDist = array_map(function ($item) {
                    return $item->total;
                }, $caseCount);

      $commaSeparatedCaseCount = implode(" & ", $caseCountByDist);
      $commaSeparatedDistName = implode(",", $distNames);
      $slashSeparatedDistName = implode("/", $distNames);

      if (!empty($caseCount) && $caseCount != null && $caseCount != "") {
        $data['total_prop'] = $commaSeparatedCaseCount;
        $data['dist_count'] = $dist_count->total_dist;
        $data['dist_name'] = $commaSeparatedDistName;
        $data['dist_name_slash'] = $slashSeparatedDistName;
      }

      $this->load->view('notification_nc_settlement', $data);  
  }

  public function SavePDFNotificationCopyNC()
  {
    // $_POST = json_decode(file_get_contents("php://input"), true);
    // $htmlHead       = $this->input->post('htmlHead');
    $html1       = $this->input->post('html1');
    $html2       = $this->input->post('html2');
    $html3       = $this->input->post('html3');
    $html4       = $this->input->post('html4');
    $html5       = $this->input->post('html5');
    $html6       = $this->input->post('html6');
    $html7       = $this->input->post('html7');
    $html8       = $this->input->post('html8');
    $html9       = $this->input->post('html9');
    $html10       = $this->input->post('html10');
    $html11       = $this->input->post('html11');
    $cab_id_memo  = $this->input->post('meeting_id');
    $date_of_cabinet = $this->input->post('date_of_cabinet');

    $notificationName = "NOTIFICATION";
    $memoId = str_replace("/", "_", $cab_id_memo);
    $html = "";
    $htmlbreak ="<br>";
    $html .= '<style>
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
                  
                      </style>';


    $fileName    = $notificationName . '_DEPT_' . date("Y") . '_' . $memoId;

    include 'vendor/mpdf/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $waterMark = 'Notification_' . $memoId;
    $mpdf->SetWatermarkText($waterMark);
    $mpdf->showWatermarkText = true;
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont = true;
    $mpdf->writeHTML($html . $html1 . $htmlbreak . $html2 . $htmlbreak  . $html3 . $htmlbreak . $html4 . $htmlbreak .  $html5 . $htmlbreak .  $html6 .$htmlbreak .  $html7 .$htmlbreak .  $html8 .$htmlbreak .  $html9 .$htmlbreak .  $html10 .$htmlbreak .  $html11 .$htmlbreak . $htmlbreak );

    $mpdf->Output(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf', 'F');
    $b64Doc = chunk_split(base64_encode(file_get_contents(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf')));
    $upload_notification_path = NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf';

    $curr_date = date('Y-m-d h:i:s');
    $user_code = $this->dept_user_code;

      $this->db->trans_begin();
      $query2 = $this->db->query(
        "UPDATE cab_id_list SET date_of_cabinet = ? , upload_notification_doc_path = ?, notification_generated=?, updated_at=?
                                WHERE user_code=? AND status=? AND cab_id=?",
        array($date_of_cabinet,$upload_notification_path,1, $curr_date, $user_code, 2, $cab_id_memo)
      );

      $uploadNotificationStatus = $this->db->affected_rows();

      if ($uploadNotificationStatus <= 0) {
        $this->db->trans_rollback();
        log_message("error", "#ERRORNG123 : Notification Generation Failed...Table cab_id_list" . $this->db->last_query());
        echo json_encode(array(
          'responseType' => 3,
          'message' => "#ERRORNG123 : Notification Generation Failed..."
        ));
        return;
      }
      else
      {
        $this->db->trans_commit();
        echo json_encode(array(
          'responseType' => 2,
          'meetingId'    => $memoId,
          'message' => "Successfully generated Notification Copy for the Cab Memo No :" . $memoId
        ));
      }
  }

  public function getFinalApprovedCabIdListNC() {
    $json = null;
    $user_code = $this->dept_user_code;
    $draw = intval($this->input->post('draw'));
    $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');
    $status = FINAL_SUBMISSION_CAB_MEMO;

    $memo_list = $this->CabModel->getCabIdListFromMasterNC($start, $length, $order,$status);
    // log_message('error', '#204: '.json_encode($memo_list));
    // $total_records = $memo_list->num_rows();


    if(!empty($memo_list)) {

      if($memo_list['total_records'] >  0){

        $data_rows = $memo_list['data_results'];

        foreach($data_rows as $row) {

          $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM cab_id_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

          $link = base_url() . "index.php/CabController/viewGeneratedMemo?cab_id=".$row->cab_id;
          $view_memo = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-eye'></i> &nbsp;View Memo</a>";

          
          $link3 = base_url() . "index.php/CabController/getListOfFinalApprovedCasesByCabId?cab_id=".$row->cab_id;
          $view_case = "<a href=".$link3." class='btn btn-sm btn-success'><i class='fa fa-eye'></i> &nbsp; Case List</a>";


          $link2 = base_url() . "index.php/Basundhara/downloadReportForCabMemo?cab_id=".$row->cab_id;
          $download_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp; Case Report</a>";


          $link4 = base_url() . "index.php/CabController/viewGeneratedNotification?cab_id=".$row->cab_id;
          $download_notification = "<a href=".$link4." class='btn btn-sm btn-danger' ><i class='fa fa-download'></i> &nbsp;Download Digitally Signed Notification</a>";

          $approved_at = date('d-m-Y',strtotime($row->approved_at));
          $notification_digital_signed_date = date('d-m-Y',strtotime($row->notification_digital_signed_date));

          $button = $view_case.' '.$download_report.' '.$download_notification;
          
          $json[] = array(
            '<strong class="text-danger"> '. $sql->cab_memo_name .'</strong>',
            '<strong class="text-primary"> '. $row->cab_id .'</strong>',
            '<small class="text-primary"> '. $sql->dist_name .'</small>',
            '<small class="text-primary"> '. $row->cab_id .'</small>',
          $notification_digital_signed_date,
          $approved_at,
            
            $button,
          );
        }
      }
      else {
        $json = "";
      }      
      
      $total_records = $memo_list['total_records'];

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

  public function GenerateNotificationForSignNc()
  {
    $data = array();
    $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id');
      // $data['emb'] = base_url().'assets/emblem-dark.png';
      $data['e_file_no'] = 'EBEG';
      // $data['idc'] = $this->input->post('idc');
      $date_of_cabinet = $this->db->query("select date_of_cabinet from cab_id_list WHERE cab_id=?", array($cab_id_memo))->row()->date_of_cabinet;
      $data['date_of_cabinet'] = $date_of_cabinet;
      $data['current_date'] = date("d-m-Y");
      $data['total_prop'] = 0;
      $data['user_code'] = $this->session->userdata('user_code');
      
      $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from cab_memo_list WHERE cab_id=? AND status=?", array($cab_id_memo, 2))->row();

      $dist_name = $this->db->query("select distinct dist_code  from cab_memo_list WHERE cab_id=? AND status=? ORDER BY dist_code asc", array($cab_id_memo, 2))->result();

      $distNames = array_map(function ($item) {
                    return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                }, $dist_name);

      $caseCount = $this->db->query("select count(*) as total from cab_memo_list WHERE cab_id=? AND status=? and  final_submit_status =? GROUP BY dist_code ORDER BY dist_code asc", array($cab_id_memo, 2,0))->result();

      $caseCountByDist = array_map(function ($item) {
                    return $item->total;
                }, $caseCount);

      $commaSeparatedCaseCount = implode(" & ", $caseCountByDist);
      $commaSeparatedDistName = implode(",", $distNames);
      $slashSeparatedDistName = implode("/", $distNames);

      if (!empty($caseCount) && $caseCount != null && $caseCount != "") {
        $data['total_prop'] = $commaSeparatedCaseCount;
        $data['dist_count'] = $dist_count->total_dist;
        $data['dist_name'] = $commaSeparatedDistName;
        $data['dist_name_slash'] = $slashSeparatedDistName;
      }

      $this->load->view('notification_for_sign_nc', $data);  
  }

  public function SavePDFNotificationCopySignNc()
  {
    // $_POST = json_decode(file_get_contents("php://input"), true);
    // $htmlHead       = $this->input->post('htmlHead');
    $html1       = $this->input->post('html1');
    $html2       = $this->input->post('html2');
    $html3       = $this->input->post('html3');
    $html4       = $this->input->post('html4');
    $html5       = $this->input->post('html5');
    $html6       = $this->input->post('html6');
    $html7       = $this->input->post('html7');
    $html8       = $this->input->post('html8');
    $html9       = $this->input->post('html9');
    $html10       = $this->input->post('html10');
    $html11       = $this->input->post('html11');
    $html12       = $this->input->post('html12');
    $cab_id_memo  = $this->input->post('meeting_id');

    $notificationName = "NOTIFICATION";
    $memoId = str_replace("/", "_", $cab_id_memo);
    $html = "";
    $htmlbreak ="<br>";
    $html .= '<style>
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
                  
                      </style>';


    $fileName    = $notificationName . '_DEPT_' . date("Y") . '_' . $memoId;

    include 'vendor/mpdf/vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $waterMark = 'Notification_' . $memoId;
    $mpdf->SetWatermarkText($waterMark);
    $mpdf->showWatermarkText = true;
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont = true;
    $mpdf->writeHTML($html . $html1 . $htmlbreak . $html2 . $htmlbreak  . $html3 . $htmlbreak . $html4 . $htmlbreak .  $html5 . $htmlbreak .  $html6 .$htmlbreak .  $html7 .$htmlbreak .  $html8 .$htmlbreak .  $html9 .$htmlbreak .  $html10 .$htmlbreak .  $html11 .  $html12 . $htmlbreak . $htmlbreak );

    $mpdf->Output(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf', 'F');

    $b64Doc = chunk_split(base64_encode(file_get_contents(NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf')));
    echo json_encode(array(
              'responseType' => 2,
              'base64EncodeData' => $b64Doc
      ));
    return;


    // $upload_notification_path = NOTIFICATION_UPLOAD_DIR . $fileName . '.pdf';

    // $curr_date = date('Y-m-d h:i:s');
    // $user_code = $this->dept_user_code;

    //   $this->db->trans_begin();
    //   $query2 = $this->db->query(
    //     "UPDATE cab_id_list SET upload_notification_doc_path = ?, notification_generated=?, updated_at=?
    //                             WHERE user_code=? AND status=? AND cab_id=?",
    //     array($upload_notification_path,1, $curr_date, $user_code, 2, $cab_id_memo)
    //   );

    //   $uploadNotificationStatus = $this->db->affected_rows();

    //   if ($uploadNotificationStatus <= 0) {
    //     $this->db->trans_rollback();
    //     log_message("error", "#ERRORNG123 : Notification Generation Failed...Table cab_id_list" . $this->db->last_query());
    //     echo json_encode(array(
    //       'responseType' => 3,
    //       'message' => "#ERRORNG123 : Notification Generation Failed..."
    //     ));
    //     return;
    //   }
    //   else
    //   {
    //     $this->db->trans_commit();
    //     echo json_encode(array(
    //       'responseType' => 2,
    //       'meetingId'    => $memoId,
    //       'message' => "Successfully generated Notification Copy for the Cab Memo No :" . $memoId
    //     ));
    //   }
  }
}
