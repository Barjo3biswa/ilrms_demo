<?php
class LocationController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
        if ($this->session->userdata('designation') != JDS) {
            $data['heading'] = "ERROR:: 404 Page Not Found";
            $data['message'] = 'The page you requested was not found';
            $this->load->view('errors/html/error_404', $data);
            $this->CI =& get_instance();
            $this->CI->output->_display();
            die();
        }
    }
    public function addVillageForm(){
        $data['districts'] = $this->db->query("select dist_code,loc_name from location where dist_code!='00' and subdiv_code='00'")->result();

        $data['_view'] = 'location/add_village_form';
        $this->load->view('layouts/main', $data);
    }
    public function getLots()
    {
        $url = LANDHUB_APP."index.php/NicApi/getLots";
        $method = 'POST';
        $data['dist_code'] = $this->input->post('dist_code');
        $data['subdiv_code'] = $this->input->post('subdiv_code');
        $data['cir_code'] = $this->input->post('cir_code');
        $data['mouza_pargona_code'] = $this->input->post('mouza_pargona_code');
        $data['apikey'] = LANDHUB_APIKEY;


        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        echo ($output);
        return;
    }
public function getVillages()
    {
        $url = LANDHUB_APP."index.php/NicApi/getVillages_svamitva";
        $method = 'POST';
        $data['dist_code'] = $this->input->post('dist_code');
        $data['subdiv_code'] = $this->input->post('subdiv_code');
        $data['cir_code'] = $this->input->post('cir_code');
        $data['mouza_pargona_code'] = $this->input->post('mouza_pargona_code');
        $data['lot_no'] = $this->input->post('lot_no');
        $data['apikey'] = LANDHUB_APIKEY;

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        echo ($output);
        return;
    }
