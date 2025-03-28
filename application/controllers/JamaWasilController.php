<?php

class JamaWasilController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ekhajana/EkhajanaJamawasilModel');
    }

    //index method
    public function index() {
        //checking mouzadar is authorised or not 
        $mouzadarflag = $this->checkIsMouzadar();
        if(!$mouzadarflag['flag']){
            $data['errorMessage'] = $mouzadarflag['result'];
            $data['_view'] = 'e_khajana/mouzadar_error_page';
            $this->load->view('layouts/main',$data);
            return;
        }
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_code'] = $mouza_code = $this->session->userdata('mouza_pargona_code');
        $data['dist_name'] = $dist_name = $this->utilclass->getDistrictName($dist_code);
        $data['subdiv_name'] = $subdiv_name = $this->utilclass->getSubDivName($dist_code, $subdiv_code);
        $data['cir_name'] = $cir_name = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
        $data['mouza_name'] = $mouza_name = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_code);
        $data['patta'] = $this->EkhajanaJamawasilModel->getPattaType($dist_code);
        $data['lot_list'] = $this->EkhajanaJamawasilModel->getLotNoJson($dist_code, $subdiv_code, $cir_code, $mouza_code);
        $data['village_list'] = $this->EkhajanaJamawasilModel->getVillagesJSON($dist_code, $subdiv_code, $cir_code, $mouza_code);
        $data['_view'] = 'e_khajana/jamaWasil/index';
        $this->load->view('layouts/main',$data);
    }

    //checking Is Mouzadar
	function checkIsMouzadar(){

        $dist_code = $this->session->userdata('dist_code');
        if (in_array($dist_code, json_decode(EKHAJANA_TEHSILDARI_SYSTEM_DIST_CODES)))
        {
            //tehsildari district     
            return ['flag'=>false, 'result'=>"Not Authorised..!.This Mouza Is Under Tehsildari System..!"];                
        }
        else
        {
            //mouzadari district            
            return ['flag'=>true, 'result'=>""];                
        }
    }

    public function saveJamabandiByEnteringPattano() {

        $concated_vill_lot = $_POST['village'];
        $explode_string = explode(",",$concated_vill_lot);
        
        $lot_no = $explode_string[0];
        $vill_townprt_code = $explode_string[1];
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_code = $this->session->userdata('mouza_pargona_code');
        $location = $dist_code."_".$subdiv_code."_".$cir_code."_".$mouza_code."_".$lot_no."_".$vill_townprt_code;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_JAMAWASIL_VIEW_API,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'location' => $location,
                'patta_type' => $_POST['patta_type'],
                'patta_no' => $_POST['patta_no'],
                'per_page' => $_POST['per_page']
            ),
        ));
        $response = curl_exec($curl);        
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 200){
            //return "curl successfull";
            $response_obj = json_decode($response);
            if($response_obj->responseType == 2){
                //echo $response_obj->data;
                echo base64_decode($response_obj->data);
            }else{
                log_message("error", "#EKCRLJW0001, Curl Error(Y) In Api ".EKHAJANA_JAMAWASIL_VIEW_API);
                echo json_encode("Internal Server Error, Please Try Again Later..., Error Code #EKCRLJW0001");
            } 
        }else{
            log_message("error", "#EKCRLJW0002, Curl Error(200) In Api ".EKHAJANA_JAMAWASIL_VIEW_API);
            echo json_encode("Internal Server Error, Please Try Again Later..., Error Code #EKCRLJW0002");
        }
    }

    //on lot change function
    public function getVillageCodeJSON($distcode, $subdivcode, $circode, $mouzacode, $lotno) {
        $db=  $this->session->userdata('db');
        $data = $this->EkhajanaJamawasilModel->getVillageCodeJSON($distcode, $subdivcode, $circode, $mouzacode, $lotno);
        $json = array();
        foreach ($data as $object) {
            $json[] = array('loc_name' => $object->loc_name, 'vill_townprt_code' => $object->vill_townprt_code);
        }
        echo json_encode($json);
    }
    
}