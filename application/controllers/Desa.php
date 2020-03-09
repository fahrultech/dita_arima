<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Desa_model');
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("desa");
        $this->load->view("footer");
    }
    function ajax_list(){
        $this->load->model('Desa_model','desa');
        $list = $this->Desa_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach($list as $li){
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $li->NamaDesa;
           $row[] = '<div style="text-align:center">
                      <button onClick="editDesa('."'$li->IDDesa'".')" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-xs btn-danger" onClick="hapusDesa('."'$li->IDDesa'".')"><i class="fa fa-trash"></i></button>
                    </div>';
           $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'],
          //"recordsTotal" => $this->kecamatan->count_all(),
          "recordsFiltered" => $this->desa->count_filtered(),
          "data" => $data
        );
        echo json_encode($output);
    }
    function tambahDesa(){
        $data = array(
            'NamaDesa' => $this->input->post('namadesa')
        );
        $insert = $this->Desa_model->insert($data);
        echo json_encode(array("status" => TRUE));
    }
    function editDesa($id){
        $data = $this->Desa_model->getById($id);
        echo json_encode($data);
    }
    function updateDesa(){
        $data = array(
            'NamaDesa' => $this->input->post('namadesa')
        );
        $this->Desa_model->update(array('IDDesa' => $this->input->post('iddesa')),$data);
        echo json_encode(array("status" => TRUE));
    }
    function hapusDesa($id){
        $this->Desa_model->deleteById($id);
        echo json_encode(array("status" => TRUE));
    }
}