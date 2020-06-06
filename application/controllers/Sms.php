<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sms_model','sms');
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
    }
    function index(){
        $data = array("NoHP" => $this->sms->getNoHP());
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("sms",$data);
        $this->load->view("footer");
    }
    function kirim(){
        $data = array(
            "DestinationNumber" => $this->input->post('nohp'),
            "TextDecoded" => $this->input->post('isisms')
        );
        echo json_encode($data);
        $this->sms->insert($data);
        echo json_encode(array("status" => TRUE));

        redirect('sms','refresh');
    }
    
}