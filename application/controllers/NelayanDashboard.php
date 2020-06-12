<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NelayanDashboard extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('NelayanLogin_model');
        if (!isset($this->session->userdata['usernelayan'])) {
			redirect(base_url("nelayanlogin"));
		}
    }
    function index(){
        $data = array("userdata" => $this->session->get_userdata());
        $this->load->view("header");
        $this->load->view("nelayansidebar");
        $this->load->view("starter",$data);
        $this->load->view("footer");
    }

    function logout(){
        $this->session->unset_userdata('usernelayan');
        redirect(base_url('nelayanlogin'));
    }
}