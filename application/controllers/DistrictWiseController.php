<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DistrictWiseController extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url','security'));
		$this->db = $this->load->database('db2',TRUE);
		$this->dbb = $this->load->database('auth', true);
	}

	//number of dag cart
	public function numberOfDagDistrictWise()
	{
		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records');
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->districtwise_json);
		$data['districtDagCount'] = array_merge((array) $decode->{'brahmaputra_valley'}, (array) $decode->{'barak_valley'});
		$data['_view'] = 'numberOfDag/totalDagDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	//ap of dag cart
	public function apDagDistrictWise()
	{
		$data['_view'] = 'apDag/apDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	//pp of dag cart
	public function ppDagDistrictWise()
	{
		$data['_view'] = 'ppDag/ppDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	//govt of dag cart
	public function govtDagDistrictWise()
	{
		$data['_view'] = 'govtDag/govtDagDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	//area of survey cart
	public function areaOfSurveyDistrictWise()
	{
		$data['_view'] = 'areaSurvey/areaSurveyDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	//total patta
	public function totalPattaDistrictWise()
	{
		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records');
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->districtwise_json);
		$data['districtPattaCount'] = array_merge((array) $decode->{'brahmaputra_valley'}, (array) $decode->{'barak_valley'});
		$data['_view'] = 'totalPatta/totalPattaDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	//total land area
//	public function totalBrahmaputraLandAreaDistrictWise()
//	{
//		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records');
//		$data['districtLandAreaCount'] = $query->result();
//		var_dump($data['districtLandAreaCount']);return;
//		$data['_view'] = 'totalLandArea/totalLandAreaDistrictWise';
//		$this->load->view('layouts/main',$data);
//	}

	public function totalBrahmaputraLandAreaDistrictWise()
	{
		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records');
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->districtwise_json);
		$data['districtLandAreaCount'] = $decode->{'brahmaputra_valley'};
		$data['_view'] = 'totalLandArea/totalLandAreaDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	public function totalBarakLandAreaDistrictWise()
	{
		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records');
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->districtwise_json);
		$data['districtLandAreaCount'] = $decode->{'barak_valley'};
		$data['_view'] = 'totalLandArea/totalLandAreaDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	//total pattadar
	public function totalPattadarDistrictWise()
	{
		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records');
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->districtwise_json);
		$data['districtPattadarCount'] = array_merge((array) $decode->{'brahmaputra_valley'}, (array) $decode->{'barak_valley'});
		$data['_view'] = 'totalPattadar/totalPattadarDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	/************ Patta Type Wise ********/
	public function pattaTypeWise()
	{
		$query = $this->db->query('SELECT statewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$data['districtPatta'] = json_decode($query_result[0]->statewise_json);
		$data['_view'] = 'totalPatta/PattaTypeWise';
		$this->load->view('layouts/main',$data);
	}

	/********** Patta Type District Wise ********/
	public function pattaTypeDistrictWise()
	{
		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->districtwise_json);
		$data['districtPattaCount'] = (array) $decode->{'patta_type_district_wise'};
		$data['_view'] = 'totalPatta/PattaTypeDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	/********** Annual Patta Type District Wise ********/
	public function annualPattaDistrictWise()
	{
		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->districtwise_json);
		$data['districtAnnualPattaCount'] = (array) $decode->{'annual_patta_district_wise'};
		$data['_view'] = 'totalPatta/AnnualPattaDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	/********** Periodic Patta Type District Wise ********/
	public function periodicPattaDistrictWise()
	{
		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->districtwise_json);
		$data['districtPeriodicPattaCount'] = (array) $decode->{'periodic_patta_district_wise'};
		$data['_view'] = 'totalPatta/PeriodicPattaDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	/**********  zonalDagDistrictWise ***********/
	public function zonalDagDistrictWise()
	{
		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records');
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->districtwise_json);
		$data['districtZonalDagCount'] = $decode->{'zonal-dag'};
		$data['_view'] = 'zonal/ZonalDagDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	/**********  zonalVillageDistrictWise ***********/
	public function zonalVillageDistrictWise()
	{
		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records');
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->districtwise_json);
		$data['districtZonalVillageCount'] = $decode->{'zonal-village'};
		$data['_view'] = 'zonal/ZonalVillageDistrictWise';
		$this->load->view('layouts/main',$data);
	}

	/****************vlb-district-wise************/
	public function vlbDistrictWise(){
		
		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records');
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->districtwise_json);
		$data['distrcit_vlb_count'] = $decode->{'vlb-dag'};
		$data['_view'] = 'village_land_bank/vlb_district_wise';
		$this->load->view('layouts/main',$data);
	}

	/****************khatian-district-wise************/
	public function khatianDistrictWise(){
		$query = $this->db->query('SELECT districtwise_json FROM ilrms_dashboard_records');
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->districtwise_json);
		$data['district_khatian_count'] = $decode->{'khatian_entry'};
		$data['_view'] = 'khatian/khatian_district_wise';
		$this->load->view('layouts/main',$data);
	}

}
