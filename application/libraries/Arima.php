<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Arima {
    private $bulan = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nop","Des");
     
    //Sarima Tuna (1,0,2)x(1,0,0,12)
    
    public function __construct(){
        
    }
    function getCoefficients($idikan,$type,$order){
        $c = array([[[0.6896,0.6608],[0.8957,-0.2968,0.6824]],[],[]],[[],[],[]],[[],[],[]]);
        $result = array();
         switch($idikan){
             case 1:
                  switch($type){
                      case 1:
                        switch($order){
                            case 1:
                                $result[] = $c[0][0][0];
                                break;
                            case 2:
                                $result[] = $c[0][0][1];
                        }
                  }
         }
         return $result;
    }
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
    function getpacf($data,$lag,$id){
        $pacf = array();
        for($i=1;$i<=$lag;$i++){
           $pacf[] = $this->reduceData($data,$i);
        }
        return $pacf;
    }
    
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
    function getARCoefficients($latih,$order){
        $regression = new Phpml\Regression\LeastSquares();
        $samples = array();
        $target = array();
        
        switch($order){
            case 1 :
                for($i=13;$i<count($latih);$i++){
                    $target[] = $latih[$i];
                    $samples[] = [$latih[$i-1],$latih[$i-13]];
                 }
                break;
            case 2 :
                for($i=14;$i<count($latih);$i++){
                    $target[] = $latih[$i];
                    $samples[] = [$latih[$i-1],$latih[$i-2],$latih[$i-14]];
                 }
                break;
            case 3 :
            for($i=15;$i<count($latih);$i++){
                    $target[] = $latih[$i];
                    $samples[] = [$latih[$i-1],$latih[$i-2],$latih[$i-3],$latih[$i-15]];
                }
            break;
        }
        
        
        $regression->train($samples,$target);
        //echo json_encode(array($regression->getIntercept(),$regression->getCoefficients()));
        return array($regression->getIntercept(),$regression->getCoefficients());
    }
    function getMACoefficients($data,$error){
         $regression = new Phpml\Regression\LeastSquares();
         $y = array();
         $yminone = array();
         $ma = array();
         for($i=0;$i<count($data)-1;$i++){
            $row = array();
            $y[] = $data[$i+1];
            $row= [$data[$i],$error[$i]];
            $ma[] = $row;
         }
         $regression->train($ma,$y);
         return array($regression->getIntercept(),$regression->getCoefficients());
    }
    function prediksi(){
        
    }
    function getSARIMA($uji,$latih){
      $result = array();
      $order = 2;
      $arcoeff = $this->getARCoefficients($uji,$order);
      $getCo = $this->getCoefficients(1,1,$order);
      $arresult = $this->getARResult($uji,$arcoeff,$latih,$order);
      $ariresult = $this->getARMAResult($uji,$arcoeff,$latih,$order);
      //$ariresult = $this->getARIResult($uji,$latih);
      return $arresult;
    }
    function getARResult($uji,$coeff,$latih,$order){
        $result = array();
        //$c = $coeff[0];
        switch($order){
            case 1:
                $result[] = $coeff[0]+$coeff[1][0]*$latih[12]+$coeff[1][1]*$uji[0];
                for($i=1;$i<count($uji);$i++){
                    $result[] = $coeff[0]+$coeff[1][0]*$result[$i-1]+$coeff[1][1]*$uji[$i];
                }
                break;
            case 2:
                $result[] = $coeff[0]+$coeff[1][0]*$latih[12]+$coeff[1][1]*$latih[11]+$coeff[1][2]*$uji[0];
                $result[] = $coeff[0]+$coeff[1][0]*$result[0]+$coeff[1][1]*$latih[12]+$coeff[1][2]*$uji[1];
                for($i=2;$i<count($uji);$i++){
                    $result[] = $coeff[0]+$coeff[1][0]*$result[$i-1]+$coeff[1][1]*$result[$i-2]+$coeff[1][2]*$uji[$i];
                }
                // $result[] = $c[0]*$latih[12]+$c[1]*$latih[11]+$c[2]*$uji[0];
                // $result[] = $c[0]*$result[0]+$c[1]*$latih[12]+$c[2]*$uji[1];
                // for($i=2;$i<count($uji);$i++){
                //     $result[] = $c[0]*$result[$i-1]+$c[1]*$result[$i-2]+$c[2]*$uji[$i];
                // }
                break;
            case 3:
                $result[] = $coeff[0]+$coeff[1][0]*$latih[12]+$coeff[1][1]*$latih[11]+$coeff[1][2]*$latih[10]+$coeff[1][3]*$uji[0];
                $result[] = $coeff[0]+$coeff[1][0]*$result[0]+$coeff[1][1]*$latih[12]+$coeff[1][2]*$latih[11]+$coeff[1][3]*$uji[1];
                $result[] = $coeff[0]+$coeff[1][0]*$result[1]+$coeff[1][1]*$result[0]+$coeff[1][2]*$latih[12]+$coeff[1][3]*$uji[2];
                for($i=3;$i<count($uji);$i++){
                    $result[] = $coeff[0]+$coeff[1][0]*$result[$i-1]+$coeff[1][1]*$result[$i-2]+$coeff[1][2]*$result[$i-3]+$coeff[1][3]*$uji[$i];
                }
                break;
        }
        array_splice($result,0,1);
        $result[] = 4;
        return $result;
    }
    function getARMAResult($uji,$coeff,$latih,$order){
        $result = array();
        switch($order){
            case 1:
                $result[] = $coeff[0]+$coeff[1][0]*($latih[12]-$latih[11])+$latih[12]+$coeff[1][1]*$uji[0];
                $result[] = $coeff[0]+$coeff[1][0]*($result[0]-$latih[12])+$result[0]+$coeff[1][1]*$uji[1];
                for($i=2;$i<count($uji);$i++){
                    $result[] = $coeff[0]+$coeff[1][0]*($result[$i-1]-$result[$i-2])+$result[$i-1]+$coeff[1][1]*$uji[$i];
                }
                break;
            case 2:
                $result[] = $coeff[0]+$coeff[1][0]*($latih[12]-$latih[11])+$latih[12]-$coeff[1][1]*($latih[11]-$latih[10])+$latih[11]+$coeff[1][2]*$uji[0];
                $result[] = $coeff[0]+$coeff[1][0]*($result[0]-$latih[12])+$result[0]-$coeff[1][1]*($latih[12]-$latih[11])+$latih[12]+$coeff[1][2]*$uji[1];
                $result[] = $coeff[0]+$coeff[1][0]*($result[1]-$result[0])+$result[1]-$coeff[1][1]*($result[0]-$latih[12])+$result[0]+$coeff[1][2]*$uji[2];
                for($i=3;$i<count($uji);$i++){
                    $result[] = $coeff[0]+$coeff[1][0]*($result[$i-1]-$result[$i-2])+$result[$i-1]-$coeff[1][1]*($result[$i-2]-$result[$i-3])+$result[$i-2]+$coeff[1][2]*$uji[$i];
                }
        }
        array_splice($result,0,1);
        $result[] = 4;
        return $result;
    }
    function getARIResult($uji,$latih){
        $result = array();
        $result[] = 0.1145*($latih[12]-$latih[11])+$latih[12]+0.6228*$uji[0];
        $result[] = 0.1145*($result[0]-$latih[12])+$latih[12]+0.6228*$uji[0];
        for($i=2;$i<count($uji);$i++){
            $result[] = 0.1145*($result[$i-1]-$result[$i-2])+$latih[$i-1]+0.6228*$uji[$i];
        }
        return $result;
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