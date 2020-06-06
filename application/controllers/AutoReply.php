<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AutoReply extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
        }
        $this->load->model('SmsGateway_model','smsgateway');
        $this->load->model('Sms_model','sms');
        $this->load->model('Peramalan_model','peramalan');
        $this->load->model('PeramalanAlatTangkap_model','peramalanat');
        $this->load->library('arima');
    }
    function index(){
        $this->load->view("header");
        $this->load->view("sidebar");
        $this->load->view("autoreply");
        $this->load->view("footer");
       
    }
    function getInbox(){
        if($this->smsgateway->runDaemon()){
            $query = $this->smsgateway->runDaemon()->TextDecoded;
            $idkecamatan = $this->smsgateway->runDaemon()->IDKecamatan;
            $messageID = $this->smsgateway->runDaemon()->ID;
            $senderNumber = $this->smsgateway->runDaemon()->SenderNumber;
            $res = explode(",",$query);
            $idikan;
            $jumlahTangkapan;
            $dInsert = array();
            $dUpdate = array();
            $bulan = (new DateTime())->format('m');
            $tahun = (new DateTime())->format('Y');
            if(preg_match("/tu/",strtolower($res[0])) == TRUE){
                $idikan = 1;
                $jumlahTangkapan = explode(" ",$res[1])[1];
            }
            if(preg_match("/ca/",strtolower($res[0])) == TRUE){
                $idikan = 3;
                $jumlahTangkapan = explode(" ",$res[1])[1];
            }
            if(preg_match("/to/",strtolower($res[0])) == TRUE){
                $idikan = 4;
                $jumlahTangkapan = explode(" ",$res[1])[1];
            }
            for($i=0;$i<count($res);$i++){
                $v = explode(" ",$res[$i]);
                if($idikan == 1){
                    if(preg_match("/pancingulur/",strtolower($v[0])) == TRUE){
                        if($this->smsgateway->isExist($bulan,$tahun,1,$idikan) == null){
                        $dInsert[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 1,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }else{
                        $dUpdate[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 3,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                     }
                    }
                }else if($idikan == 3 || $idikan == 4){
                    if(preg_match("/pur/",strtolower($v[0])) == TRUE){
                        if($this->smsgateway->isExist($bulan,$tahun,1,$idikan) == null){
                        $dInsert[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 1,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }else{
                        $dUpdate[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 1,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }
                    
                    }else if(preg_match("/gil/",strtolower($v[0])) == TRUE){
                    if($this->smsgateway->isExist($bulan,$tahun,1,$idikan) == null){
                        $dInsert[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 2,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }else{
                        $dUpdate[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 2,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }
                    }else if(preg_match("/klithik/",strtolower($v[0])) == TRUE){
                    if($this->smsgateway->isExist($bulan,$tahun,1,$idikan) == null){
                        $dInsert[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 4,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }else{
                        $dUpdate[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 4,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }
                    }else if(preg_match("/pancinglain/",strtolower($v[0])) == TRUE){
                    if($this->smsgateway->isExist($bulan,$tahun,1,$idikan) == null){
                        $dInsert[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 5,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }else{
                        $dUpdate[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 5,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }
                    }else if(preg_match("/rawaihanyut/",strtolower($v[0])) == TRUE){
                    if($this->smsgateway->isExist($bulan,$tahun,1,$idikan) == null){
                        $dInsert[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 7,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }else{
                        $dUpdate[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 7,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }
                    }else if(preg_match("/rawaitetap/",strtolower($v[0])) == TRUE){
                    if($this->smsgateway->isExist($bulan,$tahun,1,$idikan) == null){
                        $dInsert[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 8,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }else{
                        $dUpdate[] = array(
                            "Bulan" => $bulan,
                            "Tahun" => $tahun,
                            "IDAlatTangkap" => 8,
                            "IDIkan" => $idikan,
                            "JumlahTangkapan" => $v[1]
                        );
                        }
                    }
                }
            }
            $bulan = (new DateTime())->format('m');
            $tahun = (new DateTime())->format('Y');
            $data = array(
                "DestinationNumber" => $senderNumber,
                "TextDecoded" => "Prediksi Cakalang 100 Tuna 200 Tongkol 300"
            );
            $this->smsgateway->saveData($idikan,$jumlahTangkapan,$bulan,$tahun,$idkecamatan);
            count($dInsert) > 0 ? $this->smsgateway->saveDataAlatTangkap($dInsert) : "";
            count($dUpdate) > 0 ? $this->smsgateway->updateDataAlatTangkap($dUpdate) : "";
            
            $periode = 3;
            $prediksi = $this->prediction($idikan,$idkecamatan,$periode+($bulan+1));
           
            $namaIkan = $this->smsgateway->getNamaIkan($idikan);
            $isiSMS='Prediksi Ikan '.$namaIkan->NamaIkan;
            $hasil = array();
            if(count($dInsert) > 0){
                foreach($dInsert as $ds){
                    $hasil[] = $this->prediksiAlatTangkap($ds["IDAlatTangkap"],$ds["IDIkan"],$periode+($bulan+1));
                }
            }
            if(count($dUpdate) > 0){
                foreach($dUpdate as $ds){
                    $hasil[] = $this->prediksiAlatTangkap($ds["IDAlatTangkap"],$ds["IDIkan"],$periode+($bulan+1));
                }
            }
            for($i=count($prediksi)-($periode);$i<count($prediksi);$i++){
                 $isiSMS .= ' Bulan ke:'.$i.' sebesar :'.round($prediksi[$i],2);
            }
            $datakec = array(
                "DestinationNumber" => $senderNumber,
                "TextDecoded" => $isiSMS
            );
            $this->sms->insert($datakec);
            $pos='';
            if($idikan == 3 || $idikan == 4){
                $pos .= 'Prediksi Alat Ikan '.$namaIkan->NamaIkan.' Pursu : '.round($hasil[0][count($hasil[0])-$periode],1);
                $pos .= ' Gillnet : '.round($hasil[1][count($hasil[1])-$periode],1);
                $pos .= ' Klithik : '.round($hasil[2][count($hasil[2])-$periode],1);
                $pos .= ' Pancing lain : '.round($hasil[1][count($hasil[3])-$periode],1);
                $pos .= ' Rawai Hanyut : '.round($hasil[1][count($hasil[4])-$periode],1);
                $pos .= ' Rawai Tetap : '.round($hasil[1][count($hasil[5])-$periode],1);
            }else if($idikan == 1){
                $pos .= 'Prediksi Alat Ikan '.$namaIkan->NamaIkan.' Pancingulur : '.round($hasil[0][count($hasil[0])-$periode],1);
            }
            $dataat = array(
                "DestinationNumber" => $senderNumber,
                "TextDecoded" => $pos
            );
            $this->sms->insert($dataat);
            $dd = array(
                "messageid" => $messageID
            );
            $this->smsgateway->saveReplyID($dd);
            echo json_encode($pos);
        }
    }
    function prediction($idikan,$idkecamatan,$periode){
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
        return $hasil;
    }
    function prediksiAlatTangkap($idalattangkap,$idikan,$periode){
        $tahunawal = 2014;
        $tahunakhir = 2017;
        $queryLatih = $this->peramalanat->getDataByAlatTangkapAndJenisAndYear($idalattangkap,$idikan,$tahunawal,$tahunakhir);
        $queryUji = $this->peramalanat->getDataByAlatTangkapAndJenisPredik($idalattangkap,$idikan,2019);
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
        
        return $hasil;
    }
}