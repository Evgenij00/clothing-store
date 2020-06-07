'use strict'

let cartGoods = document.querySelector('.cart-goods');

cartGoods.addEventListener('click', function(event) {
    //получаем объект по которому кликнули
    let target = event.target;

    //если дочерний элемент, находим нужный
    target = target.closest('.btn-remove');

    if (target) {
        deleteFromOrder(target);
        return;
    }
})

cartGoods.addEventListener('change', function(event) {
    let target = event.target;
    target = target.closest('.product-size');

    if (target) {
        let item = target.closest('.cart-item');
        let orderItemId = item.dataset.orderItemId;

        let size = target.value;

        const body = {
            id: orderItemId,
            size: size
        }

        sendRequest('/users/cart', body)
        return;
    }

    ///////////////////////////////////////////////////////////
    let target = event.target;
    target = target.closest('.cart-item__input-quentity');

    if (target) {
        let item = target.closest('.cart-item');
        let orderItemId = item.dataset.orderItemId;

        let count = target.value;

        //кол-во не может быть (-) или (0)
        if (count <= 0) count = 1;
        target.setAttribute('value', count)

        const body = {
            id: orderItemId,
            count: count
        }

        sendRequest('/users/cart', body)
        return;
    }
})










function deleteFromOrder(target) {
    //находим главный элемент который нужно удалить
    let item = target.closest('.cart-item');
    //записываем его id
    let orderItemId = item.dataset.orderItemId;

    const body = {
        id: orderItemId,
    }

    sendRequest('/users/cart', body)

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