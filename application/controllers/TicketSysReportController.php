<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TicketSysReportController extends MY_CONTROLLER
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->library('form_validation');
        $this->load->model('TicketSysCommonModel');
        $this->load->model('TicketNicDevModel');
        $this->load->model('TicketNicManModel');
        $this->load->model('TicketSysReportModel');

    }




    public function checkUserPermissionTechTicketAdlr()
    {
        $userDesignation = $this->session->userData('designation');
        if($userDesignation != TICKET_SYSTEM_ADLR)
        {
            $this->session->set_flashdata('error',"You are not Authorized ! ");
            redirect( base_url().'dashboard');
        }
    }

    private function UUID4()
    {
        $bytes = random_bytes(16);
        $bytes[6] = chr(ord($bytes[6]) & 0x0f | 0x40);
        $bytes[8] = chr(ord($bytes[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
    }

    // decode for showing file
    public function decodeBase64($encoded_string)
    {
        $file_data = base64_decode($encoded_string);
        $file = finfo_open();
        $mime_type = finfo_buffer($file, $file_data, FILEINFO_MIME_TYPE);
        $file_type = explode('/', $mime_type)[0];
        $extension = explode('/', $mime_type)[1];
        log_message("error", "No error occured" . json_encode($mime_type));
        return $mime_type;
    }


    // get dashboard  for ADLR
    public function getDashboardForAdlr()
    {
        $this->checkUserPermissionTechTicketAdlr();

        $allService   = $this->TicketSysCommonModel->getAllServiceTypeWithOutStatus();
        $serviceArray = [];
        foreach ($allService as $key=> $service)
        {
            $serviceArray[$key]['id']               = $service->id;
            $serviceArray[$key]['app_id']           = $service->app_id;
            $serviceArray[$key]['application_name'] = $service->application_name;
            $serviceArray[$key]['service_name']     = $service->service_name;
            $serviceArray[$key]['count']            = $this->TicketSysReportModel->countTicketServiceWise($service->app_id,$service->id);
        }

        $data['services']        = $serviceArray;
        $data['allCount']        = $this->TicketSysReportModel->countAllTicketForReport();
        $data['inQueueCount']    = $this->TicketSysReportModel->countAllInQueueTicketForReport();
        $data['closedCount']     = $this->TicketSysReportModel->countAllClosedTicketForReport();
        $data['rejectedCount']   = $this->TicketSysReportModel->countAllRejectedTicketForReport();
        $data['pendingCount']    = $this->TicketSysReportModel->countAllPendingTicketForReport();
        $data['processingCount'] = $this->TicketSysReportModel->countAllProcessingTicketForReport();

        $data['_view'] = 'Ticket_System/Adlr/dashboard_adlr';
        $this->load->view('layouts/main', $data);
    }


    // get all register ticket
    public function getAllRegisterTicketForReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $data['_view'] = 'Ticket_System/Adlr/all_register_ticket_adlr';
        $this->load->view('layouts/main', $data);
    }

    // ajax for pagination ( all Register )
    public function ajaxAllRegisterTicketForReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $json     = null;
        $draw     = intval($this->input->post('draw'));
        $start    = intval($this->input->post('start'));
        $length   = intval($this->input->post('length'));
        $order    = $this->input->post('order');
        $case_no  = $this->input->post('case_no');
        $status   = $this->input->post('status');
        $sub_date = $this->input->post('sub_date');

        $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

        $this->db = $this->load->database('ticket_sys', TRUE);

        $col = 0;
        $dir = "";
        if(!empty($order)){
            foreach($order as $o){
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if($dir != "asc" && $dir != 'desc'){
            $dir = 'asc';
        }
        $valid_columns = array(
            0   => 'technical_ticket_details.created_at',
        );
        if(!isset($valid_columns[$col])){
            $order = 'technical_ticket_details.created_at';
        } else {
            $order = $valid_columns[$col];
        }
        if($order != null){

            $this->db->order_by($order, $dir);
        }
        if(!empty($case_no))
        {
            $this->db->where('technical_ticket_details.t_unicode', $case_no);
        }
        if(!empty($status))
        {
            $this->db->where('technical_ticket_details.ticket_status', $status);
        }
        if(!empty($sub_date))
        {
            $this->db->where('DATE(technical_ticket_details.created_at)',date('Y-m-d', strtotime($sub_date)));
        }

        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.status',1);
        $this->db->order_by('technical_ticket_details.id','asc');
        $this->db->limit($length, $start);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            $result = $query->result();
            $i=1;

            if(!empty($by_case_no))
            {
                $this->db->where('technical_ticket_details.t_unicode', $by_case_no);
            }

            $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
            $this->db->from('technical_ticket_details');
            $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
            $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
            $this->db->where('technical_ticket_details.status',1);
            $this->db->order_by('technical_ticket_details.id','asc');
            $query1 = $this->db->get();
            $total_records = $query1->num_rows();

            foreach($result as $rows)
            {
                if($rows->ticket_status == TICKET_STATUS_PENDING){
                    $status = '<span style="color:#455A64; font-weight: bold "> Pending </span>';
                }
                elseif($rows->ticket_status == TICKET_STATUS_CLOSED){
                    $status = '<span style="color: #4CAF50; font-weight: bold"> Closed </span>';
                }
                elseif($rows->ticket_status == TICKET_STATUS_REJECTED){
                    $status = '<span style="color: #F44336; font-weight: bold"> Rejected </span>';
                }
                else{
                    $status = 'Unknown';
                }

                $json[] = array(
                    $i,
                    $rows->application_name,
                    $rows->service_name,
                    $rows->t_unicode,
                    date("d-m-Y", strtotime($rows->created_at)),
                    $status,
                    '<a class="rezaButt buttInfo" href="'.base_url().'index.php/TicketSysReportController/getTicketDetailsForReport/?app='.$rows->ticket_id.'">
                    <i class="fa fa-eye"></i>  View </a>',

                );

                $i++;
            }

            $response = array(
                'draw' => $draw,
                'recordsTotal' => $total_records,
                'recordsFiltered' => $total_records,
                'data' => $json,
            );
            echo json_encode($response);
        }
        else {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }


    // get all closed ticket
    public function getAllClosedTicketForReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $data['title']    = 'Closed';
        $data['tStatus']  = TICKET_STATUS_CLOSED;
        $data['tProcess'] = 2;

        $data['_view'] = 'Ticket_System/Adlr/all_ticket_with_status_adlr';
        $this->load->view('layouts/main', $data);
    }

    // get all Rejected ticket
    public function getAllRejectedTicketForReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $data['title']    = 'Rejected';
        $data['tStatus']  = TICKET_STATUS_REJECTED;
        $data['tProcess'] = 0;

        $data['_view'] = 'Ticket_System/Adlr/all_ticket_with_status_adlr';
        $this->load->view('layouts/main', $data);
    }

    // get all InQueue ticket
    public function getAllInQueueTicketForReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $data['title']    = 'In Queue';
        $data['tStatus']  = TICKET_STATUS_PENDING;
        $data['tProcess'] = 1;

        $data['_view'] = 'Ticket_System/Adlr/all_ticket_with_status_adlr';
        $this->load->view('layouts/main', $data);
    }

    // get all UnderProcessing ticket
    public function getAllUnderProcessingTicketForReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $data['title']    = 'Under Processing';
        $data['tStatus']  = TICKET_STATUS_PENDING;
        $data['tProcess'] = 2;

        $data['_view'] = 'Ticket_System/Adlr/all_ticket_with_status_adlr';
        $this->load->view('layouts/main', $data);
    }

    // get all pending ticket
    public function getAllPendingTicketForReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $data['title']    = 'Pending';
        $data['tStatus']  = TICKET_STATUS_PENDING;
        $data['tProcess'] = 0;

        $data['_view'] = 'Ticket_System/Adlr/all_ticket_with_status_adlr';
        $this->load->view('layouts/main', $data);
    }

    // ajax for pagination with status
    public function ajaxAllTicketWithStatusForReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $json     = null;
        $draw     = intval($this->input->post('draw'));
        $start    = intval($this->input->post('start'));
        $length   = intval($this->input->post('length'));
        $order    = $this->input->post('order');
        $case_no  = $this->input->post('case_no');
        $tStatus  = $this->input->post('tStatus');
        $tProcess = $this->input->post('tProcess');
        $sub_date = $this->input->post('sub_date');

        $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

        $this->db = $this->load->database('ticket_sys', TRUE);

        $col = 0;
        $dir = "";
        if(!empty($order)){
            foreach($order as $o){
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if($dir != "asc" && $dir != 'desc'){
            $dir = 'asc';
        }
        $valid_columns = array(
            0   => 'technical_ticket_details.created_at',
        );
        if(!isset($valid_columns[$col])){
            $order = 'technical_ticket_details.created_at';
        } else {
            $order = $valid_columns[$col];
        }
        if($order != null){

            $this->db->order_by($order, $dir);
        }
        if(!empty($case_no))
        {
            $this->db->where('technical_ticket_details.t_unicode', $case_no);
        }
        if(!empty($sub_date))
        {
            $this->db->where('DATE(technical_ticket_details.created_at)',date('Y-m-d', strtotime($sub_date)));
        }

        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.status',1);
        $this->db->where('technical_ticket_details.ticket_status',$tStatus);
        $this->db->where('technical_ticket_details.a_status',$tProcess);
        $this->db->order_by('technical_ticket_details.id','asc');
        $this->db->limit($length, $start);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            $result = $query->result();
            $i=1;

            if(!empty($by_case_no))
            {
                $this->db->where('technical_ticket_details.t_unicode', $by_case_no);
            }

            $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
            $this->db->from('technical_ticket_details');
            $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
            $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
            $this->db->where('technical_ticket_details.status',1);
            $this->db->where('technical_ticket_details.ticket_status',$tStatus);
            $this->db->where('technical_ticket_details.a_status',$tProcess);
            $this->db->order_by('technical_ticket_details.id','asc');
            $query1 = $this->db->get();
            $total_records = $query1->num_rows();

            foreach($result as $rows)
            {
                if($rows->ticket_status == TICKET_STATUS_PENDING){
                    $status = '<span style="color:#455A64; font-weight: bold "> Pending </span>';
                }
                elseif($rows->ticket_status == TICKET_STATUS_CLOSED){
                    $status = '<span style="color: #4CAF50; font-weight: bold"> Closed </span>';
                }
                elseif($rows->ticket_status == TICKET_STATUS_REJECTED){
                    $status = '<span style="color: #F44336; font-weight: bold"> Rejected </span>';
                }
                else{
                    $status = 'Unknown';
                }

                $json[] = array(
                    $i,
                    $rows->application_name,
                    $rows->service_name,
                    $rows->t_unicode,
                    date("d-m-Y", strtotime($rows->created_at)),
                    $status,
                    '<a class="rezaButt buttInfo" href="'.base_url().'index.php/TicketSysReportController/getTicketDetailsForReport/?app='.$rows->ticket_id.'">
                    <i class="fa fa-eye"></i>  View </a>',

                );

                $i++;
            }

            $response = array(
                'draw' => $draw,
                'recordsTotal' => $total_records,
                'recordsFiltered' => $total_records,
                'data' => $json,
            );
            echo json_encode($response);
        }
        else {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }


    // get ticket with service Type Wise
    public function getTicketServiceTypeWise()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $serviceId = $this->input->get('service');
        $appQuery  = $this->TicketSysCommonModel->getServiceTypeDetailsWithId($serviceId);
        if($appQuery->num_rows() != 1)
        {
            $this->session->set_flashdata('error',"Data not found !");
            redirect( base_url().'ticket-dashboard-for-adlr');
        }
        $services = $appQuery->row();

        $data['serviceName'] = $services->service_name;
        $data['appName']     = $services->application_name;
        $data['serviceId']   = $serviceId;

        $data['_view'] = 'Ticket_System/Adlr/all_ticket_bt_service_adlr';
        $this->load->view('layouts/main', $data);
    }

    // ajax for pagination service Type Wise
    public function ajaxAllTicketByServiceForReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $json      = null;
        $draw      = intval($this->input->post('draw'));
        $start     = intval($this->input->post('start'));
        $length    = intval($this->input->post('length'));
        $order     = $this->input->post('order');
        $case_no   = $this->input->post('case_no');
        $tStatus   = $this->input->post('tStatus');
        $tProcess  = $this->input->post('tProcess');
        $sub_date  = $this->input->post('sub_date');
        $status    = $this->input->post('status');
        $serviceId = $this->input->post('serviceId');

        $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

        $this->db = $this->load->database('ticket_sys', TRUE);

        $col = 0;
        $dir = "";
        if(!empty($order)){
            foreach($order as $o){
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if($dir != "asc" && $dir != 'desc'){
            $dir = 'asc';
        }
        $valid_columns = array(
            0   => 'technical_ticket_details.created_at',
        );
        if(!isset($valid_columns[$col])){
            $order = 'technical_ticket_details.created_at';
        } else {
            $order = $valid_columns[$col];
        }
        if($order != null){

            $this->db->order_by($order, $dir);
        }
        if(!empty($case_no))
        {
            $this->db->where('technical_ticket_details.t_unicode', $case_no);
        }
        if(!empty($sub_date))
        {
            $this->db->where('DATE(technical_ticket_details.created_at)',date('Y-m-d', strtotime($sub_date)));
        }
        if(!empty($status))
        {
            $this->db->where('technical_ticket_details.ticket_status', $status);
        }

        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.status',1);
        $this->db->where('technical_ticket_details.t_service_id',$serviceId);
        $this->db->order_by('technical_ticket_details.id','asc');
        $this->db->limit($length, $start);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            $result = $query->result();
            $i=1;

            if(!empty($by_case_no))
            {
                $this->db->where('technical_ticket_details.t_unicode', $by_case_no);
            }

            $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
            $this->db->from('technical_ticket_details');
            $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
            $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
            $this->db->where('technical_ticket_details.status',1);
            $this->db->where('technical_ticket_details.t_service_id',$serviceId);
            $this->db->order_by('technical_ticket_details.id','asc');
            $query1 = $this->db->get();
            $total_records = $query1->num_rows();

            foreach($result as $rows)
            {
                if($rows->ticket_status == TICKET_STATUS_PENDING){
                    $status = '<span style="color:#455A64; font-weight: bold "> Pending </span>';
                }
                elseif($rows->ticket_status == TICKET_STATUS_CLOSED){
                    $status = '<span style="color: #4CAF50; font-weight: bold"> Closed </span>';
                }
                elseif($rows->ticket_status == TICKET_STATUS_REJECTED){
                    $status = '<span style="color: #F44336; font-weight: bold"> Rejected </span>';
                }
                else{
                    $status = 'Unknown';
                }

                $json[] = array(
                    $i,
                    $rows->application_name,
                    $rows->service_name,
                    $rows->t_unicode,
                    date("d-m-Y", strtotime($rows->created_at)),
                    $status,
                    '<a class="rezaButt buttInfo" href="'.base_url().'index.php/TicketSysReportController/getTicketDetailsForReport/?app='.$rows->ticket_id.'">
                    <i class="fa fa-eye"></i>  View </a>',

                );

                $i++;
            }

            $response = array(
                'draw' => $draw,
                'recordsTotal' => $total_records,
                'recordsFiltered' => $total_records,
                'data' => $json,
            );
            echo json_encode($response);
        }
        else {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }



    // search ticket
    public function searchTicketForAdlr()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $application = $this->TicketSysCommonModel->getAllApplication();
        $service     = $this->TicketSysCommonModel->getAllServiceTypeWithOutStatus();

        $data['applications'] = $application;
        $data['services']     = $service;

        $data['_view'] = 'Ticket_System/Adlr/search_ticket_adlr';
        $this->load->view('layouts/main', $data);
    }

    // ajax for search
    public function ajaxSearchTicketForReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $json      = null;
        $draw      = intval($this->input->post('draw'));
        $start     = intval($this->input->post('start'));
        $length    = intval($this->input->post('length'));
        $order     = $this->input->post('order');

        $case_no     = $this->input->post('ticketName');
        $tStatus     = $this->input->post('ticketStatus');
        $dateFrom    = $this->input->post('dateFrom');
        $dateTo      = $this->input->post('dateTo');
        $application = $this->input->post('application');
        $serviceId   = $this->input->post('serviceType');
        $dist_code   = $this->input->post('dist_code');
        $sub_cir     = $this->input->post('cir_code');

        $sub_code = '';
        $cir_code = '';
        if(!empty($sub_cir))
        {
            $code = explode("_", $sub_cir);
            $sub_code = $code[1];
            $cir_code = $code[0];
        }


        $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

        $this->db = $this->load->database('ticket_sys', TRUE);

        $col = 0;
        $dir = "";
        if(!empty($order)){
            foreach($order as $o){
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if($dir != "asc" && $dir != 'desc'){
            $dir = 'asc';
        }
        $valid_columns = array(
            0   => 'technical_ticket_details.created_at',
        );
        if(!isset($valid_columns[$col])){
            $order = 'technical_ticket_details.created_at';
        } else {
            $order = $valid_columns[$col];
        }
        if($order != null){

            $this->db->order_by($order, $dir);
        }
        if(!empty($case_no))
        {
            $this->db->where('technical_ticket_details.t_unicode', $case_no);
        }
        if(!empty($tStatus))
        {
            $this->db->where('technical_ticket_details.ticket_status', $tStatus);
        }
        if(!empty($application))
        {
            $this->db->where('technical_ticket_details.t_app_type_id',$application);
        }
        if(!empty($serviceId))
        {
            $this->db->where('technical_ticket_details.t_service_id',$serviceId);
        }
        if(!empty($dist_code))
        {
            $this->db->where('technical_ticket_details.dist_code',$dist_code);
        }
        if(!empty($cir_code))
        {
            $this->db->where('technical_ticket_details.subdiv_code',$sub_code);
            $this->db->where('technical_ticket_details.cir_code',$cir_code);
        }

        if(empty($dateTo))
        {
            if(!empty($dateFrom))
            {
                $this->db->where('DATE(technical_ticket_details.created_at)',date('Y-m-d', strtotime($dateFrom)));
            }
        }

        if(empty($dateFrom))
        {
            if(!empty($dateTo))
            {
                $this->db->where('DATE(technical_ticket_details.created_at)',date('Y-m-d', strtotime($dateTo)));
            }
        }
        if($dateFrom !='' && $dateTo !='')
        {
            $this->db->where('DATE(technical_ticket_details.created_at) >=', date('Y-m-d',strtotime($dateFrom)));
            $this->db->where('DATE(technical_ticket_details.created_at) <=', date('Y-m-d',strtotime($dateTo)));
        }


        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.status',1);
        $this->db->order_by('technical_ticket_details.id','asc');
        $this->db->limit($length, $start);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            $result = $query->result();
            $i=1;

            if(!empty($by_case_no))
            {
                $this->db->where('technical_ticket_details.t_unicode', $by_case_no);
            }

            $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
            $this->db->from('technical_ticket_details');
            $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
            $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
            $this->db->where('technical_ticket_details.status',1);
            $this->db->order_by('technical_ticket_details.id','asc');
            $query1 = $this->db->get();
            $total_records = $query1->num_rows();

            foreach($result as $rows)
            {
                if($rows->ticket_status == TICKET_STATUS_PENDING){
                    $status = '<span style="color:#455A64; font-weight: bold "> Pending </span>';
                }
                elseif($rows->ticket_status == TICKET_STATUS_CLOSED){
                    $status = '<span style="color: #4CAF50; font-weight: bold"> Closed </span>';
                }
                elseif($rows->ticket_status == TICKET_STATUS_REJECTED){
                    $status = '<span style="color: #F44336; font-weight: bold"> Rejected </span>';
                }
                else{
                    $status = 'Unknown';
                }

                $json[] = array(
                    $i,
                    $rows->application_name,
                    $rows->service_name,
                    $rows->t_unicode,
                    date("d-m-Y", strtotime($rows->created_at)),
                    $status,
                    '<a class="rezaButt buttInfo" href="'.base_url().'index.php/TicketSysReportController/getTicketDetailsForReport/?app='.$rows->ticket_id.'">
                    <i class="fa fa-eye"></i>  View </a>',

                );

                $i++;
            }

            $response = array(
                'draw' => $draw,
                'recordsTotal' => $total_records,
                'recordsFiltered' => $total_records,
                'data' => $json,
            );
            echo json_encode($response);
        }
        else {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }




    // get all circle by district
    public function getCircleJson($distcode)
    {
        $this->checkUserPermissionTechTicketAdlr();
        $data = $this->TicketSysReportModel->getCircleByDistJSON($distcode);

        $json = array();
        foreach ($data as $object) {
            $json[] = array('loc_name' => $object->loc_name, 'cir_code' => $object->cir_code, 'subdiv_code' => $object->subdiv_code);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }



    // view ticket details
    public function getTicketDetailsForReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $tId = $this->input->get('app');

        if($this->TicketNicManModel->countTicketDetailsById($tId) != 1)
        {
            $this->session->set_flashdata('errorM', "Ticket details not found !");
            redirect(base_url().'ticket-dashboard-for-adlr');
        }

        $ticketDetails       = $this->TicketNicManModel->getTicketDetailsById($tId);
        $data['ticket']      = $ticketDetails;
        $data['histories']   = $this->TicketNicManModel->getTicketHistoryById($tId);
        $data['attachments'] = $this->TicketNicManModel->getTicketDocumentById($tId);
        $data['comments']    = $this->TicketNicManModel->getTicketCommentById($tId);
        $data['locations']   = '';

        $districtName    = '';
        $subDivisionName = '';
        $circleName      = '';
        if($ticketDetails->dist_code != '')
        {
            $districtName = $this->utilclass->getDistrictName($ticketDetails->dist_code);
        }
        if($ticketDetails->subdiv_code != '')
        {
            $subDivisionName = $this->utilclass->getSubDivName($ticketDetails->dist_code, $ticketDetails->subdiv_code);
        }
        if($ticketDetails->cir_code != '')
        {
            $circleName = $this->utilclass->getCircleName($ticketDetails->dist_code, $ticketDetails->subdiv_code, $ticketDetails->cir_code);
        }

        $data['districtName']    = $districtName;
        $data['subDivisionName'] = $subDivisionName;
        $data['circleName']      = $circleName;

        $data['_view'] = 'Ticket_System/Adlr/ticket_details_report';
        $this->load->view('layouts/main', $data);
    }


    // add comment on ticket
    public function addCommentOnTechnicalTicketReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $tId      = trim($this->input->post('tId'));
        $ticketId = base64_decode($tId);
        $this->form_validation->set_rules('tId', 'Ticket Details', 'trim|required');
        $this->form_validation->set_rules('comment', 'comment', 'trim|required|min_length[2]|max_length[2500]');
        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            $this->session->set_flashdata('errorM', $errors);
            redirect(base_url() . 'index.php/TicketSysReportController/getTicketDetailsForReport/?app='.$ticketId);
        }

        $comment = trim($this->input->post('comment'));
        if($this->TicketNicManModel->countTicketDetailsById($ticketId) != 1)
        {
            $this->session->set_flashdata('errorM', "Ticket details not found !");
            redirect(base_url() . 'ticket-dashboard-for-adlr');
        }
        $ticketDetails = $this->TicketNicManModel->getOnlyTicketDetailsById($ticketId);
        if($ticketDetails->ticket_status != 1)
        {
            $this->session->set_flashdata('errorM', "You cannot comment on this Ticket !");
            redirect(base_url() . 'index.php/TicketSysReportController/getTicketDetailsForReport/?app='.$ticketId);
        }


        // validation for file type and file size
        $name = $_FILES['attachment']['name'];
        $size = $_FILES['attachment']['size'];
        $fileHasOrNot = 0;
        $exp  = '';
        if($name != NULL)
        {
            $mime = mime_content_type($_FILES['attachment']['tmp_name']);
            $exp  = explode("/",$mime);
            $ext  = $exp[1];

            $fileHasOrNot = 1;

            if($ext == NULL)
            {
                $this->session->set_flashdata('error', "Attachment type must be " . UPLOAD_TYPE_VALIDATION_SHOW);
                redirect(base_url() . 'index.php/TicketSysReportController/getTicketDetailsForReport/?app='.$ticketId);
            }
            if(! in_array($ext, UPLOAD_TYPE_VALIDATION))
            {
                $this->session->set_flashdata('error', "Attachment type must be " . UPLOAD_TYPE_VALIDATION_SHOW);
                redirect(base_url() . 'index.php/TicketSysReportController/getTicketDetailsForReport/?app='.$ticketId);
            }
            if($size > UPLOAD_MAX_SIZE)
            {
                $this->session->set_flashdata('error', "Attachment size is more then " . UPLOAD_MAX_SIZE_VALIDATION_SHOW);
                redirect(base_url() . 'index.php/TicketSysReportController/getTicketDetailsForReport/?app='.$ticketId);
            }
        }

        $user_code   = trim($this->session->userdata('user_code'));
        $user_Id     = trim($this->session->userdata('unique_user_id'));
        $userDegCode = trim($this->session->userdata('designation'));
        $today       = date('Y-m-d G:i:s');
        $ipAddress   = $this->TicketSysCommonModel->get_client_ip();

        $this->db = $this->load->database('ticket_sys', TRUE);
        $this->db->trans_begin();

        $dataSave = array(
            'ticket_id'       => $ticketId,
            'comment_by'      => $userDegCode,
            'comment_code'    => $user_Id,
            'comment_details' => $comment,
            'ip'              => $ipAddress,
            'status'          => 1,
            'created_at'      => $today,
        );

        if($fileHasOrNot > 0)
        {
            // save attachment
            $_FILES['file']['name']     = $_FILES['attachment']['name'];
            $_FILES['file']['type']     = $_FILES['attachment']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['attachment']['tmp_name'];
            $_FILES['file']['error']    = $_FILES['attachment']['error'];
            $_FILES['file']['size']     = $_FILES['attachment']['size'];

            $mime = mime_content_type($_FILES['attachment']['tmp_name']);
            $exp  = explode("/",$mime);
            $onlyExtension  = $exp[1];

            $fileRename =  $this->UUID4() . '.' . $onlyExtension;

            $config['upload_path']   = UPLOAD_DIR;
            $config['allowed_types'] = UPLOAD_ALLOW_TYPE;
            $config['max_size']      = UPLOAD_MAX_SIZE;;
            $config['file_name']     = $fileRename;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file'))
            {
                $dataSave = array(
                    'ticket_id'       => $ticketId,
                    'comment_by'      => $userDegCode,
                    'comment_code'    => $user_code,
                    'comment_details' => $comment,
                    'ip'              => $ipAddress,
                    'status'          => 1,
                    'created_at'      => $today,
                    'file_path'       => UPLOAD_DIR . $fileRename,
                    'file_name'       => $_FILES['file']['name'],
                    'file_type'       => $_FILES['file']['type'],
                );
            }
            else
            {
                $this->session->set_flashdata('error', "There is some problem, Please try again");
                redirect(base_url() . 'index.php/TicketSysReportController/getTicketDetailsForReport/?app='.$ticketId);
            }
        }

        $insertTicketHis = $this->db->insert('technical_ticket_comment', $dataSave);
        if ($insertTicketHis != 1)
        {
            $this->db->trans_rollback();
            log_message('error', '#MRTT0002: Insertion failed in technical_ticket_comment for Ticket No ' . $ticketId . 'and query is ' . $this->db->last_query());
            $this->session->set_flashdata('error', "There is some problem, Please try again");
            redirect(base_url() . 'index.php/TicketSysReportController/getTicketDetailsForReport/?app='.$ticketId);
        }

        $this->db->trans_commit();
        redirect(base_url() . 'index.php/TicketSysReportController/getTicketDetailsForReport/?app='.$ticketId);

    }


    // view the comment doc
    public function getViewTicketCommentDocReport()
    {
        $this->checkUserPermissionTechTicketAdlr();
        $filePathId = $this->input->get('fileId');
        $fileType   = $this->input->get('type');
        if($filePathId == '' OR $fileType == '')
        {
            die("Unable to open file !");
        }

        $fileDetails = $this->TicketSysCommonModel->getTicketCommentDocWithFileId($filePathId);
        if($fileType == 1)
        {
            if($fileDetails->file_path == '')
            {
                die("Unable to open file !");
            }
            else
            {

                if(!file_exists($fileDetails->file_path))
                {
                    $parts = explode("uploads".UPLOAD_SEPARATOR, $fileDetails->file_path, 2);
                    if (count($parts) > 1)
                    {
                        $path = BACKUP_DIR_34."uploads".UPLOAD_SEPARATOR . $parts[1];
                    }
                    else
                    {
                        $path = $fileDetails->file_path;
                    }

                    if(!file_exists($path))
                    {
                        $path = BACKUP_DIR_35."uploads".UPLOAD_SEPARATOR . $parts[1];
                    }
                    if(!file_exists($path))
                    {
                        return false;
                    }
                }
                else
                {
                    $path = $fileDetails->file_path;
                }

                $mainfile = file_get_contents($path);
                $conType  = mime_content_type($path);
                $mainfile = base64_encode($mainfile);

                if ($conType == 'jpeg' || $conType == 'png' || $conType == 'jpg' || $conType == 'image/jpeg' || $conType == 'image/png' || $conType == 'image/jpg')
                {
                    echo "<img src = data:" . $this->decodeBase64($mainfile) . ";base64," . $mainfile . ">";
                }
                else
                {
                    header("Content-type: ".$conType);
                    echo base64_decode($mainfile);
                }
            }
        }
        elseif($fileType == 2)
        {
            if($fileDetails->file_path == '')
            {
                die("Unable to open file !");
            }
            else
            {

                if(!file_exists($fileDetails->file_path))
                {
                    $parts = explode("uploads".UPLOAD_SEPARATOR, $fileDetails->file_path, 2);
                    if (count($parts) > 1)
                    {
                        $path = BACKUP_DIR_34."uploads".UPLOAD_SEPARATOR . $parts[1];
                    }
                    else
                    {
                        $path = $fileDetails->file_path;
                    }

                    if(!file_exists($path))
                    {
                        $path = BACKUP_DIR_35."uploads".UPLOAD_SEPARATOR . $parts[1];
                    }
                    if(!file_exists($path))
                    {
                        return false;
                    }
                }
                else
                {
                    $path = $fileDetails->file_path;
                }

                $mainfile = file_get_contents($path);
                $conType  = mime_content_type($path);
                $mainfile = base64_encode($mainfile);

                if ($conType == 'jpeg' || $conType == 'png' || $conType == 'jpg' || $conType == 'image/jpeg' || $conType == 'image/png' || $conType == 'image/jpg')
                {
                    echo "<img src = data:" . $this->decodeBase64($mainfile) . ";base64," . $mainfile . ">";
                }
                else
                {
                    header("Content-type: ".$conType);
                    echo base64_decode($mainfile);
                }
            }
        }
        else
        {
            die("Unable to open file !");
        }

    }










}



