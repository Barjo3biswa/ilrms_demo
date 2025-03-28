<?php
class NcJointSecretaryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
        if ($this->session->userdata('designation') != DPT_JSEC && $this->session->userdata('designation') != 'NIC') {
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
        $data['type'] = 'joint_sec_dashboard';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL NcJointSecretaryController #JSEC00539');
            echo "API FAIL";
            return;
        }

        $data['count'] = json_decode($output);
        $this->db = $this->load->database('db2', TRUE);
        $data['pending_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = 'Y' and section_officer_verified='Y' and reverted is null and status != 'R'
 				 and joint_secretary_verified is null")->row()->count;

        $data['forwarded_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = 'Y' and section_officer_verified = 'Y' and reverted is null and status != 'R'
 				 and joint_secretary_verified='Y'")->row()->count;
        $data['reverted_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = 'Y' and section_officer_verified = 'Y' and reverted='Y' and status != 'R'
 				 and joint_secretary_verified='Y' and secretary_verified is null")->row()->count;
        $data['_view'] = 'nc_village/joint_secretary/dashboard';
        $this->load->view('layouts/main', $data);
    }

    /** Get PS Pending and Verified Proposal */
    public function viewProposal($type)
    {
        $dist_list = (array) json_decode(NC_DISTIRTCS);

        $url = API_LINK_NC_VILLAGE . "getDeptProposal";
        $method = 'POST';
        $data['d'] = $dist_list;
        $data['user'] = 'joint_secretary';
        $data['type'] = $type;
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL NcJointSecretaryController #JSEC005339');
            echo "API FAIL";
            return;
        }

        $data['proposal'] = json_decode($output);
        $data['_view'] = 'nc_village/joint_secretary/proposal_list';
        $this->load->view('layouts/main', $data);
    }

    /** proposal Forward */
    public function proposalForward()
    {
        $url = API_LINK_NC_VILLAGE . "deptForwardProposal";
        $method = 'POST';
        $data['proposal_no'] = $this->input->post('proposal_no');;
        $data['proposal_id'] = $this->input->post('proposal_id');;
        $data['note'] = $this->input->post('note');;
        $data['dist_code'] = $this->input->post('dist_code');;
        $data['user_code'] = $this->session->userdata('user_code');;
        $data['user'] = 'joint_secretary';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL_API FAIL NcJointSecretaryController #JSEC000001');
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
            log_message("error", 'FORWARDED FAIL NcJointSecretaryController #JSEC000002');
            echo json_encode(array(
                'status' => '0',
            ));
        }
        return;
    }
    /** Get View Pending and Verified Notification */
    public function viewNotification($type)
    {
        $user = 'joint_secretary';
        $data['type'] = $type;
        $data['notification'] = $this->NcVillageModel->getGeneratedNotification($type, $user);
        $data['_view'] = 'nc_village/joint_secretary/notification_list';
        $this->load->view('layouts/main', $data);
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
        $user = 'joint_secretary';
        $output = $this->NcVillageModel->forwardedNcNotification($notification_id,$notification,$note,$dist_code,$user);
        if($output == "Y")
        {
            $url = API_LINK_NC_VILLAGE . "insertProceedingPost";
            $method = 'POST';
            $data['from'] = 'Joint Secretary';
            $data['to'] = 'Secretary';
            $data['task'] = 'Notification forwarded to Secretary';
            $output1 = $this->NcVillageModel->callApiV2($url, $method, $data);
            if (!$output1) {
                log_message("error", 'Notification_Forward FAIL NcJointSectionOfficerController #JSEC000008');
            }
            echo json_encode($output);
        }else{
            log_message("error", 'FORWARDED FAIL NcJointSectionOfficerController #JSEC000004');
            echo json_encode($output);
        }
        return;
    }

    /** view notification file */
    public function viewSectionOfficerNotification()
    {
        $this->db = $this->load->database('db2', TRUE);
        $notification_id= $this->input->post('notification_id');
        $dist_code= $this->input->post('dist_code');

        $this->db->select('section_officer_notification');
        $this->db->from('nc_village_gen_notification');
        $this->db->where('id', $notification_id);
        $this->db->where('dist_code', $dist_code);
        $query = $this->db->get();
        $section_officer_notification = null;
        if ( $query->num_rows() > 0 )
        {
            $section_officer_notification = $query->row()->section_officer_notification;
        }

        echo json_encode(array(
            'data' => $section_officer_notification,
            'status' => '1',
        ));
    }

    /** view Verified notification file */
    public function viewVerifiedNotification()
    {
        $notification_id= $this->input->post('notification_id');
        $dist_code= $this->input->post('dist_code');

        $user = 'joint_secretary';
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
        $data['user'] = 'joint_sec';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'PROPOSAL_Revert FAIL NcJointSecretaryController #JSEC000006');
            echo json_encode('N');
            return;
        }
        $output = json_decode($output);

        echo json_encode($output);
        return;
    }

    /** revert Notification */
    public function notificationRevert()
    {
        $data['note'] = $note = $this->input->post('note');
        $data['proposal_no'] =$proposal_no= $this->input->post('proposal_no');
        $notification = $this->input->post('notification');
        $notification_id = $this->input->post('notification_id');
        $data['dist_code'] = $dist_code= $this->input->post('dist_code');
        $data['user_code'] = $user_code = $this->session->userdata('user_code');
        $user = 'joint_secretary';
        $output = $this->NcVillageModel->revertNcNotification($proposal_no,$notification_id,$notification,$note,$dist_code,$user);
        if($output == "Y")
        {
            $url = API_LINK_NC_VILLAGE . "insertProceedingPost";
            $method = 'POST';
            $data['from'] = 'Joint Secretary';
            $data['to'] = 'Section Officer';
            $data['task'] = 'Notification reverted to Section Officer';
            $output1 = $this->NcVillageModel->callApiV2($url, $method, $data);
            if (!$output1) {
                log_message("error", 'Notification_revert FAIL NcJointSecretaryController #JSEC000008');
            }
            echo json_encode($output);
        }else{
            log_message("error", 'Revert FAIL NcSectionOfficerController #JSEC000004');
            echo json_encode($output);
        }
        return;
    }
}