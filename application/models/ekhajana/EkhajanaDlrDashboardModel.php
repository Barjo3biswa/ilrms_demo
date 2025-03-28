<?php
class EkhajanaDlrDashboardModel extends CI_Model {

    //db switch
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

    public function dbswitch2($dist_code)
    {
        if ($dist_code == "02") {
            $this->db2 = $this->load->database('dhubri', TRUE);
        } else if ($dist_code == "05") {
            $this->db2 = $this->load->database('barpeta', TRUE);
        } else if ($dist_code == "10") {
            $this->db2 = $this->load->database('chirang', TRUE);
        } else if ($dist_code == "13") {
            $this->db2 = $this->load->database('bongaigaon', TRUE);
        } else if ($dist_code == "17") {
            $this->db2 = $this->load->database('dibrugarh', TRUE);
        } else if ($dist_code == "15") {
            $this->db2 = $this->load->database('jorhat', TRUE);
        } else if ($dist_code == "14") {
            $this->db2 = $this->load->database('golaghat', TRUE);
        } else if ($dist_code == "07") {
            $this->db2 = $this->load->database('kamrup', TRUE);
        } else if ($dist_code == "03") {
            $this->db2 = $this->load->database('goalpara', TRUE);
        } else if ($dist_code == "18") {
            $this->db2 = $this->load->database('tinsukia', TRUE);
        } else if ($dist_code == "12") {
            $this->db2 = $this->load->database('lakhimpur', TRUE);
        } else if ($dist_code == "24") {
            $this->db2 = $this->load->database('kamrupm', TRUE);
        } else if ($dist_code == "06") {
            $this->db2 = $this->load->database('nalbari', TRUE);
        } else if ($dist_code == "11") {
            $this->db2 = $this->load->database('sonitpur', TRUE);
        } else if ($dist_code == "16") {
            $this->db2 = $this->load->database('sibsagar', TRUE);
        } else if ($dist_code == "32") {
            $this->db2 = $this->load->database('morigaon', TRUE);
        } else if ($dist_code == "33") {
            $this->db2 = $this->load->database('nagaon', TRUE);
        } else if ($dist_code == "34") {
            $this->db2 = $this->load->database('majuli', TRUE);
        } else if ($dist_code == "21") {
            $this->db2 = $this->load->database('karimganj', TRUE);
        } else if ($dist_code == "35") {
            $this->db2 = $this->load->database('biswanath', TRUE);
        } else if ($dist_code == "36") {
            $this->db2 = $this->load->database('hojai', TRUE);
        } else if ($dist_code == "37") {
            $this->db2 = $this->load->database('charaideo', TRUE);
        } else if ($dist_code == "25") {
            $this->db2 = $this->load->database('dhemaji', TRUE);
        } else if ($dist_code == "39") {
            $this->db2 = $this->load->database('bajali', TRUE);
        } else if ($dist_code == "38") {
            $this->db2 = $this->load->database('ssalmara', TRUE);
        } else if ($dist_code == "08") {
            $this->db2 = $this->load->database('darrang', TRUE);
        } else if ($dist_code == "auth") {
            $this->db2 = $this->load->database('auth', TRUE);
        }
        return $this->db2;
    }

    //query for all received applications
    function allApplications()
    {
        $CI = &get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and el.status!='RE_P' "; 
        return $fm = $this->db->query($sql)->row()->c;
    }

    //query for pending cases
    function allPendingApplications()
	{
		$sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and el.status not in ('R','F','RE_P')";
  
		return $fm = $this->db->query($sql)->row()->c;
	}

    //query for disposed cases
    function allDisposedApplications()
	{
		$sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and el.status in ('F')";
		return $fm = $this->db->query($sql)->row()->c;
	}

    //query for rejected cases
    function allRejecteddApplications()
	{
		$sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and el.status='R'";
		return $fm = $this->db->query($sql)->row()->c;
	}

    //query for all data
    function allApplicationDistwiseForIndex($service)
	{

		$distList = "select district_code,district_name from district_details where district_code!='00' and online='0'";
		$list = $this->db->query($distList)->result();
		foreach ($list as $key => $val) {
			$appR=$appD=$appP=0;

	        //query for application received
			$sql ="Select count(ekhajana_land_details.id) as appr from ekhajana_land_details join ekhajana_applications on ekhajana_applications.application_no = ekhajana_land_details.application_no where  ekhajana_land_details.dist_code='$val->district_code' and  ekhajana_applications.initial_payment_status in ('N', 'C') and ekhajana_applications.is_draft in('N') and ekhajana_land_details.status!='RE_P' and ekhajana_applications.service_code='$service' ";
			$appR = $this->db->query($sql);
			if($appR->num_rows()>0){
				$appR=$appR->row();
			}

			//query for application delivered and rejected
			$sql = "Select count(ekhajana_land_details.id) as appd from ekhajana_applications join ekhajana_land_details on ekhajana_applications.application_no = ekhajana_land_details.application_no where  ekhajana_land_details.dist_code='$val->district_code' and  ekhajana_applications.initial_payment_status in ('N', 'C') and ekhajana_land_details.status in('F','R') and ekhajana_applications.service_code='$service' ";
			$appD = $this->db->query($sql);
			if($appD->num_rows()>0){
				$appD=$appD->row();
			}

			//query for application pending
			$sql = "Select count(ekhajana_land_details.id) as appp from ekhajana_applications join ekhajana_land_details on ekhajana_applications.application_no = ekhajana_land_details.application_no where  ekhajana_land_details.dist_code='$val->district_code' and 
			ekhajana_applications.initial_payment_status in ('N', 'C') and ekhajana_applications.service_code='$service'  and ekhajana_applications.is_draft='N' and ekhajana_land_details.status not in('R','F','RE_P')";
			$appP = $this->db->query($sql);
			if($appP->num_rows()>0){
				$appP=$appP->row();
			}
			$application[] = array(
				'dist_code' => $val->district_code,
				'dist_name' => $val->district_name,
				'all' => $appR->appr,
				'Disposed' => $appD->appd,
				'Pending' => $appP->appp,
			);
			
		}
		return $application;
	}

