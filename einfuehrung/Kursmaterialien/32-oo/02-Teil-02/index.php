<?php

class Container {

    private function __construct() {}

    private static $instance = null;

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

$c1 = Container::getInstance();
$c2 = Container::getInstance();

var_dump($c1);
var_dump($c2);
