<?php

class EkhajanaMouzadarChangeRequestController extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ekhajana/EkhajanaMouzadarChangeRequestModel');
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
        } else if($this->session->userdata('dist_code') == "39"){
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
                $village_codes = $this->convertLiteral($village_codes_arr); 
                $sql = "Select uuid from location where dist_code ='$dist_code' and subdiv_code ='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code ='$mouza_pargona_code'
                and lot_no!='00' and vill_townprt_code!='00000' and uuid in ($village_codes)";
                $query = $this->db->query($sql);
                echo $this->db->last_query(); 
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
        $data['_view'] = 'e_khajana/change_request/index'; 
        $this->load->view('layouts/main',$data);
    }

    //class change method 
    public function classChange(){
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
        $data['village_list'] = $this->EkhajanaMouzadarChangeRequestModel->getVillageList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);

        $data['land_class'] = $this->EkhajanaMouzadarChangeRequestModel->getLandClass();

        $data['_view'] = 'e_khajana/change_request/land_class_change'; 
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
        $patta_types = $this->EkhajanaMouzadarChangeRequestModel->getPattaType();
        echo json_encode($patta_types);
    }

    //getting patta numbers 
    public function getPattaNumbers()
    {
        $this->dbswitch();
       // var_dump($this->session->all_userdata());exit;
        $village_uuid = $_POST['village_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
       
        //$sqlPattaNos = "select distinct (patta_no) from chitha_basic where dist_code=? and subdiv_code= ? and cir_code =? and mouza_pargona_code=? and patta_type_code =?";

        $sqlPattaNos = "select distinct (patta_no) from current_doul_demand where dist_code=? and subdiv_code= ? and cir_code =? and mouza_pargona_code=? and patta_type_code =? and uuid =?";

        $query = $this->db->query($sqlPattaNos, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$patta_type_code,$village_uuid));
        $patta_list = $query->result(); 
        //echo $this->db->last_query();
        echo json_encode($patta_list);
    }


     public function getDags()
    {
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $village_uuid = $_POST['village_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $patta_no = $_POST['patta_no'];

        $dag_nos = $this->EkhajanaMouzadarChangeRequestModel->getDagNumbers($village_uuid,$patta_type_code,$patta_no);
       // var_dump($dag_nos);exit;
        echo json_encode($dag_nos);
    }

     public function getDetailsofDags()
    {
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $village_uuid = $_POST['village_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $patta_no = $_POST['patta_no'];
        $dag_no = $_POST['dag_no'];
        $option = $_POST['selectrequest'];
        //var_dump($village_uuid);exit;

        if($option == 'option1')
        {
            $landclass = $this->EkhajanaMouzadarChangeRequestModel->getDagLandClass($village_uuid,$patta_type_code,$patta_no,$dag_no);
            echo json_encode($landclass);
        }

        else if($option == 'option2')
        {
            $pattadars = $this->EkhajanaMouzadarChangeRequestModel->getPattadarsofDag($village_uuid,$patta_type_code,$patta_no,$dag_no);
            foreach ($pattadars as $pattadar) 
            {
                $data['pattadar'][] = $pattadar;
            }
            echo json_encode($data['pattadar']);
        }
    }

    public function getLandclass()
    {
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $village_uuid = $_POST['village_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $patta_no = $_POST['patta_no'];
        $dag_no = $_POST['dag_no'];
        
        //var_dump($village_uuid);exit;

        $landclass = $this->EkhajanaMouzadarChangeRequestModel->getDagLandClass($village_uuid,$patta_type_code,$patta_no,$dag_no);
        echo json_encode($landclass);
    }


    public function landclassPost()
    {
        $village_uuid = $_POST['village_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $patta_no = $_POST['patta_no'];
        $dag_no = $_POST['dag_nos'];
        $class_code = $_POST['class_code'];
        $suggested_land_class = $_POST['suggested_land_class'];
        $remark = $_POST['remark'];

        $user_code = $this->session->userdata('designation');
        $name = $this->session->userdata('name');
        $unique_user_id = $this->session->userdata('unique_user_id');
        // var_dump($this->session->all_userdata());exit;

        $this->db->trans_begin();
        $insertLandclassChange = $this->EkhajanaMouzadarChangeRequestModel->insertLandclassChange($village_uuid,$patta_type_code,$patta_no,$dag_no,$class_code,$suggested_land_class,$remark,$user_code,$name,$unique_user_id);

        if($insertLandclassChange['result'] =="SERVER-ERROR"){
            echo json_encode($insertLandclassChange);
            exit;
        }else{
            $this->db->trans_commit();
            echo json_encode($insertLandclassChange);
        }

    }





    /////////pattadar land share in ejmali patta///
    public function pattadarLandShareEdit(){
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
        $data['_view'] = 'e_khajana/change_request/pattadar_land_share_index'; 
        $this->load->view('layouts/main',$data);
    }


    //class change method 
    public function pattadarAreaChange()
    {
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
        $data['village_list'] = $this->EkhajanaMouzadarChangeRequestModel->getVillageList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);

       // $data['land_class'] = $this->EkhajanaMouzadarChangeRequestModel->getLandClass();

        $data['_view'] = 'e_khajana/change_request/pattadar_land_share_edit'; 
        $this->load->view('layouts/main',$data);
    }


    public function getPattadarsOnDag()
    {
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $village_uuid = $_POST['village_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $patta_no = $_POST['patta_no'];
        $dag_no = $_POST['dag_no'];
        
        // var_dump($village_uuid);exit;

        $pattadars = $this->EkhajanaMouzadarChangeRequestModel->getPattadarsofDag($village_uuid,$patta_type_code,$patta_no,$dag_no);
        foreach ($pattadars as $pattadar) 
        {
            $data['pattadar'][] = $pattadar;
        }
        echo json_encode($data['pattadar']);
    }

    public function landAreaPost()
    {
        $village_uuid = $_POST['village_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $patta_no = $_POST['patta_no'];
        $dag_no = $_POST['dag_nos'];
        $remark = $_POST['remark'];

        $user_code = $this->session->userdata('designation');
        $name = $this->session->userdata('name');
        $unique_user_id = $this->session->userdata('unique_user_id');

        // var_dump($_POST['selectRecord']);exit;

        if(empty($_POST['selectRecord'])){
            echo json_encode(array('result' => 'SERVER-ERROR', 
                'msg' => 'No changes done!!'));
            exit;
        }

        $dag_area_b = $_POST['dag_area_b'];
        $dag_area_k = $_POST['dag_area_k'];
        $dag_area_lc = $_POST['dag_area_lc'];

        $final_lessa = $this->Total_Lessa($dag_area_b,$dag_area_k,$dag_area_lc);

        // var_dump($selectRecord);exit;
         
        $countpattadar= count($_POST['pdarname']);
        $selectRow= $_POST['selectRecord'];
        $countpattadarA= $_POST['pdarname'];

        $this->db->trans_begin();


        $total_lessa = 0;
        for($i=0;$i<$countpattadar;$i++)
        {  
           // var_dump($_POST['pdarname'][$i]);exit;
            $pdar = $_POST['pdarname'][$i];
            $split = explode('__',$pdar);
            $pdar_id = $split[0];
            $check = in_array($pdar_id,$selectRow);
            if($check)
            {
                // print_r("TRUE".$pdar_id);
                $suggested_bigha = $_POST['displayedB'][$i];
                $suggested_katha = $_POST['displayedK'][$i];
                $suggested_lessa = $_POST['displayedLC'][$i];

                $total_lessa += $this->Total_Lessa($suggested_bigha,$suggested_katha,$suggested_lessa);
            }
        }

        // var_dump($final_lessa);exit;

        if($total_lessa > $final_lessa)
        {

            echo json_encode(array('result' => 'SERVER-ERROR', 
                'msg' => 'Partial Land Share can not be more than Total Land Area of the Dag, Error-Code : #ERRLNDAREA003'));
            exit;
        }


        else
        {

         $insertPattadarAreaChange = $this->EkhajanaMouzadarChangeRequestModel->insertPattadarAreaChangeA($village_uuid,$patta_type_code,$patta_no,$dag_no,$countpattadar,$selectRow,$countpattadarA,$remark,$user_code,$name,$unique_user_id,$dag_area_b,$dag_area_k,$dag_area_lc);

         // var_dump($insertPattadarAreaChange);exit;

         $this->db->trans_commit();
         echo json_encode($insertPattadarAreaChange);

        }

         // $total_lessa = 0;
         // for($i=0;$i<$countpattadar;$i++)
         // {  
         //   // var_dump($_POST['pdarname'][$i]);exit;

         //    $pdar = $_POST['pdarname'][$i];
         //    $split = explode('__',$pdar);
         //    $pdar_id = $split[0];
         //    $check = in_array($pdar_id,$selectRow);
         //    if($check)
         //    {
         //        // print_r("TRUE".$pdar_id);
         //        $suggested_bigha = $_POST['displayedB'][$i];
         //        $suggested_katha = $_POST['displayedK'][$i];
         //        $suggested_lessa = $_POST['displayedLC'][$i];
         //    // var_dump($lessa);exit;

         //        $total_lessa += $this->Total_Lessa($suggested_bigha,$suggested_katha,$suggested_lessa);

         //        $insertPattadarAreaChange = $this->EkhajanaMouzadarChangeRequestModel->insertPattadarAreaChange($village_uuid,$patta_type_code,$patta_no,$dag_no,$pdar_id,$suggested_bigha,$suggested_katha,$suggested_lessa,$remark,$user_code,$name,$unique_user_id);
         //    }


         //    else{
         //        //false
         //        print_r("FALSE".$pdar_id);
         //    }
         //    // // var_dump($pdar_id);exit;
         //    // $suggested_bigha = $_POST['displayedB'][$i];
         //    // $suggested_katha = $_POST['displayedK'][$i];
         //    // $suggested_lessa = $_POST['displayedLC'][$i];
         //    // // var_dump($lessa);exit;

         //    // $total_lessa += $this->Total_Lessa($suggested_bigha,$suggested_katha,$suggested_lessa);

         //    // $insertPattadarAreaChange = $this->EkhajanaMouzadarChangeRequestModel->insertPattadarAreaChange($village_uuid,$patta_type_code,$patta_no,$dag_no,$pdar_id,$suggested_bigha,$suggested_katha,$suggested_lessa,$remark,$user_code,$name,$unique_user_id);


         // }
         

         // var_dump($total_lessa);exit;

         // if($total_lessa > $final_lessa)
         // {
         //    exit;
         // }
         // else
         // {
             //$this->db->trans_commit();
        // }

        

    }



      function Total_Lessa($bigha, $katha, $lessa) 
      {
        $total_lessa = $lessa + ($katha * 20) + ($bigha * 100);
        return $total_lessa;
      }


    public function viewUpdatedLandClass()
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
        $data['landclass_list'] = $this->EkhajanaMouzadarChangeRequestModel->getLandclassdetails($dist_code,$subdiv_code,$cir_code,$mouza_code);
        // var_dump($data);exit;
        $data['_view'] = 'e_khajana/change_request/land_class_list';
        $this->load->view('layouts/main',$data);
    }


    public function pendingCaseDetailsLC($petition_no)
    {
        
        $data['caseDetails'] = $caseDetails = $this->EkhajanaMouzadarChangeRequestModel->getPendingCaseDetailsFromIdLC($petition_no);
        $data['_view'] = 'e_khajana/change_request/pending_case_details_lc';
        $this->load->view('layouts/main',$data);        
    }



     /////////hanging pattadar edit in patta///
    public function hangingPattadarEdit(){
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
        $data['_view'] = 'e_khajana/change_request/hanging_pattadar_index'; 
        $this->load->view('layouts/main',$data);
    }


    //class change method 
    public function hangingPattadarChange()
    {
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
        $data['village_list'] = $this->EkhajanaMouzadarChangeRequestModel->getVillageList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);

       // $data['land_class'] = $this->EkhajanaMouzadarChangeRequestModel->getLandClass();

        $data['_view'] = 'e_khajana/change_request/hanging_pattadar_edit'; 
        $this->load->view('layouts/main',$data);
    }

    public function getPattadarsOnPatta()
    {
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $village_uuid = $_POST['village_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $patta_no = $_POST['patta_no'];
        
        // var_dump($village_uuid);exit;

        $pattadars = $this->EkhajanaMouzadarChangeRequestModel->getPattadarsofPatta($village_uuid,$patta_type_code,$patta_no);
        foreach ($pattadars as $pattadar) 
        {
            $data['pattadar'][] = $pattadar;
        }
        echo json_encode($data['pattadar']);
    }

    public function hangingpdarPost()
    {
        $village_uuid = $_POST['village_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $patta_no = $_POST['patta_no'];
        $remark = $_POST['remark'];

        $user_code = $this->session->userdata('designation');
        $name = $this->session->userdata('name');
        $unique_user_id = $this->session->userdata('unique_user_id');

        // var_dump($_POST['pdarname']);exit;

        if(empty($_POST['selectRecord'])){
            echo json_encode(array('result' => 'SERVER-ERROR', 
                'msg' => 'No changes done!!'));
            exit;
        }

        // var_dump($selectRecord);exit;
         
        $countpattadar= count($_POST['pdarname']);
        $selectRow= $_POST['selectRecord'];
        $countpattadarA= $_POST['pdarname'];

        $this->db->trans_begin();

         $insertPattadarAreaChange = $this->EkhajanaMouzadarChangeRequestModel->insertHangingPattadar($village_uuid,$patta_type_code,$patta_no,$countpattadar,$selectRow,$countpattadarA,$remark,$user_code,$name,$unique_user_id);

         // var_dump($insertPattadarAreaChange);exit;

         $this->db->trans_commit();
         echo json_encode($insertPattadarAreaChange);

    }


    /////////land revenue edit in patta///
    public function landRevenueEdit(){
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
        $data['_view'] = 'e_khajana/change_request/land_revenue_index'; 
        $this->load->view('layouts/main',$data);
    }



    public function landRevenueChange()
    {
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
        $data['village_list'] = $this->EkhajanaMouzadarChangeRequestModel->getVillageList($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);

       // $data['land_class'] = $this->EkhajanaMouzadarChangeRequestModel->getLandClass();

        $data['_view'] = 'e_khajana/change_request/land_revenue_edit'; 
        $this->load->view('layouts/main',$data);
    }


     public function getRevenueofPatta()
    {
        //***************chechink-user-designation**********/
        if($this->session->userdata('designation') != 'MOU'){
            echo json_encode("Not Authorised!!");
            exit;
        }
        $village_uuid = $_POST['village_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $patta_no = $_POST['patta_no'];
        
        // var_dump($village_uuid);exit;

        $revenue = $this->EkhajanaMouzadarChangeRequestModel->getRevenueofPatta($village_uuid,$patta_type_code,$patta_no);
        
        echo json_encode($revenue);
    }


    public function revenuechangePost()
    {
        $village_uuid = $_POST['village_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $patta_no = $_POST['patta_no'];
        $remark = $_POST['remark'];

        $p_local_tax = $_POST['p_local_tax'];
        $P_land_rev = $_POST['P_land_rev'];
        $dag_local_tax = $_POST['dag_local_tax'];
        $dag_revenue = $_POST['dag_revenue'];

        $user_code = $this->session->userdata('designation');
        $name = $this->session->userdata('name');
        $unique_user_id = $this->session->userdata('unique_user_id');

        // var_dump($_POST);exit;

        if(empty($_POST['p_local_tax']) || empty($_POST['P_land_rev']))
        {
            echo json_encode(array('result' => 'SERVER-ERROR', 
                'msg' => 'No changes done!!'));
            exit;
        }
        //var_dump($P_land_rev);exit;

        if($P_land_rev < 15)
        {
            echo json_encode(array('result' => 'SERVER-ERROR', 
                'msg' => 'Proposed Revenue amount can not be less than 15 !!'));
            exit;
        }

        if($p_local_tax < 3.75)
        {
            echo json_encode(array('result' => 'SERVER-ERROR', 
                'msg' => 'Proposed local tax amount can not be less than 3.75 !!'));
            exit;
        }

        $this->db->trans_begin();

        $insertRevenueChange = $this->EkhajanaMouzadarChangeRequestModel->insertRevenueChange($village_uuid,$patta_type_code,$patta_no,$p_local_tax,$P_land_rev,$dag_local_tax,$dag_revenue,$remark,$user_code,$name,$unique_user_id);

         // var_dump($insertPattadarAreaChange);exit;

        $this->db->trans_commit();
        echo json_encode($insertRevenueChange);

    }

}
?>
