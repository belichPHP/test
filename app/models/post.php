<?php
/**
 * Created by PhpStorm.
 * User: Belix
 * Date: 30.07.2017
 * Time: 15:10
 */

namespace app\models;


use app\core\Model;

class post extends Model
{
    public $id;
    public $title;
    public $text;
    public $owner_id;
    public $rating;
    public $created_at;

    /**
     * Create new record by title and text
     *
     * @param $title
     * @param $text
     * @return string
     */
    public function create($title, $text)
    {
        if($_SESSION['user']['auth'] == true) {
            $sql = "INSERT INTO post (title, text, owner_id, created_at)" .
                "VALUES( :title, :text, :owner_id, :created_at)";

            $this->pdo->prepare($sql)->execute([
                ':title' => $title,
                ':text' => $text,
                ':owner_id' => $_SESSION['user']['id'],
                ':created_at' => date('Y/m/d H:i:s')
            ]);

        } else {
            return 'LOGIN PLS';
        }
    }

    /**
     * fetch record from db by id
     *
     * @param $id
     */
    public function get($id)
    {
        $sql = "SELECT * FROM post WHERE id = $id";
        $post = $this->pdo->query($sql)->fetch();

        $this->id = $post['id'];
        $this->title = $post['title'];
        $this->text = $post['text'];
        $this->owner_id = $post['owner_id'];
        $this->rating = $post['rating'];
        $this->created_at = $post['created_at'];

    }

    /**
     * update this record in db
     * after use need fetch record by get()
     */
    public function save()
    {
        $sql = "UPDATE post SET title = :title, text = :text WHERE id = :id";
        $this->pdo->prepare($sql)->execute([
            ':title' => $this->title,
            ':text' => $this->text,
            ':id' => $this->id,
        ]);

    }
}