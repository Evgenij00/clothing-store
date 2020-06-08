<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/css/main.css"/>
    <title>LOGOTIP | Checkout</title>
    <script defer src='/js/checkout.js'></script>
  </head>
  <body>
    <header class="header container"><a class="logo f-c-c" href="/index.html">LOGOTIP</a>
      <h1 class="head-title cc">Оформление заказ</h1>
    </header>
    <main class="main container">
      <div class="main-content">
        <div class="check-container">
          <div class="email"></div>
          <h2>Адрес электронной почты</h2>
          <p><?= $user->getEmail() ?></p>
          <?php if ($address !== null): ?>
            <div class="adress-conrainer">
                <h2 class="adress__title">Адрес доставки</h2>
                <input class='hidden' type="text" name="address-id" id='address-id' />
                <label class="label" for="first-name">Имя:</label>
                <input id="first-name" type="text" name="first-name" value="<?= $user->getFirstName() ?>"/>
                <label class="label" for="last-name">Фамилия:</label>
                <input id="last-name" type="text" name="last-name" value="<?= $user->getLastName() ?>"/>
                <!-- <label class="label" for="middle-name">Отчество:</label>
                <input id="middle-name" type="text" name="middle-name"/> -->
                <!-- <label class="label" for="phone-contact">Мобильный телефон:</label>
                <input id="phone-contact" type="text" name="phone-contact"/> -->
                <label class="label" for="country">Страна:</label>
                <input id="country" type="text" name="country" value="<?= $address->getCountry() ?>"/>

                <label class="label" for="region">Регион:</label>
                <input id="region" type="text" name="region" value="<?= $address->getRegion() ?>"/>

                <label class="label" for="city">Город:</label>
                <input id="city" type="text" name="city" value="<?= $address->getCity() ?>"/>

                <label class="label" for="street-adress">Улица, дом, квартира</label>
                <input id="street-address" type="text" name="street-adress" value="<?= $address->getStreetAddress() ?>"/>
                <label class="label" for="post-index">Почтовый идекс</label>
                <input id="post-code" type="text" name="post-index" value="<?= $address->getPostcode() ?>"/>
                <button class="adress__btn">Доставить по этому адрессу</button>
            </div>
          <?php else: ?>  
            <div class="adress-conrainer">
                <h2 class="adress__title">Адрес доставки</h2>
                <label class="label" for="first-name">Имя:</label>
                <input id="first-name" type="text" name="first-name" value="<?= $user->getFirstName() ?>">
                <label class="label" for="last-name">Фамилия:</label>
                <input id="last-name" type="text" name="last-name"  value="<?= $user->getLastName() ?>">
                <!-- <label class="label" for="middle-name">Отчество:</label>
                <input id="middle-name" type="text" name="middle-name"/> -->
                <!-- <label class="label" for="phone-contact">Мобильный телефон:</label>
                <input id="phone-contact" type="text" name="phone-contact"/> -->
                <label class="label" for="country">Страна:</label>
                <input id="country" type="text" name="country">

                <label class="label" for="region">Регион:</label>
                <input id="region" type="text" name="region">

                <label class="label" for="city">Город:</label>
                <input id="city" type="text" name="city">

                <label class="label" for="street-adress">Улица, дом, квартира</label>
                <input id="street-address" type="text" name="street-adress">
                <label class="label" for="post-index">Почтовый идекс</label>
                <input id="post-code" type="text" name="post-index">
                <button class="adress__btn">Доставить по этому адрессу</button>
            </div>
          <?php endif; ?>


          <form action="/users/checkout/success" method="POST">
            <div class="delivery-way">
                <h2 class="delivery-way__title">Способы доставки</h2>
                <!-- <div class="delivery-way__item"></div> -->
                <!-- <p>Бесплатно</p>
                <div class="descripton-way">
                <p>Стандартная доставка:</p>
                <p>Ожидаемая дата доставки Вторник, 2 июнь, 2020</p>
                </div> -->
                <label for="delivery-way-1">Почта России</label>
                <input id="delivery-way-1" type="radio" checked="checked" name="deliveryWay" value="Почта России"/>
                <!-- <div class="delivery-way__item"></div>
                <p>Бесплатно</p>
                <div class="descripton-way">
                <p>Экспресс доставка:</p>
                <p>Ожидаемая дата доставки Среда, 20 май, 2020</p>
                </div> -->
                <label for="delivery-way-1">Курьерская доставка</label>
                <input id="delivery-way-2" type="radio" name="deliveryWay" value="Курьерская доставка"/>
            </div>
            <div class="pay-way">
                <h2 class="pay-way__title">Способ оплаты</h2>
                <label for="pay-way-1">Наличные</label>
                <input id="pay-way-2" type="radio" name="payWay" value="Наличные" checked="checked"/>
                <label for="pay-way-1">Картой</label>
                <input id="pay-way-2" type="radio" name="payWay" value="Картой"/>
            </div>
                <button class="main-btn" type="submit">Заказать</button>
            </div>
          </form>
        <div class="order-info">
          <div class="order-info__head">
            <div class="order-info__title">
              <h2>Количество товаров -</h2><span class="f-c-c">1</span>
            </div>
          </div><a class="f-c-c" href="/users/cart">Изменить</a>
          <?php if(!empty($orderList)): ?>
          <ul>
            <?php foreach($orderList as $orderItem): ?>
            <li data-order-item-id='<?= $orderItem->getId()  ?>' class="order__item">
                <img class="order__item-img" src="<?= $orderItem->getProduct()->getMainImg() ?>" alt="товар"/>
                <div class="order__item-description">
                    <span class="order__item-price"><?= $orderItem->getProduct()->getPrice() ?> руб</span>
                    <span class="order__item-title"><?= $orderItem->getProduct()->getName() ?></span>
                    <span class="order__item-properties"><?= $orderItem->getGoodsProperties() ?></span>
                    <span class="order__item-quentity">Кол-во: <?= $orderItem->getCount() ?></span>
                </div>
            </li>
            <?php endforeach; ?>
          </ul>
          <div class="order__total">
            <div class="goods-price"><span>Итого</span><span class="f-c-c"><?= $orderPrice ?> руб</span></div>
            <div class="order-price">
              <h2>Всего к оплате</h2><span class="f-c-c"><?= $orderPrice ?> руб + доставка</span>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </main>
  </body>
</html>