<?php

namespace app\models;

use app\core\Model;


class user extends Model
{
    public $id;
    public $name;
    public $avatar;


    /**
     * get user by id
     *
     * @param $id
     */
    public static function get($id)
    {
        self::connect();

        $sql = "SELECT * FROM user WHERE id = $id";
        $item = self::$pdo->query($sql)->fetchAll(\PDO::FETCH_CLASS, self::class);
        return $item[0];
    }


    /**
     * Save record to database
     *
     */
    public function save()
    {
        self::connect();

        //проверяем запись в бд
        $sql = "SELECT id FROM user WHERE id = $this->id";
        //если она есть то обновляем
        $check = self::$pdo->query($sql)->fetch();
        if ($check) {
            $sql = "UPDATE user SET name = :name, avatar = :avatar WHERE id = :id";
            $update = self::$pdo->prepare($sql);
            $update->execute([
                ':name' => $this->name,
                ':avatar' => $this->avatar,
                ':id' => $this->id,
            ]);
        } else {
            //если нету добавляем новую
            $sql = "INSERT INTO user (id, name, avatar) VALUES (:id, :name, :avatar)";
            $item = self::$pdo->prepare($sql);
            $item->execute([
                ':id' => $this->id,
                ':name' => $this->name,
                ':avatar' => $this->avatar
            ]);
        }
    }


}