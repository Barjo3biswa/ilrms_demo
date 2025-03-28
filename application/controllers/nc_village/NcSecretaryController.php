<?php
class NcSecretaryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
        if ($this->session->userdata('designation') != DPT_SEC && $this->session->userdata('designation') != 'NIC') {
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
        $data['type'] = 'sec_dashboard';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL NcSecretaryController #SEC00539');
            echo "API FAIL";
            return;
        }

        $data['count'] = json_decode($output);
        $this->db = $this->load->database('db2', TRUE);
        $data['pending_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = 'Y' and 
 				section_officer_verified='Y' and joint_secretary_verified='Y'  and reverted is null and status != 'R'
 				and secretary_verified is null")->row()->count;

        $data['forwarded_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = 'Y' and 
 				section_officer_verified = 'Y' and joint_secretary_verified='Y' and reverted is null and status != 'R'
 				 and secretary_verified ='Y'")->row()->count;

        $data['_view'] = 'nc_village/secretary/dashboard';
        $this->load->view('layouts/main', $data);
    }

    /** Get PS Pending and Verified Proposal */
    public function viewProposal($type)
    {
        $dist_list = (array) json_decode(NC_DISTIRTCS);

        $url = API_LINK_NC_VILLAGE . "getDeptProposal";
        $method = 'POST';
        $data['d'] = $dist_list;
        $data['user'] = 'secretary';
        $data['type'] = $type;
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL NcSecretaryController #SEC005339');
            echo "API FAIL";
            return;
        }

        $data['proposal'] = json_decode($output);
        $data['_view'] = 'nc_village/secretary/proposal_list';
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
        $data['user'] = 'secretary';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'DEPT_PROPOSAL_API FAIL NcSecretaryController #SEC000001');
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
            log_message("error", 'FORWARDED FAIL NcSecretaryController #SEC000002');
            echo json_encode(array(
                'status' => '0',
            ));
        }
        return;
    }
    /** Get View Pending and Verified Notification */
    public function viewNotification($type)
    {
        $user = 'secretary';
        $data['type'] = $type;
        $data['notification'] = $this->NcVillageModel->getGeneratedNotification($type, $user);
        $data['_view'] = 'nc_village/secretary/notification_list';
        $this->load->view('layouts/main', $data);
    }

    /** view JointSec notification file */
    public function viewJointSecNotification()
    {
        $this->db = $this->load->database('db2', TRUE);
        $notification_id= $this->input->post('notification_id');
        $dist_code= $this->input->post('dist_code');

        $this->db->select('joint_secretary_notification');
        $this->db->from('nc_village_gen_notification');
        $this->db->where('id', $notification_id);
        $this->db->where('dist_code', $dist_code);
        $query = $this->db->get();
        $joint_secretary_notification = null;
        if ( $query->num_rows() > 0 )
        {
            $joint_secretary_notification = $query->row()->joint_secretary_notification;
        }

        echo json_encode(array(
            'data' => $joint_secretary_notification,
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
        $user = 'secretary';
        $output = $this->NcVillageModel->forwardedNcNotification($notification_id,$notification,$note,$dist_code,$user);
        if($output == "Y")
        {
            $url = API_LINK_NC_VILLAGE . "insertProceedingPost";
            $method = 'POST';
            $data['from'] = 'Secretary';
            $data['to'] = 'Senior Most Secretary';
            $data['task'] = 'Notification forwarded to Senior Most Secretary';
            $output1 = $this->NcVillageModel->callApiV2($url, $method, $data);
            if (!$output1) {
                log_message("error", 'Notification_Forward FAIL NcSecretaryController #SEC000008');
            }
            echo json_encode($output);
        }else{
            log_message("error", 'FORWARDED FAIL NcSecretaryController #SEC000004');
            echo json_encode($output);
        }
        return;
    }

    /** view my Verified notification file */
    public function viewVerifiedNotification()
    {
        $notification_id= $this->input->post('notification_id');
        $dist_code= $this->input->post('dist_code');

        $user = 'secretary';
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
        $data['user'] = 'sec';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'PROPOSAL_Revert FAIL NcSecretaryController #SEC000006');
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
        $user = 'secretary';
        $output = $this->NcVillageModel->revertNcNotification($proposal_no,$notification_id,$notification,$note,$dist_code,$user);
        if($output == "Y")
        {
            $url = API_LINK_NC_VILLAGE . "insertProceedingPost";
            $method = 'POST';
            $data['from'] = 'Secretary';
            $data['to'] = 'Joint Secretary';
            $data['task'] = 'Notification reverted to Joint Secretary';
            $output1 = $this->NcVillageModel->callApiV2($url, $method, $data);
            if (!$output1) {
                log_message("error", 'Notification_reverted FAIL NcSecretaryController #SEC000008');
            }
            echo json_encode($output);
        }else{
            log_message("error", 'Reverted FAIL NcSecretaryController #SEC000004');
            echo json_encode($output);
        }
        return;
    }
}