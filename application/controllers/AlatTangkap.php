<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AlatTangkap extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('AlatTangkap_model');
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("alattangkap");
        $this->load->view("footer");
    }
    function ajax_list(){
        $this->load->model('AlatTangkap_model','alattangkap');
        $list = $this->AlatTangkap_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach($list as $li){
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $li->NamaAlatTangkap;
           $row[] = '<div style="text-align:center">
                      <button onClick="editAlatTangkap('."'$li->IDAlatTangkap'".')" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-xs btn-danger" onClick="hapusAlatTangkap('."'$li->IDAlatTangkap'".')"><i class="fa fa-trash"></i></button>
                    </div>';
           $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'],
          //"recordsTotal" => $this->kecamatan->count_all(),
          "recordsFiltered" => $this->alattangkap->count_filtered(),
          "data" => $data
        );
        echo json_encode($output);
    }
    function getAll(){
        
    }
    function tambahAlatTangkap(){
        $data = array(
            'NamaAlatTangkap' => $this->input->post('namaalattangkap')
        );
        $insert = $this->AlatTangkap_model->insert($data);
        echo json_encode(array("status" => TRUE));
    }
    function editAlatTangkap($id){
        $data = $this->AlatTangkap_model->getById($id);
        echo json_encode($data);
    }
    function updateAlatTangkap(){
        $data = array(
            'NamaAlatTangkap' => $this->input->post('namaalattangkap')
        );
        $this->AlatTangkap_model->update(array('IDAlatTangkap' => $this->input->post('idalattangkap')),$data);
        echo json_encode(array("status" => TRUE));
    }
    function hapusAlatTangkap($id){
        $this->AlatTangkap_model->deleteById($id);
        echo json_encode(array("status" => TRUE));
    }
}