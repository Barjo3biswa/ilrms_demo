<?php

class EkhajanaMouzadariDashboard extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ekhajana/EkhajanaMouzadarDashboardModel');
        $this->dbswitch($this->session->userdata('dist_code'));
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
        }                                                                                                                                                                                                              
    }

    public function index(){
        $data['mouzadari_total_applications_info'] = $this->EkhajanaMouzadarDashboardModel->getMouzadariArearsTotalApplicationInfo();
        // echo "<pre>";
        // var_dump($mouzadari_total_applications_info);
        // echo "</pre>";  
        $data['mouzadari_dist_wise_applications_info'] = $this->EkhajanaMouzadarDashboardModel->getMouzadariArearsDistrictWiseApplicationInfo();      
        // echo "<pre>";
        // var_dump($data['mouzadari_dist_wise_applications_info']);
        // echo "</pre>";
        $data['_view'] = 'e_khajana/dlr_dashboard/mouz_dashboard/index';
		$this->load->view('layouts/main', $data);
    }

    public function circleWiseInfo($dist_code){        
        $data['circle_wise_applications_info'] = $this->EkhajanaMouzadarDashboardModel->getMouzadariArearsCircletWiseApplicationInfo($dist_code);
        // echo "<pre>";
        // var_dump($data['circle_wise_applications_info']);
        // echo "</pre>";
        $data['_view'] = 'e_khajana/dlr_dashboard/mouz_dashboard/circle_wise_info';
		$this->load->view('layouts/main', $data);
    }

    public function mouzaWiseInfo($dist_code, $subdiv_code, $cir_code){
        $data['mouza_wise_applications_info'] = $this->EkhajanaMouzadarDashboardModel->getMouzadariArearsMouzatWiseApplicationInfo($dist_code, $subdiv_code, $cir_code);
        // echo "<pre>";
        // var_dump($data['mouza_wise_applications_info']);
        // echo "</pre>";
        $data['_view'] = 'e_khajana/dlr_dashboard/mouz_dashboard/mouza_wise_info';
		$this->load->view('layouts/main', $data);
    }

}
?>