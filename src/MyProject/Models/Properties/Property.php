<?php

    namespace MyProject\Models\Properties;
    use MyProject\Models\Users\User;
    use MyProject\Services\Db;
    use MyProject\Models\ActiveRecordEntity;

    class Property extends ActiveRecordEntity {

        private $goodsId;
        private $propertyId;
        private $name;
        private $value;
        private $count;

        public function getValue(): string{
            return $this->value;
        }

        static public function getPropertiesByProductId(int $productId): ?array {
            $db = Db::getInstace();

            $sql = "SELECT g.id, res.* FROM `goods` as `g` JOIN 
                        (
                            SELECT gp.id, gp.goods_id, gp.property_id, p.name, gp.value, gp.count 
                            FROM `goods_properties` AS `gp` JOIN `properties` AS `p` 
                            WHERE gp.property_id = p.id
                        ) AS `res` 
                    WHERE g.id = res.goods_id AND g.id = :id;";

            // vardump($sql);

            $sth = $db->query($sql, [':id' => $productId], Property::class);
            // vardump($sth);

            if ($sth === []) return null;

            return $sth;
        }

        protected static function getTableName(): string {
            return 'goods_properties';
        }

    }

    function vardump($var) {
        static $int=0;
        echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
        var_dump($var);
        echo '</pre>';
        $int++;
    }