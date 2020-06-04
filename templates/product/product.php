<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/css/main.css"/>
    <title>Товар</title>
</head>
<body>

<?php include __DIR__ . '/../header.php' ?>

<main class="main container">
      <div class="product-box">

      <!-- Если время хватит!   <ph $images->getProduct()->getMainImg()>
        <ul class="product-list-img">
          <li><img class="img-item" src='#' alt="фото"/></li>
          <li><img class="img-item" src='#' alt="фото"/></li>
          <li><img class="img-item" src='#' alt="фото"/></li>
          <li><img class="img-item" src='#' alt="фото"/></li>
        </ul> -->
        
        <img class="product__main-image" src='<?= $product->getMainImg() ?>' alt="Главное фото"/>
        <div class="product__info">
          <h1 class="product__title"><?= $product->getName() ?></h1>
          <p class="product__price"><?= $product->getPrice() ?></p>
          <!-- <p class="product__property">Lorem, ipsum dolor.</p> -->
          <form class="product__form" action="/products/<?= $product->getId()  ?>" method="POST">
            <label for="product-size">Размер</label>

            <!-- нужно обязательно выбрать размер!!!! -->
            <?php if(!empty($properties)): ?>
              <select class="select-size" id="product-size" name="product-size">
                <option value="">Пожалуйста, выберите</option>
                <?php foreach($properties as $property): ?>
                  <option value="<?= $property->getValue()?>"><?= $property->getValue()?></option>
                <?php endforeach; ?> 
              </select>  
            <?php else: ?>
              <div>Товар не доступен</div>
            <?php endif; ?>  
            <div class="buttons">
              <button type='submit' class="btn__add-cart">Добавить в корзину</button>
              <!-- <button class="btn__like-cart f-c-c"><img  class="icon-20" src="/img/icons/icon-love.svg" alt="Избранное"/></button> -->
            </div>
          </form>
        </div>
      </div>
    </main>

<?php include __DIR__ . '/../footer.php' ?>