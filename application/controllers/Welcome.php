<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

	public function deed_list()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		// CURLOPT_URL => 'http://localhost/webapi_test/deed/dashboard.php',
		CURLOPT_URL => 'https://landhub.assam.gov.in/webapi_reg/deed/dashboard.php',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));
		$response = curl_exec($curl);
		// echo($response); die();
		$response = json_decode($response, true);
		curl_close($curl);
		$response['applications'] = $response;
		$response['_view'] = 'epanjeeyan/deed_view';
      	$this->load->view('layouts/main', $response);		
		// $this->load->view('deed_view', array('applications' => $response));
	}

	public function get_office_list(){
		$district_code = $this->input->post('district_code', true);
		$curl = curl_init();
		curl_setopt_array($curl, array(
		// CURLOPT_URL => 'http://localhost/webapi_test/deed/get_office_list.php?district_code='.$district_code,
		CURLOPT_URL => 'https://landhub.assam.gov.in/webapi_reg/deed/get_office_list.php?district_code='.$district_code,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));
		$response = curl_exec($curl);
		echo $response;
	}

	public function get_village_list(){
		$dbname = $this->input->post('dbname', true);
		$curl = curl_init();
		curl_setopt_array($curl, array(
		// CURLOPT_URL => 'http://localhost/webapi_test/deed/get_village_list.php?dbname='.$dbname,
		CURLOPT_URL => 'https://landhub.assam.gov.in/webapi_reg/deed/get_village_list.php?dbname='.$dbname,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));
		$response = curl_exec($curl);
		echo $response;
	}

	public function get_all_dag_details_list(){
		$district_code = $this->input->post('district_code', true);
		$dbname = $this->input->post('dbname', true);
		$villcode = $this->input->post('villcode', true);
		$dagno = $this->input->post('dagno', true);
		$curl = curl_init();
		curl_setopt_array($curl, array(
		// CURLOPT_URL => 'http://localhost/webapi_test/deed/get_all_dag_details_list.php?dbname='.$dbname.'&villcode='.$villcode.'&dagno='.$dagno,
		CURLOPT_URL => 'https://landhub.assam.gov.in/webapi_reg/deed/get_all_dag_details_list.php?dbname='.$dbname.'&villcode='.$villcode.'&dagno='.$dagno,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));
		$response = curl_exec($curl);
		echo $response;
	}

	public function get_all_party_details_list(){
		$dbname = $this->input->post('dbname', true);
		$comcaseno = $this->input->post('comcaseno', true);
		$curl = curl_init();
		curl_setopt_array($curl, array(
		// CURLOPT_URL => 'http://localhost/webapi_test/deed/get_all_party_details_list.php?dbname='.$dbname.'&comcaseno='.$comcaseno,
		CURLOPT_URL => 'https://landhub.assam.gov.in/webapi_reg/deed/get_all_party_details_list.php?dbname='.$dbname.'&comcaseno='.$comcaseno,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));
		$response = curl_exec($curl);
		echo $response;
	}

	public function get_deed_view(){
		$dbname = $this->input->post('dbname', true);
		$comcaseno = $this->input->post('comcaseno', true);
		$curl = curl_init();
		curl_setopt_array($curl, array(
		// CURLOPT_URL => 'http://localhost/webapi_test/deed/get_deed_view.php?dbname='.$dbname.'&comcaseno='.$comcaseno,
		CURLOPT_URL => 'https://landhub.assam.gov.in/webapi_reg/deed/get_deed_view.php?dbname='.$dbname.'&comcaseno='.$comcaseno,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));
		$response = curl_exec($curl);
		echo $response;
	}

	public function get_party(){
		$comcaseno = $this->input->get('comcaseno');
		$curl = curl_init();
		curl_setopt_array($curl, array(
		// CURLOPT_URL => 'http://localhost/deed_view/party_view.php?comcaseno='.$comcaseno,
		CURLOPT_URL => 'https://landhub.assam.gov.in/epanjeeyan/deed_view/party_view.php?comcaseno='.$comcaseno,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));
		$response = curl_exec($curl);
		$response = json_decode($response);
		$response['parties'] = $response;
		$response['_view'] = 'party_view';
      	$this->load->view('layouts/main', $response);
		// $this->load->view('party_view', array('parties' => $response));
	}

	public function get_deed(){
		$comcaseno = $this->input->get('comcaseno');
		$curl = curl_init();
		curl_setopt_array($curl, array(
		// CURLOPT_URL => 'http://localhost/deed_view/deed_display.php?comcaseno='.$comcaseno,
		CURLOPT_URL => 'https://landhub.assam.gov.in/epanjeeyan/deed_view/deed_display.php?comcaseno='.$comcaseno,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));
		$response = curl_exec($curl);
		header("Content-type: application/pdf");
		echo $response;		
	}	
}
