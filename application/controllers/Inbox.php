<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Inbox_model');
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("inbox");
        $this->load->view("footer");
    }
    function ajax_list(){
        $this->load->model('Inbox_model','inbox');
        $list = $this->Inbox_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach($list as $li){
           $no++;
           $row = array();
           $row[] = $li->ID;
           $row[] = $li->SenderNumber;
           $row[] = $li->ReceivingDateTime;
           $row[] = $li->TextDecoded;
           $row[] = '<div style="text-align:center">
                      <button class="btn btn-xs btn-danger" onClick="hapusInbox('."'$li->ID'".')"><i class="fa fa-trash"></i></button>
                    </div>';
           $data[] = $row;
        }
        //$data = $this->prepDestinationName($data);
        $output = array("draw" => $_POST['draw'],
          "recordsFiltered" => $this->inbox->count_filtered(),
          "data" => $data
        );
        echo json_encode($output);
    }
    function hapusIkan($id){
        $this->JenisIkan_model->deleteById($id);
        echo json_encode(array("status" => TRUE));
    }
    private function prepDestinationName($sent)
    {
        foreach($sent as $row) {
            //$noHP = $row->DestinationNumber;
            $noHP = $row[1];
            $found = $this->getContactName($noHP);
            if ($found) {
                $nama = $found->Name;
                //$row->DestinationNumber = "<span>$nama</span>$noHP";
                $row[1] = "<span>$nama</span>$noHP";
            } else {
                //$row->DestinationNumber = $noHP;
                $row[1] = $noHP;
            }
        }
        return $sent;
    }
}