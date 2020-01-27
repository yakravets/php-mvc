<?php

namespace app\models;

use app\core\Model;

class Main extends Model
{
    function getNews()
    {
        $result = $this->db->rows('SELECT * FROM *');
        return $result;
    }
}