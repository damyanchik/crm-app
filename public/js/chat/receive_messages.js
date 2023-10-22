channel.bind('chat', function (data) {
    $.post("/chat/receive", {
        _token: csrfToken,
        message: data.message,
        name: data.name,
        time: data.time
    })
        .done(function (res) {
            $(".messages > .message").last().after(res);
            $(".chat").scrollTop($(".chat")[0].scrollHeight);
        });
});
