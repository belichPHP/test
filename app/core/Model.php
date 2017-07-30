<?php
/**
 * Created by PhpStorm.
 * User: Belix
 * Date: 29.07.2017
 * Time: 17:58
 */

namespace app\core;

use PDO;

class Model
{
    public $pdo;

    function __construct()
    {
        $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=test','root', '');
    }


}