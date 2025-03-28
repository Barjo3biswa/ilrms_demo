<?php
class BasundharaReview extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->model('review/ReviewModel');
        $this->load->model('basundhara/basundharamodel');

    }
    public function index()
    {
        $user_code = $this->session->userdata('user_code');
        $designation = $this->session->userdata('designation');
        $data = array();
        // $newMouzaList = $this->ReviewModel->locationSelect();
        // $uniqueMouzaList = array_map("unserialize", array_unique(array_map("serialize", $newMouzaList)));
        // $data['select_data'] = $uniqueMouzaList;
        $data['_view'] = 'review/review_all_list';
        $this->load->view('layouts/main', $data);
    }
    public function caseList()
    {
        $dist_code   = $this->input->post('dist_code');
        $data = array();
        $data['dist_code'] =$dist_code;
        $data['dist_name'] = $this->utilclass->getDistrictName($dist_code);
        // $data['conversionCaseList'] = $this->DeptConversionModel->getconversionCaseList($this->db2,$dist_code);
        $this->load->view('review/review_applications',$data);
    }
    
    public function getPendingList() 
    {
        $json = null;
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $mouza_pargona_code = $this->input->post('mouza_pargona_code');
        $lot_no = $this->input->post('lot_no');
        $vill_townprt_code = $this->input->post('vill_townprt_code');
        $order = $this->input->post('order');
        $dist_code = $this->input->post('dist_code');
        $curl_handle = curl_init();
        $searchByCol_1 = strtoupper(trim($this->input->post('columns')[1]['search']['value']));
        curl_setopt($curl_handle, CURLOPT_URL, "https://basundhara.assam.gov.in/rtpsmb2demo/Api/mb2ReviewApplicationsDlr/$dist_code");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'start' => $start,
            'length' => $length,
            'order' => $order,
            'searchByCol_0' => $searchByCol_1,
            'mouza_pargona_code' => $mouza_pargona_code,
            'lot_no' => $lot_no,
            'vill_townprt_code' => $vill_townprt_code
        )));
        $result = curl_exec($curl_handle);
        $results = json_decode($result);
        if (isset($results)) 
        {
            $data_rows = $results->data_results;
            if(count($data_rows) >  0)
            {    
                foreach($data_rows as $rows) 
                {
                    $s_code = $rows->service_code;
                    $link = base_url() . "index.php/Basundhara/settlementBasu/?app=".$rows->application_no . "&dist_code=" .$rows->dist_code;
                    $view_case = "<a href=".$link." class='btn btn-sm btn-primary' target='_blank'><i class='fa fa-eye'></i> &nbsp;View Details</a>";
                    $case_no = "<small class='bg-'><i class='fa fa-archive'></i> " . $rows->application_no . "</small>";


                    $circle = "<small class='text-danger'>Circle:- " . $this->utilclass->getCircleName($rows->dist_code, $rows->subdiv_code, $rows->cir_code) . "</small>";
                    $mouza = "<br><small class='text-danger'>Mouza:- " . $this->utilclass->getMouzaName($rows->dist_code, $rows->subdiv_code, $rows->cir_code,$rows->mouza_code) . "</small>";
                    $village = "<br><small class='text-danger'>Vill:-  " . $this->utilclass->getVillageName($rows->dist_code, $rows->subdiv_code, $rows->cir_code,$rows->mouza_code,$rows->lot_no,$rows->village_code) . "</small>";

                        

                        $json[] = array(
                        $rows->application_no,
                        $case_no,
                        $rows->query,
                        $circle . $mouza . $village,
                        '<small class="text-default"><i class="fa fa-calendar"></i> '. date("d M, Y", strtotime($rows->date_submission)) .' </small>',
                        $view_case
                        );
                }
            }
            else 
            {
                $json = "";
            }      
            $total_records = $results->total_records;
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

    public function bulkApprovedByDLR()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('dlr_remark', 'DLR Remark', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => '#ERR-REVIEW-141 Something went wrong',
            ));
        } 
        else 
        {
            $dist_code       = $this->input->post('district_id');
            $selectAssistant = $this->input->post('selectAssistant');
            $allSelectedList = $this->input->post('selectedList');
            $allSelectedList = explode(',',$allSelectedList);
            $user_code = $this->session->userdata('user_code');
            $dlr_remark = $this->input->post('dlr_remark');
            if(empty($allSelectedList))
            {
                echo json_encode(array(
                    'responseType' => 3,
                    'message' => '#ERR-REVIEW-156 Choose atleast one application',
                ));
                return;
            }
            $successCount = 0;
            $totalCount = count($allSelectedList);
            foreach ($allSelectedList as $row) 
            {
                $applid = strtok($row, '@');
                $this->db2 =  $this->ReviewModel->dbswitch2($dist_code);
                $case_no_data = $this->ReviewModel->getSettlementAppDetailsByCaseNo($this->db2,$applid);
                $case_no = $case_no_data->case_no;
                $this->db2->trans_begin();
                $updateData = array(
                    'dlr_remarks' => $dlr_remark,
		    'updation_date_time'  => date('Y-m-d H:i:s'),
		    'status' =>'D'
                );
                $updateBasicStatus = $this->ReviewModel->updateBasicReview($this->db2,$applid, $dist_code, $updateData);
                if($updateBasicStatus !=1)
                {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERR-REVIEW-181: Updation failed in review_case_basic for case no :' . $case_no);
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => '#ERR-REVIEW-184 Something went wrong',

                    ));
                    return;
                }
                //////proceeding_start//////
                $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no=?",array($case_no))->row()->c;
                if ($proceeding_id == null) 
                {
                    $proceeding_id = 1;
                }
                $insPetProceed = [
                    'case_no' => $case_no,
                    'proceeding_id' => $proceeding_id,
                    'date_of_hearing' => date('Y-m-d h:i:s'),
                    'next_date_of_hearing' => date('Y-m-d h:i:s'),
                    'note_on_order' => $dlr_remark,
                    'user_code'  => $this->session->userdata('user_code'),
                    'date_entry' => date('Y-m-d h:i:s'),
                    'operation' => 'E',
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'office_from' => 'DLR',
                    'office_to'   => MB_LOT_MONDOL,
                    'task' => 'Approved by DLR',
                    'status' => 'D',
                    'note_type' => 'Approved',
                ];
                $insertProceeding = $this->db2->insert('settlement_proceeding', $insPetProceed);
                if ($insertProceeding != 1) {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERR-REVIEW-201: Insertion failed in settlement_proceeding for case no :' . $case_no);
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => '#ERR-REVIEW-201 Application not Submitted, Something went wrong',

                    ));
                    return;
                } 
                else 
                {
                    //////////////POST TO BASUNDHARA/////////////////////
                    $application_no = $applid;
                    $rmk = $dlr_remark;
                    $status = 'R';
                    $task = 'DLR';
                    $pen = MB_LOT_MONDOL;
                    $case = $case_no;
                    $rtpsno = $application_no;
                    $rtps_status = $this->ReviewModel->postApiBasundhara($rtpsno, $case, $rmk, $status, $task, $pen);
                    $rtps_status = json_decode($rtps_status);
                    //////////////POST TO BASUNDHARA///////////////
                    log_message('error','api_response: rtpsno: '.$rtpsno.'---'.json_encode($rtps_status));
                    if (trim($rtps_status) != 'y') 
                    {
                        $this->db->trans_rollback();
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERR-REVIEW-226 Application not Reverted',
                        ));
                        return false;
                    } else {
                        $this->db2->trans_commit();
                        $successCount++;
                        echo json_encode(array(
                            'responseType' => 2,
                            'message' => 'Application Approved Successfully',
                        ));
                        return;
                    }
                }

            }
            if($totalCount == $successCount)
            {
                echo json_encode(array(
                     'responseType' => 2,
                    'message' => 'All Applications approved successfully',

                ));
                return; 
            }
            elseif($successCount > 0)
            {
                echo json_encode(array(
                    'responseType' => 2,
                    'message' => 'Some of Applications approved successfully',

                ));
                return; 
            }
            else
            {
                echo json_encode(array(
                     'responseType' => 2,
                    'message' => 'Some of applications might be approved successfully',

                ));
                return; 
            }
            

        }

        
    }

    public function bulkRejectByDLR()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);
        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');
        $this->form_validation->set_rules('dlr_remark', 'DLR Remark', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => '#ERR-REVIEW-141 Something went wrong',
            ));
        } 
        else 
        {
            $dist_code       = $this->input->post('district_id');
            $selectAssistant = $this->input->post('selectAssistant');
            $allSelectedList = $this->input->post('selectedList');
            $allSelectedList = explode(',',$allSelectedList);
            $user_code = $this->session->userdata('user_code');
            $dlr_remark = $this->input->post('dlr_remark');
            if(empty($allSelectedList))
            {
                echo json_encode(array(
                    'responseType' => 3,
                    'message' => '#ERR-REVIEW-156 Choose atleast one application',
                ));
                return;
            }
            $successCount = 0;
            $totalCount = count($allSelectedList);
            foreach ($allSelectedList as $row) 
            {


                $applid = strtok($row, '@');
                $this->db2 =  $this->ReviewModel->dbswitch2($dist_code);
                $case_no_data = $this->ReviewModel->getSettlementAppDetailsByCaseNo($this->db2,$applid);
                $case_no = $case_no_data->case_no;

                $this->db2->trans_begin();
                $updateData = array(
                    'dlr_remarks' => $dlr_remark,
		    'updation_date_time'  => date('Y-m-d H:i:s'),
		    'status' => 'R'
                );

                $updateBasicStatus = $this->ReviewModel->updateBasicReview($this->db2,$case_no, $dist_code, $updateData);
                if($updateBasicStatus !=1)
                {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERR-REVIEW-181: Updation failed in review_case_basic for case no :' . $case_no);
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => '#ERR-REVIEW-184 Something went wrong',

                    ));
                    return;
                }

                //////proceeding start//////
                $proceeding_id = $this->db2->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no=?",array($case_no))->row()->c;
                if ($proceeding_id == null) 
                {
                    $proceeding_id = 1;
                }
                $insPetProceed = [
                    'case_no' => $case_no,
                    'proceeding_id' => $proceeding_id,
                    'date_of_hearing' => date('Y-m-d h:i:s'),
                    'next_date_of_hearing' => date('Y-m-d h:i:s'),
                    'note_on_order' => $dlr_remark,
                    'user_code'  => $this->session->userdata('user_code'),
                    'date_entry' => date('Y-m-d h:i:s'),
                    'operation' => 'E',
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'office_from' => 'DLR',
                    'office_to'   => 'NA',
                    'task' => 'Rejected by DLR',
                    'status' => 'D',
                    'note_type' => 'Rejected',
                ];
                $insertProceeding = $this->db2->insert('settlement_proceeding', $insPetProceed);

                if ($insertProceeding != 1) {
                    $this->db2->trans_rollback();
                    log_message('error', '#ERR-REVIEW-201: Insertion failed in settlement_proceeding for case no :' . $case_no);
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => '#ERR-REVIEW-201 Application not Submitted, Something went wrong',

                    ));
                    return;
                } 
                else 
                {

                    //////////////POST TO BASUNDHARA/////////////////////
                    $application_no = $applid;
                    $rmk = $dlr_remark;
                    $status = 'R';
                    $task = 'DLR';
                    $pen = 'NA';
                    $case = $case_no;
                    $rtpsno = $application_no;

                    $rtps_status = $this->ReviewModel->postApiBasundhara($rtpsno, $case, $rmk, $status, $task, $pen);
                    $rtps_status = json_decode($rtps_status);
                    //////////////POST To basundhara End///////////////
                    log_message('error','api_response: rtpsno: '.$rtpsno.'---'.json_encode($rtps_status));
                    if (trim($rtps_status) != 'y') 
                    {
                        $this->db->trans_rollback();
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => '#ERR-REVIEW-226 Application not Reverted',
                        ));
                        return false;
                    } else {
                        $this->db2->trans_commit();
                        $successCount++;
                        echo json_encode(array(
                            'responseType' => 2,
                            'message' => 'Application Submitted Successfully',
                        ));
                        return;
                    }
                }

            }
            if($totalCount == $successCount)
            {
                echo json_encode(array(
                     'responseType' => 2,
                    'message' => 'All Applications Submitted successfully',

                ));
                return; 
            }
            elseif($successCount > 0)
            {
                echo json_encode(array(
                    'responseType' => 2,
                    'message' => 'Some of Applications submitted successfully',

                ));
                return; 
            }
            else
            {
                echo json_encode(array(
                     'responseType' => 2,
                    'message' => 'Some of applications might be submitted successfully',

                ));
                return; 
            }
            

        }

        
    }

    public function apiForSMSandPushTrack()
    {
        $count = 1;
        $sql="Select * from settlement_review_json_for_api where status = 0";
        $PendingData=$this->db->query($sql)->result();
        foreach ($PendingData as $key => $value)
        {
            $rtpsmbdb = $this->load->database('rtpsmb_nc', TRUE);
            $sql1="Select * from applications where application_no=? and is_draft='N'";
            $result_row=$rtpsmbdb->query($sql1,array($value->applid))->row();
            if(empty($result_row) || $result_row == null)
            {
                log_message('error','APIERROR#001========Applications data not found==='.$value->applid);
            }
            if($result_row->service_code == '13')
            {
                $dagTables = 'settlement_occupancy_tenant';
            }
            else if($result_row->service_code == '14')
            {
                $dagTables = 'settlement_ap';
            }
            else if($result_row->service_code == '15')
            {
                $dagTables = 'settlement_tribal_community';
            }
            else if($result_row->service_code == '16')
            {
                $dagTables = 'settlement_khas_land';
            }
            else if($result_row->service_code == '17')
            {
                $dagTables = 'settlement_pgr_vgr';
            }
            else if($result_row->service_code == '18')
            {
                $dagTables = 'settlement_tea';
            }

            $sqlDag="select * from $dagTables where application_no=? and is_applicant='1' and pdar_type='B'";
            $applicantData=$rtpsmbdb->query($sqlDag,array($value->applid))->row();
            if(empty($applicantData) || $applicantData == null)
            {
                log_message('error','APIERROR#002========Applicant data not found==='.$value->applid);
            }

            if(!isset($applicantData->mobile) || $applicantData->mobile == null || $applicantData->mobile == '')
            {
                log_message('error','APIERROR#003========Applicant mobile data not found==='.$value->applid);
            }




            ///SMS SENT TO MOBILE//////////
            $SMS_API_URL = 'http://172.16.3.134/rtpsmb/SmsApiController/sendSms';
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $SMS_API_URL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                                "key"       : "applicant_query",
                                "variables" : "' . $value->applid . '",
                                "mobilenos" : "' . $applicantData->mobile . '"
                        }',
                ));
            $response = curl_exec($curl);
            curl_close($curl);
	    ////////////////
	    //
	    //////////UPDATE API TABLE/////////////////
            $array = array(
              'status' => 1
            );
            $this->db->where('applid', $value->applid);
            $inStatus = $this->db->update('settlement_review_json_for_api', $array);
            if($this->db->affected_rows() != 1)
            {
                log_message("error","Error in updating settlement_review_json_for_api with application_no: ".json_encode($value->applid));
            }
            /////////END API UPDATE///////////////////////////////


        }
    }

}
