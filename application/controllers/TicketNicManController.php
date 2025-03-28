<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TicketNicManController extends MY_CONTROLLER
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->library('form_validation');
        $this->load->model('TicketSysCommonModel');
        $this->load->model('TicketNicManModel');
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


    // get pending ticket
    public function getPendingTicketNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $userDegCode      = TICKET_SYSTEM_NIC;
        $allPendingTicket = $this->TicketNicManModel->allPendingTicketForNicMan($userDegCode,TICKET_STATUS_PENDING);
        $data['tickets']  = $allPendingTicket;
        $data['tHeading'] = 'Pending Ticket';
        $data['tType']    = TICKET_STATUS_PENDING;

        $data['_view'] = 'Ticket_System/Nic/pending_ticket_list';
        $this->load->view('layouts/main', $data);
    }

    // get Assigned ticket to developer
    public function getAssignTicketToNicDev()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $userDegCode      = TICKET_SYSTEM_NIC;
        $allPendingTicket = $this->TicketNicManModel->allAssignedTicketForNicDev($userDegCode,TICKET_STATUS_PENDING);
        $data['tickets']  = $allPendingTicket;
        $data['tHeading'] = 'Assigned Ticket To Developer';
        $data['tType']    = TICKET_STATUS_ASSIGNED;

        $data['_view'] = 'Ticket_System/Nic/pending_ticket_list';
        $this->load->view('layouts/main', $data);
    }

    // get Rejected ticket
    public function getRejectedTicketNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $userDegCode      = TICKET_SYSTEM_NIC;
        $allPendingTicket = $this->TicketNicManModel->allRejectedTicketForNic($userDegCode,TICKET_STATUS_REJECTED);
        $data['tickets']  = $allPendingTicket;
        $data['tHeading'] = 'Rejected Ticket ';
        $data['tType']    = TICKET_STATUS_REJECTED;

        $data['_view'] = 'Ticket_System/Nic/pending_ticket_list';
        $this->load->view('layouts/main', $data);
    }

    // get Closed ticket
    public function getClosedTicketNicMan()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $userDegCode      = TICKET_SYSTEM_NIC;
        $allPendingTicket = $this->TicketNicManModel->allClosedTicketForNic(TICKET_STATUS_CLOSED);
        $data['tickets']  = $allPendingTicket;
        $data['tHeading'] = 'Closed Ticket ';
        $data['tType']    = TICKET_STATUS_CLOSED;

        $data['_view'] = 'Ticket_System/Nic/pending_ticket_list';
        $this->load->view('layouts/main', $data);
    }

    // get Request for closed ticket
    public function getRequestForClosedTicketByNicDev()
    {
        $this->checkUserPermissionTechTicketAdmin();
        $userDegCode      = TICKET_SYSTEM_NIC;
        $allPendingTicket = $this->TicketNicManModel->allRequestForClosedTicketForNic($userDegCode,TICKET_STATUS_PENDING);
        $data['tickets']  = $allPendingTicket;
        $data['tHeading'] = 'Ticket Request For Closed By Developer';
        $data['tType']    = TICKET_STATUS_REQUEST_TO_CLOSED;

        $data['_view'] = 'Ticket_System/Nic/pending_ticket_list';
        $this->load->view('layouts/main', $data);
    }





    // ticket Details
    public function getTechnicalTicketDetails()
    {
        $this->checkTicketAccess();
        $this->checkUserPermissionTechTicketAdmin();
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

        $assignedDev = '';
        if($ticketDetails->assign_dev != '')
        {
            $assignedDev = $this->TicketSysCommonModel->getNicDeveloperDetailsWithId($ticketDetails->assign_dev);
        }

        $data['developers']      = $devList;
        $data['districtName']    = $districtName;
        $data['subDivisionName'] = $subDivisionName;
        $data['circleName']      = $circleName;
        $data['assignedDev']     = $assignedDev;

//        printf('<pre>');
//        print_r($data);
//        die;

        $data['_view'] = 'Ticket_System/Nic/tech_ticket_details';
        $this->load->view('layouts/main', $data);

    }


    // change ticket status
    public function changeTechnicalTicketStatus()
    {
        $this->checkTicketAccess();
        $this->checkUserPermissionTechTicketAdmin();
        $_POST = json_decode(file_get_contents("php://input"), true);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ticketId', 'Ticket Details', 'trim|required|min_length[2]|max_length[300]');
        $this->form_validation->set_rules('changeTStatus', 'Ticket Status', 'trim|required|is_natural');
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|required|min_length[2]|max_length[300]');
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
        $tStatus     = trim($this->input->post('changeTStatus'));
        $user_code   = trim($this->session->userdata('unique_user_id'));
        $userDegCode = trim($this->session->userdata('designation'));
        $today       = date('Y-m-d G:i:s');
        $ipAddress   = $this->TicketSysCommonModel->get_client_ip();

        if($tStatus == TICKET_STATUS_CLOSED)
        {
            $changeStatus = 'Closed';
        }
        elseif($tStatus == TICKET_STATUS_REJECTED)
        {
            $changeStatus = 'Rejected';
        }
        else
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'There is some problem ! Please Try Again',
            ));
            return true;
        }

        if($this->TicketNicManModel->countTicketDetailsById($ticketId) != 1)
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Ticket details not found',
            ));
            return true;
        }
        $ticketDetails = $this->TicketNicManModel->getOnlyTicketDetailsById($ticketId);
        if($ticketDetails->ticket_status != TICKET_STATUS_PENDING || $ticketDetails->a_status != 0)
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Ticket already assigned to developer',
            ));
            return true;
        }
        $ticketName = $ticketDetails->t_unicode;
        $submitOn   = $ticketDetails->created_at;
        $dateH1     = new DateTime(date("Y-m-d", strtotime($submitOn)));
        $dateH2     = new DateTime(date("Y-m-d", strtotime($today)));
        $diffDays   = $dateH1->diff($dateH2);

        $this->db = $this->load->database('ticket_sys', TRUE);
        $this->db->trans_begin();

        if($tStatus == TICKET_STATUS_REJECTED)
        {
            $ticketUpdate = array(
                'ticket_status' => $tStatus,
                'updated_by'    => $userDegCode,
                'close_u_code'  => $user_code,
                'updated_at'    => $today,
                'closed_on'     => $today,
                'pro_note'      => $remarks,
                'pro_time'      => $diffDays->days,
            );
        }
        else
        {
            $ticketUpdate = array(
                'ticket_status' => $tStatus,
                'updated_by'    => $userDegCode,
                'close_u_code'  => $user_code,
                'updated_at'    => $today,
                'closed_on'     => $today,
                'pro_time'      => $diffDays->days,
            );
        }

        $this->db->where('ticket_id', $ticketId);
        $this->db->where('status', 1);
        $this->db->update('technical_ticket_details', $ticketUpdate);
        if ($this->db->affected_rows() != 1)
        {
            $this->db->trans_rollback();
            log_message('error', '#MRTTC0001: Updating failed in technical_ticket_details for Ticket No ' . $ticketName . 'and query is ' . $this->db->last_query());
            echo json_encode(array(
                'responseType' => 1,  'message' => "#MRTTC0001: There is some problem, Please try again",
            ));
            return true;
        }


        $historySaveFor = array(
            'ticket_id'        => $ticketId,
            'assign_from'      => $userDegCode,
            'assign_from_code' => $user_code,
            'assign_date'      => $submitOn,
            'assign_status'    => $changeStatus,
            'status'           => 1,
            'note'             => $remarks,
            'action_status'    => $changeStatus,
            'created_at'       => $today,
            'action_date'      => $today,
            'ip'               => $ipAddress,

        );
        $insertTicketHisFor = $this->db->insert('technical_ticket_history', $historySaveFor);
        if ($insertTicketHisFor != 1)
        {
            $this->db->trans_rollback();
            log_message('error', '#MRTTC0002: Insertion failed in technical_ticket_history for Ticket No ' . $ticketName . 'and query is ' . $this->db->last_query());
            echo json_encode(array(
                'responseType' => 1,  'message' => "#MRTTC0002: There is some problem, Please try again",
            ));
            return true;
        }

        $this->db->trans_commit();
        echo json_encode(array(
            'responseType' => 2,  'message' => "Ticket Successfully ".$changeStatus ,
        ));
        return true;

    }


    // Assign ticket to NIC Developer
    public function assignTechnicalTicketToDev()
    {
        $this->checkTicketAccess();
        $this->checkUserPermissionTechTicketAdmin();
        $_POST = json_decode(file_get_contents("php://input"), true);
        $this->form_validation->set_rules('ticketId', 'Ticket Details', 'trim|required|min_length[2]|max_length[300]');
        $this->form_validation->set_rules('setPriority', 'Ticket Details', 'trim|required|min_length[2]|max_length[300]');
        $this->form_validation->set_rules('selectDev', 'Selected Developer', 'trim|required');
        $this->form_validation->set_rules('note', 'Additional Note', 'trim|max_length[300]');
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
        $remarks     = trim($this->input->post('note'));
        $setPriority = trim($this->input->post('setPriority'));
        $selectDev   = trim($this->input->post('selectDev'));
        $user_code   = trim($this->session->userdata('unique_user_id'));
        $userDegCode = trim($this->session->userdata('designation'));
        $today       = date('Y-m-d G:i:s');
        $ipAddress   = $this->TicketSysCommonModel->get_client_ip();

        if($this->TicketSysCommonModel->countNicDeveloperWithId($selectDev) != 1)
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Assigned Developer not found',
            ));
            return true;
        }
        if($this->TicketNicManModel->countTicketDetailsById($ticketId) != 1)
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Ticket details not found',
            ));
            return true;
        }
        if($this->TicketNicManModel->countTicketDetailsById($ticketId) != 1)
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Ticket details not found',
            ));
            return true;
        }
        $ticketDetails = $this->TicketNicManModel->getOnlyTicketDetailsById($ticketId);
        if($ticketDetails->ticket_status == TICKET_STATUS_PENDING || $ticketDetails->a_status == 0)
        {
            $ticketName = $ticketDetails->t_unicode;
            $this->db = $this->load->database('ticket_sys', TRUE);
            $this->db->trans_begin();

            $ticketUpdate = array(
                'assign_dev'  => $selectDev,
                'assign_date' => $today,
                'a_status'    => 1,
            );

            $this->db->where('ticket_id', $ticketId);
            $this->db->where('status', 1);
            $this->db->update('technical_ticket_details', $ticketUpdate);
            if ($this->db->affected_rows() != 1)
            {
                $this->db->trans_rollback();
                log_message('error', '#MRTTC0006: Updating failed in technical_ticket_details for Ticket No ' . $ticketName . 'and query is ' . $this->db->last_query());
                echo json_encode(array(
                    'responseType' => 1,  'message' => "#MRTTC0006: There is some problem, Please try again",
                ));
                return true;
            }

            $historySaveFor = array(
                'ticket_id'        => $ticketId,
                'assign_from'      => $userDegCode,
                'assign_from_code' => $user_code,
                'assign_date'      => $today,
                'assign_status'    => 'Forwarded',
                'assign_to'        => 'NIC Developer',
                'priority'         => $setPriority,
                'status'           => 1,
                'note'             => $remarks,
                'action_status'    => 'Pending',
                'created_at'       => $today,
                'action_date'      => $today,
                'ip'               => $ipAddress,

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
                'responseType' => 2,  'message' => "Ticket Successfully Assigned to Developer",
            ));
            return true;
        }
        else
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Ticket already assigned to developer',
            ));
            return true;
        }

    }


    // Closed ticket status
    public function closedTechnicalTicket()
    {
        $this->checkTicketAccess();
        $this->checkUserPermissionTechTicketAdmin();
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
        if($ticketDetails->ticket_status == TICKET_STATUS_PENDING || $ticketDetails->a_status == 2)
        {
            $ticketName = $ticketDetails->t_unicode;
            $submitOn   = $ticketDetails->created_at;
            $dateH1     = new DateTime(date("Y-m-d", strtotime($submitOn)));
            $dateH2     = new DateTime(date("Y-m-d", strtotime($today)));
            $diffDays   = $dateH1->diff($dateH2);

            $this->db = $this->load->database('ticket_sys', TRUE);
            $this->db->trans_begin();

            $ticketUpdate = array(
                'ticket_status' => TICKET_STATUS_CLOSED,
                'updated_by'    => $userDegCode,
                'close_u_code'  => $user_code,
                'updated_at'    => $today,
                'closed_on'     => $today,
                'pro_time'      => $diffDays->days,
            );

            $this->db->where('ticket_id', $ticketId);
            $this->db->where('status', 1);
            $this->db->update('technical_ticket_details', $ticketUpdate);
            if ($this->db->affected_rows() != 1)
            {
                $this->db->trans_rollback();
                log_message('error', '#MRTTC008: Updating failed in technical_ticket_details for Ticket No ' . $ticketName . 'and query is ' . $this->db->last_query());
                echo json_encode(array(
                    'responseType' => 1,  'message' => "#MRTTC008: There is some problem, Please try again",
                ));
                return true;
            }


            $historySaveFor = array(
                'ticket_id'        => $ticketId,
                'assign_from'      => $userDegCode,
                'assign_from_code' => $user_code,
                'assign_date'      => $today,
                'assign_status'    => 'Closed',
                'status'           => 1,
                'note'             => $remarks,
                'action_status'    => 'Closed',
                'created_at'       => $today,
                'action_date'      => $today,
                'ip'               => $ipAddress,

            );
            $insertTicketHisFor = $this->db->insert('technical_ticket_history', $historySaveFor);
            if ($insertTicketHisFor != 1)
            {
                $this->db->trans_rollback();
                log_message('error', '#MRTTC0002: Insertion failed in technical_ticket_history for Ticket No ' . $ticketName . 'and query is ' . $this->db->last_query());
                echo json_encode(array(
                    'responseType' => 1,  'message' => "#MRTTC0002: There is some problem, Please try again",
                ));
                return true;
            }

            $this->db->trans_commit();
            echo json_encode(array(
                'responseType' => 2,  'message' => "Ticket Successfully Closed" ,
            ));
            return true;
        }
        else
        {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'You cannot close this Ticket ',
            ));
            return true;
        }


    }






}


