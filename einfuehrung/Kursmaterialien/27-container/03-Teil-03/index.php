<?php

class PostsRepository {
    public function __construct(protected $a, protected $b, protected $c) {}
}

class Container {

    protected $receipts;

    protected $instances = [];

    public function __construct() {
        $this->receipts = [
            'postsRepository' => function() {
                return new PostsRepository('A', 'B', 'C');
            }
        ];
    }

    public function get($what) {
        if (!isset($this->instances[$what])) {
            $this->instances[$what] = $this->receipts[$what]();
        }
        return $this->instances[$what];
    }
}

$container = new Container();
$postsRepository = $container->get('postsRepository');
 
var_dump($postsRepository);