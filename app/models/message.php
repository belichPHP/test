<?php

namespace app\models;

use app\core\Model;


class message extends Model
{
    const pager = 10;


    public static function create($text, $parent_id = 0)
    {
        self::connect();

        $sql = "INSERT INTO message (parent_id, author, comment, created_at) VALUES (:parent_id, :author, :comment, :created_at)";

        self::$pdo->prepare($sql)->execute([
            ':parent_id' => $parent_id,
            ':author' => $_SESSION['user']['id'],
            ':comment' => $text,
            ':created_at' => date('Y.m.d H:i:s')
        ]);
    }


    public static function get($parent_id, $page)
    {
        self::connect();

        $sql = "SELECT message.id, message.parent_id, message.comment, message.created_at, user.name as author, user.avatar"
            . " FROM message, user WHERE message.parent_id = $parent_id "
            . " AND user.id = message.author"
            . " ORDER BY created_at DESC "
            . " LIMIT " . self::pager
            . " OFFSET " . self::pager * ($page - 1);

        $comments = self::$pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($comments as $key =>&$comment) {
            $item = self::getMessagesTree($comment['id']);
            if (!empty($item)) {
                $comment['childs'] = $item;
            }
        }

        unset($comment);
        return $comments;
    }


    public static function getMessagesTree($parent_id)
    {
        self::connect();
        $sql = "SELECT message.id, message.parent_id, message.comment, message.created_at, user.name as author, user.avatar "
        . " FROM message, user WHERE parent_id = $parent_id"
        . " AND user.id = message.author"
        . " ORDER BY created_at DESC";

        $_comments = self::$pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($_comments as $key => &$_comment) {
            $item = self::getMessagesTree($_comment['id']);
            if (!empty($item)) {
                $_comment['childs'] = $item;
            }
        }
        unset($_comment);
        return $_comments;
    }

}