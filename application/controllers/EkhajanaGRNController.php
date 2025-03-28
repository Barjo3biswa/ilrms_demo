<?php

class EkhajanaGRNController extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ekhajana/EkhajanaArrearModel');
        $this->dbswitch();
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

    function grnDetailsMouzaWise(){
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
        $data['_view'] = 'e_khajana/grn_details/grn_details_mouza_wise';
        $this->load->view('layouts/main',$data);
    }


    function downloadExcelReport($filename, $result_array)
    {
        require_once 'application/libraries/Xlsxwriter.class.php';        
        ini_set('display_errors', 1);
        ini_set('log_errors', 1);
        $head_array = array_keys($result_array[0]);
        foreach($head_array as $head)
        {
            $final_head[$head]='string';
        }
        $styles1 = array( 'font'=>'Arial','font-size'=>14,'font-style'=>'bold', 'fill'=>'#FFFF00',
                          'halign'=>'center', 'border'=>'left,right,top,bottom');
        $styles7 = array( 'border'=>'left,right,top,bottom');
        
        header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        ob_clean();
        $writer = new XLSXWriter();
        $writer->setAuthor('Dharitree'); 
        $writer->writeSheetHeader('Sheet1', $final_head,$styles1);
        foreach($result_array as $row)
            $writer->writeSheetRow('Sheet1', $row,$styles7);        
        $writer->writeToStdOut();        
        exit(0);
    }

    function downloadGrnDetailsForMouza(){        
        $CI = &get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $data['mouza_name'] = $this->utilclass->getMouzaNameEng($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);
        $clean_mouza_name = preg_replace('/[^\p{L}\p{N}]/u', '', $data['mouza_name']);
        $grn_details = $this->db->query("select distinct grn_no from ekhajana_mouzadari_area_report_doat emrd join 
                    ekhajana_egras_log elg on emrd.application_no=elg.application_no
                    where emrd.dist_code=? and emrd.subdiv_code=? and emrd.cir_code=? and emrd.mouza_pargona_code=? 
                    and emrd.egras_status=? and date(emrd.created_at) BETWEEN ? and ?",
                    array(strval($dist_code),strval($subdiv_code),strval($cir_code),
                    strval($mouza_pargona_code),'Y',$_POST['start_date'],$_POST['to_date']))->result_array();
        // echo "<pre>";
        // var_dump($grn_details);
        $this->downloadExcelReport("grn_list_for_".$clean_mouza_name."_mouza_from_".$_POST['start_date']."_to_".$_POST['to_date'].".xlsx",$grn_details);
    }
}
?>
