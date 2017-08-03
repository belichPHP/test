var lastMessage;
var page = 1;

function FormText(message) {
    return "<form id=comment method=POST onsubmit=send('#comment')>"
        + "<textarea name='text' placeholder='Your message'></textarea>"
        + "<input type='hidden' name='parent_id' value=" + message.attr('id') + ">"
        + "<button>Submit</button></form>";
}

function edit() {

    $.ajax({
        type: "POST",
        url: "message/edit",
        data: $('#edit-form').serialize()
    })

}

function send(type) {
    var data = $(type).serialize();

    $.ajax({
        type: "POST",
        url: "message/create",
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

    $('.content').on('click', '.hider', function () {
        $(this).parent().children('.childs').toggle();
        if ($(this).html() == '-') {
            $(this).html('+');
        } else {
            $(this).html('-');
        }
    });

    $('.content').on('click', '.reply', function () {
        var msg = $(this).parent();
        if (lastMessage != undefined) {
            lastMessage.children('.reply-form').empty();
            lastMessage.children('.reply').show();
        }
        msg.children('.reply').hide();
        msg.children('.reply-form').append(FormText(msg));
        lastMessage = msg;
    });

    $('.content').on('click', '#edit', function () {
        var msg = $(this).parent().parent().parent();
        var text = msg.children('.msg-content').html();

        msg.children('.msg-content').replaceWith("<form id='edit-form' method='POST' onsubmit=edit()>" +
            "<textarea name='text'>" + text + "</textarea>" +
            "<input type='hidden' name='id' value=" + msg.attr('id') + ">" +
            "<button>Submit</button>" +
            "</form>");
    });

});
