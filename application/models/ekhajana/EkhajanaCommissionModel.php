<?php
class EkhajanaCommissionModel extends CI_Model {

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

    //get Commision Details 
    public function getCommissionDetails($dist_code,$subdiv_code,$cir_code, $mouza_code){
        
        //echo $dist_code.$subdiv_code.$cir_code.$mouza_code;
        //total due payment from jama wasil 
        $sql = "select count(*) as total_patta,SUM(jw.due_payment) as total_amount from jama_wasil jw join jama_wasil_transaction jwt on 
                jw.id = jwt.jama_wasil_id where jw.dist_code = ? and jw.subdiv_code = ? 
                and jw.cir_code = ? and jw.mouza_pargona_code = ? ";
        $query = $this->db->query($sql,array($dist_code,$subdiv_code,$cir_code,$mouza_code));                
        $jama_wasil_details = $query->row(); 

        //total demand from doul
        $sql = "select count(*) as total_dag_doul,SUM(dag_revenue) as dag_revenue,SUM(dag_local_tax) as dag_local_tax 
               from current_doul_demand where dist_code = ? and subdiv_code = ? and cir_code=? and 
               mouza_pargona_code=?";
        $query = $this->db->query($sql,array($dist_code,$subdiv_code,$cir_code,$mouza_code));                
        $current_doul = $query->row(); 
        return [
            "jama_wasil_details" => $jama_wasil_details,
            "current_doul_details" => $current_doul
        ];
    }

