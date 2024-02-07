var currentPage = 1;

function chooseTemplate(user, author) {
    if (user === author)
        return $('<iframe />', {
            src: broadcastTemplateLink,
            hidden: true,
        }).appendTo('body');
    else
        return $('<iframe />', {
            src: receiveTemplateLink,
            hidden: true,
        }).appendTo('body');
}

function loadMessages() {
    $.ajax({
        url: ajaxLoadMessagesLink,
        method: 'GET',
        data: {
            page: currentPage
        },
        success: function (response) {
            messagesData = response.messages;

            if (response.messages.length > 0) {
                currentPage++;
            } else {
                return;
            }

            messagesData.forEach(function (messageContent) {
                var $iframe = chooseTemplate(sessionId, messageContent.user_id);
                var user = messageContent.user;
                messageContent.name = user.name+' '+user.surname;
                messageContent.avatar = user.avatar ? 'storage/'+ user.avatar : unknownAvatarLink;

                $iframe.on('load', function () {
                    var iframeDoc = $iframe[0].contentDocument;
                    var messageTemplate = $(iframeDoc).find('#message-template').html();
                    var formattedMessages = '';

                    let messageHTML = messageTemplate;
                    messageHTML = replaceAll(messageHTML, messageContent);
                    formattedMessages += messageHTML;

                    $('.chat').prepend(formattedMessages);
                    scrollToBottom();
                    $iframe.remove();
                });
            });
        }
    });
}

$('.chat').scroll(function() {
    if ($('.chat').scrollTop() === 0) {
        loadMessages();
    }
});
loadMessages();
