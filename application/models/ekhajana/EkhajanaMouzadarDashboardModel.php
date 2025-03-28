<?php
class EkhajanaMouzadarDashboardModel extends CI_Model {

    //db switch
    public function dbswitch(){       
        $CI=&get_instance();
        if($this->session->userdata('dist_code') == "02"){
        $this->db=$CI->load->database('dhubri', TRUE);    
        } else if($this->session->userdata('dist_code') == "05"){
        $this->db=$CI->load->database('barpeta', TRUE);    
        } else if($this->session->userdata('dist_code') == "10"){
        $this->db=$CI->load->database('chirang', TRUE);       
        } else if($this->session->userdata('dist_code') == "13"){
        $this->db=$CI->load->database('bongaigaon', TRUE);    
        }  else if($this->session->userdata('dist_code') == "17"){
        $this->db=$CI->load->database('dibrugarh', TRUE);    
        }  else if($this->session->userdata('dist_code') == "15"){
        $this->db=$CI->load->database('jorhat', TRUE);    
        }  else if($this->session->userdata('dist_code') == "14"){
        $this->db=$CI->load->database('golaghat', TRUE);    
        }  else if($this->session->userdata('dist_code') == "07"){
        $this->db=$CI->load->database('kamrup', TRUE);    
        }  else if($this->session->userdata('dist_code') == "03"){
        $this->db=$CI->load->database('goalpara', TRUE);    
        }  else if($this->session->userdata('dist_code') == "18"){
        $this->db=$CI->load->database('tinsukia', TRUE);    
        }  else if($this->session->userdata('dist_code') == "12"){
        $this->db=$CI->load->database('lakhimpur', TRUE);   
        }  else if($this->session->userdata('dist_code') == "24"){
        $this->db=$CI->load->database('kamrupM', TRUE);   
        }  else if($this->session->userdata('dist_code') == "06"){
        $this->db=$CI->load->database('nalbari', TRUE);   
        }  else if($this->session->userdata('dist_code') == "11"){
        $this->db=$CI->load->database('sonitpur', TRUE);   
        }  else if($this->session->userdata('dist_code') == "12"){
        $this->db=$CI->load->database('lakhimpur', TRUE);   
        }  else if($this->session->userdata('dist_code') == "16"){
        $this->db=$CI->load->database('sibsagar', TRUE);   
        }  else if($this->session->userdata('dist_code') == "32"){
        $this->db=$CI->load->database('morigaon', TRUE);   
        }  else if($this->session->userdata('dist_code') == "33"){
        $this->db=$CI->load->database('nagaon', TRUE);   
        }  else if($this->session->userdata('dist_code') == "34"){
        $this->db=$CI->load->database('majuli', TRUE);   
        }  else if($this->session->userdata('dist_code') == "21"){
        $this->db=$CI->load->database('karimganj', TRUE);   
        }  else if($this->session->userdata('dist_code') == "08"){
        $this->db=$CI->load->database('darrang', TRUE);   
        }  else if($this->session->userdata('dist_code') == "35"){
        $this->db=$CI->load->database('biswanath', TRUE);   
        }  else if($this->session->userdata('dist_code') == "36"){
        $this->db=$CI->load->database('hojai', TRUE);   
        }  else if($this->session->userdata('dist_code') == "37"){
        $this->db=$CI->load->database('charaideo', TRUE);   
        }  else if($this->session->userdata('dist_code') == "25"){
        $this->db=$CI->load->database('dhemaji', TRUE);   
        }                                                                                                                                                                                                              
    }

