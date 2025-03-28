<?php
class DepartmentApi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper(array('form', 'url', 'security'));
        $this->load->model('basundhara/basundharamodel');

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


    // Insert User from Dharitree
    public function postDepartmentUser()
    {
        
        log_message('error', 'UserCreationApiHitLive, posted data from dharitree'.json_encode($_POST));       
        
        $config=array(
           array('field'=>'name','label'=>'name','rules'=>'required'),
           array('field'=>'dist_code','label'=>'dist_code','rules'=>'required'),
           array('field'=>'subdiv_code','label'=>'subdiv_code','rules'=>'required'),
           array('field'=>'cir_code','label'=>'cir_code','rules'=>'required'),
           array('field'=>'mouza_pargona_code','label'=>'mouza_pargona_code','rules'=>'required'),
           array('field'=>'lot_no','label'=>'lot_no','rules'=>'required'),           
           array('field'=>'mobile_no','label'=>'mobile no','rules'=>'required'),
           array('field'=>'user_name','label'=>'user_name','rules'=>'required'),  
           array('field'=>'password','label'=>'password','rules'=>'required'),           
           array('field'=>'user_code','label'=>'user code','rules'=>'required'),   
           array('field'=>'designation','label'=>'designation','rules'=>'required'),
           array('field'=>'type','label'=>'type','rules'=>'required'),
                 
        );
        $validation= $this->form_validate($config);
        if(!empty($validation)){
           log_message("error","Validation :".json_encode($validation));
           echo json_encode(array(
              'result'=>'N',
              'msg' => json_encode($validation)
           ));        
           return;
        }

        $this->db = $this->load->database('db2', TRUE);
        $name = $_POST['name'];
        $mobile_no = $_POST['mobile_no'];
        $unique_user_id = $_POST['user_name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $dist_code = $_POST['dist_code'];
        $subdiv_code = $_POST['subdiv_code'];
        $cir_code = $_POST['cir_code'];
        $mouza_pargona_code = $_POST['mouza_pargona_code'];
        $password = $_POST['password'];
        $user_code = $_POST['user_code'];
        $designation = $_POST['designation'];
        $lot_no = $_POST['lot_no'];
        $type = $_POST['type'];

    
       	
        //checking if user already exits or not
	if($designation !=  'SDLC' || $designation !=  'NC'){ 
       		 $sql = "select count(*) as c from user_dist_byforcation u join depart_users d on u.unique_user_id::int=d.id 
                         where d.active_deactive='E' and dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?";	
            	$query = $this->db->query($sql,array($dist_code,$subdiv_code,$cir_code,$mouza_pargona_code));
        	$user_count = $query->row()->c;
        	if($user_count > 0){
                        log_message('error', '#ERRDU02: User already exists');
            		echo json_encode(['result' => 'USER_EXISTS', 'msg' => 'User Already Exists..!']);
                	exit; 
       		 }
        }

        $this->db->trans_begin();
        // Insert into depart_users
        $query = [
            'name' => $name,
            'designation' => $designation,
            'date_of_joining' => date('Y-m-d h:i:s'),
            'password' =>  hash('sha512', $password),
            'unique_user_id' => $unique_user_id,
            'active_deactive' => 'E',
            'first_login' => '0',
            'status' => 'E',
            'mobile_no' => $mobile_no,
            'email' => $email,
            'address' => $address,
            'user_code' => $user_code,
            'user_type' => $type,
        ];
        $insertUser = $this->db->insert('depart_users', $query);
        $last_insert_id = $this->db->insert_id();

        if ($insertUser <= 0) {
            $this->db->trans_rollback();
            log_message('error', '#ERRDU01: Insert failed in depart_users');
            echo json_encode(['result' => 'N', 'msg' => 'Some error occured, Error-Code : #ERRDU01']);
            exit;
        }
        // Insert into user_dist_byforcation
        $insertArr = [ 
            'unique_user_id' =>  $last_insert_id,
            'user_code' => $user_code,
            'dist_code' =>  $dist_code,
            'subdiv_code' =>  $subdiv_code,
            'cir_code' =>  $cir_code,
            'mouza_pargona_code' =>  $mouza_pargona_code,
            'lot_no' => $lot_no,
        ];
        $insertDept = $this->db->insert('user_dist_byforcation', $insertArr);
        if ($insertDept != 1) {
            $this->db->trans_rollback();
            log_message('error', '#ERRUDB01: Insertion failed in user_dist_byforcation');
	    echo json_encode(['result' => 'N', 'msg' => 'Some error occured, Error-Code : #ERRUDB01']);
            exit;
        } else {
            $this->db->trans_commit();
            $json = [
                'result' => 'Y',
                'msg' => 'User Created Successfully',
            ];
            echo json_encode($json);
        }
    }
     public function form_validate($configs){
      $this->form_validation->set_rules($configs);
      $validation =array();
      if(!$this->form_validation->run()){
        foreach($configs as $confuguration){
          log_message("error","configs".json_encode($confuguration));
          if (form_error($confuguration['field'])) {
            $validation[] = array('field' => $confuguration['field'], 'message' => form_error($confuguration['field']));
          }
        }
      }
      return $validation;
    }
    function changePasswordIlrms()
    {
        log_message('error', 'PasswordChangeApiHitLive, posted data from dharitree'.json_encode($_POST));       
        $config=array(
           array('field'=>'unique_user_id','label'=>'unique_user_id','rules'=>'required'),
           array('field'=>'password','label'=>'password','rules'=>'required'),
                 
        );
        $validation= $this->form_validate($config);
        if(!empty($validation)){
           log_message("error","Validation :".json_encode($validation));
           echo json_encode(array(
              'result'=>'N',
              'msg' => json_encode($validation)
           ));        
           return;
        }

        $unique_user_id = $_POST['unique_user_id'];
        $password = $_POST['password'];

        $this->db = $this->load->database('db2', TRUE);
        $update = [
            'password' =>  hash('sha512', $password),
            'first_login'=> 1,
            'password_change'=> date('Y-m-d H:i:s'),
        ];
        $this->db->where('unique_user_id', $unique_user_id);
        $depart_users_update = $this->db->update('depart_users', $update);

        if($this->db->affected_rows() == 1 && $depart_users_update == true)
	{
            echo json_encode(['result' => 'Y', 'msg' => 'Password Changes Successfully in ILRMS']);
	}
	else
	{
            echo json_encode(['result' => 'N', 'msg' => 'Password Changes Failed in ILRMS']);
            exit;
	}
    }
    function enableDisableAccount_old()
    {
        log_message('error', 'enableDisableApiHitLive, posted data from dharitree'.json_encode($_POST));       
        $config=array(
           array('field'=>'unique_user_id','label'=>'unique_user_id','rules'=>'required'),
           array('field'=>'is_enabled','label'=>'enable_flag','rules'=>'required'),
                 
        );
        $validation= $this->form_validate($config);
        if(!empty($validation)){
           log_message("error","Validation :".json_encode($validation));
           echo json_encode(array(
              'result'=>'N',
              'msg' => json_encode($validation)
           ));        
           return;
        }

        $unique_user_id = $_POST['unique_user_id'];
        $active_deactive = $_POST['is_enabled'];
       
        //If user to be enabled
        if ($active_deactive=='E')
        {
       	    $sql = "select * from user_dist_byforcation u join depart_users d on u.unique_user_id::int=d.id where d.unique_user_id=?";	
            $query = $this->db->query($sql,array($unique_user_id));
            if($query->num_rows()> 0)
            {
                $mouzadar = $query->row();
                if ($mouzadar->designation == 'MOU')
                {
       		   $sql = "select count(*) as c from user_dist_byforcation u join depart_users d on u.unique_user_id::int=d.id 
                         where d.active_deactive='E' and dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?";	
            	   $query = $this->db->query($sql,array($mouzadar->dist_code,$mouzadar->subdiv_code,$mouzadar->cir_code,$mouzadar->mouza_pargona_code));
                   if ($query->num_rows()>0 && $query->row()->c>0)
                   {   
                      echo json_encode(['result' => 'N', 'msg' => 'One user in specified mouza is already active. Kindly deactivate the user first']);
                      exit;
                   }
                }
            } 
        }
    
        $this->db = $this->load->database('db2', TRUE);
        $update = [
            'active_deactive'=> $active_deactive,
            'password_change'=> date('Y-m-d H:i:s'),
        ];
        $this->db->where('unique_user_id', $unique_user_id);
        $depart_users_update = $this->db->update('depart_users', $update);

        if($this->db->affected_rows() == 1 && $depart_users_update == true)
	{
            echo json_encode(['result' => 'Y', 'msg' => 'enable/disbale flag changed']);
	}
	else
	{
            echo json_encode(['result' => 'N', 'msg' => 'error in updating field']);
            exit;
	}
    }
   public function updateLocationTable()
   {
      ini_set('memory_limit', '-1');
      set_time_limit(0);
      $curl_handle = curl_init();
      curl_setopt_array($curl_handle, array(
      CURLOPT_URL => 'http://10.177.0.35/dharrtpsapi/index.php/DharRtpsApi/getAllLocations',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => FALSE,
      CURLOPT_SSL_VERIFYHOST => 2,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{        
      }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    $response = curl_exec($curl_handle);
    $httpcode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
    curl_close($curl_handle);
    $data=json_decode($response);
    $length = sizeof($data);
    //var_dump($data);
    $this->db=$this->load->database('db2',TRUE);  
    $this->db->trans_begin();
    $sql = "delete from location";
    $this->db->query($sql);    
    if ($this->db->affected_rows()<=0)
    {
       $this->db->trans_rollback();
       $response = array(
              "responseType"=>3,
              "message"=>"Uanble to delete "
        );
        echo json_encode($response);
    } 
    //$batch_array[] = array(); 
    for($index=0;$index<$length;$index++){     
      $batch_array[] = array(
          'dist_code'           =>$data[$index]->dist_code,
          'subdiv_code'         =>$data[$index]->subdiv_code,
          'cir_code'            =>$data[$index]->cir_code,
          'mouza_pargona_code'  =>$data[$index]->mouza_pargona_code,
          'lot_no'              =>$data[$index]->lot_no,
          'vill_townprt_code'   =>$data[$index]->vill_townprt_code,
          'loc_name'            =>$data[$index]->loc_name,
          'unique_loc_code'     =>$data[$index]->unique_loc_code,
          'locname_eng'         =>$data[$index]->locname_eng,
          'cir_abbr'            =>$data[$index]->cir_abbr,
          'dist_abbr'           =>$data[$index]->dist_abbr,
          'rural_urban'         =>$data[$index]->rural_urban,
          'uuid'                =>$data[$index]->uuid,
          'lgd_code'            =>$data[$index]->lgd_code,
          'village_status'      =>$data[$index]->village_status,
          'is_map'              =>$data[$index]->is_map,
          'is_gmc'              =>$data[$index]->is_gmc,
          'created_date'        =>$data[$index]->created_date,
          'updated_date'        =>$data[$index]->updated_date,
          'user_code'           =>$data[$index]->user_code,
          'status'              =>$data[$index]->status,
          'nc_btad'             =>$data[$index]->nc_btad,
          'is_periphary'        =>$data[$index]->is_periphary,
          'is_tribal'           =>$data[$index]->is_tribal,         
       );
       // $status = $this->db->insert('location',$batch_array);
       // if ($status != 1)
       // {
       //    $this->db->trans_rollback();
       //    $response = array(
       //          "responseType"=>3,
       //          "message"=>"Uanble to insert ".$this->db->last_query()
       //    );
       //    echo json_encode($response);
       //    return;
       // }
    }
    $rows = $this->db->insert_batch('location',$batch_array);
    log_message('error','btach_size='.sizeof($batch_array).'---length='.$length.'-- final_update='.$rows.'--date-'.date('Y-m-d_H-i'));    
    if ($rows!=$length)
    {
      $this->db->trans_rollback();
       $response = array(
              "responseType"=>3,
              "message"=>"Uanble to update "
        );
        echo json_encode($response);
    }
    $this->db->trans_commit();
    echo 'Location Table Updated Successfully';
    //$this->db->trans_rollback();
  }
  /*function userList()
  {
        $this->db = $this->load->database('db2', TRUE);
        $sql = "select t.unique_user_id, t.name, t.display_name,t.designation, t.user_type, t.user_code, t.date_of_joining, t.status, t.mobile_no, t.email, t.auth_reff, array_agg(t.dist_code) as districts 
                 from (select d.name, d.designation,d.display_name, d.user_type, d.user_code,d.date_of_joining,d.unique_user_id, d.status, d.mobile_no,d.email,d.auth_reff, u.dist_code  from depart_users d 
                   left join user_dist_byforcation u on d.id=u.unique_user_id::int where d.designation not in ('DEPARTMENT', 'MOUZADAR','MOU','NIC','DLR')) t 
                 group by  t.name, t.display_name, t.designation, t.user_type,t.user_code,t.date_of_joining, t.unique_user_id, t.status, t.mobile_no, t.email,auth_reff";
        $result = $this->db->query($sql)->result();
        $data['users'] = $result;
        $this->load->view('login/user_list',$data);
  }*/
  public function getDepartmentUserDetailByDist($dist_code) {

      $this->db = $this->load->database('db2', TRUE);
      $query = $this->db->query("SELECT A.name, A.mobile_no, A.unique_user_id, A.email, B.dist_code,
                                  A.auth_reff AS aadhaar_no, A.designation, B.lot_no, 
                                    A.display_name, A.user_type, A.password
                                      FROM depart_users A 
                                        JOIN user_dist_byforcation B ON A.user_code=B.user_code 
                                          WHERE B.dist_code = ?  AND A.user_type IS NOT NULL", 
                                            array($dist_code));
      echo json_encode(array(
        'rowCount'     => $query->num_rows(),
        'responseData' => $query->result_array(),
      ));
      return;
   }
   //New Enable/Disable 
   function enableDisableAccount()
   {
      log_message('error', 'enableDisableApiHitLive, posted data from dharitree'.json_encode($_POST));       
      $config=array(
        array('field'=>'unique_user_id','label'=>'unique_user_id','rules'=>'required'),
        array('field'=>'is_enabled','label'=>'enable_flag','rules'=>'required'),
        array('field'=>'dist_code','label'=>'dist_code','rules'=>'required'),
              
      );
      $validation= $this->form_validate($config);
      if(!empty($validation)){
        log_message("error","Validation :".json_encode($validation));
        echo json_encode(array(
            'result'=>'N',
            'msg' => json_encode($validation)
        ));        
        return;
      }

      $unique_user_id = $_POST['unique_user_id'];
      $active_deactive = $_POST['is_enabled'];
      $dist_code = $_POST['dist_code'];
      $this->db = $this->load->database('db2', TRUE);
      $this->db->trans_begin();

      $sql = "select id from depart_users where unique_user_id='$unique_user_id'";
      $users = $this->db->query($sql)->row();

      $user_id = $users->id;

      $sql = "select * from user_dist_byforcation u join depart_users d on u.unique_user_id::int=d.id where d.unique_user_id=?";  
      $query = $this->db->query($sql,array($unique_user_id));

    
      //If user to be enabled
      if ($active_deactive=='E')
      {
          $sql = "select * from user_dist_byforcation u join depart_users d on u.unique_user_id::int=d.id where d.unique_user_id=?";  
          $query = $this->db->query($sql,array($unique_user_id));
          if($query->num_rows()> 0)
          {
              $mouzadar = $query->row();
              if ($mouzadar->designation == 'MOU')
              {
                  $sql = "select count(*) as c from user_dist_byforcation u join depart_users d on u.unique_user_id::int=d.id 
                          where d.designation='MOU' and d.active_deactive='E' and dist_code=? and subdiv_code=? and cir_code=? and mouza_pargona_code=?"; 
                  $query = $this->db->query($sql,array($mouzadar->dist_code,$mouzadar->subdiv_code,$mouzadar->cir_code,$mouzadar->mouza_pargona_code));
                  //  echo $this->db->last_query();  
                  if ($query->num_rows()>0 && $query->row()->c>0)
                  {   
                      echo json_encode(['result' => 'N', 'msg' => 'One user in specified mouza is already active. Kindly deactivate the user first']);
                      exit;
                  }
              }
          } 
      }
      else if ($active_deactive=='D')
      {
          $sql = "select d.designation,u.unique_user_id from user_dist_byforcation u join depart_users d on u.unique_user_id::int=d.id 
                      where d.unique_user_id=?";  
          $query = $this->db->query($sql,array($unique_user_id));
          if($query->num_rows()> 0)
          {
              $sdlac = $query->row();
              if ($sdlac->designation == 'SDLC')
              {
                  $sql = "select ARRAY_agg(dist_code) as dist_codes, count(*) as c from user_dist_byforcation where unique_user_id=? group by unique_user_id";  
                  $query = $this->db->query($sql,array($sdlac->unique_user_id));
                  if ($query->num_rows()<=0)
                  {   
                    echo json_encode(['result' => 'N', 'msg' => 'No User found attached to district']);
                    exit;
                  }
                  $user_row =$query->row(); 
                  if ($user_row->c>1)
                  {
                      $update = [
                          'active_deactive'=> $active_deactive,
                          'modified_at'=> date('Y-m-d H:i:s'),
                      ];
                      $this->db->where('unique_user_id', $sdlac->unique_user_id);
                      $this->db->where('dist_code', $dist_code);
                      $status = $this->db->update('user_dist_byforcation', $update);
                      if($this->db->affected_rows() == 1 && $status == true)
                      {
                            $dist_codes = $this->convertLiteral($user_row->dist_codes);
                            $this->db->trans_commit();
                            echo json_encode(['result' => 'Y', 'msg' => 'enable/disbale flag changed',
                                                        'dist_codes'=>$dist_codes[2], 'dist_count'=>$user_row->c]);
                            exit;
                      }
                      else
                      {
                            $this->db->trans_rollback();
                            echo json_encode(['result' => 'N', 'msg' => 'error in updating field']);
                            exit;
                      }
                  }
              }
            } 
        }
  
        $update = [
            'active_deactive'=> $active_deactive,
            'password_change'=> date('Y-m-d H:i:s'),
        ];
        $this->db->where('unique_user_id', $unique_user_id);
        $depart_users_update = $this->db->update('depart_users', $update);

        if($this->db->affected_rows() != 1 || $depart_users_update != true)
        {                  
            $this->db->trans_rollback();
            echo json_encode(['result' => 'N', 'msg' => 'error in updating field']);
            exit;
        }
        $update_b = [
                      'active_deactive'=> $active_deactive,
                      'modified_at'=> date('Y-m-d H:i:s'),
                    ];
        $this->db->where('unique_user_id', $users->id);
        $this->db->where('dist_code', $dist_code);
        $status = $this->db->update('user_dist_byforcation', $update_b);
        if($this->db->affected_rows() == 1 && $status == true)
        {
            $this->db->trans_commit();
            echo json_encode(['result' => 'Y', 'msg' => 'enable/disbale flag changed',
                                          'dist_codes'=>array($dist_code), 'dist_count'=>1]);
        }
        else
        {
            $this->db->trans_rollback();
            echo json_encode(['result' => 'N', 'msg' => 'error in updating field']);
            exit;
        }
    }
    //Enable/Disable Api End
    function convertLiteral($arr)
    {
      $y = substr($arr, 1, -1);
      $z = explode(',', $y);
      $index = 0;
      $final_str = '';
      foreach($z as $a)
      {
            if ($index == 0)
              $final_str = "'".$a."'";
            else
              $final_str = $final_str.",'". $a."'";
            $index++;
      }
      //var_dump($final_str);
      return array(sizeof($z),$final_str,$z);
    }
    function updateProfile()
    {
        log_message('error', 'updateProfile, posted data from dharitree'.json_encode($_POST));       
        $config=array(
           array('field'=>'unique_user_id','label'=>'unique_user_id','rules'=>'required'),
           array('field'=>'type','label'=>'type','rules'=>'required'),
           array('field'=>'display_name','label'=>'display_name','rules'=>'required'),
                 
        );
        $validation= $this->form_validate($config);
        if(!empty($validation)){
           log_message("error","Validation :".json_encode($validation));
           echo json_encode(array(
              'result'=>'N',
              'msg' => json_encode($validation)
           ));        
           return;
        }

        $unique_user_id = $_POST['unique_user_id'];
        $password = $_POST['type'];
        $display_name = $_POST['display_name'];

        $this->db = $this->load->database('db2', TRUE);
        $update = [
            'user_type'=> $password,
            'display_name'=> $display_name,
            'password_change'=> date('Y-m-d H:i:s'),
        ];
        $this->db->where('unique_user_id', $unique_user_id);
        $depart_users_update = $this->db->update('depart_users', $update);

        if($this->db->affected_rows() == 1 && $depart_users_update == true)
	{
            echo json_encode(['result' => 'Y', 'msg' => 'Profile updated Successfully in ILRMS']);
	}
	else
	{
            echo json_encode(['result' => 'N', 'msg' => 'Profile changes Failed in ILRMS']);
            exit;
	}
    }




        //Pull Request API Update Status ILRMS 
        public function pullRequestUpdateIlrms()
        {

            $case_no = $_POST['case_no'];
            $dist_code = $_POST['dist_code'];

            if($case_no != NULL & $dist_code != NULL)
            {

                $this->db2 = $this->dbswitch2($dist_code);

                $sql = "select cab_memo_prepared from settlement_basic where case_no = ?";	
                $query = $this->db2->query($sql,array($case_no))->row();

                $memo_status = $query->cab_memo_prepared;

                if($memo_status == 2)
                {

                    echo json_encode(['result' => 'N', 'msg' => 'Pull Request Can not accepted as CAB Memo for Case No : ' .$case_no. 'Already Generated !']);

                }
                else if($memo_status == 0 || $memo_status == 1)
                {

                        $this->db = $this->load->database('db2', TRUE);
                        
                        $sql = "select count(*) as c  from cab_memo_list where case_no = ? and dist_code =?";	
                        $query = $this->db->query($sql,array($case_no,$dist_code));
                        $case_count = $query->row()->c;

                        if($case_count <= 0)
                        {
                            echo json_encode(['result' => 'Y', 'msg' => 'Case No: ' .$case_no . ' Not required to remove as not Yet Added to CAB MEMO..!']);
                        }
                        else if ($case_count > 0)
                        {

                            $sql = "select status  from cab_memo_list where case_no = ? and dist_code =?";	
                            $query = $this->db->query($sql,array($case_no,$dist_code));
                            $status = $query->row()->status;

                            $case_status = intval($status);

                            if($case_status == 2){

                                echo json_encode(['result' => 'N', 'msg' => 'Case No: ' .$case_no . ' Can not be Removed from Cab Memo List as CAB Memo Generated !!']);
                            
                            }else if($case_status == 3){

                                echo json_encode(['result' => 'N', 'msg' => 'Case No: ' .$case_no . ' Can not be Removed from Cab Memo List as it is Already Approved !!']);

                            }else{

                                $sql = "delete from cab_memo_list where case_no = ? and dist_code =? and status =?";
                                $cab_memo_list_update = $this->db->query($sql,array($case_no,$dist_code, ADD_CASES_TO_CAB_MEMO));

                                if ($this->db->affected_rows() == 1 && $cab_memo_list_update == true)
                                    {
                                    echo json_encode(['result' => 'Y', 'msg' => 'Case No: ' .$case_no . ' Removed from Cab Memo List']);
                                    }
                                else
                                    {
                                    echo json_encode(['result' => 'N', 'msg' => 'Unable to Remove Case No: ' .$case_no . ' from Cab Memo List']);
                                    }

                            }

                        }

                }

            }

        }


    function downloadRevertedCaseDetailsbyDateByDistrict()
    {   
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $result=array();
        $i=0;
        $date_after = $_GET['date'];
        // $dist_codes = ['02','03','05','06','07','08','11','12','13','14','15','16','17','18','21','24','25','32','33','34','35','36','37','38','39'];
        $dist_codes = ['07'];
        $file_name=$date_after."_reverted_report.xlsx";

        foreach($dist_codes as $d)
        {   

            $this->db2 = $this->dbswitch2($d);

            $sql="SELECT DISTINCT ON (sp.case_no)
                    sp.case_no,
                    sp.note_on_order AS Revert_Remarks,
                    CASE
                        WHEN sp.user_code = 'DEPT01' THEN 'Ashok Kr Barman'
                        WHEN sp.user_code = 'DEPT02' THEN 'Shyamal Khetra Gogoi'
                        WHEN sp.user_code = 'DEPT03' THEN 'Dipankar Das'
                        ELSE sp.user_code
                    END AS Revert_by,
                    DATE(sp.date_entry) AS Revert_Date
                FROM
                    settlement_proceeding sp
                JOIN
                    settlement_basic sb ON sp.case_no = sb.case_no
                WHERE
                    sp.office_from = 'DPT'
                    AND sp.office_to = 'DC'
                    AND date(sp.next_date_of_hearing) >= '$date_after'
                    AND sb.dept_revert =1
                    -- AND sb.service_code != '17'
                ORDER BY
                sp.case_no,
                sp.next_date_of_hearing DESC";
            
            $results=$this->db2->query($sql);
            if($results->num_rows()==0)
                continue;
            else
                $result=$results->result_array();
                foreach($result as $r){

                 $final[]=array(
                     'Ditrict'=>$this->utilclass->getDistrictNameOnLanding($d),
                     'Case_no'=>$r['case_no'],
                     'Revert_remarks'=>$r['revert_remarks'],
                     'Revert_by'=>$r['revert_by'],
                     'Revert_date'=>$r['revert_date'],
                 );
                }
        }

        $this->basundharamodel->downloadExcelReport($file_name, $final);
    }


    public function getZonalValueByDagLocation()
    {
        $location = $this->input->post('location');
        $dag_no = $this->input->post('dag_no');
        $pdar_id = $this->input->post('pdar_id');

        $parts = explode("_", $location);

        $dist_code = $parts[0];
        $subdiv_code = $parts[1];
        $cir_code = $parts[2];
        $mouza_pargona_code = $parts[3];
        $lot_no = $parts[4];
        $vill_townprt_code = $parts[5];

        $this->form_validation->set_rules('dag_no', 'Dag Number', 'required');
        $this->form_validation->set_rules('location', 'Location Details', 'required');
        $this->form_validation->set_rules('pdar_id', 'Pattadar ID', 'required');

        if ($this->form_validation->run() == FALSE || $dist_code == NULL || $location == NULL || $pdar_id == NULL) {
            echo json_encode(array(
                'responseType' => 1,
                'message' => 'Dag No and Location Details Missing.',
            ));
        }
        else 
        {
            $this->db2 = $this->dbswitch2($dist_code);

            $getZonalDetails = $this->basundharamodel->getZoneSubclassDetailsByDagLocation($subdiv_code,$cir_code,$mouza_pargona_code,$lot_no,$vill_townprt_code,$dag_no);

            if ($getZonalDetails == NULL) {
                echo json_encode(array(
                    'responseType' => 1,
                    'message' => 'Zonal Value missing for Dag no '  . $dag_no ,
                ));
            } else {

                $zone_id = $getZonalDetails->zone_id;
                $subclass_id = $getZonalDetails->subclass_id;
                $approval_status = $getZonalDetails->flag;
                $village_uuid = $getZonalDetails->unique_village_code;

                if ($approval_status == '0') {
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'Zonal Value Missing for Dag No : ' . $dag_no ,
                    ));
                } else if ($approval_status == '1') {
                    $getZonalValue = $this->basundharamodel->getZonalValueDetails($village_uuid, $zone_id, $subclass_id);


                    if ($getZonalValue == NULL) {
                        echo json_encode(array(
                            'responseType' => 1,
                            'message' => 'Zonal Value Missing for Dag No : ' . $dag_no ,
                        ));
                    } else {
                        $approval_status_villwise = $getZonalValue[0]->flag;
                        if ($approval_status_villwise == '0') {
                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'Zonal Value Missing for Dag No : ' . $dag_no ,
                            ));
                        } else if ($approval_status_villwise == '1') {
                         
                            $style = '<style type="text/css">

                                .navbar {
                                    position: relative;
                                    min-height: 20px;
                                    margin-bottom: 0px !important;
                                    border: 1px solid transparent;
                                    border-radius: 0px !important;
                                }
                                table.dataTable tbody th, table.dataTable tbody td {
                                    font-size: 1.2em !important
                                }
                                .timeline>div {
                                    margin-right: 0px !important;
                                }
                                .timeline::before {
                                    width: 0px !important;
                                }
                                .timeline__content:nth-child(odd)::before {
                                    top: 50%;
                                    left: -39px;
                                }
                                .timeline>div::after, .timeline>div::before {
                                    content: "";
                                    display: table;
                                }
                                .timeline__content::before {
                                    content: "";
                                    position: absolute;
                                    width: 20px;
                                    height: 20px;
                                    background-color: #848892;
                                    border-radius: 50%;
                                    transform: translateY(-50%);
                                }
                                .tab-content {
                                    padding: 0px!important;
                                }

                                .list-inline{
                                    padding-right: 0px!important;
                                }
                                .uni_text {
                                    font-size: 18px;
                                    line-height: 150%;
                                    font-family: Open Sans;
                                }
                                .table  {
                                    padding: 0.5rem 0.5rem;
                                    background-color: var(--bs-table-bg);
                                    border-bottom-width: 1px;
                                    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
                                }
                            </style>';
                            $cir_name = $this->utilclass->getCircleName($dist_code, $subdiv_code, $cir_code);
                            $mouza_name = $this->utilclass->getMouzaName($dist_code, $subdiv_code, $cir_code,$mouza_pargona_code);
                            $villageName = $this->utilclass->getVillageName($dist_code, $subdiv_code, $cir_code,$mouza_pargona_code,$lot_no, $vill_townprt_code);


                            $htmlTag = '<p style="text-align: center">Zonal Value Details</p>';
                            $htmlTag1 = '<div class="container-fluid form-top login">
                                <div class="row" id="printdiv">
                                    <div class="container-fluid form-top">
                                        <div class"row" id="printdiv">
                                            <div class="col-lg-10" style="margin: 0 auto;float: none;">
                                                <div class="panel panel-primary">
                                                    <div class="panel-body">
                                                        <p  style="text-align:center; font-size: 30px">অসম চৰকাৰ</p>
                            <center><p style="text-align:center;font-size: 20px">GOVERNMENT OF ASSAM</p></center>
                                <p class="uni_text">
                                <p style="text-align:left; font-size: 20px">চক্র বিষয়াৰ কাৰ্য্যালয়  :: ' . $cir_name .' ৰাজহ  চক্ৰ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; মৌজা : ' .$mouza_name .'</p>&nbsp;
                                <hr>
                                <p class="uni_text">
                                    ' . $cir_name .  'ৰাজহ চক্ৰ ,' .$mouza_name .' মৌজা ৰ ' . $villageName . ' গাঁওৰ
                                </p>';
                            $htmlTag2 = '</div></div></div></div></div></div></div>';
                            $table1 = ' <table cellpadding="5px" autosize="1" border="1" width="100%" style="overflow: wrap">
                                    <thead>
                                    <tr>
                                        <th >Dag No</th>
                                        <th >Zone </th>
                                        <th  >Subclass </th>
                                        <th >Zonal Value</th>
                                    </tr>
                                    </thead>
                                    <tbody>';

                                $table2 = '<tr>
                                        <td> ' . $dag_no . '</td>
                                        <td>' . $getZonalValue[0]->zone_name . '</td>
                                        <td >' . $getZonalValue[0]->subclass_name . '</td>
                                        <td>' . $getZonalValue[0]->land_rate . '</td>
                                    </tr>';
                            $table3 = '</tbody></table>';
                            $table = $table1 . $table2 . $table3;
                            $final = $style . $htmlTag1 . $htmlTag . $table . $htmlTag2 ;
                            $base64array = $this->getPdfBase64Data(base64_encode($final));
                            echo json_encode(array(
                                'responseType' => 2,
                                'message' => $base64array ,
                            ));



                        } else if ($approval_status_villwise == '2') {
                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'Zonal Value Missing for Dag No : ' . $dag_no ,
                            ));
                        } else if ($approval_status_villwise == '3') {
                            echo json_encode(array(
                                'responseType' => 1,
                                'message' => 'Zonal Value Missing for Dag No : ' . $dag_no ,
                            ));
                        }
                    }
                } else if ($approval_status == '2') {
                    echo json_encode(array(
                        'responseType' => 1,
                        'message' => 'Zonal Value Missing for Dag No : ' . $dag_no ,
                    ));
                }
            }
        }
    }


     public function getPdfBase64Data($htmbase64Encoded)
    {
        include 'vendor/mpdf/vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetWatermarkText('ZONAL VALUE DETAILS');
        $mpdf->showWatermarkText = true;
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $html = base64_decode($htmbase64Encoded);
        $pdfGenerated = $mpdf->writeHTML($html);
        $pdfBase64 = base64_encode($mpdf->Output('', 'S'));
        return $pdfBase64;
    }

    public function createGaonBura(){

        $name = $this->input->post('name'); 
        $user_name = $this->input->post('user_name'); 
        $password = $this->input->post('password');
        $dist_code = $this->input->post('dist_code');
        $subdiv_code = $this->input->post('subdiv_code');
        $cir_code = $this->input->post('cir_code');

        if(empty($name) || empty($user_name) || empty($password)){
            echo json_encode([
                'responseType' => 0,
                'msg'   => '#ERRILRMS983: All data is required...'
            ]);
            return false;
        }

		$password = hash('sha512', $password);
        $desgn = GBURA;

        $max = $this->db->query("SELECT MAX(id) as no FROM depart_users")->row()->no;
		if($max == '' || $max == null){ $val = 1; }
		else { $val = $max+1; }


        $checkuser_exist = $this->db->query('select * from depart_users where unique_user_id = ?', array($user_name));

        if($checkuser_exist->num_rows() > 0){
            echo json_encode([
                'responseType' => 0,
                'msg' => '#ERR1000120: User name already exist! Please enter a differect username...'
            ]);
            return false;
        }
        

        $this->db->trans_begin();

		$params = [
			'name'=> $name,
			'designation'=> $desgn,
			'date_of_joining'=> date('Y-m-d h:i:s'),
			'password'=> $password,
			'unique_user_id'=> $user_name,
			'password_change'=> date('Y-m-d H:i:s'),
			'active_deactive'=> 'E',
			'first_login'=> '0',
			'status'=> 'E',
            'display_name' => $name,
			// 'mobile_no'=> $mobile,
			// 'email'=> $email,
			// 'address'=> $address,
			'user_code'=> GBURA.$val,
		];

        $inser = $this->db->insert('depart_users', $params);
        if($inser != 1){
            $this->db->trans_rollback();
            echo json_encode([
                'responseType' => 0,
                'msg' => '#ERR1024: Unable to create user...'
            ]);
            return false;
        }

        $last_inserted_id = $this->db->insert_id();

        $dist_byforcation_array = [
            'unique_user_id' => $last_inserted_id,
            'user_code' => $params['user_code'],
            'dist_code' => $dist_code,
            'subdiv_code' => $subdiv_code,
            'cir_code' => $cir_code,
            'mouza_pargona_code' => '00',
            'lot_no' => '00',
            'vill_townprt_code' => '00000', 
            'active_deactive' => 'E',
        ];

        $inser_dist_by = $this->db->insert('user_dist_byforcation', $dist_byforcation_array);

        if($inser_dist_by != 1){
            $this->db->trans_rollback();
            echo json_encode([
                'responseType' => 0,
                'msg' => '#ERR13024: Unable to create user...'.$this->db->last_query()
            ]);
            return false;
        }

        $this->db->trans_commit();
        echo json_encode([
            'responseType' => 2,
            'msg' => 'Data successfully saved....'
        ]);
        return false;
    }

    function updateMobileNoDetailsMouzadar()
    {
      log_message('error', 'updateMobileNoDetailsMouzadar, posted data from dharitree'.json_encode($_POST));
      $config=array(
        array('field'=>'unique_user_id','label'=>'unique_user_id','rules'=>'required'),
        array('field'=>'dist_code','label'=>'dist_code','rules'=>'required'),
        array('field'=>'mobile_no','label'=>'mobile_no','rules'=>'required'),

      );
      $validation= $this->form_validate($config);
      if(!empty($validation)){
        log_message("error","Validation :".json_encode($validation));
        echo json_encode(array(
            'result'=>'N',
            'msg' => json_encode($validation)
        ));
        return;
      }

      $unique_user_id = $_POST['unique_user_id'];
      $dist_code = $_POST['dist_code'];
      $mobile_no = $_POST['mobile_no'];
      $this->db = $this->load->database('db2', TRUE);
      $this->db->trans_begin();
      $sql = "select * from user_dist_byforcation u join depart_users d on u.unique_user_id::int=d.id where d.unique_user_id=? and dist_code=? and d.active_deactive = 'E'";
      $users = $this->db->query($sql,array($unique_user_id,$dist_code));
      log_message('error','USERDETAILS1=========='.$this->db->last_query());
      if($users->num_rows()> 1)
      {
            $this->db->trans_rollback();
            echo json_encode(['result' => 'N', 'msg' => '#ERROR1064 : More than mone mouzadar found']);
            exit;
      }
      $users = $users->row();
      log_message('error','USERDETAILS1=========='.json_encode($users));
      if(!empty($users) && $users != null)
      {
        $user_id = $users->id;
        $update = [
            'mobile_no'=> $mobile_no,
        ];
        $this->db->where('unique_user_id', $unique_user_id);
        $depart_users_update = $this->db->update('depart_users', $update);

        if($this->db->affected_rows() == 1)
        {
            $this->db->trans_commit();
            echo json_encode(['result' => 'Y', 'msg' => 'Mobile no has been updated in Department End',
                                          'dist_codes'=>array($dist_code), 'dist_count'=>1]);
        }
        else
        {
            $this->db->trans_rollback();
            echo json_encode(['result' => 'N', 'msg' => '#ERROR1094 : error in updating field']);
            exit;
        }
      }
      else
      {
            $this->db->trans_rollback();
            echo json_encode(['result' => 'N', 'msg' => '#ERROR1101 : User id not found']);
            exit;
      }
    }

}

