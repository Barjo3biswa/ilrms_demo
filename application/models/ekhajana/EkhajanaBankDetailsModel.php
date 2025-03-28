<?php
class EkhajanaBankDetailsModel extends CI_Model {



    public function InsertMouzadarBankDetails($mouzadar_acc_details_insert_array)
    {
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $this->db->trans_begin();
        $tstatus1 = $this->db->insert('ekhajana_mouzadar_account_details', $mouzadar_acc_details_insert_array);
        if ($tstatus1!= 1)
        {
            $this->db->trans_rollback();
            log_message("error", "#EKHMBDE001, Error in insert on Mouzadar bank details  with data ". json_encode($mouzadar_acc_details_insert_array));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHIBDM01'];
        }else{
            $this->db->trans_commit();
            log_message("error", "#EKHMBDE002, Data inserted Successfully into mouzadar bank details table ". json_encode($mouzadar_acc_details_insert_array));
            return ['result' => 'SUCCESS', 'msg' => 'DATA INSERTED SUCCESSFULLY...!!!'];
        }
    }


    public function updateMouzadarBankDetails($mouzadar_acc_details_update_array,$dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$bank_id,$acc_code)
    {
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $this->db->trans_begin();
        $this->db->where('dist_code', $dist_code)
                ->where('subdiv_code', $subdiv_code)
                ->where('cir_code', $cir_code)
                ->where('mouza_pargona_code', $mouza_pargona_code)
                ->where('id', (int)$bank_id)
                //->where('account_code', $acc_code)
		->update('ekhajana_mouzadar_account_details', $mouzadar_acc_details_update_array);
        //echo "<pre>";
	//var_dump($this->db->last_query());exit;

        if($this->db->affected_rows() != 1){
            $this->db->trans_rollback();
            log_message("error", "#EKHMBDE00287, Error in update on ekhajana_mouzadar_bank details table with query- ". json_encode($this->db->last_query()));
            return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHMBDE00287'];
        }
        else{
            $this->db->trans_commit();
            log_message("error", "#EKHMBDE00274, Data Updated Successfully into mouzadar bank details table ". json_encode($mouzadar_acc_details_update_array));
            return ['result' => 'SUCCESS', 'msg' => 'DATA UPDATED SUCCESSFULLY...!!!'];
        }
    }
}
?>
