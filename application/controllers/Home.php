<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url', 'security'));
		$this->db = $this->load->database('db2',TRUE);
		$this->dbb = $this->load->database('auth', true);
		$this->load->model('ekhajana/EkhajanaDashboardModel');
		// $this->load->model('ekhajana/Nyks/NyksModel');
	}

	public function dbswitch($dist_code){
	    if($dist_code == "02"){
	        $this->db=$this->load->database('dhubri', TRUE);
	    } else if($dist_code == "05"){
	        $this->db=$this->load->database('barpeta', TRUE);
	    } else if($dist_code == "10"){
	        $this->db=$this->load->database('chirang', TRUE);
	    } else if($dist_code == "13"){
	        $this->db=$this->load->database('bongaigaon', TRUE);
	    }  else if($dist_code == "17"){
	        $this->db=$this->load->database('dibrugarh', TRUE);
	    }  else if($dist_code == "15"){
	        $this->db=$this->load->database('jorhat', TRUE);
	    }  else if($dist_code == "14"){
	        $this->db=$this->load->database('golaghat', TRUE);
	    }  else if($dist_code == "07"){
	        $this->db=$this->load->database('kamrup', TRUE);
	    }  else if($dist_code == "03"){
	        $this->db=$this->load->database('goalpara', TRUE);
	    }  else if($dist_code == "18"){
	        $this->db=$this->load->database('tinsukia', TRUE);
	    }  else if($dist_code == "12"){
	        $this->db=$this->load->database('lakhimpur', TRUE);
	    }  else if($dist_code == "24"){
	        $this->db=$this->load->database('kamrupm', TRUE);
	    }  else if($dist_code == "06"){
	        $this->db=$this->load->database('nalbari', TRUE);
	    }  else if($dist_code == "11"){
	        $this->db=$this->load->database('sonitpur', TRUE);
	    }  else if($dist_code == "16"){
	        $this->db=$this->load->database('sibsagar', TRUE);
	    }  else if($dist_code == "32"){
	        $this->db=$this->load->database('morigaon', TRUE);
	    }  else if($dist_code == "33"){
	        $this->db=$this->load->database('nagaon', TRUE);
	    }  else if($dist_code == "34"){
	        $this->db=$this->load->database('majuli', TRUE);
	    }  else if($dist_code == "21"){
	        $this->db=$this->load->database('karimganj', TRUE);
	    }  else if($dist_code == "35"){
	        $this->db=$this->load->database('biswanath', TRUE);
	    }  else if($dist_code == "36"){
	        $this->db=$this->load->database('hojai', TRUE);
	    }  else if($dist_code == "37"){
	        $this->db=$this->load->database('charaideo', TRUE);
	    }  else if($dist_code == "25"){
	        $this->db=$this->load->database('dhemaji', TRUE);
	    }  else if($dist_code == "39"){
	        $this->db=$this->load->database('bajali', TRUE);
	    }else if($dist_code == "38"){
	        $this->db=$this->load->database('ssalmara', TRUE);
	    }else if($dist_code == "08"){
	        $this->db=$this->load->database('darrang', TRUE);
	    }else if($dist_code == "auth"){
	        $this->db=$this->load->database('auth', TRUE);
	    }
	    return $this->db;
	}
 

	//checking Is Mouzadar
        function checkIsMouzadar_old(){
            $dist_code = $this->session->userdata('dist_code');
            if (in_array($dist_code, json_decode(EKHAJANA_TEHSILDARI_SYSTEM_DIST_CODES)))
            {
                    //tehsildari district
                    return ['flag'=>false, 'result'=>"Not Authorised..!.This Mouza Is Under Tehsildari System..!"];
            }
            else
            {
                    //mouzadari district
                    return ['flag'=>true, 'result'=>""];
            }
        }
    //checking Is Mouzadar
    function checkIsMouzadar(){

        $databaseExisting = $this->db;
       
        $dist_code = $this->session->userdata('dist_code');
        $subdiv_code = $this->session->userdata('subdiv_code');
        $cir_code = $this->session->userdata('cir_code');
        $mouza_pargona_code = $this->session->userdata('mouza_pargona_code');
        $this->dbswitch($dist_code);
        if (in_array($dist_code, json_decode(EKHAJANA_TEHSILDARI_SYSTEM_DIST_CODES)))
        {
            if(in_array($dist_code, json_decode(EKHAJANA_TEHSILDARI_MIXED_DIST_CODES))){
                $village_codes_arr = json_decode(EKHAJANA_TEHSILDARI_MIXED_VILLAGE_CODES);
                $village_codes = $this->convertLiteral($village_codes_arr); 
                $sql = "Select uuid from location where dist_code ='$dist_code' and subdiv_code ='$subdiv_code' and cir_code='$cir_code' and mouza_pargona_code ='$mouza_pargona_code'
                and lot_no!='00' and vill_townprt_code!='00000' and uuid in ($village_codes)";
                $query = $this->db->query($sql);
                echo $this->db->last_query(); 
                if($query->num_rows()<= 0){
                    $this->db = $databaseExisting;
                    return ['flag'=>false, 'result'=>"Not Authorised..!.This Mouza Is Under Tehsildari System..!"];    
                }else{
                    //mouzadari village
                    $this->db = $databaseExisting;
                    return ['flag'=>true, 'result'=>""];
                }        
            }else{
                //tehsildari district
                $this->db = $databaseExisting;
                return ['flag'=>false, 'result'=>"Not Authorised..!.This Mouza Is Under Tehsildari System..!"];
            }
                                    
        }
        else
        {
            //mouzadari district
            $this->db = $databaseExisting;            
            return ['flag'=>true, 'result'=>""];                
        }

    }

	public function dashboard()
	{
		if($this->session->userdata('designation')== NYKS_VOLUNTEER){
			$unique_user_code = $this->session->userdata('unique_user_id');
			$data['nyks_registered_applications'] = $this->NyksModel->allRegisteredApplications($unique_user_code);
			$data['nyks_disposed_applications'] = $this->NyksModel->allDisposedApplications($unique_user_code);
			$data['nyks_rejected_applications'] = $this->NyksModel->allRejectedApplications($unique_user_code);
			$data['_view'] = 'e_khajana/nyks/index';
			$this->load->view('layouts/main',$data);
			return;
			
		}
		if($this->session->userdata('designation')==MOUZADAR_USERCODE){
			$mouzadarflag = $this->checkIsMouzadar();
			if(!$mouzadarflag['flag']){
				$data['errorMessage'] = $mouzadarflag['result'];
				$data['_view'] = 'e_khajana/mouzadar_error_page';
		    	        $this->load->view('layouts/main',$data);
				return;
			}
  			
			$data['all_applications'] = $this->EkhajanaDashboardModel->allApplications();
			$data['pending_applications'] = $this->EkhajanaDashboardModel->allPendingApplications();
			$data['disposed_applications'] = $this->EkhajanaDashboardModel->allDisposedApplications();
			$data['reverted_applications'] = $this->EkhajanaDashboardModel->allRevertedApplications();

			$data['count'] = $this->EkhajanaDashboardModel->getCountByDate();
				
			if(count($data['count'])!=0){	
				foreach ($data['count'] as $value_ind) {
					$date_array[] = $value_ind->created_at;
					$ekhajana_count[] = $value_ind->count;
				}
			}else{
					$date_array[]= '';
					$ekhajana_count[] = '';
			}
                   	
			$data['date_array'] = $date_array;
            $data['ekhajana_count'] = $ekhajana_count;			
			$data['_view'] = 'e_khajana/mouz_views/mouzadar_dashboard';
			$this->load->view('layouts/main',$data);

		}elseif($this->session->userdata('designation') == GBURA){


			$query = $this->db->query('SELECT statewise_json,created_at FROM ilrms_dashboard_records 
			WHERE application_id=?', array(DHARITREE));

			$data['mouza_list'] = null;
			if($this->session->userdata('designation') == GBURA){

				$dist_code = $this->session->userdata('dist_code'); 
				$subdiv_code = $this->session->userdata('subdiv_code'); 
				$cir_code = $this->session->userdata('cir_code'); 

				$mouzasql = $this->db->query('select dist_code, subdiv_code, cir_code, mouza_pargona_code, loc_name from location where dist_code = ? and subdiv_code = ? and cir_code = ? and mouza_pargona_code != ? and lot_no = ? GROUP BY dist_code, subdiv_code, cir_code, mouza_pargona_code, loc_name', array($dist_code, $subdiv_code, $cir_code, '00', '00'));

				$data['mouza_list'] = $mouzasql->result();
			}

			$data['state'] = $query->result();
			$data['token'] = $this->getTokenforDashboard();

			$unique_user_id = $this->session->userdata('unique_user_id');
			$data['check_auth'] = false;

			$check_auth_sql = $this->db->query('select * from depart_users where unique_user_id = ? and auth_type is not null and auth_reff is not null', array($unique_user_id));

			if($check_auth_sql->num_rows() > 0){
				$data['check_auth'] = true;
			}

			$data['users_row'] = $check_auth_sql->row();

			$data['_view'] = 'gaonBura/gaonBuraDash';
			$this->load->view('layouts/main',$data);
		}
		else{
            $query = $this->db->query('SELECT statewise_json,created_at FROM ilrms_dashboard_records 
				WHERE application_id=?', array(DHARITREE));

			$data['mouza_list'] = null;
			if($this->session->userdata('designation') == GBURA){

				$dist_code = $this->session->userdata('dist_code'); 
				$subdiv_code = $this->session->userdata('subdiv_code'); 
				$cir_code = $this->session->userdata('cir_code'); 

				$mouzasql = $this->db->query('select dist_code, subdiv_code, cir_code, mouza_pargona_code, loc_name from location where dist_code = ? and subdiv_code = ? and cir_code = ? and mouza_pargona_code != ? and lot_no = ? GROUP BY dist_code, subdiv_code, cir_code, mouza_pargona_code, loc_name', array($dist_code, $subdiv_code, $cir_code, '00', '00'));

				$data['mouza_list'] = $mouzasql->result();
			}

			$data['state'] = $query->result();
			$data['_view'] = 'dashboard/dashboard';
            $data['token'] = $this->getTokenforDashboard();
			$this->load->view('layouts/main',$data);
        }
	}

	//********** API for Dashboard ************//
//     public function dashboardAPIPort()
//     {
// 		$dist_code = array();
// 		$dist_code[] = '02'; ///dhubri
// 		$dist_code[] = '03'; //goalpara
// 		$dist_code[] = '05'; //barpeta
// 		$dist_code[] = '06'; //nalbari
// 		$dist_code[] = '07'; //kamrup
// 		$dist_code[] = '08'; //darrang
// 		$dist_code[] = '10'; //chirang
// 		$dist_code[] = '11'; //sonitpur
// 		$dist_code[] = '12'; //lakhimpur
// 		$dist_code[] = '13'; //bongaigaon
// 		$dist_code[] = '14'; //golaghat
// 		$dist_code[] = '15'; //jorhat
// 		$dist_code[] = '16'; //sibsagar
// 		$dist_code[] = '17'; //dibrugarh
// 		$dist_code[] = '18'; //tinsukia
// 		$dist_code[] = '21'; //karimganj
// 		$dist_code[] = '24'; //kamrupM
// 		$dist_code[] = '25'; //dhemaji
// 		$dist_code[] = '32'; //morigaon
// 		$dist_code[] = '33'; //nagaon
// 		$dist_code[] = '34'; //majuli
// 		$dist_code[] = '35'; //biswanath
// 		$dist_code[] = '36'; //hojai
// 		$dist_code[] = '37'; //charaideo
// 		$dist_code[] = '38'; //south salmara
// 		$dist_code[] = '39'; //bajali

//         $total_state_dag = null;
//         $total_state_patta = null;

//         $total_state_land_class = null;
//         $total_state_land_area = null;

//         $total_state_dag_lessa = null;

//         $circle_wise_patta = array();
//         $circle_wise_dag = array();

//         $bigha=$katha=$lessa=$ganda=$kranti=0;

//         $c_bigha=$c_katha=$c_lessa=$c_ganda=$c_kranti=0;

//         foreach ($dist_code as $d) {
//             $this->dbswitch($d);
//             $application_id = '01';

//             //******** Dag *********//
//             $sql = "select count(*) as dag, sum(dag_area_b) as bigha,
//             sum(dag_area_k) as katha,sum(dag_area_lc) as lessa, 
//             sum(dag_area_g) as ganda,sum(dag_area_kr) as kranti
//             from chitha_basic";
//             $res = $this->db->query($sql)->row_array();
//             $total_state_dag = $total_state_dag + $res['dag'];
//             $bigha += $res['bigha'];
//             $katha += $res['katha'];
//             $lessa += $res['lessa'];
//             $ganda += $res['ganda'];
//             $kranti += $res['kranti'];

//             //*** total lessa ******//
//             $total_district_dag_lessa = null;
//             $total_district_dag_lessa = $this->Total_Lessa($bigha,$katha,$lessa);
//             $total_district_dag_lessa_covert = $this->Total_Bigha_Katha_Lessa($total_district_dag_lessa);

//             $total_state_dag_lessa = $total_state_dag_lessa + $total_district_dag_lessa;

//             $district_wise_dag_array = array();
//             $district_wise_dag_array['district_code'] = $d;
//             $district_wise_dag_array['district_wise_dag'] = $res['dag'];
// //            $district_wise_dag_array['district_wise_land_class'] = $res['land_class'];
//             $district_wise_dag_array['district_wise_dag_area_bigha'] = $total_district_dag_lessa_covert[0];
//             $district_wise_dag_array['district_wise_dag_area_katha'] =  $total_district_dag_lessa_covert[1];
//             $district_wise_dag_array['district_wise_dag_area_lessa'] =  $total_district_dag_lessa_covert[2];
//             $district_wise_dag_array['district_wise_dag_area_ganda'] = $res['ganda'];
//             $district_wise_dag_array['district_wise_dag_area_kranti'] = $res['kranti'];

//             //*********** get dag chitha details upto circle *************//
//             $sql5 = "select count(*) as dag, sum(dag_area_b) as bigha,
//             sum(dag_area_k) as katha,sum(dag_area_lc) as lessa,
//             sum(dag_area_g) as ganda,sum(dag_area_kr) as kranti,
//                     dist_code,subdiv_code,cir_code from
//                     chitha_basic group by dist_code,subdiv_code,cir_code";
//             $circle_wise_dag['dag'] = $this->db->query($sql5)->result_array();

//             //******** Patta *********//
//             $sql2="Select count(t.countpatta_no) as totalpatta from
//                     (Select count(distinct(patta_no) ) as countpatta_no,
//                     count(distinct(patta_type_code) ) as countpatta_type from chitha_basic
//                     where patta_type_code  in (select type_code from patta_code where jamabandi='y')
//                group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
//                vill_townprt_code,patta_no,patta_type_code ) as t ";
//             $totalPatta=$this->db->query($sql2)->row_array();
//             $total_state_patta = $total_state_patta + $totalPatta['totalpatta'];

//             $district_patta_array = array();
//             $district_patta_array['district_code'] = $d;
//             $district_patta_array['district_wise_patta'] = $totalPatta['totalpatta'];

//             $district_wise_array_merge[$application_id.$d] = array_merge($district_wise_dag_array,$district_patta_array);

//             //*********** get patta chitha details upto circle *************//
//             $sql4 = "Select count(t.patta_no) as totalpatta,t.dist_code,t.subdiv_code,t.cir_code from
//                     (Select distinct(patta_no)  as patta_no,dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
//                vill_townprt_code,patta_type_code from chitha_basic
//                     where patta_type_code  in (select type_code from patta_code where jamabandi=?)
//                group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
//                vill_townprt_code,patta_no,patta_type_code ) AS t  GROUP BY t.dist_code,t.subdiv_code,t.cir_code";
//             $circle_wise_patta['patta'] = $this->db->query($sql4,array('y'))->result_array();

//             $circle_wise_array_merge[$application_id.$d] = array_merge($circle_wise_dag,$circle_wise_patta);
//         }
//         $total_state_dag_conver = $this->Total_Bigha_Katha_Lessa($total_state_dag_lessa);

//         //**** State Wise Dag *****//
//         $total_state_dag_array = array();
//         $total_state_dag_array['total_state_dag'] = $total_state_dag;
//         $total_state_dag_array['total_state_area_bigha'] = $total_state_dag_conver[0];
//         $total_state_dag_array['total_state_area_katha'] = $total_state_dag_conver[1];
//         $total_state_dag_array['total_state_area_lessa'] = $total_state_dag_conver[2];

// //        $total_state_dag_array['total_state_land_area'] = $total_state_land_area;
// //        $total_state_dag_array['total_state_land_class'] = $total_state_land_class;


//         //**** State Wise Patta *****//
//         $total_state_patta_array = array();
//         $total_state_patta_array['total_state_patta'] = $total_state_patta;

//         $json = array();
//         //***** DAG & PATTA *****//
//         $json['total_state'] = array_merge($total_state_dag_array,$total_state_patta_array);
//         $json['district_wise']= $district_wise_array_merge;
//         $json['circle_wise'] = $circle_wise_array_merge;

//         echo json_encode($json);
//         return;
//     }

//     function Total_Lessa($bigha, $katha, $lessa) {
//         $total_lessa = $lessa + ($katha * 20) + ($bigha * 100);
//         return $total_lessa;
//     }

//     function Total_Bigha_Katha_Lessa($total_lessa) {
//         $bigha = $total_lessa / 100;
//         $rem_lessa = fmod($total_lessa, 100);
//         $katha = $rem_lessa / 20;
//         $r_lessa = fmod($rem_lessa, 20);
//         $mesaure = array();
//         $mesaure[].=floor($bigha);
//         $mesaure[].=floor($katha);
//         $mesaure[].=$r_lessa;
//         return $mesaure;
//     }

    function dashboardAPICurl(){
	    //$url = 'http://localhost/ilrmsdashboard/dashboard-api';
	    $url = base_url().'dashboard-api';
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    $output = curl_exec($ch);
	    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    curl_close($ch);
	    $data = json_decode($output);

	    $state_wise = json_encode($data->total_state);
	    $district_wise = json_encode($data->district_wise);
	    $cirlce_wise = json_encode($data->circle_wise);

		//insert into table ilrms_dashboard_records
		$insertIntoMisDagCount = [
			'application_id' => DHARITREE,
			'statewise_json' => $state_wise,
			'districtwise_json' => $district_wise,
			'circlewise_json' => $cirlce_wise,
			// 'lotwise_json' => $lot_data,
			// 'villagewise_json' => $vill_data,
			// 'pending_with_dc_json' => $pending_with_dc,
			// 'pending_with_adc_json' => $pending_with_dc,
			// 'pending_with_co_json' => $pending_with_co,
			// 'pending_with_lm_json' => null,
			// 'pending_with_sk_json' => null,
			// 'pending_with_ast_json' => null,
			'created_at' => date('Y-m-d h:i:s'),
		];
		$ins = $this->db->insert('ilrms_dashboard_records', $insertIntoMisDagCount);
	    
	}
   public function getTokenforDashboard(){
      $secretKey = "ilrms";
      $userData = array();
      $userData['user_code'] = $this->session->userdata('user_code');
      $userData['name'] = $this->session->userdata('name');
      $userData['designation'] = $this->session->userdata('designation');
      $userData['date_of_joining'] = $this->session->userdata('date_of_joining');
      $userData['unique_user_id'] = $this->session->userdata('unique_user_id');
      $userData['first_login'] = $this->session->userdata('first_login');
      $userData['mobile_no'] = $this->session->userdata('mobile_no');
      $userData['email'] = $this->session->userdata('email');
      $userData['address'] = $this->session->userdata('address');
      $userData['dist_code'] = $this->session->userdata('dist_code');
      $userData['subdiv_code'] = $this->session->userdata('subdiv_code');
      $userData['cir_code'] = $this->session->userdata('cir_code');
      $userData['mouza_pargona_code'] = $this->session->userdata('mouza_pargona_code');
      $userData['logged_in'] = $this->session->userdata('logged_in');
      $jwtobj = new JWT();
      $jwt = $jwtobj->encode($userData, $secretKey, 'HS256');
      return $jwt;
  }
    function convertLiteral($array) {
        $index = 0;
        $final_str = '';
        foreach($array as $a)
        {
            if ($index == 0)
                $final_str = "'".$a."'";
            else
                $final_str = $final_str.",'". $a."'";
                $index++;
        }
        return $final_str;
    }

	public function getLots(){
		$loc_concat = $this->input->post('loc_concat');
		$parts = explode("_", $loc_concat);

		$dist_code = $parts[0];
		$subdiv_code = $parts[1];
		$cir_code = $parts[2];
		$mouza_pargona_code = $parts[3];

		$sql = $this->db->query('select dist_code, subdiv_code, cir_code, mouza_pargona_code, lot_no, loc_name from location where dist_code = ? and subdiv_code = ? and cir_code = ? and mouza_pargona_code = ? and lot_no != ? and vill_townprt_code = ? GROUP BY dist_code, subdiv_code, cir_code, mouza_pargona_code, lot_no, loc_name', array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, '00', '00000'));

		if($sql->num_rows() <= 0){
			echo json_encode([
				'responseType' => 0,
				'msg' => '#ERR433: Unable to get lot list!',
			]);
			return false;
		}

		echo json_encode([
			'responseType' => 2,
			'data' => $sql->result(),
		]);

	}

	public function getVillages(){
		$loc_concat = $this->input->post('loc_concat');
		$parts = explode("_", $loc_concat);

		$dist_code = $parts[0];
		$subdiv_code = $parts[1];
		$cir_code = $parts[2];
		$mouza_pargona_code = $parts[3];
		$lot_no = $parts[4];

		$sql = $this->db->query('select dist_code, subdiv_code, cir_code, mouza_pargona_code, lot_no, vill_townprt_code, loc_name from location where dist_code = ? and subdiv_code = ? and cir_code = ? and mouza_pargona_code = ? and lot_no = ? and vill_townprt_code != ? GROUP BY dist_code, subdiv_code, cir_code, mouza_pargona_code, lot_no, vill_townprt_code, loc_name', array($dist_code, $subdiv_code, $cir_code, $mouza_pargona_code, $lot_no, '00000'));

		if($sql->num_rows() <= 0){
			echo json_encode([
				'responseType' => 0,
				'msg' => '#ERR433: Unable to get lot list!',
			]);
			return false;
		}

		echo json_encode([
			'responseType' => 2,
			'data' => $sql->result(),
		]);

	}

}
