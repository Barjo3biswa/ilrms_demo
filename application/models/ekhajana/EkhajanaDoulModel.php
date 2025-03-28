<?php

class EkhajanaDoulModel extends CI_Model {

    //db switch method
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



    public function generateDoulForAllMouza($dist_code,$subdiv_code,$cir_code){        
        $mouza_list_query = $this->db->query("SELECT * FROM location WHERE dist_code=? and subdiv_code=? and cir_code=? "
                . "and mouza_pargona_code != '00' and lot_no='00' and Vill_townprt_code = '00000'", 
                array($dist_code,$subdiv_code,$cir_code));
        $mouza_list = $mouza_list_query->result();        
        //financial_year
        if (date('m') <= 8) {
            $year = date('Y');
        } else {
            $year = date('Y') + 1;
        }
        $doul_details = array();
        $total_cir_patta = 0;
        $total_cir_revenue = 0;
        $total_cir_local_tax = 0;
        $total_cir_area_bigha = 0;
        $total_cir_area_katha = 0;
        $total_cir_area_lessa = 0;

        foreach($mouza_list as $mouza){
            $mouza_pargona_code = $mouza->mouza_pargona_code;
            //no of patta
            $pattaCountSql = "select count(*) from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? 
            and mouza_pargona_code=? and year_no=?";
            $pattaCountQuery = $this->db->query($pattaCountSql, array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,strval($year)));        
            $patta_count = $pattaCountQuery->row()->count;
            //area bigha,katha,lessa
            $areaSumSql = "select sum(dag_area_b) as total_bigha, sum(dag_area_k) as total_katha, sum(dag_area_lc) as total_lessa from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? 
            and mouza_pargona_code=? and year_no=?";
            $areaSumQuery = $this->db->query($areaSumSql, array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,strval($year)));        
            $total_bigha = $areaSumQuery->row()->total_bigha;
            $total_katha = $areaSumQuery->row()->total_katha;
            $total_lessa = $areaSumQuery->row()->total_lessa; 
            //revenue
            $revenueSumSql = "select sum(dag_revenue) from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? 
            and mouza_pargona_code=? and year_no=?";
            $revenueSumQuery = $this->db->query($revenueSumSql, array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,strval($year)));        
            $revenue = $revenueSumQuery->row()->sum;
            //local tax
            $localtaxSumSql = "select sum(dag_local_tax) from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? 
            and mouza_pargona_code=? and year_no=?";
            $localtaxSumQuery = $this->db->query($localtaxSumSql, array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,strval($year)));        
            $localtax = $localtaxSumQuery->row()->sum;
            //creating the array mouza wise 
            array_push($doul_details, [
                'dist_code' => $mouza->dist_code,
                'subdiv_code' => $mouza->subdiv_code,
                'cir_code' => $mouza->cir_code,
                'mouza_code' => $mouza->mouza_pargona_code,
                'mouza_Name' => $mouza->loc_name,                
                'year' => $year,
                'no_of_patta' => $patta_count,
                'total_bigha' => $total_bigha,
                'total_katha' => $total_katha,
                'total_lessa' => $total_lessa,
                'revenue' => $revenue,
                'local_tax' =>$localtax
            ]);
            //TOTAL COUNTS
            $total_cir_patta = $total_cir_patta+$patta_count;
            $total_cir_revenue = $total_cir_revenue+$revenue;
            $total_cir_local_tax = $total_cir_local_tax+$localtax;
            $total_cir_area_bigha = $total_cir_area_bigha+$total_bigha;
            $total_cir_area_katha = $total_cir_area_katha+$total_katha;
            $total_cir_area_lessa = $total_cir_area_lessa+$total_lessa;
        }
        return [
            'doul_details' => $doul_details,
            'total_cir_patta' => $total_cir_patta,
            'total_cir_revenue' => $total_cir_revenue,
            'total_cir_local_tax' => $total_cir_local_tax,
            'total_cir_area_bigha' => $total_cir_area_bigha,
            'total_cir_area_katha' => $total_cir_area_katha,
            'total_cir_area_lessa' => $total_cir_area_lessa,
        ];
    }

    public function generateDoulDataMouzaWise($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
        //getting the distinct patta types 
        $sql = "select distinct(patta_type_code) from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? 
        and mouza_pargona_code=?";
        $query = $this->db->query($sql, array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code));        
        $patta_type_codes = $query->result();
        $doul_data = array();
        $total_patta_all = 0;
        $total_bigha_all = 0;
        $total_katha_all = 0;
        $total_lessa_all = 0;
        $total_revenue_all = 0;
        $total_local_tax_all = 0;
        //calculating the fields against patta type code
        foreach($patta_type_codes as $row){
            $patta_type_code = $row->patta_type_code;
            //no of patta
            $pattaCountSql = "select count(*) from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? 
            and mouza_pargona_code=? and patta_type_code =?";
            $pattaCountQuery = $this->db->query($pattaCountSql, array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,$patta_type_code));        
            $patta_count = $pattaCountQuery->row()->count;
            //revenue
            $revenueSumSql = "select sum(dag_revenue) from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? 
            and mouza_pargona_code=? and patta_type_code =?";
            $revenueSumQuery = $this->db->query($revenueSumSql, array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,$patta_type_code));        
            $revenue = $revenueSumQuery->row()->sum;
            //local tax
            $localtaxSumSql = "select sum(dag_local_tax) from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? 
            and mouza_pargona_code=? and patta_type_code =?";
            $localtaxSumQuery = $this->db->query($localtaxSumSql, array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,$patta_type_code));        
            $localtax = $localtaxSumQuery->row()->sum;
            //area bigha,katha,lessa
            $areaSumSql = "select sum(dag_area_b) as total_bigha, sum(dag_area_k) as total_katha, sum(dag_area_lc) as total_lessa from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? 
            and mouza_pargona_code=? and patta_type_code =?";
            $areaSumQuery = $this->db->query($areaSumSql, array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,$patta_type_code));        
            $total_bigha = $areaSumQuery->row()->total_bigha;
            $total_katha = $areaSumQuery->row()->total_katha;
            $total_lessa = $areaSumQuery->row()->total_lessa; 
            //adding in the doul array
            array_push($doul_data, [
                "patta_type_code" => $patta_type_code,
                "patta_count" => $patta_count,
                "total_bigha" => $total_bigha,
                "total_katha" => $total_katha,
                "total_lessa" => $total_lessa,
                "revenue" => $revenue,
                "local_tax" => $localtax
            ]);
            $total_patta_all = $total_patta_all + $patta_count;
            $total_bigha_all = $total_bigha_all + $total_bigha;
            $total_katha_all = $total_katha_all + $total_katha;
            $total_lessa_all = $total_lessa_all + $total_lessa;
            $total_revenue_all = $total_revenue_all + $revenue;
            $total_local_tax_all = $total_local_tax_all + $localtax;
        }
        return [
                "doul_data" => $doul_data, 
                "total_patta_all" => $total_patta_all,
                "total_bigha_all" => $total_bigha_all,
                "total_katha_all" => $total_katha_all,
                "total_lessa_all" => $total_lessa_all,
                "total_revenue_all" => $total_revenue_all,
                "total_local_tax_all" => $total_local_tax_all
            ];
    }

    public function checkDoulExists_old($dist_code,$subdiv_code,$cir_code){
        
        //return  "Location Codes ". $dist_code. "-". $subdiv_code. "-". $cir_code;
        if (date('m') <= 6) {
            $year = date('Y');
        } else {
            $year = date('Y') + 1;
        }   

        $doul_query = $this->db->query("SELECT count(*) FROM current_doul_demand WHERE dist_code=? and subdiv_code=? and cir_code=? "
                . "and year_no=?", 
                array($dist_code,$subdiv_code,$cir_code, strval($year)));
        $doul_count = $doul_query->row()->count;
        
        //return $doul_count;

        if($doul_count == 0){
            return false;
        }else{
            return true;
        }
    }


    //checking whether doul exists or not 
    public function checkDoulExists($dist_code,$subdiv_code,$cir_code){
        $this->dbswitch(); 
        if (date('m') <= 6) {
            $year = date('Y');
        } else {
            $year = date('Y') + 1;
        }   

        $doul_query = $this->db->query("SELECT count(*) FROM current_doul_demand WHERE dist_code=? and subdiv_code=? and cir_code=? "
                . "and year_no=?", 
                array($dist_code,$subdiv_code,$cir_code, strval($year)));
        $doul_count = $doul_query->row()->count;
        if($doul_count == 0){
            return false;
        }else{
            $sql = "select status from current_doul_approve where dist_code=? and subdiv_code=? and cir_code=? and yeardoul='$year'";
            $query = $this->db->query($sql,array(strval($dist_code),strval($subdiv_code),strval($cir_code)));
            if($query->num_rows() != 0){
                $row = $query->row();
                if($row->status=='A'){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }

    public function getDoulYear($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)
    {
        $sql = $this->db->query("select year_no from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?",array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        if($sql->num_rows() ==0){
            return "NOT-FOUND";
        }else{
            return $sql->row()->year_no;
        }
    }

    //getting village and lot no 
    public function getVillagesJSON($distCode, $subdivcode, $circode, $mouzacode) {
    $this->dbswitch();
        $villages = $this->db->query("select *  from   location where dist_code =?  and  subdiv_code=? and cir_code=? and mouza_pargona_code=?  and lot_no!='00' and vill_townprt_code!='00000' order by vill_townprt_code",array($distCode,$subdivcode,$circode,$mouzacode));
        return $villages->result();
    }

    //getting patta types 
    public function getPattaType($dist_code) {
    $this->dbswitch($dist_code);
        $patta = $this->db->query("Select type_code,patta_type from patta_code order by type_code asc");
        return $patta->result();
    }
    
    public function getCurrentDoulPattaWise($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no)
    {
        $this->dbswitch($dist_code);
        $query = $this->db->query("select * from current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",
                array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no));
        if($query->num_rows() ==0){
            return "NO-DEMAND-FOUND";
        }else{
            return $query->row();
        }

    }

}
