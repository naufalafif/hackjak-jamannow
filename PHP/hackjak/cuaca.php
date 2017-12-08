<?php

require "engine_php/App.php";
$app = new App();

$data = $app->getCuaca();

if (strpos($data['current']['condition']['text'], 'rain') !== false) {
    $data['current']['condition']['text'] = 1;
}else{
    $data['current']['condition']['text'] = 0;
}

$i = 0;
foreach ($data['forecast']['forecastday'][0]['hour'] as $row) {
    if (strpos($row['condition']['text'], 'rain') !== false) {
        $data['forecast']['forecastday'][0]['hour'][$i]['condition']['text'] = 1;
    }else{
        $data['forecast']['forecastday'][0]['hour'][$i]['condition']['text'] = 0;
    }   
    $i++;
}

if(isset($_GET['jam'])){
    $hasil['hasil'] = $app->getStatusKriminal($data['forecast']['forecastday'][0]['hour'][$_GET['jam']]['temp_c'],$data['forecast']['forecastday'][0]['hour'][$_GET['jam']]['condition']['text']);
    $temp = explode("'",$hasil['hasil']);
    $hasil['hasil'] = $temp[1];

    echo json_encode($hasil);
}else{
    if(isset($_GET['all'])){
        $hasil['hasil'][] = "";
        for($i=0;$i<24;$i++){
            $temp = $app->getStatusKriminal($data['forecast']['forecastday'][0]['hour'][$i]['temp_c'],$data['forecast']['forecastday'][0]['hour'][$i]['condition']['text']);
            $temp1 = explode("'",$temp);
            $temp = $temp1[1];
            if($temp=="Ada") 
                $hasil['hasil'][] = $i;
        }
        if(isset($hasil))
            echo json_encode($hasil);
    }else{
    $hasil['hasil'] = $app->getStatusKriminal($data['current']['temp_c'],$data['current']['condition']['text']);        
    $temp = explode("'",$hasil['hasil']);
    $hasil['hasil'] = $temp[1];

    echo json_encode($hasil);
    }
}

?>