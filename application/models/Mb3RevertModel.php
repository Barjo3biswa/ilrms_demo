<?php
class Mb3RevertModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->dbswitch();
        // $this->db2 = $this->load->database('kamrup', TRUE);

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



    public function getAllRevertedCasesUnderDepartmentAll($dbb,$service_code,$start, $length, $order,$dist_code,$searchByCol_0)
    {

        $col = 0;
        $dir = "desc";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        // Ensure direction is either asc or desc
        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
        // Apply ordering
        $order_column = "petition_no"; 
        if ($order != null) {
            $dbb->order_by($order_column, $dir);
        }

        $table='settlement_basic';
        if($service_code == '40'){  //reclass
           $table= 'reclass_suite_basic';
        }else if($service_code == '44'){ //Conversion
            $table= 'petition_basic';
            $service_code = NULL;
        }
        $searchByCol_0 = strtoupper($this->input->post('columns')[1]['search']['value']);
        if(!empty($searchByCol_0)){
            $dbb->where('case_no like \'%'.$searchByCol_0.'%\'');
        }
        $col = 0;

        $dbb->select('*');
        $dbb->from("$table");
        $dbb->where('dept_revert', 1);
        if ($service_code != NULL) {
            $dbb->where('service_code', $service_code);
        }

        $dbb->limit($length, $start);
        if ($searchByCol_0 != null) {
            $dbb->like('case_no', $searchByCol_0);
        }
        $query = $dbb->get();
        // echo $dbb->last_query();
        // die;
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
            $dbb->select('*');
            $dbb->from("$table");
            $dbb->where('dept_revert', 1);
            // $dbb->where('service_code', $service_code);
            if ($service_code != NULL) {
                $dbb->where('service_code', $service_code);
            }
            if ($searchByCol_0 != null) {
                $dbb->like('case_no', $searchByCol_0);
            }
            $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }

    public function getDeptUserDistListWithRevertedCaseCount($service_code)
    {
        $table='settlement_basic';
        if($service_code == '40'){
           $table= 'reclass_suite_basic';
        }else if($service_code == '44'){
            $table= 'petition_basic';
        }
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

            if($service_code == '44'){
                $sqlForCaseCountAgainstDistrict = $this->db2->query("SELECT count(*) as total FROM $table WHERE dist_code = ? and dept_revert =? and status = ?
                ",array($value->dist_code,1,'R'))->row();
            }else{
                $sqlForCaseCountAgainstDistrict = $this->db2->query("SELECT count(*) as total FROM $table WHERE dist_code = ? and dept_revert =? and service_code= ? and status = ?
                ",array($value->dist_code,1,$service_code,'R'))->row();
            }
            

            if(!empty($sqlForCaseCountAgainstDistrict) && isset($sqlForCaseCountAgainstDistrict) && $sqlForCaseCountAgainstDistrict != null){
                $caseCount = $sqlForCaseCountAgainstDistrict->total;
            }
            $dist_list[$key]->case_count = $caseCount;
        }
        return $dist_list;
    }
}