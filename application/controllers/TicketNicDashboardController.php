<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TicketNicDashboardController extends MY_CONTROLLER
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




    public function checkUserPermissionTechTicketAdmin()
    {
        $userDesignation = $this->session->userData('designation');
        if($userDesignation != TICKET_SYSTEM_NIC_ADMIN)
        {
            $this->session->set_flashdata('error',"#MR: You are not Authorized ! ");
            redirect( base_url().'dashboard');
        }
    }

    public function checkTicketAccess()
    {
        $userDesignation = $this->session->userData('designation');
        if (!in_array($userDesignation, TECHNICAL_TICKET_ACCESS_NIC))
        {
            $errors = '#MR: You are not Authorized for this process';
            $this->session->set_flashdata('error', $errors);
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



    // get dashboard  for NIC Manager
    public function getDashboardForNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();

        $allService   = $this->TicketSysCommonModel->getAllServiceTypeWithOutStatus();
        $serviceArray = [];
        $serviceCount = 0;
        foreach ($allService as $key=> $service)
        {
            $serviceCount = $serviceCount + 1;
            $serviceArray[$key]['id']               = $service->id;
            $serviceArray[$key]['app_id']           = $service->app_id;
            $serviceArray[$key]['application_name'] = $service->application_name;
            $serviceArray[$key]['service_name']     = $service->service_name;
            $serviceArray[$key]['count']            = $this->TicketSysReportModel->countTicketServiceWise($service->app_id,$service->id);
        }

        $data['services']         = $serviceArray;
        $data['allCount']         = $this->TicketSysReportModel->countAllTicketForReport();
        $data['inQueueCount']     = $this->TicketSysReportModel->countAllInQueueTicketForReport();
        $data['closedCount']      = $this->TicketSysReportModel->countAllClosedTicketForReport();
        $data['rejectedCount']    = $this->TicketSysReportModel->countAllRejectedTicketForReport();
        $data['pendingCount']     = $this->TicketSysReportModel->countAllPendingTicketForReport();
        $data['processingCount']  = $this->TicketSysReportModel->countAllProcessingTicketForReport();
        $data['nicDevCount']      = $this->TicketSysCommonModel->countAllNicDeveloper();
        $data['applicationCount'] = $this->TicketSysCommonModel->countAllApplication();
        $data['serviceCount']     = $serviceCount;

        $data['_view'] = 'Ticket_System/NicMan/dashboard';
        $this->load->view('layouts/main', $data);
    }

    // get all register ticket
    public function getAllRegisterTicketNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $data['_view'] = 'Ticket_System/NicMan/all_register_ticket';
        $this->load->view('layouts/main', $data);
    }

    // ajax for pagination ( all Register )
    public function ajaxAllRegisterTicketNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
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
                    '<a class="rezaButt buttInfo" href="'.base_url().'index.php/TicketNicManController/getTechnicalTicketDetails/?app='.$rows->ticket_id.'">
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
    public function getAllClosedTicketNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $data['title']    = 'All Closed Ticket';
        $data['tStatus']  = TICKET_STATUS_CLOSED;
        $data['tProcess'] = 2;

        $data['_view'] = 'Ticket_System/NicMan/all_ticket_with_status';
        $this->load->view('layouts/main', $data);
    }

    // get all Rejected ticket
    public function getAllRejectedTicketNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $data['title']    = 'All Rejected Ticket';
        $data['tStatus']  = TICKET_STATUS_REJECTED;
        $data['tProcess'] = 0;

        $data['_view'] = 'Ticket_System/NicMan/all_ticket_with_status';
        $this->load->view('layouts/main', $data);
    }

    // get all InQueue ticket
    public function getAllInQueueTicketNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $data['title']    = 'All Ticket Assigned To Developer';
        $data['tStatus']  = TICKET_STATUS_PENDING;
        $data['tProcess'] = 1;

        $data['_view'] = 'Ticket_System/NicMan/all_ticket_with_status';
        $this->load->view('layouts/main', $data);
    }

    // get all UnderProcessing ticket
    public function getAllUnderProcessingTicketNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $data['title']    = 'All Ticket Request for Closed';
        $data['tStatus']  = TICKET_STATUS_PENDING;
        $data['tProcess'] = 2;

        $data['_view'] = 'Ticket_System/NicMan/all_ticket_with_status';
        $this->load->view('layouts/main', $data);
    }

    // get all pending ticket
    public function getAllPendingTicketNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $data['title']    = 'All Pending Ticket';
        $data['tStatus']  = TICKET_STATUS_PENDING;
        $data['tProcess'] = 0;

        $data['_view'] = 'Ticket_System/NicMan/all_ticket_with_status';
        $this->load->view('layouts/main', $data);
    }

    // ajax for pagination with status
    public function ajaxAllTicketWithStatusNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
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
                    '<a class="rezaButt buttInfo" href="'.base_url().'index.php/TicketNicManController/getTechnicalTicketDetails/?app='.$rows->ticket_id.'">
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
    public function getTicketServiceTypeWiseNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
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

        $data['_view'] = 'Ticket_System/NicMan/all_ticket_by_service';
        $this->load->view('layouts/main', $data);
    }

    // ajax for pagination service Type Wise
    public function ajaxAllTicketByServiceNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
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
                    '<a class="rezaButt buttInfo" href="'.base_url().'index.php/TicketNicManController/getTechnicalTicketDetails/?app='.$rows->ticket_id.'">
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
    public function searchTicketForNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $application = $this->TicketSysCommonModel->getAllApplication();
        $service     = $this->TicketSysCommonModel->getAllServiceTypeWithOutStatus();

        $data['applications'] = $application;
        $data['services']     = $service;

        $data['_view'] = 'Ticket_System/NicMan/search_ticket';
        $this->load->view('layouts/main', $data);
    }

    // ajax for search
    public function ajaxSearchTicketNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
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
                    '<a class="rezaButt buttInfo" href="'.base_url().'index.php/TicketNicManController/getTechnicalTicketDetails/?app='.$rows->ticket_id.'">
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











}



