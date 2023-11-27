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

var selectedOption = '';

$('#productSelect').on('select2:select', function (e) {
    selectedOption = e.params.data;

    var totalQuantityByCode = 0;
    $(".product").each(function (index) {
        var positionQuantity = parseInt($(this).find(".product-quantity").val(), 10);

        if (selectedOption.code === $(this).find(".product-code").val()) {
            totalQuantityByCode += positionQuantity;
        }

        $(this).find(".productIndex").text(index + 1);
    });

    selectedOption.quantity = selectedOption.quantity - totalQuantityByCode;

    $("input[name='newProductCode']").attr('value', selectedOption.code);
    $(".show-quantity").text('(Dostępne '+ selectedOption.quantity +' '+ unitsArray[selectedOption.unit] +')');
    $("input[name='newQuantity']").attr('max', selectedOption.quantity);
    $(".show-price").text('(Ustalono '+ selectedOption.price +' '+ ' PLN' +')');
    $("input[name='newPrice']").attr('max', selectedOption.price);
    $("input[name='newUnit']").val(selectedOption.unit);
});

$('input[name=\'newQuantity\']').on('input', function() {
    var inputValue = parseInt($(this).val(), 10);
    var maxValue = selectedOption.quantity;

    if (inputValue > maxValue) {
        $(this).val(maxValue);
    }
});

//zbierz kod ktory jest wybierany, przelicz ilosc i odejmij

// $("input[name='newPrice']").on('input', function() {
//     var inputValue = parseInt($(this).val(), 10);
//     var maxValue = selectedOption.price;
//
//     if (inputValue > maxValue) {
//         $(this).val(maxValue);
//     }
// });
