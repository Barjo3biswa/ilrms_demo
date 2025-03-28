<?php

class EkhajanaMouzadarCfr extends MY_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('ekhajana/Cfr/EkhajanaCfrModel');
        $this->dbswitch();
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
        }  else if($this->session->userdata('dist_code') == "38"){
        $this->db=$CI->load->database('ssalmara', TRUE);   
        }  else if($this->session->userdata('dist_code') == "39"){
        $this->db=$CI->load->database('bajali', TRUE);   
        }                                                                                                                                                                                                              
    }

    public function index(){
        $data['_view'] = 'e_khajana/cfr_views/index';
        $this->load->view('layouts/main',$data);
    }

    public function cfrDetailsUpdateForm()
    {
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code']= $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code']= $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        //location names
        $data['district_name'] = $this->utilclass->getDistrictName($dist_code);
        $data['subdiv_name'] = $this->utilclass->getSubdivName($dist_code, $subdiv_code);
        $data['circle_name'] = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
        $data['mouza_name'] = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);
        $data['lot_list']   = $this->EkhajanaCfrModel->getAllLots($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);        
        $data['approvedCfrBooksList'] = $this->EkhajanaCfrModel->getCfrApprovedBooksList($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);        
        // echo "<pre>";
        // var_dump($approvedCfrBooksList);
        // exit;
        $data['_view'] = 'e_khajana/cfr_views/cfr_details_update_form';
        $this->load->view('layouts/main',$data);
    }

    //function to get all village list
    public function getVillageList()
    {
        $params = json_decode(file_get_contents("php://input"));
        $dist_code = $params->dist_code;
        $subdiv_code = $params->subdiv_code;
        $cir_code = $params->cir_code;
        $mouza_pargona_code = $params->mouza_pargona_code;
        $lot_no = $params->lot_no;
        $village_list = $this->EkhajanaCfrModel->allVillageList($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,$lot_no);
        echo json_encode($village_list);
    }

    //function to get all patta types
    public function getPattaTypes()
    {
        $patta_list = $this->EkhajanaCfrModel->allPattaList();
        echo json_encode($patta_list);
    }

    //function to get all patta numbers
    public function allPattaNumbers()
    {
        $params = json_decode(file_get_contents("php://input"));
        $dist_code = $params->dist_code;
        $subdiv_code = $params->subdiv_code;
        $cir_code = $params->cir_code;
        $mouza_pargona_code = $params->mouza_pargona_code;
        $lot_no = $params->lot_no;
        $vill_townprt_code = $params->vill_townprt_code;
        $patta_nos = $this->EkhajanaCfrModel->allPattaNumbers($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code,$lot_no,$vill_townprt_code);
        echo json_encode($patta_nos);
    }

    public function getPattadars(){
        $params = json_decode(file_get_contents("php://input"));
        $dist_code = $params->dist_code;
        $subdiv_code = $params->subdiv_code;
        $cir_code = $params->cir_code;
        $mouza_pargona_code = $params->mouza_pargona_code;
        $lot_no = $params->lot_no;
        $vill_townprt_code = $params->vill_townprt_code;
        $patta_type_code = $params->patta_type_code;
        $patta_no = $params->patta_no;
        $pattadars_list = $this->EkhajanaCfrModel->getAllPattadars($dist_code, $subdiv_code, $cir_code, 
                        $mouza_pargona_code,$lot_no,$vill_townprt_code,$patta_type_code,$patta_no);
        echo json_encode($pattadars_list);
    }

    public function checkOfflineCollectedPattaDetails(){
        
        //*********************************************************/
        // backend Validation
        // Set validation rules for each field
        $this->form_validation->set_rules('book_no', 'Book Number', 'required|integer');
        $this->form_validation->set_rules('page_no', 'Page Number', 'required|integer');
        $this->form_validation->set_rules('dist_code', 'District', 'required|exact_length[2]');
        $this->form_validation->set_rules('subdiv_code', 'Subdivision', 'required|exact_length[2]');
        $this->form_validation->set_rules('cir_code', 'Circle', 'required|exact_length[2]');
        $this->form_validation->set_rules('mouza_pargona_code', 'Mouza/Pargona', 'required|exact_length[2]');
        $this->form_validation->set_rules('lot_no', 'Lot Number', 'required|integer');
        $this->form_validation->set_rules('village', 'Village', 'required');
        $this->form_validation->set_rules('patta_type_code', 'Patta Type', 'required|exact_length[4]');
        $this->form_validation->set_rules('patta_no', 'Patta Number', 'required');
        $this->form_validation->set_rules('pdar_id_kpph', 'PDAR ID KPPH', 'required');
        $this->form_validation->set_rules('pdar_id_kpph_text', 'PDAR ID KPPH Text', 'required');
        $this->form_validation->set_rules('pdar_id_kbph', 'PDAR ID KBPH', 'required');
        $this->form_validation->set_rules('pdar_id_kbph_text', 'PDAR ID KBPH Text', 'required');
        // Run validation; if it fails, return the error messages in JSON format.
        if ($this->form_validation->run() == FALSE)
        {
            $msg = validation_errors();
            echo json_encode(['result' => 'ERROR', 'msg' => $msg]);
            exit;
        }
	//*********************************************************/
        //*********************************************************/
        if(trim($_POST['pdar_id_kpph']) == '00'){
            echo json_encode(['result' => 'ERROR', 'msg' => "Plese select 'কাৰ পৰা পোৱা হল'"]);
            exit;
        }
        if(trim($_POST['pdar_id_kbph']) == '00'){
            echo json_encode(['result' => 'ERROR', 'msg' => "Plese select 'কাৰ বাবে পোৱা হল'"]);
            exit;
        }
        if(trim($_POST['pdar_id_kbph_text']) == '--কাৰ বাবে পোৱা হল--'){
            echo json_encode(['result' => 'ERROR', 'msg' => "Plese select 'কাৰ বাবে পোৱা হল'"]);
            exit;
        }
        if(trim($_POST['pdar_id_kpph_text']) == '--কাৰ পৰা পোৱা হল--'){
            echo json_encode(['result' => 'ERROR', 'msg' => "Plese select 'কাৰ পৰা পোৱা হল'"]);
            exit;
        }
        //*********************************************************/
        $rtpsmb_db  = $this->load->database('rtpsmb', TRUE);
        //*********************************************************/
        //checkig online payment has been done or not in the time of insertion 
        $ekhajana_commision_details_payment_q = $rtpsmb_db->query("select * from ekhajana_commission_details where 
                            dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and 
                            vill_townprt_code=? and patta_type_code=? and patta_no=? and status=?", 
                            array($_POST['dist_code'], $_POST['subdiv_code'],$_POST['cir_code'],
                            $_POST['mouza_pargona_code'],$_POST['lot_no'],$_POST['village'],
                            $_POST['patta_type_code'],$_POST['patta_no'],'F'));
        if($ekhajana_commision_details_payment_q->num_rows() > 0){
            $msg = "Patta No ".$_POST['patta_no']." is already paid(Online). Can't Further Add This Patta For Settlement";
            echo json_encode(['result' => 'ERROR', 'msg' => $msg]);
            exit;
        }
        //*********************************************************/
        //Query the database to check whether the CFR page is already added.
        $book_no = (int) trim($_POST['book_no']);
        $entered_cfr_page_no = (int) trim($_POST['page_no']);
        $cfr_page_count =   $rtpsmb_db->query(
                                "SELECT COUNT(*) AS count FROM ekhajana_mouzadar_cfr_records 
                                WHERE cfr_book_no = ? AND cfr_page_no = ?",
                                array($book_no, $entered_cfr_page_no)
                            )->row()->count; 

        if ($cfr_page_count > 0) {
            $msg = "Entered CFR page number (" . $entered_cfr_page_no . ") is already added earlier. Can't add the same CFR page twice.";
            echo json_encode(['result' => 'ERROR', 'msg' => $msg]);
            exit;
        }
        //*********************************************************/
        //cheking whether the patta has already been added or not 
        $patta_count = $rtpsmb_db->query("SELECT COUNT(*) AS count FROM ekhajana_mouzadar_cfr_records 
                                WHERE dist_code = ? AND subdiv_code = ? and cir_code=? and mouza_pargona_code=?
                                and lot_no=? and vill_townprt_code=? and patta_type_code=? and patta_no=?",
                                array($_POST['dist_code'], $_POST['subdiv_code'],$_POST['cir_code'],
                                $_POST['mouza_pargona_code'],$_POST['lot_no'],$_POST['village'],
                                $_POST['patta_type_code'],$_POST['patta_no']))->row()->count;
        if($patta_count > 0){
            $msg = "Entered patta number (" . $_POST['patta_no'] . ") for the selected village is already added in a different CFR page. Can't Add The Same Patta Number Again.";
            echo json_encode(['result' => 'ERROR', 'msg' => $msg]);
            exit;
        }
        //*********************************************************/
        //checking whether page no in range or not 
        $cfr_book_details_q = $this->db->query("select * from ekhajana_cfr_records
                                                where cfr_book_number=? and status=?", 
                                                array(trim($_POST['book_no']),'Y'));
        if($cfr_book_details_q->num_rows() != 1){
            $msg = trim($_POST['book_no']). " Book No Has Some Error. Kindly Contact Admin!";
            echo json_encode(['result' => 'ERROR', 'msg' => $msg]);
            exit;
        }
        $cfr_book_details_row = $cfr_book_details_q->row();
        $cfr_page_no_start = $cfr_book_details_row->cfr_page_serial_no_start;
        $cfr_page_no_end = $cfr_book_details_row->cfr_page_serial_no_end;        
        $entered_cfr_page_no = trim($_POST['page_no']);
        //echo $cfr_page_no_start."-".$cfr_page_npop_end."-".$entered_cfr_page_no;
        $start   = (int)$cfr_page_no_start;
        $end     = (int)$cfr_page_no_end;
        $entered = (int)$entered_cfr_page_no;
        // Validate that the entered page number is within the allowed range
        if ($entered < $start || $entered > $end) {
            $msg = "Entered CFR page number (" . $entered_cfr_page_no . ") is not within the allowed range (" . $cfr_page_no_start . " - " . $cfr_page_no_end . ") Of The CFR Book.";
            echo json_encode(['result' => 'ERROR', 'msg' => $msg]);
            exit;
        }         
        //*********************************************************/
        // echo "all the validation passed";
        // exit;
        echo json_encode(['result' => 'SUCCESS', 'msg' => "All The Patta Details Added/Validated Successfully. More Patta Can Be Added If More Than One Patta Is Collected For The CFR Page ". $entered]);
    }

    public function submitCfrDetails()
    {
        //**********************************************/
        // Validate row consistency in POST arrays
        $postData = $_POST;
        $rowLengths = [];

        foreach ($postData as $key => $value) {
            if (is_array($value)) {
                $rowLengths[$key] = count($value);
            }
        }

        // Check if all array lengths are the same
        if (count(array_unique($rowLengths)) > 1) {
            echo json_encode([
                'result' => 'VALIDATION-ERROR',
                'msg' => 'Row-wise validation failed. All array fields must have the same number of elements.'
            ]);
            exit;
        }

        // Validate non-array fields (if any)
        $this->form_validation->set_rules('mouza_name', 'Mouza Name', 'required');
        $this->form_validation->set_rules('lot_name', 'Lot Name', 'required');
        $this->form_validation->set_rules('village_name', 'Village Name', 'required');
        $this->form_validation->set_rules('patta_type_name', 'Patta Type Name', 'required');

        // Run form validation for non-array fields
        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['result' => 'VALIDATION-ERROR', 'msg' => validation_errors()]);
            exit;
        }

        //**********************************************/
        // File validation and saving
        if (!isset($_POST['book_no'][0]) || !isset($_POST['page_no'][0]) || empty($_FILES['cfr_carbon_copy']['tmp_name'])) {
            echo json_encode(['result' => 'SERVER-ERROR', 'msg' => 'Error In Getting The Carbon Copy File. Please Try Again']);
            exit;
        }

        $bookNumber = $_POST['book_no'][0];
        $cfrPageNumber = $_POST['page_no'][0];
        $file = $_FILES['cfr_carbon_copy'];
        $originalFileName = $file['name'];
        $tmpFilePath = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        if ($fileError !== UPLOAD_ERR_OK) {
            echo json_encode(['result' => 'SERVER-ERROR', 'msg' => 'Error In Uploading The Carbon Copy File. Please Try Again']);
            exit;
        }

        $maxFileSize = 2 * 1024 * 1024;
        if ($fileSize > $maxFileSize) {
            echo json_encode(['result' => 'SERVER-ERROR', 'msg' => 'File size exceeds 2MB limit. Please upload a smaller file.']);
            exit;
        }

        $allowedExtensions = ['pdf', 'jpeg', 'jpg', 'png'];
        $fileExtension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo json_encode(['result' => 'SERVER-ERROR', 'msg' => 'Invalid file type. Only PDF, JPEG, JPG, and PNG files are allowed.']);
            exit;
        }

        $timestamp = date('Ymd_His');
        $customFileName = "bookNo_{$bookNumber}_cfrPageNo_{$cfrPageNumber}_{$timestamp}.{$fileExtension}";
        $destinationPath = UPLOAD_DIR_FOR_OFFLINE_CFR . $customFileName;

        if (file_exists($destinationPath)) {
            echo json_encode(['result' => 'SERVER-ERROR', 'msg' => 'A file with the same name already exists. Please try again.']);
            exit;
        }

        if (move_uploaded_file($tmpFilePath, $destinationPath)) {
            if (!file_exists($destinationPath)) {
                echo json_encode(['result' => 'SERVER-ERROR', 'msg' => 'File uploaded but failed to save. Please try again.']);
                exit;
            }
            log_message("error", "Offline CFR File uploaded successfully as: " . $customFileName);
        } else {
            echo json_encode(['result' => 'SERVER-ERROR', 'msg' => 'Error In Saving The Carbon Copy File. Please Try Again']);
            exit;
        }

        //**********************************************/
        // Process and validate the POST data row-wise
        $result = [];
        $numRows = $rowLengths[array_key_first($rowLengths)];
        for ($i = 0; $i < $numRows; $i++) {
            $row = [];
            foreach ($postData as $key => $value) {
                $row[$key] = is_array($value) ? ($value[$i] ?? null) : $value;
            }

            // Row validation: Ensure no null values
            if (in_array(null, $row, true)) {
                echo json_encode([
                    'result' => 'VALIDATION-ERROR',
                    'msg' => "Validation failed for row $i. All fields must be filled."
                ]);
                exit;
            }

            // Additional validation for new fields
            if (empty($row['pdar_id_kpph']) || empty($row['pdar_id_kpph_text']) || empty($row['pdar_id_kbph']) || empty($row['pdar_id_kbph_text'])) {
                echo json_encode([
                    'result' => 'VALIDATION-ERROR',
                    'msg' => "Validation failed for row $i. Fields (কাৰ পৰা পোৱা হল, কাৰ বাবে পোৱা হল) are required."
                ]);
                exit;
            }

            $result[] = $row;
        }
        //**********************************************/
        $insert_flag = $this->EkhajanaCfrModel->insertMouzadarCFRdetails($result, $destinationPath);
        echo json_encode($insert_flag);
    }

    public function viewCfrDetails(){
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code']= $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code']= $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        //location names
        $data['district_name'] = $this->utilclass->getDistrictName($dist_code);
        $data['subdiv_name'] = $this->utilclass->getSubdivName($dist_code, $subdiv_code);
        $data['circle_name'] = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
        $data['mouza_name'] = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);        
        $data['viewData'] = $this->EkhajanaCfrModel->getUpdatedCfrBookAndPageDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);        
        // echo "<pre>";
        // var_dump($data['viewData']);
        // exit;
        $data['_view'] = 'e_khajana/cfr_views/cfr_book_page_view_list';
        $this->load->view('layouts/main',$data);
    }

    public function viewUpdatedCfrPageDetails($cfr_page_no){
        //echo "in the controller cfr page no is ". $cfr_page_no;
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code']= $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code']= $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $data['viewData'] = $this->EkhajanaCfrModel->getUpdatedCfrPageDetails($cfr_page_no);        
        // echo "<pre>";
        // var_dump($data['viewData']);
        // exit;
        $data['_view'] = 'e_khajana/cfr_views/cfr_page_details';
        $this->load->view('layouts/main',$data);
    }

    public function CFRlistToBeSettled(){
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code']= $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code']= $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        //location names
        $data['district_name'] = $this->utilclass->getDistrictName($dist_code);
        $data['subdiv_name'] = $this->utilclass->getSubdivName($dist_code, $subdiv_code);
        $data['circle_name'] = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
        $data['mouza_name'] = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);        
        $data['toBeSettleList'] = $this->EkhajanaCfrModel->getToBeSettledCFRlist($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code); 
        // echo "<pre>";
        // var_dump($data['toBeSettleList']);
        // exit;
        $data['_view'] = 'e_khajana/cfr_views/to_be_settled_cfr_list';
        $this->load->view('layouts/main',$data);
    }

    public function cfrPagesToBePaidDetails(){
        //********************************************************/
        //backend validation 
        $rows = $this->input->post('rows');
        $totalPattaCount = $this->input->post('totalPattaCount');

        // Validate input
        if (empty($rows) || !is_array($rows)) {
            show_error('Invalid request. No rows were selected.');
        }

        if (!is_numeric($totalPattaCount) || $totalPattaCount <= 0) {
            show_error('Invalid request. Total patta count must be a positive number.');
        }

        // Decode and validate rows
        $decodedRows = [];
        foreach ($rows as $row) {
            $data = json_decode($row, true);
            if (empty($data['bookNumber']) || empty($data['pageNumber']) || !isset($data['totalPatta'])) {
                show_error('Invalid row data.');
            }

            if (!is_numeric($data['totalPatta']) || $data['totalPatta'] <= 0) {
                show_error('Invalid patta count in row data.');
            }

            $decodedRows[] = $data;
        }
        //********************************************************/
        //checking arrear updation
        $arrear_not_updated_arr = array();
        foreach($decodedRows as $row){
            $patta_details = $this->EkhajanaCfrModel->getPattaDetailsFromCFRpageAndBook($row['bookNumber'],$row['pageNumber']);
            foreach($patta_details as $patta_detail){
                $arrer_updation_flag = $this->EkhajanaCfrModel->getArrearUpdateFlag($patta_detail);
                if($arrer_updation_flag == "arrear_not_updated"){
                    array_push($arrear_not_updated_arr, $patta_detail);
                }
                // echo "<pre>";
                // var_dump($arrer_updation_flag);
                // exit;
            }            
        }
        // echo "<pre>";
        // var_dump($arrear_not_updated_arr);
        // exit;    
        if(count($arrear_not_updated_arr) != 0){
            $data['arrear_not_updated_patta_list'] = $arrear_not_updated_arr;
            $data['_view'] = 'e_khajana/cfr_views/manual_cfr_payment_arrear_error';
            $this->load->view('layouts/main',$data);
            return;        
        }                    
        //********************************************************/
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code']= $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code']= $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        //********************************************************/
        //getting amount details 
        $data['amount_details_all'] = $this->EkhajanaCfrModel->getAllAmountDetailsFromCFRpages($decodedRows);
        // echo "<pre>";
        // var_dump($data['amount_details_all']);
        // exit;
        //********************************************************/
        //getting mouzadar bank details 
        $this->db  = $this->load->database('rtpsmb', TRUE);        
        $bank_details_query = $this->db->query("select * from ekhajana_mouzadar_account_details where dist_code=?
        and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status='A'
        and mouzadar_declare_yn=? and adc_verified_yn=?", array($dist_code,$subdiv_code,$cir_code,
        $mouza_pargona_code,'Y','Y'));
        $data['mouzadar_bank_details'] = $bank_details_query->row(); 
        //********************************************************/
        //cfr details selection page 
        $data['cfr_pages_details_from_selection'] = $decodedRows;
        $data['total_no_of_patta'] = $totalPattaCount;
        //********************************************************/
        // echo "<pre>";
        // var_dump($data);
        // exit;        
        $data['_view'] = 'e_khajana/cfr_views/cfr_page_payment_details';
        $this->load->view('layouts/main',$data);
    }

    // Custom validation callback for JSON validation
    public function validate_json($str)
    {
        json_decode($str);
        return (json_last_error() === JSON_ERROR_NONE);
    }

    public function proceedToEgars(){

        //********************************************************/
        // Backend validation
        // Set validation rules
        $this->form_validation->set_rules('dist_code', 'District Code', 'required|exact_length[2]|alpha_numeric');
        $this->form_validation->set_rules('subdiv_code', 'Subdivision Code', 'required|exact_length[2]|alpha_numeric');
        $this->form_validation->set_rules('cir_code', 'Circle Code', 'required|exact_length[2]|alpha_numeric');
        $this->form_validation->set_rules('mouza_pargona_code', 'Mouza Pargona Code', 'required|exact_length[2]|alpha_numeric');
        $this->form_validation->set_rules('mouzadarAccountHolderName', 'Mouzadar Account Holder Name', 'required|max_length[50]');
        $this->form_validation->set_rules('mouzadarAccountCode', 'Mouzadar Account Code', 'required|max_length[20]|alpha_numeric');
        $this->form_validation->set_rules('totalAmount', 'Total Amount', 'required|numeric');
        $this->form_validation->set_rules('treasuryAmount', 'Treasury Amount', 'required|numeric');
        $this->form_validation->set_rules('nonTreasuryAmount', 'Non-Treasury Amount', 'required|numeric');
        $this->form_validation->set_rules('cfr_pages_details_from_selection', 'CFR Pages Details', 'required|callback_validate_json');
        // Run validation
        if ($this->form_validation->run() === FALSE) {
            // Validation failed
            show_error(validation_errors(), 400, 'Validation Error');
            return;
        }
        // Retrieve POST data
        $data = $this->input->post();
        // Additional custom validation for CFR Pages Details
        $pageDetails = json_decode($data['cfr_pages_details_from_selection'], true);
        if (!is_array($pageDetails) || empty($pageDetails)) {
            show_error('CFR Pages Details must contain valid JSON data with at least one entry.', 400, 'Validation Error');
            return;
        }
        
        // Example: Check each entry in CFR Pages Details
        foreach ($pageDetails as $detail) 
        {
            if (!isset($detail['bookNumber'], $detail['pageNumber'], $detail['totalPatta'])) {
                show_error('Each entry in CFR Pages Details must have bookNumber, pageNumber, and totalPatta.', 400, 'Validation Error');
                return;
            }
        }
        //*************************************************************/        
        //logical validations 1
        //checking all the cfr pages unique or not 
        $seenPages = [];
        foreach ($pageDetails as $detail) {
            // Check if the pageNumber already exists in the seenPages array
            if (in_array($detail['pageNumber'], $seenPages)) {
                // Duplicate found, show error and stop further execution
                show_error('Each entry in CFR Pages Details must have a unique CFR PAGE Number.', 400, 'Validation Error');
                return;
            }

            // Otherwise, mark this pageNumber as seen
            $seenPages[] = $detail['pageNumber'];
        }
        //*************************************************************/  
        //logical validations 2
        //checking online payment has been done or not for each patta
        //checking oFFline payment has been done or not for each patta
        //checking pending cfr pages before initiating transaction 
        //checking pending patta payment before initiating a transaction 
        $this->db  = $this->load->database('rtpsmb', TRUE);
        foreach ($pageDetails as $detail) 
        {      
            $ekhajana_mouzadar_cfr_payments_q = $this->db->query("select * from ekhajana_mouzadar_cfr_payments
            where cfr_page_no=? and gras_status in ('P','Y')", array($detail['pageNumber']));     
            if($ekhajana_mouzadar_cfr_payments_q->num_rows() > 0){
                $msg = "CFR Page No ".$detail['pageNumber']." is Already Initiated For Payment. Kindly Complete The Transaction For This Page Before Going For This Transaction";
                show_error($msg, 400, 'Validation Error');
                return;
            }
            $patta_details = $this->db->query("select * from ekhajana_mouzadar_cfr_records where dist_code=?
                             and subdiv_code=? and cir_code=? and mouza_pargona_code=? and cfr_page_no=?",
                             array($_POST['dist_code'], $_POST['subdiv_code'], $_POST['cir_code'], 
                             $_POST['mouza_pargona_code'], $detail['pageNumber']))->result();
            
            foreach($patta_details as $patta_detail){
                if($patta_detail->digital_payment_status == 'Y'){                    
                    $msg = "Patta No '.$patta_detail->patta_no.' is already paid(Offline) in the Selected Cfr Pages. Kindly Contact Admin For This Transaction";
                    show_error($msg, 400, 'Validation Error');
                    return;
                }
                $ekhajana_commision_details_payment_q = $this->db->query("select * from ekhajana_commission_details where 
                            dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=? and lot_no=? and 
                            vill_townprt_code=? and patta_type_code=? and patta_no=? and status=?", array($_POST['dist_code'], 
                            $_POST['subdiv_code'], $_POST['cir_code'], $_POST['mouza_pargona_code'], 
                            $_POST['lot_no'], $_POST['vill_townprt_code'], $_POST['patta_type_code'],
                            $_POST['patta_no'],'F'));
                if($ekhajana_commision_details_payment_q->num_rows() > 0){
                    $msg = "Patta No '.$patta_detail->patta_no.' is already paid(Online) in the Selected Cfr Pages. Kindly Contact Admin For This Transaction";
                    show_error($msg, 400, 'Validation Error');
                    return;
                }
            }
            
        }
        //*************************************************************/
	//creating the egras payload 
	$bank_details_query = $this->db->query("select * from ekhajana_mouzadar_account_details where dist_code=?
        and subdiv_code=? and cir_code=? and mouza_pargona_code=? and status='A'
        and mouzadar_declare_yn=? and adc_verified_yn=?", array($_POST['dist_code'],$_POST['subdiv_code'],$_POST['cir_code'],
        $_POST['mouza_pargona_code'],'Y','Y'));
        if($bank_details_query->num_rows() == 0){
            show_error('Mouzadar Bank Details Could Not Be Fetched. Kindly Contact Admin.', 400, 'Validation Error');
            return;
        }
        $mouzadar_bank_details = $bank_details_query->row(); 
        $account_code = $mouzadar_bank_details->account_code;
        //echo $account_code;exit;
        //creating department id
        $unique = rand(0,99999999); 
        $department_id = "ekhMCFR".strtotime("now").$unique;
        //generating eng address names 
        $dist_name_eng = $this->utilclass->getDistrictNameEng($_POST['dist_code']);
        $mouza_name_eng = $this->utilclass->getMouzaNameEng($_POST['dist_code'], $_POST['subdiv_code'], $_POST['cir_code'],$_POST['mouza_pargona_code']);
        $address = "DIST_".trim($dist_name_eng)."_MOUZA_".trim($mouza_name_eng);
        //payload details 
        $data['GRAS_PAY_LOAD']['action']         = GRAS_URL.'challan/views/frmgrnfordept.php';
        $data['GRAS_PAY_LOAD']['DEPT_CODE']      = "LRS";
        $data['GRAS_PAY_LOAD']['OFFICE_CODE']    = "LRS529";
        $data['GRAS_PAY_LOAD']['REC_FIN_YEAR']   = "2024-2025"; 
        $data['GRAS_PAY_LOAD']['PERIOD']         = "O";
        $data['GRAS_PAY_LOAD']['FROM_DATE']      = "01/04/2024";
        $data['GRAS_PAY_LOAD']['TO_DATE']        = "31/03/2099";
        $data['GRAS_PAY_LOAD']['TAX_ID']         = "";
        $data['GRAS_PAY_LOAD']['PAN_NO']         = "";
        $data['GRAS_PAY_LOAD']['FORM_ID']        = "";
        $data['GRAS_PAY_LOAD']['PAYMENT_TYPE']   = "01";
        $data['GRAS_PAY_LOAD']['TREASURY_CODE']  = "KAM";
        $data['GRAS_PAY_LOAD']['MAJOR_HEAD']     = "0029";
        $data['GRAS_PAY_LOAD']['AMOUNT1']        = round($_POST['treasuryAmount'],2);
        $data['GRAS_PAY_LOAD']['HOA1']           = "0029-00-101-0000-000-01";
        $data['GRAS_PAY_LOAD']['AMOUNT2']        = "";
        $data['GRAS_PAY_LOAD']['HOA2']           = "";
        $data['GRAS_PAY_LOAD']['AMOUNT3']        = "";
        $data['GRAS_PAY_LOAD']['HOA3']           = "";
        $data['GRAS_PAY_LOAD']['AMOUNT4']        = "";
        $data['GRAS_PAY_LOAD']['HOA4']           = "";
        $data['GRAS_PAY_LOAD']['AMOUNT5']        = "";
        $data['GRAS_PAY_LOAD']['HOA5']           = "";
        $data['GRAS_PAY_LOAD']['AMOUNT6']        = "";
        $data['GRAS_PAY_LOAD']['HOA6']           = "";
        $data['GRAS_PAY_LOAD']['AMOUNT7']        = "";
        $data['GRAS_PAY_LOAD']['HOA7']           = "";
        $data['GRAS_PAY_LOAD']['AMOUNT8']        = "";
        $data['GRAS_PAY_LOAD']['HOA8']           = "";
        $data['GRAS_PAY_LOAD']['AMOUNT9']        = "";
        $data['GRAS_PAY_LOAD']['HOA9']           = "";
        $data['GRAS_PAY_LOAD']['CHALLAN_AMOUNT'] = round($_POST['treasuryAmount'],2);
        $data['GRAS_PAY_LOAD']['DEPARTMENT_ID']  = $department_id;
        $data['GRAS_PAY_LOAD']['SUB_SYSTEM']     = "BASUNDHARA|".base_url('e-khazana-manual-payment-response');
        $data['GRAS_PAY_LOAD']['MULTITRANSFER']  = "Y";
        $data['GRAS_PAY_LOAD']['NON_TREASURY_PAYMENT_TYPE']  = EKHAJANA_NON_TREASURY_PAYMENT_TYPE;
        $data['GRAS_PAY_LOAD']['REMARKS']        = "e-Khajana manual CFR payment";
	    $data['GRAS_PAY_LOAD']['PARTY_NAME']     = trim($_POST['mouzadarAccountHolderName']);
        $data['GRAS_PAY_LOAD']['ADDRESS1']       = $address;
        $data['GRAS_PAY_LOAD']['ADDRESS2']       = $address;
        $data['GRAS_PAY_LOAD']['ADDRESS3']       = $address;
        $data['GRAS_PAY_LOAD']['PIN_NO']         = '781032';        
        $data['GRAS_PAY_LOAD']['MOBILE_NO']      = trim($_SESSION['mobile_no']);
	$data['GRAS_PAY_LOAD']['TOTAL_NON_TREASURY_AMOUNT'] = round($_POST['nonTreasuryAmount'],2);
	$data['GRAS_PAY_LOAD']['NON_TREASURY_ACCOUNT_CODE'] = $account_code;
        //*************************************************************/        
        //populating ekhajana databases
        $this->db  = $this->load->database('rtpsmb', TRUE);        
        $this->db->trans_begin();
        foreach ($pageDetails as $detail) 
        {            
            $insert_data_for_ekhajana_mouzadar_cfr_payments_and_transactions = [
                "department_id" =>$department_id,
                "gras_status" =>'P',
                "cfr_book_no" =>$detail['bookNumber'],
                "cfr_page_no" =>$detail['pageNumber'],
                "total_patta_in_cfr" => $detail['totalPatta'],
                "total_amount" =>round($_POST['totalAmount'],2),
                "total_treasury_amount" =>round($_POST['treasuryAmount'],2),
                "total_commission" =>round($_POST['nonTreasuryAmount'],2),
                "dist_code" =>$_POST['dist_code'],
                "subdiv_code" =>$_POST['subdiv_code'],
                "cir_code" =>$_POST['cir_code'],
                "mouza_pargona_code" =>$_POST['mouza_pargona_code'],
                "gras_payload" =>json_encode($data['GRAS_PAY_LOAD']),            
                "year" => date('Y'), 
                "doul_year" => doul_year_no,
                "created_at" => date('Y-m-d h:i:s'),                
            ];
            // echo "<pre>";
            // var_dump($insert_data_for_ekhajana_mouzadar_cfr_payments);
            // exit;
            $tstatus1 = $this->db->insert('ekhajana_mouzadar_cfr_payments', $insert_data_for_ekhajana_mouzadar_cfr_payments_and_transactions);
            if ($tstatus1!= 1)
            {
                $this->db->trans_rollback();
                log_message("error", "#EKHCFRMOU001P, Error in insert on ekhajana_mouzadar_cfr_payments table with query- ". json_encode($this->db->last_query()));                
                show_error('Some error occured, Error-Code : #EKHCFRMOU001P');
            }
            $tstatus2 = $this->db->insert('ekhajana_mouzadar_cfr_payments_transactions', $insert_data_for_ekhajana_mouzadar_cfr_payments_and_transactions);
            if ($tstatus1!= 1)
            {
                $this->db->trans_rollback();
                log_message("error", "#EKHCFRMOU001PT, Error in insert on ekhajana_mouzadar_cfr_payments_transactions table with query- ". json_encode($this->db->last_query()));                
                show_error('Some error occured, Error-Code : #EKHCFRMOU001PT');
            }
        }     
        $this->db->trans_commit();
        //*************************************************************/
        $data['_view'] = 'e_khajana/cfr_views/ekhajana_manual_cfr_egras_form';
        $this->load->view('layouts/main',$data);
    }

    public function viewDocument($ekhajana_cfr_records_id) {        
        $this->db = $this->load->database('rtpsmb', TRUE);        
        $cfr_records_query = $this->db->query("SELECT * FROM ekhajana_mouzadar_cfr_records WHERE id = ?", array($ekhajana_cfr_records_id));
    
        if ($cfr_records_query->num_rows() > 0) {
            $file_path = $cfr_records_query->row()->cfr_copy_path;
    
            // Debugging the file path
            if (!file_exists($file_path)) {
                log_message('error', "File not found: " . $file_path);
                show_404();
                return;
            }
    
            // Get file extension
            $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    
            // Set appropriate headers
            switch ($file_extension) {
                case 'pdf':
                    header('Content-Type: application/pdf');
                    break;
                case 'jpg':
                case 'jpeg':
                    header('Content-Type: image/jpeg');
                    break;
                case 'png':
                    header('Content-Type: image/png');
                    break;
                case 'gif':
                    header('Content-Type: image/gif');
                    break;
                case 'txt':
                    header('Content-Type: text/plain');
                    break;
                case 'html':
                case 'htm':
                    header('Content-Type: text/html');
                    break;
                default:
                    log_message('error', "Unsupported file type: " . $file_extension);
                    show_404();
                    return;
            }
    
            // Prevent caching
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Pragma: no-cache');
            header('Content-Length: ' . filesize($file_path));
    
            // Read and output the file
            redirect($file_path);
            exit;
        } else {
            show_404();
        }
    }
    

    public function viewSettledCfrDetails(){
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code']= $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code']= $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        //location names
        $data['district_name'] = $this->utilclass->getDistrictName($dist_code);
        $data['subdiv_name'] = $this->utilclass->getSubdivName($dist_code, $subdiv_code);
        $data['circle_name'] = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
        $data['mouza_name'] = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);        
        $data['viewData'] = $this->EkhajanaCfrModel->getSettledCfrBookAndPageDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);        
        // echo "<pre>";
        // var_dump($data['viewData']);
        // exit;
        $data['_view'] = 'e_khajana/cfr_views/settled_cfr_book_page_view_list';
        $this->load->view('layouts/main',$data);
    }

    public function viewAbortedCfrDetails(){
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code']= $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code']= $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        //location names
        $data['district_name'] = $this->utilclass->getDistrictName($dist_code);
        $data['subdiv_name'] = $this->utilclass->getSubdivName($dist_code, $subdiv_code);
        $data['circle_name'] = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
        $data['mouza_name'] = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);        
        $data['viewData'] = $this->EkhajanaCfrModel->getAbortedCfrBookAndPageDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);        
        // echo "<pre>";
        // var_dump($data['viewData']);
        // exit;
        $data['_view'] = 'e_khajana/cfr_views/aborted_cfr_book_page_view_list';
        $this->load->view('layouts/main',$data);
    }

    public function viewToBeVerifiedCfrDetails(){
        $data['dist_code'] = $dist_code = $this->session->userdata('dist_code');
        $data['subdiv_code']= $subdiv_code = $this->session->userdata('subdiv_code');
        $data['cir_code']= $cir_code = $this->session->userdata('cir_code');
        $data['mouza_pargona_code'] = $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        //location names
        $data['district_name'] = $this->utilclass->getDistrictName($dist_code);
        $data['subdiv_name'] = $this->utilclass->getSubdivName($dist_code, $subdiv_code);
        $data['circle_name'] = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
        $data['mouza_name'] = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code);        
        $data['viewData'] = $this->EkhajanaCfrModel->getToBeVerifiedCfrBookAndPageDetails($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code);        
        // echo "<pre>";
        // var_dump($data['viewData']);
        // exit;
        $data['_view'] = 'e_khajana/cfr_views/to_be_verified_cfr_book_page_view_list';
        $this->load->view('layouts/main',$data);
    }

}
?> 
