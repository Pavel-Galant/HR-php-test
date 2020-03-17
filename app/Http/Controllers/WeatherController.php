<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    // 
    public function index()
    {
        $url = 'https://api.weather.yandex.ru/v1/forecast?lat=53.2520&lon=34.3716&limit=6&lang=ru_RU';
        
        $token = 'fd85841f-1b3e-4f1c-9e01-49dcc5394475';
        $headers = array(
            "X-Yandex-API-Key: $token",                   
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($curl);
        try {
            $data =  ($result === false || curl_getinfo($curl)['http_code'] != 200) ? [] : json_decode($result, true);
        } catch (Exception $e) {
            $data = [];
        }
        curl_close($curl);
        //var_dump($data['forecasts'][0]['parts']); die();
        return view('pages.weather', ['data' => $data]);
    }
}
