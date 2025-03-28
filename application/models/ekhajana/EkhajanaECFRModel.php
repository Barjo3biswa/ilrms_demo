<?php

class EkhajanaECFRModel extends CI_Model {

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
   } else if($this->session->userdata('dist_code') == "39"){
      $this->db=$CI->load->database('bajali', TRUE);
   }     
   return $this->db;                                                                                                                                                                                           
   }    
    
   //getting ekhajana land details from the ld application no 
   public function getEkhajanaLandDetails($ld_application_no){        
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
      $land_details_query = $this->db->query("select * from ekhajana_land_details where ld_application_no=?", array($ld_application_no));
      //return $land_details_query->num_rows();
      if($land_details_query->num_rows() == 1){
         $land_details = $land_details_query->row();
         return ['flag' => 'Y', 'data' => $land_details];
      }else{
         return ['flag' => 'N', 'msg' => "No Records Found For The Land-Application-No : ". $ld_application_no];
      }
   }

   //getting arrear details 
   public function getArrearDetails($ekhajana_land_details){        
      $this->db = $this->dbswitch();
      $arrer_details_query = $this->db->query("select * from ekhajana_arrear_pre_updation where dist_code=?
      and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and 
      patta_type_code=? and patta_no=?", array($ekhajana_land_details->dist_code,
      $ekhajana_land_details->subdiv_code,$ekhajana_land_details->cir_code,
      $ekhajana_land_details->mouza_pargona_code, $ekhajana_land_details->lot_no,
      $ekhajana_land_details->vill_townprt_code, $ekhajana_land_details->patta_type_code,
      $ekhajana_land_details->patta_no));       

      //log_message("error", "#errEKHecfrPreQ1 last query is ". json_encode($this->db->last_query()));
  

      if($arrer_details_query->num_rows() != 1){
         return ['flag' => 'N', 'msg' => "Arrear Details Not Found For The Land-Application-No : ". $ekhajana_land_details->ld_application_no];            
      }else{
         $arrear_details = $arrer_details_query->row();
         return ['flag' => 'Y', 'data' => $arrear_details];
      }
   }

   //get year wise arrear details 
   public function getYearWiseArearDetails($arrear_details_id){
      $this->db = $this->dbswitch();
      $year_wise_arrer_details_query = $this->db->query("select * from ekhajana_year_wise_arrear where pre_arrear_id=?", array($arrear_details_id));
      if($year_wise_arrer_details_query->num_rows() == 0){
         return ['flag' => 'N', 'msg' => "Year Wise Arrear Details Not Found For The Land-Application-No : ". $ekhajana_land_details->ld_application_no];            
      }else{
         $year_wise_arrer_details_query = $year_wise_arrer_details_query->result();
         return ['flag' => 'Y', 'data' => json_encode($year_wise_arrer_details_query)];
      }
   }

   //getting current doul details 
   public function getCurrentDoulDetails($ekhajana_land_details){
      $this->db = $this->dbswitch();
      $current_doul_query = $this->db->query("select * from current_doul_demand where dist_code=?
      and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=?
      and patta_type_code=? and patta_no=?", array($ekhajana_land_details->dist_code,
      $ekhajana_land_details->subdiv_code,$ekhajana_land_details->cir_code,
      $ekhajana_land_details->mouza_pargona_code, $ekhajana_land_details->lot_no,
      $ekhajana_land_details->vill_townprt_code, $ekhajana_land_details->patta_type_code,
      $ekhajana_land_details->patta_no));
      if($current_doul_query->num_rows() != 1){
         return ['flag' => 'N', 'msg' => "Current Doul Details Not Found For The Land-Application-No : ". $ekhajana_land_details->ld_application_no];            
      }else{
         $current_doul_details = $current_doul_query->row();
         return ['flag' => 'Y', 'data' => $current_doul_details];
      }
   }

   //insert details into ecfr table
   public function insertECFRDetails($insert_details_for_ekhajana_ecfr_details){
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
      $this->db->trans_begin();
      $tstatus1 = $this->db->insert('ekhajana_ecfr_details', $insert_details_for_ekhajana_ecfr_details); 
      if ($tstatus1!= 1)
      {
         $this->db->trans_rollback();
         log_message("error", "#EKHECFRINSERR001, Error in insert on ekhajana_ecfr_details table with data ". json_encode($insert_details_for_ekhajana_ecfr_details));
         return ['flag' => 'N', 'msg' => "Some Error Occured, Err-Code: #EKHECFRINSERR001",'last_id' =>null];            
      }else{
         $last_id = $this->db->insert_id();
         return ['flag' => 'Y', 'data' => "e-CFR Details Submitted Successfully" ,'last_id' => $last_id];
      }
      
   }

   //method to insert into ecfr transaction table
   public function insertECFRTransaction($insert_ekhajana_ecfr_trans)
   {
      $tstatus1 = $this->db->insert('ekhajana_ecfr_details_transactions', $insert_ekhajana_ecfr_trans); 
      if ($tstatus1!= 1)
      {
         $this->db->trans_rollback();
         log_message("error", "#EKHECFRINSERR585, Error in insert on ekhajana_ecfr_details_transactions table with data ". json_encode($insert_details_for_ekhajana_ecfr_details));
         return ['flag' => 'N', 'msg' => "Some Error Occured, Err-Code: #EKHECFRINSERR585"];            
      }else{
         
         $this->db->trans_commit();
         return ['flag' => 'Y', 'data' => "e-CFR Details Submitted Successfully"];
      }
   }

   //method to get details of ecfr data from ld application no 
   public function getEcfDetailsFromLdAppNo($ld_application_no)
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
      $query = $this->db->query("select * from ekhajana_ecfr_details where ld_application_no =?",array($ld_application_no));
      if($query->num_rows() ==0)
      {
         return "NO-DATA-FOUND";
      }else{
         return $query->row();
      }
   }

   //method to get all  ecfr data
   public function getAllEcfDetails()
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
      $dist_code = $this->session->userdata('dist_code');
      $subdiv_code= $this->session->userdata('subdiv_code');
      $cir_code =$this->session->userdata('cir_code');
      $mouza_pargona_code= $this->session->userdata('mouza_pargona_code'); 
      $query = $this->db->query("select * from ekhajana_ecfr_details where dist_code=? and subdiv_code=? and cir_code=?
                   and mouza_pargona_code=? and status in ('G','P','F')",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
      if($query->num_rows() ==0)
      {
         return [];
      }else{
         return $query->result();
      }
   }

   //method to get ecfr details from id
   public function getEcfDetailsFromId($id)
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE); 
      $query = $this->db->query("select * from ekhajana_ecfr_details where id =? and status =?",array($id,'G'));
      if($query->num_rows() ==0)
      {
         return "No-Data-Found";
      }else{
         return $query->row();
      }
   }

   //method to check whether ecfr is generated or not
   public function checkPathExist($ld_application_no)
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE); 
      $query = $this->db->query("select * from ekhajana_ecfr_details where ld_application_no =? and status in('G','F')",array($ld_application_no));
      if($query->num_rows() ==0)
      {
         return ['flag' => "N" , "msg" => null];
      }else{
         return ['flag' => "Y" , "msg" => $query->row()];
      }
   }

   //method to insert into ecfr transaction after generating ecfr certificate
   public function insertEcfrTransactionAfterGenerate($ld_application_no)
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE); 
      $query = $this->db->query("select * from ekhajana_ecfr_details where ld_application_no =? and status =?",array($ld_application_no,'G'));
      if($query->num_rows() ==0)
      {
         return ['flag' => "N" , "msg" => "Some Error Occurred #ERR29082024"];
      }
      else{
	 $row = $query->row();
         $breakdown_json = $this->db->query("select * from ekhajana_ecfr_arrear_breakdown where ld_application_no=?",array($row->ld_application_no))->row();
         $insert_ekhajana_ecfr_trans = [
            "ekhajana_ecfr_details_id" =>$row->id,
            "application_no"           =>$row->application_no,
            "ld_application_no"        =>$row->ld_application_no,
            "dist_code"                =>$row->dist_code,
            "subdiv_code"              =>$row->subdiv_code,
            "cir_code"                 =>$row->cir_code,
            "mouza_pargona_code"       =>$row->mouza_pargona_code,
            "lot_no"                   =>$row->lot_no,
            "vill_townprt_code"        =>$row->vill_townprt_code,
            "village_uuid"             =>$row->village_uuid,
            "patta_type_code"          =>$row->patta_type_code,
            "patta_no"                 =>$row->patta_no,
            "pdar_id"                  =>$row->pdar_id,
            "pdar_name"                =>trim($row->pdar_name),
            "pdar_father_name"         =>trim($row->pdar_father_name),
            "status"                   =>'G',
            "digital_payment_status"   =>'P',
            "due_amount"               =>$row->due_amount,
            "total_arrear"             =>$row->total_arrear,
            "arrear_revenue"           =>$row->arrear_revenue,
            "arrear_local_tax"         =>$row->arrear_local_tax,
            "year_wise_arrear_details" =>$breakdown_json->arrear_breakdown_json,
            "current_revenue"          =>$row->current_revenue,
            "current_local_tax"        =>$row->current_local_tax,
            "miran"                    =>0,
            "surcharge"                =>0,
            "doul_year"                =>doul_year_no,
            "revenue_year"             =>$row->revenue_year,
            "user_details"             =>$row->user_details,
            "mouzadar_name"            =>$row->mouzadar_name,
	    "created_at"               =>date('Y-m-d h:i:s'),       
	    //"ecfr_arrear_breakdown_id" =>$row->ecfr_arrear_breakdown_id, 
         ];
         $tstatus1 = $this->db->insert('ekhajana_ecfr_details_transactions', $insert_ekhajana_ecfr_trans); 
         if ($tstatus1!= 1)
         {
            $this->db->trans_rollback();
            log_message("error", "#EKHECFRINSE336, Error in insert on ekhajana_ecfr_details_transactions table with data ". json_encode($insert_details_for_ekhajana_ecfr_details));
            return ['flag' => 'N', 'msg' => "Some Error Occured, Err-Code: #EKHECFRINSE336"];            
         }else{
            return ['flag' => 'Y', 'data' => "Successfully"];
         }

      }
   }

   //method to encrypt ld application no before sending to rtpsmb
   public function encryptData($ld_application_no)
   {
      $this->load->library('AES');
      $encrypt_app_no      =new AES($ld_application_no, EKHAJANA_ECFR_ENCRYPTION_KEY);
      $enc                 = $encrypt_app_no->encrypt();
      $newStringEncrptData = str_replace("@","/",$enc);
      return $newStringEncrptData;
   }

   public function checkEcfrGenerartedForPatta($land_Details)
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE); 
      $query = $this->db->query("select * from ekhajana_ecfr_details where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",
      array($land_Details->dist_code,$land_Details->subdiv_code,$land_Details->cir_code,$land_Details->mouza_pargona_code,$land_Details->lot_no,$land_Details->vill_townprt_code,$land_Details->patta_type_code,$land_Details->patta_no));
      //return $this->db->last_query();      
      if($query->num_rows() ==0)
      {
         return ['flag' => "Y" , "msg" => null];
      }else{
         return['flag' => "N" , "msg" => "e-CFR is already been generated for this patta, Kindly download the e-CFR from the view Cfr List for this Patta..!!!"];
      }
   }

   public function checkPaymentDone($ekhajana_land_details)
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
      $query = $this->db->query("select * from ekhajana_land_details eld join ekhajana_payment ep on eld.ld_application_no = ep.ld_application_no where eld.dist_code=?
        and eld.subdiv_code=? and eld.cir_code=? and eld.mouza_pargona_code=? and eld.lot_no=? and eld.vill_townprt_code=? and eld.patta_type_code=?
        and eld.patta_no=? and ep.status=? and eld.status in('RE_P','F') and eld.repayment_flag='1'",array($ekhajana_land_details->dist_code,$ekhajana_land_details->subdiv_code,$ekhajana_land_details->cir_code,$ekhajana_land_details->mouza_pargona_code,$ekhajana_land_details->lot_no,$ekhajana_land_details->vill_townprt_code,
        $ekhajana_land_details->patta_type_code,$ekhajana_land_details->patta_no,'F'));
      if($query->num_rows() >0)
      {
         return ['flag' => "N" , "msg" => "Payment has Already been done for the Patta, Therefore e-CFR cannot be generated for this Patta"];
      }else{
         return['flag' => "Y" , "msg" => null];
      } 
   }

   public function checkKhajanaReceiptExist($ld_application_no)
   {
      $query = $this->db->query("select * from ekhajana_ecfr_details where ld_application_no =? and status =? and digital_payment_status=?",array($ld_application_no,'F','F'));
      if($query->num_rows() ==0)
      {
         return ['flag' => "N" , "msg" => null];
      }else{
         return ['flag' => "Y" , "msg" => $query->row()];
      }
   }

   public function getMouzadarName($ekhajana_land_details)
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
      $mouzadar_bank_details = $this->db->query("select * from ekhajana_mouzadar_account_details where dist_code=?
            and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status=? ", array($ekhajana_land_details->dist_code,
            $ekhajana_land_details->subdiv_code,$ekhajana_land_details->cir_code,
            $ekhajana_land_details->mouza_pargona_code,'A')); 
      if($mouzadar_bank_details->num_rows() ==0)
      {
         return ['flag' =>'N', 'msg' =>"Some Error Occurred...! Mouzadar's Name Could not be Fetched"];
      }else{
         return ['flag' => 'Y', 'msg' =>$mouzadar_bank_details->row()->account_name];
      }
   }


   public function insertECFRBreakDownDetails($insert_details_for_ecfr_breakdown)
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
      $this->db->trans_begin();
      $tstatus1 = $this->db->insert('ekhajana_ecfr_arrear_breakdown', $insert_details_for_ecfr_breakdown);
      if ($tstatus1!= 1)
      {
         $this->db->trans_rollback();
         log_message("error", "#EKHECFRINSERR0017354, Error in insert on ekhajana_ecfr_arrear_breakdown table with data ". json_encode($insert_details_for_ecfr_breakdown));
         return ['flag' => 'N', 'msg' => "Some Error Occured, Err-Code: #EKHECFRINSERR0017354",'last_id' =>null];
      }else{
         $last_id = $this->db->insert_id();
         return ['flag' => 'Y', 'data' => "e-CFR Details inserted to breakdown Successfully" ,'last_id' => $last_id];
      }
   }
   public function getArrearBreakdownFromEcfrBreakdownTable($id)
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
      $query = $this->db->query("select * from ekhajana_ecfr_arrear_breakdown where id =?",array($id));
      if($query->num_rows() ==1){
         return ['flag' =>'Y' , 'msg' => $query->row()->arrear_breakdown_json];
      }else{
         return ['flag' => 'N' , 'msg' => "Some Error Occurred Please Try Again #ERR0309241335"];
      }
   }


   //getting revenue year from created at
   public function getRevenueYearFromCreatedAt($created_at){
      $year = date('Y',strtotime($created_at));
      if (date('m',strtotime($created_at)) <= 6) {
      $revenue_year = ($year-1)."-".$year;
      } else {
      $revenue_year = $year."-".($year+1);
      }
      return $revenue_year;
   }


   public function getEcfrPaymentAvailableList(){
	
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
      $dist_code = $this->session->userdata('dist_code');
      $subdiv_code= $this->session->userdata('subdiv_code');
      $cir_code =$this->session->userdata('cir_code');
      $mouza_pargona_code= $this->session->userdata('mouza_pargona_code');
      $query = $this->db->query("select * from ekhajana_ecfr_details ecf join ekhajana_land_details                                 eld on ecf.ld_application_no=eld.ld_application_no
                                 where ecf.dist_code=? and ecf.subdiv_code=? and ecf.cir_code=?
				 and ecf.mouza_pargona_code=? and eld.status='F' and 
                                 ecf.digital_payment_status!='F' and ecf.status in('G','P')",
                                 array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
      if($query->num_rows() ==0)
      {
         return [];
      }else{
         return $query->result();
      }

   }	

   public function checkDpFlagged_old($ekhajana_land_details)
   {
      $this->db = $this->dbswitch();
      $dp_flagging = $this->db->query("select * from chitha_basic where dist_code=?
      and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and
      patta_type_code=? and patta_no=?", array($ekhajana_land_details->dist_code,
      $ekhajana_land_details->subdiv_code,$ekhajana_land_details->cir_code,
      $ekhajana_land_details->mouza_pargona_code, $ekhajana_land_details->lot_no,
      $ekhajana_land_details->vill_townprt_code, $ekhajana_land_details->patta_type_code,
      $ekhajana_land_details->patta_no));
      if($dp_flagging->num_rows() ==0)
      {
         return ['flag' => 'N', 'msg' => "#ERR110944 No Data Found For Patta No : ".$ekhajana_land_details->patta_no];
      }
      else
      {
         $chitha_row = $dp_flagging->row();
         if($chitha_row->dp_flag_yn == 'Y' || $chitha_row->dp_flag_yn == 'y'){
            return ['flag' => 'N', 'msg' => "#ERR110945 Patta Is Found To Be Dp Flagged, Cannot Procceed with Patta No: ".$ekhajana_land_details->patta_no];
         }else{
            return ['flag' => 'Y', 'msg' => "Proceed"];
         }
      }
   }
   public function checkMb2Patta($ekhajana_land_details)
   {
      $this->db = $this->dbswitch();
      $checkmb2 = $this->db->query("select * from chitha_basic where dist_code=?
      and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and
      patta_type_code=? and patta_no=?", array($ekhajana_land_details->dist_code,
      $ekhajana_land_details->subdiv_code,$ekhajana_land_details->cir_code,
      $ekhajana_land_details->mouza_pargona_code, $ekhajana_land_details->lot_no,
      $ekhajana_land_details->vill_townprt_code, $ekhajana_land_details->patta_type_code,
      $ekhajana_land_details->patta_no));
      if($checkmb2->num_rows() ==0)
      {
         return ['flag' => 'N', 'msg' => "#ERR110946 No Data Found For Patta No : ".$ekhajana_land_details->patta_no];
      }
      else
      {
         $possession_form  = $checkmb2->row()->possession_from;
         if($possession_form!= null || $possession_form!= "")
         {
               return ['flag' => 'N', 'msg' => "#ERR110947 The Patta Is Generated Under Mission Basundhara 2, hence ECFR Cannot be Generated, Kindly Ask Pattadar To pay Through sewa setu under 'Mission Basundhara 2.0 Patta Payment' in e-Khajana service..!!"];
         }else{
               return ['flag' => 'Y', 'msg' => "Proceed"];
         }
      }
   }   


   public function checkDpFlagged($ekhajana_land_details)
   {
      $this->db = $this->dbswitch();
  
      //**********************************************************************/
      //checking chitha rows 
      $chitha_query_1 = $this->db->query("select * from chitha_basic where dist_code=? and subdiv_code=?
      and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=?
      and trim(patta_no)=?", array($ekhajana_land_details->dist_code,
      $ekhajana_land_details->subdiv_code,$ekhajana_land_details->cir_code,
      $ekhajana_land_details->mouza_pargona_code, $ekhajana_land_details->lot_no,
      $ekhajana_land_details->vill_townprt_code, $ekhajana_land_details->patta_type_code,
      trim($ekhajana_land_details->patta_no)));
      if($chitha_query_1->num_rows() == 0){
         return ['flag' => 'N', 'msg' => "Patta is currently doesn't exist in chitha, Patta No: ".$ekhajana_land_details->patta_no];
      }
      //**********************************************************************/

      $chitha_query = $this->db->query("select * from chitha_basic where dist_code=? and subdiv_code=?
      and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=?
      and patta_no=? and dp_flag_yn=?", array($ekhajana_land_details->dist_code,
      $ekhajana_land_details->subdiv_code,$ekhajana_land_details->cir_code,
      $ekhajana_land_details->mouza_pargona_code, $ekhajana_land_details->lot_no,
      $ekhajana_land_details->vill_townprt_code, $ekhajana_land_details->patta_type_code,
      $ekhajana_land_details->patta_no,'Y'));
      
      if($chitha_query->num_rows() == 0){
         return ['flag' => 'Y', 'msg' => "Proceed"];
      }else{
         $jama_query = $this->db->query("select * from jama_dag where dist_code=? and subdiv_code=?
         and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=?
         and patta_no=? and dp_flag_yn=?", array($ekhajana_land_details->dist_code,
         $ekhajana_land_details->subdiv_code,$ekhajana_land_details->cir_code,
         $ekhajana_land_details->mouza_pargona_code, $ekhajana_land_details->lot_no,
         $ekhajana_land_details->vill_townprt_code, $ekhajana_land_details->patta_type_code,
         $ekhajana_land_details->patta_no,'Y'));
         if($jama_query->num_rows() == 0){
            return ['flag' => 'Y', 'msg' => "Proceed"];
         }else{
            return ['flag' => 'N', 'msg' => "Patta Is Found To Be Dp Flagged, Cannot Procceed with Patta No: ".$ekhajana_land_details->patta_no];
         }
      }
   }

}

