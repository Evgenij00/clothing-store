<?php include __DIR__ . '/../header.php' ?>

<main class="main">
  <div class="goods container">
    <?php foreach ($goods as $product): ?>
        <div class="goods__item">
          <a href='products/<?= $product->getId() ?>' >
            <img src='#' alt="товар"/>
          </a>
          <span class="goods__item-title"><?= $product->getName() ?></span>
          <span class="goods__item-price"><?= $product->getPrice() ?></span>
          <button class="goods__item-btnlike f-c-c"><img src="/img/icons/icon-like.svg" alt="Избранное"/></button>
        </div>
    <?php endforeach; ?>
  </div>
</main>

<?php include __DIR__ . '/../footer.php' ?>