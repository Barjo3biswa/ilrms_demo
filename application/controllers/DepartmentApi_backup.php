<?php
class DepartmentApi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper(array('form', 'url', 'security'));
    }


    public function dbswitch2($dist_code)
    {
        if ($dist_code == "02") {
            $this->db2 = $this->load->database('dhubri', TRUE);
        } else if ($dist_code == "05") {
            $this->db2 = $this->load->database('barpeta', TRUE);
        } else if ($dist_code == "10") {
            $this->db2 = $this->load->database('chirang', TRUE);
        } else if ($dist_code == "13") {
            $this->db2 = $this->load->database('bongaigaon', TRUE);
        } else if ($dist_code == "17") {
            $this->db2 = $this->load->database('dibrugarh', TRUE);
        } else if ($dist_code == "15") {
            $this->db2 = $this->load->database('jorhat', TRUE);
        } else if ($dist_code == "14") {
            $this->db2 = $this->load->database('golaghat', TRUE);
        } else if ($dist_code == "07") {
            $this->db2 = $this->load->database('kamrup', TRUE);
        } else if ($dist_code == "03") {
            $this->db2 = $this->load->database('goalpara', TRUE);
        } else if ($dist_code == "18") {
            $this->db2 = $this->load->database('tinsukia', TRUE);
        } else if ($dist_code == "12") {
            $this->db2 = $this->load->database('lakhimpur', TRUE);
        } else if ($dist_code == "24") {
            $this->db2 = $this->load->database('kamrupm', TRUE);
        } else if ($dist_code == "06") {
            $this->db2 = $this->load->database('nalbari', TRUE);
        } else if ($dist_code == "11") {
            $this->db2 = $this->load->database('sonitpur', TRUE);
        } else if ($dist_code == "16") {
            $this->db2 = $this->load->database('sibsagar', TRUE);
        } else if ($dist_code == "32") {
            $this->db2 = $this->load->database('morigaon', TRUE);
        } else if ($dist_code == "33") {
            $this->db2 = $this->load->database('nagaon', TRUE);
        } else if ($dist_code == "34") {
            $this->db2 = $this->load->database('majuli', TRUE);
        } else if ($dist_code == "21") {
            $this->db2 = $this->load->database('karimganj', TRUE);
        } else if ($dist_code == "35") {
            $this->db2 = $this->load->database('biswanath', TRUE);
        } else if ($dist_code == "36") {
            $this->db2 = $this->load->database('hojai', TRUE);
        } else if ($dist_code == "37") {
            $this->db2 = $this->load->database('charaideo', TRUE);
        } else if ($dist_code == "25") {
            $this->db2 = $this->load->database('dhemaji', TRUE);
        } else if ($dist_code == "39") {
            $this->db2 = $this->load->database('bajali', TRUE);
        } else if ($dist_code == "38") {
            $this->db2 = $this->load->database('ssalmara', TRUE);
        } else if ($dist_code == "08") {
            $this->db2 = $this->load->database('darrang', TRUE);
        } else if ($dist_code == "auth") {
            $this->db2 = $this->load->database('auth', TRUE);
        }
        return $this->db2;
    }


    // Insert User from Dharitree
    public function postDepartmentUser()
    {
        
        log_message('error', 'UserCreationApiHitLive, posted data from dharitree'.json_encode($_POST));       
        $this->db = $this->load->database('db2', TRUE);
        $name = $_POST['name'];
        $mobile_no = $_POST['mobile_no'];
        $unique_user_id = $_POST['user_name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $dist_code = $_POST['dist_code'];
        $subdiv_code = $_POST['subdiv_code'];
        $cir_code = $_POST['cir_code'];
        $mouza_pargona_code = $_POST['mouza_pargona_code'];
        $password = 'qwe@123';
        $user_code = $_POST['user_code'];
        $designation = $_POST['designation'];
        $lot_no = $_POST['lot_no'];

        //checking if user already exits or not 
        if ($designation != 'SDLC')
        {
            $sql = "select count(*) as c from user_dist_byforcation where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?";	
                $query = $this->db->query($sql,array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
            $user_count = $query->row()->c;
            if($user_count > 0){
                echo json_encode(['result' => 'USER_EXISTS', 'msg' => 'User Already Exists..!']);
                    exit; 
            }
        }
        $sql = "select count(*) as c from depart_users where unique_user_id=?";   
                $query = $this->db->query($sql,array($unique_user_id));
        $user_count = $query->row()->c;
        if($user_count > 0){
            echo json_encode(['result' => 'USER_EXISTS', 'msg' => 'User Already Exists..!']);
            exit; 
        }

        $this->db->trans_begin();
        // Insert into depart_users
        $query = [
            'name' => $name,
            'designation' => $designation,
            'date_of_joining' => date('Y-m-d h:i:s'),
            'password' =>  hash('sha512', $password),
            'unique_user_id' => $unique_user_id,
            'active_deactive' => 'E',
            'first_login' => '0',
            'status' => 'E',
            'mobile_no' => $mobile_no,
            'email' => $email,
            'address' => $address,
            'user_code' => $user_code,
        ];
        $insertUser = $this->db->insert('depart_users', $query);
        $last_insert_id = $this->db->insert_id();

        if ($insertUser <= 0) {
            $this->db->trans_rollback();
            log_message('error', '#ERRDU01: Insert failed in depart_users');
            echo json_encode(['result' => 'N', 'msg' => 'Some error occured, Error-Code : #ERRDU01']);
            exit;
        }
        // Insert into user_dist_byforcation
        $insertArr = [ 
            'unique_user_id' =>  $last_insert_id,
            'user_code' => $user_code,
            'dist_code' =>  $dist_code,
            'subdiv_code' =>  $subdiv_code,
            'cir_code' =>  $cir_code,
            'mouza_pargona_code' =>  $mouza_pargona_code,
            'lot_no' => $lot_no,
        ];
        $insertDept = $this->db->insert('user_dist_byforcation', $insertArr);
        if ($insertDept != 1) {
            $this->db->trans_rollback();
            log_message('error', '#ERRUDB01: Insertion failed in user_dist_byforcation');
	    echo json_encode(['result' => 'N', 'msg' => 'Some error occured, Error-Code : #ERRUDB01']);
            exit;
        } else {
            $this->db->trans_commit();
            $json = [
                'result' => 'Y',
                'msg' => 'User Created Successfully',
            ];
            echo json_encode($json);
        }
    }


    // View Details From All Table

    function getAllSettlementDetails()
    {

        $application_no = $_GET['application_no'];

        // $sql = "Select * from applications where application_no='$application_no' ";
        // $result = $this->db->query($sql)->row_array();

        // $dist_code = $result['dist_code'];
        // $case_no = $result['case_no'];

        $dist_code = '07';

        // Switch DB based on District Get from Application No
        $this->db2 = $this->dbswitch2($dist_code);

        // Get Case_no against RTPS No from basundhar_application
        $basundhar_application = "Select dharitree from basundhar_application where basundhara='$application_no'";
        $basundhar_application_result = $this->db2->query($basundhar_application)->row_array();
        $case_no = $basundhar_application_result['dharitree'];

        // Get From Settlement Applicant
        $settlement_applicant = "select * from settlement_applicant where case_no = '$case_no'";
        $settlement_applicant_result = $this->db2->query($settlement_applicant)->result_array();

        // Get From Settlement Basic
        $settlement_basic = "select * from settlement_basic where case_no = '$case_no'";
        $settlement_basic_result = $this->db2->query($settlement_basic)->result_array();

        // Get From Settlement Dag Details
        $settlement_dag_details = "select * from settlement_dag_details where case_no = '$case_no'";
        $settlement_dag_details_result = $this->db2->query($settlement_dag_details)->result_array();

        // Get From Settlement AP LM Note
        $settlement_ap_lm = "select * from settlement_proceeding where case_no = '$case_no'";
        $settlement_ap_lm_result = $this->db2->query($settlement_ap_lm)->result_array();

        // Get From Settlement Proceeding
        $settlement_proceeding = "select * from settlement_proceeding where case_no = '$case_no'";
        $settlement_proceeding_result = $this->db2->query($settlement_proceeding)->result_array();

        // Get From Settlement Premium
        $settlement_premium = "select * from settlement_premium where case_no = '$case_no'";
        $settlement_premium_result = $this->db2->query($settlement_premium)->result_array();

        // Get From Settlement Reservation
        $settlement_reservation = "select * from settlement_reservation where case_no = '$case_no'";
        $settlement_reservation_result = $this->db2->query($settlement_reservation)->result_array();

        $json = [
            'settlement_applicant' => $settlement_applicant_result,
            'settlement_basic' => $settlement_basic_result,
            'settlement_dag_details' => $settlement_dag_details_result,
            'settlement_ap_lmnote' => $settlement_ap_lm_result,
            'settlement_proceeding' => $settlement_proceeding_result,
            'settlement_premium' => $settlement_premium_result,
            'settlement_reservation' => $settlement_reservation_result,
        ];
        echo  json_encode($json);
    }



    function changePasswordIlrms()
    {
        log_message('error', 'PasswordChangeApiHitLive, posted data from dharitree'.json_encode($_POST));       

        $unique_user_id = $_POST['unique_user_id'];
        $password = $_POST['password'];

        $this->db = $this->load->database('db2', TRUE);
        $update = [
            'password' =>  hash('sha512', $password),
            'first_login'=> 1,
            'password_change'=> date('Y-m-d H:i:s'),
        ];
        $this->db->where('unique_user_id', $unique_user_id);
        $depart_users_update = $this->db->update('depart_users', $update);

        if($this->db->affected_rows() == 1 && $depart_users_update == true)
			{
            echo json_encode(['result' => 'Update Successfull in depart_users', 'msg' => 'Password Changes Successfully in ILRMS']);
			}
			else
			{
            echo json_encode(['result' => 'N', 'msg' => 'Password Changes Failed in ILRMS']);
            exit;
			}
    }
}
