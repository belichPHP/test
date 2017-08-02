<div class="form-wrapper">
    <form id = "message" method="POST" onsubmit="send('#message')">
        <textarea name="text" placeholder='Your message'></textarea>
        <button class="submit">Submit</button>
    </form>
</div>
<?php generateTree($messages)?>
