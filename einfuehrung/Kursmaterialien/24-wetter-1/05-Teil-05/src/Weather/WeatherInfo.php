<?php

namespace App\Weather;

class WeatherInfo {

    public function __construct(public string $temperature, public bool $raining) {}
}