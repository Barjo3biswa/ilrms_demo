<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security'));
        $this->db = $this->load->database('db2', TRUE);
        $this->dbb = $this->load->database('auth', true);
        ini_set('memory_limit', '-1');
        set_time_limit(0);
    }
    
    public function testPaymentResponse(){
                echo "<pre>";
                var_dump($_POST);
                echo "</pre>";
                exit;
    }
 
    // generate random Salt (string)
    function randomSalt($len = 11)
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';
        $l = strlen($chars) - 1;
        $str = '';
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }
        $pass = password_hash($str, PASSWORD_BCRYPT);
        return substr($pass, 0, 29);
    }


    public function index()
    {
        $ranKey = $this->randomSalt(11);
        $this->session->set_userdata('randomKey', $ranKey);

        if ($this->session->userdata('logged_in') == TRUE) {
            redirect('dashboard');
        }

        if ($this->session->has_userdata('captcha')) {
            $this->session->unset_userdata('captcha');
        }

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $captcha = substr(str_shuffle(str_repeat($pool, 6)), 0, 6);
        $newdata = array(
            'captcha'  => $captcha
        );
        $this->session->set_userdata($newdata);



        $data['captcha'] = $captcha;
        $this->load->view('login/login');
    }

    //********* LOG OUT ************//
    public function logout()
    {
        $this->get_client_exit();
        $this->session->sess_destroy();
        session_destroy();
        $newdata = array(
            'logged_in'  => false
        );
        $this->session->set_userdata($newdata);
        redirect('/');
    }

    //********** LOGIN HISTORY **********//
    function get_client_exit()
    {
        $user_code = $this->session->userdata('user_code');
        $client_ip = $this->input->ip_address();
        $date_of_creation = date("Y-m-d h:i:s");
        $value = array(
            'user_code' => $user_code,
            'date_of_creation' => $date_of_creation,
            'client_ip' => $client_ip,
            'status' => '0',
            'action' => '0',
        );
        $this->db->insert('login_history_table', $value);
    }
    function get_client_start()
    {
        $user_code = $this->session->userdata('user_code');
        $client_ip = $this->input->ip_address();
        $date_of_creation = date("Y-m-d h:i:s");
        $value = array(
            'user_code' => $user_code,
            'date_of_creation' => $date_of_creation,
            'client_ip' => $client_ip,
            'status' => '1',
            'action' => '1',
        );
        $this->db->insert('login_history_table', $value);
    }

    function getCaptcha()
    {
        $im = @ImageCreate(80, 20) // Width and hieght of the image.
            or die("Cannot Initialize new GD image stream");
        $background_color = ImageColorAllocate($im, 204, 204, 204); // Assign background color
        $text_color = ImageColorAllocate($im, 51, 51, 255);     // text color is given
        ImageString($im, 5, 8, 2, $_SESSION['captcha'], $text_color); // Random string  from session added
        ///im is the image source, Int 5 is the font size,Int 8 is the X position , Int 2
        ImagePng($im); // image displayed
        imagedestroy($im); // Memory allocation for the image is removed.
    }

    function getReCaptcha()
    {
        if ($this->session->has_userdata('captcha')) {
            $this->session->unset_userdata('captcha');
        }

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $captcha = substr(str_shuffle(str_repeat($pool, 6)), 0, 6);
        $newdata = array(
            'captcha'  => $captcha
        );
        $this->session->set_userdata($newdata);



        $im = @ImageCreate(80, 20) // Width and hieght of the image.
            or die("Cannot Initialize new GD image stream");

        $background_color = ImageColorAllocate($im, 204, 204, 204); // Assign background color
        $text_color = ImageColorAllocate($im, 51, 51, 255);      // text color is given
        ImageString($im, 5, 8, 2, $_SESSION['captcha'], $text_color); // Random string  from session added
        ///im is the image source, Int 5 is the font size,Int 8 is the X position , Int 2 is the Y position //

        ImagePng($im); // image displayed
        imagedestroy($im); // Memory allocation for the image is removed.
    }
    //******* Check Captcha ********//
    function checkCaptcha($captcha)
    {
        if ($captcha == $this->session->userdata('captcha')) {
            return TRUE;
        } else {
            $this->form_validation->set_message('checkCaptcha', 'CAPTCHA does not match.');
            return FALSE;
        }
    }

    //********* Login Process ********//
    public function loginProcess()
    {
        if(ENABLE_OTP_AUTHENTICATION == 1)
        {
            $this->loginProcessWithOtp();
            return;
        }
        $validation = array(
            array(
                'field' => 'uname',
                'label' => 'Username',
                'rules' => 'trim|required|xss_clean',
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|xss_clean',
            ),
            // array(
            //     'field' => 'captcha',
            //     'label' => 'Captcha',
            //     'rules' => 'trim|required|xss_clean|callback_checkCaptcha',
            // ),
        );
        $data = array();
        $data['error'] = '';
        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run() === FALSE) {
            $this->form_validation->set_error_delimiters('', '');
            foreach ($validation as $rule) {
                if (form_error($rule['field'])) {
                    $data['error'] .= form_error($rule['field']) . '<br>';
                }
            }
            $data['validation'] = false;
            echo json_encode($data);
            return;
        } else {

            $data['validation'] = true;

            $randomKey = $this->session->userdata('randomKey');

            $data['success'] = null;
            $user_name = $this->input->post('uname');
            $password = $this->input->post('password');

            // password format : sha512.update(hash + salt);
            $getPass = $this->db->query("SELECT password FROM depart_users WHERE 
                unique_user_id=?", array($user_name));
              
            if ($getPass->num_rows() == 0) {
                log_message('error', 'ilrms_session_data '.json_encode($this->session->userdata));
                log_message('error', 'ilrms_last_query '.json_encode($this->db->last_query()));
                $data['pass_success'] = false;
                echo json_encode($data);
                return;
            }
            $finalPassword = hash('sha512', ($getPass->row()->password . $randomKey));

            // echo json_encode($randomKey);
            // exit;
            if ($password == $finalPassword) {
                $sql = "select du.unique_user_id as unique_uid, * from depart_users du join user_dist_byforcation udb on 
                du.id::int=udb.unique_user_id::int where du.unique_user_id=? and du.active_deactive=? and du.status=?";                 
                $res = $this->db->query($sql, array($user_name, 'E', 'E'));
                if ($res->num_rows() > 0) {
                    $row  = $res->row_array();
                    $sessiondata = array(
                        'name'  => $row['name'],
                        'designation'       => $row['designation'],
                        'date_of_joining'   => $row['date_of_joining'],
                        'unique_user_id'    => $row['unique_uid'],
                        'first_login'       => $row['first_login'],
                        'mobile_no'         => $row['mobile_no'],
                        'email'             => $row['email'],
                        'address'           => $row['address'],
                        'user_code'         => $row['user_code'],
                        'dist_code'         => $row['dist_code'],
                        'subdiv_code'       => $row['subdiv_code'],
                        'cir_code'          => $row['cir_code'],
                        'mouza_pargona_code' => $row['mouza_pargona_code'],
                        'logged_in'         => TRUE
                    );
                    $this->session->set_userdata($sessiondata);
                    log_message('error', 'ilrms_session_data '.json_encode($this->session->userdata));
                    $this->get_client_start();
                    $data['success'] = true;
                    echo json_encode($data);
                    return;
                } else {
                    $data['success'] = false;
                    echo json_encode($data);
                    return;
                }
            } else {
                log_message('error', 'password: '.$password.', finalPassword: '. $finalPassword);
                log_message('error', 'ilrms_last_query '.json_encode($this->db->last_query()));
                $data['pass_success'] = false;
                echo json_encode($data);
                return;
            }
        }
    }

    public function dbswitch($dist_code)
    {
        if ($dist_code == "02") {
            $this->db = $this->load->database('dhubri', TRUE);
        } else if ($dist_code == "05") {
            $this->db = $this->load->database('barpeta', TRUE);
        } else if ($dist_code == "10") {
            $this->db = $this->load->database('chirang', TRUE);
        } else if ($dist_code == "13") {
            $this->db = $this->load->database('bongaigaon', TRUE);
        } else if ($dist_code == "17") {
            $this->db = $this->load->database('dibrugarh', TRUE);
        } else if ($dist_code == "15") {
            $this->db = $this->load->database('jorhat', TRUE);
        } else if ($dist_code == "14") {
            $this->db = $this->load->database('golaghat', TRUE);
        } else if ($dist_code == "07") {
            $this->db = $this->load->database('kamrup', TRUE);
        } else if ($dist_code == "03") {
            $this->db = $this->load->database('goalpara', TRUE);
        } else if ($dist_code == "18") {
            $this->db = $this->load->database('tinsukia', TRUE);
        } else if ($dist_code == "12") {
            $this->db = $this->load->database('lakhimpur', TRUE);
        } else if ($dist_code == "24") {
            $this->db = $this->load->database('kamrupm', TRUE);
        } else if ($dist_code == "06") {
            $this->db = $this->load->database('nalbari', TRUE);
        } else if ($dist_code == "11") {
            $this->db = $this->load->database('sonitpur', TRUE);
        } else if ($dist_code == "16") {
            $this->db = $this->load->database('sibsagar', TRUE);
        } else if ($dist_code == "32") {
            $this->db = $this->load->database('morigaon', TRUE);
        } else if ($dist_code == "33") {
            $this->db = $this->load->database('nagaon', TRUE);
        } else if ($dist_code == "34") {
            $this->db = $this->load->database('majuli', TRUE);
        } else if ($dist_code == "21") {
            $this->db = $this->load->database('karimganj', TRUE);
        } else if ($dist_code == "35") {
            $this->db = $this->load->database('biswanath', TRUE);
        } else if ($dist_code == "36") {
            $this->db = $this->load->database('hojai', TRUE);
        } else if ($dist_code == "37") {
            $this->db = $this->load->database('charaideo', TRUE);
        } else if ($dist_code == "25") {
            $this->db = $this->load->database('dhemaji', TRUE);
        } else if ($dist_code == "39") {
            $this->db = $this->load->database('bajali', TRUE);
        } else if ($dist_code == "38") {
            $this->db = $this->load->database('ssalmara', TRUE);
        } else if ($dist_code == "08") {
            $this->db = $this->load->database('darrang', TRUE);
        } else if ($dist_code == "auth") {
            $this->db = $this->load->database('auth', TRUE);
        }
        return $this->db;
    }

    // ********** API for Dashboard ************//
    public function dashboardAPIPort_backup()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $dist_code = array();
        $dist_code[] = '02'; ///dhubri
        $dist_code[] = '03'; //goalpara
        $dist_code[] = '05'; //barpeta
        $dist_code[] = '06'; //nalbari
        $dist_code[] = '07'; //kamrup
        $dist_code[] = '08'; //darrang
        $dist_code[] = '11'; //sonitpur
        $dist_code[] = '12'; //lakhimpur
        $dist_code[] = '13'; //bongaigaon
        $dist_code[] = '14'; //golaghat
        $dist_code[] = '15'; //jorhat
        $dist_code[] = '16'; //sibsagar
        $dist_code[] = '17'; //dibrugarh
        $dist_code[] = '18'; //tinsukia
        $dist_code[] = '21'; //karimganj
        $dist_code[] = '24'; //kamrupM
        $dist_code[] = '25'; //dhemaji
        $dist_code[] = '32'; //morigaon
        $dist_code[] = '33'; //nagaon
        $dist_code[] = '34'; //majuli
        $dist_code[] = '35'; //biswanath
        $dist_code[] = '36'; //hojai
        $dist_code[] = '37'; //charaideo
        $dist_code[] = '38'; //south salmara
        $dist_code[] = '39'; //bajali
        //$dist_code[] = '07'; //kamrup
        $total_state_dag = null;
        $total_state_patta = null;
        $total_state_pattadar = null;

        $total_state_land_class = null;
        $total_state_land_area = null;

        $total_state_dag_lessa = null;
        $total_state_dag_ganda = null;

        $total_state_annual_patta = null;
        $total_state_periodic_patta = null;

        $circle_wise_patta = array();
        $circle_wise_dag = array();

        $lot_wise_dag = array();
        $village_wise_dag = array();

        $total_state_zonal_dags = null;
        $total_state_zonal_village = null;

        $total_state_village = null;

        $bigha = $katha = $lessa = $ganda = $kranti = 0;

        $c_bigha = $c_katha = $c_lessa = $c_ganda = $c_kranti = 0;

        foreach ($dist_code as $d) {
            $this->dbswitch($d);
            $application_id = '01';
            echo $d;

            //******** Dag *********//

            //            $sql = "select count(*) as dag, sum(dag_area_b) as bigha,
            //            sum(dag_area_k) as katha,sum(dag_area_lc) as lessa,
            //            sum(dag_area_g) as ganda,sum(dag_area_kr) as kranti
            //            from chitha_basic";

            $sql = "select sum(cdp.dag_area_b) as bigha,
            sum(cdp.dag_area_k) as katha,sum(cdp.dag_area_lc) as lessa,
            sum(cdp.dag_area_g) as ganda,sum(cdp.dag_area_kr) as kranti,
            count(cdp.dag_no) as dag, count(cdp.dag_no) Filter (where l.rural_urban='U') as urban,
            count(cdp.dag_no) Filter (where l.rural_urban='R') as rural,
            count(cdp.dag_no) Filter (where l.rural_urban not in ('U','R')) as unmapped from 
            chitha_basic cdp join location l on 
            cdp.dist_code=l.dist_code and cdp.subdiv_code=l.subdiv_code and cdp.cir_code=l.cir_code
            and cdp.mouza_pargona_code=l.mouza_pargona_code and cdp.lot_no=l.lot_no and 
            cdp.vill_townprt_code=l.vill_townprt_code";

            $res = $this->db->query($sql)->row_array();
            $total_state_dag = $total_state_dag + $res['dag'];
            $bigha = $res['bigha'];
            $katha = $res['katha'];
            $lessa = $res['lessa'];
            $ganda = $res['ganda'];
            $kranti = $res['kranti'];

            //*** total lessa ******//
            $total_district_dag_lessa = null;
            $total_district_dag_ganda = null;

            //********* 22.06.2022 *********//
            if (in_array($d, BARAK_VALLEY)) {
                $total_district_dag_ganda = $this->utilityclass->barak_valley_total_ganda($bigha, $katha, $lessa, $ganda);
                $total_district_dag_ganda_covert = $this->utilityclass->barak_valley_total_bigha_katha_lessa_ganda($total_district_dag_ganda);
                $total_state_dag_ganda = $total_state_dag_ganda + $total_district_dag_ganda;
            } else {
                $total_district_dag_lessa = $this->utilityclass->brahmaputra_valley_total_lessa($bigha, $katha, $lessa);
                $total_district_dag_lessa_covert = $this->utilityclass->brahmaputra_valley_total_bigha_katha_lessa($total_district_dag_lessa);
                $total_state_dag_lessa = $total_state_dag_lessa + $total_district_dag_lessa;
            }

            //********* 22.06.2022 *********//
            //*** Pattadar District wise ***//
            $sql6 = "Select count(*) as pattadar from chitha_dag_pattadar cdp where 
                    (cdp.p_flag!='1' or cdp.p_flag is null)";
            $res6 = $this->db->query($sql6)->row_array();
            $total_state_pattadar = $total_state_pattadar + $res6['pattadar'];

            if (in_array($d, BARAK_VALLEY)) {
                $district_wise_dag_array = array();
                $district_wise_dag_array['district_code'] = $d;
                $district_wise_dag_array['district_wise_dag'] = $res['dag'];
                $district_wise_dag_array['district_rural_dag'] = $res['rural'];
                $district_wise_dag_array['district_urban_dag'] = $res['urban'];
                $district_wise_dag_array['district_unmapped_dag'] = $res['unmapped'];
                $district_wise_dag_array['district_wise_dag_area_bigha'] = $total_district_dag_ganda_covert[0];
                $district_wise_dag_array['district_wise_dag_area_katha'] =  $total_district_dag_ganda_covert[1];
                $district_wise_dag_array['district_wise_dag_area_lessa'] =  $total_district_dag_ganda_covert[2];
                $district_wise_dag_array['district_wise_dag_area_ganda'] = $total_district_dag_ganda_covert[3];
                $district_wise_dag_array['district_wise_dag_area_kranti'] = $res['kranti'];
                $district_wise_dag_array['district_wise_pattadar'] = $res6['pattadar'];
            } else {
                $district_wise_dag_array = array();
                $district_wise_dag_array['district_code'] = $d;
                $district_wise_dag_array['district_wise_dag'] = $res['dag'];
                $district_wise_dag_array['district_rural_dag'] = $res['rural'];
                $district_wise_dag_array['district_urban_dag'] = $res['urban'];
                $district_wise_dag_array['district_unmapped_dag'] = $res['unmapped'];
                $district_wise_dag_array['district_wise_dag_area_bigha'] = $total_district_dag_lessa_covert[0];
                $district_wise_dag_array['district_wise_dag_area_katha'] =  $total_district_dag_lessa_covert[1];
                $district_wise_dag_array['district_wise_dag_area_lessa'] =  $total_district_dag_lessa_covert[2];
                $district_wise_dag_array['district_wise_dag_area_ganda'] = $res['ganda'];
                $district_wise_dag_array['district_wise_dag_area_kranti'] = $res['kranti'];
                $district_wise_dag_array['district_wise_pattadar'] = $res6['pattadar'];
            }

            //*********** get dag chitha details upto circle *************//

            //            $sql5 = "select count(*) as dag, sum(dag_area_b) as bigha,
            //            sum(dag_area_k) as katha,sum(dag_area_lc) as lessa,
            //            sum(dag_area_g) as ganda,sum(dag_area_kr) as kranti,
            //                    dist_code,subdiv_code,cir_code from
            //                    chitha_basic group by dist_code,subdiv_code,cir_code";

            $sql5 = "select cdp.dist_code,cdp.subdiv_code, cdp.cir_code, sum(cdp.dag_area_b) as bigha,
            sum(cdp.dag_area_k) as katha,sum(cdp.dag_area_lc) as lessa,
            sum(cdp.dag_area_g) as ganda,sum(cdp.dag_area_kr) as kranti,
            count(cdp.dag_no) as dag, count(cdp.dag_no) Filter (where l.rural_urban='U') as urban,
            count(cdp.dag_no) Filter (where l.rural_urban='R') as rural,
            count(cdp.dag_no) Filter (where l.rural_urban not in ('U','R')) as unmapped from 
            chitha_basic cdp join location l on 
            cdp.dist_code=l.dist_code and cdp.subdiv_code=l.subdiv_code and cdp.cir_code=l.cir_code
            and cdp.mouza_pargona_code=l.mouza_pargona_code and cdp.lot_no=l.lot_no and 
            cdp.vill_townprt_code=l.vill_townprt_code group by cdp.dist_code,cdp.subdiv_code,
            cdp.cir_code";
            $circle_wise_dag['dag'] = $this->db->query($sql5)->result_array();

            /******* 08.07.2022 **********/
            //*********** get dag chitha lot wise *************//
            //          $sql36 = "select count(*) as dag, sum(dag_area_b) as bigha,
            //            sum(dag_area_k) as katha,sum(dag_area_lc) as lessa,
            //            sum(dag_area_g) as ganda,sum(dag_area_kr) as kranti,
            //                    dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no from
            //                    chitha_basic group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no";

            $sql36 = "select cdp.dist_code,cdp.subdiv_code, cdp.cir_code,cdp.mouza_pargona_code,cdp.lot_no,
            sum(cdp.dag_area_b) as bigha,
            sum(cdp.dag_area_k) as katha,sum(cdp.dag_area_lc) as lessa,
            sum(cdp.dag_area_g) as ganda,sum(cdp.dag_area_kr) as kranti,
            count(cdp.dag_no) as dag, count(cdp.dag_no) Filter (where l.rural_urban='U') as urban,
            count(cdp.dag_no) Filter (where l.rural_urban='R') as rural,
            count(cdp.dag_no) Filter (where l.rural_urban not in ('U','R')) as unmapped from 
            chitha_basic cdp join location l on 
            cdp.dist_code=l.dist_code and cdp.subdiv_code=l.subdiv_code and cdp.cir_code=l.cir_code
            and cdp.mouza_pargona_code=l.mouza_pargona_code and cdp.lot_no=l.lot_no and 
            cdp.vill_townprt_code=l.vill_townprt_code group by cdp.dist_code,cdp.subdiv_code,
            cdp.cir_code,cdp.mouza_pargona_code,cdp.lot_no";
            $dag_lot_wise = $this->db->query($sql36)->result_array();

            foreach ($dag_lot_wise as $lot) {
                $lot_wise_dag['dag'][$d . '-' . $lot['subdiv_code'] . '-' . $lot['cir_code']][] = $lot;
            }

            //*********** get dag chitha Village wise *************//
            //          $sql37 = "select count(*) as dag, sum(dag_area_b) as bigha,
            //            sum(dag_area_k) as katha,sum(dag_area_lc) as lessa,
            //            sum(dag_area_g) as ganda,sum(dag_area_kr) as kranti,
            //                    dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code from
            //                    chitha_basic group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code";

            $sql37 = "select cdp.dist_code,cdp.subdiv_code, cdp.cir_code,
            cdp.mouza_pargona_code,cdp.lot_no,cdp.vill_townprt_code,
            sum(cdp.dag_area_b) as bigha,
            sum(cdp.dag_area_k) as katha,sum(cdp.dag_area_lc) as lessa,
            sum(cdp.dag_area_g) as ganda,sum(cdp.dag_area_kr) as kranti,
            count(cdp.dag_no) as dag, count(cdp.dag_no) Filter (where l.rural_urban='U') as urban,
            count(cdp.dag_no) Filter (where l.rural_urban='R') as rural,
            count(cdp.dag_no) Filter (where l.rural_urban not in ('U','R')) as unmapped from 
            chitha_basic cdp join location l on 
            cdp.dist_code=l.dist_code and cdp.subdiv_code=l.subdiv_code and cdp.cir_code=l.cir_code
            and cdp.mouza_pargona_code=l.mouza_pargona_code and cdp.lot_no=l.lot_no and 
            cdp.vill_townprt_code=l.vill_townprt_code group by cdp.dist_code,cdp.subdiv_code,
            cdp.cir_code,cdp.mouza_pargona_code,cdp.lot_no,cdp.vill_townprt_code";

            $dag_village_wise = $this->db->query($sql37)->result_array();

            foreach ($dag_village_wise as $vill) {
                $village_wise_dag['dag'][$d . '-' . $vill['subdiv_code'] . '-' . $vill['cir_code'] . '-' . $vill['mouza_pargona_code'] . '-' . $vill['lot_no']][] = $vill;
            }

            //******** Patta *********//
            $sql2 = "Select count(t.countpatta_no) as totalpatta from
                    (Select count(distinct(patta_no) ) as countpatta_no from chitha_basic
                    where patta_type_code  in (select type_code from patta_code where jamabandi='y')
               group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
               vill_townprt_code,patta_no,patta_type_code ) as t ";
            $totalPatta = $this->db->query($sql2)->row_array();
            $total_state_patta = $total_state_patta + $totalPatta['totalpatta'];

            $district_patta_array = array();
            $district_patta_array['district_code'] = $d;
            $district_patta_array['district_wise_patta'] = $totalPatta['totalpatta'];
            if (in_array($d, BARAK_VALLEY)) {
                $district_wise_array_merge['barak_valley'][$application_id . $d] = array_merge($district_wise_dag_array, $district_patta_array);
            } else {
                $district_wise_array_merge['brahmaputra_valley'][$application_id . $d] = array_merge($district_wise_dag_array, $district_patta_array);
            }

            //********* 27.06.2022 *********//
            //****** patta Type wise ***********//
            $Patta_type_wise = null;
            $sql8 = "Select count(t.countpatta_no) as totalpatta,t.patta_type,t.dist_code from
                    (Select count(distinct(patta_no)) as countpatta_no, patta_type_code as patta_type,
                    dist_code
                    from chitha_basic
                    where patta_type_code in (select type_code from patta_code where jamabandi='y')
               group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
               vill_townprt_code,patta_no,patta_type_code ) as t GROUP BY t.patta_type,t.dist_code";
            $Patta_type_wise = $this->db->query($sql8)->result_array();

            $district_wise_array_merge['patta_type_district_wise'][$application_id . $d] = $Patta_type_wise;

            //****** Patta Type Circle Wise ***********//
            $Patta_type_circle_wise = null;
            $sql9 = "Select count(t.countpatta_no) as totalpatta,t.patta_type,t.dist_code,t.subdiv_code,t.cir_code from
                    (Select count(distinct(patta_no)) as countpatta_no, patta_type_code as patta_type,
                    dist_code,subdiv_code,cir_code
                    from chitha_basic
                    where patta_type_code in (select type_code from patta_code where jamabandi='y')
               group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
               vill_townprt_code,patta_no,patta_type_code ) as t GROUP BY t.patta_type,t.dist_code,
               t.subdiv_code,t.cir_code order by t.subdiv_code ASC,t.cir_code ASC";
            $Patta_type_circle_wise = $this->db->query($sql9)->result_array();

            $circle_wise_patta['patta_type_circle_wise'] = $Patta_type_circle_wise;

            //*** annual patta District wise ***//
            $sql10 = "Select count(t.countpatta_no) as totalpatta,t.patta_type,t.dist_code from 
                    (Select count(distinct(patta_no) ) as countpatta_no, patta_type_code as patta_type,
                    dist_code from 
                    chitha_basic  where patta_type_code in (select type_code from patta_code where
                     apcancellation='y')
                    group by dist_code,subdiv_code,cir_code,
                    mouza_pargona_code,lot_no,vill_townprt_code,patta_no,patta_type_code ) as t 
                    GROUP BY t.patta_type,t.dist_code";
            $annual_patta = $this->db->query($sql10)->result_array();

            foreach ($annual_patta as $ap) {
                $total_state_annual_patta = $total_state_annual_patta + $ap['totalpatta'];
            }

            $district_wise_array_merge['annual_patta_district_wise'][$application_id . $d] =  $annual_patta;

            //*** periodic patta District wise ***//
            $sql10 = "Select count(t.countpatta_no) as totalpatta,t.patta_type,t.dist_code from 
                    (Select count(distinct(patta_no) ) as countpatta_no,patta_type_code as patta_type,
                    dist_code from 
                    chitha_basic  where patta_type_code in (select type_code from  patta_code where 
                    jamabandi='y' and apcancellation is null)
                    group by dist_code,subdiv_code,cir_code,
                    mouza_pargona_code,lot_no,vill_townprt_code,patta_no,patta_type_code ) as t
                    GROUP BY t.patta_type,t.dist_code";
            $periodic_patta = $this->db->query($sql10)->result_array();

            foreach ($periodic_patta as $pp) {
                $total_state_periodic_patta = $total_state_periodic_patta + $pp['totalpatta'];
            }

            $district_wise_array_merge['periodic_patta_district_wise'][$application_id . $d] =  $periodic_patta;

            //*********** get patta chitha details upto circle *************//
            $sql4 = "Select count(t.patta_no) as totalpatta,t.dist_code,t.subdiv_code,t.cir_code from
                    (Select count(distinct(patta_no))  as patta_no,dist_code,subdiv_code,cir_code from chitha_basic
                    where patta_type_code  in (select type_code from patta_code where jamabandi=?)
               group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
               vill_townprt_code,patta_no,patta_type_code ) AS t  GROUP BY t.dist_code,t.subdiv_code,t.cir_code";
            $circle_wise_patta['patta'] = $this->db->query($sql4, array('y'))->result_array();

            //********* 28.06.2022 *********//
            //*********** get annual patta circle wise *************//
            $sql11 = "Select count(t.patta_no) as totalpatta,t.patta_type,t.dist_code,t.subdiv_code,t.cir_code from
                    (Select count(distinct(patta_no))  as patta_no,patta_type_code as patta_type,
                    dist_code,subdiv_code,cir_code from chitha_basic
                    where patta_type_code  in (select type_code from patta_code where
                     apcancellation='y')
               group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
               vill_townprt_code,patta_no,patta_type_code ) AS t  GROUP BY t.patta_type,
               t.dist_code,t.subdiv_code,t.cir_code order by t.subdiv_code ASC,t.cir_code ASC";
            $circle_wise_patta['annual-patta'] = $this->db->query($sql11)->result_array();

            //*********** get periodic patta circle wise *************//
            $sql12 = "Select count(t.patta_no) as totalpatta,t.patta_type,t.dist_code,t.subdiv_code,t.cir_code from
                    (Select count(distinct(patta_no))  as patta_no,patta_type_code as patta_type,
                    dist_code,subdiv_code,cir_code from chitha_basic
                    where patta_type_code  in (select type_code from  patta_code where 
                    jamabandi='y' and apcancellation is null)
               group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
               vill_townprt_code,patta_no,patta_type_code ) AS t  GROUP BY t.patta_type,
               t.dist_code,t.subdiv_code,t.cir_code order by t.subdiv_code ASC,t.cir_code ASC";
            $circle_wise_patta['periodic-patta'] = $this->db->query($sql12)->result_array();

            //********* 22.06.2022 *********//
            //******* Pattadar circle wise ***********//
            $sql7 = "Select count(*) as pattadar,dist_code,subdiv_code,cir_code from chitha_dag_pattadar cdp where 
            (cdp.p_flag!='1' or cdp.p_flag is null) group by dist_code,subdiv_code,cir_code";
            $circle_wise_pattadar['pattadar'] = $this->db->query($sql7)->result_array();

            /********* Zonal Value *****************/
            //CIRCLE WISE
            $sql21 = "select subdiv_code,cir_code from location where subdiv_code!=? 
                    and cir_code!=? and mouza_pargona_code=?
                    and lot_no=? and vill_townprt_code=?";
            $res21 = $this->db->query($sql21, array('00', '00', '00', '00', '00000'))->result_array();
            $zonal_dag_cir_count = array();
            $zonal_village_cir_count = array();
            foreach ($res21 as $r21) {
                $sql22 = "Select count(*) as c from dagwise_zone_info where 
                    subdiv_code=? and cir_code=? and mouza_pargona_code!=?
                    and lot_no!=? and vill_code!=?";
                $count22 = $this->db->query($sql22, array($r21['subdiv_code'], $r21['cir_code'], '00', '00', '00000'))->row()->c;

                // $sql23 = "Select count(*) as c from chitha_basic where 
                // subdiv_code=? and cir_code=? and mouza_pargona_code!=?
                //     and lot_no!=? and vill_townprt_code!=?";
                // $count23 = $this->db->query($sql23,array($r21['subdiv_code'],$r21['cir_code'],'00','00','00000'))->row()->c;

                //new
                $sql23 = "Select count(*) as c from chitha_basic where 
				subdiv_code=? and cir_code=? and 
				    (subdiv_code,cir_code) 
				    in (select subdiv_code,cir_code from 
				    location where (nc_btad is null or TRIM(nc_btad) = '') and subdiv_code=?  
				    and cir_code=?)";
                $count23 = $this->db->query($sql23, array($r21['subdiv_code'], $r21['cir_code'], $r21['subdiv_code'], $r21['cir_code']))->row()->c;
                //new

                $circle_wise_zonal_dag_array = array();
                $circle_wise_zonal_dag_array['district_code'] = $d;
                $circle_wise_zonal_dag_array['subdiv_code'] = $r21['subdiv_code'];
                $circle_wise_zonal_dag_array['cir_code'] = $r21['cir_code'];
                $circle_wise_zonal_dag_array['zonal_dags'] = $count22;
                $circle_wise_zonal_dag_array['chitha_dags'] = $count23;
                $circle_wise_zonal_dag_array['pending_dags'] = $count23 - $count22;

                $zonal_dag_cir_count['zonal_dag_cir_count'][] = $circle_wise_zonal_dag_array;


                $sql30 = "Select count(DISTINCT unique_village_code) as c from villagewise_zone_info 
                    where subdiv_code=? and cir_code=? and mouza_pargona_code!=?
                    and lot_no!=? and vill_code!=?";
                $count30 = $this->db->query($sql30, array($r21['subdiv_code'], $r21['cir_code'], '00', '00', '00000'))->row()->c;

                $sql31 = "Select count(DISTINCT uuid) as c from location where 
                    subdiv_code=? and cir_code=? and mouza_pargona_code!=?
                    and lot_no!=? and vill_townprt_code!=? and (nc_btad is null or TRIM(nc_btad) = '')";
                $count31 = $this->db->query($sql31, array($r21['subdiv_code'], $r21['cir_code'], '00', '00', '00000'))->row()->c;

                $circle_wise_zonal_village_array = array();
                $circle_wise_zonal_village_array['district_code'] = $d;
                $circle_wise_zonal_village_array['subdiv_code'] = $r21['subdiv_code'];
                $circle_wise_zonal_village_array['cir_code'] = $r21['cir_code'];
                $circle_wise_zonal_village_array['zonal_village'] = $count30;
                $circle_wise_zonal_village_array['chitha_village'] = $count31;
                $circle_wise_zonal_village_array['remaining_village'] = $count31 - $count30;

                $zonal_village_cir_count['zonal_village_cir_count'][] = $circle_wise_zonal_village_array;
            }

            //          $sql32 = "select subdiv_code,cir_code from location where subdiv_code!=?
            //                  and cir_code!=? and mouza_pargona_code=?
            //                    and lot_no=? and vill_townprt_code=?";
            //          $res32 = $this->db->query($sql32,array('00','00','00','00','00000'))->result_array();
            //          $zonal_village_cir_count = array();
            //          foreach($res32 as $r32) {
            //              $sql30 = "Select count(DISTINCT unique_village_code) as c from villagewise_zone_info
            //                  where subdiv_code=? and cir_code=?";
            //              $count30 = $this->db->query($sql30, array($r32['subdiv_code'], $r32['cir_code']))->row()->c;
            //
            //              $sql31 = "Select count(DISTINCT uuid) as c from location where subdiv_code=? and cir_code=?";
            //              $count31 = $this->db->query($sql31,array($r32['subdiv_code'],$r32['cir_code']))->row()->c;
            //
            //              $circle_wise_zonal_village_array = array();
            //              $circle_wise_zonal_village_array['district_code'] = $d;
            //              $circle_wise_zonal_village_array['subdiv_code'] = $r32['subdiv_code'];
            //              $circle_wise_zonal_village_array['cir_code'] = $r32['cir_code'];
            //              $circle_wise_zonal_village_array['zonal_village'] = $count30;
            //              $circle_wise_zonal_village_array['chitha_village'] = $count31;
            //              $circle_wise_zonal_village_array['remaining_village'] = $count31-$count30;
            //
            //              $zonal_village_cir_count['zonal_village_cir_count'][] = $circle_wise_zonal_village_array;
            //          }

            //***** merge circle wise array *********//
            $circle_wise_array_merge[$application_id . $d] = array_merge($circle_wise_dag, $circle_wise_patta, $circle_wise_pattadar, $zonal_dag_cir_count, $zonal_village_cir_count);

            //***** merge lot wise array *********//
            $lot_wise_array_merge[$application_id . $d] = $lot_wise_dag;

            /********* Zonal Value *****************/
            //VILLAGE WISE
            $sql24 = "select * from location where subdiv_code!=? and 
                    cir_code!=? and mouza_pargona_code!=?
                    and lot_no!=? and vill_townprt_code!=? and nc_btad is null
                     order by subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code";
            $res24 = $this->db->query($sql24, array('00', '00', '00', '00', '00000'))->result_array();
            foreach ($res24 as $r24) {
                $sql25 = "Select count(*) as c from dagwise_zone_info where unique_village_code=?";
                $count25 = $this->db->query($sql25, array($r24['uuid']))->row()->c;

                $sql33 = "Select count(*) as c from dagwise_zone_info where unique_village_code=? and flag=?";
                $count33 = $this->db->query($sql33, array($r24['uuid'], '1'))->row()->c;

                // $sql26 = "Select count(*) as c from chitha_basic where subdiv_code=? 
                //     and cir_code=? and mouza_pargona_code=?
                //     and lot_no=? and vill_townprt_code=?";
                // $count26 = $this->db->query($sql26,array($r24['subdiv_code'],$r24['cir_code'],
                //     $r24['mouza_pargona_code'],$r24['lot_no'],$r24['vill_townprt_code']))->row()->c;


                //new
                $sql26 = "Select count(*) as c from chitha_basic where subdiv_code=? 
                    and cir_code=? and mouza_pargona_code=?
                    and lot_no=? and vill_townprt_code=? and 
                    (subdiv_code,cir_code,mouza_pargona_code, lot_no,vill_townprt_code) 
                    in (select subdiv_code,cir_code,mouza_pargona_code, lot_no,vill_townprt_code from 
                    location where (nc_btad is null or TRIM(nc_btad) = '') and subdiv_code=?  
                    and cir_code=? and mouza_pargona_code=? and lot_no=? and  vill_townprt_code=?)";
                $count26 = $this->db->query($sql26, array(
                    $r24['subdiv_code'], $r24['cir_code'],
                    $r24['mouza_pargona_code'], $r24['lot_no'], $r24['vill_townprt_code'], $r24['subdiv_code'], $r24['cir_code'],
                    $r24['mouza_pargona_code'], $r24['lot_no'], $r24['vill_townprt_code']
                ))->row()->c;
                //new

                $vill_wise_zonal_dag_array = array();
                $vill_wise_zonal_dag_array['district_code'] = $d;
                $vill_wise_zonal_dag_array['subdiv_code'] = $r24['subdiv_code'];
                $vill_wise_zonal_dag_array['cir_code'] = $r24['cir_code'];
                $vill_wise_zonal_dag_array['mouza_pargona_code'] = $r24['mouza_pargona_code'];
                $vill_wise_zonal_dag_array['lot_no'] = $r24['lot_no'];
                $vill_wise_zonal_dag_array['vill_townprt_code'] = $r24['vill_townprt_code'];
                $vill_wise_zonal_dag_array['uuid'] = $r24['uuid'];
                $vill_wise_zonal_dag_array['zonal_dags'] = $count25;
                $vill_wise_zonal_dag_array['chitha_dags'] = $count26;
                $vill_wise_zonal_dag_array['pending_dags'] = $count26 - $count25;
                $vill_wise_zonal_dag_array['approve_dags'] = $count33;

                $zonal_vill_count['zonal_dag_count'][$d . '-' . $r24['subdiv_code'] . '-' . $r24['cir_code']][] = $vill_wise_zonal_dag_array;

                $sql29 = "Select count(DISTINCT unique_village_code) as c from villagewise_zone_info 
                        where unique_village_code=?";
                $count29 = $this->db->query($sql29, array($r24['uuid']))->row()->c;

                $sql34 = "Select count(*) as c from villagewise_zone_info 
                        where unique_village_code=? and flag=?";
                $flag34 = $this->db->query($sql34, array($r24['uuid'], '1'))->row()->c;

                $vill_wise_zonal_village_array = array();
                $vill_wise_zonal_village_array['district_code'] = $d;
                $vill_wise_zonal_village_array['subdiv_code'] = $r24['subdiv_code'];
                $vill_wise_zonal_village_array['cir_code'] = $r24['cir_code'];
                $vill_wise_zonal_village_array['mouza_pargona_code'] = $r24['mouza_pargona_code'];
                $vill_wise_zonal_village_array['lot_no'] = $r24['lot_no'];
                $vill_wise_zonal_village_array['vill_townprt_code'] = $r24['vill_townprt_code'];
                $vill_wise_zonal_village_array['uuid'] = $r24['uuid'];
                $vill_wise_zonal_village_array['zonal_village'] = $count29;
                $vill_wise_zonal_village_array['zonal_village_flag'] = $flag34;

                $zonal_vill_count['zonal_vill_count'][$d . '-' . $r24['subdiv_code'] . '-' . $r24['cir_code']][] = $vill_wise_zonal_village_array;
            }

            //total village
            $total_state_village = $total_state_village + sizeof($res24);

            //merge village data
            $village_wise_array_merge[$application_id . $d] = array_merge($zonal_vill_count, $village_wise_dag);

            //district wise
            $sql27 = "Select count(*) as c from dagwise_zone_info";
            $count27 = $this->db->query($sql27)->row()->c;

            $sql28 = "Select count(DISTINCT unique_village_code) as c from villagewise_zone_info";
            $count28 = $this->db->query($sql28)->row()->c;

            $district_wise_zonal_dag_array = array();
            $district_wise_zonal_dag_array['district_code'] = $d;
            $district_wise_zonal_dag_array['zonal_dags'] = $count27;
            $district_wise_zonal_dag_array['chitha_dags'] = $res['dag'];
            $district_wise_zonal_dag_array['pending_dags'] = $res['dag'] - $count27;

            $district_wise_zonal_village_array = array();
            $district_wise_zonal_village_array['district_code'] = $d;
            $district_wise_zonal_village_array['zonal_village'] = $count28;
            $district_wise_zonal_village_array['total_village'] = sizeof($res24);
            $district_wise_zonal_village_array['pending_village'] = sizeof($res24) - $count28;

            $district_wise_array_merge['zonal-dag'][$application_id . $d] = $district_wise_zonal_dag_array;

            $district_wise_array_merge['zonal-village'][$application_id . $d] = $district_wise_zonal_village_array;

            $total_state_zonal_village = $total_state_zonal_village + $count28;
            $total_state_zonal_dags = $total_state_zonal_dags + $count27;
        }
        $total_state_area_brahmaputra_conver = $this->utilityclass->brahmaputra_valley_total_bigha_katha_lessa($total_state_dag_lessa);
        $total_state_area_barak_valley_conver = $this->utilityclass->barak_valley_total_bigha_katha_lessa_ganda($total_state_dag_ganda);

        //**** State Wise Dag *****//
        $total_state_array = array();
        $total_state_array['total_state_dag'] = $total_state_dag;
        $total_state_array['brahmaputra_valley']['total_state_area_bigha'] = $total_state_area_brahmaputra_conver[0];
        $total_state_array['brahmaputra_valley']['total_state_area_katha'] = $total_state_area_brahmaputra_conver[1];
        $total_state_array['brahmaputra_valley']['total_state_area_lessa'] = $total_state_area_brahmaputra_conver[2];

        $total_state_array['barak_valley']['total_state_area_bigha'] = $total_state_area_barak_valley_conver[0];
        $total_state_array['barak_valley']['total_state_area_katha'] = $total_state_area_barak_valley_conver[1];
        $total_state_array['barak_valley']['total_state_area_lessa'] = $total_state_area_barak_valley_conver[2];
        $total_state_array['barak_valley']['total_state_area_ganda'] = $total_state_area_barak_valley_conver[3];

        $total_state_array['total_state_pattadar'] = $total_state_pattadar;
        $total_state_array['total_state_annual_patta'] = $total_state_annual_patta;
        $total_state_array['total_state_periodic_patta'] = $total_state_periodic_patta;
        $total_state_array['total_state_patta'] = $total_state_patta;
        $total_state_array['total_zonal_dags'] = $total_state_zonal_dags;
        $total_state_array['total_zonal_village'] = $total_state_zonal_village;

        //**** State Wise Patta *****//
        //        $total_state_patta_array = array();
        //        $total_state_patta_array['total_state_patta'] = $total_state_patta;

        $json = array();
        //***** DAG & PATTA *****//
        //        $json['total_state'] = array_merge($total_state_array,$total_state_patta_array);
        $json['total_state'] = $total_state_array;
        $json['district_wise'] = $district_wise_array_merge;
        $json['circle_wise'] = $circle_wise_array_merge;
        $json['lot_wise'] = $lot_wise_array_merge;
        $json['village_wise'] = $village_wise_array_merge;

        $state_wise = json_encode($json['total_state']);
        $district_wise = json_encode($json['district_wise']);
        $cirlce_wise = json_encode($json['circle_wise']);
        $lot_wise = json_encode($json['lot_wise']);
        $village_wise = json_encode($json['village_wise']);


        //insert into table ilrms_dashboard_records
        $insertIntoMisDagCount = [
            'application_id' => DHARITREE,
            'statewise_json' => $state_wise,
            'districtwise_json' => $district_wise,
            'circlewise_json' => $cirlce_wise,
            'lotwise_json' => $lot_wise,
            'villagewise_json' => $village_wise,
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

        //var_dump($insertIntoMisDagCount);return;
        $this->db = $this->load->database('db2', TRUE);
        $this->db->trans_begin();
        $ins1 = $this->db->query('delete from ilrms_dashboard_records');
        //      if($this->db->affected_rows() != 1)
        //      {
        //          $this->db->trans_rollback();
        //          echo 'Unable to delete data.';
        //          return;
        //      }

        $ins = $this->db->insert('ilrms_dashboard_records', $insertIntoMisDagCount);
        if ($ins > 0) {
            $this->db->trans_commit();
            echo 'gg: ' . $ins;
        } else {
            $this->db->trans_rollback();
            echo 'Failed Druna';
        }
    }

    //    function Total_Lessa($bigha, $katha, $lessa) {
    //        $total_lessa = $lessa + ($katha * 20) + ($bigha * 100);
    //        return $total_lessa;
    //    }
    //
    //    function Total_Bigha_Katha_Lessa($total_lessa) {
    //        $bigha = $total_lessa / 100;
    //        $rem_lessa = fmod($total_lessa, 100);
    //        $katha = $rem_lessa / 20;
    //        $r_lessa = fmod($rem_lessa, 20);
    //        $mesaure = array();
    //        $mesaure[].=floor($bigha);
    //        $mesaure[].=floor($katha);
    //        $mesaure[].=$r_lessa;
    //        return $mesaure;
    //    }
    //
    //    //for barak valley
    //    function Total_ganda($bigha, $katha, $lessa,$ganda){
    //      $total_ganda = ($bigha * 6400) + ($katha * 320) + ($lessa * 20) + $ganda;
    //      return $total_ganda;
    //  }
    //
    //  function Total_Bigha_Katha_Lessa_Ganda_Kranti($total_ganda)
    //  {
    //      $bigha = $total_ganda / 6400;
    //      $rem_ganda = fmod($total_ganda, 6400);
    //      $katha = $rem_ganda/ 320;
    //      $r_ganda = fmod($rem_ganda, 320);
    //      $lessa = $r_ganda / 20;
    //      $ganda = fmod($r_ganda, 20);
    //      $mesaure = array();
    //      $mesaure[].=floor($bigha);
    //      $mesaure[].=floor($katha);
    //      $mesaure[].=floor($lessa);
    //      $mesaure[].=$ganda;
    //      return $mesaure;
    //  }

    //    function dashboardAPICurl(){
    //     //$url = 'http://localhost/ilrmsdashboard/dashboard-api';
    //     $url = base_url().'dashboard-api';
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    //     $output = curl_exec($ch);
    //     $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //     curl_close($ch);
    //     $data = json_decode($output);

    //     $state_wise = json_encode($data->total_state);
    //     $district_wise = json_encode($data->district_wise);
    //     $cirlce_wise = json_encode($data->circle_wise);

    //  //insert into table ilrms_dashboard_records
    //  $insertIntoMisDagCount = [
    //      'application_id' => DHARITREE,
    //      'statewise_json' => $state_wise,
    //      'districtwise_json' => $district_wise,
    //      'circlewise_json' => $cirlce_wise,
    //      // 'lotwise_json' => $lot_data,
    //      // 'villagewise_json' => $vill_data,
    //      // 'pending_with_dc_json' => $pending_with_dc,
    //      // 'pending_with_adc_json' => $pending_with_dc,
    //      // 'pending_with_co_json' => $pending_with_co,
    //      // 'pending_with_lm_json' => null,
    //      // 'pending_with_sk_json' => null,
    //      // 'pending_with_ast_json' => null,
    //      'created_at' => date('Y-m-d h:i:s'),
    //  ];
    //  $ins = $this->db->insert('ilrms_dashboard_records', $insertIntoMisDagCount);

    // }



    public function backup_json()
    {
        $sqlBak = "Select * from ilrms_dashboard_records order by id DESC";
        $result = $this->db->query($sqlBak)->row();

        $json = json_encode([
            "id" => $result->id,
            "statewise_json" => json_decode($result->statewise_json),
            "districtwise_json" => json_decode($result->districtwise_json),
            "circlewise_json" => json_decode($result->circlewise_json),
            "lotwise_json" => json_decode($result->lotwise_json),
            "villagewise_json" => json_decode($result->villagewise_json),
            "pending_with_dc_json" => json_decode($result->pending_with_dc_json),
            "pending_with_adc_json" => json_decode($result->pending_with_adc_json),
            "pending_with_co_json" => json_decode($result->pending_with_co_json),
            "pending_with_lm_json" => json_decode($result->pending_with_lm_json),
            "pending_with_sk_json" => json_decode($result->pending_with_sk_json),
            "pending_with_ast_json" => json_decode($result->pending_with_ast_json),
            "created_at" => json_decode($result->created_at),
        ]);

        file_put_contents(BACKUP_JSON_DIR . 'ilrms_dashboard_data_' . date("Y-m-d-H-i-s") . '.json', $json);
        echo "********************<br>";
        echo "File Write Complete<br>";
        echo "File name is " . BACKUP_JSON_DIR . 'ilrms_dashboard_data_' . date("Y-m-d-H-i-s") . '.json<br>';
        echo "********************<br>";
        exit;
    }

    // ********** API for Dashboard ************//
    public function dashboardAPIPort()
    {
        log_message('error', 'START COMPLETE PROCESS');
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $dist_code = array();
        //$dist_code[] = '03'; //jorhat

        $dist_code[] = '02'; ///dhubri
        $dist_code[] = '03'; //goalpara
        $dist_code[] = '05'; //barpeta
        $dist_code[] = '06'; //nalbari
        $dist_code[] = '07'; //kamrup
        $dist_code[] = '08'; //darrang
        $dist_code[] = '11'; //sonitpur
        $dist_code[] = '12'; //lakhimpur
        $dist_code[] = '13'; //bongaigaon
        $dist_code[] = '14'; //golaghat
        $dist_code[] = '15'; //jorhat
        $dist_code[] = '16'; //sibsagar
        $dist_code[] = '17'; //dibrugarh
        $dist_code[] = '18'; //tinsukia
        $dist_code[] = '21'; //karimganj
        $dist_code[] = '24'; //kamrupM
        $dist_code[] = '25'; //dhemaji
        $dist_code[] = '32'; //morigaon
        $dist_code[] = '33'; //nagaon
        $dist_code[] = '34'; //majuli
        $dist_code[] = '35'; //biswanath
        $dist_code[] = '36'; //hojai
        $dist_code[] = '37'; //charaideo
        $dist_code[] = '38'; //south salmara
        $dist_code[] = '39'; //bajalii
          
        $total_state_dag = null;
        $total_state_patta = null;
        $total_state_pattadar = null;

        $total_state_land_class = null;
        $total_state_land_area = null;

        $total_state_dag_lessa = null;
        $total_state_dag_ganda = null;

        $total_state_annual_patta = null;
        $total_state_periodic_patta = null;

        $circle_wise_patta = array();
        $circle_wise_dag = array();

        $lot_wise_dag = array();
        $village_wise_dag = array();

        $total_state_zonal_dags = null;
        $total_state_zonal_village = null;

        //********************************************/
        //village land bank 
        $total_state_vlb_dags = null;
        $total_state_vlb_lm_entry_dags = null;
        $total_state_vlb_village = null;
        //********************************************/
        //khatian
        $total_state_khatian_pending_with_co = null;
        $total_state_khatian_approved_by_co = null;
        $total_state_khatian_rayati = null;
        //********************************************/

        $total_state_village = null;

        $bigha = $katha = $lessa = $ganda = $kranti = 0;

        $c_bigha = $c_katha = $c_lessa = $c_ganda = $c_kranti = 0;

        foreach ($dist_code as $d) {
            $this->dbswitch($d);
            $application_id = '01';
            echo $d;
            log_message('error', 'Start Database: ' . $d);

            //******** Dag *********//
            //            $sql = "select count(*) as dag, sum(dag_area_b) as bigha,
            //            sum(dag_area_k) as katha,sum(dag_area_lc) as lessa,
            //            sum(dag_area_g) as ganda,sum(dag_area_kr) as kranti
            //            from chitha_basic";

            $sql = "select sum(cdp.dag_area_b) as bigha,
            sum(cdp.dag_area_k) as katha,sum(cdp.dag_area_lc) as lessa,
            sum(cdp.dag_area_g) as ganda,sum(cdp.dag_area_kr) as kranti,
            count(cdp.dag_no) as dag, count(cdp.dag_no) Filter (where l.rural_urban='U') as urban,
            count(cdp.dag_no) Filter (where l.rural_urban='R') as rural,
            count(cdp.dag_no) Filter (where l.rural_urban not in ('U','R')) as unmapped from 
            chitha_basic cdp join location l on 
            cdp.dist_code=l.dist_code and cdp.subdiv_code=l.subdiv_code and cdp.cir_code=l.cir_code
            and cdp.mouza_pargona_code=l.mouza_pargona_code and cdp.lot_no=l.lot_no and 
            cdp.vill_townprt_code=l.vill_townprt_code";

            $res = $this->db->query($sql)->row_array();
            $total_state_dag = $total_state_dag + $res['dag'];
            $bigha = $res['bigha'];
            $katha = $res['katha'];
            $lessa = $res['lessa'];
            $ganda = $res['ganda'];
            $kranti = $res['kranti'];

            //*** total lessa ******//
            $total_district_dag_lessa = null;
            $total_district_dag_ganda = null;

            //********* 22.06.2022 *********//
            if (in_array($d, BARAK_VALLEY)) {
                $total_district_dag_ganda = $this->utilityclass->barak_valley_total_ganda($bigha, $katha, $lessa, $ganda);
                $total_district_dag_ganda_covert = $this->utilityclass->barak_valley_total_bigha_katha_lessa_ganda(
                    $total_district_dag_ganda
                );
                $total_state_dag_ganda = $total_state_dag_ganda + $total_district_dag_ganda;
            } else {
                $total_district_dag_lessa = $this->utilityclass->brahmaputra_valley_total_lessa($bigha, $katha, $lessa);
                $total_district_dag_lessa_covert = $this->utilityclass->brahmaputra_valley_total_bigha_katha_lessa(
                    $total_district_dag_lessa
                );
                $total_state_dag_lessa = $total_state_dag_lessa + $total_district_dag_lessa;
            }

            //********* 22.06.2022 *********//
            //*** Pattadar District wise ***//
            $sql6 = "Select count(*) as pattadar from chitha_dag_pattadar cdp where 
                    (cdp.p_flag!='1' or cdp.p_flag is null)";
            $res6 = $this->db->query($sql6)->row_array();
            $total_state_pattadar = $total_state_pattadar + $res6['pattadar'];

            if (in_array($d, BARAK_VALLEY)) {
                $district_wise_dag_array = array();
                $district_wise_dag_array['district_code'] = $d;
                $district_wise_dag_array['district_wise_dag'] = $res['dag'];
                $district_wise_dag_array['district_rural_dag'] = $res['rural'];
                $district_wise_dag_array['district_urban_dag'] = $res['urban'];
                $district_wise_dag_array['district_unmapped_dag'] = $res['unmapped'];
                $district_wise_dag_array['district_wise_dag_area_bigha'] = $total_district_dag_ganda_covert[0];
                $district_wise_dag_array['district_wise_dag_area_katha'] =  $total_district_dag_ganda_covert[1];
                $district_wise_dag_array['district_wise_dag_area_lessa'] =  $total_district_dag_ganda_covert[2];
                $district_wise_dag_array['district_wise_dag_area_ganda'] = $total_district_dag_ganda_covert[3];
                $district_wise_dag_array['district_wise_dag_area_kranti'] = $res['kranti'];
                $district_wise_dag_array['district_wise_pattadar'] = $res6['pattadar'];
            } else {
                $district_wise_dag_array = array();
                $district_wise_dag_array['district_code'] = $d;
                $district_wise_dag_array['district_wise_dag'] = $res['dag'];
                $district_wise_dag_array['district_rural_dag'] = $res['rural'];
                $district_wise_dag_array['district_urban_dag'] = $res['urban'];
                $district_wise_dag_array['district_unmapped_dag'] = $res['unmapped'];
                $district_wise_dag_array['district_wise_dag_area_bigha'] = $total_district_dag_lessa_covert[0];
                $district_wise_dag_array['district_wise_dag_area_katha'] =  $total_district_dag_lessa_covert[1];
                $district_wise_dag_array['district_wise_dag_area_lessa'] =  $total_district_dag_lessa_covert[2];
                $district_wise_dag_array['district_wise_dag_area_ganda'] = $res['ganda'];
                $district_wise_dag_array['district_wise_dag_area_kranti'] = $res['kranti'];
                $district_wise_dag_array['district_wise_pattadar'] = $res6['pattadar'];
            }

            //*********** get dag chitha details upto circle *************//

            //            $sql5 = "select count(*) as dag, sum(dag_area_b) as bigha,
            //            sum(dag_area_k) as katha,sum(dag_area_lc) as lessa,
            //            sum(dag_area_g) as ganda,sum(dag_area_kr) as kranti,
            //                    dist_code,subdiv_code,cir_code from
            //                    chitha_basic group by dist_code,subdiv_code,cir_code";

            $sql5 = "select cdp.dist_code,cdp.subdiv_code, cdp.cir_code, sum(cdp.dag_area_b) as bigha,
            sum(cdp.dag_area_k) as katha,sum(cdp.dag_area_lc) as lessa,
            sum(cdp.dag_area_g) as ganda,sum(cdp.dag_area_kr) as kranti,
            count(cdp.dag_no) as dag, count(cdp.dag_no) Filter (where l.rural_urban='U') as urban,
            count(cdp.dag_no) Filter (where l.rural_urban='R') as rural,
            count(cdp.dag_no) Filter (where l.rural_urban not in ('U','R')) as unmapped from 
            chitha_basic cdp join location l on 
            cdp.dist_code=l.dist_code and cdp.subdiv_code=l.subdiv_code and cdp.cir_code=l.cir_code
            and cdp.mouza_pargona_code=l.mouza_pargona_code and cdp.lot_no=l.lot_no and 
            cdp.vill_townprt_code=l.vill_townprt_code group by cdp.dist_code,cdp.subdiv_code,
            cdp.cir_code";
            $circle_wise_dag['dag'] = $this->db->query($sql5)->result_array();

            /******* 08.07.2022 **********/
            //*********** get dag chitha lot wise *************//
            //          $sql36 = "select count(*) as dag, sum(dag_area_b) as bigha,
            //            sum(dag_area_k) as katha,sum(dag_area_lc) as lessa,
            //            sum(dag_area_g) as ganda,sum(dag_area_kr) as kranti,
            //                    dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no from
            //                    chitha_basic group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no";

            $sql36 = "select cdp.dist_code,cdp.subdiv_code, cdp.cir_code,cdp.mouza_pargona_code,cdp.lot_no,
            sum(cdp.dag_area_b) as bigha,
            sum(cdp.dag_area_k) as katha,sum(cdp.dag_area_lc) as lessa,
            sum(cdp.dag_area_g) as ganda,sum(cdp.dag_area_kr) as kranti,
            count(cdp.dag_no) as dag, count(cdp.dag_no) Filter (where l.rural_urban='U') as urban,
            count(cdp.dag_no) Filter (where l.rural_urban='R') as rural,
            count(cdp.dag_no) Filter (where l.rural_urban not in ('U','R')) as unmapped from 
            chitha_basic cdp join location l on 
            cdp.dist_code=l.dist_code and cdp.subdiv_code=l.subdiv_code and cdp.cir_code=l.cir_code
            and cdp.mouza_pargona_code=l.mouza_pargona_code and cdp.lot_no=l.lot_no and 
            cdp.vill_townprt_code=l.vill_townprt_code group by cdp.dist_code,cdp.subdiv_code,
            cdp.cir_code,cdp.mouza_pargona_code,cdp.lot_no";
            $dag_lot_wise = $this->db->query($sql36)->result_array();

            foreach ($dag_lot_wise as $lot) {
                $lot_wise_dag['dag'][$d . '-' . $lot['subdiv_code'] . '-' . $lot['cir_code']][] = $lot;
            }

            //*********** get dag chitha Village wise *************//
            //          $sql37 = "select count(*) as dag, sum(dag_area_b) as bigha,
            //            sum(dag_area_k) as katha,sum(dag_area_lc) as lessa,
            //            sum(dag_area_g) as ganda,sum(dag_area_kr) as kranti,
            //                    dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code from
            //                    chitha_basic group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code";

            $sql37 = "select cdp.dist_code,cdp.subdiv_code, cdp.cir_code,
            cdp.mouza_pargona_code,cdp.lot_no,cdp.vill_townprt_code,
            sum(cdp.dag_area_b) as bigha,
            sum(cdp.dag_area_k) as katha,sum(cdp.dag_area_lc) as lessa,
            sum(cdp.dag_area_g) as ganda,sum(cdp.dag_area_kr) as kranti,
            count(cdp.dag_no) as dag, count(cdp.dag_no) Filter (where l.rural_urban='U') as urban,
            count(cdp.dag_no) Filter (where l.rural_urban='R') as rural,
            count(cdp.dag_no) Filter (where l.rural_urban not in ('U','R')) as unmapped from 
            chitha_basic cdp join location l on 
            cdp.dist_code=l.dist_code and cdp.subdiv_code=l.subdiv_code and cdp.cir_code=l.cir_code
            and cdp.mouza_pargona_code=l.mouza_pargona_code and cdp.lot_no=l.lot_no and 
            cdp.vill_townprt_code=l.vill_townprt_code group by cdp.dist_code,cdp.subdiv_code,
            cdp.cir_code,cdp.mouza_pargona_code,cdp.lot_no,cdp.vill_townprt_code";

            $dag_village_wise = $this->db->query($sql37)->result_array();

            foreach ($dag_village_wise as $vill) {
                $village_wise_dag['dag'][$d . '-' . $vill['subdiv_code'] . '-' . $vill['cir_code'] . '-' .
                    $vill['mouza_pargona_code'] . '-' . $vill['lot_no']][] = $vill;
            }

            //******** Patta *********//
            $sql2 = "Select count(t.countpatta_no) as totalpatta from
                    (Select count(distinct(patta_no) ) as countpatta_no from chitha_basic
                    where patta_type_code  in (select type_code from patta_code where jamabandi='y')
               group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
               vill_townprt_code,patta_no,patta_type_code ) as t ";
            $totalPatta = $this->db->query($sql2)->row_array();
            $total_state_patta = $total_state_patta + $totalPatta['totalpatta'];

            $district_patta_array = array();
            $district_patta_array['district_code'] = $d;
            $district_patta_array['district_wise_patta'] = $totalPatta['totalpatta'];
            if (in_array($d, BARAK_VALLEY)) {
                $district_wise_array_merge['barak_valley'][$application_id . $d] = array_merge(
                    $district_wise_dag_array,
                    $district_patta_array
                );
            } else {
                $district_wise_array_merge['brahmaputra_valley'][$application_id . $d] = array_merge(
                    $district_wise_dag_array,
                    $district_patta_array
                );
            }

            //********* 27.06.2022 *********//
            //****** patta Type wise ***********//
            $Patta_type_wise = null;
            $sql8 = "Select count(t.countpatta_no) as totalpatta,t.patta_type,t.dist_code from
                    (Select count(distinct(patta_no)) as countpatta_no, patta_type_code as patta_type,
                    dist_code
                    from chitha_basic
                    where patta_type_code in (select type_code from patta_code where jamabandi='y')
               group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
               vill_townprt_code,patta_no,patta_type_code ) as t GROUP BY t.patta_type,t.dist_code";
            $Patta_type_wise = $this->db->query($sql8)->result_array();

            $district_wise_array_merge['patta_type_district_wise'][$application_id . $d] = $Patta_type_wise;

            //****** Patta Type Circle Wise ***********//
            $Patta_type_circle_wise = null;
            $sql9 = "Select count(t.countpatta_no) as totalpatta,t.patta_type,t.dist_code,t.subdiv_code,t.cir_code from
                    (Select count(distinct(patta_no)) as countpatta_no, patta_type_code as patta_type,
                    dist_code,subdiv_code,cir_code
                    from chitha_basic
                    where patta_type_code in (select type_code from patta_code where jamabandi='y')
               group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
               vill_townprt_code,patta_no,patta_type_code ) as t GROUP BY t.patta_type,t.dist_code,
               t.subdiv_code,t.cir_code order by t.subdiv_code ASC,t.cir_code ASC";
            $Patta_type_circle_wise = $this->db->query($sql9)->result_array();

            $circle_wise_patta['patta_type_circle_wise'] = $Patta_type_circle_wise;

            //*** annual patta District wise ***//
            $sql10 = "Select count(t.countpatta_no) as totalpatta,t.patta_type,t.dist_code from 
                    (Select count(distinct(patta_no) ) as countpatta_no, patta_type_code as patta_type,
                    dist_code from 
                    chitha_basic  where patta_type_code in (select type_code from patta_code where
                     apcancellation='y')
                    group by dist_code,subdiv_code,cir_code,
                    mouza_pargona_code,lot_no,vill_townprt_code,patta_no,patta_type_code ) as t 
                    GROUP BY t.patta_type,t.dist_code";
            $annual_patta = $this->db->query($sql10)->result_array();

            foreach ($annual_patta as $ap) {
                $total_state_annual_patta = $total_state_annual_patta + $ap['totalpatta'];
            }

            $district_wise_array_merge['annual_patta_district_wise'][$application_id . $d] =  $annual_patta;

            //*** periodic patta District wise ***//
            $sql10 = "Select count(t.countpatta_no) as totalpatta,t.patta_type,t.dist_code from 
                    (Select count(distinct(patta_no) ) as countpatta_no,patta_type_code as patta_type,
                    dist_code from 
                    chitha_basic  where patta_type_code in (select type_code from  patta_code where 
                    jamabandi='y' and apcancellation is null)
                    group by dist_code,subdiv_code,cir_code,
                    mouza_pargona_code,lot_no,vill_townprt_code,patta_no,patta_type_code ) as t
                    GROUP BY t.patta_type,t.dist_code";
            $periodic_patta = $this->db->query($sql10)->result_array();

            foreach ($periodic_patta as $pp) {
                $total_state_periodic_patta = $total_state_periodic_patta + $pp['totalpatta'];
            }

            $district_wise_array_merge['periodic_patta_district_wise'][$application_id . $d] =  $periodic_patta;

            //*********** get patta chitha details upto circle *************//
            $sql4 = "Select count(t.patta_no) as totalpatta,t.dist_code,t.subdiv_code,t.cir_code from
                    (Select count(distinct(patta_no))  as patta_no,dist_code,subdiv_code,cir_code from chitha_basic
                    where patta_type_code  in (select type_code from patta_code where jamabandi=?)
               group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
               vill_townprt_code,patta_no,patta_type_code ) AS t  GROUP BY t.dist_code,t.subdiv_code,t.cir_code";
            $circle_wise_patta['patta'] = $this->db->query($sql4, array('y'))->result_array();

            //********* 28.06.2022 *********//
            //*********** get annual patta circle wise *************//
            $sql11 = "Select count(t.patta_no) as totalpatta,t.patta_type,t.dist_code,t.subdiv_code,t.cir_code from
                    (Select count(distinct(patta_no))  as patta_no,patta_type_code as patta_type,
                    dist_code,subdiv_code,cir_code from chitha_basic
                    where patta_type_code  in (select type_code from patta_code where
                     apcancellation='y')
               group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
               vill_townprt_code,patta_no,patta_type_code ) AS t  GROUP BY t.patta_type,
               t.dist_code,t.subdiv_code,t.cir_code order by t.subdiv_code ASC,t.cir_code ASC";
            $circle_wise_patta['annual-patta'] = $this->db->query($sql11)->result_array();

            //*********** get periodic patta circle wise *************//
            $sql12 = "Select count(t.patta_no) as totalpatta,t.patta_type,t.dist_code,t.subdiv_code,t.cir_code from
                    (Select count(distinct(patta_no))  as patta_no,patta_type_code as patta_type,
                    dist_code,subdiv_code,cir_code from chitha_basic
                    where patta_type_code  in (select type_code from  patta_code where 
                    jamabandi='y' and apcancellation is null)
               group by dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
               vill_townprt_code,patta_no,patta_type_code ) AS t  GROUP BY t.patta_type,
               t.dist_code,t.subdiv_code,t.cir_code order by t.subdiv_code ASC,t.cir_code ASC";
            $circle_wise_patta['periodic-patta'] = $this->db->query($sql12)->result_array();

            //********* 22.06.2022 *********//
            //******* Pattadar circle wise ***********//
            $sql7 = "Select count(*) as pattadar,dist_code,subdiv_code,cir_code from chitha_dag_pattadar cdp where 
            (cdp.p_flag!='1' or cdp.p_flag is null) group by dist_code,subdiv_code,cir_code";
            $circle_wise_pattadar['pattadar'] = $this->db->query($sql7)->result_array();

            /********* Zonal Value *****************/
            //CIRCLE WISE
            $sql21 = "select subdiv_code,cir_code from location where subdiv_code!=? 
                    and cir_code!=? and mouza_pargona_code=?
                    and lot_no=? and vill_townprt_code=?";
            $res21 = $this->db->query($sql21, array('00', '00', '00', '00', '00000'))->result_array();
            $zonal_dag_cir_count = array();
            $zonal_village_cir_count = array();
            $vlb_dag_cir_count = array();
            $khatian_cir_count = array();

            foreach ($res21 as $r21) {
                //khatian 
                //pending_with_co
                $sqlKhatian20 = "select count(*) as c from (select distinct on (uuid, khatian_no) uuid, khatian_no, count(*) from temp_khatian where status='P' and subdiv_code = ? and cir_code = ? group by uuid, khatian_no ) as c";
                $countKhatian20 = $this->db->query($sqlKhatian20, array($r21['subdiv_code'], $r21['cir_code']))->row()->c;
                //approved_by_co
                $sqlKhatian21 = "select count(*) as c from (select distinct on (uuid,id) uuid,id from khatian where subdiv_code = ? and cir_code = ? group by uuid,id ) as c";
                $countKhatian21 = $this->db->query($sqlKhatian21, array($r21['subdiv_code'], $r21['cir_code']))->row()->c;
                // khatian rayati
                $sqlKhatian22 = "select count(*) as c from chitha_tenant where subdiv_code=? and cir_code=?";
                $countKhatian22 = $this->db->query($sqlKhatian22, array(
                    $r21['subdiv_code'],
                    $r21['cir_code']
                ))->row()->c;

                $cir_wise_khantian_array = array();
                $cir_wise_khantian_array['district_code'] = $d;
                $cir_wise_khantian_array['subdiv_code'] = $r21['subdiv_code'];
                $cir_wise_khantian_array['cir_code'] = $r21['cir_code'];
                $cir_wise_khantian_array['approved_by_co_count'] = $countKhatian21;
                $cir_wise_khantian_array['pending_with_co_count'] = $countKhatian20;
                $cir_wise_khantian_array['khatian_rayati_count'] = $countKhatian22;
                $khatian_cir_count['khatian_cir_count'][] = $cir_wise_khantian_array;
                //log_message('error',json_encode($cir_wise_khantian_array));
                //**************************************************/
                //village-land-bank
                $sqlVlb4 = "Select count(*) as c from c_land_bank_details where 
                    subdiv_code=? and cir_code=? and mouza_pargona_code!=?
                    and lot_no!=? and vill_townprt_code!=?";
                $countVlb4 = $this->db->query($sqlVlb4, array($r21['subdiv_code'], $r21['cir_code'], '00', '00', '00000'))->row()->c;

                $sqlVlbLm2 = "Select count(*) as c from land_bank_details where 
                    subdiv_code=? and cir_code=? and mouza_pargona_code!=?
                    and lot_no!=? and vill_townprt_code!=? and status='P'";
                $countVlbLm2 = $this->db->query($sqlVlbLm2, array($r21['subdiv_code'], $r21['cir_code'], '00', '00', '00000'))->row()->c;

                $sqlVlb5 = "Select count(*) as c from chitha_basic where 
                    subdiv_code=? and cir_code=? and mouza_pargona_code!=?
                    and lot_no!=? and vill_townprt_code!=? and patta_type_code 
                    in (select type_code from patta_code where jamabandi='n') 
                    and (dag_area_b*100+dag_area_k*20+dag_area_lc::int) > 0 and 
                    (subdiv_code,cir_code,mouza_pargona_code, lot_no,vill_townprt_code) 
                    in (select subdiv_code,cir_code,mouza_pargona_code, lot_no,vill_townprt_code from 
                    location where nc_btad is null or TRIM(nc_btad) = '' and subdiv_code=? and cir_code=?)";
                $countVlb5 = $this->db->query($sqlVlb5, array(
                    $r21['subdiv_code'], $r21['cir_code'], '00', '00', '00000',
                    $r21['subdiv_code'], $r21['cir_code']
                ))->row()->c;

                /*$sql2 = "select count(*) as c from chitha_basic where subdiv_code=? and 
                    cir_code=? and patta_type_code in (select type_code from patta_code 
                    where jamabandi='n') and (dag_area_b*100+dag_area_k*20+dag_area_lc::int) > 0
                    and (dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,trim(dag_no)) 
                    not in (select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,
                    trim(dag_no) from c_land_bank_details where subdiv_code=? and 
                    cir_code=?) and (dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
                    vill_townprt_code) in (select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
                    vill_townprt_code from location where nc_btad is null and subdiv_code=? and cir_code=?)";*/
                $sql2 = "select count(*) as c from chitha_basic cb join patta_code pc on pc.type_code=cb.patta_type_code 
 			     join location l on cb.subdiv_code=l.subdiv_code and cb.cir_code=l.cir_code and 
     			         cb.mouza_pargona_code=l.mouza_pargona_code and cb.lot_no=l.lot_no and 
     			 	 cb.vill_townprt_code=l.vill_townprt_code
   			     where 
   			         cb.subdiv_code=? and cb.cir_code=? and 
    				(dag_area_b*100+dag_area_k*20+dag_area_lc::int) > 0 and pc.jamabandi='n' and 
			 	(cb.dist_code,cb.subdiv_code,cb.cir_code,cb.mouza_pargona_code,cb.lot_no,
					 cb.vill_townprt_code,trim(dag_no)) 
			 	  not in (select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
					  vill_townprt_code, trim(dag_no) 
				  	from c_land_bank_details where subdiv_code=? and cir_code=?) and l.nc_btad is null";
                $overallpending = $this->db->query($sql2, array(
                    $r21['subdiv_code'], $r21['cir_code'], $r21['subdiv_code'], $r21['cir_code']
                ));
                if ($overallpending->num_rows() > 0) {
                    $vlb_pending_count_cir_wise = $overallpending->row()->c;
                } else {
                    $vlb_pending_count_cir_wise = 0;
                }
                //*****************************************************/
                // $vlb_pending_count_cir_wise = $countVlb5-$countVlb4;
                // if($vlb_pending_count_cir_wise < 0){
                //     $vlb_pending_count_cir_wise = 0;
                // }else{
                //     $vlb_pending_count_cir_wise = $vlb_pending_count_cir_wise;
                // }
                //*****************************************************/
                $circle_wise_vlb_dag_array = array();
                $circle_wise_vlb_dag_array['district_code'] = $d;
                $circle_wise_vlb_dag_array['subdiv_code'] = $r21['subdiv_code'];
                $circle_wise_vlb_dag_array['cir_code'] = $r21['cir_code'];
                $circle_wise_vlb_dag_array['vlb_dags'] = $countVlb4;
                $circle_wise_vlb_dag_array['pending_with_co'] = $countVlbLm2;
                $circle_wise_vlb_dag_array['chitha_dags'] = $countVlb5;
                $circle_wise_vlb_dag_array['pending_dags'] = $vlb_pending_count_cir_wise;
                $vlb_dag_cir_count['vlb_dag_cir_count'][] = $circle_wise_vlb_dag_array;
                //**************************************************/

                $sql22 = "Select count(*) as c from dagwise_zone_info where 
                    subdiv_code=? and cir_code=? and mouza_pargona_code!=?
                    and lot_no!=? and vill_code!=?";
                $count22 = $this->db->query($sql22, array($r21['subdiv_code'], $r21['cir_code'], '00', '00', '00000'))->row()->c;

                // $sql23 = "Select count(*) as c from chitha_basic where 
                // subdiv_code=? and cir_code=? and mouza_pargona_code!=?
                //     and lot_no!=? and vill_townprt_code!=?";
                // $count23 = $this->db->query($sql23,array($r21['subdiv_code'],$r21['cir_code'],'00','00','00000'))->row()->c;

                // new 
                $sql23 = "Select count(*) as c from chitha_basic where subdiv_code=? 
                    and cir_code=? and 
                    (subdiv_code,cir_code) 
                    in (select subdiv_code,cir_code from 
                    location where (nc_btad is null or TRIM(nc_btad) = '') and subdiv_code=?  
                    and cir_code=?)";
                $count23 = $this->db->query(
                    $sql23,
                    array($r21['subdiv_code'], $r21['cir_code'], $r21['subdiv_code'], $r21['cir_code'])
                )->row()->c;
                // new

                $circle_wise_zonal_dag_array = array();
                $circle_wise_zonal_dag_array['district_code'] = $d;
                $circle_wise_zonal_dag_array['subdiv_code'] = $r21['subdiv_code'];
                $circle_wise_zonal_dag_array['cir_code'] = $r21['cir_code'];
                $circle_wise_zonal_dag_array['zonal_dags'] = $count22;
                $circle_wise_zonal_dag_array['chitha_dags'] = $count23;
                $circle_wise_zonal_dag_array['pending_dags'] = $count23 - $count22;

                $zonal_dag_cir_count['zonal_dag_cir_count'][] = $circle_wise_zonal_dag_array;


                $sql30 = "Select count(DISTINCT unique_village_code) as c from villagewise_zone_info 
                    where subdiv_code=? and cir_code=? and mouza_pargona_code!=?
                    and lot_no!=? and vill_code!=?";
                $count30 = $this->db->query($sql30, array($r21['subdiv_code'], $r21['cir_code'], '00', '00', '00000'))->row()->c;

                $sql31 = "Select count(DISTINCT uuid) as c from location where 
                    subdiv_code=? and cir_code=? and mouza_pargona_code!=?
                    and lot_no!=? and vill_townprt_code!=? and (nc_btad is null or TRIM(nc_btad) = '')";
                $count31 = $this->db->query($sql31, array($r21['subdiv_code'], $r21['cir_code'], '00', '00', '00000'))->row()->c;

                $circle_wise_zonal_village_array = array();
                $circle_wise_zonal_village_array['district_code'] = $d;
                $circle_wise_zonal_village_array['subdiv_code'] = $r21['subdiv_code'];
                $circle_wise_zonal_village_array['cir_code'] = $r21['cir_code'];
                $circle_wise_zonal_village_array['zonal_village'] = $count30;
                $circle_wise_zonal_village_array['chitha_village'] = $count31;
                $circle_wise_zonal_village_array['remaining_village'] = $count31 - $count30;

                $zonal_village_cir_count['zonal_village_cir_count'][] = $circle_wise_zonal_village_array;

                //
            }

            //          $sql32 = "select subdiv_code,cir_code from location where subdiv_code!=?
            //                  and cir_code!=? and mouza_pargona_code=?
            //                    and lot_no=? and vill_townprt_code=?";
            //          $res32 = $this->db->query($sql32,array('00','00','00','00','00000'))->result_array();
            //          $zonal_village_cir_count = array();
            //          foreach($res32 as $r32) {
            //              $sql30 = "Select count(DISTINCT unique_village_code) as c from villagewise_zone_info
            //                  where subdiv_code=? and cir_code=?";
            //              $count30 = $this->db->query($sql30, array($r32['subdiv_code'], $r32['cir_code']))->row()->c;
            //
            //              $sql31 = "Select count(DISTINCT uuid) as c from location where subdiv_code=? and cir_code=?";
            //              $count31 = $this->db->query($sql31,array($r32['subdiv_code'],$r32['cir_code']))->row()->c;
            //
            //              $circle_wise_zonal_village_array = array();
            //              $circle_wise_zonal_village_array['district_code'] = $d;
            //              $circle_wise_zonal_village_array['subdiv_code'] = $r32['subdiv_code'];
            //              $circle_wise_zonal_village_array['cir_code'] = $r32['cir_code'];
            //              $circle_wise_zonal_village_array['zonal_village'] = $count30;
            //              $circle_wise_zonal_village_array['chitha_village'] = $count31;
            //              $circle_wise_zonal_village_array['remaining_village'] = $count31-$count30;
            //
            //              $zonal_village_cir_count['zonal_village_cir_count'][] = $circle_wise_zonal_village_array;
            //          }

            //***** merge circle wise array *********//
            $circle_wise_array_merge[$application_id . $d] = array_merge($circle_wise_dag, $circle_wise_patta, $circle_wise_pattadar, $zonal_dag_cir_count, $zonal_village_cir_count, $vlb_dag_cir_count, $khatian_cir_count);

            //***** merge lot wise array *********//
            $lot_wise_array_merge[$application_id . $d] = $lot_wise_dag;

            /********* Zonal Value *****************/
            //VILLAGE WISE
            $sql24 = "select * from location where subdiv_code!=? and 
                    cir_code!=? and mouza_pargona_code!=?
                    and lot_no!=? and vill_townprt_code!=? and nc_btad is null
                    order by subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code";
            $res24 = $this->db->query($sql24, array('00', '00', '00', '00', '00000'))->result_array();
            $zonal_vill_count = array();
            $vlb_vill_wise_count = array();
            $khatian_vill_wise_count = array();

            foreach ($res24 as $r24) {
                //khatian 
                //pending_with_co
                $sqlKhatian3 = "select count(*) as c from (select distinct on (uuid, khatian_no) uuid, khatian_no, count(*) from temp_khatian where status='P' and uuid=? group by uuid, khatian_no ) as c";
                $countKhatian3 = $this->db->query($sqlKhatian3, array($r24['uuid']))->row()->c;
                //approved_by_co
                $sqlKhatian4 = "select count(*) as c from (select distinct on (uuid,id) uuid,id from khatian where  uuid=? group by uuid, id ) as c";
                $countKhatian4 = $this->db->query($sqlKhatian4, array($r24['uuid']))->row()->c;
                // khatian rayati
                $sqlKhatian11 = "select count(*) as c from chitha_tenant where subdiv_code = ? and cir_code = ? and mouza_pargona_code =? and lot_no =? 
                and vill_townprt_code = ?";
                $countKhatian11 = $this->db->query($sqlKhatian11, array(
                    $r24['subdiv_code'],
                    $r24['cir_code'], $r24['mouza_pargona_code'], $r24['lot_no'], $r24['vill_townprt_code']
                ))->row()->c;

                $vill_wise_khantian_array = array();
                $vill_wise_khantian_array['district_code'] = $d;
                $vill_wise_khantian_array['subdiv_code'] = $r24['subdiv_code'];
                $vill_wise_khantian_array['cir_code'] = $r24['cir_code'];
                $vill_wise_khantian_array['mouza_pargona_code'] = $r24['mouza_pargona_code'];
                $vill_wise_khantian_array['lot_no'] = $r24['lot_no'];
                $vill_wise_khantian_array['vill_townprt_code'] = $r24['vill_townprt_code'];
                $vill_wise_khantian_array['uuid'] = $r24['uuid'];
                $vill_wise_khantian_array['approved_by_co_count'] = $countKhatian4;
                $vill_wise_khantian_array['pending_with_co_count'] = $countKhatian3;
                $vill_wise_khantian_array['khatian_rayati_count'] = $countKhatian11;

                $khatian_vill_wise_count['khatian_vill_wise_count'][$d . '-' . $r24['subdiv_code'] . '-' . $r24['cir_code']][] = $vill_wise_khantian_array;

                //******************************/
                //village land bank village wise 
                //chitha dag count 
                $sqlVlb_CV = "Select count(*) as c from chitha_basic where subdiv_code=? 
                    and cir_code=? and mouza_pargona_code=? and lot_no=? and vill_townprt_code=?
                    and patta_type_code in (select type_code from patta_code where jamabandi='n')
                    and (dag_area_b*100+dag_area_k*20+dag_area_lc::int) > 0 and 
                    (subdiv_code,cir_code,mouza_pargona_code, lot_no,vill_townprt_code) 
                    in (select subdiv_code,cir_code,mouza_pargona_code, lot_no,vill_townprt_code from 
                    location where nc_btad is null or TRIM(nc_btad) = '' and subdiv_code=?  
                    and cir_code=? and mouza_pargona_code=? and lot_no=? and  vill_townprt_code=?)";
                $countVlb_CV = $this->db->query($sqlVlb_CV, array(
                    $r24['subdiv_code'], $r24['cir_code'],
                    $r24['mouza_pargona_code'], $r24['lot_no'], $r24['vill_townprt_code'], $r24['subdiv_code'], $r24['cir_code'],
                    $r24['mouza_pargona_code'], $r24['lot_no'], $r24['vill_townprt_code']
                ))->row()->c;

                //Approved by co  
                $sqlVlb6 = "Select count(*) as c from c_land_bank_details where village_uuid=?";
                $countVlb6 = $this->db->query($sqlVlb6, array($r24['uuid']))->row()->c;

                //Updated By Lm
                $sqlVlb7 = "Select count(*) as c from land_bank_details where village_uuid=? and status='P'";
                $countVlb7 = $this->db->query($sqlVlb7, array($r24['uuid']))->row()->c;

                $vill_wise_vlb_dag_array = array();
                $vill_wise_vlb_dag_array['district_code'] = $d;
                $vill_wise_vlb_dag_array['subdiv_code'] = $r24['subdiv_code'];
                $vill_wise_vlb_dag_array['cir_code'] = $r24['cir_code'];
                $vill_wise_vlb_dag_array['mouza_pargona_code'] = $r24['mouza_pargona_code'];
                $vill_wise_vlb_dag_array['lot_no'] = $r24['lot_no'];
                $vill_wise_vlb_dag_array['vill_townprt_code'] = $r24['vill_townprt_code'];
                $vill_wise_vlb_dag_array['uuid'] = $r24['uuid'];
                $vill_wise_vlb_dag_array['chitha_dags'] = $countVlb_CV;
                $vill_wise_vlb_dag_array['approved_by_co_count'] = $countVlb6;
                $vill_wise_vlb_dag_array['updated_by_lm_count'] = $countVlb7;

                $vlb_vill_wise_count['vlg_vill_wise_counts'][$d . '-' . $r24['subdiv_code'] . '-' . $r24['cir_code']][] = $vill_wise_vlb_dag_array;
                //******************************/

                $sql25 = "Select count(*) as c from dagwise_zone_info where unique_village_code=?";
                $count25 = $this->db->query($sql25, array($r24['uuid']))->row()->c;

                $sql33 = "Select count(*) as c from dagwise_zone_info where unique_village_code=? and flag=?";
                $count33 = $this->db->query($sql33, array($r24['uuid'], '1'))->row()->c;

                // $sql26 = "Select count(*) as c from chitha_basic where subdiv_code=? 
                //     and cir_code=? and mouza_pargona_code=?
                //     and lot_no=? and vill_townprt_code=?";
                // $count26 = $this->db->query($sql26,array($r24['subdiv_code'],$r24['cir_code'],
                //     $r24['mouza_pargona_code'],$r24['lot_no'],$r24['vill_townprt_code']))->row()->c;


                // new 
                $sql26 = "Select count(*) as c from chitha_basic where subdiv_code=? 
                    and cir_code=? and mouza_pargona_code=?
                    and lot_no=? and vill_townprt_code=? and 
                    (subdiv_code,cir_code,mouza_pargona_code, lot_no,vill_townprt_code) 
                    in (select subdiv_code,cir_code,mouza_pargona_code, lot_no,vill_townprt_code from 
                    location where (nc_btad is null or TRIM(nc_btad) = '') and subdiv_code=?  
                    and cir_code=? and mouza_pargona_code=? and lot_no=? and  vill_townprt_code=?)";
                $count26 = $this->db->query($sql26, array(
                    $r24['subdiv_code'], $r24['cir_code'],
                    $r24['mouza_pargona_code'], $r24['lot_no'], $r24['vill_townprt_code'], $r24['subdiv_code'], $r24['cir_code'],
                    $r24['mouza_pargona_code'], $r24['lot_no'], $r24['vill_townprt_code']
                ))->row()->c;
                // new

                $vill_wise_zonal_dag_array = array();
                $vill_wise_zonal_dag_array['district_code'] = $d;
                $vill_wise_zonal_dag_array['subdiv_code'] = $r24['subdiv_code'];
                $vill_wise_zonal_dag_array['cir_code'] = $r24['cir_code'];
                $vill_wise_zonal_dag_array['mouza_pargona_code'] = $r24['mouza_pargona_code'];
                $vill_wise_zonal_dag_array['lot_no'] = $r24['lot_no'];
                $vill_wise_zonal_dag_array['vill_townprt_code'] = $r24['vill_townprt_code'];
                $vill_wise_zonal_dag_array['uuid'] = $r24['uuid'];
                $vill_wise_zonal_dag_array['zonal_dags'] = $count25;
                $vill_wise_zonal_dag_array['chitha_dags'] = $count26;
                $vill_wise_zonal_dag_array['pending_dags'] = $count26 - $count25;
                $vill_wise_zonal_dag_array['approve_dags'] = $count33;

                $zonal_vill_count['zonal_dag_count'][$d . '-' . $r24['subdiv_code'] . '-' . $r24['cir_code']][] = $vill_wise_zonal_dag_array;

                $sql29 = "Select count(DISTINCT unique_village_code) as c from villagewise_zone_info 
                        where unique_village_code=?";
                $count29 = $this->db->query($sql29, array($r24['uuid']))->row()->c;

                $sql34 = "Select count(*) as c from villagewise_zone_info 
                        where unique_village_code=? and flag=?";
                $flag34 = $this->db->query($sql34, array($r24['uuid'], '1'))->row()->c;

                $vill_wise_zonal_village_array = array();
                $vill_wise_zonal_village_array['district_code'] = $d;
                $vill_wise_zonal_village_array['subdiv_code'] = $r24['subdiv_code'];
                $vill_wise_zonal_village_array['cir_code'] = $r24['cir_code'];
                $vill_wise_zonal_village_array['mouza_pargona_code'] = $r24['mouza_pargona_code'];
                $vill_wise_zonal_village_array['lot_no'] = $r24['lot_no'];
                $vill_wise_zonal_village_array['vill_townprt_code'] = $r24['vill_townprt_code'];
                $vill_wise_zonal_village_array['uuid'] = $r24['uuid'];
                $vill_wise_zonal_village_array['zonal_village'] = $count29;
                $vill_wise_zonal_village_array['zonal_village_flag'] = $flag34;

                $zonal_vill_count['zonal_vill_count'][$d . '-' . $r24['subdiv_code'] . '-' . $r24['cir_code']][] = $vill_wise_zonal_village_array;
            }

            //total village
            $total_state_village = $total_state_village + sizeof($res24);

            //merge village data
            $village_wise_array_merge[$application_id . $d] = array_merge($zonal_vill_count, $village_wise_dag, $vlb_vill_wise_count, $khatian_vill_wise_count);

            //district wise
            $sql27 = "Select count(*) as c from dagwise_zone_info";
            $count27 = $this->db->query($sql27)->row()->c;

            $sql28 = "Select count(DISTINCT unique_village_code) as c from villagewise_zone_info";
            $count28 = $this->db->query($sql28)->row()->c;

            $district_wise_zonal_dag_array = array();
            $district_wise_zonal_dag_array['district_code'] = $d;
            $district_wise_zonal_dag_array['zonal_dags'] = $count27;
            $district_wise_zonal_dag_array['chitha_dags'] = $res['dag'];
            $district_wise_zonal_dag_array['pending_dags'] = $res['dag'] - $count27;

            $district_wise_zonal_village_array = array();
            $district_wise_zonal_village_array['district_code'] = $d;
            $district_wise_zonal_village_array['zonal_village'] = $count28;
            $district_wise_zonal_village_array['total_village'] = sizeof($res24);
            $district_wise_zonal_village_array['pending_village'] = sizeof($res24) - $count28;

            $district_wise_array_merge['zonal-dag'][$application_id . $d] = $district_wise_zonal_dag_array;

            $district_wise_array_merge['zonal-village'][$application_id . $d] = $district_wise_zonal_village_array;

            $total_state_zonal_village = $total_state_zonal_village + $count28;
            $total_state_zonal_dags = $total_state_zonal_dags + $count27;

            //*************************************/
            //chitha dag
            $sqlVlb3 = "select count(*) as c from chitha_basic where patta_type_code in (select type_code from patta_code where jamabandi='n') 
                and (dag_area_b*100+dag_area_k*20+dag_area_lc::int) > 0 and 
                (subdiv_code,cir_code,mouza_pargona_code, lot_no,vill_townprt_code) 
                in (select subdiv_code,cir_code,mouza_pargona_code, lot_no,vill_townprt_code from 
                location where nc_btad is null or TRIM(nc_btad) = '')";
            $countVlb3 = $this->db->query($sqlVlb3)->row()->c;

            //village land bank district wise counts
            $sqlVlb1 = "Select count(*) as c from c_land_bank_details";
            $countVlb1 = $this->db->query($sqlVlb1)->row()->c;

            $sqlVlbLm1 = "Select count(*) as c from land_bank_details where status='P'";
            $countVlbLm1 = $this->db->query($sqlVlbLm1)->row()->c;

            $sqlVlb2 = "Select count(DISTINCT village_uuid) as c from c_land_bank_details";
            $countVlb2 = $this->db->query($sqlVlb2)->row()->c;

            /*$sql2 = "select count(*) as c from chitha_basic where patta_type_code in (select type_code from patta_code 
                    where jamabandi='n') and (dag_area_b*100+dag_area_k*20+dag_area_lc::int) > 0
                    and (dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,trim(dag_no)) 
                    not in (select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,vill_townprt_code,
                    trim(dag_no) from c_land_bank_details) and (dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
                    vill_townprt_code) in (select dist_code,subdiv_code,cir_code,mouza_pargona_code,lot_no,
                    vill_townprt_code from location where nc_btad is null)";*/
            $sql2 = "select count(*) as c  from chitha_basic cb 
                        join patta_code pc on cb.patta_type_code=pc.type_code 
	                join location l on l.subdiv_code=cb.subdiv_code and l.cir_code=cb.cir_code
	                    and l.mouza_pargona_code=cb.mouza_pargona_code and l.lot_no=cb.lot_no
	                    and l.vill_townprt_code=cb.vill_townprt_code	  
                      where pc.jamabandi='n' and (dag_area_b*100+dag_area_k*20+dag_area_lc::int) > 0
                            and l.nc_btad is null and not exists 
	                     (
		               select  from c_land_bank_details clb where 
		                clb.subdiv_code=cb.subdiv_code and clb.cir_code=cb.cir_code
	                        and clb.mouza_pargona_code=cb.mouza_pargona_code and clb.lot_no=cb.lot_no
	                        and clb.vill_townprt_code=cb.vill_townprt_code and trim(clb.dag_no)=trim(cb.dag_no)
	                     )";
            $overallpending = $this->db->query($sql2);
            if ($overallpending->num_rows() > 0) {
                $vlb_pending_daag_dist_wise = $overallpending->row()->c;
            } else {
                $vlb_pending_daag_dist_wise = 0;
            }
            //*************************************/
            // $vlb_pending_daag_dist_wise = $countVlb3-$countVlb1;
            // if($vlb_pending_daag_dist_wise < 0){
            //     $vlb_pending_daag_dist_wise = 0;
            // }else{
            //     $vlb_pending_daag_dist_wise = $vlb_pending_daag_dist_wise;
            // }
            //*************************************/
            $district_wise_vlb_array = array();
            $district_wise_vlb_array['district_code'] = $d;
            $district_wise_vlb_array['vlb_dags'] = $countVlb1;
            $district_wise_vlb_array['pending_with_co'] = $countVlbLm1;
            $district_wise_vlb_array['chitha_govt_dags'] = $countVlb3;
            $district_wise_vlb_array['pending_vlb_dags'] = $vlb_pending_daag_dist_wise;
            $district_wise_array_merge['vlb-dag'][$application_id . $d] = $district_wise_vlb_array;
            log_message('error','overallpending: '.json_encode($district_wise_vlb_array));
            //village land bank state wise counts
            $total_state_vlb_dags = $total_state_vlb_dags + $countVlb1;
            $total_state_vlb_village = $total_state_vlb_village + $countVlb2;
            $total_state_vlb_lm_entry_dags = $total_state_vlb_lm_entry_dags + $countVlbLm1;
            /*************************************/
            //khatian district wise 
            $sqlKhatian1 = "select count(*) as c from (select distinct on (uuid, khatian_no) uuid, khatian_no, count(*) from temp_khatian where status='P' group by uuid, khatian_no ) as c";
            $countKhatian1 = $this->db->query($sqlKhatian1)->row()->c;

            $sqlKhatian2 = "select count(*) as c from (select distinct on (uuid,id) uuid,id from khatian  group by uuid,id) as c";
            $countKhatian2 = $this->db->query($sqlKhatian2)->row()->c;

            $sqlKhatian10 = "select count(*) as c from chitha_tenant";
            $countKhatian10 = $this->db->query($sqlKhatian10)->row()->c;

            $district_wise_khatian_array = array();
            $district_wise_khatian_array['district_code'] = $d;
            $district_wise_khatian_array['pending_with_co'] = $countKhatian1;
            $district_wise_khatian_array['approved_by_co'] = $countKhatian2;
            $district_wise_khatian_array['no_of_rayati'] = $countKhatian10;

            $district_wise_array_merge['khatian_entry'][$application_id . $d] = $district_wise_khatian_array;

            $total_state_khatian_pending_with_co = $total_state_khatian_pending_with_co +
                $countKhatian1;
            $total_state_khatian_approved_by_co = $total_state_khatian_approved_by_co +
                $countKhatian2;
            $total_state_khatian_rayati = $total_state_khatian_rayati + $countKhatian10;
            log_message('error', 'END Database: ' . $d);
        }
        $total_state_area_brahmaputra_conver = $this->utilityclass->brahmaputra_valley_total_bigha_katha_lessa($total_state_dag_lessa);
        $total_state_area_barak_valley_conver = $this->utilityclass->barak_valley_total_bigha_katha_lessa_ganda($total_state_dag_ganda);

        //**** State Wise Dag *****//
        $total_state_array = array();
        $total_state_array['total_state_dag'] = $total_state_dag;
        $total_state_array['brahmaputra_valley']['total_state_area_bigha'] = $total_state_area_brahmaputra_conver[0];
        $total_state_array['brahmaputra_valley']['total_state_area_katha'] = $total_state_area_brahmaputra_conver[1];
        $total_state_array['brahmaputra_valley']['total_state_area_lessa'] = $total_state_area_brahmaputra_conver[2];

        $total_state_array['barak_valley']['total_state_area_bigha'] = $total_state_area_barak_valley_conver[0];
        $total_state_array['barak_valley']['total_state_area_katha'] = $total_state_area_barak_valley_conver[1];
        $total_state_array['barak_valley']['total_state_area_lessa'] = $total_state_area_barak_valley_conver[2];
        $total_state_array['barak_valley']['total_state_area_ganda'] = $total_state_area_barak_valley_conver[3];

        $total_state_array['total_state_pattadar'] = $total_state_pattadar;
        $total_state_array['total_state_annual_patta'] = $total_state_annual_patta;
        $total_state_array['total_state_periodic_patta'] = $total_state_periodic_patta;
        $total_state_array['total_state_patta'] = $total_state_patta;
        $total_state_array['total_zonal_dags'] = $total_state_zonal_dags;
        $total_state_array['total_zonal_village'] = $total_state_zonal_village;

        $total_state_array['total_vlb_dags'] = $total_state_vlb_dags;
        $total_state_array['total_vlb_dags_pending_with_co'] = $total_state_vlb_lm_entry_dags;
        $total_state_array['total_vlb_village'] = $total_state_vlb_village;

        $total_state_array['total_khatian_pending_with_co'] =
            $total_state_khatian_pending_with_co;
        $total_state_array['total_khatian_approved_by_co'] =
            $total_state_khatian_approved_by_co;
        $total_state_array['total_khatian_rayati'] = $total_state_khatian_rayati;

        //**** State Wise Patta *****//
        //        $total_state_patta_array = array();
        //        $total_state_patta_array['total_state_patta'] = $total_state_patta;

        $json = array();
        //***** DAG & PATTA *****//
        //        $json['total_state'] = array_merge($total_state_array,$total_state_patta_array);
        $json['total_state'] = $total_state_array;
        $json['district_wise'] = $district_wise_array_merge;
        $json['circle_wise'] = $circle_wise_array_merge;
        $json['lot_wise'] = $lot_wise_array_merge;
        $json['village_wise'] = $village_wise_array_merge;

        $state_wise = json_encode($json['total_state']);
        $district_wise = json_encode($json['district_wise']);
        $cirlce_wise = json_encode($json['circle_wise']);
        $lot_wise = json_encode($json['lot_wise']);
        $village_wise = json_encode($json['village_wise']);


        //insert into table ilrms_dashboard_records
        $insertIntoMisDagCount = [
            'application_id' => DHARITREE,
            'statewise_json' => $state_wise,
            'districtwise_json' => $district_wise,
            'circlewise_json' => $cirlce_wise,
            'lotwise_json' => $lot_wise,
            'villagewise_json' => $village_wise,
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

        //COMMENT THE FOLLOWING 3 LINES AFTER TESTING 
        /*file_put_contents(BACKUP_JSON_DIR.'ilrms_dashboard_test_'.date("Y-m-d-H-i-s").'.json', json_encode($insertIntoMisDagCount));
        var_dump($insertIntoMisDagCount);return;

        die();*/
        //COMMENT THE ABOVE 3 LINES AFTER TESTING 

        $this->db = $this->load->database('db2', TRUE);
        $this->db->trans_begin();

        // if($this->db->affected_rows() != 1)
        // {
        //    $this->db->trans_rollback();
        //    echo 'Unable to delete data.';
        //    return;
        // }
        //*****************************************************************/
        //json_backup
        $sqlBak = "Select * from ilrms_dashboard_records order by id DESC";
        $result = $this->db->query($sqlBak)->row();

        $json = json_encode([
            "id" => $result->id,
            "statewise_json" => json_decode($result->statewise_json),
            "districtwise_json" => json_decode($result->districtwise_json),
            "circlewise_json" => json_decode($result->circlewise_json),
            "lotwise_json" => json_decode($result->lotwise_json),
            "villagewise_json" => json_decode($result->villagewise_json),
            "pending_with_dc_json" => json_decode($result->pending_with_dc_json),
            "pending_with_adc_json" => json_decode($result->pending_with_adc_json),
            "pending_with_co_json" => json_decode($result->pending_with_co_json),
            "pending_with_lm_json" => json_decode($result->pending_with_lm_json),
            "pending_with_sk_json" => json_decode($result->pending_with_sk_json),
            "pending_with_ast_json" => json_decode($result->pending_with_ast_json),
            "created_at" => json_decode($result->created_at),
        ]);
        file_put_contents(BACKUP_JSON_DIR . 'ilrms_dashboard_data_' . date("Y-m-d-H-i-s") . '.json', $json);

        $ins1 = $this->db->query('delete from ilrms_dashboard_records');
        //*****************************************************************/
        $ins = $this->db->insert('ilrms_dashboard_records', $insertIntoMisDagCount);

        //$this->db->trans_rollback();
        //echo "MRIDU";exit();  
        if ($ins > 0) {
            $this->db->trans_commit();
            log_message('error', 'COMPLETE END: PASS: ins: ' . $ins);
            echo 'gg: ' . $ins;
        } else {
            log_message('error', 'COMPLETE END: FAILED');
            $this->db->trans_rollback();
            echo 'Failed Druna';
        }
    }


////Generate OTP

    public function generateOtp() 
    {
        $validation = array(
            array(
                'field' => 'uname',
                'label' => 'Username',
                'rules' => 'trim|required|xss_clean',
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|xss_clean',
            ),
            // array(
            //     'field' => 'captcha',
            //     'label' => 'Captcha',
            //     'rules' => 'trim|required|xss_clean|callback_checkCaptcha',
            // ),
        );
        $data = array();
        $data['error'] = '';
        $this->form_validation->set_rules($validation);
        if ($this->form_validation->run() == false) {
            $this->form_validation->set_error_delimiters('', '');
            foreach ($validation as $rule) {
                if (form_error($rule['field'])) {
                    $data['error'] .= form_error($rule['field']) . '<br>';
                }
            }
            $data['validation'] = false;
            echo json_encode($data);
            return;
        } else {
            $captchakey = $this->session->userdata('captcha_key');
            $username = $this->input->post('uname');
            $password = $this->input->post('hashedpwd');
            $captcha = $this->input->post('captcha');
            unlink('./captcha/' . $this->session->userdata('filename'));
            if ($captchakey == $captcha) {
                $logindetails = false;
                $validateuserdetails = $this->LoginModel->ValidateUser($username, $password);
                if (isset($validateuserdetails) && !empty($validateuserdetails)) {
                    $logindetails = true;
                    $usertype = $validateuserdetails['user_role'];
                    $usercode = $validateuserdetails['uname'];
                    $distcode = $validateuserdetails['dist_code'];

                    $subdiv_code = $validateuserdetails['subdiv_code'];
                    $cir_code = $validateuserdetails['cir_code'];

                    // $this->session->set_userdata('loggedin', true);
                    $this->session->set_userdata('user_type', $usertype);
                    $this->session->set_userdata('user_code', $usercode);
                    $this->session->set_userdata('d_code', $distcode);
                    $this->session->set_userdata('s_code', $subdiv_code);
                    $this->session->set_userdata('c_code', $cir_code);
                }

                if ($logindetails) {
                    $otp_generated = mt_rand(100000, 999999);
                    $this->session->set_userdata('generated_otp', $otp_generated);
                    $this->sendToPhone($validateuserdetails['phone_no']);
                    // $otp_generated = 123456;
                    // $this->session->set_userdata('generated_otp', $otp_generated);

                    echo json_encode(['msg' => 'OTP Generated', 'st'=> 1, 'usertype'=>$usertype]);
                }
                else{
                    echo json_encode(array('msg' => 'Login Failed Wrong Username or Password', 'st' => 0));
                }

            } else {
                echo json_encode(array('msg' => 'Wrong Captcha', 'st' => 0));
            }

        }
    }


    private function sendToPhone($mobile_no) {
        $curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => GET_OTP_ON_LOGIN,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
				"key"       : "login_otp",
				"variables" : "'. $this->session->userdata('generated_otp') .'",
				"mobilenos" : "'.$mobile_no.'" 
			}',
		));
		$response = curl_exec($curl);
		curl_close($curl);


    }



    public function getOtpOnMobileNo()
    {

        $_POST = json_decode(file_get_contents("php://input"), true);
        $mobile_no = $this->input->post('mobile_no');

        $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'responseType' => 1,
            ));
            return;
        }
        $otp_generated = mt_rand(100000, 999999);
        $this->session->set_userdata('generated_otp', $otp_generated);
        $this->session->set_userdata('mobile_no_new', $mobile_no);
        $this->sendToPhone($mobile_no);
        echo json_encode(array(
            'responseType' => 2,
            'msg' => 'OTP Generated'
        ));

    }

    public function submitOtp()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $unique_user_id = $this->session->userdata('unique_user_id');
        $mobile_no_new = $this->session->userdata('mobile_no_new');
        $session_otp = $this->session->userdata('generated_otp');
        $posted_otp = $this->input->post('otp_no');
        $name_user = $this->input->post('name_user');
        $email_id = $this->input->post('email_id');
        $address = $this->input->post('address');

        if($posted_otp == NULL || $name_user == null || $email_id == null || $address == null)
        {
            echo json_encode(array(
                'responseType' => 1,
                'msg' => 'Please check input fields'
            ));
        return;
        }
        if($session_otp == $posted_otp)
        {
            $update=array(
                'mobile_no'=> $mobile_no_new,
                'name' => $name_user,
                'email' => $email_id,
                'address' => $address,
                'mobile_no_update'=> 'Y',

            );
			$this->db->where('unique_user_id', $unique_user_id);

			$depart_users_update = $this->db->update('depart_users', $update);

            if($depart_users_update === TRUE || $this->db->affected_rows() > 0)
            {
                echo json_encode(array(
                    'responseType' => 2,
                    'msg' => 'Details has been Updated Successfuly. Please Login'
                ));
            }
            else
            {
                echo json_encode(array(
                    'responseType' => 1,
                    'msg' => 'Data update failed!!!'
                ));
            }
        }
        else
         {
            echo json_encode(array(
                'responseType' => 1,
                'msg' => 'OTP not Matching'
            ));
        }

    }


    public function verifyOtpAndLogin()
    {
        $_POST = json_decode(file_get_contents("php://input"), true);

        $unique_user_id = $this->session->userdata('unique_user_id');
        $mobile_no_new = $this->session->userdata('mobile_no_new');
        $session_otp = $this->session->userdata('generated_otp');
        $posted_otp = $this->input->post('login_otp');

        if($posted_otp == NULL )
        {
            echo json_encode(array(
                'responseType' => 1,
                'msg' => 'Please Enter OTP'
            ));
        return;
        }
        if($session_otp == $posted_otp)
        {
            $sql = "select du.unique_user_id as unique_uid, * from depart_users du join user_dist_byforcation udb on 
                du.id::int=udb.unique_user_id::int where du.unique_user_id=? and du.active_deactive=? and du.status=?"; 
            $res = $this->db->query($sql, array($unique_user_id, 'E', 'E'));

            if ($res->num_rows() > 0) 
                {
                    $row  = $res->row_array();
                    $sessiondata = array(
                        'name'  => $row['name'],
                        'designation'       => $row['designation'],
                        'date_of_joining'   => $row['date_of_joining'],
                        'unique_user_id'    => $row['unique_uid'],
                        'first_login'       => $row['first_login'],
                        'mobile_no'         => $row['mobile_no'],
                        'email'             => $row['email'],
                        'address'           => $row['address'],
                        'user_code'         => $row['user_code'],
                        'dist_code'         => $row['dist_code'],
                        'subdiv_code'       => $row['subdiv_code'],
                        'cir_code'          => $row['cir_code'],
                        'mouza_pargona_code' => $row['mouza_pargona_code'],
                        'logged_in'         => TRUE
                    );

                    $this->session->set_userdata($sessiondata);
                }

                echo json_encode(array(
                    'responseType' => 2,
                    'msg' => 'Login Success'
                ));
        }
        else
         {
            echo json_encode(array(
                'responseType' => 1,
                'msg' => 'OTP not Matching'
            ));
        }

    }


    function maskPhoneNumber($phoneNumber) {
        $mask = 'XXX-XXX-';

        $displayDigits = substr($phoneNumber, -4);

        $maskedNumber = $mask . $displayDigits;

        return $maskedNumber;
    }

    ///Login With OTP
    public function loginProcessWithOtp()
    {
        $validation = array(
            array(
                'field' => 'uname',
                'label' => 'Username',
                'rules' => 'trim|required|xss_clean',
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|xss_clean',
            ),
            // array(
            //     'field' => 'captcha',
            //     'label' => 'Captcha',
            //     'rules' => 'trim|required|xss_clean|callback_checkCaptcha',
            // ),
        );
        $data = array();
        $data['error'] = '';
        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run() === FALSE) {
            $this->form_validation->set_error_delimiters('', '');
            foreach ($validation as $rule) {
                if (form_error($rule['field'])) {
                    $data['error'] .= form_error($rule['field']) . '<br>';
                }
            }
            $data['validation'] = false;
            echo json_encode($data);
            return;
        } else {

            $data['validation'] = true;

            $randomKey = $this->session->userdata('randomKey');

            $data['success'] = null;
            $user_name = $this->input->post('uname');
            $password = $this->input->post('password');

            // password format : sha512.update(hash + salt);
            $getPass = $this->db->query("SELECT password FROM depart_users WHERE 
                unique_user_id=?", array($user_name));
              
            if ($getPass->num_rows() == 0) {
                log_message('error', 'ilrms_session_data '.json_encode($this->session->userdata));
                log_message('error', 'ilrms_last_query '.json_encode($this->db->last_query()));
                $data['pass_success'] = false;
                echo json_encode($data);
                return;
            }
            $finalPassword = hash('sha512', ($getPass->row()->password . $randomKey));

            // echo json_encode($randomKey);
            // exit;
            if ($password == $finalPassword) {

                $sql = "select du.unique_user_id as unique_uid, * from depart_users du join user_dist_byforcation udb on 
                du.id::int=udb.unique_user_id::int where du.unique_user_id=? and du.active_deactive=? and du.status=?";                 
                $res = $this->db->query($sql, array($user_name, 'E', 'E'));
                if ($res->num_rows() > 0) {

                    $row  = $res->row_array();

                    $update_mobile_yn = $row['mobile_no_update'];
 
                    $sessiondata = array(
                        'unique_user_id'    => $row['unique_uid'],
                        'user_code'         => $row['user_code'],
                    );

                    $this->session->set_userdata($sessiondata);

                    if($update_mobile_yn == null)
                    {
                        $data['mobile_no_update'] = 0;
                        echo json_encode($data);
                        return;
                    }

                    ////Generate OTP
                    $user_mobile_no = $row['mobile_no'];
                    $maskedPhoneNumber = $this->maskPhoneNumber($user_mobile_no);

                    $otp_generated = mt_rand(100000, 999999);

                    $this->session->set_userdata('generated_otp', $otp_generated);
                    $this->sendToPhone($user_mobile_no);
                    // log_message('error', 'ilrms_session_data '.json_encode($this->session->userdata));
                    // $this->get_client_start();
                    $data['success'] = true;
                    $data['user_mobile_no'] = $maskedPhoneNumber;
                    echo json_encode($data);
                    return;
                }
             else {
                    $data['success'] = false;
                    echo json_encode($data);
                    return;
                }
            } else {
                log_message('error', 'password: '.$password.', finalPassword: '. $finalPassword);
                log_message('error', 'ilrms_last_query '.json_encode($this->db->last_query()));
                $data['pass_success'] = false;
                echo json_encode($data);
                return;
            }
        }
    }


    public function addNyksUsers(){

        $CI=&get_instance();
        $this->db=$CI->load->database('db2', TRUE);

        $email=$_POST['email'];
        $expStr = explode("@",$email);
        $user_name = $expStr[0];

        $depart_users_data = [
            "name" => $user_name,
            "designation" => 'NYKS',
            "date_of_joining" => date('Y-m-d h:i:s'),
            "password" => '5f993f9a478b9f5cb006f20d48e2325c84708b0d6b15d8501d44b47cc386e113f3a5d6566b196102052bb68b87f4b2538f233cedb8d13ab38aceae0b726c485f',
            "unique_user_id" => $user_name,
            "active_deactive" => 'E',
            "first_login" => 0,
            "status" => 'E',
            "mobile_no" => $_POST['mobile'],
            "email" => $_POST['email'],
            "address" => $_POST['address'],
            "user_code" => '--',     
            "display_name" => $user_name
        ];
        //echo json_encode($depart_users_data);
	//exit;
	$this->db->trans_begin();
        $tstatus = $this->db->insert('depart_users', $depart_users_data);
        if ($tstatus!= 1)
        {
            $this->db->trans_rollback();
	    echo json_encode("error in insert in depart users table with last query ". $this->db->last_query());
	    exit;
        }

	$unique_user_id = $this->db->insert_id();
        //echo $unique_user_id;exit;
        $update_depart_users = [
            "user_code" => 'NYKS'.$unique_user_id,
        ];
        $this->db->where('id', $unique_user_id);
        $this->db->where('mobile_no', $_POST['mobile']);
        $this->db->update('depart_users', $update_depart_users);
        if($this->db->affected_rows() != 1){ 
            $this->db->trans_rollback();
            echo json_encode("error in update depart users table with last query ". $this->db->last_query());
            exit;
        }

        $user_dist_byfurcation_details = [
            "unique_user_id" => $unique_user_id,
            "user_code" => 'NYKS',
            "dist_code" => $_POST['dist_code'],
            "subdiv_code" => '--',
            "cir_code" => '--',
            "mouza_pargona_code" => '--',
            "lot_no" => '--',
            "active_deactive" => 'E',
            "modified_at" => date('Y-m-d h:i:s')
        ];

        //echo json_encode($user_dist_byfurcation_details);
	//exit;
	$tstatus1 = $this->db->insert('user_dist_byforcation', $user_dist_byfurcation_details); 
        if ($tstatus1!= 1)
        {
            $this->db->trans_rollback();
            echo json_encode("error in insert in user_dist_byforcation users table with last query ". $this->db->last_query());
            exit;
	}
        $this->db->trans_commit();	
        echo json_encode("User Successfully Added In ILRMS-DEMO");
    }


}
