<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$url = basename($_SERVER['REQUEST_URI']);

		if(!in_array($url, ARRAY_API)){
			$this->load->library('session');
			if($_SESSION['logged_in'] == false || $this->session->has_userdata('logged_in') == false)
			{
				session_destroy();
				$_SESSION['logged_in'] = false;
				redirect('/');
			}
		}
		
	}
}
