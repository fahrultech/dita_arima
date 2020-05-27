<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sms_model');
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("sms");
        $this->load->view("footer");
    }
    function kirim(){
        $data = array(
            "DestinationNumber" => $this->input->post('noHP'),
            "TextDecoded" => $this->input->post('isisms')
        );
        $this->Sms_model->insert($data);
        echo json_encode(array("status" => TRUE));

        redirect('sms','refresh');
    }
    
}