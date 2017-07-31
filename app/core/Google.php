<?php
/**
 * Created by PhpStorm.
 * User: Belix
 * Date: 28.07.2017
 * Time: 19:27
 */

namespace app\core;


class Google
{
    const client_id = '206528177515-aagj9ds01moummud3sghotlg3apaqf7m.apps.googleusercontent.com';
    const secret = 'kGIOxQHRakJV6EU2E8Yxy_Av';
    const redirect = 'http://light.it/login';
    const scope = 'https://www.googleapis.com/auth/userinfo.profile';




    public static function getCode()
    {
        $url = "https://accounts.google.com/o/oauth2/auth?" .
            "response_type=code" .
            "&scope=" . self::scope .
            "&client_id=" . self::client_id .
            "&redirect_uri=" . self::redirect;

        header("Location: $url");
    }


    public static function getToken($code)
    {
        $url = "https://accounts.google.com/o/oauth2/token";
        $params = [
            'code' => $code,
            'client_id' => self::client_id,
            'client_secret' => self::secret,
            'redirect_uri' => self::redirect,
            'grant_type' => 'authorization_code'
        ];

        $response = file_get_contents($url, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($params),
            ]
        ]));

        $response = json_decode($response);

        return $response->access_token;
    }


     public static function getUserInfo($token)
    {
        $info = file_get_contents("https://www.googleapis.com/oauth2/v1/userinfo?access_token=$token");
        $info = json_decode($info);
        $_SESSION['user']['id'] = $info->id;
        $_SESSION['user']['auth'] = true;

        return [
            'id' => $info->id,
            'name' => $info->name,
            'avatar' => $info->picture
        ];

    }
}