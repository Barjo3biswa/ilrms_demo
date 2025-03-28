<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EkhajanaDoatReportController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ekhajana/EkhajanaDoulModel');
        $this->load->model('ekhajana/EkhajanaMouzadarModel');   
        $this->load->model('ekhajana/EkhajanaDoatReportModel');   
    }

    public function getEkhajanaDoatReport(){
        $data['_view'] = 'e_khajana/doat_report/doat_report_index';
        $this->load->view('layouts/main',$data);
    }

    public function populateReport()
    {
        $year_month = explode("-", $_POST["year_month"]);        
        $month = $year_month[0];
        $data['year'] = $year = $year_month[1];
        $monthNum  = $month;
        $data['month_name'] = $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $data['report_data'] = $this->EkhajanaDoatReportModel->getAllCommisionData($year,$month);
        $data['total_unique_GRN'] = $this->EkhajanaDoatReportModel->getAllUniqueGrn($year,$month);
        $data['total_amount_received'] = $this->EkhajanaDoatReportModel->getTotalAmountReceived($year,$month);
        $data['total_commission_received'] = $this->EkhajanaDoatReportModel->getTotalCommissionReceived($year,$month);
        $data['_view'] = 'e_khajana/doat_report/doat_report';
        $this->load->view('layouts/main',$data);
    }

}
