<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisIkan extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('JenisIkan_model');
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("admin"));
		}
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("jenisikan");
        $this->load->view("footer");
    }
    function ajax_list(){
        $this->load->model('JenisIkan_model','jenisikan');
        $list = $this->JenisIkan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach($list as $li){
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $li->NamaIkan;
           $row[] = '<div style="text-align:center">
                      <button onClick="editIkan('."'$li->IDIkan'".')" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-xs btn-danger" onClick="hapusIkan('."'$li->IDIkan'".')"><i class="fa fa-trash"></i></button>
                    </div>';
           $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'],
          //"recordsTotal" => $this->kecamatan->count_all(),
          "recordsFiltered" => $this->jenisikan->count_filtered(),
          "data" => $data
        );
        echo json_encode($output);
    }
    function getAll(){
        
    }
    function tambahIkan(){
        $data = array(
            'NamaIkan' => $this->input->post('namaikan')
        );
        $insert = $this->JenisIkan_model->insert($data);
        echo json_encode(array("status" => TRUE));
    }
    function editIkan($id){
        $data = $this->JenisIkan_model->getById($id);
        echo json_encode($data);
    }
    function updateIkan(){
        $data = array(
            'NamaIkan' => $this->input->post('namaikan')
        );
        $this->JenisIkan_model->update(array('IDIkan' => $this->input->post('idikan')),$data);
        echo json_encode(array("status" => TRUE));
    }
    function hapusIkan($id){
        $this->JenisIkan_model->deleteById($id);
        echo json_encode(array("status" => TRUE));
    }
}