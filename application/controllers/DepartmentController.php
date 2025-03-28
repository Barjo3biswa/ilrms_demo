<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DepartmentController extends MY_CONTROLLER
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->library('form_validation');
        $this->load->model('Department_model');
    }

    public function dbswitch($dist_code)
    {
        //$CI=&get_instance();
        
        if($dist_code == "02"){
            $this->dbb=$this->load->database('dhubri', TRUE);
        } else if($dist_code == "05"){
            $this->dbb=$this->load->database('barpeta', TRUE);
        } else if($dist_code == "10"){
            $this->dbb=$this->load->database('chirang', TRUE);
        } else if($dist_code == "13"){
            $this->dbb=$this->load->database('bongaigaon', TRUE);
        }  else if($dist_code == "17"){
            $this->dbb=$this->load->database('dibrugarh', TRUE);
        }  else if($dist_code == "15"){
            $this->dbb=$this->load->database('jorhat', TRUE);
        }  else if($dist_code == "14"){
            $this->dbb=$this->load->database('golaghat', TRUE);
        }  else if($dist_code == "07"){
            $this->dbb=$this->load->database('kamrup', TRUE);
        }  else if($dist_code == "03"){
            $this->dbb=$this->load->database('goalpara', TRUE);
        }  else if($dist_code == "18"){
            $this->dbb=$this->load->database('tinsukia', TRUE);
        }  else if($dist_code == "12"){
            $this->dbb=$this->load->database('lakhimpur', TRUE);
        }  else if($dist_code == "24"){
            $this->dbb=$this->load->database('kamrupm', TRUE);
        }  else if($dist_code == "06"){
            $this->dbb=$this->load->database('nalbari', TRUE);
        }  else if($dist_code == "11"){
            $this->dbb=$this->load->database('sonitpur', TRUE);
        }  else if($dist_code == "16"){
            $this->dbb=$this->load->database('sibsagar', TRUE);
        }  else if($dist_code == "32"){
            $this->dbb=$this->load->database('morigaon', TRUE);
        }  else if($dist_code == "33"){
            $this->dbb=$this->load->database('nagaon', TRUE);
        }  else if($dist_code == "34"){
            $this->dbb=$this->load->database('majuli', TRUE);
        }  else if($dist_code == "21"){
            $this->dbb=$this->load->database('karimganj', TRUE);
        }  else if($dist_code == "35"){
            $this->dbb=$this->load->database('biswanath', TRUE);
        }  else if($dist_code == "36"){
            $this->dbb=$this->load->database('hojai', TRUE);
        }  else if($dist_code == "37"){
            $this->dbb=$this->load->database('charaideo', TRUE);
        }  else if($dist_code == "25"){
            $this->dbb=$this->load->database('dhemaji', TRUE);
        }  else if($dist_code == "39"){
            $this->dbb=$this->load->database('bajali', TRUE);
        }else if($dist_code == "38"){
            $this->dbb=$this->load->database('ssalmara', TRUE);
        }else if($dist_code == "08"){
            $this->dbb=$this->load->database('darrang', TRUE);
        }else if($dist_code == "auth"){
            $this->dbb=$this->load->database('auth', TRUE);
        }
        return $this->dbb;
    }

