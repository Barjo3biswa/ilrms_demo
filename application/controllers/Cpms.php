<?php

class Cpms extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('CpmsModel');
    }

    //getting the index page for cpms report 
    public function index(){
        $data['cpms_report_data'] = $this->CpmsModel->getCpmsReport();
        // echo "<pre>";
        // var_dump($data['cpms_report_data']);
        // echo "</pre>";
        // exit;
        $data['_view'] = 'cpms/index';
		$this->load->view('layouts/main', $data);
    }

}
?>