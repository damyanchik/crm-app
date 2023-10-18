$('#userSelect').select2({
    ajax: {
        url: ajaxSearchUsersLink,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                searchTerm: params.term
            };
        },
        processResults: function (data) {
            var options = data.users.map(function (user) {
                return '<option value="' + user.id + '">' + user.name + ' ' + user.surname + '</option>';
            });

            $('#userSelect').html(options.join(''));

            return {
                results: data.users.map(function (user) {
                    return {
                        id: user.id,
                        text: user.name + ' ' + user.surname
                    };
                })
            };
        },
        cache: true
    },
    minimumInputLength: 3,
    placeholder: 'Wybierz użytkownika',
    allowClear: true
});
