<?php

class EkhajanaDashboardModel extends CI_Model {

   function __construct()
   {
      parent::__construct();
      $CI=&get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
   }
   //db switch
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
   //query for all received applications
   function allApplications()
   {
       //return $this->db;
		$dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        
        //echo $dist_code. $subdiv_code. $cir_code. $mouza_pargona_code;

        $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and el.dist_code=? and el.subdiv_code=? and el.cir_code=? and el.mouza_pargona_code=?  and el.repayment_flag is null"; 
		   $query = $this->db->query($sql,array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));        
        //echo  $this->db->last_query();
        return $query->row()->c;
	}
   //query for all pending applications
   function allPendingApplications()
   {
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
		  $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and el.status in ('P','MLM_F')  and el.dist_code=? and el.subdiv_code=? and el.cir_code=? and el.mouza_pargona_code=?";
		
      $query = $this->db->query($sql,array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        return $query->row()->c;
	}
   //query for all disposed applications
   function allDisposedApplications()
   {
		$dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
		$sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and el.status in ('MOU_F','COM_F','F','R')  and el.dist_code=? and el.subdiv_code=? and el.cir_code=? and el.mouza_pargona_code=? and el.repayment_flag is null"; 
		
        $query = $this->db->query($sql,array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        return $query->row()->c;
	}
   //query for all rejected applications
   function allRevertedApplications()
   {
		$dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
		$sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and el.status='L' and el.dist_code=? and el.subdiv_code=? and el.cir_code=? and el.mouza_pargona_code=?"; 
		$query = $this->db->query($sql,array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
      return $query->row()->c;
	}
   //getting last 30 days application count 
   public function getCountByDate(){
         $dist_code = $this->session->userdata('dist_code');
         $subdiv_code = $this->session->userdata('subdiv_code');
         $cir_code = $this->session->userdata('cir_code');
         $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');

         $sql = "select * from (select date(el.created_at) as created_at,
         count(distinct(el.id)) from ekhajana_applications as ea join ekhajana_land_details as el on 
         el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no
         where el.dist_code=? and el.subdiv_code=? and el.cir_code=? and el.mouza_pargona_code=? and 
         ea.is_draft='N' and ea.initial_payment_status in ('N','C') and date(el.created_at) >= '2024-07-01' 
         group by date(el.created_at) order by date(el.created_at) desc limit 30) t 
         order by t.created_at asc";

         $result = $this->db->query($sql,array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code))->result();
         return $result;
   }
}