    public function dbswitch_second($dist_code) {
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
    
    
      //creating str for where in condition 
   
      public function getTehsildariDistCodesForSql(){
        $tehsildari_dist_codes_arr= json_decode(EKHAJANA_TEHSILDARI_SYSTEM_DIST_CODES);
        $tehsildari_dist_codes_arr_with_str = array();
        foreach($tehsildari_dist_codes_arr as $tehsildari_dist_code){
            array_push($tehsildari_dist_codes_arr_with_str, "'".$tehsildari_dist_code."'");            
        }
        $tehsildari_dist_codes_str = implode(',', $tehsildari_dist_codes_arr_with_str);
        return $tehsildari_dist_codes_str;
    }

    //creating str for where in condition
    public function getMouzadariVillageUuidsForSql(){
        $mouzadari_village_uuid_arr = json_decode(EKHAJANA_TEHSILDARI_MIXED_VILLAGE_CODES);
        $mouzadari_village_uuid_arr_with_str = array();
        foreach($mouzadari_village_uuid_arr as $mouzadari_village_uuid){
            array_push($mouzadari_village_uuid_arr_with_str, "'".$mouzadari_village_uuid."'");
        }
        $mouzadari_village_uuid_with_str = implode(',', $mouzadari_village_uuid_arr_with_str);
        return $mouzadari_village_uuid_with_str;
    }

    //getting total application details for mouzadari systems 
    public function getMouzadariArearsTotalApplicationInfo(){
        $CI = &get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        //total applications
        $sql = "select (select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and el.status!='RE_P' and 
                el.dist_code not in (".$this->getTehsildariDistCodesForSql().")) + (select count(*) as c from ekhajana_land_details 
                as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                and el.status!='RE_P' and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")) as total_count";
        $total_appliation = $this->db->query($sql)->row()->total_count;
        //total pending appliations
        $sql = "select (select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                el.dist_code not in (".$this->getTehsildariDistCodesForSql().") and el.status not in ('R','F','RE_P') ) + (select count(*) as c from ekhajana_land_details 
                as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().") and el.status not in ('R','F','RE_P') ) as total_count";
        $total_pending_appliation = $this->db->query($sql)->row()->total_count;
        //total delivered applications
        $sql = "select (select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and  
                el.dist_code not in (".$this->getTehsildariDistCodesForSql().") and el.status in ('F') ) + (select count(*) as c from ekhajana_land_details 
                as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().") and el.status in ('F') ) as total_count";
        $total_delivered_appliation = $this->db->query($sql)->row()->total_count;
        //total rejecetd applications
        $sql = "select (select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                el.dist_code not in (".$this->getTehsildariDistCodesForSql().") and el.status='R') + (select count(*) as c from ekhajana_land_details 
                as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().") and el.status='R') as total_count";
        $total_rejected_appliation = $this->db->query($sql)->row()->total_count;
        return [
            'total_applications'=>$total_appliation, 
            'total_pending_applications'=> $total_pending_appliation,
            'total_delivered_applications'=> $total_delivered_appliation,
            'total_rejected_applications'=> $total_rejected_appliation,
        ];
    }

    //getting district wise application details
    public function getMouzadariArearsDistrictWiseApplicationInfo(){        
        $CI = &get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $district_details = $this->db->query('select * from district_details')->result();
        $district_wise_details = array();
        foreach($district_details as $district_detail){
            //skinpping tehsildari districts
            if($district_detail->district_code == '03' || $district_detail->district_code == '21'
               || $district_detail->district_code == '13' || $district_detail->district_code == '38'){
                continue;
            } 
            //if district is not dhuburi 
            if($district_detail->district_code != '02'){
                //total applications
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and el.status!='RE_P' and 
                el.dist_code ='$district_detail->district_code'";
                $total_appliation = $this->db->query($sql)->row()->c;                
                //total delivered applications
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and  
                        el.dist_code ='$district_detail->district_code' and el.status in ('F')";
                $total_delivered_appliation = $this->db->query($sql)->row()->c;
                //total rejecetd applications
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                        el.dist_code ='$district_detail->district_code' and el.status='R'";
                $total_rejected_appliation = $this->db->query($sql)->row()->c;
                //pending with mouzadar 
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                        el.dist_code ='$district_detail->district_code' and el.status in ('P', 'MLM_F')";
                $total_pending_with_mouzadar_appliation = $this->db->query($sql)->row()->c;
                //pending with lm 
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                        el.dist_code ='$district_detail->district_code' and el.status in ('P', 'MOU_F')";
                $total_pending_with_lm_appliation = $this->db->query($sql)->row()->c;
                //pending with CO 
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                        el.dist_code ='$district_detail->district_code' and el.status in ('COM_F')";
                $total_pending_with_co_appliation = $this->db->query($sql)->row()->c;
                array_push($district_wise_details, [
                    'district_code' => $district_detail->district_code,
                    'district_name' => explode("(",$district_detail->district_name)[0],
                    'total_applications' => $total_appliation, 
                    'total_delivered_applications' => $total_delivered_appliation,
                    'total_rejected_appliation' => $total_rejected_appliation, 
                    'pending_with_mouzadar' => $total_pending_with_mouzadar_appliation,
                    'pending_with_lm' => $total_pending_with_lm_appliation,
                    'pending_with_co' => $total_pending_with_co_appliation
                ]);
            }else{
                //for dhuburi district
                //total applications
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.status!='RE_P' and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02'";
                $total_appliation = $this->db->query($sql)->row()->c;  
                //total delivered applications
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.status in ('F')";
                $total_delivered_appliation = $this->db->query($sql)->row()->c;
                //total rejecetd applications
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.status='R'";
                $total_rejected_appliation = $this->db->query($sql)->row()->c;
                //pending with mouzadar 
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.status in ('P', 'MLM_F')";
                $total_pending_with_mouzadar_appliation = $this->db->query($sql)->row()->c;
                //pending with lm 
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.status in ('P', 'MOU_F')";
                $total_pending_with_lm_appliation = $this->db->query($sql)->row()->c;
                //pending with CO 
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.status in ('COM_F')";
                $total_pending_with_co_appliation = $this->db->query($sql)->row()->c;
                array_push($district_wise_details, [
                    'district_code' => $district_detail->district_code,
                    'district_name' => explode("(",$district_detail->district_name)[0],
                    'total_applications' => $total_appliation,
                    'total_delivered_applications' => $total_delivered_appliation,
                    'total_rejected_appliation' => $total_rejected_appliation, 
                    'pending_with_mouzadar' => $total_pending_with_mouzadar_appliation,
                    'pending_with_lm' => $total_pending_with_lm_appliation,
                    'pending_with_co' => $total_pending_with_co_appliation
                ]);
            }
            
        }
        return $district_wise_details;
    }

    public function getMouzadariArearsCircletWiseApplicationInfo($dist_code){
        $this->db=$this->dbswitch_second($dist_code);

        if($dist_code == '02'){
            $circle_list_all = $this->db->query("select distinct(dist_code,subdiv_code,cir_code) from location 
                                             where dist_code='$dist_code' and uuid in 
                                            (".$this->getMouzadariVillageUuidsForSql().")", array($dist_code, '00', '00','00'))->result_array(); 
            $circle_list_with_details = array();
            foreach($circle_list_all as $circle){
                $str = $circle['row'];
                $x = explode(",",$str);
                $dist_code = explode("(",$x[0])[1];
                $subdiv_code= $x[1];
                $cir_code = explode(")",$x[2])[0];
                //return $dist_code.$subdiv_code.$cir_code;
                $circle_details = $this->db->query("select dist_code,subdiv_code,cir_code,loc_name from location where dist_code=? and subdiv_code=? and cir_code=?
                                    and mouza_pargona_code=?", array($dist_code, $subdiv_code, $cir_code,'00'))->row(); 
                array_push($circle_list_with_details, $circle_details);
            }
            $circle_list = $circle_list_with_details;
        }else{
            $circle_list = $this->db->query("select dist_code,subdiv_code,cir_code,loc_name from location where dist_code=? and subdiv_code!=? and cir_code!=?
                                    and mouza_pargona_code=?", array($dist_code, '00', '00','00'))->result();    
        }
        $circle_wise_info = array();
        $CI = &get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        foreach($circle_list as $circle_detail){
            if($circle_detail->dist_code != '02'){
                //total applications
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and el.status!='RE_P' and 
                el.dist_code ='$circle_detail->dist_code' and el.subdiv_code='$circle_detail->subdiv_code' and el.cir_code='$circle_detail->cir_code'";
                $total_appliation = $this->db->query($sql)->row()->c;                
                //total delivered applications
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and  
                        el.dist_code ='$circle_detail->dist_code' and el.subdiv_code='$circle_detail->subdiv_code' and el.cir_code='$circle_detail->cir_code' and el.status in ('F')";
                $total_delivered_appliation = $this->db->query($sql)->row()->c;
                //total rejecetd applications
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                        el.dist_code ='$circle_detail->dist_code' and el.subdiv_code='$circle_detail->subdiv_code' and el.cir_code='$circle_detail->cir_code' and el.status='R'";
                $total_rejected_appliation = $this->db->query($sql)->row()->c;
                //pending with mouzadar 
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                        el.dist_code ='$circle_detail->dist_code' and el.subdiv_code='$circle_detail->subdiv_code' and el.cir_code='$circle_detail->cir_code' and el.status in ('P', 'MLM_F')";
                $total_pending_with_mouzadar_appliation = $this->db->query($sql)->row()->c;
                //pending with lm 
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                        el.dist_code ='$circle_detail->dist_code' and el.subdiv_code='$circle_detail->subdiv_code' and el.cir_code='$circle_detail->cir_code' and el.status in ('P', 'MOU_F')";
                $total_pending_with_lm_appliation = $this->db->query($sql)->row()->c;
                //pending with CO 
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                        el.dist_code ='$circle_detail->dist_code' and el.subdiv_code='$circle_detail->subdiv_code' and el.cir_code='$circle_detail->cir_code' and el.status in ('COM_F')";
                $total_pending_with_co_appliation = $this->db->query($sql)->row()->c;
                array_push($circle_wise_info, [
                    'dist_code' => $circle_detail->dist_code,
                    'subdiv_code' => $circle_detail->subdiv_code,
                    'cir_code' => $circle_detail->cir_code,
                    'cir_name' => $circle_detail->loc_name,
                    'total_applications' => $total_appliation, 
                    'total_delivered_applications' => $total_delivered_appliation,
                    'total_rejected_appliation' => $total_rejected_appliation, 
                    'pending_with_mouzadar' => $total_pending_with_mouzadar_appliation,
                    'pending_with_lm' => $total_pending_with_lm_appliation,
                    'pending_with_co' => $total_pending_with_co_appliation
                ]);
            }else{
                //for dhuburi district
                //total applications
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.status!='RE_P' and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.subdiv_code='$circle_detail->subdiv_code' and el.cir_code='$circle_detail->cir_code'";
                $total_appliation = $this->db->query($sql)->row()->c;  
                //total delivered applications
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.subdiv_code='$circle_detail->subdiv_code' and el.cir_code='$circle_detail->cir_code' and el.status in ('F')";
                $total_delivered_appliation = $this->db->query($sql)->row()->c;
                //total rejecetd applications
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.subdiv_code='$circle_detail->subdiv_code' and el.cir_code='$circle_detail->cir_code' and el.status='R'";
                $total_rejected_appliation = $this->db->query($sql)->row()->c;
                //pending with mouzadar 
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.subdiv_code='$circle_detail->subdiv_code' and el.cir_code='$circle_detail->cir_code' and el.status in ('P', 'MLM_F')";
                $total_pending_with_mouzadar_appliation = $this->db->query($sql)->row()->c;
                //pending with lm 
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.subdiv_code='$circle_detail->subdiv_code' and el.cir_code='$circle_detail->cir_code' and el.status in ('P', 'MOU_F')";
                $total_pending_with_lm_appliation = $this->db->query($sql)->row()->c;
                //pending with CO 
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.subdiv_code='$circle_detail->subdiv_code' and el.cir_code='$circle_detail->cir_code' and el.status in ('COM_F')";
                $total_pending_with_co_appliation = $this->db->query($sql)->row()->c;
                array_push($circle_wise_info, [
                    'dist_code' => $circle_detail->dist_code,
                    'subdiv_code' => $circle_detail->subdiv_code,
                    'cir_code' => $circle_detail->cir_code,
                    'cir_name' => $circle_detail->loc_name,
                    'total_applications' => $total_appliation, 
                    'total_delivered_applications' => $total_delivered_appliation,
                    'total_rejected_appliation' => $total_rejected_appliation, 
                    'pending_with_mouzadar' => $total_pending_with_mouzadar_appliation,
                    'pending_with_lm' => $total_pending_with_lm_appliation,
                    'pending_with_co' => $total_pending_with_co_appliation
                ]);
            }
        }
        return $circle_wise_info;
    }

    public function getMouzadariArearsMouzatWiseApplicationInfo($dist_code, $subdiv_code, $cir_code){
        $this->db=$this->dbswitch_second($dist_code);
        if($dist_code == '02'){
            $mouza_list_all = $this->db->query("select distinct(dist_code,subdiv_code,cir_code,mouza_pargona_code) from location 
                                             where dist_code='$dist_code' and subdiv_code='$subdiv_code' and cir_code='$cir_code'and uuid in 
                                            (".$this->getMouzadariVillageUuidsForSql().")", array($dist_code, '00', '00','00'))->result_array(); 
            $mouza_list_with_details = array();
            foreach($mouza_list_all as $mouza){
                $str = $mouza['row'];
                $x = explode(",",$str);
                $dist_code = explode("(",$x[0])[1];
                $subdiv_code= $x[1];
                $cir_code= $x[2];
                $mouza_pargona_code = explode(")",$x[3])[0];
                $mouza_details = $this->db->query("select dist_code,subdiv_code,cir_code,mouza_pargona_code,loc_name from location where dist_code=? and subdiv_code=? and cir_code=?
                                    and mouza_pargona_code=? and lot_no=?", array($dist_code, $subdiv_code, $cir_code,$mouza_pargona_code,'00'))->row(); 
                array_push($mouza_list_with_details, $mouza_details);
            }
            $mouza_list = $mouza_list_with_details;
        }else{
            $mouza_list = $this->db->query("select dist_code,subdiv_code,cir_code,mouza_pargona_code,loc_name from location where dist_code=? and subdiv_code!=? and cir_code!=?
                                    and mouza_pargona_code!=? and lot_no=?", array($dist_code, '00', '00','00','00'))->result();
        }
        
        $mouza_wise_info = array();
        $CI = &get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        foreach($mouza_list as $mouza_detail){
            if($mouza_detail->dist_code != '02'){
                //total applications
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and el.status!='RE_P' and 
                el.dist_code ='$mouza_detail->dist_code' and el.subdiv_code='$mouza_detail->subdiv_code' and el.mouza_pargona_code ='$mouza_detail->mouza_pargona_code' and el.cir_code='$mouza_detail->cir_code'";
                $total_appliation = $this->db->query($sql)->row()->c;                
                //total delivered applications
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and  
                        el.dist_code ='$mouza_detail->dist_code' and el.subdiv_code='$mouza_detail->subdiv_code' and el.mouza_pargona_code ='$mouza_detail->mouza_pargona_code' and el.cir_code='$mouza_detail->cir_code' and el.status in ('F')";
                $total_delivered_appliation = $this->db->query($sql)->row()->c;
                //total rejecetd applications
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                        el.dist_code ='$mouza_detail->dist_code' and el.subdiv_code='$mouza_detail->subdiv_code' and el.mouza_pargona_code ='$mouza_detail->mouza_pargona_code' and el.cir_code='$mouza_detail->cir_code' and el.status='R'";
                $total_rejected_appliation = $this->db->query($sql)->row()->c;
                //pending with mouzadar 
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                        el.dist_code ='$mouza_detail->dist_code' and el.subdiv_code='$mouza_detail->subdiv_code' and el.mouza_pargona_code ='$mouza_detail->mouza_pargona_code' and el.cir_code='$mouza_detail->cir_code' and el.status in ('P', 'MLM_F')";
                $total_pending_with_mouzadar_appliation = $this->db->query($sql)->row()->c;
                //pending with lm 
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                        el.dist_code ='$mouza_detail->dist_code' and el.subdiv_code='$mouza_detail->subdiv_code' and el.mouza_pargona_code ='$mouza_detail->mouza_pargona_code' and el.cir_code='$mouza_detail->cir_code' and el.status in ('P', 'MOU_F')";
                $total_pending_with_lm_appliation = $this->db->query($sql)->row()->c;
                //pending with CO 
                $sql = "select count(*) as c from ekhajana_land_details as el join ekhajana_applications 
                        as ea on el.application_no=ea.application_no and el.rtps_ref_no=ea.rtps_ref_no where 
                        ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' and 
                        el.dist_code ='$mouza_detail->dist_code' and el.subdiv_code='$mouza_detail->subdiv_code' and el.mouza_pargona_code ='$mouza_detail->mouza_pargona_code' and el.cir_code='$mouza_detail->cir_code' and el.status in ('COM_F')";
                $total_pending_with_co_appliation = $this->db->query($sql)->row()->c;
                array_push($mouza_wise_info, [
                    'dist_code' => $mouza_detail->dist_code,
                    'subdiv_code' => $mouza_detail->subdiv_code,
                    'cir_code' => $mouza_detail->cir_code,
                    'mouza_pargona_code' =>$mouza_detail->mouza_pargona_code,
                    'mouza_name' => $mouza_detail->loc_name,
                    'total_applications' => $total_appliation, 
                    'total_delivered_applications' => $total_delivered_appliation,
                    'total_rejected_appliation' => $total_rejected_appliation, 
                    'pending_with_mouzadar' => $total_pending_with_mouzadar_appliation,
                    'pending_with_lm' => $total_pending_with_lm_appliation,
                    'pending_with_co' => $total_pending_with_co_appliation
                ]);
            }else{
                //for dhuburi district
                //total applications
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.status!='RE_P' and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.subdiv_code='$mouza_detail->subdiv_code' and el.mouza_pargona_code='$mouza_detail->mouza_pargona_code' and el.cir_code='$mouza_detail->cir_code'";
                $total_appliation = $this->db->query($sql)->row()->c;  
                //total delivered applications
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.subdiv_code='$mouza_detail->subdiv_code' and el.mouza_pargona_code='$mouza_detail->mouza_pargona_code' and el.cir_code='$mouza_detail->cir_code' and el.status in ('F')";
                $total_delivered_appliation = $this->db->query($sql)->row()->c;
                //total rejecetd applications
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.subdiv_code='$mouza_detail->subdiv_code' and el.mouza_pargona_code='$mouza_detail->mouza_pargona_code' and el.cir_code='$mouza_detail->cir_code' and el.status='R'";
                $total_rejected_appliation = $this->db->query($sql)->row()->c;
                //pending with mouzadar 
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.subdiv_code='$mouza_detail->subdiv_code' and el.mouza_pargona_code='$mouza_detail->mouza_pargona_code' and el.cir_code='$mouza_detail->cir_code' and el.status in ('P', 'MLM_F')";
                $total_pending_with_mouzadar_appliation = $this->db->query($sql)->row()->c;
                //pending with lm 
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.subdiv_code='$mouza_detail->subdiv_code' and el.mouza_pargona_code='$mouza_detail->mouza_pargona_code' and el.cir_code='$mouza_detail->cir_code' and el.status in ('P', 'MOU_F')";
                $total_pending_with_lm_appliation = $this->db->query($sql)->row()->c;
                //pending with CO 
                $sql = "select count(*) as c from ekhajana_land_details 
                        as el join ekhajana_applications as ea on el.application_no=ea.application_no and 
                        el.rtps_ref_no=ea.rtps_ref_no where ea.initial_payment_status in ('N', 'C') and ea.is_draft = 'N' 
                        and el.village_uuid in (".$this->getMouzadariVillageUuidsForSql().")
                        and dist_code='02' and el.subdiv_code='$mouza_detail->subdiv_code' and el.mouza_pargona_code='$mouza_detail->mouza_pargona_code' and el.cir_code='$mouza_detail->cir_code' and el.status in ('COM_F')";
                $total_pending_with_co_appliation = $this->db->query($sql)->row()->c;
                array_push($mouza_wise_info, [
                    'dist_code' => $mouza_detail->dist_code,
                    'subdiv_code' => $mouza_detail->subdiv_code,
                    'cir_code' => $mouza_detail->cir_code,
                    'mouza_pargona_code' =>$mouza_detail->mouza_pargona_code,
                    'mouza_name' => $mouza_detail->loc_name,
                    'total_applications' => $total_appliation, 
                    'total_delivered_applications' => $total_delivered_appliation,
                    'total_rejected_appliation' => $total_rejected_appliation, 
                    'pending_with_mouzadar' => $total_pending_with_mouzadar_appliation,
                    'pending_with_lm' => $total_pending_with_lm_appliation,
                    'pending_with_co' => $total_pending_with_co_appliation
                ]);
            }
        }
        return $mouza_wise_info;
    }
}
?>