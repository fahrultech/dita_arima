<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataKelompok extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Kecamatan_model');
        $this->load->model('Desa_model');
        $this->load->model('NelayanKelompok_model');
        if (!isset($this->session->userdata['usernelayan'])) {
			redirect(base_url("nelayanlogin"));
		}
    }
    function index(){
        $username = $this->session->get_userdata()["usernelayan"];
        $query = $this->NelayanKelompok_model->getByUsername($username);
        $kecamatan = $this->Kecamatan_model->getAll();
        $desa = $this->Desa_model->getAll();
        $data = array("nelayan" => $query,"kecamatan" => $kecamatan,"desa" => $desa);
        $this->load->view("header");
        $this->load->view("nelayansidebar");
        $this->load->view("datakelompok",$data);
        $this->load->view("footer");
    }
    function getAll(){
        
    }
    function tambahKelompok(){
        $data = array(
            'NamaKelompok' => $this->input->post('namakelompok'),
            'NamaKetua' => $this->input->post('namaketua'),
            'NoHP' => $this->formatPhoneNumber($this->input->post('nohp')),
            'IDDesa' => $this->input->post('namadesa'),
            'IDKecamatan' => $this->input->post('namakecamatan'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))
        );
        $insert = $this->NelayanKelompok_model->insert($data);
        echo json_encode(array("status" => TRUE));
    }
    function editKelompok($id){
        $data = $this->NelayanKelompok_model->getById($id);
        echo json_encode($data);
    }
    function updateKelompok(){
        if($this->input->post('password')  == ""){
            $data = array(
                'NamaKelompok' => $this->input->post('namakelompok'),
                'NamaKetua' => $this->input->post('namaketua'),
                'NoHP' => $this->formatPhoneNumber($this->input->post('nohp')),
                'IDDesa' => $this->input->post('namadesa'),
                'IDKecamatan' => $this->input->post('namakecamatan'),
                'username' => $this->input->post('username')
            );
        }else{
            $data = array(
                'NamaKelompok' => $this->input->post('namakelompok'),
                'NamaKetua' => $this->input->post('namaketua'),
                'NoHP' => $this->formatPhoneNumber($this->input->post('nohp')),
                'IDDesa' => $this->input->post('namadesa'),
                'IDKecamatan' => $this->input->post('namakecamatan'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password'))
            );
        }
       
        $this->NelayanKelompok_model->update(array('IDKelompok' => $this->input->post('idkelompok')),$data);
        echo json_encode(array("status" => TRUE));
    }
    function hapusKelompok($id){
        $this->NelayanKelompok_model->deleteById($id);
        echo json_encode(array("status" => TRUE));
    }
    public function formatPhoneNumber($num)
    {
        $noHP = $num;
        $pos  = strpos($noHP, '0', 0);

        if ($pos === 0) {
            $noHP = substr_replace($noHP, '+62', 0, 1);
        }

        return $noHP;
    }
}