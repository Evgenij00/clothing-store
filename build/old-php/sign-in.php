<?php

	if (!isset($_POST['login']) || !isset($_POST['password'])) echo //безопасно ли так делать, проверять таким образом?
		'<!DOCTYPE html>
			<html lang="ru">
			<head>
			    <meta charset="UTF-8">
			    <title>Авторизация</title>
			</head>
			<body> 
			 
				<form action="login" method="POST">
					<p>логин
				    <input type="text" name="login" id="login"></p>
				    <p>пароль
				    <input type="password" name="password" id="password"></p>
				    <input type="submit" id="button" value="Войти">
				</form>
				<p><a href="registration">Регистрация</a> </p>
			                
			</body>
			</html>'; 
	else{
		//вот так данные можно отправлять без проверки вовсе, ни чего очень плохого случиться не должно. 
		//PDO все заэкранирует и превратит в текст. 
		//Можно разве что проверять длинну текста и какие то специфическиие данные

		$sql = "SELECT * FROM users WHERE login=:login AND password=:pass";//Формируем запрос без данных
		$result = $pdo->prepare($sql);      //Подготавливает SQL выражение к выполнению. Возвращает объект
		$result->bindvalue(':login', $_POST['login']);	//Заполняем данные. bindvalue - Связывает параметр с заданным значением
		$result->bindvalue(':pass', md5(md5($_POST['password'])));	//Заполняем данные. Пароли хранить в открытом виде, дело такое. Поэтому двойной md5) md5 - hash function
		$result->execute( );							//Выполняем запросы. execute - Запускает подготовленный запрос на выполнение
		$result = $result->fetchAll();					//переводим обьект PDO в массив данных, для удобной работы

		if (count($result)>0) {     //Если база вернула 1 значение, значит и логин и пароль совпали. отлично
			echo '<meta charset="UTF-8">Ура! Мы авторизировались!'; 
			$_SESSION['user'] = $result[0];         //сохраняем обьект пользователя в сессии
			
		}	else {
			echo '<meta charset="UTF-8">Логин или пароль не верный или пользователь не существует';
		}
	}
?>