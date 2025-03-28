<?php
class NcCommonController extends CI_Controller
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

    /** Get Map */
    public function apiGetMap()
    {
        $map = array();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['CONTENT_TYPE'])) {
            $contentType = $_SERVER['CONTENT_TYPE'];
            if (strcasecmp($contentType, 'application/x-www-form-urlencoded') === 0) {
                $dist_code = $this->input->post('d');
                $subdiv_code = $this->input->post('s');
                $cir_code = $this->input->post('c');
                $mouza_pargona_code = $this->input->post('m');
                $lot_no = $this->input->post('l');
                $vill_townprt_code = $this->input->post('v');

                $this->db = $this->load->database('db2', TRUE);

                $this->db->from('map_list');
                $this->db->where('dist_code', $dist_code);
                $this->db->where('subdiv_code', $subdiv_code);
                $this->db->where('cir_code', $cir_code);
                $this->db->where('mouza_pargona_code', $mouza_pargona_code);
                $this->db->where('lot_no', $lot_no);
                $this->db->where('vill_townprt_code', $vill_townprt_code);
                $this->db->select('id,dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,uuid,map_id,map_dir_path,map_note,mime,extension,created_at,updated_at,user_code,dc_user_code,dc_signed,dc_signed_at');
                $res =  $this->db->get();

                if ($res->num_rows() != 0) {
                    $map = $res->result_array();
                }

                $arr = array(
                    'data' => $map,
                    'status_code' => 200
                );
                echo json_encode($arr);
                return;
            } else {
                $arr = array(
                    'data' => $map,
                    'status_code' => 404
                );
                echo json_encode($arr);
                return;
            }
        } else {
            $arr = array(
                'data' => $map,
                'status_code' => 404
            );
            echo json_encode($arr);
            return;
        }
    }

    /** Get Map */
    public function apiGetMapBase64()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['CONTENT_TYPE'])) {
            $contentType = $_SERVER['CONTENT_TYPE'];
            if (strcasecmp($contentType, 'application/x-www-form-urlencoded') === 0) {
                $dist_code = $this->input->post('d');
                $id = $this->input->post('id');

                $this->db = $this->load->database('db2', TRUE);

                $this->db->from('map_list');
                $this->db->where('dist_code', $dist_code);
                $this->db->where('id', $id);
                $this->db->select('*');
                $res =  $this->db->get();
                $map = null;
                $base64 = null;
                if ($res->num_rows() != 0) {
                    $map = $res->row_array();
                    $base64 = base64_encode(file_get_contents($map['map_dir_path']));
                }

                $arr = array(
                    'data' => array(
                        'base64' => $base64,
                        'mime' => $map['mime'],
                        'map_dir_path' => $map['map_dir_path'] 
                    ),
                    'status_code' => 200,
                );
                echo json_encode($arr);
            } else {
                $arr = array(
                    'data' => array(
                        'base64' => null,
                        'mime' => null,
                    ),
                    'status_code' => 404
                );
                echo json_encode($arr);
            }
        } else {
            $arr = array(
                'data' => array(
                    'base64' => null,
                    'mime' => null,
                ),
                'status_code' => 404
            );
            echo json_encode($arr);
        }
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

    /** view uploaded Notification file */
    public function viewUploadedNotification()
    {
        $this->db2 = $this->load->database("db2", TRUE);
        $id = $this->input->get('id');

        $notification_list = $this->db2->query("SELECT dir_path,mime,extension FROM nc_village_notification_list WHERE id=?", array($id))->row();

        $mainfile = file_get_contents($notification_list->dir_path);
        header("Content-type:" . $notification_list->mime);
        echo $mainfile;
    }

    public function getUploadedMapBase()
    {
        $this->db2 = $this->load->database("db2", TRUE);
        $id = $this->input->get('id');

        $map = $this->db2->query("SELECT map_dir_path,mime,extension FROM map_list WHERE id=?", array($id))->row();

        $mainfile = file_get_contents($map->map_dir_path);
        header("Content-type:" . $map->mime);
        echo $mainfile;
    }

    /** Store DC Sign Map */
    public function storeSignedMap()
    {
        $this->db = $this->load->database("db2", TRUE);
        $sign_key = $this->input->post('sign_key');
        $pdfbase = $this->input->post('pdfbase');
        $id = $this->input->post('id');
        $pdf_content = base64_decode($pdfbase);

        $map = $this->db->query("SELECT map_dir_path,mime,extension,map_id,uuid FROM map_list WHERE id=?", array($id))->row();

        if ($pdfbase !== false) {

            $pdf_path = $map->map_dir_path;

            // Save the PDF content to the file
            if (file_put_contents($pdf_path, $pdf_content) !== false) {
                $this->db->trans_begin();
                $this->db->where('id', $map->map_id)
                    ->update('maps', array(
                        'flag' => 'D',
                        'updated_at' => date('Y-m-d H:i:s')
                    ));
                if ($this->db->affected_rows() != 1) {
                    log_message("error", 'NCDC MAPS UPDATE FAIL #NCDC00010');
                    $this->db->trans_rollback();
                    echo json_encode(array(
                        'status' => '1',
                        'update' => '0',
                        'msg' => 'Pdf signed successfully, But update failed.',
                    ));
                    return;
                }

                $this->db->where('id', $id)
                    ->update('map_list', array(
                        'dc_signed' => 'Y',
                        'sign_key' => $sign_key,
                        'dc_signed_at' => date('Y-m-d H:i:s')
                    ));
                $map_list = $this->db->query("select * from map_list where map_id='$map->map_id'")->result_array();
                if ($this->db->affected_rows() > 0) {
                    $this->db->trans_commit();
                    echo json_encode(array(
                        'status' => '1',
                        'update' => '1',
                        'msg' => 'Pdf signed successfully',
                        'map_list' => $map_list
                    ));
                    return;
                } else {
                    log_message("error", 'NCDC FILE UPLOAD FAIL #NCDC00002');
                    $this->db->trans_rollback();
                    echo json_encode(array(
                        'status' => '1',
                        'update' => '0',
                        'msg' => 'Pdf signed successfully, But update failed.',
                    ));
                    return;
                }
            } else {
                log_message("error", 'NCDC FILE UPLOAD FAIL #NCDC00001');
                echo json_encode(array(
                    'status' => '0',
                    'update' => '0',
                    'msg' => 'Failed Pdf uploading',
                ));
                return;
            }
        } else {
            log_message("error", 'NCDC FILE UPLOAD FAIL #NCDC00004');
            echo json_encode(array(
                'status' => '0',
                'update' => '0',
                'msg' => 'Invalid base64-encoded PDF content',
            ));
            return;
        }
    }

    /** Get Maps */
    public function apiGetMaps()
    {
        $maps = array();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['CONTENT_TYPE'])) {
            $contentType = $_SERVER['CONTENT_TYPE'];
            if (strcasecmp($contentType, 'application/x-www-form-urlencoded') === 0) {
                $dist_code = $this->input->post('d');
                $subdiv_code = $this->input->post('s');
                $cir_code = $this->input->post('c');
                $mouza_pargona_code = $this->input->post('m');
                $lot_no = $this->input->post('l');
                $vill_townprt_code = $this->input->post('v');
                $filter_flag_is = $this->input->post('filter_flag_is');
                $filter_flag_not = $this->input->post('filter_flag_not');
                $pending_co = $this->input->post('pending_co');
                $forwarded_co = $this->input->post('forwarded_co');
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
                if ($vill_townprt_code) {
                    $this->db->where('vill_townprt_code', $vill_townprt_code);
                }
                if ($filter_flag_is) {
                    $this->db->where('flag', $filter_flag_is);
                }
                if ($filter_flag_not) {
                    $this->db->where('flag !=', $filter_flag_not);
                }
                if ($pending_co) {
                    $this->db->where('flag', 'F');
                }
                if ($forwarded_co) {
                    $this->db->where_not_in('flag', ['A', 'F']);
                }
                $this->db->select('*');
                $maps = $this->db->get()->result();

                foreach ($maps as $map) {
                    $this->db->from('map_list');
                    $this->db->where('map_id', $map->id);
                    $this->db->select('*');
                    $map->map_lists =  $this->db->get()->result();

                    $to_be_merged_villages = [];
                    $merge_requests = $this->db->where('map_id', $map->id)->get('merge_village_requests')->result_array();
                    if(count($merge_requests)){
                        foreach($merge_requests as $merge_request){
                            $mer_village = $this->NcVillageModel->getLocations($merge_request['request_dist_code'], $merge_request['request_subdiv_code'], $merge_request['request_cir_code'], $merge_request['request_mouza_pargona_code'], $merge_request['request_lot_no'], $merge_request['request_vill_townprt_code']);
                            array_push($to_be_merged_villages, $mer_village ? $mer_village['village']['loc_name'] : '');
                        }
                    }
                    $map->has_merge_village_request =  count($merge_requests) ? true : false;
                    $map->requested_merged_villages_name =  implode(', ', $to_be_merged_villages);
                }

                $arr = array(
                    'data' => $maps ? $maps : [],
                    'status_code' => 200
                );
                echo json_encode($arr);
                return;
            } else {
                $arr = array(
                    'data' => $maps,
                    'status_code' => 404
                );
                echo json_encode($arr);
                return;
            }
        } else {
            $arr = array(
                'data' => $maps,
                'status_code' => 404
            );
            echo json_encode($arr);
            return;
        }
    }

    /** Get Merge Village Requests */
    public function apiGetMergeVillageRequests(){
        $this->db = $this->load->database('auth', TRUE);
        $this->db2 = $this->load->database("db2", TRUE);
        $map_id = $this->input->post('map_id');
        if(empty($map_id)){
            echo json_encode([
                    'data' => [],
                    'message' => 'Map id is required',
                    'status_code' => 404
                ]);
            return;
        }
        $merge_village_requests = $this->db2->where('map_id', $map_id)->get('merge_village_requests')->result_array();
        if(count($merge_village_requests)){
            foreach($merge_village_requests as $key => $merge_village_request){
                $merge_village_requests[$key]['vill_loc'] = $this->NcVillageModel->getLocations($merge_village_request['request_dist_code'], $merge_village_request['request_subdiv_code'], $merge_village_request['request_cir_code'], $merge_village_request['request_mouza_pargona_code'], $merge_village_request['request_lot_no'], $merge_village_request['request_vill_townprt_code']);
            }
        }

        echo json_encode([
                'data' => $merge_village_requests,
                'status_code' => 200
            ]);
        return;
    }
    /** Get Maps Count */
    public function apiGetMapsCount()
    {
        $maps_count = 0;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['CONTENT_TYPE'])) {
            $contentType = $_SERVER['CONTENT_TYPE'];
            if (strcasecmp($contentType, 'application/x-www-form-urlencoded') === 0) {
                $dist_code = $this->input->post('d');
                $subdiv_code = $this->input->post('s');
                $cir_code = $this->input->post('c');
                $mouza_pargona_code = $this->input->post('m');
                $lot_no = $this->input->post('l');
                $vill_townprt_code = $this->input->post('v');
                $filter_flag_is = $this->input->post('filter_flag_is');
                $filter_flag_not = $this->input->post('filter_flag_not');

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
                if ($vill_townprt_code) {
                    $this->db->where('vill_townprt_code', $vill_townprt_code);
                }
                if ($filter_flag_is) {
                    $this->db->where('flag', $filter_flag_is);
                }
                if ($filter_flag_not) {
                    $this->db->where('flag !=', $filter_flag_not);
                }
                $maps_count = $this->db->get()->num_rows();

                $arr = array(
                    'data' => $maps_count,
                    'status_code' => 200
                );
                echo json_encode($arr);
                return;
            } else {
                $arr = array(
                    'data' => $maps_count,
                    'status_code' => 404
                );
                echo json_encode($arr);
                return;
            }
        } else {
            $arr = array(
                'data' => $maps_count,
                'status_code' => 404
            );
            echo json_encode($arr);
            return;
        }
    }
    //update flag
    public function updateFlag()
    {
        $this->db = $this->load->database("db2", TRUE);
        $flag = $this->input->post('flag');
        $map_id = $this->input->post('map_id');
        $co_user_code = $this->input->post('co_user_code');

        if ($flag && $map_id) {
            $this->db->where('id', $map_id)
                ->update('maps', array(
                    'flag' => $flag,
                    'co_user_code' => $co_user_code,
                    'co_verified_at' => date('Y-m-d H:i:s'),
                ));
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array(
                    'status' => '1',
                ));
                return;
            } else {
                log_message("error", 'MAP FLAG UPDATE FAIL #NCCO00001');
                echo json_encode(array(
                    'status' => '0',
                ));
                return;
            }
        } else {
            log_message("error", 'MAP FLAG UPDATE FAIL #NCCO00001');
            echo json_encode(array(
                'status' => '0',
            ));
            return;
        }
    }


    public function subDivDetails()
    {
        $this->db = $this->load->database('auth', TRUE);
        $data = [];
        $dist_code = $this->input->post('dis');
        $formdata = $this->NcVillageModel->subDivdetails($dist_code);
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

    /** view proposal file */
    public function viewProposal()
    {
        $name = $this->input->get('id');
        $mainfile = file_get_contents(NC_VILLAGE_NOTIFICATION_DIR . 'dlr/' . $name . '.pdf');
        header("Content-type:application/pdf");
        echo $mainfile;
    }

    /** Test M pdf */
    public function testMpdf()
    {
        if (file_exists('vendor/mpdf/vendor/autoload.php')) {
            echo "True";
        } else {
            echo "false";
        }
    }

    /** view notification file */
    public function viewNotification()
    {
        $url = API_LINK_NC_VILLAGE . "generateNcVillNotification";
        $method = 'POST';
        //        $data['proposal_id'] = $this->input->post('proposal_id');;
        //        $data['note'] = $this->input->post('note');;
        //        $data['dist_code'] = $this->input->post('dist_code');;
        //        $data['user_code'] = $this->session->userdata('user_code');;
        //        $data['user'] = 'section_officer';
        $output = $this->NcVillageModel->callApiV2($url, $method, $data = array());
        if (!$output) {
            log_message("error", 'DEPT_NOTIFICATION_API FAIL NcCommonController #NOTIFIO000001');
            echo "API FAIL";
            return;
        }
        echo json_encode(array(
            'data' => $output,
            'status' => '1',
        ));
    }

    /** view Sign Notification file */
    public function viewSignNotification($name)
    {
        $mainfile = file_get_contents(NC_VILLAGE_NOTIFICATION_DIR . 'ps/' . $name . '.pdf');
        header("Content-type:application/pdf");
        echo $mainfile;
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
            log_message("error", 'NcCommonController #COM0001');
            echo "API FAIL";
            return;
        }
        $output = json_decode($output);
        $data['locations'] = $output->locations;
        $data['nc_village'] = $output->nc_village;

        $data['_view'] = 'nc_village/common/villages';
        $this->load->view('layouts/main', $data);
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

        if (!$output) {
            log_message("error", 'NcCommonController #COM0002');
            echo "Data Not Found.";
            return;
        }
        $output = json_decode($output);

        $data['locations'] = $output->locations;
        $data['nc_village'] = $nc_village = $output->nc_village;
        $data['merge_village_requests'] = json_decode(json_encode($nc_village->merge_village_requests), true);
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

    /** get Dags details */
    public function getDags()
    {
        $data['d'] = $_POST['dist_code'];
        $data['application_no'] = $_POST['application_no'];

        $url = API_LINK_NC_VILLAGE . "apiGetDags";
        $method = 'POST';

        $output = $this->NcVillageModel->callApi($url, $method, $data);

        if ($output == null) {
            log_message("error", 'DLR_GET_DAG #DLR0002');
            echo json_encode(array('success' => 'N'));
            return;
        }

        echo json_encode(array('success' => 'Y', 'dags' => $output->data->dags, 'dc_name' => $output->data->dc, 'change_vill' => $output->data->change_vill));
        return;
    }

    public function getNotificationPdfJsSignPreview($notification_no)
    {
        $pdfFilePath = NC_VILLAGE_NOTIFICATION_DIR . 'ps' . '/' . $notification_no . '.pdf';
        header("Content-Type: application/pdf");
        echo (file_get_contents($pdfFilePath));
        return;
    }
    public function getNotificationPdfJsSignBase64()
    {
        $notification_no = $this->input->post('notification_no');
        $pdfFilePath = NC_VILLAGE_NOTIFICATION_DIR . 'ps' . '/' . $notification_no . '.pdf';
        header("Content-Type: application/pdf");
        echo json_encode(base64_encode(file_get_contents($pdfFilePath)));
        return;
    }
    /** view Sign Notification file */
    public function viewJsSignedNotification($name)
    {
        $mainfile = file_get_contents(NC_VILLAGE_NOTIFICATION_DIR . 'joint_sec/' . $name . '.pdf');
        header("Content-type:application/pdf");
        echo $mainfile;
    }

    /** Get Notifications */
    public function apiGetNotifications()
    {
        $this->db = $this->load->database('db2', TRUE);
        $data = json_decode(file_get_contents('php://input', true));
        $this->db->select('dist_code,proposal_no,proposal_id,
        status,created_at,asst_section_officer_verified,
        section_officer_verified,
        joint_secretary_verified,
        secretary_verified,
        ps_verified,
        minister_verified,
        ps_sign,
        notification_no,
        js_sign');
        foreach($data->filters as $filter){
            $this->db->where($filter,'Y');
        }
        $this->db->from('nc_village_gen_notification');
        $notifications =  $this->db->get()->result();

        echo json_encode(['notifications' => $notifications]);
    }
    /** Get Notifications */
    public function apiGetDistrictNotifications()
    {
        $this->db = $this->load->database('db2', TRUE);
        $data = json_decode(file_get_contents('php://input', true));
        $this->db->select('dist_code,proposal_no,proposal_id,
        status,created_at,asst_section_officer_verified,
        section_officer_verified,
        joint_secretary_verified,
        secretary_verified,
        ps_verified,
        minister_verified,
        ps_sign,
        notification_no,
        js_sign');
        $this->db->where('dist_code',$data->dist_code);
        $this->db->from('nc_village_gen_notification');
        $notifications =  $this->db->get()->result();

        echo json_encode(['notifications' => $notifications]);
    }
    

    ///25/09/2024///udipta
    /** SHOW ALL PROPOSALs */
    public function trackProposals()
    {
        $data['_view'] = 'nc_village/common/track_proposals';
        $this->load->view('layouts/main', $data);
    }
}


