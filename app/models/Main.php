<?php

namespace app\models;

use app\core\Model;

class Main extends Model
{
    function getNews()
    {
        return $this->db->rows('SELECT title, description FROM news');
    }
}