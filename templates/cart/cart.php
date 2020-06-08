<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/css/main.css"/>
    <title>Корзина</title>
    <script defer type="text/javascript" src='/js/cart.js'></script>
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
            <?php if(!empty($orderList)): ?>
            <!-- если в корзине нет товаров консоль ругается, что m.addEventListener call on null!!! -->
            <ul class="cart-goods">
              <?php foreach($orderList as $orderItem): ?>
              <li data-order-item-id='<?= $orderItem->getId()  ?>' class="cart-item">
                  <div class="cart-item__buttons">
                      <button class="btn-remove cc"><img class="icon-20" src="/img/icons/icon-remove.svg" alt="удалить"/></button>
                      <!-- <button class="btn-like cc"><img class="icon-20" src="/img/icons/icon-like.svg" alt="Добавить в избранное"/></button> -->
                  </div>
                  <a href="/products/<?= $orderItem->getProduct()->getId() ?>"><img class="cart-item__image"  src="<?= $orderItem->getProduct()->getMainImg() ?>" alt="изображение товара"/></a>
                  <div>
                  <div class="cart-item__description">
                      <a class="cart-item__title" href="/products/<?= $orderItem->getProduct()->getId() ?>"><?= $orderItem->getProduct()->getName()  ?></a>
                      <!-- <p class="cart-item__property-text">Lorem, ipsum.</p> -->
                  </div>
                  <select class='product-size' name="product-size" id="#">
                    <option hidden value="<?= $orderItem->getGoodsProperties() ?>"><?= $orderItem->getGoodsProperties() ?></option> 
                    <?php foreach($orderItem->getProduct()->getProperties() as $property): ?>
                    <option value="<?= $property->getValue() ?>"><?= $property->getValue() ?></option> 
                    <?php endforeach; ?> 
                  </select>
                  </div>
                  <div class="cart-item__control-quentity">
                      <!-- <button class="btn-plus cc"><img class="icon-20" src="/img/icons/icon-plus.svg" alt="Прибавить"/></button> -->
                      <input class="cart-item__input-quentity" type="number" min='1' value="<?= $orderItem->getCount() ?>"/>
                      <!-- <button class="btn-minus cc"><img class="icon-20" src="/img/icons/icon-minus.svg" alt="уменьшить"/></button> -->
                  </div>
                  <div class="cart-item__total-price"><?= $orderItem->getProduct()->getPrice() ?> руб</div>
              </li>  
              <?php endforeach; ?>
            </ul>
            <?php else: ?>
            <div>Ваша корзина пуста!</div>
            <?php endif; ?>
          <!-- <div class="total-price__head">Всего 550,00 руб</div> -->
        </div>
        <div class="total-container">
          <h2 class="total__head">Итого</h2>
          <div class="total__price-full"></div><span>Всего</span><span id='order-price'><?= $orderPrice ?> руб</span>
          <!-- <form action="#" method="post"></form> -->
          <!-- <label for="delivery-pay">Доставка</label>
          <select class="total__select-delivery" id="delivery-pay" name="name">
            <option value="value">Почта России</option>
            <option value="value">Курьерская доставка</option>
            <option value="value">Самовывоз из офиса или пункта выдачи</option>
          </select> -->
          <a class="btn-2 btn-pay-order cc" href="/users/checkout">Оплатить</a>
        </div>
      </div>
    </main>

    <!-- <script type='text/javascript'>alert(5)</script> -->

    <?php include __DIR__ . '/../footer.php' ?>