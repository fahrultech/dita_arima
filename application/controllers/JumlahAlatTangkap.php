<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JumlahAlatTangkap extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('JumlahAlatTangkap_model');
        $this->load->model('Kecamatan_model');
    }
    function index(){
        $data["kecamatan"] = $this->Kecamatan_model->getAll();
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("jumlahalattangkap",$data);
        $this->load->view("footer");
    }
    function getData(){
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data = array(
            "bulan" => $bulan, "tahun" =>$tahun
        );

        echo json_encode($this->JumlahAlatTangkap_model->getDataByMonthAndYear($data));
    }
}