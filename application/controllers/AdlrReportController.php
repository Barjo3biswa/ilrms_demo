<?php
class AdlrReportController extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('AdlrReportModel');
    $this->db = $this->load->database('db2', TRUE);
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

public function reports()
    {
         $data = array();
            $data['_view'] = 'Department/reports';
            $this->load->view('layouts/main', $data);
    }


    public function viewReportDetails(){
      $dist_code   = $this->input->post('dist_code');
      $subdiv_code = $this->input->post('subdiv_code');
      $cir_code = $this->input->post('cir_code');
      $data = array();
      $data['dist_code'] =$dist_code;
      $data['subdiv_code'] =$subdiv_code;
      $data['cir_code'] =$cir_code;

        $this->db2 =  $this->dbswitch2($dist_code);

        $data['villageList'] = $this->AdlrReportModel->getVillageList($this->db2,$dist_code,$subdiv_code,$cir_code);
        $data['status'] = true;
        $this->load->view('Department/village_list',$data);
	}


public function getVillageList() {
    $json = null;

    $draw = intval($this->input->post('draw'));
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');

    $dist_code = $this->input->post('dist_code');
    $subdiv_code = $this->input->post('subdiv_code');
    $cir_code = $this->input->post('cir_code');

    $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

    $this->db2 =  $this->dbswitch2($dist_code);

    $village_list = $this->AdlrReportModel->getVillageListDetails($this->db2,$start, $length, $order,$dist_code,$subdiv_code,$cir_code,$searchByCol_0);

    if(!empty($village_list)) {

      if($village_list['total_records'] >  0){

        $data_rows = $village_list['data_results'];

        foreach($data_rows as $row) {

            $url = base_url('AdlrReportController/downloadAdlrReport');
            $url .= '?dist_code=' . urlencode($dist_code);
            // $url .= '&subdiv_code=' . urlencode($subdiv_code);
            $url .= '&vill_uuid=' . urlencode($row->uuid);

            $view_report = "<a href='".$url."' class='btn btn-sm btn-primary' target='_villageReport'><i class='fa fa-download'></i> &nbsp;Download Report</a>";

            $button = $view_report;
          
            $json[] = array(
              '<span class="text-primary"> '. $row->locname_eng .' </span>' . '<small class="text-danger">( '. $row->loc_name .' )</small>',
              '<strong class="text-primary"> '. $button .'</strong>',
              $button,
            );
        }
      }
      else {
        $json = "";
      }      
      
      $total_records = $village_list['total_records'];

      $response = array(
        'draw'              => $draw,
        'recordsTotal'      => $total_records,
        'recordsFiltered'   => $total_records,
        'data'              => $json
      );
      echo json_encode($response);
    }
    else
    {
      $response = array();
      $response['sEcho']=0;
      $response['iTotalRecords']=0;
      $response['iTotalDisplayRecords']=0;
      $response['aaData']=[];
      echo json_encode($response);
    }
  }


	public function getCircleJson($distcode) {

        $this->db2 =  $this->dbswitch2($distcode);

        $data = $this->AdlrReportModel->getCircleByDistJSON($this->db2,$distcode);
        $json = array();
        foreach ($data as $object) {
            $json[] = array('loc_name' => $object->loc_name, 'cir_code' => $object->cir_code, 'subdiv_code' => $object->subdiv_code);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    public function downloadAdlrReport()
    {
        $dist_code = $this->input->get('dist_code');
        $vill_uuid = $this->input->get('vill_uuid');

        $file_name = "Village_Report_" . $vill_uuid . ".xlsx";
        $this->db2 =  $this->dbswitch2($dist_code);

        // $sql ="select uuid,dag_no as Dag_No,dag_area_b as Area_Bigha,dag_area_k as Area_Katha,dag_area_lc as Area_Lessa,patta_type_code as Patta_Type, string_agg(pdar_name||'-'||pdar_father,',') as Pattadar, land_class_code from chitha_data where uuid=?
        //           group by uuid,dag_no,dag_area_b,dag_area_k,dag_area_lc,patta_type_code,land_class_code";

            $sql = "select 
            (Select loc_name from location where uuid=t.uuid) as village,
            dag_no,
            concat(dag_area_b ||'B-'||dag_area_k||'K-'||dag_area_lc ||'L') plot_area,
            string_agg(pdar_name||'('||pdar_father ||')',', ') as owner_name,
            (select land_type from landclass_code where class_code=t.land_class_code) classification_of_land,
            'NA' as no_of_crop,'NA' as season,'NA' as crop_type,'NA' as irrigation_status
            from chitha_data t where uuid=?
            group by uuid,dag_no,dag_area_b,dag_area_k,dag_area_lc,land_class_code";

        $result = $this->db2->query($sql,array($vill_uuid));

        if($result->num_rows() <= 0)
        {
          echo "No Data Found";
          return;
        }
        $data = $result->result_array();

        $this->AdlrReportModel->downloadExcelReport($file_name, $data);
    }


    //////////////////////////////////////////////////////////////////////////////////////////

    public function adlrReportList()
    {
      $route_name = $this->uri->segment(1);
      $data = array();

      if($route_name == "village-type-list")
      {
          $data['page_title'] = "Village Type List";
      }
      if($route_name == "patta-type-list")
      {
          $data['page_title'] = "Patta Type List";
      }
      if($route_name == "landclass-type-list")
      {
          $data['page_title'] = "Land Class Type List";
      }
      $data['route_name'] = $route_name;
      $data['_view'] = 'Department/ilrms_report_list';
      $this->load->view('layouts/main', $data);
    }


    public function viewIlrmsReportDetails(){
      $dist_code   = $this->input->post('dist_code');
      $route_name   = $this->input->post('route_name');

      $data = array();
      $data['dist_code'] =$dist_code;

      if($route_name == "village-type-list")
      {
          $data['th_title'] = "Village Type";
      }
      if($route_name == "patta-type-list")
      {
          $data['th_title'] = "Patta Type";
      }
      if($route_name == "landclass-type-list")
      {
          $data['th_title'] = "Land Class Type";
      }

        $this->db2 =  $this->dbswitch2($dist_code);

        $data['status'] = true;
        $data['route_name'] = $route_name;
        $this->load->view('Department/report_list_details',$data);
	  }




  public function getReportListDetailsDataTable() {

    $json = null;
    $draw = intval($this->input->post('draw'));
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');

    $dist_code = $this->input->post('dist_code');

    $route_name = $this->input->post('route_name');

    $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

    $this->db2 =  $this->dbswitch2($dist_code);

    if($route_name == "patta-type-list")
    {
      $result = $this->AdlrReportModel->getPattaTypeDetails($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);
    }
    if($route_name == "landclass-type-list")
    {
      $result = $this->AdlrReportModel->getLandClassTypeDetails($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);
    }
    if($route_name == "village-type-list")
    {
      $result = $this->AdlrReportModel->getVillageTypeListDetails($this->db2,$start, $length, $order,$dist_code,$searchByCol_0);
    }


    if(!empty($result)) {

      if($result['total_records'] >  0){

        $data_rows = $result['data_results'];

        foreach($data_rows as $row) {

            if($route_name == "village-type-list")
            {
              $json[] = array(
                '<span class="text-primary"> '. $row->district .' </span>',
                '<span class="text-primary"> '. $row->circle .' </span>',
                '<span class="text-primary"> '. $row->village .' </span>' ,
                '<span class="text-primary"> '. $row->lgd_code .' </span>' ,
                '<span class="text-primary"> '. $row->mapped_as .' </span>' ,
              );
           }

           if($route_name == "landclass-type-list")
            {
              $json[] = array(
                '<span class="text-primary"> '. $row->land_type .' </span>',
                '<span class="text-primary"> '. $row->landtype_eng .' </span>',
                '<span class="text-primary"> '. $row->landcategory .' </span>',
              );
           }

            if($route_name == "patta-type-list")
            {
              $json[] = array(
                '<span class="text-primary"> '. $row->patta_type .' </span>',
                '<span class="text-primary"> '. $row->pattatype_eng .' </span>',
              );
           }

        }
      }
      else {
        $json = "";
      }      
      
      $total_records = $result['total_records'];

      $response = array(
        'draw'              => $draw,
        'recordsTotal'      => $total_records,
        'recordsFiltered'   => $total_records,
        'data'              => $json
      );
      echo json_encode($response);
    }
    else
    {
      $response = array();
      $response['sEcho']=0;
      $response['iTotalRecords']=0;
      $response['iTotalDisplayRecords']=0;
      $response['aaData']=[];
      echo json_encode($response);
    }
  }


  public function aadharSeedingDetails()
  {

		$query = $this->db->query('SELECT distinct(dist_code) FROM location order by dist_code asc');
		$dist_details = $query->result();
		$data['districts'] = $dist_details;
		$data['_view'] = 'aadhar_seeding_details_distwise';
		$this->load->view('layouts/main',$data);

  }


    public function lgdCodeList()
    {

      $route_name = $this->uri->segment(1);
      $data = array();

      if($route_name == "lgd-code-list-exist")
      {
          $data['page_title'] = "List of LGD Code Exist Location";
      }
      if($route_name == "lgd-code-not-exist")
      {
          $data['page_title'] = "List of LGD Code not Exist Location";
      }
      $data['route_name'] = $route_name;
      $data['_view'] = 'Department/lgd_code_list';
      $this->load->view('layouts/main', $data);
    }


      public function viewLgdCodeListExistDetails(){
      $dist_code   = $this->input->post('dist_code');
      $route_name   = $this->input->post('route_name');
      $data = array();
      $data['dist_code'] =$dist_code;

        $this->db2 =  $this->dbswitch2($dist_code);

        $data['status'] = true;
        $data['route_name'] = $route_name;
        $this->load->view('Department/lgd_report_details',$data);
	  }



  public function getLgdCodeExistDataTable() 
  {
    $json = null;
    $draw = intval($this->input->post('draw'));
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');

    $dist_code = $this->input->post('dist_code');
    $route_name = $this->input->post('route_name');

    $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

    $this->db2 =  $this->dbswitch2($dist_code);

    $lgd_list = $this->AdlrReportModel->getlgdCodeListReport($this->db2,$start, $length, $order,$dist_code,$searchByCol_0,$route_name);

    if(!empty($lgd_list)) {

      if($lgd_list['total_records'] >  0){

        $data_rows = $lgd_list['data_results'];

        foreach($data_rows as $row) {
          
            $json[] = array(
              '<span class="text-primary"> '. $row->dist .' </span>' ,
              '<span class="text-primary"> '. $row->circle .' </span>' ,
              '<span class="text-primary"> '. $row->village .' (  '. $row->loc_name .' )</span>' ,
              '<span class="text-primary"> '. $row->uuid .' </span>' ,
              '<span class="text-primary"> '. $row->lgd_code .' </span>' ,
            );
        }
      }
      else {
        $json = "";
      }      
      
      $total_records = $lgd_list['total_records'];

      $response = array(
        'draw'              => $draw,
        'recordsTotal'      => $total_records,
        'recordsFiltered'   => $total_records,
        'data'              => $json
      );
      echo json_encode($response);
    }
    else
    {
      $response = array();
      $response['sEcho']=0;
      $response['iTotalRecords']=0;
      $response['iTotalDisplayRecords']=0;
      $response['aaData']=[];
      echo json_encode($response);
    }
  }



    public function downloadLgdCodeListReport()
    {
        $dist_code = $this->input->get('dist_code');
        $type = $this->input->get('type');

        $file_name = "Lgd_Report_" . $type . ".xlsx";
        $this->db2 =  $this->dbswitch2($dist_code);


        if ($type == "lgd-code-list-exist") {

            $sql = "SELECT
            (SELECT locname_eng 
            FROM location 
            WHERE dist_code = t.dist_code 
              AND subdiv_code = '00') AS dist,
            
            (SELECT locname_eng 
            FROM location 
            WHERE dist_code = t.dist_code 
              AND subdiv_code = t.subdiv_code
              AND cir_code = t.cir_code 
              AND mouza_pargona_code = '00') AS circle,
            
            (SELECT locname_eng 
            FROM location 
            WHERE dist_code = t.dist_code 
              AND subdiv_code = t.subdiv_code 
              AND cir_code = t.cir_code
              AND mouza_pargona_code = t.mouza_pargona_code 
              AND lot_no = t.lot_no 
              AND vill_townprt_code = t.vill_townprt_code) AS village,
            
            loc_name,
            uuid,
            lgd_code
        FROM location t
        WHERE vill_townprt_code <> '00000'  AND lgd_code IS NOT NULL";

        } if ($type == "lgd-code-not-exist") {

            $sql = "SELECT
            (SELECT locname_eng 
            FROM location 
            WHERE dist_code = t.dist_code 
              AND subdiv_code = '00') AS dist,
            
            (SELECT locname_eng 
            FROM location 
            WHERE dist_code = t.dist_code 
              AND subdiv_code = t.subdiv_code
              AND cir_code = t.cir_code 
              AND mouza_pargona_code = '00') AS circle,
            
            (SELECT locname_eng 
            FROM location 
            WHERE dist_code = t.dist_code 
              AND subdiv_code = t.subdiv_code 
              AND cir_code = t.cir_code
              AND mouza_pargona_code = t.mouza_pargona_code 
              AND lot_no = t.lot_no 
              AND vill_townprt_code = t.vill_townprt_code) AS village,
            
            loc_name,
            uuid,
            lgd_code
        FROM location t
        WHERE vill_townprt_code <> '00000'  AND lgd_code IS  NULL";
        }

        $result = $this->db2->query($sql);

        if($result->num_rows() <= 0)
        {
          echo "No Data Found";
          return;
        }
        $data = $result->result_array();

        $this->AdlrReportModel->downloadExcelReport($file_name, $data);
    }



    public function downloadAdlrReportExcel()
    {
        $dist_code = $this->input->get('dist_code');
        $type = $this->input->get('type');

        $file_name = "Report_details_" . $type . ".xlsx";
        $this->db2 =  $this->dbswitch2($dist_code);


        if ($type == "village-type-list") {

            $sql = "select 
              (select loc_name from location where dist_code=t.dist_code and subdiv_code='00') as district,
              (select loc_name from location where dist_code=t.dist_code and subdiv_code=t.subdiv_code and cir_code=t.cir_code and mouza_pargona_code='00') as circle,
              loc_name as village,lgd_code,
              case when rural_urban='R' then 'RURAL'
                  when rural_urban='U' then  'URBAN'
                  when rural_urban='N' then 'NOT-MAPPED'
                end as mapped_as,
              nc_btad as flagged_type
              from location t where vill_townprt_code<>'00000'";

        } if ($type == "landclass-type-list") {

            $sql = "select land_type,landtype_eng,
              case when class_code_cat='01' then 'AGRI'
              when class_code_cat='02' then 'NON-AGRI'
              end as landcategory
              from landclass_code order by class_code_cat
              ";
        }
        if ($type == "patta-type-list") {

            $sql = "select patta_type,pattatype_eng from patta_code";
        }

        $result = $this->db2->query($sql);

        if($result->num_rows() <= 0)
        {
          echo "No Data Found";
          return;
        }
        $data = $result->result_array();

        $this->AdlrReportModel->downloadExcelReport($file_name, $data);
    }


    public function dagDetailsReport()
    {
         $data = array();
            $data['_view'] = 'Department/dag_details_report';
            $this->load->view('layouts/main', $data);
    }

    public function viewDagDetails()
    {
      $dist_code   = $this->input->post('dist_code');
      $subdiv_code = $this->input->post('subdiv_code');
      $cir_code = $this->input->post('cir_code');
      $data = array();
      $data['dist_code'] =$dist_code;
      $data['subdiv_code'] =$subdiv_code;
      $data['cir_code'] =$cir_code;
        $data['status'] = true;
        $this->load->view('Department/dag_details_data_view',$data);
	}


  public function getDagDetailsReportData() 
  {
    $json = null;

    $draw = intval($this->input->post('draw'));
    $start = intval($this->input->post('start'));
    $length = intval($this->input->post('length'));
    $order = $this->input->post('order');

    $dist_code = $this->input->post('dist_code');
    $subdiv_code = $this->input->post('subdiv_code');
    $cir_code = $this->input->post('cir_code');

    $searchByCol_0 = strtoupper(trim($this->input->post('columns')[0]['search']['value']));

    $this->db2 =  $this->dbswitch2($dist_code);

    $dagPattaDetails= $this->AdlrReportModel->getDagPattaDetails($this->db2,$start, $length, $order,$dist_code,$subdiv_code,$cir_code,$searchByCol_0);

    if(!empty($dagPattaDetails)) {

      if($dagPattaDetails['total_records'] >  0){

        $data_rows = $dagPattaDetails['data_results'];

        foreach($data_rows as $row) {
          
            $json[] = array(
              '<span class="text-bold"> '. $row->district .' </span>',
              '<span class="text-primary"> '. $row->circle .' </span>',
              '<span class="text-primary"> '. $row->village .' </span>',
              '<span class="text-danger text-center"> '. $row->total_urban_dags .' </span>',
              '<span class="text-primary text-right"> '. $row->total_urban_patta .' </span>',
              '<span class="text-primary text-right"> '. $row->area_in_sqkm .' </span>',
            );
        }
      }
      else {
        $json = "";
      }      
      
      $total_records = $dagPattaDetails['total_records'];

      $response = array(
        'draw'              => $draw,
        'recordsTotal'      => $total_records,
        'recordsFiltered'   => $total_records,
        'data'              => $json
      );
      echo json_encode($response);
    }
    else
    {
      $response = array();
      $response['sEcho']=0;
      $response['iTotalRecords']=0;
      $response['iTotalDisplayRecords']=0;
      $response['aaData']=[];
      echo json_encode($response);
    }
  }


}