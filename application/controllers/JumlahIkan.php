<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JumlahIkan extends CI_Controller {
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("jumlahikan");
        $this->load->view("footer");
    }
}