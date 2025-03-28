<?php
class EkhajanaMouzadarChangeRequestModel extends CI_Model {
    
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


   public function getDagNumbers($uuid,$patta_type_code,$patta_no){
      $this->dbswitch();
      $sql = "Select * from location where uuid='$uuid'";
      $query = $this->db->query($sql)->row();  

      $sql2 = "Select dag_no from jama_dag where dist_code=? and subdiv_code= ? and cir_code =? and mouza_pargona_code=? and lot_no = ? and vill_townprt_code = ? and patta_type_code =? and patta_no = ? ";
      $query2 = $this->db->query($sql2, array($query->dist_code,$query->subdiv_code,$query->cir_code,$query->mouza_pargona_code,$query->lot_no,$query->vill_townprt_code,$patta_type_code,$patta_no)); 

           
      return $query2->result(); 
   }

   //patta type selection 
   public function getLandClass()
   {
      $this->dbswitch();
      $land_class = "Select * from    landclass_code";
      $query = $this->db->query($land_class); 
      return $query->result(); 
   }

    public function getDagLandClass($uuid,$patta_type_code,$patta_no,$dag_no)
   {
      $this->dbswitch();
      $sql = "Select * from location where uuid='$uuid'";
      $query = $this->db->query($sql)->row();

      $sql2 = "Select dag_class_code from jama_dag where dist_code=? and subdiv_code= ? and cir_code =? and mouza_pargona_code=? and lot_no = ? and vill_townprt_code = ? and patta_type_code =? and patta_no = ? and dag_no = ?";
      $query2 = $this->db->query($sql2, array($query->dist_code,$query->subdiv_code,$query->cir_code,$query->mouza_pargona_code,$query->lot_no,$query->vill_townprt_code,$patta_type_code,$patta_no,$dag_no))->row(); 

      $land_class_name = "Select land_type,class_code from landclass_code where class_code='$query2->dag_class_code'";
      $query3 = $this->db->query($land_class_name)->row();

      //var_dump($query3->land_type);exit;
      return $query3;
   }