    function getMouzaWiseDemandSatisfiedInfoFromDistCode($dist_code){
        $this->db2 = $this->dbswitch2($dist_code);
        $result = $this->db2->query("select * from ekhajana_demand_satisfy_year order by year_no desc")->result();
        $demand_satisfied_info = array();
        $count = 1;
        foreach($result as $row){              
            $bs_year = (int)substr($row->upto_demand_satisfied_year,0,4)-593;
            array_push($demand_satisfied_info, [
                "dist_name" => $this->utilclass->getDistrictName($row->dist_code),
                "circle_name" => $this->utilclass->getCircleName($row->dist_code, $row->subdiv_code,$row->cir_code),
                "mouza_name" => $this->utilclass->getMouzaName($row->dist_code, $row->subdiv_code,$row->cir_code, $row->mouza_pargona_code),
                "mouzadar_name" => $this->getMouzdarName($row->dist_code, $row->subdiv_code,$row->cir_code, $row->mouza_pargona_code),
                "upto_demand_satisfied_year" => $row->upto_demand_satisfied_year, 
                "upto_demand_satisfied_year_bs" => (string)$bs_year, 
                //"created_at" => $row->created_at,
                "year_no" => $row->year_no
            ]);
            
        }
        return $demand_satisfied_info;        
    }

    public function districtWiseDpFlaggingData()
    {

        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $dist_list = "select dist_code,loc_name from location where dist_code!='00' and subdiv_code='00' and cir_code='00' and dist_code not in('22','23','27','01','10')";
        $districts = $this->db->query($dist_list)->result();
        $result = array();
        foreach ($districts as $key => $val) {

            $dbbb = $this->dbswitch2($val->dist_code);
            //$dbbb = $this->dbswitch2($val->dist_code);
            
            // $sql ="select 
            // (select patta_type from patta_code where type_code=t.patta_type_code) as patta_type
            // ,t.flagged,t1.un_flagged from
            // (
            // select sum(c) as flagged,patta_type_code from
            // (select count(*) as c,patta_type_code 
            // from chitha_basic where patta_type_code in ('0208','0205','0223') and dp_flag_yn is not null
            // group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,patta_no,patta_type_code
            // )t group by patta_type_code
            // ) t
            // join
            // (
            // select sum(c) as un_flagged,patta_type_code from
            // (select count(*) as c,patta_type_code 
            // from chitha_basic where patta_type_code in  ('0208','0205','0223')
            // and dp_flag_yn is null
            // group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,patta_no,patta_type_code
            // )t group by patta_type_code
            // ) t1 on t.patta_type_code=t1.patta_type_code";

            
            $sql2 ="SELECT
                COUNT(CASE WHEN dp_flag_yn IS NULL THEN patta_type_code END) AS unflagged,
                COUNT(CASE WHEN dp_flag_yn IS NOT NULL THEN patta_type_code END) AS flagged,
                patta_type_code
            FROM
                chitha_basic
            WHERE
                patta_type_code IN ('0208', '0205', '0223')
            GROUP BY
                patta_type_code;";


            $query_res = $dbbb->query($sql2)->result();
          
            $result[] = array(
                "dist_code" => $val->dist_code,
                "dist_name" => $val->loc_name,
                "query_res" => $query_res,
            );
			
        }
        return $result;
    }

