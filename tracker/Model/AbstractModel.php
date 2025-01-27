<?php 

namespace model;

use Database;

class AbstractModel {

    protected $db;

    function __construct()
    {
        $this->db = new Database;
    }

    }
