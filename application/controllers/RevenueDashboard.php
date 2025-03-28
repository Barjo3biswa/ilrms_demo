<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RevenueDashboard extends CI_Controller {

function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
	      $this->load->helper('cookie');
        $this->load->helper('security');
        $this->load->helper('string_helper');
        $this->load->helper('captcha');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('RevenueDashboardModel');
    }

    public function dashboardIndex()
    {
		$data['_view'] = 'revenuedashboard/dashboard_Index';
		$this->load->view('layouts/main',$data);
    }


      public function viewDashboardDetails(){
      // Get the service type from the POST request
      $service = $this->input->post('serviceType');
      $data = array();
      $data['service'] = $service;

      // Check if the service type is provided
      if($service == null || $service == '') {
          echo json_encode(array(
              'responseType' => 1,
              'message' => 'Please Select Service'
          ));
          return;
      }

      // Determine service codes based on the service type
      if($service == 'FMUTI'){
          $service_code = 1;
          $time_limit = '15';
          $data['service_name'] ='Mutation By Inheritance (Field)';
      }
      elseif($service == 'OMUTI'){
          $service_code = 1;
          $time_limit = '60';
          $data['service_name'] ='Mutation By Inheritance (Office)';
      }
      elseif($service == 'FMUTD'){
          $service_code = 2;
          $time_limit = '30';
          $data['service_name'] ='Mutation By Deed (Field)';
      }
      elseif($service == 'OMUTD'){
          $service_code = 2;
          $time_limit = '60';
          $data['service_name'] ='Mutation By Deed (Office)';
      }
      elseif($service == 'RECLASS'){
          $service_code = 4;
          $time_limit = '45';
          $data['service_name'] ='Reclassification';

      } else {
          echo json_encode(array(
              'responseType' => 1,
              'message' => 'Invalid Service Type'
          ));
          return;
      }

      // Fetch case details and median value from the model

      $this->db = $this->load->database('basundhara_rtps', TRUE);

      $caseDetails = $this->RevenueDashboardModel->getCaseCountDetailsByService($this->db,$service,$service_code)->result();
      $timeDetails = $this->RevenueDashboardModel->timeCalculation($this->db,$service,$service_code)->result();
      $median = $this->RevenueDashboardModel->getMedianCaseCountByService($this->db,$service,$service_code)->row();

      if (empty($caseDetails)) {
          echo json_encode(array(
              'responseType' => 1,
              'message' => 'No data found for the selected service'
          ));
          return;
      }

      $data['time_limit'] = $time_limit;
      $data['total_received_count'] = $caseDetails[0]->total_received_count;
      $data['total_approved_count'] = $caseDetails[0]->total_approved_count;
      $data['average_fees'] = round($caseDetails[0]->average_fees, 2);

      $data['average_time'] = round($timeDetails[0]->average_time, 0);
      $data['maximum_time'] = round($timeDetails[0]->maximum_time, 0);
      $minimum_time = round($timeDetails[0]->minimum_time, 0);
      if($minimum_time <=0)
        {
            $data['minimum_time'] = 1;
        }
        else
        {
            $data['minimum_time'] = $minimum_time;
        }
      if ($median) {
          $data['median_time'] = round($median->median_time, 0);
      }

      $data['status'] = true;
      $this->load->view('revenuedashboard/dashboard_details', $data);
  }



  public function getAllCaseListDetails() {

    $json = null;
    $draw = intval($this->input->post('draw'));
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');

    $service = $this->input->post('service_code');

    if($service == 'FMUTI'){
          $service_code = 1;
          $data['service_name'] ='Mutation By Inheritance (Field)';
      }
      elseif($service == 'OMUTI'){
          $service_code = 1;
          $data['service_name'] ='Mutation By Inheritance (Office)';
      }
      elseif($service == 'FMUTD'){
          $service_code = 2;
          $data['service_name'] ='Mutation By Deed (Field)';
      }
      elseif($service == 'OMUTD'){
          $service_code = 2;
          $data['service_name'] ='Mutation By Deed (Office)';
      }
      elseif($service == 'RECLASS'){
          $service_code = 4;
          $data['service_name'] ='Reclassification';

      }

    $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

    $this->db = $this->load->database('basundhara_rtps', TRUE);

    $caseList = $this->RevenueDashboardModel->getAllCaseListDetails($this->db,$start, $length, $order,$service,$service_code,$searchByCol_0);

    if(!empty($caseList)) {

      if($caseList['total_records'] >  0){

        $data_rows = $caseList['data_results'];

        foreach($data_rows as $row) {

            $app_no = $row->application_no;
            $application_date =  date('d-M-Y',strtotime($row->date_submission));
            $approval_date =  date('d-M-Y',strtotime($row->modified_at));

            if($row->total_amount == NULL){
            $total_fee = '<small class="text-danger"> '. $row->amount .'</small>';
            }
            else{
            $total_fee = '<small class="text-success"><i class="fa fa-rupee"></i> '. $row->total_amount .'</small>';
            }

            $other_fee = $row->total_amount - $row->amount;
            if($other_fee >= 0){

            $other_fee = "<br><small class='text-danger text-center'>Other Charge:  <i class='fa fa-rupee'></i> " . ($row->total_amount - $row->amount)  ."</small>" ;

            }
            else{
            $other_fee = "<br><small class='text-danger text-center'>Other Charge:  NA</small>" ;
            }


            $fee_details = "<small class='text-danger text-center'>Service Charge: <i class='fa fa-rupee'></i> " . $row->amount  ."</small>" ;

          
            $json[] = array(
              '<small class=""><i class="fa fa-briefcase"></i> '. $app_no .'</small>',
              '<small class="text-danger"><i class="fa fa-calendar"></i> '. $application_date .'</small>',
              '<small class="text-success"><i class="fa fa-calendar"></i> '. $approval_date .'</small>',
              $fee_details . $other_fee ,
              $total_fee
            );
        }
      }
      else {
        $json = "";
      }      
      
      $total_records = $caseList['total_records'];

      $response = array(
        'draw'              => $draw,
        'recordsTotal'      => $total_records,
        'recordsFiltered'   => $total_records,
        'data'              => $json
      );
      echo json_encode($response);
    }
    else
    {
      $response = array();
      $response['sEcho']=0;
      $response['iTotalRecords']=0;
      $response['iTotalDisplayRecords']=0;
      $response['aaData']=[];
      echo json_encode($response);
    }
  }
}