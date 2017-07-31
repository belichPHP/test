<?php

namespace app\models;

use app\core\Model;


class message extends Model
{
    const pager = 10;


    public static function get($parent_id, $page)
    {
        self::connect();

        $sql = "SELECT * FROM message WHERE parent_id = $parent_id "
            . " ORDER BY created_at DESC "
            . " LIMIT " . self::pager
            . " OFFSET " . self::pager * ($page - 1);

        $comments = self::$pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($comments as &$comment) {
            $item = self::getMessagesTree($comment['id']);
            if (!empty($item)) {
                $comment['child'] = $item;
            }
        }

        unset($comment);
        return $comments;
    }


    public static function getMessagesTree($parent_id)
    {
        self::connect();
        $sql = "SELECT * FROM message WHERE parent_id = $parent_id";
        $_comments = self::$pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($_comments as &$comment) {
            $item = self::getMessagesTree($comment['id']);
            if (!empty($item)) {
                $comment['child'] = $item;
            }
        }

        unset($comment);
        return $_comments;
    }

}