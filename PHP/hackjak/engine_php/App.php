<?php

class App{
    private $dbc;

    function __construct(){
        $this->dbc = new mysqli("localhost","root","naufalafif58","hackjak");
    }

    function getTawuran(){    
        $json_url = 'http://api.jakarta.go.id/ruang-publik/tawuran';
        $ch = curl_init ($json_url);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
        );
        curl_setopt_array ($ch, $options); // setting curl options
        $result = curl_exec($ch); // getting json result string

        $decode = json_decode($result, true);
        
        return $decode;
    }

    function getDataTitik(){
        $json_url = 'http://localhost/hackjak/data.php?data=titik';
        $ch = curl_init ($json_url);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
        );
        curl_setopt_array ($ch, $options); // setting curl options
        $result = curl_exec($ch); // getting json result string

        $decode = json_decode($result, true);
        
        return $decode;     
    }

    function insertTitik($data){
        extract($data);

        $sql = "INSERT INTO `titik_kriminal`(`lokasi`, `longitude`, `latitude`) VALUES ('".$lokasi."','".$longitude."','".$latitude."')";
        $query = $this->dbc->query($sql);
        return $query;
    }

    function getCuaca(){
        $json_url = 'http://api.apixu.com/v1/forecast.json?key=37406666fb9c4228bbf225828170712&q=Jakarta';
        $ch = curl_init ($json_url);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
        );
        curl_setopt_array ($ch, $options); // setting curl options
        $result = curl_exec($ch); // getting json result string

        $decode = json_decode($result, true);
        
        return $decode;
    }

    function getStatusKriminal($suhu,$hujan){
        $command = escapeshellcmd('/home/naufal/anaconda2/bin/python /var/www/html/hackjak/engine_py/cm_services.py '.$suhu.' '.$hujan);
        $output = shell_exec($command);

        return $output;
    }

    function getStatusKriminalJam($jam = "Kosong"){
        $json_url = 'http://localhost/hackjak/cuaca.php';
        if($jam != "Kosong")
            $json_url = 'http://localhost/hackjak/cuaca.php?jam='.$jam;
        $ch = curl_init ($json_url);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
        );
        curl_setopt_array ($ch, $options); // setting curl options
        $result = curl_exec($ch); // getting json result string

        $decode = json_decode($result, true);
        
        return $decode;     
    }

    function getOneDayStatus(){
        $json_url = 'http://localhost/hackjak/cuaca.php?all=1';
        $ch = curl_init ($json_url);
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-type: application/json'),
        );
        curl_setopt_array ($ch, $options); // setting curl options
        $result = curl_exec($ch); // getting json result string

        $decode = json_decode($result, true);
        
        return $decode;    
    }

    function getTitik(){
        $sql = "SELECT * FROM `titik_kriminal`";
        $query = $this->dbc->query($sql);
        while($row = $query->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }
}

?>