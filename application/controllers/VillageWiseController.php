<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VillageWiseController extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url','security'));
		$this->db = $this->load->database('db2',TRUE);
		$this->dbb = $this->load->database('auth', true);
                ini_set('memory_limit','-1');
                set_time_limit(0);
	}

	//number of total dags
	public function numberOfDagVillageWise()
	{
		$dis_code = $_GET['dist_code'];
		$subdiv_code = $_GET['subdiv'];
		$cir_code = $_GET['cir_code'];
		$mouza = $_GET['mouza'];
		$lot_no = $_GET['lot_no'];
		$arr = DHARITREE.$dis_code;
		$get_para = $dis_code.'-'.$subdiv_code.'-'.$cir_code.'-'.$mouza.'-'.$lot_no;
		$query = $this->db->query('SELECT villagewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->villagewise_json);
		$data['villDagCount'] = (array) $decode->{$arr}->{'dag'}->{$get_para};
		$data['_view'] = 'numberOfDag/totalDagVillWise';
		$this->load->view('layouts/main',$data);
	}

	//total Land Area Village Wise
	public function totalLandAreaVillageWise()
	{
		$dis_code = $_GET['dist_code'];
		$subdiv_code = $_GET['subdiv'];
		$cir_code = $_GET['cir_code'];
		$mouza = $_GET['mouza'];
		$lot_no = $_GET['lot_no'];
		$arr = DHARITREE.$dis_code;
		$get_para = $dis_code.'-'.$subdiv_code.'-'.$cir_code.'-'.$mouza.'-'.$lot_no;
		$query = $this->db->query('SELECT villagewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->villagewise_json);
		$data['villDagArea'] = (array) $decode->{$arr}->{'dag'}->{$get_para};
		$data['_view'] = 'totalLandArea/totalLandAreaVillWise';
		$this->load->view('layouts/main',$data);
	}



	//ap of dag cart
	public function apDagVillageWise()
	{
		$data['_view'] = 'apDag/apVillWise';
		$this->load->view('layouts/main',$data);
	}

	//pp of dag cart
	public function ppDagVillageWise()
	{
		$data['_view'] = 'ppDag/ppVillWise';
		$this->load->view('layouts/main',$data);
	}

	//govt of dag cart
	public function govtDagVillageWise()
	{
		$data['_view'] = 'govtDag/govtDagVillWise';
		$this->load->view('layouts/main',$data);
	}

	//area of survey cart
	public function areaOfSurveyVillageWise()
	{
		$data['_view'] = 'areaSurvey/areaSurveyVillWise';
		$this->load->view('layouts/main',$data);
	}

	//******* Zonal Dag Village Wise ********//
	public function zonalDagVillageWise()
	{
		$dis_code = $_GET['dist_code'];
		$subdiv_code = $_GET['subdiv'];
		$cir_code = $_GET['cir_code'];
		$arr = DHARITREE.$dis_code;
		$get_para = $dis_code.'-'.$subdiv_code.'-'.$cir_code;
		$query = $this->db->query('SELECT villagewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->villagewise_json);
		$data['villageZonalDagCount'] = (array) $decode->{$arr}->{'zonal_dag_count'}->{$get_para};

		$data['_view'] = 'zonal/ZonalDagVillageWise';
		$this->load->view('layouts/main',$data);
	}

	//******* Zonal Village Village Wise ********//
	public function zonalVillageVillageWise()
	{
		$dis_code = $_GET['dist_code'];
		$subdiv_code = $_GET['subdiv'];
		$cir_code = $_GET['cir_code'];
		$arr = DHARITREE.$dis_code;
		$get_para = $dis_code.'-'.$subdiv_code.'-'.$cir_code;
		$query = $this->db->query('SELECT villagewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->villagewise_json);
		$data['villageZonalVillageCount'] = (array) $decode->{$arr}->{'zonal_vill_count'}->{$get_para};
		$data['_view'] = 'zonal/ZonalVillageVillageWise';
		$this->load->view('layouts/main',$data);
	}

	//************village wise village land bank counts*********/
	public function vlbVillageWise(){
		$dis_code = $_GET['dist_code'];
		$subdiv_code = $_GET['subdiv'];
		$cir_code = $_GET['cir_code'];
		$arr = DHARITREE.$dis_code;
		$get_para = $dis_code.'-'.$subdiv_code.'-'.$cir_code;
		$query = $this->db->query('SELECT villagewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->villagewise_json);
		$data['villageWiseVlbCounts'] = (array) $decode->{$arr}->{'vlg_vill_wise_counts'}->{$get_para};
		$data['_view'] = 'village_land_bank/vlb_village_wise';
		$this->load->view('layouts/main',$data);

	}

	//**************khatian-village-wise****************
	public function khatianVillageWise(){
		$dis_code = $_GET['dist_code'];
		$subdiv_code = $_GET['subdiv'];
		$cir_code = $_GET['cir_code'];
		$arr = DHARITREE.$dis_code;
		$get_para = $dis_code.'-'.$subdiv_code.'-'.$cir_code;
		$query = $this->db->query('SELECT villagewise_json FROM ilrms_dashboard_records WHERE 
			application_id=?', DHARITREE);
		$query_result = $query->result();
		$decode = json_decode($query_result[0]->villagewise_json);
		$data['khatianVillageWise'] = (array) $decode->{$arr}->{'khatian_vill_wise_count'}->{$get_para};
		$data['_view'] = 'khatian/khatian_village_wise';
		$this->load->view('layouts/main',$data);
	} 
}

