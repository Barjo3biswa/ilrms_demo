<?php

class EkhajanaMouzadarBankDetailsController extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
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

    //bank details display method
    public function index(){
        $this->db  = $this->load->database('rtpsmb', TRUE);        
        $data['dist_code'] =$dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] =$subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] =$cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] =$mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $bank_details_query = $this->db->query("select * from ekhajana_mouzadar_account_details where dist_code=?
        and subdiv_code=? and cir_code=? and mouza_pargona_code=?  and status='A'", array($dist_code,$subdiv_code,$cir_code,
        $mouza_pargona_code));
        if($bank_details_query->num_rows() != 1){
            $data['flag'] = 'N';
            $data['msg'] = "Bank Details Not Found For The Mouza, Kindly Contact Administrator..!";
            $data['bank_details'] = null;
            $data['declaration_submit'] = null;
           
        }else{
            $data['flag'] = 'Y';
            $data['msg'] = "";
            $data['declaration_submit'] = $bank_details_query->row()->mouzadar_declare_yn;
            $data['bank_details'] = $bank_details_query->row();
        }
        
        $data['_view'] = 'e_khajana/mouz_views/bank_details/index';
        $this->load->view('layouts/main', $data);
    }

    //method to update 
    public function updateDeclartion()
    {
        $this->db  = $this->load->database('rtpsmb', TRUE);        
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $account_code = $_POST['account_code'];
        $mouzadar_decalre = $_POST['mouzadar_declare'];
        $this->db->trans_begin();
        $inserted_id = $this->db->query("select * from ekhajana_mouzadar_account_details order by id desc limit 1")->row()->id;
	if($_POST['account_code'] =='--' && $_POST['mouzadar_declare']=='N'){

            $data_exist = $this->db->query("select * from ekhajana_mouzadar_account_details where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status=? ",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,'A'));
            if($data_exist->num_rows() >= 1){
                $this->db->trans_rollback();
                echo json_encode(['result' => 'SERVER-ERROR', 'msg' => 'Data Already Inserted : #EKHMBDD0017']);
                log_message("error","Data already inserted for the location ".$dist_code.$subdiv_code.$cir_code.$mouza_pargona_code);
                exit;
            }

            $insert_array = [
                'dist_code'                 => $_POST['dist_code'],
                'subdiv_code'               => $_POST['subdiv_code'],
                'cir_code'                  => $_POST['cir_code'],
                'mouza_pargona_code'        => $_POST['mouza_pargona_code'],
                'dept_code'                 => '--',
                'office_code'               => '--',
                'office_name'               => '--',
                'account_code'              => "Not-Updated-".($inserted_id + 1),
                'non_treasury_payment_type' => '--',
                'name_of_service'           => "E-KHAJANA",
                'status'                    => 'A',
                'created_at'                => date('Y-m-d h:i:s'),
                'modified_at'               => null,
                'bank_name'                 =>'--',
                'branch_name'               =>'--',
                'ifsc_code'                 =>'--',
                'account_name'              =>'--',
                'account_number'            =>'--',
                'mouzadar_declare_yn'       =>$_POST['mouzadar_declare']
            ]; 

            $tstatus1 = $this->db->insert('ekhajana_mouzadar_account_details', $insert_array); 
            if ($tstatus1!= 1)
            {
                $this->db->trans_rollback();
                log_message("error", "#EKHMBDD0012, Error in insert on insert_array table with data ". json_encode($insert_array));
                echo json_encode(['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHMBDD0012']);
            }else{
                $this->db->trans_commit();
                echo json_encode(['result' => 'SUCCESS', 'msg' => 'Case Updated Sucessfully..!']);
            }
        }else{
            $update_array = [
                'mouzadar_declare_yn' => $mouzadar_decalre,
                'modified_at' => date('Y-m-d h:i:s')
            ];
            $this->db->where('dist_code', $dist_code);
            $this->db->where('subdiv_code', $subdiv_code);
            $this->db->where('cir_code', $cir_code);
            $this->db->where('mouza_pargona_code', $mouza_pargona_code);
            $this->db->where('account_code', $account_code);
            $this->db->update('ekhajana_mouzadar_account_details', $update_array);
            if($this->db->affected_rows() != 1){ 
                $this->db->trans_rollback();
                log_message("error", "#EKHMBDD001, Error in update, table 'ekhajana_mouzadar_account_details' with account_code ".$account_code);
                echo json_encode(['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHMBDD001']);
            }else{
                $this->db->trans_commit();
                echo json_encode(['result' => 'SUCCESS', 'msg' => 'Case Updated Sucessfully..!']);  
            }
        } 
       
    }

}
?>
