<?php

    namespace MyProject\Models;
    use MyProject\Services\Db;
    use MyProject\Models\Users\User;

    abstract class ActiveRecordEntity {

        protected $id;

        public function getId(): int {
            return $this->id;
        }

        public function __set(string $name, $value) { //Динамически создает свойства класса из БД. Если этот метод добавить в класс и попытаться задать ему несуществующее свойство, то вместо динамического добавления такого свойства, будет вызван этот метод. При этом в первый аргумент $name, попадёт имя свойства, а во второй аргумент $value – его значение. А внутри этого метода мы уже сможем решить, что с этими данными делать. Все магические методы ДОЛЖНЫ быть объявлены как public.
            $camelCaseName = $this->underscoreToCamelCase($name);
            $this->$camelCaseName = $value;
        }

        public static function findAll(): array {
            $db = Db::getInstace();
            
            $sql = 'SELECT * FROM ' . static::getTableName() . ';'; //  (;) и `` - всегда!!!
            return $db->query(
                $sql, 
                [],
                static::class //Если будет использоваться self:class, то там будет значение “Article”, а если мы напишем static::class, то там уже будет значение “SuperArticle”. Это называется поздним статическим связыванием – благодаря нему мы можем писать код, который будет зависеть от класса, в котором он вызывается, а не в котором он описан.
            );
        }

        private  function underscoreToCamelCase(string $source): string {
            return lcfirst(str_replace('_', '', ucwords($source, '_'))); //ucwords() делает первые буквы в словах большими, str_replace() заменяет в получившейся строке все символы ‘_’ на пустую строку, lcfirst() просто делает первую букву в строке маленькой
        }

        abstract protected static function getTableName(): string; //интерфейс

        public static function getById(int $id): ?self { //   (: ?self) - ПОДУМАТЬ, ЧТО С ЭТИМ ДЕЛАТЬ!!!
            $db = Db::getInstace();

            // echo static::getTableName();

            $sql = 'SELECT * FROM ' . static::getTableName() . ' WHERE id = :id';

            $result = $db->query(
                $sql,
                [':id' => $id],
                static::class
            );

            return $result ? $result[0] : null;
        }
    }