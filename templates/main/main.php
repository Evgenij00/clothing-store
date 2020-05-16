<?php include __DIR__ . '/../header.php' ?>

<main class="main">
  <div class="goods container">
    <?php foreach ($goods as $item): ?>
        <div class="goods__item">
          <a href=<?=$item['href']?>>
            <img src=<?=$item['img']?> alt="товар"/>
          </a>
          <span class="goods__item-title"><?=$item['title']?></span>
          <span class="goods__item-price"><?=$item['price']?></span>
          <button class="goods__item-btnlike f-c-c"><img src="/img/icons/icon-like.svg" alt="Избранное"/></button>
        </div>
    <?php endforeach; ?>
  </div>
</main>

<?php include __DIR__ . '/../footer.php' ?>