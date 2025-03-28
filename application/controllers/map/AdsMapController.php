<?php
class AdsMapController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
        if ($this->session->userdata('designation') != ADS && $this->session->userdata('designation') != 'NIC') {
            $data['heading'] = "ERROR:: 404 Page Not Found";
            $data['message'] = 'The page you requested was not found';
            $this->load->view('errors/html/error_404', $data);
            $this->CI = &get_instance();
            $this->CI->output->_display();
            die();
        }
    }

    //    /** View Villages Page */
    //    public function viewVillages()
    //    {
    //        var_dump($_POST);die;
    //        $this->db = $this->load->database('auth', TRUE);
    //        $data = [];
    //        $data['dist_list'] = (array) json_decode(NC_DISTIRTCS);
    //        $data['_view'] = 'map/ads/view-villages';
    //        $this->load->view('layouts/main', $data);
    //        return;
    //    }

    /** View Villages Page */
    public function viewVillages()
    {
        $data = [];

        $dis = $this->input->get('dist_code');
        $subdiv = $this->input->get('subdiv_code');
        $cir = $this->input->get('cir_code');
        $mza = $this->input->get('mouza_pargona_code');
        $lot = $this->input->get('lot_no');

        $data['dist_code'] = $dis;
        $data['subdiv_code'] = $subdiv;
        $data['cir_code'] = $cir;
        $data['mouza_pargona_code'] = $mza;
        $data['lot_no'] = $lot;


        $data['locations'] = $this->NcVillageModel->getLocations($dis, $subdiv, $cir, $mza, $lot);
        $data['_view'] = 'map/ads/view-villages';
        $this->load->view('layouts/main', $data);
        return;
    }

    /** Show Village */
    public function showVillage()
    {
        $uuid = $this->input->get('uuid');
        $name_change = $this->input->get('name_change');
        $application_no = $this->input->get('application_no');

        $this->db = $this->load->database("auth", TRUE);
        $this->db2 = $this->load->database("db2", TRUE);

        $this->db->from('location l');
        $this->db->where('l.uuid', $uuid);
        $this->db->select('l.*');
        $res =  $this->db->get();
        $village = null;
        if ($res->num_rows() != 0) {
            $village = $res->row_array();
        } else {
            $data['heading'] = "ERROR:: 404 Page Not Found";
            $data['message'] = 'The page you requested was not found';
            $this->load->view('errors/html/error_404', $data);
            $this->CI = &get_instance();
            $this->CI->output->_display();
            die();
            return;
        }

        $this->db2->from('maps');
        $this->db2->where('uuid', $uuid);
        $this->db2->select('map_dir_path,ads_verified,ads_verified_at,ads_note,id,flag');
        $res2 =  $this->db2->get();
        $v_data = null;
        $village['map_dir_path'] = null;
        $village['ads_verified'] = null;
        $village['ads_verified_at'] = null;
        $village['ads_note'] = null;
        $village['map_id'] = null;
        $village['flag'] = null;
        if ($res2->num_rows() != 0) {
            $v_data = $res2->row_array();
            $village['map_dir_path'] = $v_data['map_dir_path'];
            $village['ads_verified'] = $v_data['ads_verified'];
            $village['ads_verified_at'] = $v_data['ads_verified_at'];
            $village['ads_note'] = $v_data['ads_note'];
            $village['map_id'] = $v_data['id'];
            $village['flag'] = $v_data['flag'];
        }

        $data['village'] = $village;

        $this->db2->from('map_list');
        $this->db2->where('uuid', $uuid);
        $this->db2->select('id');
        $res =  $this->db2->get();
        $map_list = $res->result_array();
        $data['map_list'] = $map_list;

        $data['locations'] = $this->NcVillageModel->getLocations(
            $village['dist_code'],
            $village['subdiv_code'],
            $village['cir_code'],
            $village['mouza_pargona_code'],
            $village['lot_no'],
            $village['vill_townprt_code']
        );


        $data['name_change'] = $name_change;
        $data['application_no'] = $application_no;
        $data['_view'] = 'map/ads/village-details';
        $this->load->view('layouts/main', $data);
        return;
    }

    /** get Dags details */
    public function getDags()
    {
        $data['d'] = $_POST['dist_code'];
        $data['s'] = $_POST['subdiv_code'];
        $data['c'] = $_POST['cir_code'];
        $data['m'] = $_POST['mouza_pargona_code'];
        $data['l'] = $_POST['lot_no'];
        $data['v'] = $_POST['vill_townprt_code'];
        $url = API_LINK_NC_VILLAGE . "apiGetDagsMap";

        $method = 'POST';
        $output = $this->NcVillageModel->callApi($url, $method, $data);
        if ($output->data == null) {
            log_message("error", 'ADSMAP #ADS0001');
            echo json_encode(array('success' => 'N'));
            return;
        }

        echo json_encode(array('success' => 'Y', 'dags' => $output->data->dags));
        return;
    }

    /** Upload Map village */
    public function uploadMap()
    {
        $this->form_validation->set_rules('remark', 'ADS Note', 'trim|required');
        if (empty($_FILES['pdf']['name'])) {
            $error = $this->form_validation->set_rules('pdf', 'Pdf File', 'required');
            echo json_encode($error);
            return;
        }

        $this->db = $this->load->database("auth", TRUE);
        $this->db2 = $this->load->database("db2", TRUE);

        $data['dist_code'] = $_POST['dist_code'];
        $data['subdiv_code'] = $_POST['subdiv_code'];
        $data['cir_code'] = $_POST['cir_code'];
        $data['mouza_pargona_code'] = $_POST['mouza_pargona_code'];
        $data['lot_no'] = $_POST['lot_no'];
        $data['vill_townprt_code'] = $_POST['vill_townprt_code'];
        $data['uuid'] = $uuid = $_POST['uuid'];
        $data['ads_note'] = $_POST['remark'];

        $this->db2->from('maps');
        $this->db2->where('uuid', $uuid);
        $is_exists =  $this->db2->get();
        if ($is_exists->num_rows() != 0) {
            echo json_encode(['submitted' => 'E']);
            return;
        }

        $file_name = $data['dist_code'] . '_' . $data['subdiv_code'] . '_' . $data['cir_code'] . '_' . $data['mouza_pargona_code'] . '_' . $data['lot_no'] . '_' . $data['vill_townprt_code'];

        if (is_dir(VILLAGE_MAP_PDF_DIR . $file_name) === false) {
            mkdir(VILLAGE_MAP_PDF_DIR . $file_name);
        }

        $this->db2->trans_begin();
        $data = array(
            'dist_code' => $_POST['dist_code'],
            'subdiv_code' => $_POST['subdiv_code'],
            'cir_code' => $_POST['cir_code'],
            'mouza_pargona_code' => $_POST['mouza_pargona_code'],
            'lot_no' => $_POST['lot_no'],
            'vill_townprt_code' => $_POST['vill_townprt_code'],
            'uuid' => $_POST['uuid'],
            'ads_note' => $_POST['remark'],
            'status' => 'Y',
            'ads_verified' => 'Y',
            'user_code' => $this->session->userdata('user_code'),
            'ads_verified_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $inserted = $this->db2->insert('maps', $data);
        $insert_id = $this->db2->insert_id();

        $submitted = 'N';
        if ($inserted == true) {
            $submitted = 'Y';
        }

        $images = array();
        foreach ($_FILES["pdf"]["name"] as $key => $image) {
            $_FILES['images[]']['name'] = $_FILES["pdf"]["name"][$key];
            $mime = $_FILES['images[]']['type'] = $_FILES["pdf"]['type'][$key];
            $_FILES['images[]']['tmp_name'] = $_FILES["pdf"]['tmp_name'][$key];
            $_FILES['images[]']['error'] = $_FILES["pdf"]['error'][$key];
            $_FILES['images[]']['size'] = $_FILES["pdf"]['size'][$key];

            $path_parts = pathinfo($_FILES["pdf"]["name"][$key]);
            $extension = $path_parts['extension'];

            $fileNameNew = $file_name . '_' . $key;

            $data['map_dir_path'] = $map_dir_path = VILLAGE_MAP_PDF_DIR . $file_name . '/' . $fileNameNew . '.' . $extension;

            $images[] = $fileNameNew;

            $config['upload_path']          = VILLAGE_MAP_PDF_DIR . $file_name;
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = MAP_PDF_SIZE;
            $config['overwrite']            = TRUE;
            $config['file_name']            = $fileNameNew . '.' . $extension;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
                $data = array(
                    'dist_code' => $_POST['dist_code'],
                    'subdiv_code' => $_POST['subdiv_code'],
                    'cir_code' => $_POST['cir_code'],
                    'mouza_pargona_code' => $_POST['mouza_pargona_code'],
                    'lot_no' => $_POST['lot_no'],
                    'vill_townprt_code' => $_POST['vill_townprt_code'],
                    'uuid' => $_POST['uuid'],
                    'map_id' => $insert_id,
                    'map_note' => null,
                    'map_dir_path' => $map_dir_path,
                    'extension' => $extension,
                    'mime' => $mime,
                    'user_code' => $this->session->userdata('user_code'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db2->insert('map_list', $data);
            } else {
                log_message("error", 'ADS FILE UPLOAD FAIL #ADS000012');
                $submitted = 'N';
                break;
            }
            if (!file_exists(VILLAGE_MAP_PDF_DIR . $file_name . '/' . $fileNameNew . '.' . $extension)) {
                log_message("error", 'ADS FILE UPLOAD FAIL #ADS00001');
                delete_files(VILLAGE_MAP_PDF_DIR . $file_name, true);
                $this->db2->trans_rollback();
                echo json_encode(array('submitted' => 'N', 'village' => '', 'map_list' => [], 'log' => 'ADS FILE UPLOAD FAIL #ADS00001'));
                break;
                return;
            }
        }

        $this->db->from('location');
        $this->db->where('uuid', $uuid);
        $this->db->select('*');
        $res =  $this->db->get();
        $village = $res->row_array();

        $this->db2->from('maps');
        $this->db2->where('uuid', $uuid);
        $this->db2->select('map_dir_path,ads_verified,ads_verified_at,ads_note,id,flag');
        $res2 =  $this->db2->get();
        $v_data = null;
        $village['map_dir_path'] = null;
        $village['ads_verified'] = null;
        $village['ads_verified_at'] = null;
        $village['ads_note'] = null;
        $village['map_id'] = null;
        $village['flag'] = null;
        if ($res2->num_rows() != 0) {
            $v_data = $res2->row_array();
            $village['map_dir_path'] = $v_data['map_dir_path'];
            $village['ads_verified'] = $v_data['ads_verified'];
            $village['ads_verified_at'] = $v_data['ads_verified_at'];
            $village['ads_note'] = $v_data['ads_note'];
            $village['map_id'] = $v_data['id'];
            $village['flag'] = $v_data['flag'];
        }

        $map_list = array();
        if ($submitted == 'N' || $this->db->trans_status() === FALSE) {
            log_message("error", 'ADS FILE UPLOAD FAIL #ADS00002');
            delete_files(VILLAGE_MAP_PDF_DIR . $file_name, true);
            $this->db2->trans_rollback();
            echo json_encode(array('submitted' => $submitted, 'village' => $village, 'map_list' => $map_list));
            return;
        }
        $this->db2->trans_commit();
        $this->db2->from('map_list');
        $this->db2->where('uuid', $_POST['uuid']);
        $this->db2->select('id');
        $res1 =  $this->db2->get();
        $map_list = $res1->result_array();
        echo json_encode(array('submitted' => $submitted, 'village' => $village, 'map_list' => $map_list));
        return;
    }

    /** Re Upload Map village */
    public function reUploadMap()
    {
        $this->form_validation->set_rules('remark', 'ADS Note', 'trim|required');
        if (empty($_FILES['pdf']['name'])) {
            $error = $this->form_validation->set_rules('pdf', 'Pdf File', 'required');
            echo json_encode($error);
            return;
        }

        $this->db = $this->load->database("auth", TRUE);
        $this->db2 = $this->load->database("db2", TRUE);

        $data['dist_code'] = $_POST['dist_code'];
        $data['subdiv_code'] = $_POST['subdiv_code'];
        $data['cir_code'] = $_POST['cir_code'];
        $data['mouza_pargona_code'] = $_POST['mouza_pargona_code'];
        $data['lot_no'] = $_POST['lot_no'];
        $data['vill_townprt_code'] = $_POST['vill_townprt_code'];
        $data['uuid'] = $uuid = $_POST['uuid'];
        $data['ads_note'] = $_POST['remark'];

        $file_name = $data['dist_code'] . '_' . $data['subdiv_code'] . '_' . $data['cir_code'] . '_' . $data['mouza_pargona_code'] . '_' . $data['lot_no'] . '_' . $data['vill_townprt_code'];

        $this->db2->trans_begin();

        $this->db2->set('ads_verified_at', date('Y-m-d H:i:s'));
        $this->db2->set('updated_at', date('Y-m-d H:i:s'));
        $this->db2->set('ads_note', $_POST['remark']);
        $this->db2->set('status', 'Y');
        $this->db2->set('ads_verified', 'Y');
        $this->db2->set('user_code', $this->session->userdata('user_code'));
        $this->db2->where('id', $_POST['map_id']);
        $this->db2->where('flag !=', 'D');
        $this->db2->update('maps');

        $submitted = 'N';
        if ($this->db2->affected_rows() == 1) {
            $submitted = 'Y';

            $this->db2->where('dist_code', $_POST['dist_code']);
            $this->db2->where('subdiv_code', $_POST['subdiv_code']);
            $this->db2->where('cir_code', $_POST['cir_code']);
            $this->db2->where('mouza_pargona_code', $_POST['mouza_pargona_code']);
            $this->db2->where('lot_no', $_POST['lot_no']);
            $this->db2->where('vill_townprt_code', $_POST['vill_townprt_code']);
            $this->db2->where('uuid', $_POST['uuid']);
            $this->db2->delete('map_list');
        } else {
            $this->db2->trans_rollback();
            log_message("error", 'ADS MAPS TABLE UPDATE FAILED #ADS000091');
            echo json_encode(array('submitted' => 'N', 'village' => '', 'map_list' => [], 'log' => 'ADS MAPS TABLE UPDATE FAILED #ADS000091'));
            return;
        }

        if (is_dir(VILLAGE_MAP_PDF_DIR . $file_name) === false) {
            mkdir(VILLAGE_MAP_PDF_DIR . $file_name);
        } else {
            delete_files(VILLAGE_MAP_PDF_DIR . $file_name, true);
        }

        $images = array();
        foreach ($_FILES["pdf"]["name"] as $key => $image) {
            $_FILES['images[]']['name'] = $_FILES["pdf"]["name"][$key];
            $mime = $_FILES['images[]']['type'] = $_FILES["pdf"]['type'][$key];
            $_FILES['images[]']['tmp_name'] = $_FILES["pdf"]['tmp_name'][$key];
            $_FILES['images[]']['error'] = $_FILES["pdf"]['error'][$key];
            $_FILES['images[]']['size'] = $_FILES["pdf"]['size'][$key];

            $path_parts = pathinfo($_FILES["pdf"]["name"][$key]);
            $extension = $path_parts['extension'];

            $fileNameNew = $file_name . '_' . $key;

            $data['map_dir_path'] = $map_dir_path = VILLAGE_MAP_PDF_DIR . $file_name . '/' . $fileNameNew . '.' . $extension;

            $images[] = $fileNameNew;

            $config['upload_path']          = VILLAGE_MAP_PDF_DIR . $file_name;
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = MAP_PDF_SIZE;
            $config['overwrite']            = TRUE;
            $config['file_name']            = $fileNameNew . '.' . $extension;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
                $data = array(
                    'dist_code' => $_POST['dist_code'],
                    'subdiv_code' => $_POST['subdiv_code'],
                    'cir_code' => $_POST['cir_code'],
                    'mouza_pargona_code' => $_POST['mouza_pargona_code'],
                    'lot_no' => $_POST['lot_no'],
                    'vill_townprt_code' => $_POST['vill_townprt_code'],
                    'uuid' => $_POST['uuid'],
                    'map_id' => $_POST['map_id'],
                    'map_note' => null,
                    'map_dir_path' => $map_dir_path,
                    'extension' => $extension,
                    'mime' => $mime,
                    'user_code' => $this->session->userdata('user_code'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db2->insert('map_list', $data);
            } else {
                log_message("error", 'ADS FILE UPLOAD FAIL #ADS000012');
                $submitted = 'N';
                break;
            }
            if (!file_exists(VILLAGE_MAP_PDF_DIR . $file_name . '/' . $fileNameNew . '.' . $extension)) {
                log_message("error", 'ADS FILE UPLOAD FAIL #ADS00001');
                delete_files(VILLAGE_MAP_PDF_DIR . $file_name, true);
                $this->db2->trans_rollback();
                echo json_encode(array('submitted' => 'N', 'village' => '', 'map_list' => [], 'log' => 'ADS FILE UPLOAD FAIL #ADS00001'));
                break;
                return;
            }
        }

        $this->db->from('location');
        $this->db->where('uuid', $uuid);
        $this->db->select('*');
        $res =  $this->db->get();
        $village = $res->row_array();

        $this->db2->from('maps');
        $this->db2->where('uuid', $uuid);
        $this->db2->select('map_dir_path,ads_verified,ads_verified_at,ads_note,id,flag');
        $res2 =  $this->db2->get();
        $v_data = null;
        $village['map_dir_path'] = null;
        $village['ads_verified'] = null;
        $village['ads_verified_at'] = null;
        $village['ads_note'] = null;
        $village['map_id'] = null;
        $village['flag'] = null;
        if ($res2->num_rows() != 0) {
            $v_data = $res2->row_array();
            $village['map_dir_path'] = $v_data['map_dir_path'];
            $village['ads_verified'] = $v_data['ads_verified'];
            $village['ads_verified_at'] = $v_data['ads_verified_at'];
            $village['ads_note'] = $v_data['ads_note'];
            $village['map_id'] = $v_data['id'];
            $village['flag'] = $v_data['flag'];
        }

        $map_list = array();
        if ($submitted == 'N' || $this->db->trans_status() === FALSE) {
            log_message("error", 'ADS FILE Re UPLOAD FAIL #ADS000062');
            delete_files(VILLAGE_MAP_PDF_DIR . $file_name, true);
            $this->db2->trans_rollback();
            echo json_encode(array('submitted' => $submitted, 'village' => $village, 'map_list' => $map_list));
            return;
        }
        $this->db2->trans_commit();
        $this->db2->from('map_list');
        $this->db2->where('uuid', $_POST['uuid']);
        $this->db2->select('id');
        $res1 =  $this->db2->get();
        $map_list = $res1->result_array();
        echo json_encode(array('submitted' => $submitted, 'village' => $village, 'map_list' => $map_list));
        return;
    }

    /** view uploaded file */
    public function viewUploadedMap()
    {
        $this->db2 = $this->load->database("db2", TRUE);
        $id = $this->input->get('id');

        $map = $this->db2->query("SELECT map_dir_path,mime,extension FROM map_list WHERE id=?", array($id))->row();

        $mainfile = file_get_contents($map->map_dir_path);
        header("Content-type:" . $map->mime);
        echo $mainfile;
    }


    public function subDivDetails()
    {
        $this->db = $this->load->database('auth', TRUE);
        $data = [];
        $dist_code = $this->input->post('dis');
        $formdata = $this->NcVillageModel->subdivisiondetails($dist_code);
        foreach ($formdata as $value) {
            $data['subdiv_code'][] = $value;
        }
        echo json_encode($data['subdiv_code']);
    }

    public function circledetails()
    {
        $this->db = $this->load->database('auth', TRUE);
        $data = [];
        $dist_code = $this->input->post('dis');
        $subdiv = $this->input->post('subdiv');
        $formdata = $this->NcVillageModel->circledetails($dist_code, $subdiv);
        foreach ($formdata as $value) {
            $data['cir_code'][] = $value;
        }
        echo json_encode($data['cir_code']);
    }

    public function mouzadetails()
    {
        $this->db = $this->load->database('auth', TRUE);
        $data = [];
        $dis = $this->input->post('dis');
        $subdiv = $this->input->post('subdiv');
        $cir = $this->input->post('cir');
        $formdata = $this->NcVillageModel->mouzadetails($dis, $subdiv, $cir);
        foreach ($formdata as $value) {
            $data['mouza'][] = $value;
        }
        echo json_encode($data['mouza']);
    }

    public function lotdetails()
    {
        $this->db = $this->load->database('auth', TRUE);
        $data = [];
        $dis = $this->input->post('dis');
        $subdiv = $this->input->post('subdiv');
        $cir = $this->input->post('cir');
        $mza = $this->input->post('mza');
        $formdata = $this->NcVillageModel->lotdetails($dis, $subdiv, $cir, $mza);
        foreach ($formdata as $value) {
            $data['lot'][] = $value;
        }
        echo json_encode($data['lot']);
    }

    /** get Villages */
    public function getVillages()
    {
        $data = [];

        $this->db = $this->load->database("auth", TRUE);
        $this->db2 = $this->load->database("db2", TRUE);

        $dis = $this->input->post('dist_code');
        $subdiv = $this->input->post('subdiv_code');
        $cir = $this->input->post('cir_code');
        $mza = $this->input->post('mouza_pargona_code');
        $lot = $this->input->post('lot_no');
        $is_only_nc = $this->input->post('is_only_nc');


        $this->db->from('location l');
        $this->db->where('l.dist_code', $dis);
        $this->db->where('l.subdiv_code', $subdiv);
        $this->db->where('l.cir_code', $cir);
        $this->db->where('l.mouza_pargona_code', $mza);
        $this->db->where('l.lot_no', $lot);
        $this->db->where('l.vill_townprt_code !=', '00000');
        if ($is_only_nc == 'Y') {
            $this->db->where('l.status', '1');
        }
        $this->db->select('l.*');
        $this->db->order_by('l.uuid', 'asc');
        $res =  $this->db->get();
        $villages = null;
        if ($res->num_rows() != 0) {
            $villages = $res->result_array();
        }

        foreach ($villages as $key => $v) {
            $this->db2->from('maps');
            $this->db2->where('uuid', $v['uuid']);
            $this->db2->select('map_dir_path,ads_verified,ads_verified_at,ads_note');
            $res2 =  $this->db2->get();
            $v_data = null;
            $villages[$key]['map_dir_path'] = null;
            $villages[$key]['ads_verified'] = null;
            $villages[$key]['ads_verified_at'] = null;
            $villages[$key]['ads_note'] = null;
            if ($res2->num_rows() != 0) {
                $v_data = $res2->row_array();
                $villages[$key]['map_dir_path'] = $v_data['map_dir_path'];
                $villages[$key]['ads_verified'] = $v_data['ads_verified'];
                $villages[$key]['ads_verified_at'] = $v_data['ads_verified_at'];
                $villages[$key]['ads_note'] = $v_data['ads_note'];
            }
        }

        $data['village'] = $villages;

        foreach ($villages as $value) {
            $data['villages'][] = $value;
        }
        echo json_encode($data['villages']);
    }

    /** select location */
    public function selectLocation()
    {
        $this->db = $this->load->database('auth', TRUE);
        $data = [];
        $data['dist_list'] = (array) json_decode(NC_DISTIRTCS);
        $data['_view'] = 'map/ads/location';
        $this->load->view('layouts/main', $data);
        return;
    }

    /** Re Upload Map village for Name Change */
    public function reUploadMapNameChange()
    {
        $this->form_validation->set_rules('remark', 'ADS Note', 'trim|required');
        if (empty($_FILES['pdf']['name'])) {
            $error = $this->form_validation->set_rules('pdf', 'Pdf File', 'required');
            echo json_encode($error);
            return;
        }

        $this->db = $this->load->database("auth", TRUE);
        $this->db2 = $this->load->database("db2", TRUE);

        $data['dist_code'] = $_POST['dist_code'];
        $data['subdiv_code'] = $_POST['subdiv_code'];
        $data['cir_code'] = $_POST['cir_code'];
        $data['mouza_pargona_code'] = $_POST['mouza_pargona_code'];
        $data['lot_no'] = $_POST['lot_no'];
        $data['vill_townprt_code'] = $_POST['vill_townprt_code'];
        $data['uuid'] = $uuid = $_POST['uuid'];
        $data['ads_note'] = $_POST['remark'];

        $file_name = $data['dist_code'] . '_' . $data['subdiv_code'] . '_' . $data['cir_code'] . '_' . $data['mouza_pargona_code'] . '_' . $data['lot_no'] . '_' . $data['vill_townprt_code'];

        $this->db2->trans_begin();

        $this->db2->set('ads_verified_at', date('Y-m-d H:i:s'));
        $this->db2->set('updated_at', date('Y-m-d H:i:s'));
        $this->db2->set('ads_note', $_POST['remark']);
        $this->db2->set('flag', 'E');
        $this->db2->set('ads_verified', 'Y');
        $this->db2->set('user_code', $this->session->userdata('user_code'));
        $this->db2->where('id', $_POST['map_id']);
        $this->db2->update('maps');

        $submitted = 'N';
        if ($this->db2->affected_rows() == 1) {
            $submitted = 'Y';


            $url = API_LINK_NC_VILLAGE . "forwardNameChangeMap";
            $method = 'POST';
            $data['application_no'] = $_POST['application_no'];
            $data['user'] = 'ADS';
            $data['note'] = $_POST['remark'];
            $data['dist_code'] = $_POST['dist_code'];
            $data['user_code'] = $this->session->userdata('user_code');
            $output = $this->NcVillageModel->callApiV2($url, $method, $data);
            if (!$output) {
                $this->db2->trans_rollback();
                log_message("error", 'ADS NC_VILLAGES TABLE UPDATE FAILED #ADS0000102');
                echo json_encode(array('submitted' => 'N', 'village' => '', 'map_list' => [], 'log' => 'ADS NC_VILLAGES TABLE UPDATE FAILED #ADS0000102'));
                return;
            }

            $this->db2->where('dist_code', $_POST['dist_code']);
            $this->db2->where('subdiv_code', $_POST['subdiv_code']);
            $this->db2->where('cir_code', $_POST['cir_code']);
            $this->db2->where('mouza_pargona_code', $_POST['mouza_pargona_code']);
            $this->db2->where('lot_no', $_POST['lot_no']);
            $this->db2->where('vill_townprt_code', $_POST['vill_townprt_code']);
            $this->db2->where('uuid', $_POST['uuid']);
            $this->db2->delete('map_list');
        } else {
            $this->db2->trans_rollback();
            log_message("error", 'ADS MAPS TABLE UPDATE FAILED #ADS000091');
            echo json_encode(array('submitted' => 'N', 'village' => '', 'map_list' => [], 'log' => 'ADS MAPS TABLE UPDATE FAILED #ADS000091'));
            return;
        }

        if (is_dir(VILLAGE_MAP_PDF_DIR . $file_name) === false) {
            mkdir(VILLAGE_MAP_PDF_DIR . $file_name);
        } else {
            delete_files(VILLAGE_MAP_PDF_DIR . $file_name, true);
        }

        $images = array();
        foreach ($_FILES["pdf"]["name"] as $key => $image) {
            $_FILES['images[]']['name'] = $_FILES["pdf"]["name"][$key];
            $mime = $_FILES['images[]']['type'] = $_FILES["pdf"]['type'][$key];
            $_FILES['images[]']['tmp_name'] = $_FILES["pdf"]['tmp_name'][$key];
            $_FILES['images[]']['error'] = $_FILES["pdf"]['error'][$key];
            $_FILES['images[]']['size'] = $_FILES["pdf"]['size'][$key];

            $path_parts = pathinfo($_FILES["pdf"]["name"][$key]);
            $extension = $path_parts['extension'];

            $fileNameNew = $file_name . '_' . $key;

            $data['map_dir_path'] = $map_dir_path = VILLAGE_MAP_PDF_DIR . $file_name . '/' . $fileNameNew . '.' . $extension;

            $images[] = $fileNameNew;

            $config['upload_path']          = VILLAGE_MAP_PDF_DIR . $file_name;
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = MAP_PDF_SIZE;
            $config['overwrite']            = TRUE;
            $config['file_name']            = $fileNameNew . '.' . $extension;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
                $data = array(
                    'dist_code' => $_POST['dist_code'],
                    'subdiv_code' => $_POST['subdiv_code'],
                    'cir_code' => $_POST['cir_code'],
                    'mouza_pargona_code' => $_POST['mouza_pargona_code'],
                    'lot_no' => $_POST['lot_no'],
                    'vill_townprt_code' => $_POST['vill_townprt_code'],
                    'uuid' => $_POST['uuid'],
                    'map_id' => $_POST['map_id'],
                    'map_note' => null,
                    'map_dir_path' => $map_dir_path,
                    'extension' => $extension,
                    'mime' => $mime,
                    'user_code' => $this->session->userdata('user_code'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db2->insert('map_list', $data);
            } else {
                log_message("error", 'ADS FILE UPLOAD FAIL #ADS000012');
                $submitted = 'N';
                break;
            }
            if (!file_exists(VILLAGE_MAP_PDF_DIR . $file_name . '/' . $fileNameNew . '.' . $extension)) {
                log_message("error", 'ADS FILE UPLOAD FAIL #ADS00001');
                delete_files(VILLAGE_MAP_PDF_DIR . $file_name, true);
                $this->db2->trans_rollback();
                echo json_encode(array('submitted' => 'N', 'village' => '', 'map_list' => [], 'log' => 'ADS FILE UPLOAD FAIL #ADS00001'));
                break;
                return;
            }
        }

        $this->db->from('location');
        $this->db->where('uuid', $uuid);
        $this->db->select('*');
        $res =  $this->db->get();
        $village = $res->row_array();

        $this->db2->from('maps');
        $this->db2->where('uuid', $uuid);
        $this->db2->select('map_dir_path,ads_verified,ads_verified_at,ads_note,id,flag');
        $res2 =  $this->db2->get();
        $v_data = null;
        $village['map_dir_path'] = null;
        $village['ads_verified'] = null;
        $village['ads_verified_at'] = null;
        $village['ads_note'] = null;
        $village['map_id'] = null;
        $village['flag'] = null;
        if ($res2->num_rows() != 0) {
            $v_data = $res2->row_array();
            $village['map_dir_path'] = $v_data['map_dir_path'];
            $village['ads_verified'] = $v_data['ads_verified'];
            $village['ads_verified_at'] = $v_data['ads_verified_at'];
            $village['ads_note'] = $v_data['ads_note'];
            $village['map_id'] = $v_data['id'];
            $village['flag'] = $v_data['flag'];
        }

        $map_list = array();
        if ($submitted == 'N' || $this->db->trans_status() === FALSE) {
            log_message("error", 'ADS FILE Re UPLOAD FAIL #ADS000062');
            delete_files(VILLAGE_MAP_PDF_DIR . $file_name, true);
            $this->db2->trans_rollback();
            echo json_encode(array('submitted' => $submitted, 'village' => $village, 'map_list' => $map_list));
            return;
        }
        $this->db2->trans_commit();
        $this->db2->from('map_list');
        $this->db2->where('uuid', $_POST['uuid']);
        $this->db2->select('id');
        $res1 =  $this->db2->get();
        $map_list = $res1->result_array();
        echo json_encode(array('submitted' => $submitted, 'village' => $village, 'map_list' => $map_list));
        return;
    }
}

