<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  
class EkhajanaMouzadarController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ekhajana/EkhajanaDoulModel');
        $this->load->model('ekhajana/EkhajanaMouzadarModel');
        $this->load->model('ekhajana/EkhajanaAmdaniModel');
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


    function convertLiteral($arr)
    {
      $y = substr($arr, 1, -1);
      $z = explode(',', $y);
      $index = 0;
      $final_str = '';
      foreach($z as $a)
      {
            if ($index == 0)
              $final_str = "'".$a."'";
            else
              $final_str = $final_str.",'". $a."'";
            $index++;
      }
      //var_dump($final_str);
      return array(sizeof($z),$final_str,$z);
    }


    //method to decode image
    public function imageDecodeBase64($encoded_string){
        $file_data= base64_decode($encoded_string);
        $file = finfo_open();
        $mime_type = finfo_buffer($file, $file_data, FILEINFO_MIME_TYPE);
        $file_type = explode('/', $mime_type)[0];
        $extension = explode('/', $mime_type)[1];
        log_message("error","No error occured".json_encode($mime_type));
        return $mime_type;
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

   
    function convertLiteralEkhajana($arr)
    {
        $elements_str_arr = array();
        foreach($arr as $element){
            $element_str = "'".$element."'";
            array_push($elements_str_arr, $element_str);
        }

        $arr_str = implode(', ', $elements_str_arr);
        return $arr_str;
    }


    //checking Is Mouzadar
    function checkIsMouzadar(){
        $this->dbswitch();
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
		$village_codes = $this->convertLiteralEkhajana($village_codes_arr);

                $sql = "Select uuid from location where dist_code ='$dist_code' and subdiv_code ='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code ='$mouza_pargona_code'
                and lot_no!='00' and vill_townprt_code!='00000' and uuid in ($village_codes)";
                $query = $this->db->query($sql);
                
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

    //index-method
    public function index() {
        //***************chechink-user-designation**********/
	    if($this->session->userdata('designation') != 'MOU'){
             echo json_encode("Not Authorised!!");
             exit;
      	}
        $mouzadarflag = $this->checkIsMouzadar();
        if(!$mouzadarflag['flag']){
            $data['errorMessage'] = $mouzadarflag['result'];
            $data['_view'] = 'e_khajana/mouzadar_error_page';
            $this->load->view('layouts/main',$data);
            return;
        }
        //**************************************************/
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['circle_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');             
        $data = $this->EkhajanaMouzadarModel->pendingCountForMouzadar($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        //****************************************************/

        // var_dump($data);
        if(!$data['flag']){
            echo json_encode("Error in fetching Pending Count");
            exit;
        }
        $data['objection_count'] = $this->EkhajanaMouzadarModel->ObjectionCount($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
	$data['re_updation_cases_count'] = $this->EkhajanaMouzadarModel->reUpdationCount($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);

	$pending_count_mouzadari_forwarded = $this->EkhajanaMouzadarModel->pendingCountForMouzadarForwarded($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        if(!$pending_count_mouzadari_forwarded['flag']){
            echo json_encode("Error in fetching Forwarded Count");
            exit;
	}

        //*********************************************************/
        $pending_count_citizen = $this->EkhajanaMouzadarModel->getCitizenPendingCount($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        if(!$pending_count_citizen['flag']){
            echo json_encode("Error in fetching pending payment for citizen Count");
            exit;
        }
        $data['pending_count_citizen'] = $pending_count_citizen['result'];
        //*********************************************************/

	$data['pending_count_mouzadari_forwarded'] = $pending_count_mouzadari_forwarded['result'];
	//*********************************************************/
        $rejected_application = $this->EkhajanaMouzadarModel->getRejectedCount($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        if(!$rejected_application['flag']){
            echo json_encode("Error in fetching pending payment for citizen Count");
            exit;
        }
        $data['rejected_app_count'] = $rejected_application['result'];
	//*********************************************************/
	//*********************************************************/
        $objection_application = $this->EkhajanaMouzadarModel->getObjectionCount($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        if(!$objection_application['flag']){
            echo json_encode("Error in fetching Objection Count");
            exit;
        }
        $data['objection_app_count'] = $objection_application['result'];
	//*********************************************************/
	//*********************************************************/
        $reverted_by_co_application = $this->EkhajanaMouzadarModel->getRevertedByCoCount($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        if(!$reverted_by_co_application['flag']){
            echo json_encode("Error in fetching reverted by Circle Officer to Mouzadar Count");
            exit;
        }
        $data['reverted_by_co_app_count'] = $reverted_by_co_application['result'];
        //*********************************************************/
        $data['pendingCount'] = $data['result'];
        $data['_view'] = 'e_khajana/mouz_views/index';
        $this->load->view('layouts/main',$data);
    }

    //displaying pending list for ast
    public function pendingList(){
        //***************chechink-user-designation**********/
	    if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $mouzadarflag = $this->checkIsMouzadar();
        if(!$mouzadarflag['flag']){
            $data['errorMessage'] = $mouzadarflag['result'];
            $data['_view'] = 'e_khajana/mouzadar_error_page';
            $this->load->view('layouts/main',$data);
            return;
        }
        //**************************************************/
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');        
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['circle_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $data = $this->EkhajanaMouzadarModel->pendingListForMouzadar($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);        
        if(!$data['flag']){
            echo json_encode("Error in fetching Pending List");
            exit;
        }
        $data['pendingList'] = $data['result'];
        $data['_view'] = 'e_khajana/mouz_views/pending_list';
        $this->load->view('layouts/main',$data);
    }

    //displaying due payment form
    public function arrearUpdateForm($ek_land_details_id){
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
           echo json_encode("Not Authorised!!");
           exit;
        }
        $mouzadarflag = $this->checkIsMouzadar();
        if(!$mouzadarflag['flag']){
            $data['errorMessage'] = $mouzadarflag['result'];
            $data['_view'] = 'e_khajana/mouzadar_error_page';
            $this->load->view('layouts/main',$data);
            return;
        }
        //**************************************************/
        //checking doul existance
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['circle_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $this->dbswitch($dist_code);
        $doulExistsFlag = $this->EkhajanaMouzadarModel->checkDoulExists($dist_code,$subdiv_code,$cir_code);
        //echo "<pre>";
        //var_dump($doulExistsFlag);
        //echo "</pre>";
        if(!$doulExistsFlag){
            $data['_view'] = 'e_khajana/mouz_views/doul_error_page';
            $this->load->view('layouts/main',$data);
            return;
        }
        $doulApproveFlag = $this->EkhajanaMouzadarModel->checkDoulApprove($dist_code,$subdiv_code,$cir_code);
        if(!$doulApproveFlag){
           $data['_view'] = 'e_khajana/mouz_views/doul_error_page';
           $this->load->view('layouts/main',$data);
            return;
        }
        $ekLandDetails = $this->EkhajanaMouzadarModel->getLandDetailsFromId($ek_land_details_id);
        $arrear_update_flag = $this->EkhajanaMouzadarModel->getArrearUpdateFlag($ekLandDetails['result']->land_details);
	if(!$arrear_update_flag){
	    $data['pendingCaseDocumentDetails'] = $ekLandDetails['result']->document_details;
            $data['ek_land_details'] = $ekLandDetails['result']->land_details;
            $data['_view'] = 'e_khajana/mouz_views/arrear_error';
            $this->load->view('layouts/main',$data);
            return;
        }
        $data['total_arrear'] = $total_arrear =  $this->EkhajanaMouzadarModel->getTotalArrear($ekLandDetails['result']->land_details);
       // echo $total_arrear;exit;
        if($total_arrear == 'not_updated'){
            $data['errorMessage'] = "Arrear Error..!";
            $data['_view'] = 'e_khajana/mouzadar_error_page';
            $this->load->view('layouts/main',$data);
            return;
        }
        $rtps_application_no = $ekLandDetails['result']->land_details->application_no;
        if(!$ekLandDetails['flag']){
            echo json_encode($ekLandDetails['result']);
            exit;
        }
        //for getting aadaar photo///////////////////////////
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, EKHAJANA_AADHAAR_PHOTO_FETCH);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'application_no'             => $rtps_application_no,
        )));
        $get_aadhaar_photo = curl_exec($curl_handle);
        curl_close($curl_handle);
        if ($get_aadhaar_photo != 'n') {
            $data['aadhaar_b64_decoded'] = "<img src = data:".$this->imageDecodeBase64($get_aadhaar_photo).";base64,".$get_aadhaar_photo." class='img-thumbnail' alt='Adhar Photo' width='170' height='200'>";
            //$data['aadhaar_b64_decoded'] = "<img src = data:" . "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAAEsCAIAAAD2HxkiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAACldJREFUeNrs3Wtv03YbwGEoZRyebRLivA22aYhNQki82vf/Apu2Fdi6lh62MppTW0jTloYkz/20kpenFJo4dg72db1AiIMLrn+9/3Yd53yv1zsHTM55EYIIQYSACEGEgAhBhIAIQYSACEGEgAhBhIAIQYSACEGEgAhBhIAIQYSACEGEgAhBhIAIQYSACEGEgAhBhMBsRLi1tbW6umpfM4vu379/8+bNXD/E/Bj+G+12u9ls+nQyi+LozftDzNnLMFkiBBGCCAERgggBEYIIARGCCAERgggBEYIIARGCCAERggiBnM1P+b9vbm7uzp07Pk+MolKpdDodEaaP8OHDhw4jRrG1tTXNEVqOgghBhIAIQYSACEGEgAhBhIAIQYSACEGEgAhBhIAIQYSACEGEgAhBhIAIQYSACEGEgAhBhIAIQYRARubtgkEcHBy02+0LFy5cvXrV3kCE49Dr9ba3txuNRr1ef/v27f/tsvn5a9eu3bp1K36Mn9tXiDB7r169WltbO9Fe4t27d7UjMRjvHYmf2GmIMButVuv58+fx4yB/uNPpRKv//PPP999/f/36dXuPdFyY+VcsPn/++ecBC0wcHh4uLCz89ddfdiAiHEmlUomWUr+p8srKytLSkt2ICFN68+bN4uLiiBt5+fJlLE3tTEQ4tHa7/fTp0263O/qmlpeXo2e7FBEOJ07n4rwuk01FyS9evCjPrsvkKxdlj/Dg4CCWkRlu8PXr1/V6vSR7L86Em82mikQ4kjiLy/zL+d9//12GXbezsxNfv169eqUiEY6kWq1mvs04LYzzzGLvt06ns7i42Ov1KpVK6kvKiPB/35qP5Wjmm41Ds1arFXvXra6u7u/vH9cYHQpJhOnP33LacrHPlGK/9Z9IW5GKML08xuCx4ylRSHEK/ccff8S07/+K4xszIkzp3bt3OW25wOeEyUK0n2EoQsYkJt7Gxsb7vx6nhfl9RRNhkeX3EqSLFy+WYSHa/1suz4gwjStXruS05UuXLhVyIbq3t/eh33XfrAjT+PTTT3Pa8meffVaShWii1Wrld7VZhIUVqeS0brx27VpJFqKGoQhHcv78+Rs3bmS+2f8cKc9CNFGr1Qp/q5AIs/fVV19Fitlu8/79+6VaiPYPTJdnRJhmat29ezfb88xbt24VaSF6fI/ogH/eilSEaXz99ddZPbkwhup3332X+Wid7EJ0qIfuxKp1Z2fHQSXC4Vy6dOnRo0eZlPPtt98W6ZLM4AvRfu6eEWEaUc6DBw9G3Mjt27eLdDY47EI04fKMCFP68ssvf/jhh7m5lDvk3r178deLtEPW19eHffpjUu/m5qYjSoRp3Llz58mTJ5cvXx7qb8X5ZORXsFPBZrM5ypNUXZ4Z7hCyC/p9/vnnP/7448uXL2MOnHlHcozNu3fvfvPNNwW7U3TAb81/xP7+/vb2dsHuWBDhGNcGc3Oxtoy64jCqVqvx44kaY+LF4XX9+vUbN24U8h7R1AvRE8NQhCIcbb/Mz988cu7oCQ7J/SJR3SeffFLg//iIC9FEo9E4PDws9r4S4fhcuHCheDdk57QQ7d/U5uZmwW4eymvxZRdMp93d3fE/Wjdm4OgL0f4VaSY9i5AJiAXw0yPj7DCyz/a9pQ4ODuKM2mdThDNpfX09juCtra1nz56Np8PjhWjmH8v3KkQ4qwvR5GaxRqMxng5jBsbHzXyz8e//0BseI8LptbS01F9dHMfPnz/PtcPMF6KJOCd0K6kIZ0ys395/SES9Xs+vw5wWoomI0OUZEc6Mdru9urp66m/l12FOC9FELEfj5NYnV4SzYXl5+SOvP8ijw1arldNC9MR498kV4QyIVeiZz4aIDn///fesOoxVYq4L0URMwvzecUCEZHZitri4OMifrNVq0WEmZ1kxA8fzxjXxr/XiJhFOu42NjUEeZ5Z0GOvSETuMhej6+vrY/oPunhHhVNvf319bWxvqr4w4D8e2EE0cHh42Gg2faxFOqeXl5RQ9VKvV1B2ObSHar/8tDRHhFKlUKqlHRHSY4kUPY16IJnZ2dgr8to0inFWdTmdlZWXEhofqMP7k4uLi+F+fcc7dMyKcTi9evBj91sqhOtzY2Jjgu+pubm5OpH8Rcrrd3d2sJkN0OMjjCff29j50R854uDwjwilyfH0yw6v2MWQ+/p3G8V8RPZW7Z0Q4LWIGZn7HZnQYmU3nQjSxvb3t8owIJy/OA+NsMKeTrlPn4cQXooahCNPLY/22srLS6XTym7EnOpyShWj/VwqXZ0Q4xNop8we9NBqNvN/E70SHU7IQTbTb7Vqt5ugS4UBiCbe1tbWwsJBVh7Gd5eXl8Zxz/vnnn+eO7ombnoWoFempPHf0Y2PweIDET6LDx48fp367mMTa2trYLkscH+gTeXTimV6/fh2nqVevXnWYmYRnjMH+IH/77bcRj+Y47FK83d+IHU7VQtQwFGGaMZjY2dn59ddfR7mgMqn7xaZTnBjbGyIcdAz2L6JiHqbrMI6595/gVGbtdrtardoPIhx0DPZ3GPPwzHdNe/+AG8/1mNliRSrC4cZgIvqMeThUh7FB7yB96p7M8K0vRFiKMdh/9Aw+D2N4+pL/IV7pK8Khx2Ci2WxGh2fOt263u7S0ZK9+SJwW5nfzkAgLOwaH6nBjYyPXR+vOulhNuDwjwjRjMBGBfaTDg4ODiTxIYrZ4ub0IU47B/g5/+eWXUzuMhai11plin4//qVMiLMgYTLRarejw8PCw/xfr9bpXkRuGIsx9DPZ3GOvSpMMYgK7HDK5SqZR5ySDCUcfgiXl4/OCmtbU1b445uCgw75d3ibDgYzCxt7cX8zBWoWO+UbsAyvytVBFmMwb7O1xYWPC+C8Pa3d2d2hd8iHBmxiCGoQgnPwYZRbVaHfbOeBEag2Sp2+2W8/JM2SM0Bq1IRWgM8q9Wq1XClz6XOkJj0DAUoTHISbVarWwvgC5vhMbgdOp2u5ubmyI0Bpmkst3PXdIIjcFptre3F18lRWgMMkmlWpGWMUJjcPqV6vJM6SI0BmdCqS7PlC5CY3BWlOcbhuWK0BicIfv7+yW5PFOuCI1Bw1CExiBDqNfrJx6fJUJjkLHq9Xpl+MZ9WSI0BmdURFj4Z4WU5e2y4yz/iy++cEzPordv316+fFmEM0+BWI4CIgQRAiIEEQIiBBECIgQRAiIEEQIiBBGCCAERgggBEYIIgYmY9sdb9Hq9ZrPp88Qout2uCNPrdDo//fSTwwjLUUCEIEJAhCBCQIQgQkCEIEJAhCBCQIQgQkCEIEJAhCBCQIQgQkCEIEJAhCBCQIQgQkCEIEJAhCBCQIQgQkCEIEJAhCBCQIQgQkCEIEJAhCBCQIQgQkCEIEJAhCBCECEgQhAhIEIQISBCECEgQhAhIEIQISBCECEgQhAhIEIQISBCECEgQhAhIEIQIZCx871ez14AEYIIARGCCAERgggBEYIIARGCCAERgggBEYIIARGCCAERgggBEYIIARGCCAERgggBEYIIARGCCAERgggBEYIIARHC7PqvAAMA/BkrMLAeft8AAAAASUVORK5CYII=" . " class='img-thumbnail' alt='Adhar Photo' width='170' height='200'>";
        }
        ///////////////////////////////////////////////////
        $data['pendingCaseLandDetails'] = $land_details = $ekLandDetails['result']->land_details;
        $data['pendingCaseApplicantDetails'] = $ekLandDetails['result']->applicant_details;
        $data['pendingCaseDocumentDetails'] = $ekLandDetails['result']->document_details;
        //checking whether jama wasil is already updated or not for this patta
        $data['arrear_status'] = $this->EkhajanaMouzadarModel->checkArrearStatus($land_details);
        $currentDoulDemand = $this->EkhajanaMouzadarModel->getCurrentRevenueAndLocalTaxFromDoul($land_details);
        if(!$currentDoulDemand['flag']){
            echo json_encode("Current Doul Demand Not Found For This Patta..!!");
            exit;
        }
        $data['current_revenue'] = $currentDoulDemand['result']->dag_revenue;
        $data['current_local_tax'] = $currentDoulDemand['result']->dag_local_tax;
        $data['current_doul_year'] = $currentDoulDemand['result']->year_no;
        $data['dist_code'] = $dist_code;
        //payee relations
        $data['payee_relations'] = $this->EkhajanaMouzadarModel->getGuardianRelations();
        $data['_view'] = 'e_khajana/mouz_views/mouzadar_arrear_update_form';
        $this->load->view('layouts/main',$data);
    }

    //mouzadar case registration 
    public function caseRegistration(){ 
	//checking special characters in address field
        $string = $_POST['address'];
        $special_chars = EKHAJANA_REPLACE_SPECIAL_CHAR;
        $new_address = $string;
        foreach ($special_chars as $char) {
            $new_address = str_replace($char, '.', $new_address);
        }
        $_POST['address'] = $new_address;
        //********************************************
        $dist_code = $_POST['dist_code'];
        $application_no = $_POST['application_no'];
        $ld_application_no = $_POST['ld_application_no'];
        $rtps_doc_id = $_POST['rtps_doc_id'];
	$tmp_name = $_FILES['fileUpload']['name'];
	/*
        if($tmp_name== "" || $tmp_name == null){
            if($rtps_doc_id == null || $rtps_doc_id == ""){
                echo json_encode(['result' => 'FILE_UPLOAD_ERR', 'msg' => 'RTPS Document Not Found For this case, Kindly Self Upload A Relevant Document From Your end For Further Processing...!!!']);
                die();
            }
        }  
	*/
        $error_msg = array();
        $validation = [
            [
                'field' => 'application_no',
                'label' => 'Application no',
                'rules' => 'required|callback_check_script|trim|max_length[45]'
            ],
            [
                'field' => 'ld_application_no',
                'label' => 'land details app. no',
                'rules' => 'required|callback_check_script|trim|max_length[45]'
            ],
            [
                'field' => 'dist_code',
                'label' => 'district code',
                'rules' => 'required|callback_check_script|max_length[2]|trim'
            ],
            [
                'field' => 'subdiv_code',
                'label' => 'sub division code',
                'rules' => 'required|callback_check_script|max_length[2]|trim'
            ],
            [
                'field' => 'cir_code',
                'label' => 'circle code',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'mouza_pargona_code',
                'label' => 'mouza pargona code',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'lot_no',
                'label' => 'lot no',
                'rules' => 'required|callback_check_script|max_length[5]|trim',
            ],
            [
                'field' => 'vill_townprt_code',
                'label' => 'village townport code',
                'rules' => 'required|callback_check_script|max_length[5]|trim',
            ],
            [
                'field' => 'is_urban',
                'label' => 'is urban',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'patta_type',
                'label' => 'patta type',
                'rules' => 'required|callback_check_script|trim|max_length[150]',
            ],
            [
                'field' => 'patta_type_code',
                'label' => 'patta type code',
                'rules' => 'required|callback_check_script|trim|max_length[4]',
            ],
            [
                'field' => 'pdar_id',
                'label' => 'pattadar id',
                'rules' => 'required|callback_check_script|trim|integer',
            ],
            [
                'field' => 'pdar_name',
                'label' => 'pattadar name',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'pdar_father_name',
                'label' => 'pattadar father name',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'patta_no',
                'label' => 'patta no',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'applicant_name_eng',
                'label' => 'applicant name in english',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'applicant_name_asm',
                'label' => 'applicant name in assamese',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_name_eng',
                'label' => 'guardian name in english',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_name_asm',
                'label' => 'guardian name in assamese',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_relation',
                'label' => 'guardian relation',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'date_of_birth',
                'label' => 'date of birth',
                'rules' => 'required|callback_check_script|trim|callback_date_valid',
            ],
            [
                'field' => 'gender',
                'label' => 'gender',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'address',
                'label' => 'address',
                'rules' => 'required|callback_check_script|trim|max_length[200]',
            ],
            [
                'field' => 'mobile_no',
                'label' => 'mobile number',
                'rules' => 'required|callback_check_script|trim|exact_length[10]',
            ],
            [
                'field' => 'aadhaar_pan_ref_no',
                'label' => 'adhaar-pan reference number',
                'rules' => 'required|callback_check_script|max_length[45]',
            ],
            [
                'field' => 'aadhaar_pan_type',
                'label' => 'aadhaar-pan type',
                'rules' => 'required|callback_check_script|max_length[20]',
            ],
            // [
            //     'field' => 'rtps_doc_id',
            //     'label' => 'rtps document id',
            //     'rules' => 'required|callback_check_script',
            // ],
            [
                'field' => 'current_revenue',
                'label' => 'current revenue',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'current_local_tax',
                'label' => 'current local tax',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'current_doul_year',
                'label' => 'current doul year',
                'rules' => 'required|callback_check_script|trim|exact_length[4]',
            ],
            [
                'field' => 'mou_report',
                'label' => 'mouzadar report',
                'rules' => 'required|callback_check_script|trim|max_length[200]',
            ],
            [
                'field' => 'openinig_balance',
                'label' => 'Arrear/ Opening balance',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'last_pay_date1',
                'label' => 'Last pay date',
                'rules' => 'required|callback_check_script|callback_date_valid|trim',
            ],
            [
                'field' => 'last_revenue_payment_amount',
                'label' => 'Last Revenue Payment Amount ',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'last_local_tax_payment_amount',
                'label' => 'Last Local Tax Payment Amount ',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'paymentBy',
                'label' => 'payment by ',
                'rules' => 'required|callback_check_script|in_list[self,other]|trim',
            ],
            
        ];
        $this->form_validation->set_rules($validation);
        //$this->form_validation->set_message('check_script', 'Invalid characters entered in %s field');
        if ($this->form_validation->run() == FALSE)
        {               
            foreach($validation as $rule){
                if (form_error($rule['field'])) {
                array_push($error_msg, form_error($rule['field']));
                }
            }              
        }
        if(count($error_msg) != 0){
            echo json_encode(['result' => 'validation_error', 'msg' => $error_msg]);
            exit;
        }
        if($tmp_name!= "" || $tmp_name != null){
            $this->form_validation->set_rules('fileText', 'Document Details', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                echo json_encode(['result' => 'FILE_UPLOAD_ERR', 'msg' => 'Please Enter Additional Document Name!']);
                exit();
            }
            
            //additional file upload section
            
            // validation for file type and file size
            
            $name = $_FILES['fileUpload']['name'];
            $size = $_FILES['fileUpload']['size'];

            $mime = mime_content_type($_FILES['fileUpload']['tmp_name']);
            $exp  = explode("/",$mime);
            $ext  = $exp[1];

            if($name != NULL)
            {
                if($ext == NULL)
                {
                    echo json_encode(['result' => 'FILE_UPLOAD_ERR', 'msg' => 'File extension not found']);
                    exit();
                }
                if(! in_array($ext, EKHAJANA_UPLOAD_TYPE_VALIDATION))
                {
                    echo json_encode(['result' => 'FILE_UPLOAD_ERR', 'msg' => 'File type not matched, Please upload only PDF Format files']);
                    exit();
                }
                if($size > EKHAJANA_UPLOAD_MAX_SIZE)
                {
                    echo json_encode(['result' => 'FILE_UPLOAD_ERR', 'msg' => 'File size is too large to upload, Please Upload File of size less than 2MB']);
                    exit();
                }
            }
            else
            {
                log_message("error","#EKHFU001 Some error Occurred for application no ".$application_no);
                echo json_encode(['result' => 'FILE_UPLOAD_ERR', 'msg' => 'Please Upload additional Document since Rtps Document is not available for this case!!!']);
                exit();
            }
            
            // save file
            $_FILES['file']['name'] = $_FILES['fileUpload']['name'];
            $_FILES['file']['type'] = $_FILES['fileUpload']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['fileUpload']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['fileUpload']['error'];
            $_FILES['file']['size'] = $_FILES['fileUpload']['size'];

            $mime = mime_content_type($_FILES['fileUpload']['tmp_name']);
            $exp  = explode("/",$mime);
            $onlyExtension  = $exp[1];

            $fileRename =  'Ekhajana_AdditionalDoc_ByMou' .time(). '.' . $onlyExtension;
            $this->dbswitch();
            $config['upload_path']   = UPLOAD_SUPPORTING_DOC_PATH_EKHAJANA;
            $config['allowed_types'] = EKHAJANA_UPLOAD_ALLOW_TYPE;
            $config['max_size']  = EKHAJANA_UPLOAD_MAX_SIZE;
            $config['file_name'] = $fileRename;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file'))
            {
                if(!file_exists(UPLOAD_SUPPORTING_DOC_PATH_EKHAJANA . $fileRename)) {
                    echo json_encode(['result' => 'FILE_UPLOAD_ERR', 'msg' => 'Additional Document Uploading is not Successfull, Kindly Constact Admin..!!']);
                    exit;
                }
                $document= array(
                    'application_no'   => $_POST['application_no'],
                    'ld_application_no'   => $_POST['ld_application_no'],
                    'file_name' => $_POST['fileText'],
                    'user_code' => $this->session->userdata('user_code'),
                    'fetch_file_name' => $_FILES['file']['name'],
                    'file_type'  => $_FILES['file']['type'],
                    'file_path'  => UPLOAD_SUPPORTING_DOC_PATH_EKHAJANA . $fileRename,
                    'document_name'  => "Additional Document",
                    'created_at' => date('Y-m-d h:i:s'),
                );
                // save data in attachment file
                
                $tstatus1 = $this->db->insert('ekhajana_additional_document',$document);

                if ($tstatus1!= 1){
                    log_message("error","Could not insert into ekhajana additional document table for application no".$ld_application_no);
                    echo json_encode(['result' => 'FILE_UPLOAD_ERR', 'msg' => 'Could not upload additional document please try again after refreshing the application!!!']);
                    exit();
                }

            }
            else
            {
                log_message("error","could not insert into ekhajana additional document  #EKHFU002");
                echo json_encode(['result' => 'FILE_UPLOAD_ERR', 'msg' => 'Some Error Occured Please Try Again #EKHFU002!!!']);
                exit();
            }
            
        }
        $posted_ek_basic_details = $_POST;
        $ekBasicAddFlag = $this->EkhajanaMouzadarModel->insertBasicDetailsMouzadar($posted_ek_basic_details);
        echo json_encode($ekBasicAddFlag);
    }

    //jama wasil already exists case dispose handle; registering the case and inserting into ekhajana basic
    public function jwExistsCaseDispose(){
        //to do validation
        $posted_data = $_POST;
        $ekBasicDetails = $this->EkhajanaMouzadarModel->insertDataintoEkhajanaBasicandProcceding($posted_data);
        echo json_encode($ekBasicDetails);
    }

    //mouzadar bank account entry form
    public function getBankAccountEntryForm(){
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $mouzadarflag = $this->checkIsMouzadar();
        if(!$mouzadarflag['flag']){
            $data['errorMessage'] = $mouzadarflag['result'];
            $data['_view'] = 'e_khajana/mouzadar_error_page';
            $this->load->view('layouts/main',$data);
            return;
        }
        //**************************************************/
        $data['mouzadar_name'] = $this->session->userdata('name');
        //location codes
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        //location names
        $data['dist_name'] = $this->utilclass->getDistrictName($dist_code);
        $data['subdiv_name'] = $this->utilclass->getSubdivName($dist_code, $subdiv_code);
        $data['cir_name'] = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
        $data['mouza_name'] = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);
        $data['_view'] = 'e_khajana/bank_account_form';
        $this->load->view('layouts/main',$data);
    }

    //mouzadar bank account entry form
    public function bankAccountEntryFormSubmit(){
        $error_msg = array();
        $validation = [
            [
                'field' => 'user_unique_code',
                'label' => 'User Unique code',
                'rules' => 'required'
            ],
            [
                'field' => 'bank_name',
                'label' => 'Bank Name',
                'rules' => 'required|max_length[30]'
            ],
            [
                'field' => 'bank_ifsc_code',
                'label' => 'Bank IFSC Code',
                'rules' => 'required|exact_length[11]'
            ],
            [
                'field' => 'bank_account_number',
                'label' => 'Bank Account Number',
                'rules' => 'required|min_length[9]|max_length[18]|numeric'
            ],
            [
                'field' => 'bank_branch_name',
                'label' => 'Bank Branch Name',
                'rules' => 'required',
            ],
            [
                'field' => 'pan_no',
                'label' => 'PAN Number',
                'rules' => 'required|exact_length[10]',
            ],
        ];
        $this->form_validation->set_rules($validation);
        $this->form_validation->set_message('check_script', 'Invalid characters entered in %s field');
            if ($this->form_validation->run() == FALSE)
            {               
                foreach($validation as $rule){
                    if (form_error($rule['field'])) {
                    array_push($error_msg, form_error($rule['field']));
                    }
                }              
            }
            if(count($error_msg) != 0){
                echo json_encode(['result' => 'validation_error', 'msg' => $error_msg]);
                exit;
            }
        
        $user_details = $this->EkhajanaMouzadarModel->getUserDetailsByUserUniqueId($_POST['user_unique_code']);
        if(!$user_details['flag']){
            echo json_encode(['result' => 'SERVER-ERROR', 'msg' => $user_details['result']]);
            exit;
        }
        //bank details
        $bankDetails = [
            "user_id" => $user_details['result']->depart_user_id,
            "bank_account_no" => $_POST['bank_account_number'],
            "bank_ifsc_code" => $_POST['bank_ifsc_code'],
            "bank_name" => $_POST['bank_name'],
            "bank_branch_name"=> $_POST['bank_branch_name'],
            "created_at" => date('Y-m-d h:i:s'),
            "user_unique_id" => $_POST['user_unique_code'],
            "pan_no" => $_POST['pan_no'],
        ];
        $bank_details_insert_result = $this->EkhajanaMouzadarModel->insertBankDetails($bankDetails);
        echo json_encode($bank_details_insert_result);
    }

    //display form of amdani report 
    public function amdaniReportForm() {
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $mouzadarflag = $this->checkIsMouzadar();
        if(!$mouzadarflag['flag']){
            $data['errorMessage'] = $mouzadarflag['result'];
            $data['_view'] = 'e_khajana/mouzadar_error_page';
            $this->load->view('layouts/main',$data);
            return;
        }
        //**************************************************/      
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $data['district_name'] = $this->utilclass->getDistrictName($dist_code);
        $data['subdiv_name'] = $this->utilclass->getSubdivName($dist_code, $subdiv_code);
        $data['circle_name'] = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
        $data['mouza_name'] = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);
        $data['village_list'] = $this->EkhajanaAmdaniModel->getVillageList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        $data['_view'] = 'e_khajana/amdani_views/amdaniReportForm';
        $this->load->view('layouts/main',$data);
    }
    //getting-village-list
    public function getVllageList(){
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        //**************************************************/
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_code'] = $mouza_code = $this->session->userdata('mouza_pargona_code');
        $village_list = $this->EkhajanaAmdaniModel->getVillageList($dist_code,$subdiv_code,$cir_code,$mouza_code);
        echo json_encode($village_list);
    }

    //getting-patta-types
    public function getPattaTypes(){
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        //**************************************************/
        //$mouza_code = $_POST['mouza_code'];
        $village_uuid = $_POST['village_uuid'];
        $patta_types = $this->EkhajanaAmdaniModel->getPattaType($village_uuid);
        echo json_encode($patta_types);
    }

    //getting patta numbers 
    public function getPataNumbers(){
        $this->dbswitch();
        $village_uuid = $_POST['village_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
       
        $sqlPattaNos = "select distinct (patta_no) from current_doul_demand where uuid=? and patta_type_code =?";
        $query = $this->db->query($sqlPattaNos, array(
            $village_uuid,
            $patta_type_code
        ));        
        $patta_list = $query->result(); 
        $patta_to_be_updated_list =  array();
        //checking if patta is already updated
        foreach($patta_list as $patta){
            
            $sql = "select count(*) from jama_wasil where village_uuid=? and patta_no=? and patta_type_code=? and status=?";
            $query = $this->db->query($sql, array($village_uuid, $patta->patta_no, $patta_type_code,JAMA_WASIL_STATUS_ONLINE));        
            if($query->row()->count == 0){
                array_push($patta_to_be_updated_list, [
                    "patta_no" =>$patta->patta_no,
                ]);
            }
        }
        echo json_encode($patta_to_be_updated_list);
    }

    //amdani report form validation check
    public function amdaniReportFormValidation(){
         $this->load->library('form_validation');
         $this->form_validation->set_rules('village_uuid', 'Village', 'trim|required');
         $this->form_validation->set_rules('patta_type_code', 'Patta', 'trim|required|max_length[4]');
         $this->form_validation->set_rules('patta_no', 'Patta no', 'trim|required|max_length[20]');
         $this->form_validation->set_rules('start_date', 'Start Date Selection', 'trim|required');
         $this->form_validation->set_rules('to_date', 'End Date Selection', 'trim|required');
         if ($this->form_validation->run() == FALSE) {
             $this->form_validation->set_error_delimiters('', '');
             $validation = [];
             if (form_error('patta_type_code')) {
                 $validation[] = array('field' => 'patta_type_code', 'message' => form_error('patta_type_code'));
             }
             if (form_error('patta_no')) {
                 $validation[] = array('field' => 'patta_no', 'message' => form_error('patta_no'));
             }
             if (form_error('start_date')) {
                 $validation[] = array('field' => 'start_date', 'message' => form_error('start_date'));
             }
             if (form_error('to_date')) {
                 $validation[] = array('field' => 'to_date', 'message' => form_error('to_date'));
             }
             echo json_encode([
                 "response_type" => 1,
                 'validation' => $validation
             ]);
         }else{
             //to do validation 
             echo json_encode([
                 "response_type" => 2,
                 "msg" => "validation_passed"
             ]);
         }
    }

    //amdani report display method
    public function amdaniReport(){
        if(isset($_POST['paginate_form'])){
            //echo json_encode($_POST);
            $_POST['village_uuid'] = json_decode($_POST['posted_data'])->village_uuid;
            $_POST['patta_type_code'] = json_decode($_POST['posted_data'])->patta_type_code;
            $_POST['patta_no'] = json_decode($_POST['posted_data'])->patta_no;
            $_POST['start_date'] = json_decode($_POST['posted_data'])->start_date;
            $_POST['to_date'] = json_decode($_POST['posted_data'])->to_date;      
            $data['posted_data'] = $_POST;
            $offset = $_POST['offset'];
            $data['offset'] = $offset;
            $data['mouza_code'] =$this->session->userdata['mouza_pargona_code'];
            $data['reportData'] = $this->EkhajanaAmdaniModel->getJamaWasilTransactionData($data['posted_data'], $offset);            
            $data['reportDataCount'] = $this->EkhajanaAmdaniModel->getJamaWasilTransactionDataCount($data['posted_data']);            
            }else{
            $data['offset'] = 0;
            $data['mouza_code'] =$this->session->userdata['mouza_pargona_code'];
            $data['posted_data'] = $_POST;
            $data['reportData'] = $this->EkhajanaAmdaniModel->getJamaWasilTransactionData($data['posted_data'], 0);
            $data['reportDataCount'] = $this->EkhajanaAmdaniModel->getJamaWasilTransactionDataCount($data['posted_data']);
            }
       
        $data['_view'] = 'e_khajana/report_views/amdaniReport';
        $this->load->view('layouts/main',$data);
    }

    //to view receipt in mouzadar end
    function document(){
        $curl_handle = curl_init();
        $ld_application_no = $_GET['appl_no'];
        curl_setopt($curl_handle, CURLOPT_URL, EKHAJANA_DOWNLOAD_DOCUMENT_API_FOR_MOUZADAR);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'ld_application_no' => $ld_application_no
        )));
        $result = curl_exec($curl_handle);
        $result = json_decode($result);
        $output=$result->raw_data;
        $content_type=$result->mime_type;
        $check=explode("/",$content_type);
        if($check[1]=='pdf'){
            $output=base64_decode($output);
            header('Content-type: application/pdf');
            echo $output;
        }else{
            echo '<img src="data:'.$content_type.';base64,'.$output.'" />';
        }
    }

    //function to submit the objection
    public function submitObjection(){
	//checking special characters in address field
        $string = $_POST['address'];
        $special_chars = EKHAJANA_REPLACE_SPECIAL_CHAR;
        $new_address = $string;
        foreach ($special_chars as $char) {
            $new_address = str_replace($char, '.', $new_address);
        }
        $_POST['address'] = $new_address;
        // var_dump($_POST);
        // exit;
        $posted_data = $_POST;
        $error_msg = array();
        $validation = [
            [
                'field' => 'application_no',
                'label' => 'Application no',
                'rules' => 'required|callback_check_script|trim|max_length[45]'
            ],
            [
                'field' => 'ld_application_no',
                'label' => 'land details app. no',
                'rules' => 'required|callback_check_script|trim|max_length[45]'
            ],
            [
                'field' => 'dist_code',
                'label' => 'district code',
                'rules' => 'required|callback_check_script|max_length[2]|trim'
            ],
            [
                'field' => 'subdiv_code',
                'label' => 'sub division code',
                'rules' => 'required|callback_check_script|max_length[2]|trim'
            ],
            [
                'field' => 'cir_code',
                'label' => 'circle code',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'mouza_pargona_code',
                'label' => 'mouza pargona code',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'lot_no',
                'label' => 'lot no',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'vill_townprt_code',
                'label' => 'village townport code',
                'rules' => 'required|callback_check_script|max_length[5]|trim',
            ],
            [
                'field' => 'is_urban',
                'label' => 'is urban',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'patta_type',
                'label' => 'patta type',
                'rules' => 'required|callback_check_script|trim|max_length[150]',
            ],
            [
                'field' => 'patta_type_code',
                'label' => 'patta type code',
                'rules' => 'required|callback_check_script|trim|max_length[4]',
            ],
            [
                'field' => 'pdar_id',
                'label' => 'pattadar id',
                'rules' => 'required|callback_check_script|trim|integer',
            ],
            [
                'field' => 'pdar_name',
                'label' => 'pattadar name',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'pdar_father_name',
                'label' => 'pattadar father name',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'patta_no',
                'label' => 'patta no',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'applicant_name_eng',
                'label' => 'applicant name in english',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'applicant_name_asm',
                'label' => 'applicant name in assamese',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_name_eng',
                'label' => 'guardian name in english',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_name_asm',
                'label' => 'guardian name in assamese',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_relation',
                'label' => 'guardian relation',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'date_of_birth',
                'label' => 'date of birth',
                'rules' => 'required|callback_check_script|trim|callback_date_valid',
            ],
            [
                'field' => 'gender',
                'label' => 'gender',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'address',
                'label' => 'address',
                'rules' => 'required|callback_check_script|trim|max_length[200]',
            ],
            [
                'field' => 'mobile_no',
                'label' => 'mobile number',
                'rules' => 'required|callback_check_script|trim|exact_length[10]',
            ],
            [
                'field' => 'aadhaar_pan_ref_no',
                'label' => 'adhaar-pan reference number',
                'rules' => 'required|callback_check_script|trim|max_length[45]',
            ],
            [
                'field' => 'aadhaar_pan_type',
                'label' => 'aadhaar-pan type',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            //[
                //'field' => 'rtps_doc_id',
                //'label' => 'rtps document id',
                //'rules' => 'required|callback_check_script|trim',
            //],
            [
                'field' => 'current_revenue',
                'label' => 'current revenue',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'current_local_tax',
                'label' => 'current local tax',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'current_doul_year',
                'label' => 'current doul year',
                'rules' => 'required|callback_check_script|trim|exact_length[4]',
            ],
            [
                'field' => 'mou_report',
                'label' => 'mouzadar report',
                'rules' => 'required|callback_check_script|trim|max_length[200]',
            ],
            [
                'field' => 'openinig_balance',
                'label' => 'Arrear/ Opening balance',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'last_pay_date1',
                'label' => 'Last pay date',
                'rules' => 'required|callback_check_script|trim|callback_date_valid',
            ],
            [
                'field' => 'last_revenue_payment_amount',
                'label' => 'Last Revenue Payment Amount ',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'last_local_tax_payment_amount',
                'label' => 'Last Local Tax Payment Amount ',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            // [
            //     'field' => 'ek_basic_id',
            //     'label' => 'Ek basic id ',
            //     'rules' => 'required|callback_check_script|integer|trim',
            // ],
            [
                'field' => 'paymentBy',
                'label' => 'payment by ',
                'rules' => 'required|callback_check_script|in_list[self,other]|trim',
            ],
            [
                'field' => 'Ek_objection_rmk',
                'label' => 'Objection Remark ',
                'rules' => 'required|callback_check_script|trim|max_length[200]',
            ],
            
        ];
        $this->form_validation->set_rules($validation);
        $this->form_validation->set_message('check_script', 'Invalid characters entered in %s field');
            if ($this->form_validation->run() == FALSE)
            {               
                foreach($validation as $rule){
                    if (form_error($rule['field'])) {
                    array_push($error_msg, form_error($rule['field']));
                    }
                }              
            }
            if(count($error_msg) != 0){
                echo json_encode(['result' => 'validation_error', 'msg' => $error_msg]);
                exit;
            }
        $insertBasicDetails = $this->EkhajanaMouzadarModel->insertBasicDetailsObjection($posted_data);
        echo json_encode($insertBasicDetails);
    
    }

    //function to get the objection list
    public function objectionList(){
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['circle_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_code = $this->session->userdata('mouza_pargona_code'); 
        $data['objectionList'] = $this->EkhajanaMouzadarModel->objectionList($dist_code,$subdiv_code,$cir_code,$mouza_code);
        $data['_view'] = 'e_khajana/mouz_views/objection_list';
        $this->load->view('layouts/main',$data);
    }

    //function for arrear update of the objection records
    public function ObjectionarrearUpdateForm_old($ek_basic_id){
        //***************chechink-user-designation**********/
	    if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
         }
         $mouzadarflag = $this->checkIsMouzadar();
         if(!$mouzadarflag['flag']){
             $data['errorMessage'] = $mouzadarflag['result'];
             $data['_view'] = 'e_khajana/mouzadar_error_page';
             $this->load->view('layouts/main',$data);
             return;
         }
        
        //getting basic details
        $data['ekbasicDetails'] = $ekbasicDetails = $this->EkhajanaMouzadarModel->getEkBasicDetailsFromId($ek_basic_id); 
        if(!$ekbasicDetails){
            echo json_encode("Some Error Occured, Error Code : EKABNA0001");
            exit;
        } 
              
        //checking whether jama wasil is already updated or not for this patta 
        $checkJamaWasilStatus = $this->EkhajanaMouzadarModel->checkJamaWasilStatus($ekbasicDetails);  
        if($checkJamaWasilStatus == "jamawasil_updated"){
            $data['_view'] = 'e_khajana/mouz_views/mouzadar_jamawasil_exists_form';
            $this->load->view('layouts/main',$data);
            return;
        }
       
        $data['proceedingDetails'] = $this->EkhajanaMouzadarModel->getProceedingDetails($ekbasicDetails);
        $data['arrearDetails'] = $this->EkhajanaMouzadarModel->getEkhajanaArrearDetails($ekbasicDetails);
        
        //payee relations
        $data['payee_relations'] = $this->EkhajanaMouzadarModel->getGuardianRelations();    
        $data['_view'] = 'e_khajana/mouz_views/Objection_mouzadar_arrear_update_form';
        $this->load->view('layouts/main',$data);
    }

    //arrear update form submit handle through Mouzadr 
    public function arrearUpdateFormSubmitMouzadar(){
        //***************chechink-user-designation**********/
	    if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $mouzadarflag = $this->checkIsMouzadar();
        if(!$mouzadarflag['flag']){
            $data['errorMessage'] = $mouzadarflag['result'];
            $data['_view'] = 'e_khajana/mouzadar_error_page';
            $this->load->view('layouts/main',$data);
            return;
        }
        //*****************validation*************/
        $error_msg = array();
        $arrear_update_form_val = [
            [
                'field' => 'application_no',
                'label' => 'Application No',
                'rules' => 'required|callback_check_script|trim'
            ],
            [
                'field' => 'ld_application_no',
                'label' => 'Land Details Application No',
                'rules' => 'required|callback_check_script|trim'
            ],
            [
                'field' => 'case_no',
                'label' => 'Case No',
                'rules' => 'required|callback_check_script|trim'
            ],
            [
                'field' => 'current_doul_year',
                'label' => 'current dol Year',
                'rules' => 'required|callback_check_script|trim|exact_length[4]'
            ],
            [
                'field' => 'ek_basic_id',
                'label' => 'ID',
                'rules' => 'required|callback_check_script|integer|trim'
            ],
            
            [
                'field' => 'current_revenue',
                'label' => 'Current Revenue',
                'rules' => 'required|callback_check_script|numeric|trim'
            ],
            [
                'field' => 'current_local_tax',
                'label' => 'Current Local Tax',
                'rules' => 'required|callback_check_script|numeric|trim'
            ],
            [
                'field' => 'last_pay_date1',
                'label' => 'Last Pay Date',
                'rules' => 'required|callback_check_script|callback_date_valid|trim'
            ],
            [
                'field' => 'last_revenue_payment_amount',
                'label' => 'Last Revenue Payment Amount',
                'rules' => 'required|callback_check_script|numeric|trim'
            ],
            [
                'field' => 'last_local_tax_payment_amount',
                'label' => 'Last Local Tax Payment Amount',
                'rules' => 'required|callback_check_script|numeric|trim'
            ],
            [
                'field' => 'paymentBy',
                'label' => 'Last Payment By',
                'rules' => 'required|callback_check_script|in_list[self,other]|trim'
            ],
        ];
        $this->form_validation->set_rules($arrear_update_form_val);
        $this->form_validation->set_message('check_script','Please Fill The %s Correctly!');
        $this->form_validation->set_message('date_valid','Please Fill The %s Correctly!');
        if ($this->form_validation->run() == FALSE)
        {               
            foreach($arrear_update_form_val as $rule){
                if (form_error($rule['field'])) {
                array_push($error_msg, form_error($rule['field']));
                }
            }              
        }
        if(count($error_msg) != 0){
            echo json_encode(['result' => 'validation_error', 'msg' => $error_msg]);
            exit;
        }
    }

    //function to forward the objection case to lot mondol after approval of the objection case by CO
    public function MouzadarObjectionSubmitAfterCOApproval(){

        $ek_basic_id = $_POST['ek_basic_id'];
        // var_dump($ek_basic_id);
        // exit;
        
        $error_msg = array();
        $validation = [
            [
                'field' => 'application_no',
                'label' => 'Application no',
                'rules' => 'required|callback_check_script|trim|max_length[45]'
            ],
            [
                'field' => 'ld_application_no',
                'label' => 'land details app. no',
                'rules' => 'required|callback_check_script|trim|max_length[45]'
            ],
            [
                'field' => 'dist_code',
                'label' => 'district code',
                'rules' => 'required|callback_check_script|max_length[2]|trim'
            ],
            [
                'field' => 'subdiv_code',
                'label' => 'sub division code',
                'rules' => 'required|callback_check_script|max_length[2]|trim'
            ],
            [
                'field' => 'cir_code',
                'label' => 'circle code',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'mouza_pargona_code',
                'label' => 'mouza pargona code',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'lot_no',
                'label' => 'lot no',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'vill_townprt_code',
                'label' => 'village townport code',
                'rules' => 'required|callback_check_script|max_length[5]|trim',
            ],
            [
                'field' => 'is_urban',
                'label' => 'is urban',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'patta_type',
                'label' => 'patta type',
                'rules' => 'required|callback_check_script|trim|max_length[150]',
            ],
            [
                'field' => 'patta_type_code',
                'label' => 'patta type code',
                'rules' => 'required|callback_check_script|trim|max_length[4]',
            ],
            [
                'field' => 'pdar_id',
                'label' => 'pattadar id',
                'rules' => 'required|callback_check_script|trim|integer',
            ],
            [
                'field' => 'pdar_name',
                'label' => 'pattadar name',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'pdar_father_name',
                'label' => 'pattadar father name',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'patta_no',
                'label' => 'patta no',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'applicant_name_eng',
                'label' => 'applicant name in english',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'applicant_name_asm',
                'label' => 'applicant name in assamese',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_name_eng',
                'label' => 'guardian name in english',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_name_asm',
                'label' => 'guardian name in assamese',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_relation',
                'label' => 'guardian relation',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'date_of_birth',
                'label' => 'date of birth',
                'rules' => 'required|callback_check_script|trim|callback_date_valid',
            ],
            [
                'field' => 'gender',
                'label' => 'gender',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'address',
                'label' => 'address',
                'rules' => 'required|callback_check_script|trim|max_length[200]',
            ],
            [
                'field' => 'mobile_no',
                'label' => 'mobile number',
                'rules' => 'required|callback_check_script|trim|exact_length[10]',
            ],
            [
                'field' => 'aadhaar_pan_ref_no',
                'label' => 'adhaar-pan reference number',
                'rules' => 'required|callback_check_script|trim|max_length[45]',
            ],
            [
                'field' => 'aadhaar_pan_type',
                'label' => 'aadhaar-pan type',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'rtps_doc_id',
                'label' => 'rtps document id',
                'rules' => 'required|callback_check_script|trim',
            ],
            [
                'field' => 'current_revenue',
                'label' => 'current revenue',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'current_local_tax',
                'label' => 'current local tax',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'current_doul_year',
                'label' => 'current doul year',
                'rules' => 'required|callback_check_script|trim|exact_length[4]',
            ],
            [
                'field' => 'mou_report',
                'label' => 'mouzadar report',
                'rules' => 'required|callback_check_script|trim|max_length[200]',
            ],
            [
                'field' => 'openinig_balance',
                'label' => 'Arrear/ Opening balance',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'last_pay_date1',
                'label' => 'Last pay date',
                'rules' => 'required|callback_check_script|trim|callback_date_valid',
            ],
            [
                'field' => 'last_revenue_payment_amount',
                'label' => 'Last Revenue Payment Amount ',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'last_local_tax_payment_amount',
                'label' => 'Last Local Tax Payment Amount ',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'ek_basic_id',
                'label' => 'Ek basic id ',
                'rules' => 'required|callback_check_script|integer|trim',
            ],
            [
                'field' => 'paymentBy',
                'label' => 'payment by ',
                'rules' => 'required|callback_check_script|in_list[self,other]|trim',
            ],
            // [
            //     'field' => 'Ek_objection_rmk',
            //     'label' => 'Objection Remark ',
            //     'rules' => 'required|callback_check_script|trim|max_length[200]',
            // ],
            
        ];
        $this->form_validation->set_rules($validation);
        $this->form_validation->set_message('check_script','Please Fill The %s Correctly!');
        $this->form_validation->set_message('date_valid','Please Fill The %s Correctly!');
        if ($this->form_validation->run() == FALSE)
        {               
            foreach($validation as $rule){
                if (form_error($rule['field'])) {
                array_push($error_msg, form_error($rule['field']));
                }
            }              
        }
        if(count($error_msg) != 0){
            echo json_encode(['result' => 'validation_error', 'msg' => $error_msg]);
            exit;
        }
         //***************chechink-user-designation**********/
	    if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $mouzadarflag = $this->checkIsMouzadar();
        if(!$mouzadarflag['flag']){
            $data['errorMessage'] = $mouzadarflag['result'];
            $data['_view'] = 'e_khajana/mouzadar_error_page';
            $this->load->view('layouts/main',$data);
            return;
        }
        //getting basic details
        $data['ekbasicDetails'] = $ekbasicDetails = $this->EkhajanaMouzadarModel->getEkBasicDetailsFromId($ek_basic_id); 
        if(!$ekbasicDetails){
            echo json_encode("Some Error Occured, Error Code : EKABNA0001");
            exit;
        }
        $data['arrearDetails'] = $ekArrearDetails = $this->EkhajanaMouzadarModel->getEkhajanaArrearDetails($ekbasicDetails);
        $posted_data = $_POST;
        $updateDetails = $this->EkhajanaMouzadarModel->updateBasicDetails($posted_data,$ekbasicDetails,$ekArrearDetails);
        echo json_encode($updateDetails);
    }

    //function to update the data if mouzadar again submit the case as objection even after CO's approval
    public function submitObjectionProceeding(){
        $posted_data = $_POST;
        $error_msg = array();
        $validation = [
            [
                'field' => 'application_no',
                'label' => 'Application no',
                'rules' => 'required|callback_check_script|trim|max_length[45]'
            ],
            [
                'field' => 'ld_application_no',
                'label' => 'land details app. no',
                'rules' => 'required|callback_check_script|trim|max_length[45]'
            ],
            [
                'field' => 'dist_code',
                'label' => 'district code',
                'rules' => 'required|callback_check_script|max_length[2]|trim'
            ],
            [
                'field' => 'subdiv_code',
                'label' => 'sub division code',
                'rules' => 'required|callback_check_script|max_length[2]|trim'
            ],
            [
                'field' => 'cir_code',
                'label' => 'circle code',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'mouza_pargona_code',
                'label' => 'mouza pargona code',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'lot_no',
                'label' => 'lot no',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'vill_townprt_code',
                'label' => 'village townport code',
                'rules' => 'required|callback_check_script|max_length[5]|trim',
            ],
            [
                'field' => 'is_urban',
                'label' => 'is urban',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'patta_type',
                'label' => 'patta type',
                'rules' => 'required|callback_check_script|trim|max_length[150]',
            ],
            [
                'field' => 'patta_type_code',
                'label' => 'patta type code',
                'rules' => 'required|callback_check_script|trim|max_length[4]',
            ],
            [
                'field' => 'pdar_id',
                'label' => 'pattadar id',
                'rules' => 'required|callback_check_script|trim|integer',
            ],
            [
                'field' => 'pdar_name',
                'label' => 'pattadar name',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'pdar_father_name',
                'label' => 'pattadar father name',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'patta_no',
                'label' => 'patta no',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'applicant_name_eng',
                'label' => 'applicant name in english',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'applicant_name_asm',
                'label' => 'applicant name in assamese',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_name_eng',
                'label' => 'guardian name in english',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_name_asm',
                'label' => 'guardian name in assamese',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_relation',
                'label' => 'guardian relation',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'date_of_birth',
                'label' => 'date of birth',
                'rules' => 'required|callback_check_script|trim|callback_date_valid',
            ],
            [
                'field' => 'gender',
                'label' => 'gender',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'address',
                'label' => 'address',
                'rules' => 'required|callback_check_script|trim|max_length[200]',
            ],
            [
                'field' => 'mobile_no',
                'label' => 'mobile number',
                'rules' => 'required|callback_check_script|trim|exact_length[10]',
            ],
            [
                'field' => 'aadhaar_pan_ref_no',
                'label' => 'adhaar-pan reference number',
                'rules' => 'required|callback_check_script|trim|max_length[45]',
            ],
            [
                'field' => 'aadhaar_pan_type',
                'label' => 'aadhaar-pan type',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'current_revenue',
                'label' => 'current revenue',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'current_local_tax',
                'label' => 'current local tax',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'current_doul_year',
                'label' => 'current doul year',
                'rules' => 'required|callback_check_script|trim|exact_length[4]',
            ],
            [
                'field' => 'mou_report',
                'label' => 'mouzadar report',
                'rules' => 'required|callback_check_script|trim|max_length[200]',
            ],
            [
                'field' => 'openinig_balance',
                'label' => 'Arrear/ Opening balance',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'last_pay_date1',
                'label' => 'Last pay date',
                'rules' => 'required|callback_check_script|trim|callback_date_valid',
            ],
            [
                'field' => 'last_revenue_payment_amount',
                'label' => 'Last Revenue Payment Amount ',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'last_local_tax_payment_amount',
                'label' => 'Last Local Tax Payment Amount ',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'ek_basic_id',
                'label' => 'Ek basic id ',
                'rules' => 'required|callback_check_script|integer|trim',
            ],
            [
                'field' => 'paymentBy',
                'label' => 'payment by ',
                'rules' => 'required|callback_check_script|in_list[self,other]|trim',
            ],
            [
                'field' => 'Ek_objection_rmk',
                'label' => 'Objection Remark ',
                'rules' => 'required|callback_check_script|trim|max_length[200]',
            ],
            
        ];
        $this->form_validation->set_rules($validation);
        $this->form_validation->set_message('check_script', 'Invalid characters entered in %s field');
            if ($this->form_validation->run() == FALSE)
            {               
                foreach($validation as $rule){
                    if (form_error($rule['field'])) {
                    array_push($error_msg, form_error($rule['field']));
                    }
                }              
            }
            if(count($error_msg) != 0){
                echo json_encode(['result' => 'validation_error', 'msg' => $error_msg]);
                exit;
            }
        $updateBasicDetails = $this->EkhajanaMouzadarModel->updateBasicDetailsObjection($posted_data);
        echo json_encode($updateBasicDetails);  
    }

    //function for arrear update of the objection records
    public function ObjectionarrearUpdateForm($ek_basic_id){
        //***************chechink-user-designation**********/
	    if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
         }
         $mouzadarflag = $this->checkIsMouzadar();
         if(!$mouzadarflag['flag']){
             $data['errorMessage'] = $mouzadarflag['result'];
             $data['_view'] = 'e_khajana/mouzadar_error_page';
             $this->load->view('layouts/main',$data);
             return;
         }
        
        //getting basic details
        $data['ekbasicDetails'] = $ekbasicDetails = $this->EkhajanaMouzadarModel->getEkBasicDetailsFromId($ek_basic_id); 

        if(!$ekbasicDetails){
            echo json_encode("Some Error Occured, Error Code : EKABNA0001");
            exit;
        }
        
              
        //checking whether jama wasil is already updated or not for this patta 
        $checkJamaWasilStatus = $this->EkhajanaMouzadarModel->checkJamaWasilStatus($ekbasicDetails);  
        if($checkJamaWasilStatus == "jamawasil_updated"){
            $data['_view'] = 'e_khajana/mouz_views/mouzadar_jamawasil_exists_form';
            $this->load->view('layouts/main',$data);
            return;
        }
    
        $data['proceedingDetails'] = $this->EkhajanaMouzadarModel->getProceedingDetails($ekbasicDetails);
        $data['arrearDetails'] = $this->EkhajanaMouzadarModel->getEkhajanaArrearDetails($ekbasicDetails);
        // var_dump($data['arrearDetails']);
        // exit;
        //payee relations
        $data['payee_relations'] = $this->EkhajanaMouzadarModel->getGuardianRelations();    
        $data['_view'] = 'e_khajana/mouz_views/Objection_mouzadar_arrear_update_form';
        $this->load->view('layouts/main',$data);
    }

    //getting the list for re updation cases 
    public function reUpdationList(){
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['circle_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_code = $this->session->userdata('mouza_pargona_code'); 
        $data['reUpdationCasesList'] = $this->EkhajanaMouzadarModel->getReUpdationList($dist_code,$subdiv_code,$cir_code,$mouza_code);

        // echo "<pre>";
        // var_dump($data['reUpdationCasesList']);
        // echo "</pre>";
        // exit;

        $data['_view'] = 'e_khajana/mouz_views/reUpdationCasesList';
        $this->load->view('layouts/main',$data);
    }

    //getting reupdate form 
    public function ekhajanaReUpdateForm(){
        $ld_application_no = $_GET['ld_app_no'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_LAND_DETAILS_FETCH_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                "ld_application_no" => $ld_application_no,
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);        
        if($httpcode == 200){
            //return "curl successfull";
            $response_obj = json_decode($response);
            $this->arrearUpdateForm($response_obj->id);
        }else{
            $this->db->trans_rollback();
            log_message("error", "#EKHUMOBD006, Curl Error(200) In Api ".EKHAJANA_LAND_DETAILS_UPDATE_MOUZADAR_OBJECTION_API);
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUMOBD006'];
        }
    }


    public function MouzadarForwardedCases()
    {
        //**************************************************/
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $data['mouzadarForwardedCases'] = $this->EkhajanaMouzadarModel->MouzadarForwardedCase($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        if($data['mouzadarForwardedCases'] =="NO-DATA-FOUND"){
                echo json_encode("No data Found for this Mouza");
                exit;
        }
        $data['_view'] = 'e_khajana/mouz_views/forwardCasesList';
        $this->load->view('layouts/main',$data);
    }


    public function viewForwardedListDetails($ekbasic_id)
    {
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $data['ek_basic_id'] = $ekbasic_id;
        $data['forwardedCasesDetails'] = $this->EkhajanaMouzadarModel->viewAllForwardedDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ekbasic_id);
        if($data['forwardedCasesDetails']['flag'] == false){
            echo json_encode($data['forwardedCasesDetails']['result']);
            exit;
        }
        $data['_view'] = 'e_khajana/mouz_views/forwardCasesDetails';
        $this->load->view('layouts/main',$data);
    }



    public function CitizenPendingList()
    {
        //**************************************************/
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $data['citizenPendingList'] = $this->EkhajanaMouzadarModel->getCitizenPendingList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        $data['_view'] = 'e_khajana/mouz_views/citizenPendingList';
        $this->load->view('layouts/main',$data);
    }

    public function viewCitizenPendingCaseDetails($ekhajana_land_details_id){
      
        //****************************************************************/
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $ekhajana_land_details_query = $this->db->query("select ld_application_no from ekhajana_land_details where id=?", 
        array($ekhajana_land_details_id));
        if($ekhajana_land_details_query != 1){
            echo json_encode("Some error occured in fetching case details. Please contact administrator. Err-code: #ERREKLDIDNF001");
            exit;
        }
        $ekhajana_land_details_row = $ekhajana_land_details_query->row(); 
        $this->dbswitch();
        $ekhajana_basic_query = $this->db->query("select id from ekhajana_basic where ld_application_no=?", 
        array($ekhajana_land_details_row->ld_application_no));
        if($ekhajana_basic_query->num_rows()!= 1){
            echo json_encode("Some error occured in fetching case details. Please contact administrator. Err-code: #ERREKLDIDNF002");
            exit;
        }
        $ekbasic_id = $ekhajana_basic_query->row()->id;
        //****************************************************************/

        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $data['ek_basic_id'] = $ekbasic_id;
        //using the same methods as forwarded list as the details will be similar
        $data['forwardedCasesDetails'] = $this->EkhajanaMouzadarModel->viewAllForwardedDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ekbasic_id);
        if($data['forwardedCasesDetails']['flag'] == false){
            echo json_encode($data['forwardedCasesDetails']['result']);
            exit;
        }
        $data['_view'] = 'e_khajana/mouz_views/citizenPendingCaseDetails';
        $this->load->view('layouts/main',$data);
    }

    ///PASSWORD RESET MOUZADAR STARTS
    public function resetPassword()
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $data['district'] = $this->db->query("select district_name,district_code from district_details where online='0'")->result();
        $data['_view'] = 'e_khajana/passwordResetForm';
        $this->load->view('layouts/main', $data);
    }
    public function getSubdivNames()
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $params = json_decode(file_get_contents("php://input"));
        $dist_code = $params->dist_code;
        $query = $this->db->query("select dist_code,subdiv_code,cir_code,loc_name,locname_eng from location where dist_code=? and subdiv_code!=? and cir_code=?",array($dist_code,'00','00'));
        echo json_encode($query->result());
    }
    public function getCirNames()
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $params = json_decode(file_get_contents("php://input"));
        $dist_code = $params->dist_code;
        $subdiv_code = $params->subdiv_code;
        $query = $this->db->query("select dist_code,subdiv_code,cir_code,mouza_pargona_code,loc_name,locname_eng from location where dist_code=? and subdiv_code=? and cir_code!=? and mouza_pargona_code=?",array($dist_code,$subdiv_code,'00','00'));
        echo json_encode($query->result());
    }
    public function getMouzaNames()
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $params = json_decode(file_get_contents("php://input"));
        $dist_code = $params->dist_code;
        $subdiv_code = $params->subdiv_code;
        $cir_code = $params->cir_code;
        $query = $this->db->query("select mouza_pargona_code,loc_name,locname_eng from location where dist_code=? and  subdiv_code=? and cir_code=? and mouza_pargona_code!=? and lot_no=?",array($dist_code,$subdiv_code,$cir_code,'00','00'));
        echo json_encode($query->result());
    }
    public function fetchUserDetails()
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('db2', TRUE);
        $dist_code      = $_POST['district_code'];
        $subdiv_code    = $_POST['subdiv_list'];
        $cir_code       = $_POST['circle_list'];
        $mouza_pargona_code =$_POST['mouza_list'];
        $data['user_details'] = $this->db->query("select du.unique_user_id as unique_uid, * from depart_users du join user_dist_byforcation udb on
                du.id::int=udb.unique_user_id::int where udb.dist_code=? and udb.subdiv_code=? and udb.cir_code=? and udb.mouza_pargona_code=? and du.active_deactive=? and du.status=?",
                array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,'E','E'))->row();
        $data['_view'] = 'e_khajana/resetPassword';
        $this->load->view('layouts/main', $data);
    }
    public function updatePassword()
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('db2', TRUE);
        $dist_code          = $_POST['dist_code'];
        $subdiv_code        = $_POST['subdiv_code'];
        $cir_code           = $_POST['cir_code'];
        $mouza_pargona_code = $_POST['mouza_pargona_code'];
        $id                 = $_POST['id'];
        $user_name          = $_POST['unique_user_name'];
        $password           = '5f993f9a478b9f5cb006f20d48e2325c84708b0d6b15d8501d44b47cc386e113f3a5d6566b196102052bb68b87f4b2538f233cedb8d13ab38aceae0b726c485f';
        $this->db->trans_begin();
        $updatePass = array(
            "password"                  => $password,
            "first_login"               => 0,
        );
        $this->db->where('unique_user_id', $user_name)
                ->where('id', $id)
                ->update('depart_users', $updatePass);
        if($this->db->affected_rows() != 1){
            $this->db->trans_rollback();
            log_message("error", "#EKRESET87, Error in reseting password on depart_users details table with query- ". json_encode($this->db->last_query()));
            echo json_encode(['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKRESET87']);
        }
        else{
            $this->db->trans_commit();
            echo json_encode(['result' => 'SUCCESS', 'msg' => 'DATA UPDATED SUCCESSFULLY...!!!']);
        }
    }
    ///PASSWORD RESET MOUZADAR ENDS


    public function RejectedApplicationList()
    {
        //**************************************************/
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $rejectedList = $this->EkhajanaMouzadarModel->getRejectedList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        $data['rejectedList'] = $rejectedList['result'];
        $data['_view'] = 'e_khajana/mouz_views/rejectedApplicationList';
        $this->load->view('layouts/main',$data);
    }
    public function viewRejectedListDetails($ekbasic_id)
    {
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $data['ek_basic_id'] = $ekbasic_id;
        $data['RejectedCasesDetails'] = $this->EkhajanaMouzadarModel->viewAllRejectedDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ekbasic_id);
        if($data['RejectedCasesDetails']['flag'] == false){
            echo json_encode($data['RejectedCasesDetails']['result']);
            exit;
        }
        $data['_view'] = 'e_khajana/mouz_views/RejectedCasesDetails';
        $this->load->view('layouts/main',$data);
    }

    public function objectionApplicationList()
    {
        //**************************************************/
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $objectionList = $this->EkhajanaMouzadarModel->getObjectionList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        $data['objectionList'] = $objectionList['result'];
        $data['_view'] = 'e_khajana/mouz_views/objectionApplicationList';
        $this->load->view('layouts/main',$data);
    }
    public function viewObjectionListDetails($ekbasic_id)
    {
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $data['ek_basic_id'] = $ekbasic_id;
        $data['objectionCasesDetails'] = $this->EkhajanaMouzadarModel->viewAllObjectionDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ekbasic_id);
        if($data['objectionCasesDetails']['flag'] == false){
            echo json_encode($data['objectionCasesDetails']['result']);
            exit;
        }
        $data['_view'] = 'e_khajana/mouz_views/objectionCasesDetails';
        $this->load->view('layouts/main',$data);
    }


    public function revertedByCoApplicationList()
    {
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $coRevertedList = $this->EkhajanaMouzadarModel->getCoRevertedToMouzadarList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        $data['coRevertedList'] = $coRevertedList['result'];
        $data['_view'] = 'e_khajana/mouz_views/coRevertedToMouzadarList';
        $this->load->view('layouts/main',$data);
    }
    public function viewRevertedByCoCaseDetails($ek_basic_id)
    {
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $data['ek_basic_id'] = $ek_basic_id;
        $revertedCasesDetails = $this->EkhajanaMouzadarModel->viewAllRevertedDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$ek_basic_id);
        if($revertedCasesDetails['flag'] == false){
            echo json_encode($revertedCasesDetails['result']);
            exit;
        }
        $data['revertedCasesDetails'] = $revertedCasesDetails['result'];
        $rtps_application_no = $revertedCasesDetails['result']->application_no;
        //for getting aadaar photo///////////////////////////
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, EKHAJANA_AADHAAR_PHOTO_FETCH);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'application_no'             => $rtps_application_no,
        )));
        $get_aadhaar_photo = curl_exec($curl_handle);
        curl_close($curl_handle);
        if ($get_aadhaar_photo != 'n') {
            $data['aadhaar_b64_decoded'] = "<img src = data:".$this->imageDecodeBase64($get_aadhaar_photo).";base64,".$get_aadhaar_photo." class='img-thumbnail' alt='Adhar Photo' width='170' height='200'>";
        }
        $currentDoulDemand = $this->EkhajanaMouzadarModel->getCurrentRevenueAndLocalTaxFromDoul($revertedCasesDetails['result']);
        if(!$currentDoulDemand['flag']){
            echo json_encode("Current Doul Demand Not Found For This Patta..!!");
            exit;
        }
        $data['current_revenue'] = $currentDoulDemand['result']->dag_revenue;
        $data['current_local_tax'] = $currentDoulDemand['result']->dag_local_tax;
        $data['current_doul_year'] = $currentDoulDemand['result']->year_no;
        $data['total_arrear'] = $total_arrear =  $this->EkhajanaMouzadarModel->getTotalArrear($revertedCasesDetails['result']);
        $data['_view'] = 'e_khajana/mouz_views/revertedByCoToMouzadarCaseDetails';
        $this->load->view('layouts/main',$data);
    }
    public function mouzadarForwardRevertedCase()
    {
        $error_msg = array();
        $validation = [
            [
                'field' => 'application_no',
                'label' => 'Application no',
                'rules' => 'required|callback_check_script|trim|max_length[45]'
            ],
            [
                'field' => 'ld_application_no',
                'label' => 'land details app. no',
                'rules' => 'required|callback_check_script|trim|max_length[45]'
            ],
            [
                'field' => 'dist_code',
                'label' => 'district code',
                'rules' => 'required|callback_check_script|max_length[2]|trim'
            ],
            [
                'field' => 'subdiv_code',
                'label' => 'sub division code',
                'rules' => 'required|callback_check_script|max_length[2]|trim'
            ],
            [
                'field' => 'cir_code',
                'label' => 'circle code',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'mouza_pargona_code',
                'label' => 'mouza pargona code',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'lot_no',
                'label' => 'lot no',
                'rules' => 'required|callback_check_script|max_length[5]|trim',
            ],
            [
                'field' => 'vill_townprt_code',
                'label' => 'village townport code',
                'rules' => 'required|callback_check_script|max_length[5]|trim',
            ],
            [
                'field' => 'is_urban',
                'label' => 'is urban',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'patta_type',
                'label' => 'patta type',
                'rules' => 'required|callback_check_script|trim|max_length[150]',
            ],
            [
                'field' => 'patta_type_code',
                'label' => 'patta type code',
                'rules' => 'required|callback_check_script|trim|max_length[4]',
            ],
            [
                'field' => 'pdar_id',
                'label' => 'pattadar id',
                'rules' => 'required|callback_check_script|trim|integer',
            ],
            [
                'field' => 'pdar_name',
                'label' => 'pattadar name',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'pdar_father_name',
                'label' => 'pattadar father name',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'patta_no',
                'label' => 'patta no',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'applicant_name_eng',
                'label' => 'applicant name in english',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'applicant_name_asm',
                'label' => 'applicant name in assamese',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_name_eng',
                'label' => 'guardian name in english',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_name_asm',
                'label' => 'guardian name in assamese',
                'rules' => 'required|callback_check_script|trim|max_length[100]',
            ],
            [
                'field' => 'guardian_relation',
                'label' => 'guardian relation',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'date_of_birth',
                'label' => 'date of birth',
                'rules' => 'required|callback_check_script|trim|callback_date_valid',
            ],
            [
                'field' => 'gender',
                'label' => 'gender',
                'rules' => 'required|callback_check_script|trim|exact_length[1]',
            ],
            [
                'field' => 'address',
                'label' => 'address',
                'rules' => 'required|callback_check_script|trim|max_length[200]',
            ],
            [
                'field' => 'mobile_no',
                'label' => 'mobile number',
                'rules' => 'required|callback_check_script|trim|exact_length[10]',
            ],
            [
                'field' => 'aadhaar_pan_ref_no',
                'label' => 'adhaar-pan reference number',
                'rules' => 'required|callback_check_script|max_length[45]',
            ],
            [
                'field' => 'aadhaar_pan_type',
                'label' => 'aadhaar-pan type',
                'rules' => 'required|callback_check_script|max_length[20]',
            ],
            [
                'field' => 'current_revenue',
                'label' => 'current revenue',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'current_local_tax',
                'label' => 'current local tax',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
            [
                'field' => 'mou_report',
                'label' => 'mouzadar report',
                'rules' => 'required|callback_check_script|trim|max_length[200]',
            ],
            [
                'field' => 'openinig_balance',
                'label' => 'Arrear/ Opening balance',
                'rules' => 'required|callback_check_script|numeric|trim',
            ],
        ];
        $this->form_validation->set_rules($validation);
        if ($this->form_validation->run() == FALSE)
        {
            foreach($validation as $rule){
                if (form_error($rule['field'])) {
                array_push($error_msg, form_error($rule['field']));
                }
            }
        }
        if(count($error_msg) != 0){
            echo json_encode(['result' => 'validation_error', 'msg' => $error_msg]);
            exit;
        }
        $posted_details = $_POST;
        $updateRevertFlag = $this->EkhajanaMouzadarModel->updateAfterMouzadarForwardRevertCase($posted_details);
        echo json_encode($updateRevertFlag);
    }


}
?>
