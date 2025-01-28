<?php 

namespace Model;

use Database;

class AbstractModel {

    protected $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    }
