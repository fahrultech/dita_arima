<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JumlahAlatTangkap extends CI_Controller {
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("jumlahalattangkap");
        $this->load->view("footer");
    }
}