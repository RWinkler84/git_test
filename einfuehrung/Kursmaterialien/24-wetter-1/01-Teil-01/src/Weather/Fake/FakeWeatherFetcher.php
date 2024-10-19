<?php

namespace App\Weather\Fake;

use App\Weather\WeatherContract;
use App\Weather\WeatherInfo;


class FakeWeatherFetcher implements WeatherContract {

    public function getWeatherForCity(string $cityName): WeatherInfo {
        return new WeatherInfo(21, false);
    }
}