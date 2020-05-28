<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/css/main.css"/>
    <title>Главная</title>
</head>
<body>

<?php include __DIR__ . '/../header.php' ?>

<main class="main">
  <div class="goods container">
    <?php foreach ($goods as $product): ?>
        <div class="goods__item">
          <a href='products/<?= $product->getId() ?>' >
            <img src='<?= $product->getMainImg() ?>' alt="товар"/>
          </a>
          <span class="goods__item-title"><?= $product->getName() ?></span>
          <span class="goods__item-price"><?= $product->getPrice() ?></span>
          <button class="goods__item-btnlike f-c-c"><img src="/img/icons/icon-like.svg" alt="Избранное"/></button>
        </div>
    <?php endforeach; ?>
  </div>
</main>

<?php include __DIR__ . '/../footer.php' ?>