<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/css/main.css"/>
    <title>Мужчины</title>
  </head>
  <body>
    <header class="header">
      <div class="header-main container"><a class="logo cc" href="/">LOGOTIP</a>
        <div class="gender-menu"><a class="gender-menu__item cc" href="/pages/woomen.html">Женское</a><a class="gender-menu__item cc" href="/pages/men.html">Мужское</a></div>
        <form class="search-form" action="#" method="get">
          <input class="search-form__input" name="search-form" type="text" placeholder="Искать"/>
          <button class="search-form__btn cc" type="submit"><img class="icon-20" src="/img/icons/icon-search.svg" alt="search"/></button>
        </form>
        <div class="user-panel">
          <div class="up-dropdow">
            <button class="up-dropdown__btn cc"><img class="icon-20" src="/img/icons/icon-user.svg" alt="User"/></button>
            <div class="up-dropdown__select">
              <div class="up-dropdown__head">
              <?php if (!empty($user)): ?>
                <div class="up-dropdown__head-item">Привет, <?= $user->getFirstName() ?></div>
                <a href='/users/exit'>Выйти</a>
              <?php else: ?>
                <div class="up-dropdown__head-item"><a href="/users/login">Войти</a></div>
                <div class="up-dropdown__head-item"><a href="/users/register">Регистрация</a></div>
              <?php endif; ?>  
              </div>
              <ul class="up-dropdown__list">
                <li class="up-dropdown__item li"><a href="/pages/private-page.html">Личный кабинет</a></li>
                <li class="up-dropdown__item li"><a href="/pages/private-page.html">Мои заказы</a></li>
              </ul>
            </div>
          </div><a class="up__item cc" href="#"><img class="icon-20" src="/img/icons/icon-like.svg" alt="Избранное"/></a><a class="up__item cc" href="/pages/cart.html"><img class="icon-20" src="/img/icons/icon-cart.svg" alt="Корзина"/></a>
        </div>
      </div>
    </header>