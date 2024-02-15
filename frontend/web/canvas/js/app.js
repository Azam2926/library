function updateTopCard() {
    $.get('/cart/user-cart-ajax')
        .done((res) => $('#top-cart').html(res))
}