//    function search()
//    {
//        $data['_view'] = 'Department/index';
//        $this->dbbb = $this->load->database('db2', TRUE);
//        $data['location'] = $this->dbbb->query("Select district_name as loc_name,district_code as dist_code from district_details")->result_array();
//
//        $this->load->view('layouts/main', $data);
//    }

    function caseSearch()
    {
        $data['_view'] = 'Department/CaseSearch';
        $this->load->view('layouts/main', $data);
    }

    function history()
    {
        $this->form_validation->set_rules('user_type', 'Type', 'required');
        $this->form_validation->set_rules('dist_code', 'District Code', 'required');
        if ($this->input->post('user_type') == 'C') {
            $this->form_validation->set_rules('subdiv_code', 'Subdiv Code', 'required');
            $this->form_validation->set_rules('cir_code', 'Circle Code', 'required');
        } else if ($this->input->post('user_type') == 'L') {
            $this->form_validation->set_rules('mouza_code', 'Mouza Code', 'required');
            $this->form_validation->set_rules('lot_code', 'Lot Code', 'required');
        }
        $this->form_validation->set_rules('users', 'User', 'required');
        $this->form_validation->set_rules('from_date', 'Date From', 'required');
        $this->form_validation->set_rules('upto_date', 'Upto Date', 'required');

        if ($this->form_validation->run()) {
            $data['district'] = $this->Department_model->fetchDistName($this->input->post('dist_code'));
            $this->dbb = $this->Department_model->dbswitch($this->input->post('dist_code'));
            $data['subdiv']['loc_name'] = $data['circle']['loc_name'] = null;
            $data['records'] = array();
            if ($this->input->post('user_type') == 'C' || $this->input->post('user_type') == 'L') {
                $data['subdiv'] = $this->Department_model->fetchSubName($this->input->post('dist_code'),
                    $this->input->post('subdiv_code'));
                $data['circle'] = $this->Department_model->fetchCirName($this->input->post('dist_code'),
                    $this->input->post('subdiv_code'), $this->input->post('cir_code'));
                if ($this->input->post('user_type') == 'C') {
                    $data['user_name'] = $this->dbb->query("select username from users where dist_code=? 
                    and subdiv_code=? and cir_code=? and user_code=?", array($this->input->post('dist_code'),
                        $this->input->post('subdiv_code'), $this->input->post('cir_code'),
                        $this->input->post('users')))->row();
                }
                if ($this->input->post('user_type') == 'L') {
                    $data['user_name'] = $this->dbb->query("select lm_name as username from 
                    lm_code where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? 
                    and lot_no=? and lm_code=?", array($this->input->post('dist_code'),
                        $this->input->post('subdiv_code'), $this->input->post('cir_code'),
                        $this->input->post('mouza_code'), $this->input->post('lot_code'),
                        $this->input->post('users')))->row();
                    $data['mouza'] = $this->utilityclass->mouza_name($this->input->post('dist_code'),
                        $this->input->post('subdiv_code'), $this->input->post('cir_code'),
                        $this->input->post('mouza_code'));
                    $data['lot'] = $this->utilityclass->lot_name($this->input->post('dist_code'),
                        $this->input->post('subdiv_code'), $this->input->post('cir_code'),
                        $this->input->post('mouza_code'), $this->input->post('lot_code'));
                }
                $data['records'] = $this->Department_model->fetchRecord();
//                $data['fm_record']=$this->Department_model->fmRecord();
//                $data['ofm_record']=$this->Department_model->ofmRecord();
//                $data['conv_record']=$this->Department_model->convRecord();


            } else if ($this->input->post('user_type') == 'D') {
                $data['records'] = $this->Department_model->fetchDcRecord();
                $data['user_name'] = $this->dbb->query("select username from users where 
                dist_code=? and subdiv_code=? and cir_code=? and user_code=?",
                    array($this->input->post('dist_code'), '00', '00', $this->input->post('users')))->row();
            }
            $data['history'] = $this->Department_model->fetchHistory();
            $data['user_code'] = $this->input->post('users');
            $data['user_type'] = $this->input->post('user_type');
            $data['fromDate'] = date('d-M-Y', strtotime($this->input->post('from_date')));
            $data['upDate'] = date('d-M-Y', strtotime($this->input->post('upto_date')));
            $data['_view'] = 'Department/HistoryResult';
            $this->load->view('layouts/main', $data);
        } else {
            $data['_view'] = 'Department/History';
            $this->load->view('layouts/main', $data);
        }
    }

    function caseType($type)
    {
        switch ($type) {
            case 'field':
                return 'Field Mutation / Partition Case'; ////field mutation
                break;
            case 'office':
                return 'Office Mutation / Partition Case'; ///////field partition
                break;
            case 'conv':
                return 'Conversion Case';///////field objection
                break;
            case 'RC':
                return 'Reclassification';///////office mutation
                break;
            case 'MI':
                return 'Misc Case';///////office partition
                break;
            case 'AL':
                return 'Allotment';///////conversion
                break;
            case 'NR':
            return 'NR Case';///////conversion
            break;
        }
    }


    function getCaseDetails()
    {
        $data['service_type'] = $this->caseType($this->input->post('case_type'));
        $case_type = $this->input->post('case_type');
        $case_no = $this->input->post('case_no');
        $dist_code = $this->input->post('dist_code');
        $this->dbb = $this->dbbswitch($dist_code);

        ////////////field case start/////////
        if ($case_type == 'field') {
            $fmb = $this->dbb->query("select * from field_mut_basic where case_no=? and 
                dist_code=?",
                array($case_no, $dist_code));
            if ($fmb->num_rows() > 0) {
                $fm = $data['fmb'] = $fmb->row();

                $data['order_type'] = $this->dbb->query("select order_type from master_field_mut_type where 
                order_type_code=?", array($fm->mut_type))->row()->order_type;

                $data['trans_type'] = 'None';

                if ($fm->trans_code != '0') {
                    $data['trans_type'] = $this->dbb->query("select trans_desc_as from nature_trans_code where 
                    trans_code=?", array($fm->trans_code))->row()->trans_desc_as;
                }

                $data['district'] = $this->Department_model->fetchDistName($fm->dist_code);

                $data['subdiv'] = $this->Department_model->fetchSubName($fm->dist_code,
                    $fm->subdiv_code);

                $data['circle'] = $this->Department_model->fetchCirName($fm->dist_code,
                    $fm->subdiv_code, $fm->cir_code);

                $data['mouza'] = $this->utilityclass->mouza_name($fm->dist_code,
                    $fm->subdiv_code, $fm->cir_code, $fm->mouza_pargona_code);

                $data['lot'] = $this->utilityclass->lot_name($fm->dist_code,
                    $fm->subdiv_code, $fm->cir_code,
                    $fm->mouza_pargona_code, $fm->lot_no);

                $data['vill'] = $this->utilityclass->village_name($fm->dist_code,
                    $fm->subdiv_code, $fm->cir_code,
                    $fm->mouza_pargona_code, $fm->lot_no, $fm->vill_townprt_code);

                if (($data['fmb']->order_passed == 'y' || $data['fmb']->order_passed == 'Y') && $data['fmb']->is_dispose == null) {

                    $d = $this->dbb->query("select * from chitha_col8_order where case_no=? and dist_code=?",
                        array($case_no, $dist_code));

                    if ($d->num_rows() > 0) {
                        $cco = $d->row();
                        $data['col8_order'] = $d->result();

                        $procedding = $this->dbb->query('select * from petition_proceeding where case_no=? and
                        dist_code=? and subdiv_code=? and cir_code=? order by proceeding_id asc',
                            array($case_no, $dist_code, $cco->subdiv_code, $cco->cir_code));

                        $data['procedding'] = null;
                        if ($procedding->num_rows() > 0) {
                            $data['procedding'] = $procedding->result();
                        }

                        $dag_details = $this->dbb->query("select * from field_mut_dag_details where case_no=? and 
                        dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=?",
                            array($case_no, $dist_code,
                                $cco->subdiv_code, $cco->cir_code,
                                $cco->mouza_pargona_code, $cco->lot_no, $cco->vill_townprt_code));

                        if ($dag_details->num_rows() > 0) {
                            $data['dags'] = $dag_details->result();
                        }

                        if ($cco->order_type_code == '01') {
                            $applicant_details = $this->dbb->query("select * from field_mut_petitioner where case_no=? and 
                        dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=?",
                                array($case_no, $dist_code,
                                    $cco->subdiv_code, $cco->cir_code,
                                    $cco->mouza_pargona_code,$cco->lot_no, $cco->vill_townprt_code));

                            if ($applicant_details->num_rows() > 0) {
                                $data['applicants'] = $applicant_details->result();
                            }
                        } else if ($cco->order_type_code == '02') {
                            $applicant_details = $this->dbb->query("select * from field_part_petitioner where case_no=? and 
                        dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=?",
                                array($case_no, $dist_code,
                                    $cco->subdiv_code, $cco->cir_code,
                                    $cco->mouza_pargona_code, $cco->lot_no, $cco->vill_townprt_code));

                            if ($applicant_details->num_rows() > 0) {
                                $data['applicants'] = $applicant_details->result();
                            }
                        }

                        $field_mut_pattadar_details = $this->dbb->query("select * from field_mut_pattadar where 
                        case_no=? and dist_code=? and subdiv_code=? and cir_code=? and 
                        mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=?",
                            array($case_no, $dist_code,
                                $cco->subdiv_code, $cco->cir_code,
                                $cco->mouza_pargona_code, $cco->lot_no, $cco->vill_townprt_code));

                        if ($field_mut_pattadar_details->num_rows() > 0) {
                            $data['pattdars'] = $field_mut_pattadar_details->result();
                        }

                        $data['co_order_note'] = '';
                        $petition_proceeding_query = $this->dbb->query("select co_order from petition_proceeding where 
                        case_no=? and dist_code=? and subdiv_code=? 
                        and cir_code=? and status=? order by proceeding_id asc",
                            array($case_no, $dist_code,
                                $cco->subdiv_code, $cco->cir_code, 'final'));

                        if ($petition_proceeding_query->num_rows() > 0) {
                            $data['co_order_note'] = $petition_proceeding_query->row()->co_order;
                        }
                    }
                }

            } else {
                $this->session->set_flashdata('message', 'Please check case no or service type or district.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        ///////////field case end /// //////////////////////////

        ////////////Office case start
        if ($case_type == 'office') {
            $d = $this->dbb->query("select * from petition_basic where case_no=? and 
                dist_code=? and (mut_type=? or mut_type=?)",
                array($case_no, $dist_code, '03', '04'));

            if ($d->num_rows() > 0) {
                $pb = $data['petition_basic']  = $d->row();
                $data['district'] = $this->Department_model->fetchDistName($pb->dist_code);
                $data['subdiv'] = $this->Department_model->fetchSubName($pb->dist_code,
                    $pb->subdiv_code);
                $data['circle'] = $this->Department_model->fetchCirName($pb->dist_code,
                    $pb->subdiv_code, $pb->cir_code);
                $data['mouza'] = $this->utilityclass->mouza_name($pb->dist_code,
                    $pb->subdiv_code, $pb->cir_code, $pb->mouza_pargona_code);
                $data['lot'] = $this->utilityclass->lot_name($pb->dist_code,
                    $pb->subdiv_code, $pb->cir_code,
                    $pb->mouza_pargona_code, $pb->lot_no);
                $data['vill'] = $this->utilityclass->village_name($pb->dist_code,
                    $pb->subdiv_code, $pb->cir_code,
                    $pb->mouza_pargona_code, $pb->lot_no, $pb->vill_townprt_code);

                $data['order_type'] = $this->dbb->query("select order_type from master_office_mut_type where 
                order_type_code=?", array($pb->mut_type))->row()->order_type;

                $data['trans_type'] = 'None';

                if ($pb->trans_code != '0' && $pb->trans_code != null) {
                    $data['trans_type'] = $this->dbb->query("select trans_desc_as from nature_trans_code where 
                    trans_code=?", array($pb->trans_code))->row()->trans_desc_as;
                }

                $procedding = $this->dbb->query('select * from petition_proceeding where case_no=? and
                        dist_code=? and subdiv_code=? and cir_code=? order by proceeding_id asc',
                    array($case_no, $dist_code, $pb->subdiv_code, $pb->cir_code));

                $data['procedding'] = null;
                if ($procedding->num_rows() > 0) {
                    $data['procedding'] = $procedding->result();
                }

                /////////////CHECK STATUS IS PASSED/////
                if ($pb->status == 'F') {
                    $lm_note = $this->dbb->query("select * from petition_lm_note where petition_no=? and
                    dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? 
                    and lot_no=? and vill_townprt_code=? and year_no=?",
                        array($pb->petition_no, $dist_code, $pb->subdiv_code,$pb->cir_code,
                            $pb->mouza_pargona_code, $pb->lot_no,
                            $pb->vill_townprt_code, $pb->year_no));

                    if ($lm_note->num_rows() > 0) {
                        $data['lm_note'] = $lm_note->result();
                    }

                    $data['ch_ord_b'] = null;
                    $ch_ord_b = $this->dbb->query("select * from chitha_rmk_ordbasic where case_no=? and
                    dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? 
                    and lot_no=? and vill_townprt_code=? order by dag_no asc",
                        array($case_no, $dist_code, $pb->subdiv_code, $pb->cir_code,
                            $pb->mouza_pargona_code, $pb->lot_no, $pb->vill_townprt_code));

                    if ($ch_ord_b->num_rows() > 0) {
                        $data['ch_ord_b'] = $ch_ord_b->result();
                    }

                    $dag_details = $this->dbb->query("select * from petition_dag_details where petition_no=? and 
                    dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and 
                    vill_townprt_code=? and year_no=?",
                        array($pb->petition_no, $dist_code,
                            $pb->subdiv_code, $pb->cir_code,
                            $pb->mouza_pargona_code, $pb->lot_no,
                            $pb->vill_townprt_code, $pb->year_no));

                    if ($dag_details->num_rows() > 0) {
                        $data['dags'] = $dag_details->result();
                    }

                    if ($pb->mut_type == '03') {
                        $applicant_details = $this->dbb->query("select * from petitioner where 
                        petition_no=? and 
                        dist_code=? and subdiv_code=? and cir_code=? and 
                        mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=? and year_no=?",
                            array($pb->petition_no, $dist_code,
                                $pb->subdiv_code, $pb->cir_code,
                                $pb->mouza_pargona_code, $pb->lot_no,
                                $pb->vill_townprt_code, $pb->year_no));

                        if ($applicant_details->num_rows() > 0) {
                            $data['applicants'] = $applicant_details->result();
                        }
                    } else if ($pb->mut_type == '04') {
                        $applicant_details = $this->dbb->query("select * from petitioner_part where 
                        petition_no=? and 
                        dist_code=? and subdiv_code=? and cir_code=? and 
                        mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=? and year_no=?",
                            array($pb->petition_no, $dist_code,
                                $pb->subdiv_code, $pb->cir_code,
                                $pb->mouza_pargona_code, $pb->lot_no,
                                $pb->vill_townprt_code, $pb->year_no));

                        if ($applicant_details->num_rows() > 0) {
                            $data['applicants'] = $applicant_details->result();
                        }
                    }

                    $pattadar_details = $this->dbb->query("select * from petition_pattadar where 
                        petition_no=? and 
                        dist_code=? and subdiv_code=? and cir_code=? and 
                        mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=? and year_no=?",
                        array($pb->petition_no, $dist_code,
                            $pb->subdiv_code, $pb->cir_code,
                            $pb->mouza_pargona_code, $pb->lot_no,
                            $pb->vill_townprt_code, $pb->year_no));

                    if ($pattadar_details->num_rows() > 0) {
                        $data['pattdars'] = $pattadar_details->result();
                    }
                }

            } else {
                $this->session->set_flashdata('message', 'Please check case no or service type or district.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }///////////office case end

        ////////////conversion case start
        if ($case_type == 'conv') {
            $d = $this->dbb->query("select * from petition_basic where case_no=? and 
                dist_code=? and mut_type=?",
                array($case_no, $dist_code, '01'));

            if ($d->num_rows() > 0) {
                $pb = $data['petition_basic'] = $d->row();
                $data['district'] = $this->Department_model->fetchDistName($pb->dist_code);

                $data['subdiv'] = $this->Department_model->fetchSubName($pb->dist_code,
                    $pb->subdiv_code);

                $data['circle'] = $this->Department_model->fetchCirName($pb->dist_code,
                    $pb->subdiv_code, $pb->cir_code);

                $data['mouza'] = $this->utilityclass->mouza_name($pb->dist_code,
                    $pb->subdiv_code, $pb->cir_code, $pb->mouza_pargona_code);

                $data['lot'] = $this->utilityclass->lot_name($pb->dist_code,
                    $pb->subdiv_code, $pb->cir_code,
                    $pb->mouza_pargona_code, $pb->lot_no);

                $data['vill'] = $this->utilityclass->village_name($pb->dist_code,
                    $pb->subdiv_code, $pb->cir_code,
                    $pb->mouza_pargona_code, $pb->lot_no, $pb->vill_townprt_code);



                $data['order_type'] = $this->dbb->query("select order_type from master_office_mut_type where 
                order_type_code=?", array($pb->mut_type))->row()->order_type;

                $data['trans_type'] = 'FULL';

                $procedding = $this->dbb->query('select * from petition_proceeding where case_no=? and
                    dist_code=? and subdiv_code=? and cir_code=? order by proceeding_id asc',
                    array($case_no, $dist_code, $pb->subdiv_code, $pb->cir_code));

                $data['procedding'] = null;
                if ($procedding->num_rows() > 0) {
                    $data['procedding'] = $procedding->result();
                }

                /////////////CHECK STATUS IS PASSED/////
                if ($pb->status == 'F') {
                    $lm_note = $this->dbb->query("select * from petition_lm_note where 
                    petition_no=? and
                    dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? 
                    and lot_no=? and vill_townprt_code=? and year_no=?",
                        array($pb->petition_no, $dist_code, $pb->subdiv_code,
                            $pb->cir_code,
                            $pb->mouza_pargona_code, $pb->lot_no,
                            $pb->vill_townprt_code, $pb->year_no));

                    if ($lm_note->num_rows() > 0) {
                        $data['lm_note'] = $lm_note->result();
                    }

                    $data['ch_ord_b'] = null;
                    $ch_ord_b = $this->dbb->query("select * from chitha_rmk_ordbasic where
                        case_no=? and
                        dist_code=? and subdiv_code=? and cir_code=? 
                        and mouza_pargona_code=?
                        and lot_no=? and vill_townprt_code=?",
                        array($case_no, $dist_code, $pb->subdiv_code, $pb->cir_code,
                            $pb->mouza_pargona_code, $pb->lot_no, $pb->vill_townprt_code));

                    if ($ch_ord_b->num_rows() > 0) {
                        $data['ch_ord_b'] = $ch_ord_b->row();

                        $data['dags'] = null;
                        $dag_details = $this->dbb->query("select * from petition_dag_details where 
                        petition_no=? and 
                        dist_code=? and subdiv_code=? and cir_code=? 
                        and mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=? and year_no=?",
                            array($pb->petition_no, $dist_code,
                                $pb->subdiv_code, $pb->cir_code,
                                $pb->mouza_pargona_code, $pb->lot_no,
                                $pb->vill_townprt_code, $pb->year_no));

                        if ($dag_details->num_rows() > 0) {
                            $data['dags'] = $dag_details->result();
                        }

                        $data['applicants'] = null;
                        $applicant_details = $this->dbb->query("select * from petitioner_part 
                        where petition_no=? and 
                        dist_code=? and subdiv_code=? and cir_code=? and 
                        mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=? and year_no=?",
                            array($pb->petition_no, $dist_code,
                                $pb->subdiv_code, $pb->cir_code,
                                $pb->mouza_pargona_code, $pb->lot_no,
                                $pb->vill_townprt_code, $pb->year_no));

                        if ($applicant_details->num_rows() > 0) {
                            $data['applicants'] = $applicant_details->result();
                        }

                        $dc_pros = $this->dbb->query("select * from petition_proceeding_dc_adc 
                        where case_no=? and dist_code=? order by proceeding_id asc",
                            array( $case_no, $dist_code));

                        if ($dc_pros->num_rows() > 0) {
                            $data['dc_pros'] = $dc_pros->result();
                        }

                        $data['conv_ord'] = null;
                        $conv_ord = $this->dbb->query("select * from t_chitha_rmk_convorder 
                        where ord_no=? and 
                        dist_code=? and subdiv_code=? and cir_code=? and 
                        mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=?",
                            array($case_no, $dist_code,
                                $pb->subdiv_code, $pb->cir_code,
                                $pb->mouza_pargona_code, $pb->lot_no, $pb->vill_townprt_code));

                        if ($conv_ord->num_rows() > 0) {
                            $data['conv_ord'] = $conv_ord->result();
                        }
                    }
                }

            } else {
                $this->session->set_flashdata('message', 'Please check case no or service type or district.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }///////////conversion case end
        /// /////////////////////////////

        ////////////reclass case start
        if ($case_type == 'RC') {
            $d = $this->dbb->query("select * from t_reclassification where case_no=? and 
                dist_code=?", array($case_no, $dist_code));

            if ($d->num_rows() > 0) {
                $tr = $d->row();
                $data['district'] = $this->Department_model->fetchDistName($tr->dist_code);
                $data['subdiv'] = $this->Department_model->fetchSubName($tr->dist_code,
                    $tr->subdiv_code);
                $data['circle'] = $this->Department_model->fetchCirName($tr->dist_code,
                    $tr->subdiv_code, $tr->cir_code);
                $data['mouza'] = $this->utilityclass->mouza_name($tr->dist_code,
                    $tr->subdiv_code, $tr->cir_code, $tr->mouza_pargona_code);
                $data['lot'] = $this->utilityclass->lot_name($tr->dist_code,
                    $tr->subdiv_code, $tr->cir_code,
                    $tr->mouza_pargona_code, $tr->lot_no);
                $data['vill'] = $this->utilityclass->village_name($tr->dist_code,
                    $tr->subdiv_code, $tr->cir_code,
                    $tr->mouza_pargona_code, $tr->lot_no, $tr->vill_townprt_code);
                $data['reclass'] = $this->dbb->query("select * from chitha_rmk_reclassification where 
                    case_no=? and dist_code=? and subdiv_code=? 
                    and cir_code=? and mouza_pargona_code=?
                    and lot_no=? and vill_townprt_code=?",
                    array($case_no, $dist_code, $tr->subdiv_code, $tr->cir_code,
                        $tr->mouza_pargona_code,
                        $tr->lot_no, $tr->vill_townprt_code))->result();

                $data['order_type'] = 'Reclassification';

                $procedding = $this->dbb->query('select * from petition_proceeding where case_no=? and
                    dist_code=? and subdiv_code=? and cir_code=? order by proceeding_id asc',
                    array($case_no, $dist_code, $tr->subdiv_code, $tr->cir_code));
                $data['procedding'] = null;
                if ($procedding->num_rows() > 0) {
                    $data['procedding'] = $procedding->result();
                }

                $dc_pros = $this->dbb->query("select * from petition_proceeding_dc_adc where case_no=? and
                dist_code=? order by proceeding_id asc",
                        array($case_no, $dist_code));
                if ($dc_pros->num_rows() > 0) {
                    $data['dc_pros'] = $dc_pros->result();
                }
                $data['t_reclass'] = null;
                $t_reclass = $this->dbb->query("select * from t_reclassification where case_no=? and
                dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?
                and lot_no=? and vill_townprt_code=?",
                    array($case_no, $dist_code, $tr->subdiv_code, $tr->cir_code,
                        $tr->mouza_pargona_code, $tr->lot_no, $tr->vill_townprt_code));
                if ($t_reclass->num_rows() > 0) {
                    $data['t_reclass'] = $t_reclass->result();
                }
            } else {
                $this->session->set_flashdata('message', 'Please check case no or service type or district.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }///////////reclass case end


        ////////////allotment case start
        if ($case_type == 'AL') {
            $d = $this->dbb->query("select * from allotment_cert_basic where case_no=? and 
                dist_code=?",
                array($case_no, $dist_code));

            if ($d->num_rows() > 0) {
                $acb = $data['al'] = $d->row();
                $data['district'] = $this->Department_model->fetchDistName($acb->dist_code);

                $data['subdiv'] = $this->Department_model->fetchSubName($acb->dist_code,
                    $acb->subdiv_code);

                $data['circle'] = $this->Department_model->fetchCirName($acb->dist_code,
                    $acb->subdiv_code, $acb->circle_code);

                $data['mouza'] = $this->utilityclass->mouza_name($acb->dist_code,
                    $acb->subdiv_code, $acb->circle_code, $acb->mouza_pargona_code);

                $data['lot'] = $this->utilityclass->lot_name($acb->dist_code,
                    $acb->subdiv_code, $acb->circle_code,
                    $acb->mouza_pargona_code, $acb->lot_no);

                $data['vill'] = $this->utilityclass->village_name($acb->dist_code,
                    $acb->subdiv_code, $acb->circle_code,
                    $acb->mouza_pargona_code, $acb->lot_no, $acb->vill_townprt_code);

                $data['order_type'] = "Allotment";

                $data['trans_type'] = 'NA';

                $procedding = $this->dbb->query('select * from petition_proceeding where case_no=? and
                    dist_code=? and subdiv_code=? and cir_code=? order by proceeding_id asc',
                    array($case_no, $dist_code, $acb->subdiv_code, $acb->circle_code));

                $data['procedding'] = null;
                if ($procedding->num_rows() > 0) {
                    $data['procedding'] = $procedding->result();
                }

                $dc_pros = $this->dbb->query("select * from petition_proceeding_dc_adc where case_no=? and
                dist_code=? order by proceeding_id asc",
                    array( $case_no, $dist_code));

                if ($dc_pros->num_rows() > 0) {
                    $data['dc_pros'] = $dc_pros->result();
                }

                /////////////CHECK STATUS IS PASSED/////
                if ($acb->status == 'F') {
                    $lm_note = $this->dbb->query("select * from allotment_lm_note where case_no=? and
                dist_code=? and subdiv_code=? and circle_code=? and mouza_pargona_code=? 
                    and lot_no=? and vill_townprt_code=?",
                        array($case_no, $dist_code, $acb->subdiv_code, $acb->circle_code,
                            $acb->mouza_pargona_code, $acb->lot_no, $acb->vill_townprt_code));

                    if ($lm_note->num_rows() > 0) {
                        $data['lm_note'] = $lm_note->result();
                    }

                    $data['ch_ord_b'] = null;
                    $ch_ord_b = $this->dbb->query("select * from chitha_rmk_ordbasic where case_no=? and
                    dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?
                    and lot_no=? and vill_townprt_code=?",
                        array($case_no, $dist_code, $acb->subdiv_code, $acb->circle_code,
                            $acb->mouza_pargona_code, $acb->lot_no, $acb->vill_townprt_code));

                    if ($ch_ord_b->num_rows() > 0) {
                        $data['ch_ord_b'] = $ch_ord_b->row();

                        $data['dags'] = null;
                        $dag_details = $this->dbb->query("select * from allotment_pet_dag where case_no=? and 
                        dist_code=? and subdiv_code=? and circle_code=? and mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=?",
                            array($case_no, $dist_code,
                                $acb->subdiv_code, $acb->circle_code,
                                $acb->mouza_pargona_code, $acb->lot_no, $acb->vill_townprt_code));

                        if ($dag_details->num_rows() > 0) {
                            $data['dags'] = $dag_details->result();
                        }

                        $data['applicants'] = null;
                        $applicant_details = $this->dbb->query("select * from allotment_petitioner where 
                        case_no=? and 
                        dist_code=? and subdiv_code=? and circle_code=? and 
                        mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=?",
                            array($case_no, $dist_code,
                                $acb->subdiv_code, $acb->circle_code,
                                $acb->mouza_pargona_code, $acb->lot_no, $acb->vill_townprt_code));

                        if ($applicant_details->num_rows() > 0) {
                            $data['applicants'] = $applicant_details->result();
                        }

                        $data['pattdars'] = null;
                        $pattadar_details = $this->dbb->query("select * from petition_pattadar where 
                        petition_no=? and 
                        dist_code=? and subdiv_code=? and cir_code=? and 
                        mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=? and year_no=?",
                            array($acb->petition_no, $dist_code,
                                $acb->subdiv_code, $acb->circle_code,
                                $acb->mouza_pargona_code, $acb->lot_no,
                                $acb->vill_townprt_code, $acb->year_no));

                        if ($pattadar_details->num_rows() > 0) {
                            $data['pattdars'] = $pattadar_details->result();
                        }

                        $data['ch_ord'] = null;
                        $ch_ord = $this->dbb->query("select * from chitha_rmk_allottee where ord_no=? and 
                        dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and 
                        vill_townprt_code=?",
                            array($case_no, $dist_code,
                                $acb->subdiv_code, $acb->circle_code,
                                $acb->mouza_pargona_code, $acb->lot_no, $acb->vill_townprt_code));

                        if ($ch_ord->num_rows() > 0) {
                            $data['ch_ord'] = $ch_ord->result();
                        }
                    }
                }

            } else {
                $this->session->set_flashdata('message', 'Please check case no or service type or district.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }///////////allotment case end
        /// /////////////////////////////


        ////////////MISC case start
        if ($case_type == 'MI') {
            $d = $this->dbb->query("select * from misc_case_basic where misc_case_no=? and 
                dist_code=?",
                array($case_no, $dist_code));

            if ($d->num_rows() > 0) {
                $mcb = $data['mi'] = $d->row();
                $data['district'] = $this->Department_model->fetchDistName($mcb->dist_code);

                $data['subdiv'] = $this->Department_model->fetchSubName($mcb->dist_code,
                    $mcb->subdiv_code);

                $data['circle'] = $this->Department_model->fetchCirName($mcb->dist_code,
                    $mcb->subdiv_code, $mcb->cir_code);

                $data['mouza'] = $this->utilityclass->mouza_name($mcb->dist_code,
                    $mcb->subdiv_code, $mcb->cir_code, $mcb->mouza_pargona_code);

                $data['lot'] = $this->utilityclass->lot_name($mcb->dist_code,
                    $mcb->subdiv_code, $mcb->cir_code,
                    $mcb->mouza_pargona_code, $mcb->lot_no);

                $data['vill'] = $this->utilityclass->village_name($mcb->dist_code,
                    $mcb->subdiv_code, $mcb->cir_code,
                    $mcb->mouza_pargona_code, $mcb->lot_no, $mcb->vill_townprt_code);



                if($mcb->misc_case_type == '06'){
                    $data['order_type'] = "Name Correction";
                }
                elseif ($mcb->misc_case_type == '07')
                {
                    $data['order_type'] = "Name Deletion";
                }

//                $procedding = $this->dbb->query('select * from petition_proceeding where case_no=? and
//                    dist_code=? and subdiv_code=? and cir_code=?',
//                    array($case_no, $dist_code, $mcb->subdiv_code, $mcb->cir_code));
//
//                $data['procedding'] = null;
//                if ($procedding->num_rows() > 0) {
//                    $data['procedding'] = $procedding->result();
//                }

                $dc_pros = $this->dbb->query("select * from petition_proceeding_dc_adc where case_no=? and
                dist_code=? order by proceeding_id asc",
                    array( $case_no, $dist_code));

                if ($dc_pros->num_rows() > 0) {
                    $data['dc_pros'] = $dc_pros->result();
                }

                /////////////CHECK STATUS IS PASSED/////
                if ($mcb->status == '10') {
                    $data['mis_f'] = null;
                    $mis_f = $this->dbb->query("select * from misc_case_first_party where misc_case_no=? and
                    dist_code=? and subdiv_code=? and cir_code=?",
                        array($case_no, $dist_code, $mcb->subdiv_code, $mcb->cir_code));

                    if ($mis_f->num_rows() > 0) {
                        $data['mis_f'] = $mis_f->result();

                        $data['mis_s'] = null;
                        $mis_s = $this->dbb->query("select * from misc_case_scnd_party where misc_case_no=? and
                            dist_code=? and subdiv_code=? and cir_code=?",
                            array($case_no, $dist_code, $mcb->subdiv_code, $mcb->cir_code));

                        if ($mis_s->num_rows() > 0) {
                            $data['mis_s'] = $mis_s->result();
                        }

                        $data['pros'] = null;
                        $pros = $this->dbb->query("select * from misc_case_process_reports where misc_case_no=? and
                            dist_code=? and subdiv_code=? and cir_code=?",
                            array($case_no, $dist_code, $mcb->subdiv_code, $mcb->cir_code));

                        if ($pros->num_rows() > 0) {
                            $data['pros'] = $pros->result();
                        }
                    }
                }

            } else {
                $this->session->set_flashdata('message', 'Please check case no or service type or district.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }///////////MISC case end
        /// /////////////////////////////


        ////////////NR case start
        if ($case_type == 'NR') {
            $d = $this->dbb->query("select * from apcancel_petition_basic where case_no=? and 
                dist_code=?",
                array($case_no, $dist_code));

            if ($d->num_rows() > 0) {
                $acpb = $data['nr'] = $d->row();
                $data['district'] = $this->Department_model->fetchDistName($acpb->dist_code);
                $data['subdiv'] = $this->Department_model->fetchSubName($acpb->dist_code,
                    $acpb->subdiv_code);
                $data['circle'] = $this->Department_model->fetchCirName($acpb->dist_code,
                    $acpb->subdiv_code, $acpb->cir_code);
                $data['mouza'] = $this->utilityclass->mouza_name($acpb->dist_code,
                    $acpb->subdiv_code, $acpb->cir_code, $acpb->mouza_pargona_code);
                $data['lot'] = $this->utilityclass->lot_name($acpb->dist_code,
                    $acpb->subdiv_code, $acpb->cir_code,
                    $acpb->mouza_pargona_code, $acpb->lot_no);
                $data['vill'] = $this->utilityclass->village_name($acpb->dist_code,
                    $acpb->subdiv_code, $acpb->cir_code,
                    $acpb->mouza_pargona_code, $acpb->lot_no, $acpb->vill_townprt_code);
                $data['order_type'] = "A.P. Cancellation";

                /////////////CHECK STATUS IS PASSED/////
                if ($acpb->order_passed == 'Y') {
                    $data['nr_dag'] = null;
                    $nr_d = $this->dbb->query("select * from apcancel_dag_details where case_no=? and
                    dist_code=? and subdiv_code=? and cir_code=?",
                        array($case_no, $dist_code, $acpb->subdiv_code, $acpb->cir_code));

                    if ($nr_d->num_rows() > 0) {
                        $data['nr_dag'] = $nr_d->result();
                    }
                    $data['nr_pattadar'] = null;
                    $nr_p = $this->dbb->query("select * from apcancel_petition_pattadar where case_no=? and
                    dist_code=? and subdiv_code=? and cir_code=?",
                        array($case_no, $dist_code, $acpb->subdiv_code, $acpb->cir_code));

                    if ($nr_p->num_rows() > 0) {
                        $data['nr_pattadar'] = $nr_p->result();
                    }
                    $data['nr_petitioner'] = null;
                    $nr_pet = $this->dbb->query("select * from apcancel_petitioner where case_no=? and
                    dist_code=? and subdiv_code=? and cir_code=?",
                        array($case_no, $dist_code, $acpb->subdiv_code, $acpb->cir_code));

                    if ($nr_pet->num_rows() > 0) {
                        $data['nr_petitioner'] = $nr_pet->result();
                    }
                    $data['nr_lm_note'] = null;
                    $nr_lm = $this->dbb->query("select * from apcancel_petition_lm_note where case_no=? and
                    dist_code=? and subdiv_code=? and cir_code=?",
                        array($case_no, $dist_code, $acpb->subdiv_code, $acpb->cir_code));

                    if ($nr_lm->num_rows() > 0) {
                        $data['nr_lm_note'] = $nr_lm->result();
                    }
                    $data['nr_proceeding'] = null;
                    $nr_pro = $this->dbb->query("select * from apcancel_petition_proceeding where case_no=? and
                    dist_code=? and subdiv_code=? and cir_code=?",
                        array($case_no, $dist_code, $acpb->subdiv_code, $acpb->cir_code));

                    if ($nr_pro->num_rows() > 0) {
                        $data['nr_proceeding'] = $nr_pro->result();
                    }
                }

            } else {
                $this->session->set_flashdata('message', 'Please check case no or service type or district.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }///////////NR case end
        /// /////////////////////////////


        $data['case_type'] = $this->input->post('case_type');
        $data['_view'] = 'Department/CaseSearchResult';
        $this->load->view('layouts/main', $data);
    }
}
