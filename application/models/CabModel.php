<?php

class CabModel extends CI_Model
{
  public function __construct() {
    parent::__construct();
    $this->unique_user_id = $this->session->userdata('unique_user_id');
    $this->user_code = $this->session->userdata('user_code');
  }

  public function dbswitch2($dist_code)
  {
    if ($dist_code == "02") {
      $this->db = $this->load->database('dhubri', TRUE);
    } else if ($dist_code == "05") {
      $this->db = $this->load->database('barpeta', TRUE);
    } else if ($dist_code == "10") {
      $this->db = $this->load->database('chirang', TRUE);
    } else if ($dist_code == "13") {
      $this->db = $this->load->database('bongaigaon', TRUE);
    } else if ($dist_code == "17") {
      $this->db = $this->load->database('dibrugarh', TRUE);
    } else if ($dist_code == "15") {
      $this->db = $this->load->database('jorhat', TRUE);
    } else if ($dist_code == "14") {
      $this->db = $this->load->database('golaghat', TRUE);
    } else if ($dist_code == "07") {
      $this->db = $this->load->database('kamrup', TRUE);
    } else if ($dist_code == "03") {
      $this->db = $this->load->database('goalpara', TRUE);
    } else if ($dist_code == "18") {
      $this->db = $this->load->database('tinsukia', TRUE);
    } else if ($dist_code == "12") {
      $this->db = $this->load->database('lakhimpur', TRUE);
    } else if ($dist_code == "24") {
      $this->db = $this->load->database('kamrupm', TRUE);
    } else if ($dist_code == "06") {
      $this->db = $this->load->database('nalbari', TRUE);
    } else if ($dist_code == "11") {
      $this->db = $this->load->database('sonitpur', TRUE);
    } else if ($dist_code == "16") {
      $this->db = $this->load->database('sibsagar', TRUE);
    } else if ($dist_code == "32") {
      $this->db = $this->load->database('morigaon', TRUE);
    } else if ($dist_code == "33") {
      $this->db = $this->load->database('nagaon', TRUE);
    } else if ($dist_code == "34") {
      $this->db = $this->load->database('majuli', TRUE);
    } else if ($dist_code == "21") {
      $this->db = $this->load->database('karimganj', TRUE);
    } else if ($dist_code == "35") {
      $this->db = $this->load->database('biswanath', TRUE);
    } else if ($dist_code == "36") {
      $this->db = $this->load->database('hojai', TRUE);
    } else if ($dist_code == "37") {
      $this->db = $this->load->database('charaideo', TRUE);
    } else if ($dist_code == "25") {
      $this->db = $this->load->database('dhemaji', TRUE);
    } else if ($dist_code == "39") {
      $this->db = $this->load->database('bajali', TRUE);
    } else if ($dist_code == "38") {
      $this->db = $this->load->database('ssalmara', TRUE);
    } else if ($dist_code == "08") {
      $this->db = $this->load->database('darrang', TRUE);
    } else if ($dist_code == "auth") {
      $this->db = $this->load->database('auth', TRUE);
    }
    return $this->db;
  }

  public function getDeptUserDistList()
  {
    $unique_user_id = $this->unique_user_id;
    $user_dist = $this->db->query("SELECT udb.dist_code FROM depart_users du  
                                    INNER JOIN user_dist_byforcation udb ON udb.unique_user_id::int=du.id
                                    WHERE du.unique_user_id=? AND du.active_deactive=?", 
                                    array($unique_user_id, 'E'));
    return $user_dist;
  }

  public function getCabMemoListByCabId() {
    $user_code = $this->user_code;
    $memo_list = $this->db->query("SELECT * FROM cab_memo_list WHERE user_code=? AND status=?
                    GROUP BY id, cab_id", array($user_code, 0));
    return $memo_list;
  }



  public function getCasesByCabId($cab_id, $status) {
    $user_code = $this->user_code;
    $memo_list = $this->db->query("SELECT * FROM cab_memo_list WHERE user_code=? AND status=? 
                    AND cab_id=?", array($user_code, $status, $cab_id));
    return $memo_list;
  }

  public function getCabIdListFromMaster($start, $length, $order, $status)
    {
        $user_code = $this->user_code;
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
            $this->db->order_by($order, $dir);
        }

        $this->db->distinct();
        $this->db->select('cab_id, reference_no,remarks, created_at,notification_generated,notification_digital_sign_status,approved_at,dept_order_no');
        // $this->db->select('*');
        $this->db->from('cab_id_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        $this->db->where('vgr_cab', 0);
        $this->db->limit($length, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $this->db->distinct();
        $this->db->select('cab_id, reference_no,remarks, created_at,notification_generated,notification_digital_sign_status,approved_at,dept_order_no');
        // $this->db->select('*');
        $this->db->from('cab_id_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        $this->db->where('vgr_cab', 0);

        $data['total_records'] = $this->db->count_all_results();
            return $data;
        }
    }


    public function getCabIdListFromMasterOffline($start, $length, $order, $status)
    {
        $user_code = $this->user_code;
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
            $this->db->order_by($order, $dir);
        }

        $this->db->distinct();
        $this->db->select('cab_id, reference_no,remarks, created_at,notification_generated,notification_digital_sign_status,approved_at,dept_order_no');
        // $this->db->select('*');
        $this->db->from('cab_id_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        $this->db->where('offline', 'Y');
        $this->db->limit($length, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $this->db->distinct();
        $this->db->select('cab_id, reference_no,remarks, created_at,notification_generated,notification_digital_sign_status,approved_at,dept_order_no');
        // $this->db->select('*');
        $this->db->from('cab_id_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        $this->db->where('offline', 'Y');

        $data['total_records'] = $this->db->count_all_results();
            return $data;
        }
    }




  public function getCabIdListFromMasterVGR($start, $length, $order, $status)
    {
        $user_code = $this->user_code;
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
            $this->db->order_by($order, $dir);
        }

        $this->db->distinct();
        $this->db->select('cab_id, reference_no,remarks, created_at,notification_generated,notification_digital_sign_status,approved_at,dept_order_no');
        $this->db->from('cab_id_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        $this->db->where('vgr_cab', 1);
        $this->db->limit($length, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $this->db->distinct();
        $this->db->select('cab_id, reference_no,remarks, created_at,notification_generated,notification_digital_sign_status,approved_at,dept_order_no');
        $this->db->from('cab_id_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        $this->db->where('vgr_cab', 1);
        $data['total_records'] = $this->db->count_all_results();
            return $data;
        }
    }

    public function getCabIdListFromMasterNC($start, $length, $order, $status)
    {
        $user_code = $this->user_code;
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
            $this->db->order_by($order, $dir);
        }

        $this->db->distinct();
        $this->db->select('cab_id, reference_no,remarks, created_at,notification_generated,notification_digital_sign_status,approved_at,dept_order_no');
        // $this->db->select('*');
        $this->db->from('cab_id_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        $this->db->where('nc', 'Y');
        $this->db->limit($length, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['data_results'] = $query->result();
        $this->db->distinct();
        $this->db->select('cab_id, reference_no,remarks, created_at,notification_generated,notification_digital_sign_status,approved_at,dept_order_no');
        // $this->db->select('*');
        $this->db->from('cab_id_list');
        $this->db->where('user_code', $user_code);
        $this->db->where('status', $status);
        $this->db->where('nc', 'Y');

        $data['total_records'] = $this->db->count_all_results();
            return $data;
        }
    }
}
