<?php

function generateTree($messages)
{
    foreach ($messages as $message) {
        echo "<div class='msg-container' id={$message['id']}>"
            . "<div class='msg-container-info'>"
            . "<div class='thumbnail'>"
            . "<img src='{$message['avatar']}' alt='avatar'>"
            . "</div>"
            . "<div class='userdata'>"
            . "<span class='username'>{$message['author']} </span>"
            . "<span class='data'>{$message['created_at']} </span>"
            . "</div>";
            if ($message['author_id'] === $_SESSION['user']['id']){
              echo "<div class='dashboard'>"
                  . "<i id='edit' class='fa fa-pencil'></i>"
                  . "</div>";
            }
            echo "</div>"
            . "<p class='msg-content'>"
            . $message['comment']
            . "</p>"
            . "<div class='reply-form'></div>";

        if (isset($message['childs'])) {
            echo "<button class='hider'>-</button>";
        }

        echo "<button class='reply'>Reply</button>";

        if (isset($message['childs'])) {
            echo "<div class='childs'>";
            generateTree($message['childs']);
            echo "</div>";
        }
        echo "</div>";

    }

}