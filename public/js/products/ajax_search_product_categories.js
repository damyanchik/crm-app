$('#prodCatSelect').select2({
    language: {
        inputTooShort: function(args) {
            return "Wprowadź minimum 2 znaki.";
        }
    },
    ajax: {
        url: ajaxSearchProductCategoriesLink,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                searchTerm: params.term
            };
        },
        processResults: function (data) {
            var options = data.productCategories.map(function (productCategory) {
                return '<option value="' + productCategory.id + '">' + productCategory.name + '</option>';
            });

            $('#prodCatSelect').html(options.join(''));

            return {
                results: data.productCategories.map(function (productCategory) {
                    return {
                        id: productCategory.id,
                        text: productCategory.name
                    };
                })
            };
        },
        cache: true
    },
    minimumInputLength: 2,
    placeholder: 'Wybierz kategorię',
    allowClear: true
});
