<?php
class NcJdsController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
        if ($this->session->userdata('designation') != JDS) {
            $data['heading'] = "ERROR:: 404 Page Not Found";
            $data['message'] = 'The page you requested was not found';
            $this->load->view('errors/html/error_404', $data);
            $this->CI =& get_instance();
            $this->CI->output->_display();
            die;
        }
    }

    /** View pending NC Villages Page */
    public function viewPendingCasesPage()
    {
        $data = [];
        $this->db = $this->load->database('auth', TRUE);

        $data['dist_list'] = (array) json_decode(NC_DISTIRTCS);

        $data['_view'] = 'nc_village/jds/pending_nc_villages';
        $this->load->view('layouts/main', $data);
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
        $data['user'] = 'JDS';

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
        $data['pending'] = 'I';
        $data['verified'] = 'C';
        $url = API_LINK_NC_VILLAGE."apiGetPendingVillage";

        $method = 'POST';
        $output = $this->NcVillageModel->callApi($url,$method,$data);
        if ($output->data==null)
        {
            log_message("error", 'JDS_PENDING_VILL #JDS0001');
            echo json_encode($output->data);
            return;
        }

        $data['locations'] = $output->data->locations;
        $data['nc_village'] = $nc_village = $output->data->nc_village;
        $data['pdf'] = $output->data->pdf_base64;

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

        $data['_view'] = 'nc_village/jds/nc_village_dags';
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
            log_message("error", 'JDS_GET_DAG #JDS0002');
            echo json_encode(array('success' => 'N'));
            return;
        }

        echo json_encode(array('success' => 'Y', 'dags' => $output->data->dags, 'dc_name' => $output->data->dc));
        return;
    }

    /** Dashboard */
    public function dashboard()
    {
        $dist_list = (array) json_decode(NC_DISTIRTCS);

        $this->db = $this->load->database('db2', TRUE);
        $url = API_LINK_NC_VILLAGE . "getProposalCount";
        $method = 'POST';
        $data['user'] = 'jds';
        $data['d'] = $dist_list;
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
		$output2 = $this->NcVillageModel->callApiV2(API_LINK_NC_VILLAGE . "getNameChangeMapCount", $method, []);

        if (!$output || !$output2) {
            log_message("error", 'JDS_PROPOSAL #JDS0001');
            echo "API FAIL";
            return;
        }
        $data['count'] = json_decode($output);
        $data['name_change_count'] = json_decode($output2);
        $data['approved_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = ? and 
 				section_officer_verified = ? and 
 				joint_secretary_verified=? and 
 				secretary_verified =? and ps_verified=?
 				and minister_verified=?
 				and ps_sign =? and status=?",array('Y','Y','Y','Y','Y','Y','Y','F'))->row()->count;

        $data['_view'] = 'nc_village/jds/dashboard';
        $this->load->view('layouts/main', $data);
    }

    /** View Proposal Forwarded by ADLR */
    public function viewPendingProposal()
    {
        $this->db = $this->load->database('db2', TRUE);
        $url = API_LINK_NC_VILLAGE . "getProposal";
        $method = 'POST';
        $data['user'] = 'jds';
        $data['type'] = 'forwardedbyadlr';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if (!$output) {
            log_message("error", 'JDS_PROPOSAL #JDS0002');
            echo "API FAIL";
            return;
        }
        $output = json_decode($output);
        $data['pending_proposal'] = $output->pending_proposal;
        $data['revert_proposal'] = $output->revert_proposal;

        $data['_view'] = 'nc_village/jds/forward_proposal';
        $this->load->view('layouts/main', $data);
    }

    /** Revert Bck to adlr  */
    public function proposalRevertBack()
    {
        $url = API_LINK_NC_VILLAGE . "revertBackProposal";
        $method = 'POST';
        $data['proposal_no'] = $this->input->post('proposal_no');
        $data['proposal_id'] = $this->input->post('proposal_id');
        $data['note'] = $this->input->post('note');
        $data['dist_code'] = $this->input->post('dist_code');
        $data['user_code'] = $this->session->userdata('user_code');
        $data['user'] = 'jds';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'JDS_PROPOSAL_API FAIL NcJdsController #JDS000003');
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
            log_message("error", 'FORWARDED FAIL NcJdsController #JDS000004');
            echo json_encode(array(
                'status' => '0',
            ));
        }
        return;
    }

	/** View Villages  Forwarded by DC For namew change on map */
    public function viewPendingNameChangeOnMap()
    {
        $url = API_LINK_NC_VILLAGE . "getNameChangeMapVillages";
        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, []);
        if (!$output) {
            log_message("error", 'JDS_NAME_CHANGE_MAP #JDS000100');
            echo "API FAIL";
            return;
        }
        $output = json_decode($output);
        $data['data'] = $output;
        $data['_view'] = 'nc_village/jds/name_change_map_villages';
        $this->load->view('layouts/main', $data);
    }

    public function forwardToAdsNameChange(){
        $url = API_LINK_NC_VILLAGE . "forwardNameChangeMap";
        $method = 'POST';
        $data['application_no'] = $this->input->post('application_no');
        $data['note'] = $this->input->post('note');
        $data['user'] = 'JDS';
        $data['dist_code'] = $this->input->post('dist_code');
        $data['user_code'] = $this->session->userdata('user_code');
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'JDS_NAMECHANGE_API FAIL NcJdsController #JDS00000100');
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
            log_message("error", 'FORWARDED FAIL NcJdsController #JDS00000100');
            echo json_encode(array(
                'status' => '0',
            ));
        }
        return;
    }

     /** View Villages  Forwarded by DC For namew change on map */
     public function viewPendingNameChangeOnMapE()
     {
         $url = API_LINK_NC_VILLAGE . "getNameChangeMapVillagesE";
         $method = 'POST';
         $output = $this->NcVillageModel->callApiV2($url, $method, []);
 
         if (!$output) {
             log_message("error", 'JDS_NAME_CHANGE_MAPs #JDS000101');
             echo "API FAIL";
             return;
         }
         $output = json_decode($output);
         $data['data'] = $output;
         $data['_view'] = 'nc_village/jds/name_change_map_villages_e';
         $this->load->view('layouts/main', $data);
     }

    /** view Approved Notification */
    public function viewApprovedNotification()
    {
        $user = 'jds';
        $data['type']= $type = 'verified';
        $data['notification'] = $this->NcVillageModel->getApprovedNotification($type, $user);
        $data['_view'] = 'nc_village/jds/approved_notification_list';
        $this->load->view('layouts/main', $data);
    }

    /** NC Vill Forwarded to DC after map upload */
    public function forwardToDcNameChange()
    {
        $url = API_LINK_NC_VILLAGE . "forwardNameChangeMap";
        $method = 'POST';
        $data['application_no'] = $this->input->post('application_no');
        $data['note'] = $this->input->post('note');
        $data['user'] = 'JDSTODC';
        $data['dist_code'] = $this->input->post('dist_code');
        $data['user_code'] = $this->session->userdata('user_code');
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'JDS_NAMECHANGE_API FAIL NcJdsController #JDS00000103');
            echo json_encode(array(
                'status' => '0',
            ));
        }
        $output = json_decode($output);

        if($output == "Y")
        {
            echo json_encode(array(
                'status' => '1',
            ));
        }else{
            log_message("error", 'FORWARDED FAIL NcJdsController #JDS00000104');
            echo json_encode(array(
                'status' => '0',
            ));
        }
        return;
    }

}