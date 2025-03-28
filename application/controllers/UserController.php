<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		//$this->load->helper(array('form', 'url', 'security'));
		$this->load->helper(array('form', 'url', 'security'));
		$this->db = $this->load->database('db2', TRUE);
		$this->dbb = $this->load->database('auth', true);
		//checkLogin();
	}

	/////////CHECK DEPARTMENT Previous Password/////////
	function checkDepartPrePassword($pass)
	{
		$data = $this->db->query("select unique_user_id from depart_users where 
	    unique_user_id=? and password=?",array($this->session->userdata('unique_user_id'), $pass));
		if(isset($data))
		{
			if($data->num_rows() == 0)
			{
				$this->form_validation->set_message('checkDepartPrePassword', 'Old Password does not match.');
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			$this->form_validation->set_message('checkDepartPrePassword', 'Old Password does not match.');
			return false;
		}

	}

	/////////CHECK DEPARTMENT RE Password/////////
	function checkDepartRePassword($repass)
	{
		$new_pass = $this->input->post('new_password');
		if($new_pass != $repass)
		{
			$this->form_validation->set_message('checkDepartRePassword', 'New password and re-password does not match.');
			return false;
		}
		else
		{
			return true;
		}
	}

	////////////////////Department CHANGE PASSWORD////////////
	function dpartChangePassword()
	{
		$validateChangePassword = array(
			array(
				'field' => 'old_password',
				'label' => 'Old Password',
				'rules' => 'trim|required|xss_clean|callback_checkDepartPrePassword',
			),
			array(
				'field' => 'new_password',
				'label' => 'New Password',
				'rules' => 'trim|required|xss_clean|min_length[8]',
			),
			array(
				'field' => 're_password',
				'label' => 'Re-Password',
				'rules' => 'trim|required|xss_clean|min_length[8]|callback_checkDepartRePassword',
			),
		);

		if($this->session->userdata('designation') == GBURA){
			$bura = array(
				array(
					'field' => 'mobile_no',
					'label' => 'Mobile No',
					'rules' => 'required', 
				),
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required', 
				),
				array(
					'field' => 'address',
					'label' => 'Address',
					'rules' => 'required', 
				),
				array(
					'field' => 'mouza',
					'label' => 'Mouza',
					'rules' => 'required', 
				),
				array(
					'field' => 'lot',
					'label' => 'Lot',
					'rules' => 'required', 
				),
				array(
					'field' => 'village',
					'label' => 'Village',
					'rules' => 'required', 
				),



				array(
					'field' => 'dob',
					'label' => 'DOB',
					'rules' => 'required', 
				),
				array(
					'field' => 'date_of_eng',
					'label' => 'Date of engagement',
					'rules' => 'required', 
				),
				array(
					'field' => 'date_of_ret',
					'label' => 'Date of retirement',
					'rules' => 'required', 
				),
				array(
					'field' => 'edu_qua',
					'label' => 'Education Qualification',
					'rules' => 'required', 
				),

				array(
					'field' => 'remark',
					'label' => 'Remark',
					'rules' => 'required', 
				),

				array(
					'field' => 'fileText[]',
					'label' => 'Supporting Document Title',
					'rules' => 'required', 
				),
				array(
					'field' => 'fileUpload',
					'label' => 'Supporting Document',
					'rules' => 'callback_files_check', 
				),				
			);

			$nok = array(
				array(
					'field' => 'nok_name[]',
					'label' => 'nok_name',
					'rules' => 'required',
				),
				array(
					'field' => 'nok_address[]',
					'label' => 'nok_address',
					'rules' => 'required',
				),
				array(
					'field' => 'nok_relation[]',
					'label' => 'nok_relation',
					'rules' => 'required',
				),
				array(
					'field' => 'nok_mobile[]',
					'label' => 'nok_mobile',
					'rules' => 'required',
				),
			);

			if(isset($_POST['nok_name'])){
				$validateChangePassword = array_merge($validateChangePassword, $bura, $nok);
			}else{
				$validateChangePassword = array_merge($validateChangePassword, $bura);
			}
		}

		$this->db->trans_begin();
		
		$this->form_validation->set_rules($validateChangePassword);
		$data = null;
		if ($this->form_validation->run() === FALSE) {
			$this->form_validation->set_error_delimiters('', '');
			foreach ($validateChangePassword as $rule) {
				if (form_error($rule['field'])) {
					$data['error'][] = array('field' => $rule['field'], 'message' => form_error($rule['field']));
				}
			}
			echo json_encode($data);
			return;
		} else {
			if($this->session->userdata('designation') == GBURA){
				//update dist_by
				$location_concat = $this->input->post('village');
				$parts = explode('_', $location_concat);

				$mouza_pargona_code = $parts[3];
				$lot_no = $parts[4];
				$vill_townprt_code = $parts[5];

				$dist_by_arr = array(
					'mouza_pargona_code' => $mouza_pargona_code, 
					'lot_no' => $lot_no, 
					'vill_townprt_code' => $vill_townprt_code, 
				);

				$this->db->update('user_dist_byforcation', $dist_by_arr);
				$this->db->where('user_code', $this->session->userdata('user_code'));
				$this->db->where('unique_user_id', $this->session->userdata('unique_user_id'));

				if($this->db->affected_rows() != 1){
					$data['update'] = false;
				}
				
				//move uploaded supportive documents

				$get_IDSQL = $this->db->query('select id, name from depart_users where unique_user_id = ?', array($this->session->userdata('unique_user_id')));

				$user_ID = $get_IDSQL->row()->id;
				$user_NAME = $get_IDSQL->row()->name;

				$fileCount = count($_FILES['fileUpload']['name']);

				for($i = 0; $i < $fileCount; $i++)
				{
					$_FILES['file']['name'] = $_FILES['fileUpload']['name'][$i];
					$_FILES['file']['type'] = $_FILES['fileUpload']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['fileUpload']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['fileUpload']['error'][$i];
					$_FILES['file']['size'] = $_FILES['fileUpload']['size'][$i];

					$mime = mime_content_type($_FILES['fileUpload']['tmp_name'][$i]);
					$exp  = explode("/",$mime);
					$onlyExtension  = $exp[1];

					$fileRename =  $this->UUID4() . '.' . $onlyExtension;

					$config['upload_path']   = UPLOAD_DIR;
					$config['allowed_types'] = UPLOAD_ALLOW_TYPE;
					$config['max_size']  = UPLOAD_MAX_SIZE;;
					$config['file_name'] = $fileRename;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('file'))
					{
						$document= array(
							'depart_users_id'   => $user_ID,
							'user_code' => $this->session->userdata('user_code'),
							'doc_title' =>  $_POST['fileText'][$i],
							'doc_link' => 	UPLOAD_DIR . $fileRename,
							'date_entry' => date('Y-m-d H:i:s'),
							// 'date_update'  => 
						);

						// save data in attachment file
						$addMoreDocQuery = $this->db->insert('supportive_document',$document);

						if($addMoreDocQuery != 1)
						{
							log_message('error', '#ERRADDDOC300014: Insertion failed in supportive document'.$this->db->last_query());
							$data['update'] = false;
						}
					}
					else
					{
						log_message('error', '#ERRADDDOC0001: Insertion failed in supportive document RTPS Case No ');
						$data['update'] = false;
					}
				}

				//insert into gaon_pradhan_details
				$p_array = [
					'depart_users_id' => $user_ID,
					'user_code' => $this->session->userdata('user_code'),
					'dist_code' => $this->session->userdata('dist_code'),
					'subdiv_code' => $this->session->userdata('subdiv_code'),
					'cir_code' => $this->session->userdata('cir_code'),
					'mouza_pargona_code' => $mouza_pargona_code,
					'lot_no' => $lot_no,
					'vill_townprt_code' => $vill_townprt_code,
					'pradhan_name' => $user_NAME,
					'dob' => $this->input->post('dob'),
					'phone_no' => $this->input->post('mobile_no'), 
					'date_of_engagement' => $this->input->post('date_of_eng'),
					'date_of_retirement' => $this->input->post('date_of_ret'),
					'education_qualification' => $this->input->post('edu_qua'),
					'remarks' => $this->input->post('remark'),
					'date_entry' => date('Y-m-d H:i:s'),
					// 'date_update' => date('Y-m-d H:i:s'),
				];

				$inserPrad = $this->db->insert('gaon_pradhan_details', $p_array);
				if($inserPrad != 1){
					log_message('error', '#ERR275: Unable to insert data in gaon_pradhan_details'. $this->db->last_query());
					$data['update'] = false;
				}

				//insert nok if any
				if(isset($_POST['nok_name'])){
					$nokCount = count($_POST['nok_name']);
					for($i = 0; $i < $nokCount; $i++){
	
						$nok_array = [
							'depart_users_id' => $user_ID,
							'user_code' => $this->session->userdata('user_code'),
							'nok_name' => $_POST['nok_name'][$i],
							'address' => $_POST['nok_address'][$i],
							'mobile_no' => $_POST['nok_mobile'][$i],
							'relation' => $_POST['nok_relation'][$i],
							'date_entry' => date('Y-m-d H:i:s'),
						];
	
						$inst_nok = $this->db->insert('nok', $nok_array);
						if($inst_nok != 1){
							log_message('error', '#ERR323: Unable to insert data in nok'. $this->db->last_query());
							$data['update'] = false;
						}
					}
				}


				$update=array(
					'password'=> $this->input->post('new_password'),
					'first_login'=> 1,
					'password_change'=> date('Y-m-d H:i:s'),
					'mobile_no'=> $this->input->post('mobile_no'),
					'email'=> $this->input->post('email'),
					'address'=> $this->input->post('address'),
					'dob' => $this->input->post('dob'),
				);
			}else{
				$update=array(
					'password'=> $this->input->post('new_password'),
					'first_login'=> 1,
					'password_change'=> date('Y-m-d H:i:s'),
				);
			}

			$this->db->where('unique_user_id', $this->session->userdata('unique_user_id'));
			$depart_users_update = $this->db->update('depart_users', $update);
			if($this->db->affected_rows() == 1 && $depart_users_update == true)
			{
				$data['update'] = true;
				$newdata = array(
					'first_login'  => '1',
				);
				$this->session->set_userdata($newdata);
			}
			else
			{
				$data['update'] = false;
			}


			if($data['update'] == true){
				$this->db->trans_commit();
			}else{
				$this->db->trans_rollback();
			}

			$data['success'] = true;
		}
		echo json_encode($data);
	}

	private function UUID4()
    {
        $bytes = random_bytes(16);
        $bytes[6] = chr(ord($bytes[6]) & 0x0f | 0x40);
        $bytes[8] = chr(ord($bytes[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
    }


	public function files_check() {

		if (empty($_FILES['fileUpload']['name'][0])) {
			$this->form_validation->set_message('files_check', 'The Supporting Document field is required.');
			return false;
		}
	
		$fileCount = count($_FILES['fileUpload']['name']);
		$allowed_types = ['jpg', 'jpeg', 'png', 'pdf'];
		$max_size = 2 * 1024 * 1024; // 2MB
	
		for ($i = 0; $i < $fileCount; $i++) {
			$name = $_FILES['fileUpload']['name'][$i];
			$size = $_FILES['fileUpload']['size'][$i];
			$tmp_name = $_FILES['fileUpload']['tmp_name'][$i];
	
			if ($name && $size && $tmp_name) {
				$mime = mime_content_type($tmp_name);
				$ext = pathinfo($name, PATHINFO_EXTENSION);
	
				if (!in_array($ext, $allowed_types)) {
					$this->form_validation->set_message('files_check', 'Only JPG/PNG/PDF files are allowed.');
					return false;
				}
	
				if ($size > $max_size) {
					$this->form_validation->set_message('files_check', 'Each file must be less than 2MB.');
					return false;
				}
			} else {
				$this->form_validation->set_message('files_check', 'The Supporting Document field is required.');
				return false;
			}
		}
	
		return true;
	}
	


	////////////////////department user profile//////////////
	function departUserProfile()
	{
		$user = $this->db->query("select name,designation,unique_user_id,mobile_no,email,address,status,display_name from 
            depart_users where unique_user_id=?",array($this->session->userdata('unique_user_id')));
		if(isset($user))
		{
			$data['user'] = $user->row();
		}
		$data['_view'] = 'user/user_profile';
		$this->load->view('layouts/main',$data);
	}


	//////////checkDepartUserName/////////////
	function checkDepartUserName($name)
	{
		if (strlen($name) != strlen(utf8_decode($name)))
		{
			$regex= "/^[@]|[$]|[']|[(]|[)]|[&]$/";
			if (preg_match($regex, $name))
			{
				$this->form_validation->set_message('checkDepartUserName', 'The %s field is not valid name!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$regex= "/^[@]|[$]|[']|[(]|[)]|[&]$/";
			if (preg_match($regex, $name))
			{
				$this->form_validation->set_message('checkDepartUserName', 'The %s field is not valid name!');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}


	///////////checkDepartUserMobileNo////////////////////
	function checkDepartUserMobileNo($mobile_no)
	{
		if(strlen($mobile_no) == 10)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('checkDepartUserMobileNo', 'The %s must contain 10 digit.');
			return FALSE;
		}
	}


	//////checkDepartUserName/////////
	function checkDepartUserPName($username)
	{
		
		$user = $this->db->query("select unique_user_id from depart_users where unique_user_id=?",
			array($username));

		if($username == $this->session->userdata('unique_user_id'))
		{
			return true;
		}
		elseif ($username != $this->session->userdata('unique_user_id'))
		{
			if($user->num_rows()>0)
			{
				$this->form_validation->set_message('checkDepartUserPName', 'The %s field is already exist. Please try another user name.');
				return false;
			}
			else
			{
				return true;
			}
		}
	}


	///////////////////////////department profile update/////////////
	function updateDpartUserProfile()
	{
		$this->load->helper('email');
		$validateUserUpdate= array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|required|xss_clean|callback_checkDepartUserName',
			),
			array(
				'field' => 'mobile_no',
				'label' => 'Mobile No',
				'rules' => 'trim|required|xss_clean|callback_checkDepartUserMobileNo',
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|xss_clean|valid_email',
			),
			array(
				'field' => 'user_name',
				'label' => 'User Name',
				'rules' => 'trim|required|xss_clean|callback_checkDepartUserPName',
			),
			array(
				'field' => 'user_display_name',
				'label' => 'Display Name',
				'rules' => 'trim|required|xss_clean',
			),
		);

		
		$this->form_validation->set_rules($validateUserUpdate);
		$data = null;
		if ($this->form_validation->run() === FALSE) {
			$this->form_validation->set_error_delimiters('', '');
			foreach ($validateUserUpdate as $rule) {
				if (form_error($rule['field'])) {
					$data['error'][] = array('field' => $rule['field'], 'message' => form_error($rule['field']));
				}
			}
			echo json_encode($data);
			return;
		} else {
			$name =$this->input->post('name');
			$email =$this->input->post('email');
			$mobile_no =$this->input->post('mobile_no');
			$display_name =$this->input->post('user_display_name');
			$dist_code     = $this->session->userdata('dist_code');
            $user_code     = $this->session->userdata('user_code');
			$unique_user_id =$this->session->userdata('unique_user_id');
			$user_name =$this->input->post('user_name');

			$update=array(
				'name'=> $this->input->post('name'),
				'unique_user_id'=> $this->input->post('user_name'),
				'email'=> $this->input->post('email'),
				'mobile_no'=> $this->input->post('mobile_no'),
				'display_name' => $display_name,

			);
			$this->db->where('unique_user_id', $this->session->userdata('unique_user_id'));

			$this->db->trans_begin();

			$depart_users_update = $this->db->update('depart_users', $update);
			if ($this->db->affected_rows() <= 0 && $depart_users_update == false) 
			{
				$this->db->trans_rollback();
				log_message('error', '#ERRDUPDATE0001: Updation failed in depart_users');
				log_message('error', $this->db->last_query());
				echo json_encode(array(
					'responseType' => 1,
					'message' => '#ERRDUPDATE0001: Updation failed in settlement_basic. Kindly contact System Administrator',

				));
				return false;
				$data['update'] = false;

            }

			// Update in Dharitree API

			        $apilink = PROFILE_UPDATE_DHARITREE_API_LINK;
					$curl_handle = curl_init();
					curl_setopt($curl_handle, CURLOPT_URL, $apilink);
					curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST,  2);
					curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(

						'name' =>$name,
						'mobile_no' => $mobile_no,
						'email' => $email,
						'display_name' => $display_name,
						'unique_user_id' => $unique_user_id,
						'dist_code' =>$dist_code,
						'user_code' => $user_code,
					)));
					$response = curl_exec($curl_handle);
					$httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
					$response_obj = json_decode($response);

				if ($response_obj->responseType != 2) {
					log_message("error", "#PUILRMS0001, Curl Error(Y) In Api ");
					echo json_encode("Internal Server Error, Please Try Again Later..., Error Code #PUILRMS0001");
				$this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
				$data['update'] = true;
				$newdata = array(
					'unique_user_id'  => $this->input->post('user_name'),
					'name'  => $this->input->post('name'),
				);
				$this->session->set_userdata($newdata);

				$res = $this->db->query("select * from depart_users where unique_user_id=?",
					array($this->input->post('user_name')))->row();

				$data['data'] = $res;
				$data['success'] = true;

                }
			// Update API End
			// $data['success'] = true;
		}
		echo json_encode($data);
	}

	public function createDpartUserProfile(){
		$data['_view'] = 'user/create_profile';
		$this->load->view('layouts/main',$data);
	}

	public function createDpartUserProfileSave(){

		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$desgn = $this->input->post('desgntn');
		$mobile = $this->input->post('mobile_no');
		$email = $this->input->post('email_id');
		$address = $this->input->post('address');
		$password = hash('sha512', $this->input->post('set_pswrd'));
		
		//$finalPassword = hash('sha512', ($password.$this->session->userdata('salt'));

		$max = $this->db->query("SELECT MAX(id) as no FROM depart_users")->row()->no;
		if($max == '' || $max == null){ $val = 1; }
		else { $val = $max+1; }

		$params = [
			'name'=> $fname.' '.$lname,
			'designation'=> $this->input->post('desgntn'),
			'date_of_joining'=> date('Y-m-d h:i:s'),
			'password'=> $password,
			'unique_user_id'=> strtolower($fname).'_'.strtolower($desgn),
			'password_change'=> date('Y-m-d H:i:s'),
			'active_deactive'=> 'E',
			'first_login'=> '0',
			'status'=> 'E',
			'mobile_no'=> $mobile,
			'email'=> $email,
			'address'=> $address,
			'user_code'=> 'DEPT'.$val,
		];

		if($this->form_validation->run('user_profile_validation') == true) {

			//check for same email existance
			$user_email = $this->db->query("SELECT email FROM depart_users 
				WHERE email=?",array($email))->row()->email;
			if($user_email == $email){
				$this->session->set_flashdata('alert_msg','<div class="alert alert-warning">Same Email ID already exist.</div>');
				//$this->createDpartUserProfile();
				$data['_view'] = 'user/create_profile';
				$this->load->view('layouts/main',$data);
			}
			else {
				$this->db->insert('depart_users', $params);
				$this->session->set_flashdata('alert_msg','<div class="alert alert-warning">New User Profile has successfully created.</div>');
				redirect('user-profile-create');
			}
		}
		else { 
			$this->createDpartUserProfile();
		}
	}




public function createDpartUserProfileAssistant(){

		$unique_user_id = $this->session->userdata('unique_user_id');
        $this->db = $this->load->database('db2', TRUE);

		$ast =ASSISTANT_USERCODE;
		$sec =UNDER_SEC_USERCODE;
		$data = array();
		$data['user_list'] = $this->db->query("SELECT * FROM depart_users WHERE designation in ('$ast', '$sec')")->result();
        $data['user_dist'] = $this->db->query("SELECT udb.dist_code FROM depart_users du inner join user_dist_byforcation udb on udb.unique_user_id::int=du.id  where du.unique_user_id='$unique_user_id' and du.active_deactive='E'")->result();


		$data['_view'] = 'user/create_profile_assistant';
		$this->load->view('layouts/main',$data);
	}

	public function createDpartUserProfileAssistantSave(){

		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$desgn = $this->input->post('desgntn');
		$roleSet = null;
		if($desgn == 'ASSISTANT'){
			$roleSet = 'ASST';
		}else if($desgn == 'UNDER_SECRETARY'){
			$roleSet = 'UNSEC';
		}
		$mobile = $this->input->post('mobile_no');
		$email = $this->input->post('email_id');
		$address = $this->input->post('address');
		$user_id_new = $this->input->post('user_id_new');
		$password = hash('sha512', $this->input->post('set_pswrd'));
		$max = $this->db->query("SELECT MAX(id) as no FROM depart_users")->row()->no;
		if($max == '' || $max == null){ $val = 1; }
		else { $val = $max+1; }
		$jname = $fname.' '.$lname;
		$params = [
			'name'=> $fname.' '.$lname,
			'designation'=> $this->input->post('desgntn'),
			'date_of_joining'=> date('Y-m-d h:i:s'),
			'password'=> $password,
			'unique_user_id'=> $user_id_new,
			'password_change'=> date('Y-m-d H:i:s'),
			'active_deactive'=> 'E',
			'first_login'=> '0',
			'status'=> 'E',
			'mobile_no'=> $mobile,
			'email'=> $email,
			'address'=> $address,
			'user_code'=> trim($roleSet).$val,
			'display_name' => $jname
		];



		if($this->form_validation->run('user_profile_ast_validation') === true) {

			//check for same email existance
			$row_data = $this->db->query("SELECT email FROM depart_users 
				WHERE email=? ",array($email))->row();
			if(isset($row_data->email) && ($row_data->email == $email)){
				log_message('error','MB001 : USER ID CREATE PARAMS=========='.json_encode($params));
				$this->session->set_flashdata('alert_msg','<div class="alert alert-danger">Same Email ID already exist.</div>');
				redirect('user-profile-create-assistant');
			}

			// $checkUserID = $this->db->query("SELECT email,unique_user_id FROM depart_users 
			// 	WHERE (email=? or unique_user_id = ?)",array($email,$user_id_new))->row();

			// if(isset($row_data->unique_user_id) && ($row_data->unique_user_id == $user_id_new)){
			// 	log_message('error','MB0010 : USER ID CREATE PARAMS=========='.json_encode($params));
			// 	$this->session->set_flashdata('alert_msg','<div class="alert alert-danger">User ID already exist, Please choose another one...</div>');
			// 	redirect('user-profile-create-assistant');
			// }
			else {
				$this->db->trans_begin();
				$statusInsert1 = $this->db->insert('depart_users', $params);
				if($statusInsert1 != 1){
					log_message('error','MB002 : USER ID CREATE PARAMS=========='.json_encode($params));
					$this->db->trans_rollback();
					$this->session->set_flashdata('alert_msg','<div class="alert alert-danger">#ERROR-01 - Something went wrong...</div>');
					redirect('user-profile-create-assistant');

				}


				$dist_details = $this->db->query("SELECT * FROM user_dist_byforcation 
													WHERE user_code = ? ",array($this->session->userdata('user_code')))->result();

				$usercode = trim($roleSet).$val;
				$user_id = $this->db->query("SELECT id FROM depart_users 
												WHERE user_code = ? ",array($usercode))->row()->id;


				foreach ($dist_details as $key => $value) {
						unset($value->id);
						$value->unique_user_id = $user_id;
						$value->user_code= $usercode;
						$value->dist_code= $value->dist_code;
						$value->subdiv_code= "00";
						$value->cir_code= "00";
						$value->mouza_pargona_code= "00";
						$value->lot_no= "00";
						$value->active_deactive= "E";
			
						$statusInsert2 = $this->db->insert('user_dist_byforcation', $value);

						if($statusInsert2 != 1){
							log_message('error','MB003 : USER ID CREATE PARAMS=========='.json_encode($value));
							$this->db->trans_rollback();
							$this->session->set_flashdata('alert_msg','<div class="alert alert-danger">#ERROR-02 - Something went wrong...</div>');
							redirect('user-profile-create-assistant');

						}
				}


				if($this->db->trans_status() === FALSE){
					log_message('error','MB004 : USER ID CREATE PARAMS=========='.json_encode($params));
					$this->db->trans_rollback();
				}else{
					$this->db->trans_commit();
					$this->session->set_flashdata('alert_msg','<div class="alert alert-success">New Assistant Profile has successfully created.</div>');
					redirect('user-profile-create-assistant');
				}

				
			}
		}
		else { 
			$this->createDpartUserProfileAssistant();
		}
	}
}
