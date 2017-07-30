<?php
/**
 * Created by PhpStorm.
 * User: Belix
 * Date: 29.07.2017
 * Time: 17:57
 */

namespace app\models;

use app\core\Model;

class user extends Model
{
    public $id;
    public $name;
    public $avatar;


    public function get($id)
    {
        $sql = "SELECT * FROM user WHERE id = $id";
        $item = $this->pdo->query($sql)->fetch();

        $this->id = $item['id'];
        $this->name = $item['name'];
        $this->avatar = $item['avatar'];

    }

    public function save()
    {
        //проверяем запись в бд
        $sql = "SELECT id FROM user WHERE id = $this->id";
        //если она есть то обновляем
        $check = $this->pdo->query($sql)->fetch();
        if ($check) {
            $sql = "UPDATE user SET name = :name, avatar = :avatar WHERE id = :id";
            $update = $this->pdo->prepare($sql);
            $update->execute([
                ':name' => $this->name,
                ':avatar' => $this->avatar,
                ':id' => $this->id,
            ]);
        } else {
            //если нету добавляем новую
            $sql = "INSERT INTO user (id, name, avatar) VALUES (:id, :name, :avatar)";
            $item = $this->pdo->prepare($sql);
            $item->execute([
                ':id' => $this->id,
                ':name' => $this->name,
                ':avatar' => $this->avatar
            ]);

        }

    }
}