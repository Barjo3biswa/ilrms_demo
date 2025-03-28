<?php
class Nyks extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('AES');
        $this->load->library('form_validation');
        $this->load->model('ekhajana/Nyks/NyksModel'); 
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
        }   else if($this->session->userdata('dist_code') == "39"){
         $this->db=$CI->load->database('bajali', TRUE);
        }                                                                                                                                                                                                            
    }

    public function Registration()
    {
        $data['_view'] = 'e_khajana/nyks/post_registration_form';
        $this->load->view('layouts/main',$data);
    }

    public function RegistrationSubmit(){
        $data['mobile']         = $_POST['mobile'];
        $data['rtps_trans_id']  = "NYKS".strtotime('now');
        $data['user_id']        = $this->session->userdata('unique_user_id');
        $data['user_type']      = "VOLUNTEER";
        $data['portal_no']      = "1";
        $data['service_id']     = "19";
        $data['process']        = "N";
        $data['response_url']   = NYKS_RESPONSE_URL;
        $data['nyks_dist_code']   = $this->session->userdata('dist_code');
        $this->db  = $this->load->database('db2', TRUE);
        $this->db->trans_begin();
        //insert into ekhajana_volunteers_data
        $insert_arr = array(
            "user_id"       => $this->session->userdata('unique_user_id'),
            "user_data"     => json_encode($this->session->userdata()),
            "reff_no"       => $data['rtps_trans_id'],
            "status"        => 'S',     //sent
            "pdar_mob"      => $_POST['mobile'],
            "all_data_json" => json_encode($data),
            "created_at"    => date('Y-m-d h:i:s'),
        );
        $tstatus2 = $this->db->insert('ekhajana_volunteers_data', $insert_arr); 
        if($tstatus2!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHNYKS001, Error in insert on ekhajana_volunteers_data table with query- ". json_encode($this->db->last_query()));
            echo "Some Error Occured.!!! PLease try Agian Err Code : #EKHNYKS001";
            exit;
        }
        $this->db->trans_commit();
        log_message("error","nyks registration data log".json_encode($data));
        $aes = new AES(json_encode($data), ENCRYPTION_KEY);
        $enc = $aes->encrypt();
        $data['enc_data']=$enc;
        $data['_view'] = 'e_khajana/nyks/autosubmit_registration_form';
        $this->load->view('layouts/main',$data);
    }

    public function SentOtp(){
        $otp_generated = mt_rand(100000, 999999);
        $this->session->set_userdata('nyks_generated_otp', $otp_generated);
        $otp_response = $this->sendToPhone($_POST['mobile_no']);
        if($otp_response->code == '402'){
            echo json_encode(['status' => true, 'msg'=>"Otp Has Been Sent Successfully To Mobile No ". $_POST['mobile_no']]);
        }else{
            echo json_encode(['status' => false, 'msg'=>"Failed To Sent Otp"]);
        }
        
    }

    private function sendToPhone($mobile_no) {
        $curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => GET_OTP_ON_LOGIN,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
				"key"       : "login_otp",
				"variables" : "'. $this->session->userdata('nyks_generated_otp') .'",
				"mobilenos" : "'.$mobile_no.'" 
			}',
		));
		$response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function verify_otp()
    {
        $session_otp = $this->session->userdata('nyks_generated_otp');
        $entered_otp = $this->input->post('entered_otp');
        if($session_otp == $entered_otp)
        {
            echo json_encode(['status' => true, 'msg'=>"OTP has been verified Successfully"]); 
        }else{
            echo json_encode(['status' => false, 'msg'=>"OTP Mismatch, Please try again..!!"]); 
        }
    }

    public function MutiApply()
    {
        $this->db  = $this->load->database('db2', TRUE);
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['patta_types'] = $this->NyksModel->getAllPattaTypes();
        $data['patta_numbers'] = $this->NyksModel->getAllPattaNumbers();
        $data['subdivisions'] = $this->NyksModel->getAllSubdivs($dist_code);
        $data['_view'] = 'e_khajana/nyks/mutation_apply_form';
        $this->load->view('layouts/main', $data);
    }

    public function getCircleName()
    {
        $params = json_decode(file_get_contents("php://input"));
        $dist_code = $params->dist_code;
        $subdiv_code = $params->subdiv_code;
        $circles = $this->NyksModel->getAllCircles($dist_code,$subdiv_code);
        echo json_encode($circles);
    }

    public function getAllMouzas()
    {
        $params = json_decode(file_get_contents("php://input"));
        $dist_code = $params->dist_code;
        $subdiv_code = $params->subdiv_code;
        $cir_code = $params->cir_code;
        $mouzas = $this->NyksModel->getAllMouzas($dist_code,$subdiv_code,$cir_code);
        echo json_encode($mouzas);
    }

    public function getAllVillages()
    {
        $params = json_decode(file_get_contents("php://input"));
        $dist_code = $params->dist_code;
        $subdiv_code = $params->subdiv_code;
        $cir_code = $params->cir_code;
        $mouza_pargona_code = $params->mouza_pargona_code;
        $villages = $this->NyksModel->getAllVillages($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        echo json_encode($villages);
    }

    public function getAllPattaType()
    {
        
        $dist_code = $this->session->userdata('dist_code');
        $data['patta_types'] = $this->NyksModel->getAllPattaTypes($dist_code);
        echo json_encode($patta_types);
    }

    public function getAllPattas()
    {
        $params = json_decode(file_get_contents("php://input"));
        $dist_code = $params->dist_code;
        $subdiv_code = $params->subdiv_code;
        $cir_code = $params->cir_code;
        $mouza_pargona_code = $params->mouza_pargona_code;
        $lot_no = $params->lot_no;
        $vill_townprt_code = $params->vill_townprt_code;
        $patta_type = $params->patta_type;
        $patta_nos = $this->NyksModel->getAllPattaNos($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type);
        echo json_encode($patta_nos);
    }

    public function getAllPattadars()
    {
        $params = json_decode(file_get_contents("php://input"));
        $dist_code = $params->dist_code;
        $subdiv_code = $params->subdiv_code;
        $cir_code = $params->cir_code;
        $mouza_pargona_code = $params->mouza_pargona_code;
        $lot_no = $params->lot_no;
        $vill_townprt_code = $params->vill_townprt_code;
        $patta_type = $params->patta_type;
        $patta_no = $params->patta_no;
        $pattadars = $this->NyksModel->getAllPattadars($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type,$patta_no);
        echo json_encode($pattadars);
    }



    public function submitProposedMutation_old()
    {
        
        $dist_code = $_POST['dist_code'];
        $subdiv_code = $_POST['subdiv_code'];
        $cir_code = $_POST['cir_code'];
        $mouza_pargona_code = $_POST['mouza_pargona_code'];
        $concated_village = $_POST['village'];
        $exploded_village = explode("_", $_POST['village']); 
        $lot_no = $exploded_village[0];
        $vill_townprt_code = $exploded_village[1];
        $patta_type = $_POST['patta_type'];
        $patta_no = $_POST['patta_no'];
        $pattadar = $_POST['pattadar'];
        $concated_pattdar_details = $_POST['pattadar'];
        $exploded_pattdar_details = explode("_", $_POST['pattadar']); 
        $pdar_id = $exploded_pattdar_details[0];
        $pdar_name = $exploded_pattdar_details[1];
        $pdar_father = $exploded_pattdar_details[2];

        $this->db->trans_begin();
        $insert_arr = array(
            'dist_code'         => $dist_code, 
            'subdiv_code'       => $subdiv_code,
            'cir_code'          => $cir_code,
            'mouza_pargona_code'=> $mouza_pargona_code,
            'lot_no'            => $lot_no,
            'vill_townprt_code' => $vill_townprt_code,
            'patta_type_code'   => $patta_type,
            'patta_no'          => $patta_no,
            'pdar_id'           => $pdar_id, 
            'pdar_name'         => $pdar_name,
            'pdar_father'       => $pdar_father,
            'nyks_user_code'    => $this->session->userdata('unique_user_id'),
            "created_at"        => date('Y-m-d h:i:s'),
        );
        $tstatus3 = $this->db->insert('ekhajana_mutation_apply_by_volunteer', $insert_arr);
        if ($tstatus3!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHUBDM003, Error in insert on ekhajana_mouzadar_arrear_details table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBDM003'];
        }else{
            $this->db->trans_commit();
            echo json_encode(['result' => 'SUCCESS', 'msg' => "Data Inserted Successfully"]);
        }
    }


    function eID()
    {
        $data['name'] = $this->session->userdata['name'];
        $data['email'] = $this->session->userdata['email'];
        $data['mobile_no'] = $this->session->userdata['mobile_no'];
        $data['address'] = $this->session->userdata['address'];
        $data['date_of_joining'] = $this->session->userdata['date_of_joining'];
        $CI=&get_instance();
        $this->db=$CI->load->database('db2', TRUE);
        $user_id = $this->db->query("select id from depart_users where unique_user_id=? and status='E'",
        array($this->session->userdata['unique_user_id']))->row()->id;
        $data['id_code'] = "NYKS-EKH-".$user_id;
        $data['_view'] = 'e_khajana/nyks/eID';
        $this->load->view('layouts/main',$data);
    }

    public function FeedBackList()
    {
        $data['nyks_feedback_data'] = $this->db->query("select * from ekhajana_feedback where nyks_user_code=?",
                                        array($this->session->userdata['unique_user_id']))->result();
        $data['_view'] = 'e_khajana/nyks/feedbackFormList';
        $this->load->view('layouts/main',$data);
    }


    public function submitProposedMutation()
    {
        // var_dump($_POST);
        // exit;
        $dist_code = $_POST['dist_code'];
        $subdiv_code = $_POST['subdiv_code'];
        $cir_code = $_POST['cir_code'];
        $mouza_pargona_code = $_POST['mouza_pargona_code'];
        $concated_village = $_POST['village'];
        $exploded_village = explode("_", $_POST['village']);
        $lot_no = $exploded_village[0];
        $vill_townprt_code = $exploded_village[1];
        $patta_type = $_POST['patta_type'];
        $patta_no = $_POST['patta_no'];
        $pattadar = $_POST['pattadar'];
        $concated_pattdar_details = $_POST['pattadar'];
        $exploded_pattdar_details = explode("_", $_POST['pattadar']);
        $pdar_id = $exploded_pattdar_details[0];
        $pdar_name = $exploded_pattdar_details[1];
        $pdar_father = $exploded_pattdar_details[2];
        $category_id = $_POST['category'];
        $remark = $_POST['remark'];
        $this->db->trans_begin();
        $insert_arr = array(
            'dist_code'         => $dist_code,
            'subdiv_code'       => $subdiv_code,
            'cir_code'          => $cir_code,
            'mouza_pargona_code'=> $mouza_pargona_code,
            'lot_no'            => $lot_no,
            'vill_townprt_code' => $vill_townprt_code,
            'patta_type_code'   => $patta_type,
            'patta_no'          => $patta_no,
            'pdar_id'           => $pdar_id,
            'pdar_name'         => $pdar_name,
            'pdar_father'       => $pdar_father,
            'nyks_user_code'    => $this->session->userdata('unique_user_id'),
            'category'          => $category_id,
            'remark'            => $remark,
            "created_at"        => date('Y-m-d h:i:s'),
        );
        $tstatus3 = $this->db->insert('ekhajana_feedback', $insert_arr);
        if ($tstatus3!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHUBDM003, Error in insert on ekhajana_feedback table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHUBDM003'];
        }else{
            $this->db->trans_commit();
            echo json_encode(['result' => 'SUCCESS', 'msg' => "Data Inserted Successfully"]);
        }
    }

}
?>
