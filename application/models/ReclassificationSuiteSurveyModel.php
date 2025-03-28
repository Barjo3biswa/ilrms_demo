<?php
class ReclassificationSuiteSurveyModel extends CI_Model
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
    public function getReclassCaseDagDetails($dbb,$case_no) {
        $cases = $dbb->query("select * from reclass_dag_details  where case_no = ? and is_wet_land='Y'",
            array($case_no));
        return $cases->result();
    }
    public function getReclassCaseDetails($dbb,$distCode,$case_no) {
        $cases = $dbb->query("select * from reclass_suite_basic where dist_code = ? and case_no = ?",
            array($distCode,$case_no));
        return $cases->row();
    }

    public function getReclassCaseList($dbb,$distCode) {
        $cases = $dbb->query("select * from reclass_suite_basic where dist_code = ?",
            array($distCode));
        return $cases->result();
    }

    public function iXgetReclassCaseListAds($dbb,$distCode) {
        $cases = $dbb->query("select * from reclass_suite_basic where dist_code = ? and jds_approve= ? and ads_approve = ? and dlr_approve is null",
            array($distCode,1,1));
        return $cases->result();
    }
    public function getReclassCaseListAds($dbb,$distCode) {
        $cases = $dbb->query("select * from reclass_suite_basic where dist_code = ? and jds_approve= ?",
            array($distCode,'1'));
        return $cases->result();
    }

    public function getReclassCaseListDlr($dbb,$distCode) {
        $cases = $dbb->query("select * from reclass_suite_basic where dist_code = ? and jds_approve= ? and ads_approve = ? and dlr_approve is null ",
            array($distCode,'2','1'));
        return $cases->result();
    }

    public function getPendingCaseListDetails($dbb, $start, $length, $order, $dist_code, $searchByCol_0)
    {
        // Determine column and direction for ordering
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

        // Build the query to fetch data
        $dbb->select('*');
        $dbb->from('reclass_suite_basic');
        $dbb->where('dist_code', $dist_code);
        $dbb->where('pending_officer', JDS);
        $dbb->where('status', 'J');
        //$dbb->where('ads_approve', NULL);

        // Apply limit and offset
        $dbb->limit($length, $start);
        $query = $dbb->get();

        // Check if there are results
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

            // Build the query to count total records
            $dbb->select('*');
            $dbb->from('reclass_suite_basic');
            $dbb->where('dist_code', $dist_code);
            $dbb->where('pending_officer', JDS);
            $dbb->where('status', 'J');
            //$dbb->where('ads_approve', NULL);

            if ($searchByCol_0 != null) {
                $dbb->like('locname_eng', $searchByCol_0);
            }

            $data['total_records'] = $dbb->count_all_results();

            return $data;
        }

        return null;
    }

    public function updateReclassBasicForCab($dbb, $case_no,$dist_code,$updateArr)
    {
        $where =array('case_no' => $case_no,'dist_code' => $dist_code);
        $dbb->set($updateArr)->where($where)->update('reclass_suite_basic');
        return $dbb->affected_rows();
    }

    public function getPendingCaseListDetailsAds($dbb, $start, $length, $order, $dist_code, $searchByCol_0)
    {
        // Determine column and direction for ordering
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

        // Build the query to fetch data
        $dbb->select('*');
        $dbb->from('reclass_suite_basic');
        $dbb->where('dist_code', $dist_code);
        //$dbb->where('pending_officer', JDS);
        //$dbb->where('status', 'W');
        $dbb->where('ads_approve', null);
        $dbb->where('jds_approve', '1');

        // Apply limit and offset
        $dbb->limit($length, $start);
        $query = $dbb->get();

        // Check if there are results
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

            // Build the query to count total records
            $dbb->select('*');
            $dbb->from('reclass_suite_basic');
            $dbb->where('dist_code', $dist_code);
            //$dbb->where('pending_officer', JDS);
            //$dbb->where('status', 'W');
            $dbb->where('ads_approve', null);
            $dbb->where('jds_approve', '1');

            if ($searchByCol_0 != null) {
                $dbb->like('locname_eng', $searchByCol_0);
            }

            $data['total_records'] = $dbb->count_all_results();

            return $data;
        }

        return null;
    }


    public function getPendingCaseListDetailsDlr($dbb, $start, $length, $order, $dist_code, $searchByCol_0)
    {
        // Determine column and direction for ordering
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

        // Build the query to fetch data
        $dbb->select('*');
        $dbb->from('reclass_suite_basic');
        $dbb->where('dist_code', $dist_code);
        $dbb->where('pending_officer', 'DLR');
        // $dbb->where('status', 'W');
        $dbb->where('ads_approve', '1');
        $dbb->where('jds_approve', '2');
        $dbb->where('dlr_approve', null);
        // Apply limit and offset
        $dbb->limit($length, $start);
        $query = $dbb->get();

        // Check if there are results
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

            // Build the query to count total records
            $dbb->select('*');
            $dbb->from('reclass_suite_basic');
            $dbb->where('dist_code', $dist_code);
            $dbb->where('pending_officer', 'DLR');
        // $dbb->where('status', 'W');
        $dbb->where('ads_approve', '1');
        $dbb->where('jds_approve', '2');
        $dbb->where('dlr_approve', null);
            if ($searchByCol_0 != null) {
                $dbb->like('locname_eng', $searchByCol_0);
            }

            $data['total_records'] = $dbb->count_all_results();

            return $data;
        }

        return null;
    }





















    
}
