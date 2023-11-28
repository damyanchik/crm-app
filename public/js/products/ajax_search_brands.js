$('#brandSelect').select2({
    language: {
        inputTooShort: function(args) {
            return "Wprowadź minimum 2 znaki.";
        }
    },
    ajax: {
        url: ajaxSearchBrandLink,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                searchTerm: params.term
            };
        },
        processResults: function (data) {
            var options = data.brands.map(function (brand) {
                return '<option value="' + brand.id + '">' + brand.name + '</option>';
            });

            $('#brandSelect').html(options.join(''));

            return {
                results: data.brands.map(function (brand) {
                    return {
                        id: brand.id,
                        text: brand.name
                    };
                })
            };
        },
        cache: true
    },
    minimumInputLength: 2,
    placeholder: 'Wybierz markę',
    allowClear: true
});
