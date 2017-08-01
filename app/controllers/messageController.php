<?php

use \app\core\Controller;
use app\models\message;

class messageController extends  Controller
{

    public function actionCreate()
    {
        if($_SESSION['user']['auth'] == true) {
            if(isset($_POST['parent_id'])) {
                message::create($_POST['text'],$_POST['parent_id']);
            } else {
                message::create($_POST['text']);
            }

            header('location: /');        }
    }

    public function actionEdit()
    {

    }
}