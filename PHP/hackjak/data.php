<?php
require "engine_php/App.php";
$app = new App();

$data = $app->getTawuran();

$data2 = $app->getTitik();
foreach ($data2 as $row) {
    $temp['id'] = $row['id_titik'];
    $temp['lokasi'] = $row['lokasi'];
    $temp['unsur'] = "";
    $temp['location']['latitude'] = $row['latitude'];
    $temp['location']['longitude'] = $row['longitude'];
    
    $data['data'][] = $temp;
}

echo json_encode($data);
?>