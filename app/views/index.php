<div class="form-wrapper">
    <form action="/message/create" method="POST">
        <textarea name="text" placeholder='Your message'></textarea>
        <button>Submit</button>
    </form>
</div>
<?php generateTree($messages)?>
