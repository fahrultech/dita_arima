<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SentFailed extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('SentFailed_model');
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("admin"));
		}
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("sentfailed");
        $this->load->view("footer");
    }
    function ajax_list(){
        $this->load->model('SentFailed_model','sentfailed');
        $list = $this->SentFailed_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach($list as $li){
           $no++;
           $row = array();
           $row[] = $li->ID;
           $row[] = $li->DestinationNumber;
           $row[] = $li->SendingDateTime;
           $row[] = $li->Status;
           $row[] = $li->TextDecoded;
           $row[] = '<div style="text-align:center">
                      <button class="btn btn-xs btn-danger" onClick="hapusIkan('."'$li->ID'".')"><i class="fa fa-trash"></i></button>
                    </div>';
           $data[] = $row;
        }
        //$data = $this->prepDestinationName($data);
        $data = $this->prepStatus($data);
        $output = array("draw" => $_POST['draw'],
          "recordsFiltered" => $this->sentfailed->count_filtered(),
          "data" => $data
        );
        echo json_encode($output);
    }
    function hapusSentItem($id){
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

    private function prepStatus($sent)
    {
        $statusType = [
            'SendingOK'         => 'Pending',
            'SendingOKNoReport' => 'OK',
            'SendingError'      => 'Failed',
            'DeliveryOK'        => 'Delivered',
            'DeliveryFailed'    => 'Failed',
            'DeliveryPending'   => 'Pending',
            'DeliveryUnknown'   => 'Pending',
            'Error'             => 'Failed'
        ];
        for($i=0;$i<count($sent);$i++){
            $sent[$i][3] = $statusType[$sent[$i][3]];
        }
        return $sent;
    }
}