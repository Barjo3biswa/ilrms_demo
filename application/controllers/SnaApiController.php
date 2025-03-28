<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SnaApiController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sna/SnaApiModel');
    }

    // Insert SNA USer Details From Dharitree
    public function postSnaUsers()
    {
        
        log_message('error', 'SnaUserCreationApiHit, posted data from dharitree'.json_encode($_POST));
        $this->db = $this->load->database('db2', TRUE);
        $unique_user_id = $_POST['unique_user_id'];
        $unique_sna_code = $_POST['unique_sna_code'];
        $dhar_user_code = $_POST['dhar_user_code'];
        $status = $_POST['status'];
        $name = $_POST['name'];
        $mobile_no = $_POST['mobile'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $transfer_type = $_POST['transferred_from_yn'];
        $dist_code = $_POST['dist_code'];
        $subdiv_code = $_POST['subdiv_code'];
        $cir_code = $_POST['cir_code'];
        $mouza_pargona_code = $_POST['mouza_pargona_code'];
        $lot_no = $_POST['lot_no'];
        $doj = $_POST['date_of_joining'];
        $created_at = date('Y-m-d H:i:s', strtotime($_POST['created_at']));
      
        if($transfer_type =='y'){
            $prev_date_of_joining = $_POST['prev_date_of_joining'];
            $prev_date_of_leaving = $_POST['prev_date_of_leaving'];
            $prev_unique_user_id = $_POST['prev_unique_user_id'];
            $prev_unique_sna_code = $_POST['prev_unique_sna_code'];
            $pre_dhar_code = $_POST['pre_dhar_code'];
            $pre_dist_code = $_POST['pre_dist_code'];
            $pre_subdiv_code = $_POST['pre_subdiv_code'];
            $pre_cir_code = $_POST['pre_cir_code'];
            $pre_mouza_pargona_code = $_POST['pre_mouza_pargona_code'];
            $pre_lot_no = $_POST['pre_lot_no'];
            $dist_name = $_POST['dist_name'];
            $subdiv_name = $_POST['subdiv_name'];
            $cir_name = $_POST['cir_name'];
        }
        
        //checking if user already exits or not
        $this->db->trans_begin();
        $checkDataExist = $this->SnaApiModel->checkIfUserExist($dist_code,$subdiv_code,$cir_code,$unique_user_id);
        if($checkDataExist->num_rows()!= 0){
            log_message('error', '#ERRDU01: Unique user exists in primary acc. table #ERRSNAUUE001');
            echo json_encode(['result' => 'N', 'msg' => 'User Alreday Exists: #ERRSNAUUE001']);
            exit;
        }
        
        if($transfer_type =='n'){
            // Insert into sna_primary_account
            $snaUserDataNewJoinee = [
                'unique_user_id'        => $unique_user_id,
                'unique_sna_code'       => $unique_sna_code,
                'dhar_user_code'        => $dhar_user_code,
                'status'                => $status,
                'name'                  => $name,
                'mobile'                => $mobile_no,
                'gender'                => $gender,
                'address'               => $address,
                'transferred_from_yn'   => $transfer_type,
                'dist_code'             => $dist_code,
                'subdiv_code'           => $subdiv_code,
                'cir_code'              => $cir_code,
                'mouza_pargona_code'    => $mouza_pargona_code,
                'lot_no'                => $lot_no,
                'date_of_joining'       => date('Y-m-d', strtotime($doj)),
                'created_at'            => date("Y-m-d H:i:s"),
                'modified_at'           => null,
            ];
            $table = 'sna_primary_account';
            $insertSnaUserDataNewJoinee = $this->SnaApiModel->snaApiInsert($this->db,$snaUserDataNewJoinee,$table);

            if ($insertSnaUserDataNewJoinee === false){
                    $this->db->trans_rollback();
                    log_message('error', '#ERRSNA001: Insert failed in sna_primary_account for new joinee');
                    echo json_encode(['result' => 'N', 'msg' => 'Some error occured, Error-Code : #ERRSNA001']);
                    exit;
                }else{
                    $this->db->trans_commit();
                    $json = [
                        'result' => 'Y',
                        'msg' => 'SNA User Created Successfully',
                    ];
                    echo json_encode($json);
                }
        }else{
            // Insert into sna_primary_account
            $snaUserData = [
                'unique_user_id'        => $unique_user_id,
                'unique_sna_code'       => $unique_sna_code,
                'dhar_user_code'        => $dhar_user_code,
                'status'                => $status,
                'name'                  => $name,
                'mobile'                => $mobile_no,
                'gender'                => $gender,
                'address'               => $address,
                'transferred_from_yn'   => $transfer_type,
                'dist_code'             => $dist_code,
                'subdiv_code'           => $subdiv_code,
                'cir_code'              => $cir_code,
                'mouza_pargona_code'    => $mouza_pargona_code,
                'lot_no'                => $lot_no,
                'date_of_joining'       => date('Y-m-d', strtotime($doj)),
                'created_at'            => date("Y-m-d H:i:s"),
                'modified_at'           => null,
            ];

            $table1 = 'sna_primary_account';
            $insertSnaUserData = $this->SnaApiModel->snaApiInsert($this->db,$snaUserData,$table1);

            if ($insertSnaUserData === false) {
                $this->db->trans_rollback();
                log_message('error', '#ERRSNA002: Insert failed in sna_primary_account for transferd employee');
                echo json_encode(['result' => 'N', 'msg' => 'Some error occured, Error-Code : #ERRSNA002']);
                exit;
            }else{
                log_message('error', '#ERRSNA0021: Insert success in sna_primary_account'.json_encode($snaUserData));
            }

            // Insert into sna_account_history
            $locationData = [ 
                'unique_user_id'        => $unique_user_id,
                'unique_sna_code'       => $unique_sna_code,
                'dist_code'             => $dist_code,
                'subdiv_code'           => $subdiv_code,
                'cir_code'              => $cir_code,
                'mouza_pargona_code'    => $mouza_pargona_code,
                'lot_no'                => $lot_no,
                'dist_name'             => $dist_name,
                'subdiv_name'           => $subdiv_name,
                'cir_name'              => $cir_name,
                'mouza_name'            => null,
                'lot_name'              => null,
                'status'                => $status,
                'prev_date_of_joining'  => $prev_date_of_joining,
                'prev_date_of_leaving'  => $prev_date_of_leaving,
                'prev_unique_user_id'   => $prev_unique_user_id,
                'pre_unique_sna_code'   => $prev_unique_sna_code,
                'pre_dhar_code'         => $pre_dhar_code,
                'prev_dist_code'        => $pre_dist_code,
                'prev_subdiv_code'      => $pre_subdiv_code,
                'prev_cir_code'         => $pre_cir_code,
                'prev_mouza_pargona_code'=> $pre_mouza_pargona_code,
                'prev_lot_no'           => $pre_lot_no,
                'created_at'            => date("Y-m-d H:i:s"),
                'modified_at'           => null,
            ];
            $table2 = 'sna_account_history';
            $insertLocationData = $this->SnaApiModel->snaApiInsert($this->db,$locationData,$table2);
            if ($insertLocationData === false) {
                $this->db->trans_rollback();
                log_message('error', '#ERRSNA003: Insertion failed in sna_account_history for transfered employee');
                echo json_encode(['result' => 'N', 'msg' => 'Some error occured, Error-Code : #ERRSNA003']);
                exit;
            } else {
                $this->db->trans_commit();
                $json = [
                    'result' => 'Y',
                    'msg' => 'SNA User Created Successfully',
                ];
                echo json_encode($json);
            }

        }
        
    }

}?>
