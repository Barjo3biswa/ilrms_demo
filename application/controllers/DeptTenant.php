<?php
class DeptTenant extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->model('Tenant/DeptTenantModel');
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

    public function tenantLanding()
    {
        $user_code = $this->session->userdata('user_code');
        $designation = $this->session->userdata('designation');
        $data = array();

        if($designation  == DPT_PS)
        {
            $data['_view'] = 'tenant/tenant_landing_ps';
        }
        elseif($designation  == DPT_SO)
        {
            $data['verificationType'] = SO_VERIFICATION;
            $data['_view'] = 'tenant/tenant_landing_so';
        }
        elseif($designation  == ASSISTANT_USERCODE)
        {
            $data['verificationType'] = ASO_VERIFICATION;
            $data['_view'] = 'tenant/tenant_landing_asst';
        }
        else
        {
            $data['verificationType'] = JS_VERIFICATION;
            $data['_view'] = 'tenant/tenant_landing_js';
        }
        $this->load->view('layouts/main', $data);
    }

    public function viewTenantCases()
    {
        $dist_code   = $this->input->post('dist_code');
        $data = array();
        $data['dist_code'] =$dist_code;
        $data['dist_name'] = $this->utilclass->getDistrictName($dist_code);
        $this->db2 =  $this->dbswitch2($dist_code);
        //$data['tenantCaseList'] = $this->DeptTenantModel->getTenantCaseList($this->db2,$dist_code);
        $data['status'] = true;
        $this->load->view('tenant/tenant_case_list',$data);
	}
    
    public function getPendingTenantCaseList() 
    {
        $json = null;
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');
        $dist_code = $this->input->post('dist_code');
        $searchByCol_0 = trim($this->input->post('search')['value']);
        $this->db2 =  $this->dbswitch2($dist_code);
        $case_list = $this->DeptTenantModel->getPendingCaseListDetails($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);

        if(!empty($case_list)) {

        if($case_list['total_records'] >  0){

            $data_rows = $case_list['data_results'];

            foreach($data_rows as $row) {

                $url = base_url('DeptTenant/tenantCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);

                $case_no = "<small class='bg-'><i class='fa fa-archive'></i> " . $row->case_no . "</small>";

                // $rtps_app_no = "<br><small class='text-danger text-center'> " . $this->utilclass->getRtpsNoFromCaseNo($dist_code, $row->case_no)  ."</small>" ;

                $button = "<a href='".$url."' class='btn btn-sm btn-primary' target='_viewCaseDetails'><i class='fa fa-eye'></i></a>";

                $circle = "<small class='text-danger'>Circle:- " . $this->utilclass->getCircleName($row->dist_code, $row->subdiv_code, $row->cir_code) . "</small>";
                $mouza = "<br><small class='text-danger'>Mouza:- " . $this->utilclass->getMouzaName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code) . "</small>";
                $village = "<br><small class='text-danger'>Vill:-  " . $this->utilclass->getVillageName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code) . "</small>";


                // $so_verification = $row->so_verification;
                $ast_verification = $row->ast_verification;
                // $sec_verification = $row->sec_verification;
                //$ps_verification = $row->ps_verification;

                // if($so_verification == NULL){
                //     $so_verification_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                // }
                // if($so_verification == 'S'){
                //     $so_verification_status = '<small>Sent to SO <i class="fa fa-forward"></i></small>';
                // }
                // if($so_verification == 'A'){
                //     $so_verification_status = '<small class="text-success">SO Verified <i class="fa fa-check-circle"></i></small>';

                // }
                // if($so_verification == 'R'){
                //     $so_verification_status = '<small class="text-danger">Revert by SO <i class="fa fa-spinner fa-spin"></i></small>';
                // }

                if($ast_verification == NULL){
                    $ast_verification_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                }
                if($ast_verification == 'S'){
                    $ast_verification_status = '<small>Sent to AST <i class="fa fa-forward"></i></small>';
                }
                if($ast_verification == 'A'){

                    $url = base_url('DeptTenant/viewAssistantVerificationDetails');
                    $url .= '?dist_code=' . urlencode($row->dist_code);
                    $url .= '&case_no=' . urlencode($row->case_no);

                    $ast_verification = '<small class="text-success">AST Verified</small></br>';
                    $viewBtn = "<a href='".$url."' class='btn btn-sm btn-success' target='_viewAstVerificationDetails'>view ASO Checklist Report</a>";
                    $ast_verification_status = $ast_verification . $viewBtn;
                }
                if($ast_verification == 'R'){
                    $url = base_url('DeptTenant/viewAssistantVerificationDetails');
                    $url .= '?dist_code=' . urlencode($row->dist_code);
                    $url .= '&case_no=' . urlencode($row->case_no);

                    $ast_verification = '<small class="text-danger">Reverted by AST </small></br>';
                    $viewBtn = "<a href='".$url."' class='btn btn-sm btn-danger' target='_viewAstVerificationDetails'>view ASO Checklist Report</a>";
                    $ast_verification_status = $ast_verification . $viewBtn;
                }

                // if($sec_verification == NULL){
                //     $sec_verification_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                // }
                // if($sec_verification == 'S'){
                //     $sec_verification_status = '<small>Sent to Secretary <i class="fa fa-forward"></i></small>';
                // }
                // if($sec_verification == 'A'){
                //     $sec_verification_status = '<small class="text-success">Secretary Verified <i class="fa fa-check-circle"></i></small>';
                // }
                // if($sec_verification == 'R'){
                //     $sec_verification_status = '<small class="text-danger">Revert by Secretary <i class="fa fa-spinner fa-spin"></i></small>';
                // }

                // if($ps_verification == NULL){
                //     $ps_verification_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                // }
                // if($ps_verification == 'S'){
                //     $ps_verification_status = '<small>Sent to PS <i class="fa fa-forward"></i></small>';
                // }
                // if($ps_verification == 'A'){
                //     $ps_verification_status = '<small class="text-success">PS Verified <i class="fa fa-check-circle"></i></small>';
                // }
                // if($ps_verification == 'R'){
                //     $ps_verification_status = '<small class="text-danger">Revert by PS <i class="fa fa-spinner fa-spin"></i></small>';
                // }

                $json[] = array(
                    $row->case_no,
                    $case_no,
                    $circle . $mouza . $village,
                    //$so_verification_status,
                    $ast_verification_status,
                    //$sec_verification_status,
                    //$ps_verification_status,
                    '<small class="text-default"><i class="fa fa-calendar"></i> '. date("d M, Y", strtotime($row->submission_date)) .' </small>',
                    $button
                );
            }
        }
        else {
            $json = "";
        }      
        
        $total_records = $case_list['total_records'];

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

    public function tenantCaseDetails()
    {
        $dist_code = $this->input->get('dist_code');
        $application_no = $this->input->get('case_no');
        $this->db2 =  $this->dbswitch2($dist_code);
        $basic = $this->DeptTenantModel->getSettlementBasic($this->db2,$application_no);
        $applicants_buyers = $this->DeptTenantModel->getAllApplicantBuyers($this->db2,$application_no);
        $applicants_owners = $this->DeptTenantModel->getAllApplicantOwners($this->db2,$application_no);
        $applicants_dag_details= $this->DeptTenantModel->getAllApplicantDagDetails($this->db2,$application_no);
        $adcdata           = [];
        $dags              = $this->DeptTenantModel->getSettlementDag($this->db2,$application_no);
        $lmnotes           = $this->DeptTenantModel->getSettlementTenantLmNote($this->db2,$application_no);
        $proceedings       = $this->DeptTenantModel->getSettlementProceeding($this->db2,$application_no);
        $dhardocuments     = $this->DeptTenantModel->getDocuments($this->db2,$application_no);
        $nominee           = $this->DeptTenantModel->getAllNomineeDetail($this->db2,$application_no);
        $existing_pattadar = $this->DeptTenantModel->getAllExistingPattadar($this->db2,$application_no);
        $deed_applicant    = $this->DeptTenantModel->getAllDeedPattadar($this->db2,$application_no);
        $family_tree       = $this->DeptTenantModel->getAllFamilyTree($this->db2,$application_no);
        // for guardian relation
        $query_for_guar_rel = "SELECT * from master_guard_rel WHERE id NOT IN ('5','6')";
        $relation_executation = $this->db2->query($query_for_guar_rel);
        // echo "<pre>";
        // var_dump($relation_executation->result());
        // exit;
        $row = $relation_executation->num_rows();
        if ($row != 0) {
            $data['guar_rel'] = $relation_executation->result();
        }
        $premium_data = $this->DeptTenantModel->getPremium($this->db2,$application_no);
        $data['premium_data']           = $premium_data;
        $data['premium']                = $premium_data;
        $data['encdata']                = $adcdata;
        $data['basic']                  = $basic;
        $data['applicants_buyers']      = $applicants_buyers;
        $data['applicants_owners']      = $applicants_owners;
        $data['applicants_dag_details'] = $applicants_dag_details;
        $data['dags']                   = $dags;
        $data['lmnotes']                = $lmnotes;
        $data['proceedings']            = $proceedings;
        $data['dhardocuments']          = $dhardocuments;
        $data['nominee']                = $nominee;
        $data['deleted_dags']           = $this->DeptTenantModel->getDeletedDags($this->db2,$application_no);
        $data['existing_pattadar']      = $existing_pattadar;
        $data['deed_applicant']         = $deed_applicant;
        $data['family_tree']            = $family_tree;
        $case_no = $application_no;
        $caseDetails = $this->DeptTenantModel->getSettlementApplicationDetailsByCaseNo($this->db2,$case_no,$dist_code);
        $proceedings = $this->DeptTenantModel->getSettlementProceeding($this->db2,$case_no);
        //$data['caseCount']   = $caseCount;
        $data['caseDetails'] = $caseDetails;
        $data['proceedings'] = $proceedings;
        $data['reservation'] = $this->DeptTenantModel->getSettlementReservation($this->db2,$application_no);
        $data['additional_property'] = $this->DeptTenantModel->getAdditionalProperty($this->db2,$application_no);
        $data['validation_bypass'] = 0;
        foreach($data['lmnotes'] as $lm_rr)
        {
          $decoded_r = json_decode($lm_rr->lm_rejected_remarks);
          if($decoded_r){
            foreach($decoded_r as  $lm_rejected_code)
            {
              if(isset($lm_rejected_code->reject_code))
              {
                if(in_array($lm_rejected_code->reject_code, $const_bypass_arr_code)){
                  $data['validation_bypass'] = 1;
                }
              }
              else
              {
                if(in_array($lm_rejected_code, $const_bypass_arr_code)){
                  $data['validation_bypass'] = 1;
                }
              }
            }
          }
        }
        $data['reject_list_type'] = '';
        foreach($lmnotes as $r_remark)
        {
          $rejected_list_json = json_decode($r_remark->lm_rejected_remarks);
          if($rejected_list_json)
          {
            foreach ($rejected_list_json as $re_list)
            {
              if(isset($re_list->reject_code))
              {
                $r_code = $re_list->reject_code;
              }
              else
              {
                $r_code = $re_list;
              }
              $sql = $this->db2->query("select remark_head from reject_master where reject_code = ?", array($r_code));
              if($sql->row()->remark_head != null)
              {
                $data['reject_list_type'] = 'new';
              }
              else
              {
                $data['reject_list_type'] = 'old';
              }
            }
          }
        }
        $data['_view'] = 'tenant/case_view';
        $this->load->view('layouts/main', $data);
    }

    public function getSelfDocApi(){
        $case_no = $this->input->post('case_no');
        $sql = "Select basundhara from basundhar_application where dharitree='$case_no' ";
        $basundhara = $this->db->query($sql)->row();
        $token = $this->utilityclass->createTokenJwt();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, API_LINK_MB3."getAppDetails");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'application_no' => $basundhara->basundhara,
            'api_key' => API_KEY,
            'token' => $token
        )));
        $output = curl_exec($curl_handle);
        if(isset(json_decode($output)->responseType)){
            if(json_decode($output)->responseType == 3){
                echo json_decode($output)->data." - Unauthorized access!";
                return false;
            }
        }
        curl_close($curl_handle);
        $output = json_decode($output);
        $lmdata['document']=$output->documents;
        $lmdata['query']=$output->query;
        $lmdata['property']=$output->property;
        $lmdata['aadhar']=$output->aadhar;
        $lmdata['nextKin']=$output->nextKin;
        // $selfDeclarationDetails=[];
        foreach($output->selfDeclaration as $selfDec){
            // $lmdata['selfDeclarationDetails']=json_decode($selfDec->dec_details);
            $selfDeclarationDetails=json_decode($selfDec->dec_details);
        }
        if($output){
            $data = array(
                'responseType' => 2,
                'selfDeclarationDetails' => $selfDeclarationDetails,
                'document' => $output->documents,
                'aadhar' => $output->aadhar
            );
            echo json_encode($data);
        }
        else {
            $data = array(
                'responseType' => 0,
                'msg' => "#LMRPT006887: Case not found against case_no : " . $case_no,
            );
            echo json_encode($data);
            return false;
        }
    }

    public function sentTenantCasesForVerification()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('verificationType', 'verification Type', 'trim|required');
        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Please Select Cases for verification',
            ));
        } else 
        {
            $dist_code     = $this->input->post('district_id');
            $remarks     = $this->input->post('remarks');
            $verificationType     = $this->input->post('verificationType');
            $allSelectedList = $this->input->post('selectedList');
            if (!empty($allSelectedList)) 
                {
                    foreach ($allSelectedList as $caseN) 
                    {
                        $case_no =$caseN;
                        if($verificationType == 'DPT_JS_VERIFICATION')
                        {
                            $this->db2 =  $this->dbswitch2($dist_code);
                            $this->db2->trans_begin();
                            $updateData = array(
                                'dept_js_approve' => 'A',
                                'ast_verification' => 'S',
                                'js_approve_date' => date('Y-m-d h:i:s')
                            );
                            
                            //////proceeding start//////
                            $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;
                        
                            if ($proceeding_id == null) {
                                $proceeding_id = 1;
                            }

                            $insSetProceed = [
                                'case_no'               => $case_no,
                                'proceeding_id'         => $proceeding_id,
                                'date_of_hearing'       => date('Y-m-d h:i:s'),
                                'next_date_of_hearing'  => date('Y-m-d h:i:s'),
                                'status'                => MB_PENDING,
                                'user_code'             => $this->session->userdata('user_code'),
                                'date_entry'            => date('Y-m-d h:i:s'),
                                'operation'             => 'E',
                                'note_on_order'         => $remarks ,
                                'ip'                    => $_SERVER['REMOTE_ADDR'],
                                'office_from'           => JS_OFFICE,
                                'office_to'             => ASO_OFFICE,
                                'task'                  => 'Forwared by JS',
                                'minutes_proposal_id'   => '00'
                            ];
                        }
                       
                        // settlement_basic updste as 's'
                        $updateSetlmntBasicStatus = $this->DeptTenantModel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData,$insSetProceed);
                        // if($updateSetlmntBasicStatus == 'ROW_EXISTS'){
                        //     echo json_encode(array(
                        //         'responseType' => 1,
                        //         'message' => 'ERRDUPDATESETBASICPROCE: Case Has Already Been sent for Verifcation please check',
                        //     ));
                        //     return false;
                        // }
                        if($updateSetlmntBasicStatus == 'SERVER-ERROR'){
                            $this->db2->trans_rollback();
                            log_message('error', '#ERRDUPDATESETBASICPROCE: Updation failed in settlement_basic and proceeding for change JS Verification Status');
                            log_message('error', $this->db2->last_query());
                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'ERRDUPDATESETBASICPROCE: Failed cases for sent to Verification',
                            ));
                            return false;

                        }else{
                            $this->db2->trans_commit();
                            $status = 1;
                        }
                    }
                }

            if($status == 1)
            {
                echo json_encode(array(
                    'responseType' => 2,
                    'message' => 'Cases Successfully Sent for Verification',
                ));
            }
        }
    }

    public function viewTenantCasesDptAsst()
    {
        $dist_code   = $this->input->post('dist_code');
        $data = array();
        $data['dist_code'] =$dist_code;
        $data['dist_name'] = $this->utilclass->getDistrictName($dist_code);
        $this->db2 =  $this->dbswitch2($dist_code);
        $data['status'] = true;
        $this->load->view('tenant/case_list_pending_under_asst',$data);
	}

    public function getPendingTenantCaseListUnderAssistant() 
    {
      
        $json = null;
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $dist_code = $this->input->post('dist_code');
        $searchByCol_0 = trim($this->input->post('search')['value']);

        $this->db2 =  $this->dbswitch2($dist_code);

        $case_list = $this->DeptTenantModel->getPendingCaseListDetailsForVerificationAsst($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);

        if(!empty($case_list)) {

        if($case_list['total_records'] >  0){

            $data_rows = $case_list['data_results'];

            foreach($data_rows as $row) {

                $url = base_url('DeptTenant/TenantCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);

                $case_no = "<small class='bg-'><i class='fa fa-archive'></i> " . $row->case_no . "</small>";

                $status = "<small class='text-danger'><i class='fa fa-undo'></i> Pending</small>";

                $button = "<a href='".$url."' class='btn btn-sm btn-primary' target='_viewCaseDetails'><i class='fa fa-eye'></i>Verify</a>";

                $circle = "<small class='text-primary'>Circle:- " . $this->utilclass->getCircleName($row->dist_code, $row->subdiv_code, $row->cir_code) . "</small>";
                $mouza = "<br><small class='text-primary'>Mouza:- " . $this->utilclass->getMouzaName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code) . "</small>";
                $village = "<br><small class='text-danger'>Vill:-  " . $this->utilclass->getVillageName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code) . "</small>";

                $json[] = array(
                $row->case_no,
                $case_no,
                $circle . $mouza . $village,
                $status,
                '<small class="text-default"><i class="fa fa-calendar"></i> '. date("d M, Y", strtotime($row->submission_date)) .' </small>',
                $button
                );
            }
        }
        else {
            $json = "";
        }      
        
        $total_records = $case_list['total_records'];

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

    public function sentTenantCasesFromASOtoJS()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        $this->form_validation->set_rules('case_no', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('verificationType', 'verification Type', 'trim|required');
        $this->form_validation->set_rules('remarks', 'ASO Remarks', 'trim|required');
        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Please Select Cases for verification',
            ));
        } else 
        {
            $dist_code     = $this->input->post('district_id');
            $remarks       = $this->input->post('remarks');
            $verificationType     = $this->input->post('verificationType');
            $case_no = $this->input->post('case_no');
           
                if ($case_no != null || $case_no!= "") 
                    {
                        
                        if($verificationType == JS_VERIFICATION)
                        {
                            $this->db2 =  $this->dbswitch2($dist_code);
                            $this->db2->trans_begin();
                            $updateData = array(
                                'so_verification' => 'A',
                                'ast_verification' => 'S'
                            );
                            
                            //////proceeding start//////
                            $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;
                            if ($proceeding_id == null) {
                                $proceeding_id = 1;
                            }

                            $insSetProceed = [
                                'case_no'               => $case_no,
                                'proceeding_id'         => $proceeding_id,
                                'date_of_hearing'       => date('Y-m-d h:i:s'),
                                'next_date_of_hearing'  => date('Y-m-d h:i:s'),
                                'status'                => MB_PENDING,
                                'user_code'             => $this->session->userdata('user_code'),
                                'date_entry'            => date('Y-m-d h:i:s'),
                                'operation'             => 'E',
                                'note_on_order'         => $remarks ,
                                'ip'                    => $_SERVER['REMOTE_ADDR'],
                                'office_from'           => JS_OFFICE,
                                'office_to'             => ASO_OFFICE,
                                'task'                  => 'Forwared by JS',
                            ];
                        }
                        if($verificationType == SO_VERIFICATION)
                        {
                            $updateData = array(
                                'so_verification' => 'A',
                                'ast_verification' => 'S'
                            );
                        }
                        if($verificationType == ASO_VERIFICATION)
                        {
                            $updateData = array(
                                'ast_verification' => 'A'
                            );
                        }
                        if($verificationType == ASO_TO_JDS_FORWARD)
                        {
                            $this->db2 =  $this->dbswitch2($dist_code);
                            $this->db2->trans_begin();

                            //////proceeding start//////
                            $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;
                            if ($proceeding_id == null) {
                                $proceeding_id = 1;
                            }

                            $updateData = array(
                                'ast_verification' => 'A',
                                'ast_remarks' => $remarks
                            );

                            $insSetProceed = [
                                'case_no'               => $case_no,
                                'proceeding_id'         => $proceeding_id,
                                'date_of_hearing'       => date('Y-m-d h:i:s'),
                                'next_date_of_hearing'  => date('Y-m-d h:i:s'),
                                'status'                => MB_PENDING,
                                'user_code'             => $this->session->userdata('user_code'),
                                'date_entry'            => date('Y-m-d h:i:s'),
                                'operation'             => 'E',
                                'note_on_order'         => $remarks ,
                                'ip'                    => $_SERVER['REMOTE_ADDR'],
                                'office_from'           => ASO_OFFICE,
                                'office_to'             => JS_OFFICE,
                                'task'                  => 'Forwared by ASO',
                            ];
                        }
                        
                        // settlement_basic updste as 's'
                        $updateSetlmntBasicStatus = $this->DeptTenantModel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData,$insSetProceed);
                
                        if($updateSetlmntBasicStatus == 'SERVER-ERROR'){
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRDUPDATESETBASICPROCE: Updation failed in settlement_basic and proceeding for change JS Verification Status');
                        log_message('error', $this->db2->last_query());
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRDUPDATESETBASICPROCE: Failed cases for sent to Verification',
                        ));
                        return false;

                        }else{
                            $this->db2->trans_commit();
                            $status = 1;

                        }
                       
                    }

                if($status == 1)
                {
                    echo json_encode(array(
                        'responseType' => 2,
                        'message' => 'Cases Successfully Verified',
                    ));
                }
        }
    }

    public function viewAssistantVerificationDetails()
    {
        $dist_code = $this->input->get('dist_code');
        $case_no = $this->input->get('case_no');
        if(($dist_code == NULL) || ($case_no == NULL))
        {
            echo "not getting case Details";
            return;
        }
        $this->db = $this->dbswitch2($dist_code);
        $assistantVerification=$this->DeptTenantModel->getAssistantVerificationDetails($this->db,$case_no)->result();
        $data['assistantVerification'] = $assistantVerification;
        $data['case_no'] = $case_no;
        $data['_view'] = 'tenant/assitantVerificationDetails.php';
        $this->load->view('layouts/main', $data);
    }


}

