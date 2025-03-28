<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StateWiseController extends MY_Controller {

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
	public function numberOfDagStateWise()
	{
		$data['_view'] = 'numberOfDag/totalDagStateWise';
		$this->load->view('layouts/main',$data);
	}

	//AP dags
	public function apDagStateWise()
	{
		$data['_view'] = 'apDag/apStateWise';
		$this->load->view('layouts/main',$data);
	}

	//PP dags
	public function ppDagStateWise()
	{
		$data['_view'] = 'ppDag/ppStateWise';
		$this->load->view('layouts/main',$data);
	}

	//number of total dags
	public function govtDagStateWise()
	{
		$data['_view'] = 'govtDag/govtDagStateWise';
		$this->load->view('layouts/main',$data);
	}

	//area of survey cart
	public function areaOfSurveyStateWise()
	{
		$data['_view'] = 'areaSurvey/areaSurveyStateWise';
		$this->load->view('layouts/main',$data);
	}

	/************ Zonal Dag Village Wise ********/
	public function zonalDagVillageWise()
	{
		$query = $this->db->query('SELECT statewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$data['districtZonal'] = json_decode($query_result[0]->statewise_json);
		$data['_view'] = 'zonal/ZonalDagAndVillageType';
		$this->load->view('layouts/main',$data);
	}
}
