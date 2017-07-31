<?php

function generateTree($messages)
{
    foreach ($messages as $message) {
        include 'app/views/templates/messageTemplate.php';
        if(isset($message['childs'])) {
            generateTree($message);
        }
    }
}