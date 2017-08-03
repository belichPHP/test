<?php

use \app\core\Controller;
use app\models\message;

class messageController extends Controller
{

    public function actionCreate()
    {
        if (User::isAuth()) {
            if (!empty($_POST['text'])) {
                if (isset($_POST['parent_id'])) {
                    message::create($_POST['text'], $_POST['parent_id']);
                } else {
                    message::create($_POST['text']);
                }
            } else {
                header("HTTP/1.1 406 Missing Text");
            }
        }else {
            header("HTTP/1.1 401 Unauthorized");
        }
    }

    public function actionEdit()
    {
            message::edit($_POST['text'], $_POST['id']);

    }
}