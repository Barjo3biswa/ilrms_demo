<?php

class EkhajanaArrearController extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ekhajana/EkhajanaArrearModel');
        $this->dbswitch($this->session->userdata('dist_code'));
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
        }   else if($this->session->userdata('dist_code') == "39"){                                              $this->db=$CI->load->database('bajali', TRUE);                                                         }                                                                                                                                                                                                           
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
        $data['_view'] = 'e_khajana/arrear_views/index'; 
        $this->load->view('layouts/main',$data);
    }

    //arrear update form 
    public function preArrearUpdateForm()
    {

        
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_code'] = $mouza_code = $this->session->userdata('mouza_pargona_code');
        $data['dist_name'] = $dist_name = $this->utilclass->getDistrictName($dist_code);
        $data['subdiv_name'] = $subdiv_name = $this->utilclass->getSubDivName($dist_code, $subdiv_code);
        $data['cir_name'] = $cir_name = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
        $data['mouza_name'] = $mouza_name = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_code);
        $data['patta'] = $this->EkhajanaArrearModel->getPattaType($dist_code);
        $data['lot_list'] = $this->EkhajanaArrearModel->getLotNoJson($dist_code, $subdiv_code, $cir_code, $mouza_code);
        $data['village_list'] = $this->EkhajanaArrearModel->getVillageList($dist_code,$subdiv_code,$cir_code,$mouza_code);
        // var_dump($data['village_list']);
        // exit;
        $data['_view'] = 'e_khajana/arrear_views/preArrearUpdateFrom';
        $this->load->view('layouts/main',$data);
    }

    //getting-patta-types
    public function getPattaTypes(){
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        //$village_uuid = $_POST['vill_uuid'];
        $patta_types = $this->EkhajanaArrearModel->getPattaType();
        echo json_encode($patta_types);
    }

    //getting patta numbers 
    public function getPataNumbers(){
        $this->dbswitch();
        $village_uuid = $_POST['vill_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $dist_code = $_POST['dist_code'];
        $subdiv_code = $_POST['subdiv_code'];
        $cir_code = $_POST['cir_code'];
        $mouza_pargona_code = $_POST['mouza_pargona_code'];
       
        $sqlPattaNos = "select distinct (patta_no) from chitha_basic where dist_code=? and subdiv_code= ? and cir_code =? and mouza_pargona_code=? and patta_type_code =? order by patta_no asc";
        $query = $this->db->query($sqlPattaNos, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$patta_type_code));
        $patta_list = $query->result(); 
        echo json_encode($patta_list);
    }

    public function submitArrear()
    {     
        // var_dump($_POST);
	// exit; 
        //if($this->session->userdata('unique_user_id') == 'aditya01'){
            //echo "<pre>";
            //var_dump($_POST);
            //exit;
        //}
        $exploded_data = (explode("|",$_POST['location']));
        $village_uuid = $exploded_data[0];
        $vill_townprt_code = $exploded_data[1];
	$lot_no = $exploded_data[2];

        $mb2_flag = $this->EkhajanaArrearModel->checkPattaUnderMb2($_POST['dist_code'], $_POST['subdiv_code'],
                        $_POST['cir_code'], $_POST['mouza_pargona_code'], $lot_no, $vill_townprt_code, 
                        $_POST['patta_type_code'], $_POST['patta_no']);
        if($mb2_flag == "MB2_PATTA"){
            echo json_encode(['result' => 'INPUT-ERROR', 'msg' => "Patta Is Found To Be Generated Under Mission Basundhara 2.0 Service Hence Arrear Of The Patta Cannot Be Updated."]);
            exit;
        }

        $error_msg = array();
        $validation = [
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
                'field' => 'location',
                'label' => 'location',
                'rules' => 'required|callback_check_script|trim',
            ],
            [
                'field' => 'patta_type_code',
                'label' => 'patta type code',
                'rules' => 'required|callback_check_script|trim|max_length[4]',
            ],
            [
                'field' => 'patta_no',
                'label' => 'patta no',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'total_arrear',
                'label' => 'Arrear',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'total_revenue',
                'label' => 'Revenue',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'total_tax',
                'label' => 'Tax',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'arrear[]',
                'label' => 'Arrear For A Particular Year',
                'rules' => 'callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'tax[]',
                'label' => 'Tax For A Particular Year',
                'rules' => 'callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'revenue[]',
                'label' => 'Revenue For A Particular Year',
                'rules' => 'callback_check_script|trim|max_length[20]',
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
        $posted_data = $_POST;
        $years = $_POST['years'];
        $arear = $_POST['arrear'];
        $tax = $_POST['tax'];
        $revenue = $_POST['revenue'];
        $data = [];
        foreach($arear as $key=>$arrearvalue) 
        {                 
            $data[$key]['year'] = $years[$key];
            $data[$key]['revenue'] = $revenue[$key];
            $data[$key]['tax'] = $tax[$key];
            $data[$key]['arear'] = $arrearvalue;
        }

        foreach($data as $arr_row){            

            if($arr_row['revenue'] != '' || $arr_row['tax'] != '' || $arr_row['revenue'] != null || $arr_row['tax'] != null){
                if($arr_row['year'] == '' || $arr_row['year'] == null || $arr_row['revenue'] == '' || $arr_row['revenue'] == null
                || $arr_row['tax'] == '' || $arr_row['tax'] == null || $arr_row['arear'] == '' || $arr_row['arear'] == null){
                    echo json_encode(['result' => 'INPUT-ERROR', 'msg' => 'Some fields missing for the year '.$arr_row['year']. ', kindly insert properly..!!']);
                    exit;
                } 
            }
                       
        }
        $ekArrearPreUpdateFlag = $this->EkhajanaArrearModel->insertPreArrearData($posted_data,$data,$vill_townprt_code,$lot_no,$village_uuid);
        echo json_encode($ekArrearPreUpdateFlag);
    }

    public function viewUpdatedArrear(){
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_code'] = $mouza_code = $this->session->userdata('mouza_pargona_code');
        $data['arrear_list'] = $this->EkhajanaArrearModel->getUpdatedArrears($dist_code,$subdiv_code,$cir_code,$mouza_code);
        $data['_view'] = 'e_khajana/arrear_views/arrear_updated_list';
        $this->load->view('layouts/main',$data);
    }

    public function submitEditedArrear()
    {
       
        $error_msg = array();
        $validation = [
            [
                'field' => 'pre_arrear_id',
                'label' => 'pre_arrear_id',
                'rules' => 'required|callback_check_script|trim'
            ],
            [
                'field' => 'year_revenue[]',
                'label' => 'Revenue of particular year',
                'rules' => 'required|callback_check_script|trim'
            ],
            [
                'field' => 'year_tax[]',
                'label' => 'Local tax of particular year',
                'rules' => 'required|callback_check_script|trim',
            ],
            [
                'field' => 'year_arrear[]',
                'label' => 'Arrear of particular year',
                'rules' => 'required|callback_check_script|trim',
            ],
            [
                'field' => 'total_revenue',
                'label' => 'Total revenue',
                'rules' => 'required|callback_check_script|trim',
            ],
            [
                'field' => 'total_tax',
                'label' => 'Total tax',
                'rules' => 'required|callback_check_script|trim',
            ],
            [
                'field' => 'total_arrear',
                'label' => 'Total Arrear',
                'rules' => 'required|callback_check_script|trim',
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
        $posted_data = $_POST;
	$pre_arrear_id = $_POST['pre_arrear_id'];

        $pre_arrear_updation_row = $this->db->query("select * from ekhajana_arrear_pre_updation where id=? ",array($pre_arrear_id))->row();
        $dist_code = $pre_arrear_updation_row->dist_code;
        $subdiv_code = $pre_arrear_updation_row->subdiv_code;
        $cir_code = $pre_arrear_updation_row->cir_code;
        $mouza_pargona_code = $pre_arrear_updation_row->mouza_pargona_code;
        $lot_no = $pre_arrear_updation_row->lot_no;
        $vill_townprt_code = $pre_arrear_updation_row->vill_townprt_code;
        $patta_type_code = $pre_arrear_updation_row->patta_type_code;
        $patta_no = $pre_arrear_updation_row->patta_no;
	
	
	$checkEcfrGenerated = $this->EkhajanaArrearModel->checkEcfrGenerated($dist_code,$subdiv_code, $cir_code, $mouza_pargona_code, $lot_no,
                                                            $vill_townprt_code,$patta_type_code,$patta_no);
        if($checkEcfrGenerated =="Generated" || $checkEcfrGenerated =="Could-Not-Fetch-Data")
        {
            echo json_encode(['result' => 'validation_error', 'msg' => "Could Not Edit Data Since E-Cfr Has been generated for this patta...!!!"]);
            exit;
        }
        


        $checkEkBasicStatus = $this->EkhajanaArrearModel->checkBasicStatus($dist_code,$subdiv_code, $cir_code, $mouza_pargona_code, $lot_no,
                            $vill_townprt_code,$patta_type_code,$patta_no);
        if($checkEkBasicStatus =="Disposed")
        {
            echo json_encode(['result' => 'validation_error', 'msg' => "Could Not Edit Data Since Patta Has been Disposed From Circle Office...!!!"]);
            exit;
        }


        $total_revenue = $_POST['total_revenue'];
        $total_tax = $_POST['total_tax'];
        $total_arrear = $_POST['total_arrear'];
        $year_revenue = $_POST['year_revenue'];
        $year_tax = $_POST['year_tax'];
        $year_arrear = $_POST['year_arrear'];
        $update_array = array();

        $previous_arrears = array();
        $years_arr = array();
        $revenue_arr = array();
        $tax_arr = array();
        $arrear_arr = array();

        $total_revenue_db = 0;
        $total_tax_db = 0;
        $total_arrear_db = 0;

        foreach($year_revenue as $year=>$revenue) 
        {         
            //validations 
            if($revenue + $year_tax[$year] != $year_arrear[$year])
            { 

                echo json_encode(['result' => 'validation_error', 'msg' => ["Sum of Revenue and local tax is not matching with total arrear value"]]);
                exit;  
            }
            //revenue and local tx addition should be same as the key value arrear          
            array_push($update_array, [
                "financial_year"    => $year,
                "revenue"           => $revenue,
                "tax"               => $year_tax[$year],
                "arrear"            => $year_arrear[$year],
                "pre_arrear_id"     => $pre_arrear_id,
                "total_tax"         => $total_tax, 
                "total_revenue"     => $total_revenue, 
                "total_arrear"      => $total_arrear
            ]);
            //creating the previous arrear fileds arrays 
            array_push($years_arr, $year);
            array_push($revenue_arr,$revenue);
            array_push($tax_arr, $year_tax[$year]);
            array_push($arrear_arr, $year_arrear[$year]);
            //for logical validation of the arrears, tax and revenue with total 
            $total_revenue_db = $total_revenue_db+$revenue;
            $total_tax_db = $total_tax_db+$year_tax[$year];
            $total_arrear_db = $total_arrear_db+$year_arrear[$year];  
        }
        //testing 
        //echo "db-".$total_revenue_db. "post-". $total_revenue; exit;
        // Checking revenue total if mismatching
        if($total_revenue_db != $total_revenue){
            echo json_encode(['result' => 'validation_error', 'msg' => ["Mismatch In Total Revenue, Kindly re-enter"]]);
            exit;  
        }
        // Checking local tax total if mismatching
        if($total_tax_db != $total_tax){
            echo json_encode(['result' => 'validation_error', 'msg' => ["Mismatch In Total Local tax, Kindly re-enter"]]);
            exit;  
        }
        // Checking arrear total if mismatching
        if($total_arrear_db != $total_arrear){
            echo json_encode(['result' => 'validation_error', 'msg' => ["Mismatch In Total Arrear, Kindly re-enter"]]);
            exit;  
        }


        //creating the previous arrear 
        $previous_arrears['years'] = $years_arr;
        $previous_arrears['revenue'] = $revenue_arr;
        $previous_arrears['tax'] = $tax_arr;
        $previous_arrears['arrear'] = $arrear_arr;
        $previous_arrears['total_revenue'] = $total_revenue;
        $previous_arrears['total_tax'] = $total_tax;
        $previous_arrears['total_arrear'] = $total_arrear;

        $this->db->trans_begin();
        $insertTransactions = $this->EkhajanaArrearModel->insertArrearTransactiondata($pre_arrear_id);
        if($insertTransactions['result'] =="SERVER-ERROR"){
            echo json_encode($insertTransactions);
            exit;
        }
        $updatePreArrearUpdation =$this->EkhajanaArrearModel->updatePreArrearUpdation($pre_arrear_id,$update_array,$previous_arrears);
        if($updatePreArrearUpdation['result'] =="SERVER-ERROR"){
            echo json_encode($updatePreArrearUpdation);
            exit;
        }else{
            $this->db->trans_commit();
            echo json_encode($updatePreArrearUpdation);
        }
    }

    public function viewUpdatedArrearLocal($dist_code,$subdiv_code,$cir_code,$mouza_code,
	    $lot_no,$vill_townprt_code,$patta_type_code,$patta_no){


	//echo "hi";exit;
        $data['dist_code'] = $dist_code;
        $data['subdiv_code'] = $subdiv_code;
        $data['cir_code'] = $cir_code;
        $data['mouza_code'] = $mouza_code;
        $data['arrear_list'] = $this->EkhajanaArrearModel->getUpdatedArrearsLocal($dist_code,$subdiv_code,$cir_code,$mouza_code,
                                                                            $lot_no,$vill_townprt_code,$patta_type_code,$patta_no);
        $data['_view'] = 'e_khajana/arrear_views/arrear_updated_list';
        $this->load->view('layouts/main',$data);
    }


    public function viewUpdatedArrearPattaWise()
    {
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_code'] = $mouza_code = $this->session->userdata('mouza_pargona_code');
        $data['villages'] = $this->db->query("select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,loc_name from location where dist_code=?
        and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no!=? and vill_townprt_code!=?",array($dist_code,$subdiv_code,$cir_code,$mouza_code,'00','00000'))->result();
        $data['patta_types'] = $this->db->query("select * from patta_code where ekhajana='y'")->result();
        $data['patta_numbers'] = $this->db->query("select distinct(patta_no) from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? order by patta_no asc",array($dist_code,$subdiv_code,$cir_code,$mouza_code))->result();
        $data['_view'] = 'e_khajana/arrear_views/patta_wise_arrear_update_form';
        $this->load->view('layouts/main', $data);
    }
    public function fetchPattaWiseArrear()
    {
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $data['dist_code']  = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code']= $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code']   = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_code'] = $mouza_code = $this->session->userdata('mouza_pargona_code');
        $exploded_data      = (explode("_",$_POST['village_location']));
        $lot_no             = $exploded_data['0'];
        $vill_townprt_code  = $exploded_data['1'];
        $patta_type_code    = $_POST['patta_type'];
        $data['patta_no']   = $patta_no  = $_POST['patta_no'];
        $data['arrear_list'] = $this->EkhajanaArrearModel->getUpdatedArrearsLocal($dist_code,$subdiv_code,$cir_code,$mouza_code,
                                                                            $lot_no,$vill_townprt_code,$patta_type_code,$patta_no);
        if($data['arrear_list'] == [] || $data['arrear_list'] == null)
        {
            $data['_view'] = 'e_khajana/arrear_views/arrear_updated_list_not_found';
            $this->load->view('layouts/main',$data);
        }else{
            $data['_view'] = 'e_khajana/arrear_views/arrear_updated_list';
            $this->load->view('layouts/main',$data);
        }
    }

}
?>
