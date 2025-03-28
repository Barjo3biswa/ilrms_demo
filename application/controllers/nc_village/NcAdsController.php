<?php
class NcAdsController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
        if ($this->session->userdata('designation') != ADS) {
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

        $data['_view'] = 'nc_village/ads/pending_nc_villages';
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
        $data['user'] = 'ADS';

        $url = API_LINK_NC_VILLAGE."apiGetNcVillaqes" ;

        $method = 'POST';
        $output = $this->NcVillageModel->callApi($url,$method,$data);
        echo json_encode($output->data);
        return;
    }

    /** get pending village details */
    public function getPendingVillage()
    {
        $data['d'] = $_GET['d'];
        $data['application_no'] = $_GET['application_no'];
        $data['pending'] = 'I';
        $data['verified'] = 'C';
        $url = API_LINK_NC_VILLAGE."apiGetPendingVillage";

        $method = 'POST';
        $output = $this->NcVillageModel->callApi($url,$method,$data);
        if ($output->data==null)
        {
            log_message("error", 'ADS_PENDING_VILL #ADS0001');
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

        $data['_view'] = 'nc_village/ads/nc_village_dags';
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
            log_message("error", 'ADS_GET_DAG #ADS0002');
            echo json_encode(array('success' => 'N'));
            return;
        }

        echo json_encode(array('success' => 'Y', 'dags' => $output->data->dags, 'dc_name' => $output->data->dc));
        return;
    }

	/** Dashboard */
    public function dashboard()
    {
        $this->db = $this->load->database('db2', TRUE);
        $url = API_LINK_NC_VILLAGE . "getProposalCount";
        $output = $this->NcVillageModel->callApiV2(API_LINK_NC_VILLAGE . "getNameChangeMapCountAds", 'POST', []);

        if (!$output) {
            log_message("error", 'ADS_NAME_CHANGE_MAP #JDS0001');
            echo "API FAIL";
            return;
        }
        $data['name_change_count'] = json_decode($output);
        $data['approved_notification'] = $this->db->query("select count(*) as count from nc_village_gen_notification where
 				asst_section_officer_verified = ? and 
 				section_officer_verified = ? and 
 				joint_secretary_verified=? and 
 				secretary_verified =? and ps_verified=?
 				and minister_verified=?
 				and ps_sign =? and status=?",array('Y','Y','Y','Y','Y','Y','Y','F'))->row()->count;

        $data['_view'] = 'nc_village/ads/dashboard';
        $this->load->view('layouts/main', $data);
    }
    /** View Villages  Forwarded by DC For namew change on map */
    public function viewPendingNameChangeOnMap()
    {
        $url = API_LINK_NC_VILLAGE . "getNameChangeMapVillagesAds";
        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, []);

        if (!$output) {
            log_message("error", 'ADS_NAME_CHANGE_MAP #JDS000100');
            echo "API FAIL";
            return;
        }
        $output = json_decode($output);
        $data['data'] = $output;
        $data['_view'] = 'nc_village/ads/name_change_map_villages';
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
}