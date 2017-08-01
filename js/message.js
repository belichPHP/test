var lastMessage;
$(document).ready(function () {
    $(".reply").click(function () {
        if (lastMessage != undefined) {
            lastMessage.children('.reply-form').empty();
            lastMessage.children('.reply').show();

        }
        var message = $(this).parent();
        message.children('.reply').hide();
        message.children('.reply-form').append(
            "<form action='/message/create' method='POST'>"
            + "<textarea name='text' placeholder='Your message'></textarea>"
            + "<input type='hidden' name='parent_id' value=" + message.attr('id') + ">"
            + "<button>Submit</button></form>");
        lastMessage = message;
    });
    $(".hider").click(function () {
        $(this).parent().children('.childs').toggle();
    });
});
