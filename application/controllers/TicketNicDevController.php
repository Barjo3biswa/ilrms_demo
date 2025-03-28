<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TicketNicDevController extends MY_CONTROLLER
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->library('form_validation');
        $this->load->model('TicketSysCommonModel');
        $this->load->model('TicketNicManModel');
        $this->load->model('TicketNicDevModel');
    }


    public function checkTicketAccessDev()
    {
        $userDesignation = $this->session->userData('designation');
        if ($userDesignation != TICKET_SYSTEM_NIC_DEVELOPER)
        {
            $errors = '#MR: You are not Authorized for this process';
            $this->session->set_flashdata('error', $errors);
            redirect( base_url().'dashboard');
        }
    }


    // Assigned ticket for NIC Developer
    public function getAssignedTicketListNicDev()
    {
        $this->checkTicketAccessDev();
        $data['tHeading'] = 'Assigned Ticket List';
        $data['tType']    = TICKET_STATUS_ASSIGNED;
        $data['tStatus']  = TICKET_STATUS_PENDING;
        $data['tProcess'] = 1;

        $data['_view'] = 'Ticket_System/Nic/pending_ticket_list_dev';
        $this->load->view('layouts/main', $data);

    }


    // Request for Closed ticket for NIC Developer
    public function getRequestForClosedTicketList()
    {
        $this->checkTicketAccessDev();
        $data['tHeading'] = 'Request For Closed Ticket List';
        $data['tType']    = TICKET_STATUS_REQUEST_TO_CLOSED;
        $data['tStatus']  = TICKET_STATUS_PENDING;
        $data['tProcess'] = 2;

        $data['_view'] = 'Ticket_System/Nic/pending_ticket_list_dev';
        $this->load->view('layouts/main', $data);
    }



    // Closed ticket for NIC Developer
    public function getClosedTicketNicDev()
    {
        $this->checkTicketAccessDev();
        $data['tHeading'] = 'Closed Ticket List';
        $data['tType']    = TICKET_STATUS_CLOSED;
        $data['tStatus']  = TICKET_STATUS_CLOSED;
        $data['tProcess'] = 2;

        $data['_view'] = 'Ticket_System/Nic/pending_ticket_list_dev';
        $this->load->view('layouts/main', $data);
    }



    // ajax for pagination with status
    public function ajaxAllTicketWithStatusNicDev()
    {
        $this->checkTicketAccessDev();
        $json     = null;
        $draw     = intval($this->input->post('draw'));
        $start    = intval($this->input->post('start'));
        $length   = intval($this->input->post('length'));
        $order    = $this->input->post('order');
        $case_no  = $this->input->post('case_no');
        $tStatus  = $this->input->post('tStatus');
        $tProcess = $this->input->post('tProcess');
        $sub_date = $this->input->post('sub_date');

        $userDegCode   = TICKET_SYSTEM_NIC;
        $userCode      = $this->session->userData('unique_user_id');
        $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));
        $this->db      = $this->load->database('ticket_sys', TRUE);

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
        $this->db->where('technical_ticket_details.pending_with',$userDegCode);
        $this->db->where('technical_ticket_details.assign_dev',$userCode);
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
            $this->db->where('technical_ticket_details.pending_with',$userDegCode);
            $this->db->where('technical_ticket_details.assign_dev',$userCode);
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
                    '<a class="rezaButt buttInfo" href="'.base_url().'index.php/TicketNicDevController/getTechnicalTicketDetailsDev/?app='.$rows->ticket_id.'">
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



    // ticket Details
    public function getTechnicalTicketDetailsDev()
    {
        $this->checkTicketAccessDev();
        $tId = $this->input->get('app');
        if($this->TicketNicManModel->countTicketDetailsById($tId) != 1)
        {
            $this->session->set_flashdata('errorM', "Ticket details not found !");
            redirect(base_url().'pending-ticket-assign-man');
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

        $devList = $this->TicketSysCommonModel->getAllNicDeveloper();

        $data['developers']      = $devList;
        $data['districtName']    = $districtName;
        $data['subDivisionName'] = $subDivisionName;
        $data['circleName']      = $circleName;


        $data['_view'] = 'Ticket_System/Nic/tech_ticket_details_dev';
        $this->load->view('layouts/main', $data);

    }



    // Request for closing ticket
    public function requestToCloseTicketDev()
    {
        $this->checkTicketAccessDev();
        $_POST = json_decode(file_get_contents("php://input"), true);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ticketId', 'Ticket Details', 'trim|required|min_length[2]|max_length[300]');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|max_length[300]');
        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
            echo json_encode(array(
                'responseType' => 1,
                'message' => $errors,
            ));
            return true;
        }

        $ticketIdEn  = trim($this->input->post('ticketId'));
        $ticketId    = base64_decode($ticketIdEn);
        $remarks     = trim($this->input->post('remarks'));
        $user_code   = trim($this->session->userdata('unique_user_id'));
        $userDegCode = trim($this->session->userdata('designation'));
        $today       = date('Y-m-d G:i:s');
        $ipAddress   = $this->TicketSysCommonModel->get_client_ip();

        if($this->TicketNicManModel->countTicketDetailsById($ticketId) != 1)
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Ticket details not found',
            ));
            return true;
        }
        $ticketDetails = $this->TicketNicManModel->getOnlyTicketDetailsById($ticketId);
        if($ticketDetails->ticket_status == TICKET_STATUS_PENDING || $ticketDetails->a_status == 1)
        {
            $ticketName = $ticketDetails->t_unicode;
            $submitOn   = $ticketDetails->assign_date;
            $dateH1     = new DateTime(date("Y-m-d", strtotime($submitOn)));
            $dateH2     = new DateTime(date("Y-m-d", strtotime($today)));
            $diffDays   = $dateH1->diff($dateH2);

            $this->db = $this->load->database('ticket_sys', TRUE);
            $this->db->trans_begin();

            $ticketUpdate = array(
                'a_status' => 2,
            );

            $this->db->where('ticket_id', $ticketId);
            $this->db->where('status', 1);
            $this->db->update('technical_ticket_details', $ticketUpdate);
            if ($this->db->affected_rows() != 1)
            {
                $this->db->trans_rollback();
                log_message('error', '#MRTTD001: Updating failed in technical_ticket_details for Ticket No ' . $ticketName . 'and query is ' . $this->db->last_query());
                echo json_encode(array(
                    'responseType' => 1,  'message' => "#MRTTD001: There is some problem, Please try again",
                ));
                return true;
            }

            $historySaveFor = array(
                'ticket_id'        => $ticketId,
                'assign_from'      => $userDegCode,
                'assign_from_code' => $user_code,
                'assign_date'      => $submitOn,
                'assign_status'    => 'Forwarded',
                'assign_to'        => 'NIC Manager',
                'status'           => 1,
                'note'             => $remarks,
                'action_status'    => 'Pending',
                'created_at'       => $today,
                'action_date'      => $today,
                'ip'               => $ipAddress,
                'pro_days'         => $diffDays->days,

            );

            $insertTicketHisFor = $this->db->insert('technical_ticket_history', $historySaveFor);
            if ($insertTicketHisFor != 1)
            {
                $this->db->trans_rollback();
                log_message('error', '#MRTTC0007: Insertion failed in technical_ticket_history for Ticket No ' . $ticketName . 'and query is ' . $this->db->last_query());
                echo json_encode(array(
                    'responseType' => 1,  'message' => "#MRTTC0007: There is some problem, Please try again",
                ));
                return true;
            }

            $this->db->trans_commit();
            echo json_encode(array(
                'responseType' => 2,  'message' => "Ticket Successfully Forwarded to NIC Manager for Closing",
            ));
            return true;
        }
        else
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Ticket already forwarded to NIC Manager',
            ));
            return true;
        }

    }



}









//        printf('<pre>');
//        print_r($data);
//        die;
