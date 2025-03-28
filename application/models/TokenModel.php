<?php

class TokenModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get location by dist_code
     */
    function getTokenforDashboardForBhunaksha()
    {
      $secretKey = "fgjkwqdhliewdwkebmngzxwefsjkukdsfadfgthtyjykjdfddeckwdlwedbwefewfewfewfewfwehiluwkdwedlkdhl";
      $issuedAt = time(); 
      $expirationTime = $issuedAt + 5 * 60;
      $userData = array();
      $userData['user_code'] = $this->session->userdata('user_code');
      $userData['name'] = $this->session->userdata('name');
      $userData['designation'] = $this->session->userdata('designation');
      $userData['date_of_joining'] = $this->session->userdata('date_of_joining');
      $userData['unique_user_id'] = $this->session->userdata('unique_user_id');
      $userData['first_login'] = $this->session->userdata('first_login');
      $userData['mobile_no'] = $this->session->userdata('mobile_no');
      $userData['email'] = $this->session->userdata('email');
      $userData['address'] = $this->session->userdata('address');
      $userData['dist_code'] = $this->session->userdata('dist_code');
      $userData['subdiv_code'] = $this->session->userdata('subdiv_code');
      $userData['cir_code'] = $this->session->userdata('cir_code');
      $userData['mouza_pargona_code'] = $this->session->userdata('mouza_pargona_code');
      $userData['logged_in'] = $this->session->userdata('logged_in');
      $userData['exp'] =  $expirationTime;
      $jwtobj = new JWT();
      $jwt = $jwtobj->encode($userData, $secretKey, 'HS256');
      return $jwt;
    }
}