<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";


class WeatherController extends ControllerBase
{

    public function handleRequest($request_info)
    {
        if ($this->path_count == 3) {
            $this->showWeather();
        } else {
            $this->notFound();
        }
    }

    public function showWeather() 
    {
        echo $this->path_parts[2];
        $url = "http://api.weatherapi.com/v1/current.json?key=74a4e32877054d6b9e9145123231106&q=". rawurlencode($this->path_parts[2]) ."&aqi=no";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($curl);
        

        if ($response === false) {
            $this->notFound();
        } else {
            $this->model = json_decode($response);
        }

        curl_close($curl);
        
        $this->viewPage("weather");
    }
}
