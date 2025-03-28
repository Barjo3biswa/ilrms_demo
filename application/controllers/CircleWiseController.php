<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CircleWiseController extends MY_Controller {

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
	public function numberOfDagCircleWise()
	{
		$query = $this->db->query('SELECT circlewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$data['circleDagCount'] = $query;

		$data['_view'] = 'numberOfDag/totalDagCircleWise';
		$this->load->view('layouts/main',$data);
	}

	//AP dags
	public function apDagCircleWise()
	{
		$data['_view'] = 'apDag/apCircleWise';
		$this->load->view('layouts/main',$data);
	}

	//PP dags
	public function ppDagCircleWise()
	{
		$data['_view'] = 'ppDag/ppCircleWise';
		$this->load->view('layouts/main',$data);
	}

	//number of total dags
	public function govtDagCircleWise()
	{
		$data['_view'] = 'govtDag/govtDagCircleWise';
		$this->load->view('layouts/main',$data);
	}

	//area of survey cart
	public function areaOfSurveyCircleWise()
	{
		$data['_view'] = 'areaSurvey/areaSurveyCircleWise';
		$this->load->view('layouts/main',$data);
	}

	//number of total dags
	public function totalPattaCircleWise()
	{
		$query = $this->db->query('SELECT circlewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$data['circlePattaCount'] = $query;

		$data['_view'] = 'totalPatta/totalPattaCircleWise';
		$this->load->view('layouts/main',$data);
	}

	//total Land area
	public function totalLandAreaCircleWise()
	{
		$query = $this->db->query('SELECT circlewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$data['circleLandAreaCount'] = $query;
		$data['_view'] = 'totalLandArea/totalLandAreaCircleWise';
		$this->load->view('layouts/main',$data);
	}

	// pattadar
	public function totalPattadarCircleWise()
	{
		$query = $this->db->query('SELECT circlewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$data['circlePattadarCount'] = $query;

		$data['_view'] = 'totalPattadar/totalPattadarCircleWise';
		$this->load->view('layouts/main',$data);
	}

	//******* Patta Type Circle Wise ********//
	public function pattaTypeCircleWise()
	{
		$arr = DHARITREE.basename($_SERVER['REQUEST_URI']);
		$query = $this->db->query('SELECT circlewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->circlewise_json);
		$data['circlePattaCount'] = (array) $decode->{$arr}->{'patta_type_circle_wise'};
		$data['_view'] = 'totalPatta/PattaTypeCircleWise';
		$this->load->view('layouts/main',$data);
	}

	//******* Annual Patta Type Circle Wise ********//
	public function annualPattaCircleWise()
	{
		$arr = DHARITREE.basename($_SERVER['REQUEST_URI']);
		$query = $this->db->query('SELECT circlewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->circlewise_json);
		$data['circleAnnualPattaCount'] = (array) $decode->{$arr}->{'annual-patta'};
		$data['_view'] = 'totalPatta/AnnualPattaCircleWise';
		$this->load->view('layouts/main',$data);
	}

	//******* Periodic Patta Type Circle Wise ********//
	public function periodicPattaCircleWise()
	{
		$arr = DHARITREE.basename($_SERVER['REQUEST_URI']);
		$query = $this->db->query('SELECT circlewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->circlewise_json);
		$data['circlePeriodicPattaCount'] = (array) $decode->{$arr}->{'periodic-patta'};
		$data['_view'] = 'totalPatta/PeriodicPattaCircleWise';
		$this->load->view('layouts/main',$data);
	}

	//******* Zonal Dag Circle Wise ********//
	public function zonalDagCircleWise()
	{
		$arr = DHARITREE.basename($_SERVER['REQUEST_URI']);
		$query = $this->db->query('SELECT circlewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->circlewise_json);
		$data['circleZonalDagCount'] = (array) $decode->{$arr}->{'zonal_dag_cir_count'};
		$data['_view'] = 'zonal/ZonalDagCircleWise';
		$this->load->view('layouts/main',$data);
	}

	//******* Zonal Village Circle Wise ********//
	public function zonalVillageCircleWise()
	{
		$arr = DHARITREE.basename($_SERVER['REQUEST_URI']);
		$query = $this->db->query('SELECT circlewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->circlewise_json);
		$data['circleZonalVillageCount'] = (array) $decode->{$arr}->{'zonal_village_cir_count'};
		$data['_view'] = 'zonal/ZonalVillageCircleWise';
		$this->load->view('layouts/main',$data);
	}

	//******* Village Land Bank Circle Wise ********//
	public function vlbCircleWise($dist_code = null)
	{
		$arr = DHARITREE.basename($_SERVER['REQUEST_URI']);
		$query = $this->db->query('SELECT circlewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->circlewise_json);
		$data['vlbCircleWise'] = (array) $decode->{$arr}->{'vlb_dag_cir_count'};
		$data['_view'] = 'village_land_bank/vlb_circle_wise';
		$this->load->view('layouts/main',$data);
	}

	//*********khatian-circle-wise**************/
	public function khatianCircleWise($dist_code = null){
		$arr = DHARITREE.basename($_SERVER['REQUEST_URI']);
		$query = $this->db->query('SELECT circlewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->circlewise_json);
		$data['khatianCircleWise'] = (array) $decode->{$arr}->{'khatian_cir_count'};
		$data['_view'] = 'khatian/khatian_circle_wise';
		$this->load->view('layouts/main',$data);
	}
}
