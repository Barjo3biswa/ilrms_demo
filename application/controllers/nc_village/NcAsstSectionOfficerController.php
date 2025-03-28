<?php
class NcAsstSectionOfficerController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
        if ($this->session->userdata('designation') != DPT_ASO && $this->session->userdata('designation') != 'NIC') {
            $data['heading'] = "ERROR:: 404 Page Not Found";
            $data['message'] = 'The page you requested was not found';
            $this->load->view('errors/html/error_404', $data);
            $this->CI =& get_instance();
            $this->CI->output->_display();
            die();
        }
    }

    /** Dashboard Page */
    public function dashboard()
    {
        $dist_list = (array) json_decode(NC_DISTIRTCS);

        $url = API_LINK_NC_VILLAGE . "getDeptPendingProposalCount";
        $method = 'POST';
        $data['d'] = $dist_list;
        $data['type'] = 'aso_dashboard';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL NcAsstSectionOfficerController #ASO00539');
            echo "API FAIL";
            return;
        }

        $data['count'] = json_decode($output);
        $this->db = $this->load->database('db2', TRUE);
        $data['forwarded'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = 'Y' and reverted is null and status ='A'")->row()->count;
        $data['reverted'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = 'Y' and reverted='Y'  and section_officer_verified is null and status ='A'")->row()->count;
        $data['_view'] = 'nc_village/asst_section_officer/dashboard';
        $this->load->view('layouts/main', $data);
    }

    /** Get PS Pending and Verified Proposal */
    public function viewProposal($type)
    {
        $dist_list = (array) json_decode(NC_DISTIRTCS);

        $url = API_LINK_NC_VILLAGE . "getDeptProposal";
        $method = 'POST';
        $data['d'] = $dist_list;
        $data['user'] = 'asst_section_officer';
        $data['type'] = $type;
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL NcAsstSectionOfficerController #ASO005339');
            echo "API FAIL";
            return;
        }

        $data['proposal'] = json_decode($output);
        $data['_view'] = 'nc_village/asst_section_officer/proposal_list';
        $this->load->view('layouts/main', $data);
    }

    /** proposal Forward */
    public function proposalForward()
    {
        $url = API_LINK_NC_VILLAGE . "deptForwardProposal";
        $method = 'POST';
        $data['proposal_id'] = $this->input->post('proposal_id');;
        $data['note'] = $this->input->post('note');;
        $data['dist_code'] = $this->input->post('dist_code');;
        $data['user_code'] = $this->session->userdata('user_code');;
        $data['user'] = 'section_officer';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL_API FAIL NcAsstSectionOfficerController #ASO000001');
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
            log_message("error", 'FORWARDED FAIL NcAsstSectionOfficerController #ASO000002');
            echo json_encode(array(
                'status' => '0',
            ));
        }
        return;
    }

    /** generateNotification */
    public function generateNotification(){
        $url = API_LINK_NC_VILLAGE . "generateNcVillNotification";
        $method = 'POST';
//        $data['proposal_id'] = $this->input->post('proposal_id');;
//        $data['note'] = $this->input->post('note');;
//        $data['dist_code'] = $this->input->post('dist_code');;
//        $data['user_code'] = $this->session->userdata('user_code');;
//        $data['user'] = 'section_officer';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data=array());
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL_API FAIL NcAsstSectionOfficerController #ASO000001');
            echo "API FAIL";
            return;
        }
        echo json_encode(array(
            'data' => $output,
            'status' => '1',
        ));
    }

    /** notification Forward */
    public function notificationForward()
    {
        $type = $this->input->post('type');
        $data['proposal_id'] = $proposal_id = $this->input->post('proposal_id');
        $data['proposal_no'] = $proposal_no = $this->input->post('proposal_no');
        $data['note'] = $note = $this->input->post('note');
        $notification = $this->input->post('notification');
        $data['dist_code'] = $dist_code = $this->input->post('dist_code');
        $data['user_code']  = $user_code = $this->session->userdata('user_code');
        if($type == 'reforward')
        {
            $this->db = $this->load->database('db2', TRUE);
            $notification_id = $this->input->post('notification_id');
            $this->db->set([
                'status' =>'A',
                'asst_section_officer_note' => $note,
                'asst_section_officer_notification' => $notification,
                'asst_section_officer_verified' => "Y",
                'asst_section_officer_verified_at' => date('Y-m-d H:i:s'),
                "asst_section_officer_user_code" => $user_code,
                'reverted' => null,
            ]);

            $this->db->where('id', $notification_id);
            $this->db->where('dist_code', $dist_code);
            $this->db->update('nc_village_gen_notification');
            if ($this->db->affected_rows() == 1) {
                $url = API_LINK_NC_VILLAGE . "insertProceedingPost";
                $method = 'POST';
                $data['from'] = 'Assistant Section Officer';
                $data['to'] = 'Section Officer';
                $data['task'] = 'Notification forwarded to  Section Officer';
                $output1 = $this->NcVillageModel->callApiV2($url, $method, $data);
                if (!$output1) {
                    log_message("error", 'Notification_Forward FAIL NcAsstSectionOfficerController #ASO000008');
                }
                echo json_encode('Y');
                return;
            }else{
                log_message("error", 'Notification Update FAIL NcAsstSectionOfficerController #ASO000068');
                echo json_encode('N');
                return;
            }
        }

        $url = API_LINK_NC_VILLAGE . "deptForwardProposal";
        $method = 'POST';

        $data['user'] = $user = 'asst_section_officer';

        $this->db = $this->load->database('db2', TRUE);
        $user_code = $this->session->userdata('user_code');

        $notification_no = 'NO_'.time().'_NC';
        $this->db->trans_begin();
        $insert = $this->db->insert('nc_village_gen_notification', array(
            'notification_no' => $notification_no,
            'proposal_id' => $proposal_id,
            'proposal_no' => $proposal_no,
            'asst_section_officer_user_code' => $user_code,
            'asst_section_officer_note' => $note,
            'asst_section_officer_notification' => $notification,
            'asst_section_officer_verified' => 'Y',
            'asst_section_officer_verified_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'status' => 'A',
            'dist_code' => $dist_code,
        ));
        if ($insert == true) {
            $output = $this->NcVillageModel->callApiV2($url, $method, $data);
            if (!$output) {
                $this->db->trans_rollback();
                log_message("error", 'DEPT_PROPOSAL_API FAIL NcAsstSectionOfficerController #ASO000061');
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

    /** view Generated Notification */
    public function viewNotification($type)
    {
        $user = 'asst_section_officer';
        $data['type'] = $type;
        $data['notification'] = $this->NcVillageModel->getGeneratedNotification($type, $user);

        $data['_view'] = 'nc_village/asst_section_officer/notification_list';
        $this->load->view('layouts/main', $data);
    }

    /** view Verified notification file */
    public function viewVerifiedNotification()
    {
        $notification_id = $this->input->post('notification_id');
        $dist_code = $this->input->post('dist_code');

        $user = 'asst_section_officer';
        $output = $this->NcVillageModel->getNotification($notification_id, $dist_code, $user);

        if ($output != null) {
            echo json_encode(array(
                'data' => $output,
                'status' => '1',
            ));
        } else {
            echo json_encode(array(
                'data' => $output,
                'status' => '0',
            ));
        }
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
        $data['user'] = 'asst_section_officer';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'PROPOSAL_Revert FAIL NcAsstSectionOfficerController #ASO000006');
            echo json_encode('N');
            return;
        }
        $output = json_decode($output);

        echo json_encode($output);
        return;
    }

    /** view Reverted notification file */
    public function viewRevertedNotification()
    {
        $notification_id = $this->input->post('notification_id');
        $dist_code = $this->input->post('dist_code');

        $user = 'asst_section_officer_reverted';
        $output = $this->NcVillageModel->getNotification($notification_id, $dist_code, $user);

        if ($output != null) {
            echo json_encode(array(
                'data' => $output,
                'status' => '1',
            ));
        } else {
            echo json_encode(array(
                'data' => $output,
                'status' => '0',
            ));
        }
    }

    /** proposal and notification revert back */
    public function proposalNotificationRevert()
    {
        $url = API_LINK_NC_VILLAGE . "revertBackProposal";
        $method = 'POST';
        $data['notification_id'] = $notification_id = $this->input->post('notification_id');
        $data['proposal_id'] = $this->input->post('proposal_id');
        $data['proposal_no'] = $this->input->post('proposal_no');
        $data['note'] = $this->input->post('note');
        $data['dist_code'] = $dist_code = $this->input->post('dist_code');
        $data['user_code'] = $user_code = $this->session->userdata('user_code');
        $data['user'] = 'asst_section_officer';

        $this->db = $this->load->database('db2', TRUE);
        $this->db->trans_begin();
        $this->db->set([
            'status' =>'R',
            'asst_section_officer_verified' => "Y",
            'asst_section_officer_verified_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            "asst_section_officer_user_code" => $user_code,
        ]);
        $this->db->where('id', $notification_id);
        $this->db->where('dist_code', $dist_code);
        $this->db->where('status', 'A');
        $this->db->update('nc_village_gen_notification');
        if ($this->db->affected_rows() == 1) {
            $output = $this->NcVillageModel->callApiV2($url, $method, $data);
            if (!$output) {
                $this->db->trans_rollback();
                log_message("error", 'Notification update FAIL NcAsstSectionOfficerController #ASO00000664');
                echo json_encode('N');
                return;
            }
            $this->db->trans_commit();
            echo json_encode('Y');
            return;
        }else{
            $this->db->trans_rollback();
            log_message("error", 'Notification update FAIL NcAsstSectionOfficerController #ASO0000665'.$this->db->affected_rows());
            echo json_encode('N');
            return;
        }
    }

}