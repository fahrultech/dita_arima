<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peramalan extends CI_Controller {
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("peramalan");
        $this->load->view("footer");
    }
}