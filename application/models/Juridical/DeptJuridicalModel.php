<?php
class DeptJuridicalModel extends CI_Model
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

    public function getTenantCaseList($dbb,$distCode) {
        $cases = $dbb->query("select * from petition_basic fmb where add_off_desig=? and not_fresh =? and status =? and mut_type=? and dist_code=? and bo_note_yn is not null order by petition_no ASC",
            array(MB_DEPARTMENT,'Y','W',CONVERSION_CODE,$distCode));
        return $cases->result();
    }

    public function getPendingCaseListDetails($dbb, $start, $length, $order, $dist_code, $searchByCol_0,$juridical_cat)
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
        $dbb->from('settlement_basic sb');
        $dbb->join('settlement_institution_details si', 'sb.case_no = si.case_no');
        $dbb->where('sb.dist_code', $dist_code);
        $dbb->where('sb.pending_officer', 'DPT');
        $dbb->where('sb.pending_office', 'DPT');
        $dbb->where('sb.service_code', '45');
        $dbb->where('sb.status', 'W');
        $dbb->where('si.ins_cat_type_co', $juridical_cat);
        $dbb->group_start();
        $dbb->where('add_cases_to_memo', 'N');
        $dbb->or_where('add_cases_to_memo IS NULL', null, false);
        $dbb->group_end();


        // Apply limit and offset
        $dbb->limit($length, $start);
        if ($searchByCol_0 != null) {
            $dbb->like('case_no', $searchByCol_0);
        }
        $query = $dbb->get();

        // Check if there are results
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();

            // Build the query to count total records
            $dbb->select('*');
            $dbb->from('settlement_basic sb');
            $dbb->join('settlement_institution_details si', 'sb.case_no = si.case_no');
            $dbb->where('dist_code', $dist_code);
            $dbb->where('pending_officer', 'DPT');
            $dbb->where('pending_office', 'DPT');
            $dbb->where('status', 'W');
            $dbb->where('sb.service_code', '45');
            $dbb->where('si.ins_cat_type_co', $juridical_cat);
            $dbb->group_start();
            $dbb->where('add_cases_to_memo', 'N');
            $dbb->or_where('add_cases_to_memo IS NULL', null, false);
            $dbb->group_end();

            if ($searchByCol_0 != null) {
                $dbb->like('case_no', $searchByCol_0);
            }

            $data['total_records'] = $dbb->count_all_results();

            // echo "<pre>"; var_dump($data); die;

            return $data;
        }

        return null;
    }

    // get all settlement basic
    public function getSettlementBasic($db,$case)
    {
        $basic = $db->select()
            ->where('case_no',$case)
            ->get('settlement_basic');
        return $basic->row_array();
    }

    // get all applicant buyers
    public function getAllApplicantBuyers($db,$case)
    {
        $applicants = $db->select()
            ->where('case_no',$case)
            ->where('pdar_type', 'B')
            ->order_by('is_applicant', 'desc')
            ->get('settlement_applicant');
        return $applicants->result();
    }

    // get all applicant owners
    public function getAllApplicantOwners($db,$case)
    {
        $applicants = $db->select()
            ->where('case_no',$case)
            ->where('pdar_type', 'O')
            ->get('settlement_applicant');
        return $applicants->result();
    }
    // get all applicant encroacher
    public function getAllApplicantDagDetails($db,$case)
    {
        $applicants = $db->select()
            ->where('case_no',$case)
            ->where("pdar_type IN ('EP','DA')")
            ->get('settlement_applicant');
        return $applicants->result();
    }

    // get all settlement dag
    public function getSettlementDag($db,$case)
    {
        $dags = $db->select()
            ->where('case_no',$case)
            ->get('settlement_dag_details');

        return $dags->result();
    }

    // get all settlement tenant lm note
    public function getSettlementTenantLmNote($db,$case)
    {
        $lmnotes = $db->select()
            ->where('case_no',$case)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get('settlement_ap_lmnote');
        return $lmnotes->result();
    }

    // get all settlement proceeding
    public function getSettlementProceeding($db,$case)
    {
        $proceedings = $db->select()
            ->where('case_no',$case)
            ->order_by('proceeding_id', 'desc')
            ->get('settlement_proceeding');
        // return $db->last_query();
        return $proceedings->result();
    }

    // get all settlement proceeding
    public function getDocuments($db,$case)
    {
        $applicaiton_no = $this->getApplidFromCaseNo($db,$case);
        $proceedings = $db->select()
            ->where('case_no in (\''.$applicaiton_no.'\', \''.$case.'\')')
            ->get('supportive_document');

        return $proceedings->result();
    }

    public function getApplidFromCaseNo($db,$case_no) {
        $applid = $db->query("select applid from settlement_basic where case_no ='$case_no'");
        return $applid->row()->applid;
    }

    // get all (B,O,EN,P,GP,GGP) applicant
    public function getAllNomineeDetail($db,$case)
    {
        $applicants = $db->select()
            ->where('case_no',$case)
            ->get('settlement_nominee');
        return $applicants->result();
    }

    // get all (EP) applicant
    public function getAllExistingPattadar($db,$case)
    {
        $applicants = $db->select()
            ->where('case_no',$case)
            ->where('pdar_type', 'EP')
            ->get('settlement_applicant');
        return $applicants->result();
    }

    // get all (DA) applicant
    public function getAllDeedPattadar($db,$case)
    {
        $applicants = $db->select()
            ->where('case_no',$case)
            ->where('pdar_type', 'DA')
            ->get('settlement_applicant');
        return $applicants->result();
    }

    // get all ('P', 'GP', 'GGP') applicant
    public function getAllFamilyTree($db,$case)
    {
        $applicants = $db->select()
            ->where('case_no',$case)
            ->where("pdar_type IN ('P', 'GP', 'GGP')")
            ->get('settlement_applicant');
        return $applicants->result();
    }

    // get premium amount
    public function getPremium($db,$case)
    {
        // $premium = $this->db->select()
        //     ->where('case_no',$case)
        //     ->where('is_final', 1)
        //     ->get('settlement_premium');
        // return $premium->row();
        $premium = "SELECT sp.*,spa.area,spl.land_type,spr.house_type,spr.rate_type as ratetype FROM settlement_premium sp inner join settlement_premium_area spa on spa.paid=sp.area_name inner join settlement_premium_land_type spl on spl.plid=sp.land_type inner join settlement_premium_rate spr on spr.prid=sp.rate_type where case_no='$case' and is_final=1";
        $data = $db->query($premium);
        return $data->result();
    }

    // get all settlement deleted dags
    public function getDeletedDags($db,$case)
    {
        $dags = $db->select()
            ->where('case_no', $case)
            ->where('table_name', 'settlement_dag_details')
            ->get('settlement_deleted_data');
        return $dags->result();
    }

    // count application id by case no for DC
    public function countSettlementApplicationDetailsByCaseNo($db,$caseNo,$dist_code)
    {
        return $db->select()
            ->where('case_no', $caseNo)
            ->where('dist_code', $dist_code)
            ->where('pending_officer', MB_ADD_DEPUTY_COMM)
            ->get('settlement_basic')
            ->num_rows();
    }

    // get application id by case no
    public function getSettlementApplicationDetailsByCaseNo($db,$caseNo,$dist_code)
    {
        return $db->select()
            ->where('case_no', $caseNo)
            ->where('dist_code', $dist_code)
            ->where('pending_officer', 'DPT')
            ->get('settlement_basic')
            ->row();
    }

    // get all settlement reservation
    public function getSettlementReservation($db,$case)
    {
        $lmnotes = $db->select()
            ->where('case_no',$case)
            ->where('is_deleted', 0)
            ->get('settlement_reservation');

        return $lmnotes->result();
    }

    // get all settlement proceeding
    public function getAdditionalProperty($db,$case)
    {
        $property = $db->select()
            ->where('case_no = \''.$case.'\' or applid = \''.$case.'\'')
            ->get('settlement_additional_property');

        return $property->result();
    }


    // *************************************************06-01-2025
    public function updateSettlementBasicForCab($dhar_db,$case_no, $dist_code, $updateData,$insSetProceed)
    {
        // $checkIfAlreadyForwardedToASO = $dhar_db->query("select * from settlement_basic where case_no=? and ast_verification=? and dept_js_approve=?",array($case_no,'S','A'));
        // if($checkIfAlreadyForwardedToASO->num_rows() >= 1){
        //     log_message("error", "#ERR_UP_SETL_BASIC_005, Error in update, data already inserted in num rows found table 'settlement_basic' with last_query ".$dhar_db->last_query());
        //     $dhar_db->trans_rollback();
        //     return 'ROW_EXISTS';
        // }
        $dhar_db->where('case_no', $case_no);
        $dhar_db->where('dist_code', $dist_code);
        $dhar_db->update('settlement_basic', $updateData);
        if($dhar_db->affected_rows() != 1){ 
            $dhar_db->trans_rollback();
            log_message("error", "#ERR_UP_SETL_BASIC_001, Error in update, table 'settlement_basic' with last_query ".$dhar_db->last_query());
            return 'SERVER-ERROR';
        }
        //insert into settlement proceeding
        $tstatus2 = $dhar_db->insert('settlement_proceeding', $insSetProceed);
        if ($tstatus2!= 1)
        {
            $dhar_db->trans_rollback();
            log_message("error", "#ERR_IN_SETL_PRO_002, Error in insert, table 'settlement_proceeding' with last_query ".$dhar_db->last_query());
            return 'SERVER-ERROR';
        }else{
            return 'success'; 
        }
    }

    public function getPendingCaseListDetailsForVerificationAsst($dbb,$start, $length, $order, $dist_code,$searchByCol_0)
    {
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }
        if ($dir != "asc" && $dir != 'desc') {
            $dir = 'desc';
        }
        if ($order != null) {
            $dbb->order_by($order, $dir);
        }
        $dbb->select('*');
        $dbb->from('settlement_basic');
        $dbb->where('dist_code', $dist_code);
        $dbb->where('pending_officer', 'DPT');
        $dbb->where('pending_office', 'DPT');
        $dbb->where('service_code', '45');
        $dbb->where('status', 'W');
        $dbb->where('dept_js_approve', 'A');
        $dbb->where('ast_verification', 'S');
        $dbb->where('assign_ast_code', $this->session->userdata('user_code'));
        $dbb->where('verified_ast_remarks IS NOT NULL');
       
        if ($searchByCol_0 != null) {
            $dbb->like('case_no', $searchByCol_0);
        }
        $dbb->limit($length, $start);
        $query = $dbb->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $dbb->select('*');
        $dbb->from('settlement_basic');
        $dbb->where('dist_code', $dist_code);
        $dbb->where('pending_officer', 'DPT');
        $dbb->where('pending_office', 'DPT');
        $dbb->where('service_code', '45');
        $dbb->where('status', 'W');
        $dbb->where('dept_js_approve', 'A');
        $dbb->where('ast_verification', 'S');
        $dbb->where('assign_ast_code', $this->session->userdata('user_code'));
        $dbb->where('verified_ast_remarks IS NOT NULL');

        if ($searchByCol_0 != null) {
            $dbb->like('case_no', $searchByCol_0);
        }
        $data['total_records'] = $dbb->count_all_results();
            return $data;
        }
    }

    public function getAssistantVerificationDetails($dbb,$case_no)
    {
        $user_code = $this->session->userdata('user_code');
        $sql = "SELECT * FROM settlement_basic WHERE case_no=?";
        $data  = $dbb->query($sql,array($case_no));
        return $data;
    }

    public function getAllApplicantEncroacher($db,$case)
    {
        $applicants = $db->select()
            ->where('case_no',$case)
            ->where('pdar_type', 'EN')
            ->get('settlement_applicant');
        return $applicants->result();
    }

    // get all applicant riotee nok
    public function getAllApplicantRioteeNok($db,$case)
    {
        $applicants = $db->select()
            ->where('case_no',$case)
            ->where_in('pdar_type', ['P','GP','GGP'])
            ->get('settlement_applicant');
        return $applicants->result();
    }

    // get all (B,O,EN,P,GP,GGP) applicant
    public function getInstitutionDetails($db,$case)
    {
        $applicants = $db->query("select sid.*,imc.category_name from settlement_institution_details sid join  ins_master_category imc
            on sid.ins_cat_type_co ::int = imc.id
         where case_no='$case'")->row();
        return $applicants;
    }
    


}

