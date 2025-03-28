<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LotWiseController extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url','security'));
		$this->db = $this->load->database('db2',TRUE);
		$this->dbb = $this->load->database('auth', true);
	}

	//number of total dags
	public function numberOfDagLotWise()
	{
		$dis_code = $_GET['dist_code'];
		$subdiv_code = $_GET['subdiv'];
		$cir_code = $_GET['cir_code'];
		$arr = DHARITREE.$dis_code;
		$get_para = $dis_code.'-'.$subdiv_code.'-'.$cir_code;
		$query = $this->db->query('SELECT lotwise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->lotwise_json);
		$data['lotDagCount'] = (array) $decode->{$arr}->{'dag'}->{$get_para};
		$data['_view'] = 'numberOfDag/totalDagLotWise';
		$this->load->view('layouts/main',$data);
	}

	//AP dags
	public function apDagLotWise()
	{
		$data['_view'] = 'apDag/apLotWise';
		$this->load->view('layouts/main',$data);
	}

	//PP dags
	public function ppDagLotWise()
	{
		$data['_view'] = 'ppDag/ppLotWise';
		$this->load->view('layouts/main',$data);
	}

	//number of total dags
	public function govtDagLotWise()
	{
		$data['_view'] = 'govtDag/govtDagLotWise';
		$this->load->view('layouts/main',$data);
	}

	//area of survey cart
	public function areaOfSurveyLotWise()
	{
		$data['_view'] = 'areaSurvey/areaSurveyLotWise';
		$this->load->view('layouts/main',$data);
	}

	//totalLandAreaLotWise
	public function totalLandAreaLotWise()
	{
		$dis_code = $_GET['dist_code'];
		$subdiv_code = $_GET['subdiv'];
		$cir_code = $_GET['cir_code'];
		$arr = DHARITREE.$dis_code;
		$get_para = $dis_code.'-'.$subdiv_code.'-'.$cir_code;
		$query = $this->db->query('SELECT lotwise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->lotwise_json);
		$data['lotDagArea'] = (array) $decode->{$arr}->{'dag'}->{$get_para};
		$data['_view'] = 'totalLandArea/totalLandAreaLotWise';
		$this->load->view('layouts/main',$data);
	}
}
