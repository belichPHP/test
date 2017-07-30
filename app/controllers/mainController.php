<?php

use \app\core\Controller;
use app\models\post;

class mainController extends Controller
{

    public function actionIndex()
    {
       $post = new post();
       $post->create('last','test');
    }

    public function action404()
    {
        $this->render('404');
    }
}