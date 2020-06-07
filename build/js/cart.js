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
        deleteFromOrder(target);
        return;
        // console.log(0);
    }

    // код для кнопок +-
    ///////////////////////////////////////////
    // target = event.target.closest('.btn-plus');

    // if (target) {
    //     let count = target.nextElementSibling;
    //     let num = +count.getAttribute('value') + 1;
    //     count.setAttribute('value', num);
    //     console.log(count);
    // }

    // target = event.target.closest('.btn-minus');

    // if (target) {
    //     let count = target.previousElementSibling;
    //     let num = +count.getAttribute('value') - 1;
    //     if (num != 0) count.setAttribute('value', num);
    //     console.log(count);
    // }
    ////////////////////////////////////////////
})

cartGoods.addEventListener('change', function(event) {
    // console.log(event.target.value)
    let target = event.target;
    target = target.closest('.product-size');
    // console.log(target);
    if (target) {
        let size = target.value;
        let item = target.closest('.cart-item');
        // console.log('size')
        let orderItemId = item.dataset.orderItemId;

        const bodyObject = {
            id: orderItemId,
            size: size
        }

        sendRequest('/users/cart', bodyObject)
        return;
    }

    target = event.target.closest('.cart-item__input-quentity');
    // console.log(target);

    if (target) {
        let count = target.value;
        // console.log('count')
        if (count <= 0) count = 1;
        target.setAttribute('value', count)
        // console.log(count);
        let item = target.closest('.cart-item');
        // console.log(item)
        let orderItemId = item.dataset.orderItemId;
        // console.log(orderItemId);
        const bodyObject = {
            id: orderItemId,
            count: count
        }

        sendRequest('/users/cart', bodyObject)
        return;
    }
})

function deleteFromOrder(target) {
    let item = target.closest('.cart-item');
    // let sizeItem = item.querySelector('.product-size');
    // console.log(sizeItem.value);

    let orderItemId = item.dataset.orderItemId;

    const bodyObject = {
        id: orderItemId,
        // size: sizeItem.value
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