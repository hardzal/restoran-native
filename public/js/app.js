$(function () {

    $('.buy-product').on('click', function () {
        const id = $(this).data("id");
        const link = $(this).data('link');

        $.ajax({
            url: link + '?show=api&pages=product',
            data: {
                id: id
            },
            type: 'post',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('.food-title').html(data.name);
                $('.food-img').attr('src', './public/assets/images/' + data.img_product);
                $('.food-desc').html(data.description);
                $('.food-category').html("<small class='badge badge-primary'>" + data.category_name + "</small>");
                $('.food-price').html("<small class='badge badge-success'>Rp . " + new Intl.NumberFormat(['ban', 'id']).format(data.price) + "</small>");
                $('.food-id').val(id);
                if (data.status_product) {
                    $('.food-status').html("<small class='badge badge-success'>Available</small>");
                } else {
                    $('.food-status').html("<small class='badge badge-danger'>Not Available</small>");
                }
                $('#food-num').on('change', function () {
                    let num = parseInt($('#food-num').val());
                    $('.food-price-total').val(data.price * num);
                });
            }
        });
        $('#food-num').val(0);
        $('.food-price-total').val(0);
    });
});
