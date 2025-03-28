<?php

class AadhaarModel extends CI_Model
{
    function __construct() {
      parent::__construct();
    }

    public function dbswitch($dist_code) {
      if($dist_code == "02"){
          $this->db=$this->load->database('dhubri', TRUE);
      } else if($dist_code == "05"){
          $this->db=$this->load->database('barpeta', TRUE);
      } else if($dist_code == "10"){
          $this->db=$this->load->database('chirang', TRUE);
      } else if($dist_code == "13"){
          $this->db=$this->load->database('bongaigaon', TRUE);
      } else if($dist_code == "17"){
          $this->db=$this->load->database('dibrugarh', TRUE);
      } else if($dist_code == "15"){
          $this->db=$this->load->database('jorhat', TRUE);
      } else if($dist_code == "14"){
          $this->db=$this->load->database('golaghat', TRUE);
      } else if($dist_code == "07"){
          $this->db=$this->load->database('kamrup', TRUE);
      } else if($dist_code == "03"){
          $this->db=$this->load->database('goalpara', TRUE);
      } else if($dist_code == "18"){
          $this->db=$this->load->database('tinsukia', TRUE);
      } else if($dist_code == "12"){
          $this->db=$this->load->database('lakhimpur', TRUE);
      } else if($dist_code == "24"){
          $this->db=$this->load->database('kamrupm', TRUE);
      } else if($dist_code == "06"){
          $this->db=$this->load->database('nalbari', TRUE);
      } else if($dist_code == "11"){
          $this->db=$this->load->database('sonitpur', TRUE);
      } else if($dist_code == "16"){
          $this->db=$this->load->database('sibsagar', TRUE);
      } else if($dist_code == "32"){
          $this->db=$this->load->database('morigaon', TRUE);
      } else if($dist_code == "33"){
          $this->db=$this->load->database('nagaon', TRUE);
      } else if($dist_code == "34"){
          $this->db=$this->load->database('majuli', TRUE);
      } else if($dist_code == "21"){
          $this->db=$this->load->database('karimganj', TRUE);
      } else if($dist_code == "35"){
          $this->db=$this->load->database('biswanath', TRUE);
      } else if($dist_code == "36"){
          $this->db=$this->load->database('hojai', TRUE);
      } else if($dist_code == "37"){
          $this->db=$this->load->database('charaideo', TRUE);
      } else if($dist_code == "25"){
          $this->db=$this->load->database('dhemaji', TRUE);
      } else if($dist_code == "39"){
          $this->db=$this->load->database('bajali', TRUE);
      } else if($dist_code == "38"){
          $this->db=$this->load->database('ssalmara', TRUE);
      } else if($dist_code == "08"){
          $this->db=$this->load->database('darrang', TRUE);
      } else if($dist_code == "auth"){
          $this->db=$this->load->database('auth', TRUE);
      }
      return $this->db;
    }
    
    public function checkIfAadhaarLinked() {
        $this->db->where('unique_user_id', $this->session->userdata('unique_user_id'));
        $this->db->where('auth_type', 'AADHAAR');
        $this->db->where('auth_reff != ', '');
        return $this->db->get('depart_users');
    }

}
