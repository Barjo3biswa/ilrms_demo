<?php
class NcDlrController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
        if ($this->session->userdata('designation') != DLR && $this->session->userdata('designation') != ADLR && $this->session->userdata('designation') != 'NIC') {
            $data['heading'] = "ERROR:: 404 Page Not Found";
            $data['message'] = 'The page you requested was not found';
            $this->load->view('errors/html/error_404', $data);
            $this->CI = &get_instance();
            $this->CI->output->_display();
            die;
        }
    }

    /** Dashboard */
    public function dashboard()
    {
        $this->db = $this->load->database('db2', TRUE);

        $dist_list = (array) json_decode(NC_DISTIRTCS);

        $url = API_LINK_NC_VILLAGE . "getDlrPendingVillages";
        $method = 'POST';

        $data['d'] = $dist_list;

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DLR_PROPOSAL #DLR00439');
            echo "API FAIL";
            return;
        }
        $output = json_decode($output);

        $data['approved_notification_by_dlrs'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = ? and 
 				section_officer_verified = ? and 
 				joint_secretary_verified=? and 
 				secretary_verified =? and ps_verified=?
 				and minister_verified=?
 				and ps_sign =? and dlr_verified=?",array('Y','Y','Y','Y','Y','Y','Y','Y'))->row()->count;
        $data['pending_notification_sign_by_ps'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = ? and 
 				section_officer_verified = ? and 
 				joint_secretary_verified=? and 
 				secretary_verified =? and ps_verified=?
 				and minister_verified=?
 				and ps_sign =? and status !=?
 				and dlr_verified is null",array('Y','Y','Y','Y','Y','Y','Y','R'))->row()->count;

        $data['revert_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = ? and 
 				section_officer_verified = ? and 
 				joint_secretary_verified=? and 
 				secretary_verified =? and 
 				ps_verified=? and status=?",array('Y','Y','Y','Y','Y','R'))->row()->count;

        $data['count'] = $output->data;
        $data['_view'] = 'nc_village/dlr/dashboard';
        $this->load->view('layouts/main', $data);
    }

    /** View pending NC Villages Page */
    public function viewPendingCasesPage()
    {
        $data = [];
        $this->db = $this->load->database('auth', true);
        $data['dist_list'] = (array) json_decode(NC_DISTIRTCS);
        $url = API_LINK_NC_VILLAGE . "apiGetAllPendingVillageDlr";

        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if(!$output) {
            $data['village'] = [];
        }
        else
        {
            $village = json_decode($output);
            $data['village'] = $village;
        }
    	$data['_view'] = 'nc_village/dlr/pending_nc_villages';
        $this->load->view('layouts/main', $data);
        return;
    }

    /** pending NC Villages  */
    public function getPendingVillages()
    {
        $data = [];
        $this->db = $this->load->database('auth', true);
        $data['dist_list'] = (array) json_decode(NC_DISTIRTCS);
        $url = API_LINK_NC_VILLAGE . "apiGetAllPendingVillageDlr";

        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if(!$output) {
            $data['village'] = [];
        }
        else
        {
            $village = json_decode($output);
            $data['village'] = $village;
        }
        echo json_encode($data['village']);
    }

    /** Get all pending Villages */
    public function getVillagesG()
    {
        $data['d'] = $this->input->post('dist_code');
        $data['s'] = $this->input->post('subdiv_code');
        $data['c'] = $this->input->post('cir_code');
        $data['m'] = $this->input->post('mouza_pargona_code');
        $data['l'] = $this->input->post('lot_no');
        $data['f'] = $this->input->post('filter');
        $data['pending'] = 'I';
        $data['verified'] = 'A';
        $data['user'] = 'DLR';

        $url = API_LINK_NC_VILLAGE . "apiGetNcVillaqes";
        $method = 'POST';
        $output = $this->NcVillageModel->callApi($url, $method, $data);
        echo json_encode($output->data);
        return;
    }

    /** get pending village details */
    public function getPendingVillage()
    {
    	$this->db = $this->load->database('db2', TRUE);
        $data['d'] = $_GET['d'];
        $data['application_no'] = $_GET['application_no'];
        $data['pending'] = 'I';
        $data['verified'] = 'A';
        $url = API_LINK_NC_VILLAGE . "apiGetPendingVillage";

        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if(!$output) {
            log_message("error", 'DLR_PENDING_VILL #DLR00011');
            echo "Data Not Found.";
            return;
        }
        $output = json_decode($output);

        $data['locations'] = $output->data->locations;
        $data['nc_village'] = $nc_village = $output->data->nc_village;
        $data['pdf'] = $output->data->pdf_base64;
        $data['proposal_pdf'] = $output->data->proposal_pdf_base64;

        $this->db->select('id');
        $this->db->from('map_list');
        $this->db->where('dist_code', $nc_village->dist_code);
        $this->db->where('subdiv_code', $nc_village->subdiv_code);
        $this->db->where('cir_code', $nc_village->cir_code);
        $this->db->where('mouza_pargona_code', $nc_village->mouza_pargona_code);
        $this->db->where('lot_no', $nc_village->lot_no);
        $this->db->where('vill_townprt_code', $nc_village->vill_townprt_code);
        $query = $this->db->get();
        $map = array();
        if ($query->num_rows() > 0) {
            $map = $query->result_array();
        }

        $data['map'] = $map;

        $data['_view'] = 'nc_village/dlr/nc_village_dags';
        $this->load->view('layouts/main', $data);
    }
    public function getPendingVillageData()
    {
        $this->db = $this->load->database('db2', TRUE);
        $data['d'] = $this->input->post('dist_code');
        $data['application_no'] = $this->input->post('application_no');
        $data['pending'] = 'I';
        $data['verified'] = 'A';
        $url = API_LINK_NC_VILLAGE . "apiGetPendingVillage";

        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if(!$output) {
            log_message("error", 'DLR_PENDING_VILL #DLR00011');
            echo "Data Not Found.";
            return;
        }
        $output = json_decode($output);

        echo json_encode($output->data->nc_village);

    }
    /** get Dags details */
    public function getDags()
    {
        $data['d'] = $_POST['dist_code'];
        $data['application_no'] = $_POST['application_no'];

        $url = API_LINK_NC_VILLAGE . "apiGetDags";
        $method = 'POST';

        $output = $this->NcVillageModel->callApi($url, $method, $data);

        if ($output == null) {
            log_message("error", 'DLR_GET_DAG #DLR0002');
            echo json_encode(array('success' => 'N'));
            return;
        }

        echo json_encode(array('success' => 'Y', 'dags' => $output->data->dags, 'dc_name' => $output->data->dc, 'change_vill' => $output->data->change_vill));
        return;
    }

    /** Certify village */
    public function certifyVillage()
    {
        $dist_code = $_POST['dist_code'];
        $application_no = $_POST['application_no'];
        $dlr_remark = $_POST['remark'];
        $change_village_remark = $_POST['change_village_remark'];
        $data['uuid'] = $_POST['uuid'];
        $data['user'] = 'DLR';
        $remarks = "DLRS Remark:<br>". $dlr_remark ."<br> Village Name Change:<br>". $change_village_remark;
        $url = API_LINK_NC_VILLAGE . "apiDlrCertify";
        $method = 'POST';

        $data['dist_code'] = $dist_code;
        $data['application_no'] = $application_no;
        $data['dlr_note'] = $dlr_remark;
        $data['remarks'] = $remarks;
        $data['user_code'] = $this->session->userdata('user_code');

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'API FAILED DLR_CERTIFY #DLR0003');
            echo json_encode(array('submitted' => 'N', 'nc_village' => []));
            return;
        }
        $output = json_decode($output);

        echo json_encode(array('submitted' => $output->data, 'nc_village' => $output->nc_village));
        return;
    }

    //change vill name
    public function changeVill()
    {
        $url = API_LINK_NC_VILLAGE . "changeVillDLR";
        $method = 'POST';

        $data['dist_code'] = $_POST['dist_code'];
        $data['uuid'] = $_POST['uuid'];
        $data['new_vill_name'] = $_POST['new_vill_name'];
        $data['new_vill_name_eng'] = $_POST['new_vill_name_eng'];
		$data['change_vill_remark'] = $_POST['change_vill_remark'];
        $data['application_no'] = $_POST['application_no'];
        $data['user_code'] = $this->session->userdata('user_code');
        $data['user'] = 'DLR';

        $output = $this->NcVillageModel->callApi($url, $method, $data);
        if ($output == null) {
            log_message("error", 'DLR_CHNGE_VILL #DLR0020');
            $arr = array(
                'data' => 'N',
                'status_code' => 200,
            );
            echo json_encode($arr);
            return;
        }

        echo json_encode(array('verified' => $output->data));
        return;
    }

    /** revert back to dc  */
    public function revertVillage()
    {
        $url = API_LINK_NC_VILLAGE . "apiDlrRevert";
        $method = 'POST';

        $data['dist_code'] = $_POST['dist_code'];
        $data['application_no'] = $_POST['application_no'];
        $data['dlr_note'] = $_POST['remark'];
        $data['user_code'] = $this->session->userdata('user_code');
        $data['user'] = 'DLR';

        $output = $this->NcVillageModel->callApi($url, $method, $data);

        if ($output->data == null) {
            log_message("error", 'DLR_REVERT_VILL #DLR0004');
            echo json_encode(array('submitted' => 'N', 'nc_village' => []));
            return;
        }

        echo json_encode(array('submitted' => $output->data, 'nc_village' => $output->nc_village));
        return;
    }

    /** SHOW PROPOSAL DIST WISE */
    public function showProposalDistWise()
    {
        $dist_list = (array) json_decode(NC_DISTIRTCS);

        $url = API_LINK_NC_VILLAGE . "getDlrPendingProposal";
        $method = 'POST';

        $data['d'] = $dist_list;

        $output = $this->NcVillageModel->callApi($url, $method, $data);

        if ($output == null) {
            log_message("error", 'DLR_PROPOSAL #DLR00019');
            echo "API FAIL";
            return;
        }

        $data['dist_list'] = $output->data;

        $data['_view'] = 'nc_village/dlr/proposal_dist';
        $this->load->view('layouts/main', $data);
    }

    /** showProposalVillages */
    public function showProposalVillages($dist_code)
    {
        $url = API_LINK_NC_VILLAGE . "apiDlrProposal";
        $method = 'POST';

        $data['d'] = $dist_code;

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if (!$output) {
            log_message("error", 'DLR_PROPOSAL #DLR00111109');
            echo "API FAIL";
            return;
        }

        $output = json_decode($output);
        $data['locations'] = $output->locations;
        $data['nc_village'] = $output->nc_village;
//        $data['proposal'] = $output->proposal;
        $data['approve_proposal'] = $output->approve_proposal;

        $data['_view'] = 'nc_village/dlr/proposal_villages';
        $this->load->view('layouts/main', $data);
    }

    /** Proposal pending NC Villages  */
    public function getProposalPendingVillages()
    {
        $data['d'] = $this->input->post('dist_code');
        $url = API_LINK_NC_VILLAGE . "apiDlrProposal";

        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if(!$output) {
            $data['nc_village'] = [];
        }
        else
        {
            $output = json_decode($output);
            $data['nc_village'] = $output->nc_village;
        }
        echo json_encode($data['nc_village']);
    }

    /** view approval notification */
    public function saveProposalPdf()
    {
        $url = API_LINK_NC_VILLAGE . "apiDlrProposalVillageWise";
        $method = 'POST';

        $data['d'] = $this->input->post('dist_code');
        $data['village_id'] = $this->input->post('village_id');
        $data['user'] = 'DLR';

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DLR_PROPOSAL #DLR00079');
            echo "API FAIL";
            return;
        }
        $output = json_decode($output);

        $data['proposal'] = $output->proposal;

        $content = $data['proposal'];
        ini_set("pcre.backtrack_limit", "500000000");
        ini_set('max_execution_time', '0');
        include 'vendor/mpdf/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 12,
            'default_font' => 'dejavusans',
            'orientation' => 'P',
            'format' => 'A4',
        ]);

        $file_id = time();

        $file_name = "PR_" . $data['d'] . $file_id . "_NC";
        $this->session->set_userdata('proposal_file_name', $file_name);
        if (!is_dir(NC_VILLAGE_NOTIFICATION_DIR . 'dlr')) {
            mkdir(NC_VILLAGE_NOTIFICATION_DIR . 'dlr', 0777, true);
        }
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->writeHTML($content);

        header('Content-type: application/pdf');
        ob_clean();

        $file_path = NC_VILLAGE_NOTIFICATION_DIR . 'dlr' . '/' . $file_name . '.pdf';
        $mpdf->Output(NC_VILLAGE_NOTIFICATION_DIR . 'dlr' . '/' . $file_name . '.pdf', 'F');

        $pdfData = file_get_contents($file_path);
        $base64EncodedPDF = base64_encode($pdfData);
        echo json_encode($base64EncodedPDF);
    }
    public function storeSignedProposal()
    {
        $pdfFilePath = NC_VILLAGE_NOTIFICATION_DIR . 'dlr' . '/' . $this->session->userdata('proposal_file_name') . '.pdf';
        $proposal_no = $this->session->userdata('proposal_file_name');
        $sign_key = $this->input->post('sign_key');
        $pdfbase = $this->input->post('pdfbase');
        $user = 'DLR';
        $pdf_content = base64_decode($pdfbase);

        $dist = $this->input->post('dist_code');
        if ($pdfbase !== false) {
            if (!is_dir(NC_VILLAGE_NOTIFICATION_DIR . 'dlr')) {
                mkdir(NC_VILLAGE_NOTIFICATION_DIR . 'dlr', 0777, true);
            }
            $pdf_path = $pdfFilePath;

            // Save the PDF content to the file
            if (file_put_contents($pdf_path, $pdf_content) !== false) {
                $url = API_LINK_NC_VILLAGE . "updateDlrProposal";
                $method = 'POST';

                $data['dist_code'] = $dist;
                $data['proposal_no'] = $proposal_no;
                $data['sign_key'] = $sign_key;
                $data['user_code'] = $this->session->userdata('user_code');
                $data['user_type'] = $user;
                $data['village_id'] = $this->input->post('village_id');
                $data['forward_to'] = $this->input->post('forward_to');
                $data['dlr_note'] = $this->input->post('dlr_note');

                $output = $this->NcVillageModel->callApiV2($url, $method, $data);
                $response = $output ? json_decode($output)->status : '0';
                if ($response == '1') {
                    echo json_encode(array(
                        'status' => '1',
                        'update' => '1',
                        'msg' => 'Proposal signed successfully',
                    ));
                    return;
                } else {
                    echo json_encode(array(
                        'status' => '0',
                        'update' => '0',
                        'msg' => 'Failed Proposal signing',
                    ));
                    return;
                }
            } else {
                echo json_encode(array(
                    'status' => '0',
                    'update' => '0',
                    'msg' => 'Failed Proposal signing (Unable to save file)',
                ));
                return;
            }
        } else {
            echo json_encode(array(
                'status' => '0',
                'update' => '0',
                'msg' => 'Invalid base64-encoded PDF content',
            ));
            return;
        }
    }
  
  	public function getProposalBase()
    {
        $pdfFilePath = NC_VILLAGE_NOTIFICATION_DIR . 'dlr' . '/' . $this->session->userdata('proposal_file_name') . '.pdf';
        header("Content-Type: application/pdf");
        echo (file_get_contents($pdfFilePath));
        return;
    }
    /** show Pending Notification */
    public function showNotification($type)
    {
        $user = 'dlr';
        $data['type'] = $type;
        $data['notification'] = $this->NcVillageModel->getApprovedNotification($type, $user);
        $data['_view'] = 'nc_village/dlr/approved_notification_list';
        $this->load->view('layouts/main', $data);
    }

    /** show Reverted Proposal */
    public function showRevertedProposal($type)
    {
        $user = 'dlr';
        $data['type'] = $type;
        $data['notification'] = $this->NcVillageModel->getRevertedProposal($type, $user);

        $url = API_LINK_NC_VILLAGE . "getProposal";
        $method = 'POST';
        $data['user'] = 'dlr';
        $data['type'] = 'revertedfromadlrps';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DLR_PROPOSAL #DLRS0068');
            echo "API FAIL";
            return;
        }
        $output = json_decode($output);

        $data['proposal'] = $output->adlr_reverted;
        $data['ps_proposal'] = $output->ps_reverted;

        $data['_view'] = 'nc_village/dlr/reverted_proposal';
        $this->load->view('layouts/main', $data);
    }

    /** Revert Back Proposal and notification */
    public function revertBackProposal()
    {
        $url = API_LINK_NC_VILLAGE . "deptRevertBackProposal";
        $method = 'POST';
        $data['proposal_id'] = $proposal_id = $this->input->post('proposal_id');
        $data['note'] = $note = $this->input->post('note');
        $data['notification_id'] = $notification_id = $this->input->post('notification_id');
        $data['dist_code'] = $dist_code = $this->input->post('dist_code');
        $data['user_code']  = $this->session->userdata('user_code');
        $data['user'] = $user = 'dlr';

        $this->db = $this->load->database('db2', TRUE);

        $this->db->trans_begin();
        $this->db->where('id', $notification_id)
            ->update('nc_village_gen_notification', array(
                'dlr_user_code' => $this->session->userdata('user_code'),
                'dlr_verified_at' => date('Y-m-d H:i:s'),
                'dlr_verified' => 'Y',
                'dlr_note' => $note,
                'status' => 'S',
            ));
        if($this->db->affected_rows() == 1) {
            $output = $this->NcVillageModel->callApiV2($url, $method, $data);
            if (!$output) {
                $this->db->trans_rollback();
                log_message("error", 'DEPT_PROPOSAL_REVERT FAIL NcDlrController #DLRO000353');
                echo "API FAIL";
                return;
            }
            $output = json_decode($output);

            if($output == "Y")
            {
                $this->db->trans_commit();
                echo json_encode('Y');
                return;
            }else{
                $this->db->trans_rollback();
                echo json_encode('N');
                return;
            }
        }else{
            $this->db->trans_rollback();
            echo json_encode('N');
            return;
        }
    }

    /** Send Message */
    public function sendMessage()
    {
        $notification_id = $this->input->post('notification_id');
        $adlr_note = $this->input->post('adlr_note');
        $jds_note = $this->input->post('jds_note');
        $user = 'dlr';
        $response = $this->NcVillageModel->dlrSendMessage($notification_id, $adlr_note, $jds_note, $user);
        if($response=='Y')
        {
            echo json_encode('Y');
        }else{
            echo json_encode('N');
        }
        return;
    }

    /** get proposal village wise */
    public function getProposalVillageWise()
    {
        $url = API_LINK_NC_VILLAGE . "apiDlrProposalVillageWise";
        $method = 'POST';

        $data['d'] = $_POST['dist_code'];
        $data['village_id'] = $_POST['village_id'];
        $data['user'] = 'DLR';

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DLR_PROPOSAL #DLR0079');
            echo "API FAIL";
            return;
        }
        $output = json_decode($output);

        echo json_encode(array(
            'status' => 'Y',
            'data' => $output->proposal
        ));
    }

    /** proposal Forward */
    public function proposalForward()
    {
        $url = API_LINK_NC_VILLAGE . "deptForwardProposal";
        $method = 'POST';
        $data['proposal_id'] = $this->input->post('proposal_id');
        $data['proposal_no'] = $this->input->post('proposal_no');
        $data['note'] = $this->input->post('note');
        $data['dist_code'] = $this->input->post('dist_code');
        $data['user_code'] = $this->session->userdata('user_code');
        $data['user'] = 'dlr';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DLR_PROPOSAL_API FAIL NcDlrController #DLR000091');
            echo "API FAIL #DLR000091";
            return;
        }
        $output = json_decode($output);

        if($output == "Y")
        {
            echo json_encode(array(
                'status' => '1',
            ));
        }else{
            log_message("error", 'FORWARDED FAIL NcDlrController #DLR000092');
            echo json_encode(array(
                'status' => '0',
            ));
        }
        return;
    }

    /** proposal forward to ADLR */
    public function proposalForwardtoAdlr()
    {
        $url = API_LINK_NC_VILLAGE . "apiDlrProposalVillageWise";
        $method = 'POST';

        $data['d'] = $_POST['dist_code'];
        $data['village_id'] = $_POST['village_id'];
        $data['dlr_note'] = $_POST['dlr_note'];

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DLR_PROPOSAL #DLR0080');
            echo "API FAIL";
            return;
        }
        $output = json_decode($output);
        $content = $output->proposal;

        ini_set("pcre.backtrack_limit", "500000000");
        ini_set('max_execution_time', '0');
        include 'vendor/mpdf/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 12,
            'default_font' => 'dejavusans',
            'orientation' => 'P',
            'format' => 'A4',
        ]);

        $file_id = time();

        $file_name = "PR_" . $data['d'] . $file_id . "_NC";
        if (!is_dir(NC_VILLAGE_NOTIFICATION_DIR . 'dlr')) {
            mkdir(NC_VILLAGE_NOTIFICATION_DIR . 'dlr', 0777, true);
        }
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->writeHTML($content);

        header('Content-type: application/pdf');
        ob_clean();

        $file_path = NC_VILLAGE_NOTIFICATION_DIR . 'dlr' . '/' . $file_name . '.pdf';
        $mpdf->Output(NC_VILLAGE_NOTIFICATION_DIR . 'dlr' . '/' . $file_name . '.pdf', 'F');

        if(file_exists($file_path))
        {
            $url = API_LINK_NC_VILLAGE . "updateDlrProposal";
            $method = 'POST';

            $data['dist_code'] = $this->input->post('dist_code');
            $data['proposal_no'] = $file_name;
            $data['user_code'] = $this->session->userdata('user_code');
            $data['user_type'] = 'DLR';
            $data['sign_key'] = null;
//            $data['village_id'] = $this->input->post('village_id');
            $data['forward_to'] = $this->input->post('forward_to');
            $data['dlr_note'] = $this->input->post('dlr_note');

            $output = $this->NcVillageModel->callApiV2($url, $method, $data);
            $response = $output ? json_decode($output)->status : '0';
            if ($response == '1') {
                echo json_encode(array(
                    'status' => 'Y',
                    'update' => '1',
                    'msg' => 'Proposal forwarded successfully',
                ));
                return;
            }
        }

        echo json_encode(array(
            'status' => 'N',
            'msg' => 'Please contact the system admin',
        ));
    }

    /** Get Proposal base64 */
    public function getProposalBase64()
    {
        $name = $this->input->post('proposal_no');
        $pdfData = file_get_contents(NC_VILLAGE_NOTIFICATION_DIR.'dlr/'.$name.'.pdf');
        $base64EncodedPDF = base64_encode($pdfData);
        echo json_encode(array(
            'status' => 'Y',
            'data' => $base64EncodedPDF,
        ));
    }	
    public function getProposalBaseReverted($proposal_no)
    {
        $name = $proposal_no;
        $pdfFilePath = NC_VILLAGE_NOTIFICATION_DIR . 'dlr' . '/' . $name . '.pdf';
        header("Content-Type: application/pdf");
        echo (file_get_contents($pdfFilePath));
        return;
    }
    public function storeSignedProposalReverted(){
        $proposal_no = $this->input->post('proposal_no');
        $pdfFilePath = NC_VILLAGE_NOTIFICATION_DIR . 'dlr' . '/' . $proposal_no . '.pdf';
        $sign_key = $this->input->post('sign_key');
        $pdfbase = $this->input->post('pdfbase');
        $user = 'DLR';
        $pdf_content = base64_decode($pdfbase);

        $dist = $this->input->post('dist_code');
        if ($pdfbase !== false) {
            if (!is_dir(NC_VILLAGE_NOTIFICATION_DIR . 'dlr')) {
                mkdir(NC_VILLAGE_NOTIFICATION_DIR . 'dlr', 0777, true);
            }
            $pdf_path = $pdfFilePath;

            // Save the PDF content to the file
            if (file_put_contents($pdf_path, $pdf_content) !== false) {
                $url = API_LINK_NC_VILLAGE . "updateDlrProposalReverted";
                $method = 'POST';

                $data['dist_code'] = $dist;
                $data['proposal_no'] = $proposal_no;
                $data['sign_key'] = $sign_key;
                $data['user_code'] = $this->session->userdata('user_code');
                $data['user_type'] = $user;
                $data['forward_to'] = 'A';
                $data['dlr_note'] = $this->input->post('dlr_note');

                $output = $this->NcVillageModel->callApiV2($url, $method, $data);
                $response = $output ? json_decode($output)->status : '0';
                if ($response == '1') {
                    echo json_encode(array(
                        'status' => '1',
                        'update' => '1',
                        'msg' => 'Proposal signed successfully',
                    ));
                    return;
                } else {
                    echo json_encode(array(
                        'status' => '0',
                        'update' => '0',
                        'msg' => 'Failed Proposal signing',
                    ));
                    return;
                }
            } else {
                echo json_encode(array(
                    'status' => '0',
                    'update' => '0',
                    'msg' => 'Failed Proposal signing (Unable to save file)',
                ));
                return;
            }
        } else {
            echo json_encode(array(
                'status' => '0',
                'update' => '0',
                'msg' => 'Invalid base64-encoded PDF content',
            ));
            return;
        }
    }

    /** Revert Back to dc Proposal only */
    public function revertBackDcProposal()
    {
        $url = API_LINK_NC_VILLAGE . "deptRevertBackProposal";
        $method = 'POST';
        $data['proposal_id'] = $proposal_id = $this->input->post('proposal_id');
        $data['note'] = $note = $this->input->post('note');
        $data['dist_code'] = $dist_code = $this->input->post('dist_code');
        $data['user_code']  = $this->session->userdata('user_code');
        $data['user'] = $user = 'DLR';

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            $this->db->trans_rollback();
            log_message("error", 'DLR_PROPOSAL_REVERT FAIL NcDlrController #DLRO000453');
            echo json_encode('N');
            return;
        }
        $output = json_decode($output);

        if($output == "Y")
        {
            echo json_encode('Y');
            return;
        }else{
            echo json_encode('N');
            return;
        }
    }
	/** View pending NC Villages Page */
    public function viewNameChangePendings()
    {
        $data = [];
        $this->db = $this->load->database('auth', true);
        $data['dist_list'] = (array) json_decode(NC_DISTIRTCS);
        $url = API_LINK_NC_VILLAGE . "apiGetAllNameChangePendingsDlr";

        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if(!$output) {
            $data['village'] = [];
        }
        else
        {
            $village = json_decode($output);
            $data['village'] = $village;
        }
    	$data['_view'] = 'nc_village/dlr/pending_name_changes';
        $this->load->view('layouts/main', $data);
        return;
    }
}