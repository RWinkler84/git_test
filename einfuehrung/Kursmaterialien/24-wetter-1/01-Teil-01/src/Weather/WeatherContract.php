<?php

namespace App\Weather;


interface WeatherContract {

    public function getWeatherForCity(string $cityName): WeatherInfo;
}