<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peramalan extends CI_Controller {
    private $bulan = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nop","Des");
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
        $regression = new Phpml\Regression\LeastSquares();
        $idikan = $this->input->post('jenisikan');
        $idkecamatan = $this->input->post('kecamatan');
        $periode = $this->input->post('periode');
        $trainAndTest = $this->trainAndTest($idikan,$idkecamatan,$periode);
        echo json_encode($trainAndTest);
    }
    function trainAndTest($idikan,$idkecamatan,$periode){
        $arima = $this->arima;
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
        $hh = $arima->getSARIMA($dataUji,$dataLatih,24);
        for($i=12;$i<(count($query3));$i++){
           $row = array();
           $row[] = $this->bulan[($query3[$i]->Bulan)-1]."-".$query3[$i]->Tahun;
           $row[] = $hh[$i-12];
           $ramal[] = $row; 
        }
        $lag = count($query) > 36 ? 20 : count($query) * 0.5;
        $acf = $arima->getACF($dataLatih,$lag);
        $pacf = $arima->getPACF($dataLatih,$lag,$idikan);
        $predict = $this->predict($idikan,$idkecamatan,$periode);
        return(array($query2,$acf,$ramal,$pacf,$hh,$query3,$dataUji,$dataLatih,$predict));
    }
    function predict($idikan,$idkecamatan,$periode){
        $tahunawal = 2014;
        $tahunakhir = 2017;
        $queryLatih = $this->peramalan->getDataByKecamatanAndJenisAndYear($idkecamatan,$idikan,$tahunawal,$tahunakhir);
        $queryUji = $this->peramalan->getDataByKecamatanAndJenisPredik($idkecamatan,$idikan,2019);
        $dataLatih = array();
        $dataUji = array();
        foreach($queryUji as $q3){
            $dataUji[] = $q3->JumlahTangkapanIkan;
        }
        foreach($queryLatih as $q){
           $dataLatih[] = $q->JumlahTangkapanIkan;
        }
        for($i=0;$i<$periode;$i++){
            $dataUji[] = "5";
        }

        $hasil = $this->arima->getSARIMA($dataUji,$dataLatih,$periode);
        $res = array(["Bulan Tahun","Jumlah"]);
        $n=0;
        for($i=0;$i<count($hasil);$i++){
            $row = array();
            $row[] = $this->bulan[$n]."- 2020";
            $row[] = $hasil[$i]; 
            $res[] = $row;
            $n++;
        }
        return $res;
    }
}