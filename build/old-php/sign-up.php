<?php
	session_start(); //Перво-наперво необходимо «стартовать» сессию — для этого воспользуемся функцией session_start()

	include('db.php');

	print_r($_SESSION);

	// if ($_POST['email']=='' || 
	// 	$_POST['password']=='' || 
	// 	$_POST['first_name']=='' || 
	// 	$_POST['last_name']=='') echo 
	
	// 	'<!DOCTYPE html>
	// 		<html lang="ru">
	// 		<head>
	// 		    <meta charset="UTF-8">
	// 		    <title>Регистрация</title>
	// 		</head>
	// 		<body>
			 
	// 			<form action="/sign-up.php" method="POST">
	// 				<p>имя
	// 				<input type="text" name="first_name" id="first_name" required></p>
	// 				<p>фамилия
	// 			    <input type="text" name="last_name" id="last_name" required></p>
	// 				<p>email
	// 			    <input type="text" name="email" id="email" required></p>
	// 			    <p>пароль
	// 			    <input type="password" name="password" id="password" required></p>
	// 			    <input type="submit" id="button" value="Зарегистрироваться">
	// 			</form>
	// 			<p><a href="login">Авторизация</a> </p>
			                
	// 		</body>
	// 		</html>';
	// else{
		//вот так данные можно отправлять без проверки вовсе, ни чего очень плохого случиться не должно. 
		//PDO все заэкранирует и превратит в текст. 
		//Можно разве что проверять длинну текста и какие то специфическиие данные
		try{
			$sql = "INSERT INTO  `customers` (`id`, `first_name`, `last_name`, `patronymic`,`email`, `password`) VALUES (NULL, :first_name, :last_name, :patronymic, :email, :pass)";            //Формируем запрос без данных

			// $_POST['password'] = md5($_POST['password']);
			// print_r($_POST);
			
			// print_r($pd);

			if (!isset($_POST['patronymic'])) {  //найти другой вариант решения
				$_POST['patronymic'] = NULL;
			}

            // $result = $pdo->prepare($sql);
            // $result->bindvalue(':first_name', $_POST['first_name']);
			// $result->bindvalue(':last_name', $_POST['last_name']);
			// $result->bindvalue(':patronymic', $_POST['patronymic']);
			// $result->bindvalue(':email', $_POST['email']);	//Заполняем данные
			// $result->bindvalue(':pass', md5(md5($_POST['password'])));	//Заполняем данные. Пароли хранить в открытом виде, дело такое. Поэтому двойной md5)
			// $result->execute();							//Выполняем запросы

			// echo '<meta charset="UTF-8">Регистрация успешна!';
			// echo 'Вы успешно зарегистрированы!'; 
    		// sleep(3);
    		header('Location: /'); //нельзя ничего выводить перед header. также не нужно до <?php писать комменты, чтобы все работало
		}catch(PDOException $e){
			$Log_File = "log.txt";
			file_put_contents($Log_File, date("Y-m-d H:i:s")." -//- ".$e->getMessage().PHP_EOL, FILE_APPEND | LOCK_EX);				
			echo '<meta charset="UTF-8">Ошибка регистрации';
		}

			
	// }