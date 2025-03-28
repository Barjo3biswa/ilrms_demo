<?php

class TicketSysReportModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function dbswitch2($dist_code)
    {
        if ($dist_code == "02") {
            $this->db2 = $this->load->database('dhubri', TRUE);
        } else if ($dist_code == "05") {
            $this->db2 = $this->load->database('barpeta', TRUE);
        } else if ($dist_code == "10") {
            $this->db2 = $this->load->database('chirang', TRUE);
        } else if ($dist_code == "13") {
            $this->db2 = $this->load->database('bongaigaon', TRUE);
        } else if ($dist_code == "17") {
            $this->db2 = $this->load->database('dibrugarh', TRUE);
        } else if ($dist_code == "15") {
            $this->db2 = $this->load->database('jorhat', TRUE);
        } else if ($dist_code == "14") {
            $this->db2 = $this->load->database('golaghat', TRUE);
        } else if ($dist_code == "07") {
            $this->db2 = $this->load->database('kamrup', TRUE);
        } else if ($dist_code == "03") {
            $this->db2 = $this->load->database('goalpara', TRUE);
        } else if ($dist_code == "18") {
            $this->db2 = $this->load->database('tinsukia', TRUE);
        } else if ($dist_code == "12") {
            $this->db2 = $this->load->database('lakhimpur', TRUE);
        } else if ($dist_code == "24") {
            $this->db2 = $this->load->database('kamrupm', TRUE);
        } else if ($dist_code == "06") {
            $this->db2 = $this->load->database('nalbari', TRUE);
        } else if ($dist_code == "11") {
            $this->db2 = $this->load->database('sonitpur', TRUE);
        } else if ($dist_code == "16") {
            $this->db2 = $this->load->database('sibsagar', TRUE);
        } else if ($dist_code == "32") {
            $this->db2 = $this->load->database('morigaon', TRUE);
        } else if ($dist_code == "33") {
            $this->db2 = $this->load->database('nagaon', TRUE);
        } else if ($dist_code == "34") {
            $this->db2 = $this->load->database('majuli', TRUE);
        } else if ($dist_code == "21") {
            $this->db2 = $this->load->database('karimganj', TRUE);
        } else if ($dist_code == "35") {
            $this->db2 = $this->load->database('biswanath', TRUE);
        } else if ($dist_code == "36") {
            $this->db2 = $this->load->database('hojai', TRUE);
        } else if ($dist_code == "37") {
            $this->db2 = $this->load->database('charaideo', TRUE);
        } else if ($dist_code == "25") {
            $this->db2 = $this->load->database('dhemaji', TRUE);
        } else if ($dist_code == "39") {
            $this->db2 = $this->load->database('bajali', TRUE);
        } else if ($dist_code == "38") {
            $this->db2 = $this->load->database('ssalmara', TRUE);
        } else if ($dist_code == "08") {
            $this->db2 = $this->load->database('darrang', TRUE);
        } else if ($dist_code == "auth") {
            $this->db2 = $this->load->database('auth', TRUE);
        }
        return $this->db2;
    }



    // count all ticket
    public function countAllTicketForReport()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('status',1)
            ->get('technical_ticket_details')
            ->num_rows();
    }

    // get all ticket
    public function getAllTicketForReport()
    {
        $this->db->select('technical_ticket_details.*,ticket_service_type.service_name,ticket_application_types.application_name');
        $this->db->from('technical_ticket_details');
        $this->db->join('ticket_application_types','ticket_application_types.id=technical_ticket_details.t_app_type_id');
        $this->db->join('ticket_service_type','ticket_service_type.id=technical_ticket_details.t_service_id');
        $this->db->where('technical_ticket_details.status',1);
        $this->db->order_by('technical_ticket_details.id','asc');
        $data = $this->db->get();
        return $data->result();
    }


    // count all Closed ticket
    public function countAllClosedTicketForReport()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('ticket_status',TICKET_STATUS_CLOSED)
            ->where('status',1)
            ->get('technical_ticket_details')
            ->num_rows();
    }

    // count all Rejected ticket
    public function countAllRejectedTicketForReport()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('ticket_status',TICKET_STATUS_REJECTED)
            ->where('status',1)
            ->get('technical_ticket_details')
            ->num_rows();
    }

    // count all pending  ticket
    public function countAllPendingTicketForReport()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('ticket_status',TICKET_STATUS_PENDING)
            ->where('pending_with',TICKET_SYSTEM_NIC)
            ->where('status',1)
            ->where('a_status',0)
            ->get('technical_ticket_details')
            ->num_rows();
    }

    // count all In Queue ticket
    public function countAllInQueueTicketForReport()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('ticket_status',TICKET_STATUS_PENDING)
            ->where('pending_with',TICKET_SYSTEM_NIC)
            ->where('status',1)
            ->where('a_status',1)
            ->get('technical_ticket_details')
            ->num_rows();
    }


    // count all processing ticket
    public function countAllProcessingTicketForReport()
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('ticket_status',TICKET_STATUS_PENDING)
            ->where('pending_with',TICKET_SYSTEM_NIC)
            ->where('status',1)
            ->where('a_status',2)
            ->get('technical_ticket_details')
            ->num_rows();
    }

    // count ticket service wise
    public function countTicketServiceWise($appId,$serId)
    {
        $this->db = $this->load->database('ticket_sys', TRUE);
        return $this->db->select()
            ->where('t_app_type_id',$appId)
            ->where('t_service_id',$serId)
            ->where('status',1)
            ->get('technical_ticket_details')
            ->num_rows();
    }


    // get all circle
    public function getCircleByDistJSON($distCode)
    {
        $this->db2 = $this->dbswitch2($distCode);
        $district = $this->db2->query("select * from location where dist_code =?  and "
            . " subdiv_code!='00' and cir_code!='00' and mouza_pargona_code='00' and "
            . " vill_townprt_code='00000' and lot_no='00'",array($distCode));
        return $district->result();
    }





}