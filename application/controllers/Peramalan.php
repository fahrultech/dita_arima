<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peramalan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('JenisIkan_model','jenisikan');
        $this->load->model('Kecamatan_model','kecamatan');
        $this->load->model('Peramalan_model','peramalan');
        $this->load->library('arima');
    }
    function index(){
        $ji = $this->jenisikan->getIkan();
        $kc = $this->kecamatan->getAll();
        $data = array("jenisikan" => $ji, "kecamatan" => $kc);
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("peramalan",$data);
        $this->load->view("footer");
    }
    function getdata(){
        $bulan = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nop","Des");
        $regression = new Phpml\Regression\LeastSquares();
        $arima = $this->arima;
        $idikan = $this->input->post('jenisikan');
        $idkecamatan = $this->input->post('kecamatan');
        $tahunawal = 2014;
        $tahunakhir = 2017;
        $query = $this->peramalan->getDataByKecamatanAndJenisAndYear($idkecamatan,$idikan,$tahunawal,$tahunakhir);
        $query2 = $this->peramalan->getDataByKecamatanAndJenis($idkecamatan,$idikan);
        $query3 = $this->peramalan->getDataByKecamatanAndJenisRamal($idkecamatan,$idikan,$tahunakhir);
        $arrayData = array();
        $dataLatih = array();
        $dataUji = array();
        foreach($query3 as $q3){
            $dataUji[] = $q3->JumlahTangkapanIkan;
        }
        foreach($query as $q){
           $dataLatih[] = $q->JumlahTangkapanIkan;
        }
        $ramal = array(["Bulan Tahun","Jumlah"]);
        $ramal[1] = array("Jan-2014",(float)$query[0]->JumlahTangkapanIkan);
        $hh = $arima->getSARIMA($dataUji,$dataLatih);
        $maError = array();
        for($i=13;$i<(count($query3));$i++){
           $row = array();
           $row[] = $bulan[($query3[$i]->Bulan)-1]."-".$query3[$i]->Tahun;
           $row[] = $hh[$i];
           $ramal[] = $row; 
        }
        $lag = count($query) > 36 ? 20 : count($query) * 0.5;
        $acf = $arima->getACF($dataLatih,$lag);
        $pacf = $arima->getPACF($dataLatih,$lag,$idikan);
        
        //$hasil = $arima->getMACoefficients($arrayData,$maError);
        echo json_encode(array($query2,$acf,$ramal,$pacf,$hh,$query3,$dataUji,$dataLatih));
    }
}