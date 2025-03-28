<?php
class NcDepartController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
        if ($this->session->userdata('designation') != DPT_PS && $this->session->userdata('designation') != 'NIC') {
            $data['heading'] = "ERROR:: 404 Page Not Found";
            $data['message'] = 'The page you requested was not found';
            $this->load->view('errors/html/error_404', $data);
            $this->CI =& get_instance();
            $this->CI->output->_display();
            die;
        }

    }

    /** Dashboard Page */
    public function dashboard()
    {
        $dist_list = (array) json_decode(NC_DISTIRTCS);

        $url = API_LINK_NC_VILLAGE . "getDeptPendingProposalCount";
        $method = 'POST';
        $data['d'] = $dist_list;
        $data['type'] = 'ps_dashboard';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL #DLR00539');
            echo "API FAIL";
            return;
        }

        $data['count'] = json_decode($output);
        $this->db = $this->load->database('db2', TRUE);
        $data['pending_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = 'Y' and 
 				section_officer_verified='Y' and joint_secretary_verified='Y' and reverted is null
 				and secretary_verified ='Y' and status='A' and ps_verified is null")->row()->count;

        $data['forwarded_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = 'Y' and 
 				section_officer_verified = 'Y' and 
 				joint_secretary_verified='Y' and 
 				secretary_verified ='Y' and reverted is null and
 				ps_verified='Y' and status='A'")->row()->count;

        $data['approved_notification_by_minister'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = 'Y' and 
 				section_officer_verified = 'Y' and 
 				joint_secretary_verified='Y' and 
 				secretary_verified ='Y' and ps_verified='Y' and reverted is null
 				and minister_verified='Y' and status='A'
 				and ps_sign is null")->row()->count;
        $data['notification_sign_by_ps'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = 'Y' and 
 				section_officer_verified = 'Y' and 
 				joint_secretary_verified='Y' and 
 				secretary_verified ='Y' and ps_verified='Y' and reverted is null
 				and minister_verified='Y' and status='F'
 				and ps_sign ='Y'")->row()->count;
        $data['reverted_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = 'Y' and 
 				section_officer_verified = 'Y' and 
 				joint_secretary_verified='Y' and 
 				secretary_verified ='Y' and 
 				ps_verified='Y' and reverted ='Y' and minister_verified is null and status='A'")->row()->count;

        $data['_view'] = 'nc_village/department/dashboard';
        $this->load->view('layouts/main', $data);
    }

    /** View pending NC Villages Page */
    public function viewPendingCasesPage()
    {
        $data = [];
        $this->db = $this->load->database('auth', TRUE);
        $data['dist_list'] = (array) json_decode(NC_DISTIRTCS);

        $url = API_LINK_NC_VILLAGE . "apiGetAllPendingVillageDepart";

        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if(!$output) {
            $data['village'] = [];
        }
        else
        {
            $village = json_decode($output);
            $data['village'] = $village[0];
        }
        $data['_view'] = 'nc_village/department/pending_nc_villages';
        $this->load->view('layouts/main', $data);
        return;
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
        $data['pending'] = 'A';
        $data['verified'] = 'C';

        $url = API_LINK_NC_VILLAGE."apiGetNcVillaqes" ;

        $method = 'POST';
        $output = $this->NcVillageModel->callApi($url,$method,$data);
        echo json_encode($output->data);
        return;
    }

    /** get pending village details */
    public function getPendingVillage()
    {
        $this->db = $this->load->database('db2', TRUE);
        $data['d'] = $_GET['d'];
        $data['application_no'] = $_GET['application_no'];
        $data['pending'] = 'A';
        $data['verified'] = 'C';
        $data['user'] = 'DPART';
        $url = API_LINK_NC_VILLAGE."apiGetPendingVillageDepart";

        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if(!$output) {
            log_message("error", 'DEPT #DEPT0001');
            echo "Data Not Found.";
            return;
        }
        $output = json_decode($output);

        $data['locations'] = $output->locations;
        $data['nc_village'] = $nc_village =  $output->nc_village;
        $data['pdf'] = $output->pdf_base64;
        $data['approve_proposal'] = $output->approve_proposal;

        $this->db->select('id');
        $this->db->from('map_list');
        $this->db->where('dist_code', $nc_village->dist_code );
        $this->db->where('subdiv_code', $nc_village->subdiv_code );
        $this->db->where('cir_code', $nc_village->cir_code );
        $this->db->where('mouza_pargona_code', $nc_village->mouza_pargona_code );
        $this->db->where('lot_no', $nc_village->lot_no );
        $this->db->where('vill_townprt_code', $nc_village->vill_townprt_code );
        $query = $this->db->get();
        $map = array();
        if ( $query->num_rows() > 0 )
        {
            $map = $query->result_array();
        }

        $data['map'] = $map;

        $data['_view'] = 'nc_village/department/nc_village_dags';
        $this->load->view('layouts/main', $data);
    }

    /** get Dags details */
    public function getDags()
    {
        $data['d'] = $_POST['dist_code'];
        $data['application_no'] = $_POST['application_no'];
        $url = API_LINK_NC_VILLAGE."apiGetDags";

        $method = 'POST';
        $output = $this->NcVillageModel->callApi($url,$method,$data);
        if ($output->data==null)
        {
            log_message("error", 'DEPT #DEPT0002');
            echo json_encode(array('success' => 'N'));
            return;
        }

        echo json_encode(array('success' => 'Y','dags' => $output->data->dags, 'dc_name' => $output->data->dc));
        return;
    }

    /** Certify village */
    public function certifyVillage()
    {
        $dist_code = $_POST['dist_code'];
        $application_no = $_POST['application_no'];
        $remark = $_POST['remark'];
        $data['user_code'] = $this->session->userdata('user_code');

        $url = API_LINK_NC_VILLAGE."apiDepartCertify" ;
        $method = 'POST';

        $data['dist_code'] = $dist_code;
        $data['application_no'] = $application_no;
        $data['depart_note'] = $remark;

        $output = $this->NcVillageModel->callApi($url,$method, $data);

        if ($output->data==null)
        {
            log_message("error", 'DEPT #DEPT0003');
            echo json_encode(array('success' => 'N'));
            return;
        }

        echo json_encode(array('success' => 'Y','submitted' => $output->data, 'nc_village' => $output->nc_village));
        return;
    }

	/** Get PS Pending and Verified Proposal */
    public function viewPsProposal($type)
    {
        $dist_list = (array) json_decode(NC_DISTIRTCS);

        $url = API_LINK_NC_VILLAGE . "getDeptProposal";
        $method = 'POST';
        $data['d'] = $dist_list;
        $data['user'] = 'ps';
        $data['type'] = $type;
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL NcDepartController #DEPT005339');
            echo "API FAIL";
            return;
        }

        $data['proposal'] = json_decode($output);
        $data['_view'] = 'nc_village/department/proposal_list';
        $this->load->view('layouts/main', $data);
    }

    /** proposal Forward */
    public function proposalForward()
    {
        $url = API_LINK_NC_VILLAGE . "deptForwardProposal";
        $method = 'POST';
        $data['proposal_no'] = $this->input->post('proposal_no');
        $data['proposal_id'] = $this->input->post('proposal_id');
        $data['note'] = $this->input->post('note');
        $data['dist_code'] = $this->input->post('dist_code');
        $data['user_code'] = $this->session->userdata('user_code');
        $data['user'] = 'ps';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL_API FAIL NcDepartController #PS000001');
            echo "API FAIL";
            return;
        }
        $output = json_decode($output);

        if($output == "Y")
        {
            echo json_encode(array(
                'status' => '1',
            ));
        }else{
            log_message("error", 'PS FORWARDED FAIL NcDepartController #PS000002');
            echo json_encode(array(
                'status' => '0',
            ));
        }
        return;
    }

    /** proposal revert back */
    public function proposalRevert()
    {
        $url = API_LINK_NC_VILLAGE . "revertBackProposal";
        $method = 'POST';
        $data['proposal_id'] = $this->input->post('proposal_id');
        $data['proposal_no'] = $this->input->post('proposal_no');
        $data['note'] = $this->input->post('note');
        $data['dist_code'] = $this->input->post('dist_code');
        $data['user_code'] = $this->session->userdata('user_code');
        $data['user'] = 'ps';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'PS_PROPOSAL_Revert FAIL NcDepartController #PS000006');
            echo json_encode('N');
            return;
        }
        $output = json_decode($output);

        echo json_encode($output);
        return;
    }

    /** Get View Pending and Verified Notification */
    public function viewNotification($type)
    {
        $user = 'ps';
        $data['type'] = $type;
        $data['notification'] = $this->NcVillageModel->getGeneratedNotification($type, $user);
        $data['_view'] = 'nc_village/department/notification_list';
        $this->load->view('layouts/main', $data);
    }

    /** view Approved Notification */
    public function viewApprovedNotification($type)
    {
        $user = 'ps';
        $data['type'] = $type;
        $data['notification'] = $this->NcVillageModel->getApprovedNotification($type, $user);
        $data['_view'] = 'nc_village/department/approved_notification_list';
        $this->load->view('layouts/main', $data);
    }

    /** sign approved notification */
    public function saveApprovedNotificationPdf()
    {
        $notification_id= $this->input->post('notification_id');
        $dist_code= $this->input->post('dist_code');
        $notification_no = $this->input->post('notification_no');
        $user = 'ps';
        $content = $this->NcVillageModel->getNotification($notification_id,$dist_code,$user);

        ini_set("pcre.backtrack_limit", "500000000");
        ini_set('max_execution_time', '0');
        include 'vendor/mpdf/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 12,
            'default_font' => 'dejavusans',
            'orientation' => 'P',
            'format' => 'A4',
        ]);

        $file_name = $notification_no;
        if (!is_dir(NC_VILLAGE_NOTIFICATION_DIR . 'ps')) {
            mkdir(NC_VILLAGE_NOTIFICATION_DIR . 'ps', 0777, true);
        }
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $mpdf->writeHTML($content);

        header('Content-type: application/pdf');
        ob_clean();

        $file_path = NC_VILLAGE_NOTIFICATION_DIR . 'ps' . '/' . $file_name . '.pdf';
        $mpdf->Output(NC_VILLAGE_NOTIFICATION_DIR . 'ps' . '/' . $file_name . '.pdf', 'F');

        $pdfData = file_get_contents($file_path);
        $base64EncodedPDF = base64_encode($pdfData);
        echo json_encode($base64EncodedPDF);
    }
    public function storeSignedNotification()
    {
        $this->db = $this->load->database('db2', TRUE);
        $proposal_no = $this->input->post('proposal_no');
        $notification_id = $this->input->post('notification_id');
        $notification_no = $this->input->post('notification_no');
        $sign_key = $this->input->post('sign_key');
        $pdfbase = $this->input->post('pdfbase');
        $note = $this->input->post('note');
        $pdf_content = base64_decode($pdfbase);
        $pdfFilePath = NC_VILLAGE_NOTIFICATION_DIR . 'ps' . '/' . $notification_no . '.pdf';

        $dist = $this->input->post('dist_code');
        if ($pdfbase !== false) {
            if (!is_dir(NC_VILLAGE_NOTIFICATION_DIR . 'ps')) {
                mkdir(NC_VILLAGE_NOTIFICATION_DIR . 'ps', 0777, true);
            }
            $pdf_path = $pdfFilePath;

            // Save the PDF content to the file
            if (file_put_contents($pdf_path, $pdf_content) !== false) {
                $response = $this->db->where('id', $notification_id)
                    ->update('nc_village_gen_notification', array(
                        'ps_sign_user_code' => $this->session->userdata('user_code'),
                        'ps_sign' => 'Y',
                        'ps_sign_note' => $note,
                        'ps_sign_key' => $sign_key,
                        'ps_sign_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'status' => 'F',
                    ));

                if ($response == true) {
                    echo json_encode(array(
                        'status' => '1',
                        'update' => '1',
                        'msg' => 'Notification signed successfully',
                    ));
                    return;
                } else {
                    echo json_encode(array(
                        'status' => '0',
                        'update' => '0',
                        'msg' => 'Failed Notification signing',
                    ));
                    return;
                }
            } else {
                echo json_encode(array(
                    'status' => '0',
                    'update' => '0',
                    'msg' => 'Failed Notification signing (Unable to save file)',
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

    /** view Sec notification file */
    public function viewSecNotification()
    {
        $this->db = $this->load->database('db2', TRUE);
        $notification_id= $this->input->post('notification_id');
        $dist_code= $this->input->post('dist_code');

        $this->db->select('secretary_notification');
        $this->db->from('nc_village_gen_notification');
        $this->db->where('id', $notification_id);
        $this->db->where('dist_code', $dist_code);
        $query = $this->db->get();
        $secretary_notification = null;
        if ( $query->num_rows() > 0 )
        {
            $secretary_notification = $query->row()->secretary_notification;
        }

        echo json_encode(array(
            'data' => $secretary_notification,
            'status' => '1',
        ));
    }

    /** Get Forward Notification */
    public function notificationForward()
    {
        $data['note'] = $note = $this->input->post('note');
        $data['proposal_no'] = $this->input->post('proposal_no');
        $notification = $this->input->post('notification');
        $notification_id = $this->input->post('notification_id');
        $data['dist_code'] = $dist_code= $this->input->post('dist_code');
        $data['user_code'] = $user_code = $this->session->userdata('user_code');
        $user = 'ps';
        $output = $this->NcVillageModel->forwardedNcNotification($notification_id,$notification,$note,$dist_code,$user);
        if($output == "Y")
        {
            $url = API_LINK_NC_VILLAGE . "insertProceedingPost";
            $method = 'POST';
            $data['from'] = 'Senior Most Secretary';
            $data['to'] = 'Honourable Minister,R&DM Department';
            $data['task'] = 'Notification forwarded to Honourable Minister,R&DM Department';
            $output1 = $this->NcVillageModel->callApiV2($url, $method, $data);
            if (!$output1) {
                log_message("error", 'Notification_Forward FAIL NcDepartController #DEPT000008');
            }
            echo json_encode($output);
        }else{
            log_message("error", 'FORWARDED FAIL NcDepartController #DEPT000004');
            echo json_encode($output);
        }
        return;
    }

    /** view my Verified notification file */
    public function viewVerifiedNotification()
    {
        $notification_id= $this->input->post('notification_id');
        $dist_code= $this->input->post('dist_code');

        $user = 'ps';
        $output = $this->NcVillageModel->getNotification($notification_id,$dist_code,$user);

        if($output != null)
        {
            echo json_encode(array(
                'data' => $output,
                'status' => '1',
            ));
        }
        else
        {
            echo json_encode(array(
                'data' => $output,
                'status' => '0',
            ));
        }
    }

    /** Notification RevertBackToDLRS  */
    public function notificationRevertBackToDLRS()
    {
        $data['note'] = $note = $this->input->post('note');
        $data['proposal_no'] =$proposal_no= $this->input->post('proposal_no');
        $notification = $this->input->post('notification');
        $notification_id = $this->input->post('notification_id');
        $data['dist_code'] = $dist_code= $this->input->post('dist_code');
        $data['user_code'] = $user_code = $this->session->userdata('user_code');
        $user = 'ps';
        $output = $this->NcVillageModel->notificationRevertBackToDLRS($notification_id,$notification,$note,$dist_code,$user);
        if($output == "Y")
        {
            $url = API_LINK_NC_VILLAGE . "insertProceedingPost";
            $method = 'POST';
            $data['from'] = 'Senior Most Secretary';
            $data['to'] = 'DLRS';
            $data['task'] = 'Notification reverted to DLRS';
            $output1 = $this->NcVillageModel->callApiV2($url, $method, $data);
            if (!$output1) {
                log_message("error", 'Notification_reverted FAIL NcDepartController #DEPT0000010');
            }
            echo json_encode($output);
        }else{
            log_message("error", 'Reverted FAIL NcDepartController #DEPT0000011');
            echo json_encode($output);
        }
        return;
    }

	public function getProposalBase($notification_no)
    {
        $pdfFilePath = NC_VILLAGE_NOTIFICATION_DIR . 'ps' . '/' . $notification_no . '.pdf';
        header("Content-Type: application/pdf");
        echo (file_get_contents($pdfFilePath));
        return;
    }

}