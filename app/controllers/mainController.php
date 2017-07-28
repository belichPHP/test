<?php

use \app\core\Controller;

class mainController extends Controller
{

    public function actionIndex()
    {
         $this->render('index',['id' => '122']);
    }

    public function action404()
    {
        echo 'error';
    }
}