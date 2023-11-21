channel.bind('chat', function (data) {
    $.post("/chat/receive", {
        _token: csrfToken,
        message: data.content.message,
        name: data.content.name,
        time: data.content.time,
        avatar: data.content.avatar
    })
        .done(function (res) {
            $(".messages > .message").last().after(res);
            $(".chat").scrollTop($(".chat")[0].scrollHeight);
        });
});
