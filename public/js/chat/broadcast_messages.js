$("form").submit(function (event) {
    event.preventDefault();

    $.ajax({
        url: "/chat/broadcast",
        method: 'POST',
        headers: {
            'X-Socket-Id': pusher.connection.socket_id
        },
        data: {
            _token: csrfToken,
            message: $("form #message").val(),
        }
    }).done(function (res) {
        $(".messages > .message").last().after(res);
        $("form #message").val('');
        $(".chat").scrollTop($(".chat")[0].scrollHeight);
    });
});
