<?php

namespace Models;

use Services\DB_Model;

class ArticleModel
{
    private $db;

    public function __construct()
    {
        $this->db = new DB_Model();
    }
    public function selectArticles()
    {
        $dbResult = $this->db->query('SELECT * FROM `articles`;');
        return $dbResult;
    }
}