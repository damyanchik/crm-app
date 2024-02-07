$('#productSelect').select2({
    language: {
        inputTooShort: function(args) {
            return "Wprowadź minimum 3 znaki.";
        }
    },
    templateResult: function(data) {
        if (!data.id) {
            return data.text;
        }

        var modifiedText = data.text.toUpperCase();

        return $('<span>' + modifiedText + '</span>');
    },
    templateSelection: function(selection) {
        if (!selection.id) {
            return selection.text;
        }

        var modifiedSelection = selection.text.toUpperCase();

        return $('<span>' + modifiedSelection + '</span>');
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
                    var displayName = product.name.toUpperCase();
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

var selectedOption = null;

$('#productSelect').on('select2:select', function (e) {
    selectedOption = null;
    $("input[name='newProductCode']").attr('value', '');
    $(".show-quantity").text('');
    $("input[name='newQuantity']").attr('max', 0);
    $("input[name='newQuantity']").val(0);
    $(".show-price").text('');
    $("input[name='newPrice']").attr('max', '');
    $("input[name='newPrice']").val(0);
    $("input[name='newUnit']").attr('value', '');
    $("input[name='newUnit']").val(0);


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
    $("input[name='newProductCode']").val(selectedOption.code);
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

// $("input[name='newPrice']").on('input', function() {
//     var inputValue = parseInt($(this).val(), 10);
//     var maxValue = selectedOption.price;
//
//     if (inputValue > maxValue) {
//         $(this).val(maxValue);
//     }
// });
