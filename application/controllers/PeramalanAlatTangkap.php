<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PeramalanAlatTangkap extends CI_Controller {
    private $bulan = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nop","Des");
    function __construct(){
        parent::__construct();
        $this->load->model('JenisIkan_model','jenisikan');
        $this->load->model('AlatTangkap_model','alattangkap');
        $this->load->model('PeramalanAlatTangkap_model','peramalan');
        $this->load->library('arima');
    }
    function index(){
        $ji = $this->jenisikan->getIkan();
        $at = $this->alattangkap->getAll();
        $data = array("jenisikan" => $ji, "alattangkap" => $at);
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("peramalanalattangkap",$data);
        $this->load->view("footer");
    }
    function getdata(){
        $regression = new Phpml\Regression\LeastSquares();
        
        $idikan = $this->input->post('jenisikan');
        $idalattangkap = $this->input->post('alattangkap');
        $periode = $this->input->post('periode');
        $trainAndTest = $this->trainAndTest($idikan,$idalattangkap,$periode);
        return $trainAndTest;
    }
    function predict($idikan,$idalattangkap,$periode){
        $tahunawal = 2014;
        $tahunakhir = 2017;
        $queryLatih = $this->peramalan->getDataByAlatTangkapAndJenisAndYear($idalattangkap,$idikan,$tahunawal,$tahunakhir);
        $queryUji = $this->peramalan->getDataByAlatTangkapAndJenisPredik($idalattangkap,$idikan,2019);
        $dataLatih = array();
        $dataUji = array();
        foreach($queryUji as $q3){
            $dataUji[] = $q3->JumlahTangkapan;
        }
        foreach($queryLatih as $q){
           $dataLatih[] = $q->JumlahTangkapan;
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
    function trainAndTest($idikan,$idalattangkap,$periode){
        $arima = $this->arima;
        $tahunawal = 2014;
        $tahunakhir = 2017;
        $query = $this->peramalan->getDataByAlatTangkapAndJenisAndYear($idalattangkap,$idikan,$tahunawal,$tahunakhir);
        $query2 = $this->peramalan->getDataByAlatTangkapAndJenis($idalattangkap,$idikan);
        $query3 = $this->peramalan->getDataByAlatTangkapAndJenisRamal($idalattangkap,$idikan,$tahunakhir);
        $arrayData = array();
        $dataLatih = array();
        $dataUji = array();
        if(count($query)==0 && count($query2) == 0 && count($query3) == 0){
            echo json_encode("Kosong");
        }else{
            try {
                foreach($query3 as $q3){
                    $dataUji[] = $q3->JumlahTangkapan;
                }
                foreach($query as $q){
                    $dataLatih[] = $q->JumlahTangkapan;
                }
                $ramal = array(["Bulan Tahun","Jumlah"]);
                $ramal[1] = array("Jan-2014",(float)$query[0]->JumlahTangkapan);
                $hh = $arima->getSARIMA($dataUji,$dataLatih,24);
                $maError = array();
                for($i=12;$i<(count($query3));$i++){
                    $row = array();
                    $row[] = $this->bulan[($query3[$i]->Bulan)-1]."-".$query3[$i]->Tahun;
                    $row[] = $hh[$i-12];
                    $ramal[] = $row; 
                }
                $lag = count($query) > 36 ? 20 : count($query) * 0.5;
                $acf = $arima->getACF($dataLatih,$lag);
                $pacf = $arima->getPACF($dataLatih,$lag,$idikan);
                $predict = $this->predict($idikan,$idalattangkap,$periode);
                echo json_encode(array($query2,$acf,$ramal,$pacf,$hh,$query3,$dataUji,$dataLatih,$predict));
            }catch(Exception $e){
                $query2=array();
                echo json_encode(array($query2));
            }
        }
    }
}