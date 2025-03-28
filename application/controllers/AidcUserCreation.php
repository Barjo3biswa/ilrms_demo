<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AidcUserCreation extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security'));

        //checkLogin();
    }


    //Create DC User
    public function createMDUser()
    {

        $data['_view'] = 'user/create_aidc_md_user_profile';
        $this->load->view('layouts/main', $data);
    }


    public function createMDUserProfileSave()
    {

        $name = $this->input->post('name');

        $email = $this->input->post('email');

        $mobile = $this->input->post('mobile');

        $org = $this->input->post('org');

        $new_pass = $this->input->post('new_password');

        $date = date('Y-m-d H:i:s');


        if ($this->form_validation->run('aidc_md_profile_creation_validation') === true) {

            $this->dbbb = $this->load->database('industrial', TRUE);


            $s = "Select count(*) as c from admin_users where email = '$email'";
            $e = $this->dbbb->query($s)->row()->c;


            if ($e > 0) {
                $this->session->set_flashdata('alert_msg', '<div class="alert alert-danger">****************User Already Exist. Please enter other Email ************</div>');
                return redirect('aidc_md_profile_creation');
            } else {

                $users = array(
                    'name' => $name,
                    'email' => $email,
                    'created_at' => $date,
                    'updated_at' => $date,
                    'role' => 'MD',
                    'verified' => 'Y',
                    'mobile' => $mobile,
                    'password' => password_hash($new_pass, PASSWORD_BCRYPT),
                    'organisation' => $org
                );

                $this->dbbb->trans_begin();

                $insertUsers = $this->dbbb->insert('admin_users', $users);

                if ($insertUsers != TRUE) {

                    $this->dbbb->trans_rollback();
                    log_message('error', '#ERRINSERTUSERS: Insertion failed in users table');

                    $this->session->set_flashdata('alert_msg', '<div class="alert alert-danger">ERRINSERTUSERS: User Creation Failed</div>');
                    return redirect('aidc_md_profile_creation');
                } else {
                    $this->dbbb->trans_commit();
                    $this->session->set_flashdata('alert_msg', '<div class="alert alert-success">New AIDC MD User Successfully Created</div>');
                    return redirect('aidc_md_profile_creation');
                }
            }
        } else {
            $this->createMDUser();
        }
    }
}
