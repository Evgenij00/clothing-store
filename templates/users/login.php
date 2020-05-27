<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/css/main.css"/>
    <title>Вход</title>
  </head>
  <body>
    <header class="header auth-container-wrap">
      <div class="logo cc"><a href="/">LOGOTIP</a></div>
    </header>
    <main class="main auth-container-wrap">
      <div class="content">
        <ul class="auth-head">
          <li class="auth-head__item cc"><a href="/users/register">Впервые на (...)?</a></li>
          <li class="auth-head__item cc"><span>Вы уже Зарегестрированы?</span></li>
        </ul>

        <!-- ошибка - неверные данные -->
        <?php if (!empty($error)): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
        <?php endif; ?>

        <form class="auth-form" action="/users/login" method="POST">
          <label class="label" for="signin-email">Адрес электронной почты:</label>
          <input class="inp" id="signin-email" type="text" name="email"/>
          <label class="label" for="signin-password">Пароль:</label>
          <input class="inp" id="signin-password" type="password" name="password"/>
          <button class="auth-form__btn">Войти</button>
        </form>
        </form>
      </div>
    </main>
  </body>
</html>