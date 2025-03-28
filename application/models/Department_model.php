<?php

class Department_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get location by dist_code
     */
    function get_location($dist_code,$s,$c,$m,$l,$v)
    {
        return $this->db->get_where('location',array('dist_code'=>$dist_code,'subdiv_code'=>$s,
            'cir_code'=>$c,'mouza_pargona_code'=>$m,'lot_no'=>$l,'vill_townprt_code'=>$v))->row_array();
    }
        
    /*
     * Get all location
     */
    function get_all_location()
    {
        $this->db->order_by('dist_code', 'desc');
        $this->db->order_by('subdiv_code', 'asc');
        $this->db->order_by('cir_code', 'asc');
        $this->db->order_by('mouza_pargona_code', 'asc');
        $this->db->order_by('lot_no', 'asc');
        $this->db->order_by('vill_townprt_code', 'asc');
        return $this->db->get('location')->result_array();
    }
     function get_all_District()
    {
        $this->db->order_by('dist_code', 'desc');
		$this->db->where('dist_code !=','00');
		$this->db->where('subdiv_code','00');
		$this->db->where('cir_code','00');
		$this->db->where('mouza_pargona_code','00');
        return $this->db->get('location')->result_array();
    }
        
    /*
     * function to add new location
     */
    function add_location($params)
    {
       // $this->db->insert('location',$params);
       // return $this->db->insert_id();
        return  $this->db->insert('location',$params);;
    }
    
    /*
     * function to update location
     */
    function update_location($dist_code,$s,$c,$m,$l,$v,$params)
    {
        $this->db->where('dist_code',$dist_code);
        $this->db->where('subdiv_code',$s);
        $this->db->where('cir_code',$c);
        $this->db->where('mouza_pargona_code',$m);
        $this->db->where('lot_no',$l);
        $this->db->where('vill_townprt_code',$v);
        return $this->db->update('location',$params);
    }
    
    /*
     * function to delete location
     */
    function delete_location($dist_code)
    {
        return $this->db->delete('location',array('dist_code'=>$dist_code));
    }
	public function dbswitch($dist_code){
	    if($dist_code == "02"){
	        $this->db=$this->load->database('dhubri', TRUE);
	    } else if($dist_code == "05"){
	        $this->db=$this->load->database('barpeta', TRUE);
	    } else if($dist_code == "10"){
	        $this->db=$this->load->database('chirang', TRUE);
	    } else if($dist_code == "13"){
	        $this->db=$this->load->database('bongaigaon', TRUE);
	    }  else if($dist_code == "17"){
	        $this->db=$this->load->database('dibrugarh', TRUE);
	    }  else if($dist_code == "15"){
	        $this->db=$this->load->database('jorhat', TRUE);
	    }  else if($dist_code == "14"){
	        $this->db=$this->load->database('golaghat', TRUE);
	    }  else if($dist_code == "07"){
	        $this->db=$this->load->database('kamrup', TRUE);
	    }  else if($dist_code == "03"){
	        $this->db=$this->load->database('goalpara', TRUE);
	    }  else if($dist_code == "18"){
	        $this->db=$this->load->database('tinsukia', TRUE);
	    }  else if($dist_code == "12"){
	        $this->db=$this->load->database('lakhimpur', TRUE);
	    }  else if($dist_code == "24"){
	        $this->db=$this->load->database('kamrupm', TRUE);
	    }  else if($dist_code == "06"){
	        $this->db=$this->load->database('nalbari', TRUE);
	    }  else if($dist_code == "11"){
	        $this->db=$this->load->database('sonitpur', TRUE);
	    }  else if($dist_code == "16"){
	        $this->db=$this->load->database('sibsagar', TRUE);
	    }  else if($dist_code == "32"){
	        $this->db=$this->load->database('morigaon', TRUE);
	    }  else if($dist_code == "33"){
	        $this->db=$this->load->database('nagaon', TRUE);
	    }  else if($dist_code == "34"){
	        $this->db=$this->load->database('majuli', TRUE);
	    }  else if($dist_code == "21"){
	        $this->db=$this->load->database('karimganj', TRUE);
	    }  else if($dist_code == "35"){
	        $this->db=$this->load->database('biswanath', TRUE);
	    }  else if($dist_code == "36"){
	        $this->db=$this->load->database('hojai', TRUE);
	    }  else if($dist_code == "37"){
	        $this->db=$this->load->database('charaideo', TRUE);
	    }  else if($dist_code == "25"){
	        $this->db=$this->load->database('dhemaji', TRUE);
	    }  else if($dist_code == "39"){
	        $this->db=$this->load->database('bajali', TRUE);
	    }else if($dist_code == "38"){
	        $this->db=$this->load->database('ssalmara', TRUE);
	    }else if($dist_code == "08"){
	        $this->db=$this->load->database('darrang', TRUE);
	    }else if($dist_code == "auth"){
	        $this->db=$this->load->database('auth', TRUE);
	    }
	    return $this->db;
	}
    public function dbswitch1($dist_code){    
   
     //$CI=&get_instance();
     if($dist_code == "02"){
        $this->db=$this->load->database('dha3', TRUE);    
     } else if($dist_code == "05"){
        $this->db=$this->load->database('dha1', TRUE);    
      } else if($dist_code == "10"){
        $this->db=$this->load->database('dha24', TRUE);       
     } else if($dist_code == "13"){
        $this->db=$this->load->database('dha2', TRUE);    
     }  else if($dist_code == "17"){
        $this->db=$this->load->database('dha4', TRUE);    
     }  else if($dist_code == "15"){
        $this->db=$this->load->database('dha5', TRUE);    
     }  else if($dist_code == "14"){
        $this->db=$this->load->database('dha6', TRUE);    
     }  else if($dist_code == "07"){
        $this->db=$this->load->database('dha7', TRUE);    
     }  else if($dist_code == "03"){
        $this->db=$this->load->database('dha8', TRUE);    
     }  else if($dist_code == "18"){
        $this->db=$this->load->database('dha9', TRUE);    
     }  else if($dist_code == "12"){
        $this->db=$this->load->database('dha13', TRUE);   
     }  else if($dist_code == "24"){
        $this->db=$this->load->database('dha10', TRUE);   
     }  else if($dist_code == "06"){
        $this->db=$this->load->database('dha11', TRUE);   
     }  else if($dist_code == "11"){
        $this->db=$this->load->database('dha12', TRUE);   
     }  else if($dist_code == "12"){
        $this->db=$this->load->database('dha13', TRUE);   
     }  else if($dist_code == "16"){
        $this->db=$this->load->database('dha14', TRUE);   
     }  else if($dist_code == "32"){
        $this->db=$this->load->database('dha15', TRUE);   
     }  else if($dist_code == "33"){
        $this->db=$this->load->database('dha16', TRUE);   
     }  else if($dist_code == "34"){
        $this->db=$this->load->database('dha17', TRUE);   
     }  else if($dist_code == "21"){
        $this->db=$this->load->database('dha18', TRUE);   
     }  else if($dist_code == "08"){
        $this->db=$this->load->database('dha19', TRUE);   
     }  else if($dist_code == "35"){
        $this->db=$this->load->database('dha20', TRUE);   
     }  else if($dist_code == "36"){
        $this->db=$this->load->database('dha21', TRUE);   
     }  else if($dist_code == "37"){
        $this->db=$this->load->database('dha22', TRUE);   
     }  else if($dist_code == "25"){
        $this->db=$this->load->database('dha23', TRUE);   
     }  else if($dist_code == "39"){
      $this->db=$this->load->database('dha39', TRUE);   
     }    
     return $this->db;
}
	///////////////////////////////////////
	public function getSubDivJSON($distCode) {
        $this->db=$this->dbswitch($distCode);
        $district = $this->db->query("select * from location where dist_code =?  and "
                . " subdiv_code!='00' and cir_code='00' and mouza_pargona_code='00' and "
                . " vill_townprt_code='00000' and lot_no='00'",array($distCode));
        return $district->result();
    }
	public function getCirCodeJSON($distCode, $subdivcode) {
        $this->db=$this->dbswitch($distCode);
        $district = $this->db->query("select * from location where dist_code =?  and "
                . " subdiv_code=? and cir_code!='00' and mouza_pargona_code='00' and "
                . " vill_townprt_code='00000' and lot_no='00'",array($distCode,$subdivcode));
        return $district->result();
    }

    public function getMouzaJSON($distCode, $subdivcode, $circode) {
        $this->db=$this->dbswitch($distCode);
        $district = $this->db->query("select * from location where dist_code =?  and "
                . " subdiv_code=? and cir_code=? and mouza_pargona_code!='00' and "
                . " vill_townprt_code='00000' and lot_no='00'",array($distCode,$subdivcode,$circode));
        return $district->result();
    }

    public function getLotNoJSON($distCode, $subdivcode, $circode, $mouzacode) {
        $this->db=$this->dbswitch($distCode);
        $district = $this->db->query("select *  from location where dist_code =?  and "
                . " subdiv_code=? and cir_code=? and mouza_pargona_code=? and "
                . " vill_townprt_code='00000' and lot_no!='00' order by lot_no",
            array($distCode,$subdivcode,$circode,$mouzacode));
        return $district->result();
    }
    function getDcAdc($distCode){
        $this->db=$this->dbswitch($distCode);
        //$name=$this->db->query("select u.username as user_name,u.user_code from loginuser_table l join users u on l.user_code=u.user_code where l.dist_code='$distCode' and (l.user_code like 'DC%' or l.user_code like 'ADC%') order by l.date_of_creation");
        $name=$this->db->query("select u.username as user_name,u.user_code from 
        loginuser_table l join users u on l.user_code=u.user_code where l.dist_code='$distCode' 
        and (l.user_code like 'DC%' or l.user_code like 'ADC%') GROUP BY user_name,u.user_code order by u.user_code asc");

        $data= $name->result();

        return $data;
    }
    function getco($distCode, $subdivcode, $circode){
        $this->db=$this->dbswitch($distCode);
        //$district = $this->db->query("select u.username as user_name,u.user_code from loginuser_table l join users u on l.user_code=u.user_code and l.dist_code=u.dist_code and l.subdiv_code=u.subdiv_code and l.cir_code=u.cir_code where l.dist_code=? and l.subdiv_code=? and l.cir_code=? and l.user_code like 'CO%' order by l.date_of_creation ",array($distCode,$subdivcode,$circode));
        $district = $this->db->query("select u.username as user_name,u.user_code from 
            loginuser_table l join users u on l.user_code=u.user_code and l.dist_code=u.dist_code 
            and l.subdiv_code=u.subdiv_code and l.cir_code=u.cir_code where l.dist_code=? and l.subdiv_code=?
            and l.cir_code=? and l.user_code like 'CO%' GROUP BY user_name,u.user_code order by u.user_code asc",
            array($distCode,$subdivcode,$circode));

        return $data = $district->result();
    }
    function getlm($distCode, $subdivcode, $circode,$mouzacode,$lot_no){
        $this->db=$this->dbswitch($distCode);
        $district = $this->db->query("select u.lm_name as user_name,u.lm_code as user_code from 
        loginuser_table l join lm_code u on l.user_code=u.lm_code and l.dist_code=u.dist_code
        and l.subdiv_code=u.subdiv_code and l.cir_code=u.cir_code and l.mouza_pargona_code=u.mouza_pargona_code
        and l.lot_no=u.lot_no where l.dist_code=? and l.subdiv_code=? and l.cir_code=? 
        and l.mouza_pargona_code=? and l.lot_no=? and l.user_code like 'M%' order by l.date_of_creation ",
        array($distCode,$subdivcode,$circode,$mouzacode,$lot_no));

        return $data = $district->result();

    }
//    function fetchRecord(){
//        $fromDate=$this->input->post('from_date');
//        $upDate=$this->input->post('upto_date');
//        $dist_code=$this->input->post('dist_code');
//        $subdiv_code=$this->input->post('subdiv_code');
//        $cir_code=$this->input->post('cir_code');
//        $users=$this->input->post('users');
//        $this->db=$this->dbswitch($dist_code);
//        $sql="(Select ord_passby_sign_yn as order_pass, dist_code,subdiv_code,cir_code,mouza_pargona_code,
//          lot_no,vill_townprt_code,dag_no,ord_no,co_ord_date,co_code from chitha_rmk_ordbasic where
//          co_code='$users' and co_ord_date between '$fromDate' and '$upDate' )
//        UNION
//        (Select order_pass_yn as order_pass, dist_code,subdiv_code,cir_code,mouza_pargona_code,
//      lot_no,vill_townprt_code,dag_no,case_no as ord_no,co_ord_date ,co_code
//        from chitha_col8_order where co_code='$users' and co_ord_date between '$fromDate' and '$upDate')";
//        return $this->db->query($sql)->result_array();
//    }

    function fetchRecord(){
        $fromDate=$this->input->post('from_date');
        $upDate=$this->input->post('upto_date');
        $dist_code=$this->input->post('dist_code');
        $subdiv_code=$this->input->post('subdiv_code');
        $cir_code=$this->input->post('cir_code');
        $mouza_code=$this->input->post('mouza_code');
        $lot_code=$this->input->post('lot_code');
        $users=$this->input->post('users');
        if($this->input->post('user_type')=='C') {
            $co_name = $this->db->query("select username from users where 
            dist_code=? and subdiv_code=? 
            and cir_code=? and user_code=?",
                array($dist_code, $subdiv_code, $cir_code, $users))->row()->username;
        }
        $this->db=$this->dbswitch($dist_code);
        if($this->input->post('user_type')=='C') {
            $sql = "(Select DISTINCT ord_type_code as type, ord_passby_sign_yn as order_pass, dist_code,
            subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,ord_no,co_ord_date from 
            chitha_rmk_ordbasic where
            (ord_passby_sign_yn=? or ord_passby_sign_yn=?) and dist_code=? and subdiv_code=? and 
            cir_code=? and co_code=? and co_ord_date between '$fromDate' and '$upDate')
            UNION
            (Select DISTINCT order_type_code as type, order_pass_yn as order_pass, dist_code,
            subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,case_no as ord_no,co_ord_date
            from chitha_col8_order where (order_pass_yn=? or order_pass_yn=?) and dist_code=? 
            and subdiv_code=? and cir_code=? and co_code=? and co_ord_date between '$fromDate' and '$upDate')
            UNION
            (Select DISTINCT case_no as type, dc_yn as order_pass, dist_code,subdiv_code,
            cir_code,mouza_pargona_code,lot_no,vill_townprt_code,case_no as ord_no,
            co_date as co_ord_date
            from chitha_rmk_reclassification where (dc_yn=? or dc_yn=?) and dist_code=? 
            and subdiv_code=? and cir_code=? and co_recommendation like '%$co_name%' 
            and co_date between '$fromDate' and '$upDate')
            UNION
            (Select DISTINCT ord_type_code as type, ord_passby_sign_yn as order_pass, dist_code,
            subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,case_no as ord_no,co_ord_date
            from apt_chitha_rmk_ordbasic where (ord_passby_sign_yn=? or ord_passby_sign_yn=?) 
            and dist_code=? and subdiv_code=? and cir_code=? and co_code=? and co_ord_date between '$fromDate' and '$upDate')";
            return $this->db->query($sql, array('y','Y', $dist_code, $subdiv_code, $cir_code, $users,
                'y','Y', $dist_code, $subdiv_code, $cir_code, $users,'y','Y', $dist_code, $subdiv_code,
                $cir_code, 'y','Y', $dist_code, $subdiv_code, $cir_code, $users))->result_array();
        }
//        else if($this->input->post('user_type')=='L')
//        {
//            $sql = "(Select DISTINCT ord_type_code as type, ord_passby_sign_yn as order_pass,
//               dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,ord_no,
//                  lm_sign_date as co_ord_date from chitha_rmk_ordbasic where
//                  (ord_passby_sign_yn=? or ord_passby_sign_yn=?) and dist_code=?
//                  and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=?
//                  and lm_code=? and lm_sign_date between '$fromDate' and '$upDate' )
//            UNION
//            (Select DISTINCT order_type_code as type, order_pass_yn as order_pass,
//              dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,
//              case_no as ord_no,lm_note_date as co_ord_date
//            from chitha_col8_order where (order_pass_yn=? or order_pass_yn=?) and dist_code=?
//              and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=?
//              and lm_code=? and lm_note_date between '$fromDate' and '$upDate')
//            UNION
//            (Select DISTINCT case_no as type, dc_yn as order_pass, dist_code,subdiv_code,
//              cir_code,mouza_pargona_code,lot_no,vill_townprt_code,case_no as ord_no,lm_date as co_ord_date
//            from chitha_rmk_reclassification where (dc_yn=? or dc_yn=?) and dist_code=?
//              and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=?
//                 and lm_code=? and lm_date between '$fromDate' and '$upDate')
//            UNION
//            (Select DISTINCT ord_type_code as type, ord_passby_sign_yn as order_pass,
//              dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,
//              case_no as ord_no,lm_sign_date as co_ord_date
//            from apt_chitha_rmk_ordbasic where (ord_passby_sign_yn=? or ord_passby_sign_yn=?)
//            and dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=?
//            and lm_code=? and lm_sign_date between '$fromDate' and '$upDate')";
//            return $this->db->query($sql, array('y','Y', $dist_code, $subdiv_code,
//              $cir_code,$mouza_code,$lot_code, $users, 'y','Y', $dist_code, $subdiv_code,
//              $cir_code,$mouza_code,$lot_code, $users,'y','Y', $dist_code, $subdiv_code,
//              $cir_code,$mouza_code,$lot_code, $users,'y','Y', $dist_code, $subdiv_code, $cir_code,
//              $mouza_code,$lot_code, $users))->result_array();
//        }
    }

    function fetchDcRecord(){
        $fromDate=$this->input->post('from_date');
        $upDate=$this->input->post('upto_date'); 
        $dist_code=$this->input->post('dist_code');
        $users=$this->input->post('users');
        $this->db=$this->dbswitch($dist_code);
        $sql=$this->db->query("Select dist_code,subdiv_code,circle_code as cir_code,mouza_pargona_code,lot_no,
        vill_townprt_code,case_no as ord_no,dc_entry_date as co_ord_date,dc_code as co_code from
         allotment_cert_basic where dc_code=? and dc_entry_date between '$fromDate' and '$upDate'",array($users));
        return $sql->result_array(); 
    }
    function fetchHistory(){
        $fromDate=$this->input->post('from_date');
        $upDate=$this->input->post('upto_date'); 
        $dist_code=$this->input->post('dist_code'); 
        $subdiv_code=$this->input->post('subdiv_code'); 
        $cir_code=$this->input->post('cir_code'); 
        $users=$this->input->post('users');
        $this->db=$this->dbswitch($dist_code);

        if($this->input->post('user_type') == 'C')
        {
            $mouza_code= '00';
            $lot_code= '00';
        }
        else if($this->input->post('user_type') == 'L')
        {
            $mouza_code=$this->input->post('mouza_code');
            $lot_code=$this->input->post('lot_code');
        }
        $sql="Select * from login_history_table where client_ip not like '10.177.15.%' 
        and client_ip not like '10.177.0.%' and client_ip not like '10.177.48.%' and dist_code=? and subdiv_code=? 
        and cir_code=? and mouza_pargona_code=? and lot_no=?
        and user_code=? and date_of_creation between '$fromDate' and '$upDate' ";
        return $this->db->query($sql,array($dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_code,$users))->result_array();
    }
    function fetchDistName($dist_code){
        $this->db=$this->dbswitch($dist_code);
        $sql=$this->db->query("Select loc_name from location where dist_code=? 
        AND subdiv_code=? ",array($dist_code,'00'));
        return $sql->row_array(); 
    }
    function fetchSubName($dist_code,$s){
        $this->db=$this->dbswitch($dist_code);
        $sql=$this->db->query("Select loc_name from location where dist_code=? 
            and subdiv_code=? and cir_code='00' ",array($dist_code,$s));
        return $sql->row_array(); 
    }
    function fetchCirName($dist_code,$s,$c){
        $this->db=$this->dbswitch($dist_code);
        $sql=$this->db->query("Select loc_name from location where dist_code=? and subdiv_code=? 
        and cir_code=? and mouza_pargona_code='00' ",array($dist_code,$s,$c));
        return $sql->row_array(); 
    }

    ////////////////////field_mut_basic for Field mutation/partition/////////////
    function fmRecord()
    {
        $fromDate=$this->input->post('from_date');
        $upDate=$this->input->post('upto_date');
        $dist_code=$this->input->post('dist_code');
        $subdiv_code=$this->input->post('subdiv_code');
        $cir_code=$this->input->post('cir_code');
        $mouza_code=$this->input->post('mouza_code');
        $lot_code=$this->input->post('lot_code');
        $users=$this->input->post('users');
        $this->db=$this->dbswitch($dist_code);

        if($this->input->post('user_type')=='C')
        {
            return $this->db->query("select case_no, date_of_order, order_passed, mut_type from field_mut_basic where 
                dist_code=? and subdiv_code=? and cir_code=? and order_passed=? and 
                add_off_name=? and date_of_order between '$fromDate' and '$upDate'",
                array($dist_code,$subdiv_code,$cir_code,'Y',$users))->result();
        }
        elseif ($this->input->post('user_type')=='L')
        {
            return $this->db->query("select case_no, date_entry as date_of_order, order_passed from field_mut_basic 
            where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and 
            lot_no=? and user_code=? and order_passed=? 
            and date_entry between '$fromDate' and '$upDate'",
                array($dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_code,$users,'Y'))->result();
        }
    }

    ////////////////////petition_basic for Office mutation/partition/////////////
    function ofmRecord()
    {
        $fromDate=$this->input->post('from_date');
        $upDate=$this->input->post('upto_date');
        $dist_code=$this->input->post('dist_code');
        $subdiv_code=$this->input->post('subdiv_code');
        $cir_code=$this->input->post('cir_code');
        $mouza_code=$this->input->post('mouza_code');
        $lot_code=$this->input->post('lot_code');
        $users=$this->input->post('users');
        $this->db=$this->dbswitch($dist_code);

        if($this->input->post('user_type')=='C')
        {
            return $this->db->query("select case_no, date_of_order, order_passed from petition_basic where 
            mut_type <> '01' and dist_code=? and subdiv_code=? and cir_code=? and order_passed=? 
            and add_off_name=? and date_of_order between '$fromDate' and '$upDate'",
                array($dist_code,$subdiv_code,$cir_code,'Y',$users))->result();
        }
        elseif ($this->input->post('user_type')=='L')
        {
            $query= "SELECT case_no, lm_note_date as date_of_order, order_passed FROM petition_basic WHERE
            mut_type <> '01' and dist_code=? AND subdiv_code=? AND cir_code=? AND mouza_pargona_code=?
            AND lot_no=? and lm_note_yn=? and order_passed=? and lm_note_date between '$fromDate' and '$upDate'
            and petition_no IN (SELECT petition_no FROM petition_lm_note WHERE dist_code=? AND subdiv_code=? 
            AND cir_code=? AND mouza_pargona_code=? AND lot_no=? and lm_code=? GROUP BY petition_no)";
            return $this->db->query($query,array($dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_code,'Y',
                'Y',$dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_code,$users))->result();
        }
    }

    ////////////////////petition_basic for Conversion/////////////
    function convRecord()
    {
        $fromDate=$this->input->post('from_date');
        $upDate=$this->input->post('upto_date');
        $dist_code=$this->input->post('dist_code');
        $subdiv_code=$this->input->post('subdiv_code');
        $cir_code=$this->input->post('cir_code');
        $mouza_code=$this->input->post('mouza_code');
        $lot_code=$this->input->post('lot_code');
        $users=$this->input->post('users');
        $this->db=$this->dbswitch($dist_code);

        if($this->input->post('user_type')=='C')
        {
            return $this->db->query("select case_no, date_of_order, order_passed from petition_basic where 
            mut_type=? and dist_code=? and subdiv_code=? and cir_code=? and order_passed=? and co_user_code=? 
            and date_of_order between '$fromDate' and '$upDate'",array('01',$dist_code,$subdiv_code,$cir_code,'Y',$users))->result();
        }
        elseif ($this->input->post('user_type')=='L')
        {
            $query= "SELECT case_no, lm_note_date as date_of_order, order_passed FROM petition_basic WHERE
            mut_type=? and dist_code=? AND subdiv_code=? AND cir_code=? AND mouza_pargona_code=? AND lot_no=? 
            and lm_note_yn=? and order_passed=? and lm_note_date between '$fromDate' and '$upDate' 
            and petition_no IN (SELECT petition_no FROM petition_lm_note WHERE dist_code=? AND 
            subdiv_code=? AND cir_code=? AND mouza_pargona_code=? AND lot_no=? and lm_code=? GROUP BY petition_no)";
            return $this->db->query($query,array('01',$dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_code,
                'Y','Y',$dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_code,$users))->result();
        }
    }


//    function chithaBasicRecord()
//    {
//        $fromDate=$this->input->post('from_date');
//        $upDate=$this->input->post('upto_date');
//        $dist_code=$this->input->post('dist_code');
//        $subdiv_code=$this->input->post('subdiv_code');
//        $cir_code=$this->input->post('cir_code');
//        $mouza_code=$this->input->post('mouza_code');
//        $lot_code=$this->input->post('lot_code');
//        $users=$this->input->post('users');
//        $this->db=$this->dbswitch($dist_code);
//
//        if($this->input->post('user_type')=='C')
//        {
//            return $this->db->query("select case_no, date_of_order, order_passed from petition_basic where
//           mut_type=? and dist_code=? and subdiv_code=? and cir_code=? and order_passed=? and co_user_code=?
//          and date_of_order between '$fromDate' and '$upDate'",array('01',$dist_code,$subdiv_code,$cir_code,'Y',$users))->result();
//        }
//        elseif ($this->input->post('user_type')=='L')
//        {
//            $query= "SELECT case_no, lm_note_date as date_of_order, order_passed FROM petition_basic WHERE
//           mut_type=? and dist_code=? AND subdiv_code=? AND cir_code=? AND mouza_pargona_code=? AND lot_no=?
//          and lm_note_yn=? and order_passed=? and
//          lm_note_date between '$fromDate' and '$upDate' and petition_no IN (SELECT petition_no FROM petition_lm_note
//          WHERE dist_code=? AND subdiv_code=? AND cir_code=? AND mouza_pargona_code=? AND lot_no=? and lm_code=? GROUP BY petition_no)";
//            return $this->db->query($query,array('01',$dist_code,$subdiv_code,$cir_code,
//          $mouza_code,$lot_code,'Y','Y',$dist_code,$subdiv_code,$cir_code,$mouza_code,$lot_code,$users))->result();
//        }
//    }



    function gender($id) {
        $q = "select gen_name_ass as name from master_gender where short_name='$id'";
        $scname = $this->db->query($q)->row()->name;
        return $scname;
    }

    function relation($id) {
        $id = trim($id);
        $scname = null;
        if(!empty($id))
        {
            $id = strtolower($id);
            $q = "select guard_rel_desc_as as name from master_guard_rel where guard_rel='$id'";
            $scname = $this->db->query($q)->row()->name;
            return $scname;
        }
        else
        {
            return $scname;
        }


    }

    function coName($d,$s,$c,$user_code) {

        return $this->db->query("select username from users where dist_code=? 
                    and subdiv_code=? and cir_code=? and user_code=?", array($d,$s,$c,$user_code))->row()->username;
    }

    function lmName($d,$s,$c,$m,$l,$v,$user_code) {
        return $this->db->query("select lm_name from
                    lm_code where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?
                    and lot_no=? and lm_code=?", array($d,$s,$c,$m,$l,$user_code))->row()->lm_name;
    }

    function skName($d,$s,$c,$user_code) {
        return  $this->db->query("select username from users where dist_code=?
                    and subdiv_code=? and cir_code=? and user_code=?", array($d,$s,$c,$user_code))->row()->username;;
    }

    function getName($user_code,$d,$s,$c,$m,$l)
    {
        $string = str_split($user_code);
        $count = 0;
        foreach ($string as $user)
        {
            if(ctype_alpha($user))
            {
                $count++;
            }
        }
        $user_code_new = substr($user_code, 0,$count);

        if($user_code_new == 'CO')
        {
            $name = $this->db->query("select username,user_desig_code from users where dist_code=? 
                    and subdiv_code=? and cir_code=? and user_code=?", array($d,$s,$c,$user_code));

            return $name->row()->username.' ('.$name->row()->user_desig_code.')';
        }
        else if($user_code_new == 'LM' || $user_code_new == 'M')
        {
            $name = $this->db->query("select lm_name from
                    lm_code where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?
                    and lot_no=? and lm_code=?", array($d,$s,$c,$m,$l,$user_code));

            return $name->row()->lm_name.' (LM)';
        }
        else if($user_code_new == 'AS')
        {
            $name = $this->db->query("select username,user_desig_code from users where dist_code=?
                    and subdiv_code=? and cir_code=? and user_code=?", array($d,$s,$c,$user_code));;

            return $name->row()->username.' ('.$name->row()->user_desig_code.')';
        }
        else if($user_code_new == 'SK')
        {
            $name = $this->db->query("select username,user_desig_code from users where dist_code=?
                    and subdiv_code=? and cir_code=? and user_code=?", array($d,$s,$c,$user_code));;
            return $name->row()->username.' ('.$name->row()->user_desig_code.')';
        }
        else if($user_code_new == 'DC')
        {
            $name = $this->db->query("select username,user_desig_code from users where dist_code=?
                    and subdiv_code=? and cir_code=? and user_code=?", array($d,'00','00',$user_code));;
            return $name->row()->username.' ('.$name->row()->user_desig_code.')';
        }
        else if($user_code_new == 'ADC')
        {
            $name = $this->db->query("select username,user_desig_code from users where dist_code=?
                    and subdiv_code=? and cir_code=? and user_code=?", array($d,'00','00',$user_code));;
            return $name->row()->username.' ('.$name->row()->user_desig_code.')';
        }
    }

    function getPattaType($type)
    {
        return $this->db->query("select patta_type from patta_code where type_code=?",array($type))->row()->patta_type;
    }

}
