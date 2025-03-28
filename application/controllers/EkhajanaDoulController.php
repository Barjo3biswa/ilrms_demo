<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EkhajanaDoulController extends MY_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('ekhajana/EkhajanaDoulModel');
      $this->load->model('ekhajana/EkhajanaMouzadarModel');
      $this->dbswitch($this->session->userdata('dist_code'));
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
      }  else if($this->session->userdata('dist_code') == "38"){
         $this->db=$CI->load->database('ssalmara', TRUE);   
      }  else if($this->session->userdata('dist_code') == "39"){
         $this->db=$CI->load->database('bajali', TRUE);   
      }                                                                                                                                                                                                              
   }

   
   //checking Is Mouzadar
   function checkIsMouzadar_old(){

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
    //checking Is Mouzadar
    function checkIsMouzadar(){

        $databaseExisting = $this->db;
       
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $this->dbswitch($dist_code);
        if (in_array($dist_code, json_decode(EKHAJANA_TEHSILDARI_SYSTEM_DIST_CODES)))
        {
            if(in_array($dist_code, json_decode(EKHAJANA_TEHSILDARI_MIXED_DIST_CODES))){
                $village_codes_arr = json_decode(EKHAJANA_TEHSILDARI_MIXED_VILLAGE_CODES);
                $village_codes = $this->convertLiteral($village_codes_arr); 
                $sql = "Select uuid from location where dist_code ='$dist_code' and subdiv_code ='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code ='$mouza_pargona_code'
                and lot_no!='00' and vill_townprt_code!='00000' and uuid in ($village_codes)";
                $query = $this->db->query($sql);
                //echo $this->db->last_query(); 
                if($query->num_rows()<= 0){
                    $this->db = $databaseExisting;
                    return ['flag'=>false, 'result'=>"Not Authorised..!.This Mouza Is Under Tehsildari System..!"];    
                }else{
                    //mouzadari village
                    $this->db = $databaseExisting;
                    return ['flag'=>true, 'result'=>""];
                }        
            }else{
                //tehsildari district
                $this->db = $databaseExisting;
                return ['flag'=>false, 'result'=>"Not Authorised..!.This Mouza Is Under Tehsildari System..!"];
            }
                                    
        }
        else
        {
            //mouzadari district
            $this->db = $databaseExisting;            
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

   

   //displaying doul for all mouza
   public function viewDoulForAllMouza(){
      //***************chechink-user-designation**********/
      if($this->session->userdata('designation') != 'MOU'){
        echo json_encode("Not Authorised!!");
        exit;
    }
      //**************************************************/
      $dist_code = $this->session->userdata('dist_code');
      $subdiv_code = $this->session->userdata('subdiv_code');
      $cir_code = $this->session->userdata('cir_code');
      $doulExistsFlag = $this->EkhajanaDoulModel->checkDoulExists($dist_code,$subdiv_code,$cir_code);
      if(!$doulExistsFlag){
         $data['_view'] = 'e_khajana/ekhajana_doul/doul_error_page';
         $this->load->view('layouts/main',$data);   
         return;
      }
      $doulData = $this->EkhajanaDoulModel->generateDoulForAllMouza($dist_code,$subdiv_code,$cir_code);
      $data['doul_data_mouza_wise'] = $doulData['doul_details'];
      $data['total_patta'] = $doulData['total_cir_patta'];
      $data['total_cir_area_bigha'] = $doulData['total_cir_area_bigha'];
      $data['total_cir_area_katha'] = $doulData['total_cir_area_katha'];
      $data['total_cir_area_lessa'] = $doulData['total_cir_area_lessa'];
      $data['total_cir_revenue'] = $doulData['total_cir_revenue'];
      $data['total_cir_local_tax'] = $doulData['total_cir_local_tax'];
      $data['_view'] = 'e_khajana/ekhajana_doul/mouzadarDoulView';
      $this->load->view('layouts/main',$data);
   }

   //displaying doul for a mouza
   public function viewDoulMouzaWise(){
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
      $doulExistsFlag = $this->EkhajanaDoulModel->checkDoulExists($dist_code,$subdiv_code,$cir_code);
      if(!$doulExistsFlag){
         $data['_view'] = 'e_khajana/ekhajana_doul/doul_error_page';
         $this->load->view('layouts/main',$data);   
         return;
      }
      //**************************************************/
      $dist_code = $this->session->userdata('dist_code');
      $subdiv_code = $this->session->userdata('subdiv_code');
      $cir_code = $this->session->userdata('cir_code');
      $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
      //location names
      $data['district_name'] = $this->utilclass->getDistrictName($dist_code);
      $data['subdiv_name'] = $this->utilclass->getSubdivName($dist_code, $subdiv_code);
      $data['circle_name'] = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
      $data['mouza_name'] = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);
      //**************************************************/
      $doul_data_all = $this->EkhajanaDoulModel->generateDoulDataMouzaWise($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
      $data['dol_year'] = $this->EkhajanaDoulModel->getDoulYear($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
      if($data['dol_year'] == "NO DOUL FOUND"){
         $data['_view'] = 'e_khajana/ekhajana_doul/doul_error_page';
         $this->load->view('layouts/main',$data);   
         return;
      }
      $data['doul_data'] = $doul_data_all['doul_data'];
      $data['total_patta_all'] = $doul_data_all['total_patta_all'];
      $data['total_bigha_all'] = $doul_data_all['total_bigha_all'];
      $data['total_katha_all'] = $doul_data_all['total_katha_all'];
      $data['total_lessa_all'] = $doul_data_all['total_lessa_all'];
      $data['total_revenue_all'] = $doul_data_all['total_revenue_all'];
      $data['total_local_tax_all'] = $doul_data_all['total_local_tax_all'];
      $data['_view'] = 'e_khajana/ekhajana_doul/mouza_wise_doul';
      $this->load->view('layouts/main',$data);
   }
    function convertLiteral($array) {
        $index = 0;
        $final_str = '';
        foreach($array as $a)
        {
            if ($index == 0)
                $final_str = "'".$a."'";
            else
                $final_str = $final_str.",'". $a."'";
                $index++;
        }
        return $final_str;
    }

   //form to select the patta for the doul display
   public function viewDoulPattaWise()
   {
      $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
      $data['subdiv_code'] =$subdiv_code= $this->session->userdata('subdiv_code');
      $data['cir_code'] = $cir_code =$this->session->userdata('cir_code');
      $data['mouza_pargona_code'] =$mouza_pargona_code= $this->session->userdata('mouza_pargona_code'); 
      $data['dist_name'] = $dist_name = $this->utilclass->getDistrictName($dist_code);
      $data['subdiv_name'] = $subdiv_name = $this->utilclass->getSubDivName($dist_code, $subdiv_code);
      $data['cir_name'] = $cir_name = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
      $data['patta'] = $this->EkhajanaDoulModel->getPattaType($dist_code);
      $data['mouza_name'] = $mouza_name = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);
      $data['village_list'] = $this->EkhajanaDoulModel->getVillagesJSON($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);
      $data['_view'] = 'e_khajana/ekhajana_doul/patta_wise_doul_form';
      $this->load->view('layouts/main',$data);
   }

   //patta wise doul demand 
   public function getDoulDemandPattaWise()
   {
    
      $concated_vill_lot = $_POST['village'];
      $explode_string = explode(",",$concated_vill_lot);
      $data['dist_code'] = $dist_code = $_POST['dist_code'];
      $data['subdiv_code'] = $subdiv_code = $_POST['subdiv_code'];
      $data['cir_code'] = $cir_code = $_POST['cir_code'];
      $data['mouza_pargona_code'] = $mouza_pargona_code = $_POST['mouza_code'];
      $data['lot_no'] = $lot_no = $explode_string[0];
      $data['vill_townprt_code'] = $vill_townprt_code = $explode_string[1];
      $data['patta_type_code'] = $patta_type_code= $_POST['patta_type'];
      $data['patta_no'] = $patta_no= $_POST['patta_no'];
      if($patta_type_code == null || $patta_type_code =='')
      {
         show_error('Patta Type Field is required.', 500);
      }
      if($patta_no == null || $patta_no =='')
      {
         show_error('Patta Number Field is required.', 500);
      }
      $data['current_doul_demand'] = $this->EkhajanaDoulModel->getCurrentDoulPattaWise($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no);
      $data['_view'] = 'e_khajana/ekhajana_doul/patta_wise_doul';
      $this->load->view('layouts/main',$data);
   }
}
