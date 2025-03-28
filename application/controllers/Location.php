<?php

class Location extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Department_model');
	$this->load->library('form_validation');
        $this->load->helper(array('form', 'url','security'));
       // header('Access-Control-Allow-Origin: *');
    } 
    function index()
    {
        $data['location'] = $this->Department_model->get_all_location();        
        $data['_view'] = 'location/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new location
     */
    function add()
    {   
        
		$this->form_validation->set_rules('loc_name','Assamese Name','required|max_length[100]');		
		$this->form_validation->set_rules('locname_eng','English Name','required|max_length[100]');		
		$this->form_validation->set_rules('dist_code','District Code','required');		
		if($this->form_validation->run())     
        {   
            $params = array(
				'loc_name' => $this->input->post('loc_name'),
				'locname_eng' => $this->input->post('locname_eng'),
				'dist_code' => $this->input->post('dist_code'),
				'subdiv_code' => '00',
				'cir_code' => '00',
				'mouza_pargona_code' => '00',
				'lot_no' => '00',
				'vill_townprt_code' => '00000',
            );            
            $location_id = $this->Department_model->add_location($params);
            redirect('location/index');
        }
        else
        {            
            $data['_view'] = 'location/add';
            $this->load->view('layouts/main',$data);
        }
    } 
	function addSub()
    {   
        
		$this->form_validation->set_rules('loc_name','Assamese Name','required|max_length[100]');		
		$this->form_validation->set_rules('locname_eng','English Name','required|max_length[100]');		
		$this->form_validation->set_rules('dist_code','District Code','required');		
		$this->form_validation->set_rules('subdiv_code','Subdiv Code','required');		
		if($this->form_validation->run())     
        {   
            $params = array(
				'loc_name' => $this->input->post('loc_name'),
				'locname_eng' => $this->input->post('locname_eng'),
				'dist_code' => $this->input->post('dist_code'),
				'subdiv_code' => $this->input->post('subdiv_code'),
				'cir_code' => '00',
				'mouza_pargona_code' => '00',
				'lot_no' => '00',
				'vill_townprt_code' => '00000',
            );            
            $location_id = $this->Department_model->add_location($params);
            redirect('location/index');
        }
        else
        {            
            $data['location'] = $this->Department_model->get_all_District();
			$data['_view'] = 'location/addsub';
            $this->load->view('layouts/main',$data);
        }
    }
	function addCir()
    {   
        
		$this->form_validation->set_rules('loc_name','Assamese Name','required|max_length[100]');		
		$this->form_validation->set_rules('locname_eng','English Name','required|max_length[100]');		
		$this->form_validation->set_rules('dist_code','District Code','required');		
		$this->form_validation->set_rules('subdiv_code','Subdiv Code','required');		
		$this->form_validation->set_rules('cir_code','Circle Code','required');		
		if($this->form_validation->run())     
        {   
            $params = array(
				'loc_name' => $this->input->post('loc_name'),
				'locname_eng' => $this->input->post('locname_eng'),
				'dist_code' => $this->input->post('dist_code'),
				'subdiv_code' => $this->input->post('subdiv_code'),
				'cir_code' => $this->input->post('cir_code'),
				'mouza_pargona_code' => '00',
				'lot_no' => '00',
				'vill_townprt_code' => '00000',
            );            
            $location_id = $this->Department_model->add_location($params);
            redirect('location/index');
        }
        else
        {            
            $data['location'] = $this->Department_model->get_all_District();
            //$data['location'] = $this->Department_model->get_all_Sub();
			$data['_view'] = 'location/addcir';
            $this->load->view('layouts/main',$data);
        }
    } 
	function addMou()
    {   
        
		$this->form_validation->set_rules('loc_name','Assamese Name','required|max_length[100]');		
		$this->form_validation->set_rules('locname_eng','English Name','required|max_length[100]');		
		$this->form_validation->set_rules('dist_code','District Code','required');		
		$this->form_validation->set_rules('subdiv_code','Subdiv Code','required');		
		$this->form_validation->set_rules('cir_code','Circle Code','required');		
		$this->form_validation->set_rules('mouza_code','Mouza Code','required');		
		if($this->form_validation->run())     
        {   
            $params = array(
				'loc_name' => $this->input->post('loc_name'),
				'locname_eng' => $this->input->post('locname_eng'),
				'dist_code' => $this->input->post('dist_code'),
				'subdiv_code' => $this->input->post('subdiv_code'),
				'cir_code' => $this->input->post('cir_code'),
				'mouza_pargona_code' => $this->input->post('mouza_code'),
				'lot_no' => '00',
				'vill_townprt_code' => '00000',
            );            
            $location_id = $this->Department_model->add_location($params);
            redirect('location/index');
        }
        else
        {            
            $data['location'] = $this->Department_model->get_all_District();
			$data['_view'] = 'location/addmou';
            $this->load->view('layouts/main',$data);
        }
    }  
	function addLot()
    {   
        
		$this->form_validation->set_rules('loc_name','Assamese Name','required|max_length[100]');		
		$this->form_validation->set_rules('locname_eng','English Name','required|max_length[100]');		
		$this->form_validation->set_rules('dist_code','District Code','required');		
		$this->form_validation->set_rules('subdiv_code','Subdiv Code','required');		
		$this->form_validation->set_rules('cir_code','Circle Code','required');		
		$this->form_validation->set_rules('mouza_code','Mouza Code','required');		
		$this->form_validation->set_rules('lot_code','Lot Code','required');		
		if($this->form_validation->run())     
        {   
            $params = array(
				'loc_name' => $this->input->post('loc_name'),
				'locname_eng' => $this->input->post('locname_eng'),
				'dist_code' => $this->input->post('dist_code'),
				'subdiv_code' => $this->input->post('subdiv_code'),
				'cir_code' => $this->input->post('cir_code'),
				'mouza_pargona_code' => $this->input->post('mouza_code'),
				'lot_no' => $this->input->post('lot_code'),
				'vill_townprt_code' => '00000',
            );            
            $location_id = $this->Department_model->add_location($params);
            redirect('location/index');
        }
        else
        {            
            $data['location'] = $this->Department_model->get_all_District();
			$data['_view'] = 'location/addLot';
            $this->load->view('layouts/main',$data);
        }
    }  
	function addVill()
    {   
        
		$this->form_validation->set_rules('loc_name','Assamese Name','required|max_length[100]');		
		$this->form_validation->set_rules('locname_eng','English Name','required|max_length[100]');		
		$this->form_validation->set_rules('dist_code','District Code','required');		
		$this->form_validation->set_rules('subdiv_code','Subdiv Code','required');		
		$this->form_validation->set_rules('cir_code','Circle Code','required');		
		$this->form_validation->set_rules('mouza_code','Mouza Code','required');		
		$this->form_validation->set_rules('lot_code','Lot Code','required');		
		$this->form_validation->set_rules('vill_code','Vill Code','required');		
		if($this->form_validation->run())     
        {   
            $params = array(
				'loc_name' => $this->input->post('loc_name'),
				'locname_eng' => $this->input->post('locname_eng'),
				'dist_code' => $this->input->post('dist_code'),
				'subdiv_code' => $this->input->post('subdiv_code'),
				'cir_code' => $this->input->post('cir_code'),
				'mouza_pargona_code' => $this->input->post('mouza_code'),
				'lot_no' => $this->input->post('lot_code'),
				'vill_townprt_code' => $this->input->post('vill_code'),
            );            
            $location_id = $this->Department_model->add_location($params);
            redirect('location/index');
        }
        else
        {            
            $data['location'] = $this->Department_model->get_all_District();
			$data['_view'] = 'location/addVill';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a location
     */
    function edit($dist_code,$s,$c,$m,$l,$v)
    {   
        // check if the location exists before trying to edit it
        $data['location'] = $this->Department_model->get_location($dist_code,$s,$c,$m,$l,$v);
        
        if(isset($data['location']['dist_code']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('loc_name','Assamese Name','required|max_length[100]');
			$this->form_validation->set_rules('locname_eng','English Name','required|max_length[100]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'loc_name' => $this->input->post('loc_name'),
					'locname_eng' => $this->input->post('locname_eng'),
                );

                $this->Department_model->update_location($dist_code,$s,$c,$m,$l,$v,$params);            
                redirect('location/index');
            }
            else
            {
                $data['_view'] = 'location/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The location you are trying to edit does not exist.');
    } 

    /*
     * Deleting location
     */
    // function remove($dist_code)
    // {
        // $location = $this->Department_model->get_location($dist_code);

        // // check if the location exists before trying to delete it
        // if(isset($location['dist_code']))
        // {
            // $this->Department_model->delete_location($dist_code);
            // redirect('location/index');
        // }
        // else
            // show_error('The location you are trying to delete does not exist.');
    // }
	
	//////////////////////////////////////////////////
	public function getSubdivJson($distcode) {
        $data = $this->Department_model->getSubDivJSON($distcode);
        $json = array();
        foreach ($data as $object) {
            $json[] = array('loc_name' => $object->loc_name, 'subdiv_code' => $object->subdiv_code);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }
    public function getCirCodeJson($distcode,$subdiv) {
        $data = $this->Department_model->getCirCodeJSON($distcode,$subdiv);
        $json = array();
        foreach ($data as $object) {
            $json[] = array('loc_name' => $object->loc_name, 'cir_code' => $object->cir_code);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }
     public function getMouzaJson($distcode, $subdivcode, $circode) {
        $data = $this->Department_model->getMouzaJSON($distcode, $subdivcode, $circode);
        $json = array();
        foreach ($data as $object) {
            $json[] = array('loc_name' => $object->loc_name, 'mouza_pargona_code' => $object->mouza_pargona_code);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    public function getLotNoJson($distcode, $subdivcode, $circode, $mouzacode) {
        $data = $this->Department_model->getLotNoJson($distcode, $subdivcode, $circode, $mouzacode);

        $json = array();
        foreach ($data as $object) {
            $json[] = array('loc_name' => $object->loc_name, 'lot_no' => $object->lot_no);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }
    function getDcAdcUser($dist_code){
        $data = $this->Department_model->getDcAdc($dist_code);
        $json = array();
        foreach ($data as $object) {
            $json[] = array('user_name' => $object->user_name, 'user_code' => $object->user_code);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }
	function getcoUser($d,$s,$c){
        $data = $this->Department_model->getco($d,$s,$c);

        $json = array();
        foreach ($data as $object) {
            $json[] = array('user_name' => $object->user_name, 'user_code' => $object->user_code);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }
    function getlmUser($d,$s,$c,$m,$l){
        $data = $this->Department_model->getlm($d,$s,$c,$m,$l);
        $json = array();
        foreach ($data as $object) {
            $json[] = array('user_name' => $object->user_name, 'user_code' => $object->user_code);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }
	function explodeR(){
		$array=" 
		Simtuiluong (New village)#
Hmartlangmoi (New village)#
Hmarthlangmoi#
Thlangsang#
Disamatang
";
				
		//echo $array;
		//print_r (explode("#",$array));
		
		$p=(explode("#",$array));
		$i=10000;
		foreach($p as $val){
			//echo $i;
			//var_dump(trim($val));
			$i=$i+1;
			$params = array(
				'loc_name' => trim($val),
				'locname_eng' => trim($val),
				'dist_code' => '38',
				'subdiv_code' => '01',
				'cir_code' => '01',
				'mouza_pargona_code' => '14',
				'lot_no' => '01',
				'vill_townprt_code' => $i,
            );    		
           echo $this->Department_model->add_location($params);
	
		}
	}
	
}
