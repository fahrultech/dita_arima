<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelompokNelayan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Kecamatan_model');
        $this->load->model('Desa_model');
        $this->load->model('NelayanKelompok_model');
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
    }
    function index(){
        $data['kecamatan'] = $this->Kecamatan_model->getAll();
        $data['desa'] = $this->Desa_model->getAll();
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("kelompoknelayan",$data);
        $this->load->view("footer");
    }
    function ajax_list(){
        $this->load->model('NelayanKelompok_model','kelompoknelayan');
        $list = $this->NelayanKelompok_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach($list as $li){
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $li->NamaKelompok;
           $row[] = $li->NamaKetua;
           $row[] = $li->NamaDesa;
           $row[] = $li->NamaKecamatan;
           $row[] = "Malang";         
           $row[] = $li->NoHP;         
           $row[] = '<div style="text-align:center">
                      <button onClick="editKelompok('."'$li->IDKelompok'".')" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-xs btn-danger" onClick="hapusKelompok('."'$li->IDKelompok'".')"><i class="fa fa-trash"></i></button>
                    </div>';
           $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'],
          //"recordsTotal" => $this->kecamatan->count_all(),
          "recordsFiltered" => $this->kelompoknelayan->count_filtered(),
          "data" => $data
        );
        echo json_encode($output);
    }
    function getAll(){
        
    }
    function tambahKelompok(){
        $data = array(
            'NamaKelompok' => $this->input->post('namakelompok'),
            'NamaKetua' => $this->input->post('namaketua'),
            'NoHP' => $this->formatPhoneNumber($this->input->post('nohp')),
            'IDDesa' => $this->input->post('namadesa'),
            'IDKecamatan' => $this->input->post('namakecamatan')
        );
        $insert = $this->NelayanKelompok_model->insert($data);
        echo json_encode(array("status" => TRUE));
    }
    function editKelompok($id){
        $data = $this->NelayanKelompok_model->getById($id);
        echo json_encode($data);
    }
    function updateKelompok(){
        $data = array(
            'NamaKelompok' => $this->input->post('namakelompok'),
            'NamaKetua' => $this->input->post('namaketua'),
            'NoHP' => $this->formatPhoneNumber($this->input->post('nohp')),
            'IDDesa' => $this->input->post('namadesa'),
            'IDKecamatan' => $this->input->post('namakecamatan')
        );
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