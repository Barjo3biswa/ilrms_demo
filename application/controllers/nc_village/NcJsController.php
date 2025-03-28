<?php
class NcJsController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
        $this->load->model('nc_village/NcVillageModel');
        if ($this->session->userdata('designation') != DPT_JS) {
            $data['heading'] = "ERROR:: 404 Page Not Found";
            $data['message'] = 'The page you requested was not found';
            $this->load->view('errors/html/error_404', $data);
            $this->CI =& get_instance();
            $this->CI->output->_display();
            die;
        }
    }

    /** View Villages Page */
//    public function viewVillages()
//    {
//        $this->db = $this->load->database('auth', TRUE);
//        $data = [];
//
//        $data['dist_list'] = (array) json_decode(NC_DISTIRTCS);
//
//        $this->form_validation->set_rules('selectDistrict', 'Please Select District Before Proceed', 'required');
//        if ($this->form_validation->run() == FALSE) {
//            $data['_view'] = 'nc_village/js/view-villages';
//            $this->load->view('layouts/main', $data);
//            return;
//        }
//    }

    /** Get all pending Villages */
    public function getVillagesG()
    {
        $data['d'] = $this->input->post('dist_code');
        $data['s'] = $this->input->post('subdiv_code');
        $data['c'] = $this->input->post('cir_code');
        $data['m'] = $this->input->post('mouza_pargona_code');
        $data['l'] = $this->input->post('lot_no');
        $data['f'] = $this->input->post('filter');
        $data['pending'] = 'C';
        $data['verified'] = 'E';
        $data['user'] = 'JS';

        $url = API_LINK_NC_VILLAGE . "apiGetNcVillaqes";
        $method = 'POST';
        $output = $this->NcVillageModel->callApi($url, $method, $data);
        echo json_encode($output->data);
        return;
    }

    /** get pending village details */
    public function getPendingVillage()
    {
        $this->db = $this->load->database('db2', TRUE);
        $data['d'] = $_GET['d'];
        $data['application_no'] = $_GET['application_no'];
        $data['pending'] = 'C';
        $data['verified'] = 'E';
        $data['user'] = 'JS';
        $url = API_LINK_NC_VILLAGE."apiGetPendingVillage";

        $method = 'POST';
        $output = $this->NcVillageModel->callApi($url,$method,$data);
        if ($output->data==null)
        {
            log_message("error", 'JS #JS0001');
            echo json_encode($output->data);
            return;
        }

        $data['locations'] = $output->data->locations;
        $data['nc_village'] = $nc_village =  $output->data->nc_village;
        $data['pdf'] = $output->data->pdf_base64;

        $this->db->select('*');
        $this->db->from('nc_village_notification');
        $this->db->where('dist_code', $nc_village->dist_code );
        $this->db->where('subdiv_code', $nc_village->subdiv_code );
        $this->db->where('cir_code', $nc_village->cir_code );
        $this->db->where('mouza_pargona_code', $nc_village->mouza_pargona_code );
        $this->db->where('lot_no', $nc_village->lot_no );
        $this->db->where('vill_townprt_code', $nc_village->vill_townprt_code );
        $query = $this->db->get();
        $notification = array();
        if ( $query->num_rows() > 0 )
        {
            $notification = $query->row();
        }

        $data['notification'] = $notification;

        $this->db->select('id');
        $this->db->from('nc_village_notification_list');
        $this->db->where('dist_code', $nc_village->dist_code );
        $this->db->where('subdiv_code', $nc_village->subdiv_code );
        $this->db->where('cir_code', $nc_village->cir_code );
        $this->db->where('mouza_pargona_code', $nc_village->mouza_pargona_code );
        $this->db->where('lot_no', $nc_village->lot_no );
        $this->db->where('vill_townprt_code', $nc_village->vill_townprt_code );
        $query = $this->db->get();
        $notification_list = array();
        if ( $query->num_rows() > 0 )
        {
            $notification_list = $query->result_array();
        }

        $data['notification_list'] = $notification_list;

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

        $data['_view'] = 'nc_village/js/village-details';
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
            log_message("error", 'JS #JS0002');
            echo json_encode(array('success' => 'N'));
            return;
        }

        echo json_encode(array('success' => 'Y','dags' => $output->data->dags, 'dc_name' => $output->data->dc));
        return;
    }

    /** Upload village Notification */
    public function uploadVillageNotification()
    {
        $this->form_validation->set_rules('remark', 'JS Note', 'trim|required');
        if (empty($_FILES['notification']['name']))
        {
            $error = $this->form_validation->set_rules('notification', 'File', 'required');
            echo json_encode($error);
            return;
        }

        $this->db = $this->load->database("auth", TRUE);
        $this->db2 = $this->load->database("db2", TRUE);

        $dist_code = $data['dist_code'] = $_POST['dist_code'];
        $data['subdiv_code'] = $_POST['subdiv_code'];
        $data['cir_code'] = $_POST['cir_code'];
        $data['mouza_pargona_code'] = $_POST['mouza_pargona_code'];
        $data['lot_no'] = $_POST['lot_no'];
        $data['vill_townprt_code'] = $_POST['vill_townprt_code'];
        $uuid = $data['uuid'] = $uuid = $_POST['uuid'];
        $application_no = $data['application_no'] =  $_POST['application_no'];
        $remark = $data['js_note'] = $_POST['remark'];

        $file_name = $data['dist_code'] . '_' . $data['subdiv_code'] . '_' . $data['cir_code'] . '_' . $data['mouza_pargona_code'] . '_' . $data['lot_no'] . '_' . $data['vill_townprt_code'];

        if (is_dir(NC_VILLAGE_NOTIFICATION_DIR.$file_name) === false) {
            mkdir(NC_VILLAGE_NOTIFICATION_DIR.$file_name);
        }

        $this->db2->trans_begin();
        $data = array(
            'dist_code'=>$_POST['dist_code'],
            'subdiv_code'=>$_POST['subdiv_code'],
            'cir_code'=>$_POST['cir_code'],
            'mouza_pargona_code'=>$_POST['mouza_pargona_code'],
            'lot_no'=>$_POST['lot_no'],
            'vill_townprt_code'=>$_POST['vill_townprt_code'],
            'uuid'=>$_POST['uuid'],
            'application_no'=>$_POST['application_no'],
            'js_note'=>$_POST['remark'],
            'status'=>'Y',
            'js_verified' => 'Y',
            'user_code' => $this->session->userdata('user_code'),
            'js_verified_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $inserted = $this->db2->insert('nc_village_notification',$data);
        $insert_id = $this->db2->insert_id();

        $submitted = 'N';
        if($inserted == true)
        {
            $submitted = 'Y';
        }

        $images = array();
        foreach ($_FILES["notification"]["name"] as $key => $image) {
            $_FILES['images[]']['name']= $_FILES["notification"]["name"][$key];
            $mime = $_FILES['images[]']['type']= $_FILES["notification"]['type'][$key];
            $_FILES['images[]']['tmp_name']= $_FILES["notification"]['tmp_name'][$key];
            $_FILES['images[]']['error']= $_FILES["notification"]['error'][$key];
            $_FILES['images[]']['size']= $_FILES["notification"]['size'][$key];

            $path_parts = pathinfo($_FILES["notification"]["name"][$key]);
            $extension = $path_parts['extension'];

            $fileNameNew = $file_name.'_'.$key;

            $dir_path = NC_VILLAGE_NOTIFICATION_DIR. $file_name . '/' . $fileNameNew . '.'.$extension;

            $images[] = $fileNameNew;

            $config['upload_path']          = NC_VILLAGE_NOTIFICATION_DIR. $file_name;
            $config['allowed_types']        = 'pdf|jpeg|jpg|png';
            $config['max_size']             = MAP_PDF_SIZE;
            $config['overwrite']            = TRUE;
            $config['file_name']            = $fileNameNew. '.'.$extension;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
                $data = array(
                    'dist_code'=>$_POST['dist_code'],
                    'subdiv_code'=>$_POST['subdiv_code'],
                    'cir_code'=>$_POST['cir_code'],
                    'mouza_pargona_code'=>$_POST['mouza_pargona_code'],
                    'lot_no'=>$_POST['lot_no'],
                    'vill_townprt_code'=>$_POST['vill_townprt_code'],
                    'uuid'=>$_POST['uuid'],
                    'nc_village_no_id'=>$insert_id,
                    'notification_note'=> null,
                    'dir_path' =>$dir_path,
                    'extension' =>$extension,
                    'mime' =>$mime,
                    'user_code' => $this->session->userdata('user_code'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                $this->db2->insert('nc_village_notification_list',$data);
            } else {
                log_message("error", 'JS FILE UPLOAD FAIL #JS000011');
                $submitted = 'N';
                break;
            }

            if(!file_exists(NC_VILLAGE_NOTIFICATION_DIR. $file_name. '/' . $fileNameNew . '.'.$extension))
            {
                log_message("error", 'JS FILE UPLOAD FAIL #JS000012');
                delete_files(NC_VILLAGE_NOTIFICATION_DIR. $file_name, true);
                $this->db2->trans_rollback();
                echo json_encode(array('submitted' =>'N' , 'village'=>'', 'map_list'=>[], 'log'=> 'JS FILE UPLOAD FAIL #ADS000012'));
                break;
                return;
            }
        }

        $this->db->from('location');
        $this->db->where('uuid',$uuid);
        $this->db->select('*');
        $res =  $this->db->get();
        $village = $res->row_array();

        $this->db2->from('nc_village_notification');
        $this->db2->where('uuid',$uuid);
        $this->db2->select('js_verified,js_verified_at,js_note,id');
        $res2 =  $this->db2->get();
        $v_data = null;
        $village['js_verified'] = null;
        $village['js_verified_at'] = null;
        $village['js_note'] = null;
        $village['nc_village_no_id'] = null;
        if($res2->num_rows() != 0)
        {
            $v_data = $res2->row_array();
            $village['js_verified'] = $v_data['js_verified'];
            $village['js_verified_at'] = $v_data['js_verified_at'];
            $village['js_note'] = $v_data['js_note'];
            $village['nc_village_no_id'] = $v_data['id'];
        }

        $notification_list = array();
        if($submitted == 'N' || $this->db->trans_status() === FALSE)
        {
        	log_message("error", 'JS FILE UPLOAD FAIL #JS000014');
            delete_files(NC_VILLAGE_NOTIFICATION_DIR. $file_name, true);
            $this->db2->trans_rollback();
            echo json_encode(array('submitted' =>'N' , 'village'=>$village, 'notification_list'=>$notification_list));
            return;
        }
        $js_notificiation_api = $this->jsNotification($dist_code,$uuid,$remark);
        if($js_notificiation_api != 'Y')
        {
            log_message("error", 'JS FILE UPLOAD FAIL #JS000015');
            delete_files(NC_VILLAGE_NOTIFICATION_DIR. $file_name, true);
            $this->db2->trans_rollback();
            echo json_encode(array('submitted' =>'N' , 'village'=>$village, 'notification_list'=>$notification_list));
            return;
        }
        $this->db2->trans_commit();

        $this->db2->from('nc_village_notification_list');
        $this->db2->where('nc_village_no_id',$insert_id);
        $this->db2->select('id');
        $res1 =  $this->db2->get();
        $notification_list = $res1->result_array();
        echo json_encode(array('submitted' => 'Y', 'notification'=>$village, 'notification_list'=>$notification_list));
        return;
    }

    /** JS  village Notification */
    public function jsNotification($dist_code,$uuid,$remark)
    {
        $data['dist_code'] = $dist_code;
        $data['uuid'] = $uuid;
        $data['js_note'] = $remark;
        $data['user_code'] = $this->session->userdata('user_code');

        $url = API_LINK_NC_VILLAGE."apiJsNotification" ;
        $method = 'POST';

        $output = $this->NcVillageModel->callApi($url,$method, $data);

        if ($output->data==null)
        {
            return 'N';
        }

        return 'Y';
    }
}