    public function circleWiseDpFlaggingData($dist_code)
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $cir_list = "select dist_code,subdiv_code,cir_code,loc_name from location where dist_code=? and subdiv_code!=? and cir_code!=? and mouza_pargona_code=? and dist_code not in('22','23','27','01','10')";
        $circles = $this->db->query($cir_list,array($dist_code,'00','00','00'))->result();
        $result = array();
        foreach ($circles as $key => $val) {

            $dbbb = $this->dbswitch2($val->dist_code);
            $sql2 ="SELECT
                COUNT(CASE WHEN dp_flag_yn IS NULL THEN patta_type_code END) AS unflagged,
                COUNT(CASE WHEN dp_flag_yn IS NOT NULL THEN patta_type_code END) AS flagged,
                patta_type_code
            FROM
                chitha_basic
            WHERE
                patta_type_code IN ('0208', '0205', '0223') AND subdiv_code =? AND cir_code=?
            GROUP BY
                patta_type_code;";


            $query_res = $dbbb->query($sql2,array($val->subdiv_code,$val->cir_code))->result();
           
            $result[] = array(
                "dist_code" => $dist_code,
                "subdiv_code" => $val->subdiv_code,
                "cir_code" => $val->cir_code,
                "cir_name" => $val->loc_name,
                "query_res" => $query_res,
            );
            
            
        }
        return $result;
    }

    public function mouzaWiseDpFlaggingData($dist_code,$subdiv_code,$cir_code)
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $mouza_list = "select dist_code,subdiv_code,cir_code,mouza_pargona_code,loc_name from location where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code!=? and lot_no=? and dist_code not in('22','23','27','01','10')";
        $mouzas = $this->db->query($mouza_list,array($dist_code,$subdiv_code,$cir_code,'00','00'))->result();
        $result = array();
        foreach ($mouzas as $key => $val) {

            $dbbb = $this->dbswitch2($val->dist_code);
            $sql2 ="SELECT
                COUNT(CASE WHEN dp_flag_yn IS NULL THEN patta_type_code END) AS unflagged,
                COUNT(CASE WHEN dp_flag_yn IS NOT NULL THEN patta_type_code END) AS flagged,
                patta_type_code
            FROM
                chitha_basic
            WHERE
                patta_type_code IN ('0208', '0205', '0223') AND subdiv_code =? AND cir_code=? AND mouza_pargona_code=?
            GROUP BY
                patta_type_code;";


            $query_res = $dbbb->query($sql2,array($subdiv_code,$cir_code,$val->mouza_pargona_code))->result();
           
            $result[] = array(
                "dist_code"     => $dist_code,
                "subdiv_code"   => $subdiv_code,
                "cir_code"      => $cir_code,
                "mouza_pargona_code" => $val->mouza_pargona_code,
                "mouza_name"         => $val->loc_name,
                "query_res"          => $query_res,
            );
            
        }
        return $result;
    }

    public function lotWiseDpFlaggingData($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $lot_list = "select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,loc_name from location where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no!=? and vill_townprt_code=? and dist_code not in('22','23','27','01','10')";
        $lots = $this->db->query($lot_list,array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,'00','00000'))->result();
        
        $result = array();
        foreach ($lots as $key => $val) {

            $dbbb = $this->dbswitch2($val->dist_code);
            $sql2 ="SELECT
                COUNT(CASE WHEN dp_flag_yn IS NULL THEN patta_type_code END) AS unflagged,
                COUNT(CASE WHEN dp_flag_yn IS NOT NULL THEN patta_type_code END) AS flagged,
                patta_type_code
            FROM
                chitha_basic
            WHERE
                patta_type_code IN ('0208', '0205', '0223') AND subdiv_code =? AND cir_code=? AND mouza_pargona_code=? AND lot_no=?
            GROUP BY
                patta_type_code;";


            $query_res = $dbbb->query($sql2,array($subdiv_code,$cir_code,$mouza_pargona_code,$val->lot_no))->result();
           
            $result[] = array(
                "dist_code"         => $dist_code,
                "subdiv_code"       => $subdiv_code,
                "cir_code"          => $cir_code,
                "mouza_pargona_code"=> $mouza_pargona_code,
                "lot_no"            => $val->lot_no,
                "lot_name"          => $val->loc_name,
                "query_res"         => $query_res,
            );
            
        }
        return $result;
    }

    public function villWiseDpFlaggingData($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no)
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $vill_list = "select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,loc_name from location where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code!=? and dist_code not in('22','23','27','01','10')";
        $villages = $this->db->query($vill_list,array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,'00000'))->result();
        
        $result = array();
        foreach ($villages as $key => $val) {

            $dbbb = $this->dbswitch2($val->dist_code);
            $sql2 ="SELECT
                COUNT(CASE WHEN dp_flag_yn IS NULL THEN patta_type_code END) AS unflagged,
                COUNT(CASE WHEN dp_flag_yn IS NOT NULL THEN patta_type_code END) AS flagged,
                patta_type_code
            FROM
                chitha_basic
            WHERE
                patta_type_code IN ('0208', '0205', '0223') AND subdiv_code =? AND cir_code=? AND mouza_pargona_code=? AND lot_no=? AND vill_townprt_code=?
            GROUP BY
                patta_type_code;";


            $query_res = $dbbb->query($sql2,array($subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$val->vill_townprt_code))->result();
           
            $result[] = array(
                "dist_code"         => $dist_code,
                "subdiv_code"       => $subdiv_code,
                "cir_code"          => $cir_code,
                "mouza_pargona_code"=> $mouza_pargona_code,
                "lot_no"            => $lot_no,
                "vill_townprt_code" => $val->vill_townprt_code,
                "village_name"      => $val->loc_name,
                "query_res"         => $query_res,
            );
            
        }
        return $result; 
    }


    function getPattaType($dist_code,$patta_type_code)
	{
		$dbbb = $this->dbswitch2($dist_code);
		$pattatype = $dbbb->query("select patta_type,pattatype_eng from patta_code where 
				type_code ='$patta_type_code'");

		return $pattatype->row()->patta_type;
	}

    public function allApplicationDistwise()
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $dist_list = "select dist_code,loc_name from location where dist_code!='00' and subdiv_code ='00' and cir_code='00' and dist_code not in('22','23','27','01','10','02','13','03','21','38')";
        $districts = $this->db->query($dist_list)->result();
        $result = array();
        foreach ($districts as $key => $val) {

            $dbbb = $this->dbswitch2($val->dist_code);
            // $sql2 ="select * from ekhajana_arrear_pre_updation where dist_code= '07'";
            // $query_res = $dbbb->query($sql2)->result();
            $sql3 ="select count(patta_no) as patta_count from ekhajana_arrear_pre_updation where dist_code='$val->dist_code'";
            $patta_count = $dbbb->query($sql3)->row()->patta_count;
            $sql4 ="select count(patta_no) as total_patta_count from chitha_basic where dp_flag_yn !='Y' and dist_code='$val->dist_code'";
            $total_patta_count = $dbbb->query($sql4)->row()->total_patta_count;
            $result[] = array(
                "dist_code"         => $val->dist_code,
                "dist_name"         => $val->loc_name,
                "patta_count"       => $patta_count,
                "total_patta_count" => $total_patta_count,
                "remaining_patta_count" => $total_patta_count - $patta_count,
            );
			
        }

        //**************************************************************************/
        //sorting 
        $patta_count_arr = array();
        foreach($result as $row){
            array_push($patta_count_arr,$row['patta_count']);
        }
        rsort($patta_count_arr);
        $unique_arr = array_unique($patta_count_arr);
        rsort($unique_arr);        
        $rank_arr = array();
        $count=1;
        foreach($unique_arr as $unique_count){
            $rank_arr[$unique_count] = $count;
            $count = $count+1;
        }
        $sorted_arr = array();
        foreach($unique_arr as $patta_count){
            //return $patta_count;
            foreach($result as $row){
                if($row['patta_count'] == $patta_count){
                    $row['rank'] = $rank_arr[$patta_count];
                    array_push($sorted_arr, $row);
                }
            }
            
        }
        //**************************************************************************/
        return $sorted_arr;
    }


    public function CircleWiseArrearReport($dist_code)
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $cir_list = "select dist_code,subdiv_code,cir_code,loc_name from location where dist_code=? and subdiv_code!=? and cir_code!=? and mouza_pargona_code=? and dist_code not in('22','23','27','01','10','02','13','03','21','38')";
        $circles = $this->db->query($cir_list,array($dist_code,'00','00','00'))->result();
        $result = array();
        foreach ($circles as $key => $val) {

            $dbbb = $this->dbswitch2($val->dist_code);
            // $sql2 ="select * from ekhajana_arrear_pre_updation where dist_code= '07' and cir_code ='$val->cir_code'";
            // $query_res = $dbbb->query($sql2)->result();
            $sql3 ="select count(patta_no) as patta_count from ekhajana_arrear_pre_updation where dist_code='$val->dist_code' and cir_code ='$val->cir_code'";
            $patta_count = $dbbb->query($sql3)->row()->patta_count;
            $sql4 ="select count(patta_no) as total_patta_count from chitha_basic where dp_flag_yn !='Y' and dist_code='$val->dist_code' and cir_code ='$val->cir_code'";
            $total_patta_count = $dbbb->query($sql4)->row()->total_patta_count;
            $result[] = array(
                "dist_code"         => $val->dist_code,
                "subdiv_code"       => $val->subdiv_code,
                "cir_code"          => $val->cir_code,
                "cir_name"          => $val->loc_name,
                "patta_count"       => $patta_count,
                "total_patta_count" => $total_patta_count,
                "remaining_patta_count" => $total_patta_count - $patta_count,
            );
        }
        return $result;
    }

    public function MouzaWiseArrearReport($dist_code,$subdiv_code,$cir_code)
    {
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $mouza_list = "select dist_code,subdiv_code,cir_code,mouza_pargona_code,loc_name from location where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code!=? and lot_no=? and dist_code not in('22','23','27','01','10','02','13','03','21','38')";
        $mouzas = $this->db->query($mouza_list,array($dist_code,$subdiv_code,$cir_code,'00','00'))->result();
        $result = array();
        foreach ($mouzas as $key => $val) {
            $dbbb = $this->dbswitch2($val->dist_code);
            // $sql2 ="select * from ekhajana_arrear_pre_updation where dist_code= '07' and cir_code ='$val->cir_code' and mouza_pargona_code ='$val->mouza_pargona_code'";
            // $query_res = $dbbb->query($sql2)->result();
            $sql3 ="select count(patta_no) as patta_count from ekhajana_arrear_pre_updation where dist_code='$val->dist_code' and cir_code ='$val->cir_code' and mouza_pargona_code ='$val->mouza_pargona_code'";
            $patta_count = $dbbb->query($sql3)->row()->patta_count;
            $sql4 ="select count(patta_no) as total_patta_count from chitha_basic where dp_flag_yn !='Y' and dist_code='$val->dist_code' and cir_code ='$val->cir_code' and mouza_pargona_code ='$val->mouza_pargona_code'";
            $total_patta_count = $dbbb->query($sql4)->row()->total_patta_count;
            $result[] = array(
                "dist_code"         => $val->dist_code,
                "subdiv_code"       => $val->subdiv_code,
                "cir_code"          => $val->cir_code,
                "mouza_pargona_code" => $val->mouza_pargona_code,
                "mouza_name"        => $val->loc_name,
                "patta_count"       => $patta_count,
                "total_patta_count" => $total_patta_count,
                "remaining_patta_count" => $total_patta_count - $patta_count,
            );
        }
        return $result;
    }

    public function getMouzdarName($dist_code, $subdiv_code,$cir_code, $mouza_pargona_code){
        $this->db3 = $this->load->database('db2', TRUE);
        $query = $this->db3->query("select du.name from user_dist_byforcation udb join depart_users du 
                                   on du.id::int=udb.unique_user_id::int where udb.dist_code=? and 
                                   udb.subdiv_code=? and udb.cir_code=? and udb.mouza_pargona_code=?",
                                array($dist_code, $subdiv_code,$cir_code, $mouza_pargona_code));
        $count =  $query->num_rows();
        if($count == 0){
            return "--";
        }else{
            return $query->row()->name;
        }
    }

    public function getTotalAmountReceivedFromMouzadariArea(){
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $total_amt = $this->db->query("select sum(total_khajana) from ekhajana_commission_details 
                                where application_under='MOUZADAR' and status='F'")->row()->sum;
        if($total_amt == NULL){
            $total_amt = 0;
        }
        return round($total_amt,2);                             
    }

    public function getTotalAmountReceivedDBYFromMouzadariArea(){

        $time = date("Y-m-d",strtotime('-2 day'));
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $total_amt = $this->db->query("select sum(total_khajana) from ekhajana_commission_details 
                            where application_under='MOUZADAR' and status='F' and date(created_at)<='$time'")->row()->sum;
        if($total_amt == NULL){
            $total_amt = 0;
        }
        return round($total_amt,2);  
    }

    public function getTotalAmountReceivedYFromMouzadariArea(){
        $time = date("Y-m-d",strtotime('-1 day'));
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $total_amt = $this->db->query("select sum(total_khajana) from ekhajana_commission_details 
                            where application_under='MOUZADAR' and status='F' and date(created_at)='$time'")->row()->sum;
        if($total_amt == NULL){
            $total_amt = 0;
        }
        return round($total_amt,2); 
    }

    public function getTotalAmountReceivedFromTehsildariArea(){
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $total_amt = $this->db->query("select sum(ep.paid_amount) from ekhajana_payment ep join 
        ekhajana_land_details eld on ep.ld_application_no = eld.ld_application_no where eld.application_under 
        not in ('MOUZADAR','DIRECT-PAYING') and eld.status='F' and ep.status='F'")->row()->sum;
        if($total_amt == NULL){
            $total_amt = 0;
        }
        return round($total_amt,2);                            
    }

    public function getTotalAmountReceivedDBYFromTehsildariArea(){
        $time = date("Y-m-d",strtotime('-2 day'));
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $total_amt = $this->db->query("select sum(ep.paid_amount) from ekhajana_payment ep join 
        ekhajana_land_details eld on ep.ld_application_no = eld.ld_application_no where eld.application_under 
        not in ('MOUZADAR','DIRECT-PAYING') and eld.status='F' and ep.status='F' and date(ep.created_at)<='$time'")->row()->sum;
        if($total_amt == NULL){
            $total_amt = 0;
        }
        return round($total_amt,2); 
    }

    public function getTotalAmountReceivedYFromTehsildariArea(){
        $time = date("Y-m-d",strtotime('-1 day'));
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $total_amt = $this->db->query("select sum(ep.paid_amount) from ekhajana_payment ep join 
        ekhajana_land_details eld on ep.ld_application_no = eld.ld_application_no where eld.application_under 
        not in ('MOUZADAR','DIRECT-PAYING') and eld.status='F' and ep.status='F' and date(ep.created_at)='$time'")->row()->sum;
        if($total_amt == NULL){
            $total_amt = 0;
        }
        return round($total_amt,2); 
    }

    public function getBestPerformingMouzaTN(){
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        
        $mouza_location = $this->db->query("select dist_code,subdiv_code,cir_code,mouza_pargona_code,sum(total_khajana) from 
        ekhajana_commission_details where application_under='MOUZADAR' and status='F' group by dist_code,subdiv_code,
        cir_code,mouza_pargona_code order by sum(total_khajana) desc limit 3")->result();
        
        $best_performing_mouza_list = array();

        foreach($mouza_location as $mouza){
            $mouza_name = $this->db->query("select loc_name from location where dist_code=? and subdiv_code=? 
            and cir_code=? and mouza_pargona_code=? and lot_no=?", array($mouza->dist_code,
            $mouza->subdiv_code,$mouza->cir_code,$mouza->mouza_pargona_code,'00' ))->row();       
            $dist_name = $this->db->query("select loc_name from location where dist_code=? and subdiv_code=?", 
            array($mouza->dist_code,'00' ))->row();                 
            array_push($best_performing_mouza_list, [
                "mouza_name" => trim($mouza_name->loc_name),
                "district_name" => trim($dist_name->loc_name),
            ]);
        }
        return $best_performing_mouza_list; 
    }

    public function getBestPerformingCircleTN(){
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);

        $best_performing_circle_list = array();

        $circle_locations = $this->db->query("select eld.dist_code,eld.subdiv_code,eld.cir_code, sum(ep.paid_amount) 
        from ekhajana_payment ep join ekhajana_land_details eld on ep.ld_application_no = eld.ld_application_no
        where eld.application_under not in ('MOUZADAR','DIRECT-PAYING') and eld.status='F' and ep.status='F' 
        group by eld.dist_code,eld.subdiv_code,eld.cir_code order by sum(ep.paid_amount) desc limit 3")->result();

        foreach($circle_locations as $circle_location){
            $circle_name = $this->db->query("select loc_name from location where dist_code=? and subdiv_code=? 
            and cir_code=? and mouza_pargona_code=?", array($circle_location->dist_code,
            $circle_location->subdiv_code,$circle_location->cir_code, '00' ))->row();
            $dist_name = $this->db->query("select loc_name from location where dist_code=? and subdiv_code=?", 
            array($circle_location->dist_code,'00' ))->row();
            array_push($best_performing_circle_list, [
                "circle_name" => trim($circle_name->loc_name),
                "district_name" => trim($dist_name->loc_name),
            ]);

        }

        return $best_performing_circle_list;
    }

    public function getLeastPerformingMouza(){
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $mouza_list = $this->db->query("select dist_code,subdiv_code,cir_code,mouza_pargona_code,loc_name,uuid
        from location where dist_code!=? and subdiv_code!=? and cir_code!=? and mouza_pargona_code!=?
        and lot_no=?", array('00','00','00','00','00'))->result();     
        //return $mouza_list;   
        $mouza_list_with_payments = array();
        foreach($mouza_list as $mouza_detail){
            $application_under = $this->checkMouzadarOrTehsildar($mouza_detail->dist_code,$mouza_detail->uuid);
            if($mouza_detail->dist_code == "10"){
                continue;
            }
            if($application_under != 'MOUZADAR'){
                continue;
            };
            if(trim($mouza_detail->loc_name) == '.'){
                continue;
            }
            $mouza_payment = $this->db->query("select sum(total_khajana) from 
            ekhajana_commission_details where application_under='MOUZADAR' and status='F' and dist_code=?
            and subdiv_code=? and cir_code=? and mouza_pargona_code=?", array($mouza_detail->dist_code,
            $mouza_detail->subdiv_code,$mouza_detail->cir_code, $mouza_detail->mouza_pargona_code))->row()->sum;
            if($mouza_payment == NULL){
                $mouza_payment = 0;
            }
            
            $dist_name = $this->db->query("select loc_name from location where dist_code=? and subdiv_code=?", 
            array($mouza_detail->dist_code,'00' ))->row();
            
            array_push($mouza_list_with_payments,[
                "mouza_name" => trim($mouza_detail->loc_name), 
                "district_name" => trim($dist_name->loc_name),
                "payment" => $mouza_payment,                
            ]);            

        }
        $payments = array();
        #iterating over the arr
        foreach ($mouza_list_with_payments as $key => $val)
        {
            $payments[$key] = $val['payment'];            
        }
        #apply multisort method        
        array_multisort($payments, SORT_ASC, $mouza_list_with_payments);
        //returning top 3 least performing array 
        $count = 1;
        $least_3_mouza = array();
        foreach($mouza_list_with_payments as $mouza){
            array_push($least_3_mouza, $mouza);
            if(count($least_3_mouza) == 3){
                break;
            }
            $count = $count + 1;
        };
        return $least_3_mouza;
    }

    public function getLeastPerformingCircle(){
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $circle_list = $this->db->query("select dist_code,subdiv_code,cir_code,mouza_pargona_code,loc_name,uuid
        from location where dist_code!=? and subdiv_code!=? and cir_code!=? and mouza_pargona_code=?", 
        array('00','00','00','00'))->result();      
        $circle_list_with_payments = array();
        foreach($circle_list as $circle_detail){
            $application_under = $this->checkMouzadarOrTehsildar($circle_detail->dist_code,$circle_detail->uuid);
            if($application_under != 'TEHSILDAR'){
                continue;
            };
            if(trim($circle_detail->loc_name) == '.'){
                continue;
            }
            $circle_payment = $this->db->query("select sum(ep.paid_amount) 
                from ekhajana_payment ep join ekhajana_land_details eld on 
                ep.ld_application_no = eld.ld_application_no
                where eld.application_under not in ('MOUZADAR','DIRECT-PAYING') 
                and eld.status='F' and ep.status='F'
                and eld.dist_code=? and eld.subdiv_code=? and eld.cir_code=?", 
                array($circle_detail->dist_code,
                $circle_detail->subdiv_code,$circle_detail->cir_code))->row()->sum;
            if($circle_payment == NULL){
                $circle_payment = 0;
            }
            $dist_name = $this->db->query("select loc_name from location where dist_code=? and subdiv_code=?", 
            array($circle_detail->dist_code,'00' ))->row();
            array_push($circle_list_with_payments,[
                "circle_name" => trim($circle_detail->loc_name), 
                "district_name" => trim($dist_name->loc_name), 
                "payment" => $circle_payment
            ]);            

        }
        $payments = array();
        #iterating over the arr
        foreach ($circle_list_with_payments as $key => $val)
        {
            $payments[$key] = $val['payment'];            
        }
        #apply multisort method        
        array_multisort($payments, SORT_ASC, $circle_list_with_payments);
        //returning top 3 least performing array 
        $count = 1;
        $least_3_circle = array();
        foreach($circle_list_with_payments as $circle){
            array_push($least_3_circle, $circle);
            if(count($least_3_circle) == 3){
                break;
            }
            $count = $count + 1;
        };
        return $least_3_circle;
    }

    public function checkMouzadarOrTehsildar($dist_code,$village_uuid){
        //checking tehsildar or mouzadar
        if (in_array($dist_code, json_decode(EKHAJANA_TEHSILDARI_SYSTEM_DIST_CODES)))
        {
            //checking mixed dist code or not
            if(in_array($dist_code, json_decode(EKHAJANA_TEHSILDARI_MIXED_DIST_CODES))){
                //checking village is mixed or not
                if(in_array($village_uuid, json_decode(EKHAJANA_TEHSILDARI_MIXED_VILLAGE_CODES))){
                    return 'MOUZADAR';
                }else{
                    return 'TEHSILDAR';
                }
            }else{
                return 'TEHSILDAR';
            }
        }
        else
        {
            return 'MOUZADAR';
        }
    }
   
    public function getMouzGraphData(){
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $date_wise_amt = $this->db->query("select * from (select date(created_at),sum(total_khajana) from ekhajana_commission_details
        where application_under='MOUZADAR' and status='F' group by date(created_at) order by date(created_at) desc limit 7)  t order by t.date asc")->result_array();
        return $date_wise_amt;
    }


    public function getCircleGraphData(){
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $date_wise_amt = $this->db->query("select * from (
        select date(ep.created_at), sum(ep.paid_amount) 
        from ekhajana_payment ep join ekhajana_land_details eld on ep.ld_application_no = eld.ld_application_no
        where eld.application_under not in ('MOUZADAR','DIRECT-PAYING') and eld.status='F' and ep.status='F' 
        group by date(ep.created_at) order by date(ep.created_at) desc limit 7)  t order by t.date asc")->result_array();
        return $date_wise_amt; 
    }


    public function getDistrcitWiseTotalAmountReceived(){
        
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $dist_list = "select dist_code,loc_name from location where dist_code!='00' and subdiv_code='00' and cir_code='00' and dist_code not in('22','23','27','01','10','03', '21', '13', '38')";
        $districts = $this->db->query($dist_list)->result();
        $distrct_with_payments_arr = array();      
        $district_code_arr = array();  
        foreach($districts as $dist){            
            $total_amt = $this->db->query("select sum(total_khajana) from ekhajana_commission_details 
                                where application_under='MOUZADAR' and status='F' and dist_code=?", 
                                array($dist->dist_code))->row()->sum;
            if($total_amt == NULL){
                $total_amt = 0;
            }
            $distrct_with_payments_arr[$dist->loc_name] = $total_amt;
            $district_code_arr[$dist->loc_name] = $dist->dist_code;
        }        
        $unique_payments = array_unique($distrct_with_payments_arr);
        arsort($unique_payments);
        $count= 1;
        $rank_arr = array();
        foreach($unique_payments as $unique_payment){
            $rank_arr[$unique_payment] = $count;
            $count= $count+1;
        }
        arsort($distrct_with_payments_arr);
        //return $distrct_with_payments_arr;
        $distrct_with_payments_arr_sorted = array(); 
        //return $distrct_with_payments_arr;
        foreach($distrct_with_payments_arr as $key=>$value){
            //return $key.$value;            
            array_push($distrct_with_payments_arr_sorted,[
                "district" => $key,
                "amount_received" => $value,
                "rank" => $rank = $rank_arr[$value],
                "dist_code" => $district_code_arr[$key]
            ]);
        }
        return $distrct_with_payments_arr_sorted;
    }

    public function getMouzaWiseTotalAmountReceivedFromDistrict($dist_code){
        //return "from the model dist code is ". $dist_code;
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $dist_name = $this->db->query("select loc_name from location where dist_code='$dist_code' 
        and subdiv_code='00'")->row()->loc_name;
        $mouza_list_query = "select dist_code,subdiv_code,cir_code,mouza_pargona_code,loc_name from 
        location where dist_code=? and subdiv_code!='00' and cir_code!='00' and mouza_pargona_code!='00'
        and lot_no='00'";
        $mouza_list = $this->db->query($mouza_list_query, array($dist_code))->result();
        $mouza_with_payments_arr = array();
        foreach($mouza_list as $mouza){
            $total_amt = $this->db->query("select sum(total_khajana) from ekhajana_commission_details 
                                where application_under='MOUZADAR' and status='F' and dist_code=?
                                and subdiv_code=? and cir_code=? and mouza_pargona_code=?", 
                                array($mouza->dist_code,$mouza->subdiv_code,$mouza->cir_code,
                                $mouza->mouza_pargona_code))->row()->sum;
            if($total_amt == NULL){
                $total_amt = 0;
            }
            $mouza_with_payments_arr[$mouza->loc_name] = $total_amt;
        }
        $unique_payments = array_unique($mouza_with_payments_arr);
        arsort($unique_payments);
        $count= 1;
        $rank_arr = array();
        foreach($unique_payments as $unique_payment){
            $rank_arr[$unique_payment] = $count;
            $count= $count+1;
        }
        arsort($mouza_with_payments_arr);
        $mouza_with_payments_arr_sorted = array(); 
        foreach($mouza_with_payments_arr as $key=>$value){
            //return $key.$value;
            array_push($mouza_with_payments_arr_sorted,[
                "district" => $dist_name,
                "amount_received" => $value,
                "rank" => $rank_arr[$value],
                "mouza" => $key
            ]);
        }
        return $mouza_with_payments_arr_sorted;
    }

    public function getDistrcitWiseTotalAmountReceivedTehsildariArea(){
        
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $dist_list = "select dist_code,loc_name from location where dist_code!='00' and subdiv_code='00' and cir_code='00' and dist_code in('02', '03', '21', '13', '38')";
        $districts = $this->db->query($dist_list)->result();
        $distrct_with_payments_arr = array();      
        $district_code_arr = array();  
	foreach($districts as $dist){            
	    $total_amt = $this->db->query("select sum(ep.paid_amount) 
            from ekhajana_payment ep join ekhajana_land_details eld on ep.ld_application_no = eld.ld_application_no
            where eld.application_under not in ('MOUZADAR','DIRECT-PAYING') and eld.status='F' and ep.status='F' 
            and eld.dist_code=?", array($dist->dist_code))->row()->sum;
            if($total_amt == NULL){
                $total_amt = 0;
            } 
            $distrct_with_payments_arr[$dist->loc_name] = $total_amt;
            $district_code_arr[$dist->loc_name] = $dist->dist_code;
        }        
        $unique_payments = array_unique($distrct_with_payments_arr);
        arsort($unique_payments);
        $count= 1;
        $rank_arr = array();
        foreach($unique_payments as $unique_payment){
            $rank_arr[$unique_payment] = $count;
            $count= $count+1;
        }
        arsort($distrct_with_payments_arr);
        //return $distrct_with_payments_arr;
        $distrct_with_payments_arr_sorted = array(); 
        //return $distrct_with_payments_arr;
        foreach($distrct_with_payments_arr as $key=>$value){
            //return $key.$value;            
            array_push($distrct_with_payments_arr_sorted,[
                "district" => $key,
                "amount_received" => $value,
                "rank" => $rank = $rank_arr[$value],
                "dist_code" => $district_code_arr[$key]
            ]);
        }
        return $distrct_with_payments_arr_sorted;
    }

    public function getCircleWiseTotalAmountReceivedFromDistrict($dist_code){
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $dist_name = $this->db->query("select loc_name from location where dist_code='$dist_code' 
        and subdiv_code='00'")->row()->loc_name;
        $circle_list_query = "select dist_code,subdiv_code,cir_code,mouza_pargona_code,loc_name from 
        location where dist_code=? and subdiv_code!='00' and cir_code!='00' and mouza_pargona_code='00'";
        $circle_list = $this->db->query($circle_list_query, array($dist_code))->result();
        //return $circle_list;
        $circle_with_payments_arr = array();
        foreach($circle_list as $circle){
            //return $circle;
            $total_amt = $this->db->query("select sum(ep.paid_amount) 
            from ekhajana_payment ep join ekhajana_land_details eld on ep.ld_application_no = eld.ld_application_no
            where eld.application_under not in ('MOUZADAR','DIRECT-PAYING') and eld.status='F' and ep.status='F' 
            and eld.dist_code=? and eld.subdiv_code=? and eld.cir_code=?", array($circle->dist_code,
            $circle->subdiv_code, $circle->cir_code))->row()->sum;
            if($total_amt == NULL){
                $total_amt = 0;
            }
            $circle_with_payments_arr[$circle->loc_name] = $total_amt;
        }
        $unique_payments = array_unique($circle_with_payments_arr);
        arsort($unique_payments);
        $count= 1;
        $rank_arr = array();
        foreach($unique_payments as $unique_payment){
            $rank_arr[$unique_payment] = $count;
            $count= $count+1;
        }
        arsort($circle_with_payments_arr);
        $circle_with_payments_arr_sorted = array(); 
        foreach($circle_with_payments_arr as $key=>$value){
            //return $key.$value;
            array_push($circle_with_payments_arr_sorted,[
                "district" => $dist_name,
                "amount_received" => $value,
                "rank" => $rank_arr[$value],
                "circle" => $key
            ]);
        }
        return $circle_with_payments_arr_sorted;
    }

    public function getTotal2024RevYrAmt(){
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $total_amt = $this->db->query("select sum(paid_amount) from ekhajana_payment where status='F' 
        and date(created_at)>='2024-07-01'")->row()->sum;
        return $total_amt;
    }


    public function getReconciliationDetails()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_RECONCILIATION_REPORT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 200){
            $response_obj = json_decode($response);
            return ['msg' =>$response_obj, 'flag'=>'SUCCESS'];
        }else{
            log_message("error", "#EKHADCDCDPEWICRLL006, Curl Error(200) In Api ".EKHAJANA_RECONCILIATION_REPORT);
            return ['msg' =>"", 'flag'=>'ERROR'];
        }
    }
    
    public function getMouzaWiseReconciliationDetails($dist_code)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => EKHAJANA_RECONCILIATION_REPORT_BREAKDOWN . '/' . $dist_code,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 200){
            $response_obj = json_decode($response);
            return ['msg' =>$response_obj, 'flag'=>'SUCCESS'];
        }else{
            log_message("error", "#EKHADCDCDPEWICRLL006, Curl Error(200) In Api ".EKHAJANA_RECONCILIATION_REPORT_BREAKDOWN);
            return ['msg' =>"", 'flag'=>'ERROR'];
        }
    }



}
?>
