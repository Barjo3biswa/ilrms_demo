<?php
class Mb3RevertController extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->model('Juridical/DeptJuridicalModel');
        $this->load->model('Mb3RevertModel');
        $this->Mb3RevertModel = $this->Mb3RevertModel;
        $this->db =  $this->load->database('rtpsmb', TRUE);
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
        } else if ($dist_code == "22") {
            $this->db2 = $this->load->database('hailakandi', TRUE);
        } else if ($dist_code == "auth") {
            $this->db2 = $this->load->database('auth', TRUE);
        }
        return $this->db2;
    }


    public function revertPage($param = null){
        $service_code  = $param;
        // var_dump($service_code);
        // die;
        // $service_name = $this->db->query("select name from services where id = $service_code limit 1")->row()->name;
        if($service_code=='43'){//tea grant
            $service_name = "Limited Conversion of Tea grant land to periodic patta";
        }else if($service_code=='44'){//conversion
            $service_name = "AP to PP Conversion";
        }else if($service_code=='45'){//juridical 
            $service_name = "Non individual Juridical Entities";
        }else if($service_code=='40'){//reclassification suite
            $service_name = "Reclassification suite";
        }else if($service_code=='42'){//occupancy tenants
            $service_name = "Occupancy tenants";
        }
        // var_dump($service_name);
        // die;
        $dist_code     = trim($this->input->post('selectDistrict'));
        $data['user_dist']      = $this->Mb3RevertModel->getDeptUserDistListWithRevertedCaseCount($service_code);
        $data['dist_code'] = $dist_code;
        $data['service_code'] = $param;
        $data['service_name'] = $service_name;
        $data['_view'] = 'revert/mb3-revert';
        $this->load->view('layouts/main', $data);

        
    }

    public function getViewLink($service_code,$dist_code,$case_no){
        $link = '#';
        if($service_code=='43'){//tea grant
            $link = base_url() . "index.php/DeptTeaGrant/teaGrantCaseDetails/?dist_code=" . urlencode($dist_code) . "&case_no=" . urlencode($case_no);
        }else if($service_code=='44'){//conversion
            $link = base_url() . "index.php/DeptConversionNew/conversionCaseDetails/?dist_code=" . $dist_code . "&case_no=" . $case_no;
        }else if($service_code=='45'){//juridical 
            $link = base_url() . "index.php/DeptJuridical/juridicalCaseDetails/?dist_code=" . $dist_code . "&case_no=" . $case_no;
        }else if($service_code=='40'){//reclassification suite
            $link = base_url() . "index.php/DeptReclassSuite/reclassSuiteCaseDetails/?dist_code=" . $dist_code . "&case_no=" . $case_no;
        }else if($service_code=='42'){//occupancy tenants
            $link = base_url() . "index.php/DeptTenant/tenantCaseDetails/?dist_code=" . $dist_code . "&case_no=" . $case_no;
        }
        return $link;
    }

    public function getAllRevertedCasesUnderDept()
    {
        
        $json = null;
        $dist_code = $this->input->post('dist_code');
        $service_code = $this->input->post('service_code');
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');
        $searchByCol_0 = trim($this->input->post('search')['value']);


        $this->db2 =  $this->dbswitch2($dist_code);
        $cases_list = $this->Mb3RevertModel->getAllRevertedCasesUnderDepartmentAll($this->db2, $service_code,$start, $length, $order,$dist_code,$searchByCol_0);
        if (!empty($cases_list)) {

            if ($cases_list['total_records'] > 0) {

                $data_rows = $cases_list['data_results'];

                foreach ($data_rows as $row) {
                    $case_no = "<small class='case-no-bg'><i class='fa fa-archive'></i>" . $row->case_no . "</small>";
                    $application_no = $this->utilclass->getApplidFromCaseNo($dist_code, $row->case_no);
                    $revert_remarks = $this->utilclass->getRevertedRemarksByCaseNo($dist_code, $row->case_no);
                    $app_no = "<br><small class='text-danger text-center p-4'>" . $application_no  . "</small>";
                    // $service = "<small class='text-black bg-yellow'>" . $this->utilclass->getServiceName($row->service_code) . "</small>";
                    $submission_date = date('d-M-Y', strtotime($row->submission_date));
                    $reverted = "(<span class='text-danger text-center'>Reverted</span>)";
                    // $link = base_url() . "index.php/Basundhara/settlementBasu/?app=" . $application_no . "&dist_code=" . $dist_code;
                    $link = $this->getViewLink($service_code,$dist_code,$row->case_no);
                    $view_case = "<a href=" . $link . " class='btn btn-sm btn-primary' target='_blank'><i class='fa fa-eye'></i> &nbsp;View</a>";
                    $button = $view_case;
                    if($service_code == '44'){ //Conversion
                        $json[] = array(
                            $row->case_no,
                            $case_no .  $app_no . $reverted,
                            '<small class="text-primary text-center"></small>',
                            '<small>' . $revert_remarks . '</small>',
                            '<small>' . $submission_date . '</small>',
                            $button,
                        );
                    }else{
                        $json[] = array(
                            $row->case_no,
                            $case_no .  $app_no . $reverted,
                            '<small class="text-primary text-center">' . $row->pending_officer . '</small>',
                            '<small>' . $revert_remarks . '</small>',
                            '<small>' . $submission_date . '</small>',
                            $button,
                        );
                    }
                    
                }
            } else {
                $json = "";
            }
            $total_records = $cases_list['total_records'];
            $response = array(
                'recordsTotal'      => $total_records,
                'recordsFiltered'   => $total_records,
                'data'              => $json
            );
            echo json_encode($response);
        } else {
            $response = array();
            $response['sEcho'] = 0;
            $response['iTotalRecords'] = 0;
            $response['iTotalDisplayRecords'] = 0;
            $response['aaData'] = [];
            echo json_encode($response);
        }
    }
}
