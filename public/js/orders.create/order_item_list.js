let productCount = $('tr.product').length > 0 ? $('tr.product').length : 1;

updateProductNumbers();

$("#createOrder").prop("disabled", true);
$("#addProduct").prop("disabled", true);

$("input[name='newQuantity'], input[name='newPrice'], select[name='newProduct']").change(function() {
    var isEmpty = $("input[name='newQuantity']").val() === "" ||
        $("input[name='newPrice']").val() === "" ||
        $("select[name='newProduct']").val() === "" ||
        $("input[name='newQuantity']").val() < 1;
    $("#addProduct").prop("disabled", isEmpty);
});

$("#addProduct").click(addProduct);

$(document).on("click", ".remove-product", function () {
    $(this).closest(".product").remove();
    $(".btn-success").prop("disabled", true);

    updateProductNumbers();
});

$(document).on('change', '#clientSelect, [name="status"]', function() {
    var isClientSelectChanged = $('#clientSelect').data('originalValue') !== $('#clientSelect').val();
    var isStatusChanged = $('[name="status"]').data('originalValue') !== $('[name="status"]').val();

    if (isClientSelectChanged && isStatusChanged) {
        $("#createOrder").prop("disabled", false);
    } else {
        $("#createOrder").prop("disabled", true);
    }
});

$("select, input").on("change", function() {
    $(".btn-success").prop("disabled", true);
});

if ($('#clientSelect').val() && $('[name="status"]').val())
    $("#createOrder").prop("disabled", false);

function addProduct() {
    const newProduct = $("select[name='newProduct']").find(":selected").text();
    const newProductCode = $("input[name='newProductCode']").val();
    const newUnit = $("input[name='newUnit']").val();
    const newQuantity = $("input[name='newQuantity']").val();
    const newPrice = $("input[name='newPrice']").val();
    const newTotalPrice = newQuantity * newPrice;

    productCount = $('tr.product').length;

    const productDiv = `
        <tr class="product">
            <th scope="row" class="productIndex">${productCount}</th>
            <td>${newProduct}</td>
            <input name="products[${productCount}][name]" value="${newProduct}" type="hidden">
            <input name="products[${productCount}][code]" class="product-code" value="${newProductCode}" type="hidden">
            <td>${newProductCode}</td>
            <td>${newQuantity} ${unitsArray[newUnit]}</td>
            <input name="products[${productCount}][quantity]" class="product-quantity" value="${newQuantity}" type="hidden">
            <input name="products[${productCount}][unit]" value="${newUnit}" type="hidden">
            <td>${newPrice} PLN / ${unitsArray[newUnit]}</td>
            <td>${newTotalPrice} PLN</td>
            <input name="products[${productCount}][price]" class="product-price" value="${newPrice}" type="hidden">
            <input name="products[${productCount}][product_price]" value="${newTotalPrice}" type="hidden">
            <td><button type="button" class="btn btn-danger remove-product">X</button></td>
        </tr>`;

    $("input[name='newProductCode']").attr('value', '');
    $("select[name='newProduct']").val('');
    $("select[name='newProduct']").trigger('change');
    $("input[name='newProductCode']").val('');
    $("input[name='newUnit']").val('');
    $("input[name='newQuantity']").val('');
    $("input[name='newPrice']").val('');
    $(".show-quantity").text('');
    $(".show-price").text('');

    $("#productList").append(productDiv);
    updateProductNumbers();
}

function updateProductNumbers() {
    let totalQuantity = 0;
    let totalPrice = 0;

    $(".product").each(function (index) {
        const quantity = parseInt($(this).find(".product-quantity").val(), 10);
        const price = parseFloat($(this).find(".product-price").val());

        totalQuantity += quantity;
        totalPrice += price * quantity;

        $(this).find('input[name^="products"]').each(function(subIndex) {
            var newName = $(this).attr('name').replace(/\[\d+\]/, '[' + (index + 1) + ']');
            $(this).attr('name', newName);
        });

        $(this).find(".productIndex").text(index + 1);
    });

    $("#totalQuantity").val(totalQuantity);
    $("#totalPrice").val(totalPrice.toFixed(2));
}
