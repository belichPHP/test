<?php

use \app\core\Controller;
use app\models\message;

class messageController extends Controller
{

    public function actionCreate()
    {
        if (user::isAuth()) {
            if (!empty($_POST['text'])) {
                if (isset($_POST['parent_id'])) {
                    message::create($_POST['text'], $_POST['parent_id']);
                } else {
                    message::create($_POST['text']);
                    header('location: /');
                }
            } else {
                header("HTTP/1.1 406 Missing text");
            }
        }else {
            header("HTTP/1.1 401 Unauthorized");
        }
    }

    public function actionEdit()
    {

    }
}