<?php


class Router
{
    public static function rules()
    {
        return [
            //страница пользователя
            '#^\/id(\d+)$#' => [
                'controller' => 'profileController',
                'action' => 'actionShow',
            ],
            //авторизация
            '#^\/login#' => [
                'controller' => 'profileController',
                'action' => 'actionLogin'
            ],
            //выход
            '#^\/logout$#' => [
                'controller' => 'profileController',
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
                $params = array_slice($matches,1);

                //перенаправляем на сонтроллер и экшен
              self::redirect($controller, $action, $params);
              //выходим из функции
              return;
            }
        }
        // если не нашли совпадения отправляем ошибку 404
        self::error404();
    }

    public static function redirect($controller, $action, $params = [])
    {
        // проверяем файл.
        if(file_exists("app/controllers/$controller.php")) {
            //если нашли, то подключаем и вызываем сообветсвующий метод.
            require_once "app/controllers/$controller.php";
            $_controller = new $controller();
            $_controller->$action($params);
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