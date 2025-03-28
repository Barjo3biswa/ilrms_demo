<?php
class DeptConversion extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->model('conversion/DeptConversionModel');
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


    public function conversionCaseDetails()
    {
        $dist_code = $this->input->get('dist_code');
        $case_no = $this->input->get('case_no');

        $this->db2 = $this->dbswitch2($dist_code);

        $petition_basic = $this->DeptConversionModel->getPetitionBasicDetails($this->db2,$case_no)->row();
        

        $landdetails = $this->DeptConversionModel->getLandDetails($this->db2,$petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code, $petition_basic->mouza_pargona_code, $petition_basic->lot_no, $petition_basic->vill_townprt_code, $petition_basic->petition_no)->row_array();
        
        $pattadardetails = $this->DeptConversionModel->getPattadardetails($this->db2,$petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code, $petition_basic->mouza_pargona_code, $petition_basic->lot_no, $petition_basic->vill_townprt_code, $petition_basic->petition_no, $landdetails['dag_no'], $landdetails['patta_no'], $landdetails['patta_type_code']);
        
        $data['conv_type'] = $conversionType = $this->DeptConversionModel->getConversionType($this->db2);
        
        $dist = $this->utilclass->getDistrictName($petition_basic->dist_code);
        $subdiv = $this->utilclass->getSubDivName($petition_basic->dist_code, $petition_basic->subdiv_code);
        $circle = $this->utilclass->getCircleName($petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code);
        $mouza = $this->utilclass->getMouzaName($petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code, $petition_basic->mouza_pargona_code);
        $lot = $this->utilclass->getLotName($petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code, $petition_basic->mouza_pargona_code, $petition_basic->lot_no);
        $village = $this->utilclass->getVillageName($petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code, $petition_basic->mouza_pargona_code, $petition_basic->lot_no, $petition_basic->vill_townprt_code);

        $patta_type = $this->utilclass->getPattaType($landdetails['patta_type_code']);

        $relation = 'f';
        $data['relationship'] = $relationship = $this->utilclass->getGuardianRelationAssamese($relation);
        $data['lm_details_final'] = $petitionLMNote = $this->DeptConversionModel->getPetitionLMNote($this->db2,$petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code, $petition_basic->mouza_pargona_code, $petition_basic->lot_no, $petition_basic->vill_townprt_code, $petition_basic->petition_no)->result();
        
        $data['lm_details'] = $lm_details = $this->DeptConversionModel->getPetitionLMNote($this->db2,$petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code, $petition_basic->mouza_pargona_code, $petition_basic->lot_no, $petition_basic->vill_townprt_code, $petition_basic->petition_no)->row_array();
        
        if (count($lm_details) != '0') {
            $land = $lm_details['land_class_code'];
            $land_type = $this->db2->query("Select * from   landclass_code where class_code = '$land'")->row();
           
            $prim_per_bigha = $lm_details['prim_per_bigha'];
            $prim_per_bigha = round($prim_per_bigha, 2);

            $prim_tot = $lm_details['prim_tot'];
            $prim_tot = round($prim_tot, 2);

            $data['lm_details'] = array(
                //'petition_no' => $lm_details[''],
                'dag_no' => $lm_details['dag_no'],
                'note_no' => $lm_details['note_no'],
                'partition_info' => $lm_details['partition_info'],
                //'user_code' => $lm_details[''],
                'date_entry' => $lm_details['date_entry'],
                //'operation' => $lm_details[''],
                'applicant_patta_yn' => $lm_details['applicant_patta_yn'],
                'occupied_yn' => $lm_details['occupied_yn'],
                'val_tree_yn' => $lm_details['val_tree_yn'],
                'dist_frm_town' => $lm_details['dist_frm_town'],
                'inside_outside_town' => $lm_details['inside_outside_town'],
                'land_class_code' => $land_type->land_type,
                'issuit_forconv_under105' => $lm_details['issuit_forconv_under105'],
                'roadside_rsv_b' => $lm_details['roadside_rsv_b'],
                'roadside_rsv_k' => $lm_details['roadside_rsv_k'],
                'roadside_rsv_lc' => $lm_details['roadside_rsv_lc'],
                'near_river_yn' => $lm_details['near_river_yn'],
                'prim_per_bigha' => $prim_per_bigha,
                'conv_b' => $lm_details['conv_b'],
                'conv_k' => $lm_details['conv_k'],
                'conv_lc' => $lm_details['conv_lc'],
                'prim_tot' => $prim_tot,
                'lm_sign_yn' => $lm_details['lm_sign_yn'],
                'case_no' => $case_no,
                'lm_code' => $lm_details['lm_code'],
                'sk_note_date' => $lm_details['sk_note_date'],
                'sk_note' => $lm_details['sk_note'],
                'sk_sign_yn' => $lm_details['sk_sign_yn'],
                'sk_name' => $lm_details['user_code'],
                'jati_janajati_yn' => $lm_details['jati_janajati_yn'],
                'jati_janajati_upload' => $lm_details['jati_janajati_upload'],
                'freedom_fighter_yn' => $lm_details['freedom_fighter_yn'],
                'freedom_fighter_upload' => $lm_details['freedom_fighter_upload'],
                'widow_yn' => $lm_details['widow_yn'],
                'widow_upload' => $lm_details['widow_upload'],
                'premium_assesment' => $lm_details['premium_assesment']
            );
        }

        $namelm = $this->DeptConversionModel->getLmDetails($this->db2,$lm_details['lm_code'], $petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code, $petition_basic->mouza_pargona_code, $petition_basic->lot_no)->row();

        $data['lm_name'] = $namelm->lm_name;
       
        $skname = $this->DeptConversionModel->getSkUserDetails($this->db2,$lm_details['user_code'], $petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code)->row();
        // echo "<pre>";
        // var_dump($this->db2->last_query());die;
        $data['sk_skname'] = $skname->username;

        $bo_details = $this->DeptConversionModel->getBoDetails($this->db2,$petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code,$petition_basic->mouza_pargona_code, $petition_basic->lot_no,$petition_basic->vill_townprt_code,$petition_basic->petition_no)->row_array();

        if ($bo_details != NULL) {
                   $data['bo_details'] = array(
                       'dag_no' => $bo_details['dag_no'],
                       'case_no' => $bo_details['case_no'],
                       'note_no' => $bo_details['note_no'],
                       'dist_frm_town' => $bo_details['dist_frm_town'],
                       'inside_outside_town' =>  $bo_details['inside_outside_town'],
                       'land_scenario' => $bo_details['land_scenario'],
                       'prt_transfer' => $bo_details['prt_transfer'],
                       'sent_to_govt' => $bo_details['sent_to_govt'],
                       'approved' => $bo_details['approved'],
                       'reason' => $bo_details['reason'],
                       'prim_assesed' => $bo_details['prim_assesed'],
                       'road_rvr_rerservation' => $bo_details['road_rvr_rerservation'],
                       'reverify' => $bo_details['reverify'],
                       'bo_note' => $bo_details['bo_note'],
                       'bo_sign_yn' => $bo_details['bo_sign_yn'],
                       'bo_code' => $bo_details['bo_code'],
                       'bo_sign_date' =>  $bo_details['bo_sign_date'],
                   );
                   
                    $boname = $this->DeptConversionModel->getUserDetails($this->db2,$bo_details['bo_code'],$bo_details['dist_code'])->row();

                   $data['bo_boname'] = $boname->username;

               }
                    $data['cases'] = $this->DeptConversionModel->getPetitionProceeding($this->db2,$case_no)->result();

                    $data['dc_adc_order'] = $this->DeptConversionModel->getPetitionProceedingDcAdc($this->db2,$case_no)->result();

                    $data['dept_order'] = $this->DeptConversionModel->getPetitionProceedingDeptJs($this->db2,$case_no)->result();


                    $data['bo_details_final'] = $this->DeptConversionModel->getPetitionBoNote($this->db2,$petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code,$petition_basic->mouza_pargona_code, $petition_basic->lot_no,$petition_basic->vill_townprt_code,$petition_basic->petition_no)->result();

                    $data['premium'] = $this->db2->query("Select * from    petition_lm_note where dist_code='$petition_basic->dist_code' and subdiv_code='$petition_basic->subdiv_code' and "
                       . "cir_code='$petition_basic->cir_code' and lot_no='$petition_basic->lot_no' and vill_townprt_code='$petition_basic->vill_townprt_code' and "
                       . "mouza_pargona_code='$petition_basic->mouza_pargona_code' and petition_no='$petition_basic->petition_no' and "
                       . "co_reject is NULL ORDER BY note_no DESC LIMIT 1")->result();

               $data['basundharaAttachment']=$this->DeptConversionModel->searchBasundharaLink($this->db2,$case_no);


                        $this->db = $this->load->database('db2', TRUE);
                        $assistantVerification=$this->DeptConversionModel->getAssistantVerificationDetails($this->db,$case_no)->result();


               $data['location'] = array(
                   'dist' => $dist,
                   'sub' => $subdiv,
                   'cir' => $circle,
                   'mouza' => $mouza,
                   'lot' => $lot,
                   'vill' => $village,
                   'case_no' => $case_no,
                   'date' => $petition_basic->date_entry,
                   'add_to' => $petition_basic->add_off_name,
                   'add_off_designation' => 'DC',
                   'next_date' => $petition_basic->next_date_of_hearing,
                   'sk_comment' => $petition_basic->sk_comment,
                   'petition_no' => $petition_basic->petition_no,
                   'js_approve' => $petition_basic->dept_js_approve,
                   'ps_approve' => $petition_basic->dept_ps_approve,

                   'subdiv_code' => $petition_basic->subdiv_code,
                   'cir_code' => $petition_basic->cir_code,
                   'mouza_pargona_code' => $petition_basic->mouza_pargona_code,
                   'lot_no' => $petition_basic->lot_no,
                   'vill_townprt_code' => $petition_basic->vill_townprt_code,
               );

                $data['land_details'] = array(
                   'dag' => $landdetails['dag_no'],
                   'm_dag_area_b' => $landdetails['m_dag_area_b'],
                   'm_dag_area_k' => $landdetails['m_dag_area_k'],
                   'm_dag_area_lc' => round($landdetails['m_dag_area_lc'],2),
                   'patta_no' => trim($landdetails['patta_no']),
                   'patta_type' => $patta_type
               );

               $data['pattadar'] = $pattadardetails;
               $data['p_in_order'] = $pattadardetails;
               $data['dist_code'] = $dist_code;
               $data['assistantVerification'] = $assistantVerification;
               $data['astVerificationStatus'] = $petition_basic->ast_verification;
    
        $data['_view'] = 'conversion/conversionLanding.php';
        $this->load->view('layouts/main', $data);
    }

    public function sentConversionCasesFromASOtoJS()
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
                        
                        if($verificationType == ASO_TO_JDS_FORWARD)
                        {
                            $this->db2 =  $this->dbswitch2($dist_code);
                            $this->db2->trans_begin();

                            //////proceeding start//////
                            $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from petition_proceeding where case_no='$case_no' ")->row()->c;
                            if ($proceeding_id == null) {
                                $proceeding_id = 1;
                            }
                            $pettion_basic_row = $this->db2->query("select * from petition_basic where case_no=?",array($case_no))->row();

                            $updateData = array(
                                'ast_verification' => 'A',
                                'ast_remarks' => $remarks
                            );

                            $insSetProceed = [
                                'dist_code'             => $dist_code,
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
                                'note_on_order'         => $remarks ,
                                'ip'                    => $_SERVER['REMOTE_ADDR'],
                                'office_from'           => ASO_OFFICE,
                                'office_to'             => JS_OFFICE,
                                'task'                  => 'Forwared by ASO',
                                //'minutes_proposal_id'   => '00'
                            ];
                        }
                        
                        // settlement_basic updste as 's'
                        $updatePettBasicStatus = $this->DeptConversionModel->updatePetitionBasicForCab($this->db2,$case_no, $dist_code, $updateData,$insSetProceed);
                
                        if($updatePettBasicStatus == 'SERVER-ERROR'){
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
                            // echo json_encode(array(
                            //     'responseType' => 2,
                            //     'message' => 'Cases Successfully Sent for Verification',
                            // ));

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


    public function document($doc){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, API_LINK."attachment");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'name' => $doc
        )));
        $result = curl_exec($curl_handle);
        $result = json_decode($result);
        $output=$result->raw_data;
        $content_type=$result->mime_type;
        $check=explode("/",$content_type);
        if($check[1]=='pdf'){
            $output=base64_decode($output);
            header('Content-type: application/pdf');
            echo $output;
        }else{
            echo '<img src="data:'.$content_type.';base64,'.$output.'" />';
        }
    }


    ///Approve Conversion Cases by Joint Sec
    public function approveConversionByJs()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $config=array(
        array('field'=>'dist_code','label'=>'Dist Code','rules'=>'required'),
        array('field'=>'case_no','label'=>'Case No','rules'=>'required'),
        array('field'=>'petition_no','label'=>'Petition No','rules'=>'required'),
        array('field'=>'approval_remarks','label'=>'Approval Remarks','rules'=>'required'),
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

        ///////Get Posted Data
        $dist_code = $this->input->post('dist_code');
        $subdiv_code = $this->input->post('subdiv_code');
        $cir_code = $this->input->post('cir_code');
        $mouza_pargona_code = $this->input->post('mouza_pargona_code');
        $lot_no = $this->input->post('lot_no');
        $vill_townprt_code = $this->input->post('vill_townprt_code');

        $case_no = $this->input->post('case_no');
        $petition_no = $this->input->post('petition_no');
        $approval_remarks = $this->input->post('approval_remarks');
        $user_code = $this->session->userdata('user_code');

        $this->db2 =  $this->dbswitch2($dist_code);

        $updateArrDhar = [
            'dept_js_approve' => 'Y',
            'js_approve_date' => date('Y-m-d h:i:s'),
        ];

        $whereArr=[
            'case_no' => $case_no,
            'dist_code' => $dist_code,
            // 'petition_no' => $petition_no,
        ];

        $insertArrIlrms = [
            'case_no' => $case_no,
            'user_code' => $user_code,
            'dist_code' => $dist_code,
            'subdiv_code' => $subdiv_code,
            'cir_code' => $cir_code,
            'mouza_pargona_code' => $mouza_pargona_code,
            'lot_no' => $lot_no,
            'vill_townprt_code' => $vill_townprt_code,
            // 'petition_no' => $petition_no,
            'status' => DPT_JS_APPROVE,
            'created_at' => date('Y-m-d h:i:s'),
        ];

        $this->db2->trans_begin();
        $this->db->trans_begin();

        $updateDharitree=$this->DeptConversionModel->updatePetitionBasicForConversion($this->db2, $updateArrDhar, $whereArr);

            if($updateDharitree <= 0)
            {
                $this->db2->trans_rollback();
                $this->db->trans_rollback();
                log_message('error', '#ERRDUPDATEPETBASIC: Updation failed in petition_basic');
                log_message('error', $this->db2->last_query());

                echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'ERRDUPDATEPETBASIC: Approval Failed! Please Contact System Admin',
                ));
                return false;
            }else
            {

                ////insert proceeding
                $proceeding = $this->db2->query("select count(proceeding_id) as proceed from petition_proceeding_dc_adc where case_no = '$case_no' limit 1")->result();
                $proceeding_id = $proceeding[0]->proceed + 1;

                    $proceeding_data_dept = array(
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'co_order' => $approval_remarks,
                        'status' => 'Pending',
                        'user_code' => $user_code,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'dist_code' => $dist_code,
                        'subdiv_code' => $subdiv_code,
                        'cir_code' => $cir_code
                    );

                $deptInsert = $this->db2->insert('petition_proceeding_dc_adc', $proceeding_data_dept);

                if($deptInsert != 1){
                    $this->db2->trans_rollback();
                    $this->db->trans_rollback();

                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'ERRINSPROCEEDINGAPP: Approval Failed! Please Contact System Admin',
                    ));
                    return false;
                }
                else
                {
                $insertIlrms = $this->db->insert('conversion_case_list', $insertArrIlrms);
                if ($insertIlrms != TRUE) 
                {
                    $this->db2->trans_rollback();
                    $this->db->trans_rollback();
                    log_message('error', '#ERRINSILRMS: Insertion failed in conversion_case_list');
                    log_message('error', $this->db->last_query());

                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'ERRINSILRMS: Approval Failed! Please Contact System Admin',
                    ));
                    return false;
                }
                else
                {
                    $this->db->trans_commit();
                    $this->db2->trans_commit();
                    echo json_encode(array(
                        'responseType' => 2,
                        'message' => 'Case Successfuly Forwared to Principal Secretary',
                    ));
                }

                }
            }
    }


    ///Approve Conversion Cases by Principal Sec
    public function finalOrderByPs()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $config=array(
        array('field'=>'dist_code','label'=>'Dist Code','rules'=>'required'),
        array('field'=>'case_no','label'=>'Case No','rules'=>'required'),
        array('field'=>'petition_no','label'=>'Petition No','rules'=>'required'),
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

        ///////Get Posted Data
        $dist_code = $this->input->post('dist_code');
        $subdiv_code = $this->input->post('subdiv_code');
        $cir_code = $this->input->post('cir_code');
        $dept_order_no = $this->input->post('order_no');
        $dept_order_date = $this->input->post('order_date');
        $entry_date =  date('Y-m-d',strtotime($dept_order_date));

        $case_no = $this->input->post('case_no');
        $petition_no = $this->input->post('petition_no');
        $user_code = $this->session->userdata('user_code');

        $this->db2 =  $this->dbswitch2($dist_code);


        $proceeding_details = $this->db2->query("select co_order,note_on_order from petition_proceeding_dc_adc where case_no = '$case_no' order by proceeding_id desc limit 1")->row();

        $co_order = $proceeding_details->co_order;
        
        $updateArrDhar = [
            'dept_ps_approve' => 'Y',
            'dept_note_yn' => 'Y',
            'status' => 'P',
            'add_off_desig' => 'DC',
            'ps_approve_date' => date('Y-m-d h:i:s'),
        ];

        $updateArrIlrms = [
            'status' => DPT_PS_APPROVE,
            'updated_at' => date('Y-m-d h:i:s'),
        ];

        $whereArr=[
            'case_no' => $case_no,
            'dist_code' => $dist_code,
            // 'petition_no' => $petition_no,
        ];


        $this->db2->trans_begin();
        $this->db->trans_begin();

        $updateDharitree=$this->DeptConversionModel->updatePetitionBasicForConversion($this->db2, $updateArrDhar, $whereArr);

            if($updateDharitree <= 0)
            {
                $this->db2->trans_rollback();
                $this->db->trans_rollback();
                log_message('error', '#ERRDUPDATEPETBASIC: Updation failed in petition_basic');
                log_message('error', $this->db2->last_query());

                echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'ERRDUPDATEPETBASIC: Approval Failed! Please Contact System Admin',
                ));
                return false;
            }else
            {
                $proceeding = $this->db2->query("select count(proceeding_id) as proceed from petition_proceeding_dc_adc where case_no = '$case_no' limit 1")->result();

                $proceeding_id = $proceeding[0]->proceed + 1;

                    $proceeding_data_dept = array(
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => $entry_date,
                        'co_order' => $co_order,
                        'note_on_order' => "Convesrion Case Approved by Department. Department Order Number : ".$dept_order_no,
                        'status' => 'Pending',
                        'user_code' => $user_code,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'dist_code' => $dist_code,
                        'subdiv_code' => $subdiv_code,
                        'cir_code' => $cir_code
                    );

                $deptInsert = $this->db2->insert('petition_proceeding_dc_adc', $proceeding_data_dept);

                if($deptInsert != 1){
                    $this->db2->trans_rollback();
                    $this->db->trans_rollback();

                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'ERRINSPROCEEDING: Approval Failed! Please Contact System Admin',
                    ));
                    return false;
                }else
                {
                    $updateIlrms=$this->DeptConversionModel->updateConversionIlrmsByDpt($this->db, $updateArrIlrms, $whereArr);

                    if($updateIlrms <= 0)
                    {
                        $this->db2->trans_rollback();
                        $this->db->trans_rollback();
                        log_message('error', '#ERRDUPDATEILRMS: Updation failed in ILRMS');
                        log_message('error', $this->db->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRDUPDATEILRMS: Approval Failed! Please Contact System Admin',
                        ));
                        return false;

                    }else
                    {
                        $this->db->trans_commit();
                        $this->db2->trans_commit();
                        echo json_encode(array(
                            'responseType' => 2,
                            'message' => 'Case Approved Successfuly',
                        ));
                    }
                }
            }
    }



    public function revertOrderByJs()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $config=array(
        array('field'=>'dist_code','label'=>'Dist Code','rules'=>'required'),
        array('field'=>'case_no','label'=>'Case No','rules'=>'required'),
        array('field'=>'petition_no','label'=>'Petition No','rules'=>'required'),
        array('field'=>'revert_remarks','label'=>'Revert Remaks','rules'=>'required'),
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

        ///////Get Posted Data
        $dist_code = $this->input->post('dist_code');
        $subdiv_code = $this->input->post('subdiv_code');
        $cir_code = $this->input->post('cir_code');
        $mouza_pargona_code = $this->input->post('mouza_pargona_code');
        $lot_no = $this->input->post('lot_no');
        $vill_townprt_code = $this->input->post('vill_townprt_code');

        $case_no = $this->input->post('case_no');
        $petition_no = $this->input->post('petition_no');
        $revert_remarks = $this->input->post('revert_remarks');
        $user_code = $this->session->userdata('user_code');

        $this->db2 =  $this->dbswitch2($dist_code);

        $proceeding_details = $this->db2->query("select co_order,note_on_order from petition_proceeding_dc_adc where case_no = '$case_no' order by proceeding_id desc limit 1")->row();

        $co_order = $proceeding_details->co_order;

        $updateArrDhar = [
            'dept_js_approve' => 'N',
            'status' => 'R',
            'add_off_desig' => 'DC',
        ];

        $whereArr=[
            'case_no' => $case_no,
            'dist_code' => $dist_code,
            // 'petition_no' => $petition_no,
        ];

        $insertArrIlrms = [
            'case_no' => $case_no,
            'user_code' => $user_code,
            'dist_code' => $dist_code,
            'subdiv_code' => $subdiv_code,
            'cir_code' => $cir_code,
            'mouza_pargona_code' => $mouza_pargona_code,
            'lot_no' => $lot_no,
            'vill_townprt_code' => $vill_townprt_code,
            'petition_no' => $petition_no,
            'status' => DPT_JS_REVERT,
            'created_at' => date('Y-m-d h:i:s')
        ];

        $this->db2->trans_begin();
        $this->db->trans_begin();

        $updateDharitree=$this->DeptConversionModel->updatePetitionBasicForConversion($this->db2, $updateArrDhar, $whereArr);

            if($updateDharitree <= 0)
            {
                $this->db2->trans_rollback();
                $this->db->trans_rollback();
                log_message('error', '#ERRDUPDATEPETBASICREV: Updation failed in petition_basic');
                log_message('error', $this->db2->last_query());

                echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'ERRDUPDATEPETBASICREV: Approval Failed! Please Contact System Admin',
                ));
                return false;
            }else
            {
                $proceeding = $this->db2->query("select count(proceeding_id) as proceed from petition_proceeding_dc_adc where case_no = '$case_no' limit 1")->result();
                $proceeding_id = $proceeding[0]->proceed + 1;

                    $proceeding_data_dept = array(
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'co_order' => $co_order,
                        'note_on_order' => $revert_remarks,
                        'status' => 'Pending',
                        'user_code' => $user_code,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'dist_code' => $dist_code,
                        'subdiv_code' => $subdiv_code,
                        'cir_code' => $cir_code
                    );

                $deptInsert = $this->db2->insert('petition_proceeding_dc_adc', $proceeding_data_dept);

                if($deptInsert != 1){
                    $this->db2->trans_rollback();
                    $this->db->trans_rollback();

                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'ERRINSPROCEEDINGREV: Approval Failed! Please Contact System Admin',
                    ));
                    return false;
                }
                else
                {
                    $insertIlrms = $this->db->insert('conversion_case_list', $insertArrIlrms);
                    if ($insertIlrms != TRUE) 
                    {
                        $this->db2->trans_rollback();
                        $this->db->trans_rollback();
                        log_message('error', '#ERRINSILRMSREV: Insertion failed in conversion_case_list');
                        log_message('error', $this->db->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRINSILRMSREV: Approval Failed! Please Contact System Admin',
                        ));
                        return false;
                    }
                    else
                    {
                        $this->db->trans_commit();
                        $this->db2->trans_commit();
                        echo json_encode(array(
                            'responseType' => 2,
                            'message' => 'Case Successfuly Reverted to DC',
                        ));
                    }

                }

            }
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


    public function conversionLanding()
    {
        $user_code = $this->session->userdata('user_code');
        $dist_code     = trim($this->input->post('selectDistrict'));

        $designation = $this->session->userdata('designation');
        $data = array();

        if($designation  == DPT_PS)
        {
        $data['_view'] = 'conversion/conversion_landing_ps';
        }
        elseif($designation  == DPT_SO)
        {
        $data['verificationType'] = SO_VERIFICATION;
        $data['_view'] = 'conversion/conversion_landing_so';
        }
        elseif($designation  == ASSISTANT_USERCODE)
        {
        $data['verificationType'] = ASO_VERIFICATION;
        $data['_view'] = 'conversion/conversion_landing_asst';
        }
        else
        {

        $data['verificationType'] = JS_VERIFICATION;
        $data['_view'] = 'conversion/conversion_landing_js';
        }
        $this->load->view('layouts/main', $data);
    }

    public function viewConversionCases()
    {
        $dist_code   = $this->input->post('dist_code');
        $data = array();
        $data['dist_code'] =$dist_code;
        $data['dist_name'] = $this->utilclass->getDistrictName($dist_code);


        $this->db2 =  $this->dbswitch2($dist_code);

       // $data['conversionCaseList'] = $this->DeptConversionModel->getconversionCaseList($this->db2,$dist_code);
        $data['status'] = true;
        $this->load->view('conversion/conversion_case_list',$data);
	}


    public function getPendingConversionCaseList() 
    {
        $json = null;
        // echo "<pre/>";
        // print_r(strtoupper(trim($this->input->post('search')['value'])));
        // die;
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $dist_code = $this->input->post('dist_code');

        // $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));
        $searchByCol_0 = trim($this->input->post('search')['value']);

        $this->db2 =  $this->dbswitch2($dist_code);

        $case_list = $this->DeptConversionModel->getPendingCaseListDetails($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);
        // var_dump($case_list);exit;


        if(!empty($case_list)) {

        if($case_list['total_records'] >  0){

            $data_rows = $case_list['data_results'];

            foreach($data_rows as $row) {

                $url = base_url('DeptConversion/conversionCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);

                $case_no = "<small class='bg-'><i class='fa fa-archive'></i> " . $row->case_no . "</small>";

                // $rtps_app_no = "<br><small class='text-danger text-center'> " . $this->utilclass->getRtpsNoFromCaseNo($dist_code, $row->case_no)  ."</small>" ;

                $button = "<a href='".$url."' class='btn btn-sm btn-primary' target='_viewCaseDetails'><i class='fa fa-eye'></i></a>";

                $circle = "<small class='text-danger'>Circle:- " . $this->utilclass->getCircleName($row->dist_code, $row->subdiv_code, $row->cir_code) . "</small>";
                $mouza = "<br><small class='text-danger'>Mouza:- " . $this->utilclass->getMouzaName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code) . "</small>";
                $village = "<br><small class='text-danger'>Vill:-  " . $this->utilclass->getVillageName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code) . "</small>";


                $so_verification = $row->so_verification;
                $ast_verification = $row->ast_verification;
                $sec_verification = $row->sec_verification;
                $ps_verification = $row->ps_verification;

                if($so_verification == NULL){
                    $so_verification_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                }
                if($so_verification == 'S'){
                    $so_verification_status = '<small>Sent to SO <i class="fa fa-forward"></i></small>';
                }
                if($so_verification == 'A'){
                    $so_verification_status = '<small class="text-success">SO Verified <i class="fa fa-check-circle"></i></small>';

                }
                if($so_verification == 'R'){
                    $so_verification_status = '<small class="text-danger">Revert by SO <i class="fa fa-spinner fa-spin"></i></small>';
                }

                if($ast_verification == NULL){
                    $ast_verification_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                }
                if($ast_verification == 'S'){
                    $ast_verification_status = '<small>Sent to AST <i class="fa fa-forward"></i></small>';
                }
                if($ast_verification == 'A'){

                    $url = base_url('DeptConversion/viewAssistantVerificationDetails');
                    $url .= '?dist_code=' . urlencode($row->dist_code);
                    $url .= '&case_no=' . urlencode($row->case_no);

                    $ast_verification = '<small class="text-success">AST Verified</small></br>';
                    $viewBtn = "<a href='".$url."' class='btn btn-sm btn-success' target='_viewAstVerificationDetails'>view ASO Checklist Report</a>";
                    $ast_verification_status = $ast_verification . $viewBtn;
                }
                if($ast_verification == 'R'){
                    $url = base_url('DeptConversion/viewAssistantVerificationDetails');
                    $url .= '?dist_code=' . urlencode($row->dist_code);
                    $url .= '&case_no=' . urlencode($row->case_no);

                    $ast_verification = '<small class="text-danger">Reverted by AST </small></br>';
                    $viewBtn = "<a href='".$url."' class='btn btn-sm btn-danger' target='_viewAstVerificationDetails'>view ASO Checklist Report</a>";
                    $ast_verification_status = $ast_verification . $viewBtn;
                }

                if($sec_verification == NULL){
                    $sec_verification_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                }
                if($sec_verification == 'S'){
                    $sec_verification_status = '<small>Sent to Secretary <i class="fa fa-forward"></i></small>';
                }
                if($sec_verification == 'A'){
                    $sec_verification_status = '<small class="text-success">Secretary Verified <i class="fa fa-check-circle"></i></small>';
                }
                if($sec_verification == 'R'){
                    $sec_verification_status = '<small class="text-danger">Revert by Secretary <i class="fa fa-spinner fa-spin"></i></small>';
                }

                if($ps_verification == NULL){
                    $ps_verification_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                }
                if($ps_verification == 'S'){
                    $ps_verification_status = '<small>Sent to PS <i class="fa fa-forward"></i></small>';
                }
                if($ps_verification == 'A'){
                    $ps_verification_status = '<small class="text-success">PS Verified <i class="fa fa-check-circle"></i></small>';
                }
                if($ps_verification == 'R'){
                    $ps_verification_status = '<small class="text-danger">Revert by PS <i class="fa fa-spinner fa-spin"></i></small>';
                }

                $json[] = array(
                $row->case_no,
                $case_no,
                $circle . $mouza . $village,
                // $so_verification_status,
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



    public function getAllConversionCasePs() 
    {
        $json = null;

        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

        $this->db = $this->load->database('db2', TRUE);

        $case_list = $this->DeptConversionModel->getPendingCaseListPs($this->db,$start, $length, $order,$searchByCol_0);


        if(!empty($case_list)) {

        if($case_list['total_records'] >  0){

            $data_rows = $case_list['data_results'];

            foreach($data_rows as $row) {

                $url = base_url('DeptConversion/conversionCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);

                $case_no = "<small class=''><i class='fa fa-archive'></i> " . $row->case_no . "</small>";

                $district = "<small class=''>" . $this->utilclass->getDistrictNameOnLanding($row->dist_code) . "</small>";

                $date_entry = $row->created_at;

                $this->db2 =  $this->dbswitch2($row->dist_code);

                // $rtps_app_no = "<br><small class='text-primary text-center'> " . $this->utilclass->getRtpsNoFromCaseNo($row->dist_code, $row->case_no)  ."</small>" ;

                $button = "<a href='".$url."' class='rezaButt buttInfo'  target='_viewCaseDetails'><i class='fa fa-eye'></i> &nbsp;Details</a>";

                $circle = "<small class='text-primary'>Circle:- " . $this->utilclass->getCircleName($row->dist_code, $row->subdiv_code, $row->cir_code) . "</small>";
                $mouza = "<br><small class='text-primary'>Mouza:- " . $this->utilclass->getMouzaName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code) . "</small>";
                $village = "<br><small class='text-primary'>Vill:-  " . $this->utilclass->getVillageName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code) . "</small>";

                $json[] = array(
                $case_no,
                $district,
                $circle . $mouza . $village,
                '<small class="text-default"><i class="fa fa-calendar"></i> '. date("d M, Y", strtotime($date_entry)) .' </small>',
                $button,
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


    
    public function clearConversionCaseData()
    {
        $dist_code ='07';
        $this->db2 =  $this->dbswitch2($dist_code);

        $casesList = $this->db2->query("select * from petition_basic where mut_type ='01' and lm_note_yn='Y' and not_fresh ='Y' and bo_notice_gen ='Y'")->result();


        $updateArrDhar = [
            'add_off_desig' => 'DPT',
            'status' => 'W',
            'dept_note_yn' => null,
            'dept_order_no' => null,
            'dept_js_approve' => null,
            'dept_ps_approve' => null,
            'js_approve_date' => null,
            'ps_approve_date' => null,
            'add_cases_to_memo' => 'N',
            'so_verification' => NULL,
            'ast_verification' => NULL,
            'sec_verification' => NULL,
            'ps_verification' => NULL,  
            'add_to_proposal' => NULL,
            'ast_remarks' => NULL
        ];

        foreach($casesList as $cases)
        {

            $case_no = $cases->case_no;
            $dist_code = $cases->dist_code;

            $whereArr=[
                'case_no' => $case_no,
                'dist_code' => $dist_code,
            ];

            // $this->db2 =  $this->dbswitch2($dist_code);

            $updateDharitree=$this->DeptConversionModel->updatePetitionBasicForConversion($this->db2, $updateArrDhar, $whereArr);
            if($updateDharitree > 0){


                    $this->db = $this->load->database('db2', TRUE);

                    $this->db->truncate('proposal_list');
                    $this->db->truncate('conversion_case_list');
                    $this->db->truncate('conversion_proposal_case_list');
                    $this->db->truncate('conversion_cabinet_list');
                    $this->db->truncate('assistant_verification_details');
                    $this->db->truncate('conversion_reverted_case_list');
                    echo "Case Cleared Succussfully";

                    // $deleteIlrms=$this->DeptConversionModel->deleteConversionCases($this->db);

                }

        }


    }


    public function manageConversionCabinet()
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
        $data['_view'] = 'conversion/manage_cabinet_list';
        $this->load->view('layouts/main', $data);
    }

    public function getAllConversionCabinetList() 
    {    
        $json          = null;
        $user_code = $this->session->userdata('user_code');
        $draw          = intval($this->input->post('draw'));
        $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
        $start         = intval($this->input->post('start'));
        $length        = intval($this->input->post('length'));
        $order         = $this->input->post('order');
        $status        = $this->input->post('status');


        $conversionCabinetDetails = $this->DeptConversionModel->getConversionCabinetList($start, $length, $order,$status,$user_code);

        if(!empty($conversionCabinetDetails)) {

        if($conversionCabinetDetails['total_records'] > 0)
        {
            $data_rows = $conversionCabinetDetails['data_results'];

            foreach($data_rows as $row) {

            $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM conversion_cabinet_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

            $cab_memo_name = $sql->cab_memo_name;

            $created_at = date('d/m/Y',strtotime($row->created_at));

            $button = '<button type="button" class="btn btn-sm btn-danger" onclick="viewCaseDetail('."'".$row->cab_id."'".')"><i class="fa fa-edit"></i> &nbsp;Modify</button>';

            $delete_button = '<button type="button" class="btn btn-sm btn-danger" onclick="deleteCabMemoConversion('."'".$row->cab_id."'".')"><i class="fa fa-trash"></i> &nbsp;Delete</button>';
            
            $json[] = array(
                $cab_memo_name,
                '<small class="text-success">' . $row->cab_id .'</small>',
                '<small class="text-danger">' . $sql->dist_name .'</small>',
                $created_at,
                // $button . ' &nbsp ' .$delete_button,
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





    public function generateConversionCabinet() {

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
        $user_code = $this->session->userdata('user_code');

        $generate_cab    = 'CAB/CONV/'.date('Y').'/'.date('Y').$this->getSequence();

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
            $this->db->update('conversion_cabinet_list', $updateCab);
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
        ];
        $insertData = $this->db->insert('conversion_cabinet_list', $insCab);
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
        }
        else {
        echo json_encode(array(
            'responseType' => 1,
            'message'      => '#ERR167: No District selected',
        ));
        return;
        }      
    }

    public function getSequence() {
        $sequence = $this->db->query("select nextval('conversion_cabinet_list_id_seq') as count")->row();
        return $sequence->count;
    }

    public function deleteConversionCabinet() 
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
            $this->db->update('conversion_cabinet_list', $updateCab);
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

    public function getCabMemos() {

        $user_code = $this->session->userdata('user_code');
        $dist_code = $this->input->post('district_id');

        if (!$user_code || !$dist_code) {
        echo json_encode(['message' => 'User code or district ID missing.']);
        return;
        }
        $cabIdListConversion = $this->DeptConversionModel->getAllConversionCabList($dist_code,$user_code);

        if (empty($cabIdListConversion)) {
        $response = array('message' => 'No cab memos available. Please Create Cab Memo before adding Cases');
        } else {
            $response = $cabIdListConversion;
        }
        echo json_encode($response);
    }


    public function addConversionCasesToCabMemo()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

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
            } else 
            {
                if (!empty($allSelectedList)) 
                    {
                        foreach ($allSelectedList as $caseN) 
                        {
                            $case_no =$caseN;

                            $this->db->trans_begin();

                            $memo_name = $this->DeptConversionModel->getMemoNameByCabId($this->db,$cabmemo_id);

                            //Insert in CAB Memo  List
                            $insCabStack = [
                                'cab_id' => $cabmemo_id,
                                'case_no' => $case_no,
                                'user_code' => $user_code,
                                'dist_code' => $dist_code,
                                'status' => ADD_CASES_TO_CAB_MEMO,
                                'created_at' => date('Y-m-d h:i:s'),
                            ];

                            $insertCabList = $this->db->insert('conversion_case_list', $insCabStack);

                            if ($insertCabList != TRUE) {
                                $this->db->trans_rollback();
                                log_message('error', '#ERRDUPDATECSL001: Updation failed in conversion_case_list');
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

                                $updateCabIdList = $this->DeptConversionModel->updateConversionCabStatus($this->db,$where, $updateData);
                                if ($updateCabIdList <= 0) {
                                    $this->db->trans_rollback();
                                    log_message('error', '#ERRDUPDATE0001: Updation failed in conversion_cabinet_list for bulk Approve');
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
                                        'add_cases_to_memo' => 'Y',
                                    );

                                    $updatePetBasicStatus = $this->DeptConversionModel->updatePetitionBasicForCab($this->db2,$case_no, $dist_code, $updateData);


                                    if($updatePetBasicStatus <= 0){
                                    $this->db2->trans_rollback();
                                    log_message('error', '#ERRDUPDATBASICCAB: Updation failed in petition_basic for change cabinet status');
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

                        echo json_encode(array(
                            'responseType' => 2,
                            'message' => 'Cases Successfully Added to Cabinet Memo ' .$memo_name .'('. $cabmemo_id . ') for District ' . $district_name,

                        ));
                    }
            }
        }
    }


    public function toBeFinalizeConversionCabinet() 
    {
        $unique_user_id = $this->session->userdata('unique_user_id');
        $designation = $this->session->userdata('designation');

        if (($designation == DEPARTMENT_USERCODE) || ($unique_user_id == CONVERSION_USER)) {
        $data['_view'] = 'conversion/to_be_finalize_conversion_cabinet';
        $this->load->view('layouts/main', $data);
        } else {
        echo "User Not Authorized to View this Page";
        }
    }


    public function getTobeFinalizeConversionCabinet() 
    {
        $json = null;
        $user_code = $this->session->userdata('user_code');
        $draw = intval($this->input->post('draw'));
        $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');
        $status = ADD_CASES_UNDER_CAB_ID;

        $memo_list = $this->DeptConversionModel->getConversionCabinetList($start, $length, $order,$status,$user_code);

        if(!empty($memo_list)) {

        if($memo_list['total_records'] > 0){

            $data_rows = $memo_list['data_results'];

            foreach($data_rows as $row) {

            $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM conversion_cabinet_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

            $created_at = date('d-m-Y',strtotime($row->created_at));

            $link = base_url() . "index.php/DeptConversion/getListOfConversionCasesByCabId?cab_id=".$row->cab_id;
            $view_case = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-edit'></i> &nbsp;Manage Cases</a>";

            $generate_memo = '<button type="button" class="btn btn-sm btn-success" onclick="openModalMemoVGR('."'".$row->cab_id."'".')"><i class="fa fa-file"></i> &nbsp;Generate Memo</button>';

            $link2 = base_url() . "index.php/DeptConversion/downloadConversionCaseReport?cab_id=".$row->cab_id;
            $generate_report = "<a href=".$link2." class='btn btn-sm btn-primary' ><i class='fa fa-download'></i> &nbsp;Case Report</a>";

            $button = $generate_memo.' '.$view_case;

            
            $json[] = array(
                '<span class="text-danger"> '. $sql->cab_memo_name .'</span>',
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


    public function GenerateCabMemoConversion()
    {
        $data = array();
        $data['cab_id_memo'] = $cab_id_memo = $this->input->post('cab_id_memo');

        $distMeeting = $this->db->query("select  dist_code from conversion_case_list WHERE cab_id=? AND status=? group by dist_code", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->result();

        $data['emb'] = base_url().'assets/emblem-dark.png';

        $data['cab_memo_date'] = $this->input->post('cab_memo_date');
        $data['rev_cab_ref_no'] = $this->input->post('rev_cab_ref_no');
        $data['idc'] = $this->input->post('idc');
        $data['total_prop'] = 0;
        $res = $this->db->query("select count(*) as total from conversion_case_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->row();
        $dist_count = $this->db->query("select count(distinct dist_code) as total_dist from conversion_case_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->row();

        $dist_name = $this->db->query("select distinct dist_code  from conversion_case_list WHERE cab_id=? AND status=?", array($cab_id_memo, ADD_CASES_TO_CAB_MEMO))->result();

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


        if($errCheck == 0)
        {
            $this->load->view('conversion/conversion_memo_document.php', $data);  
        }

    }



    public function SavePDFMemoConversion()
    {
        $html1       = $this->input->post('html1');
        $html2       = $this->input->post('html2');
        $html3       = $this->input->post('html3');
        $html4       = $this->input->post('html4');
        $html11      = $this->input->post('html11');
        $html31      = $this->input->post('html31');
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

        $fileName    = 'CONVERSION_MEMO_' . $cabMemoId;

        // Include MPDF
        include 'vendor/mpdf/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();
        $waterMark = 'Conversion Cab Memo';
        $mpdf->SetWatermarkText($waterMark);
        $mpdf->showWatermarkText = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->writeHTML($html1 . $html2 . $html3 . $html4);

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

            $sql1 = "UPDATE conversion_cabinet_list SET upload_memo_path = ?, upload_memo_doc_path = ?, status = ?, updated_at = ?, finalized_at = ? WHERE user_code = ? AND status = ? AND cab_id = ?";

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
                log_message("error", "#ERROR_MEMO_GEN1 : Memo Generation Failed...Table conversion_cabinet_list " . $this->db->last_query());
                echo json_encode([
                    'responseType' => 3,
                    'message' => "#ERROR_MEMO_GEN1 : Memo Generation Failed..."
                ]);
                return;
            }

            $sql2 = "UPDATE conversion_case_list SET status = ?, final_status = ?, updated_at = ? WHERE user_code = ? AND status = ? AND cab_id = ?";

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
                log_message("error", "#ERROR_MEMO_GEN2 : Memo Generation Failed...Table conversion_case_list " . $this->db->last_query());
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
                'message' => "Successfully generated cabinet memo for the Cab Memo & Sent to PS for Approval :" . $cabMemoId
            ]);
    }

    public function finalizedConversionCabinet() 
    {
        $unique_user_id = $this->session->userdata('unique_user_id');
        $designation = $this->session->userdata('designation');

        if (($designation == DEPARTMENT_USERCODE) || ($unique_user_id == CONVERSION_USER)) {         
        $data['_view'] = 'conversion/finalized_conversion_cabinet';
        $this->load->view('layouts/main', $data);
        } else {
        echo "User Not Authorized to View this Page";
        }
    }

    public function getFinalizedConversionCabinet() 
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

        $memo_list = $this->DeptConversionModel->getPendingConversionCabinetList($start, $length, $order,$user_code);

        if(!empty($memo_list)) {

        if($memo_list['total_records'] > 0){

            $data_rows = $memo_list['data_results'];

            foreach($data_rows as $row) {

            $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM conversion_cabinet_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

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



    public function conversionPendingCabinetPS() 
    {
        if ($this->session->userdata('designation') == DPT_PS) {     
        $data['_view'] = 'conversion/conversion_pending_cabinet_ps';
        $this->load->view('layouts/main', $data);
        } else {
        echo "User Not Authorized to View this Page";
        }
    }



    
    public function approveConversionCabinetByPS() {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Invalid request method.'
            ));
            return;
        }

        // Get the raw POST data and decode the JSON
        $input = json_decode(trim(file_get_contents('php://input')), true);

        if (!isset($input['cabinet_id']) || empty($input['cabinet_id'])) {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Cabinet ID is required.'
            ));
            return;
        }

        $cabmemo_id = $input['cabinet_id'];


        $updateData = array('status' => APPROVE_CONVERSION_CABINET_PS);
        $where = array('cab_id' => $cabmemo_id);

        $this->db->trans_begin();

        $updateCabinetStatus = $this->DeptConversionModel->updateConversionCabStatus($this->db,$where, $updateData);

        if ($updateCabinetStatus <= 0) {
            // Rollback transaction and log error
            $this->db->trans_rollback();
            log_message('error', '#ERRAPPROVEPS1: Cabinet Approval Failed By PS');
            log_message('error', $this->db->last_query());

            // Send error response
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Approval Failed! Please Contact System Administrator !!',
            ));
            return false;
        } else {
            // Commit transaction
            $this->db->trans_commit();

            // Send success response
            echo json_encode(array(
                'responseType' => 2,
                'message' => 'Cabinet approved successfully.',
            ));
        }
    }

    public function viewConversionMemo_old()
    {
        $cab_id = $this->input->get('cab_id');

        $path = $this->db->query("SELECT upload_memo_path FROM conversion_cabinet_list WHERE cab_id=?",
                    array($cab_id))->row()->upload_memo_path;
        $mainfile = file_get_contents($path);
        header("Content-type: application/pdf");
        echo $mainfile;
    }

    public function viewConversionMemo()
    {
        $cab_id = $this->input->get('cab_id');

        if (!$cab_id) {
            log_message('error', 'Cabinet ID not provided');
            show_error('Cabinet ID not provided', 400);
            return;
        }

        $query = $this->db->query("SELECT upload_memo_path FROM conversion_cabinet_list WHERE cab_id = ?", array($cab_id));

        if ($query->num_rows() == 0) {
            log_message('error', 'Cabinet ID not found: ' . $cab_id);
            show_error('Cabinet ID not found', 404);
            return;
        }

        $path = $query->row()->upload_memo_path;

        if (!file_exists($path)) {
            log_message('error', 'File not found at path: ' . $path);
            show_error('File not found', 404);
            return;
        }

        $mainfile = file_get_contents($path);
        if ($mainfile === false) {
            log_message('error', 'Failed to read file at path: ' . $path);
            show_error('Failed to read file', 500);
            return;
        }

        header("Content-type: application/pdf");
        echo $mainfile;
    }


    ///Final Approve Conversion Cases by JS
    public function finalApproveConversionByJS_olddddddddddd()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $config=array(
        array('field'=>'cabinet_id','label'=>'Cabinet ID','rules'=>'required'),
        array('field'=>'order_no','label'=>'Dept Order','rules'=>'required'),
        array('field'=>'order_date','label'=>'Dept Date','rules'=>'required'),
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

        ///////Get Posted Data
        $cabinet_id = $this->input->post('cabinet_id');
        $dept_order_no = $this->input->post('order_no');
        $dept_order_date = $this->input->post('order_date');
        $entry_date =  date('Y-m-d',strtotime($dept_order_date));
        $user_code = $this->session->userdata('user_code');
        $unique_user_id = $this->session->userdata('unique_user_id');

        if($unique_user_id != CONVERSION_USER)
        {
            echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'User Not Authorized for this Process!!',
                ));
                return false;
        }

        $checkMemoStatus = $this->DeptConversionModel->checkCabMemoStatus($this->db,$cabinet_id);

        if($checkMemoStatus->status != "3")
        {
            echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'Cabinet Not Approved by PS!',
                ));
                return false;
        }

        $case_district = $this->DeptConversionModel->getDistrictUnderCabMemo($this->db,$cabinet_id)->result();

        foreach ($case_district as $dist) {
            $district = $dist->dist_code;
            $conversionCasesForFinalSubmitByDist = $this->DeptConversionModel->getConversionCasesForFinalSubmit($this->db, $cabinet_id, $user_code, $district)->result();
            
            if (empty($conversionCasesForFinalSubmitByDist)) {
                echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'No Cases Found for Final Approval Under Cabinet Memo!',
                ));
                return false;
            }

            foreach ($conversionCasesForFinalSubmitByDist as $row) {
                $case_no = $row->case_no;
                $this->db2 = $this->dbswitch2($district);

                // $proceeding_details = $this->db2->query("select co_order,note_on_order,dist_code,subdiv_code,cir_code from petition_proceeding_dc_adc where case_no = '$case_no' order by proceeding_id desc limit 1")->row();
                $pet_basic_details = $this->db2->query("select dist_code,subdiv_code,cir_code from petition_basic where case_no = '$case_no'")->row();

                // $co_order = $proceeding_details->co_order;
                $dist_code = $pet_basic_details->dist_code;
                $subdiv_code = $pet_basic_details->subdiv_code;
                $cir_code = $pet_basic_details->cir_code;

                $this->db2->trans_begin();

                $updateArrDhar = [
                    'dept_ps_approve' => 'Y',
                    'dept_js_approve' => 'Y',
                    'dept_note_yn' => 'Y',
                    'status' => 'P',
                    'add_off_desig' => 'DC',
                    'ps_approve_date' => date('Y-m-d h:i:s'),
                    'js_approve_date' => date('Y-m-d h:i:s'),
                    'dept_order_no' => $dept_order_no
                ];


                $whereArr = [
                    'case_no' => $case_no,
                    'dist_code' => $district,
                ];

                $updateDharitree = $this->DeptConversionModel->updatePetitionBasicForConversion($this->db2, $updateArrDhar, $whereArr);

                if ($updateDharitree <= 0) {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERRUPDATEFINAL001: Updation failed in petition_basic for final Update');
                    log_message('error', $this->db2->last_query());
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => '#ERRUPDATEFINAL001: Updation failed in petition_basic. Kindly contact System Administrator',
                    ));
                    return false;
                }

                $proceeding = $this->db2->query("SELECT COUNT(proceeding_id) AS proceed FROM petition_proceeding_dc_adc WHERE case_no = '$case_no' LIMIT 1")->result();
                $proceeding_id = $proceeding[0]->proceed + 1;

                if ($proceeding_id == null) {
                    $proceeding_id = 1;
                }

                $insPetProceed = [
                    'case_no' => $case_no,
                    'proceeding_id' => $proceeding_id,
                    'date_of_hearing' => $entry_date,
                    'note_on_order' => "Conversion Case Approved by Department. Department Order Number: " . $dept_order_no,
                    'status' => 'Pending',
                    'user_code' => $user_code,
                    'date_entry' => date('Y-m-d h:i:s'),
                    'operation' => 'E',
                    'dist_code' => $dist_code,
                    'subdiv_code' => $subdiv_code,
                    'cir_code' => $cir_code
                ];

                $insertProceeding = $this->db2->insert('petition_proceeding_dc_adc', $insPetProceed);

                if ($insertProceeding != 1) {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERRORSP001: Insertion failed in petition_proceeding_dc_adc for case no: ' . $case_no);
                    log_message('error', $this->db2->last_query());
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => '#ERRORSP001: Failed to insert. Kindly contact System Administrator',
                    ));
                    return false;
                } else {
                    $this->db2->trans_commit();
                    $this->db = $this->load->database('db2', TRUE);
                    $this->db->trans_begin();

                    $updateArrCabCasesIlrms = [
                        'status' => DPT_CONVERSION_FINAL_APPROVE,
                        'updated_at' => date('Y-m-d h:i:s'),
                    ];

                    $updateArrCabMemoIlrms = [
                        'status' => DPT_CONVERSION_FINAL_APPROVE,
                        'dept_order_no' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                        'approved_at' => date('Y-m-d h:i:s'),
                    ];

                    $whereCabMemo = [
                        'cab_id' => $cabinet_id,
                    ];

                    $updateCabCasesIlrms = $this->DeptConversionModel->updateConversionIlrmsByDpt($this->db, $updateArrCabCasesIlrms, $whereArr);

                    if ($updateCabCasesIlrms <= 0) {
                        $this->db->trans_rollback();
                        log_message('error', '#ERRDUPDATEILRMSMEMOCASE: Updation failed in ILRMS');
                        log_message('error', $this->db->last_query());
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRDUPDATEILRMSMEMOCASE: Approval Failed! Please Contact System Admin',
                        ));
                        return false;
                    } else {
                        $updateCabMemoIlrms = $this->DeptConversionModel->updateConversionCabStatus($this->db,$whereCabMemo, $updateArrCabMemoIlrms);
                        if ($updateCabMemoIlrms <= 0) {
                            $this->db->trans_rollback();
                            log_message('error', '#ERRDUPDATEILRMSFINALAPP: Updation failed in ILRMS');
                            log_message('error', $this->db->last_query());
                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => '#ERRDUPDATEILRMSFINALAPP: Approval Failed! Please Contact System Admin',
                            ));
                            return false;
                        }
                        else
                        {
                            $this->db->trans_commit();
                            echo json_encode(array(
                                'responseType' => 2,
                                'message' => 'Case Approved Successfully',
                            ));
                        }
                    }
                }
            }
        }
        
    }

    public function approvedConversionCabinet() 
    {
        $unique_user_id = $this->session->userdata('unique_user_id');
        $designation = $this->session->userdata('designation');

        if (($designation == DEPARTMENT_USERCODE) || ($unique_user_id == CONVERSION_USER)) {         
        $data['_view'] = 'conversion/approved_conversion_cabinet';
        $this->load->view('layouts/main', $data);
        } else {
        echo "User Not Authorized to View this Page";
        }
    }

    public function getApprovedConversionCabinet() 
    {
        $json = null;
        $user_code = $this->session->userdata('user_code');
        $designation = $this->session->userdata('designation');
        $draw = intval($this->input->post('draw'));
        $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $memo_list = $this->DeptConversionModel->getApprovedConversionCabinetList($start, $length, $order,$user_code);

        if(!empty($memo_list)) {

        if($memo_list['total_records'] > 0){

            $data_rows = $memo_list['data_results'];

            foreach($data_rows as $row) {

            $sql = $this->db->query("SELECT cab_memo_name, string_agg(dist_name,',') as dist_name FROM conversion_cabinet_list WHERE cab_id=? GROUP BY cab_id, cab_memo_name", array($row->cab_id))->row();

            $created_at = date('d-M-Y',strtotime($row->created_at));

            $link = base_url() . "index.php/DeptConversion/getListOfConversionCasesByCabId?cab_id=".$row->cab_id;
            $view_case = "<a href=".$link." class='btn btn-sm btn-warning' target='_blank'><i class='fa fa-eye'></i> &nbsp;View Cases</a>";
            

            $link2 = base_url() . "index.php/DeptConversion/viewConversionMemo?cab_id=".$row->cab_id;
            $view_memo = "<a href=".$link2." class='btn btn-sm btn-primary' target='_viewmemo'><i class='fa fa-eye'></i> &nbsp;View Memo</a>";

            $status = '<small class="text-success">Final Approved</small>';
            $button = $view_memo.' '.$view_case;

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

    public function getListOfConversionCasesByCabId()
    {
        $json = null;
        $user_code = $this->session->userdata('user_code');
        $cab_id = $this->input->get('cab_id');

        $this->db = $this->load->database('db2', TRUE);

        $memo_name = $this->DeptConversionModel->getMemoNameByCabId($this->db,$cab_id);

        $meeting_id = $this->db->query("SELECT DISTINCT dist_code FROM conversion_case_list WHERE cab_id=?  group by dist_code", 
                array($cab_id))->result();

        $data['cab_id'] = $cab_id;
        $data['memo_name'] = $memo_name;
        $data['_view'] = 'conversion/all_conversion_cases_under_cabinet';
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


        $cases_list = $this->DeptConversionModel->getAllCasesbyCabId($this->db,$start, $length, $order,$cab_id,$dist_code);


        if(!empty($cases_list)) {

        if($cases_list['total_records'] > 0){

            $data_rows = $cases_list['data_results'];

            foreach($data_rows as $row) {

                $case_no = "<small class='case-no-bg'><i class='fa fa-archive'></i>" . $row->case_no . "</small>";

                $district = "<small class='text-black'>" . $this->utilclass->getDistrictNameOnLanding($row->dist_code) ."</small>";

                $created_at = date('d-M-Y',strtotime($row->created_at));

                $url = base_url('DeptConversion/conversionCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);
                $button = "<a href='".$url."' class='rezaButt buttInfo'  target='_viewCaseDetails'><i class='fa fa-eye'></i> &nbsp;Case Details</a>";

            
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


    public function finalApproveConversionByJS()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $config=array(
            array('field'=>'cabinet_id','label'=>'Cabinet ID','rules'=>'required'),
            array('field'=>'order_no','label'=>'Dept Order','rules'=>'required'),
            array('field'=>'order_date','label'=>'Dept Date','rules'=>'required'),
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

        ///////Get Posted Data
        $cabinet_id = $this->input->post('cabinet_id');
        $dept_order_no = $this->input->post('order_no');
        $dept_order_date = $this->input->post('order_date');
        $entry_date =  date('Y-m-d',strtotime($dept_order_date));
        $user_code = $this->session->userdata('user_code');
        $unique_user_id = $this->session->userdata('unique_user_id');

        if($unique_user_id != CONVERSION_USER)
        {
            echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'User Not Authorized for this Process!!',
                ));
                return false;
        }

        $checkMemoStatus = $this->DeptConversionModel->checkCabMemoStatus($this->db,$cabinet_id);

        if($checkMemoStatus->status != "3")
        {
            echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'Cabinet Not Approved by PS!',
                ));
                return false;
        }

        $case_district = $this->DeptConversionModel->getDistrictUnderCabMemo($this->db,$cabinet_id)->result();

        foreach ($case_district as $dist) {
            $district = $dist->dist_code;
            $conversionCasesForFinalSubmitByDist = $this->DeptConversionModel->getConversionCasesForFinalSubmit($this->db, $cabinet_id, $user_code, $district)->result();
            
            if (empty($conversionCasesForFinalSubmitByDist)) {
                echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'No Cases Found for Final Approval Under Cabinet Memo!',
                ));
                return false;
            }

            $allTransactionsSuccessful = true;

            foreach ($conversionCasesForFinalSubmitByDist as $row) {
                $case_no = $row->case_no;
                $this->db2 = $this->dbswitch2($district);

                $pet_basic_details = $this->db2->query("SELECT dist_code,subdiv_code,cir_code FROM petition_basic WHERE case_no = ?", [$case_no])->row();

                if (!$pet_basic_details) {
                    log_message('error', 'Basic details not found for case number: ' . $case_no);
                    $allTransactionsSuccessful = false;
                    continue; // Skip this iteration if no basic details are found
                }

                $dist_code = $pet_basic_details->dist_code;
                $subdiv_code = $pet_basic_details->subdiv_code;
                $cir_code = $pet_basic_details->cir_code;

                $this->db2->trans_begin();

                $updateArrDhar = [
                    'dept_ps_approve' => 'Y',
                    'dept_js_approve' => 'Y',
                    'dept_note_yn' => 'Y',
                    'status' => 'P',
                    'add_off_desig' => 'DC',
                    'ps_approve_date' => date('Y-m-d H:i:s'),
                    'js_approve_date' => date('Y-m-d H:i:s'),
                    'dept_order_no' => $dept_order_no
                ];

                $whereArr = [
                    'case_no' => $case_no,
                    'dist_code' => $district,
                ];

                $updateDharitree = $this->DeptConversionModel->updatePetitionBasicForConversion($this->db2, $updateArrDhar, $whereArr);

                if ($updateDharitree <= 0) {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERRUPDATEFINAL001: Updation failed in petition_basic for final Update');
                    log_message('error', 'Query failed for case number: ' . $case_no);
                    $allTransactionsSuccessful = false;
                    continue;
                }

                $proceeding = $this->db2->query("SELECT COUNT(proceeding_id) AS proceed FROM petition_proceeding_dc_adc WHERE case_no = ? LIMIT 1", [$case_no])->result();
                $proceeding_id = $proceeding[0]->proceed + 1;

                if ($proceeding_id == null) {
                    $proceeding_id = 1;
                }

                $insPetProceed = [
                    'case_no' => $case_no,
                    'proceeding_id' => $proceeding_id,
                    'date_of_hearing' => $entry_date,
                    'note_on_order' => "Conversion Case Approved by Department. Department Order Number: " . $dept_order_no,
                    'status' => 'Pending',
                    'user_code' => $user_code,
                    'date_entry' => date('Y-m-d H:i:s'),
                    'operation' => 'E',
                    'dist_code' => $dist_code,
                    'subdiv_code' => $subdiv_code,
                    'cir_code' => $cir_code
                ];

                $insertProceeding = $this->db2->insert('petition_proceeding_dc_adc', $insPetProceed);

                if ($insertProceeding != 1) {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERRORSP001: Insertion failed in petition_proceeding_dc_adc for case no: ' . $case_no);
                    log_message('error', 'Query failed for case number: ' . $case_no);
                    $allTransactionsSuccessful = false;
                    continue;
                }

                $this->db2->trans_commit();

                $this->db = $this->load->database('db2', TRUE);
                $this->db->trans_begin();

                $updateArrCabCasesIlrms = [
                    'status' => DPT_CONVERSION_FINAL_APPROVE,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $updateArrCabMemoIlrms = [
                    'status' => DPT_CONVERSION_FINAL_APPROVE,
                    'dept_order_no' => $dept_order_no,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'approved_at' => date('Y-m-d H:i:s')
                ];

                $whereCabMemo = [
                    'cab_id' => $cabinet_id
                ];

                $updateCabCasesIlrms = $this->DeptConversionModel->updateConversionIlrmsByDpt($this->db, $updateArrCabCasesIlrms, $whereArr);

                if ($updateCabCasesIlrms <= 0) {
                    $this->db->trans_rollback();
                    log_message('error', '#ERRDUPDATEILRMSMEMOCASE: Updation failed in ILRMS');
                    log_message('error', 'Query failed for case number: ' . $case_no);
                    $allTransactionsSuccessful = false;
                    continue;
                }

                $updateCabMemoIlrms = $this->DeptConversionModel->updateConversionCabStatus($this->db, $whereCabMemo, $updateArrCabMemoIlrms);

                if ($updateCabMemoIlrms <= 0) {
                    $this->db->trans_rollback();
                    log_message('error', '#ERRDUPDATEILRMSFINALAPP: Updation failed in ILRMS');
                    log_message('error', 'Query failed for case number: ' . $case_no);
                    $allTransactionsSuccessful = false;
                    continue;
                }

                $this->db->trans_commit();
            }

            if ($allTransactionsSuccessful) {
                echo json_encode([
                    'responseType' => 2,
                    'message' => 'Case Approved Successfully'
                ]);
            } else {
                echo json_encode([
                    'responseType' => 1,
                    'message' => 'One or more cases failed to approve. Please check the logs for more details.'
                ]);
            }
        }
        
    }


    ///////////////////////Newly Added for New Flow//////////////////

    public function sentConversionCasesForVerification()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        // var_dump($_POST);exit;
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
            $dist_code          = $this->input->post('district_id');
            $verificationType   = $this->input->post('verificationType');
            $allSelectedList    = $this->input->post('selectedList');
            $remarks            = $this->input->post('remarks');

            // var_dump($allSelectedList);die;

                if (!empty($allSelectedList)) 
                    {
                        foreach ($allSelectedList as $caseN) 
                        {
                            $case_no =$caseN;

                                    if($verificationType == JS_VERIFICATION)
                                    {

                                        $this->db2 =  $this->dbswitch2($dist_code);

                                        $this->db2->trans_begin();
                                        $updateData = array(
                                            // 'so_verification' => 'S',
                                            'dept_js_approve' => 'A',
                                            'ast_verification' => 'S',
                                            'js_approve_date' => date('Y-m-d h:i:s')
                                        );

                                        //////proceeding start//////
                                        $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from petition_proceeding where case_no='$case_no' ")->row()->c;
                                    
                                        if ($proceeding_id == null) {
                                            $proceeding_id = 1;
                                        }
                                        $pettion_basic_row = $this->db2->query("select * from petition_basic where case_no=?",array($case_no))->row();

                                        $insSetProceed = [
                                            'dist_code'             => $dist_code,
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
                                            'note_on_order'         => $remarks ,
                                            'ip'                    => $_SERVER['REMOTE_ADDR'],
                                            'office_from'           => JS_OFFICE,
                                            'office_to'             => ASO_OFFICE,
                                            'task'                  => 'Forwared by JS',
                                            //'minutes_proposal_id'   => '00'
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
                                   


                                    $updatePetBasicStatus = $this->DeptConversionModel->updatePetitionBasicForCab($this->db2,$case_no, $dist_code, $updateData,$insSetProceed);

                                    if($updatePetBasicStatus == 'SERVER-ERROR'){
                                        $this->db2->trans_rollback();
                                        log_message('error', '#ERRDUPDATEPETTBASICPROCE: Updation failed in pettition basic and proceeding for change JS Verification Status');
                                        log_message('error', $this->db2->last_query());
                                        echo json_encode(array(
                                            'responseType' => 1,
                                            'message' => 'ERRDUPDATEPETTBASICPROCE: Failed cases for sent to Verification',
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
                        'message' => 'Cases Successfully Verified',
                    ));
                }
        }
        
    }


    public function viewConversionCasesDptSo()
    {
        $dist_code   = $this->input->post('dist_code');
        $data = array();
        $data['dist_code'] =$dist_code;
        $data['dist_name'] = $this->utilclass->getDistrictName($dist_code);

        $this->db2 =  $this->dbswitch2($dist_code);

        $data['status'] = true;
        $this->load->view('conversion/case_list_for_verification',$data);
	}


    public function getPendingConversionCaseListForVerification() 
    {
        $json = null;
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $dist_code = $this->input->post('dist_code');

        $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

        $this->db2 =  $this->dbswitch2($dist_code);

        $case_list = $this->DeptConversionModel->getPendingCaseListDetailsForVerificationSO($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);


        if(!empty($case_list)) {

        if($case_list['total_records'] >  0){

            $data_rows = $case_list['data_results'];

            foreach($data_rows as $row) {

                $url = base_url('DeptConversion/conversionCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);

                $case_no = "<small class='bg-'><i class='fa fa-archive'></i> " . $row->case_no . "</small>";

                $status = "<small class='text-danger'><i class='fa fa-undo'></i> Sent For Verification</small>";

                $button = "<a href='".$url."' class='btn btn-sm btn-primary' target='_viewCaseDetails'><i class='fa fa-eye'></i></a>";

                $circle = "<small class='text-primary'>Circle:- " . $this->utilclass->getCircleName($row->dist_code, $row->subdiv_code, $row->cir_code) . "</small>";
                $mouza = "<br><small class='text-primary'>Mouza:- " . $this->utilclass->getMouzaName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code) . "</small>";
                $village = "<br><small class='text-danger'>Vill:-  " . $this->utilclass->getVillageName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code) . "</small>";


                $ast_verification = $row->ast_verification;

                if($ast_verification == NULL){
                    $ast_verification_status = '<small class="text-danger"><i class="fa fa-undo"></i>Pending for AST Verification</small>';
                }
                if($ast_verification == 'S'){
                    $ast_verification_status = '<small class="">Sent to AST</small>';
                }
                if($ast_verification == 'A'){
                    $ast_verification_status = '<small class="text-success">AST Verified</small>';
                }
                if($ast_verification == 'R'){
                    $ast_verification_status = '<small class="text-warning">Revert by AST</small>';
                }

                $json[] = array(
                $row->case_no,
                $case_no,
                $circle . $mouza . $village,
                $ast_verification_status,
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

    public function viewConversionCasesDptAsst()
    {
        $dist_code   = $this->input->post('dist_code');
        $data = array();
        $data['dist_code'] =$dist_code;
        $data['dist_name'] = $this->utilclass->getDistrictName($dist_code);

        $this->db2 =  $this->dbswitch2($dist_code);

        $data['status'] = true;
        $this->load->view('conversion/case_list_pending_under_asst',$data);
	}


    public function getPendingConversionCaseListUnderAssistant() 
    {
        $json = null;
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $dist_code = $this->input->post('dist_code');

        // $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));
        $searchByCol_0 = trim($this->input->post('search')['value']);

        $this->db2 =  $this->dbswitch2($dist_code);

        $case_list = $this->DeptConversionModel->getPendingCaseListDetailsForVerificationAsst($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);


        if(!empty($case_list)) {

        if($case_list['total_records'] >  0){

            $data_rows = $case_list['data_results'];

            foreach($data_rows as $row) {

                $url = base_url('DeptConversion/conversionCaseDetails');
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


    public function conversionProposalCases()
    {
        $user_code = $this->session->userdata('user_code');
        $designation = $this->session->userdata('designation');
        $unique_user_id = $this->session->userdata('unique_user_id');

        $data = array();

        if (($designation == DEPARTMENT_USERCODE) || ($unique_user_id == CONVERSION_USER))       
        {
        $data['_view'] = 'conversion/conversion_cases_for_proposal_landing';
        }
        else
        {
        echo "User not Authorized";
        }
        $this->load->view('layouts/main', $data);
    }



    ////////Add Conversion Cases to Proposal///
    public function addConversionCasesToProposal()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');

        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Data not Found',
            ));
        } else 
        {
            $dist_code     = $this->input->post('district_id');
            $allSelectedList = $this->input->post('selectedList');
            $user_code = $this->session->userdata('user_code');
            $district_name = $this->utilclass->getDistrictNameOnLanding($dist_code);

            if (empty($allSelectedList)) 
            {
                echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'Validation Errors !. Please Select Cases',
                ));
                return;
            }
                $casesList = "'" . implode("', '", $allSelectedList) . "'";

                $this->db2 =  $this->dbswitch2($dist_code);


                ////////Check for unverified Cases///////////
                $checkUnverifiedCases = $this->DeptConversionModel->getAllUnverifiedPendingCases($this->db2,$casesList);
                $checkUnverifiedCasesCount = $checkUnverifiedCases->num_rows();

                if($checkUnverifiedCasesCount > 0)
                {
                    $unverifiedCasesList =$checkUnverifiedCases->result();
                    $unverifiedCaseNos = array_map(function ($item) {
                            return $item->case_no;
                        }, $unverifiedCasesList);

                    $allUnverifiedCases = implode(", ", $unverifiedCaseNos);

                     echo json_encode(array(
                        'responseType' => 3,
                        'message' => 'Verification Pending for Cases:  (' . $allUnverifiedCases . ') (***Please Verify through SO and ASO before Process***)',
                    ));
                    return;
                }
                ////////Check for unverified Cases End////////


                ////////Check for Case already present in Proposal List ///////////

                $this->db = $this->load->database('db2', TRUE);

                $checkExistingCases = $this->DeptConversionModel->getExistingCasesUnderProposal($this->db,$casesList);

                $checkExistingCasesCount = $checkExistingCases->num_rows();

                if($checkExistingCasesCount > 0)
                {
                    $existingCasesList =$checkExistingCases->result();
                    $existingCaseNos = array_map(function ($item) {
                            return $item->case_no;
                        }, $existingCasesList);

                    $allExistingCases = implode(", ", $existingCaseNos);

                     echo json_encode(array(
                        'responseType' => 3,
                        'message' => 'Cases:  (' . $allExistingCases . ') Already Exist Under Proposal',
                    ));
                    return;
                }
                ////////Check for Case already present in Proposal List  End///////////

                if (!empty($allSelectedList)) 
                    {
                        foreach ($allSelectedList as $caseN) 
                        {
                            $case_no =$caseN;

                            $this->db->trans_begin();
                            //Insert in conversion_proposal_case_list
                            $insProposal = [
                                'case_no' => $case_no,
                                'user_code' => $user_code,
                                'dist_code' => $dist_code,
                                'status' => 'P',
                                'created_at' => date('Y-m-d h:i:s'),
                            ];

                            $insertCabList = $this->db->insert('conversion_proposal_case_list', $insProposal);

                            if ($insertCabList != TRUE) {
                                $this->db->trans_rollback();
                                log_message('error', '#ERRDUPDATECPL001: Updation failed in conversion_proposal_case_list');
                                log_message('error', $this->db->last_query());

                                echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'Failed to Add Cases to Proposal',

                                ));
                                return false;
                            } else {

                                    $this->db->trans_commit();

                                    //change status in petition basic
                                    $this->db2 =  $this->dbswitch2($dist_code);

                                    $this->db2->trans_begin();

                                    $updateData = array(
                                        'add_to_proposal' => 'Y'
                                    );

                                    $updatePetBasicStatus = $this->DeptConversionModel->updatePetitionBasicForCab($this->db2,$case_no, $dist_code, $updateData);


                                    if($updatePetBasicStatus <= 0){
                                    $this->db2->trans_rollback();
                                    log_message('error', '#ERRDUPDATEPETBASICCAB: Updation failed in petition_basic for change add_to_proposal status');
                                    log_message('error', $this->db2->last_query());

                                    echo json_encode(array(
                                        'responseType' => 1,
                                        'message' => 'ERRDUPDATEPETBASICCAB: Failed to Add Cases to Proposals',

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
                            'message' => 'Cases Successfully Added for Proposal for District ' . $district_name,

                        ));
                    }
        }
    }


    public function viewConversionProposalCases()
    {
        $data = array();
        $this->load->view('conversion/conversion_proposal_case_list',$data);
	}



    public function getPendingConversionProposalCaseList() 
    {
        $json = null;

        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

        $this->db = $this->load->database('db2', TRUE);

        $case_list = $this->DeptConversionModel->getPendingProposalCaseListDetails($this->db,$start, $length, $order,$searchByCol_0);


        if(!empty($case_list)) {

        if($case_list['total_records'] >  0){

            $data_rows = $case_list['data_results'];

            foreach($data_rows as $row) {

                $url = base_url('DeptConversion/conversionCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);

                $case_no = "<small class='bg-'><i class='fa fa-archive'></i> " . $row->case_no . "</small>";
                $button = "<a href='".$url."' class='btn btn-sm btn-primary' target='_viewCaseDetails'><i class='fa fa-eye'></i></a>";

                $this->db2 =  $this->dbswitch2($row->dist_code);

                $locDetails = $this->utilclass->getLocationCaseDetailsFromPetBasic($this->db2, $row->case_no);

                $district_name = "<small class='text-primary'>" . $this->utilclass->getDistrictName($locDetails['dist_code']) . "</small>";

                $circle = "<small class='text-primary'>Circle:- " . $this->utilclass->getCircleName($locDetails['dist_code'], $locDetails['subdiv_code'], $locDetails['cir_code']) . "</small>";
                $mouza = "<br><small class='text-primary'>Mouza:- " . $this->utilclass->getMouzaName($locDetails['dist_code'], $locDetails['subdiv_code'], $locDetails['cir_code'], $locDetails['mouza_pargona_code']) . "</small>";
                $village = "<br><small class='text-danger'>Vill:-  " . $this->utilclass->getVillageName($locDetails['dist_code'], $locDetails['subdiv_code'], $locDetails['cir_code'], $locDetails['mouza_pargona_code'], $locDetails['lot_no'], $locDetails['vill_townprt_code']) . "</small>";

                $so_verification = $locDetails['so_verification'];
                $ast_verification = $locDetails['ast_verification'];

                if($so_verification == NULL){
                    $so_verification_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                }
                if($so_verification == 'S'){
                    $so_verification_status = '<small>Sent to SO <i class="fa fa-forward"></i></small>';
                }
                if($so_verification == 'A'){
                    $so_verification_status = '<small class="text-success">SO Verified <i class="fa fa-check-circle"></i></small>';
                }
                if($so_verification == 'R'){
                    $so_verification_status = '<small class="text-danger">Revert by SO <i class="fa fa-spinner fa-spin"></i></small>';
                }

                if($ast_verification == NULL){
                    $ast_verification_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                }
                if($ast_verification == 'S'){
                    $ast_verification_status = '<small>Sent to AST <i class="fa fa-forward"></i></small>';
                }
                if($ast_verification == 'A'){
                    $ast_verification_status = '<small class="text-success">AST Verified <i class="fa fa-check-circle"></i></small>';
                }
                if($ast_verification == 'R'){
                    $ast_verification_status = '<small class="text-danger">Revert by AST <i class="fa fa-spinner fa-spin"></i></small>';
                }

                $json[] = array(
                $row->case_no . '@' . $row->dist_code ,
                $case_no,
                $district_name,
                $circle . $mouza . $village,
                $so_verification_status,
                $ast_verification_status,
                '<small class="text-default"><i class="fa fa-calendar"></i> '. date("d M, Y", strtotime($locDetails['submission_date'])) .' </small>',
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

    ////////Generate Proposal List from Cases///
    public function generateProposalListFromCases()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');


        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors! Data not found',
            ));
            return; 
        } 
        
        $allSelectedList = $this->input->post('selectedList');
        $user_code = $this->session->userdata('user_code');

        // Check if selected list is empty
        if (empty($allSelectedList)) 
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Validation Errors! Please select cases',
            ));
            return; 
        }


        $this->db = $this->load->database('db2', TRUE);

        $this->db->trans_begin();

        //Generate Unque Proposal NO
            // $this->db->query("LOCK TABLES proposal_list WRITE");

            $lastProposal = $this->db->select('id')
                                    ->order_by('id', 'DESC')
                                    ->limit(1)
                                    ->get('proposal_list')
                                    ->row();

            if ($lastProposal) {
                $lastProposalNumber = $lastProposal->id;
                $newProposalNumber = $lastProposalNumber + 1;
            } else {
                $newProposalNumber = 1;
            }

            $proposalData = [
                'proposal_no' => $newProposalNumber,
                'status' => 'G',
                'user_code' => $user_code,
                'created_at' => date('Y-m-d h:i:s')
            ];
            $this->db->insert('proposal_list', $proposalData);
            $proposal_id = $this->db->insert_id();

            // $this->db->query("UNLOCK TABLES");
        //Generate Unque Proposal NO

        foreach ($allSelectedList as $caseN) 
        {
            $splitCaseNoDist = explode("@", $caseN);
            $case_no = $splitCaseNoDist[0];
            $dist_code = $splitCaseNoDist[1];

                $updateProposalListArr = [
                        'status' => 'G',
                        'proposal_no' => $proposal_id,
                        'updated_at' => date('Y-m-d h:i:s'),
                    ];

                    $whereArr = [
                        'case_no' => $case_no,
                        'dist_code' => $dist_code
                    ];


            $updateProposalList = $this->DeptConversionModel->updateConversionProposal($this->db, $updateProposalListArr, $whereArr);

            if ($updateProposalList <= 0) 
            {
                $this->db->trans_rollback();
                log_message('error', '#ERRDUPDATECPL001: update failed in conversion_proposal_case_list');
                log_message('error', $this->db->last_query());

                echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'Failed to Generate Proposal list',
                ));
                return;
            }
        }

        $this->db->trans_commit();

        echo json_encode(array(
            'responseType' => 2,
            'message' => 'Successfully Generated Proposal List',
        ));
    }


    public function conversionProposalList()
    {
        $user_code = $this->session->userdata('user_code');
        $designation = $this->session->userdata('designation');
        $unique_user_id = $this->session->userdata('unique_user_id');

        $data = array();

        // if (($designation == DEPARTMENT_USERCODE) || ($unique_user_id == CONVERSION_USER))
        // {
        // $data['_view'] = 'conversion/conversion_proposal_list_js';
        // }
        // elseif ($designation == DPT_PS)
        // {
        // $data['_view'] = 'conversion/conversion_proposal_list_ps';
        // }
        // else
        // {
        // echo "User not Authorized";
        // }
        $data['_view'] = 'conversion/conversion_proposal_list_js';

        $this->load->view('layouts/main', $data);
    }

    public function getGeneratedProposalList() 
    {
        $json = null;
        $user_code = $this->session->userdata('user_code');
        $designation = $this->session->userdata('designation');
        $unique_user_id = $this->session->userdata('unique_user_id');
        $draw = intval($this->input->post('draw'));
        $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $proposal_list = $this->DeptConversionModel->getGeneratedProposalListData($start, $length, $order);

        if(!empty($proposal_list)) {

        if($proposal_list['total_records'] > 0){

            $data_rows = $proposal_list['data_results'];

            foreach($data_rows as $row) {


            $created_at = date('d-m-Y',strtotime($row->created_at));

            $link = base_url() . "index.php/DeptConversion/getListOfCasesByProposalId?proposal_no=".$row->id;
            $view_case = "<a href=".$link." class='btn btn-sm btn-warning' target='_caseListDetails'><i class='fa fa-edit'></i> &nbsp;Case List</a>";

           
            $link2 = base_url() . "index.php/DeptConversion/downloadConversionCaseReport?proposal_no=".$row->id;
            $generate_report = "<a href=".$link2." class='btn btn-sm btn-primary' target='_caseReportDetails'><i class='fa fa-download'></i> &nbsp;Case Report</a>";

            if (($designation == DEPARTMENT_USERCODE) || ($unique_user_id == CONVERSION_USER))
            {   
                if($row->status == 'G')
                {
                    $sent_for_verify = "<button class='btn btn-sm btn-success' id='sentProposalToSec' value=".$row->id."><i class='fa fa-plus' aria-hidden='true'></i>Send to Secretary</button>";
                    $button = $generate_report.' '.$view_case.' '.$sent_for_verify;
                }
                else
                {
                    $button = $generate_report.' '.$view_case;
                }

            }
            if ($designation == DPT_SEC)
            {

                if($row->ps_status == NULL)
                {
                    $sent_for_verify = "<button class='btn btn-sm btn-success' id='sentProposalToPS' value=".$row->id."><i class='fa fa-plus' aria-hidden='true'></i>Verify & Send to PS</button>";
                    $button = $generate_report.' '.$view_case.' '.$sent_for_verify;
                }
                else
                {
                    $button = $generate_report.' '.$view_case;
                }

            }
            if ($designation == DPT_PS)
            {
                $button = $generate_report.' '.$view_case;
                if($row->ps_status == 'S')
                {
                    $sent_for_verify = "<button class='btn btn-sm btn-success' id='verifyProposalByPS' value=".$row->id."><i class='fa fa-plus' aria-hidden='true'></i>Verify & Approve</button>";
                    $button = $generate_report.' '.$view_case.' '.$sent_for_verify;
                }
                else
                {
                    $button = $generate_report.' '.$view_case;
                }
            }


            $proposal_status = $row->status;

            if($proposal_status == 'G')
            {
                $status = '<span class="text-danger">Pending</span>';
            }
            elseif($proposal_status == 'S')
            {
                $status = '<span class="text-danger">Sent to Secretary</span>';
            }
            elseif($proposal_status == 'A')
            {
                $status = '<span class="text-danger">Secretary Approved </span>';
            }
            else
            {
                $status = '<span class="text-danger"></span>';
            }



            $json[] = array(
                '<span class="text-danger"> Proposal-'. $row->id .'</span>',
                '<span class="text-primary"> '. $created_at .'</span>',
                // '<small class="text-primary"> '. $sql->dist_name .'</small>',
                $status,
                $button,
            );
            }
        }
        else {
            $json = "";
        }      

        $total_records = $proposal_list['total_records'];
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


    public function getListOfCasesByProposalId()
    {
        $json = null;
        $user_code = $this->session->userdata('user_code');
        $proposal_no = $this->input->get('proposal_no');

        $this->db = $this->load->database('db2', TRUE);

        $dist_list = $this->db->query("SELECT DISTINCT dist_code FROM conversion_proposal_case_list WHERE proposal_no=?", array($proposal_no))->result();

        $data['proposal_no'] = $proposal_no;
        $data['dist_list'] = $dist_list;
        $data['_view'] = 'conversion/all_conversion_caases_under_proposal';
        $this->load->view('layouts/main', $data);
    }


    public function getAllCasesUnderProposalId() 
    {
        $json = null;
        $user_code = $this->session->userdata('user_code');
        $proposalId = $this->input->post('proposalId');
        $dist_code = $this->input->post('selectDistrict');
        $draw = intval($this->input->post('draw'));
        $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $this->db = $this->load->database('db2', TRUE);

        $cases_list = $this->DeptConversionModel->getAllCaseListbyProposalId($this->db,$start, $length, $order,$proposalId,$dist_code);

        if(!empty($cases_list)) {

        if($cases_list['total_records'] > 0){

            $data_rows = $cases_list['data_results'];

            foreach($data_rows as $row) {

                $case_no = "<small class='case-no-bg'><i class='fa fa-archive'></i>" . $row->case_no . "</small>";

                $district = "<small class='text-black'>" . $this->utilclass->getDistrictNameOnLanding($row->dist_code) ."</small>";

                $created_at = date('d-M-Y',strtotime($row->created_at));

                $url = base_url('DeptConversion/conversionCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);
                $button = "<a href='".$url."' class='rezaButt buttInfo'  target='_viewCaseDetails'><i class='fa fa-eye'></i> &nbsp;Case Details</a>";

            
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

    public function sendConversionProposalToSec()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('proposalNo', 'proposal No', 'required');


        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Proposal No Not Found',
            ));
        } else 
        {
            $proposalNo     = $this->input->post('proposalNo');
            $user_code = $this->session->userdata('user_code');
            $designation = $this->session->userdata('designation');

                ///get all Cases under Proposal/////
                $this->db = $this->load->database('db2', TRUE);

                $case_list = $this->DeptConversionModel->getAllCasesByProposalId($this->db,$proposalNo);
                if($case_list->num_rows() <= 0)
                {
                    echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'No Cases Found Under Proposal',

                    ));
                    return;
                }

                $case_list_result = $case_list->result();

                if (!empty($case_list_result)) 
                    {
                        foreach ($case_list_result as $caseN) 
                        {
                            $case_no = $caseN->case_no;
                            $dist_code = $caseN->dist_code;

                            $this->db->trans_begin();

                            $updateArrPropList = [
                                'status' => 'S',
                                'updated_at' => date('Y-m-d h:i:s'),
                            ];

                            $whereArrPropList = [
                                'id' => $proposalNo,
                            ];

                            $updateProposalList = $this->DeptConversionModel->updateProposalList($this->db,$updateArrPropList,$whereArrPropList);
                            

                            if ($updateProposalList <= 0) {
                                $this->db->trans_rollback();
                                log_message('error', '#ERRDUPDATECSL001PROP: Updation failed in proposal_list');
                                log_message('error', $this->db->last_query());

                                echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'Failed to send Cases for verification',

                                ));
                                return false;
                                } else {
                                    $this->db->trans_commit();

                                    $this->db2 =  $this->dbswitch2($dist_code);

                                    $this->db2->trans_begin();

                                    $updateData = array(
                                        'sec_verification' => 'S',
                                    );

                                    $updatePetBasicStatus = $this->DeptConversionModel->updatePetitionBasicForCab($this->db2,$case_no, $dist_code, $updateData);


                                    if($updatePetBasicStatus <= 0){
                                    $this->db2->trans_rollback();
                                        log_message('error', '#ERRDUPDATPETBASICSEC: Updation failed in petition_basic');
                                        log_message('error', $this->db2->last_query());

                                    echo json_encode(array(
                                        'responseType' => 1,
                                        'message' => 'ERRDUPDATPETBASICSEC: Failed to sent',

                                    ));
                                    return false;

                                    }else{

                                    $this->db2->trans_commit();

                                    }

                                }
                        }
                        
                        echo json_encode(array(
                            'responseType' => 2,
                            'message' => 'Cases Successfully Sent to Secretary under  proposal: ' .$proposalNo,

                        ));
                    }
        }
    }

    public function sendConversionProposalToPS()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('proposalNo', 'proposal No', 'required');


        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Proposal No Not Found',
            ));
        } else 
        {
            $proposalNo     = $this->input->post('proposalNo');
            $user_code = $this->session->userdata('user_code');
            $designation = $this->session->userdata('designation');

                ///get all Cases under Proposal/////
                $this->db = $this->load->database('db2', TRUE);

                $case_list = $this->DeptConversionModel->getAllCasesByProposalId($this->db,$proposalNo);
                if($case_list->num_rows() <= 0)
                {
                    echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'No Cases Found Under Proposal',

                    ));
                    return;
                }

                $case_list_result = $case_list->result();

                if (!empty($case_list_result)) 
                    {
                        foreach ($case_list_result as $caseN) 
                        {
                            $case_no = $caseN->case_no;
                            $dist_code = $caseN->dist_code;

                            $this->db->trans_begin();

                            $updateArrPropList = [
                                'status' => 'A',
                                'ps_status' => 'S',
                                'updated_at' => date('Y-m-d h:i:s'),
                            ];

                            $whereArrPropList = [
                                'id' => $proposalNo,
                            ];

                            $updateProposalList = $this->DeptConversionModel->updateProposalList($this->db,$updateArrPropList,$whereArrPropList);
                            

                            if ($updateProposalList <= 0) {
                                $this->db->trans_rollback();
                                log_message('error', '#ERRDUPDATECSL001PROP: Updation failed in proposal_list');
                                log_message('error', $this->db->last_query());

                                echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'Failed to send Cases for verification',

                                ));
                                return false;
                                } else {
                                    $this->db->trans_commit();

                                    $this->db2 =  $this->dbswitch2($dist_code);

                                    $this->db2->trans_begin();

                                    $updateData = array(
                                        'sec_verification' => 'A',
                                        'ps_verification' => 'S',
                                    );

                                    $updatePetBasicStatus = $this->DeptConversionModel->updatePetitionBasicForCab($this->db2,$case_no, $dist_code, $updateData);


                                    if($updatePetBasicStatus <= 0){
                                    $this->db2->trans_rollback();
                                        log_message('error', '#ERRDUPDATPETBASICSEC: Updation failed in petition_basic');
                                        log_message('error', $this->db2->last_query());

                                    echo json_encode(array(
                                        'responseType' => 1,
                                        'message' => 'ERRDUPDATPETBASICSEC: Failed to sent',

                                    ));
                                    return false;

                                    }else{

                                    $this->db2->trans_commit();

                                    }

                                }
                        }
                        
                        echo json_encode(array(
                            'responseType' => 2,
                            'message' => 'Cases Successfully Sent to Principal Secretary under  proposal: ' .$proposalNo,

                        ));
                    }
        }
    }


    public function verifyApproveConversionProposalByPS()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('proposalNo', 'proposal No', 'required');


        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Proposal No Not Found',
            ));
        } else 
        {
            $proposalNo     = $this->input->post('proposalNo');
            $user_code = $this->session->userdata('user_code');
            $designation = $this->session->userdata('designation');

                ///get all Cases under Proposal/////
                $this->db = $this->load->database('db2', TRUE);

                $case_list = $this->DeptConversionModel->getAllCasesByProposalId($this->db,$proposalNo);
                if($case_list->num_rows() <= 0)
                {
                    echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'No Cases Found Under Proposal',

                    ));
                    return;
                }

                $case_list_result = $case_list->result();

                if (!empty($case_list_result)) 
                    {
                        foreach ($case_list_result as $caseN) 
                        {
                            $case_no = $caseN->case_no;
                            $dist_code = $caseN->dist_code;

                            $this->db->trans_begin();

                            $updateArrPropList = [
                                'ps_status' => 'A',
                                'updated_at' => date('Y-m-d h:i:s'),
                            ];

                            $whereArrPropList = [
                                'id' => $proposalNo,
                            ];

                            $updateProposalList = $this->DeptConversionModel->updateProposalList($this->db,$updateArrPropList,$whereArrPropList);
                            

                            if ($updateProposalList <= 0) {
                                $this->db->trans_rollback();
                                log_message('error', '#ERRDUPDATECSL001PROP: Updation failed in proposal_list');
                                log_message('error', $this->db->last_query());

                                echo json_encode(array(
                                    'responseType' => 1,
                                    'message' => 'Failed to send Cases for verification',

                                ));
                                return false;
                                } else {
                                    $this->db->trans_commit();

                                    $this->db2 =  $this->dbswitch2($dist_code);

                                    $this->db2->trans_begin();

                                    $updateData = array(
                                        'ps_verification' => 'A',
                                    );

                                    $updatePetBasicStatus = $this->DeptConversionModel->updatePetitionBasicForCab($this->db2,$case_no, $dist_code, $updateData);


                                    if($updatePetBasicStatus <= 0){
                                    $this->db2->trans_rollback();
                                        log_message('error', '#ERRDUPDATPETBASICSEC: Updation failed in petition_basic');
                                        log_message('error', $this->db2->last_query());

                                    echo json_encode(array(
                                        'responseType' => 1,
                                        'message' => 'ERRDUPDATPETBASICSEC: Failed to sent',

                                    ));
                                    return false;

                                    }else{

                                    $this->db2->trans_commit();

                                    }

                                }
                        }
                        
                        echo json_encode(array(
                            'responseType' => 2,
                            'message' => 'Cases Successfully Verified under  proposal: ' .$proposalNo,

                        ));
                    }
        }
    }



    public function downloadConversionCaseReport()
    {

        $this->downloadCaseReportByProposal();
        exit;
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

        $proposal_no = $this->input->get('proposal_no');


        $htmlTag = '';
        $htmlTag .= '<h3 style="text-align: center;">Annexure -I <br>Report of Cases Under Proposal : ' . $proposal_no . '</u></h3>';

        $table1 = '<table cellpadding="5px" autosize="1" border="1" width="100%" style="overflow: wrap">
            <thead>
            <tr>
                <th >Sl No. </th>
                <th >District </th>
                <th >Case No </th>
            </tr>
            </thead>
            <tbody>';

        $this->db = $this->load->database('db2', TRUE);

        $case_details = $this->DeptConversionModel->getAllCasesByProposalId($this->db,$proposal_no)->result();


        $table2 = ''; 
        $count = 1;
        $main_array = array();   

        foreach ($case_details as $details) {
        $dist_name = $this->utilclass->getDistrictNameOnLanding($details->dist_code);
                    $table2 .= '<tr>
                        <td>' . $count++ . '</td>
                        <td>' . $dist_name . '</td>
                        <td style="color:blue">' . $details->case_no . '</td>  
                    </tr>';
                }
            
        $table3 = '</tbody></table>';
        $table = $table1 . $table2 . $table3;
        $final = $htmlTag . $table;
        $report_name = 'Case_Report_Proposal_' . $proposal_no . '.pdf';

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->writeHTML($final);
        header('Content-type: application/pdf');
        $mpdf->Output($report_name, 'd');
    }


    public function downloadCaseReportByProposal()
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

        $proposal_no = $this->input->get('proposal_no');

        $htmlTag = '';
        $htmlTag .= '<h3 style="text-align: center;">Annexure -I <br>Report of Cases Under Proposal : ' . $proposal_no . '</u></h3>';

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

        $case_details = $this->DeptConversionModel->getAllCasesByProposalId($this->db,$proposal_no)->result();

        $table2 = '';
        $count = 1;
        $main_array = array();   

        foreach ($case_details as $details) {

            $district = $details->dist_code;

            $this->db2 = $this->dbswitch2($district);

                    $case_no = $details->case_no;
                    
                    if (in_array($case_no, $main_array))
                       continue;

                    $petition_basic = $this->DeptConversionModel->getPetitionBasicDetails($this->db2,$case_no)->row();

                    if ($petition_basic == null)
                       continue;

                    $main_array[] = $case_no;
                    $landdetails = $this->DeptConversionModel->getLandDetails($this->db2,$petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code, $petition_basic->mouza_pargona_code, $petition_basic->lot_no, $petition_basic->vill_townprt_code, $petition_basic->petition_no)->row();

                    // $applicants   = $this->DeptConversionModel->getAllApplicantBuyersName($this->db2,$case_no)->result();
                    $applicants = $this->DeptConversionModel->getPattadardetails($this->db2,$petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code, $petition_basic->mouza_pargona_code, $petition_basic->lot_no, $petition_basic->vill_townprt_code, $petition_basic->petition_no, $landdetails->dag_no, $landdetails->patta_no, $landdetails->patta_type_code)->result();


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


                    $dagNos = $landdetails->dag_no;

                    // var_dump($dagNos);die;


                    // $commaSeparatedDags = implode(",", $dagNos);

                    $commaSeparatedNames = implode(",", $appNames);

                    $commaSeparatedAddress1 = implode(",", $appAddress1);

                    $dagsArea = $this->utilclass->dagAreabyCaseNo($petition_basic->dist_code, $case_no);

                    $district_name = $this->utilclass->getDistrictName($petition_basic->dist_code);

                    $circle_name = $this->utilclass->getCircleName($petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code);

                    $village_name = $this->utilclass->getVillageName($petition_basic->dist_code, $petition_basic->subdiv_code, $petition_basic->cir_code, $petition_basic->mouza_pargona_code, $petition_basic->lot_no, $petition_basic->vill_townprt_code);

                    // $sdlacStatus = $this->DeptConversionModel->sdlacCaseStatus($case_no)->row();

                    // $settlement_enc = $this->DeptConversionModel->getSettlementEncroacher($case_no);

                    // $landless = $this->DeptConversionModel->getLandLessVerify($case_no)->row();

                    // $geo_tag = $this->DeptConversionModel->getGeoTag($case_no);

                    // $house_type = $this->utilclass->getHouseTypeByCaseNo($petition_basic->dist_code, $case_no);

                    $zonal_value = $this->utilclass->getZonalValueByCaseNo($petition_basic->dist_code, $case_no);

                    // var_dump($zonal_value);die;


                    // if (count($geo_tag) > 0) {

                    //     $geo_tag_yn = 'Yes';
                    // } else {

                    //     $geo_tag_yn = 'No';
                    // }


                    // foreach ($applicants as $app) {

                    //     $appGender = $this->utilclass->getGender($app->pdar_gender);
                    // }

                    //<td>' . date("j F, Y", strtotime($sdlacStatus->case_status)) . '</td>
                    // $table2 .= '<tr>
                    //     <td>' . $count++ . '</td>
                    //     <td>' . $district_name . '</td>
                    //     <td style="color:blue">' . $case_no . '</td>
                    //     <td>' . $commaSeparatedNames . ' (Add: ' . $commaSeparatedAddress1 . ')</td>
                    //     <td style="color:blue">' . $commaSeparatedDags . '</td>
                    //     <td>' . $dagsArea . '</td>
                    //     <td>' . $circle_name . '</td>
                    //     <td>' . $village_name . '</td>
                    //     <td>' . $house_type . '</td>
                    //     <td>' . $sdlacStatus->case_status . '</td>
                    //     <td>' . date("j F, Y", strtotime($petition_basic['sdlac_date'])) . '</td>
                    //     <td>' . date("j F, Y", strtotime($settlement_enc->period_possession)) . ' (' . ($petition_basic['occupation_applicant']) .  ')</td>
                    //     <td>' . $appGender .  '</td>
                    //     <td style="color:blue">' . $zonal_value .  '</td>
                    //     <td>' . $landless->is_landless .  '</td>
                    //     <td>' . $geo_tag_yn .  '</td>
                    //     <td>' . 'RECOMMENDED' .  '</td>
                    //     <td>' . '' .  '</td>    
                    // </tr>';


                $table2 .= '<tr>
                        <td>' . $count++ . '</td>
                        <td>' . $district_name . '</td>
                        <td style="color:blue">' . $case_no . '</td>
                        <td>' . $commaSeparatedNames . ' (Add: ' . $commaSeparatedAddress1 . ')</td>
                        <td style="color:blue">' . $dagNos . '</td>
                        <td>' . $dagsArea . '</td>
                        <td>' . $circle_name . '</td>
                        <td>' . $village_name . '</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="color:blue">' . $zonal_value .  '</td>
                        <td></td>
                        <td></td>
                        <td>' . 'RECOMMENDED' .  '</td>
                        <td>' . '' .  '</td>    
                    </tr>';
                // }
                log_message('error', 'downloadReportForCabMemo:  2222 dist: '.$district);
        }
        $table3 = '</tbody></table>';
        $table = $table1 . $table2 . $table3;
        $final = $htmlTag . $table;
        $report_name = 'Proposal_case_Report' . $proposal_no . '.pdf';

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->writeHTML($final);
        header('Content-type: application/pdf');
        $mpdf->Output($report_name, 'I');
    }


    public function verifyCasesByAssistant()
    {
        $this->form_validation->set_rules('distCodeAst', 'Dist Code', 'required');
        $this->form_validation->set_rules('verifyStatus', 'Verification Type', 'required');
        $this->form_validation->set_rules('subdivCodeAst', 'Subdiv Code', 'required');
        $this->form_validation->set_rules('cirCodeAst', 'Cir Code', 'required');
        $this->form_validation->set_rules('caseNoAst', 'Case No', 'required');
        $this->form_validation->set_rules('apLandTransfer', 'AP Land Transfer', 'required');
        $this->form_validation->set_rules('occupationApplicant', 'Land is under the occupation of the applicant', 'required');
        $this->form_validation->set_rules('natureOccupation', 'Nature of Occupation', 'required');
        $this->form_validation->set_rules('tribalBeltYn', 'Whether AP land falls within Tribal Belt', 'required');
        $this->form_validation->set_rules('traceMapYn', 'Trace Map / Chitha / Jamabandi', 'required');
        $this->form_validation->set_rules('ruleAlrm', 'Rule 105 of ALRM', 'required');
        $this->form_validation->set_rules('ruleAlrr', 'Rule 23 of ALRR', 'required');
        $this->form_validation->set_rules('landPolicy', 'Land Policy, 2019', 'required');
        $this->form_validation->set_rules('premiumRate', 'Rate of Premium', 'required|numeric');
        $this->form_validation->set_rules('assistantRemarks', 'Remarks', 'required');

        if ($this->form_validation->run() == FALSE) {
            $errors = [];
            foreach ($this->form_validation->error_array() as $field => $error) {
                $errors[] = [
                    'field' => $field,
                    'message' => $error
                ];
            }

            echo json_encode([
                'responseType' => 4,
                'errors' => $errors
            ]);
            return;
        }


        ///////Get Posted Data
        $verifyStatus = $this->input->post('verifyStatus');
        $dist_code = $this->input->post('distCodeAst');
        $subdiv_code = $this->input->post('subdivCodeAst');
        $cir_code = $this->input->post('cirCodeAst');
        $case_no = $this->input->post('caseNoAst');
        $apLandTransfer = $this->input->post('apLandTransfer');
        $occupationApplicant = $this->input->post('occupationApplicant');
        $natureOccupation = $this->input->post('natureOccupation');
        $occupationApplicant = $this->input->post('occupationApplicant');
        $tribalBeltYn = $this->input->post('tribalBeltYn');
        $traceMapYn = $this->input->post('traceMapYn');
        $ruleAlrm = $this->input->post('ruleAlrm');
        $ruleAlrr = $this->input->post('ruleAlrr');
        $landPolicy = $this->input->post('landPolicy');
        $premiumRate = $this->input->post('premiumRate');
        $assistantRemarks = $this->input->post('assistantRemarks');
        $user_code = $this->session->userdata('user_code');

        $this->db = $this->load->database('db2', TRUE);

        $checkVerification = $this->DeptConversionModel->checkCaseVerificationByAsst($this->db,$case_no)->num_rows();

        if($checkVerification > 0)
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Case No: ' . $case_no .' is already Verified  !!',
            ));
            return false;
        }


        $this->db2 =  $this->dbswitch2($dist_code);

        $proceeding_details = $this->db2->query("select co_order,note_on_order from petition_proceeding_dc_adc where case_no = '$case_no' order by proceeding_id desc limit 1")->row();

        $co_order = $proceeding_details->co_order;

        if($verifyStatus == "" || $verifyStatus == NULL)
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Not getting Verification Type !!',
            ));
            return false;
        }
        if($verifyStatus == "A")
        {
            $updateArrDhar = [
                'ast_verification' => 'A',
                'ast_remarks' => $assistantRemarks
            ];
        }
        if($verifyStatus == "R")
        {
            $updateArrDhar = [
                'ast_verification' => 'R',
                'ast_remarks' => $assistantRemarks
            ];
        }


        $whereArr=[
            'case_no' => $case_no,
            'dist_code' => $dist_code,
        ];

        $insertArrIlrms = [
            'case_no' => $case_no,
            'user_code' => $user_code,
            'dist_code' => $dist_code,
            'ap_land_transfer' => $apLandTransfer,
            'occupation_applicant' => $occupationApplicant,
            'nature_occupation' => $natureOccupation,
            'tribal_belt_yn' => $tribalBeltYn,
            'trace_map_yn' => $traceMapYn,
            'rule_alrm_yn' => $ruleAlrm,
            'rule_alrr_yn' => $ruleAlrr,
            'land_policy' => $landPolicy,
            'premium_rate_percent' => $premiumRate,
            'remarks' => $assistantRemarks,
            'status' => 'A',
            'created_at' => date('Y-m-d h:i:s')
        ];

        $this->db2->trans_begin();
        $this->db->trans_begin();

        $updateDharitree=$this->DeptConversionModel->updatePetitionBasicForConversion($this->db2, $updateArrDhar, $whereArr);

            if($updateDharitree <= 0)
            {
                $this->db2->trans_rollback();
                $this->db->trans_rollback();
                log_message('error', '#ERRDUPDATEPETBASICREV: Updation failed in petition_basic');
                log_message('error', $this->db2->last_query());

                echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'ERRDUPDATEPETBASICREV: Approval Failed! Please Contact System Admin',
                ));
                return false;
            }else
            {
                $proceeding = $this->db2->query("select count(proceeding_id) as proceed from petition_proceeding_dc_adc where case_no = '$case_no' limit 1")->result();
                $proceeding_id = $proceeding[0]->proceed + 1;

                    $proceeding_data_dept = array(
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'co_order' => $co_order,
                        'note_on_order' => $assistantRemarks,
                        'status' => 'Pending',
                        'user_code' => $user_code,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'dist_code' => $dist_code,
                        'subdiv_code' => $subdiv_code,
                        'cir_code' => $cir_code
                    );

                $deptInsert = $this->db2->insert('petition_proceeding_dc_adc', $proceeding_data_dept);

                if($deptInsert != 1){
                    $this->db2->trans_rollback();
                    $this->db->trans_rollback();

                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'ERRINSPROCEEDINGREV: Approval Failed! Please Contact System Admin',
                    ));
                    return false;
                }
                else
                {
                    $insertIlrms = $this->db->insert('assistant_verification_details', $insertArrIlrms);
                    if ($insertIlrms != TRUE) 
                    {
                        $this->db2->trans_rollback();
                        $this->db->trans_rollback();
                        log_message('error', '#ERRINSILRMSREV: Insertion failed in assistant_verification_details');
                        log_message('error', $this->db->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRINSILRMSREV: Assistant Approval Failed! Please Contact System Admin',
                        ));
                        return false;
                    }
                    else
                    {
                        $this->db->trans_commit();
                        $this->db2->trans_commit();

                        if($verifyStatus == "A")
                        {
                            echo json_encode(array(
                                'responseType' => 2,
                                'message' => 'Case Successfuly Verified & Approved by Assistant',
                            ));
                        }
                        if($verifyStatus == "R")
                        {
                            echo json_encode(array(
                                'responseType' => 2,
                                'message' => 'Case Successfuly Verified & Reverted',
                            ));
                        }

                    }

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

        $this->db = $this->load->database('db2', TRUE);
        $assistantVerification=$this->DeptConversionModel->getAssistantVerificationDetails($this->db,$case_no)->result();
        $data['assistantVerification'] = $assistantVerification;
        $data['case_no'] = $case_no;
        $data['_view'] = 'conversion/assitantVerificationDetails.php';
        $this->load->view('layouts/main', $data);

    }

    public function getAstRemarksDetailsRevertedCases() {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => validation_errors()
            ));
        } else {
            $dist_code = $this->input->post('district_id');
            $allSelectedList = $this->input->post('selectedList');
            $user_code = $this->session->userdata('user_code');

            $cabIdList = $this->DeptConversionModel->getAllConversionCabList($dist_code, $user_code);

            if (empty($cabIdList)) {
                echo json_encode(array(
                    'responseType' => 3,
                    'message' => 'Cabinet not Created Yet...! Please Create Cabinet before Revert Cases..'
                ));
                return;
            }

            $caseList = array_map(function($value) {
                return "'" . $value . "'";
            }, $allSelectedList);


            $commaSeparatedCases = implode(',', $caseList);

            $this->db2 = $this->dbswitch2($dist_code);
            $revertedCases = $this->DeptConversionModel->getCaseDetailsToBeReverted($this->db2, $commaSeparatedCases)->result();

                if (empty($revertedCases)) {
                    echo json_encode(array(
                        'responseType' => 3,
                        'message' => 'Case Details not Found...!!!'
                    ));
                    return;
                }

            echo json_encode(array(
                'responseType' => 2,
                'reverted_case_list' => $revertedCases,
                'cabMemoList' => $cabIdList
            ));
        }
    }


    ///////////////Bulk Revert Cases from Department To DC////////////////
    public function bulkRevertConversionCasesToDC()
    {
        // $this->form_validation->set_rules('service_code_revert[]', 'Service Code', 'trim|required');
        $this->form_validation->set_rules('revert_case_no[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('distict_code_revert', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('revert_remarks[]', 'Revert Remarks', 'required');
        $this->form_validation->set_rules('cabMemoIdRevert', 'Cab Memo Required', 'required');

        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Please Enter Remarks for All Cases',
            ));
        } else 
        {
            $dist_code     = $this->input->post('distict_code_revert');
            // $service_code_revert     = $this->input->post('service_code_revert');
            $cases_no_revert = $this->input->post('revert_case_no');
            $input_revert_remarks = $this->input->post('revert_remarks');
            $user_code = $this->session->userdata('user_code');
            $cab_id_revert = $this->input->post('cabMemoIdRevert');


            $casesArray = array_map(function ($a, $b) {
                return $a . '(@)' . $b ;
            }, $cases_no_revert, $input_revert_remarks);

            // var_dump($casesArray);die;

                $this->db = $this->load->database('db2', TRUE);
                $this->db2 =  $this->dbswitch2($dist_code);

                foreach($casesArray as $row)
                {
                    $case_no = strtok($row, '(@)');
                    $revert_remarks = strtok('(@)');


                    //Update Array for Petition Basic
                    $updateData[] = [
                        'case_no' => $case_no,
                        'dept_js_approve' => 'N',
                        'status' => 'R',
                        'add_off_desig' => 'DC'
                    ];

                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from petition_proceeding_dc_adc where case_no='$case_no' ")->row()->c;

                    if ($proceeding_id == null) {
                        $proceeding_id = 1;
                    }

                    $proceeding_details = $this->db2->query("select dist_code,subdiv_code,cir_code,co_order,note_on_order from petition_proceeding_dc_adc where case_no = '$case_no' order by proceeding_id desc limit 1")->row();
                    $co_order = $proceeding_details->co_order;
                    $subdiv_code = $proceeding_details->subdiv_code;
                    $cir_code = $proceeding_details->cir_code;

                    //Insert Array for Petition Proceedings
                    $insPetProceed[] = [
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'status' => 'Revert',
                        'user_code' => $user_code,
                        'co_order' => $co_order,
                        'note_on_order' => $revert_remarks,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'dist_code' => $dist_code,
                        'subdiv_code' => $subdiv_code,
                        'cir_code' => $cir_code,
                    ];


                    //Insert Data in conversion_reverted_case_list
                    $insRevertCases[] = [
                        'case_no' => $case_no,
                        'cab_id' => $cab_id_revert,
                        'created_at' => date('Y-m-d h:i:s'),
                        'revert_remarks' => $revert_remarks,
                        'user_code' => $user_code,
                        'dist_code' => $dist_code,
                        'status' => 'R'
                    ];

                    // $application_no[] = $this->basundharamodel->getApplicationNoByCaseNo($this->db2,$case_no)->applid;
                    // $concatenatedAppNo = implode(',', $application_no);
                }


                $insertRevertList = $this->db->insert_batch('conversion_reverted_case_list', $insRevertCases);

                if($insertRevertList <= 0 || $this->db->affected_rows() <= 0)
                {
                    $this->db->trans_rollback();
                    log_message('error', '#ERRINSERTCONVREVERT001: Insert Failed in  conversion_reverted_case_list' );
                    echo json_encode(array(
                        'responseType' => 3,
                        'message'      => '#ERRINSERTCONVREVERT001: Cases Not Reverted ! Kindly Contact System Admin.  !!!',
                    ));
                    return false;
                }else   
                {
                    $this->db->trans_commit();
                    $this->db2->trans_begin();
                    $updateBasicStatus = $this->db2->update_batch('petition_basic',$updateData,'case_no');

                    if($updateBasicStatus<=0 || $this->db2->affected_rows() <= 0)
                    {
                        $this->db2->trans_rollback();
                        echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'Error01: Cases Not Reverted ! Kindly Contact System Admin.',
                            ));
                        return;
                    }else
                    {
                            $inserProceding = $this->db2->insert_batch('petition_proceeding_dc_adc', $insPetProceed);
                            if($inserProceding <= 0 || $this->db2->affected_rows() <= 0)
                            {
                                $this->db2->trans_rollback();
                                echo json_encode(array(
                                        'responseType' => 1,
                                        'message' => 'Error02: Cases Not Reverted ! Kindly Contact System Admin.',
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


    ////////Revert Conversion Cases from Proposal///
    public function revertConversionCasesFromProposal()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors! Data not Found',
            ));
            return;
        }

        $allSelectedList = $this->input->post('selectedList');
        $user_code = $this->session->userdata('user_code');

        if (empty($allSelectedList)) 
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Validation Errors! Please Select Cases',
            ));
            return;
        }

        $this->db = $this->load->database('db2', TRUE);

        $this->db->trans_begin();

        $allSuccess = TRUE;

        foreach ($allSelectedList as $caseN) 
        {
            $case_no = $caseN;

            $caseDetailsProposal = $this->DeptConversionModel->getCaseDetailsFromProposalList($this->db, $case_no)->result();

            if (empty($caseDetailsProposal)) 
            {
                $allSuccess = FALSE;
                log_message('error', 'Case Details not found in Proposal List for case_no: ' . $case_no);
                continue;
            }

            $dist_code = $caseDetailsProposal[0]->dist_code;

            $this->db->where('case_no', $case_no);
            $deleteResult = $this->db->delete('conversion_proposal_case_list');

            if ($deleteResult !== TRUE) 
            {
                $allSuccess = FALSE;
                log_message('error', '#ERRDDELETECPL001: Deletion failed in conversion_proposal_case_list for case_no: ' . $case_no);
                log_message('error', $this->db->last_query());
                continue;
            }

            // Change status in petition basic
            $this->db2 = $this->dbswitch2($dist_code);
            $this->db2->trans_begin();

            $updateData = array(
                'add_to_proposal' => NULL
            );

            $whereData = array(
                'case_no' => $case_no
            );

            $updatePetBasicStatus = $this->DeptConversionModel->updatePetitionBasicForConversion($this->db2, $updateData, $whereData);

            if ($updatePetBasicStatus <= 0) 
            {
                $this->db2->trans_rollback();
                $allSuccess = FALSE;
                log_message('error', '#ERRDUPDATEPETBASICPROPOSAL: Updation failed in petition_basic for case_no: ' . $case_no);
                log_message('error', $this->db2->last_query());
                continue;
            }

            $this->db2->trans_commit();
        }

        if ($allSuccess) 
        {
            $this->db->trans_commit();
            echo json_encode(array(
                'responseType' => 2,
                'message' => 'Cases Reverted from Proposal',
            ));
        } 
        else 
        {
            $this->db->trans_rollback();
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Failed to Revert Cases from Proposal',
            ));
        }
    }


}

