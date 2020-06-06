'use strict'

let cartGoods = document.querySelector('.cart-goods');
// console.log(cartGoods);

cartGoods.addEventListener('click', function(event) {
    //получаем объект по которому кликнули
    let target = event.target;
    // console.log(target);

    //если дочерний элемент, находим нужный
    target = target.closest('.btn-remove');

    if (target) {
        // deleteFromOrder(target);
        // return;
    }
})

cartGoods.addEventListener('change', function(event) {
    // console.log(event.target.value)
    let size = event.target.value;
})

function deleteFromOrder(target) {
    let item = target.closest('.cart-item');
    let sizeItem = item.querySelector('.product-size');
    // console.log(sizeItem.value);

    let orderItemId = target.dataset.id;

    const bodyObject = {
        id: orderItemId,
        size: sizeItem.value
    }

    sendRequest('/users/cart', bodyObject)

    item.classList.add('hidden');
}



function sendRequest(url = '', data = {}) {
    return fetch(url, {
        method: 'POST',
        headers: {
        'Content-Type': 'applicaton/www-form-urlencoded'
        },
        body: JSON.stringify(data)
    })
}