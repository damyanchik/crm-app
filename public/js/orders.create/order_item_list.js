let productCount = 1;

function updateProductNumbers() {
    let totalQuantity = 0;
    let totalPrice = 0;

    $(".product").each(function (index) {
        const quantity = parseInt($(this).find(".product-quantity").val(), 10);
        const price = parseFloat($(this).find(".product-price").val());

        totalQuantity += quantity;
        totalPrice += price * quantity;

        $(this).find(".productIndex").text(index + 1);
    });

    $("#totalQuantity").val(totalQuantity);
    $("#totalPrice").val(totalPrice.toFixed(2)); // Zaokrąglamy cenę do dwóch miejsc po przecinku
}

$("#addProduct").prop("disabled", true);
$("input[name='newQuantity'], input[name='newPrice'], select[name='newProduct']").change(function() {
    var isEmpty = $("input[name='newQuantity']").val() === "" ||
        $("input[name='newPrice']").val() === "" ||
        $("select[name='newProduct']").val() === "" ||
        $("input[name='newQuantity']").val() < 1;
    $("#addProduct").prop("disabled", isEmpty);
});

$("#addProduct").click(function () {
    const newProduct = $("select[name='newProduct']").find(":selected").text();
    const newProductCode = $("input[name='newProductCode']").val();
    const newUnit = $("input[name='newUnit']").val();
    const newQuantity = $("input[name='newQuantity']").val();
    const newPrice = $("input[name='newPrice']").val();
    const newTotalPrice = newQuantity * newPrice;

    const productDiv = `
                            <tr class="product">
                                <th scope="row" class="productIndex">${productCount}</th>
                                <td>${newProduct}</td>
                                <input name="products[${productCount}][name]" value="${newProduct}" type="hidden">
                                <input name="products[${productCount}][code]" value="${newProductCode}" type="hidden">
                                <td>${newQuantity} ${unitsArray[newUnit]}</td>
                                <input name="products[${productCount}][quantity]" class="product-quantity" value="${newQuantity}" type="hidden">
                                <input name="products[${productCount}][unit]" value="${newUnit}" type="hidden">
                                <td>${newPrice} PLN / ${unitsArray[newUnit]}</td>
                                <td>${newTotalPrice} PLN</td>
                                <input name="products[${productCount}][price]" class="product-price" value="${newPrice}" type="hidden">
                                <input name="products[${productCount}][product_price]" value="${newTotalPrice}" type="hidden">

                                <td><button type="button" class="btn btn-danger remove-product">X</button></td>
                            </tr>`;

    $("select[name='newProduct']").val('');
    $("select[name='newProduct']").trigger('change');

    $("input[name='newProductCode']").val('');
    $("input[name='newUnit']").val('');
    $("input[name='newQuantity']").val('');
    $("input[name='newPrice']").val('');

    productCount++

    $("#productList").append(productDiv);
    updateProductNumbers();
});

$(document).on("click", ".remove-product", function () {
    $(this).closest(".product").remove();

    updateProductNumbers();
});
