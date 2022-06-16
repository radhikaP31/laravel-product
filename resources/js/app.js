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

                if(data.success) {
                    
                    var total = quantity*price;
                    $('.amount-' + product_id).html(parseFloat(total).toFixed(2));
                    $('.total-amount').html(data.total_amount);
                    $('.total-quantity').html('Total Cart Item(s): ' + data.total_quantity);
                    
                } else {

                    $('.qty-error-' + product_id).html('<span style="color:red;">Only ' + response.quantity + ' items left!!</span>');
                }
            },
            error: function (response) {
            }
        });

    });

    $('.remove').on('click', function (e) {
        e.preventDefault();
        var product_id = $(this).attr("data-product_id");
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

    $(".qty").keyup(function () {

        var id = $(this).attr("data-product_id");
        var quantity = $(this).attr("data-qty");
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));

        $('.submit-' + id).removeAttr("disabled");
        $('.place-order').removeAttr("disabled");

        if ($(this).val() > max) {
            $('.submit-' + id).prop('disabled', true);
            $('.place-order').prop('disabled', true);

            $('.qty-error-' + id).html('<span style="color:red;">Only ' + quantity +' items left!!</span>');
            
        } else if ($(this).val() < min) {
            $('.submit-' + id).prop('disabled', true);
            $('.place-order').prop('disabled', true);
        }
    });
 
});
