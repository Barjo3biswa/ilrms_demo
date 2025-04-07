<?php
class DeptJuridical extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->model('Juridical/DeptJuridicalModel');
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
        } else if ($dist_code == "22") {
            $this->db2 = $this->load->database('hailakandi', TRUE);
        } else if ($dist_code == "auth") {
            $this->db2 = $this->load->database('auth', TRUE);
        }
        return $this->db2;
    }

    public function landingPage()
    {
        $user_code = $this->session->userdata('user_code');
        $designation = $this->session->userdata('designation');
        $data = array();

        $data['assistant_list'] = $this->db->query("SELECT * FROM depart_users WHERE designation=? 
                                    AND active_deactive=?", array('ASSISTANT', 'E'))->result();

        // var_dump($designation); die;

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
            $data['_view'] = 'juridical/landing_page_asst';
        }
        else
        {
            $data['verificationType'] = JS_VERIFICATION;
            $data['_view'] = 'juridical/landing_page_joint_sec';
        }
        $this->load->view('layouts/main', $data);
    }

    public function revertPage(){
        $dist_code     = trim($this->input->post('selectDistrict'));
        $data['user_dist']      = $this->DeptJuridicalModel->getDeptUserDistListWithRevertedCaseCount();
        $data['dist_code'] = $dist_code;
        $data['_view'] = 'revert/juridical-revert';
        $this->load->view('layouts/main', $data);

        
    }

    public function viewPendingJuridicalCases()
    {
        $dist_code   = $this->input->post('dist_code');
        $data = array();
        $data['dist_code'] =$dist_code;
        $data['dist_name'] = $this->utilclass->getDistrictName($dist_code);
        $this->db2 =  $this->dbswitch2($dist_code);
        $data['status'] = true;
        $this->load->view('juridical/juridical_case_list',$data);
	}
    
    public function getPendingJuridicalCaseList() 
    {
        $json = null;
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');
        $dist_code = $this->input->post('dist_code');
        $searchByCol_0 = trim($this->input->post('search')['value']);
        $this->db2 =  $this->dbswitch2($dist_code);
        // echo "<pre>"; var_dump($this->db2); die;
        $case_list = $this->DeptJuridicalModel->getPendingCaseListDetails($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);
        // echo $this->db->last_query(); die;

        if(!empty($case_list)) {

        if($case_list['total_records'] >  0){

            $data_rows = $case_list['data_results'];


            // echo "<pre>"; var_dump($data_rows); die;

            foreach($data_rows as $row) {

                $url = base_url('DeptJuridical/juridicalCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);

                $case_no = "<small class='bg-'><i class='fa fa-archive'></i> " . $row->case_no . "</small>";

                $button = "<a href='".$url."' class='btn btn-sm btn-primary' target='_viewCaseDetails'><i class='fa fa-eye'></i></a>";

                $circle = "<small class='text-danger'>Circle:- " . $this->utilclass->getCircleName($row->dist_code, $row->subdiv_code, $row->cir_code) . "</small>";
                $mouza = "<br><small class='text-danger'>Mouza:- " . $this->utilclass->getMouzaName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code) . "</small>";
                $village = "<br><small class='text-danger'>Vill:-  " . $this->utilclass->getVillageName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code) . "</small>";

                $ast_verification = $row->ast_verification;

                if($ast_verification == NULL){
                    $ast_verification_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                }
                if($ast_verification == 'S'){
                    $ast_verification_status = '<small>Sent to AST <i class="fa fa-forward"></i></small>';
                }
                if($ast_verification == 'A'){

                    $url = base_url('DeptJuridical/viewAssistantVerificationDetails');
                    $url .= '?dist_code=' . urlencode($row->dist_code);
                    $url .= '&case_no=' . urlencode($row->case_no);

                    $ast_verification = '<small class="text-success">AST Verified</small></br>';
                    $viewBtn = "<a href='".$url."' class='btn btn-sm btn-success' target='_viewAstVerificationDetails'>view ASO Checklist Report</a>";


                    $asst_remarks = $row->ast_remarks;

                    $ast_verification_status = $ast_verification ." Remarks : ". $asst_remarks;
                }
                if($ast_verification == 'R'){
                    $url = base_url('DeptJuridical/viewAssistantVerificationDetails');
                    $url .= '?dist_code=' . urlencode($row->dist_code);
                    $url .= '&case_no=' . urlencode($row->case_no);

                    $ast_verification = '<small class="text-danger">Reverted by AST </small></br>';
                    $viewBtn = "<a href='".$url."' class='btn btn-sm btn-danger' target='_viewAstVerificationDetails'>view ASO Checklist Report</a>";
                    $ast_verification_status = $ast_verification . $viewBtn;
                }

                $json[] = array(
                    $row->case_no,
                    $case_no,
                    $circle . $mouza . $village,
                    $ast_verification_status,
                    '<small class="text-default"><i class="fa fa-calendar"></i> '. date("d M, Y", strtotime($row->submission_date)) .' </small>',
                    $button,
                    $row->ast_verification
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

    public function juridicalCaseDetails()
    {
        $dist_code      = $this->input->get('dist_code');
        $application_no = $this->input->get('case_no');
        $this->db2      =  $this->dbswitch2($dist_code);

        $basic                 = $this->DeptJuridicalModel->getSettlementBasic($this->db2,$application_no);
        $applicants_buyers     = $this->DeptJuridicalModel->getAllApplicantBuyers($this->db2,$application_no);
        $applicants_owners     = $this->DeptJuridicalModel->getAllApplicantOwners($this->db2,$application_no);
        $applicants_encroacher = $this->DeptJuridicalModel->getAllApplicantEncroacher($this->db2,$application_no);
        $applicants_riotee_nok = $this->DeptJuridicalModel->getAllApplicantRioteeNok($this->db2,$application_no);
        $dags                  = $this->DeptJuridicalModel->getSettlementDag($this->db2,$application_no);
        $lmnotes               = $this->DeptJuridicalModel->getSettlementTenantLmNote($this->db2,$application_no);
        $proceedings           = $this->DeptJuridicalModel->getSettlementProceeding($this->db2,$application_no);
        $dhardocuments         = $this->DeptJuridicalModel->getDocuments($this->db2,$application_no);
        $nominee               = $this->DeptJuridicalModel->getAllNomineeDetail($this->db2,$application_no);

        $data=[];
        foreach($applicants_encroacher as $encroacher)
        {
            // getting the encroacher details
            $query="select * from c_land_bank_encroacher_details where id=$encroacher->enc_id";
            $encdata=$this->db2->query($query)->result();
            $data[] = $encdata;
        }

        // for guardian relation
        $query_for_guar_rel = "SELECT * from master_guard_rel WHERE id NOT IN ('5','6')";
        $relation_executation = $this->db2->query($query_for_guar_rel);
        $row = $relation_executation->num_rows;
        if ($row != 0) {
            $data['guar_rel'] = $relation_executation->result();
        }

        $premiumData                   = $this->DeptJuridicalModel->getPremium($this->db2,$application_no);
        $data['premium_data']          = $premiumData;
        $data['premium']               = $premiumData;
        $data['encdata']               = $data;
        $data['basic']                 = $basic;
        $data['applicants_buyers']     = $applicants_buyers;
        $data['applicants_owners']     = $applicants_owners;
        $data['applicants_encroacher'] = $applicants_encroacher;
        $data['applicants_riotee_nok'] = $applicants_riotee_nok;
        $data['dags']                  = $dags;
        $data['lmnotes']               = $lmnotes;
        $data['proceedings']           = $proceedings;
        $data['dhardocuments']         = $dhardocuments;
        $data['nominee']               = $nominee;
        $data['deleted_dags']          = $this->DeptJuridicalModel->getDeletedDags($this->db2,$application_no);


        $case_no = $application_no;
        $caseDetails = $this->DeptJuridicalModel->getSettlementApplicationDetailsByCaseNo($this->db2,$case_no,$dist_code);
        $proceedings = $this->DeptJuridicalModel->getSettlementProceeding($this->db2,$case_no);
        //$data['caseCount']   = $caseCount;
        $data['caseDetails'] = $caseDetails;
        $data['proceedings'] = $proceedings;
        $data['reservation'] = $this->DeptJuridicalModel->getSettlementReservation($this->db2,$application_no);
        $data['additional_property'] = $this->DeptJuridicalModel->getAdditionalProperty($this->db2,$application_no);
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

        $sql = $this->db2->query('select sid.*,imc.category_name from settlement_institution_details sid join ins_master_category imc on sid.ins_cat_type::int = imc.id  where case_no = ?', array($application_no));

        $data['ins_data'] = $sql->result();
        $data['instituteDetails'] = $this->DeptJuridicalModel->getInstitutionDetails($this->db2,$application_no);

        $data['_view'] = 'juridical/case_view';
        $this->load->view('layouts/main', $data);
    }

    public function getSelfDocApi(){
        $case_no = $this->input->post('case_no');
        $dist_code = $this->input->post('dist_code');

        // var_dump($dist_code);die;
        $this->db =  $this->dbswitch2($dist_code);

        $sql = "Select basundhara from basundhar_application where dharitree='$case_no' ";
        $basundhara = $this->db->query($sql)->row();
        // echo $this->db->last_query(); die;
        $token = $this->utilclass->createTokenJwt();
        // echo "<pre>"; var_dump($token); die;
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

        // echo "<pre>"; var_dump($output); die;


        $lmdata['document']=$output->documents;
        $lmdata['query']=$output->query;
        $lmdata['property']=$output->property;
        $lmdata['aadhar']=$output->aadhar;
        $lmdata['nextKin']=$output->nextKin;
        $selfDeclarationDetails=[];
        if(isset($output->selfDeclaration))
        {
            foreach($output->selfDeclaration as $selfDec){
                // $lmdata['selfDeclarationDetails']=json_decode($selfDec->dec_details);
                $selfDeclarationDetails=json_decode($selfDec->dec_details);
            }
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

    public function sentJuridicalCasesForVerification()
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
            $dist_code        = $this->input->post('district_id');
            $remarks          = $this->input->post('remarks');
            $asst_id          = $this->input->post('asst_id');
            $verificationType = $this->input->post('verificationType');
            $allSelectedList  = $this->input->post('selectedList');

            if(empty($asst_id) || $asst_id == null || $asst_id == '' || $asst_id == '0')
            {
                echo json_encode(array(
                    'responseType' => 1,
                    'message'      => '#WARNING461: Please select assistant !!!',
                ));
                return false;
            }
            if(empty($remarks) || $remarks == null || $remarks == '')
            {
                echo json_encode(array(
                    'responseType' => 1,
                    'message'      => '#WARNING469: Remarks field is mandatory !!!',
                ));
                return false;
            }


            if (!empty($allSelectedList)) 
                {
                    foreach ($allSelectedList as $caseN) 
                    {
                        $case_no =$caseN;
                        if($verificationType == 'DPT_JS_VERIFICATION')
                        {
                            $this->db2 =  $this->dbswitch2($dist_code);
                            $this->db2->trans_begin();

                            // check if already already assigned to assitant
                            $checkAstAsgn = $this->db2->query("SELECT * FROM settlement_basic WHERE case_no=? AND 
                                                assign_ast_code IS NOT NULL AND dept_js_approve=?", 
                                                    array($case_no, 'A'));
                            // echo $this->db2->last_query(); die;
                            if($checkAstAsgn->num_rows() > 0)
                            {
                                echo json_encode(array(
                                    'responseType' => 1,
                                    'message'      => '#WARNING474: Case has already been verified by Assistant and returned to department !!!',
                                ));
                                return false;
                            }

                            $updateData = array(
                                'dept_js_approve'      => 'A',
                                'ast_verification'     => 'S',
                                'js_approve_date'      => date('Y-m-d h:i:s'),
                                'assign_ast_code'      => $asst_id,
                                'verified_ast_remarks' => $remarks,
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
                        $updateSetlmntBasicStatus = $this->DeptJuridicalModel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData,$insSetProceed);
                        if($updateSetlmntBasicStatus == 'SERVER-ERROR'){
                            $this->db2->trans_rollback();
                            log_message('error', '#ERR496: Updation failed in settlement_basic and proceeding for change JS Verification Status');
                            log_message('error', $this->db2->last_query());
                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'ERR496: Failed cases for sent to Verification',
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
                    // 'ast_verification' =>'S',
                    'message' => 'Cases Successfully Sent for Verification',
                ));
            }
        }
    }

    public function viewJuridicalCasesDptAsst()
    {
        $dist_code   = $this->input->post('dist_code');
        $data = array();
        $data['dist_code'] =$dist_code;
        $data['dist_name'] = $this->utilclass->getDistrictName($dist_code);
        $this->db2 =  $this->dbswitch2($dist_code);
        $data['status'] = true;
        $this->load->view('juridical/case_list_pending_under_asst',$data);
	}

    public function getPendingJuridicalCaseListUnderAssistant() 
    {
      
        $json = null;
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $dist_code = $this->input->post('dist_code');
        $searchByCol_0 = trim($this->input->post('search')['value']);

        $this->db2 =  $this->dbswitch2($dist_code);

        $case_list = $this->DeptJuridicalModel->getPendingCaseListDetailsForVerificationAsst($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);

        if(!empty($case_list)) {

        if($case_list['total_records'] >  0){

            $data_rows = $case_list['data_results'];

            foreach($data_rows as $row) {

                $url = base_url('DeptJuridical/juridicalCaseDetails');
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

    public function sentJuridicalCasesFromAsoToJs()
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

                        // check if case has already been forwarded to JS
                        $check = $this->db2->query("SELECT * FROM settlement_proceeding WHERE case_no=? 
                                    AND office_from=? AND office_to=? AND status=?", 
                                        array($case_no, ASO_OFFICE, JS_OFFICE, MB_PENDING))->num_rows();
                        if($check != 0)
                        {
                            log_message('error', 'ERR713: This case $case_no has verified and already sent to JS Office for further process!!!');
                            log_message('error', $this->db2->last_query());
                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => "ERR713: This case $case_no has verified and already sent to JS Office for further process!!!",
                            ));
                            return false;
                        }
                        
                        // settlement_basic updste as 's'
                        $updateSetlmntBasicStatus = $this->DeptJuridicalModel->updateSettlementBasicForCab($this->db2,$case_no, $dist_code, $updateData,$insSetProceed);
                        // echo $this->db2->last_query(); die;
                
                        if($updateSetlmntBasicStatus == 'SERVER-ERROR'){
                        $this->db2->trans_rollback();
                        log_message('error', '#ERR711: Updation failed in settlement_basic and proceeding for change JS Verification Status');
                        log_message('error', $this->db2->last_query());
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERR711: Failed cases for sent to Verification',
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
        $assistantVerification=$this->DeptJuridicalModel->getAssistantVerificationDetails($this->db,$case_no)->result();
        $data['assistantVerification'] = $assistantVerification;
        $data['case_no'] = $case_no;
        $data['_view'] = 'juridical/assitantVerificationDetails.php';
        $this->load->view('layouts/main', $data);
    }

    public function getInsMasterList()
    {
        $ins_category = $this->db->query("SELECT * FROM ins_master_category WHERE enable_status=?", 
                                    array(1))->result();
        echo json_encode(array(
            'result' => $ins_category,
        ));
        return;
    }


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
            'doc_id'    => $doc_id,
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


}

