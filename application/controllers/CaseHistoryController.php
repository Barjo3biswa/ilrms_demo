<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CaseHistoryController extends MY_CONTROLLER
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->library('form_validation');
        $this->load->model('Department_model');
        //$this->load->model('CaseHistoryModel');
    }

    public function dbswitch($dist_code)
    {
        //$CI=&get_instance();
        
        if($dist_code == "02"){
            $this->dbb=$this->load->database('dhubri', TRUE);
        } else if($dist_code == "05"){
            $this->dbb=$this->load->database('barpeta', TRUE);
        } else if($dist_code == "10"){
            $this->dbb=$this->load->database('chirang', TRUE);
        } else if($dist_code == "13"){
            $this->dbb=$this->load->database('bongaigaon', TRUE);
        }  else if($dist_code == "17"){
            $this->dbb=$this->load->database('dibrugarh', TRUE);
        }  else if($dist_code == "15"){
            $this->dbb=$this->load->database('jorhat', TRUE);
        }  else if($dist_code == "14"){
            $this->dbb=$this->load->database('golaghat', TRUE);
        }  else if($dist_code == "07"){
            $this->dbb=$this->load->database('kamrup', TRUE);
        }  else if($dist_code == "03"){
            $this->dbb=$this->load->database('goalpara', TRUE);
        }  else if($dist_code == "18"){
            $this->dbb=$this->load->database('tinsukia', TRUE);
        }  else if($dist_code == "12"){
            $this->dbb=$this->load->database('lakhimpur', TRUE);
        }  else if($dist_code == "24"){
            $this->dbb=$this->load->database('kamrupm', TRUE);
        }  else if($dist_code == "06"){
            $this->dbb=$this->load->database('nalbari', TRUE);
        }  else if($dist_code == "11"){
            $this->dbb=$this->load->database('sonitpur', TRUE);
        }  else if($dist_code == "16"){
            $this->dbb=$this->load->database('sibsagar', TRUE);
        }  else if($dist_code == "32"){
            $this->dbb=$this->load->database('morigaon', TRUE);
        }  else if($dist_code == "33"){
            $this->dbb=$this->load->database('nagaon', TRUE);
        }  else if($dist_code == "34"){
            $this->dbb=$this->load->database('majuli', TRUE);
        }  else if($dist_code == "21"){
            $this->dbb=$this->load->database('karimganj', TRUE);
        }  else if($dist_code == "35"){
            $this->dbb=$this->load->database('biswanath', TRUE);
        }  else if($dist_code == "36"){
            $this->dbb=$this->load->database('hojai', TRUE);
        }  else if($dist_code == "37"){
            $this->dbb=$this->load->database('charaideo', TRUE);
        }  else if($dist_code == "25"){
            $this->dbb=$this->load->database('dhemaji', TRUE);
        }  else if($dist_code == "39"){
            $this->dbb=$this->load->database('bajali', TRUE);
        }else if($dist_code == "38"){
            $this->dbb=$this->load->database('ssalmara', TRUE);
        }else if($dist_code == "08"){
            $this->dbb=$this->load->database('darrang', TRUE);
        }else if($dist_code == "auth"){
            $this->dbb=$this->load->database('auth', TRUE);
        }
        return $this->dbb;
    }


    function caseSearch()
    {
        $data['_view'] = 'Department/CaseSearch';
        $this->load->view('layouts/main', $data);
    }

    function caseHistory()
    {
        $this->form_validation->set_rules('dist_code', 'District', 'required');
        // $this->form_validation->set_rules('case_type', 'Type', 'required');
        $this->form_validation->set_rules('case_no', 'Case No', 'required');


        if ($this->form_validation->run()) {
            $dist_code = $this->input->post('dist_code');
            $case_no = $this->input->post('case_no');


            $data['district'] = $this->Department_model->fetchDistName($dist_code);
            $this->dbb = $this->dbswitch($dist_code);
            // $appl_id = $this->Department_model->getApplicationNoByCaseNo($dist_code,$case_no);
            // $appl_no =$appl_id->basundhara;
            // $data['basundharaAttachment'] = $this->Department_model->getDharitreeDocument($appl_no);
            // var_dump($basundharaAttachment);die;
            // $data['history'] = $this->Department_model->fetchHistory();
            $location = $this->Department_model->getLocationDetailsByCaseNo($dist_code,$case_no);
 
            $data['lot_name'] = $this->utilclass->getLotName($location->dist_code, $location->subdiv_code, $location->cir_code, $location->mouza_pargona_code, $location->lot_no);
            $data['village_name'] = $this->utilclass->getVillageName($location->dist_code, $location->subdiv_code, $location->cir_code, $location->mouza_pargona_code, $location->lot_no,$location->vill_townprt_code);
            // var_dump($data['lot_name']);die;

            $data['applicant_details'] = $this->Department_model->getApplicatDetailsByCaseNo($dist_code,$case_no);
            $data['remark_details'] = $this->Department_model->getCaseRemarksByCaseNo($dist_code,$case_no);
            $data['case_flow_details'] = $this->Department_model->getCaseFlowDetailsByCaseNo($dist_code,$case_no);
            // var_dump($data['remark_details']);die;

            $data['_view'] = 'Department/caseHistoryDetails';
            $this->load->view('layouts/main', $data);
        } else {
            $data['_view'] = 'Department/caseHistory';
            $this->load->view('layouts/main', $data);
        }
    }

    function document($doc){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, API_LINK."attachment");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query(array(
            'name' => $doc
        )));
        $result = curl_exec($curl_handle);
        $result = json_decode($result);
        $output=$result->raw_data;
        $content_type=$result->mime_type;
        $check=explode("/",$content_type);
        if($check[1]=='pdf'){
            $output=base64_decode($output);
            header('Content-type: application/pdf');
            echo $output;
        }else{
            echo '<img src="data:'.$content_type.';base64,'.$output.'" />';
        }
    }


    function caseHistoryNew()
    {
        $this->form_validation->set_rules('dist_code', 'District', 'required');
        // $this->form_validation->set_rules('case_type', 'Type', 'required');
        $this->form_validation->set_rules('case_no', 'Case No', 'required');


        if ($this->form_validation->run()) {
            $dist_code = $this->input->post('dist_code');
            $case_no = $this->input->post('case_no');


            $data['district'] = $this->Department_model->fetchDistName($dist_code);
            $this->dbb = $this->dbswitch($dist_code);
            $data['caseData'] = $location = $this->Department_model->getLocationDetailsByCaseNo($dist_code,$case_no);
 
            $data['lot_name'] = $this->utilclass->getLotName($location->dist_code, $location->subdiv_code, $location->cir_code, $location->mouza_pargona_code, $location->lot_no);
            $data['village_name'] = $this->utilclass->getVillageName($location->dist_code, $location->subdiv_code, $location->cir_code, $location->mouza_pargona_code, $location->lot_no,$location->vill_townprt_code);
            // var_dump($data['lot_name']);die;

            $data['applicant_details'] = $this->Department_model->getApplicatDetailsByCaseNo($dist_code,$case_no);
            $data['remark_details'] = $this->Department_model->getCaseRemarksByCaseNoConv($dist_code,$case_no);
            $data['lm_remark_details'] = $this->Department_model->getCaseLMRemarksByCaseNoConv($dist_code,$case_no);
            $data['case_flow_details'] = $this->Department_model->getCaseFlowDetailsByCaseNo($dist_code,$case_no);
            //var_dump($data['remark_details']);die;

            $data['_view'] = 'Department/caseHistoryDetailsConv';
            $this->load->view('layouts/main', $data);
        } else {
            $data['_view'] = 'Department/caseHistoryNew';
            $this->load->view('layouts/main', $data);
        }
    }


    function caseHistoryFmut()
    {
        $this->form_validation->set_rules('dist_code', 'District', 'required');
        // $this->form_validation->set_rules('case_type', 'Type', 'required');
        $this->form_validation->set_rules('case_no', 'Case No', 'required');


        if ($this->form_validation->run()) {
            $dist_code = $this->input->post('dist_code');
            $case_no = $this->input->post('case_no');


            $data['district'] = $this->Department_model->fetchDistName($dist_code);
            $this->dbb = $this->dbswitch($dist_code);
            $data['caseData'] = $location = $this->Department_model->getLocationDetailsByCaseNoFmut($dist_code,$case_no);
 
            $data['lot_name'] = $this->utilclass->getLotName($location->dist_code, $location->subdiv_code, $location->cir_code, $location->mouza_pargona_code, $location->lot_no);
            $data['village_name'] = $this->utilclass->getVillageName($location->dist_code, $location->subdiv_code, $location->cir_code, $location->mouza_pargona_code, $location->lot_no,$location->vill_townprt_code);
            // var_dump($data['lot_name']);die;

            $data['applicant_details'] = $this->Department_model->getApplicatDetailsByCaseNoFmut($dist_code,$case_no);
            $data['remark_details'] = $this->Department_model->getCaseRemarksByCaseNoFMUT($dist_code,$case_no);
            $data['lm_remark_details'] = $this->Department_model->getRemarksByCaseNoFmut($dist_code,$case_no);
            $data['case_flow_details'] = $this->Department_model->getCaseFlowDetailsByCaseNo($dist_code,$case_no);
            // var_dump($data['lm_remark_details'][0]->remark);die;

            $data['_view'] = 'Department/caseHistoryDetailsFmut';
            $this->load->view('layouts/main', $data);
        } else {
            $data['_view'] = 'Department/caseHistoryFmut';
            $this->load->view('layouts/main', $data);
        }
    }




    function caseHistoryOMUTC()
    {
        $this->form_validation->set_rules('dist_code', 'District', 'required');
        // $this->form_validation->set_rules('case_type', 'Type', 'required');
        $this->form_validation->set_rules('case_no', 'Case No', 'required');


        if ($this->form_validation->run()) {
            $dist_code = $this->input->post('dist_code');
            $case_no = $this->input->post('case_no');


            $data['district'] = $this->Department_model->fetchDistName($dist_code);
            $this->dbb = $this->dbswitch($dist_code);
            $location = $this->Department_model->getLocationDetailsByCaseNo($dist_code,$case_no);
 
            $data['lot_name'] = $this->utilclass->getLotName($location->dist_code, $location->subdiv_code, $location->cir_code, $location->mouza_pargona_code, $location->lot_no);
            $data['village_name'] = $this->utilclass->getVillageName($location->dist_code, $location->subdiv_code, $location->cir_code, $location->mouza_pargona_code, $location->lot_no,$location->vill_townprt_code);
            // var_dump($data['lot_name']);die;

            $data['applicant_details'] = $this->Department_model->getApplicatDetailsByCaseNoOmutc($dist_code,$case_no);
            $data['remark_details'] = $this->Department_model->getCaseRemarksByCaseNoConv($dist_code,$case_no);
            //$data['lm_remark_details'] = $this->Department_model->getCaseLMRemarksByCaseNoConv($dist_code,$case_no);
            $data['case_flow_details'] = $this->Department_model->getCaseFlowDetailsByCaseNo($dist_code,$case_no);
            //var_dump($data['remark_details']);die;

            $data['_view'] = 'Department/caseHistoryDetailsOmutc';
            $this->load->view('layouts/main', $data);
        } else {
            $data['_view'] = 'Department/caseHistoryOmutc';
            $this->load->view('layouts/main', $data);
        }
    }


    function caseHistoryFpart()
    {
        $this->form_validation->set_rules('dist_code', 'District', 'required');
        // $this->form_validation->set_rules('case_type', 'Type', 'required');
        $this->form_validation->set_rules('case_no', 'Case No', 'required');


        if ($this->form_validation->run()) {
            $dist_code = $this->input->post('dist_code');
            $case_no = $this->input->post('case_no');


            $data['district'] = $this->Department_model->fetchDistName($dist_code);
            $this->dbb = $this->dbswitch($dist_code);
            $location = $this->Department_model->getLocationDetailsByCaseNoFmut($dist_code,$case_no);
 
            $data['lot_name'] = $this->utilclass->getLotName($location->dist_code, $location->subdiv_code, $location->cir_code, $location->mouza_pargona_code, $location->lot_no);
            $data['village_name'] = $this->utilclass->getVillageName($location->dist_code, $location->subdiv_code, $location->cir_code, $location->mouza_pargona_code, $location->lot_no,$location->vill_townprt_code);
            // var_dump($data['lot_name']);die;

            $data['applicant_details'] = $this->Department_model->getApplicatDetailsByCaseNoFpart($dist_code,$case_no);
            $data['remark_details'] = $this->Department_model->getCaseRemarksByCaseNoFPART($dist_code,$case_no);
           // $data['lm_remark_details'] = $this->Department_model->getCaseLMRemarksByCaseNoConv($dist_code,$case_no);
            $data['case_flow_details'] = $this->Department_model->getCaseFlowDetailsByCaseNo($dist_code,$case_no);
            //var_dump($data['remark_details']);die;

            $data['_view'] = 'Department/caseHistoryDetailsFpart';
            $this->load->view('layouts/main', $data);
        } else {
            $data['_view'] = 'Department/caseHistoryFpart';
            $this->load->view('layouts/main', $data);
        }
    }

    

}