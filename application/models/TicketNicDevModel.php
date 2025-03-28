<?php

class TicketNicDevModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    // get all Assigned ticket for  NIC Developer
    public function allAssignedTicketNicDev($userDegCode,$tStatus,$userCode)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);

        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.pending_with',$userDegCode);
        $this->db->where('technical_ticket_details.ticket_status',$tStatus);
        $this->db->where('technical_ticket_details.assign_dev',$userCode);
        $this->db->where('technical_ticket_details.status',1);
        $this->db->where('technical_ticket_details.a_status',1);
        $this->db->order_by('technical_ticket_details.id','asc');
        $data = $this->db->get();
        return $data->result();
    }

    // count all Assigned ticket for  NIC Developer
    public function countAssignedTicketNicDev($userDegCode,$tStatus,$userCode)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('pending_with',$userDegCode)
            ->where('ticket_status',$tStatus)
            ->where('assign_dev',$userCode)
            ->where('status',1)
            ->where('a_status',1)
            ->get('technical_ticket_details')
            ->num_rows();
    }




    // get all Request For Closed ticket for NIC Developer
    public function allRequestForClosedTicketNicDev($userDegCode,$tStatus,$userCode)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);

        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.pending_with',$userDegCode);
        $this->db->where('technical_ticket_details.ticket_status',$tStatus);
        $this->db->where('technical_ticket_details.assign_dev',$userCode);
        $this->db->where('technical_ticket_details.status',1);
        $this->db->where('technical_ticket_details.a_status',2);
        $this->db->order_by('technical_ticket_details.id','asc');
        $data = $this->db->get();
        return $data->result();
    }

    // count Request For Closed ticket for NIC Developer
    public function countRequestForClosedTicketNicDev($userDegCode,$tStatus,$userCode)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('pending_with',$userDegCode)
            ->where('ticket_status',$tStatus)
            ->where('assign_dev',$userCode)
            ->where('status',1)
            ->where('a_status',2)
            ->get('technical_ticket_details')
            ->num_rows();
    }


    // get all Closed ticket for  NIC Developer
    public function allClosedTicketNicDev($userDegCode,$tStatus,$userCode)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.pending_with',$userDegCode);
        $this->db->where('technical_ticket_details.ticket_status',$tStatus);
        $this->db->where('technical_ticket_details.assign_dev',$userCode);
        $this->db->where('technical_ticket_details.status',1);
        $this->db->where('technical_ticket_details.a_status',2);
        $this->db->order_by('technical_ticket_details.id','asc');
        $data = $this->db->get();
        return $data->result();
    }


    // count Closed ticket for  NIC Developer
    public function countClosedTicketNicDev($userDegCode,$tStatus,$userCode)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('pending_with',$userDegCode)
            ->where('ticket_status',$tStatus)
            ->where('assign_dev',$userCode)
            ->where('status',1)
            ->where('a_status',2)
            ->get('technical_ticket_details')
            ->num_rows();
    }






}