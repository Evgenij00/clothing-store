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

        public function save(): void {

            $mappedProperies = $this->mapPropertiesToDbFormat();

            if ( $this->id !== null ) { 
                $this->update($mappedProperies); //update(), если id у объекта есть;
            } else {
                $this->insert($mappedProperies); //insert(), если это свойство у объекта равно null.
            }

            // vardump($mappedProperies);

        }

        // UPDATE table_name
        // SET column1 = :param1, column2 = :param2, ...
        // WHERE condition;

        private function update(array $mappedProperies): void {

            $columnsToParams = [];
            $paramsToValues = [];

            $index = 1;
            
            foreach($mappedProperies as $column => $value) {
                $param = ':param' . $index;

                $columnsToParams[] = $column . '=' . $param;
                $paramsToValues[$param] =  $value;

                $index++;
            }

            $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columnsToParams) . ' WHERE id=' . $this->id;

            $db = Db::getInstace();
            $db->query($sql, $paramsToValues, static::class);
        }

        private function insert(array $mappedProperties) {
            //INSERT INTO `articles` (`author_id`, `name`, `text`) VALUES (:author_id, :name, :text)

            // $filteredProperties = array_filter($mappedProperties); //убираем свойства с значением null. Также уберет свойства с значением 0!!!!!;

            // vardump($filteredProperties);

            $columnsName = [];
            $paramsName = [];
            $values = [];

            foreach($mappedProperties as $column => $value) {  
                $columnsName[] = '`' . $column . '`';   //получаем имя свойства

                $param = ':' . $column;

                $paramsName[] = $param;
                $values[$param] = $value;
            }

            // vardump($columnsName);
            // vardump($paramsName);
            // vardump($values);

            $sql = 'INSERT INTO `'  . static::getTableName() . '`( ' . implode(', ', $columnsName) . ') VALUES ( ' . implode(', ', $paramsName) . ');';

            // vardump($sql);
            
            $db = Db::getInstace();

            $db->query($sql, $values, static::class);

            // echo $db->getLastInsertId();

            $this->id = $db->getLastInsertId();
        }

        public function delete() {
            // vardump($this);

            $sql = 'DELETE FROM `' . static::getTableName() . '` WHERE id = :id;';

            // vardump($sql);

            $db = Db::getInstace();
            $db->query($sql, [':id' => $this->id], static::class);

            $this->id = null;
        }

        private function underscoreToCamelCase(string $source): string {
            return lcfirst(str_replace('_', '', ucwords($source, '_'))); //ucwords() делает первые буквы в словах большими, str_replace() заменяет в получившейся строке все символы ‘_’ на пустую строку, lcfirst() просто делает первую букву в строке маленькой
        }

        private function camelCaseToUnderscore(string $source): string {
            return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source)); //потом разобраться
        }

        private function mapPropertiesToDbFormat(): array {

            $reflector = new \ReflectionObject($this);
            $properties = $reflector->getProperties(); // - return array of objects

            $mappedProperies = [];

            foreach($properties as $property) {
                $propertyName = $property->getName();
                $underscorePropertyName = $this->camelCaseToUnderscore($propertyName);

                $mappedProperies[$underscorePropertyName] = $this->$propertyName;
            }

            return $mappedProperies;
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