<?php

class NyksModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
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
        }   else if($this->session->userdata('dist_code') == "39"){
         $this->db=$CI->load->database('bajali', TRUE);
        }                                                                                                                                                                                                            
    }

    public function allRegisteredApplications($unique_user_id)
    {
        $CI = &get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $query = $this->db->query("select count(*) as count from ekhajana_land_details eld join ekhajana_applications ea on eld.application_no = ea.application_no where eld.external_agent_id=? and ea.is_draft=? and ea.initial_payment_status =?",array($unique_user_id,'N','N'));
        // return $this->db->last_query();
        if($query->num_rows() == 0)
        {
            return 0;
        }else{
            return $query->row()->count;
        }

    }

    public function allDisposedApplications($unique_user_id)
    {
        $CI = &get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $query = $this->db->query("select count(*) as count from ekhajana_land_details eld join ekhajana_applications ea on eld.application_no = ea.application_no where eld.external_agent_id=? and ea.is_draft=? and ea.initial_payment_status =? and ea.status =?",array($unique_user_id,'N','N','F'));
        if($query->num_rows() == 0)
        {
            return 0;
        }else{
            return $query->row()->count;
        }

    }

    public function allRejectedApplications($unique_user_id)
    {
        $CI = &get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $query = $this->db->query("select count(*) as count from ekhajana_land_details eld join ekhajana_applications ea on eld.application_no = ea.application_no where eld.external_agent_id=? and ea.is_draft=? and ea.initial_payment_status =? and ea.status =?",array($unique_user_id,'N','N','R'));
        if($query->num_rows() == 0)
        {
            return 0;
        }else{
            return $query->row()->count;
        }

    }

    public function getAllSubdivs($dist_code)
    {
        $this->dbswitch();
        $query = $this->db->query("select dist_code,subdiv_code,loc_name from location where dist_code=? and subdiv_code!=? and cir_code=?",array($dist_code,'00','00'));
        return $query->result();
    }

    public function getAllCircles($dist_code,$subdiv_code)
    {
        $this->dbswitch();
        $query = $this->db->query("select dist_code,subdiv_code,cir_code,loc_name from location where dist_code=? and subdiv_code=? and cir_code!=? and mouza_pargona_code=?",array($dist_code,$subdiv_code,'00','00'));
        return $query->result();
    }


    public function getAllMouzas($dist_code,$subdiv_code,$cir_code)
    {
        $this->dbswitch();
        $query = $this->db->query("select dist_code,subdiv_code,cir_code,mouza_pargona_code,loc_name from location where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code!=? and lot_no=?",array($dist_code,$subdiv_code,$cir_code,'00','00'));
        return $query->result();
    }

    public function getAllVillages($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)
    {
        $this->dbswitch();
        $query = $this->db->query("select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,loc_name from location where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no!=? and vill_townprt_code!=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,'00','00000'));
        return $query->result();
    }

    public function getAllPattaTypes()
    {
        $this->dbswitch();
        $query = $this->db->query("select * from patta_code where jamabandi=?",array('y'));
        return $query->result();
    }

    public function getAllPattaNumbers()
    {
        $this->dbswitch();
        $query = $this->db->query("select distinct(patta_no) from chitha_basic where jama_yn=?  order by patta_no asc",array('y'));
        return $query->result();
    }

    public function getAllPattaNos($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code)
    {
        $this->dbswitch();
        $query = $this->db->query("select distinct(patta_no) from chitha_basic where jama_yn=? and dist_code=? and subdiv_code=?
        and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? order by patta_no asc",array('y',$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code));
        return $query->result();
    }

    public function getAllPattadars($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no)
    {
        $this->dbswitch();
        $sql= "select cp.pdar_id,cp.pdar_name,cp.pdar_father from chitha_pattadar as cp join chitha_dag_pattadar as cdp on cp.dist_code = cdp.dist_code 
        and cp.subdiv_code = cdp.subdiv_code and cp.cir_code = cdp.cir_code and 
        cp.mouza_pargona_code = cdp.mouza_pargona_code and cp.lot_no = cdp.lot_no and cp.vill_townprt_code = cdp.vill_townprt_code and 
        trim(cp.patta_no) = trim(cdp.patta_no) and cp.patta_type_code = cdp.patta_type_code and cp.pdar_id = cdp.pdar_id where cdp.dist_code = '$dist_code' 
        and cdp.subdiv_code = '$subdiv_code' and cdp.cir_code = '$cir_code' and cdp.mouza_pargona_code = '$mouza_pargona_code' and cdp.lot_no = '$lot_no'
        and cdp.vill_townprt_code = '$vill_townprt_code' and cdp.patta_type_code = '$patta_type_code' and (cdp.p_flag != '1' or cdp.p_flag is null)  
        and trim(cdp.patta_no) in (select trim(patta_no) from chitha_basic as cb where cb.dist_code = '$dist_code'
        and cb.subdiv_code = '$subdiv_code' and cb.cir_code = '$cir_code' and cb.mouza_pargona_code = '$mouza_pargona_code' and cb.lot_no = '$lot_no'
        and cb.vill_townprt_code = '$vill_townprt_code' and cb.patta_type_code = '$patta_type_code' and trim(cb.patta_no)=trim('$patta_no'))";    
        $data= $this->db->query($sql)->result();
        return $data; 
    }
}
?>
