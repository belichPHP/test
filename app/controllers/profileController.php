<?php

use \app\core\Controller;
use \app\core\Google;
use app\models\user;

class profileController extends Controller
{
    public function actionShow($params)
    {
        $user = new user();
        $user->get($params[0]);
        if(!empty($user->name)) {
            $this->render('profileShow', ['user' => $user]);
        } else {
            $this->render('404');
        }
    }

    public function actionLogin()
    {
        //если пользователь вошел то перенаправляем на его страницу
        if($_SESSION['user']['auth'] === true) {
            header("location: /id".$_SESSION['user']['id']);
        } else {

            if(!isset($_GET['code'])) {
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

    public  function actionLogout()
    {
        if($_SESSION['user']['auth'] == true)
        {
            unset($_SESSION['user']);

            header('location: /');
        }
    }

}