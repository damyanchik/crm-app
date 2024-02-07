$('#clientSelect').select2({
    language: {
        inputTooShort: function(args) {
            return "Wprowadź minimum 3 znaki.";
        }
    },
    ajax: {
        url: ajaxSearchClientsLink,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                searchTerm: params.term
            };
        },
        processResults: function (data) {
            var options = data.clients.map(function (client) {
                return '<option value="' + client.id + '">' + client.company + ' ' + client.name + ' ' + client.surname + '</option>';
            });

            $('#clientSelect').html(options.join(''));

            return {
                results: data.clients.map(function (client) {
                    return {
                        id: client.id,
                        text: client.company + ' ' + client.name + ' ' + client.surname
                    };
                })
            };
        },
        cache: true
    },
    minimumInputLength: 3,
    placeholder: 'Wybierz klienta',
    allowClear: true
});
