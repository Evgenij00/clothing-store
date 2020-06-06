<?php

    namespace MyProject\Models\Orders;

    use MyProject\Models\ActiveRecordEntity;
    use MyProject\Models\Products\Product;
    use MyProject\Services\Db;

    class OrderItem extends ActiveRecordEntity {

        protected $orderId;
        protected $goodsId;
        protected $goodsProperties;
        protected $count;

        public function getCount(): int {
            return $this->count;
        }

        public function setCount($count) {
            $this->count = $count;
        }

        public function getGoodsId(): int {
            return $this->goodsId;
        }

        public function getGoodsProperties(): string {
            return $this->goodsProperties;
        }

        static public function add(Product $product, int $orderId): self {

            //Если такого товара с таким же свойством нет!!!
            $orderItem = new OrderItem();
            $orderItem->orderId = $orderId;
            $orderItem->goodsId = $product->getId();
            //добавленное свойство
            $orderItem->goodsProperties = $_POST['product-size'];
            $orderItem->count = 1;
            // vardump($orderItem);
            $orderItem->save();
            //с ценой пока не знаю че делать
            return $orderItem;
        }

        static public function updateProduct($data) {

            // vardump($data);
            // return;

            if (isset($data->size)) {
                $sql = 'UPDATE `' . static::getTableName() . '` SET goods_properties = :size WHERE id = :id;';
                $params = [':id' => $data->id, ':size' => $data->size];
            }

            if (isset($data->count)) {
                $sql = 'UPDATE `' . static::getTableName() . '` SET count = :count WHERE id = :id;';
                $params = [':id' => $data->id, ':count' => $data->count];
            }

            $db = Db::getInstace();
            $result = $db->query($sql, $params, static::class);
        }

        static public function deleteItemFromOrder($data) {

            // vardump($data);
            // return;

            $sql = 'DELETE FROM `' . static::getTableName() . '` WHERE id = :id;';
            // var_dump($sql);
            // return;

            $db = Db::getInstace();
            $result = $db->query($sql, [':id' => $data->id], static::class);

            // if ($result === []) return true;
        }

        static public function isFindItem(int $productId, int $orderId) {
            $sql = "SELECT * FROM `orders_cart` WHERE order_id = :order_id AND goods_id = :goods_id AND  goods_properties = :goods_properties;";

            $db = Db::getInstace();
            $result = $db->query($sql, [
                ':order_id' => $orderId,
                ':goods_id' => $productId,
                ':goods_properties' => $_POST['product-size']
            ], self::class);

            if ($result === []) return null;

            return $result[0];
        }

        protected static function getTableName(): string {
            return 'orders_cart';
        }

        function vardump($var) {
            static $int=0;
            echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
            var_dump($var);
            echo '</pre>';
            $int++;
        }

    }