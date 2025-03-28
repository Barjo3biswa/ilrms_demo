<?php
class AadhaarAuth extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->library('AES');  
    $this->load->model('AadhaarModel');  
    $this->db = $this->load->database('db2', TRUE);
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

  public function ilrmsSignUp()
  {
    $this->load->library('AES');
    $url = AADHAAR_USER_CREATE_FORM;
    $data = array(
      'response_url' => $url,
      'auth_key'     => 'ilrmsSignUp',
      'service_name' => 'ILRMS',
      'additional_ekyc' => array()
    );
    $input_array         = json_encode($data);
    $aes                 = new AES($input_array, ENCRYPTION_KEY);
    $enc                 = $aes->encrypt();
    $newStringEncrptData = str_replace("/","@",$enc);
    echo json_encode(array(
      'data' => $newStringEncrptData
    ));
  }

  public function ilrmsLinkAadhaar() {

    $checkAvailability = $this->AadhaarModel->checkIfAadhaarLinked()->num_rows();

    if($checkAvailability > 0) {
      echo json_encode(array(
        'responseType' => 2, //false
        'message'      => 'Your Aadhar is already linked ...',
      ));
      return;
    }
    else {
      $this->load->library('AES');
      $url = LINK_AADHAAR_WITH_USER_ACCOUNT;
      $data = array(
        'response_url' => $url,
        'auth_key'     => 'ilrmsSignUp',
        'service_name' => 'ILRMS',
        'additional_ekyc' => array('PAN','DL')
      );
      $input_array         = json_encode($data);
      $aes                 = new AES($input_array, ENCRYPTION_KEY);
      $enc                 = $aes->encrypt();
      $newStringEncrptData = str_replace("/","@",$enc);
      echo json_encode(array(
        'data' => $newStringEncrptData
      ));
    }
  }

  public function userCreateWithAadhaarAuth() {    
    $enc_data = $this->input->post('response');
    $originalString = str_replace("@","/",$enc_data);
    $aes = new AES($originalString, ENCRYPTION_KEY);
    $response = $aes->decrypt();
    $res = json_decode($response);
    var_dump($res);
    $data['response'] = $res;
    $this->load->view('login/userCreationForm', $data);
  }


  public function linkAadhaarAuthUserAccount() {   

    $enc_data = $this->input->post('response');
    $originalString = str_replace("@","/",$enc_data);
    $aes = new AES($originalString, ENCRYPTION_KEY);
    $response = $aes->decrypt();
    $res = json_decode($response);
    $unique_user_code = $this->session->userdata('unique_user_id');
    // $aadhaar_token    = $res->aadhaarDetail->aadhaar_token;
    $aadhaar_token    = $res->kycData->ekyc_token;
    $auth_type        = $res->kycData->ekyc_type;
    $dob              = $res->kycData->dob;
    //MRIG002 : checking the response data is valid or not============26042023
    if($aadhaar_token == null || $auth_type == null){
        log_message('error', '#ERROR1582: Token data not found...');
        echo json_encode(array(
            'responseType' => 3,
            'msg'          => '#ERROR1582 : Something went wrong. Kindly contact system administrator.'
        ));
        return;
    }
    // update depart_users

    if($this->session->userdata('designation') == GBURA){

      $UpdateQuery = [
        'auth_type' => $auth_type,
        'auth_reff' => $aadhaar_token,
        'dob'       => $dob
      ];

    }else{
      $UpdateQuery = [
        'auth_type' => $auth_type,
        'auth_reff' => $aadhaar_token,
      ];
    }

    $this->db->where('unique_user_id', $unique_user_code);
    $this->db->update('depart_users', $UpdateQuery);

    if ($this->db->affected_rows() <= 0) {
      log_message('error', '#ERROR157: Updation failed in depart_users');
      echo json_encode(array(
        'responseType' => 3,
        'msg'          => '#ERROR157 : Something went wrong. Kindly contact system administrator.'
      ));
      return;
    }
    else {
      redirect(base_url() . "logout");
    }
  }

  public function validate($isAddMore){
    $dist_code = $this->session->userdata('dist_code');
    $this->load->library('form_validation');
    //$this->form_validation->set_rules('district', 'District', 'trim|required|numeric');
    if ($isAddMore) {
      $this->form_validation->set_rules('name_in_aadhaar', 'name in english', 'required|max_length[70]');
      $this->form_validation->set_rules('user_name', 'User name', 'required|max_length[70]');
      $this->form_validation->set_rules('doj', 'doj', 'trim|required|exact_length[10]');
      $this->form_validation->set_rules('email_id', 'email_id', 'required');
      $this->form_validation->set_rules('mobile', 'mobile', 'trim|required|exact_length[10]');
    }
    if ($this->form_validation->run() == FALSE) {
      $this->form_validation->set_error_delimiters('', '');
      $validation = [];
      if (form_error('district')) {
      $validation[] = array('field' => 'district', 'message' => form_error('district'));
      }
      if (form_error('name_in_aadhaar')) {
      $validation[] = array('field' => 'name_in_aadhaar', 'message' => form_error('name_in_aadhaar'));
      }
      if (form_error('user_name')) {
      $validation[] = array('field' => 'user_name', 'message' => form_error('user_name'));
      }
      if (form_error('email_id')) {
      $validation[] = array('field' => 'email_id', 'message' => form_error('email_id'));
      }

      if (form_error('mobile')) {
      $validation[] = array('field' => 'mobile', 'message' => form_error('mobile'));
      }
      if (form_error('doj')) {
      $validation[] = array('field' => 'doj', 'message' => form_error('doj'));
      }
      return $validation;
    }
  }


  public function saveData()
  {
    $_POST = json_decode(file_get_contents("php://input"), true);
    
    header('Content-Type: application/json');
    $validation = $this->validate(true);
    if ($validation != null) {
      echo json_encode(array(
        'responseType' => 1,
        'validation' => $validation
      ));
      return false;
    }

    $string         = $_POST['cred'];//$this->input->post('string');
    $user_type      = $this->input->post('user_type');
    $name           = $this->input->post('name_in_aadhaar');
    $mobile_no      = $this->input->post('mobile');
    $unique_user_id = $this->input->post('user_name');
    $email          = $this->input->post('email_id');
    $dist_code      = $this->input->post('dist_arr');
    $password       = $string;
    $address        = $this->input->post('address');
    $aadhaar_no     = $this->input->post('aadhaar_no');
    $designation    = $this->input->post('designation');
    $display_name   = $this->input->post('display_name');
    $lot_no         = '00';
    $api            = $this->input->post('api');

    $result = null;
    if ($api == 1)
    {
    $url = DHAR_SDLAC_ACCOUNT_API;
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
    $post_array = array(
         'name'           => $name,
         'mobile_no'      => $mobile_no,
         'unique_user_id' => $unique_user_id,
         'email'          => $email,
         'dist_code'      => $dist_code,
         'password'       => $password,
         'aadhaar_no'     => $aadhaar_no,
         'designation'    => $designation,
         'lot_no'         => $lot_no,
         'display_name'   => $display_name,
         'user_type'      => $user_type,
                );
     curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query($post_array));
     $result1 = curl_exec($curl_handle);
     $result = json_decode($result1);
     log_message('error', 'url: '.$url.', post_param: '.json_encode($post_array).', response: '. $result1);
     }
     if($api==0 || ($result !=null && $result->responseType == 2)) {

      $latestId = $this->db->query("select nextval('depart_users_id_seq') as count ")->row()->count;
      
      $user_code = ($api == 0) ? 'SDLAC_'.$latestId : $result->code;
              
      $this->db       = $this->load->database('db2', TRUE);
      $name           = $name;
      $mobile_no      = $mobile_no;
      $unique_user_id = $unique_user_id;
      $email          = $email;
      $password       = $string;
      $user_code      = $user_code;//'SDLAC_'.$latestId;
      $address        = $address;
      $aadhaar_no     = $aadhaar_no;
      $designation    = $designation;
      $lot_no         = $lot_no;
      $display_name   = $display_name;

      //checking user is already exist or not---------
      $sql = "select count(*) as c from depart_users where unique_user_id=?";
      $query = $this->db->query($sql, array($unique_user_id));
      $user_count = $query->row()->c;
      if ($user_count > 0) {
        log_message('error','Entered username is '. $unique_user_id);
        echo json_encode(array(
          'responseType' => 3,
          'msg'      => '#RES001 : User already exist...choose another username'
        ));
        return;
      }

      $this->db->trans_begin();
      // Insert into depart_users
      $query = [
        'name'            => $name,
        'designation'     => $designation,
        'date_of_joining' => date('Y-m-d h:i:s'),
        'password'        => hash('sha512', $password),
        'unique_user_id'  => $unique_user_id,
        'active_deactive' => 'E',
        'first_login'     => '0',
        'status'          => 'E',
        'mobile_no'       => $mobile_no,
        'email'           => $email,
        'address'         => $address,
        'user_code'       => $user_code,
        'auth_type'       => 'AADHAAR',
        'auth_reff'       => $aadhaar_no,
        'display_name'    => $display_name,
        'user_type'       => $user_type,
      ];
      $insertUser = $this->db->insert('depart_users', $query);
      $last_insert_id = $this->db->insert_id();

      if ($insertUser <= 0) {
          $this->db->trans_rollback();
          log_message('error', '#RES002: Insert failed in depart_users');
          echo json_encode(array(
              'responseType' => 3,
              'msg'      => '#RES002 : Something went wrong...'
          ));
          return;
      }
      // Insert into user_dist_byforcation

      foreach($dist_code as $arr) {

        $insertArr = [
          'unique_user_id'      => $last_insert_id,
          'user_code'           => $user_code,
          'dist_code'           => $arr,
          'subdiv_code'         => '00',
          'cir_code'            => '00',
          'mouza_pargona_code'  => '00',
          'lot_no'              => '00',
        ];
        $insertDept = $this->db->insert('user_dist_byforcation', $insertArr);
        if ($insertDept != 1) {
          $this->db->trans_rollback();
          log_message('error', '#RES003: Insertion failed in user_dist_byforcation');
          echo json_encode(array(
              'responseType' => 3,
              'msg'      => '#RES003 : Something went wrong...'
          ));
          return;
        }
      }
      
      $this->db->trans_commit();
      $this->sendMail($email,$email,'Registration confirmation for SDLAC user',
                  'Dear Sir/Madam,<br><br><br> Given below the credentials to login to https://basundhara.assam.gov.in/ilrms for SDLAC Process.&nbsp;</p><p>Username: <b>'.$unique_user_id.'</b> <br />Password: <b>qwe@123</b> &nbsp;&nbsp;</p><p>You have to change your password after first successful login.</p><p>With Thanks &amp; Regards,<br />Basundhara Team</p>');
      echo json_encode(array(
          'responseType' => 2,
          'msg'      => '#RES004 : User created successfully...'
      ));
      return;
      
     } 
     else {
         echo $result1;
     }
  }
  function sendMail($email, $cc_mail, $subject, $body)
  { 
    $url = 'https://basundhara.assam.gov.in/rtpsmb/Api/sendMail';
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
         'to_emails'          => $email,
         'cc_emails'        => $cc_mail,
         'subject'        => $subject,
         'body'           => $body,
     )));
     $result1 = curl_exec($curl_handle);
     $result = json_decode($result1);
     log_message('error', 'Mail sent response: '.json_encode($result).' to emails: '.json_encode($email));
  }

  public function saveDataWithoutAadhar(){
      $_POST = json_decode(file_get_contents("php://input"), true);
      header('Content-Type: application/json');
      $validation = $this->validate(true);
      if ($validation != null) {
        echo json_encode(array(
          'responseType' => 1,
          'validation' => $validation
        ));
        return false;
      }
    
      $string         = $_POST['cred'];//$this->input->post('string');
      $user_type      = $this->input->post('user_type');
      $name           = $this->input->post('name_in_aadhaar');
      $mobile_no      = $this->input->post('mobile');
      $unique_user_id = $this->input->post('user_name');
      $email          = $this->input->post('email_id');
      $dist_code      = $this->input->post('district');
      $password       = $string;
      $address        = $this->input->post('address');
      $aadhaar_no     = '';//$this->input->post('aadhaar_no');
      $designation    = $this->input->post('designation');
      $display_name   = $this->input->post('display_name');
      $lot_no         = '00';
      $api            = $this->input->post('api');

      $result = null;
      if ($api == 1)
      {
          $url = DHAR_SDLAC_ACCOUNT_API;
          $curl_handle = curl_init();
          curl_setopt($curl_handle, CURLOPT_URL, $url);
          curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
          $post_array = array(
               'name'           => $name,
               'mobile_no'      => $mobile_no,
               'unique_user_id' => $unique_user_id,
               'email'          => $email,
               'dist_code'      => $dist_code,
               'password'       => $password,
               'aadhaar_no'     => $aadhaar_no,
               'designation'    => $designation,
               'lot_no'         => $lot_no,
               'display_name'   => $display_name,
               'user_type'      => $user_type,
          );
          curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query($post_array));
          $result1 = curl_exec($curl_handle);
          $result = json_decode($result1);
          log_message('error', 'saveDataWithoutAadhar: url: '.$url.', post_param: '.json_encode($post_array).', response: '. $result1);
      }
      
      if($api==0 || ($result !=null && $result->responseType == 2)) {

          $this->db       = $this->load->database('db2', TRUE);
          $latestId = $this->db->query("select nextval('depart_users_id_seq') as count ")->row()->count;
      
          $user_code = ($api == 0) ? 'SDLAC_'.$latestId : $result->code;
          $name           = $name;
          $mobile_no      = $mobile_no;
          $unique_user_id = $unique_user_id;
          $email          = $email;
          $password       = $string;
          $address        = $address;
          //$aadhaar_no     = $aadhaar_no;
          $designation    = $designation;
          $lot_no         = $lot_no;
          $display_name   = $display_name;
          //checking user is already exist or not---------
          $sql = "select count(*) as c from depart_users where unique_user_id=?";
          $query = $this->db->query($sql, array($unique_user_id));
          $user_count = $query->row()->c;
          if ($user_count > 0) {
             log_message('error','Entered username is '. $unique_user_id);
             echo json_encode(array(
                'responseType' => 3,
                 'msg'      => '#RES001 : User already exist...choose another username'
             ));
             return;
          }
          $this->db->trans_begin();
          // Insert into depart_users
          $query = [
              'name'            => $name,
              'designation'     => $designation,
              'date_of_joining' => date('Y-m-d h:i:s'),
              'password'        => hash('sha512', $password),
              'unique_user_id'  => $unique_user_id,
              'active_deactive' => 'E',
              'first_login'     => '0',
              'status'          => 'E',
              'mobile_no'       => $mobile_no,
              'email'           => $email,
              'address'         => $address,
              'user_code'       => $user_code,
              'auth_type'       => 'AADHAAR',
              'display_name'    => $display_name,
              'user_type'       => $user_type,
            ];
          $insertUser = $this->db->insert('depart_users', $query);
          $last_insert_id = $this->db->insert_id();
          if ($insertUser <= 0) {
              $this->db->trans_rollback();
              log_message('error', '#RES002: Insert failed in depart_users');
              echo json_encode(array(
                  'responseType' => 3,
                  'msg'      => '#RES002 : Something went wrong...'
              ));
              return;
          }
          // Insert into user_dist_byforcation
          foreach($dist_code as $arr) {
            $insertArr = [
              'unique_user_id'      => $last_insert_id,
              'user_code'           => $user_code,
              'dist_code'           => $arr,
              'subdiv_code'         => '00',
              'cir_code'            => '00',
              'mouza_pargona_code'  => '00',
              'lot_no'              => '00',
            ];
            $insertDept = $this->db->insert('user_dist_byforcation', $insertArr);
            if ($insertDept != 1) {
              $this->db->trans_rollback();
              log_message('error', '#RES003: Insertion failed in user_dist_byforcation');
              echo json_encode(array(
                  'responseType' => 3,
                  'msg'      => '#RES003 : Something went wrong...'
              ));
              return;
            }
          }
          $this->db->trans_commit();
          $this->sendMail($email,$email,'Registration confirmation for SDLAC user',
                  'Dear Sir/Madam,<br><br><br> Given below the credentials to login to https://basundhara.assam.gov.in/ilrms for SDLAC Process.&nbsp;</p><p>Username: <b>'.$unique_user_id.'</b> <br />Password: <b>qwe@123</b> &nbsp;&nbsp;</p><p>You have to change your password after first successful login.</p><p>With Thanks &amp; Regards,<br />Basundhara Team</p>');
          echo json_encode(array(
              'responseType' => 2,
              'msg'      => '#RES004 : User created successfully...'
          ));
          return;
     }
     else {
         echo $result1;
     }
  }

}
