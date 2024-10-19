<?php

require_once __DIR__ . '/inc/all.php';

$fetcher = new \App\Weather\Fake\FakeWeatherFetcher();
$weather = $fetcher->getWeatherForCity('Budapest');

/*
function doSomething(\App\Weather\WeatcherContract $f) {

}
*/
var_dump($weather);


render(__DIR__ . '/views/index.view.php', [
    'weather' => $weather
]);
