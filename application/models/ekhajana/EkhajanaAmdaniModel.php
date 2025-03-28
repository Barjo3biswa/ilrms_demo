<?php
class EkhajanaAmdaniModel extends CI_Model {

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

   //getting village list from mouza
   public function getVillageList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
      $this->dbswitch();
      $sql = "select a.loc_name, a.locname_eng, b.uuid from location a 
            join (select distinct uuid::bigint from current_doul_demand 
            where dist_code=? and subdiv_code=? and cir_code=? and 
            mouza_pargona_code=? and vill_townprt_code!=?) b on 
            a.uuid = b.uuid";
      $query = $this->db->query($sql,array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,'00000'));        
       return $query->result(); 
   }

   //patta type selection 
   public function getPattaType($village_uuid){
      $this->dbswitch();
      $sql = "select a.type_code, a.patta_type, a.pattatype_eng from patta_code a 
               join (select distinct patta_type_code from current_doul_demand 
               where uuid=?) b on a.type_code = b.patta_type_code";
      $query = $this->db->query($sql,$village_uuid);        
      return $query->result(); 
   }

   //to get the data of the no of cases
   public function getJamaWasilTransactionData($posted_data){
      $this->dbswitch();
      //return $posted_data;
      $start_date = $posted_data['start_date'];
      $end_date = $posted_data['to_date'];
      $village_uuid = $posted_data['village_uuid'];
      $patta_type_code = $posted_data['patta_type_code'];
      $patta_no = $_POST['patta_no'];


      $dist_code =$this->session->userdata['dist_code'];
      $subdiv_code =$this->session->userdata['subdiv_code'];
      $cir_code =$this->session->userdata['cir_code'];
      $mouza_code =$this->session->userdata['mouza_pargona_code'];


      $query = "select * from jama_wasil_transaction where date(created_at)  between '$start_date' and '$end_date' and
                dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and
                mouza_pargona_code='$mouza_code' and status ='offline'";

      if(isset($_POST['village_uuid']) && $_POST['village_uuid'] != 00){
         $query = $query. " and village_uuid = '$village_uuid'" ; 
      }

      if(isset($_POST['patta_type_code']) && $_POST['patta_type_code'] != 00){
         $query = $query. " and patta_type_code = '$patta_type_code'" ; 
      }

      if(isset($_POST['patta_no']) && $_POST['patta_no'] != 00){
         $query = $query. " and patta_no = '$patta_no'" ; 
      }

      $query = $this->db->query($query);
      return  $query->result(); 
   }

   //to count the no of cases
   public function getJamaWasilTransactionDataCount($posted_data){
      $this->dbswitch();
      $mouza_code =$this->session->userdata['mouza_pargona_code'];
      $query = $this->db->query("select count (*) from jama_wasil_transaction");
      return $query->row()->count;
   }   

   //function to check the patta type
   public function getPattaInfo($patta_info){
      $this->dbswitch();
      $query = $this->db->select('*')
                  ->where('type_code', $patta_info)
                  ->from('patta_code')
                  ->get(); 
         if($query->num_rows != 0){
            return  $query->result();
         }else{
            return [];
         }  
   }

   public function getAmdaniRptData($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$from_date,$to_date){
      //return $dist_code.$subdiv_code.$cir_code.$mouza_pargona_code.":".$from_date.":".$to_date;
      $this->db  = $this->load->database('rtpsmb', TRUE);
      $amdani_rpt_arr = array();
      $commision_details_query = $this->db->query("select * from ekhajana_commission_details where dist_code=?
            and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status=? and date(created_at) BETWEEN
            ? and ?", array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,'F', 
            $from_date,$to_date));
      //return $this->db->last_query();
      if($commision_details_query->num_rows() == 0){
         return $amdani_rpt_arr;
      }
      $commission_details =  $commision_details_query->result();
      foreach($commission_details as $commission_detail){
         //********************************************************/
         //getting pattadar name 
         // $land_details_query = $this->db->query("select * from ekhajana_land_details where dist_code=? and subdiv_code=?
         // and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? 
         // and patta_no=? and ld_application_no=? and status=?", array($commission_detail->dist_code, 
         // $commission_detail->subdiv_code,$commission_detail->cir_code,$commission_detail->mouza_pargona_code,
         // $commission_detail->lot_no,$commission_detail->vill_townprt_code,$commission_detail->patta_type_code,
         // $commission_detail->patta_no,$commission_detail->ld_application_no, 'F'));
         // $land_details =  $land_details_query->row();
         //********************************************************/
         $land_details_query = $this->db->query("select eld.id as receipt_number,* from ekhajana_land_details eld join ekhajana_egras_log egl
         on eld.application_no=egl.application_no where eld.dist_code=? and eld.subdiv_code=?
         and eld.cir_code=? and eld.mouza_pargona_code=? and eld.lot_no=? and eld.vill_townprt_code=? 
         and eld.patta_type_code=? and eld.patta_no=? and eld.ld_application_no=? and eld.status=? 
         and eld.repayment_flag in ('G','1')", array($commission_detail->dist_code, 
         $commission_detail->subdiv_code,$commission_detail->cir_code,$commission_detail->mouza_pargona_code,
         $commission_detail->lot_no,$commission_detail->vill_townprt_code,$commission_detail->patta_type_code,
         $commission_detail->patta_no,$commission_detail->ld_application_no, 'F'));
         $land_details =  $land_details_query->row();
         if(isset(json_decode($land_details->egras_response)->gras_response->data->GRN)){
            $grn_no = json_decode($land_details->egras_response)->gras_response->data->GRN;
	 }elseif(isset(json_decode($land_details->egras_response)->GRN)){
            $grn_no = json_decode($land_details->egras_response)->GRN;
         }else{
            $grn_no = "NOT-FOUND";
         }
 
         $ts = strtotime($commission_detail->created_at);
         $date = date("D M d Y", $ts);

         array_push($amdani_rpt_arr,[
            "dist_code" => $commission_detail->dist_code,
            "subdiv_code" => $commission_detail->subdiv_code,
            "cir_code" => $commission_detail->cir_code,
            "mouza_pargona_code" => $commission_detail->mouza_pargona_code,
            "lot_no" => $commission_detail->lot_no,
            "vill_townprt_code" => $commission_detail->vill_townprt_code,
            "patta_type_code" => $commission_detail->patta_type_code,
            "patta_type" => $land_details->patta_type,
            "patta_no" => $commission_detail->patta_no,
            "pattadar_name" => $land_details->pdar_name,
            "current_revenue" => $commission_detail->current_year_revenue,
            "current_local_tax" => $commission_detail->current_year_local_tax,
            'total_arrear' => $commission_detail->total_arrear,
            'total_khajana' => $commission_detail->total_khajana,
            'grn_no' => $grn_no, 
            'receipt_number'=> $land_details->receipt_number,
	    'rtps_app_no' => $land_details->ld_application_no,
	    'payment_date' =>  $date
         ]);
      }
      //return $amdani_rpt_arr;
      //calculating total khajana
      $total_khajana = 0;
      foreach($amdani_rpt_arr as $amdani_rpt){
         $total_khajana = $total_khajana + $amdani_rpt['total_khajana'];
      }
      return [
         'amdani_rpt_arr' => $amdani_rpt_arr,
         'total_khajana' => $total_khajana
      ];
   }
}
