<?php

class TicketSysCommonModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // save application type
    public function saveApplicationType($data)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $this->db->trans_start();
        $this->db->set('created_at', 'NOW()', FALSE);
        $this->db->set('updated_at', 'NOW()', FALSE);
        $this->db->insert('ticket_application_types', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // update application type
    public function updateApplicationType($appId,$data)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $this->db->trans_start();
        $this->db->set('updated_at', 'NOW()', FALSE);
        $this->db->where('id',$appId);
        $this->db->update('ticket_application_types', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // get all application with out status
    public function getAllApplicationWithOutStatus()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->order_by('id','asc')
            ->get('ticket_application_types')
            ->result();

    }

    // get all application
    public function getAllApplication()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('status', 1)
            ->order_by('id','asc')
            ->get('ticket_application_types')
            ->result();
    }

    // count all application
    public function countAllApplication()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('status', 1)
            ->get('ticket_application_types')
            ->num_rows();

    }

    // get application details with id
    public function getApplicationDetailsWithId($appId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('id', $appId)
            ->get('ticket_application_types');

    }

    // checking Duplicate Application type
    public function checkApplicationTypeDuplicate($name)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('application_name',$name)
            ->get('ticket_application_types')
            ->num_rows();
    }

    // check application type
    public function checkApplicationTypeIdExistOrNot($appId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('id',$appId)
            ->get('ticket_application_types')
            ->num_rows();
    }





    // save service type
    public function saveServiceType($data)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $this->db->trans_start();
        $this->db->set('created_at', 'NOW()', FALSE);
        $this->db->set('updated_at', 'NOW()', FALSE);
        $this->db->insert('ticket_service_type', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // update Service type
    public function updateServiceType($appId,$data)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $this->db->trans_start();
        $this->db->set('updated_at', 'NOW()', FALSE);
        $this->db->where('id',$appId);
        $this->db->update('ticket_service_type', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // get all service type with join
    public function getAllServiceType()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $this->db->select('ticket_service_type.*,ticket_application_types.application_name');
        $this->db->from('ticket_service_type');
        $this->db->join('ticket_application_types','ticket_application_types.id = ticket_service_type.app_id');
        $this->db->where('ticket_service_type.status',1);
        $this->db->where('ticket_application_types.status',1);
        $this->db->order_by('ticket_service_type.app_id','asc');
        $ticketCategory = $this->db->get();
        return $ticketCategory->result();
    }

    // get all service type with join without status
    public function getAllServiceTypeWithOutStatus()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $this->db->select('ticket_service_type.*,ticket_application_types.application_name');
        $this->db->from('ticket_service_type');
        $this->db->join('ticket_application_types','ticket_application_types.id = ticket_service_type.app_id');
        $this->db->order_by('ticket_service_type.app_id','asc');
        $ticketCategory = $this->db->get();
        return $ticketCategory->result();
    }

    // get service type details with id
    public function getServiceTypeDetailsWithId($serviceId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $this->db->select('ticket_service_type.*,ticket_application_types.application_name');
        $this->db->from('ticket_service_type');
        $this->db->join('ticket_application_types','ticket_application_types.id = ticket_service_type.app_id');
        $this->db->where('ticket_service_type.id',$serviceId);
        $ticketCategory = $this->db->get();
        return $ticketCategory;
    }

    // check duplicate Service Type name
    public function checkDuplicateTicketCategoryWithName($appType,$name)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('app_id', $appType)
            ->where('service_name', $name)
            ->get('ticket_service_type')
            ->num_rows();
    }

    // get all services with application id
    public function getAllServicesWithApplicationId($appId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('id', $appId)
            ->order_by('id','asc')
            ->get('ticket_service_type');
    }






    // get all ticket type
    public function getAllTicketType()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('status',1)
            ->order_by('id','asc')
            ->get('ticket_type')
            ->result();

    }

    // count all ticket type
    public function countAllTicketType()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('status',1)
            ->get('ticket_type')
            ->num_rows();
    }

    // save Ticket type
    public function saveTicketType($data)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $this->db->trans_start();
        $this->db->set('created_at', 'NOW()', FALSE);
        $this->db->set('updated_at', 'NOW()', FALSE);
        $this->db->insert('ticket_type', $data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // check duplicate Ticket Type name
    public function checkTicketTypeDuplicate($name)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('t_type_name', $name)
            ->get('ticket_type')
            ->num_rows();
    }



    // get all NIC Developer
    public function getAllNicDeveloper()
    {
        $this->db = $this->load->database('db2', TRUE);
        return $this->db->select('id,name,designation,date_of_joining,mobile_no,email,address,display_name,status,unique_user_id')
            ->where('designation', TICKET_SYSTEM_NIC_DEVELOPER)
            ->where('status', 'E')
            ->order_by('id','asc')
            ->get('depart_users')
            ->result();

    }

    // count all NIC Developer
    public function countAllNicDeveloper()
    {
        $this->db = $this->load->database('db2', TRUE);
        return $this->db->select('id,name,designation,date_of_joining,mobile_no,email,address,display_name,status,unique_user_id')
            ->where('designation', TICKET_SYSTEM_NIC_DEVELOPER)
            ->where('status', 'E')
            ->get('depart_users')
            ->num_rows();

    }

    // check NIC Developer with id
    public function countNicDeveloperWithId($uCode)
    {
        $this->db = $this->load->database('db2', TRUE);
        return $this->db->select()
            ->where('unique_user_id', $uCode)
            ->get('depart_users')
            ->num_rows();

    }

    // get NIC Developer with id
    public function getNicDeveloperDetailsWithId($uCode)
    {
        $this->db = $this->load->database('db2', TRUE);
        return $this->db->select('id,name,designation,date_of_joining,mobile_no,email,address,display_name,status,unique_user_id')
            ->where('unique_user_id', $uCode)
            ->get('depart_users')
            ->row();

    }






    // get comment document  with file id
    public function getTicketCommentDocWithFileId($fileId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $docs = $this->db->select()
            ->where('id',$fileId)
            ->where('status',1)
            ->get('technical_ticket_comment');

        return $docs->row();
    }

    // get document with file id
    public function getTicketDocWithFileId($fileId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        $docs = $this->db->select()
            ->where('id',$fileId)
            ->where('status',1)
            ->get('technical_ticket_attachment');

        return $docs->row();
    }



    public function get_client_ip(){
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //if user is from the proxy
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }elseif(!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // if user from the share internet
            return $_SERVER['HTTP_CLIENT_IP'];
        }else{
            //if user is from the remote address
            return $_SERVER['REMOTE_ADDR'];
        }

    }
}