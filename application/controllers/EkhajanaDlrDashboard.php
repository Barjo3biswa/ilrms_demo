<?php

class EkhajanaDlrDashboard extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ekhajana/EkhajanaDlrDashboardModel');
        $this->dbswitch($this->session->userdata('dist_code'));
    }

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

    //getting all applcations,pending,deliverd,rejected data
    public function getEkhajanaRtpsData()
    {
        $service = '19';
        $data['all_field'] = $this->EkhajanaDlrDashboardModel->allApplications();
        $data['pending_field'] = $this->EkhajanaDlrDashboardModel->allPendingApplications();
        $data['delivered_field'] = $this->EkhajanaDlrDashboardModel->allDisposedApplications();
        $data['rejected_field'] = $this->EkhajanaDlrDashboardModel->allRejecteddApplications();
        //$data['all_dist'] = $this->EkhajanaDlrDashboardModel->allApplicationDistwiseForIndex($service);
        $data['_view'] = 'e_khajana/dlr_dashboard/index';
		$this->load->view('layouts/main', $data);
    }

    public function getEkhajanaMouzaWiseDemandSatsisfiedReport(){
        $dist_codes = ["02","05","13","17","15","14","07","03","18","12","24","06","11","16",
                       "32","33","34","21","35","36","37","25","39","38","08"];

        //$dist_codes = ["07"];
        $demand_satisfied_mouza_wise_arr = array(); 
        foreach($dist_codes as $dist_code){
            log_message("error", "dist_code in loop for getting ekhajana mouza wise demand info is ". $dist_code);
            $getMouzaWiseDemandStaisfiedInfo = $this->EkhajanaDlrDashboardModel->getMouzaWiseDemandSatisfiedInfoFromDistCode($dist_code);
            // echo "<pre>";
            // var_dump($getMouzaWiseDemandStaisfiedInfo);
            // echo "<pre>";
            // exit;
            foreach($getMouzaWiseDemandStaisfiedInfo as $row){
                array_push($demand_satisfied_mouza_wise_arr, $row);
            }
        }
        //echo "<pre>";
        //var_dump($demand_satisfied_mouza_wise_arr);
        //echo "<pre>";
        //exit;
        $demand_satisfied_mouza_wise_arr_sorted = array();
        //**************************************************************************/
        //sorting 
        $year_no = array();
        foreach($demand_satisfied_mouza_wise_arr as $demand_satisfied_row){
            array_push($year_no, $demand_satisfied_row['year_no']);
        }
	rsort($year_no);
	//echo "<pre>";
	//var_dump($year_no);
	//exit;
	$unique_arr = array_unique($year_no);
	//echo "<pre>";
        //var_dump($unique_arr);
        //exit;
        rsort($unique_arr);
        $rank_arr = array();
        $count =1;
        foreach($unique_arr as $unique_year){
            $rank_arr[$unique_year] = $count;
            $count=$count+1; 
        }
        //echo "<pre>";
        //var_dump($rank_arr);
        //exit;
        foreach($unique_arr as $year){
            foreach($demand_satisfied_mouza_wise_arr as $demand_satisfied_row){
                if($demand_satisfied_row['year_no'] == $year){
                    $demand_satisfied_row['Rank'] = $rank_arr[$year];
                    array_push($demand_satisfied_mouza_wise_arr_sorted, $demand_satisfied_row);
                }
            }
        }           
        $data['demand_satisfied_mouza_wise_arr'] = $demand_satisfied_mouza_wise_arr_sorted;
        $data['_view'] = 'e_khajana/dlr_dashboard/demand_satisfied_report';
		$this->load->view('layouts/main', $data);        
    }

    public function getDpFlaggingReportDistWise()
    {
        $data['distWiseDpFlag'] = $this->EkhajanaDlrDashboardModel->districtWiseDpFlaggingData();
        // echo "<pre>";
        // var_dump($data['distWiseDpFlag']);
        // exit;
        $data['_view'] = 'e_khajana/dlr_dashboard/dist_wise_dp_flagging';
		$this->load->view('layouts/main', $data);
    }

    public function getCircleWisedpFlagging($dist_code)
    {
        $data['cirWiseDpFlag'] = $this->EkhajanaDlrDashboardModel->circleWiseDpFlaggingData($dist_code);
        // echo "<pre>";
        // var_dump($data['cirWiseDpFlag']);
        // exit;
        $data['_view'] = 'e_khajana/dlr_dashboard/circle_wise_dp_flagging';
		$this->load->view('layouts/main', $data);
    }

    public function getMouzaWisedpFlagging($dist_code,$subdiv_code,$cir_code)
    {
        $data['mouzaWiseDpFlag'] = $this->EkhajanaDlrDashboardModel->mouzaWiseDpFlaggingData($dist_code,$subdiv_code,$cir_code);
        // echo "<pre>";
        // var_dump($data['mouzaWiseDpFlag']);
        // exit;
        $data['_view'] = 'e_khajana/dlr_dashboard/mouza_wise_dp_flagging';
		$this->load->view('layouts/main', $data);
    }

    public function getLotWisedpFlagging($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code)
    {
        $data['lotWiseDpFlag'] = $this->EkhajanaDlrDashboardModel->lotWiseDpFlaggingData($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);
        // echo "<pre>";
        // var_dump($data['lotWiseDpFlag']);
        // exit;
        $data['_view'] = 'e_khajana/dlr_dashboard/lot_wise_dp_flagging';
		$this->load->view('layouts/main', $data);
    }

    public function getVillWisedpFlagging($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no)
    {
        $data['villWiseDpFlag'] = $this->EkhajanaDlrDashboardModel->villWiseDpFlaggingData($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code,$lot_no);
        // echo "<pre>";
        // var_dump($data['villWiseDpFlag']);
        // exit;
        $data['_view'] = 'e_khajana/dlr_dashboard/vill_wise_dp_flagging';
		$this->load->view('layouts/main', $data);
    }

    public function preArrearReport()
    {
        $data['dist'] = $this->EkhajanaDlrDashboardModel->allApplicationDistwise();
        // echo "<pre>";
        // var_dump($data['dist']);
        // exit;
        $data['_view'] = 'e_khajana/dlr_dashboard/pre_arrear/dist_wise_pre_arrear_report';
        $this->load->view('layouts/main', $data);
    }

    public function circleWiseArrearReport($dist_code)
    {
   
        $data['circle'] = $this->EkhajanaDlrDashboardModel->CircleWiseArrearReport($dist_code);
        $data['_view'] = 'e_khajana/dlr_dashboard/pre_arrear/circle_wise_pre_arrear_report';
        $this->load->view('layouts/main', $data);
    }

    public function mouzaWiseArrearReport($dist_code,$subdiv_code,$cir_code)
    {
   
        $data['mouza'] = $this->EkhajanaDlrDashboardModel->MouzaWiseArrearReport($dist_code,$subdiv_code,$cir_code);
        $data['_view'] = 'e_khajana/dlr_dashboard/pre_arrear/mouza_wise_pre_arrear_report';
        $this->load->view('layouts/main', $data);
    }

    public function ekhajanaPayments(){       
	//***************************************************/
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $data['total_cash_in_hand'] = $this->db->query("select sum(due_amount) from ekhajana_ecfr_details where status!='F'")->row()->sum;
        //echo $total_cash_in_hand;exit;
        //**************************************************/ 
        //***************************************************/
        //mouzadari area payments
        $data['total_amt_rcv_mouz_area'] = $this->EkhajanaDlrDashboardModel->getTotalAmountReceivedFromMouzadariArea();
        $data['total_amt_rcv_dby_mouz_area'] = $this->EkhajanaDlrDashboardModel->getTotalAmountReceivedDBYFromMouzadariArea();
	    $data['total_amt_rcv_y_mouz_area'] = $this->EkhajanaDlrDashboardModel->getTotalAmountReceivedYFromMouzadariArea();

        $data['getBestPerformingMouzaTN'] = $this->EkhajanaDlrDashboardModel->getBestPerformingMouzaTN();
	    $data['getLeastPerformingMouza'] = $this->EkhajanaDlrDashboardModel->getLeastPerformingMouza();

        $date_wise_graph_data_mouz = $this->EkhajanaDlrDashboardModel->getMouzGraphData();
        $xvalues_date_mouz = array();
        $yvalues_amt_mouz = array();
        foreach($date_wise_graph_data_mouz as $mouz_graph_data){            
            $xvalues_date_mouz[] = $mouz_graph_data['date'];            
            $yvalues_amt_mouz[] = $mouz_graph_data['sum'];            
        }
        $data['x_values_mouz'] = $xvalues_date_mouz;
        $data['yvalues_amt_mouz'] =$yvalues_amt_mouz; 


        //***************************************************/
        //tehsildari area
        $data['total_amt_rcv_teh_area'] = $this->EkhajanaDlrDashboardModel->getTotalAmountReceivedFromTehsildariArea();
        $data['total_amt_rcv_dby_teh_area'] = $this->EkhajanaDlrDashboardModel->getTotalAmountReceivedDBYFromTehsildariArea();
	    $data['total_amt_rcv_y_teh_area'] = $this->EkhajanaDlrDashboardModel->getTotalAmountReceivedYFromTehsildariArea();

	    $data['getBestPerformingCircleTN'] = $this->EkhajanaDlrDashboardModel->getBestPerformingCircleTN();
	    $data['getLeastPerformingCircle'] = $this->EkhajanaDlrDashboardModel->getLeastPerformingCircle();

	    $date_wise_graph_data_circle = $this->EkhajanaDlrDashboardModel->getCircleGraphData();
        $xvalues_date_cir = array();
        $yvalues_amt_cir = array();
        foreach($date_wise_graph_data_circle as $mouz_graph_data){
            $xvalues_date_cir[] = $mouz_graph_data['date'];
            $yvalues_amt_cir[] = $mouz_graph_data['sum'];
        }
        $data['x_values_cir'] = $xvalues_date_cir;
        $data['yvalues_amt_cir'] =$yvalues_amt_cir;
       
        //***************************************************/
        //total amounts
        $data['total_amt_rcv'] = $data['total_amt_rcv_mouz_area'] + $data['total_amt_rcv_teh_area'];
        $data['total_amt_rcv_dby'] = $data['total_amt_rcv_dby_mouz_area'] + $data['total_amt_rcv_dby_teh_area'];
        $data['total_amt_rcv_y'] = $data['total_amt_rcv_y_mouz_area'] + $data['total_amt_rcv_y_teh_area'];
        //***************************************************/
        $data['total_2024_year_amount'] = $this->EkhajanaDlrDashboardModel->getTotal2024RevYrAmt();
        $data['total_non_dp_demand_2024']= 713823368.71;
        //***************************************************/  
        //testing
        // echo "<pre>";
        // var_dump($data['total_2024_year_amount']);
        // exit;
        //***************************************************/
        $data['_view'] = 'e_khajana/dlr_dashboard/payments/index';
	$this->load->view('layouts/main', $data);
    }

    public function viewDistWiseMouzdarAreaPayments(){
        $data['getDistrcitWiseTotalAmountReceived'] = $this->EkhajanaDlrDashboardModel->getDistrcitWiseTotalAmountReceived();
        //***************************************************/
        //testing
        // echo "<pre>";
        // var_dump($data['getDistrcitWiseTotalAmountReceived']);
        // exit;
        //***************************************************/
        $data['_view'] = 'e_khajana/dlr_dashboard/payments/distrcitWiseMouzadarAreaPayments';
	    $this->load->view('layouts/main', $data);
    }

    public function viewMouzaWiseMouzdarAreaPayments($dist_code){
        $data['getMouzaWiseTotalAmountReceivedFromDistrict'] = $this->EkhajanaDlrDashboardModel->getMouzaWiseTotalAmountReceivedFromDistrict($dist_code);
        //***************************************************/
        //testing
        // echo "<pre>";
        // var_dump($data['getMouzaWiseTotalAmountReceivedFromDistrict']);
        // exit;
        //***************************************************/        
        $data['_view'] = 'e_khajana/dlr_dashboard/payments/mouzaWiseMouzadarAreaPayments';
	$this->load->view('layouts/main', $data);
    }

    public function viewDistWiseTehsildariAreaPayments(){
        $data['getDistrcitWiseTotalAmountReceivedTehsildariArea'] = $this->EkhajanaDlrDashboardModel->getDistrcitWiseTotalAmountReceivedTehsildariArea();
        //***************************************************/
        //testing
        // echo "<pre>";
        // var_dump($data['getDistrcitWiseTotalAmountReceivedTehsildariArea']);
        // exit;
        //***************************************************/
        $data['_view'] = 'e_khajana/dlr_dashboard/payments/distrcitWiseTehsilAreaPayments';
	$this->load->view('layouts/main', $data);
    }

    public function viewCircleWiseTehsilAreaPayments($dist_code){
        $data['getCircleWiseTotalAmountReceivedFromDistrict'] = $this->EkhajanaDlrDashboardModel->getCircleWiseTotalAmountReceivedFromDistrict($dist_code);
        //***************************************************/
        //testing
        // echo "<pre>";
        // var_dump($data['getCircleWiseTotalAmountReceivedFromDistrict']);
        // exit;
        //***************************************************/  
        $data['_view'] = 'e_khajana/dlr_dashboard/payments/circleWiseTehsilAreaPayments';
	$this->load->view('layouts/main', $data); 
    }


    public function ekycReport(){
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $data['ekyc_details'] = $this->db->query("select (select loc_name as district from location where dist_code=t.dist_code and subdiv_code='00'), count(*) filter (where t.aadhaar_pan_type='AADHAAR') as aadhaar_registration_count, count(*) filter (where t.status='F' and t.aadhaar_pan_type='AADHAAR') as aadhaar_seeding_count, count(*) filter (where t.aadhaar_pan_type='PAN') as pan_registration_count, count(*) filter (where t.status='F' and t.aadhaar_pan_type='PAN') as pan_seeding_count from (select distinct on (eld.dist_code,eld.subdiv_code,eld.cir_code,eld.mouza_pargona_code,eld.lot_no,eld.vill_townprt_code,eld.patta_type_code,eld.patta_no,eld.pdar_id) eld.dist_code,eld.subdiv_code,eld.cir_code,eld.mouza_pargona_code,eld.lot_no,eld.vill_townprt_code,eld.patta_type_code,eld.patta_no,eld.pdar_id,eld.aadhaar_pan_type,eld.status from ekhajana_land_details eld join ekhajana_applications ea on ea.application_no=eld.application_no where eld.repayment_flag is null and ea.is_draft ='N' and ea.initial_payment_status in ('N','C') and eld.is_auto_reg is null) as t group by t.dist_code order by t.dist_code")->result();        
        // echo "<pre>";
        // var_dump($data['ekyc_details']);
        // exit;
        $data['_view'] = 'e_khajana/dlr_dashboard/ekyc_report';
	$this->load->view('layouts/main', $data); 
    }


    public function nyksReport(){
        $CI=&get_instance();
        $this->db=$CI->load->database('rtpsmb', TRUE);
        $data['nyks_details'] = $nyks_details = $this->db->query("select (select loc_name as district from location where dist_code=eld.dist_code and subdiv_code='00'), TRIM(eld.external_reg_actor_name) as volunteer_name, count(*) as registration_count, count(*) filter (Where eld.status='P') as pending_with_lm_and_mouzadar_count, count(*) filter (Where eld.status='MLM_F') as pending_with_mouzadar_count, count(*) filter (Where eld.status='MOU_F') as pending_with_lm_count, count(*) filter (Where eld.status='COM_F') as pending_with_co_count, count(*) filter (Where ea.status='F') as delivered_count from ekhajana_land_details eld join ekhajana_applications ea on eld.application_no=ea.application_no where ea.initial_payment_status in ('N','C') and ea.is_draft='N' and eld.external_reg_actor = 'NYKS_VOLUNTEER' group by eld.dist_code, TRIM(eld.external_reg_actor_name) order by eld.dist_code, registration_count desc")->result();
        $total_registartion_count = 0;
	foreach($nyks_details as $nyks_detail){
	    //echo $nyks_detail->registration_count;
            $total_registartion_count = $total_registartion_count + (int)$nyks_detail->registration_count;
        }
        $data['total_registartion_count'] = $total_registartion_count;
        //echo "<pre>";
        //var_dump($data['total_registartion_count']);
        //exit;
        $data['_view'] = 'e_khajana/dlr_dashboard/nyks_report';
	$this->load->view('layouts/main', $data);
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


    public function cfrBookEntriesMouzaWise(){
        $dist_codes = ["02","05","13","17","15","14","07","03","18","12","24","06","11","16","32","33","34","21","35","36","37","25","39","38","08"];
        //$dist_codes = ["07"];                    
        $cfr_records_arry = array();
        foreach($dist_codes as $dist_code){
            $this->db2 = $this->dbswitch2($dist_code);
            $cfr_results = $this->db2->query("SELECT 
                            (select loc_name as district from location where dist_code=loc.dist_code and subdiv_code='00'),
                            (select loc_name as circle from location where dist_code=loc.dist_code and subdiv_code=loc.subdiv_code and cir_code=loc.cir_code and mouza_pargona_code='00'),
                            loc.loc_name as mouza,
                            COALESCE(rec.cfr_book_number::TEXT, 'Not Updated') AS cfr_book_number,
                            COALESCE(rec.no_of_cfr_pages_in_the_book::TEXT, 'Not Updated') AS no_of_cfr_pages_in_the_book,
                            COALESCE(rec.cfr_page_serial_no_start::TEXT, 'Not Updated') AS cfr_page_serial_no_start,
                            COALESCE(rec.cfr_page_serial_no_end::TEXT, 'Not Updated') AS cfr_page_serial_no_end,
                            COALESCE(rec.entry_year, 'Not Updated') AS entry_year,
                            COALESCE(rec.doul_year, 'Not Updated') AS doul_year,
                            CASE 
                                WHEN rec.status = 'Y' THEN 'Approved'
                                WHEN rec.status = 'P' THEN 'Pending at ADC'
                                ELSE 'Not Updated'
                            END AS book_status
                            FROM 
                                location loc
                            LEFT JOIN 
                                ekhajana_cfr_records rec
                            ON 
                                loc.dist_code = rec.dist_code AND 
                                loc.subdiv_code = rec.subdiv_code AND 
                                loc.cir_code = rec.cir_code AND 
                                loc.mouza_pargona_code = rec.mouza_pargona_code
                            WHERE 
                                loc.dist_code != '00' AND 
                                loc.subdiv_code != '00' AND 
                                loc.cir_code != '00' AND 
                                loc.mouza_pargona_code != '00' AND 
                                loc.lot_no = '00'")->result();
            foreach($cfr_results as $cfr_result){
                array_push($cfr_records_arry, $cfr_result);
            }
        }
        // echo "<pre>";
        // var_dump($cfr_records_arry);
        $data['cfr_book_entries'] = $cfr_records_arry;
        $data['_view'] = 'e_khajana/dlr_dashboard/cfr_book_reocrds';
	    $this->load->view('layouts/main', $data);
    }


public function reconcilitaionDashBoard()
    {
        $data['reconcil_data'] = $this->EkhajanaDlrDashboardModel->getReconciliationDetails();
        if($data['reconcil_data']['flag'] == 'ERROR'){
            echo "Some error Occurred In Fetching Details.. Kindly Try After Some Time";
            exit;
        }
        $data['reconcil_details'] = $data['reconcil_data']['msg'];
        $data['_view'] = 'e_khajana/dlr_dashboard/reconcil_dashboard/dashboard_index';
        $this->load->view('layouts/main',$data);
    }

    public function MouzaWiseReconciliationDashborad($dist_code)
    {
        $data['reconcil_data'] = $this->EkhajanaDlrDashboardModel->getMouzaWiseReconciliationDetails($dist_code);
        if($data['reconcil_data']['flag'] == 'ERROR'){
            echo "Some error Occurred In Fetching Details.. Kindly Try After Some Time";
            exit;
        }
        $data['reconcil_details'] = $data['reconcil_data']['msg'];
        $data['_view'] = 'e_khajana/dlr_dashboard/reconcil_dashboard/mouza_wise_dashboard';
        $this->load->view('layouts/main',$data);
    }


}
?>
