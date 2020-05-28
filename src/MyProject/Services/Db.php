<?php

    namespace MyProject\Services;
    use MyProject\Exceptions\DbException;

    class Db {

        private static $instace;
        private $pdo;

        public static function getInstace(): self {

            if (!isset(self::$instace)) { //(self::$instance === null) потом сравнить!
                self::$instace = new self();
            }

            return self::$instace;
        }

        private function __construct(){
            $dbOptions = (require __DIR__ . '/../../settings.php')['db'];

            try {
                $this->pdo = new \PDO(
                    'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'] . ';',
                    $dbOptions['user'],
                    $dbOptions['password']
                );
    
                $this->pdo->exec('SET NAMES UTF8');
            } catch (\PDOException $e) {
                throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage(), $e->getCode());
            }
        }

        public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array { //Третьим аргументом в этот метод будет передаваться имя класса, объекты которого нужно создавать. По умолчанию это будут объекты класса stdClass – это такой встроенный класс в PHP, у которого нет никаких свойств и методов.  PHP мы можем задавать свойства объектов на лету, даже если они не были определены в классе. Это называется динамическим объявлением свойств. Если свойства у объекта нет, но мы попытаемся его задать – будет создано новое публичное свойство.

            // vardump($sql);
            // vardump($params);
            
            $sth = $this->pdo->prepare($sql);  //Если СУБД успешно подготовила запрос, PDO::prepare() возвращает объект PDOStatement. Если подготовить запрос не удалось, PDO::prepare() возвращает FALSE или выбрасывает исключение PDOException (зависит от текущего режима обработки ошибок).
            // vardump($sth);

            $result = $sth->execute($params);  //PDOStatement::execute — Запускает подготовленный запрос на выполнение. Возвращает TRUE в случае успешного завершения или FALSE в случае возникновения ошибки.

            // vardump($result);
            
            if ($result === false) {
                return null;
            }

            return $sth->fetchAll(\PDO::FETCH_CLASS, $className); //PDOStatement::fetchAll() возвращает массив, содержащий все оставшиеся строки результирующего набора. Массив представляет каждую строку либо в виде массива значений одного столбца, либо в виде объекта, имена свойств которого совпадают с именами столбцов. В метод fetchAll() мы передали специальную константу - \PDO::FETCH_CLASS, она говорит о том, что нужно вернуть результат в виде объектов какого-то класса. Второй аргумент – это имя класса, которое мы можем передать в метод query().
        }

        public function getLastInsertId(): int { //Для того, чтобы получить id последней вставленной записи в базе (в рамках текущей сессии работы с БД) можно использовать метод lastInsertId() у объекта PDO
            return $this->pdo->lastInsertId();
        }
    }

    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }