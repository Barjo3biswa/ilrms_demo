<?php
class EkhajanaCfrModel extends CI_Model {

    //db switch
    public function dbswitch(){       
        $CI=&get_instance();
        
        if($this->session->userdata('dist_code') == "02"){
            $this->db=$CI->load->database('dhubri', TRUE);    
        }else if($this->session->userdata('dist_code') == "05"){
            $this->db=$CI->load->database('barpeta', TRUE);    
        }else if($this->session->userdata('dist_code') == "10"){
            $this->db=$CI->load->database('chirang', TRUE);       
        }else if($this->session->userdata('dist_code') == "13"){
            $this->db=$CI->load->database('bongaigaon', TRUE);    
        }else if($this->session->userdata('dist_code') == "17"){
            $this->db=$CI->load->database('dibrugarh', TRUE);    
        }else if($this->session->userdata('dist_code') == "15"){
            $this->db=$CI->load->database('jorhat', TRUE);    
        }else if($this->session->userdata('dist_code') == "14"){
            $this->db=$CI->load->database('golaghat', TRUE);    
        }else if($this->session->userdata('dist_code') == "07"){
            $this->db=$CI->load->database('kamrup', TRUE);    
        }else if($this->session->userdata('dist_code') == "03"){
            $this->db=$CI->load->database('goalpara', TRUE);    
        }else if($this->session->userdata('dist_code') == "18"){
            $this->db=$CI->load->database('tinsukia', TRUE);    
        }else if($this->session->userdata('dist_code') == "12"){
            $this->db=$CI->load->database('lakhimpur', TRUE);   
        }else if($this->session->userdata('dist_code') == "24"){
            $this->db=$CI->load->database('kamrupM', TRUE);   
        }else if($this->session->userdata('dist_code') == "06"){
            $this->db=$CI->load->database('nalbari', TRUE);   
        }else if($this->session->userdata('dist_code') == "11"){
            $this->db=$CI->load->database('sonitpur', TRUE);   
        }else if($this->session->userdata('dist_code') == "12"){
            $this->db=$CI->load->database('lakhimpur', TRUE);   
        }else if($this->session->userdata('dist_code') == "16"){
            $this->db=$CI->load->database('sibsagar', TRUE);   
        }else if($this->session->userdata('dist_code') == "32"){
            $this->db=$CI->load->database('morigaon', TRUE);   
        }else if($this->session->userdata('dist_code') == "33"){
            $this->db=$CI->load->database('nagaon', TRUE);   
        }else if($this->session->userdata('dist_code') == "34"){
            $this->db=$CI->load->database('majuli', TRUE);   
        }else if($this->session->userdata('dist_code') == "21"){
            $this->db=$CI->load->database('karimganj', TRUE);   
        }else if($this->session->userdata('dist_code') == "08"){
            $this->db=$CI->load->database('darrang', TRUE);   
        }else if($this->session->userdata('dist_code') == "35"){
            $this->db=$CI->load->database('biswanath', TRUE);   
        }else if($this->session->userdata('dist_code') == "36"){
            $this->db=$CI->load->database('hojai', TRUE);   
        }else if($this->session->userdata('dist_code') == "37"){
            $this->db=$CI->load->database('charaideo', TRUE);   
        }else if($this->session->userdata('dist_code') == "25"){
            $this->db=$CI->load->database('dhemaji', TRUE);   
        }else if($this->session->userdata('dist_code') == "39"){
            $this->db=$CI->load->database('bajali', TRUE);
        }    
        return $this->db;                                                                                                                                                                                                  
    }

    //getting lot no 
    public function getAllLots($distCode, $subdivcode, $circode, $mouzacode) {
        $this->dbswitch();
        $lots = $this->db->query("select lot_no,loc_name,locname_eng  from   location where dist_code =?  and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no!='00' and vill_townprt_code='00000'  order by lot_no",array($distCode,$subdivcode,$circode,$mouzacode));
        return $lots->result();
    }

