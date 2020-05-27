<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/css/main.css"/>
    <title>Регистрация</title>
  </head>
  <body>
    <header class="header auth-container-wrap">
      <div class="logo cc"><a href="/">LOGOTIP</a></div>
    </header>
    <main class="main auth-container-wrap">
      <div class="content">
        <ul class="auth-head">
          <li class="auth-head__item cc"><span>Впервые на (...)?</span></li>
          <li class="auth-head__item cc"><a href="/users/login">Вы уже Зарегестрированы?</a></li>
        </ul>

        <!-- Если поле ввода пустое при регистрации -->
        <?php if (!empty($error)): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
        <?php endif; ?>

        <!-- проводим валидацию полей на уровне php -->
        <form class="auth-form" action="/users/register" method="POST">
          <label class="label" for="firstName">Имя:</label>
          <input class="inp" id="first_name" type="text" name="firstName" value="<?=  $_POST['firstName'] ?? '' ?>"/>
          <label class="label" for="lastName">Фамилия:</label>
          <input class="inp" id="last_name" type="text" name="lastName" value="<?=  $_POST['lastName'] ?? '' ?>"/>
          <label class="label" for="email">Адрес электронной почты:</label>
          <input class="inp" id="email" type="text" name="email" value="<?=  $_POST['email'] ?? '' ?>"/>
          <label class="label" for="password">Пароль: (не короче восьми символов)</label>
          <input class="inp" id="password" type="password" name="password"/>
          <label class="label" for="r-password">Повторите пароль:</label>
          <input class="inp" id="r-password" type="password" name="r-password"/>
          <label class="label" for="gender-m">М</label>
          <input id="gender-m" type="radio" name="gender" value="1"/>
          <label class="label" for="gender-w">Ж</label>
          <input id="gender-w" type="radio" name="gender" value="2"/>
          <button class="signin-form__btn">Зарегестрироваться</button>
        </form>

        <!-- проводим валидацию полей на уровне css -->
        <!-- <form class="auth-form" action="/users/register" method="POST">
          <label class="label" for="firstName">Имя:</label>
          <input class="inp" id="first_name" type="text" name="firstName" required="required"/>
          <label class="label" for="lastName">Фамилия:</label>
          <input class="inp" id="last_name" type="text" name="lastName" required="required"/>
          <label class="label" for="patronymic">Отчество:</label>
          <input class="inp" id="patronymic" type="text" name="patronymic"/>
          <label class="label" for="email">Адрес электронной почты:</label>
          <input class="inp" id="email" type="text" name="email" required="required"/>
          <label class="label" for="password">Пароль:</label>
          <input class="inp" id="password" type="password" name="password" required="required"/>
          <button class="signin-form__btn">Зарегестрироваться</button>
        </form> -->
      </div>
    </main>
  </body>
</html>