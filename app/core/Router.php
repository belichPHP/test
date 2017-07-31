<?php


class Router
{
    public static function rules()
    {
        return [
            //подгрузка главной стр.
            '#^\/getPage$#' => [
                'controller' => 'mainController',
                'action' => 'getPage'
            ],
            //авторизация
            '#^\/login#' => [
                'controller' => 'mainController',
                'action' => 'actionLogin'
            ],
            //выход
            '#^\/logout$#' => [
                'controller' => 'mainController',
                'action' => 'actionLogout'
            ],
            //главная страница
            '#^\/$#' => [
                'controller' => 'mainController',
                'action' => 'actionIndex',
            ]
        ];
    }

    public static function start()
    {
        $uri = $_SERVER['REQUEST_URI'];

        foreach (self::rules() as $rule => $route) {
            //ищем совпадения в правилах
            if(preg_match($rule, $uri, $matches)) {
                $controller = $route['controller'];
                $action = $route['action'];

                //перенаправляем на контроллер и экшен
              self::redirect($controller, $action);
              //выходим из функции
              return;
            }
        }
        // если не нашли совпадения отправляем ошибку 404
        self::error404();
    }

    public static function redirect($controller, $action)
    {
        // проверяем файл.
        if(file_exists("app/controllers/$controller.php")) {
            //если нашли, то подключаем и вызываем сообветсвующий метод.
            require_once "app/controllers/$controller.php";
            $_controller = new $controller();
            $_controller->$action();
        } else {
          self::error404();
        }
    }

    public static function error404()
    {
        //TODO: HEADERS
        self::redirect('mainController', 'action404');
    }
}