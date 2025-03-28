<?php
class Dsc extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('dsc_registration_model', 'dsc_registration');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function dSignDetails(){
        $data['_view'] = 'dsc_information';
        $this->load->view('layouts/main',$data);
    }


}