   public function getPattadarsofDag($uuid,$patta_type_code,$patta_no,$dag_no)
   {
      $this->dbswitch();
      $sql = "Select * from location where uuid='$uuid'";
      $query = $this->db->query($sql)->row();

      $sql2 = "select p_flag,pdar_id,patta_no,dag_por_b,dag_por_k,dag_por_lc from   chitha_dag_pattadar where dist_code= ? "
      . " and subdiv_code= ? and cir_code= ? and "
      . " mouza_pargona_code= ? and  lot_no= ? and vill_townprt_code= ? "
      . " and dag_no= ? and TRIM(patta_no)= ? and  patta_type_code= ? and p_flag!='1' order by pdar_id";
      $query2 = $this->db->query($sql2, array($query->dist_code,$query->subdiv_code,$query->cir_code,$query->mouza_pargona_code,$query->lot_no,$query->vill_townprt_code,$dag_no,$patta_no,$patta_type_code)); 

      $query2 = $query2->result();

      $sql3 = "select dag_area_b,dag_area_k,dag_area_lc,dag_area_g,dag_area_kr from   chitha_basic where dist_code= ? "
      . " and subdiv_code= ? and cir_code= ? and "
      . " mouza_pargona_code= ? and  lot_no= ? and vill_townprt_code= ? "
      . " and dag_no= ? and TRIM(patta_no)= ? and  patta_type_code= ?";
      $query3 = $this->db->query($sql3, array($query->dist_code,$query->subdiv_code,$query->cir_code,$query->mouza_pargona_code,$query->lot_no,$query->vill_townprt_code,$dag_no,$patta_no,$patta_type_code)); 

      $query3 = $query3->row();
      // var_dump($query3->dag_area_g);exit;

      $data1[$dag_no]['pattadars'] = array();

      foreach ($query2 as $data) 
      {
         $dag_area_b = $query3->dag_area_b;
         $dag_area_k = $query3->dag_area_k;
         $dag_area_lc = $query3->dag_area_lc;
         $dag_area_g = $query3->dag_area_g;
         $pdar_id = $data->pdar_id;
         $innerquery2 = "select pdar_name,pdar_father,new_pdar_name,pdar_guard_reln,pdar_add1,Pdar_add2,Pdar_add3 from   chitha_pattadar where dist_code= ? "
      . " and subdiv_code= ? and cir_code= ? and "
      . " mouza_pargona_code= ? and  lot_no= ? and vill_townprt_code= ? "
      . " and TRIM(patta_no)= ? and  patta_type_code= ? and pdar_id=$data->pdar_id order by pdar_id";
   
         $innerdata2 = $this->db->query($innerquery2,array($query->dist_code,$query->subdiv_code,$query->cir_code,$query->mouza_pargona_code,$query->lot_no,$query->vill_townprt_code,$patta_no,$patta_type_code))->result();
         // echo $this->db->last_query();exit;

         foreach ($innerdata2 as $pdardata) 
         {
            // $pdar_guardRelation = $pdardata->pdar_guard_reln;
            // $innerquery3 = "select guard_rel_desc_as from   master_guard_rel where guard_rel_desc = '$pdar_guardRelation'";
            // $innerdata3 = $this->db->query($innerquery3)->result();
            // // var_dump($innerdata3);exit;
            // foreach ($innerdata3 as $guard_rel_desc) {
            //    $relation = $guard_rel_desc->guard_reln_desc_as;
            // }
            $data1[$dag_no]['pattadars'][] = array(
               'p_flag' => $data->p_flag,
               'dag_por_b' => $data->dag_por_b,
               'dag_por_k' => $data->dag_por_k,
               'dag_por_lc' => $data->dag_por_lc,
               'pdar_name' => $pdardata->pdar_name,
               //'guard_reln_desc_as' => $relation,
               'new_pdar_name' => $pdardata->new_pdar_name,
               'pdar_father' => $pdardata->pdar_father,
               'pdar_relation' => $pdardata->pdar_guard_reln,
               'pdar_address1' => $pdardata->pdar_add1,
               'pdar_address2' => $pdardata->pdar_add2,
               'pdar_address3' => $pdardata->pdar_add3,
               'pdar_guard_reln' => $pdardata->pdar_guard_reln,
               'pdar_id' => $pdar_id,
               'dag_area_b' => $dag_area_b,
               'dag_area_k' => $dag_area_k,
               'dag_area_lc' => $dag_area_lc,
               'dag_area_g' => $dag_area_g
         );
         }
      }

      //echo $this->db->last_query();exit;
      // var_dump($data1[$dag_no]['pattadars']);exit;
      return $data1[$dag_no]['pattadars'];
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
   public function getLandclassdetails($dist_code,$subdiv_code,$cir_code,$mouza_code)
   {
      $query = "Select erm.*,elc.existing_land_class,elc.proposed_land_class from ekhajana_change_request_master erm join ekhajana_land_class_change elc on erm.petition_no=elc.petition_no where dist_code = ? and subdiv_code = ? and cir_code = ? and mouza_pargona_code = ? and change_type = ?"; 

      $query = $this->db->query($query, array($dist_code, $subdiv_code, $cir_code,$mouza_code,'1'));

      if($query->num_rows() != 0){
         $lc_details =  $query->result(); 
      }else{
         $lc_details =  []; 
      }
      return $lc_details;
   }

   //getting year wise arrear from arrear id 
   public function getYearWiseArrearDetailsFromArrearId($id){
      $this->dbswitch();
      $result = $this->db->query("select * from ekhajana_year_wise_arrear where pre_arrear_id=?",array($id))->result();
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


   public function insertLandclassChange($uuid,$patta_type_code,$patta_no,$dag_no,$class_code,$suggested_land_class,$remark,$user_code,$name,$unique_user_id)
   {
      $this->dbswitch();
      $sql = "Select * from location where uuid='$uuid'";
      $query = $this->db->query($sql)->row();

      $seq_pet=year_no.'0';
      $petition = $this->db->query("select nextval('seq_max_ekhajana') as count ")->row()->count;
      $petition_no = $seq_pet.$petition;

      //var_dump($petition_no);

      $basic = array(
            'dist_code' => $query->dist_code,
            'subdiv_code' => $query->subdiv_code,
            'cir_code' => $query->cir_code,
            'mouza_pargona_code' => $query->mouza_pargona_code,
            'lot_no' => $query->lot_no,
            'vill_townprt_code' => $query->vill_townprt_code,
            'patta_no' => $patta_no,
            'patta_type_code' => $patta_type_code,
            'dag_no' => $dag_no,
            'mouzadar_remark' => $remark,
            'user_code' => $user_code,
            'mouzadar_name'=> $name,
            'mouzadar_id' => $unique_user_id,
            'date_entry' => date('Y-m-d G:i:s'),
            'uuid' => $uuid,
            'change_type' => '1',//for land class
            'petition_no' => $petition_no
        );

      $check_req_exist = "Select * from ekhajana_change_request_master where uuid = ? and dag_no =? and patta_no = ? and patta_type_code = ? and change_type = ? ";

      $checkExist = $this->db->query($check_req_exist, array($uuid,$dag_no,$patta_no,$patta_type_code,'1'));

        if($checkExist->num_rows()>0)
        {
         return ['result' => 'SERVER-ERROR', 'msg' => 'Can not add for this dag as there exist an entry for this Dag already, Error-Code : #ERRLNDCLASS003'];

        }
        else
        {

        $insTBasic = $this->db->insert('ekhajana_change_request_master',$basic);
        if($insTBasic != 1)
        {
		log_message('error', '#ERRLNDCLASS001: Insertion failed in ekhajana_change_request_master for Dag No '.$dag_no. json_encode($this->db->last_query()));
		
            $this->db->trans_rollback();
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #ERRLNDCLASS001'];
        }

        $land_class = array(
            'petition_no' => $petition_no,
            'existing_land_class' => $class_code,
            'proposed_land_class' => $suggested_land_class,
            'date_entry' => date('Y-m-d G:i:s')
        );

        $insTLandclass = $this->db->insert('ekhajana_land_class_change',$land_class);
        if($insTLandclass != 1)
        {
            $this->db->trans_rollback();
            log_message('error', '#ERRLNDCLASS002: Insertion failed in ekhajana_land_class_change for Dag No '.$dag_no. json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #ERRLNDCLASS002'];
        }


        return ['result' => 'SUCCESS', 'msg' => 'DATA UPDATED SUCCESSFULLY', 'redirect_url'=>base_url().'index.php/EkhajanaMouzadarChangeRequestController/classChange']; 
     }
   }



   public function insertPattadarAreaChange($uuid,$patta_type_code,$patta_no,$dag_no,$pdar_id,$suggested_bigha,$suggested_katha,$suggested_lessa,$remark,$user_code,$name,$unique_user_id)
   {
      $this->dbswitch();
      $sql = "Select * from location where uuid='$uuid'";
      $query = $this->db->query($sql)->row();

      $seq_pet=year_no.'0';
      $petition = $this->db->query("select nextval('seq_max_ekhajana') as count ")->row()->count;
      $petition_no = $seq_pet.$petition;


      $basic = array(
            'dist_code' => $query->dist_code,
            'subdiv_code' => $query->subdiv_code,
            'cir_code' => $query->cir_code,
            'mouza_pargona_code' => $query->mouza_pargona_code,
            'lot_no' => $query->lot_no,
            'vill_townprt_code' => $query->vill_townprt_code,
            'patta_no' => $patta_no,
            'patta_type_code' => $patta_type_code,
            'dag_no' => $dag_no,
            'mouzadar_remark' => $remark,
            'user_code' => $user_code,
            'mouzadar_name'=> $name,
            'mouzadar_id' => $unique_user_id,
            'date_entry' => date('Y-m-d G:i:s'),
            'uuid' => $uuid,
            'change_type' => '2',//for area change
            'petition_no' => $petition_no
        );


      //    $sql3 = "select * from   ekhajana_change_request_master where dist_code= ? "
      // . " and subdiv_code= ? and cir_code= ? and "
      // . " mouza_pargona_code= ? and  lot_no= ? and vill_townprt_code= ? "
      // . " and dag_no= ? and TRIM(patta_no)= ? and  patta_type_code= ?";

      //    $query3 = $this->db->query($sql3, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$dag_no,$patta_no,$patta_type_code,$petition_no)); 

      //   if($query3->num_rows()==0)


        $insTBasic = $this->db->insert('ekhajana_change_request_master',$basic);
        if($insTBasic != 1)
        {
            $this->db->trans_rollback();
            log_message('error', '#ERRLNDAREA001: Insertion failed in ekhajana_change_request_master for Dag No '.$dag_no. json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #ERRLNDAREA001'];
        }


        $pattadar_area = array(
            'petition_no' => $petition_no,
            'pdar_id' => $pdar_id,
            'suggested_bigha' => $suggested_bigha,
            'suggested_katha' => $suggested_katha,
            'suggested_lessa' => $suggested_lessa,
            'date_entry' => date('Y-m-d G:i:s'),
        );

        $insTPdarArea = $this->db->insert('ekhajana_area_change',$pattadar_area);
        if($insTPdarArea != 1)
        {
            $this->db->trans_rollback();
            log_message('error', '#ERRLNDAREA002: Insertion failed in ekhajana_area_change for Dag No '.$dag_no. json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #ERRLNDAREA002'];
        }



        return ['result' => 'SUCCESS', 'msg' => 'DATA UPDATED SUCCESSFULLY', 'redirect_url'=>base_url().'index.php/EkhajanaMouzadarChangeRequestController/classChange']; 
   }



    public function insertPattadarAreaChangeA($uuid,$patta_type_code,$patta_no,$dag_no,$countpattadar,$selectRow,$countpattadarA,$remark,$user_code,$name,$unique_user_id,$dag_area_b,$dag_area_k,$dag_area_lc)
   {
      $this->dbswitch();

      // var_dump($countpattadarA);exit;
      $sql = "Select * from location where uuid='$uuid'";
      $query = $this->db->query($sql)->row();

      $seq_pet=year_no.'0';
      $petition = $this->db->query("select nextval('seq_max_ekhajana') as count ")->row()->count;
      $petition_no = $seq_pet.$petition;


      $basic = array(
            'dist_code' => $query->dist_code,
            'subdiv_code' => $query->subdiv_code,
            'cir_code' => $query->cir_code,
            'mouza_pargona_code' => $query->mouza_pargona_code,
            'lot_no' => $query->lot_no,
            'vill_townprt_code' => $query->vill_townprt_code,
            'patta_no' => $patta_no,
            'patta_type_code' => $patta_type_code,
            'dag_no' => $dag_no,
            'mouzadar_remark' => $remark,
            'user_code' => $user_code,
            'mouzadar_name'=> $name,
            'mouzadar_id' => $unique_user_id,
            'date_entry' => date('Y-m-d G:i:s'),
            'uuid' => $uuid,
            'change_type' => '2',//for area change
            'petition_no' => $petition_no
        );

      $check_req_exist = "Select * from ekhajana_change_request_master where uuid = ? and dag_no =? and patta_no = ? and patta_type_code = ? and change_type = ? ";

      $checkExist = $this->db->query($check_req_exist, array($uuid,$dag_no,$patta_no,$patta_type_code,'2'));

        if($checkExist->num_rows()>0)
        {
         return ['result' => 'SERVER-ERROR', 'msg' => 'Can not add for this dag as there exist an entry for this Dag already, Error-Code : #ERRLNDAREA003'];

        }
        else
        {

        $insTBasic = $this->db->insert('ekhajana_change_request_master',$basic);
        if($insTBasic != 1)
        {
            $this->db->trans_rollback();
            log_message('error', '#ERRLNDAREA001: Insertion failed in ekhajana_change_request_master for Dag No '.$dag_no. json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #ERRLNDAREA001'];
        }

        for($i=0;$i<$countpattadar;$i++)
            { 
               // var_dump($_POST['pdarname'][$i]);exit;

                  $pdar = $_POST['pdarname'][$i];
                  $split = explode('__',$pdar);
                  $pdar_id = $split[0];
                  $check = in_array($pdar_id,$selectRow);
                  // var_dump($check);exit;

                  if($check)
                  {
                         // print_r("TRUE".$pdar_id);
                   $suggested_bigha = $_POST['displayedB'][$i];
                   $suggested_katha = $_POST['displayedK'][$i];
                   $suggested_lessa = $_POST['displayedLC'][$i];

                   $sql2 = "select dag_por_b,dag_por_k,dag_por_lc,dag_por_g from   chitha_dag_pattadar where dist_code= ? "
                  . " and subdiv_code= ? and cir_code= ? and "
                  . " mouza_pargona_code= ? and  lot_no= ? and vill_townprt_code= ? "
                  . " and dag_no= ? and TRIM(patta_no)= ? and  patta_type_code= ? and pdar_id = ? and p_flag!='1' order by pdar_id";
                  $query2 = $this->db->query($sql2, array($query->dist_code,$query->subdiv_code,$query->cir_code,$query->mouza_pargona_code,$query->lot_no,$query->vill_townprt_code,$dag_no,$patta_no,$patta_type_code,$pdar_id)); 

                  $query2 = $query2->row();
                  // var_dump($query2->dag_por_lc);exit;


                    $pattadar_area = array(
                        'petition_no' => $petition_no,
                        'pdar_id' => $pdar_id,
                        'suggested_bigha' => $suggested_bigha,
                        'suggested_katha' => $suggested_katha,
                        'suggested_lessa' => $suggested_lessa,
                        'date_entry' => date('Y-m-d G:i:s'),
                        'dag_area_b' => $dag_area_b,
                        'dag_area_k' => $dag_area_k,
                        'dag_area_lc' => $dag_area_lc,
                        'dag_por_b' => $query2->dag_por_b,
                        'dag_por_k' => $query2->dag_por_k,
                        'dag_por_lc' => $query2->dag_por_lc

                    );

                    $insTPdarArea = $this->db->insert('ekhajana_area_change',$pattadar_area);
                    if($insTPdarArea != 1)
                    {
                        $this->db->trans_rollback();
                        log_message('error', '#ERRLNDAREA002: Insertion failed in ekhajana_area_change for Dag No '.$dag_no. json_encode($this->db->last_query()));
                        return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #ERRLNDAREA002'];
                    }
                  }

            }

        return ['result' => 'SUCCESS', 'msg' => 'DATA UPDATED SUCCESSFULLY', 'redirect_url'=>base_url().'index.php/EkhajanaMouzadarChangeRequestController/pattadarAreaChange']; 
     }
   }




   public function getPendingCaseDetailsFromIdLC($petition_no){
        $query = "Select erm.*,elc.existing_land_class,elc.proposed_land_class from ekhajana_change_request_master erm join ekhajana_land_class_change elc on erm.petition_no=elc.petition_no where change_type = ? and erm.petition_no = ?"; 

        $query = $this->db->query($query, array('1',$petition_no));
       // echo $this->db->last_query();
        if($query->num_rows() != 0 ){
            return $query->row();
        }else{
            return false;
        }
    }



    public function getPattadarsofPatta($uuid,$patta_type_code,$patta_no)
   {

      $this->dbswitch();
      $sql = "Select * from location where uuid='$uuid'";
      $query = $this->db->query($sql)->row();


      $where="dist_code = ? 
      and subdiv_code = ? and cir_code = ? and mouza_pargona_code = ? and lot_no = ?
      and vill_townprt_code = ? and patta_type_code = ? and patta_no= ?";

      $sql2="select cp.pdar_id,cp.pdar_name,cp.pdar_father from 
      (select pdar_id,pdar_name,pdar_father from chitha_pattadar where $where )
      as cp 
      join (select pdar_id from chitha_dag_pattadar where $where and (p_flag != '1' or p_flag is null)) as cdp on cp.pdar_id = cdp.pdar_id ";

      $data= $this->db->query($sql2, array(
      $query->dist_code,$query->subdiv_code,$query->cir_code,$query->mouza_pargona_code,$query->lot_no,$query->vill_townprt_code,$patta_type_code,$patta_no,$query->dist_code,$query->subdiv_code,$query->cir_code,$query->mouza_pargona_code,$query->lot_no,$query->vill_townprt_code,$patta_type_code,$patta_no
      ))->result();

      // var_dump($data);exit;

      $data1[$patta_no]['pattadars'] = array();

      foreach ($data as $pdardata) 
      {
            $data1[$patta_no]['pattadars'][] = array(
               'pdar_name' => $pdardata->pdar_name,
               //'guard_reln_desc_as' => $relation,
               'pdar_father' => $pdardata->pdar_father,
               'pdar_id' => $pdardata->pdar_id
         );
      }

      // echo $this->db->last_query();exit;
      // var_dump($data1[$dag_no]['pattadars']);exit;
      return $data1[$patta_no]['pattadars'];
   }

   public function insertHangingPattadar($uuid,$patta_type_code,$patta_no,$countpattadar,$selectRow,$countpattadarA,$remark,$user_code,$name,$unique_user_id)
   {
      $this->dbswitch();

      // var_dump($countpattadarA);exit;
      $sql = "Select * from location where uuid='$uuid'";
      $query = $this->db->query($sql)->row();

      $seq_pet=year_no.'0';
      $petition = $this->db->query("select nextval('seq_max_ekhajana') as count ")->row()->count;
      $petition_no = $seq_pet.$petition;


      $basic = array(
            'dist_code' => $query->dist_code,
            'subdiv_code' => $query->subdiv_code,
            'cir_code' => $query->cir_code,
            'mouza_pargona_code' => $query->mouza_pargona_code,
            'lot_no' => $query->lot_no,
            'vill_townprt_code' => $query->vill_townprt_code,
            'patta_no' => $patta_no,
            'patta_type_code' => $patta_type_code,
            'mouzadar_remark' => $remark,
            'user_code' => $user_code,
            'mouzadar_name'=> $name,
            'mouzadar_id' => $unique_user_id,
            'date_entry' => date('Y-m-d G:i:s'),
            'uuid' => $uuid,
            'change_type' => '3',//for hanging pattadar change
            'petition_no' => $petition_no
        );

      $check_req_exist = "Select * from ekhajana_change_request_master where uuid = ? and patta_no = ? and patta_type_code = ? and change_type = ? ";

      $checkExist = $this->db->query($check_req_exist, array($uuid,$patta_no,$patta_type_code,'3'));

        if($checkExist->num_rows()>0)
        {
         return ['result' => 'SERVER-ERROR', 'msg' => 'Can not add for this patta as there exist an entry for this Patta already, Error-Code : #ERRPDAR003'];

        }
        else
        {

        $insTBasic = $this->db->insert('ekhajana_change_request_master',$basic);
        if($insTBasic != 1)
        {
            $this->db->trans_rollback();
            log_message('error', '#ERRPDAR001: Insertion failed in ekhajana_change_request_master for Patta No '.$patta_no. json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #ERRPDAR001'];
        }

        for($i=0;$i<$countpattadar;$i++)
            { 

                  $pdar = $_POST['pdarname'][$i];
                  $split = explode('__',$pdar);
                  $pdar_id = $split[0];
                  $check = in_array($pdar_id,$selectRow);
                  // var_dump($check);exit;
                  $pdar_name = $split[1];
                  $pdar_father = $split[2];

                  if($check)
                  {
                    $hanging_pattadar = array(
                        'petition_no' => $petition_no,
                        'pdar_id' => $pdar_id,
                        'pdar_name' => $pdar_name,
                        'pdar_father' => $pdar_father,
                        'date_entry' => date('Y-m-d G:i:s')
                    );

                    $insTPdarArea = $this->db->insert('ekhajana_hanging_pdar_change',$hanging_pattadar);
                    if($insTPdarArea != 1)
                    {
                        $this->db->trans_rollback();
                        log_message('error', '#ERRPDAR002: Insertion failed in ekhajana_area_change for Patta No '.$dag_no. json_encode($this->db->last_query()));
                        return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #ERRPDAR002'];
                    }
                  }

            }

        return ['result' => 'SUCCESS', 'msg' => 'DATA UPDATED SUCCESSFULLY', 'redirect_url'=>base_url().'index.php/EkhajanaMouzadarChangeRequestController/hangingPattadarChange']; 
     }
   }


   public function getRevenueofPatta($uuid,$patta_type_code,$patta_no)
   {

      $this->dbswitch();
      $sql = "Select * from location where uuid='$uuid'";
      $query = $this->db->query($sql)->row();


      $sql2 = "Select dag_local_tax,dag_revenue from current_doul_demand where dist_code=? and subdiv_code= ? and cir_code =? and mouza_pargona_code=? and lot_no = ? and vill_townprt_code = ? and patta_type_code =? and patta_no = ?";
      $query2 = $this->db->query($sql2, array($query->dist_code,$query->subdiv_code,$query->cir_code,$query->mouza_pargona_code,$query->lot_no,$query->vill_townprt_code,$patta_type_code,$patta_no))->row(); 

      //var_dump($query3->land_type);exit;
      return $query2;
   }


   public function insertRevenueChange($uuid,$patta_type_code,$patta_no,$p_local_tax,$P_land_rev,$dag_local_tax,$dag_revenue,$remark,$user_code,$name,$unique_user_id)
   {
      $this->dbswitch();
      $sql = "Select * from location where uuid='$uuid'";
      $query = $this->db->query($sql)->row();

      $seq_pet=year_no.'0';
      $petition = $this->db->query("select nextval('seq_max_ekhajana') as count ")->row()->count;
      $petition_no = $seq_pet.$petition;


      $basic = array(
            'dist_code' => $query->dist_code,
            'subdiv_code' => $query->subdiv_code,
            'cir_code' => $query->cir_code,
            'mouza_pargona_code' => $query->mouza_pargona_code,
            'lot_no' => $query->lot_no,
            'vill_townprt_code' => $query->vill_townprt_code,
            'patta_no' => $patta_no,
            'patta_type_code' => $patta_type_code,
            'mouzadar_remark' => $remark,
            'user_code' => $user_code,
            'mouzadar_name'=> $name,
            'mouzadar_id' => $unique_user_id,
            'date_entry' => date('Y-m-d G:i:s'),
            'uuid' => $uuid,
            'change_type' => '4',//for revenue change
            'petition_no' => $petition_no
        );

      $check_req_exist = "Select * from ekhajana_change_request_master where uuid = ? and patta_no = ? and patta_type_code = ? and change_type = ? ";

      $checkExist = $this->db->query($check_req_exist, array($uuid,$patta_no,$patta_type_code,'4'));

        if($checkExist->num_rows()>0)
        {
         return ['result' => 'SERVER-ERROR', 'msg' => 'Can not add for this patta as there exist an entry for this Patta already, Error-Code : #ERRPDAR003'];

        }
        else
        {

        $insTBasic = $this->db->insert('ekhajana_change_request_master',$basic);
        if($insTBasic != 1)
        {
            $this->db->trans_rollback();
            log_message('error', '#ERRPDAR001: Insertion failed in ekhajana_change_request_master for Patta No '.$patta_no. json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #ERRPDAR001'];
        }

        $revenue_change = array(
            'petition_no' => $petition_no,
            'existing_l_revenue' => $dag_revenue,
            'existing_l_localtax' => $dag_local_tax,
            'proposed_l_revenue' => $P_land_rev,
            'proposed_l_localtax' => $p_local_tax,
            'date_entry' => date('Y-m-d G:i:s')
        );


        $insTPdarArea = $this->db->insert('ekhajana_revenue_change',$revenue_change);
        if($insTPdarArea != 1)
        {
            $this->db->trans_rollback();
            log_message('error', '#ERRPDAR002: Insertion failed in ekhajana_revenue_change for Patta No '.$dag_no. json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #ERRPDAR002'];
        }

        return ['result' => 'SUCCESS', 'msg' => 'DATA UPDATED SUCCESSFULLY', 'redirect_url'=>base_url().'index.php/EkhajanaMouzadarChangeRequestController/landRevenueChange']; 
     }
   }


}
?>
