<?php
class NcDashboardController extends CI_Controller
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

    /* NC Village Dasboard */
    public function dashboard()
    {

        //Get NC Vilage Count
        $this->db = $this->load->database('auth', true);
        $uuids = $this->db->query("select uuid from location where status = '1'")->result_array();
        $ids = [];
        foreach ($uuids as $uuid) {
            $ids[] = ($uuid["uuid"]);
        }
        $field['uuids'] = $ids;
        $ur = API_LINK_NC_VILLAGE . "svamitvaDataEnteredVillagesCount";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $villagesCount = $this->NcVillageModel->callApiV2($ur, $method, $field);
        // $this->dd($villagesCount);

        //Get NC Vilage Dasboard Count (LM, CO & DC)
        $method = 'GET';

        $url = API_LINK_NC_VILLAGE . "apiGetNcDashboardCount";

        $error = "N";
        $output = $this->NcVillageModel->callApiV2($url, $method, []);
        if (!$output) {
            log_message("error", 'NC_DASH #NCD0001');
            $error = "Y";
        } else {
            $obj = json_decode($output)->data;
            $data = json_decode(json_encode($obj), true);
        }

        if (!$villagesCount) {
            log_message("error", 'NC_DASH #NCD00011');
            $error = "Y";
            $data["villCount"] = "0";
        } else {
            $data["villCount"] = json_decode($villagesCount)->data;
        }

        $url = API_LINK_NC_VILLAGE . "apiGetNcDistricts";
        $datum['type'] = "all";
        $method = 'POST';
        $error = "N";
        $output = $this->NcVillageModel->callApiV2($url, $method, $datum);
        if (!$output) {
            log_message("error", 'NC_DASH #NCD0004');
            $error = "Y";
            $data['districts'] = [];
        } else {
            $output = json_decode($output, true);
            $data['districts'] = $output['data']['districts'];
        }

        $data['_view'] = 'nc_village/dashboard/dashboard';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dasboard Total Villages*/
    public function villages()
    {

        //Get NC Villages
        $this->db = $this->load->database('auth', true);
        $uuids = $this->db->query("select uuid from location where status = '1'")->result_array();
        $ids = [];
        foreach ($uuids as $uuid) {
            $ids[] = ($uuid["uuid"]);
        }
        $field['uuids'] = $ids;
        $ur = API_LINK_NC_VILLAGE . "svamitvaDataEnteredVillages";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $villages = $this->NcVillageModel->callApi($ur, $method, $field);
        if ($villages->data == null) {
            log_message("error", 'NC_DASH #NCD0002');
            $data["villages"] = [];
        } else {
            $data["villages"] = $villages->data;
        }

        $data['_view'] = 'nc_village/dashboard/villages';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dasboard Total Villages*/
    public function getNcVillagesByStatus($type, $dist_code)
    {

        //Get NC Villages
        $ur = API_LINK_NC_VILLAGE . "getNcVillagesByStatus";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $field['type'] = $type;
        $field['dist_code'] = $dist_code;
        $data['dist_code'] = $dist_code;
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);
        $designation = ($this->session->userdata('designation'));
        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0003');
            $data["villages"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["villages"] = $output['data'];
        }
        $data["type"] = $type;
        $data["designation"] = $designation;

        $data['_view'] = 'nc_village/dashboard/ncVillages';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dasboard by Circle*/
    public function getNcCirclesByStatus($type, $dist_code)
    {

        //Get NC Villages
        $ur = API_LINK_NC_VILLAGE . "getNcCirclesByStatus";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $field['type'] = $type;
        $data['dist_code'] = $field['dist_code'] = $dist_code;
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);
        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0003');
            $data["circles"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["circles"] = $output['data'];
        }
        $data["type"] = $type;
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);

        $data['_view'] = 'nc_village/dashboard/ncCircles';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dasboard by Mouza*/
    public function getNcMouzasByStatus($type, $dist_code, $subdiv_code, $cir_code)
    {
        //Get NC Villages
        $ur = API_LINK_NC_VILLAGE . "getNcMouzasByStatus";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $field['type'] = $type;
        $data['dist_code'] = $field['dist_code'] = $dist_code;
        $data['subdiv_code'] = $field['subdiv_code'] = $subdiv_code;
        $data['cir_code'] = $field['cir_code'] = $cir_code;
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);
        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0003');
            $data["mouzas"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["mouzas"] = $output['data'];
        }
        $data["type"] = $type;
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);
        $data['_view'] = 'nc_village/dashboard/ncMouza';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dasboard by Lot*/
    public function getNcLotsByStatus($type, $dist_code, $subdiv_code, $cir_code, $mouza_pargona_code)
    {
        //Get NC Villages
        $ur = API_LINK_NC_VILLAGE . "getNcLotsByStatus";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $field['type'] = $type;
        $data['dist_code'] = $field['dist_code'] = $dist_code;
        $data['subdiv_code'] = $field['subdiv_code'] = $subdiv_code;
        $data['cir_code'] = $field['cir_code'] = $cir_code;
        $data['mouza_pargona_code'] = $field['mouza_pargona_code'] = $mouza_pargona_code;
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);
        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0003');
            $data["lots"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["lots"] = $output['data'];
        }
        $data["type"] = $type;
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);
        $data['_view'] = 'nc_village/dashboard/ncLots';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dasboard by Villages*/
    public function getNcLotVillagesByStatus($type, $dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $lot_no)
    {
        //Get NC Villages
        $ur = API_LINK_NC_VILLAGE . "getNcLotVillagesByStatus";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $field['type'] = $type;
        $data['dist_code'] = $field['dist_code'] = $dist_code;
        $data['subdiv_code'] = $field['subdiv_code'] = $subdiv_code;
        $data['cir_code'] = $field['cir_code'] = $cir_code;
        $data['mouza_pargona_code'] = $field['mouza_pargona_code'] = $mouza_pargona_code;
        $data['lot_no'] = $field['lot_no'] = $lot_no;
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);
        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0003');
            $data["villages"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["villages"] = $output['data'];
        }
        $data["type"] = $type;
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);
        $data['_view'] = 'nc_village/dashboard/ncLotVillages';
        $this->load->view('layouts/main', $data);
    }

    /* Die & Dump*/
    public function dd($data)
    {
        echo "<pre>" . var_export($data, true) . "<pre>";
        die();
    }

    /* NC Village LM, CO and DC Verification */
    public function districts($type)
    {
        $url = API_LINK_NC_VILLAGE . "apiGetNcDistricts";
        $data['type'] = $type;
        $method = 'POST';
        $error = "N";
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'NC_DASH #NCD0004');
            $error = "Y";
            $data['districts'] = [];
        } else {
            $output = json_decode($output, true);
            $data['districts'] = $output['data']['districts'];
        }
        $data['_view'] = 'nc_village/dashboard/districts';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dasboard Data Entered District Wise*/
    public function getDataEnteredDistrict()
    {
        //Get NC Villages
        $this->db = $this->load->database('auth', true);
        $uuids = $this->db->query("select * from location where status = ?", array('1'))->result_array();
        $ids = [];
        foreach ($uuids as $uuid) {
            $ids[] = ($uuid["uuid"]);
        }
        $field['uuids'] = $ids;
        $ur = API_LINK_NC_VILLAGE . "svamitvaDataEnteredData";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);

        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0005');
            $data["districts"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["districts"] = $output['data'];
        }

        $data['_view'] = 'nc_village/dashboard/deDistricts';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dasboard Data Entered Circle Wise*/
    public function getDataEnteredCircle($dist_code)
    {
        //Get NC Villages
        $this->db = $this->load->database('auth', true);
        $uuids = $this->db->query("select * from location where dist_code =? and status = ?", array($dist_code, '1'))->result_array();
        $ids = [];
        foreach ($uuids as $uuid) {
            $ids[] = ($uuid["uuid"]);
        }
        $field['uuids'] = $ids;
        $data['dist_code'] = $field['dist_code'] = $dist_code;

        $ur = API_LINK_NC_VILLAGE . "svamitvaDataEnteredCircle";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);

        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0005');
            $data["circles"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["circles"] = $output['data'];
        }
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);
        $data['_view'] = 'nc_village/dashboard/deCircles';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dasboard Data Entered Mouza Wise*/
    public function getDataEnteredMouza($dist_code, $subdiv_code, $cir_code)
    {
        //Get NC Villages
        $this->db = $this->load->database('auth', true);
        $uuids = $this->db->query("select * from location where dist_code =? and subdiv_code=? and cir_code=? and status = ?", array($dist_code, $subdiv_code, $cir_code, '1'))->result_array();
        $ids = [];
        foreach ($uuids as $uuid) {
            $ids[] = ($uuid["uuid"]);
        }
        $field['uuids'] = $ids;
        $data['dist_code'] = $field['dist_code'] = $dist_code;
        $data['cir_code'] = $field['cir_code'] = $cir_code;
        // $data['mouza_pargona_code'] = $field['mouza_pargona_code'] = $mouza_pargona_code;
        // $data['lot_no'] = $field['lot_no'] = $lot_no;
        $ur = API_LINK_NC_VILLAGE . "svamitvaDataEnteredMouza";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);

        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0005');
            $data["mouzas"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["mouzas"] = $output['data'];
        }
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);
        $data['_view'] = 'nc_village/dashboard/deMouzas';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dasboard Data Entered Lot Wise*/
    public function getDataEnteredLot($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code)
    {
        //Get NC Villages
        $this->db = $this->load->database('auth', true);
        $uuids = $this->db->query("select * from location where dist_code =? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status = ?", array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, '1'))->result_array();

        $ids = [];
        foreach ($uuids as $uuid) {
            $ids[] = ($uuid["uuid"]);
        }
        $field['uuids'] = $ids;
        $data['dist_code'] = $field['dist_code'] = $dist_code;
        $data['cir_code'] = $field['cir_code'] = $cir_code;
        $data['mouza_pargona_code'] = $field['mouza_pargona_code'] = $mouza_pargona_code;
        // $data['lot_no'] = $field['lot_no'] = $lot_no;
        $ur = API_LINK_NC_VILLAGE . "svamitvaDataEnteredLot";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);

        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0005');
            $data["lots"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["lots"] = $output['data'];
        }
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);
        $data['_view'] = 'nc_village/dashboard/deLots';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dasboard Data Entered Village Wise*/
    public function getDataEnteredVillage($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $lot_no)
    {
        //Get NC Villages
        $this->db = $this->load->database('auth', true);
        $uuids = $this->db->query("select * from location where dist_code =? and subdiv_code=? and cir_code=? and mouza_pargona_code=?and lot_no=? and status = ?", array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $lot_no, '1'))->result_array();
        $ids = [];
        foreach ($uuids as $uuid) {
            $ids[] = ($uuid["uuid"]);
        }
        $field['uuids'] = $ids;
        $data['dist_code'] = $field['dist_code'] = $dist_code;
        $data['cir_code'] = $field['cir_code'] = $cir_code;
        $data['mouza_pargona_code'] = $field['mouza_pargona_code'] = $mouza_pargona_code;
        $data['lot_no'] = $field['lot_no'] = $lot_no;
        $ur = API_LINK_NC_VILLAGE . "svamitvaDataEnteredVillageS";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);

        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0005');
            $data["villages"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["villages"] = $output['data'];
        }
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);
        $data['_view'] = 'nc_village/dashboard/deVillages';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dasboard Total Villages*/
    public function getNcVillagesByNCStatus($dist_code)
    {
        //Get NC Villages
        $ur = API_LINK_NC_VILLAGE . "getNcVillagesByNCStatus";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $data['dist_code'] = $field['dist_code'] = $dist_code;

        $villages = $this->NcVillageModel->callApi($ur, $method, $field);

        if ($villages->data == null) {
            log_message("error", 'NC_DASH #NCD0003');
            $data["villages"] = [];
        } else {
            $data["villages"] = $villages->data;
        }
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);

        $data['_view'] = 'nc_village/dashboard/ncDCVerifiedVillages';
        $this->load->view('layouts/main', $data);
    }

    /** View Villages district wise */
    public function dashboardDeptDistrictWise($type)
    {
        $url = API_LINK_NC_VILLAGE . "deptNcVillageDistricts";
        $method = 'POST';
        $error = "N";
        $data['type'] = $type;
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'NC_DEPT_VILL #NCD0001164');
            $error = "Y";
            $data['districts'] = [];
        } else {
            $output = json_decode($output, true);

            $data['districts'] = $output['data']['districts'];
        }
        $data['_view'] = 'nc_village/dashboard/dlr/district_wise';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dept Dashboard by Circle*/
    public function dashboardDeptCircle($type, $dist_code)
    {
        //Get NC Villages
        $ur = API_LINK_NC_VILLAGE . "getNcCirclesByStatus";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $field['type'] = $type;
        $data['dist_code'] = $field['dist_code'] = $dist_code;
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);
        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0003');
            $data["circles"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["circles"] = $output['data'];
        }
        $data["type"] = $type;
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);

        $data['_view'] = 'nc_village/dashboard/dlr/circle_wise';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dept Dashboard by Mouza*/
    public function dashboardDeptMouza($type, $dist_code, $subdiv_code, $cir_code)
    {
        //Get NC Villages
        $ur = API_LINK_NC_VILLAGE . "getNcMouzasByStatus";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $field['type'] = $type;
        $data['dist_code'] = $field['dist_code'] = $dist_code;
        $data['subdiv_code'] = $field['subdiv_code'] = $subdiv_code;
        $data['cir_code'] = $field['cir_code'] = $cir_code;
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);

        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0003');
            $data["mouzas"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["mouzas"] = $output['data'];
        }
        $data["type"] = $type;
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);
        $data['_view'] = 'nc_village/dashboard/dlr/mouza_wise';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Dept Dashboard by Lot*/
    public function dashboardDeptLot($type, $dist_code, $subdiv_code, $cir_code, $mouza_pargona_code)
    {
        //Get NC Villages
        $ur = API_LINK_NC_VILLAGE . "getNcLotsByStatus";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $field['type'] = $type;
        $data['dist_code'] = $field['dist_code'] = $dist_code;
        $data['subdiv_code'] = $field['subdiv_code'] = $subdiv_code;
        $data['cir_code'] = $field['cir_code'] = $cir_code;
        $data['mouza_pargona_code'] = $field['mouza_pargona_code'] = $mouza_pargona_code;
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);
        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0003');
            $data["lots"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["lots"] = $output['data'];
        }
        $data["type"] = $type;
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);
        $data['_view'] = 'nc_village/dashboard/dlr/lot_wise';
        $this->load->view('layouts/main', $data);
    }

    /* NC Village Deopt Dashboard by Villages*/
    public function dashboardDeptVill($type, $dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $lot_no)
    {
        //Get NC Villages
        $ur = API_LINK_NC_VILLAGE . "getNcLotVillagesByStatus";
        $method = 'POST';
        $field['api_key'] = "chitha_application";
        $field['type'] = $type;
        $data['dist_code'] = $field['dist_code'] = $dist_code;
        $data['subdiv_code'] = $field['subdiv_code'] = $subdiv_code;
        $data['cir_code'] = $field['cir_code'] = $cir_code;
        $data['mouza_pargona_code'] = $field['mouza_pargona_code'] = $mouza_pargona_code;
        $data['lot_no'] = $field['lot_no'] = $lot_no;
        $villages = $this->NcVillageModel->callApiV2($ur, $method, $field);
        if (!$villages) {
            log_message("error", 'NC_DASH #NCD0003');
            $data["villages"] = [];
        } else {
            $output = json_decode($villages, true);
            $data["villages"] = $output['data'];
        }
        $data["type"] = $type;
        $data["dist_name"] = $this->NcVillageModel->getDistrictName($dist_code);
        $data['_view'] = 'nc_village/dashboard/dlr/village';
        $this->load->view('layouts/main', $data);
    }

    /** View Dashboard Dept Vill list */
    public function dashboardDeptVillList($type,$dist_code)
    {
        $url = API_LINK_NC_VILLAGE . "deptNcVillList";
        $data['type'] = $type;
        $data['d'] = $dist_code;
        $method = 'POST';
        $error = "N";
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);

        if (!$output) {
            log_message("error", 'NC_DEPT_VILL #NCD0001104');
            $error = "Y";
            $data['proposal'] = [];
        } else {
            $output = json_decode($output, true);
            $data['location'] = $output['data']['loc_name']['dist'];
            $data['village'] = $output['data']['village'];
        }
        $data['_view'] = 'nc_village/dashboard/dlr/view_vill_dept';
        $this->load->view('layouts/main', $data);
    }

    /** view dc proposal */
    public function viewDcProposal($dist_code,$id)
    {
        $url = API_LINK_NC_VILLAGE . "viewDcProposal";
        $data['proposal_id'] = $id;
        $data['d'] = $dist_code;
        $method = 'POST';
        $error = "N";
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'NC_DEPT_VILL #NCD00011704');
            $error = "Y";
            echo "Please Contact System Admin.";return;
        } else {
            $output = json_decode($output, true);
            header('Content-type: application/pdf');
            echo base64_decode($output['proposal_pdf_base64']);
        }
    }

    /** view dlr proposal */
    public function viewDlrProposal($dist_code, $id)
    {
        $url = API_LINK_NC_VILLAGE . "viewDlrProposal";
        $data['proposal_id'] = $id;
        $data['d'] = $dist_code;
        $method = 'POST';
        $error = "N";
        $output = $this->NcVillageModel->callApiV2($url, $method, $data);
        if (!$output) {
            log_message("error", 'NC_DEPT_VILL #NCD000117604');
            $error = "Y";
            echo "Please Contact System Admin.";return;
        } else {
            $output = json_decode($output, true);
            $proposalpdfFilePath = NC_VILLAGE_NOTIFICATION_DIR . 'dlr' . '/' . $output['proposal_no'] . '.pdf';
            if (file_exists($proposalpdfFilePath)) {
                $proposalpdfData = file_get_contents($proposalpdfFilePath);
                header('Content-type: application/pdf');
                echo $proposalpdfData;
            }
            else
            {
                log_message("error", 'NC_DEPT_VILL #NCD0001175604');
                echo "Please Contact System Admin";
            }

        }
    }
}