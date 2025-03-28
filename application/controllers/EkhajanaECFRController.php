<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EkhajanaECFRController extends MY_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->library('form_validation');
      $this->load->model('ekhajana/EkhajanaECFRModel');      
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

   public function generateECFR(){

   
      $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
      $data['subdiv_code'] =$subdiv_code= $this->session->userdata('subdiv_code');
      $data['cir_code'] = $cir_code =$this->session->userdata('cir_code');
      $data['mouza_pargona_code'] =$mouza_pargona_code= $this->session->userdata('mouza_pargona_code');

      if(in_array(trim($this->session->userdata('unique_user_id')),EKHAJANA_RESTRICTED_ECFR_MOUZADAR)){
         echo "You are not authorised to generate further e-CFR";
         exit;
      }

      //*************************************************************/
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
      //$cash_in_hand_q = $this->db->query("select sum(due_amount) from ekhajana_ecfr_details where status!='F'
                     //and dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?",
      //array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
      
      $cash_in_hand_q = $this->db->query("select sum(due_amount) from ekhajana_ecfr_details eed join
                            ekhajana_land_details eld on eed.ld_application_no=eld.ld_application_no
                            where eed.status!='F' and eld.status='F'
                            and eed.dist_code=? and eed.subdiv_code=? and eed.cir_code=? and
                            eed.mouza_pargona_code=?",
                            array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));

      $cash_in_hand_num_rows = $cash_in_hand_q->num_rows();
      if($cash_in_hand_num_rows != 0){
         $cash_in_hand = $cash_in_hand_q->row()->sum;
	 if($cash_in_hand > 20000){
	    echo "Your Cash In Hand limit of 20000rs has been exceeded. After clearing the Cash In Hand Of Disposed Cases, Further generation of E-CFR will be enabled automatically.(Current Cash In Hand Of Disposed Cases Is Rs.".$cash_in_hand.")";
            exit;
         }
      }
      //*************************************************************/
      $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
      $data['subdiv_code'] =$subdiv_code= $this->session->userdata('subdiv_code');
      $data['cir_code'] = $cir_code =$this->session->userdata('cir_code');
      $data['mouza_pargona_code'] =$mouza_pargona_code= $this->session->userdata('mouza_pargona_code'); 
      $data['dist_name'] = $dist_name = $this->utilclass->getDistrictName($dist_code);
      $data['subdiv_name'] = $subdiv_name = $this->utilclass->getSubDivName($dist_code, $subdiv_code);
      $data['cir_name'] = $cir_name = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);        
      $data['mouza_name'] = $mouza_name = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);
      $data['_view'] = 'e_khajana/mouz_views/ecfr_views/generate_ecfr';
      $this->load->view('layouts/main',$data);
   }

   //sumbit ecfr 
   public function submitECFR(){ 
      //validation 
      $error_msg = array();
      $validation = [
         [
               'field' => 'dist_code',
               'label' => 'District Code',
               'rules' => 'required|trim'
         ],
         [
               'field' => 'subdiv_code',
               'label' => 'Subdivision Code',
               'rules' => 'required|trim'
         ],
         [
               'field' => 'cir_code',
               'label' => 'Circle Code',
               'rules' => 'required|trim',
         ],
         [
               'field' => 'mouza_code',
               'label' => 'Mouza Pargona Code',
               'rules' => 'required|trim',
         ],
         [
               'field' => 'ld_application_no',
               'label' => 'Land Application Number',
               'rules' => 'required|trim',
         ],
                           
      ];
      $this->form_validation->set_rules($validation);
      if ($this->form_validation->run() == FALSE)
      {            
         $this->form_validation->set_error_delimiters('', '');   
         foreach($validation as $rule){
               if (form_error($rule['field'])) {
               array_push($error_msg, form_error($rule['field']));
               }
         }              
      }
      if(count($error_msg) != 0){
         echo json_encode(['flag' => 'N', 'msg' => $error_msg]);
         exit;
      }       
      //*********************************************************************/
      $user_details = $this->session->userdata;
      // $mouzadar_name = $user_details['name'];
      
      //*********************************************************************/
      $ld_application_no = trim($_POST['ld_application_no']);
      $ekhajana_land_details = $this->EkhajanaECFRModel->getEkhajanaLandDetails($ld_application_no); 
      if($ekhajana_land_details['flag'] == 'N'){
         echo json_encode($ekhajana_land_details);
         exit;
      }
      $mouzadar_name_details = $this->EkhajanaECFRModel->getMouzadarName($ekhajana_land_details['data']);
      if($mouzadar_name_details['flag'] =='N')
      {
         echo json_encode($mouzadar_name_details);
         exit;
      }
      $mouzadar_name = $mouzadar_name_details['msg'];
      
      //checking the case is under the mouzadar or not(Only For Ekhajana-Registered Cases ECFR) NOT IN - EKRL,EKSMB2 or others
      if($ekhajana_land_details['data']->application_under != 'MOUZADAR'){
         echo json_encode(["flag" => 'N', "msg" => "Application is not Under Mouzadari Area.. #ERR3008110401"]);
         exit;
      }
      //*********************************************************************/
      //ekhajana payment check payment 
      $checkPaymentDone = $this->EkhajanaECFRModel->checkPaymentDone($ekhajana_land_details['data']);
      if($checkPaymentDone['flag'] =='N')
      {
         echo json_encode($checkPaymentDone);
         exit;
      }
      //*********************************************************************/
      //checking the case is disposed by mouzadar or not 
      if($ekhajana_land_details['data']->status == 'P' || $ekhajana_land_details['data']->status == 'MLM_F' || $ekhajana_land_details['data']->status == 'R'){
         echo json_encode(["flag" => 'N', "msg" => "Application is not Disposed By Mouzadar.. #ERR3008110402"]);
         exit;
      }
      //checking if ecf is already generated for the patta
      $checkEcfrGenerarted = $this->EkhajanaECFRModel->checkEcfrGenerartedForPatta($ekhajana_land_details['data']);
      if($checkEcfrGenerarted['flag'] =='N'){
         echo json_encode($checkEcfrGenerarted);
         exit;
      }
      //checking the application is not repayemnt case or EKMB2
      if($ekhajana_land_details['data']->repayment_flag == '1' || $ekhajana_land_details['data']->repayment_flag == 'G'){
         echo json_encode(["flag" => 'N', "msg" => "Some Error Occured. Please Proceed with a registered Case Number.. #ERR3008110402"]);
         exit;
      }

      //*********************************************************************/
      $arrear_details = $this->EkhajanaECFRModel->getArrearDetails($ekhajana_land_details['data']);
     
      if($arrear_details['flag'] == 'N'){
         echo json_encode($arrear_details);
         exit;
      }
      //*********************************************************************/
      $year_wise_arrear_details = $this->EkhajanaECFRModel->getYearWiseArearDetails($arrear_details['data']->id);
      if($arrear_details['flag'] == 'N'){
         echo json_encode($year_wise_arrear_details);
         exit;
      }
      //*********************************************************************/
      $checkDpFlagged = $this->EkhajanaECFRModel->checkDpFlagged($ekhajana_land_details['data']);
      if($checkDpFlagged['flag'] == 'N'){
         echo json_encode($checkDpFlagged);
         exit;
      }
      //*********************************************************************/
      $checkMb2Patta= $this->EkhajanaECFRModel->checkMb2Patta($ekhajana_land_details['data']);
      if($checkMb2Patta['flag'] == 'N'){
         echo json_encode($checkMb2Patta);
         exit;
      }
      //*********************************************************************/
      $current_doul_details = $this->EkhajanaECFRModel->getCurrentDoulDetails($ekhajana_land_details['data']);
      if($current_doul_details['flag'] == 'N'){
         echo json_encode($current_doul_details);
         exit;
      }
      //*********************************************************************/
      //*********************************************************************/
      //inserting into ecfr breakdown table
      $insert_details_for_ecfr_breakdown = [
         "arrear_breakdown_json" => $year_wise_arrear_details['data'],
         "dist_code"             => $ekhajana_land_details['data']->dist_code,
         "subdiv_code"           => $ekhajana_land_details['data']->subdiv_code,
         "cir_code"              => $ekhajana_land_details['data']->cir_code,
         "mouza_pargona_code"    => $ekhajana_land_details['data']->mouza_pargona_code,
         "lot_no"                => $ekhajana_land_details['data']->lot_no,
         "vill_townprt_code"     => $ekhajana_land_details['data']->vill_townprt_code,
         "vill_uuid"             => $ekhajana_land_details['data']->village_uuid,
         "patta_type_code"       => $ekhajana_land_details['data']->patta_type_code,
         "patta_no"              => $ekhajana_land_details['data']->patta_no,
         "ld_application_no"     => $ekhajana_land_details['data']->ld_application_no,
         "application_no"        => $ekhajana_land_details['data']->application_no,
         "created_at"            => date('Y-m-d h:i:s'),
         "modified_at"           => null,
         "doul_year_no"          => doul_year_no,
      ];
      $insert_brkdown_flag = $this->EkhajanaECFRModel->insertECFRBreakDownDetails($insert_details_for_ecfr_breakdown);
      if($insert_brkdown_flag['flag'] == 'N')
      {
         echo json_encode($insert_brkdown_flag);
         exit;
      }
      $last_brekdown_insert_id = $insert_brkdown_flag['last_id'];
      $insert_details_for_ekhajana_ecfr_details = [
         "application_no"           =>$ekhajana_land_details['data']->application_no,
         "ld_application_no"        =>$ekhajana_land_details['data']->ld_application_no,
         "dist_code"                =>$ekhajana_land_details['data']->dist_code,
         "subdiv_code"              =>$ekhajana_land_details['data']->subdiv_code,
         "cir_code"                 =>$ekhajana_land_details['data']->cir_code,
         "mouza_pargona_code"       =>$ekhajana_land_details['data']->mouza_pargona_code,
         "lot_no"                   =>$ekhajana_land_details['data']->lot_no,
         "vill_townprt_code"        =>$ekhajana_land_details['data']->vill_townprt_code,
         "village_uuid"             =>$ekhajana_land_details['data']->village_uuid,
         "patta_type_code"          =>$ekhajana_land_details['data']->patta_type_code,
         "patta_no"                 =>$ekhajana_land_details['data']->patta_no,
         "pdar_id"                  =>$ekhajana_land_details['data']->pdar_id,
         "pdar_name"                =>trim($ekhajana_land_details['data']->pdar_name),
         "pdar_father_name"         =>trim($ekhajana_land_details['data']->pdar_father_name),
         "status"                   =>'P',
         "digital_payment_status"   =>'P',
         "due_amount"               => $arrear_details['data']->arrear+$current_doul_details['data']->dag_revenue+$current_doul_details['data']->dag_local_tax,
         "total_arrear"             => $arrear_details['data']->arrear,
         "arrear_revenue"           =>$arrear_details['data']->revenue,
         "arrear_local_tax"         =>$arrear_details['data']->tax,
         //"year_wise_arrear_details" =>$year_wise_arrear_details['data'],
         "ecfr_arrear_breakdown_id" =>$last_brekdown_insert_id,
         "current_revenue"          =>$current_doul_details['data']->dag_revenue,
         "current_local_tax"        =>$current_doul_details['data']->dag_local_tax,
         "miran"                    =>0,
         "surcharge"                =>0,
         "doul_year"                =>doul_year_no,
	 //"revenue_year"             =>$ekhajana_land_details['data']->revenue_year,
	 "revenue_year"             =>$this->EkhajanaECFRModel->getRevenueYearFromCreatedAt($ekhajana_land_details['data']->created_at),
         "user_details"             =>json_encode($user_details),
         "mouzadar_name"            =>$mouzadar_name,
         "created_at"               =>date('Y-m-d h:i:s'),        
      ];
      //*********************************************************************/
      $insert_flag = $this->EkhajanaECFRModel->insertECFRDetails($insert_details_for_ekhajana_ecfr_details);
      if($insert_flag['flag'] == 'N')
      {
         echo json_encode($insert_flag);
         exit;
      }
      $last_insert_id = $insert_flag['last_id'];
      $insert_ekhajana_ecfr_trans = [
         "ekhajana_ecfr_details_id" =>$last_insert_id,
         "application_no"           =>$ekhajana_land_details['data']->application_no,
         "ld_application_no"        =>$ekhajana_land_details['data']->ld_application_no,
         "dist_code"                =>$ekhajana_land_details['data']->dist_code,
         "subdiv_code"              =>$ekhajana_land_details['data']->subdiv_code,
         "cir_code"                 =>$ekhajana_land_details['data']->cir_code,
         "mouza_pargona_code"       =>$ekhajana_land_details['data']->mouza_pargona_code,
         "lot_no"                   =>$ekhajana_land_details['data']->lot_no,
         "vill_townprt_code"        =>$ekhajana_land_details['data']->vill_townprt_code,
         "village_uuid"             =>$ekhajana_land_details['data']->village_uuid,
         "patta_type_code"          =>$ekhajana_land_details['data']->patta_type_code,
         "patta_no"                 =>$ekhajana_land_details['data']->patta_no,
         "pdar_id"                  =>$ekhajana_land_details['data']->pdar_id,
         "pdar_name"                =>trim($ekhajana_land_details['data']->pdar_name),
         "pdar_father_name"         =>trim($ekhajana_land_details['data']->pdar_father_name),
         "status"                   =>'P',
         "digital_payment_status"   =>'P',
         "due_amount"               =>$arrear_details['data']->arrear+$current_doul_details['data']->dag_revenue+$current_doul_details['data']->dag_local_tax,
         "total_arrear"             => $arrear_details['data']->arrear,
         "arrear_revenue"           =>$arrear_details['data']->revenue,
         "arrear_local_tax"         =>$arrear_details['data']->tax,
         "year_wise_arrear_details" =>$year_wise_arrear_details['data'],
         "current_revenue"          =>$current_doul_details['data']->dag_revenue,
         "current_local_tax"        =>$current_doul_details['data']->dag_local_tax,
         "miran"                    =>0,
         "surcharge"                =>0,
         "doul_year"                =>doul_year_no,
	 //"revenue_year"             =>$ekhajana_land_details['data']->revenue_year,
	 "revenue_year"             =>$this->EkhajanaECFRModel->getRevenueYearFromCreatedAt($ekhajana_land_details['data']->created_at),
         "user_details"             =>json_encode($user_details),
         "mouzadar_name"            =>$mouzadar_name,
	 "created_at"               =>date('Y-m-d h:i:s'),       
 	 //"ecfr_arrear_breakdown_id" =>$last_brekdown_insert_id,
      ];
      $insert_trans_flag = $this->EkhajanaECFRModel->insertECFRTransaction($insert_ekhajana_ecfr_trans);
      if($insert_trans_flag['flag'] == 'N')
      {
         echo json_encode($insert_trans_flag);
         exit;
      }
      echo json_encode($insert_trans_flag);
   }

   //method to print ecfr
   public function printECFR(){
      //***********************************************************/
      $this->load->helper('qrcode');
      $ld_application_no = $_GET['land_application_no'];
      //checking if ecf path exists or the status is G
      $checkFileExist = $this->EkhajanaECFRModel->checkPathExist($ld_application_no);
      if($checkFileExist['flag'] =="Y")
      {
         $file_name = $checkFileExist['msg']->ecfr_path;
         header('Content-type: application/pdf;charset=utf-8');
         echo file_get_contents($file_name); 
      }
      $data['ecfr_data'] = $ecfr_data = $this->EkhajanaECFRModel->getEcfDetailsFromLdAppNo($ld_application_no);
      //$data['ecfr_pre_arrear'] = json_decode($data['ecfr_data']->year_wise_arrear_details);
      $ecfr_breakdown = $this->EkhajanaECFRModel->getArrearBreakdownFromEcfrBreakdownTable($ecfr_data->ecfr_arrear_breakdown_id);
      if($ecfr_breakdown['flag'] =='N'){
         echo $ecfr_breakdown['msg'];
         exit;
      }
      $data['ecfr_pre_arrear'] = json_decode($ecfr_breakdown['msg']);
      $data['base_64_qr'] = printQR('https://basundhara.assam.gov.in/rtpsmb/Ekhajana/viewEcfrDetails?case_no='.$ld_application_no);
      $data['_view'] = 'e_khajana/mouz_views/ecfr_views/ecfrView';
      $this->load->view('layouts/main',$data);
      //***********************************************************/
   }

   //method to downloaf the ecfr
   public function downloadEcfr()
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
      $data = json_encode($_POST);
      $application_no = $_POST['application_no'];
      $ld_application_no = $_POST['ld_application_no'];
      include 'vendor/mpdf/vendor/autoload.php';
      $mpdf = new \Mpdf\Mpdf();
      $mpdf->SetWatermarkText('TEMPORARY E-CFR');
      $mpdf->showWatermarkText = true;
      $mpdf->watermarkTextAlpha = 0.1;
      $mpdf->watermark_font = 'DejaVuSansCondensed';
      $mpdf->autoScriptToLang = true;
      $mpdf->autoLangToFont = true;
      $html = base64_decode($_POST['htmlstring_text']);
      $css ='';
      $css .= '<style>
                  .watermark1{
                     display:none;
                  }
                  .qr-code{
                     display:block;
                  }
                  .show_in_pdf{
                     display:block;
                  }
               </style>';
      $page = $html.$css;
      $mpdf->writeHTML($page);
      ob_clean();
      if(is_dir(ECFR_RECEIPT_PATH)===false){
         mkdir(ECFR_RECEIPT_PATH,0777);
      }
      $new_case_no = str_replace('/', "-", $_POST['application_no']);
      $file_name= $new_case_no."-".time().".pdf";
      $mpdf->Output(ECFR_RECEIPT_PATH.$file_name, \Mpdf\Output\Destination::FILE);

      //file exists validation 

      $this->db->trans_begin();
      $update_array = array(
         'status'            => 'G',
         'ecfr_path'         => ECFR_RECEIPT_PATH.$file_name,
         'modified_at'       => date('Y-m-d h:i:s'),
      );
      $this->db->where('ld_application_no', $ld_application_no)
               ->where('application_no', $application_no)
               ->update('ekhajana_ecfr_details', $update_array);
      if($this->db->affected_rows() != 1){ 
         $this->db->trans_rollback();
         log_message("error", "#EKHECFR00218, Error in update, table 'ekhajana_ecfr_details' with query ".json_encode($this->db->last_query()));
         return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHECFR00218'];
      }
      //insert in transaction
      $insert_transaction_details = $this->EkhajanaECFRModel->insertEcfrTransactionAfterGenerate($ld_application_no);
      if($insert_transaction_details['flag'] =='N') 
      {
         $this->db->trans_rollback();
         log_message("error", "#EKHECFR002325, Error in insert, table 'ekhajana_ecfr_details_transactions' with query ".json_encode($this->db->last_query()));
         return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHECFR002325'];
      } 
      $this->db->trans_commit();
      header('Content-type: application/pdf;charset=utf-8');
      echo file_get_contents(ECFR_RECEIPT_PATH.$file_name);
   }

   //method to view ecfr list
   public function viewECFRList()
   {
      $data['ecfr_data'] = $ecfr_data = $this->EkhajanaECFRModel->getAllEcfDetails();
      $data['_view'] = 'e_khajana/mouz_views/ecfr_views/viewEcfrList';
      $this->load->view('layouts/main',$data);  
   }

   //method to make payment of the ecfr generarted
   public function ecfrPayment()
   {
      $data['ecfr_data'] = $ecfr_data = $this->EkhajanaECFRModel->getEcfrPaymentAvailableList();
      $data['_view'] = 'e_khajana/mouz_views/ecfr_views/eCfrPaymentList';
      $this->load->view('layouts/main',$data);
   }

   public function viewKhajanaReceipt()
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE); 
      $ld_application_no = $_GET['land_application_no'];
      $checkFileExist = $this->EkhajanaECFRModel->checkKhajanaReceiptExist($ld_application_no);
      if($checkFileExist['flag'] =="Y")
      {
         $file_name = $checkFileExist['msg']->khajana_receipt_path;
         header('Content-type: application/pdf;charset=utf-8');
         echo file_get_contents($file_name); 
      }
   }

   public function viewECFRDetails()
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE); 
      $ld_application_no = $_GET['case_no'];
      $ecfr_data = $this->db->query("select * from ekhajana_ecfr_details where ld_application_no=?",array($ld_application_no));
      if($ecfr_data->num_rows() ==0)
      {
         echo "NO DATA AVAILABLE";
         exit;
      }
      $data['ecfr_data'] = $ecfr_data->row();
      $data['_view'] = 'e_khajana/mouz_views/ecfr_views/qr_view_of_ecfr';
      $this->load->view('layouts/main',$data);
      
   }

   public function ecfrDashboard()
   {
      $CI = &get_instance();
      $this->db=$CI->load->database('rtpsmb', TRUE);
      $data['ecfr_data'] = $ecfr_data = $this->db->query("SELECT (SELECT loc_name AS district FROM location WHERE dist_code = t.dist_code
            AND subdiv_code = '00') AS district, (SELECT loc_name AS circle FROM location
            WHERE dist_code = t.dist_code AND subdiv_code = t.subdiv_code AND cir_code = '00') AS circle,
            (SELECT loc_name AS mouza FROM location WHERE dist_code = t.dist_code AND subdiv_code = t.subdiv_code
            AND cir_code = t.cir_code AND mouza_pargona_code = t.mouza_pargona_code AND lot_no = '00') AS mouza,
            COUNT(*) AS generated_ecfr_count, SUM(due_amount) AS total_ecfr_amount,
            SUM(CASE WHEN digital_payment_status = 'F' THEN due_amount ELSE 0 END) AS
            digital_payment_received FROM ekhajana_ecfr_details AS t GROUP BY dist_code,
            subdiv_code, cir_code, mouza_pargona_code ORDER BY dist_code")->result();
      $total_ecfr_amount = 0;
      $total_ecfr_generated_count = 0;
      $digital_payment_amount = 0;
      $total_mouza_count = count($ecfr_data);
      foreach($ecfr_data as $row){
         $total_ecfr_amount = $total_ecfr_amount + $row->total_ecfr_amount;
         $total_ecfr_generated_count = $total_ecfr_generated_count + $row->generated_ecfr_count;
         $digital_payment_amount = $digital_payment_amount + $row->digital_payment_received;
      }
      $data['total_ecfr_amount'] = $total_ecfr_amount;
      $data['total_ecfr_generated_count'] = $total_ecfr_generated_count;
      $data['digital_payment_amount'] = $digital_payment_amount;
      $data['total_no_of_mouza'] = $total_mouza_count;
      $data['_view'] = 'e_khajana/dlr_dashboard/ecfr_dashboard/ecfrReport';
      $this->load->view('layouts/main',$data);
   }
   
}
