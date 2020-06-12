<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NelayanLogin extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('usernelayan')){
            redirect(base_url('nelayandashboard'));
        }
        $this->load->model(array('NelayanLogin_model'));
    }
    function index(){
        $this->load->view('nelayanlogin');
    }

    function proses(){
        $this->form_validation->set_rules('username','username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password','password', 'required|trim|xss_clean');

        if($this->form_validation->run() == FALSE){
            $this->load->view('nelayanlogin');
        }else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $username;
            $pass = md5($password);

            $cek = $this->NelayanLogin_model->cek($user, $pass);

            if($cek->num_rows() > 0){
                foreach($cek->result() as $qad){
                    $sess_data['usernelayan'] = $qad->username;
                    $this->session->set_userdata($sess_data);
                }
                redirect(base_url('nelayandashboard'));
            }else{
                $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukka salah</br>');
                redirect(base_url('nelayanlogin'));
            }
        }
    }
}