   public function getJamaWasilDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
      $query = $this->db->select('*')
                    ->where('dist_code', $dist_code)
                    ->where('subdiv_code', $subdiv_code)
                    ->where('cir_code', $cir_code)
                    ->where('mouza_pargona_code', $mouza_pargona_code)
                    ->from('jama_wasil')
                    ->get(); 
        if($query->num_rows() != 0 ){
            return $query->result();
        }else{
            return false;
        }

   }

   public function targetWiseArrerCalc($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)
   {
      //*****dharitree DB */
      $this->dbswitch();
      $endpoint_year = '2023';

      $sql = $this->db->query("SELECT year_no FROM current_doul_demand WHERE dist_code = ? AND subdiv_code = ? AND cir_code = ? AND mouza_pargona_code = ?", array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));

      if($sql->num_rows() > 0)
      {
         $current_year = $sql->row()->year_no;
      }


      if($endpoint_year == $current_year)
      {
         return false;
      }

      $year_wise_dol_array = array(); 

      for($i=$endpoint_year; $i < $current_year; $i++)
      {
         $table_name = 'current_doul_demand_'.$i;

         $sql = $this->db->query("SELECT COUNT(*) AS cnt, SUM(dag_revenue + dag_local_tax) AS total_demand FROM $table_name WHERE dist_code = ? AND subdiv_code = ? AND cir_code = ? AND mouza_pargona_code = ?", array($dist_code, $subdiv_code,$cir_code, $mouza_pargona_code));

         if($sql->num_rows() > 0)
         {
            $year_wise_dol_array[] = (object)[
               'year_no' => $i,
               'doul_count' => $sql->row()->cnt,
               'total_doul_demand' => $sql->row()->total_demand,
            ];
         }
      }

      //******RTPS DB */
      $CI = &get_instance();

      $this->db = $CI->load->database('rtpsmb', TRUE);

      $percent_wise_arrear = array();

      foreach($year_wise_dol_array as $year_dol_arr)
      {
         $year_no = $year_dol_arr->year_no;

         $query = $this->getEkhajanCommissionDetails($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $year_no, 'P'); 
         
         $total_paid_demand = 0;

         if($query->num_rows() > 0)
         {
            $total_paid_demand = $query->row()->total_khajana;
         }
         // var_dump($total_paid_patta);
         $claimable_amount = 0;
         $claimable_decimal_amount = 0;

         $collection_percentage = round(((float)$total_paid_demand/(float)$year_dol_arr->total_doul_demand) * 100, 2);

         if($collection_percentage < 50)
         {
            //****for 30% commission */
            if($query->num_rows() > 0)
            {
               $total_khaj = $query->row();
               $claimable_decimal_amount = $total_khaj->decimal_khajana_commission;               
               $tot_khaj = (float)$total_khaj->total_khajana;
               $paid_commission = (float)$total_khaj->numeric_khajana_commission;

            }
            $percent_wise_arrear[] = (object)[
               'slab' => 'Slab-1',
               'year' => $year_no,
               'total_doul' => $year_dol_arr->doul_count,
               'total_doul_demand' => $year_dol_arr->total_doul_demand,
               'total_doul_demand_collection' => $total_paid_demand,
               'collection_percentage' => $collection_percentage,
               'eligible_commision_percentage' => 30,
               'claimable_amount' => $claimable_amount,
               'claimable_decimal_amount' => round($claimable_decimal_amount, 4),
               'total_claimable_amount' => $claimable_amount + round($claimable_decimal_amount, 4),
               'paid_commission_at_30' => $paid_commission,
            ];
         }
         elseif($collection_percentage >= 50 && (int)$collection_percentage < 75)
         {
            //****for 32% commission */
            if($query->num_rows() > 0)
            {
               $total_khaj = $query->row();

               $claimable_decimal_amount = $total_khaj->decimal_khajana_commission;
               $tot_khaj = (float)$total_khaj->total_khajana;
               $claimable_amount = $tot_khaj * 2/100;
               $paid_commission = (float)$total_khaj->numeric_khajana_commission;
            }
            
            $percent_wise_arrear[] = (object)[
               'slab' => 'Slab-2',
               'year' => $year_no,
               'total_doul' => $year_dol_arr->doul_count,
               'total_doul_demand' => $year_dol_arr->total_doul_demand,
               'total_doul_demand_collection' => $total_paid_demand,
               'collection_percentage' => $collection_percentage,
               'eligible_commision_percentage' => 32,
               'claimable_amount' => $claimable_amount,
               'claimable_decimal_amount' => round($claimable_decimal_amount, 4),
               'total_claimable_amount' => $claimable_amount + round($claimable_decimal_amount, 4),
               'paid_commission_at_30' => $paid_commission,
            ];
         }
         elseif($collection_percentage >= 75 && $collection_percentage < 90)
         {
            //****for 33% commission */
            if($query->num_rows() > 0)
            {
               $total_khaj = $query->row();

               $claimable_decimal_amount = $total_khaj->decimal_khajana_commission;
               $tot_khaj = (float)$total_khaj->total_khajana;
               $claimable_amount = $tot_khaj * 3/100;
               $paid_commission = (float)$total_khaj->numeric_khajana_commission;

            }
            $percent_wise_arrear[] = (object)[
               'slab' => 'Slab-3',
               'year' => $year_no,
               'total_doul' => $year_dol_arr->doul_count,
               'total_doul_demand' => $year_dol_arr->total_doul_demand,
               'total_doul_demand_collection' => $total_paid_demand,
               'collection_percentage' => $collection_percentage,
               'eligible_commision_percentage' => 33,
               'claimable_amount' => $claimable_amount,
               'claimable_decimal_amount' => round($claimable_decimal_amount, 4),
               'total_claimable_amount' => $claimable_amount + round($claimable_decimal_amount, 4),
               'paid_commission_at_30' => $paid_commission,

            ];
         }
         elseif($collection_percentage >= 90 && $collection_percentage < 100)
         {
            //****for 34% commission */
            if($query->num_rows() > 0)
            {
               $total_khaj = $query->row();

               $claimable_decimal_amount = $total_khaj->decimal_khajana_commission;
               $tot_khaj = (float)$total_khaj->total_khajana;
               $claimable_amount = $tot_khaj * 4/100;
               $paid_commission = (float)$total_khaj->numeric_khajana_commission;
               
            }
            $percent_wise_arrear[] = (object)[
               'slab' => 'Slab-4',
               'year' => $year_no,
               'total_doul' => $year_dol_arr->doul_count,
               'total_doul_demand' => $year_dol_arr->total_doul_demand,
               'total_doul_demand_collection' => $total_paid_demand,
               'collection_percentage' => $collection_percentage,
               'eligible_commision_percentage' => 34,
               'claimable_amount' => $claimable_amount,
               'claimable_decimal_amount' => round($claimable_decimal_amount, 4),
               'total_claimable_amount' => $claimable_amount + round($claimable_decimal_amount, 4),
               'paid_commission_at_30' => $paid_commission,

            ];
         }
         elseif($collection_percentage == 100)
         {
            //****for 35% commission */
            if($query->num_rows() > 0)
            {
               $total_khaj = $query->row();

               $claimable_decimal_amount = $total_khaj->decimal_khajana_commission;
               $tot_khaj = (float)$total_khaj->total_khajana;
               $claimable_amount = $tot_khaj * 5/100;
               $paid_commission = (float)$total_khaj->numeric_khajana_commission;

            }
            $percent_wise_arrear[] = (object)[
               'slab' => 'Slab-5',
               'year' => $year_no,
               'total_doul' => $year_dol_arr->doul_count,
               'total_doul_demand' => $year_dol_arr->total_doul_demand,
               'total_doul_demand_collection' => $total_paid_demand,
               'collection_percentage' => $collection_percentage,
               'eligible_commision_percentage' => 35,
               'claimable_amount' => $claimable_amount,
               'claimable_decimal_amount' => round($claimable_decimal_amount, 4),
               'total_claimable_amount' => $claimable_amount + round($claimable_decimal_amount, 4),
               'paid_commission_at_30' => $paid_commission,

            ];
         }
   
      }
      return $percent_wise_arrear;
   }


   public function getEkhajanCommissionDetails($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $year_no, $status){
      $query = $this->db->query("SELECT SUM(total_khajana) AS total_khajana, SUM(patta_commission) AS numeric_khajana_commission, SUM(decimal_bal_amount) AS decimal_khajana_commission FROM ekhajana_commission_details WHERE dist_code = ? AND subdiv_code = ? AND cir_code = ? AND mouza_pargona_code = ? AND doul_year_no = ? AND status = ?", array((string)$dist_code, (string)$subdiv_code, (string)$cir_code, (string)$mouza_pargona_code, (string)$year_no, (string)$status));
      return $query;
   }

   public function getCommissionData($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)
   {
      $CI = &get_instance();
      $this->db = $CI->load->database('rtpsmb', TRUE);
      $query = $this->db->select('*')
               ->where('dist_code', $dist_code)
               ->where('subdiv_code', $subdiv_code)
               ->where('cir_code', $cir_code)
               ->where('mouza_pargona_code', $mouza_pargona_code)
               ->from('ekhajana_commission_details')
               ->get();
         if($query->num_rows() != 0 ){
         return $query->result();
         }else{
         return false;
         }
   }

   public function getVillages($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)
   {
      $CI = &get_instance();
      $this->db = $CI->load->database('rtpsmb', TRUE);
      $query = $this->db->select('dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code')
         ->where('dist_code', $dist_code)
         ->where('subdiv_code', $subdiv_code)
         ->where('cir_code', $cir_code)
         ->where('mouza_pargona_code', $mouza_pargona_code)
         ->from('ekhajana_commission_details')
         ->get();
      if($query->num_rows() != 0 )
      {
         return $query->result();
      }
      else{
         return false;
      }
   }

}
?>
