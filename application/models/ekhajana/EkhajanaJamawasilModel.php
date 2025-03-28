<?php
class EkhajanaJamawasilModel extends CI_Model {

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

   //getting lot no 
   public function getLotNoJSON($distCode, $subdivcode, $circode, $mouzacode) {
   $this->dbswitch();
      $district = $this->db->query("select *  from   location where dist_code =?  and "
               . " subdiv_code=? and cir_code=? and mouza_pargona_code=? and "
               . " vill_townprt_code='00000' and lot_no!='00' order by lot_no",array($distCode,$subdivcode,$circode,$mouzacode));
      return $district->result();
   }

   //getting village and lot no 
   public function getVillagesJSON($distCode, $subdivcode, $circode, $mouzacode) {
   $this->dbswitch();
      $villages = $this->db->query("select *  from   location where dist_code =?  and  subdiv_code=? and cir_code=? and mouza_pargona_code=?  and lot_no!='00' and vill_townprt_code!='00000' order by vill_townprt_code",array($distCode,$subdivcode,$circode,$mouzacode));
      return $villages->result();
   }

   //getting patta types 
   public function getPattaType($dist_code) {
   $this->dbswitch($dist_code);
      $patta = $this->db->query("Select type_code,patta_type from patta_code order by type_code asc");
      return $patta->result();
   }

   //getting village name
   public function getVillageCodeJSON($distCode, $subdivcode, $circode, $mouzacode, $lotno) {
      $this->dbswitch();
      $district = $this->db->query("select distinct loc_name,vill_townprt_code from   location where "
               . "dist_code =?  and "
               . " subdiv_code=? and cir_code=? and mouza_pargona_code=? and "
               . " vill_townprt_code!='00000' and lot_no=? and nc_btad is null",array($distCode,$subdivcode,$circode,$mouzacode,$lotno));
      
      return $district->result();
   }

    //function created for displaying the district name
   public function getDistrictName($dist_code) {
      //$db=  $this->session->userdata('db');
      $this->dbswitch();
      $district = $this->db->query("select loc_name AS district from   location where dist_code ='$dist_code'  and "
               . " subdiv_code='00' and cir_code='00' and mouza_pargona_code='00' and "
               . " vill_townprt_code='00000' and lot_no='00'");
      return $district->result();
   }

   //function created for displaying the subdivision name
   public function getSubDivName($dist_code, $subdiv_code) {
      $this->dbswitch();
      //$db=  $this->session->userdata('db');
      $subdiv = $this->db->query("select loc_name AS subdiv from   location where dist_code ='$dist_code'  and "
               . " subdiv_code='$subdiv_code' and cir_code='00' and mouza_pargona_code='00' and "
               . " vill_townprt_code='00000' and lot_no='00'");
      return $subdiv->result();
   }

   //function created for displaying the circle name
   public function getCircleName($dist_code, $subdiv_code, $circle_code) {
      //$db=  $this->session->userdata('db');
         $this->dbswitch();
         $circle = $this->db->query("select loc_name AS circle from   location where dist_code ='$dist_code'  and "
                  . " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='00' and "
                  . " vill_townprt_code='00000' and lot_no='00'");
         return $circle->result();
   }

   //function created for displaying the mouza name
   public function getMouzaName($dist_code, $subdiv_code, $circle_code, $mouza_code) {
      //$db=  $this->session->userdata('db');
         $this->dbswitch();
         $mouza = $this->db->query("select loc_name AS mouza from   location where dist_code ='$dist_code'  and "
                  . " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
                  . " vill_townprt_code='00000' and lot_no='00'");
         return $mouza->result();
   }

   //function created for displaying the lot No
   public function getLotName($dist_code, $subdiv_code, $circle_code, $mouza_code, $lot_no) {
      //$db=  $this->session->userdata('db');
         $this->dbswitch();
         $lot = $this->db->query("select loc_name as lot_no from   location where dist_code ='$dist_code'  and "
                  . " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
                  . " vill_townprt_code='00000' and lot_no='$lot_no'");
         return $lot->result();
   }

   //function created for displaying the village name
   public function getVillageName($dist_code, $subdiv_code, $circle_code, $mouza_code, $lot_no, $vill_code) {
      //$db=  $this->session->userdata('db');
         $this->dbswitch();
         $village = $this->db->query("select loc_name AS village from   location where dist_code ='$dist_code'  and "
                  . " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
                  . " vill_townprt_code='$vill_code' and lot_no='$lot_no'");
         return $village->result();
   }

   //function to get pattadar name fro jamabandi
   public function getpattatypeNameforJamabandi($pattatypecode){
      $db=  $this->session->userdata('db');
      $village = $this->db->query("Select patta_type from   patta_code where Type_code='$pattatypecode'");
      return $village->result();
   }

   //function to get patta no for single patta
   public function getPattanoSingle($dist_code, $subdiv_code, $circle_code, $mouza_code, $lot_no, $vill_code, $patta_no) {
		$this->dbswitch();    
        $innerquery = $this->db->query("SELECT TRIM(jp.patta_no) AS patta_no,jp.pdar_name AS pdar_name,jp.p_flag AS p_flag,jp.pdar_father AS "
                . "pdar_father,jd.dag_no AS dag_no,jd.dag_revenue AS dag_revenue,jd.dag_localtax AS dag_localtax from  jama_pattadar AS jp JOIN "
                . "jama_dag AS jd ON TRIM(jd.patta_no)=TRIM(jp.patta_no) AND jp.dist_code=jd.dist_code AND jp.subdiv_code=jd.subdiv_code AND "
                . "jp.cir_code=jd.cir_code AND jp.mouza_pargona_code=jd.mouza_pargona_code AND jp.lot_no=jd.lot_no AND jp.vill_townprt_code= jd.vill_townprt_code "
                . "where jp.dist_code='$dist_code' and jp.subdiv_code='$subdiv_code' and jp.cir_code='$circle_code' and jp.mouza_pargona_code='$mouza_code' and "
                . "jp.lot_no='$lot_no' and jp.vill_townprt_code='$vill_code' and TRIM(jp.patta_no)='$patta_no' ");
        return $innerquery->result();
   }
}
?>