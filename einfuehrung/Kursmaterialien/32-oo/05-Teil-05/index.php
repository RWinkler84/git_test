<?php

class PageModel {

    // public function __construct(public string $title = 'Hallo') {}

    public function __construct(public array $attributes = []) {}

    public function __get($name) {
        return $this->attributes[$name];
    }

    public function __set($name, $value) {
        // var_dump($value);
        $this->attributes[$name] = $value;
    }

    public function __isset($name) {
        return isset($this->attributes[$name]);
    }


}

$page = new PageModel([
    'title' => 'Hallo Welt'
]);
var_dump($page->title);

$page->title = 'Hallo Mars';

var_dump(isset($page->title));
