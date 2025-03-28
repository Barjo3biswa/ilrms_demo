<?php

class EkhajanaMouzadarCommissionController extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ekhajana/EkhajanaDoulModel');
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
        return $this->db;                                                                                                                                                                                                              
    }
    //index method
    public function index(){    
	    $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['circle_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');  
        //***************************************************************************/
        //getting demand satisfied year 
        $this->dbb = $this->dbswitch($data['dist_code']);
        $demand_statisfied_year_q = $this->dbb->query("select upto_demand_satisfied_year from 
        ekhajana_demand_satisfy_year where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?",
        array($data['dist_code'], $data['subdiv_code'], $data['circle_code'], $data['mouza_pargona_code'])); 

        if($demand_statisfied_year_q->num_rows() == 0){
            $data['demand_statisfied_year'] = "--";
        }else{
            $data['demand_statisfied_year'] = $demand_statisfied_year_q->row()->upto_demand_satisfied_year;
        }
        //***************************************************************************/
        $CI = &get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $amount_details = $this->db->query("select sum(total_commission) as total_commision,
                          sum(total_commission+revenue_head_amount) as total_amount from ekhajana_commission_details 
                          where status='F' and dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?",
                          array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code))->row();
        
        $data['total_commission'] = $amount_details->total_commision; 
        $data['total_amount'] = $amount_details->total_amount;
        //echo "<pre>";
        //var_dump($data);
        //exit;
        $data['_view'] = 'e_khajana/mouz_views/commission_views/index';
        $this->load->view('layouts/main', $data);
    }
    //commision details view
    public function commisionReport(){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        // exit; 
        //********************************************************************/
        $this->load->library('form_validation');
        $this->form_validation->set_rules('start_date', 'Start Date Selection', 'trim|required');
        $this->form_validation->set_rules('to_date', 'End Date Selection', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_error_delimiters('', '');
            $validation = [];
            if (form_error('start_date')) {
                $data['error'] = true;
                $data['message']="Please Select The Form-Date..!";
                $data['_view'] = 'e_khajana/mouz_views/commission_views/commission_report';
                $this->load->view('layouts/main', $data);
                return;
            }
            if (form_error('to_date')) {
                $data['error'] = true;
                $data['message']="Please Select The To-Date..!";
                $data['_view'] = 'e_khajana/mouz_views/commission_views/commission_report';
                $this->load->view('layouts/main', $data);
                return;
            }
        }
        //********************************************************************/
        $data['from_date'] = $_POST['start_date'];
        $data['to_date'] = $_POST['to_date'];
        $date1 = new DateTime($data['from_date']);
        $date2 = new DateTime($data['to_date']);
        $interval = $date1->diff($date2);
        if($interval->format("%a")>15){
            $data['error'] = true;
            $data['message']="Please Select The Date Range Between 15 Days..!";
            $data['_view'] = 'e_khajana/mouz_views/commission_views/commission_report';
            $this->load->view('layouts/main', $data);
            return;
        };
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code'] = $subdiv_code = $this->session->userdata('subdiv_code');
        $data['circle_code'] = $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');  
        //********************************************************************/
        $CI = &get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $commission_details = $this->db->query("select * from ekhajana_commission_details ecd join 
                    ekhajana_egras_log elg on ecd.application_no=elg.application_no
                    where 
                    ecd.dist_code=? and ecd.subdiv_code=? and ecd.cir_code=? and ecd.mouza_pargona_code=? 
                    and ecd.status=?
                    and date(ecd.created_at) BETWEEN ? and ?",
                    array(strval($dist_code),strval($subdiv_code),strval($cir_code),
                    strval($mouza_pargona_code),'F',$data['from_date'],$data['to_date']))->result();
        if(count($commission_details) == 0){
            $data['error'] = true;
            $data['message']="No Records Found In The Selected Date Range..!";
            $data['_view'] = 'e_khajana/mouz_views/commission_views/commission_report';
            $this->load->view('layouts/main', $data);
            return;
        }
        $data['total_commsion'] = $this->db->query("select sum(total_commission) from ekhajana_commission_details 
                    where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status=?
                    and date(created_at) BETWEEN ? and ?",
                    array(strval($dist_code),strval($subdiv_code),strval($cir_code),
                    strval($mouza_pargona_code),'F',$data['from_date'],$data['to_date']))->row()->sum;
        // echo "<pre>";
        // var_dump($data['commission_details']);
        // echo "</pre>";
        // exit;
        $data['error'] = false;
        $data['commission_details'] = $commission_details; 
        $data['_view'] = 'e_khajana/mouz_views/commission_views/commission_report';
        $this->load->view('layouts/main', $data);
    }
}
?>
