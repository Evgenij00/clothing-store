<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/css/main.css"/>
    <title>Корзина</title>
  </head>
  <body>

<?php include __DIR__ . '/../header.php' ?>

<main class="main">
      <div class="main-content container">
        <div class="shopping-cart">
          <div class="shopping-cart__head">
            <h2>Моя корзина</h2>
            <p>Товары будут зарезервированы на 60 минут</p>
          </div>
          <ul class="cart-goods">
            <li class="cart-item">
              <div class="cart-item__buttons">
                <button class="btn-remove cc"><img class="icon-20" src="/img/icons/icon-remove.svg" alt="удалить"/></button>
                <button class="btn-like cc"><img class="icon-20" src="/img/icons/icon-like.svg" alt="Добавить в избранное"/></button>
              </div><a href="/pages/product-info.html"><img class="cart-item__image" src="/img/goods/14247601-1-sesame.jpg" alt="изображение товара"/></a>
              <div class="cart-item__description"><a class="cart-item__title" href="/pages/product-info.html">Lorem ipsum dolor sitmet.</a>
                <p class="cart-item__property-text">Lorem, ipsum.</p>
              </div>
              <div class="cart-item__control-quentity">
                <button class="btn-plus cc"><img class="icon-20" src="/img/icons/icon-plus.svg" alt="Прибавить"/></button>
                <input class="cart-item__input-quentity" type="text" value="1"/>
                <button class="btn-minus cc"><img class="icon-20" src="/img/icons/icon-minus.svg" alt="уменьшить"/></button>
              </div>
              <div class="cart-item__total-price">$549</div>
            </li>
          </ul>
          <div class="total-price__head">Всего 550,00 руб</div>
        </div>
        <div class="total-container">
          <h2 class="total__head">Итого</h2>
          <div class="total__price-full"></div><span>Всего</span><span>550,00 руб</span>
          <form action="#" method="post"></form>
          <label for="delivery-pay">Доставка</label>
          <select class="total__select-delivery" id="delivery-pay" name="name">
            <option value="value">Стандартная доставка</option>
            <option value="value">Стандартная доставка - Пункт самовызова</option>
            <option value="value">Экспресс - доставка</option>
            <option value="value">Экспресс - доставка курьером Пункт выдачи товаров</option>
          </select><a class="btn-2 btn-pay-order cc" href="/pages/checkout.html">Оплатить</a>
        </div>
      </div>
    </main>

<?php include __DIR__ . '/../footer.php' ?>