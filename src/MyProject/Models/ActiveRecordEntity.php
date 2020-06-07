<?php

    namespace MyProject\Models;
    use MyProject\Services\Db;
    use MyProject\Models\Users\User;
    use MyProject\Models\Products\Product;

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

        public static function getById(int $id): ?self { //   (: ?self) - ПОДУМАТЬ, ЧТО С ЭТИМ ДЕЛАТЬ!!! self возвращает и унаследованные объекты!!!!!!
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

        static public function findOneByColumn(string $columnName, $value): ?self {
            $sql = 'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;';
            // vardump($sql);
            $db = Db::getInstace();
            $res = $db->query($sql, [':value' => $value], static::class);
            // vardump($res);
            if ($res === []) return null;
            return $res[0];
        }

        public function save(): void {
            $mappedProperies = $this->mapPropertiesToDbFormat();

            //убираем свойства с NULL
            //второй аргумент - ф-колбек
            $filteredProperties = array_filter($mappedProperies, function($param) {
                if (is_null($param)) return false;
                return true;
            }); 

            if ( $this->id !== null ) { 
                $this->update($filteredProperties); //update(), если id у объекта есть;
            } else {
                $this->insert($filteredProperties); //insert(), если это свойство у объекта равно null.
            }
        }

        private function update(array $filteredProperties): void {

            $columnsToParams = [];
            $paramsToValues = [];

            $index = 1;
            
            foreach($filteredProperties as $column => $value) {
                $param = ':param' . $index;

                $columnsToParams[] = $column . '=' . $param;
                $paramsToValues[$param] =  $value;

                $index++;
            }

            $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columnsToParams) . ' WHERE id=' . $this->id;

            $db = Db::getInstace();
            $db->query($sql, $paramsToValues, static::class);
        }

        private function insert(array $filteredProperties) {

            $columnsName = [];
            $paramsName = [];
            $values = [];

            foreach($filteredProperties as $column => $value) {  
                //формируем имена столбцов в таблице бд
                $columnsName[] = '`' . $column . '`';
                $param = ':' . $column;

                $paramsName[] = $param;
                $values[$param] = $value;
            }

            $sql = 'INSERT INTO `'  . static::getTableName() . '` (' . implode(', ', $columnsName) . ') VALUES (' . implode(', ', $paramsName) . ');'; //implode — Объединяет элементы массива в строку

            $db = Db::getInstace();
            $sth = $db->query($sql, $values, static::class);
            $this->id = $db->getLastInsertId();
        }

        public function delete(): void {
            $sql = 'DELETE FROM `' . static::getTableName() . '` WHERE id = :id;';

            $db = Db::getInstace();
            $db->query($sql, [':id' => $this->id], static::class);

            $this->id = null;
        }

        protected function underscoreToCamelCase(string $source): string {
            return lcfirst(str_replace('_', '', ucwords($source, '_'))); //ucwords() делает первые буквы в словах большими, str_replace() заменяет в получившейся строке все символы ‘_’ на пустую строку, lcfirst() просто делает первую букву в строке маленькой
        }

        private function camelCaseToUnderscore(string $source): string {
            return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source)); //потом разобраться
        }

        private function mapPropertiesToDbFormat(): array {
            // vardump($this);

            $reflector = new \ReflectionObject($this);
            $properties = $reflector->getProperties(); // - return array of objects

            $mappedProperties = [];

            foreach($properties as $property) {
                $propertyName = $property->getName();
                $underscorePropertyName = $this->camelCaseToUnderscore($propertyName);

                $mappedProperties[$underscorePropertyName] = $this->$propertyName;
            }

            // vardump($mappedProperties);
            return  $mappedProperties;
        }

        abstract protected static function getTableName(): string; //интерфейс
    }

    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }