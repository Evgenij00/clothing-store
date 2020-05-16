<?php 

    $login = 'root'; // пользователь

    $password = ''; // пароль

    $dbName = 'onlinestore'; // название бд

    $host = 'localhost'; // хост

    $charset = 'utf8'; // кодировка

    $dsn = "mysql:host=localhost;dbname=$dbName;charset=$charset";

    try{
        $pdo = new PDO($dsn, $login, $password); //Мы создали подключение к БД. Подключение от PDO не нужно закрывать, оно само закрывается, когда скрипт завершает свою работу.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //setAttribute - Устанавливает атрибут объекту PDO. PDO::ATTR_ERRMODE: Режим сообщений об ошибках. PDO::ERRMODE_EXCEPTION: Выбрасывать исключения.

    }catch(PDOException $e){ //PDOException - Представляет ошибку, вызванную PDO. Вам не следует выбрасывать исключения PDOException из своего кода.
        $Log_File = "log.txt";
        file_put_contents($Log_File, date("Y-m-d H:i:s")." -//- ".$e->getMessage().PHP_EOL, FILE_APPEND | LOCK_EX);	//file_put_contents — Пишет данные в файл. $e->getMessage() - Возвращает сообщение исключения(Какое-нибудь сообщение об ошибке). PHP_EOL (string) - Корректный символ конца строки, используемый на данной платформе. Если filename не существует, файл будет создан. Иначе, существующий файл будет перезаписан, за исключением случая, если указан флаг FILE_APPEND - отвечает за то что, Если файл filename уже существует, данные будут дописаны в конец файла вместо того, чтобы его перезаписать. LOCK_EX для получения эксклюзивной блокировки (запись).
        echo '<meta charset="UTF-8">Ошибка базы данных';
    }
