<?php
class ReclassificationSuiteSurvey extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->model('ReclassificationSuiteSurveyModel');
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


    public function getAllCasesListByDept()
    {
        $user_code = $this->session->userdata('user_code');
        $dist_code     = trim($this->input->post('selectDistrict'));
        $designation = $this->session->userdata('designation');
        $data = array();
        // $data['user_dist']      = $this->ReclassificationSuiteSurveyModel->getJDSUserDistListWithCaseCount();
        $data['_view'] = 'Reclass/jds_pending';
        
        $this->load->view('layouts/main', $data);
    }

    public function viewReclassCases()
    {
        $dist_code   = $this->input->post('dist_code');
        $data = array();
        $data['dist_code'] =$dist_code;
        $data['dist_name'] = $this->utilclass->getDistrictName($dist_code);
        $this->db2 =  $this->dbswitch2($dist_code);
        $data['reclassCaseList'] = $this->ReclassificationSuiteSurveyModel->getReclassCaseList($this->db2,$dist_code);
        $data['status'] = true;
        $this->load->view('Reclass/reclass_case_list',$data);
    }


    public function getPendingReclassCaseList() 
    {
        $json = null;

        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $dist_code = $this->input->post('dist_code');

        $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

        $this->db2 =  $this->dbswitch2($dist_code);

        $case_list = $this->ReclassificationSuiteSurveyModel->getPendingCaseListDetails($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);


        if(!empty($case_list)) {

        if($case_list['total_records'] >  0){

            $data_rows = $case_list['data_results'];

            foreach($data_rows as $row) {

                $url = base_url('ReclassificationSuiteSurvey/reclassCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);

                $case_no = "<small class='bg-'><i class='fa fa-archive'></i> " . $row->case_no . "</small>";

                $button = "<a href='".$url."' class='btn btn-sm btn-primary' target='_viewCaseDetails'><i class='fa fa-eye'></i></a>";

                $circle = "<small class='text-danger'>Circle:- " . $this->utilclass->getCircleName($row->dist_code, $row->subdiv_code, $row->cir_code) . "</small>";
                $mouza = "<br><small class='text-danger'>Mouza:- " . $this->utilclass->getMouzaName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code) . "</small>";
                $village = "<br><small class='text-danger'>Vill:-  " . $this->utilclass->getVillageName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code) . "</small>";


                $ads_approve = $row->ads_approve;
                $jds_approve = $row->jds_approve;

                if($ads_approve == NULL){
                    $ads_approve_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                }
                if($jds_approve == 1){
                    $ads_approve_status = '<small>Sent to ADS <i class="fa fa-forward"></i></small>';
                }
                if($ads_approve == 1){
                    $ads_approve_status = '<small class="text-success">ADS Verified <i class="fa fa-check-circle"></i></small>';
                }
                
            

                $json[] = array(
                $row->case_no,
                $case_no,
                $circle . $mouza . $village,
                $ads_approve_status,
                '<small class="text-default"><i class="fa fa-calendar"></i> '. date("d/m/Y", strtotime($row->submission_date)) .' </small>',
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


    public function sentReclassCasesADS()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required');
        $this->form_validation->set_rules('jds_remark', 'JDS Remark', 'trim|required');

        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Please Select Cases for send to ADS',
            ));
        } else 
        {
            $dist_code     = $this->input->post('district_id');
            $allSelectedList = $this->input->post('selectedList');
            $jds_remark     = $this->input->post('jds_remark');

            if (!empty($allSelectedList)) 
            {
                foreach ($allSelectedList as $caseN) 
                {
                    $case_no =$caseN;

		    $this->db2 =  $this->dbswitch2($dist_code);
                    $reclassData= $this->ReclassificationSuiteSurveyModel->getReclassCaseDetails($this->db2,$dist_code,$case_no);
                    if($reclassData->ads_approve == '1')
                    {
                        log_message('error', '#ERRRECLASS278: already Verified by ADS');
                        log_message('error', $this->db2->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRRECLASS282: Failed cases for send to ADS, it has been already verified...',
                        ));
                        return false;
                    }
		    if($reclassData->jds_approve == '1')
                    {
                        log_message('error', '#ERRRECLASS278: already sent to ADS');
                        log_message('error', $this->db2->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRRECLASS282: Failed cases for send to ADS, it has been already sent...',
                        ));
                        return false;
                    } 
                   
                    $this->db2->trans_begin();

                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                    if ($proceeding_id == null) {
                        $proceeding_id = 1;
                    }

                    $insPetProceed = [
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'next_date_of_hearing' => date('Y-m-d h:i:s'),
                        'note_on_order' => $jds_remark,
                        'user_code' => MB_DEPARTMENT,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'office_from' => 'JDS',
                        'office_to'   => 'ADS',
                        'task' => 'Forwarded To ADS',
                        'status' => 'Pending at ADS',
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

                    $updateData = array(
                        'jds_approve' => 1,
                    );
                    $updatePetBasicStatus = $this->ReclassificationSuiteSurveyModel->updateReclassBasicForCab($this->db2,$case_no, $dist_code, $updateData);
                    if($updatePetBasicStatus != 1)
                    {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRRECLASS282: Updation failed in reclass basic');
                        log_message('error', $this->db2->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRRECLASS282: Failed cases for send to ADS',
                        ));
                        return false;

                    }else{
                        $this->db2->trans_commit();
                    }
                }
            }
            echo json_encode(array(
                'responseType' => 2,
                'message' => 'Cases Successfully Send to ADS',
            ));
        }
        
    }

    public function getAllCasesListByDeptAds()
    {
        $user_code = $this->session->userdata('user_code');
        $dist_code     = trim($this->input->post('selectDistrict'));
        $designation = $this->session->userdata('designation');
        $data = array();
        // $data['user_dist']      = $this->ReclassificationSuiteSurveyModel->getJDSUserDistListWithCaseCount();
        $data['_view'] = 'Reclass/ads_pending';
        
        $this->load->view('layouts/main', $data);
    }

    public function viewReclassCasesAds()
    {
        $dist_code   = $this->input->post('dist_code');
        $data = array();
        $data['dist_code'] =$dist_code;
        $data['dist_name'] = $this->utilclass->getDistrictName($dist_code);
        $this->db2 =  $this->dbswitch2($dist_code);
        $data['reclassCaseList'] = $this->ReclassificationSuiteSurveyModel->getReclassCaseListAds($this->db2,$dist_code);
        $data['status'] = true;
        $this->load->view('Reclass/reclass_case_list_ads',$data);
    }

    public function getPendingReclassCaseListAds() 
    {
        $json = null;

        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $dist_code = $this->input->post('dist_code');

        $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

        $this->db2 =  $this->dbswitch2($dist_code);

        $case_list = $this->ReclassificationSuiteSurveyModel->getPendingCaseListDetailsAds($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);


        if(!empty($case_list)) {

        if($case_list['total_records'] >  0){

            $data_rows = $case_list['data_results'];

            foreach($data_rows as $row) {

                $url = base_url('ReclassificationSuiteSurvey/reclassCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);

                $case_no = "<small class='bg-'><i class='fa fa-archive'></i> " . $row->case_no . "</small>";

                $button = "<a href='".$url."' class='btn btn-sm btn-primary' target='_viewCaseDetails'><i class='fa fa-eye'></i></a>";

                $circle = "<small class='text-danger'>Circle:- " . $this->utilclass->getCircleName($row->dist_code, $row->subdiv_code, $row->cir_code) . "</small>";
                $mouza = "<br><small class='text-danger'>Mouza:- " . $this->utilclass->getMouzaName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code) . "</small>";
                $village = "<br><small class='text-danger'>Vill:-  " . $this->utilclass->getVillageName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code) . "</small>";


                $ads_approve = $row->ads_approve;

                if($ads_approve == NULL){
                    $ads_approve_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                }
                if($ads_approve == 1){
                    $ads_approve_status = '<small>Sent to ADS <i class="fa fa-forward"></i></small>';
                }
                if($ads_approve == 2){
                    $ads_approve_status = '<small class="text-success">ADS Verified <i class="fa fa-check-circle"></i></small>';
                }
                
            

                $json[] = array(
                $row->case_no,
                $case_no,
                $circle . $mouza . $village,
                $ads_approve_status,
                '<small class="text-default"><i class="fa fa-calendar"></i> '. date("d/m/Y", strtotime($row->submission_date)) .' </small>',
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


    public function getAllCasesListByDeptDlr()
    {
        $user_code = $this->session->userdata('user_code');
        $dist_code     = trim($this->input->post('selectDistrict'));
        $designation = $this->session->userdata('designation');
        $data = array();
        // $data['user_dist']      = $this->ReclassificationSuiteSurveyModel->getJDSUserDistListWithCaseCount();
        $data['_view'] = 'Reclass/dlr_pending';
        
        $this->load->view('layouts/main', $data);
    }

    public function viewReclassCasesDlr()
    {
        $dist_code   = $this->input->post('dist_code');
        $data = array();
        $data['dist_code'] =$dist_code;
        $data['dist_name'] = $this->utilclass->getDistrictName($dist_code);
        $this->db2 =  $this->dbswitch2($dist_code);
        $data['reclassCaseList'] = $this->ReclassificationSuiteSurveyModel->getReclassCaseListDlr($this->db2,$dist_code);
        $data['status'] = true;
        $this->load->view('Reclass/reclass_case_list_dlr',$data);
    }

    public function getPendingReclassCaseListDlr() 
    {
        $json = null;

        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');

        $dist_code = $this->input->post('dist_code');

        $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

        $this->db2 =  $this->dbswitch2($dist_code);

        $case_list = $this->ReclassificationSuiteSurveyModel->getPendingCaseListDetailsDlr($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);


        if(!empty($case_list)) {

        if($case_list['total_records'] >  0){

            $data_rows = $case_list['data_results'];

            foreach($data_rows as $row) {

                $url = base_url('ReclassificationSuiteSurvey/reclassCaseDetails');
                $url .= '?dist_code=' . urlencode($row->dist_code);
                $url .= '&case_no=' . urlencode($row->case_no);

                $case_no = "<small class='bg-'><i class='fa fa-archive'></i> " . $row->case_no . "</small>";

                $button = "<a href='".$url."' class='btn btn-sm btn-primary' target='_viewCaseDetails'><i class='fa fa-eye'></i></a>";

                $circle = "<small class='text-danger'>Circle:- " . $this->utilclass->getCircleName($row->dist_code, $row->subdiv_code, $row->cir_code) . "</small>";
                $mouza = "<br><small class='text-danger'>Mouza:- " . $this->utilclass->getMouzaName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code) . "</small>";
                $village = "<br><small class='text-danger'>Vill:-  " . $this->utilclass->getVillageName($row->dist_code, $row->subdiv_code, $row->cir_code,$row->mouza_pargona_code,$row->lot_no,$row->vill_townprt_code) . "</small>";


                $ads_approve = $row->ads_approve;
                $jds_approve = $row->jds_approve;

                if($ads_approve == NULL){
                    $ads_approve_status = '<small class="text-danger">Pending <i class="fa fa-spinner fa-spin"></i></small>';
                }
                if($ads_approve == 1){
                    $ads_approve_status = '<small>ADS Verified <i class="fa fa-forward"></i></small>';
                }
                if($jds_approve == 2){
                    $jds_approve_status = '<small class="text-success">JDS Verified <i class="fa fa-check-circle"></i></small>';
                }
                if($jds_approve == 1){
                    $jds_approve_status = '<small class="text-danger">Sent to ADS <i class="fa fa-spinner fa-spin"></i></small>';
                } 
            

                $json[] = array(
                $row->case_no,
                $case_no,
                $circle . $mouza . $village,
                $ads_approve_status,
                $jds_approve_status,
                '<small class="text-default"><i class="fa fa-calendar"></i> '. date("d/m/Y", strtotime($row->submission_date)) .' </small>',
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

    public function reclassCaseDetails()
    {
        $case_no = $_GET['case_no'];
        $dist_code = $_GET['dist_code'];
        $url = 'http://172.16.11.120/dharitree/dharitree_dev/index.php/ReclassSuiteCo';
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'dist_code' => $dist_code,
            'application_no' => $case_no,
        )));
	$result = curl_exec($curl_handle);
        curl_close($curl_handle);

        $dataa = $result;
        $data['reclassCaseView'] = $dataa;
        $data['_view'] = 'Reclass/reclassCaseView';
        $this->load->view('layouts/main', $data);

    }
        public function sentReclassCasetoJDSbyADSOld()
	{
	    $encode_file = base64_encode(file_get_contents($_FILES['up_file']['tmp_name']));
            //$_POST = json_decode(file_get_contents("php://input"), true);
            $dist_code     = $this->input->post('district_id');
            $allSelectedList = $this->input->post('selectedList');
            $ads_remark     = $this->input->post('ads_remark');

            if (!empty($allSelectedList))
            {
                foreach ($allSelectedList as $caseN)
                {
                    $case_no =$caseN;


                    $this->db2 =  $this->dbswitch2($dist_code);
                    $this->db2->trans_begin();

                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                    if ($proceeding_id == null) {
                        $proceeding_id = 1;
                    }

                    $insPetProceed = [
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'next_date_of_hearing' => date('Y-m-d h:i:s'),
                        'note_on_order' => $ads_remark,
                        'user_code' => MB_DEPARTMENT,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'office_from' => 'JDS',
                        'office_to'   => 'ADS',
                        'task' => 'Forwarded To JDS by ADS',
                        'status' => 'Pending at JDS',
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
		    
		    $timestamp = date('mdYhis', time()).uniqid();
                    $doc_file = $_FILES['up_file'];
                    $_FILES['file']['name'] = $_FILES['up_file']['name'];
                    $_FILES['file']['type'] = $_FILES['up_file']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['up_file']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['up_file']['error'];
                    $_FILES['file']['size'] = $_FILES['up_file']['size'];
                    $doc_file_name = 'doc1'.$timestamp;
                    $doc_upload_path = UPLOAD_BASE.$timestamp.$doc_file['name'];

                    $config['upload_path']   = UPLOAD_BASE;
                    $config['allowed_types'] = UPLOAD_ALLOW_TYPE;
                    $config['max_size']  = UPLOAD_MAX_SIZE;;
                    $config['file_name'] = $doc_file_name;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file'))
                    {

                        $document= array(
                            'case_no'   => $case_no,
                            'file_name' => $file_name,
                            'user_code' => $this->session->userdata('user_code'),
                            'fetch_file_name' => $_FILES['file']['name'],
                            'file_type'  =>$_FILES['file']['type'],
                            'file_path'  => $doc_upload_path,
                            'date_entry' => date('Y-m-d h:i:s'),
                            'mut_type'   => 40,
                        );

                        // save data in attachment file
                        $addMoreDocQuery = $this->db2->insert('supportive_document',$document);

                        if($addMoreDocQuery != 1)
                        {
                            $this->db2->trans_rollback();
                            log_message('error', '#ERRADDDOC0001: Insertion failed in supportive document RTPS Case No '.$application_no);

                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'ERRADDDOC0001: Failed cases for send to JDS, uploading failed',
                            ));
                            return false;
                        }

                    }
                    $updateData = array(
                        'ads_approve' => 1,
                    );
                    $updatePetBasicStatus = $this->ReclassificationSuiteSurveyModel->updateReclassBasicForCab($this->db2,$case_no, $dist_code, $updateData);
                    if($updatePetBasicStatus != 1)
                    {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRRECLASS282: Updation failed in reclass basic');
                        log_message('error', $this->db2->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRRECLASS282: Failed cases for send to ADS',
                        ));
                        return false;

                    }else{
                        $this->db2->trans_commit();
                    }
                }
            }
            echo json_encode(array(
                'responseType' => 2,
                'message' => 'Cases Successfully Send to JDS',
            ));

	}

        public function sentReclassCasetoJDSbyADS()
    {
        // $_POST = json_decode(file_get_contents("php://input"), true);

        // $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        // $this->form_validation->set_rules('district_id', 'District ID', 'trim|required');
        // $this->form_validation->set_rules('ads_remark', 'ADS Remark', 'trim|required');

        // if ($this->form_validation->run() == FALSE)
        // {
        //     echo json_encode(array(
        //         'responseType' => 3,
        //         'message' => 'Validation Errors !. Please Select Cases for send to ADS',
        //     ));
        // } else
            // {
            $encode_file = base64_encode(file_get_contents($_FILES['up_file']['tmp_name']));
            $dist_code     = $this->input->post('district_id');
            $allSelectedList = $this->input->post('selectedList');
            $ads_remark     = $this->input->post('ads_remark');
            $file_name     = $this->input->post('file_name');

            if (!empty($allSelectedList))
            {
                foreach ($allSelectedList as $caseN)
                {
                    $case_no =$caseN;


                    $this->db2 =  $this->dbswitch2($dist_code);
                    $this->db2->trans_begin();

                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                    if ($proceeding_id == null) {
                        $proceeding_id = 1;
                    }

                    $insPetProceed = [
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'next_date_of_hearing' => date('Y-m-d h:i:s'),
                        'note_on_order' => $ads_remark,
                        'user_code' => MB_DEPARTMENT,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'office_from' => 'JDS',
                        'office_to'   => 'ADS',
                        'task' => 'Forwarded To JDS by ADS',
                        'status' => 'Pending at JDS',
                        'note_type' => 'Maybe Approve',
                    ];
                    $insertProceeding = $this->db2->insert('settlement_proceeding', $insPetProceed);
                    if($insertProceeding != 1)
                    {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRORPP: Insertion failed in settlement_proceeding for case no :' . $case_no);
                        log_message('error', $this->db2->last_query());
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRADD0004: Failed to insert . Kindly contact System Administrator',

                        ));
                        return false;
                    }
                    $reclassData= $this->ReclassificationSuiteSurveyModel->getReclassCaseDetails($this->db2,$dist_code,$case_no);
                    $reclassDataDag= $this->ReclassificationSuiteSurveyModel->getReclassCaseDagDetails($this->db2,$case_no);
                    if(empty($reclassDataDag))
                    {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRADD000432: Insertion failed in reclass_dag_details for case no :' . $case_no);
                        log_message('error', $this->db2->last_query());
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRADD000432: Failed to upload file as no wetland dag is found . Kindly contact System Administrator',

                        ));
                        return false;
		    }

                    foreach ($reclassDataDag as $key => $value)
                    {
                        $curl_handle = curl_init();
                        $url = 'http://172.16.11.120/dharrtpsapi/index.php/uploadAdsPhoto';
                        curl_setopt($curl_handle, CURLOPT_URL, $url);
                        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, FALSE);
                        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST,  FALSE);
                        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
                          'applid' => $reclassData->applid,
                          'dist_code' => $dist_code,
                          'case_no' => $case_no,
                          'service_code' => '40',
                          'dag_no' => $value->dag_no,
                          'user_code' => $this->session->userdata('user_code'),
			  'encoded_file' => $encode_file,
			  'file_name' => $file_name,
                        )));
			$result = curl_exec($curl_handle);
			log_message('error', 'url: '.$url.', response: '.json_encode($result).', error: '.curl_error($curl_handle));
			$result=json_decode($result);
                        curl_close($curl_handle);

                        if ($result==null && !isset($result->responseType))
			{
			    
                            $this->db2->trans_rollback();
                            log_message('error', '#ERRRECLASS282: Updation failed in reclass basic');
                            log_message('error', $this->db2->last_query());

                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'ERRRECLASSFLE: Failed cases for send to JDS',
                            ));
                            return false;
                        }
                    }



                    $updateData = array(
                        'ads_approve' => 1,
                        'ads_approve_date_time' => date('Y-m-d H:i:s')
                    );
                    $updatePetBasicStatus = $this->ReclassificationSuiteSurveyModel->updateReclassBasicForCab($this->db2,$case_no, $dist_code, $updateData);
                    if($updatePetBasicStatus != 1)
                    {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRRECLASS282: Updation failed in reclass basic');
                        log_message('error', $this->db2->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRRECLASS282: Failed cases for send to JDS',
                        ));
                        return false;

                    }else{
                        $this->db2->trans_commit();
                    }
                }
            }
            echo json_encode(array(
                'responseType' => 2,
                'message' => 'Cases Successfully Send to JDS',
            ));
        // }

    }
    public function sentReclassCasestoDLR()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required');
        $this->form_validation->set_rules('jds_remark', 'JDS Remark', 'trim|required');
        if ($this->form_validation->run() == FALSE) 
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Please Select Cases for send to ADS',
            ));
        } else 
        {
            $dist_code     = $this->input->post('district_id');
            $allSelectedList = $this->input->post('selectedList');
            $jds_remark     = $this->input->post('jds_remark');

            if (!empty($allSelectedList)) 
            {
                foreach ($allSelectedList as $caseN) 
                {
                    $case_no =$caseN;
                    
                   
		    $this->db2 =  $this->dbswitch2($dist_code);

		    $reclassData= $this->ReclassificationSuiteSurveyModel->getReclassCaseDetails($this->db2,$dist_code,$case_no);
                    if($reclassData->ads_approve != '1')
                    {
                        log_message('error', '#ERRRECLASS740: Should be verified by ADS first');
                        log_message('error', $this->db2->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRRECLASS282: Failed cases for send to DLR, Should be verified by ADS first!',
                        ));
                        return false;
                    }

                    if($reclassData->jds_approve != '1')
                    {
                        log_message('error', '#ERRRECLASS740: Should be verified by JDS first');
                        log_message('error', $this->db2->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRRECLASS282: Failed cases for send to DLR, Should be verified by JDS first!',
                        ));
                        return false;
		    }

                    $this->db2->trans_begin();

                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                    if ($proceeding_id == null) {
                        $proceeding_id = 1;
                    }

                    $insPetProceed = [
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'next_date_of_hearing' => date('Y-m-d h:i:s'),
                        'note_on_order' => $jds_remark,
                        'user_code' => MB_DEPARTMENT,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'office_from' => 'JDS',
                        'office_to'   => 'DLR',
                        'task' => 'Forwarded To DLR by JDS',
                        'status' => 'Pending at JDS',
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

                    $updateData = array(
                        'jds_approve' => 2,
			'jds_approve_date_time' => date('Y-m-d H:i:s'),
			'pending_officer'=>'DLR'
                    );
                    $updatePetBasicStatus = $this->ReclassificationSuiteSurveyModel->updateReclassBasicForCab($this->db2,$case_no, $dist_code, $updateData);
                    if($updatePetBasicStatus != 1)
                    {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRRECLASS282: Updation failed in reclass basic');
                        log_message('error', $this->db2->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRRECLASS282: Failed cases for send to ADS',
                        ));
                        return false;

                    }else{
                        $this->db2->trans_commit();
                    }
                }
            }
            echo json_encode(array(
                'responseType' => 2,
                'message' => 'Cases Successfully Send to DLR&S',
            ));
        }
        
    }

    public function sentReclassCasesJDSbyDLR()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required');
        $this->form_validation->set_rules('dlr_remark', 'DLR Remark', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Please Select Cases for send to CO',
            ));
        } else
        {
            $dist_code     = $this->input->post('district_id');
            $allSelectedList = $this->input->post('selectedList');
            $dlr_remark     = $this->input->post('dlr_remark');

            if (!empty($allSelectedList))
            {
                foreach ($allSelectedList as $caseN)
                {
                    $case_no =$caseN;


                    $this->db2 =  $this->dbswitch2($dist_code);
                    $this->db2->trans_begin();

                    $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no='$case_no' ")->row()->c;

                    if ($proceeding_id == null) {
                        $proceeding_id = 1;
                    }

                    $insPetProceed = [
                        'case_no' => $case_no,
                        'proceeding_id' => $proceeding_id,
                        'date_of_hearing' => date('Y-m-d h:i:s'),
                        'next_date_of_hearing' => date('Y-m-d h:i:s'),
                        'note_on_order' => $dlr_remark,
                        'user_code' => MB_DEPARTMENT,
                        'date_entry' => date('Y-m-d h:i:s'),
                        'operation' => 'E',
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'office_from' => 'DLR',
                        'office_to'   => 'CO',
                        'task' => 'Forwarded To CO by DLR',
                        'status' => 'Pending at CO',
                        'note_type' => 'Maybe Approve',
                    ];
                    $insertProceeding = $this->db2->insert('settlement_proceeding', $insPetProceed);

                    if ($insertProceeding != 1) {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRORPP846: Insertion failed in settlement_proceeding for case no :' . $case_no);
                        log_message('error', $this->db2->last_query());
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERRORPP846: Failed to insert . Kindly contact System Administrator',

                        ));
                        return false;
                    }

                    $updateData = array(
                        'dlr_approve' => '1',
                        'dlr_approve_date_time' => date('Y-m-d H:i:s'),
                        'pending_officer' => 'CO',
                        'pending_office'  => 'CO',
                        'status' => 'W',
                    );
                    $updatePetBasicStatus = $this->ReclassificationSuiteSurveyModel->updateReclassBasicForCab($this->db2,$case_no, $dist_code, $updateData);
                    if($updatePetBasicStatus != 1)
                    {
                        $this->db2->trans_rollback();
                        log_message('error', '#ERRRECLASS867: Updation failed in reclass basic');
                        log_message('error', $this->db2->last_query());

                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'ERRRECLASS867: Failed cases for send to CO',
                        ));
                        return false;

                    }else{
                        $this->db2->trans_commit();
                    }
                }
            }
            echo json_encode(array(
                'responseType' => 2,
                'message' => 'Cases Successfully Send to CO',
            ));
        }

    }
    
}
