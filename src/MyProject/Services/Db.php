<?php

    namespace MyProject\Services;

    class Db {

        private $pdo;

        public function __construct(){
            $dbOptions = (require __DIR__ . '/../../settings.php')['db'];

            $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'] . ';',
                $dbOptions['user'],
                $dbOptions['password']
            );

            $this->pdo->exec('SET NAMES UTF8');
        }

        public function query(string $sql, array $param = [], string $className = 'stdClass'): ?array { //Третьим аргументом в этот метод будет передаваться имя класса, объекты которого нужно создавать. По умолчанию это будут объекты класса stdClass – это такой встроенный класс в PHP, у которого нет никаких свойств и методов.  PHP мы можем задавать свойства объектов на лету, даже если они не были определены в классе. Это называется динамическим объявлением свойств. Если свойства у объекта нет, но мы попытаемся его задать – будет создано новое публичное свойство.

            $sth = $this->pdo->prepare($sql);  //Если СУБД успешно подготовила запрос, PDO::prepare() возвращает объект PDOStatement. Если подготовить запрос не удалось, PDO::prepare() возвращает FALSE или выбрасывает исключение PDOException (зависит от текущего режима обработки ошибок).

            $result = $sth->execute($param);  //PDOStatement::execute — Запускает подготовленный запрос на выполнение. Возвращает TRUE в случае успешного завершения или FALSE в случае возникновения ошибки.

            if ($result === false) {
                return null;
            }

            return $sth->fetchAll(\PDO::FETCH_CLASS, $className); //PDOStatement::fetchAll() возвращает массив, содержащий все оставшиеся строки результирующего набора. Массив представляет каждую строку либо в виде массива значений одного столбца, либо в виде объекта, имена свойств которого совпадают с именами столбцов. В метод fetchAll() мы передали специальную константу - \PDO::FETCH_CLASS, она говорит о том, что нужно вернуть результат в виде объектов какого-то класса. Второй аргумент – это имя класса, которое мы можем передать в метод query().
        }
    }