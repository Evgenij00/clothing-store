// alert(5);

'use strict'

let addressBtn = document.querySelector('.adress__btn');

addressBtn.addEventListener('click', function(event) {
    //получаем объект по которому кликнули
    let target = event.target;

    let item = target.closest('.adress-conrainer');
    let addressId = document.querySelector('#address-id');
    // console.log(addressId)

    if (addressId !== null) {
        item.classList.add('hidden');
        return;
    }

    // let id = item.querySelector('#address-id').value;
    let country = item.querySelector('#country').value;
    let city = item.querySelector('#city').value
    let region = item.querySelector('#region').value
    let streetAddress = item.querySelector('#street-address').value;
    let postcode = item.querySelector('#post-code').value

    const body = {
        // id: id,
        country: country,
        city: city,
        region: region,
        streetAddress: streetAddress,
        postcode: postcode,
    }

    sendRequest('/users/checkout', body);

    item.classList.add('hidden');
    
})

// cartGoods.addEventListener('change', function(event) {
//     let target = event.target;
//     target = target.closest('.product-size');

//     if (target) {
//         let item = target.closest('.cart-item');
//         let orderItemId = item.dataset.orderItemId;

//         let size = target.value;

//         const body = {
//             id: orderItemId,
//             size: size
//         }

//         sendRequest('/users/cart', body)
//         return;
//     }

//     ///////////////////////////////////////////////////////////
//     target = event.target.closest('.cart-item__input-quentity');

//     if (target) {
//         let item = target.closest('.cart-item');
//         let orderItemId = item.dataset.orderItemId;

//         let count = target.value;

//         //кол-во не может быть (-) или (0)
//         if (count <= 0) count = 1;
//         target.setAttribute('value', count)

//         const body = {
//             id: orderItemId,
//             count: count
//         }

//         sendRequest('/users/cart', body)
//             .then(data => {
//                 let orderPrice = document.querySelector('#order-price');
//                 // console.log(orderPrice);
//                 let text = data + ' руб';
//                 console.log(text);
//                 orderPrice.textContent = text;
//             })
            
//     }
// })










function deleteFromOrder(target) {
    //находим главный элемент который нужно удалить
    let item = target.closest('.cart-item');
    //записываем его id
    let orderItemId = item.dataset.orderItemId;

    const body = {
        id: orderItemId,
    }

    sendRequest('/users/cart', body)
        .then(data => console.log(data));

    item.remove();
}

function sendRequest(url = '', data = {}) {
    return fetch(url, {
        method: 'POST',
        headers: {
        'Content-Type': 'applicaton/json'
        },
        body: JSON.stringify(data)
    }).then(response => {
        return response.text()
    })
}