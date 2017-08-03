<?php


class User
{
    //Проверка на авторизацию
    public static function isAuth()
    {
        if(isset($_SESSION['user'])) {
            if($_SESSION['user']['auth'] == true) {
                return true;
            }
        } else {
            return false;
        }
    }
}