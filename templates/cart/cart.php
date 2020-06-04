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
            <?php if(!empty($cartList)): ?>
            <ul class="cart-goods">
              <?php foreach($cartList as $product): ?>
              <li class="cart-item">
                  <div class="cart-item__buttons">
                      <button id='<?= $product->getId()  ?>' class="btn-remove cc"><img class="icon-20" src="/img/icons/icon-remove.svg" alt="удалить"/></button>
                      <!-- <button class="btn-like cc"><img class="icon-20" src="/img/icons/icon-like.svg" alt="Добавить в избранное"/></button> -->
                  </div>
                  <a href="/products/<?= $product->getId()  ?>"><img class="cart-item__image" src="<?= $product->getMainImg()  ?>" alt="изображение товара"/></a>
                  <div>
                  <div class="cart-item__description">
                      <a class="cart-item__title" href="/products/<?= $product->getId()  ?>"><?= $product->getName()  ?></a>
                      <!-- <p class="cart-item__property-text">Lorem, ipsum.</p> -->
                  </div>
                  <select name="product-size" id="#">
                      <option value="<?= $product->getMainProperty() ?>"><?= $product->getMainProperty() ?></option>
                      <?php foreach($product->getProperties() as $property): ?>
                      <option value="<?= $property->getValue() ?>"><?= $property->getValue() ?></option> 
                      <?php endforeach; ?> 
                  </select>
                  </div>
                  <div class="cart-item__control-quentity">
                      <button class="btn-plus cc"><img class="icon-20" src="/img/icons/icon-plus.svg" alt="Прибавить"/></button>
                      <input class="cart-item__input-quentity" type="text" value="1"/>
                      <button class="btn-minus cc"><img class="icon-20" src="/img/icons/icon-minus.svg" alt="уменьшить"/></button>
                  </div>
                  <div class="cart-item__total-price">$<?= $product->getPrice() ?></div>
              </li>  
              <?php endforeach; ?>
            </ul>
            <?php else: ?>
            <div>Ваша корзина пуста!</div>
            <?php endif; ?>
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

    <!-- <script type='text/javascript'>alert(5)</script> -->

    <?php include __DIR__ . '/../footer.php' ?>