<?php

class CustomPDO {}

class PostsRepository {
    public function __construct(protected $a, protected $b, protected $c) {}
}

class Container {

    protected $receipts = [];

    protected $instances = [];

    public function __construct() {
        /* $this->receipts = [
            'postsRepository' => function() {
                return new PostsRepository('A', 'B', 'C');
            }
        ]; */
    }

    public function add(string $key, \Closure $func) {
        $this->receipts[$key] = $func;
    }

    public function get($what) {
        // echo "Anfang: get({$what})\n";
        if (!isset($this->instances[$what])) {
            $this->instances[$what] = $this->receipts[$what]();
        }
        // echo "Ende: get({$what})\n";
        return $this->instances[$what];
    }
}

$container = new Container();
$container->add('pdo', function() {
    return new CustomPDO();
});
$container->add('postsRepository', function() use($container) {
    return new PostsRepository($container->get('pdo'), 'B', 'C');
});
$postsRepository = $container->get('postsRepository');
var_dump($postsRepository);

// $pdo = $container->get('pdo');
// var_dump($pdo);