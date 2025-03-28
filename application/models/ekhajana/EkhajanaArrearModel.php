<?php
class EkhajanaArrearModel extends CI_Model {
    
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
      }   else if($this->session->userdata('dist_code') == "39"){
         $this->db=$CI->load->database('bajali', TRUE);
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

   //getting village list from mouza
   public function getVillageList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
      $this->dbswitch();
      $sql = "select a.loc_name, a.locname_eng, b.uuid ,a.lot_no, a.vill_townprt_code from location a 
               join (select distinct uuid::bigint from location 
               where dist_code=? and subdiv_code=? and cir_code=? and 
               mouza_pargona_code=? and lot_no!=? and vill_townprt_code!=?) b on 
               a.uuid = b.uuid";
      $query = $this->db->query($sql,array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,'00','00000'));        
      return $query->result(); 
   }

   //patta type selection 
   public function getPattaType(){
      $this->dbswitch();
      $sql = "Select type_code,patta_type,pattatype_eng from patta_code order by type_code asc";
      $query = $this->db->query($sql);        
      return $query->result(); 
   }

   //inserting pre arrear data 
   public function insertPreArrearData($posted_data,$data,$vill_townprt_code,$lot_no,$village_uuid)
   { 
      if(date('m') <= 6){
         $doul_year = date('Y');
      }else{
         $doul_year = date('Y') + 1;
      }
      $query = $this->db->select('*')
                          ->where('dist_code', $posted_data['dist_code'])
                          ->where('subdiv_code', $posted_data['subdiv_code'])
                          ->where('cir_code', $posted_data['cir_code'])
                          ->where('mouza_pargona_code', $posted_data['mouza_pargona_code'])
                          ->where('lot_no', $lot_no)
                          ->where('vill_townprt_code', $vill_townprt_code)
                          ->where('village_uuid', $village_uuid)
                          ->where('patta_type_code', $posted_data['patta_type_code'])
                          ->where('patta_no', $posted_data['patta_no'])
                          ->from('ekhajana_arrear_pre_updation')
                          ->get();
      
      if($query->num_rows()>= 1){
         $this->db->trans_rollback();
            log_message("error", "#EKHIPAD005, arrear of the patta already exist");
            return ['result' => 'SERVER-ERROR', 'msg' => '#EKHIPAD005, Arrear for the Patta No: '.$posted_data['patta_no'].'is already submitted '];
         }
      $insertPreArrearData = [
         "dist_code" => $posted_data['dist_code'],
         "subdiv_code" => $posted_data['subdiv_code'],
         "cir_code" => $posted_data['cir_code'],
         "mouza_pargona_code" => $posted_data['mouza_pargona_code'],
         "lot_no" => $lot_no,
         "vill_townprt_code" => $vill_townprt_code,
         "village_uuid" => $village_uuid,
         "patta_type_code" => $posted_data['patta_type_code'],
         "patta_no" => $posted_data['patta_no'],
         "arrear" => $posted_data['total_arrear'],
         "revenue" => $posted_data['total_revenue'],
         "tax" => $posted_data['total_tax'],
         "status" => EKHAJANA_AREEAR_PRE_UPDATED,
         "created_at" => date('Y-m-d h:i:s'),
         "modified_at" => null,
         'user_code' => $this->session->all_userdata()['user_code'],
         'doul_year_no' => $doul_year,
         'previous_arrears' => json_encode($_POST),
         'application_under' => 'MOUZADAR'
      ];
      $this->dbswitch();
      $this->db->trans_begin();
      $tstatus1 = $this->db->insert('ekhajana_arrear_pre_updation', $insertPreArrearData);
      if ($tstatus1!= 1)
         {
            $this->db->trans_rollback();
            log_message("error", "#EKHIPAD001, Error in insert on ekhajana_arrear_pre_updation table with data ". json_encode($insertPreArrearData));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIPAD001'];
         }
      $ekhajanaPreArrearInsertId = $this->db->insert_id();   
   
      foreach($data as $row){
         $year_arrear = $row['arear'];
         if($year_arrear == null){
            $year_arrear =0;
         }
         $year_revenue = $row['revenue'];
         if($year_revenue == null){
            $year_revenue =0;
         }
         $year_tax = $row['tax'];
         if($year_tax == null){
            $year_tax =0;
         }
         $year_wise_arrear= array(
               'pre_arrear_id' => $ekhajanaPreArrearInsertId,
               'dist_code' => $posted_data['dist_code'],
               'subdiv_code' => $posted_data['subdiv_code'],
               'cir_code' => $posted_data['cir_code'],            
               'mouza_pargona_code' => $posted_data['mouza_pargona_code'],
               "lot_no" => $lot_no,
               "vill_townprt_code" => $vill_townprt_code,
               'village_uuid' => $village_uuid,
               'patta_type_code' => $posted_data['patta_type_code'],
               'patta_no' => $posted_data['patta_no'],
               'total_arrear' => $posted_data['total_arrear'],
               'total_revenue' => $posted_data['total_revenue'],
               'total_tax' => $posted_data['total_tax'],
               'user_code' => $this->session->all_userdata()['user_code'],
               'financial_year' => $row['year'],
               'year_arrear' =>  $year_arrear,
               'year_revenue' =>  $year_revenue,
               'year_tax' =>  $year_tax,
               "created_at" => date('Y-m-d h:i:s'),
               'modified_at' => null,
               "status" => EKHAJANA_AREEAR_PRE_UPDATED,
	       "revenue_year" => substr($row['year'],5),
	       'application_under' => 'MOUZADAR'
            );
            $tstatus3 = $this->db->insert('ekhajana_year_wise_arrear', $year_wise_arrear);
         }
         if ($tstatus3 <= 0)
         {
            $this->db->trans_rollback();
            log_message("error", "#EKHIPAD002, Error in insert on ekhajana_year_wise_arrear table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIPAD002'];
         }
      else
         {
            $this->db->trans_commit();
            return ['result' => 'SUCCESS', 'msg' => 'Arrear Data Inserted Successfully'];  
         }
   }

   //fetching arrear data of the patta
   public function fetchArrearData($land_details)
   {
      if(date('m') <= 6){
         $doul_year = date('Y');
      }else{
         $doul_year = date('Y') + 1;
      }
      $query = $this->db->select('*')
                     ->where('dist_code', $land_details->dist_code)
                     ->where('cir_code', $land_details->cir_code)
                     ->where('subdiv_code', $land_details->subdiv_code)
                     ->where('mouza_pargona_code', $land_details->mouza_pargona_code)
                     ->where('village_uuid', $land_details->village_uuid)
                     ->where('patta_type_code', $land_details->patta_type_code)
                     ->where('patta_no', $land_details->patta_no)
                     ->where('doul_year_no', (string)$doul_year)
                     ->from('ekhajana_arrear_pre_updation')
                     ->get();
         if($query->num_rows() != 0){
            return  $query->row();
         }else{
            return "NO DATA FOUND";
         }
   }

   //GETTING UPDATED ARREARS LIST 
   public function getUpdatedArrears($dist_code,$subdiv_code,$cir_code,$mouza_code){
      $this->dbswitch();

      $query = $this->db->query("select * from ekhajana_arrear_pre_updation where ROW(dist_code, subdiv_code, cir_code,
      mouza_pargona_code, lot_no, vill_townprt_code, patta_type_code, patta_no) not in
      (select dist_code, subdiv_code, cir_code, mouza_pargona_code, lot_no, vill_townprt_code, patta_type_code, patta_no from jama_wasil
      where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?)
      and dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?",array($dist_code,$subdiv_code,$cir_code,$mouza_code,
      $dist_code,$subdiv_code,$cir_code,$mouza_code));


      /*
      $query = $this->db->query("select * from ekhajana_arrear_pre_updation where ROW(dist_code, subdiv_code, cir_code,
      mouza_pargona_code, lot_no, vill_townprt_code, patta_type_code, patta_no) not in
      (select dist_code, subdiv_code, cir_code, mouza_pargona_code, lot_no, vill_townprt_code, patta_type_code, patta_no from jama_wasil)
      and dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?",array($dist_code,$subdiv_code,$cir_code,$mouza_code));      
      $query = $this->db->select('*')
                            ->where('dist_code',$dist_code)
                            ->where('subdiv_code',$subdiv_code)
                            ->where('cir_code',$cir_code)
                            ->where('mouza_pargona_code',$mouza_code)
			    ->get('ekhajana_arrear_pre_updation');
       */
      if($query->num_rows() != 0){
         $arrear_details =  $query->result(); 
      }else{
         $arrear_details =  []; 
      }
      return $arrear_details;
   }

   //getting year wise arrear from arrear id 
   public function getYearWiseArrearDetailsFromArrearId($id){
      $this->dbswitch();
      $result = $this->db->query("select * from ekhajana_year_wise_arrear where pre_arrear_id=? order by financial_year asc",array($id))->result();
      return $result;
   }
   public function insertArrearTransactiondata($pre_arrear_id)
   {
      $this->dbswitch();
      $pre_arrear_updation_row = $this->db->query("select * from ekhajana_arrear_pre_updation where id=? ",array($pre_arrear_id))->result();
      $year_wise_arrear_data = $this->db->query("select * from ekhajana_year_wise_arrear where pre_arrear_id =? order by id asc", array($pre_arrear_id))->result();
      
      $pre_arrear_id       = $pre_arrear_updation_row[0]->id;
      $dist_code           = $pre_arrear_updation_row[0]->dist_code;
      $subdiv_code         = $pre_arrear_updation_row[0]->subdiv_code;
      $cir_code            = $pre_arrear_updation_row[0]->cir_code;
      $mouza_pargona_code  = $pre_arrear_updation_row[0]->mouza_pargona_code;
      $lot_no              = $pre_arrear_updation_row[0]->lot_no;
      $vill_townprt_code   = $pre_arrear_updation_row[0]->vill_townprt_code;
      $patta_type_code     = $pre_arrear_updation_row[0]->patta_type_code;
      $patta_no            = $pre_arrear_updation_row[0]->patta_no;
      $total_arrear        = $pre_arrear_updation_row[0]->arrear;
      $total_revenue       = $pre_arrear_updation_row[0]->revenue;
      $total_local_tax     = $pre_arrear_updation_row[0]->tax;
      $user_code           = $pre_arrear_updation_row[0]->user_code;
      $status              = $pre_arrear_updation_row[0]->status;

      $insertTransactionData = [
         "pre_arrear_id"         => $pre_arrear_id,
         "dist_code"             => $dist_code,
         "subdiv_code"           => $subdiv_code,
         "cir_code"              => $cir_code ,
         "mouza_pargona_code"    => $mouza_pargona_code,
         "lot_no"                => $lot_no,
         "vill_townprt_code"     => $vill_townprt_code,
         "patta_type_code"       => $patta_type_code,
         "patta_no"              => $patta_no,
         "total_arrear"          => $total_arrear,
         "total_revenue"         => $total_revenue,
         "total_local_tax"       => $total_local_tax,
         "user_code"             => $user_code,
         'status'                => $status,
         "created_at"            => date('Y-m-d h:i:s'),
         "modified_at"           => null,
         "arrear_pre_json"       => json_encode($pre_arrear_updation_row),
         "year_wise_arrear_json" => json_encode($year_wise_arrear_data),
      ];
      $tstatus3 = $this->db->insert('ekhajana_arrear_pre_updation_transactions', $insertTransactionData); 
      if ($tstatus3!= 1)
      {
            $this->db->trans_rollback();
            log_message("error", "#EKAPRT001, Error in insert on ekhajana_arrear_pre_updation_transactions table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKAPRT001'];
      }else{
            return ['result' => 'SUCCESS', 'msg' => 'DATA INSERTED SUCCESSFULLY']; 
      }
   }

   public function updatePreArrearUpdation($pre_arrear_id,$update_array,$previous_arrears)
   { 
      $year_wise_arrear_with_priorF_query = $this->db->query("select * from ekhajana_year_wise_arrear where pre_arrear_id=?
      and financial_year=?",array($pre_arrear_id, '0000-2000'));
      if($year_wise_arrear_with_priorF_query->num_rows() == 0){
         $prior2000Flag = true;
      }else{
         $prior2000Flag = false;
      }
      $pre_arrear_updation_row = $this->db->query("select * from ekhajana_arrear_pre_updation where id=? ",array($pre_arrear_id))->result();

      $previous_arrears['dist_code']= $dist_code = $pre_arrear_updation_row[0]->dist_code;
      $previous_arrears['subdiv_code']= $subdiv_code = $pre_arrear_updation_row[0]->subdiv_code;
      $previous_arrears['cir_code']=$cir_code = $pre_arrear_updation_row[0]->cir_code;
      $previous_arrears['mouza_pargona_code']= $mouza_pargona_code = $pre_arrear_updation_row[0]->mouza_pargona_code;
      $lot_no = $pre_arrear_updation_row[0]->lot_no;
      $vill_townprt_code = $pre_arrear_updation_row[0]->vill_townprt_code;
      $previous_arrears['patta_type_code']= $patta_type_code = $pre_arrear_updation_row[0]->patta_type_code;
      $previous_arrears['patta_no']= $patta_no = $pre_arrear_updation_row[0]->patta_no;
      $previous_arrears['location']=$pre_arrear_updation_row[0]->village_uuid."|". $vill_townprt_code. "|". $lot_no;

      //inserting the prior to 2000 field in case if not submited before
      if($prior2000Flag){
         $year_wise_arrear= array(
            'pre_arrear_id'      => $pre_arrear_id,
            'dist_code'          => $dist_code,
            'subdiv_code'        => $subdiv_code,
            'cir_code'           => $cir_code,
            'mouza_pargona_code' => $mouza_pargona_code,
            "lot_no"             => $lot_no,
            "vill_townprt_code"  => $vill_townprt_code,
            'village_uuid'       => $pre_arrear_updation_row[0]->village_uuid,
            'patta_type_code'    => $patta_type_code,
            'patta_no'           => $patta_no,
            'total_arrear'       => $update_array[0]['total_arrear'],
            'total_revenue'      => $update_array[0]['total_revenue'],
            'total_tax'          => $update_array[0]['total_tax'],
            'user_code'          => $this->session->all_userdata()['user_code'],
            'financial_year'     => '0000-2000',
            'year_arrear'        =>  $update_array[0]['arrear'],
            'year_revenue'       =>  $update_array[0]['revenue'],
            'year_tax'           =>  $update_array[0]['tax'],
            "created_at"         => date('Y-m-d h:i:s'),
            'modified_at'        => null,
            "status"             => EKHAJANA_AREEAR_PRE_UPDATED,
            "revenue_year"       => '2000',
         );
         $tstatus3 = $this->db->insert('ekhajana_year_wise_arrear', $year_wise_arrear);
         if ($tstatus3 <= 0)
         {
            $this->db->trans_rollback();
            log_message("error", "#EKHIPAD002, Error in insert on ekhajana_year_wise_arrear table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIPAD002'];
         }
      }

      //updating ekhajana pre updation table 
      $update_data = array(
         'arrear'             => $update_array[0]['total_arrear'],
         'revenue'            => $update_array[0]['total_revenue'],
         'tax'                => $update_array[0]['total_tax'],
         'previous_arrears'   => json_encode($previous_arrears),
         'modified_at'        => date('Y-m-d h:i:s'),
      ); 
      $this->db->where('id', $pre_arrear_id)
               ->where('dist_code', $dist_code)
               ->where('subdiv_code', $subdiv_code)
               ->where('cir_code', $cir_code)
               ->where('mouza_pargona_code', $mouza_pargona_code)
               ->where('lot_no', $lot_no)
               ->where('vill_townprt_code', $vill_townprt_code)
               ->where('patta_type_code', $patta_type_code)
               ->where('patta_no', $patta_no)
               ->update('ekhajana_arrear_pre_updation', $update_data);
      if($this->db->affected_rows() != 1){ 
         $this->db->trans_rollback();
         log_message("error", "#EKAPRT002, Error in update, table 'ekhajana_arrear_pre_updation' with query ".json_encode($this->db->last_query()));
         return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKAPRT002'];
      }

      foreach($update_array as $update_row)
      {

         $update_data_year_wise = array(
            'total_arrear'       => $update_row['total_arrear'],
            'total_revenue'      => $update_row['total_revenue'],
            'total_tax'          => $update_row['total_tax'],
            'year_arrear'        => $update_row['arrear'],
            'year_revenue'       => $update_row['revenue'],
            'year_tax'           => $update_row['tax'],
            'modified_at'        => date('Y-m-d h:i:s'),
         ); 

         $this->db->where('pre_arrear_id', $update_row['pre_arrear_id'])
                  ->where('dist_code', $dist_code)
                  ->where('subdiv_code', $subdiv_code)
                  ->where('cir_code', $cir_code)
                  ->where('mouza_pargona_code', $mouza_pargona_code)
                  ->where('lot_no', $lot_no)
                  ->where('vill_townprt_code', $vill_townprt_code)
                  ->where('patta_type_code', $patta_type_code)
                  ->where('patta_no', $patta_no)
                  ->where('financial_year', $update_row['financial_year'])
                  ->update('ekhajana_year_wise_arrear', $update_data_year_wise);
         if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            log_message("error", "#EKAPRT003, Error in update on ekhajana_year_wise_arrear table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKAPRT003'];
         }
      }
         
      return ['result' => 'SUCCESS', 'msg' => 'DATA UPDATED SUCCESSFULLY'];   
         
   }


   public function checkPattaUnderMb2($dist_code, $subdiv_code,$cir_code, $mouza_pargona_code, $lot_no,
   $vill_townprt_code, $patta_type_code, $patta_no){
         //*******************************************************/
         $this->dbswitch();
        //restricting settlement mb2 cases 
        $mb2_flag_query = $this->db->query("select possession_from from chitha_basic where dist_code=? and subdiv_code=? 
        and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? 
        and patta_no=? and possession_from is not null",array($dist_code, $subdiv_code,$cir_code, $mouza_pargona_code, $lot_no,
        $vill_townprt_code, $patta_type_code, $patta_no));

         if($mb2_flag_query->num_rows() > 0){
            log_message("error", "#EKHMB2072024, Mb2 Patta Found In Registration With Last Query :". json_encode($this->db->last_query()));
            return "MB2_PATTA";
         }else{
            return "REGULAR_PATTA";
         }
         //*******************************************************/
   }


   public function checkEcfrGenerated($dist_code, $subdiv_code,$cir_code, $mouza_pargona_code, $lot_no,$vill_townprt_code, $patta_type_code, $patta_no)
   {
      $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => EKHAJANA_GET_ECFR_GENERATED_STATUS,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'dist_code'         => $dist_code,
                    'subdiv_code'       => $subdiv_code,
                    'cir_code'          => $cir_code,
                    'mouza_pargona_code'=> $mouza_pargona_code,
                    'lot_no'            => $lot_no,
                    'vill_townprt_code' => $vill_townprt_code,
                    'patta_type_code'   => $patta_type_code,
                    'patta_no'          => $patta_no,
                ),
            ));
            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if($httpcode == 200){
                return json_decode($response);
            }else{
                return "Could-Not-Fetch-Data";
            }
   }


   public function getUpdatedArrearsLocal($dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no){

      $this->session->set_userdata('dist_code', $dist_code);
      $this->dbswitch();
      $query = $this->db->query("select * from ekhajana_arrear_pre_updation where dist_code=?
                                 and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and
                                 patta_type_code=? and patta_no=?",array($dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_no,
                                 $vill_townprt_code,$patta_type_code,$patta_no));
      if($query->num_rows() != 0){
         $arrear_details =  $query->result();
      }else{
         $arrear_details =  [];
      }
      return $arrear_details;
   }


   public function checkBasicStatus($dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no)
   {
      $this->dbswitch();
      $query = $this->db->query("select * from ekhajana_basic where dist_code=?
                                 and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and
                                 patta_type_code=? and patta_no=? and status =?",array($dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_no,
                                 $vill_townprt_code,$patta_type_code,$patta_no,'F'));
      if($query->num_rows() >=1){
         return "Disposed";
      }else{
          return "Not-Disposed";
      }
   }


}
?>
