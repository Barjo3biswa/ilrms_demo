<?php
class DeptMb3Cabinet extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->model('mb3Cabinet/DeptMb3CabinetModel');
        $this->load->model('basundhara/Basundharamodel');
        $this->load->model('mb3Cabinet/DeptRevertModel');
        
        $this->db2 = NULL;
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

    public function manageMb3Cabinet()
    {
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
        $data['_view'] = 'mb3Cabinet/manage_cabinet_list';
        $this->load->view('layouts/main', $data);
    }

    public function getSequence()
    {
        $sequence = $this->db->query("select nextval('mb3_cabinet_list_id_seq') as count")->row();
        return $sequence->count;
    }

    public function generateMb3Cabinet()
    {

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
        $cab_remarks     = $this->input->post('cab_remarks');
        $editCabId       = $this->input->post('editCabId');    
        $service         = $this->input->post('service');    
        $user_code       = $this->session->userdata('user_code');
        $service_name    = null;
        $ins_cat         = 0;

        if($service == '45')
        {
            $ins_cat = $this->input->post('ins_cat');
            if($ins_cat == 0)
            {
                log_message('error', '#ERR148: No Juridical Category selected !!!');
                echo json_encode(array(
                    'responseType' => 1,
                    'message'      => '#ERR148: No Juridical Category selected !!!',
                    ));
                return;
            }
        }

        if(trim($service) == '44'){
            $service_name ='Conversion';
        }elseif(trim($service) == '43'){
            $service_name ='Tea Grant';
        }elseif(trim($service) == '40'){
            $service_name ='Reclassification';
        }elseif(trim($service) == '42'){
            $service_name ='Occupancy Tenant';
        }elseif(trim($service) == '45'){
            $service_name ='Non Individual Juridical Entities';
        }else{
            $service_name =null;
        }
        $generate_cab    = 'CAB/'.MB3CABINETCODE.'/'.date('Y').'/'.date('Y').$this->getSequence();

        if(!empty($allSelectedList)) {
            foreach ($allSelectedList as $cabid)
            {

                $dist_name = $this->utilclass->getDistrictNameOnLanding($cabid);

                if($editCabId != '' || $editCabId != null){
                $updateCab = [
                    'cab_id'        => $editCabId.'__1',
                    'updated_at'    => $curr_date,
                    'status'        => EDITED_CAB_ID,
                    'service_code'  => $service,
                    'service_name'  => $service_name,
                ];
                $this->db->where('cab_id', $editCabId);
                $this->db->where('dist_code', $cabid);
                $this->db->update('mb3_cabinet_list', $updateCab);
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
                'remarks'       => $cab_remarks,
                'dist_code'     => $cabid,
                'dist_name'     => $dist_name,
                'user_code'     => $user_code,
                'status'        => GENERATED_CAB_ID,
                'created_at'    => $curr_date,
                'updated_at'    => $curr_date,
                'service_code'  => $service,
                'service_name'  => $service_name,
                'ins_cat'       => $service == 45 ? $ins_cat : 0,                
            ];
            $insertData = $this->db->insert('mb3_cabinet_list', $insCab);
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
            'message'      => 'Cabinet ID successfully generated',
        ));
        return;
        }else {
            echo json_encode(array(
                'responseType' => 1,
                'message'      => '#ERR167: No District selected',
            ));
            return;
        }      
    }

    public function getCabMemos() 
    {

        $user_code = $this->session->userdata('user_code');
        $dist_code = $this->input->post('district_id');
        $service_code = $this->input->post('service_code');

        if (!$user_code || !$dist_code) {
            echo json_encode(['message' => 'User code or district ID missing.']);
            return;
        }
        $cabIdListTeaGrant = $this->DeptMb3CabinetModel->getAllMb3CabList($dist_code,$user_code,$service_code);
        // echo $this->db->last_query(); die;

        if (empty($cabIdListTeaGrant)) {
        $response = array('message' => 'No cab memos available. Please Create Cab Memo before adding Cases');
        } else {
            $response = $cabIdListTeaGrant;
        }
        echo json_encode($response);
    }

    public function getAllMb3CabinetList() 
    {    
        $json          = null;
        $user_code = $this->session->userdata('user_code');
        $draw          = intval($this->input->post('draw'));
        $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
        $start         = intval($this->input->post('start'));
        $length        = intval($this->input->post('length'));
        $order         = $this->input->post('order');
        $status        = $this->input->post('status');


        $conversionCabinetDetails = $this->DeptMb3CabinetModel->getMb3CabinetList($start, $length, $order,$status,$user_code);

        if(!empty($conversionCabinetDetails)) {

        if($conversionCabinetDetails['total_records'] > 0)
        {
            $data_rows = $conversionCabinetDetails['data_results'];

            foreach($data_rows as $row) {

            $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM mb3_cabinet_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();
            
            $cab_memo_name = $sql->cab_memo_name;

            $service_name = null;
            $service_select = $this->db->query("select service_code from mb3_cabinet_list WHERE cab_id=?",array($row->cab_id))->row()->service_code;
            if($service_select == '44'){
                $service_name ='Conversion';
            }elseif($service_select == '43'){
                $service_name ='Tea Grant';
            }elseif($service_select == '40'){
                $service_name ='Reclassification';
            }elseif($service_select == '42'){
                $service_name ='Occupancy tenant';
            }elseif($service_select == '45'){
                $cat_name = $this->db->query("SELECT abbr FROM ins_master_category WHERE id=?", array($row->ins_cat))->row()->abbr;
                $service_name ='Non Individual Juridical Entities<br>('.$cat_name.')';
            }else{
                $service_name =null;
            }
            $created_at = date('d/m/Y',strtotime($row->created_at));

            $button = '<button type="button" class="btn btn-sm btn-danger" onclick="viewCaseDetail('."'".$row->cab_id."'".')"><i class="fa fa-edit"></i> &nbsp;Modify</button>';

            $delete_button = '<button type="button" class="btn btn-sm btn-danger" onclick="deleteCabMemoMb3('."'".$row->cab_id."'".')"><i class="fa fa-trash"></i> &nbsp;Delete</button>';
            
            $json[] = array(
                $cab_memo_name,
                $service_name,
                '<small class="text-success">' . $row->cab_id .'</small>',
                '<small class="text-danger">' . $sql->dist_name .'</small>',
                $created_at,
                $delete_button
            );
            }
        }
        else {
            $json = "";
        }
        $total_records = $conversionCabinetDetails['total_records'];
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

    public function createCabId() 
    {

        $_POST = json_decode(file_get_contents("php://input"), true);

        if (($this->designation == DEPARTMENT_USERCODE || $this->designation == DPT_JS) && $this->input->post('option') == null ){
            $data['user_assigned_dist'] = $this->CabModel->getDeptUserDistList()->result();
            $data['_view'] = 'cab/createCabId';
            $this->load->view('layouts/main', $data);
        }
        else if (($this->designation == DEPARTMENT_USERCODE || $this->designation == DPT_JS) && $this->input->post('option') == 'edit') {      
            
            $cab_id = $this->input->post('cab_id');

            $sql = $this->db->query("SELECT cab_id, cab_memo_name, reference_no, remarks 
                    FROM mb3_cabinet_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name, reference_no, remarks", 
                        array($cab_id))->row();
            $getSelectedDist = $this->db->query("SELECT dist_code FROM mb3_cabinet_list WHERE cab_id=?",
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

    public function deleteMb3Cabinet() 
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        $cab_id_delete = $this->input->post('cab_id_delete');
        $curr_date       = date('Y-m-d h:i:s');
        $user_code = $this->session->userdata('user_code');

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
            $this->db->where('user_code', $user_code);
            $this->db->where('finalized_at', NULL);
            $this->db->where('approved_at', NULL);
            $this->db->where('dept_order_no', NULL);
            $this->db->where('upload_memo_path', NULL);
            $this->db->where('upload_memo_doc_path', NULL);
            $this->db->where('upload_notification_doc_path', NULL);
            $this->db->update('mb3_cabinet_list', $updateCab);
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

    public function addMb3CasesToCabMemo()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        // var_dump($_POST);
        // exit;
        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('cabinet_id', 'Cabinet ID', 'required');

        

        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Please Select Cabinet to add Cases',
            ));
        } else 
        {
            $dist_code     = $this->input->post('district_id');
            $cabmemo_id     = $this->input->post('cabinet_id');
            $allSelectedList = $this->input->post('selectedList');
            $user_code = $this->session->userdata('user_code');

            $district_name = $this->utilclass->getDistrictNameOnLanding($dist_code);

            if ($cabmemo_id == NULL) {
                echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'CAB ID Not Found for ' .$district_name. ' District Please Create CAB ID before Adding Cases to Cabinet Memo',

                ));
            } 
            else 
            {
                if (!empty($allSelectedList)) 
                    {
                        $dharDB = $this->dbswitch2($dist_code);
                        foreach ($allSelectedList as $caseN) 
                        {

                            $ins_id2 = $this->db->query("select ins_cat, service_code from mb3_cabinet_list where cab_id = ?",array($cabmemo_id))->row();
                            $service_code = $ins_id2->service_code;
                            $case_no =$caseN;
                            if($service_code == '45'){
                                $ins_id = $dharDB->query("select ins_cat_type_co from settlement_institution_details where case_no = ?",array($case_no))->row()->ins_cat_type_co;
                                // $ins_id2 = $this->db->query("select ins_cat, service_code from mb3_cabinet_list where cab_id = ?",array($cabmemo_id))->row();
                                $test = 'settlement_institution_details: '.$ins_id.', mb3_cabinet_list: '.$ins_id2->ins_cat;
    
                                if($ins_id != $ins_id2->ins_cat){
                                    log_message('error', "#MISMATCH_INS_ID: Please select correct CAB memo : $test");
                                    echo json_encode(array(
                                        'responseType' => 1,
                                        'message' => '#ERR495: The cabinet ID you selected does not match the one associated with the selected case(s)',
                                    ));
                                    return false;
                                }
                            }
                            
                            
                            
                            $table='settlement_basic';
                            if($service_code == '40'){
                            $table= 'reclass_suite_basic';
                            }else if($service_code == '44'){
                                $table= 'petition_basic';
                            }
                            // var_dump($table);
                            // die;

                            $checkForAsstVerify = $dharDB->query("SELECT * FROM $table WHERE (ast_verification IS NULL OR ast_verification!=?) 
                                                        AND case_no=?", array('A', $caseN))->num_rows();

                            if($checkForAsstVerify == 1){
                                log_message('error', "#ERR490: Asst verification pending : ". $dharDB->last_query());
                                echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => '#ERR490: Add to cabinet is not possible because the assistant verification for a few selected case(s) is still pending',

                                ));
                                return false;
                            }


                            
                            
                            $service = $this->DeptMb3CabinetModel->getserviceFromCaseNo($case_no);
                            $this->db->trans_begin();

                            $memo_name = $this->DeptMb3CabinetModel->getMemoNameByCabId($this->db,$cabmemo_id);

                            //Insert in CAB Memo  List
                            $insCabStack = [
                                'cab_id'        => $cabmemo_id,
                                'case_no'       => $case_no,
                                'user_code'     => $user_code,
                                'dist_code'     => $dist_code,
                                'status'        => ADD_CASES_TO_CAB_MEMO,
                                'created_at'    => date('Y-m-d h:i:s'),
                                'final_submit_status' => '0',
                            ];

                            $insertCabList = $this->db->insert('mb3_case_list', $insCabStack);

                            if ($insertCabList != TRUE) {
                                $this->db->trans_rollback();
                                log_message('error', '#ERRDUPDATECSL001: Updation failed in mb3_case_list');
                                log_message('error', $this->db->last_query());

                                echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => '#ERR491: Case(s) has already been added to Cabinet Memo',

                                ));
                                return false;
                            } 
                            else {

                                $updateData = array(
                                    'status' => ADD_CASES_UNDER_CAB_ID,
                                    'finalized_at' => date('Y-m-d H:i:s'),
                                );

                                $where = array(
                                    'cab_id' => $cabmemo_id,
                                    'user_code' => $user_code,
                                );

                                $updateCabIdList = $this->DeptMb3CabinetModel->updateMb3CabStatus($this->db,$where, $updateData);
                                // echo $this->db->last_query(); die;

                                if ($updateCabIdList <= 0) {
                                    $this->db->trans_rollback();
                                    log_message('error', '#ERRDUPDATE0001: Updation failed in mb3_cabinet_list for bulk Approve');
                                    log_message('error', $this->db->last_query());

                                    echo json_encode(array(
                                        'responseType' => 1,
                                        'message' => '#ERR515: Failed to Add Cases to Cabinet Memo',

                                    ));
                                    return false;
                                } else {
                                    

                                    //change status in Settlement basic
                                    $this->db2 =  $this->dbswitch2($dist_code);

                                    $this->db2->trans_begin();

                                    $updateData = array(
                                        'add_cases_to_memo' => 'Y',
                                    );
                                    if($service == 'TGPP'){
                                        $updatePetBasicStatus = $this->DeptMb3CabinetModel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData);
                                    }elseif($service == 'CONV'){
                                        $updatePetBasicStatus = $this->DeptMb3CabinetModel->updatePetitionBasicForCab($this->db2,$case_no, $dist_code, $updateData);
                                    }elseif($service == 'SOTU'){
                                        $updatePetBasicStatus = $this->DeptMb3CabinetModel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData);
                                    }elseif($service == 'SLIJ'){
                                        $updatePetBasicStatus = $this->DeptMb3CabinetModel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData);

                                    }elseif($service == 'RECL'){
                                        $updatePetBasicStatus = $this->DeptMb3CabinetModel->updateReclassSuiteBasicForCab($this->db2,$case_no, $dist_code, $updateData);

                                    }else{
                                        echo json_encode(array(
                                            'responseType' => 1,
                                            'message' => 'SERVICE_NOT_DEFINED: Failed to Add Cases to Cabinet Memo',
    
                                        ));  
                                    }   

                                    $table = $service == 'RECL' ? 'reclass_suite_basic' : 'settlement_basic';

                                    if($updatePetBasicStatus <= 0){
                                        $this->db2->trans_rollback();
                                        log_message('error', "#ERRDUPDATBASICCAB: Updation failed in $table for change cabinet status");
                                        log_message('error', $this->db2->last_query());

                                        echo json_encode(array(
                                            'responseType' => 1,
                                            'message' => 'ERRDUPDATBASICCAB: Failed to Add Cases to Cabinet Memo',

                                        ));
                                        return false;

                                    }else{

                                    $this->db2->trans_commit();
                                    $this->db->trans_commit();

                                    }

                                    //change sttatus in basic
                                }
                            }
                        }

                        echo json_encode(array(
                            'responseType' => 2,
                            'message' => 'Cases Successfully Added to Cabinet Memo ' .$memo_name .'('. $cabmemo_id . ') for District ' . $district_name,

                        ));
                    }
            }
        }
    }

    public function toBeFinalizeMb3Cabinet() 
    {
        $unique_user_id = $this->session->userdata('unique_user_id');
        $designation = $this->session->userdata('designation');

        // var_dump($designation); die;

        if (($designation == DEPARTMENT_USERCODE) || ($unique_user_id == CONVERSION_USER) || ($designation == DPT_JS)) {
            $data['_view'] = 'mb3Cabinet/to_be_finalize_mb3_cabinet';
            $this->load->view('layouts/main', $data);
        } else {
            echo "User Not Authorized to View this Page";
        }
    }

    public function getTobeFinalizeMb3Cabinet() 
    {
        $json = null;
        $user_code = $this->session->userdata('user_code');
        $draw = intval($this->input->post('draw'));
        $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');
        $status = ADD_CASES_UNDER_CAB_ID;

        $memo_list = $this->DeptMb3CabinetModel->getMb3CabinetList($start, $length, $order,$status,$user_code);

        if(!empty($memo_list)) {

        if($memo_list['total_records'] > 0){

            $data_rows = $memo_list['data_results'];

            foreach($data_rows as $row) {

            $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM mb3_cabinet_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();
            
            $service_name = null;
            $service_select = $this->db->query("select service_code from mb3_cabinet_list WHERE cab_id=?",array($row->cab_id))->row()->service_code;
            if($service_select == '44'){
                $service_name ='Conversion';
            }elseif($service_select == '43'){
                $service_name ='Tea Grant';
            }elseif($service_select == '40'){
                $service_name ='Reclassification';
            }elseif($service_select == '42'){
                $service_name ='Occupancy Tenant';
            }elseif($service_select == '45'){
                $service_name ='Non Individual Juridical Entities';
            }else{
                $service_name =null;
            }
            
            $created_at = date('d-m-Y',strtotime($row->created_at));

            $link = base_url() . "index.php/DeptMb3Cabinet/getListOfMb3CasesByCabId?cab_id=".$row->cab_id;
            $view_case = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-edit'></i> &nbsp;Manage Cases</a>";
            
            $generate_memo = '<button type="button" class="btn btn-sm btn-success" onclick="openModalMemo('."'".$row->cab_id."'".')"><i class="fa fa-file"></i> &nbsp;Generate Memo</button>';

            $link2 = base_url() . "index.php/DeptConversion/downloadConversionCaseReport?cab_id=".$row->cab_id;
            $generate_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp;Case Report</a>";

            $button = $generate_memo.' '.$view_case;

            
            $json[] = array(
                '<span class="text-danger"> '. $sql->cab_memo_name .'</span>',
                '<span class="text-success"> '. $service_name .'</span>',
                '<span class="text-primary"> '. $row->cab_id .'</span>',
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

    public function GenerateCabMemoMb3()
    {
        $data = array();
        $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id_memo');

        $cab_data = $this->db->query("select cab_id,service_code, ins_cat from mb3_cabinet_list where cab_id=?",array($cab_id_memo))->row();
        $service_code = $cab_data->service_code;
        // $service_code = $cab_data->service_code;

        $distMeeting = $this->db->query("select  dist_code from mb3_case_list WHERE cab_id=? AND status=? group by dist_code", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->result();

        $data['emb'] = base_url().'assets/emblem-dark.png';

        $data['cab_memo_date'] = $this->input->post('cab_memo_date');
        $data['rev_cab_ref_no'] = $this->input->post('rev_cab_ref_no');
        $data['idc'] = $this->input->post('idc');
        $data['total_prop'] = 0;

        //to do
        $data['reverted_back'] =0;
        $data['recomended_from_dpt'] =0;
        $data['amount_rs'] = 0;

        $res = $this->db->query("select count(*) as total from mb3_case_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->row();
        $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from mb3_case_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->row();

        $dist_name = $this->db->query("select distinct dist_code  from mb3_case_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->result();

        $distNames = array_map(function ($item) {
                        return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                    }, $dist_name);
        $data['dist_wise_data'] = $this->db->query("select count(*) as total,dist_name from mb3_cabinet_list WHERE status='1' group by dist_name")->result();
        $commaSeparatedDistName = implode(",", $distNames);

        if (!empty($res) && $res != null && $res != "") {
            $data['total_prop'] = $res->total;
            $data['dist_count'] = $dist_count->total_dist;
            $data['dist_name'] = $commaSeparatedDistName;
            $data['total_individual_text'] = $this->utilclass->numberToWords($res->total);
            $data['total_reverted_text'] = $this->utilclass->numberToWords($data['reverted_back']);
            
        }

        $errCheck = 0;


        if($errCheck == 0)
        {
            if($service_code == '43'){
                $this->load->view('mb3Cabinet/mb3_memo_document_tea_grant', $data); 
            }elseif($service_code == '44'){
                $this->load->view('mb3Cabinet/mb3_memo_document_conversion', $data);  
            }elseif($service_code == '42'){
                $this->load->view('mb3Cabinet/mb3_memo_document_tenant', $data);  
            }elseif($service_code == '45'){ // non juridical

                if($cab_data->ins_cat == 8)
                {
                    $this->load->view('mb3Cabinet/mb3_memo_document_juridical_state_govt', $data);
                }
                else if($cab_data->ins_cat == 9)
                {
                    $this->load->view('mb3Cabinet/mb3_memo_document_juridical_state_govt_undertaking', $data);
                }
                else if($cab_data->ins_cat == 10)
                {
                    $this->load->view('mb3Cabinet/mb3_memo_document_juridical_central', $data);
                }
                else if($cab_data->ins_cat == 11)
                {
                    $this->load->view('mb3Cabinet/mb3_memo_document_juridical_central', $data);
                }
                else if($cab_data->ins_cat == 12)
                {
                    $this->load->view('mb3Cabinet/mb3_memo_document_juridical_non_govt', $data);
                }
            }elseif($service_code == '40'){ // reclassification
                $this->load->view('mb3Cabinet/mb3_memo_document_reclass_suite', $data);  
            }else{
                echo "Service not Found";
                exit;
            }
            
        }

    }

    public function SavePDFMemoMb3()
    {
        $html1       = $this->input->post('html1');
        $html2       = $this->input->post('html2');
        $html3       = $this->input->post('html3');
        $html4       = $this->input->post('html4');
        $html11      = $this->input->post('html11');
        $html31      = $this->input->post('html31');
        $htmlSign      = $this->input->post('htmlSign');
        $cab_id_memo = $this->input->post('meeting_id');
        $cabMemoId   = str_replace("/", "_", $cab_id_memo);

        $html = "";

        $html .= '
                    <style>
                        .reza-card {
                            background: #fff;
                            border-radius: 2px;
                            display: inline-block;
                            margin: 1rem;
                            position: relative;
                            width: 100%;
                            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                            transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
                        }
                        .reza-title {
                            font-weight: bold;
                            font-size: 18px;
                            padding: 20px;
                            color: #37474F;
                        }
                        .reza-body {
                            padding: 0 20px 40px 20px;
                        }
                        .badge {
                            padding: 10px;
                            font-size: 15px;
                        }
                        .rezaButt {
                            color: #FFF;
                            display: inline-block;
                            position: relative;
                            cursor: pointer;
                            height: 35px;
                            line-height: 37px;
                            padding: 0 0.8rem;
                            font-weight: 600;
                            font-family: "Roboto", sans-serif;
                            text-align: center;
                            text-decoration: none;
                            text-transform: uppercase;
                            vertical-align: middle;
                            white-space: nowrap;
                            outline: none;
                            border: none;
                            user-select: none;
                            border-radius: 2px;
                            transition: all 0.3s ease-out;
                            margin-bottom: 5px;
                            margin-left: 3px;
                        }
                        .rezaButt:hover {
                            color: #0c0c0c;
                        }
                        .rezaInfo {
                            background-color: #FFC107;
                        }
                        .rezaPrim {
                            background-color: #9C27B0;
                        }
                        .rezaDag {
                            background-color: #4CAF50;
                        }
                        .rezaText {
                            font-size: 16px;
                        }
                        .checkBoxD {
                            width: 20px;
                            height: 20px;
                        }
                        .reza-m {
                            margin: 5px;
                        }
                        .divCard {
                            background: #fff;
                            border-radius: 2px;
                            display: inline-block;
                            position: relative;
                            width: 100%;
                        }
                        .mrigankaCenter {
                            text-align: center !important;
                        }
                        .mrigankaRight {
                            text-align: right !important;
                            margin-top: 40px;
                        }
                        .rezaText2 {
                            font-size: 14px !important;
                            margin: 20px !important;
                            text-align: center;
                        }
                    </style>';

        $fileName    = 'MB3_MEMO_' . $cabMemoId;

        // Include MPDF
        include 'vendor/mpdf/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();
        $waterMark = 'MB3.0 Cab Memo';
        $mpdf->SetWatermarkText($waterMark);
        $mpdf->showWatermarkText = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->writeHTML($html1 . $html2 . $html3 . $html4. $htmlSign);

        $pdfPath = CABMEMO_UPLOAD_DIR . $fileName . '.pdf';
        $mpdf->Output($pdfPath, 'F');

        if (!file_exists($pdfPath)) {
            echo json_encode([
                'responseType' => 3,
                'message' => "PDF generation failed."
            ]);
            return;
        }

        $b64Doc = chunk_split(base64_encode(file_get_contents($pdfPath)));
        $upload_path = $pdfPath;

        // Include PHPWord
        require_once 'htmltoword/vendor/autoload.php';
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontName('Cambria');

        $section = $phpWord->addSection();
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html11, false, false);
        $section = $phpWord->addSection();
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html31, false, false);

        \PhpOffice\PhpWord\Settings::setCompatibility(false);
        \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $docPath = CABMEMO_UPLOAD_DOCS_DIR . $fileName . '.docx';
        ob_clean();
        $objWriter->save($docPath);

        if (!file_exists($docPath)) {
            echo json_encode([
                'responseType' => 3,
                'message' => "Word document generation failed."
            ]);
            return;
        }

        $upload_path_doc = $docPath;

        $curr_date = date('Y-m-d h:i:s');
        $user_code = $this->session->userdata('user_code');

            $this->db->trans_begin();

            $sql1 = "UPDATE mb3_cabinet_list SET upload_memo_path = ?, upload_memo_doc_path = ?, status = ?, updated_at = ?, finalized_at = ? WHERE user_code = ? AND status = ? AND cab_id = ?";

            $params1 = [
                $upload_path, 
                $upload_path_doc, 
                CAB_MEMO_DOC_GENERATED, 
                $curr_date, 
                $curr_date, 
                $user_code, 
                ADD_CASES_UNDER_CAB_ID, 
                $cab_id_memo
            ];

            $query1 = $this->db->query($sql1, $params1);

            if ($this->db->affected_rows() <= 0) {
                $this->db->trans_rollback();
                log_message("error", "#ERROR_MEMO_GEN1 : Memo Generation Failed...Table mb3_cabinet_list " . $this->db->last_query());
                echo json_encode([
                    'responseType' => 3,
                    'message' => "#ERROR_MEMO_GEN1 : Memo Generation Failed..."
                ]);
                return;
            }

            $sql2 = "UPDATE mb3_case_list SET status = ?, final_status = ?, updated_at = ? WHERE user_code = ? AND status = ? AND cab_id = ?";

            $params2 = [
                CAB_MEMO_DOC_GENERATED, 
                PREPARE_FOR_FINAL_APPROVAL, 
                $curr_date, 
                $user_code, 
                ADD_CASES_TO_CAB_MEMO, 
                $cab_id_memo
            ];

            $query2 = $this->db->query($sql2, $params2);

            if ($this->db->affected_rows() <= 0) {
                $this->db->trans_rollback();
                log_message("error", "#ERROR_MEMO_GEN2 : Memo Generation Failed...Table mb3_case_list " . $this->db->last_query());
                echo json_encode([
                    'responseType' => 3,
                    'message' => "#ERROR_MEMO_GEN2 : Memo Generation Failed..."
                ]);
                return;
            }

            $this->db->trans_commit();

            echo json_encode([
                'responseType' => 2,
                'meetingId' => $cabMemoId,
                'message' => "Successfully generated cabinet memo for the Cab Memo & Sent  for Approval :" . $cabMemoId
            ]);
    }

    public function getListOfMb3CasesByCabId()
    {
        
        $json = null;
        $user_code = $this->session->userdata('user_code');
        $cab_id = $this->input->get('cab_id');
        

        $this->db = $this->load->database('db2', TRUE);

        $memo_name = $this->DeptMb3CabinetModel->getMemoNameByCabId($this->db,$cab_id);
        
        $meeting_id = $this->db->query("SELECT DISTINCT dist_code FROM mb3_case_list WHERE cab_id=?  group by dist_code", 
                array($cab_id))->result();
        $data['meetingList'] = $meeting_id;
        $data['cab_id'] = $cab_id;
        $data['memo_name'] = $memo_name;
        $data['_view'] = 'mb3Cabinet/all_mb3_cases_under_cabinet';
        $this->load->view('layouts/main', $data);
    }

    public function getAllCasesUnderCabId() 
    {
        $json = null;
        $user_code = $this->session->userdata('user_code');
        $cab_id = $this->input->post('CabId');
        $dist_code = $this->input->post('selectDistrict');
        $draw = intval($this->input->post('draw'));
        $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $this->db = $this->load->database('db2', TRUE);


        $cases_list = $this->DeptMb3CabinetModel->getAllCasesbyCabId($this->db,$start, $length, $order,$cab_id,$dist_code);


        if(!empty($cases_list)) {

        if($cases_list['total_records'] > 0){

            $data_rows = $cases_list['data_results'];

            foreach($data_rows as $row) {

                $case_no = "<small class='case-no-bg'><i class='fa fa-archive'></i>" . $row->case_no . "</small>";

                $district = "<small class='text-black'>" . $this->utilclass->getDistrictNameOnLanding($row->dist_code) ."</small>";

                $created_at = date('d-M-Y',strtotime($row->created_at));

                $url = base_url('DeptTeaGrant/teaGrantCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);

                $url_conv = base_url('DeptConversionNew/conversionCaseDetails');
                $url_conv .= '?dist_code=' . urlencode($row->dist_code);
                $url_conv .= '&case_no=' . urlencode($row->case_no);
                $dhar_db = $this->dbswitch2($row->dist_code);

                $cab_data = $this->db->query("select cab_id,service_code from mb3_cabinet_list where cab_id=?",array($cab_id))->row();
                $service_code = $cab_data->service_code;
                //service code 43 is for tea grant
                if($service_code == '43'){
                    $button = "<a href='".$url."' class='rezaButt buttInfo'  target='_viewCaseDetails'><i class='fa fa-eye'></i> &nbsp;Case Details</a>";
                }elseif($service_code == '44'){
                    $button = "<a href='".$url_conv."' class='rezaButt buttInfo'  target='_viewCaseDetails'><i class='fa fa-eye'></i> &nbsp;Case Details</a>";
                }else if($service_code == '45'){ // juridical

                    $url = base_url('DeptJuridical/juridicalCaseDetails');
                    $url .= '?dist_code=' . urlencode($row->dist_code);
                    $url .= '&case_no=' . urlencode($row->case_no);
                    $button = "<a href='".$url."' class='rezaButt buttInfo'  target='_viewCaseDetails'><i class='fa fa-eye'></i> &nbsp;Case Details</a>";
                }
                else if($service_code == '40'){ // reclassification suite

                    $url = base_url('DeptReclassSuite/reclassSuiteCaseDetails');
                    $url .= '?dist_code=' . urlencode($row->dist_code);
                    $url .= '&case_no=' . urlencode($row->case_no);
                    $button = "<a href='".$url."' class='rezaButt buttInfo'  target='_viewCaseDetails'><i class='fa fa-eye'></i> &nbsp;Case Details</a>";
                }

                else{
                    $button = "<a href='".$url_1."' class='btn btn-success'  target='_viewCaseDetails'><i class='fa fa-eye'></i> &nbsp;Case Details</a>";
                }
               

            
            $json[] = array(
                $row->case_no,
                $case_no ,
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

    public function finalizedMb3Cabinet() 
    {
        $unique_user_id = $this->session->userdata('unique_user_id');
        $designation = $this->session->userdata('designation');

        if (($designation == DEPARTMENT_USERCODE) || ($unique_user_id == CONVERSION_USER)) {         
        $data['_view'] = 'mb3Cabinet/finalized_mb3_cabinet';
        $this->load->view('layouts/main', $data);
        } else {
        echo "User Not Authorized to View this Page";
        }
    }

    public function getFinalizedMb3Cabinet() 
    {
        $json = null;
        $user_code = $this->session->userdata('user_code');
        $designation = $this->session->userdata('designation');
        $draw = intval($this->input->post('draw'));
        $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');
        $unique_user_id = $this->session->userdata('unique_user_id');

        $memo_list = $this->DeptMb3CabinetModel->getPendingMb3CabinetList($start, $length, $order,$user_code);

        if(!empty($memo_list)) {

        if($memo_list['total_records'] > 0){

            $data_rows = $memo_list['data_results'];

            foreach($data_rows as $row) {

            $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM mb3_cabinet_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

            $created_at = date('d-M-Y',strtotime($row->created_at));

            $link = base_url() . "index.php/DeptConversion/getListOfConversionCasesByCabId?cab_id=".$row->cab_id;
            $view_case = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-edit'></i> &nbsp;Manage Cases</a>";

            $finalApproveBtnJs = '<button type="button" class="btn btn-sm btn-success" value='.$row->cab_id.' id="finalApproveCabinetJS"><i class="fa fa-file"></i> &nbsp;Final Approve</button>';

            $approveBtnPs = '<button type="button" class="btn btn-sm btn-success" value='.$row->cab_id.' id="approveCabinetPS"><i class="fa fa-file"></i> &nbsp;Approve</button>';

            $link2 = base_url() . "index.php/DeptConversion/viewConversionMemo?cab_id=".$row->cab_id;
            $view_memo = "<a href=".$link2." class='btn btn-sm btn-primary' target='_viewmemo'><i class='fa fa-eye'></i> &nbsp;View Memo</a>";

            if($unique_user_id == CONVERSION_USER)
            {
                if($row->status == 2)
                {
                    $status = '<small class="text-danger">Send to PS</small>';
                    $button = $view_case;
                }
                elseif($row->status == 3)
                {
                    $status = '<small class="text-success">Approved By PS</small>';
                    $button = $view_memo . '  '.$finalApproveBtnJs;
                }
                elseif($row->status == 5)
                {
                    $status = '<small class="text-success">Final Approved</small>';
                    $button = $view_memo ;
                }
            }
            elseif($designation == DPT_PS)
            {
                if($row->status == 2)
                {
                    $status = '<small class="text-danger">Pending</small>';
                    $button = $view_memo . '  '.$approveBtnPs;
                }
                elseif($row->status == 3)
                {
                    $status = '<small class="text-success">Approved</small>';
                    $button = $view_case ;
                }
                elseif($row->status == 5)
                {
                    $status = '<small class="text-success">Final Approved</small>';
                    $button = $view_memo ;
                }
            }


            
            $json[] = array(
                '<strong class="text"> '. $sql->cab_memo_name .'</strong>',
                '<small class="text-primary"> '. $row->cab_id .'</small>',
                '<small class="text-primary"> '. $sql->dist_name .'</small>',
                '<small class="text"> '. $created_at .'</small>',
                $status,
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

    public function finalApproveCabId() 
    {
        if ($this->session->userdata('designation') == DEPARTMENT_USERCODE || $this->session->userdata('designation') == DPT_JS) {     
          // $data['user_assigned_dist'] = $this->CabModel->getDeptUserDistList()->result(); 
          $data['_view'] = 'mb3Cabinet/finalApprovalCabId';
          $this->load->view('layouts/main', $data);
        } else {
          echo "User Not Authorized to View this Page";
        }
    }

    public function getCabIdByUserDistrictFinalApproval() 
    {
        $json = null;
        //$user_code = $this->dept_user_code;
        $user_code = $this->session->userdata('user_code');
        $draw = intval($this->input->post('draw'));
        $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');
        $status = 2;
    
        $memo_list = $this->DeptMb3CabinetModel->getCabIdListFromMaster($start, $length, $order,$status);
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
    
                $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name,notification_generated FROM mb3_cabinet_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name,notification_generated", array($row->cab_id))->row();
                
                $service_name = $this->db->query("select service_code,service_name from mb3_cabinet_list where cab_id=?",array($row->cab_id))->row()->service_name;
                $link = base_url() . "index.php/DeptMb3Cabinet/viewGeneratedMemo?cab_id=".$row->cab_id;
                $view_memo = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-eye'></i> &nbsp;View Memo</a>";
        
                $linkDoc = base_url() . "index.php/DeptMb3Cabinet/viewGeneratedMemoDoc?cab_id=".$row->cab_id;
                $view_memo_doc = "<a href=".$linkDoc." class='btn btn-sm btn-secondary' target='_blank'><i class='fa fa-download'></i> &nbsp;Download Memo [DOC]</a>";
        
        
                $generate_notification = '<button type="button" class="btn btn-sm btn-success" onclick="openModalNotification('."'".$row->cab_id."'".')"><i class="fa fa-file"></i> &nbsp;Generate Notification</button>';
        
                
                $link1 = base_url() . "index.php/DeptMb3Cabinet/casesListForFinalApprovalByDept?cab_id=".$row->cab_id;
                $view_case = "<a href=".$link1." class='btn btn-sm btn-success'><i class='fa fa-eye'></i> &nbsp;Process</a>";
        
        
                $link2 = base_url() . "index.php/DeptMb3Cabinet/downloadReportForCabMemo?cab_id=".$row->cab_id;
                $download_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp;Generate Report</a>";
        
                $link3 = base_url() . "index.php/Basundhara/downloadRevertedCaseListReport?cab_id=".$row->cab_id;
                $reverted_report = "<a href=".$link3." class='btn btn-sm btn-danger' ><i class='fa fa-download'></i> &nbsp;Reverted Report</a>";
    
                $link4 = base_url() . "index.php/DeptMb3Cabinet/downloadGeneratedNotification?cab_id=".$row->cab_id;
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
                }else{
                        $button = $view_memo;
                }
                $json[] = array(
                    '<strong class="text-danger"> '. $sql->cab_memo_name .'</strong>',
                    '<strong class="text-primary"> '. $row->cab_id .'</strong>',
                    $service_name,
                    $cab_status,
                    '<small class="text-primary"> '. $sql->dist_name .'</small>',
                    $created_at,
                    $button,
                );
            }
        }else {
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
        }else{
            $response = array();
            $response['sEcho']=0;
            $response['iTotalRecords']=0;
            $response['iTotalDisplayRecords']=0;
            $response['aaData']=[];
            echo json_encode($response);
        }
    }


    public function viewGeneratedMemo()
    {
        $cab_id = $this->input->get('cab_id');

        $path = $this->db->query("SELECT upload_memo_path FROM mb3_cabinet_list WHERE cab_id=? AND 
                status=?", array($cab_id, 2))->row()->upload_memo_path;
        $mainfile = file_get_contents($path);
        header("Content-type: application/pdf");
        echo $mainfile;
    }

    public function viewGeneratedMemoDoc()
    {
        $cab_id = $this->input->get('cab_id');

        $path = $this->db->query("SELECT upload_memo_doc_path FROM mb3_cabinet_list WHERE cab_id=? AND 
                    status=?", array($cab_id, 2))->row()->upload_memo_doc_path;
        $mainfile = file_get_contents($path);
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');  
        header("Content-Disposition: attachment; filename=\"{$cab_id}.docx\"");
        echo $mainfile;
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

        $dist_codes = $this->DeptMb3CabinetModel->getDistrictUnderCabMemo($this->db,$cab_memo_id)->result();

        $table2 = ''; // Initialize an empty string to store the table rows
        $count = 1;
        $main_array = array();   

        foreach ($dist_codes as $dist) {
            $allSelectedList = $this->DeptMb3CabinetModel->getCasesUnderCabMemo($this->db,$cab_memo_id, $dist)->result();
            $district = $dist->dist_code;
            // Switch DB based on dist_code
            $this->db2 = $this->dbswitch2($district);

            log_message('error', 'downloadReportForCabMemo: 11111 dist: '.$district);
            if (!empty($allSelectedList)) {
                foreach ($allSelectedList as $row) {
                    $case_no = $row->case_no;
                    
                    if (in_array($case_no, $main_array))
                       continue;

                    $settlement_basic = $this->DeptMb3CabinetModel->getSettlementBasic($case_no);

                    if ($settlement_basic == null)
                       continue;

                    $main_array[] = $case_no;

                    $applicants   = $this->DeptMb3CabinetModel->getAllApplicantBuyersName($case_no)->result();

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


                    $dags = $this->DeptMb3CabinetModel->getAllAppliedDags($case_no)->result();

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

                    $sdlacStatus = $this->DeptMb3CabinetModel->sdlacCaseStatus($case_no)->row();

                    $settlement_enc = $this->DeptMb3CabinetModel->getSettlementEncroacher($case_no);


                    $landless = $this->DeptMb3CabinetModel->getLandLessVerify($case_no)->row();

                    $geo_tag = $this->DeptMb3CabinetModel->getGeoTag($case_no);

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

    public function GenerateNotification()
    {
        $data = array();
        $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id_memo');
        // $data['emb'] = base_url().'assets/emblem-dark.png';
        $data['e_file_no'] = $this->input->post('e_file_no');
        // $data['idc'] = $this->input->post('idc');

        $cab_data = $this->db->query("select cab_id,service_code,ins_cat from mb3_cabinet_list where cab_id=?",array($cab_id_memo))->row();
        $service_code = $cab_data->service_code;

        $data['date_of_cabinet'] = $this->input->post('date_of_cabinet');
        $data['current_date'] = date("d-m-Y");
        $data['total_prop'] = 0;
        $data['user_code'] = $this->session->userdata('user_code');

        
        $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from mb3_case_list WHERE cab_id=? AND status=?", array($cab_id_memo, 2))->row();

        $dist_name = $this->db->query("select distinct dist_code  from mb3_case_list WHERE cab_id=? AND status=? ORDER BY dist_code asc", array($cab_id_memo, 2))->result();

        $distNames = array_map(function ($item) {
                        return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                    }, $dist_name);

        $caseCount = $this->db->query("select count(*) as total from mb3_case_list WHERE cab_id=?  GROUP BY dist_code ORDER BY dist_code asc", array($cab_id_memo))->result();

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

        if($service_code == '43'){
            $this->load->view('mb3Cabinet/notification_tea_grant', $data);  
        }elseif($service_code == '44'){
            $this->load->view('mb3Cabinet/notification_conversion', $data);  
        }elseif($service_code == '42'){
            $this->load->view('mb3Cabinet/notification_tenant', $data);  
        }elseif($service_code == '45'){ // non juridical
            $data['ins_cat_name']=$this->insMasterCategory($cab_data->ins_cat);
            $this->load->view('mb3Cabinet/notification_juridical', $data);  
        }elseif($service_code == '40'){ // reclassification
            $this->load->view('mb3Cabinet/notification_reclass_suite', $data);  
        }else{
            echo "Service not Found";
            exit;
        } 
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
        // $user_code = $this->dept_user_code;
        $user_code = $this->session->userdata('user_code');

        $this->db->trans_begin();
        $query2 = $this->db->query(
            "UPDATE mb3_cabinet_list SET date_of_cabinet = ? , upload_notification_doc_path = ?, notification_generated=?, updated_at=?
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

    public function downloadGeneratedNotification()
    {
        $cab_id = $this->input->get('cab_id');
        $path = $this->db->query("SELECT upload_notification_doc_path FROM mb3_cabinet_list WHERE cab_id=? AND 
                status=?", array($cab_id, 2))->row()->upload_notification_doc_path;
        $mainfile = file_get_contents($path);
        header("Content-type: application/pdf"); 
        header("Content-Disposition: attachment; filename=\"Notification_Copy_ {$cab_id}.pdf\"");
        echo $mainfile;
    }

    public function casesListForFinalApprovalByDept()
    {
        $cab_id = $this->input->get('cab_id');
        $user_code   = $this->session->userdata('user_code');
        $this->db = $this->load->database('db2', TRUE);
        $cases_list = $this->DeptMb3CabinetModel->getAllCasesFromMemoForFinalApproval($this->db,$cab_id,$user_code);
       
        $digitalSignedStatus = $this->DeptMb3CabinetModel->digitalSignedStatusOfCabId($this->db,$cab_id);
    
        $data['cab_id']         = $cab_id;
        $data['finalCases']     = $cases_list->result();
        $data['finalCaseCount'] = $cases_list->num_rows();
        $data['digitalSignedStatus'] = $digitalSignedStatus->notification_digital_sign_status;
        $data['_view'] = 'mb3Cabinet/case_list_for_final_approval';
        $this->load->view('layouts/main', $data);

    }

    public function GenerateNotificationForSign()
    {
        $data = array();
        $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id');
        // $data['emb'] = base_url().'assets/emblem-dark.png';
        $data['e_file_no'] = 'EBEG';
        // $data['idc'] = $this->input->post('idc');
        $cab_data = $this->db->query("select cab_id,service_code, ins_cat from mb3_cabinet_list where cab_id=?",array($cab_id_memo))->row();
        $service_code = $cab_data->service_code;
        $date_of_cabinet = $this->db->query("select date_of_cabinet from mb3_cabinet_list WHERE cab_id=?", array($cab_id_memo))->row()->date_of_cabinet;
        $data['date_of_cabinet'] = $date_of_cabinet;
        $data['current_date'] = date("d-m-Y");
        $data['total_prop'] = 0;
        $data['user_code'] = $this->session->userdata('user_code');
        
        $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from mb3_cabinet_list WHERE cab_id=? AND status=?", array($cab_id_memo, 2))->row();

        $dist_name = $this->db->query("select distinct dist_code  from mb3_cabinet_list WHERE cab_id=? AND status=? ORDER BY dist_code asc", array($cab_id_memo, 2))->result();

        $distNames = array_map(function ($item) {
                        return $this->utilclass->getDistrictNameOnLanding($item->dist_code);
                    }, $dist_name);

        $caseCount = $this->db->query("select count(*) as total from mb3_case_list WHERE cab_id=? AND status=? and  final_submit_status =? GROUP BY dist_code ORDER BY dist_code asc", array($cab_id_memo, 2,0))->result();

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
        // var_dump($service_code);
        // die;
        if($service_code == '43'){
            $this->load->view('mb3Cabinet/notification_for_sign_tea_grant', $data);  
        }elseif($service_code == '44'){
            $this->load->view('mb3Cabinet/notification_for_sign_conversion', $data);  
        }elseif($service_code == '42'){
            $this->load->view('mb3Cabinet/notification_for_sign_tenant', $data);  
        }elseif($service_code == '45'){
            $data['ins_cat_name']=$this->insMasterCategory($cab_data->ins_cat);
            $this->load->view('mb3Cabinet/notification_for_sign_juridical', $data);  
        }elseif($service_code == '40'){
            $data['ins_cat_name']=$this->insMasterCategory($cab_data->ins_cat);
            $this->load->view('mb3Cabinet/notification_for_sign_reclass', $data);  
        }else{
            echo "Service not Found";
            exit;
        } 
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
        $html10      = $this->input->post('html10');
        $html11      = $this->input->post('html11');
        $html12      = $this->input->post('html12');
        $cab_id_memo = $this->input->post('meeting_id');

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
                "UPDATE mb3_cabinet_list SET upload_notification_doc_path = ?, notification_digital_sign_status=?, notification_digital_signed_date=?, digital_sign_ip =?,digital_sign_user_code =?
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

    public function getTotalNoCasesForFinalApproval()
    {
        $this->db = $this->load->database('db2', TRUE);
        $cabId =  trim($_POST['caninet_id_selected']);
        $cases = $this->db->query("SELECT  case_no FROM mb3_case_list WHERE cab_id =? AND status =? AND final_status =? AND final_submit_status =?", array($cabId, 2,1,0))->num_rows();
        echo json_encode($cases);
    }

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
        }
        else
        {
            $cabinet_id = $this->input->post('cab_id_selected');
            $this->db = $this->load->database('db2', TRUE);
            $dist_codes = $this->DeptMb3CabinetModel->getDistrictUnderCabMemo($this->db,$cabinet_id)->result();

            $caseWithDist = $this->DeptMb3CabinetModel->getDistrictCasesUnderCabMemo($this->db,$cabinet_id)->result();

            foreach($caseWithDist as $caseDist)
            {
                $case_no = $caseDist->case_no;
                $service = $this->DeptMb3CabinetModel->getserviceFromCaseNo($case_no);
                // var_dump($service);exit;
                if($service == 'TGPP' || $service == 'SOTU' || $service == 'SLIJ'){
                    $applid[] = $this->utilclass->getApplidFromCaseNo($caseDist->dist_code,$caseDist->case_no);
                }elseif($service == 'CONV'  || $service == 'RECL'){
                    $applid[] = $this->utilclass->getApplidFromCaseNoBasundharApplications($caseDist->dist_code,$caseDist->case_no);
                }else{
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'Application No Could Not be verified.',
                    ));
                }
                

            }
            $concatenatedAppNo = implode(',', $applid);

            //Modification Request check
            $distMeeting = $this->db->query("select  dist_code,meeting_id from mb3_cabinet_list WHERE cab_id=? AND status=? group by dist_code, meeting_id", array($cabinet_id, CAB_MEMO_DOC_GENERATED))->result();
            $errCheck = 0;
            $meeting_id_available = array();
            foreach($distMeeting as $meet){
                if($meet->meeting_id != null){
                    array_push($meeting_id_available,$meet);
                }
            }
            foreach($meeting_id_available as $dist)
            {
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
                $this->db->trans_begin();
                $updateCabMemoData = [
                    'final_submit_status'   => FINAL_SUBMIT_BY_DEPT,
                    'updated_at'            => date('Y-m-d h:i:s'),
                    'approved_at'           => date('Y-m-d h:i:s'),   
                ];
                $whereMemo = [
                            'cab_id'    => $cabinet_id,
                            'user_code' => $user_code,
                        ];
                $updateCabMemoStatus = $this->DeptMb3CabinetModel->updateCabMemoList($updateCabMemoData, $whereMemo);
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
                    'status'            => FINAL_SUBMISSION_CAB_MEMO,
                    'updated_at'        => date('Y-m-d h:i:s'),
                    'approved_at'       => date('Y-m-d h:i:s')                        
                );
                $whereCabId = array(
                    'cab_id'    => $cabinet_id,
                    'user_code' => $user_code,
                );
                $updateCabIdStatus = $this->DeptMb3CabinetModel->updateCabStatus($this->db,$whereCabId, $updateCabIdData);
                if($updateCabIdStatus <= 0){
                    $this->db->trans_rollback();
                    echo json_encode(array(
                        'responseType'  => 1,
                        'message'       => '#ErrorApp02: Cases Not Approved ! Kindly Contact System Admin.',
                    ));
                    return false;
                }
                else
                {
                    $service_select = $this->db->query("select service_code from mb3_cabinet_list WHERE cab_id=?",array($cabinet_id))->row()->service_code;

                    $pending_officer =  MB_CIRCLE_OFFICER;

                    $rmk    = 'Approved & Forward to '.$pending_officer;
                    $status = MB_PAYMENT_REQUEST;
                    $task   = MB_DEPARTMENT;
                    $pen    = $pending_officer;
                    $rtps_status = $this->DeptMb3CabinetModel->applicationStatusUpdateBulk($concatenatedAppNo,'NA',$rmk,$status,$task,$pen);

                    log_message("error","****************************reached here");
                    if($rtps_status==null || $rtps_status!="y")
                    {
                        $this->db->trans_rollback();
                        log_message('error', '#ERRAPIAPPROVEDEPT: Issue in API Call for Bulk Approve By Dept ___ API Status: ' . $rtps_status);
                        echo json_encode(array(
                            'responseType' => 3,
                            'message'      => '#ERRAPIAPPROVEDEPT: Cases Not Approved ! Kindly Contact System Admin.  !!!',
                        ));
                        return false;
                    }else{
                        //update in Dharitree
                        foreach($dist_codes as $dist)
                        {
                            
                            $caseListForFinalSubmitByDist = $this->DeptMb3CabinetModel->getCaseListDetailsForFinalSubmit($this->db,$cabinet_id,$user_code,$dist->dist_code)->result();

                            if (!empty($caseListForFinalSubmitByDist)) 
                            {
                                $this->db2 = $this->dbswitch2($dist->dist_code);
                                // $this->db2->trans_begin();
                                $updateBasicData = array();
                                $updateProposalData = array();
                                $insPetProceed = array();
                                foreach ($caseListForFinalSubmitByDist as $row) 
                                {
                                    $case_no = $row->case_no;
                                    $service = $this->DeptMb3CabinetModel->getserviceFromCaseNo($case_no);
                                    if($service == 'TGPP' || $service == 'SOTU' || $service == 'SLIJ'){
                                        $basic_table_name = 'settlement_basic';
                                        $proceeding_table_name = 'settlement_proceeding';
                                    }elseif($service == 'CONV'){
                                        $basic_table_name = 'petition_basic';
                                        $proceeding_table_name = 'petition_proceeding';
                                    }elseif($service == 'RECL'){
                                        $basic_table_name = 'reclass_suite_basic';
                                        $proceeding_table_name = 'settlement_proceeding';
                                    }else{
                                        $this->db2->trans_rollback();
                                        $this->db->trans_rollback();
                                        echo json_encode(array(
                                                'responseType' => 1,
                                                'message' => 'Err17012025 Service Not Found.',
                                            ));
                                        return;
                                    }
                                    $final_status = $row->final_status;
                                    // Update in Settlement Basic
                                    if($final_status == TEMP_APPROVE_BY_DEPT)
                                    {
                                        $pending_officer = $service == 'SLIJ' ? MB_DEPUTY_COMM : MB_CIRCLE_OFFICER;
                                        $pending_office = $service == 'SLIJ' ? MB_DEPUTY_COMM : MB_CIRCLE_OFFICER;
                                        // $pending_officer = MB_CIRCLE_OFFICER;
                                        // $pending_office = MB_CIRCLE_OFFICER;

                                        if($service == 'CONV')
                                        {
                                            $updateBasicData[] = [
                                                'case_no'           => $case_no,
                                                'status'            => 'P',
                                                'dept_note_yn'      => 'Y',
                                                'co_user_code '     => 'DC',
                                                'new_status'        =>'DPDCA',
                                                'add_off_desig'     =>'DC',
                                            ];
                                        }elseif($service == 'RECL'){

                                            $updateBasicData[] = [
                                                'case_no'         => $case_no,
                                                'status'          => MB_PAYMENT_REQUEST,
                                                'pending_officer' => $pending_officer,
                                                'pending_office'  => $pending_office,
                                                'dept_code'       => $user_code,
                                                'user_code'       => $user_code,
                                                'dept_approval'   => DPT_APPROVED,
                                                'from_office'     => MB_DEPARTMENT,
                                                'dept_order_no'   => $cabinet_id,
                                                'dept_order_date' => date('Y-m-d')                        
                                            ];
                                        }
                                        else{

                                            $updateBasicData[] = [
                                                'case_no'         => $case_no,
                                                'status'          => MB_PAYMENT_REQUEST,
                                                'pending_officer' => $pending_officer,
                                                'pending_office'  => $pending_office,
                                                'dept_code'       => $user_code,
                                                'user_code'       => $user_code,
                                                'dept_approval'   => DPT_APPROVED,
                                                'from_office'     => MB_DEPARTMENT,
                                                'dept_order_no'   => $cabinet_id,
                                                'dept_order_date' => date('Y-m-d')                        
                                            ];
                                        }
                                        
                                        $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from $proceeding_table_name where case_no='$case_no' ")->row()->c;

                                        if ($proceeding_id == null) {
                                            $proceeding_id = 1;
                                        }
                                        
                                        if($service == 'CONV')
                                        {
                                            $pettion_basic_row = $this->db2->query("select * from petition_basic where case_no=?",array($case_no))->row();
                                            $insPetProceed[] = [
                                                'dist_code'             => $pettion_basic_row->dist_code,
                                                'subdiv_code'           => $pettion_basic_row->subdiv_code,
                                                'cir_code'              => $pettion_basic_row->cir_code,
                                                'case_no'               => $case_no,
                                                'proceeding_id'         => $proceeding_id,
                                                'date_of_hearing'       => date('Y-m-d h:i:s'),
                                                'next_date_of_hearing'  => date('Y-m-d h:i:s'),
                                                'status'                => MB_PENDING,
                                                'user_code'             => $this->session->userdata('user_code'),
                                                'date_entry'            => date('Y-m-d h:i:s'),
                                                'operation'             => 'E',
                                                'note_on_order'         =>  $rmk ,
                                                'ip'                    => $_SERVER['REMOTE_ADDR'],
                                                'office_from'           => MB_DEPARTMENT,
                                                'office_to'             => MB_DEPUTY_COMM,
                                                'task'                  => 'Forwarded To DC',
                                            ];
                                        }else{
                                            //Insert Array for Settlement Proceedings
                                            $insPetProceed[] = [
                                                'case_no'               => $case_no,
                                                'proceeding_id'         => $proceeding_id,
                                                'date_of_hearing'       => date('Y-m-d h:i:s'),
                                                'next_date_of_hearing'  => date('Y-m-d h:i:s'),
                                                'note_on_order'         => 'Approved by Department & send for Payment Generation',
                                                'user_code'             => $user_code,
                                                'date_entry'            => date('Y-m-d h:i:s'),
                                                'operation'             => 'E',
                                                'ip'                    => $_SERVER['REMOTE_ADDR'],
                                                'office_from'           => MB_DEPARTMENT,
                                                'office_to'             => $pending_office,
                                                'task'                  => 'Forwarded To CO',
                                                'status'                => MB_PAYMENT_REQUEST,
                                            ];
                                        }

                                    }
                                        
                                }   

                                $this->db2->trans_begin();
                                $updateBasicStatus = $this->db2->update_batch($basic_table_name,$updateBasicData,'case_no');
                                echo $this->db2->last_query();
                                die;
                                if($updateBasicStatus<=0 || $this->db2->affected_rows() <= 0)
                                {
                                    $this->db2->trans_rollback();
                                    $this->db->trans_rollback();
                                    echo json_encode(array(
                                            'responseType' => 1,
                                            'message' => 'ErrorAppSB: Cases Not Approved ! Kindly Contact System Admin.',
                                        ));
                                    return;
                                }
                                else
                                {
                                    $inserProceding = $this->db2->insert_batch($proceeding_table_name, $insPetProceed);
                                    if($inserProceding <= 0 || $this->db2->affected_rows() <= 0)
                                    {
                                        $this->db2->trans_rollback();
                                        $this->db->trans_rollback();
                                        echo json_encode(array(
                                                'responseType' => 1,
                                                'message' => 'ErrorAppSP: Cases Not Approved ! Kindly Contact System Admin.',
                                            ));
                                        return;
                                    }else{
                                        $this->db->trans_commit();
                                        log_message("error","******************TRANS COMMIT db");
                                        $this->db2->trans_commit();
                                        log_message("error","******************TRANS COMMIT db2");
                                        log_message('error',"#ST01--Updating Cab Id List For the district---END--cab-id--".$cabinet_id."---DIST_CODE--".$dist->dist_code);
                        
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

    protected function insMasterCategory($insId)
    {
        return $q = $this->db->query("SELECT * FROM ins_master_category WHERE id=?",array($insId))->row()->category_name;
    }


}
?>
