<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EkhajanaCommissionController extends MY_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('ekhajana/EkhajanaDoulModel');
      $this->load->model('ekhajana/EkhajanaCommissionModel');
      $this->dbswitch($this->session->userdata('dist_code'));
   }

   
   //checking Is Mouzadar
   function checkIsMouzadar(){

      $dist_code = $this->session->userdata('dist_code');
      if (in_array($dist_code, json_decode(EKHAJANA_TEHSILDARI_SYSTEM_DIST_CODES)))
      {
          //tehsildari district     
          return ['flag'=>false, 'result'=>"Not Authorised..!.This Mouza Is Under Tehsildari System..!"];                
      }
      else
      {
          //mouzadari district            
          return ['flag'=>true, 'result'=>""];                
      }
   }


   //script-validation-callback
   function check_script($str){

      if( strpos( trim(strtolower($str)), '<' ) !== false) {
         return FALSE;
      }

      if( strpos( trim(strtolower($str)), '>' ) !== false) {
         return FALSE;
      }
      
      if( strpos( trim(strtolower($str)), '<script>' ) !== false) {
         return FALSE;
      }
      if( strpos( trim(strtolower($str)), '</script>' ) !== false) {
         return FALSE;
      }
      return TRUE;
   }

   //date-validation-callback
   function date_valid($date){
      if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) 
         return false;
      
      $day = (int) substr($date, 8, 2);
      $month = (int) substr($date, 5, 2);
      $year = (int) substr($date, 0, 4);                        
      return checkdate($month, $day, $year);
   }

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

   //displayig commision mouza wise 
   public function index(){

      //***************chechink-user-designation**********/
      if($this->session->userdata('designation') != 'MOU'){
         echo json_encode("Not Authorised!!");
         exit;
      }
      //**************************************************/
      $mouzadarflag = $this->checkIsMouzadar();
      if(!$mouzadarflag['flag']){
         $data['errorMessage'] = $mouzadarflag['result'];
         $data['_view'] = 'e_khajana/mouzadar_error_page';
         $this->load->view('layouts/main',$data);
         return;
      }
      $dist_code = $this->session->userdata('dist_code');
      $subdiv_code = $this->session->userdata('subdiv_code');
      $cir_code = $this->session->userdata('cir_code');
      $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
      //location names
      $data['district_name'] = $this->utilclass->getDistrictName($dist_code);
      $data['subdiv_name'] = $this->utilclass->getSubdivName($dist_code, $subdiv_code);
      $data['circle_name'] = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
      $data['mouza_name'] = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);
      
      $data['commission_details'] = $this->EkhajanaCommissionModel->getCommissionDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);      
      
      // $data['jama_wasil_details'] = $this->EkhajanaCommissionModel->getJamaWasilDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);      
   
      $data['ekhajana_commission_details'] = $this->EkhajanaCommissionModel->getCommissionData($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);

      $data['get_villages'] = $this->EkhajanaCommissionModel->getVillages($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);

      //****checking if target wise commision arrear */

      // $data['target_wise_arrer_calc'] = $this->EkhajanaCommissionModel->targetWiseArrerCalc($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);

      $data['dist_code'] = $dist_code;
      $data['subdiv_code'] = $subdiv_code;
      $data['cir_code'] = $cir_code;
      $data['mouza_pargona_code'] = $mouza_pargona_code;

      $data['_view'] = 'e_khajana/commission/index';
      $this->load->view('layouts/main',$data);

   }

   function is_decimal( $val )
   {
      return is_numeric( $val ) && floor( $val ) != $val;
   }

   public function mzdrCommissionTable()
   {
      $CI = &get_instance();
      $this->db = $CI->load->database('rtpsmb', TRUE);

      $dist_code = $this->session->userdata('dist_code');
      $subdiv_code = $this->session->userdata('subdiv_code');
      $cir_code = $this->session->userdata('cir_code');
      $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');


      $vil_code = $this->input->post('vill_townprt_code');

      $draw = intval($this->input->post('draw'));
      $start = intval($this->input->post('start'));
      $length = intval($this->input->post('length'));
      $order = $this->input->post('order');
      $col = 0;
      $dir = "";
      $search = $this->input->post('search');
      $search = $search['value'];

      $searchByCol_0 = $this->input->post('columns')[0]['search']['value'];
      $searchByCol_1 = $this->input->post('columns')[1]['search']['value'];
      $searchByCol_2 = $this->input->post('columns')[2]['search']['value'];
      $searchByCol_3 = $this->input->post('columns')[3]['search']['value'];
      $searchByCol_4 = $this->input->post('columns')[4]['search']['value'];


      if (!empty($searchByCol_0)) {

         $this->db->like('application_no', trim(strtoupper($searchByCol_0)));
      }

      if (!empty($searchByCol_1)) {

         $this->db->like('ld_application_no', strtoupper($searchByCol_1));
      }

      if (!empty($searchByCol_2)) {

         $this->db->like('village_townprt_code', trim($searchByCol_2));
      }

      if (!empty($searchByCol_3)) {

         $this->db->like('patta_no', trim($searchByCol_3));
      }

      if (!empty($searchByCol_4)) {
         $this->db->like('doul_year_no', trim($searchByCol_4));
      }

      if (!empty($vil_code)) {
         $this->db->where('vill_townprt_code', $vil_code);
      }
    
      $this->db->limit($length, $start);

      $this->db->where('dist_code', $dist_code);
      $this->db->where('subdiv_code', $subdiv_code);
      $this->db->where('cir_code', $cir_code);
      $this->db->where('mouza_pargona_code', $mouza_pargona_code);

      $query = $this->db->get('ekhajana_commission_details');

      if ($query->num_rows() > 0) {
          foreach ($query->result() as $rows) {

              $json[] = array(
                  '<span style= font-size:14px;><strong>' . $rows->application_no . '</strong></span>',
                  
                  '<span style= font-size:14px;><strong>' . $rows->ld_application_no . '</strong></span>',
                  
                  $this->utilclass->getVillageName($rows->dist_code,$rows->subdiv_code, $rows->cir_code, $rows->mouza_pargona_code, $rows->lot_no, $rows->vill_townprt_code),

                  $rows->patta_no,

                  $rows->doul_year_no,

                  $rows->total_khajana,

                  $rows->patta_commission,
                 
              );
          }

         $this->db->where('dist_code', $dist_code);
         $this->db->where('subdiv_code', $subdiv_code);
         $this->db->where('cir_code', $cir_code);
         $this->db->where('mouza_pargona_code', $mouza_pargona_code);

         $total_records = $this->db->count_all_results('ekhajana_commission_details');
         $response = array(
            'draw' => $draw,
            'recordsTotal' => $total_records,
            'recordsFiltered' => $total_records,
            'data' => $json,
         );

         echo json_encode($response);

      } else {
          $response = array();
          $response['sEcho'] = 0;
          $response['iTotalRecords'] = 0;
          $response['iTotalDisplayRecords'] = 0;
          $response['aaData'] = [];
          echo json_encode($response);
      }

   }


   public function targetWiseArrCalc()
   {
      $dist_code = $this->input->post('dist_code'); 
      $subdiv_code = $this->input->post('subdiv_code');
      $cir_code = $this->input->post('cir_code');
      $mouza_pargona_code = $this->input->post('mouza_pargona_code');

      $CI = &get_instance();
      $this->db = $CI->load->database('rtpsmb', TRUE);

      $sql = $this->db->query("SELECT doul_year_no FROM ekhajana_arrear_claim WHERE dist_code = ? AND subdiv_code = ? AND cir_code = ? AND mouza_pargona_code = ? GROUP BY doul_year_no", array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code));

      $applied_year = array();
      if($sql->num_rows() > 0)
      {
         $applied_year_array = $sql->result();

         foreach($applied_year_array as $applied_year_ind)
         {
            $applied_year[] = $applied_year_ind->doul_year_no;
         }
      }

      $data = $this->EkhajanaCommissionModel->targetWiseArrerCalc($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);

      $percentage_wise_arrear_final = array();

      if($data != false)
      {
         foreach($data as $dat)
         {
            $is_already_claimed = 0;
            
            if (in_array((string)$dat->year, $applied_year)) 
            {
               $is_already_claimed = 1;
            }
   
            $percentage_wise_arrear_final[] = (object)[
               'slab' => $dat->slab,
               'year' => (string)$dat->year,
               'total_doul' => $dat->total_doul,
               'total_doul_demand' => $dat->total_doul_demand,
               'total_doul_demand_collection' => $dat->total_doul_demand_collection,
               'collection_percentage' => $dat->collection_percentage,
               'eligible_commision_percentage' => $dat->eligible_commision_percentage,
               'claimable_amount' => $dat->claimable_amount,
               'claimable_decimal_amount' => $dat->claimable_decimal_amount,
               'total_claimable_amount' => $dat->total_claimable_amount,
               'is_already_claimed' => $is_already_claimed,
               'paid_commission_at_30' => $dat->paid_commission_at_30,
            ];
         }
         
         echo json_encode([
            'responseType' => 2,
            'content' => $percentage_wise_arrear_final,
         ]);

      }
      else
      {
         echo json_encode([
            'responseType' => 0,
            'msg' => 'No records found!',
         ]);
      }

   }

   public function fileReturn()
   {
      $doul_year = $this->input->post('doul_year');
      $total_doul_demand = $this->input->post('total_doul_demand');
      $total_doul_demand_collection = $this->input->post('total_doul_demand_collection');
      $collection_percentage = $this->input->post('collection_percentage');
      $eligible_commision_percentage = $this->input->post('eligible_commision_percentage');
      $paid_commission_at_30 = $this->input->post('paid_commission_at_30');
      $claimable_amount = $this->input->post('claimable_amount');
      $claimable_decimal_amount = $this->input->post('claimable_decimal_amount');
      $total_claimable_amount = $this->input->post('total_claimable_amount');

      $dist_code = $this->session->userdata('dist_code');
      $subdiv_code = $this->session->userdata('subdiv_code');
      $cir_code = $this->session->userdata('cir_code');
      $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');

      $this->db->trans_begin();

      //******RTPS DB */
      $CI = &get_instance();
      $this->db = $CI->load->database('rtpsmb', TRUE);

      $insertArr = [
         'user_code' => $this->session->userdata('user_code'),
         'doul_year_no' => $doul_year,
         'dist_code' => $dist_code,
         'subdiv_code' => $subdiv_code,
         'cir_code' => $cir_code,
         'mouza_pargona_code' => $mouza_pargona_code,
         'total_doul_demand' => $total_doul_demand,
         'doul_collected' => $total_doul_demand_collection,
         'collection_percentage' => $collection_percentage,
         'eligible_commission_slab' => $eligible_commision_percentage,
         'compensation_paid' => $paid_commission_at_30,
         'compensation_arrear' => $claimable_amount,
         'compensation_decimal_arrear' => $claimable_decimal_amount,
         'total_arrear' => $total_claimable_amount,
         'approv_status' => 'P',
         'created_at' => date('Y-m-d'),
      ];

      $insertStat = $this->db->insert('ekhajana_arrear_claim', $insertArr);

      if($insertStat != 1)
      {
         $this->db->trans_rollback();
         
         echo json_encode([
            'responseType' => 0,
            'msg' => '#ERR98973: Unable file return! Contact admin...',
         ]);
         log_message('error', '#ERR98973 Unable to insert into ekhajana_arrear_claim table!'.$this->db->last_query());
      }

      //****switching DB to dharitree */
      $this->dbswitch();

      $insertStat = $this->db->insert('ekhajana_arrear_claim', $insertArr);
      
      if($insertStat != 1)
      {
         $this->db->trans_rollback();
         
         echo json_encode([
            'responseType' => 0,
            'msg' => '#ERR98974: Unable file return! Contact admin...',
         ]);
         log_message('error', '#ERR98974 Unable to insert into ekhajana_arrear_claim table!'.$this->db->last_query());
      }

      //*****commit and return success */
      $this->db->trans_commit();
      echo json_encode([
         'responseType' => 2,
         'msg' => 'Return filed successfully...',
         'dist_code' => $dist_code,
         'subdiv_code' => $subdiv_code,
         'cir_code' => $cir_code,
         'mouza_pargona_code' => $mouza_pargona_code
      ]);
   }

}
