<?php

use \app\core\Controller;
use app\core\Google;
use app\models\user;
use app\models\message;

class mainController extends Controller
{

    public function actionIndex()
    {
        $messages = message::get(0,0);
        $this->render('index',['messages' => $messages]);
    }


    public function getPage()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $message = message::get(0,$_POST['page']);
            generateTree($message);
        }
    }


    public function actionLogin()
    {
        //если пользователь вошел то перенаправляем на его страницу
        if ($_SESSION['user']['auth'] == true) {
            header("location: /");
        } else {

            if (!isset($_GET['code'])) {
                Google::getCode();
            } else {
                $token = Google::getToken($_GET['code']);
                $userInfo = Google::getUserInfo($token);

                //При каждом входе обновляем инфу о пользователе
                $user = new user();
                $user->id = $userInfo['id'];
                $user->name = $userInfo['name'];
                $user->avatar = $userInfo['avatar'];
                $user->save();

                $_SESSION['user']['id'] = $user->id;
                $_SESSION['user']['auth'] = true;
                $_SESSION['user']['name'] = $user->name;
                //обновляем страницу
                header('Refresh:0');
            }
        }
    }


    public function actionLogout()
    {
        if ($_SESSION['user']['auth'] == true) {
            unset($_SESSION['user']);

            header('location: /');
        }
    }

}