<?php

class TicketNicManModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    // get all ticket with status only NIC Manager
    public function allPendingTicketForNicMan($userDegCode,$tStatus)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);

        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.pending_with',$userDegCode);
        $this->db->where('technical_ticket_details.ticket_status',$tStatus);
        $this->db->where('technical_ticket_details.status',1);
        $this->db->where('technical_ticket_details.a_status',0);
        $this->db->order_by('technical_ticket_details.id','asc');
        $data = $this->db->get();
        return $data->result();
    }

    // get all Assigned ticket with  NIC Developer
    public function allAssignedTicketForNicDev($userDegCode,$tStatus)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);

        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.pending_with',$userDegCode);
        $this->db->where('technical_ticket_details.ticket_status',$tStatus);
        $this->db->where('technical_ticket_details.status',1);
        $this->db->where('technical_ticket_details.a_status',1);
        $this->db->order_by('technical_ticket_details.id','asc');
        $data = $this->db->get();
        return $data->result();
    }

    // get all Request For Closed ticket by NIC Developer
    public function allRequestForClosedTicketForNic($userDegCode,$tStatus)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);

        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.pending_with',$userDegCode);
        $this->db->where('technical_ticket_details.ticket_status',$tStatus);
        $this->db->where('technical_ticket_details.status',1);
        $this->db->where('technical_ticket_details.a_status',2);
        $this->db->order_by('technical_ticket_details.id','asc');
        $data = $this->db->get();
        return $data->result();
    }

    // get all Rejected ticket
    public function allRejectedTicketForNic($userDegCode,$tStatus)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);

        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.pending_with',$userDegCode);
        $this->db->where('technical_ticket_details.ticket_status',$tStatus);
        $this->db->where('technical_ticket_details.status',1);
        $this->db->order_by('technical_ticket_details.id','asc');
        $data = $this->db->get();
        return $data->result();
    }

    // get all Closed ticket
    public function allClosedTicketForNic($tStatus)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);

        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.ticket_status',$tStatus);
        $this->db->where('technical_ticket_details.status',1);
        $this->db->order_by('technical_ticket_details.id','asc');
        $data = $this->db->get();
        return $data->result();
    }


    // count ticket details by ticket id
    public function countTicketDetailsById($tId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $data = $this->db->select()
            ->where('ticket_id',$tId)
            ->where('status',1)
            ->get('technical_ticket_details');

        return $data->num_rows();
    }


    // get ticket details by ticket id
    public function getOnlyTicketDetailsById($tId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $data = $this->db->select()
            ->where('ticket_id',$tId)
            ->where('status',1)
            ->get('technical_ticket_details');

        return $data->row();
    }


    // get ticket details by ticket id
    public function getTicketDetailsById($tId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);

        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.ticket_id',$tId);
        $this->db->where('technical_ticket_details.status',1);
        $this->db->order_by('technical_ticket_details.id','desc');
        $data = $this->db->get();

        return $data->row();
    }



    // get ticket history by ticket id
    public function getTicketHistoryById($tId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $data = $this->db->select()
            ->where('ticket_id',$tId)
            ->where('status',1)
            ->order_by('id','desc')
            ->get('technical_ticket_history');

        return $data->result();
    }


    // get ticket history by ticket id
    public function getTicketDocumentById($tId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $data = $this->db->select()
            ->where('ticket_id',$tId)
            ->where('status',1)
            ->order_by('id','asc')
            ->get('technical_ticket_attachment');

        return $data->result();
    }

    // get ticket Comment by ticket id
    public function getTicketCommentById($tId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $data = $this->db->select()
            ->where('ticket_id',$tId)
            ->where('status',1)
            ->order_by('id','desc')
            ->get('technical_ticket_comment');

        return $data->result();
    }







}