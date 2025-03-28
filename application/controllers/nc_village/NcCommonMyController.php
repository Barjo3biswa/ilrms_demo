<?php
class NcCommonMyController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
    }

    /** get Villages Proposal Wise */
    public function getVillagesProposalWise()
    {
        $url = API_LINK_NC_VILLAGE . "getVillagesProposalWise";
        $method = 'POST';

        $data['d'] = $_GET['dist_code'];
        $data['proposal_id'] = $_GET['proposal_id'];
        $data['proposal_no'] = $_GET['proposal_no'];

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if (!$output) {
            log_message("error", 'NcCommonMYController #COM0001');
            echo "API FAIL";
            return;
        }
        $output = json_decode($output);
        $data['locations'] = $output->locations;
        $data['nc_village'] = $output->nc_village;

        $data['_view'] = 'nc_village/common/villages';
        $this->load->view('layouts/main', $data);
    }

    /** Proposal pending NC Villages  */
    public function getProposalPendingVillages()
    {
        $data['d'] = $this->input->post('dist_code');
        $data['proposal_id'] = $this->input->post('proposal_id');
        $data['proposal_no'] =$this->input->post('proposal_no');
        $url = API_LINK_NC_VILLAGE . "getVillagesProposalWise";

        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if (!$output) {
            log_message("error", 'NcCommonMYController #COM0004');
            echo "API FAIL";
            return;
        }
        $output = json_decode($output);
        $data['nc_village'] = $output->nc_village;

        echo json_encode($data['nc_village']);
    }

    /** get village details */
    public function getVillageDetails()
    {
        $this->db = $this->load->database('db2', TRUE);
        $data['d'] = $_GET['d'];
        $data['application_no'] = $_GET['application_no'];
        $url = API_LINK_NC_VILLAGE . "getVillageDetails";

        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if(!$output) {
            log_message("error", 'NcCommonMyController #COM0002');
            echo "Data Not Found.";
            return;
        }
        $output = json_decode($output);

        $data['locations'] = $output->locations;
        $data['nc_village'] = $nc_village = $output->nc_village;
        $data['pdf'] = $output->pdf_base64;

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

        $data['_view'] = 'nc_village/common/nc_village_details';
        $this->load->view('layouts/main', $data);
    }

    /** get village data */
    public function getVillageDataDetails()
    {
        $this->db = $this->load->database('db2', TRUE);
        $data['d'] = $this->input->post('dist_code');
        $data['application_no'] = $this->input->post('application_no');
        $url = API_LINK_NC_VILLAGE . "getVillageDetails";

        $method = 'POST';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if(!$output) {
            log_message("error", 'NcCommonMyController #COM00023');
            echo "Data Not Found.";
            return;
        }
        $output = json_decode($output);

        $data['nc_village'] = $nc_village = $output->nc_village;
        echo json_encode($nc_village);
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
            log_message("error", 'NcCommonMyController #COM0003');
            echo json_encode(array('success' => 'N'));
            return;
        }

        echo json_encode(array('success' => 'Y', 'dags' => $output->data->dags, 'dc_name' => $output->data->dc, 'change_vill' => $output->data->change_vill));
        return;
    }

    /** Bhunaksa Map */
    public function viewBhunaksaMap()
    {
        $data['location'] = $_POST['location'];
        $data['application_no'] = $_POST['application_no'];
        $data['dist_code'] = $_POST['dist_code'];
        $data['data'] = $_POST;
        $area= $_POST['area'];
        $data['area'] = 0;
        if($area != 0)
        {
            $data['area'] = round($area/1000000,5);
        }

        $data['_view'] = 'nc_village/common/bhunaksa_map';
        $this->load->view('layouts/main', $data);
    }

    public function viewBhunaksaMapPost()
    {
        $url = LANDHUB_APP."index.php/BhunakshaApiController/getVillageGeoJson";
        $method = 'POST';
        $data['location'] = $_POST['location'];

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        echo ($output);
        return;
    }

    /** Get Bhunaksa Dags */
    public function getBhunaksaMapDags()
    {
        $url = LANDHUB_APP."index.php/BhunakshaApiController/getVillageDagDetails";
        $method = 'POST';
        $data['location'] = $_POST['location'];

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        echo $output;
        return;
    }

    /** get Chitha Dags details */
    public function getChithaDags()
    {
        $data['d'] = $_POST['dist_code'];
        $data['application_no'] = $_POST['application_no'];

        $url = API_LINK_NC_VILLAGE . "apiGetChithaDags";
        $method = 'POST';

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        echo $output;
        return;
    }
}