<?php

class EkhajanaMouzadarBankDetails extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ekhajana/EkhajanaBankDetailsModel');
        $this->dbswitch();
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

    public function mouzadarBankDetailsDataEntry()
    {
	$st_start = microtime(true);    
        $CI=&get_instance();
	$this->db=$CI->load->database('repl', TRUE);
	log_message('error','TIME_TEST: BDP1: '.(microtime(true)-$st_start));
        $st_start = microtime(true);
	$data['district'] = $this->db->query("select district_name,district_code from district_details where online='0'")->result();
	log_message('error','TIME_TEST: BDP2: '.(microtime(true)-$st_start));
        $data['_view'] = 'e_khajana/mouzadarBankDataEntry';
        $this->load->view('layouts/main', $data);
    }

    public function getCircleNames()
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $params = json_decode(file_get_contents("php://input"));
        $dist_code = $params->dist_code;
        $query = $this->db->query("select dist_code,subdiv_code,cir_code,loc_name,locname_eng from location where dist_code=? and subdiv_code!=? and cir_code!=? and mouza_pargona_code=? and lot_no=?",array($dist_code,'00','00','00','00'));
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

    //method to submit bank details
    public function submitBankDetails()
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('db2', TRUE);
        $error_msg = array();
        $validation = [
            [
                'field' => 'circle_list',
                'label' => 'Location',
                'rules' => 'required'
            ],
            [
                'field' => 'mouza_list',
                'label' => 'Mouza Pargona Code',
                'rules' => 'required'
            ],
            [
                'field' => 'dept_code',
                'label' => 'Department Code',
                'rules' => 'required'
            ],
            [
                'field' => 'office_code',
                'label' => 'Office Code',
                'rules' => 'required'
            ],
            [
                'field' => 'office_name',
                'label' => 'Office Name',
                'rules' => 'required',
            ],
            [
                'field' => 'payment_type',
                'label' => 'Payment Type',
                'rules' => 'required',
            ],
            [
                'field' => 'service_name',
                'label' => 'Service name',
                'rules' => 'required',
            ],
            [
                'field' => 'bank_name',
                'label' => 'Bank Name',
                'rules' => 'required',
            ],
            [
                'field' => 'branch_name',
                'label' => 'Branch Name',
                'rules' => 'required',
            ],
            [
                'field' => 'ifsc_code',
                'label' => 'IFSC Code',
                'rules' => 'required',
            ],
            [
                'field' => 'account_name',
                'label' => 'Account Name',
                'rules' => 'required',
            ],
            [
                'field' => 'account_number',
                'label' => 'Account Number',
                'rules' => 'required',
            ],
            [
                'field' => 'account_code',
                'label' => 'Account Code',
                'rules' => 'required',
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
            echo json_encode(['result' => 'VALIDATION ERROR', 'msg' => $error_msg]);
            exit;
        }
        // **************************

        $circle_list_array = explode(",", $_POST["circle_list"]);

        $dist_code = $circle_list_array[0];
        $subdiv_code = $circle_list_array[1];
        $cir_code = $circle_list_array[2];
        $mouza_pargona_code = $_POST["mouza_list"];
        $dept_code = $_POST["dept_code"];
        $office_code = $_POST["office_code"];
        $office_name = $_POST["office_name"];
        $payment_type = $_POST["payment_type"];
        $service_name = $_POST["service_name"];
        $bank_name = $_POST["bank_name"];
        $branch_name = $_POST["branch_name"];
        $ifsc_code = $_POST["ifsc_code"];
        $account_name = $_POST["account_name"];
        $account_code = $_POST["account_code"];
        $account_number = $_POST["account_number"];

        $mouzadar_acc_details_insert_array = array(
            'dist_code'                 => $dist_code,
            'subdiv_code'               => $subdiv_code,
            'cir_code'                  => $cir_code,
            "mouza_pargona_code"        => $mouza_pargona_code,
            "dept_code"                 => $dept_code,
            "office_code"               => $office_code,
            "office_name"               => $office_name,
            "account_code"              => $account_code,
            "non_treasury_payment_type" => $payment_type, 
            "name_of_service"           => $service_name, 
            "status"                    => 'A', 
            "created_at"                => date("Y-m-d h:i:s"), 
            "modified_at"               => null, 
            "bank_name"                 => $bank_name,  
            "branch_name"               => $branch_name,  
            "ifsc_code"                 => $ifsc_code,  
            "account_name"              => $account_name,  
            "account_number"            => $account_number,  
        );

        $insertdataInTable = $this->EkhajanaBankDetailsModel->InsertMouzadarBankDetails($mouzadar_acc_details_insert_array);
        if($insertdataInTable['result'] == 'SERVER-ERROR'){
            echo json_encode(['flag'=> 'N','msg' => "Data Not Inserted Succesffully"]);
            exit;
        }else if($insertdataInTable['result'] == 'SUCCESS'){
            echo json_encode(['flag'=> 'Y','msg' => "Data Inserted Succesffully"]);
            exit;
        }else{
            echo json_encode(['flag'=> 'N','msg' => "SOME ERROR OCCURRED.. PLEASE TRY AGAIN"]);
            exit;
        }
        
    }

    public function mouzadarBankDetailsDataUpdate()
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $data['district'] = $this->db->query("select district_name,district_code from district_details where online='0'")->result();
        $data['_view'] = 'e_khajana/mouzadarBankDataUpdate';
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
    public function fetchBankDetails()
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $dist_code      = $_POST['district_code'];
        $subdiv_code    = $_POST['subdiv_list'];
        $cir_code       = $_POST['circle_list'];
        $mouza_pargona_code =$_POST['mouza_list'];
        $getBankDetails = $this->db->query("select * from ekhajana_mouzadar_account_details where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,'A'));
        if($getBankDetails->num_rows() == 0)
        {
            echo json_encode("Bank Details not Available");
            exit();
        }
        $data['bank_details'] = $getBankDetails->row();
        $data['_view'] = 'e_khajana/submitUpdatedData';
        $this->load->view('layouts/main', $data);
    }
    public function updateBankDetails()
    {
        $dist_code      = $_POST['dist_code'];
        $subdiv_code    = $_POST['subdiv_code'];
        $cir_code       = $_POST['cir_code'];
        $mouza_pargona_code = $_POST['mouza_pargona_code'];
        $bank_id    = $_POST['bank_id'];
        $account_code    = $_POST['account_code'];
        $dept_code  = $_POST['dept_code'];
        $office_code = $_POST['office_code'];
        $office_name = $_POST['office_name'];
        $bank_name = $_POST['bank_name'];
        $branch_name = $_POST['branch_name'];
        $ifsc_code = $_POST['ifsc_code'];
        $account_name = $_POST['account_name'];
        $account_number = $_POST['account_number'];
        $mouzadar_acc_details_update_array = array(
            "dept_code"                 => $dept_code,
            "office_code"               => $office_code,
            "office_name"               => $office_name,
            "bank_name"                 => $bank_name,
            "branch_name"               => $branch_name,
            "ifsc_code"                 => $ifsc_code,
            "account_name"              => $account_name,
	    "account_number"            => $account_number,
	    "account_code"              => $account_code,
	    "modified_at"                => date("Y-m-d h:i:s"),
	    "mouzadar_declare_yn"       => null,
	    "adc_verified_yn"             =>null
        );
        $updateBankDetails = $this->EkhajanaBankDetailsModel->updateMouzadarBankDetails($mouzadar_acc_details_update_array,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$bank_id,$account_code);
        if($updateBankDetails['result'] == 'SERVER-ERROR'){
            echo json_encode(['flag'=> 'N','msg' => "Data Not Updated Succesffully"]);
            exit;
        }else if($updateBankDetails['result'] == 'SUCCESS'){
            echo json_encode(['flag'=> 'Y','msg' => "Data Updated Succesffully"]);
            exit;
        }else{
            echo json_encode(['flag'=> 'N','msg' => "SOME ERROR OCCURRED.. PLEASE TRY AGAIN"]);
            exit;
        }
    }


}
?>
