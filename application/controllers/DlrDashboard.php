<?php
class DlrDashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->helper(array('form', 'url'));
    }
   
   function indexCount(){
        $url = API_LINK_MB2."getCountByDistrict" ;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $output = curl_exec($ch);
        
        curl_close($ch);
        $district['output'] =$output= json_decode($output);
        // var_dump($output->data1[0]->disposed);
        // exit;


        foreach ($output->data2 as $districtData) {
            if($districtData->total!='0'){
            $disposedPercentage = (intval($districtData->disposed) / intval($districtData->total)) * 100;
            //  var_dump($disposedPercentage);

            // $disposedPercentages[] = ["district" => $districtData->district, "disposedPercentage" => $disposedPercentage];

            $disposedPercentages[] = ["output" => $districtData, "disposedPercentage" => $disposedPercentage];

            }
        }

        // Sort the array in ascending order based on disposed percentage
        usort($disposedPercentages, function ($a, $b) {
            return $a["disposedPercentage"] <=> $b["disposedPercentage"];
        });

        $district['disposedPercentages']=$disposedPercentages;

        $totDispose=round((intval($output->data1[0]->disposed) / intval($output->data1[0]->total)) * 100);
        $district['datas']=$totDispose;

        $totPending=round((intval($output->data1[0]->pending) / intval($output->data1[0]->total)) * 100);
        $district['datas1']=$totPending;

        $district['alldata']=$output->data1[0];

    
        $district['_view'] = 'dlrdashboard/settlement_cases_count_dist';
        $this->load->view('layouts/main',$district);

   }

   function indexCountService(){
        $url = API_LINK_MB2."getCountByDistrictService1" ;        
        $output = $this->callApi($url);
        if ($output==null) 
        {
            echo "<div style='background-color: red; color:white;'> Unable to load data from api</div>";
            return;
        }

        $key_values = array_column($output->data2, 'total'); 
        array_multisort($key_values, SORT_DESC, $output->data2);
        $district['output']=$output;

        $totPentenant=round((intval($output->data1[0]->total_pending_tenant) / intval($output->data1[0]->total)) * 100);

        $totPenAp=round((intval($output->data1[0]->total_pending_ap) / intval($output->data1[0]->total)) * 100);
        $totPenTribal=round((intval($output->data1[0]->total_pending_tribal) / intval($output->data1[0]->total)) * 100);
        $totPenKhas=round((intval($output->data1[0]->total_pending_khas) / intval($output->data1[0]->total)) * 100);
        $totPenPgr=round((intval($output->data1[0]->total_pending_pgr) / intval($output->data1[0]->total)) * 100);
        $totPenCult=round((intval($output->data1[0]->total_pending_cultivator) / intval($output->data1[0]->total)) * 100);

        $totPenpercent[] = ["totPenAp" => $totPenAp, "totPenTribal" => $totPenTribal, "totPentenant" => $totPentenant, "totPenKhas" => $totPenKhas, "totPenPgr" => $totPenPgr, "totPenCult" => $totPenCult ];

        $district['datas']=$totPenpercent;


        $district['alldata']=$output->data1[0];

    
        //$district['_view'] = 'dlrdashboard/settlement_cases_count_dist_service';
        echo $this->load->view('dlrdashboard/settlement_cases_count_dist_service',$district,TRUE);
        //return view('layouts/main',$district);
   }

   function indexCountServiceUser(){
        $url = API_LINK_MB2."getCountByDistrictByUser" ;
        $output = $this->callApi($url);
        if ($output==null) 
        {
            echo "<div style='background-color: red; color:white;'> Unable to load data from api</div>";
            return;
        }

        $key_values = array_column($output->data2, 'total'); 
        array_multisort($key_values, SORT_DESC, $output->data2);
        $district['output']=$output;

        $totDC=round((intval($output->data1[0]->dc) / intval($output->data1[0]->total)) * 100);

        $totADC=round((intval($output->data1[0]->adc) / intval($output->data1[0]->total)) * 100);
        $totSDO=round((intval($output->data1[0]->sdo) / intval($output->data1[0]->total)) * 100);
        $totCO=round((intval($output->data1[0]->co) / intval($output->data1[0]->total)) * 100);
        $totLRA=round((intval($output->data1[0]->lm) / intval($output->data1[0]->total)) * 100);
        $totDept=round((intval($output->data1[0]->dpt) / intval($output->data1[0]->total)) * 100);

        $totPenpercent[] = ["totDC" => $totDC, "totADC" => $totADC, "totSDO" => $totSDO, "totCO" => $totCO, "totLRA" => $totLRA, "totDept" => $totDept ];

        $district['datas']=$totPenpercent;


        $district['alldata']=$output->data1[0];
    
        //$district['_view'] = 'dlrdashboard/settlement_cases_count_user_service';
        // $this->load->view('layouts/main',$district);
        echo $this->load->view('dlrdashboard/settlement_cases_count_user_service',$district, TRUE);
   }

    function indexCountCircle(){
        $url = API_LINK_MB2."getCountByCircle" ;
        $output = $this->callApi($url);
        if ($output==null) 
        {
            echo "<div style='background-color: red; color:white;'> Unable to load data from api</div>";
            return;
        }

        $key_values = array_column($output, 'pending'); 
        array_multisort($key_values, SORT_DESC, $output);
        $district['output']=$output;
    
        //$district['_view'] = 'dlrdashboard/settlement_cases_count_circle';
        // $this->load->view('layouts/main',$district);
        echo $this->load->view('dlrdashboard/settlement_cases_count_circle',$district,TRUE);
   }

   function indexCountCircleService(){
        $url = API_LINK_MB2."getCountByCircleService" ;
        $output = $this->callApi($url);
        if ($output==null) 
        {
            echo "<div style='background-color: red; color:white;'> Unable to load data from api</div>";
            return;
        }

        $key_values = array_column($output, 'total'); 
        array_multisort($key_values, SORT_DESC, $output);
        $district['output']=$output;
    
        //$district['_view'] = 'dlrdashboard/settlement_cases_count_circle_service';
        // $this->load->view('layouts/main',$district);
        echo $this->load->view('dlrdashboard/settlement_cases_count_circle_service',$district, TRUE);

   }
   function indexCountSdlac(){        
        $url = API_LINK_MB2."getSdlacMeetingByDistrictJson" ;
        $output = $this->callApi($url);
        if ($output==null) 
        {
            echo "<div style='background-color: red; color:white;'> Unable to load data from api</div>";
            return;
        }
        $key_values = array_column($output, 'total_meeting'); 
        array_multisort($key_values, SORT_DESC, $output);
        $district['output']=$output;
        //var_dump($output);
    
        // $district['_view'] = 'dlrdashboard/settlement_sdlac_district';
        // $this->load->view('layouts/main',$district);
        echo $this->load->view('dlrdashboard/settlement_sdlac_district',$district, TRUE);
   }
   function callApi($url,$param_array=null)
   {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpcode != 200 || $output == null)
        {   
            return null;
        }
        curl_close($ch);
        $output= json_decode($output);
        return $output;
   }

    function downloadExcelReport($filename, $result_array)
    {
        require_once 'application/libraries/Xlsxwriter.class.php';
        ini_set('display_errors', 1);
        ini_set('log_errors', 1);
        // var_dump($result_array[0]);
        //$head_array[] = array_keys($result_array[0]);
        foreach ($result_array[0] as $key => $head) {
            $final_head[$key] = 'string';
        }
        $styles1 = array(
            'font' => 'Arial', 'font-size' => 14, 'font-style' => 'bold', 'fill' => '#FFFF00',
            'halign' => 'center', 'border' => 'left,right,top,bottom'
        );
        $styles7 = array('border' => 'left,right,top,bottom');
        header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        //header("Content-Type: application/vnd.ms-excel");
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        ob_clean();
        $writer = new XLSXWriter();
        $writer->setAuthor('Dharitree');
        $writer->writeSheetHeader('Sheet1', $final_head, $styles1);
        foreach ($result_array as $row)
            $writer->writeSheetRow('Sheet1', (array)$row, $styles7);
        ob_end_clean();
        $writer->writeToStdOut();
        exit(0);
    }


    function partialPaymentDayWise(){
        $this->db  = $this->load->database('rtpsmb', TRUE);
        $result_array = $this->db->query("select CURRENT_DATE as date, sum(paid_installment_amount) as amount_received from settlement_installment where status='Y'
        and CURRENT_DATE=installment_payment_received_date")->result_array();
        $this->downloadExcelReport("settlement_partial_payment_amount.xlsx", $result_array);
    }
}

