<?php

class EkhajanaMouzadarModel extends CI_Model {

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
      }   else if($this->session->userdata('dist_code') == "39"){
         $this->db=$CI->load->database('bajali', TRUE);
      } 
      //return $this->db;      
    }
    
    //db switch live method
    public function dbswitch_live(){       
        $CI=&get_instance();
        if($this->session->userdata('dist_code') == "02"){
           $this->db=$CI->load->database('dhubri_live', TRUE);    
        } else if($this->session->userdata('dist_code') == "05"){
           $this->db=$CI->load->database('barpeta_live', TRUE);    
        } else if($this->session->userdata('dist_code') == "10"){
           $this->db=$CI->load->database('chirang_live', TRUE);       
        } else if($this->session->userdata('dist_code') == "13"){
           $this->db=$CI->load->database('bongaigaon_live', TRUE);    
        }  else if($this->session->userdata('dist_code') == "17"){
           $this->db=$CI->load->database('dibrugarh_live', TRUE);    
        }  else if($this->session->userdata('dist_code') == "15"){
           $this->db=$CI->load->database('jorhat_live', TRUE);    
        }  else if($this->session->userdata('dist_code') == "14"){
           $this->db=$CI->load->database('golaghat_live', TRUE);    
        }  else if($this->session->userdata('dist_code') == "07"){
              $this->db=$CI->load->database('kamrup_live', TRUE);    
        }  else if($this->session->userdata('dist_code') == "03"){
           $this->db=$CI->load->database('goalpara_live', TRUE);    
        }  else if($this->session->userdata('dist_code') == "18"){
           $this->db=$CI->load->database('tinsukia_live', TRUE);    
        }  else if($this->session->userdata('dist_code') == "12"){
           $this->db=$CI->load->database('lakhimpur_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "24"){
           $this->db=$CI->load->database('kamrupm_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "06"){
           $this->db=$CI->load->database('nalbari_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "11"){
           $this->db=$CI->load->database('sonitpur_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "12"){
           $this->db=$CI->load->database('lakhimpur_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "16"){
           $this->db=$CI->load->database('sibsagar_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "32"){
           $this->db=$CI->load->database('morigaon_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "33"){
           $this->db=$CI->load->database('nagaon_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "34"){
           $this->db=$CI->load->database('majuli_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "21"){
           $this->db=$CI->load->database('karimganj_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "08"){
           $this->db=$CI->load->database('darrang_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "35"){
           $this->db=$CI->load->database('biswanath_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "36"){
           $this->db=$CI->load->database('hojai_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "37"){
           $this->db=$CI->load->database('charaideo_live', TRUE);   
        }  else if($this->session->userdata('dist_code') == "25"){
           $this->db=$CI->load->database('dhemaji_live', TRUE);   
	} else if($this->session->userdata('dist_code') == "39"){
           $this->db=$CI->load->database('bajali_live', TRUE);
        }
 
        //return $this->db;	
    } 

    //get gurdian relations
    public function getGuardianRelations(){
        $sql = "select * from master_guard_rel";
        $query = $this->db->query($sql);        
        return $query->result();
    }

    //getting current revenue and local tax
    public function getCurrentRevenueAndLocalTaxFromDoul($land_details){
        $query = $this->db->select("*")
                            ->where('dist_code', $land_details->dist_code)
                            ->where('subdiv_code', $land_details->subdiv_code)
                            ->where('cir_code', $land_details->cir_code)
                            ->where('mouza_pargona_code', $land_details->mouza_pargona_code)
                            ->where('lot_no', $land_details->lot_no)
                            ->where('vill_townprt_code', $land_details->vill_townprt_code)
                            ->where('patta_type_code', $land_details->patta_type_code)
                            ->where('patta_no', $land_details->patta_no)
                            ->from('current_doul_demand')
                            ->get(); 
        //echo $this->db->last_query();
        if($query->num_rows() != 0){
            $row = $query->row();
            if(($row->dag_revenue=='' || $row->dag_revenue==null) || ($row->dag_local_tax=='' || $row->dag_local_tax==null)){
                return ['flag' => false, 'result' => 'Revenue Or Local Tax Not Found in Doul For The Patta : '.$land_details->patta_no. ", Please verify the patta no in current doul.!" ];
            }else{
                return ['flag' => true, 'result' => $row];
            }
            
        }else{
            return ['flag' => false, 'result' => 'Doul Entry Not Found For The Patta : '.$land_details->patta_no. ", Please verify the patta no in current doul.!" ];
        }  
    }

    //checkig whether jama wasil already updated or not 
    public function checkJamaWasilStatus($land_details){
        $query = $this->db->select('count(*)')
                          ->where('dist_code', $land_details->dist_code)
                          ->where('cir_code', $land_details->cir_code)
                          ->where('subdiv_code', $land_details->subdiv_code)
                          ->where('mouza_pargona_code', $land_details->mouza_pargona_code)
                          ->where('lot_no', $land_details->lot_no)
                          ->where('vill_townprt_code', $land_details->vill_townprt_code)
                          ->where('patta_type_code', $land_details->patta_type_code)
                          ->where('patta_no', $land_details->patta_no)
                          ->from('jama_wasil')
                          ->get();
            if($query->row()->count != 0){
                return "jamawasil_updated";
            }else{
                return "jamawasil_not_updated";
            }
    }


    public function checkArrearStatus($land_details){
        //checking whether jamawasil updated 
        $query = $this->db->select('*')
                          ->where('dist_code', $land_details->dist_code)
                          ->where('cir_code', $land_details->cir_code)
                          ->where('subdiv_code', $land_details->subdiv_code)
                          ->where('mouza_pargona_code', $land_details->mouza_pargona_code)
                          ->where('lot_no', $land_details->lot_no)
                          ->where('vill_townprt_code', $land_details->vill_townprt_code)
                          ->where('patta_type_code', $land_details->patta_type_code)
                          ->where('patta_no', $land_details->patta_no)
                          ->from('jama_wasil')
                          ->get();
        if($query->num_rows() != 0){
            $jama_wasil_details = $query->row();
            return [ "flag"=>"jamawasil_updated", "arrear_details" => $jama_wasil_details];
        }
        //checking whether mouzadar arrear updated 
        $query = $this->db->select('*')
                          ->where('dist_code', $land_details->dist_code)
                          ->where('cir_code', $land_details->cir_code)
                          ->where('subdiv_code', $land_details->subdiv_code)
                          ->where('mouza_pargona_code', $land_details->mouza_pargona_code)
                          ->where('lot_no', $land_details->lot_no)
                          ->where('vill_townprt_code', $land_details->vill_townprt_code)
                          ->where('patta_type_code', $land_details->patta_type_code)
                          ->where('patta_no', $land_details->patta_no)
                          ->from('ekhajana_mouzadar_arrear_details')
                          ->get();
        if($query->num_rows() != 0){
            $mouzadar_arrear_details = $query->row();
            return [ "flag"=>"mad_updated", "arrear_details" => $mouzadar_arrear_details];
        }else{
            return [ "flag"=>"arrear_not_updated", "arrear_details" => []];
        }
    }

    //checking whether doul exists or not 
    public function checkDoulExists($dist_code,$subdiv_code,$cir_code){
        $this->dbswitch(); 
        if (date('m') <= 6) {
            $year = date('Y');
        } else {
            $year = date('Y') + 1;
        }   

        $doul_query = $this->db->query("SELECT count(*) FROM current_doul_demand WHERE dist_code=? and subdiv_code=? and cir_code=? "
                . "and year_no=?", 
                array($dist_code,$subdiv_code,$cir_code, strval($year)));
        $doul_count = $doul_query->row()->count;

        //echo $doul_count;

        //echo $this->db->last_query();

        if($doul_count == 0){
            return false;
        }else{
            $sql = "select status from current_doul_approve where dist_code=? and subdiv_code=? and cir_code=? and yeardoul='$year'";
            $query = $this->db->query($sql,array(strval($dist_code),strval($subdiv_code),strval($cir_code)));
            if($query->num_rows() != 0){
                $row = $query->row();
                if($row->status=='A'){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }

    //checking whether doul exists or not 
    public function checkDoulApprove($dist_code,$subdiv_code,$cir_code){
        $this->dbswitch(); 
        if (date('m') <= 6) {
            $year = date('Y');
        } else {
            $year = date('Y') + 1;
        }   

        $query = $this->db->select('status')
                            ->where('dist_code', $dist_code)
                            ->where('subdiv_code', $subdiv_code)
                            ->where('cir_code', $cir_code)
                            ->where('yeardoul',(string)$year)
                            ->from('current_doul_approve')
                            ->get();
                if($query->num_rows() != 0){
                    $row = $query->row();
                    if(trim($row->status) =='A'){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
    }

    //getting pending list count for mouzadar
    public function pendingCountForMouzadar($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){    
        //curl to get the mouzadar count from basundhara 
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJNA_MOUZADAR_PENDING_COUNT_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'dist_code' => $dist_code,
                'subdiv_code' => $subdiv_code,
                'cir_code' => $cir_code,
                'mouza_pargona_code' => $mouza_pargona_code
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 200){
            $response_obj = json_decode($response);
            if($response_obj->result == "Y"){
                return ['flag'=> true, 'result'=>$response_obj->msg];
            }else{
                log_message("error", "#EKCRLMOUCOUNT0001, Curl Error(Y) In Api ".EKHAJNA_MOUZADAR_PENDING_COUNT_API);
                return ['flag'=> false, 'result'=>$response_obj->msg];
            }  
        }else{
            log_message("error", "#EKCRLMOUCOUNT0002, Curl Error(200) In Api ".EKHAJNA_MOUZADAR_PENDING_COUNT_API);
            return ['flag'=>false, 'result'=>"Internal Server Error,#EKCRLMOUCOUNT0002"];
        }        
    }

    //getting pending list for ast 
    public function pendingListForMouzadar($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){        
        //curl to get the mouzadar count from basundhara 
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJNA_MOUZADAR_PENDING_LIST_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'dist_code' => $dist_code,
                'subdiv_code' => $subdiv_code,
                'cir_code' => $cir_code,
                'mouza_pargona_code' => $mouza_pargona_code
            ),
        ));
        $response = curl_exec($curl);        
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 200){
            //return "curl successfull";
            $response_obj = json_decode($response);
            if($response_obj->result == "Y"){
                return ['flag'=>true, 'result'=>$response_obj->msg];
            }else{
                log_message("error", "#EKCRLMOULIST0001, Curl Error(Y) In Api ".EKHAJNA_MOUZADAR_PENDING_COUNT_API);
                return ['flag'=>false, 'result'=>$response_obj->msg];
            } 
            
        }else{
            log_message("error", "#EKCRLMOULISTT0002, Curl Error(200) In Api ".EKHAJNA_MOUZADAR_PENDING_COUNT_API);
            return ['flag'=>false, 'result'=>"Internal Server Error,#EKCRLMOULISTT0002"];
        }        
    }

    //getting ekhajana basic details form id 
    public function getLandDetailsFromId($ek_land_details_id){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_PENDING_CASE_DETAILS_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('ld_details_id' =>$ek_land_details_id)
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 200){
            //return "curl successfull";
            $response_obj = json_decode($response);
            return ["flag"=>true, "result"=>$response_obj];            
        }else{
            log_message("error", "#EKCRLMOUCASE0001, Curl Error(200) In Api ".EKHAJANA_PENDING_CASE_DETAILS_API);
            return ["flag"=>false, "result"=>"Some Error Occured, Error Code: #EKCRLMOUCASE0001"]; 
        }
    }

    //getting the case abbr
    function generteCaseName(){
        $dist_code=$this->session->userdata('dist_code');
        $subdiv_code=$this->session->userdata('subdiv_code');
        $cir_code=$this->session->userdata('cir_code');
        $financialyeardate = (date('m') < '07') ? date('Y', strtotime('-1 year')) . "-" . date('y') : date('Y') . "-" . date('y', strtotime('+1 year'));
        $q = "Select dist_abbr,cir_abbr from location where dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code!='00' ";
        $abbrname = $this->db->query($q)->row();
        if($abbrname)
        {
            $cir_dist_name = $abbrname->dist_abbr . "/" . $abbrname->cir_abbr;
            $case_no = $cir_dist_name . "/" . $financialyeardate . "/" ;
            return $case_no;
        }
        return false;
    }

    //getting village uuid
    function getVillageUUID($dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_no,$vill_code){    
        $this->dbswitch();        
        $sql = "select * from location where dist_code=? and subdiv_code=? and cir_code=? 
                and mouza_pargona_code=? and lot_no=? and vill_townprt_code=?";
        $query = $this->db->query($sql,array(strval($dist_code),strval($subdiv_code),strval($cir_code),strval($mouza_code),strval($lot_no),strval($vill_code)));
        $result = $query->result(); 
        if(count($result) != 0 ){
            return $result[0]->uuid;
        }else{
            return "";
        }
    }

    //getting user details from unique_user_id, i.e user_name
    function getUserDetailsByUserUniqueId($unique_user_id){
        $sql = "select du.id as depart_user_id, du.unique_user_id as unique_uid, * from depart_users du join user_dist_byforcation udb on
                du.id::int=udb.unique_user_id::int where du.unique_user_id=? and du.active_deactive=? and du.status=?";
        $res = $this->db->query($sql, array($unique_user_id, 'E', 'E'));
        if($res->num_rows() == 1){
            return ['flag'=>true, "result"=>$res->row()];
        }else{
            return ['flag'=>false, "result"=>"User Not Found"];
        }
    }

    //inserting bank details
    function insertBankDetails($bankDetails){
        $tstatus1 = $this->db->insert('user_informations', $bankDetails);
        if ($tstatus1!= 1)
        {
            log_message("error", "#EKMOUBANKINS001, Error in insert on user_informations table with data ". json_encode($bankDetails));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKMOUBANKINS001'];
        }else{
            return ['result' => 'SUCCESS', 'msg' => 'Bank Details Added Successfully!'];
        }
    }

    //checking whetehre bank details already submitted or not
    public function isBankDetailsSubmited(){
        $query = $this->db->select('count(*)')
                          ->where('user_unique_id', $this->session->userdata('unique_user_id'))
                          ->from('user_informations')
                          ->get();
        if($query->row()->count != 0){
            return true;
        }else{
            return false;
        }
    }

    //getting bank details from user unique id
    public function userBankDetails(){
        $query = $this->db->select('*')
                          ->where('user_unique_id', $this->session->userdata('unique_user_id'))
                          ->from('user_informations')
                          ->get();
        if($query->num_rows() == 1){
            return $query->row();
        }else{
            return false;
        }
    }  

    //inserting data into ekhajana basic and proceedings of the already paid patta cases
    public function insertDataintoEkhajanaBasicandProcceding($data){
        error_reporting(0);
        
        $village_uuid = $this->getVillageUUID($data['dist_code'],$data['subdiv_code'],
        $data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code']);
        $case_no_abbr = $this->generteCaseName();  
        //inserting basic details in ekhajana basic 
        $insertDataForEkhajanaBasic = [
            "application_no" => $data['application_no'],
            "ld_application_no" => $data['ld_application_no'],
            "dist_code" => $data['dist_code'],
            "subdiv_code" => $data['subdiv_code'],
            'cir_code' => $data['cir_code'],
            "mouza_pargona_code" => $data['mouza_pargona_code'],
            "lot_no" => $data['lot_no'],
            "vill_townprt_code" => $data['vill_townprt_code'],
            "village_uuid" => $village_uuid,
            "is_urban" => $data['is_urban'],
            "patta_type_code" => $data['patta_type_code'],
            "patta_type" => $data['patta_type'],
            "patta_no" => $data['patta_no'],
            "pdar_id" => $data['pdar_id'], 
            "pdar_name" => $data['pdar_name'],
            "pdar_father_name" => $data['pdar_father_name'],
            "applicant_name_eng" => $data['applicant_name_eng'],
            "applicant_name_asm" => $data['applicant_name_asm'],
            "guardian_name_eng" => $data['guardian_name_eng'],
            "guardian_name_asm" => $data['guardian_name_asm'],
            "guardian_relation" => $data['guardian_relation'],
            "gender" => $data['gender'],
            "date_of_birth" => $data['date_of_birth'],
            "address" => $data['address'],
            "mobile_no" => $data['mobile_no'],
            "pending_with_officer" => "CO",
            "mou_remark" => $data['mou_report'],
            "status" => EKHAJANA_STATUS_MOU_FORWARD,
            "created_at" => date('Y-m-d h:i:s'),
            'user_code' => $this->session->all_userdata()['user_code'],
            'case_no' => "NOT-GENERATED",
            'aadhaar_pan_ref_no' => $data['aadhaar_pan_ref_no'],
            'aadhaar_pan_type' => $data['aadhaar_pan_type']
        ];
        $this->dbswitch_live();
        $this->db->trans_begin();
        $tstatus1 = $this->db->insert('ekhajana_basic', $insertDataForEkhajanaBasic); 
        if ($tstatus1!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHIDBP01, Error in insert on ekhajana_basic table with data ". json_encode($insertDataForEkhajanaBasic));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIDBP01'];
        }
        $ekhajana_basic_inserted_id = $this->db->insert_id();
        $case_no = $case_no_abbr."EKH/".$ekhajana_basic_inserted_id;
        //updating ekhajana basic details with case no 
        $update_data = array(
            'case_no' => $case_no,
        ); 
        $this->db->where('id', $ekhajana_basic_inserted_id);
        $this->db->update('ekhajana_basic', $update_data);
        if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            log_message("error", "#EKHIDBP02, Error in update, table 'ekhajana_basic' with rtps application no ".$data['ld_application_no']);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIDBP02'];
        }
        //ekhajana basic proceeding details insert
        $proceeding_details_data = array(
            'ld_application_no' => $data['ld_application_no'],
            'application_no' => $data['application_no'],
            'remark' => $data['mou_report'],            
            'user_code' => $this->session->all_userdata()['user_code'],
            "created_at" => date('Y-m-d h:i:s'),
            "case_no" => $case_no,
            'status' => EKHAJANA_STATUS_MOU_FORWARD,
        ); 
        $tstatus2 = $this->db->insert('ekhajana_basic_proceedings', $proceeding_details_data); 
        if ($tstatus2!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHIDBP03, Error in insert on ekhajana_basic_proceedings table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIDBP03'];
        }
        //basundhara ekhajana land details update
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => EKHAJANA_LAND_DETAILS_UPDATE_API,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    "dist_code" => $data['dist_code'],
                    "subdiv_code" => $data['subdiv_code'],
                    'cir_code' => $data['cir_code'],
                    "mouza_pargona_code" => $data['mouza_pargona_code'],
                    "lot_no" => $data['lot_no'],
                    "user_code" => 'MOU',
                    "case_no" => $case_no,
                    "remark" => $data['mou_report'],
                    'ld_application_no' => $data['ld_application_no'],
                    'application_no' => $data['application_no'],
                    'status' => EKHAJANA_STATUS_MOU_FORWARD,                    
                    'date_of_action' => date("Y-m-d"), 
                    'patta_no' => $data['patta_no'],
                ),
            ));
            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if($httpcode == 200){
                //return "curl successfull";
                $response_obj = json_decode($response);
                if($response_obj->result == "Y"){
                    $this->db->trans_commit();
                    return ['result' => 'SUCCESS', 'msg' => 'Case forwarded Sucessfully..!'];                 
                }else{
                    $this->db->trans_rollback();
                    log_message("error", "#EKHIDBP04, Curl Error(Y) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_API);
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIDBP04'];
                } 
            }else{
                $this->db->trans_rollback();
                log_message("error", "#EKHIDBP05, Curl Error(200) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_API);
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIDBP05'];
            }
    }
    
    //generarting the case number and registering the case in dharitree
    public function insertBasicDetailsMouzadar($data){
        $CheckStatus = $this->CheckCaseNumber($data);
        if($CheckStatus['result'] == 'NOT-GENERATED'){
            return $this->insertMouzadarBasicDetails($data);
        }else if($CheckStatus['result'] == 'GENERATED'){
            return $this->updateMouzadarBasicDetails($data, $CheckStatus['case_no'],$CheckStatus['status']);
        }else{
            log_message("error", "#EKCOF0312, Error in update, table 'ekhajana_basic'  with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKCOF0312'];
        }
    }

    //method to insert the basic details of a fresh case registration;
    public function insertMouzadarBasicDetails($data){
        // error_reporting(0);        
        $village_uuid = $this->getVillageUUID($data['dist_code'],$data['subdiv_code'],
        $data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code']);
        $case_no_abbr = $this->generteCaseName();  
        $this->db->trans_begin();
        //inserting basic details in ekhajana basic 
        $insertDataForEkhajanaBasic = [
            "application_no" => $data['application_no'],
            "ld_application_no" => $data['ld_application_no'],
            "dist_code" => $data['dist_code'],
            "subdiv_code" => $data['subdiv_code'],
            'cir_code' => $data['cir_code'],
            "mouza_pargona_code" => $data['mouza_pargona_code'],
            "lot_no" => $data['lot_no'],
            "vill_townprt_code" => $data['vill_townprt_code'],
            "village_uuid" => $village_uuid,
            "is_urban" => $data['is_urban'],
            "patta_type_code" => $data['patta_type_code'],
            "patta_type" => $data['patta_type'],
            "patta_no" => $data['patta_no'],
            "pdar_id" => $data['pdar_id'],
            "pdar_name" => $data['pdar_name'],
            "pdar_father_name" => $data['pdar_father_name'],
            "applicant_name_eng" => $data['applicant_name_eng'],
            "applicant_name_asm" => $data['applicant_name_asm'],
            "guardian_name_eng" => $data['guardian_name_eng'],
            "guardian_name_asm" => $data['guardian_name_asm'],
            "guardian_relation" => $data['guardian_relation'],
            "gender" => $data['gender'],
            "date_of_birth" => $data['date_of_birth'],
            "address" => $data['address'],
            "mobile_no" => $data['mobile_no'],
            "pending_with_officer" => "LM",
            "mou_remark" => $data['mou_report'],
            "status" => EKHAJANA_STATUS_MOU_FORWARD,
            "created_at" => date('Y-m-d h:i:s'),
            'user_code' => $this->session->all_userdata()['user_code'],
            'case_no' => "NOT-GENERATED",
            'aadhaar_pan_ref_no' => $data['aadhaar_pan_ref_no'],
            'aadhaar_pan_type' => $data['aadhaar_pan_type'],
            'pattadar_identification_flag' => $data['pattadar_identified']
        ];
        
        $tstatus1 = $this->db->insert('ekhajana_basic', $insertDataForEkhajanaBasic);
        if ($tstatus1!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHIBDM01, Error in insert on ekhajana_basic table with data ". json_encode($insertDataForEkhajanaBasic));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIBDM01'];
        }
        $ekhajana_basic_inserted_id = $this->db->insert_id();
        $case_no = $case_no_abbr."EKH/".$ekhajana_basic_inserted_id;
        //updating ekhajana basic details with case no
        $update_data = array(
            'case_no' => $case_no,
        );
        $this->db->where('id', $ekhajana_basic_inserted_id);
        $this->db->update('ekhajana_basic', $update_data);
        if($this->db->affected_rows() != 1){
            $this->db->trans_rollback();
            log_message("error", "#EKHIMBD021, Error in update, table 'ekhajana_basic' with rtps application no ".$data['ld_application_no']);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBD021'];
        }
        //ekhajana basic proceeding details insert
        $proceeding_details_data = array(
            'ld_application_no' => $data['ld_application_no'],
            'application_no' => $data['application_no'],
            'remark' => $data['mou_report'],
            'user_code' => $this->session->all_userdata()['user_code'],
            "created_at" => date('Y-m-d h:i:s'),
            "case_no" => $case_no,
            'status' => EKHAJANA_STATUS_MOU_FORWARD,
        );
        $tstatus2 = $this->db->insert('ekhajana_basic_proceedings', $proceeding_details_data);
        if ($tstatus2!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHIMBD022, Error in insert on ekhajana_basic_proceedings table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBD022'];
        }
        //*************************************************************************/
        $jama_wasil_query = $this->db->query("select pay_status from jama_wasil where dist_code=? and 
        subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and 
        patta_type_code=? and patta_no=? and is_deleted=?", array($data['dist_code'], 
        $data['subdiv_code'],$data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code']
        ,$data['patta_type_code'],$data['patta_no'],0));
        $jama_wasil_count = $jama_wasil_query->num_rows();
        if($jama_wasil_count == 0){
            $mad_query = $this->db->query("select count(*) from ekhajana_mouzadar_arrear_details  where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?", array($data['dist_code'], 
            $data['subdiv_code'],$data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code']
            ,$data['patta_type_code'],$data['patta_no']));
            $mad_count = $mad_query->row()->count;
            if($mad_count == 0){
                $mad_action= 'insert';
            }else{
                $mad_action= 'update';
            }
        }else{
            $jama_wasil = $jama_wasil_query->row();
            if($jama_wasil->pay_status == 'UNPAID'){
                $mad_action= 'update';
            }else{
                $mad_action= 'no_action_in_mad';
            }
            
        }
        //*************************************************************************/
        if($mad_action == "insert"){
            //ekhjana_mouzadar_arrear_details table insert
            $insertArrearDetails = [
                "application_no" => $data['application_no'],
                "ld_application_no" => $data['ld_application_no'],
                "case_no" => $case_no,
                "dist_code" => $data['dist_code'],
                "subdiv_code" => $data['subdiv_code'],
                "cir_code" => $data['cir_code'],
                "mouza_pargona_code" => $data['mouza_pargona_code'],
                "lot_no" => $data['lot_no'],
                "vill_townprt_code" => $data['vill_townprt_code'],
                "village_uuid" => $village_uuid,
                "patta_type_code" => $data['patta_type_code'],
                "patta_no" => $data['patta_no'],
                "current_revenue" => $data['current_revenue'],
                "current_local_tax" => $data['current_local_tax'],
                "current_doul_year" => $data['current_doul_year'],
                "opening_balance" => $data['openinig_balance'],
                'last_pay_date' => $data['last_pay_date1'],
                "last_revenue_payment" => $data['last_revenue_payment_amount'],
                "last_local_tax_payment" => $data['last_local_tax_payment_amount'],
                //"ek_basic_id" => $data['ek_basic_id'],
                "backup_arrear_json" => json_encode($data),
                "payment_by" => $data['paymentBy'],
                "created_at" =>date('Y-m-d h:i:s')
            ];
            $tstatus3 = $this->db->insert('ekhajana_mouzadar_arrear_details', $insertArrearDetails);
            if ($tstatus3!= 1)
            {
                $this->db->trans_rollback();
                log_message("error", "#EKHIMBD023, Error in insert on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBD023'];
            }
        }else if($mad_action == "update"){
            $mad_update_data = [
                "backup_arrear_json" => json_encode($data),
                "opening_balance" => $data['openinig_balance'],
                'last_pay_date' => $data['last_pay_date1'],
                "last_revenue_payment" => $data['last_revenue_payment_amount'],
                "last_local_tax_payment" => $data['last_local_tax_payment_amount'],
                "current_revenue" => $data['current_revenue'],
                "current_local_tax" => $data['current_local_tax'],
                "modified_at" => date('Y-m-d h:i:s'),
            ];

            $this->db->where('dist_code', $data['dist_code'])
                    ->where('subdiv_code', $data['subdiv_code'])
                    ->where('cir_code', $data['cir_code'])
                    ->where('mouza_pargona_code', $data['mouza_pargona_code'])
                    ->where('lot_no', $data['lot_no'])
                    ->where('patta_type_code', $data['patta_type_code'])
                    ->where('patta_no', $data['patta_no'])
                    ->where('vill_townprt_code', $data['vill_townprt_code'])
                    //->where('village_uuid', $data['village_uuid'])
                    ->update('ekhajana_mouzadar_arrear_details', $mad_update_data);
            if($this->db->affected_rows() != 1){
                $this->db->trans_rollback();
                log_message("error", "#EKHIMBD024, Error in update on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBD024'];
            }
        }
        //updation of pre arrear 
        $updateEkPreArrData = [
            'status' => 'CP',
            "modified_at" => date('Y-m-d h:i:s'), 
        ];
        $this->db->where('dist_code', $data['dist_code'])
                ->where('subdiv_code', $data['subdiv_code'])
                ->where('cir_code', $data['cir_code'])
                ->where('mouza_pargona_code', $data['mouza_pargona_code'])
                ->where('lot_no', $data['lot_no'])
                ->where('patta_type_code', $data['patta_type_code'])
                ->where('patta_no', $data['patta_no'])
                ->where('vill_townprt_code', $data['vill_townprt_code'])
                //->where('village_uuid', $data['village_uuid'])
                ->update('ekhajana_arrear_pre_updation', $updateEkPreArrData);
        if($this->db->affected_rows() != 1){
            $this->db->trans_rollback();
            log_message("error", "#EKHUBDM0046, Error in update on ekhajana_arrear_pre_updation table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBDM0046'];
        }
        //basundhara ekhajana land details update
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_LAND_DETAILS_UPDATE_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                "dist_code" => $data['dist_code'],
                "subdiv_code" => $data['subdiv_code'],
                'cir_code' => $data['cir_code'],
                "mouza_pargona_code" => $data['mouza_pargona_code'],
                "lot_no" => $data['lot_no'],
                "user_code" => 'MOU',
                "case_no" => $case_no,
                "remark" => $data['mou_report'],
                'ld_application_no' => $data['ld_application_no'],
                'application_no' => $data['application_no'],
                'status' => EKHAJANA_STATUS_MOU_FORWARD,
                'date_of_action' => date("Y-m-d"),
                'patta_no' => $data['patta_no'],
                'pending_with_officer' => 'LM',
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 200){
            //return "curl successfull";
            $response_obj = json_decode($response);
            if($response_obj->result == "Y"){
                $this->db->trans_commit();
                return ['result' => 'SUCCESS', 'msg' => 'Case forwarded Sucessfully..!'];
            }else{
                $this->db->trans_rollback();
                log_message("error", "#EKHIMBD025, Curl Error(Y) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_API);
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBD025'];
            } 
        }else{
            $this->db->trans_rollback();
            log_message("error", "#EKHIMBD026, Curl Error(200) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_API);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBD026'];
        }
    }

    //method to update data of already registerd case by lot mondol at first
    public function updateMouzadarBasicDetails($data,$case_no,$status){
        //error_reporting(0);
        $village_uuid = $this->getVillageUUID($data['dist_code'],$data['subdiv_code'],
        $data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code']);

        if($status == EKHAJANA_STATUS_MOU_FORWARD){
            $status = EKHAJANA_STATUS_MOU_FORWARD;
        }else{
            $status = EKHAJANA_STATUS_COMBINE_FORWARD;
        }
        $this->db->trans_begin();
        //updating basic details in ekhajana basic
        $updateDataForEkhajanaBasic = [
            'pending_with_officer' => 'CO',
            'status' => $status,
            'mou_remark' => $data['mou_report'],
            'user_code' => $this->session->all_userdata()['user_code'],
            'modified_at' => date('Y-m-d h:i:s'),
            'pattadar_identification_flag' => $data['pattadar_identified']
        ];

        $this->db->where('case_no', $case_no);
        $this->db->update('ekhajana_basic', $updateDataForEkhajanaBasic);
        if($this->db->affected_rows() != 1){
            $this->db->trans_rollback();
            log_message("error", "#EKHUBDM001, Error in update, table 'ekhajana_basic' with rtps application no ".$data['ld_application_no']);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBDM001'];
        }
        //ekhajana basic proceeding details insert
        $proceeding_details_data = array(
            'ld_application_no' => $data['ld_application_no'],
            'application_no' => $data['application_no'],
            'remark' => $data['mou_report'],
            'user_code' => $this->session->all_userdata()['user_code'],
            "created_at" => date('Y-m-d h:i:s'),
            "case_no" => $case_no,
            'status' => $status,
        );
        $tstatus2 = $this->db->insert('ekhajana_basic_proceedings', $proceeding_details_data);
        if ($tstatus2!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHUBDM002, Error in insert on ekhajana_basic_proceedings table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBDM002'];
        }

        //************************************************************************************/
        $mouzadar_arrear_details = $this->db->select('*')
                    ->where('dist_code', $data['dist_code'])
                    ->where('subdiv_code', $data['subdiv_code'])
                    ->where('cir_code', $data['cir_code'])
                    ->where('mouza_pargona_code', $data['mouza_pargona_code'])
                    ->where('lot_no', $data['lot_no'])
                    ->where('patta_type_code', $data['patta_type_code'])
                    ->where('patta_no', $data['patta_no'])
                    ->where('vill_townprt_code', $data['vill_townprt_code'])
                    //->where('village_uuid', $data['village_uuid'])
                    ->from('ekhajana_mouzadar_arrear_details')
                    ->get();
        $mad_count = $mouzadar_arrear_details->num_rows();        
        if($mad_count == 0){
            //ekhjana_mouzadar_arrear_details table insert
            $insertArrearDetails = [
                "application_no" => $data['application_no'],
                "ld_application_no" => $data['ld_application_no'],
                "case_no" => $case_no,
                "dist_code" => $data['dist_code'],
                "subdiv_code" => $data['subdiv_code'],
                "cir_code" => $data['cir_code'],
                "mouza_pargona_code" => $data['mouza_pargona_code'],
                "lot_no" => $data['lot_no'],
                "vill_townprt_code" => $data['vill_townprt_code'],
                "village_uuid" => $village_uuid,
                "patta_type_code" => $data['patta_type_code'],
                "patta_no" => $data['patta_no'],
                "current_revenue" => $data['current_revenue'],
                "current_local_tax" => $data['current_local_tax'],
                "current_doul_year" => $data['current_doul_year'],
                "opening_balance" => $data['openinig_balance'],
                'last_pay_date' => $data['last_pay_date1'],
                "last_revenue_payment" => $data['last_revenue_payment_amount'],
                "last_local_tax_payment" => $data['last_local_tax_payment_amount'],
                //"ek_basic_id" => $data['ek_basic_id'],
                "backup_arrear_json" => json_encode($data),
                "payment_by" => $data['paymentBy'],
                "created_at" =>date('Y-m-d h:i:s')
            ];
            $tstatus3 = $this->db->insert('ekhajana_mouzadar_arrear_details', $insertArrearDetails);
            if ($tstatus3!= 1)
            {
                $this->db->trans_rollback();
                log_message("error", "#EKHUBDM003, Error in insert on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBDM003'];
            }
        }
        else{
            $jama_wasil_query = $this->db->query("select * from jama_wasil where dist_code=?
                and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=?
                and patta_type_code=? and patta_no=? and is_deleted=?", array($data['dist_code'],$data['subdiv_code'],$data['cir_code'],
                $data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code'],$data['patta_type_code'],
                $data['patta_no'],0));            
            $jama_wasil_count = $jama_wasil_query->num_rows();            
            if($jama_wasil_count == 0){
                $mad_action = 'update';
            }else{
                $jama_wasil = $jama_wasil_query->row();            
                if($jama_wasil->pay_status == 'UNPAID'){
                    $mad_action = 'update';
                }else{
                    $mad_action = 'no_action';
                }
            }

            if($mad_action == 'update'){
                $pre_updation_query = $this->db->query("select * from ekhajana_arrear_pre_updation where dist_code=?
                    and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=?
                    and patta_type_code=? and patta_no=?", array($data['dist_code'],$data['subdiv_code'],$data['cir_code'],
                    $data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code'],$data['patta_type_code'],
                    $data['patta_no']));
                if($pre_updation_query->num_rows() != 1){
                    $this->db->trans_rollback();
                    log_message("error", "#EKHUBDM0045, No Rows Found In Ekhajana Arrear Details for ".$data['ld_application_no']);
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBDM0045'];
                }
                $pre_updation_res = $pre_updation_query->row();
                if($pre_updation_res->arrear != $data['openinig_balance']){
                    $this->db->trans_rollback();
                    log_message("error", "#EKHUBDM00456, Opening Balance Mismatched for ".$data['ld_application_no']);
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBDM00456'];
                }
                $mad_update_data = [
                    "backup_arrear_json" => json_encode($data),
                    "opening_balance" => $data['openinig_balance'],
                    'last_pay_date' => $data['last_pay_date1'],
                    "last_revenue_payment" => $data['last_revenue_payment_amount'],
                    "last_local_tax_payment" => $data['last_local_tax_payment_amount'],
                    "current_revenue" => $data['current_revenue'],
                    "current_local_tax" => $data['current_local_tax'],
                    "modified_at" => date('Y-m-d h:i:s'),
                ];
                $this->db->where('dist_code', $data['dist_code'])
                        ->where('subdiv_code', $data['subdiv_code'])
                        ->where('cir_code', $data['cir_code'])
                        ->where('mouza_pargona_code', $data['mouza_pargona_code'])
                        ->where('lot_no', $data['lot_no'])
                        ->where('patta_type_code', $data['patta_type_code'])
                        ->where('patta_no', $data['patta_no'])
                        ->where('vill_townprt_code', $data['vill_townprt_code'])
                        //->where('village_uuid', $data['village_uuid'])
                        ->update('ekhajana_mouzadar_arrear_details', $mad_update_data);
                if($this->db->affected_rows() != 1){
                    $this->db->trans_rollback();
                    log_message("error", "#EKHUBDM004, Error in update on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBDM004'];
                }
            }
            
        }

        //updation of pre arrear 
        $updateEkPreArrData = [
            'status' => 'CP',
            "modified_at" => date('Y-m-d h:i:s'), 
        ];
        $this->db->where('dist_code', $data['dist_code'])
                ->where('subdiv_code', $data['subdiv_code'])
                ->where('cir_code', $data['cir_code'])
                ->where('mouza_pargona_code', $data['mouza_pargona_code'])
                ->where('lot_no', $data['lot_no'])
                ->where('patta_type_code', $data['patta_type_code'])
                ->where('patta_no', $data['patta_no'])
                ->where('vill_townprt_code', $data['vill_townprt_code'])
                //->where('village_uuid', $data['village_uuid'])
                ->update('ekhajana_arrear_pre_updation', $updateEkPreArrData);
        if($this->db->affected_rows() != 1){
            $this->db->trans_rollback();
            log_message("error", "#EKHUBDM0046, Error in update on ekhajana_arrear_pre_updation table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBDM0046'];
        }

        //basundhara ekhajana land details update
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_LAND_DETAILS_UPDATE_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                "dist_code" => $data['dist_code'],
                "subdiv_code" => $data['subdiv_code'],
                'cir_code' => $data['cir_code'],
                "mouza_pargona_code" => $data['mouza_pargona_code'],
                "lot_no" => $data['lot_no'],
                "user_code" => 'MOU',
                "case_no" => $case_no,
                "remark" => $data['mou_report'],
                'ld_application_no' => $data['ld_application_no'],
                'application_no' => $data['application_no'],
                'status' => $status,
                'date_of_action' => date("Y-m-d"),
                'patta_no' => $data['patta_no'],
                'pending_with_officer' => 'CO',
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 200){
            //return "curl successfull";
            $response_obj = json_decode($response);
            if($response_obj->result == "Y"){
                $this->db->trans_commit();
                return ['result' => 'SUCCESS', 'msg' => 'Case forwarded Sucessfully..!'];
            }else{
                $this->db->trans_rollback();
                log_message("error", "#EKHUBDM005, Curl Error(Y) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_API);
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBDM005'];
            } 
        }else{
            $this->db->trans_rollback();
            log_message("error", "#EKHUBDM006, Curl Error(200) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_API);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBDM006'];
        }
    }

    //getting the count for objection cases
    public function ObjectionCount($dist_code,$subdiv_code,$cir_code,$mouza_code){
        $this->dbswitch();
        $query = $this->db->select('count(*)')
                        ->where('dist_code', $dist_code)
                        ->where('subdiv_code', $subdiv_code)
                        ->where('cir_code', $cir_code)
                        ->where('mouza_pargona_code', $mouza_code)
                        ->where('status', EKHAJANA_STATUS_CO_FORWARD_MOUZADAR_OBJECTION)
                        ->from('ekhajana_basic')
                        ->get(); 
            if($query->num_rows() != 0 ){
                return $query->row()->count;
            }else{
                return 0;
            }
    }

    //getting the list for objection cases
    public function objectionList($dist_code,$subdiv_code,$cir_code,$mouza_code){
        $this->dbswitch();
        $query = $this->db->select('*')
                    ->where('dist_code', $dist_code)
                    ->where('subdiv_code', $subdiv_code)
                    ->where('cir_code', $cir_code)
                    ->where('mouza_pargona_code', $mouza_code)
                    ->where('status', EKHAJANA_STATUS_CO_FORWARD_MOUZADAR_OBJECTION)
                    ->from('ekhajana_basic')
                    ->get(); 
        //return $this->db->last_query();
        if($query->num_rows() != 0 ){
            return $query->result();
        }else{
            return [];
        }
    }

    //function to get the details of ekhajana basic prooceedings
    public function getProceedingDetails($objectionCaseLandDetails){
        $this->dbswitch();
            $query =$this->db->select('*')
                            ->where('application_no', $objectionCaseLandDetails->application_no)
                            ->where('ld_application_no', $objectionCaseLandDetails->ld_application_no)
                            ->from('ekhajana_basic_proceedings')
                            ->get(); 
            //return $this->db->last_query();
            if($query->num_rows() != 0){
                return $query->result();
            }else{
                return [];
            }
    }

    //getting ekhajana basic details form id 
    public function getEkBasicDetailsFromId($ek_basic_id){ 
        $this->dbswitch();       
        $query = $this->db->select('*')
                    ->where('id', $ek_basic_id)
                    ->from('ekhajana_basic')
                    ->get(); 
        if($query->num_rows() != 0 ){
            return $query->row();
        }else{
            return false;
        }
    }

    //function to get the arrear details inserted by mouzadar
    public function getEkhajanaArrearDetails($caseDetails){
        $query = $this->db->select('*')
                        ->where('application_no', $caseDetails->application_no)
                        ->where('ld_application_no', $caseDetails->ld_application_no)
                        ->from('ekhajana_mouzadar_arrear_details')
                        ->get(); 
        return $query->row();
    }

    //getting current revenue and local tax
    public function getCurrentRevenueAndLocalTaxFromDoul1($village_uuid,$patta_type_code,$patta_no,$dist_code){
        $this->dbswitch();     
        $query = $this->db->select("*")
                ->where('uuid', $village_uuid)
                ->where('patta_type_code', $patta_type_code)
                ->where('patta_no', $patta_no)
                ->from('current_doul_demand')
                ->get(); 
        if($query->num_rows() != 0){
            return ['flag' => true, 'result' => $query->row()];
        }else{
            return ['flag' => false, 'result' => []];
        }        
    }
 
    //function to update the basic details after co approve an objection case in mouzadr's end
    public function updateBasicDetails($posted_data,$ekbasicDetails,$arrearDetails){
        
        $this->db->trans_begin();
        //updating ekhajana basic table status
        $update_data = array(
            'pending_with_officer' => 'LM',
            'status' => EKHAJANA_STATUS_MOU_FORWARD,
            'user_code' => $this->session->all_userdata()['user_code'],
            'mou_remark' => $posted_data['mou_report'],
            'modified_at' => date('Y-m-d h:i:s'),           
        ); 
        $this->db->where('case_no', $posted_data['case_no']);
        $this->db->update('ekhajana_basic', $update_data);
        if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            log_message("error", "#EKHUBD001, Error in update, table 'ekhajana_basic'  with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBD001'];
        }
        //ekhajana basic proceeding details insert
        $proceeding_details_data = array(
            'ld_application_no' => $posted_data['ld_application_no'],
            'application_no' => $posted_data['application_no'],
            'remark' => $posted_data['mou_report'],            
            'user_code' => $this->session->all_userdata()['user_code'],
            "created_at" => date('Y-m-d h:i:s'),
            "case_no" => $posted_data['case_no'],
            'status' => EKHAJANA_STATUS_MOU_FORWARD
        ); 
        $tstatus2 = $this->db->insert('ekhajana_basic_proceedings', $proceeding_details_data); 
        //return $this->db->last_query();
        if ($tstatus2!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHUBD002, Error in insert on ekhajana_basic_proceedings table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBD002'];
        }  
        //basundhara ekhajana land details update
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_LAND_DETAILS_UPDATE_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                "dist_code" => $posted_data['dist_code'],
                "subdiv_code" => $posted_data['subdiv_code'],
                'cir_code' => $posted_data['cir_code'],
                "mouza_pargona_code" => $posted_data['mouza_pargona_code'],
                "lot_no" => $posted_data['lot_no'],
                "user_code" => 'MOU',
                "case_no" => $posted_data['case_no'],
                "remark" => $posted_data['mou_report'],
                'ld_application_no' => $posted_data['ld_application_no'],
                'application_no' => $posted_data['application_no'],
                'status' => EKHAJANA_STATUS_MOU_FORWARD,                    
                'date_of_action' => date("Y-m-d"), 
                'patta_no' => $posted_data['patta_no'],
                'pending_with_officer' => 'LM',
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 200){
            //return "curl successfull";
            $response_obj = json_decode($response);
            if($response_obj->result == "Y"){
                $this->db->trans_commit();
                return ['result' => 'SUCCESS', 'msg' => 'Case forwarded Sucessfully..!'];                 
            }else{
                $this->db->trans_rollback();
                log_message("error", "#EKHUBD003, Curl Error(Y) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_API);
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBD003'];
            } 
        }else{
            $this->db->trans_rollback();
            log_message("error", "#EKHUBD004, Curl Error(200) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_API);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBD004'];
        }
    }

    public function updateBasicDetailsObjection($data){
        error_reporting(0);
        //inserting basic details in ekhajana basic 
        $updateDataForEkhajanaBasic = [
        "pending_with_officer" => "CO",
        "mou_remark" => $data['mou_report'],
        "status" => EKHAJANA_MOUZADAR_OBJECTION,
        "objection_remark" => $data['Ek_objection_rmk'],
        'objectionflag' =>'1'
        ];
        $this->dbswitch_live();
        $this->db->trans_begin();
        $this->db->where('case_no', $data['case_no']);
        $this->db->update('ekhajana_basic', $updateDataForEkhajanaBasic);
        if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            log_message("error", "#EKHUBD01, Error in update, table 'ekhajana_basic'  with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBD01'];
        }
        
        //ekhajana basic proceeding details insert
        $proceeding_details_data = array(
        'ld_application_no' => $data['ld_application_no'],
        'application_no' => $data['application_no'],
        'remark' => $data['mou_report'],            
        'user_code' => $this->session->all_userdata()['user_code'],
        "created_at" => date('Y-m-d h:i:s'),
        "case_no" => $data['case_no'],
        'status' => EKHAJANA_MOUZADAR_OBJECTION,
        'objection_remark' => $data['Ek_objection_rmk'],
        ); 
        $tstatus2 = $this->db->insert('ekhajana_basic_proceedings', $proceeding_details_data); 
        if ($tstatus2!= 1)
        {
        $this->db->trans_rollback();
        log_message("error", "#EKHIBDO03, Error in insert on ekhajana_basic_proceedings table with query- ". json_encode($this->db->last_query()));
        return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIBDO03'];
        }
        //basundhara ekhajana land details update
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                "dist_code" => $data['dist_code'],
                "subdiv_code" => $data['subdiv_code'],
                'cir_code' => $data['cir_code'],
                "mouza_pargona_code" => $data['mouza_pargona_code'],
                "lot_no" => $data['lot_no'],
                "user_code" => 'MOU',
                "case_no" => $data['case_no'],
                "remark" => $data['mou_report'],
                'ld_application_no' => $data['ld_application_no'],
                'application_no' => $data['application_no'],
                'status' => EKHAJANA_MOUZADAR_OBJECTION,                    
                'date_of_action' => date("Y-m-d"), 
                'patta_no' => $data['patta_no'],
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        //var_dump($response);
        if($httpcode == 200){
            //return "curl successfull";
            $response_obj = json_decode($response);
            if($response_obj->result == "Y"){
                $this->db->trans_commit();
                return ['result' => 'SUCCESS', 'msg' => 'Case forwarded Sucessfully..!'];                 
            }else{
                $this->db->trans_rollback();
                log_message("error", "#EKHIBDO05, Curl Error(Y) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_API);
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIBDO05'];
            } 
        }else{
            $this->db->trans_rollback();
            log_message("error", "#EKHIBDO06, Curl Error(200) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_API);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIBDO06'];
        }
    }
    
    //checking doul approval status
    public function checkDoulApprovalStatus(){
        //return "Approved";
        $this->dbswitch();
        if (date('m') <= 6) {
            $year = date('Y');
        } else {
            $year = date('Y') + 1;
        }   
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $sql = "select status from current_doul_approve where dist_code=? and subdiv_code=? and cir_code=? and yeardoul='$year'";
        $query = $this->db->query($sql,array(strval($dist_code),strval($subdiv_code),strval($cir_code)));
        //echo $this->db->last_query();
        if($query->num_rows() != 0){
            $row = $query->row();
            if($row->status=='P'){
                return "Pending";
            }else if($row->status=='A'){
                return "Approved";
            }else if($row->status=='R'){
                return "Reverted";
            }else{
                return "Status Not Found";
            }
        }else{
            return 'Pending';
        }
    }

    //method to check the case number is generated or not
    public function CheckCaseNumber($data){
	    $this->dbswitch_live();
        $query = $this->db->select('*')
                ->where('ld_application_no', $data['ld_application_no'])
                ->where('application_no', $data['application_no'])
                ->from('ekhajana_basic')
                ->get();
            if($query->num_rows() == 0 ){
                return ['result'=>'NOT-GENERATED', 'case_no' => '', 'status' => ''];
            }else{
                $row = $query->row();
                return ['result'=>'GENERATED', 'case_no' => $row->case_no, 'status' => $row->status];
            }
    }

    //method to submit objection
    public function insertBasicDetailsObjection($data){
        $CheckStatus = $this->CheckCaseNumber($data);
        if($CheckStatus['result'] == 'NOT-GENERATED'){
            return $this->insertMouzadarObjectionBasicDetails($data);
        }else if($CheckStatus['result'] == 'GENERATED'){
            return $this->updateMouzadarObjectionBasicDetails($data, $CheckStatus['case_no']);
        }else{
            log_message("error", "#EKHIBDO001, Error in update, table 'ekhajana_basic'  with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIBDO001'];
        }

    }

    //fresh objection case registration by mouzadar
    public function insertMouzadarObjectionBasicDetails_old21112024($data){
        // error_reporting(0);
        $village_uuid = $this->getVillageUUID($data['dist_code'],$data['subdiv_code'],
        $data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code']);
        $case_no_abbr = $this->generteCaseName();  
    
        //inserting basic details in ekhajana basic 
        $insertDataForEkhajanaBasic = [
            "application_no" => $data['application_no'],
            "ld_application_no" => $data['ld_application_no'],
            "dist_code" => $data['dist_code'],
            "subdiv_code" => $data['subdiv_code'],
            'cir_code' => $data['cir_code'],
            "mouza_pargona_code" => $data['mouza_pargona_code'],
            "lot_no" => $data['lot_no'],
            "vill_townprt_code" => $data['vill_townprt_code'],
            "village_uuid" => $village_uuid,
            "is_urban" => $data['is_urban'],
            "patta_type_code" => $data['patta_type_code'],
            "patta_type" => $data['patta_type'],
            "patta_no" => $data['patta_no'],
            "pdar_id" => $data['pdar_id'], 
            "pdar_name" => $data['pdar_name'],
            "pdar_father_name" => $data['pdar_father_name'],
            "applicant_name_eng" => $data['applicant_name_eng'],
            "applicant_name_asm" => $data['applicant_name_asm'],
            "guardian_name_eng" => $data['guardian_name_eng'],
            "guardian_name_asm" => $data['guardian_name_asm'],
            "guardian_relation" => $data['guardian_relation'],
            "gender" => $data['gender'],
            "date_of_birth" => $data['date_of_birth'],
            "address" => $data['address'],
            "mobile_no" => $data['mobile_no'],
            "pending_with_officer" => "CO",
            "mou_remark" => $data['mou_report'],
            "status" => EKHAJANA_MOUZADAR_OBJECTION,
            "created_at" => date('Y-m-d h:i:s'),
            'user_code' => $this->session->all_userdata()['user_code'],
            'case_no' => "NOT-GENERATED",
            'aadhaar_pan_ref_no' => $data['aadhaar_pan_ref_no'],
            'aadhaar_pan_type' => $data['aadhaar_pan_type'],
            'objection_remark' => $data['Ek_objection_rmk'],
            'objectionflag' =>'1',
            'pattadar_identification_flag' => $data['pattadar_identified']
        ];
        $this->dbswitch_live();
        $this->db->trans_begin();
        $tstatus1 = $this->db->insert('ekhajana_basic', $insertDataForEkhajanaBasic);
        if ($tstatus1!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHIMBDO001, Error in insert on ekhajana_basic table with data ". json_encode($insertDataForEkhajanaBasic));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO001'];
        }
        $ekhajana_basic_inserted_id = $this->db->insert_id();
        $case_no = $case_no_abbr."EKH/".$ekhajana_basic_inserted_id;
        //updating ekhajana basic details with case no 
        $update_data = array(
            'case_no' => $case_no,
        ); 
        $this->db->where('id', $ekhajana_basic_inserted_id);
        $this->db->update('ekhajana_basic', $update_data);
        if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            log_message("error", "#EKHIMBDO002, Error in update, table 'ekhajana_basic' with rtps application no ".$data['ld_application_no']);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO002'];
        }
        
        //ekhajana basic proceeding details insert
        $proceeding_details_data = array(
            'ld_application_no' => $data['ld_application_no'],
            'application_no' => $data['application_no'],
            'remark' => $data['mou_report'],            
            'user_code' => $this->session->all_userdata()['user_code'],
            "created_at" => date('Y-m-d h:i:s'),
            "case_no" => $case_no,
            'status' => EKHAJANA_MOUZADAR_OBJECTION,
            'objection_remark' => $data['Ek_objection_rmk'],
        ); 
        $tstatus2 = $this->db->insert('ekhajana_basic_proceedings', $proceeding_details_data); 
        if ($tstatus2!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHIMBDO003, Error in insert on ekhajana_basic_proceedings table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO003'];
        }
        
        if($_POST['arrear_status'] != "jamawasil_updated"){
            //ekhjana_mouzadar_arrear_details table insert
            $insertArrearDetails = [
                "application_no" => $data['application_no'],
                "ld_application_no" => $data['ld_application_no'],
                "case_no" => $case_no,
                "dist_code" => $data['dist_code'],
                "subdiv_code" => $data['subdiv_code'],
                "cir_code" => $data['cir_code'],
                "mouza_pargona_code" => $data['mouza_pargona_code'],
                "lot_no" => $data['lot_no'],
                "vill_townprt_code" => $data['vill_townprt_code'],
                "village_uuid" => $village_uuid,
                "patta_type_code" => $data['patta_type_code'],
                "patta_no" => $data['patta_no'],
                "current_revenue" => $data['current_revenue'],
                "current_local_tax" => $data['current_local_tax'],
                "current_doul_year" => $data['current_doul_year'],
                "opening_balance" => $data['openinig_balance'],
                'last_pay_date' => $data['last_pay_date1'],
                "last_revenue_payment" => $data['last_revenue_payment_amount'],
                "last_local_tax_payment" => $data['last_local_tax_payment_amount'],
                //"ek_basic_id" => $data['ek_basic_id'],
                "backup_arrear_json" => json_encode($data),
                "payment_by" => $data['paymentBy'],
                "created_at" =>date('Y-m-d h:i:s')
            ];
            $tstatus3 = $this->db->insert('ekhajana_mouzadar_arrear_details', $insertArrearDetails); 
            if ($tstatus3!= 1)
            {
                $this->db->trans_rollback();
                log_message("error", "#EKHIMBDO0031, Error in insert on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO0031'];
            }
            
        }else if($_POST['arrear_status'] == "mad_updated"){
            $mad_update_data = [
                "backup_arrear_json" => json_encode($data),
                "opening_balance" => $data['openinig_balance'],
                'last_pay_date' => $data['last_pay_date1'],
                "last_revenue_payment" => $data['last_revenue_payment_amount'],
                "last_local_tax_payment" => $data['last_local_tax_payment_amount'],
                "current_revenue" => $data['current_revenue'],
                "current_local_tax" => $data['current_local_tax'],
                "modified_at" => date('Y-m-d h:i:s'),
            ];

            $this->db->where('dist_code', $data['dist_code'])
                      ->where('subdiv_code', $data['subdiv_code'])
                      ->where('cir_code', $data['cir_code'])
                      ->where('mouza_pargona_code', $data['mouza_pargona_code'])
                      ->where('lot_no', $data['lot_no'])
                      ->where('patta_type_code', $data['patta_type_code'])
                      ->where('patta_no', $data['patta_no'])
                      ->where('vill_townprt_code', $data['vill_townprt_code'])
                      ->where('village_uuid', $data['village_uuid'])
                     ->update('ekhajana_mouzadar_arrear_details', $mad_update_data);
            if($this->db->affected_rows() != 1){ 
                $this->db->trans_rollback();
                log_message("error", "#EKHIMBDO005, Error in update on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO005'];
            }
        }
       
        //basundhara ekhajana land details update
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                "dist_code" => $data['dist_code'],
                "subdiv_code" => $data['subdiv_code'],
                'cir_code' => $data['cir_code'],
                "mouza_pargona_code" => $data['mouza_pargona_code'],
                "lot_no" => $data['lot_no'],
                "user_code" => 'MOU',
                "case_no" => $case_no,
                "remark" => $data['mou_report'],
                'ld_application_no' => $data['ld_application_no'],
                'application_no' => $data['application_no'],
                'status' => EKHAJANA_MOUZADAR_OBJECTION,                    
                'date_of_action' => date("Y-m-d"), 
                'patta_no' => $data['patta_no'],
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        //return $response;
        if($httpcode == 200){
            //return "curl successfull";
            $response_obj = json_decode($response);
            if($response_obj->result == "Y"){
                $this->db->trans_commit();
                return ['result' => 'SUCCESS', 'msg' => 'Case forwarded Sucessfully..!'];                 
            }else{
                $this->db->trans_rollback();
                log_message("error", "#EKHIMBDO006, Curl Error(Y) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API);
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO006'];
            } 
        }else{
            $this->db->trans_rollback();
            log_message("error", "#EKHIMBDO007, Curl Error(200) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO007'];
        }
    }

    //method for a already registerd case submit as objection by mouzadar
    public function updateMouzadarObjectionBasicDetails_old21112024($data, $case_no){
        error_reporting(0); 
        $village_uuid = $this->getVillageUUID($data['dist_code'],$data['subdiv_code'],
        $data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code']);         
        //updating basic details in ekhajana basic 
        $updateDataForEkhajanaBasic = [
            'pending_with_officer' => 'CO',
            'status' => EKHAJANA_MOUZADAR_OBJECTION,
            'mou_remark' => $data['mou_report'],
            'modified_at' => date('Y-m-d h:i:s'),
            'objection_remark' => $data['Ek_objection_rmk'],
            'objectionflag' =>'1',
            'pattadar_identification_flag' => $data['pattadar_identified']
        ];
        $this->dbswitch_live();
        $this->db->trans_begin();
        $this->db->where('case_no', $case_no);
        $this->db->update('ekhajana_basic', $updateDataForEkhajanaBasic);
        if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            log_message("error", "#EKHUMOBD001, Error in update, table 'ekhajana_basic' with rtps application no ".$data['ld_application_no']);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUMOBD001'];
        }
        //ekhajana basic proceeding details insert
        $proceeding_details_data = array(
            'ld_application_no' => $data['ld_application_no'],
            'application_no' => $data['application_no'],
            'remark' => $data['mou_report'],            
            'user_code' => $this->session->all_userdata()['user_code'],
            "created_at" => date('Y-m-d h:i:s'),
            "case_no" => $case_no,
            'status' => EKHAJANA_MOUZADAR_OBJECTION,
        ); 
        $tstatus2 = $this->db->insert('ekhajana_basic_proceedings', $proceeding_details_data); 
        if ($tstatus2!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHUMOBD002, Error in insert on ekhajana_basic_proceedings table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUMOBD002'];
        }
        if($_POST['arrear_status'] != "jamawasil_updated"){
            //ekhjana_mouzadar_arrear_details table insert
            $insertArrearDetails = [
                "application_no" => $data['application_no'],
                "ld_application_no" => $data['ld_application_no'],
                "case_no" => $case_no,
                "dist_code" => $data['dist_code'],
                "subdiv_code" => $data['subdiv_code'],
                "cir_code" => $data['cir_code'],
                "mouza_pargona_code" => $data['mouza_pargona_code'],
                "lot_no" => $data['lot_no'],
                "vill_townprt_code" => $data['vill_townprt_code'],
                "village_uuid" => $village_uuid,
                "patta_type_code" => $data['patta_type_code'],
                "patta_no" => $data['patta_no'],
                "current_revenue" => $data['current_revenue'],
                "current_local_tax" => $data['current_local_tax'],
                "current_doul_year" => $data['current_doul_year'],
                "opening_balance" => $data['openinig_balance'],
                'last_pay_date' => $data['last_pay_date1'],
                "last_revenue_payment" => $data['last_revenue_payment_amount'],
                "last_local_tax_payment" => $data['last_local_tax_payment_amount'],
                //"ek_basic_id" => $data['ek_basic_id'],
                "backup_arrear_json" => json_encode($data),
                "payment_by" => $data['paymentBy'],
                "created_at" =>date('Y-m-d h:i:s')
            ];
            $tstatus3 = $this->db->insert('ekhajana_mouzadar_arrear_details', $insertArrearDetails); 
            if ($tstatus3!= 1)
            {
                $this->db->trans_rollback();
                log_message("error", "#EKHUMOBD003, Error in insert on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUMOBD003'];
            }
        }else if($_POST['arrear_status'] == "mad_updated"){
            $mad_update_data = [
                "backup_arrear_json" => json_encode($data),
                "opening_balance" => $data['openinig_balance'],
                'last_pay_date' => $data['last_pay_date1'],
                "last_revenue_payment" => $data['last_revenue_payment_amount'],
                "last_local_tax_payment" => $data['last_local_tax_payment_amount'],
                "current_revenue" => $data['current_revenue'],
                "current_local_tax" => $data['current_local_tax'],
                "modified_at" => date('Y-m-d h:i:s'),
            ];

            $this->db->where('dist_code', $data['dist_code'])
                    ->where('subdiv_code', $data['subdiv_code'])
                    ->where('cir_code', $data['cir_code'])
                    ->where('mouza_pargona_code', $data['mouza_pargona_code'])
                    ->where('lot_no', $data['lot_no'])
                    ->where('patta_type_code', $data['patta_type_code'])
                    ->where('patta_no', $data['patta_no'])
                    ->where('vill_townprt_code', $data['vill_townprt_code'])
                    ->where('village_uuid', $data['village_uuid'])
                    ->update('ekhajana_mouzadar_arrear_details', $mad_update_data);
            if($this->db->affected_rows() != 1){ 
                $this->db->trans_rollback();
                log_message("error", "#EKHUMOBD004, Error in update on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUMOBD004'];
            }
        }
        //basundhara ekhajana land details update
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                "dist_code" => $data['dist_code'],
                "subdiv_code" => $data['subdiv_code'],
                'cir_code' => $data['cir_code'],
                "mouza_pargona_code" => $data['mouza_pargona_code'],
                "lot_no" => $data['lot_no'],
                "user_code" => 'MOU',
                "case_no" => $case_no,
                "remark" => $data['mou_report'],
                'ld_application_no' => $data['ld_application_no'],
                'application_no' => $data['application_no'],
                'status' => EKHAJANA_MOUZADAR_OBJECTION,                    
                'date_of_action' => date("Y-m-d"), 
                'patta_no' => $data['patta_no'],
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 200){
            //return "curl successfull";
            $response_obj = json_decode($response);
            if($response_obj->result == "Y"){
                $this->db->trans_commit();
                return ['result' => 'SUCCESS', 'msg' => 'Case forwarded Sucessfully..!'];                 
            }else{
                $this->db->trans_rollback();
                log_message("error", "#EKHUMOBD005, Curl Error(Y) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API);
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUMOBD005'];
            } 
        }else{
            $this->db->trans_rollback();
            log_message("error", "#EKHUMOBD006, Curl Error(200) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUMOBD006'];
        }
    }

    public function getArrearUpdateFlag($ekLandDetails){
        //return $ekLandDetails;
        $arrear_update_count = $this->db->query('select count(*) as c from ekhajana_arrear_pre_updation where 
                                        dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?
                                        and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?',
                                        array($ekLandDetails->dist_code, $ekLandDetails->subdiv_code, $ekLandDetails->cir_code,
                                        $ekLandDetails->mouza_pargona_code,$ekLandDetails->lot_no,$ekLandDetails->vill_townprt_code,
                                        $ekLandDetails->patta_type_code,$ekLandDetails->patta_no))->row()->c;

        //return $this->db->last_query();
        //return $arrear_update_count;
        if($arrear_update_count == 0){
            return false;
        }else{
            return true;
        }
    }

    public function getTotalArrear($ekLandDetails){
        $arrear_update_query = $this->db->query('select arrear from ekhajana_arrear_pre_updation where 
                                        dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?
                                        and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?',
                                        array($ekLandDetails->dist_code, $ekLandDetails->subdiv_code, $ekLandDetails->cir_code,
                                        $ekLandDetails->mouza_pargona_code,$ekLandDetails->lot_no,$ekLandDetails->vill_townprt_code,
                                        $ekLandDetails->patta_type_code,$ekLandDetails->patta_no));
        $arrear_update_count = $arrear_update_query->num_rows();
        if($arrear_update_count != 1){
            return "not_updated";
        }else{
            return $arrear_update_query->row()->arrear;
        }
    }

    public function reUpdationCount($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
        $this->dbswitch();
        // $query = $this->db->query("select count(*) from (select case_no,dist_code,subdiv_code,cir_code,
        //                            mouza_pargona_code  from ekhajana_basic where dist_code=? and 
        //                            subdiv_code=? and cir_code=? and mouza_pargona_code=?) t1 where 
        //                            (t1.dist_code,t1.subdiv_code,t1.cir_code,t1.mouza_pargona_code) not in  
        //                             (
        //                                 select dist_code,subdiv_code,cir_code,mouza_pargona_code from 
        //                                 ekhajana_arrear_pre_updation 
        //                             )",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        // return $query->row()->count; 
        $ekhajana_basic_cases = $this->db->query("select ld_application_no,application_no,dist_code,subdiv_code,cir_code,
                                   mouza_pargona_code,lot_no,vill_townprt_code,patta_type_code,patta_no,pdar_name from ekhajana_basic 
                                   where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?",
                                   array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code))->result();
        $ekhajana_reupdation_cases_arr = array();
        foreach($ekhajana_basic_cases as $ekhajana_basic_case){
            $ekhajana_pre_arrear_updation_count = $this->db->query("select * from ekhajana_arrear_pre_updation 
            where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and 
            vill_townprt_code=? and patta_type_code=? and patta_no=? and status=?", array($dist_code,$subdiv_code,$cir_code,
            $mouza_pargona_code, $ekhajana_basic_case->lot_no, $ekhajana_basic_case->vill_townprt_code, 
            $ekhajana_basic_case->patta_type_code,$ekhajana_basic_case->patta_no,'CP'))->num_rows();
            if($ekhajana_pre_arrear_updation_count == 0){
                array_push($ekhajana_reupdation_cases_arr, $ekhajana_basic_case);
            }
        }
        return count($ekhajana_reupdation_cases_arr);
    }

    public function getReUpdationList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
        $this->dbswitch();
        // $query = $this->db->query("select * from 
        //                            (select ld_application_no,application_no,dist_code,subdiv_code,cir_code,
        //                            mouza_pargona_code,lot_no,vill_townprt_code,patta_type_code,patta_no,
        //                            pdar_name from ekhajana_basic 
        //                            where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?) 
        //                            t1 where (t1.dist_code,t1.subdiv_code,t1.cir_code,t1.mouza_pargona_code,
        //                            t.lot_no,t.vill_townprt_code,t.patta_type_code,t.patta_no) not in  
        //                             (
        //                                 select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
        //                                 vill_townprt_code,patta_type_code, 
        //                                 patta_no from ekhajana_arrear_pre_updation 
        //                             )",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        // $result = $query->result();
        // return $result; 

        $ekhajana_basic_cases = $this->db->query("select ld_application_no,application_no,dist_code,subdiv_code,cir_code,
                                   mouza_pargona_code,lot_no,vill_townprt_code,patta_type_code,patta_no,pdar_name from ekhajana_basic 
                                   where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and 
                                   status not in ('M_OBJ','R')",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code))->result();
        $ekhajana_reupdation_cases_arr = array();
        foreach($ekhajana_basic_cases as $ekhajana_basic_case){
            $ekhajana_pre_arrear_updation_count = $this->db->query("select * from ekhajana_arrear_pre_updation 
            where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and 
            vill_townprt_code=? and patta_type_code=? and patta_no=? and status=?", array($dist_code,$subdiv_code,$cir_code,
            $mouza_pargona_code, $ekhajana_basic_case->lot_no, $ekhajana_basic_case->vill_townprt_code, 
            $ekhajana_basic_case->patta_type_code,$ekhajana_basic_case->patta_no,'CP'))->num_rows();
            if($ekhajana_pre_arrear_updation_count == 0){
                array_push($ekhajana_reupdation_cases_arr, $ekhajana_basic_case);
            }
        }
        return $ekhajana_reupdation_cases_arr;
    }



    public function getPendingDays($app_created_at){
        $current_date = date('m/d/Y h:i:s a', time());
        //return $app_created_at;
        $earlier = new DateTime($app_created_at);
        $later = new DateTime($current_date);
        $abs_diff = $later->diff($earlier)->format("%a");
        return $abs_diff;
    }


    public function pendingCountForMouzadarForwarded($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
        $query = $this->db->query("Select count(*) as count from ekhajana_basic where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status in('MOU_F','COM_F')",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        if($query->num_rows() == 0){
            return ['flag' => false, 'result'=> 0];
        }else{
            return ['flag' => true, 'result'=> $query->row()->count];
        }
    }

    public function MouzadarForwardedCase($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)
    {
        $this->dbswitch_live();
	$query = $this->db->query("Select * from ekhajana_basic where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status in('MOU_F','COM_F')",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));

        if($query->num_rows() == 0){
            return "NO-DATA-FOUND";
        }else{
            return $query->result();
        }
    }

    public function viewAllForwardedDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ekbasic_id)
    {
        $this->dbswitch_live();
        $sql = $this->db->query("select * from ekhajana_basic where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and id=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ekbasic_id));
        if($sql->num_rows() == 0){
            return ['flag' => false, 'result' => "#ERR22072025001 no data found"];
            log_message("error","#ERR22072025001 no data found in ekhajana basic with id".$ekbasic_id);
        }
        $ek_basic_row = $sql->row();
        $lot_no = $ek_basic_row->lot_no;
        $vill_townprt_code = $ek_basic_row->vill_townprt_code;
        $patta_type_code = $ek_basic_row->patta_type_code;
        $patta_no  = $ek_basic_row->patta_no;
	$sql123 = $this->db->query("select * from ekhajana_arrear_pre_updation where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no));

        if($sql123->num_rows() == 0){
            return ['flag' => false, 'result' => "#ERR22072025002 no data found"];
            log_message("error","#ERR22072025002 no data found in ekhajana_arrear_pre_updation with ekhajana basic id".$ekbasic_id);
        }
        $arrear_row = $sql123->row();
        $arrear = $arrear_row->arrear;
        $current_doul_demand = $this->db->query("select * from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no));
        if($current_doul_demand->num_rows() == 0){
            return ['flag' => false, 'result' => "#ERR22072025003 no data found"];
            log_message("error","#ERR22072025003 no data found in current_doul_demand ");
        }
        $current_doul_demand_row = $current_doul_demand->row();
        return ['flag' =>true ,
                'result' => array(
                    'arrear'            => $arrear,
                    'revenue'           => $current_doul_demand_row->dag_revenue,
                    'local_tax'         => $current_doul_demand_row->dag_local_tax,
                    'ek_basic_row'      => $ek_basic_row,
                )
                ];
    }



    public function getCitizenPendingCount($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $query = $this->db->query("select count(*) from ekhajana_land_details where status='F' and application_under='MOUZADAR' and dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and
        (ROW(dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,patta_type_code,patta_no)
        not in (select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,patta_type_code,patta_no from
        ekhajana_commission_details where status='F' and dist_code=? and subdiv_code=? and cir_code=? and
        mouza_pargona_code=?))
        or (ROW(dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,patta_type_code,patta_no)
        in (select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,patta_type_code,patta_no from
        ekhajana_commission_details where status='P' and dist_code=? and subdiv_code=? and cir_code=? and
        mouza_pargona_code=?))
        ",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        if($query->num_rows() == 0){
            return ['flag' => false, 'result'=> 0];
        }else{
            return ['flag' => true, 'result'=> $query->row()->count];
        }
    }

    public function getCitizenPendingList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $query = $this->db->query("select * from ekhajana_land_details where status='F' and application_under='MOUZADAR' and dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and
        (ROW(dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,patta_type_code,patta_no)
        not in (select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,patta_type_code,patta_no from
        ekhajana_commission_details where status='F' and dist_code=? and subdiv_code=? and cir_code=? and
        mouza_pargona_code=?))
        or (ROW(dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,patta_type_code,patta_no)
        in (select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,patta_type_code,patta_no from
        ekhajana_commission_details where status='P' and dist_code=? and subdiv_code=? and cir_code=? and
        mouza_pargona_code=?))
        ",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        return $query->result();
    }


    public function getRejectedCount($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
        $this->dbswitch_live();
        $query = $this->db->query("Select count(*) as count from ekhajana_basic where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status ='R'",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        if($query->num_rows() == 0){
            return ['flag' => false, 'result'=> 0];
        }else{
            return ['flag' => true, 'result'=> $query->row()->count];
        }
    }
    public function getRejectedList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)
    {
        $this->dbswitch_live();
        $query = $this->db->query("Select * from ekhajana_basic where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status ='R'",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        if($query->num_rows() == 0){
            return ['flag' => false, 'result'=> []];
        }else{
            return ['flag' => true, 'result'=> $query->result()];
        }
    }
    public function viewAllRejectedDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ekbasic_id)
    {
        $this->dbswitch_live();
        $sql = $this->db->query("select * from ekhajana_basic where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and id=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ekbasic_id));
        if($sql->num_rows() == 0){
            return ['flag' => false, 'result' => "#ERR22072025854 no data found"];
            log_message("error","#ERR22072025854 no data found in ekhajana basic with id".$ekbasic_id);
        }
        $ek_basic_row = $sql->row();
        $lot_no = $ek_basic_row->lot_no;
        $vill_townprt_code = $ek_basic_row->vill_townprt_code;
        $patta_type_code = $ek_basic_row->patta_type_code;
        $patta_no  = $ek_basic_row->patta_no;
        $sql123 = $this->db->query("select * from ekhajana_arrear_pre_updation where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no));
        if($sql123->num_rows() == 0){
            return ['flag' => false, 'result' => "#ERR22072025858 no data found"];
            log_message("error","#ERR22072025858 no data found in ekhajana_arrear_pre_updation with ekhajana basic id".$ekbasic_id);
        }
        $arrear_row = $sql123->row();
        $arrear = $arrear_row->arrear;
        $current_doul_demand = $this->db->query("select * from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no));
        if($current_doul_demand->num_rows() == 0){
            return ['flag' => false, 'result' => "#ERR22072025003 no data found"];
            log_message("error","#ERR22072025003 no data found in current_doul_demand ");
        }
        $current_doul_demand_row = $current_doul_demand->row();
        return ['flag' =>true ,
                'result' => array(
                    'arrear'            => $arrear,
                    'revenue'           => $current_doul_demand_row->dag_revenue,
                    'local_tax'         => $current_doul_demand_row->dag_local_tax,
                    'ek_basic_row'      => $ek_basic_row,
                )
                ]; 
    }

    //method to search additional documnt against the applicatin no
    public function searchAdditionalDocument($application_no, $ld_application_no)
    {
        $this->dbswitch_live();
        $query = $this->db->select('*')
                        ->where('application_no', $application_no)
                        ->where('ld_application_no', $ld_application_no)
                        ->from('ekhajana_additional_document')
                        ->get(); 
        if($query->num_rows() != 0 ){
            return $query->row();
        }else{
            return "NOT-FOUND";
        }
    }



    public function getObjectionCount($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
        $this->dbswitch_live();
        $query = $this->db->query("Select count(*) as count from ekhajana_basic where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status ='M_OBJ'",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        if($query->num_rows() == 0){
            return ['flag' => false, 'result'=> 0];
        }else{
            return ['flag' => true, 'result'=> $query->row()->count];
        }
    }
    public function getObjectionList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)
    {
        $this->dbswitch_live();
        $query = $this->db->query("Select * from ekhajana_basic where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status ='M_OBJ'",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        if($query->num_rows() == 0){
            return ['flag' => false, 'result'=> []];
        }else{
            return ['flag' => true, 'result'=> $query->result()];
        }
    }
    public function viewAllObjectionDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ekbasic_id)
    {
        $this->dbswitch_live();
        $sql = $this->db->query("select * from ekhajana_basic where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and id=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ekbasic_id));
        if($sql->num_rows() == 0){
            return ['flag' => false, 'result' => "#ERR2207208745 no data found"];
            log_message("error","#ERR2207208745 no data found in ekhajana basic with id".$ekbasic_id);
        }
        $ek_basic_row = $sql->row();
        $lot_no = $ek_basic_row->lot_no;
        $vill_townprt_code = $ek_basic_row->vill_townprt_code;
        $patta_type_code = $ek_basic_row->patta_type_code;
        $patta_no  = $ek_basic_row->patta_no;
        $sql123 = $this->db->query("select * from ekhajana_arrear_pre_updation where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no));
        if($sql123->num_rows() == 0){
            return ['flag' => false, 'result' => "#ERR2207208746 no data found"];
            log_message("error","#ERR2207208746 no data found in ekhajana_arrear_pre_updation with ekhajana basic id".$ekbasic_id);
        }
        $arrear_row = $sql123->row();
        $arrear = $arrear_row->arrear;
        $current_doul_demand = $this->db->query("select * from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no));
        if($current_doul_demand->num_rows() == 0){
            return ['flag' => false, 'result' => "#ERR2207208747 no data found"];
            log_message("error","#ERR2207208747 no data found in current_doul_demand ");
        }
        $current_doul_demand_row = $current_doul_demand->row();
        return ['flag' =>true ,
                'result' => array(
                    'arrear'            => $arrear,
                    'revenue'           => $current_doul_demand_row->dag_revenue,
                    'local_tax'         => $current_doul_demand_row->dag_local_tax,
                    'ek_basic_row'      => $ek_basic_row,
                )
        ];
    }


    public function getRevertedByCoCount($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)
    {
        $this->dbswitch_live();
        $query = $this->db->query("Select count(*) as count from ekhajana_basic where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status ='L_MOU'",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        if($query->num_rows() == 0){
            return ['flag' => false, 'result'=> 0];
        }else{
            return ['flag' => true, 'result'=> $query->row()->count];
        }
    }
    public function getCoRevertedToMouzadarList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)
    {
        $this->dbswitch_live();
        $query = $this->db->query("Select * from ekhajana_basic where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status ='L_MOU'",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        if($query->num_rows() == 0){
            return ['flag' => false, 'result'=> []];
        }else{
            return ['flag' => true, 'result'=> $query->result()];
        }
    }
    public function viewAllRevertedDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ek_basic_id)
    {
        $this->dbswitch_live();
        $query = $this->db->query("Select * from ekhajana_basic where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and id =?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ek_basic_id));
        if($query->num_rows() == 0){
            return ['flag' => false, 'result'=> []];
        }else{
            return ['flag' => true, 'result'=> $query->row()];
        }
    }
    public function updateAfterMouzadarForwardRevertCase($posted_details)
    {
        error_reporting(0);
        //updating basic details in ekhajana basic
        $updateDataForEkhajanaBasic = [
            'pending_with_officer'  => 'CO',
            'status'                => 'COM_F',
            'user_code'             => $this->session->all_userdata()['user_code'],
            'mou_remark'            => $posted_details['mou_report'],
            'modified_at'           => date('Y-m-d h:i:s'),
        ];
        $this->dbswitch_live();
        $this->db->trans_begin();
        $this->db->where('ld_application_no', $posted_details['ld_application_no']);
        $this->db->update('ekhajana_basic', $updateDataForEkhajanaBasic);
        if($this->db->affected_rows() != 1){
            $this->db->trans_rollback();
            log_message("error", "#EKHUFMFRC001, Error in update, table 'ekhajana_basic' with rtps application no ".$posted_details['ld_application_no']);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUFMFRC001'];
        }
        //ekhajana basic proceeding details insert
        $proceeding_details_data = array(
            'ld_application_no' => $posted_details['ld_application_no'],
            'application_no'    => $posted_details['application_no'],
            'remark'            => $posted_details['mou_report'],
            'user_code'         => $this->session->all_userdata()['user_code'],
            "created_at"        => date('Y-m-d h:i:s'),
            "case_no"           => $posted_details['case_no'],
            'status'            => 'COM_F',
        );
        $tstatus2 = $this->db->insert('ekhajana_basic_proceedings', $proceeding_details_data);
        if($tstatus2!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHUFMFRC002, Error in insert on ekhajana_basic_proceedings table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUFMFRC002'];
        }
        //basundhara ekhajana land details update
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_UPDATE_DETAILS_AFTER_MOUZADAR_FORWARD_REVERTED_CASE_TO_CO,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                "user_code"          =>  $this->session->all_userdata()['user_code'],
                "case_no"            =>  $posted_details['case_no'],
                "remark"             =>  $posted_details['mou_report'],
                'ld_application_no'  =>  $posted_details['ld_application_no'],
                'application_no'     =>  $posted_details['application_no'],
                'status'             =>  'COM_F',
                'date_of_action'     =>  date("Y-m-d"),
                'patta_no'           =>  $posted_details['patta_no'],
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 200){
            $response_obj = json_decode($response);
            if($response_obj->result == "Y"){
                $this->db->trans_commit();
                return ['result' => 'SUCCESS', 'msg' => 'Case forwarded Sucessfully..!'];
            }else{
                $this->db->trans_rollback();
                log_message("error", "#EKHUFMFRC003, Curl Error(Y) In Api ".EKHAJANA_UPDATE_DETAILS_AFTER_MOUZADAR_FORWARD_REVERTED_CASE_TO_CO);
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUFMFRC003'];
            }
        }else{
            $this->db->trans_rollback();
            log_message("error", "#EKHUFMFRC004, Curl Error(200) In Api ".EKHAJANA_UPDATE_DETAILS_AFTER_MOUZADAR_FORWARD_REVERTED_CASE_TO_CO);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUFMFRC005'];
        }
    }




    //fresh objection case registration by mouzadar
    public function insertMouzadarObjectionBasicDetails($data){
        // error_reporting(0);
        $pdar_father_name = null;
        if($data['pdar_father_name'] ==null || $data['pdar_father_name'] ==''){
            $pdar_father_name ='NA';
        }else{
            $pdar_father_name = $data['pdar_father_name'];
        }
        $village_uuid = $this->getVillageUUID($data['dist_code'],$data['subdiv_code'],
        $data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code']);
        $case_no_abbr = $this->generteCaseName();  
    
        //inserting basic details in ekhajana basic 
        $insertDataForEkhajanaBasic = [
            "application_no" => $data['application_no'],
            "ld_application_no" => $data['ld_application_no'],
            "dist_code" => $data['dist_code'],
            "subdiv_code" => $data['subdiv_code'],
            'cir_code' => $data['cir_code'],
            "mouza_pargona_code" => $data['mouza_pargona_code'],
            "lot_no" => $data['lot_no'],
            "vill_townprt_code" => $data['vill_townprt_code'],
            "village_uuid" => $village_uuid,
            "is_urban" => $data['is_urban'],
            "patta_type_code" => $data['patta_type_code'],
            "patta_type" => $data['patta_type'],
            "patta_no" => $data['patta_no'],
            "pdar_id" => $data['pdar_id'], 
            "pdar_name" => $data['pdar_name'],
            "pdar_father_name" => $pdar_father_name,
            "applicant_name_eng" => $data['applicant_name_eng'],
            "applicant_name_asm" => $data['applicant_name_asm'],
            "guardian_name_eng" => $data['guardian_name_eng'],
            "guardian_name_asm" => $data['guardian_name_asm'],
            "guardian_relation" => $data['guardian_relation'],
            "gender" => $data['gender'],
            "date_of_birth" => $data['date_of_birth'],
            "address" => $data['address'],
            "mobile_no" => $data['mobile_no'],
            "pending_with_officer" => "CO",
            "mou_remark" => $data['mou_report'],
            "status" => EKHAJANA_MOUZADAR_OBJECTION,
            "created_at" => date('Y-m-d h:i:s'),
            'user_code' => $this->session->all_userdata()['user_code'],
            'case_no' => "NOT-GENERATED",
            'aadhaar_pan_ref_no' => $data['aadhaar_pan_ref_no'],
            'aadhaar_pan_type' => $data['aadhaar_pan_type'],
            'objection_remark' => $data['Ek_objection_rmk'],
            'objectionflag' =>'1',
            'pattadar_identification_flag' => $data['pattadar_identified']
        ];
       // $this->dbswitch_live();
        $this->db->trans_begin();
        $tstatus1 = $this->db->insert('ekhajana_basic', $insertDataForEkhajanaBasic);
        if ($tstatus1!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHIMBDO001, Error in insert on ekhajana_basic table with data ". json_encode($insertDataForEkhajanaBasic));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO001'];
        }
        $ekhajana_basic_inserted_id = $this->db->insert_id();
        $case_no = $case_no_abbr."EKH/".$ekhajana_basic_inserted_id;
        //updating ekhajana basic details with case no 
        $update_data = array(
            'case_no' => $case_no,
        ); 
        $this->db->where('id', $ekhajana_basic_inserted_id);
        $this->db->update('ekhajana_basic', $update_data);
        if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            log_message("error", "#EKHIMBDO002, Error in update, table 'ekhajana_basic' with rtps application no ".$data['ld_application_no']);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO002'];
        }
        
        //ekhajana basic proceeding details insert
        $proceeding_details_data = array(
            'ld_application_no' => $data['ld_application_no'],
            'application_no' => $data['application_no'],
            'remark' => $data['mou_report'],            
            'user_code' => $this->session->all_userdata()['user_code'],
            "created_at" => date('Y-m-d h:i:s'),
            "case_no" => $case_no,
            'status' => EKHAJANA_MOUZADAR_OBJECTION,
            'objection_remark' => $data['Ek_objection_rmk'],
        ); 
        $tstatus2 = $this->db->insert('ekhajana_basic_proceedings', $proceeding_details_data); 
        if ($tstatus2!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHIMBDO003, Error in insert on ekhajana_basic_proceedings table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO003'];
        }
        //***************************************************************/
        //jamawasil row exist then no action
        //jamawasil row and mad row not found then insert 
        //jamawail row not found and mad row found then update 

        $mad_action = null;
        $jama_wasil_q = $this->db->query("select * from jama_wasil where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",
                array($data['dist_code'],$data['subdiv_code'],$data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code'],$data['patta_type_code'],$data['patta_no']));
        $jama_wasil_count = $jama_wasil_q->num_rows();
        if($jama_wasil_count > 0)
        {
            $mad_action = "mad_no_action"; //no action
        }

        if($mad_action != "mad_no_action"){
            $mouzadar_arrear_details_q = $this->db->query("select * from ekhajana_mouzadar_arrear_details  where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",
                    array($data['dist_code'],$data['subdiv_code'],$data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code'],$data['patta_type_code'],$data['patta_no']));
            $mouzadar_arrear_details_count = $mouzadar_arrear_details_q->num_rows();
            if($mouzadar_arrear_details_count > 0)
            {
                $mad_action = "mad_update"; //update
            }
            elseif($mouzadar_arrear_details_count == 0)
            {
                $mad_action = "mad_insert"; // insert 
            }
            if($mad_action == "mad_insert"){
                $insertArrearDetails = [
                    "application_no" => $data['application_no'],
                    "ld_application_no" => $data['ld_application_no'],
                    "case_no" => $case_no,
                    "dist_code" => $data['dist_code'],
                    "subdiv_code" => $data['subdiv_code'],
                    "cir_code" => $data['cir_code'],
                    "mouza_pargona_code" => $data['mouza_pargona_code'],
                    "lot_no" => $data['lot_no'],
                    "vill_townprt_code" => $data['vill_townprt_code'],
                    "village_uuid" => $village_uuid,
                    "patta_type_code" => $data['patta_type_code'],
                    "patta_no" => $data['patta_no'],
                    "current_revenue" => $data['current_revenue'],
                    "current_local_tax" => $data['current_local_tax'],
                    "current_doul_year" => $data['current_doul_year'],
                    "opening_balance" => $data['openinig_balance'],
                    'last_pay_date' => $data['last_pay_date1'],
                    "last_revenue_payment" => $data['last_revenue_payment_amount'],
                    "last_local_tax_payment" => $data['last_local_tax_payment_amount'],
                    //"ek_basic_id" => $data['ek_basic_id'],
                    "backup_arrear_json" => json_encode($data),
                    "payment_by" => $data['paymentBy'],
                    "created_at" =>date('Y-m-d h:i:s')
                ];
                $tstatus3 = $this->db->insert('ekhajana_mouzadar_arrear_details', $insertArrearDetails); 
                if ($tstatus3!= 1)
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHIMBDO0031, Error in insert on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO0031'];
                }
            }
    
            if($mad_action == "mad_update"){
                $mad_update_data = [
                    "backup_arrear_json" => json_encode($data),
                    "opening_balance" => $data['openinig_balance'],
                    'last_pay_date' => $data['last_pay_date1'],
                    "last_revenue_payment" => $data['last_revenue_payment_amount'],
                    "last_local_tax_payment" => $data['last_local_tax_payment_amount'],
                    "current_revenue" => $data['current_revenue'],
                    "current_local_tax" => $data['current_local_tax'],
                    "modified_at" => date('Y-m-d h:i:s'),
                ];
    
                $this->db->where('dist_code', $data['dist_code'])
                          ->where('subdiv_code', $data['subdiv_code'])
                          ->where('cir_code', $data['cir_code'])
                          ->where('mouza_pargona_code', $data['mouza_pargona_code'])
                          ->where('lot_no', $data['lot_no'])
                          ->where('patta_type_code', $data['patta_type_code'])
                          ->where('patta_no', $data['patta_no'])
                          ->where('vill_townprt_code', $data['vill_townprt_code'])
                          //->where('village_uuid', $data['village_uuid'])
                         ->update('ekhajana_mouzadar_arrear_details', $mad_update_data);
                if($this->db->affected_rows() != 1){ 
                    $this->db->trans_rollback();
                    log_message("error", "#EKHIMBDO005, Error in update on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO005'];
                }
            }
        }
        //***************************************************************/
        //basundhara ekhajana land details update
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                "dist_code" => $data['dist_code'],
                "subdiv_code" => $data['subdiv_code'],
                'cir_code' => $data['cir_code'],
                "mouza_pargona_code" => $data['mouza_pargona_code'],
                "lot_no" => $data['lot_no'],
                "user_code" => 'MOU',
                "case_no" => $case_no,
                "remark" => $data['mou_report'],
                'ld_application_no' => $data['ld_application_no'],
                'application_no' => $data['application_no'],
                'status' => EKHAJANA_MOUZADAR_OBJECTION,                    
                'date_of_action' => date("Y-m-d"), 
                'patta_no' => $data['patta_no'],
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        //return $response;
        if($httpcode == 200){
            //return "curl successfull";
            $response_obj = json_decode($response);
            if($response_obj->result == "Y"){
                $this->db->trans_commit();
                return ['result' => 'SUCCESS', 'msg' => 'Case forwarded Sucessfully..!'];                 
            }else{
                $this->db->trans_rollback();
                log_message("error", "#EKHIMBDO006, Curl Error(Y) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API);
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO006'];
            } 
        }else{
            $this->db->trans_rollback();
            log_message("error", "#EKHIMBDO007, Curl Error(200) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO007'];
        }
    }

    //method for a already registerd case submit as objection by mouzadar
    public function updateMouzadarObjectionBasicDetails($data, $case_no){
        error_reporting(0); 
        $village_uuid = $this->getVillageUUID($data['dist_code'],$data['subdiv_code'],
        $data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code']);         
        //updating basic details in ekhajana basic 
        $updateDataForEkhajanaBasic = [
            'pending_with_officer' => 'CO',
            'status' => EKHAJANA_MOUZADAR_OBJECTION,
            'mou_remark' => $data['mou_report'],
            'modified_at' => date('Y-m-d h:i:s'),
            'objection_remark' => $data['Ek_objection_rmk'],
            'objectionflag' =>'1',
            'pattadar_identification_flag' => $data['pattadar_identified']
        ];
       // $this->dbswitch_live();
        $this->db->trans_begin();
        $this->db->where('case_no', $case_no);
        $this->db->update('ekhajana_basic', $updateDataForEkhajanaBasic);
        if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            log_message("error", "#EKHUMOBD001, Error in update, table 'ekhajana_basic' with rtps application no ".$data['ld_application_no']);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUMOBD001'];
        }
        //ekhajana basic proceeding details insert
        $proceeding_details_data = array(
            'ld_application_no' => $data['ld_application_no'],
            'application_no' => $data['application_no'],
            'remark' => $data['mou_report'],            
            'user_code' => $this->session->all_userdata()['user_code'],
            "created_at" => date('Y-m-d h:i:s'),
            "case_no" => $case_no,
            'status' => EKHAJANA_MOUZADAR_OBJECTION,
        ); 
        $tstatus2 = $this->db->insert('ekhajana_basic_proceedings', $proceeding_details_data); 
        if ($tstatus2!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHUMOBD002, Error in insert on ekhajana_basic_proceedings table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUMOBD002'];
        }
        
        //***************************************************************/
        //jamawasil row exist then no action
        //jamawasil row and mad row not found then insert 
        //jamawail row not found and mad row found then update 

        $mad_action = null;
        $jama_wasil_q = $this->db->query("select * from jama_wasil where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",
                array($data['dist_code'],$data['subdiv_code'],$data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code'],$data['patta_type_code'],$data['patta_no']));
        $jama_wasil_count = $jama_wasil_q->num_rows();
        if($jama_wasil_count > 0)
        {
            $mad_action = "mad_no_action"; //no action
        }

        if($mad_action != "mad_no_action"){
            $mouzadar_arrear_details_q = $this->db->query("select * from ekhajana_mouzadar_arrear_details  where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",
                    array($data['dist_code'],$data['subdiv_code'],$data['cir_code'],$data['mouza_pargona_code'],$data['lot_no'],$data['vill_townprt_code'],$data['patta_type_code'],$data['patta_no']));
            $mouzadar_arrear_details_count = $mouzadar_arrear_details_q->num_rows();
            if($mouzadar_arrear_details_count > 0)
            {
                $mad_action = "mad_update"; //update
            }
            elseif($mouzadar_arrear_details_count == 0)
            {
                $mad_action = "mad_insert"; // insert 
            }
            if($mad_action == "mad_insert"){
                $insertArrearDetails = [
                    "application_no" => $data['application_no'],
                    "ld_application_no" => $data['ld_application_no'],
                    "case_no" => $case_no,
                    "dist_code" => $data['dist_code'],
                    "subdiv_code" => $data['subdiv_code'],
                    "cir_code" => $data['cir_code'],
                    "mouza_pargona_code" => $data['mouza_pargona_code'],
                    "lot_no" => $data['lot_no'],
                    "vill_townprt_code" => $data['vill_townprt_code'],
                    "village_uuid" => $village_uuid,
                    "patta_type_code" => $data['patta_type_code'],
                    "patta_no" => $data['patta_no'],
                    "current_revenue" => $data['current_revenue'],
                    "current_local_tax" => $data['current_local_tax'],
                    "current_doul_year" => $data['current_doul_year'],
                    "opening_balance" => $data['openinig_balance'],
                    'last_pay_date' => $data['last_pay_date1'],
                    "last_revenue_payment" => $data['last_revenue_payment_amount'],
                    "last_local_tax_payment" => $data['last_local_tax_payment_amount'],
                    //"ek_basic_id" => $data['ek_basic_id'],
                    "backup_arrear_json" => json_encode($data),
                    "payment_by" => $data['paymentBy'],
                    "created_at" =>date('Y-m-d h:i:s')
                ];
                $tstatus3 = $this->db->insert('ekhajana_mouzadar_arrear_details', $insertArrearDetails); 
                if ($tstatus3!= 1)
                {
                    $this->db->trans_rollback();
                    log_message("error", "#EKHIMBDO0031, Error in insert on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO0031'];
                }
            }
    
            if($mad_action == "mad_update"){
                $mad_update_data = [
                    "backup_arrear_json" => json_encode($data),
                    "opening_balance" => $data['openinig_balance'],
                    'last_pay_date' => $data['last_pay_date1'],
                    "last_revenue_payment" => $data['last_revenue_payment_amount'],
                    "last_local_tax_payment" => $data['last_local_tax_payment_amount'],
                    "current_revenue" => $data['current_revenue'],
                    "current_local_tax" => $data['current_local_tax'],
                    "modified_at" => date('Y-m-d h:i:s'),
                ];
    
                $this->db->where('dist_code', $data['dist_code'])
                          ->where('subdiv_code', $data['subdiv_code'])
                          ->where('cir_code', $data['cir_code'])
                          ->where('mouza_pargona_code', $data['mouza_pargona_code'])
                          ->where('lot_no', $data['lot_no'])
                          ->where('patta_type_code', $data['patta_type_code'])
                          ->where('patta_no', $data['patta_no'])
                          ->where('vill_townprt_code', $data['vill_townprt_code'])
                          //->where('village_uuid', $data['village_uuid'])
                         ->update('ekhajana_mouzadar_arrear_details', $mad_update_data);
                if($this->db->affected_rows() != 1){ 
                    $this->db->trans_rollback();
                    log_message("error", "#EKHIMBDO005, Error in update on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
                    return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIMBDO005'];
                }
            }
        }
        //***************************************************************/

        //basundhara ekhajana land details update
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                "dist_code" => $data['dist_code'],
                "subdiv_code" => $data['subdiv_code'],
                'cir_code' => $data['cir_code'],
                "mouza_pargona_code" => $data['mouza_pargona_code'],
                "lot_no" => $data['lot_no'],
                "user_code" => 'MOU',
                "case_no" => $case_no,
                "remark" => $data['mou_report'],
                'ld_application_no' => $data['ld_application_no'],
                'application_no' => $data['application_no'],
                'status' => EKHAJANA_MOUZADAR_OBJECTION,                    
                'date_of_action' => date("Y-m-d"), 
                'patta_no' => $data['patta_no'],
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 200){
            //return "curl successfull";
            $response_obj = json_decode($response);
            if($response_obj->result == "Y"){
                $this->db->trans_commit();
                return ['result' => 'SUCCESS', 'msg' => 'Case forwarded Sucessfully..!'];                 
            }else{
                $this->db->trans_rollback();
                log_message("error", "#EKHUMOBD005, Curl Error(Y) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API);
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUMOBD005'];
            } 
        }else{
            $this->db->trans_rollback();
            log_message("error", "#EKHUMOBD006, Curl Error(200) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUMOBD006'];
        }
    }
}

?>

