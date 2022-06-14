require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function () {

    var BASE_URL = window.location.origin;

    $('.cart_quantity').on('input', function (e) {
        e.preventDefault();
        var price = $(this).attr("data-price");
        var product_id = $(this).attr("data-product_id");
        var quantity = $(this).val();
        console.log(price,product_id,quantity);

        $.ajax({
            url: BASE_URL + "/cart/updateCart",
            method: 'POST',
            data: { price: price, quantity: quantity, product_id: product_id },
            dataType: 'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                var total = quantity*price;
                $('.amount-' + product_id).html(parseFloat(total).toFixed(2));
                $('.total-amount').html(data.total_amount);
                $('.total-quantity').html('Total Cart Item(s): ' + data.total_quantity);
            },
            error: function (response) {
            }
        });

    });

    $('.remove').on('click', function (e) {
        e.preventDefault();
        var product_id = $(this).attr("data-product_id");
        console.log(product_id);
        $.ajax({
            url: BASE_URL + "/cart/removeProduct",
            method: 'POST',
            data: { product_id: product_id },
            dataType: 'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
               
                location.reload();
            },
            error: function (response) {
            }
        });

    });
 
});
