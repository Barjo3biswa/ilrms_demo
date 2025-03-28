<?php

class EkhajanaMouzadarChangeNoticeController extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ekhajana/EkhajanaArrearModel');
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
        }                                                                                                                                                                                                              
    }

    //index method
    public function index(){
        $data['_view'] = 'e_khajana/change_request/index';
        $this->load->view('layouts/main',$data);
    }

    //change request form
    public function changeReqForm(){
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
        //********************************************************************/
        //getting all the land classes
        $landClass = "select * from landclass_code";
        $query = $this->db->query($landClass);
        $land_classes = $query->result(); 
        // echo "<pre>";
        // var_dump($land_classes);
        // echo "</pre>";
        // exit;
        //********************************************************************/
        $data['land_classes'] = $land_classes;
        $data['_view'] = 'e_khajana/change_request/changeReqForm';
        $this->load->view('layouts/main',$data);
    }

    //getting the dag numbers 
    public function getDagNumbers(){
        $this->dbswitch();
        $village_uuid = $_POST['vill_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $dist_code = $_POST['dist_code'];
        $subdiv_code = $_POST['subdiv_code'];
        $cir_code = $_POST['cir_code'];
        $mouza_pargona_code = $_POST['mouza_pargona_code'];
        $lot_no = $_POST['lot_no'];
        $vill_townprt_code = $_POST['vill_townprt_code'];
        $patta_type_code = $_POST['patta_type_code'];
        $patta_no = $_POST['patta_no'];

        $sqlDagNos = "select distinct (dag_no) from chitha_basic where dist_code=? and subdiv_code= ? and cir_code =? 
                        and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code =? and patta_no=?";
        $query = $this->db->query($sqlDagNos, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,
                        $vill_townprt_code, $patta_type_code,$patta_no));
        //echo json_encode($this->db->last_query());exit;
        $dag_list = $query->result(); 
        echo json_encode($dag_list);
    }

    public function getExistingLandClass(){
        $this->dbswitch();
        $village_uuid = $_POST['vill_uuid'];
        $patta_type_code = $_POST['patta_type_code'];
        $dist_code = $_POST['dist_code'];
        $subdiv_code = $_POST['subdiv_code'];
        $cir_code = $_POST['cir_code'];
        $mouza_pargona_code = $_POST['mouza_pargona_code'];
        $lot_no = $_POST['lot_no'];
        $vill_townprt_code = $_POST['vill_townprt_code'];
        $patta_type_code = $_POST['patta_type_code'];
        $patta_no = $_POST['patta_no'];
        $dag_no = $_POST['dag_no'];

        $sqlLandClass = "select cb.land_class_code,lc.land_type,lc.landtype_eng from chitha_basic cb join 
                        landclass_code lc on cb.land_class_code = lc.class_code where cb.dist_code=? and 
                        cb.subdiv_code= ? and cb.cir_code =? and cb.mouza_pargona_code=? and cb.lot_no=? 
                        and cb.vill_townprt_code=? and cb.patta_type_code =? and cb.patta_no=? and cb.dag_no =?";
        $query = $this->db->query($sqlLandClass, array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,
        $vill_townprt_code, $patta_type_code,$patta_no,$dag_no));

        $land_class = $query->result(); 
        echo json_encode($land_class);

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


    public function submitChangeReq(){
        //**************************************************************************************/
        //validation errors 
        $error_msg = array();
        $validation = [            
            [
                'field' => 'dist_code',
                'label' => 'district',
                'rules' => 'required|callback_check_script|max_length[2]|trim'
            ],
            [
                'field' => 'subdiv_code',
                'label' => 'sub division',
                'rules' => 'required|callback_check_script|max_length[2]|trim'
            ],
            [
                'field' => 'cir_code',
                'label' => 'circle',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'mouza_pargona_code',
                'label' => 'mouza',
                'rules' => 'required|callback_check_script|max_length[2]|trim',
            ],
            [
                'field' => 'lot_no',
                'label' => 'lot no',
                'rules' => 'required|callback_check_script|max_length[5]|trim',
            ],
            [
                'field' => 'vill_townprt_code',
                'label' => 'Village/Town',
                'rules' => 'required|callback_check_script|max_length[5]|trim',
            ],
            [
                'field' => 'vill_uuid',
                'label' => 'village Code',
                'rules' => 'required|callback_check_script',
            ],
            [
                'field' => 'patta_type_code',
                'label' => 'patta type',
                'rules' => 'required|callback_check_script|trim|max_length[4]',
            ],
            [
                'field' => 'patta_no',
                'label' => 'patta no',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],
            [
                'field' => 'dag_no',
                'label' => 'dag no',
                'rules' => 'required|callback_check_script|trim|max_length[20]',
            ],    
            [
                'field' => 'existing_land_class',
                'label' => 'Existing Land Class',
                'rules' => 'required|callback_check_script|trim|max_length[4]',
            ],
            [
                'field' => 'proposed_land_class',
                'label' => 'Land Class Used As',
                'rules' => 'required|callback_check_script|trim|max_length[4]',
            ],          
            [
                'field' => 'change_req_rmk',
                'label' => 'Remark',
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
        //**************************************************************************************/
        //insert into db
        $this->dbswitch();
        $exiting_land_class_name = $this->db->query("select * from landclass_code where class_code=?", array($_POST['existing_land_class']))->row()->land_type;
        $proposed_land_class_name = $this->db->query("select * from landclass_code where class_code=?", array($_POST['proposed_land_class']))->row()->land_type;
        $insert_data = [
            "dist_code"=>$_POST['dist_code'],
            "subdiv_code"=> $_POST['subdiv_code'],
            "cir_code"=>$_POST['cir_code'],
            "mouza_pargona_code"=> $_POST['mouza_pargona_code'],
            "lot_no"=>$_POST['lot_no'],
            "vill_townprt_code"=>$_POST['vill_townprt_code'],
            "uuid"=>$_POST['vill_uuid'],
            "patta_type_code"=>$_POST['patta_type_code'],
            "patta_no"=>$_POST['patta_no'],
            "dag_no"=> $_POST['dag_no'],
            "existing_land_class_code"=>$_POST['existing_land_class'],
            "exisiting_land_class_name"=> $exiting_land_class_name,
            "proposed_land_class_code"=> $_POST['proposed_land_class'],
            "proposed_land_class_name"=>$proposed_land_class_name,
            "remark"=>$_POST['change_req_rmk'],
            "user_details"=> json_encode($this->session->userdata),
            "ip_address" => $_SERVER['REMOTE_ADDR'],
            "created_at"=> date('Y-m-d h:i:s')
        ];
        
        $tstatus1 = $this->db->insert('mouzadar_change_req_details', $insert_data);
        if ($tstatus1!= 1)
        {
            log_message("error", "#EKMOUBANKINS001, Error in insert on mouzadar_change_req_details table with data ". json_encode($insert_data));
            echo json_encode(['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #MOUCHGREQERRIST']);
        }else{
            echo json_encode(['result' => 'SUCCESS', 'msg' => 'Change Request Added Successfully!']);
        }
    }

    public function changeReqList(){
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
        $data['changeReqList'] = $this->db->query("select * from mouzadar_change_req_details where 
                                 dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?"
                                 ,array($dist_code,$subdiv_code,$cir_code,$mouza_code))->result();
        $data['_view'] = 'e_khajana/change_request/change_request_updated_list';
        $this->load->view('layouts/main',$data);
                                 
    }

}
?>