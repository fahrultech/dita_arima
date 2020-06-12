<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("admin"));
		}
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("starter");
        $this->load->view("footer");
    }

    function logout(){
        $this->session->unset_userdata('username');
        redirect(base_url('admin'));
    }
}