<?php
class CpmsModel extends CI_Model {

   public function dbswitch($dist_code) {
      if($dist_code == "02"){
          $this->db=$this->load->database('dhubri', TRUE);
      } else if($dist_code == "05"){
          $this->db=$this->load->database('barpeta', TRUE);
      } else if($dist_code == "10"){
          $this->db=$this->load->database('chirang', TRUE);
      } else if($dist_code == "13"){
          $this->db=$this->load->database('bongaigaon', TRUE);
      } else if($dist_code == "17"){
          $this->db=$this->load->database('dibrugarh', TRUE);
      } else if($dist_code == "15"){
          $this->db=$this->load->database('jorhat', TRUE);
      } else if($dist_code == "14"){
          $this->db=$this->load->database('golaghat', TRUE);
      } else if($dist_code == "07"){
          $this->db=$this->load->database('kamrup', TRUE);
      } else if($dist_code == "03"){
          $this->db=$this->load->database('goalpara', TRUE);
      } else if($dist_code == "18"){
          $this->db=$this->load->database('tinsukia', TRUE);
      } else if($dist_code == "12"){
          $this->db=$this->load->database('lakhimpur', TRUE);
      } else if($dist_code == "24"){
          $this->db=$this->load->database('kamrupm', TRUE);
      } else if($dist_code == "06"){
          $this->db=$this->load->database('nalbari', TRUE);
      } else if($dist_code == "11"){
          $this->db=$this->load->database('sonitpur', TRUE);
      } else if($dist_code == "16"){
          $this->db=$this->load->database('sibsagar', TRUE);
      } else if($dist_code == "32"){
          $this->db=$this->load->database('morigaon', TRUE);
      } else if($dist_code == "33"){
          $this->db=$this->load->database('nagaon', TRUE);
      } else if($dist_code == "34"){
          $this->db=$this->load->database('majuli', TRUE);
      } else if($dist_code == "21"){
          $this->db=$this->load->database('karimganj', TRUE);
      } else if($dist_code == "35"){
          $this->db=$this->load->database('biswanath', TRUE);
      } else if($dist_code == "36"){
          $this->db=$this->load->database('hojai', TRUE);
      } else if($dist_code == "37"){
          $this->db=$this->load->database('charaideo', TRUE);
      } else if($dist_code == "25"){
          $this->db=$this->load->database('dhemaji', TRUE);
      } else if($dist_code == "39"){
          $this->db=$this->load->database('bajali', TRUE);
      } else if($dist_code == "38"){
          $this->db=$this->load->database('ssalmara', TRUE);
      } else if($dist_code == "08"){
          $this->db=$this->load->database('darrang', TRUE);
      } else if($dist_code == "auth"){
          $this->db=$this->load->database('auth', TRUE);
      }
      return $this->db;
    }  

    //getting consult name
    public function getConsultantCode($dist_code){
        $query = $this->db->query("select user_code from loginuser_table lt where dist_code=? and
        dis_enb_option='E' and user_code like 'DCN%'",array($dist_code));
        return $query->row()->user_code;
    }

    //getting consultant name
    public function getConsultantDetails($consultant_code){
        $query = $this->db->query("select u.username as uname, u.phone_no from users u join loginuser_table l on l.user_code=u.user_code where l.dis_enb_option='E'
        and l.user_code=?",array($consultant_code));
        return $query->row();
    }

    //getting consultant results 
    public function getConsultantResult($consultant_code,$year){
        $query = $this->db->query("select * from cpms_result where user_code=? and year=?"
        ,array($consultant_code,$year));
        $row = $query->row();
        return $row;
    }

    public function checkDataExists($dist_code,$year) {
        $query = $this->db->query("select count(*) from loginuser_table lt where dist_code=? and
        dis_enb_option='E' and user_code like 'DCN%'",array($dist_code));
        $consultant_code_count = $query->row()->count;
        if($consultant_code_count == 0){
            return "data_not_exists";
        }
        $consultant_code = $this->getConsultantCode($dist_code);
        $query = $this->db->query("select count(*) from cpms_proceedings where consultant_uesr_code=? and year=?"
        ,array($consultant_code,$year));
        $cpms_proceedings_count = $query->row()->count;
        if($cpms_proceedings_count == 0){
            return "data_not_exists";
        }
        $query = $this->db->query("select status from cpms_proceedings where consultant_uesr_code=? and year=?"
        ,array($consultant_code,$year));
        $cpms_proceedings_status = $query->row()->status;
        if($cpms_proceedings_status != 'C'){
            return "data_not_exists";
        }
        $query = $this->db->query("select count(*) from cpms_result where user_code=? and year=?"
        ,array($consultant_code,$year));
        $cpms_result_count = $query->row()->count;
        if($cpms_result_count == 0){
            return "data_not_exists";
        }
        return "data_exists";
    }

    //getting cpms report
    public function getCpmsReport(){
        $CI = &get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $distList = "select district_code,district_name from district_details where district_code!='00' and online='0'";
		$dist_list = $this->db->query($distList)->result();
        $cpms_report_data = array();
        foreach ($dist_list as $dist) {
            if(CPMS_ENV == "LOCAL"){
                $dist_code = '07';
            }else{
                $dist_code = $dist->district_code;
            }
            $this->dbswitch($dist_code);
            //getting consultant name
            $year = date('Y');
            $check_data_esists = $this->checkDataExists($dist_code,$year);
            if($check_data_esists == 'data_not_exists'){
                array_push($cpms_report_data,[
                    'data_exists' => false,
                    'district_name' => $dist->district_name,
                    'consultant_name' => "NOT-UPDATED",
                    'consultant_contact_no' => "NOT-UPDATED",
                    'overall_percentage' => "NOT-UPDATED",
                    'grade' =>  "NOT-UPDATED",
                    'result' => "NOT-UPDATED",
                    'revised_salary' => "NOT-UPDATED",
                    'updated_date_time' => "NOT-UPDATED"
                ]);
                continue;
            }
            $consultant_code = $this->getConsultantCode($dist_code);
            $consultant_details = $this->getConsultantDetails($consultant_code);
            $cpms_results = $this->getConsultantResult($consultant_code, $year);
            //return $cpms_results;
            array_push($cpms_report_data,[
                'data_exists' => true,
                'district_name' => $dist->district_name,
                'consultant_name' => $consultant_details->uname,
                'consultant_contact_no' => $consultant_details->phone_no,
                'overall_percentage' => $cpms_results->overall_percentage,
                'grade' =>  $cpms_results->grade,
                'result' => $cpms_results->action,
                'revised_salary' => $cpms_results->reveised_salary,
                'updated_date_time' => date('F d, Y h:i:s A', strtotime($cpms_results->created_at))
            ]);
        }
        return $cpms_report_data;
    }
}
?>