    //getting all villages
    public function allVillageList($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,$lot_no)
    {
        $this->dbswitch();
        $villages = $this->db->query("select vill_townprt_code,loc_name,locname_eng  from   location where dist_code =?  and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code!='00000'  order by vill_townprt_code",array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,$lot_no));
        return $villages->result();
    }

    //getting all patta type list
    public function allPattaList()
    {
        $this->dbswitch();
        $patta_types = $this->db->query("select type_code,patta_type  from   patta_code where ekhajana =?   order by type_code",array('y'));
        return $patta_types->result(); 
    }

    //getting all patta no list
    public function allPattaNumbers($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,$lot_no,$vill_townprt_code)
    {
        $this->dbswitch();
        $patta_numbers = $this->db->query("select distinct(patta_no)  from  
        current_doul_demand where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? 
        and lot_no=? and vill_townprt_code=? order by patta_no",array($dist_code, $subdiv_code, $cir_code, 
        $mouza_pargona_code,$lot_no,$vill_townprt_code));
        return $patta_numbers->result(); 
    }

    //getting all the pattadars 
    public function getAllPattadars($dist_code, $subdiv_code, $cir_code, 
    $mouza_code,$lot_no,$village_code,$patta_type_code,$patta_no){
        $sql= "select cp.pdar_id,cp.pdar_name,cp.pdar_father from chitha_pattadar as cp join chitha_dag_pattadar as cdp on cp.dist_code = cdp.dist_code 
        and cp.subdiv_code = cdp.subdiv_code and cp.cir_code = cdp.cir_code and 
        cp.mouza_pargona_code = cdp.mouza_pargona_code and cp.lot_no = cdp.lot_no and cp.vill_townprt_code = cdp.vill_townprt_code and 
        trim(cp.patta_no) = trim(cdp.patta_no) and cp.patta_type_code = cdp.patta_type_code and cp.pdar_id = cdp.pdar_id where cdp.dist_code = '$dist_code' 
        and cdp.subdiv_code = '$subdiv_code' and cdp.cir_code = '$cir_code' and cdp.mouza_pargona_code = '$mouza_code' and cdp.lot_no = '$lot_no'
        and cdp.vill_townprt_code = '$village_code' and cdp.patta_type_code = '$patta_type_code' and (cdp.p_flag != '1' or cdp.p_flag is null)  
        and trim(cdp.patta_no) in (select trim(patta_no) from chitha_basic as cb where cb.dist_code = '$dist_code'
        and cb.subdiv_code = '$subdiv_code' and cb.cir_code = '$cir_code' and cb.mouza_pargona_code = '$mouza_code' and cb.lot_no = '$lot_no'
        and cb.vill_townprt_code = '$village_code' and cb.patta_type_code = '$patta_type_code' and trim(cb.patta_no)=trim('$patta_no'))";    
        $data = $this->db->query($sql)->result();
        return $data; 
    }

    //getting the approved cfr books 
    public function getCfrApprovedBooksList($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code){
        $this->dbswitch();
        $book_list = $this->db->query("select cfr_book_number from ekhajana_cfr_records 
                where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?
                and status=?",array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,'Y'));
        return $book_list->result(); 
    }

    //insert cfr records from mouzadars
    public function insertMouzadarCFRdetails($result,$destinationPath){
        
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $this->db->trans_begin();
        foreach($result as $row){
            //insertion details for cfr records transactions
            $insert_details_for_cfr_records_transactions = [
                "dist_code" => $row['dist_code'],
                "subdiv_code" => $row['subdiv_code'],
                "cir_code" => $row['cir_code'],
                "mouza_pargona_code" => $row['mouza_pargona_code'],
                "lot_no" => $row['lot_no'],
                "vill_townprt_code" => $row['village'],
                "patta_type_code" => $row['patta_type_code'],
                "patta_no" => $row['patta_no'],
                "cfr_book_no" => $row['book_no'],
                "cfr_page_no" => $row['page_no'],
                "cfr_copy_path" => $destinationPath,
                "status" => 'P', 
                "digital_payment_status" => 'P', 
                "user_details" => json_encode($this->session->all_userdata()), 
                "posted_data" => json_encode(['result' => $result, 'file_path'=>$destinationPath]), 
                "created_at" => date('Y-m-d h:i:s'),                
                "year" => date('Y'), 
                "doul_year_no" => doul_year_no,
                "pdar_id_kpph" => $row['pdar_id_kpph'],
                "pdar_id_kpph_name" => $row['pdar_id_kpph_text'],
                "pdar_id_kbph" => $row['pdar_id_kbph'],
                "pdar_id_kbph_name" => $row['pdar_id_kbph_text']
            ];
            $tstatus1 = $this->db->insert('ekhajana_mouzadar_cfr_records_transactions', $insert_details_for_cfr_records_transactions);
            if ($tstatus1!= 1)
            {
                $this->db->trans_rollback();
                log_message("error", "#EKHCFRMOU001, Error in insert on ekhajana_mouzadar_cfr_records_transactions table with query- ". json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHCFRMOU001'];
            }
            //insertion details for cfr records 
            $insert_details_for_cfr_records = [
                "dist_code" => $row['dist_code'],
                "subdiv_code" => $row['subdiv_code'],
                "cir_code" => $row['cir_code'],
                "mouza_pargona_code" => $row['mouza_pargona_code'],
                "lot_no" => $row['lot_no'],
                "vill_townprt_code" => $row['village'],
                "patta_type_code" => $row['patta_type_code'],
                "patta_no" => $row['patta_no'],
                "cfr_book_no" => $row['book_no'],
                "cfr_page_no" => $row['page_no'],
                "cfr_copy_path" => $destinationPath,
                "status" => 'P', 
                "digital_payment_status" => 'P', 
                "user_details" => json_encode($this->session->all_userdata()), 
                // "posted_data" => json_encode(['result' => $result, 'file_path'=>$destinationPath]), 
                "created_at" => date('Y-m-d h:i:s'),                
                "year" => date('Y'), 
                "doul_year_no" => doul_year_no,
                "pdar_id_kpph" => $row['pdar_id_kpph'],
                "pdar_id_kpph_name" => $row['pdar_id_kpph_text'],
                "pdar_id_kbph" => $row['pdar_id_kbph'],
                "pdar_id_kbph_name" => $row['pdar_id_kbph_text']
            ];
            $tstatus2 = $this->db->insert('ekhajana_mouzadar_cfr_records', $insert_details_for_cfr_records);
            if ($tstatus2!= 1)
            {
                $this->db->trans_rollback();
                log_message("error", "#EKHCFRMOU002, Error in insert on ekhajana_mouzadar_cfr_records table with query- ". json_encode($this->db->last_query()));
                return ['result' => 'SERVER-ERROR', 'msg' => 'Some error occured, Error-Code : #EKHCFRMOU002'];
            }
        }
        $this->db->trans_commit();
        return ['result' => 'SUCCESS', 'msg' => 'CFR Details Of The Book No-"'. $row['book_no']. '" And The CFR Page-"'. $row['page_no']. '" Is Updated Successfully. Details Can Be Viewed In View CFR Details Section'];
    }

    public function getUpdatedCfrBookAndPageDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $updatedBookDetails = $this->db->query("select distinct cfr_page_no,cfr_book_no from ekhajana_mouzadar_cfr_records
        where dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?", 
        array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code))->result();
        return $updatedBookDetails;
    }

    public function getUpdatedCfrPageDetails($cfr_page_no){
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $updatedPageDetails = $this->db->query("select * from ekhajana_mouzadar_cfr_records where cfr_page_no=?", 
        array($cfr_page_no))->result();
        return $updatedPageDetails;
    }

    public function getToBeSettledCFRlist($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $toBeSettledCFRList = $this->db->query("select cfr_book_no,cfr_page_no,count(*) as total_no_of_patta  
                                                from ekhajana_mouzadar_cfr_records                                                
                                                where dist_code=? and subdiv_code=? and cir_code=? and
                                                mouza_pargona_code=? and digital_payment_status in ('P','A','N')
                                                and (cfr_book_no,cfr_page_no) not in 
                                                (select cfr_book_no,cfr_page_no  from 
                                                ekhajana_mouzadar_cfr_payments emcp 
                                                where gras_status='P')
                                                group by cfr_book_no,cfr_page_no", 
        array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code))->result();
        //return $this->db->last_query();
        return $toBeSettledCFRList;
    }

    public function getPattaDetailsFromCFRpageAndBook($bookNumber,$pageNumber){
        $this->db  = $this->load->database('rtpsmb', TRUE);        
        $patta_details = $this->db->query("select * from ekhajana_mouzadar_cfr_records 
        where cfr_book_no =? and cfr_page_no =?", array($bookNumber,$pageNumber))->result();
        return $patta_details;
    }

    public function getArrearUpdateFlag($patta_detail){
        //return $patta_detail;
        $this->db = $this->dbswitch();
        $arrear_update_count = $this->db->query('select count(*) as c from ekhajana_arrear_pre_updation where 
                                        dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?
                                        and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?',
                                        array($patta_detail->dist_code, $patta_detail->subdiv_code, $patta_detail->cir_code,
                                        $patta_detail->mouza_pargona_code,$patta_detail->lot_no,$patta_detail->vill_townprt_code,
                                        $patta_detail->patta_type_code,$patta_detail->patta_no))->row()->c;

        //return $this->db->last_query();
        //return $arrear_update_count;
        if($arrear_update_count == 0){
            return "arrear_not_updated";
        }else{
            return "arrear_updated";
        }
    }

    public function getArrearAndCurrentRevDetails($patta_detail){
        $this->db = $this->dbswitch();
        $arrear_row = $this->db->query('select * from ekhajana_arrear_pre_updation where 
                                        dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?
                                        and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?',
                                        array($patta_detail->dist_code, $patta_detail->subdiv_code, $patta_detail->cir_code,
                                        $patta_detail->mouza_pargona_code,$patta_detail->lot_no,$patta_detail->vill_townprt_code,
                                        $patta_detail->patta_type_code,$patta_detail->patta_no))->row();
        $current_doul_row = $this->db->query('select * from current_doul_demand where 
                                        dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?
                                        and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?',
                                        array($patta_detail->dist_code, $patta_detail->subdiv_code, $patta_detail->cir_code,
                                        $patta_detail->mouza_pargona_code,$patta_detail->lot_no,$patta_detail->vill_townprt_code,
                                        $patta_detail->patta_type_code,$patta_detail->patta_no))->row();
        return [
            "total_arrear" => $arrear_row->arrear,
            "arrear_revenue" => $arrear_row->revenue, 
            "arrear_local_tax" => $arrear_row->tax,
            "current_revenue" => $current_doul_row->dag_revenue,
            "current_local_tax" => $current_doul_row->dag_local_tax, 
            "total_amount" => $arrear_row->arrear+$current_doul_row->dag_revenue+$current_doul_row->dag_local_tax
        ];
    }

    public function getAllAmountDetailsFromCFRpages($decodedRows){
        
        $patta_details_all = array();
        foreach($decodedRows as $cfr_details){
            $patta_details = $this->getPattaDetailsFromCFRpageAndBook($cfr_details['bookNumber'],$cfr_details['pageNumber']);
            foreach($patta_details as $patta_detail){
                array_push($patta_details_all, $patta_detail);
            }
        }                
        
        $mouzadar_total_commission=0;        
        $revenue_head_total_amount=0;    
        $total_amount=0;
        
        foreach($patta_details_all as $patta_row){
            $commision_details = $this->getCommisionDetails($patta_row);
            //return $commision_details;
            if($commision_details["result"]){
                $mouzadar_total_commission = $mouzadar_total_commission+$commision_details['data']['mouzadar_total_commission'];
                $revenue_head_total_amount = $revenue_head_total_amount+$commision_details['data']['revenue_head_total_amount'];
                //$total_amount_patta_wise = $mouzadar_total_commission+$revenue_head_total_amount;
                $total_amount = $total_amount + $commision_details['data']['due_amount'];
            }
        }

        return [
            'mouzadar_total_commission' => $mouzadar_total_commission,        
            'revenue_head_total_amount' => $revenue_head_total_amount,    
            'total_amount' => $total_amount,
        ];
    }


    public function getCommisionDetails($patta_row){
        $this->db = $this->dbswitch();
        //******************************************************************/
        //getting demand satisfaction details
        $demand_satisfaction_details_query = $this->db->query("select * from ekhajana_demand_satisfy_year where
                                    dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?",
                                    array($patta_row->dist_code, $patta_row->subdiv_code, $patta_row->cir_code,
                                    $patta_row->mouza_pargona_code));
        $demand_satisfaction_details_count = $demand_satisfaction_details_query->num_rows();
        //******************************************************************/
        //if demand satisfaction is not found then from arrear commision will be 30% and
        //from the current year commission will be 30%
        if($demand_satisfaction_details_count == 0){
            $arrear_pre_update_query = $this->db->query("select arrear from ekhajana_arrear_pre_updation where dist_code=? and subdiv_code=?
            and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=? and patta_type_code=? and
            patta_no=?", array($patta_row->dist_code, $patta_row->subdiv_code, $patta_row->cir_code,
            $patta_row->mouza_pargona_code,$patta_row->lot_no,$patta_row->vill_townprt_code, $patta_row->patta_type_code,
            $patta_row->patta_no));
            if($arrear_pre_update_query->num_rows() == 0){
                log_message('error', '#EEKHARNF, Arrear Row Not Found With The Last Query '.json_encode($this->db->last_query()));
                return ["result"=>false, "msg" => "Some Error Occured, Err Code-#EEKHARNF"];
            }
            $total_arrear = $arrear_pre_update_query->row()->arrear;
            //******************************************************************/
            //getting jama wasil details
            $current_doul_query = $this->db->query("select * from current_doul_demand where dist_code=? and subdiv_code=?
                                and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=?
                                and patta_type_code=? and patta_no=?",
                                array($patta_row->dist_code, $patta_row->subdiv_code, $patta_row->cir_code,
                                $patta_row->mouza_pargona_code,$patta_row->lot_no,
                                $patta_row->vill_townprt_code, $patta_row->patta_type_code,
                                $patta_row->patta_no));
            $current_doul_row_count = $current_doul_query->num_rows();
            if($current_doul_row_count != 1){
                log_message('error', '#EKHJWRNF, Jama Wasil Not Found With The Last Query '.json_encode($this->db->last_query()));
                return ["result"=>false, "msg" => "Some Error Occured, Err Code-#EEKHJWRNF"];
            }
            $current_doul_details = $current_doul_query->row();
            //******************************************************************/
            $current_revenue = $current_doul_details->dag_revenue;
            $current_local_tax = $current_doul_details->dag_local_tax;
            $total_revenue_with_tax = $current_revenue+$current_local_tax;
            $due_amount = $total_arrear+$total_revenue_with_tax;
            $total_commision_of_current_year = ($total_revenue_with_tax * 30/100);
            $total_commision_from_arrear = ($total_arrear * 30/100);
            $mouzadar_total_commission = $total_commision_of_current_year+$total_commision_from_arrear;
            $revenue_head_total_amount = $due_amount-$mouzadar_total_commission;
            //******************************************************************/
            return ["result"=>true, "data" => [
                "demand_satisfied_year" => '--',
                "demand_satisfied_year_no" => '--',
                "total_arrear_till_demand_satisfied_time" => 0,
                "total_arrear_after_demand_satisfied_time" => 0,
                "total_commision_from_arrear" => $total_commision_from_arrear,
                "current_revenue" => $current_revenue,
                "current_local_tax" => $current_local_tax,
                "current_revenue_with_local_tax" => $total_revenue_with_tax,
                "total_commision_of_current_year" => $total_commision_of_current_year,
                "mouzadar_total_commission" => $mouzadar_total_commission,
                "revenue_head_total_amount" => $revenue_head_total_amount,
                "total_arrear" => $total_arrear,
                "due_amount" => $due_amount
            ]];
        }
        //******************************************************************/
        if($demand_satisfaction_details_count > 1){
            log_message('error', '#EKHDSDNF, Error In Fetching Demand Satisfaction Information With The Last Query '.json_encode($this->db->last_query()));
            return ["result"=>false, "msg" => "Error In Fetching Demand Satisfaction Information, Err Code-#EKHDSDNF"];
        }
        $demand_satisfaction_details = $demand_satisfaction_details_query->row();
        $demand_satisfied_year = new DateTime(substr($demand_satisfaction_details->upto_demand_satisfied_year,5,4));
        //******************************************************************/
        //getting year wise details
        $year_wise_arrear_query = $this->db->query("select * from ekhajana_year_wise_arrear where
                                        dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?
                                        and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?
                                        order by id asc",
                                        array($patta_row->dist_code, $patta_row->subdiv_code, $patta_row->cir_code,
                                        $patta_row->mouza_pargona_code,$patta_row->lot_no,
                                        $patta_row->vill_townprt_code, $patta_row->patta_type_code,
                                        $patta_row->patta_no));
        $year_wise_arrear_count = $year_wise_arrear_query->num_rows();
        if($year_wise_arrear_count == 0){
            log_message('error', '#EKHYWANF, year_wise_arrear Not Found With The Last Query '.json_encode($this->db->last_query()));
            return ["result"=>false, "msg" => "Some Error Occured, Err Code-#EKHYWANF"];
        }
        $year_wise_arrear_details = $year_wise_arrear_query->result();
        //******************************************************************/
        //getting total arreear till demand satisfied time
        $total_arrear_till_demand_satisfied_time = 0;
        foreach($year_wise_arrear_details as $year_wise_arrear){
            $arrear_year = new DateTime(substr($year_wise_arrear->financial_year,5,4));
            if($arrear_year<=$demand_satisfied_year){
                $total_arrear_till_demand_satisfied_time = $total_arrear_till_demand_satisfied_time+$year_wise_arrear->year_arrear;
            }
        }
        //******************************************************************/
        //getting total areear after demand satisfied time
        $total_arrear_after_demand_satisfied_time = 0;
        foreach($year_wise_arrear_details as $year_wise_arrear){
            $arrear_year = new DateTime(substr($year_wise_arrear->financial_year,5,4));
            if($arrear_year > $demand_satisfied_year){
                $total_arrear_after_demand_satisfied_time = $total_arrear_after_demand_satisfied_time+$year_wise_arrear->year_arrear;
            }
        }
        //******************************************************************/
        //total commission from arrear
        $total_commision_from_arrear = $total_arrear_till_demand_satisfied_time +
                                        ($total_arrear_after_demand_satisfied_time * 30/100);
        //******************************************************************/
        //getting current doul demand details
        $current_doul_demand_query = $this->db->query("select * from current_doul_demand where dist_code=? and subdiv_code=?
                                and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=?
                                and patta_type_code=? and patta_no=?",
                                array($patta_row->dist_code, $patta_row->subdiv_code, $patta_row->cir_code,
                                $patta_row->mouza_pargona_code,$patta_row->lot_no,
                                $patta_row->vill_townprt_code, $patta_row->patta_type_code,
                                $patta_row->patta_no));
        $current_doul_demand_row_count = $current_doul_demand_query->num_rows();
        if($current_doul_demand_row_count != 1){
            log_message('error', '#EKHJWRNF, current doul demand Not Found With The Last Query '.json_encode($this->db->last_query()));
            return ["result"=>false, "msg" => "Some Error Occured, Err Code-#EKHJWRNF"];
        }
        $current_doul_demand_details = $current_doul_demand_query->row();
        //******************************************************************/
        $current_revenue = $current_doul_demand_details->dag_revenue;
        $current_local_tax = $current_doul_demand_details->dag_local_tax;
        $total_revenue_with_tax = $current_revenue+$current_local_tax;
        $total_arrear = $year_wise_arrear_details[0]->total_arrear;
        $due_amount = $total_arrear+$current_revenue+$current_local_tax;
        $total_commision_of_current_year = ($total_revenue_with_tax * 30/100);
        $mouzadar_total_commission = $total_commision_from_arrear+$total_commision_of_current_year;
        $revenue_head_total_amount = $due_amount-$mouzadar_total_commission;
        //******************************************************************/
        return ["result"=>true, "data" => [
            "demand_satisfied_year" => $demand_satisfaction_details->upto_demand_satisfied_year,
            "demand_satisfied_year_no" => substr($demand_satisfaction_details->upto_demand_satisfied_year,5,4),
            "total_arrear_till_demand_satisfied_time" => $total_arrear_till_demand_satisfied_time,
            "total_arrear_after_demand_satisfied_time" => $total_arrear_after_demand_satisfied_time,
            "total_commision_from_arrear" => $total_commision_from_arrear,
            "current_revenue" => $current_revenue,
            "current_local_tax" => $current_local_tax,
            "current_revenue_with_local_tax" => $total_revenue_with_tax,
            "total_commision_of_current_year" => $total_commision_of_current_year,
            "mouzadar_total_commission" => $mouzadar_total_commission,
            "revenue_head_total_amount" => $revenue_head_total_amount,
            "total_arrear" => $total_arrear,
            "due_amount" => $due_amount
        ]];
    }

    public function getSettledCfrBookAndPageDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $settledBookDetails = $this->db->query("SELECT 
                                                    department_id,
                                                    STRING_AGG('(B-NO:' || cfr_book_no || ', P-NO:' || cfr_page_no || ')', ' ') AS cfr_book_page,
                                                    gras_status
                                                FROM 
                                                    ekhajana_mouzadar_cfr_payments
                                                where dist_code=? and subdiv_code=? and cir_code=? 
                                                    and mouza_pargona_code=? and gras_status=?
                                                GROUP BY 
                                                    department_id, gras_status", 
                                                array($dist_code,$subdiv_code,$cir_code,
                                                $mouza_pargona_code,'Y'))->result();
        return $settledBookDetails;
    }

    public function getAbortedCfrBookAndPageDetails($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code) {
        $this->db = $this->load->database('rtpsmb', TRUE);        
        $query = "SELECT 
                      department_id,
                      STRING_AGG('(B-NO:' || cfr_book_no || ', P-NO:' || cfr_page_no || ')', ' ') AS cfr_book_page,
                      gras_status
                  FROM 
                      ekhajana_mouzadar_cfr_payments
                  WHERE 
                      dist_code = CAST(? AS TEXT) AND 
                      subdiv_code = CAST(? AS TEXT) AND 
                      cir_code = CAST(? AS TEXT) AND 
                      mouza_pargona_code = CAST(? AS TEXT) AND 
                      gras_status IN ('A', 'N')
                  GROUP BY 
                      department_id, gras_status";
    
        $abortedBookDetails = $this->db->query($query, array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code))->result();        
        return $abortedBookDetails;
    }
    
    public function getToBeVerifiedCfrBookAndPageDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code){
        $this->db = $this->load->database('rtpsmb', TRUE);        
        $query = "SELECT 
                      department_id,
                      STRING_AGG('(B-NO:' || cfr_book_no || ', P-NO:' || cfr_page_no || ')', ' ') AS cfr_book_page,
                      gras_status
                  FROM 
                      ekhajana_mouzadar_cfr_payments
                  WHERE 
                      dist_code = CAST(? AS TEXT) AND 
                      subdiv_code = CAST(? AS TEXT) AND 
                      cir_code = CAST(? AS TEXT) AND 
                      mouza_pargona_code = CAST(? AS TEXT) AND 
                      gras_status IN ('P')
                  GROUP BY 
                      department_id, gras_status";
    
        $toBeVerifiedBookDetails = $this->db->query($query, array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code))->result();        
        return $toBeVerifiedBookDetails;
    }

}
?>