public function saveVillage()
    {
        $data_array = array(
            array(
                'field' => 'dist_code',
                'label' => 'District',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'subdiv_code',
                'label' => 'Sub-Division',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'cir_code',
                'label' => 'Circle',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'mouza_pargona_code',
                'label' => 'Mouza',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'lot_no',
                'label' => 'Lot No',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'village_name_assamese',
                'label' => 'Village Assamese Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'village_name_english',
                'label' => 'Village English Name',
                'rules' => 'trim|required|callback_englishRegex_check'
            ),
            array(
                'field' => 'rural_urban',
                'label' => 'Rural / Urban',
                'rules' => 'trim|required|max_length[1]'
            ),
            array(
                'field' => 'village_status',
                'label' => 'Village Type',
                'rules' => 'trim|required|max_length[2]'
            ),
            array(
                'field' => 'is_map',
                'label' => 'Is Map Updated',
                'rules' => 'trim|required|max_length[1]'
            ),
            array(
                'field' => 'is_mc',
                'label' => 'Municipal Corporation',
                'rules' => 'trim|required|max_length[1]'
            ),
            array(
                'field' => 'nc_btad',
                'label' => 'Village Status',
                'rules' => 'trim|max_length[4]'
            ),
            array(
                'field' => 'is_periphary',
                'label' => 'Is Periphary',
                'rules' => 'trim|max_length[5]'
            ),
            array(
                'field' => 'is_tribal',
                'label' => 'Is Tribal',
                'rules' => 'trim|max_length[5]'
            ),
            array(
                'field' => 'is_svamitva',
                'label' => 'Is Svamitva',
                'rules' => 'trim|max_length[5]'
            ),
        );

        // /*********** Validation *************/
        $this->form_validation->set_rules($data_array);
        if ($this->form_validation->run() === FALSE) {
            $this->form_validation->set_error_delimiters('', '');
            echo json_encode(array(
                'st' => 'failed',
                'msgs' => validation_errors()
            ));
            return;
        } else {
            $data['dist_code'] = $this->input->post('dist_code');
            $data['subdiv_code'] = $this->input->post('subdiv_code');
            $data['cir_code'] = $this->input->post('cir_code');
            $data['mouza_pargona_code'] = $this->input->post('mouza_pargona_code');
            $data['lot_no'] = $this->input->post('lot_no');
            $data['loc_name'] = $this->input->post('village_name_assamese');
            $data['locname_eng'] = strtoupper($this->input->post('village_name_english'));
            $data['rural_urban'] = $this->input->post('rural_urban');
            $data['village_status'] = $this->input->post('village_status');
            $data['is_map'] = $this->input->post('is_map');
            $data['is_mc'] = $this->input->post('is_mc');
            $data['nc_btad'] = $this->input->post('nc_btad');
            $data['is_periphary'] = $this->input->post('is_periphary');
            $data['is_tribal'] = $this->input->post('is_tribal');
            $data['user_code'] = $this->session->userdata('user_code');
            $data['apikey'] = LANDHUB_APIKEY;
            $data['is_svamitva'] = $this->input->post('is_svamitva');

            $url = LANDHUB_APP."index.php/NicApi/saveNewVillage";
            $method = 'POST';    
            $output = $this->NcVillageModel->callApiV2($url, $method, $data);
            
            echo $output;
            return;
        }
    }
    public function englishRegex_check($str)
    {
        if (!preg_match('/^[A-Za-z0-9? ,\/._-]+$/', $str)) {
            $this->form_validation->set_message('englishRegex_check', 'Only alpha characters,white spaces,_,-,/, & numeric values are allowed in English Name');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function getVillageSingle()
    {
        $url = LANDHUB_APP."index.php/NicApi/getVillageByUuid";
        $method = 'POST';
        $data['dist_code'] = $this->input->post('dist_code');
        $data['uuid'] = $this->input->post('uuid');
        $data['apikey'] = LANDHUB_APIKEY;

        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        echo ($output);
        return;
    }
    public function updateVillage()
    {
        $data_array = array(
            array(
                'field' => 'dist_code',
                'label' => 'District',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'subdiv_code',
                'label' => 'Sub-Division',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'cir_code',
                'label' => 'Circle',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'mouza_pargona_code',
                'label' => 'Mouza',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'lot_no',
                'label' => 'Lot No',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'village_name_assamese',
                'label' => 'Village Assamese Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'village_name_english',
                'label' => 'Village English Name',
                'rules' => 'trim|required|callback_englishRegex_check'
            ),
            array(
                'field' => 'rural_urban',
                'label' => 'Rural / Urban',
                'rules' => 'trim|required|max_length[1]'
            ),
            array(
                'field' => 'village_status',
                'label' => 'Village Type',
                'rules' => 'trim|required|max_length[2]'
            ),
            array(
                'field' => 'is_map',
                'label' => 'Is Map Updated',
                'rules' => 'trim|required|max_length[1]'
            ),
            array(
                'field' => 'is_mc',
                'label' => 'Municipal Corporation',
                'rules' => 'trim|required|max_length[1]'
            ),
            array(
                'field' => 'nc_btad',
                'label' => 'Village Status',
                'rules' => 'trim|max_length[4]'
            ),
            array(
                'field' => 'is_periphary',
                'label' => 'Is Periphary',
                'rules' => 'trim|max_length[5]'
            ),
            array(
                'field' => 'is_tribal',
                'label' => 'Is Tribal',
                'rules' => 'trim|max_length[5]'
            ),
            array(
                'field' => 'is_svamitva',
                'label' => 'Is Svamitva',
                'rules' => 'trim|max_length[5]'
            ),
        );

        // /*********** Validation *************/
        $this->form_validation->set_rules($data_array);
        if ($this->form_validation->run() === FALSE) {
            $this->form_validation->set_error_delimiters('', '');
            echo json_encode(array(
                'st' => 'failed',
                'msgs' => validation_errors()
            ));
            return;
        } else {
            $data['dist_code'] = $this->input->post('dist_code');
            $data['subdiv_code'] = $this->input->post('subdiv_code');
            $data['cir_code'] = $this->input->post('cir_code');
            $data['mouza_pargona_code'] = $this->input->post('mouza_pargona_code');
            $data['lot_no'] = $this->input->post('lot_no');
            $data['uuid'] = $this->input->post('uuid');
            $data['loc_name'] = $this->input->post('village_name_assamese');
            $data['locname_eng'] = strtoupper($this->input->post('village_name_english'));
            $data['rural_urban'] = $this->input->post('rural_urban');
            $data['village_status'] = $this->input->post('village_status');
            $data['is_map'] = $this->input->post('is_map');
            $data['is_mc'] = $this->input->post('is_mc');
            $data['nc_btad'] = $this->input->post('nc_btad');
            $data['is_periphary'] = $this->input->post('is_periphary');
            $data['is_tribal'] = $this->input->post('is_tribal');
            $data['is_svamitva'] = $this->input->post('is_svamitva');
            $data['user_code'] = $this->session->userdata('user_code');
            $data['apikey'] = LANDHUB_APIKEY;

            $url = LANDHUB_APP."index.php/NicApi/updateVillage";
            $method = 'POST';    
            $output = $this->NcVillageModel->callApiV2($url, $method, $data);
            
            echo $output;
            return;
        }
    }


    public function deleteVillage()
    {
        $data_array = array(
            array(
                'field' => 'dist_code',
                'label' => 'District',
                'rules' => 'trim|required',
            ),
            array(
                'field' => 'uuid',
                'label' => 'UUID',
                'rules' => 'trim|required',
            )
        );

        // /*********** Validation *************/
        $this->form_validation->set_rules($data_array);
        if ($this->form_validation->run() === FALSE) {
            $this->form_validation->set_error_delimiters('', '');
            echo json_encode(array(
                'st' => 'failed',
                'msgs' => validation_errors()
            ));
            return;
        } else {
            $data['dist_code'] = $this->input->post('dist_code');
            $data['uuid'] = $this->input->post('uuid');
            $data['apikey'] = LANDHUB_APIKEY;

            $url = LANDHUB_APP."index.php/NicApi/deleteVillage";
            $method = 'POST';    
            $output = $this->NcVillageModel->callApiV2($url, $method, $data);
            
            echo $output;
            return;
        }
    }
}
