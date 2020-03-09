<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kecamatan_model');
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("kecamatan");
        $this->load->view("footer");
    }
    function ajax_list(){
        $this->load->model('Kecamatan_model','kecamatan');
        $list = $this->Kecamatan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach($list as $li){
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $li->NamaKecamatan;
           $row[] = '<div style="text-align:center">
                      <button onClick="editKecamatan('."'$li->IDKecamatan'".')" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-xs btn-danger" onClick="hapusKecamatan('."'$li->IDKecamatan'".')"><i class="fa fa-trash"></i></button>
                    </div>';
           $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'],
          //"recordsTotal" => $this->kecamatan->count_all(),
          "recordsFiltered" => $this->kecamatan->count_filtered(),
          "data" => $data
        );
        echo json_encode($output);
    }
    function getAll(){
        
    }
    function tambahKecamatan(){
        $data = array(
            'NamaKecamatan' => $this->input->post('namakecamatan')
        );
        $insert = $this->Kecamatan_model->insert($data);
        echo json_encode(array("status" => TRUE));
    }
    function editKecamatan($id){
        $data = $this->Kecamatan_model->getById($id);
        echo json_encode($data);
    }
    function updateKecamatan(){
        $data = array(
            'NamaKecamatan' => $this->input->post('namakecamatan')
        );
        $this->Kecamatan_model->update(array('IDKecamatan' => $this->input->post('idkecamatan')),$data);
        echo json_encode(array("status" => TRUE));
    }
    function hapusKecamatan($id){
        $this->Kecamatan_model->deleteById($id);
        echo json_encode(array("status" => TRUE));
    }
}