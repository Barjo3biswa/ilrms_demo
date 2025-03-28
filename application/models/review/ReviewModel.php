<?php
class ReviewModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('SettlementMb/SettlementCommonDcModel');
        // $this->load->model('TransactionModel');

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

    // get all DC rejected case
    public function locationSelect()
    {
        $dist_code = $this->session->userdata('dist_code');

        $sql = "SELECT vill_townprt_code, dist_code, subdiv_code, cir_code, mouza_pargona_code, lot_no FROM 
                location WHERE dist_code = ? and mouza_pargona_code !='00' and lot_no='00'  GROUP BY vill_townprt_code, dist_code, subdiv_code, cir_code, 
                mouza_pargona_code, lot_no";
        $data = $this->db->query($sql,$dist_code);
        return $data->result();

    }

    public function updateBasicReview($dbb,$applid, $dist_code, $data)
    {
        $dbb->where('applid', $applid);
        //$dbb->where('dist_code', $dist_code);
        $dbb->where('status', 'P');
        //$dbb->set('updation_date_time', 'NOW()', FALSE);
        $dbb->update('review_case_basic', $data);
        return $dbb->affected_rows();
    }

    public function getSettlementAppDetailsByCaseNo($dbb,$applid)
    {
        return $dbb->select('case_no')
            ->where('applid', $applid)
            ->get('settlement_basic')
            ->row();

    }

    ///////////////////////Post API Basundhara///////////////////

    function postApiBasundhara($rtpsno, $case, $rmk, $status, $task, $pen)
    {
        // $caseRtpsBasu = $this->checkRtpsService($rtpsno);
        // if ($caseRtpsBasu == 'RTPS') {
        //     $apilink = RTPS_API_LINK;
        // } else {
        //     $apilink = API_LINK;
        // }

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, API_LINK . "applicationStatusUpdateReview");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'application' => $rtpsno,
            'dharitree' => $case,
            'rmk' => $rmk,
            'status' => $status,
            'task' => $task,
            'pen' => $pen,
            'ip' => '10.177.7.141'
        )));
        $result = curl_exec($curl_handle);
        $httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        if ($httpcode != 200) {
            log_message("error", " Curl-Error in api: " . API_LINK . "applicationStatusUpdateReview with json_data: "
                . json_encode(array(
                    'application' => $rtpsno,
                    'dharitree' => $case,
                    'rmk' => $rmk,
                    'status' => $status,
                    'task' => $task,
                    'pen' => $pen
                )));
            return false;
        }
        curl_close($curl_handle);
        return $result;
    }
    // public function forwardCasesToDLR($post,$db)
    // {
    //     log_message('error','#REV-----POST====='.json_encode($post));
    //     $dist_code = $this->session->userdata('dist_code');
    //     $dc_remarks = $post['dc_remarks'];
    //     if($dc_remarks == null)
    //     {
    //         return array('responseType' => 3,'msg' => '#ERROR-REVIEW-87 Remarks field is mandatory');
    //     }
    //     $application_list = $post['application_list'];
    //     $applid_array = explode(',',$application_list);


    //     if(empty($applid_array) || $applid_array == null)
    //     {
    //         return array('responseType' => 3,'msg' => '#ERROR-REVIEW-94 applications not found...');
    //     }
    //     $total_count = count($applid_array);
    //     $success_count = 0;
    //     foreach ($applid_array as $key => $value) 
    //     {
    //         $this->db->trans_begin();
    //         $case_no = $this->getSettlementAppDetailsByCaseNo($value);
    //         $dataInsert = array(
    //             'applid'  => $value, 
    //             'case_no' => $case_no->case_no,
    //             'user_code' => $this->session->userdata('user_code'),
    //             'dc_remarks' => $dc_remarks,
    //             'creation_date_time' => date('Y-m-d H:i:s'),
    //             'updation_date_time' => date('Y-m-d H:i:s'),
    //             'status' => 'P',
    //             'cron_status' => null

    //         );
    //         $insertStatus = $this->TransactionModel->insert("review_case_basic",$dataInsert);
    //         if($insertStatus == 1)
    //         {
    //             $task = 'DC';
    //             $pen = 'DLR';
    //             $rtps_status=$this->SettlementApiModel->postApiBasundhara($value,$case_no,$dc_remarks,'M',$task,$pen);
    //             $rtps_status=json_decode($rtps_status);
    //             if(trim($rtps_status)!="y")
    //             {
    //                 log_message('error', '#ERROR-REVIEW-126: API for update==== :case_no=='.$case_no.'===STATUS===='.$rtps_status);
                    
    //             }
    //             else
    //             {
    //                 $this->db->trans_commit();
    //                 $success_count++;
    //                 log_message("error",'#SUC-064 forward applications===='.$value);
    //             }
                
    //         }
    //         else
    //         {
    //             $this->db->trans_rollback();
    //             log_message("error",'#ERROR-REVIEW-127 forward applications===='.$value);
    //         }
    //     }
    //     if($success_count == $total_count)
    //     {
    //         return array('responseType' => 2,'msg' => 'Forwarded to DLR successfully');
    //     }
    //     else if($success_count > 1)
    //     {
    //         return array('responseType' => 2,'msg' => 'Some of applications Forwarded to DLR successfully');
    //     }
    //     else
    //     {
    //         return array('responseType' => 3,'msg' => 'Error in forwarding');
    //     }
        
    // }

    // public function rejectCases($post)
    // {
    //     log_message('error','#REV--REJ-----POST====='.json_encode($post));
    //     $dist_code = $this->session->userdata('dist_code');
    //     $dc_remarks = $post['dc_remarks'];
    //     if($dc_remarks == null)
    //     {
    //         return array('responseType' => 3,'msg' => '#ERROR-REVIEW-87 Remarks field is mandatory');
    //     }
    //     $application_list = $post['application_list'];
    //     $applid_array = explode(',',$application_list);


    //     if(empty($applid_array) || $applid_array == null)
    //     {
    //         return array('responseType' => 3,'msg' => '#ERROR-REVIEW-94 applications not found...');
    //     }
    //     $total_count = count($applid_array);
    //     $success_count = 0;
    //     foreach ($applid_array as $key => $value) 
    //     {
    //         $this->db->trans_begin();
    //         $case_no = $this->getSettlementAppDetailsByCaseNo($value);
    //         $dataInsert = array(
    //             'applid'  => $value, 
    //             'case_no' => $case_no->case_no,
    //             'user_code' => $this->session->userdata('user_code'),
    //             'dc_remarks' => $dc_remarks,
    //             'creation_date_time' => date('Y-m-d H:i:s'),
    //             'updation_date_time' => date('Y-m-d H:i:s'),
    //             'status' => 'R',
    //             'cron_status' => null

    //         );
    //         $insertStatus = $this->TransactionModel->insert("review_case_basic",$dataInsert);
    //         $settlementProceedingStatus = $this->settlementProceeding($case_no->case_no,$dc_remarks);
    //         if($insertStatus == 1 && $settlementProceedingStatus == 1)
    //         {
    //             $this->db->trans_commit();
    //             $success_count++;
    //             log_message("error",'#SUC-064 forward applications===='.$value);
    //         }
    //         else
    //         {
    //             $this->db->trans_rollback();
    //             log_message("error",'#ERROR-REVIEW-127 forward applications===='.$value);
    //         }
    //     }
    //     if($success_count == $total_count)
    //     {
    //         return array('responseType' => 2,'msg' => 'Forwarded to DLR successfully');
    //     }
    //     else if($success_count > 1)
    //     {
    //         return array('responseType' => 2,'msg' => 'Some of applications Forwarded to DLR successfully');
    //     }
    //     else
    //     {
    //         return array('responseType' => 3,'msg' => 'Error in forwarding');
    //     }
        
    // }

    // public function getSettlementAppDetailsByCaseNo($app)
    // {
    //     return $this->db->select('case_no')
    //         ->where('applid', $app)
    //         ->get('settlement_basic')
    //         ->row();

    // }

    // public function settlementProceeding($case_no,$dc_remarks)
    // {
    //     $proceeding_id=$this->db->query("Select max(proceeding_id)+1 as c from settlement_proceeding where case_no=? ",array($case_no))->row()->c;
    //     if($proceeding_id==null)
    //     {
    //         $proceeding_id=1;
    //     }

    //     $insPetProceed = [
    //         'case_no' => $case_no,
    //         'proceeding_id' => $proceeding_id,
    //         'date_of_hearing' => date('Y-m-d h:i:s'),
    //         'next_date_of_hearing' => date('Y-m-d h:i:s'),
    //         'status'      => MB_DLR_FORWARD,
    //         'user_code'   => $this->session->userdata('user_code'),
    //         'date_entry'  => date('Y-m-d h:i:s'),
    //         'operation'   => 'E',
    //         'ip'          => $this->utilityclass->get_client_ip(),
    //         'office_from' => $this->session->userdata('user_desig_code'),
    //         'office_to'   => MB_DLR,
    //         'task'        => 'Forwarded to DLR',
    //         'note_on_order' => $dc_remarks
    //     ];
    //     $insertProceeding = $this->db->insert('settlement_proceeding', $insPetProceed);
        
    //     if($insertProceeding != 1)
    //     {
    //         log_message('error', '#ERROR-REVIEW-246: Insertion failed in settlement_proceeding for case no :'. $case_no);
            
    //     }
    //     return $insertProceeding;
    // }
}
