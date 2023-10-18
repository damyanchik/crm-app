$('#productSelect').select2({
    language: {
        inputTooShort: function(args) {
            return "Wprowadź minimum 3 znaki.";
        }
    },

    ajax: {
        url: ajaxSearchProductsLink,
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                searchTerm: params.term
            };
        },
        processResults: function (data) {
            var options = data.products.map(function (product) {
                var displayName = product.name;
                if (product.brand && product.brand.name) {
                    displayName += ' ' + product.brand.name;
                }
                return '<option value="">' + displayName + '</option>';
            });

            $('#productSelect').html(options.join(''));

            return {
                results: data.products.map(function (product) {
                    var displayName = product.name;
                    if (product.brand && product.brand.name) {
                        displayName += ' ' + product.brand.name;
                    }
                    return {
                        id: product.id,
                        text: displayName,
                        code: product.code,
                        quantity: product.quantity,
                        price: product.price,
                        unit: product.unit
                    };
                })
            };
        },
        cache: true
    },

    minimumInputLength: 3,
    placeholder: 'Wybierz produkt',
    allowClear: true
});

$('#productSelect').on('select2:select', function (e) {
    var selectedOption = e.params.data;

    $("input[name='newProductCode']").val(selectedOption.code);
    $(".show-quantity").text('(Dostępne '+ selectedOption.quantity +' '+ unitsArray[selectedOption.unit] +')');
    $(".show-price").text('(Ustalono '+ selectedOption.price +' '+ ' PLN' +')');
    $("input[name='newUnit']").val(selectedOption.unit);
});
