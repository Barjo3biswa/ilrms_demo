<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EkhajanaMouzadarCFRmanualResponse extends CI_Controller
{
    // db switch method for live updation
    public function dbswitch($dist_code) {       
        $CI = &get_instance();

        if ($dist_code == "02") {
            $this->dbb = $CI->load->database('dhubri', TRUE);    
        } else if ($dist_code == "05") {
            $this->dbb = $CI->load->database('barpeta', TRUE);    
        } else if ($dist_code == "10") {
            $this->dbb = $CI->load->database('chirang', TRUE);       
        } else if ($dist_code == "13") {
            $this->dbb = $CI->load->database('bongaigaon', TRUE);    
        } else if ($dist_code == "17") {
            $this->dbb = $CI->load->database('dibrugarh', TRUE);    
        } else if ($dist_code == "15") {
            $this->dbb = $CI->load->database('jorhat', TRUE);    
        } else if ($dist_code == "14") {
            $this->dbb = $CI->load->database('golaghat', TRUE);    
        } else if ($dist_code == "07") {
            $this->dbb = $CI->load->database('kamrup', TRUE);    
        } else if ($dist_code == "03") {
            $this->dbb = $CI->load->database('goalpara', TRUE);    
        } else if ($dist_code == "18") {
            $this->dbb = $CI->load->database('tinsukia', TRUE);    
        } else if ($dist_code == "12") {
            $this->dbb = $CI->load->database('lakhimpur', TRUE);   
        } else if ($dist_code == "24") {
            $this->dbb = $CI->load->database('kamrupM', TRUE);   
        } else if ($dist_code == "06") {
            $this->dbb = $CI->load->database('nalbari', TRUE);   
        } else if ($dist_code == "11") {
            $this->dbb = $CI->load->database('sonitpur', TRUE);   
        } else if ($dist_code == "16") {
            $this->dbb = $CI->load->database('sibsagar', TRUE);   
        } else if ($dist_code == "32") {
            $this->dbb = $CI->load->database('morigaon', TRUE);   
        } else if ($dist_code == "33") {
            $this->dbb = $CI->load->database('nagaon', TRUE);   
        } else if ($dist_code == "34") {
            $this->dbb = $CI->load->database('majuli', TRUE);   
        } else if ($dist_code == "21") {
            $this->dbb = $CI->load->database('karimganj', TRUE);   
        } else if ($dist_code == "08") {
            $this->dbb = $CI->load->database('darrang', TRUE);   
        } else if ($dist_code == "35") {
            $this->dbb = $CI->load->database('biswanath', TRUE);   
        } else if ($dist_code == "36") {
            $this->dbb = $CI->load->database('hojai', TRUE);   
        } else if ($dist_code == "37") {
            $this->dbb = $CI->load->database('charaideo', TRUE);   
        } else if ($dist_code == "25") {
            $this->dbb = $CI->load->database('dhemaji', TRUE);   
        } else if ($dist_code == "39") {
            $this->dbb = $CI->load->database('bajali', TRUE);
        }    

        return $this->dbb;                                                                                 
    }
   
    public function egrasResponse(){
        // Get the POST data
        $postData = $this->input->post();   
        //echo "<pre>";
        //var_dump($postData);
        //exit;    
        //********************************************************************/
        //handling the success response and updating the databases 
        if(isset($postData['STATUS']) && $postData['STATUS']=='Y' ){
            $department_id = trim($postData['DEPARTMENT_ID']);
            $updateSuccessResponseFlag = $this->updateManualCfrSuccessResponse($department_id,$postData);
            if($updateSuccessResponseFlag['result'] == "SERVER-ERROR"){
                show_error($updateSuccessResponseFlag['msg']);
                exit;
            }
            // echo "<pre>";
            // var_dump($updateSuccessResponseFlag);
            // exit;
        }
        //********************************************************************/
        //handling failed responses 
        //status A,N,P
        if(isset($postData['STATUS']) && ($postData['STATUS'] =='A' || $postData['STATUS'] =='N' || $postData['STATUS'] =='P')){
            $department_id = trim($postData['DEPARTMENT_ID']);
            $updateFailedResponseFlag = $this->updateManualCfrFailedResponse($department_id,$postData);
            if($updateFailedResponseFlag['result'] == "SERVER-ERROR"){
                show_error($updateFailedResponseFlag['msg']);
                exit;
            }
            // echo "<pre>";
            // var_dump($updateFailedResponseFlag);
            // exit;   
        }
        //********************************************************************/
        // Prepare data for the view
        $data = [
            'GRN' => $postData['GRN'],
            'AMOUNT' => $postData['AMOUNT'],
            'PAYMENT_DATE' => $postData['ENTRY_DATE'],
            'STATUS' => $postData['STATUS'],
        ];
        // Load the view and pass the data
        $this->load->view('e_khajana/cfr_views/manual_cfr_payment_response_view', $data);
    }


    public function updateManualCfrFailedResponse($department_id,$postData){        
        //*************************************************************/
        //rtpsmb updates
        //updating ekhajana_mouzadar_cfr_payments status to gras status 
        //inserting new row for ekhajana_mouzadar_cfr_payments_transactions with gras status 
        //updating ekhajana_mouzadar_cfr_records status to gras status
        //inserting new row for ekhajana_mouzadar_cfr_records_transactions with gras status    
        //*************************************************************/
        //rtpsmb db updates/initialisation
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $this->db->trans_begin();
        //*************************************************************/
        //updating ekhajana_mouzadar_cfr_payments status to gras status     
        $ekhajana_mouzadar_cfr_payments_results = $this->db->query("select * from 
                                              ekhajana_mouzadar_cfr_payments where department_id=?",
                                              array($department_id))->result();
        //echo count($ekhajana_mouzadar_cfr_payments_results);exit;
        $update_data_for_ekhajana_mouzadar_cfr_payments = [
            "gras_status" =>trim($postData['STATUS']),
            "gras_response" => json_encode($postData),
            "modified_at" => date('Y-m-d h:i:s')
        ];
        $this->db->where('department_id', $department_id);
	$this->db->update('ekhajana_mouzadar_cfr_payments', $update_data_for_ekhajana_mouzadar_cfr_payments);

        //echo json_encode($this->db->last_query());exit;

	//echo json_encode($this->db->affected_rows());exit;

        if($this->db->affected_rows() != count($ekhajana_mouzadar_cfr_payments_results)){
            $this->db->trans_rollback();
            log_message("error", "#EKHMCFRGFAILED01, Error in update, table 'ekhajana_mouzadar_cfr_payments' with last query ".json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGFAILED01'];
        }
        //*************************************************************/
        //inserting new row for ekhajana_mouzadar_cfr_payments_transactions with status Y, inserting cfr page wise 
        foreach($ekhajana_mouzadar_cfr_payments_results as $ekhajana_mouzadar_cfr_payments){
            $insert_details_for_ekhajana_mouzadar_cfr_payments_transactions = [
                "department_id" => $department_id,
                "grn_number" => '-',
                "gras_status" => trim($postData['STATUS']),
                "cfr_book_no" => $ekhajana_mouzadar_cfr_payments->cfr_book_no,
                "cfr_page_no" => $ekhajana_mouzadar_cfr_payments->cfr_page_no,
                "total_amount" => $ekhajana_mouzadar_cfr_payments->total_amount,
                "total_treasury_amount" => $ekhajana_mouzadar_cfr_payments->total_treasury_amount,
                "total_commission" => $ekhajana_mouzadar_cfr_payments->total_commission,
                "dist_code" => $ekhajana_mouzadar_cfr_payments->dist_code,
                "subdiv_code" => $ekhajana_mouzadar_cfr_payments->subdiv_code,
                "cir_code" => $ekhajana_mouzadar_cfr_payments->cir_code,
                "mouza_pargona_code" => $ekhajana_mouzadar_cfr_payments->mouza_pargona_code,
                "gras_payload" => $ekhajana_mouzadar_cfr_payments->gras_payload,
                "gras_response" => json_encode($postData),
                "year" => $ekhajana_mouzadar_cfr_payments->year,
                "doul_year" => $ekhajana_mouzadar_cfr_payments->doul_year,
                "created_at" => $ekhajana_mouzadar_cfr_payments->created_at,
                "modified_at" => date('Y-m-d h:i:s'),
                "total_patta_in_cfr" => $ekhajana_mouzadar_cfr_payments->total_patta_in_cfr,
                "application_no" => '-'
            ];
            $tstatus1 = $this->db->insert('ekhajana_mouzadar_cfr_payments_transactions', $insert_details_for_ekhajana_mouzadar_cfr_payments_transactions); 
            if ($tstatus1 != 1 )
            {
                $this->db->trans_rollback();
                log_message("error", "#EKHMCFRGFAILED02, Error in insert on ekhajana_mouzadar_cfr_payments_transactions table with last_query ". json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGFAILED02'];
            } 
        }
        //*************************************************************/
        //updating ekhajana_mouzadar_cfr_records status to gras status
        foreach($ekhajana_mouzadar_cfr_payments_results as $ekhajana_mouzadar_cfr_payments){  
            //*************************************************************/                   
            //updating ekhajana_mouzadar_cfr_records, patta wise updation
            $ekhajana_mouzadar_cfr_records_results = $this->db->query("select * from 
                                              ekhajana_mouzadar_cfr_records where cfr_book_no=?
                                              and cfr_page_no=?",
                                              array($ekhajana_mouzadar_cfr_payments->cfr_book_no,
                                              $ekhajana_mouzadar_cfr_payments->cfr_page_no))->result();     
            $update_details_for_ekhajana_mouzadar_cfr_records = [
                "status" => trim($postData['STATUS']),
                "digital_payment_status" => trim($postData['STATUS']),
                "modified_at" => date('Y-m-d h:i:s')
            ];      
            $this->db->where('cfr_book_no', $ekhajana_mouzadar_cfr_payments->cfr_book_no);
            $this->db->where('cfr_page_no', $ekhajana_mouzadar_cfr_payments->cfr_page_no);
            $this->db->update('ekhajana_mouzadar_cfr_records', $update_details_for_ekhajana_mouzadar_cfr_records);
            if($this->db->affected_rows() != count($ekhajana_mouzadar_cfr_records_results)){
                $this->db->trans_rollback();
                log_message("error", "#EKHMCFRGFAILED03, Error in update, table 'ekhajana_mouzadar_cfr_payments' with last query ".json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGFAILED03'];
            }             
            //*************************************************************/                   
            //inserting new row for ekhajana_mouzadar_cfr_records_transactions, patta wise insertion 
            $ekhajana_mouzadar_cfr_records_transaction_results = $this->db->query("select * from 
                                              ekhajana_mouzadar_cfr_records_transactions where cfr_book_no=?
                                              and cfr_page_no=?",
                                              array($ekhajana_mouzadar_cfr_payments->cfr_book_no,
                                              $ekhajana_mouzadar_cfr_payments->cfr_page_no))->result(); 
            foreach($ekhajana_mouzadar_cfr_records_transaction_results as $ekhajana_mouzadar_cfr_records_transaction){
                $insert_details_for_ekhajana_mouzadar_cfr_records_transactions = [
                    "dist_code" => $ekhajana_mouzadar_cfr_records_transaction->dist_code,
                    "subdiv_code" => $ekhajana_mouzadar_cfr_records_transaction->subdiv_code,
                    "cir_code" => $ekhajana_mouzadar_cfr_records_transaction->cir_code,
                    "mouza_pargona_code" => $ekhajana_mouzadar_cfr_records_transaction->mouza_pargona_code,
                    "lot_no" => $ekhajana_mouzadar_cfr_records_transaction->lot_no,
                    "vill_townprt_code" => $ekhajana_mouzadar_cfr_records_transaction->vill_townprt_code,
                    "patta_type_code" => $ekhajana_mouzadar_cfr_records_transaction->patta_type_code,
                    "patta_no" => $ekhajana_mouzadar_cfr_records_transaction->patta_no,
                    "cfr_book_no" => $ekhajana_mouzadar_cfr_records_transaction->cfr_book_no,
                    "cfr_page_no" => $ekhajana_mouzadar_cfr_records_transaction->cfr_page_no,
                    "cfr_copy_path" => $ekhajana_mouzadar_cfr_records_transaction->cfr_copy_path,
                    "status" => trim($postData['STATUS']),
                    "digital_payment_status" => trim($postData['STATUS']),
                    "user_details" => $ekhajana_mouzadar_cfr_records_transaction->user_details,
                    "posted_data" => $ekhajana_mouzadar_cfr_records_transaction->posted_data,
                    "created_at" => $ekhajana_mouzadar_cfr_records_transaction->created_at,
                    "modified_at" => date('Y-m-d h:i:s'),
                    "year" => $ekhajana_mouzadar_cfr_records_transaction->year,
                    "doul_year_no" => $ekhajana_mouzadar_cfr_records_transaction->doul_year_no,
                    "pdar_id_kpph" => $ekhajana_mouzadar_cfr_records_transaction->pdar_id_kpph,
                    "pdar_id_kpph_name" => $ekhajana_mouzadar_cfr_records_transaction->pdar_id_kpph_name,
                    "pdar_id_kbph" => $ekhajana_mouzadar_cfr_records_transaction->pdar_id_kbph,
                    "pdar_id_kbph_name" => $ekhajana_mouzadar_cfr_records_transaction->pdar_id_kbph_name,
                ];
                $tstatus3 = $this->db->insert('ekhajana_mouzadar_cfr_records_transactions', $insert_details_for_ekhajana_mouzadar_cfr_records_transactions); 
                if ($tstatus3 != 1 )
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGFAILED04, Error in insert on ekhajana_mouzadar_cfr_records_transactions table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGFAILED04'];
                } 
            }
            //*************************************************************/   
        }
        //*************************************************************/
        $this->db->trans_commit();
        return ['result' => 'SUCCESS', 'msg' => ''];    
    }

    public function updateManualCfrSuccessResponse_old($department_id,$postData){
        //*************************************************************/
        //rtpsmb updates 
        //creating/inserting an application with status F in ekhajana_applications-(DONE)
        //updating ekhajana_mouzadar_cfr_payments status to Y-(DONE)
        //inserting new row for ekhajana_mouzadar_cfr_payments_transactions with status Y-(DONE)
        //updating ekhajana_mouzadar_cfr_records status to Y- (DONE)
        //inserting new row for ekhajana_mouzadar_cfr_records_transactions with status Y - (DONE)        
        //creating/inserting patta wise applications in ekhajana_land_details with status F (DONE)
        //inserting into mouzadar_commission table -(DONE)
        //inserting pattawise into ekhajana_payments with status F -(DONE)
        //inserting patta wise ekhajana doat report table -(DONE)     
        //inserting into ekhajana_egras_log -(DONE)    
        //*************************************************************/
        //dharitree updates  
        //inserting into jama_wasil (DONE)
        //inserting into jamawasil_transactions (DONE) 
        //*************************************************************/
        //rtpsmb db updates/initialisation
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $this->db->trans_begin();
        //*************************************************************/
        //creating/inserting an application with status F in ekhajana_applications 
        //application details insert, one application for all the patta 
        $application_insert_details = array(
            'rtps_ref_no'           => $department_id,
            'application_no'        => "-",
            'status'                => EKHAJANA_STATUS_COMPLETED,
            "created_at"            => date('Y-m-d h:i:s'),
            "modified_at"           => null,
            "is_draft"              => 'N',
            "service_code"          => EKHAJANA_ID,
            "aadhaar_pan_ref_no"    => '-',
            "aadhaar_pan_type"      => '-', 
            "payment_flag"          => 'CP',
            "initial_payment_status"=> 'G'
        );
        $tstatus1 = $this->db->insert('ekhajana_applications', $application_insert_details); 
        if ($tstatus1 != 1 )
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHMCFRGSUCCESS01, Error in insert on ekhajana_application table with last_query ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS01'];
        } 
        
        $application_inserted_id = $this->db->insert_id();
        $application_no = EKHAJANA_CFR_GRAS_DIRECT_PAY.'/'.date('Y').'/'.$application_inserted_id;
        $data = array(
            'application_no' => $application_no,
        );    
        $this->db->where('id', $application_inserted_id);
        $this->db->where('rtps_ref_no', $department_id);
        $this->db->update('ekhajana_applications', $data);
        if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            log_message("error", "#EKHMCFRGSUCCESS02, Error in update, table 'ekhajana_applications' with last_query ". json_encode($this->db->last_query()));
            return ['result' => false, 'msg' => 'Error-Code : #EKHMCFRGSUCCESS02'];
        }
        //*************************************************************/
        //updating ekhajana_mouzadar_cfr_payments status to Y, updating cfr page wise       
        $ekhajana_mouzadar_cfr_payments_results = $this->db->query("select * from 
                                              ekhajana_mouzadar_cfr_payments where department_id=?",
                                              array($department_id))->result();
        
        $update_data_for_ekhajana_mouzadar_cfr_payments = [
            "grn_number" =>trim($postData['GRN']),
            "gras_status" =>trim($postData['STATUS']),
            "gras_response" => json_encode($postData),
            "modified_at" => date('Y-m-d h:i:s'),
            "application_no" => $application_no
        ];
        $this->db->where('department_id', $department_id);
        $this->db->update('ekhajana_mouzadar_cfr_payments', $update_data_for_ekhajana_mouzadar_cfr_payments);
        if($this->db->affected_rows() != count($ekhajana_mouzadar_cfr_payments_results)){
            $this->db->trans_rollback();
            log_message("error", "#EKHMCFRGSUCCESS03, Error in update, table 'ekhajana_mouzadar_cfr_payments' with last query ".json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS03'];
        }
        //*************************************************************/
        //inserting new row for ekhajana_mouzadar_cfr_payments_transactions with status Y, inserting cfr page wise 
        foreach($ekhajana_mouzadar_cfr_payments_results as $ekhajana_mouzadar_cfr_payments){
            $insert_details_for_ekhajana_mouzadar_cfr_payments_transactions = [
                "department_id" => $department_id,
                "grn_number" => trim($postData['GRN']),
                "gras_status" => trim($postData['STATUS']),
                "cfr_book_no" => $ekhajana_mouzadar_cfr_payments->cfr_book_no,
                "cfr_page_no" => $ekhajana_mouzadar_cfr_payments->cfr_page_no,
                "total_amount" => $ekhajana_mouzadar_cfr_payments->total_amount,
                "total_treasury_amount" => $ekhajana_mouzadar_cfr_payments->total_treasury_amount,
                "total_commission" => $ekhajana_mouzadar_cfr_payments->total_commission,
                "dist_code" => $ekhajana_mouzadar_cfr_payments->dist_code,
                "subdiv_code" => $ekhajana_mouzadar_cfr_payments->subdiv_code,
                "cir_code" => $ekhajana_mouzadar_cfr_payments->cir_code,
                "mouza_pargona_code" => $ekhajana_mouzadar_cfr_payments->mouza_pargona_code,
                "gras_payload" => $ekhajana_mouzadar_cfr_payments->gras_payload,
                "gras_response" => json_encode($postData),
                "year" => $ekhajana_mouzadar_cfr_payments->year,
                "doul_year" => $ekhajana_mouzadar_cfr_payments->doul_year,
                "created_at" => $ekhajana_mouzadar_cfr_payments->created_at,
                "modified_at" => date('Y-m-d h:i:s'),
                "total_patta_in_cfr" => $ekhajana_mouzadar_cfr_payments->total_patta_in_cfr,
                "application_no" => $application_no
            ];
            $tstatus2 = $this->db->insert('ekhajana_mouzadar_cfr_payments_transactions', $insert_details_for_ekhajana_mouzadar_cfr_payments_transactions); 
            if ($tstatus2 != 1 )
            {
                $this->db->trans_rollback();
                log_message("error", "#EKHMCFRGSUCCESS04, Error in insert on ekhajana_mouzadar_cfr_payments_transactions table with last_query ". json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS04'];
            } 
        }
        //*************************************************************/
        //updating ekhajana_mouzadar_cfr_records status to Y, patta wise updation
        //inserting new row for ekhajana_mouzadar_cfr_records_transactions with status Y, patta wise insertion    
        //creating/inserting patta wise applications in ekhajana_land_details with status F, patta wise insertion/updation
        //inserting into mouzadar_commission table, patta wise
        //inserting pattawise into ekhajana_payments with status F, patta wise insertion 
        //inserting patta wise ekhajana doat report table
        //inserting into jama_wasil
        //inserting into jamawasil_transactions 
        foreach($ekhajana_mouzadar_cfr_payments_results as $ekhajana_mouzadar_cfr_payments){                        
            //*************************************************************/                   
            //updating ekhajana_mouzadar_cfr_records status to Y, patta wise updation
            $ekhajana_mouzadar_cfr_records_results = $this->db->query("select * from 
                                              ekhajana_mouzadar_cfr_records where cfr_book_no=?
                                              and cfr_page_no=?",
                                              array($ekhajana_mouzadar_cfr_payments->cfr_book_no,
                                              $ekhajana_mouzadar_cfr_payments->cfr_page_no))->result();     
            $update_details_for_ekhajana_mouzadar_cfr_records = [
                "status" => trim($postData['STATUS']),
                "digital_payment_status" => EKHAJANA_STATUS_COMPLETED,
                "modified_at" => date('Y-m-d h:i:s')
            ];      
            $this->db->where('cfr_book_no', $ekhajana_mouzadar_cfr_payments->cfr_book_no);
            $this->db->where('cfr_page_no', $ekhajana_mouzadar_cfr_payments->cfr_page_no);
            $this->db->update('ekhajana_mouzadar_cfr_records', $update_details_for_ekhajana_mouzadar_cfr_records);
            if($this->db->affected_rows() != count($ekhajana_mouzadar_cfr_records_results)){
                $this->db->trans_rollback();
                log_message("error", "#EKHMCFRGSUCCESS05, Error in update, table 'ekhajana_mouzadar_cfr_payments' with last query ".json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS05'];
            }             
            //*************************************************************/                   
            //inserting new row for ekhajana_mouzadar_cfr_records_transactions with status Y, patta wise insertion 
            $ekhajana_mouzadar_cfr_records_transaction_results = $this->db->query("select * from 
                                              ekhajana_mouzadar_cfr_records_transactions where cfr_book_no=?
                                              and cfr_page_no=?",
                                              array($ekhajana_mouzadar_cfr_payments->cfr_book_no,
                                              $ekhajana_mouzadar_cfr_payments->cfr_page_no))->result(); 
            foreach($ekhajana_mouzadar_cfr_records_transaction_results as $ekhajana_mouzadar_cfr_records_transaction){
                $insert_details_for_ekhajana_mouzadar_cfr_records_transactions = [
                    "dist_code" => $ekhajana_mouzadar_cfr_records_transaction->dist_code,
                    "subdiv_code" => $ekhajana_mouzadar_cfr_records_transaction->subdiv_code,
                    "cir_code" => $ekhajana_mouzadar_cfr_records_transaction->cir_code,
                    "mouza_pargona_code" => $ekhajana_mouzadar_cfr_records_transaction->mouza_pargona_code,
                    "lot_no" => $ekhajana_mouzadar_cfr_records_transaction->lot_no,
                    "vill_townprt_code" => $ekhajana_mouzadar_cfr_records_transaction->vill_townprt_code,
                    "patta_type_code" => $ekhajana_mouzadar_cfr_records_transaction->patta_type_code,
                    "patta_no" => $ekhajana_mouzadar_cfr_records_transaction->patta_no,
                    "cfr_book_no" => $ekhajana_mouzadar_cfr_records_transaction->cfr_book_no,
                    "cfr_page_no" => $ekhajana_mouzadar_cfr_records_transaction->cfr_page_no,
                    "cfr_copy_path" => $ekhajana_mouzadar_cfr_records_transaction->cfr_copy_path,
                    "status" => trim($postData['STATUS']),
                    "digital_payment_status" => EKHAJANA_STATUS_COMPLETED,
                    "user_details" => $ekhajana_mouzadar_cfr_records_transaction->user_details,
                    "posted_data" => $ekhajana_mouzadar_cfr_records_transaction->posted_data,
                    "created_at" => $ekhajana_mouzadar_cfr_records_transaction->created_at,
                    "modified_at" => date('Y-m-d h:i:s'),
                    "year" => $ekhajana_mouzadar_cfr_records_transaction->year,
                    "doul_year_no" => $ekhajana_mouzadar_cfr_records_transaction->doul_year_no,
                    "pdar_id_kpph" => $ekhajana_mouzadar_cfr_records_transaction->pdar_id_kpph,
                    "pdar_id_kpph_name" => $ekhajana_mouzadar_cfr_records_transaction->pdar_id_kpph_name,
                    "pdar_id_kbph" => $ekhajana_mouzadar_cfr_records_transaction->pdar_id_kbph,
                    "pdar_id_kbph_name" => $ekhajana_mouzadar_cfr_records_transaction->pdar_id_kbph_name,
                ];
                $tstatus3 = $this->db->insert('ekhajana_mouzadar_cfr_records_transactions', $insert_details_for_ekhajana_mouzadar_cfr_records_transactions); 
                if ($tstatus3 != 1 )
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS06, Error in insert on ekhajana_mouzadar_cfr_records_transactions table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS06'];
                } 
            }
            //*************************************************************/            
            foreach($ekhajana_mouzadar_cfr_records_results as $ekhajana_mouzadar_cfr_records){
                //*************************************************************/
                //creating/inserting patta wise applications in ekhajana_land_details with status F,patta wise insertion/updation
                //getting pdar name, pdar father name, pdar id 
                if($ekhajana_mouzadar_cfr_records->pdar_id_kbph == 'NA'){
                    $pdar_id = 0;
                    $pdar_name = $ekhajana_mouzadar_cfr_records->pdar_id_kbph_name;
                    $pdar_father_name = 'NA';
                }else{
                    $pdar_id = $ekhajana_mouzadar_cfr_records->pdar_id_kbph;
                    $pdar_name = $ekhajana_mouzadar_cfr_records->pdar_id_kbph_name;
                    $pdar_father_name = $this->getPdarFatherName($ekhajana_mouzadar_cfr_records->dist_code,
                                                                $ekhajana_mouzadar_cfr_records->subdiv_code,
                                                                $ekhajana_mouzadar_cfr_records->cir_code,
                                                                $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                                                                $ekhajana_mouzadar_cfr_records->lot_no,
                                                                $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                                                                $ekhajana_mouzadar_cfr_records->patta_type_code,
                                                                $ekhajana_mouzadar_cfr_records->patta_no,
                                                                $ekhajana_mouzadar_cfr_records->pdar_id_kbph);
                    
                }
                $land_details_insert_data_arr = [
                    "rtps_ref_no"        => $department_id,
                    "application_no"     => $application_no,
                    "ld_application_no"  => "-",
                    "dist_code"          => $ekhajana_mouzadar_cfr_records->dist_code,
                    "subdiv_code"        => $ekhajana_mouzadar_cfr_records->subdiv_code,
                    "cir_code"           => $ekhajana_mouzadar_cfr_records->cir_code,
                    "mouza_pargona_code" => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                    "lot_no"             => $ekhajana_mouzadar_cfr_records->lot_no,
                    "vill_townprt_code"  => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                    "is_urban"           => $this->checkIsUrban($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code,$ekhajana_mouzadar_cfr_records->mouza_pargona_code,$ekhajana_mouzadar_cfr_records->lot_no,$ekhajana_mouzadar_cfr_records->vill_townprt_code),
                    "patta_type"         => $this->getPattaTypeFromCode($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->patta_type_code),
                    "patta_type_code"    => $ekhajana_mouzadar_cfr_records->patta_type_code,
                    "patta_no"           => $ekhajana_mouzadar_cfr_records->patta_no,
                    "pdar_name"          => $pdar_name,
                    "pdar_father_name"   => $pdar_father_name,
                    "pdar_id"            => $pdar_id,
                    "status"             => EKHAJANA_STATUS_COMPLETED,
                    "pending_with_officer" => '--',
                    "pending_at_office"  => '--',
                    "created_at"         => date('Y-m-d h:i:s'),
                    "modified_at"        => null,
                    "aadhaar_pan_ref_no" => '-',
                    "aadhaar_pan_type"   => '-',
                    "village_uuid"       => $this->getVillageUUID($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code,$ekhajana_mouzadar_cfr_records->mouza_pargona_code,$ekhajana_mouzadar_cfr_records->lot_no,$ekhajana_mouzadar_cfr_records->vill_townprt_code),
                    "application_under"  => 'MOUZADAR',
                    "revenue_year"       => $this->getCurrentRevenueYear(),
                    "payment_status"     => 'PAID',
                    "repayment_flag"     => 'C'
                ];
                $tstatus4 = $this->db->insert('ekhajana_land_details', $land_details_insert_data_arr); 
                if ($tstatus4 != 1 )
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS07, Error in insert on ekhajana_land_details table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS07'];
                }
                $land_details_inserted_id = $this->db->insert_id(); 
                $land_application_no = $application_no.'/'.$land_details_inserted_id;
                //updating ekhajana land details and creating ld_application numbers
                $data = array(
                    'application_id'     => $application_inserted_id,
                    'ld_application_no'  => $land_application_no
                );    
                $this->db->where('id', $land_details_inserted_id);
                $this->db->where('rtps_ref_no', $department_id);
                $this->db->update('ekhajana_land_details', $data);
                if($this->db->affected_rows() != 1){ 
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS08, Error in update on ekhajana_land_details table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS08'];
                }
                //*************************************************************/
                //inserting into mouzadar_commission table 
                $commission_details = $this->getCommisionDetails($ekhajana_mouzadar_cfr_records);
                if(!$commission_details['result']){
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS08C'];
                }
                $commission_details = $commission_details['data'];
                $due_amount = $commission_details['due_amount'];
                //new fields
                $up_to_demand_satisfied_year = $commission_details['demand_satisfied_year'];
                $up_to_demand_satisfied_year_no = $commission_details['demand_satisfied_year_no'];
                $total_arrear = (float)$commission_details['total_arrear'];
                $total_arrear_till_demand_satisfied_time = $commission_details['total_arrear_till_demand_satisfied_time'];
                $total_arrear_after_demand_satisfied_time = $commission_details['total_arrear_after_demand_satisfied_time'];
                $total_commission_from_arrear = $commission_details['total_commision_from_arrear'];
                $current_year_revenue = $commission_details['current_revenue'];
                $current_year_local_tax = $commission_details['current_local_tax'];
                $current_year_total_amount = $commission_details['current_revenue_with_local_tax'];
                $current_year_commission = $commission_details['total_commision_of_current_year'];
                $total_commission = $commission_details['mouzadar_total_commission'];
                $revenue_head_amount = $commission_details['revenue_head_total_amount'];
                //************************************************************/
                $commission = $commission_details['mouzadar_total_commission'];
                $rouded_commission = round($commission);
                $pl_bal_commission = number_format(((float)$commission - (float)$rouded_commission), 4);
                //****checking if the due amount is in decimal  */
                $is_decimal_check = $this->is_decimal($commission);
                $numeric_khajana = $commission;
                $decimal_khajana = 0;
                if($is_decimal_check == true)
                {
                    $round_due_amt = round($commission,4);
                    //*****splitting the amount in numeric and decimal part */
                    $split_due_amt = explode('.', $round_due_amt);
                    $numeric_khajana = $split_due_amt[0];
                    $decimal_khajana = $split_due_amt[1];
                }
                $actual_khajana = $revenue_head_amount;
                $application_under = 'MOUZADAR';
               
                $commission_details_array = array(
                    "ld_application_no"                         => $land_application_no,
                    "rtps_ref_no"                               => $department_id,
                    "application_no"                            => $application_no,
                    "dist_code"                                 => $ekhajana_mouzadar_cfr_records->dist_code,
                    "subdiv_code"                               => $ekhajana_mouzadar_cfr_records->subdiv_code,
                    "cir_code"                                  => $ekhajana_mouzadar_cfr_records->cir_code,
                    "mouza_pargona_code"                        => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                    "lot_no"                                    => $ekhajana_mouzadar_cfr_records->lot_no,
                    "vill_townprt_code"                         => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                    "patta_type_code"                           => $ekhajana_mouzadar_cfr_records->patta_type_code,
                    "patta_no"                                  => $ekhajana_mouzadar_cfr_records->patta_no,
                    "status"                                    => EKHAJANA_STATUS_COMPLETED,
                    "total_khajana"                             => $due_amount,
                    "actual_khajana"                            => $actual_khajana,
                    "patta_commission"                          => $rouded_commission,
                    'numeric_khajana_commission'                => $numeric_khajana,
                    'decimal_khajana_commission'                => $decimal_khajana,
                    'doul_year_no'                              => $this->getCurrentDoulYear(),
                    "created_at"                                => date('Y-m-d h:i:s'),
                    "modified_at"                               => date('Y-m-d h:i:s'),
                    "decimal_bal_amount"                        => $pl_bal_commission,
                    "application_under"                         => $application_under,
                    //new fields
                    "up_to_demand_satisfied_year"               => $up_to_demand_satisfied_year,
                    "up_to_demand_satisfied_year_no"            => $up_to_demand_satisfied_year_no,
                    "total_arrear"                              => $total_arrear,
                    "total_arrear_till_demand_satisfied_time"   => $total_arrear_till_demand_satisfied_time,
                    "total_arrear_after_demand_satisfied_time"  => $total_arrear_after_demand_satisfied_time,
                    "total_commission_from_arrear"              => $total_commission_from_arrear,
                    "current_year_revenue"                      => $current_year_revenue,
                    "current_year_local_tax"                    => $current_year_local_tax,
                    "current_year_total_amount"                 => $current_year_total_amount,
                    "current_year_commission"                   => $current_year_commission,
                    "total_commission"                          => $total_commission,
                    "revenue_head_amount"                       => $revenue_head_amount
                );
                $tstatus5 = $this->db->insert('ekhajana_commission_details', $commission_details_array); 
                if ($tstatus5 != 1 )
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS08, Error in insert on ekhajana_commission_details table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS08'];
                }
                //*************************************************************/                
                //inserting pattawise into ekhajana_payments with status F, patta wise insertion 
                $payment_insert_details = array(
                    "ld_application_no"     => $land_application_no,
                    "application_no"        => $application_no,
                    "due_payment"           => $due_amount,
                    "paid_amount"           => $due_amount,
                    "created_at"            => date('Y-m-d h:i:s'),
                    "status"                => EKHAJANA_STATUS_COMPLETED,
                    "aadhaar_pan_ref_no"    => "--",
                    "aadhaar_pan_type"      => "--",
                    "dist_code"             => $ekhajana_mouzadar_cfr_records->dist_code,
                    "subdiv_code"           => $ekhajana_mouzadar_cfr_records->subdiv_code,
                    "cir_code"              => $ekhajana_mouzadar_cfr_records->cir_code,
                    "mouza_pargona_code"    => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                    "lot_no"                => $ekhajana_mouzadar_cfr_records->lot_no,
                    "vill_townprt_code"     => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                    "patta_type_code"       => $ekhajana_mouzadar_cfr_records->patta_type_code,
                    "patta_no"              => $ekhajana_mouzadar_cfr_records->patta_no,
                );
                $tstatus6 = $this->db->insert('ekhajana_payment', $payment_insert_details); 
                if ($tstatus6 != 1 )
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS09, Error in insert on ekhajana_payment table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS09'];
                }
                //*************************************************************/
                //inserting patta wise ekhajana doat report table
                //getting the account details 
                $account_details_query = $this->db->query("select * from ekhajana_mouzadar_account_details where dist_code=?
                                        and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status=?",
                                        array($ekhajana_mouzadar_cfr_records->dist_code,
                                        $ekhajana_mouzadar_cfr_records->subdiv_code,
                                        $ekhajana_mouzadar_cfr_records->cir_code,
                                        $ekhajana_mouzadar_cfr_records->mouza_pargona_code,'A'));
                $account_details = $account_details_query->row();
                $hoa1= '0029-00-101-0000-000-01';
                $insert_details_ekh_mou_rpt_doat = [
                    "application_no"        =>$application_no,
                    "ld_application_no"     =>$land_application_no,
                    "dist_code"             =>$ekhajana_mouzadar_cfr_records->dist_code,
                    "subdiv_code"           =>$ekhajana_mouzadar_cfr_records->subdiv_code,
                    "cir_code"              =>$ekhajana_mouzadar_cfr_records->cir_code,
                    "mouza_pargona_code"    =>$ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                    "lot_no"                =>$ekhajana_mouzadar_cfr_records->lot_no,
                    "vill_townprt_code"     =>$ekhajana_mouzadar_cfr_records->vill_townprt_code,
                    "uuid"                  =>$land_details_insert_data_arr['village_uuid'],
                    "patta_type_code"       =>$ekhajana_mouzadar_cfr_records->patta_type_code,
                    "patta_no"              =>$ekhajana_mouzadar_cfr_records->patta_no,
                    "pdar_name"             =>$land_details_insert_data_arr['pdar_name'],
                    "dist_name"             =>$this->getDistrictNameEng($ekhajana_mouzadar_cfr_records->dist_code),
                    "subdiv_name"           =>$this->getSubDivNameEng($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code),
                    "cir_name"              =>$this->getCircleNameEng($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code),
                    "mouza_name"            =>$this->getMouzaNameEng($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code,$ekhajana_mouzadar_cfr_records->mouza_pargona_code),
                    "lot_name"              =>$this->getLotNameEng($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code,$ekhajana_mouzadar_cfr_records->mouza_pargona_code,$ekhajana_mouzadar_cfr_records->lot_no),
                    "village_name"          =>$this->getVillageNameEng($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code,$ekhajana_mouzadar_cfr_records->mouza_pargona_code,$ekhajana_mouzadar_cfr_records->lot_no,$ekhajana_mouzadar_cfr_records->vill_townprt_code),
                    "mouzadar_account_code" => $account_details->account_code,
                    "hoa"                   => $hoa1,
                    "grn_no"                => trim($postData['GRN']),
                    "department_id"         => trim($postData['DEPARTMENT_ID']),
                    "party_name"            => trim($postData['PARTYNAME']),
                    "total_amount"          => trim($postData['AMOUNT']),
                    "total_commission"      => $postData['AMOUNT']-$revenue_head_amount,
                    "total_commission_patta_wise" =>$total_commission,
                    "payment_date"          => trim($postData['ENTRY_DATE']),
                    "ekhajana_track_date"   => date('Y-m-d'),
                    "payment_type"          => $account_details->non_treasury_payment_type,
                    "egras_status"          => trim($postData['STATUS']),
                    "gras_response"         => json_encode($postData),
                    "created_at"            => date('Y-m-d h:i:s'),
                ];                
                $tstatus7 = $this->db->insert('ekhajana_mouzadari_area_report_doat', $insert_details_ekh_mou_rpt_doat); 
                if ($tstatus7 != 1 )
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS010, Error in insert on ekhajana_mouzadari_area_report_doat table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS10'];
                }
                //*************************************************************/
                //**************************** DHARITREE DB START****************************/
                //*************************************************************/
                //inserting into jama wasil 
                $this->dbb = $this->dbswitch($ekhajana_mouzadar_cfr_records->dist_code);
                $this->dbb->trans_begin();
                if(isset(json_decode($ekhajana_mouzadar_cfr_records->user_details)->unique_user_id)){
                    $user_code = json_decode($ekhajana_mouzadar_cfr_records->user_details)->unique_user_id;
                }else{
                    $user_code = 'NA';
		}
		/*
                $insertJamaWasilData = array(
                    "dist_code"                      => $ekhajana_mouzadar_cfr_records->dist_code,
                    "subdiv_code"                    => $ekhajana_mouzadar_cfr_records->subdiv_code,
                    "cir_code"                       => $ekhajana_mouzadar_cfr_records->cir_code,
                    "mouza_pargona_code"             => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                    "lot_no"                         => $ekhajana_mouzadar_cfr_records->lot_no,
                    "vill_townprt_code"              => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                    "village_uuid"                   => $land_details_insert_data_arr['village_uuid'],
                    "patta_type_code"                => $ekhajana_mouzadar_cfr_records->patta_type_code,
                    "patta_no"                       => $ekhajana_mouzadar_cfr_records->patta_no,
                    "dag_no"                         => "",
                    "financial_year"                 => $this->getCurrentRevenueYear(),
                    "entry_year"                     =>  date('Y'),
                    "entry_date"                     =>  date('Y-m-d'),
                    "revenue"                        => $current_year_revenue,
                    "local_tax"                      => $current_year_local_tax,
                    "opening_balance"                => $total_arrear,
                    "due_payment"                    => $due_amount,
                    "other_payment"                  => null,
                    'last_revenue_payment_amount'    => null, 
                    'last_local_tax_payment_amount'  => null,
                    "dol_year_no"                    => $ekhajana_mouzadar_cfr_records->doul_year_no,
                    "pdar_id"                        => $land_details_insert_data_arr['pdar_id'],
                    "pdar_name"                      => $land_details_insert_data_arr['pdar_name'],
                    "pdar_father_name"               => $land_details_insert_data_arr['pdar_father_name'],
                    "status"                         => JAMA_WASIL_STATUS_ONLINE,
                    "created_at"                     => date('Y-m-d h:i:s'),
                    "modified_at"                    => date('Y-m-d h:i:s'),
                    "user_code"                      => $user_code,
                    "application_no"                 => $application_no,
                    "ld_application_no"              => $land_application_no,
                    "case_no"                        => "CFR-".$land_application_no,
                    'pay_status'                     => JAMA_WASIL_STATUS_PAID,
                    'updated_trough'                 => 'CP',
                    'department_id'                  => $department_id,
                    'grn_no'                         => trim($postData['GRN'])
                );
                $tstatus9 = $this->dbb->insert('jama_wasil', $insertJamaWasilData); 
                if ($tstatus9 != 1 )
                {
                    $this->dbb->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS012, Error in insert on jama_wasil table with last_query ". json_encode($this->dbb->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS12'];
		}
		 */
                                //checking jama wasil exiting unpaid row 
                $jama_wasil_q = $this->dbb->query("select * from jama_wasil where dist_code=? and subdiv_code=?
                and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=?
                and patta_no=?", array($ekhajana_mouzadar_cfr_records->dist_code,
                $ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code,
                $ekhajana_mouzadar_cfr_records->mouza_pargona_code,$ekhajana_mouzadar_cfr_records->lot_no,
                $ekhajana_mouzadar_cfr_records->vill_townprt_code,$ekhajana_mouzadar_cfr_records->patta_type_code,
                $ekhajana_mouzadar_cfr_records->patta_no));
                if($jama_wasil_q->num_rows() > 0){
                    if($jama_wasil_q->num_rows() != 1){
                        $this->dbb->trans_rollback();
                        log_message("error", "#EKHMCFRGSUCCESS012JE, Multiple rows found in jama wasil with last query ". json_encode($this->dbb->last_query()));
                        return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS012JE'];
                    }
                    $jama_wasil_row = $jama_wasil_q->row();
                    if($jama_wasil_row->pay_status == "PAID"){
                        $this->dbb->trans_rollback();
                        log_message("error", "#EKHMCFRGSUCCESS012JEPP, Patta Already Paid With Last Query ". json_encode($this->dbb->last_query()));
                        return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS012JEPP'];
                    } 
                    if($jama_wasil_row->pay_status == "UNPAID"){
                        $update_jama_wasil_arr = [
                            "pdar_id"                        => $land_details_insert_data_arr['pdar_id'],
                            "pdar_name"                      => $land_details_insert_data_arr['pdar_name'],
                            "pdar_father_name"               => $land_details_insert_data_arr['pdar_father_name'],
                            "status"                         => JAMA_WASIL_STATUS_ONLINE,
                            "modified_at"                    => date('Y-m-d h:i:s'),
                            "user_code"                      => $user_code,
                            "application_no"                 => $application_no,
                            "ld_application_no"              => $land_application_no,
                            "case_no"                        => "CFR-".$land_application_no,
                            'pay_status'                     => JAMA_WASIL_STATUS_PAID,
                            'updated_trough'                 => 'CP',
                            'department_id'                  => $department_id,
                            'grn_no'                         => trim($postData['GRN'])
                        ];
                        $this->dbb->where('id', $jama_wasil_row->id);
                        $this->dbb->where('dist_code',$ekhajana_mouzadar_cfr_records->dist_code);
                        $this->dbb->where('subdiv_code',$ekhajana_mouzadar_cfr_records->subdiv_code);
                        $this->dbb->where('cir_code',$ekhajana_mouzadar_cfr_records->cir_code);
                        $this->dbb->where('mouza_pargona_code',$ekhajana_mouzadar_cfr_records->mouza_pargona_code);
                        $this->dbb->where('lot_no',$ekhajana_mouzadar_cfr_records->lot_no);
                        $this->dbb->where('vill_townprt_code',$ekhajana_mouzadar_cfr_records->vill_townprt_code);
                        $this->dbb->where('patta_type_code',$ekhajana_mouzadar_cfr_records->patta_type_code);
                        $this->dbb->where('patta_no',$ekhajana_mouzadar_cfr_records->patta_no);
                        $this->dbb->update('jama_wasil', $update_jama_wasil_arr);
                        if($this->dbb->affected_rows() != 1){ 
                            $this->dbb->trans_rollback();
                            log_message("error", "#EKHMCFRGSUCCESS08, Error in update on ekhajana_land_details table with last_query ". json_encode($this->db->last_query()));
                            return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS08'];
                        }
			$jama_wasil_id = $jama_wasil_row->id;
                        $insertJamaWasilData_trans_data = array(
                            "dist_code"                      => $ekhajana_mouzadar_cfr_records->dist_code,
                            "subdiv_code"                    => $ekhajana_mouzadar_cfr_records->subdiv_code,
                            "cir_code"                       => $ekhajana_mouzadar_cfr_records->cir_code,
                            "mouza_pargona_code"             => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                            "lot_no"                         => $ekhajana_mouzadar_cfr_records->lot_no,
                            "vill_townprt_code"              => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                            "village_uuid"                   => $land_details_insert_data_arr['village_uuid'],
                            "patta_type_code"                => $ekhajana_mouzadar_cfr_records->patta_type_code,
                            "patta_no"                       => $ekhajana_mouzadar_cfr_records->patta_no,
                            "dag_no"                         => "",
                            "financial_year"                 => $this->getCurrentRevenueYear(),
                            "entry_year"                     =>  date('Y'),
                            "entry_date"                     =>  date('Y-m-d'),
                            "revenue"                        => $current_year_revenue,
                            "local_tax"                      => $current_year_local_tax,
                            "opening_balance"                => $total_arrear,
                            "due_payment"                    => $due_amount,
                            "other_payment"                  => null,
                            'last_revenue_payment_amount'    => null, 
                            'last_local_tax_payment_amount'  => null,
                            "dol_year_no"                    => $ekhajana_mouzadar_cfr_records->doul_year_no,
                            "pdar_id"                        => $land_details_insert_data_arr['pdar_id'],
                            "pdar_name"                      => $land_details_insert_data_arr['pdar_name'],
                            "pdar_father_name"               => $land_details_insert_data_arr['pdar_father_name'],
                            "status"                         => JAMA_WASIL_STATUS_ONLINE,
                            "created_at"                     => date('Y-m-d h:i:s'),
                            "modified_at"                    => date('Y-m-d h:i:s'),
                            "user_code"                      => $user_code,
                            "application_no"                 => $application_no,
                            "ld_application_no"              => $land_application_no,
                            "case_no"                        => "CFR-".$land_application_no,
                            'pay_status'                     => JAMA_WASIL_STATUS_PAID,
                            'updated_trough'                 => 'CP',
                            'department_id'                  => $department_id,
                            'grn_no'                         => trim($postData['GRN'])
                        );
                    }                    
		}else{
		  
                    $insertJamaWasilData_trans_data = array(
                        "dist_code"                      => $ekhajana_mouzadar_cfr_records->dist_code,
                        "subdiv_code"                    => $ekhajana_mouzadar_cfr_records->subdiv_code,
                        "cir_code"                       => $ekhajana_mouzadar_cfr_records->cir_code,
                        "mouza_pargona_code"             => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                        "lot_no"                         => $ekhajana_mouzadar_cfr_records->lot_no,
                        "vill_townprt_code"              => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                        "village_uuid"                   => $land_details_insert_data_arr['village_uuid'],
                        "patta_type_code"                => $ekhajana_mouzadar_cfr_records->patta_type_code,
                        "patta_no"                       => $ekhajana_mouzadar_cfr_records->patta_no,
                        "dag_no"                         => "",
                        "financial_year"                 => $this->getCurrentRevenueYear(),
                        "entry_year"                     =>  date('Y'),
                        "entry_date"                     =>  date('Y-m-d'),
                        "revenue"                        => $current_year_revenue,
                        "local_tax"                      => $current_year_local_tax,
                        "opening_balance"                => $total_arrear,
                        "due_payment"                    => $due_amount,
                        "other_payment"                  => null,
                        'last_revenue_payment_amount'    => null, 
                        'last_local_tax_payment_amount'  => null,
                        "dol_year_no"                    => $ekhajana_mouzadar_cfr_records->doul_year_no,
                        "pdar_id"                        => $land_details_insert_data_arr['pdar_id'],
                        "pdar_name"                      => $land_details_insert_data_arr['pdar_name'],
                        "pdar_father_name"               => $land_details_insert_data_arr['pdar_father_name'],
                        "status"                         => JAMA_WASIL_STATUS_ONLINE,
                        "created_at"                     => date('Y-m-d h:i:s'),
                        "modified_at"                    => date('Y-m-d h:i:s'),
                        "user_code"                      => $user_code,
                        "application_no"                 => $application_no,
                        "ld_application_no"              => $land_application_no,
                        "case_no"                        => "CFR-".$land_application_no,
                        'pay_status'                     => JAMA_WASIL_STATUS_PAID,
                        'updated_trough'                 => 'CP',
                        'department_id'                  => $department_id,
                        'grn_no'                         => trim($postData['GRN'])
                    );

                    $insertJamaWasilData = array(
                        "dist_code"                      => $ekhajana_mouzadar_cfr_records->dist_code,
                        "subdiv_code"                    => $ekhajana_mouzadar_cfr_records->subdiv_code,
                        "cir_code"                       => $ekhajana_mouzadar_cfr_records->cir_code,
                        "mouza_pargona_code"             => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                        "lot_no"                         => $ekhajana_mouzadar_cfr_records->lot_no,
                        "vill_townprt_code"              => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                        "village_uuid"                   => $land_details_insert_data_arr['village_uuid'],
                        "patta_type_code"                => $ekhajana_mouzadar_cfr_records->patta_type_code,
                        "patta_no"                       => $ekhajana_mouzadar_cfr_records->patta_no,
                        "dag_no"                         => "",
                        "financial_year"                 => $this->getCurrentRevenueYear(),
                        "entry_year"                     =>  date('Y'),
                        "entry_date"                     =>  date('Y-m-d'),
                        "revenue"                        => $current_year_revenue,
                        "local_tax"                      => $current_year_local_tax,
                        "opening_balance"                => 0,
                        "due_payment"                    => 0,
                        "other_payment"                  => null,
                        'last_revenue_payment_amount'    => null, 
                        'last_local_tax_payment_amount'  => null,
                        "dol_year_no"                    => $ekhajana_mouzadar_cfr_records->doul_year_no,
                        "pdar_id"                        => $land_details_insert_data_arr['pdar_id'],
                        "pdar_name"                      => $land_details_insert_data_arr['pdar_name'],
                        "pdar_father_name"               => $land_details_insert_data_arr['pdar_father_name'],
                        "status"                         => JAMA_WASIL_STATUS_ONLINE,
                        "created_at"                     => date('Y-m-d h:i:s'),
                        "modified_at"                    => date('Y-m-d h:i:s'),
                        "user_code"                      => $user_code,
                        "application_no"                 => $application_no,
                        "ld_application_no"              => $land_application_no,
                        "case_no"                        => "CFR-".$land_application_no,
                        'pay_status'                     => JAMA_WASIL_STATUS_PAID,
                        'updated_trough'                 => 'CP',
                        'department_id'                  => $department_id,
                        'grn_no'                         => trim($postData['GRN'])
                    );
                    $tstatus9 = $this->dbb->insert('jama_wasil', $insertJamaWasilData); 
                    if ($tstatus9 != 1 )
                    {
                        $this->dbb->trans_rollback();
                        log_message("error", "#EKHMCFRGSUCCESS012, Error in insert on jama_wasil table with last_query ". json_encode($this->dbb->last_query()));
                        return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS12'];
                    }
                    $jama_wasil_id = $this->dbb->insert_id();
                }
                //*************************************************************/
                //inserting into jama wasil transaction
                $jama_wasil_inserted_id = $jama_wasil_id; 		
                $insertJamaWasilData['jama_wasil_id'] = $jama_wasil_inserted_id;
                $tstatus10 = $this->dbb->insert('jama_wasil_transaction', $insertJamaWasilData_trans_data); 
                if ($tstatus10 != 1 )
                {
                    $this->dbb->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS013, Error in insert on jama_wasil_transaction table with last_query ". json_encode($this->dbb->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS13'];
                }
                //*************************************************************/
                //**************************** DHARITREE DB END******************************
            }
            //*************************************************************/
        }
        //*************************************************************/
        //inserting into ekhajana_applicant_details with kar pora powa hol, Mouzadar Name
        //*************************************************************/
        // insert into ekhajana egras log
        $egrasLogInsertDataArr = [
            'application_no'     => $application_no,
            'egras_status'       => $postData['STATUS'],
            'amount'             => $postData['AMOUNT'],
            "egras_response"     => json_encode($postData),
            "created_at"         => date('Y-m-d h:i:s'),
            "aadhaar_pan_ref_no" => '-',
            "aadhaar_pan_type"   => '-',
        ];
        $tstatus8 = $this->db->insert('ekhajana_egras_log', $egrasLogInsertDataArr); 
        if ($tstatus8 != 1 )
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHMCFRGSUCCESS011, Error in insert on ekhajana_egras_log table with last_query ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS11'];
        }
        //*************************************************************/
        if($this->db->trans_status()==FALSE || $this->dbb->trans_status()==FALSE){
            $this->db->trans_rollback();
            $this->dbb->trans_rollback();
            return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS11TSFDB'];
        }else{
            $this->db->trans_commit();
            $this->dbb->trans_commit();        
            return ['result' => 'SUCCESS', 'msg' => ''];    
        }         
        
    }

    public function getPdarFatherName($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no,$pdar_id)
    {
        $this->dbb = $this->dbswitch($dist_code);
        $sql = $this->dbb->query("SELECT * FROM chitha_pattadar WHERE dist_code=? AND subdiv_code=? AND cir_code=?
            AND mouza_pargona_code=? AND lot_no=? AND vill_townprt_code=? AND patta_type_code=? AND
            patta_no=? AND pdar_id=?",
            array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $lot_no, $vill_townprt_code,
            $patta_type_code, $patta_no, $pdar_id));
        return $sql->row()->pdar_father;
    }
    
    //getting current revenue year
    public function getCurrentRevenueYear(){
        if (date('m') <= 6)
        {
            $yera = date('Y') - 1;
            $currentRevenueYear = date($yera).'-'.date('Y');
        }
        else
        {
            $yera = date('Y') + 1;
            $currentRevenueYear = date('Y').'-'.date($yera);
        }
        return $currentRevenueYear;
    }

    public function checkIsUrban($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code)
    {
        $this->dbb = $this->dbswitch($dist_code);
        $sql = $this->dbb->query("select * from location where dist_code=? and subdiv_code=? and cir_code=?  and mouza_pargona_code=? and lot_no=? and vill_townprt_code=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code));
        if($sql->num_rows()!= 0){
            if($sql->row()->rural_urban =='U')
            {
                return "Y";
            }elseif($sql->row()->rural_urban =='R'){
                return "N";
            }
        }else{
            return null;
        }
    }

    public function getPattaTypeFromCode($dist_code,$code)
    {
        $this->dbb = $this->dbswitch($dist_code);
        $sql = "select pattatype_eng from patta_code where type_code='$code'";
        return $this->dbb->query($sql)->row()->pattatype_eng;
    }

    //getting village uuid
    function getVillageUUID($dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_no,$vill_code){    
        $this->dbb = $this->dbswitch($dist_code);      
        $sql = "select * from location where dist_code=? and subdiv_code=? and cir_code=? 
                and mouza_pargona_code=? and lot_no=? and vill_townprt_code=?";
        $query = $this->dbb->query($sql,array(strval($dist_code),strval($subdiv_code),strval($cir_code),strval($mouza_code),strval($lot_no),strval($vill_code)));
        $result = $query->result(); 
        if(count($result) != 0 ){
            return $result[0]->uuid;
        }else{
            return "";
        }
    }

    //getting amount breakdowns
    public function getCommisionDetails($patta_row){
        $this->dbb = $this->dbswitch($patta_row->dist_code);
        //******************************************************************/
        //getting demand satisfaction details
        $demand_satisfaction_details_query = $this->dbb->query("select * from ekhajana_demand_satisfy_year where
                                    dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?",
                                    array($patta_row->dist_code, $patta_row->subdiv_code, $patta_row->cir_code,
                                    $patta_row->mouza_pargona_code));
        $demand_satisfaction_details_count = $demand_satisfaction_details_query->num_rows();
        //******************************************************************/
        //if demand satisfaction is not found then from arrear commision will be 30% and
        //from the current year commission will be 30%
        if($demand_satisfaction_details_count == 0){
            $arrear_pre_update_query = $this->dbb->query("select arrear from ekhajana_arrear_pre_updation where dist_code=? and subdiv_code=?
            and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and
            patta_no=?", array($patta_row->dist_code, $patta_row->subdiv_code, $patta_row->cir_code,
            $patta_row->mouza_pargona_code,$patta_row->lot_no,$patta_row->vill_townprt_code, $patta_row->patta_type_code,
            $patta_row->patta_no));
            if($arrear_pre_update_query->num_rows() == 0){
                log_message('error', '#EEKHARNF, Arrear Row Not Found With The Last Query '.json_encode($this->dbb->last_query()));
                return ["result"=>false, "msg" => "Some Error Occured, Err Code-#EEKHARNF"];
            }
            $total_arrear = $arrear_pre_update_query->row()->arrear;
            //******************************************************************/
            //getting jama wasil details
            $current_doul_query = $this->dbb->query("select * from current_doul_demand where dist_code=? and subdiv_code=?
                                and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=?
                                and patta_type_code=? and patta_no=?",
                                array($patta_row->dist_code, $patta_row->subdiv_code, $patta_row->cir_code,
                                $patta_row->mouza_pargona_code,$patta_row->lot_no,
                                $patta_row->vill_townprt_code, $patta_row->patta_type_code,
                                $patta_row->patta_no));
            $current_doul_row_count = $current_doul_query->num_rows();
            if($current_doul_row_count != 1){
                log_message('error', '#EKHJWRNF, Jama Wasil Not Found With The Last Query '.json_encode($this->dbb->last_query()));
                return ["result"=>false, "msg" => "Some Error Occured, Err Code-#EEKHJWRNF"];
            }
            $current_doul_details = $current_doul_query->row();
            //******************************************************************/
            $current_revenue = $current_doul_details->dag_revenue;
            $current_local_tax = $current_doul_details->dag_local_tax;
            $total_revenue_with_tax = $current_revenue+$current_local_tax;
            $due_amount = $total_arrear+$total_revenue_with_tax;
            $total_commision_of_current_year = ($total_revenue_with_tax * 30/100);
            $total_commision_from_arrear = ($total_arrear * 30/100);
            $mouzadar_total_commission = $total_commision_of_current_year+$total_commision_from_arrear;
            $revenue_head_total_amount = $due_amount-$mouzadar_total_commission;
            //******************************************************************/
            return ["result"=>true, "data" => [
                "demand_satisfied_year" => '--',
                "demand_satisfied_year_no" => '--',
                "total_arrear_till_demand_satisfied_time" => 0,
                "total_arrear_after_demand_satisfied_time" => 0,
                "total_commision_from_arrear" => $total_commision_from_arrear,
                "current_revenue" => $current_revenue,
                "current_local_tax" => $current_local_tax,
                "current_revenue_with_local_tax" => $total_revenue_with_tax,
                "total_commision_of_current_year" => $total_commision_of_current_year,
                "mouzadar_total_commission" => $mouzadar_total_commission,
                "revenue_head_total_amount" => $revenue_head_total_amount,
                "total_arrear" => $total_arrear,
                "due_amount" => $due_amount
            ]];
        }
        //******************************************************************/
        if($demand_satisfaction_details_count > 1){
            log_message('error', '#EKHDSDNF, Error In Fetching Demand Satisfaction Information With The Last Query '.json_encode($this->dbb->last_query()));
            return ["result"=>false, "msg" => "Error In Fetching Demand Satisfaction Information, Err Code-#EKHDSDNF"];
        }
        $demand_satisfaction_details = $demand_satisfaction_details_query->row();
        $demand_satisfied_year = new DateTime(substr($demand_satisfaction_details->upto_demand_satisfied_year,5,4));
        //******************************************************************/
        //getting year wise details
        $year_wise_arrear_query = $this->dbb->query("select * from ekhajana_year_wise_arrear where
                                        dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?
                                        and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?
                                        order by id asc",
                                        array($patta_row->dist_code, $patta_row->subdiv_code, $patta_row->cir_code,
                                        $patta_row->mouza_pargona_code,$patta_row->lot_no,
                                        $patta_row->vill_townprt_code, $patta_row->patta_type_code,
                                        $patta_row->patta_no));
        $year_wise_arrear_count = $year_wise_arrear_query->num_rows();
        if($year_wise_arrear_count == 0){
            log_message('error', '#EKHYWANF, year_wise_arrear Not Found With The Last Query '.json_encode($this->dbb->last_query()));
            return ["result"=>false, "msg" => "Some Error Occured, Err Code-#EKHYWANF"];
        }
        $year_wise_arrear_details = $year_wise_arrear_query->result();
        //******************************************************************/
        //getting total arreear till demand satisfied time
        $total_arrear_till_demand_satisfied_time = 0;
        foreach($year_wise_arrear_details as $year_wise_arrear){
            $arrear_year = new DateTime(substr($year_wise_arrear->financial_year,5,4));
            if($arrear_year<=$demand_satisfied_year){
                $total_arrear_till_demand_satisfied_time = $total_arrear_till_demand_satisfied_time+$year_wise_arrear->year_arrear;
            }
        }
        //******************************************************************/
        //getting total areear after demand satisfied time
        $total_arrear_after_demand_satisfied_time = 0;
        foreach($year_wise_arrear_details as $year_wise_arrear){
            $arrear_year = new DateTime(substr($year_wise_arrear->financial_year,5,4));
            if($arrear_year > $demand_satisfied_year){
                $total_arrear_after_demand_satisfied_time = $total_arrear_after_demand_satisfied_time+$year_wise_arrear->year_arrear;
            }
        }
        //******************************************************************/
        //total commission from arrear
        $total_commision_from_arrear = $total_arrear_till_demand_satisfied_time +
                                        ($total_arrear_after_demand_satisfied_time * 30/100);
        //******************************************************************/
        //getting current doul demand details
        $current_doul_demand_query = $this->dbb->query("select * from current_doul_demand where dist_code=? and subdiv_code=?
                                and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=?
                                and patta_type_code=? and patta_no=?",
                                array($patta_row->dist_code, $patta_row->subdiv_code, $patta_row->cir_code,
                                $patta_row->mouza_pargona_code,$patta_row->lot_no,
                                $patta_row->vill_townprt_code, $patta_row->patta_type_code,
                                $patta_row->patta_no));
        $current_doul_demand_row_count = $current_doul_demand_query->num_rows();
        if($current_doul_demand_row_count != 1){
            log_message('error', '#EKHJWRNF, current doul demand Not Found With The Last Query '.json_encode($this->dbb->last_query()));
            return ["result"=>false, "msg" => "Some Error Occured, Err Code-#EKHJWRNF"];
        }
        $current_doul_demand_details = $current_doul_demand_query->row();
        //******************************************************************/
        $current_revenue = $current_doul_demand_details->dag_revenue;
        $current_local_tax = $current_doul_demand_details->dag_local_tax;
        $total_revenue_with_tax = $current_revenue+$current_local_tax;
        $total_arrear = $year_wise_arrear_details[0]->total_arrear;
        $due_amount = $total_arrear+$current_revenue+$current_local_tax;
        $total_commision_of_current_year = ($total_revenue_with_tax * 30/100);
        $mouzadar_total_commission = $total_commision_from_arrear+$total_commision_of_current_year;
        $revenue_head_total_amount = $due_amount-$mouzadar_total_commission;
        //******************************************************************/
        return ["result"=>true, "data" => [
            "demand_satisfied_year" => $demand_satisfaction_details->upto_demand_satisfied_year,
            "demand_satisfied_year_no" => substr($demand_satisfaction_details->upto_demand_satisfied_year,5,4),
            "total_arrear_till_demand_satisfied_time" => $total_arrear_till_demand_satisfied_time,
            "total_arrear_after_demand_satisfied_time" => $total_arrear_after_demand_satisfied_time,
            "total_commision_from_arrear" => $total_commision_from_arrear,
            "current_revenue" => $current_revenue,
            "current_local_tax" => $current_local_tax,
            "current_revenue_with_local_tax" => $total_revenue_with_tax,
            "total_commision_of_current_year" => $total_commision_of_current_year,
            "mouzadar_total_commission" => $mouzadar_total_commission,
            "revenue_head_total_amount" => $revenue_head_total_amount,
            "total_arrear" => $total_arrear,
            "due_amount" => $due_amount
        ]];
    }

    //checking for decimal method
    function is_decimal($val)
    {
        return is_numeric( $val ) && floor( $val ) != $val;
    }

    //getting current doul year 
    public function getCurrentDoulYear(){
        if (date('m') <= 6)
        {
            $currentDoulYear = date('Y');
        }
        else
        {
            $currentDoulYear = date('Y') + 1;
        }
        return $currentDoulYear;
    }

    public function getDistrictNameEng($dist_code) {
        $this->dbb = $this->dbswitch($dist_code);
        $q = "select locname_eng AS district from location where dist_code ='$dist_code'  and "
            . " subdiv_code='00' and cir_code='00' and mouza_pargona_code='00' and "
            . " vill_townprt_code='00000' and lot_no='00'";
        $district = $this->dbb->query("select locname_eng AS district from location where dist_code ='$dist_code'  and "
            . " subdiv_code='00' and cir_code='00' and mouza_pargona_code='00' and "
            . " vill_townprt_code='00000' and lot_no='00'");
        return trim($district->row()->district);
    }

    public function getSubDivNameEng($dist_code, $subdiv_code) {
        $this->dbb = $this->dbswitch($dist_code);
        // $this->dbswitch($dist_code);
        $subdiv = $this->dbb->query("select locname_eng AS subdiv from location where dist_code ='$dist_code'  and "
            . " subdiv_code='$subdiv_code' and cir_code='00' and mouza_pargona_code='00' and "
            . " vill_townprt_code='00000' and lot_no='00'");
        return trim($subdiv->row()->subdiv);
    }

    public function getCircleNameEng($dist_code, $subdiv_code, $circle_code) {
        $this->dbb = $this->dbswitch($dist_code);
        //$ds=$CI->session->userdata['db'];
        // $this->dbswitch($dist_code);
        $circle = $this->dbb->query("select locname_eng AS circle from location where dist_code ='$dist_code'  and "
            . " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='00' and "
            . " vill_townprt_code='00000' and lot_no='00'");
        return trim($circle->row()->circle);
    }

    public function getMouzaNameEng($dist_code, $subdiv_code, $circle_code, $mouza_code) {
        $this->dbb = $this->dbswitch($dist_code);
        // $this->dbswitch($dist_code);
        //$ds=$CI->session->userdata['db'];
        $mouza = $this->dbb->query("select locname_eng AS mouza from location where dist_code ='$dist_code'  and "
            . " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
            . " vill_townprt_code='00000' and lot_no='00'");
        return trim($mouza->row()->mouza);
    }

    public function getLotNameEng($dist_code, $subdiv_code, $circle_code, $mouza_code, $lot_no) {
        $this->dbb = $this->dbswitch($dist_code);
        // $this->dbswitch($dist_code);
        //$ds=$CI->session->userdata['db'];
        $lot = $this->dbb->query("select locname_eng AS lot from location where dist_code ='$dist_code'  and "
            . " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
            . " vill_townprt_code='00000' and lot_no='$lot_no'");
        return trim($lot->row()->lot);
    }

    public function getVillageNameEng($dist_code, $subdiv_code, $circle_code, $mouza_code, $lot_no, $vill_code) {
        $this->dbb = $this->dbswitch($dist_code);
        // $this->dbswitch($dist_code);
        //$ds=$CI->session->userdata['db'];
        $q = "select locname_eng AS village from location where dist_code ='$dist_code'  and "
            . " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
            . " vill_townprt_code='$vill_code' and lot_no='$lot_no'";
        $village = $this->dbb->query("select locname_eng AS village from location where dist_code ='$dist_code'  and "
            . " subdiv_code='$subdiv_code' and cir_code='$circle_code' and mouza_pargona_code='$mouza_code' and "
            . " vill_townprt_code='$vill_code' and lot_no='$lot_no'");
        return trim($village->row()->village);
    }

    public function verifyPayment($department_id){
        //*************************************************************/
        //rtpsmb db updates/initialisation
        $this->db  = $this->load->database('rtpsmb', TRUE);
        //*************************************************************/
        //gettingn pay load from the department id 
        $ekhajana_cfr_payment_row = $this->db->query("select * from ekhajana_mouzadar_cfr_payments
                                    where trim(department_id)=?", array(trim($department_id)))->row();        
        $gras_payload = json_decode($ekhajana_cfr_payment_row->gras_payload);        
        //echo "<pre>";
        //var_dump($gras_payload);
        //exit;
        $data['action'] = E_GRAS_URL;
        $data['DEPARTMENT_ID'] = $gras_payload->DEPARTMENT_ID;
        $data['OFFICE_CODE']   = $gras_payload->OFFICE_CODE;
        $data['AMOUNT']        = $gras_payload->CHALLAN_AMOUNT + $gras_payload->TOTAL_NON_TREASURY_AMOUNT;
        $data['ACTION_CODE']   = 'GETCIN';
        $data['SUB_SYSTEM']     = "BASUNDHARA|".base_url('e-khazana-manual-payment-response');
        //echo "<pre>";
        //var_dump($data);
        //exit;
        //$data['_view'] = 'e_khajana/cfr_views/getCinForm';
	//$this->load->view('layouts/main',$data);
        $this->load->view('e_khajana/cfr_views/getCinForm', $data);
        //*************************************************************/
    }



    public function updateManualCfrSuccessResponse($department_id,$postData){
        //*************************************************************/
        //rtpsmb updates 
        //creating/inserting an application with status F in ekhajana_applications-(DONE)
        //updating ekhajana_mouzadar_cfr_payments status to Y-(DONE)
        //inserting new row for ekhajana_mouzadar_cfr_payments_transactions with status Y-(DONE)
        //updating ekhajana_mouzadar_cfr_records status to Y- (DONE)
        //inserting new row for ekhajana_mouzadar_cfr_records_transactions with status Y - (DONE)        
        //creating/inserting patta wise applications in ekhajana_land_details with status F (DONE)
        //inserting into mouzadar_commission table -(DONE)
        //inserting pattawise into ekhajana_payments with status F -(DONE)
        //inserting patta wise ekhajana doat report table -(DONE)     
        //inserting into ekhajana_egras_log -(DONE)    
        //*************************************************************/
        //dharitree updates  
        //inserting into jama_wasil (DONE)
        //inserting into jamawasil_transactions (DONE) 
        //*************************************************************/
        //rtpsmb db updates/initialisation
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $this->db->trans_begin();
        //*************************************************************/
        //creating/inserting an application with status F in ekhajana_applications 
        //application details insert, one application for all the patta 
        $application_insert_details = array(
            'rtps_ref_no'           => $department_id,
            'application_no'        => "-",
            'status'                => EKHAJANA_STATUS_COMPLETED,
            "created_at"            => date('Y-m-d h:i:s'),
            "modified_at"           => null,
            "is_draft"              => 'N',
            "service_code"          => EKHAJANA_ID,
            "aadhaar_pan_ref_no"    => '-',
            "aadhaar_pan_type"      => '-', 
            "payment_flag"          => 'CP',
            "initial_payment_status"=> 'G'
        );
        $tstatus1 = $this->db->insert('ekhajana_applications', $application_insert_details); 
        if ($tstatus1 != 1 )
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHMCFRGSUCCESS01, Error in insert on ekhajana_application table with last_query ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS01'];
        } 
        
        $application_inserted_id = $this->db->insert_id();
        $application_no = EKHAJANA_CFR_GRAS_DIRECT_PAY.'/'.date('Y').'/'.$application_inserted_id;
        $data = array(
            'application_no' => $application_no,
        );    
        $this->db->where('id', $application_inserted_id);
        $this->db->where('rtps_ref_no', $department_id);
        $this->db->update('ekhajana_applications', $data);
        if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            log_message("error", "#EKHMCFRGSUCCESS02, Error in update, table 'ekhajana_applications' with last_query ". json_encode($this->db->last_query()));
            return ['result' => false, 'msg' => 'Error-Code : #EKHMCFRGSUCCESS02'];
        }
        //*************************************************************/
        //updating ekhajana_mouzadar_cfr_payments status to Y, updating cfr page wise       
        $ekhajana_mouzadar_cfr_payments_results = $this->db->query("select * from 
                                              ekhajana_mouzadar_cfr_payments where department_id=?",
                                              array($department_id))->result();
        
        $update_data_for_ekhajana_mouzadar_cfr_payments = [
            "grn_number" =>trim($postData['GRN']),
            "gras_status" =>trim($postData['STATUS']),
            "gras_response" => json_encode($postData),
            "modified_at" => date('Y-m-d h:i:s'),
            "application_no" => $application_no
        ];
        $this->db->where('department_id', $department_id);
        $this->db->update('ekhajana_mouzadar_cfr_payments', $update_data_for_ekhajana_mouzadar_cfr_payments);
        if($this->db->affected_rows() != count($ekhajana_mouzadar_cfr_payments_results)){
            $this->db->trans_rollback();
            log_message("error", "#EKHMCFRGSUCCESS03, Error in update, table 'ekhajana_mouzadar_cfr_payments' with last query ".json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS03'];
        }
        //*************************************************************/
        //inserting new row for ekhajana_mouzadar_cfr_payments_transactions with status Y, inserting cfr page wise 
        foreach($ekhajana_mouzadar_cfr_payments_results as $ekhajana_mouzadar_cfr_payments){
            $insert_details_for_ekhajana_mouzadar_cfr_payments_transactions = [
                "department_id" => $department_id,
                "grn_number" => trim($postData['GRN']),
                "gras_status" => trim($postData['STATUS']),
                "cfr_book_no" => $ekhajana_mouzadar_cfr_payments->cfr_book_no,
                "cfr_page_no" => $ekhajana_mouzadar_cfr_payments->cfr_page_no,
                "total_amount" => $ekhajana_mouzadar_cfr_payments->total_amount,
                "total_treasury_amount" => $ekhajana_mouzadar_cfr_payments->total_treasury_amount,
                "total_commission" => $ekhajana_mouzadar_cfr_payments->total_commission,
                "dist_code" => $ekhajana_mouzadar_cfr_payments->dist_code,
                "subdiv_code" => $ekhajana_mouzadar_cfr_payments->subdiv_code,
                "cir_code" => $ekhajana_mouzadar_cfr_payments->cir_code,
                "mouza_pargona_code" => $ekhajana_mouzadar_cfr_payments->mouza_pargona_code,
                "gras_payload" => $ekhajana_mouzadar_cfr_payments->gras_payload,
                "gras_response" => json_encode($postData),
                "year" => $ekhajana_mouzadar_cfr_payments->year,
                "doul_year" => $ekhajana_mouzadar_cfr_payments->doul_year,
                "created_at" => $ekhajana_mouzadar_cfr_payments->created_at,
                "modified_at" => date('Y-m-d h:i:s'),
                "total_patta_in_cfr" => $ekhajana_mouzadar_cfr_payments->total_patta_in_cfr,
                "application_no" => $application_no
            ];
            $tstatus2 = $this->db->insert('ekhajana_mouzadar_cfr_payments_transactions', $insert_details_for_ekhajana_mouzadar_cfr_payments_transactions); 
            if ($tstatus2 != 1 )
            {
                $this->db->trans_rollback();
                log_message("error", "#EKHMCFRGSUCCESS04, Error in insert on ekhajana_mouzadar_cfr_payments_transactions table with last_query ". json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS04'];
            } 
        }
        //*************************************************************/
        //updating ekhajana_mouzadar_cfr_records status to Y, patta wise updation
        //inserting new row for ekhajana_mouzadar_cfr_records_transactions with status Y, patta wise insertion    
        //creating/inserting patta wise applications in ekhajana_land_details with status F, patta wise insertion/updation
        //inserting into mouzadar_commission table, patta wise
        //inserting pattawise into ekhajana_payments with status F, patta wise insertion 
        //inserting patta wise ekhajana doat report table
        //inserting into jama_wasil
        //inserting into jamawasil_transactions 
        foreach($ekhajana_mouzadar_cfr_payments_results as $ekhajana_mouzadar_cfr_payments){                        
            //*************************************************************/                   
            //updating ekhajana_mouzadar_cfr_records status to Y, patta wise updation
            $ekhajana_mouzadar_cfr_records_results = $this->db->query("select * from 
                                              ekhajana_mouzadar_cfr_records where cfr_book_no=?
                                              and cfr_page_no=?",
                                              array($ekhajana_mouzadar_cfr_payments->cfr_book_no,
                                              $ekhajana_mouzadar_cfr_payments->cfr_page_no))->result();     
            $update_details_for_ekhajana_mouzadar_cfr_records = [
                "status" => trim($postData['STATUS']),
                "digital_payment_status" => EKHAJANA_STATUS_COMPLETED,
                "modified_at" => date('Y-m-d h:i:s')
            ];      
            $this->db->where('cfr_book_no', $ekhajana_mouzadar_cfr_payments->cfr_book_no);
            $this->db->where('cfr_page_no', $ekhajana_mouzadar_cfr_payments->cfr_page_no);
            $this->db->update('ekhajana_mouzadar_cfr_records', $update_details_for_ekhajana_mouzadar_cfr_records);
            if($this->db->affected_rows() != count($ekhajana_mouzadar_cfr_records_results)){
                $this->db->trans_rollback();
                log_message("error", "#EKHMCFRGSUCCESS05, Error in update, table 'ekhajana_mouzadar_cfr_payments' with last query ".json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS05'];
            }             
            //*************************************************************/                   
            //inserting new row for ekhajana_mouzadar_cfr_records_transactions with status Y, patta wise insertion 
            $ekhajana_mouzadar_cfr_records_transaction_results = $this->db->query("select * from 
                                              ekhajana_mouzadar_cfr_records_transactions where cfr_book_no=?
                                              and cfr_page_no=?",
                                              array($ekhajana_mouzadar_cfr_payments->cfr_book_no,
                                              $ekhajana_mouzadar_cfr_payments->cfr_page_no))->result(); 
            foreach($ekhajana_mouzadar_cfr_records_transaction_results as $ekhajana_mouzadar_cfr_records_transaction){
                $insert_details_for_ekhajana_mouzadar_cfr_records_transactions = [
                    "dist_code" => $ekhajana_mouzadar_cfr_records_transaction->dist_code,
                    "subdiv_code" => $ekhajana_mouzadar_cfr_records_transaction->subdiv_code,
                    "cir_code" => $ekhajana_mouzadar_cfr_records_transaction->cir_code,
                    "mouza_pargona_code" => $ekhajana_mouzadar_cfr_records_transaction->mouza_pargona_code,
                    "lot_no" => $ekhajana_mouzadar_cfr_records_transaction->lot_no,
                    "vill_townprt_code" => $ekhajana_mouzadar_cfr_records_transaction->vill_townprt_code,
                    "patta_type_code" => $ekhajana_mouzadar_cfr_records_transaction->patta_type_code,
                    "patta_no" => $ekhajana_mouzadar_cfr_records_transaction->patta_no,
                    "cfr_book_no" => $ekhajana_mouzadar_cfr_records_transaction->cfr_book_no,
                    "cfr_page_no" => $ekhajana_mouzadar_cfr_records_transaction->cfr_page_no,
                    "cfr_copy_path" => $ekhajana_mouzadar_cfr_records_transaction->cfr_copy_path,
                    "status" => trim($postData['STATUS']),
                    "digital_payment_status" => EKHAJANA_STATUS_COMPLETED,
                    "user_details" => $ekhajana_mouzadar_cfr_records_transaction->user_details,
                    "posted_data" => $ekhajana_mouzadar_cfr_records_transaction->posted_data,
                    "created_at" => $ekhajana_mouzadar_cfr_records_transaction->created_at,
                    "modified_at" => date('Y-m-d h:i:s'),
                    "year" => $ekhajana_mouzadar_cfr_records_transaction->year,
                    "doul_year_no" => $ekhajana_mouzadar_cfr_records_transaction->doul_year_no,
                    "pdar_id_kpph" => $ekhajana_mouzadar_cfr_records_transaction->pdar_id_kpph,
                    "pdar_id_kpph_name" => $ekhajana_mouzadar_cfr_records_transaction->pdar_id_kpph_name,
                    "pdar_id_kbph" => $ekhajana_mouzadar_cfr_records_transaction->pdar_id_kbph,
                    "pdar_id_kbph_name" => $ekhajana_mouzadar_cfr_records_transaction->pdar_id_kbph_name,
                ];
                $tstatus3 = $this->db->insert('ekhajana_mouzadar_cfr_records_transactions', $insert_details_for_ekhajana_mouzadar_cfr_records_transactions); 
                if ($tstatus3 != 1 )
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS06, Error in insert on ekhajana_mouzadar_cfr_records_transactions table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS06'];
                } 
            }
            //*************************************************************/            
            foreach($ekhajana_mouzadar_cfr_records_results as $ekhajana_mouzadar_cfr_records){
                //*************************************************************/
                //creating/inserting patta wise applications in ekhajana_land_details with status F,patta wise insertion/updation
                //getting pdar name, pdar father name, pdar id 
                if($ekhajana_mouzadar_cfr_records->pdar_id_kbph == 'NA'){
                    $pdar_id = 0;
                    $pdar_name = $ekhajana_mouzadar_cfr_records->pdar_id_kbph_name;
                    $pdar_father_name = 'NA';
                }else{
                    $pdar_id = $ekhajana_mouzadar_cfr_records->pdar_id_kbph;
                    $pdar_name = $ekhajana_mouzadar_cfr_records->pdar_id_kbph_name;
                    $pdar_father_name = $this->getPdarFatherName($ekhajana_mouzadar_cfr_records->dist_code,
                                                                $ekhajana_mouzadar_cfr_records->subdiv_code,
                                                                $ekhajana_mouzadar_cfr_records->cir_code,
                                                                $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                                                                $ekhajana_mouzadar_cfr_records->lot_no,
                                                                $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                                                                $ekhajana_mouzadar_cfr_records->patta_type_code,
                                                                $ekhajana_mouzadar_cfr_records->patta_no,
                                                                $ekhajana_mouzadar_cfr_records->pdar_id_kbph);
                    
                }
                $land_details_insert_data_arr = [
                    "rtps_ref_no"        => $department_id,
                    "application_no"     => $application_no,
                    "ld_application_no"  => "-",
                    "dist_code"          => $ekhajana_mouzadar_cfr_records->dist_code,
                    "subdiv_code"        => $ekhajana_mouzadar_cfr_records->subdiv_code,
                    "cir_code"           => $ekhajana_mouzadar_cfr_records->cir_code,
                    "mouza_pargona_code" => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                    "lot_no"             => $ekhajana_mouzadar_cfr_records->lot_no,
                    "vill_townprt_code"  => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                    "is_urban"           => $this->checkIsUrban($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code,$ekhajana_mouzadar_cfr_records->mouza_pargona_code,$ekhajana_mouzadar_cfr_records->lot_no,$ekhajana_mouzadar_cfr_records->vill_townprt_code),
                    "patta_type"         => $this->getPattaTypeFromCode($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->patta_type_code),
                    "patta_type_code"    => $ekhajana_mouzadar_cfr_records->patta_type_code,
                    "patta_no"           => $ekhajana_mouzadar_cfr_records->patta_no,
                    "pdar_name"          => $pdar_name,
                    "pdar_father_name"   => $pdar_father_name,
                    "pdar_id"            => $pdar_id,
                    "status"             => EKHAJANA_STATUS_COMPLETED,
                    "pending_with_officer" => '--',
                    "pending_at_office"  => '--',
                    "created_at"         => date('Y-m-d h:i:s'),
                    "modified_at"        => null,
                    "aadhaar_pan_ref_no" => '-',
                    "aadhaar_pan_type"   => '-',
                    "village_uuid"       => $this->getVillageUUID($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code,$ekhajana_mouzadar_cfr_records->mouza_pargona_code,$ekhajana_mouzadar_cfr_records->lot_no,$ekhajana_mouzadar_cfr_records->vill_townprt_code),
                    "application_under"  => 'MOUZADAR',
                    "revenue_year"       => $this->getCurrentRevenueYear(),
                    "payment_status"     => 'PAID',
                    "repayment_flag"     => 'C'
                ];
                $tstatus4 = $this->db->insert('ekhajana_land_details', $land_details_insert_data_arr); 
                if ($tstatus4 != 1 )
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS07, Error in insert on ekhajana_land_details table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS07'];
                }
                $land_details_inserted_id = $this->db->insert_id(); 
                $land_application_no = $application_no.'/'.$land_details_inserted_id;
                //updating ekhajana land details and creating ld_application numbers
                $data = array(
                    'application_id'     => $application_inserted_id,
                    'ld_application_no'  => $land_application_no
                );    
                $this->db->where('id', $land_details_inserted_id);
                $this->db->where('rtps_ref_no', $department_id);
                $this->db->update('ekhajana_land_details', $data);
                if($this->db->affected_rows() != 1){ 
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS08, Error in update on ekhajana_land_details table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS08'];
                }
                //*************************************************************/
                //inserting into mouzadar_commission table 
                $commission_details = $this->getCommisionDetails($ekhajana_mouzadar_cfr_records);
                if(!$commission_details['result']){
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS08C'];
                }
                $commission_details = $commission_details['data'];
                $due_amount = $commission_details['due_amount'];
                //new fields
                $up_to_demand_satisfied_year = $commission_details['demand_satisfied_year'];
                $up_to_demand_satisfied_year_no = $commission_details['demand_satisfied_year_no'];
                $total_arrear = (float)$commission_details['total_arrear'];
                $total_arrear_till_demand_satisfied_time = $commission_details['total_arrear_till_demand_satisfied_time'];
                $total_arrear_after_demand_satisfied_time = $commission_details['total_arrear_after_demand_satisfied_time'];
                $total_commission_from_arrear = $commission_details['total_commision_from_arrear'];
                $current_year_revenue = $commission_details['current_revenue'];
                $current_year_local_tax = $commission_details['current_local_tax'];
                $current_year_total_amount = $commission_details['current_revenue_with_local_tax'];
                $current_year_commission = $commission_details['total_commision_of_current_year'];
                $total_commission = $commission_details['mouzadar_total_commission'];
                $revenue_head_amount = $commission_details['revenue_head_total_amount'];
                //************************************************************/
                $commission = $commission_details['mouzadar_total_commission'];
                $rouded_commission = round($commission);
                $pl_bal_commission = number_format(((float)$commission - (float)$rouded_commission), 4);
                //****checking if the due amount is in decimal  */
                $is_decimal_check = $this->is_decimal($commission);
                $numeric_khajana = $commission;
                $decimal_khajana = 0;
                if($is_decimal_check == true)
                {
                    $round_due_amt = round($commission,4);
                    //*****splitting the amount in numeric and decimal part */
                    $split_due_amt = explode('.', $round_due_amt);
                    $numeric_khajana = $split_due_amt[0];
                    $decimal_khajana = $split_due_amt[1];
                }
                $actual_khajana = $revenue_head_amount;
                $application_under = 'MOUZADAR';
               
                $commission_details_array = array(
                    "ld_application_no"                         => $land_application_no,
                    "rtps_ref_no"                               => $department_id,
                    "application_no"                            => $application_no,
                    "dist_code"                                 => $ekhajana_mouzadar_cfr_records->dist_code,
                    "subdiv_code"                               => $ekhajana_mouzadar_cfr_records->subdiv_code,
                    "cir_code"                                  => $ekhajana_mouzadar_cfr_records->cir_code,
                    "mouza_pargona_code"                        => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                    "lot_no"                                    => $ekhajana_mouzadar_cfr_records->lot_no,
                    "vill_townprt_code"                         => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                    "patta_type_code"                           => $ekhajana_mouzadar_cfr_records->patta_type_code,
                    "patta_no"                                  => $ekhajana_mouzadar_cfr_records->patta_no,
                    "status"                                    => EKHAJANA_STATUS_COMPLETED,
                    "total_khajana"                             => $due_amount,
                    "actual_khajana"                            => $actual_khajana,
                    "patta_commission"                          => $rouded_commission,
                    'numeric_khajana_commission'                => $numeric_khajana,
                    'decimal_khajana_commission'                => $decimal_khajana,
                    'doul_year_no'                              => $this->getCurrentDoulYear(),
                    "created_at"                                => date('Y-m-d h:i:s'),
                    "modified_at"                               => date('Y-m-d h:i:s'),
                    "decimal_bal_amount"                        => $pl_bal_commission,
                    "application_under"                         => $application_under,
                    //new fields
                    "up_to_demand_satisfied_year"               => $up_to_demand_satisfied_year,
                    "up_to_demand_satisfied_year_no"            => $up_to_demand_satisfied_year_no,
                    "total_arrear"                              => $total_arrear,
                    "total_arrear_till_demand_satisfied_time"   => $total_arrear_till_demand_satisfied_time,
                    "total_arrear_after_demand_satisfied_time"  => $total_arrear_after_demand_satisfied_time,
                    "total_commission_from_arrear"              => $total_commission_from_arrear,
                    "current_year_revenue"                      => $current_year_revenue,
                    "current_year_local_tax"                    => $current_year_local_tax,
                    "current_year_total_amount"                 => $current_year_total_amount,
                    "current_year_commission"                   => $current_year_commission,
                    "total_commission"                          => $total_commission,
                    "revenue_head_amount"                       => $revenue_head_amount
                );
                $tstatus5 = $this->db->insert('ekhajana_commission_details', $commission_details_array); 
                if ($tstatus5 != 1 )
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS08, Error in insert on ekhajana_commission_details table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS08'];
                }
                //*************************************************************/                
                //inserting pattawise into ekhajana_payments with status F, patta wise insertion 
                $payment_insert_details = array(
                    "ld_application_no"     => $land_application_no,
                    "application_no"        => $application_no,
                    "due_payment"           => $due_amount,
                    "paid_amount"           => $due_amount,
                    "created_at"            => date('Y-m-d h:i:s'),
                    "status"                => EKHAJANA_STATUS_COMPLETED,
                    "aadhaar_pan_ref_no"    => "--",
                    "aadhaar_pan_type"      => "--",
                    "dist_code"             => $ekhajana_mouzadar_cfr_records->dist_code,
                    "subdiv_code"           => $ekhajana_mouzadar_cfr_records->subdiv_code,
                    "cir_code"              => $ekhajana_mouzadar_cfr_records->cir_code,
                    "mouza_pargona_code"    => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                    "lot_no"                => $ekhajana_mouzadar_cfr_records->lot_no,
                    "vill_townprt_code"     => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                    "patta_type_code"       => $ekhajana_mouzadar_cfr_records->patta_type_code,
                    "patta_no"              => $ekhajana_mouzadar_cfr_records->patta_no,
                );
                $tstatus6 = $this->db->insert('ekhajana_payment', $payment_insert_details); 
                if ($tstatus6 != 1 )
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS09, Error in insert on ekhajana_payment table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS09'];
                }
                //*************************************************************/
                //inserting patta wise ekhajana doat report table
                //getting the account details 
                $account_details_query = $this->db->query("select * from ekhajana_mouzadar_account_details where dist_code=?
                                        and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status=?",
                                        array($ekhajana_mouzadar_cfr_records->dist_code,
                                        $ekhajana_mouzadar_cfr_records->subdiv_code,
                                        $ekhajana_mouzadar_cfr_records->cir_code,
                                        $ekhajana_mouzadar_cfr_records->mouza_pargona_code,'A'));
                $account_details = $account_details_query->row();
                $hoa1= '0029-00-101-0000-000-01';
                $insert_details_ekh_mou_rpt_doat = [
                    "application_no"        =>$application_no,
                    "ld_application_no"     =>$land_application_no,
                    "dist_code"             =>$ekhajana_mouzadar_cfr_records->dist_code,
                    "subdiv_code"           =>$ekhajana_mouzadar_cfr_records->subdiv_code,
                    "cir_code"              =>$ekhajana_mouzadar_cfr_records->cir_code,
                    "mouza_pargona_code"    =>$ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                    "lot_no"                =>$ekhajana_mouzadar_cfr_records->lot_no,
                    "vill_townprt_code"     =>$ekhajana_mouzadar_cfr_records->vill_townprt_code,
                    "uuid"                  =>$land_details_insert_data_arr['village_uuid'],
                    "patta_type_code"       =>$ekhajana_mouzadar_cfr_records->patta_type_code,
                    "patta_no"              =>$ekhajana_mouzadar_cfr_records->patta_no,
                    "pdar_name"             =>$land_details_insert_data_arr['pdar_name'],
                    "dist_name"             =>$this->getDistrictNameEng($ekhajana_mouzadar_cfr_records->dist_code),
                    "subdiv_name"           =>$this->getSubDivNameEng($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code),
                    "cir_name"              =>$this->getCircleNameEng($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code),
                    "mouza_name"            =>$this->getMouzaNameEng($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code,$ekhajana_mouzadar_cfr_records->mouza_pargona_code),
                    "lot_name"              =>$this->getLotNameEng($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code,$ekhajana_mouzadar_cfr_records->mouza_pargona_code,$ekhajana_mouzadar_cfr_records->lot_no),
                    "village_name"          =>$this->getVillageNameEng($ekhajana_mouzadar_cfr_records->dist_code,$ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code,$ekhajana_mouzadar_cfr_records->mouza_pargona_code,$ekhajana_mouzadar_cfr_records->lot_no,$ekhajana_mouzadar_cfr_records->vill_townprt_code),
                    "mouzadar_account_code" => $account_details->account_code,
                    "hoa"                   => $hoa1,
                    "grn_no"                => trim($postData['GRN']),
                    "department_id"         => trim($postData['DEPARTMENT_ID']),
                    "party_name"            => trim($postData['PARTYNAME']),
                    "total_amount"          => trim($postData['AMOUNT']),
                    "total_commission"      => $postData['AMOUNT']-$revenue_head_amount,
                    "total_commission_patta_wise" =>$total_commission,
                    "payment_date"          => trim($postData['ENTRY_DATE']),
                    "ekhajana_track_date"   => date('Y-m-d'),
                    "payment_type"          => $account_details->non_treasury_payment_type,
                    "egras_status"          => trim($postData['STATUS']),
                    "gras_response"         => json_encode($postData),
                    "created_at"            => date('Y-m-d h:i:s'),
                ];                
                $tstatus7 = $this->db->insert('ekhajana_mouzadari_area_report_doat', $insert_details_ekh_mou_rpt_doat); 
                if ($tstatus7 != 1 )
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHMCFRGSUCCESS010, Error in insert on ekhajana_mouzadari_area_report_doat table with last_query ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS10'];
                }
                //*************************************************************/
                //**************************** DHARITREE DB START****************************/
                //*************************************************************/
                //inserting into jama wasil 
                $this->dbb = $this->dbswitch($ekhajana_mouzadar_cfr_records->dist_code);
                $this->dbb->trans_begin();
                if(isset(json_decode($ekhajana_mouzadar_cfr_records->user_details)->unique_user_id)){
                    $user_code = json_decode($ekhajana_mouzadar_cfr_records->user_details)->unique_user_id;
                }else{
                    $user_code = 'NA';
                }
                //checking jama wasil exiting unpaid row 
                $jama_wasil_q = $this->dbb->query("select * from jama_wasil where dist_code=? and subdiv_code=?
                and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=?
                and patta_no=?", array($ekhajana_mouzadar_cfr_records->dist_code,
                $ekhajana_mouzadar_cfr_records->subdiv_code,$ekhajana_mouzadar_cfr_records->cir_code,
                $ekhajana_mouzadar_cfr_records->mouza_pargona_code,$ekhajana_mouzadar_cfr_records->lot_no,
                $ekhajana_mouzadar_cfr_records->vill_townprt_code,$ekhajana_mouzadar_cfr_records->patta_type_code,
                $ekhajana_mouzadar_cfr_records->patta_no));
                if($jama_wasil_q->num_rows() > 0){
                    if($jama_wasil_q->num_rows() != 1){
                        $this->dbb->trans_rollback();
                        log_message("error", "#EKHMCFRGSUCCESS012JE, Multiple rows found in jama wasil with last query ". json_encode($this->dbb->last_query()));
                        return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS012JE'];
                    }
                    $jama_wasil_row = $jama_wasil_q->row();
                    if($jama_wasil_row->pay_status == "PAID"){
                        $this->dbb->trans_rollback();
                        log_message("error", "#EKHMCFRGSUCCESS012JEPP, Patta Already Paid With Last Query ". json_encode($this->dbb->last_query()));
                        return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS012JEPP'];
                    } 
                    if($jama_wasil_row->pay_status == "UNPAID"){
                        $update_jama_wasil_arr = [
                            "pdar_id"                        => $land_details_insert_data_arr['pdar_id'],
                            "pdar_name"                      => $land_details_insert_data_arr['pdar_name'],
                            "pdar_father_name"               => $land_details_insert_data_arr['pdar_father_name'],
                            "status"                         => JAMA_WASIL_STATUS_ONLINE,
                            "modified_at"                    => date('Y-m-d h:i:s'),
                            "user_code"                      => $user_code,
                            "application_no"                 => $application_no,
                            "ld_application_no"              => $land_application_no,
                            "case_no"                        => "CFR-".$land_application_no,
                            'pay_status'                     => JAMA_WASIL_STATUS_PAID,
                            'updated_trough'                 => 'CP',
                            'department_id'                  => $department_id,
                            'grn_no'                         => trim($postData['GRN'])
                        ];
                        $this->dbb->where('id', $jama_wasil_row->id);
                        $this->dbb->where('dist_code',$ekhajana_mouzadar_cfr_records->dist_code);
                        $this->dbb->where('subdiv_code',$ekhajana_mouzadar_cfr_records->subdiv_code);
                        $this->dbb->where('cir_code',$ekhajana_mouzadar_cfr_records->cir_code);
                        $this->dbb->where('mouza_pargona_code',$ekhajana_mouzadar_cfr_records->mouza_pargona_code);
                        $this->dbb->where('lot_no',$ekhajana_mouzadar_cfr_records->lot_no);
                        $this->dbb->where('vill_townprt_code',$ekhajana_mouzadar_cfr_records->vill_townprt_code);
                        $this->dbb->where('patta_type_code',$ekhajana_mouzadar_cfr_records->patta_type_code);
                        $this->dbb->where('patta_no',$ekhajana_mouzadar_cfr_records->patta_no);
                        $this->dbb->update('jama_wasil', $update_jama_wasil_arr);
                        if($this->dbb->affected_rows() != 1){ 
                            $this->dbb->trans_rollback();
                            log_message("error", "#EKHMCFRGSUCCESS08, Error in update on ekhajana_land_details table with last_query ". json_encode($this->db->last_query()));
                            return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS08'];
                        }
                        $jama_wasil_id = $jama_wasil_row->id;
                        $insertJamaWasilData_trans_data = array(
                            "dist_code"                      => $ekhajana_mouzadar_cfr_records->dist_code,
                            "subdiv_code"                    => $ekhajana_mouzadar_cfr_records->subdiv_code,
                            "cir_code"                       => $ekhajana_mouzadar_cfr_records->cir_code,
                            "mouza_pargona_code"             => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                            "lot_no"                         => $ekhajana_mouzadar_cfr_records->lot_no,
                            "vill_townprt_code"              => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                            "village_uuid"                   => $land_details_insert_data_arr['village_uuid'],
                            "patta_type_code"                => $ekhajana_mouzadar_cfr_records->patta_type_code,
                            "patta_no"                       => $ekhajana_mouzadar_cfr_records->patta_no,
                            "dag_no"                         => "",
                            "financial_year"                 => $this->getCurrentRevenueYear(),
                            "entry_year"                     =>  date('Y'),
                            "entry_date"                     =>  date('Y-m-d'),
                            "revenue"                        => $current_year_revenue,
                            "local_tax"                      => $current_year_local_tax,
                            "opening_balance"                => $total_arrear,
                            "due_payment"                    => $due_amount,
                            "other_payment"                  => null,
                            'last_revenue_payment_amount'    => null, 
                            'last_local_tax_payment_amount'  => null,
                            "dol_year_no"                    => $ekhajana_mouzadar_cfr_records->doul_year_no,
                            "pdar_id"                        => $land_details_insert_data_arr['pdar_id'],
                            "pdar_name"                      => $land_details_insert_data_arr['pdar_name'],
                            "pdar_father_name"               => $land_details_insert_data_arr['pdar_father_name'],
                            "status"                         => JAMA_WASIL_STATUS_ONLINE,
                            "created_at"                     => date('Y-m-d h:i:s'),
                            "modified_at"                    => date('Y-m-d h:i:s'),
                            "user_code"                      => $user_code,
                            "application_no"                 => $application_no,
                            "ld_application_no"              => $land_application_no,
                            "case_no"                        => "CFR-".$land_application_no,
                            'pay_status'                     => JAMA_WASIL_STATUS_PAID,
                            'updated_trough'                 => 'CP',
                            'department_id'                  => $department_id,
                            'grn_no'                         => trim($postData['GRN'])
                        );
                        $jama_wasil_inserted_id = $jama_wasil_id; 
                        $insertJamaWasilData_trans_data['jama_wasil_id'] = $jama_wasil_inserted_id;
                        $tstatus10 = $this->dbb->insert('jama_wasil_transaction', $insertJamaWasilData_trans_data); 
                        if ($tstatus10 != 1 )
                        {
                            $this->dbb->trans_rollback();
                            log_message("error", "#EKHMCFRGSUCCESS013, Error in insert on jama_wasil_transaction table with last_query ". json_encode($this->dbb->last_query()));
                            return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS13'];
                        }
                    }                    
                }else{
                    $insertJamaWasilData_trans_data = array(
                        "dist_code"                      => $ekhajana_mouzadar_cfr_records->dist_code,
                        "subdiv_code"                    => $ekhajana_mouzadar_cfr_records->subdiv_code,
                        "cir_code"                       => $ekhajana_mouzadar_cfr_records->cir_code,
                        "mouza_pargona_code"             => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                        "lot_no"                         => $ekhajana_mouzadar_cfr_records->lot_no,
                        "vill_townprt_code"              => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                        "village_uuid"                   => $land_details_insert_data_arr['village_uuid'],
                        "patta_type_code"                => $ekhajana_mouzadar_cfr_records->patta_type_code,
                        "patta_no"                       => $ekhajana_mouzadar_cfr_records->patta_no,
                        "dag_no"                         => "",
                        "financial_year"                 => $this->getCurrentRevenueYear(),
                        "entry_year"                     =>  date('Y'),
                        "entry_date"                     =>  date('Y-m-d'),
                        "revenue"                        => $current_year_revenue,
                        "local_tax"                      => $current_year_local_tax,
                        "opening_balance"                => $total_arrear,
                        "due_payment"                    => $due_amount,
                        "other_payment"                  => null,
                        'last_revenue_payment_amount'    => null, 
                        'last_local_tax_payment_amount'  => null,
                        "dol_year_no"                    => $ekhajana_mouzadar_cfr_records->doul_year_no,
                        "pdar_id"                        => $land_details_insert_data_arr['pdar_id'],
                        "pdar_name"                      => $land_details_insert_data_arr['pdar_name'],
                        "pdar_father_name"               => $land_details_insert_data_arr['pdar_father_name'],
                        "status"                         => JAMA_WASIL_STATUS_ONLINE,
                        "created_at"                     => date('Y-m-d h:i:s'),
                        "modified_at"                    => date('Y-m-d h:i:s'),
                        "user_code"                      => $user_code,
                        "application_no"                 => $application_no,
                        "ld_application_no"              => $land_application_no,
                        "case_no"                        => "CFR-".$land_application_no,
                        'pay_status'                     => JAMA_WASIL_STATUS_PAID,
                        'updated_trough'                 => 'CP',
                        'department_id'                  => $department_id,
                        'grn_no'                         => trim($postData['GRN'])
                    );
                    $insertJamaWasilData = array(
                        "dist_code"                      => $ekhajana_mouzadar_cfr_records->dist_code,
                        "subdiv_code"                    => $ekhajana_mouzadar_cfr_records->subdiv_code,
                        "cir_code"                       => $ekhajana_mouzadar_cfr_records->cir_code,
                        "mouza_pargona_code"             => $ekhajana_mouzadar_cfr_records->mouza_pargona_code,
                        "lot_no"                         => $ekhajana_mouzadar_cfr_records->lot_no,
                        "vill_townprt_code"              => $ekhajana_mouzadar_cfr_records->vill_townprt_code,
                        "village_uuid"                   => $land_details_insert_data_arr['village_uuid'],
                        "patta_type_code"                => $ekhajana_mouzadar_cfr_records->patta_type_code,
                        "patta_no"                       => $ekhajana_mouzadar_cfr_records->patta_no,
                        "dag_no"                         => "",
                        "financial_year"                 => $this->getCurrentRevenueYear(),
                        "entry_year"                     =>  date('Y'),
                        "entry_date"                     =>  date('Y-m-d'),
                        "revenue"                        => $current_year_revenue,
                        "local_tax"                      => $current_year_local_tax,
                        "opening_balance"                => 0,
                        "due_payment"                    => 0,
                        "other_payment"                  => null,
                        'last_revenue_payment_amount'    => null, 
                        'last_local_tax_payment_amount'  => null,
                        "dol_year_no"                    => $ekhajana_mouzadar_cfr_records->doul_year_no,
                        "pdar_id"                        => $land_details_insert_data_arr['pdar_id'],
                        "pdar_name"                      => $land_details_insert_data_arr['pdar_name'],
                        "pdar_father_name"               => $land_details_insert_data_arr['pdar_father_name'],
                        "status"                         => JAMA_WASIL_STATUS_ONLINE,
                        "created_at"                     => date('Y-m-d h:i:s'),
                        "modified_at"                    => date('Y-m-d h:i:s'),
                        "user_code"                      => $user_code,
                        "application_no"                 => $application_no,
                        "ld_application_no"              => $land_application_no,
                        "case_no"                        => "CFR-".$land_application_no,
                        'pay_status'                     => JAMA_WASIL_STATUS_PAID,
                        'updated_trough'                 => 'CP',
                        'department_id'                  => $department_id,
                        'grn_no'                         => trim($postData['GRN'])
                    );
                    $tstatus9 = $this->dbb->insert('jama_wasil', $insertJamaWasilData); 
                    if ($tstatus9 != 1 )
                    {
                        $this->dbb->trans_rollback();
                        log_message("error", "#EKHMCFRGSUCCESS012, Error in insert on jama_wasil table with last_query ". json_encode($this->dbb->last_query()));
                        return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS12'];
                    }
                    $jama_wasil_id = $this->dbb->insert_id();
                    $jama_wasil_inserted_id = $jama_wasil_id; 
                    $insertJamaWasilData_trans_data['jama_wasil_id'] = $jama_wasil_inserted_id;
                    $tstatus10 = $this->dbb->insert('jama_wasil_transaction', $insertJamaWasilData_trans_data); 
                    if ($tstatus10 != 1 )
                    {
                        $this->dbb->trans_rollback();
                        log_message("error", "#EKHMCFRGSUCCESS013, Error in insert on jama_wasil_transaction table with last_query ". json_encode($this->dbb->last_query()));
                        return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS13'];
                    }
                }
                //**************************** DHARITREE DB END******************************
            }
            //*************************************************************/
        }
        //*************************************************************/
        //inserting into ekhajana_applicant_details with kar pora powa hol, Mouzadar Name
        //*************************************************************/
        // insert into ekhajana egras log
        $egrasLogInsertDataArr = [
            'application_no'     => $application_no,
            'egras_status'       => $postData['STATUS'],
            'amount'             => $postData['AMOUNT'],
            "egras_response"     => json_encode($postData),
            "created_at"         => date('Y-m-d h:i:s'),
            "aadhaar_pan_ref_no" => '-',
            "aadhaar_pan_type"   => '-',
        ];
        $tstatus8 = $this->db->insert('ekhajana_egras_log', $egrasLogInsertDataArr); 
        if ($tstatus8 != 1 )
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHMCFRGSUCCESS011, Error in insert on ekhajana_egras_log table with last_query ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS11'];
        }
        //*************************************************************/
        if($this->db->trans_status()==FALSE || $this->dbb->trans_status()==FALSE){
            $this->db->trans_rollback();
            $this->dbb->trans_rollback();
            return ['result' => 'SERVER-ERROR', 'msg' => 'Error-Code : #EKHMCFRGSUCCESS11TSFDB'];
        }else{
            $this->db->trans_commit();
            $this->dbb->trans_commit();        
            return ['result' => 'SUCCESS', 'msg' => ''];    
        }         
        
    }



}
