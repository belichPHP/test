<?php

use \app\core\Controller;

class profileController extends Controller
{
    public function actionShow($params)
    {
        $this->render('profileShow',['id' => $params[0]]);
    }

    public function actionLogin()
    {
        $this->render('login');
    }
}