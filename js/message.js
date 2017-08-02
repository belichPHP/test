var lastMessage;
var page = 1;

function FormText(message) {
    return"<form id=comment method=POST onsubmit=send('#comment')>"
        + "<textarea name='text' placeholder='Your message'></textarea>"
        + "<input type='hidden' name='parent_id' value=" + message.attr('id') + ">"
        + "<button>Submit</button></form>";
}


function send(type) {
    var data = $(type).serialize();

    $.ajax({
        type:"POST",
        url:"message/create",
        data: data,
        error: function (request, status, error) {
            alert(error);
        }
    })
}
$(document).ready(function () {


    var win = $(window);
    win.scroll(function () {
        // End of the document reached?
        if ($(document).height() - win.height() == win.scrollTop()) {

            $.ajax({
                type: 'POST',
                url: 'getPage',
                data: {'page': page},
                dataType: 'html',
                success: function (html) {
                    $('.content').append(html);
                    page++;
                }
            });
        }
    });


    $(".reply").each(function () {
       $(this).click(function () {
            if (lastMessage != undefined) {
                lastMessage.children('.reply-form').empty();
                lastMessage.children('.reply').show();
            }
            var message = $(this).parent();
            message.children('.reply').hide();
            message.children('.reply-form').append(FormText(message));
            lastMessage = message;
        });
    });
});
