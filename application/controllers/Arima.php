<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arima extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('Arima_model');
    }
    function cetak(){
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World Say!');
        $pdf->Output();
    }
    function get(){
        $query = $this->Arima_model->getAll();
        $data = array();
        $ref = array();
        $samples = [[60], [61], [62], [63], [65]];
        $targets = [3.1, 3.6, 3.8, 4, 4.1];
        $diff = array();
        $diff[0] = 0;
        for($i=1;$i<count($query);$i++){
            $diff[$i] = $query[$i]->jumlah - $query[$i-1]->jumlah;
        }
        // for($i=0;$i<count($query)-1;$i++){
        //     $data[] = [(int)$query[$i]->jumlah];
        // }
        // for($i=1;$i<count($query);$i++){
        //     $ref[] = (int)$query[$i]->jumlah;
        // }
        //$regression = new Phpml\Regression\LeastSquares();
        //$regression->train($data,$ref);
        
        $corrArray = array();

        for($i=0;$i<20;$i++){
            $dat = array();
            for($j=0;$j<count($diff)-$i;$j++){
                
                $dat[] = $diff[$j];
            }
            $re = array();
            for($k=$i+1;$k<count($diff);$k++){
                $re[] = $diff[$k];
            }
            $corrArray[] = array($dat,$re);
        }
        $acf = array();
        foreach($corrArray as $cr){
            $acf[] = $this->Corr($cr[1],$cr[0]);
        }
        echo json_encode($acf);
        //echo json_encode($regression->getIntercept());
        //echo json_encode(array($data,$ref));
    }
    function getacf(){

    }
    
    function getIntercept(){
        
    }
    function Corr($x, $y){
        $length= count($x);
        $mean1=array_sum($x) / $length;
        $mean2=array_sum($y) / $length;
        
        $a=0;
        $b=0;
        $axb=0;
        $a2=0;
        $b2=0;
        
        for($i=0;$i<$length;$i++)
        {
        $a=$x[$i]-$mean1;
        $b=$y[$i]-$mean2;
        $axb=$axb+($a*$b);
        $a2=$a2+ pow($a,2);
        $b2=$b2+ pow($b,2);
        }
        
        $corr= $axb / sqrt($a2*$b2);
        
        return $corr;
    }
}