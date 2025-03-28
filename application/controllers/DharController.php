<?php
class DharController extends MY_Controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('dharitree/DharModel');
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

    public function reports()
    {
         $data = array();
         $data['_view'] = 'Department/ownerinfo';
         $this->load->view('layouts/main', $data);
    }
    
    public function getCircles() {
        $distcode = $_GET['district_code'];
        $this->db2 =  $this->dbswitch2($distcode);

        $data = $this->DharModel->getCircleByDistJSON($this->db2,$distcode);
        $json = array();
        foreach ($data as $object) {
            $json[] = array('cir_name' => $object->locname_eng.'--'.$object->loc_name, 'cir_code' => $object->uuid);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }
    public function getVillages() {
        $distcode = $_GET['district_code'];
        $circode = $_GET['circle_code'];
        $this->db2 =  $this->dbswitch2($distcode);

        $data = $this->DharModel->getVillageByCircleUUIDJSON($this->db2,$distcode, $circode);
        $json = array();
        foreach ($data as $object) {
            $json[] = array('village_name' => $object->locname_eng.'--'.$object->loc_name, 'village_code' => $object->uuid);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }
    public function getDags() {
        $distcode = $_GET['district_code'];
        $villcode = $_GET['village_code'];
        $this->db2 =  $this->dbswitch2($distcode);

        $loc = $this->DharModel->getLocationByUUID($this->db2, $villcode);
        $dag_nos_int = $this->DharModel->getDagNosInt($this->db2, $distcode, $loc->subdiv_code, 
                      $loc->cir_code, $loc->mouza_pargona_code, $loc->lot_no,$loc->vill_townprt_code);
        $dag_nos_char = $this->DharModel->getDagNosChar($this->db2, $distcode, $loc->subdiv_code, 
                      $loc->cir_code, $loc->mouza_pargona_code, $loc->lot_no,$loc->vill_townprt_code);
        $dag_nos = array_merge($dag_nos_int, $dag_nos_char);
        
        echo json_encode($dag_nos, JSON_UNESCAPED_UNICODE);
    }

    public function getOwnerDetails()
    {
        $distcode = $_POST['district_code'];
        $villcode = $_POST['village_code'];
        $dag_no = $_POST['dag_no'];
        $this->db2 =  $this->dbswitch2($distcode);

        $loc = $this->DharModel->getLocationByUUID($this->db2, $villcode);
        $dag_details = $this->DharModel->getDagDetails($this->db2, $distcode, $loc->subdiv_code, 
                      $loc->cir_code, $loc->mouza_pargona_code, $loc->lot_no,$loc->vill_townprt_code, $dag_no);
        $owner_details = $this->DharModel->getOwnerDetails($this->db2, $distcode, $loc->subdiv_code, 
                      $loc->cir_code, $loc->mouza_pargona_code, $loc->lot_no,$loc->vill_townprt_code, $dag_no, 
                      $dag_details->patta_type_code, $dag_details->patta_no);
        $json = array('success'=>'y','dag_details'=>$dag_details, 'owner_details'=>$owner_details);
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }
}



