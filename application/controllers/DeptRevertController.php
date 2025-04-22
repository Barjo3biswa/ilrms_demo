<?php
class DeptRevertController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->model('mb3Cabinet/DeptRevertModel');
        $this->db2 = NULL;
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

    public function getRemarksDetailsRevertedCases()
    {
        $json  = array();
        $_POST = json_decode(file_get_contents("php://input"), true);

        $this->form_validation->set_rules('selectedList[]', 'Case Number', 'trim|required');
        $this->form_validation->set_rules('district_id', 'District ID', 'trim|required|is_natural');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 3,
                'message' => 'Validation Errors !. Check Form Data',
            ));
        } 
        else
        {
            $dist_code       = $this->input->post('district_id');
            $allSelectedList = $this->input->post('selectedList');
            $user_code       = $this->session->userdata('user_code');
            $service_code    = $this->input->post('service_code');

            $caseList = array_map(function($value) {
                return "'" . $value . "'";
            }, $allSelectedList);

            $commaSeparatedCases = implode(',', $caseList);

            $cabIdList = $this->DeptRevertModel->getAllMb3CabList($dist_code,$user_code,$service_code);

            $dbb =  $this->dbswitch2($dist_code);
            $revertedCases = $this->DeptRevertModel->getDetailsToBeRevertedCase($dbb,$commaSeparatedCases,$service_code);

            // check if assistant has verified the case, then only revert to DC is possible
            $service_Array = array(43, 45);
            if(in_array($service_code, $service_Array)) {
                $table = 'settlement_basic';
            } else {
                $table = 'reclass_suite_basic';
            }

            
            $checkForAsstVerify = $this->DeptRevertModel->checkForAsstVerification($dbb,$commaSeparatedCases,$table);
            echo json_encode(array(
                'revertedCases' => $revertedCases,
                'cabIdList'     => $cabIdList,
                'asstVerify'    => $checkForAsstVerify,
            ));
        }
    }

    public function getCabMemos() 
    {
        $user_code = $this->session->userdata('user_code');
        $dist_code = $this->input->post('district_id');
        $service_code = $this->input->post('service_code');

        if (!$user_code || !$dist_code) {
            echo json_encode(['message' => 'User code or district ID missing.']);
            return;
        }
        $cabIdList = $this->DeptMb3CabinetModel->getAllMb3CabList($dist_code,$user_code,$service_code);
        // echo $this->db->last_query(); die;

        if (empty($cabIdListTeaGrant)) {
        $response = array('message' => 'No cab memos available. Please Create Cab Memo before adding Cases');
        } else {
            $response = $cabIdListTeaGrant;
        }
        echo json_encode($response);
    }




    ///////////////Bulk Revert Cases from Department To DC////////////////
    public function bulkRevertDeptCasesToDC()
    {
      // echo "heelo"; die;

      // var_dump($_POST); die;


      // $this->form_validation->set_rules('service_code_revert[]', 'Service Code', 'trim|required');
      $this->form_validation->set_rules('revert_case_no[]', 'Case Number', 'trim|required');
      $this->form_validation->set_rules('distict_code_revert', 'District ID', 'trim|required|is_natural');
      $this->form_validation->set_rules('revert_remarks[]', 'Revert Remarks', 'required');
      $this->form_validation->set_rules('cabMemoIdRevert', 'Cab Memo Required', 'required');

      if ($this->form_validation->run() == FALSE) 
      {
        echo json_encode(array(
          'responseType' => 3,
          'message' => 'Validation Errors !. Please Enter Remarks for All Cases',
        ));
      } 
      else 
      {
        $dist_code            = $this->input->post('distict_code_revert');
        $cases_no_revert      = $this->input->post('revert_case_no');
        $input_revert_remarks = $this->input->post('revert_remarks');
        $user_code            = $this->session->userdata('user_code');
        $cab_id_revert        = $this->input->post('cabMemoIdRevert');
        $service_code         = $this->input->post('service_code');

        $casesArray = array_map(function ($a, $b) {
          return $a . '(@)' . $b ;
        }, $cases_no_revert, $input_revert_remarks);

        // var_dump($casesArray);die;

        $this->db = $this->load->database('db2', TRUE);
        $this->db2 =  $this->dbswitch2($dist_code);

        foreach($casesArray as $row)
        {
          $case_no        = strtok($row, '(@)');
          $revert_remarks = strtok('(@)');

          //Update Array for Basic
          $updateData[] = [
            'case_no'         => $case_no,
            'dept_js_approve' => 'N',
            'status'          => 'R',
            'add_off_desig'   => 'DC',
            'dept_revert'   => 1,
          ];

          $proceedingTable = $service_code == 44 ? 'petition_proceeding_dc_adc' : 'settlement_proceeding '; // 44 - conversion

          $proceeding_id = $this->db2->query("SELECT max(proceeding_id)+1 AS c FROM $proceedingTable WHERE 
                              case_no=?", array($case_no))->row()->c;

          if ($proceeding_id == null) {
            $proceeding_id = 1;
          }

          $proceeding_details = $this->db2->query("SELECT * FROM $proceedingTable WHERE case_no=? ORDER BY 
                                  proceeding_id DESC LIMIT 1", array($case_no))->row();
          
          //Insert Data in reverted_case_list_from_dept_to_dc
          $insRevertCases[] = [
            'case_no'        => $case_no,
            'cab_id'         => $cab_id_revert,
            'created_at'     => date('Y-m-d h:i:s'),
            'revert_remarks' => $revert_remarks,
            'user_code'      => $user_code,
            'dist_code'      => $dist_code,
            'status'         => 'R',
            'service_code'   => $service_code,
          ];
        }

        $insertRevertList = $this->db->insert_batch('reverted_case_list_from_dept_to_dc', $insRevertCases);
        // echo $this->db->last_query();
        // var_dump($insertRevertList);
        // die;
        if($insertRevertList <= 0)
        {
          $this->db->trans_rollback();
          log_message('error', '#ERR246: Insert Failed in  reverted_case_list_from_dept_to_dc' );
          echo json_encode(array(
            'responseType' => 3,
            'message'      => '#ERR246: Cases Not Reverted ! Kindly Contact System Admin.  !!!',
          ));
          return false;
        }
        else   
        {
          $this->db->trans_commit();
          $this->db2->trans_begin();

          // $basicTable = $service_code == '40' ? 'reclass_suite_basic' : 'settlement_basic';

          $basicTable='settlement_basic';
          if($service_code == '40'){
            $basicTable= 'reclass_suite_basic';
          }else if($service_code == '44'){
              $basicTable= 'petition_basic';
          }

          $updateBasicStatus = $this->db2->update_batch($basicTable, $updateData,'case_no');
          // var_dump($service_code);
          // die;
          if($updateBasicStatus<=0 || $this->db2->affected_rows() <= 0)
          {
            $this->db2->trans_rollback();
            echo json_encode(array(
              'responseType' => 1,
              'message' => 'Error01: Cases Not Reverted ! Kindly Contact System Admin.',
            ));
            return;
          }
          else
          {
            if($service_code == 44) // for mb3 conversion
            {
              //Insert Array for Petition Proceedings
              $insPetProceed[] = [
                'case_no'         => $case_no,
                'proceeding_id'   => $proceeding_id,
                'date_of_hearing' => date('Y-m-d h:i:s'),
                'status'          => 'Revert',
                'user_code'       => $user_code,
                'co_order'        => $proceeding_details->co_order,
                'note_on_order'   => $revert_remarks,
                'date_entry'      => date('Y-m-d h:i:s'),
                'operation'       => 'E',
                'dist_code'       => $dist_code,
                'subdiv_code'     => $proceeding_details->subdiv_code,
                'cir_code'        => $proceeding_details->cir_code,
              ];
            }
            else
            {
              //Insert Array for settlement Proceedings
              $insPetProceed[] = [
                'case_no'             => $case_no,
                'date_of_hearing'     => date('Y-m-d h:i:s'),
                'note_on_order'       => $revert_remarks,
                'status'              => 'REVERT',
                'user_code'           => $user_code,
                'date_entry'          => date('Y-m-d h:i:s'),
                'operation'           => 'E',
                'office_from'         => 'DEPT',
                'office_to'           => 'DC',
                'operation'           => 'E',
                'proceeding_id'       => $proceeding_id,
                'task'                => 'Revert to DC',
                'minutes_proposal_id' => $cab_id_revert,
              ];
            }              

            $inserProceding = $this->db2->insert_batch($proceedingTable, $insPetProceed);
            // echo $this->db2->last_query(); die;
            if($inserProceding <= 0 || $this->db2->affected_rows() <= 0)
            {
              $this->db2->trans_rollback();
              echo json_encode(array(
                'responseType' => 1,
                'message' => 'Error02: Cases Not Reverted ! Kindly Contact System Admin.',
              ));
              return;
            }else
            {
              $this->db2->trans_commit();
              echo json_encode(array(
                'responseType' => 2,
                'message' => 'Cases Reverted  to DC Successfully',

              ));
            }
          }
        }
      }
    }


}
?>