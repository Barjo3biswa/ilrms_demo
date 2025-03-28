<?php

class EkhajanaPatta extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('ekhajana/Cfr/EkhajanaCfrModel');
        $this->dbswitch();
    }

    //db switch method
    public function dbswitch(){       
        $CI=&get_instance();
        if($this->session->userdata('dist_code') == "02"){
        $this->db=$CI->load->database('dhubri', TRUE);    
        } else if($this->session->userdata('dist_code') == "05"){
        $this->db=$CI->load->database('barpeta', TRUE);    
        } else if($this->session->userdata('dist_code') == "10"){
        $this->db=$CI->load->database('chirang', TRUE);       
        } else if($this->session->userdata('dist_code') == "13"){
        $this->db=$CI->load->database('bongaigaon', TRUE);    
        }  else if($this->session->userdata('dist_code') == "17"){
        $this->db=$CI->load->database('dibrugarh', TRUE);    
        }  else if($this->session->userdata('dist_code') == "15"){
        $this->db=$CI->load->database('jorhat', TRUE);    
        }  else if($this->session->userdata('dist_code') == "14"){
        $this->db=$CI->load->database('golaghat', TRUE);    
        }  else if($this->session->userdata('dist_code') == "07"){
        $this->db=$CI->load->database('kamrup', TRUE);    
        }  else if($this->session->userdata('dist_code') == "03"){
        $this->db=$CI->load->database('goalpara', TRUE);    
        }  else if($this->session->userdata('dist_code') == "18"){
        $this->db=$CI->load->database('tinsukia', TRUE);    
        }  else if($this->session->userdata('dist_code') == "12"){
        $this->db=$CI->load->database('lakhimpur', TRUE);   
        }  else if($this->session->userdata('dist_code') == "24"){
        $this->db=$CI->load->database('kamrupM', TRUE);   
        }  else if($this->session->userdata('dist_code') == "06"){
        $this->db=$CI->load->database('nalbari', TRUE);   
        }  else if($this->session->userdata('dist_code') == "11"){
        $this->db=$CI->load->database('sonitpur', TRUE);   
        }  else if($this->session->userdata('dist_code') == "12"){
        $this->db=$CI->load->database('lakhimpur', TRUE);   
        }  else if($this->session->userdata('dist_code') == "16"){
        $this->db=$CI->load->database('sibsagar', TRUE);   
        }  else if($this->session->userdata('dist_code') == "32"){
        $this->db=$CI->load->database('morigaon', TRUE);   
        }  else if($this->session->userdata('dist_code') == "33"){
        $this->db=$CI->load->database('nagaon', TRUE);   
        }  else if($this->session->userdata('dist_code') == "34"){
        $this->db=$CI->load->database('majuli', TRUE);   
        }  else if($this->session->userdata('dist_code') == "21"){
        $this->db=$CI->load->database('karimganj', TRUE);   
        }  else if($this->session->userdata('dist_code') == "08"){
        $this->db=$CI->load->database('darrang', TRUE);   
        }  else if($this->session->userdata('dist_code') == "35"){
        $this->db=$CI->load->database('biswanath', TRUE);   
        }  else if($this->session->userdata('dist_code') == "36"){
        $this->db=$CI->load->database('hojai', TRUE);   
        }  else if($this->session->userdata('dist_code') == "37"){
        $this->db=$CI->load->database('charaideo', TRUE);   
        }  else if($this->session->userdata('dist_code') == "25"){
        $this->db=$CI->load->database('dhemaji', TRUE);   
        }  else if($this->session->userdata('dist_code') == "38"){
        $this->db=$CI->load->database('ssalmara', TRUE);   
        }  else if($this->session->userdata('dist_code') == "39"){
        $this->db=$CI->load->database('bajali', TRUE);   
        }                                                                                                                                                                                                              
    }

    public function pattaStatus(){
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code']= $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code']= $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        //location names
        $data['district_name'] = $this->utilclass->getDistrictName($dist_code);
        $data['subdiv_name'] = $this->utilclass->getSubdivName($dist_code, $subdiv_code);
        $data['circle_name'] = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
        $data['mouza_name'] = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);
        $data['lot_list']   = $this->EkhajanaCfrModel->getAllLots($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);        
        $data['_view'] = 'e_khajana/patta_details/patta_status';
        $this->load->view('layouts/main',$data);
    }

    public function getPattaApplyDetails_old(){
        //***********************************************************/
        $params = json_decode(file_get_contents("php://input"));
        $data['dist_code'] = $dist_code = $params->dist_code;
        $data['subdiv_code'] = $subdiv_code = $params->subdiv_code;
        $data['cir_code'] = $cir_code = $params->cir_code;
        $data['mouza_pargona_code'] = $mouza_pargona_code = $params->mouza_pargona_code;
        $data['lot_no'] = $lot_no = $params->lot_no;
        $data['vill_townprt_code'] = $vill_townprt_code = $params->vill_townprt_code;
        $data['patta_type_code'] = $patta_type_code = $params->patta_type_code;
        $data['patta_no'] = $patta_no = $params->patta_no;
        //***********************************************************/
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $ekhajana_registration_details_query = $this->db->query("select eld.application_no,eld.ld_application_no,
                        eld.status,eld.created_at,eld.pdar_name
                        from ekhajana_land_details eld join ekhajana_applications
                        ea on eld.application_no=ea.application_no where ea.initial_payment_status in ('N','C')  and eld.dist_code=? and eld.subdiv_code=? and eld.cir_code=?
                        and eld.mouza_pargona_code=? and eld.lot_no=? and eld.vill_townprt_code=? and 
                        eld.patta_type_code=? and eld.patta_no=?", array($dist_code,$subdiv_code,$cir_code,
                        $mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no));
        $data['ekhajana_registration_details'] = $ekhajana_registration_details_query->result();
        $data['payment_status'] = "UNPAID";

        foreach($ekhajana_registration_details as $ekhajana_registartion_detail){
            $ekhajana_payment_query = $this->db->query("select count(*) as c from ekhajana_payment where 
                                                        ld_application_no=? and status=?", 
                                                        array($ekhajana_registartion_detail->ld_application_no,'F'));
            $payment_count = $ekhajana_payment_query->row()->c;
            if($payment_count >= 1){
		//$payment_status = "PAID";
		$data['payment_status'] = "PAID";
                break;
            }
        }

        $view = $this->load->view('e_khajana/patta_details/patta_details_view', $data, TRUE);
        echo json_encode($view);
    }


    public function getPattaApplyDetails(){
        //***********************************************************/
        $params = json_decode(file_get_contents("php://input"));
        $data['dist_code'] = $dist_code = $params->dist_code;
        $data['subdiv_code'] = $subdiv_code = $params->subdiv_code;
        $data['cir_code'] = $cir_code = $params->cir_code;
        $data['mouza_pargona_code'] = $mouza_pargona_code = $params->mouza_pargona_code;
        $data['lot_no'] = $lot_no = $params->lot_no;
        $data['vill_townprt_code'] = $vill_townprt_code = $params->vill_townprt_code;
        $data['patta_type_code'] = $patta_type_code = $params->patta_type_code;
        $data['patta_no'] = $patta_no = $params->patta_no;
        //***********************************************************/
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $ekhajana_registration_details_query = $this->db->query("select eld.application_no,eld.ld_application_no,
                        eld.status,eld.created_at,eld.pdar_name
                        from ekhajana_land_details eld join ekhajana_applications
                        ea on eld.application_no=ea.application_no where ea.initial_payment_status in ('N','C') and 
                        eld.repayment_flag is null and eld.dist_code=? and eld.subdiv_code=? and eld.cir_code=?
                        and eld.mouza_pargona_code=? and eld.lot_no=? and eld.vill_townprt_code=? and 
                        eld.patta_type_code=? and eld.patta_no=?", array($dist_code,$subdiv_code,$cir_code,
                        $mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no));
        $data['ekhajana_registration_details'] = $ekhajana_registration_details_query->result();
        

        $payment_query_count = $this->db->query("select count(*) as c  from ekhajana_land_details eld join ekhajana_payment ep
                        on eld.ld_application_no = ep.ld_application_no where eld.status=? and ep.status=?
                        and eld.dist_code=? and eld.subdiv_code=? and eld.cir_code=?
                        and eld.mouza_pargona_code=? and eld.lot_no=? and eld.vill_townprt_code=? and 
                        eld.patta_type_code=? and eld.patta_no=?", array('F','F',$dist_code,$subdiv_code,$cir_code,
                        $mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no))->row()->c;

        if($payment_query_count >= 1){
            $data['payment_status'] = "PAID";
        }else{
            $data['payment_status'] = "UNPAID";
        }

        $view = $this->load->view('e_khajana/patta_details/patta_details_view', $data, TRUE);
        echo json_encode($view);
    }


}
?> 
