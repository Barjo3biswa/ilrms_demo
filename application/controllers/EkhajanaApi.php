<?php

class EkhajanaApi extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
    }

    //db switch method
    public function dbswitch_with_dist_code($dist_code){
        $CI=&get_instance();
        if($dist_code == "02"){
        $this->db=$CI->load->database('dhubri', TRUE);
        } else if($dist_code == "05"){
        $this->db=$CI->load->database('barpeta', TRUE);
        } else if($dist_code == "10"){
        $this->db=$CI->load->database('chirang', TRUE);
        } else if($dist_code == "13"){
        $this->db=$CI->load->database('bongaigaon', TRUE);
        }  else if($dist_code == "17"){
        $this->db=$CI->load->database('dibrugarh', TRUE);
        }  else if($dist_code == "15"){
        $this->db=$CI->load->database('jorhat', TRUE);
        }  else if($dist_code == "14"){
        $this->db=$CI->load->database('golaghat', TRUE);
        }  else if($dist_code == "07"){
        $this->db=$CI->load->database('kamrup', TRUE);
        }  else if($dist_code == "03"){
        $this->db=$CI->load->database('goalpara', TRUE);
        }  else if($dist_code == "18"){
        $this->db=$CI->load->database('tinsukia', TRUE);
        }  else if($dist_code == "12"){
        $this->db=$CI->load->database('lakhimpur', TRUE);
        }  else if($dist_code == "24"){
        $this->db=$CI->load->database('kamrupM', TRUE);
        }  else if($dist_code == "06"){
        $this->db=$CI->load->database('nalbari', TRUE);
        }  else if($dist_code == "11"){
        $this->db=$CI->load->database('sonitpur', TRUE);
        }  else if($dist_code == "12"){
        $this->db=$CI->load->database('lakhimpur', TRUE);
        }  else if($dist_code == "16"){
        $this->db=$CI->load->database('sibsagar', TRUE);
        }  else if($dist_code == "32"){
        $this->db=$CI->load->database('morigaon', TRUE);
        }  else if($dist_code == "33"){
        $this->db=$CI->load->database('nagaon', TRUE);
        }  else if($dist_code == "34"){
        $this->db=$CI->load->database('majuli', TRUE);
        }  else if($dist_code == "21"){
        $this->db=$CI->load->database('karimganj', TRUE);
        }  else if($dist_code == "08"){
        $this->db=$CI->load->database('darrang', TRUE);
        }  else if($dist_code == "35"){
        $this->db=$CI->load->database('biswanath', TRUE);
        }  else if($dist_code == "36"){
        $this->db=$CI->load->database('hojai', TRUE);
        }  else if($dist_code == "37"){
        $this->db=$CI->load->database('charaideo', TRUE);
        }  else if($dist_code == "25"){
        $this->db=$CI->load->database('dhemaji', TRUE);
        }  else if($dist_code == "39"){
        $this->db=$CI->load->database('bajali', TRUE);
        }
        return $this->db;
    }

    public function updateEditedArrear($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no)
    {
        $this->db = $this->dbswitch_with_dist_code($dist_code);
        $first_updated_data_query = $this->db->query("select * from ekhajana_arrear_pre_updation_transactions where dist_code='$dist_code' 
                and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' 
                and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and patta_type_code='$patta_type_code' 
                and patta_no='$patta_no'")->result();
        
        $first_updated_data = json_decode($first_updated_data_query[0]->year_wise_arrear_json);
        // echo "<pre>";
        // var_dump($first_updated_data[0]);
        // exit;
        $revenue = $first_updated_data[0]->total_revenue;
        $tax = $first_updated_data[0]->total_tax;
        $arrear = $first_updated_data[0]->total_arrear;
        $pre_arrear_id = $first_updated_data[0]->pre_arrear_id;
        $this->db->trans_begin();
        foreach($first_updated_data as $row)
        {
            $current_table = $this->db->query("select * from ekhajana_year_wise_arrear where dist_code='$dist_code' 
                        and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' 
                        and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and patta_type_code='$patta_type_code' 
                        and patta_no='$patta_no' and revenue_year ='$row->revenue_year'")->row();
         
            //UPDATING YEAR WISE ARREAR *******************************************************
            $update_array= array(
                "total_arrear"  => $row->total_arrear,
                "year_arrear"   => $row->year_arrear,
                "total_revenue" => $row->total_revenue,
                "total_tax"     => $row->total_tax,
                "year_revenue"  => $row->year_revenue,
                "year_tax"      => $row->year_tax,
            );
            $this->db->where('id', $row->id)
                    ->where('pre_arrear_id', $current_table->pre_arrear_id)
                    ->where('revenue_year', $current_table->revenue_year)
                    ->update('ekhajana_year_wise_arrear', $update_array);
            if($this->db->affected_rows() != 1){ 
                $this->db->trans_rollback();
                log_message("error", "#EKHUTRA00212, Error in update, table 'ekhajana_year_wise_arrear' with query ".json_encode($this->db->last_query()));
                echo 'Some error occured, Error-Code : #EKHUTRA00212';
            }
            echo 'Updated ekhajana_year_wise_arrear successfully for revenue year '.$current_table->revenue_year.' with revenue '.$row->year_revenue.',and tax '.$row->year_tax.' <br>';
            log_message("error", 'updated ekhajana_year_wise_arrear for revenue year '.$current_table->revenue_year.'');
        }

        // UPDATE EKHAJANA PRE AREEAR TABLE*****************************************************
        $update_pre_arrear_table_array= array(
            "arrear"    => $arrear,
            "revenue"   => $revenue,
            "tax"       => $tax,
        );
        $this->db->where('id', $pre_arrear_id)
                ->update('ekhajana_arrear_pre_updation ', $update_pre_arrear_table_array);
        if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            log_message("error", "#EKHUTRA00213, Error in update, table 'ekhajana_arrear_pre_updation ' with query ".json_encode($this->db->last_query()));
            echo 'Some error occured, Error-Code : #EKHUTRA00213';
        }
        echo 'Updated ekhajana_arrear_pre_updation successfully with arrear '.$arrear.' ,revenue '.$revenue.' , and tax '.$tax.' <br>';
        log_message("error", 'updated ekhajana_arrear_pre_updation with arrear '.$arrear.'');

        // UPDATE JAMA WASIL TABLE***************************************************************
        $jama_wasil_row = $this->db->query("select * from jama_wasil where dist_code='$dist_code' 
                and subdiv_code='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code='$mouza_pargona_code' 
                and lot_no='$lot_no' and vill_townprt_code='$vill_townprt_code' and patta_type_code='$patta_type_code' 
                and patta_no='$patta_no'")->row();

        $update_jama_wasil = array(
            "due_payment"       => 0,
            "opening_balance"   => 0,
            "pay_status"        => 'PAID',
           
        );
        $this->db->where('dist_code', $dist_code)
                ->where('subdiv_code', $subdiv_code)
                ->where('cir_code', $cir_code)
                ->where('mouza_pargona_code', $mouza_pargona_code)
                ->where('lot_no', $lot_no)
                ->where('vill_townprt_code', $vill_townprt_code)
                ->where('patta_type_code', $patta_type_code)
                ->where('patta_no', $patta_no)
                ->update('jama_wasil ', $update_jama_wasil);
        if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            log_message("error", "#EKHUTRA00214, Error in update, table 'jama_wasil ' with query ".json_encode($this->db->last_query()));
            echo 'Some error occured, Error-Code : #EKHUTRA00214';
        }
        echo 'Updated jama wasil  successfully for patta no  '.$patta_no.' <br>';
        log_message("error", 'updated jama wasil for patta no '.$patta_no.'');

        // INSERT JAMA WASIL TRANSACTION TABLE***************************************************************
        $insertJamaWasilTransaction = array(
                "jama_wasil_id"                  => $jama_wasil_row->id,
                "dist_code"                      => $dist_code,
                "subdiv_code"                    => $subdiv_code,
                "cir_code"                       => $cir_code,
                "mouza_pargona_code"             => $mouza_pargona_code,
                "lot_no"                         => $lot_no,
                "vill_townprt_code"              => $vill_townprt_code,
                "village_uuid"                   => $jama_wasil_row->village_uuid,
                "patta_type_code"                => $patta_type_code,
                "patta_no"                       => $patta_no,
                "dag_no"                         => "",
                "financial_year"                 => $jama_wasil_row->financial_year,
                "entry_year"                     => $jama_wasil_row->entry_year,
                "entry_date"                     => $jama_wasil_row->entry_date,
                "revenue"                        => $jama_wasil_row->revenue,
                "local_tax"                      => $jama_wasil_row->local_tax,
                "opening_balance"                => '0',
                "due_payment"                    => '0',
                "other_payment"                  => null,
                'last_revenue_payment_amount'    => $jama_wasil_row->last_revenue_payment_amount, 
                'last_local_tax_payment_amount'  => $jama_wasil_row->last_local_tax_payment_amount,
                "dol_year_no"                    => $jama_wasil_row->dol_year_no,
                "pdar_id"                        => null,
                "pdar_name"                      => null,
                "pdar_father_name"               => null,
                "status"                         => JAMA_WASIL_STATUS_ONLINE,
                "created_at"                     => date('Y-m-d h:i:s'),
                "modified_at"                    => date('Y-m-d h:i:s'),
                "user_code"                      => $jama_wasil_row->user_code,
                "application_no"                 => $jama_wasil_row->application_no,
                "ld_application_no"              => $jama_wasil_row->ld_application_no,
                "case_no"                        => $jama_wasil_row->case_no,
                'pay_status'                     => 'PAID',
        );
        $trans_insert = $this->db->insert('jama_wasil_transaction', $insertJamaWasilTransaction);
        if($trans_insert != 1)
        { 
            $this->db->trans_rollback();
            log_message('error', '#EKHUTRA00215 Error in inserting data into jama wasil transactions with last query'.$this->db->last_query());
            echo 'Some error occured, Error-Code : #EKHUTRA00215';
        }else{
            echo 'Inserted jama wasil transaction  successfully for patta no  '.$patta_no.' <br>';
            log_message("error", 'Inserted jama wasil transaction for patta no '.$patta_no.'');

            echo "<br> SUCCESSFULL";
           // $this->db->trans_commit();
        }
        
        
    }
}?>
