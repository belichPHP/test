<div class="msg-container">
    <span class="username"><?=$message['author']?></span>
    <span class="data"><?=$message['created_at']?></span>
    <p class="msg-content">
        <?=$message['comment']?>
    </p>
    <button class="reply">Reply</button>
</div>