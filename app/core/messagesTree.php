<?php

function generateTree($messages)
{
    foreach ($messages as $message) {
        echo "<div class='msg-container' id={$message['id']}>"
            ."<div class='msg-container-info'>"
            ."<div class='thumbnail'>"
            ."<img src='{$message['avatar']}' alt='avatar'>"
            ."</div>"
            ."<div class='userdata'>"
            ."<span class='username'>{$message['author']} </span>"
            ."<span class='data'>{$message['created_at']} </span>"
            ."</div>"
            ."</div>"
            ."<p class='msg-content'>"
            .$message['comment']
            ."</p>"
            ."<div class='reply-form'></div>";
        if(isset($message['childs'])) {
            echo "<button class='hider'>-</button>";
        }
        echo "<button class='reply'>Reply</button>";
        if(isset($message['childs'])) {
            echo "<div class='childs'>";
            generateTree($message['childs']);
            echo "</div>";
        }
        echo "</div>";

    }

}