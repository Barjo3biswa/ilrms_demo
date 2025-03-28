<?php

class EkhajanaAmdaniController extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ekhajana/EkhajanaArrearModel');
        $this->dbswitch($this->session->userdata('dist_code'));
        $this->load->model('ekhajana/EkhajanaAmdaniModel');
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
                $village_codes = $this->convertLiteralEkhajana($village_codes_arr); 
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

    //index method 
    public function index(){
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
        $data['_view'] = 'e_khajana/amdani_views/amdaniReportForm';
        $this->load->view('layouts/main',$data);
    }

    //amdani report form validation check
    public function amdaniReportFormValidation(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('start_date', 'Start Date Selection', 'trim|required');
        $this->form_validation->set_rules('to_date', 'End Date Selection', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('', '');
            $validation = [];
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
    
    public function amdaniReport(){
        //echo json_encode($_POST);exit;
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $data['from_date'] = $from_date = $_POST['start_date'];
        $data['to_date'] = $to_date = $_POST['to_date'];
        //$data['reportData'] = $amdaniRptData = $this->EkhajanaAmdaniModel->getAmdaniRptData($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$from_date,$to_date);
        // echo "<pre>";
        // var_dump($amdaniRptData);
	// exit;
	$amdaniRptData = $this->EkhajanaAmdaniModel->getAmdaniRptData($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$from_date,$to_date);
        // echo "<pre>";
        // var_dump($amdaniRptData);
        // exit;
        $data['reportData'] = $amdaniRptData['amdani_rpt_arr'];
        $data['total_khajana'] = $amdaniRptData['total_khajana'];
        $data['_view'] = 'e_khajana/amdani_views/amdaniReport';
        $this->load->view('layouts/main',$data);
    }
}
?>
