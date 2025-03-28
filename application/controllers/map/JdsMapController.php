<?php
class JdsMapController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
        if ($this->session->userdata('designation') != JDS && $this->session->userdata('designation') != 'NIC') {
            $data['heading'] = "ERROR:: 404 Page Not Found";
            $data['message'] = 'The page you requested was not found';
            $this->load->view('errors/html/error_404', $data);
            $this->CI =& get_instance();
            $this->CI->output->_display();
            die();
        }
    }

    /** View Pending Maps */
    public function viewPendingMaps()
    {
        $this->db = $this->load->database('db2', TRUE);
        $data = [];

        $data['dist_list'] = (array) json_decode(NC_DISTIRTCS);

        $this->db->from('maps');
        $this->db->where('flag', 'A');
        $this->db->select('*');
        $maps =  $this->db->get()->result();

        foreach ($maps as $map) {
            $this->db = $this->load->database('auth', TRUE);
            $mouza = $this->NcVillageModel->getLocations($map->dist_code, $map->subdiv_code, $map->cir_code, $map->mouza_pargona_code);
            $village = $this->NcVillageModel->getLocations($map->dist_code, $map->subdiv_code, $map->cir_code, $map->mouza_pargona_code, $map->lot_no, $map->vill_townprt_code);

            $map->mouza_name = $mouza ? $mouza['mouza']['loc_name'] : '';
            $map->village_name = $village ? $village['village']['loc_name'] : '';
            $this->db = $this->load->database('db2', TRUE);
            $this->db->from('map_list');
            $this->db->where('map_id', $map->id);
            $this->db->select('*');
            $map->map_lists =  $this->db->get()->result();
        }

        $data['maps'] = $maps;

        $data['_view'] = 'map/jds/view_pending_maps';
        $this->load->view('layouts/main', $data);
    }

    /** Get MAPS */
    public function getMaps()
    {
        $dist_code = $this->input->post('dis');
        $subdiv_code = $this->input->post('subdiv');
        $cir_code = $this->input->post('cir');
        $mouza_pargona_code = $this->input->post('mouza_pargona_code');
        $lot_no = $this->input->post('lot_no');
        $filter = $this->input->post('filter_status');

        $this->db = $this->load->database('db2', TRUE);

        $this->db->from('maps');
        $this->db->where('dist_code', $dist_code);
        if ($subdiv_code) {
            $this->db->where('subdiv_code', $subdiv_code);
        }
        if ($cir_code) {
            $this->db->where('cir_code', $cir_code);
        }

        if ($mouza_pargona_code) {
            $this->db->where('mouza_pargona_code', $mouza_pargona_code);
        }
        if ($lot_no) {
            $this->db->where('lot_no', $lot_no);
        }
        if($filter == 'A'){
            $this->db->where('flag', 'A');
        }
        if($filter == 'F'){
            $this->db->where('flag !=', 'A');
        }
        $this->db->select('*');
        $maps = $this->db->get()->result();
        foreach ($maps as $map) {
            $this->db = $this->load->database('auth', TRUE);
            $mouza = $this->NcVillageModel->getLocations($map->dist_code, $map->subdiv_code, $map->cir_code, $map->mouza_pargona_code);
            $village = $this->NcVillageModel->getLocations($map->dist_code, $map->subdiv_code, $map->cir_code, $map->mouza_pargona_code, $map->lot_no, $map->vill_townprt_code);

            $map->mouza_name = $mouza ? $mouza['mouza']['loc_name'] : '';
            $map->village_name = $village ? $village['village']['loc_name'] : '';
            $this->db = $this->load->database('db2', TRUE);
            $this->db->from('map_list');
            $this->db->where('map_id', $map->id);
            $this->db->select('*');
            $map->map_lists =  $this->db->get()->result();
        }

        echo json_encode($maps);
        return;
    }

    /** forwarded to co */
    public function forwardToCo()
    {
        $this->db = $this->load->database("db2", TRUE);
        $flag = $this->input->post('flag');
        $jds_remark = $this->input->post('jds_remark');
        $map_id = $this->input->post('map_id');

        if ($flag && $map_id && $jds_remark) {
            $this->db->where('id', $map_id)
                ->update('maps', array(
                    'flag' => $flag,
                    'jds_remark' => $jds_remark,
                    'jds_user_code' => $this->session->userdata('user_code'),
                    'jds_verified_at' => date('Y-m-d H:i:s'),
                ));
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array(
                    'status' => '1',
                ));
                return;
            } else {
                log_message("error", 'JDS MAP FLAG UPDATE FAIL #JDSO00001');
                echo json_encode(array(
                    'status' => '0',
                ));
                return;
            }
        } else {
            log_message("error", 'JDS MAP FLAG UPDATE FAIL #JDSO00002');
            echo json_encode(array(
                'status' => '0',
            ));
            return;
        }
    }

}