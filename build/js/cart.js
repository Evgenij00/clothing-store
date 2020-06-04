

let cartGoods = document.querySelector('.cart-goods');

// console.log(cartGoods);

cartGoods.addEventListener('click', function(event) {
    //получаем объект по которому кликнули
    let target = event.target;
    //если дочерний элемент, находим нужный
    target = target.closest('.btn-remove');
    if (!target) {
        return;
    }
    // console.log(target);

    let response = await fetch('/users/cart.php', [options]);

    if (response.ok) {
        //...
    } else {
        //ошибка alert("Ошибка HTTP: " + response.status);
    }
})