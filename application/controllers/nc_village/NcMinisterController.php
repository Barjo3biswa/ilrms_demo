<?php
class NcMinisterController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
        if ($this->session->userdata('designation') != MINISTER && $this->session->userdata('designation') != 'NIC') {
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
        $this->db = $this->load->database('db2', TRUE);
        $data['pending_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				ps_verified = ? and  status =? and reverted is null and 
 				minister_verified is null ",array('Y','A'))->row()->count;

        $data['forwarded_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				ps_verified = ? and reverted is null and 
 				minister_verified = ?
 				and status =?",array('Y','Y','A'))->row()->count;
        $data['_view'] = 'nc_village/minister/dashboard';
        $this->load->view('layouts/main', $data);
    }

    /** Get View Pending and Verified Notification */
    public function viewNotification($type)
    {
        $user = 'minister';
        $data['type'] = $type;
        $data['notification'] = $this->NcVillageModel->getGeneratedNotification($type, $user);
        $data['_view'] = 'nc_village/minister/notification_list';
        $this->load->view('layouts/main', $data);
    }

    /** Get Forward Notification */
    public function notificationForward()
    {
        $data['note'] = $note = $this->input->post('note');
        $data['proposal_no'] = $this->input->post('proposal_no');
        $notification_id = $this->input->post('notification_id');
        $data['dist_code'] = $dist_code= $this->input->post('dist_code');
        $data['user_code'] = $user_code = $this->session->userdata('user_code');
        $user = 'minister';
        $notification = null;
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
                log_message("error", 'Notification_Forward FAIL NcMinisterController #MIN000008');
            }
            echo json_encode(array(
                'status' => '1',
            ));
        }else{
            log_message("error", 'FORWARDED FAIL NcMinisterController #MIN000004');
            echo json_encode(array(
                'status' => '0',
            ));
        }
        return;
    }

    /** view my Verified notification file */
    public function viewVerifiedNotification()
    {
        $notification_id= $this->input->post('notification_id');
        $dist_code= $this->input->post('dist_code');

        $user = 'minister';
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

    /** notification  revert to ps*/
    public function notificationRevert()
    {
        $data['note'] = $note = $this->input->post('note');
        $data['proposal_no'] = $proposal_no = $this->input->post('proposal_no');
        $notification_id = $this->input->post('notification_id');
        $data['dist_code'] = $dist_code= $this->input->post('dist_code');
        $data['user_code'] = $user_code = $this->session->userdata('user_code');
        $user = 'minister';
        $notification = null;
        $output = $this->NcVillageModel->revertNcNotification($proposal_no,$notification_id,$notification,$note,$dist_code,$user);
        if($output == "Y")
        {
            $url = API_LINK_NC_VILLAGE . "insertProceedingPost";
            $method = 'POST';
            $data['from'] = 'Honourable Minister,R&DM Department';
            $data['to'] = 'Senior Most Secretary';
            $data['task'] = 'Notification reverted to Senior Most Secretary';
            $output1 = $this->NcVillageModel->callApiV2($url, $method, $data);
            if (!$output1) {
                log_message("error", 'Notification revert FAIL NcMinisterController #MIN0000010');
            }
            echo json_encode(array(
                'status' => '1',
            ));
        }else{
            log_message("error", 'revert FAIL NcMinisterController #MIN0000011');
            echo json_encode(array(
                'status' => '0',
            ));
        }
        return;
    }
}