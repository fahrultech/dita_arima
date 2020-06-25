<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Arima {
    // Variabel array bulan untuk menyimpan nama-nama bulan yang akan ditampilkan
    private $bulan = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nop","Des");
     
    //Sarima Tuna (1,0,2)x(1,0,0,12)
    
    public function __construct(){
        
    }
    
    // Fungsi yang digunakan untuk menghasilkan nilai ACF
    public function getACF($data,$lag){
        $ref = array();
        $diff = array();
        $corrArray = array();
        
        $diff[] = 0;
        for($i=1;$i<count($data);$i++){
            $diff[] = $data[$i] - $data[$i-1];
        }
        for($i=0;$i<$lag;$i++){
            $dat = array();
            for($j=0;$j<count($diff)-$i;$j++){
                $dat[] = $data[$j];
            }
            $re = array();
            for($k=$i+1;$k<count($diff);$k++){
                $re[] = $data[$k];
            }
            $corrArray[] = array($dat,$re);
        }
        $acf = array();
        foreach($corrArray as $cr){
            $acf[] = $this->Corr($cr[1],$cr[0]);
        }
       
        return $acf;
    }
    
    // Fungsi yang digunakan untuk mendapatkan nilai pacf
    function getpacf($data,$lag,$id){
        $pacf = array();
        for($i=1;$i<=$lag;$i++){
           $pacf[] = $this->reduceData($data,$i);
        }
        return $pacf;
    }
    
    // Fungsi yang mengembalikan nilai correlasi dari dua buah array
    function reduceData($data,$lag){
        $regression = new Phpml\Regression\LeastSquares();
        $regression2 = new Phpml\Regression\LeastSquares();
        $dataArray = array();
        $sample = array();
        $sample2 = array();
        for($i=$lag+1;$i<count($data);$i++){
            $row = array();
            for($j=$i-1;$j>=($i-$lag)-1;$j--){
                if($j !== ($i-$lag)){
                    $row[] = (float)$data[$j];
                }
            }
            $dataArray[] = $row;
            $sample[] = (float)$data[$i];
            $sample2[] = (float)$data[$i-$lag];
        }
        $regression->train($dataArray,$sample);
        $regression2->train($dataArray,$sample2);
        $coeff = $regression->getCoefficients();
        $coeff2 = $regression2->getCoefficients();
        $linearReg = array();
        $linearRegPrev = array();
        $linErr = array();
        $linErrPrev = array();
        for($i=0;$i<count($dataArray);$i++){
            $sumAr = 0;
            $sumArPrev = 0;
            for($j=0;$j<count($dataArray[$i]);$j++){
               $sumAr += $dataArray[$i][$j] * $coeff[$j];
               $sumArPrev += $dataArray[$i][$j] * $coeff2[$j];
            }
            $linErr[] = $sample[$i]-$sumAr;
            $linErrPrev[] = $sample2[$i]-$sumArPrev;
            $linearReg[] = $sumAr;
            $linearRegPrev[] = $sumArPrev;
        }
        return $this->Corr($linErr,$linErrPrev);
    }

    // Fungsi yang digunakan untuk mendapatkan Coefficient untuk AR
    function getARCoefficients($latih,$order){
        $regression = new Phpml\Regression\LeastSquares();
        $samples = array();
        $target = array();
        
        switch($order){
            case 1 :
                for($i=12;$i<count($latih);$i++){
                    $target[] = $latih[$i];
                    $samples[] = [$latih[$i-1],$latih[$i-12]];
                 }
                break;
            case 2 :
                for($i=12;$i<count($latih);$i++){
                    $target[] = $latih[$i];
                    $samples[] = [$latih[$i-1],$latih[$i-2],$latih[$i-12]];
                 }
                break;
            case 3 :
            for($i=12;$i<count($latih);$i++){
                    $target[] = $latih[$i];
                    $samples[] = [$latih[$i-1],$latih[$i-2],$latih[$i-3],$latih[$i-12]];
                }
            break;
        }
        $regression->train($samples,$target);
        //echo json_encode(array($regression->getIntercept(),$regression->getCoefficients()));
        return array($regression->getIntercept(),$regression->getCoefficients());
    }

    // Fungsi utama pada SARIMA
    function getSARIMA($uji,$latih,$periode=0){
      $result = array();
      $order = 2;
      $arcoeff = $this->getARCoefficients($latih,$order);
      $arresult = $this->getARResult($uji,$arcoeff,$latih,$order,$periode);
      return $arresult;
    }

    // Fungsi yang digunakan untuk mendapatkan hasil dari arima order(1,0,0)
    function getARResult($uji,$coeff,$latih,$order,$periode){
        $result = array();
        switch($order){
            case 1:
                $result[] = $coeff[0]+$coeff[1][0]*$uji[12]+$coeff[1][1]*$uji[0];
                for($i=1;$i<count($uji);$i++){
                    $result[] = $coeff[0]+$coeff[1][1]*$result[$i-1]+$coeff[1][0]*$uji[$i];
                }
                break;
            case 2:
                $result[] = $coeff[0]+$coeff[1][2]*$uji[11]+$coeff[1][1]*$uji[10]+$coeff[1][0]*$uji[0];
                $result[] = $coeff[0]+$coeff[1][2]*$result[0]+$coeff[1][1]*$uji[11]+$coeff[1][0]*$uji[1];
                for($i=2;$i<$periode;$i++){
                    $result[] = $coeff[0]+$coeff[1][2]*$result[$i-1]+$coeff[1][1]*$result[$i-2]+$coeff[1][0]*$uji[$i];
                }
                break;
            case 3:
                $result[] = $coeff[0]+$coeff[1][3]*$uji[12]+$coeff[1][2]*$uji[11]+$coeff[1][1]*$uji[10]+$coeff[1][0]*$uji[0];
                $result[] = $coeff[0]+$coeff[1][3]*$result[0]+$coeff[1][2]*$uji[12]+$coeff[1][1]*$uji[11]+$coeff[1][0]*$uji[1];
                $result[] = $coeff[0]+$coeff[1][3]*$result[1]+$coeff[1][2]*$result[0]+$coeff[1][1]*$uji[12]+$coeff[1][0]*$uji[2];
                for($i=3;$i<count($uji);$i++){
                    $result[] = $coeff[0]+$coeff[1][3]*$result[$i-1]+$coeff[1][2]*$result[$i-2]+$coeff[1][1]*$result[$i-3]+$coeff[1][0]*$uji[$i];
                }
                break;
        }
        return $result;
    }
    // Fungsi yang digunakan untuk menghasilkan nilai mape
    function mape($prediksi,$actual){
        $ape = array();
        for($i=0;$i<count($prediksi);$i++){
            $ape[] = abs(round((($actual[$i+12]-$prediksi[$i])/$actual[$i+12])*100,4));
        }
        return round((array_sum($ape)/count($ape)),2);
    }

    // Fungsi untuk mengembalikan correlasi dari dua array
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