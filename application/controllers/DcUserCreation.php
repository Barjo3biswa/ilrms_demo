<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DcUserCreation extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url', 'security'));
		$this->db = $this->load->database('db2', TRUE);
		$this->dbb = $this->load->database('auth', true);
		//checkLogin();
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


    	//Create DC User
	public function createDCUser(){

		$data['_view'] = 'user/create_dc_user_profile';
		$this->load->view('layouts/main',$data);
	}

    public function createDCUserProfileSave_old() 
    {

        $dist_code = $this->input->post('dist_code');

        $phone_no = $this->input->post('phone_no');
        $user_desig_code = 'DC';
        $role='5';
        $desig='District Commissioner';

        $name = $this->input->post('name');

        $date_of_joining = $this->input->post('date_of_joining');
        $user_name = $this->input->post('user_name');
        $type = $this->input->post('type');
        $date_o_j = date('Y-m-d', strtotime($date_of_joining));
        $new_pass = $this->input->post('new_password');

        $date=date('Y-m-d');

        if($this->form_validation->run('dc_profile_creation_validation') === true) 
        {
            $this->db2 =  $this->dbswitch2($dist_code);
            $this->dbb=$this->load->database('auth', TRUE);
            $this->dbbb=$this->load->database('nocmaster', TRUE);

            //Check for username existance
            $q = "Select count(*) as c from loginuser_table where use_name LIKE '%$user_name%'";
            $c = $this->db2->query($q)->row()->c;

            $r = "Select count(*) as c from user1 where usnm LIKE '%$user_name%'";
            $d = $this->db2->query($r)->row()->c;

            $this->dbbb=$this->load->database('nocmaster', TRUE);
            $s = "Select count(*) as c from user1 where usnm LIKE '%$user_name%'";
            $e = $this->dbbb->query($s)->row()->c;


            $existingDC = $this->db2->query("select user_code from loginuser_table where dist_code ='$dist_code' and user_code like 'DC%' and dis_enb_option ='E'")->row();
            $oldDcUserCode = $existingDC->user_code;
            // var_dump($oldDcUserCode);die;


            if ($c > 0 || $d > 0 || $e > 0)
            {
                $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">****************Username Already Exist. Please enter other Username ************</div>');
                return redirect('dc_profile_creation');
            }
            else
            {
                    for ($i = 1; $i < 100; $i++) 
            {
                    $user_code = "$user_desig_code" . +$i;
                    $existance = $this->db2->query("select count(user_code) as d from users where dist_code = '$dist_code' and user_code = '$user_code'")->row()->d;
                    if ($existance == '0') {
                        break;
                    }
            }
            $user_code_for_users = $user_code;
            
            $users = array(
                'dist_code' => $dist_code,
                'subdiv_code' => '00',
                'cir_code' => '00',
                'username' => $name,
                'user_code' => $user_code_for_users,
                'user_desig_code' => $user_desig_code,
                'status' => $type,
                'date_from' => $date_o_j,
                // 'date_to' => $date_o_r,
                'phone_no' => $phone_no
                );

            $this->db2->trans_begin();
            $this->dbb->trans_begin();
            $this->dbbb->trans_begin();

            $insertUsers = $this->db2->insert('users', $users);

            if ($insertUsers != TRUE) {
                $this->db2->trans_rollback();
                $this->dbb->trans_rollback();
                $this->dbbb->trans_rollback();
                log_message('error', '#ERRINSERTUSERS: Insertion failed in users table');
                log_message('error', $this->db2->last_query());

                $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTUSERS: User Creation Failed</div>');
                return redirect('dc_profile_creation');
            }
            else
            {
                if($user_desig_code=='DC')
                {
                    $sql="update loginuser_table set dis_enb_option='D',nocuser=null,user_map='n' where dis_enb_option='E' and user_code like 'DC%'  ";
                    $this->db2->query($sql);

                    $loginuser_table = array(
                    'use_name' => $user_name,
                    'user_code' => $user_code_for_users,
                    'priv' => 'adm',
                    'date_of_creation' => date('Y-m-d'),
                    'dis_enb_option' => 'E',
                    'first_login' => 'Y',
                    'activity' => '1',
                    'dist_code' => $dist_code,
                    'subdiv_code' => '00',
                    'cir_code' => '00',
                    'mouza_pargona_code' => '00',
                    'lot_no' => '00',
                    'password' => md5(($new_pass)),
                    'nocuser'=> $user_name,
                    'user_map'=>'y'
                    );

                    $insertLoginUser = $this->db2->insert('loginuser_table', $loginuser_table);
                    if ($insertLoginUser != TRUE) {
                        $this->db2->trans_rollback();
                        $this->dbb->trans_rollback();
                        $this->dbbb->trans_rollback();
                        log_message('error', '#ERRINSERTLOGINUSERS: Insertion failed in loginuser_table table');
                        log_message('error', $this->db2->last_query());

                        $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTLOGINUSERS: User Creation Failed</div>');
                        return redirect('dc_profile_creation');
                    }
                    else
                    {
                            $user1 = array(
                                'usnm' => $user_name,
                                'desig' => $desig,
                                'dt_from' => date('Y-m-d'),
                                'dt_to' => date('Y-m-d'),
                                'nameoff' => $user_name,
                                'distcode' => $dist_code,
                                'subdivcode' => '00',
                                'circlecode' => '00',
                                'mouzacode' => '00',
                                'lotno' => '00',
                                'usroll'=>$role,
                                'userstat'=>'A',
                                'passwd' => md5(($new_pass)),
                                'user_map'=>'y',
                                'dispstatus'=>'N'
                                );

                            $user1_nocmaster = array(
                                'usnm' => $user_name,
                                'desig' => $desig,
                                'dt_from' => date('Y-m-d'),
                                'dt_to' => date('Y-m-d'),
                                'nameoff' => $user_name,
                                'distcode' => $dist_code,
                                'subdivcode' => '00',
                                'circlecode' => '00',
                                'mouzacode' => '00',
                                'lotno' => '00',
                                'usroll'=>$role,
                                'userstat'=>'A',
                                'passwd' => md5(($new_pass)),
                                'user_map'=>'y',
                                'dispstatus'=>'N',
                                'dharitree_user' => $user_name
                                );

                            $sql="update user1 set userstat='D',dt_to='$date' where userstat='A' and usroll='5'  ";
                            $updateUser1 = $this->db2->query($sql);
                            if ($updateUser1 != TRUE) {
                                $this->db2->trans_rollback();
                                $this->dbb->trans_rollback();
                                $this->dbbb->trans_rollback();
                                log_message('error', '#ERRUPDATEUSER1: Updation failed in user1 table');
                                log_message('error', $this->db2->last_query());
              
                                $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRUPDATEUSER1: User Creation Failed</div>');
                                return redirect('dc_profile_creation');
                            }
                            else
                            {
                                $updateUsers="update users set date_to='$date' where user_code='$oldDcUserCode'";
                                $updateUsersDate = $this->db2->query($updateUsers);

                                if($updateUsersDate != TRUE)
                                {
                                $this->db2->trans_rollback();
                                $this->dbb->trans_rollback();
                                $this->dbbb->trans_rollback();
                                log_message('error', '#ERRUPDATEUSERSDATE: Updation failed in users table');
                                log_message('error', $this->db2->last_query());
              
                                $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRUPDATEUSERSDATE: User Creation Failed</div>');
                                return redirect('dc_profile_creation');
                                }
                                else
                                {
                                    $nameoff=$user_name;
                                    $password=md5(($new_pass));
                                    $user_name=$user_name;
                                    $date=date('Y-m-d G:i:s');

                                    $sql="update user1 set userstat='D',dt_to='$date' where userstat='A' and usroll='5'  ";
                                    $updateNocMaster = $this->dbbb->query($sql);

                                    if ($updateNocMaster != TRUE) {
                                        $this->db2->trans_rollback();
                                        $this->dbb->trans_rollback();
                                        $this->dbbb->trans_rollback();
                                        log_message('error', '#ERRUPDATEUSER1NOCMASTER: Updation failed in user1 table NOC MAster');
                                        log_message('error', $this->dbbb->last_query());
                    
                                        $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRUPDATEUSER1NOCMASTER: User Creation Failed</div>');
                                        return redirect('dc_profile_creation');
                                    }
                                    else
                                    {
                                        $insertUserTable1 = $this->db2->insert('user1', $user1);

                                        if ($insertUserTable1 != TRUE) {
                                            $this->db2->trans_rollback();
                                            $this->dbb->trans_rollback();
                                            $this->dbbb->trans_rollback();
                                            log_message('error', '#ERRINSERTUSER1: Insert failed in user1 table');
                                            log_message('error', $this->db2->last_query());
                            
                                            $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTUSER1: User Creation Failed</div>');
                                            return redirect('dc_profile_creation');
                                        }
                                        else
                                        {
                                        $insertNocMaster =$this->dbbb->insert('user1', $user1_nocmaster);

                                            if ($insertNocMaster != TRUE) {
                                                $this->db2->trans_rollback();
                                                $this->dbb->trans_rollback();
                                                $this->dbbb->trans_rollback();
                                                log_message('error', '#ERRINSERTUSER1NOCMASTER: Insert failed in user1 table in NOC Master');
                                                log_message('error', $this->dbbb->last_query());
                            
                                                $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTUSER1NOCMASTER: User Creation Failed</div>');
                                                return redirect('dc_profile_creation');
                                            }
                                            else
                                            {
                                                $central_auth = array(
                                                    'dhar_user'=>$user_name,
                                                    'dhar_code'=>$user_code_for_users,
                                                    'noc_user'=>$user_name,
                                                    'noc_roll'=>$role,
                                                    'active_deactive'=>'E',
                                                    'mobile'=>$phone_no,
                                                    'dist_code'=>$dist_code,
                                                    'subdiv_code'=>'00',
                                                    'cir_code'=>'00',
                                                    'mouza_pargona_code'=>'00',
                                                    'lot_no'=>'00',
                                                    'password'=>md5(($new_pass)),
                                                    'prev_password1'=>md5(($new_pass)),
                                                    'mapped_by'=>$this->session->userdata('name'),
                                                    'date_of_map'=>date('Y-m-d'),
                                                    'unique_user_id'=>$user_name,
                                                    'full_name'=>$name,
                                                    'desgination'=>$desig,
                                                    'password_change_flag'=>0
                                                );


                                                // $this->dbb=$this->load->database('auth', TRUE);

                                                $sql="update central_auth set active_deactive='D',date_of_map='$date' where noc_roll='5' and dist_code='$dist_code'  ";

                                                $updateCentralAuth = $this->dbb->query($sql);

                                                if ($updateCentralAuth != TRUE) {
                                                    $this->db2->trans_rollback();
                                                    $this->dbb->trans_rollback();
                                                    $this->dbbb->trans_rollback();
                                                    log_message('error', '#ERRUPDATECENTRALAUTH: Update failed in central_auth table');
                                                    log_message('error', $this->dbb->last_query());
                                    
                                                    $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRUPDATECENTRALAUTH: User Creation Failed</div>');
                                                    return redirect('dc_profile_creation');
                                                }
                                                else
                                                {
                                                    $insertCentralAuth = $this->dbb->insert('central_auth', $central_auth);

                                                    if ($insertCentralAuth != TRUE) {
                                                        $this->db2->trans_rollback();
                                                        $this->dbb->trans_rollback();
                                                        $this->dbbb->trans_rollback();
                                                        log_message('error', '#ERRINSERTCENTRALAUTH: Insert failed in central_auth table');
                                                        log_message('error', $this->dbb->last_query());
                                        
                                                        $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTCENTRALAUTH: User Creation Failed</div>');
                                                        return redirect('dc_profile_creation');
                                                    }
                                                    else
                                                    {
                                                        $this->db2->trans_commit();
                                                        $this->dbb->trans_commit();
                                                        $this->dbbb->trans_commit();
                                                        $this->session->set_flashdata('alert_msg','<div class="alert alert-success">New DC User Successfully Created for ' . $this->utilclass->getDistrictNameOnLanding($dist_code). ' District</div>');
                                                        return redirect('dc_profile_creation');
                                                    }
                                                }

                                            }
                                        
                                            
                                        }

                                    }
                                }

                            }
                    }

                }
            }
            }
        }
        else
        {
			$this->createDCUser();
        }
    }


    public function bcryptPassWord($plain_text)
    {
        $options = [
            'cost' => 12,
        ];
        $enc_pass = password_hash($plain_text, PASSWORD_BCRYPT, $options);
        return $enc_pass;
    }



    public function getvalidusernameSadm() {

        $_POST = json_decode(file_get_contents("php://input"), true);

        $dist_code     = $this->input->post('district_id');
        $username = $this->input->post('newusername');

        if($dist_code != NULL || $dist_code != "")
        {
            $this->db2 =  $this->dbswitch2($dist_code);

            $q = "Select count(*) as c from loginuser_table where use_name LIKE '%$username%'";
            $c = $this->db2->query($q)->row()->c;

            $r = "Select count(*) as c from user1 where usnm LIKE '%$username%'";
            $d = $this->db2->query($r)->row()->c;

            $this->dbbb=$this->load->database('nocmaster', TRUE);
            $s = "Select count(*) as c from user1 where usnm LIKE '%$username%'";
            $e = $this->dbbb->query($s)->row()->c;

            if ($c > 0 || $d > 0 || $e > 0)
            {
                echo json_encode(array(
                    'responseType' => 3,
                    'message' => 'Username Already Exist !!! Please Enter Other Name',
                ));
            }
            else
            {
                echo json_encode(array(
                    'responseType' => 2,
                    'message' => 'Username Not Exist',
                ));
            }
        }
        else
        {
            echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'Please Select District before Proceed !!!',
                ));
        }
        
    }


    //Modified
    public function createDCUserProfileSave() 
    {

        $dist_code = $this->input->post('dist_code');

        $phone_no = $this->input->post('phone_no');
        $user_desig_code = 'DC';
        $role='5';
        $desig='District Commissioner';

        $name = $this->input->post('name');

        $date_of_joining = $this->input->post('date_of_joining');
        $user_name = $this->input->post('user_name');
        $type = $this->input->post('type');
        $date_o_j = date('Y-m-d', strtotime($date_of_joining));
        $new_pass = $this->input->post('new_password');

        $date=date('Y-m-d');

        if($this->form_validation->run('dc_profile_creation_validation') === true) 
        {
            $this->db2 =  $this->dbswitch2($dist_code);
            $this->dbb=$this->load->database('auth', TRUE);
            $this->dbbb=$this->load->database('nocmaster', TRUE);

            //Check for username existance
            $q = "Select count(*) as c from loginuser_table where use_name LIKE '%$user_name%'";
            $c = $this->db2->query($q)->row()->c;

            $r = "Select count(*) as c from user1 where usnm LIKE '%$user_name%'";
            $d = $this->db2->query($r)->row()->c;

            $s = "Select count(*) as c from user1 where usnm LIKE '%$user_name%'";
            $e = $this->dbbb->query($s)->row()->c;


            $existingDC = $this->db2->query("select user_code from loginuser_table where dist_code ='$dist_code' and user_code like 'DC%' and dis_enb_option ='E'")->row();
            $oldDcUserCode = $existingDC->user_code;


            if ($c > 0 || $d > 0 || $e > 0)
            {
                $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">****************Username Already Exist. Please enter other Username ************</div>');
                return redirect('dc_profile_creation');
            }
            else
            {
                for ($i = 1; $i < 100; $i++) 
                    {
                            $user_code = "$user_desig_code" . +$i;
                            $existance = $this->db2->query("select count(user_code) as d from users where dist_code = '$dist_code' and user_code = '$user_code'")->row()->d;
                            if ($existance == '0') 
                            {
                                break;
                            }
                    }
                $user_code_for_users = $user_code;
                
                $users = array(
                    'dist_code' => $dist_code,
                    'subdiv_code' => '00',
                    'cir_code' => '00',
                    'username' => $name,
                    'user_code' => $user_code_for_users,
                    'user_desig_code' => $user_desig_code,
                    'status' => $type,
                    'date_from' => $date_o_j,
                    // 'date_to' => $date_o_r,
                    'phone_no' => $phone_no
                    );

                $this->db2->trans_begin();
                $this->dbb->trans_begin();
                $this->dbbb->trans_begin();

                $insertUsers = $this->db2->insert('users', $users);

                if ($insertUsers != TRUE) {
                    $this->db2->trans_rollback();
                    $this->dbb->trans_rollback();
                    $this->dbbb->trans_rollback();
                    log_message('error', '#ERRINSERTUSERS: Insertion failed in users table');
                    log_message('error', $this->db2->last_query());

                    $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTUSERS: User Creation Failed</div>');
                    return redirect('dc_profile_creation');
                }
                else
                {
                        $sql="update loginuser_table set dis_enb_option='D',nocuser=null,user_map='n' where dis_enb_option='E' and user_code like 'DC%'  ";
                        $this->db2->query($sql);

                        $loginuser_table = array(
                        'use_name' => $user_name,
                        'user_code' => $user_code_for_users,
                        'priv' => 'adm',
                        'date_of_creation' => date('Y-m-d'),
                        'dis_enb_option' => 'E',
                        'first_login' => 'Y',
                        'activity' => '1',
                        'dist_code' => $dist_code,
                        'subdiv_code' => '00',
                        'cir_code' => '00',
                        'mouza_pargona_code' => '00',
                        'lot_no' => '00',
                        'password' => md5(($new_pass)),
                        'nocuser'=> $user_name,
                        'user_map'=>'y'
                        );

                        $insertLoginUser = $this->db2->insert('loginuser_table', $loginuser_table);
                        if ($insertLoginUser != TRUE) {
                            $this->db2->trans_rollback();
                            $this->dbb->trans_rollback();
                            $this->dbbb->trans_rollback();
                            log_message('error', '#ERRINSERTLOGINUSERS: Insertion failed in loginuser_table table');
                            log_message('error', $this->db2->last_query());

                            $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTLOGINUSERS: User Creation Failed</div>');
                            return redirect('dc_profile_creation');
                        }
                        else
                        {
                                $user1 = array(
                                    'usnm' => $user_name,
                                    'desig' => $desig,
                                    'dt_from' => date('Y-m-d'),
                                    'dt_to' => date('Y-m-d'),
                                    'nameoff' => $user_name,
                                    'distcode' => $dist_code,
                                    'subdivcode' => '00',
                                    'circlecode' => '00',
                                    'mouzacode' => '00',
                                    'lotno' => '00',
                                    'usroll'=>$role,
                                    'userstat'=>'A',
                                    'passwd' => md5(($new_pass)),
                                    'user_map'=>'y',
                                    'dispstatus'=>'N'
                                    );

                                $user1_nocmaster = array(
                                    'usnm' => $user_name,
                                    'desig' => $desig,
                                    'dt_from' => date('Y-m-d'),
                                    'dt_to' => date('Y-m-d'),
                                    'nameoff' => $user_name,
                                    'distcode' => $dist_code,
                                    'subdivcode' => '00',
                                    'circlecode' => '00',
                                    'mouzacode' => '00',
                                    'lotno' => '00',
                                    'usroll'=>$role,
                                    'userstat'=>'A',
                                    'passwd' => md5(($new_pass)),
                                    'user_map'=>'y',
                                    'dispstatus'=>'N',
                                    'dharitree_user' => $user_name
                                    );

                                $sql = "select * from user1 where userstat= 'A' and usroll='5' ";
                                $query = $this->db2->query($sql);
                                $num_rows = $query->num_rows();
                                if($num_rows <= 0)
                                {

                                    $updateUsers="update users set date_to='$date' where user_code='$oldDcUserCode'";
                                    $updateUsersDate = $this->db2->query($updateUsers);

                                    if($updateUsersDate != TRUE)
                                    {
                                    $this->db2->trans_rollback();
                                    $this->dbb->trans_rollback();
                                    $this->dbbb->trans_rollback();
                                    log_message('error', '#ERRUPDATEUSERSDATE: Updation failed in users table');
                                    log_message('error', $this->db2->last_query());
                
                                    $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRUPDATEUSERSDATE: User Creation Failed</div>');
                                    return redirect('dc_profile_creation');
                                    }
                                    else
                                    {
                                        $nameoff=$user_name;
                                        $password=md5(($new_pass));
                                        $user_name=$user_name;
                                        $date=date('Y-m-d G:i:s');

                                        $sql="update user1 set userstat='D',dt_to='$date' where userstat='A' and usroll='5'  ";
                                        $updateNocMaster = $this->dbbb->query($sql);

                                        if ($updateNocMaster != TRUE) {
                                            $this->db2->trans_rollback();
                                            $this->dbb->trans_rollback();
                                            $this->dbbb->trans_rollback();
                                            log_message('error', '#ERRUPDATEUSER1NOCMASTER: Updation failed in user1 table NOC MAster');
                                            log_message('error', $this->dbbb->last_query());
                        
                                            $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRUPDATEUSER1NOCMASTER: User Creation Failed</div>');
                                            return redirect('dc_profile_creation');
                                        }
                                        else
                                        {
                                            $insertUserTable1 = $this->db2->insert('user1', $user1);

                                            if ($insertUserTable1 != TRUE) {
                                                $this->db2->trans_rollback();
                                                $this->dbb->trans_rollback();
                                                $this->dbbb->trans_rollback();
                                                log_message('error', '#ERRINSERTUSER1: Insert failed in user1 table');
                                                log_message('error', $this->db2->last_query());
                                
                                                $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTUSER1: User Creation Failed</div>');
                                                return redirect('dc_profile_creation');
                                            }
                                            else
                                            {
                                            $insertNocMaster =$this->dbbb->insert('user1', $user1_nocmaster);

                                                if ($insertNocMaster != TRUE) {
                                                    $this->db2->trans_rollback();
                                                    $this->dbb->trans_rollback();
                                                    $this->dbbb->trans_rollback();
                                                    log_message('error', '#ERRINSERTUSER1NOCMASTER: Insert failed in user1 table in NOC Master');
                                                    log_message('error', $this->dbbb->last_query());
                                
                                                    $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTUSER1NOCMASTER: User Creation Failed</div>');
                                                    return redirect('dc_profile_creation');
                                                }
                                                else
                                                {
                                                    $central_auth = array(
                                                        'dhar_user'=>$user_name,
                                                        'dhar_code'=>$user_code_for_users,
                                                        'noc_user'=>$user_name,
                                                        'noc_roll'=>$role,
                                                        'active_deactive'=>'E',
                                                        'mobile'=>$phone_no,
                                                        'dist_code'=>$dist_code,
                                                        'subdiv_code'=>'00',
                                                        'cir_code'=>'00',
                                                        'mouza_pargona_code'=>'00',
                                                        'lot_no'=>'00',
                                                        'password'=>md5(($new_pass)),
                                                        'prev_password1'=>md5(($new_pass)),
                                                        'mapped_by'=>$this->session->userdata('name'),
                                                        'date_of_map'=>date('Y-m-d'),
                                                        'unique_user_id'=>$user_name,
                                                        'full_name'=>$name,
                                                        'desgination'=>$desig,
                                                        'password_change_flag'=>0
                                                    );

                                                    $sql="update central_auth set active_deactive='D',date_of_map='$date' where noc_roll='5' and dist_code='$dist_code'  ";

                                                    $updateCentralAuth = $this->dbb->query($sql);

                                                    if ($updateCentralAuth != TRUE) {
                                                        $this->db2->trans_rollback();
                                                        $this->dbb->trans_rollback();
                                                        $this->dbbb->trans_rollback();
                                                        log_message('error', '#ERRUPDATECENTRALAUTH: Update failed in central_auth table');
                                                        log_message('error', $this->dbb->last_query());
                                        
                                                        $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRUPDATECENTRALAUTH: User Creation Failed</div>');
                                                        return redirect('dc_profile_creation');
                                                    }
                                                    else
                                                    {
                                                        $insertCentralAuth = $this->dbb->insert('central_auth', $central_auth);

                                                        if ($insertCentralAuth != TRUE) {
                                                            $this->db2->trans_rollback();
                                                            $this->dbb->trans_rollback();
                                                            $this->dbbb->trans_rollback();
                                                            log_message('error', '#ERRINSERTCENTRALAUTH: Insert failed in central_auth table');
                                                            log_message('error', $this->dbb->last_query());
                                            
                                                            $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTCENTRALAUTH: User Creation Failed</div>');
                                                            return redirect('dc_profile_creation');
                                                        }
                                                        else
                                                        {
                                                            $this->db2->trans_commit();
                                                            $this->dbb->trans_commit();
                                                            $this->dbbb->trans_commit();
                                                            $this->session->set_flashdata('alert_msg','<div class="alert alert-success">New DC User Successfully Created for ' . $this->utilclass->getDistrictNameOnLanding($dist_code). ' District</div>');
                                                            return redirect('dc_profile_creation');
                                                        }
                                                    }

                                                }
                                            
                                                
                                            }

                                        }
                                    }
                                }
                                
                                else

                                {
                                $sql="update user1 set userstat='D',dt_to='$date' where userstat='A' and usroll='5'  ";
                                $updateUser1 = $this->db2->query($sql);
                                if ($updateUser1 != TRUE) {
                                    $this->db2->trans_rollback();
                                    $this->dbb->trans_rollback();
                                    $this->dbbb->trans_rollback();
                                    log_message('error', '#ERRUPDATEUSER1: Updation failed in user1 table');
                                    log_message('error', $this->db2->last_query());
                
                                    $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRUPDATEUSER1: User Creation Failed</div>');
                                    return redirect('dc_profile_creation');
                                }
                                else
                                {
                                    $updateUsers="update users set date_to='$date' where user_code='$oldDcUserCode'";
                                    $updateUsersDate = $this->db2->query($updateUsers);

                                    if($updateUsersDate != TRUE)
                                    {
                                    $this->db2->trans_rollback();
                                    $this->dbb->trans_rollback();
                                    $this->dbbb->trans_rollback();
                                    log_message('error', '#ERRUPDATEUSERSDATE: Updation failed in users table');
                                    log_message('error', $this->db2->last_query());
                
                                    $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRUPDATEUSERSDATE: User Creation Failed</div>');
                                    return redirect('dc_profile_creation');
                                    }
                                    else
                                    {
                                        $nameoff=$user_name;
                                        $password=md5(($new_pass));
                                        $user_name=$user_name;
                                        $date=date('Y-m-d G:i:s');


                                        $sql = "select * from user1 where userstat= 'A' and usroll='5' ";
                                        $query = $this->dbbb->query($sql);
                                        $num_rows = $query->num_rows();
                                        if($num_rows <= 0)
                                        {
                                            
                                            $insertUserTable1 = $this->db2->insert('user1', $user1);

                                            if ($insertUserTable1 != TRUE) {
                                                $this->db2->trans_rollback();
                                                $this->dbb->trans_rollback();
                                                $this->dbbb->trans_rollback();
                                                log_message('error', '#ERRINSERTUSER1: Insert failed in user1 table');
                                                log_message('error', $this->db2->last_query());
                                
                                                $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTUSER1: User Creation Failed</div>');
                                                return redirect('dc_profile_creation');
                                            }
                                            else
                                            {
                                            $insertNocMaster =$this->dbbb->insert('user1', $user1_nocmaster);

                                                if ($insertNocMaster != TRUE) {
                                                    $this->db2->trans_rollback();
                                                    $this->dbb->trans_rollback();
                                                    $this->dbbb->trans_rollback();
                                                    log_message('error', '#ERRINSERTUSER1NOCMASTER: Insert failed in user1 table in NOC Master');
                                                    log_message('error', $this->dbbb->last_query());
                                
                                                    $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTUSER1NOCMASTER: User Creation Failed</div>');
                                                    return redirect('dc_profile_creation');
                                                }
                                                else
                                                {
                                                    $central_auth = array(
                                                        'dhar_user'=>$user_name,
                                                        'dhar_code'=>$user_code_for_users,
                                                        'noc_user'=>$user_name,
                                                        'noc_roll'=>$role,
                                                        'active_deactive'=>'E',
                                                        'mobile'=>$phone_no,
                                                        'dist_code'=>$dist_code,
                                                        'subdiv_code'=>'00',
                                                        'cir_code'=>'00',
                                                        'mouza_pargona_code'=>'00',
                                                        'lot_no'=>'00',
                                                        'password'=>md5(($new_pass)),
                                                        'prev_password1'=>md5(($new_pass)),
                                                        'mapped_by'=>$this->session->userdata('name'),
                                                        'date_of_map'=>date('Y-m-d'),
                                                        'unique_user_id'=>$user_name,
                                                        'full_name'=>$name,
                                                        'desgination'=>$desig,
                                                        'password_change_flag'=>0
                                                    );

                                                    $sql="update central_auth set active_deactive='D',date_of_map='$date' where noc_roll='5' and dist_code='$dist_code'  ";

                                                    $updateCentralAuth = $this->dbb->query($sql);

                                                    if ($updateCentralAuth != TRUE) {
                                                        $this->db2->trans_rollback();
                                                        $this->dbb->trans_rollback();
                                                        $this->dbbb->trans_rollback();
                                                        log_message('error', '#ERRUPDATECENTRALAUTH: Update failed in central_auth table');
                                                        log_message('error', $this->dbb->last_query());
                                        
                                                        $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRUPDATECENTRALAUTH: User Creation Failed</div>');
                                                        return redirect('dc_profile_creation');
                                                    }
                                                    else
                                                    {
                                                        $insertCentralAuth = $this->dbb->insert('central_auth', $central_auth);

                                                        if ($insertCentralAuth != TRUE) {
                                                            $this->db2->trans_rollback();
                                                            $this->dbb->trans_rollback();
                                                            $this->dbbb->trans_rollback();
                                                            log_message('error', '#ERRINSERTCENTRALAUTH: Insert failed in central_auth table');
                                                            log_message('error', $this->dbb->last_query());
                                            
                                                            $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTCENTRALAUTH: User Creation Failed</div>');
                                                            return redirect('dc_profile_creation');
                                                        }
                                                        else
                                                        {
                                                            $this->db2->trans_commit();
                                                            $this->dbb->trans_commit();
                                                            $this->dbbb->trans_commit();
                                                            $this->session->set_flashdata('alert_msg','<div class="alert alert-success">New DC User Successfully Created for ' . $this->utilclass->getDistrictNameOnLanding($dist_code). ' District</div>');
                                                            return redirect('dc_profile_creation');
                                                        }
                                                    }

                                                }
                                            
                                                
                                            }


                                        }
                                        else

                                        {
                                        $sql="update user1 set userstat='D',dt_to='$date' where userstat='A' and usroll='5'  ";
                                        $updateNocMaster = $this->dbbb->query($sql);

                                        if ($updateNocMaster != TRUE) {
                                            $this->db2->trans_rollback();
                                            $this->dbb->trans_rollback();
                                            $this->dbbb->trans_rollback();
                                            log_message('error', '#ERRUPDATEUSER1NOCMASTER: Updation failed in user1 table NOC MAster');
                                            log_message('error', $this->dbbb->last_query());
                        
                                            $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRUPDATEUSER1NOCMASTER: User Creation Failed</div>');
                                            return redirect('dc_profile_creation');
                                        }
                                        else
                                        {
                                            $insertUserTable1 = $this->db2->insert('user1', $user1);

                                            if ($insertUserTable1 != TRUE) {
                                                $this->db2->trans_rollback();
                                                $this->dbb->trans_rollback();
                                                $this->dbbb->trans_rollback();
                                                log_message('error', '#ERRINSERTUSER1: Insert failed in user1 table');
                                                log_message('error', $this->db2->last_query());
                                
                                                $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTUSER1: User Creation Failed</div>');
                                                return redirect('dc_profile_creation');
                                            }
                                            else
                                            {
                                            $insertNocMaster =$this->dbbb->insert('user1', $user1_nocmaster);

                                                if ($insertNocMaster != TRUE) {
                                                    $this->db2->trans_rollback();
                                                    $this->dbb->trans_rollback();
                                                    $this->dbbb->trans_rollback();
                                                    log_message('error', '#ERRINSERTUSER1NOCMASTER: Insert failed in user1 table in NOC Master');
                                                    log_message('error', $this->dbbb->last_query());
                                
                                                    $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTUSER1NOCMASTER: User Creation Failed</div>');
                                                    return redirect('dc_profile_creation');
                                                }
                                                else
                                                {
                                                    $central_auth = array(
                                                        'dhar_user'=>$user_name,
                                                        'dhar_code'=>$user_code_for_users,
                                                        'noc_user'=>$user_name,
                                                        'noc_roll'=>$role,
                                                        'active_deactive'=>'E',
                                                        'mobile'=>$phone_no,
                                                        'dist_code'=>$dist_code,
                                                        'subdiv_code'=>'00',
                                                        'cir_code'=>'00',
                                                        'mouza_pargona_code'=>'00',
                                                        'lot_no'=>'00',
                                                        'password'=>md5(($new_pass)),
                                                        'prev_password1'=>md5(($new_pass)),
                                                        'mapped_by'=>$this->session->userdata('name'),
                                                        'date_of_map'=>date('Y-m-d'),
                                                        'unique_user_id'=>$user_name,
                                                        'full_name'=>$name,
                                                        'desgination'=>$desig,
                                                        'password_change_flag'=>0
                                                    );

                                                    $sql="update central_auth set active_deactive='D',date_of_map='$date' where noc_roll='5' and dist_code='$dist_code'  ";

                                                    $updateCentralAuth = $this->dbb->query($sql);

                                                    if ($updateCentralAuth != TRUE) {
                                                        $this->db2->trans_rollback();
                                                        $this->dbb->trans_rollback();
                                                        $this->dbbb->trans_rollback();
                                                        log_message('error', '#ERRUPDATECENTRALAUTH: Update failed in central_auth table');
                                                        log_message('error', $this->dbb->last_query());
                                        
                                                        $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRUPDATECENTRALAUTH: User Creation Failed</div>');
                                                        return redirect('dc_profile_creation');
                                                    }
                                                    else
                                                    {
                                                        $insertCentralAuth = $this->dbb->insert('central_auth', $central_auth);

                                                        if ($insertCentralAuth != TRUE) {
                                                            $this->db2->trans_rollback();
                                                            $this->dbb->trans_rollback();
                                                            $this->dbbb->trans_rollback();
                                                            log_message('error', '#ERRINSERTCENTRALAUTH: Insert failed in central_auth table');
                                                            log_message('error', $this->dbb->last_query());
                                            
                                                            $this->session->set_flashdata('alert_msg','<div class="alert alert-danger">ERRINSERTCENTRALAUTH: User Creation Failed</div>');
                                                            return redirect('dc_profile_creation');
                                                        }
                                                        else
                                                        {
                                                            $this->db2->trans_commit();
                                                            $this->dbb->trans_commit();
                                                            $this->dbbb->trans_commit();
                                                            $this->session->set_flashdata('alert_msg','<div class="alert alert-success">New DC User Successfully Created for ' . $this->utilclass->getDistrictNameOnLanding($dist_code). ' District</div>');
                                                            return redirect('dc_profile_creation');
                                                        }
                                                    }

                                                }
                                            
                                                
                                            }

                                        }
                                    }

                                    }

                                }

                                }

                        }

                
                }
            }
        }
        else
        {
			$this->createDCUser();
        }
    }

}