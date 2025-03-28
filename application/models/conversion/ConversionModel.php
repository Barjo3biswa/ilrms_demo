<?php
class ConversionModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
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

    public function deptDistWithCaseCountConversion()
    {
        $unique_user_id = $this->session->userdata('unique_user_id');
        $this->db = $this->load->database('db2', TRUE);
        $dist_list = $this->db->query("SELECT udb.dist_code FROM depart_users du inner join user_dist_byforcation udb on udb.unique_user_id::int=du.id  where du.unique_user_id='$unique_user_id' and du.active_deactive='E'")->result();
        foreach ($dist_list as $key => $value) {
            $caseCount = 0;
            
            if(IS_PRODUCTION == 0 && $value->dist_code !='07') {
                $caseCount = 0;
                $dist_list[$key]->case_count = $caseCount;
                continue;
            }
            $this->db2 = $this->dbswitch2($value->dist_code);
            $sqlForCaseCountAgainstDistrict = $this->db2->query("SELECT count(sb.*) as total FROM 
                settlement_basic sb 
                where  sb.dist_code = ? and sb.from_office =? and sb.pending_officer =? and sb.cab_memo_prepared = ? and sb.service_code = ?
                ",array($value->dist_code,MB_DEPUTY_COMM,MB_DEPARTMENT,ADD_CASES_TO_CAB_MEMO,LAND_CONVERSION_ID))->row();
            if(!empty($sqlForCaseCountAgainstDistrict) && isset($sqlForCaseCountAgainstDistrict) && $sqlForCaseCountAgainstDistrict != null){
                $caseCount = $sqlForCaseCountAgainstDistrict->total;
            }
            $dist_list[$key]->case_count = $caseCount;
        }
        return $dist_list;
    }
}