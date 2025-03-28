<?php
class EkhajanaDoatReportModel extends CI_Model {

    //db switch method
    public function dbswitch(){       
        $CI=&get_instance();
        if($this->session->userdata('dist_code') == "02"){
        $this->db=$CI->load->database('dhubri', TRUE);    
        } else if($this->session->userdata('dist_code') == "05"){
        $this->db=$CI->load->database('barpeta', TRUE);    
        } else if($this->session->userdata('dist_code') == "10"){
        $this->db=$CI->load->database('chirang', TRUE);       
        } else if($this->session->userdata('dist_code') == "13"){
        $this->db=$CI->load->database('bongaigaon', TRUE);    
        }  else if($this->session->userdata('dist_code') == "17"){
        $this->db=$CI->load->database('dibrugarh', TRUE);    
        }  else if($this->session->userdata('dist_code') == "15"){
        $this->db=$CI->load->database('jorhat', TRUE);    
        }  else if($this->session->userdata('dist_code') == "14"){
        $this->db=$CI->load->database('golaghat', TRUE);    
        }  else if($this->session->userdata('dist_code') == "07"){
            $this->db=$CI->load->database('kamrup', TRUE);    
        }  else if($this->session->userdata('dist_code') == "03"){
        $this->db=$CI->load->database('goalpara', TRUE);    
        }  else if($this->session->userdata('dist_code') == "18"){
        $this->db=$CI->load->database('tinsukia', TRUE);    
        }  else if($this->session->userdata('dist_code') == "12"){
        $this->db=$CI->load->database('lakhimpur', TRUE);   
        }  else if($this->session->userdata('dist_code') == "24"){
        $this->db=$CI->load->database('kamrupM', TRUE);   
        }  else if($this->session->userdata('dist_code') == "06"){
        $this->db=$CI->load->database('nalbari', TRUE);   
        }  else if($this->session->userdata('dist_code') == "11"){
        $this->db=$CI->load->database('sonitpur', TRUE);   
        }  else if($this->session->userdata('dist_code') == "12"){
        $this->db=$CI->load->database('lakhimpur', TRUE);   
        }  else if($this->session->userdata('dist_code') == "16"){
        $this->db=$CI->load->database('sibsagar', TRUE);   
        }  else if($this->session->userdata('dist_code') == "32"){
        $this->db=$CI->load->database('morigaon', TRUE);   
        }  else if($this->session->userdata('dist_code') == "33"){
        $this->db=$CI->load->database('nagaon', TRUE);   
        }  else if($this->session->userdata('dist_code') == "34"){
        $this->db=$CI->load->database('majuli', TRUE);   
        }  else if($this->session->userdata('dist_code') == "21"){
        $this->db=$CI->load->database('karimganj', TRUE);   
        }  else if($this->session->userdata('dist_code') == "08"){
        $this->db=$CI->load->database('darrang', TRUE);   
        }  else if($this->session->userdata('dist_code') == "35"){
        $this->db=$CI->load->database('biswanath', TRUE);   
        }  else if($this->session->userdata('dist_code') == "36"){
        $this->db=$CI->load->database('hojai', TRUE);   
        }  else if($this->session->userdata('dist_code') == "37"){
        $this->db=$CI->load->database('charaideo', TRUE);   
        }  else if($this->session->userdata('dist_code') == "25"){
        $this->db=$CI->load->database('dhemaji', TRUE);   
        }                                                                                                                                                                                                              
    }

    public function getAllCommisionData($year,$month)
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $query = $this->db->query("SELECT * from ekhajana_mouzadari_area_report_doat where DATE_PART('YEAR', created_at) = ? and DATE_PART('MONTH', created_at) = ?",array($year,$month));
        if($query->num_rows() != 0){
            $result = $query->result();
            return $result; 
        }else{
            return "NO-DATA-FOUND";
        }
        
    }

    public function getAllUniqueGrn($year,$month)
    {
        $query = $this->db->query("SELECT count(distinct(grn_no)) as count from ekhajana_mouzadari_area_report_doat where DATE_PART('YEAR', created_at) = ? and DATE_PART('MONTH', created_at) = ?",array($year,$month));
        if($query->num_rows() != 0){
            $result = $query->row()->count;
            return $result; 
        }else{
            return "NO-DATA-FOUND";
        }
    }

    public function getTotalAmountReceived($year,$month)
    {

        
        $query = $this->db->query("select sum(t.ta) as amount from 
                                    (SELECT distinct(grn_no) as grn,total_amount as ta from 
                                    ekhajana_mouzadari_area_report_doat where DATE_PART('YEAR', created_at) = ? 
                                    and DATE_PART('MONTH', created_at) = ?) as t",array($year,$month));
        if($query->num_rows() != 0){
            $result = $query->row()->amount;
            return $result; 
        }else{
            return "NO-DATA-FOUND";
        }
    }

    public function getTotalCommissionReceived($year,$month)
    {
        $query = $this->db->query("SELECT sum(total_commission_patta_wise) as amount from ekhajana_mouzadari_area_report_doat where DATE_PART('YEAR', created_at) = ? and DATE_PART('MONTH', created_at) = ?",array($year,$month));        
        if($query->num_rows() != 0){
            $result = $query->row()->amount;
            return $result; 
        }else{
            return "NO-DATA-FOUND";
        }
    }
}
?>