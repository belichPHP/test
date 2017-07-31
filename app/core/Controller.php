<?php

namespace app\core;


class Controller
{

    function render($view, $params = [], $template = 'mainTemplate')
    {
        if (is_array($params)) {
           //переобразуем елементы массива в переменные
            extract($params);
        }

        if (file_exists("app/views/templates/$template.php")) {
            include "app/views/templates/$template.php";
        }
    }

}